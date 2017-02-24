<? if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="main_content_outer" class="clearfix">
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
                        <h4 class="panel-title">Add Rental Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
                	
                    <ul class="property_tab">
                        <li class="active"><a id="property_information_div" class="property_menu">Rental Property Details</a></li>
                        <li><a class="blank_tab" href="javascript:void(0);">Rental Prices</a></li>
			<li><a class="blank_tab" href="javascript:void(0);">Property Images</a></li>
                    </ul>
                    <div class="clear"></div>
			    
                    		<div id="property_information_fieldset" class="property_tag_class">
				<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>rentals/add/">
				<input type="hidden" name="action" value="Process">				    
				<fieldset>

                                <div class="row basic_info">
                                    <div class="col-sm-12">
					<div class="section-one panel panel-default panelOne" >
					    <div class="panel-heading">
						 <h2 class="panel-title"><strong>General</strong> </h2>
					    </div>
					    
					  
					    
					    <div class="col-sm-6">
						<label for="property_name" class="req">Property Name - Official
						    <span class="label label-info  hint--right hint--info" data-hint="Real name of the property as stated by the owner or development"><strong>?</strong></span>
						</label>
						<input title="Real name of the property as stated by the owner or development" name="property_name" id="property_name" value="<?php echo set_value('property_name');?>" type="text" data-required="true" class="form-control " />
					    </div>
					    
					    
					    <div class="col-sm-6">
						<label for="page_title" class="req">Display Title
						  <span class="label label-info  hint--right hint--info" data-hint="The display name of the property on the website"><strong>?</strong></span>
						</label>
						<input id="page_title" title="The display name of the property on the website" name="page_title" type="text" class="form-control" data-required="true" value="<?php echo set_value('page_title');?>">
                        </div>
                        <br class="spacer" />
					    
					     <div class="col-sm-6">
						<label for="page_title" class="req">Optional Title
						  <span class="label label-info  hint--right hint--info" data-hint="The optional name of the property on the website to be displayed on the list and details"<strong>?</strong></span>
						</label>
						<input id="page_title" title="The optional name of the property on the website to be displayed on the list and details" name="optional_title" type="text" class="form-control" data-required="true" value="<?php echo set_value('optional_title');?>">
					</div>
					    
					    
					    <div class="col-sm-6">
						<label for="property_type" class="req">Property Type
						    <span class="label label-info  hint--right hint--info" data-hint="The Type of Property (e.g. Villa or Apartment)"><strong>?</strong></span>
						</label>
						<?php if(is_array($arr_property_type)) { ?>
						<select name="property_type" title="Seletc your type of your property" id="property_type" data-required="true"  class="form-control">
						<option value="">--Select Property Types--</option>    
						<?php foreach($arr_property_type as $key){?>
						<option value="<?php echo $key['property_type_id'];?>" <?php echo  set_select('property_type',$key['property_type_id'])?> ><?php echo $key['property_name'];?></option>
						<?php } ?>
						</select>
						<?php } ?>
					    </div>
					<br class="spacer" />    
					    <div class="col-sm-6">
						<label for="property_ranking">Results Ranking
						    <span class="label label-info  hint--right hint--info" data-hint="10 Best - 1 Worse (Rank of Property in Results Order)"><strong>?</strong></span>
						</label>
						<select title="Give a rank for this property" name="property_ranking" id="property_ranking" class="form-control">
						    <option value="">--Select Rank--</option>
						    <option value="1" <?php echo set_select('property_ranking',1)?> >1</option>
						    <option value="2" <?php echo set_select('property_ranking',2)?> >2</option>
						    <option value="3" <?php echo set_select('property_ranking',3)?> >3</option>
						    <option value="4" <?php echo set_select('property_ranking',4)?> >4</option>
						    <option value="5"  <?php echo set_select('property_ranking',5)?> >5</option>
						    <option value="6"  <?php echo set_select('property_ranking',6)?> >6</option>
						    <option value="7" <?php echo set_select('property_ranking',7)?> >7</option>
						    <option value="8"  <?php echo set_select('property_ranking',8)?> >8</option>
						    <option value="9"  <?php echo set_select('property_ranking',9)?> >9</option>
						    <option value="10" <?php echo set_select('property_ranking',10)?> >10</option>
						
						</select>
					     </div>
					    
					    
					    <div class="col-sm-6">
						<label for="local_information" class="req">Property Currency
						    <span class="label label-info  hint--right hint--info" data-hint="The currency in which Property will be valued."><strong>?</strong></span>
						</label>
						<select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
						    <option value="">---Please Select---</option>
						    <option value="THB">THB</option>
						    <option value="USD">USD</option>
						</select>
					    </div>
					    
					    <br class="spacer" />
					    <div class="col-sm-6">
						<label for="seo_title" class="req">Meta Title
						    <span class="label label-info  hint--right hint--info" data-hint="This is the Title for SEO"><strong>?</strong></span>
						</label>
						
						<textarea name="seo_title" id="seo_title" class="form-control" data-required="true" ><?php echo set_value('seo_title');?></textarea>
						
						<span id="seo_title_count" class="countText"><?php echo strlen(set_value('meta_description')); ?></span><span>/69</span>
					    </div>
					     <div class="col-sm-6">
						<label for="meta_description" class="req">Meta Description
						    <span class="label label-info  hint--right hint--info" data-hint="This is the Decryption for SEO"><strong>?</strong></span>
						</label>
						<textarea name="meta_description" id="meta_description" data-required="true" class="form-control" maxlength="155"><?php echo set_value('meta_description');?></textarea>
						
						<span id="meta_description_count" class="countText"><?php echo strlen(set_value('meta_description')); ?></span><span>/155</span>
					    </div>
					    
					     <br class="spacer" />
					    <div class="col-sm-6">
						<label for="local_information" >Similar Property Tag
						    <span class="label label-info  hint--right hint--info" data-hint="Display Tag on the Similar Property"><strong>?</strong></span>
						</label>
						<input id="similar_property_tag" name="similar_property_tag" type="text" class="form-control"  value="<?php echo set_value('similar_property_tag');?>">
					    </div>
					    
					    
					    <br class="spacer" />
					   
					    
		
					</div> <!-- Section One -->
					
					<br class="spacer">
					<div class="section-two panel panel-default panelTwo" >
					     <div class="panel-heading">
						 <h2 class="panel-title"><strong>Description</strong> </h4>
					    </div>
					    
					    <br class="spacer" />
					
					    <div class="col-sm-6">
						<label for="bedrooms" class="req">Bedrooms
						    <span class="label label-info  hint--right hint--info" data-hint="Number of Bedrooms in Property"><strong>?</strong></span>
						</label>
						<select id="bedrooms" name="bedrooms" data-required="true" class="form-control">
						    <option value="">Please Select</option>
						    <?php for($b=1;$b<13;$b++){?>
						    <option value="<?php echo $b;?>"><?php echo $b;?></option>
						    <?php } ?>
						</select>
					    </div>
						
					    <div class="col-sm-6">
						<label for="bathrooms">Bedroom Configuration
						    <span class="label label-info  hint--right hint--info" data-hint="How the bedrooms are laid out over property"><strong>?</strong></span>
						</label>
						<input type="text" name="bedroom_configuration" id="bedroom_configuration" value="" class="form-control">
					    </div>
					    <br class="spacer" />
					    
						
					    <div class="col-sm-6">
						<label for="bathrooms">Bathrooms
						    <span class="label label-info  hint--right hint--info" data-hint="Number of Bathrooms in Property - Shower & Toilet"><strong>?</strong></span>
						</label>
						<select id="bathrooms" name="bathrooms" data-required="true" class="form-control">
						    <option value="">Please Select</option>
						    <?php for($b=1;$b<13;$b++){?>
						    <option value="<?php echo $b;?>"  <?php echo set_select('bathrooms', $b); ?> ><?php echo $b;?></option>
						    <?php } ?>
						</select>
					    </div>
					    
					    <div class="col-sm-6">
						<label for="bedrooms">Bathroom Configuration
						    <span class="label label-info  hint--right hint--info" data-hint="How the bathrooms are laid out over property"><strong>?</strong></span>
						</label>
						<input type="text" name="bathroom_configuration" id="bathroom_configuration" value="" class="form-control">
					    </div>
					    <br class="spacer" />
					    
					    
					    <div class="col-sm-6 checkBox">
						<label for="is_studio">Studio
						    <span class="label label-info  hint--right hint--info" data-hint="Small apartment which combines living room, bedroom, and kitchenette into a single room"><strong>?</strong></span>
						</label>
						<input type="radio" class="form-control radion_frm_class" value="Yes" id="is_studio" name="is_studio" <?php echo  set_radio('is_studio',"Yes")?>>
						<span class="radio_lebel">Yes</span>
						<input type="radio" class="form-control radion_frm_class" value="No" id="is_studio" name="is_studio" <?php echo set_radio('is_studio',"No",true)?> >
						<span class="radio_lebel">No</span>
					    </div>
					    
					    <div class="col-sm-6">
						<label for="Sleeps" class="req">Sleeps
						    <span class="label label-info  hint--right hint--info" data-hint="Number of Guests that property can sleep"><strong>?</strong></span>
						</label>
						<select id="sleeps" name="sleeps" data-required="true" class="form-control required">
						    <option value="">Please Select</option>
						    <?php for($b=1;$b<25;$b++){?>
						    <option value="<?php echo $b;?>"><?php echo $b;?></option>
						    <?php } ?>
						</select>
					    </div>
					    
					    <br class="spacer" />
					    <br class="spacer" />
					    <fieldset class="featureHeadText">
						<legend><span>Features</span></legend>
					    </fieldset>
					    <div class="col-sm-6">
						<label for="latitude">Feature - 1
						     <span class="label label-info  hint--right hint--info" data-hint="The Features in the description fields on results page"><strong>?</strong></span>
						</label>
						<input type="text" id="special_feature1" name="special_feature1" class="form-control" value="<?php echo set_value("special_feature1");?>">
					    </div>
					    
					    <div class="col-sm-6">
						<label for="latitude">Feature - 2
						    <span class="label label-info  hint--right hint--info" data-hint="The Features in the description fields on results page"><strong>?</strong></span>
						</label>
						<input type="text" id="special_feature2" name="special_feature2" class="form-control" value="<?php echo set_value("special_feature2");?>">
					    </div>
                        <br class="spacer" />
					    
					    <div class="col-sm-6">
						<label for="latitude">Feature - 3
						    <span class="label label-info  hint--right hint--info" data-hint="The Features in the description fields on results page"><strong>?</strong></span>
						</label>
						<input type="text" id="special_feature3" name="special_feature3" class="form-control" value="<?php echo set_value("special_feature3");?>">
					    </div>
					    
					    <div class="col-sm-6">
						<label for="latitude">Feature - 4
						    <span class="label label-info  hint--right hint--info" data-hint="The Features in the description fields on results page"><strong>?</strong></span>
						</label>
						<input type="text" id="special_feature4" name="special_feature4" class="form-control" value="<?php echo set_value("special_feature4");?>">
					    </div>
					    <br class="spacer" />
					    <br class="spacer" />
					    
					    <div class="col-sm-12">
						<label for="property_description" class="req">Property Description
						    <span class="label label-info  hint--right hint--info" data-hint="The full textual description of the property"><strong>?</strong></span>
						</label><br class="spacer" />
						<textarea name="property_description" data-required="true" class="ckeditor"><?php echo set_value('property_description');?></textarea>
					    </div>
					     <br class="spacer">
					    <br class="spacer">
					    <div class="col-sm-6">
						<label for="developer_name">Special Offer Heading
						     <span class="label label-info  hint--right hint--info" data-hint="Heading Of Special Offer "><strong>?</strong></span>
						</label>
						<input id="special_offer_title" maxlength="18" name="special_offer_title" type="text" class="form-control" value="<?php echo set_value('special_offer_title');?>">
						<div class="char-count"><span id="special_offer_title_count" class="countText"><?php echo strlen(set_value('special_offer_title')); ?></span><span>/18</span></div>
					    </div>
					    
					    <div class="col-sm-6">
						<label for="developer_name">Special Offer Text
						     <span class="label label-info  hint--right hint--info" data-hint="Text Of Special Offer "><strong>?</strong></span>
						</label>
						<input id="special_offer_text" maxlength="50" name="special_offer_text" type="text" class="form-control" value="<?php echo set_value('special_offer_text');?>">
						 <div class="char-count"><span id="special_offer_text_count" class="countText"><?php echo strlen(set_value('special_offer_text')); ?></span><span>/50</span></div>
					    </div>
					    <br class="spacer" />
						
					</div>
					    <br class="spacer">
						
					<div class="section-three panel panel-default panelThree" >
					    <div class="panel-heading">
						 <h2 class="panel-title"><strong>Location</strong> </h4>
					    </div>
					    
					     <div class="col-sm-6">
						<label for="region" class="req">Region
						    <span class="label label-info  hint--right hint--info" data-hint="Select the Region of the Property"><strong>?</strong></span>
						</label>
						<select name="region" id="region" class="form-control" data-required="true">
						    <option value=""> Please Select </option>
						    <?php foreach($arr_region as $key){?>
							<option value="<?php echo $key['region_id'];?>" <?php echo set_select('region',  $key['region_id']); ?>   ><?php echo $key['region_name'];?></option>
						    <?php } ?>
						</option>
						</select>
					      </div>
						
					    <div class="col-sm-6">
						<label for="region" class="req">Location
						    <span class="label label-info  hint--right hint--info" data-hint="Select the Location of the Property"><strong>?</strong></span>
						</label>
						<select name="location" id="location" class="form-control" data-required="true">
						<option value=""> Please Select </option>
						
						</option>
						</select>
					    </div>
                          <br class="spacer" />
						
					    <div class="col-sm-6">
						<label for="latitude" class="req">Latitude
						    <span class="label label-info  hint--right hint--info" data-hint="Latitude of Property for Google Maps"><strong>?</strong></span>
						</label>                                            
						<input type="text" id="latitude" name="latitude" class="form-control" data-required="true" data-type="number" value="<?php echo set_value('latitude');?>">
					    </div>
						
					    <div class="col-sm-6">
						<label for="longitude" class="req">Longitude
						    <span class="label label-info  hint--right hint--info" data-hint="Longitude of Property for Google Maps"><strong>?</strong></span>
						<a id="review_map" href="https://maps.google.com/" target="_blank">Review Map</a></span></label>
						<input id="longitude" name="longitude" type="text"  data-type="number" class="form-control" data-required="true" data-type="number" value="<?php echo set_value('longitude');?>">
					    </div>
                        
					    <br class="spacer" />
					    <br class="spacer" />
					    
					    <fieldset class="featureHeadText">
						<legend><span>Distance</span></legend>
					    </fieldset>
					    
					    <div class="col-sm-6">
						<label for="nearest_mall" class="req">Phuket Town (KM)
						    <span class="label label-info  hint--right hint--info" data-hint="The distance from Phuket Town in KM"><strong>?</strong></span>
						</label>
						
						 <input id="phukettown_distance" name="phukettown_distance" type="text" class="form-control" data-required="true" value="<?php echo set_value('phukettown_distance'); ?>">
						
					    </div>    
					    <div class="col-sm-6">
						<label for="nearest_supermarket" class="req">Patong (KM)
						    <span class="label label-info  hint--right hint--info" data-hint="The distance from Patong in KM"><strong>?</strong></span>
						</label>
						
						<input id="patong_distance" name="patong_distance" type="text" class="form-control" data-required="true" value="<?php echo set_value('patong_distance');  ?>">
						
					    </div>
                          <br class="spacer" />
					    <div class="col-sm-6">
						<label for="nearest_atm" class="req">Phuket International Airport (KM)
						     <span class="label label-info  hint--right hint--info" data-hint="The distance from Phuket International Airport in KM"><strong>?</strong></span>
						    
						</label>
						
						<input id="phuketairport_distance" name="phuketairport_distance" type="text" class="form-control" data-required="true" value="<?php echo set_value('phuketairport_distance');?>">
						 
					    </div>
					
					    <div class="col-sm-6">
						<label for="nearest_restaurant" class="req">Nearest Walking Distance 1
						    <span class="label label-info  hint--right hint--info" data-hint="The nearest local noteworthy place to walk to and the distance"><strong>?</strong></span>
						</label>
						<input id="walkingdistance_1" name="walkingdistance_1" type="text" class="form-control" data-required="true" value="<?php echo set_value('walkingdistance_1');?>">
					    </div>    
                          <br class="spacer" />
					    <div class="col-sm-6">
						<label for="walkingdistance_2" class="req">Nearest Walking Distance 2
						    <span class="label label-info  hint--right hint--info" data-hint="The 2nd nearest local noteworthy place to walk to and the distance"><strong>?</strong></span>
						</label>
						<input id="walkingdistance_2" name="walkingdistance_2" type="text" class="form-control" data-required="true" value="<?php echo set_value('walkingdistance_2');?>">
					    </div>
					    <div class="col-sm-6">
						<label for="walkingdistance_3" class="req">Nearest Walking Distance 3
						    <span class="label label-info  hint--right hint--info" data-hint="The 3rd nearest local noteworthy place to walk to and the distance"><strong>?</strong></span>
						</label>
						<input id="walkingdistance_3" name="walkingdistance_3" type="text" class="form-control" data-required="true" value="<?php echo set_value('walkingdistance_3');?>">
					    </div>
					   
					    <br class="spacer" /><br class="spacer" />
					    
					
						
					</div> <!-- Section Three -->
                                        <br class="spacer" />
					
					<div class="section-four-one panel panelFour panel-default" >
					    
					     <div class="panel-heading">
						 <h2 class="panel-title"><strong>Necessary Rental Information </strong> </h4>
					    </div>
					    <br class="spacer" />
					    
					    <div class="col-sm-12 checkBox">
						<label for="is_studio" class="smallGapL">Cancellation Policy
						    <span class="label label-info  hint--right hint--info" data-hint="Cancellation Policy"><strong>?</strong></span>
						</label>
						<input type="radio" class="form-control radion_frm_class" value="Flexible" id="cancellation_policy1" name="cancellation_policy" <?php echo  set_radio('cancellation_policy',"Flexible")?>>
						<span class="radio_lebel">Flexible</span>
						<input type="radio" class="form-control radion_frm_class" value="Moderate" id="cancellation_policy2" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"Moderate",true)?> >
						<span class="radio_lebel">Moderate</span>
						<input type="radio" class="form-control radion_frm_class" value="Strict" id="cancellation_policy3" name="cancellation_policy" checked="checked" <?php echo set_radio('cancellation_policy',"Strict",true)?>>
						<span class="radio_lebel">Strict</span>
						<input type="radio" class="form-control radion_frm_class" value="SuperStrict" id="cancellation_policy4" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"SuperStrict")?> >
						<span class="radio_lebel">Super Strict</span>
						<input type="radio" class="form-control radion_frm_class" value="LongTerm" id="cancellation_policy4" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"LongTerm")?> >
						<span class="radio_lebel">Long Term</span>						
					    </div>
					    
					    <br class="spacer" />
					    
					    <div class="col-sm-6">
						<label for="sales_price_from" class="req">Check In Time
						     <span class="label label-info  hint--right hint--info" data-hint="Check In Time"><strong>?</strong></span>
						</label>
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
					    					    
					    <div class="col-sm-6">
						<label for="sales_price_from" class="req">Check Out Time
						     <span class="label label-info  hint--right hint--info" data-hint="Check Out Time"><strong>?</strong></span>
						</label>
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
					    
					    
					    <br class="spacer" />
					    
					     <div class="col-sm-12 sptBlock">
						<label for="local_information" class="smallGapL">Check In- Check Out Text
						    <span data-hint="Display Tag on the Similar Property" class="label label-info  hint--right hint--info"><strong>?</strong></span>
						</label>
						<input value="" type="text" class="form-controltwo smallGapI" name="check_in_out_text" id="check_in_out_text">
					    </div>
					     <br class="spacer" />
					     
					    <div class="col-sm-6">
						<label for="Security Deposit" class="req">Security Deposit
						    <span class="label label-info  hint--right hint--info" data-hint="Security Deposit"><strong>?</strong></span>
						</label>
						<input id="security_deposit" name="security_deposit" type="text" class="form-control" data-required="true" value="<?php echo set_value('security_deposit');?>">
					    </div>
					    
					    <div class="col-sm-6">
						<label for="walkingdistance_3" >Security Deposit Text
						    <span class="label label-info  hint--right hint--info" data-hint="The Security Deposit Special Text,if any"><strong>?</strong></span>
						</label>
						<input id="security_deposit_text" name="security_deposit_text" type="text" class="form-control"  value="<?php echo set_value('security_deposit_text');?>">
					    </div>
					   
					    <br class="spacer" />
					     
					    
					     <div class="col-sm-12 checkBox">
						<label for="is_studio" class="smallGapL">Managed on KIGO
						    <span class="label label-info  hint--right hint--info" data-hint="Please check the radio if its Managed on KIGO.net"><strong>?</strong></span>
						</label>
						<input type="radio" class="form-control radion_frm_class" value="yes" id="on_kigo" name="on_kigo" <?php echo set_radio('on_kigo',"yes")?>>
						<span class="radio_lebel">Yes</span>
						<input type="radio" class="form-control radion_frm_class" value="no" id="on_kigo1" name="on_kigo" checked="checked" <?php echo set_radio('on_kigo',"no",true)?>>
						<span class="radio_lebel">No</span>						
					    </div>
					     <br class="spacer" />
					     
					     <div class="col-sm-12 checkBox" id="is_kigo_id">
						<label for="is_studio" class="smallGapL">KIGO Property #
						    <span class="label label-info  hint--right hint--info" data-hint="Property # on  KIGO.net for this property"><strong>?</strong></span>
						</label>
						<input id="kigo_id" name="kigo_id" type="text" class="form-control" data-required="true" value="<?php echo set_value('kigo_id');?>">						
					    </div>
					     
					<br class="spacer" />
					     
					     
					     
					</div><!-- Section four-one -->
					<br class="spacer" />
					<div class="section-four panel panel-default panelFour" >
					    
					     <div class="panel-heading">
						 <h2 class="panel-title"><strong>Amenities</strong> </h4>
					    </div>
					    
					    <h4 class="proHeadingText">
					    
					    <span class="h4-span">Describe the amenities for your property by clicking on the check box next to any amenity that is applicable to your listing. You can add details to any amenity by clicking on the "add details" link to the right of any selected amenity.</span></h4>
					    
					      <?php
					    $amenity_arr = '';
					    if( isset($amenity_arr) && is_array($amenity_arr) ){
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
					    <input name="rentals_serial_no" id="rentals_serial_no" data-required="true" type="hidden" class="form-controlone" value="">
					    <div class="formPanSec">
					     <div class="rightPan">
					     <?php foreach($arr_prop_amenity as $prop_amenity_val) { 
						 if($featured_category_name == $prop_amenity_val['featured_category_name']) {
						 ?>
						     
						     <div class="col-sm-4">
						     <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
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
						 
						 <div class="col-sm-4">
						     <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" class="amenity_class">
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
					    
				       </div><!-- Section four -->
                                        
					
                                        <br class="spacer" />
                                        <div class="save_div_class">
						<input type="hidden" name="frontend_url" id="frontend_url" value="<?php echo FRONTEND_URL; ?>" />
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset">Save & Continue</button>
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


$('.parsley_reg').parsley('removeItem', '#kigo_id'); 

$("#on_kigo").click(function(){
  
   $("#is_kigo_id").show();
    $('.parsley_reg').parsley('addItem', '#kigo_id'); 
    $('#kigo_id').parsley('addConstraint', {
	required: true 
    });
   //$("#kigo_id").val('');
   
});
$("#on_kigo1").click(function(){
    $('.parsley_reg').parsley('removeItem', '#kigo_id'); 
   $("#is_kigo_id").hide();
   
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
    
    $("#is_kigo_id").hide();
    
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

$(".blank_tab").on("click",function(){
    alert("Please fillup Rental property details");    
});

</script>

