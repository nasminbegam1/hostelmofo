<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_booking extends CI_Model
{
	public function booked()
	{	

		$user_id = $this->nsession->userdata('USER_ID');

     	$book ='Booked';

	 	$sql = "SELECT PM.property_name,PI.property_id,
	 				   PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".USER." AS UM ON PI.user_id = UM.id

		WHERE PI.user_id='".$user_id."' AND PI.Booking_status='".$book."' ORDER BY PI.paymeny_id DESC";
		//echo $sql; die;
		$query = $this->db->query($sql);
			
		if($query->num_rows()>0)
		{
			$record =$query->result_array();
					
			return $record;	
		}



	 }
	 
	 
	 
	public function all_booking()
	{	

		$user_id = $this->nsession->userdata('USER_ID');

     	$book ='Booked';

	 	$sql = "SELECT PM.property_name,PI.property_id,
	 				   PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".USER." AS UM ON PI.user_id = UM.id

		WHERE PI.user_id='".$user_id."' ORDER BY PI.paymeny_id DESC";
		//echo $sql; die;
		$query = $this->db->query($sql);
			
		if($query->num_rows()>0)
		{
			$record =$query->result_array();
					
			return $record;	
		}
	 }
	 
	public function future_booking()
	{	

		$user_id = $this->nsession->userdata('USER_ID');

     	$book ='Booked';

	 	$sql = "SELECT PM.property_name,PI.property_id,
	 				   PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".USER." AS UM ON PI.user_id = UM.id

		WHERE PI.user_id='".$user_id."'  AND PI.Booking_status='".$book."' AND check_in > NOW() ORDER BY PI.paymeny_id DESC";
		//echo $sql; die;
		$query = $this->db->query($sql);
			
		if($query->num_rows()>0)
		{
			$record =$query->result_array();
					
			return $record;	
		}
	}
	
	public function past_booking()
	{	

		$user_id = $this->nsession->userdata('USER_ID');

     	$book ='Booked';

	 	$sql = "SELECT PM.property_name,PI.property_id,
	 				   PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".USER." AS UM ON PI.user_id = UM.id

		WHERE PI.user_id='".$user_id."'  AND PI.Booking_status='".$book."' AND check_in < NOW() ORDER BY PI.paymeny_id DESC";
		//echo $sql; die;
		$query = $this->db->query($sql);
			
		if($query->num_rows()>0)
		{
			$record =$query->result_array();
					
			return $record;	
		}
	}



	public function view($paymeny_id){
	   
		$user_id = $this->nsession->userdata('USER_ID');
		$sql = "SELECT PM.property_name,PI.added_date,PI.check_in,PI.check_out,PI.Booking_status
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		WHERE PI.paymeny_id='".$paymeny_id."'";
		
		$rs = $this->db->query($sql);		
		$rec = false;		
		if($rs->num_rows()){
			$record['property_details'] = $rs->result_array();
			
//******************************************************************************************************************
			//$sql2 = "SELECT PI.Booking_status,PI.currency_name,PI.currency_symbol,PI.currency_rate, PM.beds,PM.room_type,RM.roomtype_name,
			//PI.arrival_time,BK.room_price,BK.total_price,BK.no_of_person FROM ".PAYMENT_INFO." AS PI
			//INNER JOIN ".BOOKING_DETAILS." AS BK ON BK.payment_id = PI.paymeny_id
			//INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			//INNER JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type 
			//WHERE PI.paymeny_id='".$paymeny_id."'";
			
			
			$sql2 = "SELECT PI.Booking_status,PI.currency_name,PI.currency_symbol,PI.currency_rate,BK.room_type, BK.room_price,BK.total_price,BK.no_of_person, ART.type_name,PI.arrival_time FROM ".PAYMENT_INFO." AS PI INNER JOIN ".BOOKING_DETAILS." AS BK ON BK.payment_id = PI.paymeny_id INNER JOIN ".AGENT_ROOMTYPE." AS ART ON ART.id = BK.room_type WHERE PI.paymeny_id='".$paymeny_id."'";
			
			
			$res = $this->db->query($sql2);		
			$rec = false;
			if($rs->num_rows()){
				$record['room_details'] = $res->result_array();
			}
			return $record;
			//pr($record);
		}			
 	}
		
		
		
	public function cancelled(){
		$user_id = $this->nsession->userdata('USER_ID');
		$book ='Cancelled';
		$sql = "SELECT PM.property_name,PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,PI.property_id
			FROM ".PAYMENT_INFO." AS PI
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".USER." AS UM ON PI.user_id = UM.id WHERE PI.user_id='".$user_id."' AND PI.Booking_status='".$book."' ORDER BY PI.paymeny_id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$record =$query->result_array();
			return $record;	
		}
	}	
						

	public function property_cancelled($paymeny_id){
		$user_id = $this->nsession->userdata('USER_ID');
		$sql = "SELECT  PI.payble_amount, PI.Booking_status, PI.paymeny_id, PI.added_date, PI.property_id, PI.currency_rate, PI.booking_type FROM ".PAYMENT_INFO." AS PI INNER JOIN ".USER." AS UM ON PI.user_id = UM.id WHERE PI.paymeny_id= $paymeny_id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$record =$query->result_array();
			return $record;
		}
	}		

							public function update_status($tableName,$statusData,$id)
							{


									$data = array(
									'Booking_status' => $statusData,
									
									);

									$this->db->where('paymeny_id', $id);
									$updateStatus = $this->db->update($tableName, $data); 

									$updateStatus = $this->db->affected_rows();

								    return $updateStatus;

							}


								public function commission()
								{
									$id ='22';

									$this->db->select('*');

									$this->db->where('sitesettings_id',$id);

									$data = $this->db->get(SITESETTINGS);

									return    $dataA = $data->result_array();

								}


							public function send_mail($property_id)
							{
								$record = false;

									 	$sql = "SELECT AD.email_id,PM.property_name
									
									 	FROM ".ADMINUSER." AS AD
									 	INNER JOIN ".PROPERTY_MASTER." AS PM ON AD.admin_id = PM.user_id
									 	where PM.property_master_id=".$property_id;
										$query = $this->db->query($sql);

									 	if($query->num_rows()>0)
									 	{
										 	$record =$query->result_array();
									 									
										 	return $record;	
									 	}

							}	

}

?>