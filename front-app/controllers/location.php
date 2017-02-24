<?php


class Location extends MY_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
    }
        
    public function index(){
         $this->templatelayout->make_seo();
        $this->templatelayout->get_header('home');
        //$this->templatelayout->get_banner('home');
        $this->templatelayout->get_footer();
        $this->data= '';
        $this->elements['middle']	= 'location/index';			
        $this->elements_data['middle'] 	= $this->data;
                    
        $this->layout->setLayout('landingpage_layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
}



?>