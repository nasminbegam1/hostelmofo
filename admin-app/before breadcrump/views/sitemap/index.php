 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">SiteMap</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-sitemap"></i>&nbsp;&nbsp;<a href="javascript:void(0)">SiteMap</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-sitemap"></i>&nbsp;&nbsp;<a href="<?php echo $add_url;?>" >Site Map Generator</a></li>
        
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
                                        
				    <?php if(isset($succmsg) && $succmsg != ""){?>
					<div align="center">
					    <div class="nNote nSuccess" style="width: 600px;">
						<p><?php echo stripslashes($succmsg);?></p>
					    </div>
					</div>
				    <?php } ?>
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-green">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Site Map Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                         
                                                        
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">Sitemap Url</label>

                                                            <div class="col-md-4">
                                                                
                                                               <span><a href="<?php echo BACKEND_URL."sitemap.xml" ?>" target="_blank"><?php echo BACKEND_URL."sitemap.xml" ?></a> </span>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">Modified date</label>

                                                            <div class="col-md-4">
                                                                
                                                                <select name="modified_date_type" class="form-control" id="modified_date_type">
                                                                        <option value="0">Do not include</option>
                                                                        <option value="1">Server response date</option>
                                                                        <option value="2">Todays date</option>
                                                                        <option value="3">Custom date</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Change frequency </label>

                                                            <div class="col-md-4">
                                                                
                                                                    
                                                                    <select name="change_frequency" class="form-control">
                                                                        <option value="">None</option>
                                                                        <option value="Always">Always</option>
                                                                        <option value="Hourly">Hourly</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                        <option value="Yearly">Yearly</option>
                                                                        <option value="Never">Never</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputPhoneNo" class="col-md-3 control-label">Default priority</label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    
                                                                <select name="priority" class="form-control">
                                                                    <option value="">None</option>
                                                                    <option value="0.0">0.0</option>
                                                                    <option value="0.1">0.1</option>
                                                                    <option value="0.2">0.2</option>
                                                                    <option value="0.3">0.3</option>
                                                                    <option value="0.4">0.4</option>
                                                                    <option value="0.5">0.5</option>
                                                                    <option value="0.6">0.6</option>
                                                                    <option value="0.7">0.7</option>
                                                                    <option value="0.8">0.8</option>
                                                                    <option value="0.9">0.9</option>
                                                                    <option value="1.0">1.0</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Create</button>
                                                        &nbsp;
                                                        <!--<button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>-->
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
</script>