<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salons extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_salons');
		$this->load->model('model_salonusers');
		$this->load->model('model_basic');
		$this->load->model('model_inventory');
	}
	
	
	public function index(){			
					
		if($this->input->post('action') == 'statusChange'){
			    $id = $this->input->post('salon_id');
			   //$status = $this->input->post('salon_status');
		            $salon = $this->model_salons->getSingle($id);		
                            //$this->model_salons->updateOption($id);
		
			    $this->model_basic->updateIntoTable('bs_salons',array('salon_id'=>$id),array('salon_status'=>$this->input->post('salon_status')));
			    $this->model_salonusers->updateStatus($id);
			    
			    if($salon[0]['salon_status']!='approved' && $this->input->post('salon_status')=='approved'){			
				$setting =$this->model_basic->getValues_conditions('bs_sitesettings','sitesettings_value','','sitesettings_id=45');
                                $trialDaysLimit = intval($setting[0]['sitesettings_value']);
				
				$str = $salon[0]['salon_name'];
				$snameArr = explode(' ',$str);
				$sstr = '';
				foreach($snameArr as $name){
					if(count($snameArr)>1){
						$sstr.= strtoupper(substr($name,0,1));
					}
					else
					$sstr = strtoupper(substr($name,0,2));
				}
				$sstr.= $id;
				
				$appPrefix = strtoupper($salon[0]['salon_name']);
				
				$this->model_basic->updateIntoTable('bs_salons',array('salon_id'=>$id),array('expiry_date'=>date('Y-m-d', strtotime("+".$trialDaysLimit." days")), 'activated_at'=>date('Y-m-d h:i:s'), 'salon_initials'=>$sstr, 'appointment_prefix'=>$appPrefix));
				// New code to add payment into payment history
				$this->model_basic->insertIntoTable('bs_payment_history', array('salon_id'=>$id,'payment_date'=>date('Y-m-d h:i:s'),'payment_amount'=>0,'transaction_type'=>'subscription','transaction_type_id'=>0,'payment_type_id'=>7,'description'=>' Trial Price ('.date('Y-m-d').' - '.date('Y-m-d', strtotime("+".$trialDaysLimit." days")).')','added_on'=>date('Y-m-d H:i:s')));
				/////////////////////////////
				$ifOrderexist = $this->model_basic->isRecordExist('bs_orders',"salon_id=".$id);
				if($ifOrderexist==0){
				        $this->model_basic->insertIntoTable('bs_orders',array('salon_id'=>$id,'price'=>0,'subscription_type'=>'trial','created_at'=>date('Y-m-d H:i:s')));
					$salonuser =$this->model_basic->getValues_conditions('bs_salon_users','','','salon_id='.$id.' and users_type=5');
					$infoEmail =$this->model_basic->getValues_conditions('bs_sitesettings','sitesettings_value','','sitesettings_id=13');
					//$emailTemplate =$this->model_basic->getValues_conditions('bs_email_templete','','','templete_id=18');
					$emailTemplate =$this->model_basic->getFromWhereSelect('bs_email_templete','','email_group=1 AND language_id='.$salon[0]['language']);
				
					// set permission
					$permissionData = array(
								'role_id' => $salonuser[0]['users_type'],
								'salon_id'=> $salon[0]['salon_id'] ,
								'access_permision_id' =>'1,2,3,4,5,6,7,8,9,10',
								);
					$this->model_basic->insertIntoTable('bs_group_permissions',$permissionData);
					$settings =$this->model_basic->getValues_conditions('bs_sitesettings','sitesettings_value','','sitesettings_id IN (51,52,53,54)'); 
					foreach($settings as $r){
					      $$r['sitesettings_name'] = $r['sitesettings_value'];
					}
					//**************  Account Activation Email *******************//
					$to      = $salonuser[0]['users_email'];
					$from    = $infoEmail[0]['sitesettings_value'];
					$subject = $emailTemplate[0]['email_subject'];
					$message = stripslashes($emailTemplate[0]['email_content']);
					//$message = BuildEmailMessageSteAdmin($message,$id);
					$message = BuildEmailMessageSalonUser($message,$salonuser[0]['users_id']);
					
					if(count($salonuser)>0){
					//$config = array('to'=>$to,'from'=>$from,'from_name'=>DOMAIN_NAME,'subject'=>$subject,'message'=>$message);
					//sendHtmlEmail($config);
						$config = array(
						  'to'=>$to,
						  'from'=>$from,
						  'from_name'=>DOMAIN_NAME,
						  'subject'=>$subject,
						  'message'=>$message,
						  'smtp_host' => $smtp_host,
						  'smtp_port' => $smtp_port,
						  'smtp_user' => $smtp_username,
						  'smtp_pass' => $smtp_password,
						  );
						 send_html_email($config);
					}
				}
				
			    }
			    $this->nsession->set_userdata('succmsg', "Salon Updated successfully.");
		}
		
		$this->chk_login();
		$config['base_url'] 	= ADMIN_URL."salons/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('SALONSETTINGS');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
			$this->data['per_page']		= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
		
		$start 				= 0;
		$page 				= $this->uri->segment(3,0);
		$this->data['records']		= $this->model_salons->getList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'misc';	
		$this->data['base_url'] 	= ADMIN_URL."salons/index/0/1/";				
		$this->data['show_all']      	= ADMIN_URL."salons/index/0/1/";
		$this->data['view_details_link']= ADMIN_URL."salons/view_salon_details/{{ID}}/".$page."/";
		$this->data['edit_link']      	= ADMIN_URL."salons/edit/{{ID}}/".$page."/";
		$this->data['view_contact_link']= ADMIN_URL."salons/view_contact/{{ID}}/".$page."/";
		$this->data['view_appointments_link']	= ADMIN_URL."salons/view_appointments/{{ID}}/".$page."/";
		$this->data['view_inventory_link']	= ADMIN_URL."salons/view_inventory/{{ID}}/".$page."/";
		$this->data['delete_link']      	= ADMIN_URL."salons/delete/{{ID}}/".$page."/";
		$this->data['product_inventory']        = ADMIN_URL."salons/productinventory/{{ID}}/".$page."/";
		$this->data['fixed_inventory']        = ADMIN_URL."salons/fixedassetinventory/{{ID}}/".$page."/";
		$this->data['order_manager']        = ADMIN_URL."salons/ordermanager/{{ID}}/".$page."/";
		$this->data['product_usage']        = ADMIN_URL."salons/productusage/{{ID}}/".$page."/";
		$this->data['product_sales']        = ADMIN_URL."salons/productsales/{{ID}}/".$page."/";
		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');			
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$brd_arr[] = array('link'=>base_url('salons'), 'text' => 'Salons List','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );
		
		$this->data['breadcrumbs'] = $brd_arr;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('salons');
		$this->elements['middle']='salons/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		//pr($this->data['records']);
	}
	public function productsales(){
		$this->chk_login();
		$this->data = '';
		$this->data['record'] = '';
		$salon_id  	= $this->uri->segment(3, 0);
		
		//$row = $rs[0];
		$rs = $this->model_salons->getSingle($salon_id);
                if(!$rs){
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(ADMIN_URL.$this->data['controller']."/index/".$salon_id."/".$page."/");
                        return false;
                }
		$this->data['getSingle']	= $rs[0];
		$this->data['staffs'] = $this->model_basic->getValues_conditions('bs_salon_users','','','salon_id='.$salon_id.' AND users_type = 3');
		
		
		$start_date = $this->input->post('start_date') != ''?$this->input->post('start_date'):date('m/01/Y');
		$end_date = $this->input->post('end_date') != ''?$this->input->post('end_date'):date('m/t/Y');
		$staff_id = $this->input->post('staff');
		$reports = $this->model_salons->getSalesReport($staff_id,$start_date,$end_date,$salon_id);
		$report_arr = array();
		if(is_array($reports) && count($reports)){
			foreach($reports as $key=>$product){
				
				$report_arr[] = array(
							$product['product_name'],
							$product['invoice_quantity'],
							$this->nsession->userdata('currency_symbol').$product['cost_price'],
							$this->nsession->userdata('currency_symbol').$product['invoice_sale_price'],
							$this->nsession->userdata('currency_symbol').($product['invoice_sale_price']*$product['invoice_quantity']),
							$this->nsession->userdata('currency_symbol').($product['invoice_sale_price']*$product['invoice_quantity']-$product['cost_price']*$product['invoice_quantity']),
							);
				
				
			}

		}
		//pr($inventory_records);
		$this->data['record'] = $report_arr;
		
		
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('salons');
		$this->elements['middle']='salons/productsales';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
		
	}
	public function productusage(){
		$this->chk_login();
		$this->data = '';
		$this->data['record'] = '';
		$salon_id  	= $this->uri->segment(3, 0);
		
		//$row = $rs[0];
		$rs = $this->model_salons->getSingle($salon_id);
                if(!$rs){
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(ADMIN_URL.$this->data['controller']."/index/".$salon_id."/".$page."/");
                        return false;
                }
		$this->data['getSingle']	= $rs[0];
		
		$report_arr = array();
		$start_date = $this->input->post('start_date') != ''?$this->input->post('start_date'):date('m/01/Y');
		$end_date = $this->input->post('end_date') != ''?$this->input->post('end_date'):date('m/t/Y');
		 
		$reports = $this->model_salons->getUsageReport($start_date,$end_date,$salon_id);
		
		if(is_array($reports) && count($reports)){
			foreach($reports as $key=>$product){
				$report_arr[] = array(
							$product['product_name'],
							$product['inventory_quantity'],
							$this->nsession->userdata('currency_symbol').$product['sell_price'],
							$this->nsession->userdata('currency_symbol').($product['inventory_quantity']*$product['sell_price']),
							$product['invoice_quantity'],
							$this->nsession->userdata('currency_symbol').$product['invoice_unit_price'],
							$this->nsession->userdata('currency_symbol').($product['invoice_quantity']*$product['invoice_unit_price']),
							0,
							0,
							0
							);
			}

		}
		//pr($inventory_records);
		$this->data['record'] = $report_arr;
		
		
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('salons');
		$this->elements['middle']='salons/productusage';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
		
	}
	public function ordermanager(){
		$this->chk_login();
		$this->data = '';
		$this->data['record'] = '';
		$salon_id  	= $this->uri->segment(3, 0);
		$rs = $this->model_salons->getSingle($salon_id);
		//$row = $rs[0];
 