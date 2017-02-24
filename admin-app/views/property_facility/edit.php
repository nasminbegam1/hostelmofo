 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Facility</div>
    </div>
   <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
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
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-pink">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Facility Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="amenity_name" class="col-md-3 control-label">Facility Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control required" name="amenity_name" id="amenity_name" value="<?php echo stripslashes($arr_facility['amenities_name']); ?>" data-required="true">
                                                                
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-group"><label for="backend_amenities_name" class="col-md-3 control-label">Backend Amenity Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input type="text" class="form-control required" name="backend_amenities_name" id="backend_amenities_name" value="" data-required="true">
                                    
                                                            </div>
                                                        </div>-->
<!--                                                        <div class="form-group"><label for="amenity_type" class="col-md-3 control-label">Amenity Type <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon"><i class=""></i>
                                                                   <select name="amenity_type" id="amenity_type" class="form-control required" style="width:auto;" data-required="true">
					<option value="Both"> Both </option>
					<option value="Rental">Rental</option>
					<option value="Sales">Sales</option>					
				    </select>	
                                                                </div>
                                                            </div>
                                                        </div>-->
							<div class="form-group"><label for="featured_category" class="col-md-3 control-label">Featured Category <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                 <?php if(is_array($arr_featured_populate)) { ?>
				<select name="featured_category" id="featured_category" class="form-control required"  data-required="true">
				    <option value=""> Please Select </option>
				    <?php foreach($arr_featured_populate as $key){?>
				    <option <?php echo ($arr_facility['category_id']==$key['featured_category_id'])? 'selected="selected"':''; ?> value="<?php echo $key['featured_category_id'];?>"><?php echo $key['featured_category_name'];?></option>
				    <?php } ?>
				</select>
				<?php } ?>
                                                            </div>
                                                        </div>				
				
				<div class="form-group"><label for="featured_category" class="col-md-3 control-label"></label>
				    <div class="col-md-4 facilityBg">
				    <?php if(isset($arr_facility['amenities_image']) && $arr_facility['amenities_image']!= ''){?>
					<img src="<?php echo IMAGE_UPLOAD_URL.'facility/'.$arr_facility['amenities_image'];?>" height="150" width="150"/>					   <?php }?>
				    </div>
				</div>
				<input type="hidden" name="prev_amenities_image" value="<?php echo $arr_facility['amenities_image'];?>"/>
				<div class="form-group"><label for="featured_category" class="col-md-3 control-label">Image<span class='require'>*</span></label>
				    <div class="col-md-4">
					<input type="file" name="amenities_image" id="amenities_image" data-required="true" class="form-control required"/>
				    </div>
				</div>
                                                        <!--<div class="form-group"><label for="amenities_tooltip" class="col-md-3 control-label">Facility Tooltip</label>

                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="amenities_tooltip" id="amenities_tooltip" value="">
                                                            </div>
                                                        </div>-->
                                                        <!--<div class="form-group"><label for="amenities_filter" class="col-md-3 control-label">In Filter</label>

                                                            <div class="col-md-4">
                                                              <select name="amenities_filter" id="amenities_filter" class="form-control" style="width:auto;">
				    <option value="0"> No </option>
				    <option value="1"> Yes </option>
				</select>
                                                            </div>
                                                        </div>-->
							
<!--							<div class="form-group"><label for="amenities_selected_control" class="col-md-3 control-label">Select control type</label>

                                                            <div class="col-md-4">
                                                             <select name="amenities_selected_control" id="amenities_selected_control" class="form-control" style="width:auto;">
				    <option value="checkbox"> Tickbox </option>
				    <option value="inputbox"> Opentextbox </option>
				    
				</select>	
                                                            </div>
                                                        </div>-->                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
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