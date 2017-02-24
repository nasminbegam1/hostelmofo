<?php

class Model_search extends CI_Model{
    
    public function getlist($searchFrom = 'search', $lcity = '', $lprovince='', $lproptype=''){
        
        $siteCurrency		= $this->nsession->userdata('currencyCode');
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        
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
        
        $group_type             = $this->input->get_post('group_type');
        $age_ranges             = $this->input->get_post('age_ranges');
        
        //pr($_GET);
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
        //echo "normal "; exit;
     
        $where = $whereprice = "  ";
        
        if(isset($group_type) && $group_type != '' && isset($age_ranges) && $age_ranges != ''){
            
            $ageRange = preg_replace('/[-]+/', ',', trim($age_ranges));
            $where .= " AND PM.group_booking_support='yes' ";
        }
        
        
        
        if( isset($type_id) && $type_id != ''){
            $where .= " AND PM.property_type_id IN (".$type_id.") ";
        }
        
        if( isset($roomtype) && $roomtype != ''){
            $whereprice .= " AND PR.room_type_master_id IN ( ".$roomtype." ) ";
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
            $whereprice .= " ";
            //$whereprice .= " AND PR.isDefault = 'Yes' ";
        }
    
        if( isset($guest) && $guest != '' && $guest != 'undefined'){
            $where .= " AND PM.guest >= ".$guest;
        }
        
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
        
        $sort_sql   =  " ORDER BY PM.rank ASC,PM.property_name ASC";
        
        $sort_price =  " ORDER BY PR.base_price ASC";
        if($sortby == "name-az"){
            $sort_sql =  " ORDER BY PM.property_name ASC";
            //$sort_sql =  " ORDER BY PM.rank ASC,PM.property_name ASC";
        }elseif($sortby == "name-za"){
            $sort_sql =  " ORDER BY PM.property_name DESC";
            //$sort_sql =  " ORDER BY PM.rank ASC,PM.property_name DESC";
        }else if($sortby == "price-asc"){
            $sort_price = " ORDER BY PR.base_price ASC";
        }elseif($sortby == "price-desc"){
            $sort_price = " ORDER BY PR.base_price DESC";
        }
        //PROPERTY_MASTER PM, PROPERTY_DETAILS PD, PROPERTY_ROOMPRICE PRP, PROPERTY_FACILITIES PF, CITY
        
        /***
         *commented on 11.08.2016
         * by maantu das
         */
       /*$sql = "SELECT      ROUND(((SUM(F.value_for_money)+SUM(F.security)+SUM(F.location)+SUM(F.staff)+SUM(F.atmosphere)+SUM(F.cleanliness)+SUM(F.facilities))/(COUNT(F.feedback_id)*5*7))*100) totalFeedback,
                
                PM.guest,PM.property_master_id as property_id, PM.property_name, PM.property_slug, PM.property_type_id, PM.property_master_id, PM.bedrooms, PM.beds, PM.room_type, PM.facilities,PM.rank,
                PD.address, PD.address2, PD.province_id, PD.zip_code, PD.city_id, PD.brief_introduction, PD.latitude, PD.longitude,  
                CITY.city_name,CITY.city_seo_slug, PI.image_name, PR.province_name, PR.province_slug,
                PT.property_type_name, PT.property_type_slug 
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
            */    
                
        $sql = "SELECT      ROUND(((SUM(F.value_for_money)+SUM(F.security)+SUM(F.location)+SUM(F.staff)+SUM(F.atmosphere)+SUM(F.cleanliness)+SUM(F.facilities))/(COUNT(F.feedback_id)*5*7))*100) totalFeedback,
                
                PM.guest,PM.property_master_id as property_id, PM.property_name, PM.property_slug, PM.property_type_id, PM.property_master_id, PM.bedrooms, PM.beds, PM.room_type, PM.facilities,PM.rank,
                PD.address, PD.address2, PD.province_id, PD.zip_code, PD.city_id, PD.brief_introduction, PD.latitude, PD.longitude,  
                CITY.city_name,CITY.city_seo_slug, PI.image_name, PR.province_name, PR.province_slug,
                PT.property_type_name, PT.property_type_slug 
                FROM ".PROPERTY_MASTER." PM  
                INNER JOIN ".PROPERTY_DETAILS." PD ON PM.property_master_id = PD.property_id
                INNER JOIN ".PROPERTY_TYPE." PT ON PM.property_type_id = PT.property_type_id 
                INNER JOIN ".CITY." CITY ON PD.city_id = CITY.city_master_id
                INNER JOIN ".PROVINCE_MASTER." PR ON PR.province_id = PD.province_id 
                LEFT JOIN ".PROPERTY_IMAGE." PI ON PM.property_master_id = PI.property_id
                LEFT JOIN ".FEEDBACK." F ON F.property_id = PM.property_master_id
                WHERE PM.status = 'Active' AND PD.latitude != '' AND PD.longitude != '' 
                " .$where. "                
                GROUP BY PM.property_master_id
                ".$sort_sql." ";
        /******************************************************************/
        //echo $sql.'<br /><br />';
         //exit;
        $this->db->query("SET SQL_BIG_SELECTS=1");
        $query		= $this->db->query($sql);
        $nr		= $query->num_rows();
        $rec		= $query->result_array();

        if($rec && is_array($rec) ){
            $i=0; 
            foreach($rec as $r){
                $property_master_id = $r['property_id'];
                $price_sql  = " SELECT RT.roomtype_name, PR.base_price, MIN( PR.base_price ) AS start_price
                                    FROM ".ROOMTYPE_MASTER." RT
                                    LEFT JOIN ".AGENT_ROOMTYPE." PR ON RT.roomtype_id = PR.room_type_master_id
                                    WHERE 1  
                                    ".$whereprice."
                                    AND PR.property_id = ".$r['property_id']."
                                    GROUP BY PR.property_id
                                    ".$sort_price."
                                    LIMIT 0,1
                                    ";         
                    //echo $price_sql; 
                    $price_query= $this->db->query($price_sql);
                    $price_rec  = $price_query->row();
                    
                    if( isset($min_price) && isset($max_price) && $min_price >= 0 && $max_price > 0 ) {
                         
                        if( $price_rec && ( $min_price != ''  || $min_price >= $price_rec->base_price ) && ( $max_price <= $price_rec->base_price || $max_price!='' || $max_price > 0 ) )
                        { 	
                            $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                            $rec[$i]['room_type'] = 0;//$price_rec->room_type;
                            if($price_rec->base_price > 0)
                                $rec[$i]['base_price'] = ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['base_price'] = 0 ;
                                
                            if($price_rec->start_price > 0)
                                $rec[$i]['start_price'] = ( $price_rec->start_price * $currencyRate ) ;
                            else
                                $rec[$i]['start_price'] = 0 ;
                                
                                
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
                                $rec[$i]['base_price'] = ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['base_price'] = 0 ;
                                
                            if($price_rec->start_price > 0)
                                $rec[$i]['start_price'] = ( $price_rec->start_price * $currencyRate ) ;
                            else
                                $rec[$i]['start_price'] = 0 ;
                                
                            $rec[$i]['commission_price'] = 0;//$price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = 0;//$price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = 'No';//$price_rec->isDefault;
                        } else {
                            $rec[$i]['roomtype_name'] = '';
                            $rec[$i]['room_type'] = '';
                            $rec[$i]['base_price'] = 0;
                            $rec[$i]['commission_price'] = 0;
                            $rec[$i]['minimum_rental_days'] = 0;
                            $rec[$i]['isDefault'] = 'No';                        
                        }
                    }
                    
                    
                $rec[$i]['fav_status'] ='No';
                if($this->nsession->userdata('USER_ID')!=''){
                    $user_id = $this->nsession->userdata('USER_ID');
                    $this->db->where('property_id',$property_master_id);
                    $this->db->where('user_id',$user_id);
                    $fav_query = $this->db->get(MEMBERS_FAVOURITE);
                    if($fav_query->num_rows()>0){
                        $rec[$i]['fav_status'] = 'Yes';
                    }
                }
                
                $feedback_str = 'SELECT FB.* FROM hw_feedback AS FB where FB.property_id="'.$property_master_id.'" AND FB.status="Active"';
                $feedback_query = $this->db->query($feedback_str);
                if($feedback_query->num_rows() > 0){
                    $res = $feedback_query->result_array();
                    $count = count($res);
                    $output = 0;
                    foreach ( $res as $r){
                        $output = $output + (($r['value_for_money']+$r['security']+$r['location']+$r['staff']+$r['atmosphere']+$r['cleanliness']+$r['facilities'])/ 7);
                    }
                    $final_review = $output / $count;
                    $rec[$i]['rating'] = sprintf("%.1f", $final_review);
                }
                else{
                    $rec[$i]['rating'] = 0;
                }
                
                $dorm_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$property_master_id.'" AND ART.price_charge_type="per_person" AND ART.status="Active"';
                $dorm_query = $this->db->query($dorm_str);
                $dorm_res = array();
                if($dorm_query->num_rows() > 0){
                    $dorm_res = $dorm_query->result_array();
                    $rec[$i]['min_dorm'] = min( $dorm_res );
                }
                else{
                    $rec[$i]['min_dorm'] = 0;
                }
                
                $private_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$property_master_id.'" AND ART.price_charge_type="per_night" AND ART.status="Active"';
                $private_query = $this->db->query($private_str);
                $private_res = array();
                if($private_query->num_rows() > 0){
                    $private_res = $private_query->result_array();
                    $rec[$i]['min_private'] = min( $private_res );
                }
                else{
                    $rec[$i]['min_private'] = 0;
                }
                
                $min_str = 'SELECT ART.base_price FROM hw_agent_roomtype AS ART where ART.property_id="'.$property_master_id.'" AND ART.status="Active"';
                $min_qr = $this->db->query($min_str);
                $min_price = array();
                if($min_qr->num_rows() > 0){
                    $min_price = $min_qr->result_array();
                    $rec[$i]['min_price'] = min( $min_price );
                }
                else{
                    $rec[$i]['min_price'] = 0;
                }
                
                
                $f_str = 'SELECT GROUP_CONCAT(FM.amenities_name) as amen_name FROM '.FACILITIES.' AS FM LEFT JOIN '.PROPERTY_FACILITIES.' AS PF ON FM.amenities_id = PF.facility_master_id WHERE PF.property_id="'.$property_master_id.'" AND FM.amenities_status="active" GROUP BY PF.property_id';
                $f_query = $this->db->query($f_str);
                if($f_query->num_rows()>0){
                    $rec[$i]['facilities'] = $f_query->row_array();
                }
                
                
                    
                $i++;
            }
            
            if($sortby == "price-asc"){
                usort($rec, function($a, $b) {
                        return $a['base_price'] - $b['base_price'];
                });
            }elseif($sortby == "price-desc"){
                usort($rec, function($a, $b) {
                        return $a['base_price'] - $b['base_price'];
                });
                $rec = array_reverse($rec);
            }
  
        }
        //pr($rec);
        return $rec;
    }
    
    
   
   
   
   
   
