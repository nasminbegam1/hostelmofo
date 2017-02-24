<!doctype html>
<html>
<head>
	       <link rel="shortcut icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
	 <meta charset="utf-8">
  <?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>font-awesome.css">
  <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>slidebars.css">
  <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script> -->
  <!--<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>-->
	<script type="text/javascript">var base_url = '<?php echo FRONTEND_URL; ?>'</script>  
	<script src="<?php echo FRONT_JS_PATH;?>custom-script.js"></script>
	<script src="<?php echo FRONT_JS_PATH;?>bootstrap-modal.js"></script>
		<script src="<?php echo FRONT_JS_PATH;?>bootstrap-modalmanager.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>easy-responsive-tabs.css" />
  <link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>jquery-ui.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>bootstrap-modal.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>bootstrap-modal-bs3patch.css" />
</head>
<body class="forloginlist">
	
	 <div class="wrapper innrPg property" canvas="container">   
			<?=isset($content_for_layout_banner)?$content_for_layout_banner:'';?>
			<!--main content-->
			<?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
	 </div>
	 </div>
	 <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
</body>
</html>































<?php /*<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
<link href="<?php echo FRONT_CSS_PATH;?>styles.css" type="text/css" rel="stylesheet" media="all" />
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-search.js" defer></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-script.js" defer></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>jquery.validate.min.js" defer></script>
<script >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<link rel="icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<!--<link href="<?php echo CDN_CSS_PATH;?>" type="text/css" rel="stylesheet" media="all" />
<script >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<script type="text/javascript" src="<?php echo CDN_JS_PATH;?>" defer></script>-->

</head>

<body>
<div class="page globalClr"> <?php echo isset($content_for_layout_header)?$content_for_layout_header:'';?>
  <div class="main globalClr innerMain"> <?php echo isset($content_for_layout_banner)?$content_for_layout_banner:'';?>
    <div class="sectionPanel globalClr fullWidth">
      <!---------- landing page ----------->      
      <div class="locationBanner globalClr">       
        <?php  echo isset($content_for_layout_landingbanner)?$content_for_layout_landingbanner:'';?>
        <!--<img src="<?php echo FRONT_IMAGE_PATH;?>banner-loca.jpg"  alt=""/>
        <span class="locationTitle">Sydney</span>-->
      </div>
      <!----------------------------->      
      <div class="mainWrap clearfix">        
        <div class="sectionContent globalClr">
          <?php echo isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
        </div>
      </div> 
    </div>
  </div>
  <?php echo isset($content_for_layout_footer)?$content_for_layout_footer:'';?> </div>
</body>
</html>
*/?>


<!--
<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
  <link rel="stylesheet" type="text/css" href="<?php //echo FRONT_CSS_PATH;?>style.css">
  <link rel="stylesheet" type="text/css" href="<?php //echo FRONT_CSS_PATH;?>owl.carousel.css">
  <link rel="stylesheet" href="<?php //echo FRONT_CSS_PATH;?>slidebars.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script> 
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">var base_url = '<?php //echo FRONTEND_URL; ?>'</script>  
	<script src="<?php //echo FRONT_JS_PATH;?>custom-script.js"></script>
	<script src="<?php //echo FRONT_JS_PATH;?>bootstrap-modal.js"></script>
		<script src="<?php //echo FRONT_JS_PATH;?>bootstrap-modalmanager.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="<?php //echo FRONT_CSS_PATH;?>easy-responsive-tabs.css" />
  <link type="text/css" rel="stylesheet" href="<?php //echo FRONT_CSS_PATH;?>jquery-ui.css" />
	<link type="text/css" rel="stylesheet" href="<?php //echo FRONT_CSS_PATH;?>bootstrap-modal.css" />
	<link type="text/css" rel="stylesheet" href="<?php //echo FRONT_CSS_PATH;?>bootstrap-modal-bs3patch.css" />
</head>
<body>

<div class="page globalClr"> <?php //echo isset($content_for_layout_header)?$content_for_layout_header:'';?>
  <div class="main globalClr innerMain"> <?php //echo isset($content_for_layout_banner)?$content_for_layout_banner:'';?>
    <div class="sectionPanel globalClr fullWidth">
      
      <div class="locationBanner globalClr">       
        <?php  //echo isset($content_for_layout_landingbanner)?$content_for_layout_landingbanner:'';?>
        <img src="<?php //echo FRONT_IMAGE_PATH;?>banner-loca.jpg"  alt=""/>
        <span class="locationTitle">Sydney</span>
      </div>
      <div class="mainWrap clearfix">        
        <div class="sectionContent globalClr">
          <?php //echo isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
        </div>
      </div> 
    </div>
  </div>
  <?php //echo isset($content_for_layout_footer)?$content_for_layout_footer:'';?> </div>
</body>
</html>-->