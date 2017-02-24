<?php

class Property extends MY_Controller{
    
		  public function __construct(){
				parent::__construct();
				$this->load->model('model_basic');
				$this->load->model('model_property');
				$this->load->model('model_review');
				$this->load->model('model_grpproperty');
		  }
    
    
		  public function getMaxPrice(){
				// MAX(PRP.daily_price) as max_price
			  
		  }
    

		  
	public function details(){
		create_proper_url();
		if($this->uri->total_segments()>11){
			redirect(FRONTEND_URL.'page-not-found/');
		}
		
		$property_slug 	= $this->uri->segment(5,0);
		$city 			= $this->uri->segment(4,0); 
		$province 		= $this->uri->segment(3,0);
		$type 			= $this->uri->segment(2,0);
		$guest 			= $this->uri->segment(6,'');
	
	
		$this->data 	= "";
		
		$this->data['details'] = $this->model_property->getGrpPropertyDetails($property_slug);
		//if(array_key_exists('price_charge_type_arr', $this->data['details_result'])){
		//  $this->data['details'] = $this->data['details_result'];
		//}
		//else
		//{
		//  $this->data['details']['price_charge_type_arr'] = array();
		//  pr($this->data['details']['price_charge_type_arr']);
		//  $this->data['details'] = $this->data['details_result'];
		//}
		$this->data['country_list']  	= $this->model_basic->getValues_conditions('hw_countries','','','','countryName','ASC');
		$this->data['guest'] 			= $guest;
		//pr($this->data['country_list']);
	
		if(count($this->data['details'])==0){
			redirect(FRONTEND_URL.'page-not-found/');
		}
	
		$breadcrumb_arr = array(); 
		$breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
	
		if($city!=''){
			$city_arr 			= explode('-',$city);
			$province_slug 		= $city_arr[end(array_keys($city_arr))];
			$province_arr 		= $this->model_basic->getValues_conditions(PROVINCE_MASTER, 'province_name,province_slug', '', ' province_short_code="'.$province_slug.'" ');
			$province_arr 		= $province_arr[0];
			$city_data 			= $this->model_basic->getValues_conditions(CITY_MASTER, 'city_name,city_slug', '', ' city_slug="'.$city.'" ');
			$city_data 			= $city_data[0]; 
			$breadcrumb_arr[]	= array('text'=>$province_arr['province_name'],'link'=>FRONTEND_URL.'listing/?province='.$province_arr['province_slug']);
			$breadcrumb_arr[] 	= array('text'=>$city_data['city_name'],'link'=>'');
		}
	
		$this->data['guest']= $this->uri->segment(6,'');
		$check_in			= $this->uri->segment(7,'');		
		$check_out			= $this->uri->segment(8,'');
		$group_type			= $this->uri->segment(9,'');
		$age_ranges			= $this->uri->segment(10,'');
	
		$extra_para = '';
		if($guest > 8){
			$extra_para = '';
			if(isset($group_type) && $group_type != ''){
				$extra_para = '/'.$group_type;
			}
			if(isset($age_ranges) && $age_ranges != ''){
				$extra_para .= '/'.$age_ranges;
			}
		}
	
		$chkindt = explode('-',$check_in);
		$chkoutdt = explode('-',$check_out);
	
		$this->data['chkindt'] = $chkindt[2]."-".$chkindt[1]."-".$chkindt[0];
		$this->data['chkoutdt'] = $chkoutdt[2]."-".$chkoutdt[1]."-".$chkoutdt[0];
	
	
		$this->data['check_in'] 	= (isset($check_in) && $check_in)?  $this->data['chkindt'] :   DEFAULT_CHECK_IN_DATE;
		$this->data['check_out'] 	= (isset($check_out) && $check_out)?  $this->data['chkoutdt'] :  DEFAULT_CHECK_OUT_DATE;        
		$this->data['checkin_date'] =  (isset($check_in) && $check_in)? date('D jS M Y',strtotime($check_in)) : date('D jS M Y',strtotime(str_replace("/", "-", DEFAULT_CHECK_IN_DATE))) ;       
		$this->data['checkout_date']=  (isset($check_out) && $check_out)? date('D jS M Y',strtotime($check_out)) : date('D jS M Y',strtotime(str_replace("/", "-", DEFAULT_CHECK_OUT_DATE))) ;
		$this->data['group_type'] 	=  $group_type;
		$this->data['age_ranges'] 	=  $age_ranges;  
		$this->data['property_slug']= $property_slug;
		$property_id 				= $this->data['details']['master_details']['property_master_id'];
		$property_type				= $this->data['details']['master_details']['property_type_id'];
		$property_type_slug			= $this->data['details']['master_details']['property_type_slug'];
		$city_slug 					= $this->data['details']['master_details']['city_slug'];
		$location 					= stripslashes($this->data['details']['master_details']['property_name']).', '.$this->data['details']['master_details']['city_name'].', '.$this->data['details']['master_details']['province_name'];
		
		
	
		$date1=date_create($this->data['chkindt']);
		$date2=date_create($this->data['chkoutdt']);
		$diff=date_diff($date1,$date2);
		$this->data['no_of_days'] = $diff->d;
	
		//pr($this->data['group_type']);
		//$condition = " property_id = '".$property_id."' AND review_status = 'Active'";
		//$this->data['review_list'] = $this->model_basic->getValues_conditions(REVIEW_MASTER,'*','',$condition,'review_id','DESC');
		//pr($this->data['review_list']);
	
		//echo $property_id; die();
	
		$this->data['dealDetails'] 	= $this->model_property->existingDeal($property_id);
		//$this->data['avg_review'] = $this->model_review->getAvarageRating($property_id);
		$this->data['avg_review'] 	= $this->model_review->getAvgRating($property_id);
		//pr($this->data['avg_review']);
		$this->data['similar_property'] = $this->model_property->getSimilarProperty($property_id);
		$this->data['property_facility'] = $this->model_property->getPropertyFacility($property_id);
	
		//pr($this->data['property_facility']);
		
		$title 	= $this->data['details']['master_details']['meta_title'];
		$desc 	= $this->data['details']['master_details']['meta_description'];
		$key 	= $this->data['details']['master_details']['meta_keyword'];
	
		$featured_image='';
		if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){
			$featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);
		}
	
		$share = array(
						'og' 		=> array(
											'site_name'		=> $title,
											'description'	=> $desc,
											'image'			=> $featured_image,
											'link'			=> "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
										),
						'twitter'	=> array(
											'image'			=> $featured_image,
											'title'			=> $title,
											'link'			=> "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
										)
					);
	
	
		$this->data['map_link'] = FRONTEND_URL.'property/direction/'.$type.'/'.$province.'/'.$city.'/'.$property_slug.'/'.$guest.'/'.$check_in.'/'.$check_out.$extra_para;
		$this->data['succmsg'] 	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
	
		$this->nsession->set_userdata('succmsg','');
		$this->nsession->set_userdata('errmsg','');
		
		$this->templatelayout->make_seo($title,$desc,$key,$share);
		//$this->templatelayout->get_header();
		$this->templatelayout->get_banner($city_slug,$location,$property_type_slug,$property_type,$property_slug,$this->data['check_in'],$this->data['check_out'],$this->data['guest'],$group_type,$age_ranges,$breadcrumb_arr);
		$this->templatelayout->get_breadcrumb($breadcrumb_arr);
		$this->templatelayout->get_inner_footer();
	
		if($this->data['guest'] > 8 && $this->data['details']['master_details']['group_booking_support'] == 'yes'){
			$this->data['ageGroup']  	= $this->model_basic->getValues_conditions('hw_ageGroup','','','status="Active"');
			$this->data['groupType']  	= $this->model_basic->getValues_conditions('hw_groupType','','','status="Active"');
	
			$ageGroup 		= str_replace("-", ",", $age_ranges).",";
			$group_id 		= $this->model_property->getGroupId($group_type);
			$is_available 	= $this->model_property->availableGrpDate($check_in,$check_out,$property_id,$group_id,$ageGroup);
			
			$this->data['group_available'] = '';
			$this->data['group_isAvailable'] = $is_available['type'];
	
			if($is_available['type'] == 'error'){
				$this->data['group_available'] = $is_available['message'];
			}
	
			$this->elements['middle']	=	'property/group_details';
		}
		else{
			$this->elements['middle']	=	'property/details'; 
		}
	
		$this->elements_data['middle'] 	= 	$this->data;
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
    
	 
		  
		  public function property_direction(){
				create_proper_url();
				$type				= $this->uri->segment(3,'');
				$province				= $this->uri->segment(4,'');
		  if($this->uri->total_segments()>12){
				  redirect(FRONTEND_URL.'page-not-found/');
				}
				$property_slug = $this->uri->segment(6,0);
				$city = $this->uri->segment(5,0);
				$this->data = "";
				$guest				= $this->uri->segment(7,'');
				$check_in			= $this->uri->segment(8,'');		
				$check_out			= $this->uri->segment(9,'');
				$group_type			= $this->uri->segment(10,'');
				$age_ranges			= $this->uri->segment(11,'');
				
				$extra_para = '';
				if($guest >8){
					 $extra_para = '';
					 if(isset($group_type) && $group_type != ''){
								$extra_para = '/'.$group_type;
					 }
					 if(isset($age_ranges) && $age_ranges != ''){
								$extra_para .= '/'.$age_ranges;
					 }
				}
				//echo $extra_para; exit;
				$this->data['guest'] = $guest;
				$this->data['check_in'] 	= (isset($check_in) && $check_in)?  str_replace("-", "/", $check_in) :   DEFAULT_CHECK_IN_DATE;
				$this->data['check_out'] 	= (isset($check_out) && $check_out)?  str_replace("-", "/", $check_out) :  DEFAULT_CHECK_OUT_DATE;        
				$this->data['checkin_date'] 	=  (isset($check_in) && $check_in)? date('D jS M Y',strtotime($check_in)) : date('D jS M Y',strtotime(str_replace("/", "-", DEFAULT_CHECK_IN_DATE))) ;       
				$this->data['checkout_date'] 	=  (isset($check_out) && $check_out)? date('D jS M Y',strtotime($check_out)) : date('D jS M Y',strtotime(str_replace("/", "-", DEFAULT_CHECK_OUT_DATE))) ;
				$this->data['group_type'] 	=  $group_type;
				$this->data['age_ranges'] 	=  $age_ranges;  
				$this->data['property_slug'] 	= $property_slug;
				
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
				
				$this->data['details']= $this->model_property->getGrpPropertyDetails($property_slug);
				//pr($this->data['details']); exit;
				$property_id 			= $this->data['details']['master_details']['property_master_id'];
				$property_type			= $this->data['details']['master_details']['property_type_id'];
				$property_type_slug		= $this->data['details']['master_details']['property_type_slug'];
				$city_slug 			= $this->data['details']['master_details']['city_slug'];
				
		
				
				if( isset($city_slug) && $city_slug != ''){
								//$this->data['cityname']	= $this->model_basic->getValue_condition(CITY, 'city_name', '','city_slug="'.$city.'"');
								$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_name, province_name', ' city_slug = "'.$city_slug.'" ');
								if( $citydata && is_array($citydata) ){
										$this->data['cityname'] = $citydata[0]['city_name'];
										$this->data['province'] = $citydata[0]['province_name'];
										$temploc = $this->data['cityname'].', '.$this->data['province'];
								}
						}
				
				
				
				$location 			= stripslashes($this->data['details']['master_details']['property_name']).', '.$this->data['details']['master_details']['city_name'].', '.$this->data['details']['master_details']['province_name'];
				$this->data['avg_review'] 	= $this->model_review->getAvgRating($property_id);
				$title = $this->data['details']['master_details']['meta_title'];
				$desc = $this->data['details']['master_details']['meta_description'];
				$key = $this->data['details']['master_details']['meta_keyword'];
				$featured_image='';
				if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){
					 $featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);
				}
				$share = 	array(
                            'og'=>array(
                                        'site_name'=>$title,
                                        'description'=>$desc,
                                        'image'=>$featured_image,
                                        'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                                        ),
                            'twitter'=>array(
                                      'image'=>$featured_image,
                                      'title'=>$title,
                                      'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                            )
								);
				$this->data['succmsg'] = $this->nsession->userdata('succmsg');
				$this->data['errmsg'] = $this->nsession->userdata('errmsg');
				
				$this->data['link'] = FRONTEND_URL.'property/'.$type.'/'.$province.'/'.$city.'/'.$property_slug.'/'.$guest.'/'.$check_in.'/'.$check_out.$extra_para;
				
				
				$this->nsession->set_userdata('succmsg','');
				$this->nsession->set_userdata('errmsg','');
				$this->templatelayout->make_seo($title,$desc,$key,$share);
				//$this->templatelayout->get_header();
				//$this->templatelayout->get_inner_header();
				$this->templatelayout->get_banner($city_slug,$location,$property_type_slug,$property_type,$property_slug,$this->data['check_in'],$this->data['check_out'],$this->data['guest'],$group_type,$age_ranges,$breadcrumb_arr);
				$this->templatelayout->get_breadcrumb($breadcrumb_arr);
				$this->templatelayout->get_inner_footer();
				$this->elements['middle']	=	'property/direction';
				$this->elements_data['middle'] 	= 	$this->data;
								
				$this->layout->setLayout('details_layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);
		  }
	 
	 
	 
	 
		  public function checkAvailable(){
        
				$checkin 		= $this->input->post('checkin');
				$checkout 		= $this->input->post('checkout');	
				$property_id 		= $this->input->post('property_id');
				$is_available 		= $this->model_property->availableDate($checkin,$checkout,$property_id);
				
				echo json_encode($is_available);
				//echo $is_available;
		  }
		  
		  public function checkMinNight(){
				$checkin = $this->input->post('checkin');
				$checkout = $this->input->post('checkout');	
				$property_id = $this->input->post('property_id');
				$minNight = $this->model_property->checkMinNight($checkin,$checkout,$property_id);
				if($minNight != ''){
					 echo json_encode($minNight);
				}
				else{
					 echo '';
				}
		  }
		  
		  
		  public function availableDate(){
				$checkin = $this->input->post('checkin');
				$checkout = $this->input->post('checkout');
				$is_available = $this->model_property->availableDate($checkin,$checkout);
		  }
    
	 
		  /* corfirm booking
		   * parameter
		   * return
		   */ 
	 
		  public function confirmbooking(){
				//pr($this->input,0);
			   // pr($_POST,0);
				
			// echo "aaaa"; die();
			$this->data = "";
			
			$this->data['post_value'] = $_POST;
			//pr($this->data['post_value']);
			$sess_id = $this->nsession->userdata('session_id');
			$currencyRate = $this->nsession->userdata('currencyRate');
			if($this->input->post('bookingType') != ''){
				 $this->model_basic->deleteData('hw_booking_temp','session_id = "'.$sess_id.'"');   
			}
			
			$usd_rate = $this->model_basic->getValues_conditions('hw_currency_master', 'currency_rate', '', "country_currency_id = '3'");
			$this->data['usd_currency_rate'] = $usd_rate[0]['currency_rate'];
			$record_exist_bookingtemp = $this->model_basic->isRecordExist('hw_booking_temp','session_id = "'.$sess_id.'"');
			//pr($_REQUEST);
			
			
			if($record_exist_bookingtemp == 0){ 
				 
				 if($this->input->post('bookingType') == 'booking'){
					  $room_type_id 	= $this->input->post('room_type_id');
					  $room_type_id 	= implode(",",$room_type_id);
					  $no_room 	  		= $this->input->post('no_room');
					  $no_room 	  		= implode(",",$no_room);
					  $no_person 	  	= $this->input->post('no_room');
					  $no_person 	  	= implode(",",$no_person);
					  
					  $room_name 		= $this->input->post('room_name');
					  $room_name 		= implode(',',$room_name);
					  $hosteltype 		= $this->input->post('hosteltype');
					  $hosteltype		= implode(',',$hosteltype);
					  
					  $tot_room_price 	= $this->input->post('tot_room_price');
					  $total_room_price 	= array();	    
					  foreach($tot_room_price as $trp){
							$tot_room_price1 = $trp/$currencyRate;
							$tot_room_price1 = sprintf('%.2f',$tot_room_price1);
							array_push($total_room_price,$tot_room_price1);
					  }
					  $tot_room_price 	= implode(",",$total_room_price);
					  $room_price 	= $this->input->post('room_price');
					  $room_price_array = array();
					  foreach($room_price as $rp){
							$room_price1 = $rp/$currencyRate;
							$room_price1 = sprintf('%.2f',$room_price1);
							array_push($room_price_array,$room_price1);
							
					  }
					  $room_price 	= implode(",",$room_price_array);
					  
					  $property_price = $this->input->post('property_price_total')/$currencyRate;
					  $property_price = sprintf('%.2f',$property_price);
					  
					  
					  $check_in 	= $this->input->post('check_in');
					  $check_out	= $this->input->post('check_out');
					  
					  //$ci = explode('/',$check_in);
					  //$ci_date = $ci[2]."-".$ci[1]."-".$ci[0];
					  //$co = explode('/',$check_out);
					  //$co_date = $co[2]."-".$co[1]."-".$co[0];
					  
					  $ci_date            = str_replace('/', '-', $check_in);
						$co_date           = str_replace('/', '-', $check_out);
					  
					  
					  $date1=date_create($ci_date);
					  $date2=date_create($co_date);
					  $diff=date_diff($date1,$date2);
					  $total_day = $diff->d;
					  
					  
					  
					  $insrArr 		=  array(
										  'session_id' 	=> $sess_id,
										  'bookingType'	=> $this->input->post('bookingType'),
										  'pslug' 	=> $this->input->post('pslug'),
										  'room_type_id'	=> $room_type_id,
										  'no_of_person'	=> $no_person,
										  'deal_id' 	=> $this->input->post('deal_id'),
										  'property_id'	=> $this->input->post('property_id'),
										  'currency_name'=> $this->nsession->userdata('currencyCode'),
										  'property_price'=> $property_price,
										  //'property_price'=> $this->input->post('property_price'),
										  'check_in' 	=> $ci_date,
										  'check_out'	=> $co_date,
										  'total_day'	=> $total_day,
										  'person' 	=> $this->input->post('person'),
										  'no_room'	=> $no_room,
										  'tot_room_price'=> $tot_room_price,
										  'room_price'	=> $room_price,
										  'room_name' =>  $room_name,
										  'hosteltype' => $hosteltype 
									   );
							//pr($insrArr);
				 }
			
				 else if($this->input->post('bookingType') == 'deal'){
					  $room_type_id = $this->input->post('room_type_id');
					  $room_type_id = implode(",",$room_type_id);
					  $no_person 	  = $this->input->post('no_of_person');
					  $no_person 	  = implode(",",$no_person);
					  $insrArr 	=  array('session_id' 	=> $sess_id,
						  'bookingType'	=> $this->input->post('bookingType'),
						  'pslug' 	=> $this->input->post('pslug'),
						  'room_type_id'	=> $room_type_id,
						  'no_of_person'	=> $no_person,
						  'deal_id' 	=> $this->input->post('deal_id'),
						  'property_id'	=> $this->input->post('property_id'),
						  'currency_name'=> $this->nsession->userdata('currencyCode'),
						  'property_price'=> ($this->input->post('property_price')/$currencyRate),
						  //'property_price'=> $this->input->post('property_price'),
						  'check_in' 	=> $this->input->post('check_in'),
						  'check_out'	=> $this->input->post('check_out'),
						  'total_day'	=> $this->input->post('total_day'),
						  'person' 	=> $this->input->post('person')
					 );
					  //pr($insrArr);
				 }
				 //echo "aaa";pr($insrArr);
				 $this->model_basic->insertIntoTable('hw_booking_temp',$insrArr);
			}
			
			
			
			$this->data['booking_data']	= $this->model_basic->getValues_conditions('hw_booking_temp','','','session_id = "'.$sess_id.'"');
			
			
			if(isset($this->data['booking_data']) && is_array($this->data['booking_data']) && count($this->data['booking_data'])>0){
				 foreach($this->data['booking_data'] as $book_data){
					  $booking_type 	= $book_data['bookingType'];
					  $property_slug 	= $book_data['pslug'];
					  $room_type_id 	= $book_data['room_type_id'];
					  $no_of_person 	= $book_data['no_of_person'];
					  $deal_id 	= $book_data['deal_id'];
					  $property_id 	= $book_data['property_id'];
					  $session_id = $book_data['session_id'];
				 }
			}
			
			
			
			
			$this->data['property_slug'] 	= $property_slug;
			$this->data['property_id'] 		= $property_id;
			$this->data['details']			= $this->model_property->getPropertyDetails($property_slug);
			//pr($this->data['details']);
			$this->data['country_list']  	= $this->model_basic->getValues_conditions('hw_countries','','','','countryName','ASC');
			$this->data['country_phone']  	= $this->model_basic->getValues_conditions('hw_country_code','','','','nicename','ASC');
			
			$this->data['walletBlns']		= $this->model_property->getWalletBalance();
			
			$property_type					= $this->data['details']['master_details']['property_type_id'];
			$property_type_slug				= $this->data['details']['master_details']['property_type_slug'];
			$city_slug 						= $this->data['details']['master_details']['city_slug'];
			$location 						= stripslashes($this->data['details']['master_details']['property_name']).', '.$this->data['details']['master_details']['city_name'].', '.$this->data['details']['master_details']['province_name'];

			if(count($this->data['details'])==0){
				 redirect(FRONTEND_URL.'page-not-found/');
			}
			if($booking_type == 'booking'){
				 $this->data['downpayment'] 		= $this->data['details']['master_details']['deposite_amount'];
				 $this->data['service_fees'] 	= $this->data['details']['master_details']['service_fees'];
				 $this->data['downpayment_amount'] 	= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 20");
				 $this->data['flexible_amount'] 	= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 21");
				 $this->data['standard_flexible_amount'] 	= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 21");
				 $middle_view = 'property/confirm_booking';
			}
			else{
				 $room_type_id 	= explode(',',$room_type_id);
				 $no_of_person 	= explode(',',$no_of_person);
				 $deal_id 		= $deal_id;
				 $this->data['room_detail']	= $this->model_property->getBookedDeal($room_type_id,$no_of_person,$deal_id);
				 $this->data['standard_flexible_amount'] 	= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 21");
				 //pr($this->data['room_detail']);
				 $middle_view = 'property/deal_confirm_booking';
			}
			
			/*******correct upto***************/
			
			
			$title 				= $this->data['details']['master_details']['meta_title'];
			$desc 				= $this->data['details']['master_details']['meta_description'];
			$key 				= $this->data['details']['master_details']['meta_keyword'];
			$featured_image='';
			if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){
							$featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);
				 }
			$share = array(
						'og'=>array(
									'site_name'=>$title,
									'description'=>$desc,
									'image'=>$featured_image,
									'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
									),
						'twitter'=>array(
								  'image'=>$featured_image,
								  'title'=>$title,
								  'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
						)
				   );

			
			
			
				
				
			if($this->input->post('action') == 'Process'){
				$this->load->library('securepay');
			
				$wallet_balance    		= $this->input->post('wallet_balance');
				$property_id       		= $this->input->post('property_id');
				$room_type_id			= $this->input->post('room_id');
				$property_price    		= $this->input->post('property_price');
				$payble_amount  		= $this->input->post('payble_amount');
				$downpayment     		= $this->input->post('downpayment');
				$usd_balance			= $this->input->post('usd_balance');
				$discount_type			= $this->input->post('discount_type');
				$discount_amount		= $this->input->post('discount_amount');
				$booking_type 			= $this->input->post('booking_type'); 
				$first_name        		= trim($this->input->post('first_name'));
				$last_name         		= trim($this->input->post('last_name'));
				$email             		= trim($this->input->post('email1'));
				$nationality       		= trim(addslashes($this->input->post('nationality')));
				$arrival_time      		= trim(addslashes($this->input->post('arrival_time')));
				$arrival_time1     		= trim(addslashes($this->input->post('arrival_time1')));
				$text_sms          		= trim(addslashes($this->input->post('text_sms')));
				$gender            		= trim(addslashes($this->input->post('gender')));
				$prefix_phone      		= trim(addslashes($this->input->post('prefix_phone')));
				$suffix_phone      		= trim(addslashes($this->input->post('suffix_phone')));
				$new_user_id       		= trim(addslashes($this->input->post('new_user_id')));
				$cc_number         		= $this->input->post('cc_number');
				$exp_date          		= $this->input->post('exp_date');
				$cvv               		= $this->input->post('cvv');
				$check_in 				= $this->input->post('check_in');
				$check_out 				= $this->input->post('check_out');
				$chkin 					= explode('/',$check_in);
				$chkout 				= explode('/',$check_out);
				$dataArr['nationality'] = $nationality;
				$dataArr['gender']      = $gender;
			
			
			
				// $ckdate = $this->input->post('check_in');
				// $ckoutdate = $this->input->post('check_out');
				// $checkIn = strtotime(str_replace('/', '-', $ckdate));
				// $checkOut = strtotime(str_replace('/', '-', $ckoutdate));
				// $i = 0;
				// //$j = 0;
				// for ( $i = $checkIn; $i < $checkOut; $i = $i + 86400 ) {
				//			$date = date( 'Y-m-d', $i );
				//			
				//			$room_type_id   = $this->input->post('room_type_id');
				//			for($j = 0; $j<count($room_type_id); $j++){
				//					  $roomTypeId = $room_type_id[$j];
				//					  $sql = "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$roomTypeId."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$date."'";
				//					  $res = $this->db->query($sql);
				//					  if($res->num_rows()>0){
				//								 $row = $res->row();
				//								 $noOfGuest   = $this->input->post('no_person');
				//								 $updatedGuest = ($row->available - $noOfGuest);
				//								 $idArr              = array('availibility_id' => $row->availibility_id);
				//								 $updateArr          = array('available' => $updatedGuest);
				//								 $id = $this->model_basic->updateIntoTable(AVAILABILITY,$idArr,$updateArr);
				//					  }
				//			}
				// }
				// exit;
			
			
			
				if($new_user_id != ''){
					$user 					= $this->model_basic->getValues_conditions(USER,'','',"id=".$new_user_id);
					$dataArr['first_name']  = $user[0]['firstname'];
					$dataArr['last_name']   = $user[0]['lastname'];
					$dataArr['email']       = $user[0]['email'];
					
					if($arrival_time1 != ''){
						$dataArr['arrival_time'] = $arrival_time1;
					}
					else{
						$dataArr['arrival_time'] = '10 : 10 : AM';
					}
				
					if($nationality == '' && $gender == ''){
						$dataArr['nationality']  = $user[0]['nationality'];
						$dataArr['gender']       = $user[0]['gender'];
					}
					else{
						$this->model_basic->updateIntoTable(USER,array('id'=>$new_user_id),array('nationality'=>$nationality,'gender'=>$gender));
					}
				}
				else{
					$dataArr['first_name']    = addslashes($first_name);
					$dataArr['last_name']     = addslashes($last_name);
					$dataArr['email']         = addslashes($email);
					$dataArr['arrival_time']  = $arrival_time;
				}
			
				$dataArr['text_sms']            = $text_sms;
				$dataArr['prefix_phone']        = $prefix_phone;
				$dataArr['suffix_phone']        = $suffix_phone;
				$phone 			    			= $dataArr['prefix_phone'].$dataArr['suffix_phone'] ;
				$payment_status                 = 'Pending';
				$dataArr['user_id']             = $new_user_id;
				$dataArr['agent_roomtype_ID']   = $room_type_id;
				$dataArr['property_id']         = $property_id;
				$dataArr['property_price']      = $property_price;           
				$dataArr['bookingType']	    	= 'normal';
				$dataArr['booking_from']	    = 'website';
				$dataArr['payble_amount']       = $payble_amount;
				$dataArr['downpayment_percent'] = $downpayment;
				$dataArr['usd_balance']         = $usd_balance;
				$dataArr['currency_symbol']     = $this->nsession->userdata('currencySymbol');
				$dataArr['currency_rate']       = $this->nsession->userdata('currencyRate');
				$dataArr['currency_name']       = $this->nsession->userdata('currencyCode');
				$dataArr['discount_type']       = $discount_type;
				$dataArr['discount_amount']     = $discount_amount;
				$dataArr['booking_type'] 	   	= $booking_type;
				$dataArr['added_date']          = date('Y-m-d H:i:s');
				$dataArr['check_in']            = str_replace('/', '-', $check_in);
				$dataArr['check_out']           = str_replace('/', '-', $check_out);
			
				//if(is_array($chkin) && is_array($chkout) && count($chkin)>1 && count($chkout)>1){
				//$dataArr['check_in']  = $chkin[2]."-".$chkin[1]."-".$chkin[0];
				//$dataArr['check_out'] = $chkout[2]."-".$chkout[1]."-".$chkout[0];
				//}
			
				//pr($dataArr);
			
			
				/*******correct upto***************/
				
				$balanceAmount = round($property_price/$this->nsession->userdata('currencyRate')) - $payble_amount;
				
				if($wallet_balance > $payble_amount || $wallet_balance == $payble_amount){
					$dataArr['note']		    = "wallet amount:".$wallet_balance.",pay amount:0";
					$dataArr['payment_status']	= "Success";
					$insrtArr 					= array(
														'user_id' 		=> $this->nsession->userdata('USER_ID'),
														'amount'  		=> $payble_amount,
														'debit_credit'	=> 'dr',
														'property_id'	=> $property_id
													);
				
					//$payble_amount			= 0;
				//echo "bbb"; pr($dataArr);
					$ins_id =  $this->model_basic->insertIntoTable('hw_payment_info_temp',$dataArr);
					
					if(!empty($ins_id) && $ins_id >0){
						$this->nsession->set_userdata('payment_id',$ins_id);
						$this->model_basic->updateIntoTable('hw_payment_info_temp',array('paymeny_id'=>$ins_id),array('reference_id'=>getInsID($ins_id)));
					
						$room_type_id   		= $this->input->post('room_type_id');
						$no_of_person   		= $this->input->post('no_person');
						$no_of_room     		= $this->input->post('no_room');
						$total_price   			= $this->input->post('tot_room_price');
						$room_price    			= $this->input->post('room_price');
						$total_price_per_type  	= $this->input->post('total_price_per_type');
					
						//$daylen = 60*60*24;
						//$total_days  = (strtotime($dataArr['check_out']) - strtotime($dataArr['check_in']))/$daylen;
					
						if(isset($room_type_id)){
							$message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%"><tr><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td><td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td></tr>';
						
						
							//Avalibility table update
						
							$ckdate 	= $this->input->post('check_in');
							$ckoutdate 	= $this->input->post('check_out');
							$checkIn 	= strtotime(str_replace('/', '-', $ckdate));
							$checkOut 	= strtotime(str_replace('/', '-', $ckoutdate));
						
							$i = 0;
						
							for ( $i = $checkIn; $i < $checkOut; $i = $i + 86400 ) {
								$date 			= date( 'Y-m-d', $i );
								$room_type_id   = $this->input->post('room_type_id');
								
								for($j = 0; $j<count($room_type_id); $j++){
									$roomTypeId = $room_type_id[$j];
									$sql = "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$roomTypeId."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$date."'";
									$res = $this->db->query($sql);
									
									if($res->num_rows()>0){
										$row 			= $res->row();
										$noOfGuest   	= $this->input->post('no_person');
										$updatedGuest 	= $row->available - $noOfGuest[$j];
										$idArr          = array('availibility_id' => $row->availibility_id);
										$updateArr      = array('available' => $updatedGuest);
										$id 			= $this->model_basic->updateIntoTable(AVAILABILITY,$idArr,$updateArr);
									}
								}
							}
						
							//end of Avalibility table update
					
							$total = 0;
							$insertArr['payment_id'] = $ins_id;
							
							for($i=0;$i<count($room_type_id);$i++){
								$insertArr['room_type']     = $room_type_id[$i];
								$insertArr['no_of_room']    = $no_of_room[$i];
								$insertArr['no_of_person']  = $no_of_person[$i];
								//$insertArr['total_price'] = round($total_price_per_type[$i]/ $currencyRate,2);
								$insertArr['total_price']   = $total_price[$i];
								$insertArr['room_price']    = $room_price[$i];
								$insertArr['property_id']	= $property_id;
								$roomtypename   			= $this->model_basic->getValue_condition('hw_agent_roomtype','type_name','','id='.$insertArr['room_type'].'');
								$message .= "<tr>
												<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".ucwords($roomtypename)."</td>
												<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_room']."</td>
												
												<td style='border-bottom :1px solid #ccc;padding: 5px 10px;'> ".$this->nsession->userdata('currencySymbol').$insertArr['total_price']."</td>
											</tr>";
								
								$this->model_basic->insertIntoTable('hw_booking_details_temp',$insertArr);
							}
					
							$message .= '<tr><td colspan="2" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td><td style="padding: 5px 10px;"><b> <span>'.$this->nsession->userdata('currencySymbol').round($property_price,2).'</span></b></td></tr></table>';
						}
				
						$payment = $this->model_basic->getValues_conditions('hw_payment_info_temp','','','paymeny_id='.$ins_id);	  
				
						if(count($payment)>0){
							//pr($payment[0]);		
									
							$wallet 						= $this->model_basic->insertIntoTable(WALLET,$insrtArr);
							$payment[0]['TransactionId']   	= 'WL'.$payment[0]['reference_id'];
							$payment_id 					= $this->model_basic->insertIntoTable('hw_payment_info',$payment[0]);
							$bookingIds 					= $this->model_basic->getValues_conditions('hw_booking_details_temp','','','payment_id='.$ins_id);
						
							foreach($bookingIds as $ids){
								$details_id = $this->model_basic->insertIntoTable('hw_booking_deatils',$ids);
							};
							
							if(isset($payment_id) && isset($details_id)){
								$send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
								$template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
							
								$mail_config['to']          = stripslashes(trim($send_mail));
								$mail_config['to']          = 'maantu.das@webskitters.com';
								$mail_config['from']        = $template[0]['responce_email'];
								$mail_config['from_name']   = 'Hostelmofo Team';
								$mail_config['subject']     = $template[0]['email_subject'];
								$mail_config['message']     = $template[0]['email_content'];
								$property_name              = $this->model_basic->getValue_condition('hw_property_master','property_name','','property_master_id='.$property_id.'');
								$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['email'],($phone != '' ? $phone : 'N/A'),$dataArr['payment_status'],stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config['message']));
							
								$mailsend_admin             = send_html_email($mail_config);
							
								$usertemplate               	= $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
								$mail_config_user['to']     	= $dataArr['email'];
								$mail_config_user['to']         = 'maantu.das@webskitters.com';
								$mail_config_user['from']       = $usertemplate[0]['responce_email'];
								$mail_config_user['from_name']  = 'Hostelmofo Team';
								$mail_config_user['subject']    = $usertemplate[0]['email_subject'];
								$mail_config_user['message']    = $usertemplate[0]['email_content'];
								$mail_config_user['message']    = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['payment_status'],stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config_user['message']));
							
								$mailsend_user               	= send_html_email($mail_config_user);
							
								if($mailsend_admin && $mailsend_user){
									$succmsg =  "Transaction has been successfully completed\n";
									$this->nsession->set_userdata('succmsg',$succmsg);
									redirect(FRONTEND_URL.'property/success_booking/'.$property_slug);
								}
							}
						}
					}
				}
				else{
					
					$dataArr['card_expiry_date']    = '00-00';
					if($exp_date != '')
					{
						$expDate						= explode('/',$exp_date);					
						$dataArr['card_expiry_date']    = $expDate[1].'-'.$expDate[0].'-00';			
					}
					$dataArr['payment_status']      = 'Pending';
					
					$dataArr['card_number']         = $cc_number;
					$dataArr['card_holder_name']	= $this->input->post('cc_holder_name');
					$dataArr['card_type']     		= $this->input->post('card_type');
					$dataArr['note']				= "wallet amount:".$wallet_balance.",pay amount:".($payble_amount-$wallet_balance);
				
					if( $wallet_balance < $payble_amount) {
						$insrtArr = array(	
										'user_id' 		=> $this->nsession->userdata('USER_ID'),
										'amount'		=> $wallet_balance,
										'debit_credit' 	=> 'dr',
										'property_id'	=> $property_id
									);
					}
					$payble_amount	= $payble_amount-$wallet_balance;
				
					if($payble_amount>0){
						$ins_id =  $this->model_basic->insertIntoTable('hw_payment_info_temp',$dataArr);
						if(!empty($ins_id) && $ins_id >0){
							$this->nsession->set_userdata('payment_id',$ins_id);
							$this->model_basic->updateIntoTable('hw_payment_info_temp',array('paymeny_id'=>$ins_id),array('reference_id'=>getInsID($ins_id)));
						
							$room_type_id   		= $this->input->post('room_type_id');               
							$no_of_person   		= $this->input->post('no_person');
							$no_of_room     		= $this->input->post('no_room');
							$total_price    		= $this->input->post('tot_room_price');
							$room_price    			= $this->input->post('room_price');
							$total_price_per_type  	= $this->input->post('total_price_per_type');
						
							$sp = new SecurePay('ABC0001','abc123', TRUE);
							//$payble_amount = 12.20;
							
							$sp->TestMode(TRUE);
							$sp->TestConnection();
							//echo "aaa";
							//die();
							
							$sp->Cc 			= $cc_number;
							$sp->ExpiryDate 	= $exp_date;
							$sp->ChargeAmount 	= $payble_amount;
							$sp->ChargeCurrency = 'USD';
							$sp->Cvv 			= $cvv;
							$sp->OrderId 		= $ins_id;//'ORD34235';
							
							//pr($sp);
							  //pr($sp->Valid());
							if (!$sp->ValidCc()) {
								$errmsg =  "Credit Card Number is invalid\n";
							}
							elseif (!$sp->ValidExpiryDate()) {
								$errmsg =  "Expiry Date is invalid\n";
							}
							elseif (!$sp->ValidCvv()) {
								$errmsg =  "CVV is invalid\n";
							}
							elseif (!$sp->ValidChargeAmount()) {
								$errmsg =  "Charge Amount is invalid\n";
							}
							elseif (!$sp->ValidChargeCurrency()) {
								$errmsg =  "Charge Currency is invalid\n";
							}
							elseif (!$sp->ValidOrderId()) {
								$errmsg =  "Order ID is invalid\n";
							}
							else if ($sp->Valid()) { // Is the above data valid?
								$response = $sp->Process();
								//if($response['TransactionId'] != '' && isset($response['TransactionId'])){
								//$update_arr['TransactionId']   = $response['TransactionId'];
								//}
								if ($response['result'] == SECUREPAY_STATUS_APPROVED){
									$dataArr['TransactionId']   	=  $response['TransactionId'];
									//$dataArr['TransactionId']   	= '1234567890';
									$succmsg =  "Transaction has been successfully completed\n";
									$this->nsession->set_userdata('succmsg',$succmsg);
									$payment_status                 = 'Success';
									$dataArr['payment_status']   	= 'Success';
									//$idArr['paymeny_id']          = $ins_id;
								
									if(isset($room_type_id)){
									
										//Avalibility table update
									
										$ckdate 	= $this->input->post('check_in');
										$ckoutdate 	= $this->input->post('check_out');
										$checkIn 	= strtotime(str_replace('/', '-', $ckdate));
										$checkOut 	= strtotime(str_replace('/', '-', $ckoutdate));
										
										$i = 0;
										for ( $i = $checkIn; $i < $checkOut; $i = $i + 86400 ) {
											$date = date( 'Y-m-d', $i );
											$room_type_id   = $this->input->post('room_type_id');
											for($j = 0; $j<count($room_type_id); $j++){
												$roomTypeId = $room_type_id[$j];
												$sql = "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$roomTypeId."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$date."'";
												$res = $this->db->query($sql);
												if($res->num_rows()>0){
													$row = $res->row();
													$noOfGuest   	= $this->input->post('no_person');
													$updatedGuest 	= $row->available - $noOfGuest[$j];
													$idArr          = array('availibility_id' => $row->availibility_id);
													$updateArr      = array('available' => $updatedGuest);
													$id = $this->model_basic->updateIntoTable(AVAILABILITY,$idArr,$updateArr);
												}
											}
										}
										
										//end of Avalibility table update		  

										$message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%"><tr><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td><td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td></tr>';  
										$total = 0;
										
										for($i=0;$i<count($room_type_id);$i++){
											$insertArr['payment_id']    = $ins_id;
											$insertArr['room_type']     = $room_type_id[$i];
											$insertArr['no_of_room']    = $no_of_room[$i];
											$insertArr['no_of_person']  = $no_of_person[$i];
											//$insertArr['total_price']   = round($total_price_per_type[$i]/ $currencyRate,2);
											$insertArr['total_price']   = $total_price[$i];
											$insertArr['room_price']    = $room_price[$i];
											$insertArr['property_id']	= $property_id;
											$total                      = $property_price + $total;
											$roomtypename   			= $this->model_basic->getValue_condition('hw_agent_roomtype','type_name','','id='.$insertArr['room_type'].'');
											$message .= "<tr>
															<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".ucwords($roomtypename)."</td>
															<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_room']."</td>
															
															<td style='border-bottom :1px solid #ccc;padding: 5px 10px;'> ".$this->nsession->userdata('currencySymbol').$insertArr['total_price']."</td>
														</tr>";
											$this->model_basic->insertIntoTable('hw_booking_details_temp',$insertArr);
										}
									
										$message .= '<tr><td colspan="2" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td><td style="padding: 5px 10px;"><b> <span>'.$this->nsession->userdata('currencySymbol').round($property_price).'</span></b></td></tr></table>';
									}
								
									$payment = $this->model_basic->getValues_conditions('hw_payment_info_temp','','','paymeny_id='.$ins_id);
									
									if(count($payment)>0){
										$wallet = $this->model_basic->insertIntoTable(WALLET,$insrtArr);
										//$payment[0]['TransactionId'] = '12345678';
										$payment[0]['TransactionId'] = $dataArr['TransactionId'];
										$payment[0]['payment_status']   = 'Success';
										$bookingIds = $this->model_basic->getValues_conditions('hw_booking_details_temp','','','payment_id='.$ins_id);
										$payment_id = $this->model_basic->insertIntoTable('hw_payment_info',$payment[0]);
										
										foreach($bookingIds as $ids){
											$bookingId = $this->model_basic->insertIntoTable('hw_booking_deatils',$ids);
										};
										//$dataArr['payment_status']   = 'Success';
										//$dataArr['TransactionId']   = $response['TransactionId'];
										//$dataArr['TransactionId']   = '1234567890';
								
										if(isset($bookingId) && isset($payment_id)){
											$send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
											$template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
										
											$mail_config['to']          = stripslashes(trim($send_mail));
											//$mail_config['to']        = 'maantu.das@webskitters.com';
											$mail_config['from']        = $template[0]['responce_email'];
											$mail_config['from_name']   = 'Hostelmofo Team';
											$mail_config['subject']     = $template[0]['email_subject'];
											$mail_config['message']     = $template[0]['email_content'];
											$property_name              = $this->model_basic->getValue_condition('hw_property_master','property_name','','property_master_id='.$property_id.'');
											$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['email'],($phone != '' ? $phone : 'N/A'),$payment_status,stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config['message']));
										
											$mailsend_admin             = send_html_email($mail_config);
										
											$usertemplate               	= $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
											$mail_config_user['to']         = $dataArr['email'];
											//$mail_config['to']          	= 'maantu.das@webskitters.com';
											$mail_config_user['from']       = $usertemplate[0]['responce_email'];
											$mail_config_user['from_name']  = 'Hostelmofo Team';
											$mail_config_user['subject']    = $usertemplate[0]['email_subject'];
											$mail_config_user['message']    = $usertemplate[0]['email_content'];
											$mail_config_user['message']    = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$payment_status,stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config_user['message']));
										
											$mailsend_user               	= send_html_email($mail_config_user);
										
											if($mailsend_admin && $mailsend_user){
												$succmsg =  "Transaction has been successfully completed\n";
												$this->nsession->set_userdata('succmsg',$succmsg);
												redirect(FRONTEND_URL.'property/success_booking/'.$property_slug);
											}
											else{
											}
											//$errmsg =  "Transaction failed :".$sp->Error."\n";
											//$this->nsession->set_userdata('errmsg',$errmsg);	 
										}
									}
								}
								else{
									$errmsg =  "Transaction failed :".$sp->Error."\n";
									$this->nsession->set_userdata('errmsg',$errmsg);
									$update_arr['transaction_details'] = addslashes($sp->Error);
									$update_arr['payment_status'] = 'failed';
									$update_arr['Booking_status'] = 'Cancelled';
									$idArr['paymeny_id'] = $ins_id;
									$this->model_basic->updateIntoTable('hw_payment_info_temp', $idArr, $update_arr);
								}
							}
							else{
								$errmsg =  "Error occured. Please try again later\n";
							}
							$this->nsession->set_userdata('errmsg',$errmsg);
						}
					}
				}
			}
					 
			$this->data['check_in'] = $this->input->post('check_in');
			$this->data['check_out'] = $this->input->post('check_out');
			$this->data['guest'] = $this->input->post('no_guest');
			$group_type = '';
			$age_ranges = '';
			$breadcrumb_arr = array(); 
			$breadcrumb_arr = array( array('text'=>'Australia','link'=>'javascript:void(0)') );
				 
			$breadcrumb_arr[]	= array('text'=>$location,'link'=>'');
			$breadcrumb_arr[] = array('text'=>$city_slug,'link'=>''); 
			 
