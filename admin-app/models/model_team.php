<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_team extends CI_Model
{
	var $teamManagementTable	= 'hw_team_management';
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	    //$this->db_phuket = $this->load->database('phuket', TRUE);
	}

	public function getMemberCount()
	{
		$sql = "SELECT COUNT(*) AS member_count FROM ".TEAM;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	public function getTeamList(&$config,&$start, $recordType='')
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('TEAM');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= $this->input->get_post('search_keyword',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] 				= $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('TEAM', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 ";
		
		/*if($recordType != '')
		{
			$where	.= " AND (p.record_type =  '".ucfirst($recordType)."' OR p.record_type='Both')";	
		}
		*/
		if($search_keyword != ''){
			$where.= " AND (team_type like '%".$search_keyword."%' 
					OR name like '%".$search_keyword."%' 
					OR designation like '%".$search_keyword."%' 
					)
				 ";
		}
		
		$sql = "SELECT COUNT(*) as TotalrecordCount
			FROM ".TEAM." AS TMT".
			$where;
			
		//echo $sql;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT *
			FROM ".TEAM." AS TMT".
			$where."
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql;
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function get_single($id){
		$sql = "SELECT * FROM ".TEAM." WHERE id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function insertIntoTable($tableName,$insertArr)
	{
		//echo $samui_image;exit;
		$ret = false;
		if($tableName == '')
			return $ret;
		
		
		if($insertArr && is_array($insertArr))
		{
			$this->db->insert($tableName, $insertArr);
			
			//$this->last
			$ret = $this->db->insert_id(); 
		}
		
		return $ret;
	}
	
	public function updateIntoTable($tableName, $idArr, $updateArr,$samui_image='',$prev_name='')
	{
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		//$phuket_sql = "SELECT id FROM ".$this->teamManagementTable." WHERE `name` = '".$updateArr['name']."'";
		//$phuket_rs = $this->db->query($phuket_sql);
		//$phuket_rec = $phuket_rs->result_array();
		////pr($phuket_rec,1);
		//
		//if(isset($phuket_rec[0]['id']) && $phuket_rec[0]['id'] == $idArr['id'])
		//	return false;
		
		$samui_sql = "SELECT id FROM ".TEAM." WHERE `name` = '".addslashes($prev_name)."'";
		//$samui_rs = $this->db_phuket->query($samui_sql);
		//$samui_rec = $samui_rs->result_array();
		//pr($samui_rec,1);
		//pr($updateArr);
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);
			
			if(isset($samui_image) && $samui_image!='')
				$updateArr['image']	=	$samui_image;
			else{
			      if(array_key_exists('image',$updateArr)){
				unset( $updateArr['image'] );
			      }
			}
			//pr($updateArr,1);
			//if(!empty($samui_rec)){
			//	$this->db_phuket->update($tableName, $updateArr,$samui_rec[0]);
			//	//echo $this->db->last_query(); die;
			//}else{
			//	//pr($updateArr);
			//	$this->db_phuket->insert($tableName, $updateArr);
			//}
			$ret = $this->db->affected_rows();
		}
		//echo $this->db->last_query();
		return $ret;
	}	


	public function updateStatus($tableName, $idArr, $updateArr)
	{
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		$phuket_sql = "SELECT name FROM ".TEAM." WHERE `id` = '".$idArr['id']."'";
		$phuket_rs = $this->db->query($phuket_sql);
		$phuket_rec = $phuket_rs->result_array();
		
		//pr($phuket_rec,0);pr($updateArr,0);
		
		$samui_sql = "SELECT * FROM ".TEAM." WHERE `name` = '".addslashes($phuket_rec[0]['name'])."'";
		//$samui_rs = $this->db_phuket->query($samui_sql);
		//$samui_rec = $samui_rs->result_array();
		//pr($samui_rec,1);
		
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);			
			//if(!empty($samui_rec)){
			//	$this->db_phuket->update($tableName, $updateArr,$samui_rec[0]);
			//}else{
			//	//pr($updateArr);
			//	$this->db_phuket->insert($tableName, $updateArr);
			//}
			//echo $this->db->last_query(); die;
			$ret = $this->db->affected_rows();
		}
		//echo $this->db->last_query();
		return $ret;
	}
	
	public function deleteData($table, $where,$team_id='') {
		
		$phuket_sql = "SELECT name FROM ".TEAM." WHERE `id` = '".$team_id."'";
		$phuket_rs = $this->db->query($phuket_sql);
		$phuket_rec = $phuket_rs->result_array();
		
		
		$samui_sql = "SELECT id FROM ".TEAM." WHERE `name` = '".addslashes($phuket_rec[0]['name'])."'";
		//$samui_rs = $this->db_phuket->query($samui_sql);
		//$samui_rec = $samui_rs->result_array();		
		

		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		$rec 	= $this->db->query($sql);
		
		//if(isset($samui_rec[0]['id']))
		//{
		//	$samui_sql = "DELETE FROM ".$this->teamManagementTable." WHERE `id` = '".$samui_rec[0]['id']."'";
		//	$samui_rs = $this->db_phuket->query($samui_sql);
		//}
		
		return $rec;
	}
}