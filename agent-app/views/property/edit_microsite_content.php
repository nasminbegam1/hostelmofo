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
                    <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                  </div>
                  <div class="portlet-body panel-body pan">
                    <div>
                      <form action="<?php echo AGENT_URL.'property/editcontactaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="property_master_id" id="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
                        <!------ tab start-------->
                        <?=$tabs?>
                        <!------ tab end --------->
                        <div class="formPreLoader" style="">
                          <div class="imgLoaderDiv"> <img class="loader"   id="" src="<?php echo BACKEND_URL
						 ."vendors/pageloader/images/loader7.GIF" ?>" /> </div>
                        </div>
                        <div class="tab-content"> 
                          
                          <!----- details section start ---> 
                          
                          <!----- details section end ---> 
                          
                          <!----- contact section start --->
                          <div id="tab2-wizard-custom-circle" class="tab-pane active"><!--<h3 class="mbxl">Set up Contact details</h3>-->
                            <input type="hidden" name="action" value="contact"/>
                            <div class="microsite">How To Update Your Microsite Information</div>
                            <div class="row">
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="description" class="col-sm-12 control-label">Description<span class='require'>*</span></label>
                                  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-edit"></i> </span>
                                      <textarea rows="6" class="form-control " name="description" id="description" ><?php
					if(isset($property_details['property_details']['description'])){
					    echo stripslashes($property_details['property_details']['description']);
					}?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="brief_introduction" class="col-sm-12 control-label">Brief Introduction</label>
                                  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-edit"></i> </span>
                                      <textarea class="form-control" name="brief_introduction" id="brief_introduction" rows="6">
					<?php
					if(isset($property_details['property_details']['brief_introduction']))
					{
					    echo stripslashes($property_details['property_details']['brief_introduction']);
					}
					?>
					</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <?php /*<div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="things_to_note" class="col-sm-12 control-label" >Hostel Condition</label>
				  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-edit"></i> </span>
                                      <textarea rows="6" class="form-control " name="hotel_condition" id="hotel_condition" ><?php
					if(isset($property_details['property_details']['hotel_condition'])){
					    echo stripslashes($property_details['property_details']['hotel_condition']);
					}?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>*/ ?>
			      <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="things_to_note" class="col-sm-12 control-label" >Cancellation Policy</label>
				  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-edit"></i> </span>
                                      <textarea rows="6" class="form-control " name="hotel_cancel" id="hotel_cancel" ><?php
					if(isset($property_details['property_details']['cancellation_policy'])){
					    echo stripslashes($property_details['property_details']['cancellation_policy']);
					}?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="direction" class="col-sm-12 control-label">Directions of Condition</label>
                                  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-map-marker"></i> </span>
                                      <textarea rows="6" class="ckeditor form-control" name="direction" id="direction" ><?php
							    if(isset($property_details['property_details']['direction']))
							    {
							    echo stripslashes($property_details['property_details']['direction']); }?>
</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="location" class="col-sm-12 control-label">Location</label>
                                  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-map-marker"></i> </span>
                                      <textarea rows="6" class="ckeditor form-control" name="location" id="location" ><?php
							    if(isset($property_details['property_details']['location']))
							    {
								echo stripslashes($property_details['property_details']['location']);
							    }?>
</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="things_to_note" class="col-sm-12 control-label" >Things To Note</label>
                                  <div class="col-sm-12">
                                    <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-file-text"></i> </span>
                                      <textarea rows="6" class="ckeditor form-control" name="things_to_note" id="things_to_note" ><?php
							    if(isset($property_details['property_details']['things_to_note'])){
							    echo stripslashes($property_details['property_details']['things_to_note']); }?>
