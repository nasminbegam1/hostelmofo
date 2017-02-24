<?php
class agent extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
       // $this->load->model("user_model");
        $this->load->model("model_agent");
    }
    
    /* ****************  SUPER ADMIN ************* */
    public function index()
    {
        chk_login();
        $this->data='';
        $logged_id=$this->nsession->userdata('admin_id');
        $config['base_url'] 			= BACKEND_URL."agent/index/";
        $config['total_rows']                   =0;
        $config['per_page'] 			= 20;
        $config['uri_segment']  		= 3;
        $config['num_links'] 			= 20;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
       // $this->pagination->setCustomAdminPaginationStyle1($config);
        
        $this->data['search_keyword']	= '';
        $this->data['per_page']		= '';
        $this->data['params']			= $this->nsession->userdata('ADMIN_USER');
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
        {	
                $this->data['search_keyword'] 		= $this->data['params']['search_keyword'];
                $this->data['per_page'] 		= $this->data['params']['per_page'];
        }
        else 
        {
                $this->data['search_keyword']		= $this->input->get_post('search_keyword',true);
                $this->data['per_page'] 		= $this->input->get_post('per_page',true);	
        }
		
        if($this->nsession->userdata('role') != '')
	{
            $type=$this->nsession->userdata('role');
            if($type=='admin')
            {
                $this->data['agentList'] = $this->model_agent->get_list($config,$start,$type);
            }
            else
            {
                $this->data['agentList']='';
            }
            
        }
	//pr($this->data['agentList']);
       // $brdArr	= array( "User" => 'javascript:void(0)',  "Admin"=>BACKEND_URL."user/adminuser");
        //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-user';
	$this->data['brdLink'][0]['name']   =   'Agent';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-user';
	$this->data['brdLink'][1]['name']   =   'Agent Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
	
	
        $start 					= 0;
        $page					= $this->uri->segment(3,0);
        $this->data['startRecord'] 		= $start;
        $this->data['totalRecord'] 		= $config['total_rows'];
        $this->data['per_page'] 	 	= $config['per_page'];
        $this->data['page'] 	 		= $page;	
           // pr($config);    
        $this->data['controller'] 		= 'agent';	
        $this->data['base_url'] 	        = BACKEND_URL.$this->data['controller']."/";
        $this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/";
        $this->data['add_link']           	= BACKEND_URL.$this->data['controller']."/add/0/".$page."/";
        $this->data['edit_link']        	= BACKEND_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
	$this->data['delete_link']        	= BACKEND_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
        $this->pagination->initialize($config);
	$this->data['pagination'] = $this->pagination->create_links();
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='agent/list';			
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
		
		redirect(base_url()."agent/index/".$per_page1);
		return true;
			
	}
	
        public function delete(){
		chk_login();
		$uId 	= $this->uri->segment(3, 0);
		$page 	= $this->uri->segment(4, 0); 
		$this->model_agent->deleteAgent($uId);
		$this->nsession->set_userdata('succmsg', "Agent deleted successfully.");			
		redirect(base_url()."agent/index/".$page);
		return true;
	}
        
	private function deletebatch(){
                chk_login();
		$return = $this->model_agent->deleteBatchAgent();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Select admin users deleted successfully.");
		}
		return true;
	}
		
	private function batchstatus($status){
                chk_login();
		if($status == '')
			return false;
		
		$return = $this->model_agent->statusBatchAgent($status);
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Select agent status Activated successfully.");
		}elseif($return == 'inactive'){
			$this->nsession->set_userdata('succmsg', "Select agent status Deactivated successfully.");
		}
		return true;
	}
        
    function is_email_exists($email){
	    chk_login();
	    $id 	= $this->uri->segment(3, 0);
	    $bool = $this->model_agent->get_email_existence($email, $id);
	    if(!$bool){
		    $this->form_validation->set_message('is_email_exists', 'The %s already exists');
		    return FALSE;
	    }else{
		    return TRUE;
	    }
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
	}/*else if(preg_match('/[^0-9a-zA-Z]/', $password)){
	    $this->form_validation->set_message('password_check', 'The password should contain at least 1 uppercase letter, 1 lowercase letter, a number');
	    return FALSE;
	}*/
	else{
	    return TRUE;
	}
	}
	return TRUE;
    }
    
    function add(){
        chk_login();
        $page = $this->uri->segment(4, 0);
        $this->data='';
        
        if($this->input->get_post('action') == 'Process'){
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Lender', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_check');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
			//$this->form_validation->set_rules('role', 'User Role', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				
			}
                        else
                        {
			    $this->model_agent->addAgent();
			    $firstname      = strip_tags(addslashes(trim($this->input->get_post('firstname'))));
			    $lastname       = strip_tags(addslashes(trim($this->input->get_post('lastname'))));
			    $gender         = strip_tags(addslashes(trim($this->input->get_post('gender'))));
			    $email	    = strip_tags(addslashes(trim($this->input->get_post('email'))));
			    $password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
			    $send_mail      = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
			    $mail_config['to']          = stripslashes(trim($email));
			    //$mail_config['to']          = 'nasmin.begam@webskitters.com';
			    $mail_config['from']        = trim($send_mail);
			    $mail_config['from_name']   = 'Hostelmofo Team';
			    $mail_config['subject']     = 'You are agent of Hostelmofo';
			    
			    $mail_config['message']     = 'Hi '.$firstname.' '.$lastname.',<br>Your login credentials is below <br> Email Address : '.$email.' <br> password : '.$password.' <br>
			    <a href='.AGENT_URL.'>Click here to login as a agent</a><br><br>Kind regards, <br>HostelMofo Team';
			    $mailsend_agent             = send_email($mail_config);
			    $this->nsession->set_userdata('succmsg', "Agent added successfully.");		
			    redirect(base_url()."agent/index/".$page);
			    return true;
					             
			}
		}
        $this->data['countryList'] = $this->model_basic->getValues_conditions(COUNTRIES,array('idCountry','countryName'));
        $this->data['base_url'] = BACKEND_URL."agent/";
        $this->data['add_url'] = BACKEND_URL."agent/index/0/".$page."/";
        
        //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-user';
	$this->data['brdLink'][0]['name']   =   'Agent';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-user';
	$this->data['brdLink'][1]['name']   =   'Agent Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."agent/";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add Agent';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................

        //$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
        $this->elements['middle']='agent/add';
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function edit()
    {
        chk_login();
        $uId 	= $this->uri->segment(3, 0);
        $page = $this->uri->segment(4, 0);
        $this->data='';
        
         if($this->input->get_post('action') == 'Process'){
	    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
	    $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('gender', 'Lender', 'trim|required');
	    $this->form_validation->set_rules('location', 'Location', 'trim|required');
	    $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
	    $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
	    $this->form_validation->set_rules('password', 'Password', 'callback_password_check');
	    $this->form_validation->set_rules('conf_password', 'Confirm Password', 'matches[password]');
	    
	    if ($this->form_validation->run() == FALSE)
	    {
		    
	    }
	    else
	    {
		$password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
		$conf_password  = strip_tags(addslashes(trim($this->input->get_post('conf_password'))));
		$email		= strip_tags(addslashes(trim($this->input->get_post('email'))));
		$firstname      = strip_tags(addslashes(trim($this->input->get_post('firstname'))));
		$lastname       = strip_tags(addslashes(trim($this->input->get_post('lastname'))));
		if($password != '' && $password != $conf_password){
		    $this->nsession->set_userdata('errmsg', "Password does not match.");			
		    redirect(base_url()."agent/edit/".$uId."/".$page);
		    return true;
		}else{
		    if($password != ''){
			$send_mail      = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
			$mail_config['to']          = stripslashes(trim($email));
			//$mail_config['to']          = 'nasmin.begam@webskitters.com';
			$mail_config['from']        = trim($send_mail);
			$mail_config['from_name']   = 'Hostelmofo Team';
			$mail_config['subject']     = 'Your password is changed';
			
			$mail_config['message']     = 'Hi '.$firstname.' '.$lastname.',<br>You are agent of Hostelmofo.Your password is changeed. <br>Your new password is <b>'.$password.'</b> <br><br>Kind regards, <br>HostelMofo Team';
			$mailsend_agent             = send_email($mail_config);
		    }
		    $this->model_agent->updateAgent($uId,'');
		    $this->nsession->set_userdata('succmsg', "Agent updated successfully.");
		    redirect(base_url()."agent/index/".$page);
		    return true;
		}
	    }
	}
        
        $this->data['countryList'] = $this->model_basic->getValues_conditions(COUNTRIES,array('idCountry','countryName'));
	$this->data['agent_info'] = $this->model_agent->get_single($uId);
        $this->data['base_url'] = BACKEND_URL."agent/";
        $this->data['edit_link'] = BACKEND_URL."agent/edit/".$uId."/".$page."/";
        //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-user';
	$this->data['brdLink'][0]['name']   =   'Agent';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-user';
	$this->data['brdLink'][1]['name']   =   'Agent Listing';
	$this->data['brdLink'][1]['link']   =    BACKEND_URL."agent/";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Agent Edit';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');			
	$this->nsession->set_userdata('errmsg', "");
	//........................
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