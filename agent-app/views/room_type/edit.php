<?php $breadcrumbs = $brdLink?>
        <div class="page-content">
	    <h3>Edit Room Type</h3>
	<?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
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
                                                    <div class="caption">Edit Property Type</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="roomtype_name" class="col-md-3 control-label">Property Type Name<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="roomtype_name" type="text" placeholder="" class="form-control required" id="roomtype_name" value="<?php echo $arr_room_type['roomtype_name'];?>"/>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="roomtype_name" class="col-md-3 control-label">Number of Bed<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="number_of_bed" type="text" placeholder="" class="form-control required digits" id="number_of_bed" value="<?php echo $arr_room_type['number_of_bed']; ?>"/>
                                                                
                                                            </div>
                                                        </div>
							
                                                        
                                                        <div class="form-group"><label for="roomtype_status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-9">
                                                                <select name="roomtype_status" class="form-control">
                                                                    <option value="Active" <?php echo ($arr_room_type['roomtype_status']=='Active') ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="Inactive" <?php echo ($arr_room_type['roomtype_status']=='Inactive') ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="roomtype_status" class="col-md-3 control-label">Price Type</label>

                                                            <div class="col-md-9">
                                                                <select name="room_price_type" class="form-control">
                                                                    <option value="per_person" <?php echo ($arr_room_type['room_price_type']=='per_person') ? 'selected' : '' ;?> >Per Person</option>
                                                                    <option value="per_night" <?php echo ($arr_room_type['room_price_type']=='per_night') ? 'selected' : '' ;?> >Per Night</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Room Type </button>
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