// JavaScript Document
var objCustomsManager;
var base_url = base_url;

//var base_url = 'http://codeigniter-development.com/hostelworld/agent/';
//var base_url = 'http://www.hostelmofo.com/admin/';
var BACKEND_URL =base_url;
//var BACKEND_URL = "http://www.livephuket.com/admin/";
var back_img_base = 'http://accomodation.totalwealthconce.netdna-cdn.com/';

//$(function(){ 
//	 Initiate the InviteUserManager
//	objCustomsManager = new CustomsManager();
//	
//	$("#apply_action").change(function(){
//		objCustomsManager.batchAction();
//	});
//	
//	$("#checkallbox").click(function () {
//		var checked_status = $("#checkallbox").attr('checked');
//		objCustomsManager.checkAll(checked_status);
//	});
//		
//	$("#btn_show_all").click(function(){
//		objCustomsManager.showAll();
//	});
//	
//	$("#per_page").change(function(){
//		objCustomsManager.showEntries();
//	});
//	
//	$(".inactive_status").click(function(){
//		var activeInactive = $(this).val();
//		objCustomsManager.whyNotActive(activeInactive);
//	});
//	
//	$('#unavailable_calendar_dates').datepick({multiSelect: 999, monthsToShow: 3});
//
//	
//	
//		
//	===== Check all checbboxes =====//
//	$("#checkallbox").click(function() {
//		var checkedStatus = this.checked;
//		$(".checkItem").each(function() {
//			this.checked = checkedStatus;
//				if(checkedStatus){
//					$('.checkItem').attr('checked', 'checked');
//				}
//				else {
//					$('.checkItem').removeAttr('checked');
//				}
//		});
//	});
//	
//	/ redirect function for avoid cache
//	$(".no-cache-redirect").on("click",function(){
//		var url = $(this).prop("href");
//		var action_url = "<?php echo base_url(); ?>property_sales/redirect_to/";
//		alert(url);
//		
//		if ( checkURL(url) && ( url != '' || url != 'javascript:void(0);' || url != '#')  ) {
//		var form = '<form name="frmPages" id="redirect_form" action="'+BACKEND_URL+'property_sales/redirect_to/" method="post"><input type="hidden" name="url" id="url" value="'+url+'" /></form>';
//		$("body").prepend(form);
//		$("#redirect_form").submit();
//		}
//		return false;
//	});
//});

$("#per_page").change(function(){
	$('#perPageFrm').submit();
	
});

