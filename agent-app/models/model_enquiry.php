<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_enquiry extends CI_Model
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;
	var $propertyMaster	= PROPERTY_MASTER;
	var $contactMaster	= CONTACT;
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getAllEnquiryList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0);
		$isSession	= $this->uri->segment(4);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('ENQUIRY');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ENQUIRY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE pm.agent_id = '.$this->current_user['agent_id'];
		
		if($search_keyword != ''){
			$where.= " AND (em.contact_name like '%".$search_keyword."%'
					OR em.email_address like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryMaster."
			AS em 
			INNER JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_master_id ".$where."";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT em.*, pm.property_name, pm.property_slug ,pp.province_slug,pc.city_slug,pc.city_seo_slug
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_master_id
			LEFT JOIN ".PROPERTY_DETAILS." AS pd ON pd.property_id=pm.property_master_id
			LEFT JOIN ".PROVINCE_MASTER." AS pp ON pp.province_id=pd.province_id
			LEFT JOIN ".CITY." AS pc ON pc.city_master_id=pd.city_id ".
			$where." 
			GROUP BY em.enquiry_id
			ORDER BY em.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];
//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	

	public function getEnquiryDetails($enquiry_id)
	{
		$sql = "SELECT em.*, pm.property_name,pm.property_slug,pp.province_slug,pc.city_slug,pc.city_seo_slug
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_master_id
			LEFT JOIN ".PROPERTY_DETAILS." AS pd ON pd.property_id=pm.property_master_id
			LEFT JOIN ".PROVINCE_MASTER." AS pp ON pp.province_id=pd.province_id
			LEFT JOIN ".CITY." AS pc ON pc.city_master_id=pd.city_id 
			WHERE em.enquiry_id = '".$enquiry_id."'";

		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	public function changeEnquiryRead($id)
	{
		$sql = "UPDATE ".$this->enquiryMaster." SET enquiry_read = 'Read' WHERE enquiry_id = '".$id."'";
		$this->db->query($sql);
		return true;
	}
}