    public function getAjaxMap($property_id='')
    {
        
        $siteCurrency		= $this->nsession->userdata('currencyCode');
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        
        //echo $siteCurrency.'----'.$currencyRate; exit;
        
        $searchType		= $this->uri->segment(2, 0);
        $guest			= $this->input->get_post('guest', TRUE);
        $ptype			= $this->input->get_post('type', TRUE);
        $type_id		= $this->input->get_post('typeid', TRUE);
        $city			= $this->input->get_post('city', TRUE);
        $province		= $this->input->get_post('province', TRUE);
        $check_in		= $this->input->get_post('checkin', TRUE);
        $check_out		= $this->input->get_post('checkout', TRUE);
        $min_price		= $this->input->get_post('minprice', TRUE);
        $max_price		= $this->input->get_post('maxprice', TRUE);
        $roomtype		= $this->input->get_post('roomtypes', TRUE);
        $facilities		= $this->input->get_post('amenities', TRUE);
        $page			= $this->input->get_post('page', 0);
        $currency		= 'AUD'; 
        $way			= $this->input->get_post('way', TRUE);
        $sortby			= $this->input->get_post('sortBy', TRUE);
        $perpage 	        = $this->input->get_post('perpage', TRUE);
        
        $ne_lat                 = $this->input->get_post('ne_lat');
        $ne_lng                 = $this->input->get_post('ne_lng');
        $sw_lat                 = $this->input->get_post('sw_lat');
        $sw_lng                 = $this->input->get_post('sw_lng');
        
        $group_type = $this->input->get_post('group_type');
        $age_ranges = $this->input->get_post('age_ranges');
        //echo $group_type; echo $age_ranges."<><><><><><><><>";
        
        $where_lat_lng = '';
        
        if(!empty($ne_lat)){
            $where_lat_lng	.= ' AND PD.latitude <= ' . ($ne_lat+0);
        }
	
        if(!empty($ne_lng)){
            $where_lat_lng	.= ' AND PD.longitude <= ' . ($ne_lng+0);
        }
		
        if(!empty($sw_lat)){
            $where_lat_lng	.= ' AND PD.latitude >= ' . ($sw_lat+0);
        }
	
        if(!empty($sw_lng)){
            $where_lat_lng	.= ' AND PD.longitude >= ' . ($sw_lng+0);
        }
        
        
        $where_property_id = '';
        if($property_id != ''){
            $where_property_id = ' AND PM.property_master_id = '.$property_id;
        }
        
        if($searchFrom = 'landing'){
            //echo "landing"; exit;
            if( isset($lcity) && $lcity != '')
                $city = $lcity;
            if( isset($lprovince) && $lprovince != '')
                $province = $lprovince;
            if( isset($lproptype) && $lproptype != '')
                $type_id = $lproptype;
        }
        //echo "normal "; exit;
        
        $where = $whereprice = "  ";
        if( isset($type_id) && $type_id != ''){
            $where .= " AND PM.property_type_id IN (".$type_id.") ";
        }
        
        if( isset($roomtype) && $roomtype != ''){
            $where .= " AND ART.room_type_master_id IN (".$roomtype.") ";
        }
        
        if( isset($guest) && $guest != '' && $guest != 'undefined'){
            $where .= " AND PM.guest >= ".$guest;
        }
        
        if(isset($group_type) && $group_type != '' && isset($age_ranges) && $age_ranges != ''){
            
            //$ageRange = preg_replace('/[-]+/', ',', trim($age_ranges));
            $where .= " AND PM.group_booking_support='yes' ";
        }
        
    
        if( isset($city) && $city != ''){            
            $cityy = explode(',',$city);
            
            if(is_array($cityy)){
                if($cityy[0] == 24){
                    $cityy[1] = 101;
                }
            }
            
            if(is_array($cityy)){
                if($cityy[0] == 101){
                    $cityy[1] = 24;
                }
            }
            
            $where_city = array();
            foreach($cityy as $c){
                    if($c != '') {
                            $where_city[] = " FIND_IN_SET('".$c."', CITY.city_master_id) "  ;
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
        
        if( isset($facilities) && $facilities != ''){
            $fac = explode(',',$facilities);
            $where_fac = array();
            foreach($fac as $r){
                    if($r != '') {
                            $where_fac[] = " FIND_IN_SET('".$r."', PF.facility_master_id) "  ;
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
        }
        elseif($sortby == "name-za"){
            $sort_sql =  " ORDER BY PM.property_name DESC";
        }
        else if($sortby == "price-asc"){
            $sort_price = " ORDER BY PR.base_price ASC";
        }
        elseif($sortby == "price-desc"){
            $sort_price = " ORDER BY PR.base_price DESC";
        }
        
        //PROPERTY_MASTER PM, PROPERTY_DETAILS PD, PROPERTY_ROOMPRICE PRP, PROPERTY_FACILITIES PF, CITY
       $sql = "
                SELECT PM.property_master_id as property_id, PM.property_name, PM.property_slug, PM.property_type_id, PM.property_master_id, PM.bedrooms, PM.beds, PM.room_type, PM.facilities, 
                PD.address, PD.address2, PD.province_id, PD.zip_code, PD.city_id, PD.brief_introduction, PD.latitude, PD.longitude,  
                CITY.city_name,CITY.city_seo_slug, PI.image_name, PR.province_name, PR.province_slug,
                PT.property_type_name, PT.property_type_slug 
                FROM ".PROPERTY_MASTER." PM  
                INNER JOIN ".PROPERTY_DETAILS." PD ON PM.property_master_id = PD.property_id
                INNER JOIN ".PROPERTY_TYPE." PT ON PM.property_type_id = PT.property_type_id 
                INNER JOIN ".CITY." CITY ON PD.city_id = CITY.city_master_id
                INNER JOIN ".PROVINCE_MASTER." PR ON PR.province_id = PD.province_id 
                LEFT JOIN ".PROPERTY_IMAGE." PI ON PM.property_master_id = PI.property_id
                LEFT JOIN ".FEEDBACK." F ON F.property_id = PM.property_master_id
                
                LEFT JOIN ".AGENT_ROOMTYPE." ART ON ART.property_id = PM.property_master_id
                LEFT JOIN ".ROOMTYPE_MASTER." RTM ON RTM.roomtype_id = ART.room_type_master_id
                LEFT JOIN ".PROPERTY_FACILITIES." PF ON PF.property_id = PM.property_master_id
                LEFT JOIN ".FACILITIES." FM ON FM.amenities_id = PF.facility_master_id
                
                WHERE PM.status = 'Active' ".$where_property_id." AND PD.latitude != '' AND PD.longitude != ''
                ".$where.$where_lat_lng."                
                GROUP BY PM.property_master_id
                ".$sort_sql." ";
        /******************************************************************/
        //echo $sql.'<br /><br />'; die();
        $this->db->query("SET SQL_BIG_SELECTS=1");
        $query		= $this->db->query($sql);
        $nr		= $query->num_rows();
        $rec		= $query->result_array();
        
        
        
        if($rec && is_array($rec) ){
            $i=0;
            foreach($rec as $r){
                $property_master_id = $r['property_id'];
                    $price_sql  = " SELECT RT.roomtype_name, PR.base_price,MIN( PR.base_price ) AS start_price 
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
                                $rec[$i]['daily_price'] =  ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                            
                            if($price_rec->start_price > 0)
                                $rec[$i]['start_price'] = ( $price_rec->start_price * $currencyRate ) ;
                            else
                                $rec[$i]['start_price'] = 0 ;
                            
                                
                            $rec[$i]['commission_price'] = 0;//$price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = 0;//$price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = 'No';//$price_rec->isDefault;
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
                                $rec[$i]['daily_price'] =  ( $price_rec->base_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                            
                            if($price_rec->start_price > 0)
                                $rec[$i]['start_price'] = ( $price_rec->start_price * $currencyRate ) ;
                            else
                                $rec[$i]['start_price'] = 0 ;
                            
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
                    
                    /**** Add to Fav ***/
                    $rec[$i]['fav_status']  = 'No';
                    
                    if($this->nsession->userdata('USER_ID')!='')
                    {
                        $user_id    = $this->nsession->userdata('USER_ID');
                        $this->db->where('property_id',$property_master_id);
                        $this->db->where('user_id',$user_id);
                        $fav_query  = $this->db->get(MEMBERS_FAVOURITE);
                        if($fav_query->num_rows()>0){
                            $rec[$i]['fav_status'] = 'Yes';
                        }
                    }
                    
                $i++;
            }
            
            
            
            if($sortby == "price-asc"){ 
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
            }
            elseif($sortby == "price-desc"){ 
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
                $rec = array_reverse($rec);
            }
            
        }
        
        return $rec;
    }
    
    
    
    
    
    
    
}