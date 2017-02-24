<?php
class Image extends CI_Controller
{
	var $imageUploadTable	= 'lp_image_upload';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_image_upload');
		
	}
        
    public function index()
    {
        chk_login();
        $this->data='';
         //<!----------------code------------------------------>
         
         $config['base_url'] 	= BACKEND_URL."image/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('FILE_UPLOAD');
		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
			$this->data['per_page']		= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);
                        
		}
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['fileList']			= $this->model_image_upload->getList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
                
		$this->data['per_page'] 		= $config['per_page'];
                
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'image';	
		$this->data['base_url'] 		= BACKEND_URL."image/index/0/1/";
		$this->data['add_link']      		= BACKEND_URL."image/add_image/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."image/edit_image/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."image/delete_image/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/batch_action_faq_master/0/".$page."/";
         
         
         //<!----------------code------------------------------>
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
           
            
        $this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
       
        
        $this->data['brdLink']='';
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='image/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function add_image()
    {
	chk_login();
        $this->data='';
	
	//<!----------------code-------------------->
	$file_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4,0);
		
		$this->data['controller']	= "image_upload";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$file_name	= $_FILES['file_name']['name'];
			
			if($file_name != '')
			{
				$upload_config['field_name']		= 'file_name';
				$upload_config['file_upload_path'] 	= 'editor_images/';
				$upload_config['max_size']		= '256000';
				$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
				$upload_config['encrypt_name']		= TRUE;
				
				$uploaded_file = file_upload($upload_config);
				
				if($this->nsession->userdata('upload_err') == '') ///uploaded successfully no error
				{
					$original_file_name 	= $_FILES['file_name']['name'];
				
					$file_size	= $_FILES['file_name']['size'];
					$upload_path	= FILE_UPLOAD_URL.'editor_images/'.$uploaded_file;
					
					$insertArr	= array(
								'file_name' 		=> $uploaded_file,
								'original_file_name'	=> $original_file_name,
								'file_size'		=> $file_size,
								'upload_path'		=> $upload_path
								);
					
					$i_add = $this->model_basic->insertIntoTable($this->imageUploadTable, $insertArr);
					
					if($i_add > 0)
					{
						$this->nsession->set_userdata('succmsg', "Image uploaded successfully");
										}
					else
					{
						$this->nsession->set_userdata('errmsg', "Error in file uploading. Please try again later.");
					}
				}
				else
				{
					$error_msg = $this->session->userdata('upload_err');
					$this->nsession->set_userdata('upload_err', '');
					
					$this->nsession->set_userdata('errmsg', $error_msg);
				}
			}
			else
			{
				$this->nsession->set_userdata('errmsg', "Please upload image.");	
			}
			
			redirect(BACKEND_URL."image/index/".$page."/");
			return true;        
		}		
		
                $row = array();
	
	
	//<!---------------code--------------------->
	
	$this->data['controller'] 		= 'image';
	$this->data['base_url'] 		= BACKEND_URL."image/index/0/1/";
	$this->data['brdLink']='';
	$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_image/0/1/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='image/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_image()
    {
	chk_login();
        $this->data='';
	
	//<!------------------code---------------------->
	
	$file_id	= $this->uri->segment(3, 0);
	$page		= $this->uri->segment(4,0);
		
		$this->data['controller']	= "image";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		$select_where			= " id = '".$file_id."'";
		$select_field_name		= array('file_name', 'upload_path');
		$this->data['image_info']	= $this->model_basic->getValues_conditions($this->imageUploadTable, $select_field_name, '', $select_where);
		
		if($this->input->get_post('action') == 'Process')
		{
			$file_name	= $_FILES['file_name']['name'];
			
			if($file_name != '')
			{
				$upload_config['field_name']		= 'file_name';
				$upload_config['file_upload_path'] 	= 'editor_images/';
				$upload_config['max_size']		= '256000';
				$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
				$upload_config['encrypt_name']		= TRUE;
				
				$uploaded_file = image_upload($upload_config);
				
				if($this->nsession->userdata('upload_err') == '') ///uploaded successfully no error
				{
					$original_file_name 	= $_FILES['file_name']['name'];
				
					$file_size	= $_FILES['file_name']['size'];
					$upload_path	= FILE_UPLOAD_URL.'editor_images/'.$uploaded_file;
					
					$updateArr	= array(
								'file_name' 		=> $uploaded_file,
								'original_file_name'	=> $original_file_name,
								'file_size'		=> $file_size,
								'upload_path'		=> $upload_path
								);
					
					$idArr		= array(
								'id'	=> $file_id
								);
					
					$i_add = $this->model_basic->updateIntoTable($this->imageUploadTable, $idArr, $updateArr);
					
					if($i_add > 0)
					{
						$image_full_path = FILE_UPLOAD_ABSOLUTE_PATH."editor_images/".$image_name;
						if(file_exists($image_full_path))
						{
							unlink($image_full_path);
						}
						
						$this->nsession->set_userdata('succmsg', "Image uploaded successfully");
										}
					else
					{
						$this->nsession->set_userdata('errmsg', "Error in image uploading. Please try again later.");
					}
				}
				else
				{
					$error_msg = $this->nsession->userdata('upload_err');
					$this->nsession->set_userdata('upload_err', '');
					
					$this->nsession->set_userdata('errmsg', $error_msg);
				}
			}
			else
			{
				$this->nsession->set_userdata('succmsg', "Previous image uploaed successfully.Please upload new file to change image.");	
			}
			
			redirect(BACKEND_URL."image/index/".$page."/");
			return true;        
		}		
		
                $row = array();
	//<!------------------code---------------------->
	
	$this->data['controller'] 		= 'image';
	$this->data['base_url'] 		= BACKEND_URL."image/index/0/1/";
	$this->data['brdLink']='';
	$this->data['edit_url']      	= BACKEND_URL.$this->data['controller']."/edit_image/".$file_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='image/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
	
    }
    
    	function delete_image()
	{
		chk_login();
		
		$file_id	= $this->uri->segment(3);
		$select_where	= " id = '".$file_id."'";
		$image_name	= $this->model_basic->getValue_condition($this->imageUploadTable, 'file_name', '', $select_where);
		
		$image_full_path= FILE_UPLOAD_ABSOLUTE_PATH."editor_images/".$image_name;
		if(file_exists($image_full_path))
		{
			unlink($image_full_path);
		}
		
		$delete_where	= " id = '".$file_id."'";
		
		$this->model_basic->deleteData($this->imageUploadTable, $delete_where);
		$this->nsession->set_userdata('succmsg', "Selected image deleted successfully.");
		
		
		redirect(BACKEND_URL."image/index");
		return true;
	}
    
    
    
}
?>