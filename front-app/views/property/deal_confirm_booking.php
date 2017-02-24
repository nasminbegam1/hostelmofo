<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');

?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>

<input type="hidden" name="bookingType" value="deal">
<form name="frm" method="post" action="<?php echo FRONTEND_URL.'home/dealPost/';?>">
<input type="hidden" name="action" value="dealSubmit">
<input type="hidden" name="deal_id" value="<?php echo $room_detail['deal_details']['deal_id']; ?>">
<input type="hidden" name="pslug" id="pslug" value="<?php echo $property_slug;?>">
<div class="listingContent globalClr">

<?php if($succmsg != ''){?>
      <div class="succmsg"><?php echo $succmsg;?></div>
      <?php } if($errmsg != ''){?>
      
      <div class="errmsg"><?php echo $errmsg;?></div>
      <?php }?>

  <div class="targetDiv"  >

  <div class="allPopupBoxIn bigPop">
    <div class="bookFormPn globalClr popupInSec"> 
      <h3>Room Summary</h3>
        <div class="globalClr">
	    
        <table width="100%" class="confPayment">
		  <tr>
			<td>Deal Name</td>
			<td><?php echo stripslashes($room_detail['deal_details']['deal_name']); ?></td>
		  </tr>
		  <!--<tr>
			<td>Price</td>
			<td><?php echo stripslashes($room_detail['deal_details']['price']); ?></td>
		  </tr>-->
		<tr>				
			<th>Room Type</th>
			<th>Person</th>
		</tr>
		
		<?php
		$total_no_of_person = '';
		
		if(is_array($room_detail)){
		  foreach($room_detail['room_details'] as $rDetails){
			$total_no_of_person += $rDetails['room_type_value'];
		?>
		  <tr>
			<input type="hidden" name="room_type_id[]" value="<?php echo $rDetails['id']; ?>">
			<input type="hidden" name="no_person[]" value="<?php echo $rDetails['room_type_value']; ?>">
			<input type="hidden" name="room_price[]" value="<?php echo $room_detail['deal_details']['price']*$room_detail['deal_details']['DiffDate']*$rDetails['room_type_value']; ?>">
			<td>
			<?php echo stripslashes($rDetails['type_name']); ?>
			</td>
			<td>
			<?php echo stripslashes($rDetails['room_type_value']); ?>
			</td>
		  </tr>
		<?php
		  }
		}
		?>
		<tr>
		  <td>Total Price</td>
		  <td>
		  <?php
		  $total_price1 = ($room_detail['deal_details']['price']* $room_detail['deal_details']['DiffDate'] * $total_no_of_person);
		 $total_price = number_format($room_detail['deal_details']['price']* $room_detail['deal_details']['DiffDate'] * $total_no_of_person,2);
		  ?>
		  <?php echo currentPrice($total_price1,$currencySymbol,$currencyRate);?>
		  </td>
		</tr>
	</table>
	
	    <div class="booking_type">
		<h2>Booking Type</h2>
		<div class="booking_type_select">
		  <input type="radio" name="bookingType" class="bookingtype" id="non_flexible" required="required" checked="checked" value="Non-flexible"><h4>Non-flexible Booking</h4>
		  <br>
		  <span>Your deposit is protected so you can use it to make another booking if you cancel. <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Standard T&Cs apply</a></span>
	        </div>
		<div class="booking_type_select">
		  <input type="radio" name="bookingType" id="flexible" class="bookingtype" required="required" value="flexible"><h4>Standard Flexible Booking</h4>
		<br>
		<span>Your deposit is non-refundable if you decide to cancel your booking. <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Standard T&Cs apply.</a></span>
		</div>  
		
		
	    </div> 
    </div>
  </div>
