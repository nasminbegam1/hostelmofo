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
				
					//pr($booking_data,0);
					//pr($post_value,0);
					if(isset($booking_data) && is_array($booking_data) && count($booking_data)>0){
						foreach($booking_data as $book_data){
							$room_id 				= $book_data['room_type_id'];
							$room_type_id			= explode(',',$book_data['room_type_id']);
							$total_day 				= $book_data['total_day'];
							$property_id 			= $book_data['property_id'];
							$property_price			= $book_data['property_price'];
							$check_in 				= $book_data['check_in'];
							$check_out				= $book_data['check_out'];
							$room_price 			= explode(',',$book_data['room_price']);
							$no_room 				= explode(',',$book_data['no_room']);
							$no_person 				= explode(',',$book_data['no_of_person']);
							$tot_room_price 		= explode(',',$book_data['tot_room_price']);
							$room_name 				= explode(',',$book_data['room_name']);
							$hosteltype 			= explode(',',$book_data['hosteltype']);
						}
					}
					
					//echo "CC1".$property_price; 
					?>
					<div class="targetDiv">
						<div class="allPopupBoxIn bigPop">
							<div class="bookFormPn globalClr popupInSec"> 
								<h3>Room Summary</h3>
								<span><?php echo date('D jS M Y', strtotime($check_in))." - ".date('D jS M Y', strtotime($check_out));?></span>
								<div class="globalClr">
									<table  class="confPayment default_table">
										<tr>
											<td width="60%">My Section</td>
											<td width="20%">Price</td>
											<td width="10%">Section</td>
											<td width="10%">Total</td>
										</tr>
										<?php
										if(is_array($room_type_id)){
											for($i=0;$i<count($room_type_id);$i++){?>
												<tr>
													<td><?php echo $room_name[$i];?></td>
													<td>
														<?php
														if($currencySymbol!=''){
															echo $currencySymbol;
														}
														else{
															echo '$';
														}
														echo currentPrice1(stripslashes($room_price[$i]),$currencySymbol,$currencyRate);?>
													</td>
													<td><?php echo $no_room[$i]." ".$hosteltype[$i] ;?></td>
													<td>
														<?php
														if($currencySymbol!=''){
															echo $currencySymbol;
														}
														else{
															echo '$';
														}
														echo currentPrice1(stripslashes($tot_room_price[$i]),$currencySymbol,$currencyRate);?>
													</td>
												</tr>
												<input type="hidden" name="no_room[<?php echo $i;?>]" value="<?php echo $no_room[$i];?>">
												<input type="hidden" name="room_type_id[<?php echo $i;?>]" value="<?php echo $room_type_id[$i];?>">
												<input type="hidden" name="no_person[<?php echo $i;?>]" value="<?php echo $no_room[$i]?>">
												<input type="hidden" name="room_price[<?php echo $i;?>]" value="<?php echo currentPrice1(stripslashes($room_price[$i]),$currencySymbol,$currencyRate);?>">
												<input type="hidden" name="tot_room_price[<?php echo $i;?>]" value="<?php echo currentPrice1(stripslashes($tot_room_price[$i]),$currencySymbol,$currencyRate);?>">
												<input type="hidden" name="hosteltype[<?php echo $i;?>]" value="<?php echo $hosteltype[$i];?>">
												<input type="hidden" name="room_name[<?php echo $i;?>]" value="<?php echo $room_name[$i];?>">
												<?php 
											}
										}
										$total_room_price 			= $property_price;
										$deposit_amount 			= $downpayment*$total_room_price/100;
										$flexible_deposite_amount	= ($total_room_price*$flexible_amount)/100;
										$total_payable_now			= $deposit_amount + $flexible_deposite_amount;
										$total_price 				= $total_room_price;
										$total_servicetax 			= $total_price*$service_fees/100;
										$total_downpayment 			= $total_price*$downpayment/100;		
										//$total_downpayment		= currentPrice1($total_downpayment,$currencySymbol,$currencyRate);
										$balance_amount 			= $total_price - $total_downpayment + $total_servicetax;
										$usd_downpayment 			= $total_downpayment/$currencyRate;
										$usd_balance 				= $balance_amount/$currencyRate;
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
								
								
									<table width="80%" cellspacing="0" cellpadding="0" border="0" class="paymentsummary">             
										<tr>
											<td width="80%" class="paynow" align="right">Total:
												<?php //echo ($total_price.','.$currencySymbol.','.$currencyRate);?>
											</td>
											<td class="paynow" align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span>
													<?php echo currentPrice1($total_room_price,$currencySymbol,$currencyRate);?>
													<?php //echo $total_room_price;?>
												</span>
											</td>
										</tr>
										<tr>
											<td width="80%" class="nofeeslist" align="right">No Booking Fees:</td>
											<td class="nofeeslist" align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span>0</span>
											</td>
										</tr>
										<tr id="discount_row" style="display: none;">
											<td width="80%" class="nofeeslist" align="right">Discount Amount:</td>
											<td class="nofeeslist" align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span id="disc_amt"></span>
											</td>
										</tr>
										<tr>
											<td width="80%" class="paynow" align="right"><?echo $downpayment;?>% Deposit/Downpayment:</td>
											<td class="paynow" align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span><?php echo currentPrice1($deposit_amount,$currencySymbol,$currencyRate);?></span>
												<input type="hidden" name="deposit_amt" id="deposit_amt" value="<?php echo currentPrice1($deposit_amount,$currencySymbol,$currencyRate);?>">
												<input type="hidden" name="flexi_deposit_amt" id="flexi_deposit_amt" value="<?php echo currentPrice1($flexible_deposite_amount,$currencySymbol,$currencyRate);?>">
											</td>
										</tr>
										<tr id="standard_flexible_amount_row" style="display:none;">
											<td width="80%" class="standard_flex_now" align="right">
												<?echo $standard_flexible_amount;?>% Deposit/Downpayment for Standard Flexible Booking:
											</td>
											<td align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span><?php echo currentPrice1($flexible_deposite_amount,$currencySymbol,$currencyRate);?></span>
											</td>
										</tr>
										<tr id="flex_row" style="display: none;">
											<td width="80%" class="nofeeslist" align="right">Flexible Deposit Protection:</td>
											<td class="nofeeslist" align="left">
												<span>
													<?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
													<?php echo currentPrice1($flexible_deposite_amount,$currencySymbol,$currencyRate);?>
												</span>
											</td>
										</tr>
										<tr>
											<td width="80%" class="nofeeslist" align="right">Total Payable Now:</td>
											<td class="nofeeslist" align="left">
												<span><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?></span>
												<span id="total_payment">
													<?php echo currentPrice1($deposit_amount,$currencySymbol,$currencyRate);?>
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
					<input type="button" name="apply" class="btn_submit" id="discount_apply" value="Apply">
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
					<div class="two_col">
					<div class="innr_two_col">
					<input placeholder="First Name*" name="user_first_name" class="" id="user_first_name" type="text">
					</div>
					<div class="innr_two_col">
					<input placeholder="Sur Name*" name="sur_name"  id="sur_name" class="" type="text">
					</div>
					</div>
					<div class="two_col">
					<div class="innr_two_col">
					<input placeholder="Password*" name="password"  class="form-control requiredTextEnq" id="password" type="password">
					</div>
					<div class="innr_two_col">	
					<input placeholder="Email Address*" name="user_email"  id="user_email" class="requiredTextEnq" type="text">
					</div>
					
					</div>
					<div class="two_col">
					<div class="innr_two_col">
					<input placeholder="Confirm Password*" name="conf_password"  class="form-control requiredTextEnq" id="conf_password" type="password">
					</div>
					</div>
					
					</div>
					
					
					<input name="payment" value="payment" type="hidden">
					<!--<input value="Confirm Payment" class="messageBtn messageVtnEnquery"  type="submit" >-->
					<div class="two_col_btn">
					<input type="button" name="cr_submit" class="btn_submit" id="cr_submit" value="Create">
					<input type="button" id="cancel_uesr" class="btn_submit" value="Cancel">
					<span id="display_msg"></span>  
					</div>
					
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
								<div class="two_col">
									<div class="innr_two_col">
										<input placeholder="First Name*" name="first_name" class="requiredTextEnq" id="first_name1" type="text">
									</div>
									<div class="innr_two_col">
										<input placeholder="Last Name*" name="last_name"  id="last_name1" class="requiredTextEnq" type="text">
									</div>
								</div>
								<div class="two_col">
									<div class="innr_two_col">
										<input placeholder="Email Address*" name="email1"  class="form-control requiredTextEnq" id="email1" type="email"> 
									</div>
									<div class="innr_two_col">
										<select name="nationality" id="nationality">
											<option value="">Select Nationality</option>
											<?php
											if(is_array($country_list) ){
												foreach($country_list as $country){?>
													<option value="<?php echo $country['idCountry']?>"><?php echo $country['countryName'];?></option>
													<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="two_col">
									<div class="innr_two_col">
										<select name="prefix_phone" id="prefix_phone" style="width: 120px;">
											<option value="">Code</option>
											<?php
											if(is_array($country_phone) ){
												foreach($country_phone as $phone){?>
													<option value="<?php echo $phone['phonecode']?>"><?php echo $phone['phonecode']." (". $phone['code'].")";?></option>
													<?php
												}
											}
											?>
										</select>
										<input type="text" placeholder="Phone Number*" name="suffix_phone" id="suffix_phone" style="width: 422px;" onkeydown="javascript:return Numeric(event);">
									</div>
									<div class="innr_two_col">  
										<select name="gender" id="gender">
											<option value=""> Choose Gender</option>
											
												<option value="Male">Male</option>
												<option value="Female">Female</option>
												<option value="Male & Female">Male & Female</option>
												
										</select>
									</div>
								</div>
								<div class="two_col">
									<div class="innr_two_col">
										<input placeholder="Arrival Time*" name="arrival_time" id="arrival_time" type="text">
									</div>
									<!--
									<div class="innr_two_col">
										<input placeholder="Text Sms" name="text_sms" id="text_sms" type="text">
									</div>
									-->
								</div>
								<?php
								$room_ids 	= explode(',',$room_id);
								$record3 	= [];
							
								foreach($room_ids as $r_id){
									$sql ='SELECT HRM.type_flag FROM '.AGENT_ROOMTYPE.' AS HAR INNER JOIN '.ROOMTYPE_MASTER.' AS HRM ON HRM.roomtype_id = HAR.room_type_master_id WHERE HAR.id="'.$r_id.'"';
									$query = $this->db->query($sql);
									$r = $query->result_array();
									//pr($r,0);
									if(isset($r[0]['type_flag'])){
										$record3[] =  $r[0]['type_flag'];	
									}
								}
							
								
								?>
							</div>
							<input type="button" id="continue_uesr_details" class="btn_submit" value="Continue">
							<input type="button" id="cancel_uesr_details" class="btn_submit" value="Cancel">
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
				<?php //pr($card_info,0);?>	
				<div class="targetDiv" id="savecard" style="display: none;" >
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec">
						
					<?php if($walletBlns > 0){ ?>
					<div id="wallet_section">
					
					<b>Your Wallet balance is <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo currentPrice1($walletBlns,$currencySymbol,$currencyRate); ?></b>
					</div>
					<?php } else {?>	
					<h3>Saved card</h3>
					
					
					<div class="formFiled globalClr clearfix">
						<div id="savedcard_view">
						<?php
					
							if(is_array($card_info) ) {						
							foreach($card_info as $card)
							{
								$cc_num = substr($card['card_number'], -4);
						?>	
							<div class="intFiledDiv"><input type="radio" name="cardlist" class="select_card" data-exp="<?php echo $card['expiry_date'];?>" data-cardname="<?php echo $card['card_name'];?>" data-cardno="<?php echo $card['card_number'];?>"><span class="creditcard" data-id="'+data.result[i].id+'">XXXXXXXXXXXX<?php echo $cc_num; ?></span><input type="text" maxlength="4" style="display:none; width: 120px; height:30px;" class="cvv_hidden" placeholder="CVV*"></div>
						
						<?php }?>
						<?php }?>
						<div class="intFiledDiv"><input type="radio" name="cardlist" class="new_card" ><span class="creditcard">Add New Card</span></div>
						
						
						</div>
						
												
					</div>
					<?php }?>
					</div>
					</div>
					<br><br>
				</div>
				<br>
					
				<div class="targetDiv inputDiv" id="payment_details_section" style="display: none;" >
				
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec">
					
					<?php if($walletBlns <= 0){ ?>
						<div class="payment-details-show">
						<h3>Payment Details </h3>
						
						<p class="succEnqMsg"></p>
						
						<input name="spam_chk" id="spam_chk" class="spam_chk_contactinfo" value="100" type="hidden">
						<input name="action" value="Process" type="hidden">
						
						<div class="formFiled globalClr clearfix">
						
						<div class="intFiledDiv">
						<input required placeholder="Creditcard Holder name*" name="cc_holder_name" id="cc_holder_name" class="requiredTextEnq" type="text" >
						</div> 
						<div class="intFiledDiv">
						<input required placeholder="Creditcard Number*" name="cc_number" id="cc_number" class="requiredTextEnq" type="text">
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
						<input required placeholder="Expiration Date (MM/YY)*" value="" name="exp_date" id="exp_date" class="requiredTextEnq" type="text">
						</div> 
						<div class="intFiledDiv">
						<input required placeholder="CVV No*" name="cvv" id="cvv" class="requiredTextEnq" type="text">
						</div> 
						</div>
						</div>
					<?php } ?>
					</div>
					</div>
				</div>
				
				<br>
				<div class="targetDiv" id="final_step_section" style="display: none;" >
				
					<div class="allPopupBoxIn bigPop">
					<div class="bookFormPn globalClr popupInSec"> 
					<h3>Final Step</h3>
					
					<div class="formFiled inpsty">
					
					<p class="line_new">
					<input type="checkbox" name="term_check" id="term_check" required="required" > <label for="term_check">I accept the <a href="<?php echo FRONTEND_URL."terms-and-conditions";?>">Terms and conditions</a> </label>
					</p>
					
					<p></p>
					</div>
					<p>
					
					<h4>Total payable now: <?php //if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }?>$<span id="tot_payble"><?php echo $usd_downpayment;?></span></h4>
					
					
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
					<input type="submit" name="frm_submit" id="conf_submit" class="btn_submit" value="Confirm Payment">
					</p>
					
					
					</div>
				</div>
				</div>
			
			</div>
			<input type="hidden" name="wallet_balance" id="wallet_balance" value="<?php echo $walletBlns; ?>">
			<input type="hidden" name="flexible_booking_amount" id="flexible_booking_amount" value="<?php echo $flexible_deposite_amount;?>">
			<input type="hidden" name="currency_rate" id="currency_rate" value="<?php echo $currencyRate;?>">
			<input type="hidden" name="check_in"  value="<?php echo str_replace('-','/',$check_in);?>">
			<input type="hidden" name="check_out"  value="<?php echo str_replace('-','/',$check_out);?>">
			<input type="hidden" name="total_day"  value="<?php echo $total_day;?>">
			<input type="hidden" id="property_price_total" name="property_price_total"  value="<?php echo currentPrice1($total_room_price,$currencySymbol,$currencyRate); ?>">
			<input type="hidden" name="property_price" id="property_price" value="<?php echo currentPrice1($total_price,$currencySymbol,$currencyRate);?>">
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
	
	</div></div>

<link href="<?php echo FRONT_CSS_PATH;?>timepicki.css" type="text/css" rel="stylesheet" media="all" />

<script>
$('#existing_user').click(function(){
$('#new_user_id').val('<?php echo $this->nsession->userdata('USER_ID'); ?>');
$('#exist_user_arrival_time').show();
var card_info = '<?php echo count($card_info);?>';
if (card_info > 0) {
	$('#savecard').show();
	$('#payment_details_section').hide();
}
else
{
	$('#savecard').show();
	$('#payment_details_section').hide();
}

$('#final_step_section').show();
});



</script>