<?php
class Model_market extends CI_Model
{	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	public function getServiceFee($property_id)
	{
		$sitesettings_id='22';
		$sql = "SELECT sitesettings_value 
		FROM ".SITESETTINGS."
		WHERE sitesettings_id=".$sitesettings_id;
		$query = $this->db->query($sql);
		if($query->num_rows()){
			$res['sitesettingsValue']	= $query->row_array();
		}
		$sql = "SELECT service_fees FROM ".PROPERTY_MASTER." WHERE property_master_id=".$property_id;
		$query = $this->db->query($sql);
		if($query->num_rows()){
		$res['serviceFee']= $query->row_array();
		}
		
		
		$sql = "SELECT city_id FROM ".PROPERTY_DETAILS." WHERE property_id=".$property_id;
		$query = $this->db->query($sql);
		if($query->num_rows()){
		$res['cityId']= $query->row_array();
		}
		return $res;
	}
	public function getPropertyId($property_id,$cityId)
	{
		$sql = "SELECT PD.property_id,PM.property_name,PM.service_fees FROM ".PROPERTY_DETAILS." AS PD JOIN ".PROPERTY_MASTER." AS PM ON PD.property_id = PM.property_master_id WHERE city_id='".$cityId."' ORDER BY PM.service_fees DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()){
		$res = $query->result_array();
		}
		//pr($res);	
		return $res;
	}		

	public function getMonthList($property_id)
	{
		$sql = "SELECT HPD.city_id
			FROM hw_property_master as HPM
			INNER JOIN hw_property_details as HPD ON HPD.property_id = HPM.property_master_id
			WHERE HPM.property_master_id = ".$property_id."
			";
		$query 	 	= 	$this->db->query($sql);
		$city_id 	= 	$query->result_array();
		$city_id	=	$city_id[0]['city_id'];
		$start_year	=	0;
		$final_arr	=	array();
		$month_arr	=	array();
		$start_month	=	date('n')+1;
		if($start_month == 12)
			$start_year	=	date('Y')+1;
		else
			$start_year	=	date('Y');
		
		$current_index	=	$start_year;	
		$cnt		= 	0;
		$featured_month =	$this->model_basic->getValues_conditions('hw_featured_payment','','','property_id = '.$property_id);
		if(is_array($featured_month) && COUNT($featured_month)>0)
		{
			foreach($featured_month as $v)
			{
				$month_arr[]	= date('n-Y',strtotime($v['month_registerd_for']));
			}
		}
		while($cnt<= 12)
		{
			$sql = "SELECT HFP.id
			FROM hw_property_details as HPD
			INNER JOIN hw_featured_payment as HFP ON HFP.property_id = HPD.property_details_id AND HFP.month_registerd_for = '".$start_year."-".$start_month."-01"."' AND HFP.property_id != ".$property_id."
			WHERE HPD.city_id = ".$city_id."
			";
			$query 	 	= 	$this->db->query($sql);
			$no_of_featured	= 	$query->result_array();
			if(COUNT($no_of_featured) >=3)
				$final_arr[$current_index][$start_month]['is_sold_out']	=	1;
			else
				$final_arr[$current_index][$start_month]['is_sold_out']	=	0;
			
			if(COUNT($no_of_featured) < 2)
				$final_arr[$current_index][$start_month]['more_than_one_remaining']	=	1;
			else
				$final_arr[$current_index][$start_month]['more_than_one_remaining']	=	0;
			
			if(COUNT($no_of_featured) == 2)
				$final_arr[$current_index][$start_month]['is_one_remaining']	=	1;
			else
				$final_arr[$current_index][$start_month]['is_one_remaining']	=	0;
			
			if(COUNT($no_of_featured) < 3)
				$final_arr[$current_index][$start_month]['is_open']	=	1;
			else
				$final_arr[$current_index][$start_month]['is_open']	=	0;
			
			$final_arr[$current_index][$start_month]['month']	=	$start_month;
			$final_arr[$current_index][$start_month]['year']	=	$start_year;
			if(in_array($start_month.'-'.$start_year,$month_arr))
				$final_arr[$current_index][$start_month]['is_subscribe']	=	1;
			else
				$final_arr[$current_index][$start_month]['is_subscribe']	=	0;
			
			if($start_month!= 12)
				$start_month++;
			else
			{
				$start_year++;
				$current_index = $start_year;
				$start_month = 1;
			}	
			$cnt++;
		}
		//pr($final_arr);
		return $final_arr;
	}

	public function getFeatured($property_id)
	{
		$province_id =	$this->model_basic->getValues_conditions('hw_property_details',array('province_id'),'','property_id = '.$property_id);
		$sql 	= "SELECT HPM.property_master_id,HPM.property_name,HPI.image_name,HPI.image_title,HPI.image_alt,HPRM.province_slug,HCM.city_slug,
HPTM.property_type_slug,HPM.property_slug
		FROM hw_property_master as HPM
		INNER JOIN hw_property_details as HPD ON HPD.property_id = HPM.property_master_id AND HPD.province_id =".$province_id[0]['province_id']."
		INNER JOIN hw_province_master as HPRM ON HPRM.province_id = HPD.province_id
		INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
		INNER JOIN hw_property_type_master as HPTM ON HPTM.property_type_id = HPM.property_type_id
		INNER JOIN hw_property_image as HPI ON HPI.property_id = HPM.property_master_id AND HPI.featured_image = 'Yes'
		WHERE HPM.is_featured = 'Yes' LIMIT 3";
		$query 			= $this->db->query($sql);
		$featured_property 	= $query->result_array();
		if(is_array($featured_property) && COUNT($featured_property)>0)
		{
			foreach($featured_property as $k=>$v)
			{
				$image_name = '';
				if(isFileExist(CDN_URL."upload/property/small/",$v['image_name'])>0)
				 $featured_property[$k]['image_name'] = CDN_URL.'upload/property/small/'.$v['image_name'];
				else
				 $featured_property[$k]['image_name'] = FRONTEND_URL.'images/'.'no-img.jpg';
				 
				$sql 	= "SELECT COUNT(*) as no_of_review,SUM(avarage_rating) as avg_rating FROM hw_review_master WHERE property_id = ".$v['property_master_id'];
				$query 	= $this->db->query($sql);
				$res 	= $query->result_array();
				$featured_property[$k]['no_of_review'] = $res[0]['no_of_review'];
				$featured_property[$k]['avg_rating'] = $res[0]['avg_rating'];				
				$property_desc =	$this->model_basic->getValues_conditions('hw_property_details',array('brief_introduction'),'','property_id = '.$v['property_master_id']);
				$featured_property[$k]['brief_introduction'] = $property_desc[0]['brief_introduction'];
				$property_price =	$this->model_basic->getValues_conditions('hw_property_roomprice',array('daily_price'),'','property_id = '.$v['property_master_id'],'daily_price','ASC',1);
				$featured_property[$k]['daily_price'] = $property_price[0]['daily_price'];
			}
		}
		//pr($featured_property);
		return $featured_property;
	}
}