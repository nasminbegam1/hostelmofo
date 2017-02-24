<?php
$get_property_id = $this->uri->segment(3,0);
$get_page = $this->uri->segment(4,0);
?>
<style>
    #rootwizard-custom-circle li{
        margin-left: 17% !important;
    }
    #rootwizard-custom-circle li:first-child{
        margin-left: 2% !important;
    }
</style>
<?php
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
            <li class="<?php if(isset($select_tab) && $select_tab == 'property image' ) echo 'active'; ?>"><a>
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">2. Image</p>

                <p class="description">Provide images</p></a></li>
                
                
            <li class="<?php if(isset($select_tab) && $select_tab == 'floorplan image' ) echo 'active'; ?>"><a>
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">3. Floor Plans Images</p>

                <p class="description">Plans images</p></a></li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'active'; ?>">
            
                <a>
               <i class="glyphicon glyphicon-send"></i>

                <p class="anchor">4. Contact</p>

                <p class="description">Contact details</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'edit_map_location' ) echo 'active'; ?>"> <a>
            <i class="fa fa-globe"></i>

            <p class="anchor">5. Map location</p>

            <p class="description">put location</p></a></li>
        </ul>
    </div>
</div>
<div id="bar" class="progress active">
    <div class="bar progress-bar progress-bar-primary" <?php if($this->router->method=='property_image'){ echo 'style="width:29%;"'; } ?>></div></div>
<?php
 }
 else
 {
    ?>
    <div class="navbar">
    <div class="navbar-inner">
        <ul>
            <li <?php if(isset($select_tab) && $select_tab == 'edit property' ) echo 'active'; ?>>
                <a href="#tab1-wizard-custom-circle redirec-tab" rel="<?php echo base_url().'property_sales/edit_property/'.$get_property_id.'/'.$get_page; ?>" data-toggle="tab">
                <i class="glyphicon glyphicon-home"></i>
 
                <p class="anchor">1. Details</p>

                <p class="description">Set up details</p>
                </a></li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'property image' ) echo 'active'; ?>"><a href="#tab2-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_sales/property_image/'.$get_property_id.'/'.$get_page; ?>">
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">2. Image</p>

                <p class="description">Provide images</p></a></li>
                
            <li class="<?php if(isset($select_tab) && $select_tab == 'floorplan image' ) echo 'active'; ?>"><a href="#tab3-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_sales/floorplan_image/'.$get_property_id.'/'.$get_page; ?>" >
            <i class="glyphicon glyphicon-picture"></i>

                <p class="anchor">3. Floor Plans Images</p>

                <p class="description">Plans images</p></a></li>
            
            <li class="<?php if(isset($select_tab) && $select_tab == 'contact' ) echo 'active'; ?>">
            
                <a  href="#tab4-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_sales/contact/'.$get_property_id.'/'.$get_page; ?>" >
               <i class="glyphicon glyphicon-send"></i>

                <p class="anchor">4. Contact</p>

                <p class="description">Contact details</p></a>
            </li>
            <li class="<?php if(isset($select_tab) && $select_tab == 'edit_map_location' ) echo 'active'; ?>"> <a href="#tab5-wizard-custom-circle" data-toggle="tab" rel="<?php echo base_url().'property_sales/edit_map_location/'.$get_property_id.'/'.$get_page; ?>">
            <i class="fa fa-globe"></i>

            <p class="anchor">5. Map location</p>

            <p class="description">put location</p></a></li>
        </ul>
    </div>
</div>
<div id="bar" class="progress active">
    <div class="bar progress-bar progress-bar-primary" <?php if($this->router->method=='property_image'){ echo 'style="width:29%;"'; } ?>></div></div>
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