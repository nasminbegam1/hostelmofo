<div class="allPopupBox targetDiv enquiryPopup" id="popid3">
  <div class="popUpOverlay"></div>
  <div class="popupLoader enqLoader" ><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
  <div class="allPopupBoxIn bigPop">
    <i class="fa fa-close closeIcon"></i>
    <div class="bookFormPn globalClr popupInSec"> 
      <h3>Confirm Your Details or ask a Question</h3>
      <p class="touchSoon">Please confirm your travel details and we will be in touch very soon!</p>
      <p class="succEnqMsg"></p>
      <form name="contactinfo" method="post" class="main enqueryFrm" onsubmit="contactinfo_subContact();">
        <input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
        <input name="action" value="Process" type="hidden">
        <input name="property_id" id="property_id" value="<?php echo $property_id; ?>" type="hidden">
        <input name="property_name" id="property_name" value="<?php echo $property_name; ?>" type="hidden">
	<input name="property_slug" id="property_name" value="<?php echo $property_slug; ?>" type="hidden">
	<input name="property_city" id="property_city" value="<?php echo $property_city; ?>" type="hidden">
	<input name="property_province" id="property_province" value="<?php echo $property_province; ?>" type="hidden">
	<input name="property_img" id="property_img" value="<?php echo $property_img; ?>" type="hidden">
	
	 
        <div class="calSec globalClr clearfix">
          <div id="enquiryCal" class="cincout-contener-static"></div>
          <input id="datepicker_popup1" class="cincout-input cincout-chkin ltCls" placeholder="Check In" readonly="" value="" name="check_in_time" type="text">
          <input id="datepicker_popup2" class="cincout-input cincout-chkout rtCls" placeholder="Check Out" readonly="" value="" name="check_out_time" type="text">
        </div>
        <div class="formFiled globalClr">
        <p>
          <input placeholder="First Name*" name="first_name" class="requiredTextEnq" id="first_name" type="text">
        </p>
        <p>
          <input placeholder="Last Name*" name="last_name"  id="last_name" class="requiredTextEnq" type="text">
        </p>
        <p>
          <input placeholder="Email Address*" name="email"  class="form-control requiredTextEnq" id="email" type="email">
        </p>
        <p>
          <input placeholder="Phone Number" name="phone" id="phone" type="text">
        </p>
        </div>
        <p>
          <textarea name="notes" data-required="true" class="form-control requiredTextEnq"  placeholder="Message*" id="notes"></textarea>
        </p>
        <p>
          <input name="enquiry_type" value="rental" type="hidden">
          <input value="Send Message" class="messageBtn messageVtnEnquery"  type="submit">
        </p>
      </form>
    </div>
  </div>
</div>
