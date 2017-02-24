<?php
class Discountcode extends CI_Controller{
    
   
    public function __construct(){
        parent:: __construct();

        $this->load->model("model_discountcode");
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	$config['base_url'] 	= BACKEND_URL."discountcode/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	$this->data['params']		= $this->nsession->userdata('DISCOUNTCODE_MASTER_SEARCH');
	
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
	$this->data['records']	= $this->model_discountcode->getList($config,$start);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= 'discountcode';	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add/0/".$page."/";
	$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
	$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
	$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-user-md';
	$this->data['brdLink'][0]['name']   =   'Discount Code';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='discountcode/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_code_exists()
    {
	
	$id 		= $this->uri->segment(3, 0);
	$code		= strip_tags(addslashes(trim($this->input->get_post('code'))));
	
	$whereArr	= array();
	if($id > 0){
		$whereArr	= array( 'code' => $code,
					 'code_id != ' => $id						
					);
	}else{			
		$whereArr	= array( 'code' => $code );
	}
	$bool 	= $this->model_basic->checkRowExists(DISCOUNTCODE_MASTER, $whereArr );
	if($bool == 0){
		$this->form_validation->set_message('is_code_exists', 'The %s already exists');
		return FALSE;
	}else{
		return TRUE;
	}
    }
    
    public function add()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
	$roomtype_id	= $this->uri->segment(3, 0);
	$page		= $this->uri->segment(4, 0);
	$this->data['controller']	= "discountcode";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
       // $this->data['lastOrderLimit']   = $this->model_property_type->lastOrderLimit();
	
	$action = $this->input->post('action',true);
	$this->form_validation->set_rules('code', 'Discount Code', 'trim|required|is_unique['.DISCOUNTCODE_MASTER.'.code]');
	$this->form_validation->set_rules('amount_percent', 'Amount/Percent', 'trim|required');
	
	if($this->input->get_post('action') == 'Process'){
		
		if ($this->form_validation->run() != FALSE && $action != FALSE)
		{	
		    $code     		= addslashes($this->input->post('code'));
		    $amount_percent     = addslashes($this->input->post('amount_percent'));
		    $type		= addslashes($this->input->post('type'));
		    $status		= addslashes($this->input->post('status'));
		    
		    $property_type_ids	= $this->input->post('property_type_ids');
		    if( $property_type_ids && is_array($property_type_ids) ){
			 $property_type_str = implode(',', $property_type_ids ) ;    
		    }
		    else {
			 $property_type_str = '' ;
		    }
		    
		    $room_type_ids	= $this->input->post('room_type_ids');
		    if( $room_type_ids && is_array($room_type_ids) ){
			 $room_type_str = implode(',', $room_type_ids ) ;    
		    }
		    else {
			 $room_type_str = '' ;
		    }		    
		    
		    $insertArr  =  array('code'	        		=> $code,
					'amount_percent'		=> $amount_percent,
					'type'                 		=> $type,
					'status'           		=> $status,
					'property_type_ids'		=> $property_type_str,
					'room_type_ids'			=> $room_type_str
					);
		
		    $res = $this->model_basic->insertIntoTable(DISCOUNTCODE_MASTER,$insertArr);
		    if($res)
		    {
			    $this->nsession->set_userdata('succmsg', "Discount Code Added Successfuly.");
			    redirect(base_url()."discountcode/");
		    }else{
			    $this->nsession->set_userdata('errmsg', "Unable to Add Discount Code");
			    redirect(base_url()."discountcode/");
		    }
		}
	}
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-user-md';
	$this->data['brdLink'][0]['name']   =   'Discount Code';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   '';
	$this->data['brdLink'][1]['name']   =   'Add Discount code';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."discountcode/index";
	
	$this->data['property_type'] = $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
	$this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add/0/".$page."/";
        $this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='discountcode/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    public function edit()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$id		= $this->uri->segment(3, 0);
        $page		= $this->uri->segment(4, 0);
		
	$this->data['controller']	= "discountcode";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;

		
	if($this->input->get_post('action') == 'Process'){			

	    $this->form_validation->set_rules('code', 'Discount Code', 'trim|required|callback_is_code_exists');
	    $this->form_validation->set_rules('amount_percent', 'Amount/Percent', 'trim|required');	    
	    
	    if ($this->form_validation->run() == FALSE){
		
	    }
	    else
	    {                      
		    $code     		= addslashes($this->input->post('code'));
		    $amount_percent     = addslashes($this->input->post('amount_percent'));
		    $type		= addslashes($this->input->post('type'));
		    $status		= addslashes($this->input->post('status'));
						    
		    $property_type_ids	= $this->input->post('property_type_ids');
		    if( $property_type_ids && is_array($property_type_ids) ){
			 $property_type_str = implode(',', $property_type_ids ) ;    
		    }
		    else {
			 $property_type_str = '' ;
		    }
		    
		    $room_type_ids	= $this->input->post('room_type_ids');
		    if( $room_type_ids && is_array($room_type_ids) ){
			 $room_type_str = implode(',', $room_type_ids ) ;    
		    }
		    else {
			 $room_type_str = '' ;
		    }		    
		    
		    $insertArr  =  array('code'	        		=> $code,
					'amount_percent'		=> $amount_percent,
					'type'                 		=> $type,
					'status'           		=> $status,
					'property_type_ids'		=> $property_type_str,
					'room_type_ids'			=> $room_type_str,
					'modified_on'			=> date('Y-m-d H i s')
					);
		    
		    $idArr	= array('code_id' => $id);
    
		    //pr($insertArr);
		    $ret   = $this->model_basic->updateIntoTable(DISCOUNTCODE_MASTER,$idArr, $insertArr);
		    if(isset($ret))
		    {
			    $this->nsession->set_userdata('succmsg', "Discount Code updated successfully.");
		    }
		    else
		    {
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
		    }
		    redirect(BACKEND_URL."discountcode/index/".$page."/");
		    return true;
	    }
	}		
		
	$row = array();

	// Prepare Data
	$Condition = " code_id = '".$id."'";
	$rs = $this->model_basic->getValues_conditions(DISCOUNTCODE_MASTER, '', '', $Condition);
	
	$row = $rs[0];
	if($row){
	    $this->data['record'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit/".$page."/");
		return false;
	}
	
	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-user-md';
	$this->data['brdLink'][0]['name']   =   'Discount Code';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   '';
	$this->data['brdLink'][1]['name']   =   'Edit Discount code';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."discountcode/index";
		
	$this->data['property_type'] = $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
	$this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit/".$id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='discountcode/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    
    public function delete()
   {
	$id = $this->uri->segment(3, 0);
	
	//if($id!=NULL)
	//{
	//	$Condition = " FIND_IN_SET('".$id."', room_type)";
	//	$rs = $this->model_basic->isRecordExist(PROPERTY_MASTER, $Condition);
	//	if($rs >0){
	//	    $this->nsession->set_userdata('errmsg', "Unable to Delete Room Type.It\'s used in different place.");
	//	    redirect(base_url()."room_type/");
	//	}else{
	//	    $delete_where	= "FIND_IN_SET(roomtype_id, '".$id."')";
	//	    $res = $this->model_basic->deleteData(DISCOUNTCODE_MASTER, $delete_where);
	//	    if($res)
	//	    {
	//		    $this->nsession->set_userdata('succmsg', "Room Type Deleted Successfuly.");
	//		    redirect(BACKEND_URL."room_type/");
	//	    }
	//	    else
	//	    {  
	//		    $this->nsession->set_userdata('errmsg', "Unable to Delete Room Type");
	//		    redirect(BACKEND_URL."room_type/");
	//	    }
	//	}
	//}
   }
   
    public function change_status(){
	$id = $this->input->post('id');
	$alias		= '';
	$condition	= "code_id = '".$id."'";
	$rec = $this->model_basic->getValues_conditions(DISCOUNTCODE_MASTER, '', $alias, $condition);
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
		     
	    $idArr      = array('code_id' => $id);
     
	    $ret   = $this->model_basic->updateIntoTable(DISCOUNTCODE_MASTER,$idArr, $updateArr);
	}
    }
    
}
?>