<?php
class Property_type extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_property_type");
	$this->load->library('image_lib');
	$this->load->library('cdnupload');
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	        $config['base_url'] 	= BACKEND_URL."property_type/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('PROPERTY_TYPE_SEARCH');
		
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
		$this->data['propertyTypeList']	= $this->model_property_type->getList($config,$start);
		$this->data['startRecord'] 	= $start;
               
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'property_type';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_property_type/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_property_type/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_property_type/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
	$this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Property Type List','link'=>'javascript:void();'),
				     );	
	
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property_type/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
	$id 		= $this->uri->segment(3, 0);
	$property_type_name	= strip_tags(addslashes(trim($this->input->get_post('property_type_name'))));
	
	$whereArr	= array();
	if($id > 0){
		$whereArr	= array( 'property_type_name' => $property_type_name,
					 'property_type_id != ' => $id						
					);
	}else{			
		$whereArr	= array( 'property_type_name' => $property_type_name );
	}
	$bool 	= $this->model_basic->checkRowExists(PROPERTY_TYPE, $whereArr );	
	if($bool == 0){
		$this->form_validation->set_message('is_name_exists', 'The %s already exists');
		return FALSE;
	}else{
		return TRUE;
	}
    }
    
    public function add_property_type()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	        $property_type_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "property_type";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		$this->data['city_list'] = $this->model_basic->getValues_conditions(CITY,'','','status="Active"','city_name','asc');
               // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('property_type_name', 'Property Type Name', 'trim|required|callback_is_name_exists');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
                                
				$property_type_name     = addslashes($this->input->post('property_type_name'));
                                $property_type_slug     = create_slug(addslashes($this->input->post('property_type_name')));
				$property_type_status	= addslashes($this->input->post('property_type_status'));
				$meta_title		= addslashes($this->input->post('meta_title'));
				$meta_key		= addslashes($this->input->post('meta_key'));
				$meta_description	= addslashes($this->input->post('meta_description'));
				$property_description = addslashes($this->input->post('property_description'));
				$city_list_str = '';
				if($this->input->post('city_name'))
				{
				    $city_list_str		= addslashes( implode(',',$this->input->post('city_name')) );
				    
				}
				$new_banner_image ='';
				if(is_array($_FILES) and count($_FILES['property_img'])>0 and $_FILES['property_img']['tmp_name']!=''){
			
				    $tmp_name = $_FILES['property_img']['tmp_name'];
				    list($width, $height, $type, $attr) = getimagesize($tmp_name);
				    
				//    if($width < 800 or $height < 600){
				//	$this->nsession->set_userdata('errmsg','Banner Photo height width may lower than 800*600');
				//	redirect('property_type/add_property_type/'.$property_type_id);
				//    }else{
					
					$file_name = $_FILES['property_img']['name'];
					$new_banner_image = $this->cdnupload->getFileNewName($file_name);
					    
					$config 	= array(
							    'image_library' 	=> 'GD2',
							    'source_image'	=> $tmp_name,
							    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property_type/banner/'.$new_banner_image
							    
							);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/property_type/banner/'.$new_banner_image;
					$this->cdnupload->upload($file,'property_type/banner',$new_banner_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property_type/banner/'.$new_banner_image);
					
				    //}
						
				}
				
				$listing_image = '';
				if(is_array($_FILES) and count($_FILES['property_list_img']) > 0 and $_FILES['property_list_img']['tmp_name']!=''){
				    
				    $tmp_name = $_FILES['property_list_img']['tmp_name'];
				    
					
				    $file_name = $_FILES['property_list_img']['name'];
				    $listing_image = $this->cdnupload->getFileNewName($file_name);
					
				    $config 	= array(
							'image_library' 	=> 'GD2',
							'source_image'		=> $tmp_name,
							'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property_type/listing/'.$listing_image,
							'width'			=> 300,
							'height'		=> 200
						    );
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    
				    $file = FRONTEND_URL.'upload/property_type/listing/'.$listing_image;
				    $this->cdnupload->upload($file,'property_type/listing',$listing_image);
				    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property_type/listing/'.$listing_image);
					
				    
						
				}

				$insertArr  =  array(
							'property_type_name'	        => $property_type_name,
							'property_type_slug'	        => $property_type_slug,
							'status'           		=> $property_type_status,
							'property_description'          => $property_description,
							'meta_title'                    => $meta_title,
							'meta_keyword'                  => $meta_key,
							'meta_description'              => $meta_description,
							'property_banner_image'         => $new_banner_image,
							'property_listing_image'        => $listing_image,
							'fav_cities'                    => $city_list_str
						);
			    
				$res = $this->model_basic->insertIntoTable(PROPERTY_TYPE,$insertArr);
				if($res)
				{
					$this->nsession->set_userdata('succmsg', "Property Type Added Successfuly.");
					redirect(base_url()."property_type/");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable to Add Property Type");
					redirect(base_url()."property_type/");
				}
			}
		}
		
		$this->data['propertyTypeid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
        
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_property_type/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	 //For breadcrump..........
	 $this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-home','name'=>'Property Type','link'=>$this->data['base_url']),
				     array('logo'=>'fa fa-plus-circle','name'=>'Add','link'=>'javascript:void();'),
				     );	

				     
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property_type/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_property_type()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$property_type_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "property_type";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
		$this->data['city_list'] = $this->model_basic->getValues_conditions(CITY,'','','status="Active"','city_name','asc');
		if($this->input->get_post('action') == 'Process'){			
	     $this->form_validation->set_rules('property_type_name', 'Property Type Name','trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			}
			else
			{                    
				$property_type_name     = addslashes($this->input->post('property_type_name'));
                                $property_type_slug     = create_slug(addslashes($this->input->post('property_type_name')));
				$property_type_status	= addslashes($this->input->post('property_type_status'));
				$meta_title		= addslashes($this->input->post('meta_title'));
				$meta_key		= addslashes($this->input->post('meta_key'));
				$meta_description	= addslashes($this->input->post('meta_description'));
				$property_description = addslashes($this->input->post('property_description'));
				$city_list_str = '';
				if($this->input->post('city_name'))
				{
				    $city_list_str		= addslashes( implode(',',$this->input->post('city_name')) );
				}
				
				$new_banner_image ='';
				
				if(is_array($_FILES) and count($_FILES['property_img'])>0 and $_FILES['property_img']['tmp_name']!=''){
			
				    $tmp_name = $_FILES['property_img']['tmp_name'];
				    list($width, $height, $type, $attr) = getimagesize($tmp_name);
				    
				//    if($width < 800 or $height < 600){
				//	$this->nsession->set_userdata('errmsg','Banner Photo height width may lower than 800*600');
				//	redirect('property_type/edit_property_type/'.$property_type_id);
				//    }else{
					
					$file_name = $_FILES['property_img']['name'];
					$new_banner_image = $this->cdnupload->getFileNewName($file_name);
					    
					$config 	= array(
							    'image_library' 	=> 'GD2',
							    'source_image'	=> $tmp_name,
							    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property_type/banner/'.$new_banner_image
							    
							);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/property_type/banner/'.$new_banner_image;
					$this->cdnupload->upload($file,'property_type/banner',$new_banner_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property_type/banner/'.$new_banner_image);
					
				    //}
						
				}
				
				$listing_image = '';
				if(is_array($_FILES) and count($_FILES['property_list_img'])>0 and $_FILES['property_list_img']['tmp_name']!=''){
				    
				    $tmp_name = $_FILES['property_list_img']['tmp_name'];
				    
					
				    $file_name = $_FILES['property_list_img']['name'];
				    $listing_image = $this->cdnupload->getFileNewName($file_name);
					
				    $config 	= array(
							'image_library' 	=> 'GD2',
							'source_image'		=> $tmp_name,
							'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property_type/listing/'.$listing_image,
							'width'			=> 300,
							'height'		=> 200
						    );
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    
				    $file = FRONTEND_URL.'upload/property_type/listing/'.$listing_image;
				    $this->cdnupload->upload($file,'property_type/listing',$listing_image);
				    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property_type/listing/'.$listing_image);
					
				    
						
				}
						

					$insertArr  =  array(
						'property_type_name'	        => $property_type_name,
						'property_type_slug'	        => $property_type_slug,
						'status'           		=> $property_type_status,
						'property_description'          => $property_description,
						'meta_title'                    => $meta_title,
						'meta_keyword'                  => $meta_key,
						'meta_description'              => $meta_description,
						'fav_cities'                    => $city_list_str
					);
				    if($new_banner_image!=''){
					$insertArr['property_banner_image'] = $new_banner_image;
				    }
				    
				    if($listing_image!=''){
					$insertArr['property_listing_image'] = $listing_image;
				    }
					//pr($insertArr);
					
					$idArr		= array(
								'property_type_id' => $property_type_id
								);

					$ret   = $this->model_basic->updateIntoTable(PROPERTY_TYPE,$idArr, $insertArr);
					if(isset($ret))
					{
						$this->nsession->set_userdata('succmsg', "Property Type updated successfully.");
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
					}
					redirect(BACKEND_URL."property_type/index/".$page."/");
					return true;
				
				
				
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " property_type_id = '".$property_type_id."'";
		$rs = $this->model_basic->getValues_conditions(PROPERTY_TYPE, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_property_type'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_property_type/".$page."/");
                        return false;
                }
	
	         //For breadcrump..........

	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_property_type/".$property_type_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	$this->data['brdLink']=array(
			    array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			    array('logo'=>'fa fa-home','name'=>'Property Type','link'=>$this->data['base_url']),
			    array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();'),
			    );	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property_type/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_property_type()
    {
		$id = $this->uri->segment(3, 0);
		
		if($id!=NULL)
		{
			$Condition = " property_type_id = '".$id."'";
			$rs = $this->model_basic->isRecordExist(PROPERTY_MASTER, $Condition);
			if($rs >0){
			    $this->nsession->set_userdata('errmsg', "Unable to Delete Property Type.This Property Type is used in different place.");
			    redirect(base_url()."property_type/");
			}else{
			    $delete_where	= "FIND_IN_SET(property_type_id, '".$id."')";
			    $res = $this->model_basic->deleteData(PROPERTY_TYPE, $delete_where);
			    if($res)
			    {
				$this->nsession->set_userdata('succmsg', "Property Type Deleted Successfuly.");
				redirect(base_url()."property_type/");
			    }
			    else
			    {
				$this->nsession->set_userdata('errmsg', "Unable to Delete Property Type");
				redirect(base_url()."property_type/");
			    }
			}
		}
   }
   
     public function change_status(){
	$type_id = $this->input->post('id');
	$alias		= '';
	$condition	= "property_type_id = '".$type_id."'";
	$rec = $this->model_basic->getValues_conditions(PROPERTY_TYPE, '', $alias, $condition);
	if(is_array($rec) and count($rec)>0){
	    $rec =$rec[0];
	   $status = $rec['status'];
	   $new_status ='';
	   if($status=='Active'){
	     $new_status = 'Inactive';
	   }
	   else if($status=='Inactive'){
	     $new_status = 'Active';
	   }
	   
	    $updateArr  =  array('status' => $new_status);
		     
	    $idArr      = array('property_type_id' => $type_id);
     
	    $ret   = $this->model_basic->updateIntoTable(PROPERTY_TYPE,$idArr, $updateArr);
	}
    }
    
  
}
?>