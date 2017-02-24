<?php
class Grp_property extends MY_Controller{
    
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_grpproperty');
		$this->load->model('model_property');
		$this->load->model('model_review');
	}
        
	public function checkGrpAvailable(){
		$checkin 		= $this->input->post('checkin');
		$checkout 		= $this->input->post('checkout');	
		$property_id 	= $this->input->post('property_id');
		$groupType 		= $this->input->post('groupType');
		$ageGroup		= $this->input->post('ageGroup');
		$is_available 	= $this->model_grpproperty->availableGrpDate($checkin,$checkout,$property_id,$groupType,$ageGroup);
		echo json_encode($is_available);
		//echo $is_available;
	}
        
   
	public function groupconfirmbooking(){ 
		$this->data 	= "";
	
		$sess_id 		= $this->nsession->userdata('session_id');
		$currencyRate 	= $this->nsession->userdata('currencyRate');
	
		$usd_rate 						= $this->model_basic->getValues_conditions('hw_currency_master', 'currency_rate', '', "country_currency_id = '3'");
		$this->data['usd_currency_rate']= $usd_rate[0]['currency_rate'];
		$record_exist_bookingtemp 		= $this->model_basic->isRecordExist('hw_booking_temp','session_id = "'.$sess_id.'"');
	
		if(isset($_POST['room_type_id']) && $_POST['room_type_id'] > 0){   
			
			$room_type_id 		= $this->input->post('room_type_id');
			$room_type_id 		= implode(",",$room_type_id);
			$no_room 	  		= $this->input->post('no_room');
			$no_room 	  		= implode(",",$no_room);
			
			$room_name 			= $this->input->post('room_name');
			$room_name 			= implode(',',$room_name);
			$hosteltype 		= $this->input->post('hosteltype');
			$hosteltype			= implode(',',$hosteltype);
			
			$tot_room_price 	= $this->input->post('tot_room_price');
			$total_room_price	= array();
			
			foreach($tot_room_price as $trp){
				$tot_room_price1 = $trp/$currencyRate;
				array_push($total_room_price,$tot_room_price1);
			}
		
			$tot_room_price 	= implode(",",$total_room_price);
			$room_price 		= $this->input->post('room_price');
		
			$room_price_array = array();
			foreach($room_price as $rp){
				$room_price1 = $rp/$currencyRate;
				array_push($room_price_array,$room_price1);
			}
			$room_price 		= implode(",",$room_price_array);
		
			if($room_type_id <> ''){
				$no_person = $this->model_basic->getValues_conditions('hw_agent_roomtype', array('size'), '', "id IN (".$room_type_id.")");
				foreach($no_person as $person){
					$persons[] = $person['size']; 
				}
			}
			
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
		
			$insrArr =  array(
								'session_id' 		=> $sess_id,
								'bookingType'		=> 'GroupBooking',
								'pslug' 			=> $this->input->post('pslug'),
								'room_name' 		=> $room_name,
								'hosteltype' 		=> $hosteltype,
								'room_type_id'		=> $room_type_id,
								'no_of_person'		=> implode(',',$persons),
								'deal_id' 			=> $this->input->post('deal_id'),
								'property_id'		=> $this->input->post('property_id'),
								'currency_name'		=> $this->nsession->userdata('currencyCode'),
								'property_price'	=> sprintf('%.2f',($this->input->post('property_price_total')/$currencyRate)),
								'check_in' 			=> $ci_date,
								'check_out'			=> $co_date,
								'total_day'			=> $total_day,
								'person' 			=> implode(',',$persons),
								'no_room'			=> $no_room,
								'tot_room_price'	=> $tot_room_price,
								'room_price'		=> $room_price,
							);
			
			//pr($insrArr,0);
			
			$this->model_basic->insertIntoTable('hw_booking_temp',$insrArr);
		}
	
		$this->data['booking_data']	= $this->model_basic->getValues_conditions('hw_booking_temp','','','session_id = "'.$sess_id.'" ORDER BY id DESC LIMIT 0,1');
	
		if(isset($this->data['booking_data']) && is_array($this->data['booking_data']) && count($this->data['booking_data'])>0){   
			foreach($this->data['booking_data'] as $book_data){
				$booking_type 		= $book_data['bookingType'];
				$property_slug 		= $book_data['pslug'];
				$room_type_id 		= $book_data['room_type_id'];
				$no_of_person 		= $book_data['no_of_person'];
				$deal_id 			= $book_data['deal_id'];
				$property_id 		= $book_data['property_id'];
				$session_id 		= $book_data['session_id'];
			}
		}
	
		$this->data['property_slug'] 	= $property_slug;
		$this->data['property_id'] 		= $property_id;
		$this->data['details']			= $this->model_property->getPropertyDetails($property_slug);
		$this->data['country_list']  	= $this->model_basic->getValues_conditions('hw_countries','','','','countryName','ASC');
		$this->data['country_phone']  	= $this->model_basic->getValues_conditions('hw_country_code','','','','nicename','ASC');
		$this->data['walletBlns']		= $this->model_property->getWalletBalance();
	
		$property_type					= $this->data['details']['master_details']['property_type_id'];
		$property_type_slug				= $this->data['details']['master_details']['property_type_slug'];
		$city_slug 						= $this->data['details']['master_details']['city_slug'];
		$location 						= stripslashes($this->data['details']['master_details']['property_name']).', '.$this->data['details']['master_details']['city_name'].', '.$this->data['details']['master_details']['province_name'];
		$this->data['check_in'] 		= $this->input->post('check_in');
		$this->data['check_out'] 		= $this->input->post('check_out');
		$this->data['guest'] 			= $this->input->post('no_guest');;
	
		$breadcrumb_arr 	= array(); 
		$breadcrumb_arr 	= array( array('text'=>'Australia','link'=>'javascript:void(0)') );	 
		$breadcrumb_arr[]	= array('text'=>$location,'link'=>'');
		$breadcrumb_arr[] 	= array('text'=>$city_slug,'link'=>''); 
	
		$group_type = '';
		$age_ranges = '';
	
		if(count($this->data['details'])==0){
			redirect(FRONTEND_URL.'page-not-found/');
		}
	
		$this->data['downpayment'] 				= $this->data['details']['master_details']['deposite_amount'];
		$this->data['service_fees'] 			= $this->data['details']['master_details']['service_fees'];
		$this->data['downpayment_amount'] 		= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 20");
		$this->data['flexible_amount'] 			= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 21");
		$this->data['standard_flexible_amount'] = $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value','',"sitesettings_id = 21");
		
		$middle_view 							= 'property/confirm_booking';
	
	
		$title 	= $this->data['details']['master_details']['meta_title'];
		$desc 	= $this->data['details']['master_details']['meta_description'];
		$key 	= $this->data['details']['master_details']['meta_keyword'];
		$featured_image = '';
	
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
						'image'		=> $featured_image,
						'title'		=> $title,
						'link'		=> "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
					)
		);
		
	
		if($this->input->post('action') == 'Process'){
		
			$this->load->library('securepay');
		
			$wallet_balance     	= $this->input->post('wallet_balance');
			$property_id        	= $this->input->post('property_id');
			$room_type_id			= $this->input->post('room_id');
			$property_price     	= $this->input->post('property_price');
			$payble_amount  		= $this->input->post('payble_amount');
			$downpayment     		= $this->input->post('downpayment');
			$usd_balance			= $this->input->post('usd_balance');
			$discount_type			= $this->input->post('discount_type');
			$discount_amount		= $this->input->post('discount_amount');
			$booking_type 			= $this->input->post('booking_type'); 
			$first_name         	= trim($this->input->post('first_name'));
			$last_name          	= trim($this->input->post('last_name'));
			$email              	= trim($this->input->post('email1'));
			$nationality        	= trim(addslashes($this->input->post('nationality')));
			$arrival_time       	= trim(addslashes($this->input->post('arrival_time')));
			$arrival_time1       	= trim(addslashes($this->input->post('arrival_time1')));
			$text_sms           	= trim(addslashes($this->input->post('text_sms')));
			$gender             	= trim(addslashes($this->input->post('gender')));
			$prefix_phone       	= trim(addslashes($this->input->post('prefix_phone')));
			$suffix_phone       	= trim(addslashes($this->input->post('suffix_phone')));
			$new_user_id        	= trim(addslashes($this->input->post('new_user_id')));
			$cc_number          	= $this->input->post('cc_number');
			$exp_date           	= $this->input->post('exp_date');
			$cvv                	= $this->input->post('cvv');
			$check_in 				= $this->input->post('check_in');
			$check_out 				= $this->input->post('check_out');
			$chkin 					= explode('/',$check_in);
			$chkout 				= explode('/',$check_out);
			$dataArr['nationality']	= $nationality;
			$dataArr['gender']     	= $gender;
		
		
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
					$dataArr['nationality'] = $user[0]['nationality'];
					$dataArr['gender']      = $user[0]['gender'];
				}
				else{
					$this->model_basic->updateIntoTable(USER,array('id'=>$new_user_id),array('nationality'=>$nationality,'gender'=>$gender));
				}
			}
			else{
				$dataArr['first_name']  	= addslashes($first_name);
				$dataArr['last_name']       = addslashes($last_name);
				$dataArr['email']           = addslashes($email);
				$dataArr['arrival_time']    = $arrival_time;
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
			$dataArr['bookingType']	    	= 'GroupBooking';
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
			
			//$dataArr['check_in']            = '';
			//$dataArr['check_out']           = '';
			//
			//if(is_array($chkin) && is_array($chkout) && count($chkin)>1 && count($chkout)>1){
			//	$dataArr['check_in']  = $chkin[2]."-".$chkin[1]."-".$chkin[0];
			//	$dataArr['check_out'] = $chkout[2]."-".$chkout[1]."-".$chkout[0];
			//}
		
			/*******correct upto***************/
		
			$balanceAmount = round($property_price/$this->nsession->userdata('currencyRate')) - $payble_amount;
		
			if($wallet_balance > $payble_amount || $wallet_balance == $payble_amount){ 
				$dataArr['note']		    	= "wallet amount:".$wallet_balance.",pay amount:0";
				$dataArr['payment_status']	    = "Success";
			
				$insrtArr = array(
								'user_id' 		=> $this->nsession->userdata('USER_ID'),
								'amount'		=> $payble_amount,
								'debit_credit' 	=> 'dr',
								'property_id'	=> $property_id
							);
				
				$ins_id =  $this->model_basic->insertIntoTable('hw_payment_info_temp',$dataArr);
			
				if(!empty($ins_id) && $ins_id >0){
					$this->nsession->set_userdata('payment_id',$ins_id);
					$this->model_basic->updateIntoTable('hw_payment_info_temp',array('paymeny_id'=>$ins_id),array('reference_id'=>getInsID($ins_id)));
					$room_type_id   		= $this->input->post('room_type_id');
					$no_of_person   		= $this->input->post('no_person');
					$no_of_room     		= $this->input->post('no_room');
					$total_price    		= $this->input->post('tot_room_price');
					$room_price     		= $this->input->post('room_price');
					$total_price_per_type  	= $this->input->post('total_price_per_type');
				
					//$daylen = 60*60*24;
					//$total_days  = (strtotime($dataArr['check_out']) - strtotime($dataArr['check_in']))/$daylen;
				
					if(isset($room_type_id)){
						$message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%"><tr><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td><td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td></tr>';                   
						$total = 0;
						$insertArr['payment_id']    = $ins_id;
						for($i=0;$i<count($room_type_id);$i++){
							$insertArr['room_type']     = $room_type_id[$i];
							$insertArr['no_of_room']    = $no_of_room[$i];
							$insertArr['no_of_person']  = $no_of_person[$i];
							$insertArr['total_price']   = round($total_price_per_type[$i]/ $currencyRate,2);
							$insertArr['room_price']    = round($room_price[$i]/ $currencyRate,2);
							$insertArr['property_id']	= $property_id;
							
							$roomtypename = $this->model_basic->getValue_condition('hw_agent_roomtype','type_name','','id='.$insertArr['room_type'].'');
						
							$message .= "<tr>
											<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".ucwords($roomtypename)."</td>
											<td style='border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px;'>".$insertArr['no_of_room']."</td>
											
											<td style='border-bottom :1px solid #ccc;padding: 5px 10px;'>".$this->nsession->userdata('currencySymbol').$insertArr['total_price']."</td>
										</tr>";
							$this->model_basic->insertIntoTable('hw_booking_details_temp',$insertArr);
						}
					
						$message .= '<tr><td colspan="3" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td><td style="padding: 5px 10px;"><b>$ <span>'.$this->nsession->userdata('currencySymbol').round($property_price,2).'</span></b></td></tr></table>';
					}
				
					$payment = $this->model_basic->getValues_conditions('hw_payment_info_temp','','','paymeny_id='.$ins_id);	  
				
					if(count($payment)>0){
						$wallet = $this->model_basic->insertIntoTable(WALLET,$insrtArr);
						$payment[0]['TransactionId']   = 'WL'.$payment[0]['reference_id'];
						$payment_id = $this->model_basic->insertIntoTable('hw_payment_info',$payment[0]);
						$bookingIds = $this->model_basic->getValues_conditions('hw_booking_details_temp','','','payment_id='.$ins_id);
					
						foreach($bookingIds as $ids){
							$details_id = $this->model_basic->insertIntoTable('hw_booking_deatils',$ids);
						};
					
						if(isset($payment_id) && isset($details_id)){
							$send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
							$template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
					
							$mail_config['to']          = stripslashes(trim($send_mail));
							//$mail_config['to']          = 'maantu.das@webskitters.com';
							$mail_config['from']        = $template[0]['responce_email'];
							$mail_config['from_name']   = 'Hostelmofo Team';
							$mail_config['subject']     = $template[0]['email_subject'];
							$mail_config['message']     = $template[0]['email_content'];
							$property_name              = $this->model_basic->getValue_condition('hw_property_master','property_name', '','property_master_id='.$property_id.'');
					
							$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['email'],($phone != '' ? $phone : 'N/A'),$dataArr['payment_status'],stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config['message']));
					
							$mailsend_admin             = send_html_email($mail_config);
							$usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
							
							$mail_config_user['to']          = $dataArr['email'];
							$mail_config_user['to']          = 'maantu.das@webskitters.com';
							$mail_config_user['from']        = $usertemplate[0]['responce_email'];
							$mail_config_user['from_name']   = 'Hostelmofo Team';
							$mail_config_user['subject']     = $usertemplate[0]['email_subject'];
							$mail_config_user['message']     = $usertemplate[0]['email_content'];
							$mail_config_user['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['payment_status'],stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config_user['message']));
					
							$mailsend_user                   = send_html_email($mail_config_user);
					
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
				$dataArr['payment_status']      = 'Pending';
				$expDate						= explode('/',$exp_date);
				$dataArr['card_number']         = $cc_number;
				$dataArr['card_expiry_date']    = $expDate[1].'-'.$expDate[0].'-00';
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
						$sp->TestMode(TRUE);
						$sp->TestConnection();
						$sp->Cc = $cc_number;
						$sp->ExpiryDate = $exp_date;
						$sp->ChargeAmount = $payble_amount;
						$sp->ChargeCurrency = 'USD';
						$sp->Cvv = $cvv;
						$sp->OrderId = $ins_id;//'ORD34235';
						//pr($sp);
						 if (!$sp->ValidCc()) {
									$errmsg =  "Credit Card Number is invalid\n";
						 }elseif (!$sp->ValidExpiryDate()) {
									$errmsg =  "Expiry Date is invalid\n";
						 } elseif (!$sp->ValidCvv()) {
									$errmsg =  "CVV is invalid\n";
						 } elseif (!$sp->ValidChargeAmount()) {
									$errmsg =  "Charge Amount is invalid\n";
						 } elseif (!$sp->ValidChargeCurrency()) {
									$errmsg =  "Charge Currency is invalid\n";
						 } elseif (!$sp->ValidOrderId()) {
									$errmsg =  "Order ID is invalid\n";
						 } else if ($sp->Valid()) { // Is the above data valid?
						$response = $sp->Process();
						if($response['TransactionId'] != '' && isset($response['TransactionId'])){
								  $update_arr['TransactionId']   = $response['TransactionId'];
						}
						if ($response['result'] == SECUREPAY_STATUS_APPROVED){
					
						$dataArr['TransactionId']   	= '1234567890';
					
						$succmsg =  "Transaction has been successfully completed\n";
						$this->nsession->set_userdata('succmsg',$succmsg);
					
						$payment_status                 = 'Success';
						$dataArr['payment_status']   	= 'Success';
					
						$idArr['paymeny_id']            = $ins_id;
					
						if(isset($room_type_id)){ 
							$message = '<table cellspacing="0" cellspadding="0" style="border : 0px;" width="100%"><tr><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Room types chosen</td><td style="border-bottom :1px solid #ccc;border-right :1px solid #ccc;padding: 5px 10px; font-weight: bold;">No. Rooms</td><td style="border-bottom :1px solid #ccc;padding: 5px 10px; font-weight: bold;">Total Price</td></tr>';  
							$total = 0;
						
							for($i=0;$i<count($room_type_id);$i++){
								$insertArr['payment_id']    = $ins_id;
								$insertArr['room_type']     = $room_type_id[$i];
								$insertArr['no_of_room']    = $no_of_room[$i];
								$insertArr['no_of_person']  = $no_of_person[$i];
								//$insertArr['total_price']   = round($total_price_per_type[$i]/ $currencyRate,2);
								//$insertArr['room_price']    = round($room_price[$i]/ $currencyRate,2);
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
						
							$message .= '<tr><td colspan="2" style="border-right :1px solid #ccc;padding: 5px 10px;"><b>Total Price (Rounded off)</b></td><td style="padding: 5px 10px;"><b> <span>'.$this->nsession->userdata('currencySymbol').round($property_price,2).'</span></b></td></tr></table>';
						
						}
						
						
					
						$payment = $this->model_basic->getValues_conditions('hw_payment_info_temp','','','paymeny_id='.$ins_id);
					
						if(count($payment)>0){ 
							$wallet = $this->model_basic->insertIntoTable(WALLET,$insrtArr);
							$payment[0]['TransactionId'] 	= '12345678';
							$payment[0]['payment_status']   = 'Success';
							$bookingIds = $this->model_basic->getValues_conditions('hw_booking_details_temp','','','payment_id='.$ins_id);
							$payment_id = $this->model_basic->insertIntoTable('hw_payment_info',$payment[0]);
							foreach($bookingIds as $ids){
								$bookingId = $this->model_basic->insertIntoTable('hw_booking_deatils',$ids);
							};
					
							$dataArr['payment_status']   = 'Success';
							$dataArr['TransactionId']   = $response['TransactionId'];
							$dataArr['TransactionId']   = '1234567890';
						
					
							if(isset($bookingId) && isset($payment_id)){ 
								$send_mail  = $this->model_basic->getValue_condition(SITESETTINGS, 'sitesettings_value', '', 'sitesettings_id=17');
								$template   = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=7');
							
								$mail_config['to']          = stripslashes(trim($send_mail));
								$mail_config['to']          = 'maantu.das@webskitters.com';
								$mail_config['from']        = $template[0]['responce_email'];
								$mail_config['from_name']   = 'Hostelmofo Team';
								$mail_config['subject']     = $template[0]['email_subject'];
								$mail_config['message']     = $template[0]['email_content'];
								$property_name              = $this->model_basic->getValue_condition('hw_property_master','property_name','','property_master_id='.$property_id.'');
							
								$mail_config['message']     = str_replace(array('{ARRIVINGDATE}','{DEPARTINGDATE}','{ROOMDETAILS}','{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PHONENO}','{PAYMENTSTATUS}','{PROPERTYNAME}','{PAIDAMOUNT}','{BALANCEAMOUNT}'),array(date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_in'])))),date('m-d-Y',strtotime(stripslashes(trim($dataArr['check_out'])))),$message,$dataArr['first_name'],$dataArr['last_name'],$dataArr['email'],($phone != '' ? $phone : 'N/A'),$payment_status,stripcslashes($property_name),$payble_amount,$balanceAmount),stripslashes($mail_config['message']));
							
								$mailsend_admin             = send_html_email($mail_config);
								$usertemplate               = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '',  '', 'template_id=8');
							
								$mail_config_user['to']     	= $dataArr['email'];
								//$mail_config['to']          	= 'maantu.das@webskitters.com';
								$mail_config_user['from']   	= $usertemplate[0]['responce_email'];
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
							
								$errmsg =  "Transaction failed :".$sp->Error."\n";
								$this->nsession->set_userdata('errmsg',$errmsg);	 
							}
						}
					
					}
					else{
							  $errmsg =  "Transaction failed :".$sp->Error."\n";
							  $this->nsession->set_userdata('errmsg',$errmsg);
							  $update_arr['transaction_details'] = addslashes($sp->Error);;
							  $update_arr['payment_status'] = 'failed';
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
	
		
		$this->data['succmsg'] 	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg','');
		$this->nsession->set_userdata('errmsg','');
		
		$this->templatelayout->make_seo($title,$desc,$key,$share);
		$this->templatelayout->get_header();
		
		//$this->templatelayout->get_banner($city_slug,$location,$property_type_slug,$property_type,$property_slug,$this->data['check_in'],$this->data['check_out'],$this->data['guest'],$group_type,$age_ranges,$breadcrumb_arr);
		
		
		$this->templatelayout->get_banner_inner('','Confirm Booking');
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']		= 'property/group_confirm_booking';
		$this->elements_data['middle'] 	=  $this->data;
		
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
	
		$title 	= $this->data['details']['master_details']['meta_title'];
		$desc 	= $this->data['details']['master_details']['meta_description'];
		$key 	= $this->data['details']['master_details']['meta_keyword'];
		$featured_image = '';
		
		if(is_array($this->data['details']['featured_img']) and array_key_exists('image_name',$this->data['details']['featured_img'])){
			$featured_image =  isFileExist(CDN_PROPERTY_BIG_IMG.$this->data['details']['featured_img']['image_name']);
		}
	
		$share = array(
						'og' => array(
										'site_name'=>$title,
										'description'=>$desc,
										'image'=>$featured_image,
										'link'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
									),
						'twitter' => array(
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
		$this->templatelayout->get_banner('','','hostel');
		$this->templatelayout->get_breadcrumb();
		$this->templatelayout->get_footer();
	
	
		if($this->data['payment_info'][0]['bookingType'] == 'deal'){
			$this->elements['middle']	=	'property/deal_success_booking';
		}
		else{
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
}
