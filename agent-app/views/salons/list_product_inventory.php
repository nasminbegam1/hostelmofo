<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			  <div class="page-content">
				  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				  <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								  <h4 class="modal-title"></h4>
							  </div>
							  <div class="modal-body">
								 
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
			  <h3 class="page-title">
			  Salon Reports</h3>
			
				<form class="form-horizontal" role="form" method="post">
					<input type="hidden" name="action" value="Process">
												<div class="form-body">
													
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Select Date:</label>
																<div class="col-md-9">
																	
		<div class="col-md-3">																 <input id="filter_month" type="text" class="form-control date-picker" readonly name="filter_month" value="<?php echo date('m-Y'); ?>">
		</div>
		<div class="col-md-3">															 <input type="submit" class="btn btn-default blue" value="Select Date" id="btn_search" name="btn_search">
		</div>
																</div>
															</div>
														</div>
													</div>
													</div>
				</form>
				<?php //pr($record);?>
								    <div class="row">
				      <div class="col-sm-12">
					  <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">Salon- <?php echo $getSingle['salon_name']?></div>
						</div>						
					      <div class="portlet-body">
						      <table id="resp_table" class="table table-striped table-hover table-bordered">
						      <thead>
							    <tr>
							      <tr>
								<th>Product Name</th>
								<th>Carried From<br>Previous Month</th>
								<th>Purchased Product</th> 
								<th>Subtracted Product</th>
								<th>Used Consumable<br>Material</th>
								<th>Sold Product</th>
								<th>Remaining Products</th> 
							    </tr>
							    </tr>
							  </thead>
								     
						      <tbody>
							  <?php
							  
							  if(isset($record) && is_array($record) && count($record) > 0){
										    
							  foreach($record as $record_details){
							      
							  ?>
						      <tr>
							      
							  <td><?php echo stripslashes($record_details[0]);?></td>
							  <td><?php echo stripslashes($record_details[1]);?></td>
							   <td><?php echo stripslashes($record_details[2]);?></td>
							    <td><?php echo stripslashes($record_details[3]);?></td>
							     <td><?php echo stripslashes($record_details[4]);?></td>
							      <td><?php echo stripslashes($record_details[5]);?></td>
							      <td><?php echo stripslashes($record_details[6]);?></td>
							  
						      </tr>
						      <?php } }  else {  ?>
							  <tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
							           
						      <?php } ?>
						    </tbody>
			      
						      
						      
						      </table>
						      
			  			     
					      </div>
					  </div>
				      </div>				  
				  </div>
				  </div>
				  <!-- END DASHBOARD STATS -->
				 
			  </div>
  <script>
  jQuery(document).ready(function() {    
   
 
    $("#per_page").change(function(){
      $(this).parents('form').submit();
      });

     $('.date-picker').monthpicker({
            pattern: 'mm-yyyy',
            //monthNames:  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],    
            startYear: new Date().getFullYear()-3,
            finalYear: new Date().getFullYear()
        }); 
  });
  </script>