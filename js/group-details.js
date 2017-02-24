$(function(){
	
$('.grpCheckAvailability').on('click',function(){
	
	$('.total_section,#book_now_section,#user_details_section,#payment_details_section,#final_step_section').hide();
	
	group_guest 		= $('#guest_drop option:selected').val();
	checkInArr 		= $('#checkInArr').val();
	checkOutDpt 		= $('#checkOutDpt').val();
	property_id 		= $('#property_id').val();
	groupType		= $('#groupType option:selected').val();
	var ageGroup = '';
	$('.ageGroup:checked').each(function () {
           var values = $(this).val();
		ageGroup += values+',';
        });
	var error = 0;
	if (groupType == '') {
		error = 1;
		$('.groupType').addClass('errBorderLi');
	}else{
		error = 0;
		$('.groupType').removeClass('errBorderLi');
	}
	
	if ($('.ageGroup:checked').length <= 0) {
		error = 1;
		$('.ageGroup').addClass('errBorderLi');
	}else{
		error = 0;
		$('.ageGroup').removeClass('errBorderLi');
	}
	if (error == 0) {
	stHtml 			= $('#checkInArr').val().split('/');
	edHtml 			= $('#checkOutDpt').val().split('/');
	
	st 			= new Date(stHtml[2],stHtml[1]-1,stHtml[0]);
	ed 			= new Date(edHtml[2],edHtml[1]-1,edHtml[0]);
	
	chk_in_dt  		= stHtml[2]+'-'+(stHtml[1])+'-'+stHtml[0];
	chk_out_dt 		= edHtml[2]+'-'+(edHtml[1])+'-'+edHtml[0];
	
	$('.indate').html(checkInArr);
	$('.out_date').html(checkOutDpt);
	
	
	var dataString 		= 'checkin=' + encodeURIComponent(chk_in_dt) + '&checkout=' + encodeURIComponent(chk_out_dt) + '&property_id=' + encodeURIComponent(property_id) + '&groupType=' + encodeURIComponent(groupType) + '&ageGroup=' + encodeURIComponent(ageGroup);
		$.ajax({
		type : 'POST',
		url : base_url+'grp_property/checkGrpAvailable/',
		data: dataString,
		dataType: "JSON",
		success: function(msg){
			if (msg.type == 'error') {
				$('.bookTable.priceTable').hide();
				$('#group_error_msg').css('display','block');
				$('#group_error_msg').html(msg.message);
			}else{
				$('.bookTable.priceTable').show();
				$('#group_error_msg').css('display','none');
				$('#group_error_msg').html('');
				
				avl_date 		=  jQuery.parseJSON(msg);
				var bookday 		= avl_date.bookday;
				var price 		= avl_date.price;
				var currency 		= avl_date.currency_symbol;
				var room_available 	= avl_date.available;
				var room_price_type 	= avl_date.room_price_type;
				var size 		= avl_date.size;
				var min_avl_bed 	= avl_date.min_avl_bed;
				if (group_guest > min_avl_bed) {
					$('.bookTable.priceTable').hide();
					$('#group_error_msg').css('display','block');
					$('#group_error_msg').html('This property does not accept group bookings for more than '+min_avl_bed+' people. ');
					return false;
				}else{
					$('.bookTable.priceTable').show();
					$('#group_error_msg').css('display','none');
					$('#group_error_msg').html('');
				if (price == '') {
					$('#group_error_msg').css('display','block');
				}
				else{
					$('#group_error_msg').css('display','none');
					avl_date 	= bookday;
					diff 		=  new Date(ed - st);	
					ch_dt 		= st.toString().split(' ');
					new_ch_dt 	= ch_dt[0]+ " " + getGetOrdinal(st.getDate())+" "+ch_dt[1]+" "+ch_dt[3];
					$('#chkin_dt').text(new_ch_dt);
					chot_dt 	= ed.toString().split(' ');
					new_chot_dt 	= chot_dt[0]+ " " + getGetOrdinal(ed.getDate())+" "+chot_dt[1]+" "+chot_dt[3];
					$('#chkout_dt').text(new_chot_dt);
					diffD 		= diff/1000/60/60/24;	
					if (isNaN(diffD)  || diffD < 1 ) {
						$('.priceTable').hide(100);
						return false;
					}
					$('#total_day2').val(diffD);
					var nd 		= new Date(ed.getTime() - 86400000);
					dt = [];
					var strTHead = '<tr>';
					for (var d = st; d <= nd; d.setDate(d.getDate() + 1)) {
						var appendDate = new Date(d);
						strTHead += '<td>'+ getGetOrdinal(appendDate.getDate()) + '</td>';
					}
					strTHead 	+= '</tr>';
					$('#rateTableHead').html(strTHead);
					$('.rateTable').each(function(index){
						var tot = 0;
						$(this).children().children().html('');
						booked_dt = [];
						for (var i=0; i<diffD; i++) {
							tot = tot+parseInt(price[i][index]);
							
							tdHtml = '<span class="currency_smbl">'+currency+'</span>'+price[i][index];
							if(avl_date[i][index] != '' && room_available[index] == 0){
								$(this).children().children().append('<td class="booked">'+tdHtml+'</td>');
								booked_dt[i] = avl_date[i][index];
							}
							else{
								$(this).children().children().append('<td>'+tdHtml+'</td>');
							}
						}
						
						$('.avl_size_'+index).html('Sleep '+size[index]);
						
						$('.priceTable').show(100);
						
						if (booked_dt.length>0) {
							if (room_available[index] == 0) {
								$(this).parent().next('td').children('select').prop('disabled',true);
							}
						}else{
							var val = '<option value="">Choose</option>';
							for(var i=1;i<=room_available[index];i++){
								val += '<option value="'+i+'">'+ i +'</option>';
							}
							$(this).parent().next('td').children('select').html(val);
							$(this).parent().next('td').children('select').prop('disabled',false);
						}
						
						$(this).parent().next('td').children('select').attr('data-tot',tot);
						
					})
				}
				}
			}
		}
	});
	}else{
		return false;
	}
  
});

$('.grpCheckAvailability').trigger('click');

$('.aval_room').change(function(){
	
	var room 		= $(this).val();
	var price 		= parseFloat($(this).attr('data-price').replace(',', '')); //alert(price);
	var total_day 		= $('#total_day2').val();
	var pid 		= $(this).attr('data-id');	
	var room_type 		= $(this).attr('data-roomtype');
	var room_name 		= $(this).attr('data-roomname');
	var tot_price 		= $(this).attr('data-tot');
	var price_type 		= $(this).attr('data-pricetype');
	var room_size 		= $(this).attr('data-roomsize');
	var cy_smbl 		= $('.currency_smbl').html();
	var ln 			= $('#total_heading'+pid).length;	

	if (price_type == 'per_person') {
		var total_price = room*room_size*tot_price;
		total_price = Math.round(total_price);
	}
	if (price_type == 'per_night') {
		var total_price = tot_price*room;
		total_price = Math.round(total_price);
	}
	
		
	if (ln==0) {	
		
		var row = '<tr class="total_heading" id="total_heading'+pid+'"><td>'+room_name+'<input type="hidden" name="room_type_id[]" value="'+room_type+'"></td><td>'+room+'<input type="hidden" name="no_room[]" value="'+room+'"></td><td><span class="crcy_smbl"></span><span class="tot_price">'+ total_price+'</span></td><input type="hidden" name="tot_room_price[]" value="'+ total_price+'"><input type="hidden" name="room_price[]" value="'+price+'"></tr>';
		$('.total_heading').last().after(row);
	}
	else
	{
		var row = '<td>'+room_name+'<input type="hidden" name="room_type_id[]" value="'+room_type+'"></td><td>'+room+'<input type="hidden" name="no_room[]" value="'+room+'"></td><td><span class="crcy_smbl"></span><span class="tot_price">'+ total_price+'</span><input type="hidden" name="tot_room_price[]" value="'+ total_price+'"><input type="hidden" name="room_price[]" value="'+price+'"></td>';
		$('#total_heading'+pid).html(row);
		
	}
	if (room == 0) {
		$('#total_heading'+pid).remove();
	}
	
	var total_price = 0;
	$('.tot_price').each(function(){
		total_price 	= parseFloat(total_price) + parseFloat($(this).html());
		total_price	= parseFloat(total_price);
	});
	
	total_price = Math.round(total_price);
	
	
	$('.total_section,#book_now_section,#user_details_section,#payment_details_section,#final_step_section').hide();
	$('.aval_room').each(function(){
		
		if($(this).val() > 0 ){
			$('.total_section,#book_now_section').show();
		}
	})
	
	$('.crcy_smbl').html(cy_smbl);
	//console.log(total_price);
	$('#total_price_span').html(total_price);
	
	$('#property_price').val(total_price);
	
});

});