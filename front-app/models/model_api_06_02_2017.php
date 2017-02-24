<?php
class Model_api extends CI_Model{
    
    public function getFavouriteDetails($uid,$currency=''){
        $record= array();
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        $currencyArr            = $this->model_basic->getValues_conditions('hw_currency_master','','','currency_code = "'.$currency.'"', $OrderBy='', $OrderType='', $Limit=0);
        $currencyRate   	= $currencyArr[0]['currency_rate'];
        
        $str ='SELECT PM.property_master_id,PM.property_name,PM.property_slug,PM.property_type_id,PM.bedrooms,PM.beds,PM.room_type,PM.facilities,PD.address,PD.address2,PT.property_type_name,PD.province_id,PD.zip_code,PD.city_id,PD.brief_introduction,PD.latitude,PD.longitude,PC.city_name,PC.city_seo_slug,PP.province_name,PP.province_slug,PT.property_type_name,PT.property_type_slug
                FROM  '.PROPERTY_MASTER.' AS PM '
                  .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                  .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                  .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                  .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
                  .'INNER JOIN ' . MEMBERS_FAVOURITE . ' AS MF ON MF.property_id = PM.property_master_id'
                  .' WHERE MF.user_id = "'.$uid.'" ';                  
                  

        $query = $this->db->query($str);
           
        if($query->num_rows()>0){
            $record['master_details']=$query->result_array();
            for($k=0; $k<count($record['master_details']); $k++){
                $property_id    =  $record['master_details'][$k]['property_master_id'];
            
                /* PROPERTY FACILITIES */
                
                //$record['master_details'][$k]['facilities']= array();
                //
                //$f_str = 'SELECT FM.amenities_id,FM.amenities_name,FM.amenities_slug,PF.property_id FROM '.FACILITIES.' AS FM LEFT JOIN '.PROPERTY_FACILITIES.' AS PF ON FM.amenities_id = PF.facility_master_id WHERE PF.property_id="'.$property_id.'" AND FM.amenities_status="active" GROUP BY FM.amenities_id';
                //$f_query = $this->db->query($f_str);
                //if($f_query->num_rows()>0){
                //    $record['master_details'][$k]['facilities'] = $f_query->result_array();
                //}
                
                /* PROPERTY FACILITIES END */
                
                /* PROPERTY IMAGES */
                //$record['master_details'][$k]['images']= array();
                $record['master_details'][$k]['featured_img']=array();
                $i_str = "SELECT PI.* FROM ".PROPERTY_IMAGE." AS PI WHERE PI.property_id='".$property_id."' AND PI.featured_image = 'Yes' order by PI.image_order ASC";
                $i_query = $this->db->query($i_str);
                if($i_query->num_rows()>0){
                    //$record['master_details'][$k]['images']=$i_query->result_array();
                    foreach($i_query->result_array() as $img){
                        if($img['featured_image']=='Yes'){
                            $record['master_details'][$k]['featured_img'] = $img;
                        }
                    }
                }
                
                /* PROPERTY IMAGES END */
                
                /* PROPERTY POLICY */
                //$record['policy']= array();
                //$p_str = 'SELECT PP.*,PM.policies_name,PM.policies_slug FROM '.PROPERTY_POLICIES.' AS PP JOIN '.POLICY_MASTER.' AS PM ON PP.policy_master_id=PM.policies_master_id WHERE PP.property_id="'.$property_id.'"';
                //$p_query = $this->db->query($p_str);
                //if($p_query->num_rows()>0){
                //    $record['policy']=$p_query->result_array();
                //}
                
                /* PROPERTY POLICY END */
                
                
                 /* PROPERTY PRICE */
                 $record['master_details'][$k]['price']= array();
                //$pp_str = "SELECT PP.price_id,
                //PP.property_id,
                //PP.room_type,
                //(PP.daily_price*".$currencyRate.") as daily_price,
                //(PP.commission_price*".$currencyRate.") as commission_price,
                //PP.minimum_rental_days,
                //PP.isDefault,
                //PP.updated_on,
                //RM.roomtype_name,RM.room_price_type  FROM ".PROPERTY_ROOMPRICE." AS PP LEFT JOIN ".ROOMTYPE_MASTER." AS RM ON PP.room_type= RM.roomtype_id WHERE PP.property_id='".$property_id."' AND isDefault= 'Yes' order by number_of_bed desc LIMIT 1";
                
                $pp_str = "SELECT AR.id as price_id, AR.property_id, AR.base_price as daily_price, AR.room_type_master_id as room_type, RM.roomtype_name FROM hw_agent_roomtype as AR INNER JOIN hw_roomtype_master RM WHERE AR.property_id='".$property_id."' AND AR.room_type_master_id=RM.roomtype_id";
                
                $pp_query = $this->db->query($pp_str);
                if($pp_query->num_rows()>0){
                    $record['master_details'][$k]['price']=$pp_query->result_array();
                }
                /* PROPERTY PRICE END */
                
                 /* PROPERTY REVIEWS */
                 $record['master_details'][$k]['reviews']= array();
                $r_str = "SELECT PR.* FROM ".REVIEW_MASTER." AS PR WHERE PR.property_id='".$property_id."' ";
                $r_query = $this->db->query($r_str);
                $record['master_details'][$k]['reviews_count'] = $r_query->num_rows();
                if($r_query->num_rows()>0){
                    $sum_rating = 0;
                    foreach($r_query->result_array() as $v)
                    {
                        $sum_rating = $sum_rating+ $v['avarage_rating'];
                    }
                    $record['master_details'][$k]['avg_rating'] = floor($sum_rating/$r_query->num_rows());
                }
                else
                {
                    $record['master_details'][$k]['reviews_count']  =   0;
                    $record['master_details'][$k]['avg_rating']     =   0;
                }
                
                
                
                //if($r_query->num_rows()>0){
                //    $record['master_details'][$k]['reviews']=$r_query->result_array();
                //    $record['master_details'][$k]['reviews_count'] = $r_query->num_rows();
                //}else{
                //    $record['master_details'][$k]['reviews']=0;
                //    $record['master_details'][$k]['reviews_count'] =0;
                //}
                
                /* PROPERTY REVIEWS END */
            }
            
        } 
         //return $pp_str;   
        //pr($record);
        return $record;
    }
    
