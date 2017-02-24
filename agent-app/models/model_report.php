<?php
class Model_report extends CI_Model
{
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	public function getList($property_id,$from,$to){
		$start 	= 0;
		$where	= " WHERE 1 AND HF.property_id=".$property_id."";
		
		if($from != '' && $to == ''){
			$where .= " AND (DATE_FORMAT(HF.added_on,'%Y-%m-%d')  > '".$from."')";
		}else if($from == '' && $to != ''){
			$where .= " AND (DATE_FORMAT(HF.added_on,'%Y-%m-%d')  < '".$to."')";
		}else if($from != '' && $to != ''){
			$where .= " AND (DATE_FORMAT(HF.added_on,'%Y-%m-%d') between '".$from."' AND '".$to."')";
		}
		
		$sql = "SELECT HF.*,HP.reference_id,HC.countryName,ROUND(((HF.value_for_money+HF.security+HF.location+HF.staff+HF.atmosphere+HF.cleanliness+HF.facilities)/(5*7))*100) totalFeedback
			FROM ".FEEDBACK." as HF
			LEFT JOIN ".PAYMENT_INFO." as HP ON HF.payment_id = HP.paymeny_id
			LEFT JOIN hw_countries as HC ON HP.nationality = HC.idCountry 
			".$where."";
		//echo $sql;
		$query=$this->db->query($sql);

		$report_list	= $query->result_array();
		//pr($report_list);
					          
		return $report_list;
		
	}

