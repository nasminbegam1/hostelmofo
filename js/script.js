
$(document).ready(function() {
//    if (typeof filterOption !== 'undefined'){
//    if (filterOption == 'index') {
//    if ($(window).width()>767) {
//        $('#pagepiling').pagepiling({navigation:false});
//	$('#pagepiling').parents('html').addClass('pageSlide');
//
//    }
//    }
//    }
    //$('#pagepiling').pagepiling({navigation:false});
	    	
    
     $('.banner_pnl').owlCarousel({
        loop:true,
        nav:false,
        items:1,
        autoplay:true,
        autoplayTimeout:3000
    })   
     
//    $('#owl-demo').owlCarousel({
//    loop:true,
//    margin:0,
//    items:1,
//    responsiveClass:true,
//    autoplay:true,
//    dots:true,
//    nav:false,
//    autoplayTimeout:3000
//
//});
    


     
    


$('#owl-carousel1').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:true,
    autoplay:false,
    responsive:{
        0:{
            items:1,
            margin:0,
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

        





//		
//$('#owl-carousel2 ').owlCarousel({
//    loop:true,
//    margin:15,
//    nav:false,
//    dots:true,
//    autoplay:false,
//    responsive:{
//        0:{
//            items:1,
//            margin:0,
//        },
//        600:{
//            items:1,
//            margin:0,
//        },
//        1000:{
//            items:2
//        }
//    }
//});

$('.mofovide_pnl ').owlCarousel({
    loop:true,
    margin:15,
    nav:false,
    dots:true,
    autoplay:false,
    responsive:{
        0:{
            items:1,
            margin:0,
        },
        600:{
            items:1,
            margin:0,
        },
        1000:{
            items:2
        }
    }
});

    $('.newSlider').owlCarousel({
    loop:true,
    margin:0,
    items:1,
    responsiveClass:true,
    autoplay:false,
    dots:true,
    nav:false

});


$('#owl-carousel3').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:true,
    autoplay:false,
    responsive:{
        0:{
            items:1,
            margin:0,
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});


$('#arrival_time').timepicki({
    step_size_minutes:5
});

$('#arrival_time1').timepicki({
    step_size_minutes:5
});


 $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });
 
 $("a[rel^='prettyPhoto']").prettyPhoto({
    
    social_tools:'',
    ie6_fallback: true,
    modal: true,
    deeplinking:false,
    horizontal_padding: 30,
    markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<a class="pp_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
    
});
 
 $('#owl-demo4').owlCarousel({
    loop:true,
    margin:5,
    nav:true,
    dots:false,
    autoplay:false,
    responsive:{
        0:{
            items:1,
            margin:0,
        },
        600:{
            items:2
        },
        1000:{
            items:6
        }
    }
});
 
 
 
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text().replace(/,/g, '')
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});





	//$('.contentAppend').html($('.TxtBlck ul li:first-child').attr('data-title'));
