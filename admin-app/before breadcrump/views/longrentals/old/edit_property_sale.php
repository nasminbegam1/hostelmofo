<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>property_functions.js"></script>

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
                        <h4 class="panel-title">Edit Property Sales</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
		    <ul class="property_tab">
                        <li><a id="property_information_div" class="property_menu" href="<?php echo BACKEND_URL;?>property/edit_property_information/<?php echo $property_id;?>/<?php echo $page;?>">Property Information</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_image/<?php echo $property_id;?>/<?php echo $page;?>">Property Image</a></li>
			<li><a href="<?php echo BACKEND_URL;?>property/edit_property_rentals/<?php echo $property_id;?>/<?php echo $page;?>">Property Rentals</a></li>
                        <li class="active"><a>Property Sales</a></li>
			<!--<li><a href="<?php echo BACKEND_URL;?>property/edit_property_additional_info/<?php echo $property_id;?>/<?php echo $page;?>">Property Additional Information</a></li>-->
		    </ul>
                    <div class="clear"></div>
				<form name="frmPropertySales" id="frm3" enctype="multipart/form-data" method="post" class="parsley_reg" action="<?php echo BACKEND_URL;?>property/edit_property_sales/<?php echo $property_id."/".$page;?>">
				    <input type="hidden" name="property_new_id_sales" id="property_new_id_sales" value="" />
				    <input type="hidden" name="action" value="Process">
				    <fieldset>
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
					<label for="property_name" class="req">Property sales number</label>
					<input name="property_sales_serial_no" id="property_sales_serial_no" data-required="true" type="text" class="form-controlone" value="<?php echo stripslashes($arr_property[0]['property_sales_serial_no']);  ?>">
				    </div>
				    
				    <br class="spacer" />
				    
				    <h4 class="proHeadingText">Price information & Freehold/Leasehold</h4>
				    
				   <div class="col-sm-3">
				    <label for="sales_price_from" class="req">Sales Price <!--Starting From--></label>
				    <input type="text" class="form-controlone" data-type="number"  name="sales_price_from" id="sales_price_from" value="<?php echo $arr_property[0]['sales_price_from'];?>" data-required="true">
				</div>
                   <!--<div class="col-sm-3">
                        <label for="sales_price_to">Sales Price Ending In</label>
                        <input type="text" class="form-controlone" data-type="number"  name="sales_price_to" id="sales_price_to" value="<?php echo $arr_property[0]['sales_price_to'];?>">
                    </div>-->
                                
                                <div class="col-sm-3 checkBox">
                                    <label for="sales_price">Freehold/Leashold</label>
				    <input type="radio" name="hold_type" value="Leasehold" class="form-controlone radion_frm_class" <?php if($arr_property[0]['freehold_leasehold']=='Leasehold'){ ?> checked="checked" <?php } ?>><span class="radio_lebel">Leasehold</span>
				    <input type="radio" name="hold_type" value="Freehold" class="form-controlone radion_frm_class" <?php if($arr_property[0]['freehold_leasehold']=='Freehold'){ ?> checked="checked" <?php } ?> ><span class="radio_lebel">Freehold</span>
                                </div>
				
				<br class="spacer" />
				
				<div class="col-sm-12">
                                    <label for="Freehold/LeaseholdText" class="req">Freehold/Leasehold Text</label>
                                    <input id="freehold_leasehold_text" name="freehold_leasehold_text" type="text" class="form-controlone" value="<?php echo stripslashes($arr_property[0]['freehold_leasehold_text']); ?>">
                                </div>
				
                                <!--
                                <div class="col-sm-3 checkBox">
                                    <label for="sales_price">Land Title</label>
                                    <input type="radio" name="land_title" value="Chanote" class="form-controlone radion_frm_class" <?php if($arr_property[0]['land_title']=='Chanote'){?> checked="checked" <?php } ?> ><span class="radio_lebel" >Chanote</span>
                                    <input type="radio" name="land_title" value="Tor Dok" class="form-controlone radion_frm_class" <?php if($arr_property[0]['land_title']=='Tor Dok'){?> checked="checked" <?php } ?>><span class="radio_lebel">Tor Dok</span>
                                </div>
                                
				
				
                                <div class="col-sm-3">
                                    <label for="payment_structure" class="req">Payment Structure</label>
                                    <input id="payment_structure" name="payment_structure" type="text" class="form-controlone" data-required="true" value="<?php echo stripcslashes($arr_property[0]['payment_structure']); ?>">
                                </div>-->
                                
                                
                                <!--<br class="spacer" />
                                <div class="col-sm-3">
                                    <label for="sinking_fund">Sinking Fund</label>
                                    <input id="sinking_fund" name="sinking_fund" type="text" class="form-controlone" data-type="number" value="<?php echo $arr_property[0]['sinking_fund']; ?>">
                                </div>-->
                                
                                <br class="spacer" />
				
				<h4 class="proHeadingText">Property Sale Description</h4>
                                <div class="col-sm-12">
                                    <label for="sales_price">Sales Description</label>
                                   <!-- <texarea name="property_sales_desc" id="wysiwg_editor1" class="form-controlone"><?php echo $arr_property[0]['property_sales_desc']; ?></texarea> -->
				     <textarea name="property_sales_desc" id="wysiwg_editor" class="form-control"><?php echo stripslashes($arr_property[0]['property_sales_desc']);?></textarea>
                                </div>
				<br class="spacer" />
				
				<h4 class="proHeadingText">Amenities
				<br>
				<span class="h4-span">Describe the amenities for your property by clicking on the check box next to any amenity that is applicable to your listing. You can add details to any amenity by clicking on the "add details" link to the right of any selected amenity.</span></h4>
				
				<?php
				//$amenity_arr = explode(',', $arr_property[0]['amenities_id']);
				
				$amenity_arr = explode(',', $arr_property[0]['amenities_id']);
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
				
				$featured_category_name = '';
				if(is_array($arr_prop_amenity)) {
				?>
				<div class="col-sm-12">
				    <input type="hidden" id="amenity_value_count" value="<?php echo count($amm_arr);?>">
				    <div class="formPanSec">
					<div class="rightPan">
					<?php foreach($arr_prop_amenity as $prop_amenity_val) { 
					    if($featured_category_name == $prop_amenity_val['featured_category_name']) {
					    ?>
						<!--<input name="sales_amenities[]" type="checkbox" <?php if(in_array($prop_amenity_val['amenities_id'],$amenity_arr)){?>checked<?php } ?> value="<?php echo $prop_amenity_val['amenities_id'];?>" />
						<label><?php echo $prop_amenity_val['amenities_name'];?></label>-->
						
						<div class="col-sm-4">
						<select name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
						    <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
						    <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
						    <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
						</select>
						<label><?php echo $prop_amenity_val['amenities_name'];?></label>
						</div>
						
					    <?php
					    }
					    else
					    {
					    ?>
					    <div class="subHeading"><?php echo $prop_amenity_val['featured_category_name'];?></div>
					    
					    <!--<div class="subHeadingInput">
						<input name="sales_amenities[]" type="checkbox" <?php if(in_array($prop_amenity_val['amenities_id'],$amenity_arr)){?>checked<?php } ?> value="<?php echo $prop_amenity_val['amenities_id'];?>" />
						<label><?php echo $prop_amenity_val['amenities_name'];?></label>
					    </div>-->
					    
					    <div class="col-sm-4">
						<select name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
						    <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
						    <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
						    <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
						</select>
						<label><?php echo $prop_amenity_val['amenities_name'];?></label>
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
                                <h4 class="proHeadingText">Other information</h4>
                                
                                <!--<div class="col-sm-3">
                                    <label for="maintenance">Maintenance</label>
                                    <input id="maintenance" name="maintenance" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['maintenance']); ?>">
                                </div>
                                
                                <div class="col-sm-3 checkBox">
                                    <label for="rented_vacant">Rented/Vacant</label>				   
                                    <input type="radio" name="rented_vacant" value="Vacant" class="form-controlone radion_frm_class" <?php if($arr_property[0]['rented_vacant']=='Vacant') { ?> checked="checked" <?php } ?>><span class="radio_lebel">Vacant</span>				   
                                    <input type="radio" name="rented_vacant" value="Rented" class="form-controlone radion_frm_class" <?php if($arr_property[0]['rented_vacant']=='Rented') { ?> checked="checked" <?php } ?> ><span class="radio_lebel">Rented</span>                                   
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="sales_price">Parking Space Included</label>
                                    <input id="parking_space_included" name="parking_space_included" type="text" class="form-control" data-type="number" value="<?php echo $arr_property[0]['parking_space']; ?>">
                                </div>-->
                                
                                <div class="col-sm-3">
                                    <label for="bedroom_starting_from" class="req">Bedroom <!--Starting From--></label>
                                    <input id="bedroom_starting_from" name="bedroom_starting_from" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['bedroom_starting_from']); ?>" data-required="true" data-type="number">
                                </div>
                                
                                <!--<div class="col-sm-3">
                                    <label for="bedroom_ending_to">Bedroom Ending To</label>
                                    <input id="bedroom_ending_to" name="bedroom_ending_to" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['bedroom_ending_to']); ?>">
                                </div>-->
				
				<div class="col-sm-3">
                                    <label for="bedroom_starting_from" class="req">Bathroom <!--Starting From--></label>
                                    <input id="bedroom_starting_from" name="bathroom_starting_from" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['bathroom_starting_from']); ?>" data-required="true" data-type="number">
                                </div>
                                
                                <!--<div class="col-sm-3">
                                    <label for="bedroom_ending_to">Bathroom Ending To</label>
                                    <input id="bedroom_ending_to" name="bathroom_ending_to" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['bathroom_ending_to']); ?>">
                                </div>-->
                                
				<!--<br class="spacer" />-->
				
				<?php /* ?>
                                <div class="col-sm-3">
                                    <label for="sleep_starting_from">Sleeps Starting From</label>
                                    <input id="sleep_starting_from" name="sleep_starting_from" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['sleep_starting_from']); ?>">
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="sleep_ending_to">Sleeps Ending To</label>
                                    <input id="sleep_ending_to" name="sleep_ending_to" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['sleep_ending_to']); ?>">
                                </div>
                                <?php */ ?>
				
                                <div class="col-sm-3">
                                    <label for="size_starting_from" class="req">Living Space M<sup>2</sup> <!--Starting From--></label>
                                    <input id="size_starting_from" name="size_starting_from" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['size_starting_from']); ?>" data-required="true">
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="size_ending_to" class="req">Constructed Area M<sup>2</sup></label>
                                    <input id="size_ending_to" name="size_ending_to" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['size_ending_to']); ?>" data-required="true">
                                </div>
                                

				
                                <br class="spacer" />
                                <br class="spacer" />																				<div class="col-sm-3">                                	<label for="reg_input_name" class="req">Agent</label>                                	<select name="agent_id" id="agent_id" data-required="true" class="form-controlone">                                		<option value=""> Please Select </option>						<?php						if(is_array($arr_agent))						{						    foreach($arr_agent as $key)						    {							if($arr_property[0]['agent_id'] == $key['admin_id'])							{							?>							    <option value="<?php echo $key['admin_id'];?>" selected="selected"><?php echo $key['agent_name'];?></option>							<?php							}							else							{							    ?>							    <option value="<?php echo $key['admin_id'];?>" ><?php echo $key['agent_name'];?></option>							<?php							}						    }						}						?>                                	</select>                                </div>																
                                <div class="col-sm-3">
				    <div class="multiSelectBoxHead"> <label for="indoor_size">Contacts Associated</label></div>
				    <div class="multiSelectBoxInn">
					<a ></a>
					<ul>
					    <?php
					    
					    $contact_id_array = explode(',',$arr_property[0]['contact_id']);
					    
					    foreach($arr_contacts as $key)
					    {
						if(in_array($key['contact_id'],$contact_id_array))
						{
					    ?>
					     <li><input name= "contact_id_sales[]" type="checkbox" value="<?php echo $key['contact_id'];?>" checked="checked"  /><label><a href="<?php echo BACKEND_URL.'contacts/view_contact_master/'.$key['contact_id']; ?>" target="_blank"><?php echo $key['full_name']; ?></a></label></li>
					    
					    <?php
						}
						else
						{
						    ?>
					     <li><input name= "contact_id_sales[]" type="checkbox" value="<?php echo $key['contact_id'];?>"   /><label><a href="<?php echo BACKEND_URL.'contacts/view_contact_master/'.$key['contact_id']; ?>" target="_blank"><?php echo $key['full_name']; ?></a></label></li>
					    
					    <?php
						    
						}
					    }
					    ?>
					
					</ul>
					
				    </div>
                                </div>
				<br class="spacer" />
				<h4 class="proHeadingText">Note Section</h4>
				<div class="col-sm-12">
				  <label for="reg_input_name">Add Notes</label>
				  <textarea name="add_notes_sales" id="add_notes_sales" class="form-controlone" style="width:100%;height:150px"></textarea>
				</div>
				
				<br class="spacer" />
				
				<div class="col-sm-12">
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
				</div>
                
                <br class="spacer" />
                <!-- development pages section -->
				<h4 class="proHeadingText">Development Pages</h4>
				<div class="col-sm-12">
				    <div class="formPanSec">
					<div class="rightPan">						
					    <input name="development_page" id="development_page_1" type="radio" value="1" <?php if($development_pages == 1){echo 'CHECKED';}?> /><label>1 Unit</label>
		<input name="development_page" id="development_page_2" type="radio" value="2" <?php if($development_pages == 2){echo 'CHECKED';}?> /><label>2 Units</label>
		<input name="development_page" id="development_page_3" type="radio" value="3" <?php if($development_pages == 3){echo 'CHECKED';}?> /><label>3 Units</label>
		<input name="development_page" id="development_page_4" type="radio" value="4" <?php if($development_pages == 4){echo 'CHECKED';}?> /><label>4 Units</label>
		<input name="development_page" id="development_page_5" type="radio" value="5" <?php if($development_pages == 5){echo 'CHECKED';}?> /><label>5 Units</label>
		<input name="development_page" id="development_page_6" type="radio" value="6" <?php if($development_pages == 6){echo 'CHECKED';}?> /><label>6 Units</label>
        <input name="development_page" id="development_page_7" type="radio" value="7" <?php if($development_pages == 7){echo 'CHECKED';}?> /><label>7 Units</label>
        <input name="development_page" id="development_page_8" type="radio" value="8" <?php if($development_pages == 8){echo 'CHECKED';}?> /><label>8 Units</label>
        <input name="development_page" id="development_page_9" type="radio" value="9" <?php if($development_pages == 9){echo 'CHECKED';}?> /><label>9 Units</label>
        <input name="development_page" id="development_page_10" type="radio" value="10" <?php if($development_pages == 10){echo 'CHECKED';}?> /><label>10 Units</label>
                        </div>
                        </div>
                </div>
                <br class="spacer" />
                <table id="resp_table2" class="table">
                <thead>
                  <tr>
                  	<th>&nbsp;</th>                 
                    <th>Unit Type<span class="req"></span></th>
                    <!--<th>Unit Number</th>-->
                    <th>Floor</th>
                    <th>Size Sq (Total)</th>
                    <!--<th>Size Sq (Inside)</th>-->
                    <th>Price (THB)<span class="req"></span></th>
                  </tr>                  
                </thead>
                <tbody id="development_page_contain">
                	<tr id="development_sub_page_1" class="odd dev-pages" style="<?php if($development_pages >= 1){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #1</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_building']);}}?>" class="form-control"/></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 1){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[0]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_2" class="even dev-pages" style="<?php if($development_pages >= 2){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #2</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 2){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[1]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_3" class="odd dev-pages" style="<?php if($development_pages >= 3){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #3</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 3){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[2]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_4" class="even dev-pages" style="<?php if($development_pages >= 4){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #4</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 4){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[3]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_5" class="odd dev-pages" style="<?php if($development_pages >= 5){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #5</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_building']);}}?>" class="form-control"/></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 5){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[4]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_6" class="even dev-pages" style="<?php if($development_pages >= 6){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #6</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 6){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[5]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_7" class="odd dev-pages" style="<?php if($development_pages >= 7){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #7</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 7){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[6]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_8" class="even dev-pages" style="<?php if($development_pages >= 8){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #8</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 8){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_9" class="odd dev-pages" style="<?php if($development_pages >= 9){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #9</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 9){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[8]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                    <tr id="development_sub_page_10" class="even dev-pages" style="<?php if($development_pages >= 10){echo 'display:';}else{echo 'display:none';}?>">
                    	<td>Unit #10</td>
                        <td><input type="text" name="dev_page_building[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[9]['dev_page_building']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_unit_no[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[9]['dev_page_unit_no']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_room_type[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[9]['dev_page_room_type']);}}?>" class="form-control" /></td>
                        <td><input type="text" name="dev_page_size_sq_total[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[9]['dev_page_size_sq_total']);}}?>" class="form-control" /></td>
                        <!--<td><input type="text" name="dev_page_size_sq_inside[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[9]['dev_page_size_sq_inside']);}}?>" class="form-control" /></td>-->
                        <td><input type="text" name="dev_page_price[]" value="<?php if($development_pages >= 10){if(is_array($arr_sales_development_pages)){echo stripslashes($arr_sales_development_pages[7]['dev_page_price']);}}?>" class="form-control" /></td>
                    </tr>
                </tbody>
                </table>
                <!-- development pages section -->
				
				<br class="spacer" />
				<div class="col-sm-12">
				    <h4 class="proHeadingText">Enable Floor Plans</h4>
			<table>
				<?php if(is_array($arr_property_image)) {
					    foreach($arr_property_image as $val){
						$en=$val['is_active'];
					    }
					}?>
					
					    <td colspan="7"><input type="radio" name="enable" value="1" class="floor_enable" <?php if(isset($en) && $en=='1'){ ?> checked="checked" <?php } ?>><span class="radio_lebel">Enable</span>
				    <input type="radio" name="enable" value="0"  class="floor_enable" <?php if(isset($en) && $en=='0'){ ?> checked="checked" <?php } ?>><span class="radio_lebel">Disable</span></td></tr>
			</table>
				</div>
				
				<div id="upload_floor_pic"  <?php if(isset($en) && $en=='1'){ ?>style="display: block;" <?php } else { ?>style="display: none;"<?php } ?>>
				   <div id="property_image_fieldset" class="property_tag_class">
			
				<fiedset>
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
					    <th>Delete</th>
					</tr>
					<?php if(is_array($arr_property_image)) { foreach($arr_property_image as $val){?>
					<tr id="tr_id_<?php echo $val['floor_plan_id'];?>_<?php echo $val['property_id'];?>">
					    <td>
						<img height="50" width="50" src="<?php echo FRONTEND_URL;?>upload/floor_image/<?php echo $val['image_file_name'];?>">
						<br><?php echo $val['image_file_name'];?><input type="hidden" value="<?php echo $val['image_file_name'];?>" name="image_name[]">
					    </td>
					    <td><input type="text" class="form-control" name="image_title[]" value="<?php echo $val['image_title'];?>"></td>
					    <td><input type="text" class="form-control" name="image_alt[]" value="<?php echo $val['image_alt'];?>"></td>
					    <td><input type="text" class="form-control" name="image_caption[]" value="<?php echo $val['image_caption'];?>"></td>
					    <td><input type="text" class="form-control" name="image_tag[]" value="<?php echo $val['image_tag'];?>"></td>
					    <td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order[]" value="<?php echo $val['image_order'] == 999 ? '':$val['image_order'];?>"></td>
					   
					    
					    
					    <td><span class="glyphicon glyphicon-remove-sign delete_image" id="<?php echo $val['floor_plan_id'];?>_<?php echo $val['property_id'];?>" style="cursor:pointer;"></span></td>
					</tr>
					<?php } } ?>
					<tbody id="uploadPictures"></tbody>
				    </table>
				    <br class="spacer" /><br class="spacer" />
				    <div id="mulitplefileuploader">Upload</div>
				    <div id="status"></div>
				</div>
				
                           		    
				
                            </fieldset>
				
			    </div>
				</div>
				
				<br class="spacer" />
				
				   <div class="col-sm-12">
<h4 class="proHeadingText">Payment Structure</h4>
				     <textarea name="sales_payment" class="ckeditor" class="form-control"><?php echo stripslashes($arr_property[0]['sales_payment_info']);?></textarea>
                                </div>
                            <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
				<div style="float:right;margin-top:-150px;display:none;" id="div_loader">
				    <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
				</div>
				
                                <br class="spacer" />
                                <div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit" id="btn_property_additional_information_fieldset">Save </button>
				  <!--  <button class="next_skip_continue btn btn-default" type="button" id="next_property_additional_information_fieldset">Skip and Continue</button> -->
                                </div>
				
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

$(document).ready(function(){
    
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
<script>
var backend_url		= '<?php echo BACKEND_URL;?>';
var frontend_url	= '<?php echo FRONTEND_URL;?>';

$(window).load(function(){
    
	var settings = {
		url:  backend_url + "property/do_image_upload1",
		method: "POST",
		allowedTypes:"jpg,png,gif,jpeg",
		fileName: "myfile1",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
		    //alert(data);
		    var image_name		= data.replace(/\"/g, '');
		    var arr_image_name		= image_name.split('_');
		    var display_image_name	= arr_image_name[1];		    
		    var str = '<tr id="tr_'+ image_name +'"><td><img src="'+frontend_url+'upload/floor_image/'+ image_name +'" width="50" height="50"><br>'+image_name+'<input type="hidden" name="image_name[]" value="'+ image_name + '"></td><td><input type="text" name="image_title[]" class="form-control"></td><td><input type="text" name="image_alt[]" class="form-control"></td><td><input type="text" name="image_caption[]" class="form-control"></td><td><input type="text" name="image_tag[]" class="form-control"></td><td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order[]" value=""></td><td><span style="cursor:pointer;" id="' + image_name + '" class="glyphicon ajax_image_delete glyphicon-remove-sign"></span></td></tr>';
		    
		    $('#uploadPictures').append(str);
		    $("#status").html("<font color='green'>Upload was successful</font>");
		    
			
		},
		onError: function(files,status,errMsg)
		{		
			$("#status").html("<font color='red'>Uploading is Failed</font>");
		}
	}

	$("#mulitplefileuploader").uploadFile(settings);

});

$(document.body).on('click', '.ajax_image_delete', function(event) {
    var elem = $(this);
    var backend_url	= '<?php echo BACKEND_URL;?>';
    var fileName 	= $(this).attr('id');
    if (confirm("Are you sure?")) 
    {
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url + "property/ajax_delete_floor_image/",
		data: { file_name: fileName},
		success:function(data) { 
			//$("#tr_" + fileName).remove();
			$(elem).parent().parent().hide();
		}
	});
    }
});

$(".delete_image").on('click', function(){
    var ids = $(this).attr('id');
    
    if (confirm("Are you sure?"))
    {
	var arrId 		= ids.split("_");
	var propertyId		= arrId[1]; 
	var floorImageId	= arrId[0];
	
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url + "property/delete_floor_image/",
		data: { floor_image_id: floorImageId, property_id: propertyId},
		success:function(data) {
		    $("#tr_id_" + ids).remove();
		}
	});
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
</script>