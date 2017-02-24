<?php
if(isset($_GET['zoom']) && !empty($_GET['zoom'])){
  $zoom   = (int)trim($_GET['zoom']);
}
else{
  $zoom      = 11;
}

if(isset($_GET['cp_lat']) && !empty($_GET['cp_lat'])){
  $cp_lat   = trim($_GET['cp_lat']);
}
else{
  $cp_lat      = -30;
}

if(isset($_GET['cp_lng']) && !empty($_GET['cp_lng'])){
  $cp_lng   = trim($_GET['cp_lng']);
}
else{
  $cp_lng      = 134;
}
if($city == '')
{
 $city = $province;
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($city));
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($curl);
curl_close ($curl);
$response = json_decode($json);

//pr($response->results[0]);
//echo "".$response->results[0]->geometry->location->lat;

$latitude = $response->results[0]->geometry->location->lat;
$longitude = $response->results[0]->geometry->location->lng;

//echo $city."==".$latitude."==".$longitude;
?>





<script src='http://maps.googleapis.com/maps/api/js?sensor=false' type="text/javascript"></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>map_infobox.js"></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>custom_map_tooltip.js"></script>


<script type="text/javascript">
	 var infoWindowFile      = '<?php echo FRONTEND_URL;?>maplist/tooltipPropertydetail/';
	 var markerList = {};
	 var markers     = [];
	 var cpLat	= $('#cp_lat').val();
	 var cpLng	= $('#cp_lng').val();
	 var defaultZoom     = 10;
	 
	 
	 function loadMap(ne_lat, ne_lng, sw_lat, sw_lng, pageno){
		var defaultLatlng   = new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>);
		var styles = [
					{
						featureType: "poi",
						stylers: [
						 { visibility: "off" }
						]   
					}
			];
		var myOptions = {
					zoom: defaultZoom,
					minZoom:1,
					maxZoom:18,
					center: defaultLatlng,
					panControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					styles: styles,
					disableDefaultUI: true, // a way to quickly hide all controls
					mapTypeControl: false,
					zoomControl: false,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.LEFT_TOP
					},
			};
			
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		var ne_lat          = '';     
		var ne_lng          = '';
		var sw_lat          = '';
		var sw_lng          = '';
		pageno              = 1;
		loadMarkers(ne_lat, ne_lng, sw_lat, sw_lng, pageno);
		
		var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {   
					zoomChanged = true;        
					google.maps.event.removeListener(boundsListener);
			});
			
			google.maps.event.addListener(map, 'tilesloaded', function() {
					google.maps.event.addListener(map, 'zoom_changed', function() {         
									defaultCenterLat = map.getCenter().lat();
									defaultCenterLng = map.getCenter().lng();
									defaultZoom   = map.getZoom();
									var bounds  = map.getBounds();
									var ne      = bounds.getNorthEast(); // LatLng of the north-east corner
									var sw      = bounds.getSouthWest(); // LatLng of the south-west corder
									var nw      = new google.maps.LatLng(ne.lat(), sw.lng());
									var se      = new google.maps.LatLng(sw.lat(), ne.lng());
									var ne_lat  = ne.lat();
									var ne_lng  = ne.lng();
									var sw_lat  = sw.lat();
									var sw_lng  = sw.lng();
			
			$('#ne_lat_hidden').val(ne_lat);
									$('#ne_lng_hidden').val(ne_lng);
									$('#sw_lat_hidden').val(sw_lat);
									$('#sw_lng_hidden').val(sw_lng);
									$('#zoom_hidden').val(defaultZoom);
									$('#cp_lat_hidden').val(defaultCenterLat);
									$('#cp_lng_hidden').val(defaultCenterLng);
			
			changedMap(ne_lat, ne_lng, sw_lat, sw_lng);
			
					});
					
					google.maps.event.addListener(map, 'dragend', function() { 
									defaultCenterLat = map.getCenter().lat();
									defaultCenterLng = map.getCenter().lng();
									defaultZoom   = map.getZoom();
									var bounds  = map.getBounds();
									var ne      = bounds.getNorthEast(); // LatLng of the north-east corner
									var sw      = bounds.getSouthWest(); // LatLng of the south-west corder
									var nw      = new google.maps.LatLng(ne.lat(), sw.lng());
									var se      = new google.maps.LatLng(sw.lat(), ne.lng());
									var ne_lat  = ne.lat();
									var ne_lng  = ne.lng();
									var sw_lat  = sw.lat();
									var sw_lng  = sw.lng();
									
									$('#ne_lat_hidden').val(ne_lat);
									$('#ne_lng_hidden').val(ne_lng);
									$('#sw_lat_hidden').val(sw_lat);
									$('#sw_lng_hidden').val(sw_lng);
									$('#zoom_hidden').val(defaultZoom);
									$('#cp_lat_hidden').val(defaultCenterLat);
									$('#cp_lng_hidden').val(defaultCenterLng);
									
									changedMap(ne_lat, ne_lng, sw_lat, sw_lng);
					});        
			});
	 }
	 
	 
	 function getHtml(data) {
			var htmlResult 		= '';
				var obj = $.parseJSON(data);
				var property_record = obj.record;
				var guest = obj.guest;
				var group_type = obj.group_type;
				var age_ranges = obj.age_ranges;
				var checkin = obj.checkin;
				var checkout = obj.checkout;
				var pagination_str  = obj.pagination;
				var total_rows	= Number(obj.total_record);
				//alert(total_rows);
				var extrapara = '';
				if (obj.group_type != '' && obj.age_ranges != '') {
					extrapara = '/'+obj.group_type+'/'+obj.age_ranges;
				} 
				if (total_rows > 0)
				{
					if (total_rows > 1)
					{
			$('.searchRes').html(total_rows + ' Results');
					}
					else
					{
			$('.searchRes').html(total_rows + ' Result');
					}
					
				}
				else
				{
					$('.searchRes').html('0 Result');
				}
				
							$.each(property_record, function(i, item) {
									// add marker to map
			
									loadMarker(item);
			
			
			htmlResult = htmlResult + "<li onmouseover=\"javascript:highlightMarker('"+item.property_id+"', 1);\" onmouseout=\"javascript:highlightMarker('"+item.property_id+"', 0);\"><div class=\"mapListOuter\" style=\"height: 258px;\"><div class=\"mapListImgBox\"><div class=\"proPrice\"><?php echo $currencySymbol; ?> "+item.daily_price+"</div>";
			
			if (item.fav_status=='Yes') {
				var favClass='active';
			}else{
				var favClass='';
			}
			
			htmlResult += "<div class=\"proFavIcon "+favClass+" \">";
			htmlResult += "<a href='javascript:void(0);'  data-item=\""+item.property_slug+"\" class='favouriteIcon <?php echo ($this->nsession->userdata(' USER_ID')=='')? 'noLog':''; ?>' >";
			htmlResult += "<em class='iconback fa fa-heart'></em>";
			htmlResult += "<em class='iconfront fa fa-heart-o'></em>";
			htmlResult += "</a>";
			htmlResult += "</div>";
			
					 htmlResult += "<a href=\"<?php echo FRONTEND_URL;?>property/"+item.property_type_slug+"/"+item.province_slug+"/"+item.city_seo_slug+"/"+item.property_slug+"/"+guest+"/"+checkin+"/"+checkout+extrapara+"\"><img alt=\""+item.property_name+"\" src=\"<?php echo CDN_PROPERTY_BIG_IMG;?>"+item.image_name+"\"></a></div><h3><a href=\"<?php echo FRONTEND_URL;?>property/"+item.property_type_slug+"/"+item.province_slug+"/"+item.city_seo_slug+"/"+item.property_slug+"/"+guest+"/"+checkin+"/"+checkout+extrapara+"\">"+stripslashes(item.property_name)+"</a></h3><div class=\"proDtls\"><div class=\"ptypeRatePan\"><div class=\"pTypePan\"></div><a href=\"<?php echo FRONTEND_URL;?>property/"+item.property_type_slug+"/"+item.province_slug+"/"+item.city_seo_slug+"/"+item.property_slug+extrapara+"\">More Info <em class=\"fa fa-angle-double-right\"></em></a></div></div></div></li>";
			
							});
				
				if (htmlResult != '')
				{
					$('.propListMap').html(htmlResult);
					$("#noRecordWrap").empty();
					$('.pagiWrapper').html(pagination_str);
					$(".pagiWrapper a").each(function(){
						 var link 	= $(this).attr('href');
			 var link_arr=link.split("=");
			 var page_count=link_arr[ link_arr.length - 1 ];
			 //$(this).attr('href',link_arr[0]);
			 
			 $(this).parent().attr('data-pagi',page_count);
			 $(this).parent().attr('onclick','javascript:return setPaginationData(this)');
					});
				}
				else
				{
					$('.propListMap').empty();
					$("#noRecordWrap").html('<div class="noRecordText"><div><strong>There are 0 Properties that match your search criteria.</strong></div><br/><div>You can see more Properties by amending / widening your filters.</div></div>');
					$('.pagiWrapper').empty();
				}
				$("#listLoading").hide();
	}

	function setPaginationData(element){
		var pagi_page = $(element).attr('data-pagi');
		if (pagi_page=='') {
			pagi_page = 1;
		}
		$("input#page").val(pagi_page);
		loadMarkers('', '', '', '', pagi_page);
		 return false;
	}
	 
	 function changedMap(ne_lat, ne_lng, sw_lat, sw_lng){
      
      $('#cp_lat').val(map.getCenter().lat());
      $('#cp_lng').val(map.getCenter().lng());

      $('#ne_lat_hidden').val(ne_lat);
      $('#ne_lng_hidden').val(ne_lng);
      $('#sw_lat_hidden').val(sw_lat);
      $('#sw_lng_hidden').val(sw_lng);
      
      var checkin       = $('#mapcheckInn').val().replace('/', '-').replace('/', '-'); 
      var checkout      = $('#mapcheckOutn').val().replace('/', '-').replace('/', '-');
      var minprice      = $('#minprice').val();
      var maxprice      = $('#maxprice').val();
      var amenities     = getCheckedAmenities(); 
      var locations     = $('#city_id').val();
      var roomtypes   	= getCheckedRooms();
      var propertytypes = getCheckedPropertyTypes();
      var sortBy	= $('.sortby.active').attr('id');
      var pageno	= 1;
      var guest 	= $(".list_guest:checked").val();
		//alert(guest);
		
		var group_type 	= $("#group_list").val();
		var age_ranges 	= $("#ageRangess").val();
		
     
      var dataString  = 'guest=' + guest + '&ne_lat=' + encodeURIComponent(ne_lat) + '&ne_lng=' + encodeURIComponent(ne_lng) + '&sw_lat=' + encodeURIComponent(sw_lat) + '&sw_lng=' + encodeURIComponent(sw_lng) + '&page=' + encodeURIComponent(pageno) + '&typeid=' + encodeURIComponent(propertytypes) + '&checkin=' + encodeURIComponent(checkin) + '&checkout=' + encodeURIComponent(checkout) +  '&minprice=' + encodeURIComponent(minprice)  + '&maxprice=' + encodeURIComponent(maxprice) + '&city=' + encodeURIComponent(locations) + '&roomtypes=' + encodeURIComponent(roomtypes) + '&amenities=' + encodeURIComponent(amenities) + '&sortBy=' + encodeURIComponent(sortBy)+'&group_type='+group_type+'&age_ranges='+age_ranges;
      
      $("#listLoading").show();
      $.ajax({
        type: 'POST',
        data: dataString,
        url: '<?php echo FRONTEND_URL;?>maplist/get_map_data/',
        beforeSend: function(){
            
        },
        success: function(data){
	  console.log(data);
	    getHtml(data) ;
        }
      });
    }

	 
	 function loadMarkers(ne_lat, ne_lng, sw_lat, sw_lng, pageno){
		$.each(markerList, function(i, item) {
		  item.setMap(null);
		});
		
		$.each(markers, function(i, item) {
		  item.setMap(null);
		});
		markerList = {};
		markers     = [];
		
		var checkin         = $('#mapcheckInn').val().replace('/', '-').replace('/', '-'); 
		var checkout        = $('#mapcheckOutn').val().replace('/', '-').replace('/', '-');
		var minprice        = $('#minprice').val();
		var maxprice        = $('#maxprice').val();
		var amenities       = getCheckedAmenities();
		var locations     = $('#city_id').val();
		var roomtypes   	= getCheckedRooms();
		var propertytypes   = getCheckedPropertyTypes();
		var sortBy		= $('.sortby.active').attr('id');
		var pageno		= pageno;
		
		var ne_lat		= $('#ne_lat_hidden').val();
		var ne_lng		= $('#ne_lng_hidden').val();
		var sw_lat		= $('#sw_lat_hidden').val();
		var sw_lng		= $('#sw_lng_hidden').val();
			
		//$('.property-types').each(function(){
		//  if ($(this).is(':checked')){
		//	 propertytypes = propertytypes + $(this).val() + ',';   
		//  }
		//});
			
		var group_type 	= $("#group_list").val();
		var age_ranges 	= $("#ageRangess").val();
		var guest 	= $("#guest").val();
		var dataString  = 'guest=' + guest + encodeURIComponent(ne_lat) + '&ne_lng=' + encodeURIComponent(ne_lng) + '&sw_lat=' + encodeURIComponent(sw_lat) + '&sw_lng=' + encodeURIComponent(sw_lng) + '&page=' + encodeURIComponent(pageno) + '&typeid=' + encodeURIComponent(propertytypes) + '&checkin=' + encodeURIComponent(checkin) + '&checkout=' + encodeURIComponent(checkout) +  '&minprice=' + encodeURIComponent(minprice)  + '&maxprice=' + encodeURIComponent(maxprice) + '&city=' + encodeURIComponent(locations) + '&roomtypes=' + encodeURIComponent(roomtypes) + '&amenities=' + encodeURIComponent(amenities) +'&sortBy=' + encodeURIComponent(sortBy)+'&group_type='+group_type+'&age_ranges='+age_ranges;
			
		$("#listLoading").show();
		$.ajax({
		  type: 'post',
		  data: dataString,
		  url: '<?php echo FRONTEND_URL;?>maplist/get_map_data/',
		  beforeSend: function(){},
		  success: function(data){
			 getHtml(data) ;
		  }
		});
	 }
	 
	 
	 
	 function setPaginationData(element){
		var pagi_page = $(element).attr('data-pagi');
		if (pagi_page=='') {
			pagi_page = 1;
		}
		$("input#page").val(pagi_page);
		loadMarkers('', '', '', '', pagi_page);
		 return false;
	}

	/**
	* Load marker to map
	*/
	function loadMarker(markerData){
					//alert("marker");
		//alert(markerData);
			// create new marker location
			var lat = markerData.latitude;
			var lng = markerData.longitude;
			var image = {
					//url: '<?php echo CDN_IMAGE_PATH;?>mapIcons/map-pin-n1.png'
		url: '<?php echo FRONT_IMAGE_PATH;?>mapIcons/map-pin-n1.png'
			};
			
					
			var myLatlng = new google.maps.LatLng(lat, lng);
			
			//latlngbounds.extend( myLatlng );
			//bounds.extend(myLatlng);
			// create new marker				
			var marker = new google.maps.Marker({
					id: markerData.property_id,
					map: map, 
					tooltip: markerData.property_name,
					position: myLatlng,
					icon: image,
					visible: true
			});
			
			var tooltip = new Tooltip({map: map}, marker);
			tooltip.bindTo("text", marker, "tooltip");
			google.maps.event.addListener(marker, 'mouseover', function() {
					tooltip.addTip();
					tooltip.getPos2(marker.getPosition());
			});
			
			google.maps.event.addListener(marker, 'mouseout', function() {
					tooltip.removeTip();
			});
			
			// add marker to list used later to get content and additional marker information
			markerList[marker.id] = marker;
			markers.push(marker);
			
			
			// add event listener when marker is clicked
			// currently the marker data contain a dataurl field this can of course be done different
			google.maps.event.addListener(marker, 'click', function() {      
					// show marker when clicked
					showMarker(marker.id);
			});    
			//map.setCenter(myLatlng);      
			//map.fitBounds(bounds);    
			//map.setZoom(defaultZoom);    
	}

	/**
	* Show marker info window
	*/

  function showMarker(markerId){
	 
		  var marker = markerList[markerId];
		  var guest = $("#guest").val();
		  var group_type = $("#group_list").val();
		  var age_ranges = $("#ageRangess").val();
		  var checkin       = $('#mapcheckInn').val().replace('/', '-').replace('/', '-'); 
		  var checkout      = $('#mapcheckOutn').val().replace('/', '-').replace('/', '-');
		  // get marker detail information from server
		  $.get( infoWindowFile + markerId + '/' ,
				  {guest : guest, checkin: checkin, checkout:checkout, group_type:group_type, age_ranges:age_ranges},
				  function(data) {		
				// show marker window
				var infoStr = '<div class="infobox-wrapper"><div id="infobox">'+data+'</div></div>';
				var infobox = {
				  content: infoStr,
				  disableAutoPan: false,
				  maxWidth: 0,
				  pixelOffset: new google.maps.Size(-140, 0),
				  zIndex: null,
				  boxStyle: {
						background:"#ffffff",
						opacity: 1,
						width: "280px"
				  },
				  boxClass: "infoWindow",
				  closeBoxMargin: "10px 2px 2px 2px",
				  closeBoxURL: "<?php echo FRONT_IMAGE_PATH;?>map-close.png",
				  infoBoxClearance: new google.maps.Size(1, 1),
				  isHidden: false,
				  pane: "floatPane",
				  enableEventPropagation: true
				};
				
				currentInfoWindow = infobox;            
				ib = new InfoBox(infobox);
				var disabledDblClick = '';            
				google.maps.event.addListener(ib, 'closeclick', function() {
					 map.set("disableDoubleClickZoom", false);
					 map.set("drag", false);
				});
				ib.open(map, marker);
		  });	
  }

	 
	 function getCheckedPropertyTypes(){
		var checkbox = document.getElementsByName('filterpropType[]');	
			var property_type ='';
			for(var i=0; i< checkbox.length; i++) {
				if(checkbox[i].checked){
					if ($(checkbox[i]).val() != '') {
						property_type =  $(checkbox[i]).val()+ ","+ property_type;
					}
				}
			}
			
			property_type = property_type.slice(0,-1);
			
			return (property_type);
	}

	function getCheckedRooms(){
		var checkbox = document.getElementsByName('filterRoomtype[]');	
			var room ='';
			for(var i=0; i< checkbox.length; i++) {
				if(checkbox[i].checked){
					if ($(checkbox[i]).val() != '') {
						room =  $(checkbox[i]).val()+ ","+ room;
					}
				}
			}
			room = room.slice(0,-1);
			return (room);
	}
	
	 function getCheckedAmenities(){ 
			var checkbox = document.getElementsByName('filterammenities[]');	
			var ami ='';
			for(var i=0; i< checkbox.length; i++) {
				if(checkbox[i].checked){
					if ($(checkbox[i]).val() != '') {
						ami =  $(checkbox[i]).val()+ ","+ ami;
					}
				}
			}
			
			ami = ami.slice(0,-1);
			return (ami);
	 }
	 
	 
	 function highlightMarker(markerId, opt){
		
			// get marker information from marker list
			var marker = markerList[markerId];
			// check if marker was found
			
			if(marker)
			{
					//alert(marker.getZIndex());
					if (parseInt(opt) == 1)
		{
							marker.setIcon('<?php echo FRONT_IMAGE_PATH;?>mapIcons/map-pin-h.png');
							marker.setZIndex(999);            
					}
		else
		{
							marker.setIcon('<?php echo FRONT_IMAGE_PATH;?>mapIcons/map-pin-n1.png');
							
					}
					
			}
	}
	 
	 
	 
	 //jQuery(function ($) {
	 $(document).ready(function(){
		  var allVals = [];
		  //alert('<><>');
		  setTimeout(function(){
			 $('.ageRanges:checked').each(function () {
			 allVals.push($(this).val());
		  })
			 $('#ageRangess').val(allVals);
		  },100);
		  
		  
		  doSearch();
		  
		  
		  $('.regularcheckbox,.list_guest').click(function(){
			 doSearch();
		  });
		  
		  
	 }); 

	 $('#reset-search').click(function(){
		  window.location.reload(true);
	 });

	 function doSearch(){
		loadMap();
	 }
	 
	 function stripslashes(str) {
		return (str + '')
			.replace(/\\(.?)/g, function(s, n1) {
				switch (n1) {
					case '\\':
						return '\\';
					case '0':
						return '\u0000';
					case '':
						return '';
					default:
						return n1;
				}
			});
	}
	 
