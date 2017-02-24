 <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');

?>
<!--<div class="main">
  <div class="MainCon">-->
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
                        <div class="fav">
                           
									Fabulous
									
									
                           <a href="#"> <em>866</em>  Total Reviews</a>
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
                     <a class="holder" rel="prettyPhoto[gallery]" href="<?php echo isFileExist(CDN_PROPERTY_BIG_IMG.$img['image_name']) ; ?>">
                        <img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$img['image_name']) ; ?>"  width="300" height="225">
								</a>
                     <?php } ?>
                  </div>
						<?php } ?>
               </div>
	    <div class="iconPan">
                  <span>Great <em>Location </em></span>
                  <span>Superb  <em>Stuff </em></span>
                  <span>Excellent  <em>Cleanliness </em></span>
                  <span><a href="<?php echo $map_link;?>"><img src="<?php echo FRONT_IMAGE_PATH;?>blue-map.jpg" alt="no img"></a></span>
               </div>
            </div>
	    <div class="tblPanel">
               <div class="MainCon" id="prices">
                  <h5>Check Availability</h5>
						 <div id="min_day_msg" style="display: none; height: 50px; color: red;"> This hostel has a <?php echo $details['master_details']['minimum_nights_stay']?> min night stay between <span  class="indate"></span> and <span class="out_date"></span>, please change your dates to stay <?php echo $details['master_details']['minimum_nights_stay']?> nights. </div>
        <div id="minDayMsg" style="display: none; height: 50px; color: red;"> </div>
                  <div class="tblUp_change">
                     <span class="dtbar" id="dateBar">
			
		     <?php //echo $checkin_date? date('d/m/Y', strtotime($checkin_date)): ''; ?>  <?php //echo $checkout_date? date('d/m/Y', strtotime($checkout_date)): ''; ?>
		     
		     <?php echo $check_in; ?> - <?php echo $check_out; ?>
                     </span>
                     
                     <span id="changeDate">Change</span>
                  </div>
		  <div class="inner_search_section" style="display: none;">
		  <div class="tblUp">
                     <span id="dateBar" class="dtbar">
				  <!--<input type="text" value="<?php echo date('m/d/Y', strtotime($check_in));?>" readonly="true" placeholder="Select checkin date" id="checkInArr" class="chkInArr">-->
				  <input type="text" value="<?php echo $check_in;?>" readonly="true" placeholder="Select checkin date" id="checkInArr" class="chkInArr">
		     <script>
		     $(document).ready(function(){
				  $("#checkInArr").datepicker({minDate: 0,dateFormat: "dd/mm/yy",onClose:function(){ var minDate = $("#checkInArr").datepicker("getDate"); minDate.setDate(minDate.getDate() + 1); $("#checkOutDpt").datepicker("setDate", minDate);$("#checkOutDpt").datepicker("option", "minDate", minDate);$("#checkOutDpt").datepicker("show");}})})
		 </script>
		     
		     <!--<input type="text" value="<?php  echo date('m/d/Y', strtotime($check_out));?>" readonly="true" placeholder="Select checkout date" id="checkOutDpt" class="">-->
		     
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
                     
                    <input type="button" class="srch_btn" id="sep_srch_btn" value="Search Now" name="Search">
                  </div>
		  
		  </div>
		  
		  
		  
			<?php
			
			
			if(is_array($details['price_charge_type_arr']) && array_key_exists('per_person', $details['price_charge_type_arr'])){ ?>
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
											  $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
											  if($price_arr['price'] > 0)
											  {
												
												$price = $price_arr['price'];
											  }
											  else
											  {
													  
											       $price = $data['base_price']; 
											  }
											  
											  if($price_arr['available'] > 0)
											  {
												$available = $price_arr['available'];
											  
												if($available > ($data['no_of_rooms'] * $data['size']))
												{
												     $available = $data['no_of_rooms'] * $data['size']; 
												}
											
											  }
											  else
											  {
												$available = $data['no_of_rooms'] * $data['size'];
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
                              <select data-ele="<?php echo $data['id'];?>" name="person1" class="person" data-pricetype="<?php echo stripslashes($data['room_price_type']); ?>" data-hosteltype="Beds" data-roomname="<?php echo stripslashes($data['type_name']); ?>" data-roomtype="<?php echo stripslashes($data['id']); ?>" data-price = "<?php echo currentPrice1(stripslashes($price),$currencySymbol,$currencyRate); ?>" data-id="<?php echo $data['id'];?>" data-tot="<?php echo currentPrice1(stripslashes($total_price),$currencySymbol,$currencyRate); ?>" data-roomsize="<?php echo stripslashes($data['size']); ?>" data-symbol="<?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>">
	    <option value="0">Choose</option>
                <?php for($b = 1; $b<=$available; $b++){?>		
		  <option value="<?php echo $b;?>"><?php echo ($b==1)? '1 Bed': $b.' Beds';?></option>
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
						      $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
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
						      $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
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
						
						<?php
						
						
						if(is_array($details['price_charge_type_arr']) &&  array_key_exists('per_night', $details['price_charge_type_arr'])){ ?>
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
										    $available = 0;
										    for($i =0; $i<$no_of_days; $i++)
										    {
											  $day = date('Y-m-d', strtotime($chkindt . " +".$i." day"));
											  
											  $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
											  if($price_arr['price'] > 0)
											  {
												$price = $price_arr['price'];
											  }
											  else
											  {
											       $price = $data['base_price']; 
											  }
											  
											 
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
												if($available > 0){
												if($available > $data['no_of_rooms']){
												
												$available = $data['no_of_rooms'];
												
												}
												}else{
												     $available = $data['no_of_rooms']; 
												}
											  }
											  
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
		  <option value="<?php echo $b;?>"><?php echo ($b == 1) ? '1 Room': $b.' Rooms';?></option>
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
						      $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
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
						      $price_arr = $this->model_property->getAvailabilityPrice($data['id'],$data['property_id'],$day);
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
						
		 
               </div>
	   
	    </div>
	    <div class="MainCon total_summery" style="display: none;">
	    <form name="frmBookNow" id="frmBookNow" method="post" action="<?php echo FRONTEND_URL."property/confirmbooking/";?>">
			    
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
<!--</div>
</div>-->
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
		  
			
<script type="text/javascript">
      function initMap() {
        var point = {lat: <?php echo ($latitude!= '') ? $latitude: '-25.363' ?>, lng: <?php echo ($longitude!= '') ? $longitude: '131.044' ?> };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: point
        });
        var marker = new google.maps.Marker({
          position: point,
          map: map
        });
      }
		//$("#mapClick").click(function(){
		//  initMap();
		//})
		
	
      $('.view_price_details').click(function(){
	    $(this).parent().parent().parent().next().toggle();	
	    	    
      });
      
      
      
	
</script>
<script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5oEneZdCu6tI4-HE_5ZL2XZwMUuQmOgg&callback=initMap"></script>	  
