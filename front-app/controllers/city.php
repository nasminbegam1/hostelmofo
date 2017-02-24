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
				//echo $city_slug.'<><><><><><>'.$provience_slug; exit;
				$this->data= '';
		
				if($this->uri->total_segments()==2){
						$this->data['city_details'] = $this->model_city->getCityDetailsBySlug($city_slug);
						//pr($this->data['city_details'] );
						if(!is_array($this->data['city_details']) or count($this->data['city_details'])==0){
								redirect('page-not-found');
						} 
					 
					 $guest = 2;
						  $baner_check_in 	= DEFAULT_CHECK_IN_DATE;
						  $baner_check_out	= DEFAULT_CHECK_OUT_DATE;
						  $city 	= $this->data['city_details']['city_slug'] ;
						  $ptype = '';
						  $type_id ='';
						  $extra_para = '';
						  $group_type='';
						  $age_ranges='';
						  $property = '';
					 if($guest > 8){
								$extra_para = '';
								if($group_type != ''){
										$extra_para .= '&group_type='.$group_type;
								}
								if($age_ranges != ''){
										$extra_para .= '&age_ranges='.$age_ranges;
								}
						}
					 
					 
					 
				
						/********* search panel starts here ***********/
						$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
						$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');	    
						$this->data['facility_list']=	$this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');
						//pr($this->data['facility_list']);
						$this->data['property_type_list']=	$this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');
						//pr($this->data['property_type_list']);
						$this->data['roomtype_list']=	$this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');
						//pr($this->data['roomtype_list']);
						$this->data['citylist']	=	$this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug'), '', "status='Active' ", 'city_name', 'ASC');
						//pr($this->data['citylist']);
						$this->data['propertylist'] = $this->model_search->getlist('landing', $this->data['city_details']['city_slug'],'','');
						//pr($this->data['propertylist']);
		
						if( $this->data['propertylist'] && is_array($this->data['propertylist']) )
								$this->data['totalCount']	= count( $this->data['propertylist'] );
						else
								$this->data['totalCount']	= 0;
		
						  //$this->data['map_url']				= '?guest='.$guest.'&type='.$ptype.'&city='.$city.'&checkin='.$check_in.'&checkout='.$check_out.$extra_para.'&typeid='.$type_id."&s=true";
						  $this->data['map_url']				= '?guest='.$guest.'&type='.$ptype.'&city='.$city.'&checkin='.$baner_check_in.'&checkout='.$baner_check_out.$extra_para.'&typeid='.$type_id."&s=true";
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
																						'image' =>$banner_image,
																						'title'           =>$title,
																						'link'            =>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
										)
									 );        
						  
						  $breadcrumb_arr = array(); 
						  $breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
						  if($city!=''){
								$city_arr 				= explode('-',$city);
								$province_slug 		= $city_arr[end(array_keys($city_arr))];
								$province_arr 		= $this->model_basic->getValues_conditions(PROVINCE_MASTER, 'province_name,province_slug', '', ' province_short_code="'.$province_slug.'" ');
								$province_arr 		= $province_arr[0];
				
								$city_data 				= $this->model_basic->getValues_conditions(CITY_MASTER, 'city_name,city_slug', '', ' city_slug="'.$city.'" ');
								$city_data 				= $city_data[0]; 
								$breadcrumb_arr[]	= array('text'=>$province_arr['province_name'],'link'=>FRONTEND_URL.'listing/?province='.$province_arr['province_slug']);
								$breadcrumb_arr[] = array('text'=>$city_data['city_name'],'link'=>'');
						}
						  
						  
						  
						  
						  $this->templatelayout->make_seo($title,$desc,$key,$share);
						  //$this->templatelayout->get_header('home');
						  $this->templatelayout->get_banner($city, $this->data['temploc'], $ptype, $type_id,$property, $baner_check_in, $baner_check_out,$guest,$group_type,$age_ranges,$breadcrumb_arr);
						  $name = stripslashes($this->data['city_details']['city_name']);
						  //$this->templatelayout->get_landingbanner($banner_image,$name);
						  //$this->templatelayout->get_footer();
						  $this->templatelayout->get_inner_footer();
						  $this->elements['middle']	= 'city/index';
						  $this->elements_data['middle'] 	= $this->data;
						  $this->layout->setLayout('listing_layout');
						  //$this->layout->setLayout('landingpage_layout');
						  $this->layout->multiple_view($this->elements,$this->elements_data);
				}
				else{
					 //redirect('page-not-found');
					 redirect(FRONTEND_URL.$provience_slug.'/'.$city_slug.'/');
				}
	 }
    
}
