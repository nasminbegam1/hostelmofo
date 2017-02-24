<?php
class Cron extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('model_corn');
    }
    
   
    public function listing(){
        
        chk_login();
                $this->data='';
                
                $config['base_url'] 			= BACKEND_URL."cron/listing/";
                $config['total_rows']                   =0;
                $config['per_page'] 			= 20;
                $config['uri_segment']  		= 3;
                $config['num_links'] 			= 5;
                $this->pagination->setCustomAdminPaginationStyle($config);
                
                
                
                
		$this->data['controller']	= 	"cron";
		$this->data['base_url'] 	= 	BACKEND_URL."cron/listing/";
		//$fields[0]			=	'optional_title';
		//$fields[1]			=	'distance_to_beach'; 	
		//$fields[2]			=	'location_id';
		//
		//$this->data['distance_details']	= 	$this->model_basic->getValues_conditions('lp_property_master',$fields);
                $this->data['distance_details']	= 	$this->model_corn->get_list($config,$start);
		foreach($this->data['distance_details'] as $k=>$v)
		{
			$this->data['distance_details'][$k]['beach_name']	=	$this->model_basic->getValue_condition('lp_property_map_location','location_name',''," `location_id` = '".$v['location_id']."'");
			$this->data['distance_details'][$k]['location_name']	=	$this->model_basic->getValue_condition('lp_location_master','location_name',''," `location_id` = '".$v['location_id']."'");
		}
                
                 $this->data['brdLink']='';
                
                $start 				= 0;
                $page				= $this->uri->segment(3,0);
                $this->data['startRecord'] 		= $start;
                $this->data['totalRecord'] 		= $config['total_rows'];
                $this->data['per_page'] 	 	= $config['per_page'];
                $this->data['page'] 	 		= $page;
                 
                 $this->pagination->initialize($config);
                $this->data['pagination'] = $this->pagination->create_links();
                 
               $this->data['show_all'] 	= 	BACKEND_URL."cron/listing/";
                $this->data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
                $this->nsession->set_userdata('succmsg', "");		
                $this->nsession->set_userdata('errmsg', "");
                //$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
                $this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
                $this->elements['middle']='corn/list';			
                $this->elements_data['middle'] = $this->data;			    
                $this->layout->setLayout('layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
    }
}
?>