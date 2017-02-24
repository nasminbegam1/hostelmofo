 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Currency</div>
    </div>
   <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add Currency Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="country_name" class="col-md-3 control-label">Country name<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <select class="form-control required" name ="country_name" id="country_name" data-required="true">
								    <option value=''>Select Country</option>
								    <?php
								    foreach($arr_country_name as $arr_country_names)
								    {
								       ?>
								       <option value="<?php  echo $arr_country_names['countryCode'] ?>"><?php  echo $arr_country_names['countryName'] ?></option>
								       <?php  
								    }
								      ?>
								    
								</select>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="country_code" class="col-md-3 control-label">Country code<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="country_code" id="country_code" value="" readonly="readonly" class="form-control">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_code" class="col-md-3 control-label">Currency code<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_code" id="currency_code" value="" readonly="readonly" class="form-control" >
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_symbol" class="col-md-3 control-label">Currency symbol<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_symbol" id="currency_symbol" value="" readonly="readonly" class="form-control">
                                                            </div>
                                                        </div>
							
							
							<div class="form-group"><label for="currency_name" class="col-md-3 control-label">Currency Name<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_name" id="currency_name" value=""  class="form-control">
                                                            </div>
                                                        </div>
							
							
							
							
							<div class="form-group"><label for="advoption" class="col-md-3 control-label"><a href="javascript:void(0);" onclick="return togglehiddenDivs();" style="color: blue;">Advanced option</a><span class='require'></span></label>

                                                        </div>
							
							<div class="form-group" id="ratediv" style="display:none"><label for="sales_price" class="col-md-3 control-label">AUD Rate<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="manualrate" id="manualrate" value=""  class="form-control">
                                                            </div>
                                                        </div>
							
											
							<div class="form-group" id="updationmodediv" style="display:none"><label for="sales_price" class="col-md-3 control-label">Select rate updation mode<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <label>
								    <input type="radio" class="form-control " name="updationmode" id="updationmode" value="m" >
									&nbsp;Manual&nbsp;
								</label>
								<label>
								    <input type="radio" class="form-control " name="updationmode" id="updationmode" value="a" checked="checked">
									&nbsp;Automatic&nbsp;
								</label>    
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
			    url: "<?php echo BACKEND_URL.'currency/get_country_currency/'; ?>",
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