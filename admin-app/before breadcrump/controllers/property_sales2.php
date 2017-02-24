<?php

class Property_sales2 extends CI_Controller{
    
    var $propertyImageTable		= 'lp_property_image';
    var $floorplanimage			= 'lp_floor_plans';
    
    public function __construct(){
        parent:: __construct();
        
    }
    
    public function index()
    {
        chk_login();
        redirect(base_url('property_sales2/property_image'));
    }
    
    /************ Edit Property Image **************************/
    
    public function property_image()
    {
         chk_login();
        $this->data='';
	
	$property_id			= $this->uri->segment(3, 0);
	$page				= $this->uri->segment(4, 0);
	$this->data['page']		= $page;
	$this->data['property_id']	= $property_id;
	$this->data['controller']	= "property_sales";
	
	// Prepare Data
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition,'image_order,property_image_id', 'ASC' );
	
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'property image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/edit_property_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    public function floorplan_image()
    {
         chk_login();
        $this->data='';
	
	$property_id			= $this->uri->segment(3, 0);
	$page				= $this->uri->segment(4, 0);
	$this->data['page']		= $page;
	$this->data['property_id']	= $property_id;
	$this->data['controller']	= "property_sales";
	
	// Prepare Data
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition,'image_order,property_image_id', 'ASC' );
	
	$Condition = " property_id = '".$property_id."'";
	$this->data['arr_property_image'] = $this->model_basic->getValues_conditions($this->floorplanimage, '*', '', $Condition,'image_order,floor_plan_id', 'ASC' );
		
	$this->data['tabs'] = $this->load->view('sales_tab',array('select_tab'=>'property image'),true);
	
	$this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('succmsg', "");
	$this->nsession->set_userdata('errmsg', "");
		
	
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='sales/edit_floorplan_image';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function do_image_upload()
	{
		chk_login();
		$output_dir = FILE_UPLOAD_ABSOLUTE_PATH. "property/";
		if(isset($_FILES["myfile"]))
		{
			
			$ret = array();
			$error = $_FILES["myfile"]["error"];
			{
				$fileCount = count($_FILES["myfile"]['name']);
				for($i=0; $i < $fileCount; $i++)
				{
					
					//****************** file name formatting area*************************
					
					$file_name = $_FILES["myfile"]["name"][$i];
					$rest_string_after_dot = strrchr($file_name, '.' );
					
					$last_dot_position =  strrpos($file_name,".");
					 $just_file_name = substr($file_name,0,$last_dot_position);
										
					$just_file_ext = substr($rest_string_after_dot,1);//////////////
					//step 2
					
										
					$random_text = rand();
					$final_random_text = substr($random_text,0,5);
					
					$fileName = $just_file_name."_".$final_random_text.'.'.$just_file_ext;
					
					// ****************file name formating area ends**************************
					//$fileName = rand()."_".$_FILES["myfile"]["name"][$i];
					//$ret[$fileName]= $output_dir.$fileName; //$ret[$fileName] = $fileName;
					
					move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
					
					/*** create thumbanil ***/
					$source_image 	= $output_dir.$fileName;
					
					/*** for 591*393 ***/
					$new_big_image	= $output_dir."big/".$fileName;
					$big_width		= '591';
					$big_height		= '393';
					image_thumbnail($source_image, $new_big_image, $big_width, $big_height);
					
					/*** for 116*126 ***/
					//$new_list_image	= $output_dir."list/".$fileName;
					//$list_width	= '150';
					//$list_height	= '140';
					//image_thumbnail($source_image, $new_list_image, $list_width, $list_height, FALSE);
					
					/*** for 53*40 ***/
					$new_small_image	= $output_dir."small/".$fileName;
					$small_width		= '53';
					$small_height		= '40';
					image_thumbnail($source_image, $new_small_image, $small_width, $small_height,FALSE);
					
					$ret = $fileName;
				}
			}
			
			
			echo json_encode($ret);
		}
    }
    
