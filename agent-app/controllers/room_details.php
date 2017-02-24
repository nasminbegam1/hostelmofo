<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class room_details extends My_Controller
 
  {
        //var $enquiryMaster	= ENQUIRY_MASTER;	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_booking_list');
		$this->load->model('model_basic');
		$this->load->model('model_room_details');
	}


	public function index()
	{
		$this->chk_login();
		$property_id			= $this->uri->segment(3);
		$page 				= $this->uri->segment(4);
		//pr();
		$this->data['tabs'] 		= $this->load->view('room_details/property_tab',
							array(
							      'select_tab'	=>	'roomList',
							      'property_id'	=>	$property_id,
							      'page'		=>	$page
							      ),
							true);
		$propertDtls 			= $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] 	= $this->load->view('property/property_header',
												array('select_tab'	=>	'romeandrates',
												      'property_id'	=> 	$property_id,
												      'propertDtls'	=>	$propertDtls
												      ),
												true);
			
		$config['base_url'] 	= AGENT_URL.currentClass()."/index/".$property_id;
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 4;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		
		if($this->input->get_post('btn_show_all')!=''){
			$this->nsession->unset_userdata('ROOM_LIST');//die('saheb');
			redirect(base_url()."room_details/index/".$property_id);
		}
		$this->data['params'] = $this->nsession->userdata('ROOM_LIST');
	
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == ''){	
			$this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
			$this->data['per_page']		= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
	
		$start 				= 0;
		$page				= $this->uri->segment(4,0);
		$this->data['room_details']	= $this->model_room_details->getList($config,$start,$property_id);

		//pr($this->data['room_details']);
		$this->data['startRecord'] 	= $start;
	       
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= currentClass();	
		$this->data['base_url'] 	= AGENT_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']     	= AGENT_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']     	= AGENT_URL.$this->data['controller']."/add/0/".$page."/";
		$this->data['edit_link']    	= AGENT_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
		$this->data['delete_link']	= AGENT_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";
		$this->data['booking_link']	= AGENT_URL."booking_list/bookings/{{ID}}/".$page."/";
		$this->data['availability_link']= AGENT_URL.$this->data['controller']."/availability/{{ID}}/".date('Y')."/";
			

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
			$brd_arr[] 		= array('link'=>base_url('property'), 'text' => 'Property','icon_class'=>'icon-briefcase' );
			$brd_arr[] 		= array('link'=>'javascript:void(0);', 'text' => 'Room List' );
		
		$this->data['breadcrumbs'] 	= $brd_arr;
		//........................
		$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
			$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');		
			$this->nsession->set_userdata('succmsg', "");		
			$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_header();
			$this->templatelayout->get_footer();
			$this->templatelayout->get_sidebar('property');
		$this->elements['middle']	='room_details/list';			
		$this->elements_data['middle']	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    
	}


	public function add(){

		$this->chk_login();
		$property_id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$this->data['room_type'] = $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,array('roomtype_id','roomtype_name'),'','roomtype_status="Active"','roomtype_name');
		//pr($data['room_type']);
	
		$this->data['propertyId'] = $property_id;
		$this->data['tabs'] = $this->load->view('room_details/property_tab',array('select_tab'=>'aditList','property_id'=>$property_id,'page'=>$page),true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] = $this->load->view('property/property_header',
									    array('select_tab'=>'AddRoom',
										  'property_id'=> $property_id,
										  'propertDtls'=>$propertDtls),
									    true);
		if($this->input->get_post('action') == 'basic_info')
		{
			$this->form_validation->set_rules('id', 'Basic Type', 'trim|required');
			$this->form_validation->set_rules('size', 'Size', 'trim|required');
			$this->form_validation->set_rules('no_of_rooms', 'Number of room', 'trim|required');
			$this->form_validation->set_rules('room_lable', 'Room Label', 'trim|required');
			$this->form_validation->set_rules('type_name', 'Type Name', 'trim|required');
			$this->form_validation->set_rules('basic_price', 'Basic Price', 'trim|required');
			$this->form_validation->set_rules('ensuite', 'Ensuite', 'trim|required');
			//$this->form_validation->set_rules('charge_type', 'Room Charge Type', 'trim|required');
			$this->form_validation->set_rules('room_description', 'Room Description', 'trim|required');
			
			
			$current= $this->nsession->userdata('current_user');
			$current_date = date('Y-m-d | h:i:s');	 

			if($this->form_validation->run() == true){ 
					
				$agentId 		= $current['agent_id'];
				$typename 		= trim($this->input->get_post('type_name'));
				$no_of_rooms		= trim($this->input->get_post('size'));
				$size 			= trim($this->input->get_post('no_of_rooms'));
				$ensuite 		= trim($this->input->get_post('ensuite'));
				//$charge_type 		= trim($this->input->get_post('charge_type'));
				$room_label 		= trim($this->input->get_post('room_lable'));
				$room_description 	= trim($this->input->get_post('room_description'));
				$id 			= trim($this->input->get_post('id'));
				$roomPriceType		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,array('room_price_type'),'','roomtype_id='.$id);
				
				$property_id 		= trim($this->input->get_post('property_id'));
				$type_name 		= trim($this->input->get_post('type_name'));
				$basic_price		= trim($this->input->get_post('basic_price'));
				$roomArray		= 	array(
									'size'=>$size,
									'no_of_rooms' => $no_of_rooms,
									'ensuite'=>$ensuite,
									//'priceChargeType'=>$charge_type,
									'room_lable'=>$room_label,
									'room_description'=>$room_description,
									'agent_id'=>$agentId,
									'property_id'=>$property_id,
									'room_type_master_id'=>$id,
									'price_charge_type'=> $roomPriceType[0]['room_price_type'],
									'type_name'=>$type_name,
									'added_date'=>$current_date,
									'base_price'=>$basic_price
								);

				$insertData	= $this->model_basic->insertIntoTable(AGENT_ROOMTYPE,$roomArray);
				redirect(AGENT_URL."room_details/index/".$property_id);

			}else{ 
	      			$this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
				redirect(AGENT_URL.'room_details/add/'.$property_id);

			}
		}
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']='room_details/add_list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	

	}
	
	
	/* property edit */
	public function edit(){
		$this->chk_login();
		//$property_id = $this->uri->segment(3);
		$id= $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$this->chk_login();

		$property_id 			= $this->uri->segment(3);
		$page 				= $this->uri->segment(4);
		$this->data['room_type'] 	= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,array('roomtype_id','roomtype_name'),'','roomtype_status="Active"','roomtype_name');
		//$this->data['room_type'] 	= $this->model_basic->getValues_conditions(AGENT_ROOMTYPE,array('id','type_name'),'',"parent_id='0'");
		$this->data['room_details'] 	= $this->model_basic->getValues_conditions(AGENT_ROOMTYPE,
							array('id','type_name','property_id','room_description','room_lable','size','no_of_rooms','ensuite','room_type_master_id','base_price'),'',"id='$id'");
		//pr($this->data['room_details']);

		$propertyId 	= $this->model_basic->getValues_conditions(AGENT_ROOMTYPE,array('property_id'),'',"id='$id'");
		$this->data['tabs'] 		= $this->load->view('room_details/property_tab',
								    array(
										'select_tab'	=>	'bookings',
										'property_id'	=>	$propertyId[0]['property_id'],
										'page'		=>	$page
									),
								true);
		$propertDtls = $this->model_booking_list->get_property_name($property_id);
		$this->data['property_header'] 	= $this->load->view('property/property_header',
									array(
										'select_tab'	=>	'Add Room Type',
										'property_id'	=> 	$propertyId[0]['property_id'],
										'propertDtls'	=>	$propertDtls
									),
								true);

		$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->templatelayout->get_sidebar('booking');
		$this->elements['middle']	='room_details/edit_list';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	

	}
					
	
	public function update(){
		$id= $this->uri->segment(3);
		if($this->input->get_post('action') == 'update'){
			$current= $this->nsession->userdata('current_user');	 
					
			$agentId 		= $current['agent_id'];
			$size 			= trim($this->input->get_post('size'));
			$no_of_rooms    	= trim($this->input->get_post('no_of_rooms'));
			$ensuite 		= trim($this->input->get_post('ensuite'));
			$room_label 		= trim($this->input->get_post('room_lable'));
			$room_description 	= trim($this->input->get_post('room_description'));
			$id 			= trim($this->input->get_post('room_id'));
			$property_id 		= trim($this->input->get_post('property_id'));
			$type_name 		= trim($this->input->get_post('type_name'));
			$basic_price		= trim($this->input->get_post('basic_price'));
			$room_type_master_id	= trim($this->input->get_post('id'));
			$roomPriceType		= $this->model_basic->getValues_conditions(ROOMTYPE_MASTER,array('room_price_type'),'','roomtype_id='.$room_type_master_id);

			$this->form_validation->set_rules('id', 'Basic Type', 'trim|required');
			$this->form_validation->set_rules('size', 'Size', 'trim|required');
			$this->form_validation->set_rules('no_of_rooms', 'Number of Rooms', 'trim|required');
			$this->form_validation->set_rules('room_lable', 'Room Label', 'trim|required');
			$this->form_validation->set_rules('type_name', 'Room Type Name', 'trim|required');
			$this->form_validation->set_rules('basic_price', 'Basic Price', 'trim|required');
			$this->form_validation->set_rules('ensuite', 'Ensuite', 'trim|required');
			$this->form_validation->set_rules('room_description', 'Room Description', 'trim|required');
			//$this->form_validation->set_rules('charge_type', 'Room Charge Type', 'trim|required');
			
			if($this->form_validation->run() == true){ 

				$roomArray	= array(
							'size'			=>	$size,
							'no_of_rooms'           =>      $no_of_rooms,
							'ensuite'		=>	$ensuite,
							'room_lable'		=>	$room_label,
							'room_description'	=>	$room_description,
							'type_name'		=>	$type_name,
							'base_price'		=>	$basic_price,
							'price_charge_type'	=> 	$roomPriceType[0]['room_price_type'],
							'room_type_master_id'	=>	$room_type_master_id
						);
	
				$update 	= $this->model_basic->updateIntoTable(AGENT_ROOMTYPE, array('id' =>$id),$roomArray);
				//$this->db->affected_rows($update);
				//echo $this->db->last_query();exit;
				if($update>0){
					redirect(AGENT_URL."room_details/index/".$property_id);
				}
				else{
					redirect(AGENT_URL.'room_details/edit/'.$id);
				}
			}
			else{ 
	      			$this->nsession->set_userdata('errmsg', preg_replace('/\s+/', ' ',validation_errors('<p>','</p>')));
						redirect(AGENT_URL.'room_details/edit/'.$id);

			}

		}
	}

}
?>