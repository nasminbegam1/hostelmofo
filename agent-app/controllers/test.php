<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends My_Controller
 
  {
        //var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_booking_list');
		$this->load->model('model_test');
	}


	public function sales()
	{
		$this->chk_login();
		
		$property_id= $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$this->data['tabs'] = $this->load->view('reports/property_tab',array('select_tab'=>'reportList','property_id'=>$property_id,'page'=>$page),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
			
			    
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 4;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		
		if($this->input->get_post('btn_show_all')!=''){
		    $this->nsession->unset_userdata('REPORT');//die('saheb');
			
		    redirect(base_url()."reports/index/".$property_id);
		}
		
		$this->data['params'] = $this->nsession->userdata('REPORT');
		$from = '';$to = '';
		if($this->input->get_post('from_dt') != '' || $this->input->get_post('to_dt') != '')
		{
			$from = $this->input->get_post('from_dt');
			$to = $this->input->get_post('to_dt');
		}
		$this->data['report_details']	= $this->model_report->getList($config,$start,$property_id,$from,$to);
		$start 				= 0;
		$page				= $this->uri->segment(4,0);
		$this->data['startRecord'] 	= $start;
	        $this->data['from']	 	= $from;
	        $this->data['to']	 	= $to;
		//$this->data['totalRecord'] 	= $config['total_rows'];
		//$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= currentClass();	
		$this->data['base_url'] 	= AGENT_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']     	= AGENT_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']     	= AGENT_URL.$this->data['controller']."/add/0/".$page."/";
		$this->data['edit_link']    	= AGENT_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
		$this->data['delete_link']	= AGENT_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
		$this->data['booking_link']	= AGENT_URL."booking_list/bookings/{{ID}}/".$page."/";
		$this->data['availability_link']= AGENT_URL.$this->data['controller']."/availability/{{ID}}/".date('Y')."/";
				

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'REPORT' );
	
		$this->data['breadcrumbs'] = $brd_arr;
	//........................
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function customer_analysis(){
		$this->chk_login();
		$property_id= $this->uri->segment(3);
		$this->data['tabs'] = $this->load->view('reports/property_tab',array('select_tab'=>'customerAnalysis','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$from = '';$to = '';
		if($this->input->get_post('from_dt') != '' || $this->input->get_post('to_dt') != '')
		{
			$from = $this->input->get_post('from_dt');
			$to = $this->input->get_post('to_dt');
		}
		$this->data['from']	 	= $from;
	        $this->data['to']	 	= $to;
		$this->data['customer_analysis_report']	= $this->model_test->getCustAnalysis($property_id,$from,$to);
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Customer Analysis' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/customer_analysis';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}


	
}
?>