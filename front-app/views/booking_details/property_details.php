<div class="place-details">
<h2> View Details</h2>
<div class="detail-bar">
<table id="no-more-tables" width="100%" height="100px" cellpadding="0" cellspecing="0" border="0" class="confPayment viewadetails">
<thead>
	<tr>
		<th>Booking Date</th>
		<th>Property Name</th>
		<th>Check In</th>
		<th>Check Out</th>
		<th>Booking Status</th>
	</tr>

</thead>
		<tbody>

<?php
    if(count($view_details) > 0  && !empty($view_details)){ 
        foreach ($view_details['property_details'] as $value) { 
                $old_date = $value['added_date']; 
                $middle	= strtotime($old_date);
?>
		<tr>
			<td data-title="Booking Date"><?php echo $new_date = date('d-m-Y',$middle); ?></td>
			<td data-title="Property Name"><?php echo stripcslashes($value['property_name']); ?></td>
			<td data-title="Check In"><?php echo date('d-m-Y', strtotime($value['check_in'])); ?></td>
			<td data-title="Check Out"><?php echo date('d-m-Y', strtotime($value['check_out'])); ?></td>
			<td data-title="Booking Status"><?php echo $value['Booking_status']; ?></td>
		
		</tr>
<?php
        }
    }
	else
	{
		echo '<tr><td colspan="5"> No Records Found.</td></tr>';
	}
?>
</tbody>  
</table>
</div>
</div>
<div class="room-details">
<h2> Room Details</h2>
<div class="detail-bar">
<table id="no-more-tables" width="100%" height="100px" cellpadding="0" cellspecing="0" border="0" class="confPayment viewadetails">
<thead>		
<tr>	
<th>Arrival Time</th>
<th>Room Name</th>
<th>Room Price</th>
<th>Total Price</th>
<th>Total Person</th>
<!--<th>Total Bed</th>-->

</tr>

</thead>
		<tbody>
<?php
    if(isset($view_details['room_details']) && count($view_details) > 0  && !empty($view_details)){
        foreach ($view_details['room_details'] as $value) { 
            $currencyRate =    $this->nsession->userdata('currencyRate');
            $currencySymbol   = $this->nsession->userdata('currencySymbol');
            $room_price = round(currentPrice1($value['room_price'],$currencySymbol,$currencyRate));
            $total_price = round(currentPrice1($value['total_price'],$currencySymbol,$currencyRate));
?>
	<tr>
		<td data-title="Arrival Time"><?php echo $value['arrival_time']; ?></td>
		<td data-title="Room Name"><?php echo ucwords($value['type_name']); ?></td>
		<td data-title="Room Price"><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo $room_price?></td>
		<td data-title="Total Price"><?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo $total_price?></td>
		<td data-title="Total Person"><?php echo $value['no_of_person']; ?></td>
		<!--<td><?php echo $value['beds']; ?></td>-->
	
	</tr>
<?php
        }
    }
	else { echo '<tr><td colspan="5"> No Records Found.</td></tr>' ;}
?>
</tbody>  
</table>
</div>
</div>


