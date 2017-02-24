<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_letter extends CI_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('model_basic');
                $this->load->model('model_newsletter');
	}
	
	public function index()
	{
		chk_login();
                $config['base_url'] 	= BACKEND_URL."news_letter/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('NEWSLETTER');
		
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
		
                $this->data['brdLink'][0]['logo']   =   'fa fa-info-circle';
                $this->data['brdLink'][0]['name']   =   'Newsletter';
                $this->data['brdLink'][0]['link']   =   'javascript:void(0)';
                
                $this->data['brdLink'][1]['logo']   =   'fa fa-info-circle';
                $this->data['brdLink'][1]['name']   =   'Newsletter Listing';
                $this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['newsletter_list']		= $this->model_newsletter->getTeamList($config,$start);
		//pr($this->data['teamMasterList']);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'news_letter';	
		$this->data['base_url'] 		= BACKEND_URL."news_letter/index/0/1/";				
		$this->data['show_all']      		= BACKEND_URL."news_letter/index/0/1/";
		//$this->data['add_url']      		= BACKEND_URL."team/add_team_member/0/".$page."/";
		
		//$this->data['edit_link']      		= BACKEND_URL."team/edit_team_member/{{ID}}/".$page."/";
		//$this->data['delete_link']		= BACKEND_URL."team/delete_team_member/{{ID}}/".$page."/";		
		//$this->data['image_link']		= BACKEND_URL."team/team_image/{{ID}}/".$page."/";		
		//$this->data['batch_action_link']	= BACKEND_URL."team/team_batch_action/0/".$page."/";

		$this->pagination->initialize($config);
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		$this->data['pagination']=$this->pagination->create_links();
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		
		$this->elements['middle']='news_letter/index';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
        
        }
}