// JavaScript Document
var objCustomsManager;
//var base_url = 'http://192.168.2.5/hostelworld/admin/';
//var base_url = 'http://codeigniter-development.com/hostelworld/admin/';
//var base_url = 'http://www.hostelmofo.com/admin/';
var BACKEND_URL =base_url;

//var BACKEND_URL = "http://www.livephuket.com/admin/";
var back_img_base = 'http://accomodation.totalwealthconce.netdna-cdn.com/';
function CustomsManager() {
}


$(function(){ 
	// Initiate the InviteUserManager
	objCustomsManager = new CustomsManager();
	
	$("#apply_action").change(function(){
		objCustomsManager.batchAction();
	});
	
	$("#checkallbox").click(function () {
		var checked_status = $("#checkallbox").attr('checked');
		objCustomsManager.checkAll(checked_status);
	});
		
	$("#btn_show_all").click(function(){
		objCustomsManager.showAll();
	});
	
	$("#per_page").change(function(){
		objCustomsManager.showEntries();
	});
	
	$(".inactive_status").click(function(){
		var activeInactive = $(this).val();
		objCustomsManager.whyNotActive(activeInactive);
	});
	
	//$('#unavailable_calendar_dates').datepick({multiSelect: 999, monthsToShow: 3});

	
	
		
	//===== Check all checbboxes =====//
	$("#checkallbox").click(function() {
		var checkedStatus = this.checked;
		$(".checkItem").each(function() {
			this.checked = checkedStatus;
				if(checkedStatus){
					$('.checkItem').attr('checked', 'checked');
				}
				else {
					$('.checkItem').removeAttr('checked');
				}
		});
	});
	
	/// redirect function for avoid cache
	$(".no-cache-redirect").on("click",function(){
		var url = $(this).prop("href");
		var action_url = "<?php echo base_url(); ?>property_sales/redirect_to/";
		//alert(url);
		
		if ( checkURL(url) && ( url != '' || url != 'javascript:void(0);' || url != '#')  ) {
		var form = '<form name="frmPages" id="redirect_form" action="'+BACKEND_URL+'property_sales/redirect_to/" method="post"><input type="hidden" name="url" id="url" value="'+url+'" /></form>';
		$("body").prepend(form);
		$("#redirect_form").submit();
		}
		return false;
	});
});

