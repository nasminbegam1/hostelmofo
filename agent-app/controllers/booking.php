<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Booking extends My_Controller
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_booking');
	}
	
	public function index()
	{
		$this->chk_login();
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('BOOKING');
			redirect(currentClass().'/index/0');
		}
		
		$config['base_url'] 	= AGENT_URL."booking/index/";
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('BOOKING');
		
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
		$page 					= $this->uri->segment(3,0);
		$this->data['bookings']		= $this->model_booking->getList($config,$start);
		//echo count($this->data['bookings']); die;
		$i=0;
		
		
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= AGENT_URL."booking/index/0/1/";
		$this->data['view_link']      		= AGENT_URL."booking/view/{{ID}}/".$page."/";		
		$this->data['delete_link']     		= AGENT_URL."booking/delete/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$brd_arr[] = array('link'=>base_url('booking'), 'text' => 'Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );		
		$this->data['breadcrumbs'] = $brd_arr;
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='booking/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}
	
	public function delete(){
		$page		= $this->uri->segment(4, 0);
		$payment_id 	= $this->uri->segment(3, 0);
		if (!$payment_id) return false;		
		$this->model_basic->deleteData(PAYMENT_INFO, 'paymeny_id='+$payment_id);
		$this->model_basic->deleteData(BOOKING, 'payment_id='+$payment_id);
		redirect(base_url('booking/index/'+$page));
	}
	
	
	public function view()
	{
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$peyment_id 	= $this->uri->segment(3, 0);
		
		
	        $row = array();
		
		$booking = $this->model_booking->getBooking($peyment_id); //pr($arr_enquiry_detail);
		
		
                if($booking){
                    $this->data['booking'] = $booking;
                }
		else
		{
			$this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(base_url('booking/index/'+$page));
                        return false;
		}
		
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		$brd_arr[] = array('link'=>base_url('booking'), 'text' => 'Booking','icon_class'=>'fa fa-bookmark' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'View' );
		
		$this->data['breadcrumbs'] = $brd_arr;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='booking/view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
}