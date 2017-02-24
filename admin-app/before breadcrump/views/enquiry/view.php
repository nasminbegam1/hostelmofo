<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                   <!-- <div class="page-title">View Enquiry</div>-->
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <!--<li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
                    <li><a href="#"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Enquiry</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><a href="<?php echo $view_link;?>">View Enquiry</a></li>
                </ol>
                <div class="clearfix"></div>
</div>



<div class="page-content">
<div id="form-layouts" class="row">
                    <div class="col-lg-12">
                                
                                
                        
                         
                                
                    <div class="note note-info"><h4 class="box-heading">View Enquiry</h4>

                           <!-- <p>Please resize browser to see tab version on Tablet & Mobile</p>-->
                    </div>
                    </div>
                    <!--<div class="form-actions text-right pal">       
                <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
                </div> -->
                    <div class="col-lg-12">
                             
                        <!--<ul class="nav ul-edit nav-tabs responsive">
                            <li class="active"><a href="#tab-form-actions" data-toggle="tab">Form Actions</a></li>
                            <li><a href="#tab-two-columns" data-toggle="tab">2 Columns</a></li>
                            <li><a href="#tab-two-columns-horizontal" data-toggle="tab">2 Columns Horizontal</a></li>
                            <li><a href="#tab-two-columns-readonly" data-toggle="tab">2 Columns Readonly</a></li>
                            <li><a href="#tab-form-seperated" data-toggle="tab">Form Seperated</a></li>
                            <li><a href="#tab-form-bordered" data-toggle="tab">Form Bordered</a></li>
                        </ul>-->
                

