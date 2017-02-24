<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>

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
		
		//pr($arr_owner,0);
		 //mr_mrs,email,phone_number_cell,phone_number_home,lang_id
		
		?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add New Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
                	
                    <ul class="property_tab">
                        <li class="active"><a id="property_information_div" class="property_menu">Property Information</a></li>
                        <li><a id="property_image_div" class="property_menu">Property Image</a></li>
			<li><a id="property_rentals_div" class="property_menu">Property Rentals</a></li>
                        <li><a id="property_sales_div" class="property_menu">Property Sales</a></li>
                        <!--<li><a id="property_additional_information_div" class="property_menu">Property Additional Information</a></li>-->
		    </ul>
		    
		    
                    <div class="clear"></div>
			    <?php //pr($arr_owner);?>
                <div id="property_information_fieldset" class="property_tag_class">
				<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post">
				<input type="hidden" name="action" value="Process">
				<input type ="hidden" id="mr_mrs" value="<?php echo $arr_owner[0]['mr_mrs']; ?>"  >
				<input type ="hidden" id="email" value="<?php echo $arr_owner[0]['email'];  ?>"  >
				<input type ="hidden" id="phone_no_one" value="<?php echo $arr_owner[0]['phone_number_home'];  ?>"  >
				<input type ="hidden" id="phone_no_second" value="<?php echo $arr_owner[0]['phone_number_cell'];  ?>"  >
				<input type ="hidden" id="lang_id" value="<?php echo $arr_owner[0]['lang_id'];  ?>"  >
				
				
				
				    
				    
				<div class="col-sm-12">
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
                                            <input name="property_name" id="property_name" value="" type="text" data-required="true" class="form-control required">
                                	</div>
					
					<div class="col-sm-3">
                                            <label for="property_name" class="req">Property Owner</label>
                                            <span><a href="<?php echo BACKEND_URL.'owner/details/'.$owner_id.'/'; ?>" target="_blank" id="ownername"><?php echo $property_owner;?></a></span>
                                	</div>
					
					<div class="col-sm-3">
                                            <label for="property_ranking">Property Ranking</label>
					    <select name="property_ranking" id="property_ranking" class="form-control">
						<option value="">---Please Select---</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					    </select>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="property_name" class="req">Property Currency</label>
                                             <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
						<option value="">---Please Select---</option>
						<option value="THB">THB</option>
						<option value="USD">USD</option>
					    </select>
                                	</div>
					<br class="spacer" />
                                    	<h4 class="proHeadingText">Basic information</h4>
                                        <div class="col-sm-3">
                                            <label for="property_type" class="req">Property Type</label>
                                            <?php if(is_array($arr_property_type)) { ?>
                                            <select name="property_type" id="property_type" data-required="true"  class="form-control required">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_property_type as $key){?>
                                            <option value="<?php echo $key['property_type_id'];?>"><?php echo $key['property_name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="unit_number">Unit Number</label>
                                            <input id="unit_number" name="unit_number" data-type="number" type="text" class="form-control">
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="bedrooms" class="req">Bedrooms</label>
					    <select id="bedrooms" name="bedrooms" data-required="true" class="form-control required">
						<option value="">Please Select</option>
						<?php for($b=1;$b<13;$b++){?>
						<option value="<?php echo $b;?>"><?php echo $b;?></option>
						<?php } ?>
					    </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="bedrooms">Bedroom Configuration</label>
					    <input type="text" name="bedroom_configuration" id="bedroom_configuration" value="" class="form-control">
                                        </div>
                                        
					<br class="spacer" />
					
					<div class="col-sm-3 checkBox">
					    <label for="is_studio">Studio Apartment</label>
					    <input type="radio" class="form-control radion_frm_class" value="Yes" id="is_studio" name="is_studio">
					    <span class="radio_lebel">Yes</span>
					     <input type="radio" class="form-control radion_frm_class" value="No" id="is_studio" name="is_studio" checked >
					    <span class="radio_lebel">No</span>
					</div>
					
					<div class="col-sm-3">
                                            <label for="sleeps" class="req">Sleeps</label>
                                            <select id="sleeps" name="sleeps" data-required="true" class="form-control required">
						<option value="">Please Select</option>
						<?php for($b=1;$b<25;$b++){?>
						<option value="<?php echo $b;?>"><?php echo $b;?></option>
						<?php } ?>
					    </select>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="bathrooms" class="req">Bathrooms</label>
                                            <select id="bathrooms" name="bathrooms" data-required="true" class="form-control required">
						<option value="">Please Select</option>
						<?php for($b=1;$b<12;$b++){?>
						<option value="<?php echo $b;?>"><?php echo $b;?></option>
						<?php } ?>
					    </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="bedrooms">Bathroom Configuration</label>
					    <input type="text" name="bathroom_configuration" id="bathroom_configuration" value="" class="form-control">
                                        </div>
					
					<br class="spacer" />
					
                                        <div class="col-sm-3">
                                            <label for="total_size">Total Size</label>
                                            <input id="total_size" name="total_size" data-type="number" type="text" class="form-control">&nbsp;(in sqmetres) 
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="indoor_size">Indoor Size</label>
                                            <input id="indoor_size" name="indoor_size" type="text" data-type="number" class="form-control">&nbsp;(in sqmetres)
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="outdoor_size">Outdoor Size</label>
                                            <input id="outdoor_size" name="outdoor_size" type="text" data-type="number" class="form-control">&nbsp;(in sqmetres)
                                        </div>
                                        
					<div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Furnished</label>
                                            <input type="radio" name="furnished" id="furnished_yes" value="Yes" class="form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" name="furnished" id="furnished_no" value="Yes" class="form-control radion_frm_class"><span class="radio_lebel">No</span>
                                            <input type="radio" name="furnished" id="furnished_part" value="Part" class="form-control radion_frm_class"><span class="radio_lebel">Part</span>
                                        </div>
                                        
					<br class="spacer" />
					
					<div class="col-sm-3">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"><label for="view">View</label></div>
						<div class="multiSelectBoxInn">
						    <ul>
							<?php
							foreach($arr_viwes as $key)
							{
							?>
							 <li><input name="view[]" type="checkbox" value="<?php echo $key['view_type_id'];?>" /><label><?php echo $key['view_type_name'];?></label></li>
							
							<?php
							}
							?>
						    
						    </ul>
						 </div>
					    </div>
                                            
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="floor">Apartment Floor</label>
					    <select name="floor" id="floor" class="form-control">
						<option value="">Please Select</option>
						<?php for($s=0;$s<36;$s++){?>
						<option value="<?php echo $s;?>"><?php echo $s;?></option>
						<?php } ?>
                                            </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="storeys">Storeys</label>
                                            <select name="storeys" id="storeys" class="form-control">
						<option value="">Please Select</option>
						<?php for($s=0;$s<36;$s++){?>
						<option value="<?php echo $s;?>"><?php echo $s;?></option>
						<?php } ?>
                                            </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="development_name">Development Name</label>
					    <select name="development_name" id="development_name" class="form-control">
						<option value="">Please Select</option>
						<?php
						if(is_array($development_list)) {
						    foreach($development_list as $val) {
						?>
						<option value="<?php echo $val['development_id'];?>"><?php echo $val['development_name'];?></option>
						<?php } } ?>
						<option value="-1">Add New Development</option>
					    </select>
                                        </div>
					
					<br class="spacer" />
					
					<div class="col-sm-3">
                                            <label for="developer_name">Name of Developer</label>
                                            <input id="developer_name" name="developer_name" type="text" class="form-control">
                                        </div>
					
					<div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Off Plan</label>
                                            <input type="radio" name="off_plan" id="off_plan_yes" value="Yes" class="form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" name="off_plan" id="off_plan_no" value="No" class="form-control radion_frm_class"><span class="radio_lebel">No</span>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="completion_date">Completion Date</label>
					    <input type="text" readonly id="completion_date" class="form-control" name="completion_date" />
                                        </div>
                                        <div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Pool Type</label>
                                            <input type="radio" name="pooltype" id="pooltype1" value="Private" class="form-control radion_frm_class"><span class="radio_lebel">Private</span>
                                            <input type="radio" name="pooltype" id="pooltype2" value="Communal" class="form-control radion_frm_class"><span class="radio_lebel">Communal</span>
                                        </div>
                                        <br class="spacer" />
                                        <br class="spacer" />
					
					<div class="col-sm-3">
                                            <label for="developer_name">Special Offer Heading</label>
                                            <input id="special_offer_title" name="special_offer_title" type="text" class="form-control" value="">
                                        </div>
					
					<div class="col-sm-9">
                                            <label for="developer_name">Special Offer Text</label>
                                            <input id="special_offer_text" name="special_offer_text" type="text" class="form-control" value="">
                                        </div>
                                        
					<br class="spacer" />
					
					<div id="add_new_development_div" style="display:none;">
					        <div class="col-sm-3">
						    <label for="development_name">New Development Name</label>
						    <input type="text" name="new_development_name" id="new_development_name" class="form-control">
						</div>
						<br class="spacer" />
						<div class="col-sm-3">
						    <input type="button" value="Add New Development" id="add_new_development">
						</div>
					</div>
					
					<br class="spacer" />
                                        <h4 class="proHeadingText">Features</h4>
                                        <div class="col-sm-3">
					    <label for="latitude">Feature - 1</label>
					    <input type="text" id="special_feature1" name="special_feature1" class="form-control" value="">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 2</label>
					    <input type="text" id="special_feature2" name="special_feature2" class="form-control" value="">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 3</label>
					    <input type="text" id="special_feature3" name="special_feature3" class="form-control" value="">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 4</label>
					    <input type="text" id="special_feature4" name="special_feature4" class="form-control" value="">
					</div>
					
					
					<br class="spacer" />
                                        <h4 class="proHeadingText">Address</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="latitude" class="req">Latitude</label>                                            
					    <input type="text" id="latitude" name="latitude" class="form-control required number" data-required="true" data-type="number">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="longitude" class="req">Longitude <a id="review_map" href="https://maps.google.com/" target="_blank">Review Map</a></span></label>
                                            <input id="longitude" name="longitude" type="text"  data-type="number" class="form-control required number" data-required="true"  />
                                        </div>
					
                                        <div class="col-sm-3">
                                            <label for="region" class="req">Region</label>
                                            <select name="region" id="region" class="form-control required" data-required="true">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_region as $key){?>
                                            <option value="<?php echo $key['region_id'];?>"><?php echo $key['region_name'];?></option>
                                            <?php } ?>
                                            </option>
                                            </select>
                                        </div>
				
					<div class="col-sm-3">
                                            <label for="region" class="req">Location</label>
                                            <select name="location" id="location" class="form-control required" data-required="true">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_location as $key){?>
                                            <option value="<?php echo $key['location_id'];?>"><?php echo $key['location_name'];?></option>
                                            <?php } ?>
                                            </option>
                                            </select>
                                        </div>
					<br class="spacer" />	
                                        <div class="col-sm-12">
                                            <label for="direction_to_property" class="req">Direction to Property</label>
                                            <textarea name="direction_to_property" id="wysiwg_editor2" ></textarea>
                                        </div>
					
					
					<br class="spacer" />
                                        
					<h4 class="proHeadingText">Distances From</h4>
					
					<div class="col-sm-4">
                                            <label for="nearest_mall" class="req">Phuket Town</label>
					     <input id="phukettown_distance" name="phukettown_distance" type="text" class="form-control required" data-required="true" value="">
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_supermarket" class="req">Patong</label>
					    <input id="patong_distance" name="patong_distance" type="text" class="form-control required" data-required="true" value="">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_atm" class="req">Phuket International Airport</label>
					    <input id="phuketairport_distance" name="phuketairport_distance" type="text" class="form-control required" data-required="true" value="">
                                        </div>
                                        <br class="spacer" />
					
					<h4 class="proHeadingText">Walking Distance Nearby</h4>
					<div class="col-sm-4">
                                            <label for="nearest_restaurant" class="req">Nearest Walking Distance 1</label>
					    <input id="walkingdistance_1" name="walkingdistance_1" type="text" class="form-control required" data-required="true" value="">
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="walkingdistance_2" class="req">Nearest Walking Distance 2</label>
					    <input id="walkingdistance_2" name="walkingdistance_2" type="text" class="form-control required" data-required="true" value="">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="walkingdistance_3" class="req">Nearest Walking Distance 3</label>
					    <input id="walkingdistance_3" name="walkingdistance_3" type="text" class="form-control required" data-required="true" value="">
                                        </div>
                                        <br class="spacer" />
					
					<?php /* ?>
					<div class="col-sm-4">					    
                                            <label for="distance_from_airport" class="req">Phuket Airport</label>
					    <select name="distance_from_airport" id="distance_from_airport" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="distance_from_beach" class="req">Nearest Beach</label>
					    <select name="distance_from_beach" id="distance_from_beach" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="distance_from_patong" class="req">Patong</label>
					    <select name="distance_from_patong" id="distance_from_patong" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					<div class="col-sm-4">
                                            <label for="nearest_mall" class="req">Nearest Mall</label>
					    <select name="nearest_mall" id="nearest_mall" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_supermarket" class="req">Nearest Supermarket</label>
					    <select name="nearest_supermarket" id="nearest_supermarket" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_atm" class="req">Nearest ATM</label>
					    <select name="nearest_atm" id="nearest_atm" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					<div class="col-sm-4">
                                            <label for="nearest_restaurant" class="req">Nearest Restaurant</label>
					    <select name="nearest_restaurant" id="nearest_restaurant" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_golfcourse" class="req">Nearest Golf Course</label>
					    <select name="nearest_golfcourse" id="nearest_golfcourse" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_bar" class="req">Nearest Bar</label>
					    <select name="nearest_bar" id="nearest_bar" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr(); ?>
					    </select>
                                        </div>
                                        
					<br class="spacer" />
					<?php */ ?>
                                        <h4 class="proHeadingText">Other information</h4>                                        
                                        <div class="col-sm-3">
                                            <label for="page_title" class="req">Page Title</label>
                                            <input id="page_title" name="page_title" type="text" class="form-control required" data-required="true">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="optional_title" class="req">Optional Title</label>
                                            <input id="optional_title" name="optional_title" type="text" class="form-control required" data-required="true">
                                        </div>
                                        
					<div class="col-sm-3">
                                            <label for="local_information" class="req">Local Information</label>
                                            <input id="local_information" name="local_information" type="text" class="form-control required" data-required="true">
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="local_information" class="req">Tag for Similar Property</label>
                                            <input id="similar_property_tag" name="similar_property_tag" type="text" class="form-control" value="">
                                        </div> 
                                        <br class="spacer" />                                        
                                        
					<div class="col-sm-12">
                                            <label for="seo_title" class="req">SEO Title</label>
                                            <input name="seo_title" id="seo_title" type="text" class="form-control required" data-required="true" maxlength="69">
					    <span id="seo_title_count">0</span><span>/69</span>
                                        </div>
					
					<div class="col-sm-12">
                                            <label for="meta_description" class="req">Meta Description</label>
                                            <input id="meta_description" name="meta_description" type="text" class="form-control required" data-required="true" maxlength="155">
					    <span id="meta_description_count">0</span><span>/155</span>
                                        </div>
					
					<br class="spacer" />
					<h4 class="proHeadingText">Property Description</h4>
                                        <div class="col-sm-12">
                                            <label for="property_description">Property Description</label>
					    <!--<iframe name="test123" id="wysiwg_simple"></iframe>-->
                                            <textarea name="property_description" id="wysiwg_simple" ></textarea>
                                        </div>
					
					<br class="spacer" />
					<div class="col-sm-12">
                                            <label for="property_info_onsite">Important Information (onsite)</label>
                                            <input type="text" id="property_info_onsite" name="property_info_onsite" class="form-control"  />
                                        </div>
					<br class="spacer" />
					<div class="col-sm-12">
                                            <label for="property_internal_info">Important Internal Information</label>
                                           <textarea  id="property_internal_info" name="property_internal_info"  class="form-control" ></textarea>
                                        </div>
                                        
                                        <br class="spacer" />
                                    	
                                        <h4 class="proHeadingText">Property Manager Information&nbsp;&nbsp;<input type="checkbox" name="owner_is_manager" id="owner_is_manager" value="Yes">&nbsp;Owner is core contact</h4>
					
					<div class="col-sm-12">
                                            <label for="property_manager_name"><legend>1<sup>st</sup> Contact Person</legend></label>
                                        </div>
					<div class="col-sm-4">
                                            <label for="property_manager_name">Manager Salutation</label>
                                            <select name="manager_salutations" id="manager_salutations" class="form-control">
						
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="property_manager_name">Property Manager Name</label>
                                            <input id="property_manager_name" name="property_manager_name" type="text" class="form-control" >
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_email">Manager Email</label>
                                            <input id="manager_email" name="manager_email" type="text" class="form-control" data-type="email" >
                                        </div>
					<br class="spacer" />
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number1">Manager Contact Number1</label>
                                            <input id="manager_contact_number1" name="manager_contact_number1" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number2">Manager Contact Number2</label>
                                            <input id="manager_contact_number2" name="manager_contact_number2" type="text" class="form-control" value="">
                                        </div>
                                        <div class="col-sm-4">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"> <label for="indoor_size">Manager Spoken Language</label></div>
						<input id="manager_lang_id" name="manager_lang_id" type="text" class="form-control" value="">
						
					    </div>
                                            
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					<div class="col-sm-12">
                                            <label for="property_manager_name"><legend>2<sup>nd</sup> Contact Person</legend></label>
                                        </div>
					<br class="spacer" />
					<div class="col-sm-4">
                                            <label for="property_manager_name">Manager Salutation</label>
                                            <select name="second_manager_salutations" id="second_manager_salutations" class="form-control" >
						<option value="">Please Select</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
					    </select>
                                        </div>
					<div class="col-sm-4">
                                            <label for="property_manager_name">Second Property Manager Name</label>
                                            <input id="second_manager_name" name="second_manager_name" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_email">Second Manager Email</label>
                                            <input id="second_manager_email" name="second_manager_email" type="text" class="form-control" data-type="email" >
                                        </div>
					<br class="spacer" />
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number1">Second Manager Contact Number1</label>
                                            <input id="second_manager_contact1" name="second_manager_contact1" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number2">Second Manager Contact Number2</label>
                                            <input id="second_manager_contact2" name="second_manager_contact2" type="text" class="form-control">
                                        </div>
					<div class="col-sm-4">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"> <label for="indoor_size">Second Manager Spoken Language</label></div>
						<input id="second_manager_lang_id" name="second_manager_lang_id" type="text" class="form-control" value="">
						<!--<div class="multiSelectBoxInn">
						    <ul>
							<?php
							foreach($arr_language_name as $arr_language_names)
							{
							?>
							 <li><input name= "second_manager_lang_id[]" type="checkbox" value="<?php echo $arr_language_names['lang_id'];?>" /><label><?php echo $arr_language_names['lang_name'];?></label></li>
							
							<?php
							}
							?>
						    
						    </ul>
						</div>-->
					    </div>
                                            
                                        </div>
                                        <br class="spacer" />
                                        <div class="save_div_class">
						<input type="hidden" name="frontend_url" id="frontend_url" value="<?php echo FRONTEND_URL; ?>" />
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset">Save and Next</button>
                                        </div>
                                        
                                    </div>
				</div>
                    </fieldset>
				
				</div>	
                </form>		
                </div>
                
                <!--- IMAGE DIV --->
				<div id="property_image_fieldset" style="display:none;"  class="property_tag_class">
				<form name="frmPropertyImages" id="frm2" enctype="multipart/form-data" method="post">
				<input type="hidden" name="action" value="Process">
				<input type="hidden" name="property_new_id" id="property_new_id" value="" />
				<fiedset>
			    <div class="col-sm-12">
                            	<!--<h4>Property Image</h4>-->
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Property Image</h4>
					<p>Upload the Property Images here.</p>
				    </div> 
				</div>
				<br class="spacer" />
				<div class="col-sm-12">
				    <table width="100%" cellpadding="2" cellspacing="3" border="1" class="imageListBox">
					<tr>
					    <th>Image Name</th>
					    <th>Image Title</th>
					    <th>Image Alt</th>
					    <th>Image Caption</th>
					    <th>Image Tag</th>
					    <th>Order</th>
					    <th>Featured</th>
					</tr>
					<tbody id="uploadPictures"></tbody>
				    </table>
				    <br class="spacer" /><br class="spacer" />
				    <div id="mulitplefileuploader">Upload</div>
				    <div id="status"></div>
				</div>
				
                                <br class="spacer" />
                                <div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit" id="btn_property_rentals_fieldset">Save and Next</button>
				    <button class="next_skip_continue btn btn-default" type="button" id="next_property_rentals_fieldset">Skip and Continue</button>
                                </div>
							    
				
			    </div>
			    </fieldset>
				</form>
			    </div>
                
                            

                <div id="property_rentals_fieldset" style="display:none;" class="property_tag_class">
			    <form name="frmPropertyRental" id="frm4" enctype="multipart/form-data" method="post" class="parsley_reg_rentals">
				
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Property Rental</h4>
					<p>Provide the Property Rental Information here.</p>
				    </div> 
				</div>
				<br class="spacer" />
				
				<input type="hidden" name="action" value="Process">
				<input type="hidden" name="property_new_id_rentals" id="property_new_id_rentals" value="" />
				<fieldset>
				<div class="col-sm-12">  
				    <h4 class="proHeadingText">Property Rental Number</h4>
				    <div class="col-sm-3">
					<label for="property_name" class="req">Property Rental #</label>
					<input name="property_rental_serial_no" id="property_rental_serial_no" data-required="true" type="text" class="form-controltwo required">
				    </div>
				    <br class="spacer" />
				
				<h4 class="proHeadingText">Cancellation and Unavailabilty Information</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name" class="req">Cancellation Policy for booking</label>
				  <!--<textarea name="cancellation_policy" id="wysiwg_editor4" class="form-controltwo"></textarea>-->
				   Flexible <input type="radio" name="cancellation_policy" value="Flexible" /> &nbsp;&nbsp;
				  Moderate <input type="radio" name="cancellation_policy" value="Moderate" /> &nbsp;&nbsp;
				  Strict <input type="radio" name="cancellation_policy" value="Strict" checked="checked" /> &nbsp;&nbsp;
				  Super Strict <input type="radio" name="cancellation_policy" value="SuperStrict" /> &nbsp;&nbsp;
				  Long Term <input type="radio" name="cancellation_policy" value="LongTerm" /> 
				</div>
				<br class="spacer" />
				
				<h4 class="proHeadingText">Unavailable Dates</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name" class="req">Select Dates</label>
				  <div id="blockdates_container"></div>
				  <input type="hidden" name="unavailable_date" id="unavailable_date" value="" readonly />
				</div>
				<br class="spacer" />
				
				<br class="spacer" />
				<h4 class="proHeadingText">Amenities
				<br>
				<span class="h4-span">Describe the general amenities for your property(sales and rental both) by clicking on the check box next to any amenity that is applicable to your listing. You can add details to any amenity by clicking on the "add details" link to the right of any selected amenity.</span></h4>
				<?php
				$featured_category_name = '';
				if(is_array($rental_amenity)) {
				?>
				
				<div class="col-sm-12">
				    <div class="formPanSec">
					<div class="rightPan">
					<?php foreach($rental_amenity as $prop_amenity_val)
					{ 
					    if($featured_category_name == $prop_amenity_val['featured_category_name'])
					    {
						if($prop_amenity_val['amenities_input'] == 'checkbox'){
					    ?>
						<!--<input name="rental_amenities[]" type="checkbox" value="<?php //echo $prop_amenity_val['amenities_id'];?>" />-->
						<div class="col-sm-4">
						    <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
							<option value="absent" class="redText">Off</option>
							<option value="active" class="greenText">Active</option>
							<option value="inactive" class="blueText">Display</option>
						    </select>
						    <label><?php echo $prop_amenity_val['amenities_name'];?></label>
						</div>
					    <?php
						} else { ?>
						    <div class="col-sm-3"><label><?php echo $prop_amenity_val['amenities_name'];?></label><input class="form-controltwo" name="rental_amenities_text[<?php echo $prop_amenity_val['amenities_id']; ?>]" type="text" value="" /></div>
						<?php }
					    }
					    else
					    {
					    ?>
					    <div class="subHeading"><?php echo $prop_amenity_val['featured_category_name'];?></div>
					    <div class="subHeadingInput">
						<?php if($prop_amenity_val['amenities_input'] == 'checkbox'){ ?>
						<!--<input name="rental_amenities[]" type="checkbox" value="<?php //echo $prop_amenity_val['amenities_id'];?>" />-->
						<div class="col-sm-4">
						    <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
							<option value="absent" class="redText">Off</option>
							<option value="active" class="greenText">Active</option>
							<option value="inactive" class="blueText">Display</option>
						    </select>
						    <label><?php echo $prop_amenity_val['amenities_name'];?></label>
						</div>
						<?php
						} else { ?>
						    <div class="col-sm-3"><label><?php echo $prop_amenity_val['amenities_name'];?></label><input class="form-controltwo" name="rental_amenities_text[<?php echo $prop_amenity_val['amenities_id']; ?>]" type="text" value="" /></div>
						<?php } ?>
					    </div>
					    <?php
					    }
					    $featured_category_name = $prop_amenity_val['featured_category_name'];
					    ?>					
					<?php } ?>
					
					</div>
				    </div>
				</div>
				<?php
				}
				?>				
				
				<div class="col-sm-12">
				    <div class="formPanSec">
					<div class="rightPan">
					    <div class="subHeading">Rental Information</div>
					    <div class="subHeadingInput">
						<textarea class="form-control" id="wysiwg_editor3" name="property_amenity_text_rental"></textarea>
					    </div>
					</div>
				    </div>
				</div>
				
				<br class="spacer" />
				
				
				
				<h4 class="proHeadingText">Contacts Information</h4>
				<div class="col-sm-12">
				    <div class="multiSelectBoxPan">
					<div class="multiSelectBoxHead"> <label for="indoor_size">Contacts Associated</label></div>
					<div class="multiSelectBoxInn">
					    <ul>
						<?php
						foreach($arr_contacts as $key)
						{
						?>
						 <li><input name= "contact_id[]" type="checkbox" value="<?php echo $key['contact_id'];?>" /><label><a href="<?php echo BACKEND_URL.'contacts/view_contact_master/'.$key['contact_id']; ?>" target="_blank"><?php echo $key['full_name']; ?></a></label></li>
						
						<?php
						}
						?>
					    
					    </ul>
					</div>
				    </div>
				</div>
				<br class="spacer" />
				
				<?php /* ?>
				<div class="col-sm-6">
				  <label for="reg_input_name" class="req">Agent</label>
				  <select name="agent_id" id="agent_id" data-required="true" class="form-controltwo required">
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
				  <select name="task_id" id="task_id" data-required="true" class="form-controltwo required">
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
				<?php */ ?>
				
				<h4 class="proHeadingText">Check-in & Check-out Time</h4>            	    
				<div class="col-sm-3">
				  <label for="reg_input_name" class="req">Check In Time</label>
				  <select name="checkin" id="checkin" data-required="true" class="form-controltwo required">
				    <option value="">--Select Any--</option>
				    <option value="00:00">00:00</option>
				    <option value="01:00">01:00</option>
				    <option value="02:00">02:00</option>
				    <option value="03:00">03:00</option>
				    <option value="04:00">04:00</option>
				    <option value="05:00">05:00</option>
				    <option value="06:00">06:00</option>
				    <option value="07:00">07:00</option>
				    <option value="08:00">08:00</option>
				    <option value="09:00">09:00</option>
				    <option value="10:00">10:00</option>
				    <option value="11:00">11:00</option>
				    <option value="12:00">12:00</option>
				    <option value="13:00">13:00</option>
				    <option value="14:00">14:00</option>
				    <option value="15:00">15:00</option>
				    <option value="16:00">16:00</option>
				    <option value="17:00">17:00</option>
				    <option value="18:00">18:00</option>
				    <option value="19:00">19:00</option>
				    <option value="20:00">20:00</option>
				    <option value="21:00">21:00</option>
				    <option value="22:00">22:00</option>
				    <option value="23:00">23:00</option>
				    </select>
				</div>
				<div class="col-sm-3">
				  <label for="reg_input_name" class="req">Check Out Time</label>
				  <select name="checkout" id="checkout" data-required="true" class="form-controltwo required">
				    <option value="">--Select Any--</option>
				    <option value="00:00">00:00</option>
				    <option value="01:00">01:00</option>
				    <option value="02:00">02:00</option>
				    <option value="03:00">03:00</option>
				    <option value="04:00">04:00</option>
				    <option value="05:00">05:00</option>
				    <option value="06:00">06:00</option>
				    <option value="07:00">07:00</option>
				    <option value="08:00">08:00</option>
				    <option value="09:00">09:00</option>
				    <option value="10:00">10:00</option>
				    <option value="11:00">11:00</option>
				    <option value="12:00">12:00</option>
				    <option value="13:00">13:00</option>
				    <option value="14:00">14:00</option>
				    <option value="15:00">15:00</option>
				    <option value="16:00">16:00</option>
				    <option value="17:00">17:00</option>
				    <option value="18:00">18:00</option>
				    <option value="19:00">19:00</option>
				    <option value="20:00">20:00</option>
				    <option value="21:00">21:00</option>
				    <option value="22:00">22:00</option>
				    <option value="23:00">23:00</option>
				    </select>
				</div>
				
				<div class="col-sm-6">
				  <label for="reg_input_name">Check In- Check Out Text</label>
				  <input value="" type="text" class="form-controltwo required" name="check_in_out_text" id="check_in_out_text">
				</div>
				
				<br class="spacer" />
				
				<div class="col-sm-3">
				  <label for="reg_input_name" class="req">Security Deposit</label>
				  <input value="" type="text" class="form-controltwo required" name="security_deposit" id="security_deposit" data-required="true">
				</div>
				<div class="col-sm-9">
				  <label for="reg_input_name">Security Deposit Text</label>
				  <textarea name="security_deposit_text" id="security_deposit_text" class="form-controltwo" style="width:100%;height:50px"></textarea>
				</div>
				<br class="spacer" />
				
				    <h4 class="proHeadingText">Seasonal Property Rents <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a> </span></h4>
				    <table width="100%" id="tableSeasons">
					<!--<tr>
					    <td>
						<div class="col-sm-12"><legend><b>Default Season</b></legend></div>
						<input name="season_name_default" type="hidden">
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input name="season_daily_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input name="season_weekly_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input name="season_monthly_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input name="minimum_rental_days" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
					    </td>
					</tr>-->
					<tr id="season_0">
					    <td>
						<div class="col-sm-12"><legend><b>Season 1</b> <!--<a href="javascript:void(0);" onclick="removeSeason(0);" style=" float: right;">Remove Season</a>--></legend></div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Name</label>
						  <input value="" name="season_name[]" type="text" class="form-controltwo required seasonName" data-required="true"  id="sesname_0">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <input value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_start_date[]">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						  <input value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_end_date[]">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">-1% Reduction</label>
						  <input value="" name="percent_reduction_1[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">-2% Reduction</label>
						  <input value="" name="percent_reduction_2[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">-3% Reduction</label>
						  <input value="" name="percent_reduction_3[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req"> Is Default Season ?</label>
						  <input value="Yes" name="isDefault[]" checked="checked" type="radio"  class="form-controltwo required seasonDefault" id="sesdefault_0">
						</div>
					    </td>
					</tr>
				    </table>
				    <input type="hidden" name="total_season_count" id="total_season_count" value="1" />
				    <br class="spacer" />  
				    <br class="spacer" />
				    <div class="col-sm-12"><legend><span>Yearly Rate</span></legend></div>
				    <div class="col-sm-4">
				      <label for="reg_input_name" class="req">Yearly Price</label>
				      <input name="season_daily_yearly" type="text" class="form-controltwo required" data-required="true" data-type="number">
				    </div>
				    <br class="spacer" />
				    
				<h4 class="proHeadingText">Additional Information</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name" class="req">Add Notes</label>
				  <textarea name="add_notes" id="add_notes" class="form-controltwo required"></textarea>
				</div>
								
				
				    
				<br class="spacer" />
				
				<div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit" id="btn_property_sales_fieldset">Save and Next</button>
				    <button class="next_skip_continue btn btn-default" type="button" id="next_property_sales_fieldset">Skip and Continue</button>
				</div>
			    </div>
				
				</fieldset>
							    
			    </form>
			    </div>
				
                
				<!--- SALES DIV --->
			    <div id="property_sales_fieldset" style="display:none;" class="property_tag_class">
				<form name="frmPropertySales" id="frm3" enctype="multipart/form-data" method="post" class="parsley_reg_sales" action="<?php echo BACKEND_URL.'property/add_property_sales/';?>"> 
				
				    <input type="hidden" name="property_new_id_sales1" id="property_new_id_sales1" value="" />
				    <input type="hidden" name="property_new_id_sales" id="property_new_id_sales" value="" />				    
				    <input type="hidden" name="action" value="Process">
				    <fieldset>
				    <div class="col-sm-12">
				    <!--<h4>Property Sales</h4>-->
				    <div class="col-sm-12">
					<div class="step_info">
					    <h4>Property Sales</h4>
					    <p>Provide the Property Sales informatione here.</p>
					</div> 
				    </div>
				<br class="spacer" />                            	
				<div class="col-sm-12">
				    <h4 class="proHeadingText">Property Sales Number</h4>
				     <div class="col-sm-3">
					<label for="property_name" class="req">Property Sales #</label>
					<input name="property_sales_serial_no" id="property_sales_serial_no" data-required="true" type="text" class="form-controlone required">
				    </div>
				    
				    <br class="spacer" />
				    
				    <h4 class="proHeadingText">Price information</h4>
				    
				   <!--<div class="col-sm-3">
                                    <label for="sales_price" class="req">Sales Price</label>
                                    <input type="text" class="form-controlone required number" data-type="number" class="form-control" name="sales_price" id="sales_price">
                                </div>-->
                    <div class="col-sm-3">
                        <label for="sales_price_from" class="req">Sales Price <!--Starting From--></label>
                        <input type="text" class="form-controlone required" data-required="true" data-type="number" name="sales_price_from" id="sales_price_from" value="" >
                    </div>
                   <!--<div class="col-sm-3">
                        <label for="sales_price_to" class="req">Sales Price Ending In</label>
                        <input type="text" class="form-controlone" data-type="number"  name="sales_price_to" id="sales_price_to" value="" data-required="true">
                    </div>-->
		   <div class="col-sm-3 checkBox">
			<label for="sales_price">Freehold/Leashold</label>
			<input type="radio" name="hold_type" value="Leasehold" class="form-controlone radion_frm_class" >
			    <span class="radio_lebel">Leasehold</span>
			<input type="radio" name="hold_type" value="Freehold" class="form-controlone radion_frm_class">
			    <span class="radio_lebel">Freehold</span>
		    </div>
		   
                    <br class="spacer" />				
		    <div class="col-sm-12">
			<label for="Freehold/LeaseholdText" class="req">Freehold/Leasehold Text</label>
			<input id="freehold_leasehold_text" name="freehold_leasehold_text" type="text" class="form-controlone" value="">
		    </div>
		    
                                
				
				<br class="spacer" />
				<br class="spacer" />
				<h4 class="proHeadingText">Amenities
				<br>
				<span class="h4-span">Describe the general amenities for your property(sales and rental both) by clicking on the check box next to any amenity that is applicable to your listing. You can add details to any amenity by clicking on the "add details" link to the right of any selected amenity.</span></h4>
				<?php
				$featured_category_name = '';
				if(is_array($sales_amenity)) {
				?>
				
				<div class="col-sm-12">
				    <div class="formPanSec">
					<div class="rightPan">					
					<?php foreach($sales_amenity as $prop_amenity_val) { 
					    if($featured_category_name == $prop_amenity_val['featured_category_name']) {
					    ?>
					    
						<!--<input name="sales_amenities[]" type="checkbox" value="<?php //echo $prop_amenity_val['amenities_id'];?>" />
						<label><?php //echo $prop_amenity_val['amenities_name'];?></label>-->
						
						<div class="col-sm-4">
						    <select name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class_sales">
							<option value="absent" class="redText">Off</option>
							<option value="active" class="greenText">Active</option>
							<option value="inactive" class="blueText">Display</option>
						    </select>
						    <label><?php echo $prop_amenity_val['amenities_name'];?></label>
						</div>
					    
					    <?php
					    }
					    else
					    {
					    ?>
					    <div class="subHeading"><?php echo $prop_amenity_val['featured_category_name'];?></div>
					    <div class="subHeadingInput">
						<!--<input name="sales_amenities[]" type="checkbox" value="<?php //echo $prop_amenity_val['amenities_id'];?>" />
						<label><?php //echo $prop_amenity_val['amenities_name'];?></label>-->
						
						<div class="col-sm-4">
						    <select name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class_sales">
							<option value="absent" class="redText">Off</option>
							<option value="active" class="greenText">Active</option>
							<option value="inactive" class="blueText">Display</option>
						    </select>
						    <label><?php echo $prop_amenity_val['amenities_name'];?></label>
						</div>
						
					    </div>
					    <?php
					    }
					    $featured_category_name = $prop_amenity_val['featured_category_name'];
					    ?>
					
					<?php } ?>
					</div>
				    </div>
				</div>
				<?php
				}
				?>							
                                
				<br class="spacer" />
				
				<h4 class="proHeadingText">Property Sale Description</h4>
                                <div class="col-sm-12">
                                    <label for="sales_price">Sales Description</label>
                                    <textarea name="property_sales_desc" id="wysiwg_editor" class="form-controlone"></textarea>
                                </div>
				<br class="spacer" />
				
                                <h4 class="proHeadingText">Other information</h4>
                                
                                
                                
                                <div class="col-sm-3">
                                    <label for="bedroom_starting_from" class="req">Bedroom <!--Starting From--></label>
                                    <input id="bedroom_starting_from" name="bedroom_starting_from" class="form-controlone required" data-required="true" data-type="number" type="text" value="">
                                </div>
                                
                                <!--<div class="col-sm-3">
                                    <label for="bedroom_ending_to">Bedroom Ending To</label>
                                    <input id="bedroom_ending_to" name="bedroom_ending_to" type="text" class="form-control" value="">
                                </div>-->
				
				<div class="col-sm-3">
                                    <label for="bedroom_starting_from" class="req">Bathroom <!--Starting From--></label>
                                    <input id="bedroom_starting_from" name="bathroom_starting_from" class="form-controlone required" data-required="true" data-type="number" type="text" value="">
                                </div>
                                
                                <!--<div class="col-sm-3">
                                    <label for="bedroom_ending_to">Bathroom Ending To</label>
                                    <input id="bedroom_ending_to" name="bathroom_ending_to" type="text" class="form-control" value="">
                                </div>-->
				
                                <!--<br class="spacer" />-->
				
                                <!--<div class="col-sm-3">
                                    <label for="sleep_starting_from">Sleeps Starting From</label>
                                    <input id="sleep_starting_from" name="sleep_starting_from" type="text" class="form-control" value="">
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="sleep_ending_to">Sleeps Ending To</label>
                                    <input id="sleep_ending_to" name="sleep_ending_to" type="text" class="form-control" value="">
                                </div>-->
                                
				<div class="col-sm-3">
                                    <label for="size_starting_from" class="req">Living Space M<sup>2</sup> <!--Starting From--></label>
                                    <input id="size_starting_from" name="size_starting_from" class="form-controlone required" data-required="true" type="text" value="">
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="size_ending_to" class="req">Constructed Area M<sup>2</sup></label>
                                    <input id="size_ending_to" name="size_ending_to" type="text" class="form-control" value="" data-required="true">
                                </div>
				
				<br class="spacer" />
                                <br class="spacer" />
				
                            	<div class="col-sm-3">
                                	<label for="reg_input_name" class="req">Agent</label>
                                	<select name="agent_id" id="agent_id" data-required="true" class="form-controlone required">
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
                                
                                <br class="spacer" /><br class="spacer" />
                                
                                <div class="col-sm-3">
				    <div class="multiSelectBoxHead"> <label for="indoor_size">Contacts Associated</label></div>
				    <div class="multiSelectBoxInn">
					<a ></a>
					<ul>
					    <?php
					    foreach($arr_contacts as $key)
					    {
					    ?>
					     <li><input name= "contact_id_sales[]" type="checkbox" value="<?php echo $key['contact_id'];?>" /><label><a href="<?php echo BACKEND_URL.'contacts/view_contact_master/'.$key['contact_id']; ?>" target="_blank"><?php echo $key['full_name']; ?></a></label></li>
					    
					    <?php
					    }
					    ?>
					
					</ul>
					
				    </div>
                                </div>
                <br class="spacer" />
				<h4 class="proHeadingText">Development Pages</h4>
                <div class="col-sm-12">
					    <div class="formPanSec">
						<div class="rightPan">						
						    <input name="development_page" id="development_page_1" type="radio" value="1" /><label>1 Unit</label>
						    <input name="development_page" id="development_page_2" type="radio" value="2"  /><label>2 Units</label>
						    <input name="development_page" id="development_page_3" type="radio" value="3" /><label>3 Units</label>
						    <input name="development_page" id="development_page_4" type="radio" value="4" /><label>4 Units</label>
						    <input name="development_page" id="development_page_5" type="radio" value="5" /><label>5 Units</label>
						    <input name="development_page" id="development_page_6" type="radio" value="6" /><label>6 Units</label>
                            <input name="development_page" id="development_page_7" type="radio" value="7" /><label>7 Units</label>
        					<input name="development_page" id="development_page_8" type="radio" value="8" /><label>8 Units</label>
        					<input name="development_page" id="development_page_9" type="radio" value="9" /><label>9 Units</label>
        					<input name="development_page" id="development_page_10" type="radio" value="10" /><label>10 Units</label>
                        </div>
                        </div>
                </div>
                <table id="resp_table2" class="table">
                <thead>
                  <tr>
                  	<th>&nbsp;</th>                 
                    <th>Unit Type<span class="req"></span></th>
                    <!--<th>Unit Number</th>-->
                    <th>Floor</th>
                    <th>Size Sq (Total)</th>
                   <!-- <th>Size Sq (Inside)</th>-->
                    <th>Price (THB)<span class="req"></span></th>
                  </tr>                  
                </thead>
                <tbody id="development_page_contain">
                	<tr id="development_sub_page_1" class="odd dev-pages" style="display:none;">
                    	<td>Rm #1</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_2" class="even dev-pages" style="display:none;">
                    	<td>Rm #2</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_3" class="odd dev-pages" style="display:none;">
                    	<td>Rm #3</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_4" class="even dev-pages" style="display:none;">
                    	<td>Rm #4</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_5" class="odd dev-pages" style="display:none;">
                    	<td>Rm #5</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_6" class="even dev-pages" style="display:none;">
                    	<td>Rm #6</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_7" class="odd dev-pages" style="display:none;">
                    	<td>Rm #7</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_8" class="even dev-pages" style="display:none;">
                    	<td>Rm #8</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_9" class="odd dev-pages" style="display:none;">
                    	<td>Rm #9</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>
                    <tr id="development_sub_page_10" class="even dev-pages" style="display:none;">
                    	<td>Rm #10</td>
                        <td><input type="text" name="dev_page_building[]" value="" class="form-control" data-required="true" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="" class="form-control" data-required="true" /></td>
                    </tr>	
                </tbody>
                </table>
		<div class="col-sm-12">
		    <h4 class="proHeadingText">Enable Floor Plans</h4>
			<table>
				<tr>
					    <td ><input type="radio" name="enable" value="1" class="floor_enable"><span class="radio_lebel">Enable</span>
				    <input type="radio" name="enable" value="0"  class="floor_enable" CHECKED><span class="radio_lebel">Disable</span></td></tr></table>
				</div>
		<div id="upload_floor_pic" style="display:none;">
		    
                 <div class="col-sm-12">
                            	<!--<h4>Property Image</h4>-->
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Floor Plans Image</h4>
					<p>Upload the Floor Plans Images here.</p>
				    </div> 
				</div>
				<br class="spacer" />
				
				<div class="col-sm-12">
				    <table width="100%" cellpadding="2" cellspacing="3" border="1" class="imageListBox">
		
					<tr>
					    <th>Image Name</th>
					    <th>Image Title</th>
					    <th>Image Alt</th>
					    <th>Image Caption</th>
					    <th>Image Tag</th>
					    <th>Order</th>
					   
					</tr>
					<tbody id="uploadPictures1"></tbody>
				    </table>
				    <br class="spacer" /><br class="spacer" />
				    <div id="mulitplefileuploader1">Upload</div>
				    <div id="status1"></div>
				</div>
				</div>
		</div>
				
                              <br class="spacer" />
				
				   <div class="col-sm-12">
