<!--			
			<div class="main ">
      <div class="MainCon">
      <div class="formSrch clearfix">
         <div class="formBox">
            <label>LOCATION</label>
            <input value="" name="Name" placeholder="Brisbane, Australia" type="text">
         </div>
         <div class="formBox inputTwo">
            <label class="in">Check In</label>
            <input value="" name="Name" placeholder="13 Aug, 2016" type="text">
            <label class="out">Check Out</label>
            <input value="" name="Name" placeholder="16 Aug, 2016" type="text">
         </div>
         <div class="formBox">
            <label>No. Of Guests</label>
            <select>
               <option>12</option>
               <option>Choose1</option>
               <option>Choose2</option>
            </select>
         </div>
         <div class="formBox">
            <input name="send" value="Search Now" type="submit">
         </div>
      </div>
      
      <div class="proDisplay">
         <div class="proBtns clearfix">
            <div class="btnLt alignleft">
               <a class="blBtn" href="#">Filter</a>
               <a class="blBtn" href="#">Sort</a>
            </div>
            <div class="btnRt alignright">
               <em>Display :</em> 
               <a class="blBtn" href="#">List</a>
               <a class="blBtn active" href="#">Grid</a>
               <a class="blBtn" href="#">Map</a>
            </div>
         </div>
      </div>
      <div class="proList">
      
			      <aside class="leftSide ltCls">
					<div class="filterPanel">
						<div class="filterTop globalClr clearfix"> <span class="ltCls text1">Filter Result</span> </div>
						<div class="filterContent globalClr"> <span class="accroTitle"><i class="fa fa-tag ltIcon"></i>Price Range <i class="fa fa-plus rtIcon"></i></span>
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
							<span class="accroTitle"><i class="propertyIcon spriteImg ltIcon"></i>Property Type<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
															<li>
									<label>
										<input class="list_ptype" value="4" name="filterpropType[]" type="checkbox">
										Camping </label>
								</li>
																<li>
									<label>
										<input class="list_ptype" value="1" name="filterpropType[]" type="checkbox">
										Hostel </label>
								</li>
																<li>
									<label>
										<input class="list_ptype" value="3" name="filterpropType[]" type="checkbox">
										Hotel </label>
								</li>
																<li>
									<label>
										<input class="list_ptype" value="2" name="filterpropType[]" type="checkbox">
										Working Hostel </label>
								</li>
																</ul>
								<ul>
								</ul>
							</div>
							<span class="accroTitle"><i class="roomIcon spriteImg ltIcon"></i>Room Type<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
							<ul>
															<li><label><input class="list_roomtype" value="110" name="filterRoomtype[]" type="checkbox">10 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="72" name="filterRoomtype[]" type="checkbox">10 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="128" name="filterRoomtype[]" type="checkbox">12 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="109" name="filterRoomtype[]" type="checkbox">12 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="39" name="filterRoomtype[]" type="checkbox">16 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="89" name="filterRoomtype[]" type="checkbox">2 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="99" name="filterRoomtype[]" type="checkbox">2 Bed Tent </label></li>
																<li><label><input class="list_roomtype" value="70" name="filterRoomtype[]" type="checkbox">20 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="139" name="filterRoomtype[]" type="checkbox">24 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="65" name="filterRoomtype[]" type="checkbox">3 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="79" name="filterRoomtype[]" type="checkbox">3 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="80" name="filterRoomtype[]" type="checkbox">3 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="34" name="filterRoomtype[]" type="checkbox">3 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="150" name="filterRoomtype[]" type="checkbox">32 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="62" name="filterRoomtype[]" type="checkbox">4 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="38" name="filterRoomtype[]" type="checkbox">4 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="37" name="filterRoomtype[]" type="checkbox">4 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="13" name="filterRoomtype[]" type="checkbox">4 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="90" name="filterRoomtype[]" type="checkbox">4 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="64" name="filterRoomtype[]" type="checkbox">5 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="81" name="filterRoomtype[]" type="checkbox">5 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="131" name="filterRoomtype[]" type="checkbox">5 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="84" name="filterRoomtype[]" type="checkbox">5 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="63" name="filterRoomtype[]" type="checkbox">5 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="93" name="filterRoomtype[]" type="checkbox">6 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="36" name="filterRoomtype[]" type="checkbox">6 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="55" name="filterRoomtype[]" type="checkbox">6 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="14" name="filterRoomtype[]" type="checkbox">6 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="148" name="filterRoomtype[]" type="checkbox">6 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="95" name="filterRoomtype[]" type="checkbox">7 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="58" name="filterRoomtype[]" type="checkbox">8 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="59" name="filterRoomtype[]" type="checkbox">8 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="48" name="filterRoomtype[]" type="checkbox">8 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="130" name="filterRoomtype[]" type="checkbox">9 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="2" name="filterRoomtype[]" type="checkbox">AC </label></li>
																<li><label><input class="list_roomtype" value="88" name="filterRoomtype[]" type="checkbox">Basic 1 Bed Tent </label></li>
																<li><label><input class="list_roomtype" value="96" name="filterRoomtype[]" type="checkbox">Basic 10 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="164" name="filterRoomtype[]" type="checkbox">Basic 10 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="42" name="filterRoomtype[]" type="checkbox">Basic 10 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="119" name="filterRoomtype[]" type="checkbox">Basic 12 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="94" name="filterRoomtype[]" type="checkbox">Basic 12 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="155" name="filterRoomtype[]" type="checkbox">Basic 14 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="120" name="filterRoomtype[]" type="checkbox">Basic 16 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="122" name="filterRoomtype[]" type="checkbox">Basic 16 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="160" name="filterRoomtype[]" type="checkbox">Basic 18 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="147" name="filterRoomtype[]" type="checkbox">Basic 2 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="144" name="filterRoomtype[]" type="checkbox">Basic 20 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="126" name="filterRoomtype[]" type="checkbox">Basic 3 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="56" name="filterRoomtype[]" type="checkbox">Basic 3 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="40" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="22" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="114" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="27" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="104" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="141" name="filterRoomtype[]" type="checkbox">Basic 4 Bed Shared Tent </label></li>
																<li><label><input class="list_roomtype" value="142" name="filterRoomtype[]" type="checkbox">Basic 5 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="115" name="filterRoomtype[]" type="checkbox">Basic 5 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="91" name="filterRoomtype[]" type="checkbox">Basic 5 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="82" name="filterRoomtype[]" type="checkbox">Basic 6 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="92" name="filterRoomtype[]" type="checkbox">Basic 6 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="116" name="filterRoomtype[]" type="checkbox">Basic 6 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="28" name="filterRoomtype[]" type="checkbox">Basic 6 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="149" name="filterRoomtype[]" type="checkbox">Basic 6 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="105" name="filterRoomtype[]" type="checkbox">Basic 7 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="108" name="filterRoomtype[]" type="checkbox">Basic 8 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="107" name="filterRoomtype[]" type="checkbox">Basic 8 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="47" name="filterRoomtype[]" type="checkbox">Basic 8 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="143" name="filterRoomtype[]" type="checkbox">Basic 9 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="76" name="filterRoomtype[]" type="checkbox">Basic Double Bed Private </label></li>
																<li><label><input class="list_roomtype" value="50" name="filterRoomtype[]" type="checkbox">Basic Single Private </label></li>
																<li><label><input class="list_roomtype" value="51" name="filterRoomtype[]" type="checkbox">Basic Twin Private </label></li>
																<li><label><input class="list_roomtype" value="1" name="filterRoomtype[]" type="checkbox">Delux </label></li>
																<li><label><input class="list_roomtype" value="83" name="filterRoomtype[]" type="checkbox">Deluxe 10 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="43" name="filterRoomtype[]" type="checkbox">Deluxe 10 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="121" name="filterRoomtype[]" type="checkbox">Deluxe 10 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="66" name="filterRoomtype[]" type="checkbox">Deluxe 12 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="136" name="filterRoomtype[]" type="checkbox">Deluxe 2 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="138" name="filterRoomtype[]" type="checkbox">Deluxe 3 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="98" name="filterRoomtype[]" type="checkbox">Deluxe 3 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="26" name="filterRoomtype[]" type="checkbox">Deluxe 3 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="69" name="filterRoomtype[]" type="checkbox">Deluxe 4 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="71" name="filterRoomtype[]" type="checkbox">Deluxe 4 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="111" name="filterRoomtype[]" type="checkbox">Deluxe 4 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="112" name="filterRoomtype[]" type="checkbox">Deluxe 5 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="30" name="filterRoomtype[]" type="checkbox">Deluxe 6 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="129" name="filterRoomtype[]" type="checkbox">Deluxe 6 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="29" name="filterRoomtype[]" type="checkbox">Deluxe 6 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="152" name="filterRoomtype[]" type="checkbox">Deluxe 6 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="156" name="filterRoomtype[]" type="checkbox">Deluxe 7 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="100" name="filterRoomtype[]" type="checkbox">Deluxe 7 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="53" name="filterRoomtype[]" type="checkbox">Deluxe 8 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="54" name="filterRoomtype[]" type="checkbox">Deluxe 8 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="25" name="filterRoomtype[]" type="checkbox">Deluxe Double Bed Private </label></li>
																<li><label><input class="list_roomtype" value="106" name="filterRoomtype[]" type="checkbox">Deluxe Single Private </label></li>
																<li><label><input class="list_roomtype" value="78" name="filterRoomtype[]" type="checkbox">Deluxe Twin Private </label></li>
																<li><label><input class="list_roomtype" value="33" name="filterRoomtype[]" type="checkbox">Double Bed Private </label></li>
																<li><label><input class="list_roomtype" value="7" name="filterRoomtype[]" type="checkbox">Double Room </label></li>
																<li><label><input class="list_roomtype" value="4" name="filterRoomtype[]" type="checkbox">Ensuite Room </label></li>
																<li><label><input class="list_roomtype" value="9" name="filterRoomtype[]" type="checkbox">Family Room </label></li>
																<li><label><input class="list_roomtype" value="12" name="filterRoomtype[]" type="checkbox">Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="11" name="filterRoomtype[]" type="checkbox">Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="10" name="filterRoomtype[]" type="checkbox">Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="3" name="filterRoomtype[]" type="checkbox">Non-AC </label></li>
																<li><label><input class="list_roomtype" value="31" name="filterRoomtype[]" type="checkbox">Single Private </label></li>
																<li><label><input class="list_roomtype" value="5" name="filterRoomtype[]" type="checkbox">Single Room </label></li>
																<li><label><input class="list_roomtype" value="117" name="filterRoomtype[]" type="checkbox">Standard 1 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="45" name="filterRoomtype[]" type="checkbox">Standard 10 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="87" name="filterRoomtype[]" type="checkbox">Standard 10 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="46" name="filterRoomtype[]" type="checkbox">Standard 10 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="151" name="filterRoomtype[]" type="checkbox">Standard 12 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="125" name="filterRoomtype[]" type="checkbox">Standard 12 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="137" name="filterRoomtype[]" type="checkbox">Standard 14 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="123" name="filterRoomtype[]" type="checkbox">Standard 16 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="124" name="filterRoomtype[]" type="checkbox">Standard 16 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="132" name="filterRoomtype[]" type="checkbox">Standard 18 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="145" name="filterRoomtype[]" type="checkbox">Standard 2 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="157" name="filterRoomtype[]" type="checkbox">Standard 2 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="158" name="filterRoomtype[]" type="checkbox">Standard 2 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="163" name="filterRoomtype[]" type="checkbox">Standard 20 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="133" name="filterRoomtype[]" type="checkbox">Standard 20 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="35" name="filterRoomtype[]" type="checkbox">Standard 3 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="134" name="filterRoomtype[]" type="checkbox">Standard 3 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="135" name="filterRoomtype[]" type="checkbox">Standard 3 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="57" name="filterRoomtype[]" type="checkbox">Standard 3 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="146" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="154" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="49" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="21" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="23" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="20" name="filterRoomtype[]" type="checkbox">Standard 4 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="159" name="filterRoomtype[]" type="checkbox">Standard 5 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="86" name="filterRoomtype[]" type="checkbox">Standard 5 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="85" name="filterRoomtype[]" type="checkbox">Standard 5 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="61" name="filterRoomtype[]" type="checkbox">Standard 5 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="102" name="filterRoomtype[]" type="checkbox">Standard 6 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="17" name="filterRoomtype[]" type="checkbox">Standard 6 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="15" name="filterRoomtype[]" type="checkbox">Standard 6 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="16" name="filterRoomtype[]" type="checkbox">Standard 6 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="140" name="filterRoomtype[]" type="checkbox">Standard 7 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="77" name="filterRoomtype[]" type="checkbox">Standard 7 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="103" name="filterRoomtype[]" type="checkbox">Standard 8 Bed Family Room </label></li>
																<li><label><input class="list_roomtype" value="41" name="filterRoomtype[]" type="checkbox">Standard 8 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="101" name="filterRoomtype[]" type="checkbox">Standard 8 Bed Male Dorm </label></li>
																<li><label><input class="list_roomtype" value="18" name="filterRoomtype[]" type="checkbox">Standard 8 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="97" name="filterRoomtype[]" type="checkbox">Standard 9 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="19" name="filterRoomtype[]" type="checkbox">Standard Double Bed Private </label></li>
																<li><label><input class="list_roomtype" value="60" name="filterRoomtype[]" type="checkbox">Standard Single Private </label></li>
																<li><label><input class="list_roomtype" value="24" name="filterRoomtype[]" type="checkbox">Standard Twin Private </label></li>
																<li><label><input class="list_roomtype" value="74" name="filterRoomtype[]" type="checkbox">Superior 10 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="75" name="filterRoomtype[]" type="checkbox">Superior 10 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="68" name="filterRoomtype[]" type="checkbox">Superior 14 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="113" name="filterRoomtype[]" type="checkbox">Superior 2 Bed Apartment </label></li>
																<li><label><input class="list_roomtype" value="44" name="filterRoomtype[]" type="checkbox">Superior 4 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="127" name="filterRoomtype[]" type="checkbox">Superior 5 Bed Private </label></li>
																<li><label><input class="list_roomtype" value="161" name="filterRoomtype[]" type="checkbox">Superior 6 Bed Female Dorm </label></li>
																<li><label><input class="list_roomtype" value="153" name="filterRoomtype[]" type="checkbox">Superior 6 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="162" name="filterRoomtype[]" type="checkbox">Superior 8 Bed Mixed Dorm </label></li>
																<li><label><input class="list_roomtype" value="52" name="filterRoomtype[]" type="checkbox">Superior Double Bed Private </label></li>
																<li><label><input class="list_roomtype" value="118" name="filterRoomtype[]" type="checkbox">Superior Single Private </label></li>
																<li><label><input class="list_roomtype" value="67" name="filterRoomtype[]" type="checkbox">Superior Twin Private </label></li>
																<li><label><input class="list_roomtype" value="8" name="filterRoomtype[]" type="checkbox">Triple Room </label></li>
																<li><label><input class="list_roomtype" value="32" name="filterRoomtype[]" type="checkbox">Twin Private </label></li>
																<li><label><input class="list_roomtype" value="6" name="filterRoomtype[]" type="checkbox">Twin Room </label></li>
															</ul>
							</div>
							<span class="accroTitle"><i class="fa fa-map-marker ltIcon"></i>Location<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
																	<li><label><input class="list_citytype" data-province="1" value="1770-qld" name="filterLocation[]" type="checkbox">1770 </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="adelaide-sa" name="filterLocation[]" type="checkbox">Adelaide </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="adelaide-hills-sa" name="filterLocation[]" type="checkbox">Adelaide Hills </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="agnes-waters-qld" name="filterLocation[]" type="checkbox">Agnes Waters </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="airlie-beach-qld" name="filterLocation[]" type="checkbox">Airlie Beach </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="albany-wa" name="filterLocation[]" type="checkbox">Albany </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="albury-nsw" name="filterLocation[]" type="checkbox">Albury </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="alexandra-headland-qld" name="filterLocation[]" type="checkbox">Alexandra Headland </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="alice-springs-nt" name="filterLocation[]" type="checkbox">Alice Springs </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="alpine-national-park-vic" name="filterLocation[]" type="checkbox">Alpine National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="apollo-bay-vic" name="filterLocation[]" type="checkbox">Apollo Bay </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="armadale-wa" name="filterLocation[]" type="checkbox">Armadale </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="armidale-nsw" name="filterLocation[]" type="checkbox">Armidale </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="arnhem-land-nt" name="filterLocation[]" type="checkbox">Arnhem Land </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="atherton-tablelands-qld" name="filterLocation[]" type="checkbox">Atherton Tablelands </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="augusta-wa" name="filterLocation[]" type="checkbox">Augusta </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="avon-valley-wa" name="filterLocation[]" type="checkbox">Avon Valley </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="ayers-rock-nt" name="filterLocation[]" type="checkbox">Ayers Rock </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="ayr-qld" name="filterLocation[]" type="checkbox">Ayr </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="ballarat-vic" name="filterLocation[]" type="checkbox">Ballarat </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="ballina-nsw" name="filterLocation[]" type="checkbox">Ballina </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="bankstown-nsw" name="filterLocation[]" type="checkbox">Bankstown </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="barossa-valley-sa" name="filterLocation[]" type="checkbox">Barossa Valley </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="bathurst-nsw" name="filterLocation[]" type="checkbox">Bathurst </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="battery-point-tas" name="filterLocation[]" type="checkbox">Battery Point </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="baw-baw-national-park-vic" name="filterLocation[]" type="checkbox">Baw Baw National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="bayswater-vic" name="filterLocation[]" type="checkbox">Bayswater </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="beechworth-vic" name="filterLocation[]" type="checkbox">Beechworth </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="bellarine-peninsula-vic" name="filterLocation[]" type="checkbox">Bellarine Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="bells-beach-vic" name="filterLocation[]" type="checkbox">Bells Beach </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="bendigo-vic" name="filterLocation[]" type="checkbox">Bendigo </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="berri-sa" name="filterLocation[]" type="checkbox">Berri </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="bicheno-tas" name="filterLocation[]" type="checkbox">Bicheno </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="big-desert-wilderness-park-vic" name="filterLocation[]" type="checkbox">Big Desert Wilderness Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="biggera-waters-qld" name="filterLocation[]" type="checkbox">Biggera Waters </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="birdsville-qld" name="filterLocation[]" type="checkbox">Birdsville </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="blackall-ranges-qld" name="filterLocation[]" type="checkbox">Blackall Ranges </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="blacktown-nsw" name="filterLocation[]" type="checkbox">Blacktown </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="blue-mountains-nsw" name="filterLocation[]" type="checkbox">Blue Mountains </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="bondi-beach-nsw" name="filterLocation[]" type="checkbox">Bondi Beach </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="botany-bay-nsw" name="filterLocation[]" type="checkbox">Botany Bay </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="bourke-nsw" name="filterLocation[]" type="checkbox">Bourke </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="bowen-qld" name="filterLocation[]" type="checkbox">Bowen </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="bright-sa" name="filterLocation[]" type="checkbox">Bright </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="brighton-sa" name="filterLocation[]" type="checkbox">Brighton </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="brisbane-qld" name="filterLocation[]" type="checkbox">Brisbane </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="broadbeach-qld" name="filterLocation[]" type="checkbox">Broadbeach </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="broadwater-qld" name="filterLocation[]" type="checkbox">Broadwater </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="broken-hill-nsw" name="filterLocation[]" type="checkbox">Broken Hill </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="broome-wa" name="filterLocation[]" type="checkbox">Broome </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="bruny-island-tas" name="filterLocation[]" type="checkbox">Bruny Island </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="buchan-vic" name="filterLocation[]" type="checkbox">Buchan </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="bunbury-wa" name="filterLocation[]" type="checkbox">Bunbury </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="bundaberg-qld" name="filterLocation[]" type="checkbox">Bundaberg </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="bungle-bungle-national-park-wa" name="filterLocation[]" type="checkbox">Bungle Bungle National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="bunya-mountains-qld" name="filterLocation[]" type="checkbox">Bunya Mountains </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="burleigh-heads-qld" name="filterLocation[]" type="checkbox">Burleigh Heads </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="burnie-tas" name="filterLocation[]" type="checkbox">Burnie </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="burra-sa" name="filterLocation[]" type="checkbox">Burra </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="busselton-wa" name="filterLocation[]" type="checkbox">Busselton </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="byron-bay-nsw" name="filterLocation[]" type="checkbox">Byron Bay </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="cable-beach-wa" name="filterLocation[]" type="checkbox">Cable Beach </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="caboolture-qld" name="filterLocation[]" type="checkbox">Caboolture </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cairns-qld" name="filterLocation[]" type="checkbox">Cairns </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="caloundra-qld" name="filterLocation[]" type="checkbox">Caloundra </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="campbelltown-nsw" name="filterLocation[]" type="checkbox">Campbelltown </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="canada-bay-nsw" name="filterLocation[]" type="checkbox">Canada Bay </label></li>
																		<li><label><input class="list_citytype" data-province="8" value="canberra-act" name="filterLocation[]" type="checkbox">Canberra </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="canterbury-nsw" name="filterLocation[]" type="checkbox">Canterbury </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cape-hillsborough-np-qld" name="filterLocation[]" type="checkbox">Cape Hillsborough NP </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cape-tribulation-qld" name="filterLocation[]" type="checkbox">Cape Tribulation </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cape-york-qld" name="filterLocation[]" type="checkbox">Cape York </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cape-york-peninsula-qld" name="filterLocation[]" type="checkbox">Cape York Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="capricorn-coast-qld" name="filterLocation[]" type="checkbox">Capricorn Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="capricorn-coast-hinterland-qld" name="filterLocation[]" type="checkbox">Capricorn Coast Hinterland </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="carnarvon-wa" name="filterLocation[]" type="checkbox">Carnarvon </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="castlemaine-vic" name="filterLocation[]" type="checkbox">Castlemaine </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="ceduna-sa" name="filterLocation[]" type="checkbox">Ceduna </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="central-west-wa" name="filterLocation[]" type="checkbox">Central West </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="cessnock-nsw" name="filterLocation[]" type="checkbox">Cessnock </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="charters-towers-qld" name="filterLocation[]" type="checkbox">Charters Towers </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="childers-qld" name="filterLocation[]" type="checkbox">Childers </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="christmas-island-wa" name="filterLocation[]" type="checkbox">Christmas Island </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="clare-valley-sa" name="filterLocation[]" type="checkbox">Clare Valley </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="cobram-vic" name="filterLocation[]" type="checkbox">Cobram </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="cocos-islands-wa" name="filterLocation[]" type="checkbox">Cocos Islands </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="coffs-harbour-nsw" name="filterLocation[]" type="checkbox">Coffs Harbour </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="conway-np-qld" name="filterLocation[]" type="checkbox">Conway NP </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="coober-pedy-sa" name="filterLocation[]" type="checkbox">Coober Pedy </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cooktown-qld" name="filterLocation[]" type="checkbox">Cooktown </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="coolangatta-qld" name="filterLocation[]" type="checkbox">Coolangatta </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="coolgardie-wa" name="filterLocation[]" type="checkbox">Coolgardie </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="cooloola-national-park-qld" name="filterLocation[]" type="checkbox">Cooloola National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="coolum-qld" name="filterLocation[]" type="checkbox">Coolum </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="coonawarra-sa" name="filterLocation[]" type="checkbox">Coonawarra </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="coorong-national-park-sa" name="filterLocation[]" type="checkbox">Coorong National Park </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="coral-bay-wa" name="filterLocation[]" type="checkbox">Coral Bay </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="coral-coast-wa" name="filterLocation[]" type="checkbox">Coral Coast </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="cradle-mountain-national-park-tas" name="filterLocation[]" type="checkbox">Cradle Mountain National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="croajingolong-national-park-vic" name="filterLocation[]" type="checkbox">Croajingolong National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="daintree-qld" name="filterLocation[]" type="checkbox">Daintree </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="dampier-peninsula-wa" name="filterLocation[]" type="checkbox">Dampier Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="dandenongs-vic" name="filterLocation[]" type="checkbox">Dandenongs </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="darling-downs-qld" name="filterLocation[]" type="checkbox">Darling Downs </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="darwin-nt" name="filterLocation[]" type="checkbox">Darwin </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="daylesford-vic" name="filterLocation[]" type="checkbox">Daylesford </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="denham-wa" name="filterLocation[]" type="checkbox">Denham </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="derby-wa" name="filterLocation[]" type="checkbox">Derby </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="devonian-reef-national-parks-wa" name="filterLocation[]" type="checkbox">Devonian Reef National Parks </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="devonport-tas" name="filterLocation[]" type="checkbox">Devonport </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="dubbo-nsw" name="filterLocation[]" type="checkbox">Dubbo </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="east-coast-tas" name="filterLocation[]" type="checkbox">East Coast </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="eastern-macdonnell-ranges-nt" name="filterLocation[]" type="checkbox">Eastern MacDonnell Ranges </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="echuca-vic" name="filterLocation[]" type="checkbox">Echuca </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="emerald-qld" name="filterLocation[]" type="checkbox">Emerald </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="esperance-wa" name="filterLocation[]" type="checkbox">Esperance </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="eumundi-qld" name="filterLocation[]" type="checkbox">Eumundi </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="eungella-national-park-qld" name="filterLocation[]" type="checkbox">Eungella National Park </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="exmouth-wa" name="filterLocation[]" type="checkbox">Exmouth </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="eyre-peninsula-sa" name="filterLocation[]" type="checkbox">Eyre Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="fairfield-nsw" name="filterLocation[]" type="checkbox">Fairfield </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="falls-creek-vic" name="filterLocation[]" type="checkbox">Falls Creek </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="far-north-queensland-qld" name="filterLocation[]" type="checkbox">Far North Queensland </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="far-south-east-sa" name="filterLocation[]" type="checkbox">Far South East </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="far-south-east-vic" name="filterLocation[]" type="checkbox">Far South East </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="finch-hatton-gorge-qld" name="filterLocation[]" type="checkbox">Finch Hatton Gorge </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="fitzroy-vic" name="filterLocation[]" type="checkbox">Fitzroy </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="fitzroy-crossing-wa" name="filterLocation[]" type="checkbox">Fitzroy Crossing </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="fitzroy-island-qld" name="filterLocation[]" type="checkbox">Fitzroy Island </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="fleurieu-peninsula-sa" name="filterLocation[]" type="checkbox">Fleurieu Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="flinders-island-tas" name="filterLocation[]" type="checkbox">Flinders Island </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="flinders-ranges-sa" name="filterLocation[]" type="checkbox">Flinders Ranges </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="forest-park-qld" name="filterLocation[]" type="checkbox">Forest Park </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="franklin-gordon-national-park-tas" name="filterLocation[]" type="checkbox">Franklin Gordon National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="frankston-vic" name="filterLocation[]" type="checkbox">Frankston </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="fraser-coast-qld" name="filterLocation[]" type="checkbox">Fraser Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="fraser-island-qld" name="filterLocation[]" type="checkbox">Fraser Island </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="fremantle-wa" name="filterLocation[]" type="checkbox">Fremantle </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="freycinet-peninsula-tas" name="filterLocation[]" type="checkbox">Freycinet Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gayndah-qld" name="filterLocation[]" type="checkbox">Gayndah </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="geelong-vic" name="filterLocation[]" type="checkbox">Geelong </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="geraldton-wa" name="filterLocation[]" type="checkbox">Geraldton </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gladstone-qld" name="filterLocation[]" type="checkbox">Gladstone </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="glass-house-mountains-qld" name="filterLocation[]" type="checkbox">Glass House Mountains </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="glenelg-sa" name="filterLocation[]" type="checkbox">Glenelg </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gold-coast-qld" name="filterLocation[]" type="checkbox">Gold Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gold-coast-hinterland-qld" name="filterLocation[]" type="checkbox">Gold Coast Hinterland </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="goolwa-sa" name="filterLocation[]" type="checkbox">Goolwa </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="gosford-nsw" name="filterLocation[]" type="checkbox">Gosford </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="goulburn-nsw" name="filterLocation[]" type="checkbox">Goulburn </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="grafton-nsw" name="filterLocation[]" type="checkbox">Grafton </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="grampians-national-park-vic" name="filterLocation[]" type="checkbox">Grampians National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="great-barrier-reef-qld" name="filterLocation[]" type="checkbox">Great Barrier Reef </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="great-dividing-range-vic" name="filterLocation[]" type="checkbox">Great Dividing Range </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="great-keppel-island-qld" name="filterLocation[]" type="checkbox">Great Keppel Island </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="great-ocean-road-vic" name="filterLocation[]" type="checkbox">Great Ocean Road </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="greater-taree-nsw" name="filterLocation[]" type="checkbox">Greater Taree </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="green-island-qld" name="filterLocation[]" type="checkbox">Green Island </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="griffith-nsw" name="filterLocation[]" type="checkbox">Griffith </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gulf-savannah-qld" name="filterLocation[]" type="checkbox">Gulf Savannah </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="gympie-qld" name="filterLocation[]" type="checkbox">Gympie </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="halls-creek-wa" name="filterLocation[]" type="checkbox">Halls Creek </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="hamilton-island-qld" name="filterLocation[]" type="checkbox">Hamilton Island </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="hawkesbury-nsw" name="filterLocation[]" type="checkbox">Hawkesbury </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="hay-nsw" name="filterLocation[]" type="checkbox">Hay </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="hervey-bay-qld" name="filterLocation[]" type="checkbox">Hervey Bay </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="hobart-tas" name="filterLocation[]" type="checkbox">Hobart </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="holroyd-nsw" name="filterLocation[]" type="checkbox">Holroyd </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="horsham-vic" name="filterLocation[]" type="checkbox">Horsham </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="hunter-valley-nsw" name="filterLocation[]" type="checkbox">Hunter Valley </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="hurstville-nsw" name="filterLocation[]" type="checkbox">Hurstville </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="innes-national-park-sa" name="filterLocation[]" type="checkbox">Innes National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="innisfail-qld" name="filterLocation[]" type="checkbox">Innisfail </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="ipswich-qld" name="filterLocation[]" type="checkbox">Ipswich </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="islands-qld" name="filterLocation[]" type="checkbox">Islands </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="islands-tas" name="filterLocation[]" type="checkbox">Islands </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="islands-wa" name="filterLocation[]" type="checkbox">Islands </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="joondalup-wa" name="filterLocation[]" type="checkbox">Joondalup </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="kadina-sa" name="filterLocation[]" type="checkbox">Kadina </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="kakadu-nt" name="filterLocation[]" type="checkbox">Kakadu </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="kalbarri-wa" name="filterLocation[]" type="checkbox">Kalbarri </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="kalgoorlie-boulder-wa" name="filterLocation[]" type="checkbox">Kalgoorlie Boulder </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="kangaroo-island-sa" name="filterLocation[]" type="checkbox">Kangaroo Island </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="kangaroo-island-national-park-sa" name="filterLocation[]" type="checkbox">Kangaroo Island National Park </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="kapunda-sa" name="filterLocation[]" type="checkbox">Kapunda </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="karijini-national-park-wa" name="filterLocation[]" type="checkbox">Karijini National Park </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="karratha-wa" name="filterLocation[]" type="checkbox">Karratha </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="kata-tjuta-nt" checked="checked" name="filterLocation[]" type="checkbox">Kata Tjuta </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="katherine-nt" name="filterLocation[]" type="checkbox">Katherine </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="kenilworth-qld" name="filterLocation[]" type="checkbox">Kenilworth </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="kimberley-wa" name="filterLocation[]" type="checkbox">Kimberley </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="king-island-tas" name="filterLocation[]" type="checkbox">King Island </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="kings-canyon-nt" name="filterLocation[]" type="checkbox">Kings Canyon </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="kingscote-sa" name="filterLocation[]" type="checkbox">Kingscote </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="kingston-tas" name="filterLocation[]" type="checkbox">Kingston </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="kununurra-wa" name="filterLocation[]" type="checkbox">Kununurra </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="kuranda-qld" name="filterLocation[]" type="checkbox">Kuranda </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="lake-country-tas" name="filterLocation[]" type="checkbox">Lake Country </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="lakes-entrance-vic" name="filterLocation[]" type="checkbox">Lakes Entrance </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="lamington-national-park-qld" name="filterLocation[]" type="checkbox">Lamington National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="lamington-national-park-qld" name="filterLocation[]" type="checkbox">Lamington-national-park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="latrobe-vic" name="filterLocation[]" type="checkbox">Latrobe </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="launceston-tas" name="filterLocation[]" type="checkbox">Launceston </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="lismore-nsw" name="filterLocation[]" type="checkbox">Lismore </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="lithgow-nsw" name="filterLocation[]" type="checkbox">Lithgow </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="little-desert-national-park-vic" name="filterLocation[]" type="checkbox">Little Desert National Park </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="liverpool-nsw" name="filterLocation[]" type="checkbox">Liverpool </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="lizard-island-qld" name="filterLocation[]" type="checkbox">Lizard Island </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="logan-qld" name="filterLocation[]" type="checkbox">Logan </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="longreach-qld" name="filterLocation[]" type="checkbox">Longreach </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="lorne-vic" name="filterLocation[]" type="checkbox">Lorne </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mackay-qld" name="filterLocation[]" type="checkbox">Mackay </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="magnetic-island-qld" name="filterLocation[]" type="checkbox">Magnetic Island </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="main-beach-qld" name="filterLocation[]" type="checkbox">Main Beach </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="maitland-nsw" name="filterLocation[]" type="checkbox">Maitland </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="maleny-qld" name="filterLocation[]" type="checkbox">Maleny </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="mandurah-wa" name="filterLocation[]" type="checkbox">Mandurah </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="manly-nsw" name="filterLocation[]" type="checkbox">Manly </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mapleton-qld" name="filterLocation[]" type="checkbox">Mapleton </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="margaret-river-wa" name="filterLocation[]" type="checkbox">Margaret River </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="maroochy-qld" name="filterLocation[]" type="checkbox">Maroochy </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="maroochydore-qld" name="filterLocation[]" type="checkbox">Maroochydore </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="maryborough-qld" name="filterLocation[]" type="checkbox">Maryborough </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="mclaren-vale-sa" name="filterLocation[]" type="checkbox">Mclaren Vale </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="melbourne-vic" name="filterLocation[]" type="checkbox">Melbourne </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="melton-vic" name="filterLocation[]" type="checkbox">Melton </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="mid-north-sa" name="filterLocation[]" type="checkbox">Mid North </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mid-west-vic" name="filterLocation[]" type="checkbox">Mid West </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="middle-nt" name="filterLocation[]" type="checkbox">Middle </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mildura-vic" name="filterLocation[]" type="checkbox">Mildura </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="millstream-national-park-wa" name="filterLocation[]" type="checkbox">Millstream National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mission-beach-qld" name="filterLocation[]" type="checkbox">Mission Beach </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="mole-creek-karst-national-park-tas" name="filterLocation[]" type="checkbox">Mole Creek Karst National Park </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="monkey-mia-wa" name="filterLocation[]" type="checkbox">Monkey Mia </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="montville-qld" name="filterLocation[]" type="checkbox">Montville </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mooloolaba-qld" name="filterLocation[]" type="checkbox">Mooloolaba </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="moonta-sa" name="filterLocation[]" type="checkbox">Moonta </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="moree-nsw" name="filterLocation[]" type="checkbox">Moree </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="moreton-island-qld" name="filterLocation[]" type="checkbox">Moreton Island </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mornington-peninsula-vic" name="filterLocation[]" type="checkbox">Mornington Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="mount-barker-wa" name="filterLocation[]" type="checkbox">Mount Barker </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mount-coot-tha-qld" name="filterLocation[]" type="checkbox">Mount Coot tha </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="mount-gambier-sa" name="filterLocation[]" type="checkbox">Mount Gambier </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="mount-isa-qld" name="filterLocation[]" type="checkbox">Mount Isa </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="mount-william-national-park-tas" name="filterLocation[]" type="checkbox">Mount William National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mt-arapiles-state-park-vic" name="filterLocation[]" type="checkbox">Mt Arapiles State Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mt-buffalo-national-park-vic" name="filterLocation[]" type="checkbox">Mt Buffalo National Park </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="mt-gambier-sa" name="filterLocation[]" type="checkbox">Mt Gambier </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="mt-hotham-vic" name="filterLocation[]" type="checkbox">Mt Hotham </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="murray-bridge-sa" name="filterLocation[]" type="checkbox">Murray Bridge </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="murray-river-sa" name="filterLocation[]" type="checkbox">Murray River </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="naracoorte-sa" name="filterLocation[]" type="checkbox">Naracoorte </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="narrabri-wa" name="filterLocation[]" type="checkbox">Narrabri </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="new-norfolk-tas" name="filterLocation[]" type="checkbox">New Norfolk </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="newcastle-nsw" name="filterLocation[]" type="checkbox">Newcastle </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="nimbin-nsw" name="filterLocation[]" type="checkbox">Nimbin </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="ninety-mile-beach-vic" name="filterLocation[]" type="checkbox">Ninety Mile Beach </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="noosa-qld" name="filterLocation[]" type="checkbox">Noosa </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="north-vic" name="filterLocation[]" type="checkbox">North </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="north-coast-tas" name="filterLocation[]" type="checkbox">North Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="north-coast-qld" name="filterLocation[]" type="checkbox">North Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="north-coast-hinterland-qld" name="filterLocation[]" type="checkbox">North Coast Hinterland </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="north-stradbroke-island-qld" name="filterLocation[]" type="checkbox">North Stradbroke Island </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="north-west-vic" name="filterLocation[]" type="checkbox">North West </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="nullarbor-plain-wa" name="filterLocation[]" type="checkbox">Nullarbor Plain </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="onkaparinga-sa" name="filterLocation[]" type="checkbox">Onkaparinga </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="orange-nsw" name="filterLocation[]" type="checkbox">Orange </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="outback-qld" name="filterLocation[]" type="checkbox">Outback </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="outback-sa" name="filterLocation[]" type="checkbox">Outback </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="outback-wa" name="filterLocation[]" type="checkbox">Outback </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="palmerston-nt" name="filterLocation[]" type="checkbox">Palmerston </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="paluma-range-national-park-qld" name="filterLocation[]" type="checkbox">Paluma Range National Park </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="parramatta-nsw" name="filterLocation[]" type="checkbox">Parramatta </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="penneshaw-sa" name="filterLocation[]" type="checkbox">Penneshaw </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="penrith-nsw" name="filterLocation[]" type="checkbox">Penrith </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="perth-wa" name="filterLocation[]" type="checkbox">Perth </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="peterborough-sa" name="filterLocation[]" type="checkbox">Peterborough </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="phillip-island-vic" name="filterLocation[]" type="checkbox">Phillip Island </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="pilbara-wa" name="filterLocation[]" type="checkbox">Pilbara </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="pinnacles-desert-wa" name="filterLocation[]" type="checkbox">Pinnacles Desert </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="port-adelaide-sa" name="filterLocation[]" type="checkbox">Port Adelaide </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="port-arthur-tas" name="filterLocation[]" type="checkbox">Port Arthur </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="port-augusta-sa" name="filterLocation[]" type="checkbox">Port Augusta </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="port-douglas-qld" name="filterLocation[]" type="checkbox">Port Douglas </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="port-fairy-vic" name="filterLocation[]" type="checkbox">Port Fairy </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="port-hedland-wa" name="filterLocation[]" type="checkbox">Port Hedland </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="port-lincoln-sa" name="filterLocation[]" type="checkbox">Port Lincoln </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="port-macquarie-nsw" name="filterLocation[]" type="checkbox">Port Macquarie </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="port-pirie-sa" name="filterLocation[]" type="checkbox">Port Pirie </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="portland-vic" name="filterLocation[]" type="checkbox">Portland </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="prahran-vic" name="filterLocation[]" type="checkbox">Prahran </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="proserpine-qld" name="filterLocation[]" type="checkbox">Proserpine </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="queanbeyan-nsw" name="filterLocation[]" type="checkbox">Queanbeyan </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="queenstown-tas" name="filterLocation[]" type="checkbox">Queenstown </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="quorn-sa" name="filterLocation[]" type="checkbox">Quorn </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="rainbow-beach-qld" name="filterLocation[]" type="checkbox">Rainbow Beach </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="randwick-nsw" name="filterLocation[]" type="checkbox">Randwick </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="red-centre-nt" name="filterLocation[]" type="checkbox">Red Centre </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="redcliffe-city-qld" name="filterLocation[]" type="checkbox">Redcliffe City </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="redland-city-qld" name="filterLocation[]" type="checkbox">Redland City </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="richmond-tas" name="filterLocation[]" type="checkbox">Richmond </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="richmond-vic" name="filterLocation[]" type="checkbox">Richmond </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="rockdale-nsw" name="filterLocation[]" type="checkbox">Rockdale </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="rockhampton-qld" name="filterLocation[]" type="checkbox">Rockhampton </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="rockingham-wa" name="filterLocation[]" type="checkbox">Rockingham </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="rottness-island-wa" name="filterLocation[]" type="checkbox">Rottness Island </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="rottnest-island-wa" name="filterLocation[]" type="checkbox">Rottnest Island </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="rutherglen-vic" name="filterLocation[]" type="checkbox">Rutherglen </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="ryde-nsw" name="filterLocation[]" type="checkbox">Ryde </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="salamanca-place-tas" name="filterLocation[]" type="checkbox">Salamanca Place </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="sale-vic" name="filterLocation[]" type="checkbox">Sale </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="semaphore-sa" name="filterLocation[]" type="checkbox">Semaphore </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="shellharbour-nsw" name="filterLocation[]" type="checkbox">Shellharbour </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="shepparton-vic" name="filterLocation[]" type="checkbox">Shepparton </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="shoalhaven-nsw" name="filterLocation[]" type="checkbox">Shoalhaven </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="south-bank-qld" name="filterLocation[]" type="checkbox">South Bank </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="south-coast-tas" name="filterLocation[]" type="checkbox">South Coast </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="south-east-vic" name="filterLocation[]" type="checkbox">South East </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="south-west-vic" name="filterLocation[]" type="checkbox">South West </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="south-west-wa" name="filterLocation[]" type="checkbox">South West </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="south-west-forests-wa" name="filterLocation[]" type="checkbox">South West Forests </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="south-yarra-vic" name="filterLocation[]" type="checkbox">South Yarra </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="southbank-vic" name="filterLocation[]" type="checkbox">Southbank </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="southern-reef-islands-qld" name="filterLocation[]" type="checkbox">Southern Reef Islands </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="southport-qld" name="filterLocation[]" type="checkbox">Southport </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="southwest-national-park-tas" name="filterLocation[]" type="checkbox">Southwest National Park </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="springbrook-national-park-qld" name="filterLocation[]" type="checkbox">Springbrook National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="st-kilda-vic" name="filterLocation[]" type="checkbox">St Kilda </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="stanley-tas" name="filterLocation[]" type="checkbox">Stanley </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="stanthorpe-qld" name="filterLocation[]" type="checkbox">Stanthorpe </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="strahan-tas" name="filterLocation[]" type="checkbox">Strahan </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="sunrise-beach-qld" name="filterLocation[]" type="checkbox">Sunrise Beach </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="sunshine-coast-qld" name="filterLocation[]" type="checkbox">Sunshine Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="sunshine-coast-hinterland-qld" name="filterLocation[]" type="checkbox">Sunshine Coast Hinterland </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="surfers-paradise-qld" name="filterLocation[]" type="checkbox">Surfers Paradise </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="swan-hill-vic" name="filterLocation[]" type="checkbox">Swan Hill </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="swansea-tas" name="filterLocation[]" type="checkbox">Swansea </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="sydney-nsw" name="filterLocation[]" type="checkbox">Sydney </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="tamar-valley-tas" name="filterLocation[]" type="checkbox">Tamar Valley </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="tamborine-mountain-qld" name="filterLocation[]" type="checkbox">Tamborine Mountain </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="tamworth-nsw" name="filterLocation[]" type="checkbox">Tamworth </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="tanunda-sa" name="filterLocation[]" type="checkbox">Tanunda </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="taroona-tas" name="filterLocation[]" type="checkbox">Taroona </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="tasman-peninsula-tas" name="filterLocation[]" type="checkbox">Tasman Peninsula </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="tasmania-tas" name="filterLocation[]" type="checkbox">Tasmania </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="tennant-creek-nt" name="filterLocation[]" type="checkbox">Tennant Creek </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="test-city-qld" name="filterLocation[]" type="checkbox">test city </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="the-summit-qld" name="filterLocation[]" type="checkbox">The Summit </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="thuringowa-qld" name="filterLocation[]" type="checkbox">Thuringowa </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="tin-can-bay-qld" name="filterLocation[]" type="checkbox">Tin Can Bay </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="tiwi-islands-nt" name="filterLocation[]" type="checkbox">Tiwi Islands </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="toowoomba-qld" name="filterLocation[]" type="checkbox">Toowoomba </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="top-end-nt" name="filterLocation[]" type="checkbox">Top End </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="torquay-vic" name="filterLocation[]" type="checkbox">Torquay </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="torres-strait-islands-qld" name="filterLocation[]" type="checkbox">Torres Strait Islands </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="townsville-qld" name="filterLocation[]" type="checkbox">Townsville </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="trangie-nsw" name="filterLocation[]" type="checkbox">Trangie </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="tully-qld" name="filterLocation[]" type="checkbox">Tully </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="twelve-apostles-vic" name="filterLocation[]" type="checkbox">Twelve Apostles </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="ulladulla-nsw" name="filterLocation[]" type="checkbox">Ulladulla </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="uluru-nt" name="filterLocation[]" type="checkbox">Uluru </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="ulverstone-tas" name="filterLocation[]" type="checkbox">Ulverstone </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="victor-harbor-sa" name="filterLocation[]" type="checkbox">Victor Harbor </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="wagga-wagga-nsw" name="filterLocation[]" type="checkbox">Wagga Wagga </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="walhalla-vic" name="filterLocation[]" type="checkbox">Walhalla </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="wallaroo-sa" name="filterLocation[]" type="checkbox">Wallaroo </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="walpole-nornalup-national-park-wa" name="filterLocation[]" type="checkbox">Walpole Nornalup National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="wangaratta-vic" name="filterLocation[]" type="checkbox">Wangaratta </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="warnambool-vic" name="filterLocation[]" type="checkbox">Warnambool </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="warrnambool-vic" name="filterLocation[]" type="checkbox">Warrnambool </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="warwick-qld" name="filterLocation[]" type="checkbox">Warwick </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="wave-rock-wa" name="filterLocation[]" type="checkbox">Wave Rock </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="west-vic" name="filterLocation[]" type="checkbox">West </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="west-beach-sa" name="filterLocation[]" type="checkbox">West Beach </label></li>
																		<li><label><input class="list_citytype" data-province="7" value="west-coast-tas" name="filterLocation[]" type="checkbox">West Coast </label></li>
																		<li><label><input class="list_citytype" data-province="6" value="western-macdonnell-ranges-nt" name="filterLocation[]" type="checkbox">Western MacDonnell Ranges </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="whitsunday-coast-qld" name="filterLocation[]" type="checkbox">Whitsunday Coast </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="whitsundays-qld" name="filterLocation[]" type="checkbox">Whitsundays </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="whyalla-sa" name="filterLocation[]" type="checkbox">Whyalla </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="williamstown-vic" name="filterLocation[]" type="checkbox">Williamstown </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="willoughby-nsw" name="filterLocation[]" type="checkbox">Willoughby </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="wilpena-pound-sa" name="filterLocation[]" type="checkbox">Wilpena Pound </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="wilsons-promontory-national-park-vic" name="filterLocation[]" type="checkbox">Wilsons Promontory National Park </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="wodonga-vic" name="filterLocation[]" type="checkbox">Wodonga </label></li>
																		<li><label><input class="list_citytype" data-province="3" value="wollongong-nsw" name="filterLocation[]" type="checkbox">Wollongong </label></li>
																		<li><label><input class="list_citytype" data-province="2" value="wyndham-wa" name="filterLocation[]" type="checkbox">Wyndham </label></li>
																		<li><label><input class="list_citytype" data-province="5" value="yarra-valley-vic" name="filterLocation[]" type="checkbox">Yarra Valley </label></li>
																		<li><label><input class="list_citytype" data-province="1" value="yeppoon-qld" name="filterLocation[]" type="checkbox">Yeppoon </label></li>
																		<li><label><input class="list_citytype" data-province="4" value="yorke-peninsula-sa" name="filterLocation[]" type="checkbox">Yorke Peninsula </label></li>
																	</ul>
							</div>
							<span class="accroTitle"><i class="fa fa-wifi ltIcon"></i>Facilities<i class="fa fa-plus rtIcon"></i></span>
							<div class="block propertyType">
								<ul>
																				<li>
												<label>
													<input class="list_facility" value="1" name="filterAmmenities[]" type="checkbox">
													24 Hour Reception </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="2" name="filterAmmenities[]" type="checkbox">
													24 Hour Security </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="3" name="filterAmmenities[]" type="checkbox">
													Adaptors </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="4" name="filterAmmenities[]" type="checkbox">
													Air Conditioning </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="5" name="filterAmmenities[]" type="checkbox">
													Airport Transfers </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="6" name="filterAmmenities[]" type="checkbox">
													ATM </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="7" name="filterAmmenities[]" type="checkbox">
													Bar </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="8" name="filterAmmenities[]" type="checkbox">
													BBQ </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="9" name="filterAmmenities[]" type="checkbox">
													Bicycle Hire </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="10" name="filterAmmenities[]" type="checkbox">
													Bicycle Parking </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="11" name="filterAmmenities[]" type="checkbox">
													Board games </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="12" name="filterAmmenities[]" type="checkbox">
													Book Exchange </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="13" name="filterAmmenities[]" type="checkbox">
													Breakfast Included </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="14" name="filterAmmenities[]" type="checkbox">
													Breakfast Not Included </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="15" name="filterAmmenities[]" type="checkbox">
													Cable TV </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="16" name="filterAmmenities[]" type="checkbox">
													Cafe </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="17" name="filterAmmenities[]" type="checkbox">
													Card Phones </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="18" name="filterAmmenities[]" type="checkbox">
													Ceiling Fan </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="19" name="filterAmmenities[]" type="checkbox">
													Common Room </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="70" name="filterAmmenities[]" type="checkbox">
													Cots available </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="20" name="filterAmmenities[]" type="checkbox">
													Currency Exchange </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="67" name="filterAmmenities[]" type="checkbox">
													Direct Dial Telephone </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="73" name="filterAmmenities[]" type="checkbox">
													Dryer </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="21" name="filterAmmenities[]" type="checkbox">
													DVD's </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="22" name="filterAmmenities[]" type="checkbox">
													Elevator </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="23" name="filterAmmenities[]" type="checkbox">
													Fax Service </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="24" name="filterAmmenities[]" type="checkbox">
													Foosball </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="25" name="filterAmmenities[]" type="checkbox">
													Free Airport Transfer </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="26" name="filterAmmenities[]" type="checkbox">
													Free City Maps </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="27" name="filterAmmenities[]" type="checkbox">
													Free Internet Access </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="28" name="filterAmmenities[]" type="checkbox">
													Free Parking </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="29" name="filterAmmenities[]" type="checkbox">
													Free WiFi </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="30" name="filterAmmenities[]" type="checkbox">
													Games Room </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="77" name="filterAmmenities[]" type="checkbox">
													Gym </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="31" name="filterAmmenities[]" type="checkbox">
													Hairdryers </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="32" name="filterAmmenities[]" type="checkbox">
													Hairdryers For Hire </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="33" name="filterAmmenities[]" type="checkbox">
													Hot Showers </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="34" name="filterAmmenities[]" type="checkbox">
													Hot Tub </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="35" name="filterAmmenities[]" type="checkbox">
													Housekeeping </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="68" name="filterAmmenities[]" type="checkbox">
													Indoor Swimming Pool </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="78" name="filterAmmenities[]" type="checkbox">
													Indoor Swimming Pool </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="36" name="filterAmmenities[]" type="checkbox">
													Internet Access </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="74" name="filterAmmenities[]" type="checkbox">
													Iron/Ironing Board </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="37" name="filterAmmenities[]" type="checkbox">
													Jobs Board </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="38" name="filterAmmenities[]" type="checkbox">
													Key Card Access </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="39" name="filterAmmenities[]" type="checkbox">
													Kitchen </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="40" name="filterAmmenities[]" type="checkbox">
													Laundry Facilities </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="41" name="filterAmmenities[]" type="checkbox">
													Linen Included </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="71" name="filterAmmenities[]" type="checkbox">
													Linen Not Included </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="42" name="filterAmmenities[]" type="checkbox">
													Lockers </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="72" name="filterAmmenities[]" type="checkbox">
													Lounge </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="43" name="filterAmmenities[]" type="checkbox">
													Luggage Storage </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="44" name="filterAmmenities[]" type="checkbox">
													Meals available </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="45" name="filterAmmenities[]" type="checkbox">
													Meeting Room </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="75" name="filterAmmenities[]" type="checkbox">
													Microwave </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="46" name="filterAmmenities[]" type="checkbox">
													Mini-Supermarket </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="69" name="filterAmmenities[]" type="checkbox">
													Minibar </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="47" name="filterAmmenities[]" type="checkbox">
													Nightclub </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="48" name="filterAmmenities[]" type="checkbox">
													Outdoor Swimming Pool </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="49" name="filterAmmenities[]" type="checkbox">
													Outdoor Terrace </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="50" name="filterAmmenities[]" type="checkbox">
													Parking </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="51" name="filterAmmenities[]" type="checkbox">
													PlayStation </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="52" name="filterAmmenities[]" type="checkbox">
													Pool Table </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="53" name="filterAmmenities[]" type="checkbox">
													Postal Service </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="54" name="filterAmmenities[]" type="checkbox">
													Reading Light </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="55" name="filterAmmenities[]" type="checkbox">
													Restaurant </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="56" name="filterAmmenities[]" type="checkbox">
													Safe Deposit Box </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="57" name="filterAmmenities[]" type="checkbox">
													Shuttle Bus </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="58" name="filterAmmenities[]" type="checkbox">
													Swimming Pool </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="59" name="filterAmmenities[]" type="checkbox">
													Tea/Coffee Making Facilities </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="60" name="filterAmmenities[]" type="checkbox">
													Tours/Travel Desk </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="61" name="filterAmmenities[]" type="checkbox">
													Towels for hire </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="62" name="filterAmmenities[]" type="checkbox">
													Towels Included </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="76" name="filterAmmenities[]" type="checkbox">
													Utensils </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="63" name="filterAmmenities[]" type="checkbox">
													Vending Machines </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="64" name="filterAmmenities[]" type="checkbox">
													Washing machine </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="65" name="filterAmmenities[]" type="checkbox">
													Wheelchair Accessible </label>
											</li>
																						<li>
												<label>
													<input class="list_facility" value="66" name="filterAmmenities[]" type="checkbox">
													Wii </label>
											</li>
																			</ul>
							</div>
						</div>
					</div>
				</aside>

			
			<div class="rightSide rtCls">
			<ul>
         <li>
            <div class="imgDiv alignleft">
               <img src="images/img6.jpg" alt="img">
            </div>
            <div class="listTxt alignright">
            <div class="listUp clearfix">
               <div class="listName alignleft">
                  <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
                  <h6>462 George Street, B...  0.8km</h6>
               </div>
               <div class="blueRate alignright">
                  8.5 
               </div>
            </div>
            <div class="listBtm clearfix">
               <div class="listBtmLt alignleft">
                  <p>
                     Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
                  </p>
                  <div class="chkBx">
                     <input type="checkbox"> Compare 
                  </div>
               </div>
               <div class="listBtmRt alignright">
                  <span>Fabulous </span>
                  <div class="bleRtBox">
                     <div class="full_width">
                        <span>Dorms From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <div class="full_width">
                        <span>Privates From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <a class="conBtn" href="#">CONTINUE</a>
                  </div>
               </div>
            </div>
         </li>
         <li>
            <div class="imgDiv alignleft">
               <img src="images/img6.jpg" alt="img">
            </div>
            <div class="listTxt alignright">
            <div class="listUp clearfix">
               <div class="listName alignleft">
                  <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
                  <h6>462 George Street, B...  0.8km</h6>
               </div>
               <div class="blueRate alignright">
                  8.5 
               </div>
            </div>
            <div class="listBtm clearfix">
               <div class="listBtmLt alignleft">
                  <p>
                     Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
                  </p>
                  <div class="chkBx">
                     <input type="checkbox"> Compare 
                  </div>
               </div>
               <div class="listBtmRt alignright">
                  <span>Fabulous </span>
                  <div class="bleRtBox">
                     <div class="full_width">
                        <span>Dorms From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <div class="full_width">
                        <span>Privates From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <a class="conBtn" href="#">CONTINUE</a>
                  </div>
               </div>
            </div>
         </li>
         <li>
            <div class="imgDiv alignleft">
               <img src="images/img6.jpg" alt="img">
            </div>
            <div class="listTxt alignright">
            <div class="listUp clearfix">
               <div class="listName alignleft">
                  <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
                  <h6>462 George Street, B...  0.8km</h6>
               </div>
               <div class="blueRate alignright">
                  8.5 
               </div>
            </div>
            <div class="listBtm clearfix">
               <div class="listBtmLt alignleft">
                  <p>
                     Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
                  </p>
                  <div class="chkBx">
                     <input type="checkbox"> Compare 
                  </div>
               </div>
               <div class="listBtmRt alignright">
                  <span>Fabulous </span>
                  <div class="bleRtBox">
                     <div class="full_width">
                        <span>Dorms From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <div class="full_width">
                        <span>Privates From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <a class="conBtn" href="#">CONTINUE</a>
                  </div>
               </div>
            </div>
         </li>
         <li>
            <div class="imgDiv alignleft">
               <img src="images/img6.jpg" alt="img">
            </div>
            <div class="listTxt alignright">
            <div class="listUp clearfix">
               <div class="listName alignleft">
                  <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
                  <h6>462 George Street, B...  0.8km</h6>
               </div>
               <div class="blueRate alignright">
                  8.5 
               </div>
            </div>
            <div class="listBtm clearfix">
               <div class="listBtmLt alignleft">
                  <p>
                     Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
                  </p>
                  <div class="chkBx">
                     <input type="checkbox"> Compare 
                  </div>
               </div>
               <div class="listBtmRt alignright">
                  <span>Fabulous </span>
                  <div class="bleRtBox">
                     <div class="full_width">
                        <span>Dorms From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <div class="full_width">
                        <span>Privates From</span>
                        <span>AUD  250.00</span>
                     </div>
                     <a class="conBtn" href="#">CONTINUE</a>
                  </div>
               </div>
            </div>
         </li>
         <li>
            <div class="imgDiv alignleft">
               <img src="images/img6.jpg" alt="img">
            </div>
            <div class="listTxt alignright">
               <div class="listUp clearfix">
                  <div class="listName alignleft">
                     <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
                     <h6>462 George Street, B...  0.8km</h6>
                  </div>
                  <div class="blueRate alignright">
                     8.5 
                  </div>
               </div>
               <div class="listBtm clearfix">
                  <div class="listBtmLt alignleft">
                     <p>
                        Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
                     </p>
                     <div class="chkBx">
                        <input type="checkbox"> Compare 
                     </div>
                  </div>
                  <div class="listBtmRt alignright">
                     <span>Fabulous </span>
                     <div class="bleRtBox">
                        <div class="full_width">
                           <span>Dorms From</span>
                           <span>AUD  250.00</span>
                        </div>
                        <div class="full_width">
                           <span>Privates From</span>
                           <span>AUD  250.00</span>
                        </div>
                        <a class="conBtn" href="#">CONTINUE</a>
                     </div>
                  </div>
               </div>
         </li>
         <li>
         <div class="imgDiv alignleft">
         <img src="images/img6.jpg" alt="img">
         </div>
         <div class="listTxt alignright">
         <div class="listUp clearfix">
         <div class="listName alignleft">
         <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
         <h6>462 George Street, B...  0.8km</h6>
         </div>
         <div class="blueRate alignright">
         8.5 
         </div>
         </div>
         <div class="listBtm clearfix">
         <div class="listBtmLt alignleft">
         <p>
         Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
         </p>
         <div class="chkBx">
         <input type="checkbox"> Compare 
         </div>
         </div>
         <div class="listBtmRt alignright">
         <span>Fabulous </span>
         <div class="bleRtBox">
         <div class="full_width">
         <span>Dorms From</span>
         <span>AUD  250.00</span>
         </div>
         <div class="full_width">
         <span>Privates From</span>
         <span>AUD  250.00</span>
         </div>
         <a class="conBtn" href="#">CONTINUE</a>
         </div>
         </div>
         </div>
         </li>
         <li>
         <div class="imgDiv alignleft">
         <img src="images/img6.jpg" alt="img">
         </div>
         <div class="listTxt alignright">
         <div class="listUp clearfix">
         <div class="listName alignleft">
         <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
         <h6>462 George Street, B...  0.8km</h6>
         </div>
         <div class="blueRate alignright">
         8.5 
         </div>
         </div>
         <div class="listBtm clearfix">
         <div class="listBtmLt alignleft">
         <p>
         Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
         </p>
         <div class="chkBx">
         <input type="checkbox"> Compare 
         </div>
         </div>
         <div class="listBtmRt alignright">
         <span>Fabulous </span>
         <div class="bleRtBox">
         <div class="full_width">
         <span>Dorms From</span>
         <span>AUD  250.00</span>
         </div>
         <div class="full_width">
         <span>Privates From</span>
         <span>AUD  250.00</span>
         </div>
         <a class="conBtn" href="#">CONTINUE</a>
         </div>
         </div>
         </div>
         </li>
         <li>
         <div class="imgDiv alignleft">
         <img src="images/img6.jpg" alt="img">
         </div>
         <div class="listTxt alignright">
         <div class="listUp clearfix">
         <div class="listName alignleft">
         <h5>Base Brisbane Uptown (formerly Tinbilly)</h5>
         <h6>462 George Street, B...  0.8km</h6>
         </div>
         <div class="blueRate alignright">
         8.5 
         </div>
         </div>
         <div class="listBtm clearfix">
         <div class="listBtmLt alignleft">
         <p>
         Clostest hostel to Roma Street Transit Centre, located directly opposite the Greyhound and premier bus station. Cheap and nicest meals in town, free wifi in areas, free activities in our bar at night. Base Uptown is... More...
         </p>
         <div class="chkBx">
         <input type="checkbox"> Compare 
         </div>
         </div>
         <div class="listBtmRt alignright">
         <span>Fabulous </span>
         <div class="bleRtBox">
         <div class="full_width">
         <span>Dorms From</span>
         <span>AUD  250.00</span>
         </div>
         <div class="full_width">
         <span>Privates From</span>
         <span>AUD  250.00</span>
         </div>
         <a class="conBtn" href="#">CONTINUE</a>
         </div>
         </div>
         </div>
         </li>
      </ul>
				 </div>
      </div>
      </div>
      <div class="appPanel">
      <div class="MainCon clearfix">
      <div class="appPh alignright">
      <img src="images/ph-app.png" alt="img">
      </div>
      <div class="appTxt alignleft">
      <h3> Check out the <strong>HostelMofo</strong> app </h3>
      <span>Book from anywhere and win awesome weekly prizes</span> 
      <div class="appBtn">
      <a href="#"><img src="images/app-str.png" alt="img"></a>
      <a href="#"><img src="images/ggl-ply.png" alt="img"></a>
      </div>
      </div>
      </div>
      </div>
      </div>
      
      
      
      
      <footer class="footer" >
      <div class="footTp">
      <div class="MainCon clearfix">
      <div class="footBox">
      <h4>Quick links</h4>
      <div class="footIn">
      <ul>
      <li><a href="#">about us</a></li>
      <li><a href="#">Contact us</a></li>
      <li><a href="#">Terms & Conditions</a></li>
      <li><a href="#">Privacy Policy</a></li>
      </ul>
      </div>
      </div>
      <div class="footBox">
      <h4>Contact us</h4>
      <div class="footIn">
      <span>585 Little Collins St. Melbourne<br>
      VIC 3000 
      </span>
      <span>Phone: <a href="tel:1300553880">1300 553 880</a></span>
      </div>
      </div>
      <div class="footBox">
      <h4>Follow Us</h4>
      <div class="footIn">
      <ul>
      <li><a href="#">Facebook</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">instagram</a></li>
      <li><a href="#">pinterest</a></li>
      </ul>
      </div>
      </div>
      <div class="footBox">
      <h4>Join with us</h4>
      <div class="footIn">
      <form>
      <input type="text" value="" name="Name" placeholder="Name">
      <input type="text" value="" name="Email" placeholder="Email">
      <textarea placeholder="Message" class="textArea" name="messages"></textarea>
      <input type="submit" name="send" value="Submit">
      </form>
      </div>
      </div>
      </div>
      </div>
      <div class="footBtm">
      <div class="MainCon">
      &copy 2016  <a href="#">Hostelmofo</a> 
      </div>
      </div>
      </footer>
      </div>
      <div off-canvas="slidebar-2 right shift">
         <ul class="sideNav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Hostel</a></li>
            <li><a href="#">Working Hostel</a></li>
            <li><a href="#">Hotel</a></li>
            <li><a href="#">Camping</a></li>
            <li><a href="#">Blog</a></li>
         </ul>
      </div>
      <script src="js/slidebars.js"></script>
      <script src="js/scripts-menu.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 
      <script type="text/javascript" src="js/jquery.pagepiling.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
      <script src="js/script.js"></script>
   </body>
