<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo FRONT_JS_PATH; ?>jquery-ui.css">
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" type="text/css" />

<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js" type="text/javascript"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-1.9.0.min.js"></script>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>parsley.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.customSelect.js"></script>

<style type="text/css">
    .ui-datepicker-calendar  {
	display: none;
    }
</style>

<div id="main_content">                       
    <?php
    if(isset($succmsg) && $succmsg != ""){
	?>
	<div align="center"><div class="nNote nSuccess" style="width: 600px;"><p><?php echo stripslashes($succmsg);?></p></div></div>
	<?php
    }
    ?>
    <?php
    if(validation_errors() != FALSE){
	?>
	<div align="center"><div class="nNote nFailure" style="width: 600px;"><?php echo validation_errors('<p>', '</p>'); ?></div></div>
	<?php
    }
    ?>
    <?php
    if(isset($errmsg) && $errmsg != ""){
	?>
	<div align="center"><div class="nNote nFailure" style="width: 600px;"><?php echo stripslashes($errmsg);?></div></div>
	<?php
    }
    ?>
    <div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
		<div class="panel-heading"><h4 class="panel-title">Edit Property</h4></div>
		<div class="panel-body">
		    <div class="row">
			<div class="col-sm-12">
			    <?= $tabs; ?>
			    <?php $page = $this->uri->segment(4,0); ?>
			    <div class="clear"></div>
			    <div id="property_rentals_fieldset" class="property_tag_class">
				<form name="frmPropertyRental" id="frm4" enctype="multipart/form-data" method="post" class="parsley_reg" action="<?php echo BACKEND_URL;?>longrentals/season_prices/<?php echo $property_id;?>/<?php echo $page;?>">
				    <input type="hidden" name="action" value="Process">
				    <br class="spacer" />
				    <div class="col-sm-12">
					<div class="step_info">
					    <h4>Property Rental Seasons</h4>
					    <p>Provide the Property Rental Seasons Information here and the season prices.</p>
					</div> 
				    </div>
				    <br class="spacer" />				
				    <h4 class="proHeadingText">Seasonal Property Rents
					<span style="float: right;">
					    <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a>
					</span>
				    </h4>
				    <div class="rentalPropCurrency">
					<div class="col-sm-3">
					    <label for="local_information" class="req">Property Currency
						<span class="label label-info  hint--right hint--info" data-hint="The currency in which Property will be valued."><strong>?</strong></span>
					    </label>
					</div>
					<div class="col-sm-3">
					    <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
						<option value="">---Please Select---</option>
						<option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'Selected';} ?>>THB</option>
						<option value="USD" <?php if($property_details['property_currency']=='USD'){echo 'Selected';} ?>>USD</option>
					    </select>
					</div>
					<br class="spacer" />
					<div class="col-sm-3 rentDailyPricePan">
					    <label for="local_information" class="req">Electricity Price</label>
					    <input type="text" name="electricity_price" id="electricity_price" value="<?php echo $longtermrent_data[0]['electricity_price']; ?>" class="form-controltwo" />
					</div>
					<div class="col-sm-3 rentDailyPricePan">
					    <label for="local_information" class="req">Water Price</label>
					    <input type="text" name="water_price" id="water_price" value="<?php echo $longtermrent_data[0]['water_price']; ?>" class="form-controltwo" />
					</div>
					<div class="col-sm-3 rentDailyPricePan">
					    <label for="local_information" class="req">Cleaning Price</label>
					    <input type="text" name="cleaning_price" id="cleaning_price" value="<?php echo $longtermrent_data[0]['cleaning_price']; ?>" class="form-controltwo" />
					</div>
					<div class="col-sm-3 rentDailyPricePan">
					    <label for="local_information" class="req">Security Deposit</label>
					    <input type="text" name="security_deposit" id="security_deposit" value="<?php echo $longtermrent_data[0]['security_deposit']; ?>" class="form-controltwo" />
					</div>
				    </div>
				    <br class="spacer" />
				    <table width="100%" id="tableSeasons">
					<?php
					if(!empty($season_price_list))
					    $seaPriceCount = count($season_price_list);
					else
					    $seaPriceCount = 0;
				    
					//pr($season_price_list,0);
				    
					if($seaPriceCount > 0){
					    for($p=0;$p<$seaPriceCount;$p++) {
						$str= $season_price_list[$p]['season_start_month'];
						$str1= $season_price_list[$p]['season_end_month'];
						$priceID = $season_price_list[$p]['price_id'];
						$propertyID = $season_price_list[$p]['property_id'];
						list($year,$month)= explode("-",$str);
						list($year1,$month1)= explode("-",$str1);
						$MonthArr = array("January" => "01","February" => "02", "March" => "03", "April" => "04", "May" => "05", "June" => "06", "July" => "07", "August" => "08", "September" => "09", "October" => "10", "November" => "11", "December" => "12");
						foreach($MonthArr as $key => $value){
						    if($month == $value){
							$monthS= $key;
						    }
						    if($month1 == $value){
							$monthE= $key;
						    }
						}
						$ResultStartMonth = $monthS." ".$year;
						$ResultEndMonth = $monthE." ".$year1;
						?>
						<tr id="season_<?php echo $p; ?>">
						    <td>
							<div class="col-sm-12">
							    <legend>
								<b id="season1_<?php echo $p; ?>">Season <?php echo ($p+1);?>
								    <?php //echo $season_price_list[$p]['season_name'];?>
								</b>
								<a href="javascript:void(0);" onclick="removeSeason(<?php echo $p; ?>,<?php echo $priceID; ?>,<?php echo $propertyID; ?>);" style=" float: right;">Remove Season</a>
							    </legend>
							</div>
							<div class="col-sm-3 rentDailyPricePan">
							    <label for="reg_input_name" class="req">1 Month Price</label>
							    <input value="<?php echo $season_price_list[$p]['one_month_price'];?>" name="one_month_price[]" type="text" class="form-controltwo required daily-price-fld" data-required="true" data-type="number" id="one_month_price_<?php echo $p; ?>">   
							</div>
							<div class="col-sm-3 rentWeeklyPricePan">
							    <label for="reg_input_name" class="req">3 Month Price</label>
							    <input value="<?php echo $season_price_list[$p]['three_month_price'];?>" name="three_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="three_month_price_<?php echo $p; ?>">
							</div>
							<div class="col-sm-3 rentMonthlyPricePan">
							    <label for="reg_input_name" class="req">6 Month Price</label>
							    <input value="<?php echo $season_price_list[$p]['six_month_price'];?>" name="six_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="six_month_price_<?php echo $p; ?>">
							</div>						
							<div class="col-sm-3">
							    <label for="reg_input_name" class="req">Yearly Price</label>
							    <input value="<?php echo $season_price_list[$p]['yearly_price'];?>" name="yearly_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="yearly_price_<?php echo $p;?>">
							</div>
							<div class="col-sm-3">
							    <label for="reg_input_name" class="req">Minimum Stay</label>
							    <select name="minimum_stay[]" id="minimum_stay_<?php echo $p;?>" data-required="true"  class="form-control required">
								<option value="">---Please Select---</option>
								<option value="1" <?php if($season_price_list[$p]['minimum_stay'] == 1){ echo "Selected";}?>>1 Month</option>
								<option value="3" <?php if($season_price_list[$p]['minimum_stay'] == 3){ echo 'Selected';}?>>3 Month</option>
								<option value="6" <?php if($season_price_list[$p]['minimum_stay'] == 6){ echo 'Selected';}?>>6 Month</option>
								<option value="12" <?php if($season_price_list[$p]['minimum_stay'] == 12){ echo 'Selected';}?>>Year</option>
							    </select>
							</div>
							<div class="col-sm-3">
							    <label for="reg_input_name" class="req">Start Month</label>
							    <input readonly type="text"   data-required="true"  class="date-picker form-controltwo required rental_start_month date_start_0" name="season_start_month[]" value="<?php echo $ResultStartMonth; ?>" id="season_start_month_0"  title="season_start_month_0">
							</div>
							<div class="col-sm-3">
							    <label for="reg_input_name" class="req">End Month</label>
							    <input readonly value="<?php echo $ResultEndMonth; ?>" type="text"   data-required="true" class="date-picker form-controltwo required rental_end_month date_end_0" name="season_end_month[]" id="season_end_month_0"  title="season_end_month_0" >
							</div>
							<div class="col-sm-3">
							    <label for="reg_input_name" class="req"> Is Default Season ?</label>
							    <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $p; ?>" class="is_default_hidden_class" value="<?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
							    <input <?php if($season_price_list[$p]['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $p;?>" onclick="setDefault(<?php echo $p; ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $season_price_list[$p]['price_id']; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $p; ?>">
							</div>
						    </td>
						</tr>
						<?php
					    }
					    $p = $p-1;
					}
					else {
					    $p = 1;
					    
					    ?>
					    <tr id="season_0">
						<td>
						    <div class="col-sm-12">
							<legend>
							    <b id="season1_0">Season 1</b>
							    <a href="javascript:void(0);" onclick="removeSeason(0);" style=" float: right;">Remove Season</a>
							</legend>
						    </div>
						    <div class="col-sm-3 rentDailyPricePan">
							<label for="reg_input_name" class="req">1 Month Price</label>
							<input name="one_month_price[]" type="text" class="form-controltwo  number required daily-price-fld" data-required="true" value="" data-type="number" id="one_month_price_0">
						    </div>
						    <div class="col-sm-3 rentWeeklyPricePan">
							<label for="reg_input_name" class="req">3 Month Price</label>
							<input value="" name="three_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="three_month_price_0">
						    </div>
						    <div class="col-sm-3 rentMonthlyPricePan">
							<label for="reg_input_name" class="req">6 Month Price</label>
							<input value="" name="six_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="six_month_price_0">
						    </div>						
						    <div class="col-sm-3">
							<label for="reg_input_name" class="req">Yearly Price</label>
							<input value="" name="yearly_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="yearly_price_0">
						    </div>
						    <div class="col-sm-3">
							<label for="reg_input_name" class="req">Minimum Stay</label>
							<select name="minimum_stay[]" id="minimum_stay_0" data-required="true"  class="form-control required">
							    <option value="">---Please Select---</option>
							    <option value="1">1 Month</option>
							    <option value="3">3 Month</option>
							    <option value="6">6 Month</option>
							    <option value="12">Year</option>
							</select>
						    </div>
						    <div class="col-sm-3">
							<label for="reg_input_name" class="req">Start Month</label>
							<input readonly value="" type="text"   data-required="true"  class="date-picker form-controltwo required rental_start_month date_start_0" name="season_start_month[]" id="season_start_month_0"  title="season_start_month_0"  >
						    </div>
						    <div class="col-sm-3">
							<label for="reg_input_name" class="req">End Month</label>
							<input readonly value="" type="text"   data-required="true" class="date-picker form-controltwo required rental_end_month date_end_0" name="season_end_month[]" id="season_end_month_0"  title="season_end_month_0" >
						    </div>
						    <div class="col-sm-3">
							<label for="reg_input_name" class="req"> Is Default Season ?</label>
							<input type="hidden" name="is_default_hidden[]" id="is_default_hidden_0" class="is_default_hidden_class" value="Yes">
							<input value="Yes" name="isDefault[]" checked onclick="setDefault('0');"  type="radio"   class="form-controltwo required seasonDefault" id="sesdefault_0">
						</div>

						</td> 
					    </tr>
					    <?php
					}
					?>
				    </table>
				    <input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list);?>" />
				    <input type="hidden" name="isSaveStay" id="isSaveStay" value="No" />
				
				    <div class="save_div_class">
					<button class="btn btn-default frm_step_next"  type="submit"  id="btn_property_sales_fieldset">Save & Continue</button>
					<a class="btn btn-default frm_step_next no-cache-redirect " href="<?php echo BACKEND_URL;?>longrentals/edit_property/<?php echo $property_id.'/'.$page;?>/">< Back</a>
				    </div>
				    <br class="spacer" />
				    <h4 class="proHeadingText">&nbsp;
					<span style="float: right;">
					    <a href="javascript:void(0);" onclick="addMoreSeasons();">Add More Seasons</a>
					</span>
				    </h4>
				    <input type="hidden" name="frm_cnt" id="frm_cnt" value="1" />
				    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
				    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
				</form>
			    </div>
			    <div style="float:right;margin-top:-150px;display:none;" id="div_loader">
			        <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
			    </div>
			</div>
		    </div>	
		</div>
	    </div>
	</div>
    </div>
</div>

<script>
	
    /************ start of calendar for edit price page ***********************/

     $(".rental_start_date").datepicker({

	    beforeShow: function (textbox, instance) {
		var title = ($(this).attr('title'));
		var inputbox_id1= title.split('_');
		var id_prefix1 = inputbox_id1[2];
		var id_prefix2 = inputbox_id1[2]-1;
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
		$( ".date_start_"+id_prefix1 ).datepicker( "option", "minDate",'');  
		}
			instance.dpDiv.css({
			marginTop: (textbox.offsetHeight - 50 ) + 'px',
			marginLeft: (textbox.offsetWidth - 400) + 'px'
			});

			},
      
            showButtonPanel: true,	  
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

	//    d1_input = $(".rental_start_date").val();
	//    if (d1 != '' && d1_input != "")
	//    {
	//	diff1= (Math.floor((d2.getTime()/86400000) - (d1.getTime()/86400000))); // ms per day
	//	
	//	if (diff1 != null )
	//	{
	//	    $(".ui-datepicker-clear").html( diff1 + " Nights");
	//	}
	//    }
	  
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
	//    var d1 = $('.rental_start_date').datepicker('getDate');
	//    var d2 = $('.rental_end_date').datepicker('getDate');
	//    var diff1 = 0;
	//    if (d1 && d2) {
	//	diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
	//	$(".ui-datepicker-clear").html( diff1 + " Nights");
	//    }
	//    else
	//    {
	//	var diff1 = 0;
	//	$(".ui-datepicker-clear").html( diff1 + " Nights");
	//    }
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

</script>
<script>
function checkDate(typ) {

var rowCount = $('#tableSeasons tr').length;
var m;
var start_date1 = new Array();
var end_date1 = new Array();
    for(m=0;m<rowCount;m++)
    {
    start_date_id 	= "start_date_"+m;
    end_date_id 	= "end_date_"+m;
    start_date 		= $("#" + start_date_id).val();
    end_date 		= $("#" + end_date_id).val();
    start_date1.push(start_date);
    end_date1.push(end_date);
    }
    
     $.ajax({
	type: 'post',
	url: "<?php echo base_url(); ?>rentals/check_season_date1/",
	data: {start_date:start_date1,end_date:end_date1},
	success:function(data){
	     if(data=="not-exist"){
		if (parseInt(typ) == 2){
		    $('#isSaveStay').val('Yes');
		}else{
		    $('#isSaveStay').val('No');
		}		
		$( "#frm4" ).submit();
		return true;
	    }
	    else
	    {
		alert(data);
		return false;
	    }
	}
     });
return false;
}
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

<?php if($seaPriceCount > 0){?>  
var j	=	<?php echo $p+1; ?>;
<?php } else { ?>
var j	=	<?php echo $p; ?>;
<?php } ?>

var jj = 0;

    $('.season_start_date').focus(function(){
	var inputbox = ($(this).attr('id').replace('start_date_', ''));
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
    });
        $('.season_end_date').focus(function(){
	var inputbox = ($(this).attr('id').replace('end_date_', ''));
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
    });

function checkSeasionDate1(){

   		var id_prefix1 = inputbox;
		var id_prefix2 = inputbox-1;
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
    <?php
    if($seaPriceCount > 0){
	?>
	var kk = j+1;
	<?php
    }
    else{
	?>
	var kk = j+1;
	<?php
    }
    ?>

    var str = '<tr id="season_'+ j +'"><td><div class="col-sm-12"><legend><b id="season1_'+ j +'">Season '+ kk +'</b><a href="javascript:void(0);" onclick="removeSeason('+ j +');" style=" float: right;">Remove Season</a></legend></div><div class="col-sm-3 rentDailyPricePan"><label for="reg_input_name" class="req">1 Month Price</label><input value="" name="one_month_price[]" type="text" class="form-controltwo  number required daily-price-fld" data-required="true" data-type="number" id="one_month_price_'+ j +'"></div><div class="col-sm-3 rentWeeklyPricePan"><label for="reg_input_name" class="req">3 Month Price</label><input value="" name="three_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="three_month_price_'+ j +'"></div><div class="col-sm-3 rentMonthlyPricePan"><label for="reg_input_name" class="req">6 Month Price</label><input value="" name="six_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="six_month_price_'+ j +'"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Yearly Price</label><input value="" name="yearly_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="yearly_price_'+ j +'"></div><div class="col-sm-3"><label for="reg_input_name" class="req">Minimum Stay</label><select name="minimum_stay[]" id="minimum_stay_' + j +'" data-required="true"  class="form-control required"><option value="">---Please Select---</option><option value="1">1 Month</option><option value="3">3 Month</option><option value="6">6 Month</option><option value="12">Year</option></select></div><div class="col-sm-3"><label for="reg_input_name" class="req">Start Month</label><input readonly value="" type="text"   data-required="true"  class="date-picker form-controltwo required rental_start_month date_start_0" name="season_start_month[]" id="season_start_month_' + j +'"  title="season_start_month_'+ j +'"></div><div class="col-sm-3"><label for="reg_input_name" class="req">End Month</label><input readonly value="" type="text"   data-required="true" class="date-picker form-controltwo required rental_end_month date_end_0" name="season_end_month[]" id="season_end_month_'+ j +'"  title="season_end_month_'+ j +'"></div></td></tr>'; 
     
      
    $('#tableSeasons').append(str);
 

 /////////////// for ajax calendar ////////////////////
 
 
  $(".rental_start_date").datepicker({

	    beforeShow: function (textbox, instance) {
		var title = ($(this).attr('title'));
		var inputbox_id1= title.split('_');
		var id_prefix1 = inputbox_id1[2];
		var id_prefix2 = inputbox_id1[2]-1;
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

	//    d1_input = $(".rental_start_date").val();
	//    if (d1 != '' && d1_input != "")
	//    {
	//	diff1= (Math.floor((d2.getTime()/86400000) - (d1.getTime()/86400000))); // ms per day
	//	
	//	if (diff1 != null )
	//	{
	//	    $(".ui-datepicker-clear").html( diff1 + " Nights");
	//	}
	//    }
	  
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
	//    var d1 = $('.rental_start_date').datepicker('getDate');
	//    var d2 = $('.rental_end_date').datepicker('getDate');
	//    var diff1 = 0;
	//    if (d1 && d2) {
	//	diff1= (Math.floor((d2.getTime() - d1.getTime()) / 86400000)); // ms per day
	//	$(".ui-datepicker-clear").html( diff1 + " Nights");
	//    }
	//    else
	//    {
	//	var diff1 = 0;
	//	$(".ui-datepicker-clear").html( diff1 + " Nights");
	//    }
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
    
//    $(".season_start_date,.season_end_date").datepicker({
//	    changeMonth: true,
//	    changeYear: true,
//	    dateFormat: 'dd/mm/yy'
//	});    
    $("#total_season_count").val(j);
    //alert(j);
    j++;
    //alert(j);
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

$(document).on('click', function(){
    
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
});
$(document).ready(function(){
     
    
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
     
    
      $(document).on('keyup', '.daily-price-fld', function(){
	var elemVal = $(this).val();	
	var elemID = $(this).attr('id').replace('dailyprice_', '');
	var tmpPan = 'dailyPriceTmp_' + elemID;
	$('#' + tmpPan).val(elemVal);
    });
    
        $(document).on('click', '.dailyMPrice, .daily0Price, .daily5Price, .daily10Price, .daily15Price, .daily20Price, .daily25Price, .daily30Price, .daily35Price, .daily40Price, .daily45Price, .daily50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'daily'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');	
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceTmpPan	= 'dailyPriceTmp_' + panID;	
	var dailydiscPan	= 'dailydisc_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	var dailyPriceTmpValue	= $('#' + dailyPriceTmpPan).val();
	
	if (btnValue == 'M') {
	    $('#dailyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	    $('#' + dailyPricePan).val('');
	    $('#' + dailydiscPan).val(btnValue);
	    $('#'+dailyPricePan).attr('readonly', false);
	}else{	    
	    if (parseInt(dailyPriceValue) > 0) {		
		var intermediateValue	= (btnValue/100);	
		var dailyPriceValueNew	= dailyPriceTmpValue*intermediateValue;
		dailyPriceValueNew	= dailyPriceTmpValue-dailyPriceValueNew;
		$('#' + dailyPricePan).val(dailyPriceValueNew.toFixed(2));
		$('#' + dailydiscPan).val(btnValue);
		$('#'+dailyPricePan).attr('readonly', true);
		$('#dailyPricePan_' +panID+' a').removeClass('active');
		$(this).addClass('active');
	    }else{
		alert("Please Enter Daily Price!");
		$('#' + dailyPricePan).focus();
	    }
	}
    });

        $(document).on('click', '.weeklyMPrice, .weekly0Price, .weekly5Price, .weekly10Price, .weekly15Price, .weekly20Price, .weekly25Price, .weekly30Price, .weekly35Price, .weekly40Price, .weekly45Price, .weekly50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'weekly'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');
	var weeklyPricePan	= 'weeklyprice_' + panID;
	var weeklydiscPan	= 'weeklydisc_' + panID;
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	
	if (btnValue == 'M') {
	    $('#weeklyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	    $('#' + weeklyPricePan).val('');
	    $('#' + weeklydiscPan).val(btnValue);
	    $('#'+weeklyPricePan).attr('readonly', false);
	}else{	    
	    if (parseInt(dailyPriceValue) > 0) {
		var intermediateValue	= 1-(btnValue/100);	
		var weeklyPriceValue	= (parseFloat(dailyPriceValue) * 7) * parseFloat(intermediateValue);
		$('#' + weeklyPricePan).val(weeklyPriceValue.toFixed(2));
		$('#' + weeklydiscPan).val(btnValue);
		$('#'+weeklyPricePan).attr('readonly', true);
		$('#weeklyPricePan_' +panID+' a').removeClass('active');
		$(this).addClass('active');
	    }else{
		alert("Please Enter Daily Price!");
		$('#' + dailyPricePan).focus();
	    }
	}
});
    $(document).on('click', '.monthlyMPrice, .monthly0Price, .monthly5Price, .monthly10Price, .monthly15Price, .monthly20Price, .monthly25Price, .monthly30Price, .monthly35Price, .monthly40Price, .monthly45Price, .monthly50Price', function(){	
	var btnValue		= $(this).html();
	var panIDReplacer	= 'monthly'+btnValue+'Price_';
	var panID		= $(this).attr('id').replace(panIDReplacer, '');
	var monthlyPricePan	= 'monthlyprice_' + panID;
	var monthlydiscPan	= 'monthlydisc_' + panID;
	var dailyPricePan	= 'dailyprice_' + panID;
	var dailyPriceValue	= $('#' + dailyPricePan).val();
	
	if (btnValue == 'M') {
	    $('#monthlyPricePan_' +panID+' a').removeClass('active');
	    $(this).addClass('active');
	    $('#' + monthlyPricePan).val('');
	    $('#' + monthlydiscPan).val(btnValue);
	    $('#'+monthlyPricePan).attr('readonly', false);
	}else{
	    if (parseInt(dailyPriceValue) > 0) {
		var intermediateValue	= 1-(btnValue/100);	
		var monthlyPriceValue	= (parseFloat(dailyPriceValue) * 28) * parseFloat(intermediateValue);
		$('#' + monthlyPricePan).val(monthlyPriceValue.toFixed(2));
		$('#' + monthlydiscPan).val(btnValue);
		$('#'+monthlyPricePan).attr('readonly', true);
		$('#monthlyPricePan_' +panID+' a').removeClass('active');
		$(this).addClass('active');
	    }else{
		alert("Please Enter Daily Price!");
		$('#' + dailyPricePan).focus();
	    }
	}
    });

    
});






$("#btn_property_sales_fieldset").on("click",function(){
    
});

function removeSeason(id,priceid,propertyid){
    
    var base_url_suffix	= '';
    var base_url = location.protocol + '//' + location.host + '/' + base_url_suffix;
    
    if($("#is_default_hidden_"+id).val()=="Yes"){
	alert("You can't delete default season");
    }
    else{
	j--;
	if ($("#start_date_"+id).html() == '') {   
	    $('.parsley_reg').parsley('removeItem', '#minrental_'+id); 
	    $('.parsley_reg').parsley('removeItem', '#dailyprice_'+id);
	    $('.parsley_reg').parsley('removeItem', '#weeklyprice_'+id);
	    $('.parsley_reg').parsley('removeItem', '#monthlyprice_'+id);
	    $('.parsley_reg').parsley('removeItem', '#start_date_'+id);
	    $('.parsley_reg').parsley('removeItem', '#end_date_'+id);
	}
	$.ajax({
	    type: "POST",
	    url: base_url + "livephuket/admin/longrentals/delete_season_price",
	    data: { priceid: priceid, propertyid: propertyid },
	    success: function(data){
		if(parseInt(data) == 1){
		    alert("Season Deleted");
		}
		else{
		    alert("Failed to delete Season");
		}
	    }
	});
	$('#season_' + id).remove();
	$('#tableSeasons tr').each(function(){
	    var elemID	= $(this).attr('id').replace('season_', '');
	//    if (parseInt(elemID) > parseInt(id)){
	//	var elemID1=parseInt(elemID-1);
	//	$("#dailyprice_"+elemID).attr('id','dailyprice_'+elemID1);
	//	$("#weeklyprice_"+elemID).attr('id','weeklyprice_'+elemID1);
	//	$("#weeklydisc_"+elemID).attr('id','weeklydisc_'+elemID1);
	//	$("#season_"+elemID).attr('id','season_'+elemID1);
	//	$("#season1_"+elemID).attr('id','season1_'+elemID1);
	//	$("#season1_"+elemID1).text('Season '+elemID);
	//
	//	$("#dailyPriceTmp_"+elemID).attr('id','dailyPriceTmp_'+elemID1);
	//	$("#dailydisc_"+elemID).attr('id','dailydisc_'+elemID1);
	//	$("#dailyPricePan_"+elemID).attr('id','dailyPricePan_'+elemID1);
	//	$("#dailyMPrice_"+elemID).attr('id','dailyMPrice_'+elemID1);
	//	$("#daily0Price_"+elemID).attr('id','daily0Price_'+elemID1);
	//	$("#daily5Price_"+elemID).attr('id','daily5Price_'+elemID1);
	//	$("#daily10Price_"+elemID).attr('id','daily10Price_'+elemID1);
	//	$("#daily15Price_"+elemID).attr('id','daily15Price_'+elemID1);
	//	$("#daily20Price_"+elemID).attr('id','daily20Price_'+elemID1);
	//	$("#daily25Price_"+elemID).attr('id','daily25Price_'+elemID1);
	//	$("#daily30Price_"+elemID).attr('id','daily30Price_'+elemID1);
	//	$("#daily40Price_"+elemID).attr('id','daily40Price_'+elemID1);
	//	$("#daily45Price_"+elemID).attr('id','daily45Price_'+elemID1);
	//	$("#daily50Price_"+elemID).attr('id','daily50Price_'+elemID1);
	//	$("#daily55Price_"+elemID).attr('id','daily55Price_'+elemID1);
	//	
	//	$("#weeklyMPrice_"+elemID).attr('id','weeklyMPrice_'+elemID1);
	//	$("#weeklyPricePan_"+elemID).attr('id','weeklyPricePan_'+elemID1);
	//	$("#weekly0Price_"+elemID).attr('id','weekly0Price_'+elemID1);
	//	$("#weekly5Price_"+elemID).attr('id','weekly5Price_'+elemID1);
	//	$("#weekly10Price_"+elemID).attr('id','weekly10Price_'+elemID1);
	//	$("#weekly15Price_"+elemID).attr('id','weekly15Price_'+elemID1);
	//	$("#weekly20Price_"+elemID).attr('id','weekly20Price_'+elemID1);
	//	$("#weekly25Price_"+elemID).attr('id','weekly25Price_'+elemID1);
	//	$("#weekly30Price_"+elemID).attr('id','weekly30Price_'+elemID1);
	//	$("#weekly35Price_"+elemID).attr('id','weekly35Price_'+elemID1);
	//	$("#weekly40Price_"+elemID).attr('id','weekly40Price_'+elemID1);
	//	$("#weekly45Price_"+elemID).attr('id','weekly45Price_'+elemID1);
	//	$("#weekly50Price_"+elemID).attr('id','weekly50Price_'+elemID1);
	
	//	$("#monthlyprice_"+elemID).attr('id','monthlyprice_'+elemID1);
	//	$("#monthlydisc_"+elemID).attr('id','monthlydisc_'+elemID1);
	//	$("#monthlyPricePan_"+elemID).attr('id','monthlyPricePan_'+elemID1);
	//	$("#monthlyMPrice_"+elemID).attr('id','monthlyMPrice_'+elemID1);
	//	$("#monthly0Price_"+elemID).attr('id','monthly0Price_'+elemID1);
	//	$("#monthly5Price_"+elemID).attr('id','monthly5Price_'+elemID1);
	//	$("#monthly10Price_"+elemID).attr('id','monthly10Price_'+elemID1);
	//	$("#monthly15Price_"+elemID).attr('id','monthly15Price_'+elemID1);
	//	$("#monthly20Price_"+elemID).attr('id','monthly20Price_'+elemID1);
	//	$("#monthly25Price_"+elemID).attr('id','monthly25Price_'+elemID1);
	//	$("#monthly30Price_"+elemID).attr('id','monthly30Price_'+elemID1);
	//	$("#monthly35Price_"+elemID).attr('id','monthly35Price_'+elemID1);
	//	$("#monthly40Price_"+elemID).attr('id','monthly40Price_'+elemID1);
	//	$("#monthly45Price_"+elemID).attr('id','monthly45Price_'+elemID1);
	//	$("#monthly50Price_"+elemID).attr('id','monthly50Price_'+elemID1);
	
	//	$("#minrental_"+elemID).attr('id','minrental_'+elemID1);
	
	//	$("#is_default_hidden_"+elemID).attr('id','is_default_hidden_'+elemID1);
	
	//	$("#start_date_"+elemID).removeClass('date_start_'+elemID);
	//	$("#start_date_"+elemID).addClass('date_start_'+elemID1);
	//	$("#start_date_"+elemID).attr('title','date_start1_'+elemID1);
	//	$("#start_date_"+elemID).val('');
	//	$("#start_date_"+elemID).attr('id','start_date_'+elemID1);
	
	//	$("#end_date_"+elemID).removeClass('date_end_'+elemID);
	//	$("#end_date_"+elemID).addClass('date_end_'+elemID1);
	//	$("#end_date_"+elemID).attr('title','date_end1_'+elemID1);
	//	$("#end_date_"+elemID).val('');
	//	$("#end_date_"+elemID).attr('id','end_date_'+elemID1);
	//	$("#end_date_"+elemID1).removeClass('hasDatepicker');
	
	//	$("#start_date_"+elemID1).removeClass('hasDatepicker');
	//    }
	});
	
	
	
	
	
	
	
	$('.rental_start_date').datepicker({
	
	    beforeShow: function (textbox, instance) {
		var title = ($(this).attr('title'));
		var inputbox_id1= title.split('_');
		var id_prefix1 = inputbox_id1[2];
		var id_prefix2 = inputbox_id1[2]-1;
		if (id_prefix2 >= 0) {
		    var end_date_id1 = "date_end_"+id_prefix2;
		    var end_dt2 = ($("."+end_date_id1).val());
		    end_dt2 = $.datepicker.parseDate('dd/mm/yy', end_dt2);
		    var next_dt2 = end_dt2.setDate(end_dt2.getDate() + 1);
		    var month2 = end_dt2.getMonth();
		    var day2 = end_dt2.getDate();
		    var year2 = end_dt2.getFullYear();month2 = month2 + 1;
		    var next_date2  = day2 + '/' + month2 + '/' + year2;
		    $(".date_start_"+id_prefix1 ).datepicker( "option", "minDate",next_date2);
		    $(".date_start_"+id_prefix1 ).datepicker( "option", "maxDate",next_date2);
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
	
		if (date1 && date2 && ((date.getTime() == date1.getTime()) || ( date2 && date2 != null && date >= date1 && date <date2))){
		    return [true, 'dp-highlight' ];
		}
		else if(date2 != '' && date1 !='' && ((date.getTime() == date2.getTime()) || (date2 != null && date >= date1 && date == date2))){
		    return [true, 'dp-active' ]; 
		}
		else{
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
		}
		else if( selectedDate < date1 ) {
		    $("#"+start_date_id).val( dateText );
		    setTimeout(function(){
			$( "#"+end_date_id ).datepicker('show');
			$( "#"+end_date_id ).addClass('active-cal'); 
			$( "#"+start_date_id ).removeClass('active-cal'); 
		    }, 5);	
		}
		else{
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
	
		if (date1 && ((date.getTime() == date1.getTime()) || (date2 && date == date1 ))){
		    return [true, 'dp-active' ];
		}
		else if(date2 && ((date.getTime() == date1.getTime()) || (date1 &&  date > date1 && date <= date2))){
		    return [true, 'dp-highlight' ]; 
		}
		else{
		    return [true, ''];
		}
	    },
	    onClose: function (selectedDate) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id   = "start_date_"+id_prefix;
		var end_date_id = "end_date_"+id_prefix;
		if(!selectedDate){
		    $("#"+start_date_id).val("");
		}
	    },
	    onSelect: function(dateText, inst) {
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('_');
		var id_prefix = inputbox_id[2];
		var start_date_id = "start_date_"+id_prefix;
		var end_date_id	= "end_date_"+id_prefix;
		var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+start_date_id).val());
		var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#"+end_date_id).val());
		
		var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
		$("#"+end_date_id).removeClass("active-cal");
		//$( "#rental_end_date" ).css("border","none"); 
		if (!date1 || date2){
		    $("#"+end_date_id).val(dateText);
		    $(this).datepicker();
		}
		else if( selectedDate < date1 ){
		    $("#"+end_date_id).val( dateText );
		}
		else{
		    $(this).datepicker();
		}
	    }
	});
    }
}
function setDefault(id){
     $(".is_default_hidden_class").val("No");
     $("#is_default_hidden_"+id).val("Yes");
}

</script>