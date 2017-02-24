<style type="text/css">
    .rightPan label {
    line-height: 34px;
}
</style>
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Sales Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_sales/index/"?>">Sales Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Sales Property Form</div>
                                <div class="tools">
                                    <!--<i class="fa fa-chevron-up"></i>-->
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <!--<i class="fa fa-times"></i>-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                     <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                     <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="tab-content">
                                        <form action="<?php echo BACKEND_URL;?>property_sales/edit_property/<?php echo $arr_property['property_id'].'/'.$page; ?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                                            <input type="hidden" name="action" value="Process">
                                            <input type="hidden" name="property_id" value="<?php echo  $arr_property['property_id']; ?>">
                                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                                           <!------general section start-->
                                           <div class="text-right">
                                            <a href="<?php echo BACKEND_URL."property_sales/index/"?>" style="text-decoration: none;">
                                            <button type="button" name="back" value="back" class="btn btn-info"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</button>
                                            </a>
                                           </div>
                                           <br />
                                        <?php if(isset($succmsg) && $succmsg != ""){?>
                                            <div align="center">
                                                <div class="nNote nSuccess" style="width: 600px;color:green;">
                                                    <p><?php echo stripslashes($succmsg);?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if(isset($errmsg) && $errmsg != ""){ ?>
                                        <div align="center">
                                          <div class="nNote nFailure">
                                            <p style="font-weight:bold; color:red;"><?php echo stripslashes($errmsg);?></p>
                                          </div>
                                        </div>
                                        <?php } ?>
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                           
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-yellow portlet box portlet-yellow">
                                
                                                <div class="portlet-header">
                                                    <div class="caption">General</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                </div>
                                                    
                                                    <!--<div class="panel-body pan">-->
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                            

                                                               <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_name" class="col-md-4 control-label">Property Name-Official <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="glyphicon glyphicon-home"></i>
                                                                                <input name="property_name" id="property_name" type="text" placeholder="Property Name" autocomplete='off' value="<?php echo stripslashes($arr_property['property_name']);?>" class="form-control required"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="page_title" class="col-md-4 control-label">Display Title <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8 input-icon"><i class="fa fa-file-text-o"></i><input name="page_title" id="page_title" autocomplete='off' type="text" placeholder="Display Title" class="form-control required" value="<?php echo stripslashes($arr_property['page_title']);?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_type" class="col-md-4 control-label">Property Type <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                    <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-building-o"></i>
                                                                                 </span>
                                                                                    
                                                                                <?php if(is_array($arr_property_type)) { ?>
                                                                                <select name="property_type" title="Seletc your type of your property" id="property_type"  class="form-control required" autocomplete='off'>
                                                                                <?php foreach($arr_property_type as $key){?>
                                                                                <option value="<?php echo $key['property_type_id'];?>" <?php if($arr_property['property_type_id'] == $key['property_type_id']){?>selected="selected"<?php } ?>><?php echo $key['property_name'];?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                                <?php } ?>
                                                                                    </div>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_ranking" class="col-md-4 control-label"> Results Ranking  <span class='require'>*</span></label>
                                                                                
                                                                             
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-star"></i>
                                                                                 </span>
                                                                                
                                                                               <select data-required="true" title="Give a rank for this property" name="property_ranking" id="property_ranking" class="form-control required" autocomplete='off'>
                                                                                    <option value="">---Please Select---</option>
                                                                                    <option value="1" <?php if($arr_property['property_ranking'] == '1'){?>selected<?php } ?>>1</option>
                                                                                    <option value="2" <?php if($arr_property['property_ranking'] == '2'){?>selected<?php } ?>>2</option>
                                                                                    <option value="3" <?php if($arr_property['property_ranking'] == '3'){?>selected<?php } ?>>3</option>
                                                                                    <option value="4" <?php if($arr_property['property_ranking'] == '4'){?>selected<?php } ?>>4</option>
                                                                                    <option value="5" <?php if($arr_property['property_ranking'] == '5'){?>selected<?php } ?>>5</option>
                                                                                    <option value="6" <?php if($arr_property['property_ranking'] == '6'){?>selected<?php } ?>>6</option>
                                                                                    <option value="7" <?php if($arr_property['property_ranking'] == '7'){?>selected<?php } ?>>7</option>
                                                                                    <option value="8" <?php if($arr_property['property_ranking'] == '8'){?>selected<?php } ?>>8</option>
                                                                                    <option value="9" <?php if($arr_property['property_ranking'] == '9'){?>selected<?php } ?>>9</option>
                                                                                    <option value="10" <?php if($arr_property['property_ranking'] == '10'){?>selected<?php } ?>>10</option>
                                                                                </select>
                                                                                </div>
                                                                                 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="seo_title" class="col-md-4 control-label">Meta Title<span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <textarea name="seo_title" id="seo_title" rows="3" class="form-control required"><?php echo stripslashes($arr_property['seo_title']);?></textarea>
                                                                                <span id="seo_title_count" class="countText"><?php echo strlen(($arr_property['seo_title'])); ?></span><span>/69</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="meta_description" class="col-md-4 control-label">Meta Description<span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <textarea name="meta_description" id="meta_description"  autocomplete='off' rows="3" class="form-control required"  maxlength="155"><?php echo stripslashes($arr_property['meta_description']);?></textarea>
                                                                                <span id="meta_description_count" class="countText"><?php echo strlen( stripslashes($arr_property['meta_description'])); ?></span><span>/155</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="similar_property_tag" class="col-md-2 control-label" >Similar Property Tag </label>
                                                                        <div class="col-md-10 input-icon"><i class="fa fa-tag"></i>
                                                                            <input id="similar_property_tag" name="similar_property_tag" type="text" placeholder="" autocomplete='off' class="form-control" value="<?php echo stripslashes($arr_property['similar_property_tag']);?>"/></div>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                           
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>


                                        
                                        <!------general section end-->
                                        
                                        <!------description section start-->
                                        
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-yellow portlet box portlet-violet">
                                                    
                                                    <div class="portlet-header">
                                                    <div class="caption">Description</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                                
                                                                 <?php
                                                                $is_studio = 'No';
                                                                if($arr_property['is_studio'] == 'Yes')
                                                                {
                                                                $is_studio = 'Yes';
                                                                }
                                                                ?>
                                                                
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="indoor_size" class="col-md-2 control-label" >Studio </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline"><input type="radio" value="Yes" id="is_studio" name="is_studio" <?php if($is_studio == 'Yes') { ?> checked <?php } ?> autocomplete='off'/>&nbsp;
                                                                                    Yes</label><label class="radio-inline"><input type="radio" value="No" id="is_studio" name="is_studio" <?php if($is_studio == 'No') { ?> checked <?php } ?>/>&nbsp;
                                                                                    No</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="indoor_size" class="col-md-2 control-label" >Property Status(Off Plan)  </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline"><input type="radio" <?php if($arr_property['off_plan'] == 'No'){?>checked<?php } ?> name="off_plan" id="off_plan" value="No"/>&nbsp;
                                                                                    Not Completed</label><label class="radio-inline"><input type="radio" <?php if($arr_property['off_plan'] == 'Yes'){?>checked<?php } ?>  name="off_plan" id="off_plan" value="Yes"/>&nbsp;
                                                                                    Completed</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="indoor_size" class="col-md-2 control-label" >Furnished  </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline"><input type="radio" name="furnished" id="furnished_yes" value="Yes" <?php if($arr_property['furnished'] == 'Yes') { ?> checked <?php } ?>/>&nbsp;
                                                                                    Yes</label>
                                                                                <label class="radio-inline"><input type="radio" name="furnished" id="furnished_no" value="No" <?php if($arr_property['furnished'] == 'No') { ?> checked <?php } ?>/>&nbsp;
                                                                                    No</label>
                                                                                <label class="radio-inline"><input type="radio" name="furnished" id="furnished_part" value="Part" <?php if($arr_property['furnished'] == 'Part') { ?> checked <?php } ?>/>&nbsp;
                                                                                    Part</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="indoor_size" class="col-md-2 control-label">Nearest to beach </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="500m" <?php if($arr_property_sales[0]['sales_beach_distance'] == '500m') { echo 'checked'; } ?>/>&nbsp;
                                                                                    500M</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="beachfront" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'beachfront') { echo 'checked'; } ?>/>&nbsp;
                                                                                    Beachfront</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="golfview" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'golfview') { echo 'checked'; } ?>/>&nbsp;
                                                                                    Golf View</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="marina" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'marina') { echo 'checked'; } ?>/>&nbsp;
                                                                                    Marina</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="oceanfront" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'oceanfront') { echo 'checked'; } ?>/>&nbsp;
                                                                                    Ocean Front</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="seaview" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'seaview') { echo 'checked'; } ?>/>&nbsp;
                                                                                    Seaview</label>
                                                                                <label class="radio-inline"><input type="radio" name="sales_beach_distance"  value="NA" <?php if($arr_property_sales[0]['sales_beach_distance'] == 'NA' || $arr_property_sales[0]['sales_beach_distance']  == '') { echo 'checked'; } ?>/>&nbsp;
                                                                                    NA</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                 
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="property_description" class="col-md-2 control-label" >Property Description </label>
                                                                        <div class="col-md-10">
                                                                            
                                                                            <textarea name="property_description"  class="ckeditor form-control"><?php echo stripslashes($arr_property_sales[0]['property_sales_desc']);?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bedrooms" class="col-md-4 control-label">Bedrooms <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                <select id="bedrooms" name="bedrooms" data-required="true" class="form-control required">
                                                                                <option value="">Please Seclect</option>
                                                                                <?php for($b=1;$b<13;$b++){?>
                                                                                <option value="<?php echo $b;?>" <?php if($b == $arr_property['bedrooms']){?>selected="selected"<?php } ?> ><?php echo $b;?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bathrooms" class="col-md-4 control-label"> Bathrooms  <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <select id="bathrooms" name="bathrooms" data-required="true" class="form-control required">
                                                                                    <?php for($b=1;$b<12;$b++){?>
                                                                                    <option value="<?php echo $b;?>"  <?php if($b == $arr_property['bathrooms']){?>selected="selected"<?php } ?> ><?php echo $b;?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            
                                                            <?php
                                                            if(count($property_suitability) > 0)
                                                            {
                                                                $special_feature1 = ($property_suitability[0]['special_feature1'] != '') ? stripslashes(trim($property_suitability[0]['special_feature1'])) : '';
                                                                $special_feature2 = ($property_suitability[0]['special_feature2'] != '') ? stripslashes(trim($property_suitability[0]['special_feature2'])) : '';
                                                                $special_feature3 = ($property_suitability[0]['special_feature3'] != '') ? stripslashes(trim($property_suitability[0]['special_feature3'])) : '';
                                                                $special_feature4 = ($property_suitability[0]['special_feature4'] != '') ? stripslashes(trim($property_suitability[0]['special_feature4'])) : '';
                                                            }
                                                            else
                                                            {
                                                                $special_feature1 = $special_feature2 = $special_feature3 = $special_feature4 = '';
                                                            }
                                                            ?>
                                                            
                                                            
                                                            
                                                            <legend><h3>Features</h3></legend>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature1" class="col-md-4 control-label"> Feature - 1 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature1" name="special_feature1" type="text"  class="form-control" value="<?php echo $special_feature1;?>" /></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature2" class="col-md-4 control-label">Feature - 2 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature2" name="special_feature2" type="text"  class="form-control" value="<?php echo $special_feature2;?>" /></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature3" class="col-md-4 control-label">Feature - 3 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature3" name="special_feature3" type="text"  class="form-control" value="<?php echo $special_feature3;?>" /></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature4" class="col-md-4 control-label">Feature - 4 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature4" name="special_feature4" type="text"  class="form-control" value="<?php echo $special_feature4;?>"/></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_offer_title" class="col-md-4 control-label">Special Offer Heading </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="glyphicon glyphicon-bold"></i>
                                                                                <input  id="special_offer_title" maxlength="18" name="special_offer_title" type="text"  class="form-control" value="<?php echo stripslashes($arr_property['special_offer_title']);?>"/>
                                                                                <div class="char-count"><span id="special_offer_title_count" class="countText"><?php echo strlen($arr_property['special_offer_title']); ?></span><span>/18</span></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_offer_text" class="col-md-4 control-label">Special Offer Text </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="fa fa-file-text-o"></i>
                                                                                <input id="special_offer_text" maxlength="50" name="special_offer_text" type="text" class="form-control" value="<?php echo stripslashes($arr_property['special_offer_text']);?>"/>
                                                                                <div class="char-count"><span id="special_offer_text_count" class="countText"><?php echo strlen($arr_property['special_offer_text']); ?></span><span>/50</span></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                           
                                                              
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------description section end-->
                                        
                                        <!------location section start-->
                                        
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-yellow portlet box portlet-grey">
                                                    
                                                    <div class="portlet-header">
                                                    <div class="caption">Location</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                                
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="region" class="col-md-4 control-label"> Region <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                    
                                                                                    <div class="input-group">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="fa fa-location-arrow"></i>
                                                                                    </span>
                                                                                        <select name="region" id="region" class="form-control required" data-required="true">
                                                                                        <option value=""> ------Please Select------ </option>
                                                                                        <?php foreach($arr_region as $key){?>
                                                                                        <option value="<?php echo $key['region_id'];?>" <?php if($key['region_id'] == $arr_property['region_id']){?>selected="selected"<?php } ?>><?php echo $key['region_name'];?></option>
                                                                                        <?php } ?>
                                                                                        </option>
                                                                                        </select>
                                                                                     </div>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="location" class="col-md-4 control-label">  Location  <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="fa fa-location-arrow"></i>
                                                                                    </span>
                                                                                <select name="location" id="location" class="form-control required" data-required="true">
                                                                                    <option value=""> ------Please Select----- </option>
                                                                                    <?php foreach($arr_location as $key)
                                                                                    {
                                                                                    ?>
                                                                                    <option value="<?php echo $key['location_id'];?>" <?php if($key['location_id'] == $arr_property['location_id']){?>selected="selected"<?php } ?>><?php echo $key['location_name'];?></option>
                                                                                    <?php
                                                                                    
                                                                                    } ?>
                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                                
                                                                
                                                                
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="latitude" class="col-md-4 control-label"> Latitude <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8 input-icon"><i class="fa fa-map-marker"></i><input id="latitude" name="latitude" type="text"   class="form-control number required"  value="<?php echo $arr_property['latitude'];?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                        <label for="longitude" class="col-md-4 control-label">Longitude <span class='require'>*</span>
                                                                        <a id="review_map" href="https://maps.google.com/" target="_blank">Review Map</a>
                                                                        </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="fa fa-map-marker"></i>
                                                                                <input id="longitude" name="longitude" type="text"  class="form-control number required" data-type="number" value="<?php echo $arr_property['longitude'];?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                           
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!------location section end-->
                                        
                                        <!------price section start-->
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-yellow portlet box portlet-pink">
                                                    
                                                    
                                                    <div class="portlet-header">
                                                    <div class="caption">Price, Size information & Freehold/Leasehold</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
        
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="sales_price_from" class="col-md-3 control-label" >Sales Price <span class='require'>*</span></label>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-money"></i>
                                                                           <input data-type="number"  name="sales_price_from" id="sales_price_from" type="text"  class="form-control number required" value="<?php echo $arr_property_sales[0]['sales_price_from'];?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="unique_id" class="col-md-3 control-label" >Unique ID <span class='require'>*</span></label>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            
                                                                           <input  name="unique_id" id="unique_id" type="text"  class="form-control required" value="<?php echo stripslashes( $arr_property_sales[0]['property_sales_serial_no']);?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="hold_type" class="col-md-3 control-label">Freehold/Leashold </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <label class="radio-inline"><input type="radio" name="hold_type" value="Leasehold" <?php if($arr_property_sales[0]['freehold_leasehold']=='Leasehold'){ ?> checked="checked" <?php } ?>/>&nbsp;
                                                                                    Leasehold</label><label class="radio-inline"><input type="radio" name="hold_type" value="Freehold" <?php if($arr_property_sales[0]['freehold_leasehold']=='Freehold'){ ?> checked="checked" <?php } ?>/>&nbsp;
                                                                                    Freehold</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="freehold_leasehold_text" class="col-md-3 control-label" >Freehold/Leasehold Text </label>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-file-text"></i>
                                                                           <input id="freehold_leasehold_text" name="freehold_leasehold_text" type="text"  class="form-control" value="<?php echo stripslashes($arr_property_sales[0]['freehold_leasehold_text']); ?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="size_starting_from" class="col-md-3 control-label" >Living Space M<sup>2</sup> <span class='require'>*</span></label>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-superscript"></i>
                                                                           <input id="size_starting_from" name="size_starting_from" data-type="number" type="text"  class="form-control number required" value="<?php echo stripslashes($arr_property_sales[0]['size_starting_from']); ?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="size_ending_to" class="col-md-3 control-label" >Constructed Area M<sup>2</sup><span class='require'>*</span> </label>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-superscript"></i>
                                                                           <input id="size_ending_to" data-type="number" name="size_ending_to" type="text"  class="form-control number required" value="<?php echo stripslashes($arr_property_sales[0]['size_ending_to']); ?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="agent_id" class="col-md-3 control-label">Agent <span class='require'>*</span></label>
                                                                                <div class="col-md-2">
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    
                                                                                    <div class="input-group">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="fa fa-user"></i>
                                                                                    </span>
                                                                                <select name="agent_id" id="agent_id" data-required="true" class="form-control required">
                                                                                    <option value=""> --------Please Select------   </option>
                                                                                    <?php
                                                                                    if(is_array($arr_agent))
                                                                                    {
                                                                                    foreach($arr_agent as $key)
                                                                                    {
                                                                                    if($arr_property_sales[0]['agent_id'] == $key['admin_id'])
                                                                                    {
                                                                                    ?>
                                                                                    <option  value="<?php echo $key['admin_id'];?>" selected="selected"><?php echo $key['agent_name'];?></option>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                    ?>
                                                                                    <option value="<?php echo $key['admin_id'];?>" ><?php echo $key['agent_name'];?></option>
                                                                                    <?php
                                                                                    }
                                                                                    }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                </div>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="payment_description" class="col-md-2 control-label" >Payment Description </label>
                                                                        <div class="col-md-10">
                                                                            
                                                                            <textarea  name="sales_payment_info"   class="ckeditor form-control"><?php echo stripslashes($arr_property_sales[0]['sales_payment_info']);?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------price section end-->
                                        
                                        <!------aminities section start-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-yellow portlet box portlet-blue">
                                                    
                                                    <div class="portlet-header">
                                                    <div class="caption">Amenities</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                                <h5>Describe the amenities for your property by clicking on the check box next to any amenity
                                                                    that is applicable to your listing. You can add details to any amenity by clicking on the
                                                                    "add details" link to the right of any selected amenity.</h5>
                                                            </div>
                                                                <?php
					  
                                                                $amenity_arr = explode(',', $arr_property_sales[0]['amenities_id']);
                                                                if( !empty($amenity_arr) && is_array($amenity_arr) ){
                                                                $amm_arr = array();
                                                                foreach($amenity_arr as $key => $val ){
                                                                 if($val != ''){
                                                                     $tt = explode('::',$val);
                                                                     if(is_array($tt) && isset($tt[0]) && isset($tt[1]) ){
                                                                         $amm_arr[$tt[0]] = $tt[1];
                                                                     }
                                                                 }
                                                                }
                                                                }
                                                                else
                                                                $amm_arr = array();
                                                                
                                                                $featured_category_name = '';
                                                                if(is_array($arr_prop_amenity)) {
                                                                ?>
					    <div class="col-md-12">
					    <input type="hidden" id="amenity_value_count" value="<?php echo count($amm_arr);?>">
					    <input name="property_sales_serial_no" id="property_sales_serial_no" data-required="true" type="hidden" class="form-controlone" value="">
					    <div class="formPanSec">
					     <div class="rightPan">
					     <?php foreach($arr_prop_amenity as $prop_amenity_val) { 
						 if($featured_category_name == $prop_amenity_val['featured_category_name']) {
						 ?>
						     
						     <div class="col-md-4">
                                                        <div class="row">
                                                            
                                                            <div class="col-md-8">
                                                                <label><?php echo $prop_amenity_val['amenities_name'];?></label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                
                                                            <select  name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" data-style="btn-white" data-show-subtext="true" class="amenity_class form-control" autocomplete='off'>
                                                                <option value="absent" class="red" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
                                                                <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
                                                                <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
                                                            </select>
                                                            </div>
                                                            
                                                        </div>
                                                    
						     </div>
						     
						 <?php
						 }
						 else
						 {
						 ?>
						
                                                <fieldset style="clear: both;">
						 <legend><h4><?php echo $prop_amenity_val['featured_category_name'];?></h4></legend>
                                                </fieldset>
                                                
                                               
						 <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label><?php echo $prop_amenity_val['amenities_name'];?></label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            
                                                            
                                                        <select name="sales_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" data-style="btn-white" data-show-subtext="true" class="amenity_class form-control" autocomplete='off'>
							 <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
							 <option value="active" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'active'){ echo 'selected="selected"'; }?> class="greenText">Active</option>
							 <option value="inactive" <?php if( array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr) && $amm_arr[$prop_amenity_val['amenities_id']] == 'inactive'){ echo 'selected="selected"'; }?> class="blueText">Display</option>
						        </select>
						     
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
						 </div>
						 
						 <?php
						 }
						 $featured_category_name = $prop_amenity_val['featured_category_name'];
						 ?>
					     
					     <?php } ?>
					     </div>
					    </div>
					    </div>
					    <?php
					    }
                                            ?>
                                             <div class="row">
                                                <div class="col-md-12" style="height:30px;"></div>
                                             </div>       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                            
                                        <!------aminities section end button-next mlm--->
                                        </div>
                                        
                                        <div class="action text-right">
                                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="submit" name="next" value="Next" class="btn btn-info">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                        </div>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT-->
       
<script>
var backend_url		= '<?php echo BACKEND_URL;?>';
var frontend_url	= '<?php echo FRONTEND_URL;?>';

var i	=	1;
var j	=	1;

$('#review_map').click(function(){
    var lat = $('#latitude').val();
    var lon = $('#longitude').val();
    if(lat != '' && lon != '')
    {
	$('#review_map').attr("href", "https://maps.google.com/maps?q=" + lat + "," + lon);
    }
    else
    {
	alert('You have to fill up both Latitude and Longitude');
	$('#review_map').attr("href", "#");
	return false;
    }
});

$(window).load(function(){
    $("#completion_date").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: 'dd/mm/yy'
    });
});
</script>