$(function(){
	$("#bedrooms").change(function(){
		var no_bed=$(this).val();
		var str="";
		for(var x=1; x <= no_bed; x++){
			str +='<div class="bedroom_details" data-content="'+x+'">';
			str +='<label for="bedroom'+x+'" class="bedroom">Bedroom '+x+' Details :</label>';
			str +='<input type="text" name="bedroom[]" id="bedroom" value="" class="form-control">';
			str +='</div>';
		}
		$("#details_box").html(str);
		//alert(str);
	});

$(".showAllImage").click(function(){
	$("#modalPropertyName").text( $(this).attr('data-image'));
	
	$.ajax({
		 type:'POST',
		 url:base_url+'property/getImages',
		 data:{
			id: $(this).attr('data-element')
			},
		 success:function(msg){
			var data = jQuery.parseJSON(msg);
			$(".imagePropertyBox").empty();
			$.each(data, function(i, item) {
			  var img = item.image_name;
			  var html ='<div class="">';
			  
			  var back_img = back_img_base+'upload/property/big/'+img ;
			  html +="<div class='subImage inactive'>";
			  html += "<img src='"+back_img+"'/>";
			  html +="</div>";
			  html +='</div>';
			  $(".imagePropertyBox").append(html);
			   
		        });
			$(".imagePropertyBox").find('.subImage').first().addClass('active');
			$(".imagePropertyBox").find('.subImage').first().removeClass('inactive');
			if ($(".imagePropertyBox .subImage").length == 1 || $(".imagePropertyBox .subImage").length == 0) {
				$(".propImgPre").find("i").css("color","#BEBCBC");
				$(".propImgNext").find("i").css("color","#BEBCBC");
			}else{
				$(".propImgPre").find("i").css("color","#BEBCBC");
				$(".propImgNext").find("i").css("color","#000");
			}

		 }
	});
});

$(".propImgPre").click(function(){
	var index = $(this).attr('data-element');
	activeSlide(index);
	var new_index='';
	new_index = Number(index)-1;
	if (new_index!=-1) {
		$(this).attr('data-element', new_index);
		$(".propImgNext").attr('data-element', (new_index+1));
		$(".propImgNext").find("i").css("color","#000");
	}else{
		$(this).find("i").css("color","#BEBCBC");
	}
	
});
$(".propImgNext").click(function(){
	var index = Number($(this).attr('data-element'));
	activeSlide(index);
	var new_index='';
	new_index = Number(index)+1;
	if ((new_index)!= $(".imagePropertyBox .subImage").length) {
		$(this).attr('data-element', new_index);
		$(".propImgPre").attr('data-element', (new_index-1));
		$(".propImgPre").find("i").css("color","#000");
	}else{
		$(this).find("i").css("color","#BEBCBC");
	}
	
	
});


});
function activeSlide(index) {
	
	$(".imagePropertyBox").find('.subImage:eq('+index+')').addClass('active');
	$(".imagePropertyBox").find('.subImage:eq('+index+')').removeClass('inactive');
	
	$(".imagePropertyBox").find('.subImage').not(':eq('+index+')').removeClass('active');
	$(".imagePropertyBox").find('.subImage').not(':eq('+index+')').addClass('inactive');
}

$(".statusLoader").css("visibility","hidden");

function statusModifier(type,element){
	
	var id=$(element).attr('data-team');
	$("#loader_"+id).css("visibility","visible");
	var url ='';
	switch (type) {
	case "property":
		url = base_url+'property/change_status/';
		break;
	case "room_type":
		url = base_url+'room_type/change_status/';
		break;
	}
	
	$.ajax({
		
		url:url,
		type:"POST",
		data:{"id":id},
		success:function(msg){
			//alert($(this).prop('data-status'));
			
			if ($(element).hasClass("btn-success")==true) {
				$(element).addClass("btn-primary");
				$(element).removeClass("btn-success");
				$(element).attr('title','Inactive');
				$(element).find('i').removeClass('fa fa-check-square-o');
				$(element).find('i').addClass('glyphicon glyphicon-remove-sign');
			}
			else if ($(element).hasClass("btn-primary")==true) {
				$(element).addClass("btn-success");
				$(element).removeClass("btn-primary");
				$(element).find('i').removeClass('glyphicon glyphicon-remove-sign');
				$(element).find('i').addClass('fa fa-check-square-o');
				$(element).attr('title','Active');
			}
			
			$("#loader_"+id).css("visibility","hidden");
		}
	});
    }
    
    
    
    function featureModifier(type,element){
	
	var id=$(element).attr('data-feature');
	$("#loader_"+id).css("visibility","visible");
	var url ='';
	switch (type) {
	 
	case "property":
		url = base_url+'property/change_feature/';
		break;
	
	}
	$.ajax({
		
		url:url,
		type:"POST",
		data:{"id":id},
		success:function(msg){
			//alert($(this).prop('data-status'));
			
			if ($(element).hasClass("btn-success")==true) {
				$(element).addClass("btn-primary");
				$(element).removeClass("btn-success");
				$(element).attr('title','Feature No');
				$(element).find('i').removeClass('glyphicon glyphicon-star');
				$(element).find('i').addClass('glyphicon glyphicon-star-empty');
			}
			else if ($(element).hasClass("btn-primary")==true) {
				$(element).addClass("btn-success");
				$(element).removeClass("btn-primary");
				$(element).find('i').removeClass('glyphicon glyphicon-star-empty');
				$(element).find('i').addClass('glyphicon glyphicon-star');
				$(element).attr('title','Feature Yes');
			}
			
			$("#loader_"+id).css("visibility","hidden");
		}
	});
    }
    /* property add */
    
    
