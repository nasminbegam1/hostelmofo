<?php
class Room_type extends MY_Controller{
    
   
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_room_type");
    }
    
     public function index()
    {
        //chk_login();
	$this->chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	$config['base_url'] 	= BACKEND_URL."room_type/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	$this->data['params']		= $this->nsession->userdata('ROOMTYPE_MASTER_SEARCH');
	
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
	$this->data['roomTypeList']	= $this->model_room_type->getList($config,$start);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= 'room_type';	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_room_type/0/".$page."/";
	$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
	$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_room_type/{{ID}}/".$page."/";
	$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_room_type/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['icon_class']   =   'fa fa-file';
	$this->data['brdLink'][0]['text']   =   'Room Type';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['icon_class']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['text']   =   'Room Type Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	
	
	$this->templatelayout->get_footer();
	$this->templatelayout->get_header();
	$this->templatelayout->get_sidebar('room_type');
	$this->elements['middle'] = 'room_type/list';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);

    }
    
    function is_name_exists()
    {
	
	$id 		= $this->uri->segment(3, 0);
	$roomtype_name	= strip_tags(addslashes(trim($this->input->get_post('room_type_name'))));
	
	$whereArr	= array();
	if($id > 0){
		$whereArr	= array( 'roomtype_name' => $roomtype_name,
					 'roomtype_id != ' => $id						
					);
	}else{			
		$whereArr	= array( 'roomtype_name' => $roomtype_name );
	}
	$bool 	= $this->model_basic->checkRowExists(ROOMTYPE_MASTER, $whereArr );
	if($bool == 0){
		$this->form_validation->set_message('is_name_exists', 'The %s already exists');
		return FALSE;
	}else{
		return TRUE;
	}
    }
    
    public function add_room_type()
    {
        $this->chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	$roomtype_id	= $this->uri->segment(3, 0);
	$page		= $this->uri->segment(4, 0);
	$this->data['controller']	= "room_type";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
       // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
	
	$action = $this->input->post('action',true);
	$this->form_validation->set_rules('roomtype_name', 'Room Type  Name', 'trim|required|is_unique[hw_roomtype_master.roomtype_name]');
	$this->form_validation->set_rules('number_of_bed', 'Number of Bed', 'trim|required');
	
	if($this->input->get_post('action') == 'Process'){
		
		if ($this->form_validation->run() != FALSE && $action != FALSE)
		{	
		    $roomtype_name     	= addslashes($this->input->post('roomtype_name'));
		    $roomtype_slug     	= create_slug(addslashes($this->input->post('roomtype_name')));
		    $roomtype_status	= addslashes($this->input->post('roomtype_status'));
		    $room_price_type	= addslashes($this->input->post('room_price_type'));
		    $number_of_bed	= trim($this->input->post('number_of_bed'));
		    
		    $insertArr  =  array('roomtype_name'	        => $roomtype_name,
					'roomtype_slug'			=> $roomtype_slug,
					//'date_added'			=> date('Y-m-d H i s'),
					'number_of_bed'                 => $number_of_bed,
					'roomtype_status'           	=> $roomtype_status,
					'room_price_type'		=> $room_price_type
					);
		
		    $res = $this->model_basic->insertIntoTable(ROOMTYPE_MASTER,$insertArr);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Room Type Added Successfuly.");
			    redirect(base_url()."room_type/");
		    }else{
			    $this->nsession->set_userdata('errmsg', "Unable to Add Room Type");
			    redirect(base_url()."room_type/");
		    }
		}
	}
	
	//$this->data['propertyTypeid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['icon_class']   =   'fa fa-file';
	$this->data['brdLink'][0]['text']   =   'Room Type';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['icon_class']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['text']   =   'Room Type Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."room_type/index";
	
	$this->data['brdLink'][2]['icon_class']   =   '';
	$this->data['brdLink'][2]['text']   =   'Add New Room Type';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_room_type/0/".$page."/";
        $this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
       
        $this->templatelayout->get_footer();
	$this->templatelayout->get_header();
	$this->templatelayout->get_sidebar('room_type');
	$this->elements['middle'] = 'room_type/add';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
        
       
    }
    
    public function edit_room_type()
    {
        
	$this->chk_login();
        $this->data='';
	//<!------------code------------------->
	$roomtype_id	= $this->uri->segment(3, 0);
        $page		= $this->uri->segment(4, 0);
		
	$this->data['controller']	= "room_type";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
               // $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
	if($this->input->get_post('action') == 'Process'){			
	    $this->form_validation->set_rules('roomtype_name', 'Room Type Name','trim|required|callback_is_name_exists');
	    $this->form_validation->set_rules('number_of_bed', 'Number of Bed', 'trim|required');
	    
	    if ($this->form_validation->run() == FALSE){
		
	    }
	    else
	    {                      
		    $roomtype_name     	= addslashes($this->input->post('roomtype_name'));
		    $roomtype_slug     	= create_slug(addslashes($this->input->post('roomtype_name')));
		    $roomtype_status	= addslashes($this->input->post('roomtype_status'));
		    $room_price_type	= addslashes($this->input->post('room_price_type'));
		    $number_of_bed	= trim($this->input->post('number_of_bed'));
						    
		    $insertArr  =  array('roomtype_name'	        => $roomtype_name,
					'roomtype_slug'			=> $roomtype_slug,
					'number_of_bed'                 => $number_of_bed,
					'roomtype_status'           	=> $roomtype_status,
					'room_price_type'		=> $room_price_type
					);
		    
		    $idArr	= array('roomtype_id' => $roomtype_id);
    
		    //pr($insertArr);
		    $ret   = $this->model_basic->updateIntoTable(ROOMTYPE_MASTER,$idArr, $insertArr);
		    if(isset($ret))
		    {
			    $this->nsession->set_userdata('succmsg', "Room Type  updated successfully.");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
		    }
		    redirect(BACKEND_URL."room_type/index/".$page."/");
		    return true;
	    }
	}		
		
	$row = array();

	// Prepare Data
	$Condition = " roomtype_id = '".$roomtype_id."'";
	$rs = $this->model_basic->getValues_conditions(ROOMTYPE_MASTER, '', '', $Condition);
	
	$row = $rs[0];
	if($row){
	    $this->data['arr_room_type'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit_room_type/".$page."/");
		return false;
	}
	
	         //For breadcrump..........
	$this->data['brdLink'][0]['icon_class']   =   'fa fa-file';
	$this->data['brdLink'][0]['text']   =   'Room Type';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['icon_class']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['text']   =   'Room Type Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."room_type/index";
	
	$this->data['brdLink'][2]['icon_class']   =   '';
	$this->data['brdLink'][2]['text']   =   'Edit Room Type';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_room_type/".$roomtype_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	
	$this->templatelayout->get_footer();
	$this->templatelayout->get_header();
	$this->templatelayout->get_sidebar('room_type');
	$this->elements['middle'] = 'room_type/edit';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
	

    }
    public function delete_room_type()
   {
	$id = $this->uri->segment(3, 0);
	
	if($id!=NULL)
	{
		$Condition = " FIND_IN_SET('".$id."', room_type)";
		$rs = $this->model_basic->isRecordExist(PROPERTY_MASTER, $Condition);
		if($rs >0){
		    $this->nsession->set_userdata('errmsg', "Unable to Delete Room Type.It\'s used in different place.");
		    redirect(base_url()."room_type/");
		}else{
		    $delete_where	= "FIND_IN_SET(roomtype_id, '".$id."')";
		    $res = $this->model_basic->deleteData(ROOMTYPE_MASTER, $delete_where);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Room Type Deleted Successfuly.");
			    redirect(BACKEND_URL."room_type/");
		    }
		    else
		    {  
			    $this->nsession->set_userdata('errmsg', "Unable to Delete Room Type");
			    redirect(BACKEND_URL."room_type/");
		    }
		}
	}
   }
   
    
	 public function change_status(){
		  $roomtype_id = $this->input->post('id');
		  $alias		= '';
		  $condition	= "roomtype_id = '".$roomtype_id."'";
		  $rec = $this->model_basic->getValues_conditions(ROOMTYPE_MASTER, '', $alias, $condition);
		  if(is_array($rec) and count($rec)>0){
				$rec =$rec[0];
				$status = $rec['roomtype_status'];
				$new_status ='';
				if($status=='Active'){
				  $new_status = 'Inactive';
				}
				else if($status=='Inactive'){
				  $new_status = 'Active';
				}
				$updateArr  =  array('roomtype_status' => $new_status);
				$idArr      = array('roomtype_id' => $roomtype_id);
				$ret   = $this->model_basic->updateIntoTable(ROOMTYPE_MASTER,$idArr, $updateArr);
		  }
    }
    
}
?>