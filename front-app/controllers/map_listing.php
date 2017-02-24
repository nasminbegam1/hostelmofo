<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map_listing extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_search');
	}
	
	
	public function index()
	{
		$searchType		= $this->uri->segment(2, 0);
		$this->data     	= ''; 
		$ptype			= $this->input->get_post('type');
		$city			= $this->input->get_post('city');
		$province		= $this->input->get_post('province');
		$check_in		= $this->input->get_post('checkin');
		$check_out		= $this->input->get_post('checkout');
		$min_price		= '';
		$max_price		= '';
		$roomtype		= '';
		$facilities		= ''; 
		$page			= 1;
		$currency		= 'AUD'; 
		$way			= 'home'; 
		$type_id		= $this->input->get_post('typeid');
		//$bedroom		= 0;
		//$beds			= 0;
		
		$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
		$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');
		
		$this->data['propertylist'] 	= $this->model_search->getlist();
		if($this->data['propertylist'] && is_array($this->data['propertylist']) )
			$this->data['totalCount']	= count($this->data['propertylist']);
		else
			$this->data['totalCount']	= 0;
		
		
		$province_id = 0;
		if( isset($province) && $province != ''){			
			$provincedata	= $this->model_basic->getFromWhereSelect(PROVINCE_MASTER.' PRV ', 'province_id, province_name', ' province_slug = "'.$province.'" ');
			if( $provincedata && is_array($provincedata) ){
				$province_id 		= $provincedata[0]['province_id'];
				$this->data['province'] = $provincedata[0]['province_name'];
				$temploc 		= $this->data['province'];
			}
		}
		else{ 
			$this->data['province'] = '';
		}
		
		$temploc = '';
		if( isset($city) && $city != ''){
			//$this->data['cityname']		= $this->model_basic->getValue_condition(CITY, 'city_name', '','city_slug="'.$city.'"');
			$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_name, province_name', ' city_slug = "'.$city.'" ');
			if( $citydata && is_array($citydata) ){
				$this->data['cityname'] = $citydata[0]['city_name'];
				$this->data['province'] = $citydata[0]['province_name'];
				$temploc = $this->data['cityname'].', '.$this->data['province'];
			}
		}
		else{
			$this->data['cityname'] = '';
			$this->data['province'] = '';
		}
		
		//pr($_SESSION);
		
		$this->data['checkin_date']	= '';
		$this->data['checkout_date']	= '';
		$baner_check_in 	= DEFAULT_CHECK_IN_DATE;
		$baner_check_out	= DEFAULT_CHECK_OUT_DATE;
		
		if(isset($check_in) && $check_in != '')
		{
			$this->data['checkin_date']	= date('D jS M Y',strtotime($check_in) );
			$baner_check_in = str_replace("-", "/", $check_in);
		}
		if(isset($check_in) && $check_in != '')
		{
			$this->data['checkout_date']	= date('D jS M Y',strtotime($check_out) );
			$baner_check_out = str_replace("-", "/", $check_out);
		}
		
		//pr($this->data['propertylist'],0);
		$left = array();
		$left_ptype = array('ptype'=>array());
		$left_city = array('city'=>array());
		$left_province = array('province'=>array());
		
		if( $city!= '' ){			
			$left_city = array( 'city'=>array($city) );
		}
		if($ptype != ''){
			$left_ptype = array( 'ptype'=>array($ptype) );
		}
		if($province != ''){
			$left_province = array( 'province'=>$province_id );
		}
		$left = array_merge($left_city, $left_ptype, $left_province);

		$breadcrumb_arr = array(); 
		$breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
		if($city!=''){
			$city_arr = explode('-',$city);
			$province_slug = $city_arr[end(array_keys($city_arr))];
			$province_arr = $this->model_basic->getValues_conditions(PROVINCE_MASTER, 'province_name,province_slug', '', ' province_short_code="'.$province_slug.'" ');
			$province_arr = $province_arr[0];
			
			$city_data = $this->model_basic->getValues_conditions(CITY_MASTER, 'city_name,city_slug', '', ' city_slug="'.$city.'" ');
			$city_data = $city_data[0]; 
			$breadcrumb_arr[]=array('text'=>$province_arr['province_name'],'link'=>FRONTEND_URL.'listing/?province='.$province_arr['province_slug']);
			$breadcrumb_arr[]=array('text'=>$city_data['city_name'],'link'=>'');
						
			
		}
		
		$this->templatelayout->make_seo();
		$this->templatelayout->get_header($ptype);
		$this->templatelayout->get_banner($city, $temploc, $ptype, $type_id, $baner_check_in, $baner_check_out);
		$this->templatelayout->get_listing_leftpanel( array($left) );
		$this->templatelayout->get_breadcrumb($breadcrumb_arr);
		$this->templatelayout->get_footer();
		
		$this->elements['middle']	=	'listing/index';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('listing_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
	
	
	public function map_view()
	{
		$searchType		= $this->uri->segment(2, 0);
		$this->data     	= ''; 
		$ptype			= $this->input->get_post('type');
		$city			= $this->input->get_post('city');
		$province		= $this->input->get_post('province');
		$check_in		= $this->input->get_post('checkin');
		$check_out		= $this->input->get_post('checkout');
		$min_price		= '';
		$max_price		= '';
		$roomtype		= '';
		$facilities		= ''; 
		$page			= 1;
		$currency		= 'AUD'; 
		$way			= 'home'; 
		$type_id		= $this->input->get_post('typeid');
		//$bedroom		= 0;
		//$beds			= 0;
		
		$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
		$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');
		
		$this->data['propertylist'] 	= $this->model_search->getlist();
		if($this->data['propertylist'] && is_array($this->data['propertylist']) )
			$this->data['totalCount']	= count($this->data['propertylist']);
		else
			$this->data['totalCount']	= 0;
		
		
		$province_id = 0;
		if( isset($province) && $province != ''){			
			$provincedata	= $this->model_basic->getFromWhereSelect(PROVINCE_MASTER.' PRV ', 'province_id, province_name', ' province_slug = "'.$province.'" ');
			if( $provincedata && is_array($provincedata) ){
				$province_id 		= $provincedata[0]['province_id'];
				$this->data['province'] = $provincedata[0]['province_name'];
				$temploc 		= $this->data['province'];
			}
		}
		else{ 
			$this->data['province'] = '';
		}
		
		$temploc = '';
		if( isset($city) && $city != ''){
			//$this->data['cityname']		= $this->model_basic->getValue_condition(CITY, 'city_name', '','city_slug="'.$city.'"');
			$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_name, province_name', ' city_slug = "'.$city.'" ');
			if( $citydata && is_array($citydata) ){
				$this->data['cityname'] = $citydata[0]['city_name'];
				$this->data['province'] = $citydata[0]['province_name'];
				$temploc = $this->data['cityname'].', '.$this->data['province'];
			}
		}
		else{
			$this->data['cityname'] = '';
			$this->data['province'] = '';
		}
		
		//pr($_SESSION);
		
		$this->data['checkin_date']	= '';
		$this->data['checkout_date']	= '';
		$baner_check_in 	= DEFAULT_CHECK_IN_DATE;
		$baner_check_out	= DEFAULT_CHECK_OUT_DATE;
		
		if(isset($check_in) && $check_in != '')
		{
			$this->data['checkin_date']	= date('D jS M Y',strtotime($check_in) );
			$baner_check_in = str_replace("-", "/", $check_in);
		}
		if(isset($check_in) && $check_in != '')
		{
			$this->data['checkout_date']	= date('D jS M Y',strtotime($check_out) );
			$baner_check_out = str_replace("-", "/", $check_out);
		}
		
		//pr($this->data['propertylist'],0);
		$left = array();
		$left_ptype = array('ptype'=>array());
		$left_city = array('city'=>array());
		$left_province = array('province'=>array());
		
		if( $city!= '' ){			
			$left_city = array( 'city'=>array($city) );
		}
		if($ptype != ''){
			$left_ptype = array( 'ptype'=>array($ptype) );
		}
		if($province != ''){
			$left_province = array( 'province'=>$province_id );
		}
		$left = array_merge($left_city, $left_ptype, $left_province);

		$breadcrumb_arr = array(); 
		$breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
		if($city!=''){
			$city_arr = explode('-',$city);
			$province_slug = $city_arr[end(array_keys($city_arr))];
			$province_arr = $this->model_basic->getValues_conditions(PROVINCE_MASTER, 'province_name,province_slug', '', ' province_short_code="'.$province_slug.'" ');
			$province_arr = $province_arr[0];
			
			$city_data = $this->model_basic->getValues_conditions(CITY_MASTER, 'city_name,city_slug', '', ' city_slug="'.$city.'" ');
			$city_data = $city_data[0]; 
			$breadcrumb_arr[]=array('text'=>$province_arr['province_name'],'link'=>FRONTEND_URL.'listing/?province='.$province_arr['province_slug']);
			$breadcrumb_arr[]=array('text'=>$city_data['city_name'],'link'=>'');
						
			
		}
		
		$this->templatelayout->make_seo();
		$this->templatelayout->get_header($ptype);
		$this->templatelayout->get_footer();
		
		
		$this->elements['middle']	=	'listing/map_list';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('listing_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
	public function get_map()
	{
		echo $return = '[{"property_id":"188","property_name":"Villa Beyond","property_type_id":"2","property_currency":"USD","location_id":"3","latitude":"7.973983","longitude":"98.294526","bedrooms":"7","is_studio":"No","sleeps":"14","bathrooms":"8","page_title":"Luxury Villa for Rent in Bang Tao","optional_title":"Villa Magnifico","property_slug":"luxury-villa-for-rent-in-bang-tao","no_views":"900","property_ranking":"8","distance_to_beach":"2.5","image":"640x480_615053-449450-001-1366134570_33070.jpg","totalImages":"19","review_count":"0","total_review_rating":"0","booking_status":"Enable","rental_mark_up_percent":"0.00","amenities_id":"31::active,32::active,35::active,56::active,54::active,52::active,59::active,63::active,79::active,81::active,83::active,82::active,161::active,153::active,91::active,150::active,107::active,112::active,113::active,114::active,115::active,136::active,86::active,84::active","no_of_days":"","discount_rate":"0.00","deal_expiry_option":"unlimited","deal_status":"disable","AVLCNT":"0","total_price_changed":101974,"per_night_price_changed":50987,"deal_text":"","is_deal":0}]';
		exit();
		
	}
	
	public function get_list()
	{
		echo $return = '';
		exit();
	}
	
	public function map_list_view()
	{
		$this->data = array();
		
		$this->templatelayout->make_seo();
		$this->templatelayout->get_header();
		$this->templatelayout->get_banner();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']	=	'listing/map_list_view';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('listing_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	
}