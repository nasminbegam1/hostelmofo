<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_salonusers extends CI_Model
{
	var $salonUserTable = 'bs_salon_users';
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
		{	$param		= $this->nsession->userdata('SALONSETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
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
		
		$this->nsession->set_userdata('SALONSETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($search_keyword != ''){
			$where.= " AND (salon_name like '%".$search_keyword."%' OR salon_status like '%".$search_keyword."%' ) ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->salonUserTable." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ".$this->salonUserTable.$where."  LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	
	
	public function getSingle($id)
	{
		$sql = "SELECT * FROM ".$this->salonUserTable." WHERE templete_id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;		
	}

	public function getSingle5($id)
	{
		$sql = "SELECT * FROM ".$this->salonUserTable." WHERE salon_id = '".$id."' and users_type = 5";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;		
	}	
	
	public function updateOption($id)
	{
		//$sitesettings_lebel 	= $this->input->get_post('sitesettings_lebel');
		$content	= $this->input->get_post('email_content');
		
		$sql = "UPDATE ".$this->salonUserTable." SET email_content = '".addslashes(trim($content))."',updated_on = CURRENT_TIMESTAMP() WHERE templete_id = '".$id."'";
		$this->db->query($sql);
		
		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on banner insert: ".$sql);
			return false;
		}
		
		return true;
	}
	
	public function updateStatus($id)
	{
		//$sitesettings_lebel 	= $this->input->get_post('sitesettings_lebel');
		$salonstatus	= $this->input->get_post('salon_status');
		if($salonstatus=='approved')
		$salonstatus = 'Active';
		else
		$salonstatus = 'Inactive';
		
		$sql = "UPDATE ".$this->salonUserTable." SET users_status = '".addslashes(trim($salonstatus))."', updated_at = CURRENT_TIMESTAMP() WHERE salon_id = '".$id."' and users_type = 5";
		$this->db->query($sql);
		
		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on banner insert: ".$sql);
			return false;
		}
		
		return true;
	}
	
	public function getUserByEmail($email='') // get user details by email
	{
		$rec = array();
		$sql = "SELECT * FROM ".$this->salonUserTable." WHERE users_email = '".$email."' AND users_type=5";
		$rs  = $this->db->query($sql);
		$rec = $rs->row_array();
		if($rs->num_rows())
		{
			$rec = $rs->result_array();
		}
		return $rec;
	}	
}