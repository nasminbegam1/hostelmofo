<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends My_Controller
 
  {
        //var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_booking_list');
		$this->load->model('model_report');
	}


	public function customer_rating()
	{
		$this->chk_login();
		
		$property_id= $this->uri->segment(3);
		
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'reportList','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$date=strtotime(date('Y-m-d'));
		//$from = date('Y-m-d',strtotime('-15 days',$date));
		//$to = date('Y-m-d');
		$from	= '';
		$to 	= '';
		if($this->input->get_post('from_dt') != '' || $this->input->get_post('to_dt') != '')
		{
			$from = $this->input->get_post('from_dt');
			$to = $this->input->get_post('to_dt');
		}
		$this->data['report_details']	= $this->model_report->getList($property_id,$from,$to);
		$this->data['rating'] 		= $this->model_report->getRating($property_id,$from,$to);

	        $this->data['from']	 	= $from;
	        $this->data['to']	 	= $to;
		
		$this->data['controller'] 	= currentClass();	
		$this->data['base_url'] 	= AGENT_URL.$this->data['controller']."/customer_rating/0/1/";
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Customer Rating' );
	
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
	public function sales()
	{
		$this->chk_login();
		$property_id= $this->uri->segment(3);
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'sales','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$from = '';$to = '';$year_select = '';
		//pr($_POST);
		$action = $this->input->get_post('action');
		if($action == 'fromToReport'){
			if($this->input->get_post('from_dt') != '' || $this->input->get_post('to_dt') != '')
			{
				$from = $this->input->get_post('from_dt');
				$to = $this->input->get_post('to_dt');
			}
		}else{
			$year_select = $this->input->get_post('year_select');
		}
		$this->data['from']	 	= $from;
	        $this->data['to']	 	= $to;
		$this->data['year_select']	= $year_select;
		$this->data['customer_analysis_report']	= $this->model_report->getSales($property_id,$from,$to,$year_select);
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Sales' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/sales';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function customer_analysis(){
		$this->chk_login();
		$property_id= $this->uri->segment(3);
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'customerAnalysis','property_id'=>$property_id),true);
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
		$this->data['customer_analysis_report']	= $this->model_report->getCustAnalysis($property_id,$from,$to);
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
	public function booking_analysis(){
		$this->chk_login();
		$property_id= $this->uri->segment(3);
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'bookingAnalysis','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['property_name'] = stripslashes($propertDtls['property_name']);
		$this->data['booking_analysis_report']	= $this->model_report->getBookingAnalysis($property_id);
		$this->data['lastTwoMonthResult'] 	= $this->model_report->lastTwoMonthBooking($property_id);
		
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Booking Analysis' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/booking_analysis';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function reply(){
		$this->chk_login();
		$feedback_id = $this->uri->segment(3);
		$this->data['feedbackDtls'] = $this->model_report->getFeedback($feedback_id);
		$property_id = $this->data['feedbackDtls']['property_id'];
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'reportList','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['property_name'] = stripslashes($propertDtls['property_name']);
		if($this->input->get_post('action') == 'Process')
		{
		     $feedback_id = $this->input->post('feedback_id');
		     $this->form_validation->set_rules('subject','Subject','trim|required');
		     $this->form_validation->set_rules('message','Message','required|trim');
	 
		     if($this->form_validation->run() == true)
		     {
			$subject		= $this->input->post('subject');
			$message 		= addslashes( trim( $this->input->post('message') ) );
			$send_mail      	= $this->model_basic->getValue_condition(AGENT, 'email', '', 'agent_id='.$this->current_user['agent_id'].'');
			$to_email 		= $this->model_basic->getValue_condition(FEEDBACK, 'email', '', 'feedback_id='.$feedback_id.'');
			$mail_config['to']          = $to_email;
			//$mail_config['to']        = 'nasmin.begam@webskitters.com';
			$mail_config['from']        = trim($send_mail);
			$mail_config['from_name']   = 'Hostelmofo Team';
			$mail_config['subject']     = $subject;
			$mail_config['message']     = $message;
			//pr($mail_config);
			$mailsend             = send_email($mail_config);
			if($mailsend){
				$this->nsession->set_userdata('succmsg','Mail send successfully');
			}else{
				$this->nsession->set_userdata('errmsg','Mail not send');
			}
		     }
		     else
		     {
			$this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
		     }
		     redirect(AGENT_URL.'reports/reply/'.$feedback_id.'/');
		}
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Reply' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		//pr($this->data);
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/reply';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function query(){
		$this->chk_login();
		$send_email                  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
		$feedback_id 		= $this->uri->segment(3);
		$agent_details      	= $this->model_basic->getValues_conditions(AGENT, array('firstname,lastname'), '', 'agent_id='.$this->current_user['agent_id'].'');
		$send_mail      	= $this->model_basic->getValues_conditions(EMAILTEMPLATE, array('responce_email,email_subject,email_content'), '', 'template_id=14');
		$feedbackDtls 		= $this->model_report->getFeedbackDetails($feedback_id);
		$property_id 		= $feedbackDtls['property_id'];
		$propertDtls 		= $this->model_booking_list->get_property_name($property_id);
		$property_name 		= stripslashes($propertDtls['property_name']);
		
		$mail_config['to']          = stripslashes(trim($send_mails));
		//$mail_config['to']          = 'nasmin.begam@webskitters.com';
		$mail_config['from']        = $send_mail[0]['responce_email'];
		$mail_config['from_name']   = 'Hostelmofo Team';
		$mail_config['subject']     = str_replace('{PROPERTYNAME}',$property_name,stripslashes($send_mail[0]['email_subject']));
		$mail_config['message']     = $send_mail[0]['email_content'];
		
		$mail_config['message']     = str_replace(array('{USERNAME}','{MESSAGEID}','{AGENTFIRSTNAME}','{AGENTLASTNAME}'),array(stripslashes(trim($feedbackDtls['first_name'])).' '.stripslashes(trim($feedbackDtls['last_name'])),$feedback_id,stripslashes($agent_details[0]['firstname']),stripslashes($agent_details[0]['lastname'])),stripslashes($mail_config['message']));
		$mailsend             = send_email($mail_config);
		if($mailsend){
			$this->nsession->set_userdata('succmsg','Query send successfully');
		}else{
			$this->nsession->set_userdata('errmsg','Mail not send');
		}
		redirect(AGENT_URL.'reports/customer_rating/'.$property_id.'/');
	}
	public function elevate_reporting(){
		$this->chk_login();
		$property_id= $this->uri->segment(3);
		$this->data['tabs'] = $this->load->view('reports/tab',array('select_tab'=>'elevateAnalysis','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'reportList',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['property_name'] = stripslashes($propertDtls['property_name']);
		$date=strtotime(date('Y-m-d'));
		$from = date('Y-m-d',strtotime('-3 month',$date));
		//$from = date('Y-m-d');
		$to = date('Y-m-d',strtotime('+1 month',$date));
		if($this->input->get_post('from_dt') != '' || $this->input->get_post('to_dt') != '')
		{
			$from = $this->input->get_post('from_dt');
			$to = $this->input->get_post('to_dt');
		}
		$this->data['from']	 		= $from;
	        $this->data['to']	 		= $to;
		$this->data['elevate_analysis_report']	= $this->model_report->getElevateAnalysis($property_id);
		//pr($this->data);
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Elevate Reporting' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='reports/elevate_analysis';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}

	public function getData()
	{
		$k		= 0;
		$i		= 0;
		$parameters 	= $_POST;
		$booking_arr	= array();
		$from_Date	= $parameters['from_year'].'-'.$parameters['from_month'].'-01';
		$to_Date	= $parameters['to_year'].'-'.$parameters['to_month'].'-31';		
		$booking_arr	= $this->model_report->getArr($parameters['property_id'],$from_Date,$to_Date);		
		echo json_encode($booking_arr);
		exit;
	}
}
?>