<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_listing extends CI_Controller
{
	
	var $enquiryMaster	= 'lp_enquiry_master';
	var $agentMaster	= 'lp_agent_master';
	var $actionMaster	= 'lp_action_master';
	var $enquiryLead	= 'lp_enquiry_lead';
	var $adminMaster	= 'lp_adminuser';
	var $calendarEvent	= 'lp_calendar_event';
	var $propertyVisited 	= 'lp_property_visited';
	var $customBooking 	= 'lp_custom_booking';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_custom_booking');
		$this->load->model('model_calendar');
		
	}
	
	public function listing()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."order_listing/listing/";
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('PAYMENT_ORDER');
		
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
		
		$this->data['orderList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['orderList']		= $this->model_custom_booking->orderList($config,$start);
		
		
		$i=0;

		//$this->data['latestBooking']=$this->model_basic->getValues_conditions('lp_order','cb_id','','',' cb_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'custom_booking';	
		$this->data['base_url'] 		= BACKEND_URL."order_listing/listing/".$page."/0/";
		$this->data['show_all'] 		= BACKEND_URL."order_listing/listing/".$page."/0/";
		$this->data['view_link']      		= BACKEND_URL."order_listing/view_order_details/{{ID}}/".$page."/0";
		

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='order_listing/listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}

	
	public function view_order_details()
	{
		chk_login();
		$page		= $this->uri->segment(4, 0);
		$order_id	=	0;
		$order_id	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "order_listing";
		$this->data['base_url'] 	= BACKEND_URL."order_listing/listing/";
		$this->data['view_url'] 	= BACKEND_URL."order_listing/view_order_details/".$order_id."/".$page;
		//$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/view_booking/".$booking_id."/".$page;
		
		$order_details		= 	$this->model_basic->getValues_conditions('lp_order','',''," `order_id` = '".$order_id."'");
		
		$currency_symbol	=	$this->model_basic->getValues_conditions('lp_country_currency_master','',''," `currency_code` = '".$order_details[0]['currency']."'");
		
		$order_details[0]['currency_symbol'] =	 $currency_symbol[0]['country_currency_symbol'];
		
		$this->data['order_details']	= $order_details;
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='order_listing/detail_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	public function edit()
	{
		chk_login();
		$order_id		= $this->uri->segment(3, 0);
		$page = $this->uri->segment(4, 0);
		$this->data['controller']	= "order_listing";
		$this->data['base_url'] 	= BACKEND_URL."order_listing/listing/";
		
		$this->data['edit_url'] 	= BACKEND_URL."order_listing/edit/".$order_id."/".$page;
		
		//$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/view_booking/".$booking_id."/".$page;
		
		$order_details		= 	$this->model_basic->getValues_conditions('lp_order','',''," `order_id` = '".$order_id."'");
		$currency_symbol	=	$this->model_basic->getValues_conditions('lp_country_currency_master','',''," `currency_code` = '".$order_details[0]['currency']."'");
		
		$order_details[0]['currency_symbol'] =	 $currency_symbol[0]['country_currency_symbol'];
		
		$this->data['order_details']	= $order_details;
		
		if($this->input->get_post('action') == 'Process')
		{
			$capture_date	=	$this->input->get_post('capture_date');
			$capture_date	= 	str_replace('/', '-', $capture_date);			
			$time 		= 	strtotime($capture_date);
			$newformat 	= 	date('Y-m-d H:i:s',$time);
			
			
			$updateArr  =  array(
				'capture_amount'	=> addslashes(trim($this->input->get_post('capture_amount'))),
				'capture_status'	=> addslashes(trim($this->input->get_post('capture_status'))),
				'capture_date'		=> $newformat
				);
			//pr($updateArr,1);	
			$idArr  = array('order_id' => $order_id);
			$update = $this->model_basic->updateIntoTable("lp_order", $idArr, $updateArr);
			$this->nsession->set_userdata('succmsg', "Order updated successfully.");
			redirect(BACKEND_URL."order_listing/listing/");			
		}
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='order_listing/edit_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}	
	
	public function distance_listing()
	{
		$this->chk_login();		
		$this->data['controller']	= 	"order_listing";
		$this->data['base_url'] 	= 	BACKEND_URL."order_listing/distance_listing/";
		$fields[0]			=	'optional_title';
		$fields[1]			=	'distance_to_beach'; 	
		$fields[2]			=	'location_id';
		
		$this->data['distance_details']	= 	$this->model_basic->getValues_conditions('lp_property_master',$fields);
		foreach($this->data['distance_details'] as $k=>$v)
		{
			$this->data['distance_details'][$k]['beach_name']	=	$this->model_basic->getValue_condition('lp_property_map_location','location_name',''," `location_id` = '".$v['location_id']."'");
			$this->data['distance_details'][$k]['location_name']	=	$this->model_basic->getValue_condition('lp_location_master','location_name',''," `location_id` = '".$v['location_id']."'");
		}

		//pr($this->data['distance_details'],1);
		$brdArr	= array( "Booking" => 'javascript:void(0);', "Distance Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('');
		$this->elements['middle']='order_listing/distance_listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}	
}