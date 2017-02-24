<?php
$yr=$year-1;
if(is_array($season_price_list) && count($season_price_list) > 0){
    $countSeason= 1;
    $j= $season_record_count+1;
    foreach($season_price_list AS $key=>$value){
	if($key==$yr){
	    ?>						
	    <div id="season_pan_<?php echo stripslashes($year);?>" class="property_tab_container <?php if($countSeason == 1){echo 'active';}?>">							
		<h4 class="proHeadingText">&nbsp;
		    <span style="float: right;">
			<a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $year;?>);">Add More Seasons</a>
		    </span>
		</h4>
		<br class="spacer">
		<table width="100%" id="tableSeasons_<?php echo $year;?>" class="tableSeasons">
		    <?php
		    if(is_array($value) && count($value) > 0){
			for($i=0; $i<count($value); $i++){
			    ?>
			<tr id="season_<?php echo $j;?>">
			<td>
			<div class="col-sm-12">
			<legend>
			<b>Season <?php echo ($i+1);?></b>
			<a id="removeSeason_<?php echo ($j);?>_<?php echo $year;?>" href="javascript:void(0);" style=" float: right;" class="removeSeason">Remove Season</a></legend>
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
			<input readonly value="<?php
			$st_dt=date("d/m/Y", strtotime($value[$i]['season_start_date']));
			$st_dt1 = explode("/",$st_dt);
			$st_dt2 = $st_dt1[0]."/".$st_dt1[1]."/".$year;
			echo $st_dt2;?>" type="text"  title="date_start1_<?php echo $j;?>"   data-required="true"  item="<?php echo $value[$i]['price_id']; ?>"   class="season_start_date system_record form-controltwo required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[]" id="start_date_<?php echo $j; ?>">
			<?php } else { ?>
			<input value="" type="text" title="date_start1_<?php echo $j;?>" data-required="true"  class="season_start_date form-controltwo required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[]"  id="start_date_<?php echo $j;?>" >
			<?php } ?>
			</div>
			<!-- Season start date -->
			<!-- Season end date -->
			<div class="col-sm-4">
			<label for="reg_input_name" class="req">Season End Date</label>
			<?php if($value[$i]['season_end_date'] != '' && $value[$i]['season_end_date'] != '1970-01-01 00:00:00' && $value[$i]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
			<input value="<?php
			$end_dt=date("d/m/Y", strtotime($value[$i]['season_end_date']));
			$end_dt1 = explode("/",$end_dt);
			$end_dt2 = $end_dt1[0]."/".$end_dt1[1]."/".$year;
			echo $end_dt2;?>" type="text" title="date_end1_<?php echo $j;?>" data-required="true"  class="season_start_date system_record form-controltwo required rental_end_date date_end_<?php echo $j;?>"  name="season_end_date[]" item="<?php echo $value[$i]['price_id']; ?>" id="end_date_<?php echo $j; ?>">
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
<h4 class="proHeadingText">&nbsp; <span style="float: right;"> <a href="javascript:void(0);" onclick="addMoreSeasons(<?php echo $year;?>);">Add More Seasons</a> </span></h4>

</div>						
	    <?php
	    $countSeason++;
	}
    }
}
?>
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