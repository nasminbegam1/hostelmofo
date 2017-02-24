
<!--<p>
<img src="<?php echo FRONT_IMAGE_PATH.'pageNotFound.jpg' ?>" style="display: block; margin: 0px auto;" id="404_img"/>
</p>-->
<style>
    
.pageNotPanTop {
    clear: both;
    color: #777;
    display: block;
    font-family: "Open Sans",sans-serif;
    text-align: center;
    
}
.pageNotPanTop h1 {
    color: #e82a62;
    font-size: 130px;
    font-weight: 700;
    line-height: 150px;
    margin: 0px !important;
}
</style>
<div class="pageNotWrap animated bounceInLeft">
  <div class="pageNotPan">
    <div class="pageNotPanTop" id="404_img">
        <h1>404!</h1>
        <h4>The page you are looking for has not been found!</h4>
        <p>The page you are looking for might have been removed or unavailable.</p>
        <p><a href="<?php echo FRONTEND_URL; ?>">Return home</a> or try the search bar below.</p>
    </div>
    <!-- Search Panel -->
    <div class="topSearchPan">

<div class="searchContainer globalClr cmsSearch">
				<div class="searchPan globalClr active mainSearchPanel">
					<div class="searchPanIn globalClr clearfix">
						<div class="searchBox1 searchBox1Two ltCls">
							<input type="text" value="" name="" placeholder="Enter city name" id="destination" class="citySearchBox" />
							<input type="hidden" value="" name="city_slug" class="city_slug" id="city_slug" />
							<input type="hidden" value="" name="property_type" id="property_type" />
						</div>
						<div class="calSec ltCls">
							<div id="homeCal1" class="cincout-contener-static"></div>
							<input type="text" value="<?php echo DEFAULT_CHECK_IN_DATE;?>" name="" id="checkIn" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
							<label for="checkIn" class="calicon1"><i class="fa fa-calendar"></i></label>
							<input type="text" value="<?php echo DEFAULT_CHECK_OUT_DATE;?>" name="" id="checkOut" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
							<label for="checkOut" class="calicon2"><i class="fa fa-calendar"></i></label>
						</div>
                                             
						<div class="searchBox1 searchBox1Two ltCls">
							<select name="type" id="type">
							<option value="">Select Property Type</option>
							<?php							
							if( is_array($property_list) )
							{
								foreach($property_list as $property) 
								{ ?>
							<option value="<?php echo $property['property_type_id'];?>"><?php echo stripslashes($property['property_type_name']); ?></option> 
								<?php }
							} ?>
							</select>
							<input type="hidden" name="typeid" id="typeid" value="" />
						</div>
						<div class="searchBtn rtCls">
							<input type="button" value="Search" id="search_btn" name="Search" />
						</div>
					</div>
					<div class="searchlistingDrop">
						<div class="searchlistingDropIn">
							<div class="searchlistingBottom clearfix commonClass"> </div>
						</div>
					</div> 
				</div>
			</div>
			
			<form name="search_property" id="search_property" method="GET" action="<?php echo FRONTEND_URL;?>listing/">
				<input type="hidden" name="type" id="type" value="">
				<input type="hidden" name="city" id="city" value="">
				<input type="hidden" name="checkin" id="checkin" value="<?php echo DEFAULT_FORM_CHECK_IN_DATE;?>">
				<input type="hidden" name="checkout" id="checkout" value="<?php echo DEFAULT_FORM_CHECK_OUT_DATE;?>">
				<input type="hidden" name="typeid" id="typeid" value="">
				<input type="hidden" value="true" name="s"/>
			</form>	

    <!-- Search Panel -->
</div>
</div>