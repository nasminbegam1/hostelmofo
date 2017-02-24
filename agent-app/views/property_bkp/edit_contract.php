 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <div class="page-content">
 <h3 class="page-title"> Property Edit</h3>
 <!--For breadcrump-->    
  <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
  <!--For breadcrump end-->
    <div class="clearfix"></div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="portlet light">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <?php if($errmsg){?>
                                        <div align="center">
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet" >
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Property Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
					
                                            <div class="portlet-body panel-body pan">
                                            <div class="contract_section">
					    <form action="<?php echo AGENT_URL.'property/editcontract/'.$property_details['property_master']['property_master_id'] ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
					    <input type="hidden" name="property_master_id" value="<?php echo $property_details['property_master']['property_master_id'] ; ?>" />
					    <input type="hidden" name="action" value="contract"/>
				    <!------ tab start-------->
				    <?=$tabs?>
				    <!------ tab end --------->
				    <div class="formPreLoader" style="">
					    <div class="imgLoaderDiv">
					         <img class="loader"   id="" src="<?php echo BACKEND_URL
						 ."vendors/pageloader/images/loader7.GIF" ?>" />
					    </div>
				    </div>
                                    <div class="tab-content">
					
					<!------- video section start ---->
					<a href="javascript:void(0);" onclick="printDiv()" class="print"> <i class="fa fa-print"></i>Print</a>
                                        <div id="tab6-wizard-custom-circle" class="tab-pane fadeIn active">
					    <h3 class="mbxl">Contract Form</h3>
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label ">Name of Property</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon spanbox"><?php echo stripslashes($property_details['property_master']['property_name']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Address of Property</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_details']['address']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Property Type</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_master']['property_name']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>

						
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">No of Bedrooms</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_master']['bedrooms']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Total Beds</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_master']['beds']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Effect Dates</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Signed and on behalf of License</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Name (Firstname, Lastname)</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_details']['licensee_name']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>

						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Email address</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_details']['licensee_email']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Licensees Email address for contracts</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"><?php echo stripslashes($property_details['property_details']['licensee_email2']) ?></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <label for="property_video_link" class="col-sm-3 control-label">Signed Date</label>
						    <div class="col-md-9">
							<div class="input-group">						    
							    <span class="input-group-addon"></span>							    
							</div>
						    </div>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						    <?php echo stripslashes($contract_info);?>
						    </div>
						</div>
						
						<div class="col-sm-12">
						    <div class="form-group">
						   <input type="checkbox" id="contract_term" name="contract_term" value="Yes" <?php if($property_details['property_master']['accept_contract'] == 'Yes') echo "checked";?>> I have read and understood the Contract Terms.
						    </div>
						</div>


					</div>
				       
				<div class="action text-right">
                                            <a href="<?php echo base_url().'property/editimageaction/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>"><button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button></a>
					    
					    <button type="submit" name="save_now" value="Save Now" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
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
        </div>
        </div>

        
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
    
    $('.featured_image').click(function(){
	
	var img_id = $(this).val();
	var property_id = $(this).attr('data-property-id');
	var element = $(this);
	$.ajax({
	    type:'POST',
	    url:'<?php echo BACKEND_URL."property/is_feature";?>',
	    data:{img_id:img_id,property_id:property_id},
	    success:function(msg){
		$(element).parents('tbody').find('tr').removeClass('note-danger');
		$(element).parents('tbody').find('tr').addClass('note-warning');
		$(element).parents('tr').addClass('note-danger');
		$(element).parents('tr').removeClass('note-warning');
		alert('Image has been featured succefully.');
	    }
	});
	
    });
    
    
    function printDiv() {
     //var printContents = document.getElementById('tab6-wizard-custom-circle').innerHTML;
     //var originalContents = document.body.innerHTML;
     //
     //document.body.innerHTML = printContents;
     //
     //window.print();
     //
     //document.body.innerHTML = originalContents;
    
    
    
    
        //$("#print_order").click(function () {
        var contents = $("#tab6-wizard-custom-circle").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<!DOCTYPE html><html><head><title> &nbsp;</title><div style="text-align:center;"><img src="<?php echo FRONTEND_URL; ?>images/logo2.png" alt="logo" class="logo-default"/></div>');
	
        //Append the external CSS file.
        frameDoc.document.write('<style type="text/css">'+
	    '.col-sm-12{float: left; width:100%}'+
	    '.form-group{content: " "; display:block; vertical-align:top; width:100%;}'+
            '.control-label{ margin-bottom: 0; padding-top: 7px; text-align: right; width: 150Px; float:left;}'+
	    '.col-md-9{margin-bottom:10px;}'+
	    '.input-group{border-collapse: separate; display: table; position: relative; padding-left:30px;}'+
	    '.input-group-addon{ background: #FFF none repeat scroll 0 0; border: 1px solid #e5e5e5; height: 34px; width:320px !important; text-align: left; display:inline-block;  float:right; padding:8px 0px 0px 8px;}'+
	    '.mbxl{font-size: 23px;}'+
	    '.checker{display: inline-block;}'+
	    
            '</style>');
        frameDoc.document.write('</head><body>');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 1000);

    //});
    }
    
    
    
  </script>

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
