 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Property Type</div>
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
                                                    <div class="caption">Edit Property Type</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="property_type_name" class="col-md-3 control-label">Property Type Name<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="property_type_name" type="text" placeholder="" class="form-control required" id="property_type_name" value="<?php echo $arr_property_type['property_type_name'];?>"/>
                                                                
                                                            </div>
                                                        </div>
						        <div class="form-group"><label for="property_description" class="col-md-3 control-label">Property Description</label>

                                                            <div class="col-md-9">
                                                               <textarea name="property_description" class="ckeditor form-control" style="height: 300px;"><?php echo stripslashes($arr_property_type['property_description']);?></textarea>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="property_img" class="col-md-3 control-label">Property Banner Photo</label>

                                                            <div class="col-md-9">
                                                               <input type="file" name="property_img" class="form-control" onchange="javascript:previewImg(this,'.previewContainer1')"/>
							       <!--<i style="color: #E74C3C">Photo min-width : 800 & min-height : 600</i>-->
							       <br/>
							        <div class="previewContainer1">
								    <img src="<?php echo  isFileExist(CDN_PROPERTY_BANNER_IMG.$arr_property_type['property_banner_image']);?>" width="200" height="100" />
								</div>
                                                            </div>
							   
                                                        </div>
							
							<div class="form-group"><label for="property_list_img" class="col-md-3 control-label">Property Listing Photo</label>

                                                            <div class="col-md-9">
                                                               <input type="file" name="property_list_img" class="form-control" onchange="javascript:previewImg(this,'.previewContainer2')"/>
							     
							       <br/>
							        <div class="previewContainer2">
								    <img src="<?php echo  isFileExist(CDN_PROPERTY_LIST_IMG.$arr_property_type['property_listing_image']);?>" width="100" height="100" />
								</div>
                                                            </div>
							   
                                                        </div>
							
                                                        <div class="col-md-12">
							    <div class="note note-warning"><h3>Meta Data</h3></div>
							</div>
							<div class="form-group"><label for="meta_title" class="col-md-3 control-label">Meta Title</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_title" id="meta_title" class="form-control"><?php echo htmlspecialchars(stripslashes($arr_property_type['meta_title']));?></textarea>
							       <span id="countexact_meta_title"><?php if(isset($arr_property_type['meta_title'])) 
								    {
								       echo  mb_strlen( trim( stripslashes($arr_property_type['meta_title']))) ;
								    }
								    else
								    {
									echo '0';
								    }
								    ?></span><span>/69</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="meta_key" class="col-md-3 control-label">Meta Keyword</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_key" id="meta_key" class="form-control"><?php echo htmlspecialchars(stripslashes($arr_property_type['meta_keyword']));?></textarea>
							       
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="meta_description" class="col-md-3 control-label">Meta Description</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_description" id="meta_description" class="form-control" ><?php echo htmlspecialchars(stripslashes($arr_property_type['meta_description']));?></textarea>
							       <span id="countexact"><?php if(isset($arr_property_type['meta_description'])) 
								{
								   echo  mb_strlen( trim( stripslashes($arr_property_type['meta_description']))) ;
								}
								else
								{
								    echo '0';
								}
								?></span><span>/155</span>
							       
							       
                                                            </div>
                                                        </div>
							
                                                        <div class="form-group"><label for="property_type_status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-9">
                                                                <select name="property_type_status" class="form-control">
                                                                    <option value="Active" <?php echo ($arr_property_type['status']=='Active') ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="Inactive" <?php echo ($arr_property_type['status']=='Inactive') ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
						    
						    <div class="col-md-12">
							    <div class="note note-warning"><h3>Favorite Location</h3></div>
						    </div>
						    
						    <div class="form-group"><label for="beds" class="col-sm-3 control-label">Favorite Location</label>

							<div class="col-sm-9">
							    <div class="input-group">
								<?php
								$city_arr = explode(',',$arr_property_type['fav_cities']);
								if(count($city_list)>0 && is_array($city_list)){ ?>
								<?php foreach($city_list as $city){ ?>
								<div class="col-sm-4">
								<input type="checkbox" name="city_name[]" class="propRomeType" value="<?php echo $city['city_master_id'] ?>" <?php echo (in_array($city['city_master_id'],$city_arr))? 'checked="checked"':'' ;  ?> /> &nbsp;<?php echo $city['city_name'] ?></div>
								<?php } } ?>
							    </div>
							    <!--<i class="alert" id="room_type_msg" style="display: none;">Oops, Select at least one Room Type</i>-->
							</div>
                                                   </div>
						    
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Property Type</button>
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
	    
	    
	//$('#meta_key').keyup(function(){
	//    var value = $(this).val();
	//    var len = parseInt(value.length); 
	//    if(len>199){
	//	$(this).val(value.substring(0,200));
	//	 var len = 200; 
	//    }
	//    $('#countexact_meta_key').text(len);
	//});
	
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
    
     
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->