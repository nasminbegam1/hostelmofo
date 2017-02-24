 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New CMS Page</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-file"></i>&nbsp;&nbsp;<a href="javascript:void(0)">CMS</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-file"></i>&nbsp;&nbsp;<a href="<?php echo $add_url;?>" >Add New CMS Page</a></li>
        
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
                                                    <div class="caption">Add New CMS page</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">CMS Title <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="cms_title" type="text" placeholder="CMS Title" class="form-control required first_name" id="cms_title" value="<?php echo set_value('cms_title'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputcmscontent" class="col-md-3 control-label">CMS Content <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="cms_content"   class="ckeditor form-control"><?php echo set_value('cms_content');?></textarea>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputmetatitle" class="col-md-3 control-label">Meta Title <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><!--<i class="fa fa-envelope"></i>-->
                                                                   <textarea  name="meta_title" id="meta_title" rows="5" class="form-control required"></textarea>
                                                                   <span id="countexact">0</span><span>/69</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="meta_keys" class="col-md-3 control-label">Meta Keys<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <textarea  name="meta_keys" id="meta_keys" class="form-control required" ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="meta_description" class="col-md-3 control-label">Meta Description<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <textarea  name="meta_description" id="meta_description" class="form-control required"></textarea>
                                                                <span id="countexact1">0</span><span>/155</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_pictute" class="col-md-3 control-label">Feature Image</label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="cms_image" id="cms_image" />&nbsp;<strong>[image size maximum 1200x800 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                            </div>
                                                        </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Page</button>
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