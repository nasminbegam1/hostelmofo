<?php //pr($arr_property_rent,1);?>
<? if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="main_content_outer" class="clearfix">
<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<script src="<?php echo BACKEND_JS_PATH; ?>lib/iCheck/jquery.icheck.min.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH;?>todc-bootstrap.min.css">

<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
	<?php } ?>
	<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
	<?php }
	//pr($arr_property_rent);
	?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
		    <?= $tabs; ?>
                    <?php $page = $this->uri->segment(4,0); ?>
                   <!-- <ul class="property_tab">
                        <li ><a class="no-cache-redirect" id="property_information_div" href="<?php echo BACKEND_URL;?>rentals/edit_property/<?php echo $arr_property['property_id'].'/'.$page;?>/" class="property_menu ">Rental Property Details</a></li>
                        <li><a  href="<?php echo BACKEND_URL;?>rentals/season_prices/<?php echo $arr_property['property_id'].'/'.$page;?>">Rental Prices</a></li>
                        
                        <li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_property_image/<?php echo $arr_property['property_id'].'/'.$page;?>">Property Images</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/contact/<?php echo $arr_property['property_id'].'/'.$page;?>/">Contact</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/ical_import/<?php echo $arr_property['property_id'].'/'.$page;?>/">Availability</a></li>
			<li  class="active" ><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/payment/<?php echo $arr_property['property_id'].'/'.$page;?>/">Booking</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/edit_map_location/<?php echo $arr_property['property_id'].'/'. $page;?>/">Map Location</a></li>
		    </ul>-->
                    <div class="clear"></div>
			    
                    		<div id="property_information_fieldset" class="property_tag_class">
				<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>rentals/payment/<?php echo $arr_property['property_id'].'/'.$page; ?>/">
				<input type="hidden" name="action" value="Process">
				
				<fieldset>

                                <div class="row basic_info">
                                    <div class="col-sm-12">
					<div class="section-one panel panel-default panelOne" >
					    <div class="panel-heading">
						 <h2 class="panel-title"><strong>Payment Details</strong> </h2>
					    </div>

					    <div class="col-sm-6">
						<label for="property_name" >Deposit %
						    <span class="label label-info  hint--right hint--info" data-hint="  The % of final price required to book the property "><strong>?</strong></span>
						</label>
						<input name="deposit_percent" id="deposit_percent" value="<?php echo stripslashes( $arr_property_rent['deposit_percent'] )?>" type="text"  class="form-control " />
					    </div>
					    <br class="spacer" />
					     <div class="col-sm-6">
						<label for="property_name" >Days Pre Deposit Min
						    <span class="label label-info  hint--right hint--info" data-hint=" The minimum days before arrival that booking by deposit is allowed "><strong>?</strong></span>
						</label>
					        <input name="deposit_min_days" id="deposit_min_days" value="<?php if(stripslashes( $arr_property_rent['deposit_min_days'] )>0) {echo stripslashes( $arr_property_rent['deposit_min_days'] ); } else { echo "1"; }?>" type="text" class="form-control " />
					    </div>
					    <br class="spacer" />
					    <div class="col-sm-6">
						<label for="property_name" >Final Payment Days Arrival
						    <span class="label label-info  hint--right hint--info" data-hint="The number of days before arrival where final payment is needed"><strong>?</strong></span>
						</label>
						<input name="final_payment_days" id="final_payment_days" value="<?php if(stripslashes( $arr_property_rent['final_p_days_before_arrival'] )>0) { echo stripslashes( $arr_property_rent['final_p_days_before_arrival'] ); } else { echo "1"; }?>" type="text"  class="form-control " />
					    </div>
					    <br class="spacer" />
					    <div class="col-sm-6">
						<label for="property_name" >Booking Status
						    <span class="label label-info  hint--right hint--info" data-hint="Enable or Disable"><strong>?</strong></span>
						</label>
						<select name="booking_status" id="booking_status" class="form-control">
						    <option value="Enable" <?php if($arr_property_rent['booking_status']=="Enable")echo "selected";?>>Enable</option>
						    <option value="Disable" <?php if($arr_property_rent['booking_status']=="Disable")echo "selected";?>>Disable</option>
						</select>
					    </div>
					    <br class="spacer" />
					    <br class="spacer" />
					    
					     <div class="save_div_class">
						<input type="hidden" autocomplete='off' name="frontend_url" id="frontend_url" value="<?php echo FRONTEND_URL; ?>" />
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset">Save & Continue</button>
						 <a class="btn btn-default frm_step_next no-cache-redirect" href="<?php echo BACKEND_URL.'rentals/ical_import/'.$arr_property['property_id'].'/'.$page;  ?>/" > < Back</a>
					    </div>

					</div> <!-- Section One -->
					
                                        
                                    </div>
				</div>
                                
                                </fieldset>
				</form>
				</div>			</div>
                            
                            
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
			</div>
                        </div>	
            		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
