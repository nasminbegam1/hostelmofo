<?php
class Test extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
     
       
    }
    
    public function index()
    {
        chk_login();
        $this->data='';
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='cms/test';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
}
?>