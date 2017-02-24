<div class="main">
    <div class="MainCon">
		<ul class="viewTab">
	<li>
	<a href="<?php echo FRONTEND_URL;?>booking_details" <?php if(currentClass() == 'booking_details' && currentMethod()=='index'){?>class="active"<?php } ?>>All Review</a>
	</li>
	<li>
	<a href="<?php echo FRONTEND_URL;?>booking_details/future_bookings" <?php if(currentClass() == 'booking_details' && currentMethod()=='future_bookings'){?>class="active"<?php } ?>>Past Review</a>
	</li>
	<li>
	<a href="<?php echo FRONTEND_URL;?>booking_details/past_booking" <?php if(currentClass() == 'booking_details' && currentMethod()=='past_booking'){?>class="active"<?php } ?>>Pending Review</a>
	</li>

</ul>
<?php if($succMsg!='') {?>
<div class="alert alert-success display-show" ><?php echo $succMsg; ?></div>
<?php } ?>
<div class="detail-bar">
		<table width="100%" height="100px" cellpadding="" cellspecing="" border="" class="confPayment">


		<tr>
		<th>Booking Date</th>
		<th>Property Name</th>
		<th>Status</th>
		<th>Action</th>


		</tr>
		
			<?php   
		pr($all_review);
		if(is_array($property_details )){
			foreach ($property_details as $value) { 
			$old_date = $value['added_date']; 
			$middle	= strtotime($old_date);

			//echo $paymeny_id = $value['paymeny_id']; 
		?>
		<tr>
		<td><?php echo $new_date = date('m-d-Y', $middle); ?></td>
		<td><?php echo stripslashes($value['property_name']); ?></td>
		<td><?php echo $value['Booking_status']; ?></td>
		<td><a href="<?php echo FRONTEND_URL."booking_details/view_details/".$value['paymeny_id'];?>">View Details</a>
			<?php if( strtotime($value['check_in'])> strtotime(date("Y-m-d"))){?>
				<a href="javascript:void(0);" onclick="cancel(<?php echo $value['paymeny_id'];?>)"><?php if($value['Booking_status']=='Booked'){ echo 'Cancel';}?></a>
			<?php }?>
			

		</td>
		</tr>
		<?php
		} 

		}else{
		?>

			<tr>
				<td colspan="4" align="center"><?php echo '...Record Not Found...'; ?></td>
		 	</tr> 

		<?php }  ?> 

		  

		</table>
</div>
		<script>

		function cancel()
		{

		//alert(paymeny_id); //exit;


	    if(confirm('Do you want to cancel property')){


		window.location.href="<?php echo FRONTEND_URL."booking_details/property_cancel/".$value['paymeny_id'];?>";
			}


		}

		</script>
	 </div>
</div>