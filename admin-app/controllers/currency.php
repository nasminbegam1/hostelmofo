<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Currency extends MY_Controller
{
	var $propertyLocationsTable 	= 'lp_language_master';
	var $businessTypeCategoryMaster = 'lp_business_type_category_master';
	var $businessTypeMaster ='lp_business_type_master';
	var $languageMaster = 'lp_language_master';
	var $ownerMaster ='lp_owner_master';
	var $agentMaster ='lp_agent_master';
	var $rentMaster ='lp_rent_master';
	var $countryCurrencyMaster = 'lp_country_currency_master';
	var $actionMaster = 'lp_action_master';
	var $taskMaster = 'lp_task_master';
	var $followupMaster ='lp_followup_master';
	var $propertyMaster = 'lp_property_master';
	var $countries = 'lp_countries';
	var $developmentMaster ='lp_development_master';
	var $enquiryMaster  = 'lp_enquiry_master';
	var $contactUsCategory = 'lp_contactus_category_master';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_currency');
		//$this->load->model('model_adminuser');
		$this->load->model('model_basic');
	}
	
	public function index()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL.currentClass()."/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CURRENCY');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword'] = $this->data['params']['search_keyword'];
			$this->data['per_page']	= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
		
		$start 				= 0;
		$page 				= $this->uri->segment(3,0);
		$this->data['countryMasterList']= $this->model_currency->getCurrencyList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'misc';	
		$this->data['base_url'] 	= BACKEND_URL.currentClass()."/currency_master/0/1/";
		$this->data['show_all']      	= BACKEND_URL.currentClass()."/currency_master/0/1/";
		$this->data['add_url']      	= BACKEND_URL.currentClass()."/add_currency_master/0/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.currentClass()."/edit_currency_master/{{ID}}/".$page."/";
		$this->data['view_link']      	= BACKEND_URL.currentClass()."/currency_details/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.currentClass()."/delete_currency_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL.currentClass()."/currency_master_action/0/".$page."/";
		
		$this->data['currency_rate_update_link'] = BACKEND_URL.currentClass()."/currency_rate_update/".$page;
		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-money';
		$this->data['brdLink'][0]['name']   =   'Currency Master';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-list';
		$this->data['brdLink'][1]['name']   =   'listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		//........................
		
		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');	
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']=currentClass().'/currency_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	
	public function currency_rate_update()
	{		 
		
		$Condition = " country_currency_status = 'active' ";
		$rs = $this->model_basic->getValues_conditions(CURRENCY_MASTER, '', '', $Condition);
                if( !empty($rs) ){
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
				$idArr	    = array('country_currency_id' => $country_currency_id );
				
				$ret   = $this->model_basic->updateIntoTable(CURRENCY_MASTER, $idArr,$updateArr);
				//pr($ret,0);
				if(isset($ret))
				{
					$this->nsession->set_userdata('succmsg', "Currency rate updated successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "unable to update currency rate. Please try again later.");
				}
				
				redirect(BACKEND_URL.currentClass()."/index/");
				return true;
			}
		    }
		    
                }
		
		//redirect(BACKEND_URL.currentClass()."/index/".$page."/");
	        //return true;  
	}
	
	
	public function add_currency_master()
	{
		
		$this->chk_login();
		$this->load->library('simple_html_dom');
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= currentClass();
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_currency_master/".$page;
		
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= COUNTRIES;
		$condition      =  "country_status='active'";
		$orderField	= 'countryName';
		$orderBy	= 'ASC';
				
		$this->data['arr_country_name'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('country_name', 'Country name', 'trim|required|callback_is_currency_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$country_name	= addslashes(trim($this->input->get_post('country')));
				$country_code   = addslashes(trim($this->input->get_post('country_code')));
				$country_currency_symbol   = addslashes(trim($this->input->get_post('currency_symbol')));				 $currency_name  = addslashes(trim($this->input->get_post('currency_name')));
				$currency_code  = addslashes(trim($this->input->get_post('currency_code')));
				$rental_price   = addslashes(trim($this->input->get_post('rental_price')));
				$sales_price    = addslashes(trim($this->input->get_post('sales_price')));
				
				if($this->input->get_post('updationmode')=='m')
				{
					$amount_multiplier = $this->input->get_post('manualrate');
					$amount_multiplier_usd = $this->input->get_post('manualrate_usd');
					$insertArr  =  array(
							'country_name' => $country_name,
							'country_code'=>$country_code,
							'currency_code'=>$currency_code,
							'country_currency_symbol'=>$country_currency_symbol,
							'currency_rate'=>$amount_multiplier,
							'currency_name'=>$currency_name,
							'rate_updation_mode'=>0
						    );
				}
				else
				{
					$currency_code  = addslashes(trim($this->input->get_post('currency_code')));
					
					if($currency_code != DEFAULT_CURRENCY){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to='.DEFAULT_CURRENCY);
						foreach($html->find("div#currency_converter_result span.bld") as $element){
							$currency_rate = $element->innertext;
						      }
						$currency = explode(" ".DEFAULT_CURRENCY,$currency_rate);
						$amount_multiplier = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier = 1;
					}
					
					
					
					$insertArr  =  array(
							'country_name' => $country_name,
							'country_code'=>$country_code,
							'currency_code'=>$currency_code,
							'country_currency_symbol'=>$country_currency_symbol,
							'currency_rate'=>$amount_multiplier,
							'currency_name'=>$currency_name,
							);
					
					
				}
				$ret   = $this->model_basic->insertIntoTable(CURRENCY_MASTER,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Currency added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "unable to add currency . Please try again later.");
				}
    
				redirect(BACKEND_URL.currentClass()."/index/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-money';
		$this->data['brdLink'][0]['name']   =   'Currency Master';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-money';
		$this->data['brdLink'][1]['name']   =   'Add';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		//........................
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='currency/add_currency_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function get_country_currency()
	{
		$country_code = $this->input->get_post('theOption',true);
		$resultstring =$this->model_currency->getCountryCurrencycode($country_code);
		echo $resultstring; 
	}
	
	public function edit_currency_master()
	{
		
		chk_login();
		$this->load->library('simple_html_dom');
		$page		= $this->uri->segment(4, 0);
		$country_currency_id = $this->uri->segment(3, 0);
		$this->data['controller']	= currentClass();
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_currency_master/".$country_currency_id."/".$page;
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= COUNTRIES;
		$condition      =  "country_status='active'";
		$orderField	= 'countryName';
		$orderBy	= 'ASC';
				
		$this->data['arr_country_name'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('country_name', 'Country name', 'trim|required|callback_is_currency_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				
				$country_name			= addslashes(trim($this->input->get_post('country')));
				$country_code   		= addslashes(trim($this->input->get_post('country_code')));
				$country_currency_symbol   	= addslashes(trim($this->input->get_post('currency_symbol')));				      $currency_name   		      = addslashes(trim($this->input->get_post('currency_name')));
				$currency_code  		= addslashes(trim($this->input->get_post('currency_code')));
				$rental_price   		= addslashes(trim($this->input->get_post('rental_price')));
				$sales_price    		= addslashes(trim($this->input->get_post('sales_price')));
				
				$rental_slider_increment    	= addslashes(trim($this->input->get_post('rental_slider_increment')));
				$sales_slider_increment    	= addslashes(trim($this->input->get_post('sales_slider_increment')));
				
				if($this->input->get_post('updationmode')=='m')
				{
					$amount_multiplier = $this->input->get_post('manualrate');
					$amount_multiplier_usd = $this->input->get_post('manualrate_usd');
					
					$updateArr  =  array(
								'country_name' => $country_name,
								'country_code'=>$country_code,
								'currency_code'=>$currency_code,
								'currency_name'=>$currency_name,
								'country_currency_symbol'=>$country_currency_symbol,
								'currency_rate'=>$amount_multiplier,
								'rate_updation_mode'=>0
								
							 );
					
					$idArr	    = array(
								'country_currency_id' => $country_currency_id
							);
				}
				else
				{
					$currency_code  = addslashes(trim($this->input->get_post('currency_code')));
				
					if($currency_code != DEFAULT_CURRENCY){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to='.DEFAULT_CURRENCY);
						foreach($html->find("div#currency_converter_result span.bld") as $element){
							$currency_rate = $element->innertext;
						      }
						$currency = explode(" ".DEFAULT_CURRENCY,$currency_rate);
						$amount_multiplier = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier = 1;
					}
					
					
					$updateArr  =  array(
								'country_name' => $country_name,
								'country_code'=>$country_code,
								'currency_code'=>$currency_code,
								'currency_name'=>$currency_name,
								'country_currency_symbol'=>$country_currency_symbol,
								'currency_rate'=>$amount_multiplier,
								'rate_updation_mode'=>1
								
							 );
					
					$idArr	    = array(
								'country_currency_id' => $country_currency_id
							);
					
				}
				//pr($updateArr);
				$ret   = $this->model_basic->updateIntoTable(CURRENCY_MASTER,$idArr,$updateArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Currency updated successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update currency . Please try again later.");
				}
    
				redirect(BACKEND_URL.currentClass()."/index/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		// Prepare Data
		$Condition = " country_currency_id = '".$country_currency_id."'";
		$rs = $this->model_basic->getValues_conditions(CURRENCY_MASTER, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['countryCurrencyDetails'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/currency_master/".$page."/");
                        return false;
		}

		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-money';
		$this->data['brdLink'][0]['name']   =   'Currency Master';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-money';
		$this->data['brdLink'][1]['name']   =   'Edit';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0);';
		
		
		//........................
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='currency/edit_currency_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function delete_currency_master()
	{
		chk_login();
		
		$country_currency_id	= $this->uri->segment(3);
		$where			= "country_currency_id = '".$country_currency_id."'";
		
		
			$delete_where = "country_currency_id = '".$country_currency_id."'";
			$this->model_basic->deleteData(CURRENCY_MASTER, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected country and currency deleted successfully.");
		
		
		redirect(BACKEND_URL.currentClass()."/index/");
		return true;
	}
	
	
	public function currency_master_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteCountryCurrencyBatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchCountryCurrencyStatus('active', $pagearray);
		}
		
		else if($action == 'Inactivate')
		{ 
			$this->batchCountryCurrencyStatus('inactive', $pagearray);
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL.currentClass()."/index/".$page);
		return true;
		
			
	}
	
	public function deleteCountryCurrencyBatch($pagearray)
	{
						
		if(is_array($pagearray))
		{
			
			$delete_where	= "FIND_IN_SET(country_currency_id, '".implode(",", $pagearray)."')";
			$this->model_basic->deleteData(CURRENCY_MASTER, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected country and currency deleted successfully.");
			
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	
	}
	
	private function batchCountryCurrencyStatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus(CURRENCY_MASTER, $idArray, 'country_currency_status', $status, 'country_currency_id');		
		
		if($return == 'noitem')
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->nsession->set_userdata('succmsg', " Selected country currency status activated successfully.");
		}elseif($return == 'active')
		{
			$this->nsession->set_userdata('succmsg', "Selected country currency  status inactivated successfully.");
		}		
		return true;
	}
	
	public function is_currency_exists($country_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'country_code' => $country_name,
						 'country_currency_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('country_code' => $country_name );
		}
		
		$bool = $this->model_basic->checkRowExists(CURRENCY_MASTER , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_currency_exists', 'The %s  already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
		
		
	}
	public function currency_details()
	{
		
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$country_currency_id = $this->uri->segment(3, 0);
		$this->data['controller']	= currentClass();
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['view_url'] 	= BACKEND_URL.$this->data['controller']."/index/".$country_currency_id."/".$page."/";
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= COUNTRIES;
		$condition      =  "country_status='active'";
		$orderField	= 'countryName';
		$orderBy	= 'ASC';
				
		$this->data['arr_country_name'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		
                $row = array();
		// Prepare Data
		$Condition = " country_currency_id = '".$country_currency_id."'";
		$rs = $this->model_basic->getValues_conditions(CURRENCY_MASTER, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['countryCurrencyDetails'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/");
                        return false;
		}

		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-money';
		$this->data['brdLink'][0]['name']   =   'Currency Master';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-money';
		$this->data['brdLink'][1]['name']   =   'Details';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0);';
		
		//........................
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='currency/currency_details';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
		
	
	
	public function currency_updata(){
		
		$Condition = " country_currency_status = 'active' ";
		$rs = $this->model_basic->getValues_conditions($this->countryCurrencyMaster, '', '', $Condition);
                if( !empty($rs) ){
		    foreach($rs as $single){
			//pr($single,0);
			$currency_code = $single['currency_code'];
			$country_currency_id  = $single['country_currency_id'];
			if($single['rate_updation_mode'] == 1 && $single['country_currency_status'] == 'active'){
				$xml = new SimpleXMLElement(file_get_contents('http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency='.$currency_code.'&ToCurrency=THB'));
				//pr($xml,0);
				$currency = $xml[0];
				$amount_multiplier = $currency;
				
				$xml2 = new SimpleXMLElement(file_get_contents('http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency='.$currency_code.'&ToCurrency=USD'));
				//pr($xml2,0);
				$currency_usd = $xml2[0];
				$amount_multiplier_usd = $currency_usd;
				echo "<br /> Currency -- ".$currency_code."<br />THB multiplier -- ".$amount_multiplier."<br />USD multiplier -- ".$amount_multiplier_usd." <br />";
				
				$updateArr  =  array( 'currency_rate'=>$amount_multiplier, 'currency_rate_usd'=>$amount_multiplier_usd );
				$idArr	    = array('country_currency_id' => $country_currency_id );
				
				$ret   = $this->model_basic->updateIntoTable($this->countryCurrencyMaster,$idArr,$updateArr);
				echo "update status--".$ret."<br /><br />";
			}
		    }
		    
                }
	}
	
	/******* end of currency master *******/
	
		
	
}