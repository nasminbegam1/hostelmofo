<div class="main">
<div class="MainCon">
    <div class="registration">
        
     <?php if(validation_errors() || isset($errmsg)){ ?>
            <span class="error_msg">
                    <?php
                     echo validation_errors();
                     echo isset($errmsg)? $errmsg:'';
                    ?>			
            </span>
    <?php }?>
    <?php if(isset($succmsg) && $succmsg != '' ){ ?>
            <div class="alert alert-success display-show" style="font-size:18px;">
                <?php echo $succmsg; ?>
            </div>
    <?php } ?>
    <form id="registrationForm" action="<?php echo FRONTEND_URL.'login/registration/';?>" method="post">
    <input type="hidden" name="action" value="Process">
    <h2>Registration</h2>
   
    <div class="input-field">
        <label>First Name <em class="required">*</em></label>
        <div class="frm_in">
            <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="">
        </div>
    </div>
    <div class="input-field">
        <label>Last Name <em class="required">*</em></label>
        <div class="frm_in">
            <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="">
        </div>
    </div>
    <div class="input-field emailError">
        <label> Email <em class="required">*</em></label>
        <div class="frm_in">
            <input type="text" autocomplete="off" name="email_address" id="email_address" placeholder="Enter Email Address" value="">
        </div>
    </div>
    <div class="input-field">
        <label> Date of Birth <em class="required">*</em></label>
        <div class="frm_in">
            <div class="frm_holder">
        <select name="birthDate" id="birthDate">
            <option value="">Day</option>
            <?php for($i=1;$i<=31;$i++){ ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        </div>
            <div class="frm_holder">
        <select name="birthMonth" id="birthMonth">
            <option value="">Month</option>
            <?php
                for($i=1;$i<=12;$i++){
                $j = (strlen($i)==1)?'0'.$i:$i;
            ?>
            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
            <?php } ?>
        </select> </div>
            <div class="frm_holder">
        <select name="birthYear" id="birthYear">
            <option value="">Year</option>
            <?php
                $currYear = date('Y');
                for($i=$currYear-16;$i>=$currYear-100;$i--){
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
            </div>
        </div>
    </div>
    <div class="input-field">
        <label> Gender <em class="required">*</em></label>
        <div class="frm_in">
            <select name="gender">
                <option value="">Not Set</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>
    <div class="input-field">
        <label> Location <em class="required">*</em></label>
        <div class="frm_in">
            <input type="text" name="location" value="" placeholder="Enter Location">
        </div>
    </div>
    <div class="input-field">
        <label> Nationality <em class="required">*</em></label>
        <div class="frm_in">
        <select name="nationality">
            <option value="">...</option>
            <?php
                if(is_array($arrCountry)){
                foreach($arrCountry as $country){
            ?>
            <option value="<?php echo $country['idCountry']; ?>"><?php echo stripslashes($country['countryName']); ?></option>
            <?php } } ?>
        </select>
        </div>
    </div>
    <div class="input-field">
        <label> Password <em class="required">*</em></label>
        <div class="frm_in">
            <input type="password" name="password" id="password" placeholder="Enter password">
        </div>
    </div>
    <div class="input-field">
        <label> Confirm Password <em class="required">*</em></label>
        <div class="frm_in">
            <input type="password" name="conPassword" id="conPassword" placeholder="Enter Confirm Password">
        </div>
    </div>
    <div class="input-field"><label></label>
        <div class="frm_in"> <input type="submit" name="submit" value="Submit" class="logBtn"></div> </div>
    </form>
</div>
</div>
</div>