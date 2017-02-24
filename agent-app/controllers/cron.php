<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$property_list	=	$this->model_basic->getValues_conditions('hw_property_master', array('property_master_id','service_fees'),'','', 'service_fees DESC,avarage_rating DESC');
		if(is_array($property_list) && COUNT($property_list)>0)
		{
			$rank		=	1;
			foreach($property_list as $v)
			{
				$this->model_basic->updateIntoTable('hw_property_master', array('property_master_id' => $v['property_master_id']),array('rank' => $rank));
				$rank++;				    
			}
		}
		echo "done";exit;
	}
	
	public function add_in_log()
	{
		$property_list	=	$this->model_basic->getValues_conditions('hw_property_master', array('property_master_id','service_fees','rank'));
		if(is_array($property_list) && COUNT($property_list)>0)
		{
			foreach($property_list as $v)
			{
				$insertArr	=	array(
								'property_id'	=> $v['property_master_id'],
								'rank'		=> $v['rank'],
								'service_fees'	=> $v['service_fees'],
								'added_date'	=> date('Y-m-d H:i:s')					
							);
				$this->model_basic->insertIntoTable('hw_logs',$insertArr);
			}
		}
		echo "hello";exit;
	}
}