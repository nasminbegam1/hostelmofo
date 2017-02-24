
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
									     <form action="<?php echo BACKEND_URL.'property/editAction' ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
									     <input type="hidden" name="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
							    <li>
								<a href="#tab1-wizard-custom-circle" data-toggle="tab"><i class="fa fa-home"></i>
	    
								<p class="anchor">Details</p>
	    
								<p class="description">Set up basic details</p></a></li>
							    <li>
								<a href="#tab2-wizard-custom-circle" data-toggle="tab"><i class="fa fa-flag-checkered"></i>
	    
								<p class="anchor">Conatct</p>
	    
								<p class="description">Set up contact details</p></a></li>
							    <li>
								<a href="#tab3-wizard-custom-circle" data-toggle="tab"><i class="fa fa-info-circle"></i>
	    
								<p class="anchor">Basic Info</p>
	    
								<p class="description">Set up Basic Info</p></a></li>
							    <li>
								<a href="#tab4-wizard-custom-circle" data-toggle="tab"><i class="fa fa-puzzle-piece"></i>
	    
								<p class="anchor">Facilities & Policies</p>
	    
								<p class="description">Set up various Facilities</p></a></li>
							    <li>
								<a href="#tab5-wizard-custom-circle" data-toggle="tab"><i class="fa fa-picture-o"></i>
	    
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

                                        </div>
					<div id="tab2-wizard-custom-circle" class="tab-pane"><!--<h3 class="mbxl">Set up Contact details</h3>-->

                                                <div class="form-group"><label for="address" class="col-sm-3 control-label">Address<span class='require'>*</span> </label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_details']['address']); ?>" class="form-control requiredInput" name="address" id="address"/><i class="alert alert-hide">Oops, address is required</i>
							</div>
							    
						    </div>
                                                </div>
                                                <div class="form-group"><label for="address2" class="col-sm-3 control-label">Address 2</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_details']['address2']); ?>" class="form-control" name="address2" id="address2"/>
							</div>
						    </div>
                                                </div>
                                                <div class="form-group"><label for="province_id" class="col-sm-3 control-label">Province</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <select name="province_id" class="form-control" id="province_id">
								<option value="">Select Any province</option>
								    <?php if(is_array($province_type) and count($province_type)>0){ ?>
								    <?php foreach($province_type as $index=>$data){ ?>
								    <option <?php echo ($property_details['property_details']['province_id']==$data['province_id'])? 'selected="selected"':''; ?> value="<?php  echo $data['province_id']; ?>"><?php  echo stripslashes($data['province_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="zip_code" class="col-sm-3 control-label">Zip Code</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumb-tack"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_details']['zip_code']); ?>" placeholder="" class="form-control" name="zip_code" id="zip_code"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="city_id" class="col-sm-3 control-label">City</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-flag"></i>
							    </span>
							    <select name="city_id" id="proCityDropDown" class="form-control">
								
							    </select>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="contact_name" class="col-sm-3 control-label">Contact Name<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-user"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_details']['contact_name']); ?>" placeholder="" class="form-control requiredInput" name="contact_name" id="contact_name"/><i class="alert alert-hide">Oops, contact name is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="main_manager_email" class="col-sm-3 control-label">Contact Email</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" value="<?php echo stripslashes($property_details['property_details']['main_manager_email']); ?>" placeholder="" class="form-control" name="main_manager_email" id="main_manager_email"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="email_address_booking" class="col-sm-3 control-label">Booking Email<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_details']['email_address_booking']); ?>" class="form-control requiredInput" name="email_address_booking" id="email_address_booking"/><i class="alert alert-hide">Oops, Booking email is required</i>
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
						<div class="form-group"><label for="phone_no" class="col-sm-3 control-label">Phone No<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-phone"></i>
							    </span>
							     <input type="text" placeholder="" value="<?php echo stripslashes($property_details['property_master']['phone_no']); ?>" class="form-control requiredInput" name="phone_no" id="phone_no"/><i class="alert alert-hide">Oops, Phone no is required</i>
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

                                        <div id="tab3-wizard-custom-circle" class="tab-pane fadeIn"><!--<h3 class="mbxl">Set up Basic Info</h3>-->
					    						
					    <div class="form-group"><label for="brief_introduction" class="col-sm-3 control-label">brief introduction</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-edit"></i>
							    </span>
							    <textarea class="form-control" name="brief_introduction" id="brief_introduction"><?php echo stripslashes($property_details['property_details']['brief_introduction']); ?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="description" class="col-sm-3 control-label">Description</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-edit"></i>
							    </span>
							    <textarea class="form-control" name="description" id="description"><?php echo stripslashes($property_details['property_details']['description']); ?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="location" class="col-sm-3 control-label">Location</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <textarea class="form-control" name="location" id="location"><?php echo stripslashes($property_details['property_details']['location']); ?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="direction" class="col-sm-3 control-label">Direction</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <textarea class="form-control" name="direction" id="direction"><?php echo stripslashes($property_details['property_details']['direction']); ?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="things_to_note" class="col-sm-3 control-label">Note Policies</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea class="form-control" name="things_to_note" id="things_to_note"><?php echo stripslashes($property_details['property_details']['things_to_note']); ?></textarea>
							</div>
						    </div>
                                                </div>

						<div class="form-group"><label for="things_to_note" class="col-sm-3 control-label">Cancellation Policies</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea class="form-control" name="cancellation_policy" id="cancellation_policy"><?php echo stripslashes($property_details['property_details']['cancellation_policy']); ?></textarea>
							</div>
						    </div>
                                                </div>
		    
                                        </div>
                                        <div id="tab4-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Facilities</h3>
					    	<div class="form-group">
                                                    <div class="col-sm-10">
							<?php if(is_array($facilities_list) and count($facilities_list)>0){ ?>
							<?php foreach($facilities_list as $index=>$data){ ?>
							    <div class="col-sm-3">
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
							    <div class="col-sm-3">
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
								<div class="input-group bootstrap-timepicker">
								    <input type="text" class="timepicker-default form-control" name="earliest_check_in" id="earliest_check_in" value="<?php echo date("h:i A", strtotime(date('Y-m-d').$property_details['property_master']['earliest_check_in'])) ?>"/>
									<span class="input-group-addon"><i class="fa fa-clock-o"></i>
								    </span>
								</div>
							    </div>
							</div>
							<div class="col-sm-6">
							<label for="latest_check_in" class="col-sm-3 control-label">Check out</label>

							<div class="col-md-9">
							    <div class="input-group bootstrap-timepicker">
								<input type="text" class="timepicker-default form-control" name="latest_check_in" id="latest_check_in" value="<?php echo date("h:i A", strtotime(date('Y-m-d').$property_details['property_master']['latest_check_in'])) ?>"/>
								    <span class="input-group-addon"><i class="fa fa-clock-o"></i>
								</span>
							    </div>
							</div>
						    </div>

						    </div>
                                                </div>

						

					   
					</div>
                                        <div id="tab5-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Set up Video</h3>
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-2 control-label">Video Url</label>

						    <div class="col-md-10">
							<div class="input-group">
							    
							    <span class="input-group-addon"><i class="fa fa-magnet"></i></span>
							    <input type="text" class="form-control" name="property_video_link" id="property_video_link" value="<?php echo stripslashes($property_details['property_master']['property_video_link']) ?>"/>
							</div>
						    </div>
						    </div>
						</div>

						
					    <h3 class="mbxl">Set up Photo</h3>
					     <div class="row fileupload-buttonbar">
						<div class="col-lg-2 addButtonBer"><!--The fileinput-button span is used to style the file input field as button--><span class="btn btn-success fileinput-button addPropertyPhoto"><i class="glyphicon glyphicon-plus"></i>&nbsp;<span>Add files...</span></span>&nbsp; &nbsp;
						<input type="file" name="propertyfiles[]" multiple="multiple" class="propertyfiles" onchange="javascript:attachImages(this)" style="display: none;"/>
						</div>
						<div class="col-lg-1 text-right">
						<img class="loader" id="uploadLoader" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" style="display: none;" />
						</div>
						<!--The global progress state-->
						<div class="col-lg-5 fileupload-progress fade"><!--The global progress bar-->
						    <div role="progressbar" aria-valuemin="0" aria-valuemax="100" class="progress progress-striped active">
							<div style="width: 0%;" class="progress-bar progress-bar-success"></div>
						    </div>
						    <!--The extended global progress state-->
						    <div class="progress-extended"> </div>
						</div>
					    </div>
					    <!--The table listing the files available for upload/download-->
					    <table role="presentation" class="table table-striped">
						<tbody class="files prePropertyImages">
						    <?php if(is_array($property_details['property_images']) and count($property_details['property_images'])>0){ foreach($property_details['property_images'] as $img){ ?>
						   <tr class="imageinfo">
							<td>
							    
							    <img width="80" height="70" src="<?php echo FILE_UPLOAD_URL.'property/small/'.$img['image_name']; ?>"/>
							   
							</td>
							<td><?php echo $img['image_name']; ?></td>
							<td><button data-img="<?php echo $img['image_name']; ?>" onclick="javascript:return delPreImage('pre',this)" class="btn btn-danger delPreviewImg"  ><i class="glyphicon glyphicon-trash"></i></button></td>
						   </tr>
						    <?php } } ?>
						</tbody>
						<tbody class="files preiviewPropertyImages"></tbody>
					    </table>
					</div>
				       
				        
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="button" name="next" value="Next" class="btn btn-info button-next mlm" id="nextAddProperty">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
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
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
