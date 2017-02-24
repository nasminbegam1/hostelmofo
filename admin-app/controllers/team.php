<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Team extends CI_Controller
{
	var $teamManagementTable	= 'hw_team_management';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_team');
		$this->load->model('model_basic');
		$this->load->library('cdnupload');
		$this->load->library('image_lib');
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
		 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Team Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
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
		
		$team_member = $this->model_team->getMemberCount();
		$team_member_count = $team_member[0]['member_count'] + 1;
		$this->data['team_member_count'] =  $team_member_count;
		
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
				$team_type              = trim(addslashes($this->input->get_post('team_type')));
				$name			= trim(addslashes($this->input->get_post('name')));
				$designation		= trim(addslashes($this->input->get_post('designation')));
				$description		= trim(addslashes($this->input->get_post('description')));
				$facebook_link	        = trim(addslashes($this->input->get_post('fb_link')));
				$twitter_link	        = trim(addslashes($this->input->get_post('twitter_link')));
				$googleplus_link	= trim(addslashes($this->input->get_post('google_link')));
				$intragram_link		= trim(addslashes($this->input->get_post('instragram_link')));
				$linkedin_link		= trim(addslashes($this->input->get_post('linkedin_link')));
				$status			= trim(addslashes($this->input->get_post('status')));
				$order                  = trim(addslashes($this->input->get_post('team_order')));		
				$user_image 		= '';
				
				
				if(is_array($_FILES) and count($_FILES['user_image'])>0 and $_FILES['user_image']['tmp_name']!='' )
				{
					$tmp_name = $_FILES['user_image']['tmp_name'];
			                list($width, $height, $type, $attr) = getimagesize($tmp_name);
					
					 $file_name = $_FILES['user_image']['name'];
			                 $new_team_image = $this->cdnupload->getFileNewName($file_name);
					 
					 $config 	= array(
						'image_library' 	=> 'GD2',
						'source_image'		=> $tmp_name,
						'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'team/'.$new_team_image
						
					    );
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
						
					 $file = FRONTEND_URL.'upload/team/'.$new_team_image;
					 $this->cdnupload->upload($file,'team/',$new_team_image);
					 @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'team/'.$new_team_image);
					 
					 $this->image_lib->clear();
					 
					 
					$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'team/thumb/'.$new_team_image,
						    'create_thumb'	=> true,
						    'width'		=> '400',
						    'height'	        => '400'
						    
						);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/team/thumb/'.$new_team_image;
					$this->cdnupload->upload($file,'team/thumb',$new_team_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'team/thumb/'.$new_team_image);
					
					$this->image_lib->clear();
				}
				if($new_team_image!=''){
					
					$user_image = $new_team_image;
				}
				else
				{
					$user_image = '';
				}
				
				$insertArray = array(
						     'team_type'		=> $team_type,
						     'name'			=> $name,
						     'designation'		=> $designation,
						     'description'		=> $description,
						     'facebook_link'	        => $facebook_link,
						     'twitter_link'		=> $twitter_link,
						     'googleplus_link'		=> $googleplus_link,
						     'intragram_link'		=> $intragram_link,
						     'linkedin_link'		=> $linkedin_link,
						     'image'			=> $user_image,
						     'status'			=> $status,
						     'team_order'		=> $order
						     );
				
				
				$i_check = $this->model_team->insertIntoTable(TEAM, $insertArray);
				
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
//For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Team Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."team/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
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
		
		$team_member = $this->model_team->getMemberCount();
		$team_member_count = $team_member[0]['member_count'] + 1;
		$this->data['team_member_count'] =  $team_member_count;
		
		$condition	= " id = '".$team_id."'";
		$arr_team	= $this->model_basic->getValues_conditions(TEAM, '', '', $condition);
		
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
				
				$image_name_old		= $this->data['arr_team']['image'];
	   
				
				$team_type              = trim(addslashes($this->input->get_post('team_type')));
				$name			= trim(addslashes($this->input->get_post('name')));
				$designation		= trim(addslashes($this->input->get_post('designation')));
				$description		= trim(addslashes($this->input->get_post('description')));
				$facebook_link	        = trim(addslashes($this->input->get_post('fb_link')));
				$twitter_link	        = trim(addslashes($this->input->get_post('twitter_link')));
				$googleplus_link	= trim(addslashes($this->input->get_post('google_link')));
				$intragram_link		= trim(addslashes($this->input->get_post('instragram_link')));
				$linkedin_link		= trim(addslashes($this->input->get_post('linkedin_link')));
				$status			= trim(addslashes($this->input->get_post('status')));
				$order                  = trim(addslashes($this->input->get_post('team_order')));		
				$new_team_image 		= '';
				
				
				if(is_array($_FILES) and count($_FILES['user_image'])>0 and $_FILES['user_image']['tmp_name']!='' )
				{
					$tmp_name = $_FILES['user_image']['tmp_name'];
			                list($width, $height, $type, $attr) = getimagesize($tmp_name);
					
					 $file_name = $_FILES['user_image']['name'];
			                 $new_team_image = $this->cdnupload->getFileNewName($file_name);
					 
					 $config 	= array(
						'image_library' 	=> 'GD2',
						'source_image'		=> $tmp_name,
						'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'team/'.$new_team_image
						
					    );
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
						
					 $file = FRONTEND_URL.'upload/team/'.$new_team_image;
					 $this->cdnupload->upload($file,'team/',$new_team_image);
					 @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'team/'.$new_team_image);
					 
					 $this->image_lib->clear();
					 
					 
					$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'team/thumb/'.$new_team_image,
						    'create_thumb'	=> true,
						    'width'		=> '400',
						    'height'	        => '400'
						    
						);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$file = FRONTEND_URL.'upload/team/thumb/'.$new_team_image;
					$this->cdnupload->upload($file,'team/thumb',$new_team_image);
					@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'team/thumb/'.$new_team_image);
					
					$this->image_lib->clear();
				}

				
				$updateArray = array(
						     'team_type'		=> $team_type,
						     'name'			=> $name,
						     'designation'		=> $designation,
						     'description'		=> $description,
						     'facebook_link'	        => $facebook_link,
						     'twitter_link'		=> $twitter_link,
						     'googleplus_link'		=> $googleplus_link,
						     'intragram_link'		=> $intragram_link,
						     'linkedin_link'		=> $linkedin_link,
						     'status'			=> $status,
						     'team_order'		=> $order
						     );
				
				if($new_team_image!=''){
					    $updateArray['image'] = $new_team_image;
				}
					
				
				$updateArr = array( 'id' => $team_id );
				
				//if(($_FILES['user_image']['name']!='') && stripslashes($image_name_old) != "")
				// {
				//	 @unlink(CDN_BANNER_IMG.stripslashes($image_name_old));
				//	 @unlink(CDN_BANNER_THUMB_IMG.stripslashes($image_name_old));
				// }
				//
				
				
				$i_check = $this->model_team->updateIntoTable(TEAM ,$updateArr ,$updateArray);
				if(isset($i_check))
				{
					$this->nsession->set_userdata('succmsg', 'Reocrd successfully updated.');
					
					redirect(BACKEND_URL."team/index/".$page."/");
		   
					return true;
				}
				else
				{
					$this->nsession->set_userdata('errmsg', 'Record not updated.');
					redirect(BACKEND_URL."team/index/".$page."/");
					
						
					
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
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-group';
	$this->data['brdLink'][1]['name']   =   'Team Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."team/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
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
		
		if($team_id)
		{
			
			$arr_member_existing_image = $this->model_team->get_single($team_id);
			$member_existing_image    = $arr_member_existing_image[0]['image'];
			
			
			$delete_where	= "id = '".$team_id."' ";
		        $d9 = $this->model_team->deleteData(TEAM, $delete_where,$team_id);
			
			if($d9)
			{
				
			//      if(isFileExist(CDN_TEAM_IMG.$member_existing_image) && stripslashes($member_existing_image) != "")
			//      {
			//		 @unlink(CDN_TEAM_IMG.stripslashes($member_existing_image));
			//		 @unlink(CDN_TEAM_THUMB_IMG.stripslashes($member_existing_image));
			//      }
				
				$this->nsession->set_userdata('succmsg', "Selected team member deleted successfully.");
				redirect(BACKEND_URL.'team/index/'.$page);
			}
			//$this->delete_image($team_id);
		}
		else
		{
			$this->nsession->set_userdata('succmsg', "Unable to Delete team member");
			redirect(BACKEND_URL.'team/index/'.$page);
		}
		
		
		
	}
	public function delete_image($team_id)
	{
		$Condition 		= "id = '".$team_id."' ";
		$arr_team_image	= $this->model_basic->getValues_conditions(TEAM, '*', '', $Condition);
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
		$this->model_basic->deleteData(TEAM, $delete_where);
		return true;
	}
	
	public function change_status(){
		$type_id = $this->input->post('id');
		$alias		= '';
		$condition	= "id = '".$type_id."'";
		$rec = $this->model_basic->getValues_conditions(TEAM, '', $alias, $condition);
		if(is_array($rec) and count($rec)>0){
		    $rec =$rec[0];
		   $status = $rec['status'];
		   $new_status ='';
		   if($status=='active'){
		     $new_status = 'inactive';
		   }
		   else if($status=='inactive'){
		     $new_status = 'active';
		   }
		   
		    $updateArr  =  array('status' => $new_status);
			     
		    $idArr      = array('id' => $type_id);
	     
		    $ret   = $this->model_basic->updateIntoTable(TEAM,$idArr, $updateArr);
		}
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
		
		$table_name	= TEAM;
		$field_name	= 'status';
		$alias		= '';
		$condition	= "id = '".$team_id."'";
		
		$prev_status = $this->model_basic->getValue_condition(TEAM, $field_name, $alias, $condition);
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
		
		$update = $this->model_team->updateStatus(TEAM ,$idArr, $updateArr);
		
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
		$arr_team_image	= $this->model_basic->getValues_conditions(TEAM, '*', '', $Condition);
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
			$this->model_basic->deleteData(TEAM, $delete_where);
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
		$return 	= $this->model_basic->changeStatus(TEAM, $idArray, $updArr, $status, 'id');		
		
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