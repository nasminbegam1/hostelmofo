<?php

class Model_grpproperty extends CI_Model{
    
        public function availableGrpDate($checkin,$checkout,$property_id,$groupType,$ageGroup){
            $checkin            = strtotime($checkin);
            $checkout           = strtotime(date("Y-m-d", strtotime($checkout)) . " -1 day");
            $currencySymbol     = $this->nsession->userdata('currencySymbol');
            $currencyRate 	    = $this->nsession->userdata('currencyRate');
            $bookday            = array();
            $price              = array();
            $available          = array();
            $room_price_type    = array();
            $size               = array();
            $dy                 = '';
            $final_array        = array();
            $j                  = 0;
           
            $pp_str             = "SELECT HAR.id, HAR.type_name, HAR.room_type_master_id,HAR.base_price, HRM.roomtype_name, HRM.room_price_type, HRM.bathroom_option,HAR.size,HAR.no_of_rooms FROM hw_agent_roomtype AS HAR
            INNER JOIN hw_roomtype_master as HRM ON HRM.roomtype_id = HAR.room_type_master_id AND HRM.roomtype_status = 'Active'
            WHERE HAR.property_id = ".$property_id;
            
            
            $pp_query = $this->db->query($pp_str);
            if($pp_query->num_rows()>0){
                $ageGroup = rtrim($ageGroup , ',');
                $ageGroupExp = explode(',',$ageGroup);
                $grp_age = "select count(*) as count from hw_property_grp_age where property_id=".$property_id." and group_id IN (".$groupType.") and age_type_id IN (".$ageGroup.")";
                $grp_age_query = $this->db->query($grp_age);
                $grp_age_result = $grp_age_query->row_array();
                
                $final_array['type']         = 'success';
                if(count($ageGroupExp) == $grp_age_result['count']){
                    
                    for ( $i = $checkin; $i <= $checkout; $i = $i + 86400 ) {
                        $chkdate = date( 'Y-m-d', $i );
                        
                            $pp_result=$pp_query->result_array();
                            if(isset($pp_result) && is_array($pp_result) && count($pp_result)>0){
                                
                                foreach($pp_result as $res){
                                    $aud_price[$j][]        = $price1   = $res['base_price'];
                                    $price1                 = currentPrice1($res['base_price'],$currencySymbol,$currencyRate);
                                    $room_type              = $res['id'];
                                    $room_price_type2[]     = $room_price_type = $res['room_price_type'];
                                    $size2[]                = $size = $res['size'];
                                    $room_type_master_id    = $res['room_type_master_id'];
                                    $no_of_rooms            = $res['no_of_rooms'];
                                    $sql                    = "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$room_type."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$chkdate."'";
                                    
                                    $res = $this->db->query($sql);
                                    if($res->num_rows()>0){
                                        $result                 = $res->result_array();
                                        $aud_price[$j][]    = $price3 = $result[0]['price'];
                                        $price3             = currentPrice1($result[0]['price'],$currencySymbol,$currencyRate);
                                        $price[$j][]        = round($price3);
                                    }else{
                                        $price[$j][]        = round($price1);
                                    }
                                    
                                    
                                    
                                    if($room_price_type == 'per_night'){
                                        $sql            =   "SELECT SUM(HBD.no_of_room) as total_room_booked FROM hw_payment_info as HPI INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$room_type." WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                                        $query          =   $this->db->query($sql);
                                        $available_arr  =   $query->result_array();
                                        if($available_arr[0]['total_room_booked'] >= $no_of_rooms  && $available_arr[0]['total_room_booked'] != ''){
                                            $available[$j][]  = 0;
                                        }
                                        else{
                                            $avl_no_room = $no_of_rooms - $available_arr[0]['total_room_booked'];
                                            $available[$j][] = $avl_no_room * $size;
                                        }
                                    }
                                    else{
                                        $sql            = "SELECT SUM(HBD.no_of_person) as total_person_booked,SUM(HBD.no_of_room) as total_room_booked FROM hw_payment_info as HPI INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$room_type."  WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                                        $query          = $this->db->query($sql);
                                        $available_arr  = $query->result_array();
                                        $no_of_bed      = $no_of_rooms * $size;
                                        if($available_arr[0]['total_person_booked'] >= $no_of_bed  && $available_arr[0]['total_person_booked'] != '')
                                            $available[$j][]  = 0;
                                        else
                                            $available[$j][] = $no_of_bed - $available_arr[0]['total_person_booked'];
                                        
                                        
                                        
                                    }
                                    $total_room_booked[] = $no_of_rooms - $available_arr[0]['total_room_booked'];
                                    
                                    //$sql                        =   "SELECT SUM(HBD.no_of_room) as total_room_booked FROM hw_payment_info as HPI INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$room_type." WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                                    //$query                      = $this->db->query($sql);
                                    //$available_arr              = $query->result_array();
                                    //$avl_no_room                = $no_of_rooms - $available_arr[0]['total_room_booked'];
                                    //$total_room_booked[$j][]    = $avl_no_room;
                                        
                                    $q = "SELECT * FROM hw_payment_info WHERE payment_status = 'Success' AND property_id = '".$property_id."' AND (agent_roomtype_ID LIKE '%,".$room_type."%' OR agent_roomtype_ID LIKE '%".$room_type.",%' OR agent_roomtype_ID=".$room_type.") AND '".$chkdate."'  between check_in AND DATE_ADD(check_out, INTERVAL -1 DAY)";
                                    $response = $this->db->query($q);
                                    if($response->num_rows()>0){
                                        $bookday[$j][]  = $chkdate;
                                        $dy             = $dy.date('d',strtotime($chkdate)).",";
                                    }
                                    else{
                                        $bookday[$j][] = '';
                                    }
                                }
                               
                            }
                        
                        $j++;
                    }
                    $min_avl_bed = '';
                    $a = array();
                    if(is_array($available) && count($available)>0){
                        $total_count = count($available[0]); $count=0;
                        for($x=0; $x<$total_count;$x++){
                            foreach($available as $index=>$av){
                                if(isset($av[$count]) || array_key_exists($count, $av)){
                                    $total_count = count($av);
                                    $a[$count][] =  $av[$count];      
                                }
                            }
                            $min_avl_bed += min($a[$count]);
                            $count++;
                        }
                    }
                    
                    
                    $final_array['bookday']         = $bookday;
                    $final_array['price']           = $price;
                    $final_array['aud_price']       = $aud_price;
                    $final_array['available']       = $total_room_booked;
                    $final_array['min_avl_bed']     = $min_avl_bed;
                    $final_array['room_price_type'] = $room_price_type2;
                    $final_array['size']            = $size2;
                    $final_array['currency_symbol'] = $this->nsession->userdata('currencySymbol');
                    return json_encode($final_array);
                    exit();
                }
                $final_array['type']         = 'error';
                $final_array['message']      = 'This property does not accept group bookings containing people in one or more of the age ranges you have chosen. ';
                echo json_encode($final_array);
                exit();
                
            }
            $final_array['type']         = 'error';
            $final_array['message']      = 'This property does not accept group bookings containing people in one or more of the age ranges you have chosen. ';
            echo json_encode($final_array);
            exit();
    }

    
    
    
  
