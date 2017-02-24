<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/rateit.css">
<script type="text/javascript" src="<?php echo BACKEND_URL; ?>js/jquery.reviews.js"></script>
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Review</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">       
       
        <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Reviews</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-question"></i>&nbsp;&nbsp;Listing</a></li>       
        
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

        <div class="page-content">
            <form role="form" id="add_form" class="form-horizontal form-validate" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    
                    <?php if(validation_errors() != FALSE){?>
                    <div align="center">
                        <div class="alert alert-danger">
                            <?php echo validation_errors('<p style="text-align:left;">', '</p>'); ?>
                        
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class="portlet box portlet-blue">
                        <div class="portlet-header">
                            <div class="caption">Customer Details & Review</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                        </div>
                        <div class="portlet-body">                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class="col-md-3 control-label">Name of Guest</label>

                                        <div class="col-md-9"><input type="text" name="guest_name" id="guest_name" placeholder="Enter Name of Guest" class="form-control required"/></div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Traveller Type</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <select name="traveller_type" id="traveller_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                    if(is_array($travellerList) && count($travellerList) > 0){
                                                        for($c=0; $c<count($travellerList); $c++){
                                                    ?>
                                                        <option value="<?php echo $travellerList[$c]['type_id'];?>"><?php echo stripslashes($travellerList[$c]['type_title']);?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Country of Origin</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <select name="origin_country" id="origin_country" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                    if(is_array($countryList) && count($countryList) > 0){
                                                        for($c=0; $c<count($countryList); $c++){
                                                    ?>
                                                        <option value="<?php echo $countryList[$c]['idCountry'];?>"><?php echo stripslashes($countryList[$c]['countryName']);?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Date of Stay</label>

                                        <div class="col-md-9">                                                    
                                            <div class="input-group datetimepicker-start date mbl">
                                                <input name="stay_date" id="stay_date" class="form-control" type="text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>                                            
                                        </div>
                                    </div>                                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label class="col-md-3 control-label">Title</label>

                                        <div class="col-md-9"><input type="text" name="review_title" id="review_title" placeholder="Enter Review Title" class="form-control required"/></div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Review</label>

                                        <div class="col-md-9"><textarea name="review_content" id="review_content" rows="3" class="form-control required"></textarea></div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Photo</label>

                                        <div class="col-md-9">
                                            <div class="input-icon right"><input name="review_photo" id="review_photo" type="file"/>

                                            <p class="help-block">some help text here.</p></div>
                                        </div>
                                    </div>
                                </div>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet box portlet-blue">
                        <div class="portlet-header">
                            <div class="caption">Metrices</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                        </div>
                        <div class="portlet-body">                                
                            <div class="row">
                                <div class="col-md-6">                                            
                                    <div class="form-group"><label class="col-md-3 control-label">Cleanliness</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <select name="matrix_cleanliness" id="matrix_cleanliness" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                            
                                    <div class="form-group"><label class="col-md-3 control-label">Location</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <select name="matrix_location" id="matrix_location" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-3 control-label">Staff & Service</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <select name="matrix_staff_service" id="matrix_staff_service" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label class="col-md-4 control-label">Comfort</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <select name="matrix_comfort" id="matrix_comfort" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                            
                                    <div class="form-group"><label class="col-md-4 control-label">Facilities</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <select name="matrix_facilities" id="matrix_facilities" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label">Value for Money</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <select name="matrix_value_money" id="matrix_value_money" class="form-control calcOverallRating required">
                                                    <option value="">Select</option>
                                                    <?php for($i = 0.5; $i <= 5; $i = $i+0.5){?>
                                                    <option value="<?php echo number_format($i, 1);?>"><?php echo number_format($i, 1);?></option>
                                                    <?php } ?>                                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                            
                                </div>                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet box portlet-blue">
                        <div class="portlet-header">
                            <div class="caption">Overall Rating</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                        </div>
                        <div class="portlet-body">                                
                            <div class="row">
                                <div class="col-md-4">                                            
                                    <div class="form-group"><label class="col-md-3 control-label">Score</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" name="review_score" id="review_score" readonly="readonly" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"><label id="rateTxt" class="col-md-6 control-label"></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="starRating">
                                                    <span id="ratePercent" class="starBack" style="width:0%;"></span>
                                                    <span class="starFront"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                             
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group"><label class="col-md-3 control-label">Rating</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" name="review_rating" id="review_rating" readonly="readonly" class="form-control"/>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions text-right pal">
                    <input type="hidden" name="action" value="Process">
                    <button type="submit" class="btn btn-primary">Add Review</button>
                    &nbsp;
                    <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
                </div>
            </div>
            </form>
        </div>

<!--END CONTENT-->
<script type="text/javascript">
$(document).ready(function(){
    $('#stay_date').datepicker({		
	dateFormat :"dd/mm/yy"
    });
    $('.calcOverallRating').reviews();
});
</script>