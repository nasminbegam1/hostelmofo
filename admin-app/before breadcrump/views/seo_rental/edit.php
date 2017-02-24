 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Landing Page Text</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-file-text"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Seo Rental Landing Page Text</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-file-text"></i>&nbsp;&nbsp;<a href="<?php echo $edit_url;?>" >Landing Page Text Edit</a></li>
        
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
                                        
                                       
                                        <?php
                                        error_reporting(0);
                                        if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Landing Page Text</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="banner_image" class="col-md-3 control-label">Type</label>

                                                            <div class="col-md-4">
                                                               <input type="text" readonly class="form-control " name="url" id="url" value="<?php echo strtoupper(stripslashes($landing_page_data['type'])); if(!empty($type_name)){echo ' ('.$type_name .')'; } ?>" >
                                                               
                        
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="form-group"><label for="banner_title" class="col-md-3 control-label">H1 Tag</label>

                                                            <div class="col-md-9">
                                                                <input type="text"  class="form-control " name="name" id="name" value="<?php echo stripslashes($landing_page_data['name']);?>" >
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Page Title<span class='require'>*</span> </label>

                                                            <div class="col-md-9">
                                                                <input type="text"  class="form-control required" name="page_title"  value="<?php echo stripslashes($landing_page_data['page_title']);?>" data-required="true">
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Meta keyword </label>

                                                            <div class="col-md-9">
                                                                
                                                                <textarea class="form-control " rows='7' name="meta_keyword" ><?php echo stripslashes($landing_page_data['meta_keyword']);?></textarea>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Meta  Description</label>

                                                            <div class="col-md-9">
                                                                
                                                                <textarea class="form-control " rows='7' name="meta_description" ><?php echo stripslashes($landing_page_data['meta_description']);?></textarea>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group"><label for="banner_desc" class="col-md-3 control-label">Content Text</label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="content"   class="ckeditor form-control"><?php echo stripslashes($landing_page_data['content']);?></textarea>
                                    
                                                            </div>
                                                        </div>
                                                        

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update</button>
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