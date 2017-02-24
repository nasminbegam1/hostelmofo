<div class="page-content">
<?=$property_header?>
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Booking</h3>

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
	  
	  <div class="clearfix"></div>
	  <div class="row">
	    <div class="col-sm-12">
		<div class="portlet box blue">
		      <div class="portlet-title">
			     
		      </div>	

<!-- ***************************************Arrival Today**************************************************************************-->



		    <div class="portlet-body">
			
			<?=$tabs?>
			    <table id="resp_table" class="table table-striped table-hover table-bordered">
			    <thead>
				  <tr>
				    <h4><strong>Arrival Today</strong></h4>
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
				<tfoot>
			      <tr>
				<td colspan="8">                      
			     
				
				  </td>
			      </tr>
			    </tfoot>
			    <tbody>
				<?php
				//pr($arrival_list);
				 if(is_array($arrival_list['todayArrival']) && count($arrival_list['todayArrival'])){
					foreach($arrival_list['todayArrival'] as $key=>$arrival_list_array){
						$viewLink = str_replace("{{ID}}",$arrival_list_array['paymeny_id'],$view_link);
						$dealLink = str_replace("{{ID}}",$arrival_list_array['payment_id'],$deal_link);
						$chkindate  = strtotime($arrival_list_array['check_in']);
						$chkoutdate = strtotime($arrival_list_array['check_out']);					
						$timeDiff = abs($chkindate - $chkoutdate);					
						$numberDays = $timeDiff/86400;
						$nights = intval($numberDays);
						
						
						
					?>
						<tr>
							<td><?php echo $arrival_list_array['paymentRefNo'];?></td>
							<td><?php echo $arrival_list_array['first_name'].' '.$arrival_list_array['last_name'];?></td>
							<td><?php echo  date('d M', strtotime($arrival_list_array['check_in'])); ?></td>
							<td><?php echo $nights;?></td>
							<td><?php echo $arrival_list_array['no_of_person']; ?></td>
							<td><?php echo $arrival_list_array['gen']; ?></td>
							<td><?php echo $arrival_list_array['bookingType']; ?></td>
							<td>

								<?php if($arrival_list_array['bookingType']=='deal'){ ?>
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

<!-- ***************************************Arrival Tomorrow**************************************************************************-->
				<div class="portlet-body">
			
			
			    <table id="resp_table" class="table table-striped table-hover table-bordered">
			    <thead>
				  <tr>
				     <h4><strong>Arrival Tomorrow</strong></h4>
				    <th data-hide="phone,tablet">Reference</th>
				    <th data-hide="phone,tablet">Name</th>
				    <th data-hide="phone,tablet">Arriving</th>
				    <th data-hide="phone,tablet">Nights</th>
				    <th data-hide="phone,tablet">Guests</th>
				     <th data-hide="phone,tablet">Category</th>
				    <th>Actions</th>
				    
				  </tr>
				</thead>
				<tfoot>
			      <tr>
				<td colspan="8">                      
			     
				
				  </td>
			      </tr>
			    </tfoot>
			    <tbody>
				<?php
				//pr($arrival_list);
				 if(is_array($arrival_list['tomorrowDate']) && count($arrival_list['tomorrowDate'])){
					foreach($arrival_list['tomorrowDate'] as $key=>$arrival_list_array){
						$viewLink = str_replace("{{ID}}",$arrival_list_array['payment_id'],$view_link);
						
						$chkindate  = strtotime($arrival_list_array['check_in']);
						$chkoutdate = strtotime($arrival_list_array['check_out']);					
						$timeDiff = abs($chkindate - $chkoutdate);					
						$numberDays = $timeDiff/86400;
						$nights = intval($numberDays);
						
						
						
					?>
						<tr>
							<td><?php echo $arrival_list_array['paymentRefNo'];?></td>
							<td><?php echo $arrival_list_array['first_name'].' '.$arrival_list_array['last_name'];?></td>
							<td><?php echo  date('d M', strtotime($arrival_list_array['check_in'])); ?></td>
							<td><?php echo $nights;?></td>
							<td><?php echo $arrival_list_array['no_of_person']; ?></td>
							<td><?php echo $arrival_list_array['bookingType']; ?></td>
							<td>
								<?php if($arrival_list_array['bookingType']=='deal'){ ?>
								<a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $dealLink; ?>','','width=600, height=350');" >                                
								<i class="glyphicon glyphicon-eye-open"></i>
								</a>

								<?php }else { ?><a class="various3 previewLinkBtn changeStatus btn btn-green" onclick="window.open('<?php echo $viewLink; ?>','','width=600, height=350');" >                                
								<i class="glyphicon glyphicon-eye-open"></i>
								</a><?php } ?>  
							</td>
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