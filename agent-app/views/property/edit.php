 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
  <?=$property_header?>
 <h3 class="page-title"> Property Edit</h3>
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
                             <?php if($errmsg){  ?>
          
                                        <div align="center">
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>                <div>



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
                  <!-- Static Content ******************************************************saheb mondal*************************************-->
                        <h3>Edit Property</h3>
                        To edit your property details simply change the fieldsas required and click on the update button
			
			<div class="propertyContent">
			 
                        <h5><strong>1.Property Information</strong></h5>
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
			
					      <div class="form-group">
				 <label for="province_id" class="col-sm-3 control-label">Property Type<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				   <span class="input-group-addon">
				       <i class="fa fa-home"></i>
				   </span>
				   
				   <select name="property_type" class="form-control requiredInput" id="property_type" data-city="<?php echo $property_details['property_details']['city_id']; ?>">
				       <option value="">Select property type</option>
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

			
			
			
			
		      <div class="form-group">
				 <label for="province_id" class="col-sm-3 control-label">Province<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				   <span class="input-group-addon">
				       <i class="fa fa-home"></i>
				   </span>
				   
				   <select name="province_id" class="form-control requiredInput" id="province_id" data-city="<?php echo $property_details['property_details']['city_id']; ?>">
				       <option value="">Select Any province</option>
					   <?php if(is_array($provinces) and count($provinces)>0){ ?>
					   <?php foreach($provinces as $index=>$province){ ?>
					   <option <?php if($property_details['property_details']['province_id']==$province['province_id']) echo  'selected="selected"'; ?> value="<?php  echo $province['province_id']; ?>"><?php  echo stripslashes($province['province_name']); ?></option>
					   <?php } ?>
					   <?php } ?>
				   </select>
				   <i class="alert alert-hide">Oops, province is required</i>
			       </div>
			   </div>
		       </div>
				
									

				
				
		      <div class="form-group">
				 <label for="province_id" class="col-sm-3 control-label">Guest<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				   <span class="input-group-addon">
				       <i class="fa fa-home"></i>
				   </span>
				   
				   <select name="guest" class="form-control requiredInput" id="guest">
				       <option value="">Select Guest</option>
					   <?php for($i= 0 ;$i<=15; $i++){ ?>
					   <option <?php if((isset($property_details['property_master']['guest'])) &&  ($property_details['property_master']['guest']==$i)) echo  'selected="selected"'; ?> value="<?php  echo $i; ?>"><?php  echo $i; ?></option>
					   <?php } ?>
				   </select>
				   <i class="alert alert-hide">Oops, guest is required</i>
			       </div>
			   </div>
		       </div>
		      
				
										     <div class="form-group">
							<label for="address" class="col-sm-3 control-label">Bed Rooms<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       <i class="fa fa-home"></i>
							   </span>
							   <input type="text" placeholder="" value="<?php echo $property_details['property_master']['bedrooms']?>" class="form-control requiredInput" name="bedrooms" id="bedrooms"/><i class="alert alert-hide">Oops, Bed Room is required</i>
						       </div>
							   
						   </div>
					       </div>

							 
							 					     <div class="form-group">
							<label for="address" class="col-sm-3 control-label">Beds<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       <i class="fa fa-home"></i>
							   </span>
							   <input type="text" placeholder="" value="<?php echo $property_details['property_master']['beds']?>" class="form-control requiredInput" name="beds" id="beds"/><i class="alert alert-hide">Oops, beds is required</i>
						       </div>
							   
						   </div>
					       </div>

				
				
				
		      <div class="form-group"><label for="address" class="col-sm-3 control-label">Address<span class='require'>*</span> </label>
			    <div class="col-sm-9">
				<div class="input-group">
				    <span class="input-group-addon">
					<i class="fa fa-home"></i>
				    </span>
				    <input type="text" placeholder="" value="<?php if(isset($property_details['property_details']['address']))
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
				     ?>"
				     class="form-control" name="address2" id="address2"/>
				     
				 </div>
			     </div>
			 </div>
			<div class="form-group">
			 <label for="city_id" class="col-sm-3 control-label">City<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				   <span class="input-group-addon">
				       <i class="fa fa-flag"></i>
				   </span>
				   <select name="city_id" id="proCityDropDown" class="form-control requiredInput">
				       <option value="">Select any city</option>
						 <?php if(is_array($cities) and count($cities)>0){ ?>
					   <?php foreach($cities as $index=>$city){ ?>
					   <option <?php if($property_details['property_details']['city_id']==$city['city_master_id']) echo  'selected="selected"'; ?> value="<?php  echo $city['city_master_id']; ?>"><?php  echo stripslashes($city['city_name']); ?></option>
					   <?php } ?>
					   <?php } ?>
						 
				   </select>
				   <i class="alert alert-hide">Oops, address is required</i>
			       </div>
			   </div>
		       </div>
			
			
							<div class="form-group">
							  <label for="city_id" class="col-sm-3 control-label">Support Group Booking ? </label>
							  <div class="col-sm-9">
								<input type="checkbox" name="allow_group" id="" class="form-control allow_group_booking" value="yes" <?php echo ($property_details['property_master']['group_booking_support'] == 'yes') ? 'checked' : '' ;?>/>
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

			<!--<div class="form-group">
			 <label for="city_id" class="col-sm-3 control-label">Group Type<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				  
				   <?php $group_type_arr = explode(',',$property_details['property_master']['groupType']);
					if(count($group_list)>0){ ?>
							    <?php foreach($group_list as $group){ ?>
							    
							    <input type="checkbox" name="group_type[]" class="form-control requiredInput" value="<?php echo $group['id'] ?>" <?php echo (in_array($group['id'],$group_type_arr))? 'checked="checked"':'' ;?> /> &nbsp;<?php echo $group['typeName'] ?><br/>
							    <?php } } ?>
						 
				   
				   <i class="alert alert-hide">Oops, group type is required</i>
			       </div>
			   </div>
		       </div>

		       <div class="form-group">
			 <label for="city_id" class="col-sm-3 control-label">Age Group<span class='require'>*</span> </label>
			   <div class="col-sm-9">
			       <div class="input-group">
				  
				   <?php $age_group_arr = explode(',',$property_details['property_master']['ageGroup']);
					if(count($age_group)>0){ ?>
							    <?php foreach($age_group as $group){ ?>
							    
							    <input type="checkbox" name="age_group[]" class="form-control requiredInput" value="<?php echo $group['id'] ?>" <?php echo (in_array($group['id'],$age_group_arr))? 'checked="checked"':'' ;?> /> &nbsp;<?php echo $group['ageGroup'] ?>
							    <?php } } ?>
						 
				   
				   <i class="alert alert-hide">Oops, age group is required</i>
			       </div>
			   </div>
		       </div>-->
		       <!-- <p> <strong><?php echo stripslashes($property_details['property_master']['property_name']);?></strong></p>
                        <?php echo stripslashes($property_details['province_name']);?></br>
			<?php echo stripslashes($property_details['property_details']['address']);?></br>
			<?php echo stripslashes($property_details['property_details']['zip_code']);?></br>
			<?php echo stripslashes($property_details['city_name']);?></br>
			<p>Australia</p>-->
                        </div>
		   <div class="propertyContent">
                          <h5><strong>2.Update Information Please enter/update your information</strong></h5>
			  <input type="hidden" name="action" value="basic_info"/>
			    
			     <div class="form-group"><label for="website_address" class="col-sm-3 control-label">Website Address</label>

				<div class="col-sm-9">
				       <div class="input-group">
					  <span class="input-group-addon">
					  <i class="fa fa-magnet"></i>
					  </span>
					  <input type="text" placeholder="Website Address" class="form-control" name="website_address" id="website_address" value="<?php echo stripcslashes($property_details['property_master']['website_address']);?>"/>
				      </div>
			       </div>
			     </div>
                             <div class="form-group"><label for="email_address_booking" class="col-sm-3 control-label">Booking Email<span class='require'>*</span></label>

		     <div class="col-sm-9"><?php echo form_error('email_address_booking');?>
			 <div class="input-group">
			   <span class="input-group-addon">
			   <i class="fa fa-envelope-o"></i>
			   </span>
			   <input type="text" placeholder="Booking Email" class="form-control requiredInput" name="email_address_booking" id="email_address_booking" value="<?php echo stripcslashes($property_details['property_details']['email_address_booking']);?>"/><i class="alert alert-hide">Oops, Booking email is required</i>
			  </div>
			  </div>
                      </div>
                       <div class="form-group"><label for="licensee_email" class="col-sm-3 control-label">Main Manager Email Address</label>

                          <div class="col-sm-9">
                              <div class="input-group">
				<span class="input-group-addon">
			      <i class="fa fa-file-text"></i>
				</span>
				<input type="email" name="licensee_email" id="licensee_email" class="form-control" value="<?php
				if(isset($property_details['property_details']['licensee_email'])){
				echo stripslashes($property_details['property_details']['licensee_email']); }?>">
				
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
				       <input type="text" placeholder="Phone Number" class="form-control requiredInput" name="phone_no" id="phone_no"  value="<?php
				      if(isset($property_details['property_master']['phone_no'])){
				      echo stripslashes($property_details['property_master']['phone_no']); }?>"/><i class="alert alert-hide">Oops, Phone no is required</i>
				  </div>
				</div>
                            </div>
                                                  
			    <div class="form-group"><label for="fax_no" class="col-sm-3 control-label">Fax No</label>
			     <div class="col-sm-9">
				 <div class="input-group">
				 <span class="input-group-addon">
			       <i class="fa fa-phone-square"></i>
				 </span>
				  <input type="text" placeholder="enter fax no" class="form-control" name="fax_no" id="fax_no" value="<?php
				 if(isset($property_details['property_master']['fax_no'])){
				 echo stripslashes($property_details['property_master']['fax_no']); }?>"/>
			     </div>
			       </div>
			    </div>
			    <div class="form-group"><label for="zip_code" class="col-sm-3 control-label">State/Post Code</label>

				<div class="col-sm-9">
				    <div class="input-group">
				       <span class="input-group-addon">
				     <i class="fa fa-thumb-tack"></i>
				       </span>
				       <input type="text" value="<?php if(isset($property_details['property_details']['zip_code']))
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
			    <div class="form-group"><label for="mobile_url" class="col-sm-3 control-label">Mobile Url</label>

				<div class="col-sm-9">
				    <div class="input-group">
				     <span class="input-group-addon">
				   <i class="fa fa-phone-square"></i>
				     </span>
				      <input type="text" placeholder="Mobile Url" value="<?php echo stripslashes($property_details['property_master']['mobile_url']); ?>" class="form-control" name="mobile_url" id="mobile_url"/>
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
				      <a href="<?php echo base_url().'property/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
				      
				      <button type="submit" name="save_now" value="Save Now" class="btn btn-info"><i class="fa fa-save"></i> Save and Next</button>
				      
				      <!--<button type="button" name="next" value="Next" class="btn btn-info button-next mlm" id="nextAddProperty">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>-->
			   </div>
			 </div>
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
	  if($("input[type='checkbox'][name='room_type[]']:checked").length == 0){
		  $('#room_type_msg').show();
		  return false;
	  }
	else
	{
	    $('#room_type_msg').hide();
	}
   });
   
   
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
