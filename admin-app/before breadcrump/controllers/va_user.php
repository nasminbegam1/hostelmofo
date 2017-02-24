<?php

class Va_user extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
       // $this->load->model("user_model");
        $this->load->model("model_adminuser");
    }
    
    
    /* ****************  VA ADMIN ************* */
    public function vauser(){
        chk_login();
        $this->data='';
        //$logged_id=$this->nsession->userdata('admin_id');
        $config['base_url'] 			= BACKEND_URL."va_user/vauser/";
        $config['per_page'] 			= 20;
        $config['uri_segment']  		= 3;
        $config['num_links'] 			= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
        $this->data['search_keyword']	= '';
        $this->data['per_page']		= '';
        $this->data['params']			= $this->nsession->userdata('VA_USER');
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
        {	
                $this->data['search_keyword'] = $this->data['params']['search_keyword'];
                $this->data['per_page'] 		= $this->data['params']['per_page'];
        }
        else 
        {
                $this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
                $this->data['per_page'] 		= $this->input->get_post('per_page',true);	
        }
		
        
        $this->data['adminList'] = $this->model_adminuser->get_list($config,$start,'va');
           
        //$brdArr	= array( "User" => 'javascript:void(0)',  "VA"=>BACKEND_URL."va_user/vauser");
        $this->data['brdLink']='';
        $start 				= 0;
        $page				= $this->uri->segment(3,0);
        $this->data['startRecord'] 		= $start;
        $this->data['totalRecord'] 		= $config['total_rows'];
        $this->data['per_page'] 	 	= $config['per_page'];
        $this->data['page'] 	 		= $page;	
                
        $this->data['controller'] 		= 'va_user';	
        $this->data['base_url'] 	        = BACKEND_URL.$this->data['controller']."/vauser";
        $this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/vauser/";
        $this->data['add_link']           	= BACKEND_URL.$this->data['controller']."/addvauser/0/".$page."/";
        $this->data['edit_link']        	= BACKEND_URL.$this->data['controller']."/editvauser/{{ID}}/".$page."/";
	$this->data['delete_link']        	= BACKEND_URL.$this->data['controller']."/deletevauser/{{ID}}/".$page."/";
	
	 $this->pagination->initialize($config);
	$this->data['pagination'] = $this->pagination->create_links();
       
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	 //$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
	 $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
         $this->elements['middle']='vauser/valist';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
      
    }
    
    function addvauser(){
        chk_login();
        $page = $this->uri->segment(4, 0);
	//$logged_id=$this->nsession->userdata('admin_id');
        //$type=$this->nsession->userdata('role');
        $this->data='';
        
        if($this->input->get_post('action') == 'Process'){
            
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_is_name_pair_exists');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
			//$this->form_validation->set_rules('role', 'User Role', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				
			}
                        else
                        {
                            
				$user_image = '';
                                
				if ($_FILES['user_image']['name'] != ""){
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'admin/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= '';
					$thumb_config['thumb_height']		= '';
					
					//$user_image = '';
					$sUploaded = image_upload($upload_config, $thumb_config);
                                        
					if($sUploaded == '')
					{
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."va_user/vauser/".$page);
						return false;
					}
					else
					{
						$user_image = $sUploaded;
                                               
						$this->model_adminuser->addAdminUsers($user_image,'va');
						$this->nsession->set_userdata('succmsg', "VA user added successfully.");		
						redirect(base_url()."va_user/vauser/".$page);
						return true;
					}
				}
				else {
                                    
					$this->model_adminuser->addAdminUsers('','va');
					$this->nsession->set_userdata('succmsg', "VA user added successfully.");			
					redirect(base_url()."va_user/vauser/".$page);
					return true;
				}                    
			}
		}
        
        $this->data['base_url'] = BACKEND_URL."va_user/vauser";
	$this->data['add_url'] = BACKEND_URL."va_user/addvauser/0/".$page."/";
	
        //$brdArr	= array( "User" => 'javascript:void(0)',  "Add"=>BACKEND_URL."va_user/addvauser/0/".$page."/");
        $this->data['brdLink']='';
	 //$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
	 $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='vauser/addvauser';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function editvauser()
    {
        chk_login();
        $uId 	= $this->uri->segment(3, 0);
	//$logged_id=$this->nsession->userdata('admin_id');
        $page = $this->uri->segment(4, 0);
        $type=$this->nsession->userdata('role');
        $this->data='';
        
         if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_is_name_pair_exists');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
			//$this->form_validation->set_rules('role', 'User Role', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
                        {
				
			}
                        else
                        {
				$user_image = '';
				if ($_FILES['user_image']['name'] != ""){
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'admin/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= '';
					$thumb_config['thumb_height']		= '';
					
					$user_image = '';
					$sUploaded = image_upload($upload_config, $thumb_config);
					$user_image = $sUploaded;
					
					$arr_user_image_old = $this->model_adminuser->get_single($uId);
					$user_image_old     = $arr_user_image_old[0]['image'];
					
					if($sUploaded == '')
					{
						$this->nsession->set_userdata('errmsg', $this->nsession->userdata('upload_err'));
						$this->nsession->set_userdata('upload_err', '');
						redirect(base_url()."va_user/vauser/".$page);
						return false;
					}
					else
					{
						if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != ""){
							unlink(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.stripslashes($user_image_old));
							unlink(FILE_UPLOAD_ABSOLUTE_PATH.'admin/thumb/'.stripslashes($user_image_old));
						}
						$this->model_adminuser->updateAdminUsers($uId, $user_image, 'va');
						$this->nsession->set_userdata('succmsg', "Admin user updated successfully.");		
						redirect(base_url()."va_user/vauser/".$page);
						return true;
					}
				}
				else {
					$this->model_adminuser->updateAdminUsers($uId,'','va');
					$this->nsession->set_userdata('succmsg', "VA user updated successfully.");			
					redirect(base_url()."va_user/vauser/".$page);
					return true;
				}
			}
		}
        
        
	$this->data['user_info'] = $this->model_adminuser->get_single($uId);		
		
        $this->data['base_url'] = BACKEND_URL."va_user/vauser";
	$this->data['edit_url'] = BACKEND_URL."va_user/editvauser/".$uId."/".$page."/";
	
        //$brdArr	= array( "User" => 'javascript:void(0)',  "Edit"=>BACKEND_URL."va_user/editvauser/".$uId."/".$page."/");
        $this->data['brdLink']='';
	 //$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
	 $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='vauser/vauseredit';
	
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    	public function batch_action(){
		chk_login();
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
			
		if($action == 'Delete'){
				$this->deletebatch();
		} else if($action == 'Activate'){
				$this->batchstatus('Activate');
		} else if($action == 'Inactivate'){
				$this->batchstatus('Inactivate');
		} else {
				$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."va_user/vauser/".$per_page1);
		return true;
			
	}
	
        public function deletevauser(){
		chk_login();
		
		$uId 	= $this->uri->segment(3, 0);
		$page 	= $this->uri->segment(4, 0); 
		$this->model_adminuser->deleteAdminUser($uId);
		$this->nsession->set_userdata('succmsg', "VA user deleted successfully.");			
		redirect(base_url()."va_user/vauser/".$page);
		return true;
	}
        
	private function deletebatch(){
		
		chk_login();
		$return = $this->model_adminuser->deleteBatchAdminUsers();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Select va users deleted successfully.");
		}
		return true;
	}
		
	private function batchstatus($status){
		chk_login();
		if($status == '')
			return false;
		
		$return = $this->model_adminuser->statusBatchAdminUsers($status);
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Select va users status Activated successfully.");
		}elseif($return == 'inactive'){
			$this->nsession->set_userdata('succmsg', "Select va users status Deactivated successfully.");
		}
		return true;
	}
        
        function is_email_exists($email){
	         chk_login();
		$id 	= $this->uri->segment(3, 0);
               // $type=$this->nsession->userdata('role');
		$bool = $this->model_adminuser->get_email_existence($email, $id, 'va');
		if(!$bool){
			$this->form_validation->set_message('is_email_exists', 'The %s already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function is_name_pair_exists($lastname){
	        chk_login();
		$id 	= $this->uri->segment(3, 0);
                //$type=$this->nsession->userdata('role');
		$bool = $this->model_adminuser->checkNamePairExists($lastname, $id, 'va');
		if(!$bool){
			$this->form_validation->set_message('is_name_pair_exists', 'The first name & last name pair already exits');
			return FALSE;
		}else{
			return TRUE;
		}		
	}
    

}

?>