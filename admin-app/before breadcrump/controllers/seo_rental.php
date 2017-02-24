<?php
class Seo_rental extends CI_Controller
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
	var $lp_region_master = 'lp_region_master';
	var $lp_location_master = 'lp_location_master';
	var $seo_landing_table 	= 'lp_seo_landing';
        
        
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_seo_landing');
		
	}
        
    public function listing()
    {
         chk_login();
        $this->data='';
        
        //<!-----------code--------------------->
                $config['base_url'] 	= BACKEND_URL."seo_rental/listing/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']	= $this->nsession->userdata('TYPE_SEARCH');
		
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
		$this->data['landingList']	= $this->model_seo_landing->getList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
                
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'seo_rental';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/listing/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/listing/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_types/0/".$page."/";
		//$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_types/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_types/{{ID}}/".$page."/";
		$this->data['batch_action_link']= BACKEND_URL.$this->data['controller']."/batch_action/0/".$page."/";
        
        //<!----------code---------------------->
        
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
           
        $this->data['controller'] 		= 'seo_rental';   
        $this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
       
        
        $this->data['brdLink']='';
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='seo_rental/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_types()
    {
        chk_login();
        $this->data='';
        $seo_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
        $this->data['controller'] 		= 'seo_rental';
        //<!--------code--------->
        
        if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				$page_title	= addslashes(trim($this->input->get_post('page_title')));
				$name	= addslashes(trim($this->input->get_post('name')));
				$meta_keyword	= addslashes(trim($this->input->get_post('meta_keyword')));
				$meta_description	= addslashes(trim($this->input->get_post('meta_description')));
				$content	= addslashes(trim($this->input->get_post('content')));
				$type	= addslashes(trim($this->input->get_post('type')));
				$insertArr  =  array(
							'page_title' => $page_title,
							'name' => $name,
							'meta_keyword' => $meta_keyword,
							'meta_description' => $meta_description,
							'content' => $content,
							'updated_on' => date('Y-m-d h:m:s'),
						);
				
				$idArr		= array(
							'seo_id' => $seo_id
							);
				
				$ret   = $this->model_basic->updateIntoTable($this->seo_landing_table,$idArr, $insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Landing Page updated successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."seo_rental/listing/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " seo_id = '".$seo_id."'";
		$rs = $this->model_basic->getValues_conditions($this->seo_landing_table, '', '', $Condition);
		$type_name = '';
		$row = $rs[0];
                if($row){
		     $type_id = $row['type_id'];
		    if($row['type']=='property'){
			$type_id_arr = explode('__',$row['type_id']);
			$name = '';
			
			foreach($type_id_arr as $id){
				if(!empty($id)){
					 $name .=  $this->model_basic->getValue_condition($this->propertyTypeMaster, "property_name",'', 'property_type_id='.$id) . ' and ';
				}
			}
			
			$type_name = rtrim($name,'and ');
		    }
		   
		   if($row['type']=='location'){
			$type_name =  $this->model_basic->getValue_condition($this->lp_location_master, "location_name",'', 'location_id='.$type_id);
			
		   }
		   if($row['type']=='region'){
			 $type_name =  $this->model_basic->getValue_condition($this->lp_region_master, "region_name",'', 'region_id='.$type_id);			
		   }
		    $this->data['type_name'] = $type_name;
                    $this->data['landing_page_data'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/");
                        return false;
                }
        
        
        //<!--------code--------->
        
        
        $this->data['edit_url']      	= BACKEND_URL.$this->data['controller']."/edit_types/".$seo_id."/".$page."/";
        $this->data['brdLink']='';
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/listing/0/1/";	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='seo_rental/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function add()
    {
        chk_login();
        $this->data='';
        $type = $this->uri->segment(3);
	
        $this->data['controller'] 		= 'seo_rental';
        
        //<!--------------code----------------------->
        
        		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
			
			$this->form_validation->set_rules('type_id', 'Location', 'trim|required');			
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
                           
				$page_title	= addslashes(trim($this->input->get_post('page_title')));
				$name	= addslashes(trim($this->input->get_post('name')));
				$meta_keyword	= addslashes(trim($this->input->get_post('meta_keyword')));
				$meta_description	= addslashes(trim($this->input->get_post('meta_description')));
				$content	= addslashes(trim($this->input->get_post('content')));
				$type	= addslashes(trim($this->input->get_post('type')));
				$type_id	= addslashes(trim($this->input->get_post('type_id')));
				$insertArr  =  array(
							'type_id' => $type_id,
							'page_title' => $page_title,
							'name' => $name,
							'type' => $type,
							'meta_keyword' => $meta_keyword,
							'meta_description' => $meta_description,
							'content' => $content,
							'updated_on' => date('Y-m-d h:m:s'),
						);
				$condition = " type_id = ".$type_id." AND type = '".$type."'";
				$is_exist = $this->model_basic->isRecordExist($this->seo_landing_table, $condition , '', '');
				
				if($is_exist){
                                     
					$this->nsession->set_userdata('errmsg', "This ".strtoupper($type)." already exist. Please select another.");
					redirect(BACKEND_URL."seo_rental/listing");
					return false;
				}else{

					$ret   = $this->model_basic->insertIntoTable($this->seo_landing_table, $insertArr);
					if($ret)
					{
						$this->nsession->set_userdata('succmsg', "Landing Page Added successfully.");
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to Add Record. Please try again later.");
					}
					redirect(BACKEND_URL."seo_rental/listing");
					return true;
				}
			}
		}		
		$region_arr = array();
		if($type == 'region'){
		    $Condition = " region_status = 'active'";
		    $rs = $this->model_basic->getValues_conditions($this->lp_region_master, '', '', $Condition);
		    foreach($rs as $row){
		    $region_arr[$row['region_id']] = $row['region_name'];
		    }
		    $this->data['region_data'] = $region_arr;
		}
		 $location_arr = array();
		if($type == 'location'){
		   
		    $Condition = " location_status = 'active'";
		    $rs = $this->model_basic->getValues_conditions($this->lp_location_master, '', '', $Condition);
		    foreach($rs as $row){
		    $location_arr[$row['location_id']] = $row['location_name'];
		    }
		    $this->data['location_data'] = $location_arr;
		}
		if(count($location_arr)==0 AND count($region_arr)==0){
			$this->nsession->set_userdata('errmsg', "Unable to Add Record. Please try again later.");
			redirect(BACKEND_URL."seo_rental/listing");
		}
        
        
        
        
        
        
        //<!--------------code----------------------->
        
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add/".$type;
        $this->data['brdLink']='';
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/listing/0/1/";	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='seo_rental/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
}
?>