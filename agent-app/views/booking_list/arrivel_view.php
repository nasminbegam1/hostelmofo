<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/custom-style.css">
<a class="prnt" href="javascript:void(0)" onclick="window.print();">Print this page</a>
<h3>Ref No: <?php echo $booking[0]['paymentRefNo'];?></h3>
<div class="wndwpopUP">
  <div class="left-panel">
    <h4>Customer Details</h4>
    <table cellpadding="0" cellspacing="0">
      <tr>
        <td>Name : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['first_name'].' ' .$booking[0]['last_name']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Email : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['email']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Phone :</td>
        <td><?php echo isset($booking[0]) ? stripslashes($booking[0]['phone_no']): '-' ?></td>
      </tr>
      <tr>
        <td>Nationality : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['nationality']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Booked :</td>
        <td><?php echo date('dS M\'y H:i:s', strtotime($booking[0]['booked_date']));?></td>
      </tr>
      <tr>
        <td>Arriving : </td>
        <td><?php echo date('dS M\'y', strtotime($booking[0]['check_in']));?></td>
      </tr>
      <tr>
        <td>Arrival Time :</td>
        <td><?php echo $booking[0]['arrival_time'];?></td>
      </tr>
      <tr>
        <td>Persons :</td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['gender'].' :' .$booking[0]['no_of_person']) : '-'; ?></td>
      </tr>
      
    </table>
  </div>
  <div class="right-panel">
    <h4>Room Details</h4>
    <table class="roomTypeTable table" cellspadding="0" cellspacing="0">
      <thead>
        <tr>
          <th>Date</th>
          <th>Acknowledged</th>
          <th>Room</th>
          <th>Person</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($booking) && count($booking)){
	    $grandTotal = 0;
	    foreach($booking as $k=>$room){
		$grandTotal += $room['total_price'];
		$dStart 	= new DateTime($room['check_in']);
		$dEnd  		= new DateTime($room['check_out']);
		$dDiff 		= $dStart->diff($dEnd);
		$days		= $dDiff->days;
		for($i=0;$i<$days;$i++){
	?>
	      <tr>
		<td><?php echo date('dS M\'y', strtotime('+'.$i.' day', strtotime($room['check_in'])));?></td>
		<td><?php echo date('m-d-Y',strtotime($room['booked_date']));?></td>
		<td><?php echo ucwords($room['type_name']); ?></td>
		<td><?php echo $room['no_of_person']; ?></td>
		<td><?php echo number_format($room['total_price']/$days,2); ?></td>
	      </tr>
        <?php
		}
	    }
	}	
	?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" align="right">Service Charge : </td>
          <td colspan="2"><?php echo $room['currency_name']; ?><br>
            <?php echo $room['service_fees']; ?>%</td>
        </tr>
        <tr>
          <td colspan="3" align="right">Total Price inc.Service Charge : </td>
          <td colspan="2"><?php echo $room['currency_name']; ?><br>
	  <?php echo number_format(($grandTotal * ($room['service_fees']/100))*$room['currency_rate'],2); ?></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><?php echo $room['downpayment_percent']; ?>% Deposite : </td>
          <td colspan="2"><?php echo $room['currency_name']; ?><br>
            <?php echo number_format($room['payble_amount']*$room['currency_rate'],2); ?></td>
        </tr>
        <tr>
          <td colspan="3" align="right">Balance Due : </td>
          <td colspan="2"><?php echo $room['currency_name']; ?><br>
            <?php echo number_format($room['usd_balance']*$room['currency_rate'],2);?></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<div class="alignCenter">This booking was acknowledged on <?php echo ($booking[0]['booked_date'] != '')? date('m-d-Y',strtotime($booking[0]['booked_date'])):'';?></div>
