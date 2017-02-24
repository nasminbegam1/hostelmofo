 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Provines</div>
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
                                                    <div class="caption">Edit Province</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="province_name" class="col-md-3 control-label">Province Name<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="province_name" type="text" placeholder="" class="form-control required" id="province_name" value="<?php echo stripslashes($arr_provines['province_name']);?>"/>
                                                                
                                                            </div>
                                                        </div>
							 <div class="form-group"><label for="province_description" class="col-md-3 control-label">Description</label>

                                                            <div class="col-md-9">
                                                               <textarea name="province_description" rows="6" class="ckeditor form-control" ><?php echo stripslashes($arr_provines['province_description']);?></textarea>
                                                            </div>
                                                        </div>
							 <div class="form-group"><label for="meta_description" class="col-md-3 control-label">Province Banner Photo</label>

                                                            <div class="col-md-9">
                                                               <input type="file" name="province_img" class="form-control" onchange="javascript:previewImg(this,'.previewContainer1')"/>
							       <!--<i style="color: #E74C3C">Photo min-width : 800 & min-height : 600</i>-->
							       <br/>
							        <div class="previewContainer1">
								    <img src="<?php echo  isFileExist(CDN_PROVINCE_BIG_IMG.$arr_provines['banner_image_name']);?>" width="200" height="100" />
								</div>
                                                            </div>
							   
                                                        </div>
							
							<div class="form-group"><label for="meta_description" class="col-md-3 control-label">Province Listing Photo</label>

                                                            <div class="col-md-9">
                                                               <input type="file" name="province_list_img" class="form-control" onchange="javascript:previewImg(this,'.previewContainer2')"/>
							     
							       <br/>
							        <div class="previewContainer2">
								    <img src="<?php echo  isFileExist(CDN_PROVINCE_LIST_IMG.$arr_provines['listing_image_name']);?>" width="100" height="100" />
								</div>
                                                            </div>
							   
                                                        </div>
							<div class="col-md-12">
							    <div class="note note-warning"><h3>Meta Data</h3></div>
							</div>
                                                        <div class="form-group"><label for="meta_title" class="col-md-3 control-label">Meta Title</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_title" id="meta_title" class="form-control"><?php echo htmlspecialchars(stripslashes($arr_provines['meta_title']));?></textarea>
							       <span id="countexact_meta_title"><?php if(isset($arr_provines['meta_title'])) 
								    {
								       echo  mb_strlen( trim( stripslashes($arr_provines['meta_title']))) ;
								    }
								    else
								    {
									echo '0';
								    }
								    ?></span><span>/70</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="meta_key" class="col-md-3 control-label">Meta Keyword</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_key" class="form-control"><?php echo htmlspecialchars(stripslashes($arr_provines['meta_keyword']));?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="meta_description" class="col-md-3 control-label">Meta Description</label>

                                                            <div class="col-md-9">
                                                               <textarea name="meta_description" id="meta_description" class="form-control" ><?php echo htmlspecialchars(stripslashes($arr_provines['meta_description']));?></textarea>
							        <span id="countexact"><?php if(isset($arr_provines['meta_description'])) 
								{
								   echo  mb_strlen( trim( stripslashes($arr_provines['meta_description']))) ;
								}
								else
								{
								    echo '0';
								}
								?></span><span>/155</span>
                                                            </div>
                                                        </div>
							
                                                       


							
<!--                                                        <div class="form-group"><label for="province_status" class="col-md-3 control-label">Status</label>

                                                            <div class="col-md-9">
                                                                <select name="province_status" class="form-control">
                                                                    <option value="Active" <?php echo ($arr_provines['status']=='Active') ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="Inactive" <?php echo ($arr_provines['status']=='Inactive') ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
-->
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Province</button>
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
	    
	$('#meta_title').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>69){
		$(this).val(value.substring(0,70));
		 var len = 70; 
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