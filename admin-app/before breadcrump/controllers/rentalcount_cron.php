<?php
class Rentalcount_cron extends My_Controller{	
	
	var $kigoMaster	        	= 'lp_kigo_data';
	var $RentMaster             	= 'lp_rent_master';
	var $propertyAvailability   	= 'lp_property_availibility';
	var $EnquiryMaster		= 'lp_enquiry_master';
	var $customBooking 		= 'lp_custom_booking';
	
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rentalcount');
		$this->load->model('model_kigo');
		$this->load->model('model_basic');
		set_time_limit(0);
	}

	public function index()
	{

		$record = $this->model_rentalcount->getAllcount(); 	// Get total count of rental property for each location
		foreach($record as $row){
		 $update = $this->model_rentalcount->update_rental_count($row['location_id'],$row['total_count']);  // update 
		}
	}
	
	public function reservation(){
		
		//$to = "rahul.singh@webskitters.com";
		//$subject = date('d:m:Y H:i:s')."FROM CRON : cron test for livephuket Test mail";
		//$message = "Hello! This is a simple email message. cron test for livephuket Test mail";
		//$message.= "Send from ".FRONTEND_URL;
		//$from = "kalyan.dey@webskitters.com";
		//$headers = "From:" . $from;
		////echo $to."<br /><br />".$subject."<br /><br />".$message."<br /><br />".$headers."<br /><br />";
		////echo
		//@mail($to,$subject,$message,$headers);
		////exit;
		
		$username = 'livephuket';
		$password = 'qqoeUgWdW';
		
		
		
		$kigoProp = array();
		$this->model_kigo->truncateKigo( $this->kigoMaster );
		$kigoProp = $this->model_kigo->get_kigo_property();

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://app.kigo.net/api/ra/v1/diffPropertyCalendarReservations');
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, true );
		$queryString = array("DIFF_ID" => null);
		$queryString = json_encode($queryString);
		$request_headers    = array();
		$request_headers[]  = 'Host: app.kigo.net';
		$request_headers[]  = 'Content-Type: application/json';
		
		
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $request_headers);
		//curl_setopt( $ch, CURLOPT_HTTPHEADER, true );
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $queryString);
		//$info = curl_getinfo($ch);        
		$response = curl_exec( $ch );        
		curl_close( $ch );
		$response = json_decode($response);
		//pr($response);
		$insertArr = array();
		if( isset($response->API_REPLY->RES_LIST) && is_array($response->API_REPLY->RES_LIST) ){
		    foreach($response->API_REPLY->RES_LIST as $res){
			if ( is_array($kigoProp) && array_key_exists( $res->PROP_ID , $kigoProp )) {
			    $insertArr = array(
						'property_id' => $kigoProp[$res->PROP_ID]['property_id'] ,
						'RES_ID' =>  $res->RES_ID,
						'PROP_ID' =>  $res->PROP_ID,
						'RES_STATUS' =>  $res->RES_STATUS,
						'RES_CHECK_IN' =>  $res->RES_CHECK_IN,
						'RES_CHECK_OUT' => $res->RES_CHECK_OUT ,
						'RES_IS_FOR' => $res->RES_IS_FOR
					     );
			    $res = $this->model_basic->insertIntoTable($this->kigoMaster,$insertArr);
			}
			else{
			    $insertArr = array(
						'property_id' => 0,
						'RES_ID' =>  $res->RES_ID,
						'PROP_ID' =>  $res->PROP_ID,
						'RES_STATUS' =>  $res->RES_STATUS,
						'RES_CHECK_IN' =>  $res->RES_CHECK_IN,
						'RES_CHECK_OUT' => $res->RES_CHECK_OUT ,
						'RES_IS_FOR' => $res->RES_IS_FOR
					     );
			    $res = $this->model_basic->insertIntoTable($this->kigoMaster,$insertArr);
			}
		    }
		   
		    $this->updatePropertyAvailability();
		    
		}
		return true;
	}
    
    
	private function updatePropertyAvailability(){
        //$this->model_kigo->truncateKigo( $this->propertyAvailability );
	//$this->model_kigo->deleteDataKigo( $this->propertyAvailability );
	$this->model_kigo->deleteDataKigo();
        $booked = $this->model_kigo->getBookedProperty();
        $i=0;
	if(is_array($booked) && count($booked)){
		foreach($booked as $b){
			$begin = new DateTime( $b['RES_CHECK_IN'] );
			$end = new DateTime(  $b['RES_CHECK_OUT'] );                
			$interval = DateInterval::createFromDateString('1 day');                
			//$end->add($interval);
			
			$period = new DatePeriod($begin, $interval, $end);
			$insertArr = array();
			foreach ( $period as $dt ){
			    $date = new DateTime( $dt->format( "Y-m-d" ) );
			    $timestamp =  $date->getTimestamp();
			    
			    $insertArr = array(
						'property_id' => $b['property_id'],
						'KIGO_RES_ID' =>  $b['RES_ID'],
						'KIGO_PROP_ID' =>  $b['PROP_ID'],
						'avail_date_format' =>  $dt->format( "Y-m-d" ),
						'avail_timestamp_format' => $timestamp ,
						'avail_status' => 'KA',
						'date_added' => date('Y-m-d H:i:s')
					     );
			    $res = $this->model_basic->insertIntoTable($this->propertyAvailability,$insertArr);
			    $i ++;
			}
			
		}
	}
	return true;
    }
    

	public function resendenquirymails(){
		
		$enqmails = $this->model_basic->getValues_conditions($this->EnquiryMaster, '*', '', 'added_on >= now() - INTERVAL 24 HOUR AND is_mail_send = "no"', 'added_on', 'DESC');
		//pr($enqmails);
		if($enqmails){
			$property = array();
			foreach($enqmails as $mails){
				//pr($mails,0);
				if( $mails['property_id'] > 0 ){
					$property = $this->model_rentalcount->get_property_info($mails['property_id'],$mails['sales_rentals']);
				}
				else{
					$property['optional_title']	=	'';
					$property['location_name']	=	'';
					$property['bedrooms']		=	'';
					$property['property_slug']	=	'';
				}
				
				//pr($property,0);
				$data['name']			= $mails['contact_name'];
				$data['email']			= $mails['email_address'];
				$data['phone']			= $mails['phone'];				
				$data['guest']			= $mails['guest'];
				$data['children']		= $mails['children'];
				$data['check_in']		= $mails['check_in_time'];
				$data['check_out']		= $mails['check_out_time'];
				$data['currency']		= '';
				$data['total_price']		= $mails['total_price'];
				$data['price_per_night']	= $mails['per_night_price'];				
				$data['message']		= $mails['notes'];
				$data['ip_address']		= $mails['ip_address'];
				$data['country']		= $mails['country'];
				$data['location']		= $mails['location'];
				$data['received_on']		= $mails['added_on'];
				$data['frontend_url']		= FRONTEND_URL;
				$data['text_title']		= '';
				$data['pg_name']		= $mails['mail_subject'];
				$data['enq_id']			= $mails['enquiry_id'];
				$data['opt_title']		= $property['optional_title'];
				$data['loc_name']		= $property['location_name'];
				$data['bed']			= $property['bedrooms'];
				$data['price']			= $property['price'];
				$data['currency_code']		= $mails['currency_code'];
				$data['currency']		= $mails['currency_symbol'];
				$data['sleep']			= 'N/A';
				
				$data['prop_slug']  		= $property['property_slug'];
				
				if( $mails['sales_rentals'] == 'Sales' ){
					if( $mails['property_id'] > 0 ){
						$data['property_name'] = $property['optional_title'];
						$data['property_url']  = FRONTEND_URL.'property-sales/'.$property['property_slug'].'/';	
					} else {
						$data['property_name'] = '';
						$data['property_url']  = '';	
					}
					
					$message = $this->load->view('email_templates/sales_enquiry_new',$data, true);
				}
				else if( $mails['sales_rentals'] == 'Rental' ){
					if( $mails['property_id'] > 0 ){						
						$data['property_name'] = $property['optional_title'].' - '.$property['page_title'];
						$data['property_url']  = FRONTEND_URL.'property-rentals/'.$property['property_slug'].'/';					
					} else {
						$data['property_name'] = '';
						$data['property_url']  = '';	
					}
					$message = $this->load->view('email_templates/rental_enquiry_new',$data, true);
				}
				
				else{
					$data['property_name'] = '';
					$data['property_url']  = '';	
					$message = $this->load->view('email_templates/general_enquiry_new',$data, true);
				}
				
				$to	  	= $this->model_basic->get_settings(18);
				if(isset($to['enquery_email']) &&  !empty($to['enquery_email']))
					$to_email = $to['enquery_email'];
				else
					$to_email = 'livephuketcontact@webskitters.com';
					
				$email_pos = $mails['email_address'];
				if (preg_match('/webskitters/',$email_pos))						
					$to_email = 'debamala.dey@webskitters.com';
				
				$mail_config['to']		= $to_email;
				//$mail_config['to']		= 'rahul.singh@webskitters.com';
				$mail_config['from']		= $mails['email_address'];
				$mail_config['from_name']	= $mails['contact_name'];
				$mail_config['subject']		= $mails['mail_subject'];
				$mail_config['message']		= $message;
				//pr($mail_config,0);
				//echo '--bbbb<br />';
				$ccEmail			= '';
				$blank_array 			= array();
				$is_send 			= send_html_email($mail_config,$ccEmail);
				//echo $is_send.'--aaaa<br />';
				if($is_send){
					if($mails['enquiry_id']){
						$idArr  = array('enquiry_id' => $mails['enquiry_id']);
						$updateArr  = array('is_mail_send' => 'yes');
						$update = $this->model_basic->updateIntoTable($this->EnquiryMaster, $idArr, $updateArr);
						//echo "MAil Send<br />";
					}
				}
				
				//exit;
			}
			
		}
		
	}
	
	public function ical_update(){ 
		$this->load->library('ical');
		/// Get all property
		$records = $this->model_basic->getValues_conditions($this->RentMaster, array('property_id','manage_by','kigo_id','ical_url'),'', 'manage_by != "KA" AND manage_by != "NA" ', 'property_id', 'ASC', '');
		
		/*Delete old data for each rental property from ical master availibility table */
		$this->model_kigo->truncateKigo( 'lp_ical_master' );
		$del = $this->model_kigo->truncateKigo( 'lp_property_availibility' );
		
		$x = 0;
		$total_records = count($records);
		echo 'Total Numberof Record to be update : #'.$total_records ;
		//echo '<br><br>[Note: Check last No. of Record Updated when page loading is comepleted it must be equal to Total Numberof Record to be update]';
		if(is_array($records) && count($records)){
			$inserted_arr = $not_found = array();
			foreach($records as $property){ $x++;
				/**** Get ical data from url *******/
				
				$icalurl =  $property['ical_url'] ;
				
				if($icalurl && $property['manage_by'] != 'NA' && $property['manage_by'] != 'KA' && $property['ical_url'] != ''){
					
					$content	= array();
					$result		= array();
					
					$content_str 	= @file_get_contents($icalurl);
					$content 	= explode(PHP_EOL, $content_str);
					
					if( $content_str && $content && is_array($content) && count($content)){
						$this->ical->read($content);
						$result = $this->ical->get_event_array();						
					}else{
						echo '<br><br>iCal Not Found and try again for property #'.$property['property_id'];
						
						$content_str 	= @file_get_contents($icalurl);
						$content 	= explode(PHP_EOL, $content_str);
						
						if( $content_str && $content && is_array($content) && count($content)){
							echo '<br>iCal Found and update for property #'.$property['property_id'].'<br>';
							$this->ical->read($content);
							$result = $this->ical->get_event_array();						
						}else{
							
							$not_found[$property['property_id']] = $icalurl;
							
						}
					}
					
					$y = 0;
					if( $result && count($result)>0){						
						foreach($result  as $cal){ $y++;
							if(!in_array($property['property_id'].'-'.$cal['DTSTART'].'-'. $cal['DTEND'],$inserted_arr)){
								
							$inserted_arr[] = $property['property_id'].'-'.$cal['DTSTART'].'-'. $cal['DTEND'];
							
							$dtstart = $dtend = $summary = $description = '' ;
							if(isset($cal['DTSTART'])){ $dtstart = $cal['DTSTART']; }
							if(isset($cal['DTEND'])){ $dtend = $cal['DTEND']; }
							if(isset($cal['SUMMARY'])){ $summary = mysql_real_escape_string($cal['SUMMARY']); }
							if(isset($cal['SUMMARY;VALUE=TEXT'])){ $summary = mysql_real_escape_string($cal['SUMMARY;VALUE=TEXT']); }
							if(isset($cal['DESCRIPTION'])){ $description = mysql_real_escape_string( $cal['DESCRIPTION']); }
							
							$insertArr  = array(
									    'ical_property_id'  => $property['property_id'],
									    'ical_dtstart'      => $dtstart,
									    'ical_dtend' 	=> $dtend,
									    'ical_summary'	=> $summary,
									    'ical_description'	=> $description,
									    );
							$this->model_basic->insertIntoTable('lp_ical_master',$insertArr); // ical master
							
							// Availability
							$datetime1 = new DateTime($dtstart);
							$datetime2 = new DateTime($dtend);
							$interval = $datetime1->diff($datetime2);
							$tot_days = $interval->days;
							
							for($i = 0; $i < $tot_days; $i++){
								$avl_date  = $datetime1->format('Y-m-d');
								$timestamp = $datetime1->format('U');
								$insertArr  = array(
									    'property_id'  		=>$property['property_id'],
									    'avail_date_format'         => $avl_date,
									    'avail_timestamp_format' 	=> $timestamp,
									    'avail_status'		=> $property['manage_by'],
									    'date_added'		=>date('Y-m-d'),
									    );
								$this->model_basic->insertIntoTable('lp_property_availibility',$insertArr); // ical avaibality
								$datetime1->modify('+1 day');
							}
							}
						echo '<br />Property ID: #'.$property['property_id'].' &nbsp; Record Updated: #'.$x.' &nbsp; Y = '.$y;
						}
						
					}//result block
					
				} // if ical url
				
			}// records 4 each
		
		}// if records
		//pr($not_found);
		if(is_array($not_found) && count($not_found)){
			$this->ical_update_for_failed_properties($total_records,$not_found);
		}
		$this->reservation(); 
	}
	
	public function ical_update_for_failed_properties($total_records, $records){
		
		echo '<br><br>ReCall update after 5 Minutes, for failure '.count($records).'/'.$total_records.' properties <br><br>';
		
		sleep(300);
		
		$x = 0;
		$inserted_arr = array();
		$not_found_msg = '';
		
		foreach($records as $key=>$value){ $x++;
			
			$icalurl =  $value ;
			$content = $result = array();
			$content_str 	= @file_get_contents($icalurl);
			$content 	= explode(PHP_EOL, $content_str);
			
			if( $content_str && $content && is_array($content) && count($content)){
				$this->ical->read($content);
				$result = $this->ical->get_event_array();						
			}else{
				echo '<br><br>iCal Not Found and try again for property #'.$key;
				$content_str 	= @file_get_contents($icalurl);
				$content 	= '';//explode(PHP_EOL, $content_str);
				
				if( $content_str && $content && is_array($content) && count($content)){
					echo '<br>iCal Found and update for property #'.$key;
					$this->ical->read($content);
					$result = $this->ical->get_event_array();						
				}else{
					$not_found_msg .= '<tr>';
					$not_found_msg .= '<td>'.$key.'</td>';
					$not_found_msg .= '<td>'.$value.'</td>';
					$not_found_msg .= '</tr>';
				}
			}
			$y = 0;
			if( $result && count($result)>0){						
				foreach($result  as $cal){ $y++;
					if(!in_array($key.'-'.$cal['DTSTART'].'-'. $cal['DTEND'],$inserted_arr)){
					$inserted_arr[] = $key.'-'.$cal['DTSTART'].'-'. $cal['DTEND'];
					$dtstart = $dtend = $summary = $description = '' ;
					if(isset($cal['DTSTART'])){ $dtstart = $cal['DTSTART']; }
					if(isset($cal['DTEND'])){ $dtend = $cal['DTEND']; }
					if(isset($cal['SUMMARY'])){ $summary = mysql_real_escape_string($cal['SUMMARY']); }
					if(isset($cal['SUMMARY;VALUE=TEXT'])){ $summary = mysql_real_escape_string($cal['SUMMARY;VALUE=TEXT']); }
					if(isset($cal['DESCRIPTION'])){ $description = mysql_real_escape_string( $cal['DESCRIPTION']); }
					
					$insertArr  = array(
							    'ical_property_id'  => $key,
							    'ical_dtstart'      => $dtstart,
							    'ical_dtend' 	=> $dtend,
							    'ical_summary'	=> $summary,
							    'ical_description'	=> $description,
							    );
					$this->model_basic->insertIntoTable('lp_ical_master',$insertArr); // ical master
					
					// Availability
					$datetime1 = new DateTime($dtstart);
					$datetime2 = new DateTime($dtend);
					$interval = $datetime1->diff($datetime2);
					$tot_days = $interval->days;
					
					for($i = 0; $i < $tot_days; $i++){
						$avl_date  = $datetime1->format('Y-m-d');
						$timestamp = $datetime1->format('U');
						$insertArr  = array(
							    'property_id'  		=> $key,
							    'avail_date_format'         => $avl_date,
							    'avail_timestamp_format' 	=> $timestamp,
							    'avail_status'		=> 'K',
							    'date_added'		=>date('Y-m-d'),
							    );
						$this->model_basic->insertIntoTable('lp_property_availibility',$insertArr); // ical avaibality
						$datetime1->modify('+1 day');
					}
					}
				echo '<br />Property ID: #'.$key.' &nbsp; Record Reupdated : #'.$x.' &nbsp; Y = '.$y;
				}
				
			}//result block
			
		}// records 4 each
		
		if($not_found_msg){
			$msg  = '<br>Total No. of Records <strong>#'.$total_records.'</strong>';
			$msg .= '<p>Some Properties listed bellow where iCal not found or server failure. Please update these property manualy </p>';
			$msg .= '<table>';
			$msg .= '<thead>';
			$msg .= '<tr><th>Property ID</th><th>iCal URL</th></tr>';
			$msg .= '</thead>';
			$msg .= '<tbody>';
			$msg .= $not_found_msg;
			$msg .= '<tbody>';
			$msg .= '<table>';
			
			// Error reporting on email
			$to	  	= $this->model_basic->get_settings(18);
			if(isset($to['enquery_email']) &&  !empty($to['enquery_email']))
				$to_email = $to['enquery_email'];
			else
				$to_email = 'livephuketcontact@webskitters.com';
				
			
			$mail_config['to']		= $to_email;
			$mail_config['from']		= 'info@livephuket.com';
			$mail_config['subject']		= 'Livephuket: Availability Error Reporting';
			$mail_config['message']		= $msg;
			$ccEmail			= 'rahul.singh@webskitters.com';
			$bccEmail 			= 'samim.almamun@webskitters.com';
			$is_send 			= send_email($mail_config,'',$ccEmail,$bccEmail);
			
			echo $msg;
		}

	}
	
	
	public function custombooking_expired(){
		
		$expiredbooking = $this->model_basic->getValues_conditions($this->customBooking, array('cb_id','custom_key','is_used','expired','cb_added_on'), '', 'cb_added_on < ( now() - INTERVAL 48 HOUR ) AND is_used = "no" AND expired = "no" ', 'cb_added_on', 'DESC');
		//pr($expiredbooking,0);
		if(is_array($expiredbooking) && count($expiredbooking)){
			foreach($expiredbooking as $record){
				$idArr = array("cb_id" => $record['cb_id']);
				$updateArr = array("expired" => "yes");
				$this->model_basic->updateIntoTable($this->customBooking, $idArr, $updateArr);
			}
		}
		
	}
	
	
	public function setfeaturedimage(){
		
		$properties = $this->model_basic->getValues_conditions('lp_property_master', array('property_id','feature_image_name','image_count'), '', '', 'property_id', 'ASC');
		//pr($properties);
		if($properties){
			foreach($properties as $p){
				
				$imgsql = "SELECT image_file_name,big_image_width, big_image_height,is_featured FROM lp_property_image WHERE property_id = '".$p['property_id']."' ORDER BY is_featured ASC";
				$imgquery = $this->db->query($imgsql);	
						
				if($imgquery->num_rows() > 0){
					$imgresult = $imgquery->row_array();
					$totalImages = $imgquery->num_rows();
					$image_file_name = $imgresult['image_file_name'];
				}else{
					$totalImages = 0;
					$image_file_name = '';	
				}
				$idArr  = array('property_id' => $p['property_id']);
				$updateArr  = array('feature_image_name' => $image_file_name, 'image_count' => $totalImages);
				$update = $this->model_basic->updateIntoTable('lp_property_master', $idArr, $updateArr);
				
				//pr($idArr,0);pr($updateArr,0);
			}
		}
	
	}	
	
}