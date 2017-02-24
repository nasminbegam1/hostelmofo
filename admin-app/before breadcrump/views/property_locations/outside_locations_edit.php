<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Outside Location Master</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="javascript:void(0)">
Property Outside Location</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="<?php echo $edit_link;?>" >
Edit Outside Location</a></li>
      
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Outside Location Master</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
							
							<div class="form-group"><label for="location_name" class="col-md-3 control-label">Select Main location<span class='require'></span></label>

                                                            <div class="col-md-8">
                                                              <select name="main_location" class="form-control required">
                                <?php  foreach($locations as $onelocation){
					    if($outsidelocations[0]['location_id']==$onelocation['location_id']) { ?> 
                             		<option value="<?php echo $onelocation['location_id'] ?>" selected="selected"><?php echo $onelocation['location_name'] ?></option>
					<?php } else { ?> 
                             		<option value="<?php echo $onelocation['location_id'] ?>" ><?php echo $onelocation['location_name'] ?></option>
					<?php }
					} ?>
                                </select>	  
                                                                
                                                            </div>
                                                        </div>
							
                                                        <div class="form-group"><label for="location1_title" class="col-md-3 control-label">Locations1 title<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control required" name="location1_title" id="location1_title" value="<?php echo stripslashes($outsidelocations[0]['title1']);  ?>" data-required="true">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="location1_description" class="col-md-3 control-label">Location1 description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <textarea name="location1_description" id="count-textarea1" rows="7" cols="60" class="form-control required" data-required="true"><?php echo stripslashes($outsidelocations[0]['content1']);  ?></textarea>
				<span id="countexact1">0</span><span>/350</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="location1_link" class="col-md-3 control-label">Location1 link<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <div class="input-icon"><i class=""></i>
                                                                    <input type="url" class="form-control required" name="location1_link" id="location1_link" value="<?php echo stripslashes($outsidelocations[0]['link1']);  ?> " data-required="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <div class="form-group"><label for="location1Image" class="col-md-3 control-label">Upload location  Image1<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                 <input type="file" name="location1Image" id="location1Image" /><br\><b>[image size required 225 X 150| extension must be .jpg or .jpeg or .gif or .png]</b>                   
                            
                            	<div id="displayFilePhotos">
				    <?php if( !empty($outsidelocations[0]['image1']) ){ ?>
					<img width="225" height="150" src="<?php echo FILE_UPLOAD_URL.'outsidelocation/'.$outsidelocations[0]['image1'] ?>" />
				    <?php } ?>
				</div>	
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="location2_title" class="col-md-3 control-label">Locations2  title <span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                  <input type="text" class="form-control required" name="location2_title" id="location2_title" value="<?php echo stripslashes($outsidelocations[0]['title2']);  ?>" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location2_description" class="col-md-3 control-label">Location2 description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                  <textarea name="location2_description" id="count-textarea2" rows="7" cols="60" class="form-control required" data-required="true"><?php echo stripslashes($outsidelocations[0]['content2']);  ?></textarea>
				<span id="countexact2">0</span><span>/350</span>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location2_link" class="col-md-3 control-label">Location2 link<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                  <input type="url" class="form-control required" name="location2_link" id="location2_link" value="<?php echo stripslashes($outsidelocations[0]['link2']);  ?>" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location2Image" class="col-md-3 control-label">Upload location  Image2<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                   <input type="file" name="location2Image" id="location2Image" /><br\><b>[image size required 225 X 150| extension must be .jpg or .jpeg or .gif or .png]</b>                  
                            
                            	<div id="displayFilePhotos">
				     <?php if( !empty($outsidelocations[0]['image2']) ){ ?>
					<img width="225" height="150" src="<?php echo FILE_UPLOAD_URL.'outsidelocation/'.$outsidelocations[0]['image2'] ?>" />
				    <?php } ?>
				</div>	
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location3_title" class="col-md-3 control-label">Locations3  title<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                     <input type="text" class="form-control required" name="location3_title" id="location3_title" value="<?php echo stripslashes($outsidelocations[0]['title3']);  ?>" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location3_description" class="col-md-3 control-label">Location3 description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                    <textarea name="location3_description" id="count-textarea3" rows="7" cols="60" class="form-control required" data-required="true"><?php echo stripslashes($outsidelocations[0]['content3']);  ?></textarea>
				<span id="countexact3">0</span><span>/350</span>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location3_link" class="col-md-3 control-label">Location3 link<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                  <input type="url" class="form-control required" name="location3_link" id="location3_link" value="<?php echo stripslashes($outsidelocations[0]['link3']);  ?>" data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location3Image" class="col-md-3 control-label">Upload location  Image3<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="file" name="location3Image" id="location3Image" /><br\><b>[image size required 225 X 150| extension must be .jpg or .jpeg or .gif or .png]</b>                   
                            <div id="displayFilePhotos">
				 <?php if( !empty($outsidelocations[0]['image3']) ){ ?>
					<img width="225" height="150" src="<?php echo FILE_UPLOAD_URL.'outsidelocation/'.$outsidelocations[0]['image3'] ?>" />
				    <?php } ?>
			    </div>			      
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location4_title" class="col-md-3 control-label">Locations4  title<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control required" name="location4_title" id="location4_title" value="<?php echo stripslashes($outsidelocations[0]['title4']);  ?>" data-required="true">
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location4_description" class="col-md-3 control-label">Location4 description<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                <textarea name="location4_description" id="count-textarea4" rows="7" cols="60" class="form-control required" data-required="true"><?php echo stripslashes($outsidelocations[0]['content4']);  ?></textarea>
				<span id="countexact4">0</span><span>/350</span>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location4_link" class="col-md-3 control-label">Location4 link<span class='require'>*</span></label>

                                                            <div class="col-md-8">
                                                                
                                                                <input type="text" class="form-control required" name="location4_link" id="location4_link" value="<?php echo stripslashes($outsidelocations[0]['link4']);  ?> " data-required="true">
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="location4Image" class="col-md-3 control-label">Upload location  Image4<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="location4Image" id="location4Image" /><br\><b>[image size required 225 X 150| extension must be .jpg or .jpeg or .gif or .png]</b>                   
                               <div id="displayFilePhotos">
				 <?php if( !empty($outsidelocations[0]['image4']) ){ ?>
					<img width="225" height="150" src="<?php echo FILE_UPLOAD_URL.'outsidelocation/'.$outsidelocations[0]['image4'] ?>" />
				    <?php } ?>
			       </div>			      
                                                            </div>
                                                        </div>
							
							
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script>
    $(document).ready(function(){
	$('#count-textarea1').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact1').text(len);
	    if(len>349){
		$(this).val(value.substring(0,350));
	    }
	});
	
	$('#count-textarea2').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact2').text(len);
	    if(len>349){
		$(this).val(value.substring(0,350));
	    }
	});
	
	$('#count-textarea3').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact3').text(len);
	    if(len>349){
		$(this).val(value.substring(0,350));
	    }
	});
	
	$('#count-textarea4').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length) ; 
	    $('#countexact4').text(len);
	    if(len>349){
		$(this).val(value.substring(0,350));
	    }
	});	
	
    });
</script>