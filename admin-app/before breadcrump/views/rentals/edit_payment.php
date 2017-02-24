<style type="text/css">
    .rightPan label {
    line-height: 34px;
}
</style>
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_rental/index/"?>">Rental Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Booking</div>
                                <div class="tools">
                                    <!--<i class="fa fa-chevron-up"></i>-->
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <!--<i class="fa fa-times"></i>-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
				    
                                    <?=$tabs?>
				    <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="portlet box portlet-green">
					    <div class="tab-content">
						<form action="<?php echo $action_url;?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
						<input type="hidden" name="action" value="Process">
						<div id="tab1-wizard-custom-circle" class="tab-pane">
						   <!------general section start-->
						  
						   <br />
						
						<div class="panel panel-orange portlet box portlet-orange">
					
							    <div class="portlet-header">
								<div class="caption">Payment Details</div>
								<div class="tools">
								    <i class="fa fa-chevron-up"></i>
								</div>
							    </div>
	
							
							
						<div class="portlet-body panel-body pan">
						
						    <div class="form-body pal">
							
							<div class="col-md-6">
							    <div class="form-group">
								<label for="property_name" class="col-md-4 control-label" >Deposit %</label>
								<div class="col-md-8 input-icon">
								    <i class="fa fa-money"></i>
								    <input name="deposit_percent" id="deposit_percent" value="<?php echo stripslashes( $arr_property_rent['deposit_percent'] )?>" type="text"  class="form-control " />
								</div>
							    </div>
							</div>
						    
						     <div class="col-md-6">
							<div class="form-group">
							    <label for="property_name" class="col-md-4 control-label">Days Pre Deposit Min</label>
							    <div class="col-md-8 input-icon">
								<i class="fa fa-money"></i>
								<input name="deposit_min_days" id="deposit_min_days" value="<?php if(stripslashes( $arr_property_rent['deposit_min_days'] )>0) {echo stripslashes( $arr_property_rent['deposit_min_days'] ); } else { echo "1"; }?>" type="text" class="form-control " />
							    </div>
							</div>
						    </div>
						    
						    <div class="col-md-6">
							<div class="form-group">
							    <label for="property_name" class="col-md-4 control-label">Final Payment Days Arrival</label>
							    <div class="col-md-8 input-icon">
								<i class="fa fa-money"></i>
								<input name="final_payment_days" id="final_payment_days" value="<?php if(stripslashes( $arr_property_rent['final_p_days_before_arrival'] )>0) { echo stripslashes( $arr_property_rent['final_p_days_before_arrival'] ); } else { echo "1"; }?>" type="text"  class="form-control " />
							    </div>
							</div>
						    </div>
						   
						    <div class="col-md-6">
							<div class="form-group">
							    <label for="property_name" class="col-md-4 control-label">Booking Status</label>
							    <div class="col-md-8 input-icon">
								    <select name="booking_status" id="booking_status" class="form-control">
									<option value="Enable" <?php if($arr_property_rent['booking_status']=="Enable")echo "selected";?>>Enable</option>
									<option value="Disable" <?php if($arr_property_rent['booking_status']=="Disable")echo "selected";?>>Disable</option>
								    </select>
							    </div>
							</div>
						    </div>
						    
						    
						    </div>
						    
						   
						</div>
						 
						<!------aminities section end button-next mlm--->
						</div>
						
						 <div class="action text-right">
							<button type="button" name="submit" value="Previous" class="btn btn-info button-previous" onclick="javascript:window.location.href='<?php echo $previous_url; ?>'">
							    <i class="fa fa-arrow-circle-o-left mrx"></i>
							    Previous
							</button>
							<button type="submit" name="submit" value="Next" class="btn btn-info">
							    Next
							    <i class="fa fa-arrow-circle-o-right mlx"></i>
							</button>
						    </div>
						 
						 
						</div>
						
						</form>    
					    </div>
				    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT-->
<script>
       /**** session succ/err msg display *****/
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
</script>       

