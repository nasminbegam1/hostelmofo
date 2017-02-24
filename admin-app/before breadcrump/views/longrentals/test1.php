<!doctype html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
	
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />


    <title>LivePhuket CRM Administrator Panel</title>
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    
    <link rel="stylesheet" href="http://codeigniter-development.com/livephuket/admin/js/lib/fullcalendar/fullcalendar.css"><!-- fullcalendar -->
    
    <script src="http://codeigniter-development.com/livephuket/admin/js/jquery.min.js"></script><!-- jQuery -->
    <script src="http://codeigniter-development.com/livephuket/admin/bootstrap/js/bootstrap.min.js"></script><!-- bootstrap framework -->
    <script src="http://codeigniter-development.com/livephuket/admin/js/lib/fullcalendar/fullcalendar.js"></script><!-- fullcalendar -->
    
    <!--[if lte IE 9]>
        <script src="http://codeigniter-development.com/livephuket/admin/js/ie/jquery.placeholder.js"></script>
        <script>
            $(function() {
                $('input, textarea').placeholder();
            });
        </script>
    <![endif]-->    
    
  </head>
  <body class="" >
     
  <!--Start : show the main center block here that will be loaded from the method of the controller called-->
	<script src="http://codeigniter-development.com/livephuket/js/jquery-ui.min.js"></script>
<script src="http://codeigniter-development.com/livephuket/admin/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" href="http://codeigniter-development.com/livephuket/js/jquery-ui.css">
<style>
  .ui-datepicker{
    background:#F2F2F2;
    /*border: 1px solid #000;*/
    box-shadow:0px 0px 3px #000;
  }
</style>
<script>
  var date="";
        	var removeDate=new Array();
	//var date_arr=new Array();
	var date_arr=new Array('1/10/2014','2/10/2014','3/10/2014','6/10/2014','7/10/2014', '22/10/2014', '23/10/2014', '24/10/2014'); // for edit
	var start_date="", end_date="";var selectCount=0;

    
    $(function(){
      
      $("#manual_calander2").multiDatesPicker({
                numberOfMonths:[4,3],
                minDate:-7,
                maxDate:356,
		addDates:date_arr
               
      });
      
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
<div id="tab">
    <ul>
         <li><a href="#tab3">Rage date Select from textbox</a></li>
    </ul>

    <div id="tab3">

        <div id="text_box_cal">
            <p class="text_box">
                <input type="textbox" class="from datepicker" placeholder="from"/>
                <input type="textbox" class="to datepicker" placeholder="to"/>
            </p>
            <p>
                <input type="button" id="add_cal" value="Add More" />
                <input type="button" id="view_cal" value="View" />
            </p>
        </div>
            <div id="manual_calander2" data-item="multiple date"></div>
    </div>
</div> 
  <!--End : show the main content block-->
      </body>

</html>