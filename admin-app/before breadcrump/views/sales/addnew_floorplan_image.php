    <div class="col-md-4 mix property_image " style="display: inline-block;" >
     <div class="hover-effect">
     <?php if( file_exists( FILE_UPLOAD_ABSOLUTE_PATH."property/".$val['image_file_name'] )){ ?>
            
            <div class="img"><img  src="<?php echo FRONTEND_URL;?>upload/property/<?php echo $val['image_file_name'];?>" alt="" class="img-responsive"/></div>
              
            <?php }else{ ?>
            
            <div class="img "><img  src="<?php echo BACKEND_IMAGE_PATH;?>no_img_180@2x.png" alt="" class="img-responsive"/></div>
           
            <?php  } ?>
            
            <div class="info">
                   
                    <span class="form-element make-default-spn"><label></label></span>
                  
                    <span class="form-element cross-image">
                       <a href="javascript:void(0);" class="delete_image"  id="delete-<?php echo $val['floor_plan_id'];?>"><i class="fa fa-times "></i></a>
                    </span>
                    
                    <div class="clearfix"></div>
                    
                    <span class="form-element">
                        <label class="col-md-3 control-label">Caption</label>
                        <div class="col-sm-8">
                            <input type="text" name="image_caption[]" class="form-control form-input" id="caption-<?php echo $val['floor_plan_id'];?>" />
                        </div>
                    </span>
                    
                    <div class="clearfix"></div>
                    
                    <span class="form-element">
                        <label class="col-md-3 control-label">Alter</label>
                        <div class="col-sm-8">
                            <input type="text" name="image_alt[]" class="form-control form-input" id="alt-<?php echo $val['floor_plan_id'];?>" />
                        </div>
                    </span>
                    
                    <div class="clearfix"></div>
                    
                    <span class="form-element">
                        <label class="col-md-3 control-label">Order</label>
                        <div class="col-sm-8">
                            <input type="text" name="image_order[]" value="<?php echo $val['image_order'];?>" class="form-control form-input" id="order-<?php echo $val['floor_plan_id'];?>" />
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
