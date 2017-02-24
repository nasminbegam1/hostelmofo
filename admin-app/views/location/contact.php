 <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Property Contact</div>
                </div>
                 <!--For breadcrump-->    
                <ol class="breadcrumb page-breadcrumb pull-right">
                  <?php
                  $tot	=	count($brdLink);
                  if(isset($brdLink) && is_array($brdLink)){
                  foreach($brdLink as $k=>$v){?>
                    <li><i class="<?php echo $v['logo'];?>">&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
                      <?php if($tot != $k+1)
                          echo "&nbsp;>&nbsp;";
                      ?>
                    </li>
                  <?php }}?>
                </ol>  
                <!--For breadcrump end-->
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
		    
                    <div class="col-lg-12">
        
			    
 <form action="<?php echo BACKEND_URL.'property/contact' ?>" class="form-horizontal" id="propertyAddFrm" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="process"/>
                                                <div class="form-group"><label for="address" class="col-sm-3 control-label">Address<span class='require'>*</span> </label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="address" id="address"/><i class="alert alert-hide">Oops, address is required</i>
							</div>
							    
						    </div>
                                                </div>
                                                <div class="form-group"><label for="address2" class="col-sm-3 control-label">Address 2</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control" name="address2" id="address2"/>
							</div>
						    </div>
                                                </div>
                                                <div class="form-group"><label for="province_id" class="col-sm-3 control-label">Province</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-home"></i>
							    </span>
							    <select name="province_id" class="form-control" id="province_id">
								<option value="">Select Any province</option>
								    <?php if(is_array($province_type) and count($province_type)>0){ ?>
								    <?php foreach($province_type as $index=>$data){ ?>
								    <option value="<?php  echo $data['province_id']; ?>"><?php  echo stripslashes($data['province_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="zip_code" class="col-sm-3 control-label">Zip Code</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumb-tack"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control" name="zip_code" id="zip_code"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="city_id" class="col-sm-3 control-label">City</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-flag"></i>
							    </span>
							    <select name="city_id" id="proCityDropDown" class="form-control">
								
							    </select>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="contact_name" class="col-sm-3 control-label">Contact Name<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-user"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="contact_name" id="contact_name"/><i class="alert alert-hide">Oops, contact name is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="main_manager_email" class="col-sm-3 control-label">Contact Email</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control" name="main_manager_email" id="main_manager_email"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="email_address_booking" class="col-sm-3 control-label">Booking Email<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control requiredInput" name="email_address_booking" id="email_address_booking"/><i class="alert alert-hide">Oops, Booking email is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="website_address" class="col-sm-3 control-label">Website Address</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-magnet"></i>
							    </span>
							    <input type="text" placeholder="" class="form-control" name="website_address" id="website_address"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="phone_no" class="col-sm-3 control-label">Phone No<span class='require'>*</span></label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-phone"></i>
							    </span>
							     <input type="text" placeholder="" class="form-control requiredInput" name="phone_no" id="phone_no"/><i class="alert alert-hide">Oops, Phone no is required</i>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="mobile_address" class="col-sm-3 control-label">Mobile No</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-mobile"></i>
							    </span>
							     <input type="text" placeholder="" class="form-control" name="mobile_address" id="mobile_address"/>
							</div>
						    </div>
                                                </div>
						<div class="form-group"><label for="fax_no" class="col-sm-3 control-label">Fax No</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-phone-square"></i>
							    </span>
							     <input type="text" placeholder="" class="form-control" name="fax_no" id="fax_no"/>
							</div>
						    </div>
                                                </div>
<!--						<div class="form-group"><label for="language_id" class="col-sm-3 control-label">Language</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-bullhorn"></i>
							    </span>
							    <select name="language_id" class="form-control" id="language_id">
								<option value="">Select Any Language</option>
								    <?php if(is_array($language_list) and count($language_list)>0){ ?>
								    <?php foreach($language_list as $index=>$data){ ?>
								    <option value="<?php  echo $data['property_language_id']; ?>"><?php  echo stripslashes($data['property_language_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
-->
						<div class="form-group"><label for="hear_about_id" class="col-sm-3 control-label">Hear About us</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group">
							    <span class="input-group-addon">
								<i class="fa fa-thumbs-o-up"></i>
							    </span>
							    <select name="hear_about_id" class="form-control" id="hear_about_id">
								<option value="">Select Any type</option>
								    <?php if(is_array($hearabout_list) and count($hearabout_list)>0){ ?>
								    <?php foreach($hearabout_list as $index=>$data){ ?>
								    <option value="<?php  echo $data['hear_about_id']; ?>"><?php  echo stripslashes($data['hear_about_name']); ?></option>
								    <?php } ?>
								    <?php } ?>
							    </select>
							</div>
						    </div>
                                                </div>
					 <div class="action text-right button-box">
							<button type="submit" name="submit" value="Previous" class="btn btn-info button-previous" onclick="javascript:window.location.href='<?php echo $previous_url; ?>'">
							    <i class="fa fa-arrow-circle-o-left mrx"></i>
							    Previous
							</button>
							<button type="submit" name="submit" value="Next" class="btn btn-info">
							    Save and Next
							    <i class="fa fa-arrow-circle-o-right mlx"></i>
							</button>
						    </div>

</form>
		    </div>
		</div>
		