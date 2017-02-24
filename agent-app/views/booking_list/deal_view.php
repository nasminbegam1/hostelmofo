<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/custom-style.css">
<a class="prnt" href="javascript:void(0)" onclick="window.print();">Print this page</a>
<h3>Ref No: <?php echo $booking[0]['propertyRefNo'].'-'.$booking[0]['paymentRefNo'];?></h3>
<div class="wndwpopUP">
  <div class="left-panel">
    <h4>Customer Details</h4>


    <table cellpadding="0" cellspacing="0">

        
      <tr>
        <td> Name : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['first_name'].' ' .$booking[0]['last_name']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Email : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['email']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Phone :</td>
        <td><?php echo isset($booking[0]) ? stripslashes($booking[0]['phone_no']): '-'; ?></td>
      </tr>
      <tr>
        <td>Nationality : </td>
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['nationality']) : '-'; ?></td>
      </tr>
      <tr>
        <td>Booked :</td>
        <td><?php echo date('dS M\'y H:i:s', strtotime($booking[0]['added_date']));?></td>
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
       
        <td><?php echo isset($booking[0])? stripslashes($booking[0]['sass']) : '-'; ?></td>
      </tr>
     
    </table>
  </div>
  <div class="right-panel">
    <h4>Room Details</h4>
    <table class="roomTypeTable table" cellspadding="0" cellspacing="0">
      <thead>
        <tr>
          <th>Date</th>
          <th>Room</th>
          <th>Person</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($booking) && count($booking)){
	           $grandTotal = 0;

        //pr($booking);

       $roomName = $booking['roomName'];

       $total_price =0;


	    foreach($roomName as $dealroomName){

        $total_price += $dealroomName ['total_price'];
        


	?>
	 <tr>
  		<td><?php echo($booking[0]['check_in']);?></td>
  		
  		<td><?php echo $dealroomName['type_name']; ?></td>
  		<td><?php echo $dealroomName['no_of_person']; ?></td>
  		<td><?php echo $dealroomName ['total_price']; ?></td>
        
         
	 </tr>

        
        <?php
	    }
	}	
  
	?>
        <tr>
          <td></td>

          <td>Total</td>
            <td rowspan="2"><?php  echo number_format((float)$total_price,2,'.',''); ?></td>
        </tr>
      </tbody>
     
    </table>
  </div>
</div>  

      <?php
            $bookingStatus = $booking[0]['Booking_status'];


       if($bookingStatus=='Cancelled'){?>

         <div class="alignCenter">This booking was cancelled on <?php echo ($booking[0]['cancel_date'] != '')?$booking[0]['cancel_date']:'';?></div>
      
      <?php } else { ?> <div class="alignCenter">This booking was ackhowledged on <?php echo ($booking[0]['added_date'] != '')?$booking[0]['added_date']:'';?></div>

          <?php } ?>