<h4 class="proHeadingText">Payment Structure</h4>
				     <textarea name="sales_payment" class="ckeditor" class="form-control"></textarea>
                                </div>
			
                <br class="spacer" />
                        
			<div class="save_div_class">
			    <button class="btn btn-default frm_step_next_button" type="submit">Save and Next</button>
			    <button class="next_skip_continue_button btn btn-default" type="button">Skip and Continue</button>
			</div>
			
			
			    </div>
				    
				    </div>
				    
				    
				    </fieldset>
				    		    
				</form>
			    </div>
                           
			    
			    
                <input type="hidden" name="frm_cnt" id="frm_cnt" value="1" />
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
				<div style="float:right;margin-top:-150px;display:none;" id="div_loader">
				    <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
				</div>
				
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

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('.frm_step_next').click(function (e) {
    var btnId = $(this).attr('id'); 
    var divId = btnId.replace('btn_', ''); //alert(divId);
    var f = $("#frm_cnt").val();
    var submit_url = '';
    e.preventDefault();
    $('.parsley-error-list').remove();
    var isException = false;
    
    
    if(f == 1){
	//$('.form-control.parsley-validated[data-required=true]').each(function(){
	$('.form-control.required').each(function(){
	    var value = $(this).val();
	    if(!value){
		$(this).addClass('parsley-error');
		$(this).after('<ul class="parsley-error-list"><li class="required">This value is required.</li></ul>');
		isException = true;
		
	    }else{
		$(this).removeClass('parsley-error');
		$(this).next('.parsley-error-list').remove();
		if($(this).attr('data-type')=='email'){
		    if(!IsEmail($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid email.</li></ul>');
			isException = true;
		    }
		}
		if($(this).attr('data-type')=='number'){
		    if(!$.isNumeric($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid number.</li></ul>');
			isException = true;
		    }
		}
	    }
	});
    }
    else if(f == 3) {
	$('.form-controltwo.required').each(function(){
	    var value = $(this).val(); //alert(value);
	    if(!value){
		$(this).addClass('parsley-error');
		//$(this).foucs();
		$(this).after('<ul class="parsley-error-list"><li class="required">This value is required.</li></ul>');
		isException = true;
	    }else{
		$(this).removeClass('parsley-error');
		$(this).next('.parsley-error-list').remove();
		if($(this).attr('data-type')=='email'){
		    if(!IsEmail($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid email.</li></ul>');
			isException = true;
		    }
		}
		if($(this).attr('data-type')=='number'){
		    if(!$.isNumeric($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid number.</li></ul>');
			isException = true;
		    }
		}
	    }
	});
    }
        
    else {
	isException = false;
    }
    
    
    if(isException == false){
	var frm_data = '';
	//alert(f);
	if(f == 1) {
	    var frm_data		= $('#frm1').serialize();
	    var propertyDescription	= CKEDITOR.instances.wysiwg_simple.getData();
	    var propertyDirection	= CKEDITOR.instances.wysiwg_editor2.getData();
	    submit_url 			= backend_url + "property/ajax_add_property_information/";
	}
	else if(f == 2) {
	    if($("#property_new_id").val() == '')
	    {
		alert('There is no property id. Please fill up property information.');
		return false;
	    }
	    
	    var frm_data		= '';
	    var frm_data		= $('#frm2').serializeArray();
	    var propertyDescription	= '';
	    var propertyDirection	= '';
	    submit_url 			= backend_url + "property/ajax_add_property_image/";
	    
	}
	
	else if(f == 3) {
	    if($("#property_new_id_rentals").val() == '')
	    {
		alert('There is no property id. Please fill up property information.');
		return false;
	    }
	    var frm_data		= '';
	    var frm_data		= $('#frm4').serialize();
	    //var propertyDescription	= CKEDITOR.instances.wysiwg_editor4.getData();
	    var propertyDirection	= CKEDITOR.instances.wysiwg_editor3.getData();
	    submit_url 			= backend_url + "property/ajax_add_property_rentals/";
	    
	}
	
	/*** checking for new property id ***/
	
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: submit_url,
		data: { form_data: frm_data, property_description:propertyDescription, property_direction:propertyDirection},
		success:function(data) { 
			if(data)
			{
			    $('#save_div_class').hide();
			    $('#div_loader').show();
			    
			    if(f == 1)
			    {
				$("#property_new_id").val(data);
				$("#property_new_id_sales").val(data);
				$("#property_new_id_sales1").val(data);
				$("#property_new_id_rentals").val(data);
				$("#property_new_id_additional").val(data);
			    }
			    			    
			    $(".property_menu").each(function(){
				    $(this).parent().removeClass('active');    
			    });
			    
			    var menuId = divId.replace('fieldset', 'div');
			    $('#' + menuId).parent().addClass('active');
			    
			    $(".property_tag_class").hide();
			    $("#" + divId).show();
			    
			    $('#save_div_class').show();
			    $('#div_loader').hide();
			    
			    f = parseInt(f)+1;
			    $("#frm_cnt").val(f);
			    
			}
		}
	})
    }
    else
    {
	return false;
    }
    
});


$('.form-control').keyup(function(){
    if($(this).hasClass('parsley-error')){
	$(this).removeClass('parsley-error');
	$(this).next('.parsley-error-list').remove();
    }
});

$(".next_skip_continue").click(function(){
	var frm_id = $(this).attr('id');
	
	var menu_name	= frm_id.replace("next_", "");
	$(".property_tag_class").hide();
	$("#" + menu_name).show();
	
	var f = $("#frm_cnt").val();
	f = parseInt(f) + 1;
	$("#frm_cnt").val(f);
});

$(".next_skip_continue_button").click(function(){
    window.location.href = backend_url + 'property/add_property_status/';
})



$(window).load(function(){

	var settings = {
		url:  backend_url + "property/do_image_upload",
		method: "POST",
		allowedTypes:"jpg,png,gif,jpeg",
		fileName: "myfile",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
		    var image_name		= data.replace(/\"/g, '');
		    var arr_image_name		= image_name.split('_');
		    var display_image_name	= arr_image_name[1];		    
		    var str = '<tr id="tr_'+ image_name +'"><td><img src="'+frontend_url+'upload/property/'+ image_name +'" width="50" height="50"><br>'+image_name+'<input type="hidden" name="image_name" value="'+ image_name + '"></td><td><input type="text" name="image_title" class="form-control"></td><td><input type="text" name="image_alt" class="form-control"></td><td><input type="text" name="image_caption" class="form-control"></td><td><input type="text" name="image_tag" class="form-control"></td><td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order" value=""></td><td><input type="radio" name="make_featured" value="'+ image_name +'" class="form-control"></td></tr>';
		    
		    $('#uploadPictures').append(str);
		    $("#status").html("<font color='green'>Upload was successful</font>");
			
		},
		onError: function(files,status,errMsg)
		{		
			$("#status").html("<font color='red'>Uploading is Failed</font>");
		}
	}

	$("#mulitplefileuploader").uploadFile(settings);

	$("#completion_date,.season_start_date,.season_end_date").datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat: 'dd/mm/yy'
	});
	var settings1 = {
		url:  backend_url + "property/do_image_upload1",
		method: "POST",
		allowedTypes:"jpg,png,gif,jpeg",
		fileName: "myfile1",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
		    var image_name		= data.replace(/\"/g, '');
		    var arr_image_name		= image_name.split('_');
		    var display_image_name	= arr_image_name[1];		    
		     var str = '<tr id="tr_'+ image_name +'"><td><img src="'+frontend_url+'upload/floor_image/'+ image_name +'" width="50" height="50"><br>'+image_name+'<input type="hidden" name="image_name1[]" value="'+ image_name + '"></td><td><input type="text" name="image_title1[]" class="form-control"></td><td><input type="text" name="image_alt1[]" class="form-control"></td><td><input type="text" name="image_caption1[]" class="form-control"></td><td><input type="text" name="image_tag1[]" class="form-control"></td><td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order1[]" value=""></td></tr>';
		    
		    $('#uploadPictures1').append(str);
		    $("#status1").html("<font color='green'>Upload was successful</font>");
			
		},
		onError: function(files,status,errMsg)
		{		
			$("#status1").html("<font color='red'>Uploading is Failed</font>");
		}
	}

	$("#mulitplefileuploader1").uploadFile(settings1);
	
});

