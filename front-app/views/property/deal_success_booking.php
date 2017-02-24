<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>

<form name="frm" method="post" action="">
<div class="listingContent globalClr">
<h2>Booking Details</h2>


<?php if($succmsg != ''){?>
      <div class="succmsg"><?php echo $succmsg;?></div>
      <?php } if($errmsg != ''){?>
      
      <div class="errmsg"><?php echo $errmsg;?></div>
      <?php }?>
 <br>
 <div class="chk_heading">
 <span class="chk_name"><span>Check In Date:</span> <?php echo (isset($payment_info[0]['check_in']))? date('jS F Y',strtotime($payment_info[0]['check_in'])):'0';?></span>

 <span class="chk_name"><span>Check Out Date:</span> <?php echo (isset($payment_info[0]['check_out']))? date('jS F Y',strtotime($payment_info[0]['check_out'])):'0';?></span>
 
 <span class="chk_name"><span>Total Amount:</span> <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo (isset($payment_info[0]['property_price']))? $payment_info[0]['property_price']:'0';?></span>
 
 <span class="chk_name"><span>Total Pay Amount:</span> $<?php echo (isset($payment_info[0]['payble_amount']))? $payment_info[0]['payble_amount']:'0';?></span>
 </div>
 <div class="booking_info">
 <table width="100%" class="confPayment">
		<tbody>
		  <tr>				
      <th >Room types chosen</th>
      <th >No. Rooms</th>
      <th >No. Guests</th>
      <th >Total Price</th>	      
		</tr>
		
    <?php
    
    
    if(is_array($booking_details))
    {
      
      foreach($booking_details as $booking)
      {
	
	$roomtypename = $this->model_basic->getValue_condition(AGENT_ROOMTYPE, 'type_name', '', 'id='.$booking['room_type'].'');
	$no_of_room = $booking['no_of_room'];
	$no_of_person = $booking['no_of_person'];
	$total_price =  $booking['total_price'];
    ?>
    
    <tr>
      <td ><?php echo $roomtypename;?></td>
      <td ><?php echo $no_of_room;?></td>
      <td ><?php echo $no_of_person;?></td>
      <td ><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?><?php echo $total_price;?></td>
    </tr>
    
    <?php }}?>
	</tbody>
 </table>
 </div>
      

</div>

</form>