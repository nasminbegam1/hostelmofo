<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Propertybooking extends My_Controller
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_propertybooking');
	}
	
	public function bookings()
	{
		$this->chk_login();
		
		$property_id	= $this->uri->segment(3);
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('BOOKINGS');
			redirect(currentClass().'/bookings/'.$property_id);
		}
		
		$this->data['book_type'] = ''; 
		
		$config['base_url'] 	= AGENT_URL."propertybooking/bookings/".$property_id."/";
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 4;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('BOOKINGS');
		
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
		
		$this->data['enquiryList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(4,0);
		$this->data['bookings']			= $this->model_propertybooking->getList($config,$start);
		//echo count($this->data['bookings']); die;
		$i=0;
		
		
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= AGENT_URL."propertybooking/bookings/".$property_id."/";
		$this->data['view_link']      		= AGENT_URL."propertybooking/view/{{ID}}/".$page."/";		
		$this->data['delete_link']     		= AGENT_URL."propertybooking/delete/{{ID}}/".$page."/";
		$this->data['cancel_link']     		= AGENT_URL."propertybooking/cancel_booking/".$property_id."/{{ID}}/".$page."/";
		
		
		$this->data['tabs'] = $this->load->view('property_booking/property_tab',array('select_tab'=>'bookings'),true);
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$brd_arr[] = array('link'=>$this->data['base_url'], 'text' => 'Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );		
		$this->data['breadcrumbs'] = $brd_arr;
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='property_booking/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}
	
	
	public function cancelled()
	{
		$this->chk_login();
		$property_id	= $this->uri->segment(3);
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('CANCELLED');
			redirect(currentClass().'/cancelled/'.$property_id.'/');
		}
		
		$this->data['book_type'] = 'Cancel';
		
		$config['base_url'] 	= AGENT_URL."propertybooking/cancelled/".$property_id.'/';
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 4;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CANCELLED');
		
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
		
		$this->data['enquiryList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(5,0);
		$this->data['bookings']		= $this->model_propertybooking->getCancelList($config,$start);
		//echo count($this->data['bookings']); die;
		$i=0;
		
		
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= AGENT_URL."propertybooking/cancelled/".$property_id.'/';
		$this->data['view_link']      		= AGENT_URL."propertybooking/view/{{ID}}/".$page."/";		
		$this->data['delete_link']     		= AGENT_URL."propertybooking/delete/{{ID}}/".$page."/";
		
		$this->data['tabs'] = $this->load->view('property_booking/property_tab',array('select_tab'=>'cancelled'),true);
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$brd_arr[] = array('link'=>$this->data['base_url'], 'text' => 'Cancel Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );		
		$this->data['breadcrumbs'] = $brd_arr;
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='property_booking/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}
	
	
	public function arrival()
	{
		$this->chk_login();
		$property_id	= $this->uri->segment(3);
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('ARRIVAL');
			redirect(currentClass().'/arrival/'.$property_id.'/');
		}
		
		$this->data['book_type'] = 'Arrivals';
		
		$config['base_url'] 	= AGENT_URL."propertybooking/arrival/".$property_id.'/';
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 4;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('ARRIVAL');
		
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
		
		$this->data['enquiryList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(4,0);
		$this->data['bookings']		= $this->model_propertybooking->getArrivalList($config,$start);
		//echo count($this->data['bookings']); die;
		$i=0;
		
		
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= AGENT_URL."propertybooking/arrival/".$property_id.'/';
		$this->data['view_link']      		= AGENT_URL."propertybooking/view/{{ID}}/".$page."/";		
		$this->data['delete_link']     		= AGENT_URL."propertybooking/delete/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['tabs'] = $this->load->view('property_booking/property_tab',array('select_tab'=>'arrival'),true);
		
		
		$brd_arr[] = array('link'=>$this->data['base_url'], 'text' => 'Arrivals Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );		
		$this->data['breadcrumbs'] = $brd_arr;
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='property_booking/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}

	
	public function view()
	{
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$peyment_id 	= $this->uri->segment(3, 0);
		
		
	        $row = array();
		
		$booking = $this->model_propertybooking->getBooking($peyment_id); //pr($arr_enquiry_detail);
		
		
                if($booking){
                    $this->data['booking'] = $booking;
                }
		else
		{
			$this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(base_url('propertybooking/index/'+$page));
                        return false;
		}
		
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		$brd_arr[] = array('link'=>base_url('propertybooking'), 'text' => 'Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'View' );
		
		$this->data['breadcrumbs'] = $brd_arr;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='property_booking/view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function cancel_booking()
	{
		$property_id = $this->uri->segment(3, 0);
		$id = $this->uri->segment(4,0);
		$page = $this->uri->segment(5,0);
		$this->model_propertybooking->cancelBooking();
		
		$this->nsession->set_userdata('succmsg', "Booking has been cancelled successfully");
		
		$redirect_url = AGENT_URL."propertybooking/bookings/".$property_id."/".$page;
		redirect($redirect_url);
		
		
	}
	
	
}