$(document.body).on('click', '.glyphicon-remove-sign', function(event) {
    var elem = $(this);
    var backend_url	= '<?php echo BACKEND_URL;?>';
    var fileName 	= $(this).attr('id').replace("delete_image_", ""); 
    if (confirm("Are you sure?")) 
    {
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url + "property/ajax_delete_property_image/",
		data: { file_name: fileName},
		success:function(data) { 
			//$("#tr_" + fileName).remove();
			$(elem).parent().parent().parent().hide();
		}
	});
    }
});

$(document.body).on('click', '.icon-star', function(event) {
    var backend_url	= '<?php echo BACKEND_URL;?>';
    var image_name	= $(this).attr('id');
    var delete_id	= image_name.replace("featured_image_", "delete_image_"); 
    
    $("#" + delete_id).hide();
    $("#" + delete_id).parent().hide();
});

var i	=	1;
var j	=	2;

function addMoreCustomFields(){    
    i++;
    $( "#customTable" ).append( $( '<tr><td><div class="col-sm-3"><label for="reg_input_name">Custom Field Name '+ i +'</label><input type="text" name="rent_custom_name[]" id="rent_custom_name_'+ i +'" class="form-control"></textarea></div><div class="col-sm-9"><label for="reg_input_name">Custom Field Value '+ i +'</label><textarea name="rent_custom_value[]" id="rent_custom_value_'+ i +'" class="form-control"></textarea></div></td></tr>' ) );
    $("#rent_custom_field_count").val(i);
}

