<!DOCTYPE html>
<html lang="en">
<head>
    <title>LivePhuket Administrative Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    
    <link rel="shortcut icon" href="<?php echo BACKEND_URL; ?>images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo BACKEND_URL; ?>images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo BACKEND_URL; ?>images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo BACKEND_URL; ?>images/icons/favicon-114x114.png">
    
  
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/bootstrap/css/bootstrap.min.css">
    <!--LOADING STYLESHEET FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/intro.js/introjs.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/calendar/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/intro.js/introjs.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/lightbox/css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-pace/pace.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/iCheck/skins/all.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/jquery.notific8.min.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/themes/style1/orange-blue.css" class="default-style">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/themes/style1/orange-blue.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/custom-style.css">
    
     <!--  data table style  -->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-tablesorter/themes/blue/style-custom.css">
    
    <!--  Notification message style  -->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-toastr/toastr.min.css">
    
    
    <!-----dropdown--------------->
    
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/select2/select2-madmin.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/bootstrap-select/bootstrap-select.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/multi-select/css/multi-select-madmin.css">
    <!------end drop down---->
    
    <!--  load jquery min   -->
    <script src="<?php echo BACKEND_URL; ?>js/jquery-1.10.2.min.js"></script>
    

        
    <script>
        function go_to(url){
            window.location = url;
            //alert(url);
        }
    </script>
    
   <style type="text/css">
    
.redText{color:#FF0000;}
.blueText{color:blue;}
.greenText{color:#008000;}

   </style>
    
</head>
<!--<body id="signin-page" class="header-fixed  undefined pace-done">-->
    <body id="signin-page">
<div>        
    <!--BEGIN TOPBAR-->
        <?php //$this->load->view('layout/topbar'); ?>
        <?=isset($content_for_layout_topbar)?$content_for_layout_topbar:'';?>
    <!--END TOPBAR-->
    <div id="wrapper">
        <!--BEGIN SIDEBAR MENU-->
            <?php //$this->load->view('layout/leftmenu'); ?>
            <?=isset($content_for_layout_leftmenu)?$content_for_layout_leftmenu:'';?>
        <!--END SIDEBAR MENU-->
        <!--BEGIN CHAT FORM-->
        <!--<div id="chat-form" class="fixed">
            <div class="chat-inner"><h2 class="chat-header"><a href="javascript:;" class="chat-form-close pull-right"><i class="glyphicon glyphicon-remove"></i></a><i class="fa fa-user"></i>&nbsp;
                Chat
                &nbsp;<span class="badge badge-info">3</span></h2>

                <div id="group-1" class="chat-group"><strong>Favorites</strong><a href="#"><span class="user-status is-online"></span>
                    <small>Verna Morton</small>
                    <span class="badge badge-info">2</span></a><a href="#"><span class="user-status is-online"></span>
                    <small>Delores Blake</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-busy"></span>
                    <small>Nathaniel Morris</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-idle"></span>
                    <small>Boyd Bridges</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Meredith Houston</small>
                    <span class="badge badge-info is-hidden">0</span></a></div>
                <div id="group-2" class="chat-group"><strong>Office</strong><a href="#"><span class="user-status is-busy"></span>
                    <small>Ann Scott</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Sherman Stokes</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Florence Pierce</small>
                    <span class="badge badge-info">1</span></a></div>
                <div id="group-3" class="chat-group"><strong>Friends</strong><a href="#"><span class="user-status is-online"></span>
                    <small>Willard Mckenzie</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-busy"></span>
                    <small>Jenny Frazier</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Chris Stewart</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Olivia Green</small>
                    <span class="badge badge-info is-hidden">0</span></a></div>
            </div>
            <div id="chat-box" style="top:400px">
                <div class="chat-box-header"><a href="#" class="chat-box-close pull-right"><i class="glyphicon glyphicon-remove"></i></a><span class="user-status is-online"></span><span class="display-name">Willard Mckenzie</span>
                    <small>Online</small>
                </div>
                <div class="chat-content">
                    <ul class="chat-box-body">
                        <li><p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" class="avt"/><span class="user">John Doe</span><span class="time">09:33</span></p>

                            <p>Hi Swlabs, we have some comments for you.</p></li>
                        <li class="odd"><p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/alagoon/48.jpg" class="avt"/><span class="user">Swlabs</span><span class="time">09:33</span></p>

                            <p>Hi, we're listening you...</p></li>
                    </ul>
                </div>
                <div class="chat-textarea"><input placeholder="Type your message" class="form-control"/></div>
            </div>
        </div>-->
        <!--END CHAT FORM-->
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?> 
        </div>
        <!--BEGIN FOOTER-->
            <?php //$this->load->view('layout/footer'); ?>
            
        <!--END FOOTER-->
        <!--END PAGE WRAPPER-->
    </div>
    <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
</div>


<script src="<?php echo BACKEND_URL; ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/jquery-ui.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/custom_functions.js"></script>

<script src="<?php echo BACKEND_JS_PATH ?>ui-tabs.js"></script>


<!--loading bootstrap js-->
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/html5shiv.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/respond.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-cookie/jquery.cookie.js"></script>

<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/icheck.min.js" ></script>
<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/custom.min.js"></script>

<?php // if($this->router->method!='price' and ($this->router->class!='custom_booking' and $this->router->method!='viewcustom')){ ?>
<!--<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/icheck.min.js" ></script>
<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/custom.min.js"></script>-->
<?php //} ?>

<script src="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/jquery.notific8.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-highcharts/highcharts.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/jquery.menu.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-pace/pace.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/holder/holder.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/responsive-tabs/responsive-tabs.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-news-ticker/jquery.newsTicker.min.js"></script>
<!--CORE JAVASCRIPT-->
<script src="<?php echo BACKEND_URL; ?>js/main.js"></script>

    
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/form-validation.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-steps/js/jquery.steps.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/form-wizard.js"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="<?php echo BACKEND_URL; ?>vendors/ckeditor/ckeditor.js"></script>

 <!-- load js for gallery -->
<script src="<?php echo BACKEND_URL; ?>vendors/mixitup/src/jquery.mixitup.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/page-gallery.js"></script>

<script src="<?php echo BACKEND_URL; ?>vendors/select2/select2.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/ui-dropdown-select.js"></script>

<!-- Notification message js -->
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/jquery.notific8.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-notific8/notific8.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-toastr/toastr.min.js"></script>

<!--- Table sorting ------>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-tablesorter/jquery.tablesorter.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/table-advanced.js"></script>


<!------setiing page------->
<!-------drop down------>

<script src="<?php echo BACKEND_URL; ?>vendors/select2/select2.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/ui-dropdown-select.js"></script>


<!--------end drop down---->

<!--<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/bootstrap-datepicker/css/datepicker.css">
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/bootstrap-daterangepicker/daterangepicker-bs3.css">
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>-->

<!--<script src="<?php echo BACKEND_URL; ?>vendors/intro.js/intro.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.categories.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.pie.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.tooltip.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.fillbetween.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.stack.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/flot-chart/jquery.flot.spline.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/calendar/zabuto_calendar.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/intro.js/intro.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/index.js"></script>-->
</body>
</html>