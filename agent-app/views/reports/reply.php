 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
  <?=$property_header?>
    <div class="clearfix"></div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="portlet light">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                      
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Reply</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>



<form action="" class="form-horizontal PropEditForm" id="propertyAddFrm" method="post" enctype="multipart/form-data">
<input type="hidden" name="feedback_id" value="<?php echo $feedbackDtls['feedback_id']; ?>" />
<input type="hidden" name="action" value="Process">
	   <!------ tab start-------->
	   <?=$tabs?>
           <div class="portlet-body panel-body pan">     
	   <div class="tab-content">
		  <div id="tab1-wizard-custom-circle" class="tab-pane active"><!--<h3 class="mbxl">Set up basic details</h3>-->
                        <h5><strong>Send reply</strong></h5>
                        <div class="propertyContent">
                         
			<div class="form-group">
                            <label for="subject" class="col-sm-3 control-label">Subject <span class='require'>*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </span>
                                    <input type="text" value="" placeholder="Subject" class="form-control requiredInput" name="subject" id="subject"/>
                                </div>
                                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-3 control-label">Message <span class='require'>*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </span>
                                    <textarea name="message" id="message" placeholder="Message" class="form-control requiredInput"></textarea>
                                </div>
                                    
                            </div>
                        </div>
                        </div>
			 <div class="propertyContent">
			 <div class="action text-right">
				      <a href="<?php echo base_url().'reports/customer_rating/'.$feedbackDtls['property_id']; ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Return</button></a>
				      
				      <button type="submit" name="save_now" value="Save Now" class="btn btn-info"><i class="fa fa-save"></i> Send</button>
				      </div>
			 </div>
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
   </div>    
  <script>
    $(function(){
      var  succ_msg = '<?php echo $succmsg; ?>';
      var  err_msg = '<?php echo $errmsg; ?>';
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
