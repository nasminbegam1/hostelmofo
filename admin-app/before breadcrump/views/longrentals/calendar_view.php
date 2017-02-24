<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.js" ></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ui.datepicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-1.9.0.min.js"></script>
<link rel="stylesheet" href="<?php echo FRONT_JS_PATH; ?>jquery-ui.css">
<!--<link href="<?php //echo FRONT_JS_PATH;?>jquery.ui.datepicker.monthyearpicker.css" rel="stylesheet" type="text/css" />-->
<script src="<?php echo FRONT_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>parsley.js"></script>
<!--<script src="<?php //echo FRONT_JS_PATH; ?>jquery.ui.datepicker.monthyearpicker.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.customSelect.js"></script>-->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo BACKEND_CSS_PATH;?>easyscroll.css">
<script type="text/javascript" charset="utf-8" src="<?php echo BACKEND_JS_PATH; ?>mousewheel.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo BACKEND_JS_PATH; ?>easyscroll.js"></script>
<script type="text/javascript">//$(function(){$('#monthContainer .div_scroll').scroll_absolute({arrows:false})});</script>
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
	    <?php } ?>
	    <?php if(isset($errmsg) && $errmsg != ""){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo stripslashes($errmsg);?>
                </div>
            </div>
	    <?php } ?>
        
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
		    <!--<ul class="property_tab">
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_property/<?php echo $property_id.'/'.$page;?>/">Rental Property Details</a></li>
			<li><a class="no-cache-redirect" href="javascript:void(0);">Rental Prices</a></li>
                        <li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_property_image/<?php echo $property_id.'/'.$page;?>/">Property Images</a></li>
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/contact/<?php echo $property_id.'/'.$page;?>/">Contact</a></li>
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/ical_import/<?php echo $property_id.'/'.$page;?>/">iCal Import</a></li>
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/payment/<?php echo $property_id.'/'.$page;?>/">Booking</a></li>
			<li><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/edit_map_location/<?php echo $property_id.'/'.$page;?>/">Map Location</a></li>
			<li  class="active"><a class="no-cache-redirect" href="<?php echo BACKEND_URL;?>rentals/calendar_view/<?php echo $property_id.'/'.$page;?>/">Calendar View</a></li>
                    </ul>-->
                    <div class="clear"></div>
			    
                    	<div id="property_rentals_fieldset" class="property_tag_class">
				<br class="spacer" />
				<h4 class="proHeadingText">Availibility Calendar <span style="float: right;"></span></h4>
				<br class="spacer" />
				  <!-- Availibility Calendar -->
				    <div class="rentalPropCurrency" style="text-align: center;">				
					<div id="availCalendar" style="display: inline-block;">
					    
					</div>
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
					<div id="monthContainer">
					    <div class="div_scroll">
						<div style="margin-top:-12px; float:left; height:auto; width:auto">
						</div>
					    </div>
					</div>
				    </div>
				    <br class="spacer" />
				    <!-- Availibility Calendar -->

                	    </div>
		    <br class="spacer" />
                            </div>
                        </div>	
            		</div>
		    
		    </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>

<style>
    .readonly  a.ui-state-default{
	cursor: default !important;
    }
    .white a.ui-state-default{
	background-color: #FFFFFF;
	background-image: none;
    }
    .grey a.ui-state-default{
	/*background-color: #d3d3d3;*/
	background-color: #e8e8e8;
	background-image: none;
	color:#6c6c6c;
    }
    .green a.ui-state-default{
	background-color: #E0F6BE;
	background-image: none;
    }
    .ui-state-default .price {
	background-color: #E0F6BE;
	color: #6c6c6c;
    }
