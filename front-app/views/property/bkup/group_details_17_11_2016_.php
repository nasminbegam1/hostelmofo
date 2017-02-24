<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>group-details.js"></script>
<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>

<div class="detailsPanTop">
  <div class="listingContent globalClr"> <span class="lsitingTitle globalClr"> <?php echo stripslashes($details['master_details']['property_name']); ?> in <?php echo stripslashes($details['master_details']['city_name']); ?>, <?php echo stripslashes($details['master_details']['province_name']); ?>,
    Australia</span> 
    <!--<div class="lsitResult"><strong>37 Results:</strong> Wed 11th Feb 2015 - Sat 14th Feb 2015 </div>-->
    <div class="listingView">
      <ul class="clearfix">
        <li><a data-scroll-nav='1' href="#">Pictures</a></li>
	<li><a data-scroll-nav='2' href="#" class="dealHeading">Deals</a></li>
        <li><a data-scroll-nav='2' href="#" class="descriptionHeading">Description</a></li>
        <!--<li><a data-scroll-nav='3' href="#">Rating</a></li>-->
        <li><a data-scroll-nav='4' href="#">Rates</a></li>
        <li><a data-scroll-nav='5' href="#">Reviews</a></li>
        <li><a data-scroll-nav='6' href="#">Facilities</a></li>
        <li><a data-scroll-nav='7' href="#">Cancellation Policy</a></li>
        <li><a data-scroll-nav='8' href="#">Policies</a></li>
        <li><a href="javascript:void(0);"  data-item="<?php echo $details['master_details']['property_slug'] ?>" class="favouriteIcon detailsFav <?php echo ($this->nsession->userdata('USER_ID')=='')? 'noLogcreate_proper_url();':''; ?>" > <?php echo ($details['fav_status']=='Yes')? 'My Favourite':'Add To Favourite'; ?> </a> </li>
      </ul>
    </div>
  </div>
</div>

<!-- Bottom panel-->

