<div class="main">
    <div class="MainCon">
		<ul class="viewTab">
	<li>
	<a href="<?php echo FRONTEND_URL;?>review_details" <?php if(currentClass() == 'review_details' && currentMethod()=='index'){?>class="active"<?php } ?>>All Reviews</a>
	</li>
	<li>
	<a href="<?php echo FRONTEND_URL;?>review_details/pending" <?php if(currentClass() == 'review_details' && currentMethod()=='pending'){?>class="active"<?php } ?>>Pending Reviews</a>
	</li>
	<li>
	<a href="<?php echo FRONTEND_URL;?>review_details/past" <?php if(currentClass() == 'review_details' && currentMethod()=='past'){?>class="active"<?php } ?>>Past Reviews</a>
	</li>
</ul>
<?php if($succMsg!='') {?>
<div class="alert alert-success display-show" ><?php echo $succMsg; ?></div>
<?php } ?>
<div class="detail-bar">
		<table id="no-more-tables" width="100%" height="100px" cellpadding="" cellspecing="" border="" class="confPayment">

		<thead>
		<tr>
		<th>Image</th>
		<th>Property Name</th>
		<th>City Name</th>
		<th>Check In</th>
		<th>Check Out</th>
		<th>Total Night</th>
		<?php if(currentMethod() != 'past') {?>
		<th>Action</th>
		<?php }?>
		</tr>
		</thead>
		<tbody>
		<?php   
		  
		if(is_array($review ) && count($review )>0){
			foreach ($review as $value) {
				
				$date1=date_create($value['check_in']);
				$date2=date_create($value['check_out']);
				
				//echo $date1."==".$date2;
				$diff=date_diff($date1,$date2);
				$total_days = $diff->d;

		?>
		<tr>
		<td data-title="Image"><img src="<?php echo isFileExist(CDN_PROPERTY_SMALL_IMG.$value['image_name']) ; ?>"  width="200" height="150"></td>
		<td data-title="Property Name"><?php echo stripslashes($value['property_name']); ?></td>
		<td data-title="City Name"><?php echo stripslashes($value['city_name']);?></td>
		<td data-title="Check In"><?php echo date('d-m-Y',strtotime($value['check_in']));?></td>
		<td data-title="Check Out"><?php echo date('d-m-Y',strtotime($value['check_out']));?></td>
		<td data-title="Total Night"><?php echo $total_days;?> <input type="hidden" value="<?php echo FRONTEND_URL."review_details/submit_review/".$value['paymeny_id']."/".$value['property_id'];?>"></td>
		<?php if(currentMethod() != 'past') {?>
		<td data-title="Action">
			<?php if($value['review_type'] == 'Pending') { ?>
			<a href="<?php echo FRONTEND_URL."review_details/submit_review/".$value['paymeny_id']."/".$value['property_id'];?>">Review</a>
			<?php } ?>
		</td>
		<?php } ?>
		</tr>
		<?php
		} 

		}else{
		?>
		<tr>
			<td colspan="6" align="center"><?php echo '...Record Not Found...'; ?></td>
		</tr> 
		<?php }  ?> 

		</tbody>  

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