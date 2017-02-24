<?php

class Property_approval extends MY_Controller{
    
    function __construct(){
        parent:: __construct();
        $this->load->model(array('model_basic','model_property'));
    }
    
    
    public function index(){
        $this->data='';
        $config['base_url'] 	= BACKEND_URL.currentClass()."/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
       
       if($this->input->get_post('approveStatus') != '')
	{
                $config['search_keyword']	= $this->input->get_post('approveStatus',true);
		$this->nsession->set_userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD',$config['search_keyword']);
                redirect(BACKEND_URL.'property_approval/index');
	}
	
        $this->data['search_keyword']=$this->nsession->userdata('PROPERTY_APPROVAL_SEARCH_KEYWORD');
        $start 				= 0;
	$page				= $this->uri->segment(3,0);
	$this->data['propertyList']	= $this->model_property->getApprovalList($config,$start);
        $this->pagination->initialize($config);
	//pr($this->data['propertyList']);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= currentClass();	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        
        $this->data['brdLink'][0]['logo']   =   'fa fa-home';
	$this->data['brdLink'][0]['name']   =   'Property';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-home';
	$this->data['brdLink'][1]['name']   =   'Approval Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
        
        $this->data['pagination']           = $this->pagination->create_links();
        
        $this->data['succmsg']              = $this->nsession->userdata('succmsg');
        $this->data['errmsg']               = $this->nsession->userdata('errmsg');		
        $this->nsession->set_userdata('succmsg', "");		
        $this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        
        $this->elements['middle']='property/approval_list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
}

?>