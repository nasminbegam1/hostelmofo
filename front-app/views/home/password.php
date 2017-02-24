
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
<div class="main">
    <div class="MainCon">
<form action="" method="post" name="frm" id="profilepassFrm">
    <div class="listingContent globalClr">
        <div class="targetDiv Cststylng">
            <h3>Change Password</h3>
            
    <div class="formFiled globalClr clearfix">
        <?php if(isset($errmsg) && !empty($errmsg)) { echo "<p class='error'>".$errmsg."</p>";} ?>
        <?php if(isset($sucmsg) && !empty($sucmsg)){ echo "<p class='success'>".$sucmsg."</p>";} ?>
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
        
        
         <div class="intFiledDiv hlfsz">
        <input type="hidden" name="action" value="process">
        <input type="submit" name="update" value="Change password">
         </div>
    </div>
    </div>
    </div>
</form>
   </div>
</div>