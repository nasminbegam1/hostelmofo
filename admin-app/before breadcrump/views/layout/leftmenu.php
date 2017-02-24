<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                        
                        
                    <?php
                    $currentController	= $this->router->class;
                    $currentMethod	= $this->router->method;
                    $page		= $this->uri->segment(5);
                    ?>
                        
                        
                    <li class="user-panel">
                        
                        <div class="thumb">
                                    
                                    <?php if($user_image!='')
                                                {
                                                    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$user_image) && $user_image != "")
                                                    {
                                                        $user_image1 = FILE_UPLOAD_URL."admin/".$user_image;
                                                    ?>
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        $user_image1 = FILE_UPLOAD_URL."admin/userLogin2.png";
                                                    ?>
                                                    
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                               
                                                    $user_image1 = FILE_UPLOAD_URL."admin/userLogin2.png"; ?>
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
                   
                    <li class="<?php if($currentController=='dashboard' || $currentController=='profile' ) echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'dashboard/'; ?>">
                                    <i class="fa fa-tachometer fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="<?php if($currentController=='site_setting' ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'site_setting/index'; ?>">
                                    <i class="fa fa-cogs">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Site Setting</span>
                        </a>
                    </li>
                    
                   
                    <li class='<?php if($currentController=='user' || $currentController=='va_user' || $currentController=='agent' ) echo 'active'; ?>'>
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
                        <li class='<?php if(($currentController=='user' || $currentController=='va_user' || $currentController=='agent' || $currentController=='user_fav') && ($currentMethod=='adminadd' ||  $currentMethod=='adminuser' || $currentMethod=='adminedit') ) echo 'active'; ?>'>
                          <a href="<?php echo BACKEND_URL.'user/adminuser'?>"><i class="fa fa-user"></i>
                          <span class="submenu-title">Admin Users</span></a>
                        </li>

                       
                        <li class='<?php if(($currentController=='user' || $currentController=='va_user' || $currentController=='agent' || $currentController=='user_fav') && ($currentMethod=='vauser' ||  $currentMethod=='addvauser' || $currentMethod=='editvauser') ) echo 'active'; ?>'>
                            <a href="<?php echo BACKEND_URL.'va_user/vauser'?>"><i class="fa fa-user"></i>
                            <span class="submenu-title">VA Users</span></a>
                        </li>
                        
                         <li class='<?php if(($currentController=='user' || $currentController=='va_user' || $currentController=='agent' || $currentController=='user_fav') && ($currentMethod=='index' ||  $currentMethod=='addagent' || $currentMethod=='editagent') ) echo 'active'; ?>'>
                            <a href="<?php echo BACKEND_URL.'agent/index'?>"><i class="fa fa-user"></i>
                            <span class="submenu-title">Agent</span></a>
                        </li>
                        
                        
                        
                        </ul>
                    </li>
                  
                    
                    <li class='<?php if($currentController=='property_sales' || $currentController=='property_rental'  || $currentController=='longrentals') echo 'active'; ?>'>
                        <a href="#">
                                    <i class="glyphicon glyphicon-home">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                                    <span class="menu-title">Property</span>
                                    <span class="fa arrow"></span>
                                    <span class="label label-yellow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                           
                            <li class="<?php if($currentController=='property_rental' && ($currentMethod=='index' || $currentMethod=='add_reatalproperty' || $currentMethod=='edit_rentalproperty' || $currentMethod=='contact' || $currentMethod=='edit_map_location' || $currentMethod=='images' || $currentMethod=='payment' || $currentMethod=='ical' || $currentMethod=='price'))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'property_rental/index'?>"><i class="fa fa-building-o"></i>
                                    <span class="submenu-title">Rental</span></a>
                            </li>
                             <li class="<?php if($currentController=='longrentals' && ($currentMethod=='index' ||  $currentMethod=='price' || $currentMethod=='edit_property' || $currentMethod=='edit_property_image'  || $currentMethod=='contact' || $currentMethod=='edit_map_location')) echo 'active'; ?>">
                                     <a href="<?php echo BACKEND_URL.'longrentals/index'?>"><i class="fa fa-building-o"></i>
                                    <span class="submenu-title">Long Term Rental</span></a>
                            </li>
   
                            <li class="<?php if($currentController=='property_sales' && ($currentMethod=='index' || $currentMethod=='add_property' || $currentMethod=='edit_property' || $currentMethod=='property_image' || $currentMethod=='contact' ||  $currentMethod=='edit_map_location' || $currentMethod=='floorplan_image' ))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'property_sales/'?>"><i class="fa fa-home"></i>
                                    <span class="submenu-title">Sales</span></a>
                            </li>
                         
                            
                        </ul>
                    </li>
                    
                    
                    
            <li class='<?php if($currentController=='kigo' || $currentController=='icalavailability' ) echo 'active'; ?>'>
                        <a href="#">
                                    <i class="fa fa-check-circle">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                           <span class="menu-title">Availability</span>
                           <span class="fa arrow"></span>
                           <span class="label label-yellow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                       <!----code--->
                        <li class="<?php if($currentController=='kigo' && ($currentMethod=='index' || $currentMethod=='details'))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'kigo/'?>"><i class="fa fa-building-o"></i>
                                    <span class="submenu-title">Kigo Availability</span></a>
                        </li>

                       
                        <li class="<?php if($currentController=='icalavailability' && ($currentMethod=='index' || $currentMethod=='details'))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'icalavailability'?>"><i class="fa fa-building-o"></i>
                                    <span class="submenu-title">iCal Availability</span></a>
                        </li>
                        
                        </ul>
            </li>
            <li class="<?php if($currentController=='enquiry' || $currentController=='property_share' || $currentController=='user_fav' ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'enquiry/index'?>">
                                    <i class="fa fa-envelope"></i>
                                   
                                    </i>
                           <span class="menu-title">Enquiry</span>
                           <span class="fa arrow"></span>
                          
                        </a>
                        <ul class="nav nav-second-level">
                        <li class="<?php if($currentController=='enquiry' && ($currentMethod=='index' || $currentMethod=='view_enquiry'))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'enquiry/index'?>"><i class="fa fa-question"></i>
                                    <span class="submenu-title">Enquiry List</span></a>
                        </li>
                        
                        <li class="<?php if($currentController=='property_share' && ($currentMethod=='listing' || $currentMethod=='view_enquiry'))echo 'active'; ?>">
                                    <a href="<?php echo BACKEND_URL.'property_share/listing'?>"><i class="fa fa-share-square-o"></i>
                                    <span class="submenu-title">Property Share</span></a>
                        </li>
                        
                        <li class='<?php if(($currentController=='user_fav' || $currentController=='property_share' || $currentController=='enquiry') && ($currentMethod=='list_user' ||  $currentMethod=='view_details') ) echo 'active'; ?>'>
                            <a href="<?php echo BACKEND_URL.'user_fav/list_user'?>"><i class="fa fa-user"></i>
                            <span class="submenu-title">User Favourite</span></a>
                        </li>
                        </ul>
            </li>


                    
            <li class='<?php if($currentController=='property_settings' || $currentController=='property_locations'  || $currentController=='map_location') echo 'active'; ?>'>
                <a href="#">
                            <i class="fa fa-cogs">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Property Settings</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if($currentController=='property_settings' && ($currentMethod=='types' || $currentMethod=='index' || $currentMethod=='add_types' || $currentMethod=='batch_action' || $currentMethod=='deletebatch'  || $currentMethod=='batchstatus'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_settings/types'?>"><i class="fa fa-building-o"></i>
                            <span class="submenu-title">Property Types Master</span></a>
                    </li>
                    <li class="<?php if(isset($page) && $page=='rent' && $currentController=='property_settings' && ($currentMethod=='amenities' || $currentMethod=='add_amenities' || $currentMethod=='edit_amenities'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_settings/amenities/0/0/rent'?>"><i class="fa fa-building-o"></i>
                            <span class="submenu-title">Rental Property Amenities Master</span></a>
                    </li>
                     <li class="<?php if(isset($page) && $page=='sales' && $currentController=='property_settings' && ($currentMethod=='sale_amenities' || $currentMethod=='add_amenities' || $currentMethod=='edit_amenities'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_settings/sale_amenities/0/0/sales'?>"><i class="fa fa-building-o"></i>
                            <span class="submenu-title">Sale Property Amenities Master</span></a>
                    </li>
                    <li class="<?php if(isset($page) && $page=='location' && $currentController=='property_locations' && ($currentMethod=='index' || $currentMethod=='add_location' || $currentMethod=='edit_location' || $currentMethod=='edit_outside_location'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_locations/index/0/0/location'?>"><i class="fa fa-map-marker"></i>
                            <span class="submenu-title">Location Master</span></a>
                    </li>
                    <li class="<?php if(isset($page) && $page=='outside' && $currentController=='property_locations' && ($currentMethod=='property_outside_locations' || $currentMethod=='add_outside_location' || $currentMethod=='edit_outside_location'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_locations/property_outside_locations/0/0/outside'?>"><i class="fa fa-map-marker"></i>
                            <span class="submenu-title">Outside Location Master</span></a>
                    </li>
                    <li class="<?php if($currentController=='property_locations' && ($currentMethod=='regions' || $currentMethod=='add_region'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_locations/regions/'?>"><i class="fa fa-map-marker"></i>
                            <span class="submenu-title">Region Master</span></a>
                    </li>
                    <!--<li class="<?php //if($currentController=='property_locations' && ($currentMethod=='viewtypes'))echo 'active'; ?>">
                            <a href="<?php //echo BACKEND_URL.'property_locations/viewtypes/'?>"><i class="fa fa-building-o"></i>
                            <span class="submenu-title">View Master</span></a>
                    </li>-->
                    <li class="<?php if($currentController=='property_locations' && ($currentMethod=='themetypes' || $currentMethod=='add_themetype' || $currentMethod=='edit_themetype'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'property_locations/themetypes/'?>"><i class="fa fa-building-o"></i>
                            <span class="submenu-title">Theme Master</span></a>
                    </li>
                    <li class="<?php if($currentController=='map_location' && ($currentMethod=='property_map_location' || $currentMethod=='add_map_location' || $currentMethod=='edit_map_location'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'map_location/property_map_location/'?>"><i class="fa fa-map-marker"></i>
                            <span class="submenu-title">Property Map Location Master</span></a>
                    </li>
                </ul>
            </li>
            
            <li class='<?php if($currentController=='misc') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'misc/currency_master'?>">
                            <i class="fa fa-wrench">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">MISC Settings</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if($currentController=='misc' && ($currentMethod=='currency_master' || $currentMethod=='add_currency_master' || $currentMethod=='edit_currency_master' || $currentMethod=='currency_details' || $currentMethod=='delete_currency_master' || $currentMethod=='currency_master_action'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'misc/currency_master'?>"><i class="fa fa-money"></i>
                            <span class="submenu-title">Currency Master</span></a>
                    </li>
                    <li class="<?php if($currentController=='misc' && ($currentMethod=='contact_us_category' || $currentMethod=='add_contact_us_category' || $currentMethod=='edit_contact_us_category' || $currentMethod=='delete_contact_us_category' || $currentMethod=='contact_us_category_batch'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'misc/contact_us_category'?>"><i class="fa fa-location-arrow"></i>
                            <span class="submenu-title">Contact Us Category Master</span></a>
                    </li>
                </ul>
            </li>
            
            <li class='<?php if($currentController=='order_listing' || $currentController=='custom_booking') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'custom_booking/listing'?>">
                            <i class="fa fa-bookmark">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Booking</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if($currentController=='custom_booking' && ($currentMethod=='listing' || $currentMethod=='view_booking' || $currentMethod=='viewcustom' || $currentMethod=='delete_booking'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'custom_booking/listing'?>"><i class="fa fa-check-square-o"></i>
                            <span class="submenu-title">Custom Booking Url</span></a>
                    </li>
                    
                    <li class="<?php if($currentController=='custom_booking' && ($currentMethod=='order' || $currentMethod=='view_order'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'custom_booking/order'?>"><i class="fa fa-check-square-o"></i>
                            <span class="submenu-title">Custom Booking Order</span></a>
                    </li>
                    
                    
                    <li class="<?php if($currentController=='order_listing' && ($currentMethod=='listing' || $currentMethod=='view_order_details' || $currentMethod=='edit'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'order_listing/listing'?>"><i class="fa fa-check-square"></i>
                            <span class="submenu-title">Order Listing</span></a>
                    </li>
                    
                </ul>
            </li>
            
            <li class='<?php if($currentController=='cms' || $currentController=='banner' || $currentController=='feature' || $currentController=='faq' || $currentController=='image' || $currentController=='seo_saleslanding' || $currentController=='homecontent' || $currentController=='seo_rental' || $currentController=='team') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'cms/index'?>">
                            <i class="fa fa-file">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">CMS</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if($currentController=='cms' && ($currentMethod=='index' || $currentMethod=='add_cms' || $currentMethod=='edit_cms'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cms/index'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">CMS Pages</span></a>
                    </li>
                    <li class="<?php if($currentController=='banner' && ($currentMethod=='index' || $currentMethod=='add_banner' || $currentMethod=='edit_banner'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'banner/index'?>"><i class="fa fa-picture-o"></i>
                            <span class="submenu-title">Banner</span></a>
                    </li>
                    <li class="<?php if($currentController=='feature' && ($currentMethod=='listview' || $currentMethod=='add_feature' || $currentMethod=='edit_feature'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'feature/listview'?>"><i class="fa fa-info-circle"></i>
                            <span class="submenu-title">As Featured In</span></a>
                    </li>
                    <li class="<?php if($currentController=='seo_rental' && ($currentMethod=='listing' || $currentMethod=='add' || $currentMethod=='edit_types'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'seo_rental/listing'?>"><i class="fa fa-file-text"></i>
                            <span class="submenu-title">SEO Rental Landing Pages</span></a>
                    </li>
                    <li class="<?php if($currentController=='seo_saleslanding' && ($currentMethod=='index' || $currentMethod=='add' || $currentMethod=='edit'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'seo_saleslanding/'?>"><i class="fa fa-info-circle"></i>
                            <span class="submenu-title">SEO Sales Landing Pages</span></a>
                    </li>
                    
                    <li class="<?php if($currentController=='homecontent' && ($currentMethod=='index' || $currentMethod=='edit_homecontent'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'homecontent/index'?>"><i class="fa fa-home"></i>
                            <span class="submenu-title">Home Content</span></a>
                    </li>
                    
                    <li class="<?php if($currentController=='faq' && ($currentMethod=='index' || $currentMethod=='add_faq_master' || $currentMethod=='edit_faq_master'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'faq/index'?>"><i class="fa fa-question"></i>
                            <span class="submenu-title">FAQ</span></a>
                    </li>
                    
                    <li class="<?php if($currentController=='image' && ($currentMethod=='index' || $currentMethod=='add_image' || $currentMethod=='edit_image'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'image/index'?>"><i class="fa fa-upload"></i>
                            <span class="submenu-title">Image Upload (Editor)</span></a>
                    </li>
                     <li class="<?php if($currentController=='team' && ($currentMethod=='index' || $currentMethod=='add_team_member' || $currentMethod=='edit_team_member'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'team/index'?>"><i class="fa fa-group"></i>
                            <span class="submenu-title">Team</span></a>
                    </li>  
                    
                   
                </ul>
            </li>
            
            
            
            
            <li class='<?php if($currentController=='cron') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'cron/listing'?>">
                           <i class="fa fa-road">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Distance To Beach Cron</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if($currentController=='cron' && ($currentMethod=='listing'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cron/listing'?>"><i class="fa fa-road"></i>
                            <span class="submenu-title">Distance To Beach</span></a>
                    </li>
                   
                </ul>
            </li>
            
            <li class='<?php if($currentController=='sitemap') echo 'active'; ?>'>
                <a href="#">
                           <i class="fa fa-envelope">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Reviews</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">                   
                    <li>
                            <a href="<?php echo BACKEND_URL.'reviews/index'?>"><i class="fa fa-question"></i>
                            <span class="submenu-title">Reviews List</span></a>
                    </li>
                </ul>
            </li>
            
            <li class='<?php if($currentController=='sitemap') echo 'active'; ?>'>
                <a href="#">
                           <i class="fa fa-gear">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">Tools</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">                   
                    <li class="<?php if($currentController=='sitemap' && ($currentMethod=='index'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'sitemap/index'?>"><i class="fa fa-sitemap"></i>
                            <span class="submenu-title">Sitemap Generator</span></a>
                    </li>
                </ul>
            </li>



                </ul>
            </div>
        </nav>