</script>

<input type="hidden" id="zoom" value="<?php echo $zoom;?>" />
<input type="hidden" id="cp_lat" value="<?php echo $cp_lat;?>" />
<input type="hidden" id="cp_lng" value="<?php echo $cp_lng;?>" />
<input type="hidden" id="city_id" value="<?php echo $citydata[0]['city_master_id']?>">
<input type="hidden" id="ageRangess" >


<div class="mapPan clearfix">
  <div class="proDisplay">
	 <div class="proBtns clearfix">
		<div class="btnLt alignleft">
		  <a href="javascript:void(0)" class="blBtn filterbutton">Filter</a>
		  <a href="<?php echo $grid_url;?>" class="blBtn filterbutton">Back to List</a>
		</div>
	 </div>
	 
	 
	 <div class="filterTab" id="filterTab" style="display: none;">
		<div class="filterColumn" id="horizontalTab">
		  <ul class="resp-tabs-list">
			 <li><a class="priceTag">Price</a></li>
			 <li><a class="priceTag">Property Type</a></li>
			 <li><a class="priceTag">Room Type</a></li>
			 <li><a class="priceTag">Facilities</a></li>
		  </ul>
		  <div class="resp-tabs-container">
			 <div class="block priceRange">
				<div class="priceSlider">
				  <p><label for="amount">Price range:</label><span id="amount"></span></p>
				  <div id="listpricerange"></div>
				  <input id="startprice" name="startprice" value="0" type="hidden">
				  <input id="endprice" name="endprice" value="25000" type="hidden">
				  <input id="sliderstep" name="sliderstep" value="50" type="hidden">
				  <input id="minprice" name="minprice" value="" type="hidden">
				  <input id="maxprice" name="maxprice" value="" type="hidden">
				  <input id="currencySymbol" name="currencySymbol" value="" type="hidden">
				</div>
				<div id="slider-range"></div>
			 </div>
			 <div id="box_filter_proptype" class="filter-section">
				<div id="filter_proptype">
				  <ul>
					  <?php foreach($property_type_list as $prop_type){?>
					  <li><input type="checkbox" class="regularcheckbox" id="protype-<?php echo $prop_type['property_type_id'];?>" name="filterpropType[]" value="<?php echo $prop_type['property_type_id'];?>"><label for="roomType<?php echo $prop_type['property_type_slug'];?>"><?php echo ucwords(stripcslashes($prop_type['property_type_name']));?></label></li>
					  <?php } ?>
					  
				  </ul>
				</div>
			 </div>
				
			 <div id="box_filter_roomtype" class="filter-section">
				<div id="filter_roomtype">
				  <ul>
					  <?php foreach($roomtype_list as $room_type){?>
					  <li><input type="checkbox" class="regularcheckbox" id="roomtype-<?php echo $room_type['roomtype_id'];?>" name="filterRoomtype[]" value="<?php echo $room_type['roomtype_id'];?>"><label for="roomType<?php echo $room_type['roomtype_slug'];?>"><?php echo ucwords(stripcslashes($room_type['roomtype_slug']));?></label></li>
					  <?php } ?>
					  
				  </ul>
				</div>
			 </div>
				
			 <div id="box_filter_facilities" class="filter-section">
				<div id="filter_facilities">
				  <ul class="facilities_list">
					  <?php foreach($facility_list as $fac){?>
					  <li><input type="checkbox" class="regularcheckbox" name="filterammenities[]" value="<?php echo $fac['amenities_id'];?>"><label for="facility<?php echo $fac['amenities_id'];?>"><?php echo ucwords(stripcslashes($fac['amenities_name']));?></label></li>
					  <?php } ?>
				  </ul>
				</div>
			 </div>
		  </div>
		</div>
	 </div>
	  
	 
  </div>
  
  <div class="mainWrap clearfix">
	 <div id="map_canvas" style="width: 100%; height: 590px;"></div>
  </div>
  
  		<div class="searchContainer globalClr" id="tabContent" style="display: none;">
			<div class="searchPan globalClr active">
				<div class="searchPanIn globalClr clearfix">
					<div class="calSec ltCls">
						<div id="mapCal" class="cincout-contener-static"></div>
						<input type="text" value="<?php echo $check_in;?>" name="" id="mapcheckInn" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
						<input type="hidden" value="<?php echo $group_type;?>" id="group_type" />
						<input type="hidden" value="<?php echo $age_ranges;?>" id="age_ranges"  />
						<input type="hidden" value="<?php echo $guest;?>" id="guest"  />
						<label for="mapcheckInn" class="calicon1"><i class="fa fa-calendar"></i></label>
						<input type="text" value="<?php echo $check_out;?>" name="" id="mapcheckOutn" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
						<label for="mapcheckOutn" class="calicon2"><i class="fa fa-calendar"></i></label>
					</div>
					<div class="searchBtn rtCls">
						<a href="javascript:void(0);" title="" class="searchRes"><?php echo $totalCount;?> Results</a>
					</div>
				</div>
			</div>
		</div>
		
		
		<div id="searchWithPricePan" class="mapWithSearchDate globalClr priceSliderSec clearfix">
