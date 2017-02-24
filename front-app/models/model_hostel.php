<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_hostel extends CI_Model
{
		
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getFeaturedHostel()
	{
		$sql = "SELECT PT.property_type_slug,PP.province_slug,PC.city_slug,PM.property_master_id, PM.property_name, PM.property_slug, PD.description, PI.image_name
			FROM ".PROPERTY_MASTER." AS PM
			LEFT JOIN  ".PROPERTY_TYPE." AS PT ON PM.property_type_id=PT.property_type_id
			LEFT JOIN ".PROPERTY_DETAILS." AS PD ON PM.property_master_id = PD.property_id
			LEFT JOIN ".PROPERTY_IMAGE." AS PI ON PM.property_master_id = PI.property_id
			LEFT JOIN ".PROVINCE_MASTER." AS PP ON PP.province_id=PD.province_id
			LEFT JOIN ".CITY." AS PC ON PC.city_master_id=PD.city_id
			WHERE PM.is_featured = 'Yes'
			AND PM.status = 'Active'
			AND PI.featured_image = 'Yes'"
			;
		//echo $sql;
		$rec = FALSE;
		$rs = $this->db->query($sql);
		if($rs->num_rows()) {
				$rec = $rs->result_array();
		}else{
		    $rec = FALSE;
		}
		//pr($rec);
		return $rec;
	}
	
	
	
}