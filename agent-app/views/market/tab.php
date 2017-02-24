<div class="property-bred">
<div class="property-bred-inner">
    <ul>
	<li <?php if(isset($select_tab) && $select_tab == 'market' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'market/index/'.$property_id; ?>">
	    <span>Elevate</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'customerAnalysis' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'market/booking_engine/'.$property_id; ?>">
	    <span>Booking Engine</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'bookingAnalysis' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'market/featured_listing/'.$property_id; ?>">
	    <span>Featured listing</span>
	    </a>
	</li>
	
    </ul>
</div>
</div>
<div class="blueRow">
<span class="oval"><i class="fa fa-building"></i></span>
</div>
<script>
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>