<?php
$currencySymbol     = $this->nsession->userdata('currencySymbol');
$currencyRate       = $this->nsession->userdata('currencyRate');
$siteCurrency			= $this->nsession->userdata('currencyCode');
//pr($propertylist);
?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
<div class="main">
    <div class="MainCon">
		  
		  
		  <div class="proSlide">
                  <h3>FAVOURITE PROPERTIES</h3>
                  <h4>SEE WHERE OTHER MOFOS ARE TRAVELLING AROUND AUSTRALIA</h4>
        </div>
		  
		  <div class="proGrid">
				<?php if(count($propertylist) > 0){  ?>
                  <ul class="clearfix" id="favouritelist">
						  <?php foreach($propertylist as $property){
								

//echo max(array_map('count', $property['facilities']));


						  
			$url = FRONTEND_URL.'property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'].'/';?>
                     <li class="item">
								<a class="favouriteRemove removeFav inputBtnOth" href="javascript:void(0);" id="fav-<?php echo $property['favid']; ?>">Remove Favourites</a>
								
					 <?php $image = '';
				    if(is_array($property['featured_image']) and count($property['featured_image'])>0){
						  $image = CDN_PROPERTY_SMALL_IMG.stripslashes($property['featured_image']['image_name']);
				    } ?> 
                        <div class="imgDiv">
                           <img alt="<?php echo stripslashes($property['property_name']); ?>" src="<?php echo isFileExist($image);?>">
									
                        </div>
								
                        <div class="gridTxt">
                           <div class="gridTxtUp">
                              <span class="hstlNm">
                              HOSTEL
                              </span>
                              <div class="HvnTxtIn clearfix">
                              <div class="hstlDtl alignleft">
                              <h5><a href="<?php echo $url; ?>"> <?php echo stripslashes($property['property_name']); ?> </a></h5>
                              <h6><?php echo stripslashes($property['address'].' '.$property['address2'].', '.$property['city_name'].', '.$property['province_name']); ?></h6>
                              </div>
                              <div class="blueRate alignright">
                                 <?php echo $property['rating']; ?>
                              </div>
                              </div>
                              
                              <div class="ratng clearfix">
                              <div class="frmValue alignleft">
                                 From: <?php if($property['price'] != '' && $property['price']['daily_price'] > 0){
								echo "<span>".$currencySymbol." ".currentPrice($property['price']['daily_price'],'',$currencyRate)."</span>";
						  }
						  else{ echo 'N/A'; }?>
                              </div>
										<?php //pr($property['facilities']);?>
                              <!--<div class="kyFtr alignright">
										  <?php if( isset($property['facilities']) && count($property['facilities']) >0){
												echo implode(', ', array_map(function ($entry) {
																				return $entry['amenities_name'];
																		  },
																		  $property['facilities']));
																		  
																		  
													}?>
                                 
                              </div>-->
										
										<?php
										  $i=0; $amenities = '';
										  if( isset($property['facilities']) && count($property['facilities']) > 0)
										  {
												for($i=0;$i<2;$i++)
												{
													 if(isset($property['facilities'][$i]['amenities_name']))
													 {
														  $amenities = $amenities.$property['facilities'][$i]['amenities_name'].', ';
													 }
												}
												
												$amenities = substr($amenities, 0, -2);
										  }
										  else
										  {
												$amenities = 'N/A';
										  }
										  
										  ?>
										
										<div class="kyFtr alignright"><?php echo $amenities;?></div>
                           </div>
                              
                           </div>
                           <div class="gridTxtBtm">
                              
                              <div class="chrtTabl">
                                 <div class="full_width">
                                    <span>Dorms From</span>
                                    <span><?php echo $siteCurrency!="" ?$siteCurrency:"AUD" ;?> <?php echo sprintf("%.2f",currentPrice1(stripslashes($property['min_dorm']['base_price'])));?></span>
                                 </div>
                                 <div class="full_width">
                                    <span>Privates From</span>
                                    <span><?php echo $siteCurrency!="" ?$siteCurrency:"AUD" ;?> <?php echo sprintf("%.2f",currentPrice1(stripslashes($property['min_private']['base_price'])));?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <?php } ?>
                  </ul>
						<?php } else{ ?>
    <div align="center" class="lsitingTitle">Your favourite bucket is empty</div>
    <?php } ?>
               </div>
	<?php /*	  
<div class="listingItems globalClr clearfix gridView" id="dfilterpropertydata">
	 
	 <?php //pr($propertylist); ?>
    <?php if(count($propertylist) > 0){  ?>
                  <ul class="clearfix" id="favouritelist">
                  <?php foreach($propertylist as $property){ //pr($property);
			$url = FRONTEND_URL.'property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'].'/';
			//http://192.168.2.5/hostelworld/property/hostel/new-south-wales/sydney/central-station-hotel/
		    ?>
                    <li class="item">
				
		      <div class="imgSec">
				<a href="<?php echo $url; ?>">
				<?php
				    $image = '';
				    if(is_array($property['featured_image']) and count($property['featured_image'])>0){
					$image = CDN_PROPERTY_SMALL_IMG.stripslashes($property['featured_image']['image_name']);
				    }
				?> 
				<img src="<?php echo isFileExist($image);?>" width="301" height="227"  alt="<?php echo stripslashes($property['property_name']); ?>"/> 
				</a>
                        <div class="priceSec">
				<span class="priceText">Hostels From</span>
				<span class="priceText">
					 <strong>
						  <?php if($property['price'] != '' && $property['price']['daily_price'] > 0){
								echo $currencySymbol." ".currentPrice($property['price']['daily_price'],'',$currencyRate);
						  }
						  else{ echo 'N/A'; }?>
					 </strong>
				</span>
			</div>
                        <!--<span class="perOff">77%</span>-->
		      </div>
		      
                      <div class="itemContent globalClr"> <span class="globalClr itemTitle"><a href="<?php echo $url; ?>"><?php echo stripslashes($property['property_name']); ?> </a></span>
                        <address class="itemAddress">
                        <?php echo stripslashes($property['address'].' '.$property['address2'].', '.$property['city_name'].', '.$property['province_name']); ?>
                        </address>
                        <p class="itemDescription"> <span class="globalClr"><?php echo substr(strip_tags(stripslashes($property['brief_introduction'])),0,80); ?></span><a href="<?php echo $url; ?>">More Info <em class="fa fa-angle-double-right"></em></a></p>
		      <div class="viewAndRemove">
                    	<a class="favouriteRemove removeFav inputBtnOth" href="javascript:void(0);" id="fav-<?php echo $property['favid']; ?>">Remove Favourites</a>
                        <a class="favouriteDetails inputBtnOth" href="<?php echo $url; ?>">Details</a>
		      </div>
		      </div>
                    </li>
                  <?php } ?>  
                  </ul>
    <?php }else{ ?>
    <div align="center" class="lsitingTitle">Your favourite bucket is empty</div>
    <?php } ?>
</div>
*/?>
	 </div>
</div>


