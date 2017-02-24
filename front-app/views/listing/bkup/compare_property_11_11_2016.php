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



</style>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	 <div class="modal-header">
		  <button type="button" class="close close-reveal-modal" data-dismiss="modal" aria-hidden="true"></button>
	 </div>
	 <div class="modal-body">
      <div class="myaccount circle"></div>
      <span class="c_restore"><i class="fa fa-undo"></i> Reset</span>
      <h2 class="compare_result">Compare Results</h2>
			<table class="comparetable" width="100%" cellspacing="0" cellpadding="0" border="0">
				 <tbody>
						<?php
						$arr = array();
						$y = 0;
						foreach($propdetails as $key => $value){
							 $details = explode(",",$value);
							 if($y == 0){?>
									<tr>
										 <td class="c_leftcol" width="20%"><h4>Overview</h4></td>
										 <?php for($i=0;$i<count($details);$i++){ ?>
										 <td class="c_prop1 c_propheader">
												<div class="c_hidecolumn" id="hideProperty_1" rel="16578"><i class="fa fa-times"></i></div>
												<span class="proptype">Hostel</span>
												<h4><?=$details[$i];?></h4>
										 </td>
										 <?php } ?>
										<!-- <td class="c_prop2 c_propheader">
												<div class="c_hidecolumn" id="hideProperty_2" rel="7643"><i class="fa fa-times"></i></div>
												<span class="proptype">Hostel</span>
												<h4>Adelaide's Shakespeare International Backpackers</h4>
										 </td>-->
									</tr>
									<?php
							 }
							 else{ ?>
						
							 <tr>
									<td class="c_leftcol" width="20%"><?=$key;?></td>
									<?php for($i=0;$i<count($details);$i++){ ?>
									<td class="c_prop1"><?=$details[$i];?></td>
									<?php } ?>
									<!--<td class="c_prop2">INR 3724.90 </td>-->
							 </tr>
							 <?php		 
						}
						$y++;
				 }
				 ?>
						
						<!--
						<tr>
							 <td class="c_leftcol" width="20%">Dorms From</td>
							 <td class="c_prop1">INR 1581.81 </td>
							 <td class="c_prop2">INR 1173.60 </td>
						</tr>
						<tr>
							 <td class="c_leftcol" width="20%">Rating</td>
							 <td class="c_prop1">8.8 (508 Reviews) Fabulous</td>
							 <td class="c_prop2">8.6 (161 Reviews) Fabulous</td>
						</tr>
						<tr class="distanceFromMe" style="display:none;">
							 <td class="c_leftcol" width="20%">Distance from me</td>
							 <td class="c_prop1" id="distanceFromMe_16578"></td>
							 <td class="c_prop2" id="distanceFromMe_7643"></td>
						</tr>
						<tr>
							 <td class="c_leftcol" width="20%">Distance from city centre</td>
							 <td class="c_prop1">0.5km</td>
							 <td class="c_prop2">0.4km</td>
						</tr>
						<tr>
							 <td class="c_leftcol" width="20%"><h4>Facilities</h4></td>
							 <td class="c_prop1">&nbsp;</td><td class="c_prop2">&nbsp;</td>
						</tr>
						<tr class="not-initial-facility" style="display: none;">
							 <td class="c_leftcol" width="20%">24 Hour Reception</td>
							 <td class="c_prop1"><i class="fa fa-check rounded"></i></td>
							 <td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						</tr>
						<tr class="not-initial-facility" style="display: none;">
							 <td class="c_leftcol" width="20%">24 Hour Security</td>
							 <td class="c_prop1"><i class="fa fa-check rounded"></i></td>
							 <td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						</tr>
						<tr class="not-initial-facility" style="display: none;">
							 <td class="c_leftcol" width="20%">Air Conditioning</td>
							 <td class="c_prop1"><i class="fa fa-check rounded"></i></td>
							 <td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						</tr>
						<tr class="not-initial-facility" style="display: none;">
							 <td class="c_leftcol" width="20%">Bar</td>
							 
							 <td class="c_prop1"><i class="fa fa-times rounded"></i></td>
							 
							 <td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Free Breakfast</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Free Internet Access</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Free Parking</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Free WiFi</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Self-Catering Facilities</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Luggage Storage</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Parking</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Swimming Pool</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Airport Transfers</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Bicycle Parking</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Cable TV</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Ceiling Fan</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Child Friendly</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Common Room</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Cooker</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Fridge/Freezer</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Fitness Centre</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Housekeeping</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Internet Access</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Key Card Access</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Laundry Facilities</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Linen Included</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Security Lockers</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Meals Available</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Minibar</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Nightclub</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">No Curfew</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Non Smoking</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Pet Friendly</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Restaurant</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Safe Deposit Box</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Shuttle Bus</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Towels for hire</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Towels Included</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-times rounded"></i></td>
						
						</tr>
				 
						<tr class="not-initial-facility" style="display: none;">
						<td class="c_leftcol" width="20%">Washing Machine</td>
						
						<td class="c_prop1"><i class="fa fa-times rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
				 
						<tr class="initial-facility">
						<td class="c_leftcol" width="20%">Wheelchair Friendly</td>
						
						<td class="c_prop1"><i class="fa fa-check rounded"></i></td>
						
						<td class="c_prop2"><i class="fa fa-check rounded"></i></td>
						
						</tr>
						-->
				 <tr>
				 <td class="c_leftcol" width="20%"><a href="" id="c_showFacilities">Show more</a></td>
				 <td class="c_prop1">&nbsp;</td><td class="c_prop2">&nbsp;</td>
				 </tr>
				 <tr>
				 <td class="c_leftcol" width="20%"><h4>Location</h4></td>
				 <td class="c_map" colspan="2">
				 <div id="compareMap" class="mapView" style="height: 500px; width: 800px; position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; background-color: rgb(229, 227, 223);"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;" class="gm-style"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;" aria-hidden="true"><div style="width: 256px; height: 256px; position: absolute; left: 278px; top: 179px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 22px; top: 179px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 278px; top: -77px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 278px; top: 435px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 534px; top: 179px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 22px; top: -77px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 22px; top: 435px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 534px; top: -77px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 534px; top: 435px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -234px; top: 179px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 790px; top: 179px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -234px; top: -77px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -234px; top: 435px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 790px; top: -77px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 790px; top: 435px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;" aria-hidden="true"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 278px; top: 179px;"><canvas draggable="false" style="-moz-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;" height="256" width="256"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 22px; top: 179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 278px; top: -77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 278px; top: 435px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 534px; top: 179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 22px; top: -77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 22px; top: 435px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 534px; top: -77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 534px; top: 435px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -234px; top: 179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 790px; top: 179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -234px; top: -77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -234px; top: 435px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 790px; top: -77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 790px; top: 435px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;" aria-hidden="true"><div style="position: absolute; left: 278px; top: 179px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1812!3i1236!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=77770" draggable="false" alt=""></div><div style="position: absolute; left: 22px; top: 179px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1811!3i1236!4i256!2m3!1e0!2sm!3i367040834!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=986" draggable="false" alt=""></div><div style="position: absolute; left: 278px; top: -77px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1812!3i1235!4i256!2m3!1e0!2sm!3i367040834!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=39575" draggable="false" alt=""></div><div style="position: absolute; left: 278px; top: 435px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1812!3i1237!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=75806" draggable="false" alt=""></div><div style="position: absolute; left: 534px; top: 179px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1813!3i1236!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=114395" draggable="false" alt=""></div><div style="position: absolute; left: 22px; top: -77px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1811!3i1235!4i256!2m3!1e0!2sm!3i367040834!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=2950" draggable="false" alt=""></div><div style="position: absolute; left: 22px; top: 435px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1811!3i1237!4i256!2m3!1e0!2sm!3i367040378!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=1464" draggable="false" alt=""></div><div style="position: absolute; left: 534px; top: -77px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1813!3i1235!4i256!2m3!1e0!2sm!3i367040834!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=76200" draggable="false" alt=""></div><div style="position: absolute; left: 534px; top: 435px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1813!3i1237!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=112431" draggable="false" alt=""></div><div style="position: absolute; left: -234px; top: 179px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1810!3i1236!4i256!2m3!1e0!2sm!3i367040414!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=83549" draggable="false" alt=""></div><div style="position: absolute; left: 790px; top: 179px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1814!3i1236!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=19949" draggable="false" alt=""></div><div style="position: absolute; left: -234px; top: -77px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1810!3i1235!4i256!2m3!1e0!2sm!3i367040414!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=85513" draggable="false" alt=""></div><div style="position: absolute; left: -234px; top: 435px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1810!3i1237!4i256!2m3!1e0!2sm!3i367039154!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=37227" draggable="false" alt=""></div><div style="position: absolute; left: 790px; top: -77px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1814!3i1235!4i256!2m3!1e0!2sm!3i367041026!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=22576" draggable="false" alt=""></div><div style="position: absolute; left: 790px; top: 435px; transition: opacity 200ms ease-out 0s;"><img style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i11!2i1814!3i1237!4i256!2m3!1e0!2sm!3i367041182!3m14!2sen!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcy50OjJ8cy5lOmx8cC52Om9uLHMudDozM3xwLnY6b2ZmLHMudDozNnxwLnY6b2ZmLHMudDozNXxwLnY6b2ZmLHMudDo0fHMuZTpsfHAudjpvbg!4e0&amp;token=17985" draggable="false" alt=""></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%; transition-duration: 0.3s; opacity: 0; display: none;" class="gm-style-pbc"><p class="gm-style-pbt">Use two fingers to move the map</p></div><div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 4; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a style="position: static; overflow: visible; float: none; display: inline;" target="_blank" href="https://maps.google.com/maps?ll=-34.92577,138.599732&amp;z=11&amp;t=m&amp;hl=en&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps"><div style="width: 66px; height: 26px; cursor: pointer;"><img style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="http://maps.gstatic.com/mapfiles/api-3/images/google_white5.png" draggable="false"></div></a></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 250px; top: 160px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;">Map data ©2016 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false"></div></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 161px; bottom: 0px; width: 121px;"><div draggable="false" style="-moz-user-select: none; height: 14px; line-height: 14px;" class="gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="">Map data ©2016 Google</span></div></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2016 Google</div></div><div class="gmnoprint gm-style-cc" style="z-index: 1000001; -moz-user-select: none; height: 14px; line-height: 14px; position: absolute; right: 92px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);" href="https://www.google.com/intl/en_US/help/terms_maps.html" target="_blank">Terms of Use</a></div></div><div style="width: 25px; height: 25px; overflow: hidden; display: none; margin: 10px 14px; position: absolute; top: 0px; right: 0px;"><img style="position: absolute; left: -52px; top: -86px; width: 164px; height: 175px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="http://maps.gstatic.com/mapfiles/api-3/images/sv9.png" draggable="false" class="gm-fullscreen-control"></div><div draggable="false" style="-moz-user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;" class="gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_new" title="Report errors in the road map or imagery to Google" style="font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" href="https://www.google.com/maps/@-34.92577,138.599732,11z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3">Report a map error</a></div></div><div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" style="margin: 10px; -moz-user-select: none; position: absolute; bottom: 107px; right: 28px;" draggable="false" controlwidth="28" controlheight="93"><div class="gmnoprint" style="position: absolute; left: 0px; top: 38px;" controlwidth="28" controlheight="55"><div draggable="false" style="-moz-user-select: none; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255); width: 28px; height: 55px;"><div title="Zoom in" style="position: relative; width: 28px; height: 27px; left: 0px; top: 0px;"><div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;"><img style="position: absolute; left: 0px; top: 0px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;" src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false"></div></div><div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230); top: 0px;"></div><div title="Zoom out" style="position: relative; width: 28px; height: 27px; left: 0px; top: 0px;"><div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;"><img style="position: absolute; left: 0px; top: -15px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;" src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false"></div></div></div></div><div class="gm-svpc" style="background-color: rgb(255, 255, 255); box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); border-radius: 2px; width: 28px; height: 28px; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; position: absolute; left: 0px; top: 0px;" controlwidth="28" controlheight="28"><div style="position: absolute; left: 1px; top: 1px;"></div><div style="position: absolute; left: 1px; top: 1px;"><div style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px;" aria-label="Street View Pegman Control"><img style="position: absolute; left: -147px; top: -26px; width: 215px; height: 835px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png" draggable="false"></div><div style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;" aria-label="Pegman is on top of the Map"><img style="position: absolute; left: -147px; top: -52px; width: 215px; height: 835px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png" draggable="false"></div><div style="width: 26px; height: 26px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;" aria-label="Street View Pegman Control"><img style="position: absolute; left: -147px; top: -78px; width: 215px; height: 835px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none;" src="http://maps.gstatic.com/mapfiles/api-3/images/cb_scout5.png" draggable="false"></div></div></div></div><div class="gmnoprint gm-style-mtc" style="margin: 10px; z-index: 0; position: absolute; cursor: pointer; text-align: left; width: 85px; left: 0px; top: 0px;"><div style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-radius: 2px; background-clip: padding-box; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); font-weight: 500;" draggable="false" title="Change map style">Map<img src="http://maps.gstatic.com/mapfiles/arrow-down.png" draggable="false" style="-moz-user-select: none; border: 0px none; padding: 0px; margin: -2px 0px 0px; position: absolute; right: 6px; top: 50%; width: 7px; height: 4px;"></div><div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); position: absolute; top: 100%; left: 0px; right: 0px; text-align: left; display: none;"><div style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px; font-weight: 500;" draggable="false" title="Show street map">Map</div><div style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px;" draggable="false" title="Show satellite imagery">Satellite</div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235);"></div><div style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;" draggable="false" title="Show street map with terrain"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;" src="http://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false"></div></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235); display: none;"></div><div style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap; display: none;" draggable="false" title="Show imagery with street names"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;" src="http://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false"></div></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div></div></div></div></div></div>
				 </td>
				 </tr>
				 </tbody>
			</table>
    	
	 </div>
</div>