</style>
<script>
    $(document).ready(function(){
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
	
	//$(document).on('click', '.ui-datepicker-year', function(){
	//	$('#monthContainer').toggle();
	//});
    });
    $(function() {	
	dataString = '';
	var greenDates 	= [];
	var greyDates 	= [];
	var pricePan	= [];
	var minDate	= new Date();
	var maxDate	= new Date();
	var currDate	= new Date();
	var dateAvail	= 0;
	
	$.ajax({
	    type: 'post',
	    data: dataString,
	    url: '<?php echo BACKEND_URL;?>ajax/ajax_property_availibility/<?php echo $property_id;?>',
	    beforeSend: function(){
		$( "#availCalendar" ).html('Building Availibility Calendar...');
	    },
	    success:function(data){
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
		    onChangeMonthYear: function (year, month, inst) {
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
			//console.log(dmy);
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
		//setTimeout(updateDatePickerCells(), 5000);
	    }
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
	    setTimeout(function () {
		//Select disabled days (span) for proper indexing but // apply the rule only to enabled days(a)
		$('.ui-datepicker-calendar td > *').each(function (idx, elem) {		    
		    var anchor	 	= $(this);
		    var dd		= $(this).html();
		    var mm		= parseInt($(this).parent().attr('data-month'))+1;
		    var yy		= $(this).parent().attr('data-year')
		    var indvDate	= dd + '/' + mm + '/' + yy;		    
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
    });
</script>

<style type="text/css">

span.customSelect {
	font-size:14px;
	background-color: #183C86;
	color:#ffffff;
	padding:5px 7px;
	border:1px solid #183C86;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px 5px;
}
span.customSelect.changed {
	background-color: #183C86;
}
.customSelectInner {
	background:url(<?php echo BACKEND_IMAGE_PATH;?>customSelect-arrow.gif) no-repeat center right;
}
.rentalPropCurrency {
    position: relative !important;
}
/*.rentalPropCurrency > #monthContainer {
    background: none repeat scroll 0 0 #111;
    left: 450px;
    padding: 0;
    position: absolute;
    top: 43px;
    width: 200px;
}
#monthContainer > ul {
    max-height: 300px;
    overflow-y: auto;
    padding: 20px;
}
#monthContainer li {
    clear: both;
    display: block;
    text-align: left;
}
#monthContainer li:hover {
    background: #fff;
}
#monthContainer li a{
    font-size: 14px;
}*/
</style>

<style>
    .dp-highlight .ui-state-default {
        background: #56A4EB;
          color: #FFF;
        }
        
        .dp-active  .ui-state-default {
        background: #FFAF02;
          color: #FFF;
        }
        
        #availCalendar .ui-datepicker
	{
	    width: 484px;
	}
#availCalendar .ui-datepicker th span{
	border-radius:4px;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	-o-border-radius:4px;
	-ms-border-radius:4px;
	background: none repeat scroll 0 0 #5380b0;
    box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-webkit-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-o-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-ms-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
    color: #fbf7f7;
    display: block;
    font-size: 13px;
    font-weight: normal;
    line-height: 28px;
    padding: 2px 0;
    text-align: center;
	
}
#availCalendar a.ui-state-default,#availCalendar span.ui-state-default
{
    width: 100%;
    height: 60px;
    text-align: center;
    padding-top: 0;
    font-family: arial;
    font-size: 16px;
    line-height: 40px;
    font-weight: 600;	
}
#availCalendar .ui-state-default
{
    position: relative;
}
#availCalendar span.ui-state-default{
    color: #232323;
    padding: 10px 0 0 !important;
}
#availCalendar span.ui-state-default:after {
    background: none repeat scroll 0 0 #FF0000;
    content: "";
    height: 2px;
    left: 50%;
    margin: 0 0 0 -30%;
    position: absolute;
    top: 29px;
    width: 60%;
}
#availCalendar .white .ui-state-default .price
{
    position:absolute;
    width: 100%;
    left: 0px;
    bottom: 0px;
    font-size: 12px;
    line-height: 12px;
    padding: 2px;
    text-align: center;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    background-color: #E0F6BE;
    color: #6c6c6c;
}
#availCalendar .grey .ui-state-default .price
{
    position:absolute;
    width: 100%;
    left: 0px;
    bottom: 0px;
    font-size: 12px;
    line-height: 12px;
    padding: 2px;
    text-align: center;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    background-color: #e8e8e8;
    color: #6c6c6c;
}
#availCalendar .ui-state-default .price em{
	font-size:11px;
	line-height:11px;
	clear:both;
	display:block;
	font-style:normal;
	color:#6c6c6c;
}
#availCalendar .ui-datepicker td{
    border: 1px solid #ccc !important;
}
#availCalendar .ui-datepicker tr td:last-child{
    border-right: 0 !important;
}
#availCalendar .ui-datepicker tr:last-child td{
    border-bottom: 0 !important;
}
#availCalendar .ui-datepicker td a,#availCalendar .ui-datepicker td span{
    border: 0 !important;
}