</div>
  <div class="targetDiv" >

  <div class="allPopupBoxIn bigPop">
      <?php if($this->nsession->userdata('USER_ID') != ''){?>
      <p><a class="inputBtnOth" id="existing_user" href="javascript:void(0);">Continue with your account</a></p>
      <?php }else{ ?>
      <p id="book_now-btn" style="display: block;"> <a class="inputBtnOth" id="create_account" href="javascript:void(0);">Create an account</a> <a class="inputBtnOth" id="book_now" href="javascript:void(0);">Book without making an account  </a> </p>
      
      <?php } ?>
  </div>
  </div>
 

  <div class="targetDiv" id="create_account_secton" style="display: none;" >

  <div class="allPopupBoxIn bigPop">
    <div class="bookFormPn globalClr popupInSec"> 
      <h3>Create an Account</h3>
      
      <p class="succEnqMsg"></p>
      
        <input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
        <input name="action" value="Process" type="hidden">
    
		
	
        <div class="formFiled globalClr">
        <p>
          <input placeholder="First Name*" name="user_first_name" class="" id="user_first_name" type="text">
        </p>
        <p>
          <input placeholder="Sur Name*" name="sur_name"  id="sur_name" class="" type="text">
        </p>
	 <p>
          <input placeholder="Email Address*" name="user_email"  id="user_email" class="requiredTextEnq" type="text">
        </p>
        <p>
          <input placeholder="Password*" name="password"  class="form-control requiredTextEnq" id="password" type="password">
        </p>
	
	<p>
          <input placeholder="Confirm Password*" name="conf_password"  class="form-control requiredTextEnq" id="conf_password" type="password">
        </p>
	

        
	<p></p>
        </div>
        
        <p>
          <input name="payment" value="payment" type="hidden">
          <!--<input value="Confirm Payment" class="messageBtn messageVtnEnquery"  type="submit" >-->
	    <input type="button" name="cr_submit" id="cr_submit" value="Create">
	    <input type="button" id="cancel_uesr" value="Cancel">
	    <span id="display_msg"></span>  
        </p>
      
    </div>
  </div>
  <br><br>
</div>


  <div class="targetDiv" id="user_details_section" style="display: none;" >

  <div class="allPopupBoxIn bigPop">
    <div class="bookFormPn globalClr popupInSec"> 
      <h3>Your Details</h3>
      
      <p class="succEnqMsg" id="user_errmsg"></p>
      
        <input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
        <input name="action" value="Process" type="hidden">
    
	
        <div class="formFiled globalClr">
	 <div id="unregister_section">
        <p>
          <input placeholder="First Name*" name="first_name" class="requiredTextEnq" id="first_name1" type="text">
        </p>
        <p>
          <input placeholder="Last Name*" name="last_name"  id="last_name1" class="requiredTextEnq" type="text">
        </p>
        <p>
          <input placeholder="Email Address*" name="email1"  class="form-control requiredTextEnq" id="email1" type="email">
        </p>
        
	</div>
	
	<p>
	  
	  <select name="nationality" id="nationality">
	    <option value="">Select Nationality</option>
	    <?php
	    if(is_array($country_list) )
	    {
	      foreach($country_list as $country){
	    ?>
	    <option value="<?php echo $country['idCountry']?>"><?php echo $country['countryName'];?></option>
	    <?php }}?>
	    
	  </select>
          
        </p>
	
	<p>
          <input placeholder="Arrival Time*" name="arrival_time" id="arrival_time" type="text">
        </p>
	
	<p>
          
	   <select name="prefix_phone" id="prefix_phone" style="width: 120px;">
	    <option value="">Code</option>
	    <?php
	    if(is_array($country_phone) )
	    {
	      foreach($country_phone as $phone){
	    ?>
	    <option value="<?php echo $phone['phonecode']?>"><?php echo $phone['phonecode']." (". $phone['code'].")";?></option>
	    <?php }}?>
	    
	  </select> 
	    
	  <input placeholder="Phone Number*" onkeydown="javascript:return Numeric(event);" name="suffix_phone" id="suffix_phone" type="text" style="width: 256px;">
        </p>
	
	<p>
          <input placeholder="Text Sms" name="text_sms" id="text_sms" type="text">
        </p>
	
	<p>
          <select name="gender" id="gender">
	    <option value=""> Choose Gender</option>
	    <option value="Male">Male</option>
	    <option value="Female">Female</option>
	  </select>
        </p>
		
	<p></p>
        </div>
		<input type="button" id="continue_uesr_details" value="Continue">
		<input type="button" id="cancel_uesr_details" value="Cancel">
      
    </div>
  </div>
</div>

<div style="display: none" id="exist_user_arrival_time" class="inputDiv">
      <div class="bookFormPn globalClr popupInSec">
      <div class="formFiled globalClr clearfix">
      <div class="intFiledDiv">
          <label>Arrival Time*</label>
          <input placeholder="Arrival Time*" name="arrival_time1" id="arrival_time1" type="text" class="requiredTextEnq">
      </div>
      </div>
      </div>
