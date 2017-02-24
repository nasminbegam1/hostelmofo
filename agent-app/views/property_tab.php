<?php
$get_property_id = $this->uri->segment(3,0);
$get_page = $this->uri->segment(4,0);

 if($get_property_id)
 {
   // echo $select_tab;
?>

                                        <div class="property-bred">
                                        <div class="property-bred-inner">
                                            <ul>
							    <li <?php if(isset($select_tab) && $select_tab == 'details' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/edit/'.$get_property_id.'/'.$get_page; ?>" >
								<span>Contact Details</span>
								</a>
							    </li>
                                                                
							    <li <?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editcontactaction/'.$get_property_id.'/'.$get_page; ?>" >
	    
								<span>Microsite Content</span>
								</a>
							    </li>
                                                                
							    <li <?php if(isset($select_tab) && $select_tab == 'basic' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editbasicaction/'.$get_property_id.'/'.$get_page; ?>" >
	    
								<span>Basic Info</span>
								</a>
							    </li>
							    
							     <li <?php if(isset($select_tab) && $select_tab == 'price' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editpriceaction/'.$get_property_id.'/'.$get_page; ?>" >
	    
								<span>Price</span>
								</a>
							    </li>
							    
							    
							    <li <?php if(isset($select_tab) && $select_tab == 'facilities' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editfacilitiesaction/'.$get_property_id.'/'.$get_page; ?>" >
	    
								<span>Facilities & Policies</SPAN>
								</a>
							    </li>
							    <li <?php if(isset($select_tab) && $select_tab == 'photo' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editimageaction/'.$get_property_id.'/'.$get_page; ?>" >
	    
								<span>Photo & Video</span>
								</a>
							    </li>
							    
							    <li <?php if(isset($select_tab) && $select_tab == 'contract' ) echo 'class=active'; ?>>
								<a data-toggle="tab" rel="<?php echo base_url().'property/editcontract/'.$get_property_id.'/'.$get_page; ?>" >
								<span>Contract</span>
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

<div class="blueRow">
<span class="oval"><i class="fa fa-wrench"></i></span>

</div>





<script>
    var property_id = <?php echo $get_property_id; ?>;
    $('.property-bred-inner ul li a').click(function(){
        var url = $(this).prop('rel');
        window.location = url;
    });
</script>