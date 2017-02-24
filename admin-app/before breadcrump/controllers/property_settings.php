<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_settings extends CI_Controller
{
	var $propertyTypeMaster 	= 'lp_property_type_master';
	var $propertyMaster 		= 'lp_property_master';
	var $featuredCategory 		= 'lp_featured_category';
	var $amenitiesMaster 		= 'lp_amenities_master';
	var $documentTypeMaster 	= 'lp_document_type_master';
	var $internalInformation	= 'lp_internal_information';
	var $propertyBuyingMaster       = 'lp_buying_master';
	var $clientForSale              = 'lp_client_for_sale';
	var $leadTypeMasterTable	= 'lp_lead_type_master';
	var $clientForRent              = 'lp_client_for_rent';
	var $seasonMasterTable		= 'lp_season_master';
	var $propertySeasonPrice	= 'lp_property_season_price';
	var $suitabilityMaster          = 'lp_suitability_master';
	var $propertysitesettings 	= 'lp_sitesettings';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_property_settings');
	}

	public function index()
	{
		chk_login();			
		
		$this->data['succmsg'] 	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->layout->view('property_settings/index',$this->data);
	}
	
	/*********************************** for types start *****************************************/
	public function types()
	{ 
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_settings/types/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('TYPE_SEARCH');
		
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
		$this->data['propertyTypeList']	= $this->model_property_settings->getList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_settings';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/types/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/types/0/1/";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_types/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_types/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_types/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action/0/".$page."/";
		$this->data['batch_action_link1']= BACKEND_URL.$this->data['controller']."/batch_action_amenities1/0/".$page."/";
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/types';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	function is_name_exists($property_name)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'property_name' => $property_name,
						 'property_type_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'property_name' => $property_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->propertyTypeMaster, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	public function add_types()
	{
		chk_login();
		
		$property_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_settings";
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_types/";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/types/";
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('property_name', 'Property Name', 'trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
				
			} else {
				$property_name	= addslashes(trim($this->input->get_post('property_name')));
				$property_slug	= str_replace('-', '',url_title(strtolower($property_name)));
				$insertArr  =  array(
							'property_name' => $property_name,
							'property_slug' => $property_slug
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->propertyTypeMaster,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Property type added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add Property Types. Please try again later.");
				}
    
				redirect(BACKEND_URL."property_settings/types/".$page."/");
				return true;        
			}			
		}		
		
                $row = array();

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/type_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function batch_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete'){
			$this->deletebatch($pagearray);
		} else if($action == 'Activate'){
			$this->batchstatus('active', $pagearray);
		} else if($action == 'Inactivate'){ 
			$this->batchstatus('inactive', $pagearray);
		} else {
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_settings/types/".$page);
		return true;
			
	}
	
	private function deletebatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(property_type_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
			
			if($i_delete_chk > 0)
			{
				$this->nsession->set_userdata('errmsg', "Selected property type is used. Can not delete.");
			}
			else
			{
				
				$delete_where	= "FIND_IN_SET(property_type_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->propertyTypeMaster, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected property type deleted successfully.");
			}
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchstatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->propertyTypeMaster, $idArray, 'property_status', $status, 'property_type_id');
		
		if($return == 'noitem')
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact')
		{
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->session->set_userdata('succmsg', "Selected property type status Activated successfully.");
		}elseif($return == 'active')
		{
			$this->session->set_userdata('succmsg', "Selected property type status Inactivated successfully.");
		}
		return true;
	}
	
	
	public function amenities()
	{ 
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_settings/amenities/0/0/rent";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 6;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('AMENITY_SEARCH');
		
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
		$page				= $this->uri->segment(6,0);
		$this->data['amenityList']	= $this->model_property_settings->getAmenitiesList($config,$start);
		
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_settings';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/amenities/0/1/rent";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/amenities/0/1/rent/";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_amenities/0/".$page."/rent";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_amenities/{{ID}}/".$page."/rent";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_amenities/{{ID}}/".$page."/rent";
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action_amenities/0/".$page."/rent";
		
		$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertysitesettings,'sitesettings_value', '','sitesettings_id="19"');
		
		//$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->amenitiesMaster, "COUNT(amenities_id)", "CNT", "amenities_type IN ('Both', 'Rental') AND amenities_status = 'active'");
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/amenities';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function batch_action_amenities()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete'){
			$this->deleteAmenitybatch($pagearray);
		}
		
		
		else if($action == 'Activate'){
			$this->batchAmenitystatus('active', $pagearray);
		} else if($action == 'Inactivate'){ 
			$this->batchAmenitystatus('inactive', $pagearray);
		} else {
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_settings/amenities/".$page."/0/rent/");
		return true;
			
	}
	public function batch_action_amenities1()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete'){
			$this->deleteAmenitybatch($pagearray);
		}
		
		
		else if($action == 'Activate'){
			$this->batchAmenitystatus('active', $pagearray);
		} else if($action == 'Inactivate'){ 
			$this->batchAmenitystatus('inactive', $pagearray);
		} else {
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_settings/sale_amenities/".$page."/0/sales/");
		return true;
			
	}
	private function deleteAmenitybatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(amenities_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
			
			if($i_delete_chk > 0){
				$this->nsession->set_userdata('errmsg', "Selected Amenity in used. Can not delete.");
			} else {
				
				$delete_where	= "FIND_IN_SET(amenities_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->amenitiesMaster, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected amenities deleted successfully.");
			}
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
		
	private function batchAmenitystatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$return 	= $this->model_basic->changeStatus($this->amenitiesMaster, $idArray, 'amenities_status', $status, 'amenities_id');		
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected amenities status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected amenities status Inactivated successfully.");
		}		
		return true;
	}


	public function update_left_order()
	{
	$loc_id=$this->input->get_post('loc_id');

        $left_order=$this->input->get_post('left_order');
	$this->data['existing_value']= $this->model_basic->getValue_condition($this->amenitiesMaster,'left_bar_order', '','amenities_id="'.$loc_id.'"');
	
	$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertysitesettings,'sitesettings_value', '','sitesettings_id="19"');
	
	$this->data['updated_value_loc']= $this->model_basic->getValue_condition($this->amenitiesMaster,'amenities_id', '','left_bar_order="'.$left_order.'"');
	if($left_order>0 && $left_order<=$this->data['sitesettings_value'])
		{
			
				
				$insertArr  =  array(
							'left_bar_order' => $left_order
						);
				
				$idArr		= array(
							'amenities_id' => $loc_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->amenitiesMaster,$idArr, $insertArr);
				
				
				$insertArr1  =  array(
							'left_bar_order' => $this->data['existing_value']
						);
				
				$idArr1		= array(
							'amenities_id' => $this->data['updated_value_loc']
							);
				
				$ret1   = $this->model_basic->updateIntoTable($this->amenitiesMaster,$idArr1, $insertArr1);
				
				echo $this->data['existing_value']."-".$this->data['updated_value_loc'];
				
	
		}
		
	}
	function is_amenity_name_exists($amenity_name)
	{		
		$id 	= $this->uri->segment(3,0);
		
		$amenity_type 		= $this->input->get_post('amenity_type');
		$featured_category	= $this->input->get_post('featured_category');
		
		if($id > 0)
		{
			$whereArr	= array(
						'amenities_name' 	=> $amenity_name,
						'amenities_type'	=> $amenity_type,
						'category_id' 		=> $featured_category,
						'amenities_id != '	=> $id
						);
		}
		else
		{			
			$whereArr	= array(
						'amenities_name' 	=> $amenity_name,
						'amenities_type'	=> $amenity_type,
						'category_id' 		=> $featured_category
						);
		}
		
		$bool = $this->model_basic->checkRowExists($this->amenitiesMaster, $whereArr);
		if($bool == 0)
		{
			$this->form_validation->set_message('is_amenity_name_exists', 'The %s already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	 public function add_amenities()
	{
		chk_login();		
		$amenities_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		$type			= $this->uri->segment(5);
		$this->data['controller']	= "property_settings";
		
		if($type=='rent')
		{
			$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/amenities/0/0/rent";
			$this->data['add_url']= BACKEND_URL.$this->data['controller']."/add_amenities/0/0/rent";
		}
		elseif($type=='sales')
		{
			$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/sale_amenities/0/0/sales";
			$this->data['add_url']= BACKEND_URL.$this->data['controller']."/add_amenities/0/0/sales";
		}
		
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('amenity_name', 'Amenity Name', 'trim|required|callback_is_amenity_name_exists');
			$this->form_validation->set_rules('featured_category', 'Featured Category', 'trim|required');
			$this->form_validation->set_rules('amenity_type', 'Amenities type', 'required');
			$this->form_validation->set_rules('backend_amenities_name', 'Backend Amenities Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$amenity_name			= addslashes(trim($this->input->get_post('amenity_name')));
				$backend_amenities_name		= addslashes(trim($this->input->get_post('backend_amenities_name')));
				$amenity_type 			= $this->input->get_post('amenity_type');
				$amenity_slug			= url_title(strtolower($amenity_name));
				$featured_category		= addslashes(trim($this->input->get_post('featured_category')));
				$amenities_filter		= addslashes(trim($this->input->get_post('amenities_filter')));
				$amenities_tooltip		= addslashes(trim($this->input->get_post('amenities_tooltip')));
				$amenities_control_filter 	= addslashes(trim($this->input->get_post('amenities_selected_control')));
				
				
				$insertArr  =  array(
							'amenities_name' 	=> $amenity_name,
							'backend_amenities_name'=>$backend_amenities_name,
							'amenities_type'	=> $amenity_type,
							'amenities_slug' 	=> $amenity_slug,
							'amenities_filter' 	=> $amenities_filter,
							'amenities_tooltip' 	=> $amenities_tooltip,
							'amenities_input'	=>$amenities_control_filter,
							'category_id'  		=> $featured_category
						    );
			    
				$ret   = $this->model_basic->insertIntoTable($this->amenitiesMaster,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Amenity Name added successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				
				//if($type=="rent")
				//{
				//redirect(BACKEND_URL."property_settings/amenities/".$page."/0/".$type);
				//}
				//else if($type=="sales")
				//{
				//redirect(BACKEND_URL."property_settings/sale_amenities/".$page."/0/".$type);	
				//}
				//return true;        
			}			
		}		
		
                $row = array();
		
		/*** populate drop down for featured category start ***/
		$idField	= 'featured_category_id';
		$nameField	= 'featured_category_name';
		$tableName	= $this->featuredCategory;
		$condition	= "featured_category_status = 'active'";
		$orderField	= 'featured_category_name';
		$orderBy	= 'ASC';
		
		$this->data['arr_featured_populate'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		/*** populate drop down for featured category end ***/
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/amenities_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function edit_amenities()
	{
		chk_login();
		
		$amenities_id	= $this->uri->segment(3, 0);
		$page 		= $this->uri->segment(4, 0);
		$type 		= $this->uri->segment(5);
		
		$this->data['controller']	= "property_settings";
		if($type == 'sales')
		{
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/sale_amenities/0/0/".$type;
		$this->data['edit_url']= BACKEND_URL.$this->data['controller']."/edit_amenities/".$amenities_id."/".$page."/sales";
		}
		else if($type == 'rent')
		{
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/amenities/0/0/".$type;
		$this->data['edit_url']= BACKEND_URL.$this->data['controller']."/edit_amenities/".$amenities_id."/".$page."/rent";
		}
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('amenity_name', 'Amenity Name', 'trim|required|callback_is_amenity_name_exists');
			$this->form_validation->set_rules('backend_amenities_name', 'Backend Amenity Name', 'trim|required');
			$this->form_validation->set_rules('featured_category', 'Featured Category', 'trim|required');
			$this->form_validation->set_rules('amenity_type', 'Amenities type', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else {
				$amenity_name		= addslashes(trim($this->input->get_post('amenity_name')));
				$backend_amenities_name	= addslashes(trim($this->input->get_post('backend_amenities_name')));
				$amenity_type 		= $this->input->get_post('amenity_type');
				$amenity_slug		= url_title(strtolower($amenity_name));
				$featured_category	= addslashes(trim($this->input->get_post('featured_category')));
				$amenities_filter	= addslashes(trim($this->input->get_post('amenities_filter')));
				$amenities_tooltip	= addslashes(trim($this->input->get_post('amenities_tooltip')));
				$amenities_control_filter = addslashes(trim($this->input->get_post('amenities_selected_control')));
				
				$insertArr  =  array(
							'amenities_name'		=> $amenity_name,
							'backend_amenities_name'	=> $backend_amenities_name,
							'amenities_type'		=> $amenity_type,
							'amenities_slug'		=> $amenity_slug,
							'amenities_filter'		=> $amenities_filter,
							'amenities_tooltip'		=> $amenities_tooltip,
							'amenities_input'		=> $amenities_control_filter,
							'category_id' 			=> $featured_category
						);
				
				$idArr		= array(
							'amenities_id' => $amenities_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->amenitiesMaster, $idArr, $insertArr);
				//if($ret)
				//{
				//	$this->nsession->set_userdata('succmsg', "Amenitiy updated successfully.");
				//}
				//else
				//{
				//	$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				//}
				$this->nsession->set_userdata('succmsg', "Amenitiy updated successfully.");
				if($type == 'sales')
				{
				redirect(BACKEND_URL.$this->data['controller']."/sale_amenities/".$page."/0/sales");
				}
				else if($type == 'rent')
				{
				redirect(BACKEND_URL.$this->data['controller']."/amenities/".$page."/0/rent");
				}
				
				return true;
			}
		}		
		
                $row = array();
		
		/*** populate drop down for featured category start ***/
		$idField	= 'featured_category_id';
		$nameField	= 'featured_category_name';
		$tableName	= $this->featuredCategory;
		$condition	= "featured_category_status = 'active'";
		$orderField	= 'featured_category_name';
		$orderBy	= 'ASC';
		
		$this->data['arr_featured_populate'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		/*** populate drop down for featured category end ***/
		
		// Prepare Data
		$Condition = " amenities_id = '".$amenities_id."'";
		$rs = $this->model_basic->getValues_conditions($this->amenitiesMaster, '', '', $Condition);
		//pr($rs);
		$row = $rs[0];
                if($row){
                    $this->data['arr_amenity'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
			if($type == 'sales')
			{
			redirect(BACKEND_URL.$this->data['controller']."/sale_amenities/".$page."/0/sales");
			}
			else if($type == 'rent')
			{
			redirect(BACKEND_URL.$this->data['controller']."/amenities/".$page."/0/rent");
			}
                       // redirect(BACKEND_URL.$this->data['controller']."/amenities/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/amenities_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	public function delete_amenities()
	{
		chk_login();
		
		$amenities_id	= $this->uri->segment(3);
		$where		= "amenities_id = '".$amenities_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
		if($i_delete_chk > 0){
			$this->nsession->set_userdata('errmsg', "Selected Amenity in used. Can not delete.");
		} else {
			
			$this->model_basic->deleteData($this->amenitiesMaster, $where);
			$this->nsession->set_userdata('succmsg', "Selected Amenity  deleted successfully.");
		}
		
		redirect(BACKEND_URL."property_settings/amenities/0/0/rent");
		return true;
	}
	public function delete_sales_amenities()
	{
		chk_login();
		
		$amenities_id	= $this->uri->segment(3);
		$where		= "amenities_id = '".$amenities_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
		if($i_delete_chk > 0){
			$this->nsession->set_userdata('errmsg', "Selected Amenity in used. Can not delete.");
		} else {
			
			$this->model_basic->deleteData($this->amenitiesMaster, $where);
			$this->nsession->set_userdata('succmsg', "Selected Amenity  deleted successfully.");
		}
		
		redirect(BACKEND_URL."property_settings/sale_amenities/0/0/sales");
		return true;
	}
	public function sale_amenities()
	{ 
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_settings/sale_amenities/0/0/sales";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 6;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('AMENITY_SEARCH');
		
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
		$page				= $this->uri->segment(6,0);
		$this->data['amenityList']	= $this->model_property_settings->getAmenitiesList1($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_settings';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/sale_amenities/0/1/sales";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/sale_amenities/0/1/sales";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_amenities/0/".$page."/sales";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_amenities/{{ID}}/".$page."/sales";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_sales_amenities/{{ID}}/".$page."/sales";
		$this->data['batch_action_link1']= BACKEND_URL.$this->data['controller']."/batch_action_amenities1/0/".$page."/sales";
		$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertysitesettings,'sitesettings_value', '','sitesettings_id="19"');
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_settings/sales_amenities';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
}