<?php
class Property extends MY_Controller{
    
    var $required_field = array(
				0=>"Property_name",
				1=>"Property Type",
				2=>"Room Type",
				3=>"Addresss",
				4=>"Province",
				5=>"City",
				6=>"Description",
				7=>"Latitude",
				8=>"Longitude",
				9=>"Default Price"
				);
    
	 
	 public function __construct(){
        parent:: __construct();
		  chk_login();
        $this->load->model("model_property");
		  $this->load->library('cdnupload');
    }
    
    
    public function testUpload(){
		  if($this->input->post('upload_file')=='upload'){
				$this->load->library('cdnupload');
				$file = $_FILES['file']['tmp_name'];
				//$file ='https://www.google.co.in/images/srpr/logo11w.png';
				$path ='property/big';
				$new_name ='jj.png';
				$this->cdnupload->upload($file,$path,$new_name);
		  }
		  $this->load->view('testUpload');
    }
	 
	 
	 
    public function testUpload1(){
		  if($this->input->post('upload_file')=='upload'){
				$this->load->library('cdnupload');
				$file = $_FILES['file']['name'];
				echo $this->cdnupload->getFileNewName($file);
		  }
	    $this->load->view('testUpload');
    }
     
    public function index(){
        chk_login();
		  $this->data='';
        
		  $config['base_url'] 	= BACKEND_URL.currentClass()."/index/";
		  $config['per_page'] 	= 20;
		  $config['uri_segment']	= 3;
		  $config['num_links'] 	= 5;
		  $this->pagination->setCustomAdminPaginationStyle($config);
		  $this->data['search_keyword']	= '';
		  $this->data['per_page']	= '';
	
		  if($this->input->get_post('btn_show_all')!=''){
            $this->nsession->unset_userdata('PROPERTY_MASTER_SEARCH');
            redirect(currentClass()."/index/");
        }
	
		  $this->data['params']		= $this->nsession->userdata('PROPERTY_MASTER_SEARCH');
	
		  if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == ''){	
				$this->data['search_keyword'] = $this->data['params']['search_keyword'];
				$this->data['per_page']	= $this->data['params']['per_page'];
		  }
		  else{
				$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
				$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		  }
	
		  $start 				= 0;
		  $page				= $this->uri->segment(3,0);
		  $this->data['propertyList']	= $this->model_property->getList($config,$start);
		  //pr($this->data['propertyList']);
		  $this->data['startRecord'] 	= $start;
       
		  $this->data['totalRecord'] 	= $config['total_rows'];
		  $this->data['per_page'] 	= $config['per_page'];
		  $this->data['page']	 	= $page;
		  $this->data['controller'] 	= currentClass();	
		  $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		  $this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		  $this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add/0/".$page."/";
		  $this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
		  $this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
		  $this->data['availability_link']= BACKEND_URL.$this->data['controller']."/availability/{{ID}}/".date('Y')."/";
		  $this->data['booking_link']	= BACKEND_URL."propertybooking/bookings/{{ID}}/".$page."/";
		  $this->data['query_link']	= BACKEND_URL.$this->data['controller']."/view_query/{{ID}}/".$page."/";
		  $this->data['view_link']	= BACKEND_URL.$this->data['controller']."/view/{{ID}}/".$page."/";
		  
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
				     );	
	
	
	//........................
		  $this->data['required_fileds']= $this->required_field;
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
		  $this->templatelayout->get_leftmenu();
		  $this->templatelayout->get_footer();
        $this->elements['middle']='property/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
	 
	 function is_name_exists(){
		  $id 		= $this->uri->segment(3, 0);
		  $province_name	= strip_tags(addslashes(trim($this->input->get_post('city_name'))));
		  $whereArr	= array();
		  if($id > 0){
				$whereArr	= array( 'city_name' => $province_name,
					 'city_master_id != ' => $id						
					);
		  }else{			
				$whereArr	= array( 'city_name' => $province_name );
		  }
		  $bool 	= $this->model_basic->checkRowExists(CITY, $whereArr );
		  if($bool == 0){
			  $this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			  return FALSE;
		  }else{
				return TRUE;
		  }
    }
    
    
    
    
    
    

   public function change_status(){
       $property_id = $this->input->post('id');
       $rec = $this->model_property->getPropertyDetails($property_id);
       if(is_array($rec) and count($rec)>0){
	  $status = $rec['property_master']['status'];
	  
	  $new_status ='';
	  if($status=='Active'){
	    $new_status = 'Inactive';
	  }
	  else if($status=='Inactive'){
	    $new_status = 'Active';
	  }
	  
	   $updateArr  =  array('status' => $new_status);
		    
	   $idArr      = array('property_master_id' => $property_id);
    
	   $ret   = $this->model_basic->updateIntoTable(PROPERTY_MASTER,$idArr, $updateArr);
       }
   }
   
   
   
    public function change_feature(){
       $property_id = $this->input->post('id');
       $rec = $this->model_property->getPropertyDetails($property_id);
       if(is_array($rec) and count($rec)>0){
	  $feature = $rec['property_master']['is_featured'];
	  
	  $new_feature ='';
	  if($feature=='Yes'){
	    $new_feature = 'No';
	  }
	  else if($feature=='No'){
	    $new_feature = 'Yes';
	  }
	  
	   $updateArr  =  array('is_featured' => $new_feature);
		    
	   $idArr      = array('property_master_id' => $property_id);
    
	   $ret   = $this->model_basic->updateIntoTable(PROPERTY_MASTER,$idArr, $updateArr);
       }
   }
   
   
   
   
   
   public function getImages(){
     $property_id = $this->input->post('id');
     $images = $this->model_property->getPropertyImageById($property_id);
     $images = json_encode($images);
     echo $images;
   }
   


