<?php
$get_property_id = $this->uri->segment(3,0);
$get_page = $this->uri->segment(4,0);

 if($get_property_id)
 {
   // echo $select_tab;
?>

                                        <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
							    <li <?php if(isset($select_tab) && $select_tab == 'details' ) echo 'class=active'; ?>>
								<a href="#tab1-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/edit/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-home"></i>
	    
								<p class="anchor">Details</p>
	    
								<p class="description">Set up basic details</p></a></li>
                                                                
							    <li <?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'class=active'; ?>>
								<a href="#tab2-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/editcontactaction/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-flag-checkered"></i>
	    
								<p class="anchor">Conatct</p>
	    
								<p class="description">Set up contact details</p></a></li>
                                                                
							    <li <?php if(isset($select_tab) && $select_tab == 'basic' ) echo 'class=active'; ?>>
								<a href="#tab3-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/editbasicaction/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-info-circle"></i>
	    
								<p class="anchor">Basic Info</p>
	    
								<p class="description">Set up Basic Info</p></a></li>
							    
							     <li <?php if(isset($select_tab) && $select_tab == 'price' ) echo 'class=active'; ?>>
								<a href="#tab4-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/editpriceaction/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-money"></i>
	    
								<p class="anchor">Price</p>
	    
								<p class="description">Set up price</p></a></li>
							    
							    
							    <li <?php if(isset($select_tab) && $select_tab == 'facilities' ) echo 'class=active'; ?>>
								<a href="#tab5-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/editfacilitiesaction/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-puzzle-piece"></i>
	    
								<p class="anchor">Facilities & Policies</p>
	    
								<p class="description">Set up various Facilities</p></a></li>
							    <li <?php if(isset($select_tab) && $select_tab == 'photo' ) echo 'class=active'; ?>>
								<a href="#tab6-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property/editimageaction/'.$get_property_id.'/'.$get_page; ?>" ><i class="fa fa-picture-o"></i>
	    
								<p class="anchor">Photo & Video</p>
	    
								<p class="description">Upload Photo and video</p></a></li>
							  
							</ul>
                                        </div>
                                    </div>
                                    <div id="bar" class="progress active">
                                        <div class="bar progress-bar progress-bar-primary"></div>
                                    </div>


<?php
 } 
?>
<script>
    var property_id = <?php echo $get_property_id; ?>;
    $('.navbar-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>