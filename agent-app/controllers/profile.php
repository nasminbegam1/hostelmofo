<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_agent');
	}
	
	public function index(){
		$this->chk_login();
		
		if($this->input->get_post('action') == 'Process'){
			$agent_id 		= trim($this->input->get_post('agent_id'));
			$firstname 		= trim($this->input->get_post('firstname'));
			$lastname 		= trim($this->input->get_post('lastname'));
			$email 			= trim($this->input->get_post('email'));
			$current_password 	= trim($this->input->get_post('current_password'));
			$password 		= trim($this->input->get_post('password'));
			$confirmpassword 	= trim($this->input->get_post('confirm_password'));

			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email id', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'callback_password_check');
			
			if($password!='' && $confirmpassword==''){
				$this->nsession->set_userdata('errmsg', "Please enter confirm password.");
				redirect(AGENT_URL."profile/");
				
			}elseif(($password!='' && $confirmpassword!='')){
				if($current_password==''){
					$this->nsession->set_userdata('errmsg', "Please enter your current password.");
				        redirect(AGENT_URL."profile/");
				}else{
					$rs = $this->model_agent->getSingle();
					if($rs->password!=$current_password){
						$this->nsession->set_userdata('errmsg', "Current password not matched.");
						redirect(AGENT_URL."profile/");
					}
				}
				if($password!=$confirmpassword){
					$this->nsession->set_userdata('errmsg', "Confirm password doesn't matched.");
				        redirect(AGENT_URL."profile/");
				}

			}
			
			if ($this->form_validation->run() == FALSE){
                            $this->nsession->set_userdata('errmsg', validation_errors());			
                            //redirect(ADMIN_URL."sitesettings/");
                            //return true;
			}
                        else  
                        {
				$updateData = array(
				        'firstname' 	=> $firstname,
					'lastname' 	=> $lastname,
					'email' 	=> $email, 
					);
				if($password!='' && $confirmpassword!=''){
					$updateData['password'] = $password;
				}
			
				$this->model_basic->updateIntoTable(AGENT,array('agent_id'=>$agent_id),$updateData);
				$this->nsession->set_userdata('succmsg', "Updated successfully.");
				$this->current_user['firstname'] = $firstname;
				$this->current_user['lastname'] = $lastname;
			}
				
			
			
		}
		
                $row = array();
		$rs = $this->model_agent->getSingle();
                if($rs->agent_id){
                   $this->data['agent_details'] = $rs;
                }else{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(ADMIN_URL.$this->data['controller']."/dashboard/");
                        return false;
                }
		//$this->data['getSingle']	= $this->model_salons->getSingle($salon_id);
		$this->data['base_url'] 	= base_url();
		$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$brd_arr[] = array('link'=>$this->data['base_url'], 'text' => 'Dashboard','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Profile' );
		//pr($this->data);
		$this->data['breadcrumbs'] = $brd_arr;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar();
		$this->elements['middle']='profile/index';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
	function password_check($password){
		if($password != ''){
		if(strlen($password)<8){
		    $this->form_validation->set_message('password_check', 'The password should be 8 charecter');
		    return FALSE;
		}else if(!preg_match('/\d/', $password)){
		    $this->form_validation->set_message('password_check', 'The password should contain at least 1 uppercase letter, 1 lowercase letter, a number');
		    return FALSE;
		}else if(!preg_match('/[a-z]/', $password)){
		    $this->form_validation->set_message('password_check', 'The password should contain at least 1 uppercase letter, 1 lowercase letter, a number');
		    return FALSE;
		}else if(!preg_match('/[A-Z]/', $password)){
		    $this->form_validation->set_message('password_check', 'The password should contain at least 1 uppercase letter, 1 lowercase letter, a number');
		    return FALSE;
		}else if(preg_match('/[^0-9a-zA-Z]/', $password)){
		    $this->form_validation->set_message('password_check', 'The password should contain at least 1 uppercase letter, 1 lowercase letter, a number');
		    return FALSE;
		}else{
		    return TRUE;
		}
		}
		return TRUE;
	}
	

	
	
}