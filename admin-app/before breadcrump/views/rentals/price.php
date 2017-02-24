
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
</style>
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_rental/index/"?>">Rental Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
		    
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Booking</div>
                                <div class="tools">
                                    <!--<i class="fa fa-chevron-up"></i>-->
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <!--<i class="fa fa-times"></i>-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div>
                                <div id="rootwizard-custom-circle">
				    
                                    <?=$tabs?>
                                    </div>
				    <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="portlet box portlet-green">
					    <div class="tab-content">
						<form action="<?php echo $action_url;?>" class="form-horizontal" enctype="multipart/form-data" method="post">
						<input type="hidden" name="action" value="Process">
                                                
						<div id="tab1-wizard-custom-circle" class="tab-pane">
						   <!------general section start-->
						  
						   <br />
						
						<div class="panel panel-orange portlet box portlet-orange">
					
							    <div class="portlet-header">
								<div class="caption">Seasonal Property Rents</div>
								<div class="tools">
								    <i class="fa fa-chevron-up"></i>
								</div>
							    </div>
	
							
							
						<div class="portlet-body panel-body pan">
						
						    <div class="form-body pal">
                                                        <div class="col-mb-12 simpleTab">
							    <div class="col-mb-12 text-right" >
								<img class="loader" src="<?php echo BACKEND_IMAGE_PATH."icons/loading.gif" ?>" style="width:30px;" />
								<span class="cloneSeasonPan btn btn-blue cloneSeason">Clone Season</span>
								<input type="hidden" name="clone_exist" id="clone_exist" value="0">
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
                                                                    }else{
                                                                    ?>
                                                                        <li class="active"  data-itemtype="<?php echo date("Y");?>" >
                                                                            <a data-toggle="tab" href="#season_pan_<?php echo date("Y");?>"  title="<?php echo date("Y");?>">
                                                                            <?php echo date("Y");?>
                                                                            </a>
                                                                        </li>
                                                                    <?php
                                                                    }    
                                                                    ?>
                                                             </ul>
                                                              <input type="hidden" name="curr_tab" id="curr_tab" value="">
							      <input type="hidden" name="property_id" id="property_id" value="<?php echo $property_id;?>">
							      
                                                            <div id="myTabContent" class="tab-content">
                                                                        <?php
                                                                        if(is_array($season_price_list) && count($season_price_list) > 0){
                                                                            $countSeason	= 1;
                                                                            
                                                                            foreach($season_price_list AS $key=>$value){
										$j			= 1;
                                                                        ?>
								
                                                                <div id="season_pan_<?php echo stripslashes($key);?>" class="tab-pane fade <?php if($countSeason == 1){echo ' in active';}?>">							
                                                                 <div class="col-mb-12 text-right" >   
                                                                    <div class="col-md-9">
                                                                        <div class="col-sm-5">
                                                                            <label for="local_information" class="req">Property Currency</label>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
                                                                                <option value="">---Please Select---</option>
                                                                                <option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'selected';} ?>>THB</option>
                                                                                <option value="USD" <?php if($property_details['property_currency']=='USD'){echo 'selected';} ?>>USD</option>
                                                                            </select>
                                                                        </div>
                                                                        <br class="spacer">
                                                                    </div>
                                                                    
                                                                      <div class="col-md-3 text-right">
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
                                                                                                            <input value="<?php echo $value[$i]['daily_disc'];?>" name="disc_daily[<?php echo $key ?>][]" type="hidden" id="dailydisc_<?php echo $key."_".$j ?>">
                                                                                                       </div>
													<div class="col-sm-12">
													    <div id="dailyPricePan_<?php echo $j;?>" class="dailyAutoPricePan" data-year="<?php echo $key;?>" >
														<div class="pan1">
														    <span><a id="dailyMPrice_<?php echo $j;?>" href="javascript:void(0);" class="dailyMPrice <?php if($value[$i]['daily_disc'] == 'M'){ echo 'active';} ?>">M</a></span>
														    <span><a id="daily0Price_<?php echo $j; ?>" href="javascript:void(0);" class="daily0Price <?php if($value[$i]['daily_disc'] == 0 && $value[$i]['daily_disc']!='' && $value[$i]['daily_disc']!='M'){ echo 'active';} ?>">0</a></span>
														</div>
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

                                                                                                        <div class="col-sm-12  input-icon">
                                                                                                            <i class="fa fa-money"></i>
                                                                                                            <input value="<?php echo $value[$i]['daily_price'];?>" name="season_daily[<?php echo $key ?>][]" type="text" class="form-control required daily-price-fld" data-required="true" data-type="number" id="dailyprice_<?php echo $j ?>">
                                                                                                        </div>
                                                                                                        
                                                                                                </div>
                                                                                                
                                                                                                <div class="col-sm-4 rentWeeklyPricePan ">
                                                                                                        <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Weekly Price</label><br/>
                                                                                                        <input value="<?php echo $value[$i]['weekly_disc'];?>" name="disc_weekly[<?php echo $key ?>][]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_<?php echo $j;?>">
                                                                                                        </div>
													<br class="spacer">
                                                                                                        <div class="col-sm-12">
                                                                                                                <div id="weeklyPricePan_<?php echo $j; ?>" class="weeklyAutoPricePan" data-year="<?php echo $key;?>">
                                                                                                                    <div class="pan1">
															<span><a id="weeklyMPrice_<?php echo $j; ?>" href="javascript:void(0);" class="weeklyMPrice <?php if($value[$i]['weekly_disc'] == 'M'){ echo 'active';} ?>">M</a></span>
															<span><a id="weekly0Price_<?php echo $j; ?>" href="javascript:void(0);" class="weekly0Price <?php if($value[$i]['weekly_disc'] == 0 && $value[$i]['weekly_disc']!=''){ echo 'active';} ?>">0</a></span>
														    </div>
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
                                                                                                        <div class="col-sm-12  input-icon">
                                                                                                            <i class="fa fa-money"></i>
                                                                                                            <input value="<?php echo $value[$i]['weekly_price'];?>" name="season_weekly[<?php echo $key ?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="weeklyprice_<?php echo $j ?>" >
                                                                                                        </div>
                                                                                                        
                                                                                                </div>
                                                                                                
                                                                                                 <div class="col-sm-4 rentMonthlyPricePan ">
                                                                                                    <div class="col-sm-12  input-icon">
                                                                                                        <label for="reg_input_name" class="req">MonthlyPrice</label><br/>
                                                                                                        <input value="<?php echo $value[$i]['monthly_disc'];?>" name="disc_monthly[<?php echo $key ?>][]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_<?php echo $j;?>">
                                                                                                         
                                                                                                    </div>
												    <br class="spacer">
                                                                                                    <div class="col-sm-12">
                                                                                                            <div id="monthlyPricePan_<?php echo $j; ?>" class="monthlyAutoPricePan" data-year="<?php echo $key;?>">
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
                                                                                                    <div class="col-sm-12  input-icon">
                                                                                                            <i class="fa fa-money"></i>
                                                                                                             <input value="<?php echo $value[$i]['monthly_price'];?>" name="season_monthly[<?php echo $key ?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="monthlyprice_<?php echo $j ?>" >
                                                                                                    </div>
                                                                                                    
                                                                                                </div>
                                                                                                
												<div style="clear: both"></div>
												<br class="spacer" /><br class="spacer" />
												
                                                                                                 <div class="col-sm-4">
                                                                                                    <div class="col-sm-12">
                                                                                                     <label for="reg_input_name" class="req">Minimum Rental Days</label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-exclamation"></i>
                                                                                                        <input value="<?php echo $value[$i]['minimum_rental_days'];?>" name="minimum_rental_days[<?php echo $key ?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="minrental_<?php echo $j ?>">
                                                                                                    </div>
                                                                                                 </div>
                                                                                                 
                                                                                                  <div class="col-sm-4">
                                                                                                     <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Season Start Date</label>
                                                                                                     </div>
                                                                                                     <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-calendar"></i>
                                                                                                          <?php if($value[$i]['season_start_date'] != '' && $value[$i]['season_start_date'] != '1970-01-01 00:00:00' && $value[$i]['season_start_date'] !='0000-00-00 00:00:00'){ ?>
                                                                                                            <input readonly value="<?php echo date("d/m/Y", strtotime($value[$i]['season_start_date']));?>" type="text"     data-required="true"  item="<?php echo $value[$i]['price_id']; ?>"   class="season_start_date system_record form-control required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[<?php echo $key ?>][]" id="start_date_<?php echo $key."_".$j ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key; ?>">
                                                                                                          <?php } else { ?>
                                                                                                            <input value="" type="text"  data-required="true"  class="season_start_date form-control required rental_start_date date_start_<?php echo $j;?>" name="season_start_date[<?php echo $key ?>][]"  id="start_date_<?php echo $key."_".$j ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key; ?>" >
                                                                                                          <?php } ?>
                                                                                                     </div>
                                                                                                 </div>
                                                                                                  
                                                                                                  <div class="col-sm-4">
                                                                                                     <div class="col-sm-12">
                                                                                                     <label for="reg_input_name" class="req">Season End Date</label>
                                                                                                     </div>
                                                                                                      <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-calendar"></i>
                                                                                                            <?php if($value[$i]['season_end_date'] != '' && $value[$i]['season_end_date'] != '1970-01-01 00:00:00' && $value[$i]['season_end_date'] !='0000-00-00 00:00:00'){ ?>
                                                                                                             <input value="<?php echo date("d/m/Y", strtotime($value[$i]['season_end_date']));?>" type="text"  data-required="true"  class="season_start_date system_record form-control required rental_end_date date_end_<?php echo $j;?>"  name="season_end_date[<?php echo $key ?>][]" item="<?php echo $value[$i]['price_id']; ?>" id="end_date_<?php echo $key."_".$j ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key; ?>">
                                                                                                           <?php } else { ?>
                                                                                                         <input readonly value="" type="text" data-required="true" class="season_start_date form-control required rental_end_date date_end_<?php echo $j;?>" name="season_end_date[<?php echo $key ?>][]"   id="end_date_<?php echo $key."_".$j ?>" data-element="<?php echo $j ?>" data-year="<?php echo $key; ?>">
                                                                                                           <?php } ?>
                                                                                                      </div>
                                                                                                 </div>
                                                                                                  
                                                                                                <div style="clear: both"></div>
												<br class="spacer" /><br class="spacer" />
												
                                                                                                <!-- Default season -->
                                                                                                <div class="col-sm-12">
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
                                                                                <br class="spacer">
                                                                                <div class="col-mb-12 text-right">
                                                                                    <button class="btn btn-blue" onclick="return addMoreSeasons(<?php echo $key;?>);">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Add More Seasons
                                                                                    </button>
                                                                                </div>
                                                                                
                                                                            </div>						
                                                                        <?php
                                                                                $countSeason++;
                                                                            }
                                                                        }else{
                                                                        ?>
                                                                            <div id="season_pan_<?php echo date("Y");?>" class="tab-pane fade in active property_tab_container active">
                                                                                  <div class="col-mb-12 text-right " >   
                                                                                    <div class="col-md-9">
                                                                                        <div class="col-sm-5">
                                                                                            <label for="local_information" class="req">Property Currency</label>
                                                                                        </div>
                                                                                        <div class="col-sm-4">
                                                                                            <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
                                                                                                <option value="">---Please Select---</option>
                                                                                                <option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'selected';} ?>>THB</option>
                                                                                                <option value="USD" <?php if($property_details['property_currency']=='USD'){echo 'selected';} ?>>USD</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br class="spacer">
                                                                                    </div>
                                                                                    
                                                                                      <div class="col-md-3 text-right">
                                                                                        <button class="btn btn-blue" onclick="return addMoreSeasons(<?php echo date("Y");?>);">
                                                                                        <i class="fa fa-plus"></i>
                                                                                        Add More Seasons
                                                                                        </button>
                                                                                      </div>
                                                                                      
                                                                                    <br class="spacer"><br class="spacer" >
                                                                                </div>
                                                                                
                                                                                <br class="spacer">
                                                                                <div id="tableSeasons_<?php echo date("Y");?>" class="tableSeasons">
                                                                                    <div id="season_1" class="custom-border sub-season">
                                                                                            <div class="col-mb-12">
                                                                                                <div class="col-md-4">
                                                                                                    <h3>Season 1</h3>
                                                                                                </div>
                                                                                                <div class="col-md-8 text-right">
                                                                                                    <button type="button" id="removeSeason_1_<?php echo date("Y");?>" class="removeSeason btn btn-primary">
                                                                                                    <i class="fa fa-times"></i>
                                                                                                    Remove Season
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div style="clear: both"></div>
                                                                                            </div>
                                                                                            <br class="spacer">
                                                                                            <!-- Daily Price -->
                                                                                                <div class="col-sm-4 rentDailyPricePan">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Daily Price</label><br/>
                                                                                                        <input type="hidden" name="dailyPriceTmp[<?php echo date("Y");?>][]" id="dailyPriceTmp_1" value="">
                                                                                                    </div>
												    
												    <div class="col-sm-12">
                                                                                                    <div id="dailyPricePan_1" class="dailyAutoPricePan" data-year="<?php echo date("Y");?>">
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

												    
                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-money"></i>
                                                                                                        <input value="" name="season_daily[<?php echo date("Y");?>][]" type="text" class="form-control required daily-price-fld" data-required="true" data-type="number" id="dailyprice_1">
                                                                                                    </div>

                                                                                                </div>
                                                                                                <!-- Daily Price -->
                                                                                                <!-- Weekly price -->
                                                                                                <div class="col-sm-4 rentWeeklyPricePan">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Weekly Price</label><br/>
                                                                                                        <input value="" name="disc_weekly[<?php echo date("Y");?>][]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="weeklydisc_1">
                                                                                                    </div>
												     <div class="col-sm-12">
                                                                                                        <div id="weeklyPricePan_1" class="weeklyAutoPricePan"  data-year="<?php echo date("Y");?>">
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

                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-money"></i>    
                                                                                                        <input value="" name="season_weekly[<?php echo date("Y");?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="weeklyprice_1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Weekly price -->									     <!-- Monthly price -->
                                                                                                <div class="col-sm-4 rentMonthlyPricePan">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">MonthlyPrice</label><br/>
                                                                                                    </div>
												    <div class="col-sm-12">
                                                                                                        <div id="monthlyPricePan_1" class="monthlyAutoPricePan"  data-year="<?php echo date("Y");?>">
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

                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-money"></i>
                                                                                                        <input value="" name="season_monthly[<?php echo date("Y");?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="monthlyprice_1">
                                                                                                        <input value="" name="disc_monthly[<?php echo date("Y");?>][]" type="hidden" class="form-controltwo required" data-required="true" data-type="number" id="monthlydisc_1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Monthly price -->
												<div style="clear: both"></div>
												<br class="spacer" /><br class="spacer" />
                                                                                                <!-- Min. rental price -->
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Minimum Rental Days</label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-exclamation"></i>
                                                                                                        <input value="" name="minimum_rental_days[<?php echo date("Y");?>][]" type="text" class="form-control required" data-required="true" data-type="number" id="minrental_1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Min. rental price -->
                                                                                                <!-- Season start date -->
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Season Start Date</label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-calendar"></i>
                                                                                                        <input value="" type="text"  data-required="true"  class="season_start_date form-control required rental_start_date date_start_1" name="season_start_date[<?php echo date("Y");?>][]"  id="start_date_<?php echo date("Y")."_1" ?>"  data-element="1" data-year="<?php echo date("Y"); ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Season start date -->
                                                                                                <!-- Season end date -->
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="col-sm-12">
                                                                                                        <label for="reg_input_name" class="req">Season End Date</label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 input-icon">
                                                                                                        <i class="fa fa-calendar"></i>
                                                                                                        <input readonly value="" type="text" data-required="true" class="season_start_date form-control required rental_end_date date_end_1" name="season_end_date[<?php echo date("Y");?>][]"   id="end_date_<?php echo date("Y")."_1" ?>"  data-element="1" data-year="<?php echo date("Y"); ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Season end date -->
												<div style="clear: both"></div>
												<br class="spacer" /><br class="spacer" />
                                                                                                <!-- Default season -->
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="col-sm-12 text-center" >
                                                                                                        <div class="defaultSeason active">
                                                                                                        <label for="reg_input_name" class="req"> Is Default Season ?</label>
                                                                                                        <input type="hidden" name="is_default_hidden[<?php echo date("Y");?>][]" id="is_default_hidden_1" class="is_default_hidden_class" value="Yes">
                                                                                                        <input  value="1" onclick="setDefault(1);" class="form-controltwo seasonDefault" id="isdefault_1" name="isDefault[<?php echo date("Y");?>][]" type="radio" id="sesdefault_1" checked="checked">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
												<div style="clear: both"></div>
                                                                                                <!-- Default season -->
                                                                                      
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list);?>" />
                                                        <input type="hidden" name="isSaveStay" id="isSaveStay" value="No" />
                                                                                <br class="spacer">
                                                                                <div class="col-mb-12 text-right">    
                                                                                    <button  class="btn btn-blue" onclick="return addMoreSeasons(<?php echo date("Y");?>);">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Add More Seasons
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                            $j	= 2;
                                                                        }    
                                                                        ?>
                                                            </div>
                                                        </div>
                                                        
						    </div>
						    
						   
						</div>
						 
						<!------aminities section end button-next mlm--->
						</div>
						
						 <div class="action text-right button-box">
							<button type="submit" name="submit" value="Previous" class="btn btn-info button-previous" onclick="javascript:window.location.href='<?php echo $previous_url; ?>'">
							    <i class="fa fa-arrow-circle-o-left mrx"></i>
							    Previous
							</button>
							<button type="submit" name="submit" value="Next" class="btn btn-info">
							    Next
							    <i class="fa fa-arrow-circle-o-right mlx"></i>
							</button>
						    </div>
						 
						 
						</div>
						
						</form>    
					    </div>
				    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT-->

<script>
       /**** session succ/err msg display *****/
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
     
    });
</script>       

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH;?>rental_price.js"></script>