<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Model_cron extends CI_Model
{
	
	public function email()
	{

		
	   $currentDate = date('Y-m-d');

		$date = strtotime($currentDate);
		$date = strtotime("-1 day", $date);

		$yesterDate = date('Y-m-d', $date);

		$sql = "SELECT PM.property_name,PI.first_name,PI.last_name,PI.email,PI.property_id,PM.property_master_id,PI.paymeny_id
		FROM ".PAYMENT_INFO." AS PI 
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		WHERE PI.check_out ='".$yesterDate."'"; 


		$getData = $this->db->query($sql);	

			if($getData->num_rows())
			{
			   return  $getDatai = $getData->result_array(); 
				
			 //pr($getDatai);

			
		    }
	}
}


?>