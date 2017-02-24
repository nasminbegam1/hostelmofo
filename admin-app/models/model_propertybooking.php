<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_propertybooking extends CI_Model
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
		$page 		= $this->uri->segment(4,0);
		$isSession	= $this->uri->segment(5);
		$property_id	= $this->uri->segment(3);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('BOOKINGS');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
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
		
		$this->nsession->set_userdata('BOOKINGS', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE PI.property_id='.$property_id.' AND booking_status="Booked" ';
		
		if($search_keyword != ''){
			$where.= " AND (PI.first_name like '%".$search_keyword."%'
					OR PI.last_name like '%".$search_keyword."%'
					OR PI.email like '%".$search_keyword."%'
					OR PM.property_name  like '%".$search_keyword."%'
					)
				 ";
		}
		
		
		$sql = "SELECT PI.paymeny_id 
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			INNER JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id 
			";
			
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rs->num_rows();
		//echo $rs->num_rows();
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT PM.property_name,PI.*,BK.*,RM.type_name,SUM(BK.total_price) as total_price
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	
	public function getCancelList(&$config,&$start)
	{
		$page 		= $this->uri->segment(4,0);
		$isSession	= $this->uri->segment(5);
		$property_id	= $this->uri->segment(3);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('CANCELLED');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
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
		
		$this->nsession->set_userdata('CANCELLED', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE PI.property_id='.$property_id.' AND booking_status="Cancelled"';
		
		if($search_keyword != ''){
			$where.= " AND (PI.first_name like '%".$search_keyword."%'
					OR PI.last_name like '%".$search_keyword."%'
					OR PI.email like '%".$search_keyword."%'
					OR PM.property_name  like '%".$search_keyword."%'
					)
				 ";
		}
		
		
		$sql = "SELECT PI.paymeny_id 
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			INNER JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id 
			";
			
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rs->num_rows();
		//echo $rs->num_rows();
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT PM.property_name,PI.*,BK.*,RM.type_name,SUM(BK.total_price) as total_price
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id 
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	public function getArrivalList(&$config,&$start)
	{
		$page 		= $this->uri->segment(4,0);
		$isSession	= $this->uri->segment(5);
		$property_id	= $this->uri->segment(3);
		$today 		= date('Y-m-d');
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('ARRIVAL');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
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
		
		$this->nsession->set_userdata('ARRIVAL', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE PI.property_id='.$property_id.' AND booking_status="Booked" AND check_in = "'.$today.'" ';
		
		if($search_keyword != ''){
			$where.= " AND (PI.first_name like '%".$search_keyword."%'
					OR PI.last_name like '%".$search_keyword."%'
					OR PI.email like '%".$search_keyword."%'
					OR PM.property_name  like '%".$search_keyword."%'
					)
				 ";
		}
		
		
		$sql = "SELECT PI.paymeny_id 
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			INNER JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id 
			";
			
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rs->num_rows();
		//echo $rs->num_rows();
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT PM.property_name,PI.*,BK.*,RM.type_name,SUM(BK.total_price) as total_price
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where."
			GROUP BY PI.paymeny_id
			ORDER BY PI.paymeny_id 
			LIMIT ".$start.",".$config['per_page'];
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
		
		$sql = "SELECT PM.property_name,PI.*,BK.*,RM.type_name,BK.total_price
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			INNER JOIN ".BOOKING." AS BK ON BK.payment_id = PI.paymeny_id 
			JOIN ".AGENT_ROOMTYPE." AS RM ON RM.id = BK.room_type 
			".$where;
		
		$rs = $this->db->query($sql);		
		$rec = false;		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
		
	}
	
	public function cancelBooking()
	{
		
		$id = $this->uri->segment(4,0);
		
		
		$sql = "UPDATE ".PAYMENT_INFO." SET booking_status = 'Cancelled' WHERE paymeny_id=".$id;
		$this->db->query($sql);
		return true;
	}
	
	
	
	
}


