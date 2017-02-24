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
			  My Profile</h3>
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
						 <div class="caption-subject font-gray-sunglo bold uppercase"><h4>Profile Details</h4></div>
						</div>
						<div class="portlet-body form">
						    <!--<form method="post" action="" class="main form-horizontal" enctype="multipart/form-data" id="parsley_reg">-->
						<form method="post" action="" class="main form-horizontal" enctype="multipart/form-data">	
						    <input type="hidden" name="action" value="Process">
						    <input type="hidden" name="agent_id" value="<?php echo $agent_details->agent_id;?>">
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">First Name: <span class="required" aria-required="true"> *</span></label>
							
							<div class="col-md-6">
							<input type="text" name="firstname" class="form-control" value="<?php echo stripslashes($agent_details->firstname);?>" />
							</div>
						    </div>
						      <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Last Name: <span class="required" aria-required="true"> *</span></label>
							
							<div class="col-md-6">
							<input type="text" name="lastname" class="form-control" value="<?php echo stripslashes($agent_details->lastname);?>" />
							</div>
						    </div>
						      <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Email Id: <span class="required" aria-required="true"> *</span></label>
							
							<div class="col-md-6">
							<input type="text" name="email" class="form-control" value="<?php echo stripslashes($agent_details->email);?>" />
							</div>
						    </div>
						      <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Current Password: </label>
							
							<div class="col-md-6">
							<input type="password" name="current_password" class="form-control" value="" />
							</div>
						    </div>
						      <div class="clearfix"></div>						      
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Password: </label>
							
							<div class="col-md-6">
							<input type="password" name="password" class="form-control" value="" />
							<div>Passwords should be 8 or more characters and should contain at least 1 uppercase letter, 1 lowercase letter, a number</div>
							</div>
						    </div>
						      <div class="clearfix"></div>
						    <div class="form-group">
							<label for="reg_input_name" class="col-md-3 control-label">Confirm Password: </label>
							
							<div class="col-md-6">
							<input type="password" name="confirm_password" class="form-control" value="" />
							</div>
						    </div>
						      <div class="clearfix"></div>						      
												      

						    <div class="clearfix"></div>
						    <br/>
						   <div class="form-actions flud ">
						      <div class="row">
							<div class="col-md-offset-3 col-md-4">
							    <button class="btn green" type="submit">Save</button>
							    <button class="btn blue" type="button" onclick="location.href='<?php echo base_url(); ?>'">Return</button>
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