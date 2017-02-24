<?php

class Property_sales extends CI_Controller{
    
    var $propertyMasterTable	= 'lp_property_master';
    var $locationMaster		= 'lp_location_master';
    var $adminMaster       	= 'lp_adminuser';
    var $propertyAvailibility	= 'lp_property_availibility';
    var $seasonPriceMaster	= 'lp_property_season_price';
    var $rentCustomFields	= 'lp_rent_custom_fields';
    var $salesdevelopmentpages	= 'lp_sales_development_pages';
    var $rentMasterTable	= 'lp_rent_master';
    var $salesMasterTable	= 'lp_sales_master';
    var $propertySuitability	= 'lp_property_suitability';
    var $propertyImageTable	= 'lp_property_image';
    var $floorplanimage			= 'lp_floor_plans';
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('model_property_sales');
    }
    
    public function index()
    {
	
	chk_login();
        $this->data='';
	//<!--------------code start-------------------->
	
	$config['base_url'] 	= BACKEND_URL."property_sales/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	$this->data['params']		= $this->nsession->userdata('PROPERTY');
	
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
	$this->data['propertyMasterList']= $this->model_property_sales->getPropertyList($config,$start);
	
	$this->data['startRecord'] 	= $start;
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= 'property_sales';	
	$this->data['base_url'] 	= BACKEND_URL."property_sales/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL."property_sales/index/0/".$page."/";
	$this->data['add_url']      	= BACKEND_URL."property_sales/add_property/";
	$this->data['status_link']      = BACKEND_URL."property_sales/{{STATUS_LINK}}/{{ID}}/";
	$this->data['edit_link']      	= BACKEND_URL."property_sales/edit_property/{{ID}}/".$page."/";
	$this->data['delete_link']	= BACKEND_URL."property_sales/delete_property/{{ID}}/".$page."/";		
	$this->data['image_link']	= BACKEND_URL."property_sales/property_image/{{ID}}/".$page."/";		
	$this->data['batch_action_link']= BACKEND_URL."property_sales/property_batch_action/0/".$page."/";

	$this->pagination->initialize($config);
	$this->data['pagination'] = $this->pagination->create_links();
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
		
	
	//<!-------------code end--------------------->
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
	
    }
    public function edit_property_status()
    {

		chk_login();
		
		
		
		$property_id = $this->input->post('property_id');
		$page_num	= $this->uri->segment(4,0);
		
		$this->data['property_id']	= $property_id;
		$this->data['page_num']		= $page_num;
		
		$table_name	= $this->propertyMasterTable;
		$field_name	= 'status';
		$alias		= '';
		$condition	= "property_id = '".$property_id."'";
		
		$prev_status = $this->model_basic->getValue_condition($this->propertyMasterTable, $field_name, $alias, $condition);
		
		if($prev_status == 'inactive')
		{
			$new_status = 'active';
		}
		else
		{
			$new_status = 'inactive';
		}

		$update = $this->model_property_sales->changeStatus($property_id, $new_status);
		
		if($update){
			echo $new_status;
			
		}else{
			//$this->session->set_userdata('succmsg', "Property status  not updated successfully");
			//redirect(BACKEND_URL."property_sales/index/".$page_num,"refresh");
			//exit();
		}
		
    }
	
    public function property_batch_action()
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
	    
	    redirect(BACKEND_URL."property_sales/index/".$page);
	    return true;
			
    }
	

	
	public function deletebatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$delete_where	= "FIND_IN_SET(property_id, '".implode(",", $pagearray)."')";
			$this->model_basic->deleteData($this->propertyMasterTable, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected property deleted successfully.");
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
	
	public function batchstatus($status, $idArray)
	{
		if($status == '')
			return false;
		
		$updArr		= 'status';
		$return 	= $this->model_basic->changeStatus($this->propertyMasterTable, $idArray, $updArr, $status, 'property_id');		
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select at least one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
		         echo 'hi';
			$this->nsession->set_userdata('succmsg', "Selected property status Activated successfully.");
		}elseif($return == 'active'){
			echo 'hello';
			$this->nsession->set_userdata('succmsg', "Selected property status Inactivated successfully.");
		}		
		return true;
	}
	
    	public function delete_image($property_id)
	{
		
		$Condition 		= "property_id = '".$property_id."' ";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition);
		if($arr_property_image && !empty($arr_property_image)){
			foreach($arr_property_image as $image){
				if(file_exists(file_upload_absolute_path().'property/'.stripslashes($image['image_file_name'])) && stripslashes($image['image_file_name']) != "")
				{
					unlink(file_upload_absolute_path().'property/'.stripslashes($image['image_file_name']));
				}
				
				if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($image['image_file_name'])) && stripslashes($image['image_file_name']) != "")
				{
					unlink(file_upload_absolute_path().'property/big/'.stripslashes($image['image_file_name']));
				}
				
				if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($image['image_file_name'])) && stripslashes($image['image_file_name']) != "")
				{
					unlink(file_upload_absolute_path().'property/list/'.stripslashes($image['image_file_name']));
				}
				
				if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($image['image_file_name'])) && stripslashes($image['image_file_name']) != "")
				{
					unlink(file_upload_absolute_path().'property/small/'.stripslashes($image['image_file_name']));
				}
			}
		}
		$delete_where	= " property_id = '".$property_id."'";
		$this->model_basic->deleteData($this->propertyImageTable, $delete_where);
		return true;
	}
	
	
	
    public function delete_property(){		
		
		$property_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		$type 		= $this->uri->segment(5);
		
		$this->model_basic->deletePropertyEnquiry($property_id);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d8 = $this->model_basic->deleteData($this->propertyAvailibility, $delete_where);		
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d3 = $this->model_basic->deleteData($this->seasonPriceMaster, $delete_where);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d5 = $this->model_basic->deleteData($this->rentCustomFields, $delete_where);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d6 = $this->model_basic->deleteData($this->salesdevelopmentpages, $delete_where);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d1 = $this->model_basic->deleteData($this->rentMasterTable, $delete_where);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d2 = $this->model_basic->deleteData($this->salesMasterTable, $delete_where);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d7 = $this->model_basic->deleteData($this->propertySuitability, $delete_where);
		
		$this->delete_image($property_id);
		
		$delete_where	= " property_id = '".$property_id."' ";
		$d9 = $this->model_basic->deleteData($this->propertyMasterTable, $delete_where);
		
		$this->nsession->set_userdata('succmsg', "Selected property deleted successfully.");
		
		
		redirect(BACKEND_URL.'property_sales/');
			
		
	}
	
	
    public function edit_property()
    {
	chk_login();
	$this->data='';
	$this->data['succmsg'] = '';
	$this->data['errmsg'] = '';
	$property_id		= $this->uri->segment(3, 0);
	$page			= $this->uri->segment(4, 0);
	
	
	$this->data['page']	= $page;	
	$this->data['controller']	= "property_sales";
	//$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/".$page;
	
	//$this->data['property_owner'] 	= '';
	//$this->data['owner_id']  	= $this->session->userdata('property_owner_id');
	
	$this->data['arr_agent']  	= $this->model_basic->populateDropdown("admin_id", "CONCAT_WS( ' ', `first_name` , `last_name` ) AS agent_name", $this->adminMaster, "`role` = 'agent' AND `status` = 'active'", "agent_name", "ASC");
	
	$conditions	= "property_id = '".$property_id."'";
	$this->data['arr_property']	= $this->model_basic->getValues_conditions($this->propertyMasterTable, '*', '', $conditions);
	
	$idField	= "property_type_id";
	$nameField	= "property_name";
	$tableName	= "lp_property_type_master";
	$condition	= "property_status = 'active'";
	$orderField	= 'property_name';
	$orderBy	= 'ASC';
	
	$region_id = $this->data['arr_property'][0]['region_id'];
	$this->data['arr_property_type']	= $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
	$this->data['arr_region'] 		= $this->model_basic->populateDropdown("region_id", "region_name", "lp_region_master", "region_status = 'active'", 'region_name', 'ASC');
	$this->data['arr_location'] 		= $this->model_basic->populateDropdown("location_id", "location_name", "lp_location_master", "location_status = 'active' AND region_id=".$region_id, 'location_name', 'ASC');
	$this->data['arr_viwes'] 		= $this->model_basic->populateDropdown("view_type_id", "view_type_name", "lp_view_type_master", "view_type_status = 'active'", 'view_type_name', 'ASC');
	
	$property_suitability = $this->model_basic->getValues_conditions($this->propertySuitability, '*', '', 'property_id = '.$property_id);
		
		if(is_array($property_suitability))
			$this->data['property_suitability'] = $property_suitability;
			
	
	//<!-------------code------------------>
	
	if($this->input->get_post('action') == 'Process')
		{ 
			//print_r($_POST);
			//die();
			$this->form_validation->set_rules('property_name', 'Property Name', 'trim|required');
			$this->form_validation->set_rules('property_type', 'Property Type', 'trim|required');
			$this->form_validation->set_rules('unique_id', 'Unique ID', 'trim|required');
			$this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required');
			$this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
			$this->form_validation->set_rules('seo_title', 'SEO Title', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				//$this->data['errmsg']= validation_errors();
			}
			else {
				//print_r($_POST);
				//die();
				if($this->input->get_post('view'))
				{
					$views_id = implode(',', $this->input->get_post('view'));
				}
				else
				{
					$views_id = '';
				}
		
				if($this->input->get_post('manager_lang_id')) {
					$langs_id = implode(',', $this->input->get_post('manager_lang_id'));
				} else {
					$langs_id = '';
				}
		
				$propSlug	= $this->check_for_slug($this->input->get_post('page_title'),$property_id);
				
				$updatePropertyArr  =  array(
					'property_name'			=> addslashes(trim($this->input->get_post('property_name'))),
					'property_currency'		=> trim($this->input->get_post('property_currency')),
					'furnished'			=> $this->input->get_post('furnished'),
					'off_plan'			=> $this->input->get_post('off_plan'),
					'property_currency'		=> 'THB',
					'property_type_id'  		=> addslashes(trim($this->input->get_post('property_type'))),
					'property_ranking'    		=> addslashes(trim($this->input->get_post('property_ranking'))),
					'unit_number'			=> addslashes(trim($this->input->get_post('unit_number'))),
					'bedrooms'			=> addslashes(trim($this->input->get_post('bedrooms'))),
					'is_studio'			=> addslashes(trim($this->input->get_post('is_studio'))),
					'sleeps'    			=> addslashes(trim($this->input->get_post('sleeps'))),
					'bathrooms'			=> addslashes(trim($this->input->get_post('bathrooms'))),
					'bedrooms_configuration'	=> addslashes(trim($this->input->get_post('bedroom_configuration'))),
					'bathrooms_configuration'	=> addslashes(trim($this->input->get_post('bathroom_configuration'))),
					'total_size'			=> addslashes(trim($this->input->get_post('total_size'))),
					'indoor_size'			=> addslashes(trim($this->input->get_post('size_starting_from'))),
					'outdoor_size'			=> addslashes(trim($this->input->get_post('size_ending_to'))), 
					'floor'				=> addslashes(trim($this->input->get_post('floor'))),
					'storeys'			=> addslashes(trim($this->input->get_post('storeys'))),
					'pooltype'			=> addslashes(trim($this->input->get_post('pooltype'))),
					'latitude'			=> addslashes(trim($this->input->get_post('latitude'))),
					'longitude'			=> addslashes(trim($this->input->get_post('longitude'))), 
					'region_id'			=> addslashes(trim($this->input->get_post('region'))),
					'location_id'			=> addslashes(trim($this->input->get_post('location'))),
					'direction_to_property'		=> addslashes(trim($this->input->get_post('direction_to_property'))),
					'page_title'			=> addslashes(trim($this->input->get_post('page_title'))),
					'property_slug'			=> $propSlug,
					'optional_title'		=> addslashes(trim($this->input->get_post('page_title'))),
					'seo_title'			=> addslashes(trim($this->input->get_post('seo_title'))),
					'local_information'		=> addslashes(trim($this->input->get_post('local_information'))),
					'meta_description'		=> addslashes(trim($this->input->get_post('meta_description'))),
					'property_description'		=> addslashes(trim($this->input->get_post('property_description'))),
					'property_info_onsite'		=> addslashes(trim($this->input->get_post('property_info_onsite'))),
					'property_internal_info'	=> addslashes(trim($this->input->get_post('property_internal_info'))),
					'view_id'			=> $views_id,
					'added_by'			=> $this->nsession->userdata('admin_id'),
					'phukettown_distance'		=> addslashes(trim($this->input->get_post('phukettown_distance'))),
					'patong_distance'		=> addslashes(trim($this->input->get_post('patong_distance'))),
					'phuketairport_distance'	=> addslashes(trim($this->input->get_post('phuketairport_distance'))),
					'walkingdistance_1'		=> addslashes(trim($this->input->get_post('walkingdistance_1'))),
					'walkingdistance_2'		=> addslashes(trim($this->input->get_post('walkingdistance_2'))),
					'walkingdistance_3'		=> addslashes(trim($this->input->get_post('walkingdistance_3'))),
					'similar_property_tag'		=> addslashes(trim($this->input->get_post('similar_property_tag'))),
					'special_offer_title'		=> addslashes(trim($this->input->get_post('special_offer_title'))),
					'special_offer_text'		=> addslashes(trim($this->input->get_post('special_offer_text'))),
					'added_on'			=> date("Y-m-d H:i:s")
					);
				
					$updateArr = array( 'property_id' => $property_id );
					
					/*** property suitability section ***/
					$this->model_basic->deleteData($this->propertySuitability, 'property_id = '.$property_id);
					
					$insertPropertySuitabilityArr = array(
							'property_id' 		=> $property_id,
							'special_feature1'	=> addslashes(trim($this->input->get_post('special_feature1'))),
							'special_feature2'	=> addslashes(trim($this->input->get_post('special_feature2'))),
							'special_feature3'	=> addslashes(trim($this->input->get_post('special_feature3'))),
							'special_feature4'	=> addslashes(trim($this->input->get_post('special_feature4')))
						      );
					
					$this->model_basic->insertIntoTable($this->propertySuitability, $insertPropertySuitabilityArr);
						
		
				//// Aminities update section
					if($this->input->get_post('sales_amenities')) {
						
					$amm		   = $this->input->get_post('sales_amenities');
					$sales_payment_info =  $this->input->get_post('sales_payment_info');
					$agent_id = $this->input->get_post('agent_id');  
					
					$property_sales_serial_no	= addslashes(trim($this->input->get_post('property_sales_serial_no')));
					$temp_amm	= array();
					if(!empty($amm) && is_array($amm)){
						foreach($amm as $amm_id=> $amm_val){
							if($amm_val != 'absent'){
								$temp_amm[]	= $amm_id.'::'.$amm_val;
							}
						}
					}
					$amenities_id 	= implode(',', $temp_amm );
				} else {
					$amenities_id 	= '';
				}
				
				
				
				
				$updateArr2  =  array(
					
							'property_sales_serial_no' 	=> $property_sales_serial_no,
							'amenities_id'			=> $amenities_id,
							'sales_payment_info'		=> $sales_payment_info,
							'off_plan'			=> $this->input->get_post('off_plan'),
							'property_sales_serial_no'	=> addslashes( $this->input->get_post('unique_id') ),
							'agent_id'			=> $agent_id,
							'sales_price_from'		=> addslashes(  $this->input->get_post('sales_price_from') ),
							'freehold_leasehold'		=> addslashes(  $this->input->get_post('hold_type') ),
							'freehold_leasehold_text'	=> addslashes(  $this->input->get_post('freehold_leasehold_text') ),
							'size_starting_from'		=>  addslashes(  $this->input->get_post('size_starting_from') ),
							'size_ending_to'		=>  addslashes(  $this->input->get_post('size_ending_to') ),
							'bedroom_starting_from' 	=> addslashes(  $this->input->get_post('bedrooms') ),
							'bathroom_starting_from' 	=> addslashes(  $this->input->get_post('bathrooms') ),
							'property_sales_desc'	 	=> addslashes(  $this->input->get_post('property_description') ),
							'sales_beach_distance'	 	=> addslashes(  $this->input->get_post('sales_beach_distance') ),
							
						    );
				
				$idArr		= array( 'property_id' => $property_id );
				
				
				$Condition = "property_id = '".$property_id."'";
				$rs = $this->model_basic->getValues_conditions($this->salesMasterTable, '*', '', $Condition);
			
								
				$row = $rs[0];
				if(!($row))
				{
					
					$insertArr2 =array(
						'property_id' 			=> $property_id,
						'property_sales_serial_no'	=> addslashes( $this->input->get_post('unique_id') ),
						'amenities_id'			=> $amenities_id,
						'off_plan'			=> $this->input->get_post('off_plan'),
						'sales_price_from'		=> addslashes(  $this->input->get_post('sales_price_from') ),
						'freehold_leasehold'		=> addslashes(  $this->input->get_post('hold_type') ),
						'freehold_leasehold_text'	=> addslashes(  $this->input->get_post('freehold_leasehold_text') ),
						'size_starting_from'		=>  addslashes(  $this->input->get_post('size_starting_from') ),
						'size_ending_to'		=>  addslashes(  $this->input->get_post('size_ending_to') ),
						'bedroom_starting_from' 	=> addslashes(  $this->input->get_post('bedrooms') ),
						'bathroom_starting_from' 	=> addslashes(  $this->input->get_post('bathrooms') ),
						'property_sales_desc'	 	=> addslashes(  $this->input->get_post('property_description') ),
						'sales_beach_distance'	 	=> addslashes(  $this->input->get_post('sales_beach_distance') ),
						);
					$ret   = $this->model_basic->insertIntoTable($this->salesMasterTable,$insertArr2);
					
				}
				else
				{	
					$ret   = $this->model_basic->updateIntoTable($this->salesMasterTable,$idArr,$updateArr2);
				}
				
			$affected_row  = $this->model_basic->updateIntoTable($this->propertyMasterTable ,$updateArr,$updatePropertyArr);
			if($affected_row>0)
			
			   
			    $this->nsession->set_userdata('succmsg', "Property updated successfully.");
			
			
			else
				
			$this->nsession->set_userdata('errmsg', "Property could not be updated successfully.");
			
			redirect(BACKEND_URL."property_sales/property_image/".$property_id."/".$page."/");
			return false;
		
			}
			
		
		}
	
	
	//<!--------end------------------>
	$row = array();
			
	$Condition = "property_id = '".$property_id."'";
	$rs = $this->model_basic->getValues_conditions($this->propertyMasterTable, '', '', $Condition);
	$row = $rs[0];
	if($row)
	{
	    $this->data['arr_property'] = $row;
	}
	else
	{
		$this->session->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/");
		return false;
	}
	
	/***** Amenities and sales ********/
	
	$Condition = "property_id = '".$property_id."'";
	$this->data['arr_property_sales'] = $this->model_basic->getValues_conditions($this->salesMasterTable, '*', '', $Condition);
	$this->data['arr_prop_amenity'] = $this->model_property_sales->get_property_amenities();
	
	/***** End Amenities and sales ********/
	
	/**** TAB SECTION ****/
	
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'edit property'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
	
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function add_property()
    {
        chk_login();
        $this->data='';
	$this->data['succmsg'] = '';
	$this->data['errmsg'] = '';
	
	$property_id		= $this->uri->segment(3, 0);
	$page			= $this->uri->segment(4, 0);
	$this->data['page']	= $page;	
	$this->data['controller']	= "property_sales";
	$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/".$page;

	$idField	= "property_type_id";
	$nameField	= "property_name";
	$tableName	= "lp_property_type_master";
	$condition	= "property_status = 'active'";
	$orderField	= 'property_name';
	$orderBy	= 'ASC';
	
	$this->data['arr_property_type']	= $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
	$this->data['arr_region'] 		= $this->model_basic->populateDropdown("region_id", "region_name", "lp_region_master", "region_status = 'active'", 'region_name', 'ASC');
	$this->data['arr_prop_amenity'] = $this->model_property_sales->get_property_amenities();
	$this->data['arr_agent']  	= $this->model_basic->populateDropdown("admin_id", "CONCAT_WS( ' ', `first_name` , `last_name` ) AS agent_name", $this->adminMaster, "`role` = 'agent' AND `status` = 'active'", "agent_name", "ASC");
	
	//<!------------code------------------>
			if($this->input->get_post('action') == 'Process')
		{ 
			
			$this->form_validation->set_rules('property_name', 'Property Name', 'trim|required');
			$this->form_validation->set_rules('property_type', 'Property Type', 'trim|required');
			$this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required');
			$this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|numeric');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|numeric');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
			$this->form_validation->set_rules('seo_title', 'SEO Title', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else {
				
				if($this->input->get_post('view'))
				{
					$views_id = implode(',', $this->input->get_post('view'));
				}
				else
				{
					$views_id = '';
				}
		
				if($this->input->get_post('manager_lang_id')) {
					$langs_id = implode(',', $this->input->get_post('manager_lang_id'));
				} else {
					$langs_id = '';
				}
		
				
					
				$propSlug	= $this->check_for_slug($this->input->get_post('page_title'),$property_id);
				
				$insertPropertyArr  =  array(
					'property_name'			=> addslashes(trim($this->input->get_post('property_name'))),
					'property_currency'		=> 'THB',
					'furnished'			=> $this->input->get_post('furnished'),
					'off_plan'			=> $this->input->get_post('off_plan'),
					'property_type_id'  		=> addslashes(trim($this->input->get_post('property_type'))),
					'record_type'    		=> "Sales",
					'bedrooms'			=> addslashes(trim($this->input->get_post('bedrooms'))),
					'is_studio'			=> addslashes(trim($this->input->get_post('is_studio'))),
					'sleeps'    			=> addslashes(trim($this->input->get_post('sleeps'))),
					'bathrooms'			=> addslashes(trim($this->input->get_post('bathrooms'))),
					'bedrooms_configuration'	=> addslashes(trim($this->input->get_post('bedroom_configuration'))),
					'bathrooms_configuration'	=> addslashes(trim($this->input->get_post('bathroom_configuration'))),
					'total_size'			=> addslashes(trim($this->input->get_post('size_ending_to'))),
					'indoor_size'			=> addslashes(trim($this->input->get_post('size_starting_from'))),
					'outdoor_size'			=> addslashes(trim($this->input->get_post('size_ending_to'))), 
					'floor'				=> addslashes(trim($this->input->get_post('floor'))),
					'storeys'			=> addslashes(trim($this->input->get_post('storeys'))),
					'development_id'		=> addslashes(trim($this->input->get_post('development_name'))),
					'pooltype'			=> addslashes(trim($this->input->get_post('pooltype'))),
					'latitude'			=> addslashes(trim($this->input->get_post('latitude'))),
					'longitude'			=> addslashes(trim($this->input->get_post('longitude'))), 
					'region_id'			=> addslashes(trim($this->input->get_post('region'))),
					'location_id'			=> addslashes(trim($this->input->get_post('location'))),
					'direction_to_property'		=> addslashes(trim($this->input->get_post('direction_to_property'))),
					'page_title'			=> addslashes(trim($this->input->get_post('page_title'))),
					'property_slug'			=> $propSlug,
					'optional_title'		=> addslashes(trim($this->input->get_post('page_title'))),
					'seo_title'			=> addslashes(trim($this->input->get_post('seo_title'))),
					'local_information'		=> addslashes(trim($this->input->get_post('local_information'))),
					'meta_description'		=> addslashes(trim($this->input->get_post('meta_description'))),
					'property_description'		=> addslashes(trim($this->input->get_post('property_description'))),
					'property_info_onsite'		=> addslashes(trim($this->input->get_post('property_info_onsite'))),
					'property_internal_info'	=> addslashes(trim($this->input->get_post('property_internal_info'))),
					'property_ranking'		=> addslashes(trim($this->input->get_post('property_ranking'))),
					'manager_salutations'		=> addslashes(trim($this->input->get_post('manager_salutations'))),
					'second_manager_salutations'	=> addslashes(trim($this->input->get_post('second_manager_salutations'))),
					'property_manager_name'		=> addslashes(trim($this->input->get_post('property_manager_name'))),
					'manager_email'			=> addslashes(trim($this->input->get_post('manager_email'))),
					'manager_contact_number1'	=> addslashes(trim($this->input->get_post('manager_contact_number1'))),
					'manager_contact_number2'	=> addslashes(trim($this->input->get_post('manager_contact_number2'))),
					'second_manager_name'		=> addslashes(trim($this->input->get_post('second_manager_name'))),
					'second_manager_email'		=> addslashes(trim($this->input->get_post('second_manager_email'))),
					'second_manager_contact1'	=> addslashes(trim($this->input->get_post('second_manager_contact1'))),
					'second_manager_contact2'	=> addslashes(trim($this->input->get_post('second_manager_contact2'))),
					'view_id'			=> $views_id,
					'manager_lang_id'		=> $langs_id,
					'added_by'			=> $this->nsession->userdata('admin_id'),
					'similar_property_tag'		=> addslashes(trim($this->input->get_post('similar_property_tag'))),
					'special_offer_title'		=> addslashes(trim($this->input->get_post('special_offer_title'))),
					'special_offer_text'		=> addslashes(trim($this->input->get_post('special_offer_text'))),
					'added_on'			=> date("Y-m-d H:i:s")
					);
				
					
					
				//// Aminities update section
					if($this->input->get_post('sales_amenities')) {
						
					$amm		   = $this->input->get_post('sales_amenities');
					$sales_payment_info =  $this->input->get_post('sales_payment_info'); 
					
					$property_sales_serial_no	= addslashes(trim($this->input->get_post('property_sales_serial_no')));
					$temp_amm	= array();
					if(!empty($amm) && is_array($amm)){
						foreach($amm as $amm_id=> $amm_val){
							if($amm_val != 'absent'){
								$temp_amm[]	= $amm_id.'::'.$amm_val;
							}
						}
					}
					$amenities_id 	= implode(',', $temp_amm );
				} else {
					$amenities_id 	= '';
				}
				
			$affected_row  = $this->model_basic->insertIntoTable($this->propertyMasterTable ,$insertPropertyArr);
			if($affected_row>0){
				
				
				/*** property suitability section ***/
				//$this->model_basic->deleteData($this->propertySuitability, 'property_id = '.$property_id);
				$insertPropertySuitabilityArr = array(
						'property_id' 		=> $affected_row,
						'special_feature1'	=> addslashes(trim($this->input->get_post('special_feature1'))),
						'special_feature2'	=> addslashes(trim($this->input->get_post('special_feature2'))),
						'special_feature3'	=> addslashes(trim($this->input->get_post('special_feature3'))),
						'special_feature4'	=> addslashes(trim($this->input->get_post('special_feature4')))
					      );
				$this->model_basic->insertIntoTable($this->propertySuitability, $insertPropertySuitabilityArr);
				
				///genarete unique property id
				$property_name   = strtoupper( substr( addslashes(trim($this->input->get_post('page_title'))),0,1 ));
				$location_id 	 = addslashes(trim($this->input->get_post('location')));
				$bedrooms 	 = addslashes(  $this->input->get_post('bedrooms') );
				$indoor_size 	 = addslashes(  $this->input->get_post('size_starting_from') );
				$indoor_size 	 = filter_var($indoor_size, FILTER_SANITIZE_NUMBER_INT);
				$location_code = $this->model_basic->getValue_condition($this->locationMaster, 'location_code','', 'location_id='.$location_id);	
				$studio = addslashes(trim($this->input->get_post('is_studio')));
				$unique_id = '';
				$unique_id = $location_code;
				$unique_id .= $property_name;
				
				if($studio=="Yes"){
					$unique_id .= '1S';
				}else{
					$unique_id .= $bedrooms.'B';
				}
				$unique_id .= $indoor_size;
				
				/** Sales insert ****/
				$insertArr2 =array(
					'property_id' 			=> $affected_row,
					'property_sales_serial_no' 	=> $property_sales_serial_no,
					'amenities_id'			=> $amenities_id,
					'property_sales_serial_no'	=> $unique_id,
					'sales_payment_info'		=> $sales_payment_info,
					'off_plan'			=> $this->input->get_post('off_plan'),
					'agent_id'			=> $this->input->get_post('agent_id'),
					'sales_price_from'		=> addslashes(  $this->input->get_post('sales_price_from') ),
					'freehold_leasehold'		=> addslashes(  $this->input->get_post('hold_type') ),
					'freehold_leasehold_text'	=> addslashes(  $this->input->get_post('freehold_leasehold_text') ),
					'size_starting_from'		=>  addslashes(  $this->input->get_post('size_starting_from') ),
					'size_ending_to'		=>  addslashes(  $this->input->get_post('size_ending_to') ),
					'bedroom_starting_from' 	=> addslashes(  $this->input->get_post('bedrooms') ),
					'bathroom_starting_from' 	=> addslashes(  $this->input->get_post('bathrooms') ),
					'property_sales_desc'	 	=> addslashes(  $this->input->get_post('property_description') ),
					'sales_beach_distance'	 	=> addslashes(  $this->input->get_post('sales_beach_distance') ),
					);
				$ret   = $this->model_basic->insertIntoTable($this->salesMasterTable,$insertArr2);
				
						
				$this->nsession->set_userdata('succmsg', "Property Added successfully.");
				
			}else{
				$this->nsession->set_userdata('errmsg', "Property could not be Added successfully.");	
				
			}	
			redirect(BACKEND_URL."property_sales/property_image/".$affected_row."/".$page."/");
			return false;
		
			}
			
			
			
		}
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
	
	//<!---------------------------------->
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'details'),true);
        $this->elements['middle']='sales/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function ajax_getLocation_of_region()
    {
		$region_id = $this->input->post('region');
		$option = '<option value="">----Please select-----</option>';
		$records = $this->model_property_sales->getLocation_of_region($region_id);
		if(is_array($records)){
			foreach($records as $record){
				$option .= '<option value="'.$record['location_id'].'">'.$record['location_name'].'</option>';
			}
		}
		echo $option;
    }
    
    public function check_for_slug($pagetitle, $proprerty_id = 0)
    {
		$prop_slug 	= url_title(strtolower($pagetitle));
		$id 		= $proprerty_id;
		$whereArr	= array();
		if($id > 0){
			$whereArr	= 'property_slug = "'.$prop_slug.'" AND property_id != '.$id ;
		}else{			
			$whereArr	= 'property_slug = "'.$prop_slug.'"';
		}
		
		$bool 	= $this->model_basic->isRecordExist($this->propertyMasterTable, $whereArr );
		if($bool == 0){
			$slug = $prop_slug;
		}else{
			$slug = $prop_slug.'-'.$bool;
		}		
		return $slug;
    }
    
    

    
    /**** property image section ***/
    
    public function property_image()
    {
        chk_login();
        $this->data='';
	
	$property_id			= $this->uri->segment(3, 0);
	$page				= $this->uri->segment(4, 0);
	$this->data['page']		= $page;
	$this->data['property_id']	= $property_id;
	$this->data['controller']	= "property_sales";
	
	// Prepare Data
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition,'image_order,property_image_id', 'ASC' );
	
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'property image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/edit_property_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
      /**** property floor image  ***/
    public function floorplan_image()
    {
         chk_login();
        $this->data='';
	
	$property_id			= $this->uri->segment(3, 0);
	$page				= $this->uri->segment(4, 0);
	$this->data['page']		= $page;
	$this->data['property_id']	= $property_id;
	$this->data['controller']	= "property_sales";
	
	// Prepare Data
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition,'image_order,property_image_id', 'ASC' );
	
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->floorplanimage, '*', '', $Condition,'image_order,floor_plan_id', 'ASC' );
		
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'floorplan image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/edit_floorplan_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
     function change_floorplan_status(){
	if($this->input->post('property_id')!=''){
	    $property_id = $this->input->post('property_id');
	    $status = $this->input->post('status');
	    echo $this->model_basic->updateIntoTable($this->floorplanimage, array('property_id'=>$property_id), array('is_active'=>$status));
	}
    }

   
    public function do_image_upload()
	{
		chk_login();
		$output_dir = FILE_UPLOAD_ABSOLUTE_PATH. "property/";
		if(isset($_FILES["myfile"]))
		{
			
			$ret = array();
			$error = $_FILES["myfile"]["error"];
			{
				$fileCount = count($_FILES["myfile"]['name']);
				for($i=0; $i < $fileCount; $i++)
				{
					
					//****************** file name formatting area*************************
					
					$file_name = $_FILES["myfile"]["name"][$i];
					$rest_string_after_dot = strrchr($file_name, '.' );
					
					$last_dot_position =  strrpos($file_name,".");
					 $just_file_name = substr($file_name,0,$last_dot_position);
										
					$just_file_ext = substr($rest_string_after_dot,1);//////////////
					//step 2
					
										
					$random_text = rand();
					$final_random_text = substr($random_text,0,5);
					
					$fileName = $just_file_name."_".$final_random_text.'.'.$just_file_ext;
					
					// ****************file name formating area ends**************************
					//$fileName = rand()."_".$_FILES["myfile"]["name"][$i];
					//$ret[$fileName]= $output_dir.$fileName; //$ret[$fileName] = $fileName;
					
					move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
					
					/*** create thumbanil ***/
					$source_image 	= $output_dir.$fileName;
					
					/*** for 591*393 ***/
					$new_big_image	= $output_dir."big/".$fileName;
					$big_width		= '591';
					$big_height		= '393';
					image_thumbnail($source_image, $new_big_image, $big_width, $big_height);
					
					/*** for 116*126 ***/
					$new_list_image	= $output_dir."list/".$fileName;
					$list_width	= '150';
					$list_height	= '140';
					image_thumbnail($source_image, $new_list_image, $list_width, $list_height, FALSE);
					
					/*** for 53*40 ***/
					$new_small_image	= $output_dir."small/".$fileName;
					$small_width		= '53';
					$small_height		= '40';
					image_thumbnail($source_image, $new_small_image, $small_width, $small_height,FALSE);
					
					$ret = $fileName;
				}
			}
			
			
			echo json_encode($ret);
		}
    }
    
    
    public function add_property_image(){
	$data = array();
	
	if($this->input->post('property_id')!=''){
	    
	    $is_featured_exist = $this->model_basic->getValue_condition($this->propertyImageTable, 'is_featured', 'is_featured', 'is_featured = "Yes" AND property_id='.$this->input->post('property_id'));
	    
	    $max_order = $this->model_basic->getValue_condition($this->propertyImageTable, 'max(image_order)', 'max_order', ' property_id='.$this->input->post('property_id'));
	    $order = $max_order + 1;
	    
	    $feature = 'No';
	    if($is_featured_exist == ''){
		$feature = 'Yes';
	    }
	    $image_name = mysql_real_escape_string($this->input->post('image_name'));
	    $insertPropertyImageArr = array(
					    'property_id' 	=> mysql_real_escape_string($this->input->post('property_id')),
					    'image_file_name'	=> $image_name,
					    'is_featured'	=> $feature,
					    'image_order'	=>$order
					    );

	  $insert_id =  $this->model_basic->insertIntoTable($this->propertyImageTable,$insertPropertyImageArr);
	   $update_arr=array();
	    if($feature=='Yes'){
		  $update_arr["feature_image_name"]=$image_name;
	    }
	    $update_arr['image_count']=$this->model_basic->isRecordExist($this->propertyImageTable,' property_id="'.$this->input->post('property_id').'"');
	    if(!empty($update_arr)){
		  $idArr=array("property_id"=>$this->input->post('property_id'));
		  $this->model_basic->updateIntoTable($this->propertyMasterTable, $idArr, $update_arr);
	    }
	  if($insert_id){
	    $data['val']['property_image_id'] = $insert_id;
	    $data['val']['image_file_name'] = $image_name;
	    $data['val']['image_order'] = $order;
	    $data['val']['is_feature'] = $feature;
	    
	    echo $newly_added = $this->load->view('sales/addnew_image',$data,true);
	    
	  }
	}
	
    }
    
    
    public function add_floorplan_image(){
	$data = array();
	
	if($this->input->post('property_id')!=''){
	    
	    $max_order = $this->model_basic->getValue_condition($this->floorplanimage, 'max(image_order)', 'max_order', ' property_id='.$this->input->post('property_id'));
	    $order = $max_order + 1;
	    
	    $status = mysql_real_escape_string( $this->input->post('status') );
	    
	    $image_name = mysql_real_escape_string($this->input->post('image_name'));
	    $insertPropertyImageArr = array(
					    'property_id' 	=> mysql_real_escape_string($this->input->post('property_id')),
					    'image_file_name'	=> $image_name,
					    'image_order'	=> $order,
					    'is_active'		=> $status
					    );

	  $insert_id =  $this->model_basic->insertIntoTable($this->floorplanimage,$insertPropertyImageArr);
	  
	  if($insert_id){
	    $data['val']['floor_plan_id'] = $insert_id;
	    $data['val']['image_file_name'] = $image_name;
	    $data['val']['image_order'] = $order;
	    
	    
	    echo $newly_added = $this->load->view('sales/addnew_floorplan_image',$data,true);
	    
	  }
	}
	
    }
    
    
    public function update_image_data(){
	if($this->input->post('property_image_id')!=''){
	    $image_property_id = mysql_real_escape_string($this->input->post('property_image_id'));
	    $updateArr = array(
			       "image_alt" => mysql_real_escape_string($this->input->post('alt')),
			       "image_caption" => mysql_real_escape_string($this->input->post('caption')),
			       "image_order" => mysql_real_escape_string($this->input->post('order')),
			       );
	    $idArr = array(
			   'property_image_id' => $image_property_id
			   );
	    echo $this->model_basic->updateIntoTable($this->propertyImageTable, $idArr, $updateArr);
	}

	
    }
    
    
    public function update_floorplan_image_data(){
    if($this->input->post('floor_plan_id')!=''){
	$floor_plan_id = mysql_real_escape_string($this->input->post('floor_plan_id'));
	$updateArr = array(
			   "image_alt" => mysql_real_escape_string($this->input->post('alt')),
			   "image_caption" => mysql_real_escape_string($this->input->post('caption')),
			   "image_order" => mysql_real_escape_string($this->input->post('order')),
			   );
	$idArr = array(
		       'floor_plan_id' => $floor_plan_id
		       );
	echo $this->model_basic->updateIntoTable($this->floorplanimage, $idArr, $updateArr);
    }
    
    }
    
    public function set_feature_image(){
	if($this->input->post()){
	    // set all none
	    $image_id = $this->input->post('property_image_id');
	     $propertyImageDetails = $this->model_basic->getValues_conditions($this->propertyImageTable, '', '', 'property_image_id='.$image_id);
	     
	     if(is_array($propertyImageDetails)){
			$property_id=$propertyImageDetails[0]['property_id'];
			$image_name=$propertyImageDetails[0]['image_file_name'];
			$updateArr = array(
			       "is_featured" => 'No',
			       );
			$idArr = array(
				       'property_id' => $property_id
				       
				       );
			$this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_id' => $property_id ), array( "is_featured" => 'No'));
			$this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_image_id' => $image_id ), array( "is_featured" => 'Yes'));
			  
		       $update_arr["feature_image_name"]=$image_name;
		       $update_arr['image_count']=$this->model_basic->isRecordExist($this->propertyImageTable,' property_id="'.$property_id.'"');
		       if(!empty($update_arr)){
			     $this->model_basic->updateIntoTable($this->propertyMasterTable, $idArr, $update_arr);
		       }
	     }
	}
    }
    
  
    
    
    public function delete_property_image()
	{
		chk_login();
		
		$property_image_id	= $this->input->get_post('property_image_id');
		
		$Condition 		= " property_image_id = '".$property_image_id."'";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition);
		$prev_image_name	= $arr_property_image[0]['image_file_name'];
		
		if($prev_image_name != '')
		{
			/*** Delete Image from Server ***/
			if(file_exists(file_upload_absolute_path().'property/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name));
			}
		}
		
		$delete_where	= "property_image_id = '".$property_image_id."' ";
		$this->model_basic->deleteData($this->propertyImageTable, $delete_where);
		return true;
	}
	
	
	public function delete_floorplan_image()
	{
		chk_login();
		
		$floor_plan_id	= $this->input->get_post('floor_plan_id');
		
		$Condition 		= " floor_plan_id = '".$floor_plan_id."'";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->floorplanimage, '*', '', $Condition);
		$prev_image_name	= $arr_property_image[0]['image_file_name'];
		
		if($prev_image_name != '')
		{
			/*** Delete Image from Server ***/
			if(file_exists(file_upload_absolute_path().'property/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name));
			}
		}
		
		$delete_where	= "floor_plan_id = '".$floor_plan_id."' ";
		echo $this->model_basic->deleteData($this->floorplanimage, $delete_where);
		return true;
	}
	
    	
	public function contact(){
		
		chk_login();
		$property_id		= $this->uri->segment(3,0);
		$page		        = $this->uri->segment(4,0);
		$this->data='';
		$this->data['succmsg']='';
		$this->data['errmsg']='';
		
		$conditions	= "property_id = '".$property_id."'";
		$arr_property	= $this->model_basic->getValues_conditions($this->propertyMasterTable, '', '', $conditions,'','');
		
		$arr_property_sales	= $this->model_basic->getValues_conditions($this->salesMasterTable, '*', '', $conditions);
		$this->data['arr_property'] = $arr_property[0];
		$this->data['arr_property_sales'] = $arr_property_sales[0];
		if($this->input->post()){
		   
			
				$owner_name	 = stripslashes( trim( $this->input->post('owner_name')));
				$contact_number  = stripslashes( trim( $this->input->post('contact_number')));
				$owner_email	 = stripslashes( trim( $this->input->post('owner_email')));
				$notes		 = stripslashes( trim( $this->input->post('note')));
				
				
				$owner_update_arr = array(
							  "property_manager_name"	=> $owner_name,
							  "manager_contact_number1" 	=> $contact_number,
							  "manager_email" 		=> $owner_email,
							  );
				$idArr = array(
						"property_id"	=> $property_id
						);
				
				$note_update_arr = array(
							  "add_notes"	=> $notes,
							  );
				
				$owner_update = $this->model_basic->updateIntoTable($this->propertyMasterTable ,$idArr, $owner_update_arr);
				$note_update = $this->model_basic->updateIntoTable($this->salesMasterTable ,$idArr, $note_update_arr);
				if($owner_update || $note_update){
				
				 $this->nsession->set_userdata('succmsg', "Property updated successfully.");
				  
				}else{
				    //$this->nsession->set_userdata('errmsg', "Property could not be updated successfully.");    
				}
				
				redirect(BACKEND_URL.'property_sales/edit_map_location/'.$property_id.'/'.$page);
				return false;
				
				
			
		}
		/******** tabs data ********/
		//$record = $this->model_basic->getValues_conditions('lp_property_master', array('property_slug','status'), '', 'property_id='.$property_id, '', '', 0) ;
		
		
		$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'contact'),true);
	
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		/******** end tabs data ********/
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='sales/edit_contact';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_map_location()
	{
	        chk_login();
		$this->data='';
		
		$property_id				= 	$this->uri->segment(3,0);
		$this->data['property_id'] 		= 	$property_id;
		$page					= 	$this->uri->segment(4,0);
		$final_map_location	=	array();
				
		$default_map_location	=	$this->model_basic->getValues_conditions('lp_property_map_location', '*', '', " `status` = 'Active'",'location_type');		
		$override_map_location	=	$this->model_basic->getValues_conditions('lp_override_map_location', '*', '', " `property_id` = '".$property_id."' AND `status` = 'Active'",'map_location_id');
		
		if(is_array($override_map_location) && count($override_map_location)>0)
		{
			foreach($override_map_location as $s=>$t)
			{
				foreach($default_map_location as $k=>$v)
				{
					if($t['map_location_id'] == $v['id'])
					{
						$final_map_location[$k]				=	$v;
						$final_map_location[$k]['property_id']		=	$t['property_id'];
						$final_map_location[$k]['latitude']		=	$t['latitude'];
						$final_map_location[$k]['longitude']		=	$t['longitude'];
					}
				}
			}						
		}
		$this->data['final_map_location'] 	= $final_map_location;
		$this->data['default_map_location'] 	= $default_map_location;
		
		//<!----------------------update-------------------------------->
		
		if($this->input->get_post('action') == 'Process'){
			
			$prev_map_location_id	 = $this->input->post('map_location_id');
			
			if(is_array($prev_map_location_id))
			{
				$this->form_validation->set_rules('map_location_id[]', 'Location Name', 'trim|required');
				$this->form_validation->set_rules('latitude[]', 'Latitude', 'trim|required');
				$this->form_validation->set_rules('longitude[]', 'Longitude', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					
				}
				else {
					$map_location_id	 = $this->input->post('map_location_id');
					$latitude	 	 = $this->input->post('latitude');
					$longitude	 	 = $this->input->post('longitude');
					$prop_id	 	 = $this->input->post('prop_id');
					
					$delete_where	= " property_id = '".$property_id."' ";
					$d1 = $this->model_basic->deleteData('lp_override_map_location', $delete_where);
					
					if(is_array($map_location_id) && count($map_location_id)>0)
					{
						foreach($map_location_id as $k=>$v){
						$insert_arr = array(
									  "property_id"	  	=> $prop_id,
									  "map_location_id"	=> $map_location_id[$k],
									  "latitude" 		=> $latitude[$k],
									  "longitude" 		=> $longitude[$k]
									  );
						$this->model_basic->insertIntoTable('lp_override_map_location',$insert_arr);
						}
					}
					$this->nsession->set_userdata('succmsg', "Successfully Completed");					
					redirect(BACKEND_URL.'property_sales/index/'.$page);
				}
			}
			else
			{
				$delete_where	= " property_id = '".$property_id."' ";
				$d1 = $this->model_basic->deleteData('lp_override_map_location', $delete_where);
				$this->nsession->set_userdata('succmsg', "Successfully Completed");
				redirect(BACKEND_URL.'property_sales/index/'.$page);
			}
		}
		
		
		
		//<!------------------------end------------------------------------->
		
		$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'edit_map_location'),true);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='sales/edit_map';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	    
	    
	}

}
?>