$(function(){
	
	$('.allow_group_booking').click(function(){
		var chk_length = $('.allow_group_booking:checkbox:checked').length;
		if(chk_length > 0){
			$('.groupListView').show();
		}else{
			$('.groupListView').hide();
		}
	});
	
		//$("#province_id").change(function(){
		//	var pro_text = $(this).val();
		//	var city = $(this).attr('data-city');
		//	$.ajax({
		//			type:'POST',
		//			url :  base_url +'property/ajaxCityList/',
		//			data:{'pro_id': pro_text},
		//			success:function(msg){
		//				var data = $.parseJSON(msg);
		//				var str ='';
		//				$.each(data, function(i, item) {
		//					str +="<option value='"+item.city_master_id+"'";
		//					if (city == item.city_master_id) {
		//						str +=" selected='selected' ";
		//					}
		//					str += " >";
		//					str += item.city_name;
		//					str += '</option>';
		//				});
		//				$( "#proCityDropDown" ).html(str);
		//			}
		//	});
		//});
		
		
		
		$("#province_id").change(function(){
			var pro_text = $(this).val();
			//alert(pro_text);
			if (pro_text != '') {
			$.ajax({
					type:'POST',
					url :  base_url +'property/ajaxCityList/',
					data:{'pro_id': pro_text},
					success:function(msg){
						$( "#proCityDropDown" ).html(msg);
					}
			});
			}
			else{
				$('#proCityDropDown').html('<option value="">Select any city</option>');
			}
		});
		
      //$("#province_id").trigger('change');
      
      
      
      $(".addPropertyPhoto").click(function(){
	
	$(".propertyfiles").last().trigger("click");
      });
     
      
});

function attachImages(element){
	
		    var myfiles = element;
                    var files = myfiles.files;
		  if (files.length > 0) {
			
			//$(".propertyfiles").clone().appendTo(".addButtonBer");
			$(".addButtonBer").append( '<input type="file" name="propertyfiles[]" multiple="multiple" class="propertyfiles" onchange="javascript:attachImages(this)" style="display: none;"/>' );
		  }
	
                  
                    var i=0;var max_size=2000000;
		    

		    
		     //return false;
                    for (i = 0; i<files.length; i++) {
			
                        var readImg = new FileReader();
                        var file=files[i];
			file['st']=i;
                        if(file.type.match('image.*')){
				
                           // storedFiles.push(file);
                            readImg.onload = (function(file) {
                                return function(e) {
				
				
				//<input type="radio" name="featured_image" value="'+file.st+'" data-id = "" checked="checked" class="featured_image"  />
                                    $('.preiviewPropertyImages').append('<tr class="imageinfo"><td  width="12%" ><img width="80" height="70" src="'+e.target.result+'"/></td><td width="25%"><input type="text" placeholder="Photo Title" name="image_temp_title['+file.st+']" value="" class="form-control" /></td><td width="25%"><input type="text" placeholder="Photo Alt" name="image_temp_alt['+file.st+']" value="" class="form-control" /></td><td>'+file.name+'</td><td><span data-img="'+file.name+'" onclick="javascript:return delPreImage(\'temp\',this)" class="btn btn-danger delPreviewImg tmpImg"  ><i class="glyphicon glyphicon-trash"></i></span></td></tr>');
				
                                };
                            })(file);
                            readImg.readAsDataURL(file);
                        }else{
                            alert('the file '+file.name+' is not an image');
                        }
                    }
		   
		    
			
		    
		
}

