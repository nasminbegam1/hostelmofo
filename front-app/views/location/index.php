<div class="locationDetails globalClr clearfix">
	<div class="locationTopSec globalClr">
		<div class="locationContent globalClr clearfix">
			<div class="ltCls locaLeft">
				<h1 class="globalClr">Sydney</h1>
				<p>Home to Phuket’s second largest beach and famous for its powdery white sand that makes a squeak when you walk on it. Up-market Karon has plenty of shopping conveniences and restaurants to suit tourists. With downtown  Kata only a few kilometres for any shoppers looking to walk with the locals and find some unique items for sale. Karon is a great place to find restaurants, bars, and a traditional thai massage and has some other great locations such as Patong and Kata to explore which are just a few minutes’ drive away. Tuk tuk's are always around, or alternatively rent a motorbike for a day or two and explore the island, go and visit the Big Buddha up on the hill and stop at some amazing viewpoints of the Andaman sea and mountain views along the way.</p>
			</div>
			
			
			<div class="searchContainer globalClr">
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
					<select name=""><option>Select your option</option></select>
				  </div>
                  <div class="searchBtn rtCls">
                    <input type="button" value="Search" id="search_btn" name="Search" />
                  </div>
                </div>
                <div class="searchlistingDrop">
                  <div class="searchlistingDropIn">
                    <div class="searchlistingBottom clearfix commonClass">
                       
                     
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
			
			<div class="globalClr clearfix"><p>&nbsp;</p></div>
			
			<div class="listingPanel globalClr clearfix">
				<aside class="leftSide ltCls">
					<div class="filterPanel">
						<div class="filterTop globalClr clearfix"> <span class="ltCls text1">Filter Result</span>  </div>
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
								</div>
								<div id="slider-range"></div>
							</div>
							<span class="accroTitle"><i class="propertyIcon spriteImg ltIcon"></i>Property Type<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
									<?php
				//pr($property_list,0);//pr($type_selected);
				if(is_array($property_list))
				{
					foreach($property_list as $property)
					//var_dump(in_array($property['property_type_slug'],$type_selected[0]['ptype'])); exit;
					{ ?>
									<li>
										<label>
											<input type="checkbox" class="list_ptype" <?php if( in_array($property['property_type_slug'],$type_selected[0]['ptype']) ) { echo 'checked="checked"'; } else {  } ?> value="<?php echo $property['property_type_id'];?>" name="filterpropType[]" />
											<?php echo stripslashes($property['property_type_name']); ?> </label>
									</li>
									<?php }
				}
				?>
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
									<li>
										<label>
											<input type="checkbox" class="list_roomtype" value="<?php echo $roomtype['roomtype_id'];?>" name="filterRoomtype[]" />
											<?php echo stripslashes($roomtype['roomtype_name']);?> </label>
									</li>
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
									<li>
										<label>
											<input type="checkbox" class="list_citytype" data-province="<?php echo stripslashes($city['province_id']);?>" value="<?php echo $city['city_slug'];?>" <?php if( in_array($city['city_slug'],$type_selected[0]['city']) || ( $city['province_id'] === $type_selected[0]['province'] ) ) { echo 'checked="checked"'; } ?>  name="filterLocation[]" />
											<?php echo stripslashes($city['city_name']);?> </label>
									</li>
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
					<div class="listingContent globalClr"> <span class="lsitingTitle globalClr">Hostels in Sydney, New South Wales, Australia</span>
						<div class="lsitResult"><strong><span id="totalCount">3 Results: Wed 11th Mar 2015 - Sun 15th Mar 2015</span></strong> </div>
						<div class="listingView">
							<ul class="clearfix">
								<li><a href="#">View grid</a></li>
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
						<input type="hidden" name="page" id="page" value="0">
						<div class="listingItems globalClr clearfix gridView" id="filterpropertydata"> </div>
					</div>
					
					<div class="listingItems globalClr clearfix gridView">
		<ul class="clearfix">
			<li class="item">
				<div class="imgSec"> <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>liting-img1.jpg" width="301" height="227"  alt="list-img"/></a>
					<div class="priceSec"> <span class="priceText">Dorms From</span> <span class="priceText"><strong>AU$30</strong></span> </div>
					<span class="perOff">77%</span> </div>
				<div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="#">Base Sydney </a></span>
					<address class="itemAddress">
					243-247 Cleveland Street, Surry Hills, Sydney
					</address>
					<p class="itemDescription">The hostel is spread over three Victorian terrace houses. Two fully equipped kitchens. <a href="">More Info <em>»</em></a></p>
					<p> <span class="perOff">77%</span> </p>
				</div>
			</li>
			<li class="item">
				<div class="imgSec"> <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>liting-img1.jpg" width="301" height="227"  alt="list-img"/></a>
					<div class="priceSec"> <span class="priceText">Dorms From</span> <span class="priceText"><strong>AU$30</strong></span> </div>
					<span class="perOff">77%</span> </div>
				<div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="#">Base Sydney </a></span>
					<address class="itemAddress">
					243-247 Cleveland Street, Surry Hills, Sydney
					</address>
					<p class="itemDescription">The hostel is spread over three Victorian terrace houses. Two fully equipped kitchens. <a href="">More Info <em>»</em></a></p>
					<p> <span class="perOff">77%</span> </p>
				</div>
			</li>
			<li class="item">
				<div class="imgSec"> <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>liting-img1.jpg" width="301" height="227"  alt="list-img"/></a>
					<div class="priceSec"> <span class="priceText">Dorms From</span> <span class="priceText"><strong>AU$30</strong></span> </div>
					<span class="perOff">77%</span> </div>
				<div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="#">Base Sydney </a></span>
					<address class="itemAddress">
					243-247 Cleveland Street, Surry Hills, Sydney
					</address>
					<p class="itemDescription">The hostel is spread over three Victorian terrace houses. Two fully equipped kitchens. <a href="">More Info <em>»</em></a></p>
					<p> <span class="perOff">77%</span> </p>
				</div>
			</li>
			<li class="item">
				<div class="imgSec"> <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>liting-img1.jpg" width="301" height="227"  alt="list-img"/></a>
					<div class="priceSec"> <span class="priceText">Dorms From</span> <span class="priceText"><strong>AU$30</strong></span> </div>
					<span class="perOff">77%</span> </div>
				<div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="#">Base Sydney </a></span>
					<address class="itemAddress">
					243-247 Cleveland Street, Surry Hills, Sydney
					</address>
					<p class="itemDescription">The hostel is spread over three Victorian terrace houses. Two fully equipped kitchens. <a href="">More Info <em>»</em></a></p>
					<p> <span class="perOff">77%</span> </p>
				</div>
			</li>
		</ul>
	</div>
					
				</div>
			</div>
			<div class="rtCls locaright">
				<ul>
					<li><i class="fa fa-globe"></i>Adventure</li>
					<li><i class="fa fa-heart"></i>Romance</li>
					<li><i class="fa fa-users"></i>Family</li>
					<li><i class="fa fa-dashboard"></i>LGBT</li>
					<li><i class="fa fa-briefcase"></i>Business</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
