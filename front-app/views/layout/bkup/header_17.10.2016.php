<style>
   .ui-autocomplete{background: #FFF;}
   .ui-helper-hidden-accessible{display: none;}
</style>
<div class="bnrTp clearfix">
	 <div class="bnrNav alignleft">
			<ul class="clearfix">
				 <li><a href="#">Sign In</a></li>
				 <li>
									<div class="topLinks currencySec globalInline allCurrency">
			<span class="carencyTitle">
				 <em id="currentCurrency">
						<?php echo  ($this->nsession->userdata('currencyCode') != '')?  $this->nsession->userdata('currencyCode'):'CHOOSE YOUR currency'; ?>
				 </em>
				 <i class="fa fa-caret-down"></i>
			</span>
			<div class="currencyDropBox currencyBox">
				 <div class="currencyDropBoxIn">
						<form id="switchCountry" action="<?php echo FRONTEND_URL;?>home/change_country/" method="post" name="switchCountry">
							 <input type="hidden" value="" id="countries" name="countries">
							 <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
							 <div class="currencyDropBoxInside"></div>
						</form>
				 </div>
			</div>
	 </div>

						<!--<a class="carencyTitle">Currency<i class="fa fa-caret-down"></i></a>--></li>
			</ul>
	 </div>
	 <!--<div class="currencyDropBox currencyBox" style="display:none;">
			<div class="currencyDropBoxIn">
				 <form id="switchCountry" action="<?php //echo FRONTEND_URL;?>home/change_country/" method="post" name="switchCountry">
						<input type="hidden" value="" id="countries" name="countries">
						<input type="hidden" name="redirect_url" id="redirect_url" value="<?php //echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
						<div class="currencyDropBoxInside"></div>
				 </form>
			</div>
	 </div>-->
	 <div class="menuBar alignright" >
			<button class="js-toggle-right-slidebar"><img src="<?php echo FRONT_IMAGE_PATH;?>menu-icon.png" alt="menu-icon"></button>
	 </div>
</div>
<div class="bannerContent">
	 <a class="logo" href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>logo.png" alt="img" class="aligncenter"></a>
	 <h2>THE WORLD IS YOURS</h2>
	 <ul class="clearfix">
			<li>33,000 properties, 170 countries</li>
			<li>Over 8 million verified guest reviews</li>
			<li>24/7 customer service</li>
	 </ul>
	 <div class="frmBox searchBox1">
			<form name="search_property" id="search_property" method="GET" action="<?php echo FRONTEND_URL;?>listing/">
				 <input type="hidden" name="type" id="type" value="">
				 <input type="hidden" name="guest" id="guest" value="">
				 <input type="hidden" name="city" id="city" value="">
				 <input type="hidden" name="property" id="property" value="">
				 <input type="hidden" name="checkin" id="checkin" value="<?php echo DEFAULT_FORM_CHECK_IN_DATE;?>">
				 <input type="hidden" name="checkout" id="checkout" value="<?php echo DEFAULT_FORM_CHECK_OUT_DATE;?>">
				 <input type="hidden" name="group_type" id="group_type" value="">
				 <input type="hidden" name="age_ranges" id="age_ranges" value="">
				 <input type="hidden" name="typeid" id="typeid" value="">
				 <input type="hidden" value="true" name="s"/>
				 <input type="text" name="n1" id="destination" placeholder="Search By Hostel or Hotel Name..." class="citySearchBox">
				 <input type="hidden" value="" name="city_slug" class="city_slug" id="city_slug" />
				 <input type="hidden" value="" name="property_slug" class="property_slug" id="property_slug" />
				 <input type="hidden" value="" name="property_type" id="property_type" />
				 <div class="sbMt"><input id="search_btn" type="submit" name="submit" value="SEARCH NOW">
						<span></span>
				 </div>
				 <div id="add_html"></div>
				 <div class="searchlistingDrop">
						 <div class="searchlistingDropIn">
								 <div class="searchlistingBottom clearfix commonClass"></div>
						 </div>
				 </div>
			</form>
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
						$(this).val(ui.item.value); alert($(this).val(ui.item.value));
						$(this).parent().find('input.city_slug').val(ui.item.city_slug);
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
			//$(this).next('.currencyBox').slideToggle();
			$('.currencyBox').show();
	 });
		
			
	 });
	 

</script>