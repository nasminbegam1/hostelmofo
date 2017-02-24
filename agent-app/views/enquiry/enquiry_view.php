    <div class="page-content">                
    <!-- Start : main content loads from here -->    
    <h3 class="page-title">View Enquiry</h3>
    <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>	
    <div class="portlet light">
    	<div class="row">
	    <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            
				<div class="col-sm-12">
				   <label for="property_name" class="col-sm-3 control-label"><b>Enquired by</b></label>
				
				   <div class="col-sm-9">
					    <?php echo stripslashes($enquiryDetails['contact_name']); ?>
						
				   </div>
				</div>
				<br/><br/>
                           <div class="col-sm-12">
                              
				<label  class="col-md-3 control-label" ><b>Email</b></label>
				
                                <div class="col-md-9"><?php echo stripslashes($enquiryDetails['email_address']);?></div>
                            </div>
			    <br/><br/>
                              <div class="col-sm-12">

                                <label class="col-md-3 control-label"  ><b>Ip Address</b></label>
                                <div class="col-md-9"><?php echo stripslashes($enquiryDetails['ip_address']);?></div>
			     </div>
			     <br/><br/>
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label"  ><b>Location</b></label>
                               <div class="col-md-9"><?php echo stripslashes($enquiryDetails['location']);?></div>
			     </div>
			     <br/><br/>
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Country</b></label>
                               <div class="col-md-9"><?php echo stripslashes($enquiryDetails['country']);?></div>
			     </div>
			    <br/><br/>
			     <div class="col-sm-12">
				<label class="col-md-3 control-label" ><b>Phone</b></label>
                                 <div class="col-md-9"><?php echo ($enquiryDetails['phone'] != '') ? $enquiryDetails['phone'] : 'N.A.';?></div>
			     </div>
			     <br/><br/>
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Property Name</b></label>
                                <div class="col-md-9"><u><a href="<?php echo  FRONTEND_URL.'preview-property/'.$enquiryDetails['property_slug'].'/'.$enquiryDetails['province_slug'].'/'.$enquiryDetails['city_seo_slug'].'/'.$enquiryDetails['property_slug']; ?>" target="_blank" title="Click to view property details"><?php echo stripslashes($enquiryDetails['property_name']);?></a></u> </div>
			     </div>
			    <br/><br/>
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Enquiry message</b></label>
                                 <div class="col-md-9"><?php echo stripslashes($enquiryDetails['notes']);?></div>
			     </div>
			     <br/><br/><br/>
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Check In</b></label>
				 <div class="col-md-9">
                               <?php
			       if(strtotime($enquiryDetails['check_in_time'])<0)
			       {
				echo "N/A";
			       }
			       else
			       {
			       echo @date('d/m/Y', strtotime($enquiryDetails['check_in_time']));
			       }
			       ?>
				 </div>
			     </div>
			     <br/><br/>
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Check Out</b></label>
				 <div class="col-md-9">
				<?php
			       if(strtotime($enquiryDetails['check_out_time'])<0)
			       {
				echo "N/A";
			       }
			       else
			       {
			       echo @date('d/m/Y', strtotime($enquiryDetails['check_out_time']));
			       }
			       ?>
				 </div>
			     </div>
			   <br/><br/>
			     
			    
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Added on</b></label>
				 <div class="col-md-9"><?php echo  @date('d/m/Y H:i:s', strtotime($enquiryDetails['updated_on']));?>
				<br /> <?php echo  @date('d/m/Y H:i:s');?>
				 </div>
                            </div>
			      
			     		    			    
			    
                        </form>
		    
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
</div>