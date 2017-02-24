<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Misc extends CI_Controller
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
		$this->load->model('model_misc');
		$this->load->model('model_adminuser');
		$this->load->model('model_basic');
	}
	
	/*** for Business Type Category ***/
	public function business_type_category()
	{
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/business_type_category/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('BUSINESS_TYPE_CATEGORY');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['businessTypeCategoryList']	= $this->model_misc->getBusinessTypeCategoryList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/business_type_category/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_business_type_category/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_business_type_category/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_business_type_category/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/business_type_category_batch/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/business_type_category',$this->data);
		
		$brdArr	= array( "MISC settings" => $this->data['base_url'], "Business Type Category Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/business_type_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	function is_businesstypecategory_exists($business_type_category_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'business_type_category_name' => $business_type_category_name,
						 'business_type_category_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('business_type_category_name' => $business_type_category_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->businessTypeCategoryMaster , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_businesstypecategory_exists', 'The %s  already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
	}
	
	public function add_business_type_category()
	{
		$this->chk_login();
		
		$business_type_category_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/business_type_category/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('business_type_category_name', 'Business type category name', 'trim|required|callback_is_businesstypecategory_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$business_type_category_name	= addslashes(trim($this->input->get_post('business_type_category_name')));
				
				$insertArr  =  array(
							'business_type_category_name' => $business_type_category_name				
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->businessTypeCategoryMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Business type category added successfully.");	
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to add business type category. Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/business_type_category/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				"Business Type Category Listing" => $this->data['return_link'],
				 "Add business type category" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/add_business_type_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function edit_business_type_category()
	{
		$this->chk_login();
		
		$business_type_category_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/business_type_category/".$page;
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('business_type_category_name', 'Business type category name', 'trim|required|callback_is_businesstypecategory_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$business_type_category_name	= addslashes(trim($this->input->get_post('business_type_category_name')));
						$insertArr  =  array(
							'business_type_category_name' => $business_type_category_name
							
						);
				
				$idArr		= array(
							'business_type_category_id' => $business_type_category_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->businessTypeCategoryMaster,$idArr, $insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Business type  category updated successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."misc/business_type_category/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " business_type_category_id = '".$business_type_category_id."'";
		$rs = $this->model_basic->getValues_conditions($this->businessTypeCategoryMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['business_type_category'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/business_type_category/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/type_edit',$this->data);
		
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				"Business Type Category Listing" => $this->data['return_link'],
				 "Edit business type category" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/edit_business_type_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_business_type_category()
	{
		$this->chk_login();
		
		$business_type_category_id	= $this->uri->segment(3);
		$where			= "business_type_category_id = '".$business_type_category_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->businessTypeMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected lead type in used. Can not delete.");
		}
		else
		{
			$delete_where = "business_type_category_id = '".$business_type_category_id."'";
			$this->model_basic->deleteData($this->businessTypeCategoryMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected business type category deleted successfully.");
		}
		
		redirect(BACKEND_URL."misc/business_type_category/");
		return true;
	}
	
	
	public function business_type_category_batch()
	{
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteBusinesstypeCategorybatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchBusinesstypeCategorystatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchBusinesstypeCategorystatus('inactive', $pagearray);
		} else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/business_type_category/".$page);
		return true;
			
	}
	
	private function deleteBusinesstypeCategorybatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(business_type_category_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->businessTypeMaster, $where);
			
			if($i_delete_chk > 0){
				$this->session->set_userdata('errmsg', "Selected Business type category in used. Can not delete.");
			} else {
				
				$delete_where	= "FIND_IN_SET(business_type_category_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->businessTypeCategoryMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected business type category deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchBusinesstypeCategorystatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->businessTypeCategoryMaster, $idArray, 'business_type_category_status', $status, 'business_type_category_id');		
		
		if($return == 'noitem'){
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->session->set_userdata('succmsg', " Selected business type category status activated successfully.");
		}elseif($return == 'active'){
			$this->session->set_userdata('succmsg', "Selected business type category status inactivated successfully.");
		}		
		return true;
	}
	
	
	
	
	public function contact_us_category()
	{

		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/contact_us_category/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CONTACT_US_CATEGORY');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['contactUsCategoryList']	= $this->model_misc->getContactUsCategoryList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/contact_us_category/0/1/";
		$this->data['show_all'] 		= BACKEND_URL."misc/contact_us_category/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_contact_us_category/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_contact_us_category/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_contact_us_category/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/contact_us_category_batch/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/contact_us_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	
	
	function is_contactuscategory_exists($contactus_category_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'category_name' => $contactus_category_name,
						 'category_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('category_name' => $contactus_category_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->contactUsCategory , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_contactuscategory_exists', 'The %s  already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
	}
	
	
	
	
	public function add_contact_us_category()
	{
		chk_login();
		
		$business_type_category_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/contact_us_category/".$page;
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_contact_us_category/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('contact_us_category_name', 'Contact Us Category Name', 'trim|required|callback_is_contactuscategory_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$contact_us_category_name	= addslashes(trim($this->input->get_post('contact_us_category_name')));
				
				$insertArr  =  array(
							'category_name' => $contact_us_category_name,
							'date_added'=> date('Y-m-d H:i:s')
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->contactUsCategory,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Contact us category added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add contact us category. Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/contact_us_category/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/add_contact_us_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function edit_contact_us_category()
	{
		chk_login();
		
		$contact_us_category_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/contact_us_category/".$page;
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_contact_us_category/".$contact_us_category_id."/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('contact_us_category_name', 'Contact us category name', 'trim|required|callback_is_contactuscategory_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else
			{
				$contact_us_category_name	= addslashes(trim($this->input->get_post('contact_us_category_name')));
						$updateArr  =  array(
							'category_name' => $contact_us_category_name,
							'date_modified'=>date('Y-m-d H:i:s')
							
						);
				
				$idArr		= array(
							'category_id' => $contact_us_category_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->contactUsCategory,$idArr, $updateArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Contact us category updated successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."misc/contact_us_category/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = "category_id = '".$contact_us_category_id."'";
		$rs = $this->model_basic->getValues_conditions($this->contactUsCategory, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['contact_us_category'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/contact_us_category/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/edit_contact_us_category';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	
	
	public function delete_contact_us_category()
	{
		chk_login();
		
		$contact_us_category_id	= $this->uri->segment(3);
		
		
			$delete_where = "category_id = '".$contact_us_category_id."'";
			$this->model_basic->deleteData($this->contactUsCategory, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected contact us  category deleted successfully.");
		
		
		redirect(BACKEND_URL."misc/contact_us_category/");
		return true;
	}
	
	
	public function contact_us_category_batch()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteContactCategorybatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchContactCategorystatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchContactCategorystatus('inactive', $pagearray);
		} else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/contact_us_category/".$page);
		return true;
			
	}
	
	
	
	
	
	private function deleteContactCategorybatch($pagearray)
	{
		if(is_array($pagearray))
		{
			
				
				$delete_where	= "FIND_IN_SET(category_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->contactUsCategory, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected contact us  category deleted successfully.");
			
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchContactCategorystatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->contactUsCategory, $idArray, 'category_status', $status, 'category_id');		
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', " Selected  category status activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected  category status inactivated successfully.");
		}		
		return true;
	}
	
	
	
	/*** for Business Type Master ***/
	public function business_type()
	{
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/business_type/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('BUSINESS_TYPE');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['businessTypeList']		= $this->model_misc->getBusinessTypeList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/business_type/0/1/";	
		$this->data['add_url']      		= BACKEND_URL."misc/add_business_type/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_business_type/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_business_type/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL."misc/lead_type_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');		
		
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/business_type',$this->data);
		
		$brdArr	= array( "MISC settings" => $this->data['base_url'],
				
				"Business Type Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/business_type';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	function is_businesstype_exists($business_type_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'business_type_name' => $business_type_name,
						 'business_type_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('business_type_name' => $business_type_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->businessTypeMaster , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_businesstype_exists', 'The %s already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
	}
	
	public function add_business_type()
	{
		$this->chk_login();
		
		$business_type_category_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/business_type/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('business_type_name', 'Business type name', 'trim|required|callback_is_businesstype_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$business_type_name	= addslashes(trim($this->input->get_post('business_type_name')));
				
				$insertArr  =  array(
							'business_type_name' => $business_type_name				
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->businessTypeMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Business type added successfully.");	
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to add business type . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/business_type/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				"Business Type Listing" => $this->data['return_link'],
				"Add business type " => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/add_business_type';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function edit_business_type()
	{
		$this->chk_login();
		
		$business_type_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/business_type/".$page;
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('business_type_name', 'Business type name', 'trim|required|callback_is_businesstype_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$business_type_name	= addslashes(trim($this->input->get_post('business_type_name')));
						$insertArr  =  array(
							'business_type_name' => $business_type_name
							
						);
				
				$idArr		= array(
							'business_type_id' => $business_type_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->businessTypeMaster,$idArr, $insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Business type  updated successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."misc/business_type/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " business_type_id = '".$business_type_id."'";
		$rs = $this->model_basic->getValues_conditions($this->businessTypeMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['business_type'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/business_type/".$page."/");
                        return false;
		}

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/type_edit',$this->data);
		
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				"Business Type Listing" => $this->data['return_link'],
				"Edit business type " => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/edit_business_type';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_business_type()
	{
		$this->chk_login();
		
		$business_type_id	= $this->uri->segment(3);
		$where			= "business_type_id = '".$business_type_id."'";
		//no foreign key found for this table so dependency checking not done
		
		/*$i_delete_chk	= $this->model_basic->isRecordExist($this->businessTypeMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected lead type in used. Can not delete.");
		}*/
		//else
		/*{*/
			$delete_where = "business_type_id = '".$business_type_id."'";
			$this->model_basic->deleteData($this->businessTypeMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected business type deleted successfully.");
		/*}*/
		
		redirect(BACKEND_URL."misc/business_type/");
		return true;
	}
	
	
	public function lead_type_batch_action()
	{
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteBusinesstypeBatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchBusinesstypeStatus('active', $pagearray);
		}
		
		else if($action == 'Inactivate')
		{ 
			$this->batchBusinesstypeStatus('inactive', $pagearray);
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/business_type/".$page);
		return true;
			
	}
	
	private function deleteBusinesstypebatch($pagearray)
	{
		if(is_array($pagearray))
		{
			/*$where	= "FIND_IN_SET(business_type_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->businessTypeMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected Business type category in used. Can not delete.");
			}*/
			//else
			//{
				
				$delete_where	= "FIND_IN_SET(business_type_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->businessTypeMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected business type deleted successfully.");
			//}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchBusinesstypeStatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->businessTypeMaster, $idArray, 'business_type_status', $status, 'business_type_id');		
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', " Selected business type  status activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected business type  status inactivated successfully.");
		}		
		return true;
	}
	
	////////////
	
	
	/*** for Language Master ***/
	public function language_master()
	{ 
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/language_master/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('LANGUAGE');
		
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
		$this->data['languageMasterList']	= $this->model_misc->getLanguageList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/language_master/0/1/";				
		$this->data['show_all']      		= BACKEND_URL."misc/language_master/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_language_master/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_language_master/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_language_master/0/".$page."/";				
		$this->data['batch_action_link']	= BACKEND_URL."misc/batch_language_master_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');		
		
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/language_master',$this->data);
		
		$brdArr	= array( "MISC settings" => '',
				"Language Master Listing" => ''
				);
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/language_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	///////////////////////
	
	function is_language_exists($language_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'lang_name' => $language_name,
						 'lang_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('lang_name' => $language_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->languageMaster , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_language_exists', 'The %s  already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
	}
	
	public function add_language_master()
	{
		$this->chk_login();
		
		$language_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/language_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('language_name', 'Language name', 'trim|required|callback_is_language_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$language_name	= addslashes(trim($this->input->get_post('language_name')));
				
				$insertArr  =  array(
							'lang_name' => $language_name				
						    );
			    
				$ret   = $this->model_basic->insertIntoTable($this->languageMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Language added successfully.");	
				}
				else
				{
					$this->session->set_userdata('errmsg', "unable to add language . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/language_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		$brdArr	= array("Language master listing" => 'javascript:void(0)',
				"Language Master Listing" => $this->data['return_link'],
				"Add language" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/add_language_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function edit_language_master()
	{
		$this->chk_login();
		
		$language_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/language_master/".$page;
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('language_name', 'Language name', 'trim|required|callback_is_language_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$language_name	= addslashes(trim($this->input->get_post('language_name')));
						$insertArr  =  array(
							'lang_name' => $language_name
							
						);
				
				$idArr		= array(
							'lang_id' => $language_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->languageMaster,$idArr, $insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Language updated successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."misc/language_master/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " lang_id = '".$language_id."'";
		$rs = $this->model_basic->getValues_conditions($this->languageMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['language_master'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/language_master/".$page."/");
                        return false;
		}

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/type_edit',$this->data);
		
		
		$brdArr	= array("Language master listing" => 'javascript:void(0)',
				"Language Master Listing" => $this->data['return_link'],
				"Edit language" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/edit_language_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_language_master()
	{
		$this->chk_login();
		
		$language_id	= $this->uri->segment(3);
		$where		= "lang_id = '".$language_id."'";
		
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->ownerMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected language is used. Can not delete.");
		}
		else
		{
			$delete_where = "lang_id = '".$language_id."'";
			$this->model_basic->deleteData($this->languageMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected language deleted successfully.");
		}
		
		redirect(BACKEND_URL."misc/language_master/");
		return true;
	}
	
	
	public function batch_language_master_action()
	{
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteLanguageBatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchLanguageStatus('active', $pagearray);
		}
		
		else if($action == 'Inactivate')
		{ 
			$this->batchLanguageStatus('inactive', $pagearray);
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/language_master/".$page);
		return true;
			
	}
	
	private function deleteLanguageBatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(lang_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->ownerMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected language is used. Can not delete.");
			}
			else
			{
				
				$delete_where	= "FIND_IN_SET(lang_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->languageMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected language deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchLanguageStatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->languageMaster, $idArray, 'lang_status', $status, 'lang_id');		
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', " Selected language status activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected language  status inactivated successfully.");
		}		
		return true;
	}
	
	
	function is_development_exists($development_name)
	{
		//lead_id, lead_name, updated_on
		$id 	= $this->uri->segment(3, 0);
		if($id > 0)
		{
			$whereArr	= array( 'development_name' => $development_name,
						 'development_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('development_name' => $development_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->developmentMaster , $whereArr);
		
		if($bool == 0)
		{
			$this->form_validation->set_message('is_development_exists', 'The %s  already exists');
			return FALSE;
		}
		
		else
		{
			return TRUE;
		}
	}
	
	
	
	
	public function development_master()
	{ 
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/development_master/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('DEVELOPMENT');
		
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
		$this->data['developmentMasterList']	= $this->model_misc->getDevelopmentList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/development_master/0/1/";				
		$this->data['show_all']      		= BACKEND_URL."misc/development_master/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_development_master/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_development_master/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_development_master/0/".$page."/";				
		$this->data['batch_action_link']	= BACKEND_URL."misc/batch_development_master_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');		
		
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/language_master',$this->data);
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0);',
				"Development Master Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/development_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	public function add_development_master()
	{
		$this->chk_login();
		
		//$language_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/development_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('development_name', 'Development name', 'trim|required|callback_is_development_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$development_name	= addslashes(trim($this->input->get_post('development_name')));
				
				$insertArr  =  array(
							'development_name' => $development_name				
						    );
			    
				$ret   = $this->model_basic->insertIntoTable($this->developmentMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Development added successfully.");	
				}
				else
				{
					$this->session->set_userdata('errmsg', "unable to add development . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/development_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		
		

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				 "Development Master Listing" => $this->data['return_link'],
				 "Add development" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/add_development_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function edit_development_master()
	{
		$this->chk_login();
		
		$development_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/development_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('development_name', 'Development name', 'trim|required|callback_is_development_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			
			else
			{
				$development_name	= addslashes(trim($this->input->get_post('development_name')));
				
				$updateArr  =  array(
							'development_name' => $development_name				
						    );
				
				$idArr		= array(
							'development_id' => $development_id
							);
				
			    
				$ret   = $this->model_basic->updateIntoTable($this->developmentMaster,$idArr,$updateArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Development updated successfully.");	
				}
				else
				{
					$this->session->set_userdata('errmsg', "unable to update development . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/development_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		// Prepare Data
		$Condition = " development_id = '".$development_id."'";
		$rs = $this->model_basic->getValues_conditions($this->developmentMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['development_master'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/development_master/".$page."/");
                        return false;
		}
		
		

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		$brdArr	= array( "MISC settings" => 'javascript:void(0)',
				 "Development Master Listing" => $this->data['return_link'],
				 "Edit development" => '' );
		
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/edit_development_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function delete_development_master()
	{
		$this->chk_login();
		
		$development_id	= $this->uri->segment(3);
		$where			= "development_id = '".$development_id."'";
		
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected development is used. Can not delete.");
		}
		else
		{
			$delete_where = "development_id = '".$development_id."'";
			$this->model_basic->deleteData($this->developmentMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected development deleted successfully.");
		}
		
		redirect(BACKEND_URL."misc/development_master/");
		return true;
	}
	
	
	
	// language master
	
	
	public function batch_development_master_action()
	{
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteDevelopmentBatch($pagearray);
		}
				
		else if($action == 'Activate')
		{
			$this->batchDevelopmentStatus('active', $pagearray);
		}
		
		else if($action == 'Inactivate')
		{ 
			$this->batchDevelopmentStatus('inactive', $pagearray);
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/development_master/".$page);
		return true;
			
	}
	/*** start of Currency Master ***/
	
	private function deleteDevelopmentBatch($pagearray)
	{
		
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(development_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected development is used. Can not delete.");
			}
			else
			{
				
				$delete_where	= "FIND_IN_SET(development_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->developmentMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected development deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
	
	
	
	
	
	
	private function batchDevelopmentStatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->developmentMaster, $idArray, 'status', $status, 'development_id');		
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', " Selected development status activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected development  status inactivated successfully.");
		}		
		return true;
	}
	
	
	
	
	public function currency_master()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/currency_master/";
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
		$this->data['countryMasterList']= $this->model_misc->getCurrencyList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'misc';	
		$this->data['base_url'] 	= BACKEND_URL."misc/currency_master/0/1/";
		$this->data['show_all']      	= BACKEND_URL."misc/currency_master/0/1/";
		$this->data['add_url']      	= BACKEND_URL."misc/add_currency_master/0/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL."misc/edit_currency_master/{{ID}}/".$page."/";
		$this->data['view_link']      	= BACKEND_URL."misc/currency_details/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL."misc/delete_currency_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL."misc/currency_master_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');	
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/currency_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function add_currency_master()
	{
		
		chk_login();
		$this->load->library('simple_html_dom');
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/currency_master/".$page;
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_currency_master/".$page;
		$this->data['base_url'] 	= BACKEND_URL."misc/currency_master/0/1/";
		
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= $this->countries;
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
							'currency_rate'=>$amount_multiplier,							    'currency_name'=>$currency_name,
							'rental_max_price'=>$rental_price,							  'sales_max_price'=>$sales_price,
							'currency_rate_usd'=>$amount_multiplier_usd,
							'rate_updation_mode'=>0
						    );
				}
				else
				{
					$currency_code  = addslashes(trim($this->input->get_post('currency_code')));
					
					if($currency_code != 'THB'){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to=THB');
						foreach($html->find("div#currency_converter_result span.bld") as $element){
							$currency_rate = $element->innertext;
						      }
						$currency = explode(" THB",$currency_rate);
						$amount_multiplier = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier = 1;
					}
					
					if($currency_code != 'USD'){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to=USD');
						//echo $html. '<br>';
						foreach($html->find("div#currency_converter_result span.bld") as $element){
								$currency_rate = $element->innertext;
						      }
						$currency = explode(" USD",$currency_rate);
						$amount_multiplier_usd = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier_usd = 1;
					}
					
					$insertArr  =  array(
							'country_name' => $country_name,
							'country_code'=>$country_code,
							'currency_code'=>$currency_code,
							'country_currency_symbol'=>$country_currency_symbol,
							'currency_rate'=>$amount_multiplier,
							'currency_name'=>$currency_name,
							'rental_max_price'=>$rental_price,							  'sales_max_price'=>$sales_price,
							'currency_rate_usd'=>$amount_multiplier_usd
							);
					
					
				}
				$ret   = $this->model_basic->insertIntoTable($this->countryCurrencyMaster,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Currency added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "unable to add currency . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/currency_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/add_currency_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function edit_currency_master()
	{
		
		chk_login();
		$this->load->library('simple_html_dom');
		$page		= $this->uri->segment(4, 0);
		$country_currency_id = $this->uri->segment(3, 0);
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/currency_master/".$page;
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_currency_master/".$country_currency_id."/".$page;
		$this->data['base_url'] 	= BACKEND_URL."misc/currency_master/0/1/";
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= $this->countries;
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
								'rental_max_price'=>$rental_price,							  	  'sales_max_price'=>$sales_price,
								'country_currency_symbol'=>$country_currency_symbol,
								'currency_rate'=>$amount_multiplier,
								'currency_rate_usd'=>$amount_multiplier_usd,
								'rate_updation_mode'=>0,
								'rental_slider_increment'=>$rental_slider_increment,
								'sales_slider_increment'=>$sales_slider_increment,
							 );
					
					$idArr	    = array(
								'country_currency_id' => $country_currency_id
							);
				}
				else
				{
					$currency_code  = addslashes(trim($this->input->get_post('currency_code')));
				
					if($currency_code != 'THB'){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to=THB');
						foreach($html->find("div#currency_converter_result span.bld") as $element){
							$currency_rate = $element->innertext;
						      }
						$currency = explode(" THB",$currency_rate);
						$amount_multiplier = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier = 1;
					}
					
					if($currency_code != 'USD'){
						$html 	= file_get_html('http://www.google.com/finance/converter?a=1&from='.$currency_code.'&to=USD');
						//echo $html. '<br>';
						foreach($html->find("div#currency_converter_result span.bld") as $element){
								$currency_rate = $element->innertext;
						      }
						$currency = explode(" USD",$currency_rate);
						$amount_multiplier_usd = trim($currency[0]);
					}
					else
					{
						$currency_rate = 1;
						$amount_multiplier_usd = 1;
					}		
					
					$updateArr  =  array(
								'country_name' => $country_name,
								'country_code'=>$country_code,
								'currency_code'=>$currency_code,
								'currency_name'=>$currency_name,
								'rental_max_price'=>$rental_price,							  	  'sales_max_price'=>$sales_price,
								'country_currency_symbol'=>$country_currency_symbol,
								'currency_rate'=>$amount_multiplier,
								'currency_rate_usd'=>$amount_multiplier_usd,
								'rental_slider_increment'=>$rental_slider_increment,
								'sales_slider_increment'=>$sales_slider_increment,
								'rate_updation_mode'=>1
								
							 );
					
					$idArr	    = array(
								'country_currency_id' => $country_currency_id
							);
					
				}
				//pr($updateArr);
				$ret   = $this->model_basic->updateIntoTable($this->countryCurrencyMaster,$idArr,$updateArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Currency updated successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update currency . Please try again later.");
				}
    
				redirect(BACKEND_URL."misc/currency_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		// Prepare Data
		$Condition = " country_currency_id = '".$country_currency_id."'";
		$rs = $this->model_basic->getValues_conditions($this->countryCurrencyMaster, '', '', $Condition);
		
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

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/edit_currency_master';			
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
			$this->model_basic->deleteData($this->countryCurrencyMaster, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected country and currency deleted successfully.");
		
		
		redirect(BACKEND_URL."misc/currency_master/");
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
		
		redirect(BACKEND_URL."misc/currency_master/".$page);
		return true;
		
			
	}
	
	public function deleteCountryCurrencyBatch($pagearray)
	{
						
		if(is_array($pagearray))
		{
			
			$delete_where	= "FIND_IN_SET(country_currency_id, '".implode(",", $pagearray)."')";
			$this->model_basic->deleteData($this->countryCurrencyMaster, $delete_where);
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
		
		$return 	= $this->model_basic->changeStatus($this->countryCurrencyMaster, $idArray, 'country_currency_status', $status, 'country_currency_id');		
		
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
		
		$bool = $this->model_basic->checkRowExists($this->countryCurrencyMaster , $whereArr);
		
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
		
		chk_login();
		$page		= $this->uri->segment(4, 0);
		$country_currency_id = $this->uri->segment(3, 0);
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/currency_master/".$page;
		$this->data['base_url'] 	= BACKEND_URL."misc/currency_master/0/1/";
		$this->data['view_url'] 	= BACKEND_URL."misc/currency_details/".$country_currency_id."/".$page."/";
		$idField	= 'countryCode';
		$nameField	= 'countryName';
		$tableName	= $this->countries;
		$condition      =  "country_status='active'";
		$orderField	= 'countryName';
		$orderBy	= 'ASC';
				
		$this->data['arr_country_name'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		
                $row = array();
		// Prepare Data
		$Condition = " country_currency_id = '".$country_currency_id."'";
		$rs = $this->model_basic->getValues_conditions($this->countryCurrencyMaster, '', '', $Condition);
		
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

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='misc/currency_details';			
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
	
	public function task_master()
	{
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/task_master/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('TASK');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['taskList']	= $this->model_misc->getTaskList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/task_master/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_task_master/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_task_master/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_task_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/batch_action_task_master/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/business_type_category',$this->data);
		
		$brdArr	= array( "MISC settings" => $this->data['base_url'], "Task Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/task_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
		
	}
	
	function is_task_name_exists($task_name)
	{		
		$id 	= $this->uri->segment(3,0);
		
		if($id > 0){
			$whereArr	= array( 'task_name' => $task_name,
						 'task_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'task_name' => $task_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->taskMaster, $whereArr);
		if($bool == 0){
			$this->form_validation->set_message('is_task_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	
	public function add_task_master()
	{
		$this->chk_login();
		
		$task_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/task_master/".$page;
		
		if($this->input->get_post('action') == 'Process'){
			$this->form_validation->set_rules('task_name', 'Task Name', 'trim|required|callback_is_task_name_exists');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			} else
			{
				$task_name		= addslashes(trim($this->input->get_post('task_name')));
				$task_slug		= url_title(strtolower($task_name));
				
				$insertArr  =  array(
							'task_name' => $task_name,
							'task_slug' => $task_slug
							
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->taskMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Task Name added successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				redirect(BACKEND_URL."misc/task_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		
		
		$this->data['succmsg']	= $this->session->userdata('succmsg');
		$this->data['errmsg'] 	= $this->session->userdata('errmsg');
		
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/amenities_add',$this->data);
		
		$brdArr	= array( "MISC Settings" => 'javascript:void(0);',
				 "Task Master" => $this->data['return_link'],
				 "Add task" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/task_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function edit_task_master()
	{
		$this->chk_login();
		
		$task_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/task_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('task_name', 'Task Name', 'trim|required|callback_is_task_name_exists');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			} else
			{
				$task_name		= addslashes(trim($this->input->get_post('task_name')));
				$task_slug		= url_title(strtolower($task_name));
				
				$updateArr  =  array(
							'task_name' => $task_name,
							'task_slug' => $task_slug
							
						);
						
				$idArr		= array(
							'task_id' => $task_id
							);
			    
				$ret   = $this->model_basic->updateIntoTable($this->taskMaster,$idArr, $updateArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Task Name updated successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				redirect(BACKEND_URL."misc/task_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		
		$Condition = "task_id = '".$task_id."'";
		$rs = $this->model_basic->getValues_conditions($this->taskMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['task_master'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/task_master/".$page."/");
                        return false;
		}
		
		
		
		
		$this->data['succmsg']	= $this->session->userdata('succmsg');
		$this->data['errmsg'] 	= $this->session->userdata('errmsg');
		
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/amenities_add',$this->data);
		
		$brdArr	= array( "MISC Settings" => 'javascript:void(0);',
				 "Task Master" => $this->data['return_link'],
				 "Edit task" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/task_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	function delete_task_master()
	{
		
		$this->chk_login();
		
		$task_id	= $this->uri->segment(3);
		$where			= "task_id = '".$task_id."'";
		
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->rentMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected agent is used. Can not delete.");
		}
		else
		{
			$delete_where = "task_id = '".$task_id."'";
			$this->model_basic->deleteData($this->taskMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected task deleted successfully.");
		}
		
		redirect(BACKEND_URL."misc/task_master/");
		return true;
	}
	
	function batch_action_task_master()
	{
		//********************* this has been done to rectify the redirection problem an extra variable has been added pushan 17.10.2013 refer to line 357/////
		 $page_num = $this->uri->segment(4);
		//*********************  ///// 
		 
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteTaskBatch($pagearray);
		}
		else if($action == 'Activate')
		{
			$this->taskbatchstatus('active', $pagearray);
		}
		else if($action == 'Inactivate')
		{ 
			$this->taskbatchstatus('inactive', $pagearray);
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/task_master/".$page_num);// this was only 'owner/index' I have added $page_num to accomodate the page number no other changes has been made refer to line 329.
		return true;
		//http://192.168.0.114/livephuket/admin/owner/index/1
		
		
	}
	
	private function deleteTaskBatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(task_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->rentMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected task is used. Can not delete.");
			}
			else
			{
				
				$delete_where	= "FIND_IN_SET(task_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->taskMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected task deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
	
	
	
	private function taskbatchstatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->taskMaster, $idArray, 'task_status', $status, 'task_id');
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}
		elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', "Selected task status Activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected task status Inactivated successfully.");
		}
		return true;
	}
	
	///////////////////////
	
	
	//////////////////////////////////// Action master section starts///////////////////////////////////////////////
	
	
	public function action_master()
	{
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/action_master/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('ACTION');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['actionList']	= $this->model_misc->getActionList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'misc';	
		$this->data['base_url'] 		= BACKEND_URL."misc/action_master/0/1/";
		$this->data['add_url']      		= BACKEND_URL."misc/add_action_master/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."misc/edit_action_master/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."misc/delete_action_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/batch_action_action_master/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('misc/business_type_category',$this->data);
		
		$brdArr	= array( "MISC settings" => $this->data['base_url'], "Action Listing" => '' );
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/action_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
	function is_action_name_exists($action_name)
	{		
		$id 	= $this->uri->segment(3,0);
		
		if($id > 0)
		{
			$whereArr	= array( 'action_name' => $action_name,
						 'action_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array( 'action_name' => $action_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->actionMaster, $whereArr);
		if($bool == 0)
		{
			$this->form_validation->set_message('is_action_name_exists', 'The %s name already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	public function add_action_master()
	{
		$this->chk_login();
		
		$action_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/action_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('action_name', 'Action Name', 'trim|required|callback_is_action_name_exists');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$action_name		= addslashes(trim($this->input->get_post('action_name')));
				
				
				$insertArr  =  array(
							'action_name' => $action_name
							
						     );
			    
				$ret   = $this->model_basic->insertIntoTable($this->actionMaster,$insertArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Action Name added successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				redirect(BACKEND_URL."misc/action_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		$this->data['succmsg']	= $this->session->userdata('succmsg');
		$this->data['errmsg'] 	= $this->session->userdata('errmsg');
		
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/amenities_add',$this->data);
		
		$brdArr	= array( "MISC Settings" => 'javascript:void(0);',
				 "Action Master" => $this->data['return_link'],
				 "Add action" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/action_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function edit_action_master()
	{
		$this->chk_login();
		
		$action_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/action_master/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('action_name', 'Action Name', 'trim|required|callback_is_action_name_exists');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$action_name		= addslashes(trim($this->input->get_post('action_name')));
				
				
				$updateArr  =  array(
							'action_name' => $action_name,
													
						);
						
				$idArr		= array(
							'action_id' => $action_id
							);
			    
				$ret   = $this->model_basic->updateIntoTable($this->actionMaster,$idArr, $updateArr);
				if($ret)
				{
					$this->session->set_userdata('succmsg', "Action Name updated successfully.");
				}
				else
				{
					$this->session->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."misc/action_master/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();
		
		
		$Condition = "action_id = '".$action_id."'";
		$rs = $this->model_basic->getValues_conditions($this->actionMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['action_master'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/action_master/".$page."/");
                        return false;
		}
		
		$this->data['succmsg']	= $this->session->userdata('succmsg');
		$this->data['errmsg'] 	= $this->session->userdata('errmsg');
		
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/amenities_add',$this->data);
		
		$brdArr	= array( "MISC Settings" => 'javascript:void(0);',
				 "Action Master" => $this->data['return_link'],
				 "Edit action" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/action_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	function delete_action_master()
	{
		//var $enquiryMaster  = 'lp_enquiry_master';
		$this->chk_login();
		
		$action_id	= $this->uri->segment(3);
		$where			= "action_id = '".$action_id."'";
		
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->enquiryMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Selected action is used. Can not delete.");
		}
		else
		{
			$delete_where = "action_id = '".$action_id."'";
			$this->model_basic->deleteData($this->actionMaster, $delete_where);
			$this->session->set_userdata('succmsg', "Selected action deleted successfully.");
		}
		
		redirect(BACKEND_URL."misc/action_master/");
		return true;
	}
	
	function batch_action_action_master()
	{
		
		 $page_num = $this->uri->segment(4);
		//*********************  ///// 
		 
		$this->chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteActionBatch($pagearray);
		}
		else if($action == 'Activate')
		{
			$this->actionbatchstatus('active', $pagearray);
		}
		else if($action == 'Inactivate')
		{ 
			$this->actionbatchstatus('inactive', $pagearray);
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/action_master/".$page_num);// this was only 'owner/index' I have added $page_num to accomodate the page number no other changes has been made refer to line 329.
		return true;
		//http://192.168.0.114/livephuket/admin/owner/index/1
		
	}
	
	private function deleteActionBatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(action_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->enquiryMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected action is used. Can not delete.");
			}
			else
			{
				
				$delete_where	= "FIND_IN_SET(action_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->actionMaster, $delete_where);
				$this->session->set_userdata('succmsg', "Selected task deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
	
	
	
	private function actionbatchstatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->actionMaster, $idArray, 'action_status', $status, 'action_id');
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}
		elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', "Selected action status Activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected action status Inactivated successfully.");
		}
		return true;
	}
	
	///////////////////////
	
	public function followup_master()
	{
		$this->chk_login();
		
		$config['base_url'] 	= BACKEND_URL."misc/followup_master/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->session->userdata('FOLLOWUP_SEARCH');
		
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
		$page				= $this->uri->segment(3,0);
		$this->data['followupList']	= $this->model_misc->getFollowupList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'misc';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/followup_master/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/followup_master/0/1/";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_followup_master/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_followup_master/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_followup_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action_followup_master/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');		
		
		$this->session->set_userdata('succmsg', "");		
		$this->session->set_userdata('errmsg', "");
		
		//$this->layout->view('property_settings/amenities',$this->data);
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0);',
				 "Followup Master" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/followup_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
		
	}
	
	function is_followup_exists()
	{		
		$id 	= $this->uri->segment(3, 0);
		$followup_type 	= strip_tags(addslashes(trim($this->input->get_post('followup_type'))));
		
		$whereArr	= array();
		if($id > 0)
		{
			$whereArr	= array( 'followup_type' => $followup_type,
						 'followup_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array( 'followup_type' => $followup_type );
		}
		$bool 	= $this->model_basic->checkRowExists($this->followupMaster, $whereArr );
		//checkRowExists($tableName, $whereArr){ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');	
		if($bool == 0)
		{
			$this->form_validation->set_message('is_followup_exists', 'The %s name already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function add_followup_master()
	{
		$this->chk_login();		
		$page			= $this->uri->segment(4, 0);
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/followup_master/".$page;
		$insertArr 		= array();
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('followup_type', 'Followup type', 'trim|required|callback_is_followup_exists');
			
			if ($this->form_validation->run() == FALSE){
				
			}
			else {
				$followup_type 	= addslashes(trim($this->input->get_post('followup_type')));
				$insertArr 	=  array(
							'followup_type' => $followup_type,
							'added_on'=>date('Y-m-d H:i:s')
							
						       );
				$ret 		= $this->model_basic->insertIntoTable($this->followupMaster,$insertArr);
				if($ret)
					$this->session->set_userdata('succmsg', "Followup added successfully.");
				else
					$this->session->set_userdata('errmsg', "Unable to add Followup. Please try after some time.");
					
				redirect(BACKEND_URL."misc/followup_master/".$page);
				return true;        
			}			
		}		
		
                $row = array();
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_locations/locations_add',$this->data);
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0);',
				 "Followup Master" => $this->data['return_link'],
				 "Add Followup Master" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/add_followup_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function edit_followup_master()
	{
		$this->chk_login();		
		$followup_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		$this->data['controller']	= "misc";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/followup_master/".$page;
		$updateArr  		= array();
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('followup_type', 'Followup type', 'trim|required|callback_is_followup_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$followup_type 	= addslashes(trim($this->input->get_post('followup_type')));
				$updateArr 	=  array(
							'followup_type' => $followup_type
														
						       );
				$idArr		= array(
							'followup_id' => $followup_id
							);
				
				$ret 		= $this->model_basic->updateIntoTable($this->followupMaster,$idArr,$updateArr );
				if($ret)
					$this->session->set_userdata('succmsg', "Followup updated successfully.");
				else
					$this->session->set_userdata('errmsg', "Unable to update Followup. Please try after some time.");
					
				redirect(BACKEND_URL."misc/followup_master/".$page);
				return true;        
			}			
		}		
		
                $row = array();
		$Condition = "followup_id = '".$followup_id."'";
		$rs = $this->model_basic->getValues_conditions($this->followupMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['followup_master'] = $row;
                }
		else
		{
                        $this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/followup_master/".$page."/");
                        return false;
		}
		
		
		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg', "");
		$this->session->set_userdata('errmsg', "");

		//$this->layout->view('property_locations/locations_add',$this->data);
		
		$brdArr	= array( "MISC settings" => 'javascript:void(0);',
				 "Followup Master" => $this->data['return_link'],
				 "Edit Followup Master" => ''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('misc');
		$this->elements['middle']='misc/edit_followup_master';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_followup_master()
	{
		$this->chk_login();
		
		$followup_id	= $this->uri->segment(3);		
		$page 		= $this->uri->segment(4, 0);
		$where		= "followup_id = '".$followup_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
		if($i_delete_chk > 0)
		{
			$this->session->set_userdata('errmsg', "Followup is being used. The Followup cannot be deleted.");
		}
		else
		{
			$this->model_basic->deleteData($this->followupMaster, $where);
			$this->session->set_userdata('succmsg', "followup has been deleted successfully.");
		}		
		//redirect(BACKEND_URL."property_settings/types/".$url_start_record);
		redirect(BACKEND_URL."misc/followup_master/".$page);
		return true;
	}
	
	
	
	public function batch_action_followup_master()
	{
		$this->chk_login();	
		
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete'){
			$this->deletebatch_followup($pagearray);
		} else if($action == 'Activate'){
			$this->batchstatus_followup('active', $pagearray);
		} else if($action == 'Inactivate'){ 
			$this->batchstatus_followup('inactive', $pagearray);
		} else {
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."misc/followup_master/".$page);
		return true;
			
	}
	
	
	private function deletebatch_followup($pagearray){		
		
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(followup_id, '".implode(",", $pagearray)."') ";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->session->set_userdata('errmsg', "Selected followup is in use. This location cannot be deleted.");
			}
			
			else
			{				
				//$delete_where	= "FIND_IN_SET(location_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->followupMaster, $where);
				$this->session->set_userdata('succmsg', "Selected followup was deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;		
		
	}
		
	private function batchstatus_followup($status, $idArray)
	{
		if($status == '')
			return false;
		
		//$return = $this->model_property_locations->statusBatchPropertyType($status);		
		 //pr($_POST,0); echo "bbbb"; 
		
		$updArr		= 'followup_status';
		$return 	= $this->model_basic->changeStatus($this->followupMaster, $idArray, $updArr, $status, 'followup_id');		
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select at least one item to change status.");
		}
		elseif($return == 'noact'){
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}
		elseif($return == 'deactive'){
			$this->session->set_userdata('succmsg', "Selected followup status Activated successfully.");
		}
		elseif($return == 'active'){
			$this->session->set_userdata('succmsg', "Selected followup status Inactivated successfully.");
		}		
		return true;
	}
	public function update_all_currency_status()
	{
		
		if($this->model_misc->updateAllCurrencyStatus())
			echo '';
		
	}
	

	
	public function put_cur_symbol()
	{
		$cursymbolarray = array(
			'MXN'=>'$',
			'USD'=>'$',
			'AUD'=>'$',
			'CHF'=>'fr.',
			'RUB'=>'&#1088;&#1091;&#1073;',
			'CNY'=>'&yen;',
			'JPY'=>'&yen;',
			'BRL'=>'R$',
			'AED'=>'&#1583;.&#1571;',
			'GBP'=>'&pound;',
			'NZD'=>'$',
			'CAD'=>'$',
			'ZAR'=>'R',
			'THB'=>'&#3647;',
			'ISK'=>'kr',
			'EUR'=>'&euro;'
			
		
			
				);
		
		
		
		if($this->model_misc->updateAllCurrencysymbols($cursymbolarray))
			echo '';
		/*
		 
		 <ul class="fullwidth">
                <li>
            <a href="javascript:FlipKey.Currency.change('MXN');">
                <span class="symbol">$</span>
                <span class="code">MXN</span>
                <span class="flag flag-mx"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('USD');">
                <span class="symbol">$</span>
                <span class="code">USD</span>
                <span class="flag flag-us"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('AUD');">
                <span class="symbol">$</span>
                <span class="code">AUD</span>
                <span class="flag flag-au"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('CHF');">
                <span class="symbol">fr.</span>
                <span class="code">CHF</span>
                <span class="flag flag-ch"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('RUB');">
                <span class="symbol">&#1088;&#1091;&#1073;</span>
                <span class="code">RUB</span>
                <span class="flag flag-ru"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('CNY');">
                <span class="symbol">&yen;</span>
                <span class="code">CNY</span>
                <span class="flag flag-cn"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('JPY');">
                <span class="symbol">&yen;</span>
                <span class="code">JPY</span>
                <span class="flag flag-jp"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('BRL');">
                <span class="symbol">R$</span>
                <span class="code">BRL</span>
                <span class="flag flag-br"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('AED');">
                <span class="symbol">&#1583;.&#1571;</span>
                <span class="code">AED</span>
                <span class="flag flag-ae"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('GBP');">
                <span class="symbol">&pound;</span>
                <span class="code">GBP</span>
                <span class="flag flag-gb"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('NZD');">
                <span class="symbol">$</span>
                <span class="code">NZD</span>
                <span class="flag flag-nz"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('CAD');">
                <span class="symbol">$</span>
                <span class="code">CAD</span>
                <span class="flag flag-ca"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('ZAR');">
                <span class="symbol">R</span>
                <span class="code">ZAR</span>
                <span class="flag flag-za"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('THB');">
                <span class="symbol">&#3647;</span>
                <span class="code">THB</span>
                <span class="flag flag-th"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('ISK');">
                <span class="symbol">kr</span>
                <span class="code">ISK</span>
                <span class="flag flag-is"></span>
            </a>
        </li>        <li>
            <a href="javascript:FlipKey.Currency.change('EUR');">
                <span class="symbol">&euro; </span>
                <span class="code">EUR</span>
                <span class="flag flag-eu"></span>
            </a>
        </li>    </ul>
		 
		 
		 
		 
		 
		 
		 
		 */
		
		
		
	}
	

	
	
}