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
    <div class="nNote nFailure" style="width: 600px;"> <?php echo validation_errors('<p>', '</p>'); ?> </div>
  </div>
  <?php } ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Edit Property - First Step</h4>
        </div>
        <div class="panel-body">
          <form method="post" action="<?php echo $form_submit_url;?>" class="main" enctype="multipart/form-data" id="parsley_reg">
            <input type="hidden" name="action" value="Process">
            <div class="form_sep">
              <label for="reg_input_name" class="req">Property Name</label>
              <input type="text" class="form-control required icheck" name="property_name" id="property_name" value="<?php echo $arr_property['property_name'];?>">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Property Type</label>
              <?php if(is_array($arr_property_type)) { ?>
              <select name="property_type" id="property_type" class="required form-control">
                <?php foreach($arr_property_type as $key){?>
                <option value="<?php echo $key['property_type_id'];?>" <?php if($key['property_type_id'] == $arr_property['property_type_id']) {?>selected<?php } ?>><?php echo $key['property_name'];?></option>
                <?php } ?>
              </select>
              <?php } ?>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Owner</label>
              <?php if(is_array($arr_owner)) { ?>
              <select name="property_owner" id="property_owner" class="required form-control">
                <?php foreach($arr_owner as $key){?>
                <option value="<?php echo $key['owner_id'];?>" <?php if($key['owner_id'] == $arr_property['owner_id']) {?>selected<?php } ?>><?php echo $key['owner_name'];?></option>
                <?php } ?>
              </select>
              <?php } ?>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Unit Number</label>
              <input type="text" name="unit_number" id="unit_number" value="<?php echo $arr_property['unit_number']?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Latitude</label>
              <input type="text" name="latitude" id="latitude" value="<?php echo $arr_property['latitude']?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Longitude</label>
              <input type="text" name="longitude" id="longitude" value="<?php echo $arr_property['longitude']?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Region</label>
              <select name="region" id="region" class="required form-control">
                <?php foreach($arr_region as $key){?>
                <option value="<?php echo $key['region_id'];?>" <?php if($key['region_id'] == $arr_property['region_id']) { ?>selected<?php } ?>><?php echo $key['region_name'];?></option>
                <?php } ?>
                </option>
              </select>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Bedrooms</label>
              <input type="text" name="bedrooms" id="bedrooms" value="<?php echo $arr_property['bedrooms'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Sleeps</label>
              <input type="text" name="sleeps" id="sleeps" value="<?php echo $arr_property['sleeps'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Bathrooms</label>
              <input type="text" name="bathrooms" id="bathrooms" value="<?php echo $arr_property['bathrooms'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Total Size</label>
              <input type="text" name="total_size" id="total_size" value="<?php echo $arr_property['total_size'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Indoor Size</label>
              <input type="text" name="indoor_size" id="indoor_size" value="<?php echo $arr_property['indoor_size'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Outdoor Size</label>
              <input type="text" name="outdoor_size" id="outdoor_size" value="<?php echo $arr_property['outdoor_size'];?>" class="required form-control">
            </div>
            <?php
			    $arr_views = explode(',', $arr_property['view_id']);
			    ?>
            <div class="form_sep">
              <label for="reg_input_name" class="req">View</label>
              <select name="view[]" id="view" class="required form-control" multiple="multiple">
                <?php foreach($arr_viwes as $key){?>
                <option value="<?php echo $key['view_type_id'];?>" <?php if(in_array($key['view_type_id'], $arr_views, TRUE)){?>selected<?php } ?>><?php echo $key['view_type_name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Furnished</label>
              <input type="radio" name="furnished" id="furnished_yes" value="Yes" <?php if($arr_property['furnished'] == 'Yes') {?> checked <?php } ?> class="required form-control radion_frm_class">
              <span class="radio_lebel">Yes</span>
              <input type="radio" name="furnished" id="furnished_no" value="Yes" <?php if($arr_property['furnished'] == 'No') {?> checked <?php } ?> class="required form-control radion_frm_class">
              <span class="radio_lebel">No</span>
              <input type="radio" name="furnished" id="furnished_part" value="Part" <?php if($arr_property['furnished'] == 'Part') {?> checked <?php } ?> class="required form-control radion_frm_class">
              <span class="radio_lebel">Part</span> </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Floor</label>
              <input type="text" name="floor" id="floor" value="<?php echo $arr_property['floor'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="">Storeys</label>
              <input type="text" name="storeys" id="storeys" value="<?php echo $arr_property['storeys'];?>" class="form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="">Development Name</label>
              <input type="text" name="development_name" id="development_name" value="<?php echo $arr_property['development_name'];?>" class="form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="">Developer Name</label>
              <input type="text" name="developer_name" id="developer_name" value="<?php echo $arr_property['developer_name'];?>" class="form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Off Plan</label>
              <input type="radio" name="off_plan" id="off_plan_yes" value="Yes" <?php if($arr_property['off_plan'] == 'Yes') {?> checked <?php } ?> class="required form-control radion_frm_class">
              <span class="radio_lebel">Yes</span>
              <input type="radio" name="off_plan" id="off_plan_no" value="No" <?php if($arr_property['off_plan'] == 'No') {?> checked <?php } ?> class="required form-control radion_frm_class">
              <span class="radio_lebel">No</span> </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Completion Date</label>
              <div data-date-autoclose="true" data-date-format="dd-mm-yyyy" class="input-group date ebro_datepicker">
                <input type="text" class="form-control" name="completion_date" id="completion_date" value="<?php echo date("m-d-Y", strtotime($arr_property['completion_date']));?>">
                <span class="input-group-addon"><i class="icon-calendar"></i></span> </div>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Distance from Airport</label>
              <input type="text" name="distance_from_airport" id="distance_from_airport" value="<?php echo $arr_property['distance_from_airport'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Distance from Beach</label>
              <input type="text" name="distance_from_beach" id="distance_from_beach" value="<?php echo $arr_property['distance_from_beach'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Distance from Patong</label>
              <input type="text" name="distance_from_patong" id="distance_from_patong" value="<?php echo $arr_property['distance_from_patong'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Page Title</label>
              <input type="text" name="page_title" id="page_title" value="<?php echo $arr_property['page_title'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Optional Title</label>
              <input type="text" name="optional_title" id="optional_title" value="<?php echo $arr_property['optional_title'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">SEO Title</label>
              <input type="text" name="seo_title" id="seo_title" value="<?php echo $arr_property['seo_title'];?>" class="required form-control">
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Property Description</label>
              <textarea id="wysiwg_editor" name="property_description" class="required form-control"><?php echo $arr_property['property_description'];?></textarea>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Local Information</label>
              <textarea class="form-control" rows="3" cols="10" id="local_information" name="local_information" class="required form-control"><?php echo $arr_property['local_information'];?></textarea>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Meta Description</label>
              <input type="text" name="meta_description" id="meta_description" value="<?php echo $arr_property['meta_description'];?>" class="required form-control">
            </div>
            <?php
			    $arr_amenity = explode(',', $arr_property['amenities_id']);
			    //pr($arr_amenity);
			    ?>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Amenities</label>
              <select name="amenities[]" id="amenities" class="required form-control" multiple="multiple">
                <?php foreach($arr_amenities as $key){?>
                <option value="<?php echo $key['amenities_id'];?>" <?php if(in_array($key['amenities_id'], $arr_amenity, TRUE)) {?>selected<?php } ?>><?php echo $key['amenities_name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form_sep">
              <label for="reg_input_name" class="req">Status</label>
              <input type="radio" name="status" value="Active" <?php if($arr_property['status'] == 'active') { ?>checked<?php } ?> class="required form-control radion_frm_class inactive_status">
              <span class="radio_lebel">Active</span>
              <input type="radio" name="status" value="Inactive" <?php if($arr_property['status'] == 'inactive') { ?>checked<?php } ?> class="required form-control radion_frm_class inactive_status">
              <span class="radio_lebel">Inactive</span> </div>
            <?php
			    $dispaly_option 	= 'none;';
			    $why_not_live	= '';
			    if($arr_property['status'] == 'inactive') {
				$dispaly_option = 'block;';
				$why_not_live	= $arr_property['why_not_live'];
			    }
			    ?>
            <div class="form_sep" style="display:<?php echo $dispaly_option;?>;" id="why_not_live_div">
              <label for="reg_input_name">Why not Live?</label>
              <textarea name="why_not_live" id="why_not_live" class="form-control"><?php echo $why_not_live;?></textarea>
            </div>
            <div class="form_sep">
              <button class="btn btn-default" type="submit">Next</button>
              <button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--End : Main content--> 
</div>
