<?php

class Model_search extends CI_Model{
    
    public function getlist($searchFrom = 'search', $lcity = '', $lprovince='', $lproptype=''){
        
        $siteCurrency		= $this->nsession->userdata('currencyCode');
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        
        //echo $siteCurrency.'----'.$currencyRate; exit;
        
        $searchType		= $this->uri->segment(2, 0);
        
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
        
        if( isset($type_id) && $type_id != ''){
            $where .= " AND PM.property_type_id IN (".$type_id.") ";
        }
        
        if( isset($roomtype) && $roomtype != ''){
            $whereprice .= " AND PR.room_type IN ( ".$roomtype." ) ";
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
            $whereprice .= " AND PR.isDefault = 'Yes' ";
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
            $whereprice .= " AND PR.daily_price >= ".$tmin." ";
        }
        
        if( isset($max_price) && $max_price != ''){
            $tmax = ($max_price / $currencyRate) ;
            if($max_price > 0){
                $whereprice .= " AND PR.daily_price <= ".$tmax." ";
            }
        }
        
        $sort_sql   =  " ORDER BY PM.property_name ASC";
        $sort_price =  " ORDER BY PR.daily_price ASC";
        if($sortby == "name-az"){
            $sort_sql =  " ORDER BY PM.property_name ASC";
        }elseif($sortby == "name-za"){
            $sort_sql =  " ORDER BY PM.property_name DESC";
        }else if($sortby == "price-asc"){
            $sort_price = " ORDER BY PR.daily_price ASC";
        }elseif($sortby == "price-desc"){
            $sort_price = " ORDER BY PR.daily_price DESC";
        }
        //PROPERTY_MASTER PM, PROPERTY_DETAILS PD, PROPERTY_ROOMPRICE PRP, PROPERTY_FACILITIES PF, CITY
        $sql = "SELECT      ROUND(((SUM(F.value_for_money)+SUM(F.security)+SUM(F.location)+SUM(F.staff)+SUM(F.atmosphere)+SUM(F.cleanliness)+SUM(F.facilities))/(COUNT(F.feedback_id)*5*7))*100) totalFeedback,
                
                PM.property_master_id as property_id, PM.property_name, PM.property_slug, PM.property_type_id, PM.property_master_id, PM.bedrooms, PM.beds, PM.room_type, PM.facilities, 
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
                    $price_sql  = " SELECT RT.roomtype_name, PR.room_type, PR.daily_price, PR.commission_price, PR.minimum_rental_days,
                                    PR.isDefault
                                    FROM ".ROOMTYPE_MASTER." RT
                                    LEFT JOIN ".PROPERTY_ROOMPRICE." PR ON RT.roomtype_id = PR.room_type
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
                         
                        if( $price_rec && ( $min_price != ''  || $min_price >= $price_rec->daily_price ) && ( $max_price <= $price_rec->daily_price || $max_price!='' || $max_price > 0 ) )
                        { 	
                            $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                            $rec[$i]['room_type'] = $price_rec->room_type;
                            if($price_rec->daily_price > 0)
                                $rec[$i]['daily_price'] = ( $price_rec->daily_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                                
                            $rec[$i]['commission_price'] = $price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = $price_rec->isDefault;
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
                            $rec[$i]['room_type'] = $price_rec->room_type;
                            if($price_rec->daily_price > 0)
                                $rec[$i]['daily_price'] = ( $price_rec->daily_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                            $rec[$i]['commission_price'] = $price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = $price_rec->isDefault;
                        } else {
                            $rec[$i]['roomtype_name'] = '';
                            $rec[$i]['room_type'] = '';
                            $rec[$i]['daily_price'] = 0;
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
    
    
    public function getAjaxMap($property_id='')
    {
        $siteCurrency		= $this->nsession->userdata('currencyCode');
        $currencyRate   	= $this->nsession->userdata('currencyRate');
        
        //echo $siteCurrency.'----'.$currencyRate; exit;
        
        $searchType		= $this->uri->segment(2, 0);
        
        $ptype			= $this->input->get_post('type', TRUE);
        $type_id		= $this->input->get_post('typeid', TRUE);
        $city			= $this->input->get_post('city', TRUE);
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
        $sortby			= $this->input->get_post('sortBy', TRUE);
        $perpage 	        = $this->input->get_post('perpage', TRUE);
        
        $ne_lat                 = $this->input->get_post('ne_lat');
        $ne_lng                 = $this->input->get_post('ne_lng');
        $sw_lat                 = $this->input->get_post('sw_lat');
        $sw_lng                 = $this->input->get_post('sw_lng');
        
        
        
        $where_lat_lng = '';
        
        if(!empty($ne_lat))
        {
            $where_lat_lng	.= ' AND PD.latitude <= ' . ($ne_lat+0);
	}
	
	if(!empty($ne_lng))
        {
            $where_lat_lng	.= ' AND PD.longitude <= ' . ($ne_lng+0);
	}
		
	if(!empty($sw_lat))
        {
            $where_lat_lng	.= ' AND PD.latitude >= ' . ($sw_lat+0);
	}
	
	if(!empty($sw_lng))
        {
            $where_lat_lng	.= ' AND PD.longitude >= ' . ($sw_lng+0);
	}
        
        $where_property_id = '';
        if($property_id != '')
        {
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
            $whereprice .= " AND PR.room_type IN ( ".$roomtype." ) ";
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
            $whereprice .= " AND PR.isDefault = 'Yes' ";
        }
    
        if( isset($city) && $city != ''){            
            $cityy = explode(',',$city);
            
            if(is_array($cityy))
            {
                if($cityy[0] == 24)
                {
                    $cityy[1] = 101;
                }
            }
            
            if(is_array($cityy))
            {
                if($cityy[0] == 101)
                {
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
            $whereprice .= " AND PR.daily_price >= ".$tmin." ";
        }
        
        if( isset($max_price) && $max_price != ''){
            $tmax = ($max_price / $currencyRate) ;
            if($max_price > 0){
                $whereprice .= " AND PR.daily_price <= ".$tmax." ";
            }
        }
        
        $sort_sql   =  " ORDER BY PM.property_name ASC";
        $sort_price =  " ORDER BY PR.daily_price ASC";
        
        if($sortby == "name-az")
        {
            $sort_sql =  " ORDER BY PM.property_name ASC";
        }
        elseif($sortby == "name-za"){
            $sort_sql =  " ORDER BY PM.property_name DESC";
        }
        else if($sortby == "price-asc"){
            $sort_price = " ORDER BY PR.daily_price ASC";
        }
        elseif($sortby == "price-desc")
        {
            $sort_price = " ORDER BY PR.daily_price DESC";
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
                WHERE PM.status = 'Active' ".$where_property_id." 
                AND PI.featured_image = 'Yes' AND PD.latitude != '' AND PD.longitude != ''
                ".$where.$where_lat_lng."                
                GROUP BY PM.property_master_id
                ".$sort_sql." ";
        /******************************************************************/
        //echo $sql.'<br /><br />';
        $this->db->query("SET SQL_BIG_SELECTS=1");
        $query		= $this->db->query($sql);
        $nr		= $query->num_rows();
        $rec		= $query->result_array();
        if($rec && is_array($rec) ){
            $i=0;
            foreach($rec as $r){
                $property_master_id = $r['property_id'];
                    $price_sql  = " SELECT RT.roomtype_name, PR.room_type, PR.daily_price, PR.commission_price, PR.minimum_rental_days,
                                    PR.isDefault
                                    FROM ".ROOMTYPE_MASTER." RT
                                    LEFT JOIN ".PROPERTY_ROOMPRICE." PR ON RT.roomtype_id = PR.room_type
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
                         
                        if( $price_rec && ( $min_price != ''  || $min_price >= $price_rec->daily_price ) && ( $max_price <= $price_rec->daily_price || $max_price!='' || $max_price > 0 ) )
                        { 	
                            $rec[$i]['roomtype_name'] = $price_rec->roomtype_name;
                            $rec[$i]['room_type'] = $price_rec->room_type;
                            if($price_rec->daily_price > 0)
                                $rec[$i]['daily_price'] = ceil( $price_rec->daily_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                            $rec[$i]['commission_price'] = $price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = $price_rec->isDefault;
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
                            $rec[$i]['room_type'] = $price_rec->room_type;
                            if($price_rec->daily_price > 0)
                                $rec[$i]['daily_price'] = ( $price_rec->daily_price * $currencyRate ) ;
                            else
                                $rec[$i]['daily_price'] = 0 ;
                            $rec[$i]['commission_price'] = $price_rec->commission_price;
                            $rec[$i]['minimum_rental_days'] = $price_rec->minimum_rental_days;
                            $rec[$i]['isDefault'] = $price_rec->isDefault;
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
                        
                        if($fav_query->num_rows()>0)
                        {
                            $rec[$i]['fav_status'] = 'Yes';
                        }
                    }
                    
                $i++;
            }
            
            
            
            if($sortby == "price-asc")
            { 
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
            }
            elseif($sortby == "price-desc")
            { 
                usort($rec, function($a, $b) {
                        return $a['daily_price'] - $b['daily_price'];
                });
                $rec = array_reverse($rec);
            }
            
        }
        
        return $rec;
    }
    
    
    
    
    
    
    
}