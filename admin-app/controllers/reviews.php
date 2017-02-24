<?php

class Reviews extends MY_Controller{
    
    
    function __construct(){
        parent :: __construct();
        $this->load->model('model_reviews');
	
        
    }
    
    public function index(){
        chk_login();
	
        $this->data='';
        $config['base_url'] 	= BACKEND_URL.currentClass()."/index/";
	$this->data['add_link']      	= BACKEND_URL."reviews/add_review/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['user_name']	= '';
        $this->data['property_name']	= '';
	$this->data['per_page']	        = '';
        if($this->input->get_post('btn_show_all')!=''){
            $this->nsession->unset_userdata('REVIEW_SEARCH');
            redirect(currentClass()."/index/");
        }
	$this->data['params']		= $this->nsession->userdata('REVIEW_SEARCH');
   
	if($this->input->get_post('user_name') == '' and $this->input->get_post('property_name') == '' && $this->input->get_post('per_page') == '')
	{
            
                    $this->data['user_name']        = $this->data['params']['user_name'];
                    $this->data['property_name']    = $this->data['params']['property_name'];
                    $this->data['per_page']	        = $this->data['params']['per_page'];
               
	}
	else 
	{
		$this->data['user_name']        = $this->input->get_post('user_name',true);
                $this->data['property_name']    = $this->input->get_post('property_name',true);
                $this->data['per_page'] 	= $this->input->get_post('per_page',true);	
	}
        $start 				= 0;
	$page				= $this->uri->segment(3,0);
	$this->data['reviewsList']	= $this->model_reviews->getList($config,$start);
	//pr($this->data['propertyList']);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
          $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['brdLink']=array(
				     array('logo'=>'fa fa-comments','name'=>'Reviews','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
				     );
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='reviews/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
       public function change_status(){
            $review_id = $this->input->post('id');
            $rec = $this->model_basic->getValues_conditions(REVIEW_MASTER,'','','review_id="'.$review_id.'"')  ;
            
            if(is_array($rec) and count($rec)>0){
               $status = $rec[0]['review_status'];
               
               $new_status ='';
               if($status=='Active'){
                 $new_status = 'Inactive';
               }
               else if($status=='Inactive'){
                 $new_status = 'Active';
               }
               
                $updateArr  =  array('review_status' => $new_status);
                         
                $idArr      = array('review_id' => $review_id);
         
                $ret   = $this->model_basic->updateIntoTable(REVIEW_MASTER,$idArr, $updateArr);
            }
        }
	
	
    public function add_review()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "reviews";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['property_list']    = $this->model_basic->populateDropdown('property_master_id','property_name',PROPERTY_MASTER,"status='Active'",'property_name','ASC');
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('property_id', 'Property Name', 'trim|required');
		$this->form_validation->set_rules('value_for_money', '', 'trim');
		$this->form_validation->set_rules('staff', '', 'trim');
		$this->form_validation->set_rules('facilities', '', 'trim');
		$this->form_validation->set_rules('security', '', 'trim');
		$this->form_validation->set_rules('location', '', 'trim');
		$this->form_validation->set_rules('name', '', 'trim');
		$this->form_validation->set_rules('country', '', 'trim');
		$this->form_validation->set_rules('city', '', 'trim');
		$this->form_validation->set_rules('gender', '', 'trim');
		$this->form_validation->set_rules('age_group', '', 'trim');
		$this->form_validation->set_rules('review_text', '', 'trim');
		$this->form_validation->set_rules('review_status', '', 'trim');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
                                
				$property_id     = addslashes($this->input->post('property_id'));
				$value_for_money     = addslashes($this->input->post('value_for_money'));
				$staff     = addslashes($this->input->post('staff'));
				$facilities     = addslashes($this->input->post('facilities'));
				$security     = addslashes($this->input->post('security'));
				$location     = addslashes($this->input->post('location'));
				$atmosphere     = addslashes($this->input->post('atmosphere'));
				$cleanliness     = addslashes($this->input->post('cleanliness'));
				$name     = addslashes($this->input->post('name'));
				$country     = addslashes($this->input->post('country'));
				$city     = addslashes($this->input->post('city'));
				$gender     = addslashes($this->input->post('gender'));
				$age_group     = addslashes($this->input->post('age_group'));
                              	$review_text     = addslashes($this->input->post('review_text'));
				$review_status     = addslashes($this->input->post('review_status'));
				$review_datetime = date('Y-m-d H:i:s');
				
				$avarage_rating = ($value_for_money+$staff+$facilities+$security+$location+$atmosphere+$cleanliness)/7;
				
				$insertArr  =  array(
							'property_id'	        => $property_id,
							'value_for_money'	=> $value_for_money,
							'staff'	        	=> $staff,
							'facilities'	        => $facilities,
							'security'	        => $security,
							'location'	        => $location,
							'atmosphere'	        => $atmosphere,
							'cleanliness'	        => $cleanliness,
							'avarage_rating'	=> $avarage_rating,
							'name'	        	=> $name,
							'country'	        => $country,
							'city'	        	=> $city,
							'gender'	        => $gender,
							'age_group'	        => $age_group,
							'review_text'	        => $review_text,
							'review_status'         => $review_status,
							'review_datetime'	=> $review_datetime
						);
			    
				$res = $this->model_basic->insertIntoTable(REVIEW_MASTER,$insertArr);
				if($res)
				{
					
								
					$avg = $this->model_reviews->getTotalAvarageRating($property_id);
					
					$iddArr['property_master_id'] = $property_id;
					$updateArr['avarage_rating']  = $avg['avarage_rating'];
					$this->model_basic->updateIntoTable (PROPERTY_MASTER,$iddArr,$updateArr);
					
					
					$this->nsession->set_userdata('succmsg', "Review Added Successfuly.");
					redirect(base_url()."reviews/");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable to Add Review ");
					redirect(base_url()."reviews/");
				}
			}
		}
		
		
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
        
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_review/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	 //For breadcrump..........
	 $this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Review','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-home','name'=>'Review List','link'=>$this->data['base_url']),
				     array('logo'=>'fa fa-plus-circle','name'=>'Add','link'=>'javascript:void();'),
				     );	

				     
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='reviews/add_review';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }

    
}


?>