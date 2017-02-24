<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deal_city extends CI_Controller
{
	var $Table	= 'hw_deal_city_master';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_deal_city');
		$this->load->model('model_basic');
		$this->load->library('cdnupload');
		$this->load->library('image_lib');
	}
	
	public function index()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."deal_city/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('DEAL');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword']	= $this->data['params']['search_keyword'];
			$this->data['per_page']	= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
		 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Deal';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Team Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['dealList']			= $this->Model_deal_city->getDealList($config,$start);
		
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'deal';	
		$this->data['base_url'] 		= BACKEND_URL."deal_city/index/0/1/";				
		$this->data['show_all']      		= BACKEND_URL."deal_city/index/0/1/";
		$this->data['add_url']      		= BACKEND_URL."deal_city/add_deal_city/0/".$page."/";
		
		$this->data['edit_link']      		= BACKEND_URL."deal_city/edit_deal_city/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."deal_city/delete_deal_city/{{ID}}/".$page."/";		
		$this->data['image_link']		= BACKEND_URL."deal_city/team_image/{{ID}}/".$page."/";		
		$this->data['batch_action_link']	= BACKEND_URL."deal_city/team_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->data['pagination']=$this->pagination->create_links();
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='deal_city/index';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function add_deal_city()
	{
		//echo SAMUI_URL;exit;
		chk_login();
		$team_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "deal_city";
		$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/";
		$this->data['city_list']	= $this->Model_deal_city->get_city();
		
		$insertArray			= array();
		
		
		if($this->input->get_post('action') == 'Process')
		{
			//pr($_POST,0);
			
			//echo "city=".$this->input->post('city_id'); die();
			$this->form_validation->set_rules('city_id', 'City', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			

						
			if ($this->form_validation->run() == FALSE){
				$err=trim(validation_errors("<p>","</p>"));
				$err=str_replace("\n","",$err);
				$this->nsession->set_userdata('errmsg', $err);
			}
			else
			{
				$title              	= trim(addslashes($this->input->get_post('title')));
				$description		= trim(addslashes($this->input->get_post('description')));
				$city_id		= trim(addslashes($this->input->get_post('city_id')));
				$status		= trim(addslashes($this->input->get_post('status')));	
				$new_team_image 		= '';
				
				
				if(is_array($_FILES) and count($_FILES['image'])>0 and $_FILES['image']['tmp_name']!='' )
				{
					$tmp_name = $_FILES['image']['tmp_name'];
			                list($width, $height, $type, $attr) = getimagesize($tmp_name);
					
					 $file_name = $_FILES['image']['name'];
			                 $new_team_image = $this->cdnupload->getFileNewName($file_name);
					 
					 $config 	= array(
						'image_library' 	=> 'GD2',
						'source_image'		=> $tmp_name,
						'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/'.$new_team_image
						
					    );
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
						
					 $file = FRONTEND_URL.'upload/deal_city/'.$new_team_image;
					 $this->cdnupload->upload($file,'deal_city/',$new_team_image);
					 @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/'.$new_team_image);
					 
					 $this->image_lib->clear();
					 
					 
					$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/thumb/'.$new_team_image,
						    'create_thumb'	=> true,
						    'width'		=> '400',
						    'height'	        => '400'
						    
						);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/deal_city/thumb/'.$new_team_image;
					$this->cdnupload->upload($file,'deal_city/thumb',$new_team_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/thumb/'.$new_team_image);
					
					$this->image_lib->clear();
				}
				if($new_team_image!=''){
					
					$image = $new_team_image;
				}
				else
				{
					$image = '';
				}
				
				$insertArray = array(
						     'title'		=> $title,
						     'description'	=> $description,
						     'city_id'		=> $city_id,						    
						     'image'		=> $image,
						     'status'		=> $status,
						     
						     );
				
				
				$i_check = $this->Model_deal_city->insertIntoTable($this->Table, $insertArray);
				
				if($i_check)
				{
					$this->nsession->set_userdata('succmsg', "Record added successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', 'Please try again.');
				}
				
				redirect(BACKEND_URL."deal_city/index/".$page);
				return true;	
			}
			
			
			
		}
		
		
		
		$this->data['succmsg']		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
//For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Deal City';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Deal City';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."deal_city/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'deal_city/add';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function edit_deal_city()
	{
		chk_login();
		$id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		if($page ==0)
			$pagenum ='';
		else
			$pagenum = $page;
		
		$this->data['controller']	= "deal_city";
		$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/".$page;

		$this->data['city_list']	= $this->Model_deal_city->get_city();
		
		$condition	= " id = '".$id."'";
		$arr_team	= $this->model_basic->getValues_conditions($this->Table, '', '', $condition);
		
		$this->data['arr_team']	= $arr_team[0];
		
		if($this->input->get_post('action') == 'Process')
		{
			
			$this->form_validation->set_rules('city_id', 'City', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				$err=trim(validation_errors("<p>","</p>"));
				$err=str_replace("\n","",$err);
				$this->nsession->set_userdata('errmsg', $err);
			}
			else
			{
				
				$image_name_old		= $this->data['arr_team']['image'];
	   
				
				$title              	= trim(addslashes($this->input->post('title')));
				$description		= trim(addslashes($this->input->post('description')));
				$city_id		= trim(addslashes($this->input->post('city_id')));
				$status			= trim(addslashes($this->input->post('status')));	
				$new_team_image 	= '';		

				
				
				if(is_array($_FILES) and count($_FILES['image'])>0 and $_FILES['image']['tmp_name']!='' )
				{
					$tmp_name = $_FILES['image']['tmp_name'];
			                list($width, $height, $type, $attr) = getimagesize($tmp_name);
					
					 $file_name = $_FILES['image']['name'];
			                 $new_team_image = $this->cdnupload->getFileNewName($file_name);
					 
					 $config 	= array(
						'image_library' 	=> 'GD2',
						'source_image'		=> $tmp_name,
						'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'team/'.$new_team_image
						
					    );
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
						
					 $file = FRONTEND_URL.'upload/deal_city/'.$new_team_image;
					 $this->cdnupload->upload($file,'deal_city/',$new_team_image);
					 @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/'.$new_team_image);
					 
					 $this->image_lib->clear();
					 
					 
					$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/thumb/'.$new_team_image,
						    'create_thumb'	=> true,
						    'width'		=> '400',
						    'height'	        => '400'
						    
						);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/deal_city/thumb/'.$new_team_image;
					$this->cdnupload->upload($file,'deal_city/thumb',$new_team_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'deal_city/thumb/'.$new_team_image);
					
					$this->image_lib->clear();
				}

				
				$updateArray = array(
						     'title'		=> $title,
						     'description'	=> $description,
						     'city_id'		=> $city_id,				      
						     'status'		=> $status,
						     );
				
				if($new_team_image!=''){
					    $updateArray['image'] = $new_team_image;
				}
					
				
				$updateArr = array( 'id' => $id );
				
				//if(($_FILES['user_image']['name']!='') && stripslashes($image_name_old) != "")
				// {
				//	 @unlink(CDN_BANNER_IMG.stripslashes($image_name_old));
				//	 @unlink(CDN_BANNER_THUMB_IMG.stripslashes($image_name_old));
				// }
				//
				
				
				$i_check = $this->Model_deal_city->updateIntoTable($this->Table ,$updateArr ,$updateArray);
				//echo $this->db->last_query();
				if(isset($i_check))
				{
					$this->nsession->set_userdata('succmsg', 'Reocrd successfully updated.');					
					redirect(BACKEND_URL."deal_city/index/".$page."/");		   
					return true;
				}
				else
				{
					$this->nsession->set_userdata('errmsg', 'Record not updated.');
					redirect(BACKEND_URL."deal_city/index/".$page."/");
					return false;
				}
				

			}
			
		}
		
		$this->data['succmsg']		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
//For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Deal';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Deal City';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."deal_city/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']	= 'deal_city/edit';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function delete_deal_city(){		
		
		$id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);	
		
		if($id)
		{
			
			$delete_where	= "id = '".$id."' ";
		        $d9 = $this->Model_deal_city->deleteData($this->Table, $delete_where,$id);
			
			if($d9)
			{
			
				$this->nsession->set_userdata('succmsg', "Selected team member deleted successfully.");
				redirect(BACKEND_URL.'deal_city/index/'.$page);
			}
			//$this->delete_image($team_id);
		}
		else
		{
			$this->nsession->set_userdata('succmsg', "Unable to Delete team member");
			redirect(BACKEND_URL.'deal_city/index/'.$page);
		}
		
		
		
	}
	public function delete_image($id)
	{
		$Condition 		= "id = '".$id."' ";
		$arr_team_image	= $this->model_basic->getValues_conditions($this->Table, '*', '', $Condition);
		//pr($arr_team_image);exit;
		
		/*** Delete Image from Server ***/
		if($arr_team_image && !empty($arr_team_image)){
			foreach($arr_team_image as $image){
				//echo (file_upload_absolute_path().'team/'.stripslashes($image['image'])); exit;
				if(file_exists(file_upload_absolute_path().'deal_city/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
				{
					unlink(file_upload_absolute_path().'deal_city/'.stripslashes($image['image']));
				}

				if(file_exists(file_upload_absolute_path().'deal_city/thumb/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
				{
					unlink(file_upload_absolute_path().'deal_city/thumb/'.stripslashes($image['image']));
				}				
				
			}
		}
		$delete_where	= " id = '".$id."'";
		$this->model_basic->deleteData($this->Table, $delete_where);
		return true;
	}
	
	public function change_status(){
		$id = $this->input->post('id');
		$alias		= '';
		$condition	= "id = '".$id."'";
		$rec = $this->model_basic->getValues_conditions($this->Table, '', $alias, $condition);
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
			     
		    $idArr      = array('id' => $id);
	     
		    $ret   = $this->model_basic->updateIntoTable($this->Table,$idArr, $updateArr);
		}
	}
	
	

}