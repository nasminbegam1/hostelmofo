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
		<?php } ?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
                	
                    <ul class="property_tab">
                        <li><a id="property_information_div" class="property_menu" href="<?php echo BACKEND_URL;?>property/edit_property_information/<?php echo $property_id;?>/<?php echo $page;?>">Property Information</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_image/<?php echo $property_id;?>/<?php echo $page;?>">Property Image</a></li>
                        <li class="active"><a>Property Rentals</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_sales/<?php echo $property_id;?>/<?php echo $page;?>">Property Sales</a></li>
			<!--<li><a href="<?php echo BACKEND_URL;?>property/edit_property_additional_info/<?php echo $property_id;?>/<?php echo $page;?>">Property Additional Information</a></li>-->
		    </ul>
                    <div class="clear"></div>
			    
                    	<div id="property_rentals_fieldset" class="property_tag_class">
			    
			    <form name="frmPropertyRental" id="frm4" enctype="multipart/form-data" method="post" class="parsley_reg" action="<?php echo BACKEND_URL;?>property/edit_property_rentals/<?php echo $property_id;?>/<?php echo $page;?>">
				
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Property Rental</h4>
					<p>Provide the Property Rental Information here.</p>
				    </div> 
				</div>
				<br class="spacer" />
				
				<input type="hidden" name="action" value="Process">
				<fieldset>
				    
				<div class="col-sm-12">
				   <h4 class="proHeadingText">Property Rental Number</h4>
				    <div class="col-sm-3">
					<label for="property_name" class="req">Property Rental #</label>
					<input value="<?php echo stripslashes(trim($arr_property_rental[0]['property_rental_serial_no']));?>" name="property_rental_serial_no" id="property_rental_serial_no" type="text" class="form-controltwo">
				    </div>
				    <br class="spacer" /> 
				    <!--<h4 class="proHeadingText">Deposit and Payments Information</h4>
				<div class="col-sm-6">
				  <label for="reg_input_name" class="req">Security Deposit</label>
				  <input value="<?php echo stripslashes(trim($arr_property_rental[0]['security_deposite']));?>" type="text" class="form-controltwo required" name="security_deposit" id="security_deposit" data-required="true" data-type="number">
				</div>
				<div class="col-sm-6">
				  <label for="reg_input_name" class="req">Security Percent/Fixed Amount</label>
				  <select name="security_type" id="security_type" class="form-controltwo required" data-required="true">
				    <option value="">--Select Any--</option>
				    <option value="percent" <?php if($arr_property_rental[0]['security_type'] == 'percent'){?> selected <?php } ?>>Percentage</option>
				    <option value="fixed" <?php if($arr_property_rental[0]['security_type'] == 'fixed'){?> selected <?php } ?>>Fixed Amount (in Baht)</option>
				  </select>
				</div>
				
				<br class="spacer" />
				
				<div class="col-sm-6">
				  <label for="reg_input_name" class="req">Property Mark Up Price</label>
				  <input value="<?php echo stripslashes($arr_property_rental[0]['rental_mark_up_percent']);?>" type="text" class="form-controltwo" name="rental_mark_up_percent" id="rental_mark_up_percent" data-type="number">
				</div>				
				<br class="spacer" />
				
				<h4 class="proHeadingText">Payment and Extra Person Charge Information</h4>            	    
				
				<div class="col-sm-6">
				  <label for="reg_input_name">Number of Checks/Payments</label>
				  <input type="text" class="form-control" name="no_of_cheques_payment" id="no_of_cheques_payment" data-type="number" value="<?php echo $arr_property_rental[0]['no_of_cheques_payment'];?>">
				</div>
				
				<div class="col-sm-6">
				  <label for="reg_input_name">Extra Daily Charge Per Person (in baht)</label>
				  <input type="text" value="<?php echo $arr_property_rental[0]['daily_charge_person_extra'];?>" class="form-controltwo" name="daily_charge_person_extra" id="daily_charge_person_extra" data-type="number">
				</div>
				<div class="col-sm-6">
				  <label for="reg_input_name">Extra Charge for serving food and drink </label>
				  <input type="text" class="form-control" name="extra_charge_serving_food" id="extra_charge_serving_food" value="<?php echo stripslashes(trim($arr_property_rental[0]['extra_charge_serving_food']));?>">
				</div>
				<br class="spacer" />
				<br class="spacer" />
				<div class="col-sm-12">
				  <label for="reg_input_name">Additional Information</label>
				  <textarea class="form-controltwo" name="extra_text_info" id="extra_text_info" style="height:75px"><?php echo stripslashes(trim($arr_property_rental[0]['extra_text_info']));?></textarea>
				</div>
				-->
				<br class="spacer" />
				
				<h4 class="proHeadingText">Cancellation and Unavailabilty Information</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name" class="req">Cancellation Policy for booking</label>
				  <!--<textarea name="cancellation_policy" id="wysiwg_editor1" data-required="true" class="form-control"><?php //echo stripslashes(trim($arr_property_rental[0]['cancellation_policy']));?></textarea>-->
				  Flexible <input type="radio" name="cancellation_policy" value="Flexible" <?php if($arr_property_rental[0]['cancellation_policy'] == 'Flexible'){ echo 'checked="checked"';} ?> /> &nbsp;&nbsp;
				  Moderate <input type="radio" name="cancellation_policy" value="Moderate" <?php if($arr_property_rental[0]['cancellation_policy'] == 'Moderate'){ echo 'checked="checked"';} ?> /> &nbsp;&nbsp;
				  Strict <input type="radio" name="cancellation_policy" value="Strict" <?php if($arr_property_rental[0]['cancellation_policy'] == 'Strict'){ echo 'checked="checked"';} ?> /> &nbsp;&nbsp;
				  Super Strict <input type="radio" name="cancellation_policy" value="SuperStrict" <?php if($arr_property_rental[0]['cancellation_policy'] == 'SuperStrict'){ echo 'checked="checked"';} ?> /> &nbsp;&nbsp;
				  Long Term <input type="radio" name="cancellation_policy" value="LongTerm" <?php if($arr_property_rental[0]['cancellation_policy'] == 'LongTerm'){ echo 'checked="checked"';} ?> /> 
				</div>
				<br class="spacer" />				
				
				<h4 class="proHeadingText">Unavailable Dates</h4>
				<div class="col-sm-12">
					<label class="req">Select Dates</label>
					<div id="blockdates_container"></div>
					<!--<div id="booked_dts"><?php echo $str_booked_dates; ?></div>-->
					<input type="hidden" name="unavailable_date" id="unavailable_date" value="<?php echo $str_unavailable_dates;?>" readonly />
					<input type="hidden" name="booked_date" id="booked_date" value="<?php echo $str_booked_dates;?>" readonly />
                                </div>
				
				<br class="spacer" />
				
				<h4 class="proHeadingText">Amenities
				<br>
				<span class="h4-span">Describe the amenities for your property by clicking on the check box next to any amenity that is applicable to your listing. You can add details to any amenity by clicking on the "add details" link to the right of any selected amenity.</span></h4>
				
				<?php
				//pr($arr_prop_amenity,0);
				$amenities_text = array();
				if($arr_property_rental[0]['amenities_inputbox_values'] != ''){
				    $amenities_inputbox_values =  explode('#$',$arr_property_rental[0]['amenities_inputbox_values']);
				    foreach($amenities_inputbox_values as $temp){
					$v1 = explode('||',$temp);
					if($v1 && is_array($v1)){
					    $amenities_text[$v1[0]] = $v1[1];
					}
				    }
				}
				else
				    $amenities_text = array();
				    
				$amenity_arr = explode(',', $arr_property_rental[0]['amenities_id']);
				//pr($amenity_arr,0);
				if( !empty($amenity_arr) && is_array($amenity_arr) ){
				    $amm_arr = array();
				    foreach($amenity_arr as $key => $val ){
					if($val != ''){
					    $tt = explode('::',$val);
					    if(is_array($tt) && isset($tt[0]) && isset($tt[1]) ){
						$amm_arr[$tt[0]] = $tt[1];
					    }
					}
				    }
				}
				else
				    $amm_arr = array();
				//pr($amm_arr,0);
				$featured_category_name = '';
				if(is_array($arr_prop_amenity))
				{
				    
				?>
				
				<div class="col-sm-12">
				    <div class="formPanSec"><input type="hidden" id="amenity_value_count" value="<?php echo count($amm_arr);?>">
					<div class="rightPan">
					<?php foreach($arr_prop_amenity as $prop_amenity_val)
					{ 
					    if($featured_category_name == $prop_amenity_val['featured_category_name'])
					    {
						if($prop_amenity_val['amenities_input'] == 'checkbox'){
					    ?>
						<div class="col-sm-4">
						<select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" id="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
						    <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
						    
						    <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
						    
						    <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
						</select>
						<label><?php echo $prop_amenity_val['backend_amenities_name'];?></label>
						</div>
					    <?php
						} else { ?>
						    <div class="col-sm-4"><label><?php echo $prop_amenity_val['backend_amenities_name'];?></label><input class="form-controltwo" name="rental_amenities_text[<?php echo $prop_amenity_val['amenities_id']; ?>]" type="text" value="<?php if(isset($amenities_text[$prop_amenity_val['amenities_id']])){ echo stripslashes($amenities_text[$prop_amenity_val['amenities_id']]); } ?>" /></div>
						<?php }
					    }
					    else
					    {
					    ?>
					    <div class="subHeading"><?php echo $prop_amenity_val['featured_category_name'];?></div>
					    <div class="subHeadingInput">
						<?php if($prop_amenity_val['amenities_input'] == 'checkbox'){ ?>
						<?php /* ?><input name="rental_amenities[]" type="checkbox" <?php if(in_array($prop_amenity_val['amenities_id'],$amenity_arr)){?>checked<?php } ?> value="<?php echo $prop_amenity_val['amenities_id'];?>" /><?php */ ?>
						<div class="col-sm-4">
						<select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" id="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
						    <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
						    <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
						    <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
						</select>
						<label><?php echo $prop_amenity_val['backend_amenities_name'];?></label>
						</div>
						<?php
						} else { ?>
						    <div class="col-sm-4"><label><?php echo $prop_amenity_val['backend_amenities_name'];?></label><input class="form-controltwo" name="rental_amenities_text[<?php echo $prop_amenity_val['amenities_id']; ?>]" type="text" value="<?php if(isset($amenities_text[$prop_amenity_val['amenities_id']])){ echo stripslashes($amenities_text[$prop_amenity_val['amenities_id']]); } ?>" /></div>
						<?php } ?>
					    </div>
					    <?php
					    }
					    $featured_category_name = $prop_amenity_val['featured_category_name'];
					    ?>
					
					<?php
					} ?>
					</div>
				    </div>
				</div>
				<?php
				}
				?>
				
				<br class="spacer" />
				<div class="col-sm-12">
				    <div class="formPanSec">
					<div class="rightPan">
					    <div class="subHeading">Rental Information</div>
					    <div class="subHeadingInput">
						<textarea class="form-control" id="wysiwg_editor2" name="property_amenity_text"><?php echo stripslashes(trim($arr_property_rental[0]['property_amenity_text']));?></textarea>
					    </div>
					</div>
				    </div>
				</div>
				
				<br class="spacer" />
				<?php $rental_arr = explode(',', $arr_property_rental[0]['contact_id']);?>
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
						 <li><input name = "contact_id[]" type="checkbox" value="<?php echo $key['contact_id'];?>" <?php if(in_array($key['contact_id'],$rental_arr)){?>checked<?php } ?> /><label><a href="<?php echo BACKEND_URL.'contacts/view_contact_master/'.$key['contact_id']; ?>" target="_blank"><?php echo $key['full_name']; ?></a></label></li>
						
						<?php
						}
						?>
					    
					    </ul>
					</div>
				    </div>
				</div>
				<br class="spacer" />
				
				<?php /* ?><div class="col-sm-6">
				  <label for="reg_input_name" class="req">Agent</label>
				  <select name="agent_id" id="agent_id" data-required="true" class="form-controltwo required">
				    <option value=""> Please Select </option>
				    <?php
				    if(is_array($arr_agent)) {
					foreach($arr_agent as $key) {
				    ?>
				    <option value="<?php echo $key['admin_id'];?>" <?php if($key['admin_id'] == $arr_property_rental[0]['agent_id']){?>selected<?php } ?>><?php echo $key['agent_name'];?></option>
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
					<option value="<?php echo $task['task_id'];?>" <?php if($task['task_id'] == $arr_property_rental[0]['task_id']){?>selected<?php } ?>><?php echo $task['task_name'];?></option>
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
				    <option value="00:00" <?php if($arr_property_rental[0]['checkin'] == 00.00){?>selected<?php } ?>>00:00</option>
				    <option value="01:00" <?php if($arr_property_rental[0]['checkin'] == 01.00){?>selected<?php } ?>>01:00</option>
				    <option value="02:00" <?php if($arr_property_rental[0]['checkin'] == 02.00){?>selected<?php } ?>>02:00</option>
				    <option value="03:00" <?php if($arr_property_rental[0]['checkin'] == 03.00){?>selected<?php } ?>>03:00</option>
				    <option value="04:00" <?php if($arr_property_rental[0]['checkin'] == 04.00){?>selected<?php } ?>>04:00</option>
				    <option value="05:00" <?php if($arr_property_rental[0]['checkin'] == 05.00){?>selected<?php } ?>>05:00</option>
				    <option value="06:00" <?php if($arr_property_rental[0]['checkin'] == 06.00){?>selected<?php } ?>>06:00</option>
				    <option value="07:00" <?php if($arr_property_rental[0]['checkin'] == 07.00){?>selected<?php } ?>>07:00</option>
				    <option value="08:00" <?php if($arr_property_rental[0]['checkin'] == 08.00){?>selected<?php } ?>>08:00</option>
				    <option value="09:00" <?php if($arr_property_rental[0]['checkin'] == 09.00){?>selected<?php } ?>>09:00</option>
				    <option value="10:00" <?php if($arr_property_rental[0]['checkin'] == 10.00){?>selected<?php } ?>>10:00</option>
				    <option value="11:00" <?php if($arr_property_rental[0]['checkin'] == 11.00){?>selected<?php } ?>>11:00</option>
				    <option value="12:00" <?php if($arr_property_rental[0]['checkin'] == 12.00){?>selected<?php } ?>>12:00</option>
				    <option value="13:00" <?php if($arr_property_rental[0]['checkin'] == 13.00){?>selected<?php } ?>>13:00</option>
				    <option value="14:00" <?php if($arr_property_rental[0]['checkin'] == 14.00){?>selected<?php } ?>>14:00</option>
				    <option value="15:00" <?php if($arr_property_rental[0]['checkin'] == 15.00){?>selected<?php } ?>>15:00</option>
				    <option value="16:00" <?php if($arr_property_rental[0]['checkin'] == 16.00){?>selected<?php } ?>>16:00</option>
				    <option value="17:00" <?php if($arr_property_rental[0]['checkin'] == 17.00){?>selected<?php } ?>>17:00</option>
				    <option value="18:00" <?php if($arr_property_rental[0]['checkin'] == 18.00){?>selected<?php } ?>>18:00</option>
				    <option value="19:00" <?php if($arr_property_rental[0]['checkin'] == 19.00){?>selected<?php } ?>>19:00</option>
				    <option value="20:00" <?php if($arr_property_rental[0]['checkin'] == 20.00){?>selected<?php } ?>>20:00</option>
				    <option value="21:00" <?php if($arr_property_rental[0]['checkin'] == 21.00){?>selected<?php } ?>>21:00</option>
				    <option value="22:00" <?php if($arr_property_rental[0]['checkin'] == 22.00){?>selected<?php } ?>>22:00</option>
				    <option value="23:00" <?php if($arr_property_rental[0]['checkin'] == 23.00){?>selected<?php } ?>>23:00</option>
				    </select>
				</div>
				<div class="col-sm-3">
				  <label for="reg_input_name" class="req">Check Out Time</label>
				  <select name="checkout" id="checkout" data-required="true" class="form-controltwo required">
				    <option value="">--Select Any--</option>
				    <option value="00:00" <?php if($arr_property_rental[0]['checkout'] == 00.00){?>selected<?php } ?>>00:00</option>
				    <option value="01:00" <?php if($arr_property_rental[0]['checkout'] == 01.00){?>selected<?php } ?>>01:00</option>
				    <option value="02:00" <?php if($arr_property_rental[0]['checkout'] == 02.00){?>selected<?php } ?>>02:00</option>
				    <option value="03:00" <?php if($arr_property_rental[0]['checkout'] == 03.00){?>selected<?php } ?>>03:00</option>
				    <option value="04:00" <?php if($arr_property_rental[0]['checkout'] == 04.00){?>selected<?php } ?>>04:00</option>
				    <option value="05:00" <?php if($arr_property_rental[0]['checkout'] == 05.00){?>selected<?php } ?>>05:00</option>
				    <option value="06:00" <?php if($arr_property_rental[0]['checkout'] == 06.00){?>selected<?php } ?>>06:00</option>
				    <option value="07:00" <?php if($arr_property_rental[0]['checkout'] == 07.00){?>selected<?php } ?>>07:00</option>
				    <option value="08:00" <?php if($arr_property_rental[0]['checkout'] == 08.00){?>selected<?php } ?>>08:00</option>
				    <option value="09:00" <?php if($arr_property_rental[0]['checkout'] == 09.00){?>selected<?php } ?>>09:00</option>
				    <option value="10:00" <?php if($arr_property_rental[0]['checkout'] == 10.00){?>selected<?php } ?>>10:00</option>
				    <option value="11:00" <?php if($arr_property_rental[0]['checkout'] == 11.00){?>selected<?php } ?>>11:00</option>
				    <option value="12:00" <?php if($arr_property_rental[0]['checkout'] == 12.00){?>selected<?php } ?>>12:00</option>
				    <option value="13:00" <?php if($arr_property_rental[0]['checkout'] == 13.00){?>selected<?php } ?>>13:00</option>
				    <option value="14:00" <?php if($arr_property_rental[0]['checkout'] == 14.00){?>selected<?php } ?>>14:00</option>
				    <option value="15:00" <?php if($arr_property_rental[0]['checkout'] == 15.00){?>selected<?php } ?>>15:00</option>
				    <option value="16:00" <?php if($arr_property_rental[0]['checkout'] == 16.00){?>selected<?php } ?>>16:00</option>
				    <option value="17:00" <?php if($arr_property_rental[0]['checkout'] == 17.00){?>selected<?php } ?>>17:00</option>
				    <option value="18:00" <?php if($arr_property_rental[0]['checkout'] == 18.00){?>selected<?php } ?>>18:00</option>
				    <option value="19:00" <?php if($arr_property_rental[0]['checkout'] == 19.00){?>selected<?php } ?>>19:00</option>
				    <option value="20:00" <?php if($arr_property_rental[0]['checkout'] == 20.00){?>selected<?php } ?>>20:00</option>
				    <option value="21:00" <?php if($arr_property_rental[0]['checkout'] == 21.00){?>selected<?php } ?>>21:00</option>
				    <option value="22:00" <?php if($arr_property_rental[0]['checkout'] == 22.00){?>selected<?php } ?>>22:00</option>
				    <option value="23:00" <?php if($arr_property_rental[0]['checkout'] == 23.00){?>selected<?php } ?>>23:00</option>
				    </select>
				</div>
				
				<div class="col-sm-6">
				  <label for="reg_input_name">Check In- Check Out Text</label>
				  <input value="<?php echo stripslashes(trim($arr_property_rental[0]['check_in_out_text']));?>" type="text" class="form-controltwo required" name="check_in_out_text" id="check_in_out_text">
				</div>
				
				<br class="spacer" />
				<br class="spacer" />
				
				<div class="col-sm-3">
				  <label for="reg_input_name" class="req">Security Deposit</label>
				  <input value="<?php echo stripslashes(trim($arr_property_rental[0]['security_deposite']));?>" type="text" class="form-controltwo required" name="security_deposit" id="security_deposit" data-required="true">
				</div>
				
				<div class="col-sm-9">
				  <label for="reg_input_name">Security Deposit Text</label>
				  <textarea name="security_deposit_text" id="security_deposit_text" class="form-controltwo" style="width:100%;height:50px"><?php echo stripslashes(trim($arr_property_rental[0]['security_deposit_text']));?></textarea>
				</div>
				
				<br class="spacer" />
				<br class="spacer" />
				    <h4 class="proHeadingText">Seasonal Property Rents <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a> </span></h4>
				    <table width="100%" id="tableSeasons">
<!--					<tr>
					    <td>
						<div class="col-sm-12"><legend><b>Default Season</b></legend></div>
						<input name="season_name_default" type="hidden">
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="<?php echo $season_price_list[0]['daily_price'];?>" name="season_daily_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="<?php echo $season_price_list[0]['weekly_price'];?>" name="season_weekly_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="<?php echo $season_price_list[0]['monthly_price'];?>" name="season_monthly_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="<?php echo $season_price_list[0]['minimum_rental_days'];?>" name="minimum_rental_days_default" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
					    </td>
					</tr>-->
					<?php
					if(!empty($season_price_list))
					    $seaPriceCount = count($season_price_list);
					else
					    $seaPriceCount = 0;
					//pr($season_price_list, 0); echo $seaPriceCount;
					if($seaPriceCount > 0){
					    for($p=0;$p<$seaPriceCount;$p++) { ?>
					    <tr><td>&nbsp;</td></tr>
					    <tr id="season_<?php echo $season_price_list[$p]['price_id']; ?>">
					    <td>
						<div class="col-sm-12"><legend><b><?php echo $season_price_list[$p]['season_name'];?></b> <a href="javascript:void(0);" onclick="removeSeason(<?php echo $season_price_list[$p]['price_id']; ?>);" style=" float: right;">Remove Season</a></legend></div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Name</label>
						  <input value="<?php echo $season_price_list[$p]['season_name'];?>" name="season_name[]" type="text" class="form-controltwo required seasonName" data-required="true" id="sesname_<?php echo $p; ?>">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="<?php echo $season_price_list[$p]['daily_price'];?>" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="<?php echo $season_price_list[$p]['weekly_price'];?>" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="<?php echo $season_price_list[$p]['monthly_price'];?>" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="<?php echo $season_price_list[$p]['minimum_rental_days'];?>" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
			
			<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <?php if($season_price_list[$p]['season_start_date'] != '' && $season_price_list[$p]['season_start_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_start_date'] !='0000-00-00 00:00:00'){ ?>
						    <input value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_start_date']));?>" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_start_date[]">
						  <?php } else { ?>
						    <input value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_start_date[]">
						  <?php } ?>
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						   <?php if($season_price_list[$p]['season_end_date'] != '' && $season_price_list[$p]['season_end_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
						    <input value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_end_date']));?>" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_end_date[]">
						  <?php } else { ?>
						    <input value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_end_date[]">
						  <?php } ?>
						</div>
			
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">-1% Reduction</label>
						  <input value="<?php echo $season_price_list[$p]['percent_reduction_1'];?>" name="percent_reduction_1[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">-2% Reduction</label>
						  <input value="<?php echo $season_price_list[$p]['percent_reduction_2'];?>" name="percent_reduction_2[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">-3% Reduction</label>
						  <input value="<?php echo $season_price_list[$p]['percent_reduction_3'];?>" name="percent_reduction_3[]" type="text" class="form-controltwo required" data-required="true" data-type="number">
						</div>
			<div class="col-sm-3">
						   <label for="reg_input_name" class="req"> Is Default Season ?</label>
						  <input <?php if($season_price_list[$p]['isDefault'] == 'Yes') {echo 'checked="checked"';} ?> value="<?php echo $p;?>" class="form-controltwo seasonDefault" name="isDefault[]" type="radio" id="sesdefault_<?php echo $p; ?>">
						</div>
					    </td>
					</tr>
					<?php }
					}else { $p = 2; ?>
					    <tr><td>&nbsp;</td></tr>
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
					
					<?php } ?>
				    </table>
				    <input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list) - 1;?>" />
				     
				    <br class="spacer" />
				    <div class="col-sm-12"><legend><span>Yearly Rate</span></legend></div>
				    <div class="col-sm-4">
				      <label for="reg_input_name" class="req">Yearly Price</label>
				      <input value="<?php echo $arr_property_rental[0]['yearly_price'];?>" name="season_daily_yearly" type="text" class="form-controltwo required" data-required="true" data-type="number">
				    </div>
				    <br class="spacer" />
				    
				<h4 class="proHeadingText">Note Section</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name">Add Notes</label>
				  <textarea name="add_notes_rental" id="add_notes_rental" class="form-controltwo" style="width:100%;height:150px"></textarea>
				</div>
				
				<br class="spacer" />
				<table width="98%" cellpadding="2" cellspacing="3" border="1" class="imageListBox">
				    <tr>
					<th style="width:80%">Note Description</th>
					<th style="width:20%">Added On</th>
				    </tr>
				    <?php
				    //echo "<><><><>".sizeof($note_list);
				    if(is_array($note_list))
				    {
					for($n=0;$n<sizeof($note_list);$n++)
					{
				    ?>
				    <tr>
					<td><?php echo stripslashes(trim($note_list[$n]['note_description']));?></td>
					<td><?php echo date("d M,Y H:i:s", strtotime($note_list[$n]['added_on']));?></td>
				    </tr>
				    <?php
					}
				    } else {
				    ?>
				    <tr>
					<td colspan="2">No record found</td>
				    </tr>
				    <?php } ?>
				</table>
				<br class="spacer" />
				<?php /* ?>
				<h4 class="proHeadingText">Rental Custom Fields <!--<span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreCustomFields();">Add More Custom Fields</a> </span>--></h4>
				<table width="100%" id="customTable">
				    <?php for($c=0;$c<count($custom_list);$c++){?>
				    <tr>
					<td>
					    <div class="col-sm-3">
						<label for="reg_input_name">Custom Field Name 1</label>
						<input value="<?php echo stripslashes(trim($custom_list[0]['rent_custom_name']));?>" type="text" name="rent_custom_name[]" id="rent_custom_name_1" class="form-control"></textarea>
					      </div>
					      <div class="col-sm-9">
						<label for="reg_input_name">Custom Field Value 1</label>
						<textarea name="rent_custom_value[]" id="rent_custom_value_1" class="form-control"><?php echo stripslashes(trim($custom_list[0]['rent_custom_value']));?></textarea>
					      </div>
					</td>
				    </tr>
				    <?php } ?>
				</table>
				<input type="hidden" name="rent_custom_field_count" id="rent_custom_field_count" value="1" >
				<?php */ ?>
				<br class="spacer" />
				
				<div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit" onclick="setTheDefault();" id="btn_property_sales_fieldset">Save</button>
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
var j	=	<?php echo $p; ?>;

