<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
      <title>Hostel Mofo</title>
      <link rel="shortcut icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
      <!----css------>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>owl.carousel.css">
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>font-awesome.css">
      <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>slidebars.css">
      <!--<link rel="stylesheet" type="text/css" href="<?php //echo FRONT_CSS_PATH;?>jquery.pagepiling.css" />-->
      <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>jquery-ui.css">
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>style.css">
      
      
       <!----------------end css------>
      
      <!--------------JS------------------>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script>      
    <script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-script.js"></script>
<!-- <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script>
    <script type="text/javascript" src="<?php //echo FRONT_JS_PATH;?>jquery.validate.min.js"></script>-->
    <script type="text/javascript"> var base_url = '<?php echo FRONTEND_URL; ?>'</script>  
    <script type="text/javascript"> var filterOption = 'index';</script>
      <!--------------End JS------------------>
           
   <script>
      

             
      $(document).ready(function(){
         var ht = $( window ).height();
         //var wt = $( window ).width();
         //console.log(ht);
         //console.log(wt);
         var ht =  screen.height;
         ht = parseInt(ht)-100;
         //$('#apps_popup_sec').height(ht).css();
         $('#apps_popup_sec').attr('style','height: '+ht+'px;');
         
      });
   </script>
   

   
   </head>
   <body  class="home_body">
   <?php if((strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || checkFirstTime() == 'Yes') && setFirstTime() == 'No'){?>      
<div class="apps_popup" id="apps_popup_sec">
   
         <div class="MainCon clearfix">
            <a href="<?php echo FRONTEND_URL; ?>" class="popup_app"><img class="aligncenter" alt="img" src="<?php echo FRONTEND_URL;?>images/logo.png"></a>
             <div class="appTxt appPopupSec">
                <h3> Check out the <strong>HostelMofo</strong> app </h3>
                <span>Book from anywhere and win awesome weekly prizes</span> 
                <div class="appBtn">
                  <?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){?>
                   <a href="https://itunes.apple.com/in/app/hostelmofo/id1194419807?mt=8"><img alt="img" src="<?php //echo FRONTEND_URL;?>images/app-str.png"></a>
                   <?php }?>
                    <?php if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) { ?>
                   <a href="https://play.google.com/store/apps/details?id=com.hostelmofo"><img alt="img" src="<?php echo FRONTEND_URL;?>images/ggl-ply.png"></a>
                   <?php }?>
                </div>
                <a class="cont" href="<?php echo FRONTEND_URL.'home/setfirstTime/';?>">Continue to hostelmofo</a>
             </div>             
         </div>
</div>
<?php }?>
<?php
//
//echo "===".checkFirstTime();
//echo "<pre>";
//print_r($_SERVER['HTTP_USER_AGENT']);
//echo "</pre>";
?>



 
<div class="wrapper" canvas="container" >
    <section class="header">
        <div class="content-wrapper">

            <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
            <?=isset($content_for_layout_banner_home)?$content_for_layout_banner_home:'';?>
            
            </div>
    </section>

    <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
    <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
    
</div>


      <div off-canvas="slidebar-2 right shift">
         <ul class="sideNav">
            <li <?php if($header_selected == 'home'){ ?> class="active" <?php } ?>><a href="<?php echo FRONTEND_URL;?>">Home</a></li>
            <?php
            foreach($header_tab as $ht){
               $url = FRONTEND_URL.$ht['property_type_slug'].'/';
               $class = '';
               if($ht['property_type_slug'] == $header_selected){
                  $class	= 'active';
               }
               ?>
               <li class="<?php echo $class;?>"><a href="<?php echo $url;?>"><?php echo $ht['property_type_name'];?></a></li>
               <?php
            }
            ?>
            <li><a href="<?php echo FRONTEND_URL.'blog/'?>">Blog</a></li>
         </ul>
      </div>


   </body>
</html>