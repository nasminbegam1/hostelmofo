<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_agent extends CI_Model
{
	var $agent = 'hw_agent'; 
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	public function get_email_existence($email, $id, $type='admin'){
		if($id > 0){
			
			$this->db->where('email',$email);
			$this->db->where('agent_id <> ',$id);
		}else{
			$this->db->where('email',$email);
		}	
		$query = $this->db->get($this->agent);
		
		if ($query->num_rows() > 0){
		    return false;
		}else{
			
		    return true;
		}
	}
	
	
	public function get_list(&$config,&$start, $type = 'admin'){
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
				$param			= $this->nsession->userdata('ADMIN_USER');
			else
				$param			= $this->nsession->userdata('VA_USER');
				
			$search_keyword 	= trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword		= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 		= $search_keyword;
		$sessionDataArray['page']	 		= $page;		
		$sessionDataArray['per_page'] 			= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
			$this->nsession->set_userdata('ADMIN_USER', $sessionDataArray);
		else if($type == 'agent')
			$this->nsession->set_userdata('AGENT', $sessionDataArray);
			//else if($type == 'rental')
			//	$this->nsession->set_userdata('RENTAL_USER', $sessionDataArray);	
		else
			$this->nsession->set_userdata('VA_USER', $sessionDataArray);
		
		$start 			= 0;
		$where 			= ' WHERE 1 ';
				
		if($search_keyword != ''){
			$where.= " AND (firstname like '%".$search_keyword."%'
					 	OR lastname like '%".$search_keyword."%' 
						OR email like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->agent." ".$where." ";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT u.* FROM ".$this->agent." AS u  ".$where."  LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		         
		return $rec;
	}
	
	public function addAgent() {
		$dob = $this->input->post('dob');
		$firstname      = strip_tags(addslashes(trim($this->input->get_post('firstname'))));
		$lastname       = strip_tags(addslashes(trim($this->input->get_post('lastname'))));
		$dob 		= $dob['year'].'-'.$dob['month'].'-'.$dob['day'];
		$gender		= strip_tags(addslashes(trim($this->input->get_post('gender'))));
		$location	= strip_tags(addslashes(trim($this->input->get_post('location'))));	
		$nationality	= strip_tags(addslashes(trim($this->input->get_post('nationality'))));
		$email		= strip_tags(addslashes(trim($this->input->get_post('email'))));
		$password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
		
		$sql = "INSERT INTO `".$this->agent."` 
			SET 
			firstname = '".$firstname."',
			lastname = '".$lastname."', 
			dob = '".$dob."',
			gender = '".$gender."',
			location = '".$location."',
			nationality = '".$nationality."',
			email = '".$email."',
			password = '".$password."', 
			added_on    = '".date('Y-m-d H:s:i')."'";
		$this->db->query($sql);
		return true;
	}
	
	public function get_single($id){
		$sql = "SELECT * FROM ".$this->agent." WHERE agent_id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function updateAgent($id) {
		$dob = $this->input->post('dob');
		$firstname      = strip_tags(addslashes(trim($this->input->get_post('firstname'))));
		$lastname       = strip_tags(addslashes(trim($this->input->get_post('lastname'))));
		$dob 		= $dob['year'].'-'.$dob['month'].'-'.$dob['day'];
		$gender		= strip_tags(addslashes(trim($this->input->get_post('gender'))));
		$location	= strip_tags(addslashes(trim($this->input->get_post('location'))));	
		$nationality	= strip_tags(addslashes(trim($this->input->get_post('nationality'))));
		$email		= strip_tags(addslashes(trim($this->input->get_post('email'))));
		$password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
		if($password != ''){
			$password = ",password = '".$password."'";
		}else{
			$password = '';
		}
		$sql = "UPDATE ".$this->agent." 
			SET 
			firstname = '".$firstname."',
			lastname = '".$lastname."', 
			dob = '".$dob."',
			gender = '".$gender."',
			location = '".$location."',
			nationality = '".$nationality."',
			email = '".$email."' ".$password."
			WHERE agent_id = '".$id."'";
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
	
	public function deleteAgent($id){
		$sql = "DELETE FROM ".$this->agent." WHERE agent_id = '".$id."'";
		$this->db->query($sql);
		return true;
	}
	
	public function deleteBatchAgent(){
		$error		= false;
		$apply_action	= $this->input->get_post('group_mode');
		$pagearray	= $this->input->get_post('page');
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($apply_action)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){
			if($apply_action == 'Delete'){
				$sql = "DELETE FROM ".$this->agent." WHERE FIND_IN_SET(agent_id, '".implode(",", $pagearray)."')";
				$this->db->query($sql);
				return 'delsuccess';
			}
		}
	}	
	
	public function statusBatchAgent($status){
		$error			= false;
		$apply_action	= $this->input->get_post('group_mode',true);
		$pagearray		= $this->input->get_post('page',true);		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($apply_action)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){
			if($apply_action == 'Activate'){
				$sql = "UPDATE ".$this->agent." 
						SET status = 'Active',
						updated_on = NOW()
						WHERE FIND_IN_SET(agent_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'active';
			}
			
			if($apply_action == 'Inactivate'){
				$sql = "UPDATE ".$this->agent." 
						SET status = 'Inactive',
						updated_on = NOW()
						WHERE FIND_IN_SET(agent_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'inactive';
			}
		}
	}
	
}