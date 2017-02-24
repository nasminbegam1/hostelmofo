<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_faq extends CI_Model
{
	
	var $faqMaster = 'hw_faq_master';
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
		{	$param		= $this->nsession->userdata('FAQ');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else
		{
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
		
		$this->nsession->set_userdata('FAQ', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != '')
		{
			$where.= " AND faq_title like '%".$search_keyword."%' OR faq_type like '%".$search_keyword."%'";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".FAQ." ".$where." ";
		//echo $sql; die;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT faq_id,faq_title,faq_type,faq_status,faq_order
			FROM ".FAQ.$where." ORDER BY faq_order ASC,faq_title ASC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; die;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function get_single($id)
	{
		$sql = "SELECT * FROM ".FAQ." WHERE faq_id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function getAllfaqs()
	{
		
		$sql = "SELECT DISTINCT faq_order FROM ".FAQ." ORDER BY faq_order ASC";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	
	
	
}