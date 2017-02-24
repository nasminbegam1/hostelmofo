<style>
/*   .ui-autocomplete{background: #FFF;}
   .ui-helper-hidden-accessible{display: none;}*/
</style>
<!--<div id="owl-demo" class="owl-carousel owl-theme">-->



<div class="home_banner" style="background-image:url('images/ban1.jpg');"> 

<div class="banner_holder">
<div class="bannerContent">
	 <a class="logo" href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>logo.png" alt="img" class="aligncenter"></a>
	 <h2>You'll never sleep with anyone else</h2>
	 <ul class="clearfix">
			<li>Australia's #1 site for hostels and budget accommodation</li>

	 </ul>
	 <div class="frmBox searchBox1">
			<form name="search_property" id="search_property" method="GET" action="<?php echo FRONTEND_URL;?>listing/">
				 <input type="hidden" name="type" id="type" value="">
				 <!--<input type="hidden" name="guest" id="guest" value="1">-->
				 <input type="hidden" name="city" id="city" value="">
				 <input type="hidden" name="property" id="property" class="property" value="">
				 <!--<input type="hidden" name="checkin" id="checkin" value="<?php //echo DEFAULT_FORM_CHECK_IN_DATE;?>">
				 <input type="hidden" name="checkout" id="checkout" value="<?php //echo DEFAULT_FORM_CHECK_OUT_DATE;?>">-->
				 <input type="hidden" name="group_type" id="group_type" value="">
				 <input type="hidden" name="age_ranges" id="age_ranges" value="">
				 <input type="hidden" name="typeid" id="typeid" value="">
				 <input type="hidden" value="true" name="s"/>
				 <input type="text" name="n1" id="destination" placeholder="Search By Location or Hostel or Hotel Name..." class="citySearchBox">
				  <div id="step2" style="display:none;">
					 <div class="small_input">
						<label>Check In</label>
						<input type="text" name="checkin" id="checkIn" class="chkin" value="<?php echo HOME_DEFAULT_CHECK_IN_DATE;?>" readonly="true">
					 </div>
					 <div class="small_input">
						<label>Check Out</label>
						<input type="text" name="checkout" id="checkOut" class="chkout" value="<?php echo HOME_DEFAULT_CHECK_OUT_DATE;?>" readonly="true">
					 </div>
					 <div class="small_input">
						<label>Guests</label>
						<select name="guest" id="guest_drop">
						  <?php for($i=1;$i<=80;$i++){?>
							 <option value="<?php echo $i ?>" <?php echo ($i==2 ? "selected":'')?> ><?php echo $i.' '. ($i==1?"Guest":"Guests");?></option>
						  <?php } ?>
						</select>
					 </div>
				  </div>
				  
				  <div id="step3"> </div>
				  
				  
				  <input type="hidden" value="" name="city_slug" class="city_slug" id="city_slug" />
				 <input type="hidden" value="" name="property_slug" class="property_slug" id="property_slug" />
				 <input type="hidden" value="" name="property_type" id="property_type" />
				 <div class="sbMt">
				  <input id="search_btn" type="button" name="Search" value="SEARCH NOW">
						<span></span>
				 </div>
				 
				 <div class="searchlistingDrop">
						 <div class="searchlistingDropIn">
								 <div class="searchlistingBottom clearfix commonClass"></div>
						 </div>
				 </div>
			</form>
	 </div>
</div>
</div>


<div class="ban_img_cnt_sec">
 <?php
 $banner_list = array('ban1.jpg');
 
	 if(is_array($banner_list)){
		  foreach($banner_list as $k=>$banner){
?>

    <!--<span class="ban_img_cnt<?php if($k == 0) echo " active";?>" data-val="<?php echo $banner;?>">X</span>-->

<?php
		  }
	 }
?>

</div>
</div>


<script>
	 $(document).ready(function(){ 
				// if($('.ui-autocomplete').length > 0){
			$( ".citySearchBox" ).autocomplete({
				 source: base_url+"home/getCityList",
				 minLength: 1,
				 select: function( event, ui ) {
						//$(this).parents('.mainSearchPanel').find('.searchlistingBottom').append('<p>'+ui.item.label+'</p>');
						$(this).val(ui.item.value); 
						$(this).parent().find('input.city_slug').val(ui.item.city_slug);
						$(this).parent().find('input.property').val(ui.item.property_slug);
						$(this).parent().find('input.property_slug').val(ui.item.property_slug);
						//$(this).parents('.mainSearchPanel').find('.searchlistingBottom').html( ui.item.desc );
						$('#destination').removeClass('errBorderLi');
						return false;
				 }
			})
	 
			.data("ui-autocomplete")._renderItem = function (ul, item) {
				 return $("<li>")
				 .data("item.autocomplete", item)
				 .append("<a>" + item.label + "</a>")
				 .appendTo(ul);
			};
	 //}
		
		
	 $('.searchBox1 input').click(function(){
			//$('.searchPan .searchlistingDrop').slideToggle();
	 });
	 if ($('#destination').length > 0){
			$("#destination").autocomplete({
				 appendTo: $(".searchBox1")
			});
	 }

	 $('.carencyTitle').click(function(){ 
			$(this).next('.currencyBox').slideToggle();
			//$('.currencyBox').show();
	 });
		
		// new script //    
    $("#checkInn").datepicker({
        minDate: 0,
        dateFormat: 'dd/mm/yy',
        onClose: function(selectedDate) {
            //$("#checkoutid").datepicker("option", "minDate", selectedDate);
            var minDate = $('#checkInn').datepicker('getDate');
            minDate.setDate(minDate.getDate() + 1);
            $("#checkOutt").datepicker('setDate', minDate);
            $("#checkOutt").datepicker('option', 'minDate', minDate);
            $("#checkOutt").datepicker('show');
        }
    });
    
    //$("#checkIn").focus(function(){alert('okkkkkkkk');});
    
    $("#checkOutt").datepicker({
        minDate: '+1D',
        dateFormat: 'dd/mm/yy',
        onClose: function () {
                var dt1 = $('#checkInn').datepicker('getDate');
                var dt2 = $('#checkOutt').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#checkOutt').datepicker('option', 'minDate');
                    $('#checkOutt').datepicker('setDate', minDate);
                }
        }
    });
		
	$('.ban_img_cnt').click(function(){
		 
		  var img = $(this).attr('data-val');
		  $('.ban_img_cnt').removeClass('active');
		  $(this).addClass('active');
		  $('.home_banner').css({'background-image':'url(images/'+img+')'});
		  
	 });
	
	setInterval(function(){
		  $('.ban_img_cnt, .active').next().trigger('click');
		 //console.log($('.ban_img_cnt, .active').next().hasClass('.ban_img_cnt'));
		 
		//  if($('.ban_img_cnt .active').next().hasClass('.ban_img_cnt') == false)
		//  {
		//	   //console.log('aaa');
		//	   $('.ban_img_cnt').first().trigger('click');
		//  }
		//  else
		//  {
		//	   //console.log('bbb');
		//	   $('.ban_img_cnt,.active').next().trigger('click');   
		//  }
		  
	 },4000);		
});

//resizeBan();
$(window).resize(function() {
	//resizeBan();
});

function resizeBan(){
	 var bannerHeight = $( window ).height();
	 var newBanHeight = bannerHeight-100;
	 //$('.home_banner').css('height',newBanHeight);
}	 

	 
	 
</script>
	     
	     