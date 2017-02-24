<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo FRONT_JS_PATH; ?>gmap/gmaps.js"></script>

<div id="map" class="metrixMap" style=" height: 150px; width: 600px; display: none;" ></div>
  
  
<!--------------------------------------------- For Google Map------------------------------------------------------->
<script>

 
  //total_record      = map_arr.length;
  total_record      = <?php echo count($map_list)?>;
  starting_val      = <?php echo $starting_val?>;
  ending_val        = <?php echo $ending_val?>;
  remainder         = <?php echo count($map_list)%100;?>;
  
  final_result      = [];
  cnt               = 1;
  var initial       = 0;
  var map, dms;
  var dirService, dirRenderer;
  var highlightedCell;
  var routeQuery;
  var bounds;
  var panning       = false;
  count_val         = 0;
 
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
    
   query['origins'] = origins;
   query['destinations'] = destinations;
    
    //alert(JSON.stringify(query));
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
      //single_arr = "prop_id-> "+property_id + ",";
      single_arr = property_id+"--";
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
       single_arr = single_arr +distance;    
       }
    }

    final_result.push( single_arr );
//alert(final_result.length);
    if (final_result.length == 100 || (ending_val-starting_val) == remainder )
    {
      $.ajax({
		type: "POST",
		url: "<?php echo BACKEND_URL; ?>" + "google_distance/database_store",
		data: {final_result: final_result,starting_val: starting_val,ending_val: ending_val,total_record: total_record,remainder: remainder},
		success:function(data) {
                  if(data!=0) {
                     window.location = data;
                 }else{
                  alert("Cron Successfully Completed");
                 }                 
		}
            });
    }

  } 

</script>

<!------------------------------------------------------------------------------------------------------------------->

   <?php
   $i = 0;
   $no_of_loop  = floor(count($map_list)/100);

    for($i=$starting_val; $i<$ending_val;$i++)
    {
          $query  = array();
          $query = array(
                "origins"  => $map_list[$i]['map_details']['origin'],
                "destinations"  => $map_list[$i]['map_details']['destination'],
                "travelMode"  => "WALKING"
                );
    ?>
          <script>
           
           initialize(<?php echo $map_list[$i]['map_details']['lat']?>,<?php echo $map_list[$i]['map_details']['long']?>,<?php echo json_encode($map_list[$i]['map_details']['origin']);?>,<?php echo json_encode($map_list[$i]['map_details']['destination']);?>,<?php echo json_encode($query); ?>,<?php echo json_encode($map_list[$i]['map_details']['latitude_arr']);?>,<?php echo json_encode($map_list[$i]['map_details']['longitude_arr']);?>,<?php echo $map_list[$i]['property_id'];?>);
           
          </script>            
  <?php 
        }
  ?>
