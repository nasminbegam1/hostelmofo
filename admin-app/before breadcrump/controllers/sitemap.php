<?php

class Sitemap extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->model("model_basic");
    }
    
    public function index(){
       chk_login();
       if($this->input->post("action")=="Process"){
        
            $modified_date_type=$this->input->post("modified_date_type");
            $modified_date=$this->input->post("modified_date");
            $change_frequency=$this->input->post("change_frequency");
            $priority=$this->input->post("priority");
            
            $this->create_sitemap($modified_date_type,$modified_date,$change_frequency,$priority);
            
            $succmsg="Site map is generated successfully";
            $succmsg.="<br/>Updated Sitemap URL: <a href='".BACKEND_URL."sitemap.xml' target='_blank'>".BACKEND_URL."sitemap.xml</a>";
            $this->nsession->set_userdata('succmsg',$succmsg);
            
        }
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['base_url']=BACKEND_URL."sitemap/index";
        $this->nsession->set_userdata('succmsg', "");		
        
        
        
        $this->data['add_url']='';
        $this->data['brdLink']='';
        
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        
        $this->elements['middle']='sitemap/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);		
        
    }
    
    
    public function generate(){
        $str=$this->create_sitemap();
       
    }
    
    
    function create_sitemap($modified_date_type=1,$modified_date='',$change_frequency='Daily',$priority='1.0'){
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
        
            $property_rental    = $this->model_basic->getValues_conditions("lp_property_master as lpm, lp_rent_master as lrm", array('lpm.property_id','lpm.property_slug'), '', ' lpm.property_id=lrm.property_id and lpm.record_type="Rental" and lpm.status="active"');
            $property_sale      = $this->model_basic->getValues_conditions("lp_property_master as lpm,  lp_sales_master lsm ", array('lpm.property_id','lpm.property_slug'), '', ' lpm.property_id=lsm.property_id and lpm.record_type="Sales" and lpm.status="active"');
            $region             = $this->model_basic->getValues_conditions("lp_region_master",  array('region_id','region_slug'), '', 'region_status="active"');
            $location           = $this->model_basic->getValues_conditions("lp_location_master",  array('location_id','location_slug'), '', 'location_status="active"');
            $blogpost           = $this->model_basic->getValues_conditions("lp_wp_posts" , array('ID','post_name'), '', ' post_type = "post" AND post_status = "publish" ');
            
            //$blogtag            = $this->model_basic->getValues_conditions("lp_wp_terms as terms, lp_wp_term_taxonomy as taxo " , array('terms.term_id','terms.slug'), '', ' terms.term_id = taxo.term_id and taxo.taxonomy="post_tag"');
           // $blogcategory       = $this->model_basic->getValues_conditions("lp_wp_terms as terms, lp_wp_term_taxonomy as taxo " , array('terms.term_id','terms.slug'), '', ' terms.term_id = taxo.term_id and taxo.taxonomy="category"');
            
            
            $data=array();
            
            $data[]=FRONTEND_URL;
           
            $data[]=FRONTEND_URL."rentals-results/";
            if(is_array($property_rental) and count($property_rental)>0){
                foreach($property_rental as $p_r){
                    $data[]=FRONTEND_URL."property-rentals/".$p_r['property_slug'].'/';
                }
            }
            
            $data[]=FRONTEND_URL."sales-results/";
            if(is_array($property_sale) and count($property_sale)>0){
                foreach($property_sale as $p_s){
                    $data[]=FRONTEND_URL."property-sales/".$p_s['property_slug'].'/';
                }
            }
            
            
            $data[]=FRONTEND_URL."location/";
            if(is_array($location) and count($location)>0){
                foreach($location as $l){
                    $data[]=FRONTEND_URL."location/detail/".$l['location_slug']."/".$l['location_id'].'/';
                    $data[]=FRONTEND_URL."rentals-results/".$l['location_slug'].'/';
                    $data[]=FRONTEND_URL."sales-results/".$l['location_slug'].'/';
                }
            }
            
            if(is_array($region) and count($region)>0){
                foreach($region as $r){
                    $data[]=FRONTEND_URL."rentals-results/".$r['region_slug'].'/';
                    $data[]=FRONTEND_URL."sales-results/".$r['region_slug'].'/';
                }
            }
            
            $data[]=FRONTEND_URL."team/";
            $data[]=FRONTEND_URL."contactus/";
            $data[]=FRONTEND_URL."faq/";
            $data[]=FRONTEND_URL."livephuket-guarantee/";
            $data[]=FRONTEND_URL."cancellation-policy/";
            $data[]=FRONTEND_URL."privacy-policy/";
            $data[]=FRONTEND_URL."why-work-with-us/";
            $data[]=FRONTEND_URL."terms/";
            
            
            $data[]=FRONTEND_URL."blog/";
            if(is_array($blogpost) and count($blogpost)>0){
                foreach($blogpost as $bp){
                    $data[]=FRONTEND_URL."blog/".$bp['post_name']."/".$bp['ID'].'/';
                }
            }
            
            /*if(is_array($blogtag) and count($blogtag)>0){
                foreach($blogtag as $bt){
                    $data[]=FRONTEND_URL."blog/tag/".$bt['slug'];
                }
            }
            
           if(is_array($blogcategory) and count($blogcategory)>0){
                foreach($blogcategory as $bc){
                    $data[]=FRONTEND_URL."blog/category/".$bc['slug'];
                }
            }*/
            
            
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
           // echo $str;
           //exit;
            $file="../warp/sitemap.xml";
            file_put_contents($file, $str);
            
            return $str;
    }
    
}


?>