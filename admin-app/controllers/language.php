<?php
class Language extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_language");
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	        $config['base_url'] 	= BACKEND_URL."language/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('LANGUAGE_SEARCH');
		
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
		$this->data['languageList']	= $this->model_language->getList($config,$start);
		$this->data['startRecord'] 	= $start;
               
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'language';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_language/0/".$page."/";
		
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_language/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_language/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][0]['name']   =   'Language';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][1]['name']   =   'Language Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='language/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
		
		$id 		= $this->uri->segment(3, 0);
		$language_name	= strip_tags(addslashes(trim($this->input->get_post('language_name'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'property_language_name' => $language_name,
						 'property_language_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'property_language_name' => $language_name );
		}
		$bool 	= $this->model_basic->checkRowExists(LANGUAGE_MASTER, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function add_language()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	        //$language_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "language";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('language_name', 'Language Name', 'trim|required|callback_is_name_exists');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
                                
				$language_name     = addslashes($this->input->post('language_name'));
                                $language_slug     = create_slug(addslashes($this->input->post('language_name')));
				$language_status	= addslashes($this->input->post('language_status'));
				
				
				
				$insertArr  =  array(
							'property_language_name'	=> $language_name,
							'property_language_slug'	=> $language_slug,
							'status'           		=> $language_status
						);
			   
				$res = $this->model_basic->insertIntoTable(LANGUAGE_MASTER,$insertArr);
				if($res)
				{
					$this->nsession->set_userdata('succmsg', "Language Added Successfuly.");
					redirect(base_url()."language/");
				}else{
					$this->nsession->set_userdata('errmsg', "Unable To Add Language");
					redirect(base_url()."language/");
				}
			}
		}
		
		//$this->data['propertyTypeid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][0]['name']   =   'Language';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][1]['name']   =   'Language Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."language/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New Language';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_language/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='language/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_language()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$language_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "language";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
		if($this->input->get_post('action') == 'Process'){			
	     $this->form_validation->set_rules('language_name', 'Language Name','trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			}
			else
			{
				
				                      
				$language_name     = addslashes($this->input->post('language_name'));
                                $language_slug     = create_slug(addslashes($this->input->post('language_name')));
				$language_status	= addslashes($this->input->post('language_status'));
						
						
						
						$updateArr  =  array(
							'property_language_name'	=> $language_name,
							'property_language_slug'	=> $language_slug,
							'status'           		=> $language_status
						);
						
						$idArr		= array(
									'property_language_id' => $language_id
									);

						
						$ret   = $this->model_basic->updateIntoTable(LANGUAGE_MASTER,$idArr, $updateArr);
						if(isset($ret))
						{
							$this->nsession->set_userdata('succmsg', "Language updated successfully.");
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
						}
						redirect(BACKEND_URL."language/index/".$page."/");
						return true;
				
				
				
			}
		}		
		
                $row = array();

		// Prepare Data
		$Condition = " property_language_id = '".$language_id."'";
		$rs = $this->model_basic->getValues_conditions(LANGUAGE_MASTER, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_language'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_language/".$page."/");
                        return false;
                }
	
	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][0]['name']   =   'Language';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-comment';
	$this->data['brdLink'][1]['name']   =   'Language Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."language/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit Language';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url']      = BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_language/".$language_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='language/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_language()
    {
		$id = $this->uri->segment(3, 0);
		
		if($id!=NULL)
		{
			
			$delete_where	= "FIND_IN_SET(property_language_id, '".$id."')";
			$res = $this->model_basic->deleteData(LANGUAGE_MASTER, $delete_where);
			if($res)
			{
				$this->nsession->set_userdata('succmsg', " Language Deleted Successfuly.");
				redirect(base_url()."language/");
			}
			else
			{
				
				$this->nsession->set_userdata('succmsg', "Unable to Delete Language");
				redirect(base_url()."language/");
			}
		}
    }
    
    public function change_status(){
	$lan_id = $this->input->post('id');
	$alias		= '';
	$condition	= "property_language_id = '".$lan_id."'";
	$rec = $this->model_basic->getValues_conditions(LANGUAGE_MASTER, '', $alias, $condition);
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
		     
	    $idArr      = array('property_language_id' => $lan_id);
     
	    $ret   = $this->model_basic->updateIntoTable(LANGUAGE_MASTER,$idArr, $updateArr);
	}
    }
    
    public function edit_status()
    {
	    chk_login();
	    if($this->uri->segment(3,0)!=''){
		    $property_language_id	= $this->uri->segment(3,0);
	    }else if($this->input->post('property_language_id')!=''){
		    $property_language_id	= $this->input->post('property_language_id');
	    }
	    $page_num	= 0;
	    
	    $this->data['province_id']		= $property_language_id;
	    $this->data['page_num']		= $page_num;
	    
	    $table_name	= LANGUAGE_MASTER;
	    $field_name	= 'status';
	    $alias		= '';
	    $condition	= "property_language_id = '".$property_language_id."'";
	    
	    $prev_status = $this->model_basic->getValue_condition($table_name, $field_name, $alias, $condition);
	    //echo $prev_status; exit;
	    if($prev_status == 'Active')
	    {
		    $new_status = 'Inactive';
	    }
	    else
	    {
		    $new_status = 'Active';
	    }
	    
	    $updateArr		=  array('status'	=> $new_status);
	    
	    $idArr		= array('property_language_id' =>  $property_language_id);
	    
	    $update = $this->model_language->updateStatus($table_name ,$idArr, $updateArr);
	    
	    echo  ucwords ( $new_status);
    }
}
?>