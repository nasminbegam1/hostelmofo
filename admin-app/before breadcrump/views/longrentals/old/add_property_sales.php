<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<!--<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>property_image.js"></script>-->

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
                        <h4 class="panel-title">Add New Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
                	<form id="wizard_a" name="frmPropertySales" action="<?php echo BACKEND_URL;?>/property/add_property_sales/" enctype="multipart/form-data" method="post"> <!--id="wizard_a"-->
                    <input type="hidden" name="action" value="Process">
							<h4>Property Information</h4>

                            <fieldset>

                                <div class="row basic_info">
                                    <div class="col-sm-12">
                                        <div class="step_info">
                                            <h4>Property Information</h4>
                                            <p>This is basic information of the property</p>
                                        </div> 
                                	</div>
                                	<div class="col-sm-12">
                                    	<h4 class="proHeadingText">Property Name</h4>
                                        <div class="col-sm-3">
                                            <label for="property_name" class="req">Property Name</label>
                                            <input name="property_name" id="property_name" value="" type="text" class="form-control" data-required="true">
                                		</div>
                                        
                                        <div class="col-sm-3">
                                            <label for="property_name" class="req">Property Owner</label>
                                            <input value="<?php echo $property_owner;?>" type="text" class="form-control" disabled="disabled">
                                		</div>
                                        
                                        <br class="spacer" />
                                    	<h4 class="proHeadingText">Basic information</h4>
                                        <div class="col-sm-3">
                                            <label for="property_type" class="req">Property Type</label>
                                            <?php if(is_array($arr_property_type)) { ?>
                                            <select name="property_type" id="property_type" class="form-control" data-required="true">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_property_type as $key){?>
                                            <option value="<?php echo $key['property_type_id'];?>"><?php echo $key['property_name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="unit_number" class="req">Unit Number</label>
                                            <input id="unit_number" name="unit_number" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="bedrooms" class="req">Bedrooms</label>
                                            <input id="bedrooms" name="bedrooms" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="sleeps" class="req">Sleeps</label>
                                            <input id="sleeps" name="sleeps" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        
                                        <br class="spacer" />
                                        
                                        <div class="col-sm-3">
                                            <label for="bathrooms" class="req">Bathrooms</label>
                                            <input id="bathrooms" name="bathrooms" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="total_size" class="req">Total Size</label>
                                            <input id="total_size" name="total_size" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="indoor_size" class="req">Indoor Size</label>
                                            <input id="indoor_size" name="indoor_size" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="outdoor_size" class="req">Outdoor Size</label>
                                            <input id="outdoor_size" name="outdoor_size" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        
                                        <br class="spacer" />
                                        
                                        <div class="col-sm-3">
                                            <label for="view" class="req">View</label>
                                            <select name="view[]" id="view" class="required form-control" multiple="multiple">
                                            <?php foreach($arr_viwes as $key){?>
                                            <option value="<?php echo $key['view_type_id'];?>"><?php echo $key['view_type_name'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 checkBox">
                                            <label for="indoor_size" class="req">Furnished</label>
                                            <input type="radio" name="furnished" id="furnished_yes" value="Yes" class="required form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" name="furnished" id="furnished_no" value="Yes" class="required form-control radion_frm_class"><span class="radio_lebel">No</span>
                                            <input type="radio" name="furnished" id="furnished_part" value="Part" class="required form-control radion_frm_class"><span class="radio_lebel">Part</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="floor" class="req">Floor</label>
                                            <input id="floor" name="floor" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="storeys">Storeys</label>
                                            <input id="storeys" name="storeys" type="text" class="form-control" data-type="number">
                                        </div>
                                        
                                        <br class="spacer" />
                                        
                                        <div class="col-sm-3">
                                            <label for="development_name">Development Name</label>
                                            <input id="development_name" name="development_name" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="developer_name">Developer Name</label>
                                            <input id="developer_name" name="developer_name" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-3 checkBox">
                                            <label for="indoor_size" class="req">Off Plan</label>
                                            <input type="radio" name="off_plan" id="off_plan_yes" value="Yes" class="required form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" name="off_plan" id="off_plan_no" value="No" class="required form-control radion_frm_class"><span class="radio_lebel">No</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="completion_date" class="req">Completion Date</label>
					    <input type="text" readonly id="completion_date" class="form-control" name="completion_date" />
                                        </div>
                                        
                                        <br class="spacer" />
                                        <h4 class="proHeadingText">Address</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="latitude" class="req">Latitude</label>
                                            <input id="latitude" name="latitude" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="longitude" class="req">Longitude</label>
                                            <input id="longitude" name="longitude" type="text" class="form-control" data-required="true" data-type="number">
                                        </div> 
                                        <div class="col-sm-3">
                                            <label for="region" class="req">Region</label>
                                            <select name="region" id="region" class="required form-control">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_region as $key){?>
                                            <option value="<?php echo $key['region_id'];?>"><?php echo $key['region_name'];?></option>
                                            <?php } ?>
                                            </option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="distance_from_airport" class="req">Distance from Airport</label>
                                            <input id="distance_from_airport" name="distance_from_airport" type="text" class="form-control" data-required="true">
                                        </div>
                                        
                                        <br class="spacer" />
                                        
                                        <div class="col-sm-3">
                                            <label for="distance_from_beach" class="req">Distance from Beach</label>
                                            <input id="distance_from_beach" name="distance_from_beach" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="distance_from_patong" class="req">Distance from Patong</label>
                                            <input id="distance_from_patong" name="distance_from_patong" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="direction_to_property" class="req">Direction to Property</label>
                                            <textarea name="direction_to_property" id="direction_to_property" class="form-control" data-required="true"></textarea>
                                        </div>
                                        
                                        <br class="spacer" />
                                        <h4 class="proHeadingText">Other information</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="page_title" class="req">Page Title</label>
                                            <input id="page_title" name="page_title" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="optional_title" class="req">Optional Title</label>
                                            <input id="optional_title" name="optional_title" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="seo_title" class="req">SEO Title</label>
                                            <input id="seo_title" name="seo_title" type="text" class="form-control" data-required="true">
                                        </div>
                                        
                                       <div class="col-sm-3">
                                            <label for="local_information" class="req">Local Information</label>
                                            <input id="local_information" name="local_information" type="text" class="form-control" data-required="true">
                                        </div>
                                        
                                        
                                        <br class="spacer" />
                                        
                                        
                                        <div class="col-sm-3">
                                            <label for="meta_description" class="req">Meta Description</label>
                                            <input id="meta_description" name="meta_description" type="text" class="form-control" data-required="true">
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="indoor_size" class="req">Amenities</label>
                                            <select name="amenities[]" id="amenities" class="required form-control" multiple="multiple">
                                            <?php foreach($arr_amenities as $key){?>
                                            <option value="<?php echo $key['amenities_id'];?>"><?php echo $key['amenities_name'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <label for="property_description" class="req">Property Description</label>
                                            <textarea id="property_description" name="property_description" type="text" class="form-control" data-required="true"></textarea>
                                        </div>
                                        
                                        <br class="spacer" />
                                    	
                                        <h4 class="proHeadingText">Property Manager Information</h4>
                                        <div class="col-sm-3">
                                            <label for="property_manager_name" class="req">Property Manager Name</label>
                                            <input id="property_manager_name" name="property_manager_name" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="manager_contact_number1" class="req">Manager Contact Number1</label>
                                            <input id="manager_contact_number1" name="manager_contact_number1" type="text" class="form-control" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="manager_contact_number2">Manager Contact Number2</label>
                                            <input id="manager_contact_number2" name="manager_contact_number2" type="text" class="form-control" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="manager_email" class="req">Manager Email</label>
                                            <input id="manager_email" name="manager_email" type="text" class="form-control"  data-type="email" data-required="true">
                                        </div>
                                        
                                    </div>
                                </div>

                            </fieldset>

							<h4>Property Images</h4>
							
                            <fieldset>
                            	<div id="mulitplefileuploader">Upload</div>
                                <div id="status"></div>
                            </fieldset>
                                   
                            <h4>Property Sales</h4>
							<fieldset>
                            	<h4 class="proHeadingText">Price information</h4>
                                <div class="col-sm-3">
                                    <label for="sales_price" class="req">Sales Price</label>
                                    <input name="sales_price" id="sales_price" value="" type="text" class="form-control" data-required="true" data-type="number">
                                </div>
                                
                                <div class="col-sm-3 checkBox">
                                    <label for="sales_price" class="req">Freehold/Leashold</label>
                                    <input type="radio" name="hold_type" value="Freehold" class="required form-control radion_frm_class"><span class="radio_lebel">Freehold</span>
                                    <input type="radio" name="hold_type" value="Leasehold" class="required form-control radion_frm_class"><span class="radio_lebel">Leasehold</span>
                                </div>
                                
                                <div class="col-sm-3 checkBox">
                                    <label for="sales_price" class="req">Land Title</label>
                                    <input type="radio" name="land_title" value="Chanote" class="required form-control radion_frm_class"><span class="radio_lebel">Chanote</span>
                                    <input type="radio" name="land_title" value="Tor Dok" class="required form-control radion_frm_class"><span class="radio_lebel">Tor Dok</span>
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="payment_structure" class="req">Payment Structure</label>
                                    <input id="payment_structure" name="payment_structure" type="text" class="form-control" data-required="true">
                                </div>
                                
                                <br class="spacer" />
                                
                                <div class="col-sm-3">
                                    <label for="sinking_fund">Sinking Fund</label>
                                    <input id="sinking_fund" name="sinking_fund" type="text" class="form-control" data-type="number">
                                </div>
                                
                                <br class="spacer" />
                                
                                <h4 class="proHeadingText">Other information</h4>
                                
                                <div class="col-sm-3">
                                    <label for="maintenance">Maintenance</label>
                                    <input id="maintenance" name="maintenance" type="text" class="form-control">
                                </div>
                                
                                <div class="col-sm-3 checkBox">
                                    <label for="rented_vacant" class="req">Rented/Vacant</label>
                                    <input type="radio" name="rented_vacant" value="Rented" class="required form-control radion_frm_class"><span class="radio_lebel">Rented</span>
                                    <input type="radio" name="rented_vacant" value="Vacant" class="required form-control radion_frm_class"><span class="radio_lebel">Vacant</span>
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="sales_price">Parking Space Included</label>
                                    <input id="parking_space_included" name="parking_space_included" type="text" class="form-control" data-type="number">
                                </div>
                                
                            	<div class="col-sm-3">
                                	<label for="reg_input_name" class="req">Agent</label>
                                	<select name="agent_id" id="agent_id" class="required form-control">
                                		<option value=""> Please Select </option>
										<?php
                                        if(is_array($arr_agent)) {
                                        foreach($arr_agent as $key) {
                                        ?>
                                        <option value="<?php echo $key['admin_id'];?>"><?php echo $key['agent_name'];?></option>
                                        <?php }
                                        }
                                        ?>
                                	</select>
                                </div>
                                
                                <br class="spacer" />
                                
                                <div class="col-sm-3">
                                    <label for="sales_price" class="req">Contacts Associated</label>
                                    <select name="contact_id[]" id="contact_id" class="required form-control" multiple="multiple">
                                    <?php foreach($arr_contacts as $key){?>
                                    <option value="<?php echo $key['contact_id'];?>"><?php echo $key['full_name'];?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </fieldset>
									
                                    
                
								</form>
                            </div>
                        </div>	
            		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
<script>
$(window).load(function(){
	var backend_url		= '<?php echo BACKEND_URL;?>';
    
	var settings = {
		url:  backend_url + "property/do_image_upload",
		method: "POST",
		allowedTypes:"jpg,png,gif,jpeg",
		fileName: "myfile",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
			$("#status").html("<font color='green'>Upload is success</font>");
			
		},
		onError: function(files,status,errMsg)
		{		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}
	}

	$("#mulitplefileuploader").uploadFile(settings);

	$("#completion_date").datepicker({
	  changeMonth: true,
	  changeYear: true
	});
	
});
</script>