<!--			<div class="priceLable ltCls">
				<label for="amount">Price range:</label>
				<span id="amount"></span>
			</div>
-->			<div class="priceSlider rtCls">
				<!--<div id="listpricerange"></div>-->
				<input id="startprice" type="hidden" name="startprice" value="0" />
				<input id="endprice" type="hidden" name="endprice" value="25000" />
				<input id="sliderstep" type="hidden" name="sliderstep" value="50" />
				<input id="minprice" type="hidden" name="minprice" value="0" />
				<input id="maxprice" type="hidden" name="maxprice" value="25000" />
				<input id="currencySymbol" type="hidden" name="currencySymbol" value="<?php echo $this->nsession->userdata('currencySymbol'); ?>" /><div id="slider-range"></div>
			</div>
		</div>
		
	 <div style="display: none;">
		<input type="text" name="ne_lat_hidden" id="ne_lat_hidden" value="">
		<input type="text" name="ne_lng_hidden" id="ne_lng_hidden" value="">
		<input type="text" name="sw_lat_hidden" id="sw_lat_hidden" value="">
		<input type="text" name="sw_lng_hidden" id="sw_lng_hidden" value="">
		<input type="text" name="zoom_hidden" id="zoom_hidden" value="11">
		<input type="text" name="cp_lat_hidden" id="cp_lat_hidden" value="">
		<input type="text" name="cp_lng_hidden" id="cp_lng_hidden" value="">
		<input type="text" name="sort_by" id="sort_by" value="" />
	 </div>
  
