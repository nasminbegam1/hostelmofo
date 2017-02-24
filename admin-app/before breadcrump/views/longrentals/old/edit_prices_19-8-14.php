<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<!--<link href="<?php //echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php //echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>-->

<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-1.9.0.min.js"></script>
<link rel="stylesheet" href="<?php echo FRONT_JS_PATH; ?>jquery-ui.css">
<script src="<?php echo FRONT_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>parsley.js"></script>

<!--<style type="text/css">
.ui-datepicker-calendar tr, .ui-datepicker-calendar td, .ui-datepicker-calendar td a, .ui-datepicker-calendar th{font-size:inherit;}
div.ui-datepicker{font-size:30px;width:inherit;height:inherit;}
.ui-datepicker-title span{font-size:16px;}

.ui-datepicker th {
    color: #656565;
    font-size: 14px;
    line-height: 30px;
    padding: 5px 0;
    text-shadow: 0 1px 0 #FFFFFF;
}
.ui-datepicker .ui-state-default {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: #999999;
    display: block;
    font-size: 22px !important;
    font-weight: bold;
    height: 68px;
    line-height: 55px;
    opacity: 1;
    padding: 0;
    text-align: center;
    text-shadow: 0 1px 0 #FFFFFF;
    width: 68px;
}
</style>-->

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
                     <?php $page = $this->uri->segment(4,0); ?>
		    <ul class="property_tab">
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_property/<?php echo $property_id.'/'.$page;?>/">Rental Property Details</a></li>
			<li class="active "><a class="" href="javascript:void(0);">Rental Prices</a></li>
                        <li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_property_image/<?php echo $property_id.'/'.$page;?>/">Property Images</a></li>
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/contact/<?php echo $property_id.'/'.$page;?>/">Contact</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/ical_import/<?php echo $property_id.'/'. $page;?>/">iCal Import</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/payment/<?php echo $property_id.'/'. $page;?>/">Booking</a></li>
			<li><a class="no-cache-redirect"  href="<?php echo BACKEND_URL;?>rentals/edit_map_location/<?php echo $property_id.'/'. $page;?>/">Map Location</a></li>
                    </ul>
                    <div class="clear"></div>
			    
                    	<div id="property_rentals_fieldset" class="property_tag_class">
			    
			    <form name="frmPropertyRental" id="frm4" enctype="multipart/form-data" method="post" class="parsley_reg" action="<?php echo BACKEND_URL;?>rentals/season_prices/<?php echo $property_id;?>/<?php echo $page;?>">
			    <input type="hidden" name="action" value="Process">
				<br class="spacer" />
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Property Rental Seasons</h4>
					<p>Provide the Property Rental Seasons Information here and the season prices.</p>
				    </div> 
				</div>
				
				<br class="spacer" />
				    <!-- Availibility Calendar -->
				    <div class="rentalPropCurrency" style="text-align: center;">				
					<div id="availCalendar" style="display: inline-block;">
					    
					</div>
				    </div>
				    <br class="spacer" />
				    <!-- Availibility Calendar -->
				    <h4 class="proHeadingText">Seasonal Property Rents <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a> </span></h4>
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
				    <br class="spacer" />
				    <table width="100%" id="tableSeasons">
					<?php
					if(!empty($season_price_list))
					    $seaPriceCount = count($season_price_list);
					else
					    $seaPriceCount = 0;
					//pr($season_price_list, 0); echo $seaPriceCount;
					if($seaPriceCount > 0){
					    for($p=0;$p<$seaPriceCount;$p++) {
						
					?>
					   <!-- <tr><td>&nbsp;</td></tr>-->
					   <!-- <tr id="season_<?php echo $season_price_list[$p]['price_id']; ?>">-->
					   <tr id="season_<?php echo $p; ?>">
					    <td>
						<div class="col-sm-12">
						    <legend>
							<b><?php echo 'Season ' . ($p+1);//$season_price_list[$p]['season_name'];?></b>
							<a href="javascript:void(0);" onclick="removeSeason(<?php echo $season_price_list[$p]['price_id']; ?>);" style=" float: right;">Remove Season</a></legend>
						</div>
						
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="<?php echo $season_price_list[$p]['daily_price'];?>" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="dailyprice_<?php echo $p; ?>">
						</div>
						<div class="col-sm-3 rentWeeklyPricePan">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="<?php echo $season_price_list[$p]['weekly_price'];?>" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_<?php echo $p; ?>">
						  <input value="<?php echo $season_price_list[$p]['weekly_disc'];?>" name="disc_weekly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_<?php echo $p;?>">
						  <div id="weeklyPricePan_<?php echo $p; ?>" class="weeklyAutoPricePan">
						   <div class="pan1"><span><a id="weekly0Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly0Price <?php if($season_price_list[$p]['weekly_disc'] == 0 && $season_price_list[$p]['weekly_disc']!=''){ echo 'active';} ?>">0</a></span></div>
						    <div class="pan2">
							<span><a id="weekly5Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly5Price <?php if($season_price_list[$p]['weekly_disc'] == 5){ echo 'active';} ?>">5</a></span>
							<span><a id="weekly10Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly10Price <?php if($season_price_list[$p]['weekly_disc'] == 10){ echo 'active';} ?>">10</a></span>
							<span><a id="weekly15Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly15Price <?php if($season_price_list[$p]['weekly_disc'] == 15){ echo 'active';} ?>">15</a></span>
							<span><a id="weekly20Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly20Price <?php if($season_price_list[$p]['weekly_disc'] == 20){ echo 'active';} ?>">20</a></span>
							<span><a id="weekly25Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly25Price <?php if($season_price_list[$p]['weekly_disc'] == 25){ echo 'active';} ?>">25</a></span>
							<span><a id="weekly30Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly30Price <?php if($season_price_list[$p]['weekly_disc'] == 30){ echo 'active';} ?>">30</a></span>
							<span><a id="weekly35Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly35Price <?php if($season_price_list[$p]['weekly_disc'] == 35){ echo 'active';} ?>">35</a></span>
							<span><a id="weekly40Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly40Price <?php if($season_price_list[$p]['weekly_disc'] == 40){ echo 'active';} ?>">40</a></span>
							<span><a id="weekly45Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly45Price <?php if($season_price_list[$p]['weekly_disc'] == 45){ echo 'active';} ?>">45</a></span>
							<span><a id="weekly50Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly50Price <?php if($season_price_list[$p]['weekly_disc'] == 50){ echo 'active';} ?>">50</a></span>
						    </div>
						  </div>
						</div>
						<div class="col-sm-3 rentMonthlyPricePan">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="<?php echo $season_price_list[$p]['monthly_price'];?>" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="monthlyprice_<?php echo $p; ?>">
						  <input value="<?php echo $season_price_list[$p]['monthly_disc'];?>" name="disc_monthly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_<?php echo $p;?>">
						  <div id="monthlyPricePan_<?php echo $p; ?>" class="monthlyAutoPricePan">
						    <div class="pan1"><span><a id="monthly0Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly0Price <?php if($season_price_list[$p]['monthly_disc'] == 0 && $season_price_list[$p]['monthly_disc']!=''){ echo 'active';} ?>">0</a></span></div>
						    <div class="pan2">
							<span><a id="monthly5Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly5Price <?php if($season_price_list[$p]['monthly_disc'] == 5){ echo 'active';} ?>">5</a></span>
							<span><a id="monthly10Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly10Price <?php if($season_price_list[$p]['monthly_disc'] == 10){ echo 'active';} ?>">10</a></span>
							<span><a id="monthly15Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly15Price <?php if($season_price_list[$p]['monthly_disc'] == 15){ echo 'active';} ?>">15</a></span>
							<span><a id="monthly20Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly20Price <?php if($season_price_list[$p]['monthly_disc'] == 20){ echo 'active';} ?>">20</a></span>
							<span><a id="monthly25Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly25Price <?php if($season_price_list[$p]['monthly_disc'] == 25){ echo 'active';} ?>">25</a></span>
							<span><a id="monthly30Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly30Price <?php if($season_price_list[$p]['monthly_disc'] == 30){ echo 'active';} ?>">30</a></span>
							<span><a id="monthly35Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly35Price <?php if($season_price_list[$p]['monthly_disc'] == 35){ echo 'active';} ?>">35</a></span>
							<span><a id="monthly40Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly40Price <?php if($season_price_list[$p]['monthly_disc'] == 40){ echo 'active';} ?>">40</a></span>
							<span><a id="monthly45Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly45Price <?php if($season_price_list[$p]['monthly_disc'] == 45){ echo 'active';} ?>">45</a></span>
							<span><a id="monthly50Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly50Price <?php if($season_price_list[$p]['monthly_disc'] == 50){ echo 'active';} ?>">50</a></span>
						    </div>
						  </div>
						</div>
						<!--<br class="spacer" />-->
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="<?php echo $season_price_list[$p]['minimum_rental_days'];?>" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrental_yy<?php echo $p; ?>">
						</div>
			
			<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <?php if($season_price_list[$p]['season_start_date'] != '' && $season_price_list[$p]['season_start_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_start_date'] !='0000-00-00 00:00:00'){ ?>
						    <input readonly value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_start_date']));?>" type="text"  title="date_start_<?php echo $p;?>" onfocus="checkSeasionDate1('<?php echo $p;?>');" data-required="true" item="<?php echo $season_price_list[$p]['price_id']; ?>"  class="season_start_date system_record form-controltwo required rental_start_date date_start_<?php echo $p;?>"" name="season_start_date[]" id="start_date_<?php echo $p; ?>">
						  <?php } else { ?>
						    <input value="" type="text" title="date_start_<?php echo $p;?>" data-required="true" onfocus="checkSeasionDate1('<?php echo $p;?>');" class="season_start_date form-controltwo required rental_start_date date_start_<?php echo $p;?>" name="season_start_date[]" id="start_date_<?php echo $p; ?>" >
						  <?php } ?>
						
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						   <?php if($season_price_list[$p]['season_end_date'] != '' && $season_price_list[$p]['season_end_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
						    <input value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_end_date']));?>" type="text" data-required="true"  title="date_end_<?php echo $p;?>"  class="season_start_date system_record form-controltwo required rental_end_date date_end_<?php echo $p;?>" onfocus="checkSeasionDate1('<?php echo $p;?>');" name="season_end_date[]" item="<?php echo $season_price_list[$p]['price_id']; ?>" id="end_date_<?php echo $p; ?>">
						  <?php } else { ?>
						    <input readonly value="" type="text" data-required="true"  title="date_end_<?php echo $p;?>"  onfocus="checkSeasionDate1('<?php echo $p;?>');"  class="season_start_date form-controltwo required rental_end_date date_end_<?php echo $p;?>" name="season_end_date[]" id="end_date_<?php echo $p; ?>" >
						  <?php } ?>
						
						</div>
			<div class="col-sm-3">
			    <?php //pr($season_price_list); ?>
						   <label for="reg_input_name" class="req"> Is Default Season ?</label>
						   <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $season_price_list[$p]['price_id']; ?>" class="is_default_hidden_class" value="<?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
						  <input <?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $p;?>" onclick="setDefault(<?php echo $season_price_list[$p]['price_id']; ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $season_price_list[$p]['price_id']; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $p; ?>">
						</div>
					    </td>
					   
					</tr>
					<?php } $p = $p-1;
					}else { $p = 1; ?>
					   <!-- <tr><td>&nbsp;</td></tr>-->
					    <tr id="season_0">
					    <td>
						<div class="col-sm-12"><legend><b>Season 1</b> <a href="javascript:void(0);" onclick="removeSeason(0);" style=" float: right;">Remove Season</a></legend></div>
						
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="dailyprice_0">
						</div>
						<div class="col-sm-3 rentWeeklyPricePan">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_0">
						    <input value="" name="disc_weekly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_0">
						  <div id="weeklyPricePan_0" class="weeklyAutoPricePan">
						    <div class="pan1"><span><a id="weekly0Price_0" href="javascript:void(0);" class="weekly0Price">0</a></span></div>
						    <div class="pan2">
							<span><a id="weekly5Price_0" href="javascript:void(0);" class="weekly5Price">5</a></span>
							<span><a id="weekly10Price_0" href="javascript:void(0);" class="weekly10Price">10</a></span>
							<span><a id="weekly15Price_0" href="javascript:void(0);" class="weekly15Price">15</a></span>
							<span><a id="weekly20Price_0" href="javascript:void(0);" class="weekly20Price">20</a></span>
							<span><a id="weekly25Price_0" href="javascript:void(0);" class="weekly25Price">25</a></span>
							<span><a id="weekly30Price_0" href="javascript:void(0);" class="weekly30Price">30</a></span>
							<span><a id="weekly35Price_0" href="javascript:void(0);" class="weekly35Price">35</a></span>
							<span><a id="weekly40Price_0" href="javascript:void(0);" class="weekly40Price">40</a></span>
							<span><a id="weekly45Price_0" href="javascript:void(0);" class="weekly45Price">45</a></span>
							<span><a id="weekly50Price_0" href="javascript:void(0);" class="weekly50Price">50</a></span>
						    </div>
						  </div>
						</div>
						<div class="col-sm-3 rentMonthlyPricePan">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="monthlyprice_0">
						    <input value="" name="disc_monthly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_0">
						    <div id="monthlyPricePan_0" class="monthlyAutoPricePan">
						    <div class="pan1"><span><a id="monthly0Price_0" href="javascript:void(0);" class="monthly0Price">0</a></span></div>
						    <div class="pan2">
							<span><a id="monthly5Price_0" href="javascript:void(0);" class="monthly5Price">5</a></span>
							<span><a id="monthly10Price_0" href="javascript:void(0);" class="monthly10Price">10</a></span>
							<span><a id="monthly15Price_0" href="javascript:void(0);" class="monthly15Price">15</a></span>
							<span><a id="monthly20Price_0" href="javascript:void(0);" class="monthly20Price">20</a></span>
							<span><a id="monthly25Price_0" href="javascript:void(0);" class="monthly25Price">25</a></span>
							<span><a id="monthly30Price_0" href="javascript:void(0);" class="monthly30Price">30</a></span>
							<span><a id="monthly35Price_0" href="javascript:void(0);" class="monthly35Price">35</a></span>
							<span><a id="monthly40Price_0" href="javascript:void(0);" class="monthly40Price">40</a></span>
							<span><a id="monthly45Price_0" href="javascript:void(0);" class="monthly45Price">45</a></span>
							<span><a id="monthly50Price_0" href="javascript:void(0);" class="monthly50Price">50</a></span>
						    </div>
						  </div>
						</div>
						<!--<br class="spacer" />-->
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrental_0">
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <input readonly value="" type="text" data-required="true"  class="season_start_date form-controltwo required rental_start_date date_start_0" name="season_start_date[]"  id="start_date_0"  onfocus="checkSeasionDate1('<?php echo $p;?>');"  title="date_start_0" >
						   
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						  <input readonly value="" type="text" data-required="true" class="season_start_date form-controltwo required rental_end_date date_end_0" name="season_end_date[]" id="end_date_0" title="date_end_0" onfocus="checkSeasionDate1('<?php echo $p;?>');" >
						   
						</div>
			<div class="col-sm-3">
						  <label for="reg_input_name" class="req"> Is Default Season ?</label>
						   <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_0" class="is_default_hidden_class" value="Yes">
						  <input value="Yes" name="isDefault[]" checked onclick="setDefault('0');"  type="radio"   class="form-controltwo required seasonDefault" id="sesdefault_0">
						</div>
					    </td> 
					</tr>
					
					<?php } ?>
				    </table>
				    <input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list);?>" />
				
				
				<div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit"  id="btn_property_sales_fieldset">Save & Continue</button>
				    <input class="btn btn-default frm_step_next" name="save-and-stay" type="submit"  id="btn_property_sales_fieldset" value="Save & Stay" >
				     <a class="btn btn-default frm_step_next no-cache-redirect " href="<?php echo BACKEND_URL;?>rentals/edit_property/<?php echo $property_id.'/'.$page;?>/">< Back</a>
				</div>
			    <!--</div>
				</fieldset>-->

                	    </div>
			  </form>
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
    $(function() {
    $( "#availCalendar" ).datepicker({
	dateFormat: "dd/mm/yy",
	beforeShow: function(){    
	       $(".ui-datepicker").css('font-size', 12)
	}
    });

    /************ start of calendar for edit price page ***********************/

     $(".rental_start_date").datepicker({

	    beforeShow: function (textbox, instance) {
		var title = ($(this).attr('title'));
		var inputbox_id1= title.split('_');
		var id_prefix1 = inputbox_id1[2];
		var id_prefix2 = inputbox_id1[2]-1;
		var dailyPrice = "dailyprice_"+id_prefix2;
		var dailyPrice2 = ($("#"+dailyPrice).val());
		if (!dailyPrice2) {
		    id_prefix2=id_prefix2-1;
		}
		if (id_prefix2 >= 0) {
		var end_date_id1 = "date_end_"+id_prefix2;
		var end_dt2 = ($("."+end_date_id1).val());
		end_dt2 = $.datepicker.parseDate('dd/mm/yy', end_dt2);
		var next_dt2 = end_dt2.setDate(end_dt2.getDate() + 1);
		var month2 = end_dt2.getMonth();
		var day2 = end_dt2.getDate();
		var year2 = end_dt2.getFullYear();month2 = month2 + 1;
		var next_date2	= day2 + '/' + month2 + '/' + year2;
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "minDate",next_date2);
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "maxDate",next_date2);
		}
		else{
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "minDate",0);
		   
		}

			instance.dpDiv.css({
			marginTop: (textbox.offsetHeight - 50 ) + 'px',
			marginLeft: (textbox.offsetWidth - 400) + 'px'
			});

			},
      
            showButtonPanel: true,	  
	    //minDate: 0,
	    numberOfMonths: 2,
	  
	     beforeShowDay: function(date) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;

	    var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
	    var date2 = '';
	   if ($("#"+end_date_id).val()!='') {
	    
	    var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
	   }
	    
	    
	    var d1 = '';
	    if($("#"+start_date_id).val() != ''){
		d1 = $("#"+start_date_id).datepicker('getDate');
	    }
	     var d2 = $("#"+end_date_id).datepicker('getDate');
	  
	      var diff1 = 0;
	     if (d1 && d2) {
		   diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		 
	     }
	    

	     $('<style type="text/css"> .ui-datepicker-close { display: none; } </style>').appendTo("head");
	     $('<style type="text/css"> .ui-datepicker-current { display: block;  } </style>').appendTo("head");
	      setTimeout(function () {
		    var buttonPane = $(date).datepicker("widget").find(".ui-datepicker-buttonpane");
		    var btn = $('<a class="ui-datepicker-clear ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">' + diff1 + '  Nights </a>');
		    btn.unbind("click").bind("click", function () {
			$.datepicker._clearDate(date);
		    });
		    buttonPane.empty();
		    btn.appendTo(buttonPane);
		}, 1);

		if (date1 && date2 && ((date.getTime() == date1.getTime()) || ( date2 && date2 != null && date >= date1 && date <date2)))
		{
		    return [true, 'dp-highlight' ];
		}
		else if(date2 != '' && date1 !='' && ((date.getTime() == date2.getTime()) || (date2 != null && date >= date1 && date == date2)))
		{
		    
		  return [true, 'dp-active' ]; 
		}
		else
		{
		 return [true, ''];
		}
				
		},
			
	    onClose: function (selectedDate) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
            $("#"+end_date_id).datepicker("option", "minDate", selectedDate);
	    
	    
        },
		onSelect: function(dateText, inst) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
		
		var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
		var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
		
                var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

                if (!date1 || date2) {
		$("#"+start_date_id).val(dateText);
		$("#"+end_date_id).val("");
		setTimeout(function(){
		$( "#"+end_date_id ).datepicker('show');
		    $( "#"+end_date_id ).addClass('active-cal'); 
		    $( "#"+start_date_id ).removeClass('active-cal'); 
		
		}, 5);
		   
                } else if( selectedDate < date1 ) {
                   
                    $("#"+start_date_id).val( dateText );
                  
		setTimeout(function(){
		$( "#"+end_date_id ).datepicker('show');
		 $( "#"+end_date_id ).addClass('active-cal'); 
		    $( "#"+start_date_id ).removeClass('active-cal'); 
		
		}, 5);
		
	
                } else {
		   
		    setTimeout(function(){
		    
		    $( "#"+end_date_id ).datepicker('show');
		     $( "#"+end_date_id ).addClass('active-cal'); 
		    $( "#"+start_date_id ).removeClass('active-cal'); 
		
		     
		    }, 5);
		   
		       
				}
				
			}

		});
    

    $(".rental_end_date").datepicker({
			
			 beforeShow: function (textbox, instance) {
			instance.dpDiv.css({
			marginTop: (textbox.offsetHeight - 50 ) + 'px',
			marginLeft: (textbox.offsetWidth - 529) + 'px'
			});
			
			},
			
			minDate: 0,
			showButtonPanel: true,
			numberOfMonths: 2,
			//dateFormat: 'dd/mm/yy',
			beforeShowDay: function(date) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id = "start_date_"+id_prefix;
				var end_date_id = "end_date_"+id_prefix;
				
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
				
				var d1 = $("#"+start_date_id).datepicker('getDate');
				 var d2 = $("#"+end_date_id).datepicker('getDate');
				
				  var diff1 = 0;
				 if (d1 && d2) {
				       diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
				      //diff1 = date_diff(d2, d1);
				 }
				
				$('<style type="text/css"> .ui-datepicker-close { display: none; } </style>').appendTo("head");
$('<style type="text/css"> .ui-datepicker-current { display: block; } </style>').appendTo("head");
setTimeout(function () {
    
            var buttonPane = $(date).datepicker("widget").find(".ui-datepicker-buttonpane");
            var btn = $('<a class="ui-datepicker-clear ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">' + diff1 + '  Nights</a>');
            btn.unbind("click").bind("click", function () {
                $.datepicker._clearDate(date);
            });
            buttonPane.empty();
            btn.appendTo(buttonPane);
        }, 1);



				
			    if (date1 && ((date.getTime() == date1.getTime()) || (date2 && date == date1 )))
			      {
				  return [true, 'dp-active' ];
			      }
			      else if(date2 && ((date.getTime() == date1.getTime()) || (date1 &&  date > date1 && date <= date2)))
			      {
				return [true, 'dp-highlight' ]; 
			      }
			      else
			      {
			      return [true, ''];
			      }
			
			},
			  
			onClose: function (selectedDate) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id 	= "start_date_"+id_prefix;
				var end_date_id 	= "end_date_"+id_prefix;
			   if(!selectedDate)
			   {
				 $("#"+start_date_id).val("");
			   }

			   },

			onSelect: function(dateText, inst) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id 	= "start_date_"+id_prefix;
				var end_date_id 	= "end_date_"+id_prefix;
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
				
                                var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
				$("#"+end_date_id).removeClass("active-cal");
                               //$( "#rental_end_date" ).css("border","none"); 
                                if (!date1 || date2)
                                {
                                    $("#"+end_date_id).val(dateText);
				 
                                    $(this).datepicker();
				   
                                }
				
                                else if( selectedDate < date1 )
                                {
				   
                                    $("#"+end_date_id).val( dateText );
				
                                }
				
                                else
                                {
                                   
                                    $(this).datepicker();
				
                                }
			}
			 
    
    });
	$('body').on('mouseover', '.ui-state-hover', function(e){
	    var d1 = '';
	    var d2 = '';
	    
	    d1 = $('.rental_start_date').datepicker('getDate');
	     //alert(d1);
	    var day = $(this).html();
	    var year = $(this).parent().attr("data-year");
	    var month = $(this).parent().attr("data-month");
	    var minutes=1000*60;
	    var hours=minutes*60;
	    var days=hours*24;
	    var years=days*365;
      
	    var d2 = new Date(year, month, day); //alert(d2);

	    d1_input = $(".rental_start_date").val();
	    if (d1 != '' && d1_input != "")
	    {
		diff1= (Math.floor((d2.getTime()/86400000) - (d1.getTime()/86400000))); // ms per day
		
		if (diff1 != null )
		{
		    $(".ui-datepicker-clear").html( diff1 + " Nights");
		}
	    }
	  
	});
	
	
	$('body').on('mouseover', '.ui-state-disabled','.ui-datepicker-other-month', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover', '.ui-datepicker th', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover','.ui-datepicker-header', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover', '.ui-datepicker-clear', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});

    });
