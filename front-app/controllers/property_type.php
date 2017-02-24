<?php

class Property_type extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('model_basic');
        $this->load->model('model_property');
        $this->load->model('model_review');
         $this->load->model('model_search');
    }
    
    
    public function index()
    {
        create_proper_url();
        
        $propertytype_slug		=	$this->uri->segment(1);
        if($this->uri->total_segments() < 2){
          
        $this->data = '';
        
        $this->data['property_type_details']	=	array();
        $property_type_details	=	$this->model_basic->getValues_conditions(PROPERTY_TYPE, '*', '', ' property_type_slug = "'.$propertytype_slug.'" '); 
        if($property_type_details)
        {
                $this->data['property_type_details']	=	$property_type_details[0];
                $fav_location                           =       $this->data['property_type_details']['fav_cities'];
                if($fav_location !='')
                {
                     $fav_location_arry                 =       $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_name,city_seo_slug,province_name,province_slug', "CT.status='Active' AND CT.city_master_id IN ( ".$fav_location." )");
                }
                 else
                    $fav_location_arry                  =       array();
                
                //$fav_location_arry                      =        explode(',',$fav_location);
                $this->data['fav_location_arry']        =        $fav_location_arry;
                $banner_image                           =        CDN_PROPERTY_BANNER_IMG.$this->data['property_type_details']['property_banner_image'];
                $property_type_name                     =        $this->data['property_type_details']['property_type_name'];
        }
        
        $this->data['fav_location_arry']                 =   $fav_location_arry;
        /********* search panel starts here ***********/
        $this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
        $this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');	    
        $this->data['facility_list']=	$this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');	    
        $this->data['property_list']=	$this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');	    
        $this->data['roomtype_list']=	$this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');	    
        $this->data['citylist']	=	$this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug'), '', "status='Active' ", 'city_name', 'ASC');

     
        $this->data['totalCount']	= 0;

        $this->data['temploc'] = '';
        
        $this->data['city_slug'] 	= '' ;
        $this->data['province_id']= '';
        $this->data['ptype_slug'] 	= $this->data['property_type_details']['property_type_slug'] ;
        
        /********* END OF search panel ***********/    
        
        
        //pr($this->data['property_type_details'],0);
        $title = stripslashes(trim($this->data['property_type_details']['meta_title']));
        $key = stripslashes($this->data['property_type_details']['meta_keyword']);
        $desc = stripslashes($this->data['property_type_details']['meta_description']);
        $share = array(
                    'og'=>array(
                                'site_name'=>$title,
                                'description'=>$desc,
                                'image'=>CDN_PROPERTY_BANNER_IMG.$this->data['property_type_details']['property_banner_image'],
                                'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                                ),
                    'twitter'=>array(
                              'image'=>CDN_PROPERTY_BANNER_IMG.$this->data['property_type_details']['property_banner_image'],
                              'title'=>$title,
                              'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                    )
               );
        
        
        $this->templatelayout->make_seo($title,$desc,$key,$share);
        $this->templatelayout->get_header($propertytype_slug);
        $this->templatelayout->get_landingbanner($banner_image,$property_type_name);
        $this->templatelayout->get_footer();
        
        $this->elements['middle']	= 'property_type/index';			
        $this->elements_data['middle'] 	= $this->data;
                   
        $this->layout->setLayout('landingpage_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        }
        else
        {
            
            //redirect('page-not-found/');
            redirect(FRONTEND_URL.$propertytype_slug.'/');
        
        }
    }
    
}
