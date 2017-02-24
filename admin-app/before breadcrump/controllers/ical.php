<?php

class Ical extends CI_Controller{
    var $icalMaster	        = 'lp_ical_master';
    var $RentMaster             = 'lp_rent_master';
    var $propertyAvailability   = 'lp_property_availibility';
    
    var $kigo_username          = 'livephuket';
    var $kigo_password          = 'qqoeUgWdW';
        
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_kigo');
    }
    
    
     public function index(){
        
        chk_login();
        $this->data = array();
        $config['base_url'] 	= BACKEND_URL."icalavailibility/index/";
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 3;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        $this->data['icalpropertyList'] = $this->model_kigo->getIcalProperty($config);
        
        $this->pagination->initialize($config);
        
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(3,0);
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['errmsg'] = $this->nsession->userdata('errmsg');        
        $this->nsession->unset_userdata('succmsg');		
        $this->nsession->unset_userdata('errmsg');
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/ical_propertylist';		
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    public function details(){
        
        chk_login();
        $this->data = array();
        
        $this->data['ical_id'] = $this->uri->segment(3,0);
        $config['base_url'] 	= BACKEND_URL."icalavailibility/details/".$this->data['ical_id'];
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 4;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
        $this->data['enquiryList'] = $this->model_kigo->getIcalPropertyDetail($this->data['ical_id'],$config);
        
        $this->pagination->initialize($config);
        
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(4,0);
    
        //pr($this->data,0);
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/ical_details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    
  
}


?>