    public function add_property_image(){
	$data = array();
	
	if($this->input->post('property_id')!=''){
	    
	    $is_active_exist = $this->model_basic->getValue_condition($this->propertyImageTable, 'is_featured', 'is_featured', 'is_featured = "Yes" AND property_id='.$this->input->post('property_id'));
	    
	    $max_order = $this->model_basic->getValue_condition($this->propertyImageTable, 'max(image_order)', 'max_order', ' property_id='.$this->input->post('property_id'));
	    $order = $max_order + 1;
	    
	    $feature = 'No';
	    if($is_featured_exist == ''){
		$feature = 'Yes';
	    }
	    $image_name = mysql_real_escape_string($this->input->post('image_name'));
	    $insertPropertyImageArr = array(
					    'property_id' 	=> mysql_real_escape_string($this->input->post('property_id')),
					    'image_file_name'	=> $image_name,
					    'is_feature'	=> $feature,
					    'image_order'	=> $order,
					    
					    );

	  $insert_id =  $this->model_basic->insertIntoTable($this->floorplanimage,$insertPropertyImageArr);
	  
	  if($insert_id){
	    $data['val']['property_image_id'] = $insert_id;
	    $data['val']['image_file_name'] = $image_name;
	    $data['val']['image_order'] = $order;
	    $data['val']['is_feature'] = $feature;
	    
	    echo $newly_added = $this->load->view('sales/addnew_image',$data,true);
	    
	  }
	}
	
    }
    
    public function add_floorplan_image(){
	$data = array();
	
	if($this->input->post('property_id')!=''){
	    
	    $is_active_exist = $this->model_basic->getValue_condition($this->floorplanimage, 'is_active', 'is_active', 'is_active = 1 AND property_id='.$this->input->post('property_id'));
	    
	    $max_order = $this->model_basic->getValue_condition($this->floorplanimage, 'max(image_order)', 'max_order', ' property_id='.$this->input->post('property_id'));
	    $order = $max_order + 1;
	    
	    $feature = 0;
	    if($is_active_exist == ''){
		$feature = 1;
	    }
	    $image_name = mysql_real_escape_string($this->input->post('image_name'));
	    $insertPropertyImageArr = array(
					    'property_id' 	=> mysql_real_escape_string($this->input->post('property_id')),
					    'image_file_name'	=> $image_name,
					    'image_order'	=> $order,
					    'is_active'	=> $feature
					    );

	  $insert_id =  $this->model_basic->insertIntoTable($this->floorplanimage,$insertPropertyImageArr);
	  
	  if($insert_id){
	    $data['val']['floor_plan_id'] = $insert_id;
	    $data['val']['image_file_name'] = $image_name;
	    $data['val']['image_order'] = $order;
	    $data['val']['is_active'] = $feature;
	    
	    echo $newly_added = $this->load->view('sales/addnew_floorplan_image',$data,true);
	    
	  }
	}
	
    }
    
    function change_floorplan_status(){
	if($this->input->post('property_id')!=''){
	    $property_id = $this->input->post('property_id');
	    $status = $this->input->post('status');
	    echo $this->model_basic->updateIntoTable($this->floorplanimage, array('property_id'=>$property_id), array('is_active'=>$status));
	}
    }
    
    public function update_image_data(){
	if($this->input->post('property_image_id')!=''){
	    $image_property_id = mysql_real_escape_string($this->input->post('property_image_id'));
	    $updateArr = array(
			       "image_alt" => mysql_real_escape_string($this->input->post('alt')),
			       "image_caption" => mysql_real_escape_string($this->input->post('caption')),
			       "image_order" => mysql_real_escape_string($this->input->post('order')),
			       );
	    $idArr = array(
			   'property_image_id' => $image_property_id
			   );
	    echo $this->model_basic->updateIntoTable($this->propertyImageTable, $idArr, $updateArr);
	}

	
    }
    
