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
			  Salon Details</h3>
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
				
									<div class="portlet box blue">
										<div class="portlet-title">
											<div class="caption">Salon- <?php echo $getSingle['salon_name']?></div>
										</div>
										<div class="portlet-body form">
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													<h3 class="form-section">Details</h3>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Salon Name:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['salon_name']?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Email:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['email']?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Business Name:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['business_reg_number']?>
																	</p>
																</div>
															</div>
														</div>
														
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Phone No.:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['telephone_no']?>
																	</p>
																</div>
															</div>
														</div>
													</div>
													<!--/row-->
													<div class="row">
														<!--/span-->
<!--														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Country:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php //echo $getSingle['currency_code']?>
																	</p>
																</div>
															</div>
														</div>
-->														<!--/span-->														
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Currency code:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['currency_code']?>
																	</p>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">App. Prefix:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['appointment_prefix']?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->														
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Date of Join:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo date('jS M, Y', strtotime($getSingle['created_at']))?>
																	</p>
																</div>
															</div>
														</div>

													</div>







													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Activated on:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo date('jS M, Y', strtotime($getSingle['activated_at']))?>
																	</p>
																</div>
															</div>
														</div>														
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Expiry date:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo date('jS M, Y', strtotime($getSingle['expiry_date']))?>
																	</p>
																</div>
															</div>
														</div>																										
													</div>
													
													
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Current Plan:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?php if(count($getSingle['ORDERS'])){?>
																		<?php echo $getSingle['ORDERS']['plan_name'];?>
																		<?php }else{?>
																		 Free User
																		<?php }?>
																	</p>
																</div>
															</div>
														</div>														
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Status:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $getSingle['salon_status']?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Logo:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?php $logo = FILE_UPLOAD_URL.'product/salonlogo/thumbs/'.$getSingle['logo'];
																		if(@getimagesize($logo)){?>
																		<img src="<?php echo $logo?>"/>
																		<?php }?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->														
													</div>
													<h3 class="form-section">Address</h3>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-2"></label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		  <?php echo $getSingle['address']?>
																	</p>
																</div>
															</div>
														</div>

													</div>
													
												</div>
												<div class="form-actions">
													<div class="row">
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-offset-3 col-md-9">
																	 <button class="btn blue" type="button" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
																</div>
															</div>
														</div>
														<div class="col-md-6">
														</div>
													</div>
												</div>
											</form>
											<!-- END FORM-->
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