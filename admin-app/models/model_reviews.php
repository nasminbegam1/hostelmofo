<?php

class Model_reviews extends CI_Model{
    
    public function getList(&$config){
                $page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$property_name	= '';
                $user_name      = '';
		$per_page	= '';
		
		if($this->input->get_post('user_name') == '' && $this->input->get_post('property_name') == '' && $this->input->get_post('per_page') == '')
		{	$param		    = $this->nsession->userdata('REVIEW_SEARCH');
			$property_name      = $param['property_name'];
                        $user_name          = $param['user_name'];
			$per_page 	    = $param['per_page'];
		}
		else {
			$property_name	= $this->input->get_post('property_name',true);
                        $user_name	= $this->input->get_post('user_name',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['property_name'] 	= $property_name;
                $sessionDataArray['user_name'] 	        = $user_name;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('REVIEW_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		if($property_name != ''){
			$where.= " AND (P.property_name like '%".$property_name."%' )";
		}
                if($user_name != ''){
			$where.= " AND (concat_ws (' ', U.user_first_name,U.user_last_name) like '%".$user_name."%' )";
		}
		
		
//		$sql = "SELECT COUNT(*) as TotalrecordCount
//			FROM ".REVIEW_MASTER." AS R".
//                        " INNER JOIN ".FRONTUSER." AS U ON U.user_id = R.user_id
//			 INNER JOIN ".PROPERTY_MASTER." AS P ON P.property_master_id = R.property_id "
//			.$where ;
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".REVIEW_MASTER." AS R                       
			INNER JOIN ".PROPERTY_MASTER." AS P ON P.property_master_id = R.property_id "
			.$where ;
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		//$sql = "SELECT R.*,P.property_name,U.user_first_name,U.user_last_name
		//	FROM ".REVIEW_MASTER." AS R
		//	INNER JOIN ".FRONTUSER." AS U ON U.user_id = R.user_id
		//	INNER JOIN ".PROPERTY_MASTER." AS P ON P.property_master_id = R.property_id "
		//	.$where.
		//	"ORDER BY R.review_id DESC
		//	LIMIT ".$start.",".$config['per_page'];
			
	    $sql = "SELECT R.*,P.property_name
			FROM ".REVIEW_MASTER." AS R
			
			INNER JOIN ".PROPERTY_MASTER." AS P ON P.property_master_id = R.property_id "
			.$where.
			"ORDER BY R.review_id DESC
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = array();
		
		if($rs->num_rows()){
			$rec = $rs->result_array();
			
		}			          
		return $rec;
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
    
    function getTotalAvarageRating($property_id)
    {
	$sql = "SELECT avg(avarage_rating) as avarage_rating FROM ".REVIEW_MASTER." WHERE property_id = '".$property_id."' GROUP BY property_id ";
	$rs = $this->db->query($sql);
	$rec = '';
	if($rs->num_rows())
	{
	    $rec = $rs->row_array();		
	}
	return $rec;
    }
    
}

?>