	public function getRating($property_id,$from,$to)
	{
		$where = '';
		if($from != '' && $to == ''){
			$where= " AND (DATE_FORMAT(F.added_on,'%Y-%m-%d')  > '".$from."')";
		}else if($from == '' && $to != ''){
			$where= " AND (DATE_FORMAT(F.added_on,'%Y-%m-%d')  < '".$to."')";
		}else if($from != '' && $to != ''){
			$where= " AND (DATE_FORMAT(F.added_on,'%Y-%m-%d') between '".$from."' AND '".$to."')";
		}
		
		$sql = "SELECT COUNT(*) customer_review,ROUND(((SUM(F.value_for_money)+SUM(F.security)+SUM(F.location)+SUM(F.staff)+SUM(F.atmosphere)+SUM(F.cleanliness)+SUM(F.facilities))/(5*7*COUNT(feedback_id)))*100) totalFeedback
		FROM ".FEEDBACK." F WHERE F.property_id=".$property_id." ".$where."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
			$result		= $query->row_array();
		}
		return $result;
	}
			
	public function getCustAnalysis($property_id,$from,$to){
		$where = '';
		if($from != '' && $to == ''){
			$from = $from.' 00:00:00';
			$where= " AND (PI.added_date > '".$from."')";
		}
		if($from == '' && $to != ''){
			$to = $to.' 11:59:59';
			$where= " AND (PI.added_date < '".$to."')";
		}
		if($from != '' && $to != ''){
			$from = $from.' 00:00:00';
			$to = $to.' 11:59:59';
			$where= " AND (PI.added_date between '".$from."' AND '".$to."')";
		}
		$total_booking  = '';
		$result		= false;
		$sql 		= "SELECT PI.nationality,C.countryName,COUNT(PI.paymeny_id) booking FROM ".PAYMENT_INFO." PI INNER JOIN hw_countries C ON PI.nationality=C.idCountry WHERE PI.property_id = ".$property_id." ".$where." GROUP BY C.countryName";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
			$result		= $query->result_array();
			foreach($result as $k=>$r){
				$total_booking 	+= $r['booking'];
				$sql 		= "SELECT ROUND(SUM(DATEDIFF( PI.check_out,PI.check_in)*B.no_of_person)/".$r['booking'].",2) AS day FROM ".PAYMENT_INFO." PI INNER JOIN ".BOOKING." B ON PI.paymeny_id=B.payment_id WHERE PI.nationality = ".$r['nationality']." ".$where." ";
				$query		= $this->db->query($sql);
				$result[$k]['avg_stay']	= $query->row_array();
			}
		}
		$result['total_booking'] = $total_booking;
		return $result;
	}
	public function getSales($property_id,$from,$to,$year){
		$where = '';
		if($from != '' && $to == ''){
			$where= " AND (DATE_FORMAT(added_date,'%Y-%m-%d')  > '".$from."')";
		}else if($from == '' && $to != ''){
			$where= " AND (DATE_FORMAT(added_date,'%Y-%m-%d')  < '".$to."')";
		}else if($from != '' && $to != ''){
			$where= " AND (DATE_FORMAT(added_date,'%Y-%m-%d') between '".$from."' AND '".$to."')";
		}else if($year != ''){
			$where= " AND (DATE_FORMAT(added_date,'%Y')='".$year."')";
		}
		$result		= false;
		$sql 		= "SELECT SUM(IF(booking_from = 'website', 1,0)) website_booking,SUM(IF(booking_from = 'app', 1,0)) app_booking FROM ".PAYMENT_INFO." WHERE property_id = ".$property_id." ".$where."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
			$result		= $query->row_array();
		}
		//pr($result);
		return $result;
	}
	public function getBookingAnalysis($property_id){
		$result = false;
		for($x=11; $x>=0;$x--){
			$month = strtotime(date('Y-m')." -" . $x . " month");
			$result[$x]['months'] = date('M', $month);
			$sql = "SELECT COUNT(*) total_booking FROM ".PAYMENT_INFO." WHERE property_id=".$property_id." AND (DATE_FORMAT(added_date,'%m-%Y')='".date('m-Y',$month)."')";
			$query		= $this->db->query($sql);
			if($query->num_rows()){
				$res	= $query->row_array();
				$result[$x]['res'] = $res['total_booking'];
			}	
		}
		//pr($result,0);
		return $result;
	}
	public function lastTwoMonthBooking($property_id){
		$res = false;
		$sql = "SELECT
		SUM( if( DATE_FORMAT( added_date, '%m-%Y' ) = DATE_FORMAT( (DATE_FORMAT( CURDATE( ) , '%Y-%m-01' ) - INTERVAL 2
MONTH ) , '%m-%Y' ) , 1, 0 )) lasttwomonth,
		SUM( if( DATE_FORMAT( added_date, '%m-%Y' ) = DATE_FORMAT( (DATE_FORMAT( CURDATE( ) , '%Y-%m-01' ) - INTERVAL 1
MONTH ) , '%m-%Y' ) , 1, 0 )) lastmonth
		 FROM ".PAYMENT_INFO." WHERE property_id=".$property_id."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
		$res	= $query->row_array();
		}
		return $res;
	}
	public function getFeedback($feedback_id){
		$res = false;
		$sql = "SELECT * FROM ".FEEDBACK." WHERE feedback_id=".$feedback_id."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
		$res	= $query->row_array();
		}
		return $res;
	}
	public function getFeedbackDetails($feedback_id){
		$res = false;
		$sql = "SELECT PI.property_id,F.feedback_id,PI.first_name,PI.last_name,F.email FROM ".FEEDBACK." F INNER JOIN ".PAYMENT_INFO." PI ON PI.paymeny_id=F.payment_id WHERE F.feedback_id=".$feedback_id."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
		$res	= $query->row_array();
		}
		return $res;
	}
	public function getElevateAnalysis($property_id){
		$res = false;
		$sql = "SELECT COUNT(*) totalUser FROM ".PAYMENT_INFO." WHERE property_id=".$property_id." AND Booking_status='Booked'";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
			$result			= $query->row_array();
			$res['total_user']	= $result['totalUser'];
		}
		$sql = "SELECT city_id FROM ".PROPERTY_DETAILS." WHERE property_id = ".$property_id."";
		$query		= $this->db->query($sql);
		if($query->num_rows()){
			$result			= $query->row_array();
			$city_id 		= $result['city_id'];
			//$sql = "SELECT COUNT(*) total_property, service_fees FROM ".PROPERTY_MASTER." WHERE city_id=".$city_id."";
		}
		return $res;
		
	}

	public function getArr($property_id,$from_Date,$to_Date)
	{
		$resultArr	= array();
		$paymentArr	= array();
		$rankArr	= array();
		$sql 		= "SELECT rank,added_date
		FROM hw_logs
		WHERE property_id=".$property_id." AND added_date BETWEEN '".$from_Date."' AND '".$to_Date."' ORDER BY added_date";
		$query		= $this->db->query($sql);
		$change_in_rank	= $query->result_array();
		if(is_array($change_in_rank) && COUNT($change_in_rank) >0)
		{
			foreach($change_in_rank as $v)
			{
				$rankArr[]	=	array(intval(date('Y',strtotime($v['added_date']))),intval($v['rank']),intval(date('m',strtotime($v['added_date']))),intval(date('d',strtotime($v['added_date']))));
			}
		}
		$resultArr['change_in_rank']	=	$rankArr;
		
		$sql 		= "SELECT COUNT(*) as no_of_booking,DATE_FORMAT(added_date, '%Y/%m/%d') as custom_added_date,added_date
		FROM hw_payment_info
		WHERE property_id=".$property_id." AND Booking_status='Booked' AND added_date BETWEEN '".$from_Date."' AND '".$to_Date."' GROUP BY custom_added_date  ORDER BY added_date";
		$query		= $this->db->query($sql);
		$no_of_payment	= $query->result_array();
		if(is_array($no_of_payment) && COUNT($no_of_payment) >0)
		{
			foreach($no_of_payment as $v)
			{
				$paymentArr[]	=	array(intval(date('Y',strtotime($v['added_date']))),intval($v['no_of_booking']),intval(date('m',strtotime($v['added_date']))),intval(date('d',strtotime($v['added_date']))));
			}
		}
		$resultArr['paymentArr']	=	$paymentArr;

		return $resultArr;
	}
}	
?>