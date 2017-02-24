<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Booking_list extends My_Controller
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_booking_list');
	}
	
	public function bookings()
	{
		$this->chk_login();
		
		$property_id				= $this->uri->segment(3);
		$page					= $this->uri->segment(4);
		
		$this->data['book_type'] 		= ''; 
		$config['base_url'] 			= AGENT_URL."booking_list/bookings/".$property_id.'/'.$page;	
		$this->data['bookings_list']		= $this->model_booking_list->getList($property_id);
		//pr($this->data['bookings_list']);
		$this->data['controller'] 		= 'booking_list';	
		$this->data['base_url'] 		= AGENT_URL."booking_list/bookings/".$property_id.'/'.$page;
		$this->data['view_link']      		= AGENT_URL."booking_list/arrival_view/{{ID}}/".$property_id.'/'.$page;	
		$this->data['deal_link']      		= AGENT_URL."booking_list/deal_view/{{ID}}/".$property_id.'/'.$page;	


		$this->data['delete_link']     		= AGENT_URL."booking_list/delete/{{ID}}/".$property_id.'/'.$page;
		$this->data['cancel_link']     		= AGENT_URL."booking_list/cancel_booking/{{ID}}/".$property_id.'/'.$page;
		//pr($this->data);
		
		$this->data['tabs'] 			= $this->load->view('booking_list/property_tab',array('select_tab'=>'bookings','property_id'=>$property_id,'page'=>$page),true);
		$propertDtls				= $this->model_booking_list->get_property_name($property_id);
		
		$this->data['property_header'] 		= $this->load->view('property/property_header',
									    array('select_tab'=>'bookings',
										  'property_id'=> $property_id,
										  'page'=>$page,
										  'propertDtls'=>$propertDtls),
									    true);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='booking_list/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	}
	
	public function cancelled(){
		$this->chk_login();
		$property_id				= $this->uri->segment(3);
		$page					= $this->uri->segment(4);
		$this->data['book_type'] 		= 'Cancel';
		if(empty($page)) $page = 0;
		$config['base_url'] 			= AGENT_URL."booking_list/cancelled/".$property_id.'/'.$page;
		
		$this->data['bookings_list']		= $this->model_booking_list->getCancelList($property_id);
		$this->data['controller'] 		= 'booking_list';	
		$this->data['base_url'] 		= AGENT_URL."booking_list/cancelled/".$property_id.'/'.$page.'/';
		$this->data['view_link']      		= AGENT_URL."booking_list/view/{{ID}}/".$property_id.'/'.$page.'/';		
		$this->data['delete_link']     		= AGENT_URL."booking_list/delete/{{ID}}/".$property_id.'/'.$page.'/';
		$this->data['deal_link']      		= AGENT_URL."booking_list/deal_view/{{ID}}/".$property_id.'/'.$page;	

		$this->data['tabs'] = $this->load->view('booking_list/property_tab',array('select_tab'=>'cancelled','property_id'=>$property_id,'page'=>$page),true);
		
		$propertDtls 				= $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] 		= $this->load->view('property/property_header',
									    array('select_tab'=>'bookings',
										  'property_id'=> $property_id,
										  'page'=>$page,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='booking_list/cancel_list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}
	
//****************************************************saheb Starting here********************************************************************************	
	public function arrival()
	{
		$this->chk_login();
		$property_id				= $this->uri->segment(3);
		$page					= $this->uri->segment(4);
		$this->data['arrival_list']		= $this->model_booking_list->arrival_list($property_id);
		//pr($this->data['arrival_list']);
		$this->data['controller'] 		= 'booking_list';
		$this->data['view_link']      		= AGENT_URL."booking_list/arrival_view/{{ID}}/".$property_id.'/'.$page.'/';
		$this->data['deal_link']      		= AGENT_URL."booking_list/deal_view/{{ID}}/".$property_id.'/'.$page;	

		$this->data['tabs'] 			= $this->load->view('booking_list/property_tab',array('select_tab'=>'arrival','property_id'=>$property_id,'page'=>$page),true);
		$propertDtls 				= $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] 		= $this->load->view('property/property_header',
									    array('select_tab'=>'bookings',
										  'property_id'=> $property_id,
										  'page'=>$page,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='booking_list/arrival_list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}

//***********************************************************************************************************************************							
	public function view()
	{
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$payment_id 	= $this->uri->segment(3, 0);
		$row = array();
		
		$booking = $this->model_booking_list->veiw_booking($payment_id); //pr($arr_enquiry_detail);
		//pr($booking);
		if($booking){
		    $this->data['booking'] = $booking;
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Record does not exist.");
			redirect(base_url('propertybooking/index/'.$page));
			return false;
		}
		
		$this->load->view('booking_list/view',$this->data);
	}
	
	
	
	
	public function cancel_booking()
	{
		$property_id 	= $this->uri->segment(4, 0);
		$id 		= $this->uri->segment(3,0);
		$page 		= $this->uri->segment(5,0);
		$this->model_booking_list->cancelBooking();
		
		$this->nsession->set_userdata('succmsg', "Booking has been cancelled successfully");
		
		$redirect_url = AGENT_URL."booking_list/bookings/".$property_id.'/'.$page.'/';
		
		redirect($redirect_url);
	}
				
	public function arrival_view(){   
			$this->chk_login();
			$page		= $this->uri->segment(4, 0);
			$peyment_id 	= $this->uri->segment(3, 0);
			$row = array();
			$booking = $this->model_booking_list->veiw_booking($peyment_id);
			//pr($booking);
			if($booking){
				$this->data['booking'] = $booking;
				$this->model_basic->updateIntoTable(PAYMENT_INFO,array('paymeny_id'=>$peyment_id),array('view'=>'Y'));
			}
			else{
				$this->nsession->set_userdata('errmsg', "Record does not exist.");
				redirect(base_url('propertybooking/index/'.$page));
				return false;
			}
			$this->load->view('booking_list/arrivel_view',$this->data);
	}

		
		
		
		public function deal_view()
			{

					$this->chk_login();
					$page		= $this->uri->segment(4, 0);
					$peyment_id = $this->uri->segment(3, 0);
		
				//$row = array();
		
				$booking = $this->model_booking_list->deal_view($peyment_id); 
				if($booking){
					 $this->data['booking'] = $booking;
					
				$this->load->view('booking_list/deal_view',$this->data);
					}
			}




			

}