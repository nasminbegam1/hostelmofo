<?php
class City extends MY_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_city");
	$this->load->model("model_property_type");
	$this->load->library('cdnupload');
	$this->load->library('image_lib');
    }
    
     public function index()
    {
        chk_login();
	
        $this->data='';
        
        //<!----------------------code------------------------->
        
	$config['base_url'] 	= BACKEND_URL.currentClass()."/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	$this->data['params']		= $this->nsession->userdata('CITY_MASTER_SEARCH');
	
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
	$this->data['cityList']	= $this->model_city->getList($config,$start);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= currentClass();	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_city/0/".$page."/";
	$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
	$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_city/{{ID}}/".$page."/";
	$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_city/{{ID}}/".$page."/";

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['brdLink']=array(
				     array('logo'=>'fa fa-flag','name'=>'City','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
				     );	
	
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='city/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
	
	$id 		= $this->uri->segment(3, 0);
	$province_name	= strip_tags(addslashes(trim($this->input->get_post('city_name'))));
	
	$whereArr	= array();
	if($id > 0){
		$whereArr	= array( 'city_name' => $province_name,
					 'city_master_id != ' => $id						
					);
	}else{			
		$whereArr	= array( 'city_name' => $province_name );
	}
	$bool 	= $this->model_basic->checkRowExists(CITY, $whereArr );
	if($bool == 0){
		$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
		return FALSE;
	}else{
		return TRUE;
	}
    }
    
    
   public function add_city()
    {
        chk_login();
        $this->data='';
        
        
        
	$provice_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
	$this->data['controller']	= currentClass();
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
	$this->data['province_list'] 	= $this->model_basic->getValues_conditions(PROVINCE_MASTER);
        //$this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
	
	
	
	
	if($this->input->get_post('action') == 'Process'){
	    
	    $action = $this->input->post('action',true);
	    $this->form_validation->set_rules('province', 'Province', 'trim|required');
	    $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|callback_is_name_exists');
		
		if ($this->form_validation->run() != FALSE && $action != FALSE)
		{	
		    $province_id     	= addslashes($this->input->post('province'));
		    $city_name     	= addslashes($this->input->post('city_name'));
		    $city_slug     	= create_slug(addslashes($city_name));
		    $description     	= addslashes($this->input->post('description'));
		    $type     		= addslashes($this->input->post('type'));
		    $is_favourite     	= addslashes($this->input->post('is_favourite'));
		    $new_file_name	= '';
		    $city_banner_image = '';
		    
		    if($is_favourite == 'Yes')
		    {
			$this->load->library('image_lib');
			$tmp_name	= $_FILES['fav_location']['tmp_name'];
			$file_name 	= $_FILES['fav_location']['name'];
			$new_file_name 	= $this->cdnupload->getFileNewName($file_name);
			
			if($new_file_name!='')
			{
				//$config 	= array(
				//		    'image_library'	=> 'GD2',
				//		    'source_image'	=> $tmp_name,
				//		    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/banner'.$new_file_name,
				//		    'size_str'		=> '9000000'
				//		);
				//$this->image_lib->initialize($config);
				//$this->image_lib->resize();
				//
				//$file = FRONTEND_URL.'upload/city/banner'.$new_file_name;
				//$this->cdnupload->upload($file,'city/banner',$new_file_name);
				//@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/banner'.$new_file_name);
				//
				//$this->image_lib->clear();
				
				
				 $config 	= array(
							'image_library' 	=> 'GD2',
							'source_image'	=> $tmp_name,
							'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name,
							'create_thumb'	=> false,
							'width'		=> '320',
							'height'	=> '230'
							
						    );
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    //echo $this->image_lib->display_errors();die;
				    $file = FRONTEND_URL.'upload/city/thumb/'.$new_file_name;
				    $this->cdnupload->upload($file,'city/thumb',$new_file_name);
				    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name);
				    
				    $this->image_lib->clear();
				
				
				
				//$config 	= array(
				//		    'image_library' 	=> 'GD2',
				//		    'source_image'	=> $tmp_name,
				//		    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name,
				//		    'create_thumb'	=> true,
				//		    'width'		=> '320'
				//		    
				//		);
				//$this->image_lib->initialize($config);
				//$this->image_lib->resize();
				//
				//$file = FRONTEND_URL.'upload/city/thumb/'.$new_file_name;
				//$this->cdnupload->upload($file,'city/thumb',$new_file_name);
				//@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name);
				//
				//$this->image_lib->clear();
			}
		    }
		    
		    
		    	$city_banner_image_name	= $_FILES['city_banner_image']['name'];
			$city_banner_tmp_image	= $_FILES['city_banner_image']['tmp_name'];
			$city_banner_image 	= $this->cdnupload->getFileNewName($city_banner_image_name);
			
			if($city_banner_image!='')
			{
			    

				$config 	= array(
						    'image_library'	=> 'GD2',
						    'source_image'	=> $city_banner_tmp_image,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$city_banner_image
						);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				//echo $this->image_lib->display_errors();die;
				$file = FRONTEND_URL.'upload/city/banner/'.$city_banner_image;
				$this->cdnupload->upload($file,'city/banner/',$city_banner_image);
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$city_banner_image);
				
				$this->image_lib->clear();
				
				//$config 	= array(
				//		    'image_library' 	=> 'GD2',
				//		    'source_image'	=> $city_banner_tmp_image,
				//		    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$city_banner_image,
				//		    'create_thumb'	=> false,
				//		    'width'		=> ''
				//		    
				//		);
				//$this->image_lib->initialize($config);
				//$this->image_lib->resize();
				//
				//$file = FRONTEND_URL.'upload/city/thumb/'.$city_banner_image;
				//$this->cdnupload->upload($file,'city/thumb',$city_banner_image);
				//@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$city_banner_image);
				//
				//$this->image_lib->clear();
				
			}
		    $condition	= "province_id = ".$province_id;
		    $province_sc = $this->model_basic->getValue_condition(PROVINCE_MASTER, 'province_short_code', '', $condition);
		    $insertArr  =  array(
					    'province_id'	=> $province_id,
					    'city_name'		=> $city_name,
					    'city_slug'		=> $city_slug.'-'.$province_sc,
					    'city_seo_slug'	=> $city_slug,
					    'description'	=> $description,
					    'is_favourite'	=> $is_favourite,
					    'type'		=> $type,
					    'image_name'	=> $new_file_name,
					    'banner_image_name'	=> $city_banner_image
					);
		
		    $res = $this->model_basic->insertIntoTable(CITY,$insertArr);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "City Added Successfuly.");
			    redirect($this->data['return_link']);
		    }else{
			    $this->nsession->set_userdata('errmsg', "Unable to Add City");
			    redirect($this->data['return_link']);
		    }
		}
		else{
		    $this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
		    
		}
	}
	
	$this->data['propertyTypeid'] = 0;
        
        
        $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink']=array(
				     array('logo'=>'fa fa-flag','name'=>'City','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-plus-circle','name'=>'Add','link'=>'javascript:void();')
				     );	
	
	
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_province/0/".$page."/";
        $this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
	
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='city/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    

    
    public function edit_city()
    {
        
	chk_login();
	
        $this->data='';
	//<!------------code------------------->
	$city_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
	$this->data['controller']	= currentClass();
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
	$this->data['province_list'] 	= $this->model_basic->getValues_conditions(PROVINCE_MASTER);
	
	// Prepare Data
	$rec = $this->model_city->getCityDetails($city_id);
	
	if(is_array($rec) and count($rec)>0){
	    $this->data['city_details'] = $rec;
	    
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		 redirect($this->data['return_link']);
		return false;
	}
		
	if($this->input->get_post('action') == 'Process')
	{
	    $image_name		= $this->data['city_details']['image_name'];
	    $banner_image_name = $this->data['city_details']['banner_image_name'];
	    
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('province', 'Province', 'trim|required');
		$this->form_validation->set_rules('city_name', 'City Name', 'trim|required|callback_is_name_exists');
		//$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
		//$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');
		//$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
		
		if ($this->form_validation->run() != FALSE && $action != FALSE)
		{	
		    $province_id     	= addslashes($this->input->post('province'));
		    $city_name     	= addslashes($this->input->post('city_name'));
		    $meta_title     	= addslashes($this->input->post('meta_title'));
		    $meta_keyword     	= addslashes($this->input->post('meta_keyword'));
		    $meta_description   = addslashes($this->input->post('meta_description'));
		    $city_slug     	= create_slug(addslashes($city_name));
		    $description     	= addslashes($this->input->post('description'));
		    $type     		= addslashes($this->input->post('type'));
		    $is_favourite     	= addslashes($this->input->post('is_favourite'));
		    $new_file_name	= '';
		    $city_banner_image = '';
		    if($is_favourite == 'Yes')
		    {
			    $this->load->library('image_lib');
			    $tmp_name	= $_FILES['fav_location']['tmp_name'];
			    $file_name 	= $_FILES['fav_location']['name'];
			    $new_file_name 	= $this->cdnupload->getFileNewName($file_name);
			    
			    if($new_file_name!='')
			    {
				//    $config 	= array(
				//			'image_library'	=> 'GD2',
				//			'source_image'	=> $tmp_name,
				//			'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$new_file_name,
				//			'size_str'		=> '9000000'
				//		    );
				//    
				//    $this->image_lib->initialize($config);
				//    $this->image_lib->resize();
				//    
				//    $file = FRONTEND_URL.'upload/city/banner/'.$new_file_name;
				//    $this->cdnupload->upload($file,'city/banner/',$new_file_name);
				//    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$new_file_name);
				//    
				//    $this->image_lib->clear();
				    
				    $config 	= array(
							'image_library' 	=> 'GD2',
							'source_image'	=> $tmp_name,
							'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name,
							'create_thumb'	=> false,
							'width'		=> '320',
							'height'	=> '230'
							
						    );
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    //echo $this->image_lib->display_errors();die;
				    $file = FRONTEND_URL.'upload/city/thumb/'.$new_file_name;
				    $this->cdnupload->upload($file,'city/thumb',$new_file_name);
				    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$new_file_name);
				    
				    $this->image_lib->clear();
			    }
		    }
			$city_banner_image_name	= $_FILES['city_banner_image']['name'];
			$city_banner_tmp_image	= $_FILES['city_banner_image']['tmp_name'];
			$city_banner_image 	= $this->cdnupload->getFileNewName($city_banner_image_name);
			
			if($city_banner_image!='') 
			{
				$config 	= array(
						    'image_library'	=> 'GD2',
						    'source_image'	=> $city_banner_tmp_image,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$city_banner_image
						);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				//echo $this->image_lib->display_errors();die;
				$file = FRONTEND_URL.'upload/city/banner/'.$city_banner_image;
				$this->cdnupload->upload($file,'city/banner/',$city_banner_image);
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/banner/'.$city_banner_image);
				
				$this->image_lib->clear();
				
				//$config 	= array(
				//		    'image_library' 	=> 'GD2',
				//		    'source_image'	=> $city_banner_tmp_image,
				//		    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$city_banner_image,
				//		    'create_thumb'	=> false,
				//		    'width'		=> ''
				//		    
				//		);
				//$this->image_lib->initialize($config);
				//$this->image_lib->resize();
				//
				//$file = FRONTEND_URL.'upload/city/thumb/'.$city_banner_image;
				//$this->cdnupload->upload($file,'city/thumb',$city_banner_image);
				//@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'city/thumb/'.$city_banner_image);
				//
				//$this->image_lib->clear();
				
			}
		    
		    
		    $condition	= "province_id = ".$province_id;
		    $province_sc = $this->model_basic->getValue_condition(PROVINCE_MASTER, 'province_short_code', '', $condition);
		    
		    if($city_banner_image != '')
		    {
			$banner_image_name = $city_banner_image;
		    }
		    
		    if($new_file_name != '')
		    {
			$image_name = $new_file_name;
		    }
			
		    $updateArr  =  array(
					    'province_id'	=> $province_id,
					    'city_name'		=> $city_name,
					    'city_slug'		=> $city_slug.'-'.$province_sc,
					    'city_seo_slug'	=> $city_slug,
					    'meta_title'	=> $meta_title,
					    'meta_keyword'	=> $meta_keyword,
					    'meta_description'	=> $meta_description,
					    'description'	=> $description,
					    'is_favourite'	=> $is_favourite,
					    'type'		=> $type,
					    'banner_image_name'	=> $banner_image_name,
					    'image_name'	=> $image_name
					);
		    
				    
		   $idArr      = array('city_master_id' => $city_id);
	    
		   $ret   = $this->model_basic->updateIntoTable(CITY,$idArr, $updateArr);
		    if($ret)
		    {
			    $this->nsession->set_userdata('succmsg', "City Updated Successfuly.");
			    redirect($this->data['return_link']);
		    }else{
			    $this->nsession->set_userdata('errmsg', "Unable to update City");
			    redirect($this->data['return_link']);
		    }
		}
		else{
		    $this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
		    
		}
	}	
		
	$this->data['brdLink']=array(
				     array('logo'=>'fa fa-flag','name'=>'City','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
				     );	
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_province/".$city_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='city/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
//    public function delete_city()
//    {
//	$id = $this->uri->segment(3, 0);
//	
//	if($id!=NULL)
//	{
//		
//		$delete_where	= "province_id IN(".$id.")";
//		$res = $this->model_basic->deleteData(CITY, $delete_where);
//		if($res)
//		{
//			$this->nsession->set_userdata('succmsg', "City is Deleted Successfuly.");
//		}
//		else
//		{
//			$this->nsession->set_userdata('succmsg', "Unable to Delete City");
//		}
//		redirect(base_url().currentClass());
//	}
//   }

//    public function tempseo(){
//	//$citydata	= $this->model_basic->getFromWhereSelect(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', 'city_master_id, city_name, province_slug', '  ');
//	$citydata	= $this->model_basic->getValues_conditions(CITY.' CT INNER JOIN '.PROVINCE_MASTER.' PRV ON CT.province_id = PRV.province_id', array('city_master_id', 'city_name', 'province_short_code'));
//	if($citydata){
//	    foreach($citydata as $city){
//		$city_slug     	= create_slug($city['city_name']);
//		$updateArr  =  array( 'city_slug' => $city_slug.'-'.$city['province_short_code'],'city_seo_slug'=> $city_slug ); 
//		$idArr      = array('city_master_id' => $city['city_master_id']);
//		$ret   = $this->model_basic->updateIntoTable(CITY,$idArr, $updateArr);
//	    }
//	}
//    }

   public function change_status(){
       $city_id = $this->input->post('id');
       $rec = $this->model_city->getCityDetails($city_id);
       if(is_array($rec) and count($rec)>0){
	  $status = $rec['status'];
	  $new_status ='';
	  if($status=='Active'){
	    $new_status = 'Inactive';
	  }
	  else if($status=='Inactive'){
	    $new_status = 'Active';
	  }
	  
	   $updateArr  =  array('status' => $new_status);
		    
	   $idArr      = array('city_master_id' => $city_id);
    
	   $ret   = $this->model_basic->updateIntoTable(CITY,$idArr, $updateArr);
       }
   }
   
}
?>