function addMoreSeasons(){    
 
    $( "#tableSeasons" ).append( $( '<tr><td>&nbsp;</td></tr><tr><td><div class="col-sm-12"><legend><b>Season '+ j +'</b></legend></div><br class="spacer" /><div class="col-sm-3"><label for="reg_input_name" class="req">Season Name</label><input name="season_name[]" type="text" id="sesname_'+j+'" class="form-controltwo required seasonName" data-required="true"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Daily Price</label><input name="season_daily[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Weekly Price</label><input name="season_weekly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Monthly Price</label><input name="season_monthly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season Start Date</label><input name="season_start_date[]" type="text" class="season_start_date form-controltwo required" data-required="true"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season End Date</label><input name="season_end_date[]" type="text" class="season_end_date form-controltwo required" data-required="true"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Minimum Rental Days</label><input name="minimum_rental_days[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">-1% Reduction</label><input name="percent_reduction_1[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><br class="spacer" /><div class="col-sm-3"><label for="reg_input_name" class="req">-2% Reduction</label><input name="percent_reduction_2[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">-3% Reduction</label><input name="percent_reduction_3[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req"> Is Default Season ?</label><input  name="isDefault[]" value="'+j+'" type="radio" class="form-controltwo seasonDefault" id="sesdefault_'+j+'"></div></td></tr>' ) );
    
    $(".season_start_date,.season_end_date").datepicker({
	    changeMonth: true,
	    changeYear: true,
	    dateFormat: 'dd/mm/yy'
	});    
    $("#total_season_count").val(j);
    j++;
}