//   public function list_city(){
//    if($this->input->post('submit')=='ok'){
//	$city_list = $_POST['city_list'];
//	$html = str_get_html($city_list);
//	foreach($html->find('td') as $td){
//	    $city =  $td->plaintext;
//	    $insert_arr = array(
//				'province_id'=>$_POST['pro_id'],
//				'city_name'=>$city,
//				'city_slug'=>url_title( strtolower( trim($city)) )
//				);
//	    $this->model_basic->insertIntoTable( CITY, $insert_arr);
//	    
//	}
//    }
//    $this->load->view('test_city');
//   }
   
   
   public function ajaxCityList(){
      $pro_id = $this->input->post('pro_id');
      $city=array();
      $city_list = $this->model_basic->getValues_conditions(CITY,array('city_master_id','city_name'),'',' province_id="'.$pro_id.'" and status="Active"');
      
      if(is_array($city_list) and count($city_list)>0){
	$city = $city_list;
	
      }
      echo json_encode($city);
   }
	
	
   public function add(){
	//chk_login();
		  $this->data['brdLink']=array(
										  array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
										  array('logo'=>'fa fa-plus-circle','name'=>'Add','link'=>'javascript:void();')
										  );
		  $this->data['agents'] = $this->model_property->agent_list();
		  $this->data['property_type'] = $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
		  $this->data['province_type'] = $this->model_basic->getValues_conditions(PROVINCE_MASTER,'','','status="Active"');
		  $this->data['language_list'] = $this->model_basic->getValues_conditions(LANGUAGE_MASTER,'','','status="Active"');
		  $this->data['hearabout_list'] = $this->model_basic->getValues_conditions(HEAR_ABOUT,'','','status="Active"');
		  $this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');
		  $this->data['facilities_list'] = $this->model_basic->getValues_conditions(FACILITIES,'','','amenities_status="Active"');
		  $this->data['policy_list'] = $this->model_basic->getValues_conditions(POLICY_MASTER,'','','status="Active"');
		  $this->data['age_group'] = $this->model_basic->getValues_conditions(AGEGROUP,'','','status="active"');
		  $this->data['group_list'] = $this->model_basic->getValues_conditions(GROUPTYPE,'','','status="active"');
		  
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
		  $this->templatelayout->get_leftmenu();
		  $this->templatelayout->get_footer();
        $this->elements['middle']='property/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
   
   public function updateRequired($limit_arr,$property_id){
        $required_filed = $this->model_basic->getValue_condition(PROPERTY_MASTER, 'required_fields', '', ' property_master_id="'.$property_id.'"');
	
	if($required_filed==""){
	    $requiredFields = array_keys($this->required_field);
	    foreach($limit_arr as $l){
		unset($requiredFields[$l]);    
	    }
	}else{
	    $db_required_filed = explode(",",$required_filed);
	    $requiredFields = array_diff($db_required_filed,$limit_arr);
	}
       
	
	
	$requiredFields_str='';
	if(is_array($requiredFields) and count($requiredFields)>0){
	    
	    $requiredFields_str = implode(",",$requiredFields);
	}
	$idArr = array('property_master_id'=>$property_id);
	$updateArr = array('required_fields'=>$requiredFields_str);
	$this->model_basic->updateIntoTable(PROPERTY_MASTER, $idArr, $updateArr);
	
   }
   
   
	
	
	 public function addAction(){
    
		  $action = $this->input->post('action');$respons ='';
		  $this->form_validation->set_rules('property_name','Property Name','required|trim');
		  $this->form_validation->set_rules('property_type_id','Property Type','required|trim');
		  $this->form_validation->set_rules('room_type[]','Room Type','required|trim');
		  $this->form_validation->set_rules('guests','Guests','required|trim');
		  
		  //$this->form_validation->set_rules('group_type[]','Group Type','required|trim');
		  //$this->form_validation->set_rules('age_group[]','Age Group','required|trim');
	  
		  if($this->form_validation->run() == true){
		
	       $property_name 		= addslashes( trim( $this->input->post('property_name') ) );
	       $property_slug 		= url_title(strtolower($property_name));
	       $property_type 		= addslashes( trim( $this->input->post('property_type_id') ) );
		$agent_id		= addslashes( trim( $this->input->post('agent_id') ) );
	       $bedrooms 		= addslashes( trim( $this->input->post('bedrooms') ) );
	       $beds 			= addslashes( trim( $this->input->post('beds') ) );
	       $guests     		=  addslashes( trim( $this->input->post('guests') ) );
	       $group_type		= $this->input->post('group_type');
	       
	       $allow_group 		= addslashes( trim( $this->input->post('allow_group'))); 
	       //$group_type		= addslashes( implode(',',$this->input->post('group_type')) );
	       //$age_group		= addslashes( implode(',',$this->input->post('age_group')) );
	      
	       $room_type	= $this->input->post('room_type');
	       if( $room_type && is_array($room_type) ){
		    $room_type_str = implode(',', $room_type ) ;    
	       }
	       else {
		    $room_type_str = '' ;
	       }
	      
	      
	      
	       $property_master_data = array(
				   'user_id'		=> 	$this->nsession->userdata('admin_id'),
				   'property_name'	=>	$property_name,
				   'agent_id'		=>	$agent_id,
				   'property_type_id'	=>	$property_type,
				   'bedrooms'		=>	$bedrooms,
				   'beds'		=>	$beds,
				   'room_type'		=> 	$room_type_str,
				   'guest' 		=> 	$guests,
 				   'group_booking_support' => ($allow_group != '') ? $allow_group : 'no'
				   );
	      
		
		$new_property_id = $this->model_basic->insertIntoTable( PROPERTY_MASTER, $property_master_data); // MASTER DATA
		
		$property_slug = $this->model_basic->create_unique_slug($property_slug,PROPERTY_MASTER,'property_slug');
		
		switch (strlen($new_property_id)) {
		    case 1:
			$rand_id = rand(1000,9999).$new_property_id;
			break;
		    case 2:
			$rand_id = rand(100,999).$new_property_id;
			break;
		    case 3:
			$rand_id = rand(10,99).$new_property_id;
			break;
		    case 4:
			$rand_id = rand(0,9).$new_property_id;
			break;
		    default:
			$rand_id = $new_property_id;
		}
		
		$idArr=array('property_master_id'=>$new_property_id);
		$updateArr= array('property_slug'=>$property_slug,
				  'reference_id' =>$rand_id);
		$this->model_basic->updateIntoTable(PROPERTY_MASTER, $idArr, $updateArr);
		
		$property_details_data=array('property_id'=>$new_property_id);
		$this->model_basic->insertIntoTable( PROPERTY_DETAILS, $property_details_data); // DETAILS DATA
		
		$this->nsession->userdata('succmsg','Property Details is added successfully');
		
		$this->updateRequired(array(0,1,2),$new_property_id);
		if(count($group_type)> 0){
		    foreach($group_type as $k=>$grpTyp){
			foreach($grpTyp as $ageTyp){
			    if($ageTyp != '' ){
				$insertArr = array('property_id' => $new_property_id,
						   'group_id'    => $k,
						   'age_type_id' => $ageTyp);
				$this->model_basic->insertIntoTable( 'hw_property_grp_age', $insertArr);
			    }
			}
		    }
		}
		
		redirect(BACKEND_URL.'property/editcontactaction/'.$new_property_id);
	}else{
	       $this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
	       $this->add();
	}
      
   }
   
   
   public function delete($property_id)
   {
    
      $this->model_basic->deleteData(PROPERTY_POLICIES,'property_id="'.$property_id.'"');
      $this->model_basic->deleteData(PROPERTY_FACILITIES,'property_id="'.$property_id.'"');
      //$this->model_basic->deleteData(PROPERTY_IMAGE,'property_id="'.$property_id.'"');
      $img_data= $this->model_basic->getValues_conditions(PROPERTY_IMAGE,'','',' property_id="'.$property_id.'"');
      if(is_array($img_data) and count($img_data)){
	foreach($img_data as $data){
	    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/big/'.$data['image_name']);
	    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/small/'.$data['image_name']);
	    @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/thumb/'.$data['image_name']);
	}
	$this->model_basic->deleteData(PROPERTY_IMAGE,'property_id="'.$property_id.'"');
      }
      $this->model_basic->deleteData(PROPERTY_PRICE,'property_id="'.$property_id.'"');
      $this->model_basic->deleteData(PROPERTY_DETAILS,'property_id="'.$property_id.'"');
      $this->model_basic->deleteData(PROPERTY_MASTER,'property_master_id="'.$property_id.'"');
      $this->nsession->userdata('succmsg','Property is deleted successfully');
      redirect(currentClass().'/property');
   }
   
   public function edit($property_id){
      
        $property_id = $this->uri->segment(3,0);
       $page		= $this->uri->segment(4,0);
	$this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
			     );
	
	$this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
	//pr($this->data['property_details']);
	$this->data['property_type'] 		= $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
	$this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');
	
	
	$ageRange		 		= $this->model_basic->getValues_conditions('hw_property_grp_age','','','property_id="'.$property_id.'"');
	$grp_type				= [];
	$age_type				= [];
	//pr($ageRange);
	if(is_array($ageRange) > 0){
	foreach($ageRange as $k=>$pType){
	    $grp_type[]  			= $pType['group_id'];
	    $age_type[$pType['group_id']][]     = $pType['age_type_id'];
	}
	}
	//pr($age_type);
	$this->data['ageGroup'] = $age_type;
	$this->data['grp_type'] = $grp_type;
	
	$this->data['age_group'] = $this->model_basic->getValues_conditions(AGEGROUP,'','','status="active"');
	$this->data['group_list'] = $this->model_basic->getValues_conditions(GROUPTYPE,'','','status="active"');
	
	$this->data['property_type'] 		= $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	
	//pr($this->data);
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'details'),true);
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
   
   public function editAction(){
    
      
       $action = $this->input->post('action');
       $respons ='';
       $property_id = $this->uri->segment(3,0);
       $page		= $this->uri->segment(4,0);		
       if($this->input->get_post('action') == 'basic_info')
       {
	    $this->form_validation->set_rules('property_name','Property Name','required|trim');
	    $this->form_validation->set_rules('property_type_id','Property Type','required|trim');
	    $this->form_validation->set_rules('bedrooms','Bedrooms','required|trim');
	    $this->form_validation->set_rules('beds','Beds','required|trim');
	    $this->form_validation->set_rules('room_type[]','Room Type','required|trim');
	    $this->form_validation->set_rules('guests','Guests','required|trim');
		 
		 //$this->form_validation->set_rules('group_type[]','Group Type','required');
		 //$this->form_validation->set_rules('age_group[]','Age Group','required|trim');
		 
	    if($this->form_validation->run() == true)
	    {
	       $property_master_id 	= $this->input->post('property_master_id');	
	       $property_name 		= addslashes( trim( $this->input->post('property_name')));
	       $property_slug 		= url_title(strtolower($property_name));
	       $property_type 		= addslashes( trim( $this->input->post('property_type_id')));
	       $bedrooms 		= addslashes( trim( $this->input->post('bedrooms')));
	       $beds 			= addslashes( trim( $this->input->post('beds')));
	       $guests 			= addslashes( trim( $this->input->post('guests')));
	       $allow_group 		= addslashes( trim( $this->input->post('allow_group'))); 
			 
	       $room_type_str		= addslashes( implode(',',$this->input->post('room_type')) );
	       
	       $group_type		= $this->input->post('group_type');
	//       $age_group		= $this->input->post('age_group');
	//	pr($age_group);
			 
	       
	       $property_master_data = array(
			    'user_id'		=> 	$this->nsession->userdata('admin_id'),
			    'property_name'	=>	$property_name,
			    'property_slug'	=>	$property_slug,
			    'property_type_id'	=>	$property_type,
			    'bedrooms'		=>	$bedrooms,
			    'beds'		=>	$beds,
			    'guest'  		=> 	$guests,
			    'room_type'		=> 	$room_type_str,
			    'group_booking_support' => ($allow_group != '') ? $allow_group : 'no',
			    'db_added_on'	=>	date("Y-m-d H:i:s"),
			    'db_updated_on'	=>	date("Y-m-d H:i:s")
			    );
		//pr($property_master_data);
	       //exit;
	        $idArr = array( 'property_master_id'=>$property_master_id );
		$this->model_basic->updateIntoTable( PROPERTY_MASTER, $idArr, $property_master_data); // MASTER DATA
		
		$property_slug = $this->model_basic->create_unique_slug($property_slug,PROPERTY_MASTER,'property_slug','property_master_id',$property_master_id);
		
		$idArr=array('property_master_id'=>$property_id);
		$updateArr= array('property_slug'=>$property_slug);
		$update_data = $this->model_basic->updateIntoTable(PROPERTY_MASTER, $idArr, $updateArr);
		if(isset($update_data))
		{
		    $this->model_basic->deleteData('hw_property_grp_age','property_id="'.$property_id.'"');
		    if(count($group_type) > 0 && $allow_group=='yes'){
		    foreach($group_type as $k=>$grpTyp){
			foreach($grpTyp as $ageTyp){
			    if($ageTyp != '' ){
				$insertArr = array('property_id' => $property_id,
						   'group_id'    => $k,
						   'age_type_id' => $ageTyp);
				$this->model_basic->insertIntoTable( 'hw_property_grp_age', $insertArr);
			    }
			}
		    }
		    }  
		    $this->updateRequired(array(0,1,2),$property_master_id);
		
		    $this->nsession->set_userdata('succmsg','Property details is updated successfully');
		}
		else
		{
		    $this->nsession->set_userdata('succmsg','Property details is not updated successfully');
		}
		
		redirect(BACKEND_URL.'property/editcontactaction/'.$property_id.'/'.$page.'/');
		
	    }
	    else
	    {
		//echo validation_errors();
				
	        $this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
	        redirect(BACKEND_URL.'property/edit/'.$property_id.'/'.$page.'/');
	    }
       }

      
   }
   
   
	
	public function editcontactaction(){
		  $property_id = $this->uri->segment(3,0);
		  $page	 = $this->uri->segment(4,0);
		  $this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
			     );
	
		  $this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
		  //pr($this->data['property_details']);
		  $this->data['province_type'] 		= $this->model_basic->getValues_conditions(PROVINCE_MASTER,'','','status="Active"');
		  //pr($this->data['province_type']);
		  $this->data['hearabout_list']		= $this->model_basic->getValues_conditions(HEAR_ABOUT,'','','status="Active"');
	
		  if($this->input->get_post('action') == 'contact'){
				$this->form_validation->set_rules('address','Address','required|trim');
				$this->form_validation->set_rules('province_id','province name','required|trim');
				$this->form_validation->set_rules('city_id','city name','required|trim');
				//$this->form_validation->set_rules('phone_no','Phone no','required|trim');
				if($this->form_validation->run() == true){
					 $property_master_id 	= $this->input->post('property_master_id');	
					 $address 		= addslashes( trim( $this->input->post('address') ) );
					 $address2 		= addslashes( trim( $this->input->post('address2') ) );
					 $province_id 		= addslashes( trim( $this->input->post('province_id') ) );
					 $zip_code 		= addslashes( trim( $this->input->post('zip_code') ) );
					 $city_id 		= addslashes( trim( $this->input->post('city_id') ) );
					 $contact_name 		= addslashes( trim( $this->input->post('contact_name') ) );
					 $main_manager_email 	= addslashes( trim( $this->input->post('main_manager_email') ) );
					 $email_address_booking 	= addslashes( trim( $this->input->post('email_address_booking') ) );
					 $website_address 	= addslashes( trim( $this->input->post('website_address') ) );
					 $phone_no 		= addslashes( trim( $this->input->post('phone_no') ) );
					 $mobile_address 		= addslashes( trim( $this->input->post('mobile_address') ) );
					 $fax_no 			= addslashes( trim( $this->input->post('fax_no') ) );
					 $mobile_url 		= addslashes( trim( $this->input->post('mobile_url') ) );
					 $language_id 		= addslashes( trim( $this->input->post('language_id') ) );
					 $hear_about_id 		= addslashes( trim( $this->input->post('hear_about_id') ) );
					
					
					 $signed_for 		= addslashes( trim( $this->input->post('signed_for') ) );
					 $licensee_name 		= addslashes( trim( $this->input->post('licensee_name') ) );
					 $licensee_email 		= addslashes( trim( $this->input->post('licensee_email') ) );
					 $licensee_email2 	= addslashes( trim( $this->input->post('licensee_email2') ) );
					 $signed_date 		= addslashes( trim( $this->input->post('signed_date') ) );
					 $effective_date 		= trim( $this->input->post('effective_date'));
	       
					 $sms_notification 	= addslashes( trim( $this->input->post('sms_notification') ) );
					 if($sms_notification == 'Yes'){
						  $sms_notification_no_prefix 	= addslashes( trim( $this->input->post('sms_notification_no_prefix') ) );
						  $sms_notification_no 	= addslashes( trim( $this->input->post('sms_notification_no') ) );
					 }
					 else{
						  $sms_notification = 'No';
						  $sms_notification_no_prefix  = '';
						  $sms_notification_no 	= '0';
					 }   
					 $property_master_data = array(
													 'website_address'	=>	$website_address,
													 'mobile_address'	=>	$mobile_address,
													 'phone_no'		=>	$phone_no,
													 'fax_no'		=>	$fax_no,
													 'mobile_url'		=> 	$mobile_url,
													 
													 'sms_notification'			=> 	$sms_notification,
													 'sms_notification_no_prefix'		=> 	$sms_notification_no_prefix,
													 'sms_notification_no'		=> 	$sms_notification_no,
													 
													 'effective_date'	=> 	date('Y-m-d',strtotime($effective_date)),
													 'db_added_on'	=>	date("Y-m-d H:i:s"),
													 'db_updated_on'	=>	date("Y-m-d H:i:s")
					 );
					 $property_details = array(
									 'language_id'	=>	1,
									 'address'	=>	$address,
									 'address2'	=>	$address2,
									 'province_id'	=>	$province_id,
									 'zip_code'	=>	$zip_code,
									 'city_id'	=>	$city_id,
									 'contact_name' =>	$contact_name,
									 'email_address_booking'=> $email_address_booking,
									 'main_manager_email' => $main_manager_email,
									 'hear_about_id'  => 	$hear_about_id,
									  'signed_for'  => 	$signed_for ,
									 'licensee_name'  => 	$licensee_name ,
									 'licensee_email'  => 	$licensee_email ,
									 'licensee_email2'  => 	$licensee_email2 ,
									 'signed_date'  => 	date('Y-m-d',strtotime($signed_date))
					 );
		       
					 $idArr = array( 'property_master_id'=>$property_master_id );
					 $this->model_basic->updateIntoTable( PROPERTY_MASTER, $idArr, $property_master_data); // MASTER DATA
		
					 $idArr = array( 'property_id'=>$property_master_id );
					 $last_details_id = $this->model_basic->updateIntoTable( PROPERTY_DETAILS, $idArr , $property_details); // DETAILS DATA
					 if(isset($last_details_id)){
						  $this->updateRequired(array(3,4,5),$property_master_id);
						  $this->nsession->set_userdata('succmsg','Property contact details is updated successfully');
					 }
					 else{
						  $this->nsession->set_userdata('succmsg','Property contact details not updated successfully');
					 }
					 redirect(BACKEND_URL.'property/editbasicaction/'.$property_id.'/'.$page.'/');
				}
				else{
				$this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
				}
		  }
	
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'contact'),true);
        $this->templatelayout->get_topbar();
		  $this->templatelayout->get_leftmenu();
		  $this->templatelayout->get_footer();
        $this->elements['middle']='property/edit_contact';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
	 }
   
   public function editbasicaction()
   {
	$property_id = $this->uri->segment(3,0);
        $page	 = $this->uri->segment(4,0);
    
    $this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
			     );
	
	$this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
	//pr($this->data['property_details']);
	
	if($this->input->get_post('action') == 'basic')
       {
		$this->form_validation->set_rules('description','Description','required|trim');
		$this->form_validation->set_rules('latitude','Latitude','required|trim');
		$this->form_validation->set_rules('longitude','Longitude','required|trim');
		
		if($this->form_validation->run() == true){
	       $property_master_id 	= $this->input->post('property_master_id');	
	       
	       $brief_introduction 	= addslashes( trim( $this->input->post('brief_introduction') ) );
	       $description 		= addslashes( trim( $this->input->post('description') ) );
	       $location 		= addslashes( trim( $this->input->post('location') ) );
	       $direction 		= addslashes( trim( $this->input->post('direction') ) );
	       $things_to_note 		= addslashes( trim( $this->input->post('things_to_note') ) );
	       $cancellation_policy 	= addslashes( trim( $this->input->post('cancellation_policy') ) );
	       
	       $meta_title 		= addslashes( trim( $this->input->post('meta_title') ) );
	       $meta_keyword 		= addslashes( trim( $this->input->post('meta_keyword') ) );
	       $meta_description 	= addslashes( trim( $this->input->post('meta_description') ) );
	       $latitude 		= addslashes( trim( $this->input->post('latitude') ) );
	       $longitude 		= addslashes( trim( $this->input->post('longitude') ) );

		       $property_details = array(
					
					 'description'		=>	$description,
					 'brief_introduction' 	=> 	$brief_introduction,
					 'direction'		=> 	$direction,
					 'location'		=> 	$location,
					 'things_to_note' => 		$things_to_note,
					 'cancellation_policy' 	=> 	$cancellation_policy,
					 'meta_title' 		=> 	$meta_title,
					 'meta_keyword' 	=> 	$meta_keyword,
					 'meta_description' 	=> 	$meta_description,
					 'latitude'		=>	$latitude,
					 'longitude'		=>	$longitude
					 );
		       
		$idArr = array( 'property_id'=>$property_master_id );
		$last_details_id = $this->model_basic->updateIntoTable( PROPERTY_DETAILS, $idArr , $property_details); // DETAILS DATA
		if(isset($last_details_id))
		{
		    $this->updateRequired(array(6,7,8),$property_master_id);
		
		    $this->nsession->set_userdata('succmsg','Property basic details is updated successfully');
		}
		else
		{
		    $this->nsession->set_userdata('succmsg','Property basic details not updated successfully');
		}
		
		redirect(BACKEND_URL.'property/editpriceaction/'.$property_id.'/'.$page.'/');
	    }else{
		$this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
		redirect(BACKEND_URL.'property/editbasicaction/'.$property_id.'/'.$page.'/');
	    }
	   
	    
       }
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'basic'),true);
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/edit_basicinfo';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
   
   
	public function editpriceaction(){
		  $property_id = $this->uri->segment(3,0);
        $page	 = $this->uri->segment(4,0);
    
		  $this->data['brdLink']=array(
													 array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
													 array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
										  );
	
		  $this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
		  //pr($this->data['property_details']['property_master']['room_type']);
		  $this->data['property_type'] 		= $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
		  $this->data['price_list']	  	= $this->model_property->getPropertyPrice($property_id);
		  $this->data['roomtype_list']	  	= $this->model_property->getPropertyRoomType($property_id);
	
		  $room_type = $this->data['property_details']['property_master']['room_type'];
		  $room_type_arr = explode(',', $room_type);
		  $result=array_intersect($room_type_arr,$this->data['roomtype_list']);
						
		  $result_diff = array_diff($room_type_arr,$result);
		  $this->data['new_prices']=$this->model_property->getNewPrices($result_diff);
		  
		  if($this->input->get_post('action') == 'price'){
				$property_master_id 	= $this->input->post('property_master_id');
				$deposite_amount = $this->input->post('deposite_amount');
				$service_fees = $this->input->post('service_fees');
				// add price of property
				$this->addPrice($property_master_id);
				$this->updateRequired(array(9),$property_master_id);
				$idArr = array('property_master_id'=>$property_id);
				$updateArr = array('deposite_amount'=>$deposite_amount,'service_fees'=>$service_fees);
				$this->model_basic->updateIntoTable(PROPERTY_MASTER, $idArr, $updateArr);
				$this->nsession->set_userdata('succmsg','Property price details is updated successfully');
				redirect(BACKEND_URL.'property/editfacilitiesaction/'.$property_id.'/'.$page.'/');
				// end add price of property
		  }
	   
	    
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'price'),true);
        $this->templatelayout->get_topbar();
		  $this->templatelayout->get_leftmenu();
		  $this->templatelayout->get_footer();
        $this->elements['middle']='property/editprice_details';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
   
   public function editfacilitiesaction()
   {
	$property_id = $this->uri->segment(3,0);
        $page	 = $this->uri->segment(4,0);
    
        $this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
			     );
	
	$this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
	//pr($this->data['property_details']);
	$this->data['facilities_list'] 		= $this->model_basic->getValues_conditions(FACILITIES,'','','amenities_status="Active"');
	$this->data['policy_list'] 		= $this->model_basic->getValues_conditions(POLICY_MASTER,'','','status="Active"');
	
	 if($this->input->get_post('action') == 'facilities')
        {
	   
	     $property_master_id 	= $this->input->post('property_master_id');
	     $property_facilities 	= $this->input->post('property_facilities') ;
	    $property_ploicy 	        = $this->input->post('property_ploicy') ;
	    //$earliest_check_in 	= addslashes( trim( $this->input->post('earliest_check_in') ) );
	    //$latest_check_in 	= addslashes( trim( $this->input->post('latest_check_in') ) );
	    
	    $check_in_hour = trim( $this->input->post('check_in_hour'));
	    $check_in_minute = trim( $this->input->post('check_in_minute'));
	    $check_out_hour = trim( $this->input->post('check_out_hour'));
	    $check_out_minute = trim( $this->input->post('check_out_minute'));
	    $minimum_nights_stay = trim( $this->input->post('minimum_nights_stay'));
	    $maximum_nights_stay = trim( $this->input->post('maximum_nights_stay'));
				     
	    $earliest_check_in = $check_in_hour.":".$check_in_minute;
	    $latest_check_in = $check_out_hour.":".$check_out_minute;
	    $property_facilities_str ='';
	    if($property_facilities and is_array($property_facilities) and count($property_facilities)>0){
		$property_facilities_str	= addslashes( implode(',',$property_facilities) );
	    }
	    
	    	       $property_master_data = array(
				   'earliest_check_in'	 =>	date( "H:i:s", strtotime(date("d-m-Y").$earliest_check_in) ),
				   'latest_check_in'	 =>	date( "H:i:s", strtotime(date("d-m-Y").$latest_check_in) ),
				   'minimum_nights_stay' => 	$minimum_nights_stay,
				   'maximum_nights_stay' => 	$maximum_nights_stay,
				   'db_added_on'	 =>	date("Y-m-d H:i:s"),
				   'db_updated_on'	 =>	date("Y-m-d H:i:s"));
		       
		       
	    	$idArr = array( 'property_master_id'=>$property_master_id );
		$this->model_basic->updateIntoTable( PROPERTY_MASTER, $idArr, $property_master_data); // MASTER DATA
		
		$this->model_basic->deleteData(PROPERTY_FACILITIES,'property_id="'.$property_master_id.'"');
	    
		if(is_array($property_facilities) and count($property_facilities)>0){  // FACILITY DATA
		    
		    foreach($property_facilities as $index=>$facility){
			$facility_arr = array(
						'property_id'		=> $property_master_id,
						'facility_master_id'	=> $facility
					      );
			$this->model_basic->insertIntoTable( PROPERTY_FACILITIES, $facility_arr);
		    }
		}
		
		$this->model_basic->deleteData(PROPERTY_POLICIES,'property_id="'.$property_master_id.'"');
		if(is_array($property_ploicy) and count($property_ploicy)>0){  // POLICY DATA
		    foreach($property_ploicy as $index=>$policy){
			$policy_arr = array(
						'property_id'		=> $property_master_id,
						'policy_master_id'	=> $policy
					      );
			$this->model_basic->insertIntoTable( PROPERTY_POLICIES , $policy_arr);
		    }
		}
		$this->nsession->set_userdata('succmsg','Property facilities & policy details is updated successfully');
	        redirect(BACKEND_URL.'property/editimageaction/'.$property_id.'/'.$page.'/');	
	}
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'facilities'),true);
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/edit_facilities';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
   
   public function editimageaction()
   {
    
	$property_id = $this->uri->segment(3,0);
        $page	 = $this->uri->segment(4,0);
    
        $this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Edit','link'=>'javascript:void();')
			     );
	
	$this->data['property_details']= $this->model_property->getPropertyDetails($property_id);
	//pr($this->data['property_details']);
	$property_image = $this->data['property_details']['property_images'];
	if($this->input->get_post('action') == 'photo')
        {
	    
	        $property_master_id 	= $this->input->post('property_master_id');
		$featured_image 	= $this->input->post('featured_image');
	    	if(isset($_FILES['propertyfiles']) and count($_FILES['propertyfiles'])>0){
		        // pr($_FILES);
		     
		     
		    $this->load->library('image_lib');
		    $img_arr 			= array();
		    $image_insert_arr		= array();
		    $image_temp_title_arr 	= $this->input->post('image_temp_title');
		    $image_temp_alt_arr 	= $this->input->post('image_temp_alt');
		    foreach($_FILES['propertyfiles']['tmp_name'] as $index=>$file){
			if($_FILES['propertyfiles']['error'][$index]==0){
			    $tmp_name 		= $file;
			    $file_name 		= $_FILES['propertyfiles']['name'][$index];
			    $new_file_name 	= $this->cdnupload->getFileNewName($file_name);
			    
			    if($new_file_name!=''){
				$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/big/'.$new_file_name
						);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$file 		= FRONTEND_URL.'upload/property/big/'.$new_file_name;
				$this->cdnupload->upload($file,'property/big',$new_file_name);
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/big/'.$new_file_name);
				
				$this->image_lib->clear();
				
				$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/small/'.$new_file_name,
						    'create_thumb'	=> true,
						    'width'		=> '300',
						    'height'		=> '230'
						    
						);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$file = FRONTEND_URL.'upload/property/small/'.$new_file_name;
				$this->cdnupload->upload($file,'property/small',$new_file_name);
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/small/'.$new_file_name);
				
				$this->image_lib->clear();
				
				$config 	= array(
						    'image_library' 	=> 'GD2',
						    'source_image'	=> $tmp_name,
						    'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/thumb/'.$new_file_name,
						    'create_thumb'	=> true,
						    'width'		=> '76',
						    'height'		=> '81'
						);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$file = FRONTEND_URL.'upload/property/thumb/'.$new_file_name;
				$this->cdnupload->upload($file,'property/thumb',$new_file_name);
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'property/thumb/'.$new_file_name);
				
				$this->image_lib->clear();
				$image_insert_arr[$index] 		= array();
				$image_insert_arr[$index]['image_name']	= $new_file_name;
				if(array_key_exists($index, $image_temp_title_arr)){
				    $image_insert_arr[$index]['image_title']	= addslashes($image_temp_title_arr[$index]);
				}
				if(array_key_exists($index, $image_temp_alt_arr)){
				    $image_insert_arr[$index]['image_alt']	= addslashes($image_temp_alt_arr[$index]);
				}
				if(count($property_image)==0){
				    if($index==0){
					$image_insert_arr[$index]['featured_image']='Yes';
				    }else{
					$image_insert_arr[$index]['featured_image']='No';
				    }
				}
			    }
			}
		    }
		}
		//pr($image_insert_arr);
		//if($featured_image!=''){
		//   $update_arr=array('featured_image'=>'Yes');
		//   $idArr=array('property_image_id'=>$featured_image);
		//   $this->model_basic->updateIntoTable( PROPERTY_IMAGE , $idArr, $update_arr);
		//}
		
		if(is_array($image_insert_arr) and count($image_insert_arr)>0){   // IMAGE DATA
		    foreach($image_insert_arr as $index=>$image){
			$image['property_id'] 	= $property_master_id;
			$this->model_basic->insertIntoTable( PROPERTY_IMAGE , $image);
			
		    }
		    
		    $this->nsession->set_userdata('succmsg','Property is updated successfully and the uploaded images will take few times for displaying ');
		    
		}
		$image_title_arr 	= $this->input->post('image_title');
		$image_alt_arr 		= $this->input->post('image_alt');
		if(is_array($image_title_arr) and count($image_title_arr)>0){
		    foreach($image_title_arr as $title_index=>$title){
			
			$alt 		= $image_alt_arr[$title_index];
			$image_id 	= $title_index;
			$update_arr 	= array(
						'image_title'	=> $title,
						'image_alt'	=> $alt
						);
			$idArr		= array('property_image_id'=>$image_id);
			$this->model_basic->updateIntoTable(PROPERTY_IMAGE,$idArr,$update_arr);
		    }
		}
		
		//echo BACKEND_URL.'property/index';exit;
		redirect(BACKEND_URL.'property/index/');
		//exit;
		
	}
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'photo'),true);
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/edit_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
	
	
   public function addPrice($property_id){
	    $minimum_rental_days	= $this->input->get_post('minimum_rental_days');
	    $season_daily		= $this->input->get_post('season_daily');
	    $isDefault			= $this->input->get_post('isDefault');
	    $commission_rate 		= $this->input->get_post('commission_rate');
	    $roomtype 			= $this->input->get_post('roomtype');
	   
	    
	    
	    $ret = array();
	    if(count($roomtype)>0){
		$delete_where = "property_id = '".$property_id."'";
		$this->model_basic->deleteData(PROPERTY_PRICE, $delete_where);
		foreach($roomtype as $index=>$val){
			     
			     $property_season_price  = array(
					     'property_id'		=> $property_id ,
					     'room_type'		=> $val,
					     'minimum_rental_days'	=> $minimum_rental_days[$index] ,
					     'daily_price'		=> addslashes(trim($season_daily[$index])),
					     //'isDefault'		=> $isDefault[$index],
					     'commission_price'	=> $commission_rate[$index],
					     'updated_on'		=> date("Y-m-d H:i:s")
					     );
			     if($isDefault==$val){
				$property_season_price['isDefault'] = 'Yes';   
			     }else{
				$property_season_price['isDefault'] = 'No';   
			     }
			     
			     //pr($property_season_price,0);
			     $ret[] = $this->model_basic->insertIntoTable(PROPERTY_PRICE ,$property_season_price);
			     
		  
		}
	    }
	    

   }
   
   
   
   public function deletePropertImage()
   {
     $img_name = $this->input->post('imgName');
     if($img_name)
     {
	unlink(FILE_UPLOAD_URL.'property/big/'.$img_name);
	unlink(FILE_UPLOAD_URL.'property/small/'.$img_name);
	unlink(FILE_UPLOAD_URL.'property/thumb/'.$img_name);
	$this->model_basic->deleteData(PROPERTY_IMAGE, ' image_name="'.$img_name.'" ');
     }
     echo 'success';
   }
   
	public function get_season(){
		
		$property_id 	= $this->input->get_post('pid');
		$page		= $this->uri->segment(4,0);
		$this->data['page']  		=  $page;
		
		if($property_id < 1 || $property_id == ''){
			$this->nsession->set_userdata('succmsg', "Property  additional information updated successfully");
			redirect(BACKEND_URL."property/index/".$page);
			return true;
		}
		$this->data['property_id']  	=  $property_id;
		$year = $this->input->get_post('year');
		
		$this->data['errmsg']		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg', "");
		$this->data['edit_link']      	= BACKEND_URL."property_rental/edit_property/".$property_id."/".$page."/";
		$this->data['edit_prices']     	= BACKEND_URL."property_rental/season_prices_new/".$property_id."/".$page."/";
		$this->data['image_link']	= BACKEND_URL."property_rental/property_image/".$property_id."/".$page."/";

		$this->data['year']			= $year;
		// Get all the season years
		$this->data['season_year_list']  	= $this->model_property->getPropertySeasonAllYears($property_id);
		$this->data['season_price_list']  	= $this->model_property->getPropertySeasonYears($property_id,$year);
		$this->data['season_record_count']  	= $this->model_property->getPropertySeasonCount($property_id);
		$this->data['property_details']		= $this->model_property->getPropertyDetails($property_id);
		
		echo $html = $this->load->view('property/ajax_season_add', $this->data, TRUE);
		exit;
		
	}
	
	
    public function is_feature(){
	
       $img_id = $this->input->post('img_id');
       $property_id = $this->input->post('property_id');
       
       $rec = $this->model_property->getPropertyImageInfoId($img_id);
    
       
       if(is_array($rec) and count($rec)>0){
	  $featured_image = $rec[0]['featured_image'];
	  
	  $is_feature ='';
	  if($featured_image=='Yes'){
	    $is_feature = 'No';
	  }
	  else{
	    $is_feature = 'Yes';
	  }
	  
	  $this->model_property->updateFeature($img_id,$property_id);	 

       }
   }
   
   public function setOrderImage(){
      $images = $this->input->post('images');
      foreach($images as $index=>$img){
	  $order = $index+1;
	  $idarr= array('property_image_id'=>$img);
	  $update_arr = array('image_order'=>$order);
	  $this->model_basic->updateIntoTable(PROPERTY_IMAGE, $idarr, $update_arr);
      }
   }
   public function view_query(){
	chk_login();
	$property_id 	= $this->uri->segment(3,0);
	$pages		= $this->uri->segment(4,0);
        $this->data='';
	$config['base_url'] 	= BACKEND_URL.currentClass()."/view_query/".$property_id.'/'.$pages;
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 5;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	
	if($this->input->get_post('btn_show_all')!=''){
            $this->nsession->unset_userdata('QUERY_SEARCH');
            redirect(currentClass()."/view_query/".$property_id.'/'.$pages);
        }
	
	$this->data['params']		= $this->nsession->userdata('QUERY_SEARCH');
	
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
	$page				= $this->uri->segment(5,0);
	$this->data['queryList']	= $this->model_property->getQuery($config,$start,$property_id);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= currentClass();
	$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_query/".$property_id."/".$pages."/{{ID}}/";
	$this->data['base_url']		= BACKEND_URL.currentClass()."/property/".$pages;
	
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Listing','link'=>'javascript:void();')
				     );	
	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/view_query';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
    public function delete_query(){
	$property_id 	= $this->uri->segment(3,0);
	$pages		= $this->uri->segment(4,0);
	$feedback_id	= $this->uri->segment(5,0);
	$this->model_basic->deleteData(FEEDBACK,'feedback_id="'.$feedback_id.'"');
	$this->nsession->set_userdata('succmsg','Comment deleted successfully!');
	redirect(currentClass()."/view_query/".$property_id.'/'.$pages);
    }
   public function availability()
   {
	
	$prefs['template'] = '

   {table_open}<table border="0" cellpadding="0" cellspacing="0" class="availability_calender">{/table_open}

   {heading_row_start}<tr class="tableHeading">{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}"><div class="thHeadMon">{heading}</div></th>{/heading_title_cell}
   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="week_name">{/week_row_start}
   {week_day_cell}<td><span>{week_day}</span></td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="day_view">{/cal_row_start}
   {cal_cell_start}<td>{/cal_cell_start}
    
   {cal_cell_content}<span class="{content}">{day}</span>{/cal_cell_content}
   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

   {cal_cell_no_content}{day}{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';

	
    $this->load->library('calendar',$prefs);
    
    $year = $this->uri->segment(4);
    $id = $this->uri->segment(3);
    
    //$year = 2015;
    //$id = 1;
    
    
    $prev_year = $year-1;
    $next_year = $year+1;
    
    $this->data['year'] = $year;
    $this->data['property_id'] = $id;
    
    $this->data['prev_url'] = BACKEND_URL."property/availability/".$id."/".$prev_year."/";
    $this->data['next_url'] = BACKEND_URL."property/availability/".$id."/".$next_year."/";
	
   

	 $this->data['brdLink']=array(
			     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
			     array('logo'=>'fa fa-edit','name'=>'Availability','link'=>'javascript:void();')
			     );
		
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property_tab',array('select_tab'=>'facilities'),true);
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='property/availability';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
   }
	 
	 
	 public function view(){
		  chk_login();
		  $property_id = $year = $this->uri->segment(3);
		  
		  $this->data['page'] = $this->uri->segment(4);
		  $this->data['details'] = $this->model_property->get_property_details_view($property_id);
		  //pr($this->data['details']);
		  $this->data['property_name'] = $this->data['details']['property_name'];
		  $this->data['brdLink']=array(
				     array('logo'=>'fa fa-home','name'=>'Property','link'=>'javascript:void();'),
				     array('logo'=>'fa fa-list','name'=>'Property Details','link'=>'javascript:void();')
				     );	
		  $this->templatelayout->get_topbar();
		  $this->templatelayout->get_leftmenu();
		  $this->templatelayout->get_footer();
		  $this->elements['middle']='property/view';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
	 }
	 
	 
	 
}
?>