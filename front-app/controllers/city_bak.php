<?php

class City extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model( array('model_basic','model_city','model_search') );
    }
     
		public function index(){
				create_proper_url();
		
				$city_slug = $this->uri->segment(2);
				$provience_slug = $this->uri->segment(1); 
				$this->data= '';
		
				if($this->uri->total_segments()==2){
						$this->data['city_details'] = $this->model_city->getCityDetailsBySlug($city_slug);
						if(!is_array($this->data['city_details']) or count($this->data['city_details'])==0){
								redirect('page-not-found');
						} 
		
						/********* search panel starts here ***********/
						$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
						$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');	    
						$this->data['facility_list']=	$this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');	    
						$this->data['property_list']=	$this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');	    
						$this->data['roomtype_list']=	$this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');	    
						$this->data['citylist']	=	$this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug'), '', "status='Active' ", 'city_name', 'ASC');
						$this->data['propertylist'] = $this->model_search->getlist('landing', $this->data['city_details']['city_slug'],'','');
		
						if( $this->data['propertylist'] && is_array($this->data['propertylist']) )
								$this->data['totalCount']	= count( $this->data['propertylist'] );
						else
								$this->data['totalCount']	= 0;
		
						$this->data['temploc'] = $this->data['city_details']['city_name'].', '.$this->data['city_details']['province_name'];
						$this->data['city_slug'] 	= $this->data['city_details']['city_slug'] ;
						$this->data['province_id']= '';
						$this->data['ptype_slug'] 	= '' ;
						/********* END OF search panel ***********/
						
						$banner_image = CDN_CITY_IMG.'banner/'.$this->data['city_details']['banner_image_name'];
						$title  = stripslashes(trim($this->data['city_details']['meta_title']));
						$key    = stripslashes(trim($this->data['city_details']['meta_keyword']));
						$desc   = stripslashes(trim($this->data['city_details']['meta_description']));
		
						$share  = array(
														'og'=>array(
														'site_name' 		=>$title,
														'description' 	=>$desc,
														'image'         =>$banner_image,
														'link'          =>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
														),
														'twitter'=>array(
																						'image' 	=>$banner_image,
																						'title' =>$title,
																						'link'  =>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
		)
		);        
		
		$this->templatelayout->make_seo($title,$desc,$key,$share);
		$this->templatelayout->get_header('home');
		
		$name = stripslashes($this->data['city_details']['city_name']);
		$this->templatelayout->get_landingbanner($banner_image,$name);
		
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'city/index';
		
		$this->elements_data['middle'] 	= $this->data;
		
		$this->layout->setLayout('landingpage_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		} else {
		//redirect('page-not-found');
		redirect(FRONTEND_URL.$provience_slug.'/'.$city_slug.'/');
		}
		}
    
}
