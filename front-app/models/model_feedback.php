<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_feedback extends CI_Model
{

 public function feedback($urlarray)
 {

    $email 				= $urlarray[0];
    $property_master_id = $urlarray[1];
    $paymeny_id			= $urlarray[2];


    $this->db->select('user_id,property_id,email,paymeny_id');
    $this->db->where('md5(email)',$email);
    $this->db->where('md5(paymeny_id)',$paymeny_id);

	$userId = $this->db->get(PAYMENT_INFO);
  
   $id= $userId->result_array();

  
  	return $id;
	}
 
		public function insert_feedback($tableName,$insertArray)
		{


		
				// if($tableName == '')
				// return $flag;

			if($insertArray && is_array($insertArray))
		{
		//pr($insertArray);
			$this->db->insert($tableName, $insertArray);
			//echo $this->db->last_query(); die;
			$flag = $this->db->insert_id(); 

		return $flag;


		}


	}	


}

?>