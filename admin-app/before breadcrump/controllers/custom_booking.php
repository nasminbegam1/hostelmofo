<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom_booking extends CI_Controller
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
		$this->load->model('model_booking');
		$this->load->model('model_calendar');
		
	}
	
	public function listing()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."custom_booking/listing/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
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
		
		$this->data['bookingList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['bookingList']		= $this->model_custom_booking->getAllBookingList($config,$start);
		
		$i=0;

		$this->data['latestBooking']=$this->model_basic->getValues_conditions($this->customBooking,'cb_id','','',' cb_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;  
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'custom_booking';	
		$this->data['base_url'] 		= BACKEND_URL."custom_booking/listing/0/1/";
		$this->data['show_all'] 		= BACKEND_URL."custom_booking/listing/0/1/";
		$this->data['view_link']      		= BACKEND_URL."custom_booking/view_booking/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."custom_booking/lead_booking/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."custom_booking/delete_booking/{{ID}}/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='custom_booking/custom_booking_listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
		
	}
	
	/*** for Business Type Category ***/

public function batch_action(){
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
		//pr($_POST);		
		if($action == 'Delete'){
				$this->deletebatch();
		}  else {
				$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."custom_booking/listing/".$per_page1);
		return true;
			
	}
	
	
public function order_batch_action(){
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
		//pr($_POST);		
		if($action == 'Delete'){
				$this->deleteOrderbatch();
		}  else {
				$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."custom_booking/order/".$per_page1);
		return true;
			
	}	
	private function deletebatch(){		
		$return = $this->model_custom_booking->deleteBatchEnquiry();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Select booking deleted successfully.");
		}
		return true;
	}
	
	private function deleteOrderbatch(){		
		$return = $this->model_custom_booking->deleteOrderBatchEnquiry();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Select booking deleted successfully.");
		}
		return true;
	}
	
	public function delete_booking(){
		$book_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM lp_custom_booking WHERE cb_id = '".$book_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		$this->nsession->set_userdata('succmsg', "Selected booking deleted successfully.");
		
		redirect(BACKEND_URL.'custom_booking/listing/'.$page);
	}
	
	

	public function get_new_enquiry()
	{		
		$data=array();
		$book_id=$this->input->get_post('latest_booking');
		$book_details= $this->model_custom_booking->getValue_condition("lp_custom_booking","","  cb_id > '".$book_id."'");

		$latest = $book_details;
		if(isset($latest[0]['cb_id']))
		{
			
			//echo "hhh";
			$prop_name = $this->model_custom_booking->getValue_condition("lp_property_master","property_name","  property_id = '".$latest[0]['property_id']."'");
			$prop_slug = $this->model_custom_booking->getValue_condition("lp_property_master","property_slug","  property_id = '".$latest[0]['property_id']."'");
			//echo $prop_slug[0]['property_slug'];
			if(isset($prop_slug[0]['property_slug']))
				$book_details[0]['prop_slug'] = $prop_slug[0]['property_slug'];
			//pr($prop_slug,0);
			if(isset($prop_name[0]['property_name']))
				$book_details[0]['prop_name'] = $prop_name[0]['property_name'];
		}
		
		$data['new_custom_booking'] = 	$book_details;
		if(isset($latest[0]['cb_id']))
		{
			$data['latest_id'] = $latest[0]['cb_id'];			
		}
		else
		{
			$data['latest_id'] = $book_id;			
		}
		//echo $data['latest_id'] ;exit;
		echo $html = $this->load->view('custom_booking/get_new_booking', $data, TRUE);	
	}
	public function view_enquiry()
	{
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$enquiry_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "property_share";
		$this->data['base_url'] 	= BACKEND_URL."property_share/listing/".$listingpage."/0/1/";
		
	        $row = array();
		// Prepare Data
		
		//$this->model_property_share->changeEnquiryRead($enquiry_id);
		
		$arr_enquiry_detail = $this->model_property_share->getEnquiryDetails($enquiry_id); //pr($arr_enquiry_detail);
		
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/listing/".$listingpage."/".$page;
		
		$row = $arr_enquiry_detail[0];
		//echo $row;
                if($row){
                    $this->data['enquiryDetails'] = $row;
                }
		else
		{
			$this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/".$listingpage."/".$page."/");
                        return false;
		}
		
		//$property_field_name		= array('property_search_info', 'property_search_flag');
		//$property_condition		= "sf_id = '".$enquiry_id."'";
		//$arr_property_visited 		= $this->model_basic->getValues_conditions($this->propertyVisited, $property_field_name, '', $property_condition); //pr($arr_property_visited);
		//$this->data['arr_property_search'] 	= $arr_property_visited;
		
		$this->data['succmsg']	= $this->session->userdata('succmsg');
		$this->data['errmsg'] 	= $this->session->userdata('errmsg');
		
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");
		//$firstcrumbname = $arr_enquiry_detail[0]['sales_rentals'].' Enquiry Listing';
		
		$brdArr	= array( 'Enquiry'=> $this->data['return_link'], "View enquiry" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('');
		$this->elements['middle']='enquiry/enquiry_property_share_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	
	}
	
	
	public function view_booking()
	{
		chk_login();
		$page		= $this->uri->segment(4, 0);
		//$booking_id	=	0;
		$booking_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "custom_booking";
		$this->data['base_url'] 	= BACKEND_URL."custom_booking/listing/";
		
		$this->data['view_url'] 	= BACKEND_URL."custom_booking/view_booking/".$booking_id."/".$page;
		
		$this->data['return_link'] 	= BACKEND_URL."custom_booking/listing/";
		$booking_details		= $this->model_basic->getValues_conditions('lp_custom_booking','',''," `cb_id` = '".$booking_id."'");
		
		$this->data['booking_details']	= $booking_details;
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='custom_booking/booking_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	

	}
	
	public function order()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."custom_booking/order/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('ORDER');
		
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
		$this->data['orderList']		= $this->model_custom_booking->getOrderList($config,$start);
		
		//pr($this->data['orderList'],1);
		$i=0;

		$this->data['latest_order']=$this->model_basic->getValues_conditions('lp_custom_payment','cp_id','','',' cp_id DESC ','',$Limit=1); 
		
		$this->data['startRecord'] 		= $start;  
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'custom_booking';	
		$this->data['base_url'] 		= BACKEND_URL."custom_booking/order/0/1/";
		$this->data['show_all'] 		= BACKEND_URL."custom_booking/order/0/1/";
		$this->data['view_link']      		= BACKEND_URL."custom_booking/view_order/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."custom_booking/lead_booking/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."custom_booking/delete_order/{{ID}}/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='custom_booking/order';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
				
		
	}
	
	
	public function view_order()
	{
		chk_login();
		$page		= $this->uri->segment(4, 0);
		$order_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "custom_booking";
		$this->data['base_url'] 	= BACKEND_URL."custom_booking/order/";
		$this->data['view_url'] 	= BACKEND_URL."custom_booking/view_order/".$order_id."/".$page;
		//$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/view_booking/".$booking_id."/".$page;
		
		$order_details			= $this->model_basic->getValues_conditions('lp_custom_payment','',''," `cp_id` = '".$order_id."'");
		
		$order_details[0]['optional_title']	=	$this->model_basic->getValue_condition('lp_property_master','optional_title',''," `property_id` = '".$order_details[0]['property_id']."'");

		$this->data['order_details']	= $order_details;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='custom_booking/view_order';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	
	}
	
	public function delete_order(){
		$book_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM lp_custom_payment WHERE cp_id = '".$book_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		$this->nsession->set_userdata('succmsg', "Selected order deleted successfully.");
		
		redirect(BACKEND_URL.'custom_booking/order/'.$page);
	}
	
	public function get_new_order()
	{		
		$data=array();
		$order_id=$this->input->get_post('latest_order');
		$order_details= $this->model_custom_booking->getValue_condition("lp_custom_payment","","  cp_id > '".$order_id."'");

		$latest = $order_details;
		if(isset($latest[0]['cp_id']))
		{
			
			//echo "hhh";
			$prop_name = $this->model_custom_booking->getValue_condition("lp_custom_payment","property_name","  property_id = '".$latest[0]['property_id']."'");
			$prop_slug = $this->model_custom_booking->getValue_condition("lp_custom_payment","property_slug","  property_id = '".$latest[0]['property_id']."'");
			//echo $prop_slug[0]['property_slug'];
			if(isset($prop_slug[0]['property_slug']))
				$order_details[0]['prop_slug'] = $prop_slug[0]['property_slug'];
			//pr($prop_slug,0);
			if(isset($prop_name[0]['property_name']))
				$order_details[0]['prop_name'] = $prop_name[0]['property_name'];
		}
		
		$data['new_custom_order'] = 	$order_details;
		if(isset($latest[0]['cb_id']))
		{
			$data['latest_id'] = $latest[0]['cp_id'];			
		}
		else
		{
			$data['latest_id'] = $order_id;			
		}
		//echo $data['latest_id'] ;exit;
		echo $html = $this->load->view('custom_booking/get_new_order', $data, TRUE);	
	}
	
	
	
	
	
	
	
	public function viewcustom(){
		chk_login();
                $customkey	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4,0);
		
		$this->data['customkey'] 	= $customkey;
		$this->data['page'] 		= $page;
		
		$this->data['bookingDetails']	= $this->model_booking->getBookingDetails($customkey);
		if($this->data['bookingDetails'] && is_array($this->data['bookingDetails']) ){
			
		} else {
			$this->nsession->set_userdata('errmsg', "Invalid URL or the booking doesnot exist.");
			redirect(BACKEND_URL."custom_booking/listing");
			return true;  
		}
		
                $this->data['controller']	= "custom_booking";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/listing/".$page;
		
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/viewcustom/".$customkey."/".$page;
		
		$this->data['action_link']  	= BACKEND_URL.$this->data['controller']."/viewcustom/".$customkey.'/';
		
		if($this->input->get_post('action') == 'Process')
		{
			
			
			$this->form_validation->set_rules('discountprice', 'Discount Price', 'trim|required');
			//$this->form_validation->set_rules('exchangerate', 'Exchange Rate', 'trim|required');
			$this->form_validation->set_rules('paypalrate', 'Paypal Rate', 'trim|required');
			$this->form_validation->set_rules('payduedate', 'Payment Due Date', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{				
				//pr($_POST);
				$discountprice	= $this->input->get_post('discountprice');
				//$exchangerate	= $this->input->get_post('exchangerate');
				$paypalrate	= $this->input->get_post('paypalrate');
				$status		= $this->input->get_post('status');
				$depositpercent	= $this->input->get_post('depositpercent');
				$payduedate	= $this->input->get_post('payduedate');
				$discountpercent= $this->input->get_post('discountpercent');
				
				$depositpercent	= $this->input->get_post('depositpercent');
				$depositamount	= $this->input->get_post('depositamount');
				$dep_percent_amount	= $this->input->get_post('dep_percent_amount');
				
				$show_discount	= $this->input->get_post('show_discount');
				
				if($dep_percent_amount	== 'per'){
					if( isset($depositpercent) && $depositpercent > 0 ){
						$depositamount	= ( ( $discountprice * $depositpercent ) / 100 );
					}
				} else {
					if( isset($depositamount) && $depositamount > 0 ){
						$depositpercent	= ( (  100 * $depositamount ) / $discountprice );
					}
				}
				
				if( isset($payduedate) && $payduedate != ''){
					$arrDueDate 	= explode('/',$payduedate);
					
					$due_date_ymd	= $arrDueDate[2].'-'.$arrDueDate[0].'-'.$arrDueDate[1];
				} else {
					$due_date_ymd = '0000-00-00';
				}
				//echo $due_date_ymd;
				//die();
				$insertArr  =  array(
							'discountprice' => $discountprice,
							'paypalrate' 	=> $paypalrate,
							'dep_percent_amount'=> $dep_percent_amount,
							'depositpercent'	=> $depositpercent,
							'depositamount'		=> $depositamount,
							'show_discount' 	=> $show_discount,
							'discountpercent' => $discountpercent,
							'payduedate' 	=> $due_date_ymd,
							'depositstatus'	=> $status
						);
				//pr($insertArr);		    
				$idArr		= array( 'custom_key' => $customkey );				
				$ret   = $this->model_basic->updateIntoTable('lp_custom_booking',$idArr, $insertArr);
				//if($ret)
				//{					
				//	$this->nsession->set_userdata('succmsg', "Custom Booking has been updated.");
				//	 
				//}
				//else
				//{
				//	$this->nsession->set_userdata('errmsg', "Unable to create Custom Booking. Please try again later.");
				//}
				$this->nsession->set_userdata('succmsg', "Custom Booking has been updated.");
				redirect(BACKEND_URL."custom_booking/listing/".$page."/");
				return true; 
			}
		}
                
                $this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='custom_booking/edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
}