function previewImg(element,targetElement){
	
        var myfiles = element;
	var files = myfiles.files;
      
	var i=0;
	for (i = 0; i<files.length; i++) {
	    var readImg = new FileReader();
	    var file=files[i];
	    file['st']=i;
	    if(file.type.match('image.*')){
		    
	       // storedFiles.push(file);
		readImg.onload = (function(file) {
		    return function(e) {
			$(targetElement).html('<img width="200" height="70" src="'+e.target.result+'"/>');
		    };
		})(file);
		readImg.readAsDataURL(file);
	    }else{
		alert('the file '+file.name+' is not an image<br/>');
	    }
	}
}
function delPreImage(type,element){
	
	if (type=='temp') {
		
		
		
		var index = $(".preiviewPropertyImages tr").index(  $(element).parents('tr') );
		
		$(element).parents('tr').fadeOut("slow");
		$(element).parents('tr').remove();	
	}else if(type == 'pre'){
		var featuresStatus = $(element).attr('data-features');
		if (featuresStatus=='Yes') {
			alert('Features Image can not be deleted.');
			return false;
		}
		var c = confirm('Do you want to delete this photo?');
		if (c==true) {
			$("#uploadLoader").show();
			$(element).css("pointer-events",'none');
			$(element).css("opacity",'0.5');
			$.ajax({
				type:'POST',
				url: base_url +'property/deletePropertImage/',
				data: {
					imgName: $(element).attr('data-img')
					},
				success:function(msg){
					$("radio.featured_image").attr('data-features','No');
					var index = $(".prePropertyImages tr").index(  $(element).parents('tr') );
					$(element).parents('tr').fadeOut("slow");
					$(element).parents('tr').remove();
					$("#uploadLoader").hide();
					$(element).attr('data-features','Yes');
					return false;
				}
			});
			
			
		}
		
	}
	return false;
	
}
$('#cancelMinNight').click(function(){
	$('.error').html('');
	$('#minNightTable thead tr').hide();
	$('#addstayvalue').hide();
	$('#add_night').show();
	getMinNight();
});
$('#minNightTable thead tr').hide();
$('#minNightTable tfoot tr').hide();
$('#addstayvalue').hide()
$('#add_night').click(function(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#min_id').val('');
	var nowDate 	= new Date();
	$("#from_date").datepicker({autoclose: true,startDate:nowDate});
	$("#to_date").datepicker({autoclose: true,startDate:nowDate});
	$('#action').val('add');
	$('#minNightTable thead tr').show();
	$('#addstayvalue').show();
	$('#add_night').hide();
	
});
$(document).on('click','#saveMinNight',function(){
	var from_date = $('#from_date').val();
	var to_date   = $('#to_date').val();
	var property_master_id = $('#property_master_id').val();
	var action = $('#action').val();
	var min_id = $('#min_id').val();
	var error     = 0;
	if (from_date == '') {
		$('#from_date_error').html('Please Enter from date');
		error = 1;
	}else{
		$('#from_date_error').html('');
		error = 0;
	}
	if (to_date == '') {
		$('#to_date_error').html('Please Enter to date');
		error = 1;
	}else{
		$('#to_date_error').html('');
		error = 0;
	}
	if (error == 0 ) {
		$.ajax({
			type:'POST',
			dataType: "json",
			url: base_url +'property/addminimumnight',
			data: {from_date: from_date,to_date : to_date,property_master_id:property_master_id,action:action,min_id : min_id},
			success:function(msg){
				$('#minNightTable').append('<tr id="msgRow"><td style="color: green;">'+msg.msg+'</td></tr>');
				$('#addstayvalue').hide();
				$('#add_night').show();
				getMinNight();
				setTimeout(function() {
					$("#minNightTable").find('#msgRow').remove();
				}, 4000);
			}
		});
	}
});


//function getMinNight() {
//	var property_master_id = $('#property_master_id').val();
//	$.ajax({
//		type:'POST',
//		dataType: "json",
//		url: base_url +'property/getminimumnight',
//		data: {property_master_id:property_master_id,id:''},
//		success:function(msg){
//			var str ='';
//			if (msg.total_data.length > 0) {
//			$('#minNightTable thead tr').show();
//			$.each(msg.total_data, function(index, item) {
//				str += '<tr id="edit'+item.id+'">';
//				str += '<td>'+item.from_date+'</td>';
//				str += '<td>'+item.to_date+'</td>';
//				str += '<td>'+item.night+'</td>';
//				str += '<td class="editNight" id='+item.id+'>Edit</td>'
//				str += '</tr>';
//			});
//			$('#viewStayValue').html(str);
//			}
//		}
//	});
//}




