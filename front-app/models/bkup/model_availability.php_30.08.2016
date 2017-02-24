    <?php

class Model_availability extends CI_Model{
    
    public function availabilityDetails($property_id=''){
           /* PROPERTY AVAILABILTY */
        $record= array();
        
        if($property_id!=''){
            $str ='SELECT PM * FROM hw_availibility
            WHERE PM.property_id = "'.$property_id.'" ';
            $query = $this->db->query($str);
        if($query->num_rows()>0){
            $record['availability']=$query->row_array();
            $roomtype_id    =  $record['availability']['roomtype_id'];
        
        /* ROOM TYPE DETAILS */
        
        $record['roomtypeDetails']= array();
        
        $f_str = 'SELECT PM * FROM hw_roomtype_master
        WHERE PM.roomtype_id = "'.$roomtype_id.'" ';
        $f_query = $this->db->query($f_str);
        if($f_query->num_rows()>0){
        $record['roomtypeDetails'] = $f_query->result_array();
        }
        
        }
        pr($record);
        return $record;
    }
}
}
?>