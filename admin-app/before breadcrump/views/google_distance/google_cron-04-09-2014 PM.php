<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH; ?>gmap/gmaps.js"></script>
  
<?php
// pr($map_list,1);

 $map_arr = json_encode($map_list);
?>
  <div id="map" class="metrixMap" style=" height: 150px; width: 600px; display: none;" ></div>
  
  
<!--------------------------------------------- For Google Map------------------------------------------------------->
<script>

  var map_arr       = <?php echo $map_arr;?>;
  //total_record      = map_arr.length;
  total_record      = 50;
  final_result      = [];
  cnt               = 1;
  var arr_len       = map_arr.length;
  var initial       = 0;
  var map, dms;
  var dirService, dirRenderer;
  var highlightedCell;
  var routeQuery;
  var bounds;
  var panning       = false;

 
 
 function initialize(lat,long,origins,destinations,query,latitude_arr,longitude_arr,property_id) {

    var beach_name  = '';
    beach_name = $.merge([], destinations);
    
    var mapOptions = {
      center: new google.maps.LatLng(lat, long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
   
    for (var i = 0; i < origins.length; i++) {
      origins[i] = lat+","+long;
    }        
    
    for (var j = 0; j < destinations.length; j++) {
      destinations[j] = latitude_arr[j]+","+longitude_arr[j];
    }
  
    dms = new google.maps.DistanceMatrixService();

    //dirService = new google.maps.DirectionsService();
    //dirRenderer = new google.maps.DirectionsRenderer({preserveViewport:true});
    //dirRenderer.setMap(map);
   
    google.maps.event.addListener(map, 'idle', function() {
      if (panning) {
        map.fitBounds(bounds);
        panning = false;
      }
    });
    
    //google.maps.event.trigger(map, 'resize');
    
    updateMatrix(query,property_id,beach_name);

  }

  function updateMatrix(query,property_id,beach_name) { 
    dms.getDistanceMatrix(query, function(response, status) {
        if (status == "OK")
        {
          populateTable(response.rows,property_id,beach_name);          
        }
      }
    );
  }
  

 
    function populateTable(rows,property_id,beach_name)
    {
     var single_arr = '';
     //single_arr = "property_id--> "+ property_id + " , ";
      single_arr = property_id + ",";
     for (var i = 0; i < rows.length; i++)
     {
       for (var j = 0; j < rows[i].elements.length; j++)
       {
         if (rows[i].elements[j].distance == '' || typeof rows[i].elements[j].distance == "undefined" || typeof rows[i].elements[j].duration == "undefined") {
         var distance = 'Invalied'
       }
       else
       {
         var distance = rows[i].elements[j].distance.text;
         var duration = rows[i].elements[j].duration.text;
       }
       //single_arr = single_arr + beach_name[j] + "--> " + distance + " , ";
       single_arr = single_arr + distance;    
       }
    }
    final_result.push( single_arr );
    if (cnt == total_record)
    {
      $.ajax({
		type: "POST",
		url: "<?php echo BACKEND_URL; ?>" + "google_distance/database_store",
		data: {final_result: final_result,cnt: cnt},
		success:function(data) {                  
                  alert("Cronjob Successfully Completed");
		}
            });
    }
      cnt++;
   
  } 

  var delay_value = 1000;
  
  function start_cron(){

for(var index = 0 ; index<100 ; index++){
//alert(delay_value);
  setTimeout(function(){
    
  for(var initial=index;initial<index+1;initial++)
  {       
          origins                     =   map_arr[initial]['map_details']['origin'];
          destinations                =   map_arr[initial]['map_details']['destination'];
          latitude_arr                =   map_arr[initial]['map_details']['latitude_arr'];
          longitude_arr               =   map_arr[initial]['map_details']['longitude_arr'];
          location_type_arr           =   map_arr[initial]['map_details']['location_type_arr'];
          property_id                 =   map_arr[initial]['property_id'];
          
          //alert(property_id);alert(origins);alert(destinations);alert(latitude_arr);alert(longitude_arr);alert(location_type_arr);        
           var query = {
          origins: origins,
          destinations: destinations,
          travelMode: google.maps.TravelMode.WALKING,
          unitSystem: google.maps.UnitSystem.METRIC
       };     
     
        var lat	                    = 	map_arr[initial]['map_details']['lat'];
        var long                    = 	map_arr[initial]['map_details']['long'];       
        initialize(lat,long,origins,destinations,query,latitude_arr,longitude_arr,property_id);
  }    
    }, delay_value);
  
  delay_value = delay_value + 100;
  
}
  
}
 $(function(){ start_cron(); });
</script>

<!------------------------------------------------------------------------------------------------------------------->

     
