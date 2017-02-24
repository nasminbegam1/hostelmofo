<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maplist extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic', 'model_search'));
		
	}
	
	
	public function index()
	{
		
		create_proper_url('',FALSE);
		
		$this->data = "";
		$extra_para = '';
		
		if(isset($_GET['group_type']) && $_GET['group_type'] != '' && isset($_GET['age_ranges']) && $_GET['age_ranges'] != ''){
			$extra_para .= '&group_type='.$_GET['group_type'].'&age_ranges='.$_GET['age_ranges'];
		}
		
		$this->data['grid_url']		= FRONTEND_URL.'listing/?guest='.$_GET['guest'].'&type='.$_GET['type'].'&city='.$_GET['city'].'&checkin='.$_GET['checkin'].'&checkout='.$_GET['checkout'].$extra_para.'&typeid='.$_GET['typeid'].'&s=true';
		
		$this->data['facility_list']	= $this->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');
		 
		$this->data['property_list']	= $this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');
	  //pr($this->data['property_list']);
		$this->data['roomtype_list']	= $this->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');
	  //pr($this->data['roomtype_list']);
		$this->data['citylist']		= $this->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug', 'city_seo_slug'), '', "status='Active' ", 'city_name', 'ASC');
	  
		/*** Get Values ***/
		$this->data['type_selected']	= $this->input->get_post('type');
		$city				= $this->input->get_post('city');
		
		$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_seo_slug, city_name, province_name', ' city_slug = "'.$city.'" ');
		$this->data['city_selected_slug']	= $citydata[0]['city_seo_slug'];
		$this->data['guest']		= $this->input->get_post('guest');
		$this->data['ptype']		= $this->input->get_post('type');
		$this->data['city']		= $this->input->get_post('city');
		$this->data['province']		= $this->input->get_post('province');
		$this->data['check_in']		= str_replace("-","/",$this->input->get_post('checkin'));
		$this->data['check_out']	= str_replace("-","/",$this->input->get_post('checkout'));
		$this->data['typeid']		= $this->input->get_post('typeid');
		
		$this->data['group_type'] = $this->input->get_post('group_type');
		$this->data['age_ranges'] = $this->input->get_post('age_ranges');
		//pr($this->data);
		
		$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
		$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');
		
		//$this->data['propertylist'] 	= $this->model_search->getlist();
		$this->data['propertylist'] 	= array();
		
		if($this->data['propertylist'] && is_array($this->data['propertylist']) )
		{
			$this->data['totalCount']	= count($this->data['propertylist']);
		}
		else
		{
			$this->data['totalCount']	= 0;
		}
		$this->data['max_guest']	= $this->model_basic->getValue_condition('hw_property_master','MAX(guest)');
		$this->templatelayout->make_seo();
		$this->templatelayout->get_map_header($this->data['type_selected']);
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'maplist/index';			
		$this->elements_data['middle'] 	= $this->data;
			    
		$this->layout->setLayout('maplist_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
	public function get_map_data()
	{
		
		create_proper_url();
		
		$this->data = "";
		//pr($_SERVER);
		//$config['base_url'] 		= FRONTEND_URL.'maplist/';
		$config['base_url'] 		= $_SERVER['HTTP_REFERER'];
		$config['page_query_string']	= TRUE;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']	= TRUE;
		$config['per_page'] 		= 10;
		//$config['uri_segment']		= 3;
		$config['num_links'] 		= 5;
		$config['suffix']		= "#!search";
		
		$guest		= $this->input->get_post('guest');
		
		if($guest == 'undefined'){
			$guest = 0;
		}
		
		//echo $guest ; exit;
		$check_in	= $this->input->get_post('checkin');
		$check_out	= $this->input->get_post('checkout');
		$propertytypes	= $this->input->get_post('propertytypes');
		$minprice	= $this->input->get_post('minprice');
		$maxprice	= $this->input->get_post('maxprice');
		$locations	= $this->input->get_post('locations');
		$roomtypes	= $this->input->get_post('roomtypes');
		$amenities	= $this->input->get_post('amenities');
		$page 		= str_replace("&page=",'',$this->input->get_post('page'));
		$page 		= str_replace("#!search",'',$this->input->get_post('page'));
		
		$ne_lat		= $this->input->get_post('ne_lat');
		$ne_lng		= $this->input->get_post('ne_lng');
		$sw_lat		= $this->input->get_post('sw_lat');
		$sw_lng		= $this->input->get_post('sw_lng');
		
		$group_type = $this->input->get_post('group_type');
		$age_ranges = $this->input->get_post('age_ranges');
		
		$this->data['siteCurrency']	= $this->nsession->userdata('currencyCode');
		$this->data['currencySymbol']   = $this->nsession->userdata('currencySymbol');
		
		$propertylist 	= $this->model_search->getAjaxMap();
		//$propertylist['guest'] = $guest;
		//pr($propertylist);
		$i=0;
		$arr_new_property = array();
		$arr_show_property =array();
		//echo $page;
		foreach($propertylist as $propertyVal)
		{
			if($propertyVal['daily_price'] > 0){
				$arr_new_property[$i] = $propertyVal;
				
				if( ($i >=(($page-1) * $config['per_page'])) and ($i < ($page * $config['per_page']))){
					$arr_show_property[$i] = $propertyVal;
				}
			}
			$i++;
		}
		$new_array['record'] = $arr_show_property;
		$new_array['pagination'] = '';
		$new_array['guest'] = $guest;
		$new_array['checkin'] = $check_in;
		$new_array['checkout'] = $check_out;
		$new_array['group_type'] = $group_type;
		$new_array['age_ranges'] = $age_ranges;
		
		$config['cur_page']	= $page;
		$config['total_rows'] 	= count($arr_new_property);
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$new_array['pagination'] = $this->pagination->create_links();
		$new_array['total_record'] = $config['total_rows'];
		//pr($config);
		
		
		echo json_encode($new_array);exit();
	}
	
	
	public function get_result_data()
	{
		$propertylist 	= $this->model_search->getAjaxMap();
				
		echo json_encode($propertylist);exit();
	}
	
	public function tooltipPropertydetail($property_id)
	{
		$site_currency	= $this->nsession->userdata('currencyCode');
		$currencySymbol = $this->nsession->userdata('currencySymbol');
		$currencyRate 	= $this->nsession->userdata('currencyRate');
		
		$guest		= $this->input->get('guest');
		
		if($guest == ''){
			$guest = 0; 
		}
		$group_type		= $this->input->get('group_type');
		$age_ranges		= $this->input->get('age_ranges');
		$checkin    = $this->input->get('checkin');
		$checkout    = $this->input->get('checkout');
		$propertylist 	= $this->model_search->getAjaxMap($property_id);
		//pr($propertylist);
		$property_price = currentPrice($propertylist[0]['daily_price']);
		
		$property_url	= FRONTEND_URL.'property/'.$propertylist[0]['property_type_slug'].'/'.$propertylist[0]['province_slug'].'/'.$propertylist[0]['city_seo_slug'].'/'.$propertylist[0]['property_slug'].'/'.$guest.'/'.$checkin.'/'.$checkout.'/';
		
		$property_id	= $propertylist[0]['property_id'];
		
		$property_name	= stripslashes($propertylist[0]['property_name']);
		
		$img_name	= CDN_PROPERTY_BIG_IMG.stripslashes($propertylist[0]['image_name']);
		
		$description	= substr(strip_tags(stripslashes($propertylist[0]['brief_introduction'])),0,30);
		
		$data['currencySymbol']	= $currencySymbol;
		$data['currencyRate']	= $currencyRate;
		$data['property_id']	= $property_id;
		$data['property_url']	= $property_url;
		$data['property_price']	= $property_price;
		$data['property_name']	= $property_name;
		$data['img_name']	= $img_name;
		$data['description']	= $description;
		$str 			= $this->load->view('maplist/maplist_icon',$data,true);
		
		
		echo $str;exit();
	}
	
	
	
}