<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
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
			  <h3 class="page-title">
			  Salon Settings</h3>
			  <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
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
				
				  <div class="portlet light bordered">
					<div class="row">
					    <div class="col-sm-12">
						<div class="portlet-title">
						 <div class="caption-subject font-gray-sunglo bold uppercase"><h4>Salon Settings</h4></div>
						</div>
						<div class="portlet-body form">
						    <form method="post" action="" class="main form-horizontal" enctype="multipart/form-data" id="parsley_reg">
						    <input type="hidden" name="action" value="Process">
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Salon Name: </label>
							
							<div class="col-md-6">
							<input type="text" name="salon_name" class="form-control" value="<?php echo $salon_name;?>" />
							</div>
						    </div>
						    <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="req col-md-3 control-label">Is Team</label>
							<div class="col-md-6">
								<select class="form-control" name="is_team">
									<option value="yes" <?php echo ($salon_status=='yes')? "selected='selected'":''?>>Yes</option>
									<option value="no" <?php echo ($salon_status=='no')? "selected='selected'":''?>>No</option>
								</select>
							</div>
						    </div>						    
						      <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="req col-md-3 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control" name="salon_status">
									<option value="pending" <?php echo ($salon_status=='pending')? "selected='selected'":''?>>Pending</option>
									<option value="approved" <?php echo ($salon_status=='approved')? "selected='selected'":''?>>Approved</option>
									<option value="disapproved" <?php echo ($salon_status=='disapproved')? "selected='selected'":''?>>Disapproved</option>
									<option value="expired" <?php echo ($salon_status=='expired')? "selected='selected'":''?>>Expired</option>
								</select>
							</div>
						    </div>
						      
						      <div class="clearfix"></div>
						   <div class="form-actions flud ">
						      <div class="row">
							<div class="col-md-offset-3 col-md-4">
							    <button class="btn green" type="submit">Edit Settings</button>
							    <button class="btn blue" type="button" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
							</div>
						      </div>
						    </div>
						</form>
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

     
  });
  </script>