function setTheDefault(){    
    for(var i = 0; i< j; i++){
	$("#sesdefault_"+i).val($("#sesname_"+i).val());
    }
}

$("#development_name").click(function(){
    if($(this).val() == -1 )
    {
	$("#add_new_development_div").show();
    }
    else
    {
	$("#add_new_development_div").hide();
    }
});    
    
    $(".floor_enable").click(function(){
    
    if($(this).val() == 1 )
    {
	$("#upload_floor_pic").show();
    }
    else  if($(this).val() == 0 )
    {
	$("#upload_floor_pic").hide();
    }
   
    });

$("#add_new_development").click(function(){
		
	var development_name = $("#new_development_name").val();
	if(development_name != '')
	{
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: backend_url + "property/ajax_add_development_name/",
			data: { development_name: development_name},
			success:function(data) {
				
				if(data.response_code == 1)
				{
					alert('Development name added successfully.');
					$("#add_new_development_div").hide();
					$("#development_name").html(data.select_option);
				}
				else if(data.response_code == 2)
				{
					alert('Problem in adding. Please try again later.');
					return false;
				}
				else
				{
					alert('Duplicate name not allowed');
					return false;
				}
				//$("#tr_id_" + property_image_id).remove();
			}
		});
	}
	else
	{
		alert('Development Name is empty');
		$("#new_development_name").focus();
		return false;
	}
	
});

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