    public function propertygetlist($searchFrom = 'search',$currency='', $lcity = '', $lprovince='', $lproptype='',$logged_id = ''){
        
        $fav_arr    =   array();
        if($logged_id != '')
        {
            $fav_list = $this->model_basic->getValues_conditions('hw_members_favourite',array('property_id'),'','user_id = '.$logged_id);
            if(is_array($fav_list) && COUNT($fav_list)>0)
            {
                foreach($fav_list as $v)
                {
                    $fav_arr[]  =   $v['property_id'];
                }
            }
        }

        $siteCurrency		= $this->nsession->userdata('currencyCode');
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        $currencyArr            = $this->model_basic->getValues_conditions('hw_currency_master','','','currency_code = "'.$currency.'"', $OrderBy='', $OrderType='', $Limit=0);
         $currencyRate   	= $currencyArr[0]['currency_rate'];
        //echo $siteCurrency.'----'.$currencyRate; exit;
        
        $searchType		= $this->uri->segment(2, 0);
        $guest			= $this->input->get_post('guest', TRUE);
        $ptype			= $this->input->get_post('type', TRUE);
        $type_id		= $this->input->get_post('typeid', TRUE);
        $city			= $this->input->get_post('city', TRUE);
        $property		= $this->input->get_post('property', TRUE);
        $province		= $this->input->get_post('province', TRUE);
        $check_in		= $this->input->get_post('checkin', TRUE);       
        $check_out		= $this->input->get_post('checkout', TRUE);
        $min_price		= $this->input->get_post('minprice', TRUE);
        $max_price		= $this->input->get_post('maxprice', TRUE);
        $roomtype		= $this->input->get_post('roomtype', TRUE);
        $facilities		= $this->input->get_post('facilities', TRUE);
        $page			= $this->input->get_post('page', 0);
        $currency		= 'AUD'; 
        $way			= $this->input->get_post('way', TRUE);
        $sortby			= $this->input->get_post('sortby', TRUE);
        $perpage 	        = $this->input->get_post('perpage', TRUE);
        $userid 	        = $this->input->get_post('userid', TRUE);
        $gps_details 	        = explode('@@',$this->input->get_post('gps_details', TRUE));

        //PROPERTY_MASTER PM, PROPERTY_DETAILS PD, PROPERTY_ROOMPRICE PRP, PROPERTY_FACILITIES PF, CITY
        
        if($searchFrom = 'landing'){
            //echo "landing"; exit;
            if( isset($lcity) && $lcity != '')
                $city = $lcity;
            if( isset($lprovince) && $lprovince != '')
                $province = $lprovince;
            if( isset($lproptype) && $lproptype != '')
                $type_id = $lproptype;
        }
        $where = $whereprice = "  ";
        if(is_array($gps_details) && COUNT($gps_details)>0 && $gps_details[0] != '' )
        {
            if(isset($gps_details[0]))
            {
                $gps_city_slug  = $this->model_basic->getValue_condition('hw_city_master','city_slug','','city_name LIKE "%'.$gps_details[0].'%"');
                //echo $gps_city_slug;
                if($gps_city_slug!= '')
                    $where     .= "AND FIND_IN_SET('".$gps_city_slug."', CITY.city_slug)";
                else
                    $where     .= "AND FIND_IN_SET('".strtolower(str_replace(' ','_',$gps_city_slug))."', CITY.city_slug)";
            }
            if(isset($gps_details[1]))
            {
                $gps_province_id  = $this->model_basic->getValue_condition('hw_province_master','province_id','','province_name LIKE "%'.$gps_details[1].'%" OR province_short_code LIKE "%'.$gps_details[1].'%"');
                if($gps_province_id!= '')
                    $where .= " AND PD.province_id = ".$gps_province_id;
                else
                    $where .= " AND PD.province_id = 999";
            }
        }
        else
        {
            if( isset($city) && $city != ''){            
                $cityy = explode(',',$city);            
                if(is_array($cityy))
                {
                    if($cityy[0] == 'surfers-paradise-qld')
                    {
                        $cityy[1] = 'gold-coast-qld';
                    }
                }            
                if(is_array($cityy))
                {
                    if($cityy[0] == 'gold-coast-qld')
                    {
                        $cityy[1] = 'surfers-paradise-qld';
                    }
                }           
                $where_city = array();
                foreach($cityy as $c){
                        if($c != '') {
                                $where_city[] = " FIND_IN_SET('".$c."', CITY.city_slug) "  ;
                        }
                }            
                $wherecity = implode(' OR ',$where_city);
                $where .= " AND (".$wherecity.") ";   
            }

            if( isset($province) && $province != ''){			
                $provincedata	= $this->model_basic->getFromWhereSelect(PROVINCE_MASTER.' PRV ', 'province_id', ' province_slug = "'.$province.'" ');
                if( $provincedata && is_array($provincedata) ){
                        $province_id 		= $provincedata[0]['province_id'];
                        $where .= " AND PD.province_id = ".$province_id." ";
                }
            }
        }

        if( isset($type_id) && $type_id != ''){
            $where .= " AND PM.property_type_id IN (".$type_id.") ";
        }
        
        if( isset($guest) && $guest != '' && $guest != 'undefined'){
            $where .= " AND PM.guest >= ".$guest;
        }
        
        if( isset($roomtype) && $roomtype != ''){
            $whereprice .= "  ";
            //$whereprice .= " AND PR.room_type IN ( ".$roomtype." ) ";
            $room = explode(',',$roomtype);
            $where_ame = array();
            foreach($room as $r){
                    if($r != '') {
                            $where_ame[] = " FIND_IN_SET('".$r."', PM.room_type) "  ;
                    }
            }
            
            $whereame = implode(' OR ',$where_ame);
            $where .= " AND (".$whereame.") ";
        } else {
            //$whereprice .= " AND PR.isDefault = 'Yes' ";
        }

        
        if( isset($facilities) && $facilities != ''){
            $fac = explode(',',$facilities);
            $where_fac = array();
            foreach($fac as $r){
                    if($r != '') {
                            $where_fac[] = " FIND_IN_SET('".$r."', PM.facilities) "  ;
                    }
            }
            
            $whereame = implode(' OR ',$where_fac);
            $where .= " AND (".$whereame.") ";            
        }
        
        
        if( isset($min_price) && $min_price != ''){
            if($min_price > 0)
                $tmin = ($min_price / $currencyRate) ;
            else
                $tmin = 0 ;
            $whereprice .= " AND PR.base_price >= ".$tmin." ";
        }
        
        if( isset($max_price) && $max_price != ''){
            $tmax = ($max_price / $currencyRate) ;
            if($max_price > 0){
                $whereprice .= " AND PR.base_price <= ".$tmax." ";
            }
        }
        
        $sort_sql   =  " ORDER BY PM.property_name ASC";
        
        $sort_price =  " ORDER BY PR.base_price ASC";
        if($sortby == "name-az"){
            $sort_sql =  " ORDER BY PM.property_name ASC";
        }elseif($sortby == "name-za"){
            $sort_sql =  " ORDER BY PM.property_name DESC";
        }else if($sortby == "price-asc"){
            $sort_price = " ORDER BY PR.base_price ASC";
        }elseif($sortby == "price-desc"){
            $sort_price = " ORDER BY PR.base_price DESC";
        }
        //PROPERTY_MASTER PM, PROPERTY_DETAILS PD, PROPERTY_ROOMPRICE PRP, PROPERTY_FACILITIES PF, CITY
        $sql = "SELECT COUNT(F.feedback_id) AS feedback_count, ROUND(((SUM(F.value_for_money)+ SUM(F.security)+ SUM(F.location)+ SUM(F.staff)+ SUM(F.atmosphere)+ SUM(F.cleanliness)+ SUM(F.facilities))/(COUNT(F.feedback_id)*5*7))*100) totalFeedback,PM.property_master_id as property_id, PM.property_name, PM.property_slug, PM.property_type_id, PM.property_master_id, PM.bedrooms, PM.beds, PM.room_type, PM.facilities,PD.address, PD.address2, PD.province_id, PD.zip_code, PD.city_id, PD.brief_introduction, PD.latitude, PD.longitude,CITY.city_name, CITY.city_seo_slug, PI.image_name, PR.province_name, PR.province_slug,PT.property_type_name, PT.property_type_slug 
                FROM ".PROPERTY_MASTER." PM  
                INNER JOIN ".PROPERTY_DETAILS." PD ON PM.property_master_id = PD.property_id
                INNER JOIN ".PROPERTY_TYPE." PT ON PM.property_type_id = PT.property_type_id 
                INNER JOIN ".CITY." CITY ON PD.city_id = CITY.city_master_id
                INNER JOIN ".PROVINCE_MASTER." PR ON PR.province_id = PD.province_id 
                LEFT JOIN ".PROPERTY_IMAGE." PI ON PM.property_master_id = PI.property_id
                LEFT JOIN ".FEEDBACK." F ON F.property_id = PM.property_master_id
                WHERE PM.status = 'Active'
                AND PI.featured_image = 'Yes' AND PD.latitude != '' AND PD.longitude != '' 
                ".$where."                
                GROUP BY PM.property_master_id
                ".$sort_sql." ";
        /******************************************************************/
        //echo $sql.'<br /><br />';
       // exit;
        $this->db->query("SET SQL_BIG_SELECTS=1");
        $query		= $this->db->query($sql);
        $nr		= $query->num_rows();
        $rec		= $query->result_array();

        if($rec && is_array($rec) ){
            $i=0; 
            foreach($rec as $r){
                $property_master_id = $r['property_id'];
                
                    //$price_sql  = " SELECT RT.roomtype_name, PR.room_type, PR.daily_price,(PR.commission_price*".$currencyRate.") as commission_price, PR.minimum_rental_days,
                    //                PR.isDefault
                    //                FROM ".ROOMTYPE_MASTER." RT
                    //                LEFT JOIN ".PROPERTY_ROOMPRICE." PR ON RT.roomtype_id = PR.room_type
                    //                WHERE 1  
                    //                ".$whereprice."
                    //                AND PR.property_id = ".$r['property_id']."
                    //                GROUP BY PR.property_id
                    //                ".$sort_price."
                    //                LIMIT 0,1
                    //                ";
                                    
                    $price_sql  = " SELECT RT.roomtype_name, PR.base_price
                                    FROM ".ROOMTYPE_MASTER." RT
                                    LEFT JOIN ".AGENT_ROOMTYPE." PR ON RT.roomtype_id = PR.room_type_master_id
                                    WHERE 1  
                                    ".$whereprice."
                                    AND PR.property_id = ".$r['property_id']."
                                    GROUP BY PR.property_id
                                    ".$sort_price."
                                    LIMIT 0,1
                                    ";
                                    
                    //echo $price_sql.'<br /><br />';
                    $price_query= $this->db->query($price_sql);
                    $price_rec  = $price_query->row();
                    
                    if( isset($min_price) && isset($max_price) && $min_price >= 0 && $max_price > 0 ) {
                         
                        if( $price_rec && ( $min_price != ''  || $min_price >= $price_rec->base_price ) && ( $max_price <= $price_rec->base_price || $max_price!='' || $max_price > 0 ) )
                        { 	
                            $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                            $rec[$i]['room_type'] = 0;//$price_rec->room_type;
                            if($price_rec->base_price > 0)
                                $rec[$i]['daily_price'] = ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                                
                            $rec[$i]['commission_price'] = 0;//$price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = 0;//$price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = 'No'; //$price_rec->isDefault;
                        }
                        else
                        {
                                unset($rec[$i]);
                                $i++;
                                continue;
                        }
                    } else {
                        if($price_rec ){
                            $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                            $rec[$i]['room_type'] = 0;//$price_rec->room_type;
                            if($price_rec->base_price > 0)
                                $rec[$i]['daily_price'] = ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                                
                            $rec[$i]['commission_price'] = 0;//$price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = 0;//$price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = 'No';//$price_rec->isDefault;
                        } else {
                            $rec[$i]['roomtype_name'] = '';
                            $rec[$i]['room_type'] = '';
                            $rec[$i]['daily_price'] = 0;
                            $rec[$i]['commission_price'] = 0;
                            $rec[$i]['minimum_rental_days'] = 0;
                            $rec[$i]['isDefault'] = 'No';                        
                        }
                    }
                    
                    //if( isset($min_price) && isset($max_price) && $min_price >= 0 && $max_price > 0 ) {
                    //     
                    //    if( $price_rec && ( $min_price != ''  || $min_price >= $price_rec->daily_price ) && ( $max_price <= $price_rec->daily_price || $max_price!='' || $max_price > 0 ) )
                    //    { 	
                    //        $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                    //        $rec[$i]['room_type'] = $price_rec->room_type;
                    //        if($price_rec->daily_price > 0)
                    //            $rec[$i]['daily_price'] = ( $price_rec->daily_price * $currencyRate ) ;
                    //        else
                    //            $rec[$i]['daily_price'] = 0 ;
                    //            
                    //        $rec[$i]['commission_price'] = $price_rec->commission_price;
                    //        $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                    //        $rec[$i]['isDefault'] = $price_rec->isDefault;
                    //    }
                    //    else
                    //    {
                    //            unset($rec[$i]);
                    //            $i++;
                    //            continue;
                    //    }
                    //} else {
                    //    if($price_rec ){
                    //        $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                    //        $rec[$i]['room_type'] = $price_rec->room_type;
                    //        if($price_rec->daily_price > 0)
                    //            $rec[$i]['daily_price'] = ( $price_rec->daily_price * $currencyRate ) ;
                    //        else
                    //            $rec[$i]['daily_price'] = 0 ;
                    //        $rec[$i]['commission_price'] = $price_rec->commission_price;
                    //        $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                    //        $rec[$i]['isDefault'] = $price_rec->isDefault;
                    //    } else {
                    //        $rec[$i]['roomtype_name'] = '';
                    //        $rec[$i]['room_type'] = '';
                    //        $rec[$i]['daily_price'] = 0;
                    //        $rec[$i]['commission_price'] = 0;
                    //        $rec[$i]['minimum_rental_days'] = 0;
                    //        $rec[$i]['isDefault'] = 'No';                        
                    //    }
                    //}
                    
                $rec[$i]['fav_status'] ='No';
                if($userid!=''){
                    $this->db->where('property_id',$property_master_id);
                    $this->db->where('user_id',$userid);
                    $fav_query = $this->db->get(MEMBERS_FAVOURITE);
                    if($fav_query->num_rows()>0){
                        $rec[$i]['fav_status'] = 'Yes';
                    }
                }
                
                 /* PROPERTY REVIEWS */
                $record['reviews']= array();
                $r_str = "SELECT PR.* FROM ".REVIEW_MASTER." AS PR WHERE PR.property_id='".$property_master_id."' ";
                $r_query = $this->db->query($r_str);
                if($r_query->num_rows()>0){
                    $rec[$i]['reviews']=$r_query->result_array();
                    $rec[$i]['reviews_count'] = $r_query->num_rows();
                }else{
                    $rec[$i]['reviews']=array();
                    $rec[$i]['reviews_count'] =0;
                }
                
                /* PROPERTY REVIEWS END */
                
                if(in_array($property_master_id,$fav_arr))
                    $rec[$i]['is_fav'] = 1;
                else
                    $rec[$i]['is_fav'] = 0;
                
                $i++;
            }
            
            if($sortby == "price-asc"){
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
            }elseif($sortby == "price-desc"){
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
                $rec = array_reverse($rec);
            }
  
        }
        //pr($rec);
        return $rec;
    }
    
