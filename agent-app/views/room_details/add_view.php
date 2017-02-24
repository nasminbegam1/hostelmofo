<form action="<?php echo AGENT_URL.'property/addAction' ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
						<div class="property-bred">
						    <div class="property-bred-inner">
							<ul>
									<li class="active">
									    <a href="javascript:void(0);">
									    <span>Contact Details</span>
									    </a>
									</li>
									<li>
									    <a href="javascript:void(0);" >
									    <span>Microsite Content</span>
									
								    </ul>
						    </div>
						</div>
					       <div class="formPreLoader" style="">
						   <div class="imgLoaderDiv">
							<img class="loader"   id="" src="<?php echo BACKEND_URL
							."vendors/pageloader/images/loader7.GIF" ?>" />
						   </div>
					       </div>
                                    <div class="tab-content">
					
					<input type="hidden" name="action" value="basic_info"/>
                                        <div id="tab1-wizard-custom-circle" class=""><!--<h3 class="mbxl">Set up basic details</h3>-->
					    <h3>Edit Property</h3>
					    <div class="propertyContent">
					     <h5><strong>1.Property Information</strong></h5>
					       <div class="form-group"><label for="property_name" class="col-sm-3 control-label">Property Name <span class='require'>*</span></label>
						 <div class="col-sm-9">
						     <div class="input-group">
							 <span class="input-group-addon">
							     <i class="fa fa-font"></i>
							 </span>
							 <input type="text" value="" placeholder="" class="form-control requiredInput" name="property_name" id="property_name"/>
							 <i class="alert alert-hide">Oops, property name is required</i>
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
								  <option value="<?php  echo $data['province_id']; ?>"><?php  echo stripslashes($data['province_name']); ?></option>
								  <?php } ?>
								  <?php } ?>
							  </select>
							  <i class="alert alert-hide">Oops, province is required</i>
						      </div>
						  </div>
					      </div>
					     <div class="form-group"><label for="address" class="col-sm-3 control-label">Address<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       <i class="fa fa-home"></i>
							   </span>
							   <input type="text" placeholder="" value="" class="form-control requiredInput" name="address" id="address"/><i class="alert alert-hide">Oops, address is required</i>
						       </div>
							   
						   </div>
					       </div>
					     <div class="form-group"><label for="address2" class="col-sm-3 control-label">Address 2</label>
						    <div class="col-sm-9">
							<div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" value="" class="form-control" name="address2" id="address2"/>
							    
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
					    </div>
					    <div class="propertyContent">
					       <h5><strong>2.Update Information Please enter/update your information</strong></h5>
						 
						  <div class="form-group"><label for="website_address" class="col-sm-3 control-label">Website Address</label>
		     
						     <div class="col-sm-9">
							    <div class="input-group">
							       <span class="input-group-addon">
							       <i class="fa fa-magnet"></i>
							       </span>
							       <input type="text" placeholder="Website Address" class="form-control" name="website_address" id="website_address" value=""/>
							   </div>
						    </div>
						  </div>
						  <div class="form-group"><label for="email_address_booking" class="col-sm-3 control-label">Booking Email<span class='require'>*</span></label>
		     
					  <div class="col-sm-9"><?php echo form_error('email_address_booking');?>
					      <div class="input-group">
						<span class="input-group-addon">
						<i class="fa fa-envelope-o"></i>
						</span>
						<input type="text" placeholder="Booking Email" class="form-control requiredInput" name="email_address_booking" id="email_address_booking" value=""/><i class="alert alert-hide">Oops, Booking email is required</i>
					       </div>
					       </div>
					   </div>
					    <div class="form-group"><label for="licensee_email" class="col-sm-3 control-label">Main Manager Email Address</label>
		     
					       <div class="col-sm-9">
						   <div class="input-group">
						     <span class="input-group-addon">
						   <i class="fa fa-file-text"></i>
						     </span>
						     <input type="email" name="licensee_email" id="licensee_email" class="form-control" value="">
						     
						 </div>
					      </div>
					       </div>
					       <div class="form-group"><label for="main_manager_email" class="col-sm-3 control-label">Contact Email</label>
		     
						   <div class="col-sm-9">
						       <div class="input-group">
							 <span class="input-group-addon">
						       <i class="fa fa-envelope-o"></i>
							 </span>
							 <input type="text" placeholder="" class="form-control" name="main_manager_email" id="main_manager_email"  value="<?php
							 if(isset($property_details['property_details']['licensee_email'])){
							 echo stripslashes($property_details['property_details']['main_manager_email']); }?>"/>
						     </div>
						       </div>
						  </div>
						  <div class="form-group"><label for="phone_no" class="col-sm-3 control-label">Phone No<span class='require'>*</span></label>
						   <div class="col-sm-9">
						      <div class="input-group">
							   <span class="input-group-addon">
							 <i class="fa fa-phone"></i>
							   </span>
							    <input type="text" placeholder="Phone Number" class="form-control requiredInput" name="phone_no" id="phone_no"  value=""/><i class="alert alert-hide">Oops, Phone no is required</i>
						       </div>
						     </div>
						 </div>
								       
						 <div class="form-group"><label for="fax_no" class="col-sm-3 control-label">Fax No</label>
						  <div class="col-sm-9">
						      <div class="input-group">
						      <span class="input-group-addon">
						    <i class="fa fa-phone-square"></i>
						      </span>
						       <input type="text" placeholder="enter fax no" class="form-control" name="fax_no" id="fax_no" value=""/>
						  </div>
						    </div>
						 </div>
						 <div class="form-group"><label for="zip_code" class="col-sm-3 control-label">State/Post Code</label>
		     
						     <div class="col-sm-9">
							 <div class="input-group">
							    <span class="input-group-addon">
							  <i class="fa fa-thumb-tack"></i>
							    </span>
							    <input type="text" value="" placeholder="" class="form-control" name="zip_code" id="zip_code"/>
							</div>
							  </div>
						 </div>
						 <div class="form-group"><label for="mobile_url" class="col-sm-3 control-label">Mobile Url</label>
		     
						     <div class="col-sm-9">
							 <div class="input-group">
							  <span class="input-group-addon">
							<i class="fa fa-phone-square"></i>
							  </span>
							   <input type="text" placeholder="Mobile Url" value="" class="form-control" name="mobile_url" id="mobile_url"/>
						      </div>
							</div>
						 </div>
						 </div>
						 <div class="propertyContent">
					       <h5><strong>3. If any problems your buddy can help you</strong></h5>
					       Samantha Pearse-Marmont - <span class="smEmail">Samantha.Pearse-Marmont@hostelworld.com</span>
					      </div>
					 <div class="propertyContent">
			 <h5><strong>4. Save your information</strong></h5>
				      <div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous disabled"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
					    <button type="submit" name="save_now"  value="Save Now" class="btn btn-info addPropBtn"><i class="fa fa-save"></i> Save and Next</button>
                                        </div>
					 </div>
					 </div>
                                    </div>
				    
				    </form>