<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Currency Master</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-money"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Currency Master</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-money"></i>&nbsp;&nbsp;<a href="<?php echo $edit_link;?>" >
Edit Currency</a></li>
      
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
                                                    <div class="caption">Edit Currency Master Form</div>
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
                                                                <select class="form-control" name ="country_name" id="country_name" data-required="true">
								   <?php
					 foreach($arr_country_name as $arr_country_names)
					 {
					    if($countryCurrencyDetails['country_code']==$arr_country_names['countryCode'])
					    {
					    ?>
					    <option value="<?php  echo $arr_country_names['countryCode'] ?>" selected="selected"><?php  echo $arr_country_names['countryName'] ?></option>
					    <?php
					    }
					    else
					    {
					     ?>
					    <option value="<?php  echo $arr_country_names['countryCode'] ?>" ><?php  echo $arr_country_names['countryName'] ?></option>
					    <?php
					    }
					 }
					   ?>
								    
								</select>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="country_code" class="col-md-3 control-label">Country code<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="country_code" id="country_code" value="<?php echo $countryCurrencyDetails['country_code']; ?>" readonly="readonly" class="form-control ">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_code" class="col-md-3 control-label">Currency code<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_code" id="currency_code" value="<?php echo $countryCurrencyDetails['currency_code']; ?>" readonly="readonly" class="form-control ">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_symbol" class="col-md-3 control-label">Currency symbol<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_symbol" id="currency_symbol" value="<?php echo $countryCurrencyDetails['country_currency_symbol']; ?>" readonly="readonly" class="form-control ">
                                                            </div>
                                                        </div>
							
							
							<div class="form-group"><label for="currency_name" class="col-md-3 control-label">Currency Name<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="currency_name" id="currency_name" value="<?php echo $countryCurrencyDetails['currency_name']; ?>"  class="form-control ">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="rental_price" class="col-md-3 control-label">Rental Max Price<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="rental_price" id="rental_price" value="<?php echo $countryCurrencyDetails['rental_max_price']; ?>"  class="form-control">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="sales_price" class="col-md-3 control-label">Sales Max Price<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                               <input type="text"  name="sales_price" id="sales_price" value="<?php echo $countryCurrencyDetails['sales_max_price']; ?>"  class="form-control">
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="sales_price" class="col-md-3 control-label">Rental Slider Increment<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                               <input type="text"  name="rental_slider_increment" id="rental_slider_increment" value="<?php echo $countryCurrencyDetails['rental_slider_increment']; ?>"  class="form-control">
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="sales_price" class="col-md-3 control-label">Sales Slider Increment<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                               <input type="text"  name="sales_slider_increment" id="sales_slider_increment" value="<?php echo $countryCurrencyDetails['sales_slider_increment']; ?>"  class="form-control">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="advoption" class="col-md-3 control-label"><a href="#" onclick="return togglehiddenDivs();" style="color: blue;">Advanced option</a><span class='require'></span></label>

                                                        </div>
							
							<div class="form-group" id="ratediv" style="display:none"><label for="sales_price" class="col-md-3 control-label">THB Rate<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text"  name="manualrate" id="manualrate" value="<?php echo $countryCurrencyDetails['currency_rate']; ?>" class="form-control " >
                                                            </div>
                                                        </div>
							
							<div class="form-group" id="ratediv_usd" style="display:none"><label for="sales_price" class="col-md-3 control-label">USD Rate<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <input type="text" name="manualrate_usd" id="manualrate_usd" value="<?php echo $countryCurrencyDetails['currency_rate_usd']; ?>" class="form-control " >
                                                            </div>
                                                        </div>
							
							<div class="form-group" id="updationmodediv" style="display:none"><label for="sales_price" class="col-md-3 control-label">Select rate updation mode<span class='require'></span></label>

                                                            <div class="col-md-4">
                                                               <?php
				if($countryCurrencyDetails['rate_updation_mode']== 1)
				{
					
				    
				?>
                                <span><input type="radio" class="form-control " name="updationmode" id="updationmode" value="m" >&nbsp;Manual&nbsp;</span>
				<span><input type="radio" class="form-control " name="updationmode" id="updationmode" value="a" checked="checked">&nbsp;Automatic&nbsp;</span>
				<?php
				}
				else
				{
				   ?>
				   <span><input type="radio" class="form-control " name="updationmode" id="updationmode" value="m" checked="checked" >&nbsp;Manual&nbsp;</span>
				<span><input type="radio" class="form-control " name="updationmode" id="updationmode" value="a" >&nbsp;Automatic&nbsp;</span>
				   
				   <?php
				}
				?>
                                                            </div>
                                                        </div>
							 
                                                        
                                                    <div class="form-actions text-right pal">
							<input type="hidden" name="country" value="" id="country">
                                                        <button type="submit" class="btn btn-primary">Update</button>
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
    $(window).load(function(){
	
	 var OptionName = $('#country_name').children(':selected').text();
	 //alert(OptionName);
	 $('#country').val(OptionName);
	
    }
	
    );
    
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