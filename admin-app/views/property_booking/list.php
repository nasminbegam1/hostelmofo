<div class="page-content">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					 Widget settings form goes here
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue">Save changes</button>
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Booking</h3>
<?php //if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>

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
		<div class="portlet box">
		    <div class="portlet-body">
			<form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo $base_url;?>">
			    <div class="row">
				<div class="col-sm-4">
				  <div class="input-group">
				      <label for="table_search">Booking Search Panel:</label>
				      <input type="text" id="search_keyword" name="search_keyword" class="form-control" value="<?php echo $search_keyword; ?>">
				    </div>
				</div>                        
				<div class="col-sm-3">
				    <div class="input-group">
				    <label for="table_search">&nbsp;</label><br/>
				    <input class="btn btn-default" type="submit" name="btn_submit" id="btn_submit" value="Search" />
				    <button class="btn btn-default" name="btn_show_all" id="btn_show_all">Show All</button> 
				    </div>
				</div>
				<div class="col-sm-4 ">
				    <label for="un_member">Enties Per Page:</label>
				    <select name="per_page" id="per_page" class="form-control">
					<option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
					<option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
					<option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
					<option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
					<option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
					<option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
					<option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
					<option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option>
				    </select>
				</div>
			    </div>
			</form>
		    </div>
		    
		</div>
	    </div>
	</div>

				      
	  
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
				    
				    <th data-hide="phone,tablet">Name</th>
				    <th data-hide="phone,tablet">Email</th>
				    <th data-hide="phone,tablet">Amount</th>
				    <th data-hide="phone,tablet">Arriving</th>
				    <th data-hide="phone,tablet">Booking on</th>
				    <th>Nights</th>
				    <th data-hide="phone,tablet">Payment Status</th>
				    <th>Actions</th>
				    
				  </tr>
				</thead>
				<tfoot>
			      <tr>
				<td colspan="8">                      
			      <?php
			      $show_to_record 	= $startRecord + $per_page;
			      $to_record		= $show_to_record;
			      if($show_to_record > $totalRecord) {
				    $to_record = $totalRecord;
			      }
			      ?>
				<div class="footerPagination"> <span class="showRecCount">Showing <?php echo $to_record != 0? $startRecord+1:0; ?> to <?php echo $to_record; ?> of <?php echo $totalRecord; ?> entries</span> <?php echo $this->pagination->create_links();?> </div>
				  </td>
			      </tr>
			    </tfoot>
			    <tbody>
				<?php
				
				 if(is_array($bookings) && count($bookings)){
					foreach($bookings as $key=>$booking){
						$viewLink = str_replace("{{ID}}",$booking['payment_id'],$view_link);
						$deleteLink = str_replace("{{ID}}",$booking['payment_id'],$delete_link);
						
						$chkindate  = strtotime($booking['check_in']);
						$chkoutdate = strtotime($booking['check_out']);					
						$timeDiff = abs($chkindate - $chkoutdate);					
						$numberDays = $timeDiff/86400;
						$nights = intval($numberDays);
						
						
						
					?>
						<tr>
							
							<td><?php echo $booking['first_name'].' '.$booking['last_name'];?></td>
							
							<td><?php echo $booking['email']; ?></td>
							<td><?php echo $booking['total_price']; ?></td>
							<td><?php echo  date('d/m/Y', strtotime($booking['check_in'])); ?></td>
							<td><?php echo  date('d/m/Y', strtotime($booking['added_date'])); ?></td>
							<td><?php echo $nights;?></td>
							<td><?php echo $booking['payment_status']; ?></td>
							<td>
								<a class="various3 previewLinkBtn changeStatus btn btn-green" href="<?php echo $viewLink;?>">                                
									<i class="glyphicon glyphicon-eye-open"></i>
							        </a>
								
								<?php
								if($book_type == '')
								{
								$cancelLink = str_replace("{{ID}}",$booking['payment_id'],$cancel_link);
								?>
								
								<a onclick="return confirm('Cancel the Booking!');" class="various3 previewLinkBtn changeStatus btn btn-green" href="<?php echo $cancelLink;?>">                                
									<i class="glyphicon glyphicon-remove-sign"></i>
							        </a>
								<?php
								}
								?>
			      
								<!--<a class="various3 previewLinkBtn changeStatus btn btn-red " onclick="javascript:return confirm('Are you sure?')" href="<?php echo $deleteLink;?>">
									<i class="glyphicon glyphicon-trash"></i>
								</a>-->
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