<?php
class Model_test extends CI_Model
{
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	public function getList(&$config,&$start,$property_id,$from,$to){
		$page 		= $this->uri->segment(4,0); //page
		//$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		//
		//if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		//{	$param		= $this->nsession->userdata('ROOM_LIST');
		//	$search_keyword = addslashes($param['search_keyword']);
		//	$per_page 	= $param['per_page'];
		//}
		//else {
		//	$search_keyword	= addslashes($this->input->get_post('search_keyword',true));
		//	$per_page 	= $this->input->get_post('per_page',true);	
		//}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] = addslashes($search_keyword);
		$sessionDataArray['page'] = $page;		
		$sessionDataArray['per_page']= $per_page;
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('REPORT', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($from != '' && $to == ''){
			$from = $from.' 00:00:00';
			$where.= " AND (HF.added_on > '".$from."')";
		}
		if($from == '' && $to != ''){
			$to = $to.' 11:59:59';
			$where.= " AND (HF.added_on < '".$to."')";
		}
		if($from != '' && $to != ''){
			$from = $from.' 00:00:00';
			$to = $to.' 11:59:59';
			$where.= " AND (HF.added_on between '".$from."' AND '".$to."')";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM `hw_feedback` as HF". 
			$where . 
			" AND property_id= ".$property_id." 
			ORDER BY feedback_id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT HF.*,HP.reference_id,HC.countryName 
			FROM `hw_feedback` as HF
			LEFT JOIN hw_payment_info as HP ON HF.payment_id = HP.paymeny_id
			LEFT JOIN hw_countries as HC ON HP.nationality = HC.idCountry 
			".$where."
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$query=$this->db->query($sql);

		$report_list	= $query->result_array();
		
					          
		return $report_list;
		
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

}	
	?>