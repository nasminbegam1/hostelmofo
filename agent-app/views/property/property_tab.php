<?php
$get_property_id = $this->uri->segment(3,0);
if($get_property_id)
{
?>

    <div class="property-bred">
	<div class="property-bred-inner">
	    <ul>
		<li <?php if(isset($select_tab) && $select_tab == 'details' ) echo 'class=active'; ?>>
		    <a data-toggle="tab" rel="<?php echo base_url().'property/edit/'.$get_property_id; ?>" >
		    <span>Property Details</span>
		    </a>
		</li>
		    
		<li <?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'class=active'; ?>>
		    <a data-toggle="tab" rel="<?php echo base_url().'property/editcontactaction/'.$get_property_id; ?>" >

		    <span>Microsite Content</span>
		    </a>
		</li>
		    
		<li <?php if(isset($select_tab) && $select_tab == 'deals' ) echo 'class=active'; ?>>
		    <a data-toggle="tab" rel="<?php echo base_url().'property/deals/'.$get_property_id; ?>" >

		    <span>Deals</span>
		    </a>
		</li>
	    </ul>

	</div>
    </div>
<?php
 } 
?>
		<!-- <a href="<?php echo FRONTEND_URL;?>booking_details" <?php if(currentClass() == 'booking_details' && currentMethod()=='index'){?>class="active"<?php } ?>>Booked</a> -->
<div class="blueRow">
    <?php if(currentMethod()=='deals' || currentMethod()=='add_deals'){?>
	<div class="blueRowNew">
	<a href="<?php echo base_url().'property/deals/'.$get_property_id; ?>" <?php if(currentClass()=='property'&& currentMethod()=='deals'){?>class= "active"<?php } ?>>List Details</a>
	<a href="<?php echo base_url().'property/add_deals/'.$get_property_id;?>" <?php if(currentClass()=='property'&& currentMethod()=='add_deals'){?>class= "active"<?php } ?>>Create New Deal</a>
    </div>
	<?php } ?>
 <span class="oval"><i class="fa fa-wrench"></i></span>

</div>
<script>
    var property_id = <?php echo $get_property_id; ?>;
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>