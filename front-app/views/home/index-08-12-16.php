<section class="background WelcomePan section" id="section2">
   <div class="content-wrapper">
      <div class="MainCon">
         <h2>WELCOME TO THE <strong>MOFO</strong> EXPERIENCE</h2>
         <ul class="clearfix">
            <li>
               <span class="icon"></span>
               <h4>No <b>Booking</b> Fees</h4>
               <p>It's simple really! You want the best price so we never charge a fee on any of our bookings</p>
            </li>
            <li>
               <span class="icon"></span>
               <h4>We <b>Love</b>   Hostels</h4>
               <p>We Love Hostels and that's why no one knows hostels like we do</p>
            </li>
            <li>
               <span class="icon"></span>
               <h4><b>#1 </b>in Australia</h4>
               <p>When you do something for this long you just get good at it!</p>
            </li>
            <li>
               <span class="icon"></span>
               <h4><b>Prize </b>Central</h4>
               <p>We love to give back so weekly prizes is how we roll</p>
            </li>
         </ul>
      </div>
   </div>
</section>
<section class="background MapPan section" id="section3">
   <div class="content-wrapper">
      <div class="MainCon clearfix">
         <div class="mapBox alignright">
            <div class="containerspecial">
               <?php
               $default_checkin   = date('d-m-Y');
               $default_checkout  = date('d-m-Y', strtotime(' +4 day'));
               ?>
               <div class="span9special mapper">
                  <div class="map-unit">
                     <div class="map-points">
                        <a href="<?php echo FRONTEND_URL;?>tasmania/launceston/" class="map-point" id="launceston" title="launceston">
                           <i class="fa fa-map-marker"></i>Launceston
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>tasmania/hobart/" class="map-point" id="hobart" title="hobart">
                           <i class="fa fa-map-marker"></i> Hobart
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/" class="map-point" id="northernterritory" title="northernterritory">
                           <i class="fa fa-map-marker"></i> Northern Territory
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/kakadu/" class="map-point" id="kakadunp" title="kakadunp">
                           <i class="fa fa-map-marker"></i> Kakadu NP
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/darwin/" class="map-point" id="darwin" title="darwin">
                           <i class="fa fa-map-marker"></i> Darwin
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/kata-tjuta/" class="map-point" id="katatjutatheolgas" title="katatjutatheolgas">
                           <i class="fa fa-map-marker"></i> Kata Tjuta (The Olgas)
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/kings-canyon/" class="map-point" id="kingscanyon" title="kingscanyon">
                           <i class="fa fa-map-marker"></i> Kings Canyon
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/uluru/" class="map-point" id="uluru" title="uluru">
                           <i class="fa fa-map-marker"></i> Uluru
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>northern-territory/alice-springs/" class="map-point" id="alicesprings" title="alicesprings">
                           <i class="fa fa-map-marker"></i> Alice Springs
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/" class="map-point" id="queensland" title="queensland">
                           <i class="fa fa-map-marker"></i> Queensland
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/cape-york/" class="map-point" id="capeyork" title="capeyork">
                           <i class="fa fa-map-marker"></i> Cape York
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/port-douglas/" class="map-point" id="portdouglas" title="portdouglas">
                           <i class="fa fa-map-marker"></i> Port Douglas
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/cape-tribulation/" class="map-point" id="capetribulation" title="capetribulation">
                           <i class="fa fa-map-marker"></i> Cape Tribulation
                        </a>
                        <a href="#" class="map-point" id="cairns" title="cairns"><i class="fa fa-map-marker"></i> Cairns</a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/great-barrier-reef/" class="map-point" id="greatbarrierreef" title="greatbarrierreef">
                           <i class="fa fa-map-marker"></i> Great Barrier Reef
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/mission-beach/" class="map-point" id="missionbeach" title="missionbeach">
                           <i class="fa fa-map-marker"></i> Mission Beach
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/tully/" class="map-point" id="tully" title="tully">
                           <i class="fa fa-map-marker"></i> Tully
                        </a>
                        <!--<a href="<?php echo FRONTEND_URL;?>queensland/tully/" class="map-point" id="emupark" title="emupark">
                           <i class="fa fa-map-marker"></i> Emu Park</a>-->
                        <a href="<?php echo FRONTEND_URL;?>queensland/townsville/" class="map-point" id="townsville" title="townsville">
                           <i class="fa fa-map-marker"></i> Townsville
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/magnetic-island/" class="map-point" id="magneticisland" title="magneticisland">
                           <i class="fa fa-map-marker"></i> Magnetic Island
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/ayr/" class="map-point" id="ayr" title="ayr">
                           <i class="fa fa-map-marker"></i> Ayr
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/airlie-beach/" class="map-point" id="airliebeach" title="airliebeach">
                           <i class="fa fa-map-marker"></i> Airlie Beach
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/whitsundays/" class="map-point" id="whitsundays" title="whitsundays">
                           <i class="fa fa-map-marker"></i> Whitsundays
                        </a>
                        <!--<a href="<?php echo FRONTEND_URL;?>queensland/whitsundays/" class="map-point" id="townof1770" title="townof1770">
                           <i class="fa fa-map-marker"></i> Town of 1770</a>-->
                        <a href="<?php echo FRONTEND_URL;?>queensland/rockhampton/" class="map-point" id="rockhampton" title="rockhampton">
                           <i class="fa fa-map-marker"></i> Rockhampton
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/bundaberg/" class="map-point" id="bundaberg" title="bundaberg">
                           <i class="fa fa-map-marker"></i> Bundaberg
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/hervey-bay/" class="map-point" id="herveybay" title="herveybay">
                           <i class="fa fa-map-marker"></i> Hervey Bay
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/rainbow-beach/" class="map-point" id="rainbowbeach" title="rainbowbeach">
                           <i class="fa fa-map-marker"></i> Rainbow Beach
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/fraser-island/" class="map-point" id="fraserisland" title="fraserisland">
                           <i class="fa fa-map-marker"></i> Fraser Island
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/noosa/" class="map-point" id="noosa" title="noosa">
                           <i class="fa fa-map-marker"></i> Noosa
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/brisbane/" class="map-point" id="brisbane" title="brisbane">
                           <i class="fa fa-map-marker"></i> Brisbane
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>queensland/gold-coast/" class="map-point" id="goldcoast" title="goldcoast">
                           <i class="fa fa-map-marker"></i> Gold Coast
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/" class="map-point" id="westernaustralia" title="westernaustralia">
                           <i class="fa fa-map-marker"></i> Western Australia
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/broome/" class="map-point" id="broome" title="broome">
                           <i class="fa fa-map-marker"></i> Broome
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/exmouth/" class="map-point" id="exmouth" title="exmouth">
                           <i class="fa fa-map-marker"></i> Exmouth
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/monkey-mia/" class="map-point" id="monkeymia" title="monkeymia">
                           <i class="fa fa-map-marker"></i> Monkey Mia
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/perth/" class="map-point" id="perth" title="perth">
                           <i class="fa fa-map-marker"></i> Perth
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>western-australia/rottnest-island/" class="map-point" id="rottnestisland" title="rottnestisland">
                           <i class="fa fa-map-marker"></i> Rottnest Island
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>victoria/" class="map-point" id="victoria" title="victoria">
                           <i class="fa fa-map-marker"></i> Victoria
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>victoria/phillip-island/" class="map-point" id="phillipisland" title="phillipisland">
                           <i class="fa fa-map-marker"></i> Phillip Island
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>victoria/melbourne/" class="map-point" id="melbourne" title="melbourne">
                           <i class="fa fa-map-marker"></i> Melbourne
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>victoria/great-ocean-road/" class="map-point" id="greatoceanroad" title="greatoceanroad">
                           <i class="fa fa-map-marker"></i> Great Ocean Road
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>new-south-wales/" class="map-point" id="newsouthwales" title="newsouthwales">
                           <i class="fa fa-map-marker"></i> New South Wales
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>new-south-wales/byron-bay/" class="map-point" id="byronbay" title="byronbay">
                           <i class="fa fa-map-marker"></i> Byron Bay
                        </a>
                        <!--<a href="<?php echo FRONTEND_URL;?>new-south-wales/byron-bay/" class="map-point" id="spotx" title="spotx">
                           <i class="fa fa-map-marker"></i> Spot X</a>-->
                        <a href="<?php echo FRONTEND_URL;?>new-south-wales/coffs-harbour/" class="map-point" id="coffsharbour" title="coffsharbour">
                           <i class="fa fa-map-marker"></i> Coffs Harbour
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>new-south-wales/sydney/" class="map-point" id="sydney" title="sydney">
                           <i class="fa fa-map-marker"></i> Sydney
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>new-south-wales/blue-mountains/" class="map-point" id="bluemountains" title="bluemountains">
                           <i class="fa fa-map-marker"></i> Blue Mountains
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>south-australia/" class="map-point" id="southaustralia" title="southaustralia">
                           <i class="fa fa-map-marker"></i> South Australia
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>south-australia/adelaide/" class="map-point" id="adelaide" title="adelaide">
                           <i class="fa fa-map-marker"></i> Adelaide
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>south-australia/port-lincoln/" class="map-point" id="portlincoln" title="portlincoln">
                           <i class="fa fa-map-marker"></i> Port Lincoln
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>south-australia/coober-pedy/" class="map-point" id="cooberpedy" title="cooberpedy">
                           <i class="fa fa-map-marker"></i> Coober Pedy
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>south-australia/kangaroo-island/" class="map-point" id="kangarooisland" title="kangarooisland">
                           <i class="fa fa-map-marker"></i> Kangaroo Island
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>australian-capital-territory/" class="map-point" id="australiancaptialterritory" title="australiancaptialterritory">
                           <i class="fa fa-map-marker"></i> Australian Captial Territory
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>australian-capital-territory/canberra/" class="map-point" id="canberra" title="canberra">
                           <i class="fa fa-map-marker"></i> Canberra
                        </a>
                        <a href="<?php echo FRONTEND_URL;?>australian-capital-territory/tasmania/" class="map-point" id="tasmania" title="tasmania">
                           <i class="fa fa-map-marker"></i> Tasmania
                        </a>
                     </div>
                     <div class="map-content"><img class="map" src="<?php echo FRONT_IMAGE_PATH;?>map.jpg" /></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="MapLt alignleft">
            <h3> AUSTRALIA'S A 
               <span>BIG PLACE! </span>
            </h3>
            <p>WE'VE <span>MARKED</span> ALL THE SPOTS WHERE YOU CAN SLEEP</p>
            <div class="HatMan"><img src="<?php echo FRONT_IMAGE_PATH;?>man.png" alt="man"></div>
         </div>
      </div>
   </div>