<div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            <div id="tab-form-bordered" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-lg-12">
                                             
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">View Enquiry</div>
                                            <div class="panel-body pan">
                                                <form action="#" class="form-horizontal form-bordered">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Enquired by</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                               <h5><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['contact_name']); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLastName" class="col-md-3 control-label"><h5><b>Email</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['email_address']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail" class="col-md-3 control-label"><h5><b>Ip Address</b></h5></label>

                                                            <div class="col-md-8">
                                                               <h5><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['ip_address']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="selGender" class="col-md-3 control-label"><h5><b>Location</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['location']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputBirthday" class="col-md-3 control-label"><h5><b>Country</b></h5></label>

                                                            <div class="col-md-8">
                                                                <h5><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['country']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputPhone" class="col-md-3 control-label"><h5><b>Phone</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><i class="fa fa-phone-square"></i>&nbsp;&nbsp;<?php echo ($enquiryDetails['phone'] != '') ? $enquiryDetails['phone'] : 'N.A.';?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress1" class="col-md-3 control-label"><h5><b>Property Name</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['property_name']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress2" class="col-md-3 control-label"><h5><b>Enquiry type</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><i class="fa fa-info"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sales_rentals']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Receive From</b></h5></label>

                                                            <div class="col-md-8">
                                                                <?php if(stripslashes($enquiryDetails['is_mobile'])=="Yes")
                                                                {
                                                                ?>
                                                                            <h5><i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;<?php echo "Mobile"; ?></h5>
                                                                <?php
                                                                }
                                                                else if(stripslashes($enquiryDetails['is_mobile'])=="No")
                                                                {
                                                                ?>  
                                                                           <h5><i class="fa fa-desktop"></i>&nbsp;&nbsp;<?php  echo "Desktop";?></h5>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputCity" class="col-md-3 control-label"><h5><b>Enquiry message</b></h5></label>

                                                            <div class="col-md-9">
                                                                
                                                                 <h5><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['notes']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <?php if($enquiryDetails['sales_rentals'] == 'Rental') { ?>
                                                        <div class="form-group"><label for="inputPostCode" class="col-md-3 control-label"><h5><b>Guest</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                <h5><i class="fa fa-male"></i>&nbsp;&nbsp;<?php echo $enquiryDetails['guest'] ;?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Check In</b></h5></label>

                                                            <div class="col-md-8">
                                                                
                                                                    <?php
                                                                    if(strtotime($enquiryDetails['check_in_time'])<0)
                                                                    {
                                                                    ?>
                                                                                <h5><?php echo "N/A"; ?></h5>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    
                                                                    <h5><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo @date('d/m/Y', strtotime($enquiryDetails['check_in_time']));?></h5>
                                                                   <?php }
                                                                    ?>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Check Out</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                <?php
                                                                if(strtotime($enquiryDetails['check_out_time'])<0)
                                                                {
                                                                ?>
                                                                        <h5><?php echo "N/A"; ?></h5>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <h5><i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                                                <?php echo @date('d/m/Y', strtotime($enquiryDetails['check_out_time']));?></h5>
                                                                
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Per Night Price</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                               
                                                                <h5><i class="fa fa-money"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['per_night_price']);?></h5>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                        <?php } ?>
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Total Price</b></h5></label>
                                                            
                                                            <div class="col-md-8">
                                                                 <h5><i class="fa fa-money">&nbsp;&nbsp;</i><?php echo stripslashes($enquiryDetails['total_price']);?></h5>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group">
                                                        <label for="selCountry" class="col-md-9 control-label"><h4><b>List of Property visited before submitting enquiry</b></h4></label>
                                                        
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <table  class="table table-bordered table-advanced">
                                                                    <thead>
                                                                    <tr>
                                                                                    <td style="width: 15%;"><b>Property Name</b></td>
                                                                                    <td><b>Property URL</b></td>
                                                                    </tr>
                                                                    </thead>
                                                                    <?php
                                                                    
                                                                     if(!empty($arr_property_search) && count($arr_property_search) > 0) {
                                                                                    foreach($arr_property_search as $property) {
                                                                                       if($property['property_search_flag'] == 'Property') {
                                                                                                    $arr_prop 	= explode("||", $property['property_search_info']); 
                                                                                                    $property_name	= str_replace("Property Name:", "", $arr_prop[1]);
                                                                                                    $property_url	= str_replace("Property URL:", "", $arr_prop[2]);
                                                                    ?>
                                                                    <tbody >
                                                                    <tr>
                                                                                    <td><?php echo $property_name;?></td>
                                                                                    <td><a href="<?php echo $property_url;?>" target="_blank"><?php echo $property_url;?></a></td>
                                                                    </tr>
                                                                    <?php } } } else { ?>
                                                                    <tr><td colspan="2">No recors found</td></tr>
                                                                    </tbody>
                                                                    <?php } ?>
                                                                    
                                                         </table>
                                                       
                                                         </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                        <label for="selCountry" class="col-md-9 control-label"><h4><b>Below is the detail info of Rental search made by the user</b></h4></label>
                                                        
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <table class="table table-bordered table-advanced">
                                                        <thead>
                                                        <tr>
                                                                        <td><b>Location Name</b></td>
                                                                        <td><b>Property Name</b></td>
                                                                        <td><b>Min Price</b></td>
                                                                        <td><b>Max Price</b></td>
                                                                        <td><b>Bedrooms</b></td>
                                                                        <td><b>Guest</b></td>
                                                                        <td><b>Check In</b></td>
                                                                        <td><b>Check Out</b></td>
                                                        </tr>
                                                        </thead>
                                                        <?php
                                                         if(!empty($arr_property_search) && count($arr_property_search) > 0) {
                                                                        foreach($arr_property_search as $property) {
                                                                              if($property['property_search_flag'] == 'Rental Search') {
                                                                                        $rental_prop 	= explode("||", $property['property_search_info']); 									
                                                                                        $location	= str_replace("Location:", "", $rental_prop[0]);
                                                                                        $property_type	= str_replace("Property Type:", "", $rental_prop[1]);
                                                                                        $min_price	= str_replace("Min Price:", "", $rental_prop[2]);
                                                                                        $max_price	= str_replace("Max Price:", "", $rental_prop[3]);
                                                                                        $bedrooms	= str_replace("Bedrooms:", "", $rental_prop[4]);
                                                                                        $guest	        = str_replace("Guest:", "", $rental_prop[5]);
                                                                                        $start_date	= str_replace("Start Date:", "", $rental_prop[6]);
                                                                                        $end_date	= str_replace("End Date:", "", $rental_prop[7]);
                                                        ?>
                                                        <tbody >
                                                        <tr>
                                                                        <td><?php echo ($location != 'N.A.') ? $location : 'ALL Locations';?></td>
                                                                        <td><?php echo $property_type;?></td>
                                                                        <td><?php echo $min_price;?></td>
                                                                        <td><?php echo $max_price;?></td>
                                                                        <td><?php echo $bedrooms;?></td>
                                                                        <td><?php echo $guest;?></td>
                                                                        <td><?php echo $start_date;?></td>
                                                                        <td><?php echo $end_date;?></td>
                                                        </tr>
                                                        </tbody >
                                                        <?php } } } else { ?>
                                                        <tr><td colspan="8">No recors found</td></tr>
                                                        <?php } ?>
                                                    </table>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                    <label for="selCountry" class="col-md-9 control-label"><h4><b>Below is the detail info of Sales search made by the user</b></h4></label>
                                                    <table class="table table-bordered table-advanced">
                                                    <thead>
                                                    <tr>
                                                                
								<td><b>Location Name</b></td>
								<td><b>Property Name</b></td>
								<td><b>Min Price</b></td>
								<td><b>Max Price</b></td>
								<td><b>Bedrooms</b></td>
								<td><b>Bathrooms</b></td>
                                                    </tr>
                                                    </thead>
                                                    <?php
                                                    if(!empty($arr_property_search) && count($arr_property_search) > 0) {
								foreach($arr_property_search as $property) {
								      if($property['property_search_flag'] == 'Sales Search') {
										$sales_prop 	= explode("||", $property['property_search_info']);
                
										$location	= str_replace("Location:", "", $sales_prop[0]);
										$property_type	= str_replace("Property Type:", "", $sales_prop[1]);
										$min_price	= str_replace("Min Price:", "", $sales_prop[2]);
										$max_price	= str_replace("Max Price:", "", $sales_prop[3]);
										$bedrooms	= str_replace("Bedrooms:", "", $sales_prop[4]);
										$bathrooms      = str_replace("Bathrooms:", "", $sales_prop[5]);
						
                                                        ?>
                                                        <tbody >
                                                        <tr>
								<td><?php echo ($location != 'N.A.') ? $location : 'ALL Locations';?></td>
								<td><?php echo $property_type;?></td>
								<td><?php echo $min_price;?></td>
								<td><?php echo $max_price;?></td>
								<td><?php echo $bedrooms;?></td>
								<td><?php echo $bathrooms;?></td>
                                                        </tr>
                                                        </tbody>
                                                        <?php } } } else { ?>
                                                        <tr><td colspan="8">No records found</td></tr>
                                                        <?php } ?>
                                                        </table>
                                                        </div>

                                                        
                                                        
                                                        
                                                    <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Added on</b></h5></label>
                                                                
                                                                <div class="col-md-4">
                                                               
                                                                <h5><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo  @date('d/m/Y H:i:s', strtotime($enquiryDetails['added_on']));?>&nbsp;&nbsp; </h5>
                                                            </div>
                                                    </div>
                                                        
                                                    </div>
                                                    <div class="form-actions text-right pal">
                                                        <!--<button type="submit" class="btn btn-primary">Submit</button>
                                                        &nbsp;-->
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>
                    </div>
</div>
</div>