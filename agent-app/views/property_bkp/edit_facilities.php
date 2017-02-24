 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
 <h3 class="page-title"> Property Edit</h3>
 <!--For breadcrump-->    
  <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
  <!--For breadcrump end-->
    <div class="clearfix"></div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="portlet light">
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
                                            <div>
					    <form action="<?php echo AGENT_URL.'property/editfacilitiesaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal form-validate" id="propertyAddFrm" method="post" enctype="multipart/form-data">
					    <input type="hidden" name="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
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
					
					<!------- facilities section start ---->
					
					<div id="tab5-wizard-custom-circle" class="tab-pane fadeIn active">
					    <input type="hidden" name="action" value="facilities"/>	
					    <h3 class="mbxl">Facilities</h3>
					    	<div class="form-group">
                                                    <div class="col-sm-10">
							<?php if(is_array($facilities_list) and count($facilities_list)>0){ ?>
							<?php foreach($facilities_list as $index=>$data){ ?>
							    <div class="col-sm-4">
								<label>
								   
								    <input <?php echo (is_array($property_details['property_facility'])  and count($property_details['property_facility'])>0 and array_key_exists($data['amenities_id'],$property_details['property_facility']))? 'checked="checked"':''; ?> type="checkbox" name="property_facilities[]" value="<?php echo $data['amenities_id'] ?>" <?php  ?> /> <?php echo stripslashes($data['amenities_name']); ?>
								</label>
							    </div>
							<?php } ?>
							<?php } ?>
						    </div>
                                                </div>
						
						 <h3 class="mbxl">Policies</h3>
						 
					    	<div class="form-group">
                                                    <div class="col-sm-10">
							<?php if(is_array($policy_list) and count($policy_list)>0){ ?>
							<?php foreach($policy_list as $index=>$data){ ?>
							    <div class="col-sm-4">
								<label>
								    <input <?php echo (is_array($property_details['property_policy'])  and count($property_details['property_policy'])>0 and array_key_exists($data['policies_master_id'],$property_details['property_policy']))? 'checked="checked"':''; ?>  type="checkbox" name="property_ploicy[]" value="<?php echo $data['policies_master_id'] ?>" /> <?php echo stripslashes($data['policies_name']); ?>
								</label>
							    </div>
							<?php } ?>
							<?php } ?>
						    </div>
                                                </div>
						
						<h3 class="mbxl">Check in / Check out Time</h3>
						 
						<div class="form-group">
                                                    <div class="col-sm-12">
							<div class="col-sm-6">
							    <label for="earliest_check_in" class="col-sm-3 control-label">Check in</label>
    
							    <div class="col-md-9">
								    <!--<input type="text" class="timepicker-default form-control" name="earliest_check_in" id="earliest_check_in" value="<?php //echo date("h:i A", strtotime(date('Y-m-d').$property_details['property_master']['earliest_check_in'])) ?>"/>-->
								
								<?php
								$earliest_check_in = $property_details['property_master']['earliest_check_in'];
								$check_in = explode(':',$earliest_check_in);
								?>
								    
								<select name="check_in_hour" class="timeBox" >
								    <option value="">Hour</option>
								    <?php
								    for($i=0;$i<=23;$i++){
								    ?>
								    <option value="<?php echo ($i);?>" <?php if($check_in[0]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
								   <?php
								    }
								   ?> 
								    
								</select>
								
								<select name="check_in_minute" class="timeBox" >
								    <option value="">Minute</option>
								    <?php
								    for($i=0;$i<=60;$i++){
								    ?>
								    <option value="<?php echo ($i);?>" <?php if($check_in[1]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
								   <?php
								    }
								   ?> 
								    
								</select>
								    
							    </div>
							</div>
							<div class="col-sm-6">
							<label for="latest_check_in" class="col-sm-3 control-label">Check out</label>

							<div class="col-md-9">
							    <!--<input type="text" class="timepicker-default form-control" name="latest_check_in" id="latest_check_in" value="<?php //echo date("h:i A", strtotime(date('Y-m-d').$property_details['property_master']['latest_check_in'])) ?>"/>-->
								<?php
								$latest_check_in = $property_details['property_master']['latest_check_in'];
								$check_out = explode(':',$latest_check_in);
								?>
								<select name="check_out_hour" class="timeBox" >
								    <option value="">Hour</option>
								    <?php
								    for($i=0;$i<=23;$i++){
								    ?>
								    <option value="<?php echo ($i);?>" <?php if($check_out[0]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
								   <?php
								    }
								   ?> 
								    
								</select>
								
								<select name="check_out_minute" class="timeBox" >
								    <option value="">Minute</option>
								    <?php
								    for($i=0;$i<=60;$i++){
								    ?>
								    <option value="<?php echo ($i);?>" <?php if($check_out[1]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
								   <?php
								    }
								   ?> 
								    
								</select>
								
								
								    
							</div>
						    </div>

						    </div>
                                                </div>
					</div>
			<h3 class="mbxl">Night Stay</h3>		
					 <div class="form-group"><label for="minimum_nights_stay" class="col-sm-3 control-label">Minimum Night Stay</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							   
							   <select name="minimum_nights_stay" id="minimum_nights_stay">
							    <option value=""> No Mimimum Night Set </option>
							    <?php for($i=1;$i<=8;$i++){?>
							    <option value="<?php echo $i;?>" <?php if($property_details['property_master']['minimum_nights_stay'] == $i) echo "selected";?>><?php echo $i;?></option>
							    <?php }?>
							   </select>
							    
							</div>
						    </div>
                                                </div>
					 <div class="form-group"><label for="maximum_night_stay" class="col-sm-3 control-label">maximum Night Stay</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							   
							   <select name="maximum_nights_stay" id="maximum_nights_stay">
							    <option value=""> No Maximum Night Set </option>
							    <?php for($i=1;$i<=8;$i++){?>
							    <option value="<?php echo $i;?>" <?php if($property_details['property_master']['maximum_nights_stay'] == $i) echo "selected";?>><?php echo $i;?></option>
							    <?php }?>
							   </select>
							    
							</div>
						    </div>
                                                </div>
 
					
					<!------- facilities section end ---->
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property/editpriceaction/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info"><i class="fa fa-save"></i> Save and Next</button>
					    
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
    
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
