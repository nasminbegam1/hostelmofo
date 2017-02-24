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
					    <form action="<?php echo AGENT_URL.'property/editcontactaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
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
					
					<!----- details section end --->
					
					<!----- contact section start --->
					<div id="tab2-wizard-custom-circle" class="tab-pane active"><!--<h3 class="mbxl">Set up Contact details</h3>-->
						 <input type="hidden" name="action" value="contact"/>
                                                <div class="form-group"><label for="address" class="col-sm-3 control-label">Address<span class='require'>*</span> </label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php
							    if(isset($property_details['property_details']['address']))
							    {
								 echo stripslashes($property_details['property_details']['address']);
							    }
							    else
							    {
								echo '';
							    }
							    ?>" class="form-control requiredInput" name="address" id="address"/><i class="alert alert-hide">Oops, address is required</i>
							</div>
							    
						    </div>
                                                </div>
                                                <div class="form-group"><label for="address2" class="col-sm-3 control-label">Address 2</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php
							     if(isset($property_details['property_details']['address2']))
							    {
								echo stripslashes($property_details['property_details']['address2']);
							    }
							    else
							    {
							    	echo '';
							    }
							    ?>" class="form-control" name="address2" id="address2"/>
							    
							</div>
						    </div>
                                                </div>
                                                <div class="form-group"><label for="province_id" class="col-sm-3 control-label">Province<span class='require'>*</span> </label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    
							    <select name="province_id" class="form-control requiredInput" id="province_id" data-city="<?php echo $property_details['property_details']['city_id']; ?>">
								<option value="">Select Any province</option>
								    <?php if(is_array($province_type) and count($province_type)>0){ ?>
								    <?php foreach($province_type as $index=>$data){ ?>
								    <option <?php if((isset($property_details['property_details']['province_id'])) &&  ($property_details['property_details']['province_id']==$data['province_id'])) echo  'selected="selected"'; ?> value="<?php  echo $data['province_id']; ?>"><?php  echo stripslashes($data['province_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							    <i class="alert alert-hide">Oops, address is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="zip_code" class="col-sm-3 control-label">Zip Code</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumb-tack"></i>
							    </span>
							    <input type="text" value="<?php
							    if(isset($property_details['property_details']['zip_code']))
							    {
								echo stripslashes($property_details['property_details']['zip_code']);
							    }
							    else
							    {
								echo '';
							    }
							     ?>" placeholder="" class="form-control" name="zip_code" id="zip_code"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="city_id" class="col-sm-3 control-label">City<span class='require'>*</span> </label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-flag"></i>
							    </span>
							    <select name="city_id" id="proCityDropDown" class="form-control requiredInput">
								
							    </select>
							    <i class="alert alert-hide">Oops, address is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="contact_name" class="col-sm-3 control-label">Contact Name</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-user"></i>
							    </span>
							    <input type="text" value="<?php
							    if(isset($property_details['property_details']['contact_name']))
							    {
								echo stripslashes($property_details['property_details']['contact_name']);
							    }
							    else
							    {
								echo '';
							    }
							    
							     ?>" placeholder="" class="form-control " name="contact_name" id="contact_name"/><i class="alert alert-hide">Oops, contact name is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="main_manager_email" class="col-sm-3 control-label">Contact Email</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" value="<?php
							    if(isset($property_details['property_details']['main_manager_email']))
							    {
								echo stripslashes($property_details['property_details']['main_manager_email']);
							    }
							    else
							    {
								echo '';
							    }
							     ?>" placeholder="" class="form-control" name="main_manager_email" id="main_manager_email"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="email_address_booking" class="col-sm-3 control-label">Booking Email</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php
							    if(isset($property_details['property_details']['main_manager_email']))
							    {
								echo stripslashes($property_details['property_details']['email_address_booking']);
							    }
							    else
							    {
								echo '';
							    }
							     ?>" class="form-control " name="email_address_booking" id="email_address_booking"/><i class="alert alert-hide">Oops, Booking email is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="website_address" class="col-sm-3 control-label">Website Address</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-magnet"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['website_address']); ?>" class="form-control" name="website_address" id="website_address"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="phone_no" class="col-sm-3 control-label">Phone No</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-phone"></i>
							    </span>
							     <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['phone_no']); ?>" class="form-control " name="phone_no" id="phone_no"/><i class="alert alert-hide">Oops, Phone no is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="mobile_address" class="col-sm-3 control-label">Mobile No</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-mobile"></i>
							    </span>
							     <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['mobile_address']); ?>" class="form-control" name="mobile_address" id="mobile_address"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="fax_no" class="col-sm-3 control-label">Fax No</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-phone-square"></i>
							    </span>
							     <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['fax_no']); ?>" class="form-control" name="fax_no" id="fax_no"/>
							</div>
						    </div>
                                                </div>
<!--						<div class="form-group"><label for="language_id" class="col-sm-3 control-label">Language</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-bullhorn"></i>
							    </span>
							    <select name="language_id" class="form-control" id="language_id">
								<option value="">Select Any Language</option>
								    <?php if(is_array($language_list) and count($language_list)>0){ ?>
								    <?php foreach($language_list as $index=>$data){ ?>
								    <option value="<?php  echo $data['property_language_id']; ?>"><?php  echo stripslashes($data['property_language_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
-->
						<div class="form-group"><label for="hear_about_id" class="col-sm-3 control-label">Hear About us</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumbs-o-up"></i>
							    </span>
							    <select name="hear_about_id" class="form-control" id="hear_about_id">
								<option value="">Select Any type</option>
								    <?php if(is_array($hearabout_list) and count($hearabout_list)>0){ ?>
								    <?php foreach($hearabout_list as $index=>$data){ ?>
								    <option <?php echo ($property_details['property_details']['hear_about_id']==$data['hear_about_id'])? 'selected="selected"':''; ?> value="<?php  echo $data['hear_about_id']; ?>"><?php  echo stripslashes($data['hear_about_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
						

                                        </div>
					
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property/edit/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info editRrmBtn"><i class="fa fa-save"></i> Save and Next</button>
					    
                                           <!-- <button type="button" name="next" value="Next" class="btn btn-info button-next mlm" id="nextAddProperty">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>-->
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
