<?php
class Analytics extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
    }
    
    public function index(){
        
        
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
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='dashboard/analytics';
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
      
    }
    
    
    function getanalytics($start,$end){
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
               
            if($start!='' and $end!=''){        
             
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


?>