<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon"/>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
    <link href="<?php echo get_template_directory_uri(); ?>/css/custom-style.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom-script.js"></script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header class="header globalClr" >
        	<div class="headerTopPanel globalClr">
    	<div class="mainWrap clearfix">
        	<ul>
                <li><a href="#">Recently Seen</a></li>
                <li><a href="#">My Lists</a></li>
                <li><a href="#">Manage booking</a></li>
            </ul>
            </div>
        </div>
        <div class="mainWrap clearfix">
    <span class="logo ltCls"><a href=" <?php echo FRONTEND_URL;//esc_url( home_url( '' ) ); ?> "><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo"/></a></span>
    <div class="headerRt rtCls">
	
      <div class="headerBottom globalClr clearfix">
        <nav class="navigationSec ">	   	    
          <ul class="nav-collapse">            
		<li><a href="<?php echo FRONTEND_URL;?>">HOME</a></li> 
		<li><a href="<?php echo FRONTEND_URL;?>hostel/">Hostel</a></li>
		<li><a href="<?php echo FRONTEND_URL;?>working-hostel/">Working Hostel</a></li>
		<li><a href="<?php echo FRONTEND_URL;?>hotel/">Hotel</a></li>
		<li><a href="<?php echo FRONTEND_URL;?>camping/">Camping</a></li>
		<li class="active"><a href="<?php echo FRONTEND_URL;?>blog/">BLOG</a></li>
          </ul>
        </nav>
      </div>      
      
      </div>
    </div>
		</header><!-- #masthead -->

		<div id="main" class="site-main">
<div class="bannerSec globalClr">
      <div class="bannerImg innerBanner"><img width="1680" height="368" alt="banner" src="<?php echo get_template_directory_uri(); ?>/images/inner-banner.jpg"></div>
      
    </div>