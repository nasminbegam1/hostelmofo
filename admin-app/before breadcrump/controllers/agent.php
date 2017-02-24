<?php
class Agent extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
      
        $this->load->model("model_adminuser");
    }
    
    public function index()
    {
        chk_login();
        $this->data='';
        //<!------------------------code----------------------------------->
        $config['base_url'] 	= BACKEND_URL."agent/index/";
        $config['per_page'] 	= 10;
        $config['uri_segment']	= 3;
        $config['num_links'] 	= 20;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
        $this->data['search_keyword']	= '';
        $this->data['per_page']	= '';
        $this->data['params']		= $this->nsession->userdata('AGENT');
        
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
        {	
                $this->data['search_keyword'] = $this->data['params']['search_keyword'];
                $this->data['per_page']	= $this->data['params']['per_page'];
        }
        else 
        {
                $this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
                $this->data['per_page'] 	= $this->input->get_post('per_page',true);	
        }
        
        $start 				= 0;
        $page 				= $this->uri->segment(3,0);
        $this->data['userList'] 		= $this->model_adminuser->get_list($config,$start,'agent');
        $this->data['brdLink']='';
        
        $this->data['startRecord'] 		= $start;
        $this->data['totalRecord'] 		= $config['total_rows'];
        $this->data['per_page'] 		= $config['per_page'];
        $this->data['page']	 		= $page;
        $this->data['controller'] 		= 'agent';	
        $this->data['base_url'] 		= BACKEND_URL."agent/index";				
        $this->data['show_all']      		= BACKEND_URL."agent/index";
        $this->data['add_link']      		= BACKEND_URL."agent/addagent/0/".$page."/";
        $this->data['edit_link']      		= BACKEND_URL."agent/editagent/{{ID}}/".$page."/";
        $this->data['delete_link']		= BACKEND_URL."agent/delete_agent_master/{{ID}}/".$page."/";
        $this->data['batch_action_link']	= BACKEND_URL."agent/batch_agent_master/{{ID}}/".$page."/";

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!---------------------code-------------------------------------->
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
       
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='agent/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function batch_agent_master()
    {
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
		//pr($_POST);		
		if($action == 'Delete')
		{
			$this->deleteAgentBatch();
		}
		else if($action == 'Activate')
		{
			$this->batchstatus('Activate');
		}
		else if($action == 'Inactivate')
		{
			$this->batchstatus('Inactivate');
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."agent/index"); 
		return true;
			
    }
	
	private function deleteAgentBatch()
	{
                chk_login();
		$return = $this->model_adminuser->deleteBatchAdminUsers();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Selected Agent user(s) deleted successfully.");
		}
		return true;
	}
	public function delete_agent_master()
	{
		chk_login();
		
		$agent_id	= $this->uri->segment(3);
		
			$this->model_adminuser->deleteAdminUser($agent_id);
			$this->nsession->set_userdata('succmsg', "Selected agent deleted successfully.");
		
		
		redirect(BACKEND_URL."agent/index");
		return true;
		
		
		
	}
	private function batchstatus($status)
	{
                chk_login();
		if($status == '')
			return false;
		
		$return = $this->model_adminuser->statusBatchAdminUsers($status);
		if($return == 'noitem')
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'active')
		{
			$this->nsession->set_userdata('succmsg', "Selected Agent users status Activated successfully.");
		}elseif($return == 'inactive')
		{
			$this->nsession->set_userdata('succmsg', "Select Agent users status Deactivated successfully.");
		}
		
		return true;
	}
        
        function is_email_exists($email){		
		$id 	= $this->uri->segment(3, 0);
		$bool = $this->model_adminuser->get_email_existence($email, $id,'agent');
		
		if(!$bool)
		{
			$this->form_validation->set_message('is_email_exists', 'The %s already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function is_name_pair_exists($lastname){
		$id 	= $this->uri->segment(3, 0);
		$bool = $this->model_adminuser->checkNamePairExists($lastname, $id,'agent');
		if(!$bool)
		{
			$this->form_validation->set_message('is_name_pair_exists', 'The first name & last name pair already exits');
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
        
        public function addagent()
        {
            chk_login();
            $this->data='';
            
            //<!----------------------code--------------------------->
            $page = $this->uri->segment(4, 0);
		$this->data	= array();
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_is_name_pair_exists');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$user_image = '';
				if ($_FILES['user_image']['name'] != "")
				{
					
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
					
					if($sUploaded == '')
					{
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."agent/index");
						return false;
					}
					else
					{						
						$user_image = $sUploaded;
						$this->model_adminuser->addAdminUsers($user_image,'agent');
						$this->nsession->set_userdata('succmsg', "Agent user added successfully.");		
						redirect(base_url()."agent/index");
						return true;
					}
				}
				else
				{
					$this->model_adminuser->addAdminUsers('','agent');
					$this->nsession->set_userdata('succmsg', "Agent user added successfully.");			
					redirect(base_url()."agent/index");
					return true;
				}                    
			}
		}		
            
            //<!-----------------------end--------------------------->
         $this->data['base_url'] = BACKEND_URL."agent/index";
         $this->data['brdLink']='';
         $this->data['add_url']=BACKEND_URL."agent/addagent/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
       
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='agent/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        }
        
        public function editagent()
        {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------------->
            
            $uId 	= $this->uri->segment(3, 0);
		$page 	= $this->uri->segment(4, 0);
		if($page ==0)
			$pagenum ='';
		else
			$pagenum = $page;
		
                if($this->input->get_post('action') == 'Process')
		{			
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
				if ($_FILES['user_image']['name'] != "")
				{
					
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
						$this->nsession->set_userdata('errmsg', $this->session->userdata('upload_err'));
						$this->nsession->set_userdata('upload_err', '');
						if($pagenum=='')
						{
							redirect(base_url()."agent/index");
						
						}
						else
						{
							
							redirect(base_url()."agent/index/".$pagenum."/");
							
						}
						return false;
					}
					else
					{
						if(file_exists(file_upload_absolute_path().'admin/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != ""){
							unlink(file_upload_absolute_path().'admin/'.stripslashes($user_image_old));
							unlink(file_upload_absolute_path().'admin/thumb/'.stripslashes($user_image_old));
						}
						$this->model_adminuser->updateAdminUsers($uId, $user_image,'agent');
						$this->nsession->set_userdata('succmsg', "Agent user updated successfully.");
						
						if($pagenum=='')
						{
							redirect(base_url()."agent/");
						
						}
						else
						{
							
							redirect(base_url()."agent/index/".$pagenum."/");
							
						}
						return true;
					}
				}
				else
				{
					$this->model_adminuser->updateAdminUsers($uId,'','agent');
					$this->nsession->set_userdata('succmsg', "Agent user updated successfully.");			
					if($pagenum=='')
						{
							redirect(base_url()."agent/");
						
						}
						else
						{
							
							redirect(base_url()."agent/index/".$pagenum."/");
							
						}
					return true;
				}
			}
		}
            
            
            
            
         $this->data['user_info'] = $this->model_adminuser->get_single($uId);   
        //<!--------------------code---------------------------------->
        
        $this->data['base_url'] = BACKEND_URL."agent/index";
        $this->data['brdLink']='';
        $this->data['edit_link']=BACKEND_URL."agent/editagent/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
       
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='agent/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
            
        }
}
?>