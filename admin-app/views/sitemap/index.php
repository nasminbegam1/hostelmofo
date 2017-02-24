 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">SiteMap</div>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-green">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Site Map Generator</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
						     
						    <div class="col-md-6">
								(Sitemap last updated on <strong><?php echo isset($last_updated)?$last_updated:'' ?></strong> And Total Links <strong><?php echo $total_links ?></strong>)
						    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                         
                                                        
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">Sitemap Url</label>
							    

                                                            <div class="col-md-4">
                                                                
                                                               <span><a href="<?php echo FRONTEND_URL."sitemap.xml" ?>" target="_blank"><?php echo FRONTEND_URL."sitemap.xml" ?></a> </span>
                                                            </div>
							    
							    
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">Modified date</label>

                                                            <div class="col-md-4">
                                                                
                                                                <select name="modified_date_type" class="form-control" id="modified_date_type">
                                                                        <option value="0">Do not include</option>
                                                                        <option value="1">Server response date</option>
                                                                        <option value="2" selected="selected">Todays date</option>
                                                                        <option value="3">Custom date</option>
                                                                </select>
								<br>
								<input type="text" name="modified_date" id="modified_date" class="form-control" placeholder=mm/dd/yyyy" readonly="readonly" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Change frequency </label>

                                                            <div class="col-md-4">
                                                                
                                                                    
                                                                    <select name="change_frequency" class="form-control">
                                                                        <option value="">None</option>
                                                                        <option value="Always">Always</option>
                                                                        <option value="Hourly">Hourly</option>
                                                                        <option value="Daily" selected="selected">Daily</option>
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
                                                                    <option value="1.0" selected="selected">1.0</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </div>
							
							<!--<div class="form-group"><label for="inputPhoneNo" class="col-md-3 control-label">Misc Links</label>

                                                            <div class="col-md-6">
								(e.g. http://www.link1.com, http://www.link2.com)
                                                                <textarea name="links" class="form-control" cols="40" rows="15"><?php //echo  isset($sitemap_misc_links)? $sitemap_misc_links:''; ?></textarea>
								
                                                            </div>
                                                        </div>-->

                                                        

                                                        
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

    var  succ_msg = '<?php echo isset($succmsg)? $succmsg:''; ?>';
    var  err_msg = '<?php echo isset($errmsg)? $errmsg:''; ?>';
    
    $("#modified_date").hide();
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
    
     $(window).load(function(){
	
    
    $("#modified_date").datepicker({
	changeMonth: true,
	changeYear: true
    });
    
    
    $("#modified_date_type").change(function(){
       if($(this).val()=="3"){
          $("#modified_date").show();
       }else{
          $("#modified_date").hide();
       }
    });
    
});
</script>