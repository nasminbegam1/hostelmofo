<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_property_facility extends CI_Model
{
	var $propertyTypeTable		= 'lp_property_type_master';
	var $amenitiesMasterTable	= 'hw_amenities_master';
	var $documentTypeMasterTable 	= 'lp_document_type_master';
	var $featuredCategoryTable 	= 'hw_featured_category';
	var $buyingMasterTable 		= 'lp_buying_master';
	var $leadTypeMasterTable	= 'lp_lead_type_master';
	var $seasonMasterTable		= 'lp_season_master';
	var $suitabilityMaster          = 'lp_suitability_master';
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getFacilityDetails($id){
		$record = array();
		if($id){
			$this->db->where('amenities_id',$id);
			$query = $this->db->get(FACILITIES);
			if($query->num_rows()>0){
				$record = $query->row_array();
				$record['category']=array();
				
				$this->db->where('featured_category_id',$record['category_id']);
				$query1 = $this->db->get(FEATURED_CATEGORY);
				if($query1->num_rows()>0){
					$record['category']= $query1->row_array();
				}
			}
		}
		return $record;
	}
	
	
	
	/***** Amenities *****/
	public function getFacilitiesList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('AMENITY_SEARCH');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= $this->input->get_post('search_keyword',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		$search_keyword = trim($search_keyword);
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('AMENITY_SEARCH', $sessionDataArray);		
		
		$start 			= 0;
		$where 			= '';
		
		if($search_keyword != ''){
			$where.= " AND am.amenities_name like '%".$search_keyword."%'";
		}
		
		$sql	= "SELECT COUNT(*) as TotalrecordCount FROM ".FACILITIES." AS am
			   INNER JOIN ".FEATURED_CATEGORY." AS fc ON am.category_id = fc.featured_category_id".$where;
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'])
			$start = $page;
		
		$config['start'] = $start;
		
		$sql	= "SELECT am.amenities_id, am.amenities_name, am.backend_amenities_name, am.amenities_status, am.left_bar_order, am.amenities_filter, fc.featured_category_name FROM ".FACILITIES." AS am
			   INNER JOIN ".FEATURED_CATEGORY." AS fc ON am.category_id = fc.featured_category_id".
			   $where."
			   ORDER BY am.amenities_name ASC
			   LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
		
		
}