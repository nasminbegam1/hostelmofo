<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>HostelMofo | Agent Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo AGENT_CSS_PATH; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo AGENT_CSS_PATH; ?>simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo AGENT_CSS_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo AGENT_CSS_PATH; ?>uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?php echo AGENT_CSS_PATH; ?>bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo AGENT_CSS_PATH; ?>bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.css">
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/jquery.notific8.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-toastr/toastr.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/intro.js/introjs.css">
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/animate.css/animate.css">
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo AGENT_CSS_PATH; ?>tasks.css" rel="stylesheet" type="text/css"/>
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/custom-style.css">
<!--<link href="<?php //echo AGENT_CSS_PATH; ?>bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo AGENT_CSS_PATH; ?>fancybox/source/jquery.fancybox.css" rel="stylesheet"/>

<!-- END PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH; ?>bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH; ?>bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH; ?>bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH ;?>monthpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH ;?>bootstrap/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo AGENT_CSS_PATH ;?>bootstrap/css/bootstrap-datetimepicker.min.css"/>

<!-- BEGIN PAGE LEVEL STYLES -->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo AGENT_CSS_PATH; ?>components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo AGENT_CSS_PATH; ?>themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_CSS_PATH; ?>custom.css" rel="stylesheet" type="text/css"/>
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/themes/orange-blue.css" class="default-style">

<script src="<?php echo AGENT_JS_PATH; ?>jquery.min.js" type="text/javascript"></script>
<script>
     var base_url = '<?php echo base_url(); ?>';
</script>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
 <?=isset($content_for_layout_header)?$content_for_layout_header:'';?> 
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="container">
	<!-- BEGIN CONTAINER -->
	 <?$content_for_layout_breadcrumbs = isset($content_for_layout_breadcrumbs)?$content_for_layout_breadcrumbs:'';?> 
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
                <?=isset($content_for_layout_sidebar)?$content_for_layout_sidebar:'';?> 
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
                     <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?> 
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?> 
	<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<!--<script src="<?php echo AGENT_JS_PATH; ?>jquery-1.10.2.min.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-migrate-1.2.1.min.js"></script>-->
<script src="<?php echo AGENT_JS_PATH; ?>respond.min.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>excanvas.min.js"></script> 
<![endif]-->

<script src="<?php echo AGENT_JS_PATH; ?>jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-ui.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.form.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>custom_functions.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<!--<script src="<?php //echo AGENT_JS_PATH; ?>jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
-->
<!--<script src="<?php echo AGENT_JS_PATH . 'bootstrap/js/bootstrap-datepicker.js';?>" type="text/javascript"></script>-->
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH . 'monthpicker.min.js';?>" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH . 'bootstrap/js/bootstrap-datepicker.js';?>" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="<?php echo AGENT_JS_PATH; ?>metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery-cookie/jquery.cookie.js"></script>

<script src="<?php echo BACKEND_URL; ?>vendors/responsive-tabs/responsive-tabs.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>jquery.bootstrap.wizard.js"></script>

<script src="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/jquery.notific8.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/notific8.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-toastr/toastr.min.js"></script>
 
<script type="text/javascript" src="<?php echo AGENT_JS_PATH; ?>bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo AGENT_JS_PATH; ?>bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>bootstrap-summernote/summernote.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN: Page level plugins -->
<!--Dashboard-->

<!--end Dashboard-->


    <![endif]-->
<!-- END:File Upload Plugin JS files-->
<!-- END: Page level plugins -->

<script src="<?php echo AGENT_JS_PATH; ?>metronic.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>layout.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>demo.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>tasks.js" type="text/javascript"></script>
<script src="<?php echo AGENT_JS_PATH; ?>index.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init(); // init demo features
  if ($('.alert').length) {
     
    setTimeout(function(){ $(".alert").hide("slow");},5000);
  }
});
</script>
<script>
	  $(function() {
			 var nowDate = new Date();
			 var from 	= new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0,0);
			 
			 //$('#datetimepicker1').datepicker('setDate',nowDate);
			 $('#datetimepicker1').datepicker({
					autoclose:true,
					startDate: from,
					disableEntry: true,
		
			 })
			 .on('changeDate', function(selected){
					startDate = new Date(selected.date.valueOf());
					startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
					$('#datetimepicker2').datepicker('setStartDate', new Date(startDate.getTime()+1*24*60*60*1000) );
					$('#datetimepicker2').datepicker('setEndDate', new Date(startDate.getTime()+14*24*60*60*1000) );
					$( "#datetimepicker2" ).datepicker('show');
			 }); 
			 //$('#datetimepicker2').datepicker('update', new Date());
			 $('#datetimepicker2').datepicker({
					autoclose:true,
					startDate: '+1d',
					endDate: '+14d',
					disableEntry: true
			 })
			 .on('changeDate', function(selected){
					
			 });
			 
	  });
</script>
<!-- END JAVASCRIPTS -->
<div id="page_message" class="page_mess_animate page_mess_ok" style="display: none;"></div>
</body>
<!-- END BODY -->
</html>