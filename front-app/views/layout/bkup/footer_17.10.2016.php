<section class="background footer section" id="section14">
	 <div class="content-wrapper">
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
									<span>585 Little Collins St. Melbourne<br>
										VIC 3000 
									</span>
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
	 </div>
</section>
<script>
   $(document).ready(function(){
      $('.nw_submit').click(function(){alert("fdd");
         var nw_name = $('#nw_name').val();
         var nw_email = $('#nw_email').val();
         var error = 0;
	 
         if(nw_name == ""){
            $('#nw_name').addClass('errBorderLi');
            $("#error_nw_name").html("Name field must be completed!");
            error=1;
         }
         else{
            $("#error_nw_name").html("");
            $('#nw_name').removeClass('errBorderLi');
         }
	 
         if(nw_email == ""){
            $('#nw_email').addClass('errBorderLi');			
            $("#error_nw_email").html("Email Addres field must be completed!");
            error=1;
         }
         else if (ValidateEmail(nw_email)) {
            $('#nw_email').removeClass('errBorderLi');
            $("#error_nw_email").html("");
         }
         else{
            $('#nw_email').addClass('errBorderLi');
            $("#error_nw_email").html("Please Enter Valid Email Address!");
            error=1;
         }
	 
         if (error == 0) {
            $.ajax({
               type:'post',
               url: base_url+'cms_page/newsletter_submit/',
               data: 'nw_name='+nw_name+"&nw_email="+nw_email,
               success:function(msg){ alert(msg);
                  $('#nw_name').val('');
                  $('#nw_email').val('');
                  msg = msg.split('||');
                  if (msg[0] == 'error') {
                     $('#msg').html("<span class='error_msg'>"+msg[1]+"</span>");
                  }
                  else if (msg[0] == 'success') {
                     $('#msg').html("<span class='success_msg'>"+msg[1]+"</span>");
                  }
               }
            });
         }
      });
      
      function ValidateEmail(email) {
         var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
         return expr.test(email);
      };
      
   });
</script>