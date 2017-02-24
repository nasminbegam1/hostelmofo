<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry extends My_Controller
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;
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
		$this->load->model('model_contact');
	}
	
	public function index()
	{
		$this->chk_login();
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('ENQUIRY');
			redirect(currentClass().'/index/0');
		}
		
		$config['base_url'] 	= BACKEND_URL."enquiry/index/";
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
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
		
		
		$this->data['latestEnquiry']=$this->model_basic->getValues_conditions($this->enquiryMaster,'enquiry_id','','',' enquiry_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= BACKEND_URL."enquiry/listing/0/1/";
		$this->data['view_link']      		= BACKEND_URL."enquiry/view_enquiry/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."enquiry/lead_enquiry/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."enquiry/delete_enquiry/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
				
		$this->data['brdLink']	= array(
						 array('logo'=>'fa fa-home','name'=>'Enquiry','link'=>'javascript:void();'),
						array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
					);
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='enquiry/enquiry_listing';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
			
	}
	
	
	public function view_enquiry()
	{
		$this->chk_login();
		$page		= $this->uri->segment(4, 0);
		$enquiry_id 	= $this->uri->segment(3, 0);
		$listingpage	= $this->uri->segment(5, 0);
		
		$this->data['controller']	= "enquiry";
		$this->data['base_url'] 	= BACKEND_URL."enquiry/listing/".$listingpage."/0/1/";
		
	        $row = array();
		// Prepare Data
		
		$this->model_enquiry->changeEnquiryRead($enquiry_id);
		
		$arr_enquiry_detail = $this->model_enquiry->getEnquiryDetails($enquiry_id); //pr($arr_enquiry_detail);
		
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/listing/".$listingpage."/".$page;
		
		$row = $arr_enquiry_detail[0];
		//pr($row);
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
		//$arr_property_visited 		= $this->model_basic->getValues_conditions($this->propertyVisited, $property_field_name, '', $property_condition); //pr($arr_property_visited);
		//$this->data['arr_property_search'] 	= $arr_property_visited;
		
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['brdLink']	= array(
						 array('logo'=>'fa fa-home','name'=>'Enquiry','link'=>'javascript:void();'),
						array('logo'=>'glyphicon glyphicon-eye-open','name'=>'View','link'=>'javascript:void();')
					);
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='enquiry/enquiry_view';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	

	public function delete_enquiry(){
		$enquiry_id 	= $this->uri->segment(3);
		$page 		= $this->uri->segment(4);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM ".ENQUIRY_MASTER." WHERE enquiry_id = '".$enquiry_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		$this->nsession->set_userdata('succmsg', "Selected enquiry is deleted successfully.");
		
		
		redirect(BACKEND_URL.'enquiry/index/'.$page);
	}
	
	public function contact_us()
	{
		$this->chk_login();
		
		if($this->input->post('btn_show_all') ==  'show_all'){
			$this->nsession->unset_userdata('CONTACT');
			redirect(currentClass().'/contact_us/0');
		}
		
		$config['base_url'] 	= BACKEND_URL."enquiry/contact_us/";
		$config['per_page'] 	= 50;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 20;
		$this->pagination->setAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CONTACT');
		
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
		
		$this->data['contactList']		= array();
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['contactList']		= $this->model_contact->getAllContactList($config,$start);
		
		$i=0;
		
		
		//$this->data['latestEnquiry']=$this->model_basic->getValues_conditions($this->enquiryMaster,'enquiry_id','','',' enquiry_id DESC ','',$Limit=1); 
		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'enquiry';	
		$this->data['base_url'] 		= BACKEND_URL."enquiry/listing/0/1/";
		$this->data['view_link']      		= BACKEND_URL."enquiry/view_enquiry/{{ID}}/".$page."/";
		$this->data['lead_link']      		= BACKEND_URL."enquiry/lead_enquiry/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."enquiry/delete_enquiry/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
				
		$this->data['brdLink']	= array(
						 array('logo'=>'fa fa-comments','name'=>'Contact us form','link'=>'javascript:void();'),
						array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
					);
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='enquiry/contact';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
}