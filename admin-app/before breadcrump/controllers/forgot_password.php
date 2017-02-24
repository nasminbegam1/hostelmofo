<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                $this->load->model('model_forgotpassword');
                $this->load->model('model_basic');
		
	}
        
        public function forgotpassword()
	{		
		$this->data = '';
		
		$this->data['msg'] = $this->nsession->userdata('msg');
		$this->nsession->set_userdata('msg', '');
		
		if($this->nsession->userdata('admin_id') != '')
		{
			$url = BACKEND_URL."login/";
			redirect($url);
		}
		
		$this->elements['middle']='forgotpassword/forgotpassword';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout_login');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
        
        public function do_forgotpassword()
        {
            $this->load->library('email');
            if($this->nsession->userdata('admin_id') != '')
	    {
			$url = BACKEND_URL."login/";
			redirect($url);
	    }
            
            $email = $this->input->get_post('email');
            
            	if(isset($email) && !empty($email))
		{
			$arrUser 	= $this->model_forgotpassword->getUserByEmail($email);			
			
			if(count($arrUser) > 0){	
				
				$first_name 	= $arrUser[0]['first_name'];
				$last_name 	= $arrUser[0]['last_name'];	
				$password 	= $arrUser[0]['password'];	
				//$email 	= $arrUser[0]['email_id'];	
				//$message	= "Hello ".$first_name." ".$last_name.", <br>Please note down your password:".$password;
				//$from		= "rahuld.webskitters@gmail.com";
				
				$settings 	= $this->model_basic->get_settings('1,6');
				
				//$to 		= $email;	
				//$subject	= "Password Recovery";	
				//$headers  	= "MIME-Version: 1.0\r\n";	
				//$headers 	.= "Content-type: text/html; charset=iso-8859-1\r\n";	
				//$headers 	.= "From: CI214 <".$from.">\r\n";
				//$ConfigMail['headers']	="MIME-Version: 1.0\r\n";
                                //$ConfigMail['headers']="Content-type: text/html; charset=iso-8859-1\r\n";	
                                
				//$ConfigMail['mailtype'] 	= 'html';
				$ConfigMail['to'] 	= $arrUser[0]['email_id'];
				$ConfigMail['from']	= $settings['webmaster_email'];
				$ConfigMail['from_name']= $settings['sitename'];
				$ConfigMail['subject']	= "Password Recovery at ".BACKEND_URL;
				$ConfigMail['message'] = '<html><body>';
                                $ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<p> Please note down your password for admin panel : '.$password.'</p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Thanks, </p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Team '.$settings['sitename'].'</p>';
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<a href="'.BACKEND_URL.'">'.BACKEND_URL.'</a>';
                                $ConfigMail['message'].= '</body></html>';
						
				$mail 		= send_email($ConfigMail);
				
				if($mail)	
				{	
					$msg = 'Password sent to your mail address. Please check.';	
				}
				}else{
					$msg = stripslashes($email) . ' was not found in our database';
				}
		}
		else
		{
			$msg = 'Please enter mail address';			
		}
		
		$this->nsession->set_userdata('msg', $msg);
		redirect('forgot_password/forgotpassword');
		return true;
		
            
        }
}

?>