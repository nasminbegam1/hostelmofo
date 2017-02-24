 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
 <h3 class="page-title"> Property Edit</h3>
 <!--For breadcrump-->    
  <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
  <!--For breadcrump end-->
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
                                            <div>
					    <form action="<?php echo AGENT_URL.'property1/editbasicaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
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
				    
					
					<!------- basic info section start ---->
                                        <div id="tab3-wizard-custom-circle" class="tab-pane fadeIn active"><!--<h3 class="mbxl">Set up Basic Info</h3>-->
					     <input type="hidden" name="action" value="basic"/>						
					    <div class="form-group"><label for="brief_introduction" class="col-sm-3 control-label">Brief Introduction</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-edit"></i>
							    </span>
							    <textarea class="form-control" name="brief_introduction" id="brief_introduction" style="height: 200px;"><?php
							    if(isset($property_details['property_details']['brief_introduction']))
							    {
								echo stripslashes($property_details['property_details']['brief_introduction']);
							    }
							    ?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="description" class="col-sm-3 control-label">Description<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-edit"></i>
							    </span>
							    <textarea rows="6" class="ckeditor form-control " name="description" id="description" ><?php
							    if(isset($property_details['property_details']['description'])){
								echo stripslashes($property_details['property_details']['description']);
							    }?></textarea><i class="alert alert-hide">Oops, Description is required</i>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="location" class="col-sm-3 control-label">Location</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <textarea rows="6" class="ckeditor form-control" name="location" id="location" ><?php
							    if(isset($property_details['property_details']['location']))
							    {
								echo stripslashes($property_details['property_details']['location']);
							    }?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="direction" class="col-sm-3 control-label">Direction</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <textarea rows="6" class="ckeditor form-control" name="direction" id="direction" ><?php
							    if(isset($property_details['property_details']['direction']))
							    {
							    echo stripslashes($property_details['property_details']['direction']); }?></textarea>
							</div>
						    </div>
                                                </div>
					    <div class="form-group"><label for="things_to_note" class="col-sm-3 control-label" >Note Policies</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea rows="6" class="ckeditor form-control" name="things_to_note" id="things_to_note" ><?php
							    if(isset($property_details['property_details']['things_to_note'])){
							    echo stripslashes($property_details['property_details']['things_to_note']); }?></textarea>
							</div>
						    </div>
                                                </div>

						<div class="form-group"><label for="things_to_note" class="col-sm-3 control-label">Cancellation Policies</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea rows="6" class="ckeditor form-control" name="cancellation_policy" id="cancellation_policy" ><?php
							    if(isset($property_details['property_details']['cancellation_policy'])){
							    echo stripslashes($property_details['property_details']['cancellation_policy']); }?></textarea>
							</div>
						    </div>
                                                </div>

						<!-- META CONTENT -->

						<div class="form-group"><label for="meta_title" class="col-sm-3 control-label">Meta Title</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea class="form-control" name="meta_title" id="meta_title"><?php
							    if(isset($property_details['property_details']['meta_title'])){
							    echo stripslashes($property_details['property_details']['meta_title']); }?></textarea>
							    <span id="countexact_meta_title"><?php if(isset($property_details['property_details']['meta_title'])) 
                                                                                                {
                                                                                                   echo  mb_strlen( trim( stripslashes($property_details['property_details']['meta_title']))) ;
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo '0';
                                                                                                }
                                                                                                ?></span><span>/69</span>
							</div>
						    </div>
                                                </div>

						<div class="form-group"><label for="meta_keyword" class="col-sm-3 control-label">Meta Keyword</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea class="form-control" name="meta_keyword" id="meta_keyword"><?php
							    if(isset($property_details['property_details']['meta_keyword'])){
							    echo stripslashes($property_details['property_details']['meta_keyword']); }?></textarea>
							</div>
						    </div>
                                                </div>

						<div class="form-group"><label for="meta_description" class="col-sm-3 control-label">Meta Description</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-file-text"></i>
							    </span>
							    <textarea class="form-control" name="meta_description" id="meta_description"><?php
							    if(isset($property_details['property_details']['meta_description'])){
							    echo stripslashes($property_details['property_details']['meta_description']); }?></textarea>
							    <span id="countexact"><?php if(isset($property_details['property_details']['meta_description'])) 
                                                                                                {
                                                                                                   echo  mb_strlen( trim( stripslashes($property_details['property_details']['meta_description']))) ;
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo '0';
                                                                                                }
                                                                                                ?></span><span>/155</span>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="latitude" class="col-sm-3 control-label">Latitude<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <input type="text" name="latitude" class="form-control requiredInput" value="<?php echo (array_key_exists('latitude',$property_details['property_details']))? stripslashes($property_details['property_details']['latitude']):'' ; ?>" /><i class="alert alert-hide">Oops, Latitude is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="longitude" class="col-sm-3 control-label">Longitude<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-map-marker"></i>
							    </span>
							    <input type="text" name="longitude" class="form-control requiredInput" value="<?php echo (array_key_exists('longitude',$property_details['property_details']))? stripslashes($property_details['property_details']['longitude']):''; ?>"/><i class="alert alert-hide">Oops, Longitude is required</i>
							</div>
						    </div>
                                                </div>

		    
                                        </div>
                                        
					<!------- basic info section end ---->
					
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property1/editcontactaction/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info editRrmBtn"><i class="fa fa-save"></i> Save and Next</button>
					    
                                            <!--<button type="button" name="next" value="Next" class="btn btn-info button-next mlm" id="nextAddProperty">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>-->
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
    $(document).ready(function(){
	    $('#meta_description').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>154){
		$(this).val(value.substring(0,155));
		 var len = 155; 
	    }
	    $('#countexact').text(len);
	});
	    

	
	$('#meta_title').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>68){
		$(this).val(value.substring(0,69));
		 var len = 69; 
	    }
	    $('#countexact_meta_title').text(len);
	});
	
    });
 
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
    
    $('.featured_image').change(function(){
	
	var img_id = $(this).attr('data-id');
	var property_id = $(this).attr('data-property-id');
	
	$.ajax({
	    type:'POST',
	    url:'<?php echo BACKEND_URL."property1/is_feature";?>',
	    data:{img_id:img_id,property_id:property_id},
	    success:function(msg){		
		alert('Image has been featured succefully.');
	    }
	});
	
    });
    
    
  </script>
  
  
  
  
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

    var handleSummernote = function () {
        $('#brief_introduction').summernote({height: 300});
	$('#description').summernote({height: 300});
	$('#location').summernote({height: 300});
	$('#direction').summernote({height: 300});
	$('#things_to_note').summernote({height: 300});
	$('#cancellation_policy').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
            handleSummernote();
        }
    };

}();
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
