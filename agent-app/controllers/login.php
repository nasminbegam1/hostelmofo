<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
	}
	
	public function index()
	{
		$data= array();
		
		if($this->input->post('email') ){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');			
			if($this->form_validation->run()){
				$username =  mysql_real_escape_string($this->input->post('email'));
				
				$where = "email='".$username."' AND password = '".$this->input->post('password')."'";
				$record = $this->model_basic->getValues_conditions(AGENT,'','',$where);
				if($record && $record[0]['status']=='Active'){
					$this->nsession->set_userdata('current_user',$record[0]);
					redirect(base_url('property/'));
				}else{
					$data['error_msg'] = 'Wrong email id or password. Try again.';
				}
			}
		}elseif($this->is_logged()){
			
			redirect(base_url('property/'));
		}
		$this->load->view('login/index',$data);
	}
	
	public function forgotpassword()
	{ 
		$data= array();
		
		if($this->input->post('action')=='Forgot-form' ){
		
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			
			if($this->form_validation->run()){
				$agent_email		= mysql_real_escape_string( trim( $this->input->get_post('email') ) );		

				$where = "email='".$agent_email."'";
				$arrAgent = $this->model_basic->getValues_conditions(AGENT,'','',$where);
				//pr($arrUser);
				//exit;
			
				if($arrAgent){
					$emailTemplate 	= $this->model_basic->getFromWhereSelect(EMAILTEMPLATE,'','template_id=9');			
					$sitename 	= $this->model_basic->getFromWhereSelect(SITESETTINGS,'','sitesettings_id=6');
					
					$to      = $arrAgent[0]['email'];
					$from    = $emailTemplate[0]['responce_email'];
					$subject = $emailTemplate[0]['email_subject'];
					$message = stripslashes($emailTemplate[0]['email_content']);
					
					$RplVeriables =	array(
						      'AGENT_NAME'		=>$arrAgent[0]['firstname'].' '.$arrAgent[0]['lastname'],
						      'SITE_NAME'		=>$sitename[0]['sitesettings_value'],
						      'SITE_URL'		=>FRONTEND_URL,
						      'AGENT_URL'		=>AGENT_URL,
						      'AGENT_PASSWORD'		=>$arrAgent[0]['password']
						      );
					$message = ReplaceMessageConstants($RplVeriables, $message);					
					
					$config = array(
							'to'		=> $to,
							'from'		=> $from,
							'from_name'	=> 'HostelMofo',
							'subject'	=> $subject,
							'message'	=> $message);
					
					sendHtmlEmail($config);
						
					$data['succmsg'] = 'Login details have been sent to you email, Please check.';	
				}else{
					$data['error_msg'] = 'Sorry! This Email id not exist in our database';
				}				
			}else{
				$this->nsession->set_userdata('errmsg', 'Invalid email id');				
			}
					
		}elseif($this->is_logged()){
			
			redirect(base_url('dashboard'));
		}
		
		$this->load->view('login/forgotpassword',$data);
	}	
	
	
	
	public function logout(){
		$this->nsession->unset_userdata('current_user');
		$this->nsession->destroy();
		redirect(base_url('login'));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
