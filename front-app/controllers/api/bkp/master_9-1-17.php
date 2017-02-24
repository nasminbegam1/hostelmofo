<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Master extends REST_Controller{
    function __construct(){
        parent::__construct();       
        $this->load->model('model_basic');
		  $this->load->model('model_search');
		  $this->load->model('model_property');
		  $this->load->model('model_review');
		  $this->load->model('model_api');
		  $this->load->model('model_booking');
		  $this->load->model('model_feedback');
    }
    
    public function setcurrencyinfo(){
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
    
	$previousCurrency = $this->nsession->userdata('previousCurrency');
	if( !isset($previousCurrency) || $previousCurrency == '' ){			
		$this->nsession->set_userdata('previousCurrency',$currencyCode);
	}
	
	$this->nsession->set_userdata('currencySymbol',$currencySymbol);
	$this->nsession->set_userdata('countryCode',$countryCode);
	$this->nsession->set_userdata('currencyCode',$currencyCode);
	$this->nsession->set_userdata('currencyRate',$currencyRate);
	$this->nsession->set_userdata('currency_name',$currency_name);
    }
    
    public function country_get(){
	$countryRecord			= $this->model_basic->getValues_conditions('hw_countries', array('*'), '', 'country_status = "active"');
	if($countryRecord){		
	    $message = array('result' => $countryRecord,'message' => 'Record fetched successfully!');
	}else{
	    $message = array('message' => 'No data found!');
	}
	$this->response($message, 200);
    }
    
    public function citylist_get(){
	$term	= $this->uri->segment(4, 0);
	$str = "SELECT C.*, P.province_name, C.city_slug FROM hw_city_master AS C JOIN hw_province_master AS P ON C.province_id= P.province_id WHERE C.status='Active' AND  P.status='Active' AND C.city_name LIKE '".$term."%'";
	$query = $this->db->query($str);
	$result=array();
	if($query->num_rows()>0){
	     foreach($query->result_array() as $index=>$data){
		  $d =  array(
			      'label'		=> $data['city_name'].', '.$data['province_name'],
			      'value'		=> $data['city_name'].', '.$data['province_name'],
			      'city_slug'	=> $data['city_slug']
			      );
		  $result[] = $d;
	     }
	}
	
	$str = "SELECT C.*, P.province_name, C.city_slug,PM.property_name,PM.property_slug FROM
	hw_property_details AS PD INNER JOIN hw_property_master AS PM ON PD.property_id = PM.property_master_id
	INNER JOIN hw_city_master AS C ON PD.city_id = C.city_master_id
	JOIN hw_province_master AS P ON C.province_id= P.province_id WHERE PM.STATUS='Active' AND C.status='Active' AND  P.status='Active' AND PM.property_name LIKE '".$term."%'";
	$query = $this->db->query($str);
	if($query->num_rows()>0){
	     foreach($query->result_array() as $index=>$data){
		  $d =  array(
			      'label'		=> $data['property_name'].', '.$data['city_name'].', '.$data['province_name'],
			      'value'		=> $data['property_name'].', '.$data['city_name'].', '.$data['province_name'],
			      'city_slug'	=> $data['city_slug'],
			      'property_slug'	=> $data['property_slug'],
			      );
		  $result[] = $d;
	     }
	}
	
	$message = array('result' => $result,'message' => 'Record fetched successfully!');
	$this->response($message, 200);
    }
    
    
	 
	 
	 public function search_get(){
		$type_id 	= $this->input->get_post('typeid', TRUE);
		$currency 	= $this->input->get_post('currency', TRUE);
		$logged_id 	= $this->input->get_post('logged_id', TRUE);

		if($type_id != ''){
				$this->setcurrencyinfo();
				$propertylist 	= $this->model_api->propertygetlist('search',$currency,'','','',$logged_id);

				if($propertylist && is_array($propertylist) )
						$totalCount	= count($propertylist);
				else
						$totalCount	= 0;

				if($propertylist && is_array($propertylist) ){
						$message = array('status' => '1', 'result' => array_values($propertylist),'message' => 'There are ' . $totalCount . ' Properties that match your search criteria!');
				}
				else{
						$message = array('status' => '2', 'message' => 'There are 0 Properties that match your search criteria!');
				}
		}
		else{
				$message = array('status' => '2', 'message' => 'There is 0 Property!');
		}
		$this->response($message, 200);
}
		
		
    
    public function roomtype_get(){
				$roomtypeRecord			= $this->model_basic->getValues_conditions('hw_roomtype_master', array('*'), '', 'roomtype_status = "Active"');
				if($roomtypeRecord){		
						$message = array('result' => $roomtypeRecord,'message' => 'Record fetched successfully!');
				}
				else{
						$message = array('message' => 'No data found!');
				}
				$this->response($message, 200);
    }
	 
	 
	 
    function propertytype_get(){
		  
		  $propertytypeRecord			= $this->model_basic->getValues_conditions('hw_property_type_master', array('*'), '', 'status = "Active"');
		  if($propertytypeRecord){		
				$message = array('result' => $propertytypeRecord,'message' => 'Record fetched successfully!');
		  }else{
				$message = array('message' => 'No data found!');
		  }
		  $this->response($message, 200);
    }
    
    
	 
	 public function propertydtl_get(){
		  $property_slug 		= $this->uri->segment(6,0);
		  $currency 		= $this->input->get_post('currency', TRUE);
		  $property_detail	= $this->model_api->getPropertyDetails($property_slug,'',"INR");
	
		  /***** Remove HTML Tags *****/
	
		  $property_detail['master_details']['address'] 			= strip_tags($property_detail['master_details']['address']);
		  $property_detail['master_details']['direction'] 		= strip_tags($property_detail['master_details']['direction']);
		  $property_detail['master_details']['location'] 			= strip_tags($property_detail['master_details']['location']);
		  $property_detail['master_details']['cancellation_policy']	= strip_tags($property_detail['master_details']['cancellation_policy']);
	
		  /***** Remove HTML Tags *****/
		  
		  $property_id 		= $property_detail['master_details']['property_master_id'];
		  $dealDetails 		= $this->model_property->existingDeal($property_id);
		  $avg_review 		= $this->model_api->getAvgRating($property_id);
		 
		  
	
		  if($property_detail){
				
				//foreach($dealDetails as $deal){
				//	 $room_type_ids = $deal['room_type_id'];
				//	 $ids = explode(',',$room_type_ids);
				//	 foreach($ids as $id){
				//		  $agent_roomtype	= $this->model_basic->getValues_conditions('hw_agent_roomtype', '*', '',' status="active"  AND id = "'.$id.'" ');
				//		  $dealDetails['room_type'] = array(
				//				'room_type' => $agent_roomtype[0]['type_name'],
				//				'size' => $agent_roomtype[0]['size'],
				//				'price_charge_type' => $agent_roomtype[0]['price_charge_type']
				//		  );
				//	 }
				//	 
				//	 
				//}
				//pr($deal);
				$result = array(
											'property_detail' => $property_detail,
											'deals' => $dealDetails,
											'reviews' => $avg_review['review_list'],
											'sum_rating' => $avg_review['sum_rating'],
											'avg_rating' => $avg_review['avg_rating'],
											'total_review' => $avg_review['total_review']
				);
				$message = array('result' => $result,'message' => 'Record fetched successfully!');
		  }
		  else{
				$message = array('message' => 'No data found!');
		  }
		  $this->response($message, 200);	
    }
    
	 
	 
	 
    public function currency_get(){
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
	}else{ 
	    $countryCode 		= 'AU';
	    $currencySymbol 		= '$';
	    $currencyCode		= 'AUD';
	    $currencyRate		= 1.00; 
		
	    $userIP 	= $_SERVER['REMOTE_ADDR'];   
	    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$userIP));			
	    if($ip_data && $ip_data->geoplugin_countryName != null){
		$cntCode 	= $ip_data->geoplugin_countryCode;
		$cName 		= $ip_data->geoplugin_countryName;
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
	
	$currencyInfo	= $this->model_basic->getValues_conditions(CURRENCY_MASTER, '*', '',"country_currency_status='active' group by currency_code ", 'country_code', 'ASC');
	if($currencyInfo)
	    $message = array('result' => $currencyInfo,'message' => 'Record fetched successfully!');
	else
	    $message = array('message' => 'Record fetched successfully!');
	
	$this->response($message, 200);
    }
    
    
	 
	 public function addwishlist_post(){
		  $user_id                = addslashes(trim($this->input->get_post('userid')));
		  $property_id            = addslashes(trim($this->input->get_post('property_id')));
		  $isExistUser 		= $this->model_basic->isRecordExist(USER, 'id="'.$user_id.'"');
		  $isExistProperty	= $this->model_basic->isRecordExist(PROPERTY_MASTER, 'property_master_id="'.$property_id.'"');
		  if($isExistUser){
				if($isExistProperty){
					 $isExist = $this->model_basic->isRecordExist(MEMBERS_FAVOURITE, 'user_id="'.$user_id.'" AND property_id="'.$property_id.'"');
		if($isExist==0){
		    $insert_arr= array(
		    'user_id'	=> $user_id,
		    'property_id'	=> $property_id,
		    'db_add_date'	=> date("Y-m-d H:i:s")
		    );
		    $this->model_basic->insertIntoTable(MEMBERS_FAVOURITE,$insert_arr);
		    $message = array('status' => '1', 'message' => 'Successfully added to wishlist!');
		}else{
		    $this->model_basic->deleteData(MEMBERS_FAVOURITE, 'user_id="'.$user_id.'" AND property_id="'.$property_id.'"');
		    $message = array('status' => '2', 'message' => 'Successfully deleted from wishlist!');
		}
	    }else{
		$message = array('status' => '3', 'message' => 'Invalid property data provided!');
	    }
	}else{
	    $message = array('status' => '4', 'message' => 'Invalid user data provided!');
	}
	$this->response($message, 200);
    }
	 
	 
	 
	 
    
    public function contact_post(){
	$comment		= addslashes(trim($this->input->get_post('comment')));
	$email			= addslashes(trim($this->input->get_post('email')));
	$phone_no		= addslashes(trim($this->input->get_post('phone_no')));
	$name			= addslashes(trim($this->input->get_post('name')));
	
	if(!empty($comment) && !empty($email) && !empty($phone_no) && !empty($name)){
	    $contact_msg = trim($comment);
	    $phone = trim($phone_no);
	    
	    $send_mail = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
	    //$mail_config['to'] = trim($send_mail);
	    $mail_config['to'] = 'kalyan.dey@webskitters.com';
	    $mail_config['from'] = $email;
	    $mail_config['from_name'] = $name;
	    $mail_config['subject'] = 'New contact form submitted by '.$mail_config['from_name'];
	    
	    $message  = '';
	    $message .= '<p>A new contact form is posted.Find the details below</p>';
	    $message .= '<p><strong>Name : </strong> '.$mail_config['from_name'].'</p>';
	    $message .= '<p><strong>Email : </strong> '.$mail_config['from'].'</p>';
	    $message .= '<p><strong>Phone No : </strong> '.$phone.'</p>';
	    $message .= '<p><strong>Message : </strong> '.$contact_msg.'</p>';
	    
	    $mail_config['message'] = $message;
	    
	    $mailsnd_admin = send_html_email($mail_config);
	    
	    $template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=4');
	    
	    $mail_config['to'] = stripslashes(trim($email));
	    $mail_config['from'] = $template[0]['responce_email'];
	    $mail_config['from_name'] = 'HostelMofo Team';
	    $mail_config['subject'] = $template[0]['email_subject'];
	    $mail_config['message'] =  $template[0]['email_content'];
	    $mail_config['message'] = str_replace('{{USERNAME}}',stripslashes(trim($name)),$mail_config['message']);
	    
	    //echo $mail_config['message'];
	    
	    $mailsnd_user = send_html_email($mail_config);
	    //	exit();
	    
	    if($mailsnd_user)
	    {
		$message = array('status' => '1', 'message' => 'Email sent successfully!');
	    }else{
		$message = array('status' => '2', 'message' => 'Email cannot send at this moment!');
	    }
	}else{
	    $message = array('status' => '3', 'message' => 'Input data missing!');
	}
	$this->response($message, 200);	
    }
    
    public function feedback_post(){
				$comment		= addslashes(trim($this->input->get_post('comment')));
				$email			= addslashes(trim($this->input->get_post('email')));
				$phone_no		= addslashes(trim($this->input->get_post('phone_no')));
				$name				= addslashes(trim($this->input->get_post('name')));
				$like_app		= addslashes(trim($this->input->get_post('like_app')));
		
				if(empty($like_app)){
						$like_app	= 'No';
				}
				else{
						$like_app	= 'Yes';
				}
		
				if(!empty($comment) && !empty($email) && !empty($phone_no) && !empty($name)){
						$contact_msg = trim($comment);
						$phone = trim($phone_no);
		
						$send_mail = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=1');
						//pr($send_mail);
						
						
						$mail_config['to'] = trim($send_mail);
						//$mail_config['to'] = 'kalyan.dey@webskitters.com';
						$mail_config['from'] = $email;
						$mail_config['from_name'] = $name;
						$mail_config['subject'] = 'New feedback submitted by '.$mail_config['from_name'];
		
						$message  = '';
						$message .= '<p>A new feedback is posted.Find the details below</p>';
						$message .= '<p><strong>Name : </strong> '.$mail_config['from_name'].'</p>';
						$message .= '<p><strong>Email : </strong> '.$mail_config['from'].'</p>';
						$message .= '<p><strong>Phone No : </strong> '.$phone.'</p>';
						$message .= '<p><strong>Message : </strong> '.$contact_msg.'</p>';
						$message .= '<p><strong>Like App? : </strong> '.$like_app.'</p>';
		
						$mail_config['message'] = $message;
						$mailsnd_admin = send_html_email($mail_config);
		
						$template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=4');
		
						$mail_config['to'] = stripslashes(trim($email));
						$mail_config['from'] = $template[0]['responce_email'];
						$mail_config['from_name'] = 'HostelMofo Team';
						$mail_config['subject'] = $template[0]['email_subject'];
						$mail_config['message'] =  $template[0]['email_content'];
						$mail_config['message'] = str_replace('{{USERNAME}}',stripslashes(trim($name)),$mail_config['message']);
		
						$mailsnd_user = send_html_email($mail_config);
		
						if($mailsnd_user){
								$message = array('status' => '1', 'message' => 'Email sent successfully!');
						}
						else{
								$message = array('status' => '2', 'message' => 'Email cannot send at this moment!');
						}
				}
				else{
						$message = array('status' => '3', 'message' => 'Input data missing!');
				}
				$this->response($message, 200);	
		}
    
	 
	 
    public function favouritelist_post(){
		  $userid	= addslashes(trim($this->input->get_post('userid')));
		  $currency = $this->input->get_post('currency', TRUE);
		  
		  if($userid){
				$result = $this->model_api->getFavouriteDetails($userid,$currency);
				$message = array('result' => $result, 'status' => '1', 'message' => 'Data fetched successfully!');
		  }else{
				$message = array('status' => '2', 'message' => 'Input data missing!');
		  }
		  $this->response($message, 200);
    }
	 
	 
	 
    
    public function cms_post(){
	$id		= addslashes(trim($this->input->get_post('id')));
	if($id){
	    $result = $this->model_basic->getValues_conditions(CMS, '',  '', 'cms_id="'.$id.'"');
	    if(is_array($result) && COUNT($result)>0)
		$message = array('result' => $result, 'status' => '1', 'message' => 'Data fetched successfully!');
	    else
		$message = array('result' => array(), 'status' => '1', 'message' => 'Data fetched successfully!');
	}else{
	    $message = array('status' => '2', 'message' => 'Input data missing!');
	}
	$this->response($message, 200);
    }
    
    public function booking_post(){
		    
				require APPPATH.'/libraries/securepay.php';
				$json_message					= '';
				$msg_code					= 0;
				$res_message					= '';
				$rand_id					= 0;
				$ins_id						= 0;
				
				$currency_wallet_balance= $this->input->get_post('wallet_balance');
				//$wallet_balance     	= $this->input->get_post('wallet_balance');
				
				$property_id        	= $this->input->get_post('property_id');
				$property_price     	= $this->input->get_post('property_price');
				$payble_amount  	= $this->input->get_post('payble_amount');
				$downpayment     	= $this->input->get_post('downpayment');
				//$usd_balance		= $this->input->get_post('usd_balance');
				
				$get_usd_balance	= $this->input->get_post('usd_balance');
				$discount_type		= $this->input->get_post('discount_type');
				$discount_amount	= $this->input->get_post('discount_amount');
				$booking_type 		= $this->input->get_post('booking_type');
				
				
				/* getting record from APP start */
				
				$currency_code		= $this->input->get_post('currency');
				$total_booking_amount	= $this->input->get_post('property_price');
				$downpayment		= $this->input->get_post('downpayment');
				
				
				//echo "<><>".$get_usd_balance;
				$currency_rate = $this->model_basic->getValue_condition('hw_currency_master', 'currency_rate', '', "currency_code = '".$currency_code."'");
				
				/*** Change into AUD start ***/
				
				//$usd_balance		= $total_booking_amount / $currency_rate;
				$usd_balance	= round($get_usd_balance / $currency_rate, 2);
				$wallet_balance	= round($currency_wallet_balance / $currency_rate, 2);
				
				/*** Change into AUD end ***/
				
				$payble_amount	= $usd_balance;
				
				/* getting record from APP end */
		
				$first_name         	= trim($this->input->get_post('first_name'));
				$last_name          	= trim($this->input->get_post('last_name'));
				$email              	= trim($this->input->get_post('email1'));
		
				$nationality        	= trim(addslashes($this->input->get_post('nationality')));
				$arrival_time       	= trim(addslashes($this->input->get_post('arrival_time')));
				$arrival_time1      	= trim(addslashes($this->input->get_post('arrival_time1')));
				$text_sms           	= trim(addslashes($this->input->get_post('text_sms')));
				$gender             	= trim(addslashes($this->input->get_post('gender')));
				$prefix_phone       	= trim(addslashes($this->input->get_post('prefix_phone')));
				$suffix_phone       	= trim(addslashes($this->input->get_post('suffix_phone')));
				$new_user_id        	= trim(addslashes($this->input->get_post('new_user_id')));
		
				$cc_number          	= $this->input->get_post('cc_number');
				$exp_date           	= $this->input->get_post('exp_date');
				$cvv                	= $this->input->get_post('cvv');
		
				$check_in 		= $this->input->get_post('check_in');
				$check_out 		= $this->input->get_post('check_out');
		
				$chkin 			= explode('/',$check_in);
				$chkout 		= explode('/',$check_out);
		
				$dataArr['nationality'] = $nationality;
				$dataArr['gender']      = $gender;
		
				if($new_user_id != ''){
						$user 	= $this->model_basic->getValues_conditions(USER,'','',"id=".$new_user_id);
						//pr($user);
						$dataArr['first_name']	= $user[0]['firstname'];
						$dataArr['last_name']   = $user[0]['lastname'];
						$dataArr['email']       = $user[0]['email'];
				
						if($arrival_time1 != ''){
								$dataArr['arrival_time']	= $arrival_time1;
						}
						else{
								$dataArr['arrival_time'] 	= '10 : 10 : AM';
						}
				
						if($nationality == '' && $gender == ''){
								$dataArr['nationality']	= $user[0]['nationality'];
								$dataArr['gender']      = $user[0]['gender'];
						}
						else{
								$this->model_basic->updateIntoTable(USER,array('id'=>$new_user_id),array('nationality'=>$nationality,'gender'=>$gender));
						}
				}
				else{
						$dataArr['first_name']      = addslashes($first_name);
						$dataArr['last_name']       = addslashes($last_name);
						$dataArr['email']           = addslashes($email);
						$dataArr['arrival_time']	  = $arrival_time;
				}
		
				$dataArr['text_sms']            = $text_sms;
				$dataArr['prefix_phone']        = $prefix_phone;
				$dataArr['suffix_phone']        = $suffix_phone;
				$phone 			    	= $dataArr['prefix_phone'].$dataArr['suffix_phone'] ;
				$payment_status                 = 'Pending';
		
				$dataArr['user_id']             = $new_user_id;
				$dataArr['property_id']         = $property_id;
				$dataArr['property_price']	= $property_price;           
				$dataArr['bookingType']	    	= 'normal';
				$dataArr['booking_from']	= 'app';
		
				$dataArr['payble_amount']       = $get_usd_balance / $currency_rate;
				$dataArr['downpayment_percent'] = $downpayment;
				$dataArr['usd_balance']         = $total_booking_amount / $currency_rate;
		
				$dataArr['currency_name']       = $this->input->get_post('currency');
				
				$for_mail_currency_name       = $this->input->get_post('currency');
		
				$currencyArr  = $this->model_basic->getValues_conditions('hw_currency_master','','','currency_code = "'.$dataArr['currency_name'].'"', $OrderBy='',$OrderType='',$Limit=0);
				//pr($currencyArr);
				$dataArr['currency_symbol']     = $currencyArr[0]['country_currency_symbol'];
				$dataArr['currency_rate']       = $currencyArr[0]['currency_rate'];
				$dataArr['discount_type']       = $discount_type;
				$dataArr['discount_amount']     = $discount_amount;
				$dataArr['booking_type'] 				= $booking_type;
				$dataArr['added_date']          = date('Y-m-d H:i:s');
				$dataArr['check_in']            = '';
				$dataArr['check_out']           = '';
		
				if(is_array($chkin) && is_array($chkout) && count($chkin)>1 && count($chkout)>1){
						$dataArr['check_in']  = $chkin[2]."-".$chkin[1]."-".$chkin[0];
						$dataArr['check_out'] = $chkout[2]."-".$chkout[1]."-".$chkout[0];
				}
				
				//echo "<><><>".$payble_amount; //15
				//echo "<><>".$wallet_balance; //0
				//exit();
				
				$pay_through_wallet		= 0;
				
				
				if($wallet_balance < $usd_balance){
				    
						$dataArr['payment_status']    	= 'Pending';
						$expDate			= explode('/',$exp_date);
						$dataArr['card_number']     	= $cc_number;
						$dataArr['card_expiry_date']  	= $expDate[1].'-'.$expDate[0].'-00';
						$dataArr['card_holder_name']	= $this->input->get_post('cc_holder_name');
						$dataArr['card_type']     	= $this->input->get_post('card_type');
						$dataArr['note']		= "wallet amount:".$wallet_balance.",pay amount:".($payble_amount-$wallet_balance);
						$payble_amount			= $usd_balance-$wallet_balance;
						
						if($wallet_balance > 0 && $wallet_balance < $usd_balance)
						{
						    $insrArr = array(	
							'user_id' 	=> $new_user_id,
							'amount'	=> round($wallet_balance,2), //$wallet_balance,
							'debit_credit' 	=> 'dr',
							'property_id'	=> $property_id
						    );
						    $this->model_basic->insertIntoTable(WALLET,$insrArr);
						}
						
						
				}
				
				else if($wallet_balance > $usd_balance || $wallet_balance == $usd_balance)
				{
				    
						$dataArr['note']		= "wallet amount:".$wallet_balance.",pay amount:0";
						$dataArr['payment_status']	= "Success";
						$payble_amount			= 0;
						$json_message 			= "Transaction was a success";
						$msg_code			= 1;
						$response_message 		= array('status' => $msg_code, 'message' => $json_message);
						
						$pay_through_wallet		= 1;
						
						$insrArr = array(	
						    'user_id' 		=> $new_user_id,
						    'amount'		=> round($usd_balance,2), //$wallet_balance,
						    'debit_credit' 	=> 'dr',
						    'property_id'	=> $property_id
						);
						$this->model_basic->insertIntoTable(WALLET,$insrArr);
		
				}
				
				
		//pr($dataArr);
		
				$ins_id =  $this->model_basic->insertIntoTable('hw_payment_info',$dataArr);
				$this->nsession->set_userdata('payment_id',$ins_id);
		
				switch (strlen($ins_id)) {
						case 1: $rand_id = rand(10000000,99999999).$ins_id;
										break;
						case 2:	$rand_id = rand(1000000,9999999).$ins_id;
										break;
						case 3:	$rand_id = rand(100000,999999).$ins_id;
										break;
						case 4:	$rand_id = rand(10000,99999).$ins_id;
										break;
						case 5:	$rand_id = rand(1000,9999).$ins_id;
										break;
						case 6:	$rand_id = rand(100,999).$ins_id;
										break;
						case 7:	$rand_id = rand(10,99).$ins_id;
										break;
						case 8:	$rand_id = rand(0,9).$ins_id;
										break;
						default:$rand_id = $ins_id;
				}
		
				$this->model_basic->updateIntoTable('hw_payment_info', array('paymeny_id'=>$ins_id), array('reference_id'=>$rand_id));
		
				if($ins_id){
						$room_type_id   	= $this->input->get_post('room_type_id');
						//pr($room_type_id);
						$no_of_person		= $this->input->get_post('no_person');
						$no_of_room     	= $this->input->get_post('no_room');
						$total_price    	= $this->input->get_post('tot_room_price');
						$room_price    		= $this->input->get_post('room_price');
		
		
						$message 					= '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%">
																<tr>
																<td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td>
																<td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td>
																<td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Guests</td>
																<td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td>	      
																</tr>';                                                            
		
						if(isset($room_type_id)){
								$total = 0;
								for($i=0;$i<count($room_type_id);$i++)
								{
								    $insertArr['property_id']	= $this->input->get_post('property_id');
								    $insertArr['payment_id']    = $ins_id;
								    $insertArr['room_type']     = $room_type_id[$i];
								    $insertArr['no_of_room']    = $no_of_room[$i];
								    $insertArr['no_of_person']  = $no_of_person[$i];
								    $insertArr['total_price']   = $total_price[$i];
								    $insertArr['room_price']    = $room_price[$i];
								    $total                      = $insertArr['total_price'] + $total;
								    $roomtypename               = $this->model_basic->getValue_condition('hw_roomtype_master', 'roomtype_name', '', 'roomtype_id='.$insertArr['room_type'].'');
		
										$message 										.= "<tr>
																										<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$roomtypename."</td>
																										<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_room']."</td>
																										<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_person']."</td>
																										<td style='border-bottom :1px solid #ccc;padding: 5px 10px;'>".$for_mail_currency_name.$insertArr['total_price']."</td>
																										</tr>";
		
										$this->model_basic->insertIntoTable('hw_booking_deatils',$insertArr);
								}
						}
						$message .= '<tr>
												<td colspan="3" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td>
												<td style="padding: 5px 10px;"><b> <span>'.$for_mail_currency_name.round($total).'</span></b></td>
												</tr>
												</table>';
				}
		
				
				if($payble_amount>0){
				    
						
						$sp = new SecurePay('ABC0001','abc123');
						$sp->TestMode();
						$sp->TestConnection();
						$sp->Cc = $cc_number;
						$sp->ExpiryDate = $exp_date;
						$sp->ChargeAmount = $payble_amount;
						$sp->ChargeCurrency = 'USD';
						$sp->Cvv = '123';
						$sp->OrderId = $ins_id;
						
						
						
						$sp_valid 			= 1;
						$response['TransactionId']	= rand();
						$response['result'] 		= 'SECUREPAY_STATUS_APPROVED';
						
						// if ($sp->Valid()){
						if ($sp_valid == 1){
						    // Is the above data valid?
						    
						    
								//$response = $sp->Process();
								
														
								if($response['TransactionId'] != '' && isset($response['TransactionId'])){
										$update_arr['TransactionId']   = $response['TransactionId'];
								}
				
								//if ($response['result'] == SECUREPAY_STATUS_APPROVED){
								if ($response['result'] == 'SECUREPAY_STATUS_APPROVED'){
										$succmsg =  "Transaction successfully completed\n";
										$this->nsession->set_userdata('succmsg',$succmsg);
										$payment_status                 = 'Success';
										$update_arr['payment_status']   = 'Success';
										$idArr['paymeny_id']            = $ins_id;
										$json_message 			= "Transaction successfully completed";
										$msg_code			= 1;
								}
								else
								{

								    $errmsg =  "Transaction failed :".$sp->Error."\n";
										$this->nsession->set_userdata('errmsg',$errmsg);
										$update_arr['transaction_details'] = addslashes($sp->Error);
										$json_message 	= addslashes($sp->Error);
										$idArr['paymeny_id'] = $ins_id;
										
										$update_arr['Booking_status'] = 'Cancelled';
								}
				
								$this->model_basic->updateIntoTable('hw_payment_info', $idArr, $update_arr);
								$send_mail          = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
								$template           = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
				
								$mail_config['to']  				= stripslashes(trim($send_mail));
								$mail_config['from']        = $template[0]['responce_email'];
								$mail_config['from_name']   = 'Hostelmofo Team';
								$mail_config['subject']     = $template[0]['email_subject'];
								$mail_config['message']     = $template[0]['email_content'];
								$property_name              = $this->model_basic->getValue_condition('hw_property_master', 'property_name', '', 'property_master_id='.$property_id.'');
				
								$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$email,($phone != '' ? $phone : 'N/A'),$payment_status,$property_name),stripslashes($mail_config['message']));
				
								$mailsend_admin             = send_html_email($mail_config);
								$usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
				
								$mail_config['to']          = $email;
								$mail_config['from']        = $usertemplate[0]['responce_email'];
								$mail_config['from_name']   = 'Hostelmofo Team';
								$mail_config['subject']     = $usertemplate[0]['email_subject'];
								$mail_config['message']     = $usertemplate[0]['email_content'];
				
								$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$payment_status,$property_name),stripslashes($mail_config['message']));
				
								if ($response['result'] == 'SECUREPAY_STATUS_APPROVED'){
										$mailsend_user		= send_html_email($mail_config);
										
								}
						}
						
						else{	    
								if (!$sp->ValidCc()){
										$errmsg =  "Credit Card Number is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								elseif (!$sp->ValidExpiryDate()){
										$errmsg =  "Expiry Date is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								elseif (!$sp->ValidCvv()){
										$errmsg =  "CVV is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								elseif (!$sp->ValidChargeAmount()){
										$errmsg =  "Charge Amount is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								elseif (!$sp->ValidChargeCurrency()){
										$errmsg =  "Charge Currency is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								elseif (!$sp->ValidOrderId()){
										$errmsg =  "Order ID is invalid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
								else{
										$errmsg =  "All data is valid\n";
										$json_message 	= $errmsg;
										$msg_code	= 2;
								}
						}
				}
				else{
				    
					if($pay_through_wallet)
					{
					    $json_message	= 'Transaction successfully completed';
					}
					else
					{
					    $json_message	= 'Payble amount is 0. Payment failed';
					    $msg_code		= 0;
					    
					}
						
					$send_mail  	= $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
					$template   	= $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
					
					$mail_config['to']        = stripslashes(trim($send_mail));
					$mail_config['from']      = $template[0]['responce_email'];
					$mail_config['from_name'] = 'Hostelmofo Team';
					$mail_config['subject']   = $template[0]['email_subject'];
					$mail_config['message']   = $template[0]['email_content'];
					$property_name            = $this->model_basic->getValue_condition('hw_property_master','property_name','','property_master_id='.$property_id.'');
					
					$mail_config['message'] 	= str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$email,($phone != '' ? $phone : 'N/A'),$payment_status,$property_name),stripslashes($mail_config['message']));
					
					$mailsend_admin           = send_html_email($mail_config);
					$usertemplate           	= $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
					
					$mail_config['to']        = $email;
					$mail_config['from']      = $usertemplate[0]['responce_email'];
					$mail_config['from_name'] = 'Hostelmofo Team';
					$mail_config['subject']   = $usertemplate[0]['email_subject'];
					$mail_config['message']   = $usertemplate[0]['email_content'];
					$mail_config['message']   = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$payment_status,$property_name),stripslashes($mail_config['message']));
					
					$mailsend_user            = send_html_email($mail_config);
					
				}
				
				
				$response_message = array('status' => $msg_code, 'message' => $json_message,  'reference_id' => $rand_id ,'payment_id' => $ins_id);
				$this->response($response_message, 200);
		}
	    
    
    public function propertysettingprice_post(){
	$id		= trim($this->input->get_post('id'));
	if($id)
	{
	    $field_array = array('deposite_amount', 'service_fees');
	    
	    $result = $this->model_basic->getValues_conditions(PROPERTY_MASTER, $field_array,  '', 'property_master_id="'.$id.'"');
	    $result[0]['no_booking_fees'] = 0;
	    $message = array('result' => $result, 'status' => '1', 'message' => 'Data fetched successfully!');
	}
	else
	{
	    $message = array('status' => '2', 'message' => 'Input data missing!');
	}
	$this->response($message, 200);
	
    }
    
    public function cityhostelalllist_get(){
	$str	= "SELECT C.*, P.province_name, C.city_slug FROM hw_city_master AS C JOIN hw_province_master AS P ON C.province_id= P.province_id WHERE C.status='Active' AND  P.status='Active'";
	$query	= $this->db->query($str);
	$result	= array();
	if($query->num_rows()>0)
	{
	    foreach($query->result_array() as $index=>$data)
	    {
		$d =  array(
			    'label'	=> $data['city_name'].', '.$data['province_name'],
			    'value'	=> $data['city_name'].', '.$data['province_name'],
			    'city_slug'	=> $data['city_slug']
			      );
		$result[] = $d;
	     }
	}
	
	$str = "SELECT C.*, P.province_name, C.city_slug,PM.property_name,PM.property_slug FROM
	hw_property_details AS PD INNER JOIN hw_property_master AS PM ON PD.property_id = PM.property_master_id
	INNER JOIN hw_city_master AS C ON PD.city_id = C.city_master_id
	JOIN hw_province_master AS P ON C.province_id= P.province_id WHERE PM.STATUS='Active' AND C.status='Active' AND  P.status='Active'";
	$query = $this->db->query($str);
	if($query->num_rows()>0)
	{
	    foreach($query->result_array() as $index=>$data)
	    {
		$d =  array(
			    'label'		=> $data['property_name'].', '.$data['city_name'].', '.$data['province_name'],
			    'value'		=> $data['property_name'].', '.$data['city_name'].', '.$data['province_name'],
			    'city_slug'		=> $data['city_slug'],
			    'property_slug'	=> $data['property_slug'],
			    );
		$result[] = $d;
	     }
	}
	
	$message = array('result' => $result,'message' => 'Record fetched successfully!');
	$this->response($message, 200);
	
    }
    
    public function getWalletBalance_get() {
	$currency	= $this->input->get_post('currency');
	$user_id	= $this->input->get_post('user_id');
	
        $walletBlns = $this->model_api->getWalletBalance($currency);
	$message = array('wallet' => $walletBlns,'message' => 'Record fetched successfully!');
	$this->response($message, 200);
    }
    
    public function getBookingList_get(){
	$user_id	= $this->input->get_post('user_id');
	$finalArr	= array();
        $finalArr['futureBooking'] 	= $this->model_api->booked_future($user_id);
	$finalArr['pastBooking'] 	= $this->model_api->booked_past($user_id);
	$finalArr['cancelBooking'] 	= $this->model_api->cancelled($user_id);
	//pr($finalArr);
	$message = array('booking_arr' => $finalArr,'message' => 'Record fetched successfully!');
	$this->response($message, 200);
    }
    
    public function getBookingdetails_get(){
	$booking_id		= $this->input->get_post('booking_id');
	$currency_symbol	= $this->input->get_post('currency_symbol');
	
	$finalArr	= $payment_summery = array();
        
	$finalArr 	= $this->model_api->get_booking_details($booking_id);
	$usd_balance 	= $finalArr[0]['total_price'];
	$payment_summery= $this->model_api->get_payment_details($booking_id, $currency_symbol, $usd_balance);
	
	$message = array('booking_arr' => $finalArr,'payment_arr' => $payment_summery,'message' => 'Record fetched successfully!');
	$this->response($message, 200);
    }
    
    public function cancelBooking_get(){
	$paymeny_id	= $this->input->get_post('paymeny_id');
	$user_id	= $this->input->get_post('user_id');
	$amount		= $this->model_booking->property_cancelled($paymeny_id);
	
	
	if(isset($amount[0]['property_id']))
	{
	    $paybleAmount 	= $amount[0]['payble_amount'];
	    $bookingStatus 	= $amount[0]['Booking_status'];
	    $paymeny_id 	= $amount[0]['paymeny_id'];
	    $property_id 	= $amount[0]['property_id'];
	    $bookingDate 	= $amount[0]['added_date'];
	
	    if($bookingStatus=='Booked')
		$bookingStatus='Cancelled';
		    
	    if($amount[0]['booking_type'] != 'Non-flexible')
	    {
		$currentDate = date('Y-m-d h:i:s');
		$credit = 'cr';    
		$data = array(	'user_id' 	=> $user_id,
				'amount'	=> $paybleAmount,
				'debit_credit'	=> $credit,
				'property_id'	=> $property_id,
				'added_on'	=> $currentDate
			    );
	
		$diff = strtotime($currentDate) - strtotime($bookingDate);
		$diff_in_hrs = $diff/3600;
		
		if($diff_in_hrs<=24)
		{  
		    $this->model_basic->insertIntoTable(WALLET,$data);    
		}
		else
		{    
		    $commissionArray = $this->model_basic->getValues_conditions(SITESETTINGS,'sitesettings_value','',"sitesettings_id='22'");
		    $commissionAmount = $commissionArray[0]['sitesettings_value']; 
		    $newAmount = $paybleAmount-($paybleAmount * $commissionAmount/100);
	
		    $data = array(  'user_id' 	=> $user_id,
				    'amount'	=> $newAmount,
				    'debit_credit'	=> $credit,
				    'property_id'	=> $property_id,
				    'added_on'	=> $currentDate
				);
		    
		    $this->model_basic->insertIntoTable(WALLET,$data);    
		}
	
		$updateBookingStatus 		= $this->model_booking->update_status(PAYMENT_INFO,$bookingStatus,$paymeny_id);
		$user_id 			= $this->nsession->userdata('USER_ID');
		$userArray  			= $this->model_basic->getValues_conditions(USER,'*','',"id='$user_id'");
		$FirstName  			= $userArray[0]['firstname'];
		$Last_Name			= $userArray[0]['lastname'];
		$emailArray 			= $this->model_booking->send_mail($property_id);    
		$emailId 			= $emailArray[0]['email_id'];
		$property_name 			= $emailArray[0]['property_name'];
		$template = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=13');
		$mail_config['to']        	= stripslashes(trim( $emailId));
		$mail_config['from']        	= $template[0]['responce_email'];
		$mail_config['from_name']   	= 'Hostelmofo Team';
		$mail_config['subject']     	= $template[0]['email_subject'];
		$mail_config['message']     	= $template[0]['email_content'];
		$mail_config['message']     	=  str_replace(array('{FIRST-NAME}','{LAST-NAME}','{PROPERTY-NAME}'),
		array($FirstName,$Last_Name,$property_name),stripslashes($mail_config['message']));
		//pr($mail_config);
		$mailsend_admin  = send_html_email($mail_config);	
		$message = array('message' => 'Booking cancelled successfully!','status'=> 1);
		$this->response($message, 200);
	    }
	    else
	    {
		$updateBookingStatus 		= $this->model_booking->update_status(PAYMENT_INFO,$bookingStatus,$paymeny_id);
		$message = array('message' => 'Booking cancelled successfully! But amount can not refund.','status'=> 1);
		$this->response($message, 200);
	    }
	}
	else
	{
	    $message = array('message' => 'No data found!','status'=> 0);
	    $this->response($message, 200);
	}
    }

    public function addReview_post(){
		  $payment_id	= $this->input->get_post('payment_id');
		  $userid 	= $this->input->get_post('user_id');
		  $chk_record_exists = $this->model_basic->isRecordExist(FEEDBACK,"payment_id='".$payment_id."' AND user_id = '".$userid."'");
		  if($chk_record_exists > 0){
				$message = array('message' => 'Review already posted!','status'=>0);
				$this->response($message, 200);
		  }
		  else{
				$value 	  	= $this->input->get_post('value_for_money');
				$Security   	= $this->input->get_post('security');
				$Location   	= $this->input->get_post('location');
				$Atmosphere 	= $this->input->get_post('atmosphere');
				$Cleanliness	= $this->input->get_post('cleanliness');
				$Facilities 	= $this->input->get_post('facilities');
				$Staff 	  	= $this->input->get_post('staff');
				$comment    	= $this->input->get_post('comments');
				$property_id 	= $this->input->get_post('property_id');
				$userid 	  	= $this->input->get_post('user_id');
				$email 	  	= $this->input->get_post('email');
	    
				$data = array(
									 'property_id'	=>$property_id,
									 'user_id'		=>$userid,
									 'email'		=>$email,
									 'value_for_money'	=>$value,
									 'security'		=>$Security,
									 'location'		=>$Location,
									 'atmosphere'	=>$Atmosphere,
									 'cleanliness'	=>$Cleanliness,
									 'facilities'	=>$Facilities,
									 'staff'		=>$Staff,
									 'comments'		=>$comment,
									 'payment_id'	=>$payment_id
								);
				$insertData	= $this->model_feedback->insert_feedback(FEEDBACK,$data);
				$message = array('message' => 'Review added successfully!','status'=> 1);
				$this->response($message, 200);
		  }
    }
    
    public function getReviewList_get(){
		  $user_id	= $this->input->get_post('user_id');
		  $finalArr	= array();
        $finalArr['pending_review'] 	= $this->model_api->pending_review($user_id);
		  $finalArr['past_review'] 	= $this->model_api->past_review($user_id);
		  //pr($finalArr);
		  $message = array('booking_arr' => $finalArr,'message' => 'Record fetched successfully!');
		  $this->response($message, 200);
    }
    
    public function getAvailibilty_post(){
		  $checkin 	= $this->input->post('checkin');
		  $checkout 	= $this->input->post('checkout');	
		  $property_id 	= $this->input->post('property_id');
		  $currency 	= $this->input->post('currency', TRUE);
		  $is_available   = $this->model_api->availableDate($checkin,$checkout,$property_id,$currency);

		  if(isset($is_available) && is_array($is_available) && count($is_available)>0){
				$message = array('result' => $is_available, 'status' => '1', 'message' => 'Data fetched successfully!');
		  }
		  else{
				$message = array('result' => $is_available, 'status' => '0', 'message' => 'No rooms found at this location.');
		  }
		  $this->response($message, 200);
		  //echo json_encode($is_available);	
    }
    
    public function setCreditCard_post(){
		  $data['first_name'] 	= $this->input->post('first_name');
		  $data['last_name'] 	= $this->input->post('last_name');
		  $data['email'] 		= $this->input->post('email');
		  $data['gender']	    	= $this->input->post('gender');
		  $data['nationality'] 	= $this->input->post('nationality');
		  $data['country_code'] 	= $this->input->post('country_code');
		  $data['phone_number'] 	= $this->input->post('phone_number');
		  $data['card_name'] 	= $this->input->post('card_name');
		  $data['card_number']	= $this->input->post('card_number');
		  $data['expiry_date']	= $this->input->post('expiry_date').'-01';
	
		  $this->model_basic->insertIntoTable(USER_CREDIT_CARD,$data);
		  $message = array('status' => '1', 'message' => 'Data inserted successfully!');
		  $this->response($message, 200);
    }
    
    public function getCreditCard_post(){
		  $data['country_code'] 	= $this->input->get_post('country_code');
		  $data['phone_number'] 	= $this->input->get_post('phone_number');
	
		  //$get_data		= $this->model_basic->getValues_conditions(USER_CREDIT_CARD, array('*'), '', 'country_code = "'.$data['country_code'].'" AND phone_number = "'.$data['phone_number'].'"');
		  $get_data		= $this->model_api->getCreditCardInfo($data['country_code'], $data['phone_number']);
		  if(is_array($get_data) && count($get_data) > 0){
				$credit_card_info	= $get_data;
				$status		= 1;
		  }
		  else{
				$credit_card_info	= array();
				$status		= 0;
		  }
	
		  $message	= array('result' => $credit_card_info, 'status' => $status, 'message' => 'Data fetched successfully!');
		  $this->response($message, 200);
    }
	 
	 
	 public function group_booking_post(){
		  $property_slug     = trim(addslashes($this->input->get_post('property_slug')));
		  $city_slug     		= trim(addslashes($this->input->get_post('city_slug')));
		  $checkinDate       = trim(addslashes($this->input->get_post('checkinDate')));
		  $checkoutDate      = trim(addslashes($this->input->get_post('checkoutDate')));
		  $guests           	= trim(addslashes($this->input->get_post('guests')));
		  $group_type        = trim(addslashes($this->input->get_post('group_type')));
		  $age_group         = $this->input->get_post('age_group');
		  
		  
	 }
	 
	 public function group_and_age_get(){
		  $data = array();
		  $groupType	= $this->model_basic->getValues_conditions('hw_groupType',array('typeName','slug'),'','status="active"');
		  $ageGroup		= $this->model_basic->getValues_conditions('hw_ageGroup',array('id','ageGroup'),'','status="active"');
		  $data['groupType'] = $groupType;
		  $data['ageGroup']  = $ageGroup;
		  $message	= array('result' => $data, 'message' => 'Data fetched successfully!');
		  $this->response($message, 200);
	 }
	 
	public function deal_province_get(){
		$city = $this->input->get_post('city');
		$sql = "SELECT DCM.id,DCM.title,DCM.description,DCM.image,DCM.city_id FROM hw_deal_city_master AS DCM LEFT JOIN hw_city_master AS CM ON DCM.city_id = CM.city_master_id WHERE DCM.status = 'Active' AND CM.city_name LIKE '%".$city."%'";		
		
		$rs = $this->db->query($sql);
		
		$getRecord = $rs->result_array();
		
		
		if($getRecord){		
			$message = array('result' => $getRecord,'message' => 'Record fetched successfully!');
		}else{
			$message = array('message' => 'No data found!');
		}
		$this->response($message, 200);
	}
	 
	 
	 
	 
}