</script>
<script>
// Date overlapping
function checkSeasionDate(inputbox){
    inputbox_id 	= $(inputbox).attr("id");
    inputbox_id 	= inputbox_id.split('_');
    id_prefix 		= inputbox_id[2];
    start_date_id 	= "start_date_"+id_prefix;
    end_date_id 	= "end_date_"+id_prefix;
    start_date 		= $("#" + start_date_id).val();
    end_date 		= $("#" + end_date_id).val();
    property_id 	= "<?php echo $property_id; ?>";
    seasion_date 	= $(inputbox).val();
    price_id 		= $(inputbox).attr("item");
    $.ajax({
	type: 'post',
	url: "<?php echo base_url(); ?>rentals/check_season_date/",
	data: {property_id:property_id,seasion_date:seasion_date,price_id:price_id},
	success:function(data){
	    if(data=="exist"){
		alert("You have select a invalid date. \nThis date is belongs to another season");
		$(inputbox).val('');
	    }else{
		if (start_date != '' && end_date != '') {
		    $.ajax({
			   type: 'post',
			   url: "<?php echo base_url(); ?>rentals/check_season_date/",
			   data: {property_id:property_id,start_date:start_date,end_date:end_date,price_id:price_id},
			   success:function(data){
			        if(data=="exist"){
				    alert("You have select invalid date range ("+start_date+" to "+ end_date +"). \nAnother seasion overlapping within this date range");
				    $(inputbox).val('');
				}
				if (data == "wrong-date-range") {
				    var msg = "You have select invalid date range ("+start_date+" to "+ end_date +"). \nSeasion end date must be later date of Seasion start date";
				    if ($(inputbox).val()==start_date) {
					msg = "You have select invalid date range ("+start_date+" to "+ end_date +"). \nSeasion start date must be before date of Seasion end date";
				    }
				    alert(msg);
				    $(inputbox).val('');
				}
			   }
		    });
		}
	    }
	}	
    });
}

