<?php

class Model_sitemap extends CI_Model{
    
    public function getDetails(){
        
        
        $record= array();
        
           $str ='SELECT PM.property_slug,PM.property_name,PT.property_type_slug,PP.province_slug,PC.city_seo_slug FROM  '.PROPERTY_MASTER.' AS PM '
                  .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                  .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                  .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                  .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id'
                  .' WHERE PM.status = "Active" ';
           
            $query = $this->db->query($str);
           
           
            if($query->num_rows()>0){
                $record=$query->result_array();
                
            }
            return $record;
        }
}   
?>