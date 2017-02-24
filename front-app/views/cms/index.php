<div class="main">
		<div class="MainCon">
				<div class="detailsPanTop">
						<div class="titleSec globalClr">
								<?php
								if($succmsg){?>
										<div class="success_msg"><?php echo $succmsg ?></div>
										<?php
								}
								elseif($errmsg){?>
										<div class="error_msg"><?php echo $errmsg ?></div>
										<?php
								}
								?>
								<span class="titleName globalClr"><?php echo stripslashes($cms_details['cms_title']); ?></span>
								<?php
								$cls = '';
								if($this->uri->segment(1)=='about-us'){
										$cls = 'aboutUsCont';	
										?>
										<span class="titleSubName globalClr">
												<em>HERE'S WHAT MAKES US TICK</em>
										</span>
										<?php
								}
								?>
						</div>
				</div>
				<div class="detailsPanBtm globalClr clearfix">
						<div class="cmsBlock globalClr <?php echo $cls; ?>">
								<!--<h5 class="blockTitle globalClr">Description </h5>-->
								<?php if($this->uri->segment(1)!='contact-us'){ ?>
										<p><?php echo stripslashes($cms_details['cms_content']);?></p>
								<?php } ?>
						</div>
						<?php if($this->uri->segment(1)=='contact-us'){ ?>
								<div class="contactFormSec globalClr clearfix">
										<div class="allForm ltCls">
												<form action="<?php echo FRONTEND_URL.'cms_page/contactAction/contact-us/' ?>" method="post" id="contact_frm" >
														<input type="hidden" name="action" value="process" />
														<div class="filedDiv">
																<label>Name <em class="required">*</em></label>
																<input type="text" name="name" class="inputText requiredInput"/>
														</div>
														<div class="filedDiv">
																<label>Email <em class="required">*</em></label>
																<input type="email" name="email" class="inputText requiredInput emailValid"/>
														</div>
														<div class="filedDiv">
																<label>Telephone</label>
																<input type="text" name="phone_no" class="inputText phoneValid"/>
														</div>
														<div class="filedDiv">
																<label>Message <em class="required">*</em></label>
																<textarea name="message" class="inputTextarea requiredInput" ></textarea>
														</div>
														<div class="filedDiv">
																<input type="submit" name="submit" value="Send" id="contact_submit" class="inputBtn" />
														</div>
												</form>
										</div>
										<div class="contactAddress rtCls">
												<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
												<div id="gmap_canvas" style="height:500px;width:600px;"></div>
												<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
												<script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(-37.81761059999999,144.95531830000004),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-37.81761059999999, 144.95531830000004)});infowindow = new google.maps.InfoWindow({content:"<b>HostelMofo</b><br/>585 Little Collins St, Melbourne<br/>VIC 3000 " });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
										</div>
								</div>
						<?php } ?>
				</div>
		</div>
</div>