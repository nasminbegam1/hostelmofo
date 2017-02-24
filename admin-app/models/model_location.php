<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_location extends CI_Model
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
		{	$param		= $this->nsession->userdata('FAV_LOCATION_SEARCH');
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
		
		$this->nsession->set_userdata('FAV_LOCATION_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($search_keyword != ''){
			$where.= " AND (L.location_name like '%".$search_keyword."%' )";
		}
		
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".FAV_LOCATION." AS P".
			$where . 
			"ORDER BY location_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT L.*
			FROM ".FAV_LOCATION." AS L "
			.$where.
			"ORDER BY L.location_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = array();
		
		if($rs->num_rows()){
			$rec = $rs->result_array();
			if(is_array($rec)){
				foreach($rec as $key=>$r){
					$image_file_name = $this->getPropertyImageById($r['location_id']);
					$rec[$key]['images'] = $image_file_name;
				}
			}
		}			          
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
	


}