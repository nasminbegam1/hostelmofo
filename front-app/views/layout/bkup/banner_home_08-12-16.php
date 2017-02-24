<div id="owl-demo" class="owl-carousel owl-theme">
	 <?php
	 if(is_array($banner_list)){
		  foreach($banner_list as $banner){?>
				 <div class="item">
						<img src="<?php //echo isFileExist(CDN_BANNER_THUMB_IMG.$banner['banner_image'],FRONT_IMAGE_PATH.'banner.jpg');?>" width="1680" height="773" alt="<?php echo stripslashes($banner['banner_title']);?>">
						<span></span>
				 </div>
				 <?php
		  }
	 }
	 else{?>
			<div class="item">
				 <img src="<?php echo FRONT_IMAGE_PATH;?>banner.jpg" width="1680" height="773" alt="banner">
				 <span></span>
			</div>
			<?php
	 }
	 ?>
</div>