    public function getPropertyDetails($property_slug,$type='active',$currency=''){
        $currencyArr= $this->model_basic->getValues_conditions('hw_currency_master','','','currency_code="'.$currency.'"',$OrderBy='',$OrderType='',$Limit=0);
        $currencyRate= $currencyArr[0]['currency_rate'];
        $record= array();
        if($property_slug!=''){
    
            $str=   'SELECT PM.*, PT.property_type_name, PD.*, PT.property_type_name, PT.property_type_slug, PP.province_name, PP.province_slug, PC.city_name,
                    PC.city_slug,PC.city_seo_slug
                    FROM  '.PROPERTY_MASTER.' AS PM '
                    .' LEFT JOIN  '.PROPERTY_TYPE.' AS PT ON PM.property_type_id=PT.property_type_id '
                    .' LEFT JOIN '.PROPERTY_DETAILS.' AS PD ON PD.property_id=PM.property_master_id'
                    .' LEFT JOIN '.PROVINCE_MASTER.' AS PP ON PP.province_id=PD.province_id'
                    .' LEFT JOIN '.CITY.' AS PC ON PC.city_master_id=PD.city_id '
                    .' WHERE PM.property_slug = "'.$property_slug.'" ';
                    
            
        
            if($type == "active"){
                $str .=" AND PM.status='Active'  ";
            }
        
            $query = $this->db->query($str);
            
            if($query->num_rows()>0){
                $record['master_details']= $query->row_array();
                $property_id= $record['master_details']['property_master_id'];
        
                /* PROPERTY FACILITIES */
                $record['facilities']= array();
        
                $f_str= 'SELECT FM.amenities_id,FM.amenities_name,FM.amenities_image,FM.amenities_slug,PF.property_id
                        FROM '.FACILITIES.' AS FM
                        LEFT JOIN '.PROPERTY_FACILITIES.' AS PF ON FM.amenities_id = PF.facility_master_id
                        WHERE PF.property_id="'.$property_id.'" AND FM.amenities_status="active"
                        GROUP BY FM.amenities_id';
        
                $f_query = $this->db->query($f_str);
                if($f_query->num_rows()>0){
                    $record['facilities'] = $f_query->result_array();
                }
                /* PROPERTY FACILITIES END */
        
                /* PROPERTY IMAGES */
                $record['images']= array();
                $record['featured_img']= array();
        
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
                $p_str= 'SELECT PP.*,PM.policies_name,PM.policies_slug
                        FROM '.PROPERTY_POLICIES.' AS PP
                        JOIN '.POLICY_MASTER.' AS PM ON PP.policy_master_id=PM.policies_master_id
                        WHERE PP.property_id="'.$property_id.'"';
        
                $p_query = $this->db->query($p_str);
        
                if($p_query->num_rows()>0){
                    $record['policy']=$p_query->result_array();
                }
                /* PROPERTY POLICY END */
        
                /* PROPERTY PRICE */
                $record['price']= array();
                
                $pp_str=    "SELECT PP.price_id,
                            PP.property_id,PP.room_type,
                            (PP.daily_price*".$currencyRate.") as daily_price,
                            (PP.commission_price*".$currencyRate.") as commission_price,
                            PP.minimum_rental_days,PP.isDefault,PP.updated_on,
                            RM.roomtype_name,RM.room_price_type,RM.bathroom_option
                            FROM ".PROPERTY_ROOMPRICE." AS PP
                            JOIN ".ROOMTYPE_MASTER." AS RM ON PP.room_type= RM.roomtype_id
                            WHERE PP.property_id='".$property_id."'
                            ORDER BY number_of_bed DESC";
                        
                $pp_query = $this->db->query($pp_str);
                
                if($pp_query->num_rows()>0){
                    $record['price']=$pp_query->result_array();
                }
                //pr($record['price']);
                /* PROPERTY PRICE END*/
        
                /* PROPERTY REVIEWS */
                /*
                $record['reviews']= array();
                
                $r_str = "SELECT PR.* FROM ".REVIEW_MASTER." AS PR WHERE PR.property_id='".$property_id."' ";
                $r_query = $this->db->query($r_str);
                
                if($r_query->num_rows()>0){
                    $record['reviews'] = $r_query->result_array();
                    $sum_rating = 0;
                    foreach($r_query->result_array() as $v){
                        $sum_rating = $sum_rating+ $v['avarage_rating'];
                    }
                    $record['avg_rating'] = floor($sum_rating/$r_query->num_rows());
                }
                else{
                    $record['reviews_count']  =   0;
                    $record['avg_rating']     =   0;
                }
                */
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

    function getAvgRating($property_id){
		$sql = "SELECT F.feedback_id, 
		PI.first_name,PI.gender,C.countryName,PI.property_id,
		F.comments,
		if(F.value_for_money != '',round(((F.value_for_money/5)*100)),0) value_for_money,
		if(F.security != '',round(((F.security/5)*100)),0) security,
		if(F.location != '',round(((F.location/5)*100)),0) location,
		if(F.staff != '',round(((F.staff/5)*100)),0) staff,
		if(F.atmosphere != '',round(((F.atmosphere/5)*100)),0) atmosphere,
		if(F.cleanliness != '',round(((F.cleanliness/5)*100)),0) cleanliness,
		if(F.facilities != '',round(((F.facilities/5)*100)),0) facilities,
		ROUND(((F.value_for_money+F.security+F.location+F.staff+F.atmosphere+F.cleanliness+F.facilities)/(5*7))*100) totalFeedback
		FROM ".FEEDBACK." F
		INNER JOIN ".PAYMENT_INFO." PI ON PI.property_id = F.property_id
                INNER JOIN hw_countries C ON C.idCountry = PI.nationality
		WHERE F.property_id=".$property_id." GROUP BY F.`feedback_id`ORDER BY F.feedback_id DESC";
                //exit();
                //AND PI.user_id=F.user_id 
                
		$rs = $this->db->query($sql);
		$rec = array();
                $avg_rating = 0;
                $sum_rating = 0;
		if($rs->num_rows())
		{
		    $rec = $rs->result_array();
                    $sum_rating = 0;
                    foreach($rec as $v)
                    {
                        $sum_rating = $sum_rating+ $v['totalFeedback'];
                    }
                    $avg_rating = floor($sum_rating/$rs->num_rows());
		}
                else
                {
                    $sum_rating  =   0;
                    $avg_rating  =   0;
                }
		
		return array('review_list'=> $rec,'sum_rating'=>$sum_rating,'avg_rating'=>$avg_rating,'total_review'=>COUNT($rec));
	}
        
        function getAvgRatingProperty($property_id){
		$sql = "SELECT
		PI.first_name,PI.gender,C.countryName,PI.property_id,
		F.comments,
		if(F.value_for_money != '',round(((F.value_for_money/5)*100)),0) value_for_money,
		if(F.security != '',round(((F.security/5)*100)),0) security,
		if(F.location != '',round(((F.location/5)*100)),0) location,
		if(F.staff != '',round(((F.staff/5)*100)),0) staff,
		if(F.atmosphere != '',round(((F.atmosphere/5)*100)),0) atmosphere,
		if(F.cleanliness != '',round(((F.cleanliness/5)*100)),0) cleanliness,
		if(F.facilities != '',round(((F.facilities/5)*100)),0) facilities,
		ROUND(((F.value_for_money+F.security+F.location+F.staff+F.atmosphere+F.cleanliness+F.facilities)/(5*7))*100) totalFeedback
		FROM ".FEEDBACK." F
		INNER JOIN ".PAYMENT_INFO." PI ON PI.property_id = F.property_id
                AND PI.email=F.email
		INNER JOIN hw_countries C ON C.idCountry = PI.nationality
		WHERE F.property_id=".$property_id." GROUP BY F.`feedback_id` ORDER BY F.feedback_id DESC";
                //exit();
                //AND PI.user_id=F.user_id 
                
		$rs = $this->db->query($sql);
		$rec = array();
                $avg_rating = 0;
                $sum_rating = 0;
		if($rs->num_rows())
		{
		    $rec = $rs->result_array();
                    $sum_rating = 0;
                    foreach($rec as $v)
                    {
                        $sum_rating = $sum_rating+ $v['totalFeedback'];
                    }
                    $avg_rating = floor($sum_rating/$rs->num_rows());
		}
                else
                {
                    $sum_rating  =   0;
                    $avg_rating  =   0;
                }
		
		return array('review_list'=> $rec,'sum_rating'=>$sum_rating,'avg_rating'=>$avg_rating,'total_review'=>COUNT($rec));
	}
        
        public function getWalletBalance($currency='')
        {
            $res = '';
            $user_id = $this->input->get_post('user_id');
            if($user_id != '')
            {
                $sql = "SELECT SUM(if(debit_credit='cr',amount,0)) - SUM(if(debit_credit='dr',amount,0)) balance FROM ".WALLET." WHERE user_id=".$user_id."";
                $query = $this->db->query($sql);
                if($query->num_rows()>0)
                {
                    $res = $query->row_array();
                    $res = $res['balance'];
                    if($res == '')
                    {
                        $res = 0;
                    }
                    else
                    {
                        if($currency == '')
                        {
                            $currency = 'AUD';
                        }
                        
                        $sql1 = "SELECT currency_rate FROM ".CURRENCY_MASTER." where currency_code = '".$currency."'";
                        $query1 = $this->db->query($sql1);
                        if($query1->num_rows()>0)
                        {
                            $res1           = $query1->row_array();
                            $currency_rate = $res1['currency_rate'];
                        }
                        
                        $res = $res*$currency_rate;
                    }
                }
                else
                {
                    $res = 0;
                }
            }
            else
            {
                $res = 0;
            }
            return round($res);
        }
    
    public function booked_future($user_id='')
    {	
        /*
        $book ='Booked';
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.user_id='".$user_id."' AND PI.Booking_status = 'Booked'
        "; //WHERE PI.check_in > NOW() AND PI.user_id='".$user_id."' AND PI.Booking_status= '$book'
        */
        
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.check_in > CURDATE() AND PI.user_id='".$user_id."' AND PI.Booking_status = 'Booked'
        "; // AND PI.user_id='".$user_id."' AND PI.Booking_status= '$book'

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record     =   $query->result_array();
            //$new_record = array();
            //
            //if(is_array($record) && COUNT($record)>0)
            //{
            //    $j=0;
            //    for($i=0;$i<count($record);$i++)
            //    {
            //        if(strtotime($record[$i]['check_in']) > strtotime(date('Y-m-d')))
            //        {
            //           $new_record[$j] = $record[$i];
            //           $j++;
            //        }
            //    }
            //}
            
            return $record;
        }
        else
            return array();
    }
    
    public function booked_past($user_id='')
    {	
        /*$book ='Booked';
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.user_id='".$user_id."' AND PI.Booking_status = 'Booked'
        "; //WHERE PI.check_in <= NOW() AND PI.user_id='".$user_id."' AND PI.Booking_status = $book*/
        
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.check_in <= NOW() AND PI.user_id='".$user_id."' AND PI.Booking_status = 'Booked'
        "; // PI.user_id='".$user_id."' AND PI.Booking_status = $book
        
        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record     =   $query->result_array();
            //$new_record = array();
            //
            //if(is_array($record) && COUNT($record)>0)
            //{
            //    $j=0;
            //    for($i=0;$i<count($record);$i++)
            //    {
            //        if($record[$i]['check_in'] >= date('Y-m-d'))
            //        {
            //            $new_record[$j] = $record[$i];
            //            $j++;
            //        }
            //    }
            //}
            
            return $record;	
        }
         else
            return array();
    }
    
    public function cancelled($user_id='')
    {
        $book ='Cancelled';
        $sql = "SELECT PM.property_name, PI.property_id, PI.paymeny_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id, PI.Booking_status, PI.paymeny_id, HCM.city_name, HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.user_id='".$user_id."' AND PI.Booking_status= 'Cancelled'";

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record =$query->result_array();
            return $record;	
        }
        else
            return array();
    }
    
