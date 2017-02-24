<?php
class Cron extends MY_Controller{    
   
    public function __construct(){
        parent:: __construct();
    }
    
    public function check_featured()
    {
	$current_date	=	date('Y-m');
	$property_list	=	$this->model_basic->getValues_conditions('hw_property_master',array('property_master_id'));
	foreach($property_list as $v)
	{
	    $is_featured	=	$this->model_basic->getValues_conditions('hw_featured_payment',array('property_id'),'',' property_id = '.$v['property_master_id'].' AND month_registerd_for = '.$current_date.'-01');
	    if(is_array($is_featured) && COUNT($is_featured)>0)
	    {
		$idArr		=	array(
				      'property_master_id' => $v['property_master_id']
				      );
		$updateArr	=	array(
				      'is_featured' => 'Yes'
				      );
		$this->model_basic->updateIntoTable('hw_property_master', $idArr, $updateArr);
	    }
	    else
	    {
		$idArr		=	array(
				      'property_master_id' => $v['property_master_id']
				      );
		$updateArr	=	array(
				      'is_featured' => 'No'
				      );
		$this->model_basic->updateIntoTable('hw_property_master', $idArr, $updateArr);
	    }
	}
	echo "Success";exit;
    }

   
}
?>