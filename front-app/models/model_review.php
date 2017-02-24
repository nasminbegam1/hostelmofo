<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_review extends CI_Model
{
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	function getAvarageRating($property_id)
	{
	    $sql = "SELECT avg(`value_for_money`) AS c1,avg(`staff`) AS c2, avg(`facilities`) AS c3, avg(`security`) as c4, avg(`location`) AS c5, avg(`atmosphere`) AS c6, avg(`cleanliness`) AS c7 FROM ".REVIEW_MASTER."  WHERE property_id = '".$property_id."' GROUP BY property_id";
	    
	    $rs = $this->db->query($sql);
	    $rec = '';
	    if($rs->num_rows())
	    {
				$rec = $rs->row_array();		
	    }
	    return $rec;
	}
	
	
	
	
	function getAvgRating($property_id){
		$sql = "SELECT
		F.comments,
		if(F.value_for_money != '',(F.value_for_money),0) value_for_money,
		if(F.security != '',round((F.security)),0) security,
		if(F.location != '',round((F.location)),0) location,
		if(F.staff != '',round((F.staff)),0) staff,
		if(F.atmosphere != '',round((F.atmosphere)),0) atmosphere,
		if(F.cleanliness != '',round((F.cleanliness)),0) cleanliness,
		if(F.facilities != '',round((F.facilities)),0) facilities,
		(F.value_for_money+F.security+F.location+F.staff+F.atmosphere+F.cleanliness+F.facilities)/(7) totalFeedback
		FROM ".FEEDBACK." F
		
		WHERE F.property_id=".$property_id." ORDER BY F.feedback_id ";
	    
		$rs = $this->db->query($sql);
		$rec = array();
		if($rs->num_rows() >0){
		   $rec = $rs->result_array();
			$count = count($rec);
			$value_for_money = $security = $location = $staff = $atmosphere = $cleanliness = $facilities = $total_fb = 0;
			foreach($rec as $r){
				$value_for_money = $value_for_money + $r['value_for_money'];
				$security = $security + $r['security'];
				$location = $location + $r['location'];
				$staff = $staff + $r['staff'];
				$atmosphere = $atmosphere + $r['atmosphere'];
				$cleanliness = $cleanliness + $r['cleanliness'];
				$facilities = $facilities + $r['facilities'];
				$total_fb = $total_fb + $r['totalFeedback'];
			}
			
			$rec['v_f_m'] = $value_for_money/$count;
			$rec['security'] = $security/$count;
			$rec['location'] = $location/$count;
			$rec['staff'] = $staff/$count;
			$rec['atmosphere'] = $atmosphere/$count;
			$rec['cleanliness'] = $cleanliness/$count;
			$rec['facilities'] = $facilities/$count;
			$rec['totalFeedback'] = $total_fb/$count;
			
		}
		//pr($rec);
		return $rec;
	}
	
	//function getAvgRating($property_id){
	//	$sql = "SELECT
	//	PI.first_name,PI.gender,C.countryName,
	//	F.comments,
	//	if(F.value_for_money != '',round(((F.value_for_money/5)*100)),0) value_for_money,
	//	if(F.security != '',round(((F.security/5)*100)),0) security,
	//	if(F.location != '',round(((F.location/5)*100)),0) location,
	//	if(F.staff != '',round(((F.staff/5)*100)),0) staff,
	//	if(F.atmosphere != '',round(((F.atmosphere/5)*100)),0) atmosphere,
	//	if(F.cleanliness != '',round(((F.cleanliness/5)*100)),0) cleanliness,
	//	if(F.facilities != '',round(((F.facilities/5)*100)),0) facilities,
	//	ROUND(((F.value_for_money+F.security+F.location+F.staff+F.atmosphere+F.cleanliness+F.facilities)/(5*7))*100) totalFeedback
	//	FROM ".FEEDBACK." F
	//	LEFT JOIN ".PAYMENT_INFO." PI ON PI.property_id = F.property_id AND PI.user_id=F.user_id AND PI.email=F.email
	//	LEFT JOIN hw_countries C ON C.idCountry = PI.nationality
	//	WHERE F.property_id=".$property_id." ORDER BY F.feedback_id DESC LIMIT 0,1";
	//    
	//	$rs = $this->db->query($sql);
	//	$rec = array();
	//	if($rs->num_rows())
	//	{
	//	    $rec = $rs->row_array();		
	//	}
	//	//pr($rec);
	//	return $rec;
	//}
	
	
	
	
    public function allRatingList($property_id){
		$sql = "SELECT
		PI.first_name,PI.gender,C.countryName,
		F.comments , F.added_on review_datetime , ROUND(((F.value_for_money+F.security+F.location+F.staff+F.atmosphere+F.cleanliness+F.facilities)/(5*7))*100) totalFeedback
		FROM ".FEEDBACK." F
		LEFT JOIN ".PAYMENT_INFO." PI ON PI.property_id = F.property_id AND PI.user_id=F.user_id AND PI.email=F.email
		LEFT JOIN hw_countries C ON C.idCountry = PI.nationality
		WHERE F.property_id=".$property_id." ORDER BY F.feedback_id DESC";
	    
		$rs = $this->db->query($sql);
		$rec = '';
		if($rs->num_rows())
		{
		    $rec = $rs->result_array();		
		}
		return $rec;
	}
	
	
	public function all_review()
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
	 
    
    public function pending_review($user_id='')
    {	
        $book ='Booked';

      $sql = "SELECT 'Pending' AS 'review_type', PM.property_name,PI.property_id,PI.paymeny_id,PI.user_id,PI.reference_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.property_id not in (select HF1.property_id from hw_feedback as HF1 WHERE HF1.user_id = ".$user_id." AND HF1.payment_id = PI.paymeny_id)  AND PI.check_out <= NOW()- INTERVAL 1 DAY AND PI.user_id= ".$user_id." AND PI.Booking_status='".$book."' GROUP BY PI.paymeny_id";
        
        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record =   $query->result_array();  
            return $record;	
        }
        else
            return array();
    }
    
    public function past_review($user_id='')
    {	
        $sql = "SELECT 'Past' AS 'review_type', PM.property_name,PI.property_id,PI.paymeny_id,PI.user_id,PI.reference_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM hw_feedback as HF
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PM.property_master_id = HF.property_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN ".PAYMENT_INFO." AS PI ON PI.property_id = HF.property_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        WHERE PI.property_id in (select HF1.property_id from hw_feedback as HF1 WHERE HF1.user_id = ".$user_id." AND HF1.payment_id = PI.paymeny_id)  AND PI.check_out <= NOW()- INTERVAL 1 DAY AND PI.user_id= ".$user_id." GROUP BY PI.paymeny_id";

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record =   $query->result_array();  
            return $record;	
        }
        else
            return array();
    }

}