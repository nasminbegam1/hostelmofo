<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_share extends CI_Controller
{
	
	var $enquiryMaster	= 'lp_enquiry_master';
	var $agentMaster	= 'lp_agent_master';
	var $actionMaster	= 'lp_action_master';
	var $enquiryLead	= 'lp_enquiry_lead';
	var $adminMaster	= 'lp_adminuser';
	var $calendarEvent	= 'lp_calendar_event';
	var $propertyVisited 	= 'lp_property_visited';
	var $propertyShare	= 'lp_share_friend';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_property_share');
		
	}
	
	public function listing()
	{
	chk_login();
        $this->data='';
	//<!--------------code start-------------------->
	
	$config['base_url'] 	= BACKEND_URL."property_share/listing/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	$this->data['params']		= $this->nsession->userdata('PROPERTY');
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
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
	$this->data['propertyShareList']		= array();
	$start 					= 0;
	$page 					= $this->uri->segment(3,0);
	$this->data['propertyShareList']= $this->model_property_share->getAllEnquiryList($config,$start);
	$i=0;
		
		if(is_array($this->data['propertyShareList']))
		{
			foreach($this->data['propertyShareList'] as $value)
			{
				$enquiry_id		= $value['sf_id'];
				$arr_assigned_user_id	= $this->model_property_share->getAssignedUserInEnquiryLead($enquiry_id); //pr($arr_assigned_user_id);
				$arr_user_id		= explode(",", $arr_assigned_user_id[0]['assigned_to']); //pr($arr_user_id);
				
				if(in_array($this->nsession->userdata('admin_id'), $arr_user_id))
				{
					$this->data['propertyShareList'][$i]['assigned_user'] = 1;
				}
				else
				{
					$this->data['propertyShareList'][$i]['assigned_user'] = 0;
				}
				$i++;
			}
		}
		$this->data['latestEnquiry']=$this->model_basic->getValues_conditions($this->propertyShare,'sf_id','','',' sf_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry']);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'property_share';
		$this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/listing/";
		$this->data['base_url'] 		= BACKEND_URL."property_share/listing/0/1/";
		$this->data['view_link']      		= BACKEND_URL."property_share/view_enquiry/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."property_share/lead_enquiry/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."property_share/delete_enquiry/{{ID}}/".$page."/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='enquiry/property_share_listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	

	}
	
	public function delete_enquiry(){
		$enquiry_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM lp_share_friend WHERE sf_id = '".$enquiry_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		$this->nsession->set_userdata('succmsg', "Selected property deleted successfully.");
		
		redirect(BACKEND_URL.'property_share/listing/'.$page);
	}
	
	public function view_enquiry()
	{
		chk_login();
		$page		= $this->uri->segment(4, 0);
		$enquiry_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "property_share";
		$this->data['base_url'] 	= BACKEND_URL."property_share/listing/";
		$this->data['view_link']      		= BACKEND_URL."property_share/view_enquiry/".$enquiry_id."/".$page."/";
		
	        $row = array();
		// Prepare Data
		
		//$this->model_property_share->changeEnquiryRead($enquiry_id);
		
		$arr_enquiry_detail = $this->model_property_share->getEnquiryDetails($enquiry_id); //pr($arr_enquiry_detail);
		
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/listing/".$listingpage."/".$page;
		
		$row = $arr_enquiry_detail[0];
		//echo $row;
                if($row){
                    $this->data['enquiryDetails'] = $row;
                }
		else
		{
			$this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/".$listingpage."/".$page."/");
                        return false;
		}
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='enquiry/enquiry_property_share_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
		
	}
	
	
	
	/*** for Business Type Category ***/

public function get_new_enquiry()
	{		
		$data=array();
		$enquiry_id=$this->input->get_post('latest_enquiry');
		$enquiry_details= $this->model_property_share->getValue_condition("lp_share_friend","","  sf_id > '".$enquiry_id."'");
		
		//echo $enquiry_details;pr($enquiry_details,1);
		$latest = $enquiry_details;
		if(isset($latest[0]['sf_id']))
		{
			//echo "hhh";
			$prop_name = $this->model_property_share->getValue_condition("lp_property_master","property_name","  property_id = '".$latest[0]['sf_property_id']."'");
			$prop_slug = $this->model_property_share->getValue_condition("lp_property_master","property_slug","  property_id = '".$latest[0]['sf_property_id']."'");
			//echo $prop_slug[0]['property_slug'];
			if(isset($prop_slug[0]['property_slug']))
				$enquiry_details[0]['prop_slug'] = $prop_slug[0]['property_slug'];
			//pr($prop_slug,0);
			if(isset($prop_name[0]['property_name']))
				$enquiry_details[0]['prop_name'] = $prop_name[0]['property_name'];
		}	
			$data['new_enquiry'] = 	$enquiry_details;
		if(isset($latest[0]['sf_id']))
		{
			$data['latest_id'] = $latest[0]['sf_id'];			
		}
		else
		{
			$data['latest_id'] = $enquiry_id;			
		}
		//echo $data['latest_id'] ;exit;
		echo $html = $this->load->view('enquiry/get_new_property_enquiry', $data, TRUE);	
	}
	
	public function batch_action(){
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
		//pr($_POST);		
		if($action == 'Delete'){
				$this->deletebatch();
		}  else {
				$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."property_share/listing/".$per_page1);
		return true;
			
	}
		private function deletebatch()
	{		
		$return = $this->model_property_share->deleteBatchEnquiry();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Select Enquiry deleted successfully.");
		}
		return true;
	}
	
}