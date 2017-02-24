 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add SEO Sales Landing <?php echo ucfirst($this->uri->segment(3,0));?></div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <!--<li><i class="fa fa-picture-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">CMS</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
        <li class="active">&nbsp;&nbsp;<a href="javacript:void()" ><i class="fa fa-info-circle"></i> &nbsp;SEO Sales Landing Page&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</a></li>
        <li class="active">&nbsp;&nbsp;<a href="<?php echo $add_link; ?>" >Add <?php echo ucfirst($this->uri->segment(3,0));?></a></li>
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
                                
				  <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add SEO Sales Landing <?php echo ucfirst($this->uri->segment(3,0));?></div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                
						<input type="hidden" name="action" value="Process">
						 <input type="hidden" readonly class="form-control " name="type" id="property_name" value="<?php echo $this->uri->segment(3);?>" > 
                                                    <div class="form-body">
                                                        <?php if(isset($location_data)){ ?>
                                                        <div class="form-group">
							    <label for="type_id" class="col-md-3 control-label">Select Location<span class="require">*</span></label>

                                                            <div class="col-md-6">
                                                               <select name="type_id" data-required="true"  class="form-control required">
								  <option value="">Please Select Location</option>
							      <?php foreach($location_data as $key=>$row) {?>
								  <option value="<?php  echo $key ?>"><?php echo $row; ?></option>
							      <?php } ?>
							      </select>
                                                            </div>
                                                        </div>
							<?php } ?>
                                                        
                                                        <?php if(isset($region_data)){ ?>
                                                        <div class="form-group">
							    <label for="content" class="col-md-3 control-label">Select Region<span class="require">*</span></label>
                                                            <div class="col-md-6">
								 <select name="type_id" data-required="true" class="form-control required">
								    <option value="">Please Select Region</option>
								<?php foreach($region_data as $key=>$row) {?>
								    <option value="<?php  echo $key ?>"><?php echo $row; ?></option>
								<?php } ?>
								</select>
                                                            </div>
                                                        </div>
							 <?php } ?>
							<div class="form-group">
							    <label for="name" class="col-md-3 control-label">H1 Tag<span class="require">*</span></label>
                                                            <div class="col-md-6">
								  <input type="text"  class="form-control required" data-required="true" name="name" id="property_name" value="<?php echo set_value('name');?>" >
                                                            </div>
                                                        </div>
							<div class="form-group">
							    <label for="page_title" class="col-md-3 control-label">Page Title<span class="require">*</span></label>
                                                            <div class="col-md-6">
								  <input type="text"  class="form-control required" name="page_title"  value="<?php echo set_value('page_title');?>" data-required="true">
                                                            </div>
                                                        </div>
							<div class="form-group">
							    <label for="page_title" class="col-md-3 control-label">Meta  Keyword</label>
                                                            <div class="col-md-6">
								  <textarea class="form-control " rows='7' name="meta_keyword" ><?php echo set_value('meta_keyword');?></textarea>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
							    <label for="page_title" class="col-md-3 control-label">Meta  Description</label>
                                                            <div class="col-md-6">
								  <textarea class="form-control " rows='7' name="meta_description" ><?php echo set_value('meta_description');?></textarea>
                                                            </div>
                                                        </div>
							<div class="form-group">
							    <label for="page_title" class="col-md-3 control-label">Content Text</label>
                                                            <div class="col-md-9">
								  <textarea   class="ckeditor form-control" name="content" ><?php echo set_value('content');?></textarea>
                                                            </div>
                                                        </div>
							
                                            </div>     

                                        </div>
					    
                                    </div>
				    <div class="form-actions text-right pal">
						<button type="submit" class="btn btn-primary">Add</button>
						&nbsp;
						<button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."seo_saleslanding/index/" ?>'">Return</button>
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