<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
      <title>Hostel Mofo</title>
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>style.css">
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>owl.carousel.css">
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>font-awesome.css">
      <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>slidebars.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
      <script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script> 
      <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
      
      <script type="text/javascript">var base_url = '<?php echo FRONTEND_URL; ?>'</script>  
      <script src="<?php echo FRONT_JS_PATH;?>custom-script.js"></script>
      <script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>jquery.validate.min.js"></script>
    
      <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>jquery.pagepiling.css" />
      <script type="text/javascript">
         var filterOption = 'index';
      </script>
   </head>
   <body>
      <div class="wrapper" canvas="container" id="pagepiling">
         <section class="background header section" id="section1">
            <div class="content-wrapper">
               <?=isset($content_for_layout_banner_home)?$content_for_layout_banner_home:'';?>
               <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
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