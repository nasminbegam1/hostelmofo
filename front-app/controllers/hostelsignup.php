<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hostelsignup extends CI_Controller {
	
	var $propertyType 		= 'hw_property_type_master';
	var $cityMaster 		= 'hw_city_master';
	var $provinceMaster 		= 'hw_province_master';
	var $currencyMaster 		= 'hw_currency_master';
	var $hearAboutUs 		= 'hw_hear_about_master';
	var $facilitiesMaster 		= 'hw_facilities_master';
	var $policyMaster 		= 'hw_property_policies_master';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
	}
	
	public function index()
	{
		$this->data = '';
		//$this->load->view('hostelsignup/intro',$this->data); 
		
		$this->templatelayout->make_seo('Hostel World');
		$this->templatelayout->get_footer(); 
		$this->elements['middle']='hostelsignup/intro';			
		$this->elements_data['middle'] = $this->data; 
		$this->layout->setLayout('general_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	}
	
	public function step1()
	{
		$this->data = ''; 
		$this->data['propertyType'] 	= $this->model_basic->getFromWhereSelect(PROPERTY_TYPE);
		$this->data['provinceMaster'] 	= $this->model_basic->getFromWhereSelect(PROVINCE_MASTER);
		$this->data['cityMaster'] 	= $this->model_basic->getFromWhereSelect(CITY);
		$this->data['currencyMaster'] 	= $this->model_basic->getFromWhereSelect(CURRENCY_MASTER);
		$this->data['hearAboutUs'] 	= $this->model_basic->getFromWhereSelect(HEAR_ABOUT);
		$this->data['facilities'] 	= $this->model_basic->getFromWhereSelect(FACILITIES);
		$this->data['policyMaster'] 	= $this->model_basic->getFromWhereSelect(POLICY_MASTER);
		
		if($this->input->post('action') == 'Process'){
			$this->form_validation->set_rules('property_name','Property Name','required|trim');
			$this->form_validation->set_rules('property_type_id','Property Type','required|trim');
			if($this->form_validation->run() == true){
				
			$property_name 		= addslashes( trim( $this->input->post('property_name') ) );
			$property_slug 		= url_title(strtolower($property_name));
			$property_type 		= addslashes( trim( $this->input->post('property_type_id') ) );
			$bedrooms 		= addslashes( trim( $this->input->post('bedrooms') ) );
			$beds 			= addslashes( trim( $this->input->post('beds') ) );
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
			$mobile_address 	= addslashes( trim( $this->input->post('mobile_address') ) );
			$fax_no 		= addslashes( trim( $this->input->post('fax_no') ) );
			$language_id 		= addslashes( trim( $this->input->post('language_id') ) );
			$hear_about_id 		= addslashes( trim( $this->input->post('hear_about_id') ) );
			$brief_introduction 	= addslashes( trim( $this->input->post('brief_introduction') ) );
			$description 		= addslashes( trim( $this->input->post('description') ) );
			$location 		= addslashes( trim( $this->input->post('location') ) );
			$direction 		= addslashes( trim( $this->input->post('direction') ) );
			$things_to_note 	= addslashes( trim( $this->input->post('things_to_note') ) );
			$property_facilities 	= $this->input->post('property_facilities') ;
			$property_policy 	= $this->input->post('property_policy') ;
			$earliest_check_in 	= addslashes( trim( $this->input->post('earliest_check_in') ) );
			$latest_check_in 	= addslashes( trim( $this->input->post('latest_check_in') ) );
			$property_video_link 	= addslashes( trim( $this->input->post('property_video_link') ) );
			$property_master_data = array(
					    'user_id'		=> 	$this->nsession->userdata('admin_id'),
					    'property_name'	=>	$property_name,
					    'property_slug'	=>	$property_slug,
					    'property_type_id'	=>	$property_type,
					    'bedrooms'		=>	$bedrooms,
					    'beds'		=>	$beds,
					    'website_address'	=>	$website_address,
					    'mobile_address'	=>	$mobile_address,
					    'phone_no'		=>	$phone_no,
					    'fax_no'		=>	$fax_no,
					    'property_video_link'=>	$property_video_link,
					    'earliest_check_in'	=>	date( "H:i:s", strtotime(date("d-m-Y").$earliest_check_in) ),
					    'latest_check_in'	=>	date( "H:i:s", strtotime(date("d-m-Y").$latest_check_in) ),
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
						  'description'	=>	$description,
						  'brief_introduction' => $brief_introduction,
						  'direction'	=> 	$direction,
						  'location'	=> 	$location,
						  'things_to_note' => 	$things_to_note,
						  'hear_about_id'  => 	$hear_about_id
						  );
		      
			 
			 if(isset($_FILES['propertyfiles']) and count($_FILES['propertyfiles'])>0){
			     
			     $this->load->library('image_lib');
			     $img_arr =array();
			     $image_insert_arr=array();
			     foreach($_FILES['propertyfiles']['tmp_name'] as $index=>$file){
				if($_FILES['propertyfiles']['error'][$index]==0){
					$tmp_name 	= $file;
					$file_name 	= $_FILES['propertyfiles']['name'][$index];
					$path_info_arr 	= pathinfo($file_name);
					$ext 		= '';
					if(is_array($path_info_arr) and count($path_info_arr)>0){
					    $ext = $path_info_arr['extension'];
					}
					$new_file_name  = $property_slug.'-'.time();
					$img_arr [] = $new_file_name;
					if(in_array($new_file_name,$img_arr)){
					    $new_file_name .= count($img_arr)+1;
					}
					
					if($ext!=''){
					    $config 	= array(
						       'image_library' 	=> 'GD2',
						       'source_image'		=> $tmp_name,
						       'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/big/'.$new_file_name.'.'.$ext
						   );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					    
					    $config 	= array(
								'image_library' 	=> 'GD2',
								'source_image'		=> $tmp_name,
								'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/small/'.$new_file_name.'.'.$ext,
								'create_thumb'		=> true,
								'width'		=> '400'
								
							    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					    
					    $config 	= array(
								'image_library' 	=> 'GD2',
								'source_image'		=> $tmp_name,
								'new_image'		=> FILE_UPLOAD_ABSOLUTE_PATH.'property/thumb/'.$new_file_name.'.'.$ext,
								'create_thumb'		=> true,
								'width'		=> '150',
								'height'		=> '150'
							    );
					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
					    $this->image_lib->clear();
					    
					    $image_insert_arr[] = array('image_name'	=>	$new_file_name.'.'.$ext	);
					}
				}
			     }
			 }
			 
			 $new_property_id = $this->model_basic->insertIntoTable( PROPERTY_MASTER, $property_master_data); // MASTER DATA
			 
			 $property_details['property_id'] = $new_property_id;
			 $last_details_id = $this->model_basic->insertIntoTable( PROPERTY_DETAILS, $property_details); // DETAILS DATA
			 
			 if(is_array($property_facilities) and count($property_facilities)>0){  // FACILITY DATA
			     foreach($property_facilities as $index=>$facility){
				 $facility_arr = array(
							 'property_id'		=> $new_property_id,
							 'facility_master_id'	=> $facility
						       );
				 $this->model_basic->insertIntoTable( PROPERTY_FACILITIES, $facility_arr);
			     }
			 }
			 
			 if(is_array($property_policy) and count($property_policy)>0){  // POLICY DATA
			     foreach($property_policy as $index=>$policy){
				 $policy_arr = array(
							 'property_id'		=> $new_property_id,
							 'policy_master_id'	=> $policy
						       );
				 $this->model_basic->insertIntoTable( PROPERTY_POLICIES , $policy_arr);
			     }
			 }
			 
			 if(is_array($image_insert_arr) and count($image_insert_arr)>0){   // IMAGE DATA
			     foreach($image_insert_arr as $index=>$image){
				 $image['property_id'] = $new_property_id;
				 $this->model_basic->insertIntoTable( PROPERTY_IMAGE , $image);
			     }
			 }
			 
			 $this->nsession->userdata('succmsg','Property is added successfully');
			 redirect('hostelsignup/success');			
			   
			}
		}
		$this->templatelayout->make_seo();
		$this->templatelayout->get_footer(); 
		$this->elements['middle']	='hostelsignup/step1';			
		$this->elements_data['middle'] 	= $this->data; 
		$this->layout->setLayout('general_layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function ajaxCityList(){
	   $pro_id = $this->input->post('pro_id');
	   $city=array();
	   $city_list = $this->model_basic->getValues_conditions($this->cityMaster,array('city_master_id','city_name'),'',' province_id="'.$pro_id.'" and status="Active"');
	   //pr($city_list);
	   if(is_array($city_list) and count($city_list)>0){
	     $city = $city_list;
	     
	   }
	   echo json_encode($city);
	   exit;
	}
	
	public function success(){
		echo "property added successfully";
	}
	
}