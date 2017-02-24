<div class="allPopupBox targetDiv" id="popid2">
  <div class="popUpOverlay"></div>
  <div class="popupLoader shareLoader"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
  <div class="allPopupBoxIn bigPop"><i class="fa fa-close closeIcon"></i>
    <div class="sharedPopSec globalClr popupInSec"> 
      <h3>Share <?php echo stripslashes($property_name); ?> with a friend</h3>
      <span class="succEnqMsg"></span>
      <div class="globalClr shareBoxPan clearfix">
      	<div class="shareBox ltCls">
	  <?php if(isset($featured_image['image_name'])){ ?>
   	    <img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$featured_image['image_name']) ;?>" width="320" height="220" alt="img"> </div>
	  <?php } ?>
	<div class="shareBox rtCls">
        	
            	<div class="shrBxSec">
		  <form action="" method="post" class="shareFrm">
                    <input type="hidden" name="property_name" value="<?php echo stripslashes($property_name); ?>" />
                    <input type="hidden" name="property_slug" value="<?php echo stripslashes($property_slug); ?>" />
                    
                	<p><label class="globalClr">Your friend's email address(es)<span class="globalClr">Example: dan@example.com</span></label><input name="to_email" type="text" value="" class="requiredTextshr"  /></p>
			<p><label class="globalClr">Your Name</label><input type="text" name="share_name" value=""  class="requiredTextshr"  /></p>
			<p><label class="globalClr">Your email address</label><input type="text" name="from_email" value=""  class="requiredTextshr" /></p>
			<p><label class="globalClr">Your Message<span class="globalClr">Optional</span></label><textarea name="share_text"  class="requiredTextshr"></textarea></p>
			<p><input type="submit" class="inputBtnOth shareWithFriendBtn" value="Send this property to my friends" name="Send this property to my friends" /></p>
		    </form>
                </div>
            
        </div>
      </div>
    </div>
  </div>
</div>