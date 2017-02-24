<?php /*
		 
		 <div class="bannerSec globalClr">
      <div class="bannerImg innerBanner"><img src="<?php echo FRONT_IMAGE_PATH ?>inner-banner.jpg" width="1680" height="368"  alt="banner"/></div>
      <div class="searchPanel searchPanelInner">
        <div class="mainWrap clearfix"> 
            <div class="searchPanelIn globalClr">
                  <ul class="searchTabUl globalClr">
                        <?php
                        foreach($banner_tab as $index=>$bt)
                        {
                              $class = '';
                              if($type == $bt['property_type_slug'])
                              {
                                    $class = 'active';
                              }
                              if($type=='' and $index==0){
                                    $class = 'active';
                              }
                        ?>    
                        <li class="<?php echo $class;?>" data-item="<?php echo $bt['property_type_id'];?>" id="<?php echo $bt['property_type_slug'];?>"><?php echo $bt['property_type_name'];?></li>
                        <?php
                        }
                        ?>
                  </ul>
            <div class="searchContainer globalClr" id="tabContent">
              <div class="searchPan globalClr active mainSearchPanel">
                
                <div class="searchPanIn globalClr clearfix">
                  <div class="searchBox1 ltCls">
                    <input type="text" value="<?php echo $location;?>" name="" placeholder="Enter city or hostel name" id="destination" class="citySearchBox" />
                    <input type="hidden" value="<?php echo $slug;?>" name="city_slug" class="city_slug" id="city_slug" />
                    <input type="hidden" value="<?php echo $property;?>" name="property_slug" class="property_slug" id="property_slug" />
                    <input type="hidden" value="<?php echo $type;?>" name="property_type" id="property_type" />
						  
                  </div>
                  <div class="guestBox ltCls">
			<select name="guest_drop" id="guest_drop">
                              <option value="">Select Guest</option>
			      
			      <?php for($i=1;$i<=$max_guest;$i++){?>
				    <option <?php if($i == $guest)echo 'selected';?>><?php echo $i;?></option>
			      <?php }?>
			</select>
		  </div>
                  <div class="calSec ltCls">
                    <div id="homeCal1" class="cincout-contener-static"></div>
                    <input type="text" value="<?php echo $check_in;?>" name="" id="checkIn" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
                    <label for="checkIn" class="calicon1"><i class="fa fa-calendar"></i></label>
                    <input type="text" value="<?php echo $check_out;?>" name="" id="checkOut" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
                    <label for="checkOut" class="calicon2"><i class="fa fa-calendar"></i></label>
                  </div>
                  <div class="searchBtn rtCls">
                    <input type="button" value="Search" id="search_btn" name="Search" />
                  </div>
                </div>
                <div id="add_html"></div>
                <div class="searchlistingDrop">
                  <div class="searchlistingDropIn">
                    <div class="searchlistingBottom clearfix commonClass">
                       
                     
                    </div>
                  </div>
                </div>
					 
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>

<form name="search_property" id="search_property" method="GET" action="<?php echo FRONTEND_URL;?>listing/">
      <input type="hidden" name="guest" id="guest" value="<?php echo $guest;?>">
      <input type="hidden" name="property" id="property" value="<?php echo $property;?>">
      <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
      <input type="hidden" name="city" id="city" value="<?php echo $slug;?>">
      <input type="hidden" name="checkin" id="checkin" value="<?php echo DEFAULT_FORM_CHECK_IN_DATE;?>" />
      <input type="hidden" name="checkout" id="checkout" value="<?php echo DEFAULT_FORM_CHECK_OUT_DATE;?>" />
      <input type="hidden" name="group_type" id="group_type" value="<?php echo $group_type; ?>">
      <input type="hidden" name="age_ranges" id="age_ranges" value="<?php echo $age_ranges; ?>">
      <input type="hidden" name="typeid" id="typeid" value="<?php echo $typeid;?>">
      <input type="hidden" value="true" name="s"/>
      
</form>
*/?>

