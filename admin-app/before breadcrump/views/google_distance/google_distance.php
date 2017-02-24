<?php pr($map_list,1);?>
  
<!--------------------------------------------- For Google Map------------------------------------------------------->
<script>

var     slug                =   '<?php echo $map_details['option'];?>';
var     propName            =   '<?php echo  $map_details['prop_name'];?>';
var     beach_count         =   <?php echo  $map_details['beach_count'];?>;
var     attraction_count    =   <?php echo  $map_details['attraction_count'];?>;
var     shopping_count      =   <?php echo  $map_details['shopping_count'];?>;
var     imp_services_count  =   <?php echo  $map_details['important_serveices'];?>;
var     total_record        =   <?php echo  $map_details['total_record'];?>;

origins                 =   $.parseJSON(<?php print json_encode(json_encode( $map_details['origin'])); ?>); 
destinations            =   $.parseJSON(<?php print json_encode(json_encode( $map_details['destination'])); ?>); 
latitude_arr            =   $.parseJSON(<?php print json_encode(json_encode( $map_details['latitude_arr'])); ?>);
longitude_arr           =   $.parseJSON(<?php print json_encode(json_encode( $map_details['longitude_arr'])); ?>);
location_type_arr       =   $.parseJSON(<?php print json_encode(json_encode( $map_details['location_type_arr'])); ?>);


