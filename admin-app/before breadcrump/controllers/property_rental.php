<?php
class Property_rental extends CI_Controller{
    
    
        var $propertyMasterTable	= 'lp_property_master';
	var $proprtyTypeTable		= 'lp_property_type_master';
	var $rentMasterTable		= 'lp_rent_master';
	var $locationMaster		= 'lp_location_master';
	var $propertySuitability	= 'lp_property_suitability';
	var $propertyImageTable		= 'lp_property_image';
	var $seasonPriceMaster	    	= 'lp_property_season_price';
	var $propertyAvailibility	= 'lp_property_availibility';
	var $rentCustomFields		= 'lp_rent_custom_fields';
	var $salesdevelopmentpages	= 'lp_sales_development_pages';
	var $salesMasterTable		= 'lp_sales_master';
	var $bedRoomDetails		= 'lp_bedroom_details';
	
	var $kigoMaster	        	= 'lp_kigo_data';  
	var $propertyAvailability   	= 'lp_property_availibility';
	var $EnquiryMaster		= 'lp_enquiry_master';
	var $customBooking 		= 'lp_custom_booking';
	var $propertyAvaialabilty	= 'lp_property_availibility';
	var $restrcitedDates		= 'lp_restricted_deal_date';
	
    public function __construct(){
        parent:: __construct();
	
        $this->load->model('model_rentals');
	$this->load->model('model_kigo');
    }
    
    /// INDIRA GIRI /////
    
    public function index()
    {
        
	        chk_login();
		$config['base_url'] 	= BACKEND_URL."property_rental/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('RENTALPROPERTY');
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
		$this->data['propertyMasterList']= $this->model_rentals->getPropertyList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_rental';	
		$this->data['base_url'] 	= BACKEND_URL."property_rental/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL."property_rental/index/0/1/";
		$this->data['add_url']      	= BACKEND_URL."property_rental/add_reatalproperty/";
		$this->data['status_link']      = BACKEND_URL."property_rental/{{STATUS_LINK}}/{{ID}}/";
		$this->data['edit_link']      	= BACKEND_URL."property_rental/edit_rentalproperty/{{ID}}/".$page."/";
		$this->data['edit_prices']     	= BACKEND_URL."property_rental/season_prices/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL."property_rental/delete_rentalproperty/{{ID}}/".$page."/";		
		$this->data['image_link']	= BACKEND_URL."property_rental/property_image/{{ID}}/".$page."/";		
		$this->data['batch_action_link']= BACKEND_URL."property_rental/property_batch_action/0/".$page."/";
		$this->data['price_link']	=BACKEND_URL.'property_rental/price/{{ID}}/'.$page; 
		
		
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='rentals/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	
	
    }
    
