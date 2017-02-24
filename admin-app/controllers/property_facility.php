<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_facility extends MY_Controller
{
	var $propertyTypeMaster 	= 'lp_property_type_master';
	var $propertyMaster 		= 'lp_property_master';
	var $featuredCategory 		= 'hw_featured_category';
	var $amenitiesMaster 		= 'hw_amenities_master';
	var $documentTypeMaster 	= 'lp_document_type_master';
	var $internalInformation	= 'lp_internal_information';
	var $propertyBuyingMaster       = 'lp_buying_master';
	var $clientForSale              = 'lp_client_for_sale';
	var $leadTypeMasterTable	= 'lp_lead_type_master';
	var $clientForRent              = 'lp_client_for_rent';
	var $seasonMasterTable		= 'lp_season_master';
	var $propertySeasonPrice	= 'lp_property_season_price';
	var $suitabilityMaster          = 'lp_suitability_master';
	var $propertysitesettings 	= 'hw_sitesettings';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_property_facility');
	}


	
	/*********************************** for types start *****************************************/
	
	public function index()
	{ 
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_facility/index";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
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
		$this->data['amenityList']	= $this->model_property_facility->getFacilitiesList($config,$start);
		
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= currentClass();	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add/0/".$page;
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit/{{ID}}/".$page;
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete/{{ID}}/".$page;
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action_amenities/0/".$page;
		
		$this->data['sitesettings_value']= $this->model_basic->getValue_condition(SITESETTINGS,'sitesettings_value', '','sitesettings_id="19"');
		
		//$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->amenitiesMaster, "COUNT(amenities_id)", "CNT", "amenities_type IN ('Both', 'Rental') AND amenities_status = 'active'");
		
		
		//For breadcrump..........
		$this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-home','name'=>'Property Facility','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'List','link'=>'javascript:void();'),
				     );	
		
		
		//........................
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_facility/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
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
		
		$bool = $this->model_basic->checkRowExists(FACILITIES, $whereArr);
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
	 public function add()
	{
		chk_login();		
		$amenities_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		$type			= $this->uri->segment(5);
		$this->data['controller']	= currentClass();
		
		
			$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/0/0";
			$this->data['add_url']= BACKEND_URL.$this->data['controller']."/add/0/0";
		
		
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('amenity_name', 'Facility Name', 'trim|required|callback_is_amenity_name_exists');
			$this->form_validation->set_rules('featured_category', 'Featured Category', 'trim|required');
			//$this->form_validation->set_rules('amenities_image', 'Amenities Image', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$amenity_name			= addslashes(trim($this->input->get_post('amenity_name')));
				$amenity_slug			= url_title(strtolower($amenity_name));
				$featured_category		= addslashes(trim($this->input->get_post('featured_category')));
				
				$upload_config['field_name']            = 'amenities_image';
				$upload_config['file_upload_path']      = 'facility/';
				$upload_config['max_size']              = '';
				$upload_config['max_width']             = '2000';
				$upload_config['max_height']            = '2000';
				$upload_config['allowed_types']         = 'jpg|jpeg|gif|png';
				$thumb_config['thumb_create']           = false;
				$thumb_config['thumb_file_upload_path'] = 'thumb/';
				$thumb_config['thumb_marker']           = '';
				$thumb_config['maintain_ratio']         = false;
				$thumb_config['thumb_width']            = '200';
				$thumb_config['thumb_height']           = '200';				
				$sUploaded = image_upload($upload_config, $thumb_config);
				
				$ret = false;
				if($sUploaded != '')
				{
					$insertArr  =  array(
								'amenities_name' 	=> $amenity_name,
								'amenities_slug' 	=> $amenity_slug,
								'amenities_image'	=> $sUploaded,
								'category_id'  		=> $featured_category
							    );
					$ret   = $this->model_basic->insertIntoTable(FACILITIES,$insertArr);
				}			    
				
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Amenity Name added successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				
				redirect(currentClass().'/index');
				
				
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
		
		//For breadcrump..........
		
			$this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-home','name'=>'Property Facility','link'=>BACKEND_URL.currentClass().'/index/0/0'),
				     array('logo'=>'fa fa-plus','name'=>'Add','link'=>'javascript:void();'),
				     );	
		
		//........................
		
		$this->data['arr_featured_populate'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		/*** populate drop down for featured category end ***/
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_facility/add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	public function edit()
	{
		chk_login();
		
		$amenities_id	= $this->uri->segment(3, 0);
		$page 		= $this->uri->segment(4, 0);
		$type 		= $this->uri->segment(5);
		
		$this->data['controller']	= currentClass();
		
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/0/0/".$type;
		$this->data['edit_url']		= BACKEND_URL.$this->data['controller']."/edit/".$amenities_id."/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('amenity_name', 'Facility Name', 'trim|required|callback_is_amenity_name_exists');
			$this->form_validation->set_rules('featured_category', 'Featured Category', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else {
				$amenity_name		= addslashes(trim($this->input->get_post('amenity_name')));
				$amenity_slug		= url_title(strtolower($amenity_name));
				$featured_category	= addslashes(trim($this->input->get_post('featured_category')));
				
				$ret = false;
				if(isset($_FILES['amenities_image']))
				{
					$upload_config['field_name']            = 'amenities_image';
					$upload_config['file_upload_path']      = 'facility/';
					$upload_config['max_size']              = '';
					$upload_config['max_width']             = '2000';
					$upload_config['max_height']            = '2000';
					$upload_config['allowed_types']         = 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']           = false;
					$thumb_config['thumb_file_upload_path'] = 'thumb/';
					$thumb_config['thumb_marker']           = '';
					$thumb_config['maintain_ratio']         = false;
					$thumb_config['thumb_width']            = '200';
					$thumb_config['thumb_height']           = '200';				
					$sUploaded = image_upload($upload_config, $thumb_config);					
					if($sUploaded != '')
					{
						$prev_amenities_image = $this->input->post('prev_amenities_image');
						
						if($prev_amenities_image != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."facility/".$prev_amenities_image))
							unlink(FILE_UPLOAD_ABSOLUTE_PATH."facility/".$prev_amenities_image);
							
						$insertArr  =  array(
								'amenities_name'	=> $amenity_name,
								'amenities_slug'	=> $amenity_slug,
								'category_id' 		=> $featured_category,
								'amenities_image'	=> $sUploaded
							);
					
						$idArr		= array(
									'amenities_id' => $amenities_id
									);
						
						$ret   = $this->model_basic->updateIntoTable(FACILITIES, $idArr, $insertArr);
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
						redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/0");
					}
				}
				else
				{
					$insertArr  =  array(
								'amenities_name'	=> $amenity_name,
								'amenities_slug'	=> $amenity_slug,
								'category_id' 		=> $featured_category
							);
					
					$idArr		= array(
								'amenities_id' => $amenities_id
								);
					
					$ret   = $this->model_basic->updateIntoTable(FACILITIES, $idArr, $insertArr);
				}
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Facility updated successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				//$this->nsession->set_userdata('succmsg', "Facility updated successfully.");
				
				redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/0");
				
				return true;
			}
		}		
		
                $row = array();
		
		/*** populate drop down for featured category start ***/
		$idField	= 'featured_category_id';
		$nameField	= 'featured_category_name';
		$tableName	= FEATURED_CATEGORY;
		$condition	= "featured_category_status = 'active'";
		$orderField	= 'featured_category_name';
		$orderBy	= 'ASC';
		
		$this->data['arr_featured_populate'] = $this->model_basic->populateDropdown($idField, $nameField, $tableName, $condition, $orderField, $orderBy);
		/*** populate drop down for featured category end ***/
		
		// Prepare Data
		$Condition = " amenities_id = '".$amenities_id."'";
		
		$rs = $this->model_basic->getValues_conditions(FACILITIES, '', '', $Condition);
		//pr($rs);
		$row = $rs[0];
                if($row){
                    $this->data['arr_facility'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
			
			redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/0/rent");
			return false;
                }

		//For breadcrump..........
		
		$this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-home','name'=>'Property Facility','link'=>BACKEND_URL.currentClass().'/index/0/0'),
				     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();'),
				     );	
		
		//........................
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_facility/edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	public function delete()
	{
		chk_login();
		
		$amenities_id	= $this->uri->segment(3);
		$where		= "FIND_IN_SET('".$amenities_id."',facilities)";
		
		$i_delete_chk	= $this->model_basic->isRecordExist(PROPERTY_MASTER, $where);
		if($i_delete_chk > 0){
			$this->nsession->set_userdata('errmsg', "Selected facility is used. Can not delete.");
		} else {
			$where		= "amenities_id = '".$amenities_id."'";
		
			$this->model_basic->deleteData(FACILITIES, $where);
			$this->nsession->set_userdata('succmsg', "Selected Facility is deleted successfully.");
		}
		redirect(BACKEND_URL."property_facility/index/0");
		return true;
	}
	

	public function change_status(){
	    $facility_id = $this->input->post('id');
	    $rec = $this->model_property_facility->getFacilityDetails($facility_id);
	    if(is_array($rec) and count($rec)>0){
	       $status = $rec['amenities_status'];
	       $new_status ='';
	       if($status=='active'){
		 $new_status = 'inactive';
	       }
	       else if($status=='inactive'){
		 $new_status = 'active';
	       }
	       
		$updateArr  =  array('amenities_status' => $new_status);
			 
		$idArr      = array('amenities_id' => $facility_id);
	 
		$ret   = $this->model_basic->updateIntoTable(FACILITIES,$idArr, $updateArr);
	    }
	}

}