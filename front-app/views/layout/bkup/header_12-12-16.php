<style>
/*   .ui-autocomplete{background: #FFF;}
   .ui-helper-hidden-accessible{display: none;}*/
</style>
<div class="bnrTp">
	 <div class="bnrNav alignleft">
		
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
					<li><a href="<?php echo FRONTEND_URL."home/logout";?>" id="logout">Logout</a></li>
			</ul>
			
		</div>
							 
							 <?php } ?>
		
		
			<ul class="clearfix">
				<?php if( (!isset($_SESSION['USER_ID'])) ){?>
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
	 
	 <div class="allPopupBox targetDiv signin" id="popid1" style="visibility: hidden;">
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
	 
	 <div class="menuBar alignright" >
			<button class="js-toggle-right-slidebar"><img src="<?php echo FRONT_IMAGE_PATH;?>menu-icon.png" alt="menu-icon"></button>
	 </div>
</div>


<script>
//	 $(document).ready(function(){ 
//				// if($('.ui-autocomplete').length > 0){
//			$( ".citySearchBox" ).autocomplete({
//				 source: base_url+"home/getCityList",
//				 minLength: 1,
//				 select: function( event, ui ) {
//						//$(this).parents('.mainSearchPanel').find('.searchlistingBottom').append('<p>'+ui.item.label+'</p>');
//						$(this).val(ui.item.value); 
//						$(this).parent().find('input.city_slug').val(ui.item.city_slug);
//						$(this).parent().find('input.property').val(ui.item.property_slug);
//						$(this).parent().find('input.property_slug').val(ui.item.property_slug);
//						//$(this).parents('.mainSearchPanel').find('.searchlistingBottom').html( ui.item.desc );
//						$('#destination').removeClass('errBorderLi');
//						return false;
//				 }
//			})
//	 
//			.data("ui-autocomplete")._renderItem = function (ul, item) {
//				 return $("<li>")
//				 .data("item.autocomplete", item)
//				 .append("<a>" + item.label + "</a>")
//				 .appendTo(ul);
//			};
//	 //}
//		
//		
//	 $('.searchBox1 input').click(function(){
//			//$('.searchPan .searchlistingDrop').slideToggle();
//	 });
//	 if ($('#destination').length > 0){
//			$("#destination").autocomplete({
//				 appendTo: $(".searchBox1")
//			});
//	 }
//
//	 $('.carencyTitle').click(function(){ 
//			$(this).next('.currencyBox').slideToggle();
//			//$('.currencyBox').show();
//	 });
//		
//		// new script //    
//    $("#checkInn").datepicker({
//        minDate: 0,
//        dateFormat: 'dd/mm/yy',
//        onClose: function(selectedDate) {
//            //$("#checkoutid").datepicker("option", "minDate", selectedDate);
//            var minDate = $('#checkInn').datepicker('getDate');
//            minDate.setDate(minDate.getDate() + 1);
//            $("#checkOutt").datepicker('setDate', minDate);
//            $("#checkOutt").datepicker('option', 'minDate', minDate);
//            $("#checkOutt").datepicker('show');
//        }
//    });
//    
//    //$("#checkIn").focus(function(){alert('okkkkkkkk');});
//    
//    $("#checkOutt").datepicker({
//        minDate: '+1D',
//        dateFormat: 'dd/mm/yy',
//        onClose: function () {
//                var dt1 = $('#checkInn').datepicker('getDate');
//                var dt2 = $('#checkOutt').datepicker('getDate');
//                if (dt2 <= dt1) {
//                    var minDate = $('#checkOutt').datepicker('option', 'minDate');
//                    $('#checkOutt').datepicker('setDate', minDate);
//                }
//        }
//    });
//		
//			
//	 });
	 

</script>