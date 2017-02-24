<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maplist extends CI_Controller {

	
		public function __construct(){
				parent::__construct();
				$this->load->model(array('model_basic', 'model_search'));
		}
	
		public function index(){

				create_proper_url('',FALSE);
		
				$this->data = "";
				$extra_para = '';
		
				if(isset($_GET['group_type']) && $_GET['group_type'] != '' && isset($_GET['age_ranges']) && $_GET['age_ranges'] != ''){
						$extra_para .= '&group_type='.$_GET['group_type'].'&age_ranges='.$_GET['age_ranges'];
				}
		
				$this->data['grid_url']	= FRONTEND_URL.'listing/?guest='.$_GET['guest'].'&type='.$_GET['type'].'&city='.$_GET['city'].'&checkin='.$_GET['checkin'].'&checkout='.$_GET['checkout'].$extra_para.'&typeid='.$_GET['typeid'].'&s=true';
				$this->data['facility_list'] = $this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');
				$this->data['property_type_list'] = $this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');
				$this->data['roomtype_list'] = $this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');
				//pr($this->data['roomtype_list']);
				$this->data['citylist']		= $this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug', 'city_seo_slug'), '', "status='Active' ", 'city_name', 'ASC');
		
				$this->data['type_selected']	= $this->input->get_post('type');
				$city													= $this->input->get_post('city');
		
				$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_seo_slug, city_name, province_name, city_master_id', ' city_slug = "'.$city.'" ');
				//pr($citydata);
				$this->data['citydata'] = $citydata;
				$this->data['city_selected_slug']	= $citydata[0]['city_seo_slug'];
				$this->data['guest']							= $this->input->get_post('guest');
				$this->data['ptype']							= $this->input->get_post('type');
				$this->data['city']								= $this->input->get_post('city');
				$this->data['province']						= $this->input->get_post('province');
				$this->data['check_in']						= str_replace("-","/",$this->input->get_post('checkin'));
				$this->data['check_out']					= str_replace("-","/",$this->input->get_post('checkout'));
				$this->data['typeid']							= $this->input->get_post('typeid');
				$this->data['group_type'] 				= $this->input->get_post('group_type');
				$this->data['age_ranges'] 				= $this->input->get_post('age_ranges');
				$this->data['siteCurrency']				= $this->nsession->userdata('currencyCode');
				$this->data['currencySymbol']   	= $this->nsession->userdata('currencySymbol');
		
				//$this->data['propertylist'] 		= $this->model_search->getlist();
				$this->data['propertylist'] 			= array();
		
				if($this->data['propertylist'] && is_array($this->data['propertylist']) ){
						$this->data['totalCount']	= count($this->data['propertylist']);
				}
				else{
						$this->data['totalCount']	= 0;
				}
				
				$this->data['max_guest']					= $this->model_basic->getValue_condition('hw_property_master','MAX(guest)');
		
				//$this->templatelayout->make_seo();
				//$this->templatelayout->get_map_header($this->data['type_selected']);
				//$this->templatelayout->get_footer();
				//
				//$this->elements['middle']	= 'maplist/index';			
				//$this->elements_data['middle'] 	= $this->data;
				//
				//$this->layout->setLayout('maplist_layout');
				//$this->layout->multiple_view($this->elements,$this->elements_data);
		
				/*====================================================================================================================== */
				
				$property			= $this->input->get_post('property'); 
				$check_in			= $this->input->get_post('checkin');
				$check_out		= $this->input->get_post('checkout');
				$guest				= $this->input->get_post('guest');
				$group_type		= $this->input->get_post('group_type');
				$age_ranges		= $this->input->get_post('age_ranges');
				
				$searchType		= $this->uri->segment(2, 0);
						
						
				//$this->data['pagination'] = '';
				
				//$guest			= $this->input->get_post('guest');
				$ptype			= $this->input->get_post('type');
				$city				= $this->input->get_post('city'); 
				$province		= $this->input->get_post('province');
				//$check_in		= $this->input->get_post('checkin');
				//$check_out	= $this->input->get_post('checkout');
				$min_price	= '';
				$max_price	= '';
				$roomtype		= '';
				$facilities	= ''; 
				$currency		= 'AUD'; 
				$way				= 'home'; 
				$type_id		= $this->input->get_post('typeid');	
				$page				= $this->input->get_post('page');
				$start			= $this->input->get_post('start');
				$extra_para = '';
						//$bedroom	= 0;
						//$beds			= 0;	
				
				if($guest > 8){
						$extra_para = '';
						if($group_type != ''){
								$extra_para .= '&group_type='.$group_type;
						}
						if($age_ranges != ''){
								$extra_para .= '&age_ranges='.$age_ranges;
						}
				}
				
				//if(empty($guest)){
				//		$guest = 0;
				//}
				
				$this->data['guest'] = $guest;
				$this->data['group_type'] 		=  $group_type;
				$this->data['age_ranges'] 		=  $age_ranges;
				$this->data['map_url']				= '?guest='.$guest.'&type='.$ptype.'&city='.$city.'&checkin='.$check_in.'&checkout='.$check_out.$extra_para.'&typeid='.$type_id."&s=true";
				
				$this->data['siteCurrency']		= $this->nsession->userdata('currencyCode');
				$this->data['currencySymbol'] = $this->nsession->userdata('currencySymbol');	
				$this->data['totalCount']			= 0;
				$this->data['propertylist']		= array();
		
		
				$breadcrumb_arr = array(); 
				$breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
		
				$province_id = 0;
				
				if( isset($province) && $province != ''){			
					$provincedata	= $this->model_basic->getFromWhereSelect(PROVINCE_MASTER.' PRV ', 'province_id, province_name', ' province_slug = "'.$province.'" ');
					//$this->db->last_query();
						if( $provincedata && is_array($provincedata) ){
								$province_id 		= $provincedata[0]['province_id'];
								$this->data['province'] = $provincedata[0]['province_name'];
								$temploc 		= $this->data['province'];
						}
						
						$breadcrumb_arr[]	= array('text'=>'Province','link'=>'');
						$breadcrumb_arr[] 	= array('text'=>$this->data['province'],'link'=>'');
				}
				else{ 
						$this->data['province'] = '';
				}
		//echo "ssss".$this->data['province'];
				$temploc = '';
				if( isset($city) && $city != ''){
						//$this->data['cityname']	= $this->model_basic->getValue_condition(CITY, 'city_name', '','city_slug="'.$city.'"');
						$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_name, province_name', ' city_slug = "'.$city.'" ');
						if( $citydata && is_array($citydata) ){
								$this->data['cityname'] = $citydata[0]['city_name'];
								$this->data['province'] = $citydata[0]['province_name'];
								$temploc = $this->data['cityname'].', '.$this->data['province'];
						}
				}
				else{
						$this->data['cityname'] = '';
						//$this->data['province'] = '';
				}
		
		//echo "hhh".$this->data['province'];
				$this->data['checkin_date']		= '';
				$this->data['checkout_date']	= '';
		
				$baner_check_in 	= DEFAULT_CHECK_IN_DATE;
				$baner_check_out	= DEFAULT_CHECK_OUT_DATE;

				if(isset($check_in) && $check_in != ''){
						$this->data['checkin_date']	= date('D jS M Y',strtotime($check_in) );
						$baner_check_in = str_replace("-", "/", $check_in);
				}
		
				if(isset($check_in) && $check_in != ''){
						$this->data['checkout_date']	= date('D jS M Y',strtotime($check_out) );
						$baner_check_out = str_replace("-", "/", $check_out);
				}
		
						
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
						
				/*================================================================================================================================*/
				
				// for map page only
				
				$baner_check_in				= $this->input->get_post('checkin');
				$baner_check_out			= $this->input->get_post('checkout');
				
				$check_in_bann = explode('-',$baner_check_in);
				$check_out_bann = explode('-',$baner_check_out);
				
				//echo "<><>".$baner_check_in = $check_in_bann[1].'/'.$check_in_bann[2].'/'.$check_in_bann[0];
				//echo "<><>".$check_out_bann = $check_out_bann[1].'/'.$check_out_bann[2].'/'.$check_out_bann[0];
				
				$baner_check_in = str_replace("-", "/", $baner_check_in);
				$check_out_bann = str_replace("-", "/", $baner_check_out);
				
				// for map page only
		
				$this->templatelayout->make_seo();
				//$this->templatelayout->get_inner_header($ptype);
				$this->templatelayout->get_banner($city, $temploc, $ptype, $type_id,$property, $baner_check_in, $check_out_bann,$guest,$group_type,$age_ranges,$breadcrumb_arr);
				$this->templatelayout->get_listing_leftpanel( array($left) );
				$this->templatelayout->get_breadcrumb($breadcrumb_arr);
				$this->templatelayout->get_inner_footer();
				
				$this->elements['middle']	= 'maplist/index';			
				$this->elements_data['middle'] 	= 	$this->data;
				
				$this->layout->setLayout('maplist_layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);
		}
	
		public function get_map_data(){
				create_proper_url();
				$this->data = "";
				
				//$config['base_url'] 					= FRONTEND_URL.'maplist/';
				$config['base_url'] 						= $_SERVER['HTTP_REFERER'];
				$config['page_query_string']		= TRUE;
				$config['query_string_segment'] = 'page';
				$config['use_page_numbers']			= TRUE;
				$config['per_page'] 						= 10;
				//$config['uri_segment']				= 3;
				$config['num_links'] 						= 5;
				$config['suffix']								= "#!search";
		
				$guest													= $this->input->get_post('guest');
		
				if($guest == 'undefined'){
						$guest = 0;
				}
		
				$check_in				= $this->input->get_post('checkin');
				$check_out			= $this->input->get_post('checkout');
				$propertytypes	= $this->input->get_post('propertytypes');
				$minprice				= $this->input->get_post('minprice');
				$maxprice				= $this->input->get_post('maxprice');
				$locations			= $this->input->get_post('locations');
				$roomtypes			= $this->input->get_post('roomtypes');
				$amenities			= $this->input->get_post('amenities');
				$page 					= str_replace("&page=",'',$this->input->get_post('page'));
				$page 					= str_replace("#!search",'',$this->input->get_post('page'));
		
				$ne_lat					= $this->input->get_post('ne_lat');
				$ne_lng					= $this->input->get_post('ne_lng');
				$sw_lat					= $this->input->get_post('sw_lat');
				$sw_lng					= $this->input->get_post('sw_lng');
		
				$group_type 		= $this->input->get_post('group_type');
				$age_ranges 		= $this->input->get_post('age_ranges');
		
				$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
				$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');
		
				$propertylist 						= $this->model_search->getAjaxMap();
				//pr($propertylist);
		
				$i=0;
				$arr_new_property = array();
				$arr_show_property = array();
		
				foreach($propertylist as $propertyVal){
						if($propertyVal['daily_price'] > 0){
								$arr_new_property[$i] = $propertyVal;
		
								if( ($i >=(($page-1) * $config['per_page'])) and ($i < ($page * $config['per_page']))){
										$arr_show_property[$i] = $propertyVal;
								}
						}
						$i++;
				}
		
				$new_array['record'] 			= $arr_show_property;
				$new_array['pagination'] 	= '';
				$new_array['guest'] 			= $guest;
				$new_array['checkin'] 		= $check_in;
				$new_array['checkout'] 		= $check_out;
				$new_array['group_type'] 	= $group_type;
				$new_array['age_ranges'] 	= $age_ranges;
		
				$config['cur_page']				= $page;
				$config['total_rows'] 		= count($arr_new_property);
		
				$this->pagination->setFrontendPaginationStyle($config);
				$this->pagination->initialize($config);
		
				$new_array['pagination'] 		= $this->pagination->create_links();
				$new_array['total_record'] 	= $config['total_rows'];
		
				echo json_encode($new_array);
				exit();
		}
	
	
		public function get_result_data(){
				$propertylist 	= $this->model_search->getAjaxMap();
				echo json_encode($propertylist);
				exit();
		}
	
		public function tooltipPropertydetail($property_id){
				$site_currency	= $this->nsession->userdata('currencyCode');
				$currencySymbol = $this->nsession->userdata('currencySymbol');
				$currencyRate 	= $this->nsession->userdata('currencyRate');
				$guest					= $this->input->get('guest');
		
				if($guest == ''){
						$guest = 0; 
				}
		
				$group_type			= $this->input->get('group_type');
				$age_ranges			= $this->input->get('age_ranges');
				$checkin    		= $this->input->get('checkin');
				$checkout    		= $this->input->get('checkout');
				
				$propertylist		= $this->model_search->getAjaxMap($property_id);
				//pr($propertylist);
				$property_price = currentPrice($propertylist[0]['daily_price']);
				$property_url		= FRONTEND_URL.'property/'.$propertylist[0]['property_type_slug'].'/'.$propertylist[0]['province_slug'].'/'.$propertylist[0]['city_seo_slug'].'/'.$propertylist[0]['property_slug'].'/'.$guest.'/'.$checkin.'/'.$checkout.'/';
				$property_id		= $propertylist[0]['property_id'];
				$property_name	= stripslashes($propertylist[0]['property_name']);
				if($propertylist[0]['image_name']){
						$img_name				= CDN_PROPERTY_BIG_IMG.stripslashes($propertylist[0]['image_name']);
				}
				$description		= substr(strip_tags(stripslashes($propertylist[0]['brief_introduction'])),0,30);
		
				$data['currencySymbol']	= $currencySymbol;
				$data['currencyRate']		= $currencyRate;
				$data['property_id']		= $property_id;
				$data['property_url']		= $property_url;
				$data['property_price']	= $property_price;
				$data['property_name']	= $property_name;
				$data['img_name']				= $img_name;
				$data['description']		= $description;
				$str 										= $this->load->view('maplist/maplist_icon',$data,true);
		
				echo $str;
				exit();
		}
	
	
	
}