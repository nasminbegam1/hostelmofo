<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of templatelayout
 */
class templatelayout {
     
     var $obj;
    
     public function __construct()
     {
        $this->obj =& get_instance();
     }

     public  function get_footer()
     {
	  $this->footer = '';
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }
     
     public  function get_header()
     {
	  $this->header = '';
	  $this->obj->elements['header']='layout/header';
	  $this->obj->elements_data['header'] = $this->header;
     }
     public  function get_sidebar($menu = 'dashboard')
     {
	  
	  $this->sidebar['menu'] = $menu;
	  $this->obj->elements['sidebar']='layout/sidebar';
	  $this->obj->elements_data['sidebar'] = $this->sidebar;
     }
     
     

}
?>