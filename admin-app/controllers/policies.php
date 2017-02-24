<?php
class policies extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_policies");
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	        $config['base_url'] 	= BACKEND_URL."policies/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('POLOCIES_MASTER');
		
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
		$this->data['hearAboutList']	= $this->model_policies->getList($config,$start);
		$this->data['startRecord'] 	= $start;
               
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'policies';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_policies/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_policies/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_policies/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][0]['name']   =   'Policy';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][1]['name']   =   'Policy Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='policies/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
		
		$id 			= $this->uri->segment(3, 0);
		$policies_name	= strip_tags(addslashes(trim($this->input->get_post('policies_name'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'policies_name' => $policies_name,
						 'policies_master_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'policies_name' => $policies_name );
		}
		$bool 	= $this->model_basic->checkRowExists(POLICY_MASTER, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function add_policies()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	        $policies_master_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "policies";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('policies_name', 'Policy Name', 'trim|required|callback_is_name_exists');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
                                
				$policies_name     = addslashes($this->input->post('policies_name'));
				$policies_status   = addslashes($this->input->post('policies_status'));
				
				
				
				$insertArr  =  array(
							'policies_name'	        => $policies_name,
							'policies_slug'	        => url_title($policies_name),
							'status'           	=> $policies_status
						);
			    
				$res = $this->model_basic->insertIntoTable(POLICY_MASTER,$insertArr);
				if($res)
				{
					$this->nsession->set_userdata('succmsg', "Policy Added Successfuly.");
					redirect(base_url()."policies/");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable to Add Policy");
					redirect(base_url()."policies/");
				}
			}
		}
		
		$this->data['hearAboutid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][0]['name']   =   'Policy';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][1]['name']   =   'Policy Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."policies/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New Policy';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_policies/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='policies/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_policies()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$policies_master_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
	$this->data['controller']	= "policies";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
       // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
	
	if($this->input->get_post('action') == 'Process'){			
	    $this->form_validation->set_rules('policies_name', 'Policy Name', 'trim|required|callback_is_name_exists');
			
	    if ($this->form_validation->run() == FALSE){
		
	    }
	    else
	    {		  
		    $policies_name     = addslashes($this->input->post('policies_name'));
		    $policies_status	= addslashes($this->input->post('policies_status')); 
		    
		    $insertArr  =  array('policies_name'	        => $policies_name,
					 'policies_slug'	        => url_title($policies_name),
					'status'           		=> $policies_status);
		    
		    //pr($insertArr);
		    	    
		    $idArr		= array('policies_master_id' => $policies_master_id);	    
		    $ret   = $this->model_basic->updateIntoTable(POLICY_MASTER,$idArr, $insertArr);
		    if(isset($ret))
		    {
			    $this->nsession->set_userdata('succmsg', "Policy updated successfully.");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
		    }
		    redirect(BACKEND_URL."policies/index/".$page."/");
		    return true;  
		    
	    }
	}		
		
	$row = array();

	// Prepare Data
	$Condition = " policies_master_id = '".$policies_master_id."'";
	$rs = $this->model_basic->getValues_conditions(POLICY_MASTER, '', '', $Condition);
	
	$row = $rs[0];
	if($row){
	    $this->data['arr_policies'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit_policies/".$page."/");
		return false;
	}

	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][0]['name']   =   'Policy';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'glyphicon glyphicon-thumbs-up';
	$this->data['brdLink'][1]['name']   =   'Policy Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."policies/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit Policy';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_policies/".$policies_master_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='policies/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_policies()
    {
	$id = $this->uri->segment(3, 0);
	
	if($id!=NULL)
	{
		$Condition = " policy_master_id = '".$id."'";
		$rs = $this->model_basic->isRecordExist(PROPERTY_POLICIES, $Condition);
		if($rs){
		    $this->nsession->set_userdata('errmsg', "Unable to Delete Policy.It is associated with one of the property.");
		    redirect(base_url()."policies/");
		}else{
		    $delete_where	= "FIND_IN_SET(policies_master_id, '".$id."')";
		    $res = $this->model_basic->deleteData(POLICY_MASTER, $delete_where);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Policy Deleted Successfuly.");
			    redirect(base_url()."policies/");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to Delete Policy");
			    redirect(base_url()."policies/");
		    }
		}
	}
    }
    
     public function change_status(){
	$policies_master_id = $this->input->post('id');
	$alias		= '';
	$condition	= "policies_master_id = '".$policies_master_id."'";
	$rec = $this->model_basic->getValues_conditions(POLICY_MASTER, '', $alias, $condition);
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
		     
	    $idArr      = array('policies_master_id' => $policies_master_id);
     
	    $ret   = $this->model_basic->updateIntoTable(POLICY_MASTER,$idArr, $updateArr);
	}
    }
    
    
}
?>