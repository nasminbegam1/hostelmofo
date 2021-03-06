<style type="text/css">
    .rightPan label {
    line-height: 34px;
}
</style>
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Add Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_rental/index/"?>">Rental Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Add</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Form</div>
                                <div class="tools">
                                    <!--<i class="fa fa-chevron-up"></i>-->
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <!--<i class="fa fa-times"></i>-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                     <?=$tabs?>
                                   
                                    
                                    <div class="tab-content">
                                        <form action="<?php echo BACKEND_URL;?>property_rental/add_reatalproperty/" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                                            <input type="hidden" name="action" value="Process">
                                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                                           <!------general section start-->
                                           <div class="text-right">
                                            <a href="<?php echo BACKEND_URL."property_rental/index/"?>" style="text-decoration: none;">
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
                                                                                <input name="property_name" id="property_name" type="text" placeholder="Property Name" value="<?php echo set_value('property_name');?>" class="form-control required"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="page_title" class="col-md-4 control-label">Display Title <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8 input-icon"><i class="fa fa-file-text-o"></i><input name="page_title" id="page_title" type="text" placeholder="Display Title" class="form-control required" value="<?php echo set_value('page_title');?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_type" class="col-md-4 control-label">Optional Title <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8 input-icon">
                                                                                    
                                                                               
                                                                                    <i class="fa fa-file-text-o"></i>
                                                                               
                                                                                    
                                                                               <input name="optional_title" id="optional_title" type="text" placeholder="Optional Title" class="form-control required" value="<?php echo set_value('optional_title');?>"/>
                                                                                    
                                                                                </div>   
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_type" class="col-md-4 control-label">Property Type <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                    <div class="input-group">
                                                                                 <span class="input-group-addon">
                                                                                    <i class="fa fa-building-o"></i>
                                                                                 </span>
                                                                                    
                                                                                <?php if(is_array($arr_property_type)) { ?>
                                                                                <select name="property_type" title="Seletc your type of your property" id="property_type" data-required="true"  class="form-control required">
                                                                                <option value="">--Select Property Types--</option>    
                                                                                <?php foreach($arr_property_type as $key){?>
                                                                                <option value="<?php echo $key['property_type_id'];?>" <?php echo  set_select('property_type',$key['property_type_id'])?> ><?php echo $key['property_name'];?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                                <?php } ?>
                                                                                    </div>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                   
                                                                   
                                                               </div>
                                                                
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_ranking" class="col-md-4 control-label">Result Ranking <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-star"></i>
                                                                                 </span>
                                                                                
                                                                               <select data-required="true" title="Give a rank for this property" name="property_ranking" id="property_ranking" class="form-control required">
                                                                                    <option value="">-----Please Select---</option>
                                                                                    <option value="1" <?php echo set_select('property_ranking',1)?> >1</option>
                                                                                    <option value="2" <?php echo set_select('property_ranking',2)?> >2</option>
                                                                                    <option value="3" <?php echo set_select('property_ranking',3)?> >3</option>
                                                                                    <option value="4" <?php echo set_select('property_ranking',4)?> >4</option>
                                                                                    <option value="5"  <?php echo set_select('property_ranking',5)?> >5</option>
                                                                                    <option value="6"  <?php echo set_select('property_ranking',6)?> >6</option>
                                                                                    <option value="7" <?php echo set_select('property_ranking',7)?> >7</option>
                                                                                    <option value="8"  <?php echo set_select('property_ranking',8)?> >8</option>
                                                                                    <option value="9"  <?php echo set_select('property_ranking',9)?> >9</option>
                                                                                    <option value="10" <?php echo set_select('property_ranking',10)?> >10</option>
                                                                                 
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
                                                                                <textarea name="seo_title" id="seo_title" rows="3" class="form-control required"><?php echo set_value('seo_title');?></textarea>
                                                                                <span id="seo_title_count" class="countText"><?php echo strlen(set_value('seo_title')); ?></span><span>/69</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="meta_description" class="col-md-4 control-label">Meta Description<span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <textarea name="meta_description" id="meta_description"  rows="3" class="form-control required"  maxlength="155"><?php echo set_value('meta_description');?></textarea>
                                                                                <span id="meta_description_count" class="countText"><?php echo strlen(set_value('meta_description')); ?></span><span>/155</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="similar_property_tag" class="col-md-2 control-label" >Similar Property Tag </label>
                                                                        <div class="col-md-10 input-icon"><i class="fa fa-tag"></i><input id="similar_property_tag" name="similar_property_tag" type="text" placeholder="" class="form-control" value="<?php echo set_value('similar_property_tag');?>"/></div>
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
        
                                                                 <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bedrooms" class="col-md-4 control-label">Bedrooms <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                <select id="bedrooms" name="bedrooms" data-required="true" class="form-control required">
                                                                                <option value="">Please Seclect</option>
                                                                                <?php for($b=1;$b<13;$b++){?>
                                                                                <option value="<?php echo $b;?>" <?php echo set_select('bedrooms', $b); ?> ><?php echo $b;?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                                <div id="details_box"></div>
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bedroom_configuration" class="col-md-4 control-label"> Bedroom Configuration  </label>
        
                                                                            <div class="col-md-8">
                                                                                <input id="bedroom_configuration" name="bedroom_configuration" type="text" placeholder="" class="form-control" value="<?php echo set_value('bedroom_configuration');?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                               </div>
                                                                 
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bathrooms" class="col-md-4 control-label"> Bathrooms  </label>
        
                                                                            <div class="col-md-8">
                                                                                <select id="bathrooms" name="bathrooms" data-required="true" class="form-control">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php for($b=1;$b<13;$b++){?>
                                                                                    <option value="<?php echo $b;?>"  <?php echo set_select('bathrooms', $b); ?> ><?php echo $b;?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="bathroom_configuration" class="col-md-4 control-label"> Bathroom Configuration  </label>
        
                                                                            <div class="col-md-8">
                                                                                <input id="bathroom_configuration" name="bathroom_configuration" type="text" placeholder="" class="form-control" value="<?php echo set_value('bathroom_configuration');?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                                
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="is_studio" class="col-md-4 control-label">Studio </label>
        
                                                                                <div class="col-md-8">
                                                                                    
                                                                                    <label class="radio-inline"><input type="radio" value="Yes" id="is_studio" name="is_studio" <?php echo  set_radio('is_studio',"Yes")?>/>&nbsp;
                                                                                    Yes</label><label class="radio-inline"><input type="radio" value="No" id="is_studio" name="is_studio" <?php echo set_radio('is_studio',"No",true)?>/>&nbsp;
                                                                                    No</label>
                                                                               
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="sleeps" class="col-md-4 control-label"> Sleeps  <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8">
                                                                                <select id="sleeps" name="sleeps" data-required="true" class="form-control required">
                                                                                    <option value="">Please Select</option>
                                                                                    <?php for($b=1;$b<12;$b++){?>
                                                                                    <option value="<?php echo $b;?>"  <?php echo set_select('bathrooms', $b); ?> ><?php echo $b;?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            
                                                            <legend><h3>Features</h3></legend>
                                                            
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature1" class="col-md-4 control-label"> Feature - 1 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature1" name="special_feature1" type="text"  class="form-control" value="<?php echo set_value("special_feature1");?>" /></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature2" class="col-md-4 control-label">Feature - 2 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature2" name="special_feature2" type="text"  class="form-control" value="<?php echo set_value("special_feature2");?>" /></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature3" class="col-md-4 control-label">Feature - 3 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature3" name="special_feature3" type="text"  class="form-control" value="<?php echo set_value("special_feature3");?>" /></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_feature4" class="col-md-4 control-label">Feature - 4 </label>
        
                                                                            <div class="col-md-8"><input id="special_feature4" name="special_feature4" type="text"  class="form-control" value="<?php echo set_value("special_feature4");?>"/></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="property_description" class="col-md-2 control-label" >Property Description </label>
                                                                        <div class="col-md-10">
                                                                            
                                                                            <textarea name="property_description"  data-required="true" class="ckeditor form-control required"><?php echo set_value('property_description');?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_offer_title" class="col-md-4 control-label">Special Offer Heading </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="glyphicon glyphicon-bold"></i>
                                                                                <input  id="special_offer_title" maxlength="18" name="special_offer_title" type="text"  class="form-control" value="<?php echo set_value("special_offer_title");?>"/>
                                                                                <div class="char-count"><span id="special_offer_title_count" class="countText"><?php echo strlen(set_value('special_offer_title')); ?></span><span>/18</span></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="special_offer_text" class="col-md-4 control-label">Special Offer Text </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="fa fa-file-text-o"></i>
                                                                                <input id="special_offer_text" maxlength="50" name="special_offer_text" type="text" class="form-control" value="<?php echo set_value('special_offer_text');?>"/>
                                                                                <div class="char-count"><span id="special_offer_text_count" class="countText"><?php echo strlen(set_value('special_offer_text')); ?></span><span>/50</span></div>
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
                                                                                        <option value="<?php echo $key['region_id'];?>" <?php echo set_select('region',  $key['region_id']); ?>   ><?php echo $key['region_name'];?></option>
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
                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                                
                                                                
                                                                
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="latitude" class="col-md-4 control-label"> Latitude <span class='require'>*</span></label>
        
                                                                            <div class="col-md-8 input-icon"><i class="fa fa-map-marker"></i><input id="latitude" name="latitude" type="text"   class="form-control number required"  value="<?php echo set_value('latitude');?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                        <label for="longitude" class="col-md-4 control-label">Longitude <span class='require'>*</span>
                                                                        <a id="review_map" href="https://maps.google.com/" target="_blank">Review Map</a>
                                                                        </label>
        
                                                                            <div class="col-md-8 input-icon">
                                                                                <i class="fa fa-map-marker"></i>
                                                                                <input id="longitude" name="longitude" type="text"  class="form-control number required" data-type="number" value="<?php echo set_value('longitude');?>"/>
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
                                                    <div class="caption">Necessary Rental Information </div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
        
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="indoor_size" class="col-md-2 control-label">Cancellation Policy  </label>
                                                                            
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline"><input type="radio" value="Flexible" id="cancellation_policy1" name="cancellation_policy" <?php echo  set_radio('cancellation_policy',"Flexible")?>/>&nbsp;
                                                                                    Flexible</label>
                                                                                <label class="radio-inline"><input type="radio" value="Moderate" id="cancellation_policy2" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"Moderate")?>/>&nbsp;
                                                                                    Moderate</label>
                                                                                <label class="radio-inline"><input type="radio" value="Strict" id="cancellation_policy3" name="cancellation_policy"  <?php echo set_radio('cancellation_policy',"Strict",true)?>/>&nbsp;
                                                                                    Strict</label>
                                                                                <label class="radio-inline"><input type="radio" value="SuperStrict" id="cancellation_policy4" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"SuperStrict")?> />&nbsp;
                                                                                    Super Strict</label>
                                                                                <label class="radio-inline"><input type="radio" value="LongTerm" id="cancellation_policy4" name="cancellation_policy" <?php echo set_radio('cancellation_policy',"LongTerm")?>/>&nbsp;
                                                                                    Long Term</label>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="checkin" class="col-md-4 control-label">Check In Time <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                    <!--<div class="input-group">
                                                                               <span class="input-group-addon">
                                                                                    <i class="fa fa-building-o"></i>
                                                                                 </span>-->
                                                                                    
                                                                                <select name="checkin" id="checkin" class="form-control required">
                                                                                   
                                                                                    <option value="">--Select Any--</option>
                                                                                    <option value="00:00">00:00</option>
                                                                                    <option value="01:00">01:00</option>
                                                                                    <option value="02:00">02:00</option>
                                                                                    <option value="03:00">03:00</option>
                                                                                    <option value="04:00">04:00</option>
                                                                                    <option value="05:00">05:00</option>
                                                                                    <option value="06:00">06:00</option>
                                                                                    <option value="07:00">07:00</option>
                                                                                    <option value="08:00">08:00</option>
                                                                                    <option value="09:00">09:00</option>
                                                                                    <option value="10:00">10:00</option>
                                                                                    <option value="11:00">11:00</option>
                                                                                    <option value="12:00">12:00</option>
                                                                                    <option value="13:00">13:00</option>
                                                                                    <option value="14:00">14:00</option>
                                                                                    <option value="15:00">15:00</option>
                                                                                    <option value="16:00">16:00</option>
                                                                                    <option value="17:00">17:00</option>
                                                                                    <option value="18:00">18:00</option>
                                                                                    <option value="19:00">19:00</option>
                                                                                    <option value="20:00">20:00</option>
                                                                                    <option value="21:00">21:00</option>
                                                                                    <option value="22:00">22:00</option>
                                                                                    <option value="23:00">23:00</option>
                                                                                
                                                                                </select>
                                                                                    <!--</div>-->
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="property_ranking" class="col-md-4 control-label">Check Out Time  <span class='require'>*</span></label>
                                                                                
                                                                             
                                                                            <div class="col-md-8">
                                                                                <!--<div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-star"></i>
                                                                                 </span>-->
                                                                                
                                                                               <select name="checkout" id="checkout" class="form-control required">
                                                                                    <option value="">--Select Any--</option>
                                                                                    <option value="00:00">00:00</option>
                                                                                    <option value="01:00">01:00</option>
                                                                                    <option value="02:00">02:00</option>
                                                                                    <option value="03:00">03:00</option>
                                                                                    <option value="04:00">04:00</option>
                                                                                    <option value="05:00">05:00</option>
                                                                                    <option value="06:00">06:00</option>
                                                                                    <option value="07:00">07:00</option>
                                                                                    <option value="08:00">08:00</option>
                                                                                    <option value="09:00">09:00</option>
                                                                                    <option value="10:00">10:00</option>
                                                                                    <option value="11:00">11:00</option>
                                                                                    <option value="12:00">12:00</option>
                                                                                    <option value="13:00">13:00</option>
                                                                                    <option value="14:00">14:00</option>
                                                                                    <option value="15:00">15:00</option>
                                                                                    <option value="16:00">16:00</option>
                                                                                    <option value="17:00">17:00</option>
                                                                                    <option value="18:00">18:00</option>
                                                                                    <option value="19:00">19:00</option>
                                                                                    <option value="20:00">20:00</option>
                                                                                    <option value="21:00">21:00</option>
                                                                                    <option value="22:00">22:00</option>
                                                                                    <option value="23:00">23:00</option>
                                                                                </select>
                                                                                <!--</div>-->
                                                                                 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="check_in_out_text" class="col-md-2 control-label" >Check In- Check Out Text </label>
                                                                        <div class="col-md-10 input-icon"><input id="check_in_out_text" name="check_in_out_text" type="text" placeholder="" class="form-control" value="<?php echo set_value('check_in_out_text');?>"/></div>
                                                                    </div>
                                                                   </div>
                                                              
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="security_deposit" class="col-md-4 control-label">Security Deposit <span class='require'>*</span></label>
        
                                                                                <div class="col-md-8">
                                                                                
                                                                                <input id="security_deposit" name="security_deposit" type="text" placeholder="" class="form-control required" value="<?php echo set_value('security_deposit');?>"/>
                                                                                    
                                                                                </div>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group"><label for="security_deposit_text" class="col-md-4 control-label"> Security Deposit Text </label>
                                                                                
                                                                             
                                                                            <div class="col-md-8">
                                                                                
                                                                               <input id="security_deposit_text" name="security_deposit_text" type="text" placeholder="" class="form-control" value="<?php echo set_value('security_deposit_text');?>"/>
                                                                                
                                                                                 
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
                                                                $amenity_arr = '';
                                                                if( isset($amenity_arr) && is_array($amenity_arr) ){
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
                                                                                    
                                                                                    <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" data-style="btn-white"  data-show-subtext="true" class="amenity_class form-control">
                                                                                        <option value="absent" <?php if(!array_key_exists ($prop_amenity_val['amenities_id'],$amm_arr)){ echo 'selected="selected"'; }?> class="redText">Off</option>
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
                                                                                
                                                                                
                                                                               <select name="rental_amenities[<?php echo $prop_amenity_val['amenities_id'];?>]" data-style="btn-white" data-show-subtext="true" class="amenity_class form-control">
                                                                                
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