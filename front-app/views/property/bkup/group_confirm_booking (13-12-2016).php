<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
	<div class="main">
		<div class="MainCon">
			<form name="frm" method="post" action="">
				<input type="hidden" name="pslug" id="pslug" value="<?php echo $property_slug;?>">
				<input type="hidden" name="bookingType" value="booking">
				<div class="listingContent globalClr">
					<?php
					if($succmsg != ''){?>
						<div class="succmsg"><?php echo $succmsg;?></div>
						<?php
					}
					if($errmsg != ''){?>
						<div class="errmsg"><?php echo $errmsg;?></div>
						<?php
					}
				
					//pr($booking_data);
				
					if(isset($booking_data) && is_array($booking_data) && count($booking_data)>0){
						foreach($booking_data as $book_data){
							$room_id 			= $book_data['room_type_id'];
							$room_type_id		= explode(',',$book_data['room_type_id']);
							$total_day 			= $book_data['total_day'];
							$property_id 		= $book_data['property_id'];
							$property_price		= $book_data['property_price'];
							$check_in 			= $book_data['check_in'];
							$check_out			= $book_data['check_out'];
							$room_price 		= explode(',',$book_data['room_price']);
							$no_room 			= explode(',',$book_data['no_room']);
							$no_person 			= explode(',',$book_data['no_of_person']);
							$tot_room_price 	= explode(',',$book_data['tot_room_price']);
							
						}
					}
					?>
					<div class="targetDiv"  >
						<div class="allPopupBoxIn bigPop">
							<div class="bookFormPn globalClr popupInSec"> 
								<h3>Room Summary2</h3>
								<div class="globalClr">
									
									
									<table width="100%" class="confPayment">
										<tr>				
											<th>Day</th>
											<th>Accomodation</th>
											<th>Price</th>
											<th>Guests</th>
											<th>Total</th>
										</tr>
										<?php
										$new_data = '';
										if(isset($room_type_id) && is_array($room_type_id)){
											$total_day 						= $total_day;
											$property_price 				= $property_price;
											$total_price 					= $property_price;
											$total_servicetax 				= $total_price*$service_fees/100;
											$total_downpayment 				= $total_price*$downpayment/100;
											$final_downpayment				= currentPrice1($total_downpayment,$currencySymbol,$currencyRate);
											$balance_amount 				= $total_price - $total_downpayment + $total_servicetax;
											//$flexible_deposite_amount 	= currentPrice1($total_price*$flexible_amount/100,$currencySymbol,$currencyRate);
											$usd_downpayment 				= $total_downpayment/$currencyRate;
											$usd_balance 					= $balance_amount/$currencyRate;
											$room_price_per_day				= 0;
											$total_room_price				= 0;
											$deposit_amount					= 0;
											$total_payable_now				= 0;
										
											for($i = 0;$i<$total_day;$i++){
												$check_in1 	= explode('/',$check_in);
												//echo $check_in;
												$startDate 	= strtotime($check_in1[2]."-".$check_in1[1]."-".$check_in1[0]);	
												$new_data 	= date('D jS', strtotime('+'.$i.' day', $startDate));
												$new_data1 	= date('Y-m-d', strtotime('+'.$i.' day', $startDate));
										
												foreach($room_type_id as $k => $room){
													$sql 	= "SELECT * FROM hw_availibility WHERE property_id = '".$property_id."' AND roomtype_id = '".$room."' AND DATE_FORMAT(date,'%Y-%m-%d') = '".$new_data1."'";
													$str 	='SELECT  HAR.* FROM hw_agent_roomtype as HAR WHERE HAR.id = "'.$room.'" AND HAR.property_id="'.$property_id.'"';
													$q 		= $this->db->query($str);
													$res 	= $q->result_array();
													$query 	= $this->db->query($sql);
												
													if($query->num_rows()>0){
														$record	= $query->result_array();
														$price 	= currentPrice($record[0]['price'],$currencySymbol,$currencyRate);
														$price1 = currentPrice1($record[0]['price'],$currencySymbol,$currencyRate);
													}
													else{
														$price 	= currentPrice($room_price[$k],$currencySymbol,$currencyRate);
														$price1 = currentPrice1($room_price[$k],$currencySymbol,$currencyRate);
													}
												
													if($k%2==0){
														$class  = "odd_class";	
													}
													else{
														$class  = "even_class";	
													}
												
													$room_price_per_day = ($res[0]['price_charge_type'] == 'per_person') ? ($price1*$no_person[$k] * $no_room[$k]) : ($price1 * $no_room[$k]);
													$total_room_price 	= $total_room_price + $room_price_per_day;
													?>
										
													<input type="hidden" name="room_price[<?php echo $k;?>]" value="<?php echo str_replace(',','',$price);?>">	
													<input type="hidden" name="no_room[<?php echo $k;?>]" value="<?php echo $no_room[$k];?>">
													<input type="hidden" name="room_type_id[<?php echo $k;?>]" value="<?php echo $room_type_id[$k];?>">
													<input type="hidden" name="no_person[<?php echo $k;?>]" value="<?php echo $no_person[$k];?>">
													<input type="hidden" name="tot_room_price[<?php echo $k;?>]" value="<?php echo ($res[0]['price_charge_type'] == 'per_person') ? number_format($price1*$no_person[$k]*$no_room[$k],2) : number_format($price1*$no_room[$k],2);?>">
													
													<?php
													if(isset($roomtypeprice[$room_type_id[$k]]))
														$roomtypeprice[$room_type_id[$k]] = $roomtypeprice[$room_type_id[$k]] + (int)str_replace(',', '', $price);
													else
														$roomtypeprice[$room_type_id[$k]] = (int)str_replace(',', '', $price);
													?>
													<input type="hidden" name="total_price_per_type[<?php echo $k;?>]" value="<?php echo (int)str_replace(',', '', $roomtypeprice[$room_type_id[$k]]);?>">
													<tr class="<?php echo $class;?>">
														<td><?php echo $new_data;?></td>
														<td><?php echo stripslashes(ucwords($res[0]['type_name']));?></td>
														<td>
															<?php
															//echo $price.','.$currencySymbol.','.$currencyRate;
															if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo round($price1);?>
														</td>
														<td><?php echo $no_person[$k];?></td>
														<td>
															<?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> 
															<?php echo round($room_price_per_day);?>
														</td>
													</tr>
													<?php
												}
											}
										}
										$deposit_amount 			= ($total_room_price*$downpayment)/100;
										$flexible_deposite_amount 	= ($total_room_price*$flexible_amount)/100;
										$total_payable_now			= $deposit_amount + $flexible_deposite_amount;
										?>
									</table>
								
									
									
									
									
									
									<div class="booking_type">
										<h2>Booking Type</h2>
										<div class="booking_type_select">
											<input type="radio" name="booking_type" class="bookingtype" id="non_flexible" required="required" checked="checked" value="Non-flexible"><h4>Non-flexible Booking</h4>
											<br>
											<span>Your deposit is non-refundable if you decide to cancel your booking.<a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Standard T&Cs apply</a> apply.</span>
										</div>
										<div class="booking_type_select">
											<input type="radio" name="booking_type" id="flexible" class="bookingtype" required="required" value="flexible"><h4>Standard Flexible Booking</h4>
											<br>
											<span>Your deposit is protected so you can use it to make another booking if you cancel. <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Standard T&Cs</a> apply</span>
										</div>  
									</div>   
								
								
									<table width="100%" cellspacing="0" cellpadding="0" border="0" class="paymentsummary">             
									<tr>
									<td width="100%" class="paynow" align="right">Total: <?php //echo ($total_price.','.$currencySymbol.','.$currencyRate);?></td>
									<td class="paynow" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
									<span>
									<?php //echo round(currentPrice($total_price,$currencySymbol,$currencyRate));?>
									<?php echo round($total_room_price);?>
									</span></td>
									</tr>
									
									<tr>
									<td width="100%" class="nofeeslist" align="right">No Booking Fees:</td>
									<td class="nofeeslist" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
									<span>0</span></td>
									</tr>
									
									<tr id="discount_row" style="display: none;">
									<td width="100%" class="nofeeslist" align="right">Discount Amount:</td>
									<td class="nofeeslist" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
									<span id="disc_amt"></span>
									</td>
									</tr>
									<tr>
									<td width="100%" class="paynow" align="right"><?echo $downpayment;?>% Deposit/Downpayment:</td>
									<td class="paynow" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
									<span><?php echo number_format($deposit_amount,2);?></span>
									<input type="hidden" name="deposit_amt" id="deposit_amt" value="<?php echo round($deposit_amount);?>">
									<input type="hidden" name="flexi_deposit_amt" id="flexi_deposit_amt" value="<?php echo $flexible_deposite_amount;?>">
									
									</td>
									</tr>
									<tr id="standard_flexible_amount_row" style="display:none;">
									<td width="100%" class="standard_flex_now" align="right"><?echo $standard_flexible_amount;?>% Deposit/Downpayment for Standard Flexible Booking:</td>
									<td align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <span><?php echo number_format($flexible_deposite_amount,2);?></span></td>
									
									</tr>
									
									
									
									
									<tr id="flex_row" style="display: none;">
									<td width="100%" class="nofeeslist" align="right">Flexible Deposit Protection:</td>
									<td class="nofeeslist" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
									<?php echo $flexible_deposite_amount;?></span>
									</td>
									</tr>
									
									<tr>
									<td width="100%" class="nofeeslist" align="right">Total Payable Now:</td>
									<td class="nofeeslist" align="left"><span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
									</span>
									<span id="total_payment">
									<?php echo $deposit_amount;?>
									</span>
									</td>
									</tr>
									
									</table>
								
								
								</div>
							
							
							</div>
						</div>
					</div>
					<br>
					<div class="targetDiv" id="discount_code_section" style="display: block;" >
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec"> 
					<h3>Discount Code</h3>
					
					
					<div class="formFiled globalClr clearfix">
					<div class="intFiledDiv">
					<input placeholder="Discount Code" name="discount_code" id="discount_code" type="text">
					<span class="errmsg" id="discount_msg"></span>
					</div>
					</div>
					
					<p>
					<input type="button" name="apply" id="discount_apply" value="Apply">
					</p>
					
					</div>
					</div>
					<br><br>
					</div>
					<div class="targetDiv" >
					
					<div class="allPopupBoxIn bigPop">
					<?php if($this->nsession->userdata('USER_ID') != ''){?>
					<p><a class="inputBtnOth" id="existing_user" href="javascript:void(0);">Continue with your account</a></p>
					<?php }else{ ?>
					<p id="book_now-btn" style="display: block;"> <a class="inputBtnOth" id="create_account" href="javascript:void(0);">Create an account</a> <a class="inputBtnOth" id="book_now" href="javascript:void(0);">Book without making an account  </a> </p>
					
					<?php } ?>
					</div>
					</div>
				
				
					<div class="targetDiv" id="create_account_secton" style="display: none;" >
					
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec"> 
					<h3>Create an Account</h3>
					
					<p class="succEnqMsg"></p>
					
					<input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
					<input name="action" value="Process" type="hidden">
					
					
					
					<div class="formFiled globalClr">
					<p>
					<input placeholder="First Name*" name="user_first_name" class="" id="user_first_name" type="text">
					</p>
					<p>
					<input placeholder="Sur Name*" name="sur_name"  id="sur_name" class="" type="text">
					</p>
					<p>
					<input placeholder="Email Address*" name="user_email"  id="user_email" class="requiredTextEnq" type="text">
					</p>
					<p>
					<input placeholder="Password*" name="password"  class="form-control requiredTextEnq" id="password" type="password">
					</p>
					
					<p>
					<input placeholder="Confirm Password*" name="conf_password"  class="form-control requiredTextEnq" id="conf_password" type="password">
					</p>
					
					
					
					<p></p>
					</div>
					
					<p>
					<input name="payment" value="payment" type="hidden">
					<!--<input value="Confirm Payment" class="messageBtn messageVtnEnquery"  type="submit" >-->
					<input type="button" name="cr_submit" id="cr_submit" value="Create">
					<input type="button" id="cancel_uesr" value="Cancel">
					<span id="display_msg"></span>  
					</p>
					
					</div>
					</div>
					<br><br>
					</div>
				
				
					<div class="targetDiv" id="user_details_section" style="display: none;" >
					
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec"> 
					<h3>Your Details</h3>
					
					<p class="succEnqMsg" id="user_errmsg"></p>
					
					<input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
					<input name="action" value="Process" type="hidden">
					
					
					<div class="formFiled globalClr">
					<div id="unregister_section">
					<p>
					<input placeholder="First Name*" name="first_name" class="requiredTextEnq" id="first_name1" type="text">
					</p>
					<p>
					<input placeholder="Last Name*" name="last_name"  id="last_name1" class="requiredTextEnq" type="text">
					</p>
					<p>
					<input placeholder="Email Address*" name="email1"  class="form-control requiredTextEnq" id="email1" type="email">
					</p>
					
					</div>
					
					<p>
					
					<select name="nationality" id="nationality">
					<option value="">Select Nationality</option>
					<?php
					if(is_array($country_list) )
					{
					foreach($country_list as $country){
					?>
					<option value="<?php echo $country['idCountry']?>"><?php echo $country['countryName'];?></option>
					<?php }}?>
					
					</select>
					
					</p>
					
					<p>
					<input placeholder="Arrival Time*" name="arrival_time" id="arrival_time" type="text">
					</p>
					
					<p>
					
					<select name="prefix_phone" id="prefix_phone" style="width: 120px;">
					<option value="">Code</option>
					<?php
					if(is_array($country_phone) )
					{
					foreach($country_phone as $phone){
					?>
					<option value="<?php echo $phone['phonecode']?>"><?php echo $phone['phonecode']." (". $phone['code'].")";?></option>
					<?php }}?>
					
					</select> 
					
					<input placeholder="Phone Number*" onkeydown="javascript:return Numeric(event);" name="suffix_phone" id="suffix_phone" type="text" style="width: 256px;">
					</p>
					
					<p>
					<input placeholder="Text Sms" name="text_sms" id="text_sms" type="text">
					</p>
					
					<p>
					<?php $room_ids = explode(',',$room_id);
					$record3 = [];
					foreach($room_ids as $r_id){
					$sql ='SELECT HRM.type_flag FROM '.AGENT_ROOMTYPE.' AS HAR INNER JOIN '.ROOMTYPE_MASTER.' AS HRM ON HRM.roomtype_id = HAR.room_type_master_id WHERE HAR.id="'.$r_id.'"';
					$query = $this->db->query($sql);
					$r = $query->result_array();
					$record3[] =  $r[0]['type_flag'];
					}
					$checkGender = max($record3);?>
					<select name="gender" id="gender">
					<option value=""> Choose Gender</option>
					<?php if($checkGender == 1){ echo '<option value="Male">Male</option>'; }
					elseif($checkGender == 2) { echo '<option value="Female">Female</option>'; }
					else { ?>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Male & Female">Male & Female</option>
					<?php }?>
					</select>
					</p>
					
					<p></p>
					</div>
					<input type="button" id="continue_uesr_details" value="Continue">
					<input type="button" id="cancel_uesr_details" value="Cancel">
					
					</div>
					</div>
					</div>
				
					<div style="display: none" id="exist_user_arrival_time" class="inputDiv">
					<div class="bookFormPn globalClr popupInSec">
					<div class="formFiled globalClr clearfix">
					<div class="intFiledDiv">
					<label>Arrival Time*</label>
					<input placeholder="Arrival Time*" name="arrival_time1" id="arrival_time1" type="text" class="requiredTextEnq">
					</div>
					</div>
					</div>
					</div>
					<br>
					<div class="targetDiv inputDiv" id="payment_details_section" style="display: none;" >
					
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec">
					<?php if($walletBlns > 0){ ?>
					<div id="wallet_section">
					
					<b>Your Wallet balance is <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo currentPrice1($walletBlns,$currencySymbol,$currencyRate); ?></b>
					</div>
					<?php } ?>
					<div class="payment-details-show">
					<h3>Payment Details </h3>
					
					<p class="succEnqMsg"></p>
					
					<input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
					<input name="action" value="Process" type="hidden">
					
					<div class="formFiled globalClr clearfix">
					
					<div class="intFiledDiv">
					<input placeholder="Creditcard Holder name*" name="cc_holder_name" id="cc_holder_name" class="requiredTextEnq" type="text" >
					</div> 
					<div class="intFiledDiv">
					<input placeholder="Creditcard Number*" name="cc_number" id="cc_number" class="requiredTextEnq" type="text">
					</div> 
					<div class="intFiledDiv">
					<select name="card_type" id="card_type">
					<option value="">Select Card Type</option>
					<option value="MasterCard">MasterCard</option>
					<option selected="selected" value="Visa">Visa</option>
					<option value="Discover">Discover</option>
					<option value="Amex">Amex</option>
					<option value="Maestro">Maestro</option>
					</select>
					</div> 
					<div class="intFiledDiv">
					<input placeholder="Expiration Date (MM/YY)*" value="" name="exp_date" id="exp_date" class="requiredTextEnq" type="text">
					</div> 
					<div class="intFiledDiv">
					<input placeholder="CVV No*" name="cvv" id="cvv" class="requiredTextEnq" type="text">
					</div> 
					</div>
					</div>
					</div>
					</div>
					</div>
				
					<br>	
					<div class="targetDiv" id="final_step_section" style="display: none;" >
					
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec"> 
					<h3>Final Step</h3>
					
					<div class="formFiled inpsty">
					
					<p>
					<input type="checkbox" name="term_check" id="term_check" required="required" > I accept the <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Terms and conditions</a>
					</p>
					
					<p></p>
					</div>
					<p>
					
					<h4>Total payable now: <?php //if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>$<span id="tot_payble"><?php echo $total_downpayment;?></span></h4>
					
					
					<?php if(round($total_downpayment) > round(currentPrice1($walletBlns,$currencySymbol,$currencyRate))){
					//echo round($total_downpayment) - round(currentPrice1($walletBlns,$currencySymbol,$currencyRate));
					}?>
					
					
					</p>
					<?php
					$balance_amount_aud 	= $total_price-$total_downpayment;
					$balance_amount_usd	= $balance_amount_aud*$usd_currency_rate;
					
					
					?>
					<p>
					The balance of <?php //if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>$<span id="blns_amt"><?php echo $balance_amount_aud;?></span> (US$<span id="usd_amt"><?php echo sprintf ("%.2f", $balance_amount_usd);?></span>) is payable when you arrive at the property
					</p>
					
					<p>
					<input name="payment" value="payment" type="hidden">
					
					
					<input type="hidden" name="new_user_id" id="new_user_id">  
					<!--<input value="Confirm Payment" class="messageBtn messageVtnEnquery"  type="submit" >-->
					<input type="submit" name="frm_submit" id="conf_submit" value="Confirm Payment">
					</p>
					
					
					</div>
					</div>
				</div>
				<input type="hidden" name="wallet_balance" id="wallet_balance" value="<?php echo $walletBlns; ?>">
				<input type="hidden" name="flexible_booking_amount" id="flexible_booking_amount" value="<?php echo $flexible_deposite_amount;?>">
				<input type="hidden" name="currency_rate" id="currency_rate" value="<?php echo $currencyRate;?>">
				<input type="hidden" name="check_in"  value="<?php echo $check_in;?>">
				<input type="hidden" name="check_out"  value="<?php echo $check_out;?>">
				<input type="hidden" name="total_day"  value="<?php echo $total_day;?>">
				<input type="hidden" id="total_property_price" name="total_property_price"  value="<?php echo $property_price;?>">
				<input type="hidden" name="property_price" id="property_price" value="<?php echo $total_price;?>">
				<input type="hidden" name="payble_amount" id="payble_amount" value="<?php echo $total_downpayment;?>">
				<input type="hidden" name="downpayment" value="<?php echo $downpayment;?>">
				<input type="hidden" id="downpayment_amount" name="downpayment_amount" value="<?php echo $downpayment_amount;?>">
				<input type="hidden" name="standard_flexible_amount" value="<?php echo $standard_flexible_amount;?>" id="standard_flexible_amount">
				<input type="hidden" name="total_downpayment" id="total_downpayment" value="<?php echo $total_downpayment;?>">
				<input type="hidden" name="total_servicetax" id="total_servicetax" value="<?php echo $total_servicetax;?>">
				<input type="hidden" name="usd_balance" id="usd_balance" value="<?php echo $balance_amount_aud;?>">
				<input type="hidden" name="property_id" value="<?php echo $property_id;?>">
				<input type="hidden" name="room_id" value="<?php echo $room_id;?>">
				<input type="hidden" name="discount_type" id="discount_type" value="">
				<input type="hidden" name="discount_amount" id="discount_amount" value="">
				<input type="hidden" name="usd_currency_rate" id="usd_currency_rate" value="<?php echo $usd_currency_rate;?>">
			</form>
		</div>
	</div>
</div>

<link href="<?php echo FRONT_CSS_PATH;?>timepicki.css" type="text/css" rel="stylesheet" media="all" />
<script>
$('#existing_user').click(function(){
	$('#new_user_id').val('<?php echo $this->nsession->userdata('USER_ID'); ?>');
	$('#exist_user_arrival_time').show();
	$('#payment_details_section').show();
	$('#final_step_section').show();
});
</script>