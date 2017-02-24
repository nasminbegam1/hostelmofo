<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	 public function __construct(){
        parent:: __construct();
       
        $this->load->model("model_adminuser");
        $this->load->model("user_model");
	$this->load->model("model_basic");
	$this->load->model("model_rentals");
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
		
		// currency RECORD //
		
		$currency=$this->model_basic->getValues_conditions('lp_country_currency_master',array('currency_rate','currency_code'),array(),' currency_code IN("USD","EUR","GBP","AUD")');
		$this->data['currency_record']=$currency;
		
		//<-----------------code-------------------->
		
		$genaral=array();
		$genaral['total_day_in_current_month'] = date("t", mktime(0,0,0, date("n") - 1));
		
		//$current_date=date('Y-m-d H:i:s');
		
		$sales=array();
		$condition = "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Sales'";
		$field[0]= "enquiry_id";
		$hrs = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($hrs))
			$sales['24hrs'] = count($hrs);
		else
			$sales['24hrs'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-7 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Sales'";
		$field[0]= "enquiry_id";
		$days = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($days))
			$sales['7days'] = count($days);
		else
			$sales['7days'] = 0;
		
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Sales'";
		$field[0]= "enquiry_id";
		$month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($month))
			$sales['1month'] = count($month);
		else
			$sales['1month'] = 0;
		
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-3 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Sales'";
		$field[0]= "enquiry_id";
		$three_month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($three_month))
			$sales['3month'] = count($three_month);
		else
			$sales['3month'] =  0;
			
		$condition =  "added_on BETWEEN '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 1, date("Y")))."' AND '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), 0, date("Y")))."' AND  sales_rentals = 'Sales'";
		$field = "DATE_FORMAT(added_on,'%d') as date";
		
		$sales['graph_month'] = date("m-Y", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
		$sales_enquiry_in_past_month=array();
		$sales_enquiry_in_past_month = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		//pr($sales_enquiry_in_past_month,0);
		$date_arr=array();
		$max=0;
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			$date_arr[$i]['count'] = 0;
			$date_arr[$i]['date'] = $i+1;
		}	
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			foreach($sales_enquiry_in_past_month as $v)
			{
				if($v['date'] == $i)
				{
					$date_arr[$i]['count'] = $v['total_enquiry'];
					if($v['total_enquiry'] > $max)
						$max = $v['total_enquiry'];
				}				
			}
			
		}
		
		//pr($date_arr,0);
		$sales['sales_enquiry_in_past_month'] = $date_arr;
		$sales['max_enquiry'] = $max;
		$this->data['sales'] = $sales;
		
		//<!-----------------------all enquiry-------------------------------->
		
		$all_enquiry=array();
		
		
		$condition = "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals !=''";
		$field[0]= "enquiry_id";
		$month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($month))
		{
			$all_enquiry['1month'] = count($month);
		}
		else
		{
			$all_enquiry['1month'] = 0;
		}
		$this->data['all_enquiry'] = $all_enquiry;	
		
		
		
		
		//<!-----------------------all enquiry-------------------------------->
		$rental=array();
		$condition = "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Rental'";
		$field[0]= "enquiry_id";
		$hrs = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($hrs))
			$rental['24hrs'] = count($hrs);
		else
			$rental['24hrs'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-7 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Rental'";
		$field[0]= "enquiry_id";
		$days = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($days))
			$rental['7days'] = count($days);
		else
			$rental['7days'] =  0;
		
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Rental'";
		$field[0]= "enquiry_id";
		$month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($month))
			$rental['1month'] = count($month);
		else
			$rental['1month'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-3 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'Rental'";
		$field[0]= "enquiry_id";
		$three_month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($three_month))
			$rental['3month'] = count($three_month);
		else
			$rental['3month'] = 0;
		
		$condition =  "added_on BETWEEN '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 1, date("Y")))."' AND '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), 0, date("Y")))."' AND  sales_rentals = 'Rental'";
		
		$rental['graph_month'] = date("m-Y", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
		$field = "DATE_FORMAT(added_on,'%d/%m/%Y')  as date";
		
		$rental_enquiry_in_past_month=array();
		$max=0;
		$rental_enquiry_in_past_month = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		$date_arr=array();
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			$date_arr[$i]['count'] = 0;
			$date_arr[$i]['date'] = $i+1;
		}	
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			foreach($rental_enquiry_in_past_month as $v)
			{
				if($v['date'] == $i)
				{
					$date_arr[$i]['count'] = $v['total_enquiry'];
					if($v['total_enquiry'] > $max)
						$max = $v['total_enquiry'];
				}				
			}
			
		}
		//$rental['rental_enquiry_in_past_month'] = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		
		$rental['rental_enquiry_in_past_month'] = $date_arr;
		$rental['max_enquiry'] = $max;
		$this->data['rental'] = $rental;
		
		
		
		
		$condition = "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'General'";
		$field[0]= "enquiry_id";
		$hrs = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($hrs))
			$genaral['24hrs'] = count($hrs);
		else
			$genaral['24hrs'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-7 day'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'General'";
		$field[0]= "enquiry_id";
		$days = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($hrs))
			$genaral['7days'] = count($days);
		else
			$genaral['7days'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-1 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'General'";
		$field[0]= "enquiry_id";
		
		$month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($month))
			$genaral['1month'] = count($month);
		else
			$genaral['1month'] = 0;
			
		$condition =  "added_on BETWEEN '".date('Y-m-d H:i:s',strtotime('-3 month'))."' AND '".date('Y-m-d H:i:s')."' AND  sales_rentals = 'General'";
		$field[0]= "enquiry_id";
		$three_month = $this->model_basic->getValues_conditions('lp_enquiry_master',$field,'',$condition,'','','');
		if(is_array($three_month))
			$genaral['3month'] = count($three_month);
		else
			$genaral['3month'] = 0;
		
		$condition =  "added_on BETWEEN '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 1, date("Y")))."' AND '".date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), 0, date("Y")))."' AND  sales_rentals = 'General'";
		$field = "DATE_FORMAT(added_on,'%d/%m/%Y')  as date";
		
		//$genaral['genaral_enquiry_in_past_month'] = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		$genaral['graph_month'] = date("m-Y", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
		
		$genaral['graph_full_month'] = date("F,Y", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
		$genaral_enquiry_in_past_month=array();
		$genaral_enquiry_in_past_month = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		$max=0;
		$date_arr=array();
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			$date_arr[$i]['count'] = 0;
			$date_arr[$i]['date'] = $i+1;
		}	
		for($i=0;$i<$genaral['total_day_in_current_month'];$i++)
		{
			foreach($genaral_enquiry_in_past_month as $v)
			{
				if($v['date'] == $i)
				{
					$date_arr[$i]['count'] = $v['total_enquiry'];
					if($v['total_enquiry'] > $max)
						$max = $v['total_enquiry'];
				}				
			}
			
		}
		//$rental['rental_enquiry_in_past_month'] = $this->model_adminuser->getEnquiryByDate('lp_enquiry_master',$field,$condition);
		
		$genaral['genaral_enquiry_in_past_month'] = $date_arr;
		$genaral['max_enquiry'] = $max;
		
		$genaral['avaliability_property']=$this->model_rentals->getAvaliabilityLivePropertyCount();
		$genaral['booking_property']=$this->model_rentals->getBookingLivePropertyCount();
		//$genaral['last_min_property']=$this->model_rentals->getBookingLivePropertyCount();
		
		
		$genaral['last_min_property']=0;
		
		
		
		$this->data['genaral'] = $genaral;
		
		
		
		$property = array();
		$field[0] = "property_id";
		$condition = " record_type IN ('Sales','Both') AND status = 'active'";
		$sales_property_live = $this->model_basic->getValues_conditions('lp_property_master',$field,'',$condition,'','','');
		if(is_array($sales_property_live))
			$property['sales_property_live'] = count($sales_property_live);
		else
			$property['sales_property_live'] = 0;
			
		$condition = " record_type IN ('Sales','Both') AND status = 'inactive'";
		$sales_property_notlive = $this->model_basic->getValues_conditions('lp_property_master',$field,'',$condition,'','','');
		if(is_array($sales_property_notlive))
			$property['sales_property_notlive'] = count($sales_property_notlive);
		else
			$property['sales_property_notlive'] = 0;
			
		$condition = " record_type IN ('Rental','Both') AND status = 'active'";
		$rental_property_live = $this->model_basic->getValues_conditions('lp_property_master',$field,'',$condition,'','','');
		if(is_array($rental_property_live))
			$property['rental_property_live'] = count($rental_property_live);
		else
			$property['rental_property_live'] = 0;
		
		$condition = " record_type IN ('Rental','Both') AND status = 'inactive'";
		$rental_property_notlive = $this->model_basic->getValues_conditions('lp_property_master',$field,'',$condition,'','','');
		if(is_array($rental_property_notlive))
			$property['rental_property_notlive'] = count($rental_property_notlive);
		else
			$property['rental_property_notlive'] = 0;
		//pr($rental,0);pr($genaral,0);pr($sales,0);exit;
		
		$this->data['liveDetails'] = $property;
		
		//<------------------------------------------->
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
                    
                    $library            =   SERVER_ABSOLUTE_PATH.'warp-app/libraries/GoogleAnalyticsAPI.class.php';
                    include($library);
        
                    $ga = new GoogleAnalyticsAPI('service');
                    $ga->auth->setClientId( CLIENT_ID ); // From the APIs console
                    $ga->auth->setEmail( EMAIL ); // From the APIs console
                    $ga->auth->setPrivateKey( P12_FILE_PATH ); // Path to the .p12 file
        
                    $auth = $ga->auth->getAccessToken();
                    
                    if ($auth['http_code'] == 200) {
                        $accessToken = $auth['access_token'];
                        $tokenExpires = $auth['expires_in'];
                        $tokenCreated = time();
                    }
        
                    $ga->setAccessToken($accessToken);
                    $ga->setAccountId( ACCOUNT_ID );
                  
                    $defaults = array(
                        'start-date' => date("Y-m-d",strtotime($start)),
                        'end-date'   => date("Y-m-d",strtotime($end))
                    );
                   
                    $ga->setDefaultQueryParams($defaults);
              
                    
                    $params = array(
                        'metrics'    => 'ga:users,ga:pageviewsPerSession,ga:avgSessionDuration,ga:bounceRate',
                        'dimensions' => 'ga:date',
                    );
                    $visits = $ga->query($params);
              
                    //pr($visits);
                    if(is_array($visits) and array_key_exists("totalsForAllResults",$visits)){
                     
                        $record['total_users']                  =   $visits['totalsForAllResults']['ga:users'];
                        $record['total_page_views_per_session'] =   number_format($visits['totalsForAllResults']['ga:pageviewsPerSession'],2);
                        $record['total_avg_session_duration']   =   number_format($visits['totalsForAllResults']['ga:avgSessionDuration'],0);
                        $record['total_bounce_rate']            =   number_format($visits['totalsForAllResults']['ga:bounceRate'],2);
                        
                    }
            }
            return $record;
           
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */