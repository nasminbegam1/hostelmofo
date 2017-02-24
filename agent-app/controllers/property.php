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
				9=>"Default Price",
				10=>"Guest"
				);
    public function __construct(){
        parent:: __construct();
		  $this->chk_login();
        $this->load->model(array("model_property","model_booking_list","model_availability"));
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
     
	  
    public function index()
    {
        $this->chk_login();
		  $this->data='';
		  $this->data['total_property'] = $this->model_basic->isRecordExist(PROPERTY_MASTER,"agent_id = '".$this->current_user['agent_id']."'");
		  
        
	
		  //<!----------------------code------------------------->
				 
		  $config['base_url'] 	= AGENT_URL.currentClass()."/index/";
		  $config['per_page'] 	= 20;
		  $config['uri_segment']	= 3;
		  $config['num_links'] 	= 5;
		  $this->pagination->setCustomAdminPaginationStyle($config);
		  
		  $this->data['search_keyword']	= '';
		  $this->data['per_page']	= '';
	
		  if($this->input->get_post('btn_show_all')!=''){
            $this->nsession->unset_userdata('PROPERTY_MASTER_SEARCH');
				redirect(base_url()."property/index/");
        }
	
		  $this->data['params']		= $this->nsession->userdata('PROPERTY_MASTER_SEARCH');
	
		  if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == ''){	
			  $this->data['search_keyword'] = $this->data['params']['search_keyword'];
			  $this->data['per_page']	= $this->data['params']['per_page'];
		  }
		  else {
			  $this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			  $this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		  }
	
		  $start 				= 0;
		  $page				= $this->uri->segment(3,0);
		  
		  
		  $this->data['propertyList']	= $this->model_property->getList($config,$start);
		  //pr($this->data['propertyList']);
		  
		  
		  if(count($this->data['propertyList'])>0){
				$this->data['city_update'] 	= $this->model_property->get_city_update();
		  }
	
		  //pr($this->data['propertyList']);
		  $this->data['startRecord'] 	= $start;
       
		  $this->data['totalRecord'] 	= $config['total_rows'];
		  $this->data['per_page'] 	= $config['per_page'];
		  $this->data['page']	 	= $page;
		  $this->data['controller'] 	= currentClass();	
		  $this->data['base_url'] 	= AGENT_URL.$this->data['controller']."/index/0/1/";				
		  $this->data['show_all']      	= AGENT_URL.$this->data['controller']."/index/0/1/";
		  $this->data['add_link']      	= AGENT_URL.$this->data['controller']."/add/0/";
		  $this->data['edit_link']      	= AGENT_URL.$this->data['controller']."/edit/{{ID}}/";
		  $this->data['delete_link']	= AGENT_URL.$this->data['controller']."/delete/{{ID}}/";
		  $this->data['booking_link']	= AGENT_URL."booking_list/bookings/{{ID}}/";
		  $this->data['availability_link']= AGENT_URL.$this->data['controller']."/availability/{{ID}}/".date('Y')."/";
		  $this->data['room_and_rates']   = AGENT_URL."room_details/index/{{ID}}/";
			

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
		  $brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		  $brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'List' );
		  
		  $this->data['breadcrumbs'] = $brd_arr;
		  //........................
		  $this->data['required_fileds']= $this->required_field;
				 $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
				 
		  $this->templatelayout->get_header();
		  $this->templatelayout->get_footer();
		  $this->templatelayout->get_sidebar('property');
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
   
   
//   public function ajaxCityList(){
//      $pro_id = $this->input->post('pro_id');
//      $city=array();
//      $city_list = $this->model_basic->getValues_conditions(CITY,array('city_master_id','city_name'),'',' province_id="'.$pro_id.'" and status="Active"');
//      
//		  if(is_array($city_list) and count($city_list)>0){
//				$city = $city_list;
//		  }
//		  
//		  
//      echo json_encode($city);
//   }
	
	
	
	   
	 public function ajaxCityList(){
      $pro_id = $this->input->post('pro_id');
      $city=array();
      $city_list = $this->model_basic->getValues_conditions(CITY,array('city_master_id','city_name'),'',' province_id="'.$pro_id.'" and status="Active"');
      
		  if(is_array($city_list) && count($city_list)>0){
            echo '<option value="">Please select city</option>';
            foreach($city_list AS $city){
                echo '<option value="'.$city['city_master_id'].'">'.$city['city_name'].'</option>';
            } 
        }
	 }
	
	
	
    public function add(){
		  $this->chk_login();
		  $brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		  $brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Add' );
		  $this->data['breadcrumbs'] = $brd_arr;
		  
		  $this->data['provinces'] = $this->model_basic->getValues_conditions(PROVINCE_MASTER,'','','status="Active"');
		  $this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');
		  $this->data['property_type'] 		= $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
		  
		  $this->data['age_group'] = $this->model_basic->getValues_conditions(AGEGROUP,'','','status="active"');
		  $this->data['group_list'] = $this->model_basic->getValues_conditions(GROUPTYPE,'','','status="active"');
		  
		  $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
				 
		  $this->templatelayout->get_header();
		  $this->templatelayout->get_footer();
		  $this->templatelayout->get_sidebar('property');
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
    
      
				$action = $this->input->post('action');
				$respons ='';
      
				$this->form_validation->set_rules('property_name','Property Name','trim|required');
				$this->form_validation->set_rules('property_type','Property Type','required|trim');
				$this->form_validation->set_rules('province_id','province name','required|trim');
				$this->form_validation->set_rules('guest','Guest','required|trim');
				$this->form_validation->set_rules('bedrooms','Bed Rooms','required|trim');
				$this->form_validation->set_rules('beds','Beds','required|trim');
				$this->form_validation->set_rules('address','Address','required|trim');
				$this->form_validation->set_rules('address2','Address2','trim');
				$this->form_validation->set_rules('city_id','city name','required|trim');
				$this->form_validation->set_rules('website_address','Website Address','required|trim');
				$this->form_validation->set_rules('email_address_booking','Booking Email','trim|required|valid_email');
				$this->form_validation->set_rules('licensee_email','Main Manager Email Address','trim|valid_email');
				$this->form_validation->set_rules('main_manager_email','Contact Email','trim|valid_email');
				$this->form_validation->set_rules('phone_no','Phone No','trim|required');
				$this->form_validation->set_rules('fax_no','Fax No','trim');
				$this->form_validation->set_rules('zip_code','Zip Code','trim');
				$this->form_validation->set_rules('mobile_url','Mobile Url','trim');
				//$this->form_validation->set_rules('group_type[]','Group Type','required|trim');
				//$this->form_validation->set_rules('age_group[]','Age Group','required|trim');
	  
	    if($this->form_validation->run() == true){
		
				$property_name 			= addslashes( trim( $this->input->post('property_name') ) );
				$property_slug 			= url_title(strtolower($property_name));
				$address 			= addslashes( trim( $this->input->post('address') ) );
				$address2 			= addslashes( trim( $this->input->post('address2') ) );
				$province_id 			= addslashes( trim( $this->input->post('province_id') ) );
				$city_id 			= addslashes( trim( $this->input->post('city_id') ) );
				$website_address 		= addslashes( trim($this->input->post('website_address')));	
				$email_address_booking 		= addslashes( trim( $this->input->post('email_address_booking')));
				$main_manager_email 		= addslashes( trim( $this->input->post('main_manager_email')));
				$licensee_email 		= addslashes( trim( $this->input->post('licensee_email')));
				$Phone_no 			= addslashes( trim( $this->input->post('phone_no')));
				$fax_no				= addslashes( trim($this->input->post('fax_no')) );
				$zip_code 			= addslashes( trim( $this->input->post('zip_code')));
				$mobile_url 			= addslashes( trim( $this->input->post('mobile_url')));
				$guest 				= addslashes( trim( $this->input->post('guest') ) );
				$bedrooms 				= addslashes( trim( $this->input->post('bedrooms') ) );
				$beds 				= addslashes( trim( $this->input->post('beds') ) );
				
				$allow_group 			= addslashes( trim( $this->input->post('allow_group')));
				$group_type			= $this->input->post('group_type');
				//$group_type		= addslashes( implode(',',$this->input->post('group_type')) );
				//$age_group		= addslashes( implode(',',$this->input->post('age_group')) );
				
		$deposite 			= $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'',"sitesettings_id='20'");
		$property_master_data = array(
						'agent_id'				=> $this->current_user['agent_id'],
						'property_name'			=> $property_name,
						'property_type_id'		=> '1',
						'website_address'		=> $website_address,
						'phone_no'			=> $Phone_no,
						'fax_no'			=> $fax_no,
						'mobile_url'			=> $mobile_url,
						'deposite_amount'		=> $deposite[0]['sitesettings_value'],
						'guest'				=> $guest,
						'bedrooms'  			=> $bedrooms,
						'beds'   			=> $beds,
						'group_booking_support' 	=> ($allow_group != '') ? $allow_group : 'no',
						//'ageGroup'  			=> $age_group,
						//'groupType'   			=> $group_type
						);
	      
		$new_property_id = $this->model_basic->insertIntoTable( PROPERTY_MASTER, $property_master_data); // MASTER DATA
		//$new_property_id = 1;
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
		
		$latitude = '';
		$longitude = '';
		$city_name = $this->model_basic->getValue_condition(CITY,'city_name','','city_master_id='.$city_id);
		$privince_name = $this->model_basic->getValue_condition(PROVINCE_MASTER,'province_name','','province_id='.$province_id);
		
		$get_address = $city_name.", ".$privince_name;
		
		
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($get_address).'&sensor=false');
		$geo = json_decode($geo, true);
		if ($geo['status'] = 'OK') {
		  // We set our values
		  $latitude = $geo['results'][0]['geometry']['location']['lat'];
		  $longitude = $geo['results'][0]['geometry']['location']['lng'];
		}
		
		$property_details_data=array('property_id'=>$new_property_id,
					    'address'			=> $address,
					    'address2'			=> $address2,
					    'province_id'		=> $province_id,
					    'city_id'			=> $city_id,
					    'latitude'			=> $latitude,
					    'longitude'			=> $longitude,
					    'email_address_booking'    	=> $email_address_booking, 
					    'licensee_email'	   	=> $licensee_email,
					    'main_manager_email'   	=> $main_manager_email,
					    'zip_code'             	=> $zip_code);
		$this->model_basic->insertIntoTable( PROPERTY_DETAILS, $property_details_data); // DETAILS DATA
		
		
		
		$this->nsession->userdata('succmsg','Property Details is added successfully');
		
		$this->updateRequired(array(0,3,4,5),$new_property_id);
		//pr($group_type);
		if($allow_group != '' && is_array($group_type)> 0){
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
		redirect(AGENT_URL.'property/editcontactaction/'.$new_property_id);
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
		  $property_id 	= $this->uri->segment(3,0);
		  //$page		= $this->uri->segment(4,0);
		  //echo $property_id;
		  //exit;
		  $this->data['property_details']		= $this->model_property->getPropertyDetails($property_id);
		  //pr($this->data['property_details']);
		  $property = $this->model_property->getPropertyDetails($property_id);
		  $this->data['provinces'] 		= $this->model_basic->getValues_conditions(PROVINCE_MASTER,'','','status="Active"');
		  
		  $this->data['cities'] 		= $this->model_basic->getValues_conditions(CITY,'','','status="Active" AND province_id='.$property['property_details']['province_id']);
		  
		  $this->data['property_type'] 		= $this->model_basic->getValues_conditions(PROPERTY_TYPE,'','','status="Active"');
		  
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
		  
		  $this->data['roomtype_list']		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,'','','roomtype_status="Active"');
		  $this->data['succmsg'] 			= $this->nsession->userdata('succmsg');
		  $this->data['errmsg'] 			= $this->nsession->userdata('errmsg');
		  $this->nsession->set_userdata('succmsg', "");		
		  $this->nsession->set_userdata('errmsg', "");
        $this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'details'),true);
		  $propertDtls 				= $this->model_booking_list->get_property_name($property_id);
        $this->data['property_header'] 		= $this->load->view('property/property_header',
							   array('select_tab'=>'change_setting',
								 'property_id'=> $property_id,
								 'propertDtls'=>$propertDtls),true);
	
        $this->templatelayout->get_header();
		  $this->templatelayout->get_footer();
		  $this->templatelayout->get_sidebar('property');
        $this->elements['middle']='property/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
   
   public function editAction(){
    
      
       $action  		= $this->input->post('action');
       $respons 		='';
       $property_id 		= $this->uri->segment(3,0);
       //$page			= $this->uri->segment(4,0);		
       if($this->input->get_post('action') == 'basic_info')
       {
	    $this->form_validation->set_rules('property_name','Property Name','trim|required');
	    $this->form_validation->set_rules('property_type','Property Type','required|trim');
	    $this->form_validation->set_rules('province_id','province name','required|trim');
	    $this->form_validation->set_rules('guest','Guest','required|trim');
	    $this->form_validation->set_rules('bedrooms','Bed Rooms','required|trim');
	    $this->form_validation->set_rules('beds','Beds','required|trim');
	    $this->form_validation->set_rules('address','Address','required|trim');
	    $this->form_validation->set_rules('address2','Address2','trim');
	    $this->form_validation->set_rules('city_id','city name','required|trim');
	    $this->form_validation->set_rules('website_address','Website Address','required|trim');
	    $this->form_validation->set_rules('email_address_booking','Booking Email','trim|required|valid_email');
	    $this->form_validation->set_rules('licensee_email','Main Manager Email Address','trim|valid_email');
	    $this->form_validation->set_rules('main_manager_email','Contact Email','trim|valid_email');
	    $this->form_validation->set_rules('phone_no','Phone No','trim|required');
	    $this->form_validation->set_rules('fax_no','Fax No','trim');
	    $this->form_validation->set_rules('zip_code','Zip Code','trim');
	    $this->form_validation->set_rules('mobile_url','Mobile Url','trim');
		 
	    //$this->form_validation->set_rules('group_type[]','Group Type','required|trim');
	    //$this->form_validation->set_rules('age_group[]','Age Group','required|trim');
		  
	    if($this->form_validation->run() == true)
	    {
		$property_master_id		= $this->input->post('property_master_id');
		$property_name 			= addslashes( trim( $this->input->post('property_name') ) );
		$guest 				= addslashes( trim( $this->input->post('guest') ) );
		$property_slug 			= url_title(strtolower($property_name));
		$address 			= addslashes( trim( $this->input->post('address') ) );
		$address2 			= addslashes( trim( $this->input->post('address2') ) );
		$province_id 			= addslashes( trim( $this->input->post('province_id') ) );
		$city_id 			= addslashes( trim( $this->input->post('city_id') ) );
		$website_address 		= addslashes( trim($this->input->post('website_address')));	
		$email_address_booking 		= addslashes( trim( $this->input->post('email_address_booking')));
		$main_manager_email 		= addslashes( trim( $this->input->post('main_manager_email')));
		$licensee_email 		= addslashes( trim( $this->input->post('licensee_email')));
		$Phone_no 			= addslashes( trim( $this->input->post('phone_no')));
		$fax_no				= addslashes( trim($this->input->post('fax_no')) );
		$zip_code 			= addslashes( trim( $this->input->post('zip_code')));
		$mobile_url 			= addslashes( trim( $this->input->post('mobile_url')));
		$bedrooms 			= addslashes( trim( $this->input->post('bedrooms') ) );
		$beds 				= addslashes( trim( $this->input->post('beds')));
		$guests 			= addslashes( trim( $this->input->post('guests')));
		$property_type			= addslashes( trim($this->input->post('property_type')) );
		$allow_group 			= addslashes( trim( $this->input->post('allow_group'))); 
		//$group_type			= addslashes( implode(',',$this->input->post('group_type')) );
		//$age_group			= addslashes( implode(',',$this->input->post('age_group')) );
		$group_type			= $this->input->post('group_type');
	       
	         $property_master_data = array(
					    'property_name'			=> $property_name,
					    'website_address'			=> $website_address,
					    'phone_no'				=> $Phone_no,
					    'fax_no'				=> $fax_no,
					    'mobile_url'			=> $mobile_url,
					    'guest'				=> $guest,
					    'bedrooms'				=> $bedrooms,
					    'beds'				=> $beds,
					    'property_type_id'			=> $property_type,
					    'group_booking_support' 		=> ($allow_group != '') ? $allow_group : 'no',
					    //'ageGroup'  			=> $age_group,
					    //'groupType'   			=> $group_type
					    );
	         $property_details  = array(
					    'address'			=> $address,
					    'address2'			=> $address2,
					    'province_id'		=> $province_id,
					    'city_id'			=> $city_id,
					    'email_address_booking'    	=> $email_address_booking, 
					    'licensee_email'	   	=> $licensee_email,
					    'main_manager_email'   	=> $main_manager_email,
					    'zip_code'             	=> $zip_code);


	       
		$idArr = array( 'property_master_id'=>$property_master_id );

		$this->model_basic->updateIntoTable( PROPERTY_MASTER, $idArr, $property_master_data); // MASTER DATA

		$idArr = array( 'property_id'=>$property_master_id );
		
		$update_data = $this->model_basic->updateIntoTable(PROPERTY_DETAILS, $idArr, $property_details);

		if(isset($update_data))
		{
		    $this->model_basic->deleteData('hw_property_grp_age','property_id="'.$property_master_id.'"');
		    if(is_array($group_type) && $allow_group=='yes'){
		    foreach($group_type as $k=>$grpTyp){
			foreach($grpTyp as $ageTyp){
			    if($ageTyp != '' ){
				$insertArr = array('property_id' => $property_master_id,
						   'group_id'    => $k,
						   'age_type_id' => $ageTyp);
				$this->model_basic->insertIntoTable( 'hw_property_grp_age', $insertArr);
			    }
			}
		    }
		    }
		    
		    $this->updateRequired(array(0,3,4,5),$property_master_id);
		
		    $this->nsession->set_userdata('succmsg','Property details is updated successfully');
		}
		else
		{
		    $this->nsession->set_userdata('succmsg','Property details is not updated successfully');
		}
		
		redirect(AGENT_URL.'property/editcontactaction/'.$property_id.'/');
		
	    }
	    else
	    {
	        $this->nsession->set_userdata('errmsg',validation_errors('<p>','</p>'));
	        redirect(AGENT_URL.'property/edit/'.$property_id.'/');
	    }
       }

      
   }
   
   public function editcontactaction()
   {
    $property_id = $this->uri->segment(3,0);

    $this->data['property_details']	= $this->model_property->getPropertyDetails($property_id);
    
    $this->data['facilities_list'] 	= $this->model_basic->getValues_conditions(FACILITIES,'','','amenities_status="Active"');
    $propertDtls 			= $this->model_booking_list->get_property_name($property_id);
    $this->data['property_header'] 	= $this->load->view('property/property_header',
							    array('select_tab'=>'change_setting',
								  'property_id'=> $property_id,
								  'propertDtls'=>$propertDtls),true);
    
       if($this->input->get_post('action') == 'contact')
       {
	       $property_master_id 	= $this->input->post('property_master_id');	
	       $description 		= addslashes( trim( $this->input->post('description') ) );
	       $brief_introduction 	= addslashes( trim( $this->input->post('brief_introduction') ) );
	       $things_to_note 		= addslashes( trim( $this->input->post('things_to_note') ) );
	       $direction 		= addslashes( trim( $this->input->post('direction') ) );
	       $location 		= addslashes( trim( $this->input->post('location') ) );
	       $hotel_condition		= addslashes( trim( $this->input->post('hotel_condition') ) );
	       $hotel_cancel		= addslashes( trim( $this->input->post('hotel_cancel') ) );
	       $maximum_nights_stay	= addslashes( trim( $this->input->post('maximum_nights_stay') ) );
	       $minimum_nights_stay 	= addslashes( trim( $this->input->post('minimum_nights_stay') ) );
	       $check_in_hour 		= trim( $this->input->post('check_in_hour'));
	       $check_in_minute 	= trim( $this->input->post('check_in_minute'));
	       $check_out_hour 		= trim( $this->input->post('check_out_hour'));
	       $check_out_minute 	= trim( $this->input->post('check_out_minute'));
	       $earliest_check_in 	= $check_in_hour.":".$check_in_minute;
	       $latest_check_in 	= $check_out_hour.":".$check_out_minute;
	       $property_video_link 	= addslashes( trim( $this->input->post('property_video_link') ) );
	       
	       $property_facilities 	= $this->input->post('property_facilities') ;
	       $property_facilities_str ='';
		if($property_facilities and is_array($property_facilities) and count($property_facilities)>0){
		    $property_facilities_str	= addslashes( implode(',',$property_facilities) );
		}
		
		$featured_image 	= $this->input->post('featured_image');

		$property_master_data = array(
				   'maximum_nights_stay'	=> $maximum_nights_stay,
				   'minimum_nights_stay'	=> $minimum_nights_stay,
				   'property_video_link'	=> $property_video_link,
				   'earliest_check_in'		=> date( "H:i:s", strtotime(date("d-m-Y").$earliest_check_in) ),
				   'latest_check_in'		=> date( "H:i:s", strtotime(date("d-m-Y").$latest_check_in) ),
				   'db_updated_on'		=> date("Y-m-d H:i:s")
				   );
		$property_details = array(
				  'description'		=> $description,
				  'brief_introduction'	=> $brief_introduction,
				  'things_to_note'	=> $things_to_note,
				  'direction'		=> $direction,
				  'location'		=> $location,
				  'cancellation_policy'	=> $hotel_cancel
				  );

	    	if(isset($_FILES['propertyfiles']) and count($_FILES['propertyfiles'])>0){
		    $this->load->library('image_lib');
		    $img_arr 			= array();
		    $image_insert_arr		= array();
		    $property_image 		= array();
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
		if(is_array($image_insert_arr) and count($image_insert_arr)>0){
		    foreach($image_insert_arr as $index=>$image){
			$image['property_id'] 	= $property_master_id;
			$this->model_basic->insertIntoTable( PROPERTY_IMAGE , $image);
			
		    }
		}    
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
		       
		$idArr = array( 'property_master_id'=>$property_master_id );
		$this->model_basic->updateIntoTable( PROPERTY_MASTER, $idArr, $property_master_data); // MASTER DATA
		
		$idArr = array( 'property_id'=>$property_master_id );
		$last_details_id = $this->model_basic->updateIntoTable( PROPERTY_DETAILS, $idArr , $property_details); // DETAILS DATA
		if(isset($last_details_id))
		{
		    $this->updateRequired(array(6),$property_master_id);
		
		    $this->nsession->set_userdata('succmsg','Property Microsite Content is updated successfully');
		}
		else
		{
		    $this->nsession->set_userdata('succmsg','Property Microsite Content not updated successfully');
		}
		redirect(AGENT_URL.'property/');
		//redirect(AGENT_URL.'property/editbasicaction/'.$property_id.'/'.$page.'/');
       }
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	$this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'contact'),true);
	$this->templatelayout->get_header();
	$this->templatelayout->get_footer();
	$this->templatelayout->get_sidebar('property');
	$this->elements['middle']='property/edit_microsite_content';			
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
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
   
