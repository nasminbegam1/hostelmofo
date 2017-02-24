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
			  Appointment Details</h3>
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
													<h3 class="form-section">Client- <?php echo $records[0]['customer']?></h3>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">App. no.:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo $records[0]['app_no']?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">App. date:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		 <?php echo date('jS M, Y', strtotime($records[0]['app_date']))?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>													
												</div>
												
												
						<div class="portlet box">
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-striped table-hover">
									<thead>
									<tr>
										<th>
											 #
										</th>
										<th>
											 Service Name
										</th>
										<th>
											 Staff Name
										</th>
										<th>
											 Start time
										</th>
										<th>
											 End time
										</th>
										<th>
											 Duration
										</th>										
									</tr>
									</thead>
									<tbody>
									<?php $i=0; foreach($records[0]['services'] as $service){?>	
									<tr>
										<td>
											 <?php echo ++$i;?>
										</td>
										<td>
											 <?php echo $service['service_name']?>
										</td>
										<td>
											 <?php echo $service['staff']?>
										</td>
										<td>
											 <?php echo $service['start_time']?>
										</td>
										<td>
											 <?php echo $service['end_time']?>
										</td>
										<td>
											 <?php echo $service['duration']?>
										</td>										
<!--										<td>
											<span class="label label-sm label-success">
											Approved </span>
										</td>-->
									</tr>
									<?php }?>
									</tbody>
									</table>
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