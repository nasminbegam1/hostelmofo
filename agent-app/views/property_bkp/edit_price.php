<style>
    .yeartab li{
    border-radius:0px !important;
    border:none  !important;
    width: 70px  !important;
}
</style>
<div class="simpleTab">
<div class="col-mb-12 text-right" >   
<span class="cloneSeasonPan btn btn-blue cloneSeason">Clone Season</span>
<input type="hidden" name="clone_exist" id="clone_exist" value="0">
<input type="hidden" name="curr_tab" id="curr_tab" value="">
<input type="hidden" name="property_id" id="property_id" value="<?php echo $this->uri->segment(3,0) ;?>">
</div>
<ul id="myTab" class="nav nav-tabs yeartab">
<?php
    if(is_array($season_price_list) && count($season_price_list) > 0){
	$countSeason	= 1;
	foreach($season_price_list AS $key => $value){
    ?>
	<li <?php if($countSeason == 1){echo 'class="active"';}?>  data-itemtype="<?php echo stripslashes($key);?>" >
	    <a class="seasonHolder" data-toggle="tab" href="#season_pan_<?php echo stripslashes($key);?>" title="<?php echo stripslashes($key);?>">
	    <?php echo stripslashes($key);?>
	    </a>
	</li>
    <?php
	    $countSeason++;
	}
    }
    ?>
    </ul>
     <input type="hidden" name="curr_tab" id="curr_tab" value="">
    <div id="myTabContent" class="tab-content">
