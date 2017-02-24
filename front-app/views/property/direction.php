 <style>
       #map {
        height: 500px;
        width: 100%;
       }
    </style>
<?php
$currencySymbol = $this->nsession->userdata('currencySymbol');
$currencyRate 	= $this->nsession->userdata('currencyRate');

$latitude = $details['master_details']['latitude'];
$longitude  = $details['master_details']['longitude']; 
?>

  <div class="main">
      <div class="MainCon">  
     <div class="mapPan clearfix">
                  <div class="alignleft proTab">
                     <div id="horizontalTab">
                        <ul class="cresp-tabs-list">
                           <li><a href="<?php echo $link;?>">Overview</a></li>
									<li><a href="<?php echo $link.'#prices';?>">Prices</a></li>
                           <li><a href="<?php echo $link.'#facility';?>">Facilities</a></li>
                           <li class="active"><a href="javascript:void(0)">Map</a></li>
									<li><a href="<?php echo $link.'#cancel_policy';?>">Cancellation Policy</a></li>
                           <li><a href="<?php echo $link.'#review';?>">Reviews</a></li>
                        </ul>
                        <div class="cresp-tabs-container">
                           <div>
                              <h5>Location</h5>
                                <div id="map"></div>
                           </div>
                           
                          
                        </div>
                     </div>
                      <h5>Property Directions</h5>
                      <p><?php echo $details['master_details']['direction'];?></p>
                  </div>
						<?php if(is_array($avg_review)){ ?>
                  <div class="alignright bookNw">
                     <div class="blueUp">
                        <div class="blueRate">
                          <?php echo (!empty($avg_review) && $avg_review['totalFeedback']) ? sprintf("%.1f", $avg_review['totalFeedback']) : 0; ?>
                        </div>
                        <div class="fav">
                           Fabulous
                           <a href="#"> <em>866</em>  Total Reviews</a>
                        </div>
                     </div>
                     <div class="blueBar">
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['v_f_m']) ? sprintf("%.1f", $avg_review['v_f_m'])*10 : 0 ;?>%">Value For Money</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['v_f_m']) ? sprintf("%.1f", $avg_review['v_f_m']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['security']) ? sprintf("%.1f", $avg_review['security'])*10 : 0 ;?>%">Security</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['security']) ? sprintf("%.1f", $avg_review['security']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['location']) ? sprintf("%.1f", $avg_review['location'])*10 : 0 ;?>%">Location</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['location']) ? sprintf("%.1f", $avg_review['location']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['staff']) ? sprintf("%.1f", $avg_review['staff'])*10 : 0 ;?>%">Staff</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['staff']) ? sprintf("%.1f", $avg_review['staff']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['atmosphere']) ? sprintf("%.1f", $avg_review['atmosphere'])*10 : 0 ;?>%">Atmosphere</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['atmosphere']) ? sprintf("%.1f", $avg_review['atmosphere']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width: <?php echo (!empty($avg_review) && $avg_review['cleanliness']) ? sprintf("%.1f", $avg_review['cleanliness'])*10 : 0 ;?>%">Cleanliness</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['cleanliness']) ? sprintf("%.1f", $avg_review['cleanliness']) : 0 ;?></span>
                        </div>
                        <div class="blueBarIn">
                           <span style="width:<?php echo (!empty($avg_review) && $avg_review['facilities']) ? sprintf("%.1f", $avg_review['facilities'])*10 : 0 ;?>%">Facilities</span>
                           <span><?php echo (!empty($avg_review) && $avg_review['facilities']) ? sprintf("%.1f", $avg_review['facilities']) : 0 ;?></span>
                        </div>
                        
                     </div>
                  </div>
						<?php } ?>
               </div>

    
 </div>
 </div>
 </div>
<script type="text/javascript">
      function initMap() {
        var point = {lat: <?php echo ($latitude!= '') ? $latitude: -25.363 ?>, lng: <?php echo ($longitude!= '') ? $longitude: 131.044 ?> };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: point
        });
        var marker = new google.maps.Marker({
          position: point,
          map: map
        });
      }
		//$("#mapClick").click(function(){
		//  initMap();
		//})
		
		
	
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5oEneZdCu6tI4-HE_5ZL2XZwMUuQmOgg&callback=initMap"></script>