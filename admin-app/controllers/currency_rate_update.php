<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Currency_rate_update extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic'); 
	}
	
	public function index()
	{		 
		
		$Condition = " country_currency_status = 'active' ";
		$rs = $this->model_basic->getValues_conditions(CURRENCY_MASTER, '', '', $Condition);
                if( !empty($rs) ){
			//pr($rs);
		    foreach($rs as $single){
			$currency_code = $single['currency_code'];
			$country_currency_id  = $single['country_currency_id'];
			if($single['rate_updation_mode'] == 1 && $single['country_currency_status'] == 'active'){
				if($currency_code != 'AUD'){
					$html 	= file_get_html('http://www.google.com/finance/converter?a=1&to='.$currency_code.'&from='.DEFAULT_CURRENCY);
					foreach($html->find("div#currency_converter_result span.bld") as $element){
						$currency_rate = $element->innertext;
					      }
					//$currency = explode(" ".DEFAULT_CURRENCY,$currency_rate); 
					$currency = explode(" ",$currency_rate);
					$amount_multiplier = trim($currency[0]);
				}
				else
				{
					$currency_rate = 1;
					$amount_multiplier = 1;
				}
				 				
				$updateArr  =  array( 'currency_rate'=>$amount_multiplier  );
				//pr($currency);
				$idArr	    = array('country_currency_id' => $country_currency_id );
				
				$ret   = $this->model_basic->updateIntoTable(CURRENCY_MASTER, $idArr,$updateArr);				 
			}
		    }
		    
                }
	}
	
}