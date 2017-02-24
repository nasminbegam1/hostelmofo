<style type="text/css">
    .rightPan label {
    line-height: 34px;
}
.custom-border{
 padding-bottom: 10px ;
 border-bottom:1px solid #086176   
}
.border{border: 1px solid red;}
#ui-datepicker-div button.ui-datepicker-current,
#ui-datepicker-div button.ui-datepicker-close
{display: none;}
.loader{display: none;}

.page-content  .form-control{
   border-color:#9C9C9D !important;
}
.page-content  label, .page-content  h3{
    color:#545555 !important;
}
.yeartab li{
    border-radius:0px !important;
    border:none  !important;
    width: 70px  !important;
}
</style>

<div class="form-group">
<div class="col-mb-12 simpleTab">
    <ul id="myTab" class="nav nav-tabs yeartab">
	<li class="active"  data-itemtype="<?php echo date("Y");?>" >
	    <a data-toggle="tab" href="#season_pan_<?php echo date("Y");?>"  title="<?php echo date("Y");?>">
	    <?php echo date("Y");?>
	    </a>
	</li>
    </ul>
     <input type="hidden" name="curr_tab" id="curr_tab" value="">
    <div id="myTabContent" class="tab-content">
	  <div id="season_pan_<?php echo date("Y");?>" class="tab-pane fade in active property_tab_container active">
	    <div class="col-mb-12 text-right " >   
		    
		    <div class="col-md-12 text-right">
		      <button class="btn btn-blue" onclick="return addMoreSeasons(<?php echo date("Y");?>);">
		      <i class="fa fa-plus"></i>
		      Add More Seasons
		      </button>
		    </div>
		      
		    <br class="spacer"><br class="spacer" >
			    <div id="tableSeasons_<?php echo date("Y");?>" class="tableSeasons">
			    <div id="season_1" class="custom-border sub-season">
				    <div class="col-mb-12">
					<div class="col-md-4">
					    <h3>Season 1</h3>
					</div>
<!--					<div class="col-md-8 text-right">
					    <button type="button" id="removeSeason_1_<?php echo date("Y");?>" class="removeSeason btn btn-primary">
					    <i class="fa fa-times"></i>
					    Remove Season
					    </button>
					</div>
-->					<div style="clear: both"></div>
				    </div>
				    <br class="spacer">
				    <!-- Daily Price -->
					<div class="col-sm-4 rentDailyPricePan">
					    <div class="col-sm-12">
						<label for="reg_input_name" class="req">Daily Price</label><br/>
					    </div>
					    
					    <div class="col-sm-12">
						<div class="input-group">
						    <span class="input-group-addon">
							<i class="fa fa-money"></i>
						    </span>
						
						<input value="" name="season_daily[<?php echo date("Y");?>][]" type="text" class="form-control requiredInput daily-price-fld" data-required="true" data-type="number" id="dailyprice_1">
						<i class="alert alert-hide">Oops, price is required</i>
						</div>
					    </div>
		
					</div>
					<div class="col-sm-4 rentDailyPricePan">
					    <div class="col-sm-12">
						<label for="reg_input_name" class="req">Commission Rate</label><br/>
					    </div>
					    
					    <div class="col-sm-12">
						<div class="input-group">
						    <span class="input-group-addon">
							<i class="fa fa-money"></i>
						    </span>
						
						    <input value="" name="commission_rate[<?php echo date("Y");?>][]" type="text" class="form-control  " data-required="true" data-type="number" id="commission_rate_1">
						    <i class="alert alert-hide">Oops, commission rate is required</i>
						</div>
					    </div>
		
					</div>

					<!-- Min. rental price -->
					<div class="col-sm-4">
					    <div class="col-sm-12">
						<label for="reg_input_name" class="req">Minimum Rental Days</label>
					    </div>
					    <div class="col-sm-12">
						<div class="input-group">
						    <span class="input-group-addon">
							<i class="fa fa-exclamation"></i>
						    </span>
						    
						    <input value="" name="minimum_rental_days[<?php echo date("Y");?>][]" type="text" class="form-control " data-required="true" data-type="number" id="minrental_1">
						    <i class="alert alert-hide">Oops, minimum rental days is required</i>
						</div>
					    </div>
					</div>
					<!-- Min. rental price -->
					<!-- Season start date -->
					<div class="col-sm-4">
					    <div class="col-sm-12">
						<label for="reg_input_name" class="req">Season Start Date</label>
					    </div>
					    <div class="col-sm-12">
						<div class="input-group">
						    <span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						    </span>
						    
						    <input value="" type="text"  data-required="true"  class="season_start_date form-control requiredInput rental_start_date date_start_1" name="season_start_date[<?php echo date("Y");?>][]"  id="start_date_<?php echo date("Y")."_1" ?>"  data-element="1" data-year="<?php echo date("Y"); ?>">
						    <i class="alert alert-hide">Oops, start date is required</i>
						</div>
					    </div>
					</div>
					<!-- Season start date -->
					<!-- Season end date -->
					<div class="col-sm-4">
					    <div class="col-sm-12">
						<label for="reg_input_name" class="req">Season End Date</label>
					    </div>
					    <div class="col-sm-12">
						<div class="input-group">
						    <span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						    </span>
						    
						    <input readonly value="" type="text" data-required="true" class="season_start_date form-control requiredInput rental_end_date date_end_1" name="season_end_date[<?php echo date("Y");?>][]"   id="end_date_<?php echo date("Y")."_1" ?>"  data-element="1" data-year="<?php echo date("Y"); ?>">
						    <i class="alert alert-hide">Oops, end date is required</i>
						</div>
					    </div>
					</div>
					<!-- Season end date -->
					
					<!-- Default season -->
					<div class="col-sm-4">
					    <div class="col-sm-12">
						<br/>
					    </div>
					    <div class="col-sm-12 text-center" >
						<div class="defaultSeason active">
						<label for="reg_input_name" class="req">Is Default Season ?</label>
						<input type="hidden" name="is_default_hidden[<?php echo date("Y");?>][]" id="is_default_hidden_1" class="is_default_hidden_class" value="Yes">
						<input  value="1" onclick="setDefault(1);" class="form-controltwo seasonDefault" id="isdefault_1" name="isDefault[<?php echo date("Y");?>][]" type="radio" id="sesdefault_1" checked="checked">
						</div>
					    </div>
					</div>
					<div style="clear: both"></div>
					<!-- Default season -->
			      
			    </div>
	</div>

		</div>

	  </div>
    </div>
</div>
   <script type="text/javascript" src="<?php echo AGENT_JS_PATH;?>property_price.js"></script>
</div>
