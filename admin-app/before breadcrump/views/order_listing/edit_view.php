
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Order Details</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-check-square"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Order Details</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-check-square"></i>&nbsp;&nbsp;<a href="<?php echo $edit_url;?>" >
Edit Order</a></li>
      
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                      
                                                
                                            <div class="panel panel-yellow portlet box portlet-yellow"> 
					     <div class="portlet box portlet-yellow">
						
						<div class="portlet-header">
						    <div class="caption">Customer Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Customer Name</b>
							    </div>
							    <div class="col-md-6">
								<?php echo ucfirst($order_details[0]['first_name'])." ".ucfirst($order_details[0]['last_name']);?>
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Customer Email</b>
							    </div>
							    <div class="col-md-6">
								<?php echo ucfirst($order_details[0]['email']);?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Customer Contact Number</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['telephone'];?>
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>House Number</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['house_number'];?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>City</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['city'];?>
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Zip Code</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['zip_code'];?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>State</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['state'];?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<br>
					    </div>
					     
					     
					    </div>
					    <div class="panel panel-green portlet box portlet-green"> 
					     <div class="portlet box portlet-green">
						<div class="portlet-header">
						    <div class="caption">Property Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Property Name</b>
							    </div>
							    <div class="col-md-6">
								<?php echo ucfirst($order_details[0]['property_name']);?>
							    </div>
							    
							</div>
						    </div>
						   
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Check In</b>
							    </div>
							    <div class="col-md-6">
								<?php echo @date("d/m/Y ", strtotime($order_details[0]['check_in']));?>
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Check Out</b>
							    </div>
							    <div class="col-md-6">
								<?php echo @date("d/m/Y ", strtotime($order_details[0]['check_out']));?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<br>
					    </div>

					</div>
					    
					     
					    <div class="panel panel-blue portlet box portlet-blue"> 
					     <div class="portlet box portlet-blue">
						<div class="portlet-header">
						    <div class="caption">Autharized Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Autharized Transaction Id</b>
							    </div>
							    <div class="col-md-6">
								<?php echo stripslashes($order_details[0]['auth_transaction_id']);?>
							    </div>
							    
							</div>
						    </div>
						   <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Autharized Status</b>
							    </div>
							    <div class="col-md-6">
								<?php echo stripslashes($order_details[0]['auth_status']);?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Autharized Amount</b>
							    </div>
							    <div class="col-md-6">
								<?php echo $order_details[0]['currency_symbol']." ".number_format($order_details[0]['auth_amount']);?>
							    </div>
							    
							</div>
						    </div>
						</div>
						<br>
					    </div>

					</div>
					     
					     
						
				    <form name="payment" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL."order_listing/edit/".$order_details[0]['order_id'];?>">
				<input type="hidden" name="action" id="action" value="Process">
					
					    <div class="panel panel-red portlet box portlet-red"> 
					     <div class="portlet box portlet-red">
						<div class="portlet-header">
						    <div class="caption">Capture Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Capture Amount</b>
							    </div>
							    <div class="col-md-6">
								<?php
						$capture_amount = '';
						if($order_details[0]['capture_amount'] == '0.00' || $order_details[0]['capture_amount'] == ''){
								$capture_amount = '';
						}
						else
						{
								$capture_amount = $order_details[0]['capture_amount'];
						}
						?>
						<span class="orderField"><em class="currSymbol"><?php echo $order_details[0]['currency_symbol'];?></em><input type="text" name="capture_amount" id="capture_amount" value="<?php echo $capture_amount;?>" data-required="true" class="form-control"></span>
								
							    </div>
							    
							</div>
						    </div>
						   <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Capture Status</b>
							    </div>
							    <div class="col-md-6">
								
								<select name="capture_status" id="capture_status" data-required="true" class="form-control " >
							<option value="Success" <?php if($order_details[0]['capture_status'] == 'Success') echo "Selected";?>>Success</option>	
							<option value="Failure" <?php if($order_details[0]['capture_status'] == 'Failure') echo "Selected";?>>Failure</option>
							<option value="Pending" <?php if($order_details[0]['capture_status'] == 'Pending') echo "Selected";?>>Pending</option>
						</select>
							    </div>
							    
							</div>
						    </div>
						</div>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Capture Date</b>
							    </div>
							    <div class="col-md-6">
								<?php
						$capture_date = '';
						if($order_details[0]['capture_date'] == '0000-00-00 00:00:00' || $order_details[0]['capture_date'] == ''){
						$capture_date = '';		
						}
						else
						{
							$capture_date =  @date("d/m/Y ", strtotime($order_details[0]['capture_date']));	
						}
						?>
						<div class="col-md-8 input-daterange">
                          <input type="text" name="startdate" id="startdate" class="form-control" value="<?php echo $capture_date ?>" readonly/>
                        </div>
						<!--<input readonly value="<?php //echo $capture_date;?>" type="text" data-required="true" class="season_start_date form-controltwo required rental_end_date date_end_0" name="capture_date" id="capture_date" title="date_end_0">-->
							    </div>
							    
							</div>
						    </div>
						</div>
						<br>
					    </div>

					</div>

				    
				   <div class="save_div_class" style=" padding-bottom: 5px;">
						<button onclick="location.href='<?php echo $base_url; ?>'" class="btn btn-green frm_step_next" type="button" id="btn_property_image_fieldset">Return</button>
						
						<button class="frm_step_next btn btn-primary" type="submit" id="update">Update</button>
                                        </div>
				   </form>
				    </div>
                            </div>
         </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script>

    $(function(){
       $(".input-daterange #startdate").datepicker();
       $(".input-daterange #enddate").datepicker({
          defaultDate:$(".input-daterange #startdate").val()
        });
    });

		
		$( "#update" ).click(function() {
				$('#frm1').submit();		
		});
</script>