    public function set_feature_image(){
	if($this->input->post()){
	    // set all none
	    $image_id = $this->input->post('property_image_id');
	     $property_id = $this->model_basic->getValue_condition($this->propertyImageTable, 'property_id', 'property_id', 'property_image_id='.$image_id);
	    
	     $updateArr = array(
			       "is_featured" => 'No',
			       );
	    $idArr = array(
			   'property_id' => $property_id
			   
			   );
	    $this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_id' => $property_id ), array( "is_featured" => 'No'));
	    $this->model_basic->updateIntoTable($this->propertyImageTable, array( 'property_image_id' => $image_id ), array( "is_featured" => 'Yes'));
	}
    }
    
    public function delete_property_image()
	{
		chk_login();
		
		$property_image_id	= $this->input->get_post('property_image_id');
		
		$Condition 		= " property_image_id = '".$property_image_id."'";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->propertyImageTable, '*', '', $Condition);
		$prev_image_name	= $arr_property_image[0]['image_file_name'];
		
		if($prev_image_name != '')
		{
			/*** Delete Image from Server ***/
			if(file_exists(file_upload_absolute_path().'property/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name));
			}
		}
		
		$delete_where	= "property_image_id = '".$property_image_id."' ";
		$this->model_basic->deleteData($this->propertyImageTable, $delete_where);
		return true;
    }
    
     public function delete_floorplan_image()
	{
		chk_login();
		
		$floor_plan_id	= $this->input->get_post('floor_plan_id');
		
		$Condition 		= " floor_plan_id = '".$floor_plan_id."'";
		$arr_property_image	= $this->model_basic->getValues_conditions($this->floorplanimage, '*', '', $Condition);
		$prev_image_name	= $arr_property_image[0]['image_file_name'];
		
		if($prev_image_name != '')
		{
			/*** Delete Image from Server ***/
			if(file_exists(file_upload_absolute_path().'property/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/big/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/list/'.stripslashes($prev_image_name));
			}
			
			if(file_exists(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name)) && stripslashes($prev_image_name) != "")
			{
				unlink(file_upload_absolute_path().'property/small/'.stripslashes($prev_image_name));
			}
		}
		
		$delete_where	= "floor_plan_id = '".$floor_plan_id."' ";
		echo $this->model_basic->deleteData($this->floorplanimage, $delete_where);
		return true;
    }
    
    public function set_active_floorplan_image(){
	if($this->input->post()){
	    // set all none
	    $image_id = $this->input->post('floor_plan_id');
	     $property_id = $this->model_basic->getValue_condition($this->floorplanimage, 'property_id', 'property_id', 'floor_plan_id='.$image_id);
	    
	     $updateArr = array(
			       "is_active" => 0,
			       );
	    $idArr = array(
			   'property_id' => $property_id
			   
			   );
	    $this->model_basic->updateIntoTable($this->floorplanimage, array( 'property_id' => $property_id ), array( "is_active" => 0));
	    $this->model_basic->updateIntoTable($this->floorplanimage, array( 'floor_plan_id' => $image_id ), array( "is_active" => 1));
	}
    }
    
    public function update_floorplan_image_data(){
    if($this->input->post('floor_plan_id')!=''){
	$floor_plan_id = mysql_real_escape_string($this->input->post('floor_plan_id'));
	$updateArr = array(
			   "image_alt" => mysql_real_escape_string($this->input->post('alt')),
			   "image_caption" => mysql_real_escape_string($this->input->post('caption')),
			   "image_order" => mysql_real_escape_string($this->input->post('order')),
			   );
	$idArr = array(
		       'floor_plan_id' => $floor_plan_id
		       );
	echo $this->model_basic->updateIntoTable($this->floorplanimage, $idArr, $updateArr);
    }
    
    }
    
	
    

    
}
?>