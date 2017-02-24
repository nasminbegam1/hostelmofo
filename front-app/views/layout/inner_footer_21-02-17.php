<footer class="footer" >
      <div class="footTp">
      <div class="MainCon clearfix">
      <div class="footBox">
      <h4>Quick links</h4>
      <div class="footIn">
      <ul>
						<li><a href="<?php echo FRONTEND_URL; ?>about-us/">about us</a></li>
						<li><a href="<?php echo FRONTEND_URL; ?>contact-us/">Contact us</a></li>
						<li><a href="<?php echo FRONTEND_URL; ?>terms-and-conditions/">Terms & Conditions</a></li>
						<li><a href="<?php echo FRONTEND_URL; ?>privacy-policy/">Privacy Policy</a></li>
					</ul>
      </div>
      </div>
      <div class="footBox">
				<h4>Contact us</h4>
					<div class="footIn">
						<span>585 Little Collins St. Melbourne<br>VIC 3000</span>
						<?php if(isset($contact_no) && $contact_no != ''){ ?>
						<span>Phone: <a href="tel:<?php echo $contact_no; ?>"><?php echo $contact_no; ?></a></span>
						<?php } ?>
					</div>
			</div>
      <div class="footBox">
				<h4>Follow Us</h4>
					<div class="footIn">
						<ul>
							<li>
								  <?php
								  if($social_links['facebook_link'] && $social_links['facebook_link'] != '#' ){?>
										<a target="_blank" href="<?php echo $social_links['facebook_link']; ?>" title="Facebook">Facebook</a>
										<?php
								  }
								  ?>
							</li>
							<li>
								  <?php
								  if($social_links['twitter_link'] && $social_links['twitter_link'] != '#' ){?>
										<a target="_blank" href="<?php echo $social_links['twitter_link']; ?>" title="Twitter">Twitter</a>
										<?php
								  }
								  ?>
							</li>
							<li><a href="#">instagram</a></li>
							<li>
								  <?php
								  if($social_links['pinterest_link'] && $social_links['pinterest_link'] != '#' ){?>
										<a target="_blank" href="<?php echo $social_links['pinterest_link']; ?>" title="Pinterest">pinterest</a>
										<?php
								  }
								  ?>
							</li>
						</ul>
					</div>
				</div>
      <div class="footBox">
      <h4>Join with us</h4>
      <div class="footIn">
      <form id="join_form" action="#" method="POST">
								<input type="text" value="" name="name" placeholder="Name">
								<input type="text" value="" name="email" placeholder="Email">
								<textarea placeholder="Message" class="textArea" name="message"></textarea>
								<input type="submit" name="send" value="Submit">
										<div id="email_res"></div>
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
      
      <div off-canvas="slidebar-2 right shift">
         <ul class="sideNav">
            <li><a href="<?php echo FRONTEND_URL;?>">Home</a></li>
            <li><a href="#">Hostel</a></li>
            <li><a href="#">Working Hostel</a></li>
            <li><a href="#">Hotel</a></li>
            <li><a href="#">Camping</a></li>
            <li><a href="#">Blog</a></li>
         </ul>
      </div>
      <script src="<?php echo FRONT_JS_PATH;?>jquery-ui.js"></script>
			<script src="<?php echo FRONT_JS_PATH;?>slidebars.js"></script>
      <script src="<?php echo FRONT_JS_PATH;?>scripts-menu.js"></script>
		
      <script src="<?php echo FRONT_JS_PATH;?>jquery.counterup.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 
      <script type="text/javascript" src="<?php echo FRONT_JS_PATH;?>jquery.pagepiling.js"></script>
      <script src="<?php echo FRONT_JS_PATH;?>owl.carousel.min.js"></script>
      <script src="<?php echo FRONT_JS_PATH;?>easyResponsiveTabs.js" type="text/javascript"></script>
			<script src="<?php echo FRONT_JS_PATH;?>jquery.validate.min.js"></script>
		
			<script src="<?php echo FRONT_JS_PATH;?>jquery.prettyPhoto.js" type="text/javascript"></script>
      <script src="<?php echo FRONT_JS_PATH;?>script.js"></script>
  