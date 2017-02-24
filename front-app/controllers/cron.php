<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Cron extends CI_Controller

{
	function __construct()
	{
		parent::__construct();


		$this->load->model('model_cron');
		$this->load->model('model_basic');

	}

	public function index()
	{

	  $emailData = $this->model_cron->email();

	  if($emailData>0){

	 

	    foreach ($emailData as $value)
	{
				$FirstName  	 	  =  $value['first_name'];
				$Last_Name   	 	  =  $value ['last_name'];
				$Email       		  =  $value['email'];
				$property_master_id   =  $value['property_master_id'];
				$property_name		  =  $value['property_name'];
				$paymeny_id			  =  $value['paymeny_id'];
				$feedbacklink = FRONTEND_URL.'feedback/'.md5($value['email']).'-'.md5($property_master_id).'-'.md5($paymeny_id);
				//echo "<br><br>";//die();
	
			
				 $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=10');
	            
	            $mail_config['to']          = stripslashes(trim( $Email));
	            //$mail_config['to']         	 = 'saheb.mondal@webskitters.com';
	            //$mail_config['from']          = 'nasmin.begam@webskitters.com';
	            $mail_config['from']        = $template[0]['responce_email'];
	            $mail_config['from_name']   = 'Hostelmofo Team';
	            $mail_config['subject']     = $template[0]['email_subject'];
	            
	            $mail_config['message']     = $template[0]['email_content'];
	            $property_name              = $this->model_basic->getValue_condition('hw_property_master', 'property_name', '', 'property_master_id='.$property_master_id.'');
	            
	            $mail_config['message']     =  str_replace(array('{FIRSTNAME}','{LASTNAME}','{PROPERTYNAME}','{FEEDBACKLINK}'),
	            							   array($FirstName,$Last_Name,$property_name,$feedbacklink),stripslashes($mail_config['message']));
	            
	            //pr($mail_config['message']);
	            
	            $mailsend_admin               = send_html_email($mail_config);


	        }

			 }else{echo 'No Customer have not Found Who Check out Yesterday!';}

	}    






}
















?>