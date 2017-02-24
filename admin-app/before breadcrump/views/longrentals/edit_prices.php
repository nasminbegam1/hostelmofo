<?php
$month = array("01"=>"January" , "02"=>"February" ,"03" => "March" ,"04"=> "April"  , "05"=> "May" ,"06"=> "June"  , "07"=>"July"  ,"08"=> "August"  , "09"=>"September"  ,"10" => "October"  ,"11"=> "November"  ,"12"=> "December"  );
?>
<style type="text/css">
    .loader{display: none;}
/*    .rightPan label {
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


.page-content  .form-control{
   border-color:#9C9C9D !important;
}
.page-content  label, .page-content  h3{
    color:#545555 !important;
}

em{ color: red;}
.err-form-control{box-shadow: 0px 0px 5px  #F58052 !important;}
#tab_content td{
    padding: 15px 10px;
   
}
.property_tab_container{display: none;}*/

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
                                   
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!--<div>-->
                                <div id="rootwizard-custom-circle">
				    
                                    <?=$tabs?>
                                </div>
				    <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="portlet box portlet-green">
					    <!--<div class="tab-content">-->
						<form action="<?php //echo $action_url;?>" class="form-horizontal" enctype="multipart/form-data" method="post">
						<input type="hidden" name="action" value="Process">
                                                
						<div id="tab1-wizard-custom-circle" class="tab-pane">
						   <!------general section start-->
						  
						   <br />
						 <div class="row">  
						<div class="col-md-12">
						<div class="panel panel-yellow portlet box portlet-yellow">
					
						<div class="portlet-header">
                                                    <div class="caption">
							    Seasonal Property Rents
							</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                </div>
						
						
				  
						
						<div class="portlet-body panel-body pan">
						
						    <div class="form-body pal">
							
                                                        <div class="col-mb-12 simpleTab">
							    <div class="col-mb-12">
							      
								 <div class="col-sm-3 ">
									    <label for="property_currency" class="req">Property Currency</label>
									    <select name="property_currency" id="property_currency" data-required="true"  class="form-control required">
										<!--<option value="">---Please Select---</option>-->
										<option value="THB" <?php if($property_details['property_currency']=='THB'){echo 'selected';} ?>>THB</option>
										<!--<option value="USD" <?php //if($property_details['property_currency']=='USD'){echo 'selected';} ?>>USD</option>-->
									    </select>
								    </div>
								    <div class="col-sm-3">
									<label class="req" for="electricity_price">Electricity Price</label>
									<input type="text" class="form-control" value="<?php echo $property_details['electricity_price'] ?>" id="electricity_price" name="electricity_price" />
								    </div>
								    <div class="col-sm-3">
									<label class="req" for="water_price">Water Price</label>
									<input type="text" class="form-control" value="<?php echo $property_details['water_price'] ?>" id="water_price" name="water_price" />
								    </div>
								    
								    <div class="col-sm-3">
									<label class="req" for="clean_price">Cleaning Price</label>
									<input type="text" class="form-control" value="<?php echo $property_details['cleaning_price'] ?>" id="clean_price" name="clean_price" />
								    </div>
								    <div style="clear: both"></div>
								    <div class="col-sm-3">
									<label class="req" for="security_deposit">Security Deposit</label>
									<input type="text" class="form-control" value="<?php echo $property_details['security_deposit'] ?>" id="security_deposit" name="security_deposit" />
								    </div>
								    <!-- Minimum Stay -->
								    <div class="col-sm-3">
									<label for="reg_input_name" class="req">Minimum Stay</label>
									<select name="minimum_stay" id="minimum_stay" data-required="true"  class="form-control required">
									    <option value="">---Please Select---</option>
									    <option value="1" <?php if($property_details['minimum_stay']==1)echo "selected='selected'"; ?>>1 Month</option>
									    <option value="3" <?php if($property_details['minimum_stay']==3)echo "selected='selected'"; ?>>3 Month</option>
									    <option value="6" <?php if($property_details['minimum_stay']==6)echo "selected='selected'"; ?>>6 Month</option>
									    <option value="12" <?php if($property_details['minimum_stay']==12)echo "selected='selected'"; ?>>Year</option>
									</select>
								    </div>
								    <!-- Minimum Stay -->
								     <!-- Yearly Price -->
								    <div class="col-sm-3">
									<label for="reg_input_name" class="req">Yearly Price</label>
									<input value="<?php echo $property_details['yearly_price'] ?>" name="yearly_price" type="text" class="form-control required" data-required="true" data-type="number" id="yearly_price">
								    </div>
								    <!-- Yearly Price -->
								
							    </div>
							    <div style="clear: both"></div>
							   
						<div id="tab_content" class="tab_content">
						<br>
						<?php
						
						if(is_array($season_price_list) && count($season_price_list) > 0){
						    $countSeason	= 1;
						   
						?>
						
						   
						    <span style="float: right;">
							<button onclick="return addMoreSeasons(<?php echo date("Y");?>);" class="btn btn-blue">
							    <i class="fa fa-plus"></i>
							    Add More Seasons
							</button>
						    </span>
						    
						     <div style="clear: both"></div>
						    <div data-year="<?php echo date("Y");?>"  id="season_pan_<?php echo date("Y");?>" class="property_tab_container active">							
						     					       <br class="spacer">
							<table style="width:100%"  id="tableSeasons_<?php echo date("Y");?>" class="tableSeasons">
							 <?php
							 $j			= 1;
							  
							foreach($season_price_list AS $key=>$value){
							     if(!$value['season_start_month']){
								$value['season_start_month'] = 1;
							     }
							    ?>
								
								<tr id="season_<?php echo date('Y');?>_<?php echo $j;?>" class="season_content" data-element="<?php echo $j ?>">
								    <td >

									<div class="col-mb-12">
									    <div class="col-md-4">
										<h3 class="season_heading">Season <?php echo $j;?></h3>
									    </div><div class="col-md-8 text-right">
										<button type="button" id="removeSeason_<?php echo $j;?>_<?php echo $key;?>" class="removeSeason btn btn-primary" data-year="<?php echo date('Y');?>" data-element="<?php echo $j;?>"><i class="fa fa-times"></i>Remove Season</button>
									    </div>
									    <div style="clear: both"></div>
									</div>

									<!-- 1 Month Price -->
									    <div class="col-sm-4">
										<label for="reg_input_name" class="req">1 Month Price</label>
										<input name="one_month_price[]" type="text" class="form-control  number required daily-price-fld" data-required="true" value="<?php echo $value['one_month_price'] ?>" data-type="number" id="one_month_price_<?php echo $key."_". $j ; ?>">
									    </div>
									    <!-- 1 Month Price -->
									    <!-- 3 Month Price -->
									    <div class="col-sm-4">
										<label for="reg_input_name" class="req">3 Month Price</label>
										<input value="<?php echo $value['three_month_price'] ?>" name="three_month_price[]" type="text" class="form-control required" data-required="true" data-type="number" id="three_month_price_<?php echo $key."_".$j; ?>">
									    </div>
									    <!-- 3 Month Price -->
									    <!-- 6 Month Price -->
									    <div class="col-sm-4">
										<label for="reg_input_name" class="req">6 Month Price</label>
										<input value="<?php echo $value['six_month_price'] ?>" name="six_month_price[]" type="text" class="form-control required" data-required="true" data-type="number" id="six_month_price_<?php echo $key."_".$j; ?>">
									    </div>
									    
									    <!-- 6 Month Price -->
									   <div style="clear: both"></div>
									   
									    <!-- Start Month -->
									    <div class="col-sm-4">
										<label for="reg_input_name" class="req">Start Month</label>
										<select name="start_month[]" id="start_month_<?php echo date('Y')
										."_".$j ?>" class="form-control start_month month_drop"  data-year="<?php echo date('Y') ?>">
										    <option value="01"><?php echo $month[ str_pad( $value['season_start_month'], 2, '0', STR_PAD_LEFT) ] ?></option>
										</select>
										<input readonly value="<?php echo $value['season_start_month'] ?>" type="hidden"   data-required="true"  class="required rental_start_month date_start_0" name="season_start_month[]" id="season_start_month_<?php echo $key."_".$j; ?>" >
									    </div>
									    <!-- Start Month -->
									    
									    <!-- End Month -->
									    <div class="col-sm-4">
										<label for="reg_input_name" class="req">End Month</label>
										<select name="end_month[]" id="end_month_<?php echo date('Y')."_".$j ?>" class="form-control end_month month_drop" data-year="<?php echo date('Y') ?>">
										    <?php
										     foreach($month as $index=>$m){
											
											    $selected="";
											    if($index==str_pad( $value['season_end_month'], 2, 0, STR_PAD_LEFT)){
												$selected="selected='selected'";
											    }
											    
											    echo "<option ".$selected." value='".$index."'>".$m."</option>";
											 
										     }
										    ?>
										</select>
										<input readonly value="<?php echo $value['season_end_month'] ?>" type="hidden"   data-required="true" class="required rental_end_month date_end_0" name="season_end_month[]" id="season_end_month_<?php echo $key."_".$j; ?>" >
									    </div>
									    <!-- End Month -->
									   
									    <!-- Default season -->
									    <div class="col-sm-4 text-center">
										<label>&nbsp;</label>
										<div style="width: 100%" class="defaultSeason <?php if($value['isDefault'] == 'Yes' ) { echo 'active';} ?>">
											<label for="reg_input_name" class="req"> Is Default Season ?</label>
											<input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo $key."_".$j; ?>" class="is_default_hidden_class" value="<?php if($value['isDefault'] == 'Yes' ) { echo 'Yes'; }else{echo 'No';}?>">
											<input value="<?php echo $j ?>" onclick="setDefault(<?php echo $j ?>,<?php echo $key ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo $key."_".$j; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo $key."_".$j; ?>" <?php if($value['isDefault'] == 'Yes' ) { echo 'checked="checked"';} ?>><!---->
										</div>
									    </div>
									    <div style="clear: both"></div>
									<!-- Default season -->
								    </td>
								</tr>
							    <?php
								    $j++;
							     $countSeason++;
							    }
							    ?>
							</table>
							<br class="spacer">
							<span style="float: right;">
							    <button onclick="return addMoreSeasons(<?php echo date("Y");?>);" class="btn btn-blue">
								<i class="fa fa-plus"></i>
								Add More Seasons
							    </button>
						        </span>
							<br class="spacer"><br class="spacer">
							
						    </div>						
						<?php
							
						}else{
						?>
						    <span style="float: right;">
							<button onclick="return addMoreSeasons(<?php echo date("Y");?>);" class="btn btn-blue">
							    <i class="fa fa-plus"></i>
							    Add More Seasons
							</button>
						    </span>
						    <div style="clear: both"></div>
						    <div id="season_pan_<?php echo date("Y");?>" class="property_tab_container active" data-year="<?php echo date("Y") ?>">
							
							
							<br class="spacer">
							<table width="100%" id="tableSeasons_<?php echo date("Y");?>" class="tableSeasons">
							    <tr id="season_<?php echo date("Y");?>_1" class="season_content" data-element="1">
								<td>
								   
								    <div class="col-md-4"><h3 class="season_heading">Season 1</h3></div>
								    <!--<div class="col-md-12">
									<legend>
									    <b>Season 1</b>
									    <a id="removeSeason_1_<?php echo date("Y");?>" href="javascript:void(0);" style=" float: right;" data-year="<?php echo date("Y"); ?>" data-element="1" class="removeSeason">Remove Season</a>
									</legend>
								    </div>-->
								    <div class="col-md-8 text-right"><button data-element="1" data-year="<?php echo date("Y");?>" class="removeSeason btn btn-primary" id="removeSeason_1_<?php echo date("Y");?>" type="button"><i class="fa fa-times"></i>Remove Season</button></div>
								   <div style="clear: both"></div>
								    <!-- 1 Month Price -->
								    <div class="col-sm-4">
									<label for="reg_input_name" class="req">1 Month Price</label>
									<input name="one_month_price[]" type="text" class="form-control  number required daily-price-fld" data-required="true" value="" data-type="number" id="one_month_price_<?php echo date("Y")."_1"; ?>">
								    </div>
								    <!-- 1 Month Price -->
								    <!-- 3 Month Price -->
								    <div class="col-sm-4">
									<label for="reg_input_name" class="req">3 Month Price</label>
									<input value="" name="three_month_price[]" type="text" class="form-control required" data-required="true" data-type="number" id="three_month_price_<?php echo date("Y")."_1"; ?>">
								    </div>
								    <!-- 3 Month Price -->
								    <!-- 6 Month Price -->
								    <div class="col-sm-4">
									<label for="reg_input_name" class="req">6 Month Price</label>
									<input value="" name="six_month_price[]" type="text" class="form-control required" data-required="true" data-type="number" id="six_month_price_<?php echo date("Y")."_1"; ?>">
								    </div>						
								    <!-- 6 Month Price -->
								    
								    <div style="clear: both"></div>
								 
								    <!-- Start Month -->
								    <div class="col-sm-4">
									<label for="reg_input_name" class="req">Start Month</label>
									<select name="start_month[]" id="start_month_<?php echo date("Y")."_1" ?>" class="form-control start_month month_drop"  data-year="<?php echo date("Y") ?>">
									    <option value="01"><?php echo $month["01"] ?></option>
									</select>
									<input readonly value="" type="hidden"   data-required="true"  class="required rental_start_month date_start_0" name="season_start_month[]" id="season_start_month_<?php echo date("Y")."_1"; ?>" >
								    </div>
								    <!-- Start Month -->
								    <!-- End Month -->
								    <div class="col-sm-4">
									<label for="reg_input_name" class="req">End Month</label>
									<select name="end_month[]" id="end_month_<?php echo date("Y")."_1" ?>" class="form-control end_month month_drop" data-year="<?php echo date("Y") ?>">
									    <?php
									     foreach($month as $index=>$m){
										
										echo "<option value='".$keyndex."'>".$m."</option>";
									     }
									    ?>
									</select>
									<input readonly value="" type="hidden"   data-required="true" class="required rental_end_month date_end_0" name="season_end_month[]" id="season_end_month_<?php echo date("Y")."_1"; ?>" >
								    </div>
								    <!-- End Month -->
								    
								    <!-- Default season -->
								    <div class="col-sm-4 text-center">
									<label>&nbsp;</label>
								    <div style="width:100%" class="defaultSeason active">
								    <label for="reg_input_name" class="req"> Is Default Season ?</label>
								    <input type="hidden" name="is_default_hidden[]" id="is_default_hidden_<?php echo date("Y")."_1"; ?>" class="is_default_hidden_class" value="Yes">
									    <input value="1" onclick="setDefault(1,<?php echo date("Y") ?>);" class="form-controltwo seasonDefault" id="isdefault_<?php echo date("Y")."_1"; ?>" name="isDefault[]" type="radio" id="sesdefault_<?php echo date("Y")."_1"; ?>" checked="checked"><!---->
									</div>
								    </div>
								   <div style="clear: both"></div>
								</td>
							    </tr>
							</table>
							<input type="hidden" name="total_season_count" id="total_season_count" value="<?php echo count($season_price_list);?>" />
				<input type="hidden" name="isSaveStay" id="isSaveStay" value="No" />
							<br class="spacer">
							<span style="float: right;">
							<button onclick="return addMoreSeasons(<?php echo date("Y");?>);" class="btn btn-blue">
							    <i class="fa fa-plus"></i>
							    Add More Seasons
							</button>
						    </span>
							<br class="spacer"><br class="spacer">
							
							
						    </div>
						<?php
						    $j	= 2;
						}    
						?>
						</div>
                                                    </div>
                                                        
						    </div>
						    
						   
						</div>
						 
						
						</div>
					    </div>
					    
						 </div>
						 
						 <div class="action text-right button-box">
							<button type="submit" name="submit" value="Previous" class="submit_but btn btn-info button-previous" onclick="javascript:window.location.href='<?php //echo $previous_url; ?>'">
							    <i class="fa fa-arrow-circle-o-left mrx"></i>
							    Previous
							</button>
							<button type="submit" name="submit" value="Next" class="submit_but btn btn-info">
							    Next
							    <i class="fa fa-arrow-circle-o-right mlx"></i>
							</button>
						    </div>
						 
						 
						</div>
						
						</form>    
					   <!-- </div>-->
				    </div>
                                <!--</div>-->
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

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH;?>longrental_price.js"></script>