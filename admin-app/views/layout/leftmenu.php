<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                      
                    <?php
                    
                    $page		= $this->uri->segment(5);
                    ?>
                       
                    <li class="user-panel">
                        
                        <div class="thumb">
                                    
                                    <?php if($user_image!='')
                                                {
                                                    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$user_image) && $user_image != "")
                                                    {
                                                        $user_image1 = IMAGE_UPLOAD_URL."admin/".$user_image;
                                                    ?>
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        $user_image1 = IMAGE_UPLOAD_URL."admin/userLogin2.png";
                                                    ?>
                                                    
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                               
                                                    $user_image1 = IMAGE_UPLOAD_URL."admin/userLogin2.png"; ?>
                                                    <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                
                                                <?php
                                                }
                                                ?>  
                                    <!--<img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/>-->
                        </div>
                        
                        <div class="info"><p><?php echo stripslashes($user_first_name).' '.stripslashes($user_last_name);?></p>
                            <ul class="list-inline list-unstyled">
                                <li><a href="<?php echo BACKEND_URL.'profile/index/'; ?>" data-hover="tooltip" title="Profile"><i class="fa fa-user"></i></a></li>

                                <li><a href="<?php echo BACKEND_URL.'dashboard/logout/'; ?>" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                   
                    <li class="<?php if(currentClass()=='dashboard' || currentClass()=='profile' ) echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'dashboard/'; ?>">
                                    <i class="fa fa-tachometer fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                  
                    
                   
                    <li class='<?php if(currentClass()=='user') echo 'active'; ?>'>
                        <a href="#">
                                    <i class="fa fa-user">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                           <span class="menu-title">Users</span>
                           <span class="fa arrow"></span>
                           <span class="label label-yellow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                       <!----code--->
                        <li class='<?php if((currentClass()=='user') && (currentMethod()=='adminadd' ||  currentMethod()=='adminuser' || currentMethod()=='adminedit') ) echo 'active'; ?>'>
                          <a href="<?php echo BACKEND_URL.'user/adminuser/'?>"><i class="fa fa-user"></i>
                          <span class="submenu-title">Admin Users</span></a>
                        </li>

                        </ul>
                    </li>
                    
                    
                 
                    
                   <li class="<?php if(currentClass()=='property_type' || currentClass()=='property' || currentClass()=='property_facility' || currentClass()=='propertybooking' ) echo 'active'; ?>" >
                        <a href="javascript:void(0);">
                                    <i class=" glyphicon glyphicon-home">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Property</span>
                                    <span class="fa arrow"></span>
                                    <span class="label label-yellow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                                     <li class="<?php if(currentClass()=='property_type' && (currentMethod()=='index' || currentMethod()=='add_property_type' || currentMethod()=='edit_property_type'))echo 'active'; ?>">
                                                <a href="<?php echo BACKEND_URL.'property_type/'?>"><i class="glyphicon glyphicon-home"></i>
                                                <span class="submenu-title">Property Type</span></a>
                                     </li>
                                     <li class="<?php if(currentClass()=='property' && (currentMethod()=='index' || currentMethod()=='add' || currentMethod()=='editcontactaction' || currentMethod()=='editbasicaction' || currentMethod()=='editpriceaction' || currentMethod()=='editfacilitiesaction' || currentMethod()=='editimageaction' ) || currentClass()=='propertybooking' )echo 'active'; ?>">
                                                <a href="<?php echo BACKEND_URL.'property/'?>"><i class="glyphicon glyphicon-home"></i>
                                                <span class="submenu-title">Property List</span></a>
                                     </li>
                                     
                                      <li class="<?php if(currentClass()=='property_facility' && (currentMethod()=='index' || currentMethod()=='add' || currentMethod()=='edit'))echo 'active'; ?>">
                                                <a href="<?php echo BACKEND_URL.'property_facility/'?>"><i class="glyphicon glyphicon-home"></i>
                                                <span class="submenu-title">Property Facilities</span></a>
                                     </li>
                                     <li class="<?php if(currentClass()=='property_approval' && (currentMethod()=='index'))echo 'active'; ?>">
                                                <a href="<?php echo BACKEND_URL.'property_approval/'?>"><i class="glyphicon glyphicon-home"></i>
                                                <span class="submenu-title">Property Approval</span></a>
                                     </li>
                                     
                                     
                        </ul>
                    </li>
                 
                      
            
            <li class='<?php if( currentClass()=='hear_about' || currentClass()=='province' || currentClass()=='city' || currentClass()=='room_type' || currentClass() =='currency' || currentClass() =='policies') echo 'active'; ?>'>
                <a href="javascript:void(0);">
                            <i class="glyphicon glyphicon-folder-open">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Master</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                   
                    <li class="<?php if(currentClass()=='hear_about' && (currentMethod()=='index' || currentMethod()=='add_hear_about' || currentMethod()=='edit_hear_about'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'hear_about/'?>"><i class="glyphicon glyphicon-thumbs-up"></i>
                            <span class="submenu-title">Hear About</span></a>
                    </li>
                    <li class="<?php if(currentClass()=='policies' && (currentMethod()=='index' || currentMethod()=='add_policies' || currentMethod()=='edit_policies'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'policies/'?>"><i class="glyphicon glyphicon-thumbs-up"></i>
                            <span class="submenu-title">Policies</span></a>
                    </li>
                    
                    <!--<li class="<?php //if(currentClass()=='language' && (currentMethod()=='index' || currentMethod()=='add_language' || currentMethod()=='edit_language'))echo 'active'; ?>">
                            <a href="<?php //echo BACKEND_URL.'language/'?>"><i class="fa fa-comment"></i>
                            <span class="submenu-title">Language</span></a>
                    </li>-->
                    
                    <li class="<?php if(currentClass()=='province' && (currentMethod()=='index' || currentMethod()=='add_province' || currentMethod()=='edit_province'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'province/'?>"><i class="fa fa-flag-checkered"></i>
                            <span class="submenu-title">Province</span></a>
                    </li>
                    
                    <li class="<?php if(currentClass()=='city' && (currentMethod()=='index' || currentMethod()=='add_city' || currentMethod()=='edit_city'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'city/'?>"><i class="fa fa-flag"></i>
                            <span class="submenu-title">City</span></a>
                    </li>
                    
                    <li class="<?php if(currentClass()=='room_type' ) echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'room_type/'?>"><i class="fa fa-home"></i>
                            <span class="submenu-title">Room Type Management</span></a>
                    </li>
                    
                     <li class="<?php if(currentClass()=='currency' && (currentMethod()=='index' ))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'currency/'?>"><i class="fa fa-money"></i>
                            <span class="submenu-title">Currency</span></a>
                    </li>
                                      
                </ul>
            </li>
              <li class='<?php if(currentClass()=='cms' || currentClass()=='banner' || currentClass()=='feature' || currentClass()=='faq' || currentClass()=='image' || currentClass()=='seo_saleslanding' || currentClass()=='homecontent' || currentClass()=='seo_rental' || currentClass()=='team' || currentClass()=='footer') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'cms/index/'?>">
                            <i class="fa fa-file">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">CMS</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if(currentClass()=='cms' && (currentMethod()=='index' || currentMethod()=='add_cms' || currentMethod()=='edit_cms'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cms/index/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">CMS Pages</span></a>
                    </li>
                    <li class="<?php if(currentClass()=='banner' && (currentMethod()=='index' || currentMethod()=='add_banner' || currentMethod()=='edit_banner'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'banner/index/'?>"><i class="fa fa-picture-o"></i>
                            <span class="submenu-title">Banner</span></a>
                    </li>

                    
                   <!-- <li class="<?php if(currentClass()=='homecontent' && (currentMethod()=='index' || currentMethod()=='edit_homecontent'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'homecontent/index/'?>"><i class="fa fa-home"></i>
                            <span class="submenu-title">Home Content</span></a>
                    </li>-->
                    
                    <li class="<?php if(currentClass()=='faq' && (currentMethod()=='index' || currentMethod()=='add_faq_master' || currentMethod()=='edit_faq_master'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'faq/index'?>"><i class="fa fa-question"></i>
                            <span class="submenu-title">FAQ</span></a>
                    </li>

                     <li class="<?php if(currentClass()=='team' && (currentMethod()=='index' || currentMethod()=='add_team_member' || currentMethod()=='edit_team_member'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'team/index/'?>"><i class="fa fa-group"></i>
                            <span class="submenu-title">Team</span></a>
                    </li>                   
                   
                </ul>
            </li>
            
            <li class="<?php if(currentClass()=='reviews') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'reviews/'; ?>">
                                    <i class="fa fa-comments">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Reviews</span>
                                    
                        </a>
                        
            </li>
            <li class="<?php if(currentClass()=='enquiry') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'enquiry/'; ?>">
                                    <i class="fa fa-comments">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="fa arrow"></span>
                                    <span class="menu-title">Enquiry</span>
                        </a>
                        <ul class="nav nav-second-level">
                   
                                    <li class="<?php if(currentClass()=='enquiry' && (currentMethod()=='contact_us' ))echo 'active'; ?>">
                                            <a href="<?php echo BACKEND_URL.'enquiry/contact_us/'?>"><i class="fa fa-comments"></i>
                                            <span class="submenu-title">Contact Us Form</span></a>
                                    </li>
                                    
                                    <li class="<?php if(currentClass()=='enquiry' && (currentMethod()=='index' ))echo 'active'; ?>">
                                            <a href="<?php echo BACKEND_URL.'enquiry/index/'?>"><i class="fa fa-comments"></i>
                                            <span class="submenu-title">Enquiry</span></a>
                                    </li>
                        </ul>
            </li>
            
            <li class="<?php if(currentClass()=='email_template') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'email_template/'; ?>">
                                    <i class="fa fa-envelope-o">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Email Template</span>
                        </a>
            </li>

            <li class="<?php if(currentClass()=='site_setting' ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'site_setting/index/'; ?>">
                                    <i class="fa fa-cogs">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Site Setting</span>
                        </a>
            </li>
            
            <li class='<?php if(currentClass()=='sitemap') echo 'active'; ?>'>
                <a href="#">
                           <i class="fa fa-gear">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Tools</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">                   
                    <li class="<?php if(currentClass()=='sitemap')echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'sitemap/index/'?>"><i class="fa fa-sitemap"></i>
                            <span class="submenu-title">Sitemap Generator</span></a>
                    </li>
                </ul>
            </li>
            
            <li class="<?php if(currentClass()=='news_letter' ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'news_letter/index/'; ?>">
                                    <i class="fa fa-info-circle">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Newsletter Listing</span>
                        </a>
            </li>
            <li class="<?php if(currentClass()=='agent') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'agent/'; ?>">
                                    <i class="fa fa-user-md">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Agent Management</span>
                        </a>
            </li>
            <li class="<?php if(currentClass()=='booking') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'booking/'; ?>">
                                    <i class="fa fa-user-md">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Booking Details</span>
                        </a>
            </li>
            
            <li class="<?php if(currentClass()=='discountcode') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'discountcode/'; ?>">
                                    <i class="fa fa-user-md">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Discount Code</span>
                        </a>
            </li>
            <li class="<?php if(currentClass()=='deal_city') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'deal_city/'; ?>">
                                    <i class="fa fa-user-md">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Deal City</span>
                        </a>
            </li>
            
           
            
            
        
                </ul>
            </div>
        </nav>