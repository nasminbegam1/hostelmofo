<div class="property-bred">
<div class="property-bred-inner">
    <ul>
	<li <?php if(isset($select_tab) && $select_tab == 'roomList' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'room_details/index/'.$property_id; ?>" >
	    <span>Room Type List</span>
	    </a>
	</li>
	    
	<li <?php if(isset($select_tab) && $select_tab == 'aditList' ) echo 'class=active'; ?>>
	    <a data-toggle="tab" rel="<?php echo base_url().'room_details/add/'.$property_id; ?>" >
	    <span>Add Room Type</span>
	    </a>
	</li>
	
    </ul>
</div>
</div>
<div class="blueRow">
<span class="oval"><i class="fa fa-bed"></i></span>

</div>
<script>
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>