<?php //pr($_SESSION) ;?>
<header class="header">
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
					<li><a href="<?php echo FRONTEND_URL."home/logout";?>" id="logout">Logout</a></li>
			</ul>
			
		</div>
							 
							 <?php } ?>
		
		
		
			<ul class="clearfix">
				 <?php if(!isset($_SESSION['USER_ID'])){?>
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
						<div class="banLogo alignleft">
							 <a href="<?php echo FRONTEND_URL; ?>"><img src="<?php echo FRONT_IMAGE_PATH;?>in-logo.png" alt="img"></a>
						</div>
				 </div>
				 <div class="bannerContent">
						<?php
						if(isset($property) && $property != ''){?>
							 <h2><?php echo $property; ?></h2>
							 <div class="breadcrumbs">
									<ul class="clearfix">
										 <li>
												<a href="#">Home</a>
										 </li>
										 <li>
												<a href="<?php echo $breadcrumb[0]['link']; ?>"><?php echo $breadcrumb[0]['text']; ?>  Hostels</a>
										 </li>
										 <li>
												<a href="<?php echo $breadcrumb[1]['link']; ?>"><?php echo $breadcrumb[1]['text']; ?> Hostels</a>
										 </li>
										 <li>
												<?php echo $breadcrumb[2]['text']; ?> Hostels
										 </li>
										 <li>
												<?php echo $property; ?>
										 </li>
									</ul>
							 </div>
							 <?php
						}
						
						else{?>
							 <h2><?php echo $breadcrumb[2]['text']; ?></h2>
							 <p><span id="totalCount">30</span> Hostels in <?php echo $breadcrumb[2]['text']; ?>, <?php echo $breadcrumb[1]['text']; ?>, <?php echo $breadcrumb[0]['text']; ?> <!--27 Available--></p>
							 <div class="breadcrumbs">
									<ul class="clearfix">
										 <li>
												<a href="#">Home</a>
										 </li>
										 <li>
												<a href="<?php echo $breadcrumb[0]['link']; ?>"><?php echo $breadcrumb[0]['text']; ?>  Hostels</a>
										 </li>
										 <li>
												<a href="<?php echo $breadcrumb[1]['link']; ?>"><?php echo $breadcrumb[1]['text']; ?> Hostels</a>
										 </li>
										 <li>
												<?php echo $breadcrumb[2]['text']; ?> Hostels
										 </li>
									</ul>
							 </div>
							 <?php
						}
						?>
						
						
				 </div>
			</div>
	 </div>
         <img src="<?php echo FRONT_IMAGE_PATH;?>gal-banner.jpg" alt="no img">
         <div class="ovrly"></div>
      </header>
      <div class="main ">
      <div class="MainCon">
      <div class="formSrch clearfix">
         <div class="formBox">
            <label>Location</label>
            <input value="<?php echo $location;?>" name="Name" placeholder="Enter city or hostel name" type="text" id="destination" class="citySearchBox">
				<input type="hidden" value="<?php echo $slug;?>" name="city_slug" class="city_slug" id="city_slug" />
            <input type="hidden" value="<?php echo $property;?>" name="property_slug" class="property_slug" id="property_slug" />
            <input type="hidden" value="<?php echo $type;?>" name="property_type" id="property_type" />
         </div>
         <div class="formBox inputTwo">
            <label class="in">Check In</label>
            <input value="<?php echo $check_in;?>" name="checkin" id="checkIn" placeholder="Enter checkin date" type="text" readonly=true>
            <label class="out">Check Out</label>
            <input value="<?php echo $check_out;?>" name="checkout" id="checkOut" placeholder="Enter checkout date" type="text" readonly=true>
         </div>
         <div class="formBox">
            <label>Guests</label>
            <select id="guest_drop" name="guest_drop">
					 <?php for($i=1; $i<=80; $i++){?>
					 <option value="<?php echo $i;?>" <?php if($i == $guest)echo 'selected';?>><?php echo $i.'  '.($i==1 ? "Guest" : "Guests" );?></option>
					 <?php } ?>
            </select>
         </div>
			
         <div class="formBox">
            <input name="send" value="Search Now" type="submit" id="search_btn">
         </div>
			
			<div id="step3"> </div>
      </div>
		
		
		<form name="search_property" id="search_property" method="GET" action="<?php echo FRONTEND_URL;?>listing/">
		  <input type="hidden" name="guest" id="guest" value="<?php echo $guest;?>">
		  <input type="hidden" class="property" name="property" id="property" value="<?php echo $property;?>">
		  <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
		  <input type="hidden" name="city" id="city" value="<?php echo $slug;?>">
		  <input type="hidden" name="checkin" id="checkin" value="<?php echo DEFAULT_FORM_CHECK_IN_DATE;?>" />
		  <input type="hidden" name="checkout" id="checkout" value="<?php echo DEFAULT_FORM_CHECK_OUT_DATE;?>" />
		  <input type="hidden" name="group_type" id="group_type" value="<?php echo $group_type; ?>">
		  <input type="hidden" name="age_ranges" id="age_ranges" value="<?php echo $age_ranges; ?>">
		  <input type="hidden" name="typeid" id="typeid" value="<?php echo $typeid;?>">
		  <input type="hidden" value="true" name="s"/>
      
		</form>
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