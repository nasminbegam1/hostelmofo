<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_city extends CI_Model
{
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getList(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('CITY_MASTER_SEARCH');
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
		
		$this->nsession->set_userdata('CITY_MASTER_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != ''){
			$where.= " AND city_name like '%".$search_keyword."%' ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".CITY." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT C.*,P.province_name , P.province_slug 
			FROM ".CITY.
			' AS C JOIN '.PROVINCE_MASTER.
			' AS P ON C.province_id=P.province_id'.
			$where."
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	
	public function getCityDetails($city_id){
		$record = array(); 
		if($city_id!=''){
			$sql = "SELECT C.*,P.province_name, P.province_slug 
				FROM ".CITY.
				' AS C JOIN '.PROVINCE_MASTER.
				' AS P ON C.province_id=P.province_id
				where C.city_master_id = "'.$city_id.'" 
				';
			$query = $this->db->query($sql);
			
			if($query->num_rows()>0){
				$record =$query->row_array();
			}
		}
		return $record;
		
	}
        

}