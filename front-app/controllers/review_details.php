<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Review_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_review');
		$this->load->model('model_basic');
	}


	public function index()
	{
		$this->chk_login();
		$user_id = $this->nsession->userdata('USER_ID');
		$data['pending_review'] 	= $this->model_review->pending_review($user_id);
		$data['past_review'] 		= $this->model_review->past_review($user_id);
		$data['review']				= array_merge($data['past_review'],$data['pending_review']);
		$data['review']	 = $this->array_orderby($data['review'],'paymeny_id',SORT_ASC);
		//pr($data['pending_review'],0);
		//pr($data['review']	);
		
		//$data['property_details']	= $this->model_review->all_review();
		$data['succMsg'] 		= $this->nsession->userdata('succMsg');
		$data['errMsg']			= $this->nsession->userdata('errMsg');
		$title 				= "Review";
		//pr($data);
		$this->nsession->set_userdata('succMsg','');
		$this->nsession->set_userdata('errMsg','');
		$this->templatelayout->make_seo();
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']='review_details/view_review_details';			
		$this->elements_data['middle'] = $data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function pending()
	{
		$this->chk_login();

		$user_id = $this->nsession->userdata('USER_ID');
		$data['review']	= $this->model_review->pending_review($user_id);
		$data['succMsg'] 		= $this->nsession->userdata('succMsg');
		$data['errMsg']			= $this->nsession->userdata('errMsg');
		$title 				= "Review";
		//pr($data);
		$this->nsession->set_userdata('succMsg','');
		$this->nsession->set_userdata('errMsg','');
		$this->templatelayout->make_seo();
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']='review_details/view_review_details';			
		$this->elements_data['middle'] = $data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function past()
	{
		$this->chk_login();
		$user_id = $this->nsession->userdata('USER_ID');
		$data['review']	= $this->model_review->past_review($user_id);
		$data['succMsg'] 		= $this->nsession->userdata('succMsg');
		$data['errMsg']			= $this->nsession->userdata('errMsg');
		$title 			   	= "Review";
		//pr($data);
		$this->nsession->set_userdata('succMsg','');
		$this->nsession->set_userdata('errMsg','');
		$this->templatelayout->make_seo();
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']='review_details/view_review_details';			
		$this->elements_data['middle'] = $data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function submit_review(){
		$this->chk_login();
		  $payment_id	= $this->uri->segment(3);
		  $property_id	= $this->uri->segment(4);
		  $userid 		= $this->nsession->userdata('USER_ID');
	
		 $data['ratting_array'] = array('5' => 'Excellent', '4' => 'Very Good', '3' => 'Good', '2' => 'Modarate', '1' => 'Not Good');
		 
		 if($this->input->get_post('action') == 'Process')
		 {
			//echo "aaa"; die();
		  $chk_record_exists = $this->model_basic->isRecordExist(FEEDBACK,"payment_id='".$payment_id."' AND user_id = '".$userid."'");
		  if($chk_record_exists > 0){
			
				$this->nsession->set_userdata('errmsg', "Review already posted!");
				
		  }
		  else{
				$value 	  		= $this->input->get_post('value_for_money');
				$Security   	= $this->input->get_post('security');
				$Location   	= $this->input->get_post('location');
				$Atmosphere 	= $this->input->get_post('atmosphere');
				$Cleanliness	= $this->input->get_post('cleanliness');
				$Facilities 	= $this->input->get_post('facilities');
				$Staff 	  		= $this->input->get_post('staff');
				$comment    	= $this->input->get_post('comments');		
				
				$email 	  		= $this->input->get_post('email');
	    
				$data = array(
									 'property_id'	=>$property_id,
									 'user_id'		=>$userid,
									 'email'		=>$email,
									 'value_for_money'	=>$value,
									 'security'		=>$Security,
									 'location'		=>$Location,
									 'atmosphere'	=>$Atmosphere,
									 'cleanliness'	=>$Cleanliness,
									 'facilities'	=>$Facilities,
									 'staff'		=>$Staff,
									 'comments'		=>$comment,
									 'payment_id'	=>$payment_id
								);
				$insertData	= $this->model_basic->insertIntoTable(FEEDBACK,$data);
				
				$this->nsession->set_userdata('succmsg', "Review added successfully!");
				redirect(FRONTEND_URL.'review_details');
				
		  }
			
		 }
		  
		  
			$data['sucmsg'] 		= $this->nsession->userdata('sucmsg');
			$data['errmsg']			= $this->nsession->userdata('errmsg');
			$title 			   		= "Review";
			//pr($data);
			$this->nsession->set_userdata('succMsg','');
			$this->nsession->set_userdata('errMsg','');
			$this->templatelayout->make_seo();
			$this->templatelayout->get_breadcrumb();
			$this->templatelayout->get_banner_inner('',$title);
			$this->templatelayout->get_inner_footer();
			
			$this->elements['middle']='review_details/submit_review';			
			$this->elements_data['middle'] = $data;
					
			$this->layout->setLayout('details_layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
    }
	
	
	public function array_orderby()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
				}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
	
}
?>