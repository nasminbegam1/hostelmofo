<style type="text/css">
    .rightPan label {
    line-height: 34px;
}
</style>
<script>
    var date="";
    var removeDate=new Array();
    var date_arr=new Array();
    //var date_arr=new Array(<?php echo $restricted_date;?>); // for edit
    var start_date="", end_date="";var selectCount=0;

    
    $(function(){
      var currYearDate = '<?php echo date('1/1/Y');?>';
      $("#manual_calander2").datepicker({
           dateFormat: 'dd/mm/yy'
      });
      
//      if (date_arr != '')
//      {
//	$("#manual_calander2").multiDatesPicker({
//                numberOfMonths:[4,3],
//                stepMonths:12,
//		defaultDate:currYearDate//,
//		//addDates:date_arr
//               
//	});
//      }
//      else
//      {
//	$("#manual_calander2").multiDatesPicker({
//                numberOfMonths:[4,3],
//                stepMonths:12,
//		defaultDate:currYearDate
//               
//	});
//      }

      
      $("#add_cal").on('click',function(e) {
	//var html=$("#text_box_cal p.text_box:first-of-type").html();
	var hiddenCount = parseInt($("#hidden_count").val()) + 1;
	var html = '<div class="text_box col-md-11" style=" padding-left: 135px;"><div class="col-md-6" style=" padding-bottom: 10px;"><input class="from datepicker form-control" placeholder="from" name="start_date[]" type="textbox" id="from_'+hiddenCount+'"></div><div class="col-md-6" style=" padding-bottom: 10px;"><input class="to datepicker form-control" placeholder="to" name="end_date[]" type="textbox" id="to_'+hiddenCount+'"></div></div>';
	
	$("#hidden_count").val(hiddenCount);
	
	$("#text_box_cal").prepend("<p class='text_box col-md-8'>"+html+"</p>");
	$("#text_box_cal").find(".datepicker").removeClass("hasDatepicker");
	   
     });
    $('body').on('focus',".from", function(){
        $(this).datepicker({
           dateFormat: 'dd/mm/yy'
        });
    });
    
     $('body').on('focus',".to", function(){
        $(this).datepicker({
	    beforeShow : function(){
		$(this).datepicker("option", "minDate",$("#" + $(this).attr('id').replace('to_', 'from_')).val());
	    },
           dateFormat: 'dd/mm/yy',
	   
	   beforeShowDay:function(date){
	    var d		= $(this).parent().find(".from").val(); 
	    //var d		= $("#" + $(this).attr('id')).val();
	    //var cur_date	= $.datepicker.parseDate('dd/mm/yy' ,d);
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

            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Deal</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_rental/index/"?>">Rental Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Deal</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Deal</div>
                                <div class="tools">
                                    <!--<i class="fa fa-chevron-up"></i>-->
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <!--<i class="fa fa-times"></i>-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
				    
                                    <?=$tabs?>
				    <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="portlet box portlet-green">
					    <div class="tab-content">
						<form action="<?php echo $action_url;?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
						<input type="hidden" name="action" value="Process">
						<div id="tab1-wizard-custom-circle" class="tab-pane">
						   <!------general section start-->
						  
						   <br />
						
						<div class="panel panel-orange portlet box portlet-orange">
					
							    <div class="portlet-header">
								<div class="caption">Deal Details</div>
								<div class="tools">
								    <i class="fa fa-chevron-up"></i>
								</div>
							    </div>
	
							
							
						<div class="portlet-body panel-body pan">
						
						    <div class="form-body pal">
							
							<div class="col-md-6">
							    <div class="form-group">
								<label for="property_name" class="col-md-4 control-label" >No of days</label>
								<div class="col-md-8 input-icon">
								   <!-- <i class="fa fa-money"></i>-->
								    <input name="no_of_days" id="no_of_days" value="<?php echo $arr_property_rent['no_of_days'];?>" type="text"  class="form-control " />
								</div>
							    </div>
							</div>
						    
						     <div class="col-md-6">
							<div class="form-group">
							    <label for="property_name" class="col-md-4 control-label">Discount Rate %</label>
							    <div class="col-md-8 input-icon">
								<i class="fa fa-money"></i>
								<input name="discount_rate" id="discount_rate" value="<?php echo $arr_property_rent['discount_rate'];?>" type="text" class="form-control " />
							    </div>
							</div>
						    </div>
						    
						    <div class="col-md-6">
							<div class="form-group">
							    <label for="property_name" class="col-md-4 control-label">Expiry Option</label>
							    <div class="col-md-8 input-icon">
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

							    </div>
							</div>
						    </div>
						   
						    <div id="restrict_date_calendar" style="display:<?php echo $display_option;?>;" class="col-md-7">
						      
							<!--<label for="property_name" class="col-md-3 control-label">ss</label>-->
							<div id="text_box_cal">
							  <div class="text_box col-md-11" style=" padding-left: 135px;">							      
							      
							      <?php $id = 1; if(is_array($restricted_date) && count($restricted_date) > 0) { foreach($restricted_date as $value) { ?>
							      <!--<input value="" type="text"  data-required="true"  class="season_start_date system_record form-control required rental_end_date date_end"  name="season_end_date[]" item="" id="end_date" data-element="" data-year="">-->
							      <div class="col-md-6" style=" padding-bottom: 10px;">
								<input type="textbox" class="from datepicker form-control" placeholder="from" name="start_date[]" value="<?php echo date("d/m/Y", strtotime($value['start_date']));?>" id="from_<?php echo $id;?>" />
							      </div>
							      <div class="col-md-6" style=" padding-bottom: 10px;">
								<input type="textbox" class="to datepicker form-control" placeholder="to" name="end_date[]" value="<?php echo date("d/m/Y", strtotime($value['end_date']));?>" id="to_<?php echo $id;?>"/>
							      </div>
							     
							      <?php $id++;} } else { ?>
							      <div class="col-md-6" style=" padding-bottom: 10px;">
								<input type="textbox" class="from datepicker form-control" placeholder="from" name="start_date[]" value="" id="from_<?php echo $id;?>" />
							      </div>
							      <div class="col-md-6" style=" padding-bottom: 10px;">
								<input type="textbox" class="to datepicker form-control" placeholder="to" name="end_date[]" value="" id="to_<?php echo $id;?>" />
							      </div>
							      <?php } ?>
							      
							  </div>
							  							  
						      </div>
							  <div  class="text_box col-md-11" style=" padding-left: 53px; padding-bottom: 10px;">
							      <label for="property_name" class="col-md-3 control-label"></label>
							      <input type="button" id="add_cal" value="Add More" class="dealBtn btn btn-info" />
							  </div>
							
						      <input type="hidden" id="hidden_count" value="<?php echo $id;?>">
						    </div>			   
						   
						    <div class="col-md-7" style=" padding-left: 40px;">
							<div class="form-group">
							    <label for="property_name" class="col-md-3 control-label">Deal Status</label>
							    <div class="col-md-7 input-icon">
								    <select name="deal_status" id="deal_status" class="form-control">
									<option value="active" <?php if($arr_property_rent['deal_status']=="active")echo "selected";?>>Active</option>
									<option value="disable" <?php if($arr_property_rent['deal_status']=="disable")echo "selected";?>>Inactive</option>
								    </select>
							    </div>
							</div>
						    </div>
						    
						    
						    </div>
						    
						   
						</div>
						 
						<!------aminities section end button-next mlm--->
						</div>
						
						 <div class="action text-right">
							<button type="button" name="submit" value="Previous" class="btn btn-info button-previous" onclick="javascript:window.location.href='<?php echo $previous_url; ?>'">
							    <i class="fa fa-arrow-circle-o-left mrx"></i>
							    Previous
							</button>
							<button type="submit" name="submit" value="Next" class="btn btn-info">
							    Finished
							    <i class="fa fa-arrow-circle-o-right mlx"></i>
							</button>
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
            <!--END CONTENT-->
<script>
       /**** session succ/err msg display *****/
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

    $(function(){
       $(".datepicker").datepicker({ dateFormat: 'dd/mm/yy'});
       //$(".datepicker .end_date").datepicker({
       //   defaultDate:$(".input-daterange .start_date").val()
       // });
    });

</script>
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