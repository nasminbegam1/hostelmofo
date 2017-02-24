<aside class="leftSide ltCls">
		<div class="filterPanel">
			<div class="filterTop globalClr clearfix">
			<span class="ltCls text1">Filter Result</span>
			<span class="rtCls resetBtn"><a href="javascript:location.reload(true)"><i class="fa fa-refresh"></i>Reset</a></span>
		    </div>
		    <div class="filterContent globalClr">
			<span class="accroTitle"><i class="fa fa-tag ltIcon"></i>Price Range <i class="fa fa-plus rtIcon"></i></span>
				<div class="block priceRange">
				<div class="priceSlider">
				<p>
				  <label for="amount">Price range:</label>
				  <!--<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">-->
				<span id="amount"></span>
				</p>
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
			<span class="accroTitle"><i class="fa fa-users ltIcon"></i>Guest <i class="fa fa-plus rtIcon"></i></span>
				<div class="block priceRange">
				<ul>		
				<?php for($i=1;$i<=$max_guest;$i++){?>	 
				<li><input <?php if(isset($type_selected[0]['guest'][0]) && $i == $type_selected[0]['guest'][0])echo 'checked';?> type="radio" name="filterguest" class="list_guest" value="<?php echo $i;?>"/><?php echo $i;?>+</li>
				<?php }
				?>		
				</ul>
			</div>	
				
		        
			<span class="accroTitle"><i class="propertyIcon spriteImg ltIcon"></i>Property Type<i class="fa fa-plus rtIcon"></i></span>
				<div class="block propertyType">						
				<ul>		
				<?php
				//pr($property_list,0);
				//pr($type_selected);
				if(is_array($property_list))
				{
					foreach($property_list as $property) 
					{ ?>	 
				<li><label><input type="checkbox" class="list_ptype" <?php if( in_array($property['property_type_slug'],$type_selected[0]['ptype']) ) { echo 'checked="checked"'; } else {  } ?> value="<?php echo $property['property_type_id'];?>" name="filterpropType[]" /><?php echo stripslashes($property['property_type_name']); ?> </label></li>
				<?php }
				}
				?>		
				</ul>		
				<ul>
			       
				<!--<li><label><input type="checkbox" value="" name="" />Hostels <span>(34)</span></label></li>-->
			       
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
				<li><label><input type="checkbox" class="list_ptype" value="<?php echo $roomtype['roomtype_id'];?>" name="filterRoomtype[]" /><?php echo stripslashes($roomtype['roomtype_name']);?> </label></li>
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
				<li><label><input type="checkbox" class="list_citytype" data-province="<?php echo stripslashes($city['province_id']);?>" value="<?php echo $city['city_slug'];?>" <?php if( in_array($city['city_slug'],$type_selected[0]['city']) || ( $city['province_id'] === $type_selected[0]['province'] ) ) { echo 'checked="checked"'; } ?>  name="filterLocation[]" /><?php echo stripslashes($city['city_name']);?> </label></li>
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
				<li><label><input type="checkbox" class="list_facility" value="<?php echo $facility['amenities_id'];?>" name="filterAmmenities[]" /><?php echo stripslashes($facility['amenities_name']); ?> </label></li>
				<?php
					}
				}
				?>		
				</ul>
			</div> 
			<!--<span class="accroTitle"><i class="fa fa-credit-card ltIcon"></i>Payment Type<i class="fa fa-plus rtIcon"></i></span>
				<div class="block propertyType">
				Coming soon...
			</div>-->
		    </div>
		</div>
</aside>