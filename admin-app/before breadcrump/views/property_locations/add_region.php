<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New Region Master</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Region Master</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="<?php echo $add_link;?>" >
Add New Region Master</a></li>
      
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
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-pink">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Region Master Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="location_name" class="col-md-3 control-label">Region Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                 <input type="text" class="form-control required" name="region_name" id="region_name" value="" data-required="true">                                                                
                                                            </div>
                                                        </div>

                                                        </div>
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Region</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
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
    $(document).ready(function(){
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact1').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) + 1; 
	    $('#countexact2').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>