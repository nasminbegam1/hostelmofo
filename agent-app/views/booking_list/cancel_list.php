<div class="page-content">
	<?=$property_header?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Booking</h3>

     <?php if(isset($succmsg) && $succmsg != ""){ ?>
      <div align="center">
	<div class="alert alert-success">
	  <p><?php echo stripslashes($succmsg);?></p>
	</div>
      </div>
      <?php } ?>
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
      <div align="center">
	<div class="alert alert-danger">
	  <p><?php echo stripslashes($errmsg);?></p>
	</div>
      </div>
      <?php } ?>
      
	<div class="portlet light">
	  <div class="clearfix"></div>
	  <div class="row">
	    <div class="col-sm-12">
		<div class="portlet box blue">
		      <div class="portlet-title">
			      <div class="caption"><?php echo $book_type;?> Booking</div>
		      </div>						
		    <div class="portlet-body">
			
			<?=$tabs?>
			    <table id="resp_table" class="table table-striped table-hover table-bordered">
			    <thead>
				  <tr>
				    
				    <th data-hide="phone,tablet">Reference</th>
				    <th data-hide="phone,tablet">Name</th>
				    <th data-hide="phone,tablet">Arriving</th>
				    <th data-hide="phone,tablet">Nights</th>
				    <th data-hide="phone,tablet">Guests</th>
					  <th data-hide="phone,tablet">Gender</th>
				    <th data-hide="phone,tablet">Category</th>

				    <th>Actions</th>
				    
				  </tr>
				</thead>
			    <tbody>
				<?php
				//pr($bookings_list);
				 if(is_array($bookings_list) && count($bookings_list)){
					foreach($bookings_list as $booking){
						$viewLink = str_replace("{{ID}}",$booking['payment_id'],$view_link);
						$deleteLink = str_replace("{{ID}}",$booking['payment_id'],$delete_link);
						$dealLink = str_replace("{{ID}}",$booking['payment_id'],$deal_link);

						$chkindate  = strtotime($booking['check_in']);
						$chkoutdate = strtotime($booking['check_out']);					
						$timeDiff = abs($chkindate - $chkoutdate);					
						$numberDays = $timeDiff/86400;
						$nights = intval($numberDays);
						
						
						
					?>
						<tr>
							<td><?php echo $booking['paymentRefNo'];?></td>
							<td><?php echo $booking['first_name'].' '.$booking['last_name'];?></td>
							<td><?php echo  date('jS M, Y', strtotime($booking['check_in'])); ?></td>
							<td><?php echo $nights;?></td>
							<td><?php echo $booking['no_of_room']*$booking['no_of_person']; ?></td>
							<td><?php echo $booking['gen']; ?></td>
							<td><?php echo $booking['bookingType'];?></td>
							<td>
								<?php if($booking['bookingType']=='deal'){ ?>
								<a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $dealLink; ?>','','width=600, height=350');" >                                
								<i class="glyphicon glyphicon-eye-open"></i>
								</a>

								<?php }else { ?><a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $viewLink; ?>','','width=600, height=350');" >                                
								<i class="glyphicon glyphicon-eye-open"></i>
								</a><?php } ?>  
							</td>
						</tr>
					<?php	
					}//4each
				 }else{
					?>
					<tr><td align="center" colspan="8">..::..No records found..::..</td></tr>
					<?php
				 }
				?>	   
			  </tbody>
			</table>
		    </div>
		</div>
	    </div>

	
	</div>
	<!-- BEGIN DASHBOARD STATS -->
	<!-- END DASHBOARD STATS -->
       
</div>
</div>