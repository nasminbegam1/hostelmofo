<?php //pr($arr_property_rent,1);?>
<? if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="main_content_outer" class="clearfix">
<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BACKEND_JS_PATH;?>jquery-ui.multidatespicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH;?>ie/jquery.placeholder.js"></script>

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<script src="<?php echo BACKEND_JS_PATH; ?>lib/iCheck/jquery.icheck.min.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH;?>todc-bootstrap.min.css">

<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH;?>jquery-ui.css">
<style>
  .ui-datepicker{
    background:#F2F2F2;
    /*border: 1px solid #000;*/
    box-shadow:0px 0px 3px #000;
  }
  #manual_calander2 .ui-datepicker-inline{
      clear:both;
      margin: 0 0 10px;
}
</style>
<script>
$(function() {
    $('input, textarea').placeholder();
});
</script>
<script>
    var date="";
    var removeDate=new Array();
    var date_arr=new Array();
    var date_arr=new Array(<?php echo $restricted_date;?>); // for edit
    var start_date="", end_date="";var selectCount=0;

    
    $(function(){
      var currYearDate = '<?php echo date('1/1/Y');?>';
      
      if (date_arr != '')
      {
	$("#manual_calander2").multiDatesPicker({
                numberOfMonths:[4,3],
                stepMonths:12,
		defaultDate:currYearDate,
		addDates:date_arr
               
	});
      }
      else
      {
	$("#manual_calander2").multiDatesPicker({
                numberOfMonths:[4,3],
                stepMonths:12,
		defaultDate:currYearDate
               
	});
      }
      
      
      $("#add_cal").on('click',function(e){
	   var html=$("#text_box_cal p.text_box:first-of-type").html();
	   $("#text_box_cal").prepend("<p class='text_box'>"+html+"</p>");
	   $("#text_box_cal").find(".datepicker").removeClass("hasDatepicker");
	   
     });
    $('body').on('focus',".from", function(){
        $(this).datepicker({
           dateFormat: 'mm/dd/yy'
        });
    });
    
     $('body').on('focus',".to", function(){
        $(this).datepicker({
           dateFormat: 'mm/dd/yy',
	   beforeShowDay:function(date){
	     var d=new Date($(this).parent().find(".from").val());
	     if(d >= date ){
	      return [false, ''];
	     }
	      return [true, ''];
	   }
        });
    });
               
        $("#view_cal").click(function(){
            var total_dates	=new Array();
            $("#text_box_cal").find("p.text_box").each(function(){
               
                var start 	= new Date($(this).find(".from").val()),
                    end 	= new Date($(this).find(".to").val()),
                    currentDate = start
                ;
                while (currentDate <= end) {
                    total_dates.push(new Date(currentDate));
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            });
            $("#manual_calander2").multiDatesPicker("addDates", total_dates);
            
        });
    })
    </script>

<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
	<?php } ?>
	<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
	<?php }
	//pr($arr_property_rent);
	?>

    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
		    <?= $tabs; ?>
                    <?php $page = $this->uri->segment(4,0); ?>
                   
                    <div class="clear"></div>
			    
                    		<div id="property_information_fieldset" class="property_tag_class">
				<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>rentals/deal/<?php echo $arr_property['property_id'].'/'.$page; ?>/">
				<input type="hidden" name="action" value="Process">
				
				<fieldset>

                                <div class="row basic_info">
                                    <div class="col-sm-12">
					<div class="section-one panel panel-default panelOne" >
					    <div class="panel-heading">
						 <h2 class="panel-title"><strong>Deal</strong> </h2>
					    </div>

					    <div class="col-sm-6">
						<label for="property_name" >No of days
						    <span class="label label-info  hint--right hint--info" data-hint="The number of days for deal"><strong>?</strong></span>
						</label>
						<input name="no_of_days" id="no_of_days" value="<?php echo $arr_property_rent['no_of_days'];?>" type="text"  class="form-control " />
					    </div>
					    <br class="spacer" />
					     <div class="col-sm-6">
						<label for="property_name" >Discount Rate %
						    <span class="label label-info  hint--right hint--info" data-hint="The discount rate for deal"><strong>?</strong></span>
						</label>
					        <input name="discount_rate" id="discount_rate" value="<?php echo $arr_property_rent['discount_rate'];?>" type="text" class="form-control " />
					    </div>
					    
					    <br class="spacer" />
					    <div class="col-sm-6">
						<label for="property_name" >Expiry Option
						    <span class="label label-info  hint--right hint--info" data-hint="Expirary date is when this discount stops happening"><strong>?</strong></span>
						</label>
						<?php
						$display_option = 'none;';
						
						if($arr_property_rent['deal_expiry_option'] == "unlimited")
						{
						    $display_option = 'none;';
						}
						else if($arr_property_rent['deal_expiry_option'] == "limited")
						{
						    $display_option = 'block;';
						}
						else
						{
						    $display_option = 'none;';
						}
						?>
						<select name="deal_expiry_option" id="deal_expiry_option" class="form-control">
						    <option value="unlimited" <?php if($arr_property_rent['deal_expiry_option'] == "unlimited")echo "selected";?>>Unlimited</option>
						    <option value="limited" <?php if($arr_property_rent['deal_expiry_option'] == "limited")echo "selected";?>>Limited</option>
						</select>
						<div id="restrict_date_calendar" style="display:<?php echo $display_option;?>">
						    <div id="text_box_cal">
							<p class="text_box">
							    <input type="textbox" class="from datepicker" placeholder="from"/>
							    <input type="textbox" class="to datepicker" placeholder="to"/>
							</p>
							<p>
							    <input type="button" id="add_cal" value="Add More" class="dealBtn" />
							    <input type="button" id="view_cal" value="View" class="dealBtn" />
							</p>
						    </div>
						    <div id="manual_calander2" data-item="multiple date"></div>
						</div>
					    </div>
					    
					    <br class="spacer" />
					    <div class="col-sm-6">
						<label for="property_name" >Deal Status
						    <span class="label label-info  hint--right hint--info" data-hint="Active or Inactive status for Deal"><strong>?</strong></span>
						</label>
						<select name="deal_status" id="deal_status" class="form-control">
						    <option value="active" <?php if($arr_property_rent['deal_status']=="active")echo "selected";?>>Active</option>
						    <option value="inactive" <?php if($arr_property_rent['deal_status']=="inactive")echo "selected";?>>Inactive</option>
						</select>
					    </div>
					    
					    <br class="spacer" />
					    <br class="spacer" />
					    
					     <div class="save_div_class">
						<input type="hidden" autocomplete='off' name="frontend_url" id="frontend_url" value="<?php echo FRONTEND_URL; ?>" />
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset">Save & Continue</button>
						 <a class="btn btn-default frm_step_next no-cache-redirect" href="<?php echo BACKEND_URL.'rentals/ical_import/'.$arr_property['property_id'].'/'.$page;  ?>/" > < Back</a>
					    </div>

					</div> <!-- Section One -->
					
                                        
                                    </div>
				</div>
                                <input type="hidden" name="restricted_date" id="restricted_date" value="">
                                </fieldset>
				</form>
				</div>			</div>
                            
                            
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
			</div>
                        </div>	
            		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>

<script>
    $("#deal_expiry_option").change(function(){
	if ($(this).val() == 'limited')
	{
	    $("#restrict_date_calendar").show();
	}
	else
	{
	    $("#restrict_date_calendar").hide();
	}
    });
    
    $("#btn_property_image_fieldset").click(function(){
	var date	= '';
	if($('#deal_expiry_option').val() == 'unlimited')
	{
	    $("#restricted_date").val('');
	}
	else
	{
	    $('.ui-state-default').each(function(){
	       if($(this).parent().hasClass('ui-state-highlight'))
	       {
		    var dd 		= $(this).html();
		    var mm 		= parseInt(parseInt($(this).parent().attr('data-month')) + 1);
		    var yy 		= $(this).parent().attr('data-year');
		    if (dd.length == 1){
			dd = '0' + dd;
		    }
		    if (date == '') {
			date = yy + '-' + mm + '-' + dd;
		    } else {
			date = date + '|' + yy + '-' + mm + '-' + dd;
		    }
		    
		}
	    });
	    $("#restricted_date").val(date);
	}

    });
</script>