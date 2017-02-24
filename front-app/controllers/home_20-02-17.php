<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	var $cmsMaster 			= 'hw_cms';
	var $bannerMaster 		= 'hw_banner_master';
	public function __construct(){
		parent::__construct();
		
		$this->load->model(array('model_basic', 'model_hostel', 'model_city','model_property'));
		$this->load->helper('cookie');
	}
	
	public function get404(){
		$url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$url = preg_replace('~(^|[^:])//+~', '\\1/',$url);
		$newUrl = 'http://'.$url;
		redirect($newUrl);	
	        $this->templatelayout->make_seo();
		$this->templatelayout->get_header('home');
		$this->templatelayout->get_banner();
		$this->templatelayout->get_footer();
		$this->data= '';
		$this->elements['middle']	= 'error/404';			
		$this->elements_data['middle'] 	= $this->data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	  }
	
	public function setfirstTime()
	{
		set_cookie('show_app_view', 'Yes', time() + (10*365*24 * 60 * 60));
		$url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		redirect(FRONTEND_URL);
	}
	
		public function index(){
				create_proper_url();

				//$this->nsession->set_userdata('USER_ID',2);
				//$this->nsession->set_userdata('USER_FIRSTNAME','Tonmoy');
		
				$this->data = "";
				$this->data['arr_featured']					= $this->model_hostel->getFeaturedHostel();		
				$this->data['about_us_content']			= $this->model_basic->getValues_conditions($this->cmsMaster, array('cms_content'), '', ' cms_id = "4" ');		
				$this->data['arr_favourite_places']	= $this->model_city->getFavouritePlaces();		
				$this->data['adventure_location']		= $this->model_city->getCityByType('Adventure');
				$this->data['beach_location']				= $this->model_city->getCityByType('Beach');
				$this->data['city_location']				= $this->model_city->getCityByType('City');
				$this->data['most_review_location']	= $this->model_city->getCityByType('Most Reviewed');
				$this->data['top_rated_location']		= $this->model_city->getCityByType('Top Rated');
				$this->data['popular_location']			= $this->model_city->getCityByType('Popular');
		
				$this->templatelayout->make_seo();
				$this->templatelayout->get_header('home');
				$this->templatelayout->get_banner_home('hostel');
				$this->templatelayout->get_footer();
						
				$this->elements['middle']	= 'home/index';			
				$this->elements_data['middle'] 	= $this->data;			    
				$this->layout->setLayout('home_layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);
				
		}
	
	public function getCityList(){
		$term = $this->input->get('term');
		 
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
		
		//pr($result);
		
		
		echo json_encode($result);
		exit;
		
	}
	
	function facebook(){
		$this->load->view('facebook_login');
	}
	
	public function change_country(){
		
		$countryCode 		= 'AUD';
		$currencySymbol 	= '$';		
		$currencyRate		= 1.00;
		
		$cCode 		= $this->input->get_post('countries');
		$previous_currency = '';		
		$redirect_url		= $this->input->get_post('redirect_url');		
		$arr_redirect_url 	= explode('&currency=', $redirect_url);
		
		if(isset($arr_redirect_url[1]))
		{
			$previous_currency = substr($arr_redirect_url[1],0,3);
		}
		
		if( isset($cCode) &&  $cCode != '' )
			$countryCode = $cCode;
		
		$currencyInfo	= $this->model_basic->getValues_conditions(CURRENCY_MASTER, '*', '','country_code = "'.$countryCode.'" group by currency_code ');
		if($currencyInfo[0]){
			$currencySymbol 	= $currencyInfo[0]['country_currency_symbol'];
			$currencyCode 		= $currencyInfo[0]['currency_code'];
			$currencyRate		= $currencyInfo[0]['currency_rate']; 
		}
		else {
			$countryCode 		= 'AU';
			$currencySymbol 	= '$';
			$currencyCode		= 'AUD';
			$currencyRate		= 1.00; 
		}
		
		if($previous_currency == '')
		{
			$previous_currency = $currencyCode;
		} 
		$this->nsession->set_userdata('currencySymbol',$currencySymbol);
		$this->nsession->set_userdata('countryCode',$countryCode);
		$this->nsession->set_userdata('currencyCode',$currencyCode);
		$this->nsession->set_userdata('currencyRate',$currencyRate); 
		$this->nsession->set_userdata('previousCurrency', $previous_currency);
		
		if( isset($redirect_url) && !empty($redirect_url) ){
			redirect($redirect_url);		
		}
		else
			redirect(FRONTEND_URL);
		return false;
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
	
	function logout(){
		unset($_SESSION['USER_ID']);
		unset($_SESSION['USER_FIRSTNAME']);
		redirect(FRONTEND_URL."home");
	}	
	
	
	
	
	
	public function favourite(){
			create_proper_url();
			$this->data='';
			$cms_slug		=	$this->uri->segment(1);
			$this->load->model('model_property');
			$this->data['propertylist']	= array();
			$user_id = $this->nsession->userdata('USER_ID');
			if( isset($user_id) && $user_id > 0 ){
			}
			else {
				redirect(FRONTEND_URL);
			}
			$title = "FAVOURITE PROPERTIES";
			$this->data['propertylist']	= $this->model_property->getFavProperty($user_id);
			//pr($this->data['propertylist']);
			$this->templatelayout->make_seo();
			$this->templatelayout->get_banner_inner('',$title);
			//$this->templatelayout->get_cms_header($cms_slug,$title);
			//$this->templatelayout->get_banner();
			//$this->templatelayout->get_banner('','','hostel');
			//$this->templatelayout->get_footer();
			//$this->templatelayout->get_cms_header();

			$this->templatelayout->get_inner_footer();
			
			$this->elements['middle']	=	'home/favourite';			
			$this->elements_data['middle'] 	= 	$this->data;
					 
			$this->layout->setLayout('details_layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	
	
       public function setFavourite(){
	  $user_id 		= $this->nsession->userdata('USER_ID');
	  $property_slug 	= $this->input->post('property');
	  $status		= $this->input->post('status');
	  $property_id 		= $this->model_basic->getValue_condition(PROPERTY_MASTER, 'property_master_id', '', ' property_slug="'.$property_slug.'" ');
	  if($user_id){
		$isExist = $this->model_basic->isRecordExist(MEMBERS_FAVOURITE, 'user_id="'.$user_id.'" AND property_id="'.$property_id.'"');
		if($isExist==0){
		      $insert_arr= array(
					 'user_id'	=> $user_id,
					 'property_id'	=> $property_id,
					 'db_add_date'	=> date("Y-m-d H:i:s")
					 );
		      $this->model_basic->insertIntoTable(MEMBERS_FAVOURITE,$insert_arr);
		      
		      echo "1";
		}else{
		      $this->model_basic->deleteData(MEMBERS_FAVOURITE, 'user_id="'.$user_id.'" AND property_id="'.$property_id.'"');
		      echo '1';
		}
	  }
	  exit;
       }
       
	public function removefavourite(){
		$favid 	= $this->input->post('favid');  
		$where	= "id = ".$favid." ";
		$this->model_basic->deleteData(MEMBERS_FAVOURITE, $where);
		//$this->nsession->set_userdata('succmsg', "Selected favourite property deleted successfully."); 
		echo 'sucess';
		exit();
	}       
	public function  setFavouriteLogin(){
		  $property_slug 	= $this->input->post('property');
		  $_SESSION['property_name'] = $property_slug;
		  
	}
	public function dealPost(){
            $this->load->library('securepay');
            
				$wallet_balance     = $this->input->post('wallet_balance');
            $property_id        = $this->input->post('property_id');
            $property_price     = $this->input->post('property_price');
				$booking_type 	= $this->input->post('bookingType'); 
	    
            $first_name         = trim($this->input->post('first_name'));
            $last_name          = trim($this->input->post('last_name'));
            $email              = trim($this->input->post('email1'));
            
            $nationality        = trim(addslashes($this->input->post('nationality')));
            $arrival_time       = trim(addslashes($this->input->post('arrival_time')));
				$arrival_time1       = trim(addslashes($this->input->post('arrival_time1')));
            $text_sms           = trim(addslashes($this->input->post('text_sms')));
            $gender             = trim(addslashes($this->input->post('gender')));
            $prefix_phone       = trim(addslashes($this->input->post('prefix_phone')));
            $suffix_phone       = trim(addslashes($this->input->post('suffix_phone')));
            $new_user_id        = trim(addslashes($this->input->post('new_user_id')));
            
            $cc_number          = $this->input->post('cc_number');
            $exp_date           = $this->input->post('exp_date');
            $cvv                = $this->input->post('cvv');
            
            $check_in 		= $this->input->post('check_in');
            $check_out 		= $this->input->post('check_out');
            
            
            $chkin 		= explode('/',$check_in);
            $chkout 		= explode('/',$check_out);
            
				$dataArr['nationality']          = $nationality;
				$dataArr['gender']               = $gender;
            //echo $property_price; //die();
           //echo $property_id.">>".$cc_number.">>".$exp_date.">>".$property_price;
	   
	   if($new_user_id != ''){
		$user = $this->model_basic->getValues_conditions(USER,'','',"id=".$new_user_id);
		$dataArr['first_name']           = $user[0]['firstname'];
		$dataArr['last_name']            = $user[0]['lastname'];
		$dataArr['email']                = $user[0]['email'];
		if($arrival_time1 != ''){
		$dataArr['arrival_time']         = $arrival_time1;
		}else{
		    $dataArr['arrival_time']     = '10 : 10 : AM';
		}
		if($nationality == '' && $gender == ''){
		    $dataArr['nationality']          = $user[0]['nationality'];
		    $dataArr['gender']               = $user[0]['gender'];
		}else{
		    $this->model_basic->updateIntoTable(USER,array('id'=>$new_user_id),array('nationality'=>$nationality,'gender'=>$gender));
		}
	   }else{
		$dataArr['first_name']           = addslashes($first_name);
		$dataArr['last_name']            = addslashes($last_name);
		$dataArr['email']                = addslashes($email);
		$dataArr['arrival_time']         = $arrival_time;
	   }
	   $dataArr['text_sms']             = $text_sms;
	   $dataArr['prefix_phone']         = $prefix_phone;
	   $dataArr['suffix_phone']         = $suffix_phone;
	   $phone 			    = $dataArr['prefix_phone'].$dataArr['suffix_phone'] ;
           $payment_status                  = 'Pending';
           
           $dataArr['user_id']              = $new_user_id;
           $dataArr['property_id']          = $property_id;
           $dataArr['property_price']       = $property_price;           
           $dataArr['booking_from']	    = 'website';
	   $dataArr['payble_amount']	    = $property_price;
           $dataArr['bookingType']	    = 'deal';
	   
	   $dataArr['currency_symbol']     = $this->nsession->userdata('currencySymbol');
	   $dataArr['currency_rate']       = $this->nsession->userdata('currencyRate');
	   $dataArr['currency_name']       = $this->nsession->userdata('currencyCode');
	   $dataArr['discount_type']       = '';
	   $dataArr['discount_amount']     = '';
	   $dataArr['booking_type'] 	   = $booking_type;
	   $dataArr['added_date']           = date('Y-m-d H:i:s');
	     $dataArr['check_in']  = $this->input->post('check_in');
	     $dataArr['check_out'] = $this->input->post('check_out');
	   //pr($dataArr);
	   if($wallet_balance < $property_price){
		$dataArr['payment_status']       = 'Pending';
		$expDate			    = explode('/',$exp_date);
		$dataArr['card_number']          = $cc_number;
		$dataArr['card_expiry_date']     = $expDate[1].'-'.$expDate[0].'-00';
		$dataArr['card_holder_name']     = $this->input->post('cc_holder_name');
		$dataArr['card_type']     	    = $this->input->post('card_type');
		$dataArr['note']		    = "wallet amount:".$wallet_balance.",pay amount:".($property_price-$wallet_balance);
		$property_price			    = $property_price-$wallet_balance;
	    }else if($wallet_balance > $property_price || $wallet_balance == $property_price){
		$dataArr['note']		    = "wallet amount:".$wallet_balance.",pay amount:0";
		$dataArr['payment_status']	    = "Success";
		$property_price			    = 0;
		$succmsg =  "Transaction was a success\n";
                $this->nsession->set_userdata('succmsg',$succmsg);
		$insrArr = array('user_id' 	=> $this->nsession->userdata('USER_ID'),
				 'amount'	=> $wallet_balance,
				 'debit_credit' => 'dr',
				 'property_id'	=> $property_id);
		$this->model_basic->insertIntoTable(WALLET,$insrArr);
		
	    }
	   
	  // pr($dataArr);
           $ins_id =  $this->model_basic->insertIntoTable('hw_payment_info',$dataArr);
	   if($ins_id)
           {
		$deal_id = $this->input->post('deal_id');
                $room_type_id   = $this->input->post('room_type_id');               
                $no_of_person   = $this->input->post('no_person');
		$room_price    = $this->input->post('room_price');
		
                $room_detail	= $this->model_property->getBookedDeal($room_type_id,$no_of_person,$deal_id);
               
                $message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%">
			    <tr><td>Deal Name : </td><td>'.stripslashes($room_detail['deal_details']['deal_name']).'</td></tr>
			    <tr><td>Price : </td><td>'.stripslashes($room_detail['deal_details']['price']).'</td></tr>
                            <tr>
                            <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types</td>
                            <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td>
                            <td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Guests</td>
                            <td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td></tr>';
                if(is_array($room_detail)){
			$total_no_of_person  ='';
		  foreach($room_detail['room_details'] as $rDetails){
			$insertArr['payment_id']    = $ins_id;
			$insertArr['room_type']     = $rDetails['id'];
			$insertArr['no_of_room']    = 1;
			$insertArr['no_of_person']  = $rDetails['room_type_value'];
			$insertArr['total_price']   = number_format($rDetails['room_type_value']*$room_detail['deal_details']['price']*$room_detail['deal_details']['DiffDate'],2);
			$total_no_of_person += $rDetails['room_type_value'];
			$message .= "<tr>
                                <td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".stripslashes($rDetails['type_name'])."</td>
                                <td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>1</td>
                                <td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".stripslashes($rDetails['room_type_value'])."</td>
                                <td style='border-bottom :1px solid #ccc;padding: 5px 10px;'>".number_format($rDetails['room_type_value']*$room_detail['deal_details']['price']*$room_detail['deal_details']['DiffDate'],2)."</td>
                                </tr>";
                    $this->model_basic->insertIntoTable('hw_booking_deatils',$insertArr);
                   }
                }
                $message .= '<tr>
                            <td colspan="3" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td>
                            <td style="padding: 5px 10px;"><b>$ <span>'.number_format($room_detail['deal_details']['price']* $room_detail['deal_details']['DiffDate'] * $total_no_of_person,2).'</span></b></td>
                            </tr>
                            </table>';
            }
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
	    
	    if($property_price>0){
		
            //echo 'ddd'.$cc_number.">>".$exp_date.">>".$cvv."".$property_price;
            //die();
       
            $sp = new SecurePay('ABC0001','abc123');
            $sp->TestMode();
            $sp->TestConnection();
            
	
	    
            //print_r($sp->ResponseXml); die();
            //echo $property_price; die();
            
            $sp->Cc = $cc_number;
            $sp->ExpiryDate = $exp_date;
            $sp->ChargeAmount = $property_price;
            $sp->ChargeCurrency = 'USD';
            $sp->Cvv = $cvv;
            $sp->OrderId = $ins_id;//'ORD34235';
            
            if ($sp->Valid()) { // Is the above data valid?
                $response = $sp->Process();
                //echo "<pre>";print_r($response); die();
		if($response['TransactionId'] != '' && isset($response['TransactionId'])){
		$update_arr['TransactionId']   = $response['TransactionId'];
		}
                if ($response['result'] == SECUREPAY_STATUS_APPROVED) {
                    $succmsg =  "Transaction was a success\n";
                    $this->nsession->set_userdata('succmsg',$succmsg);
                    $payment_status                 = 'Success';
                    $update_arr['payment_status']   = 'Success';
                    $idArr['paymeny_id']            = $ins_id;
                } else {
                   
                    $errmsg =  "Transaction failed :".$sp->Error."\n";
                    $this->nsession->set_userdata('errmsg',$errmsg);
                    
                   $update_arr['transaction_details'] = addslashes($sp->Error);;
                   $idArr['paymeny_id'] = $ins_id;
                    //echo "XML Dump: " . print_r($sp->ResponseXml,1) . "\n";
                }
                $this->model_basic->updateIntoTable('hw_payment_info', $idArr, $update_arr);
           
          

            $send_mail                  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
            $template                   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
            
            $mail_config['to']          = stripslashes(trim($send_mail));
            //$mail_config['to']          = 'nasmin.begam@webskitters.com';
            $mail_config['from']        = $template[0]['responce_email'];
            $mail_config['from_name']   = 'Hostelmofo Team';
            $mail_config['subject']     = $template[0]['email_subject'];
            
            $mail_config['message']     = $template[0]['email_content'];
            $property_name              = $this->model_basic->getValue_condition('hw_property_master', 'property_name', '', 'property_master_id='.$property_id.'');
            
            $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$email,($phone != '' ? $phone : 'N/A'),$payment_status,$property_name),stripslashes($mail_config['message']));
            
            //pr($mail_config['message']);
            
            $mailsend_admin               = send_html_email($mail_config);
            
            $usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
            
            $mail_config['to']          = $email;
            $mail_config['from']        = $usertemplate[0]['responce_email'];
            $mail_config['from_name']   = 'Hostelmofo Team';
            $mail_config['subject']     = $usertemplate[0]['email_subject'];
            
            $mail_config['message']     = $usertemplate[0]['email_content'];
            
            $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$payment_status,$property_name),stripslashes($mail_config['message']));
            
            //pr($mail_config['message']);
            if ($response['result'] == SECUREPAY_STATUS_APPROVED) {
            $mailsend_user               = send_html_email($mail_config);
            
           
            
            }
            
            } 
    else {
        
        if (!$sp->ValidCc()) {
            $errmsg =  "Credit Card Number is invalid\n";
        } elseif (!$sp->ValidExpiryDate()) {
            $errmsg =  "Expiry Date is invalid\n";
        } elseif (!$sp->ValidCvv()) {
            $errmsg =  "CVV is invalid\n";
        } elseif (!$sp->ValidChargeAmount()) {
            $errmsg =  "Charge Amount is invalid\n";
        } elseif (!$sp->ValidChargeCurrency()) {
            $errmsg =  "Charge Currency is invalid\n";
        } elseif (!$sp->ValidOrderId()) {
            $errmsg =  "Order ID is invalid\n";
        } else {
            $errmsg =  "All data is valid\n";
        }
        
        $this->nsession->set_userdata('errmsg',$errmsg);
        //die("Your data is invalid\n");
	}
     //echo 'property/success_booking/'.$property_slug; die();

	    }else{
		 $send_mail                  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
            $template                   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
            
            $mail_config['to']          = stripslashes(trim($send_mail));
            //$mail_config['to']          = 'nasmin.begam@webskitters.com';
            $mail_config['from']        = $template[0]['responce_email'];
            $mail_config['from_name']   = 'Hostelmofo Team';
            $mail_config['subject']     = $template[0]['email_subject'];
            
            $mail_config['message']     = $template[0]['email_content'];
            $property_name              = $this->model_basic->getValue_condition('hw_property_master', 'property_name', '', 'property_master_id='.$property_id.'');
            
            $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$email,($phone != '' ? $phone : 'N/A'),$payment_status,$property_name),stripslashes($mail_config['message']));
            
            //pr($mail_config['message']);
            
            $mailsend_admin               = send_html_email($mail_config);
            
            $usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
            
            $mail_config['to']          = $email;
            $mail_config['from']        = $usertemplate[0]['responce_email'];
            $mail_config['from_name']   = 'Hostelmofo Team';
            $mail_config['subject']     = $usertemplate[0]['email_subject'];
            
            $mail_config['message']     = $usertemplate[0]['email_content'];
            
            $mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}'),array(stripslashes(trim($dataArr['check_in'])),stripslashes(trim($dataArr['check_out'])),$message,$first_name,$last_name,$payment_status,$property_name),stripslashes($mail_config['message']));
	    
	    $mailsend_user               = send_html_email($mail_config);
	    
	    }
	    //echo 'success'; die();
	    $property_slug = $this->input->post('pslug');
		redirect(FRONTEND_URL.'property/success_booking/'.$property_slug);
	}
	
	
	public function profile(){
		create_proper_url();
		$this->data='';
		$cms_slug		=	$this->uri->segment(1);
		$this->data['errmsg'] ='';
		//$this->nsession->set_userdata('errmsg','');
		//$this->nsession->set_userdata('sucmsg','');
		$user_id = $this->nsession->userdata('USER_ID');
		if(!$user_id > 0 && empty($user_id)){
			redirect(FRONTEND_URL);
		}
		$this->data['user_details'] = $this->model_basic->getValues_conditions(USER,'','','id='.$user_id);
		$this->data['country_list'] = $this->model_basic->getValues_conditions('hw_countries','','','','countryName');
		$this->data['country_phone']  	= $this->model_basic->getValues_conditions('hw_country_code','','','','nicename','ASC');
		
		$action = $this->input->post('action');
		
		if(isset($action) && !empty($action) && $action == 'process'){
			
			$first_name = $this->input->post('first_name');
			$lastname = $this->input->post('last_name');
			$email = $this->input->post('email');
			$country_code = $this->input->post('country_code');
			$mobile_no = $this->input->post('phone');
			$birthMonth = $this->input->post('birthMonth');
			$birthDate = $this->input->post('birthDay');
			$birthYear = $this->input->post('birthYear');
			$address = $this->input->post('address');
			$nationality = $this->input->post('nationality');
			$privacy_preference = $this->input->post('privacy_preference');
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('country_code', 'Country Code', 'trim|required');
			$this->form_validation->set_rules('phone', 'Mobile no.', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
			$this->form_validation->set_rules('birthMonth', 'Birth month', 'trim|required');
			$this->form_validation->set_rules('birthDay', 'Birth Day', 'trim|required');
			$this->form_validation->set_rules('birthYear', 'Birth year', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				$this->nsession->set_userdata('errmsg','* fields are mandatory');
				redirect(FRONTEND_URL.'home/profile/');
			}
			else{
				$insertArr = array(
										 'email'=>$email,
										 'firstname'=>$first_name,
										 'lastname'=>$lastname,
										 'country_code'=>$country_code,
										 'mobile_no'=>$mobile_no,
										 'nationality'=>$nationality,
										 'location'=>$address,
										 'birthMonth'=>$birthMonth,
										 'birthDate'=>$birthDate,
										 'birthYear'=>$birthYear,
										 'privacy'=>$privacy_preference);
				$updateUser = $this->model_basic->updateIntoTable(USER,array('id'=>$user_id),$insertArr);
				if($updateUser){
					$this->nsession->set_userdata('USER_FIRSTNAME',$first_name);
					$this->nsession->set_userdata('sucmsg','Your profile updated successfully');
					redirect(FRONTEND_URL.'home/profile/');
				}
			}
			
			
		}
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->data['sucmsg'] = $this->nsession->userdata('sucmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->nsession->set_userdata('sucmsg','');
		$title = "My Profile";
		$this->templatelayout->make_seo();
		//$this->templatelayout->get_header();
		$this->templatelayout->get_cms_header($cms_slug,$title);
		//$this->templatelayout->get_banner();
		//$this->templatelayout->get_banner('','','hostel');
		//$this->templatelayout->get_footer();
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']	=	'home/profile';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function change_password(){
		create_proper_url();
		$this->data = '';
		$cms_slug		=	$this->uri->segment(1);
		$user_id = $this->nsession->userdata('USER_ID');
		if(!$user_id > 0 && empty($user_id)){
			redirect(FRONTEND_URL);
		}
		
		$password = $this->model_basic->getValue_condition(USER,"password","","id='".$user_id."'");
		//echo $password;exit;
		$action = $this->input->post('action');
		if(isset($action) && !empty($action) && $action == 'process'){
			$current_password = trim($this->input->post('current_password'));
			$new_password = trim($this->input->post('new_password'));
			$confirm_password = trim($this->input->post('confirm_password'));
			if( $current_password != $password ){
				$this->nsession->set_userdata('errmsg','Current password does\'t match');
			}
			else if( $current_password == $new_password ){
				$this->nsession->set_userdata('errmsg','New password should not be same as current password');
			}
			else if( $new_password != $confirm_password ){
				$this->nsession->set_userdata('errmsg','New password should match confirm password');
			}
			else{
				$updateArr = array('password'=>$new_password);
				$update = $this->model_basic->updateIntoTable(USER,array('id'=>$user_id),$updateArr);
				if($update){
					$this->nsession->set_userdata('sucmsg','Password changed successfully');
					redirect(FRONTEND_URL.'home/change_password/');
				}
			}
		}
		
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->data['sucmsg'] = $this->nsession->userdata('sucmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->nsession->set_userdata('sucmsg','');
		$title = "Change Password";
		$this->templatelayout->make_seo();
		//$this->templatelayout->get_header();
		//$this->templatelayout->get_cms_header($cms_slug,$title);
		//$this->templatelayout->get_banner();
		//$this->templatelayout->get_banner('','','hostel');
		//$this->templatelayout->get_inner_header();
		$this->templatelayout->get_banner_inner('',$title);
		//$this->templatelayout->get_footer();
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']	=	'home/password';			
		$this->elements_data['middle'] 	= 	$this->data;
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	public function get_group_list(){
		
		$group['group']= $this->model_basic->getValues_conditions(GROUPTYPE,'','','','status="active"');
		$group['age'] = $this->model_basic->getValues_conditions(AGEGROUP,'','','','status="active"');
		$json = json_encode($group);
		echo $json;
	}
	
	
	public function join_with_us(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		
		//$mail_config['to']          = stripslashes(trim($send_mail));
      $mail_config['to']          = 'maantu.das@webskitters.com';
      $mail_config['from']        = $email;
      $mail_config['from_name']   = $name;
      $mail_config['subject']     = "Thank you for join us";
      $mail_config['message']     = "Thank you for joining us. Hostelmofo Team";
      $mailsend               		= send_html_email($mail_config);
		
		if($mailsend){
			echo 'success';
		}
		else{
			echo 'fail';
		}
            
            
	}
	
	
	public function addcard(){
		create_proper_url();
		$this->data='';
		$cms_slug		=	$this->uri->segment(1);
		$this->data['errmsg'] ='';
		//$this->nsession->set_userdata('errmsg','');
		//$this->nsession->set_userdata('sucmsg','');
		$user_id = $this->nsession->userdata('USER_ID');
		if(!$user_id > 0 && empty($user_id)){
			redirect(FRONTEND_URL);
		}
		$user_details = $this->model_basic->getValues_conditions(USER,'','','id='.$user_id);
		$action = $this->input->post('action');
		
		if(isset($action) && !empty($action) && $action == 'process'){
			
			$card_name = $this->input->post('card_name');
			$card_number = $this->input->post('card_number');
			$exp_month = $this->input->post('exp_month');
			$exp_year = $this->input->post('exp_year');

			$this->form_validation->set_rules('card_name', 'Card Name', 'trim|required');
			$this->form_validation->set_rules('card_number', 'Card Number month', 'trim|required');
			$this->form_validation->set_rules('exp_month', 'Expiry Month', 'trim|required');
			$this->form_validation->set_rules('exp_year', 'Expiry Year', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				$this->nsession->set_userdata('errmsg','* fields are mandatory');
				redirect(FRONTEND_URL.'home/profile/');
			}
			else{
				
				$data['first_name'] 	= $user_details[0]['firstname'];
				$data['last_name'] 		= $user_details[0]['lastname'];
				$data['email'] 			= $user_details[0]['email'];
				$data['gender']	    	= $user_details[0]['gender'];
				$data['nationality'] 	= $user_details[0]['nationality'];
				$data['country_code'] 	= $user_details[0]['country_code'];
				$data['phone_number'] 	= $user_details[0]['mobile_no'];
				$data['card_name'] 		= $card_name;
				$data['card_number']	= $card_number;				
				$data['expiry_date']	= $exp_year."-".$exp_month."-01";
				
				$isExists =	$this->model_basic->isRecordExist(USER_CREDIT_CARD,"card_number ='".$data['card_number']."' AND country_code ='".$data['country_code']."' AND phone_number ='".$data['phone_number']."'");
				if($isExists == 0)
				{
				   $this->model_basic->insertIntoTable(USER_CREDIT_CARD,$data);
				   $this->nsession->set_userdata('sucmsg','Card Added successfully');
					redirect(FRONTEND_URL.'home/addcard/');				  
				}
				else
				{
					$this->nsession->set_userdata('errmsg','Card Already Exists');
					redirect(FRONTEND_URL.'home/addcard/');
				}
				
			}
			
			
		}
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->data['sucmsg'] = $this->nsession->userdata('sucmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->nsession->set_userdata('sucmsg','');
		$title = "My Profile";
		$this->templatelayout->make_seo();
		$this->templatelayout->get_cms_header($cms_slug,$title);
		$this->templatelayout->get_banner_inner('',$title);
		$this->templatelayout->get_inner_footer();
		
		$this->elements['middle']	=	'home/add_card';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('details_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}

       
       
}