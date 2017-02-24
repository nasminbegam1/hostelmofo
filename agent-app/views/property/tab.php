<?php
$get_property_id = $this->uri->segment(3,0);
$get_page = $this->uri->segment(4,0);

 if(!$get_property_id){  // Add form
   
?>
<div class="navbar">
    <div class="navbar-inner">
        <ul>
            <li <?php if(isset($select_tab) && $select_tab == 'details' ) echo 'active'; ?>>
                <a href="#tab1-wizard-custom-circle redirec-tab" rel="" data-toggle="tab">
                <i class="glyphicon glyphicon-home"></i>
 
                <p class="anchor">1. Details</p>

                <p class="description">Set up details</p>
                </a></li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'property price' ) echo 'active'; ?>">
            <a>
            <i class="fa fa-money"></i>

                <p class="anchor">2.  Price</p>

                <p class="description">Provide Price</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'property image' ) echo 'active'; ?>">
            <a>
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">3.  Image</p>

                <p class="description">Provide images</p></a>
            </li>
                
            <li class="<?php if(isset($select_tab) && $select_tab == 'availability' ) echo 'active'; ?>">
            <a>
            <i class="glyphicon glyphicon-eye-open"></i>

                <p class="anchor">4. Availability</p>

                <p class="description">Plans availability</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'booking' ) echo 'active'; ?>">
            <a>
            <i class="fa fa-bookmark"></i>

                <p class="anchor">5. Booking</p>

                <p class="description">Booking Info</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'active'; ?>">
            
                <a>
               <i class="glyphicon glyphicon-send"></i>

                <p class="anchor">6. Contact</p>

                <p class="description">Contact details</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'edit_map_location' ) echo 'active'; ?>">
            <a>
                <i class="fa fa-globe"></i>
    
                <p class="anchor">7. Map</p>
    
                <p class="description">put location</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'calendar_view' ) echo 'active'; ?>">
            <a>
                <i class="fa fa-calendar"></i>
    
                <p class="anchor">8. Calendar</p>
    
                <p class="description">Availability Dates</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'deal' ) echo 'active'; ?>">
            <a>
                <i class="fa fa-bookmark"></i>
    
                <p class="anchor">9. Deal</p>
    
                <p class="description">Enter Deal</p></a>
            </li>

        </ul>
    </div>
</div>
<div id="bar" class="progress active">
    <div class="bar progress-bar progress-bar-primary" <?php if($this->router->method=='price'){ echo 'style="width:29%;"'; } ?>></div>
</div>
<?php
 }
 else
 {
    ?>
   <div class="navbar">
    <div class="navbar-inner">
        <ul>
            <li <?php if(isset($select_tab) && $select_tab == 'details' ) echo 'active'; ?>>
                <a href="#tab1-wizard-custom-circle redirec-tab" rel="<?php echo base_url().'property_rental/edit_rentalproperty/'.$get_property_id.'/'.$get_page; ?>" data-toggle="tab">
                <i class="glyphicon glyphicon-home"></i>
 
                <p class="anchor">1. Details</p>

                <p class="description">Set up details</p>
                </a></li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'property price' ) echo 'active'; ?>">
            <a href="#tab2-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/price/'.$get_property_id.'/'.$get_page; ?>">
            <i class="fa fa-money"></i>

                <p class="anchor">2.  Price</p>

                <p class="description">Provide Price</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'property image' ) echo 'active'; ?>">
            <a href="#tab2-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/images/'.$get_property_id.'/'.$get_page; ?>">
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">3.  Image</p>

                <p class="description">Provide images</p></a>
            </li>
                
            <li class="<?php if(isset($select_tab) && $select_tab == 'availability' ) echo 'active'; ?>">
            <a href="#tab3-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/ical/'.$get_property_id.'/'.$get_page; ?>" >
            <i class="glyphicon glyphicon-eye-open"></i>

                <p class="anchor">4. Availability</p>

                <p class="description">Plans availability</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'booking' ) echo 'active'; ?>">
            <a href="#tab3-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/payment/'.$get_property_id.'/'.$get_page; ?>" >
            <i class="fa fa-bookmark"></i>

                <p class="anchor">5. Booking</p>

                <p class="description">Booking Info</p></a>
            </li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'active'; ?>">
            
                <a  href="#tab4-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/contact/'.$get_property_id.'/'.$get_page; ?>" >
               <i class="glyphicon glyphicon-send"></i>

                <p class="anchor">6. Contact</p>

                <p class="description">Contact details</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'edit_map_location' ) echo 'active'; ?>">
            <a href="#tab5-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/edit_map_location/'.$get_property_id.'/'.$get_page; ?>">
                <i class="fa fa-globe"></i>
    
                <p class="anchor">7. Map</p>
    
                <p class="description">put location</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'calendar_view' ) echo 'active'; ?>">
            <a href="#tab5-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/calendar_view/'.$get_property_id.'/'.$get_page; ?>">
                <i class="fa fa-calendar"></i>
    
                <p class="anchor">8. Calendar </p>
    
                <p class="description">Availability Dates</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'deal' ) echo 'active'; ?>">
            <a href="#tab5-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_rental/deal/'.$get_property_id.'/'.$get_page; ?>">
                <i class="fa fa-bookmark"></i>
    
                <p class="anchor">9. Deal</p>
    
                <p class="description">Enter Deal</p></a>
            </li>
        </ul>
    </div>
</div>
<div id="bar" class="progress active">
    <div class="bar progress-bar progress-bar-primary" <?php if($this->router->method=='price'){ echo 'style="width:29%;"'; } ?>></div>
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