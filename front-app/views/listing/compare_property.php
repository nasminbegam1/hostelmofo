<style type="text/css">
/***************27/10/2016*******************/
h2.compare_result {
    border-bottom: 1px dotted #ccc;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    padding-right: 3rem;
    font-family: "Open Sans",sans-serif;
    background: url(../images/heading_icon.jpg) no-repeat 0 8px;
    padding: 0 0 15px 30px;
    margin-top: 0px;
    font-weight:normal;
    color: #ca3c08;
}

table.comparetable {
    background-color: transparent;
    border: 1px solid #e2e2e2;
    margin: 0;
    table-layout: auto;
}

.comparetable td.c_leftcol {
    background-color: #f7f7f7;
    font-size: 0.75rem;
    vertical-align: middle;
}
.comparetable td {
    font-size: 0.75rem;
    padding: 0.5rem;
}
table.comparetable thead tr th, table tfoot tr th, table tbody tr td, table tr td, table tfoot tr td {
    border-bottom: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    vertical-align: top;
}
table.comparetable thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td {
    display: table-cell;
    line-height: 1.125rem;
}
table.comparetable thead tr th, table tfoot tr th, table tbody tr td, table tr td, table tfoot tr td {
    border-bottom: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    vertical-align: top;
}
table.comparetable tr th, table tr td {
    font-size: 0.8rem;
    padding: 0.75rem;
}
table.comparetable thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td {
    display: table-cell;
    line-height: 1.125rem;
}
.comparetable td.c_leftcol h4 {
    color: #ca3c08;
    font-weight: bold;
    font-size: 1rem;
}
.comparetable td h4 {
    margin: 0;
}

.comparetable td.c_prop1, .comparetable td.c_prop2, .comparetable td.c_prop3, .comparetable td.c_prop4, .comparetable td.c_prop5 {
    text-align: center;
    vertical-align: top;
}
.comparetable td {
    font-size: 0.75rem;
    padding: 0.5rem;
}
table thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td {
    display: table-cell;
    line-height: 1.125rem;
}

.comparetable td.c_propheader .c_hidecolumn {
    cursor: pointer;
    float: right;
}

.proptype, .cardproptype {
    color: #aaa;
    font-size: 0.65rem;
    text-transform: uppercase;
}


.c_propheader h4 {
    font-size: 1rem;
    font-weight:normal;
}

.comparetable .fa-times {
    background-color: #ca3c08;
    color: #fff;
    height: 2rem;
    line-height: 1.1rem;
    padding: 0.5rem;
    text-align: center;
    width: 2rem;
}
.rounded {
    border-radius: 3px !important;
}
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}

.comparetable .fa-check {
    background-color: #8acb75;
    color: #fff;
    height: 2rem;
    line-height: 1.1rem;
    padding: 0.5rem;
    text-align: center;
    width: 2rem;
}


.c_restore {
    color: #ca3c08;
    cursor: pointer;
    float: right;
    font-size: 14px;
    font-weight: bold;
    margin-top: 0.75rem;
}

.comparetable td.c_propheader .c_hidecolumn i.fa-times {
    background-color: transparent;
    height: auto;
    padding: 0;
    width: auto;
}

div#compareModal .close-reveal-modal {
    top: -0.375rem;
}

div#compareModal .close-reveal-modal {
    top: -0.375rem;
}
.reveal-modal .close-reveal-modal, dialog .close-reveal-modal {
    color: #aaa;
    cursor: pointer;
    font-size: 2.5rem;
    font-weight: bold;
    line-height: 1;
    position: absolute;
    right: 1.375rem;
    top: 0.625rem;
}

.modal-header{
	 position: absolute;
	 top: 0;
	 right: 10px;
	
}

.close{	 
	 width: 20px;
	 height: 21px;
	 background: url("../images/cross_icon.jpg") no-repeat 0 0 !important;
	 border:0;
	 cursor: 
	 
}


#map_canvas{
    height: 400px;
    width: 100%;
}


</style>

<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');
?>

<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($city));
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($curl);
curl_close ($curl);
$response = json_decode($json);

$latitude = $response->results[0]->geometry->location->lat;
$longitude = $response->results[0]->geometry->location->lng;?>




 

