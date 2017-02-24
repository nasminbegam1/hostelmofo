 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit As Featured In</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<a href="javascript:void(0)">As Featured In</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<a href="<?php echo $edit_url;?>" >Edit As Featured In</a></li>
        
        <?php if(is_array($brdLink) and count($brdLink)>0){ ?>
                <?php foreach($brdLink as $label=>$link){ ?>
                    <li>
                        <i class="fa fa-user"></i>&nbsp;&nbsp;
                        <a href="<?php echo $link ?>"><?php echo $label ; ?></a>
                        <?php if($label != end(array_keys($brdLink))){ ?>
                        <i class="fa fa-angle-right"></i>
                        <?php } ?>
                    </li>
                <?php } ?> 
            <?php  } ?>
        
        
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-green">
                                           
                                            <div class="portlet-header">
                                                    <div class="caption">Edit As Featured In</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="banner_image" class="col-md-3 control-label">As Featured In Image<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="client_image"  id="client_image"  />&nbsp;<!--<strong>[image size exact 205x90| extension must be .jpg or .jpeg or .gif or .png] </strong>-->
                                                               <input type="hidden" name="currentFile" value="<?php echo $arr_client['client_image'];?>">
                                                               <br />
                                                            <?php if($arr_client['client_image']!=''){ ?>
                                                                <img src="<?php echo file_upload_base_url();?>client/thumb/<?php echo $arr_client['client_image'];?>" border="0" >
                                                             <?php } ?>
                                                               
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="form-group"><label for="banner_title" class="col-md-3 control-label">As Featured In Title  <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="client_title" type="text" placeholder="" class="form-control required" id="client_title" value="<?php echo $arr_client['client_title'];?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">As Featured In Link <span class='require'>*</span> </label>

                                                            <div class="col-md-9">
                                                                <input name="client_link" type="text" placeholder=" " class="form-control required" id="client_link" value="<?php echo $arr_client['client_link'];?>"/>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="banner_order" class="col-md-3 control-label">As Featured In Order</label>

                                                            <div class="col-md-9">
                                                                <input type="number" min="" class="form-control" name="client_order" id="client_order" value="<?php echo $arr_client['client_order'];?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="banner_status" class="col-md-3 control-label">As Featured In Status</label>

                                                            <div class="col-md-9">
                                                                <select name="client_status" class="form-control">
                                                                    <option value="active" <?php echo ($arr_client['client_status']=='active') ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="inactive" <?php echo ($arr_client['client_status']=='inactive') ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Featured In</button>
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
        
        
<script>
    $(document).ready(function(){
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact1').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->