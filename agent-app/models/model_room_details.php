<?php
class Model_room_details extends CI_Model
{
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	public function getList(&$config,&$start,$property_id){
		$page 		= $this->uri->segment(4,0); //page
		//$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('ROOM_LIST');
			$search_keyword = addslashes($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= addslashes($this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= addslashes($search_keyword);
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ROOM_LIST', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1  AND property_id= ".$property_id;
		
		if($search_keyword != ''){
			$where.= " AND (type_name like '%".trim($search_keyword)."%' OR size like '%".trim($search_keyword)."%' OR room_lable like '%".trim($search_keyword)."%')";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".AGENT_ROOMTYPE."". 
			$where . 
			"
			AND agent_id= ".$this->current_user['agent_id']." 
			ORDER BY id DESC";
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT * 
			FROM ".AGENT_ROOMTYPE."
			".$where."
			LIMIT ".$start.",".$config['per_page'];
			$query=$this->db->query($sql);

	$room_details	= $query->result_array();
		
					          
		return $room_details;
		
	}
}	
	?>