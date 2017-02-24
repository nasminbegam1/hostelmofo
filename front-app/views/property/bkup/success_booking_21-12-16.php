<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');

//pr($booking_details);
	// exit;
?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
	<div class="main">
		<div class="MainCon">
<form name="frm" method="post" action="">
<div class="listingContent globalClr">
<h2>Booking Details</h2>
<?php //pr($payment_info,0);?>

<?php if($succmsg != ''){?>
      <div class="succmsg"><?php echo $succmsg;?></div>
      <?php } if($errmsg != ''){?>
      
      <div class="errmsg"><?php echo $errmsg;?></div>
      <?php }?>
 <br>
 <div class="chk_heading">
 <span class="chk_name"><span>Check In Date:</span> <?php echo (isset($payment_info[0]['check_in']))? date('jS F Y',strtotime($payment_info[0]['check_in'])):'0';?></span>

 <span class="chk_name"><span>Check Out Date:</span> <?php echo (isset($payment_info[0]['check_out']))? date('jS F Y',strtotime($payment_info[0]['check_out'])):'0';?></span>
 
 <span class="chk_name"><span>Total Amount:</span>AUD $<?php echo (isset($payment_info[0]['property_price']))? round(($payment_info[0]['property_price']/$currencyRate),2):'0';?></span>
 
 <span class="chk_name"><span>Total Pay Amount:</span>AUD $<?php echo (isset($payment_info[0]['payble_amount']))? $payment_info[0]['payble_amount']:'0';?></span>
 </div>
 <div class="booking_info">
 <table width="100%" class="confPayment default_table">
		<tbody>
		  <tr>				
      <th >My Section</th>
      <th >Price</th>
      <th >Section</th>
      <th >Total Price</th>	      
		</tr>
		
    <?php 
    //pr($booking_details,0);
    if(is_array($booking_details))
    {
      
      foreach($booking_details as $booking)
      {
	
	$roomtypename = $this->model_basic->getFromWhereSelect('hw_agent_roomtype', 'type_name,price_charge_type', 'id='.$booking['room_type'].'');
	$paymentinfo = $this->model_basic->getFromWhereSelect(PAYMENT_INFO,'',"paymeny_id = ".$booking['payment_id']);
	//pr($roomtypename,0);
	//pr($paymentinfo,0);
	$no_of_room = $booking['no_of_room'];
	$no_of_person = $booking['no_of_person'];
	$total_price =  $booking['total_price'];
	$room_price =  $booking['room_price'];
	
	$charge_type = ' Room';
	if($payment_info[0]['bookingType'] == 'GroupBooking')
	{
		$charge_type = ' Room';
	}
	else
	{
		if($roomtypename[0]['price_charge_type'] == 'per_person')
		{
			$charge_type = ' Bed';
		}
		else
		{
			$charge_type = ' Room';
		}
	}
	$charge_type_ext = '';
	if($no_of_person>1)
	{
		$charge_type_ext = 's';
	}
	
    ?>
    
    <tr>
      <td ><?php echo ucwords($roomtypename[0]['type_name']);?></td>
      <td ><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo $room_price;//currentPrice1($room_price,$currencySymbol,$currencyRate);?></td>
      <td ><?php echo $no_of_person;?> <?php  echo $charge_type.$charge_type_ext;?></td>
      <!--<td >AUD $<?php //echo round($room_price*$paymentinfo[0]['currency_rate']);?></td>-->
      <!--<td >AUD $<?php echo round($paymentinfo[0]['property_price']);?></td> -->     
      <!--<td ><?php //if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php //echo round($room_price*$paymentinfo[0]['currency_rate']);?></td>--> 
      <td ><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?>
      <?php
      echo $total_price;//currentPrice1($total_price,$currencySymbol,$currencyRate);
      ?>
      </td>
    </tr>
    
    <?php } ?>
    <tr>
      <td colspan="3" style="text-align: right;"><b>Total price : </b></td>
      <td><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; }  echo $paymentinfo[0]['property_price'];//currentPrice1($paymentinfo[0]['property_price'],$currencySymbol,$currencyRate);?></td>
    </tr>
    <?php } ?>
	</tbody>
 </table>
 </div>
      

</div>

</form>
		</div>
	  </div>
