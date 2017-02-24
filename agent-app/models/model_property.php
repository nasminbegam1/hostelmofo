<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_property extends CI_Model
{
	
	public function __construct()
	{
	   // Call the Model constructor
	   parent::__construct();
	}
	
	
	
	public function getList(&$config,&$start){
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('ROOM_LIST');
			$search_keyword = addslashes($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= addslashes($this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= addslashes($search_keyword);
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ROOM_LIST', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($search_keyword != ''){
			$where.= " AND (P.property_name like '%".trim($search_keyword)."%' )";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".PROPERTY_MASTER." AS P". 
			$where . 
			"
			AND P.agent_id= ".$this->current_user['agent_id']."
			
			ORDER BY property_master_id DESC LIMIT 0,1";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		//$config['total_rows'] = $rec['TotalrecordCount'];
		$config['total_rows'] = 1;
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT P.*,PP.province_name,CM.city_name,CM.city_seo_slug,PP.province_name,PP.province_slug,PT.property_type_name,PT.property_type_slug,PD.email_address_booking
			FROM ".PROPERTY_MASTER." AS P
			LEFT JOIN ".PROPERTY_DETAILS." AS PD ON P.property_master_id = PD.property_id
			LEFT JOIN ".PROVINCE_MASTER." AS PP ON PD.province_id = PP.province_id
			LEFT JOIN ".CITY." AS CM ON CM.city_master_id = PD.city_id
			LEFT JOIN ".PROPERTY_TYPE." AS PT ON P.property_type_id = PT.property_type_id "
			.$where.
			"AND P.agent_id= ".$this->current_user['agent_id']."
			
			ORDER BY P.property_master_id DESC LIMIT 0,1";
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = array();
		
		if($rs->num_rows()){
			$rec = $rs->result_array();
			if(is_array($rec)){
				foreach($rec as $key=>$r){
					if($r['required_fields']=='' and $r['status']=='Incomplete'){
						$this->db->where('property_master_id',$r['property_master_id']);
						$this->db->update(PROPERTY_MASTER,array('status'=>'Inactive'));
					}
					$image_file_name = $this->getPropertyImageById($r['property_master_id']);
					$rec[$key]['images'] = $image_file_name;
				}
			}
		}
		return $rec;
		
	}
	/*** Owner Master Master ***/

	
	
	
	
	public function getPropertyDetails($property_id){
		$record=array();
		if($property_id){
			$this->db->where('property_master_id',$property_id);
			$query = $this->db->get(PROPERTY_MASTER);
			if($query->num_rows()>0){
				$record['property_master'] = $query->row_array();
				

				$this->db->where('property_id',$property_id);
				$detailsQuery = $this->db->get(PROPERTY_DETAILS);
				
				$record['property_details'] = array();
				if($detailsQuery->num_rows()>0){
					$record['property_details'] = $detailsQuery->row_array();

					//pr($record);

				$provinceId	= $record['property_details']['province_id'];

					if($provinceId!=''){

					$this->db->select('province_name');
					$this->db->where('province_id', $provinceId);
					$province_details =   $this->db->get(PROVINCE_MASTER);
						$province_details = $province_details->result();
                $record['province_name'] = $province_details[0]->province_name;


            			}	
            			//city name
            			$provinceCityId	= $record['property_details']['city_id'];
            			//pr($provinceCityId);
            			if($provinceCityId!=''){

					$this->db->select('city_name');
					$this->db->where('city_master_id', $provinceCityId);
					$city_details =   $this->db->get(CITY);

					//pr($city_details);
						$city_details = $city_details->result();
                $record['city_name'] = $city_details[0]->city_name;

       
            		}
				}
				$this->db->where('property_id',$property_id);
				$facilityQuery = $this->db->get(PROPERTY_FACILITIES);
				
				$record['property_facility'] = array();
				if($facilityQuery->num_rows()>0){
					$record['property_facility'] =array();
					
					foreach($facilityQuery->result_array() as $fac){
						$record['property_facility'][$fac['facility_master_id']] = $fac;
					}
				}
				
				$this->db->where('property_id',$property_id);
				$policyQuery = $this->db->get(PROPERTY_POLICIES);
				
				$record['property_policy'] = array();
				if($policyQuery->num_rows()>0){
					$record['property_policy'] = array();
					foreach($policyQuery->result_array() as $policy){
						$record['property_policy'][$policy['policy_master_id']]= $policy;
					}
				}
				
				$this->db->where('property_id',$property_id);
				$this->db->order_by('image_order','ASC');
				$imageQuery = $this->db->get(PROPERTY_IMAGE);
				
				$record['property_images'] = array();
				if($imageQuery->num_rows()>0){
					$record['property_images'] = $imageQuery->result_array();
				}
			}
		}
		return $record;
	}
	
	
	
	
	
	
	
	
	public function  getPropertyImageById($property_id){
		if($property_id){
			$sql = "SELECT * 
			FROM ".PROPERTY_IMAGE." 
			WHERE property_id = '".$property_id."' " ;
			
			$rs = $this->db->query($sql);
			
			$rec = array();
			
			if($rs->num_rows()){
				$rec = $rs->result_array();
			}
			return $rec;
		}	
		
	}
	
	public function  getPropertyImageInfoId($img_id){
		if($img_id){
			$sql = "SELECT * 
			FROM ".PROPERTY_IMAGE." 
			WHERE property_image_id = '".$img_id."' " ;
			
			$rs = $this->db->query($sql);
			
			$rec = array();
			
			if($rs->num_rows()){
				$rec = $rs->result_array();
			}
			return $rec;
		}	
		
	}
	
	function updateFeature($img_id,$property_id)
	{
		echo $sql= "UPDATE ".PROPERTY_IMAGE." SET featured_image = 'No' WHERE property_id = '".$property_id."'";
		$this->db->query($sql);
		echo $sql= "UPDATE ".PROPERTY_IMAGE." SET featured_image = 'Yes' WHERE property_image_id = '".$img_id."'";
		$this->db->query($sql);
	}
	
	
	public function  getLocation($id){
		if($id){
			$rec = false;	
			$this->db->select('location_name');
			$query = $this->db->get_where($this->locationMaster,array('location_id'=>$id));
			$rs =$query->first_row();
			if ($query->num_rows)
			{
				$rec = $rs->location_name;
			}
			return $rec;
		}	
		
	}
	
	public function getContactAssociated()
	{
		$sql = "SELECT contact_id, full_name, GROUP_CONCAT(business_id) AS business_type_id
			FROM lp_contact_master
			GROUP BY contact_id";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		
		$business_type_id	= '';
		$contact_id 		= '';
		$rec1 			= false;
		$i			= 0;
		foreach($rec as $val) {
			//$business_type_id = $val['business_type_id'];
			if($contact_id != $val['contact_id'])
			{
				$sql1 = "SELECT business_type_name FROM lp_business_type_master WHERE business_type_id = '".$val['business_type_id']."'";
				$rs1  = $this->db->query($sql1);
				if($rs1->num_rows())
				{
					$rec1 				= $rs1->result_array();
					$rec[$i]['business_type_name'] 	= $rec1[0]['business_type_name'];
				}
				else
				{
					$rec[$i]['business_type_name'] 	= '';
				}
			}
		}
		
		pr($rec);
	}
	
	public function get_property_amenities($type){
		$sql = "SELECT AM.category_id, FC.featured_category_name, AM.amenities_id, AM.amenities_name, AM.backend_amenities_name, AM.amenities_slug, AM.amenities_input
			FROM  lp_amenities_master AM
			LEFT JOIN  lp_featured_category FC ON AM.category_id = FC.featured_category_id
			WHERE AM.amenities_status = 'active' AND AM.amenities_type != '".$type."'
			ORDER BY FC.featured_category_order, AM.amenities_input ASC,  AM.amenities_name ASC
			";
		
		$rec = FALSE;
		$rs = $this->db->query($sql);
		if($rs->num_rows()) {
				$rec = $rs->result_array();
		}else{
		    $rec = FALSE;
		}
		return $rec;
	}
	
	public function deleteSuitability($property_id){
		$sql = "DELETE FROM ".$this->propertySuitability." WHERE property_id = ".$property_id." ";	
		$rs = $this->db->query($sql);
		return true;
	}
	
	
	

	public function get_property_dates($property_id, $type){
		$sql = "SELECT * 
			FROM ".$this->propertyAvailibility."
			WHERE `property_id` = ".$property_id." 
			AND `avail_status` = '".$type."'
			ORDER BY avail_timestamp_format ASC
			";
		
		$rec = FALSE;
		$rs = $this->db->query($sql);
		if($rs->num_rows()) {
				$rec = $rs->result_array();
		}else{
		    $rec = FALSE;
		}
		return $rec;
	}
	
	public function empty_distance()
	{
		$sql = "UPDATE lp_property_master SET `distance_to_beach` = ''";		
		$rs = $this->db->query($sql);
		return true;
	}
	
	public function getCityList(){
		$query = $this->db->query("SELECT C.*, P.province_name FROM ".CITY.' AS C INNER JOIN '.PROVINCE_MASTER.' AS P ON  C.province_id = P.province_id ');
		$record = array();
		if($query->num_rows() > 0){
			foreach($query->result_array() as $index=>$data ){
				
				$record[ $data['province_name'] ][]=$data;
			}
		}
		return $record;
	}
	




	public function getPropertySeasonAllYears($property_id){
		$result	= array();
		$sql	= "SELECT DATE_FORMAT(season_start_date, '%Y') AS season_year FROM " . PROPERTY_PRICE . " WHERE property_id = '" . $property_id . "' GROUP BY season_year ORDER BY season_start_date";
		$query	= $this->db->query($sql);
		if($query->num_rows() > 0){
			$result		= $query->result_array();	
		}
		return $result;
	}
	
	public function getPropertySeasonYears($property_id,$year=''){
		$result	= array();
		$where="";
		if($year!=''){
			$where=" and DATE_FORMAT(season_start_date, '%Y') ='".$year."'";
		}
		$sql	= "SELECT DATE_FORMAT(season_start_date, '%Y') AS season_year FROM " . PROPERTY_PRICE . " WHERE property_id = '" . $property_id . "' ".$where." GROUP BY season_year ORDER BY season_start_date";
		
		$query	= $this->db->query($sql);
		
		if($query->num_rows() > 0){
			foreach($query->result() AS $row){
				$sql	= "SELECT * FROM " . PROPERTY_PRICE . " WHERE property_id = '" . $property_id . "' AND DATE_FORMAT(season_start_date, '%Y') = '" . $row->season_year . "' ORDER BY season_start_date";
				$query	= $this->db->query($sql);
				if($query->num_rows() > 0){
					$result[$row->season_year]	= $query->result_array();
				}
			}
		}	
		//pr($result);
		return $result;
	}
	
	public function  getPropertySeasonCount($property_id){
	
		$sql = "select * from ".PROPERTY_PRICE." where property_id='$property_id'";
		
		$rs = $this->db->query($sql);

		return ($rs->num_rows()); 
			
	}
	
	
	public function getPropertyPrice($property_id){
		$str = "SELECT P.*,R.roomtype_name FROM ".PROPERTY_PRICE." AS P, ".ROOMTYPE_MASTER." AS R WHERE P.room_type=R.roomtype_id AND P.property_id='".$property_id."' ";
		$query = $this->db->query($str);
		
		$record =array();
		if($query->num_rows()>0){
			$record= $query->result_array();
		}
		
		//pr($record);
		return $record;
	}
	
	public function getPropertyRoomType($property_id)
	{
		$str = "SELECT P.room_type FROM ".PROPERTY_PRICE." AS P, ".ROOMTYPE_MASTER." AS R WHERE P.room_type=R.roomtype_id AND P.property_id='".$property_id."' ";
		$query = $this->db->query($str);
		
		$record =array();
		//$record= $query->result_array();
		
		if($query->num_rows()>0){
			foreach($query->result_array() as $d){
				$record[] = $d['room_type'];
			}
			//$record['property_room_type'] = ;
		}
		
		//pr($record);
		return $record;
	}
	
	public function getNewPrices($result_diff){
		$record= array();
		if(is_array($result_diff) and count($result_diff)>0){
			foreach($result_diff as $r){
				$this->db->where('roomtype_id',$r);
				$this->db->select('roomtype_name');
				$q = $this->db->get(ROOMTYPE_MASTER);
				$record[$r] =$q->row_array(); 		
			}
		}
		
		return $record;
	}
	
	public function getApprovalList(&$config,&$start){
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		
		
		$sessionDataArray 			= array();
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		//$this->nsession->set_userdata('PROPERTY_MASTER_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		
		if($this->nsession->userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD')!='' AND $this->nsession->userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD')!='all'){
			$search_keyword =$this->nsession->userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD');
			$where .="  AND approval_status='".$search_keyword."' ";
		}else{
			$this->nsession->unset_userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD');
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".PROPERTY_APPROVAL." AS PA".
			$where . 
			"ORDER BY PA.approval_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT PA.*,PM.property_name,PM.property_slug,CM.city_name,CM.city_seo_slug,PP.province_name,PP.province_slug,PT.property_type_name,PT.property_type_slug
			FROM ".PROPERTY_APPROVAL." AS PA
			LEFT JOIN ".PROPERTY_MASTER." AS PM ON PA.property_id = PM.property_master_id
			LEFT JOIN ".PROPERTY_DETAILS." AS PD ON PM.property_master_id = PD.property_id
			LEFT JOIN ".PROVINCE_MASTER." AS PP ON PD.province_id = PP.province_id
			LEFT JOIN ".CITY." AS CM ON CM.city_master_id = PD.city_id
			LEFT JOIN ".PROPERTY_TYPE." AS PT ON PM.property_type_id = PT.property_type_id "
			.$where.
			"ORDER BY PA.approval_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = array();
		
		if($rs->num_rows()){
			$rec = $rs->result_array();
		}			          
		return $rec;
	}
	
	
	public function availableDate($year,$month,$property_id)
	{
	    $checkin = strtotime($year."-".$month."-01");
	    $checkout = strtotime(date('Y-m-t',$checkin));
	    
	    
	    //$checkout = strtotime(date("Y-m-d", strtotime($checkout)) . " -1 day");
	    $bookday = array();
	    $dy = '';
	    for ( $i = $checkin; $i <= $checkout; $i = $i + 86400 ) {
		$chkdate = date( 'Y-m-d', $i );
	      $sql = "SELECT * FROM hw_payment_info WHERE payment_status = 'Success' AND property_id = '".$property_id."' AND '".$chkdate."'  between check_in AND check_out";
	       //DATE_ADD(check_out, INTERVAL -1 DAY);
		$res = $this->db->query($sql);
		
		
		if($res->num_rows()>0)
		{
		    //date('d',strtotime($chkdate))
		    $row = $res->row_array();
		    $class_name = '';
		    if($row['check_in'] == $chkdate)
		    {
			$class_name .= ' chkin';
		    }
		    if($row['check_out'] == $chkdate)
		    {
			$class_name .= ' chkout';
		    }
		    else
		    {
			$class_name .= ' unavailable';
		    }
		    
		    $bookday[date('j',strtotime($chkdate))] = $class_name;		    
		    
		}
		
	    }
	    
	   return $bookday; 
	}
	
	public function getDealList(&$config,&$start,$property_id){
		$page = $this->uri->segment(4,0); //page
		//$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('DEAL_LIST');
			$search_keyword = addslashes($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= addslashes($this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= addslashes($search_keyword);
		$sessionDataArray['page']= $page;		
		$sessionDataArray['per_page']= $per_page;
		
		if($per_page)
			$config['per_page']	= $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('DEAL_LIST', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 AND property_id<>0 AND property_id=".$property_id." ";
		
		if($search_keyword != ''){
			$where.= " AND (deal_name like '%".trim($search_keyword)."%' OR price like '%".trim($search_keyword)."%')";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".DEALS."". 
			$where . 
			"
			ORDER BY deal_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
//**********************************************		

		
		$sql = "SELECT * 
			FROM ".DEALS."
			".$where."
			LIMIT ".$start.",".$config['per_page'];
			$query=$this->db->query($sql);

	$room_details	= $query->result_array();

	foreach($room_details as $k=>$roomId){
		$room_details[$k]['room_type'] = '';
		$dealTypeId= $roomId['room_type_id'];
		if($dealTypeId != ''){
		$sql = "SELECT type_name FROM ".AGENT_ROOMTYPE." WHERE id IN(".$dealTypeId.")";
		$dealsData= $this->db->query($sql);
		$room_details[$k]['room_type'] = $dealsData->result_array();
		}
	}
		//pr($room_details);

		return $room_details;

}

	public function get_city_update()
	{
		$final_array	=	array();
		$sql = "SELECT HPD.city_id,P.property_master_id
			FROM ".PROPERTY_MASTER." AS P
			INNER JOIN hw_property_details as HPD ON HPD.property_id = P.property_master_id
			WHERE
			P.agent_id= ".$this->current_user['agent_id']." 
			ORDER BY property_master_id DESC LIMIT 0,1";
		$rs 		= $this->db->query($sql);
		$user_details	= $rs->result_array();
		//pr($user_details);
		if(count($user_details) > 0 && $user_details[0]['city_id'] != '')
		{
			$city_id		= $user_details[0]['city_id'];
			$property_master_id	= $user_details[0]['property_master_id'];
		}
		else
		{
			$city_id 		= '';
			$property_master_id	= '';
		}
		
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND MONTH(HPI.added_date) = MONTH(Now())";
		$rs 	= $this->db->query($sql);
		$no_of_booking_current_month = $rs->result_array();
	
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND MONTH(HPI.added_date) = MONTH(Now()) AND HPD.property_id = '".$property_master_id."'";
		$rs 	= $this->db->query($sql);
		$our_no_of_booking_current_month = $rs->result_array();
		
		if($our_no_of_booking_current_month[0]['no_of_booking'] != 0)
			$percent_of_booking_this_month	= ($our_no_of_booking_current_month[0]['no_of_booking']/$no_of_booking_current_month[0]['no_of_booking'])*100;
		else
			$percent_of_booking_this_month	= 0;
		
	
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND MONTH(HPI.added_date) = MONTH(DATE_ADD(Now(), INTERVAL -1 MONTH))";
		$rs 	= $this->db->query($sql);
		$no_of_booking_prev_month = $rs->result_array();
		
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND MONTH(HPI.added_date) = MONTH(DATE_ADD(Now(), INTERVAL -1 MONTH)) AND HPD.property_id = '".$property_master_id."'";
		$rs 	= $this->db->query($sql);
		$our_no_of_booking_prev_month = $rs->result_array();
		
		if($our_no_of_booking_prev_month[0]['no_of_booking'] != 0)
			$percent_of_booking_prev_month	= ($our_no_of_booking_prev_month[0]['no_of_booking']/$no_of_booking_prev_month[0]['no_of_booking'])*100;
		else
			$percent_of_booking_prev_month	= 0;
			
		$final_array['city_booking_on_last_month']	=	$percent_of_booking_this_month - $percent_of_booking_prev_month;
		
		
		$sql = "SELECT COUNT(*) as no_of_booking_last_month
			FROM hw_payment_info AS HPI
			WHERE
			HPI.property_id = '".$property_master_id."' AND MONTH(HPI.added_date) = MONTH(Now())";
		$rs 	= $this->db->query($sql);
		$agent_of_booking_last_month = $rs->result_array();
		
		$sql = "SELECT COUNT(*) as no_of_booking_last_month
			FROM hw_payment_info AS HPI
			WHERE
			HPI.property_id = '".$property_master_id."' AND MONTH(HPI.added_date) = MONTH(DATE_ADD(Now(), INTERVAL -1 MONTH))";
		$rs 	= $this->db->query($sql);
		$agent_of_booking_2_month = $rs->result_array();
		
		if($agent_of_booking_2_month[0]['no_of_booking_last_month'] != 0)
			$final_array['agent_booking_on_last_month']	=	(($agent_of_booking_last_month[0]['no_of_booking_last_month'] - $agent_of_booking_2_month[0]['no_of_booking_last_month'])/$agent_of_booking_2_month[0]['no_of_booking_last_month'])*100;
		else
			$final_array['agent_booking_on_last_month']	=	$agent_of_booking_last_month[0]['no_of_booking_last_month']*100;
		
		
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND YEAR(HPI.added_date) = ".(date('Y')-1)." AND MONTH(HPI.added_date) = ".date('n');
		$rs 	= $this->db->query($sql);
		$no_of_booking_prev_year = $rs->result_array();
	
		if($no_of_booking_prev_year[0]['no_of_booking'] != 0)
			$final_array['booking_on_last_year']	= ($no_of_booking_current_month[0]['no_of_booking']/$no_of_booking_prev_year[0]['no_of_booking'])*100;
		else
			$final_array['booking_on_last_year']	= 0;
		
		
		
		
		$sql = "SELECT COUNT(*) as no_of_booking
			FROM hw_payment_info AS HPI
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPI.property_id
			WHERE
			HPD.city_id = '".$city_id."' AND YEAR(HPI.added_date) = ".(date('Y')-1)." AND MONTH(HPI.added_date) = ".date('n')." AND HPI.property_id = '".$property_master_id."'";
		$rs 	= $this->db->query($sql);
		$our_booking_prev_year = $rs->result_array();
	
		if($our_booking_prev_year[0]['no_of_booking'] != 0)
			$final_array['our_booking_on_last_year']	= ($our_no_of_booking_current_month[0]['no_of_booking']/$our_booking_prev_year[0]['no_of_booking'])*100;
		else
			$final_array['our_booking_on_last_year']	= 0;
		
		return $final_array;
	}
}