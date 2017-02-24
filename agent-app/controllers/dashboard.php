<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$this->load->model('model_basic');
		$this->load->model('model_agent');
		$this->chk_login();
		$this->data = "";
		
		
		$brd_arr[] = array('link'=>base_url(), 'text' => 'Home','icon_class'=>'fa-home' );
		$brd_arr[] = array('link'=>base_url('dashboard'), 'text' => 'Dashboard' );
		$this->data['breadcrumbs'] = $brd_arr;
		$this->data['total_property'] 		= $this->model_basic->isRecordExist('hw_property_master',"agent_id = '".$this->current_user['agent_id']."'");
		$this->data['total_enquiry']  		= $this->model_agent->getEnquryCount();
		$this->data['total_booked_property']   	= $this->model_agent->totalBookedProperty('bs_salon_users',"users_status = 'Active'");
		$this->templatelayout->get_footer();
		$this->templatelayout->get_header();
		$this->templatelayout->get_sidebar('dashboard');
		$this->elements['middle'] = 'dashboard/index';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
