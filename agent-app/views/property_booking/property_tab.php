<?php
$get_property_id = $this->uri->segment(3,0);


 if($get_property_id)
 {
   // echo $select_tab;
?>

<div class="property-bred">
<div class="property-bred-inner">
    <ul>
		    <li <?php if(isset($select_tab) && $select_tab == 'bookings' ) echo 'class=active'; ?>>
			<a data-toggle="tab" rel="<?php echo base_url().'propertybooking/bookings/'.$get_property_id.'/'; ?>" ><i class="fa fa-home"></i>
			<span>Bookings</span>
			</a>
		    </li>
			
		    <li <?php if(isset($select_tab) && $select_tab == 'cancelled' ) echo 'class=active'; ?>>
			<a data-toggle="tab" rel="<?php echo base_url().'propertybooking/cancelled/'.$get_property_id.'/'; ?>" ><i class="fa fa-flag-checkered"></i>

			<span>Cancelled</span>
			</a>
		    </li>
		    <li <?php if(isset($select_tab) && $select_tab == 'arrival' ) echo 'class=active'; ?>>
			<a data-toggle="tab" rel="<?php echo base_url().'propertybooking/arrival/'.$get_property_id.'/'; ?>" ><i class="fa fa-flag-checkered"></i>

			<span>Arrivals</span>
			</a>
		    </li>
			
		    
		  
		</ul>
</div>
</div>
<!--<div id="bar" class="progress active">
<div class="bar progress-bar progress-bar-primary"></div>
</div>-->


<?php
 } 
?>
<script>
    var property_id = <?php echo $get_property_id; ?>;
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>