    public function add_reatalproperty()
    {
        chk_login();
	$property_id = 0;
		
	$page		= $this->uri->segment(4,0);	
        $this->data='';
	$page			= $this->uri->segment(4, 0);
	$this->data['page']	= $page;	
	$this->data['controller']	= "property_rental";
	$this->data['succmsg'] = '';
	$this->data['errmsg'] = '';
	
	//<!-------code-------->
	
		if($this->input->get_post('action') == 'Process')
		{ 
			//pr($_POST,0);
			$this->form_validation->set_rules('property_name', 'Property Name - Official', 'trim|required');
			$this->form_validation->set_rules('page_title', 'Display Title', 'trim|required');
			$this->form_validation->set_rules('optional_title', 'Optional Title', 'trim|required');
			$this->form_validation->set_rules('property_type', 'Property Type', 'trim|required');
			$this->form_validation->set_rules('seo_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
			$this->form_validation->set_rules('property_currency', 'Property Currency', 'trim|required');		
			
			$this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required');
			//$this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required');
			$this->form_validation->set_rules('sleeps', 'Sleeps', 'trim|required');
			//$this->form_validation->set_rules('property_description', 'Property Description', 'trim|required');
			
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else {
						 
				$propSlug	= $this->check_for_slug($this->input->get_post('page_title'),$property_id);
				
				$insertPropertyArr  =  array(
				'property_name'		=> addslashes(trim($this->input->get_post('property_name'))),
				'page_title'		=> addslashes(trim($this->input->get_post('page_title'))),
				'property_slug'		=> $propSlug,
				'property_ranking'	=> addslashes(trim($this->input->get_post('property_ranking'))),
				'property_type_id'  	=> addslashes(trim($this->input->get_post('property_type'))),
				'similar_property_tag'	=> addslashes(trim($this->input->get_post('similar_property_tag'))),
				'seo_title'		=> addslashes(trim($this->input->get_post('seo_title'))),
				'meta_description'	=> addslashes(trim($this->input->get_post('meta_description'))),
				'property_currency'	=> trim($this->input->get_post('property_currency')),
				'optional_title'	=> addslashes(trim($this->input->get_post('optional_title'))),
				'bedrooms'		=> addslashes(trim($this->input->get_post('bedrooms'))),
				'bedrooms_configuration'=> addslashes(trim($this->input->get_post('bedroom_configuration'))),
				'is_studio'		=> addslashes(trim($this->input->get_post('is_studio'))),
				'sleeps'    		=> addslashes(trim($this->input->get_post('sleeps'))),
				'bathrooms'		=> addslashes(trim($this->input->get_post('bathrooms'))),
				'bathrooms_configuration'=> addslashes(trim($this->input->get_post('bathroom_configuration'))),
				'property_description'	=> addslashes(trim($this->input->get_post('property_description'))),
				'special_offer_title'	=> addslashes(trim($this->input->get_post('special_offer_title'))),
				'special_offer_text'	=> addslashes(trim($this->input->get_post('special_offer_text'))),
				'latitude'		=> addslashes(trim($this->input->get_post('latitude'))),
				'longitude'		=> addslashes(trim($this->input->get_post('longitude'))), 
				'region_id'		=> addslashes(trim($this->input->get_post('region'))),
				'location_id'		=> addslashes(trim($this->input->get_post('location'))),
				'added_by'		=> $this->nsession->userdata('admin_id'),
				'record_type'    	=> "Rental",					
				'added_on'		=> date("Y-m-d H:i:s")
				);		
			
			
			//pr($insertPropertyArr);
			$affected_row  		= 	$this->model_basic->insertIntoTable($this->propertyMasterTable ,$insertPropertyArr);
			
			
			
			
			if($affected_row>0){
				
				$insertPropertySuitabilityArr = array(
					'property_id' 		=> $affected_row,
					'special_feature1'	=> addslashes(trim($this->input->get_post('special_feature1'))),
					'special_feature2'	=> addslashes(trim($this->input->get_post('special_feature2'))),
					'special_feature3'	=> addslashes(trim($this->input->get_post('special_feature3'))),
					'special_feature4'	=> addslashes(trim($this->input->get_post('special_feature4')))
				      );
				$this->model_basic->insertIntoTable($this->propertySuitability, $insertPropertySuitabilityArr);

				// Aminities update section
				if($this->input->get_post('rental_amenities')) {
						//pr($this->input->get_post('sales_amenities'));
						
					$amm		= $this->input->get_post('rental_amenities');
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
				// End Aminities update
				
				/**** Kigo ***/
				$on_kigo = addslashes(trim($this->input->get_post('on_kigo')));
				$kigo_id = '';
				if($on_kigo=='yes'){
					$kigo_id =  addslashes(trim($this->input->get_post('kigo_id')));
				}
				/**** end Kigo ***/
				
				$insertRentMasterArr =	array(
				'property_id'			=> $affected_row,				
				'security_deposite'		=> addslashes(trim($this->input->get_post('security_deposit'))),
				'cancellation_policy'		=> addslashes(trim($this->input->get_post('cancellation_policy'))),
				'amenities_id'			=> $amenities_id,
				'on_kigo'			=> $on_kigo,
				'kigo_id'			=> $kigo_id,
				'checkin'			=> addslashes(trim($this->input->get_post('checkin'))),
				'checkout'			=> addslashes(trim($this->input->get_post('checkout'))),
				'check_in_out_text'		=> addslashes(trim($this->input->get_post('check_in_out_text'))),
				'security_deposit_text'		=> addslashes(trim($this->input->get_post('security_deposit_text'))),
				'added_on'			=> date("Y-m-d H:i:s")
			      );						

				$retRentMaster   = $this->model_basic->insertIntoTable($this->rentMasterTable ,$insertRentMasterArr);
				
			//-------------------For Bedroom Entry----------------------------------------------------------
				
			$FieldNames['0']	    =	    "property_id";	
			$get_last_propId	=	$this->model_basic->getValues_conditions($this->propertyMasterTable ,$FieldNames,'','','property_id ','DESC',1);
			$bedroom		=	$this->input->get_post('bedroom');
			
			//pr($get_last_propId,1);
			
			if($bedroom && is_array($bedroom) ){
				foreach($bedroom as $k=>$b){
					
					if($b != '')
					{
						$bedroom  =  array(
							'property_id'		=> $get_last_propId[0]['property_id'],
							'bedroom_no'		=> $k+1,
							'description'		=> addslashes($b)			
							);
						$this->model_basic->insertIntoTable($this->bedRoomDetails ,$bedroom);
					}
				}
			}
			
				$this->nsession->set_userdata('succmsg', "Rental Property Added successfully.");
				
			}else{
				$this->nsession->set_userdata('errmsg', "Property could not be added. Please try again.");	
				
			}
			redirect(BACKEND_URL."property_rental/price/".$affected_row.'/'.$page.'/');
			//redirect(BACKEND_URL."property_rental/images/".$affected_row."/".$page."/");
			return false;
		
			}
			
			
			
		}
	
	//<!-------code--------->
	
	$this->data['arr_property_type']	= $this->model_basic->populateDropdown("property_type_id", "property_name", $this->proprtyTypeTable, "property_status = 'active'", 'property_name', 'ASC');
        $this->data['arr_region'] 		= $this->model_basic->populateDropdown("region_id", "region_name", "lp_region_master", "region_status = 'active'", 'region_name', 'ASC');
	$this->data['arr_location'] 		= $this->model_basic->populateDropdown("location_id", "location_name", "lp_location_master", "location_status = 'active'", 'location_name', 'ASC');
	$this->data['arr_prop_amenity']		= $this->model_rentals->get_property_amenities('Sales');
		
        
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['errmsg'] = $this->nsession->userdata('errmsg');
        $this->nsession->set_userdata('succmsg', "");
        $this->nsession->set_userdata('errmsg', "");
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
	//$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'details'),true);
	$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'details'),true);
        $this->elements['middle']='rentals/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        
	
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

		$update = $this->model_rentals->changeStatus($property_id, $new_status);
		
		if($update){
			echo $new_status;
			
		}
		
	}
	
	public function property_batch_action(){
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
		
		redirect(BACKEND_URL."property_rental/index/".$page);
		return true;
			
	}
	
	public function deletebatch($pagearray) {
		chk_login();
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
	
	public function batchstatus($status, $idArray) {
		chk_login();
		if($status == '')
			return false;

		$updArr		= 'status';
		$return 	= $this->model_basic->changeStatus($this->propertyMasterTable, $idArray, $updArr, $status, 'property_id');		
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select at least one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected property status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected property status Inactivated successfully.");
		}		
		return true;
	}
	
	
	
	public function delete_rentalproperty(){		
		chk_login();
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
		
		
		redirect(BACKEND_URL.'property_rental/');
			
		
	}
	