//    public function get_season(){
//	    
//	    $property_id 	= $this->input->get_post('pid');
//	    $page		= $this->uri->segment(4,0);
//	    $this->data['page']  		=  $page;
//	    
//	    if($property_id < 1 || $property_id == ''){
//		    $this->nsession->set_userdata('succmsg', "Property  additional information updated successfully");
//		    redirect(AGENT_URL."property/index/".$page);
//		    return true;
//	    }
//	    $this->data['property_id']  	=  $property_id;
//	    $year = $this->input->get_post('year');
//	    
//	    $this->data['errmsg']		= $this->nsession->userdata('errmsg');
//	    $this->nsession->set_userdata('errmsg', "");
//	    $this->data['edit_link']      	= AGENT_URL."property_rental/edit_property/".$property_id."/".$page."/";
//	    $this->data['edit_prices']     	= AGENT_URL."property_rental/season_prices_new/".$property_id."/".$page."/";
//	    $this->data['image_link']	= AGENT_URL."property_rental/property_image/".$property_id."/".$page."/";
//
//	    $this->data['year']			= $year;
//	    // Get all the season years
//	    $this->data['season_year_list']  	= $this->model_property->getPropertySeasonAllYears($property_id);
//	    $this->data['season_price_list']  	= $this->model_property->getPropertySeasonYears($property_id,$year);
//	    $this->data['season_record_count']  	= $this->model_property->getPropertySeasonCount($property_id);
//	    $this->data['property_details']		= $this->model_property->getPropertyDetails($property_id);
//	    
//	    echo $html = $this->load->view('property/ajax_season_add', $this->data, TRUE);
//	    exit;
//	    
//    }
	
	
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



	public function availability()
	{
	    $propertyId = $this->uri->segment(3);
	    $year = $this->uri->segment(4);
			       $id = $this->uri->segment(3);
			       $prev_year = $year-1;
			       $next_year = $year+1;
			       $this->data['room_count'] = $this->model_availability->roomcount();
			       $start_date	=	strtotime(date('Y-m-d'));
			       $end_date	=	strtotime('+14 days',$start_date);
			       $this->data['start_date'] 	= $start_date;
			       $this->data['end_date'] 	= $end_date;
	  
			       $this->data['brdLink']=array(
									array('icon_class'=>'fa fa-home','text'=>'Property','link'=>'javascript:void();'),
									array('icon_class'=>'fa fa-edit','text'=>'Availability','link'=>'javascript:void();')
			  );
			       $current	= $this->nsession->userdata('current_user');	 
			       $agentId 	= $current['agent_id'];
	
			       $this->data['succmsg'] = $this->nsession->userdata('succmsg');
			       $this->data['errmsg'] = $this->nsession->userdata('errmsg');		
			       $this->nsession->set_userdata('succmsg', "");		
			       $this->nsession->set_userdata('errmsg', "");
			       $propertDtls = $this->model_booking_list->get_property_name($id);
			       
			       $this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'facilities'),true);
			       $this->data['property_header'] = $this->load->view('property/property_header',
																									array('select_tab'=>'availability',
																									'property_id'=> $id,
																									'propertDtls'=>$propertDtls),
																									true);
			       
	    if($this->input->get_post('action') == 'Process'){

		    $this->form_validation->set_rules('start', 'Start Date', 'trim|required');
		    $this->form_validation->set_rules('end', 'End Date', 'trim|required');

		    if($this->form_validation->run() == true){
				      $start_date 	= strtotime( trim( $this->input->get_post('start') ) );
				      $end_date 	= strtotime( trim( $this->input->get_post('end') ) );
				      $propertyId	= trim( $this->input->get_post('property_id') );
				      $this->data['start_date']  	= $start_date;
				      $this->data['end_date']  	= $end_date;
		    }
	    }
	    
	    $this->data['availability'] = $this->model_availability->availabilityDetails($propertyId,$agentId,$start_date,$end_date);
	    
	    //echo "<pre>";
	    //print_r($this->data['availability']);
	    //exit();
	    
	    $this->templatelayout->get_footer();
	    $this->templatelayout->get_header();
	    $this->templatelayout->get_sidebar('property');
	    $this->elements['middle'] = 'property/availability';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);	
	}
	
	
	public function price_edit(){
	    
	    $property_id	= $this->input->post('propertyID'); 
	    $price		= $this->input->post('price');
	    $avail 	=  $this->input->post('avail');
	    $start_date 	= $this->input->post('start_date');
	    $diff 		= $this->input->post('diff');
	    $roomTypeID		= $this->input->post('roomTypeID');
	    
	    $newDateTimeStamp	= strtotime('+'.$diff.' days', $start_date);
	    $newdate		= date( 'Y-m-d', $newDateTimeStamp );
	    $id 		= $this->model_availability->insert_price($property_id,$roomTypeID,$newdate,$price,$avail);
	    echo $id; exit;
	}
	
	
	function booked_count_edit(){
		  $property_id	= $this->input->post('propertyID'); 
		  $booked_count		= $this->input->post('booked_count');
		  $price		= $this->input->post('price');
		  $start_date 	= $this->input->post('start_date');
		  $diff 		= $this->input->post('diff');
		  $roomTypeID		= $this->input->post('roomTypeID');
		  $newDateTimeStamp	= strtotime('+'.$diff.' days', $start_date);
		  $newdate		= date( 'Y-m-d', $newDateTimeStamp );
		  $id 		= $this->model_availability->insert_booked_count($property_id,$roomTypeID,$newdate,$price,$booked_count);
		  echo $id; exit;
	}
	
    public function addminimumnight(){
	$action		    = $this->input->post('action');
	$property_master_id = $this->input->post('property_master_id');
	$from_date 	= explode('/',$this->input->post('from_date'));
	$to_date 	= explode('/',$this->input->post('to_date'));
	$from_date	= $from_date[2].'-'.$from_date[0].'-'.$from_date[1];
	$to_date	= $to_date[2].'-'.$to_date[0].'-'.$to_date[1];
	$str 		= strtotime($to_date) - (strtotime($from_date));
	$totalDay 	= floor($str/3600/24);
	$current_user	= $this->nsession->userdata('current_user');
	if($action == 'add'){
	$insArr		= array('agent_id' 	=>$current_user['agent_id'],
				'property_id' 	=>$property_master_id,
				'from_date' 	=> $from_date,
				'to_date'	=> $to_date,
				'night'		=> $totalDay,
				'added_date'	=> date('Y-m-d H:i:s'));
	$this->model_basic->insertIntoTable(PROPERTY_MINIMUMNIGHT,$insArr);
	$returnArr['msg'] = 'Minimum Nights added successfully!'; 
	}else if($action == 'edit'){
	    $updateArr  = array('from_date' 	=> $from_date,
				'to_date'	=> $to_date,
				'night'		=> $totalDay);
	    $idArr      = array('id'=>$this->input->post('min_id'));
	    $this->model_basic->updateIntoTable(PROPERTY_MINIMUMNIGHT,$idArr,$updateArr);
	    $returnArr['msg'] = 'Minimum Nights edited successfully!'; 
	}
	echo json_encode($returnArr);
    }
	 
	 
	 
	 
    public function getminimumnight(){
		  
		  $id = $this->input->post('id');
		  if($id == ''){
				$where = ' AND id<>""';
		  }else{
				$where = ' AND id='.$id;
		  }
		  $property_master_id = $this->input->post('property_master_id');
		  $current_user	= $this->nsession->userdata('current_user');
		  $data['total_data'] = $this->model_basic->getValues_conditions(PROPERTY_MINIMUMNIGHT,array('id','DATE_FORMAT(from_date, "%a %D of %b \'%y") from_date','DATE_FORMAT(to_date, "%a %D of %b \'%y") to_date','night'),'',"property_id=".$property_master_id." AND agent_id = ".$current_user['agent_id']."".$where."");
		  //pr($data);
		  echo json_encode($data);
	
    }
	 
	 
	 
    public function getsingleminimumnight(){
	$id = $this->input->post('id');
 	if($id == ''){
	    $where = ' AND id<>""';
	}else{
	    $where = ' AND id='.$id;
	}
	$property_master_id = $this->input->post('property_master_id');
	$current_user	= $this->nsession->userdata('current_user');
	$data['total_data'] = $this->model_basic->getValues_conditions(PROPERTY_MINIMUMNIGHT,array('id','DATE_FORMAT(from_date, "%m/%d/%Y") from_date','DATE_FORMAT(to_date, "%m/%d/%Y") to_date','night'),'',"property_id=".$property_master_id." AND agent_id = ".$current_user['agent_id']."".$where."");
	//pr($data);
	echo json_encode($data);
	
    }

    	public function deals()
    	{

    		$this->chk_login();
		
			$property_id= $this->uri->segment(3);
			$page = $this->uri->segment(4);

		    //$property_id = $this->uri->segment(3,0);

			 $this->data['property_details']= $this->model_property->getPropertyDetails($property_id);

			//$this->data['dealsDetailTypeId'] = $this->model_basic->getValues_conditions(DEALS,array('room_type_id'),'',"property_id='$property_id'");
			//$this->data['dealsDetailsWithOutType'] = $this->model_basic->getValues_conditions(DEALS);

				//$dealTypeId= $this->data['dealsDetailTypeId'];

				//pr($dealTypeId);


			//$this->data['dealsDetailsType'] = $this->model_property->deal_date($dealTypeId);
				

				
				$propertDtls = $this->model_booking_list->get_property_name($property_id);

				$this->data['property_header'] 	= $this->load->view('property/property_header',
				array('select_tab'=>'change_setting',
				'property_id'=> $property_id,
				'propertDtls'=>$propertDtls),true);	
//..............................................................................................................
	$config['base_url'] 	= AGENT_URL.currentClass()."/deals/".$property_id;
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 4;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']	= '';
	
	if($this->input->get_post('btn_show_all')!=''){
            $this->nsession->unset_userdata('DEAL_LIST');//die('saheb');
	    	
            redirect(base_url()."property/deals/".$property_id);
        }
	
	 $this->data['params'] = $this->nsession->userdata('DEAL_LIST');
	
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
	$page				= $this->uri->segment(4,0);
	$this->data['dealsList']= $this->model_property->getDealList($config,$start,$property_id);
	

	//pr($this->data['room_details']);
	$this->data['startRecord'] 	= $start;
       
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 		= $page;
	$this->data['controller'] 	= currentClass();	
	$this->data['base_url'] 	= AGENT_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']     = AGENT_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']     = AGENT_URL.$this->data['controller']."/add/0/".$page."/";
	$this->data['edit_link']    = AGENT_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
	$this->data['delete_link']	= AGENT_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
	$this->data['booking_link']	= AGENT_URL."booking_list/bookings/{{ID}}/".$page."/";
	$this->data['availability_link']= AGENT_URL.$this->data['controller']."/availability/{{ID}}/".date('Y')."/";
			

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
		$brd_arr[] = array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
		$brd_arr[] = array('link'=>'javascript:void(0);', 'text' => 'Deal List' );
	
		$this->data['breadcrumbs'] = $brd_arr;				

