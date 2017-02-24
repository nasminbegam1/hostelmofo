<?php
//pr($this->nsession->all_userdata());
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5437b3f34e6bc93b" async="async"></script>-->

<!-- TOP panel -->
            <div class="detailsPanTop">
	      <div class="approveBox"  data-slug="<?php echo $details['master_details']['property_slug']; ?>">
		<div class="popupLoader approveLoader"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
		
		<a href="#" target="4" class="inputBtnOth propertyStatusBtn clickPop approveBtn"  data-status="approve">Approve</a>
		<a href="#" target="4" class="inputBtnOth propertyStatusBtn clickPop declineBtn" data-status="decline">Decline</a>
		<span class="approveMsg"></span>
	      </div>
              <div class="listingContent globalClr"> <span class="lsitingTitle globalClr">
                <?php echo stripslashes($details['master_details']['property_name']); ?> in 
                <?php echo stripslashes($details['master_details']['city_name']); ?>,
                <?php echo stripslashes($details['master_details']['province_name']); ?>,
                Australia</span>
                <!--<div class="lsitResult"><strong>37 Results:</strong> Wed 11th Feb 2015 - Sat 14th Feb 2015 </div>-->
                <div class="listingView">
                  <ul class="clearfix">
                    <li><a data-scroll-nav='1' href="#">Pictures</a></li>
                    <li><a data-scroll-nav='2' href="#">Description</a></li>
                    <!--<li><a data-scroll-nav='3' href="#">Rating</a></li>-->
                    <li><a data-scroll-nav='4' href="#">Rates</a></li>
                    <li><a data-scroll-nav='5' href="#">Reviews</a></li>
                    <li><a data-scroll-nav='6' href="#">Facilities</a></li>
                    <li><a data-scroll-nav='7' href="#">Cancellation Policy</a></li>
                    <li><a data-scroll-nav='8' href="#">Policies</a></li>
                  </ul>
                </div>
              </div>
            </div>



