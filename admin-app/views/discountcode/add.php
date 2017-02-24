 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Discount code</div>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add Discount Code </div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="form1">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
  
                                                        
                                                        <div class="form-group"><label for="code" class="col-md-3 control-label">Discount Code<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="code" type="text" placeholder="" class="form-control required" id="code" value="<?php echo set_value('code'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                      
                                                        <div class="form-group"><label for="amount_percent" class="col-md-3 control-label">Amount/Percentage<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="amount_percent" type="text" placeholder="" class="form-control required digits" id="amount_percent" value="<?php echo set_value('amount_percent'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        
							<div class="form-group"><label for="type" class="col-md-3 control-label">Discount Type<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <select name="type" class="form-control required">
								    <option value="">Select</option>
                                                                    <option value="Fixed" >Fixed</option>
                                                                    <option value="Percentage" >Percentage</option>
                                                                </select>
                                                            </div>
                                                        </div>
							                                                      
						       
                                                        <div class="form-group"><label for="status" class="col-md-3 control-label">Status<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <select name="status" class="form-control">
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
							
							
						    <div class="form-group"><label for="property_type_ids" class="col-sm-3 control-label">Property Type<span class='require'>*</span></label>
	
							    <div class="col-sm-9">
								<div class="input-group">
								    <?php if(count($property_type)>0){ ?>
								    <?php $flg=0; foreach($property_type as $list){ ?>
								    
								    <?php if($flg==0){?>
								    <div class="col-sm-4">
									<input type="checkbox" name="property_type_all" id="property_type_all" class="requiredInput" value="All" /> &nbsp;All
								    </div>								    
								    <?php }?>
								    
								    <div class="col-sm-4">
								    <input type="checkbox" name="property_type_ids[]" class="propPropertyType requiredInput" value="<?php echo $list['property_type_id'] ?>" /> &nbsp;<?php echo $list['property_type_name'] ?></div>
								    <?php $flg=1; } } ?>
								    <i class="alert alert-hide rType">Oops, Select at Least one Property Type</i>
								</div>
								
							    </div>
							</div>
						    
<!--						    <div class="form-group"><label for="room_type_ids" class="col-sm-3 control-label">Room Type<span class='require'>*</span></label>
	
							    <div class="col-sm-9">
								<div class="input-group">
								    <?php if(count($roomtype_list)>0){ ?>
								    <?php $flg=0; foreach($roomtype_list as $room){ ?>

								    <?php if($flg==0){?>
								    <div class="col-sm-4">
									<input type="checkbox" name="room_type_all" id="room_type_all" class="requiredInput" value="All" /> &nbsp;All
								    </div>								    
								    <?php }?>
								    
								    <div class="col-sm-4">
								    <input type="checkbox" name="room_type_ids[]" class="propRomeType requiredInput" value="<?php echo $room['roomtype_id'] ?>" /> &nbsp;<?php echo $room['roomtype_name'] ?></div>
								    <?php $flg=1;} } ?>
								    <i class="alert alert-hide rType">Oops, Select at Least one Room Type</i>
								</div>
								
							    </div>
							</div>
-->							

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="button" id="submitBtn" class="btn btn-primary">Add Discount Code </button>
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
	    
	   $('#property_type_all').click(function(){
	    if ($('#property_type_all').prop('checked')==true) {
		$('.propPropertyType').prop('checked', true);
	    }else{
		$('.propPropertyType').prop('checked', false);
	    }
	    
	   })
	   	   
	//   $('#room_type_all').click(function(){
	//    if ($('#room_type_all').prop('checked')==true) {
	//	$('.propRomeType').prop('checked', true);
	//    }else{
	//	$('.propRomeType').prop('checked', false);
	//    }
	//        
	//   });
	   
	    $('.propPropertyType').click(function(){
		if ($('.propPropertyType').is(':not(:checked)')){
		    $('#property_type_all').prop('checked', false);
		}			
	    })
	   
	//    $('.propRomeType').click(function(){
	//	if ($('.propRomeType').is(':not(:checked)')){
	//	    $('#room_type_all').prop('checked', false);
	//	}			
	//    })
	    
	   $('#submitBtn').click(function(){
	    err =0;
	    
	    if (!$('.propPropertyType').is(':checked')){
		err =1;
		$('.pType').show();
	    }else{
		$('.pType').hide();
	    }
	    
	//    if (!$('.propRomeType').is(':checked')){
	//	err =1;
	//	$('.rType').show();
	//    }else{
	//	$('.rType').hide();
	//    }	    

	    if (err!=1){
		$('#form1').submit();
	    }
	    else
	    {
		alert('Please select property type');
		return false;
	    }
	    
	      
	   })
	   

	   
	})
    </script>    

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->