//pr($this->data);
			$this->data['succmsg'] 	= $this->nsession->userdata('succmsg');
			$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
			
			$this->nsession->set_userdata('succmsg','');
			$this->nsession->set_userdata('errmsg','');
			
			$this->templatelayout->make_seo($title,$desc,$key,$share);
			$this->templatelayout->get_header();
			//$this->templatelayout->get_banner('','','hostel');
			$this->templatelayout->get_banner_inner('','Confirm Booking');
			//$this->templatelayout->get_banner($city_slug,$location,$property_type_slug,$property_type,$property_slug,$this->data['check_in'],$this->data['check_out'],$this->data['guest'],$group_type,$age_ranges,$breadcrumb_arr);
			$this->templatelayout->get_breadcrumb($breadcrumb_arr);
			 
			$this->templatelayout->get_breadcrumb();
			$this->templatelayout->get_footer();
			
			$this->elements['middle']	=	$middle_view;			
			$this->elements_data['middle'] 	= 	$this->data;
			
			$this->layout->setLayout('details_layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		  }
		  
		  
		  
		  
		  
        
   
   public function success_booking(){
    
		  $property_slug = $this->uri->segment(3,0);
		  $this->data = "";
		  $this->model_basic->deleteData('hw_booking_temp','1');
		  $this->data['details']= $this->model_property->getPropertyDetails($property_slug);
		  
		  $payment_id = $this->nsession->userdata('payment_id');
		  //echo $payment_id;
		  
		  $this->data['payment_info'] = $this->model_basic->getFromWhereSelect(PAYMENT_INFO,'',"paymeny_id = ".$payment_id);
		  //pr($this->data['payment_info'],0);
		  
		  $this->data['booking_details'] = $this->model_basic->getFromWhereSelect(BOOKING_DETAILS,'',"payment_id = ".$payment_id);
		  
		  
		  $title = $this->data['details']['master_details']['meta_title'];
		  $desc = $this->data['details']['master_details']['meta_description'];
		  $key = $this->data['details']['master_details']['meta_keyword'];
		  $featured_image='';if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){ $featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);}
		  $share = array(
                            'og'=>array(
                                        'site_name'=>$title,
                                        'description'=>$desc,
                                        'image'=>$featured_image,
                                        'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                                        ),
                            'twitter'=>array(
                                      'image'=>$featured_image,
                                      'title'=>$title,
                                      'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                            )
                       );
		  //pr($this->data);
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');
		  
		  $this->nsession->set_userdata('succmsg','');
		  $this->nsession->set_userdata('errmsg','');
		  
		  $this->templatelayout->make_seo($title,$desc,$key,$share);
		  $this->templatelayout->get_header();
		  //$this->templatelayout->get_banner('','','hostel');
		  $this->templatelayout->get_banner_inner('','Order Summery');
		  $this->templatelayout->get_breadcrumb();
		  $this->templatelayout->get_footer();
		  
		  
		  if($this->data['payment_info'][0]['bookingType'] == 'deal'){
				    $this->elements['middle']	=	'property/deal_success_booking';
		  }else{
				    $this->elements['middle']	=	'property/success_booking';
		  }
		  $this->elements_data['middle'] 	= 	$this->data;
			      
		  $this->layout->setLayout('details_layout');
		  $this->layout->multiple_view($this->elements,$this->elements_data);
	     }
    
    
    
    public function payment(){
        
        $property_id        = $this->input->post('property_id');
        $property_price     = $this->input->post('property_price');
        $first_name         = $this->input->post('first_name');
        $last_name          = $this->input->post('last_name');
        $email              = $this->input->post('email1');
        $phone              = $this->input->post('phone');
        $cc_number          = $this->input->post('cc_number');
        $exp_date           = $this->input->post('exp_date');
        $cvv                = $this->input->post('cvv');
	$check_in 	    =  str_replace('/','-',$this->input->post('check_in'));
	$check_out 	    =  str_replace('/','-',$this->input->post('check_out'));
        //echo $check_in."--".$check_out; die();
        //echo $first_name;
       //echo $property_id.">>".$cc_number.">>".$exp_date.">>".$property_price;
       
       $dataArr['property_id'] = $property_id;
       $dataArr['property_price'] = $property_price;
       $dataArr['first_name'] = addslashes($first_name);
       $dataArr['last_name'] = addslashes($last_name);
       $dataArr['email'] = addslashes($email);
       $dataArr['phone'] = addslashes($phone);
       $dataArr['payment_status'] = 'Pending';
       $dataArr['added_date'] = date('Y-m-d H:i:s');     
       $dataArr['booking_from'] = 'website';
       $dataArr['check_in'] = $check_in;
       $dataArr['check_out'] = $check_out;
       
        $ins_id =  $this->model_basic->insertIntoTable('hw_payment_info',$dataArr);
        
	 switch (strlen($ins_id)) {
		case 1:
		    $rand_id = rand(10000000,99999999).$ins_id;
		    break;
		case 2:
		    $rand_id = rand(1000000,9999999).$ins_id;
		    break;
		case 3:
		    $rand_id = rand(100000,999999).$ins_id;
		    break;
		case 4:
		    $rand_id = rand(10000,99999).$ins_id;
		    break;
		case 5:
		    $rand_id = rand(1000,9999).$ins_id;
		    break;
		case 6:
		    $rand_id = rand(100,999).$ins_id;
		    break;
		case 7:
		    $rand_id = rand(10,99).$ins_id;
		    break;
		case 8:
		    $rand_id = rand(0,9).$ins_id;
		    break;
		default:
		    $rand_id = $ins_id;
	    }
	    
        $this->model_basic->updateIntoTable('hw_payment_info', array('paymeny_id'=>$ins_id), array('reference_id'=>$rand_id));
	   
        $this->load->library('securepay');
        $sp = new SecurePay('ABC0001','abc123');
        $sp->TestMode();
        $sp->TestConnection();
        
        //print_r($sp->ResponseXml);
        
        $sp->Cc = $cc_number;
        $sp->ExpiryDate = $exp_date;
        $sp->ChargeAmount = $property_price;
        $sp->ChargeCurrency = 'USD';
        $sp->Cvv = $cvv;
        $sp->OrderId = $ins_id;//'ORD34234';
		//pr($sp);
		
        if ($sp->Valid()) { // Is the above data valid?
            $response = $sp->Process();
            //echo "<pre>";
            //print_r($response);
            //echo $sp->Error;
	    if($response['TransactionId'] != '' && isset($response['TransactionId'])){
		$update_arr['TransactionId']   = $response['TransactionId'];
	    }
            if ($response['result'] == SECUREPAY_STATUS_APPROVED) {
                echo "Your payment has been successfully received\n";
                $update_arr['payment_status'] = 'Success';
                $idArr['paymeny_id'] = $ins_id;
            } else {
               
                echo "Transaction failed :".$sp->Error."\n";
                
               $update_arr['transaction_details'] = addslashes($sp->Error);;
               $idArr['paymeny_id'] = $ins_id;
                //echo "XML Dump: " . print_r($sp->ResponseXml,1) . "\n";
            }
            $this->model_basic->updateIntoTable('hw_payment_info', $idArr, $update_arr);
        }
        
    }

    public function preview(){
        
        create_proper_url();
        
          if($this->uri->total_segments()>5){
            redirect('page-not-found/');
          }
        
        $property_slug = $this->uri->segment(5,0);

        $this->data = "";
        $this->data['details']= $this->model_property->getPropertyDetails($property_slug,'preview');
        //pr($this->data['details']);
        if(count($this->data['details'])==0){
           redirect('page-not-found/');
        }
        
        $this->data['property_slug'] = $property_slug;
        //pr($_SERVER);
        $property_id = $this->data['details']['master_details']['property_master_id'];
        $property_type = $this->data['details']['master_details']['property_type_id'];
        $property_type_slug = $this->data['details']['master_details']['property_type_slug'];
        $city_slug = $this->data['details']['master_details']['city_slug'];
        $location = $this->data['details']['master_details']['city_name'].', '.$this->data['details']['master_details']['province_name'];
        
        $condition = " property_id = '".$property_id."' AND review_status = 'Active'";
        $this->data['review_list'] = $this->model_basic->getValues_conditions(REVIEW_MASTER,'*','',$condition,'review_id','DESC');
        
        //pr($this->data['review_list']);
        
       
        $this->data['avg_review'] = $this->model_review->getAvarageRating($property_id);
        //pr($this->data['avg_review']);
        
        $this->data['similar_property'] = $this->model_property->getSimilarProperty($property_id);
        
        $title = $this->data['details']['master_details']['meta_title'];
        $desc = $this->data['details']['master_details']['meta_description'];
        $key = $this->data['details']['master_details']['meta_keyword'];
        $featured_image='';if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){ $featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);}
        $share = array(
                            'og'=>array(
                                        'site_name'=>$title,
                                        'description'=>$desc,
                                        'image'=>$featured_image,
                                        'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                                        ),
                            'twitter'=>array(
                                      'image'=>$featured_image,
                                      'title'=>$title,
                                      'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                            )
                       );
        $this->templatelayout->make_seo($title,$desc,$key,$share);
        $this->templatelayout->get_header();
        $this->templatelayout->get_banner($city_slug,$location,$property_type_slug,$property_type);
        $this->templatelayout->get_breadcrumb();
        $this->templatelayout->get_footer();
        
        $this->elements['middle']	=	'property/preview_details';			
        $this->elements_data['middle'] 	= 	$this->data;
                    
        $this->layout->setLayout('details_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
  
    
    public function sendEnqueryMessage(){
       extract($_POST);
       //pr($_POST);
       if($check_in_time!=''){
            $check_in_time_arr = explode('/',$check_in_time);
            $check_in_time = $check_in_time_arr[2].'-'.$check_in_time_arr[1].'-'.$check_in_time_arr[0];
       }
       if($check_out_time!=''){
            $check_out_time_arr = explode('/',$check_out_time);
            $check_out_time = $check_out_time_arr[2].'-'.$check_out_time_arr[1].'-'.$check_out_time_arr[0];
       }
       
       $property_details = $this->model_property->getPropertyDetails($property_slug);
       //pr($property_details);
       $send_mail = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
       $mail_config['to'] = $send_mail;
       $mail_config['from'] = $email;
       $mail_config['from_name'] = $first_name.' '.$last_name;
       $mail_config['subject'] = 'New Enquiry Post';
       
       $message  = '';
       $message .= '<p>A new enquery is posted.Find the details below</p>';
       $message .= '<p><b style="solor:red">'.$property_name.'</b></p>';
       $message .= '<hr/>';
       $message .= '<p><strong>Date : <strong>&nbsp;&nbsp;'.date('d/m/Y').'</p>';
       $message .= '<p><strong>Time : <strong>&nbsp;&nbsp;'.date('h:i A').'</p>';
       $message .= '<p><strong>From : <strong>&nbsp;&nbsp;Desktop</p>';
       $message .= '<p><strong>Source : <strong>&nbsp;&nbsp;Details page</p>';
       $message .= '<hr/>';
       $message .= '<p><strong>Name: <strong>&nbsp;&nbsp;'.$mail_config['from_name'].'</p>';
       $message .= '<p><strong>Email: <strong>&nbsp;&nbsp;'.$mail_config['from'].'</p>';
       $message .= '<p><strong>Phone No: <strong>&nbsp;&nbsp;'.$phone.'</p>';
       $message .= '<p><strong>Country Name: <strong>&nbsp;&nbsp;'.$this->nsession->userdata('userCountry').'</p>';
       $message .= '<p><strong>City Name: <strong>&nbsp;&nbsp;'.$this->nsession->userdata('userCity').'</p>';
       $message .= '<p><strong>Property Name: <strong>&nbsp;&nbsp;<a href="'.FRONTEND_URL.'property/'.$property_details['master_details']['property_type_slug'].'/'.$property_details['master_details']['province_slug'].'/'.$property_details['master_details']['city_seo_slug'].'/'.$property_slug.'/">'.$property_name.'</a></p>';
       $message .= '<p><strong>Property Location: <strong>&nbsp;&nbsp;'.$property_city.', '.$property_province.'</p>';
       $message .= '<p><strong>Checkin Date: <strong>&nbsp;&nbsp;'.$check_in_time.'</p>';
       $message .= '<p><strong>Checkout Date: <strong>&nbsp;&nbsp;'.$check_out_time.'</p>';
       $message .= '<hr/>';
       $message .= '<p><strong>Note: <strong>&nbsp;&nbsp;'.$notes.'</p>';
       $message .= '<hr/>';
       //$message  = $this->load->view('layout/email_template',array('toname'=>'Admin','fromname'=>$mail_config['from_name'],'content'=>$message),true);
       //echo $message;die;
       $mail_config['message'] = $message;
       
       send_html_email($mail_config);
       
       
       $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=1');
       $mail_config['to'] = $email;
       $mail_config['from'] = $template[0]['responce_email'];
       $mail_config['from_name'] = 'Hostel Mofo Team';
       $mail_config['subject'] = $template[0]['email_subject'];
       //$mail_config['message'] =  $template[0]['email_content'];
       $siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,'','','sitesettings_id IN(6,12) ');
       $message  = $this->load->view('email_template/enquiry_template',
                                     array('toname'=>$first_name.' '.$last_name,
                                           'from_email'=>$mail_config['from'],
                                           'fromname'=>'Edwina',
                                           'phone'=>$siteSetting[1]['sitesettings_value'],
                                           'property_img'=>$property_img,
                                           'property_name'=>$property_name,
                                           'property_slug'=>$property_slug,
                                           'property_city'=>$property_city,
                                           'property_province'=>$property_province,
                                           'property_link'  =>FRONTEND_URL.'property/'.$property_details['master_details']['property_type_slug'].'/'.$property_details['master_details']['province_slug'].'/'.$property_details['master_details']['city_seo_slug'].'/'.$property_slug.'/',
                                           'checkin_date' => date('d M y',strtotime($check_in_time)),
                                           'checkout_date' => date('d M y',strtotime($check_out_time)),
                                           'content'=>$notes),true);
       
       $mail_config['message'] = $message;
       $respons = send_html_email($mail_config);
       
       $insert_arr = array(
                           'contact_name'   =>   addslashes($first_name.' '.$last_name),
                           'email_address'  =>   addslashes($email),
                           'property_id'    =>   $property_id,
                           'phone'          =>   addslashes($phone),
                           'check_in_time'  =>   date('Y-m-d',strtotime($check_in_time)),
                           'check_out_time' =>   date('Y-m-d',strtotime($check_out_time)),
                           'notes'          =>   addslashes($notes),
                           'ip_address'     =>   $_SERVER['REMOTE_ADDR'],
                           'location'       =>   $this->nsession->userdata('userCity'),
                           'country'        =>   $this->nsession->userdata('userCountry'),
                           'enquiry_read'   =>   'Unread'
                           );
       
       
       $this->model_basic->insertIntoTable(ENQUIRY_MASTER,$insert_arr);
       
       echo $respons;exit;
    }
    
    
    public function shareWithFriend(){
         extract($_POST);
       //pr($_POST);
       $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=2');
       $mail_config['to'] = $to_email;
       $mail_config['from'] = $template[0]['responce_email'];
       $mail_config['from_name'] = 'Hostel world Team';
       $mail_config['subject'] = $template[0]['email_subject'];
       $mail_config['message'] =  $template[0]['email_content'];
       $mail_config['message'] = str_replace('{{USERNAME}}','Friend' ,$mail_config['message']);
       $mail_config['message'] = str_replace('{{SENDUSER}}',$share_name ,$mail_config['message']);
       $mail_config['message'] = str_replace('{{PROPERTYNAME}}',$property_name ,$mail_config['message']);
       $link = FRONTEND_URL.'property/'.$property_slug;
       $mail_config['message'] = str_replace('{{PROPERTYLINK}}',$link ,$mail_config['message']);
       
       
       $respons = send_html_email($mail_config);
       
       
       $mail_config=array();
       $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=3');
       $mail_config['to'] = $from_email;
       $mail_config['from'] = $template[0]['responce_email'];
       $mail_config['from_name'] = 'Hostel Mofo Team';
       $mail_config['subject'] = $template[0]['email_subject'];
       $mail_config['message'] =  $template[0]['email_content'];
       $mail_config['message'] = str_replace('{USERNAME}',$share_name,$mail_config['message']);
       $respons = send_html_email($mail_config);
       
       echo $respons ;exit;
    }
    



    public function setApprove(){
            //pr($_POST);
            extract($_POST);
            if($approve_captcha_value == 1){
                  $property_details = $this->model_property->getPropertyDetails($property_slug,'preview');
                  //pr($property_details);    
                    // PROPERTY_APPROVAL
                   //pr($property_details);
                   
                   $approval_insert    = array(
                                               'property_id'   => $property_id,
                                               'agent_name'    => addslashes(trim($agent_name)),
                                               'agent_message' => addslashes(trim($agent_message)),
                                               'agent_email'   => addslashes(trim($agent_email))
                                               );
                   
                   if($status=='approve'){
                        
                        $property_link   = FRONTEND_URL.'property/'.$property_details['master_details']['property_type_slug'].'/'.$property_details['master_details']['province_slug'].'/'.$property_details['master_details']['city_seo_slug'].'/'.$property_details['master_details']['property_slug'];
                   
                   
                        $approval_insert['approval_status']    = 'Approved'; 
                        $update_arr=array('status'=>'Active');
                        $respons = 1;
                   }else if($status=='decline'){
                        
                        $property_link   = FRONTEND_URL.'preview-property/'.$property_details['master_details']['property_type_slug'].'/'.$property_details['master_details']['province_slug'].'/'.$property_details['master_details']['city_seo_slug'].'/'.$property_details['master_details']['property_slug'];
                   
                   
                       $approval_insert['approval_status']    = 'Decline';
                       $update_arr=array('status'=>'Inactive');
                       $respons = 0;
                   }
                   
                   $admin_users    = $this->model_basic->getValues_conditions(ADMINUSER,'*','',"status='active'");
                   if(is_array($admin_users) and count($admin_users)>0){

                       foreach($admin_users as $user){
                           $mail_config=array();
                           
                           $mail_config['to']          = $user['email_id'];
                           $mail_config['from']        = $agent_email;
                           $mail_config['from_name']   = $agent_name;
                           $mail_config['subject']     = $approval_insert['approval_status']." property named ".$property_name;
                           $mail_config['message']     = "Hi ".$user['first_name'].' '.$user['last_name'].',<br/>';
                           $mail_config['message']    .= "<p>  "."<a href='".$property_link."'>".$property_name."</a>"." is ".$approval_insert['approval_status']." by ".$agent_name." (".$agent_email.")</p>";
                           
                           $mail_config['message']    .= "<p><strong>The Reason behind ".$approval_insert['approval_status']." is </strong></p>";
                           $mail_config['message']    .= "<p>".nl2br($agent_message)."</p>";
                           //pr($mail_config,0);
                           $respons = send_html_email($mail_config);
                       }
                   }
                   
                   if($status=='approve'){
                        $template                          = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=5');
                        $thanks_mail_config['to']          = $agent_email;
                        $thanks_mail_config['from']        = $template[0]['responce_email'];
                        $thanks_mail_config['from_name']   = "Hostel mofo team";
                        $thanks_mail_config['subject']     = $template[0]['email_subject'];
                        $thanks_mail_config['message']     = $template[0]['email_content'];
                        
                        $thanks_mail_config['message']     = str_replace('{{NAME}}',$agent_name ,$thanks_mail_config['message']);
                        $thanks_mail_config['message']     = str_replace('{{PROPERTY_NAME}}',"<a href='".$property_link."'>".$property_name."</a>" ,$thanks_mail_config['message']);
                        
                        $respons = send_html_email($thanks_mail_config);
                        
                   }else if($status=='decline'){
                    
                        $template                          = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=6');
                        $thanks_mail_config['to']          = $agent_email;
                        $thanks_mail_config['from']        = $template[0]['responce_email'];
                        $thanks_mail_config['from_name']   = "Hostel mofo team";
                        $thanks_mail_config['subject']     = $template[0]['email_subject'];
                        $thanks_mail_config['message']     = $template[0]['email_content'];
                        
                        $thanks_mail_config['message']     = str_replace('{{NAME}}',$agent_name ,$thanks_mail_config['message']);
                        $thanks_mail_config['message']     = str_replace('{{PROPERTY_NAME}}',"<a href='".$property_link."'>".$property_name."</a>" ,$thanks_mail_config['message']);
                        
                        //pr($thanks_mail_config);
                        $respons = send_html_email($thanks_mail_config);
                   }
                   
                  
                   $this->model_basic->insertIntoTable(PROPERTY_APPROVAL,$approval_insert);
                   
                   $idArr              = array('property_slug'=>$property_slug);
                   $this->model_basic->updateIntoTable(PROPERTY_MASTER, $idArr, $update_arr);
                   
                   echo "1";
            
            }else{
                echo "you are robot";
            }
            exit;
    }
    
		  public function create_account(){
				$insArr['firstname'] 		= addslashes($this->input->post('user_first_name'));
				$insArr['lastname'] 			= addslashes($this->input->post('sur_name'));
				$insArr['email'] 				= addslashes($this->input->post('user_email'));
				$insArr['password'] 			= addslashes($this->input->post('password'));
				$insArr['provider'] 			= 'site';
				$insArr['created'] 			= date('Y-m-d H:i:s');
				$ins_id 							=  $this->model_basic->insertIntoTable(USER,$insArr);
				echo $ins_id;
		  }
    
	 
		  public function check_user_exists(){
				$user_email = addslashes($this->input->post('user_email'));
				echo $this->model_basic->isRecordExist(USER,"email = '".$user_email."' AND provider='site'");
		  }
		  
    
		  public function check_coupon(){
				$code = $this->input->post('code');
				$res = $this->model_property->check_coupon($code);
				if(is_array($res)){
					 $type = $res['type'];
					 $amount = $res['amount_percent'];
					 echo $type."|".$amount;
				}
				else{
					 echo "error";
				}
		  }
		  
		  
		  public function get_user_details(){
				$new_user_id 	= $this->input->post('new_user_id');
				$users    = $this->model_basic->getValues_conditions(USER,'*','',"id='".$new_user_id."'");
				echo json_encode($users);
		  }
		  
		  
		  public function getInfoCard(){
				$data['country_code'] 	= $this->input->get_post('country_code');
				$data['phone_number'] 	= $this->input->get_post('phone');
		  
			  $get_data		= $this->model_basic->getValues_conditions(USER_CREDIT_CARD, '*', '', 'country_code = "'.$data['country_code'].'" AND phone_number = "'.$data['phone_number'].'"');
			  //echo $this->db->last_query();
			  //$get_data		= $this->model_api->getCreditCardInfo($data['country_code'], $data['phone_number']);
			  if(is_array($get_data) && count($get_data) > 0){
					$credit_card_info	= $get_data;
					$status		= 1;
			  }
			  else{
					$credit_card_info	= array();
					$status		= 0;
			  }
		
			  $message	= array('result' => $credit_card_info, 'status' => $status, 'message' => 'Data fetched successfully!');
		  
				echo json_encode($message);
		  }


}
