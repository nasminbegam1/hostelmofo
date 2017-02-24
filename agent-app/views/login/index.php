<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>HostelMofo | Agent Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo AGENT_CSS_PATH; ?>login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo AGENT_CSS_PATH; ?>components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo AGENT_CSS_PATH; ?>custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="<?php echo FRONTEND_URL; ?>">
	<img src="<?php echo FRONTEND_URL; ?>images/logo2.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url('login'); ?>" method="post">
		<h3 class="form-title">Agent Log In</h3>
		<?php if(validation_errors() || isset($error_msg)){ ?>
		<div class="alert alert-danger invalid ">
			<span>
				<?php
				 echo validation_errors();
				 echo isset($error_msg)? $error_msg:'';
				?>			
			</span>
		</div>
		<?php }?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter email id and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
		<div class="form-actions">
			<input type="submit" name="login" class="btn btn-success uppercase" value="Login" />
			<label class="rememberme check">
			<!--<input type="checkbox" name="login_remember" id="login_remember" value="1" <?php if(isset($_COOKIE['ucookname']) && $_COOKIE['ucookname'] != ''){echo 'CHECKED';}?>/>Remember </label>-->
			<a href="<?php echo base_url('login'); ?>/forgotpassword/" id="forget-password" class="forget-password">Forgot Password?</a>			
		</div>
	</form>
	<!-- END LOGIN FORM -->
	
</div>
<div class="copyright">
	 <?php echo date('Y'); ?> &copy; HostelMofo.
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo AGENT_JS_PATH; ?>respond.min.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo AGENT_JS_PATH; ?>jquery.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo AGENT_JS_PATH; ?>jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo AGENT_JS_PATH; ?>metronic.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>layout.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>demo.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>