<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>group-details.js"></script>
<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>



 <div class="mapPan clearfix">
                  <div class="alignleft proTab">
                     <div id="horizontalTab">
                        <ul class="cresp-tabs-list">
                           <li>Overview</li>
			   <li><a data-scroll href="#prices">Prices</a></li>
                           <li><a data-scroll href="#facility">Facilities</a></li>
                           <li class="mapClick"><a href="<?php echo $map_link;?>">Map</a></li>
			   <li>Cancellation Policy</li>
                           <li>Reviews</li>
                        </ul>
                        <div class="cresp-tabs-container">
                           <div>
                              <h5>Property Description</h5>
                               <?php
				  $strLen = strlen(strip_tags($details['master_details']['description']));
				 if($strLen >500){ ?>
				<p> <?php echo nl2br(stripslashes(substr(strip_tags($details['master_details']['description']),0,500))); ?> <span class="" id="moreDescription" style="display: none;"> <?php echo nl2br(stripslashes(substr($details['master_details']['description'],500,$strLen))); ?> </span> </p>
				<p><a class="inputBtnOth readMoreDetails" href="javascript:void(0);" onclick="getRestDesc();" id="readMore">Read more</a></p>
				<?php }else{ ?>
				<p><?php echo nl2br(stripslashes($details['master_details']['description'])); ?></p>
				<?php } ?>
				<script>
				 function getRestDesc(){
				   document.getElementById("moreDescription").style.display = 'block';
					$("#readMore").remove();
				 }
				</script> 
                           </div>
                        </div>
                     </div>
                  </div>
		 <?php if(is_array($avg_review)){ ?>
                  <div class="alignright bookNw">
                     <div class="blueUp">
                        <div class="blueRate">
                          <?php echo (!empty($avg_review) && $avg_review['totalFeedback']) ? sprintf("%.1f", $avg_review['totalFeedback']) : 0; ?>
                        </div>
                        <div class="fav">Fabulous<a href="#"> <em>866</em>  Total Reviews</a>
                        </div>
                     </div>
                     <div class="blueBar">
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['v_f_m']) ? sprintf("%.1f", $avg_review['v_f_m']*10) : 0 ;?>%"><em>Value For Money</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['v_f_m']) ? sprintf("%.1f", $avg_review['v_f_m']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['security']) ? sprintf("%.1f", $avg_review['security']*10) : 0 ;?>%"><em>Security</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['security']) ? sprintf("%.1f", $avg_review['security']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['location']) ? sprintf("%.1f", $avg_review['location']*10) : 0 ;?>%"><em>Location</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['location']) ? sprintf("%.1f", $avg_review['location']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['staff']) ? sprintf("%.1f", $avg_review['staff']*10) : 0 ;?>%"><em>Staff</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['staff']) ? sprintf("%.1f", $avg_review['staff']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['atmosphere']) ? sprintf("%.1f", $avg_review['atmosphere']*10) : 0 ;?>%"><em>Atmosphere</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['atmosphere']) ? sprintf("%.1f", $avg_review['atmosphere']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['cleanliness']) ? sprintf("%.1f", $avg_review['cleanliness']*10) : 0 ;?>%"><em>Cleanliness</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['cleanliness']) ? sprintf("%.1f", $avg_review['cleanliness']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['facilities']) ? sprintf("%.1f", $avg_review['facilities']*10) : 0 ;?>%"><em>Facilities</em></span>
                           <span><?php echo (!empty($avg_review) && $avg_review['facilities']) ? sprintf("%.1f", $avg_review['facilities']) : 0 ;?></span>
                        </div>
                        
                     </div>
                  </div>
						<?php } ?>
               </div>


                 <div class="sliderPan">
						<?php if(count($details['images'])>0){ ?>
                  <div id="owl-demo4" class="owl-carousel owl-theme">
						  <?php foreach($details['images'] as $img){ ?>
                     <a class="holder" rel="prettyPhoto[gallery]" href="<?php //echo isFileExist(CDN_PROPERTY_BIG_IMG.$img['image_name']) ; ?>">
                        <img src="<?php //echo isFileExist(CDN_PROPERTY_SMALL_IMG.$img['image_name']) ; ?>"  width="300" height="225">
								</a>
                     <?php } ?>
                  </div>
						<?php } ?>
               </div>

								<div class="iconPan">
                  <span>Great <em>Location </em></span>
                  <span>Superb  <em>Stuff </em></span>
                  <span>Excellent  <em>Cleanliness </em></span>
                  <span><img src="<?php echo FRONT_IMAGE_PATH;?>blue-map.jpg" alt="no img"></span>
               </div>
            </div>


  	    <div class="tblPanel">
               <div class="MainCon" id="prices">
                  <h5>Check Availability</h5>
						 <div id="min_day_msg" style="display: none; height: 50px; color: red;"> This hostel has a <?php echo $details['master_details']['minimum_nights_stay']?> min night stay between <span  class="indate"></span> and <span class="out_date"></span>, please change your dates to stay <?php echo $details['master_details']['minimum_nights_stay']?> nights. </div>
        <div id="minDayMsg" style="display: none; height: 50px; color: red;"> </div>
                  <div class="tblUp_change">
                     <span class="dtbar" id="dateBar">
                     <?php echo $checkin_date? $checkin_date: ''; ?> - <?php echo $checkout_date? $checkout_date: ''; ?>
                     </span>
                     
                     <span id="changeDate">Change</span>
                  </div>
		 
		  <div class="inner_search_section" style="display: none;">
		  <div class="tblUp">
                     <span id="dateBar" class="dtbar">
			<input type="text" value="<?php echo $check_in;?>" readonly="true" placeholder="Select checkin date" id="checkInArr" class="chkInArr">
			<script>
				  $(document).ready(function(){
				  $("#checkInArr").datepicker({minDate: 0,dateFormat: "dd/mm/yy",onClose:function(){ var minDate = $("#checkInArr").datepicker("getDate"); minDate.setDate(minDate.getDate() + 1); $("#checkOutDpt").datepicker("setDate", minDate);$("#checkOutDpt").datepicker("option", "minDate", minDate);$("#checkOutDpt").datepicker("show");}})})
			</script>
		     
		     <input type="text" value="<?php  echo $check_out;?>" readonly="true" placeholder="Select checkout date" id="checkOutDpt" class="">
		 <script>
		 $(document).ready(function(){
		       $("#checkOutDpt").datepicker(
			  {
			       minDate: "+1D",dateFormat: "dd/mm/yy",onClose: function ()
				  { 	var checkdt1 = $("#checkInArr").datepicker("getDate");
				       var checkdt2 = $("#checkOutDpt").datepicker("getDate");
				       if (checkdt2 <= checkdt1)
					  {
					       var minDate = $("#checkOutDpt").datepicker("option", "minDate");
					       $("#checkOutDpt").datepicker("setDate", minDate);
					   }
				  }
			 })
		 })
		 </script>
		     </span>
                     
                    <input type="button" class="srch_btn" id="srch_btn" value="Search Now" name="Search">
                  </div>
		  
		  
		  
		  <div class="inner_group">
		  <div class="group_section">
				
			<label>Group Type</label>
			<select id="group_list_inner" class="group_list">
				  <option value="">Select group type</option>
				  <?php
				  
				     if(is_array($groupType)){
				  	foreach($groupType as $val)	   
					   {
						
				  ?>
				  
				  <option value="<?php echo $val['slug'];?>" <?php if($group_type == $val['slug']) echo "selected";?> ><?php echo $val['typeName'];?></option>
				  
				  <?php }}?>
				  
			</select>
		  </div>
		  <div class="age_section">
			<label>Age Ranges</label>
		
			<ul id="ageGroup" class="agegroup clearfix">
				  <?php
				  $range = explode('-',$age_ranges);
				  if(is_array($ageGroup)){
				  foreach($ageGroup as $k=> $age)
				  {
				  ?>
				<li>
				        <input type="checkbox" <?php if(in_array($age['id'],$range)) echo "checked";?> value="<?php echo $age['id']; ?>" id="age-rng-<?php echo $k; ?>" class="ageRng">
					<label for="age-rng-<?php echo $k; ?>" class="age"><?php echo $age['ageGroup']; ?></label>
				</li>
				<?php }}?>
				
		  </li></ul>
		  
		  </div>
		  
		  </div>
		  </div>
	       <?php if($group_isAvailable == 'error'){?>
		  <span class="err_msg" style="color: red;"><?php echo $group_available;?></span>
		 <?php } else {?>
			<?php if(array_key_exists('per_person', $details['price_charge_type_arr'])){ ?>
                  <table id="no-more-tables" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Dorm Rooms
                              <span>Prices are per bed</span>
                           </th>
                           <th>Average price per bed</th>
                           <th class="numeric">Guests</th>
                        </tr>
                     </thead>
                     <tbody>
							 <?php if(count($details['price'])>0){
									 $j = 0;
									 //pr($details);
									 foreach($details['price'] as $index=>$data){
										if($data['price_charge_type'] == 'per_person'){
										    
										    if($no_of_days > 0){
										    $avg_price = 0;
										    $avl = 0;
										    for($i =0; $i<$no_of_days; $i++)
										    {
											  $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
											  $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
											  if($price_arr['price'] > 0)
											  {
												$price = $price_arr['price'];
											  }
											  else
											  {
											       $price = $data['base_price']; 
											  }
											  
											  $price = $price*$data['size'];
											  if($price_arr['available'] > 0)
											  {
												$available = $price_arr['available'];
											  
												if($available > $data['no_of_rooms'])
												{
												     $available = $data['no_of_rooms']; 
												}
											
											  }
											  else
											  {
												$available = $data['no_of_rooms'];
											  }
											  $avg_price = $avg_price+$price;
										    }
										    $avg_price = $avg_price/$no_of_days;
									      }
								$total_price = $no_of_days * $avg_price;
								
								
							 ?>
                        <tr>
                           <td data-title="Private Rooms"><?php echo stripslashes(ucwords($data['type_name'])); ?> <br>
                              <?php echo stripslashes(ucwords($data['room_lable'])); ?>
                           </td>
                           <td data-title="Average price per night">
                              <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
                      </span> <?php echo currentPrice1(stripslashes($avg_price),$currencySymbol,$currencyRate); ?>
                              <span><a href="javascript:void(0);" class="view_price_details">View Price Breakdown</a></span> 
                           </td>
                           <td data-title="Rooms" class="numeric">
								  <?php //pr($data,0);?>
								  
                              <select data-ele="<?php echo $data['id'];?>" name="person" class="person" data-pricetype="<?php echo stripslashes($data['room_price_type']); ?>"  data-hosteltype="Rooms" data-roomname="<?php echo stripslashes($data['type_name']); ?>" data-roomtype="<?php echo stripslashes($data['id']); ?>" data-price = "<?php echo currentPrice1(stripslashes($price),$currencySymbol,$currencyRate); ?>" data-id="<?php echo $data['id'];?>" data-tot="<?php echo currentPrice1(stripslashes($total_price),$currencySymbol,$currencyRate); ?>" data-id="<?php echo $data['id'];?>" data-roomsize="<?php echo stripslashes($data['size']); ?>" data-symbol="<?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>">
	    <option value="0">Choose</option>
                <?php for($b = 1; $b<=$available; $b++){?>		
		  <option value="<?php echo $b;?>"><?php echo ($b==1)? '1 Room': $b.' Rooms';?></option>
                <?php }?>
                </select>
                           </td>
                        </tr>
			
			<tr class="price_details_row" style="display: none;">
			<td colspan="3">
			      <table>
				    <tr>
				    <?php if($no_of_days > 0){
						$avg_price = 0;
						for($i =0; $i<$no_of_days; $i++)
						{
						      $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
						      $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
						      if($price_arr['price'] > 0)
						      {
							    $price = $price_arr['price'];
						      }
						      else
						      {
							   $price = $data['base_price']; 
						      }
						      
					  ?>
					  
					  <td><?php echo date('D d',strtotime($day));?></td>
					  
					  
					  <?php }?>
					  
					  <td>Average</td>
					  <?php }?>
				    </tr>
				    
				    <tr>
					 <?php if($no_of_days > 0){
						$avg_price = 0;
						for($i =0; $i<$no_of_days; $i++)
						{
						      $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
						      $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
						      if($price_arr['price'] > 0)
						      {
							    $price = $price_arr['price'];
						      }
						      else
						      {
							   $price = $data['base_price']; 
						      }
						     $price =  $price*$data['size'];
					  ?>
						      <td>
						      
						      <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } echo currentPrice1(stripslashes($price),$currencySymbol,$currencyRate);?></td>
						      
					  <?php
						$avg_price = $avg_price+$price;
						}
					  ?>
						<td>
						    
						      <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } echo currentPrice1(stripslashes($avg_price/$no_of_days),$currencySymbol,$currencyRate);?>
						</td>
					 
					 <?php }?> 
				    </tr>
			      </table>
			</td>
			</tr>

			
								<?php } $j++; } } ?>
                     </tbody>
                  </table>
				  <?php } ?>
						
						
		 <?php if(array_key_exists('per_night', $details['price_charge_type_arr'])){ ?>
                  <table id="no-more-tables" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Private Rooms
                              <span>Prices are per room</span>
                           </th>
                           <th>Average price per night</th>
                           <th class="numeric">Rooms</th>
                        </tr>
                     </thead>
                     <tbody>
			<?php //pr($details['price']);?>
							 <?php if(count($details['price'])>0){
									 $j = 0;
									 foreach($details['price'] as $index=>$data){
									 if($data['price_charge_type'] == 'per_night'){
									      
									      if($no_of_days > 0){
										    $avg_price = 0;
										    for($i =0; $i<$no_of_days; $i++)
										    {
											  $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
											  $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
											  if($price_arr['price'] > 0)
											  {
												$price = $price_arr['price'];
											  }
											  else
											  {
											       $price = $data['base_price']; 
											  }
											  //pr($data,0);
											 
											  if($price_arr['available'] > 0)
											  {
												$available = $price_arr['available'];
											  
												if($available > $data['no_of_rooms'])
												{
												     $available = $data['no_of_rooms']; 
												}
											
											  }
											  else
											  {
												$available = $data['no_of_rooms'];
											  }
											  //$available = $data['no_of_rooms'];
											  $avg_price = $avg_price+$price;
										    }
										    $avg_price = $avg_price/$no_of_days;
									      }
									      
								$total_price = $no_of_days * $avg_price;	      
							 ?>
                        <tr>
                           <td data-title="Private Rooms"> <?php echo stripslashes(ucwords($data['type_name'])); ?> <br>
                              <?php echo stripslashes(ucwords($data['room_lable'])); ?>
                           </td>
                           <td data-title="Average price per night">
                              <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
                      </span> <?php echo currentPrice1(stripslashes($avg_price),$currencySymbol,$currencyRate); ?>
                              <span><a href="javascript:void(0);" class="view_price_details">View Price Breakdown</a></span> 
                           </td>
                           <td data-title="Rooms" class="numeric">
                              <select data-ele="<?php echo $data['id'];?>" name="person" class="person" data-pricetype="<?php echo stripslashes($data['room_price_type']); ?>" data-hosteltype="Rooms" data-roomname="<?php echo stripslashes($data['type_name']); ?>" data-roomtype="<?php echo stripslashes($data['id']); ?>" data-price = "<?php echo currentPrice1(stripslashes($price),$currencySymbol,$currencyRate); ?>" data-id="<?php echo $data['id'];?>" data-tot="<?php echo currentPrice1(stripslashes($total_price),$currencySymbol,$currencyRate); ?>" data-roomsize="<?php echo stripslashes($data['size']); ?>" data-symbol="<?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>">
		<option value="0">Choose</option>	      
                <?php for($b = 1; $b<=$available; $b++){?>		
		  <option value="<?php echo $b;?>"><?php echo ($b==1)? '1 Room': $b.' Rooms';;?></option>
                <?php }?>
                </select>
                        </td>
                        </tr>
			<tr class="price_details_row" style="display: none;">
			<td colspan="3">
			      <table>
				    <tr>
				    <?php if($no_of_days > 0){
						$avg_price = 0;
						for($i =0; $i<$no_of_days; $i++)
						{
						      $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
						      $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
						      if($price_arr['price'] > 0)
						      {
							    $price = $price_arr['price'];
						      }
						      else
						      {
							   $price = $data['base_price']; 
						      }
						      
					  ?>
					  <td><?php echo date('D d',strtotime($day));?></td>
					  
					  <?php }?>
					  <td>Average</td>
					  <?php }?>
				    </tr>
				    
				    <tr>
					 <?php if($no_of_days > 0){
						$avg_price = 0;
						for($i =0; $i<$no_of_days; $i++)
						{
						      $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
						      $price_arr = $this->model_property->getAvailabilityPrice($data['room_type_master_id'],$data['property_id'],$day);
						      if($price_arr['price'] > 0)
						      {
							    $price = $price_arr['price'];
						      }
						      else
						      {
							   $price = $data['base_price']; 
						      }
						      
					  ?>
						      <td>
						      
						      <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } echo currentPrice1(stripslashes($price),$currencySymbol,$currencyRate);?></td>
						      
					  <?php
						$avg_price = $avg_price+$price;
						}
					  ?>
						<td>
						      
						      <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } echo currentPrice1(stripslashes($avg_price/$no_of_days),$currencySymbol,$currencyRate);?>
						</td>
					 
					 <?php }?> 
				    </tr>
			      </table>
			</td>
			</tr>
			
							 <?php } $j++; } } ?>
                     </tbody>
                  </table>
				  <?php } ?>
		 <?php } ?>

 </div>
	   
	    </div>
		  <div class="MainCon total_summery" style="display: none;">
	     <form name="frmBookNow" id="frmBookNow" method="post" action="<?php echo FRONTEND_URL."grp_property/groupconfirmbooking/";?>">
			<input type="hidden" name="property_id" id="property_id" value="<?php echo $details['master_details']['property_master_id'];?>">
			<input type="hidden" name="bookingType" id="booking_type"  value="booking">
			<input type="hidden" name="property_price_total" id="property_price_total">
			<input type="hidden" name="pslug" id="pslug" value="<?php echo $property_slug;?>">
			<input type="hidden" name="nameofdays" value="<?php echo $no_of_days;?>">
			<input type="hidden" name="deal_id" id="deal_id" value="">
			<input type="hidden" name="check_in" value="<?php echo $check_in?>">
			<input type="hidden" name="check_out" value="<?php echo $check_out?>">
			<input type="hidden" name="no_guest" value="<?php echo $guest?>">
	    
	    <table id="total_summery_section">
		  <tr>
			<td width="60%"> My Section </td>
			<td width="20%"> Price</td>
			<td width="10%"> Section</td>
			<td width="10%"> Total</td>
		  </tr>
	    </table>
	    <input type="submit" value="Book Now">
	     </form>
	   </div>
     
		
		
		            <div class="facilityPan">
               <div class="MainCon" id="facility">
                  <h4>Facilities </h4>
						<?php if(count($property_facility)>0 && is_array($property_facility)) {?>
                  <ul>
						  <?php foreach($property_facility as $pf){?>
                     <li class="faciIn">
                        <div class="faciLt alignleft">
                           <?php echo stripcslashes($pf['featured_category_name']);?>
                        </div>
                        <div class="faciRt alignright">
                           <p><?php echo stripcslashes($pf['amenities_name']);?></p>
                        </div>
                     </li>
							<?php } ?>
                     
                  </ul>
						<?php } else { ?>
						<p><b>Facilities will be updated soon...</b></p>
						<?php } ?>
               </div>
            </div>


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
				
</div>
				</div>
			 <input type="hidden" id="minimum_nights_stay" value="<?php echo $details['master_details']['minimum_nights_stay']?>">
			 <input type="hidden" id="property_id" value="<?php echo $details['master_details']['property_master_id'];?>">
		<?php $latitude = $details['master_details']['latitude'];
				$longitude  = $details['master_details']['longitude'];
				
		?>	 

<?php /*


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
*/?>

<script>
	$('.view_price_details').click(function(){
	    $(this).parent().parent().parent().next().toggle();
        });
		 
</script>
