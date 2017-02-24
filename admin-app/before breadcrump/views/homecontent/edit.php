 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Home Content</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        
        <li class="active">&nbsp;&nbsp;<a href="<?php echo BACKEND_URL."homecontent/index/".$page."/" ?>" ><i class="fa fa-home"></i> &nbsp;Home Content&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</a></li>
        <li class="active">&nbsp;&nbsp;<a href="<?php echo $edit_link; ?>" >Edit</a></li>
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
                                        
                                       
                                        <?php if($errmsg){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Home Content</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group">
							    <label for="cms_title" class="col-md-3 control-label">Content Title</label>

                                                            <div class="col-md-4">
                                                               <input type="text" class="form-control" name="home_title" id="home_title" value="<?php echo stripslashes($arr_homecontent['title']);?>" data-required="true">
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="form-group">
							    <label for="content" class="col-md-3 control-label">Content</label>
                                                            <div class="col-md-9">
								<textarea  name="home_content"   class="ckeditor form-control"><?php echo stripslashes($arr_homecontent['content']);?></textarea>
                                                               
                                                            </div>
                                                        </div>

                                               
                                            </div>     

                                        </div>
					    
                                    </div>
				    <div class="form-actions text-right pal">
						<button type="submit" class="btn btn-primary">Edit Content</button>
						&nbsp;
						<button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."homecontent/index/".$page."/" ?>'">Return</button>
				    </div>
				     </form>
                                </div>
                            </div>
         </div>
        </div>
        </div>
        </div>
        
        
<script>
       /**** session succ/err msg display *****/
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