function checkURL(value) {
    var urlregex = new RegExp("^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
    if (urlregex.test(value)) {
        return (true);
    }
    return (false);
}


//start of custom javascript and jquery codes that are used for Admin Section
CustomsManager.prototype.batchAction = function() {

	var val1 = $("#apply_action").val();	 
	if (val1 == ''){
		alert("Are you sure to perform batch action?");
	}
	else{
		var n = $( "input[name='page[]']:checked" ).length;
		if (n<1) {
			alert('Please select atleast one item for action');
			$('#apply_action option:eq(0)').attr("selected", "selected");
		}
		else {
			$("#group_mode").val(val1);
			$('#frmPages').submit();
		}
	}
}

CustomsManager.prototype.checkAll = function(checked_status) {
	
	if(checked_status == 'checked'){
		$('.checkItem').attr('checked', 'checked');
		$('.checkItem').parent().addClass('checked');
	}
	else {
		$('.checkItem').removeAttr('checked');
		$('.checkItem').parent().removeClass('checked');
	}
}

CustomsManager.prototype.showEntries = function() {
	$("#perPageFrm").submit();
}

CustomsManager.prototype.showAll = function() {
	$("#search_keyword").val('');
	$('#per_page option:eq(4)').attr("selected", true);
	$("#perPageFrm").submit();
}

CustomsManager.prototype.whyNotActive = function(activeInactive)
{
	if(activeInactive == 'Active')
	{
		$("#why_not_live_div").hide();
	}
	else
	{
		$("#why_not_live_div").show();
	}
}



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


function statusModifier(type,element){
	
	var id=$(element).attr('data-team');
	$("#loader_"+id).css("visibility","visible");
	var url ='';
	switch (type) {
	  case "city":
		url = base_url+'city/change_status/';
		break;
	case "property":
		url = base_url+'property/change_status/';
		break;
	case "facility":
		url = base_url+'property_facility/change_status/';
		break;
	case "email":
		url = base_url+"email_template/change_status/";
		break;
	case "language":
		url = base_url+"language/change_status/";
		break;
	case "hear_about":
		url = base_url+"hear_about/change_status/";
		break;
	case "province":
		url = base_url+"province/change_status/";
		break;
	case "property_type":
		url = base_url+"property_type/change_status/";
		break;
	case "team":
		url = base_url+"team/change_status/";
		break;
	case "room_type":
		url = base_url+"room_type/change_status/";
		break;
	case "review":
		url = base_url+"reviews/change_status/";
		break;
	case "banner":
		url = base_url+"banner/change_status/";
		break;
	case "discountcode":
		url = base_url+"discountcode/change_status/";
		break;
	case "deal_city":
		url = base_url+"deal_city/change_status/";
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
     $("#province_id").change(function(){
	var pro_text = $(this).val();
	var city = $(this).attr('data-city');
	$.ajax({
	     type:'POST',
	     url :  base_url +'property/ajaxCityList/',
	     data:{
		'pro_id': pro_text
		},
	    success:function(msg){
		var data = $.parseJSON(msg);
		var str ='';
		$.each(data, function(i, item) {
		    str +="<option value='"+item.city_master_id+"'";
		    if (city == item.city_master_id) {
			str +=" selected='selected' ";
		    }
		    str += " >";
		    str += item.city_name;
		    str += '</option>';
		});
		$( "#proCityDropDown" ).html(str);
	    }
	});
	
    });
      $("#province_id").trigger('change');
      
      
      
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

$(function(){
	
	$(".prePropertyImages").sortable({
		stop: function( event, ui ) {
			var data={};
			data['images']={};
			var count=0;
			$(".prePropertyImages tr.imageinfo").each(function(){
				data['images'][count]=$(this).attr('data-item');
				count = Number(count)+1;
			});
			$.ajax({
				type:'POST',
				url:base_url+'property/setOrderImage/',
				data:data,
				success:function(msg){
					//alert(msg);
				}
			});
		}
	});
	$("#nextAddProperty").click(function(){
		//alert($(this).attr('class'));
		
		if ($(this).hasClass('disabled')==true) {
			var c = confirm("Are you sure to add or update this product?");
			if (c == true) {
				$("#propertyAddFrm").submit();
			}
		}
	});
	
	
	$("#is_favourite").change(function(){
		
		var val= $(this).val();
		if (val == 'Yes') {
			$("#fav_location").show();
		}
		else if (val == 'No') {
			$("#fav_location").hide();
		}else{
			$("#fav_location").hide();
		}
	});
	$("#is_favourite").trigger('change');
	
	
	$('.propRomeType').click(function(){
		var roomTypeId = $(this).val();
		var roomTypeName = $(this).parent().text();
		if ($(this).prop('checked')==true) {
			if ($("#priceContainer #season_"+roomTypeId).length  ==0) {
				
			var appendHTML = '<br class="spacer"><div class="note note-warning" id="season_'+roomTypeId+'"><div class="col-mb-12">';
			appendHTML += '<h3>'+roomTypeName+'</h3><input type="hidden" class="roomType" name="roomtype[]" value="'+roomTypeId+'"/>';
			appendHTML +='<div class="col-sm-4 rentDailyPricePan"><div class="col-sm-12"><label class="req" for="reg_input_name">Daily Price</label><br>';
			appendHTML +='</div>';
			
			appendHTML +='<div class="col-sm-12"><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>';
			appendHTML +='<input type="text" id="dailyprice_'+roomTypeId+'" data-type="number" data-required="true" class="form-control requiredInput daily-price-fld" name="season_daily[]" value="">';
			appendHTML +='<i class="alert alert-hide">Oops, price is required</i></div>';
			appendHTML +='</div>';
			
			appendHTML +='</div>';
		
			
			appendHTML +='<div class="col-sm-4 rentDailyPricePan">';
			appendHTML +='<div class="col-sm-12">';
			appendHTML +='<label for="reg_input_name" class="req">Commission Price</label><br/>';
			appendHTML +='</div>';
			appendHTML +='<div class="col-sm-12">';
			appendHTML +='<div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>';
			appendHTML +='<input value="" name="commission_rate[]" type="text" class="form-control  " data-required="true" data-type="number" id="commission_rate_'+roomTypeId+'">';
			appendHTML +='<i class="alert alert-hide">Oops, commission rate is required</i>';
			appendHTML +='</div></div>';
			appendHTML +='</div>';
		
							
							
			
			appendHTML +='<div class="col-sm-4">';
			appendHTML +='<div class="col-sm-12">';
			appendHTML +='<label class="req" for="reg_input_name">Minimum Rental Days</label>';
			appendHTML +='</div>';
			appendHTML +='<div class="col-sm-12">';
			appendHTML +='<div class="input-group"><span class="input-group-addon"><i class="fa fa-exclamation"></i></span>';
			appendHTML +='<input type="text" id="minrental_'+roomTypeId+'" data-type="number" data-required="true" class="form-control " name="minimum_rental_days[]" value="">';
			appendHTML +='<i class="alert alert-hide">Oops, minimum rental days is required</i>';
			appendHTML +='</div></div></div>';
			
			
			
			
			appendHTML +='<div class="col-sm-12">';
			appendHTML +='<br/>';
			appendHTML +='</div>';
			appendHTML +='<div class="col-sm-12 text-center">';
			appendHTML +='<div class="defaultSeason">';
			appendHTML +='<label class="req" for="reg_input_name"> Is Default Room type?</label>';
			
			appendHTML +='<input type="radio" name="isDefault"  checked="checked" id="isdefault_'+roomTypeId+'" class="form-controltwo seasonDefault custom-radio" onclick="javascript:setDefault('+roomTypeId+');" value="'+roomTypeId+'" >';
			appendHTML +='</div></div><div style="clear:both"></div></div>';
			
			$("#priceContainer").append(appendHTML);
			
			}
		}else{
			$("#priceContainer #season_"+roomTypeId).remove();
		}
	});
	
	
	//$(".previewBox").hide();
	$(".previewLink").click(function(){
		$(this).parents('tr').find('.previewBox').show();
		 
		//$(this).parents('tr').find('.previewBox').find('.preview_link').select();
	});
	$('.preview_link').focus(function() { $(this).select(); } );
	
});
function setDefault(roomType){
	
}

$(function(){
	if ($(".seasonDefault").length>0) {
		if ($(".seasonDefault:checked").length == 0) {
			$(".seasonDefault").first().prop('checked',true);
		}
	}
	
	if ($(".prePropertyImages .featured_image").length>0) {
		if ($(".prePropertyImages .featured_image:checked").length == 0) {
			$(".prePropertyImages .featured_image").first().prop('checked',true);
		}
	}
});


$(function(){
	$('a.cancel_book').click(function(){
		var cancel_id = $(this).attr('cancel-id');
		var thiss = $(this);
		if (confirm('sure?')) {
			$.ajax({
				type:'POST',
				url:base_url+'booking/booking_cancel/',
				data: {'cancel_id': cancel_id},
				success:function(msg){
					if (msg == 'ok') {
						thiss.remove();
					}
				}
			});
		}
	});
	
	$('.allow_group_booking').click(function(){
		var chk_length = $('.allow_group_booking:checkbox:checked').length;
		if(chk_length > 0){
			$('.groupListView').show();
		}else{
			$('.groupListView').hide();
		}
	});
	//if ($('.allow_group_booking:checked').length == 0) {
	//	$('.allow_group_booking').trigger('click');
	//}
	
	
});




/* property add */


//End of custom javascript and jquery codes that are used for Admin Section by WDC
