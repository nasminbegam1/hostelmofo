 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
 <h3 class="page-title">  Edit Property</h3>
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
                                            <div>
					    <form action="<?php echo AGENT_URL.'property/editAction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
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
                                                <div class="form-group"><label for="bedrooms" class="col-sm-3 control-label">Total Bedrooms</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_master']['bedrooms']); ?>" placeholder="" class="form-control " name="bedrooms" id="bedrooms"/><i class="alert alert-hide">Oops, bedrooms is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="beds" class="col-sm-3 control-label">Total Beds</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-inbox"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['beds']); ?>" class="form-control " name="beds" id="beds"/><i class="alert alert-hide">Oops, beds is required</i>
							</div>
						    </div>
                                                </div>
						
					    <div class="form-group"><label for="beds" class="col-sm-3 control-label">Room Type<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <?php
							    $room_type_arr = explode(',',$property_details['property_master']['room_type']);
							    if(count($roomtype_list)>0){ ?>
							    <?php foreach($roomtype_list as $room){ ?>
							    <div class="col-sm-4 room-type">
							    <input type="checkbox" name="room_type[]" class="propRomeType" value="<?php echo $room['roomtype_id'] ?>" <?php echo (in_array($room['roomtype_id'],$room_type_arr))? 'checked="checked"':'' ;  ?> /> &nbsp;<?php echo $room['roomtype_name'] ?></div>
							    <?php } } ?>
							</div>
							<i class="alert" id="room_type_msg" style="display: none;">Oops, Select at least one Room Type</i>
						    </div>
                                                </div>


                                        </div>
					<!----- details section end --->
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
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
   </div>    
  <script>
  
 
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
//    $(function(){
//        if (succ_msg) {
//              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
//        }
//        if (err_msg) {
//	      $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
//        }
//    });
//    
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
   
   //$('#rootwizard-custom-circle').bootstrapWizard({
   //     onTabShow: function(tab, navigation, index) {
   //         var $total = navigation.find('li').length;
   //         var $current = index+1;
   //         var $percent = ($current/$total) * 100;
   //         $('#rootwizard-custom-circle').find('.bar').css({width:$percent+'%'});
   //     },
   //     'onNext': function(tab, navigation, index) {
   //
   //         // select id of current tab content
   //         var $id = tab.find("a").attr("href");
   //         var $approved = 1;
   //         // Check all input validation
   //         $($id + " input").each(function(){
   //             if (!$(this).val()) {
   //                 $(this).css('border-color', 'red');
   //                 $(this).parent().parent().find("i.alert").removeClass("alert-hide");
   //                 $approved = 0;
   //             } else {
   //                 $(this).parent().parent().find("i.alert").addClass("alert-hide");
   //             }
   //         });
   //         if ($approved !== 1) return false;
   //     },
   //     'onTabClick': function(tab, navigation, index) {
   //         // select id of current tab content
   //         var $id = tab.find("a").attr("href");
   //         var $approved = 1;
   //         // Check all input validation
   //         $($id + " input").each(function(){
   //             if (!$(this).val()) {
   //                 $(this).css('border-color', 'red');
   //                 $(this).parent().parent().find("i.alert").removeClass("alert-hide");
   //                 $approved = 0;
   //             } else {
   //                 $(this).parent().parent().find("i.alert").addClass("alert-hide");
   //             }
   //         });
   //         if ($approved !== 1) return false;
   //         // Add class visited to style css
   //         if (tab.attr("class")=="visited"){
   //             tab.removeClass("visited");
   //         } else {
   //             tab.addClass("visited");
   //         }
   //     },
   //     'tabClass': 'bwizard-steps-o','nextSelector': '.button-next', 'previousSelector': '.button-previous'
   // });
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
