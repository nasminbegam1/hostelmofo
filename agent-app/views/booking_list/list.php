<div class="page-content">
	
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Booking</h3>
<?=$property_header?>
    <!-- END PAGE HEADER-->
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
	  <div class="row">
	    <div class="col-sm-12">
		<div class="portlet box blue">
		      <div class="portlet-title">
			      <div class="caption"> Booking</div>
		      </div>						
		    <div class="portlet-body">
			
			<?=$tabs?>
			    <table id="resp_table" class="table table-striped table-hover table-bordered">
			    <thead>
				  <tr>
				    <th width="2%">Late</th>
				    <th data-hide="phone,tablet">Reference</th>
				    <th data-hide="phone,tablet">Card Type</th>
				    <th data-hide="phone,tablet">Name</th>
				    <th data-hide="phone,tablet">Arriving</th>
				    <th data-hide="phone,tablet">Night</th>
				    <th data-hide="phone,tablet">Guests</th>
					 <th data-hide="phone,tablet">Gender</th>
				    <th data-hide="phone,tablet">category</th>
				  </tr>
				</thead>
				<tfoot>
			      <tr>
			      </tr>
			    </tfoot>
			    <tbody>
				<?php
				
				 if(is_array($bookings_list) && count($bookings_list)){
					foreach($bookings_list as $key=>$booking){
						$viewLink = str_replace("{{ID}}",$booking['payment_id'],$view_link);
						$dealLink = str_replace("{{ID}}",$booking['payment_id'],$deal_link);


						$deleteLink = str_replace("{{ID}}",$booking['payment_id'],$delete_link);
						
						$chkindate  = strtotime($booking['check_in']);
						$chkoutdate = strtotime($booking['check_out']);					
						$timeDiff = abs($chkindate - $chkoutdate);					
						$numberDays = $timeDiff/86400;
						$nights = intval($numberDays);
						
						
						
					?>
						<tr>
							<td><img src="<?php echo AGENT_IMAGE_PATH.'error.png';?>"></td>
							<td><?php echo $booking['paymentRefNo'];?></td>
							<td><?php echo $booking['card_type']; ?></td>
							<td><?php echo $booking['first_name'].' '.$booking['last_name'];?></td>
							<td><?php echo  date('d M', strtotime($booking['check_in'])); ?></td>
							<td><?php echo $nights;?></td>
							<td><?php echo $booking['no_of_person']; ?></td>
							<td><?php echo $booking['gen']; ?></td>
							<td><?php echo $booking['bookingType']; ?></td>

							<td>

								<?php if($booking['bookingType']=='deal'){ ?>
									


								<a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $dealLink; ?>','','width=600, height=350');document.location.reload(true);">                                
								<i class="glyphicon glyphicon-eye-open"></i>
				       		    </a>

							<?php	   


							 } else {?>	<a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $viewLink; ?>','','width=600, height=350');document.location.reload(true);">                                
									<i class="glyphicon glyphicon-eye-open"></i>
							        </a>
								
								<?php }
								//if($book_type == '')
								//{
								//$cancelLink = str_replace("{{ID}}",$booking['payment_id'],$cancel_link);
								?>
								
								<!--<a onclick="return confirm('Cancel the Booking!');" class="various3 previewLinkBtn changeStatus btn btn-green" href="<?php //echo $cancelLink;?>">                                
									<i class="glyphicon glyphicon-remove-sign"></i>
							        </a>-->
								<?php
								//}
								?>
							</td>
						</tr>
					<?php	
					}//4each
				 }else{
					?>
					<tr><td align="center" colspan="8">You have no new booking at present. When you receive new bookings, they will be listed here.</td></tr>
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

  <script>
  jQuery(document).ready(function() {    
   
 
    $("#per_page").change(function(){
      $(this).parents('form').submit();
      });
    $('#btn_show_all').click(function(){
	$('#search_keyword').val('');
	$(this).parents('form').submit();
     })
  });
  </script>