<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry extends CI_Controller
{
	
	var $enquiryMaster	= 'lp_enquiry_master';
	var $agentMaster	= 'lp_agent_master';
	var $actionMaster	= 'lp_action_master';
	var $enquiryLead	= 'lp_enquiry_lead';
	var $adminMaster	= 'lp_adminuser';
	var $calendarEvent	= 'lp_calendar_event';
	var $propertyVisited 	= 'lp_property_visited';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_enquiry');
		//$this->load->model('model_calendar');
		
	}
	
	public function index()
	{
            chk_login();
	    $this->data = '';
            
            
            //<!-----------------code---------------------->
            
            $config['base_url'] 	= BACKEND_URL."enquiry/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('ENQUIRY');
		
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
		
		$this->data['enquiryList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['enquiryList']		= $this->model_enquiry->getAllEnquiryList($config,$start);
		
		$i=0;
		
		if(is_array($this->data['enquiryList']))
		{
			foreach($this->data['enquiryList'] as $value)
			{
				$enquiry_id		= $value['enquiry_id'];
				$arr_assigned_user_id	= $this->model_enquiry->getAssignedUserInEnquiryLead($enquiry_id); //pr($arr_assigned_user_id);
				$arr_user_id		= explode(",", $arr_assigned_user_id[0]['assigned_to']); //pr($arr_user_id);
				
				if(in_array($this->nsession->userdata('admin_id'), $arr_user_id))
				{
					$this->data['enquiryList'][$i]['assigned_user'] = 1;
				}
				else
				{
					$this->data['enquiryList'][$i]['assigned_user'] = 0;
				}
				$i++;
			}
		}
		
		$this->data['latestEnquiry']=$this->model_basic->getValues_conditions($this->enquiryMaster,'enquiry_id','','',' enquiry_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
                //$this->data['totalRecord'] =0;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= BACKEND_URL."enquiry/index/0/1/";
		$this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/index/";
		$this->data['view_link']      		= BACKEND_URL."enquiry/view_enquiry/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."enquiry/lead_enquiry/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."enquiry/delete_enquiry/{{ID}}/".$page."/sales/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
            
            //<!-----------------code-end--------------------->
            
            $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='enquiry/list';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
        }
	
	public function view_enquiry()
	{
	    chk_login();
	    $this->data = '';
	    //<!---------------------------------------------------->
	    
		$page		= $this->uri->segment(4, 0);
		$enquiry_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "enquiry";
		$this->data['base_url'] 	= BACKEND_URL."enquiry/index/";
		$this->data['view_link']      		= BACKEND_URL."enquiry/view_enquiry/".$enquiry_id."/".$page."/";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$listingpage."/".$page;
		
	        $row = array();
		
		$this->model_enquiry->changeEnquiryRead($enquiry_id);
		
		$arr_enquiry_detail = $this->model_enquiry->getEnquiryDetails($enquiry_id); //pr($arr_enquiry_detail);
		
		$row = $arr_enquiry_detail[0];
                if($row){
                    $this->data['enquiryDetails'] = $row;
                }
		else
		{
			$this->session->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/".$listingpage."/".$page."/");
                        return false;
		}
		
		$property_field_name		= array('property_search_info', 'property_search_flag');
		$property_condition		= "enquiry_id = '".$enquiry_id."'";
		$arr_property_visited 		= $this->model_basic->getValues_conditions($this->propertyVisited, $property_field_name, '', $property_condition); //pr($arr_property_visited);
		$this->data['arr_property_search'] 	= $arr_property_visited;
	    
	    
	    //<!--------------------------------------------------->
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='enquiry/view';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function delete_enquiry(){
		
		chk_login();
		$enquiry_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		$type 		= $this->uri->segment(5);
				
		/*** DELETE from lp_enquiry_lead  ***/
		$sql_del1 	= "DELETE FROM lp_enquiry_lead WHERE enquiry_id = '".$enquiry_id."'";
		$rs_del1  	= $this->db->query($sql_del1);
		
		/*** Delete from lp_calendar_event ***/
		$sql_del2	= "DELETE FROM lp_calendar_event WHERE enquiry_id = '".$enquiry_id."'";
		$rs_del2  	= $this->db->query($sql_del2);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM lp_enquiry_master WHERE enquiry_id = '".$enquiry_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		$this->nsession->set_userdata('succmsg', "Selected Enquiry deleted successfully.");
		
		/*if($type == 'sales')
			redirect(BACKEND_URL.'enquiry/sales_enquiry/'.$page);
		else if($type == 'rental')
			redirect(BACKEND_URL.'enquiry/rental_enquiry/'.$page);
		else
			redirect(BACKEND_URL.'enquiry/general_enquiry/'.$page);*/
		
		redirect(BACKEND_URL.'enquiry/index/');
	}
	
	
	public function batch_action(){
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$per_page1	= $this->input->get_post('per_page1',true);
				
		if($action == 'Delete'){
				$this->deletebatch();
		}  else {
				$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(base_url()."enquiry/index/".$per_page1);
		return true;
			
	}
	
	
	private function deletebatch(){
		chk_login();
		$return = $this->model_enquiry->deleteBatchEnquiry();
		if($return == 'noitem'){
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}elseif($return == 'noact'){
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'delsuccess'){
			$this->nsession->set_userdata('succmsg', "Selected Enquiry deleted successfully.");
		}
		return true;
	}

	public function get_new_enquiry()
	{
		
		chk_login();
		$data=array();
		$enquiry_id=$this->input->get_post('latest_enquiry');
		$enquiry_details= $this->model_enquiry->getValue_condition("lp_enquiry_master","","  enquiry_id > '".$enquiry_id."'");
		
		
		$latest = $enquiry_details;
		if(isset($latest[0]['enquiry_id']))
		{
			
			$prop_name = $this->model_enquiry->getValue_condition("lp_property_master","property_name","  property_id = '".$latest[0]['property_id']."'");
			$prop_slug = $this->model_enquiry->getValue_condition("lp_property_master","property_slug","  property_id = '".$latest[0]['property_id']."'");
			
			if(isset($prop_slug[0]['property_slug']))
				$enquiry_details[0]['prop_slug'] = $prop_slug[0]['property_slug'];
			
			if(isset($prop_name[0]['property_name']))
				$enquiry_details[0]['prop_name'] = $prop_name[0]['property_name'];
		}	
			$data['new_enquiry'] = 	$enquiry_details;
		if(isset($latest[0]['enquiry_id']))
		{
			$data['latest_id'] = $latest[0]['enquiry_id'];			
		}
		else
		{
			$data['latest_id'] = $enquiry_id;			
		}
		
		echo $html = $this->load->view('enquiry/get_new_enquiry', $data, TRUE);	
	}
}
?>