<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listing extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_search');
		$this->load->model('model_property');
	}
	
	
		public function index(){
				//pr($_POST,0);
				//pr($_GET);
				$property			= $this->input->get_post('property');
				$property_slug			= $this->input->get_post('property_slug');
				
				$check_in			= $this->input->get_post('checkin');
				$check_out		= $this->input->get_post('checkout');
				$guest				= $this->input->get_post('guest');
				$group_type		= $this->input->get_post('group_type');
				$age_ranges		= $this->input->get_post('age_ranges');
				
				if($guest == ''){
						$guest = 0;
				}
				
				if(isset($property) && $property != ''){
					if(isset($check_in) && $check_in != ''){
								$chec_in = str_replace("/", "-", $check_in);
					}
					if(isset($check_out) && $check_out != ''){
								$chec_out = str_replace("/", "-", $check_out);
					}
					
					$singleProperty = $this->model_property->getSingleProperty($property,'active');
		
						if($guest > 8){
								$extra_par = '';
								if($group_type != ''){
										$extra_par .= '/'.$group_type;
								}
								if($age_ranges != ''){
										$extra_par .= '/'.$age_ranges;
								}
		
								redirect(FRONTEND_URL.'property/'.$singleProperty['property_type_slug'].'/'.$singleProperty['province_slug'].'/'.$singleProperty['city_slug'].'/'.$singleProperty['property_slug'].'/'.$guest.'/'.$chec_in.'/'.$chec_out.$extra_par);
						}
						else{
								redirect(FRONTEND_URL.'property/'.$singleProperty['property_type_slug'].'/'.$singleProperty['province_slug'].'/'.$singleProperty['city_slug'].'/'.$singleProperty['property_slug'].'/'.$guest.'/'.$chec_in.'/'.$chec_out);
						}
				}
				else{
						create_proper_url('',FALSE);
						$searchType		= $this->uri->segment(2, 0);
						$this->data     	= '';
						
						//$this->data['pagination'] = '';
						
						//$guest			= $this->input->get_post('guest');
						$ptype			= $this->input->get_post('type');
						$city				= $this->input->get_post('city');
						
						
						$province		= $this->input->get_post('province');
						//$check_in		= $this->input->get_post('checkin');
						//$check_out	= $this->input->get_post('checkout');
						
						//echo "ptype=".$ptype."=city=".$city."==province==".$province;
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
		
						$this->data['group_type'] 		=  $group_type;
						$this->data['age_ranges'] 		=  $age_ranges;
						$this->data['map_url']			= '?guest='.$guest.'&type='.$ptype.'&city='.$city.'&checkin='.$check_in.'&checkout='.$check_out.$extra_para.'&typeid='.$type_id."&s=true";
						
						$this->data['siteCurrency']		= $this->nsession->userdata('currencyCode');
						$this->data['currencySymbol'] 	= $this->nsession->userdata('currencySymbol');	
						$this->data['totalCount']			= 0;
						$this->data['propertylist']		= array();
		
		
						
		
		
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
								$this->data['province'] = '';
						}
						
						
						//echo $temploc;exit;
						
		
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
						
						
						//pr($baner_check_in,0);
						//pr($baner_check_out,0);
						//pr($guest,$group_type,0);
						//pr($age_ranges,0);
						
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
						
						//pr($breadcrumb_arr,1);
						
						$this->data['property_type_list']=	$this->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');
						
		
						$this->templatelayout->make_seo();
						//$this->templatelayout->get_inner_header($ptype);
						$this->templatelayout->get_banner($city, $temploc, $ptype, $type_id,$property, $baner_check_in, $baner_check_out,$guest,$group_type,$age_ranges,$breadcrumb_arr);
						$this->templatelayout->get_listing_leftpanel( array($left) );
						$this->templatelayout->get_breadcrumb($breadcrumb_arr);
						$this->templatelayout->get_inner_footer();
				
						$this->elements['middle']	=	'listing/index';			
						$this->elements_data['middle'] 	= 	$this->data;
				
						$this->layout->setLayout('listing_layout');
						$this->layout->multiple_view($this->elements,$this->elements_data);
				}
		}
		
		
			public function get_currency_dropdown(){		
		$sessionCountry 	= '';
		$sessionSymbol 		= '';
		$sessCurrencyCode 	= '';
		$sessCurrencyRate 	= '';
		$sessionnativecode 	= '';
		$sessioncurrency_name 	= '';
			    
		if($this->nsession->userdata('countryCode') != '')	    
			    $sessionCountry 	  = $this->nsession->userdata('countryCode');
		if($this->nsession->userdata('currencySymbol') != '')
			    $sessionSymbol  	  = $this->nsession->userdata('currencySymbol');
		if($this->nsession->userdata('currencyCode') != '')
			    $sessCurrencyCode     = $this->nsession->userdata('currencyCode');
		if($this->nsession->userdata('currencyRate') != '')
			    $sessCurrencyRate	  = $this->nsession->userdata('currencyRate');	    
		if($this->nsession->userdata('nativecurrencyCode') != '')
			    $sessionnativecode    = $this->nsession->userdata('nativecurrencyCode');
		if($this->nsession->userdata('currency_name') != '')
			    $sessioncurrency_name    = $this->nsession->userdata('currency_name');			    
	       
		if(  $sessionCountry !='' && $sessionSymbol !='' && $sessCurrencyCode !='' && $sessCurrencyRate !='' ){	
			    $countryCode 	= $sessionCountry;
			    $currencySymbol 	= $sessionSymbol;
			    $currencyCode	= $sessCurrencyCode;
			    $currencyRate	= $sessCurrencyRate; 
			    //$currencyCode1	= $sessionnativecode;
			    $currency_name	= $sessioncurrency_name;
		}
		else{ 
			$countryCode 		= 'AU';
			$currencySymbol 	= '$';
			$currencyCode		= 'AUD';
			$currencyRate		= 1.00; 
			    
			$userIP 	= $_SERVER['REMOTE_ADDR'];   
			$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$userIP));			
			if($ip_data && $ip_data->geoplugin_countryName != null){
				    $cntCode 	= $ip_data->geoplugin_countryCode;
				    $cName 	= $ip_data->geoplugin_countryName;
				    $uCity    	= $ip_data->geoplugin_city; 
				    $this->nsession->set_userdata('userCity',$uCity);
				    $this->nsession->set_userdata('userCountry',$cName);
			}
			    
			    if(isset($cntCode) &&  $cntCode != '-' )
				    $countryCode = $cntCode;
	
			    $currencyInfo	= $this->model_basic->getValues_conditions( CURRENCY_MASTER, '*', '',' country_currency_status="active"  AND country_code = "'.$countryCode.'" ');
			    
			    if($currencyInfo[0]){
					$countryCode 		= $currencyInfo[0]['country_code'];
					$currencySymbol 	= $currencyInfo[0]['country_currency_symbol'];
					$currencyCode 		= $currencyInfo[0]['currency_code'];
					$currencyRate		= $currencyInfo[0]['currency_rate'];
					$currency_name		= $currencyInfo[0]['currency_name'];
			    }else{
					$currencyInfo		= $this->model_basic->getValues_conditions(CURRENCY_MASTER, '*', '',' country_code = "AU" '); 
					$countryCode 		= 'TH';
					$currencySymbol 	= $currencyInfo[0]['country_currency_symbol'];
					$currencyCode 		= $currencyInfo[0]['currency_code'];
					$currencyRate		= $currencyInfo[0]['currency_rate'];
					$currency_name		= $currencyInfo[0]['currency_name'];
			    }
		    }
		    
		    $previousCurrency = $this->nsession->userdata('previousCurrency');
		    if( !isset($previousCurrency) || $previousCurrency == '' ){			
			    $this->nsession->set_userdata('previousCurrency',$currencyCode);
		    }
		    
		    $this->nsession->set_userdata('currencySymbol',$currencySymbol);
		    $this->nsession->set_userdata('countryCode',$countryCode);
		    $this->nsession->set_userdata('currencyCode',$currencyCode);
		    $this->nsession->set_userdata('currencyRate',$currencyRate);
		    $this->nsession->set_userdata('currency_name',$currency_name);
		    //$this->nsession->set_userdata('nativecurrencyCode',$currencyCode1);	
		
		$currencyInfo	= $this->model_basic->getValues_conditions(CURRENCY_MASTER, '*', '',"country_currency_status='active' group by currency_code ", 'country_code', 'ASC');
		if($currencyInfo)
		     $data['currency'] = $currencyInfo;
		else
		     $data['currency'] = array();
		
		$html = $this->load->view('layout/currency_dropdown', $data, TRUE);		
		$final_data = array($html ,$this->nsession->userdata('currencyCode'));		
		echo json_encode($final_data);
		exit;
	}

		
	
		public function getfilter(){ 
				create_proper_url();
				
				$pagi_config['base_url'] 					= AJAX_CURRENT_URL;
				$pagi_config['page_query_string']		= TRUE;
				$pagi_config['query_string_segment']	= 'page';
				$pagi_config['use_page_numbers']			= true;
				$pagi_config['per_page'] 					= $this->input->get_post('perpage', 10);
				$pagi_config['num_links'] 					= 5;
				$pagi_config['suffix']						= "#!search";
				$pagi_config['next_link'] = 'Next';
				$pagi_config['prev_link'] = 'Previous';
				$pagi_config['cur_tag_open'] = '&nbsp;<a class="current">';
				$pagi_config['cur_tag_close'] = '</a>';

			
				$page					= $this->input->get_post('page', 0);
				$page 				= str_replace("&page=",'',$page);
				$page 				= str_replace("#!search",'',$page);
			
				$guest				= $this->input->get_post('guest');
				$check_in			= $this->input->get_post('checkin');		
				$check_out			= $this->input->get_post('checkout');
			
				$group_type 	= $this->input->get_post('group_type');
				$age_ranges 	= $this->input->get_post('age_ranges');
				
				
		
				$check_in 		= (isset($check_in) && $check_in)?  str_replace("/", "-", $check_in) :  str_replace("/", "-", DEFAULT_CHECK_IN_DATE);
				$check_out 		= (isset($check_out) && $check_out)?  str_replace("/", "-", $check_out) :  str_replace("/", "-", DEFAULT_CHECK_OUT_DATE);	
			
				
				$stype 				= $this->input->get_post('stype');
				
				$return				= array();
				$propertylist = $this->model_search->getlist('search');
				//pr($propertylist);
				//echo "==".count($propertylist);
				$totalCount = 0;
				if($propertylist && is_array($propertylist) )
						foreach($propertylist as $property){
								if($property['base_price'] > 0){
										$totalCount	= $totalCount + 1;
								}
						}
			
				$siteCurrency			= $this->nsession->userdata('currencyCode');
				$currencySymbol   = $this->nsession->userdata('currencySymbol');
				$currencyRate 	= $this->nsession->userdata('currencyRate');
			
				$pagi_config['cur_page']		= $page;
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
			
			
				$html = '';
				$i=0;
				
		//pr($propertylist);
				//echo count($propertylist);
				if($propertylist && is_array($propertylist) && count($propertylist)>0){
						
						if($stype == "grid"){
								$html .= '<ul class="clearfix">';		
						}
						else{
								$html .= '<ul>';		
						}
						
						foreach($propertylist as $property){
							//echo $property['property_name'];
							//echo $propertyId = $property['property_id'];
								if($property['base_price'] > 0){
										if( ($i >=(($page-1) * $pagi_config['per_page'])) and ($i < ($page * $pagi_config['per_page']))){
												if($property['totalFeedback'] == ''){
														$property['totalFeedback'] = 0;
												}
												$propertyId = $property['property_id'];
												$imagepath = '';
												$property_url = '#';				
												$imagepath = isFileExist(CDN_PROPERTY_SMALL_IMG.stripslashes($property['image_name']));
												
												//$facilities =  substr($property['facilities']['amenities_name'], 0, strpos($property['facilities']['amenities_name'], ',', strpos($property['facilities']['amenities_name'], ',')+1));
												
												$facilities =  ($property['facilities'] != '' ? substr($property['facilities']['amen_name'], 0, strpos($property['facilities']['amen_name'], ',', strpos($property['facilities']['amen_name'], ',')+1)) : "N/A");
												//exit;
												$min_price = sprintf("%.2f",currentPrice1(stripslashes($property['min_price']['base_price']),$currencySymbol,$currencyRate));
												$dorm_min_price = sprintf("%.2f",currentPrice1(stripslashes($property['min_dorm']['base_price']),$currencySymbol,$currencyRate));
												$dorm_min_price_html = ($dorm_min_price != 0 ? '<div class="full_width"><span>Dorms From</span><span>'.($siteCurrency!="" ?$siteCurrency:"AUD").' '.$dorm_min_price.'</span></div>': ''    );
												
												$private_min_price = sprintf("%.2f",currentPrice1(stripslashes($property['min_private']['base_price']),$currencySymbol,$currencyRate));
												$private_min_price_html = ($private_min_price != 0 ? '<div class="full_width"><span>Privates From</span><span>'.($siteCurrency!="" ?$siteCurrency:"AUD").' '.$private_min_price.'</span></div>': ''    );
												
												//$dailyprice = ($property['daily_price'] > 0 ? $currencySymbol." ".number_format($property['daily_price'],0):"N/A");
												$dailyprice = ($property['base_price'] > 0 ? $currencySymbol." ".number_format($property['base_price'],0):"N/A");
												$startprice = ($property['start_price'] > 0 ? $currencySymbol." ".number_format($property['start_price'],0):"N/A");
												$city_link = '<a href="'.FRONTEND_URL.$property["province_slug"].'/'.$property["city_seo_slug"].'/">'.stripslashes($property["city_name"]).'</a>';
												$province_link = '<a href="'.FRONTEND_URL.$property["province_slug"].'/">'.stripslashes($property["province_name"]).'</a>';
												$address = stripslashes($property['address'])." ".stripslashes($property['address2']).", ".$city_link.", ".$province_link;
												$brief = substr(strip_tags(stripslashes($property['brief_introduction'])),0,80);
								
												$property_url = FRONTEND_URL.'property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'].'/'.$guest.'/'.$check_in.'/'.$check_out.$extra_par;
								
												
												
												if($stype == "grid"){

														$html .= '<li>
																				<div class="imgDiv">
																						<a href="'.$property_url.'">
																								<img src="'.$imagepath.'" width="370" height="246" alt="'.stripslashes($property['roomtype_name']).'">
																						</a>
																				</div>
																				<div class="gridTxt">
																						<div class="gridTxtUp">
																								<span class="hstlNm">
																										HOSTEL
																								</span>
																								<div class="HvnTxtIn clearfix">
																										<div class="hstlDtl alignleft">
																												<h5><a href="'.$property_url.'">'.stripslashes($property['property_name']).'</a></h5>
																												<h6>'.$address.'</h6>
																										</div>
																										<div class="blueRate alignright">
																												'.$property['rating'].'
																										</div>
																								</div>
																								<div class="ratng clearfix">
																										<div class="frmValue alignleft">
																												From: <span>'.($siteCurrency!="" ?$siteCurrency:"AUD").' '.$min_price.'</span>
																										</div>
																										<div class="kyFtr alignright">
																												'.$facilities.'
																										</div>
																								</div>
																						</div>
																						<div class="gridTxtBtm">
																								<div class="chrtTabl">
																										'.$dorm_min_price_html.'
																										'.$private_min_price_html.'
																								</div>
																						</div>
																				</div>
																		</li>';

												}
												else{
														$html .= '<li>
																				<div class="imgDiv alignleft">
																						<a href="'.$property_url.'">
																								<img src="'.$imagepath.'" width="250" height="184" alt="'.stripslashes($property['roomtype_name']).'">
																						</a>
																				</div>
																				<div class="listTxt alignright">
																					 <div class="listUp clearfix">
																							<div class="listName alignleft">
																								 <h5><a href="'.$property_url.'">'.stripslashes($property['property_name']).'</a></h5>
																								 <h6>'.$address.'</h6>
																							</div>
																							<div class="blueRate alignright">
																								 '.($property['rating'] == 0 ? "Not Rated" : $property['rating']).'
																							</div>
																					 </div>
																					 <div class="listBtm clearfix">
																							<div class="listBtmLt alignleft">
																								 <p>
																										'.$brief.'... <a href="'.$property_url.'">More...</a>
																								 </p>
																								 <div class="chkBx">
																										<input name="comparechk[]" type="checkbox" class="chkBoxProp" value="'.$propertyId.'">
																										<a class="btn newclass">Compare</a> 
																								 </div>
																							</div>
																							<div class="listBtmRt alignright">
																								 <span>'.($property['rating'] < 3 ? "Good" : ($property['rating'] > 3 && $property['rating']<7 ? 'Very Good': 'Fabulous')) .'</span>
																								 <div class="bleRtBox">
																										'.$dorm_min_price_html.'
																										'.$private_min_price_html.'
																										<a class="conBtn" href="'.$property_url.'">CONTINUE</a>
																								 </div>
																							</div>
																					 </div>
																				</div>	
																		</li>';
												}
												
												

												
												//$html .= '<li class="item">';
												//						if($property['fav_status']=='Yes'){
												//								$html .= '<div class="proFavIcon active">';	
												//						}
												//						else{
												//								$html .= '<div class="proFavIcon">';	
												//						}
												//						$html .= '<a href="javascript:void(0);" data-item="'. $property['property_slug'] .'" class="favouriteIcon ';
												//						if($this->nsession->userdata('USER_ID')==''){
												//								$html .=' noLog';
												//						}
												//						$html .='">
												//						<em class="iconback fa fa-heart"></em>
												//						<em class="iconfront fa fa-heart-o"></em>
												//						</a>
												//						</div>';
												//
												//$html .= '<div class="imgSec">
												//						<a href="'.$property_url.'">
												//								<img src="'.$imagepath.'" width="301" height="227" alt="'.stripslashes($property['roomtype_name']).'"/>
												//						</a>
												//						<div class="priceSec">
												//								<span class="priceText">Hostels From</span>
												//								<span class="priceText"><strong>'.$startprice.'</strong></span>
												//						</div>
												//				</div>
												//
												//				<div class="itemContent globalClr">
												//						<span class="globalClr itemTitle"><a href="'.$property_url.'">'.stripslashes($property['property_name']).'</a></span>
												//						<div class="starRatingPan">
												//								<div class="starRating">
												//										<span style="width: '.$property['totalFeedback'].'%;" class="starBack" id="ratePercent"></span>
												//										<span class="starFront"></span>
												//								</div>
												//						</div>
												//						<address class="itemAddress">'.$address.'</address>
												//						<p class="itemDescription"> <span class="globalClr">'.$brief.'</span>
												//						<a href="'.$property_url.'">More Info	<em class="fa fa-angle-double-right"></em></a></p> 
												//						</div>
												//				</li>';
										}
										$i++;
								}
								
						}
						$html .= '</ul>';
				}
				else{
						$html .= '<div class="noRecordText" style="text-align:center">
												<div><strong>There are 0 Properties that match your search criteria.</strong></div><br/>
												<div>You can see more Properties by amending / widening your filters.</div>
										</div>';
				}
			
			$return['html'] 			= $html;
			$return['totalCount']	= $totalCount;
			$return['pagi_links']	= $pagi_links;
			

			echo json_encode($return);
		}
		
		
		public function compareproperty(){
				$data = array();
				$countprop = $this->input->post('countp');
				$data['city'] = $this->input->post('city');
				$propertyids = $this->input->post('propertyids');
				
				$data['compare'] =  $this->model_property->compareProperty($propertyids);
				//pr($data['compare']);
				if($countprop > 1){
						$propdetails = $this->model_property->getproperty($propertyids);
						$data['propdetails'] = $propdetails;
						echo $this->load->view('listing/compare_property',$data,TRUE); 
						exit;
				}
				
				
		}
        
        public function getAjaxPropDetails($property_id){
                $site_currency	= $this->nsession->userdata('currencyCode');
				$currencySymbol = $this->nsession->userdata('currencySymbol');
				$currencyRate 	= $this->nsession->userdata('currencyRate');
                $propertylist		= $this->model_search->getAjaxMap($property_id);
				$property_price = currentPrice($propertylist[0]['daily_price']);
				$property_url		= FRONTEND_URL.'property/'.$propertylist[0]['property_type_slug'].'/'.$propertylist[0]['province_slug'].'/'.$propertylist[0]['city_seo_slug'].'/'.$propertylist[0]['property_slug'];
				$property_id		= $propertylist[0]['property_id'];
				$property_name	= stripslashes($propertylist[0]['property_name']);
				$img_name				= CDN_PROPERTY_BIG_IMG.stripslashes($propertylist[0]['image_name']);
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