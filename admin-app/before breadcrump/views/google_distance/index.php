<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH; ?>gmap/gmaps.js"></script>
<link type="text/css" href="http://192.168.0.111/livephuket/css/style-2.css" rel="stylesheet">

<form name="updateMap" id="updateMap" method="POST" >
	
	Latitude 	<input type="text" name="latitude" id="latitude" value="" >
	Longitude 	<input type="text" name="longitude" id="longitude" value="" >
	<input type="button" id="get_distance" name="get_distance" value="Get Distance">
	<br><br><br><br>	
	<div id="distance_data"></div>
	
</form>	
<script>
$('#get_distance').on('click', function() {

	var latitude		= $("#latitude").val();
	var longitude		= $("#longitude").val();
	
	$.ajax({
		type: "POST",
		url: "<?php echo BACKEND_URL; ?>" + "google_distance/get_distance",
		data: {latitude:latitude,longitude:longitude},
		success:function(data) {
				$("#distance_data").html(data);
				initialize();
		}
	
	});

});
	
</script>	
	