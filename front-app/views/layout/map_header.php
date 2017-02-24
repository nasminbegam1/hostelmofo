  <header class="header globalClr">
    <div class="mainWrap clearfix">
    <span class="logo ltCls"><a href="<?php echo FRONTEND_URL;?>"><img src="<?php echo FRONT_IMAGE_PATH;?>logo.png" alt="logo"/></a></span> 
    <div class="headerRt rtCls">
      <div class="headerTop globalClr">
      	
        <div class="topLinks currencySec globalInline allCurrency">
	    <span class="carencyTitle"><em id="currentCurrency"><?php echo  ($this->nsession->userdata('currencyCode') != '')?  $this->nsession->userdata('currencyCode'):'CHOOSE YOUR currency'; ?></em><i class="fa fa-caret-down"></i></span>
	    <div class="currencyDropBox currencyBox">
            <div class="currencyDropBoxIn">
	    <form id="switchCountry" action="<?php echo FRONTEND_URL;?>home/change_country/" method="post" name="switchCountry">
	     <input type="hidden" value="" id="countries" name="countries">
	    <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
	    <div class="currencyDropBoxInside">

	     </div>
	      </form>
            </div>
          </div>

	</div>
        <?php
		if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']>0)
		{
		?>
		<div id="login" class="topLinks globalInline" target="1">
			<a href="javascript:void(0);"><i class="fa fa-user"></i>Hi, <?php echo $_SESSION['USER_FIRSTNAME'];?></a>
			<ul>
			      <li><a href="<?php echo FRONTEND_URL."home/favourite";?>">My Favourite</a></li>
			      <li><a href="<?php echo FRONTEND_URL."home/logout";?>" id="logout">LOGOUT</a></li>
			</ul>
			
		</div>
		<?php
		} else {
		?>
		<div id="login" class="topLinks loginSec globalInline clickPop" target="1">
			<a href="javascript:void(0);"><i class="fa fa-user"></i>LOGIN</a>
		</div>
		<?php }?>
      </div>
      <div class="headerBottom globalClr clearfix"> 
        <nav class="navigationSec rtCls ">
          <ul class="nav-collapse">
            <li class=""><a href="<?php echo FRONTEND_URL;?>">HOME</a></li>
	      <?php
	    foreach($header_tab as $ht)
	    {
		  $url = FRONTEND_URL.$ht['property_type_slug'].'/';
		  $class = '';
		  if($ht['property_type_slug'] == $header_selected)
		  {
			$class	= 'active';
		  }
	    ?>
		  <li class="<?php echo $class;?>"><a href="<?php echo $url;?>"><?php echo $ht['property_type_name'];?></a></li>
	    <?php
	    }
	    ?>
            <!--<li><a href="#">Hostels</a></li>
            <li><a href="#">Hotels</a></li>
            <li><a href="#">Groups</a></li>
            <li><a href="#">Guides and Info</a></li>-->
            <li><a href="<?php echo FRONTEND_URL.'blog/'?>">Blog</a></li>
          </ul>
        </nav>
      </div>
      </div>
    </div>
          <div class="allPopupBox targetDiv signin" id="popid1">
  <div class="popUpOverlay"></div>
  <div class="allPopupBoxIn">
    <div class="socialSignin globalClr"> <i class="fa fa-close closeIcon"></i>
      <h3>Login to Accommodation</h3>
      <p><a href="<?php echo FRONTEND_URL;?>auth_oa2/session/facebook/" class="faceBook"><i class="fa fa-facebook"></i>Connect with Facebook</a></p>
      <p><a href="<?php echo FRONTEND_URL;?>auth_oa2/session/google/" class="gPlus"><i class="fa fa-google-plus"></i>Connect with Google</a></p>
    </div>
  </div>
</div>

  </header>
  
