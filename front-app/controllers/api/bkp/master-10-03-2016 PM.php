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
    }
    
    function setcurrencyinfo(){
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
    
    function country_get(){
	$countryRecord			= $this->model_basic->getValues_conditions('hw_countries', array('*'), '', 'country_status = "active"');
	if($countryRecord){		
	    $message = array('result' => $countryRecord,'message' => 'Record fetched successfully!');
	}else{
	    $message = array('message' => 'No data found!');
	}
	$this->response($message, 200);
    }
    
    function citylist_get(){
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
    
    function search_get()
    {
	$type_id 	= $this->input->get_post('typeid', TRUE);
	$currency 	= $this->input->get_post('currency', TRUE);
	//pr($_GET);
	
	if($type_id != '')
	{
	    $this->setcurrencyinfo();
	    $propertylist 	= $this->model_api->propertygetlist('search',$currency);
	
	    if($propertylist && is_array($propertylist) )
		$totalCount	= count($propertylist);
	    else
		$totalCount	= 0;
	
	    if($propertylist && is_array($propertylist) )
	    {
		$message = array('status' => '1', 'result' => $propertylist,'message' => 'There are ' . $totalCount . ' Properties that match your search criteria!');
	    }
	    else
	    {
		$message = array('status' => '2', 'message' => 'There are 0 Properties that match your search criteria!');
	    }
	}
	else
	{
	    $message = array('status' => '2', 'message' => 'There is 0 Property!');
	}
	
	$this->response($message, 200);
    }
    
    function roomtype_get(){
	$roomtypeRecord			= $this->model_basic->getValues_conditions('hw_roomtype_master', array('*'), '', 'roomtype_status = "Active"');
	if($roomtypeRecord){		
	    $message = array('result' => $roomtypeRecord,'message' => 'Record fetched successfully!');
	}else{
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
    
    function propertydtl_get(){
	$property_slug 		= $this->uri->segment(6,0);
	$currency 		= $this->input->get_post('currency', TRUE);
	$property_detail	= $this->model_api->getPropertyDetails($property_slug,'',$currency);
	$property_id 		= $property_detail['master_details']['property_master_id'];
	$dealDetails 		= $this->model_property->existingDeal($property_id);
	$avg_review 		= $this->model_api->getAvgRating($property_id);
	//pr($property_detail);
	
	if($property_detail){
	    $result = array('property_detail' => $property_detail, 'deals' => $dealDetails, 'reviews' => $avg_review);
	    $message = array('result' => $result,'message' => 'Record fetched successfully!');
	}else{
	    $message = array('message' => 'No data found!');
	}
	//pr($message);
	$this->response($message, 200);	
    }
    
    function currency_get(){
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
    
    function addwishlist_post(){
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
    
    function contact_post(){
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
    
    function feedback_post(){
	$comment		= addslashes(trim($this->input->get_post('comment')));
	$email			= addslashes(trim($this->input->get_post('email')));
	$phone_no		= addslashes(trim($this->input->get_post('phone_no')));
	$name			= addslashes(trim($this->input->get_post('name')));
	$like_app		= addslashes(trim($this->input->get_post('like_app')));
	if(empty($like_app)){
	    $like_app	= 'No';
	}else{
	    $like_app	= 'Yes';
	}
	
	if(!empty($comment) && !empty($email) && !empty($phone_no) && !empty($name)){
	    $contact_msg = trim($comment);
	    $phone = trim($phone_no);
	    
	    $send_mail = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
	    //$mail_config['to'] = trim($send_mail);
	    $mail_config['to'] = 'kalyan.dey@webskitters.com';
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
    
    function favouritelist_post(){
	$userid	= addslashes(trim($this->input->get_post('userid')));
	$currency = $this->input->get_post('currency', TRUE);
	//$currency		= 'THB';
	//$userid		= 1;
	if($userid){
	    $result = $this->model_api->getFavouriteDetails($userid,$currency);
	    $message = array('result' => $result, 'status' => '1', 'message' => 'Data fetched successfully!');
	}else{
	    $message = array('status' => '2', 'message' => 'Input data missing!');
	}
	$this->response($message, 200);
    }
    
    function cms_post(){
	$id		= addslashes(trim($this->input->get_post('id')));
	if($id){
	    $result = $this->model_basic->getValues_conditions(CMS, '',  '', 'cms_id="'.$id.'"');
	    $message = array('result' => $result, 'status' => '1', 'message' => 'Data fetched successfully!');
	}else{
	    $message = array('status' => '2', 'message' => 'Input data missing!');
	}
	$this->response($message, 200);
    }
    
    function booking_post()
    {
	require APPPATH.'/libraries/securepay.php';
	
	$json_message		= '';
	$msg_code		= 0;
	$res_message		= '';
	
	$wallet_balance     	= $this->input->post('wallet_balance');
	$property_id        	= $this->input->post('property_id');
	$property_price     	= $this->input->post('property_price');
	$payble_amount  	= $this->input->post('payble_amount');
	$downpayment     	= $this->input->post('downpayment');
	$usd_balance		= $this->input->post('usd_balance');
	$discount_type		= $this->input->post('discount_type');
	$discount_amount	= $this->input->post('discount_amount');
	$booking_type 		= $this->input->post('booking_type'); 
	
	$first_name         	= trim($this->input->post('first_name'));
	$last_name          	= trim($this->input->post('last_name'));
	$email              	= trim($this->input->post('email1'));
	
	$nationality        	= trim(addslashes($this->input->post('nationality')));
	$arrival_time       	= trim(addslashes($this->input->post('arrival_time')));
	$arrival_time1      	= trim(addslashes($this->input->post('arrival_time1')));
	$text_sms           	= trim(addslashes($this->input->post('text_sms')));
	$gender             	= trim(addslashes($this->input->post('gender')));
	$prefix_phone       	= trim(addslashes($this->input->post('prefix_phone')));
	$suffix_phone       	= trim(addslashes($this->input->post('suffix_phone')));
	$new_user_id        	= trim(addslashes($this->input->post('new_user_id')));
    
	$cc_number          	= $this->input->post('cc_number');
	$exp_date           	= $this->input->post('exp_date');
	$cvv                	= $this->input->post('cvv');
	
	$check_in 		= $this->input->post('check_in');
	$check_out 		= $this->input->post('check_out');
	
		
	$chkin 			= explode('/',$check_in);
	$chkout 		= explode('/',$check_out);
	
	$dataArr['nationality'] = $nationality;
	$dataArr['gender']      = $gender;
            
	   
	if($new_user_id != '')
	{
	    $user 			= $this->model_basic->getValues_conditions(USER,'','',"id=".$new_user_id);
	    $dataArr['first_name']	= $user[0]['firstname'];
	    $dataArr['last_name']       = $user[0]['lastname'];
	     $dataArr['email']          = $user[0]['email'];
	     
	    if($arrival_time1 != '')
	    {
	       $dataArr['arrival_time']	= $arrival_time1;
	    }
	    else
	    {
	       $dataArr['arrival_time']     	= '10 : 10 : AM';
	    }
	     
	    if($nationality == '' && $gender == '')
	    {
		$dataArr['nationality']	= $user[0]['nationality'];
		$dataArr['gender']      = $user[0]['gender'];
	    }
	    else
	    {
		$this->model_basic->updateIntoTable(USER,array('id'=>$new_user_id),array('nationality'=>$nationality,'gender'=>$gender));
	    }
	}
	else
	{
	    $dataArr['first_name']      = addslashes($first_name);
	    $dataArr['last_name']       = addslashes($last_name);
	    $dataArr['email']           = addslashes($email);
	    $dataArr['arrival_time']	= $arrival_time;
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
	
	$dataArr['payble_amount']       = $payble_amount;
	$dataArr['downpayment_percent'] = $downpayment;
	$dataArr['usd_balance']         = $usd_balance;
	
	$dataArr['currency_symbol']     = $this->input->post('currencySymbol');
	$dataArr['currency_rate']       = $this->input->post('currencyRate');
	$dataArr['currency_name']       = $this->input->post('currencyCode');
	
	$dataArr['discount_type']       = $discount_type;
	$dataArr['discount_amount']     = $discount_amount;
	$dataArr['booking_type'] 	= $booking_type;
	$dataArr['added_date']          = date('Y-m-d H:i:s');
	$dataArr['check_in']            = '';
	$dataArr['check_out']           = '';
    
	if(is_array($chkin) && is_array($chkout) && count($chkin)>1 && count($chkout)>1)
	{
	    $dataArr['check_in']  = $chkin[2]."-".$chkin[1]."-".$chkin[0];
	    $dataArr['check_out'] = $chkout[2]."-".$chkout[1]."-".$chkout[0];
	}
	   
	if($wallet_balance < $payble_amount)
	{
	    $dataArr['payment_status']      	= 'Pending';
	    $expDate			    	= explode('/',$exp_date);
	    $dataArr['card_number']          	= $cc_number;
	    $dataArr['card_expiry_date']     	= $expDate[1].'-'.$expDate[0].'-00';
	    $dataArr['card_holder_name']	= $this->input->post('cc_holder_name');
	    $dataArr['card_type']     	    	= $this->input->post('card_type');
	    $dataArr['note']		    	= "wallet amount:".$wallet_balance.",pay amount:".($payble_amount-$wallet_balance);
	    $payble_amount			= $payble_amount-$wallet_balance;
	}
	else if($wallet_balance > $payble_amount || $wallet_balance == $payble_amount)
	{
	    $dataArr['note']		= "wallet amount:".$wallet_balance.",pay amount:0";
	    $dataArr['payment_status']	= "Success";
	    $payble_amount		= 0;
	    $json_message 		= "Transaction was a success";
	    $msg_code			= 1;
	    
	    $response_message = array('status' => $msg_code, 'message' => $json_message);
	    
	    $insrArr = array(
				'user_id' 	=> $this->input->post('session_user_id'),
				'amount'	=> $wallet_balance,
				'debit_credit' => 'dr',
				'property_id'	=> $property_id
			    );
	    $this->model_basic->insertIntoTable(WALLET,$insrArr);
	}
	   
	$ins_id =  $this->model_basic->insertIntoTable('hw_payment_info',$dataArr);
	$this->nsession->set_userdata('payment_id',$ins_id);
    
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
	  
	   
	if($ins_id)
	{
	    $room_type_id   	= $this->input->post('room_type_id');               
	    $no_of_person	= $this->input->post('no_person');
	    $no_of_room     	= $this->input->post('no_room');
	    $total_price    	= $this->input->post('tot_room_price');
	    $room_price    	= $this->input->post('room_price');
		    
		   
	    $message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%">
			 <tr>
			 <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td>
			 <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td>
			 <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Guests</td>
			 <td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td>	      
			 </tr>';                                                            
	    if(isset($room_type_id))
	    {
		$total = 0;
		for($i=0;$i<count($room_type_id);$i++)
		{
		
		    $insertArr['payment_id']    = $ins_id;
		    $insertArr['room_type']     = $room_type_id[$i];
		    $insertArr['no_of_room']    = $no_of_room[$i];
		    $insertArr['no_of_person']  = $no_of_person[$i];
		    $insertArr['total_price']   = $total_price[$i];
		    $insertArr['room_price']    = $room_price[$i];
		    $total                      = $insertArr['total_price'] + $total;
		    $roomtypename               = $this->model_basic->getValue_condition('hw_roomtype_master', 'roomtype_name', '', 'roomtype_id='.$insertArr['room_type'].'');
		    
		    $message .= "<tr>
				<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$roomtypename."</td>
				<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_room']."</td>
				<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_person']."</td>
				<td style='border-bottom :1px solid #ccc;padding: 5px 10px;'>".$insertArr['total_price']."</td>
				</tr>";
				
		    $this->model_basic->insertIntoTable('hw_booking_deatils',$insertArr);
		}
	    }
	    $message .= '<tr>
			<td colspan="3" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td>
			<td style="padding: 5px 10px;"><b>$ <span>'.round($total).'</span></b></td>
			</tr>
			</table>';
	}
	    
	if($payble_amount>0)
	{
	    $sp = new SecurePay('ABC0001','abc123');
	    $sp->TestMode();
	    $sp->TestConnection();
		
	    $sp->Cc = $cc_number;
	    $sp->ExpiryDate = $exp_date;
	    $sp->ChargeAmount = $payble_amount;
	    $sp->ChargeCurrency = 'USD';
	    $sp->Cvv = $cvv;
	    $sp->OrderId = $ins_id;
		
		if ($sp->Valid()) // Is the above data valid?
		{
		    $response = $sp->Process();
		    
		    if($response['TransactionId'] != '' && isset($response['TransactionId']))
		    {
			$update_arr['TransactionId']   = $response['TransactionId'];
		    }
		    
		    if ($response['result'] == SECUREPAY_STATUS_APPROVED)
		    {
			$succmsg =  "Transaction was a success\n";
			$this->nsession->set_userdata('succmsg',$succmsg);
			$payment_status                 = 'Success';
			$update_arr['payment_status']   = 'Success';
			$idArr['paymeny_id']            = $ins_id;
		    }
		    else
		    {
			$errmsg =  "Transaction failed :".$sp->Error."\n";
			$this->nsession->set_userdata('errmsg',$errmsg);
			
		       $update_arr['transaction_details'] = addslashes($sp->Error);;
		       $idArr['paymeny_id'] = $ins_id;
		    }
		    
		    $this->model_basic->updateIntoTable('hw_payment_info', $idArr, $update_arr);
	       
		    $send_mail                  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
		    $template                   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
		    
		    $mail_config['to']          = stripslashes(trim($send_mail));
		
		    $mail_config['from']        = $template[0]['responce_email'];
		    $mail_config['from_name']   = 'Hostelmofo Team';
		    $mail_config['subject']     = $template[0]['email_subject'];
		
		    $mail_config['message']     = $template[0]['email_content'];
		    $property_name              = $this->model_basic->getValue_condition('hw_property_master', 'property_name', '', 'property_master_id='.$property_id.'');
		    
		    $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$email,($phone != '' ? $phone : 'N/A'),$payment_status,$property_name),stripslashes($mail_config['message']));
		    
		    $mailsend_admin               = send_html_email($mail_config);
		    
		    $usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
		    
		    $mail_config['to']          = $email;
		    $mail_config['from']        = $usertemplate[0]['responce_email'];
		    $mail_config['from_name']   = 'Hostelmofo Team';
		    $mail_config['subject']     = $usertemplate[0]['email_subject'];
		    
		    $mail_config['message']     = $usertemplate[0]['email_content'];
		
		    $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$payment_status,$property_name),stripslashes($mail_config['message']));
		    
		    if ($response['result'] == SECUREPAY_STATUS_APPROVED)
		    {
			$mailsend_user		= send_html_email($mail_config);
		    }
		
		} 
		else
		{
	    
		    if (!$sp->ValidCc())
		    {
			$errmsg =  "Credit Card Number is invalid\n";
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    elseif (!$sp->ValidExpiryDate())
		    {
			$errmsg =  "Expiry Date is invalid\n";
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    elseif (!$sp->ValidCvv())
		    {
			$errmsg =  "CVV is invalid\n";
			
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    elseif (!$sp->ValidChargeAmount())
		    {
			$errmsg =  "Charge Amount is invalid\n";
			
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    elseif (!$sp->ValidChargeCurrency())
		    {
			$errmsg =  "Charge Currency is invalid\n";
			
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    elseif (!$sp->ValidOrderId())
		    {
			$errmsg =  "Order ID is invalid\n";
			
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
		    else
		    {
			$errmsg =  "All data is valid\n";
			
			$json_message 	= $errmsg;
			$msg_code	= 2;
		    }
	    
		}
	 
	}
	else
	{
	    $send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
	    $template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
		
	    $mail_config['to']          = stripslashes(trim($send_mail));
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
	    
	    $mailsend_user               = send_html_email($mail_config);
		
	}
	
	$response_message = array('status' => $msg_code, 'message' => $json_message);
	    
	$this->response($response_message, 200);
     
    }
    
    function propertysettingprice_post()
    {
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
    
    function cityhostelalllist_get()
    {
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
    

}