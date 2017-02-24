<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<?=isset($content_for_layout_seo)?$content_for_layout_seo:'';?>

<link href="<?php echo FRONT_CSS_PATH;?>styles.css" type="text/css" rel="stylesheet" media="all" />
<script type="text/javascript" >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom-search.js"></script>
<link rel="icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo FRONT_IMAGE_PATH;?>favicon.ico" type="image/x-icon"/>
<!--<link href="<?php echo CDN_CSS_PATH;?>" type="text/css" rel="stylesheet" media="all" />
<script >var base_url = '<?php echo FRONTEND_URL; ?>';</script>
<script type="text/javascript" src="<?php echo CDN_JS_PATH;?>" defer></script>-->


</head>

<body>
<div class="page globalClr">    
  <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>  
  <div class="main globalClr">    
    <?=isset($content_for_layout_banner)?$content_for_layout_banner:'';?>    
    <div class="sectionPanel globalClr fullWidth">      
      <div class="mainWrap clearfix">	
        <div class="sectionContent globalClr">          
	  <div class="listingPanel globalClr clearfix">	    
            <?=isset($content_for_layout_leftpanel)?$content_for_layout_leftpanel:'';?>	    
            <div class="rightSide rtCls">		
              <?=isset($content_for_layout_breadcrumb)?$content_for_layout_breadcrumb:'';?>	      
              <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>            
	    </div>	    
          </div>	  
        </div>	
      </div>      
    </div>    
  </div>
  
  <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
  
</div>
</body>
</html>
