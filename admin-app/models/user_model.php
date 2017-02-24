<?php


class User_model extends CI_Model{
    
    var $adminUser = 'hw_adminuser'; 
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
    
    
   // var user="";
    function get_list($type='admin'){
       $sql = "SELECT u.* FROM ".ADMINUSER." AS u  WHERE u.role = '".$type."'";
		
		$rs = $this->db->query($sql);
		$rec = false;
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
    }
    
    
    public function updateAdminUsersProfile($id,$user_image='',$type = 'admin') {
		$sql_image          = '';
		$first_name 	= strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		$last_name 	= strip_tags(addslashes(trim($this->input->get_post('last_name'))));
		$role_id        = $type;
    
		$sql_image = '';
                $sql_image = '';
		if($user_image != "")
		{
			$sql_image .= " ,image = '".addslashes(trim($user_image))."'";
		}
		$sql = "UPDATE ".ADMINUSER." 
			SET
			first_name = '".$first_name."', 
			last_name = '".$last_name."',
                        role = '".$role_id."',
			updated_on = '".date('Y-m-d H:i:s')."'".$sql_image."
			WHERE admin_id = '".$id."'";
		
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
        
        public function updateAdminUsersAccount($id,$type = 'admin') {
		
		
		$email_address 	= strip_tags(addslashes(trim($this->input->get_post('email_address'))));
		$password 	= strip_tags(addslashes(trim($this->input->get_post('password'))));
		$role_id        = $type;
                
		$sql = "UPDATE ".ADMINUSER." 
			SET
			role = '".$role_id."',
			email_id = '".$email_address."',
			password = '".$password."',
			updated_on = '".date('Y-m-d H:i:s')."'
			WHERE admin_id = '".$id."'";
		
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
        public function updateAdminUsersContact($id,$type = 'admin') {
		
		$phone_no 	= strip_tags(addslashes(trim($this->input->get_post('phone_no'))));
		$skype_id 	= strip_tags(addslashes(trim($this->input->get_post('skype_id'))));
                $role_id        = $type;
		if(isset($phone_no) && $phone_no!= '')
			$phone_no = $phone_no;
		else
			$phone_no = '';
			
		if(isset($skype_id) && $skype_id!= '')
			$skype_id = $skype_id;
		else
			$skype_id = '';
		
		
		$sql = "UPDATE ".ADMINUSER." 
			SET
			phone_no = '".$phone_no."', 
			skype_id = '".$skype_id."',
			role = '".$role_id."',
			updated_on = '".date('Y-m-d H:i:s')."'
			WHERE admin_id = '".$id."'";
		
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
}

?>