<!-- Bottom panel-->

            <div class="detailsPanBtm globalClr clearfix">
              <div class="detailsLt ltCls">
                <div class="detailsBlock globalClr backBtn clearfix"> <a class="inputBtnOth ltCls" href="<?php echo FRONTEND_URL.'listing/'; ?>">Back to search results</a>
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
		  if($strLen >500){ ?>
                  <p>
		    <?php echo nl2br(stripslashes(substr(strip_tags($details['master_details']['description']),0,500))); ?>
		    <span class="" id="moreDescription" style="display: none;">
		      <?php echo nl2br(stripslashes(substr($details['master_details']['description'],501,$strLen))); ?>
		    </span>
		  </p>
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
<!--                <div class="detailsBlock globalClr" data-scroll-index='3'>
                  <h5 class="blockTitle globalClr">Rates</h5>
                  <span class="reviewCount globalClr">296 Total Reviews</span>
                  <div class="reviewCountTable globalClr">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top">Value For Money </td>
                        <td align="right" valign="top">83%</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">Security</td>
                        <td align="right" valign="top">83%</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">Location</td>
                        <td align="right" valign="top">83%</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">Staff </td>
                        <td align="right" valign="top">83%</td>
                      </tr>
                    </table>
                  </div>
                  <p><a class="inputBtnOth" href="#">See all reviews</a></p>
                </div>
-->
<div class="globalClr" data-scroll-index='4'>
<div class="detailsBlock globalClr clearfix" >
                  <div class="ratesDate globalClr">Rates for: 11th Feb 2015 - 14th Feb 2015</div>
                  <div class="detailsSearch">
                    <div class="calSec ltCls">
                    	<div id="arrDptCal" class="cincout-contener-static"></div>
                      <label class="labelText">Arriving:</label>
                      <input type="text" value="" name="" id="checkInArr" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
                      <label for="checkInArr" class="calicon1"><i class="fa fa-calendar"></i></label>
                      <label class="labelText rt">Departing:</label>
                      <input type="text" value="" name="" id="checkOutDpt" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
                      <label for="checkOutDpt" class="calicon2"><i class="fa fa-calendar"></i></label>
                    </div>
                    <div class="detailsSearchBtn rtCls">
                      <input class="inputBtnOth detailsAvailabelBtn" type="submit" value="Check Availability"  name="Check Availability" />
                    </div>
                  </div>
                </div>
                <div class="detailsBlock globalClr bookTable">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive">
                    <thead>
                      <tr>
                        <th width="350" align="left" valign="top" scope="col">Room Type</th>
                        <th align="left" valign="top" scope="col">Rent Price</th>
                        <!--<th align="left" valign="top" scope="col">Deposit Price</th>-->

                        <!--<th width="144" align="left" valign="top" scope="col">Guests</th>-->
                      </tr>
                    </thead>
		    <?php if(count($details['price'])>0){
		      foreach($details['price'] as $index=>$data){ ?>
		      <tr> 
                      <td align="left" valign="top"><?php echo stripslashes($data['roomtype_name']); ?></td>
                      <td align="left" valign="top">
		      <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo 'AU$'; } ?>
		      <?php echo currentPrice(stripslashes($data['daily_price']),$currencySymbol,$currencyRate); ?></td>
                      <!--<td align="left" valign="top">
		      <?php //if($currencySymbol!=''){echo $currencySymbol; }else{ echo 'AU$'; } ?>
		      <?php //echo currentPrice(stripslashes($data['commission_price']),$currencySymbol,$currencyRate); ?></td>-->
                      <!--<td align="left" valign="top">
                        <select>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </td>-->
                    </tr>  
		<?php	
		      }
		      } ?>
                    
                   
                  </table>
                  <p>
		    <a class="inputBtnOth clickPop bookNowEnq" target="3" href="#">Book NOW</a>
		  </p>
                </div>
  </div>              
		<div class="detailsBlock globalClr " data-scroll-index='5'>
                  <h5 class="blockTitle globalClr">Latest Review</h5>
		                    <div class="reviewTableSec">
                    <p class="percentReview"><?php echo ($details['master_details']['avarage_rating'] == 0)?'100':$details['master_details']['avarage_rating']; ?>% Rating</p>
                    <p class="totalReview"><a href="#"><?php echo count($details['reviews']); ?> Total Reviews</a></p>
                    <div class="reviewTable globalClr clearfix">
		      
                    	<ul>
                        	<li><span class="ltCls reviewValue">Value For Money</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c1']):'100';?>%</span></li>
                            <li><span class="ltCls reviewValue">Security</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))?round($avg_review['c4']):'100';?>%</span></li>
                            <li><span class="ltCls reviewValue">Location</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c6']):'100';?>%</span></li>
                            <li><span class="ltCls reviewValue">Staff</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c2']):'100' ;?>%</span></li>
                            <li><span class="ltCls reviewValue">Atmosphere</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c5']):'100';?>%</span></li>
                            <li><span class="ltCls reviewValue">Cleanliness</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c7']):'100';?>%</span></li>
                            <li><span class="ltCls reviewValue">Facilities</span><span class="rtCls reviewPer"><?php echo (is_array($avg_review))? round($avg_review['c3']):'100' ;?>%</span></li>
                        </ul>
                    </div>
                    
                  </div>

		  <div class="more">
		  <?php if(count($details['reviews'])>0){ ?>
                  
                   <?php  $last_key = end(array_keys($details['reviews']));
		     $last_reviews= $details['reviews'][$last_key];
		     //pr($last_reviews,0);
		   ?>
		    <p><?php echo stripslashes($last_reviews['review_text']); ?></p>
                    <p><a href="#"><?php echo ucfirst(stripslashes($last_reviews['name'])); ?></a>, <a href="#"><?php echo ucfirst(stripslashes($last_reviews['city'])); ?></a>, <a href="#"><?php echo ucfirst(stripslashes($last_reviews['country'])); ?></a>, <a href="#"><?php echo ucfirst(stripslashes($last_reviews['gender'])); ?></a>, <a href="#"><?php echo stripslashes($last_reviews['age_group']); ?></a></p>
		    
		    <p><a class="inputBtnOth" href="<?php  echo FRONTEND_URL."review/".$property_slug;?>">See all reviews</a></p>
                   
		   
                   <?php } ?>
		   
		    
                  </div>
                </div>
                <div class="detailsBlock globalClr facilitiesSec" data-scroll-index='6'>
                  <h5>Facilities</h5>
                  <ul class="faciList">
		    <?php if(count($details['facilities'])>0){
		      foreach($details['facilities'] as $index=>$data){
		      ?>
                    <li><a href="#"><?php echo stripslashes($data['amenities_name']); ?></a></li>
                    
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
                <div class="detailsBlock globalClr backBtn">
                  <p><a class="inputBtnOth" href="<?php echo FRONTEND_URL.'listing/'; ?>">Back to search results</a></p>
                </div>
              </div>
              <div class="detailsRt rtCls">
                <div class="rtBlock clearfix globalClr">
		  		    

                  <p class="rtShareLink"><a href="#" class="clickPop" target="2">Share with a friend</a></p>
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
			  <img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$item['featured_image']['image_name']); ?>" width="301" height="227"  alt="<?php echo ($item['featured_image']['image_alt']!='')? $item['featured_image']['image_alt']:$details['master_details']['property_name']; ?>" title="<?php echo ($item['featured_image']['image_title']!='')? $item['featured_image']['image_title']:''; ?>"/>
			<?php }else{ ?>
			<img src="<?php echo FRONT_IMAGE_PATH.'no_img.jpg'; ?>" width="301" height="227"  alt="list-no-img"/>
			<?php } ?>
			</a>
                          <div class="priceSec"> <span class="priceText">Hostel From</span> <span class="priceText">
			  <strong>
			  <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo 'AU$'; } ?>
			  <?php if(is_array($item['price'])){ echo currentPrice($item['price']['daily_price'],$currencySymbol,$currencyRate); }   ?></strong></span> </div>
                          <!--<span class="perOff">77%</span> -->
			</div>
                        <div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="#"><?php echo stripslashes($item['property_name']); ?></a></span>
                          <address class="itemAddress">
                          <?php echo ($item['address']!='')? stripslashes($item['address']):'';
				echo ($item['city_name']!='')? ', '.$item['city_name']:''; ?>
                          </address>
                          <!--<p> <span class="perOff">77%</span> </p>-->
                        </div>
                      </li>
		      <?php } ?>
		      </ul>
		       <p><a href="<?php echo FRONTEND_URL.'listing/?type='.$details['master_details']['property_type_slug'].'&city='.$details['master_details']['city_slug'].'&typeid='.$details['master_details']['property_type_id'] ; ?>" class="inputBtnOth blueBtn">View More Property</a></p>
		      <?php } ?>
                    
                    
                  </div>
                </div>
              </div>
            </div>

<?php $featured_image='';if(is_array($details['featured_img']) and array_key_exists('image_name',$details['featured_img'])){ $featured_image =  isFileExist(CDN_PROPERTY_SMALL_IMG.$details['featured_img']['image_name']);} $this->load->view('property/enquiry_popup',array('property_id'=>$details['master_details']['property_master_id'],
							'property_name'=>$details['master_details']['property_name'],
							'property_img'=>$featured_image,
							'property_slug'=>$details['master_details']['property_slug'],
							'property_city'=>$details['master_details']['province_name'],
							'property_province'=>$details['master_details']['city_name']
							)); ?>
<?php $this->load->view('property/share_friend_popup',array('property_id'=>$details['master_details']['property_master_id'],'property_name'=>$details['master_details']['property_name'],'property_slug'=>$details['master_details']['property_slug'],'featured_image'=>$details['featured_img'])); ?>
<?php

$this->load->view('property/approve_disapprove_popup',array('property_id'=>$details['master_details']['property_master_id'],'property_name'=>$details['master_details']['property_name'],'property_slug'=>$details['master_details']['property_slug'],'featured_image'=>$details['featured_img']));

?>
