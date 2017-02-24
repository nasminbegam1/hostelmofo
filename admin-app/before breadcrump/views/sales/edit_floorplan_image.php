<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>
            
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Sales Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_sales/index/"?>">Sales Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Sales Property Images</div>
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
                                                 
                                                    <div class="panel panel-blue portlet box portlet-blue">
                                                               
                                                        <!--<div class="panel-heading">Upload Property Image</div>-->
                                                    <div class="portlet-header">
                                                    <div class="caption">Upload Property Image</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                    </div>
                                                        
                                                        <div class="portlet-body ">
                                                             <div class="gallery-pages">
                                                            
                                                            
                                                            <div class="row">
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label" for="status">Floor plan status  is</label>
                                                                        <div class="col-md-1">
                                                                        </div>
                                                                        <div class="col-md-7 input-icon">
                                                                              <label class=" radio-btn" >
                                                                            <input type="radio"  name="status" value="1" <?php if($arr_property_image[0]['is_active']==1)echo 'checked'; ?>  class="form-control  status" />
                                                                            &nbsp; Enable &nbsp;
                                                                        </label>
                                                                        <label class="radio-btn">
                                                                            <input type="radio"  name="status" value="0"  <?php if($arr_property_image[0]['is_active']==0)echo 'checked'; ?> class="form-control  status" />
                                                                            &nbsp; Disable 
                                                                        </label> 
                                                                            
                                                                        </div>
                                                            </div>
                                                            </div>
                                                            
                                                            
                                                            <div id="mulitplefileuploader" style="display: none;" ><i class="glyphicon glyphicon-plus"></i>&nbsp;<span>Add Image files...</span></div>
                                                            <div id="status"></div>
                                                            
                                                            <div class="parent-loader" style="display:none;" >
                                                             <img src="<?php echo BACKEND_URL; ?>vendors/pageloader/images/loader6.GIF" alt=""></div>
                                                            
                                                            <div class="action action-top text-right">
                                                                <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'property_sales/property_image/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                                                <button type="button" name="next" value="Next" onclick="javascript:go_to('<?php echo base_url().'property_sales/contact/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');"  class="btn btn-info button-next mlm">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                                            
                                                            </div>
                                                           
                                                            
                                                            <div class="row mix-grid image-list">
                                                                <?php  if(is_array($arr_property_image)) { foreach($arr_property_image as $val){ ?>
                                                                
                                                                    <div class="col-md-4 mix property_image ">
                                                                      <div class="hover-effect">
                                                                     <?php if( file_exists( FILE_UPLOAD_ABSOLUTE_PATH."property/".$val['image_file_name'] )){ ?>
                                                                            
                                                                        <div class="img"><img  src="<?php echo FRONTEND_URL;?>upload/property/<?php echo $val['image_file_name'];?>" alt="" class="img-responsive"/></div>
                                                                          
                                                                        <?php }else{ ?>
                                                                        
                                                                        <div class="img "><img  src="<?php echo BACKEND_IMAGE_PATH;?>no_img_180@2x.png" alt="" class="img-responsive"/></div>
                                                                       
                                                                        <?php  } ?>
                                                                            
                                                                        <div class="info" >
                                                                                 <span class="form-element make-default-spn">
                                                                                    <label></label>
                                                                                 </span>
                                                                                
                                                                                <span class="form-element  cross-image">
                                                                                   <a href="javascript:void(0);" class="delete_image" id="delete-<?php echo $val['floor_plan_id'];?>"><i class="fa fa-times "></i></a>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Caption</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_caption[]" class="form-control  form-input" id="caption-<?php echo $val['floor_plan_id'];?>" value="<?php echo  htmlspecialchars($val['image_caption']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Alter</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_alt[]" class="form-control form-input" id="alt-<?php echo $val['floor_plan_id'];?>" value="<?php echo  htmlspecialchars($val['image_alt']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                <br>
                                                                                <div class="clearfix"></div>
                                                                                
                                                                                <span class="form-element">
                                                                                    <label class="col-md-3 control-label">Order</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" name="image_order[]" class="form-control number form-input" id="order-<?php echo $val['floor_plan_id'];?>" value="<?php echo  htmlspecialchars($val['image_order']); ?>" />
                                                                                    </div>
                                                                                </span>
                                                                                
                                                                                <div class="clearfix"></div>
                                                                                
                                                                            <div class="ajaxloader" id="loader-<?php echo $val['floor_plan_id'];?>" style="display:none">
                                                                               <img src="<?php echo BACKEND_URL; ?>vendors/pageloader/images/loader6.GIF" alt="">
                                                                            </div>
 
                                                                        </div>
                                                                            <span class="display-order" id="display-order-<?php echo $val['floor_plan_id'];?>"><?php echo  'Image Order : '.htmlspecialchars($val['image_order']); ?></span>

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
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'property_sales/property_image/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="button" name="next" value="Next" onclick="javascript:go_to('<?php echo base_url().'property_sales/contact/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" class="btn btn-info button-next mlm">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
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
    
    $(window).load(function(){
        
            var settings = {
                    url:  backend_url + "property_sales/do_image_upload",
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
                        
                        //check_if_no_record();
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
        
       
        if (confirm("Are you sure, Do you want to delete this sales property?"))
        {
                    
            
            //alert(propertyImageId);
            $.ajax({
                    type: "POST",
                   dataType: "HTML",
                   url: backend_url + "property_sales/delete_floorplan_image/",
                    data: { floor_plan_id: propertyImageId},
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
        
        var status  = $("input[type='radio'][name='status']:checked").val() ;
      
        $.ajax({
                    type: "POST",
                    dataType: "HTML",
                    url: backend_url + "property_sales/add_floorplan_image/",
                    data: { property_id: property_id, image_name: display_image_name,status:status},
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
        
        floor_plan_id_arr = input_image_id.split('-');
        floor_plan_id = floor_plan_id_arr[1];
       
        
        $( ".info" ).mouseout(function(info){    
         var hoverchecking =  $( $(this).find("#"+input_image_id)).length ;
       
           if (floor_plan_id != '' && hoverchecking == 1) {
             update_image_data(floor_plan_id);
            }
          
        });
        
        
    });
    
    $(document.body).on('ifChecked','.status',function(){
        
        var status = $(this).val();
        $.ajax({
                type: "POST",
                dataType: "HTML",
                url: backend_url + "property_sales/change_floorplan_status/",
                data: { property_id: property_id, status:status},
                success:function(){
                    if (status==1) {
                        $.scojs_message('Floor plan status enabled successfully ', $.scojs_message.TYPE_OK);
                    }else{
                        $.scojs_message('Floor plan status disabled successfully ', $.scojs_message.TYPE_ERROR);
                     
                    }
                }
               
        });
    });

    
     
    function update_image_data(floor_plan_id){
        var caption = $('#caption-'+floor_plan_id).val();
        var alt     = $('#alt-'+floor_plan_id).val();
        var order   = $('#order-'+floor_plan_id).val();  
        
        $.ajax({
                type: "POST",
                dataType: "HTML",
                url: backend_url + "property_sales/update_floorplan_image_data/",
                data: { caption: caption, alt: alt,order:order,floor_plan_id:floor_plan_id},
                beforeSend:function(data) {
                   $('#loader-'+floor_plan_id).show();
                },
                success:function(data) {
                   $('#loader-'+floor_plan_id).hide();
                   $("#display-order-"+floor_plan_id).html(order);
                }
        });


    }
    
   
    </script>