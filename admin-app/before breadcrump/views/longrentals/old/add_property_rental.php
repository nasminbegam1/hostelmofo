<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<link type="text/css" href="<?php echo BACKEND_JS_PATH; ?>lib/datepicker/jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>lib/datepicker/jquery.datepick.js"></script>

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
            <div class="row basic_info" >
            	<div class="col-sm-12">
                	<form id="wizard_a" name="frmRentalProperty" action="<?php echo BACKEND_URL;?>/property/add_property_rental/" enctype="multipart/form-data" method="post"> <!--id="wizard_a"-->
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
                                            <input id="unit_number" name="unit_number" type="text" class="form-control" data-required="true">
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
                                            <input type="radio" name="off_plan" id="off_plan_yes" value="Yes" data-required="true" class="required form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" name="off_plan" id="off_plan_no" value="No" class="required form-control radion_frm_class"><span class="radio_lebel">No</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="completion_date" class="req">Completion Date</label>
                                            <!--<div data-date-autoclose="true" data-date-format="dd-mm-yyyy" class="input-group date ebro_datepicker">
                                                <input type="text" class="form-control" name="completion_date" id="completion_date">
                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            </div>-->
					    <input type="text" id="completion_date" class="form-control" name="completion_date" />
                                        </div>
                                        
                                        <br class="spacer" />
                                        <h4 class="proHeadingText">Address</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="latitude" class="req">Latitude</label>
                                            <input id="latitude" name="latitude" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="longitude" class="req">Longitude</label>
                                            <input id="longitude" name="longitude" type="text" class="form-control" data-required="true">
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
                                            <input id="manager_contact_number1" name="manager_contact_number1" type="text" class="form-control" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="manager_contact_number2">Manager Contact Number2</label>
                                            <input id="manager_contact_number2" name="manager_contact_number2" type="text" class="form-control">
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
                                    
                            <h4>Rental Information</h4>
				<fieldset>
				    <h4 class="proHeadingText">Deposit and Payments Information</h4>
            <div class="col-sm-6">
              <label for="reg_input_name" class="req">Security Deposit</label>
              <input type="text" class="form-control required" name="security_deposit" id="security_deposit" data-required="true" data-type="number">
            </div>
            <div class="col-sm-6">
              <label for="reg_input_name">Number of Checks/Payments</label>
              <input type="text" class="form-control" name="no_of_cheques_payment" id="no_of_cheques_payment" data-type="number">
            </div>
	    
	    <br class="spacer" />
	    
	    <h4 class="proHeadingText">Duration and Extra Person Charge Information</h4>            	    
            <div class="col-sm-6">
              <label for="reg_input_name" class="req">Minimum Rental Days</label>
              <input type="text" class="form-control required" name="minimum_rental_days" id="minimum_rental_days" data-required="true" data-type="number">
            </div>
	    <div class="col-sm-6">
              <label for="reg_input_name" class="req">Extra Daily Charge Per Person</label>
              <input type="text" class="form-control required" name="daily_charge_person_extra" id="daily_charge_person_extra" data-required="true" data-type="number">
            </div>
	    <br class="spacer" />
	    
	    <h4 class="proHeadingText">Cancellation and Unavailabilty Information</h4>
            <div class="col-sm-12">
              <label for="reg_input_name" class="req">Cancellation Policy for booking</label>
              <textarea name="cancellation_policy" id="cancellation_policy" class="required form-control"></textarea>
            </div>
	    <br class="spacer" />
	    
            <div class="col-sm-12">
              <label for="reg_input_name">Unavailable dates on calender</label>
              <input type="text" class="form-control" name="unavailable_calendar_dates" id="unavailable_calendar_dates">
              <div id="unavailable_calendar_dates"></div>
            </div>
	    <br class="spacer" />
	    
	    <h4 class="proHeadingText">Contacts Information</h4>
            <div class="col-sm-12">
              <label for="reg_input_name" class="req">Contacts Associated</label>
              <select name="contact_id[]" id="contact_id" class="required form-control" multiple="multiple">
				    <?php foreach($arr_contacts as $key){?>
				     <option value="<?php echo $key['contact_id'];?>"><?php echo $key['full_name'];?></option>
				    <?php } ?>
              </select>
            </div>
	    <br class="spacer" />
	    
            <div class="col-sm-6">
              <label for="reg_input_name" class="req">Agent</label>
              <select name="agent_id" id="agent_id" class="required form-control">
                <option value=""> Please Select </option>
                <?php
		if(is_array($arr_agent)) {
		    foreach($arr_agent as $key) {
		?>
                <option value="<?php echo $key['admin_id'];?>"><?php echo $key['agent_name'];?></option>
                <?php } } ?>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="reg_input_name" class="req">Task</label>
              <select name="task_id" id="task_id" class="required form-control">
		<option value=""> Please Select </option>
                <?php
		if(is_array($tasks_list)) {
		    foreach($tasks_list as $task) {
		?>
		    <option value="<?php echo $task['task_id'];?>"><?php echo $task['task_name'];?></option>
		<?php } } ?>   		
              </select>
            </div>
	     
            <br class="spacer" />
	    
	    <?php //pr($seasons_list,0); ?>
	    
	    <?php if($seasons_list){ $i=1; ?>
		<h4 class="proHeadingText">Seasonal Property Rents</h4>		
		<?php foreach($seasons_list as $season){ ?>
		<?php if($i>1) { echo '<br />';} ?>
		<div class="col-sm-12"><legend><span><?php echo $season['season_name']; ?> Season</span></legend></div>
		<div class="col-sm-4">
		  <label for="reg_input_name" class="req">Daily Price</label>
		  <input name="season_daily_<?php echo $season['season_id']; ?>" type="text" class="required form-control" data-required="true" data-type="number">
		</div>
		<div class="col-sm-4">
		  <label for="reg_input_name" class="req">Weekly Price</label>
		  <input name="season_weekly_<?php echo $season['season_id']; ?>" type="text" class="required form-control" data-required="true" data-type="number">
		</div>
		<div class="col-sm-4">
		  <label for="reg_input_name" class="req">Monthly Price</label>
		  <input name="season_monthly_<?php echo $season['season_id']; ?>" type="text" class="required form-control" data-required="true" data-type="number">
		</div>
		<input type="hidden" name="season_id[<?php echo $season['season_id']; ?>]" value="<?php echo $season['season_name']; ?>" />
		<br class="spacer" />
	    <?php $i++; } } ?>
	    
	    <h4 class="proHeadingText">Additional Information Information</h4>
            <div class="col-sm-12">
              <label for="reg_input_name" class="req">Add Notes</label>
              <textarea name="add_notes" id="add_notes" class="required form-control"></textarea>
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
    
    $('#unavailable_calendar_dates').datepick({multiSelect: 999, monthsToShow: 3});
    $("#completion_date").datepicker({
	changeMonth: true,
	changeYear: true
      });
    
});
</script>