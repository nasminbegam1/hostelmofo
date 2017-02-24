<header class="header">
   <div class="banrIn">
      <div class="MainCon">
         <div class="banTop clearfix">
            <div class="bnrTp clearfix alignright">
               <div class="bnrNav alignleft">
                  <ul class="clearfix">
                     <li>
                        <?php
                        if((isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']>0)){?>
                           <a href="#">Sign Out</a>
                           <?php
                        }
                        else{?>
                           <a id="login" class="topLinks loginSec globalInline clickPop" target="1">Sign In</a>
                           <?php
                        }
                        ?>
                     </li>
                     <li><a href="#">Currency</a></li>
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
               <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>in-logo.png" alt="img"></a>
            </div>
         </div>
         <div class="bannerContent">
            <h2>BRISBANE</h2>
            <p>30 Hostels in Brisbane, Queensland, Australia 27 Available</p>
            <div class="breadcrumbs">
               <ul class="clearfix">
                  <li>
                     <a href="#">Home</a>
                  </li>
                  <li>
                     <a href="#">Australia Hostels</a>
                  </li>
                  <li>
                     <a href="#">Queensland Hostels</a>
                  </li>
                  <li>
                     Brisbane Hostels
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <img src="<?php echo FRONT_IMAGE_PATH;?>gal-banner.jpg" alt="no img">
   <div class="ovrly"></div>
</header>
