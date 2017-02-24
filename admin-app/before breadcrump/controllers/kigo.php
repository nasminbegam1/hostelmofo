<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kigo extends CI_Controller {
    
    
    var $kigoMaster	        = 'lp_kigo_data';
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
        $config['base_url'] 	= BACKEND_URL."kigo/index/";
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 3;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        $this->data['kigopropertyList'] = $this->model_kigo->getKigoProperty($config);
        
        $this->pagination->initialize($config);
        
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(3,0);
        //pr($this->data);
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['errmsg'] = $this->nsession->userdata('errmsg');        
        $this->nsession->unset_userdata('succmsg');		
        $this->nsession->unset_userdata('errmsg');
        
        $brdArr	= array( "KIGO Property List" => 'javascript:void(0);');
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/propertylist';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    public function details(){
        
        chk_login();
        $this->data = array();
        
        $this->data['kigo_id'] = $this->uri->segment(3,0);
        $config['base_url'] 	= BACKEND_URL."kigo/details/".$this->data['kigo_id'];
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 4;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
        $this->data['enquiryList'] = $this->model_kigo->getKigoPropertyDetail($this->data['kigo_id'],$config);
        
        $this->pagination->initialize($config);
        $this->data['config']=$config;
        $this->data['start_from']=$this->uri->segment(4,0);
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }    
    
    public function reservation(){
        $username = $this->kigo_username;
        $password = $this->kigo_password;
        
        $kigoProp = array();
        $this->model_kigo->truncateKigo( $this->kigoMaster );
        $kigoProp = $this->model_kigo->get_kigo_property();
        //pr($kigoProp);
        
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, 'https://app.kigo.net/api/ra/v1/diffPropertyCalendarReservations');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, true );
        $queryString = array("DIFF_ID" => null);
        $queryString = json_encode($queryString);
        //pr($queryString,0);
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
        //pr($request_headers,0);
        $response = json_decode($response);
        //pr($response); //getting the result that matters
        //echo '<br>--------------------------------<br>';
        //echo 'API VERSION = ' . $response->API_VERSION;
        //echo '<br>';
        //echo 'API REVISION = ' . $response->API_REVISION;
        //echo '<br>';
        //echo 'API METHOD = ' . $response->API_METHOD;
        //echo '<br>';
        //echo 'API CALL ID = ' . $response->API_CALL_ID;
        //echo '<br>';
        //echo 'API RESULT CODE = ' . $response->API_RESULT_CODE;
        //echo '<br>';
        //echo 'API RESULT TEXT = ' . $response->API_RESULT_TEXT;
        //echo '<br>';
        ////echo 'API REPLY = ' . pr($response->API_REPLY);        
        //echo '<br>';
        //echo 'DIFF_ID = ' . $response->API_REPLY->DIFF_ID;        
        //echo '<br>';
        //echo 'RESULT LIST = ' . pr($response->API_REPLY->RES_LIST);
        
        //$kigoProp = $this->model_kigo->get_kigo_property();
        //pr($kigoProp,0);
        $insertArr = array();
        if($response->API_REPLY->RES_LIST && is_array($response->API_REPLY->RES_LIST) ){
            foreach($response->API_REPLY->RES_LIST as $res){
                if (array_key_exists( $res->PROP_ID , $kigoProp )) {
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
            
            //open this line below when you want to insert the KIGO data into availability table
            $this->updatePropertyAvailability();
            
        }
        
    }
    
    
    private function updatePropertyAvailability(){
        //$this->model_kigo->truncateKigo( $this->propertyAvailability );
        $this->model_kigo->deleteDataKigo();
        $booked = $this->model_kigo->getBookedProperty();
        
        $i=0;
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
            
        return $res;
    }
    

    public function update_availability(){
        
        error_reporting(0);
        $username = $this->kigo_username;
        $password = $this->kigo_password;
        
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
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $queryString);
        $response = curl_exec( $ch );        
        curl_close( $ch );
        $response = json_decode($response);
        
        $insertArr = array();
        $ret = false;
        if($response->API_REPLY->RES_LIST && is_array($response->API_REPLY->RES_LIST) ){
            foreach($response->API_REPLY->RES_LIST as $res){
                if (array_key_exists( $res->PROP_ID , $kigoProp )) {
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
            
            //open this line below when you want to insert the KIGO data into availability table
            $ret = $this->updatePropertyAvailability();
            
        }
        
        if($ret){
            $this->nsession->set_userdata('succmsg', "KIGO Availability updated succesfully.");
            redirect("kigo");
            return false;
        }else{
            $this->nsession->set_userdata('errmsg', "Unable to update KIGO Availability. Please try again.");
            redirect("kigo");
            return false;
        }
        
    }
    
     public function ical(){
        
        chk_login();
        $this->data = array();
        
        $this->data['enquiryList'] = $this->model_kigo->getIcalProperty();
         
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='kigo/ical_propertylist';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    
    }
    
    public function ical_details()
    {
        
        chk_login();
        $this->data = array();
        
        $this->data['kigo_id'] = $this->uri->segment(3,0);
        
        $this->data['enquiryList'] = $this->model_kigo->getIcalPropertyDetail($this->data['kigo_id']);
        
        //pr($this->data,0);
        
        $brdArr	= array( "iCal Property List" => BACKEND_URL.'kigo/ical/');
        $this->templatelayout->get_breadcrump($brdArr); 
        $this->templatelayout->get_sidebar('');
        $this->elements['middle']='kigo/ical_details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
}
}
?>