//$(".season_start_date").change(function(){
//    //alert("On change...");
//    //checkSeasionDate();
//});
    
var j	=	<?php echo ($p+1); ?>;
var jj = 0;
//var j	= 0;

//if (j_blank == 2) {
//    j = 1;
//}

function checkSeasionDate1(inputbox){
		var id_prefix1 = inputbox;
		var id_prefix2 = inputbox-1;
		var dailyPrice = "dailyprice_"+id_prefix2;
		var dailyPrice2 = ($("#"+dailyPrice).val());
		if (!dailyPrice2) {
		    id_prefix2=id_prefix2-1;
		}
		if (id_prefix2 >= 0) {
		var start_date_id1 = "date_start_"+id_prefix2;
		var end_date_id1 = "date_end_"+id_prefix2;
		var start_date_id2 = "date_start_"+id_prefix1;
		var end_date_id2 = "date_end_"+id_prefix1;
		var end_dt = ($("."+end_date_id1).val());
		end_dt = $.datepicker.parseDate('dd/mm/yy', end_dt);
		var next_dt = end_dt.setDate(end_dt.getDate() + 1);
		var month = end_dt.getMonth();
		var day = end_dt.getDate();
		var year = end_dt.getFullYear();month = month + 1;
		var next_date	= day + '/' + month + '/' + year;
		if(id_prefix2 >= 0) {	
		   $("."+start_date_id2).val(next_date);
		}
		else
		{
		    $("#"+start_date_id2).datepicker('getDate');
		}
	    }
    }
    
    
