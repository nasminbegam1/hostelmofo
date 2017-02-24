<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/jquery.fancybox-1.3.4.css">
<script type="text/javascript">
$(document).ready(function() {
        
        $(".various3").fancybox({
                'width'		: '90%',
                'height'	: '90%',
                'autoScale'	: false,
                'transitionIn'  : 'none',
                'transitionOut'	: 'none',
                'type'		: 'iframe'
        });
});
</script>
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
    <?php } ?>
    	
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add New Property Status</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo BACKEND_URL;?>property/add_property_status/" class="main" enctype="multipart/form-data" id="parsley_reg">
			    	<input type="hidden" name="action" value="Process">
				<input type="hidden" name="property_type" value="<?php echo $property_type; ?>">
					
				<div class="col-sm-12">
				<label for="reg_input_name"><legend>Property Details Status</legend></label>
				<div>
					
					<span class="blue bold">This Property will be used for <?php echo ($property_type == 'Both' ?  "Sales and Rental both" : $property_type ) ; ?> purpose.</span><br class="spacer" /><br class="spacer" />
					
					<?php if($property_image){ ?>
						<span class="green bold">Property Images has been provided.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } else { ?>
						<span class="red bold">No Property Images available. Property will be shown without images.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } ?>					
					
					<?php if($property_sales){ ?>
						<span class="green bold">Property Sales information has been provided.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } else { ?>
						<span class="red bold">No Property Sales information available.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } ?>
					
					<?php if($property_rental){ ?>
						<span class="green bold">Property Rental Information has been provided.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } else { ?>
						<span class="red bold">No Property Rental information has been provided.</span>
						<br class="spacer" /><br class="spacer" />
					<?php } ?>
					
					
				</div>
				</div>
					
				<div class="col-sm-12">
					<a class="various3" href="<?php echo FRONTEND_URL;?>property/property_preview/<?php echo $property_new_id;?>/">
						<strong>Click here to preview the property</strong>
					</a>
					<br class="spacer" /><br class="spacer" />
				</div>
                        	<div class="col-sm-12">
                                <label for="reg_input_name" class="req">Property Status</label>
                                <select name="status" id="property_status" class="required form-control">
                                  <option value="">--Select Status--</option>
                                  <option value="inactive">Not Live</option>
                                  <option value="active">Live</option>
                                </select>
                        	</div>
				<br class="spacer" />
			
				
                            <div style="display:none;" id="why_not_live_div" class="col-sm-12">
                                <label for="reg_input_name">Why Not Live?</label>
                                <textarea name="why_not_live" id="why_not_live" class="form-control"></textarea>
                            </div>
			    <br class="spacer" />
                            
                            <div class="col-sm-12">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </div>
			    <br class="spacer" />
                       </form>
                    </div>
                </div>
            </div>
        </div>
	
<!--End : Main content-->    
</div>
<script>
$(function() {
	var status_val = $("#property_status").val();
	if(status_val == 'inactive')
	{
		$("#why_not_live_div").show();
	}
	else
	{
		$("#why_not_live_div").hide();
	}
});

$("#property_status").change(function(){ 
	var status_val = $(this).val();
	if(status_val == 'inactive')
	{
		$("#why_not_live_div").show();
	}
	else
	{
		$("#why_not_live_div").hide();
	}
});
</script>