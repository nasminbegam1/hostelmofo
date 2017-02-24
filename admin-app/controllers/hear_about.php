<?php
class Hear_about extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_hear_about");
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	        $config['base_url'] 	= BACKEND_URL."hear_about/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('HEAR_ABOUT_SEARCH');
		
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
		$this->data['hearAboutList']	= $this->model_hear_about->getList($config,$start);
		$this->data['startRecord'] 	= $start;
               
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'hear_about';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_hear_about/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_hear_about/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_hear_about/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Hear About';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'Hear About Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='hear_about/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
		
		$id 			= $this->uri->segment(3, 0);
		$hear_about_name	= strip_tags(addslashes(trim($this->input->get_post('hear_about_name'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'hear_about_name' => $hear_about_name,
						 'hear_about_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'hear_about_name' => $hear_about_name );
		}
		$bool 	= $this->model_basic->checkRowExists(HEAR_ABOUT, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function add_hear_about()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	        $hear_about_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "hear_about";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('hear_about_name', 'Hear About Name', 'trim|required|callback_is_name_exists');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
                                
				$hear_about_name     = addslashes($this->input->post('hear_about_name'));
				$hear_about_status	= addslashes($this->input->post('hear_about_status'));
				
				
				
				$insertArr  =  array(
							'hear_about_name'	        => $hear_about_name,
							'status'           		=> $hear_about_status
						);
			    
				$res = $this->model_basic->insertIntoTable(HEAR_ABOUT,$insertArr);
				if($res)
				{
					$this->nsession->set_userdata('succmsg', "Hear About Content Added Successfuly.");
					redirect(base_url()."hear_about/");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable to Add Hear About Content");
					redirect(base_url()."hear_about/");
				}
			}
		}
		
		$this->data['hearAboutid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Hear About';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'Hear About Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."hear_about/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New Hear About';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_hear_about/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='hear_about/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_hear_about()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$hear_about_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
	$this->data['controller']	= "hear_about";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
       // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
	
	if($this->input->get_post('action') == 'Process'){			
	    $this->form_validation->set_rules('hear_about_name', 'Hear About Name', 'trim|required|callback_is_name_exists');
			
	    if ($this->form_validation->run() == FALSE){
		
	    }
	    else
	    {		  
		    $hear_about_name     = addslashes($this->input->post('hear_about_name'));
		    $hear_about_status	= addslashes($this->input->post('hear_about_status')); 
		    
		    $insertArr  =  array('hear_about_name'	        => $hear_about_name,
					'status'           		=> $hear_about_status);
				    
		    $idArr		= array('hear_about_id' => $hear_about_id);	    
		    $ret   = $this->model_basic->updateIntoTable(HEAR_ABOUT,$idArr, $insertArr);
		    if(isset($ret))
		    {
			    $this->nsession->set_userdata('succmsg', "Hear About Content updated successfully.");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
		    }
		    redirect(BACKEND_URL."hear_about/index/".$page."/");
		    return true;  
		    
	    }
	}		
		
	$row = array();

	// Prepare Data
	$Condition = " hear_about_id = '".$hear_about_id."'";
	$rs = $this->model_basic->getValues_conditions(HEAR_ABOUT, '', '', $Condition);
	
	$row = $rs[0];
	if($row){
	    $this->data['arr_hear_about'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit_hear_about/".$page."/");
		return false;
	}

	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Hear About';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'Hear About Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."hear_about/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit Hear About';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_hear_about/".$hear_about_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='hear_about/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_hear_about()
    {
	$id = $this->uri->segment(3, 0);
	
	if($id!=NULL)
	{
		$Condition = " hear_about_id = '".$id."'";
		$rs = $this->model_basic->isRecordExist(PROPERTY_DETAILS, $Condition);
		if($rs >0){
		    $this->nsession->set_userdata('errmsg', "Unable to Delete Hear About.It\'s used in different place.");
		    redirect(base_url()."hear_about/");
		}else{
		    $delete_where	= "FIND_IN_SET(hear_about_id, '".$id."')";
		    $res = $this->model_basic->deleteData(HEAR_ABOUT, $delete_where);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Hear About Deleted Successfuly.");
			    redirect(base_url()."hear_about/");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to Delete Hear About");
			    redirect(base_url()."hear_about/");
		    }
		}
	}
    }
    
     public function change_status(){
	$hear_about_id = $this->input->post('id');
	$alias		= '';
	$condition	= "hear_about_id = '".$hear_about_id."'";
	$rec = $this->model_basic->getValues_conditions(HEAR_ABOUT, '', $alias, $condition);
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
		     
	    $idArr      = array('hear_about_id' => $hear_about_id);
     
	    $ret   = $this->model_basic->updateIntoTable(HEAR_ABOUT,$idArr, $updateArr);
	}
    }
    
    
}
?>