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
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
			    <div class="row">
				<form action="" class="form-validate form-horizontal form-seperated " method="post" enctype="multipart/form-data" id="add_form">
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
										     <select data-required="true" class="form-control" id="team_type" name="team_type">
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
										       <input type="text" class="form-control required" name="name" id="name" value="<?php echo set_value('name'); ?>" data-required="true">		
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Member Designation <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control required" name="designation" id="designation" value="<?php echo set_value('designation');?>" data-required="true">
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Member Description <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <textarea class="ckeditor form-control required" name="description" id="description" data-required="true"><?php echo set_value('description');?></textarea>				    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="destination" class="col-md-3 control-label" >Facebook Link</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" name="fb_link" id="fb_link" class="form-control" data-required="true" value="<?php echo set_value('fb_link');?>" />		    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="best-travel" class="col-md-3 control-label" > Twitter Link</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" name="twitter_link" class="form-control" id="twitter_link" data-required="true" value="<?php echo set_value('twitter_link');?>" />				    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="top-travel" class="col-md-3 control-label" >Google+ Link</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" name="google_link" class="form-control" id="google_link" data-required="true" value="<?php echo set_value('google_link');?>">				    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="where-next" class="col-md-3 control-label" >Instagram Link</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" name="instragram_link" id="instragram_link" data-required="true" class="form-control" value="<?php echo set_value('instragram_link');?>" >				    
										   </div>
									       </div>
									   </div>
								       </div>
								       
									<br class="spacer" />
									
									<div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="where-next" class="col-md-3 control-label" >Linkedin Link</label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" name="linkedin_link" id="linkedin_link" data-required="true" class="form-control" value="<?php echo set_value('linkedin_link');?>" >				    
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
										       <em style="font-size:11px;">(image extension must be .jpg, .jpeg, .gif, .png)</em>
										   </div>
									       </div>
									   </div>
								       </div>

								       <br class="spacer" />
								       
								       	<div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="order" class="col-md-3 control-label" >
										       Order
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <select name="team_order" id="team_order" class="form-control" >
											       <option value="-99">Select Any</option>
											   <?php for($i=1;$i<=$team_member_count;$i++){
											   ?>
											       <option value="<?php echo $i;?>" <?php if($team_member_count == $i){?>selected<?php } ?>><?php echo $i;?></option>
											   <?php }?>
										       </select>	
										   </div>
									       </div>
									   </div>
								       </div>
								       
								       <br class="spacer" />
								       
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="status" class="col-md-3 control-label" >
										       Status
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <select name="status" id="status" class="form-control">
											   <option value="active" >Active</option>
											   <option value="inactive" >Inactive</option>
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
    
    function thumbviewshow() {
	var thumbresult = ($('#thumbshow').val());
	if (thumbresult == "Yes")
	{
	    $('.thumblisting').css('display','block');
	    if($('.listing').css('display') == 'block')
	    {
		$('.listing').css('display','none');
	    }
	}
	if (thumbresult == "No")
	{
	    $('.listing').css('display','block');
	    if($('.thumblisting').css('display') == 'block')
	    {
		$('.thumblisting').css('display','none');
	    }
	}
    }
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->