</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <label for="minimum_nights_stay" class="col-sm-12 control-label"></label>
                                  <h3 class="mbxl">Maximum Night Stay</h3>
                                  <P>You can now choose the maximum number of night people will be able to book in your propery. This can between 7 and 31</P>
                                  <div class="col-sm-12">
                                    <div class="input-group">
                                      <select name="maximum_nights_stay" id="maximum_nights_stay" class="form-control">
                                        <option value=""> No Maximum Night Set </option>
                                        <?php for($i=1;$i<=8;$i++){?>
                                        <option value="<?php echo $i;?>" <?php if($property_details['property_master']['maximum_nights_stay'] == $i) echo "selected";?>><?php echo $i;?></option>
                                        <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                  <h3 class="mbxl gpngTop">Minimum Night Stay For All Weekends</h3>
                                  <P>You can now choose the minimum number of nights that guests must book to stay in your property at weekends</P>
                                  <div class="col-sm-12">
                                    <div class="input-group">
                                      <select name="minimum_nights_stay" id="minimum_nights_stay" class="form-control">
                                        <option value=""> No Mimimum Night Set </option>
                                        <?php for($i=1;$i<=8;$i++){?>
                                        <option value="<?php echo $i;?>" <?php if($property_details['property_master']['minimum_nights_stay'] == $i) echo "selected";?>><?php echo $i;?></option>
                                        <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <h3 class="mbxl">Earliest/Latest Check in Time</h3>
                                    <div class="col-sm-12">
                                      <label for="earliest_check_in" class="col-sm-5 control-label">Earliest Check in</label>
                                      <div class="col-md-7">
                                        <?php
							$earliest_check_in = $property_details['property_master']['earliest_check_in'];
							$check_in = explode(':',$earliest_check_in);
						     ?>
                                        <select name="check_in_hour" class="timeBox" >
                                          <option value="">Hour</option>
                                          <?php
							 for($i=0;$i<=23;$i++){
							 ?>
                                          <option value="<?php echo ($i);?>" <?php if($check_in[0]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
                                          <?php
							 }
							?>
                                        </select>
                                        <select name="check_in_minute" class="timeBox" >
                                          <option value="">Minute</option>
                                          <?php
							  for($i=0;$i<=60;$i++){
							  ?>
                                          <option value="<?php echo ($i);?>" <?php if($check_in[1]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
                                          <?php
							  }
							 ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <label for="latest_check_in" class="col-sm-5 control-label">Latest Check in</label>
                                      <div class="col-md-7">
                                        <?php
								$latest_check_in = $property_details['property_master']['latest_check_in'];
								$check_out = explode(':',$latest_check_in);
								?>
                                        <select name="check_out_hour" class="timeBox" >
                                          <option value="">Hour</option>
                                          <?php
								    for($i=0;$i<=23;$i++){
								    ?>
                                          <option value="<?php echo ($i);?>" <?php if($check_out[0]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
                                          <?php
								    }
								   ?>
                                        </select>
                                        <select name="check_out_minute" class="timeBox" >
                                          <option value="">Minute</option>
                                          <?php
								    for($i=0;$i<=60;$i++){
								    ?>
                                          <option value="<?php echo ($i);?>" <?php if($check_out[1]==$i) echo "selected";?>><?php echo ($i<10?'0'.$i:$i);?></option>
                                          <?php
								    }
								   ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 BoxBg mnHt">
                                <h3 class="mbxl">Video</h3>
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label for="property_video_link" class="col-sm-3 control-label">Youtube URL</label>
                                    <div class="col-md-9">
                                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-magnet"></i></span>
                                        <input type="text" class="form-control" name="property_video_link" id="property_video_link" value="<?php echo stripslashes($property_details['property_master']['property_video_link']) ?>"/>
                                        <p>e.g. - https://www.youtube.com/watch?v=rO3uyUvmwcw</p>
                                      </div>
                                      <p>All videos are verified by Hostelworld staff before appearing on site.
                                        Videos with contact details or URL's cannot appear on Hostelworled.com</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row" align="center">
                              <div class="col-md-12 BoxBg">
                                <h3 class="mbxl">Other Minimum Nights</h3>
                                <p>You can setup a minimum number of nights stay in your property within a certain date range</p>
                                <p>Choose dates for new minimum nights stay</p>
                                <table width="100%" id="minNightTable">
				 <tr>
				  <td colspan="4" id="add_night" align="right" ><b>Add</b></td>
				 </tr>
				 <thead>
                                 <tr>
                                    <td>From</td>
                                    <td>To</td>
                                    <td>Nights</td>
                                    <td></td>
                                  </tr>
				 </thead>
				 <tbody>
				  <tr id="addstayvalue">
				   <input type="hidden" id="min_id" value="">
				   <input type="hidden" id="action" value="">
				   <td>
				    <input type="text" placeholder="From Date" id="from_date" class="from_date form-control" autocomplete="off">
				     <span id="from_date_error" style="color:red" class="error"></span>
				   </td>
				   <td>
				    <input type="text" placeholder="To Date" id="to_date" class="to_date form-control" autocomplete="off">
				     <span id="to_date_error" style="color:red" class="error"></span></td>
				   <td align="right"><input type="button" value="Save" id="saveMinNight">
				    <input type="button" value="Cancel" id="cancelMinNight">
				    </td>
				  </tr>
				 </tbody>
				 <tfoot id="viewStayValue">
				 </tfoot>
                                </table>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <h3 class="mbxl">Facilities</h3>
                                  <div class="col-sm-12">
                                    <div class="input-group">
                                      <?php if(is_array($facilities_list) and count($facilities_list)>0){ ?>
                                      <?php foreach($facilities_list as $index=>$data){ ?>
                                      <div class="col-sm-6">
                                        <label>
                                          <input <?php echo (is_array($property_details['property_facility'])  and count($property_details['property_facility'])>0 and array_key_exists($data['amenities_id'],$property_details['property_facility']))? 'checked="checked"':''; ?> type="checkbox" name="property_facilities[]" value="<?php echo $data['amenities_id'] ?>" <?php  ?> />
                                          <?php echo stripslashes($data['amenities_name']); ?> </label>
                                      </div>
                                      <?php } ?>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 BoxBg">
                                <div class="form-group row">
                                  <h3 class="mbxl">Upload Photo</h3>
                                  <div class="col-sm-12">
                                    <div class="input-group">
                                      <div class="row fileupload-buttonbar">
                                        <div class="col-lg-2 addButtonBer"><!--The fileinput-button span is used to style the file input field as button--><span class="btn btn-success fileinput-button addPropertyPhoto"><i class="glyphicon glyphicon-plus"></i>&nbsp;<span>Add files...</span></span>&nbsp; &nbsp;
                                          <input type="file" name="propertyfiles[]" multiple="multiple" class="propertyfiles" id="propertyfiles" onchange="javascript:attachImages(this)" style="display: none;"/>
                                        </div>
                                        <div class="col-lg-1 text-right"> <img class="loader" id="uploadLoader" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" style="display: none;" /> </div>
                                        <!--The global progress state-->
                                        <div class="col-lg-5 fileupload-progress fade"><!--The global progress bar-->
                                          <div role="progressbar" aria-valuemin="0" aria-valuemax="100" class="progress progress-striped active">
                                            <div style="width: 0%;" class="progress-bar progress-bar-success"></div>
                                          </div>
                                          <!--The extended global progress state-->
                                          <div class="progress-extended"> </div>
                                        </div>
                                      </div>
                                      <table role="presentation" class="table">
                                        <tbody class="files prePropertyImages">
                                          <?php if(is_array($property_details['property_images']) and count($property_details['property_images'])>0){ foreach($property_details['property_images'] as $img){  ?>
                                          <tr class="imageinfo  <?php echo ($img['featured_image']=='Yes')? 'note note-danger':'note note-warning'; ?>" data-item="<?php echo $img['property_image_id'];?>">
                                            <td  width="12%"><?php if($img['featured_image']=='Yes'){ ?>
                                              <input type="radio" name="featured_image" value="<?php echo $img['property_image_id'];?>" data-id = "<?php echo $img['property_image_id'];?>" data-property-id = "<?php echo $img['property_id'];?>" checked="checked" class="featured_image"  />
                                              <?php }else{ ?>
                                              <input type="radio" name="featured_image" value="<?php echo $img['property_image_id'];?>" data-property-id = "<?php echo $img['property_id'];?>" data-id = "<?php echo $img['property_image_id'];?>" class="featured_image" title="Make it Feature" />
                                              <?php } ?>
                                              <img width="70" height="70" src="<?php echo FILE_UPLOAD_URL.'property/small/'.$img['image_name']; ?>"/></td>
                                            <td width="25%"><input type="text" placeholder="Photo Title" name="image_title[<?php echo $img['property_image_id'];?>]" value="<?php echo stripslashes($img['image_title']); ?>" class="form-control" /></td>
                                            <td width="25%"><input type="text" placeholder="Photo Alt" name="image_alt[<?php echo $img['property_image_id'];?>]" value="<?php echo stripslashes($img['image_alt']); ?>" class="form-control" /></td>
                                            <td><?php echo $img['image_name']; ?></td>
                                            <td><a  data-img="<?php echo $img['image_name']; ?>" onclick="javascript:return delPreImage('pre',this)" data-features="<?php echo $img['featured_image']; ?>" class="btn btn-danger delPreviewImg"  ><i class="glyphicon glyphicon-trash"></i></a></td>
                                          </tr>
                                          <?php } } ?>
                                        </tbody>
                                        <tbody class="files preiviewPropertyImages">
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="action text-right"> <a href="<?php echo base_url().'property/edit/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>">
                            <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                            </a>
                            <button type="submit" name="save_now" value="Save Now" class="btn btn-info editRrmBtn"><i class="fa fa-save"></i> Save and Next</button>
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
    jQuery(document).ready(function() {
     
 
    $("#per_page").change(function(){
      $(this).parents('form').submit();
      });

     ComponentsEditors.init();
  });
  
  var ComponentsEditors = function () {
    
    var handleWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["<?php echo AGENT_CSS_PATH; ?>bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
        }
    };

}();
  </script> 
</script> 

<!--END CONTENT--> 
<!--BEGIN CONTENT QUICK SIDEBAR--> 

<!--END CONTENT QUICK SIDEBAR--> 
