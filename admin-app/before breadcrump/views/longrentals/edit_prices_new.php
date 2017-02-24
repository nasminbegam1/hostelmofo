<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-1.9.0.min.js"></script>
<link rel="stylesheet" href="<?php echo FRONT_JS_PATH; ?>jquery-ui.css">
<script src="<?php echo FRONT_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>parsley.js"></script>
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
	<?php if(isset($errmsg) && $errmsg != ""){?>
	<div align="center">
	    <div class="nNote nFailure" style="width: 600px;">
		<?php echo stripslashes($errmsg);?>
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
			        <?= $tabs; ?>
				<?php $page = $this->uri->segment(4,0);?>
				<!--<ul class="property_tab">
				    <li><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/edit_property/<?php //echo $property_id.'/'.$page;?>/">Rental Property Details</a></li>
				    <li class="active"><a class="no-cache-redirect" href="javascript:void(0);">Rental Prices</a></li>
				    <li><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/edit_property_image/<?php //echo $property_id.'/'.$page;?>/">Property Images</a></li>
				    <li ><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/contact/<?php //echo $property_id.'/'.$page;?>/">Contact</a></li>
				    <li ><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/ical_import/<?php //echo $property_id.'/'.$page;?>/">iCal Import</a></li>
				    <li ><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/payment/<?php //echo $property_id.'/'.$page;?>/">Booking</a></li>
				    <li  ><a class="no-cache-redirect" href="<?php //echo BACKEND_URL;?>rentals/edit_map_location/<?php //echo $property_id.'/'.$page;?>/">Map Location</a></li>
				</ul>-->
				<div class="clear"></div>			    
				<div id="property_rentals_fieldset" class="property_tag_class">
				    <form name="frmPropertyRental" id="frm4" enctype="multipart/form-data" method="post" class="parsley_reg" action="<?php echo BACKEND_URL;?>rentals/season_prices_new/<?php echo $property_id;?>/<?php echo $page;?>">
			    <input type="hidden" name="action" value="Process">
					<br class="spacer" />
					<div class="col-sm-12">
					    <div class="step_info">
						<h4>Property Rental Seasons</h4>
						<p>Provide the Property Rental Seasons Information here and the season prices.</p>
					    </div> 
					</div>
					
					<br class="spacer" />							  
					<h4 class="proHeadingText">Seasonal Property Rents</h4>
					    
					<!-- New Enhancement For TAB -->
					<div class="row">
					    <div class="col-sm-12 simpleTab">
						<span class="cloneSeasonPan"><a href="javascript:void(0);" class="cloneSeason">Clone Season</a></span><input type="hidden" name="clone_exist" id="clone_exist" value="0">
						<ul class="property_tab yeartab">
						<?php
						if(is_array($season_price_list) && count($season_price_list) > 0){
						    $countSeason	= 1;
						    foreach($season_price_list AS $key => $value){
						?>
						    <li <?php if($countSeason == 1){echo 'class="active"';}?>  data-itemtype="<?php echo stripslashes($key);?>" ><a id="season_holder_<?php echo stripslashes($key);?>" class="no-cache-redirect seasonHolder" href="javascript:void(0);" alt="<?php echo stripslashes($key);?>" title="<?php echo stripslashes($key);?>"><?php echo stripslashes($key);?></a></li>
						<?php
							$countSeason++;
						    }
						}else{
						?>
						    <li class="active"  data-itemtype="<?php echo date("Y");?>" ><a id="season_holder_<?php echo date("Y");?>" class="no-cache-redirect seasonHolder" href="javascript:void(0);" alt="<?php echo date("Y");?>" title="<?php echo date("Y");?>"><?php echo date("Y");?></a></li>
						<?php
						}    
						?>						    
						</ul>
						<input type="hidden" name="curr_tab" id="curr_tab" value="">
						<input type="hidden" name="property_id" id="property_id" value="<?php echo $property_id;?>">
						<!-- TAB container -->
						<?php
						if(is_array($season_price_list) && count($season_price_list) > 0){
						    $countSeason	= 1;
						    $j			= 1;
						    foreach($season_price_list AS $key=>$value){
						?>						
						    <div id="season_pan_<?php echo stripslashes($key);?>" class="property_tab_container <?php if($countSeason == 1){echo 'active';}?>">							
							<h4 class="proHeadingText">&nbsp; <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $key;?>);">Add More Seasons</a> </span></h4>
											    <div class="rentalPropCurrency">
					<div class="col-sm-3">
					    <label for="local_information" class="req">Property Currency
						<span class="label label-info  hint--right hint--info" data-hint="The currency in which Property will be valued."><strong>?</strong></span>
					    </label>
					</div>
					<div class="col-sm-3">
					    <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
						<option value="">---Please Select---</option>
						<option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'selected';} ?>>THB</option>
						<option value="USD" <?php if($property_details['property_currency']=='USD'){echo 'selected';} ?>>USD</option>
					    </select>
					</div>
				    </div>
							<br class="spacer">
							<table width="100%" id="tableSeasons_<?php echo $key;?>" class="tableSeasons">
							    <?php
							    if(is_array($value) && count($value) > 0){
								for($i=0; $i<count($value); $i++){
							    ?>
								<tr id="season_<?php echo $j;?>">
								    <td>
									<div class="col-sm-12">
									    <legend>
										<b>Season <?php echo ($i+1);?></b>
										<a id="removeSeason_<?php echo ($j);?>_<?php echo $key;?>" href="javascript:void(0);" style=" float: right;" class="removeSeason">Remove Season</a></legend>
									</div>
									<!-- Daily Price -->
									<div class="col-sm-4 rentDailyPricePan">
									    <label for="reg_input_name" class="req">Daily Price</label>
									    <input value="<?php echo $value[$i]['daily_price'];?>" name="season_daily[]" type="text" class="form-controltwo required daily-price-fld" data-required="true" data-type="number" id="dailyprice_<?php echo $j;?>" <?php if($value[$i]['daily_disc'] != 'M' && $value[$i]['daily_disc'] != ''){ echo 'readonly="true"';} ?>>
									    <input type="hidden" name="dailyPriceTmp[]" id="dailyPriceTmp_<?php echo $j;?>" value="<?php echo $value[$i]['daily_price'];?>">
									    <input value="<?php echo $value[$i]['daily_disc'];?>" name="disc_daily[]" type="hidden" id="dailydisc_<?php echo $j;?>">
									    <div id="dailyPricePan_<?php echo $j;?>" class="dailyAutoPricePan">
										<div class="pan1">
										 <span><a id="dailyMPrice_<?php echo $j;?>" href="javascript:void(0);" class="dailyMPrice <?php if($value[$i]['daily_disc'] == 'M'){ echo 'active';} ?>">M</a></span>
										 <span><a id="daily0Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily0Price <?php if($value[$i]['daily_disc'] == 0 && $value[$i]['daily_disc']!='' && $value[$i]['daily_disc']!='M'){ echo 'active';} ?>">0</a></span></div>
										 <div class="pan2">
										     <span><a id="daily5Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily5Price <?php if($value[$i]['daily_disc'] == 5){ echo 'active';} ?>">5</a></span>
										     <span><a id="daily10Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily10Price <?php if($value[$i]['daily_disc'] == 10){ echo 'active';} ?>">10</a></span>
										     <span><a id="daily15Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily15Price <?php if($value[$i]['daily_disc'] == 15){ echo 'active';} ?>">15</a></span>
										     <span><a id="daily20Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily20Price <?php if($value[$i]['daily_disc'] == 20){ echo 'active';} ?>">20</a></span>
										     <span><a id="daily25Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily25Price <?php if($value[$i]['daily_disc'] == 25){ echo 'active';} ?>">25</a></span>
										     <span><a id="daily30Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily30Price <?php if($value[$i]['daily_disc'] == 30){ echo 'active';} ?>">30</a></span>
										     <span><a id="daily35Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily35Price <?php if($value[$i]['weekly_disc'] == 35){ echo 'active';} ?>">35</a></span>
										     <span><a id="daily40Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily40Price <?php if($value[$i]['daily_disc'] == 40){ echo 'active';} ?>">40</a></span>
										     <span><a id="daily45Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily45Price <?php if($value[$i]['daily_disc'] == 45){ echo 'active';} ?>">45</a></span>
										     <span><a id="daily50Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily50Price <?php if($value[$i]['daily_disc'] == 50){ echo 'active';} ?>">50</a></span>
										 </div>
									       </div>
									</div>
									<!-- Daily Price -->
									<!-- Weekly price -->
									<div class="col-sm-4 rentWeeklyPricePan">
									    <label for="reg_input_name" class="req">Weekly Price</label>
									    <input value="<?php echo $value[$i]['weekly_price'];?>" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_<?php echo $j;?>" <?php if($value[$i]['weekly_disc'] != 'M' && $value[$i]['weekly_disc'] != ''){ echo 'readonly="true"';} ?>>
									    <input value="<?php echo $value[$i]['weekly_disc'];?>" name="disc_weekly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_<?php echo $j;?>">
									    <div id="weeklyPricePan_<?php echo $j; ?>" class="weeklyAutoPricePan">
										<div class="pan1"><span><a id="weeklyMPrice_<?php echo $j; ?>" href="javascript:void(0);" class="weeklyMPrice <?php if($value[$i]['weekly_disc'] == 'M'){ echo 'active';} ?>">M</a></span><span><a id="weekly0Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly0Price <?php if($value[$i]['weekly_disc'] == 0 && $value[$i]['weekly_disc']!=''){ echo 'active';} ?>">0</a></span></div>
										<div class="pan2">
										    <span><a id="weekly5Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly5Price <?php if($value[$i]['weekly_disc'] == 5){ echo 'active';} ?>">5</a></span>
										    <span><a id="weekly10Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly10Price <?php if($value[$i]['weekly_disc'] == 10){ echo 'active';} ?>">10</a></span>
										    <span><a id="weekly15Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly15Price <?php if($value[$i]['weekly_disc'] == 15){ echo 'active';} ?>">15</a></span>
										    <span><a id="weekly20Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly20Price <?php if($value[$i]['weekly_disc'] == 20){ echo 'active';} ?>">20</a></span>
										    <span><a id="weekly25Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly25Price <?php if($value[$i]['weekly_disc'] == 25){ echo 'active';} ?>">25</a></span>
										    <span><a id="weekly30Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly30Price <?php if($value[$i]['weekly_disc'] == 30){ echo 'active';} ?>">30</a></span>
										    <span><a id="weekly35Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly35Price <?php if($value[$i]['weekly_disc'] == 35){ echo 'active';} ?>">35</a></span>
										    <span><a id="weekly40Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly40Price <?php if($value[$i]['weekly_disc'] == 40){ echo 'active';} ?>">40</a></span>
										    <span><a id="weekly45Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly45Price <?php if($value[$i]['weekly_disc'] == 45){ echo 'active';} ?>">45</a></span>
										    <span><a id="weekly50Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly50Price <?php if($value[$i]['weekly_disc'] == 50){ echo 'active';} ?>">50</a></span>
										</div>
									    </div>
									</div>
									<!-- Weekly price -->									     <!-- Monthly price -->
									<div class="col-sm-4 rentMonthlyPricePan">
									    <label for="reg_input_name" class="req">Monthly Price</label>
									    <input value="<?php echo $value[$i]['monthly_price'];?>" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="monthlyprice_<?php echo $j; ?>" <?php if($value[$i]['monthly_disc'] != 'M' && $value[$i]['monthly_disc'] != ''){ echo 'readonly="true"';} ?>>
									    <input value="<?php echo $value[$i]['monthly_disc'];?>" name="disc_monthly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_<?php echo $j;?>">
									    <div id="monthlyPricePan_<?php echo $j; ?>" class="monthlyAutoPricePan">
										<div class="pan1"><span><a id="monthlyMPrice_<?php echo $j; ?>" href="javascript:void(0);" class="monthlyMPrice <?php if($value[$i]['monthly_disc'] == 'M'){ echo 'active';} ?>">M</a></span><span><a id="monthly0Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly0Price <?php if($value[$i]['monthly_disc'] == 0 && $value[$i]['monthly_disc']!=''){ echo 'active';} ?>">0</a></span></div>
										<div class="pan2">
										    <span><a id="monthly5Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly5Price <?php if($value[$i]['monthly_disc'] == 5){ echo 'active';} ?>">5</a></span>
										    <span><a id="monthly10Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly10Price <?php if($value[$i]['monthly_disc'] == 10){ echo 'active';} ?>">10</a></span>
										    <span><a id="monthly15Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly15Price <?php if($value[$i]['monthly_disc'] == 15){ echo 'active';} ?>">15</a></span>
										    <span><a id="monthly20Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly20Price <?php if($value[$i]['monthly_disc'] == 20){ echo 'active';} ?>">20</a></span>
										    <span><a id="monthly25Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly25Price <?php if($value[$i]['monthly_disc'] == 25){ echo 'active';} ?>">25</a></span>
										    <span><a id="monthly30Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly30Price <?php if($value[$i]['monthly_disc'] == 30){ echo 'active';} ?>">30</a></span>
										    <span><a id="monthly35Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly35Price <?php if($value[$i]['monthly_disc'] == 35){ echo 'active';} ?>">35</a></span>
										    <span><a id="monthly40Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly40Price <?php if($value[$i]['monthly_disc'] == 40){ echo 'active';} ?>">40</a></span>
										    <span><a id="monthly45Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly45Price <?php if($value[$i]['monthly_disc'] == 45){ echo 'active';} ?>">45</a></span>
										    <span><a id="monthly50Price_<?php echo $j; ?>" href="javascript:void(0);" class="monthly50Price <?php if($value[$i]['monthly_disc'] == 50){ echo 'active';} ?>">50</a></span>
										</div>
									    </div>
									</div>
									<!-- Monthly price -->
									<!-- Min. rental price -->
									<div class="col-sm-4">
									    <label for="reg_input_name" class="req">Minimum Rental Days</label>
									    <input value="<?php echo $value[$i]['minimum_rental_days'];?>" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrental_<?php echo $j;?>">
									</div>
									<!-- Min. rental price -->
									<!-- Season start date -->
									<div class="col-sm-4">
									<label for="reg_input_name" class="req">Season Start Date</label>
									<?php if($value[$i]['season_start_date'] != '' && $value[$i]['season_start_date'] != '1970-01-01 00:00:00' && $value[$i]['season_start_date'] !='0000-00-00 00:00:00'){ ?>
									  <input readonly value="<?php echo date("d/m/Y", strtotime($value[$i]['season_start_date']));?>" type="text"  title="date_start1_<?php echo $j;?>"   data-required="true"  item="<?php echo $value[$i]['price_id']; ?>"   class="season_start_date system_record form-controltwo required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[]" id="start_date_<?php echo $j; ?>">
									<?php } else { ?>
									  <input value="" type="text" title="date_start1_<?php echo $j;?>" data-required="true"  class="season_start_date form-controltwo required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[]"  id="start_date_<?php echo $j;?>" >
									<?php } ?>
									</div>
									<!-- Season start date -->
									<!-- Season end date -->
									<div class="col-sm-4">
									    <label for="reg_input_name" class="req">Season End Date</label>
									     <?php if($value[$i]['season_end_date'] != '' && $value[$i]['season_end_date'] != '1970-01-01 00:00:00' && $value[$i]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
									      <input value="<?php echo date("d/m/Y", strtotime($value[$i]['season_end_date']));?>" type="text" title="date_end1_<?php echo $j;?>" data-required="true"  class="season_start_date system_record form-controltwo required rental_end_date date_end_<?php echo $j;?>"  name="season_end_date[]" item="<?php echo $value[$i]['price_id']; ?>" id="end_date_<?php echo $j; ?>">
									    <?php } else { ?>
									  <input readonly value="" type="text" data-required="true" class="season_start_date form-controltwo required rental_end_date date_end_<?php echo $j;?>" name="season_end_date[]" title="date_end1_<?php echo $j;?>"  id="end_date_<?php echo $j;?>" >
									    <?php } ?>
									</div>
									<!-- Season end date -->
									<!-- Default season -->
									<div class="col-sm-12">
									    <div class="defaultSeason <?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'active';} ?>">
									    <label for="reg_input_name" class="req"> Is Default Season ?</label>
									    <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $j; ?>" class="is_default_hidden_class" value="<?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
									    
									   <input <?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $j;?>" onclick="setDefault(<?php echo $j; ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $j; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $j; ?>">
									    </div>
									</div>
									<!-- Default season -->
								    </td>
								</tr>
							    <?php
								    $j++;
								}
							    }    
							    ?>
							</table>
							<br class="spacer">
							<h4 class="proHeadingText">&nbsp; <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $key;?>);">Add More Seasons</a> </span></h4>
							
						    </div>						
						<?php
							$countSeason++;
						    }
						}else{
						?>
						    <div id="season_pan_<?php echo date("Y");?>" class="property_tab_container active">
							<h4 class="proHeadingText">&nbsp; <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo date("Y");?>);">Add More Seasons</a> </span></h4>
							<br class="spacer">
							<table width="100%" id="tableSeasons_<?php echo date("Y");?>" class="tableSeasons">
							    <tr id="season_1">
								<td>
								    <div class="col-sm-12">
									<legend>
									    <b>Season 1</b>
									    <a id="removeSeason_1_<?php echo date("Y");?>" href="javascript:void(0);" style=" float: right;" class="removeSeason">Remove Season</a></legend>
								    </div>
								    <!-- Daily Price -->
									<div class="col-sm-4 rentDailyPricePan">
									    <label for="reg_input_name" class="req">Daily Price</label>
									    <input value="" name="season_daily[]" type="text" class="form-controltwo required daily-price-fld" data-required="true" data-type="number" id="dailyprice_1">
									    <input type="hidden" name="dailyPriceTmp[]" id="dailyPriceTmp_1" value="">
									    <div id="dailyPricePan_1" class="dailyAutoPricePan">
									      <div class="pan1">
										  <span><a id="dailyMPrice_1" href="javascript:void(0);" class="dailyMPrice">M</a></span>
										  <span><a id="daily0Price_1" href="javascript:void(0);" class="daily0Price">0</a></span>
									      </div>
									      <div class="pan2">
										  <span><a id="daily5Price_1" href="javascript:void(0);" class="daily5Price">5</a></span>
										  <span><a id="daily10Price_1" href="javascript:void(0);" class="daily10Price">10</a></span>
										  <span><a id="daily15Price_1" href="javascript:void(0);" class="daily15Price">15</a></span>
										  <span><a id="daily20Price_1" href="javascript:void(0);" class="daily20Price">20</a></span>
										  <span><a id="daily25Price_1" href="javascript:void(0);" class="daily25Price">25</a></span>
										  <span><a id="daily30Price_1" href="javascript:void(0);" class="daily30Price">30</a></span>
										  <span><a id="daily35Price_1" href="javascript:void(0);" class="daily35Price">35</a></span>
										  <span><a id="daily40Price_1" href="javascript:void(0);" class="daily40Price">40</a></span>
										  <span><a id="daily45Price_1" href="javascript:void(0);" class="daily45Price">45</a></span>
										  <span><a id="daily50Price_1" href="javascript:void(0);" class="daily50Price">50</a></span>
									      </div>
									    </div>
									</div>
									<!-- Daily Price -->
									<!-- Weekly price -->
									<div class="col-sm-4 rentWeeklyPricePan">
									    <label for="reg_input_name" class="req">Weekly Price</label>
									    <input value="" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_1">
									    <input value="" name="disc_weekly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_1">
									    <div id="weeklyPricePan_1" class="weeklyAutoPricePan">
									      <div class="pan1">
										  <span><a id="weeklyMPrice_1" href="javascript:void(0);" class="weeklyMPrice">M</a></span>
										  <span><a id="weekly0Price_1" href="javascript:void(0);" class="weekly0Price">0</a></span></div>
									      <div class="pan2">
										  <span><a id="weekly5Price_1" href="javascript:void(0);" class="weekly5Price">5</a></span>
										  <span><a id="weekly10Price_1" href="javascript:void(0);" class="weekly10Price">10</a></span>
										  <span><a id="weekly15Price_1" href="javascript:void(0);" class="weekly15Price">15</a></span>
										  <span><a id="weekly20Price_1" href="javascript:void(0);" class="weekly20Price">20</a></span>
										  <span><a id="weekly25Price_1" href="javascript:void(0);" class="weekly25Price">25</a></span>
										  <span><a id="weekly30Price_1" href="javascript:void(0);" class="weekly30Price">30</a></span>
										  <span><a id="weekly35Price_1" href="javascript:void(0);" class="weekly35Price">35</a></span>
										  <span><a id="weekly40Price_1" href="javascript:void(0);" class="weekly40Price">40</a></span>
										  <span><a id="weekly45Price_1" href="javascript:void(0);" class="weekly45Price">45</a></span>
										  <span><a id="weekly50Price_1" href="javascript:void(0);" class="weekly50Price">50</a></span>
									      </div>
									    </div>
									</div>
									<!-- Weekly price -->									     <!-- Monthly price -->
									<div class="col-sm-4 rentMonthlyPricePan">
									    <label for="reg_input_name" class="req">Monthly Price</label>
									    <input value="" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="monthlyprice_1">
									    <input value="" name="disc_monthly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_1">
									    <div id="monthlyPricePan_1" class="monthlyAutoPricePan">
									      <div class="pan1">
										  <span><a id="monthlyMPrice_1" href="javascript:void(0);" class="monthlyMPrice">M</a></span>
										  <span><a id="monthly0Price_1" href="javascript:void(0);" class="monthly0Price">0</a></span></div>
									      <div class="pan2">
										  <span><a id="monthly5Price_1" href="javascript:void(0);" class="monthly5Price">5</a></span>
										  <span><a id="monthly10Price_1" href="javascript:void(0);" class="monthly10Price">10</a></span>
										  <span><a id="monthly15Price_1" href="javascript:void(0);" class="monthly15Price">15</a></span>
										  <span><a id="monthly20Price_1" href="javascript:void(0);" class="monthly20Price">20</a></span>
										  <span><a id="monthly25Price_1" href="javascript:void(0);" class="monthly25Price">25</a></span>
										  <span><a id="monthly30Price_1" href="javascript:void(0);" class="monthly30Price">30</a></span>
										  <span><a id="monthly35Price_1" href="javascript:void(0);" class="monthly35Price">35</a></span>
										  <span><a id="monthly40Price_1" href="javascript:void(0);" class="monthly40Price">40</a></span>
										  <span><a id="monthly45Price_1" href="javascript:void(0);" class="monthly45Price">45</a></span>
										  <span><a id="monthly50Price_1" href="javascript:void(0);" class="monthly50Price">50</a></span>
									      </div>
									    </div>
									</div>
									<!-- Monthly price -->
									<!-- Min. rental price -->
									<div class="col-sm-4">
									    <label for="reg_input_name" class="req">Minimum Rental Days</label>
									    <input value="" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrental_1">
									</div>
									<!-- Min. rental price -->
									<!-- Season start date -->
									<div class="col-sm-4">
									<label for="reg_input_name" class="req">Season Start Date</label>								
									  <input value="" type="text" title="date_start1_1" data-required="true"  class="season_start_date form-controltwo required rental_start_date date_start_1" name="season_start_date[]"  id="start_date_1" >
									</div>
									<!-- Season start date -->
									<!-- Season end date -->
									<div class="col-sm-4">
									    <label for="reg_input_name" class="req">Season End Date</label>								     
									  <input readonly value="" type="text" data-required="true" class="season_start_date form-controltwo required rental_end_date date_end_1" name="season_end_date[]" title="date_end1_1"  id="end_date_1" >
									</div>
									<!-- Season end date -->
									<!-- Default season -->
									<div class="col-sm-12">
									    <div class="defaultSeason active">
									    <label for="reg_input_name" class="req"> Is Default Season ?</label>
									    <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_1" class="is_default_hidden_class" value="Yes">
									   <input value="1" onclick="setDefault(1);" class="form-controltwo seasonDefault" id="isdefault_1" name="isDefault[]" type="radio" id="sesdefault_1" checked="checked">
									    </div>
									</div>
									<!-- Default season -->
								</td>
							    </tr>
							</table>
							<input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list);?>" />
				<input type="hidden" name="isSaveStay" id="isSaveStay" value="No" />
							<br class="spacer">
							<h4 class="proHeadingText">&nbsp; <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo date("Y");?>);">Add More Seasons</a> </span></h4>
							
						    </div>
						<?php
						    $j	= 2;
						}    
						?>
						<!-- TAB container -->
					    </div>
					</div>
					<!-- New Enhancement For TAB -->
					
					<div class="save_div_class">
					    <button class="btn btn-default frm_step_next" type="submit"  id="btn_property_sales_fieldset">Save & Continue</button>
					    <input class="btn btn-default frm_step_next" name="save-and-stay" type="submit"  id="btn_property_sales_fieldset" value="Save & Stay" >
					     <a class="btn btn-default frm_step_next no-cache-redirect " href="<?php echo BACKEND_URL;?>rentals/edit_property/<?php echo $property_id.'/'.$page;?>/">< Back</a>
					</div>
				</div>
			    
				    
				<div style="float:right;margin-top:-150px;display:none;" id="div_loader">
				    <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
				</div>
				</form>
			</div>
		    </div>	
		    </div><!-- panel-body-->		    
		</div><!-- panel panel-default -->
            </div><!-- col-sm-12 -->
        </div><!-- row -->
    <!--End : Main content-->    
