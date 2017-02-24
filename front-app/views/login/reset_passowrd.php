<div class="heading">Reset Password</div>
<div class="content clearfix">
<form name="form" id="resetPasswordForm" action="<?php echo FRONTEND_URL.'change-password/'.$url_slug; ?>" method="post" novalidate >
<input type="hidden" name="action" value="Process">
<?php
echo validation_errors();
    echo ($succMsg != '')?'<div class="success">'.$succMsg.'</div>':'';
    echo ($errMsg != '')?'<div class="error_msg">'.$errMsg.'</div>':'';
?>
<input type="hidden" name="uniqueVal" value="<?php echo $url_slug; ?>">
<div class="input-field">
    <input name="password" id="passwordRs" type="password" required placeholder="Please enter password">
    <span id="error_passwordRs" class="error_msg"></span>
</div>
<div class="input-field">
    <input name="confirm_password" id="conPasswordRs" type="password" required placeholder="Please enter password again">
    <span id="error_conPasswordRs" class="error_msg"></span>
</div>
<div class="input-field">
<input type="button" name="reset_password" id="resetPassword" class="started" value="Reset Password" />
</div>
</form>
</div>