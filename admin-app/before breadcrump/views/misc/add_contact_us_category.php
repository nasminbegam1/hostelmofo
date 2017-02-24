 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add contact us category</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Contact us category</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<a href="<?php echo $add_link; ?>">Add contact us category</a></li>
        
        
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add contact us category Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
							
							<div class="form-group"><label for="country_code" class="col-md-3 control-label">Contact us category name<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control required" name="contact_us_category_name" id="contact_us_category_name" value="">
                                                            </div>
                                                        </div>
							

                                                    <div class="form-actions text-right pal">
							<input type="hidden" name="country" value="" id="country">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script type="text/javascript">
    
    $(function() {
		
                $('#country_name').change(function() {
                    var sel_country = $(this).val();
		    var OptionName = $(this).children(':selected').text();
		    $('#country').val(OptionName);
		    //alert(OptionName);
		    if(sel_country != '')
		    {
			//alert(sel_country);
			$.ajax({
			    type: "POST",
			    url: "<?php echo BACKEND_URL.'autopopulate/get_country_currency/'; ?>",
			    data: 'theOption=' + sel_country,
			    success: function(response) {
				//alert(response);
				var response_array = response.split("#");
				//alert(response_array[1]);
							
				$('#country_code').val(sel_country);
				$('#currency_code').val(response_array[0]);
				$('#currency_symbol').val(response_array[1]);
			    } //END success fn
			}); //END $.ajax
		    }
		    else
		    {
			alert('There is no Country Code');
		    }
                }); //END dropdown change event
            }); //END document.ready
    
    function togglehiddenDivs()
    {
	$('#ratediv').toggle();
	$('#ratediv_usd').toggle();
	$('#updationmodediv').toggle();
	
	
    }
    
    
</script>