<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>message-box.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACKEND_CSS_PATH;?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>uploadify/swfobject.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>uploadify/vortexdev.js"></script>


<div id="main_content">                    
    <!-- Start : main content loads from here -->        	
        <div class="row">
	      <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Property Image</h4>
                    </div>
		    
		    <!--- Display Previous Image --->
		    <div>
			<?php
			if(is_array($arr_property_image)) {
			      for($i=0;$i<count($arr_property_image);$i++){
				   $image_path = FRONTEND_URL."upload/property/thumb/".$arr_property_image[$i]['image_file_name'];
			      
			?>
			<div><img src="<?php echo $image_path;?>" width="50" height="50"></div>
			<?php } } else { echo "There is no exisiting image";} ?> 
		    </div>     
		    <!--- Display Previous Image --->
		    
                    <div class="panel-body">
                        <form method="post" action="<?php echo BACKEND_URL;?>property/do_image_upload/<?php echo $property_id;?>" class="main" enctype="multipart/form-data" id="parsley_reg">
			    <input type="hidden" name="action" value="Process">
		            <div class="form_sep">
			      <label for="reg_input_name" class="req">Upload Image</label>              
				<input type="file" name="propertyImage" id="propertyImage" />                       
				<a href="javascript:$('#propertyImage').uploadifyUpload();" class="btn large primary">Upload Photos</a>
				<div id="displayFilePhotos"></div>			      
			    </div>
                            <div class="form_sep">
			      <button class="btn btn-default" type="submit" id="upload-file">Submit</button>
			      <button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
			    </div>
			    
			    <input type="hidden" id="uploadfolder" value="<?php echo FILE_UPLOAD_ABSOLUTE_PATH;?>">
			    <input type="hidden" id="site_url" value="<?php echo FRONTEND_URL;?>">
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>

<script>
    
    var uploadfolder	= $('#uploadfolder').val();  
    var site_url	= $('#site_url').val();
    var backend_url	= $('#backend_url').val();
    
    $('#propertyImage').uploadify({
        'uploader'  : site_url + 'flash/uploadify/uploadify.swf',
        'script'    : backend_url + 'ajax/uploadifyUploaderPropertyPhoto/',
        'cancelImg' : site_url + 'images/cancel.png',
        'folder'    : uploadfolder,
        'fileExt'     : '*.jpg;*.gif;*.png',
        'auto'      : false,
        'multi'     : true,
        'onComplete'  : function(event, ID, fileObj, response, data) {
   
             // here i'm gonna resize the images and display it in the main page 
             $.ajax({
                  url : backend_url + 'ajax/imagemanipulation/' + fileObj.type +'/' + fileObj.name,
                  success : function(response){               
                      if(response == 'image'){                          
                          var images = $('<div class="fileViewPhoto success">' + fileObj.name + ' uploaded successfully!<br><img src="'+site_url+'upload/property/thumb/'+fileObj.name+'" width="40" height="40">&nbsp;<input type="radio" name="featured_image" value="'+ fileObj.name +'" title="click to make cover image"><input type="text" name="image_name[]" value="'+ fileObj.name +'"></div>');
                          $(images).hide().insertBefore('#displayFilePhotos').slideDown('slow');
                      }
                  }
             })
      
        },
        'onAllComplete': function () {
            //setTimeout( "$('.fileViewPhoto').slideUp('slow');",5000 );
        }
    });
</script>