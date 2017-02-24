<?php

class Error extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
            
            $this->templatelayout->make_seo();
            $this->templatelayout->get_header();
            $this->templatelayout->get_landingbanner();
            $this->templatelayout->get_footer();
            $this->data= '';
            $this->elements['middle']	= 'error/404';			
            $this->elements_data['middle'] 	= $this->data;
                        
            $this->layout->setLayout('landingpage_layout');
            $this->layout->multiple_view($this->elements,$this->elements_data);
      }
}

?>