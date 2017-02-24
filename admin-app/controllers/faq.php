<?php
class Faq extends CI_Controller
{
	var $faqMaster = 'hw_faq_master';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_faq');
		
	}
        
    public function index()
    {
	    chk_login();
            $this->data='';
            //<!-----------------code----------------------------->
            $config['base_url'] 	= BACKEND_URL."faq/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('FAQ');
		
		
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
		
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['faqList']	= $this->model_faq->getList($config,$start);
		$this->data['startRecord'] 		= $start;
		$this->data['totalRecord'] 		= $config['total_rows'];
                
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'faq';	
		$this->data['base_url'] 		= BACKEND_URL."faq/index/0/1/";
		$this->data['add_link']      		= BACKEND_URL."faq/add_faq_master/0/".$page."/";
		$this->data['edit_link']      		= BACKEND_URL."faq/edit_faq_master/{{ID}}/".$page."/";
		$this->data['delete_link']		= BACKEND_URL."faq/delete_faq_master/{{ID}}/".$page."/";
		$this->data['batch_action_link']	= BACKEND_URL.$this->data['controller']."/batch_action_faq_master/0/".$page."/";

		$this->pagination->initialize($config);
            
            $this->data['pagination'] = $this->pagination->create_links();
            //<!----------------code------------------------------>
            //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-question';
	$this->data['brdLink'][1]['name']   =   'FAQ Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";    
        //$this->data['brdLink']='';
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='faq/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_faq_title_exists($faq_title)
	{
		
		$faq_type = $_POST['faq_type'];
		$id 	= $this->uri->segment(3,0);
		if($id > 0)
		{
			$whereArr	= array( 'faq_title' => $faq_title,
						 'faq_type'=>$faq_type,	
						 'faq_id != ' => $id						
						);
		}
		else
		{			
			$whereArr	= array('faq_title' => $faq_title,
						'faq_type'=>$faq_type
						
						);
		}
		
		$bool = $this->model_basic->checkRowExists(FAQ, $whereArr);
		if($bool == 0)
		{
			$this->form_validation->set_message('is_faq_title_exists', 'The %s  already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
    public function add_faq_master()
    {
        chk_login();
        $this->data='';
        
        //<!-----------------------code---------------------->
        
        $faq_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "faq";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('faq_title', 'Faq Title', 'trim|required|callback_is_faq_title_exists');
			$this->form_validation->set_rules('faq_desc', 'Faq Description', 'trim|required');
			$this->form_validation->set_rules('faq_type', 'Faq Type', 'trim|required');
			$this->form_validation->set_rules('faq_order', 'Faq Order', 'trim|required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			} else
			{
				$faq_title		= addslashes(trim($this->input->get_post('faq_title')));
				$faq_desc = addslashes(trim($this->input->get_post('faq_desc')));
				$faq_type = trim($this->input->get_post('faq_type'));
				$faq_order = trim($this->input->get_post('faq_order'));
				
				
				$insertArr  =  array(
							'faq_title' => $faq_title,
							'faq_desc' => $faq_desc,
							'faq_type'=>$faq_type,
							'faq_order'=>$faq_order
							
						);
			    
				$ret   = $this->model_basic->insertIntoTable(FAQ,$insertArr);
				if($ret)
				{
					$this->nsession->set_userdata('succmsg', "Faq added successfully.");
				}
				else
				{
					$this->nsession->set_userdata('errmsg', "Unable to add. Please try again later.");
				}
				redirect(BACKEND_URL."faq/index/".$page."/");
				return true;        
			}			
		}		
        
        //<!-----------------------end----------------------->
        $faqorder_result = array();
        $faqorder_result = $this->model_faq->getAllfaqs();
	$this->data['faq_orders'] = $faqorder_result;
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-question';
	$this->data['brdLink'][1]['name']   =   'FAQ Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."faq/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New FAQ';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................

        $this->data['controller'] 	= 'faq';
       // $this->data['brdLink']='';
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      = BACKEND_URL.$this->data['controller']."/add_faq_master/0/1/";
        
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='faq/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    	public function edit_faq_master()
	{
		chk_login();
		$faq_id		= $this->uri->segment(3, 0);
		$page			= $this->uri->segment(4,0);
		
		$this->data['controller']	= "faq";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('faq_title', 'Faq title', 'trim|required|callback_is_faq_name_exists');
			$this->form_validation->set_rules('faq_desc', 'Faq Description', 'trim|required');
			$this->form_validation->set_rules('faq_type', 'Faq Type', 'trim|required');
			$this->form_validation->set_rules('faq_order', 'Faq Order', 'trim|required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$faq_title = addslashes(trim($this->input->get_post('faq_title')));
				$faq_desc  = addslashes(trim($this->input->get_post('faq_desc')));
				$faq_type  = trim($this->input->get_post('faq_type'));
				$faq_order = trim($this->input->get_post('faq_order'));
				
				$updateArr  =  array(
							'faq_title' => $faq_title,
							'faq_desc' => $faq_desc,
							'faq_type'=>$faq_type,
							'faq_order'=>$faq_order
							
						);
						
				$idArr		= array(
							'faq_id' => $faq_id
							);
			    
				$ret   = $this->model_basic->updateIntoTable(FAQ,$idArr, $updateArr);
				$this->nsession->set_userdata('succmsg', "Faq updated successfully.");
				//if($ret)
				//{
				//	$this->nsession->set_userdata('succmsg', "Faq updated successfully.");
				//}
				//else
				//{
				//	$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				//}
				redirect(BACKEND_URL."faq/index/".$page."/");
				return true;        
			}			
		}
		
		
		$faqorder_result = array();
		$faqorder_result = $this->model_faq->getAllfaqs();
		$this->data['faq_orders'] = $faqorder_result;
		
                $row = array();
		$Condition = "faq_id = '".$faq_id."'";
		$rs = $this->model_basic->getValues_conditions(FAQ, '', '', $Condition);
		
		$row = $rs[0];
                if($row)
		{
                    $this->data['faq_master'] = $row;
                }
		else
		{
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/faq_master/".$page."/");
                        return false;
		}
		
				
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		 //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-question';
	$this->data['brdLink'][1]['name']   =   'FAQ Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."faq/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit FAQ';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
               // $this->data['brdLink']='';
       $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_faq_master/".$faq_id."/".$page."/";
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='faq/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);

	}
    
    
    
    function delete_faq_master()
	{
		
		chk_login();
		
		$faq_id	= $this->uri->segment(3);
		$where			= "faq_id = '".$faq_id."'";
		
			$this->model_basic->deleteData(FAQ, $where);
			$this->nsession->set_userdata('succmsg', "Selected faq deleted successfully.");
		
		
		redirect(BACKEND_URL."faq/");
		return true;
	}
	
	function batch_action_faq_master()
	{
		//********************* this has been done to rectify the redirection problem an extra variable has been added pushan 17.10.2013 refer to line 357/////
		 $page_num = $this->uri->segment(4);
		//*********************  ///// 
		 
		chk_login();	
		$action 	= $this->input->post('group_mode',true);	
		$pagearray	= $this->input->get_post('page',true);
		$totalRecord	= $this->input->get_post('totalRecord',true);
		$startRecord	= $this->input->get_post('startRecord',true);
		$page		= $this->input->get_post('per_page1',true);
		
		if($action == 'Delete')
		{
			$this->deleteFaqBatch($pagearray);
		}
		else if($action == 'Activate')
		{
			$this->faqbatchstatus('active', $pagearray);
		}
		else if($action == 'Inactivate')
		{ 
			$this->faqbatchstatus('inactive', $pagearray);
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}	
		
		redirect(BACKEND_URL."faq/index/".$page_num);
		return true;
		
		
		
	}
	
	private function deleteFaqBatch($pagearray)
	{
                chk_login();
		if(is_array($pagearray))
		{
				
			$where	= "FIND_IN_SET(faq_id, '".implode(",", $pagearray)."')";
			$this->model_basic->deleteData(FAQ, $where);
			$this->nsession->set_userdata('succmsg', "Selected faq(s) deleted successfully.");
			
		}
		else
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to delete.");
		}
		return true;
	}
	
	
	
	private function faqbatchstatus($status, $idArray)
	{
                chk_login();
		if($status == '')
			return false;
		$return 	= $this->model_basic->changeStatus(FAQ, $idArray, 'faq_status', $status, 'faq_id');
		
		if($return == 'noitem')
		{
			$this->nsession->set_userdata('errmsg', "Please select atleast one item to change status.");
		}
		elseif($return == 'noact')
		{
			$this->nsession->set_userdata('errmsg', "Please select an action to apply.");
		}elseif($return == 'deactive')
		{
			$this->nsession->set_userdata('succmsg', "Selected faq status Activated successfully.");
		}elseif($return == 'active')
		{
			$this->nsession->set_userdata('succmsg', "Selected faq status Inactivated successfully.");
		}
		return true;
	}
}
?>