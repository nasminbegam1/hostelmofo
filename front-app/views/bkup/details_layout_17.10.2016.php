<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>

<link href="<?php echo FRONT_CSS_PATH;?>styles.css" type="text/css" rel="stylesheet" media="all" />
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-script.js" defer></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>jquery.validate.min.js" defer></script>
<script >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<link rel="icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<!--<link href="<?php echo CDN_CSS_PATH;?>" type="text/css" rel="stylesheet" media="all" />
<script >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<script type="text/javascript" src="<?php echo CDN_JS_PATH;?>" defer></script>-->

<link href="<?php echo FRONT_CSS_PATH;?>/rating/rateit.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>  
<script src="<?php echo FRONT_JS_PATH;?>/rating/jquery.rateit.js" type="text/javascript"></script>

</head>

<body>
<div class="page globalClr">
    
  <?php echo isset($content_for_layout_header)?$content_for_layout_header:'';?>
  
  <div class="main globalClr innerMain">
    
    <?php echo isset($content_for_layout_banner)?$content_for_layout_banner:'';?>
    
    <div class="sectionPanel globalClr <?php echo (currentClass()=='home' and currentMethod()=='favourite')? ' fullWidth':''; ?> ">
      
      <div class="mainWrap clearfix">
	
        <div class="sectionContent globalClr">
          
	  <div class="detailsPanel globalClr clearfix">
	      
              <?php echo isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
    
          </div>
	  
        </div>
	
      </div>
      
    </div>
    
  </div>
  
  <?php echo isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
  
</div>
</body>
</html>
