 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<style type="text/css">
.live{
    background: rgba(115, 227, 25, 0.08);
}

.not-live{
    background: rgba(234, 47, 47, 0.1);
}
 </style>

<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Team Member</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       <li><i class="fa  fa-group"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Team</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-group"></i>&nbsp;&nbsp;<a href="<?php //echo $show_all;?>" >Add</a></li>
        
           
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
			    <div class="row">
				<form action="" method="post" enctype="multipart/form-data" >
				    <input type="hidden" name="action" value="Process"/>
					<div class="col-lg-12">
						       <div class="panel panel-yellow portlet box portlet-pink">
							   
							   
							   <div class="portlet-header">
							   <div class="caption">Add Team Member</div>
							   <div class="tools">
							       <i class="fa fa-chevron-up"></i>
							   </div>
							   </div>
							   
							   <div class="portlet-body panel-body pan">
							       
								   <div class="form-body pal">
								       
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="sales_price_from" class="col-md-3 control-label" >Team Type</label>
										   
										   <div class="col-md-7 input-icon">
										       <select name="team_type" id="team_type" class="form-control"  data-required="true">
											   <option value="Management Team">Management Team</option>
											   <option value="Business">Business</option>
											   <option value="Engineering">Engineering</option>
											   <option value="Operations">Operations</option>
										       </select>		
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Member Name <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" data-required="true">		
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Member Designation <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control" name="designation" id="designation" value="<?php echo set_value('designation');?>" data-required="true">
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Member Description <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <textarea class="ckeditor form-control" name="description" id="description" data-required="true"><?php echo set_value('description');?></textarea>				    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="link_of_facebook" class="col-md-3 control-label" >
										       Link of Facebook
										   </label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control " title="Please enter your full URL. Ex- https://www.facebook.com/livephuket" name="link_of_facebook" id="link_of_facebook" value="<?php echo set_value('link_of_facebook');?>" >
										       <br/>
										       <em style="font-size:11px;">(Please enter your full URL. Ex- https://www.facebook.com/livephuket)</em>
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="link_of_facebook" class="col-md-3 control-label" >Link of Twitter</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control" title="Please enter your full URL. Ex- https://www.twitter.com/livephuket" name="link_of_twitter" id="link_of_twitter" value="<?php echo set_value('link_of_twitter');?>">
										       <br/>
										       <em style="font-size:11px;">(Please enter your full URL. Ex- https://www.twitter.com/livephuket)</em>
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="link_of_facebook" class="col-md-3 control-label" >
										       Upload Picture
											
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <input type="file" title="maximum image size 1200 x 800 | extension must be .jpg, .jpeg, .gif, .png" name="user_image" id="user_image" class="form-control" />
										       <br/>
										       <em style="font-size:11px;">(maximum image size 1200 x 800 | extension must be .jpg, .jpeg, .gif, .png)</em>
										   </div>
									       </div>
									   </div>
								       </div>
								       
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="link_of_facebook" class="col-md-3 control-label" >
										       Order
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <select name="team_order" id="team_order" class="form-control" >
											       <option value="99">Select Any</option>
											   <?php for($i=1;$i<=10;$i++){?>
											       <option value="<?php echo $i;?>"><?php echo $i;?></option>
											   <?php }?>
										       </select>	
										   </div>
									       </div>
									   </div>
								       </div>
								       
								   </div>
							   </div>
						       </div>
					</div>
				       <div class="col-md-12">
					   <div class="action text-right">
						      <button type="submit" name="previous" value="Previous" class="btn btn-primary"><i class="fa fa-pencil"></i> Add</button>
						      <label class="btn btn-info" onclick="javascript:location.href='<?php echo base_url()."team/" ?>'">Return <i class="fa fa-arrow-circle-o-right mlx"></i></label>
					  </div>
				       </div>
				</form>
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
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->