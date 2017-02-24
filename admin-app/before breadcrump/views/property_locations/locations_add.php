<script type="text/javascript">
    jQuery(document).ready(function(){
	jQuery('#count-textarea2').keydown(function(){
	    var value = $(this).val();
	    var len = value.length;
	    jQuery('#countexact').text(len);
	    if(len>199){
		jQuery(this).val(value.substring(0,199));
	    }
	});
    });
  
    
    jQuery(document).ready(function(){
    if($('#s2_tokenization').length) {
                $('#s2_tokenization').select2({
                        placeholder: "",
                        tags:[],
                        tokenSeparators: [","]
                });
        }
    });
    
    
 $(document).ready(function(){
	var countLocdetails = 1;
	
	$('#add-more-location-details').click(function()
					      {
		countLocdetails++;
		var strLocationdetails = '<tr>'+
				   '<td> Title:<input type="text" name = "image_title[]" value="" class ="form-control parsley-validated" /></td>&nbsp;&nbsp;&nbsp;&nbsp;'+
				    '<td>Caption:<input type="text" name = "image_caption[]" value="" class ="form-control parsley-validated" /></td>&nbsp;&nbsp;&nbsp;&nbsp;'+
				    '<td>Link:<input type="text" name = "image_link[]" value="" class ="form-control parsley-validated" /></td>&nbsp;&nbsp;&nbsp;&nbsp;'+
				    '<td><strong>Select Location Details Image</strong><input type="file" name="locationBanner'+countLocdetails+'" /></td>'+
				    
				'</tr>';
		$('#locationcontainer').append(strLocationdetails);
	});
    
     
      });
    
</script>

    <link type="text/css" rel="stylesheet" href="vendors/select2/select2-madmin.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-select/bootstrap-select.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/multi-select/css/multi-select-madmin.css">
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New Location</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Location Master</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="<?php echo $add_link;?>" >
Add New Location Master</a></li>
      
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Location Master Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
							
							<div class="form-group"><label for="location_name" class="col-md-3 control-label">Region<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <select class="form-control required" id="region_id" name="region_id" data-required="true">
                                    <option value="">--Select Region--</option>
                                    <?php if($regions){ ?>
                                    <?php foreach($regions as $single){ ?>
                                    <option value="<?php echo $single['region_id']; ?>"><?php echo stripslashes($single['region_name']); ?></option>
                                    <?php } } ?>
                                </select>
                                                                
                                                            </div>
                                                        </div>
							
                                                        <div class="form-group"><label for="location_name" class="col-md-3 control-label">Locations Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control required" name="location_name" id="location_name" value="" data-required="true">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="location_code" class="col-md-3 control-label">Locations Code <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input type="text" class="form-control required" name="location_code" id="location_code" value="" data-required="true">
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="short_description" class="col-md-3 control-label">Short Description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <div class="input-icon"><i class=""></i>
                                                                    <textarea name="short_description" id="count-textarea2" rows="7" cols="60" class="form-control required" data-required="true"></textarea><br\>
			       <span id="countexact">0</span><span>/200</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <div class="form-group"><label for="long_description" class="col-md-3 control-label">Long Description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                 <textarea name="long_description" id="wysiwg_editor" rows="10" cols="60" class="ckeditor form-control required" data-required="true"></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="distance_airport" class="col-md-3 control-label">Distance Airport <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="nearest_airport_info" id="distance_airport" class="form-control required" data-required="true"></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="cost_to_airport" class="col-md-3 control-label">Cost to Airport<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="airport_taxi_info" id="cost_to_airport" class="form-control required" data-required="true"></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="distance_to_phukettown" class="col-md-3 control-label">Distance to Phuket Town<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="explore_things_todo" id="distance_to_phukettown" class="form-control required" data-required="true"></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location_code" class="col-md-3 control-label">Distance to Patong<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="distance_to_patong" id="distance_to_patong" class="form-control required" data-required="true"></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="latitude" class="col-md-3 control-label">Latitude<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input type="text" class="form-control required" name="latitude" id="latitude" value="" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="longitude" class="col-md-3 control-label">Longitude<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input type="text" class="form-control required" name="longitude" id="longitude" value="" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="meta_title" class="col-md-3 control-label">Meta Title<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="meta_title" id="meta_title" data-required="true" class="form-control required"></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="meta_key" class="col-md-3 control-label">Meta Key<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="meta_key" data-required="true" class="form-control required" ></textarea>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="meta_description" class="col-md-3 control-label">Meta Description<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <textarea name="meta_description" id="meta_description" data-required="true"  class="form-control required"></textarea>
                                    <span id="countexact2">0</span><span>/155</span>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location_featured" class="col-md-3 control-label">Is Featured Location ?<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                 <select class="form-control required" id="location_featured" name="location_featured" data-required="true">
                                    <option value="No">&nbsp;No&nbsp;</option>
				    <option value="Yes">&nbsp;Yes&nbsp;</option>  
                                </select>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location_status" class="col-md-3 control-label">Is Active ?<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                 <select class="form-control required" id="location_status" name="location_status" data-required="true">
				    <option value="active">&nbsp;Active&nbsp;</option>  
                                    <option value="inactive">&nbsp;Inactive&nbsp;</option>
                                </select>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location_tags" class="col-md-3 control-label">Location tags<span class='require'></span></label>

                                                            <div class="col-md-4">
								
                                                                <input type="text" class="form-control required" name="location_tags" id="s2_tokenization">
                                                                  <!--<input type="text" class="form-control required" name="location_tags" id="s2_tokenization" class="select2-tagging-support form-control" >-->
								    
								    <br\><b>Tags should be comma seperated eg:tag1,tag2...</b>
								    
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="locationImage" class="col-md-3 control-label">Upload Image[For Home Page Locations]<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                 <input type="file" name="locationImage" id="locationImage" /><br\><b>[image size exact 315x166| extension must be .jpg or .jpeg or .gif or .png]</b>                   
				
				<div id="displayFilePhotos"></div>	
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="meta_description" class="col-md-3 control-label">Upload Banner [For Location page header banner]<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                <input type="file" name="locationbanner" id="locationbanner" /><br\><b>[image size should be of 1038x395| extension must be .jpg or .jpeg or .gif or .png]</b>                   
				
				<div id="displayFilePhotos"></div>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="meta_description" class="col-md-3 control-label">Theme types<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                 <?php
								if(count($themes)>0)
								{
									foreach($themes as $atheme)
									{
										echo $atheme['theme_type_name'];
									?>
									<input type="checkbox" value="<?php echo $atheme['theme_type_id'];?>" name="themes[]" />
									 <?php
									}
								}
								?>
                                                            </div>
                                                        </div>
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Location</button>
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
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="vendors/multi-select/js/jquery.multi-select.js"></script>
<script src="js/ui-dropdown-select.js"></script>
<script>
    
    $(document).ready(function(){
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact1').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) + 1; 
	    $('#countexact2').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>