<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
		<?php } ?>
		<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
		<?php }
		//pr($arr_property_image,0);
		
		?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit New Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
                	
                    <ul class="property_tab">
                        <li><a id="property_information_div" class="property_menu" href="<?php echo BACKEND_URL;?>property/edit_property_information/<?php echo $property_id;?>/<?php echo $page;?>">Property Information</a></li>
                        <li class="active"><a>Property Image</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_rentals/<?php echo $property_id;?>/<?php echo $page;?>">Property Rentals</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_sales/<?php echo $property_id;?>/<?php echo $page;?>">Property Sales</a></li>
			<!--<li><a href="<?php echo BACKEND_URL;?>property/edit_property_additional_info/<?php echo $property_id;?>/<?php echo $page;?>">Property Additional Information</a></li>-->
		    </ul>
                    <div class="clear"></div>
			    
                    		                            
                            <div id="property_image_fieldset" class="property_tag_class">
				<form name="frmPropertyImages" id="frm2" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>property/edit_property_image/<?php echo $property_id;?>/<?php echo $page;?>">
				<input type="hidden" name="action" value="Process">
				<fiedset>
                            	<!--<h4>Property Image</h4>-->
				<div class="col-sm-12">
				    <div class="step_info">
					<h4>Property Image</h4>
					<p>Upload the Property Images here.</p>
				    </div> 
				</div>
				<br class="spacer" />
				
				<div class="col-sm-12">
				    <table width="100%" cellpadding="2" cellspacing="3" border="1" class="imageListBox">
					<tr>
					    <th>Image Name</th>
					    <th>Image Title</th>
					    <th>Image Alt</th>
					    <th>Image Caption</th>
					    <th>Image Tag</th>
					    <th>Order</th>
					    <th>Featured</th>
					    <th>Delete</th>
					</tr>
					<?php if(is_array($arr_property_image)) { foreach($arr_property_image as $val){?>
					<tr id="tr_id_<?php echo $val['property_image_id'];?>_<?php echo $val['property_id'];?>">
					    <td>
						<img height="50" width="50" src="<?php echo FRONTEND_URL;?>upload/property/<?php echo $val['image_file_name'];?>">
						<br><?php echo $val['image_file_name'];?><input type="hidden" value="<?php echo $val['image_file_name'];?>" name="image_name[]">
					    </td>
					    <td><input type="text" class="form-control" name="image_title[]" value="<?php echo $val['image_title'];?>"></td>
					    <td><input type="text" class="form-control" name="image_alt[]" value="<?php echo $val['image_alt'];?>"></td>
					    <td><input type="text" class="form-control" name="image_caption[]" value="<?php echo $val['image_caption'];?>"></td>
					    <td><input type="text" class="form-control" name="image_tag[]" value="<?php echo $val['image_tag'];?>"></td>
					    <td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order[]" value="<?php echo $val['image_order'] == 999 ? '':$val['image_order'];?>"></td>
					    <?php
					    if($val['is_featured']=='Yes')
					    {
						?>
					    <td><input type="radio" class="form-control" value="<?php echo $val['image_file_name'];?>" name="make_featured[]" checked="true"></td>
					    <?php
					    }
					    else
					    {
						?>
					    <td><input type="radio" class="form-control" value="<?php echo $val['image_file_name'];?>" name="make_featured[]" ></td>
					     <?php
					    }
					    ?>
					    <td><span class="glyphicon glyphicon-remove-sign delete_image" id="<?php echo $val['property_image_id'];?>_<?php echo $val['property_id'];?>" style="cursor:pointer;"></span></td>
					</tr>
					<?php } } ?>
					<tbody id="uploadPictures"></tbody>
				    </table>
				    <br class="spacer" /><br class="spacer" />
				    <div id="mulitplefileuploader">Upload</div>
				    <div id="status"></div>
				</div>
				
                                <br class="spacer" />
                                
                                <div class="save_div_class">
				    <button class="btn btn-default frm_step_next" type="submit" id="btn_property_rentals_fieldset">Save</button>
				</div>
							    
				
                            </fieldset>
				</form>
			    </div>
                            
                            <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
				<div style="float:right;margin-top:-150px;display:none;" id="div_loader">
				    <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
				</div>
				
                            </div>
                        </div>	
            		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
<script>
var backend_url		= '<?php echo BACKEND_URL;?>';
var frontend_url	= '<?php echo FRONTEND_URL;?>';

$(window).load(function(){
    
	var settings = {
		url:  backend_url + "property/do_image_upload",
		method: "POST",
		allowedTypes:"jpg,png,gif,jpeg",
		fileName: "myfile",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
		    //alert(data);
		    var image_name		= data.replace(/\"/g, '');
		    var arr_image_name		= image_name.split('_');
		    var display_image_name	= arr_image_name[1];		    
		    var str = '<tr id="tr_'+ image_name +'"><td><img src="'+frontend_url+'upload/property/'+ image_name +'" width="50" height="50"><br>'+image_name+'<input type="hidden" name="image_name[]" value="'+ image_name + '"></td><td><input type="text" name="image_title[]" class="form-control"></td><td><input type="text" name="image_alt[]" class="form-control"></td><td><input type="text" name="image_caption[]" class="form-control"></td><td><input type="text" name="image_tag[]" class="form-control"></td><td><input type="text" maxlength="3" data-type="number" class="form-control" name="image_order[]" value=""></td><td><input type="radio" name="make_featured[]" value="'+ image_name +'" class="form-control"></td><td><span style="cursor:pointer;" id="' + image_name + '" class="glyphicon ajax_image_delete glyphicon-remove-sign"></span></td></tr>';
		    
		    $('#uploadPictures').append(str);
		    $("#status").html("<font color='green'>Upload was successful</font>");
		    
			
		},
		onError: function(files,status,errMsg)
		{		
			$("#status").html("<font color='red'>Uploading is Failed</font>");
		}
	}

	$("#mulitplefileuploader").uploadFile(settings);

});

$(document.body).on('click', '.ajax_image_delete', function(event) {
    var elem = $(this);
    var backend_url	= '<?php echo BACKEND_URL;?>';
    var fileName 	= $(this).attr('id');
    if (confirm("Are you sure?")) 
    {
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url + "property/ajax_delete_property_image/",
		data: { file_name: fileName},
		success:function(data) { 
			//$("#tr_" + fileName).remove();
			$(elem).parent().parent().hide();
		}
	});
    }
});

$(".delete_image").on('click', function(){
    var ids = $(this).attr('id');
    
    if (confirm("Are you sure?"))
    {
	var arrId 		= ids.split("_");
	var propertyId		= arrId[1]; 
	var propertyImageId	= arrId[0];
	
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url + "property/delete_property_image/",
		data: { property_image_id: propertyImageId, property_id: propertyId},
		success:function(data) {
		    $("#tr_id_" + ids).remove();
		}
	});
    }
});
</script>