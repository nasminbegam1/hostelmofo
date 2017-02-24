<?php

class Icalavailability extends CI_Controller{
    var $icalMaster	        = 'lp_ical_master';
    var $RentMaster             = 'lp_rent_master';
    var $propertyAvailability   = 'lp_property_availibility';
    
    var $kigo_username          = 'livephuket';
    var $kigo_password          = 'qqoeUgWdW';
        
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_kigo');
    }
    
    
     public function index(){
        
        chk_login();
        $this->data = array();
        $config['base_url'] 	= BACKEND_URL."icalavailability/index/";
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 3;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        $this->data['icalpropertyList'] = $this->model_kigo->getIcalProperty($config);
        
        $this->pagination->initialize($config);
        
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(3,0);
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['errmsg'] = $this->nsession->userdata('errmsg');        
        $this->nsession->unset_userdata('succmsg');		
        $this->nsession->unset_userdata('errmsg');
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/ical_propertylist';		
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    public function details(){
        
        chk_login();
        $this->data = array();
        
        $this->data['ical_id'] = $this->uri->segment(3,0);
        $config['base_url'] 	= BACKEND_URL."icalavailability/details/".$this->data['ical_id'];
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 4;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
        $this->data['enquiryList'] = $this->model_kigo->getIcalPropertyDetail($this->data['ical_id'],$config);
        
        $this->pagination->initialize($config);
        
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(4,0);
    
        //pr($this->data,0);
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/ical_details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    public function ical_update(){ 
		
		$upload_dir = FILE_UPLOAD_ABSOLUTE_PATH.'temp/';
		$this->load->library('ical');
		
		/// Get all property
		$records = $this->model_basic->getValues_conditions($this->RentMaster, array('property_id','manage_by','kigo_id','ical_url'),'', 'manage_by != "KA" AND manage_by != "NA" ', '', '', '');
		
		/*Delete old data for each rental property from ical master availibility table */
		
		$this->model_kigo->truncateKigo( 'lp_ical_master' );
		$del = $this->model_kigo->truncateKigo( 'lp_property_availibility' );
		
		
		if(is_array($records) && count($records)){
			$inserted_arr = array();
			foreach($records as $property){
				/**** Get ical data from url *******/
				
				$icalurl =  $property['ical_url'] ;
				
				if($icalurl && $property['manage_by'] != 'NA' && $property['manage_by'] != 'KA' && $property['ical_url'] != ''){
					
					$temp_name = time();
					$content	= '';
					$content = @file_get_contents($icalurl);
					$insert = file_put_contents($upload_dir.$temp_name.".ics", $content);
					if( $content && $insert){
					$this->ical->read($upload_dir.$temp_name.".ics" );
					$result = $this->ical->get_event_array();
					
					unlink($upload_dir.$temp_name.".ics"); // del last file
					}
					
					
					// update database
					if(isset($result) && count($result)>0){
						
						//echo '<br>'.$property['property_id'].'>>>>'.$icalurl;
						foreach($result  as $cal){
							if(!in_array($property['property_id'].'-'.$cal['DTSTART'].'-'. $cal['DTEND'],$inserted_arr)){
								//echo '<br>'.$dtend = $cal['DTEND'].'>>>'.$property['property_id'].'>>>>'.$icalurl;
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
							$insert = $this->model_basic->insertIntoTable('lp_ical_master',$insertArr); // ical master
							
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
								$insert_av = $this->model_basic->insertIntoTable('lp_property_availibility',$insertArr); // ical avaibality
								$datetime1->modify('+1 day');
							}
							}
						}
						
					}//result block
					
				}// if ical url
				
			}// records 4 each
		
		}// if records
		
            if(count($result) ){
                $this->nsession->set_userdata('succmsg', "iCal Availability updated succesfully.");
                redirect("icalavailability");
                return false;
            }else{
                $this->nsession->set_userdata('errmsg', "Unable to update iCal Availability or No ical data found. Please try again.");
                redirect("icalavailability");
                return false;
            }
		
	}
  
}


?>