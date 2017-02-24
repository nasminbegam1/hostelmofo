<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Feedback extends CI_Controller
{
	function __construct()
	{
		parent::__construct();


		$this->load->model('model_feedback');
		$this->load->model('model_basic');

	}

public function index()
{

		$stringUrl = $email = $this->uri->segment(2,0);
		$urlarray = explode("-",$stringUrl);
		 //pr($urlarray);
		
		 $payment_id    =  md5($urlarray[2]);
		
		$feedbackarray = $this->model_feedback->feedback($urlarray);
		//pr($feedbackarray);
		
		$userid        = $feedbackarray[0]['user_id'];
		$property_id   = $feedbackarray[0]['property_id'];
		$email         = $feedbackarray[0]['email'];
		$payment_id    = $feedbackarray[0]['paymeny_id'];
		   
		$chk_record_exists = $this->model_basic->isRecordExist(FEEDBACK,'payment_id='.$payment_id);
		if($chk_record_exists > 0)
		{
			$view_page = "already_comment";
		}
		else
		{
			$view_page = "view_feedback";
			if($this->input->post('action')=='save') 
			{
		
		
			      $value 	  = $this->input->get_post('Value_for_money');
			      $Security   = $this->input->get_post('Security');
			      $Location   = $this->input->get_post('Location');
			      $Atmosphere = $this->input->get_post('Atmosphere');
			      $Cleanliness= $this->input->get_post('Cleanliness');
			      $Facilities = $this->input->get_post('Facilities');
			      $Staff 	  = $this->input->get_post('Staff');
			      $comment    = $this->input->get_post('comments');
			      
			      
		
			      $data = array(
		
			      'property_id'=>$property_id,
			      'user_id'=>$userid,
			      'email'=>$email,
			      'value_for_money'=> $value,
			      'security'=>$Security,
			      'location'=>$Location,
			      'atmosphere'=>$Atmosphere,
			      'cleanliness'=>$Cleanliness,
			      'facilities'=>$Facilities,
			      'staff'=>$Staff,
			      'comments'=>$comment,
			      'payment_id'=>$payment_id);
		
			      //pr($data);				
					      
			      $insertData	= $this->model_feedback->insert_feedback(FEEDBACK,$data); 
		
		      
				if($insertData>0)
				{				
					redirect(FRONTEND_URL.'feedback/success');
				}
				
		
		
			}
		}
	
	    $data['succMsg'] = $this->nsession->userdata('succMsg');
	    $data['errMsg']	= $this->nsession->userdata('errMsg');
	    //pr($data);
	    $this->nsession->set_userdata('succMsg','');
	    $this->nsession->set_userdata('errMsg','');
	    $this->templatelayout->make_seo();
	    $this->templatelayout->get_header();
	    $this->templatelayout->get_banner();
	    $this->templatelayout->get_breadcrumb();
	    $this->templatelayout->get_footer();
	    
	    $this->elements['middle']='feedback/'.$view_page;			
	    $this->elements_data['middle'] = $data;
			
	    $this->layout->setLayout('details_layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);

	    
}

public function success()
{
	$data['succMsg'] = $this->nsession->userdata('succMsg');
	$data['errMsg']	= $this->nsession->userdata('errMsg');
	//pr($data);
	$this->nsession->set_userdata('succMsg','');
	$this->nsession->set_userdata('errMsg','');
	$this->templatelayout->make_seo();
	$this->templatelayout->get_header();
	$this->templatelayout->get_banner();
	$this->templatelayout->get_breadcrumb();
	$this->templatelayout->get_footer();
	
	$this->elements['middle']='feedback/view_success';			
	$this->elements_data['middle'] = $data;
		    
	$this->layout->setLayout('details_layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);


	//$this->load->view('feedback/success');
}






}
?>
