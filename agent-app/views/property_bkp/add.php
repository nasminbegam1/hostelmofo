 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
 <h3 class="page-title"> Property Add</h3>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">New Property Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
					
                                            <div class="portlet-body panel-body pan">
                                                <div>
						<form action="<?php echo AGENT_URL.'property/addAction' ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
                                    <div class="property-bred">
                                        <div class="property-bred-inner">
                                            <ul>
							    <li class="active">
								<a href="javascript:void(0);"><i class="fa fa-home"></i>
	    
								<span>Details</span>
								
								</a>
							    </li>
							    <li>
								<a href="javascript:void(0);" ><i class="fa fa-flag-checkered"></i>
	    
								<span>Contact</span>
	
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-info-circle"></i>
	    
								<span>Basic Info</span>
								</a>
							    </li>
							    
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-money"></i>
	    
								<span>Price</span>
								</a>
							    </li>
							      
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-puzzle-piece"></i>
	    
								<span>Facilities & Policies</span>
								</a>
							    </li>
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-picture-o"></i>
	    
								<span>Photo & Video</span>
								</a>
							    </li>
							    <li>
								<a href="javascript:void(0);"><i class="fa fa-picture-o"></i>
	    
								<span>Contract</span>
								</a>
							    </li>
							</ul>
                                        </div>
                                    </div>
                                    <!--<div id="bar" class="progress active">
                                        <div class="bar progress-bar progress-bar-primary"></div>
                                    </div>-->
				    <div class="formPreLoader" style="">
					    <div class="imgLoaderDiv">
					         <img class="loader"   id="" src="<?php echo BACKEND_URL
						 ."vendors/pageloader/images/loader7.GIF" ?>" />
					    </div>
					</div>
                                    <div class="tab-content">
					
					
                                        <div id="tab1-wizard-custom-circle" class=""><!--<h3 class="mbxl">Set up basic details</h3>-->

                                           
					      <input type="hidden" name="action" value="basic_info"/>
                                                <div class="form-group"><label for="property_name" class="col-sm-3 control-label">Property Name <span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-font"></i>
							    </span>
							    <input type="text" placeholder="" data-required="true" class="form-control requiredInput" name="property_name" id="property_name" value="<?php echo set_value('property_name'); ?>"/>
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
								<option value="<?php  echo $data['property_type_id']; ?>" <?php echo set_value('property_type_id') == $data['property_type_id']? 'selected': '';?>><?php  echo stripslashes($data['property_type_name']); ?></option>
								<?php } ?>
								<?php } ?>
							    </select>
							    <i class="alert alert-hide">Oops, property type is required</i>
							</div>
						    </div>
                                                </div>
                                                <div class="form-group"><label for="bedrooms" class="col-sm-3 control-label">Total Bedrooms</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control " name="bedrooms" id="bedrooms"/><i class="alert alert-hide">Oops, bedrooms is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="beds" class="col-sm-3 control-label">Total Beds</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control " name="beds" id="beds"/><i class="alert alert-hide">Oops, beds is required</i>
							</div>
						    </div>
                                                </div>
						
					    <div class="form-group"><label for="beds" class="col-sm-3 control-label">Room Type<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php if(count($roomtype_list)>0){ ?>
							    <?php foreach($roomtype_list as $room){ ?>
							    <div class="col-sm-4 room-type">
							    <input type="checkbox" name="room_type[]" class="propRomeType requiredInput" value="<?php echo $room['roomtype_id'] ?>" /> &nbsp;<?php echo $room['roomtype_name'] ?></div>
							    <?php } } ?>
							    <i class="alert alert-hide rType">Oops, Select at Least one Room Type</i>
							</div>
							
						    </div>
                                                </div>


                                        </div>
				


<div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous disabled"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
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
