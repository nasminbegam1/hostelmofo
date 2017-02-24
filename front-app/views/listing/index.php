
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5oEneZdCu6tI4-HE_5ZL2XZwMUuQmOgg"></script>
<div class="proSlide">
	 <!--<h3>FEATURED PROPERTIES</h3>-->
	
</div>


<div class="proDisplay">
	 <div class="proBtns clearfix">
			<div class="btnLt alignleft">
				
				<a href="javascript:void(0)" class="blBtn filterbutton">Filter</a>
				<a href="javascript:void(0)" class="blBtn">Sort</a>
				
				 <select name="perpage" id="perpage">
						<option  value="1">1</option>
						<option value="4">4</option>
						<option value="10" selected="selected" >10</option>
						<option  value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="all">All</option>
				 </select>
				 <select name="sortby" id="sortby">
						<option selected="selected" value="name-az">Name (A-Z)</option>
						<option value="name-za">Name (Z-A)</option>
						<option value="price-asc">Price: Low to High</option>
						<option value="price-desc">Price: High to low</option>
				 </select>
			</div>
			<div class="btnRt alignright">
				 <em>Display :</em> 
				 <a class="blBtn listclass active" href="#">List</a>
				 <a class="blBtn gridclass" href="#">Grid</a>
				 <a class="blBtn" href="<?php echo FRONTEND_URL;?>maplist/<?php echo $map_url;?>">Map</a>
			</div>
	 </div>
	 	 <div class="filterTab" id="filterTab" style="display: none;">
		<div class="filterColumn" id="horizontalTab">
			<ul class="resp-tabs-list">
			<li><a class="priceTag">Price</a></li>
			<li><a class="priceTag">Property Type</a></li>
			<li><a class="priceTag">Room Type</a></li>
			<li><a class="priceTag">Facilities</a></li>
			</ul>
			<div class="resp-tabs-container">
				<div class="block priceRange">
								<div class="priceSlider">
									<p>
									<label for="amount">Price range:</label>
									<span id="amount"></span> </p>
									<div id="listpricerange"></div>
									<input id="startprice" name="startprice" value="0" type="hidden">
									<input id="endprice" name="endprice" value="25000" type="hidden">
									<input id="sliderstep" name="sliderstep" value="50" type="hidden">
									<input id="minprice" name="minprice" value="" type="hidden">
									<input id="maxprice" name="maxprice" value="" type="hidden">
									<input id="currencySymbol" name="currencySymbol" value="" type="hidden">
								</div>
								<div id="slider-range"></div>
							</div>
				<div id="box_filter_proptype" class="filter-section">
					<div id="filter_proptype">
						<ul>
							<?php foreach($property_type_list as $prop_type){?>
							<li><input type="checkbox" class="list_ptype" name="filterpropType[]" value="<?php echo $prop_type['property_type_id'];?>"><label for="roomType<?php echo $prop_type['property_type_slug'];?>"><?php echo stripcslashes($prop_type['property_type_name']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<div id="box_filter_roomtype" class="filter-section">
					<div id="filter_roomtype">
						<ul>
							<?php foreach($roomtype_list as $room_type){?>
							<li><input type="checkbox" class="list_roomtype" name="filterRoomtype[]" value="<?php echo $room_type['roomtype_id'];?>"><label for="roomType<?php echo $room_type['roomtype_slug'];?>"><?php echo stripcslashes($room_type['roomtype_name']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				
				<div id="box_filter_facilities" class="filter-section">
					<div id="filter_facilities">
						<ul class="facilities_list">
							<?php foreach($facility_list as $fac){?>
							<li><input type="checkbox" class="list_facility" name="filterAmmenities[]" value="<?php echo $fac['amenities_id'];?>"><label for="facility<?php echo $fac['amenities_id'];?>"><?php echo stripcslashes($fac['amenities_name']);?></label></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
	 </div>
	 </div>

</div>




<div class="listingContent globalClr">
	 <?php
	 /*if($cityname != '' && $province != ''){ ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo $cityname.', '.$province.', Australia'; ?></span>
			<?php
	 }
	 else if($cityname == '' && $province != '') { ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo $province.', Australia'; ?></span>
			<?php
	 }
	 else if($cityname == '' && $province == '') { ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo 'Australia'; ?></span>
			<?php
	 }*/
	 ?>
<!--	 <div class="lsitResult">
			<strong>
				 <span id="totalCount"><?php echo ($totalCount>0?$totalCount:0);?></span>
				 Results:
			</strong>
			<?php echo ($checkin_date!=''?$checkin_date.' - ':'');  echo ($checkout_date!=''?$checkout_date:'');?>
	 </div>
-->
<!--	 <div class="listingView">
			<ul class="clearfix">
				 <li class="active"><a href="#">View grid</a></li>
				 <li><a href="<?php echo FRONTEND_URL;?>maplist/<?php echo $map_url;?>">Map View</a></li>
				 <li><span>Hostel Reviews</span></li>
			</ul>
	 </div>
-->
	 <div class="listingSort globalClr clearfix">
<!--			<div class="ltCls sortSelect">
				 <label class="labelName">Sort By: </label>
				 <label class="stylishSelect">
						<select name="sortby" id="sortby">
							 <option selected="selected" value="name-az">Name (A-Z)</option>
							 <option value="name-za">Name (Z-A)</option>
							 <option value="price-asc">Price: Low to High</option>
							 <option value="price-desc">Price: High to low</option>
						</select>
				 </label>
			</div>
--><!--			<div class="ltCls pageSelect">
				 <label class="labelName">per page:</label>
				 <label class="stylishSelect">
						<select name="perpage" id="perpage">
							 
							 <option value="4">4</option>
							 <option value="10">10</option>
							 <option selected="selected" value="20">20</option>
							 <option value="50">50</option>
							 <option value="100">100</option>
							 <option value="all">All</option>
						</select>
				 </label>
			</div>
-->	 </div>
	 <input id="page" type="hidden" value="1" name="page">
	 <!--<<div class="listingItems globalClr clearfix gridView" id="filterpropertydata"></div>-->
	 <!--<div class="searchRes"></div>-->
	 <div class="proList" id="filterpropertydata"></div>
	 <div class="pagiWrapper"></div>
</div>
<div id="listcontent"></div>
	




			</ul>
	 </div>
				 
				 
				 
	 <!-- end main content-->
	 <div class="appPanel">
			<div class="MainCon clearfix">
				 <div class="appPh alignright">
						<img src="<?php echo FRONT_IMAGE_PATH;?>ph-app.png" alt="img">
				 </div>
				 <div class="appTxt alignleft">
						<h3> Check out the <strong>HostelMofo</strong> app </h3>
						<span>Book from anywhere and win awesome weekly prizes</span> 
						<div class="appBtn">
							 <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>app-str.png" alt="img"></a>
							 <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>ggl-ply.png" alt="img"></a>
						</div>
				 </div>
			</div>
	 </div>
	 
	 <input type="hidden" id="prop_id" value="">
		<input type="hidden" id="compare_count" value="">
	 
	 
	  
	