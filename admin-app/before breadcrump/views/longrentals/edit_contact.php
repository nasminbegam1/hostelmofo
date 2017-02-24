            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Longterm Property</div>
                </div>
		<ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Longterm Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit &nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
		    <li class="active">Contact</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Contact</div>
                                <div class="tools">
                                   
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                     <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                     <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="tab-content">
                                        <form action="<?php echo BACKEND_URL;?>longrentals/contact/<?php echo $arr_property['property_id'].'/'.$page;?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                                           <!-- <input type="hidden" name="action" value="Process">-->
                                            <!--<input type="hidden" name="property_id" value="<?php// echo  $arr_property['property_id']; ?>">-->
                                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                                           <!------general section start-->
                                          
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-grey portlet box portlet-grey">
                                
                                                <div class="portlet-header">
                                                    <div class="caption">Owner Details</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                </div>
                                                   
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                            

                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="owner_name" class="col-md-2 control-label" >Name </label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-info"></i>
                                                                           <input name="owner_name" id="owner_name" type="text"  class="form-control" value="<?php echo stripslashes( $arr_property['property_manager_name'] )?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="contact_number" class="col-md-2 control-label" >Contact Number </label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-phone"></i>
                                                                           <input data-type="number"  name="contact_number" id="contact_number" type="text"  class="form-control" value="<?php echo stripslashes( $arr_property['manager_contact_number1'] )?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="owner_email" class="col-md-2 control-label" >Email </label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="glyphicon glyphicon-envelope"></i>
                                                                           <input  name="owner_email" id="owner_email" type="text"  class="form-control" value="<?php echo stripslashes( $arr_property['manager_email'] )?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="owner_company" class="col-md-2 control-label" >Comapny Name </label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="glyphicon glyphicon-home"></i>
                                                                           <input  name="owner_company" id="owner_company" type="text"  class="form-control" value="<?php echo stripslashes( $arr_property['property_company_name'] )?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="owner_website" class="col-md-2 control-label" >Website Address </label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                            <i class="fa fa-location-arrow"></i>
                                                                           <input  name="owner_website" id="owner_website" type="text"  class="form-control" value="<?php echo stripslashes( $arr_property['property_website_address'] )?>"/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                                
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>


                                        
                                        <!------general section end-->
                                        
                                        <!------description section start-->
                                        
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-yellow portlet box portlet-violet">
                                                    
                                                    <div class="portlet-header">
                                                    <div class="caption">General Notes</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
                                                              
                                                               
                                                                 
                                                                 <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group"><label for="note" class="col-md-2 control-label" >Notes </label>
                                                                        <div class="col-md-10">
                                                                            
                                                                            <textarea name="note"  class="ckeditor form-control"><?php echo stripslashes($arr_property_rent['notes']);?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------description section end-->
                                       
                                        </div>
                                        
                                        <div class="action text-right">
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'longrentals/edit_property_image/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="submit" name="next" value="Next" class="btn btn-info">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                        </div>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--END CONTENT-->
 
<script>
    
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
</script>
