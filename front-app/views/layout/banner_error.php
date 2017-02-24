<style>
      .ui-autocomplete{
            background: #FFF;
      }
      .ui-helper-hidden-accessible{
            display: none;
      }
</style>
<div class="bannerSec globalClr">
      <div class="bannerImg"><img src="<?php echo FRONT_IMAGE_PATH;?>banner.jpg" width="1680" height="773"  alt="banner"/></div>
            <div class="searchPanel searchPanelInner">
        <div class="mainWrap clearfix">
            <span class="searchTitle globalClr">Find the <em>perfect</em> place to <em>sleep</em></span>
          <div class="searchPanelIn globalClr">
            <ul class="searchTabUl globalClr">
                  <?php
                  foreach($banner_tab as $bt)
                  {
                        $class = '';
                        if($type == $bt['property_type_slug'])
                        {
                              $class = 'active';
                        }
                  ?>    
                        <li class="<?php echo $class;?>" id="<?php echo $bt['property_type_slug'];?>" value="<?php echo $bt['property_type_id'];?>"><?php echo $bt['property_type_name'];?></li>
                  <?php } ?>
            </ul>
            <div class="searchContainer globalClr" id="tabContent">
              <div class="searchPan globalClr active mainSearchPanel">
                <div class="searchPanIn globalClr clearfix">
                  <div class="searchBox1 ltCls">
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
</form>