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
		
		<div class="col-md-9">
			
				 <div class="col-md-3">
                    staff
                    <select name="staff" class="form-control" id="staff">
                        <option value="">All Staff</option>
                        <?php
                        if(is_array($staffs) && count($staffs)){
                            foreach($staffs as $staff){?>
                            <option value="<?php echo $staff['users_id'] ?>"><?php echo $staff['users_first_name'].' '.$staff['users_last_name']; ?></option>
                        <?php }
                        }
                        ?>
                    </select>
                </div>
				  <div class="col-md-3">
                    From
                    <input id="start_date" name="start_date" type="text" value="<?php echo date('m/01/Y'); ?>"  class="form-control datepicker" readonly>
                </div>
                 <div class="col-md-3">
                    To
                    <input id="end_date" name="end_date" type="text" value="<?php echo date('m/t/Y'); ?>" class="form-control datepicker" readonly>
                 </div>
			
			  <div class="col-md-2" style="padding-top: 20px;">
<input id="btn_search" class="btn btn-default blue" type="submit" name="btn_search" value="View">
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
								<th>product_name</th>
								<th>qty</th>
								<th>unit_cost_price</th> 
								<th>unit_sales_price</th>
								<th>total_gross_value</th>
								<th>net_profit</th>
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
							    
							  
						      </tr>
						      <?php } }  else {  ?>
							  <tr><td colspan="6" align="center">..::..No records found..::..</td></tr>
							           
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

$('.datepicker').datepicker({autoclose:true});
  });
  </script>