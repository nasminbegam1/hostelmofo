<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer footer globalClr" role="contentinfo">
			  	<div class="footerTop globalClr">
    	<div class="mainWrap clearfix">
        	<div class="fBox ltCls">
            	<h6>Quick Links</h6>
                <ul>
				<li><a href="<?php echo FRONTEND_URL;?>about-us/">About Us</a></li>
				<li><a href="<?php echo FRONTEND_URL;?>contact-us/">Contact us</a></li>
				<li><a href="<?php echo FRONTEND_URL;?>management/">Management</a></li>
				<li><a href="<?php echo FRONTEND_URL;?>terms-and-conditions/">Terms & Conditions</a></li>
				<li><a href="<?php echo FRONTEND_URL;?>privacy-policy/">Privacy Policy</a></li>         
                </ul>
            </div>
		<?php
		$result = $wpdb->get_results("SELECT sitesettings_name,sitesettings_value FROM hw_sitesettings WHERE sitesettings_id IN (6,9,10,11,15,16,17,18,19)");
		?>
            <div class="fBox ltCls">
            	<h6>follow us</h6>
                <div class="socialIcons globalClr">
		<?php if($result[1]->sitesettings_value != '' && $result[1]->sitesettings_value != '#'){ ?>
				<a title="Facebook" href="<?php echo stripslashes($result[1]->sitesettings_value); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if($result[2]->sitesettings_value != '' && $result[2]->sitesettings_value != '#'){ ?>
				<a title="Twitter" href="<?php echo stripslashes($result[2]->sitesettings_value); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if($result[5]->sitesettings_value != '' && $result[5]->sitesettings_value != '#'){ ?>
		<a title="LinkedIn" href="<?php echo stripslashes($result[5]->sitesettings_value); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		<?php } ?>
		<?php if($result[4]->sitesettings_value != '' && $result[4]->sitesettings_value != '#'){ ?>
		<a title="Google Plus" href="<?php echo stripslashes($result[4]->sitesettings_value); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		<a title="Mail" href="mailto:marketing@hostelmofo.com"><i class="fa fa-envelope"></i></a>
		<?php if($result[8]->sitesettings_value != '' && $result[8]->sitesettings_value != '#'){ ?>
		<a title="Pinterest" href="<?php echo stripslashes($result[8]->sitesettings_value); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a>
		<?php } ?>
		<?php if($result[7]->sitesettings_value != '' && $result[7]->sitesettings_value != '#'){ ?>
		<a title="Myspace" href="<?php echo stripslashes($result[7]->sitesettings_value); ?>" target="_blank"><span><em class="myspace"></em></span></a>
		<?php } ?>
                </div>
            </div>
            <div class="fBox ltCls">
            	<h6>subscribe newsletter</h6>
                <div class="subscribeSec globalClr">
		    <p id="msg"></p>
                    <p><input type="text" value="" id="nw_name" name="nw_name" placeholder="-- Enter Your Name --" /><span class="error_msg" id="error_nw_name"></span></p>
                    <p><input type="text" value="" name="nw_email" id="nw_email" placeholder="-- Enter Your Email --" /><span class="error_msg" id="error_nw_email"></span></p>
                    <p><input type="submit" value="Submit" name="Submit" class="inputBtn nw_submit" /></p>
		    
                </div>		
            </div>
        </div>
    </div>
    <div class="footerBottom globalClr">
    	<div class="mainWrap clearfix">&copy;<?php echo date("Y"); ?> <a href="<?php echo FRONTEND_URL;  ?>"><?php echo stripslashes($result[0]->sitesettings_value); ?></a></div>
    </div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
	<script>
        jQuery(document).ready(function($){
		
		$('.nw_submit').click(function(){
			var nw_name  = $('#nw_name').val();
			var nw_email = $('#nw_email').val(); 
			var error    = 0;
			if(nw_name == ""){
				$('#nw_name').addClass('errBorderLi');
				$("#error_nw_name").html("Name field must be completed!");
				error=1;
			}else{
				$("#error_nw_name").html("");
				$('#nw_name').removeClass('errBorderLi');
			}
			if(nw_email == ""){
				$('#nw_email').addClass('errBorderLi');			
				$("#error_nw_email").html("Email Addres field must be completed!");
				error=1;
			}else if (ValidateEmail(nw_email)) {
				$('#nw_email').removeClass('errBorderLi');
				$("#error_nw_email").html("");
			}else{
				$('#nw_email').addClass('errBorderLi');
				$("#error_nw_email").html("Please Enter Valid Email Address!");
				error=1;
			}
			if (error == 0) {
			$.ajax({
				type:'post',
				//url: base_url+'cms_page/newsletter_submit/',
				url : '<?php echo admin_url('admin-ajax.php');?>',
				data: 'nw_name='+nw_name+"&nw_email="+nw_email+"&action=nwletter",
				success:function(msg){
					$('#nw_name').val('');
					$('#nw_email').val('');
					msg = msg.split('||');
					if (msg[0] == 'error') {
						$('#msg').html("<span class='error_msg'>"+msg[1]+"</span>");
					}else if (msg[0] == 'success') {
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
	 
		//jQuery('#mybtn').click(function(){
		//		jQuery.ajax({
		//				type:'post' url:'<?php echo admin_url(admin_ajax.php);?>',
		//				data:{'field1':'value1','field2':'value2'}
		//				}).done(function(response){
		//				jQuery('.responseArea').html(response);
		//				});
		//		});
		});
	</script>
</body>
</html>