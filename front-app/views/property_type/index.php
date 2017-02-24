
			<div class="cmsBlock globalClr">
				<h1 class="globalClr"><?php echo stripslashes($property_type_details['property_type_name']);?></h1>
				<p><?php echo stripslashes($property_type_details['property_description']);?></p>
			</div>
			
			<div class="favcity globalClr clearfix">
				<?php //pr($fav_location_arry);
				if(is_array($fav_location_arry) && count($fav_location_arry) > 0)
				{
				?>	
					<ul>
				<?php		
					foreach($fav_location_arry as $v)
					{
						echo "<li><a href='".ORIGINAL_SITE_URL.$v['province_slug']."/".$v['city_seo_slug']."/'>".stripcslashes($v['city_name'])."</a></li>";
					}
				?>	
					</ul>
				<?php	
				}
				?>
			</div>
			
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
			
			<div class="globalClr clearfix">
				<p>&nbsp;</p>
			</div>
			<div class="listingPanel globalClr clearfix">
				<aside class="leftSide ltCls">
					<div class="filterPanel">
						<div class="filterTop globalClr clearfix"> <span class="ltCls text1">Filter Result</span> </div>
						<div class="filterContent globalClr"> <span class="accroTitle"><i class="fa fa-tag ltIcon"></i>Price Range <i class="fa fa-plus rtIcon"></i></span>
							<div class="block priceRange">
								<div class="priceSlider">
									<p>
									<label for="amount">Price range:</label>
									<span id="amount"></span> </p>
									<div id="listpricerange"></div>
									<input id="startprice" type="hidden" name="startprice" value="0" />
									<input id="endprice" type="hidden" name="endprice" value="25000" />
									<input id="sliderstep" type="hidden" name="sliderstep" value="50" />
									<input id="minprice" type="hidden" name="minprice" value="" />
									<input id="maxprice" type="hidden" name="maxprice" value="" />
									<input id="currencySymbol" type="hidden" name="currencySymbol" value="<?php echo $this->nsession->userdata('currencySymbol'); ?>" />
								</div>
								<div id="slider-range"></div>
							</div>
							<span class="accroTitle"><i class="propertyIcon spriteImg ltIcon"></i>Property Type<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
							<?php	 						
							if(is_array($property_list))
							{
								foreach($property_list as $property) 
								{ ?>
								<li>
									<label>
										<input type="checkbox" class="list_ptype" <?php if($property['property_type_slug'] == $ptype_slug) { echo 'checked="checked"'; } else {  } ?> value="<?php echo $property['property_type_id'];?>" name="filterpropType[]" />
										<?php echo stripslashes($property['property_type_name']); ?> </label>
								</li>
								<?php }
							} ?>
								</ul>
								<ul>
								</ul>
							</div>
							<span class="accroTitle"><i class="roomIcon spriteImg ltIcon"></i>Room Type<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
							<ul>
							<?php
							if(is_array($roomtype_list))
							{
							foreach($roomtype_list as $roomtype)
								{ 
								?>
								<li><label><input type="checkbox" class="list_roomtype" value="<?php echo $roomtype['roomtype_id'];?>" name="filterRoomtype[]" /><?php echo stripslashes($roomtype['roomtype_name']);?> </label></li>
								<?php
								}
							}
							?>
							</ul>
							</div>
							<span class="accroTitle"><i class="fa fa-map-marker ltIcon"></i>Location<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
								<?php
								if(is_array($citylist))
								{
									foreach($citylist as $city)
									{						
								?>
									<li><label><input type="checkbox" class="list_citytype" data-province="<?php echo stripslashes($city['province_id']);?>" value="<?php echo $city['city_slug'];?>" <?php if( ( $city['city_slug']==$city_slug) || ( $city['province_id'] == $province_id ) ) { echo 'checked="checked"'; } ?>  name="filterLocation[]" /><?php echo stripslashes($city['city_name']);?> </label></li>
									<?php
									}
								}
								?>
								</ul>
							</div>
							<span class="accroTitle"><i class="fa fa-wifi ltIcon"></i>Facilities<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
									<?php
									if(is_array($facility_list))
									{
										foreach($facility_list as $facility)
										{						
									?>
											<li>
												<label>
													<input type="checkbox" class="list_facility" value="<?php echo $facility['amenities_id'];?>" name="filterAmmenities[]" />
													<?php echo stripslashes($facility['amenities_name']); ?> </label>
											</li>
											<?php
										}
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</aside>
				<div class="rightSide rtCls">
					<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
					<div class="listingContent globalClr"> <span class="lsitingTitle globalClr">Hostels in <?php echo $temploc; ?> Australia</span>
						<div class="lsitResult"><strong><span id="totalCount"><?php echo ($totalCount >0 ? $totalCount : 0 );?></span> Results</strong> </div>
						<div class="listingView">
							<ul class="clearfix">
								<li class="active"><a href="#">View grid</a></li>
								 <li><a href="<?php echo FRONTEND_URL;?>maplist/?type=<?php echo $property_type_details['property_type_slug']; ?>&city=&checkin=&checkout=&typeid=<?php echo $property_type_details['property_type_id']; ?>&s=true">Map View</a></li>
							</ul>
						</div>
						<div class="listingSort globalClr clearfix">
							<div class="ltCls sortSelect">
								<label class="labelName">Sort By: </label>
								<label class="stylishSelect">
									<select name="sortby" id="sortby">
										<option selected="selected" value="name-az">Name (A-Z)</option>
										<option value="name-za">Name (Z-A)</option>
										<option value="price-asc">Low to High</option>
										<option value="price-desc">High to low</option>
									</select>
								</label>
							</div>
							<div class="ltCls pageSelect">
								<label class="labelName">per page:</label>
								<label class="stylishSelect">
									<select name="perpage" id="perpage">
										<option value="all">All</option>
									</select>
								</label>
							</div>
						</div>
						<input type="hidden" name="page" id="page" value="1">
						<!--<div class="listingItems globalClr clearfix gridView" id="filterpropertydata"> </div>-->
					</div>
					
					<div class="listingItems globalClr clearfix gridView" id="filterpropertydata">
						<p align="center"><img src="<?php echo FRONTEND_URL.'images/bx_loader.gif' ?>" /></p>
					</div>
					<div class="pagiWrapper"></div>
					
				</div>
			</div>
<!--			<div class="rtCls locaright">
				<ul>
					<li><i class="fa fa-globe"></i>Adventure</li>
					<li><i class="fa fa-heart"></i>Romance</li>
					<li><i class="fa fa-users"></i>Family</li>
					<li><i class="fa fa-dashboard"></i>LGBT</li>
					<li><i class="fa fa-briefcase"></i>Business</li>
				</ul>
			</div>
-->		