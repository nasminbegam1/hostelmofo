<!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>-->
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Custom Booking</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Custom Booking</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<a href="<?php echo $edit_link; ?>" >
Edit Custom Booking</a></li>
      
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
                                        <form name="frmPropertyInformation" id="frm1" enctype="multipart/form-data" class="parsley_reg" method="post" action="<?php echo $action_link; ?>">
					
					<input type="hidden" name="action" value="Process">
					<input type="hidden" name="custom_key" id="custom_key" value="<?php echo $bookingDetails['custom_key']; ?>">
					<input type="hidden" name="property_id" id="property_id" value="<?php echo $bookingDetails['property_id']; ?>">
                                      <div class="col-md-12"><h5> <b>Custom Booking Link : </b><a href="<?php echo FRONTEND_URL.'yourbooking/'.$bookingDetails['custom_key'].'/'; ?>" target="_target"><?php echo FRONTEND_URL.'yourbooking/'.$bookingDetails['custom_key'].'/'; ?></a></h5> </div><br/><br/>
                                                
                                            <div class="panel panel-yellow portlet box portlet-yellow" style="height: 135px;"> 
					     <div class="portlet box portlet-yellow">
						
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
								<input type="text" readonly="readonly" class="form-control" name="property_name" id="property_name" value="<?php echo $bookingDetails['property_name']; ?>">
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Property Title</b>
							    </div>
							    <div class="col-md-6">
								 <input type="text" readonly="readonly" class="form-control" name="page_title" id="page_title" value="<?php echo stripslashes($bookingDetails['page_title']); ?>">
							    </div>
							    
							</div>
						    </div>
						</div>
						<br/><br/>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Location</b>
							    </div>
							    <div class="col-md-6">
								<input type="text" readonly="readonly" class="form-control" name="location_name" id="location_name" value="<?php echo $bookingDetails['location_name']; ?>">
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Property Type</b>
							    </div>
							    <div class="col-md-6">
								<input type="text" readonly="readonly" class="form-control" name="property_type" id="property_type" value="<?php echo $bookingDetails['property_type']; ?>">
							    </div>
							    
							</div>
						    </div>
						</div>
						
					    </div>
					   
					    </div>
					    <div class="panel panel-green portlet box portlet-green"> 
					     <div class="portlet box portlet-green">
						<div class="portlet-header">
						    <div class="caption">Booking Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Customer Email</b>
							    </div>
							    <div class="col-md-6">
								<input type="text" readonly="readonly" class="form-control" data-type="email"  name="customer_email" id="customer_email" value="<?php echo stripslashes($bookingDetails['customer_email']); ?>">
							    </div>
							    
							</div>
						    </div>
						   
						</div>
                                                <br/><br/>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Check-In Date</b>
							    </div>
							    <div class="col-md-6">
								<input readonly="readonly" type="text"  id="checkin" class="form-control" name="checkin" value="<?php echo date('m/d/Y', strtotime($bookingDetails['checkin'])); ?>">
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Check-Out Date</b>
							    </div>
							    <div class="col-md-6">
								<input readonly="readonly" type="text" data-required="true" id="to" class="form-control" name="checkout" value="<?php echo date('m/d/Y', strtotime($bookingDetails['checkout'])); ?>">
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
						    <div class="caption">Pricing Details</div>
						    <div class="tools"><i class="fa fa-chevron-up"></i></div>
						</div>
						<br>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>System Price ( THB )</b>
							    </div>
							    <div class="col-md-6">
								<input type="text" readonly="readonly" class="form-control" data-type="number"  name="systemprice" id="systemprice" value="<?php echo number_format($bookingDetails['systemprice'], 0, '.', ''); ?>">
							    </div>
							    
							</div>
						    </div>
						   <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Discounted Price ( THB )</b><span class="require">*</span>
							    </div>
							    <div class="col-md-6">
								<input type="text" class="form-control required" data-type="number" data-required="true" name="discountprice" id="discountprice" value="<?php echo number_format($bookingDetails['discountprice'], 0, '.', ''); ?>">
							    </div>
							    
							</div>
						    </div>
						</div>
						<br/><br/>
						<div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Discounted Percentage ( % )</b>
							    </div>
							    <div class="col-md-6">
								<input type="text" readonly="readonly" class="form-control" data-type="number"  name="discountpercent" id="discountpercent" value="<?php echo $bookingDetails['discountpercent']; ?>">
							    </div>
							    
							</div>
						    </div>
						</div>
                                                <br/><br/>
                                                <div class="portlet-body pan" >
						    <div class="col-md-12">
							<div class="form-group">
							    <div class="col-md-3">
								<b>Deposit Full Amount </b>
							    </div>
							    <div class="col-md-9">
								
								<input  type="radio" name="status" class="radion_frm_class hideShow" value="yes" id="fullamount" <?php if($bookingDetails['depositstatus'] == 'yes'){ ?> checked="checked" <?php } ?> >
                                                                    <span class="radio_lebel">Yes</span>
							   
                                                                    <input  type="radio"  name="status" id="partialamount"  class="radion_frm_class hideShow" value="no" <?php if($bookingDetails['depositstatus'] == 'no'){ ?> checked="checked" <?php } ?>>
                                                                    <span class="radio_lebel">No</span>
							     </div>
							    
							</div>
						    </div>
						
					    </div>
						
					   <br/><br/>
					    <div class="portlet-body pan" id="depositBox" <?php if($bookingDetails['depositstatus'] == 'yes'){ ?>style="display: none;"<?php } ?>>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Deposit Percentage or Amount</b>
							    </div>
							    <div class="col-md-6">
								<input style="width: 14px;" type="radio" name="dep_percent_amount" class="radion_frm_class" value="amt" id="depamt" <?php if($bookingDetails['dep_percent_amount'] == 'amt'){ ?> checked="checked" <?php } ?> >
								<span  class="radio_lebel">Amount</span>
								<input style="width: 14px;" type="radio"  name="dep_percent_amount" id="depper"  class="radion_frm_class" value="per" <?php if($bookingDetails['dep_percent_amount'] == 'per'){ ?> checked="checked" <?php } ?> >
								<span  class="radio_lebel">Percent</span>
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6" id="payamount" <?php if($bookingDetails['dep_percent_amount'] == 'per'){ ?> style="display: none;" <?php } ?>>
							<div class="form-group">
							    <div class="col-md-6">
								<b>Deposit Amount</b>
							    </div>
							    <div class="col-md-6">
								<input id="depositamount" class="form-control required" data-type="number" data-required="true" type="text" value="<?php echo $bookingDetails['depositamount']; ?>" name="depositamount">
							    </div>
							    
							</div>
						    </div>    
						    <div class="col-md-6" id="paypercent"  <?php if($bookingDetails['dep_percent_amount'] == 'amt'){ ?> style="display: none;" <?php } ?>>
							<div class="form-group">
							    <div class="col-md-6">
								<b>Deposit Percent</b>
							    </div>
							    <div class="col-md-6">
								<input id="depositpercent" class="form-control required" data-type="number" data-required="true" type="text" value="<?php echo $bookingDetails['depositpercent']; ?>" name="depositpercent">
							    </div>
							    
							</div>
						    </div>
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Remainder Payment Due Date</b><span class="require">*</span>
							    </div>
							    <div class="col-md-6 input-daterange">
								<input value="<?php echo date('m/d/Y', strtotime($bookingDetails['payduedate'])); ?>" type="text" id="payduedate" class="form-control required" data-required="true" name="payduedate">
							    </div>
							    
							</div>
						    </div>
							
						    
						
					    </div>
					    
					    <br/><br/>
					    <div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Paypal Rate (In Percent)</b><span class="require">*</span>
							    </div>
							    <div class="col-md-6">
								<input id="paypalrate" class="form-control required" type="text" value="<?php echo $bookingDetails['paypalrate']; ?>" data-type="number" name="paypalrate">
							    </div>
							    
							</div>
						    </div>
						
					    </div>
					    
					    <br/><br/><br/>
					    
					    
					    <div class="portlet-body pan">
						    <div class="col-md-6">
							<div class="form-group">
							    <div class="col-md-6">
								<b>Show Discount</b>
							    </div>
							    <div class="col-md-6">
								
								<input style="width: 14px;" type="radio" name="show_discount" class="radion_frm_class" value="yes" id="show_discount1" <?php if($bookingDetails['show_discount'] == 'yes'){ ?> checked="checked" <?php } ?>>
								<span  class="radio_lebel">Yes</span>
								<input style="width: 14px;" type="radio"  name="show_discount" id="show_discount2"  class="radion_frm_class" value="no" <?php if($bookingDetails['show_discount'] == 'no'){ ?> checked="checked" <?php } ?>>
								<span  class="radio_lebel">No</span>
								
								
								
							    </div>
							    
							</div>
						    </div>
						
					    </div>

						
						
                                          </div>
                                        </div>      
                                                
                             
					     
						
				  
					

				    
				   <div class="save_div_class" style=" padding-bottom: 5px;">
						<button onclick="location.href='<?php echo $return_link; ?>'" class="btn btn-green frm_step_next" type="button" id="btn_property_image_fieldset">Return</button>
						
						<button class="frm_step_next btn btn-primary" type="submit" id="update">Update</button>
                                    </div>
				  
		</form>	    
         </div>
        </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script>
    
    $("#discountprice").blur(function(){
    var discountprice = $("#discountprice").val();
    var systemprice = $("#systemprice").val();
    if ( isNaN(discountprice) ) {
      alert('Only Numeric values are allowed.');
      $("#discountprice").val('');
      $("#discountprice").focus();
      return false;
    }
     if (discountprice == '' || systemprice == '') {     
       alert("Please provide the System price and Discount Price.");
       return false;
     } else {
	if ( parseFloat(discountprice) > parseFloat(systemprice) ) {
	 alert('Discount Amount is greater than System Price.');
	 $("#discountprice").val('');
	 $("#discountprice").focus();
	 return false;
	}
	discount = ( ((systemprice - discountprice) * 100 ) / systemprice );
	discount1 = discount.toFixed(2);
	$("#discountpercent").val(discount1);
	return true;
     }
    
  });  
    
    
    
    $('.hideShow').click(function(){
	
	if ($(this).val() == 'yes') {
	   
	   $("#depositBox").css("display", "none");
	}
	else{
	    $("#depositBox").css("display", "block");	    
	}	
	
    });
    
    $('#depamt').click( function(){ 
		
		//$("#depositpercent").val(''); 
		$('#paypercent').hide();
		$('#payamount').show();
    });
  
  $('#depper').click( function(){ 
		
		//$("#depositamount").val(''); 
		$('#payamount').hide();
		$('#paypercent').show(); 	
  });
  
      $(function(){
       $(".input-daterange #payduedate").datepicker();
    });
  
    $('#partialamount').click( function(){
     $('#depositBox').show();
     //$('.parsley_reg').parsley('addItem', '#payduedate'); 
     $("#payduedate").val('');
     
      var checkout = $("#to").val();
      if (checkout != '') {
	 $(".input-daterange #payduedate").datepicker({
	   changeMonth: true,
	   dateFormat : 'dd/mm/yy',
	   numberOfMonths: 2,	
	   minDate: 0,
	   maxDate: checkout
       });
      }
     
   });
  
  

    
</script>