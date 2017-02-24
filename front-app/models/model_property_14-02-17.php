<?php

class Model_property extends CI_Model{
    
    public function getPropertyDetails($property_slug,$type='active'){
        
        
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
    
    public function getSimilarProperty($property_id){
         $str ='SELECT PM.*,PT.property_type_name,PT.property_type_slug,PD.*,PP.province_name,PP.province_slug,PC.city_name,PC.city_slug,PC.city_seo_slug FROM  '.PROPERTY_MASTER.' AS PM '
                  .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                  .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                  .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                  .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
                  .' WHERE PM.property_master_id = "'.$property_id.'" AND PM.status="Active"';

        $query = $this->db->query($str);
        $data = $query->row_array();
         $result =array();
       if($query->num_rows() > 0){
        $str = 'SELECT PM.* ,PD.address,PD.address2, PD.zip_code, PD.city_id, PD.province_id,PC.city_name,PC.city_slug,PC.city_seo_slug FROM  '.PROPERTY_MASTER.' AS PM '
               . ' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PM.property_master_id = PD.property_id '
               . ' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
               . ' WHERE (PD.city_id = "'.$data['city_id'].'" AND PD.province_id = "'.$data['province_id'].'" AND PM.property_type_id="'.$data['property_type_id'].'") AND PM.property_master_id!="'.$property_id.'" AND PM.status="Active" Limit 0,2';
               
        $query1= $this->db->query($str);
        //pr($query1->result_array());
       
        foreach($query1->result_array() as $d){
            $result[ $d['property_master_id'] ] = $d;
            $this->db->where('property_id',$d['property_master_id']);
            $this->db->where('isDefault','Yes');
            $pq = $this->db->get(PROPERTY_ROOMPRICE);
            
            $result[ $d['property_master_id'] ]['price']='';
            if($pq->num_rows() > 0){
                $pdata = $pq->row_array();
                $result[ $d['property_master_id'] ]['price'] = $pdata;
            }
            
            
            $this->db->where('property_id',$d['property_master_id']);
            $this->db->where('featured_image','Yes');
            $iq = $this->db->get(PROPERTY_IMAGE);
            
            $result[ $d['property_master_id'] ]['featured_image']='';
            if($iq->num_rows() > 0){
                $idata = $iq->row_array();
                $result[ $d['property_master_id'] ]['featured_image'] = $idata;
            }
        }
       }
        
        //pr($result);
        return $result;
    }
    
    public function getMaxPriceBypropertyType($type=array()){
        $max_price =0;
        if(count($type)>0){
            $type_str = implode(',',$type);
             $str ="SELECT MAX(PRP.daily_price) as max_price from ".PROPERTY_ROOMPRICE." AS PRP , ".PROPERTY_MASTER." AS PM where PM.property_master_id=PRP.property_id and PM.property_type_id IN(".$type_str.")";
             $query = $this->db->query($str);
             
             $record = $query->row_array();
             $max_price = $record['max_price'];
             
        }
        return $max_price;
        
        
    }
    
    
    
    public function getFavProperty($user_id){
        $str ='SELECT PM.*, PT.property_type_name, PT.property_type_slug, PD.*, PP.province_name, PP.province_slug,PC.city_name,
                PC.city_slug, PC.city_seo_slug, MF.id as favid
                FROM  '.PROPERTY_MASTER.' AS PM '
                  .' LEFT JOIN  '.MEMBERS_FAVOURITE.' AS MF ON PM.property_master_id=MF.property_id '
                  .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                  .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                  .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                  .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
                  .' WHERE MF.user_id = "'.$user_id.'" AND PM.status="Active"';

        $query = $this->db->query($str);
        $data = $query->result_array();
         $result =array();
       if($query->num_rows() > 0){
      
       
        foreach($data as $d){
            $result[ $d['property_master_id'] ] = $d;
            $this->db->where('property_id',$d['property_master_id']);
            $this->db->where('isDefault','Yes');
            $pq = $this->db->get(PROPERTY_ROOMPRICE);
            
            $result[ $d['property_master_id'] ]['price']='';
            if($pq->num_rows() > 0){
                $pdata = $pq->row_array();
                $result[ $d['property_master_id'] ]['price'] = $pdata;
            }
            
            
            $this->db->where('property_id',$d['property_master_id']);
            $this->db->where('featured_image','Yes');
            $iq = $this->db->get(PROPERTY_IMAGE);
            
            $result[ $d['property_master_id'] ]['featured_image']='';
            if($iq->num_rows() > 0){
                $idata = $iq->row_array();
                $result[ $d['property_master_id'] ]['featured_image'] = $idata;
            }
            
            $f_str = 'SELECT FM.amenities_name FROM '.FACILITIES.' AS FM LEFT JOIN '.PROPERTY_FACILITIES.' AS PF ON FM.amenities_id = PF.facility_master_id WHERE PF.property_id="'.$d['property_master_id'].'" AND FM.amenities_status="active"';
                $f_query = $this->db->query($f_str);
                if($f_query->num_rows()>0){
                    $result[ $d['property_master_id'] ]['facilities'] = $f_query->result_array();
                }
            
            
            
            $feedback_str = 'SELECT FB.* FROM hw_feedback AS FB where FB.property_id="'.$d['property_master_id'].'" AND FB.status="Active"';
            $feedback_query = $this->db->query($feedback_str);
            if($feedback_query->num_rows() > 0){
                //$result[ $d['property_master_id'] ]['feedback'] = $feedback_query->result_array();
                
                $res = $feedback_query->result_array();
                $count = count($res);
                $output = 0;
                foreach ( $res as $r){
                    $output = $output + (($r['value_for_money']+$r['security']+$r['location']+$r['staff']+$r['atmosphere']+$r['cleanliness']+$r['facilities'])/ 7);
                }
                $final_review = $output / $count;
                $result[$d['property_master_id']]['rating'] = sprintf("%.1f", $final_review);
            }
            else{
                $result[$d['property_master_id']]['rating'] = 0;
            }
            
            $dorm_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$d['property_master_id'].'" AND ART.price_charge_type="per_person" AND ART.status="Active"';
                $dorm_query = $this->db->query($dorm_str);
                $dorm_res = array();
                if($dorm_query->num_rows() > 0){
                    $dorm_res = $dorm_query->result_array();
                    $result[$d['property_master_id']]['min_dorm'] = min( $dorm_res );
                }
                else{
                    $result[$d['property_master_id']]['min_dorm'] = 0;
                }
            
            
            $private_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$d['property_master_id'].'" AND ART.price_charge_type="per_night" AND ART.status="Active"';
                $private_query = $this->db->query($private_str);
                $private_res = array();
                if($private_query->num_rows() > 0){
                    $private_res = $private_query->result_array();
                    $result[$d['property_master_id']]['min_private'] = min( $private_res );
                }
                else{
                    $result[$d['property_master_id']]['min_private'] = 0;
                }
            
            
            $min_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$d['property_master_id'].'" AND ART.status="Active"';
            $min_qr = $this->db->query($min_str);
            $min_price = array();
            if($min_qr->num_rows() > 0){
                $min_price = $min_qr->result_array();
                $result[$d['property_master_id']]['min_price'] = min( $min_price );
            }
            else{
                $result[$d['property_master_id']]['min_price'] = 0;
            }
            
            
            
            
        }
       }
        
        //pr($result);
        return $result;
    }
    
    public function getSingleProperty($property_slug,$type='active'){
        
        
        $record= array();
        if($property_slug!=''){
           $str ='SELECT PT.property_type_slug,PP.province_slug,PC.city_slug,PC.city_seo_slug ,PM.property_slug FROM  '.PROPERTY_MASTER.' AS PM '
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
                $record = $query->row_array();
            }
            
        }
        //pr($record);
        return $record;
    }
    
    
    
    
    	