<!--<script type="text/javascript">
    
    // zoom level of the map
    var defaultZoom     = 10;
    var map;
    function loadMap(args) {
        var defaultLatlng   = new google.maps.LatLng(<?php //echo $latitude; ?>, <?php //echo $longitude; ?>);
        
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
    }
    
    jQuery(function ($) {
        loadMap();
    }); 
</script>-->



<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	 <div class="modal-header">
		  <button type="button" class="close close-reveal-modal" data-dismiss="modal" aria-hidden="true"></button>
	 </div>
	 <div class="modal-body">
      <div class="myaccount circle"></div>
      <span class="c_restore"><i class="fa fa-undo"></i> Reset</span>
      <h2 class="compare_result">Compare Results</h2>
			<table class="comparetable" width="100%" cellspacing="0" cellpadding="0" border="0" id="comparetable">
				 <tbody>
                <?php $count = count($compare['prop']);?>
                <tr>
                    <td class="c_leftcol" width="20%"><h4>Overview</h4></td>
                    <?php //pr($compare,1);
                    foreach ($compare['prop'] as $k=>$c) { ?>
                    <td class="c_prop<?php echo $k;?> propbox" id="propertyHeader"  data-lat="<?php echo $c['latitude'];?>" data-lng="<?php echo $c['longitude'];?>" data-prop-id="<?php echo $c['property_master_id'];?>">
                        <div id="hideProperty_<?php echo $k;?>" class="c_hidecolumn" rel="<?php echo $c['property_master_id'];?>">
                            <i class="fa fa-times"></i>
                        </div>
                        <h4><?php echo stripslashes($c['property_name']);?></h4></td>
                    <?php } ?>
                </tr>
                
                <tr>
                    <td class="c_leftcol" width="20%">Privates From</td>
                    <?php foreach ($compare['private'] as $k=>$pr) {?>
                    <td class="c_prop<?php echo $k;?>"><?php if($pr['base_price'] == 0){ echo "N/A"; } else { if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo sprintf("%.2f",currentPrice1(stripslashes($pr['base_price']),$currencySymbol,$currencyRate)); } ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="c_leftcol" width="20%">Dorms From</td>
                    <?php foreach ($compare['dorm'] as $k=>$dr) {?>
                    <td class="c_prop<?php echo $k;?>"><?php if($dr['base_price'] == 0){ echo "N/A"; } else { if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo sprintf("%.2f",currentPrice1(stripslashes($dr['base_price']),$currencySymbol,$currencyRate)); } ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="c_leftcol" width="20%">Rating</td>
                    <?php foreach ($compare['feed'] as $k=>$r) {?>
                    <td class="c_prop<?php echo $k;?>"><?php echo stripslashes($r);?> (133 Reviews) </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="c_leftcol" width="20%">Distance from city centre</td>
                    <?php foreach ($compare['feed'] as $k=>$r) {?>
                    <td class="c_prop<?php echo $k;?>"><?php echo 0;?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="c_leftcol" width="20%"><h4>Facilities</h4></td>
                    <?php foreach ($compare['prop'] as $k=>$c) { ?>
                    <td class="c_prop<?php echo $k;?>"></td>
                    <?php } ?>
                </tr>
                
                
                <?php foreach($compare['name'] as $k=> $f_name){?>
                <tr class="<?php echo ($k<5) ? 'initial_show': 'not_initial_show';?>">
                    <td class="c_leftcol" width="20%"><?php echo stripslashes($f_name['facility_name']);?></td>
                    <?php foreach( $f_name['facility_count'] as $k=>$fc) {?>
                            <td style="text-align:center;" class="c_prop<?php echo $k;?>"><?php echo ($fc==0) ? '<i class="fa fa-times rounded"></i>' : '<i class="fa fa-check rounded"></i>';?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                
						
				 <tr>
				 <td class="c_leftcol" width="20%"><a href="javascript:void(0)" id="c_showFacilities">Show more</a></td>
				 <?php foreach ($compare['prop'] as $k=>$c) { ?>
                    <td class="c_prop<?php echo $k;?>"></td>
                    <?php } ?>
				 </tr>
				 <tr>
				 <td class="c_leftcol" width="20%"><h4>Location</h4></td>
				 <td class="c_map" colspan="<?php echo $count;?>">
				 <div id="map_canvas"></div>
				 </td>
				 </tr>
				 </tbody>
			</table>
    	
	 </div>
</div>

<script type="text/javascript">
    var map;var markers = [];
    function initMap() {
        
        var defaultLatlng = {lat: <?php echo ($latitude!='')? $latitude: '-25.363'?>, lng: <?php echo ($longitude!='')? $longitude: '131.044'?>};
        map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 12,
          center: defaultLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        
      }
      var infowindow = new google.maps.InfoWindow();
      function setMarker(propId, lat,lng){
        var marker ='';
        var contentString = "<p>"+propId+"</p>";
         marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat,lng) ,
          map: map
        });
        
        google.maps.event.addListener(marker, "click", function (e) {
            $.ajax({
            url: base_url+"listing/getAjaxPropDetails/"+propId,
            type:'GET',
            success:function(response){
                infowindow.setOptions({closeBoxMargin: "10px 2px 2px 2px",
				  closeBoxURL: "<?php echo FRONT_IMAGE_PATH;?>map-close.png",
				  infoBoxClearance: new google.maps.Size(1, 1),});
                infowindow.setContent('<div class="infoWindow" style="width:280px;"><div class="infobox-wrapper"><div id="infobox">'+response+'</div></div></div>');
                infowindow.open(map, marker);
            }
            });
            
        });
        markers[propId] = marker;
      }
      function removeMarker(propId){
        var marker = markers[propId];
        marker.setMap(null);
      }
      function loadAllMarker(){
        
        $(".propbox").each(function(){
            var propId = $(this).attr('data-prop-id');
            var lat = $(this).attr('data-lat');
            var lng = $(this).attr('data-lng');
            setMarker(propId, lat,lng);
          })
      }
$(function(){
    initMap();
    loadAllMarker();
    
    $(document).on('click',".c_hidecolumn",function(){
        var propId = $(this).parents('td').attr('data-prop-id');
        var className = $(this).parents('td.propbox').attr('class');
        className  = className.replace(' propbox','');
        removeMarker(propId);
        $('td.'+className).hide();
    });
    
    
    $(document).on('click',".c_restore",function(){
        $('#comparetable tr td').show();
        loadAllMarker();
    });
})
</script>