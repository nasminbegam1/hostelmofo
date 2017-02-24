<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_property extends CI_Model
{
	var $propertyTable		= 'lp_property_master';
	var $propertyTypeMasterTable	= 'lp_property_type_master';
	var $ownerMasterTable		= 'lp_owner_master';
	var $contactMaster 		= 'lp_contact_master';
	var $propertySuitability	= 'lp_property_suitability';
	var $Amenities 			= 'lp_amenities_master';
	var $Rent 			= 'lp_rent_master';
	var $propertyAvailibility	= 'lp_property_availibility';
	var $locationMaster		= 'lp_location_master';
	
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
		{	$param		= $this->nsession->userdata('PROPERTY_MASTER_SEARCH');
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
		
		$this->nsession->set_userdata('PROPERTY_MASTER_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($search_keyword != ''){
			$where.= " AND (P.property_name like '%".$search_keyword."%' )";
		}
		
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".PROPERTY_MASTER." AS P".
			$where . 
			"ORDER BY property_master_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT P.*,PP.province_name,CM.city_name,CM.city_seo_slug,PP.province_name,PP.province_slug,PT.property_type_name,PT.property_type_slug,PD.email_address_booking,AG.*
			FROM ".PROPERTY_MASTER." AS P
			LEFT JOIN ".PROPERTY_DETAILS." AS PD ON P.property_master_id = PD.property_id
         LEFT JOIN ".AGENT." as AG ON P.agent_id = AG.agent_id 
			LEFT JOIN ".PROVINCE_MASTER." AS PP ON PD.province_id = PP.province_id
			LEFT JOIN ".CITY." AS CM ON CM.city_master_id = PD.city_id
			LEFT JOIN ".PROPERTY_TYPE." AS PT ON P.property_type_id = PT.property_type_id "
			.$where.
			"ORDER BY P.property_master_id DESC
			LIMIT ".$start.",".$config['per_page'];
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
   
   public function get_property_details_view($property_id){
    $where	= " WHERE P.property_master_id='".$property_id."'";
    
   $sql = "SELECT P.property_name,P.phone_no AS property_phone_no,P.status,P.rank,PD.address,PD.contact_name,PD.licensee_name,PD.direction,PD.location,PD.cancellation_policy,AG.agent_id,AG.firstname,AG.lastname,AG.gender,AG.email
			FROM ".PROPERTY_MASTER." AS P
			LEFT JOIN ".PROPERTY_DETAILS." AS PD ON P.property_master_id = PD.property_id
         LEFT JOIN ".AGENT." as AG ON AG.agent_id = P.agent_id"
		.$where;

    
    
    $rs = $this->db->query($sql);
    $rec = $rs->row_array();
    

    $sql2 = "SELECT * FROM hw_property_image WHERE property_id='".$property_id."'";
    $rs = $this->db->query($sql2);
    //if($rs->num_rows()){
        $rec['images'] = $rs->result_array();
    ///}
    return $rec;
    
   }
   
   
	/*** Owner Master Master ***/
	public function getPropertyList(&$config,&$start, $recordType='')
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->session->userdata('PROPERTY');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= $this->input->get_post('search_keyword',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('PROPERTY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($recordType != '')
		{
			$where	.= " AND (p.record_type =  '".ucfirst($recordType)."' OR p.record_type='Both')";	
		}
		
		if($search_keyword != ''){
			$where.= " AND (p.property_name like '%".$search_keyword."%' 
					OR p.page_title like '%".$search_keyword."%' 
					OR p.property_slug like '%".$search_keyword."%' 
					OR p.optional_title like '%".$search_keyword."%' 
					OR p.seo_title like '%".$search_keyword."%' 
					OR ptm.property_name like '%".$search_keyword."%'
					OR om.first_name like '%".$search_keyword."%'
					OR om.last_name like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".$this->propertyTable." AS p
			LEFT JOIN ".$this->propertyTypeMasterTable." AS ptm ON p.property_id = ptm.property_type_id
			LEFT JOIN ".$this->locationMaster." AS l ON l.location_id = p.location_id
			LEFT JOIN ".$this->ownerMasterTable." AS om ON p.owner_id = om.owner_id".
			
			$where . 
			"ORDER BY property_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT p.property_id, p.property_name, p.page_title, p.optional_title, p.record_type, ptm.property_name as property_type_name,
			CONCAT(om.first_name, ' ', om.last_name) AS owner_name, om.owner_id,p.location_id as location_id, p.status
			FROM ".$this->propertyTable." AS p
			LEFT JOIN ".$this->propertyTypeMasterTable." AS ptm ON p.property_type_id = ptm.property_type_id
			LEFT JOIN ".$this->locationMaster." AS l ON l.location_id = p.location_id
			LEFT JOIN ".$this->ownerMasterTable." AS om ON p.owner_id = om.owner_id".
			$where."
			ORDER BY property_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
				if(is_array($rec)){
				foreach($rec as $key=>$r){
				$image_file_name = $this->getPropertyImageById($r['property_id']);
				$rec[$key]['image_file_name'] = $image_file_name;
				$location_name = $this->getLocation($r['location_id']);
				$rec[$key]['location_name'] = $location_name;
			}
		}
			          
		return $rec;
	}
	
	
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
		$sql= "UPDATE ".PROPERTY_IMAGE." SET featured_image = 'NO' WHERE property_id = '".$property_id."'";
		$this->db->query($sql);
		$sql= "UPDATE ".PROPERTY_IMAGE." SET featured_image = 'Yes' WHERE property_image_id = '".$img_id."'";
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
	
	public function getQuery(&$config,&$start,$property_id){
		$page 		= $this->uri->segment(5,0); //page		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('QUERY_SEARCH');
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
		
		$this->nsession->set_userdata('QUERY_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 AND F.property_id= ".$property_id." ";
		
		if($search_keyword != ''){
			$where.= " AND (F.comments like '%".$search_keyword."%' OR F.feedback_id ='".$search_keyword."' OR F.email like '%".$search_keyword."%') ";
		}
		
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".FEEDBACK." AS F INNER JOIN ".PAYMENT_INFO." PI ON F.payment_id=PI.paymeny_id".
			$where . 
			"ORDER BY feedback_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT F.comments,F.feedback_id,PI.first_name,PI.last_name,PI.email
			FROM ".FEEDBACK." AS F INNER JOIN ".PAYMENT_INFO." PI ON F.payment_id=PI.paymeny_id"
			.$where.
			"ORDER BY F.feedback_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = array();
		
		if($rs->num_rows()){
			$rec = $rs->result_array();
		}
		return $rec;
		
    }
    
    
    public function agent_list(){
        $rec = false;
        $sql = "SELECT * FROM ".AGENT. " WHERE agent_id NOT IN (SELECT DISTINCT `agent_id` FROM ".PROPERTY_MASTER. " WHERE 1) ORDER BY email";
        $rs = $this->db->query($sql);
        if($rs->num_rows()){
            $rec = $rs->result_array();
        }
        return $rec;
    }

	

}