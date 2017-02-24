<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_booking');
		$this->load->model('model_basic');
	}


	public function index()
	{
		$this->chk_login();
		$cms_slug		=	$this->uri->segment(1);
		$data['property_details']= $this->model_booking->booked();
		$data['succMsg'] = $this->nsession->userdata('succMsg');
		$data['errMsg']	= $this->nsession->userdata('errMsg');
		$title = "Booking Details";
		//pr($data);
		$this->nsession->set_userdata('succMsg','');
		$this->nsession->set_userdata('errMsg','');
		$this->templatelayout->make_seo();
		//$this->templatelayout->get_header();
		//$this->templatelayout->get_banner();
		$this->templatelayout->get_breadcrumb();
		//$this->templatelayout->get_footer();
		
		//$this->templatelayout->get_header();
		//$this->templatelayout->get_cms_header($cms_slug);
		//$this->templatelayout->get_banner();
		//$this->templatelayout->get_banner('','','hostel');
		$this->templatelayout->get_banner_inner('',$title);
		//$this->templatelayout->get_footer();
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']='booking_details/view_booking_details';			
		$this->elements_data['middle'] = $data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}

	public function view_details(){
		$paymeny_id = $this->uri->segment(3);
		$data['view_details']= $this->model_booking->view($paymeny_id);
		$data['succMsg'] = $this->nsession->userdata('succMsg');
		$data['errMsg']	= $this->nsession->userdata('errMsg');
		$this->nsession->set_userdata('succMsg','');
		$this->nsession->set_userdata('errMsg','');
		$title = "View Booking Details";
		$this->templatelayout->make_seo();
		$this->templatelayout->get_header();
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_footer();

		$this->elements['middle']='booking_details/property_details';			
		$this->elements_data['middle'] = $data;

		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}

	public function cancelled()
	{
		
		$data['property_details']= $this->model_booking->cancelled();

		$data['succMsg'] = $this->nsession->userdata('succMsg');
	    $data['errMsg']	= $this->nsession->userdata('errMsg');
	    $title = "Cancelled Booking";
	    //pr($data);
	    $this->nsession->set_userdata('succMsg','');
	    $this->nsession->set_userdata('errMsg','');
	    $this->templatelayout->make_seo();
	    $this->templatelayout->get_header();
	    $this->templatelayout->get_banner_inner('',$title);
	    $this->templatelayout->get_breadcrumb();
	    $this->templatelayout->get_footer();
	    
	    $this->elements['middle']='booking_details/view_booking_details';			
	    $this->elements_data['middle'] = $data;
			
	    $this->layout->setLayout('details_layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function property_cancel()
	{

		$paymeny_id = $this->uri->segment(3);
		$user_id = $this->nsession->userdata('USER_ID');
		$amount= $this->model_booking->property_cancelled($paymeny_id);
		$paybleAmount = $amount[0]['payble_amount'];
		$bookingStatus = $amount[0]['Booking_status'];
		$paymeny_id = $amount[0]['paymeny_id'];
		$property_id = $amount[0]['property_id'];
		$bookingDate = $amount[0]['added_date'];

		if($bookingStatus=='Booked'){
			$bookingStatus='Cancelled';	
		}
		if($amount[0]['booking_type'] != 'flexible'){
			$paybleAmount = 0;
		}
		$currentDate = date('Y-m-d h:i:s');
		$credit = 'cr';

		$data = array('user_id' => $user_id,
			  'amount'=> $paybleAmount,
			  'debit_credit'=> $credit,
			  'property_id'=> $property_id,
			  'added_on'=>$currentDate );

		$diff = strtotime($currentDate) - strtotime($bookingDate);
		$diff_in_hrs = $diff/3600;
		if($diff_in_hrs<=24)
		{  
		$this->model_basic->insertIntoTable(WALLET,$data);

		} else { 

				$commissionArray = $this->model_basic->getValues_conditions(SITESETTINGS,'sitesettings_value','',"sitesettings_id='22'");
				$commissionAmount = $commissionArray[0]['sitesettings_value']; 
				$newAmount = $paybleAmount-($paybleAmount * $commissionAmount/100);

					  $data = array('user_id' => $user_id,
								   'amount'=> $newAmount,
								   'debit_credit'=> $credit,
								   'property_id'=> $property_id,
								   'added_on'=>$currentDate );

				$this->model_basic->insertIntoTable(WALLET,$data);

			  }


		$updateBookingStatus = $this->model_booking->update_status(PAYMENT_INFO,$bookingStatus,$paymeny_id);

		if($updateBookingStatus>0)
		{	
		}
		$user_id 	= $this->nsession->userdata('USER_ID');
		$userArray  = $this->model_basic->getValues_conditions(USER,'*','',"id='$user_id'");
		$FirstName  = $userArray[0]['firstname'];
		$Last_Name	=  $userArray[0]['lastname'];


		   $emailArray =  $this->model_booking->send_mail($property_id);

		 $emailId = $emailArray[0]['email_id'];
		 $property_name = $emailArray[0]['property_name'];
		
		//die();

		$template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=13');

		$mail_config['to']        = stripslashes(trim( $emailId));
		//$mail_config['to']          = 'maantu.das@webskitters.com';
		//$mail_config['from']      = 'maantu.das@webskitters.com';
		$mail_config['from']        = $template[0]['responce_email'];
		$mail_config['from_name']   = 'Hostelmofo Team';
		$mail_config['subject']     = $template[0]['email_subject'];

		$mail_config['message']     = $template[0]['email_content'];


		$mail_config['message']     =  str_replace(array('{FIRST-NAME}','{LAST-NAME}','{PROPERTY-NAME}'),
		array($FirstName,$Last_Name,$property_name),stripslashes($mail_config['message']));

		//pr($mail_config['message']);

			  $mailsend_admin  = send_html_email($mail_config);

	
		$this->nsession->set_userdata('succMsg','YOUR PROPERTY IS CANCELLED');
		redirect(FRONTEND_URL.'booking_details');
	

	}




}
?>