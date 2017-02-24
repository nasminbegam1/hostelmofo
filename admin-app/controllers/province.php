<?php
class Province extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_province");
	$this->load->library('image_lib');
	$this->load->library('cdnupload');
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	$config['base_url'] 	= BACKEND_URL."province/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	$this->data['params']		= $this->nsession->userdata('PROVINCE_MASTER_SEARCH');
	
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
	$this->data['provinesTypeList']	= $this->model_province->getList($config,$start);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= 'province';	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_province/0/".$page."/";
	$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
	$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_province/{{ID}}/".$page."/";
	$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_province/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Provines';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Provines Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='province/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
	
	$id 		= $this->uri->segment(3, 0);
	$province_name	= strip_tags(addslashes(trim($this->input->get_post('province_name'))));
	
	$whereArr	= array();
	if($id > 0){
		$whereArr	= array( 'province_name' => $province_name,
					 'province_id != ' => $id						
					);
	}else{			
		$whereArr	= array( 'province_name' => $province_name );
	}
	$bool 	= $this->model_basic->checkRowExists(PROVINCE_MASTER, $whereArr );
	if($bool == 0){
		$this->form_validation->set_message('is_name_exists', 'The %s already exists');
		return FALSE;
	}else{
		return TRUE;
	}
    }
    
    public function add_province()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	$provice_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
	$this->data['controller']	= "province";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
       // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
	
	$action = $this->input->post('action',true);
	$this->form_validation->set_rules('province_name', 'Province Name', 'trim|required|is_unique[hw_province_master.province_name]');
	
	
	if($this->input->get_post('action') == 'Process'){
		
		if ($this->form_validation->run() != FALSE && $action != FALSE)
		{	
		    $province_name     	= addslashes($this->input->post('province_name'));
		    $province_slug     	= create_slug(addslashes($this->input->post('province_name')));
		    $provines_status	= addslashes($this->input->post('province_status'));
		    
		    $insertArr  =  array('province_name'	        => $province_name,
					'province_slug'			=> $province_slug,
					'status'           		=> $provines_status);
		
		    $res = $this->model_basic->insertIntoTable(PROVINCE_MASTER,$insertArr);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Provines Added Successfuly.");
			    redirect(base_url()."province/");
		    }else{
			    $this->nsession->set_userdata('errmsg', "Unable to Add Provines");
			    redirect(base_url()."province/");
		    }
		}
	}
	
	//$this->data['propertyTypeid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Provines';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Provines Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."province/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New Provines';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_province/0/".$page."/";
        $this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='province/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_province()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$province_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
	$this->data['controller']	= "province";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
	if($this->input->get_post('action') == 'Process'){			
	    $this->form_validation->set_rules('province_name', 'Province Name','trim|required|callback_is_name_exists');
	    
	    if ($this->form_validation->run() == FALSE){
		$this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
		redirect('province/edit_province/'.$province_id);
	    }
	    else
	    {                      
		    $province_name     	= addslashes($this->input->post('province_name'));
		    $province_slug     	= create_slug(addslashes($this->input->post('province_name')));
		    $meta_title		= addslashes($this->input->post('meta_title'));
		    $meta_key		= addslashes($this->input->post('meta_key'));
		    $meta_description	= addslashes($this->input->post('meta_description'));
		    $province_status	= addslashes($this->input->post('province_status'));
		    $province_description = addslashes($this->input->post('province_description'));
		    $new_banner_image ='';
		    
		    if(is_array($_FILES) and count($_FILES['province_img'])>0 and $_FILES['province_img']['tmp_name']!='' ){
			//echo "province image uploaded"; exit;
			$tmp_name = $_FILES['province_img']['tmp_name'];
			list($width, $height, $type, $attr) = getimagesize($tmp_name);
			
			//if($width < 800 or $height < 600){
			//    $this->nsession->set_userdata('errmsg','Banner Photo height width may lower than 800*600');
			//    redirect('province/edit_province/'.$province_id);
			//}else{
			    
			    $file_name = $_FILES['province_img']['name'];
			    $new_banner_image = $this->cdnupload->getFileNewName($file_name);
				
			    $config 	= array(
						'image_library' 	=> 'GD2',
						'source_image'		=> $tmp_name,
						'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'province/banner/'.$new_banner_image
						
					    );
			    $this->image_lib->initialize($config);
			    $this->image_lib->resize();
			    
			    $file = FRONTEND_URL.'upload/province/banner/'.$new_banner_image;
			    $this->cdnupload->upload($file,'province/banner',$new_banner_image);
			    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'province/banner/'.$new_banner_image);
			    
			//}
		    		    
		    }
		    
		    $listing_image = '';
		    if( is_array($_FILES) and count($_FILES['province_list_img'])>0 and $_FILES['province_list_img']['tmp_name']!='' ){
			
			$tmp_name = $_FILES['province_list_img']['tmp_name'];
			//echo "province list img uploaded"; exit;
			    
			$file_name = $_FILES['province_list_img']['name'];
			$listing_image = $this->cdnupload->getFileNewName($file_name);
			    
			$config 	= array(
					    'image_library' 	=> 'GD2',
					    'source_image'	=> $tmp_name,
					    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'province/listing/'.$listing_image,
					    'width'		=> 300,
					    'height'		=> 200
					);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			$file = FRONTEND_URL.'upload/province/listing/'.$listing_image;
			$this->cdnupload->upload($file,'province/listing',$listing_image);
			@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'province/listing/'.$listing_image);
			    
			
		    		    
		    }
		    
		    //echo "no img uploaded"; exit;
		    
		    $insertArr  =  array('province_name'	        => $province_name,
					 'province_slug'		=> $province_slug,
					 'province_description'		=> $province_description,
					 'meta_title'			=> $meta_title,
					 'meta_keyword'			=> $meta_key,
					 'meta_description'		=> $meta_description,
					 //'banner_image_name'		=> $new_banner_image,
					 //'listing_image_name'		=> $listing_image,
					 //'status'           		=> $province_status
					 );
		    if($new_banner_image!=''){
			$insertArr['banner_image_name'] = $new_banner_image;
		    }
		    
		    if($listing_image!=''){
			$insertArr['listing_image_name'] = $listing_image;
		    }
		    
		    
		    $idArr	= array('province_id' => $province_id);
    
		    //pr($insertArr);
		    $ret   = $this->model_basic->updateIntoTable(PROVINCE_MASTER,$idArr, $insertArr);
		    if(isset($ret))
		    {
			    $this->nsession->set_userdata('succmsg', "Province updated successfully.");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
		    }
		    redirect(BACKEND_URL."province/index/".$page."/");
		    return true;
	    }
	}		
		
	$row = array();

	// Prepare Data
	$Condition = " province_id = '".$province_id."'";
	$rs = $this->model_basic->getValues_conditions(PROVINCE_MASTER, '', '', $Condition);
	
	$row = $rs[0];
	if($row){
	    $this->data['arr_provines'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit_province/".$page."/");
		return false;
	}
	
	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Provines';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Provines Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."province/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit Provines';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_province/".$province_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='province/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_province()
   {
	$id = $this->uri->segment(3, 0);
	
	if($id!=NULL)
	{
		$Condition = " province_id = '".$id."'";
		$rs = $this->model_basic->isRecordExist(PROPERTY_DETAILS, $Condition);
		if($rs >0){
		    $this->nsession->set_userdata('errmsg', "Unable to Delete Provice.It's used in different place.");
		    redirect(base_url()."province/");
		}else{
		    $delete_where	= "FIND_IN_SET(province_id, '".$id."')";
		    $res = $this->model_basic->deleteData(PROVINCE_MASTER, $delete_where);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Provice Deleted Successfuly.");
			    redirect(base_url()."province/");
		    }
		    else
		    {
			    
			    $this->nsession->set_userdata('succmsg', "Unable to Delete Provice");
			    redirect(base_url()."province/");
		    }
		}
	}
   }
   
    public function change_status(){
	$province_id = $this->input->post('id');
	$alias		= '';
	$condition	= "province_id = '".$province_id."'";
	$rec = $this->model_basic->getValues_conditions(PROVINCE_MASTER, '', $alias, $condition);
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
		     
	    $idArr      = array('province_id' => $province_id);
     
	    $ret   = $this->model_basic->updateIntoTable(PROVINCE_MASTER,$idArr, $updateArr);
	}
    }
    
}
?>