<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_contact extends CI_Model
{
	
	var $contactMaster	= CONTACT;

	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getAllContactList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0);
		$isSession	= $this->uri->segment(4);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('CONTACT');
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
		
		$this->nsession->set_userdata('CONTACT', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR contact_email like '%".$search_keyword."%'
					
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->contactMaster." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT *
			FROM ".$this->contactMaster.$where."
			ORDER BY contact_us_id DESC
			LIMIT ".$start.",".$config['per_page'];
                //echo $sql; 
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
        
}
?>