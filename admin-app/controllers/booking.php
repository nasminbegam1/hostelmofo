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
	
	public function index(){
		$this->chk_login();
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('BOOKING');
			redirect(currentClass().'/index/0');
		}
		
		$config['base_url'] 	= BACKEND_URL."booking/index/";
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
		$i=0;
		
		
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= BACKEND_URL."booking/index/0/1/";
		$this->data['view_link']      		= BACKEND_URL."booking/view/{{ID}}/".$page."/";		
		$this->data['delete_link']     		= BACKEND_URL."booking/delete/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
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
		else{
			$this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(base_url('booking/index/'+$page));
                        return false;
		}
		
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='booking/view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function booking_cancel(){
		$cancel_id = $this->input->post('cancel_id');
		$payment_details = $this->model_basic->getValues_conditions(PAYMENT_INFO,'','','paymeny_id='.$cancel_id);
		
		if(is_array($payment_details) && count($payment_details) == 1){
			
			$id = $payment_details[0]['paymeny_id'];
			$paid_amount = $payment_details[0]['payble_amount'];
			$booking_type = $payment_details[0]['booking_type'];
			$property_id = $payment_details[0]['property_id'];
			$agent_roomtype_ID = $payment_details[0]['agent_roomtype_ID'];
			$first_name = $payment_details[0]['first_name'];
			$last_name = $payment_details[0]['last_name'];
			$email = $payment_details[0]['email'];
			$user_id = $payment_details[0]['user_id'];
		
			if($user_id != ''){
				if($booking_type != 'Non-flexible'){
					$walletArr = array('user_id'=>$user_id,
									 'amount' =>$paid_amount,
									 'debit_credit'=>'cr',
									 'property_id' => $property_id,
									 'added_on' => date('Y-m-d h:i:s')
									);
					$wallet_id = $this->model_basic->insertIntoTable('hw_wallet',$walletArr);
				}
			}
			
			$updateArr = array('Booking_status'=>'Cancelled','cancel_date'=>date('Y-m-d h:i:s'));
			$update = $this->model_basic->updateIntoTable(PAYMENT_INFO,array('paymeny_id'=>$cancel_id),$updateArr);
			if($update){
				$send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
				$template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=15');
				$mail_config['to']          = $email;
				$mail_config['to']          = 'maantu.das@webskitters.com';
				$mail_config['from']        = $template[0]['responce_email'];
				$mail_config['from_name']   = 'Hostel Mofo';
				$mail_config['subject']     = $template[0]['email_subject'];
				$mail_config['message']     = $template[0]['email_content'];
				$mail_config['message']     = str_replace(
																		array('{FIRSTNAME}','{LASTNAME}'),
																		array($first_name,$last_name),
																		$mail_config['message']
																	);
				$mailsend_user          = send_html_email($mail_config);
				if($mailsend_user){
					echo 'ok';
				}
			}
		}
	}
	
	
}