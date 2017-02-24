<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	 public function __construct(){
        parent:: __construct();
       
        $this->load->model("model_adminuser");
        $this->load->model("user_model");
	$this->load->model("model_basic");
	//$this->load->model("model_rentals");
    }
	
	public function index()
	{
		chk_login();
		//$this->load->view('welcome_message');
		$this->data = '';
		
		
		$this->data['msg'] = $this->nsession->userdata('msg');
		$this->nsession->set_userdata('msg', '');
		
		//<-------------analytics----------------------->
		
		$start  =   date("m/d/Y",strtotime("-1 months"));
		$end    =   date("m/d/Y");
		    
		if($this->input->get("action")=="Process"){
		    $start  =   $this->input->get("startdate");
		    $end    =   $this->input->get("enddate");
		}
		$record     =   $this->getanalytics($start,$end);
		
		$this->data['start']=$start;
		$this->data['end']=$end;
		$this->data['record']=$record;
		
		
		//<-----------------end analytics---------------------------->
		
	
		
		  //For breadcrump..........
		
		  $this->data['brdLink'][0]['logo']	=	'fa fa-tachometer fa-fw';
		  $this->data['brdLink'][0]['name']	=	'Dashboard';
		  $this->data['brdLink'][0]['link']	=	'javascript:void(0)';
		  
		  //........................
		 
		$currency=$this->model_basic->getValues_conditions(CURRENCY_MASTER,array('currency_rate','currency_code'),array(),' currency_code IN("USD","EUR","GBP")');
		$this->data['currency_record']=$currency;
		
		$enquiry=array();
	        $condition =  "updated_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-7 day'))."' AND '".date('Y-m-d H:i:s')."'";
		$field[0]= "enquiry_id";
		
		$days = $this->model_basic->getValues_conditions(ENQUIRY_MASTER,$field,'',$condition,'','','');
		if(is_array($days))
			$enquiry['seven_days'] = count($days);
		else
			$enquiry['seven_days'] = 0;
		
		
		$condition =  "updated_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 month'))."' AND '".date('Y-m-d H:i:s')."'";
		$field[0]= "enquiry_id";
		$month = $this->model_basic->getValues_conditions(ENQUIRY_MASTER,$field,'',$condition,'','','');
		if(is_array($month))
			$enquiry['one_month'] = count($month);
		else
			$enquiry['one_month'] = 0;
		
		
		$field[0]= "enquiry_id";
		
		$all = $this->model_basic->getValues_conditions(ENQUIRY_MASTER,$field,'','','','','');
		if(is_array($month))
			$enquiry['all'] = count($all);
		else
			$enquiry['all'] = 0;
			
		$this->data['enquiry'] = $enquiry;
		$this->data['image']=$this->nsession->userdata('user_image');
		$this->data['fname']=$this->nsession->userdata('first_name');
		$this->data['lname']=$this->nsession->userdata('last_name');
		$this->data['email']=$this->nsession->userdata('admin_email');
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='dashboard/dashboard';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function logout()
	{
		//$this->nsession->sess_destroy();
		
		session_destroy();
		redirect(BACKEND_URL);
	}
	
	
	public function getanalytics($start,$end)
	{
            $record=array();
            $this->data=array();
            $record['total_sessions']=0;  
            $record['total_users']=0;
            $record['total_newusers']=0;
            $record['total_percent_new_user']=0;
            $record['total_page_views']=0;
            $record['total_page_views_per_session']=0;
            $record['total_avg_session_duration']=0;
            $record['total_bounce_rate']=0;    
               
            if($start!='' and $end!='')
	    //if($start=='' and $end=='')
	    {        
             
                    // PROJECT NAME : 'Api project' IN https://console.developers.google.com
                    
                    $library            =   SERVER_ABSOLUTE_PATH.'admin-app/libraries/GoogleAnalyticsAPI.class.php';
                    include($library);
        
                    $ga = new GoogleAnalyticsAPI('service');
                    $ga->auth->setClientId( CLIENT_ID ); // From the APIs console
                    $ga->auth->setEmail( EMAIL ); // From the APIs console
                    $ga->auth->setPrivateKey( P12_FILE_PATH ); // Path to the .p12 file
        
                    $auth = $ga->auth->getAccessToken();
                    $visits=array();
                    if ($auth['http_code'] == 200) {
                        $accessToken = $auth['access_token'];
                        $tokenExpires = $auth['expires_in'];
                        $tokenCreated = time();
			$ga->setAccessToken($accessToken);
			   $ga->setAccountId( ACCOUNT_ID );
			 
			   $defaults = array(
			       'start-date' => date("Y-m-d",strtotime($start)),
			       'end-date'   => date("Y-m-d",strtotime($end))
			   );
			   //pr($defaults);
			  
			   $ga->setDefaultQueryParams($defaults);
		     
			   
			   $params = array(
			       'metrics'    => 'ga:users,ga:pageviewsPerSession,ga:avgSessionDuration,ga:bounceRate',
			       'dimensions' => 'ga:date',
			   );
			   $visits = $ga->query($params);
                    }
      
                    
              
                    //pr($visits);
                    if(is_array($visits) and array_key_exists("totalsForAllResults",$visits)){
                     
                        $record['total_users']                  =   $visits['totalsForAllResults']['ga:users'];
                        $record['total_page_views_per_session'] =   number_format($visits['totalsForAllResults']['ga:pageviewsPerSession'],2);
                        $record['total_avg_session_duration']   =   number_format($visits['totalsForAllResults']['ga:avgSessionDuration'],0);
                        $record['total_bounce_rate']            =   number_format($visits['totalsForAllResults']['ga:bounceRate'],2);
                        
                    }
            }
	    //pr($record);
            return $record;
           
	}
	
	function getConvert(){
	   echo $this->convertCurrency(1,'USD','INR');
	}
	 
	 function convertCurrency($amount, $from, $to){
		  echo $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
		  $data = file_get_contents($url);
		  preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		  $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		  return round($converted, 3);
	 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */