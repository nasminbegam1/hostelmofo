 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Review</div>
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
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add New Reviews</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
  
                                                    <div class="col-md-6">
                                                                <div class="form-group"><label for="property_id" class="col-md-3 control-label">Property Name<span class='require'>*</span></label>

                                                                    <div class="col-md-9"><select name="property_id" id="property_id" class="form-control required">
								    <option value="">--Select--</option>
								    <?php
								    if(is_array($property_list) &&  count($property_list))
								    {
									foreach($property_list as $list)
									{
									    
									
								    ?>
								    
								    <option value="<?php echo $list['property_master_id'];?>"><?php echo stripslashes($list['property_name']); ?></option>
								    <?php
									}
								    }
								    ?>
								    
								</select></div>
                                                                </div>
                                                            </div>    
							
						<div class="col-md-6">	
						<div class="form-group"><label for="value_for_money" class="col-md-3 control-label">Value For Money</label>

                                                            <div class="col-md-9">
                                                                <input name="value_for_money" type="number" placeholder="" class="form-control " id="value_for_money" value="<?php echo set_value('value_for_money'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>
						<div class="col-md-6">
						<div class="form-group"><label for="staff" class="col-md-3 control-label">Staff</label>

                                                            <div class="col-md-9">
                                                                <input name="staff" type="number" placeholder="" class="form-control " id="staff" value="<?php echo set_value('staff'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>
						<div class="col-md-6">
						<div class="form-group"><label for="facilities" class="col-md-3 control-label">Facilities</label>

                                                            <div class="col-md-9">
                                                                <input name="facilities" type="number" placeholder="" class="form-control" id="facilities" value="<?php echo set_value('facilities'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>

						<div class="col-md-6">	
						<div class="form-group"><label for="security" class="col-md-3 control-label">Security</label>

                                                            <div class="col-md-9">
                                                                <input name="security" type="number" placeholder="" class="form-control " id="security" value="<?php echo set_value('security'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>

						<div class="col-md-6">
						<div class="form-group"><label for="location" class="col-md-3 control-label">Location</label>

                                                            <div class="col-md-9">
                                                                <input name="location" type="number" placeholder="" class="form-control " id="location" value="<?php echo set_value('location'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>

						<div class="col-md-6">
						<div class="form-group"><label for="atmosphere" class="col-md-3 control-label">Atmosphere</label>

                                                            <div class="col-md-9">
                                                                <input name="atmosphere" type="number" placeholder="" class="form-control " id="atmosphere" value="<?php echo set_value('atmosphere'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
						</div>

						<div class="col-md-6">
						
					<div class="form-group"><label for="cleanliness" class="col-md-3 control-label">Cleanliness</label>

                                                            <div class="col-md-9">
                                                                <input name="cleanliness" type="number" placeholder="" class="form-control" id="cleanliness" value="<?php echo set_value('cleanliness'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>

						<div class="col-md-6">
					<div class="form-group"><label for="name" class="col-md-3 control-label">Name</label>

                                                            <div class="col-md-9">
                                                                <input name="name" type="text" placeholder="" class="form-control" id="name" value="<?php echo set_value('name'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>

						<div class="col-md-6">
					<div class="form-group"><label for="country" class="col-md-3 control-label">Country</label>

                                                            <div class="col-md-9">
                                                                <input name="country" type="text" placeholder="" class="form-control " id="country" value="<?php echo set_value('country'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>

						<div class="col-md-6">
					<div class="form-group"><label for="city" class="col-md-3 control-label">City</label>

                                                            <div class="col-md-9">
                                                                <input name="city" type="text" placeholder="" class="form-control " id="city" value="<?php echo set_value('city'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>

						<div class="col-md-6">
					<div class="form-group"><label for="gender" class="col-md-3 control-label">Gender</label>

                                                            <div class="col-md-9">
                                                                <input name="gender" type="text" placeholder="" class="form-control " id="gender" value="<?php echo set_value('gender'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>

						<div class="col-md-6">
					<div class="form-group"><label for="age_group" class="col-md-3 control-label">Age Group</label>

                                                            <div class="col-md-9">
                                                                <input name="age_group" type="text" placeholder="" class="form-control" id="age_group" value="<?php echo set_value('age_group'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
					</div>
						<div class="col-md-6">

                                                        <div class="form-group"><label for="review_status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-9">
                                                                <select name="review_status" class="form-control">
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
						</div>
						
	    
						<div class="col-md-6">
					<div class="form-group"><label for="review_text" class="col-md-3 control-label">Comment</label>

                                                            <div class="col-md-9">
                                                               
                                                            <textarea name="review_text" class="form-control " id="review_text"><?php echo set_value('review_text'); ?></textarea>    
                                                            </div>
                                                        </div>
						
	
						</div>

						
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Property Type</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
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