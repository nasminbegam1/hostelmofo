<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listing extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_search');
		$this->load->model('model_property');
	}
	
	
	public function index()
	{ 
		$property		= $this->input->get_post('property');
		$check_in		= $this->input->get_post('checkin');
		$check_out		= $this->input->get_post('checkout');
		$guest			= $this->input->get_post('guest');
		$group_type		= $this->input->get_post('group_type');
		$age_ranges		= $this->input->get_post('age_ranges');
		
		//echo "<pre>";print_r($_GET);exit();
		
		if($guest == ''){
			$guest = 0;
		}
		if(isset($property) && $property != ''){
			
			$singleProperty = $this->model_property->getSingleProperty($property);
			//echo FRONTEND_URL.'property/'.$singleProperty['property_type_slug'].'/'.$singleProperty['province_slug'].'/'.$singleProperty['city_slug'].'/'.$property.'/'.$guest.'/'.$check_in.'/'.$check_out;
			//exit;
			if($guest > 8){
				$extra_par = '';
				if($group_type != ''){
					$extra_par .= '/'.$group_type;
				}
				if($age_ranges != ''){
					$extra_par .= '/'.$age_ranges;
				}
				redirect(FRONTEND_URL.'property/'.$singleProperty['property_type_slug'].'/'.$singleProperty['province_slug'].'/'.$singleProperty['city_slug'].'/'.$property.'/'.$guest.'/'.$check_in.'/'.$check_out.$extra_par);
			}else{
				redirect(FRONTEND_URL.'property/'.$singleProperty['property_type_slug'].'/'.$singleProperty['province_slug'].'/'.$singleProperty['city_slug'].'/'.$property.'/'.$guest.'/'.$check_in.'/'.$check_out);
			}
		}
		
		else{
			
		create_proper_url('',FALSE);
		
		$searchType		= $this->uri->segment(2, 0);
		$this->data     	= '';
		//$this->data['pagination'] = '';
		$guest			= $this->input->get_post('guest');
		$ptype			= $this->input->get_post('type');
		$city			= $this->input->get_post('city');
		$province		= $this->input->get_post('province');
		$check_in		= $this->input->get_post('checkin');
		$check_out		= $this->input->get_post('checkout');
		$min_price		= '';
		$max_price		= '';
		$roomtype		= '';
		$facilities		= ''; 
		$currency		= 'AUD'; 
		$way			= 'home'; 
		$type_id		= $this->input->get_post('typeid');
		//$bedroom		= 0;
		//$beds			= 0;		
		$page			= $this->input->get_post('page');
		$start			= $this->input->get_post('start');
		$extra_para = '';
		if($guest > 8){
				$extra_para = '';
				if($group_type != ''){
					$extra_para .= '&group_type='.$group_type;
				}
				if($age_ranges != ''){
					$extra_para .= '&age_ranges='.$age_ranges;
				}
		}
		if(empty($guest)){
			$guest = 0;
		}
		$this->data['group_type'] 	=  $group_type;
		$this->data['age_ranges'] 	=  $age_ranges;
		
		$this->data['map_url']	= '?guest='.$guest.'&type='.$ptype.'&city='.$city.'&checkin='.$check_in.'&checkout='.$check_out.$extra_para.'&typeid='.$type_id."&s=true";
		
		$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
		$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');	

		$this->data['totalCount']	= 0;
		$this->data['propertylist']=array();

		
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
		
		//pr($this->data['propertylist']);
		$left = array();
		$left_guest 	= array('guest'=>array());
		$left_ptype 	= array('ptype'=>array());
		$left_city 	= array('city'=>array());
		$left_province 	= array('province'=>array());
		if( $guest!= '' ){			
			$left_guest = array( 'guest'=>array($guest) );
		}
		if( $city!= '' ){			
			$left_city = array( 'city'=>array($city) );
		}
		if( $city!= '' ){			
			$left_city = array( 'city'=>array($city) );
		}
		if($ptype != ''){
			$left_ptype = array( 'ptype'=>array($ptype) );
		}
		if($province != ''){
			$left_province = array( 'province'=>$province_id );
		}
		$left = array_merge($left_city, $left_ptype, $left_province,$left_guest);

		
		
		
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
		

		//pr($this->data);die();
		$this->templatelayout->make_seo();
		$this->templatelayout->get_header($ptype);
		$this->templatelayout->get_banner($city, $temploc, $ptype, $type_id,$property, $baner_check_in, $baner_check_out,$guest,$group_type,$age_ranges );
		$this->templatelayout->get_listing_leftpanel( array($left) );
		$this->templatelayout->get_breadcrumb($breadcrumb_arr);
		$this->templatelayout->get_footer();
		
		$this->elements['middle']	=	'listing/index';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('listing_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		}
		
	}
	
	public function getfilter(){ 
	
		create_proper_url();

		$pagi_config['base_url'] 							= AJAX_CURRENT_URL;
		$pagi_config['page_query_string']			= TRUE;
		$pagi_config['query_string_segment']	= 'page';
		$pagi_config['use_page_numbers']			= TRUE;
		$pagi_config['per_page'] 							= 4;
		$pagi_config['num_links'] 						= 5;
		$pagi_config['suffix']								= "#!search";
		
		$page				= $this->input->get_post('page', 0);
		$page 			= str_replace("&page=",'',$page);
		$page 			= str_replace("#!search",'',$page);
		$guest			= $this->input->get_post('guest');
		
		$check_in			= $this->input->get_post('checkin');		
		$check_out		= $this->input->get_post('checkout');
		
		$group_type = $this->input->get_post('group_type');
		$age_ranges = $this->input->get_post('age_ranges');
	
		$check_in 	= (isset($check_in) && $check_in)?  str_replace("/", "-", $check_in) :  str_replace("/", "-", DEFAULT_CHECK_IN_DATE);
		$check_out 	= (isset($check_out) && $check_out)?  str_replace("/", "-", $check_out) :  str_replace("/", "-", DEFAULT_CHECK_OUT_DATE);	
		
		
		
		$return	= array();
		$propertylist 	= $this->model_search->getlist('search');
		//pr($propertylist,0);
		
		
		
		
		$totalCount = 0;
		if($propertylist && is_array($propertylist) )
			
			foreach($propertylist as $property){
				if($property['base_price'] > 0)
				{
					//pr($property,0);
					$totalCount	= $totalCount + 1;
				}
			}
		//echo '<><><><><><>';
		//pr($data['propertylist']);
		$siteCurrency	= $this->nsession->userdata('currencyCode');
		$currencySymbol   = $this->nsession->userdata('currencySymbol');
		
		$pagi_config['cur_page']	= $page;
		$pagi_config['total_rows'] 	= $totalCount;
		$this->pagination->setFrontendPaginationStyle($pagi_config);
		$this->pagination->initialize($pagi_config);
		$pagi_links = $this->pagination->create_links();
		
		$extra_par = '';
		if($group_type != ''){
			$extra_par .= '/'.$group_type;
		}
		if($age_ranges != ''){
			$extra_par .= '/'.$age_ranges;
		}
		
		//pr($pagi_links);
		$html = '';$i=0;
		if($propertylist && is_array($propertylist) ){
			//pr($propertylist);
			$html .= '<ul class="clearfix">';
			foreach($propertylist as $property){
				if($property['base_price'] > 0)
				{
					//echo '$i'.$i;
					if( ($i >=(($page-1) * $pagi_config['per_page'])) and ($i < ($page * $pagi_config['per_page']))){
						//pr($property,0);
						if($property['totalFeedback'] == ''){
							$property['totalFeedback'] = 0;
						}					
						$imagepath = '';
						$property_url = '#';				
						$imagepath = isFileExist(CDN_PROPERTY_SMALL_IMG.stripslashes($property['image_name']));
						//$dailyprice = ($property['daily_price'] > 0 ? $currencySymbol." ".number_format($property['daily_price'],0):"N/A");
						$dailyprice = ($property['base_price'] > 0 ? $currencySymbol." ".number_format($property['base_price'],0):"N/A");
						$startprice = ($property['start_price'] > 0 ? $currencySymbol." ".number_format($property['start_price'],0):"N/A");
						$city_link = '<a href="'.FRONTEND_URL.$property["province_slug"].'/'.$property["city_seo_slug"].'/">'.stripslashes($property["city_name"]).'</a>';
						$province_link = '<a href="'.FRONTEND_URL.$property["province_slug"].'/">'.stripslashes($property["province_name"]).'</a>';
						$address = stripslashes($property['address'])." ".stripslashes($property['address2']).", ".$city_link.", ".$province_link;
						$brief = substr(strip_tags(stripslashes($property['brief_introduction'])),0,80);
						
						$property_url = FRONTEND_URL.'property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'].'/'.$guest.'/'.$check_in.'/'.$check_out.$extra_par;
						$html .= '<li class="item">';
						 
						
							if($property['fav_status']=='Yes'){
								$html .= '<div class="proFavIcon active">';	
							}else{
								$html .= '<div class="proFavIcon">';	
							}
							
							$html .= '<a href="javascript:void(0);" data-item="'. $property['property_slug'] .'" class="favouriteIcon ';
							if($this->nsession->userdata('USER_ID')==''){
								$html .=' noLog';
							}
							$html .='">
							   <em class="iconback fa fa-heart"></em>
							    <em class="iconfront fa fa-heart-o"></em>
							</a>
							</div>';
						
							$html .= '<div class="imgSec">
								  <a href="'.$property_url.'"><img src="'.$imagepath.'" width="301" height="227" alt="'.stripslashes($property['roomtype_name']).'"/></a>
							  <div class="priceSec">
								  <span class="priceText">Hostels From</span>
								  <span class="priceText"><strong>'.$startprice.'</strong></span>
							  </div>
							  </div>
							  
							<div class="itemContent globalClr">
							<span class="globalClr itemTitle"><a href="'.$property_url.'">'.stripslashes($property['property_name']).'</a></span>
							<div class="starRatingPan"><div class="starRating"><span style="width: '.$property['totalFeedback'].'%;" class="starBack" id="ratePercent"></span><span class="starFront"></span></div></div>
							  <address class="itemAddress">'.$address.'</address>
							  <p class="itemDescription"> <span class="globalClr">'.$brief.'</span><a href="'.$property_url.'">More Info <em class="fa fa-angle-double-right"></em></a></p> 
							</div>
						      </li>';
					}
					$i++;
				}
				
			}
			$html .= '</ul>';
		}else{
			$html .= '<div class="noRecordText" style="text-align:center"><div><strong>There are 0 Properties that match your search criteria.</strong></div><br/><div>You can see more Properties by amending / widening your filters.</div></div>';
		}
		
		$return['html'] 	= $html;
		$return['totalCount']	= $totalCount;
		$return['pagi_links']	= $pagi_links;
		//pr($return);
		echo json_encode($return);
		
	}
	
}