$("#owner_is_manager").click(function(){
    if($(this).is(':checked')){
	 
	var phonesecond = $("#phone_no_second").val();
	$("#manager_contact_number2").val(phonesecond);
	$("#manager_contact_number2").attr('readonly', true);
	var manager = $("#ownername").text();
	
	$("#property_manager_name").val(manager);
	$("#property_manager_name").attr('readonly', true);
	
	var phoneone = $("#phone_no_one").val();
	$("#manager_contact_number1").val(phoneone);
	$("#manager_contact_number1").attr('readonly', true);
	
	var email = $("#email").val();
	$("#manager_email").val(email);
	$("#manager_email").attr('readonly', true);
	
	$("#manager_salutations").val($("#mr_mrs").val());
	$("#manager_salutations").attr('readonly', true);

	var lang_id = $("#lang_id").val();
	
	var lang_id_arr = lang_id.split(",");
	$( ".manager_lang_class" ).each(function(){
	   cur_lang = $(this).val();
	   for (var i=0;i<lang_id_arr.length;i++)
	    {
		//alert(lang_id_arr[i]+'--'+cur_lang);
		if(lang_id_arr[i] == cur_lang){
		    $(this).prop("checked", true);
		    continue;
		}
	    }      
	});
	
    } else {
	$("#manager_salutations").attr('readonly', false);
	$("#manager_salutations").val("");
	$("#property_manager_name").attr('readonly', false);
	$("#property_manager_name").val("");
	
	$("#manager_email").attr('readonly', false);
	$("#manager_email").val("");
	$("#manager_contact_number1").attr('readonly', false);
	$("#manager_contact_number1").val("");
	$("#manager_contact_number2").attr('readonly', false);
	$("#manager_contact_number2").val("");
	
	$(".manager_lang_class").removeAttr("disabled");
	$(".manager_lang_class" ).prop("checked", false);
    }
   
});