#availCalendar .ui-widget-header
{
    /*background: #E8E8E8;
    color: #183c86;
    height: 45px;
    padding-top: 10px;
	box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-webkit-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-o-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-moz-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-ms-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;*/
    border-radius:4px;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	-o-border-radius:4px;
	-ms-border-radius:4px;
	background: none repeat scroll 0 0 #5380b0;
    box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-webkit-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-o-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
	-ms-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.5);
    color: #fbf7f7;
    display: block;
    font-size: 13px;
    font-weight: normal;
    height: 45px;
    line-height: 45px;
    padding: 2px 0;
    text-align: center;
}


#availCalendar .ui-datepicker-calendar{
    background: #E8E8E8;
    color: #183c86;
    height: 45px;
    padding-top: 10px;
	box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-webkit-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-o-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-moz-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
	-ms-box-shadow:0 0 10px 0 rgba(0,0,0,0.3) inset;
}
		
.ui-widget { font-size: 100% }
#availCalendar .white.readonly .ui-state-default{
    /*background:#71A661;
    color:#DEDEE3;*/
    background:#ffffff;
    color:#6c6c6c;
}
#availCalendar .white .ui-state-active{
    background: #fff !important;
    color: #6c6c6c !important;
}

#availCalendar .grey .ui-state-active{
    background: #E8E8E8 !important;
    color: #6c6c6c !important;
}


#availCalendar .ui-datepicker .ui-datepicker-prev .ui-icon{
	width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent; 
	border-right:10px solid #FFFFFF;
	text-indent:-99999em;
	background:none;
	margin: -10px 0 0 -8px;
}
#availCalendar .ui-datepicker .ui-datepicker-next .ui-icon {
    width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent;	
	border-left: 10px solid #FFFFFF;
	text-indent:-99999em;
	background:none;
	margin: -10px 0 0 -4px;
}
#availCalendar .ui-datepicker .ui-datepicker-prev.ui-state-hover, #availCalendar .ui-datepicker .ui-datepicker-next.ui-state-hover{
	border:0;
	background:#fff;
}
#availCalendar .ui-datepicker .ui-datepicker-prev.ui-state-hover .ui-icon{
	width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent; 
	border-right:10px solid #183c86;
	margin: -10px 0 0 -8px;
}
#availCalendar .ui-datepicker .ui-datepicker-next.ui-state-hover .ui-icon{
    width: 0; 
	height: 0; 
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent;	
	border-left: 10px solid #183c86;
	margin: -10px 0 0 -4px;
}

