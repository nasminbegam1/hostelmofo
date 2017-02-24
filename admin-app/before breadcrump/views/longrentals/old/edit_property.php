<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>

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
	//pr($arr_property,0);
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
                	
                    <ul class="property_tab">
                        <li class="active"><a id="property_information_div" class="property_menu">Property Information</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_image/<?php echo $arr_property['property_id'];?>/<?php echo $page;?>">Property Image</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_rentals/<?php echo $arr_property['property_id'];?>/<?php echo $page;?>">Property Rentals</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_sales/<?php echo $arr_property['property_id'];?>/<?php echo $page;?>">Property Sales</a></li>
			<!--<li><a href="<?php echo BACKEND_URL;?>property/edit_property_additional_info/<?php echo $arr_property['property_id'];?>/<?php echo $page;?>">Property Additional Information</a></li>-->
					</ul>
                    <div class="clear"></div>
			    
                    		<div id="property_information_fieldset" class="property_tag_class">
				<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>property/edit_property_information/<?php echo $arr_property['property_id'].'/'.$page.'/';?>">
				<input type="hidden" name="action" value="Process">
				    
				<input type ="hidden" id="mr_mrs" value="<?php echo $arr_property['manager_salutations']; ?>"  >
				<input type ="hidden" id="email" value="<?php echo $arr_property['manager_email'];  ?>"  >
				<input type ="hidden" id="phone_no_one" value="<?php echo $arr_property['second_manager_contact1'];  ?>"  >
				<input type ="hidden" id="phone_no_second" value="<?php echo $arr_property['second_manager_contact2'];  ?>"  >
				<input type ="hidden" id="lang_id" value="<?php echo $arr_property['manager_lang_id'];  ?>"  >
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
                                            <input name="property_name" id="property_name" value="<?php echo stripslashes($arr_property['property_name']);?>" type="text" data-required="true" class="form-control">
                                	</div>
					
					<!--<div class="col-sm-3">
                                            <label for="property_name" class="req">Property #</label>
                                            <input name="property_serial_no" id="property_serial_no" data-required="true" type="text" class="form-control" value="<?php echo stripslashes($arr_property[0]['property_serial_no']);?>">
                                	</div>-->
                                        <div class="col-sm-3">
                                            <label for="property_name" class="req">Property Owner</label>
                                            <span><a href="<?php echo BACKEND_URL.'owner/details/'.$arr_property['owner_id'].'/'; ?>" target="_blank"><?php echo $property_owner;?></a></span>
                                	</div>
					
					<div class="col-sm-3">
                                            <label for="property_ranking">Property Ranking</label>
					    <select name="property_ranking" id="property_ranking" class="form-control">
						<option value="">---Please Select---</option>
						<option value="1" <?php if($arr_property['property_ranking'] == '1'){?>selected<?php } ?>>1</option>
						<option value="2" <?php if($arr_property['property_ranking'] == '2'){?>selected<?php } ?>>2</option>
						<option value="3" <?php if($arr_property['property_ranking'] == '3'){?>selected<?php } ?>>3</option>
						<option value="4" <?php if($arr_property['property_ranking'] == '4'){?>selected<?php } ?>>4</option>
						<option value="5" <?php if($arr_property['property_ranking'] == '5'){?>selected<?php } ?>>5</option>
						<option value="6" <?php if($arr_property['property_ranking'] == '6'){?>selected<?php } ?>>6</option>
						<option value="7" <?php if($arr_property['property_ranking'] == '7'){?>selected<?php } ?>>7</option>
						<option value="8" <?php if($arr_property['property_ranking'] == '8'){?>selected<?php } ?>>8</option>
						<option value="9" <?php if($arr_property['property_ranking'] == '9'){?>selected<?php } ?>>9</option>
						<option value="10" <?php if($arr_property['property_ranking'] == '10'){?>selected<?php } ?>>10</option>
					    </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="property_name" class="req">Property Currency</label>
                                             <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
						<option value="">---Please Select---</option>
						<option value="THB" <?php if($arr_property['property_currency'] == 'THB'){?>selected<?php } ?>>THB</option>
						<option value="USD" <?php if($arr_property['property_currency'] == 'USD'){?>selected<?php } ?>>USD</option>
					    </select>
                                	</div>
                                        
                                        <br class="spacer" />
                                    	<h4 class="proHeadingText">Basic information</h4>
                                        <div class="col-sm-3">
                                            <label for="property_type" class="req">Property Type</label>
                                            <?php if(is_array($arr_property_type)) { ?>
                                            <select name="property_type" id="property_type" data-required="true"  class="form-control">
                                            <?php foreach($arr_property_type as $key){?>
                                            <option value="<?php echo $key['property_type_id'];?>" <?php if($arr_property['property_type_id'] == $key['property_type_id']){?>selected="selected"<?php } ?>><?php echo $key['property_name'];?></option>
                                            <?php } ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="unit_number">Unit Number</label>
                                            <input id="unit_number" name="unit_number" data-type="number" type="text" class="form-control" value="<?php echo stripslashes($arr_property['unit_number']);?>">
                                        </div>
                                        
					<div class="col-sm-3">
                                            <label for="bedrooms" class="req">Bedrooms</label>
					    <select id="bedrooms" name="bedrooms" data-required="true" class="form-control">
						<option value="">Please Seclect</option>
						<?php for($b=1;$b<13;$b++){?>
						<option value="<?php echo $b;?>" <?php if($b == $arr_property['bedrooms']){?>selected="selected"<?php } ?>><?php echo $b;?></option>
						<?php } ?>
					    </select>
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="bedrooms">Bedroom Configuration</label>
					    <input type="text" name="bedroom_configuration" id="bedroom_configuration" value="<?php echo stripslashes(trim($arr_property['bedrooms_configuration']));?>" class="form-control">
                                        </div>
					
					<br class="spacer" />
					
					<?php
					$is_studio = 'No';
					if($arr_property['is_studio'] == 'Yes')
					{
					    $is_studio = 'Yes';
					}
					?>
					<div class="col-sm-3 checkBox">
					    <label for="is_studio">Studio Apartment</label>
					    <input type="radio" class="form-control radion_frm_class" value="Yes" id="is_studio" name="is_studio" <?php if($is_studio == 'Yes') { ?> checked <?php } ?>>
					    <span class="radio_lebel">Yes</span>
					     <input type="radio" class="form-control radion_frm_class" value="No" id="is_studio" name="is_studio" <?php if($is_studio == 'No') { ?> checked <?php } ?>>
					    <span class="radio_lebel">No</span>
					</div>
					
                                        <div class="col-sm-3">
                                            <label for="sleeps" class="req">Sleeps</label>
                                            <select id="sleeps" name="sleeps" data-required="true" class="form-control">
						<option value="">Please Seclect</option>
						<?php for($s=1;$s<25;$s++){?>
						<option value="<?php echo $s;?>" <?php if($s == $arr_property['sleeps']){?>selected="selected"<?php } ?>><?php echo $s;?></option>
						<?php } ?>
					    </select>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="bathrooms" class="req">Bathrooms</label>
                                            <select id="bathrooms" name="bathrooms" data-required="true" class="form-control">
						<option value="">Please Select</option>
						<?php for($b=1;$b<12;$b++){?>
						<option value="<?php echo $b;?>" <?php if($b == $arr_property['bathrooms']){?>selected="selected"<?php } ?>><?php echo $b;?></option>
						<?php } ?>
					    </select>
					</div>
					
					<div class="col-sm-3">
                                            <label for="bedrooms">Bathroom Configuration</label>
					    <input type="text" name="bathroom_configuration" id="bathroom_configuration" value="<?php echo stripslashes(trim($arr_property['bathrooms_configuration']));?>" class="form-control">
                                        </div>
					
					<br class="spacer" />
					
                                        <div class="col-sm-3">
                                            <label for="total_size" >Total Size</label>
                                            <input id="total_size" name="total_size" data-type="number" type="text" class="form-control" value="<?php echo $arr_property['total_size'] == 0.00 ? '':$arr_property['total_size'];?>">&nbsp;(in sqmetres) 
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="indoor_size" >Indoor Size</label>
                                            <input id="indoor_size" name="indoor_size" type="text" data-type="number" class="form-control" value="<?php echo  $arr_property['indoor_size'] == 0.00 ? '':$arr_property['indoor_size'];?>">&nbsp;(in sqmetres)
                                        </div>
					
                                        <div class="col-sm-3">
                                            <label for="outdoor_size" >Outdoor Size</label>
                                            <input id="outdoor_size" name="outdoor_size" type="text" data-type="number" class="form-control" value="<?php echo $arr_property['outdoor_size'] == 0.00 ? '' : $arr_property['outdoor_size'];?>">&nbsp;(in sqmetres)
                                        </div>
                                        
					<div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Furnished</label>
                                            <input type="radio" <?php if($arr_property['furnished'] == 'Yes'){?>checked<?php } ?> name="furnished" id="furnished_yes" value="Yes" class="form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" <?php if($arr_property['furnished'] == 'No'){?>checked<?php } ?> name="furnished" id="furnished_no" value="No" class="form-control radion_frm_class"><span class="radio_lebel">No</span>
                                            <input type="radio" <?php if($arr_property['furnished'] == 'Part'){?>checked<?php } ?> name="furnished" id="furnished_part" value="Part" class="form-control radion_frm_class"><span class="radio_lebel">Part</span>
                                        </div>
					
					<br class="spacer" />
					
                                        <?php $view_arr = explode(',', $arr_property['view_id']);?>
                                        <div class="col-sm-3">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"><label for="view">View</label></div>
						<div class="multiSelectBoxInn">
						    <ul>
							<?php
							foreach($arr_viwes as $key)
							{
							?>
							 <li><input name="view[]" type="checkbox" value="<?php echo $key['view_type_id'];?>" <?php if(in_array($key['view_type_id'],$view_arr)){?>checked<?php } ?> /><label><?php echo $key['view_type_name'];?></label></li>
							
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
						<?php for($a=0;$a<36;$a++){?>
						<option value="<?php echo $a;?>" <?php if($a == $arr_property['floor']){?>selected="selected"<?php } ?>><?php echo $s;?></option>
						<?php } ?>
                                            </select>
                                        </div>
                                        
					<div class="col-sm-3">
                                            <label for="storeys">Storeys</label>
                                            <select name="storeys" id="storeys" class="form-control">
						<option value="">Please Select</option>
						<?php for($s=0;$s<36;$s++){?>
						<option value="<?php echo $s;?>" <?php if($s == $arr_property['storeys']){?>selected="selected"<?php } ?>><?php echo $s;?></option>
						<?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="development_name">Development Name</label>
					    <select name="development_name" id="development_name" class="form-control">
						<option value="">Please Select</option>
						<?php
						if(is_array($development_list))
						{
						    foreach($development_list as $val)
						    {
							if($arr_property['development_id']==$val['development_id'])
							{
							?>
							<option value="<?php echo $val['development_id'];?>" selected="selected"><?php echo $val['development_name'];?></option>
							<?php
							}
							else
							{
							    ?>
							   <option value="<?php echo $val['development_id'];?>"><?php echo $val['development_name'];?></option>
							   <?php
							}
							    
						    }
						}
						
						?>
						<option value="-1">Add New Development</option>
					    </select>
                                        </div>
                                        
					<br class="spacer" />
					
					<div class="col-sm-3">
                                            <label for="developer_name">Name of Developer</label>
                                            <input id="developer_name" name="developer_name" type="text" class="form-control" value="<?php echo stripslashes($arr_property['developer_name']);?>">
                                        </div>
					
					<div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Off Plan</label>
                                            <input type="radio" <?php if($arr_property['off_plan'] == 'Yes'){?>checked<?php } ?> name="off_plan" id="off_plan_yes" value="Yes" class="form-control radion_frm_class"><span class="radio_lebel">Yes</span>
                                            <input type="radio" <?php if($arr_property['off_plan'] == 'No'){?>checked<?php } ?> name="off_plan" id="off_plan_no" value="No" class="form-control radion_frm_class"><span class="radio_lebel">No</span>
                                        </div>
                                        
					<div class="col-sm-3">
                                            <label for="completion_date">Completion Date</label>
					    <input type="text" readonly id="completion_date" class="form-control" name="completion_date" value="<?php echo date('d/m/Y', strtotime($arr_property['completion_date']));?>" />
                                        </div>
					
					<div class="col-sm-3 checkBox">
                                            <label for="indoor_size">Pool Type</label>
                                            <input type="radio" <?php if($arr_property['pooltype'] == 'Private'){?>checked<?php } ?> name="pooltype" id="pooltype1" value="Private" class="form-control radion_frm_class"><span class="radio_lebel">Private</span>
                                            <input type="radio" <?php if($arr_property['pooltype'] == 'Communal'){?>checked<?php } ?> name="pooltype" id="pooltype2" value="Communal" class="form-control radion_frm_class"><span class="radio_lebel">Communal</span>
                                        </div>
					
					<br class="spacer" /><br class="spacer" />
					
					<div class="col-sm-3">
                                            <label for="developer_name">Special Offer Heading</label>
                                            <input id="special_offer_title" name="special_offer_title" type="text" class="form-control" value="<?php echo stripslashes($arr_property['special_offer_title']);?>">
                                        </div>
					
					<div class="col-sm-9">
                                            <label for="developer_name">Special Offer Text</label>
                                            <input id="special_offer_text" name="special_offer_text" type="text" class="form-control" value="<?php echo stripslashes($arr_property['special_offer_text']);?>">
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
					<?php
					if(count($property_suitability) > 0)
					{
					    $special_feature1 = ($property_suitability[0]['special_feature1'] != '') ? stripslashes(trim($property_suitability[0]['special_feature1'])) : '';
					    $special_feature2 = ($property_suitability[0]['special_feature2'] != '') ? stripslashes(trim($property_suitability[0]['special_feature2'])) : '';
					    $special_feature3 = ($property_suitability[0]['special_feature3'] != '') ? stripslashes(trim($property_suitability[0]['special_feature3'])) : '';
					    $special_feature4 = ($property_suitability[0]['special_feature4'] != '') ? stripslashes(trim($property_suitability[0]['special_feature4'])) : '';
					}
					else
					{
					    $special_feature1 = $special_feature2 = $special_feature3 = $special_feature4 = '';
					}
					?>
                                        <h4 class="proHeadingText">Features</h4>
					<div class="col-sm-3">
					    <label for="latitude">Feature - 1</label>
					    <input type="text" id="special_feature1" name="special_feature1" class="form-control" value="<?php echo $special_feature1;?>">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 2</label>
					    <input type="text" id="special_feature2" name="special_feature2" class="form-control" value="<?php echo $special_feature2;?>">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 3</label>
					    <input type="text" id="special_feature3" name="special_feature3" class="form-control" value="<?php echo $special_feature3;?>">
					</div>
					
					<div class="col-sm-3">
					    <label for="latitude">Feature - 4</label>
					    <input type="text" id="special_feature4" name="special_feature4" class="form-control" value="<?php echo $special_feature4;?>">
					</div>
					
					<br class="spacer" />
                                        <h4 class="proHeadingText">Address</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="latitude" class="req">Latitude</label>                                            
					    <input type="text" id="latitude" name="latitude" class="form-control" data-required="true" data-type="number" value="<?php echo $arr_property['latitude'];?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="longitude" class="req">Longitude <a id="review_map" href="https://maps.google.com/" target="_blank">Review Map</a></span></label>
                                            <input id="longitude" name="longitude" type="text"  data-type="number" class="form-control" data-required="true" data-type="number" value="<?php echo $arr_property['longitude'];?>">
                                        </div>
					
                                        <div class="col-sm-3">
                                            <label for="region" class="req">Region</label>
                                            <select name="region" id="region" class="form-control" data-required="true">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_region as $key){?>
                                            <option value="<?php echo $key['region_id'];?>" <?php if($key['region_id'] == $arr_property['region_id']){?>selected="selected"<?php } ?>><?php echo $key['region_name'];?></option>
                                            <?php } ?>
                                            </option>
                                            </select>
                                        </div>
				
					<div class="col-sm-3">
                                            <label for="region" class="req">Location</label>
                                            <select name="location" id="location" class="form-control" data-required="true">
                                            <option value=""> Please Select </option>
                                            <?php foreach($arr_location as $key)
					    {
						?>
                                            <option value="<?php echo $key['location_id'];?>" <?php if($key['location_id'] == $arr_property['location_id']){?>selected="selected"<?php } ?>><?php echo $key['location_name'];?></option>
                                            <?php
					    
					    } ?>
                                            </option>
                                            </select>
                                        </div>
                                        
					<br class="spacer" />
					
                                        
					<br class="spacer" />
					<div class="col-sm-12">
                                            <label for="direction_to_property" class="req">Direction to Property</label>
                                            <textarea name="direction_to_property" id="wysiwg_editor2" class="form-control" data-required="true"><?php echo stripslashes($arr_property['direction_to_property']);?></textarea>
                                        </div>
                                        
					<br class="spacer" />					
                                        <h4 class="proHeadingText">Distances From</h4>
					
					<div class="col-sm-4">
                                            <label for="nearest_mall" class="req">Phuket Town</label>
					     <input id="phukettown_distance" name="phukettown_distance" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['phukettown_distance']);?>">
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_supermarket" class="req">Patong</label>
					    <input id="patong_distance" name="patong_distance" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['patong_distance']);?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_atm" class="req">Phuket International Airport</label>
					    <input id="phuketairport_distance" name="phuketairport_distance" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['phuketairport_distance']);?>">
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					
					<h4 class="proHeadingText">Walking Distance Nearby</h4>
					<div class="col-sm-4">
                                            <label for="nearest_restaurant" class="req">Nearest Walking Distance 1</label>
					    <input id="walkingdistance_1" name="walkingdistance_1" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['walkingdistance_1']);?>">
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="walkingdistance_2" class="req">Nearest Walking Distance 2</label>
					    <input id="walkingdistance_2" name="walkingdistance_2" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['walkingdistance_2']);?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="walkingdistance_3" class="req">Nearest Walking Distance 3</label>
					    <input id="walkingdistance_3" name="walkingdistance_3" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['walkingdistance_3']);?>">
                                        </div>
                                        <br class="spacer" />
					
					<?php /* ?>
					<div class="col-sm-4">
                                            <label for="distance_from_airport" class="req">Phuket Airport</label>
					    <select name="distance_from_airport" id="distance_from_airport" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['distance_from_airport']); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="distance_from_beach" class="req">Nearest Beach</label>
					    <select name="distance_from_beach" id="distance_from_beach" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['distance_from_beach']); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="distance_from_patong" class="req">Patong</label>
					    <select name="distance_from_patong" id="distance_from_patong" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['distance_from_patong']); ?>
					    </select>
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					<div class="col-sm-4">
                                            <label for="nearest_mall" class="req">Nearest Mall</label>
					    <select name="nearest_mall" id="nearest_mall" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_mall']); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_supermarket" class="req">Nearest Supermarket</label>
					    <select name="nearest_supermarket" id="nearest_supermarket" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_supermarket']); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_atm" class="req">Nearest ATM</label>
					    <select name="nearest_atm" id="nearest_atm" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_atm']); ?>
					    </select>
                                        </div>
                                        <br class="spacer" /><br class="spacer" />
					<div class="col-sm-4">
                                            <label for="nearest_restaurant" class="req">Nearest Restaurant</label>
					    <select name="nearest_restaurant" id="nearest_restaurant" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_restaurant']); ?>
					    </select>
                                        </div>    
                                        <div class="col-sm-4">
                                            <label for="nearest_golfcourse" class="req">Nearest Golf Course</label>
					    <select name="nearest_golfcourse" id="nearest_golfcourse" class="form-control required" data-required="true">
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_golfcourse']); ?>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="nearest_bar" class="req">Nearest Bar</label>
					    <select name="nearest_bar" id="nearest_bar" class="form-control required" data-required="true" >
						<option value="">Please Select</option>
						<?php echo distance_from_arr($arr_property['nearest_bar']); ?>
					    </select>
                                        </div>
                                        <br class="spacer" />
                                        <?php */ ?>
                                        <br class="spacer" />
                                        <h4 class="proHeadingText">Other information</h4>
                                        
                                        <div class="col-sm-3">
                                            <label for="page_title" class="req">Page Title</label>
                                            <input id="page_title" name="page_title" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['page_title']);?>">
                                        </div>
                                        
					<div class="col-sm-3">
                                            <label for="optional_title" class="req">Optional Title</label>
                                            <input id="optional_title" name="optional_title" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['optional_title']);?>">
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <label for="local_information" class="req">Local Information</label>
                                            <input id="local_information" name="local_information" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['local_information']);?>">
                                        </div>
					
					<div class="col-sm-3">
                                            <label for="local_information" class="req">Tag for Similar Property</label>
                                            <input id="similar_property_tag" name="similar_property_tag" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['similar_property_tag']);?>">
                                        </div> 
                                        
                                        <br class="spacer" />                                        
                                        
					<div class="col-sm-12">
                                            <label for="seo_title" class="req">SEO Title</label>
                                            <input name="seo_title" id="seo_title" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['seo_title']);?>" maxlength="69">
					    <span id="seo_title_count"><?php echo strlen($arr_property['seo_title']);?></span><span>/69</span>
					</div>
					
                                        <div class="col-sm-12">
                                            <label for="meta_description" class="req">Meta Description</label>
                                            <input id="meta_description" name="meta_description" type="text" class="form-control" data-required="true" value="<?php echo stripslashes($arr_property['meta_description']);?>" maxlength="155">
					    <span id="meta_description_count"><?php echo strlen($arr_property['meta_description']);?></span><span>/155</span>
					</div>
					
					<br class="spacer" />
					
					<br class="spacer" />
					<h4 class="proHeadingText">Property Description</h4>
					<div class="col-sm-12">
					    <label for="property_description">Property Description</label>
					    <!--<iframe name="test123" id="wysiwg_simple"></iframe>-->
					    <textarea name="property_description" id="wysiwg_simple"><?php echo stripslashes($arr_property['property_description']);?></textarea>
					</div>
					<br class="spacer" />					
					<div class="col-sm-12">
                                            <label for="property_info_onsite">Important Information (onsite)</label>
                                            <input type="text" id="property_info_onsite" name="property_info_onsite" type="text" class="form-control" value="<?php echo stripslashes($arr_property['property_info_onsite']);?>"  />
                                        </div>
					<br class="spacer" />
					<div class="col-sm-12">
                                            <label for="property_internal_info">Important Internal Information</label>
                                            <textarea  id="property_internal_info" name="property_internal_info"  class="form-control"><?php echo stripslashes($arr_property['property_internal_info']);?></textarea>
                                        </div>
                                        
                                        <br class="spacer" />
                                    	
                                        <h4 class="proHeadingText">Property Manager Information&nbsp;&nbsp;<!--<input type="checkbox" name="owner_is_manager" id="owner_is_manager" value="Yes">&nbsp;Owner is core contact--></h4>
					<div class="col-sm-12">
                                            <label for="property_manager_name"><legend>1<sup>st</sup> Contact Person</legend></label>
                                        </div>
					<div class="col-sm-4">
                                            <label for="property_manager_name">Manager Salutation</label>
                                            <select name="manager_salutations" id="manager_salutations" class="form-control">
						<option value="Mr." <?php if($arr_property['manager_salutations'] == 'Mr.'){?>selected="selected"<?php } ?>>Mr.</option>
						<option value="Mrs." <?php if($arr_property['manager_salutations'] == 'Mrs.'){?>selected="selected"<?php } ?>>Mrs.</option>
					    </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="property_manager_name">Property Manager Name</label>
                                            <input id="property_manager_name" name="property_manager_name" type="text" class="form-control" value="<?php echo stripslashes($arr_property['property_manager_name']);?>" >
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_email" >Manager Email</label>
                                            <input id="manager_email" name="manager_email" type="text" class="form-control" data-type="email" value="<?php echo stripslashes($arr_property['manager_email']);?>" >
                                        </div>
					<br class="spacer" />
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number1" >Manager Contact Number1</label>
                                            <input id="manager_contact_number1" name="manager_contact_number1" type="text" class="form-control" value="<?php echo stripslashes($arr_property['manager_contact_number1']);?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number2">Manager Contact Number2</label>
                                            <input id="manager_contact_number2" name="manager_contact_number2" type="text" class="form-control" value="<?php echo stripslashes($arr_property['manager_contact_number2']);?>">
                                        </div>
					
					<?php $manager_arr = explode(',', $arr_property['manager_lang_id']);?>
					
                                        <div class="col-sm-4">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"> <label for="indoor_size">Manager Spoken Language</label></div>
						<input id="manager_lang_id" name="manager_lang_id" type="text" class="form-control" value="<?php echo $arr_property['manager_lang_id'];?>">
						<!--
						<div class="multiSelectBoxInn">
						    <ul>
							<?php
							foreach($arr_language_name as $arr_language_names)
							{
							?>
							 <li><input name="manager_lang_id[]" type="checkbox" value="<?php echo $arr_language_names['lang_id'];?>" <?php if(in_array($arr_language_names['lang_id'], $manager_arr)){?>checked<?php } ?> /><label><?php echo $arr_language_names['lang_name'];?></label></li>
							
							<?php
							}
							?>
						    
						    </ul>
						</div>
						-->
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
						
						<option value="Mr." <?php if($arr_property['second_manager_salutations'] == 'Mr.'){?>selected="selected"<?php } ?>>Mr.</option>
						<option value="Mrs." <?php if($arr_property['second_manager_salutations'] == 'Mrs.'){?>selected="selected"<?php } ?>>Mrs.</option>
					    </select>
                                        </div>
					<div class="col-sm-4">
                                            <label for="property_manager_name">Second Property Manager Name</label>
                                            <input id="second_manager_name" name="second_manager_name" type="text" class="form-control" value="<?php echo stripslashes($arr_property['second_manager_name']);?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_email">Second Manager Email</label>
                                            <input id="second_manager_email" name="second_manager_email" type="text" class="form-control" data-type="email" value="<?php echo stripslashes($arr_property['second_manager_email']);?>" >
                                        </div>
					<br class="spacer" />
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number1">Second Manager Contact Number1</label>
                                            <input id="second_manager_contact1" name="second_manager_contact1" type="text" class="form-control" value="<?php echo stripslashes($arr_property['second_manager_contact1']);?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="manager_contact_number2">Second Manager Contact Number2</label>
                                            <input id="second_manager_contact2" name="second_manager_contact2" type="text" class="form-control" value="<?php echo stripslashes($arr_property['second_manager_contact2']);?>">
                                        </div>
					
					<?php $manager_second_lang_arr = explode(',', $arr_property['second_manager_lang_id']);?>

					<div class="col-sm-4">
					    <div class="multiSelectBoxPan">
						<div class="multiSelectBoxHead"> <label for="indoor_size">Second Manager Spoken Language</label></div>
						<input id="second_manager_lang_id" name="second_manager_lang_id" type="text" class="form-control" value="<?php echo $arr_property['second_manager_lang_id'];?>">
						<!--<div class="multiSelectBoxInn">
						    <ul>
							<?php
							foreach($arr_language_name as $arr_language_names)
							{
							?>
							 <li><input name= "second_manager_lang_id[]" type="checkbox" value="<?php echo $arr_language_names['lang_id'];?>" <?php if(in_array($arr_language_names['lang_id'], $manager_second_lang_arr)){?>checked<?php } ?> /><label><?php echo $arr_language_names['lang_name'];?></label></li>
							
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
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset">Save</button>
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


$("#owner_is_manager").click(function(){
    if($(this).is(':checked')){
	//alert('hi');
	
	/*$("#manager_salutations").attr('readonly', true);
	$("#property_manager_name").attr('readonly', true);
	$("#manager_email").attr('readonly', true);
	$("#manager_contact_number1").attr('readonly', true);
	$("#manager_contact_number2").attr('readonly', true); 
	$(".manager_lang_class").attr("disabled", true);*/	
	/*
	 <input type ="hidden" id="mr_mrs" value="<?php echo $arr_owner[0]['mr_mrs'];  ?>"  >
				<input type ="hidden" id="email" value="<?php echo $arr_owner[0]['email'];  ?>"  >
				<input type ="hidden" id="phone_no_one" value="<?php echo $arr_owner[0]['phone_number_home'];  ?>"  >
				<input type ="hidden" id="phone_no_second" value="<?php echo $arr_owner[0]['phone_number_cell'];  ?>"  >
				<input type ="hidden" id="lang_id" value="<?php echo $arr_owner[0]['lang_id'];  ?>"  >
	 
	 */
	
	var langstring = $("#lang_id").val();
	langarray = langstring.split(",");
	//alert(langarray[0]);
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

	$( ".clang li").each(function(index){
	    //alert(index);
	   //alert((".clang li").html());
      
	});
	
	
	//$(this + ':selected')
	
    }
    else
    {
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
	
	//$(".manager_lang_class").removeAttr("disabled");
    }
   
});



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
</script>