</div>

<style>
    .dp-highlight .ui-state-default {
        background: #EACB54;
          color: #FFF;
        }
        
        .dp-active  .ui-state-default {
        background: #FFAF02;
          color: #FFF;
        }
        
        #availCalendar .ui-datepicker
	{
	    width: 484px;
	}
</style>
<script>
    $(document).ready(function(){
	
	var itemType =$('ul.yeartab > li.active').attr('data-itemtype');
	$('#curr_tab').val(itemType);
	
	
	$('.cloneSeason').click(function(){
	var clone_exist =  $('#clone_exist').val();
	if (clone_exist == 0) {
	var last_year = ($( ".yeartab li:last-child" ).text());
	var dt = new Date(last_year);
	var last_tr = ($('.tableSeasons tr:last').attr('id'));
	var last_id = last_tr.replace('season_', '');
	var last_dt = ($('#end_date_'+last_id).val());
	var year1 = dt.getFullYear();
	var year = dt.getFullYear()+1;
	var dt1 = '31/12/'+year1;
	if (last_dt == dt1) {
	    $( ".yeartab li:last-child" ).after("<li data-itemtype="+year+"><a id='season_holder_"+year+"' class='no-cache-redirect seasonHolder' href='javascript:void(0);' alt="+year+" title="+year+">"+year+"</a></li>");
	$('#clone_exist').val('1');
	}
	else
	{
	    alert("you have entered incomplete season "+year1);
	}
	}
	});
	
	
	$(document).on('click', '.seasonHolder', function(){
	    $('.seasonHolder').parent().removeClass('active');
	   $(this).parent().addClass('active');
	    var year	= $(this).attr('id').replace('season_holder_', '');
	    var pid	= $('#property_id').val();
	    var year1 = year-1;
	    var panID	= 'season_pan_' + year;
	    $('.property_tab_container').removeClass('active');
	    var panId1 = 'season_pan_' + year1;
	   // $('#' + panId1).addClass('active');
	    $('#' + panID).addClass('active');
	    $('#curr_tab').val(year);
	    if($('#' + panID).length == 0)
		{
	$.ajax({
		    type: "POST",
		    url: "<?php echo BACKEND_URL; ?>" + "rentals/get_season/",
		    data: {year: year,pid: pid},
		    success:function(data) {
			//alert(data);
		     $('.simpleTab').append(data);
		    }
		});
		}
	    });
    });
</script>
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH;?>rental_price.js"></script>