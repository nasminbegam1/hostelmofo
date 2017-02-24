<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>

<!--<link href="<?php echo FRONT_CSS_PATH;?>map_styles.css" type="text/css" rel="stylesheet" media="all" />-->
<link href="<?php echo FRONT_CSS_PATH;?>styles.css" type="text/css" rel="stylesheet" media="all" />
<script type="application/javascript">
	var base_url = '<?php echo FRONTEND_URL; ?>';
	<?php if($_SERVER['HTTP_HOST']=='magento3.nextmp.net'){ echo 'var MAPLIST_PATH="/hostel/hostelmofo/"';}else{ echo 'var MAPLIST_PATH="/"'; } ?>
</script>

<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-script.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.js"></script>
<link rel="icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
</head>

<body>
<div class="page smallHeader globalClr">
  <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
  <?=isset($content_for_layout_topbar)?$content_for_layout_topbar:'';?>
  <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?> 
  <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
</div>
</body>
</html>
