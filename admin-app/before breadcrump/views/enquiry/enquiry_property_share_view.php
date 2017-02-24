<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">

                    <li><a href="#"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Property Share</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><a href="<?php echo $view_link;?>">View Property Share</a></li>
                </ol>
                <div class="clearfix"></div>
</div>



<div class="page-content">
<div id="form-layouts" class="row">
                    <div class="col-lg-12">
                    <div class="note note-info"><h4 class="box-heading">View Share Property</h4>

                           <!-- <p>Please resize browser to see tab version on Tablet & Mobile</p>-->
                    </div>
                    </div>
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
                                            <div class="panel-heading">View Share Property</div>
                                            <div class="panel-body pan">
                                                <form action="#" class="form-horizontal form-bordered">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Enquired by</b></h5></label>

                                                            <div class="col-md-4">
                                                                
                                                               <h5><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_sender_name']); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLastName" class="col-md-3 control-label"><h5><b>Sender Email</b></h5></label>

                                                            <div class="col-md-4">
                                                                <h5><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_sender_email']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLocation" class="col-md-3 control-label"><h5><b>Location</b></h5></label>

                                                            <div class="col-md-4">
                                                               <h5><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_property_location']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="selCountry" class="col-md-3 control-label"><h5><b>Country</b></h5></label>

                                                            <div class="col-md-9">
                                                                <h5><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_ip_country']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputProperty" class="col-md-3 control-label"><h5><b>Property Name</b></h5></label>

                                                            <div class="col-md-6">
                                                                <h5><i class="fa fa-home"></i>&nbsp;&nbsp; <?php if(trim($enquiryDetails['sf_property_name']) != '') { ?>
			      <a href="<?php if($enquiryDetails['sales_rentals'] == "Sales") { echo FRONTEND_URL.'property-sales/'.$enquiryDetails['property_slug'].'/'; } else if($enquiryDetails['sales_rentals'] == "Rental") { echo FRONTEND_URL.'property-rentals/'.$enquiryDetails['property_slug'].'/'; } ?>" target="_blank">
				<?php echo stripslashes($enquiryDetails['sf_property_name']);?>
			      </a>
			      <?php } else { echo 'N.A.'; }?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label"><h5><b>Receiver Email</b></h5></label>

                                                            <div class="col-md-4">
                                                                
                                                                <h5><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_receiver_email']);?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLastName" class="col-md-3 control-label"><h5><b>Receive From</b></h5></label>

                                                            <div class="col-md-9">
                                                                
                                                                <h5><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sales_rentals']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputInfo" class="col-md-3 control-label"><h5><b>Enquiry message</b></h5></label>

                                                            <div class="col-md-9">
                                                                
                                                                <h5><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_message']);?></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-md-3 control-label"><h5><b>Added On</b></h5></label>

                                                            <div class="col-md-4">
                                                                 <h5><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo stripslashes($enquiryDetails['sf_updated_on']);?></h5>
                                                            </div>
                                                        </div>
						        
							
							
						     <div class="form-actions text-right pal">
                                                        <!--<button type="submit" class="btn btn-primary">Submit</button>
                                                        &nbsp;-->
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
                                                    </div>

							
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