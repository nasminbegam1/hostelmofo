<!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
<!--END BACK TO TOP-->
<div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
                <a id="logo" href="<?php echo BACKEND_URL.'dashboard/'; ?>" class="navbar-brand">
                       
                        <span class="logo-text">
                                <img src="<?php echo BACKEND_IMAGE_PATH; ?>admin-logo.1.png" alt="admin-logo" style="width:45%;"/>
                        </span>
                        <span style="display: none" class="logo-text-icon">
                                <img src="<?php echo BACKEND_IMAGE_PATH; ?>favicon.ico" /></span>
                </a>
            </div>
            
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
               
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                   
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">
                    
                    <?php if($user_image!='')
                        {
                            if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$user_image) && $user_image != "")
                            {
                                $user_image1 = FILE_UPLOAD_URL."admin/".$user_image;
                            ?>
                                <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                            <?php
                            }
                            else
                            {
                                $user_image1 = FILE_UPLOAD_URL."admin/userLogin2.png";
                            ?>
                            
                                <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                            <?php
                            }
                        }
                        else
                        {
                       
                            $user_image1 = FILE_UPLOAD_URL."admin/userLogin2.png"; ?>
                            <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                        
                        <?php
                        }
                        ?>  
                    
                    
                   
                        <span class="hidden-xs"><?php echo stripslashes($user_first_name).' '.stripslashes($user_last_name);?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="<?php echo BACKEND_URL.'profile/index/'; ?>"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="<?php echo BACKEND_URL.'dashboard/logout/'; ?>"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown hidden-xs">
                        <a href="javascript:void(0)" data-step="2" data-intro="This template keep changes to come better. Take a look for &lt;b&gt;changelog&lt;/b&gt;!" data-position="left" class="btn-quick-sidebar">
                                <i class="fa fa-bullhorn"></i><!--<span class="badge badge-danger">9</span>-->
                        </a>
                    </li>
                   
                </ul>
            </div>
        </nav>
    </div>