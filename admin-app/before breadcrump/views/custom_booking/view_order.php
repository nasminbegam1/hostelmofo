<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                   <!-- <div class="page-title">View Enquiry</div>-->
                </div>
                   <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Custom Booking Order</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<a href="<?php echo $view_url;?>" >
View Booking Order</a></li>
      
    </ol>
                <div class="clearfix"></div>
</div>



<div class="page-content">
<div id="form-layouts" class="row">
                    <div class="col-lg-12">
                       
                    <div >

                    </div>
                    </div>
                   
                    <div class="col-lg-12">
                             
                       

<div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            <div id="tab-form-bordered" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-lg-12">
                                             
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">View Booking Order Details</div>
                                            <div class="panel-body pan">
                                                <form action="#" class="form-horizontal form-bordered">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Property Name</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                               <h5><?php echo stripslashes($order_details[0]['property_name']); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLastName" class="col-md-3 control-label"><h5><b>Optional Title</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><?php echo stripslashes($order_details[0]['optional_title']); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail" class="col-md-3 control-label"><h5><b>Customer Email</b></h5></label>

                                                            <div class="col-md-8">
                                                               <h5><?php echo stripslashes($order_details[0]['customer_email']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="selGender" class="col-md-3 control-label"><h5><b>Check IN Date</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><?php echo stripslashes($order_details[0]['checkin']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputBirthday" class="col-md-3 control-label"><h5><b>Check OUT Date</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><?php echo stripslashes($order_details[0]['checkout']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputPhone" class="col-md-3 control-label"><h5><b>System Price</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5> <?php echo stripslashes($order_details[0]['systemprice']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress1" class="col-md-3 control-label"><h5><b>Discount Price</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><?php echo stripslashes($order_details[0]['discountprice']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress2" class="col-md-3 control-label"><h5><b>Discount Percentage</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><?php echo number_format(stripslashes($order_details[0]['discountpercent']));?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Deposit Amount</b></h5></label>

                                                            <div class="col-md-8">
                                                               <h5><?php echo stripslashes($order_details[0]['depositamount']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputCity" class="col-md-3 control-label"><h5><b>Deposit Percentage</b></h5></label>

                                                            <div class="col-md-9">
                                                                
                                                                 <h5><?php echo stripslashes($order_details[0]['depositpercent']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Deposit Status</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                 <h5><?php echo ucfirst(stripslashes($order_details[0]['depositstatus']));?></h5>
                                                            </div>
                                                            
                                                        </div>
							
							<div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Payment Due Date</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                 <h5><?php echo stripslashes($order_details[0]['payduedate']);?></h5>
                                                            </div>
                                                            
                                                        </div>
							
							<div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Paypal Rate</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                 <h5><?php echo stripslashes($order_details[0]['paypalrate']);?></h5>
                                                            </div>
                                                            
                                                        </div>
							
							
							<div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Custom Key</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                 <h5><?php echo stripslashes($order_details[0]['custom_key']);?></h5>
                                                            </div>
                                                            
                                                        </div>
							
                                                        
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <!--<button type="submit" class="btn btn-primary">Submit</button>
                                                        &nbsp;-->
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
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
</div>