<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homecontent extends CI_Controller 
{
	var $homecontentTable 	= 'lp_homecontent';
	
	public function __construct()
	{
		parent::__construct();
                $this->load->model('model_home');
                $this->load->model('model_basic');
	}
        public function index(){
		chk_login();
		$config['base_url'] 	= BACKEND_URL."homecontent/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setAdminPaginationStyle($config);
                $this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('homecontent_SEARCH');
		
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
		$this->data['homecontentList']	= $this->model_home->getList($config,$start);
		$this->data['startRecord'] 	= $start;
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
                
		$this->data['controller'] 	= 'homecontent';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_homecontent/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		
		
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='homecontent/index';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
        }
        public function edit_homecontent(){
		
		chk_login();
                $id		= $this->uri->segment(3, 0);
		$page		= $this->uri->segment(4,0);
		$this->data['page']=$page;
                $this->data['controller']	= "homecontent";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		$this->data['edit_link']  	= BACKEND_URL.$this->data['controller']."/edit_homecontent/".$id."/".$page;
		
                if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('home_title', 'Content Title', 'trim|required|callback_is_title_exists|min_length[5]|max_length[5000]');
                        $this->form_validation->set_rules('home_content', 'Home Content', 'trim|required');
                        if ($this->form_validation->run() == FALSE)
			{
				$this->nsession->set_userdata('errmsg', validation_errors());
				
			}
                        else
			{
				$title = addslashes(trim($this->input->get_post('home_title')));
				$content = addslashes(trim($this->input->get_post('home_content')));
                                $updateArr  =  array(
							'title' => $title,
							'content' => $content,
							
							
						);
                                $idArr		= array('id' => $id);
							
							
                                $ret   = $this->model_basic->updateIntoTable($this->homecontentTable,$idArr, $updateArr);
				//if($ret)
				//{
				//	$this->nsession->set_userdata('succmsg', "Home content is updated successfull.");
				//}
				//else
				//{
				//	$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				//}
				$this->nsession->set_userdata('succmsg', "Home content is updated successfull.");
				redirect(BACKEND_URL."homecontent/index/".$page."/");
				return true;        
			}			
		}
                $content_result = array();

                $row = array();
		$Condition = "id = '".$id."'";
		$rs = $this->model_basic->getValues_conditions($this->homecontentTable, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['arr_homecontent'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        //redirect(BACKEND_URL.$this->data['controller']."/index/".$page."/");
                        return false;
		}
		
				
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
	
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");

		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='homecontent/edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
							
							
							
							
						
}