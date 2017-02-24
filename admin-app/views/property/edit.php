
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
                                        
                                       
                                        <?php if($errmsg){  
					?>
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
					    <form action="<?php echo BACKEND_URL.'property/editAction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
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
					
					<!----- details section start --->
					
                                        <div id="tab1-wizard-custom-circle" class="tab-pane active"><!--<h3 class="mbxl">Set up basic details</h3>-->

                                           
					      <input type="hidden" name="action" value="basic_info"/>
                                                <div class="form-group"><label for="property_name" class="col-sm-3 control-label">Property Name <span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-font"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_master']['property_name']); ?>" placeholder="" class="form-control requiredInput" name="property_name" id="property_name"/>
							    <i class="alert alert-hide">Oops, property name is required</i>
							</div>
							    
						    </div>
                                                </div>
                                                <div class="form-group"><label for="property_type_id" class="col-sm-3 control-label">Property Type <span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumb-tack"></i>
							    </span>
							    <select name="property_type_id" class="form-control requiredInput" id="property_type_id">
								<option value="">Select Any Type</option>
								<?php if(is_array($property_type) and count($property_type)>0){ ?>
								<?php foreach($property_type as $index=>$data){ ?>
								<option <?php echo ($property_details['property_master']['property_type_id']==$data['property_type_id'])? 'selected="selected"':''; ?> value="<?php  echo $data['property_type_id']; ?>"><?php  echo stripslashes($data['property_type_name']); ?></option>
								<?php } ?>
								<?php } ?>
							    </select>
							    <i class="alert alert-hide">Oops, property type is required</i>
							</div>
						    </div>
                                                </div>
                                            <div class="form-group"><label for="bedrooms" class="col-sm-3 control-label">Total Bedrooms<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_master']['bedrooms']); ?>" placeholder="" class="form-control requiredInput" name="bedrooms" id="bedrooms"/><i class="alert alert-hide">Oops, bedrooms is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="beds" class="col-sm-3 control-label">Total Beds<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['beds']); ?>" class="form-control requiredInput" name="beds" id="beds"/><i class="alert alert-hide">Oops, beds is required</i>
							</div>
						    </div>
                                                </div>
						
						
						<div class="form-group"><label for="beds" class="col-sm-3 control-label">Guests<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['guest']); ?>" class="form-control requiredInput" name="guests" id="guests"/><i class="alert alert-hide">Oops, beds is required</i>
							</div>
						    </div>
                                                </div>
						
					    <div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Room Type<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php
							    $room_type_arr = explode(',',$property_details['property_master']['room_type']);
							    if(count($roomtype_list)>0){ ?>
							    <?php foreach($roomtype_list as $room){ ?>
							    <div class="col-sm-4">
							    <input type="checkbox" name="room_type[]" class="propRomeType" value="<?php echo $room['roomtype_id'] ?>" <?php echo (in_array($room['roomtype_id'],$room_type_arr))? 'checked="checked"':'' ;  ?> /> &nbsp;<?php echo $room['roomtype_name'] ?></div>
							    <?php } } ?>
							</div>
							<i class="alert" id="room_type_msg" style="display: none;">Oops, Select at least one Room Type</i>
						    </div>
                                                </div>
						 
						 
						 
						 
						 <div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Allow Group booking ?</label>
								<div class="col-sm-9">
									 <div class="input-group">
									
									 <div class="col-sm-4">
									 <input type="checkbox" name="allow_group" class="allow_group_booking" value="yes" <?php echo ($property_details['property_master']['group_booking_support'] == 'yes') ? 'checked' : '' ;?>/>
									 </div>
							    
							</div>
							
						    </div>
                    </div>
						 
						 <div class="groupListView" <?php echo ($property_details['property_master']['group_booking_support'] == 'yes') ? 'style="display:block"' : 'style="display:none"' ;?>>
							    <?php 
							if(count($group_list)>0){ ?>
							    <?php foreach($group_list as $group){ ?>
							    <div class="form-group">
							    <label for="beds" class="col-sm-3 control-label">Group Type</label>
	  
							      <div class="col-sm-9">
								  <div class="input-group">
								      <input type="checkbox" name="group_type[<?php echo $group['id']; ?>]" class="propRomeType requiredInput" <?php if(in_array($group['id'], $grp_type)){echo 'checked'; } ?> value="<?php echo $group['id'] ?>"/> &nbsp;<?php echo $group['typeName'] ?>
								  </div>
								  
							      </div>										 
							  </div>
							    <div class="form-group">
								<label for="beds" class="col-sm-3 control-label">Age Group</label>
	      
								  <div class="col-sm-9">
								      <div class="input-group">
									  <?php if(count($age_group)>0){ ?>
									  <?php foreach($age_group as $ageGrp){ ?>
									  <div class="col-sm-4">
									  <input type="checkbox" <?php if(isset($ageGroup[$group['id']]) && in_array($ageGrp['id'], $ageGroup[$group['id']])){echo 'checked'; } ?> name="group_type[<?php echo $group['id']; ?>][]" class="propRomeType requiredInput" value="<?php echo $ageGrp['id'] ?>" /> &nbsp;<?php echo $ageGrp['ageGroup'] ?></div>
									  <?php } } ?>
									  <i class="alert alert-hide rType">Oops, Select at Least one age group</i>
								      </div>
								      
								  </div>											 
							      </div>
								      
							    <?php } ?>
							    
							    <?php } ?>
							    </div>


                                        </div>
					<!----- details section end --->
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info editRrmBtn"><i class="fa fa-save"></i> Save and Next</button>
					    
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
	if($("input[type='checkbox'][name='room_type[]']:checked").length == 0)
	{
	    $('#room_type_msg').show();
	    return false;
	}
	else
	{
	    $('#room_type_msg').hide();
	}
   } );
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
