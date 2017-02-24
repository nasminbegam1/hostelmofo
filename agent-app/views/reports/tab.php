<div class="property-bred">
<div class="property-bred-inner">
    <ul>
	<li <?php if(isset($select_tab) && $select_tab == 'sales' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'reports/sales/'.$property_id; ?>">
	    <span>Sales</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'customerAnalysis' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'reports/customer_analysis/'.$property_id; ?>">
	    <span>Customer Analysis</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'bookingAnalysis' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'reports/booking_analysis/'.$property_id; ?>">
	    <span>Booking Analysis</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'reportList' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'reports/customer_rating/'.$property_id; ?>" >
	    <span>Customer Ratings</span>
	    </a>
	</li>
	<li <?php if(isset($select_tab) && $select_tab == 'elevateAnalysis' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'reports/elevate_reporting/'.$property_id; ?>">
	    <span>Elevate Reporting</span>
	    </a>
	</li>
    </ul>
</div>
</div>
<div class="blueRow">
<span class="oval"><i class="fa fa-file-text"></i></span>
</div>
<script>
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>