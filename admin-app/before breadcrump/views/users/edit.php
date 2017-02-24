 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Admin User</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="javascript:void(0)">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="<?php echo $edit_link;?>" >Admin User Edit</a></li>
        
        <?php if(is_array($brdLink) and count($brdLink)>0){ ?>
                <?php foreach($brdLink as $label=>$link){ ?>
                    <li>
			<!--<i class="fa fa-user"></i>&nbsp;&nbsp;-->
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
                                        
                                        
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Edit Form</div>-->
					    <div class="portlet-header">
                                                    <div class="caption">Admin User Edit Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pa">
                                                <?php
								$image          = $user_info[0]['image'];
								$role_id        = $user_info[0]['role'];
						?>
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated" enctype="multipart/form-data" id="edit_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="first_name" type="text" placeholder="First Name" class="form-control required first_name" id="first_name" value="<?php echo stripslashes($user_info[0]['first_name']);?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input name="last_name" type="text" placeholder="Last Name" class="form-control required last_name" id="last_name" value="<?php echo stripslashes($user_info[0]['last_name']);?>"/>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email_address" name="email_address"  placeholder="Email Address" class="form-control required email_address" data-type="email" value="<?php echo stripslashes($user_info[0]['email_id']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?php echo stripslashes($user_info[0]['password']);?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password_repeat" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?php echo stripslashes($user_info[0]['password']);?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_pictute" class="col-md-3 control-label">Upload Picture</label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="user_image" id="user_image" />&nbsp;<strong>[image size maximum 1200x800 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                            </div>
                                                            <br />
                                                            <?php if($image!=''){ ?>
                                                                <img src="<?php echo FILE_UPLOAD_URL;?>admin/<?php echo $image;?>" border="0" width="100" height="100">
                                                             <?php } ?>
                                                        </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Admin User</button>
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->