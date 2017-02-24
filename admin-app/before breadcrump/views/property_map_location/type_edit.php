 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Property Map Location</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Property Map Location</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="<?php echo $edit_link;?>" >Edit Property Map Location</a></li>
        
    </ol>
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
                                        
                                        
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Edit Form</div>-->
					    <div class="portlet-header">
                                                    <div class="caption">Edit Property Map Location</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pa">
                                              
						
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated" enctype="multipart/form-data" id="edit_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="location_name" class="col-md-3 control-label">Place Name<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control required" name="location_name" id="location_name" value="<?php echo stripslashes($property_map_details['location_name']);?>" data-required="true">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="AmenityName" class="col-md-3 control-label">Latitude<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input type="text" class="form-control required" name="latitude" id="latitude" value="<?php echo stripslashes($property_map_details['latitude']);?>" data-required="true">
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="AmenityType" class="col-md-3 control-label">Longitude<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               
								    <input type="text" class="form-control required" name="longitude" id="longitude" value="<?php echo stripslashes($property_map_details['longitude']);?>" data-required="true">
                                                                
                                                                
                                                            </div>
                                                        </div>
                                            
							<div class="form-group"><label for="location_type" class="col-md-3 control-label">Place Type</label>

                                                            <div class="col-md-4">
                                                               
								    <select id="location_type" name="location_type" class="form-control">
				    <option value="attraction" <?php if($property_map_details['location_type'] == 'attraction')echo "selected";?>>Attraction</option>
				    <option value="location" <?php if($property_map_details['location_type'] == 'location')echo "selected";?>>Location</option>
				    <option value="beach" <?php if($property_map_details['location_type'] == 'beach')echo "selected";?>>Beach</option>
				    <option value="shopping" <?php if($property_map_details['location_type'] == 'shopping')echo "selected";?>>Shopping</option>
				    <option value="Important_serveices" <?php if($property_map_details['location_type'] == 'important_serveices')echo "selected";?>>Important Services</option>
								    </select>
                                                                
                                                                
                                                            </div>
                                                        </div>
							
							<div class="form-group"  id="location_id_div" <?php if($property_map_details['location_type'] != 'beach'){ echo "style=' display: none;'";}?>>
							<label for="location_id" class="col-md-3 control-label">Location Name<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               
								    <select id="location_id" name="location_id" class="form-control">
				    <option value="0" >Select Location For Beach</option>
				    <?php
				    if(isset($location_list) && is_array($location_list)){
					foreach($location_list as $v){ ?>
				    <option value="<?php echo $v['location_id'];?>"  <?php if($property_map_details['location_id'] == $v['location_id'])echo "selected";?>><?php echo $v['location_name'];?></option>
				    <?php } }?>
				</select>
                                                                
                                                                
                                                            </div>
                                                        </div>
						    
						    <div class="form-group"><label for="status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-4">
                                                               
								    <select id="status" name="status">
									<option value="Active" <?php if($property_map_details['status'] == 'Active')echo "selected";?>>Active</option>
									<option value="Inactive" <?php if($property_map_details['status'] == 'Inactive')echo "selected";?>>Inactive</option>
								    </select>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->