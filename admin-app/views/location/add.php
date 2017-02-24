 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New Location</div>
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
                                                    <div class="caption">Add New Location</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
  
                                                        
                                                        <div class="form-group"><label for="property_type_name" class="col-md-3 control-label">Location Name<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="property_type_name" type="text" placeholder="" class="form-control required" id="property_type_name" value="<?php echo set_value('property_type_name'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="location_type_name" class="col-md-3 control-label">Location Type<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                 <select name="location_status" class="form-control">
                                                                    <option value="Adventure">Adventure</option>
                                                                    <option value="Beach">Beach</option>
								    <option value="City">City</option>
								    <option value="Most Reviewed">Most Reviewed</option>
								    <option value="Top Rated">Top Rated</option>
								    <option value="Popular">Popular</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="location_description" class="col-md-3 control-label">Location Description<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                 <textarea name="location_description" id="location_description" class="form-control"></textarea>
                                                                
                                                            </div>
                                                        </div>
                                                      
                                                        
                                                       
                                                        <div class="form-group"><label for="property_type_status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-9">
                                                                <select name="property_type_status" class="form-control">
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Location</button>
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