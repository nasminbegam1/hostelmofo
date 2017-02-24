<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_booking_list extends CI_Model
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;
	var $propertyMaster	= PROPERTY_MASTER;
	var $contactMaster	= CONTACT;
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getList($property_id)
	{
		$where	= ' WHERE PI.property_id='.$property_id.' AND booking_status="Booked" AND PM.agent_id = '.$this->current_user['agent_id'];
		$sql = "SELECT PM.property_name,PI.*,BK.*,RM.type_name,SUM(BK.total_price) as total_price,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,RM.size, PI.gender as gen
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id DESC";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	
	public function getCancelList($property_id)
	{
		$where	= ' WHERE PI.property_id='.$property_id.' AND booking_status="Cancelled" AND PM.agent_id = '.$this->current_user['agent_id'];

		//$sql = "SELECT PM.property_name,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,PI.*,BK.*,RM.roomtype_name,RM.number_of_bed,SUM(BK.total_price) as total_price
		//	FROM ".PAYMENT_INFO." AS PI 
		//	INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		//	INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		//	JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type 
		//	".$where."
		//	GROUP BY PI.paymeny_id
		//	ORDER BY PI.paymeny_id";
			
		$sql = "SELECT PM.property_name,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,PI.*,BK.*,ART.type_name,PI.gender as gen
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id
			JOIN ".AGENT_ROOMTYPE." AS ART ON ART.id = BK.room_type
			WHERE PI.property_id=".$property_id." AND PM.agent_id = ".$this->current_user['agent_id']." AND booking_status='Cancelled'
			GROUP BY PI.paymeny_id ORDER BY PI.paymeny_id";
			
	
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	public function getArrivalList(&$config,&$start)
	{
		
	}
	
	
	public function getBooking($peyment_id){
		if (!$peyment_id) return false;
		
		$where	= ' WHERE PM.agent_id = '.$this->current_user['agent_id']." AND PI.paymeny_id=".$peyment_id;
		
		$sql = "SELECT PI.paymeny_id,PI.*,BK.*,RM.roomtype_name,BK.total_price,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,COUN.countryName, PI.added_date booked_date
		,PM.property_name, PM.service_fees , PI.added_date booked_date
			FROM ".PAYMENT_INFO." AS PI
			LEFT JOIN hw_countries AS COUN ON COUN.idCountry = PI.nationality
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type 
			".$where;
		
		$rs = $this->db->query($sql);		
		$rec = false;		
		if($rs->num_rows())
			$rec = $rs->result_array();
		//pr($rec);      
		return $rec;
		
	}
	
	public function cancelBooking()
	{
		
		$id = $this->uri->segment(3,0);
		$sql = "UPDATE ".PAYMENT_INFO." SET booking_status = 'Cancelled', cancel_date = '".date('Y-m-d H:i:s')."' WHERE paymeny_id=".$id;
		$this->db->query($sql);
		return true;
	}
	
	public function arrival_list($property_id)
	{
		$currentUser = $this->current_user['agent_id'];
		$currentDate = date('Y-m-d');
		 $booking_status = 'Booked';
		//$roomType = ;
		 $sql = "SELECT PI.paymeny_id,PI.*,BK.*,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,RM.*,PI.gender as gen
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
		WHERE PM.agent_id ='".$currentUser."' AND PI.check_in='".$currentDate."' AND PI.Booking_status='".$booking_status."' AND PI.property_id=".$property_id; 
	  
		$rs = $this->db->query($sql);		
		$rec = false;		
		$rec['todayArrival'] = '';
		$rec['tomorrowDate'] = '';
		if($rs->num_rows())
			$rec['todayArrival'] = $rs->result_array();
	
	
		$currentUser = $this->current_user['agent_id'];
		$currentDate = date('Y-m-d');

		$date = strtotime($currentDate);
		$date = strtotime("+1 day", $date);
		$tomorrowDate = date('Y-m-d', $date);
		$booking_status = 'Booked';
		$sql = "SELECT PI.*,BK.*,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,RM.*
			FROM ".PAYMENT_INFO." AS PI
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 

			WHERE PM.agent_id ='".$currentUser."' AND PI.check_in='".$tomorrowDate."' AND PI.Booking_status='".$booking_status."'AND PI.property_id=".$property_id;  


		$rs = $this->db->query($sql);		
		if($rs->num_rows())
			$rec['tomorrowDate'] = $rs->result_array();
		return $rec;	
	}

	public function veiw_booking($id){
		
		//$sql = "SELECT PM.property_name,PM.service_fees,PM.deposite_amount,PM.phone_no,PI.*,BK.*,RM.roomtype_name,BK.total_price,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,COUN.countryName, PI.added_date booked_date
		//FROM ".PAYMENT_INFO." AS PI
		//LEFT JOIN hw_countries AS COUN ON COUN.idCountry = PI.nationality
		//INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		//INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		//JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type WHERE PI.paymeny_id =".$id;
		
		
		$sql = "SELECT PM.property_name,PM.service_fees,PM.deposite_amount,PM.phone_no,PI.*,PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,COUN.countryName, PI.added_date booked_date, BK.*,ART.*
		FROM ".PAYMENT_INFO." AS PI
		LEFT JOIN hw_countries AS COUN ON COUN.idCountry = PI.nationality
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id
		JOIN ".AGENT_ROOMTYPE." AS ART ON ART.id = BK.room_type
		WHERE PI.paymeny_id =".$id;
		 
		 
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$rec = $rs->result_array();
			return $rec;
		} 	
	}
	
	

	public function deal_view($id){


		$sql = "SELECT PM.property_name,PM.service_fees,PM.deposite_amount,PM.phone_no,PI.*,
		PM.reference_id propertyRefNo,PI.reference_id paymentRefNo,
		COUN.countryName, PI.added_date booked_date,SUM(BK.no_of_person) as sass
		 FROM ".PAYMENT_INFO." AS PI
		LEFT JOIN hw_countries AS COUN ON COUN.idCountry = PI.nationality
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".BOOKING." AS BK ON PI.paymeny_id = BK.payment_id
	    WHERE PI.paymeny_id =".$id; 
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$rec = $rs->result_array();

		}	
		$sql = " SELECT AR.type_name, BK.total_price,BK.no_of_person

		FROM ".AGENT_ROOMTYPE." AS AR JOIN ".BOOKING." AS BK ON AR.id = BK.room_type

		WHERE BK.payment_id =" .$id;

		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$rec['roomName'] = $rs->result_array();

			//pr($rec);


			return $rec;
		} 	
			
	}
	
	
	
	
	
	
	
	public function get_property_name($property_id){
		$rec = '';
		$res['property_name'] = '';
		$sql = "SELECT property_name FROM ".PROPERTY_MASTER." WHERE property_master_id=".$property_id."";
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
				$property_name = $rs->row_array();
				$res['property_name'] = $property_name['property_name'];
		}
		$sql = "SELECT COUNT(*) AS totalBooking FROM ".PAYMENT_INFO." PI WHERE PI.property_id = ".$property_id." AND PI.view='N'AND Booking_status='Booked'";
		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$totalBooking = $rs->row_array();
			$res['totalBooking'] = $totalBooking['totalBooking'];
		}
		//$sql = "SELECT PM.*, PI.* FROM ".PAYMENT_INFO. " PI
		//		INNER JOIN ".PROPERTY_MASTER." PM ON  PM.property_master_id=PI.property_id WHERE PI.Booking_status='Booked'
		//		AND PM.property_master_id='".$property_id."'";
		//echo $sql2; die();
		//$rs = $this->db->query($sql);
		//$res['bookingDetails'] = $rs->result_array();
		
		//pr($property_name);
		$sql = "SELECT
		if(SUM(value_for_money) != '',round(((SUM(value_for_money)/(COUNT(feedback_id)*5))*100)),0) value_for_money,
		if(SUM(security) != '',round(((SUM(security)/(COUNT(feedback_id)*5))*100)),0) security,
		if(SUM(location) != '',round(((SUM(location)/(COUNT(feedback_id)*5))*100)),0) location,
		if(SUM(staff) != '',round(((SUM(staff)/(COUNT(feedback_id)*5))*100)),0) staff,
		if(SUM(atmosphere) != '',round(((SUM(atmosphere)/(COUNT(feedback_id)*5))*100)),0) atmosphere,
		if(SUM(cleanliness) != '',round(((SUM(cleanliness)/(COUNT(feedback_id)*5))*100)),0) cleanliness,
		if(SUM(facilities) != '',round(((SUM(facilities)/(COUNT(feedback_id)*5))*100)),0) facilities
		FROM ".FEEDBACK." WHERE property_id=".$property_id."";
		$rs = $this->db->query($sql);
		$res['rating'] = $rs->row_array();
		return $res;
		//pr($res);
	}

}


      