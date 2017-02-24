<?php
class User_fav extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
      
        $this->load->model("model_adminuser");
    }
    
    public function list_user()
    {
    
    chk_login();
    $this->data='';
    
    //<!------------------------code----------------------------------->
                $config['base_url'] 			= BACKEND_URL."user_fav/list_user/";
		$config['per_page'] 			= 20;
		$config['uri_segment']  		= 3;
		$config['num_links'] 			= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']			= $this->nsession->userdata('RENTAL_USER');
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
		
		$start 					= 0;
		$page					= $this->uri->segment(3,0);
		$social_users_details			= array();
		$social_users				= array();
		$social_users				= $this->model_adminuser->get_social_list($config,$start);
		
		//pr($social_users,1);
		$field_name[0]			=	'property_name';
		$field_name[1]			=	'property_slug';
		$field_name[2]			=	'record_type';
		
		if(is_array($social_users) && count($social_users)>0)
		{
			foreach($social_users as $k=>$v)
			{
			    $social_users_details[$k]['user_details']=$v;
			}
		}
		$this->data['userList'] 		= $social_users_details;
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 	 	= $config['per_page'];
		$this->data['page'] 	 		= $page;	
			
		$this->data['controller'] 		= 'user_fav';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/list_user/0/1/";				
		$this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/list_user/0/1/";
                $this->data['view_link']        	= BACKEND_URL.$this->data['controller']."/view_details/{{ID}}/".$page."/";
					

		$this->pagination->initialize($config);
                $this->data['pagination'] = $this->pagination->create_links();
                $this->data['brdLink']='';
    //<!------------------------code----------------------------------->
    
    $this->data['succmsg'] = $this->nsession->userdata('succmsg');
    $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
    $this->nsession->set_userdata('succmsg', "");		
    $this->nsession->set_userdata('errmsg', "");
   
    $this->templatelayout->get_topbar();
    $this->templatelayout->get_leftmenu();
    $this->templatelayout->get_footer();
    $this->elements['middle']='user_favourite/list_user';			
    $this->elements_data['middle'] = $this->data;			    
    $this->layout->setLayout('layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function view_details()
    {
        chk_login();
	$this->data='';
	$user_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
	
	
	$social_users_details			= array();
	$social_users				= array();
	$social_users				= $this->model_basic->getValues_conditions('lp_social_members','*',''," `id` = '".$user_id."'",'','','');
	
	
	$field_name[0]			=	'property_name';
	$field_name[1]			=	'property_id';
	$field_name[2]			=	'record_type';
	$field_name[3]			=	'optional_title';
	$field_name[4]			=	'status';

	
	foreach($social_users as $k=>$v)
	{
		$social_users_details[$k]['user_details']		=	$v;
		$fav_listing						=	$this->model_basic->getValues_conditions('lp_members_favourite','*',''," `social_id` = '".$v['id']."'",'','','');
		if(is_array($fav_listing))
		{
			foreach($fav_listing as $u=>$p)
			{
				$prop_details					=	$this->model_basic->getValues_conditions('lp_property_master',$field_name,''," `property_id` = '".$p['property_id']."'",'','','');
				
				$social_users_details[$k]['fav_listing'][$u]	=	$prop_details[0];
			}
		}
		
	}
	
	
	$this->data['userList'] 		= $social_users_details;
	
	
	$this->data['controller']	= "user_fav";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/list_user/";
        $this->data['edit_url'] = BACKEND_URL.$this->data['controller']."/view_details/".$user_id."/".$page;
        
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
        
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='user_favourite/details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);

	
    }
}
?>