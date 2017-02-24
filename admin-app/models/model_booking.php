<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_booking extends CI_Model
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;
	var $propertyMaster	= PROPERTY_MASTER;
	var $contactMaster	= CONTACT;
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getList(&$config,&$start)
	{
			$page 		= $this->uri->segment(3,0);
			$isSession	= $this->uri->segment(4);
		
			$start 		= 0;
			$search_keyword	= '';
			$per_page	= '';
		
			if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == ''){
				$param		= $this->nsession->userdata('BOOKING');
				$search_keyword = trim($param['search_keyword']);
				$per_page 	= $param['per_page'];
			}
			else{
				$search_keyword	= trim( $this->input->get_post('search_keyword',true));
				$per_page 	= $this->input->get_post('per_page',true);	
			}
		
			$sessionDataArray 			= array();
			$sessionDataArray['search_keyword'] 	= $search_keyword;
			$sessionDataArray['page']		= $page;		
			$sessionDataArray['per_page'] 		= $per_page;
			$search_keyword	= mysql_real_escape_string(trim($search_keyword));
			if($per_page)
				$config['per_page'] = $per_page;
			$config['page'] = $page;
		
			$this->nsession->set_userdata('BOOKING', $sessionDataArray);		
		
			$start 	= 0;
			$where	= ' WHERE 1 ';
		
			if($search_keyword != ''){
				$where.= " AND (PI.first_name like '%".$search_keyword."%'
						OR PI.last_name like '%".$search_keyword."%'
						OR PI.email like '%".$search_keyword."%'
						OR PM.property_name  like '%".$search_keyword."%'
						)";
			}
		
		
		//$sql = "SELECT PI.paymeny_id 
		//	FROM ".PAYMENT_INFO." AS PI 
		//	INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		//	INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		//	INNER JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type ".$where." GROUP BY PI.paymeny_id ORDER BY PI.paymeny_id";
		
		
		//$sql = "SELECT PI.*,BK.room_type FROM ".PAYMENT_INFO." AS PI INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id ".$where." GROUP BY PI.paymeny_id";
		
		$sql = "SELECT PI.*,BK.room_type ,PM.property_name,BK.total_price FROM ".PAYMENT_INFO." AS PI INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id ".$where." GROUP BY PI.paymeny_id ORDER BY PI.paymeny_id DESC";
		
		//echo $sql; exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		//pr($rec);
		$config['total_rows'] = $rs->num_rows();
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		//$sql = "SELECT PM.property_name,PI.*,BK.*,RM.roomtype_name,SUM(BK.total_price) as total_price
		//	FROM ".PAYMENT_INFO." AS PI 
		//	INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		//	INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		//	JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type 
		//	".$where."
		//	GROUP BY PI.paymeny_id
		//	ORDER BY PI.paymeny_id DESC
		//	LIMIT ".$start.",".$config['per_page'];
		
		$sql = "SELECT PI.*,BK.room_type ,PM.property_name,BK.total_price FROM ".PAYMENT_INFO." AS PI INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id ".$where." GROUP BY PI.paymeny_id ORDER BY PI.paymeny_id DESC LIMIT ".$start.",".$config['per_page'];
		
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	
	
	
	public function getBooking($peyment_id){
		if (!$peyment_id) return false;
		
		$where	= ' WHERE PI.paymeny_id='.$peyment_id;
		
		//$sql = "SELECT PM.property_name,PI.*,BK.*,RM.roomtype_name,BK.total_price
		//	FROM ".PAYMENT_INFO." AS PI 
		//	INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		//	INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
		//	JOIN ".ROOMTYPE_MASTER." AS RM ON RM.roomtype_id = BK.room_type 
		//	".$where;
		
		$sql = "SELECT PM.property_name,PI.*,BK.*, RM.*
		FROM ".PAYMENT_INFO." AS PI
		INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
		INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id
		JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type
		".$where;
		
		//echo $sql; exit;
		$rs = $this->db->query($sql);		
		$rec = false;		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
		
	}
	
	
	
	
}