</div>








<?php
/*

<div class="mapPan clearfix">
  
  <div class="proDisplay">
	 <div class="proBtns clearfix">
			<div class="btnLt alignleft">
				
				<a href="javascript:void(0)" class="blBtn filterbutton">Filter</a>
				<!--<a href="javascript:void(0)" class="blBtn">Sort</a>
				
				 <select name="perpage" id="perpage">
						<option  value="1">1</option>
						<option selected="selected" value="4">4</option>
						<option value="10">10</option>
						<option  value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="all">All</option>
				 </select>
				 <select name="sortby" id="sortby">
						<option selected="selected" value="name-az">Name (A-Z)</option>
						<option value="name-za">Name (Z-A)</option>
						<option value="price-asc">Price: Low to High</option>
						<option value="price-desc">Price: High to low</option>
				 </select>-->
			</div>
			<!--<div class="btnRt alignright">
				 <em>Display :</em> 
				 <a class="blBtn listclass active" href="#">List</a>
				 <a class="blBtn gridclass" href="#">Grid</a>
				 <a class="blBtn" href="<?php //echo FRONTEND_URL;?>maplist/<?php //echo $map_url;?>">Map</a>
			</div>-->
	 </div>
	 	 <div class="filterTab" id="filterTab" style="display: none;">
		<div class="filterColumn" id="horizontalTab">
			<ul class="resp-tabs-list">
			<li><a class="priceTag">Price</a></li>
			<li><a class="priceTag">Property Type</a></li>
			<li><a class="priceTag">Room Type</a></li>
			<li><a class="priceTag">Facilities</a></li>
			</ul>
			<div class="resp-tabs-container">
				<div class="block priceRange">
								<div class="priceSlider">
									<p>
									<label for="amount">Price range:</label>
									<span id="amount"></span> </p>
									<div id="listpricerange"></div>
									<input id="startprice" name="startprice" value="0" type="hidden">
									<input id="endprice" name="endprice" value="25000" type="hidden">
									<input id="sliderstep" name="sliderstep" value="50" type="hidden">
									<input id="minprice" name="minprice" value="" type="hidden">
									<input id="maxprice" name="maxprice" value="" type="hidden">
									<input id="currencySymbol" name="currencySymbol" value="" type="hidden">
								</div>
								<div id="slider-range"></div>
							</div>
				<div id="box_filter_proptype" class="filter-section">
					<div id="filter_proptype">
						<ul>
							<?php foreach($property_type_list as $prop_type){?>
							<li><input type="checkbox" id="protype-<?php echo $prop_type['property_type_id'];?>" name="filterpropType[]" value="<?php echo $prop_type['property_type_id'];?>"><label for="roomType<?php echo $prop_type['property_type_slug'];?>"><?php echo stripcslashes($prop_type['property_type_name']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<div id="box_filter_roomtype" class="filter-section">
					<div id="filter_roomtype">
						<ul>
							<?php foreach($roomtype_list as $room_type){?>
							<li><input type="checkbox" id="roomtype-<?php echo $room_type['roomtype_id'];?>" name="filterRoomtype[]" value="<?php echo $room_type['roomtype_id'];?>"><label for="roomType<?php echo $room_type['roomtype_slug'];?>"><?php echo stripcslashes($room_type['roomtype_slug']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<div id="box_filter_facilities" class="filter-section">
					<div id="filter_facilities">
						<ul class="facilities_list">
							<?php foreach($facility_list as $fac){?>
							<li><input type="checkbox" class="list_facility regularCheckbox" name="filterAmmenities[]" value="<?php echo $fac['amenities_slug'];?>"><label for="facility<?php echo $fac['amenities_id'];?>"><?php echo stripcslashes($fac['amenities_name']);?></label></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
	 </div>
	 </div>

</div>
  
  
  
  
	<div class="aignleft mapLt leftmap">
		 <div class="mainWrap clearfix">
	<div class="mapListLeft">   
		<div id="map_canvas" style="width: 845px; height: 590px;"></div>
	</div>
	<div class="mapListRight">
		<div class="backtoSearch globalClr">
			<a class="inputBtnOth" href="<?php echo $grid_url;?>">Back to list view</a>
		</div>
		<div class="searchContainer globalClr" id="tabContent" style="display: none;">
			<div class="searchPan globalClr active">
				<div class="searchPanIn globalClr clearfix">
					<div class="calSec ltCls">
						<div id="mapCal" class="cincout-contener-static"></div>
						<input type="text" value="<?php echo $check_in;?>" name="" id="mapcheckInn" class="ltCls cincout-input cincout-chkin" placeholder="Check-in" />
						<input type="hidden" value="<?php echo $group_type;?>" id="group_type" />
						<input type="hidden" value="<?php echo $age_ranges;?>" id="age_ranges"  />
						<input type="hidden" value="<?php echo $guest;?>" id="guest"  />
						<label for="mapcheckInn" class="calicon1"><i class="fa fa-calendar"></i></label>
						<input type="text" value="<?php echo $check_out;?>" name="" id="mapcheckOutn" class="rtCls cincout-input cincout-chkout" placeholder="Check-out" />
						<label for="mapcheckOutn" class="calicon2"><i class="fa fa-calendar"></i></label>
					</div>
					<div class="searchBtn rtCls">
						<a href="javascript:void(0);" title="" class="searchRes"><?php echo $totalCount;?> Results</a>
					</div>
				</div>
			</div>
		</div>
		<div id="searchWithPricePan" class="mapWithSearchDate globalClr priceSliderSec clearfix">
<!--			<div class="priceLable ltCls">
				<label for="amount">Price range:</label>
				<span id="amount"></span>
			</div>
-->			<div class="priceSlider rtCls">
				<!--<div id="listpricerange"></div>-->
				<input id="startprice" type="hidden" name="startprice" value="0" />
				<input id="endprice" type="hidden" name="endprice" value="25000" />
				<input id="sliderstep" type="hidden" name="sliderstep" value="50" />
				<input id="minprice" type="hidden" name="minprice" value="0" />
				<input id="maxprice" type="hidden" name="maxprice" value="25000" />
				<input id="currencySymbol" type="hidden" name="currencySymbol" value="<?php echo $this->nsession->userdata('currencySymbol'); ?>" /><div id="slider-range"></div>
			</div>
		</div>
<!--		<div class="mapSearesulPan">
			<ul class="propListMap clearfix"></ul>
			<div id="noRecordWrap" style="text-align:center"></div>
			<div class="pagiWrapper"></div>
		</div>
-->	</div>
</div>

		 <span>Property Description</span>
	</div>
<!--	<div class="alignright bookNw rightmap">
		 <div class="blueUp">
				<div class="blueRate">
					 8.5 
				</div>
				<div class="fav">
					 Fabulous
					 <a href="#"> <em>558</em>  Total Reviews</a>
				</div>
		 </div>
		 <div class="blueBar">
				<div class="blueBarIn">
					 <span style="width: 100%">Value For Money</span>
					 <span>10.0</span>
				</div>
				<div class="blueBarIn">
					 <span style="width: 65%">Security</span>
					 <span>6.5</span>
				</div>
				<div class="blueBarIn">
					 <span style="width:95%">Location</span>
					 <span>9.5</span>
				</div>
				<div class="blueBarIn">
					 <span style="width: 100%">Staff</span>
					 <span>10.0</span>
				</div>
				<div class="blueBarIn">
					 <span style="width:65%">Atmosphere</span>
					 <span>6.5</span>
				</div>
				<div class="blueBarIn">
					 <span style="width: 90%">Cleanliness</span>
					 <span>9.0</span>
				</div>
				<div class="blueBarIn">
					 <span style="width:95%">Facilities</span>
					 <span>9.5</span>
				</div>
				<a href="#">BOOK NOW</a>
		 </div>
	</div>
--></div>
<!--<div class="mapBtm">
	<p> Unrivalled facilities with FREE: WiFi, laundry, TEA and COFFEE, tennis, volleyball, basketball, table tennis, SAUNA, swimming pool, body boards, sunscreen, movies, Playstation, 24 hr Sports Channels, BBQ's...
		 Licenced bar with Pool table, PacMan, SpaceInvaders, Frogger... <br><br>
		 Volleyball fun each night. Quiz nights. Pizza night, Poker......... Deals with local cafes..... <br><br>
		 150m to patrolled beach. FREE courtesy bus to the Transit Centre/bus station. Trams and buses outside the hostel.<br>
		 Centrally located to nightclubs and designer shopping in Surfers Paradise as well as the trendy restaurant and cafe scene in Broadbeach, with concert and sporting venues nearby...<a href="#">Show more</a>
	</p>
</div>-->



<div style="display: none;">
	<input type="text" name="ne_lat_hidden" id="ne_lat_hidden" value="">
	<input type="text" name="ne_lng_hidden" id="ne_lng_hidden" value="">
	<input type="text" name="sw_lat_hidden" id="sw_lat_hidden" value="">
	<input type="text" name="sw_lng_hidden" id="sw_lng_hidden" value="">
	<input type="text" name="zoom_hidden" id="zoom_hidden" value="11">
	<input type="text" name="cp_lat_hidden" id="cp_lat_hidden" value="">
	<input type="text" name="cp_lng_hidden" id="cp_lng_hidden" value="">
	<input type="text" name="sort_by" id="sort_by" value="" />
</div>
*/?>
