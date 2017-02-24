<?php

class Sitemap extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->model("model_basic");
	$this->load->model("model_sitemap");
    }
    
    public function index(){
       chk_login();
       if($this->input->post("action")=="Process"){
	
            $modified_date_type=$this->input->post("modified_date_type");
            $modified_date=$this->input->post("modified_date");
            $change_frequency=$this->input->post("change_frequency");
            $priority=$this->input->post("priority");
	    
	    // misc links //
	    //$links_text    =  $this->input->post("links");	    
	    //$update_arr    = array('sitesettings_value'=>$links_text);
	    //$this->model_basic->updateIntoTable('lp_sitesettings',array('sitesettings_name'=>'sitemap_misc_links'),$update_arr);
	    
            $this->create_sitemap($modified_date_type,$modified_date,$change_frequency,$priority);
            
            $succmsg="Site map is generated successfully";
            $succmsg.='<br/>Updated Sitemap URL: <a href="'.FRONTEND_URL.'sitemap.xml" target="_blank">'.FRONTEND_URL.'sitemap.xml</a>';
            $this->nsession->set_userdata('succmsg',$succmsg);
	    
        }
	
	$xml = file_get_contents(SERVER_ABSOLUTE_PATH.'sitemap.xml');
	//if($xml=='')
	//{
	//    return false;
	//}
	$elem = new SimpleXMLElement(preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $xml));
	
	$this->data['total_links']	   = isset($elem->url)? count($elem->url):0;
	$this->data['last_updated']	   = date ("Y-m-d H:i:s",filemtime(SERVER_ABSOLUTE_PATH."sitemap.xml"));
       // $this->data['sitemap_misc_links']  = $this->model_basic->getValue_condition("lp_sitesettings",  "sitesettings_value", '', 'sitesettings_name="sitemap_misc_links"');
        $this->data['succmsg']  	   = $this->nsession->userdata('succmsg');
        $this->data['base_url'] 	   = BACKEND_URL."sitemap/index";
        $this->nsession->set_userdata('succmsg', "");		
        
        
        
        $this->data['brdLink'][0]['logo']   =   'fa fa-gear';
        $this->data['brdLink'][0]['name']   =   'Tools';
        $this->data['brdLink'][0]['link']   =   '';
        $this->data['brdLink'][1]['logo']   =   'fa fa-sitemap';
	$this->data['brdLink'][1]['name']   =   'Site Map Generator';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';

        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        
        $this->elements['middle']='sitemap/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);		
        
    }
    
    
    public function generate(){
        $this->create_sitemap();
       
    }
    
    
    function create_sitemap($modified_date_type=2,$modified_date='',$change_frequency='Daily',$priority='1.0'){
        switch($modified_date_type){
              case 0:
                  $date="";
                  break;
              case 1:
              case 2:
                  $date=date("Y-m-d");
                  break;
              case 3: // for custom date
                  $date=date("Y-m-d",strtotime($modified_date));
                  break;
            }
        
            //$property_details    = $this->model_basic->getValues_conditions("hw_property_master as hpm, hw_property_type_master as hptm, hw_city_master as hcm, hw_province_master as hprm  ", array('hpm.property_slug','hptm.property_type_slug','hcm.city_seo_slug','hprm.province_slug'), '', ' hpm.property_type_id=hptm.property_type_id');
           
	    $property_details = $this->model_sitemap->getDetails();
	    //pr($property_details);
	    
	    //$property_type      = $this->model_basic->getValues_conditions(PROPERTY_TYPE, array('property_type_id','property_type_name','property_type_slug'), '', 'status="Active"');
	    
            //$province           = $this->model_basic->getValues_conditions(PROVINCE_MASTER,  array('province_id','province_name','province_slug'), '', 'status="Active"');
            $city               = $this->model_basic->getValues_conditions("hw_city_master as cm, hw_province_master as pm",  array('cm.city_master_id','cm.city_name','cm.city_slug','cm.city_seo_slug','pm.province_slug','pm.province_name','pm.province_id'), '', 'cm.province_id=pm.province_id and cm.status="Active"');
            //$cms_page           = $this->model_basic->getValues_conditions(CMS , array('cms_id','cms_title','cms_slug'), '', ' cms_status = "1" ');
            
	    //$misc_links 	= $this->model_basic->getValue_condition("lp_sitesettings",  "sitesettings_value", '', 'sitesettings_name="sitemap_misc_links"');
	    //$misc_links_arr = preg_split("/[\s\n,]+/",$misc_links);
	    
	   
            $data= $group = $url_text = array();
	    
            
            $data[]=FRONTEND_URL;
	    $url_text[] = 'Home';
	    $group[] = 'Main Pages';
	    
	    // cms page
	    $data[]=FRONTEND_URL."about-us/";
	    $url_text[] = 'About-us';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."contact-us/";
	    $url_text[] = 'Contact-us';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."management/";
	    $url_text[] = 'Management';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."press/";
	    $url_text[] = 'Press';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."agents-and-affiliates/";
	    $url_text[] = 'Agents-and-affiliates';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."terms-and-conditions/";
	    $url_text[] = 'Terms-and-conditions';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."privacy-policy/";
	    $url_text[] = 'Privacy-policy';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."groups/";
	    $url_text[] = 'Groups';
	    $group[]='Cms Pages';
	    
	    $data[]=FRONTEND_URL."guides-and-info/";
	    $url_text[] = 'Guides-and-info';
	    $group[]='Cms Pages';
	    
	    // blog page
	    
	    $data[]=FRONTEND_URL."blog/";
	    $url_text[] = 'Blog';
	    $group[]='Blog Pages';
	    
	    //property_type
	    
	    $data[]=FRONTEND_URL."hostel/";
	    $url_text[] = 'Hostel';
	    $group[]='Property Type Pages';
	    
	    $data[]=FRONTEND_URL."working-hostel/";
	    $url_text[] = 'Working-hostel';
	    $group[]='Property Type Pages';
	    
	    $data[]=FRONTEND_URL."hotel/";
	    $url_text[] = 'Hotel';
	    $group[]='Property Type Pages';
	    
	    $data[]=FRONTEND_URL."camping/";
	    $url_text[] = 'Camping';
	    $group[]='Property Type Pages';
	    
	    // provice pages
	    
	    $data[]=FRONTEND_URL."victoria/";
	    $url_text[] = 'Victoria';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."new-south-wales/";
	    $url_text[] = 'New-south-wales';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."tasmania/";
	    $url_text[] = 'Tasmania';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."queensland/";
	    $url_text[] = 'Queensland';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."south-australia/";
	    $url_text[] = 'South-australia';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."northern-territory/";
	    $url_text[] = 'Northern-territory';
	    $group[]='Province Pages';
	    
	    $data[]=FRONTEND_URL."western-australia/";
	    $url_text[] = 'Western-australia';
	    $group[]='Province Pages';
	    
	//    if(is_array($misc_links_arr) && count($misc_links_arr)){
	//	foreach($misc_links_arr as $misc_link){
	//	    if($misc_link){
	//		$data[] = $misc_link;
	//		$url_text[] = $misc_link;
	//		$group[] = 'others';
	//	    }
	//	}
	//    }

	    // city_pages
	    if(is_array($city) and count($city)>0){
                foreach($city as $c){
                    $data[]=FRONTEND_URL.$c['province_slug']."/".$c['city_seo_slug'].'/';
		    $url_text[] = $c['city_name'];
		    $group[] 	= "City pages";
                }
            }
	    
	    //property_details_pages
	    
            if(is_array($property_details) and count($property_details)>0){
                foreach($property_details as $pd){
                    $data[]=FRONTEND_URL."property/".$pd['property_type_slug'].'/'.$pd['province_slug'].'/'.$pd['city_seo_slug'].'/'.$pd['property_slug'].'/';
		    $url_text[] = $pd['property_name'];
		    $group[] 	= "Property details page";
                }
            }
            



	    
	//    foreach($data as $k=>$d){
	//	if($d && preg_match('/maplist/',$d))
	//	    $data[$k] = $d."#!search";
	//
	//    }

            
            
            $str ="";
            
            
            $str .= '<?xml version="1.0" encoding="utf-8"?>' . "\n";
             //xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
            $str .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                             xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
            if(count($data)>0){
                foreach($data as $d){
                    $str .= '<url>' . "\n";
                    $str .="<loc>";
                    $str .=$d;
                    $str .="</loc>\n";
                    if($date!=''){
                        $str .="<lastmod>";
                        $str .=$date;
                        $str .="</lastmod>\n";
                    }
                    if($change_frequency!='' and $change_frequency!='Never'){
                        $str .="<changefreq>";
                        $str .=$change_frequency;
                        $str .="</changefreq>\n";
                    }
                    if($priority!=''){
                        $str .="<priority>";
                        $str .=$priority;
                        $str .="</priority>\n";
                    }
                    $str .= '</url>' . "\n";
                }
            }
            $str .= '</urlset>' . "\n";
            
           // header( 'Content-Type: application/xml' );
            //echo $str;
            //exit;
            $file= SERVER_ABSOLUTE_PATH."sitemap.xml";
            file_put_contents($file, $str);
	    
	    /// sitemap view fle update ///
	    //$this->edit_sitemap_view($data,$url_text,$group);
	    
            
            return $str;
    }

    public function edit_sitemap_view($links,$url_text,$group){
	$results = array();
	$top_html = '<div class="container">
			<div class="siteMap">
			    <div class="siteWrap">
				<div class="sitemaplist">		  		  
				    <span class="sitemap_heading">Sitemap</span>';
			    
        $middle_html  =		'';			    
        
	$bottom_html  =	 	'	</div>
				</div>
			    </div>
			</div>';			
			
        if(is_array($links) && count($links)){
	    foreach($links as $key=>$link){
		$results[$group[$key]][] = array(
						 'text' => $url_text[$key],
						 'link' => $link,
						 );
	    }
	}
	
	if(is_array($results) && count($results)){
	    foreach($results as $group_name => $group){
		if(is_array($group) && count($group)){
		    $middle_html .= '<span class="group">'. ucwords( str_replace( '_',' ', $group_name )) .'</span><ul>';		    
		    foreach($group as $element){
			$middle_html .=  '<li><a href="'.$element['link'].'" >'.$element['text'].'</a></li>';
		    }		    
		    $middle_html .= '</ul><br>';
		}
	    }
	    
	}//if count
	
	if($middle_html){
	    $html = $top_html.$middle_html.$bottom_html;
	  @file_put_contents( SERVER_ABSOLUTE_PATH.'front-app/views/sitemap/sitemap.php',$html);
	}
	
    }
    
    
}

?>