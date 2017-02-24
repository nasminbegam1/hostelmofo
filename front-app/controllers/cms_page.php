<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms_page extends MY_Controller {
	
	var $cmsMaster 			= 'hw_cms';
	var $newsletterTable 		= 'hw_newsletter';
	
	 public function __construct(){
			parent::__construct();
			$this->load->model('model_basic');
			//$this->load->library('email');
	 }
	
	 public function index(){ 
			create_proper_url();
	 
			$this->data = '';
			$cms_id 		= 4;
			$cms_slug		=	$this->uri->segment(1);
	 
			if($this->uri->total_segments() < 2){
				 $this->data['cms_details']	=	array();
				 
				 $cms_details	=	$this->model_basic->getValues_conditions($this->cmsMaster, array('cms_id','cms_title','cms_slug','cms_content', 'cms_meta_title', 'cms_meta_key', 'cms_meta_desc','cms_image'), '', ' cms_slug = "'.$cms_slug.'" ');
				 //pr($cms_details);
			
				 if($cms_details){
						$this->data['cms_details']	=	$cms_details[0];
				 }
				 
				 $title = ucwords(stripslashes(trim($this->data['cms_details']['cms_title'])));
				 $key  	= stripslashes($this->data['cms_details']['cms_meta_key']);
				 $desc 	= stripslashes($this->data['cms_details']['cms_meta_desc']);
				 
				 $share = array(
												'og'=>array(
																		'site_name'=>$title,
																		'description'=>$desc,
																		'image'=>'',
																		'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
																 ),
												'twitter'=>array(
																					'image'=>'',
																					'title'=>$title,
																					'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
																			 )
												);
			
				 
				 $this->data['succmsg'] = $this->nsession->userdata('succmsg');
				 $this->data['errmsg'] = $this->nsession->userdata('errmsg');
			
				 $this->nsession->set_userdata('succmsg', "");		
				 $this->nsession->set_userdata('errmsg', "");
			
				 $this->templatelayout->make_seo($title,$desc,$key,$share);
				 //$this->templatelayout->get_cms_header($cms_slug);
				 $this->templatelayout->get_banner_inner('',$cms_slug);
				 //$this->templatelayout->get_banner($city, $temploc, $ptype, $type_id,$property, $baner_check_in, $baner_check_out,$guest,$group_type,$age_ranges,$breadcrumb_arr);
				 //$this->templatelayout->get_banner('','','hostel');
				 
				 $this->templatelayout->get_inner_footer();
				 //$this->templatelayout->get_footer();
			
				 $this->elements['middle']	=	'cms/index';			
				 $this->elements_data['middle'] 	= 	$this->data;
				 
				 $this->layout->setLayout('details_layout');
				 $this->layout->multiple_view($this->elements,$this->elements_data);
			}
			else{
				 redirect(FRONTEND_URL.$cms_slug.'/');
			}
	 }
	 
	 
	 public function cms_details()
	 {
		       
	 
			$this->data = '';
			
			$cms_slug		= $this->uri->segment(3);       
			if($cms_slug){
				 $this->data['cms_details']	=	array();
				 
				 $cms_details	=	$this->model_basic->getValues_conditions($this->cmsMaster, array('cms_id','cms_title','cms_slug','cms_content', 'cms_meta_title', 'cms_meta_key', 'cms_meta_desc','cms_image'), '', ' cms_slug = "'.$cms_slug.'" ');
				//pr($cms_details);
				 if($cms_details){
						$this->data['cms_details']	=	$cms_details[0];
				 }
				 
				$title = ucwords(stripslashes(trim($this->data['cms_details']['cms_title'])));
				 $key  	= stripslashes($this->data['cms_details']['cms_meta_key']);
				 $desc 	= stripslashes($this->data['cms_details']['cms_meta_desc']);
				 
				 $share = array(
												'og'=>array(
																		'site_name'=>$title,
																		'description'=>$desc,
																		'image'=>'',
																		'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
																 ),
												'twitter'=>array(
																					'image'=>'',
																					'title'=>$title,
																					'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
																			 )
												);
			
				 
				 $this->data['succmsg'] = $this->nsession->userdata('succmsg');
				 $this->data['errmsg'] = $this->nsession->userdata('errmsg');
			
				 $this->nsession->set_userdata('succmsg', "");		
				 $this->nsession->set_userdata('errmsg', "");
			
				 $this->templatelayout->make_seo($title,$desc,$key,$share);
				
				 $this->elements['middle']	=	'cms/cms_details';			
				 $this->elements_data['middle'] 	= 	$this->data;
				 
				 $this->layout->setLayout('cms_details_layout');
				 $this->layout->multiple_view($this->elements,$this->elements_data);
			}
			else{
				 redirect(FRONTEND_URL.$cms_slug.'/');
			}
		
		
		
	 }
	
	 public function newsletter_submit(){
			$nw_name 		= $this->input->post('nw_name');
			$nw_email 	= $this->input->post('nw_email');
			$whereArr 	= array('email'	=> $nw_email);
			$exist 			= $this->model_basic->checkRowExists($this->newsletterTable,$whereArr);
			
			if($exist == 1){
				 $insertArr = array('first_name'	=> $nw_name,'email'	=> $nw_email);
				 $id=$this->model_basic->insertIntoTable($this->newsletterTable,$insertArr);
				 if($id){
						echo 'success||Newsletter subscribed successfully!';
				 }
				 else{
						echo 'error||Unable to subscribe newsletter';
				 }
			}
			else{
				 echo 'error||You are already subscribe newsletter';
			}
	 }
	
	public function contactAction(){
		extract($_POST);
		$cmsslug = $this->uri->segment(3);
		
		if($action=='process'){
			$name = addslashes($this->input->post('name'));
			$email = addslashes($this->input->post('email'));
			$phone_no = addslashes($this->input->post('phone_no'));
			$msg = addslashes($this->input->post('message'));
			
			
			$userCity = $this->nsession->userdata('userCity');
			$userCountry = $this->nsession->userdata('userCountry');
			if(isset($userCity) && $userCity!='')
			{
				$user_city = $this->nsession->userdata('userCity');
			}
			else
			{
				$user_city = '';
			}
			
			if(isset($userCountry) && $userCountry!='')
			{
				$user_country = $this->nsession->userdata('userCountry');
			}
			else
			{
				$user_country = '';
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			$insertArr = array('contact_name' => $name,
				           'contact_email' => $email,
					   'contact_phone' =>  $phone_no,
					   'contact_message' => $msg,
					   'contact_ip'      => $ip,
					   'contact_city'    => $user_city,
					   'contact_country' => $user_country
					   );
		        $insert_val = $this->model_basic->insertIntoTable(CONTACT,$insertArr);
			if($insert_val)
			{
				
				
				
				        $send_mail = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
					$mail_config['to'] = trim($send_mail);
					//$mail_config['to'] = 'tonmoy.nandy@webskitters.com';
					$mail_config['from'] = $email;
					$mail_config['from_name'] = $name;
					$mail_config['subject'] = 'New contact form submitted by '.$mail_config['from_name'];
					
					$contact_msg = trim($message);
					$phone = trim($phone_no);
					
					$message  = '';
					//$msg .="it is for test";
					$message .= '<p>A new contact form is posted.Find the details below</p>';
					$message .= '<p><strong>Name : </strong> '.$mail_config['from_name'].'</p>';
					$message .= '<p><strong>Email : </strong> '.$mail_config['from'].'</p>';
					$message .= '<p>Phone No : '.$phone.'</p>';
					$message .= '<p>Message : '.$contact_msg.'</p>';
					
					$mail_config['message'] = $message;
					
					$mailsnd_admin = send_html_email($mail_config);
					
					$template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=4');
					
					$mail_config['to'] = stripslashes(trim($email));
					//$mail_config['to'] = 'tonmoy.nandy@webskitters.com';
					$mail_config['from'] = $template[0]['responce_email'];
					$mail_config['from_name'] = 'HostelMofo Team';
					$mail_config['subject'] = $template[0]['email_subject'];
					$mail_config['message'] =  $template[0]['email_content'];
					$mail_config['message'] = str_replace('{{USERNAME}}',stripslashes(trim($name)),$mail_config['message']);
					
					//echo $mail_config['message'];
					
					$mailsnd_user = send_html_email($mail_config);
					//	exit();
					
					if($mailsnd_user)
					{
						$this->nsession->set_userdata('succmsg', "Contact form submitted successfully.");
						redirect(FRONTEND_URL.$cmsslug.'/');
					}
					
					
			}
			else
			{
				$this->nsession->set_userdata('errmsg', "Contact form can't submitted successfully.");
				redirect(FRONTEND_URL.$cmsslug.'/');
			}
		}
	}
	

}