	public function check_coupon($code){
		$sql = "SELECT * FROM ".DISCOUNT_CODE." WHERE code = '".$code."' AND status = 'Active'";
		$res = $this->db->query($sql);
		$row = '';
		if($res->num_rows()>0)
		{
			$row = $res->row_array();
		}
		return $row;
	}
        
    public function checkAvailable($checkin,$checkout){
        $checkout = date('Y-m-d',strtotime(date("Y-m-d", strtotime($checkout)) . " -1 day"));
        $sql = "SELECT paymeny_id FROM hw_payment_info WHERE payment_status = 'Success' AND (('".$checkout."' >= check_in AND  '".$checkin."' <= check_out) OR ((check_in BETWEEN '".$checkin."'  AND  '".$checkout."') OR (check_out BETWEEN '".$checkin."'  AND  '".$checkout."'))) ";
        $res = $this->db->query($sql);        
        return $res->num_rows();
    }
    
    public function availableDate($checkin,$checkout,$property_id){
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
        $aud_price          = array();
        $j  = 0;
        for ( $i = $checkin; $i <= $checkout; $i = $i + 86400 ) {
            $chkdate = date( 'Y-m-d', $i );
            //$pp_str = "SELECT * FROM hw_agent_roomtype WHERE property_id='".$property_id."'";
            $pp_str = "SELECT HAR.id, HAR.type_name, HAR.room_type_master_id,HAR.base_price, HRM.roomtype_name, HRM.room_price_type, HRM.bathroom_option,HAR.size,HAR.no_of_rooms FROM hw_agent_roomtype AS HAR INNER JOIN hw_roomtype_master as HRM ON HRM.roomtype_id = HAR.room_type_master_id AND HRM.roomtype_status = 'Active'
        WHERE HAR.property_id = ".$property_id." ORDER BY HAR.room_type_master_id";
            $pp_query = $this->db->query($pp_str);
            if($pp_query->num_rows()>0){
                $pp_result=$pp_query->result_array();
                //pr($pp_result); exit;
                if(isset($pp_result) && is_array($pp_result) && count($pp_result)>0){
                    
                    foreach($pp_result as $res){
                        $db_availability = 0;
                        $price1                 = $res['base_price'];
                        $aud_price[$j][]        = $res['base_price'];
                        $price1                 = currentPrice1($res['base_price'],$currencySymbol,$currencyRate);
                        $room_type              = $res['id'];
                        $room_price_type        = $res['room_price_type'];
                        $room_price_type2[]     = $res['room_price_type'];
                        $size2[]                = $res['size'];
                        $room_type_master_id    = $res['room_type_master_id'];
                        $no_of_rooms            = $res['no_of_rooms'];
                        $size                   = $res['size'];
                        $sql                    = "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$room_type."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$chkdate."' ORDER BY roomtype_id";
                        //echo $sql; exit;
                        
                        $res = $this->db->query($sql);
                        $manipulated_availability = 0;
                        if($res->num_rows()>0){
                            $result             = $res->result_array();
                            $price3             = $result[0]['price'];
                            $aud_price[$j][]    = $result[0]['price'];
                            $price3             = currentPrice1($result[0]['price'],$currencySymbol,$currencyRate);
                            $price[$j][]        = round($price3);
                            //$available[$j][]    = $result[0]['available'];
                            $db_availability    = $result[0]['available'];;
                        }else{
                            $price[$j][]        = round($price1);
                            //$available[$j][]    = 0;
                            $db_availability    = 0;
                        }
                        //pr($result); exit;
                        
                        if($room_price_type == 'per_night'){ // checking of private room
                            $sql            =   "SELECT SUM(HBD.no_of_room) as total_room_booked FROM hw_payment_info as HPI INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$room_type." WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                            //echo $sql; exit;
                            $query          =   $this->db->query($sql);
                            $available_arr = '';
                            $available_arr  =   $query->result_array();
                            $avl_no_room = 0;
                            //if($available_arr[0]['total_room_booked'] >= $no_of_rooms  && $available_arr[0]['total_room_booked'] != ''){
                            //    $available[$j][]  = 0;
                            //}
                            //else{
                            //    $avl_no_room = $no_of_rooms - $available_arr[0]['total_room_booked'];
                            //    $available[$j][] = $avl_no_room * $size;
                            //}
                            if($db_availability > 0){
                                $available[$j][] = $db_availability;
                            }else{
                                $avl_no_room = $no_of_rooms - $available_arr[0]['total_room_booked'];
                                $available[$j][]  = $avl_no_room;
                            }
                            $total_room_booked[$j][] = $available_arr[0]['total_room_booked'];
                        }
                        else{
                            $sql            = "SELECT SUM(HBD.no_of_person) as total_person_booked,SUM(HBD.no_of_room) as total_room_booked FROM hw_payment_info as HPI INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$room_type."  WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                            $query          = $this->db->query($sql);
                            $available_arr  = $query->result_array();
                            $no_of_bed      = $no_of_rooms * $size;
                            
                            if($db_availability > 0){
                                $available[$j][] = $db_availability;
                            }else{
                                $available[$j][]  = $no_of_bed - $available_arr[0]['total_person_booked'];
                            }
                            
                            //pr($available[$j]);
                            //if($available_arr[0]['total_person_booked'] >= $no_of_bed  && $available_arr[0]['total_person_booked'] != '')
                            //    $available[$j][]  = 0;
                            //else
                            //    $available[$j][] = $no_of_bed - $available_arr[0]['total_person_booked'];
                            
                            
                            
                            
                            $total_room_booked[$j][] = $available_arr[0]['total_room_booked'];
                            
                        }
                     
                        $q = "SELECT * FROM hw_payment_info WHERE payment_status = 'Success' AND property_id = '".$property_id."' AND (agent_roomtype_ID LIKE '%,".$room_type."%' OR agent_roomtype_ID LIKE '%".$room_type.",%' OR agent_roomtype_ID=".$room_type.") AND '".$chkdate."'  between check_in AND DATE_ADD(check_out, INTERVAL -1 DAY)";
                        $response = $this->db->query($q);
                        if($response->num_rows()>0){
                            //date('d',strtotime($chkdate))
                            $bookday[$j][]  = $chkdate;
                            $dy             = $dy.date('d',strtotime($chkdate)).",";
                        }
                        else{
                            $bookday[$j][] = '';
                        }
                    }
                   
                }
            }
            
            $j++;
        }
        //pr($total_room_booked);
        $min_avl_bed = array();
        $a = array();
        //if(is_array($available) && count($available)>0){
        //    foreach($available as $index=>$av){
        //            
        //            $min_avl_bed[] = min($av);
        //        }
        //}
        
        if(is_array($available) && count($available)>0){
            $total_count = count($available[0]); $count=0;
            for($x=0; $x<$total_count;$x++){
                foreach($available as $index=>$av){
                    if(isset($av[$count]) || array_key_exists($count, $av)){
                        $total_count = count($av);
                        $a[$count][] =  $av[$count];      
                    }
                }
                $min_avl_bed[] = min($a[$count]);
                $count++;
            }
        }
        
        
        $final_array['bookday']         = $bookday;
        $final_array['price']           = $price;
        $final_array['aud_price']       = $aud_price;
        $final_array['available']       = $min_avl_bed;
        $final_array['room_price_type'] = $room_price_type2;
        $final_array['size']            = $size2;
        $final_array['currency_symbol'] = $this->nsession->userdata('currencySymbol');
        return json_encode($final_array);
        exit();
    }
    
    

    
    
    
    public function checkMinNight($checkin,$checkout,$property_id){
        $res = false;
        $sql = "SELECT from_date,to_date,night FROM ".PROPERTY_MINIMUMNIGHT." WHERE ((from_date BETWEEN '".$checkin."' AND '".$checkout."') OR (to_date BETWEEN '".$checkin."' AND '".$checkout."')) AND (from_date <>'".$checkin."' OR to_date <> '".$checkout."') AND property_id = ".$property_id."";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            $res = $query->row_array();
        }
        return $res;
    }
    
    
    public function getWalletBalance(){
        $res = '';
        $user_id = $this->nsession->userdata('USER_ID');
        if($user_id != ''){
           
            $sql = "SELECT SUM(if(debit_credit='cr',amount,0)) - SUM(if(debit_credit='dr',amount,0)) balance FROM ".WALLET." WHERE user_id=".$user_id."";
            $query = $this->db->query($sql);
            if($query->num_rows()>0)
            {
                $res = $query->row_array();
                $res = $res['balance'];
                if($res == ''){
                    $res = 0;
                }
            }else{
                $res = 0;
            }
        }else{
            $res = 0;
        }
        return $res;
    }
    public function existingDeal($property_id){
        $res = array();;
        $sql    = "SELECT deal_id,deal_name FROM ".DEALS." WHERE property_id=".$property_id." AND from_date >= '".date('Y-m-d')."' ";
        $query  = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $res = $query->result_array();
        }
        return $res;
    }
    public function getDealRoomType($deal_id){
        $sql = "SELECT room_type_id,room_type_value,DATEDIFF(to_date,from_date) AS DiffDate,price,to_date,from_date FROM ".DEALS."  WHERE deal_id = ".$deal_id."";
        $query  = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $res['deal'] = $query->row_array();
            $res['deal']['change_price'] = currentPrice($res['deal']['price'],$this->nsession->userdata('currencySymbol'),$this->nsession->userdata('currencyRate'));
            $res['deal']['currencySymbol'] = $this->nsession->userdata('currencySymbol');
            $room_type_id = explode(',',$res['deal']['room_type_id']);
            $room_type_value = explode(',',$res['deal']['room_type_value']);
            for($i=0;$i<count($room_type_id);$i++){
                $sql = "SELECT type_name,id FROM ".AGENT_ROOMTYPE." WHERE id = ".$room_type_id[$i]."";
                $query  = $this->db->query($sql);
                if($query->num_rows()>0){
                    $res[$i] = $query->row_array();
                    $res[$i]['room_type_value'] = $room_type_value[$i];
                    
                }
            }
        }
        return $res;
    }
    public function getBookedDeal($room_type_id,$no_of_person,$deal_id){
        $res = false;
        $sql = "SELECT from_date,to_date,DATEDIFF(to_date,from_date) AS DiffDate,price,deal_name,deal_id FROM ".DEALS." WHERE deal_id = ".$deal_id."";
        $query  = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $res['deal_details'] = $query->row_array();
        }
       
        for($i=0;$i<count($room_type_id);$i++){
            if($no_of_person[$i] != 0){
                $sql = "SELECT type_name,id FROM ".AGENT_ROOMTYPE." WHERE id = ".$room_type_id[$i]."";
                $query  = $this->db->query($sql);
                if($query->num_rows()>0){
                    $res['room_details'][$i] = $query->row_array();
                    $res['room_details'][$i]['room_type_value'] = $no_of_person[$i];
                    
                }
            }
        }
        return $res;
    }
    
    
        public function getGrpPropertyDetails($property_slug,$type='active'){
        
        
        $record= array();
        $record['price_charge_type_arr']= array();
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
                        $record['price_charge_type_arr'][$v['price_charge_type']][] = $v;
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

    
    public function getproperty($propertyid=''){
             
        //echo $sql = "SELECT
        //            GROUP_CONCAT(DISTINCT PM.property_master_id),
        //            GROUP_CONCAT(DISTINCT PF.facility_id),
        //            GROUP_CONCAT(DISTINCT FM.amenities_id),
        //            GROUP_CONCAT(PM.property_name)AS Property_Name,
        //            GROUP_CONCAT(SELECT bedrooms FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid))AS Bedrooms,
        //            GROUP_CONCAT(DISTINCT PM.guest)AS Guest,
        //            GROUP_CONCAT(FM.amenities_name) AS Facilities
        //            FROM hw_property_master AS PM
        //            LEFT JOIN hw_property_facilities AS PF ON PF.property_id = PM.property_master_id
        //            LEFT JOIN hw_facilities_master AS FM ON FM.amenities_id = PF.facility_master_id
        //            WHERE PM.property_master_id IN($propertyid)
        //            ORDER BY PM.property_name ASC";
        
        //$sql = "SELECT
        //        GROUP_CONCAT(DISTINCT PM.property_master_id) AS Property_ID,
        //        GROUP_CONCAT(DISTINCT PM.property_name)AS Property_Name,
        //        (SELECT GROUP_CONCAT(bedrooms)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Bedroom,
        //        (SELECT GROUP_CONCAT(beds)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Beds,
        //        (SELECT GROUP_CONCAT(guest)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Guest,
        //        (SELECT GROUP_CONCAT(service_fees)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Service_Fees,
        //        (SELECT GROUP_CONCAT(accept_contract)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Accept_Contract,
        //        (SELECT GROUP_CONCAT(avarage_rating)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Average_Rating,
        //        GROUP_CONCAT(FM.amenities_name) AS Facilities
        //        FROM hw_property_master AS PM
        //        LEFT JOIN hw_property_facilities AS PF ON PF.property_id = PM.property_master_id
        //        LEFT JOIN hw_facilities_master AS FM ON FM.amenities_id = PF.facility_master_id
        //        WHERE PM.property_master_id IN($propertyid)
        //        GROUP BY Facilities
        //        ORDER BY PM.property_name ASC";
        
        $sql = "SELECT
                GROUP_CONCAT(DISTINCT PM.property_master_id) AS Property_ID,
                GROUP_CONCAT(PM.property_name)AS 'Property Name',
                (SELECT GROUP_CONCAT(bedrooms)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Bedroom,
                (SELECT GROUP_CONCAT(beds)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Beds,
                (SELECT GROUP_CONCAT(guest)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Guest,
                (SELECT GROUP_CONCAT(service_fees)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Fees,
                (SELECT GROUP_CONCAT(accept_contract)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Contract,
                (SELECT GROUP_CONCAT(avarage_rating)FROM hw_property_master AS PM WHERE PM.property_master_id IN($propertyid)) AS Rating
                FROM hw_property_master AS PM
                WHERE PM.property_master_id IN($propertyid)
                ORDER BY PM.property_name ASC";
        
        $query  = $this->db->query($sql);
        if($query->num_rows()>0){
            $record = $query->row_array();
        }
       
        //pr($record,0);
       
       
        $sql2 = "SELECT GROUP_CONCAT(DISTINCT PF.property_id) AS PropertyID,
                GROUP_CONCAT(DISTINCT FM.amenities_name) AS FacilityName
                FROM hw_property_facilities AS PF
                LEFT JOIN hw_property_master AS PM ON PM.property_master_id = PF.property_id
                LEFT JOIN hw_facilities_master AS FM ON FM.amenities_id = PF.facility_master_id
                WHERE PF.property_id IN($propertyid)
                GROUP BY PF.facility_master_id
                ORDER BY PF.property_id";
       
       
        $query2  = $this->db->query($sql2);
        if($query2->num_rows()>0){
            $record2 = $query2->result_array();
        }

        //pr($record2,0);
        
        
        for($i=0;$i<count($record2);$i++){
            
            
            $newArr[$record2[$i]['FacilityName']] = $record2[$i]['PropertyID']; 
        }
        
        $arr = array();
        $arr = array_merge($record,$newArr);
        
        //pr($arr);
        //die();
        return $arr;
    }
    
    
    
    public function compareProperty($propertyids){
        
        
        
        $propertyid = explode(',',$propertyids);
         $i = 0;
        foreach( $propertyid as $pid){
            $sql = "SELECT PM.property_name,PM.property_master_id,PD.latitude, PD.longitude FROM  hw_property_master AS PM JOIN hw_property_details as PD ON PM.property_master_id = PD.property_id  WHERE PM.property_master_id=".$pid;
            $query  = $this->db->query($sql);
            if($query->num_rows()>0){
                $record['prop'][$i] = $query->row_array();
            }
        
        
        //foreach( $propertyid as $pid){
            $feedback_str = "SELECT FB.* FROM hw_feedback AS FB where FB.property_id = ". $pid. " AND FB.status='Active'";
            $feedback_query = $this->db->query($feedback_str);
            if($feedback_query->num_rows() > 0){
                $rec = $feedback_query->result_array();
                $count = count($rec);
                $output = 0;
                foreach ( $rec as $r){
                    $output = $output + (($r['value_for_money']+$r['security']+$r['location']+$r['staff']+$r['atmosphere']+$r['cleanliness']+$r['facilities'])/ 7);
                }
                $rating = $output/$count;
                $record['feed'][$i] = sprintf("%.1f", $rating);
            }
            else{
                $record['feed'][$i] = 0;
            }
            
            $sql3  = "SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id = ". $pid. " AND ART.price_charge_type='per_night' AND ART.status='Active'";
            $query3 = $this->db->query($sql3);
            $private = 0;
            if($query3->num_rows() > 0){
                $private = $query3->result_array();
                $record['private'][$i] = min( $private );
            }
            else{
                $record['private'][$i] = 0;
            }
            
            
            $sql4  = "SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id = ". $pid. " AND ART.price_charge_type='per_person' AND ART.status='Active'";
            $query4 = $this->db->query($sql4);
            $dorm = 0;
            if($query4->num_rows() > 0){
                $dorm = $query4->result_array();
                $record['dorm'][$i] = min( $dorm );
            }
            else{
                $record['dorm'][$i] = 0;
            }
            
            
        $i++;
        }
        
        $facilities = "SELECT FM.* FROM  hw_facilities_master AS FM  WHERE FM.amenities_status= 'active'";
        $facilities_query = $this->db->query($facilities);
        if($facilities_query->num_rows() > 0){
            $fac = $facilities_query->result_array();
            
            foreach ($fac as $k=>$f){
                $record['name'][$k]['facility_name'] = $f['amenities_name'];
                //$facility_count = ;
                foreach($propertyid as $j=>$proid){
                    $prop_fac = "SELECT PF.* FROM  hw_property_facilities AS PF  WHERE PF.facility_master_id=".$f['amenities_id']." AND PF.property_id=".$proid;
                    $prop_fac_query = $this->db->query($prop_fac);
                    //if($prop_fac_query->num_rows() > 0){
                    
                        $record['name'][$k]['facility_count'][$j] = $prop_fac_query->num_rows();
                    //}
                }
            }
            
        }
        
        return $record;
    
    }
    
    public function getAvailabilityPrice($room_type_id,$property_id,$date)
    {
       $sql = "SELECT price,available FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$room_type_id."' AND date = '".$date."'";
        $rs = $this->db->query($sql);
        if($rs->num_rows() > 0)
        {
            $rw = $rs->row_array();
            //pr($rw,0);
            $result['price'] = $rw['price'];
            $result['available'] = $rw['available'];
        }
        else
        {
            $result['price'] = 0;
            $result['available'] = 0;
        }
        
        return $result;
        
    }
    
    
    public function getPropertyFacility($propertyID){
        $sql = "SELECT GROUP_CONCAT( DISTINCT FM.amenities_name separator ', ') as amenities_name ,GROUP_CONCAT(FM.amenities_slug separator ', ') as amenities_slug, FC.featured_category_name,FC.featured_category_slug, PF.property_id FROM ".PROPERTY_FACILITIES." AS PF INNER JOIN ".FACILITIES." AS FM ON FM.amenities_id = PF.facility_master_id INNER JOIN ".FEATURED_CATEGORY." AS FC ON FC.featured_category_id = FM.category_id WHERE PF.property_id =" .$propertyID." GROUP BY FC.featured_category_name";
        //echo $sql;
        $rs = $this->db->query($sql);
        if($rs->num_rows() > 0){
            $result = $rs->result_array();
        }
        else{
            $result = 0;
        }
        return $result;
    }
    
    
    public function getGroupId($slug)
    {
        $sql = "SELECT id FROM hw_groupType WHERE slug = '".$slug."'";
        $rs = $this->db->query($sql);
        $id = '';
        if($rs->num_rows() > 0){
            $result = $rs->row_array();
            $id = $result['id'];
        }
        return $id;
    }
    
        public function availableGrpDate($checkin,$checkout,$property_id,$groupType,$ageGroup){
            $checkin            = strtotime($checkin);
            $checkout           = strtotime(date("Y-m-d", strtotime($checkout)) . " -1 day");
            $currencySymbol     = $this->nsession->userdata('currencySymbol');
            $currencyRate 	= $this->nsession->userdata('currencyRate');
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
                //pr($grp_age_result);
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
                    //return json_encode($final_array);
                    //exit();
                    return $final_array;
                    exit();
                }
                $final_array['type']         = 'error';
                $final_array['message']      = 'This property does not accept group bookings containing people in one or more of the age ranges you have chosen. ';
                //echo json_encode($final_array);
                //exit();
                return $final_array;
                exit();
            }
            $final_array['type']         = 'error';
            $final_array['message']      = 'This property does not accept group bookings containing people in one or more of the age ranges you have chosen. ';
            //echo json_encode($final_array);
            //exit();
            return $final_array;
        exit();
    }
    
    
}

?>
