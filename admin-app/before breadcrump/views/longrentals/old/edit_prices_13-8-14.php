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
				    <h4 class="proHeadingText">Seasonal Property Rents <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a> </span></h4>
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
					    <tr><td>&nbsp;</td></tr>
					    <tr id="season_<?php echo $season_price_list[$p]['price_id']; ?>">
					    <td>
						<div class="col-sm-12">
						    <legend>
							<b><?php echo 'Season ' . ($p+1);//$season_price_list[$p]['season_name'];?></b>
							<a href="javascript:void(0);" onclick="removeSeason(<?php echo $season_price_list[$p]['price_id']; ?>);" style=" float: right;">Remove Season</a></legend>
						</div>
						<!--<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Name</label>
						  <input value="<?php echo $season_price_list[$p]['season_name'];?>" name="season_name[]" type="text" class="form-controltwo required seasonName" data-required="true" id="sesname_<?php echo $p; ?>">
						</div>-->
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="<?php echo $season_price_list[$p]['daily_price'];?>" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="dailyprice_<?php echo $p; ?>">
						</div>
						<div class="col-sm-3 rentWeeklyPricePan">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="<?php echo $season_price_list[$p]['weekly_price'];?>" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_<?php echo $p; ?>">
						  <div id="weeklyPricePan_<?php echo $p; ?>" class="weeklyAutoPricePan">
						    <div class="pan1"><span><a id="weekly0Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly0Price">0</a></span></div>
						    <div class="pan2">
							<span><a id="weekly5Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly5Price">5</a></span>
							<span><a id="weekly10Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly10Price">10</a></span>
							<span><a id="weekly15Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly15Price">15</a></span>
							<span><a id="weekly20Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly20Price">20</a></span>
							<span><a id="weekly25Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly25Price">25</a></span>
							<span><a id="weekly30Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly30Price">30</a></span>
							<span><a id="weekly35Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly35Price">35</a></span>
							<span><a id="weekly40Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly40Price">40</a></span>
							<span><a id="weekly45Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly45Price">45</a></span>
							<span><a id="weekly50Price_<?php echo $p; ?>" href="javascript:void(0);" class="weekly50Price">50</a></span>
						    </div>
						  </div>
						</div>
						<div class="col-sm-3 rentMonthlyPricePan">
						  <label for="reg_input_name" class="req">Monthly Price</label>
						  <input value="<?php echo $season_price_list[$p]['monthly_price'];?>" name="season_monthly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="monthlyprice_<?php echo $p; ?>">
						  <div id="monthlyPricePan_<?php echo $p; ?>" class="monthlyAutoPricePan">
						    <div class="pan1"><span><a id="monthly0Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly0Price">0</a></span></div>
						    <div class="pan2">
							<span><a id="monthly5Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly5Price">5</a></span>
							<span><a id="monthly10Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly10Price">10</a></span>
							<span><a id="monthly15Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly15Price">15</a></span>
							<span><a id="monthly20Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly20Price">20</a></span>
							<span><a id="monthly25Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly25Price">25</a></span>
							<span><a id="monthly30Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly30Price">30</a></span>
							<span><a id="monthly35Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly35Price">35</a></span>
							<span><a id="monthly40Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly40Price">40</a></span>
							<span><a id="monthly45Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly45Price">45</a></span>
							<span><a id="monthly50Price_<?php echo $p; ?>" href="javascript:void(0);" class="monthly50Price">50</a></span>
						    </div>
						  </div>
						</div>
						<!--<br class="spacer" />-->
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Minimum Rental Days</label>
						  <input value="<?php echo $season_price_list[$p]['minimum_rental_days'];?>" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrentaldays_<?php echo $p; ?>">
						</div>
			
			<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <?php if($season_price_list[$p]['season_start_date'] != '' && $season_price_list[$p]['season_start_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_start_date'] !='0000-00-00 00:00:00'){ ?>
						    <input readonly value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_start_date']));?>" type="text"  data-required="true" item="<?php echo $season_price_list[$p]['price_id']; ?>"  class="season_start_date system_record form-controltwo required" name="season_start_date[]" id="start_date_id<?php echo $p; ?>">
						  <?php } else { ?>
						    <input value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_start_date[]" id="start_date_id<?php echo $p; ?>" >
						  <?php } ?>
						    <script type="text/javascript">
							$(function() {
							    $( "#start_date_id<?php echo $p; ?>" ).datepicker({
								minDate: 0,
								dateFormat: "dd/mm/yy",
								changeMonth: true,
								numberOfMonths: 2,
								changeYear: true,
								onClose: function( selectedDate, inst ) {
								    var minDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);								    
								    minDate.setDate(minDate.getDate() + 1);
								    //$( "#end_date_id<?php echo $p; ?>" ).val('');
								    $( "#end_date_id<?php echo $p; ?>" ).datepicker( "option", "minDate", minDate);								    
								}
							    });
							});
						    </script>
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						   <?php if($season_price_list[$p]['season_end_date'] != '' && $season_price_list[$p]['season_end_date'] != '1970-01-01 00:00:00' && $season_price_list[$p]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
						    <input value="<?php echo date("d/m/Y", strtotime($season_price_list[$p]['season_end_date']));?>" type="text" data-required="true"  class="season_start_date system_record form-controltwo required" name="season_end_date[]" item="<?php echo $season_price_list[$p]['price_id']; ?>" id="end_date_id<?php echo $p; ?>">
						  <?php } else { ?>
						    <input readonly value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_end_date[]" id="end_date_id<?php echo $p; ?>" >
						  <?php } ?>
						  <script type="text/javascript">
							$(function() {
							    $( "#end_date_id<?php echo $p; ?>" ).datepicker({
								minDate: "+1D",
								dateFormat: "dd/mm/yy",
								changeMonth: true,
								numberOfMonths: 2,
								changeYear: true,
								onClose: function( selectedDate, inst ) {
								    var maxDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);
								    maxDate.setDate(maxDate.getDate() - 1);            
								    $( "#start_date_id<?php echo $p; ?>" ).datepicker( "option", "maxDate", maxDate);
								    var nextDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);
								    
								    nextDate.setDate(nextDate.getDate() + 1);
								    
								    var nextEndDate = new Date(nextDate);
								    
								    nextEndDate.setDate(nextDate.getDate() + 1);
								    
								    //$( "#start_date_id<?php echo ($p+1); ?>" ).val('');
								    //$( "#end_date_id<?php echo ($p+1); ?>" ).val('');
								    $( "#start_date_id<?php echo ($p+1); ?>" ).datepicker( "option", "defaultDate", '');
								    $( "#start_date_id<?php echo ($p+1); ?>" ).datepicker( "option", "minDate", nextDate);
								    $( "#end_date_id<?php echo ($p+1); ?>" ).datepicker( "option", "minDate", nextEndDate);
								}
							    });
							});
						    </script>
						</div>
			<div class="col-sm-3">
			    <?php //pr($season_price_list); ?>
						   <label for="reg_input_name" class="req"> Is Default Season ?</label>
						   <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $season_price_list[$p]['price_id']; ?>" class="is_default_hidden_class" value="<?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
						  <input <?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $p;?>" onclick="setDefault(<?php echo $season_price_list[$p]['price_id']; ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $season_price_list[$p]['price_id']; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $p; ?>">
						</div>
					    </td>
					   
					</tr>
					<?php }
					}else { $p = 1; ?>
					    <tr><td>&nbsp;</td></tr>
					    <tr id="season_0">
					    <td>
						<div class="col-sm-12"><legend><b>Season 1</b> <a href="javascript:void(0);" onclick="removeSeason(0);" style=" float: right;">Remove Season</a></legend></div>
						<!--<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Name</label>
						  <input value="" name="season_name[]" type="text" class="form-controltwo required seasonName" data-required="true"  id="sesname_0">
						</div>-->
						<div class="col-sm-3">
						  <label for="reg_input_name" class="req">Daily Price</label>
						  <input value="" name="season_daily[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="dailyprice_0">
						</div>
						<div class="col-sm-3 rentWeeklyPricePan">
						  <label for="reg_input_name" class="req">Weekly Price</label>
						  <input value="" name="season_weekly[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="weeklyprice_0">
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
						  <input value="" name="minimum_rental_days[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="minrentaldays_0">
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season Start Date</label>
						  <input readonly value="" type="text" data-required="true"  class="season_start_date form-controltwo required" name="season_start_date[]" id="start_date_id0">
						    <script type="text/javascript">
							$(function() {
							    $( "#start_date_id0" ).datepicker({
								dateFormat: "dd/mm/yy",
								changeMonth: true,
								numberOfMonths: 2,
								changeYear: true,
								onClose: function( selectedDate, inst ) {
								    var minDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);								    
								    minDate.setDate(minDate.getDate() + 1);
								    $( "#end_date_id0" ).datepicker( "setDate", minDate);
								    $( "#end_date_id0" ).datepicker( "option", "minDate", minDate);								    
								}
							    });
							});
						    </script>
						</div>
                        <div class="col-sm-3">
						  <label for="reg_input_name" class="req">Season End Date</label>
						  <input readonly value="" type="text" data-required="true" class="season_start_date form-controltwo required" name="season_end_date[]" id="end_date_id0">
						    <script type="text/javascript">
							$(function() {
							    $( "#end_date_id0" ).datepicker({
								minDate: "+1D",
								dateFormat: "dd/mm/yy",
								changeMonth: true,
								numberOfMonths: 2,
								changeYear: true,
								onClose: function( selectedDate, inst ) {
								    var maxDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);
								    maxDate.setDate(maxDate.getDate() - 1);            
								    $( "#start_date_id<?php echo $p; ?>" ).datepicker( "option", "maxDate", maxDate);
								    var nextDate = $.datepicker.parseDate('dd/mm/yy', selectedDate);
								    
								    nextDate.setDate(nextDate.getDate() + 1);
								    
								    var nextEndDate = new Date(nextDate);
								    
								    nextEndDate.setDate(nextDate.getDate() + 1);
								   
								    if ($( "#start_date_id1" ).length) {
									$( "#start_date_id1" ).datepicker( "option", "defaultDate", '');
									$( "#start_date_id1" ).datepicker( "option", "minDate", nextDate);
								    }
								    if ($( "#end_date_id1" ).length) {
									$( "#end_date_id1" ).datepicker( "option", "minDate", nextEndDate);
								    }
								}
							    });
							});
						    </script>
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

