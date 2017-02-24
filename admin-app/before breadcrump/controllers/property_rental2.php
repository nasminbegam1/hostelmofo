<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_rental2 extends CI_Controller{
    
    var $rentMasterTable        = 'lp_rent_master';
    var $propertyImageTable	= 'lp_property_image';
    var $kigoMaster	        = 'lp_kigo_data';
    var $propertyAvailability   	= 'lp_property_availibility';
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('model_property_sales');
        $this->load->model('model_kigo');
    }
    
    public function images(){
        chk_login();
        $this->data='';
	
	$property_id			= $this->uri->segment(3, 0);
	$page				= $this->uri->segment(4, 0);
	$this->data['page']		= $page;
	$this->data['property_id']	= $property_id;
	$this->data['controller']	= "property_sales";
	
	// Prepare Data
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition,'image_order,property_image_id', 'ASC' );
	
	$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'property image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='rentals/edit_property_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    
    
   /**************** Property image misc functions ****************************/
    public function do_image_upload()
	{
		chk_login();
		$output_dir = FILE_UPLOAD_ABSOLUTE_PATH. "property/";
		if(isset($_FILES["myfile"]))
		{
			
			$ret = array();
			$error = $_FILES["myfile"]["error"];
			{
				$fileCount = count($_FILES["myfile"]['name']);
				for($i=0; $i < $fileCount; $i++)
				{
					
					//****************** file name formatting area*************************
					
					$file_name = $_FILES["myfile"]["name"][$i];
					$rest_string_after_dot = strrchr($file_name, '.' );
					
					$last_dot_position =  strrpos($file_name,".");
					 $just_file_name = substr($file_name,0,$last_dot_position);
										
					$just_file_ext = substr($rest_string_after_dot,1);//////////////
					//step 2
					
										
					$random_text = rand();
					$final_random_text = substr($random_text,0,5);
					
					$fileName = $just_file_name."_".$final_random_text.'.'.$just_file_ext;
					
					// ****************file name formating area ends**************************
					//$fileName = rand()."_".$_FILES["myfile"]["name"][$i];
					//$ret[$fileName]= $output_dir.$fileName; //$ret[$fileName] = $fileName;
					
					move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
					
					/*** create thumbanil ***/
					$source_image 	= $output_dir.$fileName;
					
					/*** for 591*393 ***/
					$new_big_image	= $output_dir."big/".$fileName;
					$big_width		= '591';
					$big_height		= '393';
					image_thumbnail($source_image, $new_big_image, $big_width, $big_height);
					
					/*** for 116*126 ***/
					$new_list_image	= $output_dir."list/".$fileName;
					$list_width	= '150';
					$list_height	= '140';
					image_thumbnail($source_image, $new_list_image, $list_width, $list_height, FALSE);
					
					/*** for 53*40 ***/
					$new_small_image	= $output_dir."small/".$fileName;
					$small_width		= '53';
					$small_height		= '40';
					image_thumbnail($source_image, $new_small_image, $small_width, $small_height,FALSE);
					
					$ret = $fileName;
				}
			}
			
			
			echo json_encode($ret);
		}
    }
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function add_property_image(){
	$data = array();
	
	if($this->input->post('property_id')!=''){
	    
	    $is_featured_exist = $this->model_basic->getValue_condition($this->propertyImageTable, 'is_featured', 'is_featured', 'is_featured = "Yes" AND property_id='.$this->input->post('property_id'));
	    
	    $max_order = $this->model_basic->getValue_condition($this->propertyImageTable, 'max(image_order)', 'max_order', ' property_id='.$this->input->post('property_id'));
	    $order = $max_order + 1;
	    
	    $feature = 'No';
	    if($is_featured_exist == ''){
		$feature = 'Yes';
	    }
	    $image_name = mysql_real_escape_string($this->input->post('image_name'));
	    $insertPropertyImageArr = array(
					    'property_id' 	=> mysql_real_escape_string($this->input->post('property_id')),
					    'image_file_name'	=> $image_name,
					    'is_featured'	=> $feature,
					    'image_order'	=>$order
					    );

	  $insert_id =  $this->model_basic->insertIntoTable($this->propertyImageTable,$insertPropertyImageArr);
	  
	  if($insert_id){
	    $data['val']['property_image_id'] = $insert_id;
	    $data['val']['image_file_name'] = $image_name;
	    $data['val']['image_order'] = $order;
	    $data['val']['is_feature'] = $feature;
	    
	    echo $newly_added = $this->load->view('sales/addnew_image',$data,true);
	    
	  }
	}
	
    }
    
    
    public function update_image_data(){
	if($this->input->post('property_image_id')!=''){
	    $image_property_id = mysql_real_escape_string($this->input->post('property_image_id'));
	    $updateArr = array(
			       "image_alt" => mysql_real_escape_string($this->input->post('alt')),
			       "image_caption" => mysql_real_escape_string($this->input->post('caption')),
			       "image_order" => mysql_real_escape_string($this->input->post('order')),
			       );
	    $idArr = array(
			   'property_image_id' => $image_property_id
			   );
	    echo $this->model_basic->updateIntoTable($this->propertyImageTable, $idArr, $updateArr);
	}

    }
    
     public function set_feature_image(){
	if($this->input->post()){
	    // set all none
	    $image_id = $this->input->post('property_image_id');
	     $property_id = $this->model_basic->getValue_condition($this->propertyImageTable, 'property_id', 'property_id', 'property_image_id='.$image_id);
	    
	     $updateArr = array(
			       "is_featured" => 'No',
			       );
	    $idArr = array(
			   'property_id' => $property_id
			   
			   );
	    $this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_id' => $property_id ), array( "is_featured" => 'No'));
	    $this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_image_id' => $image_id ), array( "is_featured" => 'Yes'));
	}
    }
    
    public function delete_property_image()
     {
             chk_login();
             
             $property_image_id	= $this->input->get_post('property_image_id');
             
             $Condition 		= " property_image_id = '".$property_image_id."'";
             $arr_property_image	= $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition);
             $prev_image_name	= $arr_property_image[0]['image_file_name'];
             
             if($prev_image_name != '')
             {
                     /*** Delete Image from Server ***/
                     if(file_exists(file_upload_absolute_path().'property/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
                     {
                             unlink(file_upload_absolute_path().'property/'.stripslashes($prev_image_name));
                     }
                     
                     if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
                     {
                             unlink(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name));
                     }
                     
                     if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
                     {
                             unlink(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name));
                     }
                     
                     if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
                     {
                             unlink(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name));
                     }
             }
             
             $delete_where	= "property_image_id = '".$property_image_id."' ";
             $this->model_basic->deleteData($this->propertyImageTable, $delete_where);
             return true;
     }
	
    /**************** End Property image misc functions ****************************/
    
    
    /************************* Avaibalability *************************************/
    public function ical(){ 
           chk_login();
            $property_id =	$this->uri->segment(3,0);
            $page	     =	$this->uri->segment(4,0);
            $icalurl =  $this->input->post('icalurl') ;
            
            if($this->input->get_post('action') == 'Process'){
                  // pr($_POST);
                    $sync_from = addslashes( $this->input->post('syn'));
                    $status = addslashes( $this->input->post('status'));
                    $kigo_id = addslashes( $this->input->post('kigo_id'));
                    
                    //if(isset($_FILES['icalfile']) && $_FILES['icalfile']['name'] !='' || $this->input->post('icalurl') != '' )
                    if($this->input->post('icalurl') != '' &&   $sync_from != "KA" && $sync_from != "NA")
                    {
                            $upload_dir = FILE_UPLOAD_ABSOLUTE_PATH.'temp/';
                            $this->load->library('ical');
                            $error_msg = '';
                            
                            
                            // For the url
                                    
                            $temp_name = time();
                            $content	= '';
                            $content = @file_get_contents($icalurl);
                            $insert = file_put_contents($upload_dir.$temp_name.".ics", $content);
                            if( $content && $insert){
                            $this->ical->read($upload_dir.$temp_name.".ics" );
                            $result = $this->ical->get_event_array();
                            
                            unlink($upload_dir.$temp_name.".ics"); // del last file
                            }else{
                                    
                                    $error_msg = "Invalid url or System can't get ics file. Try again";
                            }
                            //pr($result);
                                    
                            
                            
                            // update database
                            if(isset($result) && count($result)>0){
                                    
                                    // delete old data
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    
                                    foreach($result  as $cal){
                                            $dtstart = $dtend = $summary = $description = '' ;
                                            if(isset($cal['DTSTART'])){ $dtstart = $cal['DTSTART']; }
                                            if(isset($cal['DTEND'])){ $dtend = $cal['DTEND']; }
                                            if(isset($cal['SUMMARY'])){ $summary = mysql_real_escape_string($cal['SUMMARY']); }
                                            if(isset($cal['SUMMARY;VALUE=TEXT'])){ $summary = mysql_real_escape_string($cal['SUMMARY;VALUE=TEXT']); }
                                            if(isset($cal['DESCRIPTION'])){ $description = mysql_real_escape_string( $cal['DESCRIPTION']); }
                                            
                                            $insertArr  = array(
                                                                'ical_property_id'  => $property_id,
                                                                'ical_dtstart'      => $dtstart,
                                                                'ical_dtend' 	=> $dtend,
                                                                'ical_summary'	=> $summary,
                                                                'ical_description'	=> $description,
                                                                //'ical_from'		=> $sync_from,
                                                                // 'ical_url'		=> mysql_real_escape_string($icalurl),
                                                                );
                                            $this->model_basic->insertIntoTable('lp_ical_master',$insertArr); // ical master
                                            $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>$sync_from,'on_kigo'=>'no','ical_url'=>mysql_real_escape_string($icalurl)));
                                            // Availability
                                            $datetime1 = new DateTime($dtstart);
                                            $datetime2 = new DateTime($dtend);
                                            $interval = $datetime1->diff($datetime2);
                                            $tot_days = $interval->days;
                                            
                                            for($i = 0; $i < $tot_days; $i++){
                                                    $avl_date  = $datetime1->format('Y-m-d');
                                                    $timestamp = $datetime1->format('U');
                                                    $insertArr  = array(
                                                                'property_id'  		=> $property_id,
                                                                'avail_date_format'         => $avl_date,
                                                                'avail_timestamp_format' 	=> $timestamp,
                                                                'avail_status'		=> $sync_from,
                                                                'date_added'		=>date('Y-m-d'),
                                                                );
                                                    $this->model_basic->insertIntoTable('lp_property_availibility',$insertArr); // ical avaibality
                                                    $datetime1->modify('+1 day');
                                            }
                                    }
                                    $this->reservation();
                                    
                            }//result block
                            
                            /// set success and error msg
                            //$this->nsession->set_userdata('succmsg', "Successfully Imported");
                            if(empty($error_msg)){
                                    $this->nsession->set_userdata('succmsg', "Successfully Import & Updated");
                                    redirect(BACKEND_URL.'property_rental2/ical/'.$property_id.'/'.$page);
                                    return true;  
                            }else{
                                    $this->nsession->set_userdata('errmsg', $error_msg);
                            }
    
                    }
                    else
                    {
                            if($sync_from=="NA" && $property_id){
                                    $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>'NA','on_kigo'=>'no'));
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    $this->nsession->set_userdata('succmsg', "Successfully Updated");
                                    $this->reservation();
                                    redirect(BACKEND_URL.'rentals/payment/'.$property_id.'/'.$page);
                                    return true;                            
                            }elseif($sync_from == "KA" && $property_id && $kigo_id){
                                    $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>'KA','kigo_id'=>$kigo_id,'on_kigo'=>'yes'));
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    $this->reservation();
                                    $this->nsession->set_userdata('succmsg', "Successfully Updated");
                                    redirect(BACKEND_URL.'property_rental2/ical/'.$property_id.'/'.$page);
                                    return true;
                                    
                            }else{ 
                                    $this->nsession->set_userdata('errmsg', "Please Enter ical url/id");
                            }
                    }	
            }

            $manage_record = $this->model_basic->getValues_conditions($this->rentMasterTable, array('manage_by','kigo_id','ical_url'), '', 'property_id='.$property_id, '', '', 0);
            $this->data['manage_by']      =$manage_record[0]['manage_by'];
            $this->data['kigo_id'] 	  = $manage_record[0]['kigo_id'];
            $this->data['ical_url'] 	  = $manage_record[0]['ical_url'];
            
            /******** tabs data ********/
           $this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'property image'),true);
            /******** end tabs data ********/
            
            
            /// Set succ/error msg
            $this->data['succmsg'] = $this->nsession->userdata('succmsg');
            $this->data['errmsg'] = $this->nsession->userdata('errmsg');
            $this->nsession->set_userdata('succmsg', "");
            $this->nsession->set_userdata('errmsg', "");
    
            $this->templatelayout->get_topbar();
            $this->templatelayout->get_leftmenu();
            $this->templatelayout->get_footer();
                                                    
            $this->elements['middle']='rentals/ical_import';			
            $this->elements_data['middle'] = $this->data;			    
            $this->layout->setLayout('layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    /// Kigo  update
	public function reservation(){
		//error_reporting(0);
		
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
		if($response->API_REPLY->RES_LIST && is_array($response->API_REPLY->RES_LIST) ){
		    foreach($response->API_REPLY->RES_LIST as $res){
			if (count($kigoProp) && array_key_exists( $res->PROP_ID , $kigoProp )) {
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
        
	}
    
    
	private function updatePropertyAvailability(){
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
    }
    
    /************************* End Avaibalability *************************************/
    
    
    
}