	public function delete_image($property_id)
	{
		chk_login();
		//$property_id = $this->uri->segment(3);
		$Condition 		= "property_id = '".$property_id."' ";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition);
		//pr($arr_property_image);
		/*** Delete Image from Server ***/
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
	}
	
	public function ajax_getLocation_of_region()
	
    {
		$region_id = $this->input->post('region');
		$option = '';
		$records = $this->model_property_sales->getLocation_of_region($region_id);
		if(is_array($records)){
			foreach($records as $record){
				$option .= '<option value="'.$record['location_id'].'">'.$record['location_name'].'</option>';
			}
		}
		echo $option;
    }
	
	public function edit_rentalproperty()
	{
	    
	    chk_login();
		
	    $this->data='';
	    $property_id = $this->uri->segment(3);
	    
	    $this->data['property_id'] = $this->uri->segment(3);
	    
	    $page		= $this->uri->segment(4,0);		
	    $this->data['page']  		=  $page;
	    $this->data['succmsg']='';
	    $this->data['errmsg'] ='';
	    
	    		if($this->input->get_post('action') == 'Process')
		{ 
			//pr($_POST);
			$this->form_validation->set_rules('property_name', 'Property Name - Official', 'trim|required');
			$this->form_validation->set_rules('page_title', 'Display Title', 'trim|required');
			$this->form_validation->set_rules('optional_title', 'Optional Title', 'trim|required');
			$this->form_validation->set_rules('property_type', 'Property Type', 'trim|required');
			$this->form_validation->set_rules('seo_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
			
			
			$this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required');
			//$this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required');
			$this->form_validation->set_rules('sleeps', 'Sleeps', 'trim|required');
			//$this->form_validation->set_rules('property_description', 'Property Description', 'trim|required');
			
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				//die("validation error");
			}
			else {
				
				 
				$propSlug	= $this->check_for_slug($this->input->get_post('page_title'),$property_id);
				
				$updateArr  =  array(
				'property_name'			=> addslashes(trim($this->input->get_post('property_name'))),
				'page_title'			=> addslashes(trim($this->input->get_post('page_title'))),
				'property_slug'			=> $propSlug,
				'property_ranking'		=> addslashes(trim($this->input->get_post('property_ranking'))),
				'property_type_id'  		=> addslashes(trim($this->input->get_post('property_type'))),
				'similar_property_tag'		=> addslashes(trim($this->input->get_post('similar_property_tag'))),
				'seo_title'			=> addslashes(trim($this->input->get_post('seo_title'))),
				'meta_description'		=> addslashes(trim($this->input->get_post('meta_description'))),
				'optional_title'		=> addslashes(trim($this->input->get_post('optional_title'))),
				'bedrooms'			=> addslashes(trim($this->input->get_post('bedrooms'))),
				'bedrooms_configuration'	=> addslashes(trim($this->input->get_post('bedroom_configuration'))),
				'is_studio'			=> addslashes(trim($this->input->get_post('is_studio'))),
				'sleeps'    			=> addslashes(trim($this->input->get_post('sleeps'))),
				'bathrooms'			=> addslashes(trim($this->input->get_post('bathrooms'))),
				'bathrooms_configuration'	=> addslashes(trim($this->input->get_post('bathroom_configuration'))),
				'property_description'		=> addslashes(trim($this->input->get_post('property_description'))),
				'special_offer_title'		=> addslashes(trim($this->input->get_post('special_offer_title'))),
				'special_offer_text'		=> addslashes(trim($this->input->get_post('special_offer_text'))),
				'latitude'			=> addslashes(trim($this->input->get_post('latitude'))),
				'longitude'			=> addslashes(trim($this->input->get_post('longitude'))), 
				'region_id'			=> addslashes(trim($this->input->get_post('region'))),
				'location_id'			=> addslashes(trim($this->input->get_post('location'))),
				'added_by'			=> $this->nsession->userdata('admin_id'),
				'record_type'    		=> "Rental",					
				'added_on'			=> date("Y-m-d H:i:s")
				);
				
			$idArr  = array('property_id' => $property_id);
			
			$update = $this->model_basic->updateIntoTable($this->propertyMasterTable, $idArr, $updateArr);
			
			$insertPropertySuitabilityArr = array(
				'special_feature1'	=> addslashes(trim($this->input->get_post('special_feature1'))),
				'special_feature2'	=> addslashes(trim($this->input->get_post('special_feature2'))),
				'special_feature3'	=> addslashes(trim($this->input->get_post('special_feature3'))),
				'special_feature4'	=> addslashes(trim($this->input->get_post('special_feature4')))
			      );
			
			$update2 = $this->model_basic->updateIntoTable($this->propertySuitability, $idArr, $insertPropertySuitabilityArr);
			
			
			// Aminities update section
			if($this->input->get_post('rental_amenities')) {
			    
			    
					//pr($this->input->get_post('sales_amenities'));
					
				$amm		= $this->input->get_post('rental_amenities');
				
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
			
			// End Aminities update
			
			/*** Kigo ***/
			$on_kigo = addslashes(trim($this->input->get_post('on_kigo')));
			$kigo_id = '';
			if($on_kigo=='yes'){
				$kigo_id =  addslashes(trim($this->input->get_post('kigo_id')));
			}
			/*** End kigo ***/
			$updateRentMasterArr =	array(				
			'security_deposite'		=> addslashes(trim($this->input->get_post('security_deposit'))),
			'cancellation_policy'		=> addslashes(trim($this->input->get_post('cancellation_policy'))),
			'amenities_id'			=> $amenities_id,
			'on_kigo'			=> $on_kigo,
			'kigo_id'			=> $kigo_id,
			'checkin'			=> addslashes(trim($this->input->get_post('checkin'))),
			'checkout'			=> addslashes(trim($this->input->get_post('checkout'))),
			'check_in_out_text'		=> addslashes(trim($this->input->get_post('check_in_out_text'))),
			'security_deposit_text'		=> addslashes(trim($this->input->get_post('security_deposit_text'))),
			'added_on'			=> date("Y-m-d H:i:s")
			 );						
			
			
			$update3 = $this->model_basic->updateIntoTable($this->rentMasterTable, $idArr, $updateRentMasterArr);
			
			//-------------------For Bedroom Entry----------------------------------------------------------
				
			$bedroom		=	$this->input->get_post('bedroom');
			
			$this->model_basic->deleteData($this->bedRoomDetails ," `property_id` = '".$property_id."'");
			
			if($bedroom && is_array($bedroom) ){
				foreach($bedroom as $k=>$b){
					
					if($b != '')
					{
						$bedroom  =  array(
							'property_id'		=> $property_id,
							'bedroom_no'		=> $k+1,
							'description'		=> addslashes($b)			
							);
						$this->model_basic->insertIntoTable($this->bedRoomDetails ,$bedroom);
					}
				}
			}
			
			//----------------------------------------------------------------------------------------------		
			
			$this->nsession->set_userdata('succmsg', "Rental Property updated successfully.");
				
				
			redirect(BACKEND_URL."property_rental/price/".$property_id.'/'.$page.'/');
			return false;
		
			}
			
			
			
		}
	    
	    //$record = $this->model_basic->getValues_conditions('lp_property_master', array('property_slug','status'), '', 'property_id='.$property_id, '', '', 0) ;
		
	   
	    $this->data['arr_property_type']	= $this->model_basic->populateDropdown("property_type_id", "property_name", $this->proprtyTypeTable, "property_status = 'active'", 'property_name', 'ASC');
	    $this->data['arr_region'] 		= $this->model_basic->populateDropdown("region_id", "region_name", "lp_region_master", "region_status = 'active'", 'region_name', 'ASC');
	    $this->data['arr_location'] 	= $this->model_basic->populateDropdown("location_id", "location_name", "lp_location_master", "location_status = 'active'", 'location_name', 'ASC');
	    $this->data['arr_prop_amenity']	= $this->model_rentals->get_property_amenities('Sales');
	    $this->data['property_details']	= $this->model_rentals->get_single($property_id);		
	    $this->data['bedroom_details']	= $this->model_basic->getValues_conditions($this->bedRoomDetails ,'',''," `property_id` = '".$property_id."'",'bedroom_no','','');
		
		
	    
	    
	    
	    $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	    $this->data['errmsg'] = $this->nsession->userdata('errmsg');
	    $this->nsession->set_userdata('succmsg', "");
	    $this->nsession->set_userdata('errmsg', "");
	    
	    $this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'details'),true);
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    
	    $this->elements['middle']='rentals/edit';			
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	    
	    
	}
	
	public function contact()
	{
	    	chk_login();
		$property_id		= $this->uri->segment(3,0);
		$page		= $this->uri->segment(4,0);
		
		$conditions	= "property_id = '".$property_id."'";
		$arr_property	= $this->model_basic->getValues_conditions($this->propertyMasterTable, '*', '', $conditions);
		
		$arr_property_rent	= $this->model_basic->getValues_conditions($this->rentMasterTable, '*', '', $conditions);
		$this->data['arr_property'] = $arr_property[0];
		$this->data['arr_property_rent'] = $arr_property_rent[0];
		if($this->input->post()){
			
				$owner_name	 = stripslashes( trim( $this->input->post('owner_name')));
				$company_name	 = stripslashes( trim( $this->input->post('owner_company')));
				$owner_website	 = stripslashes( trim( $this->input->post('owner_website')));
				$contact_number  = stripslashes( trim( $this->input->post('contact_number')));
				$owner_email	 = stripslashes( trim( $this->input->post('owner_email')));
				$notes		 = stripslashes( trim( $this->input->post('note')));
				
				$owner_update_arr = array(
							  "property_manager_name"	=> $owner_name,
							  "manager_contact_number1" 	=> $contact_number,
							  "manager_email" 		=> $owner_email,
							  "property_company_name"	=> $company_name,
							  "property_website_address"	=> $owner_website
							  
							  );
				$idArr = array(
						"property_id"	=> $property_id
						);
				
				$note_update_arr = array(
							  "notes"	=> $notes,
							  );
				
				$owner_update = $this->model_basic->updateIntoTable($this->propertyMasterTable ,$idArr, $owner_update_arr);
				$note_update = $this->model_basic->updateIntoTable($this->rentMasterTable ,$idArr, $note_update_arr);
				
				$this->nsession->set_userdata('succmsg', "Contact details updated successfully.");
				
				redirect(BACKEND_URL.'property_rental/edit_map_location/'.$property_id.'/'.$page);
			
		}

		
		/******** tabs data ********/
		//$record = $this->model_basic->getValues_conditions('lp_property_master', array('property_slug','status'), '', 'property_id='.$property_id, '', '', 0) ;
		
		
		/******** end tabs data ********/
		
		$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'contact'),true);
	
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		/******** end tabs data ********/
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='rentals/edit_contact';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_map_location()
	{
	    
	        chk_login();
		$property_id				= 	$this->uri->segment(3,0);
		$this->data['property_id'] 		= 	$property_id;
		$page					= 	$this->uri->segment(4,0);
		$final_map_location	    		=	array();
				
		$default_map_location	=	$this->model_basic->getValues_conditions('lp_property_map_location', '*', '', "",'location_type');		
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
	
		//pr($location_type,0);pr($final_map_location,1);
		if($this->input->get_post('action') == 'Process'){
			
			$prev_map_location_id	 = $this->input->post('map_location_id');
			
			if(is_array($prev_map_location_id))
			{
				$this->form_validation->set_rules('map_location_id[]', 'Location Name', 'trim|required');
				$this->form_validation->set_rules('latitude[]', 'Latitude', 'trim|required');
				$this->form_validation->set_rules('longitude[]', 'Longitude', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					//redirect(BACKEND_URL.'rentals/edit_map_location/'.$property_id.'/'.$page);
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
					$this->nsession->set_userdata('succmsg', "Map Location updated successfully");					
					redirect(BACKEND_URL.'property_rental/calendar_view/'.$property_id.'/'.$page);
				}
			}
			else
			{
				$delete_where	= " property_id = '".$property_id."' ";
				$d1 = $this->model_basic->deleteData('lp_override_map_location', $delete_where);
				$this->nsession->set_userdata('succmsg', "Map Location updated successfully");					
				redirect(BACKEND_URL.'property_rental/calendar_view/'.$property_id.'/'.$page);
			}
		}

		$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'edit_map_location'),true);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='rentals/edit_map';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	    
	}
	
	/// INDIRA GIRI /////
	
	/// TONMOY NANDY  ////
	
	public function payment()
	{
		chk_login();
                
		$property_id	            = $this->uri->segment(3,0);
		$page		            = $this->uri->segment(4,0);
		
                $conditions	            = "property_id = '".$property_id."'";
                
		$arr_property	            = $this->model_basic->getValues_conditions($this->propertyMasterTable, '*', '', $conditions);  // PROPERTY RECORD
		
                $arr_property_rent          = $this->model_basic->getValues_conditions($this->rentMasterTable, '*', '', $conditions); // RENTAL RECORD
                if(is_array($arr_property)){
                    $arr_property=$arr_property[0];
                }
                if(is_array($arr_property_rent)){
                    $arr_property_rent=$arr_property_rent[0];
                }
                $this->data['arr_property'] = $arr_property;
		$this->data['arr_property_rent'] = $arr_property_rent;
		$this->data['action_url']=BACKEND_URL.$this->router->class."/payment/".$property_id.'/'.$page;
                $this->data['redirect_url'] =BACKEND_URL.$this->router->class."/payment/".$property_id.'/'.$page ;
                $this->data['next_url'] =BACKEND_URL.$this->router->class."/contact/".$property_id.'/'.$page ;
                $this->data['previous_url'] =BACKEND_URL.$this->router->class."/ical/".$property_id.'/'.$page ;
                $this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'booking'),true);
		
		if($this->input->get_post('action') == 'Process'){
			
                        $deposit_percent	 = stripslashes( trim ( $this->input->post( 'deposit_percent')));
                        $deposit_min_days  	 = stripslashes( trim ( $this->input->post( 'deposit_min_days')));
                        $final_payment_days	 = stripslashes( trim ( $this->input->post( 'final_payment_days')));
                        $booking_status	 	 = stripslashes( trim ( $this->input->post( 'booking_status')));
                        
                        $payment_update_arr = array(
                                                  "deposit_percent"		  => $deposit_percent,
                                                  "deposit_min_days" 		  => $deposit_min_days,
                                                  "final_p_days_before_arrival"   => $final_payment_days,
                                                  "booking_status"		  => $booking_status
                                                  );
                      
                        $idArr = array(
                                        "property_id"	=> $property_id
                                        );
                        
				
				
			$note_update = $this->model_basic->updateIntoTable($this->rentMasterTable ,$idArr, $payment_update_arr);
                        
			$this->nsession->set_userdata('succmsg', "Rental Booking is updated");

                         redirect($this->data['next_url']);
                       
                          
                          //return false;
                        
			
		}

		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->data['errmsg'] = $this->nsession->userdata('errmsg');
                $this->nsession->set_userdata('succmsg', "");
                $this->nsession->set_userdata('errmsg', "");
                
                $this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
                
                $this->elements['middle']='rentals/edit_payment';			
                $this->elements_data['middle'] = $this->data;			    
                $this->layout->setLayout('layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function price(){
		chk_login();
		$property_id	            = $this->uri->segment(3,0);
		$page		            = $this->uri->segment(4,0);
		$year			    = $this->uri->segment(5,0);
		$this->data['errmsg']='';
		$this->data['year']			= $year;
		$this->data['property_id']		= $property_id;
		$this->data['action_url']=BACKEND_URL.$this->router->class."/price/".$property_id.'/'.$page;
                $this->data['next_url'] =BACKEND_URL.$this->router->class."/images/".$property_id.'/'.$page ;
                $this->data['previous_url'] =BACKEND_URL.$this->router->class."/edit_rentalproperty/".$property_id.'/'.$page ;
		if(empty($year)){
			$year	= $this->model_rentals->getPropertySeasonFirstYear($property_id);
		}
		
		
		if($this->input->post("action")=="Process")		{
			//pr($_POST);
			$this->form_validation->set_rules('property_currency', 'Property Currency', 'trim|required');
			//$this->form_validation->set_rules('season_start_date', 'Start Date', 'trim|required');
			//$this->form_validation->set_rules('season_end_date', 'End Date', 'trim|required');
			if ($this->form_validation->run() == true){
			
				$property_currency		= $this->input->get_post('property_currency');
				$season_start_date		= $this->input->get_post('season_start_date');
				$season_end_date		= $this->input->get_post('season_end_date');
				$minimum_rental_days		= $this->input->get_post('minimum_rental_days');
				$season_daily			= $this->input->get_post('season_daily');
				$season_weekly			= $this->input->get_post('season_weekly');
				$season_monthly			= $this->input->get_post('season_monthly');
				$total_season_count		= $this->input->get_post('total_season_count');
				$isDefault			= $this->input->get_post('is_default_hidden');
				$disc_weekly			= $this->input->get_post('disc_weekly');
				$disc_monthly			= $this->input->get_post('disc_monthly');
				
				if( !isset($isDefault) )
					$isDefault = NULL;
				
				// date gap checking
				$err_msg = '';
				//pr($season_end_date);
				$updateArr  =  array(				
					'property_currency'		=> trim($this->input->get_post('property_currency'))
					);
					
				$idArr  = array('property_id' => $property_id);
				
				$update = $this->model_basic->updateIntoTable($this->propertyMasterTable, $idArr, $updateArr);
				
				$delete_where = "property_id = '".$property_id."'";
				$this->model_basic->deleteData($this->seasonPriceMaster, $delete_where);
				$ret = array();	
				foreach($season_end_date as $index=>$val){
					
					foreach($season_end_date[$index] as $key => $start){
						
						$startdate = explode('/',$season_start_date[$index][$key]);
						$start_time = mktime(0,0,0,$startdate[1],$startdate[0],$startdate[2]);
						$strt_date = date('d/m/Y', $start_time);
						if(isset($next_start_time) && $start_time != $next_start_time ){
							$err_msg .= 'Error on your Seasion ' . ($key+1) . ' start date: '.$strt_date.', Must be '.$next_start_date.'<br>';
						}
						$end_arr = explode('/', $season_end_date[$index][$key]);
						$date = mktime(0,0,0,$end_arr[1],$end_arr[0],$end_arr[2]);
						$next_start_time =  strtotime("+1 day", $date);
						$next_start_date = date('d/m/Y', strtotime("+1 day", $date));
						
					}
					//if($err_msg){
					//	//echo $err_msg;
					//	$this->session->set_userdata('errmsg', $err_msg);
					//	redirect(BACKEND_URL."rentals/season_prices/".$property_id."/".$page."/");
					//}
					// end date gap checking
					
					
					
					
					
					if(isset($season_start_date) && !empty($season_start_date[$index]))
						$temp_season_count = count($season_start_date[$index]);
					else
						$temp_season_count = 0;
					
					if($temp_season_count > 0)
					{
						$j = 1;
						for($i=0; $i<$temp_season_count; $i++)
						{
							
							$startdate = explode('/',$season_start_date[$index][$i]);
							$start = mktime(0,0,0,$startdate[1],$startdate[0],$startdate[2]);
							
							$enddate = explode('/',$season_end_date[$index][$i]);
							$end = mktime(0,0,0,$enddate[1],$enddate[0],$enddate[2]);
							
							$property_season_price  = array(
									'property_id'		=> $property_id ,
									'season_start_date' 	=> date('Y-m-d', $start) ,
									'season_end_date' 	=> date('Y-m-d', $end) ,
									'minimum_rental_days'	=> $minimum_rental_days[$index][$i] ,
									'daily_price'		=> addslashes(trim($season_daily[$index][$i])),
									'weekly_price' 		=> addslashes(trim($season_weekly[$index][$i])),
									'monthly_price'		=> addslashes(trim($season_monthly[$index][$i])),
									'weekly_disc'		=> addslashes(trim($disc_weekly[$index][$i])),
									'monthly_disc'		=> addslashes(trim($disc_monthly[$index][$i])),
									'isDefault'		=> $isDefault[$index][$i],
									'updated_on'		=> date("Y-m-d H:i:s")
									);
							//pr($property_season_price,0);
							$ret[] = $this->model_basic->insertIntoTable($this->seasonPriceMaster ,$property_season_price);
							
						}
						
					}
				}
			//	 die;exit;
				if($ret && !empty($ret) ){
					$this->nsession->set_userdata('succmsg', "Rental Prices  is updated successfully.");
				} else{
					$this->nsession->set_userdata('errmsg', "Unable to add  Prices for Rental Property.");
				}
				if($this->input->post('submit') == 'Previous'){
					redirect($this->data['previous_url']);
					return true;
				}else if($this->input->post('submit') == 'Next'){
					redirect($this->data['next_url']);
					return true;
				}
			}else{
				$this->nsession->set_userdata("errmsg",trim(validation_errors()));
				redirect(BACKEND_URL."property_rental/price/".$property_id.'/'.$page);
					return true;
				
			}
		}

			
		// Get all the season years
		$this->data['season_year_list']  	= $this->model_rentals->getPropertySeasonAllYears($property_id);
		$this->data['season_price_list']  	= $this->model_rentals->getPropertySeasonYears($property_id);
		
		//$this->data['season_price_list']  = $this->model_basic->getValues_conditions($this->seasonPriceMaster, "*", "", $season_condition, "price_id", "ASC");
		$this->data['property_details']		= $this->model_rentals->get_single($property_id);
		
		//pr($this->data);
		 /******** tabs data ********/
		$record = $this->model_basic->getValues_conditions('lp_property_master', array('property_slug','status'), '', 'property_id='.$property_id, '', '', 0) ;
		
		
		
		
		
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->data['errmsg'] = $this->nsession->userdata('errmsg');
                $this->nsession->set_userdata('succmsg', "");
                $this->nsession->set_userdata('errmsg', "");
                
                $this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
                
		
		$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'property price'),true);
                $this->elements['middle']='rentals/price';			
                $this->elements_data['middle'] = $this->data;			    
                $this->layout->setLayout('layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	
	public function get_season(){
		
		$property_id 	= $this->input->get_post('pid');
		$page		= $this->uri->segment(4,0);
		$this->data['page']  		=  $page;
		
		if($property_id < 1 || $property_id == ''){
			$this->nsession->set_userdata('succmsg', "Property  additional information updated successfully");
			redirect(BACKEND_URL."property_rental/index/".$page);
			return true;
		}
		$this->data['property_id']  	=  $property_id;
		$year = $this->input->get_post('year');
		
		$this->data['errmsg']		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg', "");
		$this->data['edit_link']      	= BACKEND_URL."property_rental/edit_property/".$property_id."/".$page."/";
		$this->data['edit_prices']     	= BACKEND_URL."property_rental/season_prices_new/".$property_id."/".$page."/";
		$this->data['image_link']	= BACKEND_URL."property_rental/property_image/".$property_id."/".$page."/";

		$this->data['year']			= $year;
		// Get all the season years
		$this->data['season_year_list']  	= $this->model_rentals->getPropertySeasonAllYears($property_id);
		$this->data['season_price_list']  	= $this->model_rentals->getPropertySeasonYears($property_id,$year);
		$this->data['season_record_count']  	= $this->model_rentals->getPropertySeasonCount($property_id);
		$this->data['property_details']		= $this->model_rentals->get_single($property_id);
		
		echo $html = $this->load->view('rentals/ajax_season_add', $this->data, TRUE);
		exit;
		
	}
	
	
	
	public function calendar_view(){
		chk_login();
		$errmsg		= '';
		$property_id 	= $this->uri->segment(3);
		$page		= $this->uri->segment(4,0);		
		$this->data['page']  		=  $page;
		$this->data['action_url']=BACKEND_URL.$this->router->class."/calendar_view/".$property_id.'/'.$page;
		$this->data['next_url'] =BACKEND_URL.$this->router->class."/deal/".$property_id.'/'.$page;
                $this->data['previous_url'] =BACKEND_URL.$this->router->class."/edit_map_location/".$property_id.'/'.$page ;
	
		if($property_id < 1 || $property_id == ''){
			$this->nsession->set_userdata('succmsg', "Property  additional information updated successfully");
			redirect(BACKEND_URL."rentals/index/".$page);
			return true;
		}
		$this->data['property_id']  	=  $property_id;
		$unavailableDates = '';
		$onKigo	= $this->model_basic->getValues_conditions($this->propertyAvaialabilty, '', '', $Condition='property_id = '.$this->data['property_id'], 'avail_date_format', 'ASC', $Limit=0);
				//pr($onKigo);
				if($onKigo){
					//pr($onKigo);
					foreach($onKigo as $kigo){
						$darr = explode('-',$kigo['avail_date_format']);
						//$dates[] = "'".$darr[2].'/'.$darr[1].'/'.$darr[0]."'"; 
						$dates[] = "'".date('m/d/Y', ($kigo['avail_timestamp_format']+86400) )."'";
					}
					//pr($dates);
					$unavailableDates = implode(",",$dates);
				}
				//}
				else{
					$unavailableDates = '';
				}
				
				$this->data['unavailableDates'] = $unavailableDates;
		
		$this->data['dates']=$this->ajax_property_availibility($property_id);
		/******** tabs data ********/
		$record = $this->model_basic->getValues_conditions('lp_property_master', array('property_slug','status'), '', 'property_id='.$property_id, '', '', 0) ;
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->data['errmsg'] = $this->nsession->userdata('errmsg');
                $this->nsession->set_userdata('succmsg', "");
                $this->nsession->set_userdata('errmsg', "");
		$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'calendar_view'),true);
		$this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
		$this->elements['middle']='rentals/calendar_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}

	
	public function ajax_property_availibility($property_id){
		$result	= $this->model_basic->get_property_availibility_dates($property_id) ;		
		//echo json_encode($result);
		//exit;
		$result=json_encode($result);
		return $result;
	}
	
	/// TONMOY NANDY ///
	
	/// SAMIM ALMAMUN /////
	
	
	public function images(){
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
	
	$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'property image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='rentals/edit_property_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    
    
   /**************** Property image misc functions ****************************/
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
	
    /**************** End Property image misc functions ****************************/
    
    
    /************************* Avaibalability *************************************/
    public function ical(){ 
           chk_login();
            $property_id =	$this->uri->segment(3,0);
            $page	     =	$this->uri->segment(4,0);
            $icalurl =  $this->input->post('icalurl') ;
            
            if($this->input->get_post('action') == 'Process'){
                  // pr($_POST);
                    $sync_from = addslashes( $this->input->post('syn'));
                    $status = addslashes( $this->input->post('status'));
                    $kigo_id = addslashes( $this->input->post('kigo_id'));
                    
                    //if(isset($_FILES['icalfile']) && $_FILES['icalfile']['name'] !='' || $this->input->post('icalurl') != '' )
                    if($this->input->post('icalurl') != '' &&   $sync_from != "KA" && $sync_from != "NA")
                    {
                            $upload_dir = FILE_UPLOAD_ABSOLUTE_PATH.'temp/';
                            $this->load->library('ical');
                            $error_msg = '';
                            
                            
                            // For the url
                                    
                            $temp_name = time();
                            $content	= '';
                            $content = @file_get_contents($icalurl);
                            $insert = file_put_contents($upload_dir.$temp_name.".ics", $content);
                            if( $content && $insert){
                            $this->ical->read($upload_dir.$temp_name.".ics" );
                            $result = $this->ical->get_event_array();
                            
                            unlink($upload_dir.$temp_name.".ics"); // del last file
                            }else{
                                    
                                    $error_msg = "Invalid url or System can't get ics file. Try again";
                            }
                            //pr($result);
                                    
                            
                            
                            // update database
                            if(isset($result) && count($result)>0){
                                    
                                    // delete old data
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    
                                    foreach($result  as $cal){
                                            $dtstart = $dtend = $summary = $description = '' ;
                                            if(isset($cal['DTSTART'])){ $dtstart = $cal['DTSTART']; }
                                            if(isset($cal['DTEND'])){ $dtend = $cal['DTEND']; }
                                            if(isset($cal['SUMMARY'])){ $summary = mysql_real_escape_string($cal['SUMMARY']); }
                                            if(isset($cal['SUMMARY;VALUE=TEXT'])){ $summary = mysql_real_escape_string($cal['SUMMARY;VALUE=TEXT']); }
                                            if(isset($cal['DESCRIPTION'])){ $description = mysql_real_escape_string( $cal['DESCRIPTION']); }
                                            
                                            $insertArr  = array(
                                                                'ical_property_id'  => $property_id,
                                                                'ical_dtstart'      => $dtstart,
                                                                'ical_dtend' 	=> $dtend,
                                                                'ical_summary'	=> $summary,
                                                                'ical_description'	=> $description,
                                                                //'ical_from'		=> $sync_from,
                                                                // 'ical_url'		=> mysql_real_escape_string($icalurl),
                                                                );
                                            $this->model_basic->insertIntoTable('lp_ical_master',$insertArr); // ical master
                                            $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>$sync_from,'on_kigo'=>'no','ical_url'=>mysql_real_escape_string($icalurl)));
                                            // Availability
                                            $datetime1 = new DateTime($dtstart);
                                            $datetime2 = new DateTime($dtend);
                                            $interval = $datetime1->diff($datetime2);
                                            $tot_days = $interval->days;
                                            
                                            for($i = 0; $i < $tot_days; $i++){
                                                    $avl_date  = $datetime1->format('Y-m-d');
                                                    $timestamp = $datetime1->format('U');
                                                    $insertArr  = array(
                                                                'property_id'  		=> $property_id,
                                                                'avail_date_format'         => $avl_date,
                                                                'avail_timestamp_format' 	=> $timestamp,
                                                                'avail_status'		=> $sync_from,
                                                                'date_added'		=>date('Y-m-d'),
                                                                );
                                                    $this->model_basic->insertIntoTable('lp_property_availibility',$insertArr); // ical avaibality
                                                    $datetime1->modify('+1 day');
                                            }
                                    }
                                    $this->reservation();
                                    
                            }//result block
                            
                            /// set success and error msg
                            //$this->nsession->set_userdata('succmsg', "Successfully Imported");
                            if(empty($error_msg)){
                                    $this->nsession->set_userdata('succmsg', "Successfully Import & Updated");
                                    redirect(BACKEND_URL.'property_rental/payment/'.$property_id.'/'.$page);
                                    return true;  
                            }else{
                                    $this->nsession->set_userdata('errmsg', $error_msg);
                            }
    
                    }
                    else
                    {
                            if($sync_from=="NA" && $property_id){
                                    $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>'NA','on_kigo'=>'no'));
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    $this->nsession->set_userdata('succmsg', "Availability Updated Successfully");
				    
                                    $this->reservation();
                                    redirect(BACKEND_URL.'property_rental/payment/'.$property_id.'/'.$page);
                                    return true;                            
                            }elseif($sync_from == "KA" && $property_id && $kigo_id){
                                    $this->model_basic->updateIntoTable($this->rentMasterTable, array('property_id'=>$property_id), array('manage_by'=>'KA','kigo_id'=>$kigo_id,'on_kigo'=>'yes'));
                                    $this->model_basic->deleteData('lp_ical_master', 'ical_property_id='.$property_id);
                                    $this->model_basic->deleteData('lp_property_availibility', 'property_id='.$property_id);
                                    $this->reservation();
                                    $this->nsession->set_userdata('succmsg', "Successfully Updated");
                                   // redirect(BACKEND_URL.'property_rental/ical/'.$property_id.'/'.$page);
				   redirect(BACKEND_URL.'property_rental/payment/'.$property_id.'/'.$page);
                                    return true;
                                    
                            }else{ 
                                    $this->nsession->set_userdata('errmsg', "Please Enter ical url/id");
                            }
                    }	
            }

            $manage_record = $this->model_basic->getValues_conditions($this->rentMasterTable, array('manage_by','kigo_id','ical_url'), '', 'property_id='.$property_id, '', '', 0);
            $this->data['manage_by']      =$manage_record[0]['manage_by'];
            $this->data['kigo_id'] 	  = $manage_record[0]['kigo_id'];
            $this->data['ical_url'] 	  = $manage_record[0]['ical_url'];
            
            /******** tabs data ********/
           $this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'availability'),true);
            /******** end tabs data ********/
            
            
            /// Set succ/error msg
            $this->data['succmsg'] = $this->nsession->userdata('succmsg');
            $this->data['errmsg'] = $this->nsession->userdata('errmsg');
            $this->nsession->set_userdata('succmsg', "");
            $this->nsession->set_userdata('errmsg', "");
    
            $this->templatelayout->get_topbar();
            $this->templatelayout->get_leftmenu();
            $this->templatelayout->get_footer();
                                                    
            $this->elements['middle']='rentals/ical_import';			
            $this->elements_data['middle'] = $this->data;			    
            $this->layout->setLayout('layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    /// Kigo  update
	public function reservation(){
		error_reporting(0);
		
		$username = 'livephuket';
		$password = 'qqoeUgWdW';
		
		$kigoProp = array();
		$this->model_kigo->truncateKigo( $this->kigoMaster );
		$kigoProp = $this->model_kigo->get_kigo_property();

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://app.kigo.net/api/ra/v1/diffPropertyCalendarReservations');
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, true );
		$queryString = array("DIFF_ID" => null);
		$queryString = json_encode($queryString);
		$request_headers    = array();
		$request_headers[]  = 'Host: app.kigo.net';
		$request_headers[]  = 'Content-Type: application/json';
		
		
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $request_headers);
		//curl_setopt( $ch, CURLOPT_HTTPHEADER, true );
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $queryString);
		//$info = curl_getinfo($ch);        
		$response = curl_exec( $ch );        
		curl_close( $ch );
		$response = json_decode($response);
		//pr($response);
		$insertArr = array();
		if($response->API_REPLY->RES_LIST && is_array($response->API_REPLY->RES_LIST) ){
		    foreach($response->API_REPLY->RES_LIST as $res){
			if (count($kigoProp) && array_key_exists( $res->PROP_ID , $kigoProp )) {
			    $insertArr = array(
						'property_id' => $kigoProp[$res->PROP_ID]['property_id'] ,
						'RES_ID' =>  $res->RES_ID,
						'PROP_ID' =>  $res->PROP_ID,
						'RES_STATUS' =>  $res->RES_STATUS,
						'RES_CHECK_IN' =>  $res->RES_CHECK_IN,
						'RES_CHECK_OUT' => $res->RES_CHECK_OUT ,
						'RES_IS_FOR' => $res->RES_IS_FOR
					     );
			    $res = $this->model_basic->insertIntoTable($this->kigoMaster,$insertArr);
			}
			else{
			    $insertArr = array(
						'property_id' => 0,
						'RES_ID' =>  $res->RES_ID,
						'PROP_ID' =>  $res->PROP_ID,
						'RES_STATUS' =>  $res->RES_STATUS,
						'RES_CHECK_IN' =>  $res->RES_CHECK_IN,
						'RES_CHECK_OUT' => $res->RES_CHECK_OUT ,
						'RES_IS_FOR' => $res->RES_IS_FOR
					     );
			    $res = $this->model_basic->insertIntoTable($this->kigoMaster,$insertArr);
			}
		    }
		   
		    $this->updatePropertyAvailability();
		    
		}
        
	}
    
    
	private function updatePropertyAvailability(){
	$this->model_kigo->deleteDataKigo();
        $booked = $this->model_kigo->getBookedProperty();
        $i=0;
	if(is_array($booked) && count($booked)){
        foreach($booked as $b){
                $begin = new DateTime( $b['RES_CHECK_IN'] );
                $end = new DateTime(  $b['RES_CHECK_OUT'] );                
                $interval = DateInterval::createFromDateString('1 day');                
                //$end->add($interval);
                
                $period = new DatePeriod($begin, $interval, $end);
                $insertArr = array();
                foreach ( $period as $dt ){
                    $date = new DateTime( $dt->format( "Y-m-d" ) );
                    $timestamp =  $date->getTimestamp();
                    
                    $insertArr = array(
                                        'property_id' => $b['property_id'],
                                        'KIGO_RES_ID' =>  $b['RES_ID'],
                                        'KIGO_PROP_ID' =>  $b['PROP_ID'],
                                        'avail_date_format' =>  $dt->format( "Y-m-d" ),
                                        'avail_timestamp_format' => $timestamp ,
                                        'avail_status' => 'KA',
                                        'date_added' => date('Y-m-d H:i:s')
                                     );
                    $res = $this->model_basic->insertIntoTable($this->propertyAvailability,$insertArr);
                    $i ++;
                }
                
        }
	}
    }
    
    /************************* End Avaibalability *************************************/
    
    /// SAMIM ALMAMUN /////
    
    
    
	public function deal()
	{
		chk_login();
		$property_id	= $this->uri->segment(3,0);
		$page		= $this->uri->segment(4,0);
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg', '');
		
		/*** Get Record of property ***/
		$conditions	= "property_id = '".$property_id."'";
		$arr_property	= $this->model_basic->getValues_conditions($this->propertyMasterTable, '*', '', $conditions);
	
		$arr_property_rent	= $this->model_basic->getValues_conditions($this->rentMasterTable, '*', '', $conditions);
		$this->data['arr_property'] = $arr_property[0];
		$this->data['arr_property_rent'] = $arr_property_rent[0];
		
		//$restricted_date	= '';
		$arr_restricted_date	= $this->model_basic->getValues_conditions($this->restrcitedDates, '*', '', $conditions);
		$this->data['restricted_date']	= $arr_restricted_date;
		
		if($this->input->get_post('action') == 'Process')
		{
			$no_of_days		= stripslashes(trim($this->input->post('no_of_days')));
			$discount_rate  	= stripslashes(trim($this->input->post('discount_rate')));
			$deal_expiry_option	= stripslashes(trim($this->input->post('deal_expiry_option')));
			$deal_status		= stripslashes(trim($this->input->post('deal_status')));
			$restricted_date	= stripslashes(trim($this->input->post('restricted_date')));
				
			$payment_update_arr = array(
						  "no_of_days"		=> $no_of_days,
						  "discount_rate" 	=> $discount_rate,
						  "deal_expiry_option"	=> $deal_expiry_option,
						  "deal_status"		=> $deal_status
						  );
			$idArr = array(
					"property_id"	=> $property_id
					);
				
			$deal_update = $this->model_basic->updateIntoTable($this->rentMasterTable ,$idArr, $payment_update_arr);
			
			if($deal_expiry_option == 'limited')
			{
				/*** Delete record ***/
				$whereStr	= "property_id = ".$property_id;
				$this->model_basic->deleteData($this->restrcitedDates, $whereStr);
				
				/*** insert record ***/
				$start_date	= $_POST['start_date'];
				$end_date	= $this->input->post('end_date');
				
				
				for($i=0;$i<count($start_date);$i++)
				{
					$arr_start_date	= explode("/", $start_date[$i]);
					$new_start_date	= $arr_start_date[2]."-".$arr_start_date[1]."-".$arr_start_date[0];
					
					$arr_end_date	= explode("/", $end_date[$i]);
					$new_end_date	= $arr_end_date[2]."-".$arr_end_date[1]."-".$arr_end_date[0];
					
					$insertArr	= array(
								"property_id"	=> $property_id,
								"start_date"	=> $new_start_date,
								"end_date"	=> $new_end_date
								);
					//pr($insertArr,0);
					$this->model_basic->insertIntoTable($this->restrcitedDates, $insertArr);
				}
			}
			
			$this->nsession->set_userdata('succmsg', "Property successfully updated");
				
			redirect(BACKEND_URL."property_rental/index/".$page);
			return false;
			
		}
		
		
		$this->data['action_url']	=	BACKEND_URL.$this->router->class."/deal/".$property_id.'/'.$page;
                //$this->data['redirect_url'] 	=	BACKEND_URL.$this->router->class."/payment/".$property_id.'/'.$page ;
                $this->data['next_url'] 	=	BACKEND_URL.$this->router->class."/index/".$page ;
                $this->data['previous_url'] 	=	BACKEND_URL.$this->router->class."/calendar_view/".$property_id.'/'.$page ;
		
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'deal'),true);
		$this->elements['middle']='rentals/deal';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
}
?>