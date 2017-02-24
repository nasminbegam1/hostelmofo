<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
                        <h4 class="panel-title">Edit Property Status</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo BACKEND_URL;?>/property/edit_property_status/<?php echo $property_id;?>/<?php echo $page_num;?>" class="main" enctype="multipart/form-data" id="parsley_reg">
			    			<input type="hidden" name="action" value="Process">
			    			    
                        	<div class="form_sep">
                                <label for="reg_input_name" class="req">Property Status</label>
                                <select name="status" id="property_status" class="required form-control">
                                  <option value="">--Select Status--</option>
                                  <option value="active" <?php if($status == 'active'){?> selected<?php } ?>>Live</option>
                                  <option value="inactive" <?php if($status == 'inactive'){?> selected<?php } ?>>Not Live</option>
                                </select>
                        	</div>
			    			
                            <?php
							$display = 'none';
							if($status ==  'inactive') 
							{
								$display = 'block';
							}
							?>
                            <div style="display:<?php echo $display;?>;" id="why_not_live_div" class="form_sep">
                                <label for="reg_input_name">Why Not Live?</label>
                                <textarea name="why_not_live" id="why_not_live" class="form-control"><?php echo stripslashes(trim($why_not_live));?></textarea>
                            </div>
                            
                            <div class="form_sep">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
	
<!--End : Main content-->    
</div>
<script>
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