$('#development_page_1').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
	}
});
$('#development_page_2').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
	}
});
$('#development_page_3').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
	}
});
$('#development_page_4').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
	}
});
$('#development_page_5').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
	}
});
$('#development_page_6').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
		$('#development_sub_page_6').fadeIn();
	}
});
$('#development_page_7').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
		$('#development_sub_page_6').fadeIn();
		$('#development_sub_page_7').fadeIn();
	}
});
$('#development_page_8').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
		$('#development_sub_page_6').fadeIn();
		$('#development_sub_page_7').fadeIn();
		$('#development_sub_page_8').fadeIn();
	}
});
$('#development_page_9').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
		$('#development_sub_page_6').fadeIn();
		$('#development_sub_page_7').fadeIn();
		$('#development_sub_page_8').fadeIn();
		$('#development_sub_page_9').fadeIn();
	}
});
$('#development_page_10').click(function(){
	if($(this).is(':checked')){
		$('.dev-pages').hide();
		$('#development_sub_page_1').fadeIn();
		$('#development_sub_page_2').fadeIn();
		$('#development_sub_page_3').fadeIn();
		$('#development_sub_page_4').fadeIn();
		$('#development_sub_page_5').fadeIn();
		$('#development_sub_page_6').fadeIn();
		$('#development_sub_page_7').fadeIn();
		$('#development_sub_page_8').fadeIn();
		$('#development_sub_page_9').fadeIn();
		$('#development_sub_page_10').fadeIn();
	}
});