function removeSeason(id){
    $('#season_' + id).remove();
    j--;
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
    
    /*** for unavailable date ***/
    var unAvailableDateStr 	= $('#unavailable_date').val().split('-');
    var i 			= 0;
    var unAvailableDatesArr 	= [];
    
    for(i=0;i<unAvailableDateStr.length;i++)
    {
	unAvailableDatesArr.push(new Date (unAvailableDateStr[i]));
    }
    
    /*** for booked date ***/
    var bookedDateStr 	= $('#booked_date').val().split('-'); 
    var j 		= 0;
    var bookedDatesArr 	= [];
    
    for(j=0;j<bookedDateStr.length;j++)
    {
	bookedDatesArr.push(new Date (bookedDateStr[j]));
    }
    
    $('#blockdates_container').multiDatesPicker({
	addDates: unAvailableDatesArr,
	addDisabledDates: bookedDatesArr,
	dateFormat: "dd-mm-yy",
	numberOfMonths: [2,4],
	altField: '#unavailable_date',
	minDate: 0,
    });
    
    $(".season_start_date,.season_end_date").datepicker({
	    changeMonth: true,
	    changeYear: true,
	    dateFormat: 'dd/mm/yy'
    });
    
    var cFlag   = parseInt($("#amenity_value_count").val());
    $('.amenity_class').data('pre', $(this).val());
    $(".amenity_class").change(function(){
	
	var ddPrevValue		= $(this).data('pre');
	var ddCurrentValue	= $(this).val();
	//alert(ddPrevValue);
	
	if(cFlag == '') {
	    cFlag = 1;
	} 
	
	if(cFlag == 0)
	{
	    if(ddPrevValue == '' || ddPrevValue == 'absent')
	    {
		if(ddCurrentValue != 'absent')
		{
		    if(cFlag > 24)
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
		if(ddCurrentValue == 'absent')
		{
		    cFlag--;
		    $(this).data('pre', $(this).val());//update the pre data
		}
		else
		{
		   // nothing to do
		}
	    }
	}
	else
	{
	    if(ddPrevValue == '' || ddPrevValue == 'absent')
	    {
		if(ddCurrentValue != 'absent')
		{
		    if(cFlag > 24)
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
		else
		{
		    cFlag--;
		    $(this).data('pre', $(this).val());//update the pre data
		}
	    }
	    else
	    {
		if(ddCurrentValue == 'absent')
		{
		    cFlag--;
		    $(this).data('pre', $(this).val());//update the pre data
		}
		else
		{
		   // nothing to do
		}
	    }
	}
	//alert(cFlag);
    });
    
});
</script>