<?php //pr($propertDtls['rating']); ?>
<div class="UpPan">
  <div class="lt">
    <h4><?php echo stripslashes($propertDtls['property_name']);?></h4>
    <a class="whtBtn" href="javascript:void(0);">New Bookings <span class="round"><?php echo $propertDtls['totalBooking']; ?></span></a>
    <div class="ulList">
      <ul>
        <li><a href="<?php echo AGENT_URL.'property/';?>"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="<?php echo AGENT_URL.'booking_list/bookings/'.$property_id;?>" <?php echo ($select_tab =='bookings')?'class="active"':''?>><i class="fa fa-users"></i>Booking</a></li>
        <li><a href="<?php echo AGENT_URL.'property/availability/'.$property_id.'/'.date('Y');?>" <?php echo ($select_tab =='availability')?'class="active"':''?>><i class="fa fa-check-square-o"></i>Availability</a></li>
        <li><a href="<?php echo AGENT_URL.'room_details/index/'.$property_id;?>" <?php echo ($select_tab =='romeandrates')?'class="active"':''?>><i class="fa fa-bed"></i>Rooms and Rates</a></li>
        <li><a href="<?php echo AGENT_URL.'property/edit/'.$property_id;?>" <?php echo ($select_tab =='change_setting')?'class="active"':''?>><i class="fa fa-wrench"></i>Property Setup</a></li>
        <li><a href="<?php echo AGENT_URL.'reports/sales/'.$property_id;?>" <?php echo ($select_tab =='reportList')?'class="active"':''?>><i class="fa fa-file-text-o"></i>Reports</a></li>
        <li><a href="<?php echo AGENT_URL.'market/index/'.$property_id;?>"<?php echo ($select_tab =='market')?'class="active"':''?>><i class="fa fa-building"></i>Marketing</a></li>
      </ul>
    </div>
  </div>
  <div class="rt">
    <div class="whtBx">
      <?php
      $total = ROUND((($propertDtls['rating']['security']+$propertDtls['rating']['location']+$propertDtls['rating']['staff']+$propertDtls['rating']['atmosphere']+$propertDtls['rating']['cleanliness']+$propertDtls['rating']['value_for_money']+$propertDtls['rating']['facilities'])/700)*100);
      ?>
      <h4> <?php echo $total; ?>% <strong>HW Rating</strong></h4>
      <div class="bar">
        <ul>
          <li title="Security">
            <h5>Se</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['security']; ?>%" class="loadingYllw" ></div>
            </div>
            <h6><?php echo $propertDtls['rating']['security']; ?>%</h6>
          </li>
          <li title="Location">
            <h5>L</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['location']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['location']; ?>%</h6>
          </li>
          <li title="Staff">
            <h5>St</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['staff']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['staff']; ?>%</h6>
          </li>
          <li title="Atmosphere">
            <h5>A</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['atmosphere']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['atmosphere']; ?>%</h6>
          </li>
          <li title="Cleanliness">
            <h5>Cl</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['cleanliness']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['cleanliness']; ?>%</h6>
          </li>
          <li title="value for money">
            <h5>VM</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['value_for_money']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['value_for_money']; ?>%</h6>
          </li>
          <li title="Facilities">
            <h5>Fc</h5>
            <div class="whtBar">
              <div style="width:<?php echo $propertDtls['rating']['facilities']; ?>%" class="loadingYllw"></div>
            </div>
            <h6><?php echo $propertDtls['rating']['facilities']; ?>%</h6>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
