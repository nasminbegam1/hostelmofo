<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_salons extends CI_Model
{
	var $salonTable 	= 'bs_salons';
	var $salonUserTable 	= 'bs_salon_users';
	var $salonUserTypeTable = 'bs_salon_user_types';
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getList(&$config,&$start){
			
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('SALONSETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('SALONSETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE is_deleted<>'1' ";
		
		if($search_keyword != ''){
			$where.= " AND (salon_name like '%".$search_keyword."%' OR salon_status like '%".$search_keyword."%' ) ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->salonTable." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ".$this->salonTable.$where." order by created_at DESC LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		//'SELECT * FROM bs_orders OD join bs_plans PL on OD.plan_id = PL.plan_id where OD.salon_id=25 order by OD.order_id desc limit 1';
		
		$rec = false;
		
		if($rs->num_rows()){
			$results = $rs->result_array();
			foreach($results as $result){
				$data = $result;
				$od = $this->db->query('select * from bs_orders as OD join bs_plans PL on OD.plan_id=PL.plan_id where OD.salon_id='.$result['salon_id'].' order by OD.order_id desc limit 1');
				$orders = $od->result_array();
				$data['ORDERS'] = array();
				if($orders)
				$data['ORDERS'] = $orders[0];
				$rec[] = $data;
			}
		}
			          
		return $rec;
		
	}
	
	
	public function getSingle($id)
	{
		$sql = "SELECT * FROM ".$this->salonTable." WHERE salon_id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();		
			
		return $rec;		
	}
	
	public function getSingleDetails($id)
	{
		$sql = "SELECT * FROM ".$this->salonTable." WHERE salon_id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows()){
			//$rec = $rs->result_array();
			$results = $rs->result_array();
			foreach($results as $result){
				$data = $result;
				$od = $this->db->query('select * from bs_orders as OD join bs_plans PL on OD.plan_id=PL.plan_id where OD.salon_id='.$result['salon_id'].' order by OD.order_id desc limit 1');
				$orders = $od->result_array();
				$data['ORDERS'] = array();
				if($orders)
				$data['ORDERS'] = $orders[0];
				$rec[] = $data;
			}			
		}
			
		return $rec;		
	}	
	
	public function updateOption($id)
	{
		//$sitesettings_lebel 	= $this->input->get_post('sitesettings_lebel');
		$salonname	= $this->input->get_post('salon_name');
		$isteam		= $this->input->get_post('is_team');
		$salonstatus	= $this->input->get_post('salon_status');
		
		$sql = "UPDATE ".$this->salonTable." SET salon_name = '".addslashes(trim($salonname))."', is_team = '".addslashes(trim($isteam))."', salon_status = '".addslashes(trim($salonstatus))."', updated_at = CURRENT_TIMESTAMP() WHERE salon_id = '".$id."'";
		$this->db->query($sql);
		
		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on banner insert: ".$sql);
			return false;
		}
		
		return true;
	}
	public function getcontactList(&$config,&$start){
			
		$page 		= $this->uri->segment(4,0); //page
		$salon_id	= $this->uri->segment(3); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('SALONCONTACTSETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('SALONCONTACTSETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		//$where	= " WHERE SU.salon_id=".$salon_id." AND SU.users_type<>5";
		$where	= " WHERE SU.salon_id=".$salon_id;
		
		if($search_keyword != ''){
			$explode_search_keyword = explode(' ',$search_keyword);
			if(isset($explode_search_keyword[0]) && $explode_search_keyword[0] != '' && isset($explode_search_keyword[1]) && $explode_search_keyword[1] != ''){
				$first_name = $explode_search_keyword[0];
				$last_name = $explode_search_keyword[1];
			}else{
				$first_name = $search_keyword;
				$last_name = $search_keyword;
			}
			$where.= " AND (SU.users_first_name like '%".$first_name."%' OR SU.users_last_name like '%".$last_name."%'  OR SU.users_email like '%".$search_keyword."%') ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->salonUserTable." SU ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ".$this->salonUserTable." SU INNER JOIN ".$this->salonUserTypeTable." SUT ON SU.users_type=SUT.type_id ".$where."  LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	public function getSingleUser($id)
	{
		$sql = "SELECT * FROM ".$this->salonUserTable." SU INNER JOIN ".$this->salonUserTypeTable." SUT ON SU.users_type=SUT.type_id WHERE SU.users_id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;		
	}
	
	
	public function getAppointmentList(&$config,&$start){
			
		$page 		= $this->uri->segment(4,0); //page
		$salon_id	= $this->uri->segment(3); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('APPOINTMENTSETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('APPOINTMENTSETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE AM.salon_id=".$salon_id;
		//$where	= " WHERE 1 ";
		
		if($search_keyword != ''){
			$explode_search_keyword = explode(' ',$search_keyword);
			if(isset($explode_search_keyword[0]) && $explode_search_keyword[0] != '' && isset($explode_search_keyword[1]) && $explode_search_keyword[1] != ''){
				$first_name = $explode_search_keyword[0];
				$last_name = $explode_search_keyword[1];
			}else{
				$first_name = $search_keyword;
				$last_name = $search_keyword;
			}
			$where.= " AND (AM.app_no like '%".$search_keyword."%' OR SS.service_name like '%".$search_keyword."%' OR SU.users_first_name like '%".$first_name."%' OR SU.users_last_name like '%".$last_name."%' OR SU1.users_first_name like '%".$first_name."%' OR SU1.users_last_name like '%".$last_name."%') ";
		}
		
		//$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->orders." OD ".$where." ";
		$sql="SELECT COUNT(*) as TotalrecordCount FROM bs_appointment_master AM JOIN bs_appointment_services APS ON AM.app_id=APS.app_id JOIN bs_services SS ON APS.service_id=SS.service_id JOIN bs_salon_users SU on APS.staff_id=SU.users_id JOIN bs_salon_users SU1 on AM.customer_id=SU1.users_id  ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT AM.salon_id,AM.app_id,AM.app_no,AM.app_date,SS.service_name,CONCAT(SU1.users_first_name,' ',SU1.users_last_name) as customer, CONCAT(SU.users_first_name,' ',SU.users_last_name) as staff FROM bs_appointment_master AM JOIN bs_appointment_services APS ON AM.app_id=APS.app_id JOIN bs_services SS ON APS.service_id=SS.service_id JOIN bs_salon_users SU on APS.staff_id=SU.users_id JOIN bs_salon_users SU1 on AM.customer_id=SU1.users_id ".$where." LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	
	public function getAppointmentSingle($salon_id, $app_id){
		$sql = "SELECT AM.salon_id,AM.app_id,AM.app_no,AM.app_date,SS.service_name,CONCAT(SU1.users_first_name,' ',SU1.users_last_name) as customer, CONCAT(SU.users_first_name,' ',SU.users_last_name) as staff,APS.start_time,APS.end_time,APS.duration,SS.service_type,SS.price,SS.note FROM bs_appointment_master AM JOIN bs_appointment_services APS ON AM.app_id=APS.app_id JOIN bs_services SS ON APS.service_id=SS.service_id JOIN bs_salon_users SU on APS.staff_id=SU.users_id JOIN bs_salon_users SU1 on AM.customer_id=SU1.users_id  WHERE AM.salon_id = ".$salon_id." and AM.app_id=".$app_id;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;			
		
	}
	public function getInventoryReport($filter_month,$salon_id,$product_type='Product'){
		$month = date('m');
		$year = date('Y');
		if($filter_month){
			$expl = explode('-',$filter_month);
			$m = $expl[0];
			$y = isset($expl[1])?$expl[1]:date('Y');
			
			if(is_numeric($m) && is_numeric($m))
			{
				$month = $m;
				$year = $y;	
			}
			
		}
		$sql = "SELECT `product_name` , `inventory_process` , SUM( PI.quantity ) AS inventory_count, carried_forward, IP.product_type, SUM( IP.quantity ) AS invoice_count ".
			"FROM bs_product_inventory AS PI ".
			"LEFT JOIN bs_invoice_product AS IP ON IP.product_id = PI.inventory_id ".
			"WHERE
			 PI.salon_id = '".$salon_id."'  
			 AND PI.`inventory_status` = 'Completed' ".
			"AND PI.product_type = '".$product_type."' ".
			"AND MONTH( `completion_date` ) = '".$month."' AND YEAR( `completion_date` ) = '".$year."' ".
			"GROUP BY inventory_process, product_name, carried_forward, product_type ";
		$rec = false;
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();		
		if($rs->num_rows()){
			$rec = $rs->result_array(); 
		} else{
			$rec = array();
		}
		return $rec;
	}
	public function getOrderReport($salon_id){
		
		$sql = "SELECT `product_name`,SU.users_first_name, SU.users_last_name, SU.users_mobile,cost_price,  `inventory_process`,completion_date , SUM( PI.quantity ) AS inventory_count, carried_forward, PI.product_type as inventory_product_type, IP.product_type as invoice_product_type, SUM( IP.quantity ) AS invoice_count, PI.supplier_id 
			FROM bs_product_inventory AS PI
			LEFT JOIN bs_invoice_product AS IP ON IP.product_id = PI.inventory_id 
			JOIN bs_salon_users AS SU  ON SU.users_id = PI.supplier_id AND SU.users_type = 2 
			WHERE
			PI.salon_id = '".$salon_id."' 
			AND PI.`inventory_status` = 'Completed'
			AND MONTH( `completion_date` ) = MONTH(CURDATE()) 
			AND YEAR( `completion_date` ) =  YEAR(CURDATE())
			GROUP BY inventory_process, product_name, carried_forward, IP.product_type,completion_date 
			ORDER BY completion_date DESC ";
		$rec = false;
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();		
		if($rs->num_rows()){
			$rec = $rs->result_array(); 
		} else{
			$rec = array();
		}
		return $rec;
	}
	public function getUsageReport($start_date,$end_date,$salon_id){
		$start_date = $start_date ? date('Y-m-d',strtotime($start_date)):date('Y-m-01');
		$end_date   = $end_date ? date('Y-m-d',strtotime($end_date)):date('Y-m-01');
		
		$sql = "SELECT PI.product_name,SUM(PI.quantity) as inventory_quantity,
		PI.sell_price,PI.inventory_process,IP.product_type,SUM(IP.quantity) as invoice_quantity
		,unit_price as invoice_unit_price 	
			FROM bs_product_inventory AS PI
			LEFT JOIN bs_invoice_product AS IP ON IP.product_id = PI.inventory_id 
			WHERE PI.`inventory_status` = 'Completed'
			AND PI.salon_id = '".$salon_id."' 
			AND IP.product_type = 'For Use'
			AND PI.inventory_process = 'Subtraction' 
			AND completion_date != '' 
			AND  `completion_date` > '".$start_date."' 
			AND  `completion_date` < '".$end_date."' 
			
			GROUP BY product_name,inventory_process,IP.product_type 
			ORDER BY completion_date DESC ";
		
		$rec = false;
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();		
		if($rs->num_rows()){
			$rec = $rs->result_array(); 
		} else{
			$rec = array();
		}
		return $rec;
	}
	public function getSalesReport($staff_id,$start_date,$end_date,$salon_id){
		$start_date = $start_date ? date('Y-m-d',strtotime($start_date)):date('Y-m-01');
		$end_date   = $end_date ? date('Y-m-d',strtotime($end_date)):date('Y-m-01');
		$staff_q    = $staff_id ? " AND IP.staff_id=".$staff_id:" ";
		$sql = "SELECT PI.product_name,SUM(IP.quantity) as invoice_quantity,IP.unit_price as invoice_sale_price,PI.cost_price,
			IP.staff_id 
			FROM bs_product_inventory AS PI
			LEFT JOIN bs_invoice_product AS IP ON IP.product_id = PI.inventory_id 
                        JOIN bs_salon_users AS STF  ON STF.users_id = IP.staff_id 
			WHERE
			PI.salon_id = '".$salon_id."' 
			AND PI.`inventory_status` = 'Completed' ".$staff_q." 
			AND IP.product_type='For Sale' 
			AND  `completion_date` > '".$start_date."' 
			AND  `completion_date` < '".$end_date."'  
			GROUP BY product_name 
			ORDER BY completion_date DESC ";
		$rec = false;
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();		
		if($rs->num_rows()){
			$rec = $rs->result_array(); 
		} else{
			$rec = array();
		}
		return $rec;
	}

}