<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">View Currency Master</div>
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
                                                    <div class="caption">View Currency Master</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="country_name" class="col-md-3 control-label"><h5><b>Country name</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                              <?php
					 foreach($arr_country_name as $arr_country_names)
					 {
					    if($countryCurrencyDetails['country_code']==$arr_country_names['countryCode'])
					    {?>
					   
					      <h5><?php echo $arr_country_names['countryName'] ;break;?></h5>
					 <?php
					    }
					    
					 }
					   ?>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="country_code" class="col-md-3 control-label"><h5><b>Country code</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <h5><?php echo $countryCurrencyDetails['country_code']; ?></h5>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_code" class="col-md-3 control-label"><h5><b>Currency code</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <h5><?php echo $countryCurrencyDetails['currency_code']; ?></h5>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="currency_symbol" class="col-md-3 control-label"><h5><b>Currency symbol</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <h5><?php echo $countryCurrencyDetails['country_currency_symbol']; ?></h5>
                                                            </div>
                                                        </div>
							
							
							<div class="form-group"><label for="currency_name" class="col-md-3 control-label"><h5><b>THB Rate</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                                <h5><?php echo $countryCurrencyDetails['currency_rate']; ?></h5>
                                                            </div>
                                                        </div>
							
							
							<div class="form-group"><label for="sales_price" class="col-md-3 control-label"><h5><b>Selected rate updation mode</b></h5><span class='require'></span></label>

                                                            <div class="col-md-4">
                                                              <?php
							    if($countryCurrencyDetails['rate_updation_mode']== 1)
							    {
							    ?>   
								    <h5><?php echo 'Automatic'; ?></h5>
								
							    <?php
							    }
							    else
							    {
							    ?>
								<h5><?php echo 'Manual'; ?></h5>
							    <?php
							    }
							    ?>
                                                            </div>
                                                        </div>
							
                                                        
                                                    <div class="form-actions text-right pal">
							
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