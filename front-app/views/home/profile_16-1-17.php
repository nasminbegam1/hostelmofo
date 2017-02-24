
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
        <input type="text" name="phone" value="<?php echo $user_details[0]['mobile_no']; ?>" placeholder="Enter your phone no here">
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