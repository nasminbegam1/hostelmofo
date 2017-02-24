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