//alert(origins);alert(destinations);alert(latitude_arr);alert(longitude_arr);alert(location_type_arr);

  var query = {
    origins: origins,
    destinations: destinations,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  };

  var map, dms;
  var dirService, dirRenderer;
  var highlightedCell;
  var routeQuery;
  var bounds;
  var panning = false;

  var lat 	= 	'<?php echo $map_details['lat']; ?>';
  var long 	= 	'<?php echo $map_details['long']; ?>';
  
  var myLatlng = new google.maps.LatLng(lat,long);
  //var marker = new google.maps.Marker({
  //  position: myLatlng,
  //  title: propName
  //  });
  function initialize() {
    var mapOptions = {
      zoom: 12,
      center: new google.maps.LatLng(lat, long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    createTable();
    
    for (var i = 0; i < origins.length; i++) {
      origins[i] = lat+","+long;
    }
    
    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
    marker.setMap(map);    
    
    //alert(origins[0]);
    for (var j = 0; j < destinations.length; j++) {
      destinations[j] = latitude_arr[j]+","+longitude_arr[j];
    }

    dms = new google.maps.DistanceMatrixService();

    dirService = new google.maps.DirectionsService();
    dirRenderer = new google.maps.DirectionsRenderer({preserveViewport:true});
    dirRenderer.setMap(map);
   
    google.maps.event.addListener(map, 'idle', function() {
      if (panning) {
        map.fitBounds(bounds);
        panning = false;
      }
    });
    
    google.maps.event.trigger(map, 'resize');
    updateMatrix();
  }

  function updateMatrix() {
    //alert(JSON.stringify(query));
    
    dms.getDistanceMatrix(query, function(response, status) {
        if (status == "OK") {
          populateTable(response.rows);
        }
      }
    );
  }

  
  
  
  //function createTable() {
  //  var table = document.getElementById('matrix');
  //  var tr = addRow(table);
  //  addElement(tr);
  //  for (var i = 0; i < origins.length; i++)
  //  {    
  //      for (var j = 0; j < destinations.length; j++)
  //      {            
  //                  if (j==beach_count) {
  //                      var td = addElement(tr);
  //                      td.appendChild(document.createElement("br"));
  //                      td.setAttribute("class", "attraction_header");
  //                      $(".attraction_header").hide();
  //                      
  //                  }
  //
  //                  if (j==(beach_count+attraction_count)) {
  //                      var td = addElement(tr);
  //                      td.appendChild(document.createElement("br"));
  //                      td.setAttribute("class", "services_header");
  //                      $(".services_header").hide();
  //                  }
  //                  
  //                   if (j==(beach_count+attraction_count+imp_services_count)) {
  //                      var td = addElement(tr);
  //                      td.appendChild(document.createElement("br"));
  //                      td.setAttribute("class", "shopping_header");
  //                      $(".shopping_header").hide();
  //                  }                    
  //                  
  //                  var td = addElement(tr, 'element-placeName-' + i + '-' + j);
  //                  td.setAttribute("class", "destination-"+i+"-"+j);
  //                  
  //                  
  //                  td.appendChild(document.createTextNode(destinations[j]));
  //                  td.onmouseover = getRouteFunction(i,j);
  //                  td.onclick = getRouteFunction(i,j);
  //                  
  //                  if (j>=0 && j<beach_count) {
  //                     td.setAttribute("class", "beach"); 
  //                  }
  //                  else if (j>=beach_count && j<=(beach_count+attraction_count-1)) {
  //                      td.setAttribute("class", "attraction");
  //                      $(".attraction").hide();
  //                  }
  //                  else if (j>=(beach_count+attraction_count-1) && j<=(beach_count+attraction_count+imp_services_count-1)) {
  //                      td.setAttribute("class", "shopping");
  //                      $(".shopping").hide();
  //                  }
  //                  else if (j>=(beach_count+attraction_count+imp_services_count-1) && j<=total_record) {
  //                      td.setAttribute("class", "services");
  //                      $(".services").hide();
  //                  }
  //                  
  //                  $('#element-placeName-' + i + '-' + j).addClass( "mapLtTitle" );
  //
  //      }
  //  }
  //
  //  for (var i = 0; i < origins.length; i++) {
  //    var tr = addRow(table);
  //    var td = addElement(tr);
  //    td.setAttribute("class", "origin beach");
  //    td.appendChild(document.createTextNode(origins[i]));
  //    for (var j = 0; j < destinations.length; j++) {  
  //                  
  //                  //if (j==0) {
  //                  //    td.setAttribute("class", "origin shopping"); 
  //                  //}
  //                                 
  //                  if (j==beach_count) {
  //                      var tr = addRow(table);
  //                      var td = addElement(tr);
  //                      td.setAttribute("class", "origin attraction");
  //                      td.appendChild(document.createTextNode("Main Attractions"));
  //                      $(".attraction").hide();
  //                      
  //                  }
  //                  
  //                  if (j==(beach_count+attraction_count)) {
  //                      var tr = addRow(table);
  //                      var td = addElement(tr);
  //                      td.setAttribute("class", "origin shopping");
  //                      td.appendChild(document.createTextNode("Important Services"));
  //                      $(".shopping").hide();
  //                  }
  //                  
  //                  if (j==(beach_count+attraction_count+imp_services_count)) {
  //                       var tr = addRow(table);
  //                      var td = addElement(tr);
  //                      td.setAttribute("class", "origin services");
  //                      td.appendChild(document.createTextNode("Shopping"));
  //                      $(".services").hide();
  //                  }  
  //                  
  //                               
  //                  var td = addElement(tr, 'element-' + i + '-' + j);
  //                  td.onmouseover = getRouteFunction(i,j);
  //                  td.onclick = getRouteFunction(i,j);
  //                  
  //                  if (j>=0 && j<beach_count) {
  //                     td.setAttribute("class", "beach"); 
  //                  }
  //                  else if (j>=beach_count && j<=(beach_count+attraction_count-1)) {
  //                      td.setAttribute("class", "attraction");
  //                       $(".attraction").hide();
  //                  }
  //                  else if (j>=(beach_count+attraction_count-1) && j<=(beach_count+attraction_count+imp_services_count-1)) {
  //                      td.setAttribute("class", "shopping");
  //                       $(".shopping").hide();
  //                  }
  //                  else if (j>=(beach_count+attraction_count+imp_services_count-1) && j<=total_record) {
  //                      td.setAttribute("class", "services");
  //                      $(".services").hide();
  //                  }
  //                  // if (j==6) {
  //                  //    td.setAttribute("class", "shopping");
  //                  //    $(".shopping").hide();
  //                  //}
  //                 
  //      }
  //  }
  //}

  function populateTable(rows) {
    var cnt = 0;
    for (var i = 0; i < rows.length; i++) {
      for (var j = 0; j < rows[i].elements.length; j++) {
        if (rows[i].elements[j].distance == '' || typeof rows[i].elements[j].distance == "undefined" || typeof rows[i].elements[j].duration == "undefined") {
         var distance = 'Invalied Latitude And Longitude'
        }
        else{
          var distance = rows[i].elements[j].distance.text;
          var duration = rows[i].elements[j].duration.text;
        }
        
        alert(distance);
        //var td = document.getElementById('element-' + i + '-' + j);
        //td.innerHTML = distance + " / " + duration;
        //var input_box = "<input type='text' name='distance[]' value='"+distance+"' readonly >";
        //td.innerHTML = input_box;
      }
    }
  }
  
  
  
  //
  //function getRouteFunction(i, j) {
  //  
  //  return function() {
  //    routeQuery = {
  //      origin: origins[i],
  //      destination: destinations[j],
  //      travelMode: query.travelMode,
  //      unitSystem: query.unitSystem,
  //    };
  //    
  //    if (highlightedCell) {
  //      highlightedCell.style.backgroundColor="#ffffff";
  //      highlightedCell.style.color="#000000";
  //      highlightedCell_new.style.backgroundColor="#ffffff";
  //      highlightedCell_new.style.color="#045a9d";
  //    }
  //    highlightedCell = document.getElementById('element-' + i + '-' + j);
  //    highlightedCell.style.backgroundColor="#6492F4";
  //    highlightedCell.style.color="#ffffff";
  //    
  //    highlightedCell_new = document.getElementById('element-placeName-' + i + '-' + j);
  //    highlightedCell_new.style.backgroundColor="#6492F4";
  //     highlightedCell_new.style.color="#ffffff";
  //    
  //    marker.setMap(null);
  //
  //    showRoute();
  //  }
  //}
  //
  //function showRoute() {
  //  dirService.route(routeQuery, function(result, status) {
  //    if (status == google.maps.DirectionsStatus.OK) {
  //      dirRenderer.setDirections(result);
  //      bounds = new google.maps.LatLngBounds();
  //      bounds.extend(result.routes[0].overview_path[0]);
  //      var k = result.routes[0].overview_path.length;
  //      bounds.extend(result.routes[0].overview_path[k-1]);
  //      panning = true;
  //      map.panTo(bounds.getCenter());        
  //    }
  //  });
  //}
  //
  //function updateMode() {
  //  switch (document.getElementById("mode").value) {
  //    case "driving":
  //      query.travelMode = google.maps.TravelMode.DRIVING;
  //      break;
  //    case "walking":
  //      query.travelMode = google.maps.TravelMode.WALKING;
  //      break;
  //  }
  //  updateMatrix();
  //  if (routeQuery) {
  //    routeQuery.travelMode = query.travelMode;
  //    showRoute();
  //  }
  //}
  //
  //function updateUnits() {
  //  switch (document.getElementById("units").value) {
  //    case "km":
  //      query.unitSystem = google.maps.UnitSystem.METRIC;
  //      break;
  //    case "mi":
  //      query.unitSystem = google.maps.UnitSystem.IMPERIAL;
  //      break;
  //  }
  //  updateMatrix();
  //}
  //
  //function addRow(table) {
  //  var tr = document.createElement('div');
  //  tr.setAttribute('class', "googleTab");
  //  
  //  table.appendChild(tr);
  //  return tr;
  //}
  //
  //function addElement(tr, id) {
  //  var td = document.createElement('div');
  //  if (id) {
  //    td.setAttribute('id', id);
  //    //td.setAttribute('class', "googleDistance");
  //    $( "#"+id ).addClass( "googleDistance" );
  //  }
  //  tr.appendChild(td);
  //  return td;
  //}
</script>

<!------------------------------------------------------------------------------------------------------------------->




<div id="map" class="metrixMap" style=" height: 150px; width: 600px;"></div>
     
<div class="MapHouseLeft" > 	  
       <div id="container">
      <div class="mapTab">
	  <!--<a href="javascript:void(0)" id="beach" class="show_map active" onclick="show_map(0,'beach');">Popular Beaches</a>
	  <a href="javascript:void(0)" id="attraction" class="show_map " onclick="show_map(2,'attraction');" >Main Attractions</a>
	  <a href="javascript:void(0)" id="services" class="show_map " onclick="show_map(4,'services');" >Shopping</a>
	  <a href="javascript:void(0)" id="shopping" class="show_map " onclick="show_map(3,'shopping');" >Important Services </a>-->
      </div>
      <div id="matrix">
	  <!--<div class="options">
	      <select id="mode" onChange="updateMode()">
		  <option value="driving" selected="selected">Driving</option>
		  <option value="walking" >Walking</option>
	      </select>
	      <select id="units" onChange="updateUnits()">
		  <option value="km" selected="selected">Kilometers</option>
		  <option value="mi" >Miles</option>
	      </select>-->
	  </div>
      </div>
    </div>
  <div><input type="button" value="Update" name="save" id="save"></div>
</div>