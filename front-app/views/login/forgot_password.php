<div class="main">
<div class="MainCon">
	<div class="content">
	<form class="login-forgot-form" action="" method="post">
		<h3 class="form-title">Forgot Password ?</h3>
		<p>
		Enter your e-mail address below to get your password.
		</p>
		<?php if(validation_errors() || isset($error_msg)){ ?>
			<span class="error_msg">
				<?php
				 echo validation_errors();
				 echo isset($error_msg)? $error_msg:'';
				?>			
			</span>
		<?php }?>
		<?php if(isset($succmsg) && $succmsg != '' ){ ?>
			<div class="alert alert-success display-show">
			    <?php echo $succmsg; ?>
			</div>
		<?php } ?>
		<div class="form-group">
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-actions">
			<input type="hidden" name="action" value="Forgot-form">
			<input type="submit" name="" value="Submit" class="logBtn"></button>
		</div>
	</form>
</div>
</div>
</div>