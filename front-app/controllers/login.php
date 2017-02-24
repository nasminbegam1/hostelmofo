<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Login extends MY_Controller {
		  
    public function __construct(){
		  parent::__construct();
		  $this->load->model(array('model_basic'));
    }
		  
		  
    public function index(){
        $user_email_id =  mysql_real_escape_string($this->input->post('user_email_id'));
        $where = "email='".$user_email_id."' AND password = '".$this->input->post('user_password')."' AND provider = 'site'";
        $record = $this->model_basic->getValues_conditions(USER,'','',$where);
		  //echo $this->db->last_query();
		  //pr($record);
        if($record && $record[0]['activated']=='1'){
            $this->nsession->set_userdata('USER_ID',$record[0]['id']);
            $this->nsession->set_userdata('USER_FIRSTNAME',$record[0]['firstname']);
            $data['msg_type'] = 'success';
        }else{
            $data['msg_type'] = 'error';
        }
        echo  json_encode($data);
    }
		  
		  
    public function forgotpassword(){
		
        $this->data = '';
        if($this->input->post('action')=='Forgot-form' ){
			//echo "aaaa"; die();
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if($this->form_validation->run()){
				
                $email_address		= mysql_real_escape_string( trim( $this->input->get_post('email') ) );		
                $where              = "email='".$email_address."' AND provider = 'site'";
                $arrUser            = $this->model_basic->getValues_conditions(USER,'','',$where);
				$uid 				= $arrUser[0]['id'];
				$template			=  $this->model_basic->getValues_conditions(EMAILTEMPLATE,array('email_content,email_subject,responce_email'),'','template_id = 11');
				
                if($arrUser){
                   
							$new_password	= rand(1000, 9999);
							$idArr			= array('id'	=> $uid);
							$updateArr		= array('password'	=> $new_password);
							$updatedRecord	= $this->model_basic->updateIntoTable(USER, $idArr, $updateArr);
			    
						  $mail_config                  = array();
						  $mail_config['to'] 			= $email_address;					
						  $mail_config['from'] 			= stripslashes($template[0]['responce_email']);
						  $mail_config['from_name'] 	= 'Hostelmofo-noreply';
						  
						  $mail_config['subject'] 		= stripslashes($template[0]['email_subject']);
						  
						  //$mail_config['message']			= str_replace(array('{{FIRST-NAME}}','{{SITE-NAME}}','{{RESET-LINK}}'),array(stripslashes($arrUser[0]['firstname']),$mail_config['from_name'],$reset_link),stripslashes($template[0]['email_content']));
						  
						  $mail_config['message']			= str_replace(array('{{NEW_PASSWORD}}','{{LOGO}}'),array($new_password,FRONTEND_URL."images/in-logo.png"),stripslashes($template[0]['email_content']));
						  
						  $mailsnd = send_html_email($mail_config);
						  if($mailsnd){
                        $this->nsession->set_userdata('succmsg', 'Password has been sent to your email, Please check.');
                    }
                }
					 else{
                    $this->nsession->set_userdata('errmsg', 'Sorry! This Email id not exist in our database');
                }				
            }
		  }
		  $title = 'Forgot Password';
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
		  $this->templatelayout->make_seo();
		  //$this->templatelayout->get_header();
		  //$this->templatelayout->get_banner();
		  //$this->templatelayout->get_breadcrumb();
		  //$this->templatelayout->get_footer();
		  $this->templatelayout->get_banner_inner('',$title);
		  $this->templatelayout->get_inner_footer();
		  $this->elements['middle']	        ='login/forgot_password';			
		  $this->elements_data['middle'] 	= $this->data;
		  $this->layout->setLayout('details_layout');
		  $this->layout->multiple_view($this->elements,$this->elements_data);
    }
		  
		  
		  
		  
    public function reset_url(){
        $data			= array();
        $data['url_slug']	        = $this->uri->segment(2);
        if($this->input->post('action')=='Process'){
            $user_email 	= $this->input->post('uniqueVal');
				$password	= $this->input->post('password');
            $user_id 	= $this->model_basic->getValue_condition(USER,'id', '', 'md5(email) = "'.$user_email.'"');
            //echo $this->db->last_query();
            if($user_id > 0){
                $update_arr	= array('password'=>$password);
                $this->model_basic->updateIntoTable(USER,array('id'=>$user_id),$update_arr);
                //echo $this->db->last_query();
                //exit;
                $this->nsession->set_userdata('succMsg','Password Changed successfully!');
            }else{
                $this->nsession->set_userdata('errMsg','User Not Found');
            }
            redirect(FRONTEND_URL.'change-password/'.$user_email);
				exit;
        }
		  $data['succMsg']	        = $this->nsession->userdata('succMsg');
		  $data['errMsg']		= $this->nsession->userdata('errMsg');
		  //pr($data);
		  $this->nsession->set_userdata('succMsg','');
		  $this->nsession->set_userdata('errMsg','');
		  $this->templatelayout->make_seo();
		  $this->templatelayout->get_header();
		  $this->templatelayout->get_banner();
		  $this->templatelayout->get_breadcrumb();
		  $this->templatelayout->get_footer();
		  
		  $this->elements['middle']	        ='login/reset_passowrd';			
		  $this->elements_data['middle'] 	= $data;
						  
		  $this->layout->setLayout('details_layout');
		  $this->layout->multiple_view($this->elements,$this->elements_data);
	 }
        
		  
		  
	 public function registration(){
            $data			= array();
            $data['arrCountry']         = $this->model_basic->getValues_conditions('hw_countries',array('idCountry','countryName'),'',"country_status='active'");
            if($this->input->post('action')=="Process"){
                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
                $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
                $this->form_validation->set_rules('location', 'Location', 'trim|required');
                $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('conPassword', 'Confirm Password', 'trim|required');
                if($this->form_validation->run()){
						  $first_name	          	= addslashes($this->input->post('first_name'));
						  $last_name	          	= addslashes($this->input->post('last_name'));
						  $email_address		= addslashes($this->input->post('email_address'));
						  $birthDate			= addslashes($this->input->post('birthDate'));
						  $birthMonth			= addslashes($this->input->post('birthMonth'));
						  $birthYear			= addslashes($this->input->post('birthYear'));
						  $gender			= addslashes($this->input->post('gender'));
						  $location			= addslashes($this->input->post('location'));
						  $nationality			= addslashes($this->input->post('nationality'));
						  $password			= addslashes($this->input->post('password'));
						  $added_on	  		= date('Y-m-d H:i:s');
		
						  $insertArr  =  array(   'provider'            => 'site',
									  'firstname'		=> $first_name,
									  'lastname'		=> $last_name,
									  'email'	        => $email_address,
									  'birthDate'		=> $birthDate,
									  'birthMonth'		=> $birthMonth,
									  'birthYear'		=> $birthYear,
									  'gender'              => $gender,
									  'location'            => $location,
									  'nationality'         => $nationality,
									  'password'		=> $password,
									  'created'   		=> $added_on
						  );
						  $ret   = $this->model_basic->insertIntoTable(USER,$insertArr);	
						  if($ret){
								$settings = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'',"sitesettings_id IN (6)");
		    
								$mail_config                    	= array();
								$mail_config['to'] 			= $email_address;
								//$mail_config['to'] 			= 'nasmin.begam@webskitters.com';
								$mail_config['from_name'] 		= trim(stripslashes($settings[0]['sitesettings_value']));
								$template				=  $this->model_basic->getValues_conditions(EMAILTEMPLATE,array('email_content,email_subject,responce_email'),'','template_id = 12');
								$mail_config['from'] 		= trim($template[0]['responce_email']);
								$mail_config['subject'] 		= stripslashes($template[0]['email_subject']);
								$mail_config['message']		= str_replace(array('{{FIRST-NAME}}','{{LAST-NAME}}','{{EMAIL}}','{{PASSWORD}}','{{SITE-NAME}}','{{FRONT-URL}}'),array(stripslashes($first_name),stripslashes($last_name),$email_address,$password,$mail_config['from_name'],FRONTEND_URL),stripslashes($template[0]['email_content']));
								$mailsnd = send_html_email($mail_config);
								if($mailsnd){
									 redirect(FRONTEND_URL.'login/thankyou');
									 //$this->nsession->set_userdata('succmsg', 'User added successfully. You can login with your emaill address and password.');
								}else{
									 $this->nsession->set_userdata('errmsg', 'Sorry! This Email id not exist in our database');
								}
						  }
                }else{
		    pr(validation_errors(),0);
		    echo 'dfdf';
		    exit;
		}
            }
				$title = "Registration";
            $data['succmsg']	        = $this->nsession->userdata('succmsg');
            $data['errmsg']		= $this->nsession->userdata('errmsg');
            //pr($data);
            $this->nsession->set_userdata('succmsg','');
            $this->nsession->set_userdata('errmsg','');
            $this->templatelayout->make_seo();
				$this->templatelayout->get_banner_inner('',$title);
            //$this->templatelayout->get_header();
            //$this->templatelayout->get_banner();
            //$this->templatelayout->get_breadcrumb();
            //$this->templatelayout->get_footer();
				$this->templatelayout->get_inner_footer();
            
            $this->elements['middle']	        ='login/registration';			
            $this->elements_data['middle'] 	= $data;
                        
            $this->layout->setLayout('details_layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
	 }
	 
	 
	 public function emailExist(){
		  $email_address = $this->input->post('email_address');
		  $result = $this->model_basic->isRecordExist(USER,"email='".$email_address."' AND provider='site'");
		  if($result > 0) {
		    echo 'false';
		  } else {
		    echo 'true';
		  }
		  exit;
	 }
	 
	 public function thankyou(){
		  $data			= array();
		  $data['succmsg']	        = $this->nsession->userdata('succmsg');
		  $this->templatelayout->make_seo();
		  //$this->templatelayout->get_header();
		  $this->templatelayout->get_banner_inner('','');
		  //$this->templatelayout->get_banner();
		  $this->templatelayout->get_breadcrumb();
		  $this->templatelayout->get_footer();
		  $this->elements['middle']	        ='login/thankyou';			
		  $this->elements_data['middle'] 	= $data;
		  $this->layout->setLayout('details_layout');
		  $this->layout->multiple_view($this->elements,$this->elements_data);
		  
	 }
	 
}
?>