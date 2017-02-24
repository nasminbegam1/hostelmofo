 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Update City</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  
  <!--For breadcrump end-->
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
                                        
                                       
                                        <?php if($errmsg){?>
                                        <div align="center">
                                            <div class="note note-danger" style="color:red;">
                                                <?php echo $errmsg; ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Update City</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
  
                                                        <div class="form-group"><label for="city_name" class="col-md-3 control-label">Province<span class='require'>*</span></label>

                                                            <div class="col-md-9">
								<select name="province" class="form-control required">
								    <option value="">Select Any province</option>
								    <?php if(is_array($province_list) and count($province_list)>0){ ?>
								    <?php foreach($province_list as $data){ ?>
								    <option value="<?php echo $data['province_id']; ?>" <?php echo ($data['province_id']==$city_details['province_id'])?  'selected="selected"':''; ?>><?php echo $data['province_name']; ?></option>
								    <?php }  ?>
								    <?php } ?>
								</select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="city_name" class="col-md-3 control-label">City Name<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="city_name" type="text" placeholder="" class="form-control required" id="city_name" value="<?php echo $city_details['city_name']; ?>"/>
                                                                
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="meta_title" class="col-md-3 control-label">Meta Title</label>

                                                            <div class="col-md-9">
								<textarea name="meta_title" id="meta_title" class="form-control"><?php echo htmlspecialchars(stripslashes($city_details['meta_title'])); ?></textarea>
								<span id="countexact_meta_title"><?php if(isset($city_details['meta_title'])) 
								{
								   echo  mb_strlen( trim( stripslashes($city_details['meta_title']))) ;
								}
								else
								{
								    echo '0';
								}
								?></span><span>/69</span>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="meta_keyword" class="col-md-3 control-label">Meta Keyword<!--<span class='require'>*</span>--></label>

                                                            <div class="col-md-9">
								<textarea name="meta_keyword" id="meta_keyword" class="form-control"><?php echo htmlspecialchars(stripslashes($city_details['meta_keyword'])); ?></textarea>
							        
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="meta_description" class="col-md-3 control-label">Meta Description</label>

                                                            <div class="col-md-9">
                                                                <textarea name="meta_description" id="meta_description" class="form-control"><?php echo htmlspecialchars(stripslashes($city_details['meta_description'])); ?></textarea>
								<span id="countexact"><?php if(isset($city_details['meta_description'])) 
                                                                {
								echo  mb_strlen(trim(stripslashes($city_details['meta_description']))) ;
								 }
								 else
								 {
								     echo '0';
								 }
								 ?></span><span>/155</span>
                                                                
                                                            </div>
                                                        </div>
                                                      
							<div class="form-group"><label for="description" class="col-md-3 control-label">Description</label>

                                                            <div class="col-md-9">
                                                                <textarea name="description" class="ckeditor form-control" id="description"><?php echo htmlspecialchars(stripslashes($city_details['description'])); ?></textarea> 
                                                                
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="city_big_image" class="col-md-3 control-label">City Banner Image<br>(Max 2 MB in size)</label>

                                                            <div class="col-md-9">
                                                                <input type="file" name="city_banner_image" id="city_banner_image" class="form-control">
								    <br />
								    <img src="<?php echo isFileExist(CDN_CITY_BANNER_IMG.$city_details['banner_image_name']);?>" width="100" hight="50" >
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="type" class="col-md-3 control-label">Type</label>

                                                            <div class="col-md-9">
                                                                <select name="type" id="type" class="form-control">
								    <option value="">Select type</option>
								    <option value="Adventure" <?php if($city_details['type'] == 'Adventure') {?>selected<?php } ?>>Adventure</option>
								    <option value="Beach" <?php if($city_details['type'] == 'Beach') {?>selected<?php } ?>>Beach</option>
								    <option value="City" <?php if($city_details['type'] == 'City') {?>selected<?php } ?>>City</option>
								    <option value="Most Reviewed" <?php if($city_details['type'] == 'Most Reviewed') {?>selected<?php } ?>>Most Reviewed</option>
								    <option value="Top Rated" <?php if($city_details['type'] == 'Top Rated') {?>selected<?php } ?>>Top Rated</option>
								    <option value="Popular" <?php if($city_details['type'] == 'Popular') {?>selected<?php } ?>>Popular</option>
								</select>
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="is_featured" class="col-md-3 control-label">Is Favourite<span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <select name="is_favourite" id="is_favourite" class="form-control">
								    <option value="No" <?php if($city_details['is_favourite'] == 'No') {?>selected<?php } ?>>No</option>
								    <option value="Yes" <?php if($city_details['is_favourite'] == 'Yes') {?>selected<?php } ?>>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>
							
							<div class="form-group" style="display:none;" id="fav_location"><label for="is_featured" class="col-md-3 control-label">Image File in Favourite Section<br>(Max 2 MB in size)</label>

                                                            <div class="col-md-9">
                                                                <input type="file" name="fav_location" id="fav_location" class="form-control">
								    <br />
								    <img src="<?php echo isFileExist(CDN_CITY_THUMB_IMG.$city_details['image_name']);?>" width="200" height="100" >
                                                            </div>
                                                        </div>
							
						                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
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
	    $('#meta_description').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>154){
		$(this).val(value.substring(0,155));
		 var len = 155; 
	    }
	    $('#countexact').text(len);
	});

	$('#meta_title').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>68){
		$(this).val(value.substring(0,69));
		 var len = 69; 
	    }
	    $('#countexact_meta_title').text(len);
	});
	
    });
      </script>  
        

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->