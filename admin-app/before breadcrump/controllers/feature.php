<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feature extends CI_Controller 
{
	var $clientTable 	= 'lp_client';
	
	public function __construct()
	{
		parent::__construct();
                $this->load->model('model_client');
	}
        
         public function listview()
	{
            chk_login();
            $this->data='';
            //<!----------------code------------------------------>
		$config['base_url'] 	= BACKEND_URL."feature/listview/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CLIENT_SEARCH');
		
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
		$this->data['clientList']	= $this->model_client->getList($config,$start);
               
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
                
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'feature';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/listview/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/listview/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_feature/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_feature/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_feature/{{ID}}/".$page."/";
		
            
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        $this->data['brdLink']='';
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='feature/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        }
        
        function is_name_exists(){
		
		$id 		= $this->uri->segment(3, 0);
		$client_title	= strip_tags(addslashes(trim($this->input->get_post('client_title'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'client_title' => $client_title,
						 'client_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'client_title' => $client_title );
		}
		$bool 	= $this->model_basic->checkRowExists($this->clientTable, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
	}
        
        public function add_feature()
        {
            chk_login();
            $this->data='';
            //<!----------------code--------------------->
            
            $client_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "feature";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
                $this->data['lastOrderLimit']   = $this->model_client->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('client_title', 'As Featured In Title', 'trim|required|callback_is_name_exists');
                $this->form_validation->set_rules('client_link', 'As Featured In Link', 'trim|required');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
                                $upload_config['field_name']				= 'client_image';
				$upload_config['file_upload_path'] 			= 'client/';
				$upload_config['max_size']				= '';
				$upload_config['max_width']				= '';
				$upload_config['max_height']				= '';
				$upload_config['allowed_types']				= '*';
                                
                                $thumb_config['thumb_create']                           = true;
                                $thumb_config['thumb_file_upload_path']                 = 'thumb/';
                                $thumb_config['thumb_width']                            = '';
                                $thumb_config['thumb_height']                           = '30';
                                
                                $isUploaded = image_upload($upload_config,$thumb_config);
                                
				$client_title	        = addslashes($this->input->post('client_title'));
                                $client_image	        = ((!$isUploaded) ? '' : $isUploaded);
                                $client_order	        = addslashes($this->input->post('client_order'));
                                $client_link	        = addslashes($this->input->post('client_link'));
                                $client_desc	        = addslashes($this->input->post('client_desc'));
				$client_status	        = addslashes($this->input->post('client_status'));
				$client_updated_on	= date('Y-m-d H:i:s');
				
				
				$insertArr  =  array(
							'client_title'	        => $client_title,
							'client_image'	        => $client_image,
							'client_desc'           => $client_desc,
                                                        'client_order'          => $client_order,
                                                        'client_link'           => $client_link,
                                                        'client_status'         => $client_status,
							'client_updated_on'     => $client_updated_on
						);
			    
				$res = $this->model_basic->insertIntoTable($this->clientTable,$insertArr);
				if($res)
				{
					$this->nsession->set_userdata('succmsg', "As Featured In Added Successfuly.");
					redirect(base_url()."feature/listview");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable to Add As Featured In");
					redirect(base_url()."feature/listview");
				}
			}
		}
		
		$this->data['clientid'] = 0;
            
            
            //<!---------------code---------------------->
            
            $this->data['controller'] 	= 'feature';
            $this->data['brdLink']='';
            $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/listview/0/1/";	
            $this->data['add_url']      = BACKEND_URL.$this->data['controller']."/add_feature/0/".$page."/";
            $this->data['succmsg'] = $this->nsession->userdata('succmsg');
            $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
            $this->nsession->set_userdata('succmsg', "");		
            $this->nsession->set_userdata('errmsg', "");
            
            $this->templatelayout->get_topbar();
            $this->templatelayout->get_leftmenu();
            $this->templatelayout->get_footer();
            $this->elements['middle']='feature/add';			
            $this->elements_data['middle'] = $this->data;			    
            $this->layout->setLayout('layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
        }
        
        
        
        public function delete_feature()
	{
                chk_login();
           
		$id = $this->uri->segment(3, 0);
		
		if($id!=NULL)
		{
			$arr_client_existing_image = $this->model_client->get_single($id);
			$client_existing_image    = $arr_client_existing_image[0]['client_image'];
			
			
			$delete_where	= "FIND_IN_SET(client_id, '".$id."')";
			$res = $this->model_basic->deleteData($this->clientTable, $delete_where);
			if($res)
			{
				
				if(file_exists(file_upload_absolute_path().'client/'.stripslashes($client_existing_image)) && stripslashes($client_existing_image) != "")
				{
					unlink(file_upload_absolute_path().'client/'.stripslashes($client_existing_image));
					unlink(file_upload_absolute_path().'client/thumb/'.stripslashes($client_existing_image));
				}
				
				
				$this->nsession->set_userdata('succmsg', "As Featured In Deleted Successfuly.");
				redirect(base_url()."feature/listview");
			}
			else
			{
				$this->nsession->set_userdata('succmsg', "Unable to Delete As Featured In");
				redirect(base_url()."feature/listview");
			}
		}
	}
        
        public function edit_feature()
        {
            chk_login();
            $this->data='';
            //<!-----------------code------------------->
            
            $client_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "feature";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/listview/".$page;
                $this->data['lastOrderLimit']   = $this->model_client->lastOrderLimit();
		
		if($this->input->get_post('action') == 'Process'){			
			$this->form_validation->set_rules('client_title', 'As Featured In Title', 'trim|required|callback_is_name_exists');
                        $this->form_validation->set_rules('client_link', 'As Featured In Link', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
                            
			} else {
				
                                $upload_config['field_name']				= 'client_image';
				$upload_config['file_upload_path'] 			= 'client/';
				$upload_config['max_size']				= '';
				$upload_config['max_width']				= '';
				$upload_config['max_height']				= '';
				$upload_config['allowed_types']				= '*';
                                
                                $thumb_config['thumb_create']                           = true;
                                $thumb_config['thumb_file_upload_path']                 = 'thumb/';
                                $thumb_config['thumb_width']                            = '';
                                $thumb_config['thumb_height']                           = '30';
                                
                                $isUploaded = ($_FILES['client_image']['name']!='') ? image_upload($upload_config,$thumb_config) : '' ;
                                $currentFile	        = $this->input->post('currentFile');
												
				$arr_client_image_old = $this->model_client->get_single($client_id);
				$client_image_old     = $arr_client_image_old[0]['client_image'];
                                
                                $client_title	        = addslashes($this->input->post('client_title'));
                                $client_image	        = ((!$isUploaded) ? $currentFile : $isUploaded);
				
				
                                $client_order	        = addslashes($this->input->post('client_order'));
                                $client_link	        = addslashes($this->input->post('client_link'));
                                $client_desc	        = addslashes($this->input->post('client_desc'));
				$client_status	        = addslashes($this->input->post('client_status'));
				$client_updated_on	= date('Y-m-d H:i:s');
				
				
				$insertArr  =  array(
							'client_title'	        => $client_title,
							'client_image'	        => $client_image,
							'client_desc'           => $client_desc,
                                                        'client_order'          => $client_order,
                                                        'client_link'           => $client_link,
                                                        'client_status'         => $client_status,
							'client_updated_on'     => $client_updated_on
						);
				
				
				$idArr		= array(
							'client_id' => $client_id
							);
				
				
				if(($_FILES['client_image']['name']!='')&& file_exists(file_upload_absolute_path().'client/'.stripslashes($client_image_old)) && stripslashes($client_image_old) != "")
						{
							unlink(file_upload_absolute_path().'client/'.stripslashes($client_image_old));
							unlink(file_upload_absolute_path().'client/thumb/'.stripslashes($client_image_old));
						}
				
				$ret   = $this->model_basic->updateIntoTable($this->clientTable,$idArr, $insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "As Featured In updated successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				}
				redirect(BACKEND_URL."feature/listview/".$page."/");
				return true;
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " client_id = '".$client_id."'";
		$rs = $this->model_basic->getValues_conditions($this->clientTable, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_client'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_feature/".$page."/");
                        return false;
                }
            
            //<!-----------------code------------------->
            
            
            
        $this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_feature/".$client_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='feature/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
            
        }
}
?>