<?php

class Province extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('model_basic');
        $this->load->model('model_search');
    }
 
    public function index()
    {
        create_proper_url();
        
        if($this->uri->total_segments()==1){
            $province_slug = $this->uri->segment(1);
        }
        $this->data['province_details']	= array();
        $province_details	                = $this->model_basic->getValues_conditions(PROVINCE_MASTER, '*', '', ' province_slug = "'.$province_slug.'" '); 
        if($province_details)
        {
            $this->data['province_details']	= $province_details[0];
            $this->data['city_under_province']	= $this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','city_seo_slug','city_slug'), '', 'status="Active" AND  province_id = "'.$province_details[0]['province_id'].'"', 'city_name', 'ASC');
            //pr($this->data['city_under_province']);
            $banner_image                       = CDN_PROVINCE_BIG_IMG.$this->data['province_details']['banner_image_name'];
            $province_name                      = $this->data['province_details']['province_name'];
            $this->data['province_slug']        = $province_slug;
        }
        
        
        /********* search panel starts here ***********/
        $this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
        $this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');	    
        $this->data['facility_list']=	$this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');	    
        $this->data['property_list']=	$this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');	    
        $this->data['roomtype_list']=	$this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');	    
        $this->data['citylist']	=	$this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug'), '', "status='Active' ", 'city_name', 'ASC');

        $this->data['propertylist'] = $this->model_search->getlist('landing', '',$this->data['province_details']['province_slug'],'');
        if( $this->data['propertylist'] && is_array($this->data['propertylist']) )
            $this->data['totalCount']	= count( $this->data['propertylist'] );
        else
            $this->data['totalCount']	= 0;

        $this->data['temploc'] = $this->data['province_details']['province_name'];
        
        $this->data['city_slug'] 	= '' ;
        $this->data['province_id']= $this->data['province_details']['province_id'];
        $this->data['ptype_slug'] 	= '' ;
        
        /********* END OF search panel ***********/       
        
        
        
        
        
        
        $title  = stripslashes(trim($this->data['province_details']['meta_title']));
        $key    = stripslashes(trim($this->data['province_details']['meta_keyword']));
        $desc   = stripslashes(trim($this->data['province_details']['meta_description']));
        $share  = array(
            'og'=>array(
                        'site_name'     =>$title,
                        'description'   =>$desc,
                        'image'         =>$banner_image,
                        'link'          =>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                        ),
            'twitter'=>array(
                      'image'           =>$banner_image,
                      'title'           =>$title,
                      'link'            =>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
            )
        );        
        
        $this->templatelayout->make_seo($title,$desc,$key,$share);
        $this->templatelayout->get_header();
        $this->templatelayout->get_landingbanner($banner_image,$province_name);
        $this->templatelayout->get_footer();
        
        $this->elements['middle']	= 'province/index';			
        $this->elements_data['middle'] 	= $this->data;
                    
        $this->layout->setLayout('landingpage_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
}