<script>
    $('#seo_title').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#seo_title_count').text(len);
	if(len>68){
	    $(this).val(value.substring(0,69));
	}
    });
    
    $('#meta_description').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#meta_description_count').text(len);
	if(len>154){
	    $(this).val(value.substring(0,155));
	}
    });
    
    $('#special_offer_title').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#special_offer_title_count').text(len);
	if(len>17){
	    $(this).val(value.substring(0,18));
	}
    });
    
    $('#special_offer_text').keydown(function(){
	var value = $(this).val();
	var len = parseInt(value.length);
	$('#special_offer_text_count').text(len);
	if(len>49){
	    $(this).val(value.substring(0,50));
	}
    });
    
$(window).load(function(){
    check_if_no_record();

  });
/*** If record not found **/
function check_if_no_record(){
   var record = $("#uploadPictures").html();
   if ($.trim(record).length == 0 ) {
       $(".no-record-hide").hide();
   }else{
       $(".no-record-hide").show();
   }
}

$(document).ready(function() {
    
    $('.amenity_class').each(function(){
	
	if($(this).val() == 'active')
	{
	    $(this).removeClass('redText');
	    $(this).removeClass('blueText');
	    $(this).addClass('greenText');
	}
	else if($(this).val() == 'inactive')
	{
	    $(this).removeClass('redText');
	    $(this).removeClass('greenText');
	    $(this).addClass('blueText');
	}
	else
	{
	    $(this).removeClass('blueText');
	    $(this).removeClass('greenText');
	    $(this).addClass('redText');
	}
    });
    
    
    $('.amenity_class').change(function(){
	    if($(this).val() == 'active')
	    {
		$(this).removeClass('redText');
		$(this).removeClass('blueText');
		$(this).addClass('greenText');
	    }
	    else if($(this).val() == 'inactive')
	    {
		$(this).removeClass('redText');
		$(this).removeClass('greenText');
		$(this).addClass('blueText');
	    }
	    else
	    {
		$(this).removeClass('blueText');
		$(this).removeClass('greenText');
		$(this).addClass('redText');
	    }
    });
});

/***** Ajax location of a region *****/
$(function(){
    get_location();
});

$("#region").on("change",function(){
	get_location();
});
$("#location").on("click",function(){
    if ($("#region").val()=='') {
	alert("Please select a Region");
    }
});
function get_location(){
    var region = $("#region").val();
    
    $.ajax({
    type: "POST",
    dataType: "HTML",
    url: "<?php echo BACKEND_URL; ?>" + "property_sales/ajax_getLocation_of_region/",
    data: { region: region},
    success:function(data) {
		if (data=='') {
		    data = '<option value="">----Please select-----</option>';
		}
		$("#location").html(data);
	    }
    });
}
/***** End Ajax location of a region *****/

</script>