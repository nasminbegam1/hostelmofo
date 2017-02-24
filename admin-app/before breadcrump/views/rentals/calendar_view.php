
<link type="text/css" rel="stylesheet" media="all" href="<?php echo BACKEND_CSS_PATH;?>easyscroll.css">
<script type="text/javascript" charset="utf-8" src="<?php echo BACKEND_JS_PATH; ?>mousewheel.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo BACKEND_JS_PATH; ?>easyscroll.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo BACKEND_CSS_PATH;?>custom_calendar.css" />

            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_property/index/"?>">Rental Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Calendar</div>
                                <div class="tools">
                                   
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                     <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                     <?php $page = $this->uri->segment(4,0); ?>
                                </div>
                                <div class="panel panel-pink portlet box portlet-pink">
                                <div class="portlet-header">
                                                    <div class="caption">
                                                        Property Calendar
                                                    </div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                </div>
                                    <div class="tab-content">
                                        <div class="col-lg-12">
                                            <div class="col-sm-9"> 
                                              <div class="rentalPropCurrency" style="text-align: center;">				
                                                <img class="loader" src="<?php echo BACKEND_IMAGE_PATH."icons/loading.gif" ?>"  />
                                                <div id="availCalendar" style="display: inline-block;">
                                              
                                                </div>
                                                
                                                <div id="monthContainer">
                                                    <div class="div_scroll">
                                                        <div style="margin-top:-12px; float:left; height:auto; width:auto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                              <div class="col-sm-3 text-right">    
                                             <div class="main-legend well well-sm">
                                                            <div class="calendar-legend">
                                                                <div class="container_cal_color">
                                                                  <span class="available"></span>
                                                                  <span class="cal_text">Available</span>
                                                                </div>
                                                                <div class="container_cal_color">
                                                                  <span class="unavailable"></span>
                                                                  <span class="cal_text">Not Available</span>
                                                                </div>					    
                                                            </div>
                                                        </div>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                       
                                      
                                    </div>
                                   
                                </div>
                                  <div class="action text-right">
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo $previous_url ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="submit" name="next"  onclick="javascript:go_to('<?php echo $next_url ?>');" value="Next" class="btn btn-info">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT-->
 
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

      var dataString = '';
	var greenDates 	= [];
	var greyDates 	= [];
	var pricePan	= [];
	var minDate	= new Date();
	var maxDate	= new Date();
	var currDate	= new Date();
	var dateAvail	= 0;
    $(function(){
        
        $(document).on('click', '.invokeMonth', function(){
		var id = ($(this).attr('id'));
		var inputbox_id= id.split('-');
		var mon = inputbox_id[0];
		var yr = inputbox_id[1];
		var dt = new Date(yr, mon, '01');
		$( "#availCalendar" ).datepicker( "setDate", dt);
		$('#monthContainer').hide();
	});
	
	$(document).on('click', '.ui-datepicker-title', function(){
		$('#monthContainer').toggle();
	});
        
      var data='<?php  echo $dates; ?>';
      $( "#availCalendar" ).html('');
        $.each(eval(data.replace(/[\r\n]/, "")), function(i, item) {
            dateAvail	= 1;
         
            if (item.avail == '0') {			
                greyDates.push(item.date);
            }		    
            pricePan.push(item);
             // Calculate min date for calendar
            var chkMinDate = item.date;
            chkMinDate = $.datepicker.parseDate('dd/mm/yy', chkMinDate);		    
            chkMinDate	= new Date(chkMinDate);		    
            if (chkMinDate < minDate){
                minDate	= chkMinDate;
            }
            // Calculate max date for calendar
            var chkMaxDate = item.date;
            chkMaxDate = $.datepicker.parseDate('dd/mm/yy', chkMaxDate);		    
            chkMaxDate	= new Date(chkMaxDate);		   
            if (chkMaxDate > maxDate){
                maxDate	= chkMaxDate;
            }
           // alert(maxDate);
        });
        var monthNames 		= [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
         var minDateMonth	= minDate.getMonth();
         var minDateYear		= minDate.getFullYear();
         var maxDateMonth	= maxDate.getMonth();
         var maxDateYear		= maxDate.getFullYear();
         var diffYear 		= (12 * (maxDateYear - minDateYear)) + maxDate.getMonth();
         var strMonth		= '<ul>';
         //alert(minDate.getMonth() + ' | ' + diffYear);		
         for (var i = minDate.getMonth(); i <= diffYear; i++) {
             //alert(monthNames[i%12] + " " + Math.floor(minDateYear+(i/12)));
             strMonth	= strMonth + '<li><a id="'+i%12+'-'+Math.floor(minDateYear+(i/12))+'" href="javascript:void(0);" class="invokeMonth">' + monthNames[i%12] + " " + Math.floor(minDateYear+(i/12)) + '</a></li>';
             //alert(strMonth);
         }
         strMonth	= strMonth + '</ul>';
         $('#monthContainer .div_scroll div').html(strMonth);
         $('#monthContainer .div_scroll').scroll_absolute({arrows:false, mouseWheelSpeed:50});
         $('#monthContainer').hide();
         
         if (dateAvail == 0){
             maxDate	= new Date();
         }
         
         var currDateMonth	= currDate.getMonth();
         if (maxDateMonth < currDateMonth){
             var defaultDate	= currDateMonth-maxDateMonth;
             defaultDate		= '-' . defaultDate;
         }else{
             var defaultDate	= 0;
         }
         

         $( "#availCalendar" ).datepicker({
             dateFormat: "dd/mm/yyyy",		    
             minDate: minDate,
             maxDate: maxDate,
             defaultDate: defaultDate + 'm',
             beforeShow:function(){
                 
             },
             onChangeMonthYear: function (year, month, inst) {
                // $(".loader").show();
                
                 $("#availCalendar select").each(function() {
                     $(this).customSelect();
                 });
                 
             },
             beforeShowDay: function(date) {
                  
                 var class_name = '';
                 var tool_tip = '';
                 var unavailable = unAvailableDate(date);
                 var unavailable_start = unAvailableDateStart(date);
                 var unavailable_end = unAvailableDateEnd(date);
                 if (unavailable) {
                  class_name = 'unavailable-date ';
                  tool_tip = 'Not Available';
                 }
                 if (unavailable_start) {
                         class_name += 'unavailable-start ';
                 }
                 if (unavailable_end) {
                         class_name += 'unavailable-end ';
                 }
                 updateDatePickerCells(date);			
                 dmy = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                 
                 if ($.inArray(dmy, greyDates) > -1) {
                     class_name += 'grey readonly ui-datepicker-unselectable';
                     return [true, class_name, tool_tip ];			    
                 }else{
                     class_name += 'white readonly ui-datepicker-unselectable';
                     return [true, class_name, tool_tip ];
                 }
                 
             }
         });
        $("#availCalendar select").each(function() {
            $(this).customSelect();
        });
        
        $.ajax({
	    type: 'post',
	    data: dataString,
	    url: '<?php echo BACKEND_URL;?>property_rental/ajax_property_availibility/<?php echo $property_id;?>',
	    beforeSend: function(){
		//$( "#availCalendar" ).html('Building Availibility Calendar...');
                //$(".loader").show();
	    },
	    success:function(data){
                //alert(data);
		
            }
        });
    });
      var dates = [<?php echo $unavailableDates; ?>]; // format m/d/y
	  
   var dates_length = dates.length;
   
    function unAvailableDate(date){
	for (var i = 0; i < dates_length; i++) {
            if (new Date(dates[i]).toString() == date.toString()) {
		  return true;
            }		
	}
	return false;
    }
    
     function unAvailableDateStart(date){
	var yesterdayDate =  new Date(date).valueOf() + 1000*3600*24;
	yesterdayDate = new Date(yesterdayDate);
	var check1 = 0;
	for (var i = 0; i < dates_length; i++) {
            if (new Date(dates[i]).toString() == date.toString()) {
		for (var j = 0; j < dates_length; j++) {
		    if (new Date(dates[j]).toString() == yesterdayDate.toString()) {
			check1 = 0;  // yesterday unavailable
			break; 
		    }else{
			check1 = 1;
		    }
		}
            }
	}
	return check1;
    }
    
    function unAvailableDateEnd(date){
	var yesterdayDate =  new Date(date).valueOf() + 1000*3600*24;
	yesterdayDate = new Date(yesterdayDate);
	var check1 = 0;

	for (var i = 0; i < dates_length; i++) {
              if (new Date(dates[i]).toString() == yesterdayDate.toString()) {
		for (var j = 0; j< dates_length; j++) {
			if (new Date(dates[j]).toString() != date.toString()) {
			  check1 = 1
			}else{
			    check1 = 0;
			    break; // today unavailable
			}
		}
		
	      }
	}
	return check1;
    }
   
    function updateDatePickerCells(dp){
        //alert(pricePan  );
        setTimeout(function () {
            //Select disabled days (span) for proper indexing but // apply the rule only to enabled days(a)
            $('.ui-datepicker-calendar td > *').each(function (idx, elem) {		    
                var anchor	 	= $(this);
                var dd		= $(this).html();
                var mm		= parseInt($(this).parent().attr('data-month'))+1;
                var yy		= $(this).parent().attr('data-year')
                var indvDate	= dd + '/' + mm + '/' + yy;
                //alert(pricePan);
                $(pricePan).each(function() {
                    //alert(this.date + ' | ' + this.price + ' | ' + indvDate);
                    if (this.date == indvDate){			    
                        $(anchor).append('<div class="price">THB <em>' + this.price + '</em></div>');
                    }
                    //$(anchor).append('<div class="price">THB <em>' + this.price + '</em></div>');
                });		   		    
            });
        }, 200);
    }

</script>