</section>
<section class="background AppPan section" id="section4">
   <div class="content-wrapper">
      <div class="MainCon clearfix">
         <div class="appPh alignright">
            <img src="<?php echo FRONT_IMAGE_PATH;?>ph-app.png" alt="img">
         </div>
         <div class="appTxt alignleft">
            <h3> Check out the <strong>HostelMofo</strong> app </h3>
            <span>Book from anywhere and win awesome weekly prizes</span> 
            <div class="appBtn">
               <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>app-str.png" alt="img"></a>
               <a href="#"><img src="<?php echo FRONT_IMAGE_PATH;?>ggl-ply.png" alt="img"></a>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="background mofoHvn section" id="section5">
   <div class="content-wrapper">
      <div class="MainCon">
         <h3>Welcome to mofo heaven!</h3>
         <h4>SEE WHERE OTHER MOFOS ARE TRAVELLING AROUND AUSTRALIA</h4>
         <div id="owl-carousel1">
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img1.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Perth</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img2.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Brisbane</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img3.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Melbourne</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img1.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Perth</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img2.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Brisbane</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
            <div class="item">
               <div class="imgDiv">
                  <img src="<?php echo FRONT_IMAGE_PATH;?>img3.jpg" alt="img">
               </div>
               <div class="HvnTxt">
                  <h5>Melbourne</h5>
                  <h6>102 Hostels</h6>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="background TwoSldr section" id="section6">
   <div class="content-wrapper clearfix">
      <div class="SlideImg alignleft">
         <div class="contentAppend">
            <img src="<?php echo FRONT_IMAGE_PATH;?>slide1.jpg">
            <div class='cption'>
               <h4> WANNA LIVE ON THE WILD SIDE? </h4>
               <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
            </div>
         </div>
      </div>
      <div class="TxtBlck alignright">
         <div class="newSlider">
            <div class="item">
               <h6><span>Adventure </span> </h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($adventure_location) && count($adventure_location) > 0){
                     foreach($adventure_location as $val){
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        $image_path = isFileExist(CDN_CITY_IMG.stripslashes($val['city_name']));
                        ?>
                        <li data-title="<img src='<?php echo $image_path;?>'><div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="item">
               <h6><span>City</span>  </h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($city_location) && count($city_location) > 0) {
                     foreach($city_location as $val) {
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        ?>
                        <li data-title="<img src='<?php echo FRONT_IMAGE_PATH;?>slide1.jpg'>">
                           <!--<div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="item">
               <h6><span>Beach</span></h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($beach_location) && count($beach_location) > 0){
                     foreach($beach_location as $val){
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        ?>
                        <li data-title="<img src='<?php echo FRONT_IMAGE_PATH;?>slide1.jpg'>">
                           <!--<div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="item">
               <h6><span>Most Reviewed</span></h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($most_review_location) && count($most_review_location) > 0){
                     foreach($most_review_location as $val){
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        ?>
                        <li data-title="<img src='<?php echo FRONT_IMAGE_PATH;?>slide1.jpg'>">
                           <!--<div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="item">
               <h6><span>Top Rated</span></h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($top_rated_location) && count($top_rated_location) > 0){
                     foreach($top_rated_location as $val){
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        ?>
                        <li data-title="<img src='<?php echo FRONT_IMAGE_PATH;?>slide1.jpg'>">
                           <!--<div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="item">
               <h6><span>Popular</span></h6>
               <ul class="clearfix">
                  <?php
                  if(is_array($popular_location) && count($popular_location) > 0){
                     foreach($popular_location as $val){
                        $url = FRONTEND_URL.$val['province_slug']."/".$val['city_seo_slug']."/";
                        ?>
                        <li data-title="<img src='<?php echo FRONT_IMAGE_PATH;?>slide1.jpg'>">
                           <!--<div class='cption'>
                              <h4> WANNA LIVE ON THE WILD SIDE? </h4>
                              <h5>WE'VE PICKED SOME COOL PLACES FOR YOU TO CHECK OUT </h5>
                           </div>-->
                           <a href="<?php echo $url;?>" style="color:white;"><?php echo $val['city_name'];?></a>
                        </li>
                        <?php
                     }
                  }
                  ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="background MofoVibe section" id="section7">
   <div class="content-wrapper">
      <div class="MainCon">
         <h3> These places ooze mofo vibe</h3>
         <div id="owl-carousel2">
            <div class="item">
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
            </div>
            <div class="item">
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
            </div>
            <div class="item">
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
               <div class="artcBox clearfix">
                  <div class="imgLt alignleft">
                     <img src="<?php echo FRONT_IMAGE_PATH;?>img-slide.jpg" alt="img">
                  </div>
                  <div class="artclRt alignright">
                     <h5>Jolly Swagman Backpackers  </h5>
                     <p>Jolly Swagman Backpackers is a fun, clean, spacious hostel overlooking a plaza on a nice, quiet street only five minutes from the nightlife of King...</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="background counterPan section" id="section8">
   <div class="content-wrapper">
      <div class="MainCon">
         <h3>
            <span class="counter">52,147</span>
            members and counting
         </h3>
      </div>
   </div>
</section>
<section class="background Australia section" id="section9">
   <div class="content-wrapper">
      <div class="blue">
         <div class="MainCon">
            <span>Australia...</span> it's all we do!
         </div>
      </div>
   </div>
</section>
<section class="background Waiting section" id="section10">
   <div class="content-wrapper">
      <div class="MainCon">
         <h3>So what are you waiting for...</h3>
      </div>
   </div>
</section>
<section class="background kidPan section" id="section11">
   <div class="content-wrapper">
      <div class="MainCon clearfix">
         <div class="bleTxt"> Even these little guys <br> worked it out... </div>
      </div>
   </div>
</section>
<section class="background joinFrmPan section" id="section12">
   <div class="content-wrapper">
      <div class="MainCon clearfix">
         <div class="BleFrm alignleft">
            <h5> Yes! Join our tribe</h5>
            <p id="msg"></p>
            <input type="text" value="" id="nw_name" name="nw_name" placeholder="-- First Name --">
            <span class="error_msg" id="error_nw_name"></span>
            <input type="text" value="" name="nw_email" id="nw_email" placeholder="-- E-mail Address --">
            <span class="error_msg" id="error_nw_email"></span>
            <div class="sbMt"><input type="submit" name="Submit" value="Submit Now" class="inputBtn nw_submit">
               <span></span>
            </div>
         </div>
         <div class="BleFrmRT alignright">
            <ul>
               <li>Monthly newsletter full of fun and prizes</li>
               <li>Heaps of free accommodation giveaways</li>
               <li>Competitions and prizes</li>
               <li>Sorry did we mention more fun</li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section class="background advntrPan section" id="section13">
   <div class="content-wrapper">
      <div class="MainCon wp29">
         <h3>It's Your Adventure
            <span>We just love to Help</span>
         </h3>
      </div>
   </div>
</section>
