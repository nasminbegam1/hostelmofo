<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_enquiry extends CI_Model
{
	
	var $enquiryMaster	= ENQUIRY_MASTER;
	var $actionMaster	= 'lp_action_master';
	var $agentMaster	= 'lp_agent_master';
	var $enquiryLead	= 'lp_enquiry_lead';
	var $propertyMaster	= PROPERTY_MASTER;
	var $propertyVisited	= 'lp_property_visited';
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getAllEnquiryList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0);
		$isSession	= $this->uri->segment(4);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('ENQUIRY');
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
		$search_keyword	= mysql_real_escape_string($search_keyword);
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ENQUIRY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR email_address like '%".$search_keyword."%'
					
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryMaster." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT em.*, pm.property_name, pm.property_slug
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_master_id".
			$where." 
			GROUP BY em.enquiry_id
			ORDER BY em.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];
//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}
	
	public function getEnquiryList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->session->userdata('GENERAL_ENQUIRY');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim($this->input->get_post('search_keyword',true));
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
		
		$this->session->set_userdata('GENERAL_ENQUIRY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE sales_rentals = "General" ';
		
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR email_address like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryMaster." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		/*$sql = "SELECT em.*, agm.agent_name, acm.action_name
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_action_master  AS acm ON em.action_id = acm.action_id
			LEFT JOIN lp_agent_master  AS agm ON em.agent_id = agm.agent_id".
			$where."
			GROUP BY enquiry_id ORDER BY enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];*/
			
		$sql = "SELECT em.*
			FROM lp_enquiry_master AS em ".
			$where."
			GROUP BY enquiry_id ORDER BY enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];

		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getRentalEnquiryList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->session->userdata('RENTAL_ENQUIRY');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim($this->input->get_post('search_keyword',true));
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
		
		$this->session->set_userdata('RENTAL_ENQUIRY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE sales_rentals = "Rental" ';
		
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR email_address like '%".$search_keyword."%'
					OR sales_rentals like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryMaster." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT em.*, pm.property_name
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_id".
			$where." 
			GROUP BY em.enquiry_id
			ORDER BY em.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];

		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function getSalesEnquiryList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->session->userdata('SALES_ENQUIRY');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	=  trim($this->input->get_post('search_keyword',true));
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
		
		$this->session->set_userdata('SALES_ENQUIRY', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE sales_rentals = "Sales" ';
		
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR email_address like '%".$search_keyword."%'
					OR sales_rentals like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryMaster." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		/*$sql = "SELECT *
			FROM ".$this->enquiryMaster. " ".
			$where." GROUP BY enquiry_id ORDER BY enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];*/
			
		$sql = "SELECT em.*, pm.property_name
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_id".
			$where." 
			GROUP BY em.enquiry_id
			ORDER BY em.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];

		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
 
	public function insertEnquiryLead($enquiry_id)
	{
		$agent 		= addslashes(trim($this->input->get_post('agent_assign')));
		$action		= addslashes(trim($this->input->get_post('action_list')));
		$notes		= addslashes(trim($this->input->get_post('notes')));
		
		$dueDate	= $this->input->get_post('due_date');
		$followupDate	= $this->input->get_post('follow_up_date');
		
		$date1 = explode('/',$dueDate);
		$due_date = mktime(0,0,0,$date1[1],$date1[0],$date1[2]);
		
		$date2 = explode('/',$followupDate);
		$follow_up_date = mktime(0,0,0,$date2[1],$date2[0],$date2[2]);				
		
		if( $dueDate != '0000-00-00') {
			$due_date	= @date('Y-m-d', $due_date);
		} else {
			$due_date	= '0000-00-00';
		}
		if( $followupDate != '0000-00-00') {
			$follow_up_date	= @date('Y-m-d', $follow_up_date);
		} else {
			$follow_up_date	= '0000-00-00';
		}		
		
		$sql = "INSERT INTO ".$this->enquiryLead."
			SET
			enquiry_id 	= '".$enquiry_id."',
			assigned_by	= '".$this->session->userdata('admin_id')."',
			assigned_to	= '".$agent."',
			action_id	= '".$action."',
			note		= '".$notes."',
			start		= '".$due_date."',
			end		= '".$follow_up_date."',
			assigned_type	= 'admin'";
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		
	}
	
	public function getAllConversation($enquiry_id)
	{
		$sql = "SELECT el.*, CONCAT(au.first_name, ' ', au.last_name) AS user_name, CONCAT(au1.first_name, ' ', au1.last_name) AS user_agent_name,
			ac.action_name
			FROM lp_enquiry_lead AS el
			LEFT JOIN lp_adminuser AS au ON el.assigned_by = au.admin_id
			LEFT JOIN lp_adminuser AS au1 ON el.assigned_to = au1.admin_id
			LEFT JOIN lp_action_master AS ac ON el.action_id = ac.action_id
			WHERE enquiry_id = '".$enquiry_id."'
			ORDER BY id DESC";
			
		$rs	= $this->db->query($sql);
		$rec	= false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getLeadList(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		$user_id = $this->session->userdata('admin_id');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->session->userdata('ENQUIRY_LEAD');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim($this->input->get_post('search_keyword',true));
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
		
		$this->session->set_userdata('ENQUIRY_LEAD', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE em.sales_rentals = '".$this->session->userdata('lead_enquiry_type')."' AND el.assigned_to = '".$user_id."'";
		
		if($search_keyword != ''){
			$where.= " AND (em.contact_name like '%".$search_keyword."%'
					OR em.email_address like '%".$search_keyword."%'
					OR em.sales_rentals like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->enquiryLead." AS el
			LEFT JOIN lp_enquiry_master AS em ON el.enquiry_id = em.enquiry_id ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT em.enquiry_id, em.contact_name, em.email_address, em.message, el.action_id, el.note, el.assigned_by,el.due_date,
			el.follow_up_date, agm.agent_name, acm.action_name, CONCAT(au.first_name, ' ', au.last_name) AS assigned_by_name,
			el.start, el.end
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			LEFT JOIN lp_action_master  AS acm ON el.action_id = acm.action_id
			LEFT JOIN lp_agent_master  AS agm ON el.assigned_by = agm.agent_id
			LEFT JOIN lp_adminuser AS au ON el.assigned_by = au.admin_id".
			$where."
			GROUP BY el.enquiry_id ORDER BY el.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];

		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function insertFollowUpLead($enquiry_id)
	{
		$agent 	= 0;
		$action	= 0;
		
		if($this->input->get_post('agent_assign') != '')
		{
			$agent = addslashes(trim($this->input->get_post('agent_assign')));
		}
		
		if($this->input->get_post('action_list') != '')
		{
			$action		= addslashes(trim($this->input->get_post('action_list')));
		}
		
		$notes		= addslashes(trim($this->input->get_post('notes')));
		
		$sql = "INSERT INTO ".$this->enquiryLead."
			SET
			enquiry_id 	= '".$enquiry_id."',
			assigned_by	= '".$this->session->userdata('admin_id')."',
			assigned_to	= '".$agent."',
			action_id	= '".$action."',
			note		= '".$notes."',
			assigned_type	= 'agent'";
		
		$rs = $this->db->query($sql);
		
	}
	
	public function getAssignedUserInEnquiryLead($enquiry_id)
	{
		$sql	= "SELECT GROUP_CONCAT(DISTINCT assigned_to) AS assigned_to FROM lp_enquiry_lead WHERE enquiry_id = '".$enquiry_id."'";
		$rs 	= $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getEnquiryDetails($enquiry_id)
	{
		$sql = "SELECT em.*, pm.property_name,pm.property_slug
			FROM ".$this->enquiryMaster. " AS em 
			LEFT JOIN ".$this->propertyMaster." AS pm ON em.property_id = pm.property_master_id
			WHERE em.enquiry_id = '".$enquiry_id."'";

		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getPreviousAgent($enquiry_id)
	{
		$sql = "SELECT assigned_to 
			FROM ".$this->enquiryLead. " 
			WHERE enquiry_id = '".$enquiry_id."'
			ORDER BY id DESC";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalLeadsByDateLead($date, $lead_type)
	{
		$sql = "SELECT COUNT(em.enquiry_id) AS CNT
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			WHERE DATE_FORMAT(el.added_on,'%Y-%m-%d') = '".$date."' AND
			em.sales_rentals = '".$lead_type."'";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
		
	public function getLeadsByDateTime(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$per_page	= '';
		$specific_date	= '';
		$lead_type	= '';
		
		if($this->input->get_post('action') == 'Process')
		{
			$specific_date	= $this->input->get_post('specific_date');
			$lead_type	= $this->input->get_post('lead_type');
		}
		else
		{
			if(isset($this->data['params']['specific_date']) && !empty($this->data['params']['specific_date']) )
			{
				$specific_date	= $this->data['params']['specific_date'];				
			}
			else
			{
				$specific_date	= @date('d/m/Y');
			}
			
			if(isset($this->data['params']['lead_type']))
			{
				$lead_type	= $this->data['params']['lead_type'];
			}
			else
			{
				$lead_type	= '';
			}
		}
		
		$per_page 				= $this->input->get_post('per_page',true);	
		$sessionDataArray			= array();
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$sessionDataArray['specific_date']	= $specific_date;
		$sessionDataArray['lead_type']		= $lead_type;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		
		$start 	= 0;
		
		$sql = "SELECT em.enquiry_id
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			WHERE DATE_FORMAT(el.added_on,'%Y-%m-%d') = '".$config['date']."' AND
			em.sales_rentals = '".$config['lead_type']."'
			GROUP BY em.enquiry_id";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->result_array();
		$config['total_rows'] = sizeof($rec);
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT em.enquiry_id, em.contact_name, em.email_address, em.notes, em.added_on, COUNT(em.enquiry_id) AS CNT 
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			WHERE DATE_FORMAT(el.added_on,'%Y-%m-%d') = '".$config['date']."' AND
			em.sales_rentals = '".$config['lead_type']."'
			GROUP BY em.enquiry_id
			ORDER BY em.enquiry_id DESC
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalEnquiryByDateLead($date, $lead_type)
	{
		$sql = "SELECT COUNT(enquiry_id) AS CNT
			FROM lp_enquiry_master 
			WHERE DATE_FORMAT(added_on,'%Y-%m-%d') = '".$date."' AND
			sales_rentals = '".$lead_type."'";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getEnquiryByDateTime(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$per_page	= '';
		$specific_date	= '';
		$lead_type	= '';
		
		if($this->input->get_post('action') == 'Process')
		{
			$specific_date	= $this->input->get_post('specific_date');
			$lead_type	= $this->input->get_post('lead_type');
		}
		else
		{
			if(isset($this->data['params']['specific_date']))
			{
				$specific_date	= $this->data['params']['specific_date'];
			}
			else
			{
				$specific_date	= '';
			}
			
			if(isset($this->data['params']['lead_type']))
			{
				$lead_type	= $this->data['params']['lead_type'];
			}
			else
			{
				$lead_type	= '';
			}
		}
		
		$per_page 				= $this->input->get_post('per_page',true);	
		$sessionDataArray			= array();
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$sessionDataArray['specific_date']	= $specific_date;
		$sessionDataArray['lead_type']		= $lead_type;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		
		$start 	= 0;
		
		$sql = "SELECT enquiry_id
			FROM lp_enquiry_master 
			WHERE DATE_FORMAT(added_on,'%Y-%m-%d') = '".$config['date']."' AND
			sales_rentals = '".$config['lead_type']."'
			GROUP BY enquiry_id";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->result_array();
		$config['total_rows'] = sizeof($rec);
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql = "SELECT enquiry_id, contact_name, email_address, notes, added_on
			FROM lp_enquiry_master 
			WHERE DATE_FORMAT(added_on,'%Y-%m-%d') = '".$config['date']."' AND
			sales_rentals = '".$config['lead_type']."'
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
		$sql = "SELECT enquiry_id, contact_name, email_address, notes, added_on
			FROM lp_enquiry_master 
			WHERE DATE_FORMAT(added_on,'%Y-%m-%d') = '".$config['date']."' AND
			sales_rentals = '".$config['lead_type']."'";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function getLeadByProperty(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		$rec 		= false;
		
		$start 		= 0;
		$per_page	= '';
		$property_id	= '';
		
		if($this->input->get_post('property_dd') == '')
		{
			if(isset($this->data['params']['property_id']))
			{
				if(isset($this->data['params']['property_id']))
				{
					$property_id	= $this->data['params']['property_id'];		
				}
				else
				{
					$property_id	= '';
				}
			}
			else
			{
				$property_id	= '';
			}
		}
		else
		{
			$property_id	= $this->input->get_post('property_dd');
		}
		
		$per_page 			= $this->input->get_post('per_page',true);	
		$sessionDataArray		= array();
		$sessionDataArray['page']	= $page;		
		$sessionDataArray['per_page'] 	= $per_page;
		$sessionDataArray['property_id']= $property_id;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		$start 	= 0;
		
		if($property_id != '')
		{
			$sql = "SELECT em.enquiry_id
				FROM lp_enquiry_master AS em
				LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
				WHERE em.property_id = '".$property_id."'
				GROUP BY em.enquiry_id
				ORDER BY em.added_on DESC";
			
			$rs = $this->db->query($sql);		
			$config['total_rows'] = 0;
			
			$rec = $rs->result_array();
			$config['total_rows'] = sizeof($rec);
			
			if($page > 0 && $page < $config['total_rows'] )
				$start = $page;
			
			$config['start'] = $start;
			
			///////////
			$sql = "SELECT em.enquiry_id, em.contact_name, em.email_address, em.notes, em.added_on, COUNT(em.enquiry_id) AS CNT 
				FROM lp_enquiry_master AS em
				LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
				WHERE em.property_id = '".$property_id."'
				GROUP BY em.enquiry_id
				ORDER BY em.added_on DESC
				LIMIT ".$start.",".$config['per_page'];;
				
			$rs = $this->db->query($sql);
			
			if($rs->num_rows())
				$rec = $rs->result_array();
				
		}
		
		return $rec;
	}
	
	public function getTotalPropertyEnquiry(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		$rec 		= false;
		
		$start 		= 0;
		$per_page	= '';
		$property_id	= '';
		
		$per_page 			= $this->input->get_post('per_page',true);	
		$sessionDataArray		= array();
		$sessionDataArray['page']	= $page;		
		$sessionDataArray['per_page'] 	= $per_page;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		$start 	= 0;
		
		$sql = "SELECT COUNT( em.property_id ) AS CNT, pm.property_name
			FROM lp_property_master AS pm
			LEFT JOIN lp_enquiry_master AS em ON pm.property_id = em.property_id
			GROUP BY pm.property_id
			ORDER BY CNT DESC";
			
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->result_array();
		$config['total_rows'] = sizeof($rec);
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		$sql1 = "SELECT COUNT( em.property_id ) AS CNT, pm.property_name
			FROM lp_property_master AS pm
			LEFT JOIN lp_enquiry_master AS em ON pm.property_id = em.property_id
			GROUP BY pm.property_id
			ORDER BY CNT DESC
			LIMIT ".$start.",".$config['per_page'];
			
		$rs1 = $this->db->query($sql1);
		
		$rec1 = false;
		
		if($rs1->num_rows())
			$rec1 = $rs1->result_array();
			          
		return $rec1;
	}
	
	public function getTotalPropertyLead(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		$rec 		= false;
		
		$start 		= 0;
		$per_page	= '';
		
		$per_page 			= $this->input->get_post('per_page',true);	
		$sessionDataArray		= array();
		$sessionDataArray['page']	= $page;		
		$sessionDataArray['per_page'] 	= $per_page;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		$start 	= 0;
		
		$sql = "SELECT COUNT( em.property_id ) AS CNT, pm.property_name
			FROM lp_property_master AS pm
			LEFT JOIN lp_enquiry_master AS em ON pm.property_id = em.property_id
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY pm.property_id
			ORDER BY CNT DESC";
			
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->result_array();
		$config['total_rows'] = sizeof($rec);
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
			
		///////////////////////////////////////////////////////////////////////////////////////
		$sql1 = "SELECT COUNT( em.property_id ) AS CNT, pm.property_name
			FROM lp_property_master AS pm
			LEFT JOIN lp_enquiry_master AS em ON pm.property_id = em.property_id
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY pm.property_id
			ORDER BY CNT DESC
			LIMIT ".$start.",".$config['per_page'];
			
		$rs1 = $this->db->query($sql1);
		
		$rec1 = false;
		
		if($rs1->num_rows())
			$rec1 = $rs1->result_array();
			          
		return $rec1;
	}
	
	public function getTotalEnquiryByDate()
	{
		$sql = "SELECT COUNT(enquiry_id) AS CNT, DATE_FORMAT(added_on,'%Y-%m-%d') AS db_date
			FROM lp_enquiry_master
			GROUP BY DATE_FORMAT(added_on,'%Y-%m-%d')
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalLeadsByDate()
	{
		$sql = "SELECT COUNT(id) AS CNT, DATE_FORMAT(added_on,'%Y-%m-%d') AS db_date
			FROM lp_enquiry_lead
			GROUP BY DATE_FORMAT(added_on,'%Y-%m-%d')
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalEnquiryByLocation()
	{
		$sql = "SELECT COUNT( enquiry_id ) AS CNT, location
			FROM `lp_enquiry_master`
			GROUP BY location
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalLeadByLocation()
	{
		$sql = "SELECT COUNT(el.enquiry_id) AS CNT, location
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY em.location
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalEnquiryByRegion()
	{
		$sql = "SELECT COUNT( enquiry_id ) AS CNT, country
			FROM `lp_enquiry_master`
			GROUP BY country
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getTotalLeadByRegion()
	{
		$sql = "SELECT COUNT(el.enquiry_id) AS CNT, country
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY em.country
			LIMIT 0,1";
			
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getAveResponseTime(&$config,&$start)
	{
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		$rec 		= false;
		
		$start 		= 0;
		$per_page	= '';
		
		$per_page 			= $this->input->get_post('per_page',true);	
		$sessionDataArray		= array();
		$sessionDataArray['page']	= $page;		
		$sessionDataArray['per_page'] 	= $per_page;
		
		if($per_page)
			$config['per_page'] 	= $per_page;
		$config['page'] = $page;
		
		$this->session->set_userdata('REPORTS', $sessionDataArray);		
		$start 	= 0;
		
		$sql = "SELECT em.enquiry_id
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY el.enquiry_id
			ORDER BY em.enquiry_id";
			
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->result_array();
		$config['total_rows'] = sizeof($rec);
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
			
		/////
		$sql1 = "SELECT em.enquiry_id, em.contact_name, em.added_on as enquiry_date, el.added_on as lead_date,
			DATEDIFF(el.added_on, em.added_on) as date_diff
			FROM lp_enquiry_master AS em
			LEFT JOIN lp_enquiry_lead AS el ON em.enquiry_id = el.enquiry_id
			GROUP BY el.enquiry_id
			ORDER BY em.enquiry_id
			LIMIT ".$start.",".$config['per_page'];
			
		$rs1 = $this->db->query($sql1);
		
		$rec1 = false;
		
		if($rs1->num_rows())
			$rec1 = $rs1->result_array();
			          
		return $rec1;
	}
	
	public function getPropertySearchByEnquiryId($enquiry_id)
	{
		$sql = "SELECT property_info, search_info FROM ".$this->propertyVisited." WHERE enquiry_id = '".$enquiry_id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function deleteBatchEnquiry(){
		$error		= false;
		$apply_action	= $this->input->get_post('group_mode');
		$pagearray	= $this->input->get_post('page');
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($apply_action)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){
			if($apply_action == 'Delete'){
				$sql = "DELETE FROM ".$this->enquiryMaster." WHERE FIND_IN_SET(enquiry_id, '".implode(",", $pagearray)."')";
				$this->db->query($sql);
				return 'delsuccess';
			}
		}
	}
	
	public function changeEnquiryRead($id)
	{
		$sql = "UPDATE ".$this->enquiryMaster." SET enquiry_read = 'Read' WHERE enquiry_id = '".$id."'";
		$this->db->query($sql);
		return true;
	}
	
	public function getValue_condition($table,$fields,$condition)
	{
		if($fields=='')
			$sql = "SELECT * FROM  ".$table." WHERE " .$condition." LIMIT 1";
		else
			$sql = "SELECT ".$fields." FROM  ".$table." WHERE " .$condition." LIMIT 1";
			//echo $sql;
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();
		return $rec;
		
	}
}