-->




<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLUbUrEYKB7vsqDWIa47fq2Y2LmDwyP_4"></script>
<div class="proSlide">
	 <!--<h3>FEATURED PROPERTIES</h3>-->
	
</div>


<div class="proDisplay">
	 <div class="proBtns clearfix">
			<div class="btnLt alignleft">
                        <a href="javascript:void(0)" class="blBtn filterbutton">Filter</a>
                        <a href="javascript:void(0)" class="blBtn">Sort</a>
                     
				
				
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
				 </select>
			</div>
			<div class="btnRt alignright">
				 <em>Display :</em> 
				 <a class="blBtn listclass active" href="#">List</a>
				 <a class="blBtn gridclass" href="#">Grid</a>
				 <a class="blBtn" href="<?php echo FRONTEND_URL;?>maplist/<?php echo $map_url;?>">Map</a>
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
							<li><input type="checkbox" class="list_ptype" name="filterpropType[]" value="<?php echo $prop_type['property_type_id'];?>"><label for="roomType<?php echo $prop_type['property_type_slug'];?>"><?php echo stripcslashes($prop_type['property_type_name']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<div id="box_filter_roomtype" class="filter-section">
					<div id="filter_roomtype">
						<ul>
							<?php foreach($roomtype_list as $room_type){?>
							<li><input type="checkbox" class="list_roomtype" name="filterRoomtype[]" value="<?php echo $room_type['roomtype_id'];?>"><label for="roomType<?php echo $room_type['roomtype_slug'];?>"><?php echo stripcslashes($room_type['roomtype_name']);?></label></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				
				<div id="box_filter_facilities" class="filter-section">
					<div id="filter_facilities">
						<ul class="facilities_list">
							<?php foreach($facility_list as $fac){?>
							<li><input type="checkbox" class="list_facility" name="filterAmmenities[]" value="<?php echo $fac['amenities_id'];?>"><label for="facility<?php echo $fac['amenities_id'];?>"><?php echo stripcslashes($fac['amenities_name']);?></label></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
	 </div>
	 </div>
</div>




<div class="listingContent globalClr">
	 <?php
	 /*if($cityname != '' && $province != ''){ ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo $cityname.', '.$province.', Australia'; ?></span>
			<?php
	 }
	 else if($cityname == '' && $province != '') { ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo $province.', Australia'; ?></span>
			<?php
	 }
	 else if($cityname == '' && $province == '') { ?>
			<span class="lsitingTitle globalClr">Hostels in <?php echo 'Australia'; ?></span>
			<?php
	 }*/
	 ?>
<!--	 <div class="lsitResult">
			<strong>
				 <span id="totalCount"><?php echo ($totalCount>0?$totalCount:0);?></span>
				 Results:
			</strong>
			<?php echo ($checkin_date!=''?$checkin_date.' - ':'');  echo ($checkout_date!=''?$checkout_date:'');?>
	 </div>
-->
<!--	 <div class="listingView">
			<ul class="clearfix">
				 <li class="active"><a href="#">View grid</a></li>
				 <li><a href="<?php echo FRONTEND_URL;?>maplist/<?php echo $map_url;?>">Map View</a></li>
				 <li><span>Hostel Reviews</span></li>
			</ul>
	 </div>
-->
	 <div class="listingSort globalClr clearfix">
<!--			<div class="ltCls sortSelect">
				 <label class="labelName">Sort By: </label>
				 <label class="stylishSelect">
						<select name="sortby" id="sortby">
							 <option selected="selected" value="name-az">Name (A-Z)</option>
							 <option value="name-za">Name (Z-A)</option>
							 <option value="price-asc">Price: Low to High</option>
							 <option value="price-desc">Price: High to low</option>
						</select>
				 </label>
			</div>
--><!--			<div class="ltCls pageSelect">
				 <label class="labelName">per page:</label>
				 <label class="stylishSelect">
						<select name="perpage" id="perpage">
							 
							 <option value="4">4</option>
							 <option value="10">10</option>
							 <option selected="selected" value="20">20</option>
							 <option value="50">50</option>
							 <option value="100">100</option>
							 <option value="all">All</option>
						</select>
				 </label>
			</div>
-->	 </div>
	 <input id="page" type="hidden" value="1" name="page">
	 <!--<<div class="listingItems globalClr clearfix gridView" id="filterpropertydata"></div>-->
	 <!--<div class="searchRes"></div>-->
	 <div class="proList" id="filterpropertydata"></div>
	 <div class="pagiWrapper"></div>
</div>
<div id="listcontent"></div>
	




			</ul>
	 </div>
				 
				 
				 
	 <!-- end main content-->
	 <div class="appPanel">
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
	 
	 <input type="hidden" id="prop_id" value="">
		<input type="hidden" id="compare_count" value="">
	 
	 
