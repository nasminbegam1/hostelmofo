<div class="property-bred">
<div class="property-bred-inner">
    <ul>
	<li <?php if(isset($select_tab) && $select_tab == 'bookings' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'booking_list/bookings/'.$property_id.'/'.$page; ?>" >
	    <span>Bookings</span>
	    </a>
	</li>
	    
	<li <?php if(isset($select_tab) && $select_tab == 'cancelled' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'booking_list/cancelled/'.$property_id.'/'.$page; ?>" >
	    <span>Cancelled</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'arrival' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'booking_list/arrival/'.$property_id.'/'.$page; ?>" >

	    <span>Arrivals</span>
	    </a>
	</li>
    </ul>
</div>
</div>
<div class="blueRow">
<span class="oval"><i class="fa fa-users"></i></span>

</div>
<script>
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>