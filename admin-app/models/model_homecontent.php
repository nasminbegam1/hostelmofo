<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_homecontent extends CI_Model
{
	var $homecontentTable = 'hw_homecontent';
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}

	public function getHeaderContent(&$tabId){
		
		if($tabId=='middle')
		{
			
		   $where	= " WHERE home_loc = '$tabId'";
		}
		elseif($tabId=='footer')
		{
			$where	= " WHERE home_loc = '$tabId'";
		}
		
		else
		{
		  $where	= " WHERE home_loc = 'header'";
		}
		
		
		$sql = "SELECT * FROM ".HOMECONTENT.$where;
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}

	public function getSingle($id)
	{
		$sql = "SELECT * FROM ".HOMECONTENT." WHERE id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;		
	}
	
	public function updateIntoTable($tableName, $idArr, $updateArr)
	{
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->affected_rows();
			
		}
		//echo $this->db->last_query();
		return $ret;
	}	
	
	
	
	
	
}