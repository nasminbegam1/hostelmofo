<header class="header">
	 
	 
	 <div class="allPopupBox targetDiv signin" id="popid1" style="display: none;">
                  <div class="popUpOverlay"></div>
                  <div class="allPopupBoxIn">
                     <h3>Login to Accommodation</h3>
                     <form name="login_form_submit" id="login_form_submit" method="post">
                        <span id="login_fail_msg" class="error_msg"></span>
                        <div>
                           <input type="text" name="user_email_id" id="user_email_id" placeholder="Enter Email Address">
                           <span id="error_user_email_id" class="error_msg"></span>
                        </div>
                        <div>
                           <input type="password" name="user_password" id="user_password" placeholder="Enter Password">
                           <span id="error_user_password" class="error_msg"></span>
                        </div>
                        <div>
                           <input type="submit" name="submit" value="Login" class="logBtn"><a href="<?php echo FRONTEND_URL.'login/forgotpassword';?>">Forgot password</a>
                           &nbsp;&nbsp;||&nbsp;&nbsp;<a href="<?php echo FRONTEND_URL.'login/registration';?>">Signup</a>
                        </div>
                     </form>
                     <div class="socialSignin globalClr">
                        <i class="fa fa-close closeIcon"></i>
                        <a href="<?php echo FRONTEND_URL;?>auth_oa2/session/facebook/" class="faceBook loginBtn"><i class="fa fa-facebook"></i>Connect with Facebook</a>
                        <a href="<?php echo FRONTEND_URL;?>auth_oa2/session/google/" class="gPlus loginBtn"><i class="fa fa-google-plus"></i>Connect with Google</a>
                     </div>
                  </div>
               </div>

	 
	 
	 
	 <div class="banrIn">
			<div class="MainCon">
				 <div class="banTop clearfix">
						<div class="bnrTp clearfix alignright">
							 <div class="bnrNav alignleft clearfix">
									<?php
						if((isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']>0)){?>
							<div id="login" class="topLinks globalInline" target="1">
			<a href="javascript:void(0);"><i class="fa fa-user"></i>Hi, <?php echo $_SESSION['USER_FIRSTNAME'];?></a>
			<ul>
				  <li><a href="<?php echo FRONTEND_URL."home/profile";?>">My Profile</a></li>
				  <li><a href="<?php echo FRONTEND_URL."home/change_password";?>">Change Passsword</a></li>
			      <li><a href="<?php echo FRONTEND_URL."home/favourite";?>">My Favourite</a></li>
					<li><a href="<?php echo FRONTEND_URL."wallet";?>">My Wallet</a></li>
			      <li><a href="<?php echo FRONTEND_URL."booking_details";?>">Booking Details</a></li>
				  <li><a href="<?php echo FRONTEND_URL."review_details";?>">Review Details</a></li>
					<li><a href="<?php echo FRONTEND_URL."home/logout";?>" id="logout">Logout</a></li>
			</ul>
			
		</div>
							 
							 <?php } ?>
		
		
		
			<ul class="clearfix">
				 <?php if( (!isset($_SESSION['USER_ID'])) ){?>
				 <li>
				 <li>
							 <a id="login" class="topLinks loginSec globalInline clickPop" target="1">Sign In</a>
							 
				 </li>
				 <?php } ?>
										 <li>
												<div class="topLinks currencySec globalInline allCurrency">
													 <span class="carencyTitle">
															<em id="currentCurrency">
																 <?php echo  ($this->nsession->userdata('currencyCode') != '')?  $this->nsession->userdata('currencyCode'):'CHOOSE YOUR currency'; ?>
															</em>
															<i class="fa fa-caret-down"></i>
													 </span>
													 <div class="currencyDropBox currencyBox">
															<div class="currencyDropBoxIn">
																 <form id="switchCountry" action="<?php echo FRONTEND_URL;?>home/change_country/" method="post" name="switchCountry">
																		<input type="hidden" value="" id="countries" name="countries">
																		<input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
																		<div class="currencyDropBoxInside"></div>
																 </form>
															</div>
													 </div>
												</div>
										 </li>
									</ul>
							 </div>
							 

							 
							 
							 <div class="menuBar alignright" >
									<button class="js-toggle-right-slidebar"><img src="<?php echo FRONT_IMAGE_PATH;?>menu-icon.png" alt="menu-icon"></button>
							 </div>
						</div>
						<div class="banLogo alignleft">
							 <a href="<?php echo FRONTEND_URL; ?>"><img src="<?php echo FRONT_IMAGE_PATH;?>in-logo.png" alt="img"></a>
						</div>
				 </div>
				 <div class="bannerContent">
				             <h2><?php echo $title; ?></h2>

						
						
				 </div>
			</div>
	 </div>
         <img src="<?php echo FRONT_IMAGE_PATH;?>gal-banner.jpg" alt="no img">
         <div class="ovrly"></div>
      </header>
      <!--<div class="main ">
      <div class="MainCon">
		-->
		

<script>
	 $(document).ready(function(){
		var base_url = '<?php echo FRONTEND_URL; ?>';
		
		$('.carencyTitle').click(function(){ 
			$(this).next('.currencyBox').slideToggle();
			//$('.currencyBox').show();
	 });
		$.ajax({
		type: "POST",
		dataType: "JSON",
		url: base_url + "listing/get_currency_dropdown/",
		data: {},
		success:function(data) { 
		    $('.currencyDropBoxInside').html(data[0]);
		    $('#currentCurrency').html(data[1]);		    
		}
   });
	 });
</script>