$(".season_start_date").change(function(){
    //alert("On change...");
    //checkSeasionDate();
});
    
var j	=	<?php echo ($p); ?>;
var jj = 0;
//var j	= 0;

//if (j_blank == 2) {
//    j = 1;
//}


function addMoreSeasons(){
    
   //if (jj > 0) {
   // alert("Please click on Save button to add more season");
   // return false;
   //}
   //if ($(".system_record").length==0) {
   // alert("Please save first season to add more season");
   //  return false;
   //}
   
    $( "#tableSeasons" ).append( $( '<tr><td>&nbsp;</td></tr><tr id="season_'+ j +'"><td><div class="col-sm-12"><legend><b>Season '+ j +'</b><a href="javascript:void(0);" onclick="removeSeason('+ j +');" style=" float: right;">Remove Season</a></legend></div><br class="spacer" /><div class="col-sm-3"><label for="reg_input_name" class="req">Daily Price</label><input id="dailyprice_'+j+'" name="season_daily[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3 rentWeeklyPricePan"><label for="reg_input_name" class="req">Weekly Price</label><input id="weeklyprice_'+j+'" name="season_weekly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"><div id="weeklyPricePan_'+ j +'" class="weeklyAutoPricePan"><div class="pan1"><span><a id="weekly0Price_'+ j +'" href="javascript:void(0);" class="weekly0Price">0</a></span></div><div class="pan2"><span><a id="weekly5Price_'+ j +'" href="javascript:void(0);" class="weekly5Price">5</a></span><span><a id="weekly10Price_'+j+'" href="javascript:void(0);" class="weekly10Price">10</a></span><span><a id="weekly15Price_'+j+'" href="javascript:void(0);" class="weekly10Price">15</a></span><span><a id="weekly20Price_'+ j +'" href="javascript:void(0);" class="weekly20Price">20</a></span><span><a id="weekly25Price_'+ j +'" href="javascript:void(0);" class="weekly25Price">25</a></span><span><a id="weekly30Price_'+ j +'" href="javascript:void(0);" class="weekly30Price">30</a></span><span><a id="weekly35Price_'+ j +'" href="javascript:void(0);" class="weekly35Price">35</a></span><span><a id="weekly40Price_'+ j +'" href="javascript:void(0);" class="weekly40Price">40</a></span><span><a id="weekly45Price_'+ j +'" href="javascript:void(0);" class="weekly45Price">45</a></span><span><a id="weekly50Price_'+ j +'" href="javascript:void(0);" class="weekly50Price">50</a></span></div></div></div><div class="col-sm-3 rentMonthlyPricePan"><label for="reg_input_name" class="req">Monthly Price</label><input id="monthlyprice_'+j+'" name="season_monthly[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"><div id="monthlyPricePan_'+ j +'" class="monthlyAutoPricePan"><div class="pan1"><span><a id="monthly0Price_'+ j +'" href="javascript:void(0);" class="monthly0Price">0</a></span></div><div class="pan2"><span><a id="monthly5Price_'+ j +'" href="javascript:void(0);" class="monthly5Price">5</a></span><span><a id="monthly10Price_'+ j +'" href="javascript:void(0);" class="monthly10Price">10</a></span><span><a id="monthly15Price_'+ j +'" href="javascript:void(0);" class="monthly15Price">15</a></span><span><a id="monthly20Price_'+ j +'" href="javascript:void(0);" class="monthly20Price">20</a></span><span><a id="monthly25Price_'+ j +'" href="javascript:void(0);" class="monthly25Price">25</a></span><span><a id="monthly30Price_'+ j +'" href="javascript:void(0);" class="monthly30Price">30</a></span><span><a id="monthly35Price_'+ j +'" href="javascript:void(0);" class="monthly35Price">35</a></span><span><a id="monthly40Price_'+ j +'" href="javascript:void(0);" class="monthly40Price">40</a></span><span><a id="monthly45Price_'+ j +'" href="javascript:void(0);" class="monthly45Price">45</a></span><span><a id="monthly50Price_'+ j +'" href="javascript:void(0);" class="monthly50Price">50</a></span></div></div></div><div class="col-sm-3"><label for="reg_input_name" class="req">Minimum Rental Days</label><input id="minrental_'+j+'" name="minimum_rental_days[]" type="text" class="form-controltwo required number" data-required="true" data-type="number"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season Start Date</label><input readonly name="season_start_date[]" id="start_date_id'+j+'" type="text" class="season_start_date form-controltwo required" data-required="true"><script type="text/javascript">$(function() {if($("#end_date_id'+(j-1)+'").length){var prevEndDate = $("#end_date_id'+(j-1)+'").val();if(prevEndDate != ""){prevEndDate = $.datepicker.parseDate(\'dd/mm/yy\', prevEndDate);prevEndDate.setDate(prevEndDate.getDate() + 1);var month = prevEndDate.getMonth();var day = prevEndDate.getDate();var year = prevEndDate.getFullYear();month = month + 1;if(day<10){day="0"+day} if(month<10){month="0"+month} $("#start_date_id'+j+'").val(day+\'/\'+month+\'/\'+year);}}$( "#start_date_id'+j+'" ).datepicker({setDate:prevEndDate, minDate:prevEndDate,dateFormat: "dd/mm/yy",changeMonth: true,numberOfMonths: 2,changeYear: true,onClose: function( selectedDate, inst ) {if(selectedDate != ""){var minDate = $.datepicker.parseDate(\'dd/mm/yy\', selectedDate);minDate.setDate(minDate.getDate() + 1);$( "#end_date_id' + j +'").datepicker( "option", "minDate", minDate);}}});});<\/script></div><div class="col-sm-3"><label for="reg_input_name" class="req">Season End Date</label><input readonly name="season_end_date[]" id="end_date_id'+j+'" type="text" class="season_end_date form-controltwo required" data-required="true"><script type="text/javascript">$(function() {$( "#end_date_id' + j +'").datepicker({minDate: "+1D",dateFormat: "dd/mm/yy",changeMonth: true,numberOfMonths: 2,changeYear: true,onClose: function( selectedDate, inst ) {var maxDate = $.datepicker.parseDate(\'dd/mm/yy\', selectedDate);maxDate.setDate(maxDate.getDate() - 1);$( "#start_date_id'+j+'" ).datepicker( "option", "maxDate", maxDate);var nextDate = $.datepicker.parseDate(\'dd/mm/yy\', selectedDate);nextDate.setDate(nextDate.getDate() + 1);var nextEndDate = new Date(nextDate);nextEndDate.setDate(nextDate.getDate() + 1);$( "#start_date_id'+(j+1)+'" ).datepicker( "option", "defaultDate", "");$( "#start_date_id' + (j+1) +'" ).datepicker( "option", "minDate", nextDate);$( "#end_date_id' + (j+1)+'" ).datepicker( "option", "minDate", nextEndDate);}});});<\/script></div><div class="col-sm-3"><label for="reg_input_name" class="req"> Is Default Season ?</label>  <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_'+ j +'" class="is_default_hidden_class" value="No"><input  name="isDefault[]" value="'+j+'" type="radio" class="form-controltwo seasonDefault" onclick="setDefault('+j+');" id="sesdefault_'+j+'"></div></td></tr>' ) );
    

    
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
    
    $('.parsley_reg').parsley('addItem', '#start_date_id'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#start_date_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    $('.parsley_reg').parsley('addItem', '#end_date_id'+j); //minrental_ //daily_price_ //weekly_price //monthly_price_ _
    $('#end_date_'+j).parsley('addConstraint', {
	required: true 
	
    });
    
    /*$(".season_start_date,.season_end_date").datepicker({
	    changeMonth: true,
	    changeYear: true,
	    dateFormat: 'dd/mm/yy',
	    numberOfMonths: 2
	});*/   
    $("#total_season_count").val(j);
    j++;
    jj++;
}

//$(".system_record").click(function(){
//   if (j>0) {
//    alert("Please save new season to edit old season date");	
//    $(this).datepicker("hide");
//   }
//});

function setTheDefault(){    
   // for(var i = 0; i< j; i++){
	//$("#sesdefault_"+i).val($("#sesname_"+i).val());
   // }
}

$(document).ready(function() {

    /*$(".season_start_date,.season_end_date").datepicker({
	    /*changeMonth: true,
	    changeYear: true,*/
	    /*dateFormat: 'dd/mm/yy',
	    numberOfMonths: 2
    });*/
    
    $(document).on('click', '.weekly0Price, .weekly5Price, .weekly10Price, .weekly15Price, .weekly20Price, .weekly25Price, .weekly30Price, .weekly35Price, .weekly40Price, .weekly45Price, .weekly50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'weekly'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');
	var weeklyPricePan	= 'weeklyprice_' + panID;
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	if (parseInt(dailyPriceValue) > 0) {
	    var intermediateValue	= 1-(btnValue/100);	
	    var weeklyPriceValue	= (parseFloat(dailyPriceValue) * 7) * parseFloat(intermediateValue);
	    $('#' + weeklyPricePan).val(weeklyPriceValue.toFixed(2));
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
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	if (parseInt(dailyPriceValue) > 0) {
	    var intermediateValue	= 1-(btnValue/100);	
	    var monthlyPriceValue	= (parseFloat(dailyPriceValue) * 28) * parseFloat(intermediateValue);
	    $('#' + monthlyPricePan).val(monthlyPriceValue.toFixed(2));
	    $('#monthlyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	}else{
	    alert("Please Enter Daily Price!");
	    $('#' + dailyPricePan).focus();
	}
    });
    
});

$("#btn_property_sales_fieldset").on("click",function(){
    
});

function removeSeason(id){    
    if($("#is_default_hidden_"+id).val()=="Yes"){
	alert("You can't delete default season");
    }else{
	var prevID		= id-1;
	var nextID		= id+1;
	var prevEndDate		= $('#end_date_id' + prevID).val();	
	prevEndDate = $.datepicker.parseDate('dd/mm/yy', prevEndDate);
	//var nextEndDate		= prevEndDate.setDate(prevEndDate.getDate() + 2);
	prevEndDate.setDate(prevEndDate.getDate() + 1);
	var month = prevEndDate.getMonth();
	var day = prevEndDate.getDate();
	var year = prevEndDate.getFullYear();month = month + 1;
	var nextStartDate	= day + '/' + month + '/' + year;
	$('#start_date_id' + nextID).val(nextStartDate);
	
	/*var month2 = nextEndDate.getMonth();
	var day2 = nextEndDate.getDate();
	var year2 = nextEndDate.getFullYear();month = month + 1;
	var nextEndDate	= day2 + '/' + month2 + '/' + year2;
	$('#end_date_id' + nextID).val(nextEndDate);*/
	//return false;
	j--;
	jj--;
	if ($("#start_date_"+id).html() == '') {   
	    $('.parsley_reg').parsley('removeItem', '#minrental_'+id); 
	    $('.parsley_reg').parsley('removeItem', '#daily_price_'+id);
	    $('.parsley_reg').parsley('removeItem', '#weekly_price_'+id);
	    $('.parsley_reg').parsley('removeItem', '#monthly_price_'+id);
	    $('.parsley_reg').parsley('removeItem', '#start_date_'+id);
	    $('.parsley_reg').parsley('removeItem', '#end_date_'+id);
	}
    $('#season_' + id).remove();
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