<?php
	    if(is_array($season_price_list) && count($season_price_list) > 0){
		$countSeason	= 1;
		
		foreach($season_price_list AS $key=>$value){
		    $j			= 1;
		    //$key=$key+1;
	    ?>
    
    <div id="season_pan_<?php echo stripslashes($key);?>" class="tab-pane fade <?php if($countSeason == 1){ echo "in active"; } ?> property_tab_container ">							
     <div class="col-mb-12 text-right" >   
	
	  <div class="col-md-12 text-right">
	    <button class="btn btn-blue" onclick="return addMoreSeasons(<?php echo $key;?>);">
	    <i class="fa fa-plus"></i>
	    Add More Seasons
	    </button>
	  </div>
	  
	<br class="spacer"><br class="spacer" >
    </div>
		    <br class="spacer">
		    <div id="tableSeasons_<?php echo $key;?>" class="tableSeasons">
			<?php
			if(is_array($value) && count($value) > 0){
			    for($i=0; $i<count($value); $i++){
			?>
			    <div id="season_<?php echo $j;?>" class="custom-border sub-season">
				
				    <div class="col-mb-12">
					<div class="col-md-4" >
					    <h3>Season <?php echo ($i+1);?></h3>
					</div>
					<div class="col-md-8 text-right">
					    <button type="button" id="removeSeason_<?php echo ($j);?>_<?php echo $key;?>" class="removeSeason btn btn-primary">
					    <i class="fa fa-times"></i>
					    Remove Season
					    </button>
					</div>
					<div style="clear: both"></div>
				    </div>
				    <br class="spacer">
				    <div class="col-sm-4 rentDailyPricePan ">
					   <div class="col-sm-12">
						<label for="reg_input_name" class="req">Daily Price</label><br/>
						<input type="hidden" name="dailyPriceTmp[<?php echo $key ?>][]" id="dailyPriceTmp_<?php echo $j;?>" value="<?php echo $value[$i]['daily_price'];?>">
						
					   </div>
					    <div class="col-sm-12">
						 <div class="input-group">
						      <span class="input-group-addon">
						       <i class="fa fa-money"></i>
						      </span>
						
						<input value="<?php echo $value[$i]['daily_price'];?>" name="season_daily[<?php echo $key ?>][]" type="text" class="form-control requiredInput daily-price-fld" data-required="true" data-type="number" id="dailyprice_<?php echo $j ?>">
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
			<input value="<?php echo $value[$i]['commission_rate'];?>" name="commission_rate[<?php echo $key;?>][]" type="text" class="form-control requiredInput " data-required="true" data-type="number" id="commission_rate_<?php echo $j ?>">
			<i class="alert alert-hide">Oops, commission rate is required</i>
			 </div>
		    </div>

		</div>

				     <div class="col-sm-4">
					<div class="col-sm-12">
					 <label for="reg_input_name" class="req">Minimum Rental Days</label>
					</div>
					<div class="col-sm-12">
						<div class="input-group">
						      <span class="input-group-addon">
						       <i class="fa fa-exclamation"></i>
						      </span>
					    <input value="<?php echo $value[$i]['minimum_rental_days'];?>" name="minimum_rental_days[<?php echo $key ?>][]" type="text" class="form-control requiredInput" data-required="true" data-type="number" id="minrental_<?php echo $j ?>">
					    <i class="alert alert-hide">Oops, minimum rental days is required</i>
						   </div>
					</div>
				     </div>
				     
				      <div class="col-sm-4">
					 <div class="col-sm-12">
					    <label for="reg_input_name" class="req">Season Start Date</label>
					 </div>
					 <div class="col-sm-12">
					  <div class="input-group">
						      <span class="input-group-addon">
						       <i class="fa fa-calendar"></i>
						      </span>
					   <input readonly value="<?php echo date("d/m/Y", strtotime($value[$i]['season_start_date']));?>" type="text"     data-required="true"  item="<?php echo $value[$i]['price_id']; ?>"   class="season_start_date system_record form-control required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[<?php echo $key;?>][]" id="start_date_<?php echo $key."_".$j; ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key ?>">
					      
					      <i class="alert alert-hide">Oops, start date is required</i>
					  </div>
					 </div>
				     </div>
				      
				      <div class="col-sm-4">
					 <div class="col-sm-12">
					 <label for="reg_input_name" class="req">Season End Date</label>
					 </div>
					  <div class="col-sm-12">
						 <div class="input-group">
						    <span class="input-group-addon">
						    <i class="fa fa-calendar"></i>
						    </span>
									  
						<input value="<?php echo date("d/m/Y", strtotime($value[$i]['season_end_date']));?>" type="text"  data-required="true"  class="season_start_date system_record form-control required rental_end_date date_end_<?php echo $j;?>"  name="season_end_date[<?php echo $key;?>][]" item="<?php echo $value[$i]['price_id']; ?>" id="end_date_<?php echo $key."_".$j; ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key ?>">
					     
					       <i class="alert alert-hide">Oops, end date is required</i>
						 </div>
					  </div>
				     </div>
				      
				  
				    <!-- Default season -->
				    <div class="col-sm-4">
					 <div class="col-sm-12">
					       <label for="reg_input_name" class="req"><br/></label>
					 </div>
					<div class="col-sm-12  text-center">
					<div class="defaultSeason <?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'active';} ?>">
					<label for="reg_input_name" class="req"> Is Default Season ?</label>
					<input type="hidden" name="is_default_hidden[<?php echo $key ?>][]" id="is_default_hidden_<?php echo $j; ?>" class="is_default_hidden_class" value="<?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
					<input <?php if($value[$i]['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?> value="<?php echo $j;?>" onclick="setDefault(<?php echo $j; ?>);" class="form-controltwo seasonDefault custom-radio" id="isdefault_<?php echo $j; ?>" name="isDefault[<?php echo $key ?>][]" type="radio" />
					</div>
					</div>
				    </div>
				     <div style="clear: both"></div>
			    </div>
			    <br class="spacer">
			<?php
				$j++;
			    }
			}    
			?>
		    </div>
		   
		    
		</div>						
	    <?php
		    $countSeason++;
		}
	    }?>
    </div>
</div>
<script type="text/javascript" src="<?php echo AGENT_JS_PATH;?>property_price.js"></script>