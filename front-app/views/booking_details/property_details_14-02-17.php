<h2> View Details</h2> 
<table width="100%" height="100px" cellpadding="0" cellspecing="0" border="0" class="confPayment viewadetails">
<tr>
<th>Booking Date</th>
<th>Property Name</th>
<th>Check In</th>
<th>Check Out</th>
<th>Booking Status</th>


</tr>

<?php
    if(count($view_details) > 0  && !empty($view_details)){ 
        foreach ($view_details['property_details'] as $value) { 
                $old_date = $value['added_date']; 
                $middle	= strtotime($old_date);
?>
<tr>
<td><?php echo $new_date = date('m-d-Y',$middle); ?></td>
<td><?php echo stripcslashes($value['property_name']); ?></td>
<td><?php echo date('m-d-Y', strtotime($value['check_in'])); ?></td>
<td><?php echo date('m-d-Y', strtotime($value['check_out'])); ?></td>
<td><?php echo $value['Booking_status']; ?></td>

</tr>
<?php
        }
    }
?>
</table>
<h2> Room Details</h2>
<table width="100%" height="100px" cellpadding="0" cellspecing="0" border="0" class="confPayment viewadetails">
		
<tr>	
<th>Arrival Time</th>
<th>Room Name</th>
<th>Room Price</th>
<th>Total Price</th>
<th>Total Person</th>
<!--<th>Total Bed</th>-->

</tr>
<?php
    if(isset($view_details['room_details']) && count($view_details) > 0  && !empty($view_details)){
        foreach ($view_details['room_details'] as $value) { 
            $currencyRate =    $this->nsession->userdata('currencyRate');
            $currencySymbol   = $this->nsession->userdata('currencySymbol');
            $room_price = round(currentPrice1($value['room_price'],$currencySymbol,$currencyRate));
            $total_price = round(currentPrice1($value['total_price'],$currencySymbol,$currencyRate));
?>
<tr>
<td><?php echo $value['arrival_time']; ?></td>
<td><?php echo ucwords($value['type_name']); ?></td>
<td><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo $room_price?></td>
<td><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo $total_price?></td>
<td><?php echo $value['no_of_person']; ?></td>
<!--<td><?php echo $value['beds']; ?></td>-->

</tr>
<?php
        }
    }
?>

</table>

