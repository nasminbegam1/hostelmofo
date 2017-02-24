<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

?>
<!-- ********************************************************************    -->
<h2>Your Feedback</h2>
<h4>Please give your review</h4>
<form action="" method="post" name="frm">
<input type="hidden" name="action" value="save">
<div class="review">
<div class="rating">
    <h4>Value of money</h4>
    <div id="rateit" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Security</h4>
    <div id="rateit1" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Location</h4>
    <div id="rateit2" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Staff</h4>
    <div id="rateit3" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Atmosfhere</h4>
    <div id="rateit4" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Cleaness</h4>
    <div id="rateit5" class="rateit"  data-rateit-value="0"></div>
</div>
<div class="rating">
    <h4>Facilities</h4>
    <div id="rateit6" class="rateit"  data-rateit-value="0"></div>
</div>
</div>
<div class="feedback">
<h4>Comment</h4>
<textarea name="comments"></textarea>
<input type="hidden" name="Value_for_money" value="" id="rating_1">
<input type="hidden" name="Security" value="" id="rating_2"> 
<input type="hidden" name="Location" value="" id="rating_3"> 
<input type="hidden" name="Staff" value="" id="rating_4"> 
<input type="hidden" name="Atmosphere" value="" id="rating_5"> 
<input type="hidden" name="Cleanliness" value="" id="rating_6"> 
<input type="hidden" name="Facilities" value="" id="rating_7"> 
<p><?php echo form_submit('submit', 'submit'); ?></p>
</div>
</form>

<script type="text/javascript">
    $("#rateit").bind('rated', function (event, value) {$('#rating_1').val(value);});
    $("#rateit1").bind('rated', function (event, value) { $('#rating_2').val(value);});
    $("#rateit2").bind('rated', function (event, value) { $('#rating_3').val(value);});
    $("#rateit3").bind('rated', function (event, value) { $('#rating_4').val(value);});
    $("#rateit4").bind('rated', function (event, value) { $('#rating_5').val(value);});
    $("#rateit5").bind('rated', function (event, value) { $('#rating_6').val(value);});
    $("#rateit6").bind('rated', function (event, value) { $('#rating_7').val(value);});
</script>

