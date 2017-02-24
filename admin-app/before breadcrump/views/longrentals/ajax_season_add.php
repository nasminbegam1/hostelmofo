<?php
$yr=$year-1;
echo $tab_year = $year;
if(is_array($season_price_list) && count($season_price_list) > 0){
    $countSeason= 1;
    $j= $season_record_count+1;
    foreach($season_price_list AS $key=>$value){
	if($key==$yr){
	    ?>						
	    <div id="season_pan_<?php echo stripslashes($year);?>" class="property_tab_container <?php if($countSeason == 1){echo 'active';}?>">
		<h4 class="proHeadingText">&nbsp;
		    <span style="float: right;">
			<a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $year;?>);">
			    Add More Seasons
			</a>
		    </span>
		</h4>
		<div class="rentalPropCurrency">
		    <div class="col-sm-3">
			<label for="local_information" class="req">Property Currency
			    <span class="label label-info  hint--right hint--info" data-hint="The currency in which Property will be valued.">
				<strong>?</strong>
			    </span>
			</label>
		    </div>
		    <div class="col-sm-3">
			<select name="property_currency" id="property_currency" data-required="true" class="form-control required">
			    <option value="">---Please Select---</option>
			    <option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'selected';} ?>>THB</option>
			    <option value="USD" <?php if($property_details['property_currency']=='USD'){echo 'selected';} ?>>USD</option>
			</select>
		    </div>
		    <br class="spacer">
		    <div class="col-sm-3">
			<label for="local_information" class="req">Electricity Price</label>
			<input type="text" name="electricity_price" id="electricity_price" value="<?php echo $longtermrent_data[0]['electricity_price']; ?>" class="form-controltwo" />
		    </div>
		    <div class="col-sm-3">
			<label for="local_information" class="req">Water Price</label>
			<input type="text" name="water_price" id="water_price" value="<?php echo $longtermrent_data[0]['water_price']; ?>" class="form-controltwo" />
		    </div>
		    <div class="col-sm-3">
			<label for="local_information" class="req">Cleaning Price</label>
			<input type="text" name="cleaning_price" id="cleaning_price" value="<?php echo $longtermrent_data[0]['cleaning_price']; ?>" class="form-controltwo" />
		    </div>
		     <div class="col-sm-3">
			<label for="local_information" class="req">Security Deposit</label>
			<input type="text" name="security_deposit" id="security_deposit" value="<?php echo $longtermrent_data[0]['security_deposit']; ?>" class="form-controltwo" />
		    </div>
		</div>
		<br class="spacer">
		
		<table width="100%" id="tableSeasons_<?php echo $year;?>" class="tableSeasons">
		    <?php
		    if(is_array($value) && count($value) > 0){
			for($i=0; $i<count($value); $i++){
			    $str= $value[$i]['season_start_month'];
			    $str1= $value[$i]['season_end_month'];
			    $priceID= $value[$i]['price_id'];
			    $propertyID= $value[$i]['property_id'];
			    $OneMonthPrice= $value[$i]['one_month_price'];
			    $ThreeMonthPrice= $value[$i]['three_month_price'];
			    $SixMonthPrice= $value[$i]['six_month_price'];
			    $YearlyPrice= $value[$i]['yearly_price'];
			    $MinimumStay= $value[$i]['minimum_stay'];
			    $IsDefault= $value[$i]['isDefault'];
			    
			    list($year,$month)= explode("-",$str);
			    list($year1,$month1)= explode("-",$str1);
			    $MonthArr = array("January" => "01","February" => "02", "March" => "03", "April" => "04", "May" => "05", "June" => "06", "July" => "07", "August" => "08", "September" => "09", "October" => "10", "November" => "11", "December" => "12");
			    foreach($MonthArr as $k => $v){
				if($month == $v){
				    $monthS= $k;
				}
				if($month1 == $v){
				    $monthE= $k;
				}
			    }
			    $ResultStartMonth = $monthS." ".$year;
			    $ResultEndMonth = $monthE." ".$year1;
			    ?>
			    <tr id="season_<?php echo $j;?>">
				<td>
				    <div class="col-sm-12">
					<legend>
					    <b>Season <?php echo ($i+1);?></b>
					    <a class="removeSeason" id="removeSeason_<?php echo ($j);?>_<?php echo $year;?>" href="javascript:void(0);" style="float: right;">
						Remove Season
					    </a>
					</legend>
				    </div>
				    <!-- 1 Month Price -->
				    <div class="col-sm-3 rentDailyPricePan">
					<label for="reg_input_name" class="req">1 Month Price</label>
					<input value="<?php echo $OneMonthPrice;?>" name="one_month_price[]" type="text" class="form-controltwo required daily-price-fld" data-required="true" data-type="number" id="one_month_price_<?php echo $j; ?>">   
				    </div>
				    <!-- 1 Month Price -->
				    <!-- 3 Month Price -->
				    <div class="col-sm-3 rentWeeklyPricePan">
					<label for="reg_input_name" class="req">3 Month Price</label>
					<input value="<?php echo $ThreeMonthPrice;?>" name="three_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="three_month_price_<?php echo $j; ?>">
				    </div>
				    <!-- 3 Month Price -->									     <!-- 6 Month Price -->
				    <div class="col-sm-3 rentMonthlyPricePan">
					<label for="reg_input_name" class="req">6 Month Price</label>
					<input value="<?php echo $SixMonthPrice;?>" name="six_month_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="six_month_price_<?php echo $j; ?>">
				    </div>						
				    <!-- 6 Month Price -->
				    <!-- Yearly Price -->
				    <div class="col-sm-3">
					<label for="reg_input_name" class="req">Yearly Price</label>
					<input value="<?php echo $YearlyPrice;?>" name="yearly_price[]" type="text" class="form-controltwo required" data-required="true" data-type="number" id="yearly_price_<?php echo $j;?>">
				    </div>
				    <!-- Yearly Price -->
				    <!-- Minimum Stay -->
				    <div class="col-sm-3">
					<label for="reg_input_name" class="req">Minimum Stay</label>
					<select name="minimum_stay[]" id="minimum_stay_<?php echo $j;?>" data-required="true"  class="form-control required">
					    <option value="">---Please Select---</option>
					    <option value="1" <?php if($MinimumStay == 1){ echo "Selected";}?>>1 Month</option>
					    <option value="3" <?php if($MinimumStay == 3){ echo 'Selected';}?>>3 Month</option>
					    <option value="6" <?php if($MinimumStay == 6){ echo 'Selected';}?>>6 Month</option>
					    <option value="12" <?php if($MinimumStay == 12){ echo 'Selected';}?>>Year</option>
					</select>
				    </div>
				    <!-- Minimum Stay -->
				    <!-- Start Month -->
				    <div class="col-sm-3">
					<label for="reg_input_name" class="req">Start Month</label>
					<input readonly type="text"   data-required="true"  class="date-picker_<?php echo $tab_year; ?> form-controltwo required rental_start_month date_start_0" name="season_start_month[]" value="<?php echo $ResultStartMonth; ?>" id="season_start_month_<?php echo $j; ?>"  title="season_start_month_0">
				    </div>
				    <!-- Start Month -->
				    <!-- End Month -->
				    <div class="col-sm-3">
					<label for="reg_input_name" class="req">End Month</label>
					<input readonly value="<?php echo $ResultEndMonth; ?>" type="text"   data-required="true" class="date-picker_<?php echo $tab_year; ?> form-controltwo required rental_end_month date_end_0" hidden="<?php echo $str1; ?>" name="season_end_month[]" id="season_end_month_<?php echo $j; ?>"  title="season_end_month_0" >
				    </div>
				    <!-- End Month -->
				    <!-- Default season -->
				    <div class="col-sm-12">
					<div class="defaultSeason <?php if($IsDefault == 'Yes' ) { echo 'active';} ?>">
					    <label for="reg_input_name" class="req"> Is Default Season ?</label>
					    <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $j; ?>" class="is_default_hidden_class" value="<?php if($IsDefault == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
					    <input <?php if($IsDefault == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $j;?>" onclick="setDefault(<?php echo $j; ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $j; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $j; ?>">
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
		<h4 class="proHeadingText">&nbsp;
		    <span style="float: right;">
			<a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $year;?>);">
			    Add More Seasons
			</a>
		    </span>
		</h4>
	    </div>						
	    <?php
	    $countSeason++;
	}
    }
}
?>
<script type="text/javascript">
    
    //var get_year_x = $('.yeartab li data-itemtype').find('a').first().text(); alert(get_year_x);
    var get_year_x = <?php echo $tab_year ?> ;
    alert(get_year_x);
    
    $('.date-picker_'+ '<?php echo $tab_year ?>').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
	//yearRange:'-1:+2',
	yearRange: '<?php echo $tab_year ?>: <?php echo $tab_year ?>',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
    
</script>
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
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH;?>longrental_price.js"></script>