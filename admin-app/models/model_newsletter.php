<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_newsletter extends CI_Model
{
	var $newsletter	= 'hw_newsletter';
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	   
	}

	public function getTeamList(&$config,&$start, $recordType='')
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('NEWSLETTER');
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
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('NEWSLETTER', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		
		if($search_keyword != ''){
			$where.= " AND (first_name like '%".$search_keyword."%' 
					OR email like '%".$search_keyword."%' 
					)
				 ";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".NEWSLETTER." AS TMT".
			$where;
			
		//echo $sql;die();
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT *
			FROM ".NEWSLETTER." AS TMT".
			$where."
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;die();
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
        
    }
?>