//..............................................................................................................
				$this->data['succmsg'] = $this->nsession->userdata('succmsg');
				$this->data['errmsg'] = $this->nsession->userdata('errmsg');
				$this->nsession->set_userdata('succmsg', "");		
				$this->nsession->set_userdata('errmsg', "");
				$this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'deals'),true);
				$this->templatelayout->get_header();
				$this->templatelayout->get_footer();
				$this->templatelayout->get_sidebar('property');
				$this->elements['middle']='property/deals';			
				$this->elements_data['middle'] = $this->data;			    
				$this->layout->setLayout('layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);


    	}
   		public function add_deals()
   		{



    				$this->chk_login();

				$property_id = $this->uri->segment(3,0);
				$page = $this->uri->segment(4);
				$this->data['room_type'] = $this->model_basic->getValues_conditions(AGENT_ROOMTYPE,array('id','type_name'),'',"parent_id='0' AND agent_id=".$this->current_user['agent_id']);
				//pr($data['room_type']);

				$this->data['propertyId'] = $property_id;
				$this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'deals','property_id'=>$property_id,'page'=>$page),true);
				$propertDtls = $this->model_booking_list->get_property_name($property_id);
				$this->data['property_header'] = $this->load->view('property/property_header',
											    array('select_tab'=>'change_setting',
												  'property_id'=> $property_id,
												  'propertDtls'=>$propertDtls),
											    true);
				
					if($this->input->get_post('action') == 'basic_info')
					{
					    //pr($_POST['room_type_value']);

					//echo();
					 	 $this->form_validation->set_rules('deal_name', 'Deal Name', 'required|trim|xss_clean|is_unique[hw_deal.deal_name]');
						 $this->form_validation->set_rules('deal_desc', 'Description', 'trim|required');
						 $this->form_validation->set_rules('from_date', 'From', 'trim|required');
						// $this->form_validation->set_rules('room_lable', 'Room Label', 'trim|required');
						 $this->form_validation->set_rules('to_date', 'Date', 'trim|required');
						 $this->form_validation->set_rules('price', 'Price', 'trim|required');
						 //$this->form_validation->set_rules('room_type_value[]', 'Room Type', 'required');
						$current= $this->nsession->userdata('current_user');	 
						$current_date = date('Y-m-d | h:i:s');	

				  if($this->form_validation->run() == true){ 
						//$agentId 			= $current['agent_id'];


						$deal_name 			= trim($this->input->get_post('deal_name'));
						$deal_desc 			= trim($this->input->get_post('deal_desc'));
						$from_date 			= trim($this->input->get_post('from_date'));
						$to_date 			= trim($this->input->get_post('to_date'));
						$price 		    	= trim($this->input->get_post('price'));
						$room_type_id  		= implode(",", $this->input->post('room_type_id'));
						$room_type_value    = implode(",", $this->input->post('room_type_value'));


						
						 $roomTypeId 		= '';
						 $roomTypeValue		= '';
						 $room_type_id 		= $this->input->post('room_type_id');
						 $room_type_value 	= $this->input->post('room_type_value');
						for ($i = 0; $i<count($room_type_id); $i++) {
						    if($room_type_value[$i] >0){
							$roomTypeId[] = $room_type_id[$i];
							$roomTypeValue[] = $room_type_value[$i];
						    }
						}
	
		    //pr($this->data['room_type_name']);


						if(is_array($roomTypeId)){
						    $roomTypeId = implode(',',$roomTypeId);
						    $roomTypeValue = implode(',',$roomTypeValue);


						}

				$roomArray	= array(
								'deal_name'=>$deal_name,
								'deal_desc'=>$deal_desc,
								
								'from_date'=>$from_date,
								'to_date'=>$to_date,
								'price'=>$price, 		
								'added_date'=>$current_date,
								'room_type_id'=>$roomTypeId,
								'room_type_value'=>$roomTypeValue,
								'property_id'=>$property_id 
								);


						//pr($roomArray);

				 $insertData = $this->model_basic->insertIntoTable(DEALS,$roomArray);
				  redirect(AGENT_URL.'property/deals/'.$property_id);

				}else{ 
	      			 $this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));

	      			  redirect(AGENT_URL.'property/add_deals/'.$property_id);
		       	}
				  
				
			}

		   

					$this->data['succmsg'] = $this->nsession->userdata('succmsg');
					$this->data['errmsg'] = $this->nsession->userdata('errmsg');
					$this->nsession->set_userdata('succmsg', "");		
					$this->nsession->set_userdata('errmsg', "");
					
					$this->templatelayout->get_header();
					$this->templatelayout->get_footer();
					$this->templatelayout->get_sidebar('booking');
					$this->elements['middle']='property/add_deals';			
					$this->elements_data['middle'] = $this->data;			    
					$this->layout->setLayout('layout');
					$this->layout->multiple_view($this->elements,$this->elements_data);	
				

			}
			//***************************************
			public function is_deal_exists()
			{

			$id 		= $this->uri->segment(4);
			$deal_name	= strip_tags(addslashes(trim($this->input->get_post('deal_name'))));
			$whereArr	= array();
			if($id > 0){
			$whereArr	= array( 'deal_name' => $deal_name,
			'deal_id != ' => $id						
			);
			}else{			
			$whereArr	= array( 'deal_name' => $deal_name );
			}
			$bool 	= $this->model_basic->checkRowExists(DEALS, $whereArr );
			if($bool == 0){
			$this->form_validation->set_message('is_deal_exists', 'The %s already exists');
			return FALSE;
			}else{
			return TRUE;
			}



			}

			//************************************

    			public function deal_edit()
    			{

    			$this->chk_login();

				$dealId =$this->uri->segment(4);
				$this->data['room_type'] = $this->model_basic->getValues_conditions(AGENT_ROOMTYPE,array('id','type_name'),'',"parent_id='0' AND agent_id=".$this->current_user['agent_id']);
				$this->data['deals_details'] = $this->model_basic->getValues_conditions(DEALS,'','',"deal_id='$dealId'");
				//pr($this->data['deals_details']);
				$this->data['propertyId'] = $this->data['deals_details'][0]['property_id'];
				$this->data['tabs'] = $this->load->view('property/property_tab',array('select_tab'=>'deals','property_id'=>$this->data['propertyId'],),true);
				$propertDtls = $this->model_booking_list->get_property_name($this->data['propertyId']);
				
				$this->data['property_header'] = $this->load->view('property/property_header',
											    array('select_tab'=>'change_setting',
												  'property_id'=> $this->data['propertyId'],
												  'propertDtls'=>$propertDtls),
											    true);


				$this->data['succmsg'] = $this->nsession->userdata('succmsg');
				$this->data['errmsg'] = $this->nsession->userdata('errmsg');
				$this->nsession->set_userdata('succmsg', "");		
				$this->nsession->set_userdata('errmsg', "");
				
				$this->templatelayout->get_header();
				$this->templatelayout->get_footer();
				$this->templatelayout->get_sidebar('booking');
				$this->elements['middle']='property/edit_deal';			
				$this->elements_data['middle'] = $this->data;			    
				$this->layout->setLayout('layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);	

				

    			}	

public function update()
{

	$this->chk_login();

	$property_id = $this->uri->segment(3,0);

	$page = $this->uri->segment(4);
	
	    if($this->input->get_post('action') == 'basic_info')
	    {
			$this->form_validation->set_rules('deal_name', 'Deal Name', 'trim|required|callback_is_deal_exists');
			
			$this->form_validation->set_rules('deal_desc', 'Description', 'trim|required');
			$this->form_validation->set_rules('from_date', 'From', 'trim|required');
			$this->form_validation->set_rules('to_date', 'Date', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$current= $this->nsession->userdata('current_user');	 
			$current_date = date('Y-m-d h:i:s');	

			if($this->form_validation->run() == true){
			//$agentId 			= $current['agent_id'];
			
			$deal_id 			= $this->input->get_post('deal_id');
			$deal_name 			= trim($this->input->get_post('deal_name'));
			$deal_desc 			= trim($this->input->get_post('deal_desc'));
			$from_date 			= trim($this->input->get_post('from_date'));
			$to_date 			= trim($this->input->get_post('to_date'));
			$price 		    	= trim($this->input->get_post('price'));
			$room_type_id  		= implode(",", $this->input->post('room_type_id'));
			$room_type_value    = implode(",", $this->input->post('room_type_value'));


			
			$roomTypeId 		= '';
			$roomTypeValue		= '';
			$room_type_id 		= $this->input->post('room_type_id');
			$room_type_value 	= $this->input->post('room_type_value');
			for ($i = 0; $i<count($room_type_id); $i++) {
			    if($room_type_value[$i] >0){
				$roomTypeId[] = $room_type_id[$i];
				$roomTypeValue[] = $room_type_value[$i];
			    }
			}

//pr($this->data['room_type_name']);


			if(is_array($roomTypeId)){
			    $roomTypeId = implode(',',$roomTypeId);
			    $roomTypeValue = implode(',',$roomTypeValue);


			}

	$roomArray	= array(
					'deal_name'=>$deal_name,
					'deal_desc'=>$deal_desc,
					
					'from_date'=>$from_date,
					'to_date'=>$to_date,
					'price'=>$price, 		
					'added_date'=>$current_date,
					'room_type_id'=>$roomTypeId,
					'room_type_value'=>$roomTypeValue
					);

	 $insertData = $this->model_basic->updateIntoTable(DEALS,array('deal_id' =>$deal_id),$roomArray);
	  redirect(AGENT_URL.'property/deals/'.$property_id);

	}else{
	   $deal_id 			= $this->input->get_post('deal_id');
	   $this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
	   redirect(AGENT_URL.'property/deal_edit/'.$property_id.'/'.$deal_id);
	}
	  
	
	}			



		
}

}
?>