</div>
<br>

<div class="targetDiv inputDiv" id="payment_details_section" style="display: none;" >
      
  <div class="allPopupBoxIn bigPop">
    <div class="bookFormPn globalClr popupInSec">
      <?php if($walletBlns > 0){ ?>
      <div id="wallet_section">
	    
	    <b>Your Wallet balance is <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo currentPrice($walletBlns,$currencySymbol,$currencyRate); ?></b>
	    
      </div>
      <?php } ?>
      <div class="payment-details-show">
      <h3>Payment Details </h3>
      
      <p class="succEnqMsg"></p>
      
      <input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
      <input name="action" value="Process" type="hidden">

      <div class="formFiled globalClr clearfix">
       
	    <div class="intFiledDiv">
	      <input placeholder="Creditcard Holder name*" name="cc_holder_name" id="cc_holder_name" class="requiredTextEnq" type="text" >
	    </div>
	    <div class="intFiledDiv">
	      <input placeholder="Creditcard Number*" name="cc_number" id="cc_number" class="requiredTextEnq" type="text">
	    </div>
	    <div class="intFiledDiv">
	      <select name="card_type" id="card_type">
		 <option value="">Select Card Type</option>
		    <option value="MasterCard">MasterCard</option>
		    <option selected="selected" value="Visa">Visa</option>
		    <option value="Discover">Discover</option>
		    <option value="Amex">Amex</option>
		    <option value="Maestro">Maestro</option>
	      </select>
	    </div>
	    <div class="intFiledDiv">
	      <input placeholder="Expiration Date (MM/YY)*" value="" name="exp_date" id="exp_date" class="requiredTextEnq" type="text">
	    </div>
	    <div class="intFiledDiv">
	      <input placeholder="CVV No*" name="cvv" id="cvv" class="requiredTextEnq" type="text">
	    </div>
      </div>
      </div>
    </div>
  </div>
</div>
   
    <div class="targetDiv" id="final_step_section" style="display: none;" >

  <div class="allPopupBoxIn bigPop">
    <div class="bookFormPn globalClr popupInSec"> 
      <h3>Final Step</h3>
	
        <div class="formFiled inpsty">
	 
	<p>
         <input type="checkbox" name="term_check" id="term_check" required="required" > I accept the <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Terms and conditions</a>
        </p>
	
	<p></p>
        </div>
        <p>
	    <h4>Total payable now: $<span id="tot_payble"><?php echo $total_price;?></span></h4> 
	</p>
        <p>
          <input name="payment" value="payment" type="hidden">
		
		
	   <input type="hidden" name="new_user_id" id="new_user_id">  
          <!--<input value="Confirm Payment" class="messageBtn messageVtnEnquery"  type="submit" >-->
	    <input type="submit" name="frm_submit" id="conf_submit" value="Confirm Payment">
        </p>
     
      
    </div>
  </div>
</div>

</div>
      <input type="hidden" name="wallet_balance" id="wallet_balance" value="<?php echo $walletBlns; ?>">
      <input type="hidden" name="currency_rate" id="currency_rate" value="<?php echo $currencyRate;?>">
      <input type="hidden" name="check_in"  value="<?php echo $room_detail['deal_details']['from_date'];?>">
      <input type="hidden" name="check_out"  value="<?php echo $room_detail['deal_details']['to_date'];?>">
      <input type="hidden" name="total_day"  value="<?php echo $room_detail['deal_details']['DiffDate'];?>">
      <input type="hidden" name="main_amount" id="main_amount" value="<?php echo $total_price;?>">
      <input type="hidden" name="property_price" id="property_price" value="<?php echo $total_price;?>">
      <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
      <input type="hidden" name="standard_flexible_amount" value="<?php echo $standard_flexible_amount;?>" id="standard_flexible_amount">



</form>

<link href="<?php echo FRONT_CSS_PATH;?>timepicki.css" type="text/css" rel="stylesheet" media="all" />

<script>
      $('#existing_user').click(function(){
	    $('#new_user_id').val('<?php echo $this->nsession->userdata('USER_ID'); ?>');
	    $('#exist_user_arrival_time').show();
	    $('#payment_details_section').show();
	    $('#final_step_section').show();
      });
</script>