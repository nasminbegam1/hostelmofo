<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Team extends CI_Controller
{
	var $teamManagementTable	= 'lp_team_management';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_team');
		$this->load->model('model_basic');
		//$this->load->database($samui);
	}
	
	public function index()
	{
		chk_login();
		
		$config['base_url'] 	= BACKEND_URL."team/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('PROPERTY');
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['teamMasterList']		= $this->model_team->getTeamList($config,$start);
		//pr($this->data['teamMasterList']);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'team';	
		$this->data['base_url'] 		= BACKEND_URL."team/index/0/1/";				
		$this->data['show_all']      		= BACKEND_URL."team/index/0/1/";
		$this->data['add_url']      		= BACKEND_URL."team/add_team_member/0/".$page."/";
		
		$this->data['edit_link']      		= BACKEND_URL."team/edit_team_member/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."team/delete_team_member/{{ID}}/".$page."/";		
		$this->data['image_link']		= BACKEND_URL."team/team_image/{{ID}}/".$page."/";		
		$this->data['batch_action_link']	= BACKEND_URL."team/team_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->data['pagination']=$this->pagination->create_links();
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='team/index';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function add_team_member()
	{
		//echo SAMUI_URL;exit;
		chk_login();
		$team_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "team";
		$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/";
		$this->data['owner_add']	= 0;
		$this->data['add_owner_id']	= 0;
		$insertArray			= array();
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('name', 'Member Name', 'trim|required');
			$this->form_validation->set_rules('designation', 'Member Designation', 'trim|required');
			$this->form_validation->set_rules('description', 'Member Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				$err=trim(validation_errors("<p>","</p>"));
				$err=str_replace("\n","",$err);
				$this->nsession->set_userdata('errmsg', $err);
			}
			else
			{
				$thumb_width	= 225;
				$thumb_height	= 225;
				
				$team_type		= $this->input->get_post('team_type');
				
				if($team_type == 'Management Team')
				{
					$thumb_width = 250; $thumb_height = 225;
				}
				
				$name			= trim(addslashes($this->input->get_post('name')));
				$designation		= trim(addslashes($this->input->get_post('designation')));
				$description		= trim(addslashes($this->input->get_post('description')));
				$link_of_facebook	= trim(addslashes($this->input->get_post('link_of_facebook')));
				$link_of_twitter	= trim(addslashes($this->input->get_post('link_of_twitter')));
				$status			= trim(addslashes($this->input->get_post('status')));
				$order			= trim(addslashes($this->input->get_post('team_order')));
				
				$user_image 		= '';
				$samui_image		= '';
				
				if ($_FILES['user_image']['name'] != "")
				{
					
					//------For Samui-------------------------
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'team/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= $thumb_width;
					$thumb_config['thumb_height']		= $thumb_height;
					
					$samuiUploaded = image_upload($upload_config, $thumb_config,'/var/www/html/livesamui/upload/');					if($samuiUploaded == '')
					{
						$samui_image = '';
					}
					else
					{
						$samui_image = $samuiUploaded;
					}
					
					
					//----------------------------------------
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'team/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= $thumb_width;
					$thumb_config['thumb_height']		= $thumb_height;
					
					
					$sUploaded = image_upload($upload_config, $thumb_config);
					
					if($sUploaded == '')
					{
						$user_image = '';
					}
					else
					{
						$user_image = $sUploaded;
					}
					
				}
				
				$insertArray = array(
						     'team_type'	=> $team_type,
						     'name'		=> $name,
						     'designation'	=> $designation,
						     'description'	=> $description,
						     'link_of_facebook'	=> $link_of_facebook,
						     'link_of_twitter'	=> $link_of_twitter,
						     'image'		=> $user_image,
						     'status'		=> $status,
						     'team_order'	=> $order
						     );
				//pr($insertArray);
				
				$i_check = $this->model_team->insertIntoTable($this->teamManagementTable, $insertArray,$samui_image);
				
				if($i_check)
				{
					$this->nsession->set_userdata('succmsg', "A new team member added successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', 'Please try again.');
				}
				
				redirect(BACKEND_URL."team/index/".$page);
				return true;	
			}
			
			
			
		}
		
		$this->data['succmsg']		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'team/add_member';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function edit_team_member()
	{
		chk_login();
		$team_id	= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4, 0);
		if($page ==0)
			$pagenum ='';
		else
			$pagenum = $page;
		
		$this->data['controller']	= "team";
		$this->data['return_link']	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['owner_add']	= 0;
		$this->data['add_owner_id']	= 0;
		
		$condition	= " id = '".$team_id."'";
		$arr_team	= $this->model_basic->getValues_conditions($this->teamManagementTable, '', '', $condition);
		
		$this->data['arr_team']	= $arr_team[0];
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('name', 'Member Name', 'trim|required');
			$this->form_validation->set_rules('designation', 'Member Designation', 'trim|required');
			$this->form_validation->set_rules('description', 'Member Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				
			}
			else
			{
				$team_id	= $this->uri->segment(3, 0);
				$thumb_width	= 225;
				$thumb_height	= 225;
				
				$team_type		= $this->input->get_post('team_type');
				
				if($team_type == 'Management Team')
				{
					$thumb_width = 250; $thumb_height = 225;
				}
				
				$name			= $this->input->get_post('name');
				$designation		= $this->input->get_post('designation');
				$description		= $this->input->get_post('description');
				$link_of_facebook	= $this->input->get_post('link_of_facebook');
				$link_of_twitter	= $this->input->get_post('link_of_twitter');
				$status			= $this->input->get_post('status');
				$order			= $this->input->get_post('team_order');
				$prev_name		= $this->input->get_post('prev_name');
				
				$arr_user_image_old 	= $this->model_team->get_single($team_id);
				$user_image_old    	= $arr_user_image_old[0]['image'];
				$sUploaded 		= '';
				$user_image 		= '';
				$samui_image		= '';
				
				if (!empty($_FILES) and $_FILES['user_image']['name'] != "")
				{
					
					//------For Samui-------------------------
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'team/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= $thumb_width;
					$thumb_config['thumb_height']		= $thumb_height;
					
					$samuiUploaded = image_upload($upload_config, $thumb_config,'/var/www/html/livesamui/upload/');					if($samuiUploaded == '')
					{
						$samui_image = '';
					}
					else
					{
						$samui_image = $samuiUploaded;
					}
					
					
					//----------------------------------------			
					
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'team/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= $thumb_width;
					$thumb_config['thumb_height']		= $thumb_height;
					
					
					$sUploaded = image_upload($upload_config, $thumb_config);

				}
					
					if($sUploaded == '')
					{
						$user_image = $user_image_old;
					}
					else
					{
						$user_image = $sUploaded;
						if(file_exists(file_upload_absolute_path().'team/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != "")
						{
							unlink(file_upload_absolute_path().'team/'.stripslashes($user_image_old));
						}
		
						if(file_exists(file_upload_absolute_path().'team/thumb/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != "")
						{
							unlink(file_upload_absolute_path().'team/thumb/'.stripslashes($user_image_old));
						}		
					}
				
				$updateArray = array(
							'team_type'		=> $team_type,
							'name'			=> $name,
							'designation'		=> $designation,
							'description'		=> $description,
							'link_of_facebook'	=> $link_of_facebook,
							'link_of_twitter'	=> $link_of_twitter,
							'status'		=> $status,
							'image'			=> $user_image,
							'team_order'		=> $order,
							);
				//pr($updateArray,1);
				$updateArr = array( 'id' => $team_id );
				
				$i_check = $this->model_team->updateIntoTable($this->teamManagementTable ,$updateArr ,$updateArray,$samui_image,$prev_name);
				if($i_check)
				{
					$this->nsession->set_userdata('succmsg', 'Reocrd successfully updated.');
					if($pagenum=='')
					{
						redirect(base_url()."team/");
					}
					else
					{
						redirect(base_url()."team/index/".$pagenum."/");
					}
					
					return true;
				}
				else
				{
					$this->nsession->set_userdata('errmsg', 'Record not updated.');
					if($pagenum=='')
					{
						redirect(base_url()."team/");
					}
					else
					{
						redirect(base_url()."team/index/".$pagenum."/");
					}
				
					return false;
				}
				

			}
			
		}
		
		$this->data['succmsg']		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']	= 'team/edit_member';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function delete_team_member(){		
		
		$team_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);	
		
		
		$delete_where	= "id = '".$team_id."' ";
		$d9 = $this->model_team->deleteData($this->teamManagementTable, $delete_where,$team_id);
		
		$this->delete_image($team_id);
		$this->nsession->set_userdata('succmsg', "Selected team member deleted successfully.");
		
		redirect(BACKEND_URL.'team/index/'.$page);
		
		
	}
	public function delete_image($team_id)
	{
		
		
		$Condition 		= "id = '".$team_id."' ";
		$arr_team_image	= $this->model_basic->getValues_conditions($this->teamManagementTable, '*', '', $Condition);
		//pr($arr_team_image);exit;
		
		/*** Delete Image from Server ***/
		if($arr_team_image && !empty($arr_team_image)){
			foreach($arr_team_image as $image){
				//echo (file_upload_absolute_path().'team/'.stripslashes($image['image'])); exit;
				if(file_exists(file_upload_absolute_path().'team/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
				{
					unlink(file_upload_absolute_path().'team/'.stripslashes($image['image']));
				}

				if(file_exists(file_upload_absolute_path().'team/thumb/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
				{
					unlink(file_upload_absolute_path().'team/thumb/'.stripslashes($image['image']));
				}				
				
			}
		}
		$delete_where	= " id = '".$team_id."'";
		$this->model_basic->deleteData($this->teamManagementTable, $delete_where);
		return true;
	}
	
	public function edit_status()
	{
		chk_login();
		if($this->uri->segment(3,0)!=''){
			$team_id	= $this->uri->segment(3,0);
		}else if($this->input->post('team_id')!=''){
			$team_id	= $this->input->post('team_id');
		}
		$page_num	= 0;
		
		$this->data['team_id']		= $team_id;
		$this->data['page_num']		= $page_num;
		
		$table_name	= $this->teamManagementTable;
		$field_name	= 'status';
		$alias		= '';
		$condition	= "id = '".$team_id."'";
		
		$prev_status = $this->model_basic->getValue_condition($this->teamManagementTable, $field_name, $alias, $condition);
		//echo $prev_status; exit;
		if($prev_status == 'active')
		{
			$new_status = 'inactive';
		}
		else
		{
			$new_status = 'active';
		}
		
		$updateArr	=  array(
					'status'	=> $new_status
					);
		
		$idArr		= array(
					'id' =>  $team_id
					);
				
		//$update = $this->model_basic->updateIntoTable($this->teamManagementTable ,$idArr, $updateArr);
		
		$update = $this->model_team->updateStatus($this->teamManagementTable ,$idArr, $updateArr);
		
		echo  ucwords ( $new_status);
		
		
		//$this->session->set_userdata('succmsg', "Status updated successfully");
		//redirect(BACKEND_URL."team/index/".$page_num);
		//return true;
	}
	public function team_batch_action(){
		$this->chk_login();	
		
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'delete'){
			$this->deletebatch($pagearray);
		} else if($action == 'active'){
			$this->batchstatus('active', $pagearray);
		} else if($action == 'inactivate'){ 
			$this->batchstatus('inactive', $pagearray);
		} else {
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."team/index/".$page);
		return true;
			
	}
	public function deletebatch($pagearray) {
		if(is_array($pagearray))
		{
			
			$team_id=implode(",", $pagearray);
			$Condition 		= "id = '".$team_id."' ";
		$arr_team_image	= $this->model_basic->getValues_conditions($this->teamManagementTable, '*', '', $Condition);
//pr($arr_team_image);exit;
				if($arr_team_image && !empty($arr_team_image)){
					foreach($arr_team_image as $image){
		
						if(file_exists(file_upload_absolute_path().'team/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
						{
							unlink(file_upload_absolute_path().'team/'.stripslashes($image['image']));
						}
				
						if(file_exists(file_upload_absolute_path().'team/thumb/'.stripslashes($image['image'])) && stripslashes($image['image']) != "")
						{
							unlink(file_upload_absolute_path().'team/thumb/'.stripslashes($image['image']));
						}				
						
					}
				}
				$delete_where	= "FIND_IN_SET(id, '".implode(",", $pagearray)."')";
			$this->model_basic->deleteData($this->teamManagementTable, $delete_where);
			$this->session->set_userdata('succmsg', "Selected team member deleted successfully.");
		}
		else
		{
			$this->session->set_userdata('errmsg', "Please select atleast one team member to delete.");
		}
		return true;
	}
	
	public function batchstatus($status, $idArray) {
		if($status == '')
			return false;
		
		$updArr		= 'status';
		$return 	= $this->model_basic->changeStatus($this->teamManagementTable, $idArray, $updArr, $status, 'id');		
		
		if($return == 'noitem'){
			$this->session->set_userdata('errmsg', "Please select at least one team member to change status.");
		}elseif($return == 'noact'){
			$this->session->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive'){
			$this->session->set_userdata('succmsg', "Selected team member status Activated successfully.");
		}elseif($return == 'active'){
			$this->session->set_userdata('succmsg', "Selected team member status Inactivated successfully.");
		}		
		return true;
	}
	

}