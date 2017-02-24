<?php

class Review extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('model_basic');
        $this->load->model('model_property');
        $this->load->model('model_review');
        
    }
    
    public function index(){
        
        create_proper_url();
        
        $property_slug = $this->uri->segment(2,0);
        $this->data = "";
        $property_details= $this->model_property->getPropertyDetails($property_slug);
        if(count($property_details)==0){
           redirect('page-not-found/');
        }
        //pr($property_details,0);
       
       $property_name = stripslashes($property_details['master_details']['property_name']);
       $property_id = $property_details['master_details']['property_master_id'];
       $this->data['details']=$property_details;
        
        
        $condition = " property_id = '".$property_id."' AND review_status = 'Active'";
        //$this->data['review_list'] = $this->model_basic->getValues_conditions(REVIEW_MASTER,'*','',$condition,'review_id','DESC');
        $this->data['review_list'] = $this->model_review->allRatingList($property_id);
        //pr($this->data['review_list']);
        
        $this->templatelayout->make_seo();
        $this->templatelayout->get_header();
        //$this->templatelayout->get_banner('','','hostel');
        $this->templatelayout->get_banner_inner('','Review');
        $this->templatelayout->get_breadcrumb();
        $this->templatelayout->get_footer();
        
        $this->elements['middle']	=	'review/all_review';			
        $this->elements_data['middle'] 	= 	$this->data;
                    
        $this->layout->setLayout('details_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
  
    
    
    

    
}
