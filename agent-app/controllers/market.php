<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Market extends My_Controller 
{
        //var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_booking_list');
		$this->load->model('model_market');
	}
	public function index()
	{
		$this->chk_login();		
		$property_id= $this->uri->segment(3);
		$this->data['serviceFee'] = array();
		
		$this->data['tabs'] = $this->load->view('market/tab',array('select_tab'=>'market','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'market',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		
		
		$this->data['serviceFee'] = $this->model_market->getServiceFee($property_id);
		
		if (array_key_exists("cityId",$this->data['serviceFee']))
		{
			$cityId   = $this->data['serviceFee']['cityId'];	
		}
		else
		{
			$cityId   = 0;
		}
		
		
		$cityId	= $cityId['city_id'];		  
		$this->data['propertyId'] = $this->model_market->getPropertyId($property_id, $cityId);
		$this->data['faqList'] 	  = $this->model_basic->getValues_conditions('hw_faq_master','','','','faq_order');
		$this->data['rankLog'] 	  = $this->model_basic->getValues_conditions('hw_logs','','','property_id = '.$property_id,'added_date','DESC');
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='market/marketView';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}

	public function updateService()
	{
		$property_master_id	= $this->uri->segment(3);
		$service_value		= $this->uri->segment(4); 
		$service_valueF  	= array('service_fees' =>$service_value);
		$changeUpdateService 	= $this->model_basic->updateIntoTable(PROPERTY_MASTER, array('property_master_id' =>$property_master_id),$service_valueF);
		$curr_rank =	$this->model_basic->getValue_condition('hw_property_master', 'rank','','property_master_id = '.$property_master_id);
		$insertArr	=	array(
						'property_id'	=> $property_master_id,
						'rank'		=> $curr_rank,
						'service_fees'	=> $service_value,
						'added_date'	=> date('Y-m-d H:i:s')					
					);
		$this->model_basic->insertIntoTable('hw_logs',$insertArr);
		//$service_value_update = $this->model_market->update($property_master_id,$service_value);
		$property_list	=	$this->model_basic->getValues_conditions('hw_property_master', array('property_master_id','service_fees','rank'),'','', 'service_fees DESC,avarage_rating DESC');
		if(is_array($property_list) && COUNT($property_list)>0)
		{
			$rank		=	1;
			foreach($property_list as $v)
			{
				if($v['rank'] != $rank)
				{
					$insertArr	=	array(
									'property_id'	=> $v['property_master_id'],
									'rank'		=> $rank,
									'service_fees'	=> $v['service_fees'],
									'added_date'	=> date('Y-m-d H:i:s')					
								);
					$this->model_basic->insertIntoTable('hw_logs',$insertArr);
				}
				$this->model_basic->updateIntoTable('hw_property_master', array('property_master_id' => $v['property_master_id']),array('rank' => $rank));
				$rank++;
			}
		}
		redirect(AGENT_URL."market/index/".$property_master_id);
	}

	public function booking_engine()
	{
		$this->chk_login();		
		$property_id= $this->uri->segment(3);		
		$this->data['tabs'] = $this->load->view('market/tab',array('select_tab'=>'customerAnalysis','property_id'=>$property_id),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'market',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		$this->data['booking_detils'] =	$this->model_basic->getValues_conditions('hw_cms',array('cms_content'),'','cms_id = 47');
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='market/booking_engine';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function featured_listing()
	{
		$this->chk_login();		
		$property_id= $this->uri->segment(3);		
		$this->data['tabs'] = $this->load->view('market/tab',array('select_tab'=>'bookingAnalysis','property_id'=>$property_id),true);
		$propertDtls 	    = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',array('select_tab'=>'market','property_id'=> $property_id, 'propertDtls'=>$propertDtls),true);
		$this->data['featured_property'] =	$this->model_market->getFeatured($property_id);
		$this->data['month_list'] = $this->model_market->getMonthList($property_id);
		$this->data['succmsg'] 	  = $this->nsession->userdata('succmsg');
		$this->data['errmsg']     = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");        
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('property');
		$this->elements['middle']='market/featured_listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
	}
	
	public function payment()
	{
		$this->chk_login();
		$payment_details= $_POST;
		if($payment_details['payment_type'] == 'credit')
		{		
			$this->load->library('securepay');		
			$property_id	= $payment_details['property_id'];
			$month_arr	= explode('@',$payment_details['selected_date']);
			$payble_amount  = $payment_details['final_price'];
			$cc_number      = $payment_details['cc_number'];
			$exp_date       = $payment_details['exp_date'];
			$cvv            = $payment_details['cvv'];
			$ins_id         = rand(10000,50000);
			if($payble_amount>0)
			{    
			    $sp = new SecurePay('ABC0001','abc123');
			    $sp->TestMode();
			    $sp->TestConnection();
			    $sp->Cc = $cc_number;
			    $sp->ExpiryDate = $exp_date;
			    $sp->ChargeAmount = $payble_amount;
			    $sp->ChargeCurrency = 'USD';
			    $sp->Cvv = $cvv;
			    $sp->OrderId = $ins_id;
			    if ($sp->Valid())
			    {
				$response = $sp->Process();
				if($response['TransactionId'] != '' && isset($response['TransactionId'])){
				$update_arr['TransactionId']   = $response['TransactionId'];
				}
				if ($response['result'] == SECUREPAY_STATUS_APPROVED)
				{
				    $succmsg =  "Transaction was a success\n";
				    $payment_status                 = 'Success';
				    $update_arr['payment_status']   = 'Success';
				    $idArr['paymeny_id']            = $ins_id;			    
					if(is_array($month_arr) && COUNT($month_arr)>0)
					{
						foreach($month_arr as $v)
						{						
							if($v != '')
							{
								$insert_arr	=	array(
											      'property_id' 	    => $property_id,
											      'month_registerd_for' => date('Y-m-d',strtotime('01-'.$v)),
											      'transaction_id' 	    => $update_arr['TransactionId'],
											      'payment_amount'	    => 175,
											      'payment_type'	    => 'Credit Card'
											      );
								$this->model_basic->insertIntoTable('hw_featured_payment',$insert_arr);
							}
						}
					}
					echo 1;exit;
				}
				else
				{           
				    $errmsg =  "Transaction failed :".$sp->Error."\n";
				    $update_arr['transaction_details'] = addslashes($sp->Error);;
				    $idArr['paymeny_id'] = $ins_id;
				    echo 0;exit;
				}
				
			    }
			    else
			    {
				if (!$sp->ValidCc()) {
				$errmsg =  "Credit Card Number is invalid\n";
				} elseif (!$sp->ValidExpiryDate()) {
				    $errmsg =  "Expiry Date is invalid\n";
				} elseif (!$sp->ValidCvv()) {
				    $errmsg =  "CVV is invalid\n";
				} elseif (!$sp->ValidChargeAmount()) {
				    $errmsg =  "Charge Amount is invalid\n";
				} elseif (!$sp->ValidChargeCurrency()) {
				    $errmsg =  "Charge Currency is invalid\n";
				} elseif (!$sp->ValidOrderId()) {
				    $errmsg =  "Order ID is invalid\n";
				} else {
				    $errmsg =  "All data is valid\n";
				}    
				echo $errmsg;exit;
			    }
			}
		}
		else
		{
			$property_id	= $payment_details['property_id'];
			$month_arr	= explode('@',$payment_details['selected_date']);
			$payble_amount  = $payment_details['final_price'];
			//$voucher_code	= explode('@',$payment_details['voucher_code']);
			if(is_array($month_arr) && COUNT($month_arr)>0)
			{
				foreach($month_arr as $k=>$v)
				{						
					if($v != '')
					{
						$insert_arr	=	array(
									      'property_id' 	    => $property_id,
									      'month_registerd_for' => date('Y-m-d',strtotime('01-'.$v)),
									      'transaction_id' 	    => rand(100000,500000),
									      'voucher_code'	    => $payment_details['voucher_code'],
									      'payment_type'	    => 'Voucher'
									      );
						$this->model_basic->insertIntoTable('hw_featured_payment',$insert_arr);
					}
				}
			}
			echo 1;exit;
		}
	}
}	
?>