<script>

var backend_url		= '<?php echo BACKEND_URL;?>';
var frontend_url	= '<?php echo FRONTEND_URL;?>';

var i	=	1;
var j	=	1;

$('#review_map').click(function(){
    var lat = $('#latitude').val();
    var lon = $('#longitude').val();
    if(lat != '' && lon != '')
    {
	$('#review_map').attr("href", "https://maps.google.com/maps?q=" + lat + "," + lon);
    }
    else
    {
	alert('You have to fill up both Latitude and Longitude');
	$('#review_map').attr("href", "#");
	return false;
    }
});

$(window).load(function(){
    $("#completion_date").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: 'dd/mm/yy'
    });
});
</script>

<script>
    $('#seo_title').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#seo_title_count').text(len);
	if(len>68){
	    $(this).val(value.substring(0,69));
	}
    });
    
    $('#meta_description').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#meta_description_count').text(len);
	if(len>154){
	    $(this).val(value.substring(0,155));
	}
    });
    
    $('#special_offer_title').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#special_offer_title_count').text(len);
	if(len>17){
	    $(this).val(value.substring(0,18));
	}
    });
    
    $('#special_offer_text').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#special_offer_text_count').text(len);
	if(len>49){
	    $(this).val(value.substring(0,50));
	}
    });
    
$(window).load(function(){
    check_if_no_record();

  });
/*** If record not found **/
function check_if_no_record(){
   var record = $("#uploadPictures").html();
   if ($.trim(record).length == 0 ) {
       $(".no-record-hide").hide();
   }else{
       $(".no-record-hide").show();
   }
}

$(document).ready(function() {
    
    $('.amenity_class').each(function(){
	
	if($(this).val() == 'active')
	{
	    $(this).removeClass('redText');
	    $(this).removeClass('blueText');
	    $(this).addClass('greenText');
	}
	else if($(this).val() == 'inactive')
	{
	    $(this).removeClass('redText');
	    $(this).removeClass('greenText');
	    $(this).addClass('blueText');
	}
	else
	{
	    $(this).removeClass('blueText');
	    $(this).removeClass('greenText');
	    $(this).addClass('redText');
	}
    });
    
    
    $('.amenity_class').change(function(){
	    if($(this).val() == 'active')
	    {
		$(this).removeClass('redText');
		$(this).removeClass('blueText');
		$(this).addClass('greenText');
	    }
	    else if($(this).val() == 'inactive')
	    {
		$(this).removeClass('redText');
		$(this).removeClass('greenText');
		$(this).addClass('blueText');
	    }
	    else
	    {
		$(this).removeClass('blueText');
		$(this).removeClass('greenText');
		$(this).addClass('redText');
	    }
    });
});

/***** Ajax location of a region *****/
$(function(){
    get_location();
});

$("#region").on("change",function(){
	get_location();
});
$("#location").on("click",function(){
    if ($("#region").val()=='') {
	alert("Please select a Region");
    }
});
function get_location(){
    var region = $("#region").val();
    $.ajax({
    type: "POST",
    dataType: "HTML",
    url: "<?php echo BACKEND_URL; ?>" + "property_sales/ajax_getLocation_of_region/", 
    data: { region: region},
    success:function(data) {
		if (data=='') {
		    data = '<option value="">Please select</option>';
		}
		$("#location").html(data);
	    }
    });
}
/***** End Ajax location of a region *****/

</script>

