<?php

class Rantel_3 extends CI_Controller{
    
    var $propertyMasterTable	= 'lp_property_master';
    var $rentMasterTable		= 'lp_rent_master';
    
    public function __construct(){
        
        parent::__construct();
        $this->load->model('model_rentals');
        
    }
    
    
    public function payment()
    {
		chk_login();
                
		$property_id	            = $this->uri->segment(3,0);
		$page		            = $this->uri->segment(4,0);
		
                $conditions	            = "property_id = '".$property_id."'";
                
		$arr_property	            = $this->model_basic->getValues_conditions($this->propertyMasterTable, '*', '', $conditions);  // PROPERTY RECORD
		
                $arr_property_rent          = $this->model_basic->getValues_conditions($this->rentMasterTable, '*', '', $conditions); // RENTAL RECORD
                if(is_array($arr_property)){
                    $arr_property=$arr_property[0];
                }
                if(is_array($arr_property_rent)){
                    $arr_property_rent=$arr_property_rent[0];
                }
                $this->data['arr_property'] = $arr_property;
		$this->data['arr_property_rent'] = $arr_property_rent;
		$this->data['action_url']=BACKEND_URL.$this->router->class."/payment/".$property_id;
                $this->data['redirect_url'] =BACKEND_URL.$this->router->class."/payment/".$property_id ;
                $this->data['next_url'] =BACKEND_URL.$this->router->class."/payment/".$property_id ;
                $this->data['previous_url'] =BACKEND_URL.$this->router->class."/payment/".$property_id ;
                $this->data['tabs'] = $this->load->view('rentals_tab',array('select_tab'=>'contact'),true);
		
		if($this->input->get_post('action') == 'Process'){
			
                        $deposit_percent	 = stripslashes( trim ( $this->input->post( 'deposit_percent')));
                        $deposit_min_days  	 = stripslashes( trim ( $this->input->post( 'deposit_min_days')));
                        $final_payment_days	 = stripslashes( trim ( $this->input->post( 'final_payment_days')));
                        $booking_status	 	 = stripslashes( trim ( $this->input->post( 'booking_status')));
                        
                        $payment_update_arr = array(
                                                  "deposit_percent"		  => $deposit_percent,
                                                  "deposit_min_days" 		  => $deposit_min_days,
                                                  "final_p_days_before_arrival"   => $final_payment_days,
                                                  "booking_status"		  => $booking_status
                                                  );
                      
                        $idArr = array(
                                        "property_id"	=> $property_id
                                        );
                        
				
				
			$note_update = $this->model_basic->updateIntoTable($this->rentMasterTable ,$idArr, $payment_update_arr);
                        
			$this->nsession->set_userdata('succmsg', "Successfully Completed");

                        
                        if($this->input->post("submit")=="Next"){
                          redirect($this->data['next_url']);
                          //return false;
                        }
                        else if($this->input->post("submit")=="Previous"){
                          redirect($this->data['previous_url']);
                          //return false;
                        }
			//
			
		}

		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->data['errmsg'] = $this->nsession->userdata('errmsg');
                $this->nsession->set_userdata('succmsg', "");
                $this->nsession->set_userdata('errmsg', "");
                
                $this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
                
                $this->elements['middle']='rentals/edit_payment';			
                $this->elements_data['middle'] = $this->data;			    
                $this->layout->setLayout('layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
}


?>