    public function get_payment_details($booking_id='', $currency_symbol='', $usd_balance='')
    {
        $sql  = "SELECT PI.payble_amount, PI.downpayment_percent, PI.usd_balance, PI.currency_name, PI.currency_symbol, PI.currency_rate,
        CASE 
            WHEN PI.booking_type = 'Non-flexible' THEN 0
            ELSE BK.total_price*(SELECT sitesettings_value FROM hw_sitesettings WHERE sitesettings_id = 21)/100
        END as flexible_deposite_amount
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".BOOKING_DETAILS." AS BK ON BK.payment_id = PI.paymeny_id
        WHERE PI.paymeny_id='".$booking_id."'
        ";
        
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $result_arr     = array();
            $total_price    = 0;
            $payble_amount  = 0;
            $record         = $query->result_array();
            if(is_array($record) && COUNT($record)>0)
            {
                foreach($record as $k=>$v)
                {
                    $payble_amount  = $v['payble_amount'] * $v['currency_rate'];
                    if($usd_balance > 0)
                    {
                         $usd_balance = $usd_balance;
                    }
                    else
                    {
                         $usd_balance    = $v['usd_balance'] * $v['currency_rate'];
                    }
                }
            }
                       
            //$record[0]['total_price']   = $usd_balance;
            //$record[0]['payble_amount'] = $payble_amount;
            
            $record['payment']                  = $record[0];
            $record['payment']['payble_amount'] = round($payble_amount);
            $record['payment']['usd_balance']   = round($usd_balance);
            //pr($record);
            return $record['payment'];	
        }
        else
            return array();
        
    }
    
    public function get_booking_details($booking_id='')
    {
        $sql = "SELECT PM.property_name,HPD.address,HCM.city_name,HPM.province_name,PI.reference_id,CONCAT(PI.prefix_phone,'-',PI.suffix_phone) as phone,PI.email,PI.check_in,PI.check_out,PI.arrival_time,PI.currency_name,PI.currency_symbol,PI.downpayment_percent,BK.total_price,PI.payble_amount,HPD.direction,PI.paymeny_id,
        CASE 
            WHEN PI.booking_type = 'Non-flexible' THEN 0
            ELSE BK.total_price*(SELECT sitesettings_value FROM hw_sitesettings WHERE sitesettings_id = 21)/100
        END as flexible_deposite_amount
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".BOOKING_DETAILS." AS BK ON BK.payment_id = PI.paymeny_id
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_province_master as HPM ON HPM.province_id = HPD.province_id        
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id        
        WHERE PI.paymeny_id='".$booking_id."'";

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $total_price    = 0;
            $payble_amount  = 0;
            $record =$query->result_array();
            if(is_array($record) && COUNT($record)>0)
            {
                foreach($record as $k=>$v)
                {
                    $total_price    = $total_price+ $v['total_price'];
                    $payble_amount  = $payble_amount+ $v['payble_amount'];
                    if($k != 0)
                        unset($record[$k]);
                }
            }
            $record[0]['total_price']   = $total_price;
            $record[0]['payble_amount'] = $payble_amount;
            //pr($record);
            return $record;	
        }
        else
            return array();
    }
    
    public function pending_review($user_id='')
    {	
        $book ='Booked';
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,PI.user_id,PI.reference_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM ".PAYMENT_INFO." AS PI
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PI.property_id = PM.property_master_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        WHERE PI.property_id not in (select HF1.property_id from hw_feedback as HF1 WHERE HF1.user_id = ".$user_id." AND HF1.property_id = PI.property_id AND HF1.payment_id = PI.paymeny_id)  AND PI.check_out <= NOW()- INTERVAL 1 DAY AND PI.user_id= ".$user_id." AND PI.Booking_status='".$book."' GROUP BY PI.paymeny_id";

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record =   $query->result_array();  
            return $record;	
        }
        else
            return array();
    }
    
    public function past_review($user_id='')
    {	
        $sql = "SELECT PM.property_name,PI.property_id,PI.paymeny_id,PI.user_id,PI.reference_id,
        PI.added_date,PI.check_in,PI.check_out,UM.id,PI.Booking_status,PI.paymeny_id,HCM.city_name,HPI.image_name,HPI.image_title,HPI.image_name
        FROM hw_feedback as HF
        INNER JOIN ".PROPERTY_MASTER." AS PM ON PM.property_master_id = HF.property_id
        INNER JOIN hw_property_details AS HPD ON HPD.property_id = PM.property_master_id
        INNER JOIN ".PAYMENT_INFO." AS PI ON PI.property_id = HF.property_id
        INNER JOIN hw_property_image as HPI ON HPI.property_id = PM.property_master_id AND HPI.featured_image = 'Yes'
        INNER JOIN ".USER." AS UM ON PI.user_id = UM.id
        INNER JOIN hw_city_master as HCM ON HCM.city_master_id = HPD.city_id
        WHERE HF.user_id = ".$user_id." GROUP BY PI.property_id";

        $query = $this->db->query($sql);                
        if($query->num_rows()>0)
        {
            $record =   $query->result_array();  
            return $record;	
        }
        else
            return array();
    }
    
    public function availableDate($checkin,$checkout,$property_id,$currency)
    {
        $currency_rate  =   $this->model_basic->getValue_condition('hw_currency_master','currency_rate','','currency_code = "'.$currency.'"');
        $checkin        =   strtotime($checkin);
        $checkout       =   strtotime(date("Y-m-d", strtotime($checkout)) . " -1 day");
        $final_array    =   array();
        $sql            =   "SELECT HAR.id, HAR.type_name, HAR.base_price, HRM.roomtype_name, HRM.room_price_type, HRM.bathroom_option,HAR.size,HAR.no_of_rooms
        FROM hw_agent_roomtype AS HAR
        INNER JOIN hw_roomtype_master as HRM ON HRM.roomtype_id = HAR.room_type_master_id AND HRM.roomtype_status = 'Active'
        WHERE HAR.property_id = ".$property_id;
        
        $query          =   $this->db->query($sql);
        $final_array    =   $query->result_array();
        $cnt            =   0;
        
        for($i = $checkin; $i <= $checkout; $i = $i + 86400 )
        {
            $chkdate = date( 'Y-m-d', $i );
            if(is_array($final_array) && COUNT($final_array)>0)
            {                
                foreach($final_array as $k=>$v)
                {                    
                    $final_array[$k]['booking_arr'][$cnt]['is_booked']    =   0;
                    
                    if(!isset($final_array[$k]['is_available']))
                        $final_array[$k]['is_available']                    =   1;
                        
                    $override_price =   $this->model_basic->getValue_condition('hw_availibility','price','','property_id = '.$property_id.' AND roomtype_id = '.$v['id'].' AND date = "'.$chkdate.'"');
                    
                    if($override_price != '')
                        $final_array[$k]['booking_arr'][$cnt]['price'] = round($override_price*$currency_rate);
                    else
                        $final_array[$k]['booking_arr'][$cnt]['price'] = round($final_array[$k]['base_price']*$currency_rate);
                    
                    if($v['room_price_type'] == 'per_night')
                    {
                        $sql            =   "SELECT SUM(HBD.no_of_room) as total_room_booked
                        FROM hw_payment_info as HPI
                        INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$v['id']."
                        WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                        /*
                        $sql            =   "SELECT COUNT(*) as is_booked
                        FROM hw_payment_info as HPI
                        INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$v['id']."
                        WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND payment_status = 'Success' ";
                        
                        */
                        
                        
                        $query          =   $this->db->query($sql);
                        $available_arr  =   $query->result_array();
                        
                        //if($available_arr[0]['is_booked'] > 0 && $available_arr[0]['is_booked'] != '')
                        //{
                        //    $final_array[$k]['booking_arr'][$cnt]['is_booked'] =   1;
                        //    $final_array[$k]['is_available']                 =   0;
                        //}
//                       if($v['size']>$available_arr[0]['total_room_booked'])
//				{
//					$room = 1;
//				}
//				else
//				{
//					$room = $available_arr[0]['total_room_booked']/$v['size'];
//				}
                        if($available_arr[0]['total_room_booked'] >= $v['no_of_rooms']  && $available_arr[0]['total_room_booked'] != '')
                        {
                            $final_array[$k]['booking_arr'][$cnt]['is_booked'] =   1;
                            $final_array[$k]['is_available']                 =   0;
                            $final_array[$k]['booking_arr'][$cnt]['available_bed']  = 0;
                            $final_array[$k]['booking_arr'][$cnt]['available_room']  = 0;
                        }
                        else
                        {
                            $avl_no_room = $v['no_of_rooms'] - $available_arr[0]['total_room_booked'];
                            $final_array[$k]['booking_arr'][$cnt]['available_bed'] = $avl_no_room * $v['size'];
                            $final_array[$k]['booking_arr'][$cnt]['available_room']  = (($avl_no_room * $v['size'])/$v['size']);
                            $final_array[$k]['booking_arr'][$cnt]['is_booked']      = 0;
                            $final_array[$k]['is_available']                        = 1;
                        }
                        $final_array[$k]['number_of_beds'] = $avl_no_room * $v['size'];//per night
                        $final_array[$k]['number_of_rooms'] = (($avl_no_room * $v['size'])/$v['size']);
                    }
                    else
                    {
                        $sql            =   "SELECT SUM(HBD.no_of_person) as total_person_booked
                        FROM hw_payment_info as HPI
                        INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$v['id']."
                        WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND Booking_status = 'Booked' ";
                        
                        /*
                        $sql            =   "SELECT SUM(HBD.no_of_room) as total_person_booked
                        FROM hw_payment_info as HPI
                        INNER JOIN hw_booking_deatils AS HBD ON HBD.payment_id = HPI.paymeny_id AND HBD.room_type = ".$v['id']."
                        WHERE '".$chkdate."'  between HPI.check_in AND DATE_ADD(HPI.check_out, INTERVAL -1 DAY) AND HPI.property_id = ".$property_id." AND payment_status = 'Success'";
                        */
                        
                        $query          =   $this->db->query($sql);
                        $available_arr  =   $query->result_array();
                        
                        $no_of_bed = $v['no_of_rooms'] * $v['size'];
                        if($available_arr[0]['total_person_booked'] >= $no_of_bed  && $available_arr[0]['total_person_booked'] != '')
                        {
                            $final_array[$k]['booking_arr'][$cnt]['is_booked']      = 1;
                            $final_array[$k]['booking_arr'][$cnt]['available_bed']  = 0;
                            $final_array[$k]['is_available']                        = 0;
                            $final_array[$k]['booking_arr'][$cnt]['available_room']  = 0;
                        }
                        else
                        {
                            $final_array[$k]['booking_arr'][$cnt]['available_bed'] = $no_of_bed - $available_arr[0]['total_person_booked'];
                            $final_array[$k]['booking_arr'][$cnt]['is_booked']      = 0;
                            $final_array[$k]['is_available']                        = 1;
                            $final_array[$k]['booking_arr'][$cnt]['available_room']  = 0;
                        }
                        
                        $final_array[$k]['number_of_beds'] = $no_of_bed - $available_arr[0]['total_person_booked'];//per person
                        $final_array[$k]['number_of_rooms'] = 0;
                    }
                    if(!isset($final_array[$k]['flag']))
                    {
                        $final_array[$k]['converted_price'] = round($final_array[$k]['base_price']*$currency_rate);
                        $final_array[$k]['flag'] = 1;
                    }
                }
            }
            $cnt++;
        }
        //pr($final_array);
        return $final_array;
    }
    
    public function getCreditCardInfo($country_code, $phone_number)
    {
        $sql    = "SELECT card_name, card_number, DATE_FORMAT(expiry_date, '%m/%y') AS expiry_date FROM ".USER_CREDIT_CARD." WHERE country_code = '".$country_code."' AND phone_number = '".$phone_number."'";
        $query  =   $this->db->query($sql);
        $arr_cc =   $query->result_array();
        
        return $arr_cc;
    }
}
?>