        public function getGrpPropertyDetails($property_slug,$type='active'){
        
        
        $record= array();
        if($property_slug!=''){
           $str ='SELECT PM.*,PT.property_type_name,PD.*,PT.property_type_name,PT.property_type_slug,PP.province_name,PP.province_slug,PC.city_name,PC.city_slug,PC.city_seo_slug FROM  '.PROPERTY_MASTER.' AS PM '
                  .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                  .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                  .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                  .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
                  .' WHERE PM.property_slug = "'.$property_slug.'" ';
                  
                  if($type=="active"){
                        $str .=" AND PM.status='Active'  ";
                  }

            $query = $this->db->query($str);
            if($query->num_rows()>0){
                $record['master_details']=$query->row_array();
                $property_id    =  $record['master_details']['property_master_id'];
                
                /* PROPERTY FACILITIES */
                
                $record['facilities']= array();
                
                $f_str = 'SELECT FM.amenities_id,FM.amenities_name,FM.amenities_slug,PF.property_id FROM '.FACILITIES.' AS FM LEFT JOIN '.PROPERTY_FACILITIES.' AS PF ON FM.amenities_id = PF.facility_master_id WHERE PF.property_id="'.$property_id.'" AND FM.amenities_status="active"';
                $f_query = $this->db->query($f_str);
                if($f_query->num_rows()>0){
                    $record['facilities'] = $f_query->result_array();
                }
                
                /* PROPERTY FACILITIES END */
                
                /* PROPERTY IMAGES */
                $record['images']= array();$record['featured_img']=array();
                $i_str = "SELECT PI.* FROM ".PROPERTY_IMAGE." AS PI WHERE PI.property_id='".$property_id."' order by PI.image_order ASC";
                $i_query = $this->db->query($i_str);
                if($i_query->num_rows()>0){
                    $record['images']=$i_query->result_array();
                    foreach($i_query->result_array() as $img){
                        if($img['featured_image']=='Yes'){
                            $record['featured_img'] = $img;
                        }
                    }
                }
                
                /* PROPERTY IMAGES END */
                
                /* PROPERTY POLICY */
                $record['policy']= array();
                $p_str = 'SELECT PP.*,PM.policies_name,PM.policies_slug FROM '.PROPERTY_POLICIES.' AS PP JOIN '.POLICY_MASTER.' AS PM ON PP.policy_master_id=PM.policies_master_id WHERE PP.property_id="'.$property_id.'"';
                $p_query = $this->db->query($p_str);
                if($p_query->num_rows()>0){
                    $record['policy']=$p_query->result_array();
                }
                
                /* PROPERTY POLICY END */
                
                
                 /* PROPERTY PRICE */
                $record['price']= array();
                //$pp_str = "SELECT PP.*,RM.roomtype_name,RM.room_price_type  FROM ".PROPERTY_ROOMPRICE." AS PP JOIN ".ROOMTYPE_MASTER." AS RM ON PP.room_type= RM.roomtype_id WHERE PP.property_id='".$property_id."' order by number_of_bed desc";
                $pp_str = "SELECT AR.*,RM.* FROM hw_agent_roomtype as AR INNER JOIN hw_roomtype_master RM WHERE AR.property_id='".$property_id."' AND AR.room_type_master_id=RM.roomtype_id";
                $pp_query = $this->db->query($pp_str);
                if($pp_query->num_rows()>0){
                    $record['price']=$pp_query->result_array();
                    
                    foreach($pp_query->result_array() as $k=>$v)
                    {
                        $booked_no = $this->model_basic->getValues_conditions('hw_booking_deatils',array('SUM(no_of_room)'),'','room_type = '.$v['id']);
                        $record['price'][$k]['no_of_booked'] = $booked_no[0]['SUM(no_of_room)'];
                        
                    }                    
                }
                
                //pr($record['price']);
                /* PROPERTY PRICE END */
                
                 /* PROPERTY REVIEWS */
                $record['reviews']= array();
                $r_str = "SELECT PR.* FROM ".REVIEW_MASTER." AS PR WHERE PR.property_id='".$property_id."' ";
                $r_query = $this->db->query($r_str);
                if($r_query->num_rows()>0){
                    $record['reviews']=$r_query->result_array();
                }
                
                /* PROPERTY REVIEWS END */
                
                 $record['fav_status'] ='No';
                if($this->nsession->userdata('USER_ID')!=''){
                    $user_id = $this->nsession->userdata('USER_ID');
                    $this->db->where('property_id',$property_id);
                    $this->db->where('user_id',$user_id);
                    $fav_query = $this->db->get(MEMBERS_FAVOURITE);
                    if($fav_query->num_rows()>0){
                        $record['fav_status'] = 'Yes';
                    }
                }
                
                
                
            }
            
        }
        //pr($record);
        return $record;
    }

}

?>