function addMoreSeasons(){
   <?php if($seaPriceCount > 0){?>
    var kk = j+1;
 //   alert(kk);
    <?php }else{ ?>
    var kk = j;
    <?php } ?>
  
   //if (jj > 0) {
   // alert("Please click on Save button to add more season");
   // return false;
   //}
   //if ($(".system_record").length==0) {
   // alert("Please save first season to add more season");
   //  return false;
   //}
   
    $( "#tableSeasons" ).append( $( '<tr id="season_'+ j +'"><td><div class="col-sm-12"><legend><b>Season '+ kk +'</b><a href="javascript:void(0);" onclick="removeSeason('+ j +');" style=" float: right;">Remove Season</a></legend></div><div class="col-sm-3"><label for="reg_input_name" class="req">Daily Price</label><input id="dailyprice_'+j+'" name="season_daily[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3 rentWeeklyPricePan"><label for="reg_input_name" class="req">Weekly Price</label><input id="weeklyprice_'+j+'" name="season_weekly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"><input value="" name="disc_weekly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_'+j+'"><div id="weeklyPricePan_'+ j +'" class="weeklyAutoPricePan"><div class="pan1"><span><a id="weekly0Price_'+ j +'" href="javascript:void(0);" class="weekly0Price">0</a></span></div><div class="pan2"><span><a id="weekly5Price_'+ j +'" href="javascript:void(0);" class="weekly5Price">5</a></span><span><a id="weekly10Price_'+j+'" href="javascript:void(0);" class="weekly10Price">10</a></span><span><a id="weekly15Price_'+j+'" href="javascript:void(0);" class="weekly10Price">15</a></span><span><a id="weekly20Price_'+ j +'" href="javascript:void(0);" class="weekly20Price">20</a></span><span><a id="weekly25Price_'+ j +'" href="javascript:void(0);" class="weekly25Price">25</a></span><span><a id="weekly30Price_'+ j +'" href="javascript:void(0);" class="weekly30Price">30</a></span><span><a id="weekly35Price_'+ j +'" href="javascript:void(0);" class="weekly35Price">35</a></span><span><a id="weekly40Price_'+ j +'" href="javascript:void(0);" class="weekly40Price">40</a></span><span><a id="weekly45Price_'+ j +'" href="javascript:void(0);" class="weekly45Price">45</a></span><span><a id="weekly50Price_'+ j +'" href="javascript:void(0);" class="weekly50Price">50</a></span></div></div></div><div class="col-sm-3 rentMonthlyPricePan"><label for="reg_input_name" class="req">Monthly Price</label><input id="monthlyprice_'+j+'" name="season_monthly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"><input value="" name="disc_monthly[]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_'+j+'"><div id="monthlyPricePan_'+ j +'" class="monthlyAutoPricePan"><div class="pan1"><span><a id="monthly0Price_'+ j +'" href="javascript:void(0);" class="monthly0Price">0</a></span></div><div class="pan2"><span><a id="monthly5Price_'+ j +'" href="javascript:void(0);" class="monthly5Price">5</a></span><span><a id="monthly10Price_'+ j +'" href="javascript:void(0);" class="monthly10Price">10</a></span><span><a id="monthly15Price_'+ j +'" href="javascript:void(0);" class="monthly15Price">15</a></span><span><a id="monthly20Price_'+ j +'" href="javascript:void(0);" class="monthly20Price">20</a></span><span><a id="monthly25Price_'+ j +'" href="javascript:void(0);" class="monthly25Price">25</a></span><span><a id="monthly30Price_'+ j +'" href="javascript:void(0);" class="monthly30Price">30</a></span><span><a id="monthly35Price_'+ j +'" href="javascript:void(0);" class="monthly35Price">35</a></span><span><a id="monthly40Price_'+ j +'" href="javascript:void(0);" class="monthly40Price">40</a></span><span><a id="monthly45Price_'+ j +'" href="javascript:void(0);" class="monthly45Price">45</a></span><span><a id="monthly50Price_'+ j +'" href="javascript:void(0);" class="monthly50Price">50</a></span></div></div></div><div class="col-sm-3"><label for="reg_input_name" class="req">Minimum Rental Days</label><input id="minrental_'+j+'" name="minimum_rental_days[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season Start Date</label><input readonly name="season_start_date[]" onfocus="checkSeasionDate1('+j+');" id="start_date_'+j+'" type="text" title="date_start_'+j+'" class="season_start_date form-controltwo required rental_start_date date_start_'+j+'" data-required="true"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season End Date</label><input readonly name="season_end_date[]" onchange="checkSeasionDate(this);" onfocus="checkSeasionDate1('+j+');"  title="date_end_'+j+'"  id="end_date_'+j+'" type="text" class="season_end_date form-controltwo required rental_end_date date_end_'+j+'" data-required="true"></div><div class="col-sm-3"><label for="reg_input_name" class="req"> Is Default Season ?</label>  <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_'+ j +'" class="is_default_hidden_class" value="No"><input  name="isDefault[]" value="'+j+'" type="radio" class="form-controltwo seasonDefault" onclick="setDefault('+j+');" id="sesdefault_'+j+'"></div></td></tr>' ) );
    
/////////////// for ajax calendar ////////////////////
 
  $(".rental_start_date").datepicker({

	    beforeShow: function (textbox, instance) {
		var title = ($(this).attr('title'));
		var inputbox_id1= title.split('_');
		var id_prefix1 = inputbox_id1[2];
		var id_prefix2 = inputbox_id1[2]-1;
		var dailyPrice = "dailyprice_"+id_prefix2;
		var dailyPrice2 = ($("#"+dailyPrice).val());
		if (!dailyPrice2) {
		    id_prefix2=id_prefix2-1;
		}
		if (id_prefix2 >= 0) {
		var end_date_id1 = "date_end_"+id_prefix2;
		var end_dt2 = ($("."+end_date_id1).val());
		end_dt2 = $.datepicker.parseDate('dd/mm/yy', end_dt2);
		var next_dt2 = end_dt2.setDate(end_dt2.getDate() + 1);
		var month2 = end_dt2.getMonth();
		var day2 = end_dt2.getDate();
		var year2 = end_dt2.getFullYear();month2 = month2 + 1;
		var next_date2	= day2 + '/' + month2 + '/' + year2;
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "minDate",next_date2);
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "maxDate",next_date2);
		}
			instance.dpDiv.css({
			marginTop: (textbox.offsetHeight - 50 ) + 'px',
			marginLeft: (textbox.offsetWidth - 400) + 'px'
			});
                           
			},

            showButtonPanel: true,	  
	    numberOfMonths: 2,
	    //minDate: 0,
	    
	    beforeShowDay: function(date) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
		
		
	    var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
	    var date2 = '';
	   if ($("#"+end_date_id).val()!='') {
	    
	    var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
	   }
	    
	    
	    var d1 = '';
	    if($("#"+start_date_id).val() != ''){
		d1 = $("#"+start_date_id).datepicker('getDate');
	    }
	     var d2 = $("#"+end_date_id).datepicker('getDate');
	  
	      var diff1 = 0;
	     if (d1 && d2) {
		   diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		 
	     }
	    

	     $('<style type="text/css"> .ui-datepicker-close { display: none; } </style>').appendTo("head");
	     $('<style type="text/css"> .ui-datepicker-current { display: block;  } </style>').appendTo("head");
	      setTimeout(function () {
		    var buttonPane = $(date).datepicker("widget").find(".ui-datepicker-buttonpane");
		    var btn = $('<a class="ui-datepicker-clear ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">' + diff1 + '  Nights </a>');
		    btn.unbind("click").bind("click", function () {
			$.datepicker._clearDate(date);
		    });
		    buttonPane.empty();
		    btn.appendTo(buttonPane);
		}, 1);

		if (date1 && date2 && ((date.getTime() == date1.getTime()) || ( date2 && date2 != null && date >= date1 && date <date2)))
		{
		    return [true, 'dp-highlight' ];
		}
		else if(date2 != '' && date1 !='' && ((date.getTime() == date2.getTime()) || (date2 != null && date >= date1 && date == date2)))
		{
		    
		  return [true, 'dp-active' ]; 
		}
		else
		{
		 return [true, ''];
		}
				
		},
	    	
	    onClose: function (selectedDate) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
            $("#"+end_date_id).datepicker("option", "minDate", selectedDate);
	    
	    
        },
		onSelect: function(dateText, inst) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
		var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
		var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
		
                var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

                if (!date1 || date2) {
		$("#"+start_date_id).val(dateText);
		$("#"+end_date_id).val("");
		setTimeout(function(){
		$( "#"+end_date_id ).datepicker('show');
		$( "#"+end_date_id ).addClass('active-cal'); 
		$( "#"+start_date_id ).removeClass('active-cal'); 
		
		}, 5);
		   
                } else if( selectedDate < date1 ) {
                   
                    $("#"+start_date_id).val( dateText );
                  
		setTimeout(function(){
		$( "#"+end_date_id ).datepicker('show');
		 $( "#"+end_date_id ).addClass('active-cal'); 
		    $( "#"+start_date_id ).removeClass('active-cal'); 
		
		}, 5);
		
	
                } else {
		   
		    setTimeout(function(){
		    
		    $( "#"+end_date_id ).datepicker('show');
		     $( "#"+end_date_id ).addClass('active-cal'); 
		    $( "#"+start_date_id ).removeClass('active-cal'); 
		
		     
		    }, 5);
		   
		       
				}
				
			}

		});
    $(".rental_end_date").datepicker({
			
			 beforeShow: function (textbox, instance) {
			instance.dpDiv.css({
			marginTop: (textbox.offsetHeight - 50 ) + 'px',
			marginLeft: (textbox.offsetWidth - 529) + 'px'
			});
			
			},
			
			minDate: 0,
			showButtonPanel: true,
			numberOfMonths: 2,
			//dateFormat: 'dd/mm/yy',
			beforeShowDay: function(date) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id 	= "start_date_"+id_prefix;
				var end_date_id 	= "end_date_"+id_prefix;
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
				
				var d1 = $("#"+start_date_id).datepicker('getDate');
				 var d2 = $("#"+end_date_id).datepicker('getDate');
				
				  var diff1 = 0;
				 if (d1 && d2) {
				       diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
				      //diff1 = date_diff(d2, d1);
				 }
				
				$('<style type="text/css"> .ui-datepicker-close { display: none; } </style>').appendTo("head");
$('<style type="text/css"> .ui-datepicker-current { display: block; } </style>').appendTo("head");
setTimeout(function () {
    
            var buttonPane = $(date).datepicker("widget").find(".ui-datepicker-buttonpane");
            var btn = $('<a class="ui-datepicker-clear ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">' + diff1 + '  Nights</a>');
            btn.unbind("click").bind("click", function () {
                $.datepicker._clearDate(date);
            });
            buttonPane.empty();
            btn.appendTo(buttonPane);
        }, 1);



				
			    if (date1 && ((date.getTime() == date1.getTime()) || (date2 && date == date1 )))
			      {
				  return [true, 'dp-active' ];
			      }
			      else if(date2 && ((date.getTime() == date1.getTime()) || (date1 &&  date > date1 && date <= date2)))
			      {
				return [true, 'dp-highlight' ]; 
			      }
			      else
			      {
			      return [true, ''];
			      }
			
			},
			  
			onClose: function (selectedDate) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id 	= "start_date_"+id_prefix;
				var end_date_id 	= "end_date_"+id_prefix;
				
			   if(!selectedDate)
			   {
				 $("#"+start_date_id).val("");
			   }

			   },

			onSelect: function(dateText, inst) {
				var id = ($(this).attr('id'));
				var inputbox_id= id.split('_');
				var id_prefix = inputbox_id[2];
				var start_date_id 	= "start_date_"+id_prefix;
				var end_date_id 	= "end_date_"+id_prefix;
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
				
                                var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
				$("#"+end_date_id).removeClass("active-cal");
                               //$( "#rental_end_date" ).css("border","none"); 
                                if (!date1 || date2)
                                {
                                    $("#"+end_date_id).val(dateText);
				 
                                    $(this).datepicker();
				   
                                }
				
                                else if( selectedDate < date1 )
                                {
				   
                                    $("#"+end_date_id).val( dateText );
				
                                }
				
                                else
                                {
                                   
                                    $(this).datepicker();
				
                                }
			}
			 
    
    });
    $('body').on('mouseover', '.ui-state-hover', function(e){
	    var d1 = '';
	    var d2 = '';
	    
	    d1 = $('.rental_start_date').datepicker('getDate');
	     //alert(d1);
	    var day = $(this).html();
	    var year = $(this).parent().attr("data-year");
	    var month = $(this).parent().attr("data-month");
	    var minutes=1000*60;
	    var hours=minutes*60;
	    var days=hours*24;
	    var years=days*365;
      
	    var d2 = new Date(year, month, day); //alert(d2);

	    d1_input = $(".rental_start_date").val();
	    if (d1 != '' && d1_input != "")
	    {
		diff1= (Math.floor((d2.getTime()/86400000) - (d1.getTime()/86400000))); // ms per day
		
		if (diff1 != null )
		{
		    $(".ui-datepicker-clear").html( diff1 + " Nights");
		}
	    }
	  
	});
	
	
	$('body').on('mouseover', '.ui-state-disabled','.ui-datepicker-other-month', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover', '.ui-datepicker th', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover','.ui-datepicker-header', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});
	$('body').on('mouseover', '.ui-datepicker-clear', function(e){
	    var d1 = $('.rental_start_date').datepicker('getDate');
	    var d2 = $('.rental_end_date').datepicker('getDate');
	    var diff1 = 0;
	    if (d1 && d2) {
		diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	    else
	    {
		var diff1 = 0;
		$(".ui-datepicker-clear").html( diff1 + " Nights");
	    }
	});

     /////////////// for ajax calendar ////////////////////
     $('.parsley_reg').parsley('addItem', '#minrental_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#minrental_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#dailyprice_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
   $('#daily_price_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#weeklyprice_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#weekly_price_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#monthlyprice_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#monthly_price_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#start_date_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#start_date_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#end_date_'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#end_date_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
   
    $("#total_season_count").val(j);
   // alert(j);
    j++;
  //  alert(j);
}

$(".system_record").click(function(){
   //if (j>0) {
   // alert("Please save new season to edit old season date");	
   // $(this).datepicker("hide");
   //}
});
function setTheDefault(){    
   // for(var i = 0; i< j; i++){
	//$("#sesdefault_"+i).val($("#sesname_"+i).val());
   // }
}

$(document).ready(function(){
    $(document).on('click', '.weekly0Price, .weekly5Price, .weekly10Price, .weekly15Price, .weekly20Price, .weekly25Price, .weekly30Price, .weekly35Price, .weekly40Price, .weekly45Price, .weekly50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'weekly'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');
	var weeklyPricePan	= 'weeklyprice_' + panID;
	var weeklydiscPan	= 'weeklydisc_' + panID;
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	if (parseInt(dailyPriceValue) > 0) {
	    var intermediateValue	= 1-(btnValue/100);	
	    var weeklyPriceValue	= (parseFloat(dailyPriceValue) * 7) * parseFloat(intermediateValue);
	    $('#' + weeklyPricePan).val(weeklyPriceValue.toFixed(2));
	    $('#' + weeklydiscPan).val(btnValue);
	    $('#weeklyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	}else{
	    alert("Please Enter Daily Price!");
	    $('#' + dailyPricePan).focus();
	}
});
    
    $(document).on('click', '.monthly0Price, .monthly5Price, .monthly10Price, .monthly15Price, .monthly20Price, .monthly25Price, .monthly30Price, .monthly35Price, .monthly40Price, .monthly45Price, .monthly50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'monthly'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');
	var monthlyPricePan	= 'monthlyprice_' + panID;
	var monthlydiscPan	= 'monthlydisc_' + panID;
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	if (parseInt(dailyPriceValue) > 0) {
	    var intermediateValue	= 1-(btnValue/100);	
	    var monthlyPriceValue	= (parseFloat(dailyPriceValue) * 28) * parseFloat(intermediateValue);
	    $('#' + monthlyPricePan).val(monthlyPriceValue.toFixed(2));
	    $('#' + monthlydiscPan).val(btnValue);
	    $('#monthlyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	}else{
	    alert("Please Enter Daily Price!");
	    $('#' + dailyPricePan).focus();
	}
    });
});