//	$('.TxtBlck ul').on('mouseover', 'li',function(){
//		$('.contentAppend').html($(this).attr('data-title'));
//	});
//        resizeContent();
        
        
    // new script //    
    $("#checkIn").datepicker({
        minDate: 0,
        dateFormat: 'dd/mm/yy',
        onClose: function(selectedDate) {
            //$("#checkoutid").datepicker("option", "minDate", selectedDate);
            var minDate = $('#checkIn').datepicker('getDate');
            minDate.setDate(minDate.getDate() + 1);
            $("#checkOut").datepicker('setDate', minDate);
            $("#checkOut").datepicker('option', 'minDate', minDate);
            $("#checkOut").datepicker('show');
        }
    });
    
    //$("#checkIn").focus(function(){alert('okkkkkkkk');});
    
    $("#checkOut").datepicker({
        minDate: '+1D',
        dateFormat: 'dd/mm/yy',
        onClose: function () {
                var dt1 = $('#checkIn').datepicker('getDate');
                var dt2 = $('#checkOut').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#checkOut').datepicker('option', 'minDate');
                    $('#checkOut').datepicker('setDate', minDate);
                }
        }
    });
    
    $("#changeDate").click(function(){
	
	$('.tblUp_change').hide();
	$('.inner_search_section').show();
//        var str = '';var btn = '';
//        str += '<input class="chkInArr" type="text" id="checkInArr" placeholder="Select checkin date" readonly=true><script>$(document).ready(function(){ $("#checkInArr").datepicker({minDate: 0,dateFormat: "dd/mm/yy",onClose:function(){ var minDate = $("#checkInArr").datepicker("getDate"); minDate.setDate(minDate.getDate() + 1); $("#checkOutDpt").datepicker("setDate", minDate);$("#checkOutDpt").datepicker("option", "minDate", minDate);$("#checkOutDpt").datepicker("show");}})})</script>';
//        
//        str += '<input type="text" id="checkOutDpt" placeholder="Select checkout date" readonly=true><script>$(document).ready(function(){ $("#checkOutDpt").datepicker({minDate: "+1D",dateFormat: "dd/mm/yy",onClose: function () { var checkdt1 = $("#checkInArr").datepicker("getDate"); var checkdt2 = $("#checkOutDpt").datepicker("getDate");if (checkdt2 <= checkdt1) {var minDate = $("#checkOutDpt").datepicker("option", "minDate");$("#checkOutDpt").datepicker("setDate", minDate);}}})})</script>';
//        
//        btn += '<span class="srch checkAvailability" id="searchIcon"><img src="icon9.png" alt="no img" class=""></span>';
//        $("#dateBar").html(str);
//        $("#dateBar").next().html(btn);
//	$('#changeDate').hide();
    })
    
    
    $('#srch_btn').click(function(){
	var checkInArr = $('#checkInArr').val();
	var checkOutDpt = $('#checkOutDpt').val();
	var group = $('#group_list_inner').val();
	var ageRange = $('.ageRng:checked').map(function() { return this.value; }).get().join('-');

	$('#checkin').val(checkInArr.replace(/\//g, '-'));
	$('#checkout').val(decodeURIComponent(checkOutDpt.replace(/\//g, '-')));

	$('#group_type').val(group);
	$('#age_ranges').val(ageRange);
	$('#search_property').submit();
    });
    
    $('#sep_srch_btn').click(function(){
	var checkInArr = $('#checkInArr').val();
	var checkOutDpt = $('#checkOutDpt').val();
	
	$('#checkin').val(checkInArr.replace(/\//g, '-'));
	$('#checkout').val(decodeURIComponent(checkOutDpt.replace(/\//g, '-')));
	
	$('#search_property').submit();
    });
    
    
    
    
    $('a.review').click(function(){
        var data_id  = $(this).id;
        //alert(data_id);
  var tmpl = [
    // tabindex is required for focus
    '<div class="modal hide fade" tabindex="-1">',
      '<div class="modal-header">',
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
        '<h3>Modal header</h3>', 
      '</div>',
      '<div class="modal-body">',
        '<p>Test</p>',
      '</div>',
      '<div class="modal-footer">',
        '<a href="#" data-dismiss="modal" class="btn">Close</a>',
        '<a href="#" class="btn btn-primary">Save changes</a>',
      '</div>',
    '</div>'
  ].join('');
  
  $(tmpl).modal();
});
    
 
    // end of new script //
    
//    $('.checkAvailability').click(function(){
//	checkInArr = $('.chkInArr').val();
//        alert(checkInArr);
//    });


$(".filterbutton").click(function(){
    $("#filterTab").slideToggle();
});

    $("ul.facilities_list").each(function(){
				var LiN = $(this).find('li').length;
				if( LiN > 11){    
					$('li', this).eq(10).nextAll().hide().addClass('toggleable');
					$(this).append('<li class="more">More...</li>');    
				}
			});
			
			$('ul.facilities_list').on('click','.more', function(){
				if( $(this).hasClass('less') ){    
					$(this).text('More...').removeClass('less');    
				}else{
					$(this).text('Less...').addClass('less'); 
				}
				$(this).siblings('li.toggleable').slideToggle();
	 }); 
    
});



$(document).on('click','.checkAvailability',function(){
        checkInArr = $('#checkInArr').val();
	checkInArr = $('.chkInArr').val();
        alert(checkInArr);
        checkOutDpt = $('#checkOutDpt').val();
        property_id = $('#property_id').val();
        minimum_nights_stay = $('#minimum_nights_stay').val();
        
        stHtml = checkInArr.split('/');
        edHtml = checkOutDpt.split('/');
        st = new Date(stHtml[2],stHtml[1]-1,stHtml[0]);
        ed = new Date(edHtml[2],edHtml[1]-1,edHtml[0]);
        chk_in_dt  = stHtml[2]+'-'+(stHtml[1])+'-'+stHtml[0];
        chk_out_dt = edHtml[2]+'-'+(edHtml[1])+'-'+edHtml[0];
        
        $('.indate').html(checkInArr);
        $('.out_date').html(checkOutDpt);
        
        var dataString = 'checkin=' + encodeURIComponent(chk_in_dt) + '&checkout=' + encodeURIComponent(chk_out_dt) + '&property_id=' + encodeURIComponent(property_id);
        
        $.ajax({
            type : 'POST',
            url : base_url+'property/checkMinNight/',
            data: dataString,
            success: function(msg) {
                if (msg != '') {
                    msg =  $.parseJSON(msg);
                    $('#minDayMsg').show();
                    $('#minDayMsg').html("This hostel has a "+msg.night+" min night stay between "+msg.from_date+" and "+msg.to_date+", please change your dates to stay "+msg.night+" nights.");
                    $(".person").prop('disabled', 'disabled');
                    diff =  new Date(ed - st);
                    //alert(diff);
                }
                else{
                    $('#minDayMsg').hide();
                    $('#minDayMsg').html('');
                    avalChek(dataString);
                }
            }
        });
});
    

$(window).load(function(){
    var winheight	= $(window).height();
    var percent90height	= winheight-100;
    $('section').css( "height", percent90height+"px" );
});
$(window).resize(function(){
    var winheight	= $(window).height();
    var percent90height	= winheight-100;
    $('section').css( "height", percent90height+"px" );
});


//$(window).load(function(){
//    resizeContent();
//});
//$(window).resize(function(){
//    resizeContent();
//});
//
//function resizeContent() {
//    var winHt=$(window).height();
//    $('.header .owl-carousel .item').height(winHt);
//    var winWt=$(window).width();
//    var imgWt=$('.contentAppend img').width();
//    var calculetWt=(winWt-imgWt)-56;
//    $('.SlideImg').width(imgWt);
//    $('.TxtBlck').width(calculetWt);
//}


/////////////////////////////////////////////////////////////////////////////////////////////////


    var startprice 		= parseInt($("#startprice").val());
    var endprice 		= parseInt($("#endprice").val());
    var sliderstep 		= parseInt($("#sliderstep").val());
    var currencySymbol 		= $("#currencySymbol").val();
	
	$( "#listpricerange" ).slider({
			range: true,
			min: 0,
			max: endprice,
			step: sliderstep,
			values: [ 0, endprice ],
			slide: function( event, ui ) {
				$( "#amount" ).html( ""+currencySymbol+"" + ui.values[ 0 ] + " - "+currencySymbol+"" + ui.values[ 1 ] ); 
			},
			change: function( event, ui ) {				
				$("#minprice").val(ui.values[0]); 
				$("#maxprice").val(ui.values[1]);
				if(window.location.pathname == '/hostelmofo/maplist/') // MAPLIST_PATH defined in maplist_layout.php var MAPLIST_PATH="/hostel/hostelmofo/"
				{
					doSearch();
				}
				else
				{
					$("input#page").val(1);
					getfilterresult();
				}
				
				
			}
		});
	
	
	
	$( "#amount" ).html( ""+currencySymbol+"" + $( "#listpricerange" ).slider( "values", 0 ) + " - "+currencySymbol+"" + $( "#listpricerange" ).slider( "values", 1 ) );
	
	$(".list_roomtype, .list_citytype, .list_ptype, .list_facility, #sortby, #perpage,.list_guest").change( function(){
		$("input#page").val(1);
		getfilterresult();
	} );
	
	$(document).ready(function(){
	 getfilterresult();
	 });






function getfilterresult(){ 
		var guest 		= $("#guest").val();
		var minprice 		= $("#minprice").val();
		var maxprice 		= $("#maxprice").val();
		var sortby 		= $("#sortby").val();
		var perpage 		= $("#perpage").val();
		var page 		= $("#page").val();
		var list_ptype 		= $('.list_ptype:checked').map(function() {return this.value;}).get().join(',');
		var list_roomtype 	= $('.list_roomtype:checked').map(function() {return this.value;}).get().join(',');
		var list_citytype 	= $('.list_citytype:checked').map(function() {return this.value;}).get().join(',');
		var list_facility 	= $('.list_facility:checked').map(function() {return this.value;}).get().join(',');
		//alert(minprice + '----' + maxprice + '-- ptype --' +list_ptype + '---roomtype ----' +list_roomtype + '-- citytype ---' +list_citytype + '-- fac--' +list_facility)
		
		
		var  formData = "guest="+guest+"&minprice="+minprice+"&maxprice="+maxprice+"&sortby="+sortby+"&page="+page+"&perpage="+perpage+"&typeid="+list_ptype+"&roomtype="+list_roomtype+"&city="+list_citytype+"&facilities="+list_facility+"&way=filter";
		$("#listLoading").show();
		$.ajax({
		    url : base_url + "listing/getfilter/",
		    type: "POST",
		    data : formData,
		    dataType : "JSON",
		    success: function(data)
		    { 
			$("#filterpropertydata").html('');
			$("#filterpropertydata").html(data.html);
			$("#totalCount").html(data.totalCount);
			$('.searchRes').html(data.totalCount + ' Results');
			$(".pagiWrapper").html(data.pagi_links);
			$(".pagiWrapper a").each(function(){
				var link 	= $(this).attr('href');
				var link_arr=link.split("=");
				var page_count=link_arr[ link_arr.length - 1 ];
				//$(this).attr('href',link_arr[0]);
				
				$(this).parent().attr('data-pagi',page_count);
				$(this).parent().attr('onclick','javascript:return setPaginationData(this)');
			});
			$("#listLoading").hide();
		    } 
		});
		
	}


$(document).on('click','.gridclass',function(){
				 $('.listclass').removeClass('active');
				 $(this).addClass('active');
				 var showtype = "grid";
				 getfilterresult(showtype);
			});
		 
	 
			$(document).on('click','.listclass',function(){
				 $('.gridclass').removeClass('active');
				 $(this).addClass('active');
				 getfilterresult();
			});




function getfilterresult(showtype){
			
			var guest 			= $("#guest").val();
			var group_type      =   $("#group_type").val();
			var age_ranges      =   $("#age_ranges").val();
			var minprice 		= $("#minprice").val();
			var maxprice 		= $("#maxprice").val();
			var sortby 			= $("#sortby").val();
			var perpage 		= $("#perpage").val(); 
			var page 			= $("#page").val();
			var checkin 		= $("#checkIn").val();
			var checkout 		= $("#checkOut").val();
			var list_ptype 			= $('.list_ptype:checked').map(function() {return this.value;}).get().join(',');
			var list_roomtype       = $('.list_roomtype:checked').map(function() {return this.value;}).get().join(',');
			var list_citytype 	   = $('#city').val();
			//var list_citytype 	= $('.list_citytype:checked').map(function() {return this.value;}).get().join(',');
			var list_facility 	= $('.list_facility:checked').map(function() {return this.value;}).get().join(',');
	 
			//alert(minprice + '----' + maxprice + '-- ptype --' +list_ptype + '---roomtype ----' +list_roomtype + '-- citytype ---' +list_citytype + '-- fac--' +list_facility)
	 
			if (showtype == "grid") {
				 var  formData = "guest="+guest+"&minprice="+minprice+"&maxprice="+maxprice+"&sortby="+sortby+"&page="+page+"&perpage="+perpage+"&typeid="+list_ptype+"&roomtype="+list_roomtype+"&city="+list_citytype+"&facilities="+list_facility+"&way=filter&stype=grid&group_type="+group_type+"&age_ranges="+age_ranges+"&checkin="+checkin+"&checkout="+checkout;
			}
			else{
				 var  formData 	= "guest="+guest+"&minprice="+minprice+"&maxprice="+maxprice+"&sortby="+sortby+"&page="+page+"&perpage="+perpage+"&typeid="+list_ptype+"&roomtype="+list_roomtype+"&city="+list_citytype+"&facilities="+list_facility+"&way=filter&group_type="+group_type+"&age_ranges="+age_ranges+"&checkin="+checkin+"&checkout="+checkout;
			}
			
	 
			$("#listLoading").show();
	 
			$.ajax({
				 url : base_url + "listing/getfilter/",
				 type: "POST",
				 data : formData,
				 dataType : "JSON",
				 success: function(data){
						
						if (showtype == "grid") {
							 $("#filterpropertydata").removeClass('proList');
							 $("#filterpropertydata").addClass('proGrid listingrid');
						}else{
                            $("#filterpropertydata").addClass('proList');
							 $("#filterpropertydata").removeClass('proGrid listingrid');
                        }
						$("#filterpropertydata").html('');
						$("#filterpropertydata").html(data.html);
						$("#totalCount").html(data.totalCount);
						$('.searchRes').html(data.totalCount + ' Results');
						$(".pagiWrapper").html(data.pagi_links); 
						$(".pagiWrapper a").each(function(){
							 var link 	= $(this).attr('id');
							 var link_arr=link.split("=");
							 var page_count=link_arr[ link_arr.length - 1 ]; 
							 //$(this).attr('href',link_arr[0]);
	 
							 $(this).parent().attr('data-pagi',page_count);
							 $(this).parent().attr('onclick','javascript:return setPaginationData(this)');
						});
						$("#listLoading").hide();
				 } 
			});
	 }



function setPaginationData(element){ 
    var pagi_page = $(element).attr('data-pagi'); 
    if (pagi_page=='') {
        pagi_page = 1;
    }
    $("input#page").val(pagi_page);
        getfilterresult();
    return false;
}



//$(document).on('click',".newclass",function(){
//	 if($("input.chkBoxProp:checked").length > 1){
//		  var countprop = $("input.chkBoxProp:checked").length;
//        
//        var pid =  new Array();
//		  $.each($("input[name='comparechk[]']:checked"), function(key,value) {
//				pid.push($(this).val());
//            
//		  });
//        
//		  var str = pid.join(',');
//        $.ajax({
//				type:'POST',
//				url: base_url+'listing/compareproperty/',
//				data:{
//					 propertyids	: str,
//					 countp 			: countprop
//				},
//            success:function(data){
//                 $("#listcontent").html(data);
//                 $("#myModal").modal('show');
//            }
//		  });
//	 }
//    else{
//        alert("Please check any two checkbox for compare");
//        return false;
//    }
//});



$(document).on("change","input[name='comparechk[]']",function(){
    var limit = 5;
    var cnt = $("input[name='comparechk[]']:checked").length;
   
    
    if( cnt > limit) {
        this.checked = false;
    }
    
    if( cnt <= limit) {
        $("input[name='comparechk[]']:not(':checked')").parent().removeClass('disabled');
        //$("input[name='comparechk[]']:not(':checked')").closest('a').addClass('newclass');
        $("#compare_count").val(cnt);
        var pid =  new Array();
        $.each($("input[name='comparechk[]']:checked"), function(key,value) {
            pid.push($(this).val());
            var str = pid.join(',');
            $("#prop_id").val(pid);
        });
        $("a.newclass").html('Compare ('+cnt+' of 5)');
    }
    if (cnt == limit) {
        $("input[name='comparechk[]']:not(':checked')").parent().addClass('disabled');
        $("input[name='comparechk[]']:not(':checked')").closest('a').removeClass('newclass');
    }
    if (cnt == 0) {
       $("a.newclass").html('Compare');
       $("#prop_id").val("");
    }
   
});


$(document).on('click',".newclass",function(){
    
    var str = $("#prop_id").val();
    var countprop = $("#compare_count").val();
    var city = $("#city").val();
	 if(countprop > 1){
		  $.ajax({
				type:'POST',
				url: base_url+'listing/compareproperty/',
				data:{
					 propertyids	: str,
					 countp 			: countprop,
                city : city
				},
            success:function(data){
                //alert(data);
                $("#listcontent").html(data);
                $("#myModal").modal('show');
                var trs = $("#comparetable tr.not_initial_show");
                trs.hide();
                //trs.slice(0, 10).show();
                //initMap();
            }
		  });
        
	 }
    else{
        alert("Please check any two checkbox for compare");
        return false;
    }
});

$(document).on('click',"#c_showFacilities",function(){
    var trs = $("#comparetable tr");
    trs.show("slow",function(){
        $("#c_showFacilities").hide();
    });
});



