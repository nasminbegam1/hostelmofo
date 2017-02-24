<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>
            
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
               <div class="page-header pull-left">
                    <div class="page-title">Edit Longterm Property</div>
                </div>
		<ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Longterm Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit &nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
		    <li class="active">Image</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Images</div>
                                <div class="tools">
                                    <i class="fa fa-chevron-up"></i>
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                   
                                    <div class="tab-content">
                                        <form action="#" class="form-horizontal">
                                        <div id="tab1-wizard-custom-circle" class="tab-pane"><!--<h3 class="mbxl">Set up your account</h3>-->
                                           
                                           <!------general section start-->
                                           
                                          
                                            <div class="row">
                                                
                                                <!------------- Image section -------------------->
                                                 
                                                    <div class="panel panel-violet portlet box portlet-violet">
                                                        <!--<div class="panel-heading">Upload Property Image</div>-->
                                                    <div class="portlet-header">
                                                    <div class="caption">Upload Property Image</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                   </div>
                                                        <div class="portlet-body ">
                                                             <div class="gallery-pages">
                                                            
                                                            <div id="mulitplefileuploader" style="display: none;" ><i class="glyphicon glyphicon-plus"></i>&nbsp;<span>Add Image files...</span></div>
                                                            <div id="status"></div>
                                                            
                                                            <div class="parent-loader" style="display:none;" >
                                                             <img src="<?php echo BACKEND_URL; ?>vendors/pageloader/images/loader6.GIF" alt=""></div>
                                                            
                                                            <div class="action action-top text-right">
                                                                <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'longrentals/price/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                                                <button type="button" name="next" onclick="javascript:go_to('<?php echo base_url().'longrentals/contact/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Next" class="btn btn-info button-next mlm">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                                            
                                                            </div>
                                                           
                                                            
                                                            <div class="row mix-grid image-list">
                                                                <?php  if(is_array($arr_property_image)) { foreach($arr_property_image as $val){ ?>
                                                                
                                                                    <div class="col-md-4 mix property_image <?php if($val['is_featured']=='Yes'){ echo 'selected-feature-image'; } ?>">
                                                                      <div class="hover-effect">
                                                                     <?php if( file_exists( FILE_UPLOAD_ABSOLUTE_PATH."property/".$val['image_file_name'] )){ ?>
                                                                            
                                                                        <div class="img"><img  src="<?php echo FRONTEND_URL;?>upload/property/<?php echo $val['image_file_name'];?>" alt="" class="img-responsive"/></div>
                                                                          
                                                                        <?php }else{ ?>
                                                                        
                                                                        <div class="img "><img   src="<?php echo BACKEND_IMAGE_PATH;?>no_img_180@2x.png" alt="" class="img-responsive"/></div>
                                                                       
                                                                        <?php  } ?>
                                                                            
                                                                        <div class="info" >
                                                                            
                                                                                <span class="form-element make-default-spn">
                                                                                    <label >
                                                                                        <input type="radio"  name="make_featured[]" <?php if($val['is_featured']=='Yes'){echo 'checked';} ?> id="featured-<?php echo $val['property_image_id'];?>" class="input_featured make-featured" />
                                                                                       Click here to make feature image
                                                                                    </label> 
                                                                                </span>
                                                                                
                                                                                <span class="form-element  cross-image">
                                                                                   <a href="javascript:void(0);" class="delete_image" id="delete-<?php echo $val['property_image_id'];?>"><i class="fa fa-times "></i></a>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Caption</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_caption[]" class="form-control  form-input" id="caption-<?php echo $val['property_image_id'];?>" value="<?php echo  htmlspecialchars($val['image_caption']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Alter</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_alt[]" class="form-control form-input" id="alt-<?php echo $val['property_image_id'];?>" value="<?php echo  htmlspecialchars($val['image_alt']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                <br>
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Order</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_order[]" class="form-control number form-input" id="order-<?php echo $val['property_image_id'];?>" value="<?php echo  htmlspecialchars($val['image_order']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                            <div class="ajaxloader" id="loader-<?php echo $val['property_image_id'];?>" style="display:none">
                                                                               <img src="<?php echo BACKEND_URL; ?>vendors/pageloader/images/loader6.GIF" alt="">
                                                                            </div>
                                                                         
                                                                        </div>
                                                                            <span class="display-order" id="display-order-<?php echo $val['property_image_id'];?>"><?php echo 'Image Order : '.htmlspecialchars($val['image_order']); ?></span>
                                                                            <input type="hidden" value="<?php echo $val['image_file_name'];?>" name="image_name[]">
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                 }//4each
                                                                }//if array
                                                                ?>
                                                            </div>
                                                             </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                               
                                                
                                                <!------------- Image section -------------------->
                                                
    
                                            </div> <!--row-->


                                        
                                        <!------general section end-->
                                        
                                         
                                        </div>
                                        
                                         
                                        <div class="action text-right">
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'longrentals/price/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="button" name="next" value="Next" onclick="javascript:go_to('<?php echo base_url().'longrentals/contact/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" class="btn btn-info button-next mlm">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
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
    var backend_url		= '<?php echo BACKEND_URL;?>';
    var frontend_url	= '<?php echo FRONTEND_URL;?>';
    var property_id	= <?php echo $this->uri->segment(3,0);?>;
    
  
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

  
    $(window).load(function(){
        
            var settings = {
                    url:  backend_url + "longrentals/do_image_upload",
                    method: "POST",
                    allowedTypes:"jpg,png,gif,jpeg",
                    fileName: "myfile",
                    multiple: true,
                    onSuccess:function(files,data,xhr)
                    {
                        //alert(data);
                        var image_name		= data.replace(/\"/g, '');
                        var new_image_name = '';
    
                        var arr_image_name		= image_name.split('_');
                        var display_image_name	= arr_image_name[1];
                        var feature_img = '';
                        //var feature_img = featureImage();
                        var check_for_feature = '';
                       

                        add_image(property_id,image_name,feature_img);  // instant insert image record 
                        
                        check_if_no_record();
                    },
                    onError: function(files,status,errMsg)
                    {		
                            //$("#status").html("<font color='red'>Uploading is Failed</font>");
                            $.scojs_message('Somthing is wrong with your file. Please try again', $.scojs_message.TYPE_ERROR);
                    }
            }
    
            $("#mulitplefileuploader").uploadFile(settings);
            
            check_if_no_record();
            Command: toastr['info']("This is auto save page do not need to save it manually");
            //  $.scojs_message('This is auto save page you have do not need to save it manually', $.scojs_message.TYPE_OK);
    
    });
    
  

   
    $(document.body).on('click', '.delete_image', function(event){
        var ids = $(this).attr('id');
        var arrId 		= ids.split("-");
        var propertyImageId	= arrId[1];
        
        if($("#featured-"+propertyImageId).prop('checked')){
            Command: toastr['error']("Sorry you can not delete your feature property image")

            toastr.options = {
              "closeButton": false,
              "debug": true,
              "positionClass": "toast-bottom-right",
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
             return false;
        }
        
        if (confirm("Are you sure, Do you want to delete this sales property?"))
        {
                    
            
            //alert(propertyImageId);
            $.ajax({
                    type: "POST",
                   dataType: "HTML",
                   url: backend_url + "property_rental/delete_property_image/",
                    data: { property_image_id: propertyImageId},
                    success:function(data) {
                       
                       $($("#"+ids).parents('.col-md-4')).fadeOut(function(){$($("#"+ids).parents('.col-md-4')).remove(); check_if_no_record();});
                               
                        
                        $.scojs_message('Property image removed successfully.',  $.scojs_message.TYPE_ERROR);
                    }
            });
        }
    });


   
    
    /*** If record not found **/
    function check_if_no_record(){
      image_count = $('.property_image').length;
      //alert(image_count );
      if (image_count < 1) {
       $('.action-top').hide();
      }else{
         $('.action-top').show();
      }
    }
    
    //// Add image record in db
    function add_image(property_id,display_image_name,is_feature){
        
        $.ajax({
                    type: "POST",
                    dataType: "HTML",
                    url: backend_url + "longrentals/add_property_image/",
                    data: { property_id: property_id, image_name: display_image_name,is_feature:is_feature},
                    beforeSend:function(data) {
                         $(".parent-loader").show();
                     },
                    success:function(data) {
                       $("#status").html("<i class='fa fa-level-down'></i></font>");
                       $('.image-list').prepend(data);
                       $(".parent-loader").hide();
                       
                       $.scojs_message('Property image added successfully. Please edit image data (e.g. Image caption, Alt) ', $.scojs_message.TYPE_OK);
                       setTimeout(function(){ $("#status").fadeOut("slow"); },4000);
                       check_if_no_record();
                       
                    }
            });
    }
  

    $(document.body).on('click', '.form-input', function(event){
        
        var input_image_id = $(this).prop('id');
        
        property_image_id_arr = input_image_id.split('-');
        property_image_id = property_image_id_arr[1];
        
        $( ".info" ).mouseout(function(){
          
           var hoverchecking =  $( $(this).find("#"+input_image_id)).length ;
           
           if (property_image_id != '' && hoverchecking == 1) {
            update_image_data(property_image_id);
            }
          //property_image_id = '';
        });
        
        
    });

    
     
    function update_image_data(property_image_id){
        var caption = $('#caption-'+property_image_id).val();
        var alt     = $('#alt-'+property_image_id).val();
        var order   = $('#order-'+property_image_id).val();
        var featured = 'no';
        
        
        // update
        
        $.ajax({
                type: "POST",
                dataType: "HTML",
                url: backend_url + "longrentals/update_image_data/",
                data: { caption: caption, alt: alt,order:order,property_image_id:property_image_id},
                beforeSend:function(data) {
                   $('#loader-'+property_image_id).show();
                },
                success:function(data) {
                   $('#loader-'+property_image_id).hide();
                   $("#display-order-"+property_image_id).html("Image Order : "+order);
                }
        });

    }
    
    $(document.body).on('ifChecked', 'input', function(event){
       
       var input_id = event.target.id;
       var inputid_arr = input_id.split('-');
       inputid = inputid_arr[1];
       //alert(inputid);   
      
       if (inputid!='') {
        
        $.ajax({
                type: "POST",
                dataType: "HTML",
                url: backend_url + "longrentals/set_feature_image/",
                data: { property_image_id:inputid},
                success:function(data) {
                   //alert(data);
                    $( "*" ).removeClass( "selected-feature-image" );
                    $($("#"+input_id).parents('.col-md-4')).addClass('selected-feature-image');
                }
        });
        
       }
      });
   
    // on ajaxe data make feature
  
    
    function makefeature(thisobj){
         var input_id = $(thisobj).prop('id');
        var inputid_arr = input_id.split('-');
        inputid = inputid_arr[1];
        //alert(inputid);
        
        
        if (inputid!='') {
        
        
        
        $.ajax({
            type: "POST",
            dataType: "HTML",
            url: backend_url + "property_rental/set_feature_image/",
            data: { property_image_id:inputid},
            success:function(data) {
                $( "*" ).removeClass( "selected-feature-image" );
                $( ".info *" ).removeClass( "checked" );
                
                $($("#"+input_id).parents('.col-md-4')).addClass('selected-feature-image');
               // uncheck_radio();  
              
            }
        });
        
        }
    }
    
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
    
    
    
    
