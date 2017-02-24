 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Banner</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-picture-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Banner</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;<a href="<?php echo $edit_url;?>" >Edit Banner</a></li>
        
        <?php if(is_array($brdLink) and count($brdLink)>0){ ?>
                <?php foreach($brdLink as $label=>$link){ ?>
                    <li>
                        <i class="fa fa-user"></i>&nbsp;&nbsp;
                        <a href="<?php echo $link ?>"><?php echo $label ; ?></a>
                        <?php if($label != end(array_keys($brdLink))){ ?>
                        <i class="fa fa-angle-right"></i>
                        <?php } ?>
                    </li>
                <?php } ?> 
            <?php  } ?>
        
        
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
                                                    <div class="caption">Edit Banner</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="banner_image" class="col-md-3 control-label">Banner Image<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="banner_image"  id="banner_image" />&nbsp;<strong>[image size maximum 1600x655 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                               <input type="hidden" name="currentFile" value="<?php echo $arr_banner['banner_image'];?>">
                                                               <br />
                                                            <?php if($arr_banner['banner_image']!=''){ ?>
                                                                <img src="<?php echo file_upload_base_url();?>banner/thumb/<?php echo $arr_banner['banner_image'];?>" border="0" width="100" height="100">
                                                             <?php } ?>
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="form-group"><label for="banner_title" class="col-md-3 control-label">Banner Title <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="banner_title" type="text" placeholder="" class="form-control required" id="banner_title" value="<?php echo $arr_banner['banner_title'];?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Banner Link </label>

                                                            <div class="col-md-9">
                                                                <input name="banner_link" type="text" placeholder=" " class="form-control" id="banner_link" value="<?php echo $arr_banner['banner_link'];?>"/>
                                                                
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group"><label for="banner_desc" class="col-md-3 control-label">Banner Content </label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="banner_desc"   class="ckeditor form-control"><?php echo $arr_banner['banner_desc'];?></textarea>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="banner_order" class="col-md-3 control-label">Banner Order</label>

                                                            <div class="col-md-9">
                                                                <input type="number" min="" class="form-control" name="banner_order" id="banner_order" value="<?php echo $arr_banner['banner_order'];?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="banner_status" class="col-md-3 control-label">Banner Status</label>

                                                            <div class="col-md-9">
                                                                <select name="banner_status" class="form-control">
                                                                    <option value="active" <?php echo ($arr_banner['banner_status']=='active') ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="inactive" <?php echo ($arr_banner['banner_status']=='inactive') ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Banner</button>
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
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact1').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->