<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_distance extends CI_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_property');		
	}
		
	public function index()
	{
		$this->data['starting_val']	=	$this->uri->segment(2,0);
		$this->data['ending_val']	=	$this->uri->segment(3,0);		
		$fields[0]			=	'property_id';
		$fields[1]			=	'latitude';
		$fields[2]			=	'longitude';
		$property_list			=	$this->model_basic->getValues_conditions('lp_property_master',$fields);
		$data_list			=	array();
		$cnt				=	0;		
		foreach($property_list as $v){
			
			$result						=	$this->get_map($v['property_id'],$v['latitude'],$v['longitude']);
			if($result != 0)
			{
				$data_list[$cnt]['map_details'] 	= 	$result;
				$data_list[$cnt]['property_id'] 	= 	$v['property_id'];
				$cnt++;
			}
		}
		$this->data['map_list']		=	$data_list;
		$this->data['view']		=	1;
		$this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
		$this->elements['middle']	=	'google_distance/google_cron';			
		$this->elements_data['middle'] 	= 	$this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	
	public function get_map($property_id,$lat,$long)
	{
		$property_id		=	$property_id;
		$data['option']		=	0;		
		$destination_arr	=	array();
		$latitude_arr		=	array();
		$longitude_arr		=	array();
		$shopping_arr		= 	array();
		$fields[0]		=	'id';
		$fields[1]		=	'location_name';
		$fields[2]		=	'latitude';
		$fields[3]		=	'longitude';
		$fields[4]		=	'location_type';
		
		$overide_arr		=	array();
		$overide_arr		=	$this->model_basic->getValues_conditions('lp_override_map_location' ,'',''," `status` = 'Active' AND `property_id` = '".$property_id."'",'','','');		
		$location_id		=	$this->model_basic->getValue_condition('lp_property_master','location_id','',"`property_id` = '".$property_id."'");		
		$map_details		= 	$this->model_basic->getValues_conditions('lp_property_map_location' ,$fields,''," `location_id` = '".$location_id."'",' location_type','','');
		$data['origin'][0] 	= 	"Beaches";		
		$j			=	0;
		if(is_array($map_details))
		{
			foreach($map_details as $k=>$v)
			{
				$latitude_arr[$k]		=	$v['latitude'];
				$longitude_arr[$k]		=	$v['longitude'];
				$destination_arr[$k]		=	$v['location_name'];			
			}			
			if(isset($overide_arr) && is_array($overide_arr) && count($overide_arr)>0)
			{	
				foreach($map_details as $x=>$v)
				{
					foreach($overide_arr as $u){
						if($u['map_location_id'] == $v['id'])
						{
							$latitude_arr[$x]		=	$u['latitude'];
							$longitude_arr[$x]		=	$u['longitude'];
						}
					}
				}
			}
			$data['destination']		=	$destination_arr;
			$data['latitude_arr']		=	$latitude_arr;
			$data['longitude_arr']		=	$longitude_arr;
			$data['lat']			=	$lat;
			$data['long']			=	$long;			
			return $data;
		}
		else
			return 0;
	}	
	
	
	public function database_store()
	{
		$final_result	= $this->input->post('final_result');
		$starting_val	= $this->input->post('starting_val');
		$ending_val	= $this->input->post('ending_val');
		$total_record	= $this->input->post('total_record');
		$remainder	= $this->input->post('remainder');
		//pr($final_result,1);
		if($starting_val == 0)
		{
			$this->model_property->empty_distance();
		}		
		foreach($final_result as $k=>$v)
		{
			$arr		=	explode('--',$v);
			$distance	=	0;
			$where		=	"`property_id`	= '".$arr[0]."'";			
			$last 		= 	substr($arr[1], -2);
			if($last	==	'km')
			{
				$distance	=	str_replace(' km','',$arr[1]);
			}
			elseif($last	==	' m')
			{
				$distance	=	str_replace(' m','',$arr[1]);
				$distance	=	$distance/1000;
			}
			else
			{
				$distance	=	0;
			}
			//echo $distance."<br>";
			$idArr 		= array(
							'property_id'	=> $arr[0]
						);
					
			$updateArr 	= array(
							'distance_to_beach'	=> $distance
						);				
			$this->model_basic->updateIntoTable("lp_property_master", $idArr, $updateArr);
		}
		
		
		if($ending_val < $total_record)
		{		
			if(($total_record-$ending_val)	==	$remainder)
			{
				$new_val 	= $ending_val + $remainder;
			}
			else
			{
				$new_val = $ending_val + 100;
			}
			echo BACKEND_URL."google_distance/".$ending_val."/".$new_val;
		}
		else{
			echo 0;
		}
		exit;
	}
	
	
	//for live testing-------------------------------------------------------------------------------------------------
	
	//public function database_store()
	//{
	//	$final_result	= $this->input->post('final_result');
	//	$starting_val	= $this->input->post('starting_val');
	//	$ending_val	= $this->input->post('ending_val');
	//	$total_record	= $this->input->post('total_record');
	//	$remainder	= $this->input->post('remainder');		
	//	if($starting_val == 0)
	//	{
	//		$this->model_basic->deleteData('lp_google_cron',0);
	//	}		
	//	foreach($final_result as $k=>$v)
	//	{
	//		$arr		=	explode('--',$v);			
	//		$where		=	"`property_id`	= '".$arr[0]."'";			
	//		//$idArr 		= array(
	//		//				'property_id'	=> $arr[0]
	//		//			);
	//				
	//		$insertArr 	= array(
	//						'property_id'	=> $arr[0],
	//						'distance'	=> $arr[1]
	//					);
	//			
	//		if($this->model_basic->checkRowExists("lp_google_cron",$where))	
	//			$this->model_basic->insertIntoTable("lp_google_cron",$insertArr);
	//	}		
	//	if($ending_val < $total_record)
	//	{		
	//		if(($total_record-$ending_val)	==	$remainder)
	//		{
	//			$new_val 	= $ending_val + $remainder;
	//		}
	//		else
	//		{
	//			$new_val = $ending_val + 100;
	//		}
	//		echo BACKEND_URL."google_distance/".$ending_val."/".$new_val;
	//	}
	//	exit;
	//}
	
	//-----------------------------------------------------------------------------------------------------------------
} 