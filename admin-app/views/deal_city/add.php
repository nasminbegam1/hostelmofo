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
        <div class="page-title">Add Deal City</div>
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
							   <div class="caption">Add Deal City</div>
							   <div class="tools">
							       <i class="fa fa-chevron-up"></i>
							   </div>
							   </div>
							   
							   <div class="portlet-body panel-body pan">
							       
								   <div class="form-body pal">
								       
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="sales_price_from" class="col-md-3 control-label" >City</label>
										   
										   <div class="col-md-7 input-icon">
										     <select data-required="true" class="form-control" id="city" name="city_id">
											<option value="">--Select City--</option>
											<?php if(count($city_list)>0)
											{
											    foreach($city_list as $city)
											    {
												
											    
											?>
											
											   <option value="<?php  echo $city['city_master_id'];?>"><?php  echo stripslashes($city['city_name']);?></option>
											  <?php }}?>
										       </select>
										      	
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Title <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <input type="text" class="form-control required" name="title" id="title" value="<?php echo set_value('title'); ?>" data-required="true">		
										   </div>
									       </div>
									   </div>
								       </div>
								     
								       <br class="spacer" />
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group"><label for="name" class="col-md-3 control-label" >Description <span class='require'>*</span></label>
										  
										   <div class="col-md-7 input-icon">
										       <textarea class="ckeditor form-control required" name="description" id="description" data-required="true"><?php echo set_value('description');?></textarea>				    
										   </div>
									       </div>
									   </div>
								       </div>
								       <br class="spacer" />
								       
								       <div class="row">
									   <div class="col-md-12">
									       <div class="form-group">
										   <label for="link_of_facebook" class="col-md-3 control-label" >
										      Image
											
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <input type="file" title="maximum image size 1200 x 800 | extension must be .jpg, .jpeg, .gif, .png" name="image" id="image" class="form-control" />
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
										   <label for="status" class="col-md-3 control-label" >
										       Status
										   </label>
										  
										   <div class="col-md-7 input-icon">
									       
										       <select name="status" id="status" class="form-control">
											   <option value="Active" >Active</option>
											   <option value="Inactive" >Inactive</option>
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