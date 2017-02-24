<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
<div class="main">
    <div class="MainCon">
<form action="" method="post" name="frm" id="profileFrm">
    <div class="listingContent globalClr">
        <div class="targetDiv Cststylng">
            <h3>Personal Details</h3>
     
    <div class="formFiled globalClr clearfix">
        <?php if(isset($errmsg) && !empty($errmsg)) { echo "<p class='error'>".$errmsg."</p>";} ?>
        <?php if(isset($sucmsg) && !empty($sucmsg)){ echo "<p class='success'>".$sucmsg."</p>";} ?>
        <div class="intFiledDiv hlfsz">
            <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo $user_details[0]['firstname']; ?>" placeholder="Enter your first name here">
        </div>
        <div class="intFiledDiv hlfsz mrgof">
             <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo $user_details[0]['lastname']; ?>" placeholder="Enter your last name here">
        </div>
        <div class="intFiledDiv hlfsz">
             <label>Email</label>
        <input type="email" name="email" value="<?php echo $user_details[0]['email']; ?>" placeholder="Enter your email here">
        </div>
        <div class="intFiledDiv hlfsz mrgof">
             <label>Mobile Number</label>
             <div class="mobile">
        <select name="country_code" id="country_code" style="width: 22%;">
            <optgroup label="Country Code">
                    <?php if(is_array($country_phone) ){?>
                    <?php	foreach($country_phone as $phone){?>
                    <?php if($phone['is_prefered'] == 1){?>
                    
                        <option value="<?php echo $phone['phonecode']?>"><?php echo $phone['nicename']." (+". $phone['phonecode'].")";?></option>											
                    <?php }}}?>
                    </optgroup>
                    
                    
                    <?php if(is_array($country_phone) ){?>												
                        <optgroup label="Other Countries">
                    <?php	foreach($country_phone as $phone){?>
                        <?php if($phone['is_prefered'] == 0){?>
                        
                            <option value="<?php echo $phone['phonecode']?>"><?php echo $phone['nicename']." (+". $phone['phonecode'].")";?></option>
                    
                        
                        <?php }?>
                            <?php
                        }
                        ?>
                            </optgroup>
                        <?php
                    }
                    ?>
    </select>
       
        <input type="text" style="width: 60%;" name="phone" value="<?php echo $user_details[0]['mobile_no']; ?>" placeholder="Enter your phone no here">
        </div>
        </div>
        <div class="intFiledDiv decsz">
             <label>Month</label>
        <select name="birthMonth">
            <option value="">Select your birth month</option>
            <?php for($i=1;$i<13;$i++) {?>
            <option value="<?php echo $i; ?>" <?php echo ($i == $user_details[0]['birthMonth']) ? "selected" : "" ;?>>
            <?php echo $i; ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="intFiledDiv decsz">
             <label>Day</label>
        <select name="birthDay">
            <option value="">Select your birth month</option>
            <?php for($i=1;$i<32;$i++) {?>
            <option value="<?php echo $i; ?>" <?php echo ($i == $user_details[0]['birthDate']) ? "selected" : "" ;?>>
            <?php echo $i; ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="intFiledDiv decsz mrgof">
             <label>Year</label>
        <select name="birthYear">
            <option value="">Select your birth month</option>
            <?php for($i=1970;$i<2017;$i++) {?>
            <option value="<?php echo $i; ?>" <?php echo ($i == $user_details[0]['birthYear']) ? "selected" : "" ;?>>
            <?php echo $i; ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="intFiledDiv fulsz">
             <label>Nationality</label>
        <select name="nationality">
            <option value="">Select your nationality</option>
            <?php foreach($country_list as $cl) {?>
            <option value="<?php echo $cl['idCountry']?>" <?php echo ($cl['idCountry'] == $user_details[0]['nationality']) ? "selected" : "" ;?>>
            <?php echo $cl['countryName']; ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="intFiledDiv fulsz">
             <label>Address</label>
            <textarea name="address"><?php echo $user_details[0]['location']; ?></textarea>
        </div>
        
        
        
        <div class="change_pass_sec">
           <h3>Change Password</h3> 
                <div class="intFiledDiv hlfsz">
                    <label>Current Password</label>
                <input type="password" name="current_password" value="" placeholder="Enter your current password here">
                </div>
                <div class="intFiledDiv hlfsz mrgof">
                     <label>New Pasword</label>
                <input type="password" name="new_password" value="" id="new_password" placeholder="Enter your new password here">
                </div>
                <div class="intFiledDiv hlfsz">
                     <label>Confirm Password</label>
                <input type="password" name="confirm_password" value="" placeholder="Enter your confirm password here">
                </div>

        </div>
        
        <div class="credit_sec">
                <h3>Credits</h3>    
                <div class="intFiledDiv hlfsz">
                    <label>Booking Guarantee</label>
                <input type="text" name="booking_guarantee" value="" >
                </div>
                <div class="intFiledDiv hlfsz mrgof">
                     <label>Cancellation Protection</label>
                <input type="text" name="cancellation_protection" value="" >
                </div>
                <div class="intFiledDiv hlfsz">
                     <label>Promotional Credits</label>
                <input type="text" name="promotional_credits">
                </div>
            <a href="">View Credits</a>
        </div>
        
        <div class="payment_sec">
            <h3>Payment Method</h3>
            <a href="">Add Card</a>
        </div>
        
        
        
        <div class="intFiledDiv fulsz privacy_sec">
             <h3>Privacy Preference</h3>
            <input type="radio" <?php if($user_details[0]['privacy'] == 'Public') echo "checked";?> name="privacy_preference" id="public" value="Public"> Public <span class="pp_sec">Profile can be viewed by everyone.</span>
            <input type="radio" <?php if($user_details[0]['privacy'] == 'Private') echo "checked";?> name="privacy_preference" id="private" value="Private"> Private <span class="pp_sec">Profile cannot be viewed by anyone.</span> 
        </div>
        
         <div class="intFiledDiv hlfsz">
        <input type="hidden" name="action" value="process">
        <input type="submit" name="update" value="Update">
         </div>
    </div>
    </div>
    </div>
</form>
    </div>
</div>