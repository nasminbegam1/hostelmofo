<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Map_location extends CI_Controller
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
		
	public function property_map_location()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."map_location/property_map_location/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('MAP_LOCATION');
		
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
		
		$this->data['propertyMapList']	= $this->model_property_settings->getMapList($config,$start);
		
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'map_location';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/property_map_location/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/property_map_location/0/1/";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_map_location/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_map_location/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_map_location/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_map_location/types';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	public function edit_map_location()
	{
		chk_login();
		
		$property_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "map_location";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_map_location/".$property_type_id."/".$page."/";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/property_map_location/";
		$fields[0]			= 'location_id';
		$fields[1]			= 'location_name';
		$this->data['location_list']	= $this->model_basic->getValues_conditions('lp_location_master',$fields,'','','location_name');
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$location_name	= addslashes(trim($this->input->get_post('location_name')));
				$latitude	= addslashes(trim($this->input->get_post('latitude')));
				$longitude	= addslashes(trim($this->input->get_post('longitude')));
				$location_type	= addslashes(trim($this->input->get_post('location_type')));
				$status		= addslashes(trim($this->input->get_post('status')));
				if($location_type == 'beach')
					$location_id	= 	addslashes(trim($this->input->get_post('location_id')));
				else
					$location_id	=	0;
					
				$insertArr  =  array(
							'location_name' => $location_name,
							'latitude' 	=> $latitude,
							'longitude' 	=> $longitude,
							'location_type' => $location_type,
							'location_id' 	=> $location_id,
							'status' 	=> $status
						);
				
				$idArr		= array(
							'id' => $property_type_id
							);
				
				$ret   = $this->model_basic->updateIntoTable('lp_property_map_location',$idArr, $insertArr);
				//if($ret)
				//{
				//	$this->nsession->set_userdata('succmsg', "Property Map Location updated successfully.");
				//}
				//else
				//{
				//	$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				//}
				$this->nsession->set_userdata('succmsg', "Property Map Location updated successfully.");
				redirect(BACKEND_URL."map_location/property_map_location/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " id = '".$property_type_id."'";
		$rs = $this->model_basic->getValues_conditions('lp_property_map_location', '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['property_map_details'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/types/".$page."/");
                        return false;
                }

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='property_map_location/type_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
	
	public function delete_map_location()
	{
		chk_login();
		
		$property_type_id	= $this->uri->segment(3);
		$where			= "id = '".$property_type_id."'";
		
		$this->model_basic->deleteData('lp_property_map_location', $where);
		$this->nsession->set_userdata('succmsg', "Selected property map location deleted successfully.");
				
		redirect(BACKEND_URL."map_location/property_map_location/");
		return true;
	}
	
	public function add_map_location()
	{
		chk_login();
		
		$property_type_id	= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "map_location";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/property_map_location/";
		$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_map_location/0/".$page."/";
		$fields[0]			= 'location_id';
		$fields[1]			= 'location_name';
		$this->data['location_list']	= $this->model_basic->getValues_conditions('lp_location_master',$fields,'','','location_name');
		
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|callback_is_name_exists');
			$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
				
			} else {
				$location_name	= addslashes(trim($this->input->get_post('location_name')));
				$latitude	= addslashes(trim($this->input->get_post('latitude')));
				$longitude	= addslashes(trim($this->input->get_post('longitude')));
				$location_type	= addslashes(trim($this->input->get_post('location_type')));
				$status		= addslashes(trim($this->input->get_post('status')));
				if($location_type == 'beach')
					$location_id	= 	addslashes(trim($this->input->get_post('location_id')));
				else
					$location_id	=	0;
				
				$insertArr  =  array(
							'location_name' => $location_name,
							'latitude' 	=> $latitude,
							'longitude' 	=> $longitude,
							'location_type' => $location_type,
							'location_id' 	=> $location_id,
							'status' 	=> $status
						);
							    
				$ret   = $this->model_basic->insertIntoTable('lp_property_map_location',$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Property Map Location added successfully.");	
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add Property Types. Please try again later.");
				}
    
				redirect(BACKEND_URL."map_location/property_map_location/".$page."/");
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
		
		$this->elements['middle']='property_map_location/type_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
}