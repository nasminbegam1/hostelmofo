<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_locations extends CI_Controller
{
	var $propertyLocationsTable 	= 'lp_location_master';
	var $propertyRegionsTable 	= 'lp_region_master';
	var $propertyViewsTable 	= 'lp_view_master';
	var $propertyMaster 		= 'lp_property_master';
	var $regionMaster 		= 'lp_region_master';
	var $viewTypeMaster 		= 'lp_view_type_master';
	var $themeTypeMaster 		= 'lp_theme_type_master';
	var $locationImages 		= 'lp_location_images';
	var $propertyOutsideLocation 	= 'lp_location_outside_websites';
	var $propertysitesettings 	= 'lp_sitesettings';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_property_locations');
	}
	
	public function index()
	{ 
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_locations/index/0/0/location";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 6;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('PROPERTY_LOCATIONS');
		
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
		$page 				= $this->uri->segment(6,0);
		$this->data['propertyLocations']= $this->model_property_locations->getList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_locations';	
		$this->data['base_url'] 	= BACKEND_URL."property_locations/index/0/1/location/";				
		$this->data['show_all']      	= BACKEND_URL."property_locations/index/0/1/location/";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_location/0/".$page."/location/";
		$this->data['edit_link']      	= BACKEND_URL."property_locations/edit_location/{{ID}}/".$page."/location/";
		$this->data['delete_link']	= BACKEND_URL."property_locations/delete_locations/{{ID}}/".$page."/location/";
		$this->data['batch_action_link']= BACKEND_URL."property_locations/location_batch_action/0/".$page."/location";
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		//$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertysitesettings,'sitesettings_value', '','sitesettings_id="20"');
		$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertyLocationsTable, "COUNT(location_id)", "CNT", "location_status = 'active'");
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/locations';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	}
	
	function is_name_exists(){		
		$id 	= $this->uri->segment(3, 0);
		$location_name 	= strip_tags(addslashes(trim($this->input->get_post('location_name'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'location_name' => $location_name,
						 'location_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'location_name' => $location_name );
		}
		$bool 	= $this->model_basic->checkRowExists($this->propertyLocationsTable, $whereArr );
		//checkRowExists($tableName, $whereArr){ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	public function add_location()
	{
		chk_login();		
		$location_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page."/0/location/";
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_location/".$page."/0/location/";
		$insertArr 		= array();
		
		if($this->input->get_post('action') == 'Process')
		{
			//pr($_POST);
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');			
			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('location_code', 'Location Code', 'trim|required');
			$this->form_validation->set_rules('short_description', 'Short description', 'required');
			$this->form_validation->set_rules('long_description', 'Long description', 'required');
			//$this->form_validation->set_rules('location_tags', 'Location tags', 'required');
			$this->form_validation->set_rules('nearest_airport_info', 'Distance Airport', 'required');
			$this->form_validation->set_rules('airport_taxi_info', 'Cost to Airport', 'required');
			$this->form_validation->set_rules('explore_things_todo', 'Distance to Phuket Town', 'required');
			$this->form_validation->set_rules('distance_to_patong', 'Distance To Patong', 'required');
			$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
			$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
			$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('meta_key', 'Meta keys', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				
				////////////////////////////////////////
				//$size = getimagesize($_FILES['locationImage']['name']);
				$user_image = '';
			     	if ($_FILES['locationImage']['name'] != "")
				{
					
					if(file_exists($_FILES['locationImage']['tmp_name']))
					{
						
						$imageDim = getimagesize($_FILES['locationImage']['tmp_name']);
						//pr($imageDim);
						if( $imageDim[0] == 315 &&  $imageDim[1] == 166 )
						{
							
						}
						else 
						{							
							$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 315x166.");
							redirect(base_url()."property_locations/index/".$page."/0/location/");
						}
					}
					
					$upload_config['field_name']		= 'locationImage';
					$upload_config['file_upload_path'] 	= 'location/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '';
					$upload_config['max_height']		= '';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= '315';
					$thumb_config['thumb_height']		= '166';
									
					//pr($upload_config,0);pr($thumb_config,0);
					//pr($_FILES,0);
					$user_image = '';
					$sUploaded = image_upload($upload_config, $thumb_config);
					
					$sUploaded_banner = '';
					if(file_exists($_FILES['locationbanner']['tmp_name']))
					{
						
						$imageDim = getimagesize($_FILES['locationbanner']['tmp_name']);
						//pr($imageDim);
						if( $imageDim[0] >=1038 &&  $imageDim[1] >= 395 )
						{
							
						}
						else 
						{							
							$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions  1038x395 ");
							redirect(base_url()."property_locations/add_location/0/0/location/");
						}
						
						$upload_config1['field_name']		= 'locationbanner';
						$upload_config1['file_upload_path'] 	= 'location/';
						$upload_config1['max_size']		= '';
						$upload_config1['max_width']		= '';
						$upload_config1['max_height']		= '';
						$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
						$thumb_config1['thumb_create']		= true;
						$thumb_config1['thumb_file_upload_path']= 'thumb/';
						$thumb_config1['thumb_width']		= '1038';
						$thumb_config1['thumb_height']		= '395';
								
						$sUploaded_banner = image_upload($upload_config1, $thumb_config1);
						
					}
					if($sUploaded_banner != '')
						$sUploaded_banner = $sUploaded_banner;
					else
						$sUploaded_banner = '';
					
					if($sUploaded == '')
					{
						
						$themearray = $this->input->get_post('themes');
						if( isset($themearray) && !empty($themearray) )
							$themestring = implode(',',$themearray);
						else
							$themestring = '';
						
						//$this->session->set_userdata('errmsg', $isUploaded);
						//redirect(base_url()."property_locations/index/".$page."/");
						
						$region_id 		= addslashes(trim($this->input->get_post('region_id')));
						$location_name 		= addslashes(trim($this->input->get_post('location_name')));
						$location_code 		= addslashes(trim($this->input->get_post('location_code')));
						$short_description 	= addslashes(trim($this->input->get_post('short_description')));
						$long_description 	=  addslashes(trim($this->input->get_post('long_description')));
						$nearest_airport_info 	= addslashes(trim($this->input->get_post('nearest_airport_info')));
						$airport_taxi_info 	= addslashes(trim($this->input->get_post('airport_taxi_info')));
						$explore_things_todo 	= addslashes(trim($this->input->get_post('explore_things_todo')));
						$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
						$latitude 		= addslashes(trim($this->input->get_post('latitude')));
						$longitude 		= addslashes(trim($this->input->get_post('longitude')));
						$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
						$location_featured 	= $this->input->get_post('location_featured');
						$location_status 	= $this->input->get_post('location_status');
						$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
						$location_featured 	= $this->input->get_post('location_featured');
						$meta_title 		= $this->input->get_post('meta_title');
						$meta_key 		= $this->input->get_post('meta_key');
						$meta_description 	= $this->input->get_post('meta_description');
						
						
						$insertArr 	=
								array(
									'region_id' 			=> $region_id,
									'location_name' 		=> $location_name,
									'location_code'			=> $location_code,	
									'location_slug' 		=> str_replace('-', '',url_title(strtolower($location_name))),
									'location_short_description'	=> $short_description,
									'theme_type_ids'		=>$themestring,
									'location_long_description' 	=> $long_description,
									'nearest_airport_info'		=>$nearest_airport_info,
									'airport_taxi_info'		=>$airport_taxi_info,
									'explore_things_todo'		=>$explore_things_todo,
									'distance_to_patong'		=>$distance_to_patong,
									'latitude'			=>$latitude,
									'longitude'			=>$longitude,
									'location_featured'		=> $location_featured,
									'location_status'		=> $location_status,
									'location_tags'			=> $location_tags,
									'location_image'		=> $user_image,
									'location_banner'		=> $sUploaded_banner,
									'meta_title'			=> $meta_title,
									'meta_key'			=> $meta_key,
									'meta_description'		=> $meta_description
									);
								
						$ret = $this->model_basic->insertIntoTable($this->propertyLocationsTable,$insertArr);
						echo $ret; exit;
						if($ret){
								$this->nsession->set_userdata('succmsg', "Location added successfully.");
								$last_inserted_location_id = $this->db->insert_id();
								redirect(base_url()."property_locations/index/".$page."/0/location/");
								
							}
						else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add Location. Please try after some time.");
								redirect(base_url()."property_locations/index/".$page."/0/location/");
								return false;
							}
					}
					else
					{	
						//$themearray = $this->input->get_post('themes');
						//pr($themearray);
						//$themestring = implode(',',$themearray);
						
						$themearray = $this->input->get_post('themes');
						//pr($themearray);
						if( isset($themearray) && !empty($themearray) )
							$themestring = implode(',',$themearray);
						else
							$themestring = '';
							
						$user_image = $sUploaded;
						//$this->model_adminuser->addAdminUsers($user_image,'agent');
						$region_id 		= addslashes(trim($this->input->get_post('region_id')));
						$location_name 		= addslashes(trim($this->input->get_post('location_name')));
						$location_code 		= addslashes(trim($this->input->get_post('location_code')));
						$short_description 	= addslashes(trim($this->input->get_post('short_description')));
						$long_description 	= addslashes(trim($this->input->get_post('long_description')));
						$nearest_airport_info 	= addslashes(trim($this->input->get_post('nearest_airport_info')));
						$airport_taxi_info 	= addslashes(trim($this->input->get_post('airport_taxi_info')));
						$explore_things_todo 	= addslashes(trim($this->input->get_post('explore_things_todo')));
						$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
						$latitude 		= addslashes(trim($this->input->get_post('latitude')));
						$longitude 		= addslashes(trim($this->input->get_post('longitude')));
						$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
						$location_featured 	= $this->input->get_post('location_featured');
						$location_status 	= $this->input->get_post('location_status');
						$meta_title 		= $this->input->get_post('meta_title');
						$meta_key 		= $this->input->get_post('meta_key');
						$meta_description 	= $this->input->get_post('meta_description');
						
						$insertArr 	=  array(
									'region_id' 			=> $region_id,
									'location_name' 		=> $location_name,
									'location_code' 		=> $location_code,
									'location_slug' 		=> str_replace('-', '',url_title(strtolower($location_name))),
									'location_short_description'	=> $short_description,
									'theme_type_ids'		=>$themestring,
									'location_long_description' 	=> $long_description,
									'nearest_airport_info'		=>$nearest_airport_info,
									'airport_taxi_info'		=>$airport_taxi_info,
									'explore_things_todo'		=>$explore_things_todo,
									'distance_to_patong'		=>$distance_to_patong,
									'latitude'			=>$latitude,
									'longitude'			=>$longitude,
									'location_featured'		=> $location_featured,
									'location_status'		=> $location_status,
									'location_tags'			=> $location_tags,
									'location_image'		=> $user_image,
									'location_banner'		=> $sUploaded_banner,
									'meta_title'			=> $meta_title,
									'meta_key'			=> $meta_key,
									'meta_description'		=> $meta_description
								     );
						$ret = $this->model_basic->insertIntoTable($this->propertyLocationsTable,$insertArr);
						if($ret){
							$this->nsession->set_userdata('succmsg', "Location added successfully.");
							$last_inserted_location_id = $this->db->insert_id();
							redirect(base_url()."property_locations/index/".$page."/0/location/");
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to add Location. Please try after some time.");
							redirect(base_url()."property_locations/index/".$page."/0/location/");
							return false;
						}
					}
					
					
				}				
				else
				{
					
					$this->nsession->set_userdata('errmsg', "Location image is mandatory.");			
					redirect(base_url()."property_locations/index/".$page."/0/location/");
					return true;
				}   
			}
			
			
		}		
		
                //$row = array();		
		$this->data['regions'] = $this->model_basic->getValues_conditions($this->regionMaster,'*', '','region_status = "active"','region_name', 'ASC');
		$this->data['themes'] = $this->model_basic->getValues_conditions($this->themeTypeMaster,'*', '','theme_type_status = "active"','theme_type_name', 'ASC');
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/locations_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	

	
	public function edit_location()
	{
		chk_login();
		$location_id		= $this->uri->segment(3, 0);
		$page 			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page."/0/location/";
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_location/".$location_id."/".$page."/location/";
		
		if($this->input->get_post('action') == 'Process')
		{
						
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');			
			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('location_code', 'Location Code', 'trim|required');
			$this->form_validation->set_rules('short_description', 'Short description', 'required');
			$this->form_validation->set_rules('long_description', 'Long description', 'required');
			$this->form_validation->set_rules('location_tags', 'Location tags', 'required');
			$this->form_validation->set_rules('nearest_airport_info', 'Nearest airport info', 'required');
			$this->form_validation->set_rules('airport_taxi_info', 'Airport taxi info', 'required');
			$this->form_validation->set_rules('explore_things_todo', 'Explore things to do', 'required');
			$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
			$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
			
			$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('meta_key', 'Meta keys', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
                           
			}
			
			else
			{
				$arr_location_image_old = $this->model_property_locations->get_single($location_id);
				$sUploaded_banner	= '';
				if(file_exists($_FILES['locationbanner']['tmp_name']))
				{
					//echo "hiii";
					//die();
					
					$imageDim = getimagesize($_FILES['locationbanner']['tmp_name']);
					//pr($imageDim);
					if( $imageDim[0] >=1038 &&  $imageDim[1] >= 395 )
					{
						
					}
					else 
					{							
						$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions  1038x395 ");
						redirect(base_url()."property_locations/index/".$page."/0/location/");
					}
					
					$upload_config1['field_name']		= 'locationbanner';
					$upload_config1['file_upload_path'] 	= 'location/';
					$upload_config1['max_size']		= '';
					$upload_config1['max_width']		= '';
					$upload_config1['max_height']		= '';
					$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
					$thumb_config1['thumb_create']		= true;
					$thumb_config1['thumb_file_upload_path']= 'thumb/';
					$thumb_config1['thumb_width']		= '1038';
					$thumb_config1['thumb_height']		= '395';
							
					$sUploaded_banner = image_upload($upload_config1, $thumb_config1);
					
				
					if($sUploaded_banner != ''){
						$sUploaded_banner = $sUploaded_banner;
						if(file_exists(file_upload_absolute_path().'location/'.stripslashes($arr_location_image_old[0]['location_banner'])) && stripslashes($arr_location_image_old[0]['location_banner']) != "")
						{
							unlink(file_upload_absolute_path().'location/'.stripslashes($arr_location_image_old[0]['location_banner']));
						}
					
						if(file_exists(file_upload_absolute_path().'location/thumb/'.stripslashes($arr_location_image_old[0]['location_banner'])) && stripslashes($arr_location_image_old[0]['location_banner']) != "")
						{
							unlink(file_upload_absolute_path().'location/thumb/'.stripslashes($arr_location_image_old[0]['location_banner']));
						}
					}
					else{
						$sUploaded_banner = $arr_location_image_old[0]['location_banner'];
					}
				}	
				if ($_FILES['locationImage']['name'] != "")
				{
					//	echo "hiii";
					//die();				
					if(file_exists($_FILES['locationImage']['tmp_name']))
					{
						
						$imageDim = getimagesize($_FILES['locationImage']['tmp_name']);
						//pr($imageDim);
						if( $imageDim[0] == 315 && $imageDim[1] == 166 )
						{
							
						}
						else
						{
							//pr($imageDim);
							$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 315x166.");
							redirect(base_url()."property_locations/index/".$page."/0/location/");
						}
					}
					
					$upload_config['field_name']		= 'locationImage';
					$upload_config['file_upload_path'] 	= 'location/';
					$upload_config['max_size']		= '';
					$upload_config['min_width']		= '';
					$upload_config['min_height']		= '';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= '315';
					$thumb_config['thumb_height']		= '166';
					
					$user_image = '';
					$sUploaded = image_upload($upload_config, $thumb_config);
					
					$location_image_old     = $arr_location_image_old[0]['location_image'];

					
					$region_id 		= addslashes(trim($this->input->get_post('region_id')));
					$location_name 		= addslashes(trim($this->input->get_post('location_name')));
					$short_description 	= addslashes(trim($this->input->get_post('short_description')));
					$long_description 	=  addslashes(trim($this->input->get_post('long_description')));
					$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
					//$location_featured 	= $this->input->get_post('location_featured');
					$location_status 	= $this->input->get_post('location_status');
					$meta_title 		= addslashes(trim($this->input->get_post('meta_title')));
					$meta_key 		= addslashes(trim($this->input->get_post('meta_key')));
					$meta_description 	= addslashes(trim($this->input->get_post('meta_description')));
					$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
					
					if($sUploaded == '')
					{	
						
						$themearray = $this->input->get_post('themes');
						//pr($themearray);
						if( isset($themearray) && !empty($themearray) )
							$themestring = implode(',',$themearray);
						else
							$themestring = '';
												
						//$this->session->set_userdata('errmsg', $isUploaded);
						//redirect(base_url()."property_locations/index/".$page."/");
							
						$region_id 		= addslashes(trim($this->input->get_post('region_id')));
						$location_name 		= addslashes(trim($this->input->get_post('location_name')));
						$location_code 		= addslashes(trim($this->input->get_post('location_code')));
						$short_description 	= addslashes(trim($this->input->get_post('short_description')));
						$long_description 	=  addslashes(trim($this->input->get_post('long_description')));
						$nearest_airport_info 	= addslashes(trim($this->input->get_post('nearest_airport_info')));
						$airport_taxi_info 	= addslashes(trim($this->input->get_post('airport_taxi_info')));
						$explore_things_todo 	= addslashes(trim($this->input->get_post('explore_things_todo')));
						$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
						$latitude 		= addslashes(trim($this->input->get_post('latitude')));
						$longitude 		= addslashes(trim($this->input->get_post('longitude')));
						$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
						$location_featured 	= $this->input->get_post('location_featured');
						$location_status 	= $this->input->get_post('location_status');
						
							
						$updateArr 	=  array(
									'region_id' 			=> $region_id,
									'location_name' 		=> $location_name,
									'location_code' 		=> $location_code,
									'location_slug' 		=> str_replace('-', '',url_title(strtolower($location_name))),
									'location_short_description'	=> $short_description,
									'theme_type_ids'=>$themestring,
									'location_long_description' 	=> $long_description,
									'nearest_airport_info'		=> $nearest_airport_info,
									'airport_taxi_info'		=> $airport_taxi_info,
									'explore_things_todo'		=> $explore_things_todo,
									'distance_to_patong'		=>$distance_to_patong,
									'latitude'			=> $latitude,
									'longitude'			=> $longitude,									
									'location_status'		=> $location_status,
									'location_tags'			=> $location_tags,
									'location_banner'		=> $sUploaded_banner,
									'meta_title'			=> $meta_title,
									'meta_key'			=> $meta_key,
									'meta_description'		=> $meta_description
								     );
						
						//echo "no image";pr($updateArr);
						$idArr		= array('location_id' => $location_id);
						$ret 		= $this->model_basic->updateIntoTable($this->propertyLocationsTable, $idArr, $updateArr);
						
						$this->nsession->set_userdata('succmsg', "Location name updated successfully.");
						
						redirect(BACKEND_URL."property_locations/index/".$page."/0/location/");
						return true;
					}
					
					else
					{						
						$themearray = $this->input->get_post('themes');
						//pr($themearray);
						if( isset($themearray) && !empty($themearray) )
							$themestring = implode(',',$themearray);
						else
							$themestring = '';
						
						if(file_exists(file_upload_absolute_path().'location/'.stripslashes($location_image_old)) && stripslashes($location_image_old) != "")
						{
							unlink(file_upload_absolute_path().'location/'.stripslashes($location_image_old));
							unlink(file_upload_absolute_path().'location/thumb/'.stripslashes($location_image_old));
						}
						
							$user_image = $sUploaded;
							$region_id 	= addslashes(trim($this->input->get_post('region_id')));
							$location_name 	= addslashes(trim($this->input->get_post('location_name')));
							$location_code 	= addslashes(trim($this->input->get_post('location_code')));
							$short_description = addslashes(trim($this->input->get_post('short_description')));
							$long_description =  addslashes(trim($this->input->get_post('long_description')));
							$nearest_airport_info = addslashes(trim($this->input->get_post('nearest_airport_info')));
							$airport_taxi_info = addslashes(trim($this->input->get_post('airport_taxi_info')));
							$explore_things_todo = addslashes(trim($this->input->get_post('explore_things_todo')));
							$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
							$latitude = addslashes(trim($this->input->get_post('latitude')));
							$longitude = addslashes(trim($this->input->get_post('longitude')));
							$location_tags = addslashes(trim($this->input->get_post('location_tags')));
							//$location_featured = $this->input->get_post('location_featured');
							$location_status = $this->input->get_post('location_status');
							
							$updateArr 	=  array(
										'region_id' 			=> $region_id,
										'location_name' 		=> $location_name,
										'location_code' 		=> $location_code,
										'location_slug' 		=> str_replace('-', '',url_title(strtolower($location_name))),
										'location_short_description'	=> $short_description,
										'theme_type_ids'=>$themestring,
										'location_long_description'	=> $long_description,
										'nearest_airport_info'		=> $nearest_airport_info,
										'airport_taxi_info'		=> $airport_taxi_info,
										'explore_things_todo'		=> $explore_things_todo,
										'distance_to_patong'		=>$distance_to_patong,
										'latitude'			=> $latitude,
										'longitude'			=> $longitude,
										'location_tags'			=> $location_tags,
										'location_image'		=> $user_image,
										'location_banner'		=> $sUploaded_banner,
										'meta_title'			=> $meta_title,
										'meta_key'			=> $meta_key,
										'meta_description'		=> $meta_description
									     );
							
							$idArr		= array('location_id' => $location_id);
							$ret 		= $this->model_basic->updateIntoTable($this->propertyLocationsTable, $idArr, $updateArr);
							
							$this->nsession->set_userdata('succmsg', "Location name updated successfully.");
							
							redirect(BACKEND_URL."property_locations/index/".$page."/0/location/");
							return true;
						
					}
					
				}
				
				else
				
				{
					
					$themearray = $this->input->get_post('themes');
						//pr($themearray);
						if( isset($themearray) && !empty($themearray) )
							$themestring = implode(',',$themearray);
						else
							$themestring = '';
					
							$region_id 		= addslashes(trim($this->input->get_post('region_id')));
							$location_name 		= addslashes(trim($this->input->get_post('location_name')));
							$location_code 		= addslashes(trim($this->input->get_post('location_code')));
							$short_description 	= addslashes(trim($this->input->get_post('short_description')));
							$long_description 	=  addslashes(trim($this->input->get_post('long_description')));
							$nearest_airport_info 	= addslashes(trim($this->input->get_post('nearest_airport_info')));
							$airport_taxi_info 	= addslashes(trim($this->input->get_post('airport_taxi_info')));
							$explore_things_todo 	= addslashes(trim($this->input->get_post('explore_things_todo')));
							$distance_to_patong 	= addslashes(trim($this->input->get_post('distance_to_patong')));
							$latitude 		= addslashes(trim($this->input->get_post('latitude')));
							$longitude 		= addslashes(trim($this->input->get_post('longitude')));
							$location_tags 		= addslashes(trim($this->input->get_post('location_tags')));
							//$location_featured 	= $this->input->get_post('location_featured');
							$location_status 	= $this->input->get_post('location_status');
							$meta_title 		= addslashes(trim($this->input->get_post('meta_title')));
							$meta_key 		= addslashes(trim($this->input->get_post('meta_key')));
							$meta_description 	= addslashes(trim($this->input->get_post('meta_description')));

							$updateArr 	=  array(
										'region_id' 			=> $region_id,
										'location_name' 		=> $location_name,
										'location_code' 		=> $location_code,
										'location_slug' 		=> str_replace('-', '',url_title(strtolower($location_name))),
										'location_short_description'	=> $short_description,
										'location_long_description' 	=> $long_description,
										'theme_type_ids'=>$themestring,
										'nearest_airport_info'		=> $nearest_airport_info,
										'airport_taxi_info'		=> $airport_taxi_info,
										'explore_things_todo'		=> $explore_things_todo,
										'distance_to_patong'		=>$distance_to_patong,
										'latitude'			=> $latitude,
										'longitude'			=> $longitude,										
										'location_status'		=> $location_status,
										'location_tags'			=> $location_tags,
										'location_banner'		=> $sUploaded_banner,
										'meta_title'			=> $meta_title,
										'meta_key'			=> $meta_key,
										'meta_description'		=> $meta_description
										);
							//pr($updateArr);
							
							$idArr		= array('location_id' => $location_id);
							$ret 		= $this->model_basic->updateIntoTable($this->propertyLocationsTable, $idArr, $updateArr);
							
								$this->nsession->set_userdata('succmsg', "Location name updated successfully.");
							
								
								redirect(BACKEND_URL."property_locations/index/".$page."/0/location/");
								return true;
						
							
				}
				
			
			}
			
		
			
		}		
		
                $row = array();
		//Prepare Data
		//$rs = $this->model_property_locations->getSingle($location_id);
		$this->data['regions'] = $this->model_basic->getValues_conditions($this->regionMaster,'*', '','region_status = "active"','region_name', 'ASC');
		$this->data['themes'] = $this->model_basic->getValues_conditions($this->themeTypeMaster,'*', '','theme_type_status = "active"','theme_type_name', 'ASC');
		$rs = $this->model_basic->getValues_conditions($this->propertyLocationsTable, '*', '', 'location_id = '.$location_id);
		$row = $rs[0];
        if($row)
		{
                    $this->data['property_locations'] = $row;
		    //pr($this->data['property_locations']);
        }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/0/location/");
                        return false;
        }
		
		
		/////////////////////////////get the banner ////////////////////////////
		
		$rs_banner_initial = $this->model_basic->getValues_conditions($this->locationImages, '', '', 'location_id ='.$location_id);
		if(count($rs_banner_initial)>0)
		{
		 $this->data['property_banners'] = $rs_banner_initial;
		}
		/////////////////////////////get the banner ////////////////////////////
		
		
		
		

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/locations_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
		
	}	
	
	public function delete_locations()
	{
		$this->chk_login();
		
		$location_id	= $this->uri->segment(3);		
		$page 		= $this->uri->segment(4, 0);
		$where		= "location_id = '".$location_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
		$i_delete_chk_for_outside_location	= $this->model_basic->isRecordExist($this->propertyOutsideLocation, $where);
		if(($i_delete_chk > 0)||($i_delete_chk_for_outside_location > 0))
		{
			$this->nsession->set_userdata('errmsg', "Properties with this Location Exist. The Location cannot be deleted.");
		}
		else
		{
			
			$arr_location_existing_image = $this->model_property_locations->get_single($location_id);
			$location_existing_image    = $arr_location_existing_image[0]['location_image'];
			
			if(file_exists(file_upload_absolute_path().'location/'.stripslashes($location_existing_image)) && stripslashes($location_existing_image) != "")
			{
				unlink(file_upload_absolute_path().'location/'.stripslashes($location_existing_image));
				unlink(file_upload_absolute_path().'location/thumb/'.stripslashes($location_existing_image));
			}
			
			$this->model_basic->deleteData($this->propertyLocationsTable, $where);
			$this->nsession->set_userdata('succmsg', "Location has been deleted successfully.");
		}		
		//redirect(BACKEND_URL."property_settings/types/".$url_start_record);
		redirect(BACKEND_URL."property_locations/index/".$page."/0/location/");
		return true;
	}
	public function update_left_order()
	{
	$loc_id=$this->input->get_post('loc_id');

        $left_order=$this->input->get_post('left_order');
	$this->data['existing_value']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'left_bar_order', '','location_id="'.$loc_id.'"');
	$this->data['sitesettings_value']= $this->model_basic->getValue_condition($this->propertysitesettings,'sitesettings_value', '','sitesettings_name="location_in_left_bar"');
	$this->data['updated_value_loc']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'location_id', '','left_bar_order="'.$left_order.'"');
	if($left_order>0 && $left_order<=$this->data['sitesettings_value'])
		{
			
				
				$insertArr  =  array(
							'left_bar_order' => $left_order
						);
				
				$idArr		= array(
							'location_id' => $loc_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr, $insertArr);
				
				
				$insertArr1  =  array(
							'left_bar_order' => $this->data['existing_value']
						);
				
				$idArr1		= array(
							'location_id' => $this->data['updated_value_loc']
							);
				
				$ret1   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr1, $insertArr1);
				
				echo $this->data['existing_value']."-".$this->data['updated_value_loc'];
				
			
		}
		
	}
	
	public function update_homepage_order()
	{
	$loc_id=$this->input->get_post('loc_id');

        $location_featured=$this->input->get_post('homepage_order');
	$this->data['existing_value']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'location_featured', '','location_id="'.$loc_id.'"');
	
	$this->data['updated_value_loc']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'location_id', '','location_featured="'.$location_featured.'"');
	if($location_featured>0 )
		{
			
				
			$insertArr  =  array(
						'location_featured' => $location_featured
					);
			
			$idArr		= array(
						'location_id' => $loc_id
						);
			
			$ret   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr, $insertArr);
			
			
			$insertArr1  =  array(
						'location_featured' => $this->data['existing_value']
					);
			
			$idArr1		= array(
						'location_id' => $this->data['updated_value_loc']
						);
			
			$ret1   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr1, $insertArr1);
			
			echo $this->data['existing_value']."-".$this->data['updated_value_loc'];
				
	
		}
		
	}
	public function update_popular_order()
	{
	$loc_id=$this->input->get_post('loc_id');

        $popular_order =$this->input->get_post('popular_order');
	$this->data['existing_value']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'popular_order', '','location_id="'.$loc_id.'"');
	
	$this->data['updated_value_loc']= $this->model_basic->getValue_condition($this->propertyLocationsTable,'location_id', '','popular_order="'.$popular_order.'"');
	if($popular_order>0 )
		{
	
			$insertArr  =  array(
						'popular_order' => $popular_order
					);
			
			$idArr		= array(
						'location_id' => $loc_id
						);
			
			$ret   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr, $insertArr);
			
			
			$insertArr1  =  array(
						'popular_order' => $this->data['existing_value']
					);
			
			$idArr1		= array(
						'location_id' => $this->data['updated_value_loc']
						);
			
			$ret1   = $this->model_basic->updateIntoTable($this->propertyLocationsTable,$idArr1, $insertArr1);
			
			echo $this->data['existing_value']."-".$this->data['updated_value_loc'];
				
	
		}
		
	}
	
	public function location_batch_action(){
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
		
		redirect(BACKEND_URL."property_locations/index/".$page."/0/location/");
		return true;
			
	}
	
	private function deletebatch($pagearray){		
		
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(location_id, '".implode(",", $pagearray)."') ";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
			$i_delete_chk_for_outside_location	= $this->model_basic->isRecordExist($this->propertyOutsideLocation, $where);
			
			if(($i_delete_chk > 0)||($i_delete_chk_for_outside_location > 0))
			{
				$this->nsession->set_userdata('errmsg', "Selected Location is in use. This location cannot be deleted.");
			}
			 else {
				
				
			///////////////////////////////this is to delete the location images physically in case of batch delete
				
			foreach($pagearray as $pagearrays)
			{
				$arr_location_existing_image = $this->model_property_locations->get_single($pagearrays);
				$location_existing_image    = $arr_location_existing_image[0]['location_image'];
				
				if(file_exists(file_upload_absolute_path().'location/'.stripslashes($location_existing_image)) && stripslashes($location_existing_image) != "")
				{
					unlink(file_upload_absolute_path().'location/'.stripslashes($location_existing_image));
					unlink(file_upload_absolute_path().'location/thumb/'.stripslashes($location_existing_image));
				}
				
				
			}	
				
		///////////////////////////////this is to delete the location images physically in case of batch delete
			
				
				//$delete_where	= "FIND_IN_SET(location_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->propertyLocationsTable, $where);
				$this->nsession->set_userdata('succmsg', "Selected location was deleted successfully.");
			}
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;		
		
	}
		
	private function batchstatus($status, $idArray){
		if($status == '')
			return false;
		
		//$return = $this->model_property_locations->statusBatchPropertyType($status);		
		 //pr($_POST,0); echo "bbbb"; 
		
		$updArr		= 'location_status';
		$return 	= $this->model_basic->changeStatus($this->propertyLocationsTable, $idArray, $updArr, $status, 'location_id');		
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select at least one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected location status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected location status Inactivated successfully.");
		}		
		return true;
	}
	
	
	
	
	
	/*********************************** for Region start *****************************************/
	public function regions()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_locations/regions/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('REGION_SEARCH');
		
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
		
		$start 			= 0;
		$page 			= $this->uri->segment(3,0);
		$this->data['regionList']	= $this->model_property_locations->getRegionList($config,$start);
		$this->data['startRecord']	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_locations';	
		$this->data['base_url'] 	= BACKEND_URL."property_locations/regions/0/1/";				
		$this->data['show_all']      	= BACKEND_URL."property_locations/regions/0/1/";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_region/0/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL."property_locations/edit_region/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL."property_locations/delete_region/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL."property_locations/region_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['pagination'] = $this->pagination->create_links();
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/regions';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	function is_region_exists($region_name)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'region_name' => $region_name,
						 'region_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'region_name' => $region_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->regionMaster, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_region_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	public function add_region()
	{
		chk_login();
		
		$property_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['add_link']  	= BACKEND_URL.$this->data['controller']."/add_region/".$page;
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/regions/".$page;
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('region_name', 'Region Name', 'trim|required|callback_is_region_exists');
			
			if ($this->form_validation->run() == FALSE){
				
			} else {
				$region_name	= addslashes(trim($this->input->get_post('region_name')));
				$region_slug	= str_replace('-', '',url_title(strtolower($region_name)));
				$insertArr  =  array(
							'region_name' => $region_name,
							'region_slug' => $region_slug
						);
			    
				$ret   = $this->model_basic->insertIntoTable($this->regionMaster ,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "region added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add region Types. Please try again later.");
				}
    
				redirect(BACKEND_URL."property_locations/regions/".$page."/");
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
		
		$this->elements['middle']='property_locations/add_region';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_region()
	{
		$this->chk_login();
		
		$region_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/regions/".$page;
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('region_name', 'Region Name', 'trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$region_name	= addslashes(trim($this->input->get_post('region_name')));
				$region_slug	= str_replace('-', '',url_title(strtolower($region_name)));
				$insertArr  =  array(
							'region_name' => $region_name,
							'region_slug' => $region_slug
						);
				
				$idArr		= array(
							'region_id' => $region_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->regionMaster,$idArr, $insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "region updated successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."property_locations/regions/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " region_id = '".$region_id."'";
		$rs = $this->model_basic->getValues_conditions($this->regionMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['property_regions'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/type_edit/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->session->userdata('succmsg');
		$this->data['errmsg'] = $this->session->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		//$this->layout->view('property_settings/type_edit',$this->data);
		
		$brdArr	= array( "Property Settings" => 'javascript:void(0);',
				 "Region Master" => $this->data['return_link'],
				 "Edit region"=>''
			       );
		
		$this->templatelayout->get_breadcrump($brdArr); 
		$this->templatelayout->get_sidebar('property_locations');
		$this->elements['middle']= 'property_locations/edit_region';				
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_region()
	{
		$this->chk_login();
		
		$region_id	= $this->uri->segment(3);
		$where			= "region_id = '".$region_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
		$i_delete_chk2	= $this->model_basic->isRecordExist($this->propertyLocationsTable, $where);
	
		if($i_delete_chk > 0 || $i_delete_chk2 > 0){
			$this->nsession->set_userdata('errmsg', "Selected region in used. Can not delete.");
		}
		else {
			$delete_where = "region_id = '".$region_id."'";
			$this->model_basic->deleteData($this->regionMaster, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected region deleted successfully.");
		  }
		
		redirect(BACKEND_URL."property_locations/regions/");
		return true;
	}
	
	
	public function region_batch_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteRegionbatch($pagearray);
		} else if($action == 'Activate')
		{
			$this->batchRegionstatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchRegionstatus('inactive', $pagearray);
		} else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_locations/regions/".$page);
		return true;
			
	}
	
	private function deleteRegionbatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(region_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster , $where);
			$i_delete_chk2	= $this->model_basic->isRecordExist($this->propertyLocationsTable, $where);
			
			if($i_delete_chk > 0 || $i_delete_chk2 > 0){
				$this->nsession->set_userdata('errmsg', "Selected region  is used. Can not delete.");
			} else {
				
				$delete_where	= "FIND_IN_SET(region_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->regionMaster, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected region deleted successfully.");
			}
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select at least one item to delete.");
		}
		return true;
	}
		
	private function batchRegionstatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->regionMaster, $idArray, 'region_status', $status, 'region_id');
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected region  status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected region status Inactivated successfully.");
		}
		return true;
	}
	
	////
	
	
	/*********************************** for Region end *****************************************/
	
	/*********************************** for View Type start *****************************************/
	public function viewtypes()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_locations/viewtypes/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('VIEW_TYPE_SEARCH');
		
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
		
		$start 			= 0;
		$page 			= $this->uri->segment(3,0);
		$this->data['viewTypeList']	= $this->model_property_locations->getViewTypeList($config,$start);
		$this->data['startRecord']	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_locations';	
		$this->data['base_url'] 	= BACKEND_URL."property_locations/viewtypes/0/1/";				
		$this->data['show_all']      	= BACKEND_URL."property_locations/viewtypes/0/1/";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_viewtype/0/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL."property_locations/edit_viewtype/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL."property_locations/delete_viewtype/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL."property_locations/view_type_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/view_type';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function themetypes()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_locations/themetypes/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('VIEW_TYPE_SEARCH');
		
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
		
		$start 			= 0;
		$page 			= $this->uri->segment(3,0);
		$this->data['themeTypeList']	= $this->model_property_locations->getThemeTypeList($config,$start);
		$this->data['startRecord']	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_locations';	
		$this->data['base_url'] 	= BACKEND_URL."property_locations/themetypes/0/1/";				
		$this->data['show_all']      	= BACKEND_URL."property_locations/themetypes/0/1/";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_themetype/0/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL."property_locations/edit_themetype/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL."property_locations/delete_themetype/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL."property_locations/theme_type_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/theme_type';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	function is_viewtype_exists($view_type_name)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'view_type_name' => $view_type_name,
						 'view_type_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'view_type_name' => $view_type_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->viewTypeMaster, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_viewtype_exists', 'The view type  already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	
	function is_themetype_exists($theme_type_name)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'theme_type_name' => $theme_type_name,
						 'theme_type_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'theme_type_name' => $theme_type_name );
		}
		
		$bool = $this->model_basic->checkRowExists($this->themeTypeMaster, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_themetype_exists', 'The theme type  already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	public function add_viewtype()
	{
		chk_login();
		
		$view_type_id	= $this->uri->segment(3, 0);
		$page	        = $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/viewtypes/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('view_type_name', 'Viewtype Name', 'trim|required|callback_is_viewtype_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				////////////////////////////////////////////IMAGE UPLOAD SECTION 
				
				if ($_FILES['ViewtypeImage']['name'] != "")
				{
					
								if(file_exists($_FILES['ViewtypeImage']['tmp_name']))
								{
									
									$imageDim = getimagesize($_FILES['ViewtypeImage']['tmp_name']);
									//pr($imageDim);
									if(($imageDim[0]!=24)||($imageDim[1]!=19))
									{
										
										$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 24x19.");
										redirect(base_url()."property_locations/viewtypes/".$page."/");
									}
								}
								
								$upload_config['field_name']		= 'ViewtypeImage';
								$upload_config['file_upload_path'] 	= 'viewicons/';
								$upload_config['max_size']		= '';
								$upload_config['max_width']		= '24';
								$upload_config['max_height']		= '24';
								$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
																				
								$user_image = '';
								$sUploaded = image_upload($upload_config, $thumb_config);
							
							////////////////////////////////////////////IMAGE UPLOAD SECTION 
					if($sUploaded == '')
					{
						
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."property_locations/viewtypes/".$page."/");
							
							$viewtype_name	= addslashes(trim($this->input->get_post('view_type_name')));
							$viewtype_slug	= url_title(strtolower($viewtype_name));
							$insertArr  =  array(
										'view_type_name' => $viewtype_name,
										'view_type_slug' => $viewtype_slug
									);
						    
							$ret   = $this->model_basic->insertIntoTable($this->viewTypeMaster ,$insertArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Viewtype added successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add viewtype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
							return true;
					}
					else
					{
						$user_image = $sUploaded;
						
						$viewtype_name	= addslashes(trim($this->input->get_post('view_type_name')));
							$viewtype_slug	= url_title(strtolower($viewtype_name));
							$insertArr  =  array(
										'view_type_name' => $viewtype_name,
										'view_type_slug' => $viewtype_slug,
										'view_icon'=>$user_image
									);
						
						$ret   = $this->model_basic->insertIntoTable($this->viewTypeMaster ,$insertArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Themetype added successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add viewtype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
							return true;
						
						
						
					}
				}
				else
				{
					
					$this->nsession->set_userdata('errmsg', "Viewtype icon is mandatory.");
					redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
										
				}
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
		
		$this->elements['middle']='property_locations/add_viewtype';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function add_themetype()
	{
		chk_login();
		
		$view_type_id	= $this->uri->segment(3, 0);
		$page	        = $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_themetype/0/".$page."/";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/themetypes/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('theme_type_name', 'Themetype Name', 'trim|required|callback_is_themetype_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				////////////////////////////////////////////IMAGE UPLOAD SECTION 
				
				if ($_FILES['ThemetypeImage']['name'] != "")
				{
					
								if(file_exists($_FILES['ThemetypeImage']['tmp_name']))
								{
									
									$imageDim = getimagesize($_FILES['ThemetypeImage']['tmp_name']);
									//pr($imageDim);
									if(($imageDim[0]!=19) )
									{
										
										$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with maximum width of 19pixel to fit the design.");
										redirect(base_url()."property_locations/themetypes/".$page."/");
									}
								}
								
								$upload_config['field_name']		= 'ThemetypeImage';
								$upload_config['file_upload_path'] 	= 'themeicons/';
								$upload_config['max_size']		= '';
								$upload_config['max_width']		= '24';
								$upload_config['max_height']		= '24';
								$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
																				
								$user_image = '';
								$sUploaded = image_upload($upload_config, $thumb_config);
							
							////////////////////////////////////////////IMAGE UPLOAD SECTION 
					if($sUploaded == '')
					{
						
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."property_locations/themetypes/".$page."/");
							
							$themetype_name	= addslashes(trim($this->input->get_post('theme_type_name')));
							$themetype_slug	= url_title(strtolower($themetype_name));
							$insertArr  =  array(
										'theme_type_name' => $themetype_name,
										'theme_type_slug' => $themetype_slug
									);
						    
							$ret   = $this->model_basic->insertIntoTable($this->themeTypeMaster ,$insertArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Themetype added successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add themetype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
							return true;
					}
					else
					{
						$user_image = $sUploaded;
						
						$themetype_name	= addslashes(trim($this->input->get_post('theme_type_name')));
							$themetype_slug	= url_title(strtolower($themetype_name));
							$insertArr  =  array(
										'theme_type_name' => $themetype_name,
										'theme_type_slug' => $themetype_slug,
										'theme_icon'=>$user_image
									);
						
						$ret   = $this->model_basic->insertIntoTable($this->themeTypeMaster ,$insertArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Themetype added successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add themetype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
							return true;
						
						
						
					}
				}
				else
				{
					
					$this->nsession->set_userdata('errmsg', "Themetype icon is mandatory.");
					redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
										
				}
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
		
		$this->elements['middle']='property_locations/add_themetype';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_viewtype()
	{
		chk_login();
		
		$view_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/viewtypes/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('view_type_name', 'Viewtype Name', 'trim|required|callback_is_viewtype_exists');
			
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else
			{
				//////////////////////////////////////
				
				if ($_FILES['ViewtypeImage']['name'] != "")
				{
					if(file_exists($_FILES['ViewtypeImage']['tmp_name']))
								{
									
									$imageDim = getimagesize($_FILES['ViewtypeImage']['tmp_name']);
									//pr($imageDim);
									if(($imageDim[0]!=24)||($imageDim[1]!=19))
									{
										
										$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 24x19.");
										redirect(base_url()."property_locations/viewtypes/".$page."/");
									}
								}
								
								$upload_config['field_name']		= 'ViewtypeImage';
								$upload_config['file_upload_path'] 	= 'viewicons/';
								$upload_config['max_size']		= '';
								$upload_config['max_width']		= '24';
								$upload_config['max_height']		= '24';
								$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
																				
								$user_image = '';
								$sUploaded = image_upload($upload_config, $thumb_config);
																
								
								$arr_viewtype_icon_old = $this->model_property_locations->get_single_viewtype($view_type_id);
								$viewtype_icon_old     = $arr_location_image_old[0]['view_icon'];///////////
								
								////////////////////post upload
								
								
					if($sUploaded == '')
					{
						
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."property_locations/viewtypes/".$page."/");
							
							$viewtype_name	= addslashes(trim($this->input->get_post('view_type_name')));
							$viewtype_slug	= url_title(strtolower($viewtype_name));
							$updateArr  =  array(
										'view_type_name' => $viewtype_name,
										'view_type_slug' => $viewtype_slug
									);
							
							$idArr		= array('view_type_id' => $view_type_id);
						    
							$ret   = $this->model_basic->updateIntoTable($this->viewTypeMaster ,$idArr,$updateArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Viewtype updated successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to update viewtype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
							return true;
					}
					else
					{
						
						
						if(file_exists(file_upload_absolute_path().'viewicons/'.stripslashes($viewtype_icon_old)) && stripslashes($viewtype_icon_old) != "")
						{
							unlink(file_upload_absolute_path().'viewicons/'.stripslashes($viewtype_icon_old));
							
						}
						
						$user_image = $sUploaded;
						
						$viewtype_name	= addslashes(trim($this->input->get_post('view_type_name')));
						$viewtype_slug	= url_title(strtolower($viewtype_name));
							$updateArr  =  array(
										'view_type_name' => $viewtype_name,
										'view_type_slug' => $viewtype_slug,
										'view_icon'=>$user_image
									);
							$idArr		= array('view_type_id' => $view_type_id);
						
						$ret   = $this->model_basic->updateIntoTable($this->viewTypeMaster ,$idArr,$updateArr);
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Viewtype updated successfully.");	
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to update viewtype. Please try again later.");
							}
			    
							redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
							return true;
						
					}
								
							///////////////////Post upload////////////////
								
				}
				
				else
				{
					
					$viewtype_name	= addslashes(trim($this->input->get_post('view_type_name')));
					$viewtype_slug	= url_title(strtolower($viewtype_name));
					
					$updateArr  =  array(
										'view_type_name' => $viewtype_name,
										'view_type_slug' => $viewtype_slug
									);
							
							$idArr		= array('view_type_id' => $view_type_id);
						    
							$ret   = $this->model_basic->updateIntoTable($this->viewTypeMaster ,$idArr,$updateArr);
							
							
							if($ret)
							{
								$this->nsession->set_userdata('succmsg', "Theme type updated successfully.");
							}
							else
							{
								$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
							}
							redirect(BACKEND_URL."property_locations/viewtypes/".$page."/");
							return true;
					
				}
				
				/////////////////////////////////////////////
				
				
				
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " view_type_id = '".$view_type_id."'";
		$rs = $this->model_basic->getValues_conditions($this->viewTypeMaster, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['property_viewtypes'] = $row;
        }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_viewtype/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/edit_viewtype';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_themetype()
	{
		
		chk_login();
		
		$theme_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_locations";
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_themetype/".$theme_type_id."/".$page;
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/themetypes/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('theme_type_name', 'Themetype Name', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else
			{
				//////////////////////////////////////
				
				if ($_FILES['ThemetypeImage']['name'] != "")
				{
					if(file_exists($_FILES['ThemetypeImage']['tmp_name']))
								{
									
									$imageDim = getimagesize($_FILES['ThemetypeImage']['tmp_name']);
									//pr($imageDim);
									if(($imageDim[0]!=19) )
									{
										
										$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with maximum width of 19 pixel each.");
										redirect(base_url()."property_locations/themetypes/".$page."/");
									}
								}
								
								$upload_config['field_name']		= 'ThemetypeImage';
								$upload_config['file_upload_path'] 	= 'themeicons/';
								$upload_config['max_size']		= '';
								$upload_config['max_width']		= '24';
								$upload_config['max_height']		= '24';
								$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
																				
								$user_image = '';
								$sUploaded = image_upload($upload_config, $thumb_config);
																
								
								$arr_themetype_icon_old = $this->model_property_locations->get_single_themetype($theme_type_id);
								$themetype_icon_old     = $arr_themetype_icon_old[0]['theme_icon'];///////////
								
								////////////////////post upload
								
								
					if($sUploaded == '')
					{
						
						$this->nsession->set_userdata('errmsg', $isUploaded);
						redirect(base_url()."property_locations/themetypes/".$page."/");
							
							$themetype_name	= addslashes(trim($this->input->get_post('theme_type_name')));
							$themetype_slug	= url_title(strtolower($themetype_name));
							$updateArr  =  array(
										'theme_type_name' => $themetype_name,
										'theme_type_slug' => $themetype_slug
									);
							
							$idArr		= array('theme_type_id' => $theme_type_id);
						    
							$ret   = $this->model_basic->updateIntoTable($this->themeTypeMaster ,$idArr,$updateArr);
							//if($ret)
							//{
							//	$this->nsession->set_userdata('succmsg', "Themetype updated successfully.");	
							//}
							//else
							//{
							//	$this->nsession->set_userdata('errmsg', "Unable to update themetype. Please try again later.");
							//}
							$this->nsession->set_userdata('succmsg', "Themetype updated successfully.");
							redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
							return true;
					}
					else
					{
						
						
						if(file_exists(file_upload_absolute_path().'themeicons/'.stripslashes($themetype_icon_old)) && stripslashes($themetype_icon_old) != "")
						{
							unlink(file_upload_absolute_path().'themeicons/'.stripslashes($themetype_icon_old));
							
						}
						
						$user_image = $sUploaded;
						
						$themetype_name	= addslashes(trim($this->input->get_post('theme_type_name')));
						$themetype_slug	= url_title(strtolower($themetype_name));
							$updateArr  =  array(
										'theme_type_name' => $themetype_name,
										'theme_type_slug' => $themetype_slug,
										'theme_icon'=>$user_image
									);
							$idArr		= array('theme_type_id' => $theme_type_id);
						
						$ret   = $this->model_basic->updateIntoTable($this->themeTypeMaster ,$idArr,$updateArr);
							//if($ret)
							//{
							//	$this->nsession->set_userdata('succmsg', "Themetype updated successfully.");	
							//}
							//else
							//{
							//	$this->nsession->set_userdata('errmsg', "Unable to update themetype. Please try again later.");
							//}
							$this->nsession->set_userdata('succmsg', "Themetype updated successfully.");	
							redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
							return true;
						
					}
								
							///////////////////Post upload////////////////
								
				}
				
				else
				{
					
					$themetype_name	= addslashes(trim($this->input->get_post('theme_type_name')));
					$themetype_slug	= url_title(strtolower($themetype_name));
					
					$updateArr  =  array(
										'theme_type_name' => $themetype_name,
										'theme_type_slug' => $themetype_slug
									);
							
							$idArr		= array('theme_type_id' => $theme_type_id);
						    
							$ret   = $this->model_basic->updateIntoTable($this->themeTypeMaster ,$idArr,$updateArr);
							
							
							//if($ret)
							//{
							//	$this->nsession->set_userdata('succmsg', "Theme type updated successfully.");
							//}
							//else
							//{
							//	$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
							//}
							$this->nsession->set_userdata('succmsg', "Theme type updated successfully.");
							redirect(BACKEND_URL."property_locations/themetypes/".$page."/");
							return true;
					
				}
				
				/////////////////////////////////////////////
				
				
				
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " theme_type_id = '".$theme_type_id."'";
		$rs = $this->model_basic->getValues_conditions($this->themeTypeMaster, '', '', $Condition);
		//echo 'hi'; exit();
		$row = $rs[0];
                if($row)
		{
                    $this->data['property_themetypes'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
			redirect(BACKEND_URL.$this->data['controller']."/edit_themetype/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/edit_themetype';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	
	public function delete_viewtype()
	{
		chk_login();
		
		$view_type_id	= $this->uri->segment(3);
		$where			= "view_id = '".$view_type_id."'";
		
		$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster, $where);
	
		if($i_delete_chk > 0)
		{
			$this->nsession->set_userdata('errmsg', "Selected theme type in used. Can not delete.");
		}
		else{
			$delete_where = "view_type_id = '".$view_type_id."'";
			$this->model_basic->deleteData($this->viewTypeMaster, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected theme type deleted successfully.");
		 
		}
		redirect(BACKEND_URL."property_locations/viewtypes/");
		return true;
	}
	
	public function delete_themetype()
	{
		chk_login();
		
		$theme_type_id	= $this->uri->segment(3);
		
		
			$delete_where = "theme_type_id = '".$theme_type_id."'";
			$this->model_basic->deleteData($this->themeTypeMaster, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected theme type deleted successfully.");
		 
		
		redirect(BACKEND_URL."property_locations/themetypes/");
		return true;
	}
	
	
	public function view_type_batch_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteViewtypebatch($pagearray);
		} else if($action == 'Activate')
		{
			$this->batchViewtypestatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchViewtypestatus('inactive', $pagearray);
		} else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_locations/viewtypes/".$page);
		return true;
			
	}
	
	
	public function theme_type_batch_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteThemetypebatch($pagearray);
		} else if($action == 'Activate')
		{
			$this->batchThemetypestatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchThemetypestatus('inactive', $pagearray);
		} else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_locations/themetypes/".$page);
		return true;
			
	}
	
	
	
	private function deleteViewtypebatch($pagearray)
	{
		if(is_array($pagearray))
		{
			$where	= "FIND_IN_SET(view_id, '".implode(",", $pagearray)."')";
		
			$i_delete_chk	= $this->model_basic->isRecordExist($this->propertyMaster , $where);
			
			if($i_delete_chk > 0){
				$this->nsession->set_userdata('errmsg', "Selected theme type in used. Can not delete.");
			} else {
				
				$delete_where	= "FIND_IN_SET(view_type_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->viewTypeMaster, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected themetype  deleted successfully.");
			}
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select at least one item to delete.");
		}
		return true;
	}
	
	private function deleteThemetypebatch($pagearray)
	{
		if(is_array($pagearray))
		{
			
				
				$delete_where	= "FIND_IN_SET(theme_type_id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->themeTypeMaster, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected themetype  deleted successfully.");
			
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select at least one item to delete.");
		}
		return true;
	}
		
	private function batchViewtypestatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->viewTypeMaster, $idArray, 'view_type_status', $status, 'view_type_id');
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected theme type status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected theme type status Inactivated successfully.");
		}
		return true;
	}
	
	private function batchThemetypestatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->themeTypeMaster, $idArray, 'theme_type_status', $status, 'theme_type_id');
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected theme type status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected theme type status Inactivated successfully.");
		}
		return true;
	}
		
	
	/*********************************** for View Type end *****************************************/
	
	public function delete_property_banner()
	{
		$location_image_banner_id = $this->uri->segment(3, 0);
		$name = $this->uri->segment(4, 0);
		$delete_where =" location_image_id = ".$location_image_banner_id." ";
		
		//$rs_banner = $this->model_basic->getValues_conditions($this->locationImages, '', '', 'location_image_id ='.$location_image_banner_id);
		//$image_name = $rs_banner[0]['image_file_name'];
		$image_name = $name;
		
		if(($this->model_basic->deleteData($this->locationImages, $delete_where)))
		{
			if(file_exists(file_upload_absolute_path().'location/'.stripslashes($image_name)) && stripslashes($image_name) != "")
				unlink(file_upload_absolute_path().'location/'.stripslashes($image_name));
			if(file_exists(file_upload_absolute_path().'location/thumb/'.stripslashes($image_name)) && stripslashes($image_name) != "")	
			
				unlink(file_upload_absolute_path().'location/thumb/'.stripslashes($image_name));
		}
		
		return true;
		
	}
	
	
	public function property_outside_locations()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."property_locations/property_outside_locations/0/0/outside";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 6;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('PROPERTY_OUTSIDE_LOCATIONS');
		
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
		$page 				= $this->uri->segment(6,0);
		$this->data['propertyOutsideLocations']=$this->model_property_locations->getOutsideLocationList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_locations';	
		$this->data['base_url'] 	= BACKEND_URL."property_locations/property_outside_locations/0/1/outside/";				
		$this->data['show_all']      	= BACKEND_URL."property_locations/property_outside_locations/0/1/outside/";
		$this->data['add_url']      	= BACKEND_URL."property_locations/add_outside_location/0/".$page."/outside/";
		$this->data['edit_link']      	= BACKEND_URL."property_locations/edit_outside_location/{{ID}}/".$page."/outside/";
		$this->data['delete_link']	= BACKEND_URL."property_locations/delete_outside_locations/{{ID}}/".$page."/outside/";
		$this->data['batch_action_link']= BACKEND_URL."property_locations/outside_location_batch_action/0/".$page."/outside/";	

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/outside_locations';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	
	
	
	function is_outsidelocation1_exists($location1_title)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'title1' => $location1_title,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'title1' => $location1_title );
		}
		
		$bool = $this->model_basic->checkRowExists($this->propertyOutsideLocation, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_outsidelocation1_exists', 'One or all of the titles already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function is_outsidelocation2_exists($location2_title)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'title1' => $location2_title,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'title1' => $location2_title );
		}
		
		$bool = $this->model_basic->checkRowExists($this->propertyOutsideLocation, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_outsidelocation2_exists', 'One or all of the titles already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	
	function is_outsidelocation3_exists($location3_title)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'title1' => $location3_title,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'title1' => $location3_title );
		}
		
		$bool = $this->model_basic->checkRowExists($this->propertyOutsideLocation, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_outsidelocation3_exists', 'One or all of the titles already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function is_outsidelocation4_exists($location4_title)
	{		
		$id 	= $this->uri->segment(3, 0);
		if($id > 0){
			$whereArr	= array( 'title1' => $location4_title,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'title1' => $location4_title );
		}
		
		$bool = $this->model_basic->checkRowExists($this->propertyOutsideLocation, $whereArr);
		
		if($bool == 0){
			$this->form_validation->set_message('is_outsidelocation4_exists', 'One or all of the titles already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	
	
	
	public function add_outside_location()
	{
		
		chk_login();		
		$location_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		if($location_id > 0)
			$this->data['location_id']	= $location_id;
		else
			$this->data['location_id']	= 0;
			
		$this->data['controller']	= "property_locations";
		$this->data['return_link']  	= BACKEND_URL."property_locations/property_outside_locations/0/0/outside/";
		$this->data['add_link']  	= BACKEND_URL."property_locations/add_outside_location/0/0/outside/";
		$insertArr 		= array();
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('location1_title', 'Location1 title', 'required|callback_is_outsidelocation1_exists');
			$this->form_validation->set_rules('main_location', 'Main location', 'required');
			$this->form_validation->set_rules('location1_description', 'Location1 Description', 'trim|required');
			$this->form_validation->set_rules('location1_link', 'Location1 link', 'required');
			$this->form_validation->set_rules('location2_title', 'Location2 title', 'required|callback_is_outsidelocation2_exists');			
			$this->form_validation->set_rules('location2_description', 'Location2 Description', 'trim|required');
			$this->form_validation->set_rules('location2_link', 'Location2 Link', 'required');
			$this->form_validation->set_rules('location3_title', 'Location3 title', 'required|callback_is_outsidelocation3_exists');			
			$this->form_validation->set_rules('location3_description', 'Location3 Description', 'trim|required');
			$this->form_validation->set_rules('location3_link', 'Location3 Link', 'required');
			$this->form_validation->set_rules('location4_title', 'Location4 title', 'required|callback_is_outsidelocation4_exists');			
			$this->form_validation->set_rules('location4_description', 'Location4 description', 'trim|required');
			$this->form_validation->set_rules('location4_link', 'Location4 link', 'required');
						
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				
				$user_image = '';
			   if(($_FILES['location1Image']['name'] != "")&&($_FILES['location2Image']['name'] != "")&&($_FILES['location3Image']['name'] != "")&&($_FILES['location4Image']['name'] != ""))
				{
					
					$upload_config1['field_name']		= 'location1Image';
					$upload_config1['file_upload_path'] 	= 'outsidelocation/';
					$upload_config1['max_size']		= '';
					$upload_config1['max_width']		= '';
					$upload_config1['max_height']		= '';
					$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
					$thumb_config1['thumb_create']		= true;
					$thumb_config1['thumb_file_upload_path']= 'thumb/';
					$thumb_config1['thumb_width']		= '225';
					$thumb_config1['thumb_height']		= '150';
									
					//pr($upload_config,0);pr($thumb_config,0);
					//pr($_FILES,0);
					$user_image = '';
					$sUploaded1 = image_upload($upload_config1, $thumb_config1);
					
					$upload_config2['field_name']		= 'location2Image';
					$upload_config2['file_upload_path'] 	= 'outsidelocation/';
					$upload_config2['max_size']		= '';
					$upload_config2['max_width']		= '';
					$upload_config2['max_height']		= '';
					$upload_config2['allowed_types']	= 'jpg|jpeg|gif|png';
					$thumb_config2['thumb_create']		= true;
					$thumb_config2['thumb_file_upload_path']= 'thumb/';
					$thumb_config2['thumb_width']		= '225';
					$thumb_config2['thumb_height']		= '150';
					$sUploaded2 = image_upload($upload_config2, $thumb_config2);
					
					$upload_config3['field_name']		= 'location3Image';
					$upload_config3['file_upload_path'] 	= 'outsidelocation/';
					$upload_config3['max_size']		= '';
					$upload_config3['max_width']		= '';
					$upload_config3['max_height']		= '';
					$upload_config3['allowed_types']	= 'jpg|jpeg|gif|png';
					$thumb_config3['thumb_create']		= true;
					$thumb_config3['thumb_file_upload_path']= 'thumb/';
					$thumb_config3['thumb_width']		= '225';
					$thumb_config3['thumb_height']		= '150';
					$sUploaded3 = image_upload($upload_config3, $thumb_config3);
					
					$upload_config4['field_name']		= 'location4Image';
					$upload_config4['file_upload_path'] 	= 'outsidelocation/';
					$upload_config4['max_size']		= '';
					$upload_config4['max_width']		= '';
					$upload_config4['max_height']		= '';
					$upload_config4['allowed_types']	= 'jpg|jpeg|gif|png';
					$thumb_config4['thumb_create']		= true;
					$thumb_config4['thumb_file_upload_path']= 'thumb/';
					$thumb_config4['thumb_width']		= '225';
					$thumb_config4['thumb_height']		= '150';
					$sUploaded4 = image_upload($upload_config4, $thumb_config4);
					
					//pr($sUploaded,0);
					//pr($imageDim);
					
					if($sUploaded1 == '' || $sUploaded2==''|| $sUploaded3==''|| $sUploaded4=='')
					{
						$this->nsession->set_userdata('errmsg', 'there is a problem in upload');
						redirect(base_url()."property_locations/property_outside_locations/".$page."/");
						$region_id 	= addslashes(trim($this->input->get_post('region_id')));
						$insertArr 	=  array(
										'location_id'=>$this->input->get_post('main_location'),
										'title1'=>addslashes(trim($this->input->get_post('location1_title'))),
										'content1'=>addslashes(trim($this->input->get_post('location1_description'))),
										'link1'=>addslashes(trim($this->input->get_post('location1_link'))),
										'title2'=>addslashes(trim($this->input->get_post('location2_title'))),
										'content2'=>addslashes(trim($this->input->get_post('location2_description'))),
										'link2'=>addslashes(trim($this->input->get_post('location2_link'))),
										'title3'=>addslashes(trim($this->input->get_post('location3_title'))),
										'content3'=>addslashes(trim($this->input->get_post('location3_description'))),
										'link3'=>addslashes(trim($this->input->get_post('location3_link'))),
										'title4'=>addslashes(trim($this->input->get_post('location4_title'))),
										'content4'=>addslashes(trim($this->input->get_post('location4_description'))),
										'link4'=>addslashes(trim($this->input->get_post('location4_link'))),
																			
									);
						$ret = $this->model_basic->insertIntoTable($this->propertyOutsideLocation,$insertArr);
						if($ret)
						{
								$this->nsession->set_userdata('succmsg', "Outside Location added successfully.");
								redirect(base_url()."property_locations/property_outside_locations/0/0/outside");
						}
						else
							{
								$this->nsession->set_userdata('errmsg', "Unable to add Outside Location. Please try after some time.");
								redirect(base_url()."property_locations/property_outside_locations/0/0/outside");
								return false;
					
							}
					}
					else
					{						
						
						$insertArr 	=  array(
										'location_id'=>$this->input->get_post('main_location'),
										'title1'=>addslashes(trim($this->input->get_post('location1_title'))),
										'content1'=>addslashes(trim($this->input->get_post('location1_description'))),
										'link1'=>addslashes(trim($this->input->get_post('location1_link'))),
										'image1'=>$sUploaded1,
										'title2'=>addslashes(trim($this->input->get_post('location2_title'))),
										'content2'=>addslashes(trim($this->input->get_post('location2_description'))),
										'link2'=>addslashes(trim($this->input->get_post('location2_link'))),
										'image2'=>$sUploaded2,
										'title3'=>addslashes(trim($this->input->get_post('location3_title'))),
										'content3'=>addslashes(trim($this->input->get_post('location3_description'))),
										'link3'=>addslashes(trim($this->input->get_post('location3_link'))),
										'image3'=>$sUploaded3,
										'title4'=>addslashes(trim($this->input->get_post('location4_title'))),
										'content4'=>addslashes(trim($this->input->get_post('location4_description'))),
										'link4'=>addslashes(trim($this->input->get_post('location4_link'))),
										'image4'=>$sUploaded4
								     );
						$ret = $this->model_basic->insertIntoTable($this->propertyOutsideLocation,$insertArr);
						if($ret){
							$this->nsession->set_userdata('succmsg', "Outside Location added successfully.");
							redirect(base_url()."property_locations/property_outside_locations/0/0/outside/");
							return true;
						
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to add Location. Please try after some time.");
							
							redirect(base_url()."property_locations/property_outside_locations/0/0/outside/");
							return false;
						}
					}
				
					
				}
				
						else
						{
							
							$this->nsession->set_userdata('errmsg', "All the outside Location image(s) are  mandatory.");			
							redirect(base_url()."property_locations/property_outside_locations");
							return true;
						}   
													
						
				
			}
			
			
		}		
		
                //$row = array();		
		$this->data['locations'] = $this->model_basic->getValues_conditions($this->propertyLocationsTable,'*', '','location_status = "active"','location_name', 'ASC');
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/outside_locations_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function edit_outside_location()
	{
		
		chk_login();		
		$location_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		$type=$this->uri->segment(5);
		$this->data['controller']	= "property_locations";
		if($type=='outside')
		{
			
			$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/property_outside_locations/0/0/".$type;
			$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_outside_location/".$location_id."/".$page."/".$type;
			
		}
		elseif($type=='location')
		{
			
			$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/0/0/".$type;
			$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_outside_location/".$location_id."/".$page."/".$type;
			
		}
		
		
		$insertArr 		= array();
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('location1_title', 'Location1 title', 'required');
			//$this->form_validation->set_rules('main_location', 'Main location', 'required');
			$this->form_validation->set_rules('location1_description', 'Location1 Description', 'trim|required');
			$this->form_validation->set_rules('location1_link', 'Location1 link', 'required');
			$this->form_validation->set_rules('location2_title', 'Location2 title', 'required');			
			$this->form_validation->set_rules('location2_description', 'Location2 Description', 'trim|required');
			$this->form_validation->set_rules('location2_link', 'Location2 Link', 'required');
			$this->form_validation->set_rules('location3_title', 'Location3 title', 'required');			
			$this->form_validation->set_rules('location3_description', 'Location3 Description', 'trim|required');
			$this->form_validation->set_rules('location3_link', 'Location3 Link', 'required');
			$this->form_validation->set_rules('location4_title', 'Location4 title', 'required');			
			$this->form_validation->set_rules('location4_description', 'Location4 description', 'trim|required');
			$this->form_validation->set_rules('location4_link', 'Location4 link', 'required');
			
			
			//$this->form_validation->set_rules('locationImage', 'Location Image', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				if( ($_FILES['location4Image']['tmp_name']=='') && ($_FILES['location3Image']['tmp_name']=='') && ($_FILES['location2Image']['tmp_name']=='') && ($_FILES['location1Image']['tmp_name'])=='' )
				{			
					$updateArr =  array(
							'location_id'=>$this->input->get_post('main_location'),
							'title1'=>addslashes(trim($this->input->get_post('location1_title'))),
							'content1'=>addslashes(trim($this->input->get_post('location1_description'))),
							'content2'=>addslashes(trim($this->input->get_post('location2_description'))),
							'content3'=>addslashes(trim($this->input->get_post('location3_description'))),
							'content4'=>addslashes(trim($this->input->get_post('location4_description'))),
							'link1'=>addslashes(trim($this->input->get_post('location1_link'))),
							'title2'=>addslashes(trim($this->input->get_post('location2_title'))),
							'link2'=>addslashes(trim($this->input->get_post('location2_link'))),
							'title3'=>addslashes(trim($this->input->get_post('location3_title'))),
							'link3'=>addslashes(trim($this->input->get_post('location3_link'))),
							'title4'=>addslashes(trim($this->input->get_post('location4_title'))),
							'link4'=>addslashes(trim($this->input->get_post('location4_link'))),
						 );
					//pr($updateArr);	
					$idArr	= array('id' => $location_id);
					$ret 	= $this->model_basic->updateIntoTable($this->propertyOutsideLocation,$idArr,$updateArr);
					//if($ret)
					//{
					//	$this->nsession->set_userdata('succmsg', "Outside Location updated successfully.");
					//	redirect(base_url()."property_locations/property_outside_locations");
					//}
					//else
					//{
					//	$this->nsession->set_userdata('errmsg', "Unable to edit Outside Location. Please try after some time.");
					//					
					//}
					$this->nsession->set_userdata('succmsg', "Location updated successfully.");
					if($type=='outside')
					{
						redirect(base_url()."property_locations/property_outside_locations/0/0/".$type);
						return true;
					}
					elseif($type=='location')
					{
						redirect(base_url()."property_locations/index/0/0/".$type);
						return true;
					}
						
				}
				else
				{
				
					$Condition = "id = '".$location_id."' AND status='active'";
					$outsidelocations = $this->model_basic->getValues_conditions($this->propertyOutsideLocation,'*', '',$Condition);
					$imgUp1 = $outsidelocations[0]['image1'];
					$imgUp2 = $outsidelocations[0]['image2'];
					$imgUp3 = $outsidelocations[0]['image3'];
					$imgUp4 = $outsidelocations[0]['image4'];
					
					if(file_exists($_FILES['location1Image']['tmp_name']))
					{	
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image1'])) && stripslashes($outsidelocations[0]['image1']) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image1']));
						}
						
						if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image1'])) && stripslashes($outsidelocations[0]['image1']) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image1']));
						}
						$upload_config1['field_name']		= 'location1Image';
						$upload_config1['file_upload_path'] 	= 'outsidelocation/';
						$upload_config1['max_size']		= '';
						$upload_config1['max_width']		= '';
						$upload_config1['max_height']		= '';
						$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';					
						$thumb_config1['thumb_create']		= true;
						$thumb_config1['thumb_file_upload_path']= 'thumb/';
						$thumb_config1['thumb_width']		= '225';
						$thumb_config1['thumb_height']		= '150';
						
						$sUploaded1 = image_upload($upload_config1, $thumb_config1);
						if( isset($sUploaded1) && $sUploaded1 != '' )
							$imgUp1 = $sUploaded1;
					}
						
						
					if(file_exists($_FILES['location2Image']['tmp_name']))
					{
						
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image2'])) && stripslashes($outsidelocations[0]['image2']) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image2']));
						}
						
						if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image2'])) && stripslashes($outsidelocations[0]['image2']) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image2']));
						}
						$upload_config1['field_name']		= 'location2Image';
						$upload_config1['file_upload_path'] 	= 'outsidelocation/';
						$upload_config1['max_size']		= '';
						$upload_config1['max_width']		= '';
						$upload_config1['max_height']		= '';
						$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
						$thumb_config1['thumb_create']		= true;
						$thumb_config1['thumb_file_upload_path']= 'thumb/';
						$thumb_config1['thumb_width']		= '225';
						$thumb_config1['thumb_height']		= '150';
						$sUploaded2 = image_upload($upload_config1, $thumb_config1);
						if( isset($sUploaded2) && $sUploaded2 != '' )
							$imgUp2 = $sUploaded2;
						
					}
						
						
					if(file_exists($_FILES['location3Image']['tmp_name']))
					{
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image3'])) && stripslashes($outsidelocations[0]['image3']) != ""){
							unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image3']));
					}
					
						if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image3'])) && stripslashes($outsidelocations[0]['image3']) != ""){
							unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image3']));
					}
					
						$upload_config1['field_name']		= 'location3Image';
						$upload_config1['file_upload_path'] 	= 'outsidelocation/';
						$upload_config1['max_size']		= '';
						$upload_config1['max_width']		= '';
						$upload_config1['max_height']		= '';
						$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
						$thumb_config1['thumb_create']		= true;
						$thumb_config1['thumb_file_upload_path']= 'thumb/';
						$thumb_config1['thumb_width']		= '225';
						$thumb_config1['thumb_height']		= '150';
						$sUploaded3 = image_upload($upload_config1, $thumb_config1);
						if( isset($sUploaded3) && $sUploaded3 != '' )
							$imgUp3 = $sUploaded3;
						
					}
						
						
						
					if(file_exists($_FILES['location4Image']['tmp_name']))
					{
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image4'])) && stripslashes($outsidelocations[0]['image4']) != ""){
							unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($outsidelocations[0]['image4']));
						}
						
						if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image4'])) && stripslashes($outsidelocations[0]['image4']) != ""){
							unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($outsidelocations[0]['image4']));
						}
							
							
						$upload_config1['field_name']		= 'location4Image';
						$upload_config1['file_upload_path'] 	= 'outsidelocation/';
						$upload_config1['max_size']		= '';
						$upload_config1['max_width']		= '';
						$upload_config1['max_height']		= '';
						$upload_config1['allowed_types']	= 'jpg|jpeg|gif|png';
						$thumb_config1['thumb_create']		= true;
						$thumb_config1['thumb_file_upload_path']= 'thumb/';
						$thumb_config1['thumb_width']		= '225';
						$thumb_config1['thumb_height']		= '150';
						$sUploaded4 = image_upload($upload_config1, $thumb_config1);
						if( isset($sUploaded4) && $sUploaded4 != '' )
							$imgUp4 = $sUploaded4;	
					}
						
				
					
					
				
					$updateArr 	=  array(
						'location_id'=>$this->input->get_post('main_location'),
						'title1'=>addslashes(trim($this->input->get_post('location1_title'))),
						'content1'=>addslashes(trim($this->input->get_post('location1_description'))),
						'link1'=>addslashes(trim($this->input->get_post('location1_link'))),
						'title2'=>addslashes(trim($this->input->get_post('location2_title'))),
						'content2'=>addslashes(trim($this->input->get_post('location2_description'))),
						'link2'=>addslashes(trim($this->input->get_post('location2_link'))),
						'title3'=>addslashes(trim($this->input->get_post('location3_title'))),
						'link3'=>addslashes(trim($this->input->get_post('location3_link'))),
						'content3'=>addslashes(trim($this->input->get_post('location3_description'))),
						'title4'=>addslashes(trim($this->input->get_post('location4_title'))),
						'link4'=>addslashes(trim($this->input->get_post('location4_link'))),
						'content4'=>addslashes(trim($this->input->get_post('location4_description'))),
						'image1'=>$imgUp1,
						'image2'=>$imgUp2,
						'image3'=>$imgUp3,
						'image4'=>$imgUp4
						);
					//pr($updateArr);	
					$idArr		= array('id' => $location_id);
					$ret = $this->model_basic->updateIntoTable($this->propertyOutsideLocation,$idArr,$updateArr);
					if($ret)
					{
						$this->nsession->set_userdata('succmsg', "Location updated successfully.");
						if($type=='outside')
						{
							redirect(base_url()."property_locations/property_outside_locations/0/0/".$type);
							return true;
						}
						elseif($type=='location')
						{
							redirect(base_url()."property_locations/index/0/0/".$type);
							return true;
						}
						
						
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to edit Outside Location. Please try after some time.");
						if($type=='outside')
						{
							redirect(base_url()."property_locations/property_outside_locations/0/0/".$type);
							return false;
						}
						elseif($type=='location')
						{
							redirect(base_url()."property_locations/index/0/0/".$type);
							return false;
						}
						
						
						
											
					}

				
				}
				
			}
			
			
		}		
		
                //$row = array();
				
				
		$this->data['locations'] = $this->model_basic->getValues_conditions($this->propertyLocationsTable,'*', '','location_status = "active"','location_name', 'ASC');
		$Condition = "id = '".$location_id."' AND status='active'";
					
		$this->data['outsidelocations'] = $this->model_basic->getValues_conditions($this->propertyOutsideLocation,'*', '',$Condition);
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		$this->data['pagination'] = $this->pagination->create_links();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_locations/outside_locations_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
	
	
	public function outside_location_batch_action()
	{
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteOutsidelocationbatch($pagearray);
		} else if($action == 'Activate')
		{
			$this->batchOutsidelocationstatus('active', $pagearray);
		} else if($action == 'Inactivate')
		{ 
			$this->batchOutsidelocationstatus('inactive', $pagearray);
		} else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."property_locations/property_outside_locations/".$page."/0/outside/");
		return true;
			
	}
	
	private function batchOutsidelocationstatus($status, $idArray)
	{
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus($this->propertyOutsideLocation, $idArray, 'status', $status, 'id');
		
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->nsession->set_userdata('succmsg', "Selected outside location status Activated successfully.");
		}elseif($return == 'active'){
			$this->nsession->set_userdata('succmsg', "Selected outside location status Inactivated successfully.");
		}
		return true;
	}
	
	private function deleteOutsidelocationbatch($pagearray)
	{
		$page = $this->uri->segment(4, 0);
		if(is_array($pagearray))
		{
			//pr($pagearray);
			
			foreach($pagearray as $singlerecordid)
			{
					$Condition = "id = '".$singlerecordid."'";
					$rs = $this->model_basic->getValues_conditions($this->propertyOutsideLocation, '', '', $Condition);
					
					for($i=1;$i<=4;$i++)
					{
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($rs[0]['image'.$i])) && stripslashes($rs[0]['image'.$i]) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($rs[0]['image'.$i]));
						}
						
						if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($rs[0]['image'.$i])) && stripslashes($rs[0]['image'.$i]) != "")
						{
							unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($rs[0]['image'.$i]));
						}
					
					
					
					}
			
				
			}
									
				$delete_where	= "FIND_IN_SET(id, '".implode(",", $pagearray)."')";
				$this->model_basic->deleteData($this->propertyOutsideLocation, $delete_where);
				$this->nsession->set_userdata('succmsg', "Selected outside location(s)  deleted successfully.");
				redirect(BACKEND_URL."property_locations/property_outside_locations/");
			
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select at least one item to delete.");
			redirect(BACKEND_URL."property_locations/property_outside_locations/");
		}
		return true;
	}
	
	
	
	public function delete_outside_locations()
	{
			chk_login();
			$id	= $this->uri->segment(3);
			
			
			$Condition = "id = '".$id."'";
			$rs = $this->model_basic->getValues_conditions($this->propertyOutsideLocation, '', '', $Condition);
			//pr($rs[0]['image1']);
			for($i=1;$i<=4;$i++)
			{
						if(file_exists(file_upload_absolute_path().'outsidelocation/'.stripslashes($rs[0]['image'.$i])) && stripslashes($rs[0]['image'.$i]) != "")
								{
									unlink(file_upload_absolute_path().'outsidelocation/'.stripslashes($rs[0]['image'.$i]));
								}
								
															
								if(file_exists(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($rs[0]['image'.$i])) && stripslashes($rs[0]['image'.$i]) != "")
								{
									unlink(file_upload_absolute_path().'outsidelocation/thumb/'.stripslashes($rs[0]['image'.$i]));
								}
				
			}
			$delete_where = "id = '".$id."'";
			$this->model_basic->deleteData($this->propertyOutsideLocation, $delete_where);
			$this->nsession->set_userdata('succmsg', "Selected outside location deleted successfully.");
		 		
		//redirect(BACKEND_URL."property_locations/property_outside_locations/");
		redirect(BACKEND_URL."property_locations/property_outside_locations/0/0/outside/");
		return true;
	}
	

}