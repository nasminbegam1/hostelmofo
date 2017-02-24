 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New Property</div>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">New Property Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
					
                                            <div class="portlet-body panel-body pan">
                                                                           <div id="rootwizard-custom-circle">
									     <form action="<?php echo BACKEND_URL.'property/addAction' ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
							    <li>
								<a href="#tab1-wizard-custom-circle"><i class="fa fa-home"></i>
	    
								<p class="anchor">Details</p>
	    
								<p class="description">Set up basic details</p></a></li>
							    <li>
								<a href="javascript:void(0);" ><i class="fa fa-flag-checkered"></i>
	    
								<p class="anchor">Contact</p>
	    
								<p class="description">Set up contact details</p></a></li>
							    
							  

								
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-info-circle"></i>
	    
								<p class="anchor">Basic Info</p>
	    
								<p class="description">Set up Basic Info</p></a></li>
							    
							      <li>
								<a href="javascript:void(0);"><i class="fa fa-money"></i>
	    
								<p class="anchor">Price</p>
	    
								<p class="description">Set up price</p></a></li>
							      
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-puzzle-piece"></i>
	    
								<p class="anchor">Facilities & Policies</p>
	    
								<p class="description">Set up various Facilities</p></a></li>
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-picture-o"></i>
	    
								<p class="anchor">Photo & Video</p>
	    
								<p class="description">Upload Photo and video</p></a></li>
							   <!-- <li>
								<a href="#tab6-wizard-custom-circle" data-toggle="tab"><i class="glyphicon glyphicon-check"></i>
	    
								<p class="anchor">Preview & Save</p>
	    
								<p class="description">Confirm and save</p></a></li>-->
							</ul>
                                        </div>
                                    </div>
                                    <div id="bar" class="progress active">
                                        <div class="bar progress-bar progress-bar-primary"></div>
                                    </div>
				    <div class="formPreLoader" style="">
					    <div class="imgLoaderDiv">
					         <img class="loader"   id="" src="<?php echo BACKEND_URL
						 ."vendors/pageloader/images/loader7.GIF" ?>" />
					    </div>
					</div>
                                    <div class="tab-content">
					
					
                                        <div id="tab1-wizard-custom-circle" class="tab-pane"><!--<h3 class="mbxl">Set up basic details</h3>-->

                                           
					      <input type="hidden" name="action" value="basic_info"/>
                                                <div class="form-group"><label for="property_name" class="col-sm-3 control-label">Property Name <span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-font"></i>
							    </span>
							    <input type="text" placeholder="" data-required="true" class="form-control requiredInput" name="property_name" id="property_name"/>
							    
							</div>
							    <i class="alert alert-hide">Oops, property name is required</i>
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
								<option value="<?php  echo $data['property_type_id']; ?>"><?php  echo stripslashes($data['property_type_name']); ?></option>
								<?php } ?>
								<?php } ?>
							    </select>
							    
							</div>
																		  <i class="alert alert-hide">Oops, property type is required</i>
						    </div>
                                                </div>
																
																
														  <div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Agent<span class='require'>*</span></label>
								<div class="col-sm-9">
                            <div class="input-group">
										  <span class="input-group-addon">
												<i class="fa fa-user"></i>
										  </span>
										  <select name="agent_id" class="requiredInput form-control">
												<option value="">Select agent</option>
												<?php if(count($agents) > 0){
													 foreach($agents as $agent){
														  echo '<option value="'.$agent['agent_id'].'">'.$agent['email'].'</option>';
													 }
												}
												?>
										  </select>
										  
									 </div>
									 <i class="alert alert-hide">Oops, Please select agent</i>
								</div>
						  </div>

								
								
								
								
                                                <div class="form-group"><label for="bedrooms" class="col-sm-3 control-label">Total Bedrooms<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="bedrooms" id="bedrooms"/>
							</div>
																		  <i class="alert alert-hide">Oops, bedrooms is required</i>
						    </div>
                                                </div>
						<div class="form-group"><label for="beds" class="col-sm-3 control-label">Total Beds<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="beds" id="beds"/>
							</div>
																		  <i class="alert alert-hide">Oops, beds is required</i>
						    </div>
                                                </div>
						
						  <div class="form-group"><label for="beds" class="col-sm-3 control-label">Guests<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="guests" id="guests"/>
							</div>
																		  <i class="alert alert-hide">Oops, Guest is required</i>
						    </div>
                                                </div>
						
					    <div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Room Type<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php if(count($roomtype_list)>0){ ?>
							    <?php foreach($roomtype_list as $room){ ?>
							    <div class="col-sm-4">
							    <input type="checkbox" name="room_type[]" class="propRomeType requiredInput" value="<?php echo $room['roomtype_id'] ?>" /> &nbsp;<?php echo $room['roomtype_name'] ?></div>
							    <?php } } ?>
							    <i class="alert alert-hide rType">Oops, Select at Least one Room Type</i>
							</div>
							
						    </div>
                                                </div>
						 
						 
						  <div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Allow Group booking ?</label>
								<div class="col-sm-9">
									 <div class="input-group">
									
									 <div class="col-sm-4">
									 <input type="checkbox" name="allow_group" id="" class="allow_group_booking" value="yes" />
									 </div>
							    
							</div>
							
						    </div>
                    </div>
						  <div class="groupListView" style="display: none;">
						  <?php 
							if(count($group_list)>0){ ?>
							    <?php foreach($group_list as $group){ ?>
							    <div class="form-group">
							    <label for="beds" class="col-sm-3 control-label">Group Type<span class='require'>*</span></label>
	  
							      <div class="col-sm-9">
								  <div class="input-group">
								      <input type="checkbox" name="group_type[<?php echo $group['id']; ?>]" class="allow_group_booking requiredInput" value="<?php echo $group['id'] ?>"/> &nbsp;<?php echo $group['typeName'] ?>
								  </div>
								  
							      </div>										 
							  </div>
							    <div class="form-group">
								<label for="beds" class="col-sm-3 control-label">Age Group<span class='require'>*</span></label>
	      
								  <div class="col-sm-9">
								      <div class="input-group">
									  <?php if(count($age_group)>0){ ?>
									  <?php foreach($age_group as $ageGrp){ ?>
									  <div class="col-sm-4">
									  <input type="checkbox" name="group_type[<?php echo $group['id']; ?>][]" class="propRomeType requiredInput" value="<?php echo $ageGrp['id'] ?>" /> &nbsp;<?php echo $ageGrp['ageGroup'] ?></div>
									  <?php } } ?>
									  <i class="alert alert-hide rType">Oops, Select at Least one age group</i>
								      </div>
								      
								  </div>											 
							      </div>
								      
							    <?php } ?>
							    
							    <?php } ?>
						  </div>
						 <!--<div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Group Type<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php if(count($group_list)>0){ ?>
							    <?php foreach($group_list as $group){ ?>
							    <div class="col-sm-4">
							    <input type="checkbox" name="group_type[]" class="propRomeType requiredInput" value="<?php echo $group['id'] ?>" /> &nbsp;<?php echo $group['typeName'] ?></div>
							    <?php } } ?>
							    <i class="alert alert-hide rType">Oops, Select at Least one group type</i>
							</div>
							
						    </div>
																	 
										</div>-->							 
						<!--<div class="form-group">
						  <label for="beds" class="col-sm-3 control-label">Age Group<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php if(count($age_group)>0){ ?>
							    <?php foreach($age_group as $group){ ?>
							    <div class="col-sm-4">
							    <input type="checkbox" name="age_group[]" class="propRomeType requiredInput" value="<?php echo $group['id'] ?>" /> &nbsp;<?php echo $group['ageGroup'] ?></div>
							    <?php } } ?>
							    <i class="alert alert-hide rType">Oops, Select at Least one age group</i>
							</div>
							
						    </div>											 
						</div>-->
                                                
						 
						 

                                        </div>
				


<div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
					    <button type="submit" name="save_now"  value="Save Now" class="btn btn-info addPropBtn"><i class="fa fa-save"></i> Save and Next</button>
					    
                                            <!--<button type="button" name="next" value="Save and Next" class="btn btn-info button-next mlm" id="nextAddProperty">Save and Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>-->
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
            $(document).ready(function(){
	    $('#meta_description').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>154){
		$(this).val(value.substring(0,155));
		 var len = 155; 
	    }
	    $('#countexact').text(len);
	});
	    

	
	$('#meta_title').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>68){
		$(this).val(value.substring(0,69));
		 var len = 69; 
	    }
	    $('#countexact_meta_title').text(len);
	});
	
    });
 
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

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
