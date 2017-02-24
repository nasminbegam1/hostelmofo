<div class="allPopupBox targetDiv" id="popid4">
  <div class="popUpOverlay"></div>
  <div class="popupLoader appLoader"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
  <div class="allPopupBoxIn bigPop"><i class="fa fa-close closeIcon"></i>
    <div class="sharedPopSec globalClr popupInSec"> 
      <h3> <?php echo stripslashes($property_name); ?> <span id="statusTextSpan"></span>  </h3>
      <span class="succEnqMsg"></span>
      <div class="globalClr shareBoxPan clearfix">
      	<div class="shareBox ltCls">
   	    <img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$featured_image['image_name']) ;?>" width="320" height="220" alt="img"> </div>
        <div class="shareBox rtCls">
        	
            	<div class="shrBxSec">
		  <form action="" method="post" class="approveFrm">
		    <input type="hidden" name="approve_captcha_value" value="0" id="approve_captcha_value" />
                    <input type="hidden" name="property_name" value="<?php echo stripslashes($property_name); ?>" />
                    <input type="hidden" name="property_slug" value="<?php echo stripslashes($property_slug); ?>" />
                    <input type="hidden" name="property_id"  value="<?php echo stripslashes($property_id); ?>" />
		    <input type="hidden" name="status" id="property_status" value="" />
                	<p><label class="globalClr">Your  email address<span class="globalClr">Example: dan@example.com</span></label><input name="agent_email" type="text" value="" class="requiredTextshr"  /></p>
			<p><label class="globalClr">Your Name</label><input type="text" name="agent_name" value=""  class="requiredTextshr"  /></p>
			<p><label class="globalClr">Your Message</label><textarea name="agent_message"  class="requiredTextshr"></textarea></p>
			<p><input type="submit" class="inputBtnOth approveDisapproveBtn" value="" name="status" /></p>
		    </form>
                </div>
            
        </div>
      </div>
    </div>
  </div>
</div>