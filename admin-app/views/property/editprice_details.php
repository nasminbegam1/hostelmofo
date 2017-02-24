
 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Property</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <?php if($errmsg){?>
                                        <div align="center">
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Property Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
					
                                            <div class="portlet-body panel-body pan">
                                            <div id="rootwizard-custom-circle">
					    <form action="<?php echo BACKEND_URL.'property/editpriceaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
					    <input type="hidden" name="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
					    <input type="hidden" name="action" value="price"/>	
				    <!------ tab start-------->
				    <?=$tabs?>
				    <!------ tab end --------->
				    <div class="formPreLoader" style="">
					    <div class="imgLoaderDiv">
					         <img class="loader"   id="" src="<?php echo BACKEND_URL
						 ."vendors/pageloader/images/loader7.GIF" ?>" />
					    </div>
				    </div>
                                    <div class="tab-content">
					

					
					<!------- price section start ---->
					
					<div id="tab4-wizard-custom-circle" class="tab-pane fadeIn active">
					    <div class="col-sm-12">
					    <h3 class="mbxl">Price</h3>					    
					    
					    </div>
					   
					   
					   
					   <div style="clear: both"></div>
					    
					       <div class="form-group"><label class="col-sm-3 control-label" for="contact_name">Diposite Amount (%)</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-user"></i>
							    </span>
							    <input type="text" id="deposite_amount" name="deposite_amount" class="form-control " placeholder="" value="<?php echo $property_details['property_master']['deposite_amount'];?>"><i class="alert alert-hide" style="display: none;">Oops, Diposite Amount is required</i>
							</div>
						    </div>
                                                </div>
					       
					<div class="form-group"><label class="col-sm-3 control-label" for="contact_name">Service Fee (%)</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-user"></i>
							    </span>
							    <input type="text" id="service_fees" name="service_fees" class="form-control " placeholder="" value="<?php echo $property_details['property_master']['service_fees'];?>">
							</div>
						    </div>
                                                </div>
					   
					   
					    <div style="clear: both"></div>
					    
					 
					    <div id="priceContainer">
						<?php
					        $room_type = $property_details['property_master']['room_type'];
						$room_type_arr = explode(',', $room_type);
						
						$result=array_intersect($room_type_arr,$roomtype_list);
						
						
						if(count($price_list)>0)
						{
						   
						foreach($price_list as $price)
						{
						   if(in_array($price['room_type'],$room_type_arr))
						   {
						?>
						  <div class="note note-warning" id="season_<?php echo $price['room_type'] ?>">
						    <div class="col-mb-12">
							<h3><?php echo $price['roomtype_name'] ?></h3>
							<input type="hidden" class="roomType" name="roomtype[]" value="<?php echo $price['room_type']; ?>"/>
							<div class="col-sm-4 rentDailyPricePan"><div class="col-sm-12"><label class="req" for="reg_input_name">Daily Price</label><br>
							</div>
							    <div class="col-sm-12"><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>
							    <input type="text" id="dailyprice_<?php echo $price['room_type']; ?>" data-type="number" data-required="true" class="form-control requiredInput daily-price-fld" name="season_daily[]" value="<?php echo $price['daily_price']; ?>">
							    <i class="alert alert-hide">Oops, price is required</i></div>
								</div>
							    </div>
							<div class="col-sm-4 rentDailyPricePan">
							    <div class="col-sm-12">
								<label for="reg_input_name" class="req">Commission Price</label><br/>
								</div>
							    <div class="col-sm-12">
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>
								    <input value="<?php echo $price['commission_price']; ?>" name="commission_rate[]" type="text" class="form-control  " data-required="true" data-type="number" id="commission_rate_<?php echo $price['room_type']; ?>">
								    <i class="alert alert-hide">Oops, commission rate is required</i>
								    </div></div>
							    </div>
							<div class="col-sm-4">
							    <div class="col-sm-12">
								<label class="req" for="reg_input_name">Minimum Rental Days</label>
								</div>
							    <div class="col-sm-12">
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-exclamation"></i></span>
								    <input type="text" id="minrental_<?php echo $price['room_type']; ?>" data-type="number" data-required="true" class="form-control " name="minimum_rental_days[]" value="<?php echo $price['minimum_rental_days']; ?>">
								    <i class="alert alert-hide">Oops, minimum rental days is required</i>
								    </div></div></div>
							<div class="col-sm-12">
							    <br/>
							    </div>
							<div class="col-sm-12 text-center">
							    <div class="defaultSeason">
								<label class="req" for="reg_input_name"> Is Default Room type?</label>
								<input type="radio" name="isDefault" id="isdefault_<?php echo $price['room_type']; ?>" class="form-controltwo seasonDefault custom-radio" onclick="javascript:setDefault(<?php echo $price['room_type'] ; ?>);" value="<?php echo $price['room_type']; ?>" <?php echo ($price['isDefault']=='Yes')? 'checked="checked"':''; ?> >								<i class="alert room_type_default_msg" style="display: none;">Oops, Select default Room Type</i>
								</div></div><div style="clear:both"></div></div>
						    
						    </div>
						 
						<?php } } }
						$result_diff = array_diff($room_type_arr,$result);
						
						if(is_array($result_diff) && count($result_diff)>0)
						{
						   
						foreach($result_diff as $diff)
						{   
						?>
						    
						    <div class="note note-warning" id="season_<?php echo $diff ?>">
						    <div class="col-mb-12">
							<h3><?php if(isset($new_prices[$diff]['roomtype_name'])) echo $new_prices[$diff]['roomtype_name']; ?></h3>
							<input type="hidden" class="roomType" name="roomtype[]" value="<?php echo $diff; ?>"/>
							<div class="col-sm-4 rentDailyPricePan"><div class="col-sm-12"><label class="req" for="reg_input_name">Daily Price</label><br>
							</div>
							    <div class="col-sm-12"><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>
							    <input type="text" id="dailyprice_<?php echo $diff; ?>" data-type="number" data-required="true" class="form-control requiredInput daily-price-fld" name="season_daily[]" value="<?php //echo $price['daily_price']; ?>">
							    <i class="alert alert-hide">Oops, price is required</i></div>
								</div>
							    </div>
							<div class="col-sm-4 rentDailyPricePan">
							    <div class="col-sm-12">
								<label for="reg_input_name" class="req">Commission Price</label><br/>
								</div>
							    <div class="col-sm-12">
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>
								    <input value="<?php //echo $price['commission_price']; ?>" name="commission_rate[]" type="text" class="form-control  " data-required="true" data-type="number" id="commission_rate_<?php echo $diff; ?>">
								    <i class="alert alert-hide">Oops, commission rate is required</i>
								    </div></div>
							    </div>
							<div class="col-sm-4">
							    <div class="col-sm-12">
								<label class="req" for="reg_input_name">Minimum Rental Days</label>
								</div>
							    <div class="col-sm-12">
								<div class="input-group"><span class="input-group-addon"><i class="fa fa-exclamation"></i></span>
								    <input type="text" id="minrental_<?php echo $diff; ?>" data-type="number" data-required="true" class="form-control " name="minimum_rental_days[]" value="<?php //echo $price['minimum_rental_days']; ?>">
								    <i class="alert alert-hide">Oops, minimum rental days is required</i>
								    </div></div></div>
							<div class="col-sm-12">
							    <br/>
							    </div>
							<div class="col-sm-12 text-center">
							    <div class="defaultSeason">
								<label class="req" for="reg_input_name"> Is Default Room type?</label>
								<input type="radio" name="isDefault" id="isdefault_<?php echo $diff; ?>" class="form-controltwo seasonDefault custom-radio" onclick="javascript:setDefault(<?php echo $diff ; ?>);" value="<?php echo $diff; ?>"  >
								<i class="alert room_type_default_msg" style="display: none;">Oops, Select default Room Type</i>
								</div></div><div style="clear:both"></div></div>
						    
						    </div>

						    
						    
						    
						<?php
						}
						
						}
						?>
					    </div>
					</div>

					<!------- price section end ---->
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property/editbasicaction/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now"  value="Save Now" class="btn btn-info editRrmBtn"><i class="fa fa-save"></i> Save and Next</button>
					    
                                            <!--<button type="button" name="next" value="Next" class="btn btn-info button-next mlm" id="nextAddProperty">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>-->
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
        </div>
        </div>
        </div>
        
  <script>
  
 
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
    
    $('.featured_image').change(function(){
	
	var img_id = $(this).attr('data-id');
	var property_id = $(this).attr('data-property-id');
	
	$.ajax({
	    type:'POST',
	    url:'<?php echo BACKEND_URL."property/is_feature";?>',
	    data:{img_id:img_id,property_id:property_id},
	    success:function(msg){		
		alert('Image has been featured succefully.');
	    }
	});
	
    });
    
    
    $(".editRrmBtn").click(function(){
	
	
	
	if($("input[type='radio'][name='isDefault']:checked").length == 0)
	{
	    $('.room_type_default_msg').show();
	    return false;
	}
	else
	{
	    $('.room_type_default_msg').hide();
	}
   } );
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