//$(document).ready(function() {
//
//    $(".season_start_date,.season_end_date").datepicker({
//	    changeMonth: true,
//	    changeYear: true,
//	    dateFormat: 'dd/mm/yy'
//    });
//    
//});

$("#btn_property_sales_fieldset").on("click",function(){
    
});

function removeSeason(id){
    if($("#is_default_hidden_"+id).val()=="Yes")
    {
	alert("You can't delete default season");
    }else{
	j--;
	if ($("#start_date_"+id).html() == '') {   
	$('.parsley_reg').parsley('removeItem', '#minrental_'+id); 
	$('.parsley_reg').parsley('removeItem', '#daily_price_'+id);
	$('.parsley_reg').parsley('removeItem', '#weekly_price_'+id);
	$('.parsley_reg').parsley('removeItem', '#monthly_price_'+id);
	$('.parsley_reg').parsley('removeItem', '#start_date_'+id);
	$('.parsley_reg').parsley('removeItem', '#end_date_'+id);
	}
	
	//$('#season_' + id).remove();
	
	$('#tableSeasons tr').each(function(){
	    var elemID	= $(this).attr('id').replace('season_', '');
	    if (parseInt(elemID) > parseInt(id)){
		alert(elemID);
	    }
	});
    }
}
function setDefault(id){
     $(".is_default_hidden_class").val("No");
     $("#is_default_hidden_"+id).val("Yes");
}


//$('#frm4').parsley({  
//    errors: {
//        container: function ( elem ) {
//            alert( $( elem ).parent());
//        }
//    }
//});

</script>
<style>
    .dp-highlight .ui-state-default {
        background: #56A4EB;
          color: #FFF;
        }
        
        .dp-active  .ui-state-default {
        background: #FFAF02;
          color: #FFF;
        }
        
        
		
.ui-widget { font-size: 100% }
  </style>