<!doctype html>
<html>
		<head>
				<link rel="shortcut icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
				<link rel="icon" href="<?php echo FRONTEND_URL; ?>images/favicon.ico" type="image/x-icon">
				<meta charset="utf-8">
                                    <?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>
				<link type="text/css" rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>prettyPhoto.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>style.css">
				<link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>owl.carousel.css">
				<link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_PATH;?>font-awesome.css">
				<link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;?>slidebars.css">
				<script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script> 
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
						
						<!--main content-->
						<?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
				</div>
				
		</body>
</html>