<div class="detailsPanBtm globalClr clearfix">
  <div class="detailsLt ltCls">
    <div class="detailsBlock globalClr backBtn clearfix"> <a class="inputBtnOth ltCls" href="<?php echo FRONTEND_URL.'listing/?type='.$type.'&guest='.$guest.'&city='.$slug.'&checkin='.$check_in.'&checkout='.$check_out.'&group_type='.$group_type.'&age_ranges='.$age_ranges.'&typeid='.$typeid.'&s=true'; ?>">Back to search results</a> <span class="proFavIcon <?php echo ($details['fav_status']=='Yes')? 'active':''; ?>"> </span>
      <div class="shareLink ltCls"> 
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_native_toolbox"></div>
      </div>
    </div>
    <div class="detailsBlock globalClr" data-scroll-index='1'> 
      <!--<img src="images/details-img.jpg" width="725" height="262" alt="details-banner"/>-->
      
      <div id="sync1" class="owl-carousel">
        <?php if(count($details['images'])>0){
		      
                        foreach($details['images'] as $img){
                        ?>
        <div class="item"><img src="<?php echo isFileExist(CDN_PROPERTY_BIG_IMG.$img['image_name']) ; ?>" width="725" height="262" alt="<?php echo ($img['image_alt']!='')? $img['image_alt']:$details['master_details']['property_name']; ?>" title="<?php echo ($img['image_title']!='')? $img['image_title']:''; ?>"/></div>
        <?php }} ?>
      </div>
      <div id="sync2" class="owl-carousel">
        <?php if(count($details['images'])>0){
                        foreach($details['images'] as $img){
                        ?>
        <div class="item"><img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$img['image_name']) ; ?>" width="725" height="262" alt="<?php echo ($img['image_alt']!='')? $img['image_alt']:$details['master_details']['property_name']; ?>" title="<?php echo ($img['image_title']!='')? $img['image_title']:''; ?>" /></div>
        <?php }} ?>
      </div>
    </div>
    <div class="detailsBlock globalClr" data-scroll-index='2'>
      <h5 class="blockTitle globalClr">Description </h5>
      <?php
	    $strLen = strlen(strip_tags($details['master_details']['description']));
	    if($strLen >500){
      ?>
      <p> <?php echo nl2br(stripslashes(substr(strip_tags($details['master_details']['description']),0,500))); ?> <span class="" id="moreDescription" style="display: none;"> <?php echo nl2br(stripslashes(substr($details['master_details']['description'],501,$strLen))); ?> </span> </p>
      <p><a class="inputBtnOth readMoreDetails" href="javascript:void(0);" onclick="getRestDesc();">Read more</a></p>
      <?php }else{ ?>
      <p><?php echo nl2br(stripslashes($details['master_details']['description'])); ?></p>
      <?php } ?>
      <script>
      function getRestDesc(){
	document.getElementById("moreDescription").style.display = 'block';
      }
      </script> 
    </div>
    <div class="globalClr" data-scroll-index='4'>
      <?php if($succmsg != ''){?>
      <div class="succmsg"><?php echo $succmsg;?></div>
      <?php } if($errmsg != ''){?>
      <div class="errmsg"><?php echo $errmsg;?></div>
      <?php }?>
      <form name="frmBookNow" id="frmBookNow" method="post" class="main enqueryFrm" action="<?php echo FRONTEND_URL."grp_property/groupconfirmbooking/";?>">
        <input type="hidden" name="property_id" id="property_id" value="<?php echo $details['master_details']['property_master_id'];?>">
        <input type="hidden" name="pslug" id="pslug" value="<?php echo $property_slug;?>">
	<input type="hidden" name="property_price" id="property_price">
	<div class="detailsBlock globalClr clearfix" id="checklistView">
          <div class="ratesDate globalClr">Rates for: <span class="banner_startdate" id="chkin_dt"><?php echo $checkin_date? $checkin_date: ''; ?></span> - <span class="banner_startdate" id="chkout_dt"><?php echo $checkout_date? $checkout_date: ''; ?></span> </div>
          <div class="detailsSearch">
            <div class="calSec ltCls">
              <div id="arrDptCal" class="cincout-contener-static"></div>
              <label class="labelText">Arriving:</label>
              <input type="text"  name="check_in" value="<?php echo isset($check_in)?$check_in:''; ?>" id="checkInArr" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
              <label for="checkInArr" class="calicon1"><i class="fa fa-calendar"></i></label>
              <label class="labelText rt">Departing:</label>
              <input type="text" value="<?php echo isset($check_out)?$check_out:''; ?>" name="check_out" id="checkOutDpt" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
              <label for="checkOutDpt" class="calicon2"><i class="fa fa-calendar"></i></label>
	      <label class="labelText rt">Group Type:</label>
	      <select name="groupType" id="groupType" class="">
		<option value="">Group type</option>
		<?php foreach($groupType as $grpType){ ?>
		<option value="<?php echo $grpType['id'];?>" <?php if($grpType['slug'] == $group_type){echo 'selected'; }?>><?php echo $grpType['typeName'];?></option>
		<?php } ?>
	      </select>
	      <label class="labelText rt">Age Ranges:</label>
	      <ul class="age-group-main clear">
		<?php foreach($ageGroup as $ageGrp){ ?>
		<li><input type="checkbox" id="age-group-<?php echo $ageGrp['id'];?>" class="ageGroup" name="ageGroup" value="<?php echo $ageGrp['id'];?>" multiple="multiple" <?php if(in_array($ageGrp['id'],explode('-',$age_ranges))){echo 'checked';}?>><label for="age-group-<?php echo $ageGrp['id'];?>"><?php echo $ageGrp['ageGroup'];?></label>
		</li>
		<?php } ?>
	      </ul>
            </div>
            <div class="detailsSearchBtn rtCls">
              <input class="inputBtnOth grpCheckAvailability" type="button" value="Check Availability"  name="Check Availability" />
            </div>
          </div>
        </div>
	<div id="group_error_msg" style="display: none; height: 50px; color: red;"> This location have no rooms </div>
	<div class="detailsBlock globalClr bookTable priceTable">
	  <input type="hidden" id="total_day2" name="total_day" value="4">
	    <table  width="100%" border="0" cellspacing="0" cellpadding="0" class="dateHead">
            <thead>
            <td>Room Types</td>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <thead id="rateTableHead">
                  </thead>
                </table></td>
              <td><span class="guest">Rooms</span></td>
                </thead>
           </table>
	    <table  width="100%" border="0" cellspacing="0" cellpadding="0" class="dateBody">
            <?php
	   
	    if(count($details['price'])>0){
	      foreach($details['price'] as $index=>$data){
	    ?>
            <tr>
              <td align="left" valign="top"><div class="tool"><a href="javascript:void(0)" class="tooltrip_show"><span class="tooltrip"><?php echo stripslashes(ucwords($data['room_description'])); ?></span>
	      <?php echo stripslashes(ucwords($data['type_name'])); ?></a></div><span style="color:blue;" class="avl_size_<?php echo $index;?>"> Sleep <?php echo $data['size'];?></span></td>
              <td align="left" valign="top">
		<table class="rateTable"  width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  </tr>
                </table>
	      </td>
              <td align="left" valign="top">
                <select name="aval_room" class="aval_room" data-pricetype="<?php echo stripslashes($data['room_price_type']); ?>" data-roomname="<?php echo stripslashes($data['type_name']); ?>" data-roomtype="<?php echo stripslashes($data['id']); ?>" data-roomname="<?php echo stripslashes($data['type_name']); ?>" data-price = "<?php echo round(currentPrice1(stripslashes($data['base_price']),$currencySymbol,$currencyRate)); ?>" data-id="<?php echo $data['id'];?>" data-tot="" aud-data-tot="" data-roomsize="<?php echo stripslashes($data['size']); ?>">
		  <option value="">Choose</option>
                </select>
	      </td>
            </tr>
            <?php } } ?>
          </table>

	
	<div class="total_section" style="display: none;">
            <table>
              <tr id="total_heading" class="total_heading">
                <td>Room types chosen</td>
                <td>No. Rooms</td>
                <td>Total Price</td>
              </tr>
              <tr>
                <td colspan="2"><b>Total Price </b></td>
                <td><b> <span class="crcy_smbl"></span><span id="total_price_span">0</span></b></td>
              </tr>
            </table>
          </div>
          <p id="book_now_section" style="display: none;">
            <input type="submit" id="btn-booknow" class="inputBtnOth" name="booknow" value="Book Now">
          </p>
	</div>
        </form>
    </div>
    <?php if(is_array($avg_review)){ ?>
    <div class="detailsBlock globalClr " data-scroll-index='5'>
      <h5 class="blockTitle globalClr">Latest Review</h5>
      <div class="reviewTableSec">
        <p class="percentReview"><?php echo $avg_review['totalFeedback']; ?>% Rating</p>
        <p class="totalReview"><a href="javascript:void(0);">
          <?php //echo count($details['reviews']); ?>
          1 Total Reviews</a></p>
        <div class="reviewTable globalClr clearfix">
          <ul>
            <li><span class="ltCls reviewValue">Value For Money</span><span class="rtCls reviewPer"><?php echo $avg_review['value_for_money'];?>%</span></li>
            <li><span class="ltCls reviewValue">Security</span><span class="rtCls reviewPer"><?php echo $avg_review['security'];?>%</span></li>
            <li><span class="ltCls reviewValue">Location</span><span class="rtCls reviewPer"><?php echo $avg_review['location'];?>%</span></li>
            <li><span class="ltCls reviewValue">Staff</span><span class="rtCls reviewPer"><?php echo $avg_review['staff'];?>%</span></li>
            <li><span class="ltCls reviewValue">Atmosphere</span><span class="rtCls reviewPer"><?php echo $avg_review['atmosphere'];?>%</span></li>
            <li><span class="ltCls reviewValue">Cleanliness</span><span class="rtCls reviewPer"><?php echo $avg_review['cleanliness'];?>%</span></li>
            <li><span class="ltCls reviewValue">Facilities</span><span class="rtCls reviewPer"><?php echo $avg_review['facilities'] ;?>%</span></li>
          </ul>
        </div>
      </div>
      <div class="more">
        <p><?php echo stripslashes($avg_review['comments']); ?></p>
        <p><a href="javascript:void(0);"><?php echo ($avg_review['first_name'] !='')?ucfirst(stripslashes($avg_review['first_name'])).',':''; ?></a> <a href="javascript:void(0);"><?php echo ($avg_review['countryName'] != '')?ucfirst(stripslashes($avg_review['countryName'])).',':''; ?></a> <a href="javascript:void(0);"><?php echo ucfirst(stripslashes($avg_review['gender'])); ?></a></p>
        <p><a class="inputBtnOth" href="<?php  echo FRONTEND_URL."review/".$property_slug;?>">See all reviews</a></p>
      </div>
    </div>
    <?php } ?>
    <div class="detailsBlock globalClr facilitiesSec" data-scroll-index='6'>
      <h5>Facilities</h5>
      <ul class="faciList">
        <?php if(count($details['facilities'])>0){
		      foreach($details['facilities'] as $index=>$data){
		      ?>
        <li><a href="javascript:void(0);"><?php echo stripslashes($data['amenities_name']); ?></a></li>
        <?php } } ?>
      </ul>
    </div>
    <div class="detailsBlock globalClr" data-scroll-index='7'>
      <h5 class="blockTitle globalClr">Cancellation Policy</h5>
      <!--<h6>This property has a 1 day cancellation policy.</h6>-->
      <p><?php echo nl2br(stripslashes($details['master_details']['cancellation_policy'])); ?></p>
    </div>
    <div class="detailsBlock globalClr" data-scroll-index='8'>
      <h5 class="blockTitle globalClr">Things to Note</h5>
      <p><?php echo nl2br(stripslashes($details['master_details']['things_to_note'])); ?></p>
    </div>
    <div class="detailsBlock globalClr" data-scroll-index='8'>
      <h5 class="blockTitle globalClr">Other Info</h5>
      <?php if($details['master_details']['signed_for']) {?>
      <div class="info_sec"> <span class="info_title"> Signed for and on behalf of Licensee : </span> <span class="info_text"><?php echo stripslashes($details['master_details']['signed_for']);?></span> </div>
      <?php }?>
      <?php if($details['master_details']['licensee_name'] != ''){ ?>
      <div class="info_sec"> <span class="info_title"> Name : </span> <span class="info_text"><?php echo stripslashes($details['master_details']['licensee_name']);?></span> </div>
      <?php }?>
      <?php if($details['master_details']['licensee_email'] != ''){?>
      <div class="info_sec"> <span class="info_title"> Email Address : </span> <span class="info_text"><?php echo stripslashes($details['master_details']['licensee_email']);?></span> </div>
      <?php }?>
      <?php if($details['master_details']['licensee_email2'] != ''){?>
      <div class="info_sec"> <span class="info_title"> Licensees Email Address : </span> <span class="info_text"><?php echo stripslashes($details['master_details']['licensee_email2']);?></span> </div>
      <?php }?>
      <?php if($details['master_details']['signed_date'] != '0000-00-00' && $details['master_details']['signed_date'] != '1970-01-01'){?>
      <div class="info_sec"> <span class="info_title"> Signed Date : </span> <span class="info_text">
        <?php if($details['master_details']['signed_date'] != '0000-00-00' ) { echo date('j F Y',strtotime($details['master_details']['signed_date'])); } ?>
        </span> </div>
      <?php }?>
      <?php if($details['master_details']['effective_date'] != '0000-00-00' && $details['master_details']['effective_date'] != '1970-01-01'){?>
      <div class="info_sec"> <span class="info_title"> Effective date : </span> <span class="info_text">
        <?php if($details['master_details']['effective_date'] != '') { echo date('j F Y',strtotime($details['master_details']['effective_date'])); }?>
        </span> </div>
      <?php }?>
    </div>
    <div class="detailsBlock globalClr backBtn">
      <p><a class="inputBtnOth" href="<?php echo FRONTEND_URL.'listing/?type='.$type.'&city='.$slug.'&checkin='.$check_in.'&checkout='.$check_out.'&group_type='.$group_type.'&age_ranges='.$age_ranges.'&typeid='.$typeid.'&s=true'; ?>">Back to search results</a></p>
    </div>
  </div>
  <div class="detailsRt rtCls">
    <div class="rtBlock clearfix globalClr">
      <p class="rtShareLink"><a href="javascript:void(0);" class="clickPop" target="2">Share with a friend</a></p>
    </div>
    <div class="rtBlock clearfix globalClr similarPro">
      <h5 class="globalClr rtBlockTitle">Similar properties</h5>
      <div class="formDiv globalClr gridView">
        <?php if(count($similar_property)>0){  ?>
        <ul>
          <?php $count=0; foreach($similar_property as $item){ if($count>4){break;}else{$count++;} ?>
          <li class="item">
            <div class="imgSec"><a href="<?php echo FRONTEND_URL.'property/'.$details['master_details']['property_type_slug'].'/'.$details['master_details']['province_slug'].'/'.$details['master_details']['city_seo_slug'].'/'.$item['property_slug']; ?>">
              <?php  if(is_array($item['featured_image']) and $item['featured_image']['image_name'] !=''){ ?>
              <img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$item['featured_image']['image_name']); ?>" width="301" height="227"  alt="<?php echo ($item['featured_image']['image_alt']!='')? $item['featured_image']['image_alt']:$details['master_details']['property_name']; ?>" title="<?php echo ($item['featured_image']['image_title']!='')? $item['featured_image']['image_title']:''; ?>" />
              <?php }else{ ?>
              <img src="<?php echo FRONT_IMAGE_PATH.'no_img.jpg'; ?>" width="301" height="227"  alt="list-no-img"/>
              <?php } ?>
              </a>
              <div class="priceSec"> <span class="priceText">Hostel From</span> <span class="priceText"><strong>
                <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo 'AU$'; } ?>
                <?php if(is_array($item['price'])){ echo currentPrice($item['price']['daily_price'],$currencySymbol,$currencyRate);} ?>
                </strong></span> </div>
            </div>
            <div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="javascript:void(0);"><?php echo stripslashes($item['property_name']); ?></a></span>
              <address class="itemAddress">
              <?php echo ($item['address']!='')? stripslashes($item['address']):'';
		    echo ($item['city_name']!='')? ', '.$item['city_name']:''; ?>
              </address>
              <!--<p> <span class="perOff">77%</span> </p>--> 
            </div>
          </li>
          <?php } ?>
        </ul>
        <p><a href="<?php echo FRONTEND_URL.'listing/?type='.$details['master_details']['property_type_slug'].'&city='.$details['master_details']['city_slug'].'&typeid='.$details['master_details']['property_type_id'].'&s=true' ; ?>" class="inputBtnOth blueBtn">View More Property</a></p>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php $featured_image='';if(is_array($details['featured_img']) and array_key_exists('image_name',$details['featured_img'])){ $featured_image =  isFileExist(CDN_PROPERTY_SMALL_IMG.$details['featured_img']['image_name']);} $this->load->view('property/enquiry_popup',array('property_id'=>$details['master_details']['property_master_id'],
							'property_name'		=> $details['master_details']['property_name'],
							'property_img'		=> $featured_image,
							'property_slug'		=> $details['master_details']['property_slug'],
							'property_city'		=> $details['master_details']['province_name'],
							'property_province'	=> $details['master_details']['city_name']
							)); ?>
<?php $this->load->view('property/share_friend_popup',array('property_id'=>$details['master_details']['property_master_id'],'property_name'=>$details['master_details']['property_name'],'property_slug'=>$details['master_details']['property_slug'],'featured_image'=>$details['featured_img'])); ?>