$('.frm_step_next_button').click(function(){
   var cnt = 1;
   
   $('.form-controlone.required').each(function(){ 
	    var value = $(this).val();
	    if(value.trim() == ''){
		$(this).addClass('parsley-error');
		//$(this).foucs();
		$(this).after('<ul class="parsley-error-list"><li class="required">This value is required.</li></ul>');
		cnt = 0;
	    }else{
		$(this).removeClass('parsley-error');
		$(this).next('.parsley-error-list').remove();
		if($(this).attr('data-type')=='email'){
		    if(!IsEmail($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid email.</li></ul>');
			cnt = 0;
		    }
		}
		if($(this).attr('data-type')=='number'){
		    if(!$.isNumeric($(this).val())){
			$(this).addClass('parsley-error');
			//$(this).foucs();
			$(this).after('<ul class="parsley-error-list"><li class="required">This value should be a valid number.</li></ul>');
			cnt = 0;
		    }
		}
	    }
	});
   
	if(cnt)
	{
	    return true;    
	}
	else
	{
	    return false;
	}
});
</script>

<script>
$(document).ready(function() {
    $('#blockdates_container').multiDatesPicker({
	dateFormat: "dd-mm-yy",
	numberOfMonths: [2,4],
	altField: '#unavailable_date',
	minDate: 0,
    }); 
});

$(document).ready(function(){
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
    
    var cFlag   = 0;
    $('.amenity_class').data('pre', $(this).val());
    $(".amenity_class").change(function(){
	
	var ddPrevValue		= $(this).data('pre');
	var ddCurrentValue	= $(this).val();
	
	if(ddPrevValue == '' || ddPrevValue == 'absent')
	{
	    if(ddCurrentValue != 'absent')
	    {
		if(cFlag > 23)
		{
		    $(this).val('absent');
		    alert('You can not select more than 24 amenities');
		}
		else
		{
		    cFlag++;
		    $(this).data('pre', $(this).val());//update the pre data
		}
	    }
	}
	else
	{
	    if(ddCurrentValue != 'absent')
	    {
		//nothing to do
	    }
	    else
	    {
		cFlag--;
		$(this).data('pre', $(this).val());//update the pre data
	    }
	}
    });
    
    
    var cFlag1   = 0;
    $('.amenity_class_sales').data('pre', $(this).val());
    $(".amenity_class_sales").change(function(){
	
	var ddPrevValue1		= $(this).data('pre');
	var ddCurrentValue1	= $(this).val();
	
	if(ddPrevValue1 == '' || ddPrevValue1 == 'absent')
	{
	    if(ddCurrentValue1 != 'absent')
	    {
		if(cFlag1 > 23)
		{
		    $(this).val('absent');
		    alert('You can not select more than 24 amenities');
		}
		else
		{
		    cFlag1++;
		    $(this).data('pre', $(this).val());//update the pre data
		}
	    }
	}
	else
	{
	    if(ddCurrentValue1 != 'absent')
	    {
		//nothing to do
	    }
	    else
	    {
		cFlag1--;
		$(this).data('pre', $(this).val());//update the pre data
	    }
	}
    });
    
    
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
    
    $('.amenity_class_sales').each(function(){
	
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
    
    
    $('.amenity_class_sales').change(function(){
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
</script>