$(document).on('click','.editNight',function(){
	var nowDate 	= new Date();
	$("#from_date").datepicker({autoclose: true,startDate:nowDate});
	$("#to_date").datepicker({autoclose: true,startDate:nowDate});
	var property_master_id = $('#property_master_id').val();
	var id = this.id;
	$('#edit'+id).hide();
	$.ajax({
		type:'POST',
		dataType: "json",
		url: base_url +'property/getsingleminimumnight',
		data: {property_master_id:property_master_id,id:id},
		success:function(msg){
			var str ='';
			if (msg.total_data.length > 0) {
			$.each(msg.total_data, function(index, item) {
				from_date = item.from_date;
				to_date = item.to_date;
				min_id = item.id;
			});
			$('#from_date').val(from_date);
			$('#to_date').val(to_date);
			$('#min_id').val(min_id);
			$("#action").val("edit");
			$('#addstayvalue').show();
			$('#add_night').hide();
			}
		}
	});
	//$.ajax({
	//	type:'POST',
	//	dataType: "json",
	//	url: base_url +'property/updateNight',
	//	data: {id:id},
	//	success:function(msg){
	//		getMinNight();
	//	}
	//});
});
//getMinNight();
function getService(propertyMasterId,serviceValue){


	window.location.href = base_url+'market/updateService/'+propertyMasterId+'/'+serviceValue;

}
/* property add */


$("input[name='available_price']").on('change',function(){
	if($(this).val() == ''){
		alert('Please enter a value');
	}
	else if (isNaN($(this).val()) ) {
		alert('Please enter only number');
	}
	else{
		var id		= $(this).closest("div").attr("id");
		var price	= $(this).val();
		var diff	= $('#'+id+' :input[name="diff"]').val();
		var start_date	= $('#'+id+' :input[name="start_date"]').val();
		var propertyID	= $('#'+id+' :input[name="propertyID"]').val();
		var roomTypeID	= $('#'+id+' :input[name="roomTypeID"]').val();
		var avail	= $('#'+id+' :input[name="available_beds"]').val();
		$.ajax({
			type:'POST',
			url: base_url +'property/price_edit',
			data: {price:price,diff:diff,start_date:start_date,propertyID:propertyID,roomTypeID:roomTypeID,avail:avail},
			success:function(msg){
				
				if (msg !='') {
					$('#alert-msg').html('<p class="text-green">Price updated.</p>').show();
					$('#alert-msg').show().delay(3000).fadeOut();
					//setTimeout(function() { $('#alert-msg').hide(); }, 3000);
				}
			}
		});
	}
});

$("input[name='available_beds']").on('change',function(){
	if($(this).val() == ''){
		alert('Please enter value');
	}
	else if (isNaN($(this).val()) ) {
		alert('Please enter only number');
	}
	else{
		var id		= $(this).closest("div").attr("id");
		var booked_count	= $(this).val();
		var diff	= $('#'+id+' :input[name="diff"]').val();
		var start_date	= $('#'+id+' :input[name="start_date"]').val();
		var propertyID	= $('#'+id+' :input[name="propertyID"]').val();
		var roomTypeID	= $('#'+id+' :input[name="roomTypeID"]').val();
		var price	= $('#'+id+' :input[name="available_price"]').val();
		$.ajax({
			type:'POST',
			url: base_url +'property/booked_count_edit',
			data: {price:price,booked_count:booked_count,diff:diff,start_date:start_date,propertyID:propertyID,roomTypeID:roomTypeID},
			success:function(msg){
				
				if (msg !='') {
					$('#alert-msg').html('<p class="text-green">Availibility updated.</p>').show();
					$('#alert-msg').show().delay(3000).fadeOut();
					//setTimeout(function() { $('#alert-msg').hide(); }, 3000);
				}
			}
		});
	}
});




//End of custom javascript and jquery codes that are used for Admin Section by WDC
