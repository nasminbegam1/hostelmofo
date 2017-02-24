<style>
   
</style>
 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Property</div>
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
                                        
                                       
                                        <?php if($errmsg){?>
                                        <div align="center">
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Property Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
					
                                            <div class="portlet-body panel-body pan">
                                            <div id="rootwizard-custom-circle">
					    <form action="<?php echo BACKEND_URL.'property/editimageaction/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
					    <input type="hidden" name="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
					    <input type="hidden" name="action" value="photo"/>
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
					
					<!------- video section start ---->
					
                                        <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn active">
					    <h3 class="mbxl">Set up Video</h3>
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-2 control-label">Video Url</label>

						    <div class="col-md-10">
							<div class="input-group">
							    
							    <span class="input-group-addon"><i class="fa fa-magnet"></i></span>
							    <input type="text" class="form-control" name="property_video_link" id="property_video_link" value="<?php echo stripslashes($property_details['property_master']['property_video_link']) ?>"/>
							</div>
						    </div>
						    </div>
						</div>

						
					    <h3 class="mbxl">Set up Photo</h3>
					     <div class="row fileupload-buttonbar">
						<div class="col-lg-2 addButtonBer"><!--The fileinput-button span is used to style the file input field as button--><span class="btn btn-success fileinput-button addPropertyPhoto"><i class="glyphicon glyphicon-plus"></i>&nbsp;<span>Add files...</span></span>&nbsp; &nbsp;
						<input type="file" name="propertyfiles[]" multiple="multiple" class="propertyfiles" id="propertyfiles" onchange="javascript:attachImages(this)" style="display: none;"/>
						</div>
						<div class="col-lg-1 text-right">
						<img class="loader" id="uploadLoader" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" style="display: none;" />
						</div>
						<!--The global progress state-->
						<div class="col-lg-5 fileupload-progress fade"><!--The global progress bar-->
						    <div role="progressbar" aria-valuemin="0" aria-valuemax="100" class="progress progress-striped active">
							<div style="width: 0%;" class="progress-bar progress-bar-success"></div>
						    </div>
						    <!--The extended global progress state-->
						    <div class="progress-extended"> </div>
						</div>
					    </div>
					    <!--The table listing the files available for upload/download-->
					    <table role="presentation" class="table">
						<tbody class="files prePropertyImages">
						    <?php if(is_array($property_details['property_images']) and count($property_details['property_images'])>0){ foreach($property_details['property_images'] as $img){  ?>
						   <tr class="imageinfo  <?php echo ($img['featured_image']=='Yes')? 'note note-danger':'note note-warning'; ?>" data-item="<?php echo $img['property_image_id'];?>">
							<td  width="12%">
							    <?php if($img['featured_image']=='Yes'){ ?>
							    <input type="radio" name="featured_image" value="<?php echo $img['property_image_id'];?>" data-id = "<?php echo $img['property_image_id'];?>" checked="checked" class="featured_image"  />
							    <?php }else{ ?>
							    <input type="radio" name="featured_image" value="<?php echo $img['property_image_id'];?>" data-property-id = "<?php echo $img['property_id'];?>" data-id = "<?php echo $img['property_image_id'];?>" class="featured_image" title="Make it Feature" />
							    <?php } ?>
							    
							    
							    
							    <img width="80" height="70" src="<?php echo FILE_UPLOAD_URL.'property/small/'.$img['image_name']; ?>"/>
							   
							</td>
							<td width="25%"><input type="text" placeholder="Photo Title" name="image_title[<?php echo $img['property_image_id'];?>]" value="<?php echo stripslashes($img['image_title']); ?>" class="form-control" /></td>
							<td width="25%"><input type="text" placeholder="Photo Alt" name="image_alt[<?php echo $img['property_image_id'];?>]" value="<?php echo stripslashes($img['image_alt']); ?>" class="form-control" /></td>
							<td><?php echo $img['image_name']; ?></td>
							<td>
							    <a  data-img="<?php echo $img['image_name']; ?>" onclick="javascript:return delPreImage('pre',this)" data-features="<?php echo $img['featured_image']; ?>" class="btn btn-danger delPreviewImg"  ><i class="glyphicon glyphicon-trash"></i></a>
							    
							</td>
						   </tr>
						    <?php } } ?>
						</tbody>
						<tbody class="files preiviewPropertyImages"></tbody>
					    </table>
					</div>
				       
				        <!------- video section end ---->
					
					
<!--					 <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn">
					    <h3 class="mbxl">Preview</h3>
					 </div>
-->					<div class="action text-right">
                                            <a href="<?php echo base_url().'property/editfacilitiesaction/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
					    
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
        
  <script>
  
 
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
    
    $('.featured_image').click(function(){
	
	var img_id = $(this).val();
	var property_id = $(this).attr('data-property-id');
	var element = $(this);
	//alert(img_id);
	$.ajax({
	    type:'POST',
	    url:'<?php echo BACKEND_URL."property/is_feature";?>',
	    data:{img_id:img_id,property_id:property_id},
	    success:function(msg){
		$(element).parents('tbody').find('tr').removeClass('note-danger');
		$(element).parents('tbody').find('tr').addClass('note-warning');
		$(element).parents('tr').addClass('note-danger');
		$(element).parents('tr').removeClass('note-warning');
		alert('Image has been featured succefully.');
	    }
	});
	
    });
    
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
