<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_agent extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	

	public function getSingle()
	{
		$sql = "SELECT * FROM ".AGENT." WHERE agent_id=".$this->current_user['agent_id'];
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->row();
			
		return $rec;		
	}
	
	public function getEnquryCount(){
		$sql = "SELECT COUNT(*) AS TOT FROM ".ENQUIRY_MASTER." EM INNER JOIN ".PROPERTY_MASTER." PM ON PM.property_master_id=EM.property_id WHERE PM.agent_id=".$this->current_user['agent_id'];
		$rs = $this->db->query($sql);
		$rec = $rs->row();	
		return $rec->TOT;
	}
	
	public function totalBookedProperty(){
		$sql = "SELECT COUNT(*) tot FROM (SELECT PI.property_id
			FROM ".PAYMENT_INFO." AS PI 
			INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
			WHERE PM.agent_id=".$this->current_user['agent_id']." GROUP BY PI.property_id) AS T";
		$rs = $this->db->query($sql);
		$rec = $rs->row();
		return $rec->tot;
	}

}