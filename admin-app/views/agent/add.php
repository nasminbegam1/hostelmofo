 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Agent</div>
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
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <div class="portlet-header">
                                                    <div class="caption">Agent Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="firstname" type="text" placeholder="First Name" class="form-control required firstname" id="firstname" value="<?php echo set_value('firstname'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input name="lastname" type="text" placeholder="Last Name" class="form-control required lastname" id="lastname" value="<?php echo set_value('lastname'); ?>"/>
                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="inputDob" class="col-md-3 control-label">Date of Birth</label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
								    <select name="dob[day]">
									<option value="">Day</option>
									<?php for($i = 1;$i<=31;$i++){
									$i = ($i >9 ?$i:'0'.$i);
									?>
									<option value="<?php echo $i;?>"><?php echo $i;?></option>  
									<?php } ?>
									
								    </select>
								    <select name="dob[month]">
									<option value="">Month</option>
									<?php for($m = 1;$m<=12;$m++){
									$m = ($m >9 ?$m:'0'.$m);
									?>
									<option value="<?php echo $m;?>"><?php echo $m;?></option>  
									<?php } ?>
									
								    </select>
								    <?php
								    $startyear = date('Y')-16;
								    $endyear   = $startyear- 84;
								    ?>
								    <select name="dob[year]">
									<option value="">Year</option>
									<?php for($y = $startyear;$y>=$endyear;$y--){ ?>
									<option value="<?php echo $y;?>"><?php echo $y;?></option>  
									<?php } ?>
									
								    </select>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="inputGender" class="col-md-3 control-label">Gender <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <div class="input-icon">
								    <select name="gender" id="gender" class="form-control required">
									<option value="">Gender</option>
									<option value="Male" <?php echo set_value('gender') == 'Male'? 'selected':''; ?>>Male</option>
									<option value="Female" <?php echo set_value('gender') == 'Female'? 'selected':''; ?>>Female</option>
								    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Location <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    <input type="text" id="location" name="location"  placeholder="Location" class="form-control required" data-type="location" value="<?php echo set_value('location'); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Nationality <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <div class="input-icon">
								    <select name="nationality" id="nationality" class="form-control required">
									<option value="">Nationality</option>
									<?php if(is_array($countryList)){
									foreach($countryList as $cList){
									?>
									<option value="<?php echo $cList['idCountry']; ?>" <?php echo set_value('nationality') == $cList['idCountry']? 'selected':''; ?>><?php echo stripslashes($cList['countryName'])?></option>  
									<?php } } ?>
								    </select>
                                                                </div>
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Email <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email" name="email"  placeholder="Email Address" class="form-control required" data-type="email" value="<?php echo set_value('email'); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password" class="col-md-3 control-label">Password <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?php echo set_value('password'); ?>">
								                            </div>
							    
                                                        </div>
                                                        <div class="form-group"><label for="reg_password_repeat" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?php echo set_value('conf_password'); ?>">
                                                            </div>
                                                        </div>                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Agent</button>
                                                        &nbsp;
                                                        <a class="btn btn-green" href="<?php echo $base_url; ?>">Return</a>
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