<?php
class Management extends MY_Controller{
    
	public function __construct(){
	    parent::__construct();
	    $this->load->model('model_basic');
	}
	
	public function index()
	{
		create_proper_url();
		
		
	    if($this->uri->total_segments() == 1){
	    $this->data = '';
	    //$cms_id 	= 45;
	    $cms_slug		=	$this->uri->segment(1);
	    //$cms_slug		=	'our-team';
	    $this->data['cms_details']	=	array();
	    $cms_details	=	$this->model_basic->getValues_conditions(CMS, array('cms_id','cms_title','cms_slug','cms_content', 'cms_meta_title', 'cms_meta_key', 'cms_meta_desc','cms_image'), '', ' cms_slug = "'.$cms_slug.'" '); //pr($cms_details);
	    if($cms_details)
	    {
		    $this->data['cms_details']	=	$cms_details[0];
	    }
	    
	    $this->data['team_details']	=	array();
	    $team_details	=	$this->model_basic->getValues_conditions(TEAM, '', '', ' status = "active" ','name','asc'); 
	    if($team_details)
	    {
		    $this->data['team_details']	=	$team_details;
	    }
	    
	    $title = ucwords(stripslashes(trim($this->data['cms_details']['cms_title'])));
	    $key  = stripslashes($this->data['cms_details']['cms_meta_key']);
	    $desc = stripslashes($this->data['cms_details']['cms_meta_desc']);
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
	    
	    $this->templatelayout->make_seo($title,$desc,$key,$share);
	    $this->templatelayout->get_header($cms_slug);
	    $this->templatelayout->get_banner('','','hostel');
	    $this->templatelayout->get_footer();
	    $this->elements['middle']	=	'cms/team';			
	    $this->elements_data['middle'] 	= 	$this->data;
	    $this->layout->setLayout('team_layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	    
	    }else{
		redirect(FRONTEND_URL.'management/');
		
	    }
	}
    
}