.rentalPropCurrency .calendar-legend {
    display: inline-block;
    /*margin: 90px 10px;*/
    margin-left:10px;
    padding-left: 5px;
    background: #5380B0;
    vertical-align: middle;
    text-align: left;
    position: absolute;
    margin-top: 120px;
}
.rentalPropCurrency .container_cal_color {
    margin-top: 5px;
    width: 125px;
}
.rentalPropCurrency .available {
    background: none repeat scroll 0 0 #E0F6BE;	
}
.rentalPropCurrency .unavailable {
    background: none repeat scroll 0 0 #e8e8e8;	
}
.rentalPropCurrency .available, .rentalPropCurrency .unavailable {
    display: inline-block;
    height: 22px;
    position: relative;
    width: 22px;
}
.available + .cal_text {
    color: #E0F6BE;
}
.unavailable + .cal_text {
    color: #e8e8e8;
}
.rentalPropCurrency .cal_text {
    display: inline-block;
    font-size: 12px;
    margin-left: 5px;
    vertical-align: super;
}
#availCalendar .ui-datepicker .ui-datepicker-prev, #availCalendar .ui-datepicker .ui-datepicker-next{
	height:96%;
	width:30px;
}
/*#availCalendar .ui-datepicker-title {
    color: #FFFFFF;
    cursor: pointer;
    font-size: 19px;
    line-height: 32px;
    text-align: center;
    text-shadow: 0 1px 0 #5380B0;
}*/
#availCalendar .ui-datepicker-title {
    clear: both;
    display: block;
    height: 32px;
    line-height: 1;
    margin: 4px auto 0;
    overflow: hidden;
    padding: 0;
    position: relative;
    width: 40%;
	border-radius:4px;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	-o-border-radius:4px;
	-ms-border-radius:4px;
	border: 1px solid #315274;
    box-shadow: 0 1px 0 #ccc inset;
	-webkit-box-shadow: 0 1px 0 #ccc inset;
	-moz-box-shadow: 0 1px 0 #ccc inset;
	-o-box-shadow: 0 1px 0 #ccc inset;
	-ms-box-shadow: 0 1px 0 #ccc inset;
	cursor:pointer;
}
#availCalendar .ui-datepicker-title:hover{
	background:#5784B3;
}
#availCalendar .ui-datepicker-title span{
	display:inline-block;
	vertical-align:top;
	line-height:28px;
	font-size:16px;
	color:#fff;
}
/*#availCalendar .ui-datepicker-title select{
	background: none repeat scroll 0 0 transparent;
    border: 0 none;
    color: #706f6f;
    font-size: 16px;
    height: 30px;
    line-height: 30px;
    padding: 0 0 0 28%;
    position: relative;
    text-align: left;
    width: 110%;
    z-index: 1;
}
#availCalendar .ui-datepicker-title select > option {
    border-bottom: 1px solid #ccc;
    font-size: 12px;
    padding: 4px 10px;
}*/
/*#availCalendar .ui-datepicker-title .ui-datepicker-year{
	color: #183c86;
    display: inline-block;
    font-size: 16px;
    font-weight: normal;
    line-height: 32px;
    margin: 0;
    position: absolute;
    right: 0;
    top: 0;
    vertical-align: top;
    width: 78%;
}*/
#availCalendar .ui-datepicker-title:after {
    content: "";
    position: absolute;
    right: 10px;
    top: 12px;
	width: 0; 
	height: 0; 
	border-left: 8px solid transparent;
	border-right: 8px solid transparent;
	border-top: 8px solid #fff;
}
#availCalendar .ui-datepicker{
	padding:0;
}
#availCalendar .ui-datepicker-calendar{
	margin:0;
}
#monthContainer ul::-webkit-scrollbar{
	width:16px;
	background-color:#cccccc;
}
/*#monthContainer ul::-webkit-scrollbar { width: 10px; height: 3px;}
#monthContainer ul::-webkit-scrollbar-button {  background-color: #666; }
#monthContainer ul::-webkit-scrollbar-track {  background-color: #999;}
#monthContainer ul::-webkit-scrollbar-track-piece { background-color: #ffffff;}
#monthContainer ul::-webkit-scrollbar-thumb { height: 50px; background-color: #666;}
#monthContainer ul::-webkit-scrollbar-corner { background-color: #999;}}
#monthContainer ul::-webkit-resizer { background-color: #666;}*/

.unavailable-end .ui-state-default:after {
    border-bottom: 125px solid rgba(0, 0, 0, 0);
    border-left: 130px solid rgba(255, 0, 0, 0.6);
    content: "";
    height: 0;
    left: -37px;
    position: absolute;
    top: -28px;
    width: 0;
}
.unavailable-start .ui-state-default:after {
    border-bottom: 125px solid rgba(255, 0, 0, 0.6);
    border-left: 130px solid rgba(0, 0, 0, 0);
    content: "";
    height: 0;
    left: -37px;
    position: absolute;
    top: -28px;
    width: 0;
}
.ui-state-default {
    height: 25px;
    line-height: 26px !important;
    min-width: 26px;
    overflow: hidden;
    position: relative;
}
</style>