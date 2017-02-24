<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                   <!-- <div class="page-title">View Enquiry</div>-->
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <!--<li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
                    <li><a href="#"><i class="fa fa-user"></i>&nbsp;&nbsp;User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="<?php echo $edit_url;?>">Social User Details</a></li>
                </ol>
                <div class="clearfix"></div>
</div>

<div class="page-content">
<div id="form-layouts" class="row">
                    <div class="col-lg-12">
     
                    <div class="note note-info"><h4 class="box-heading">View Social User Details</h4>

                    </div>
                    </div>
                    
                    <div class="col-lg-12">
                       
<div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            <div id="tab-form-bordered" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-lg-12">
                                             
                                        <div class="panel panel-blue">
                                            <div class="panel-heading">View Social User Details</div>
                                            <div class="panel-body pan">
                                                <form action="#" class="form-horizontal form-bordered">
                                                    <div class="form-body">
                                                       
                                                        <div class="form-group">
                                                        
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                       
                                                        <table class="table table-bordered table-advanced">
                                                            <tr>
                                                                <td style=" width: 10%;"><b>First Name :</b></td>
                                                                <td style=" width: 10%;"><?php echo ucfirst(stripslashes($userList[0]['user_details']['first_name']));?></td>
                                                                <td style=" width: 10%;"><b>Last Name :</b></td>
                                                                <td style=" width: 10%;"><?php echo ucfirst(stripslashes($userList[0]['user_details']['last_name']));?></td>
                                                                <td style=" width: 10%;"><b>Email :</b></td>
                                                                <td style=" width: 10%;"><?php echo stripslashes($userList[0]['user_details']['email']);?></td>			
                                                            </tr>				    
                
                                                            <tr>
                                                                <td style=" width: 10%;"><b>Provider Name :</b></td>
                                                                <td style=" width: 10%;"><?php echo ucfirst(stripslashes($userList[0]['user_details']['provider']));?></td>
                                                                <td style=" width: 10%;"><b>Last Logged In :</b></td>
                                                                <td style=" width: 10%;"><?php echo date("d/m/Y H:i:s", strtotime($userList[0]['user_details']['last_logged_in']));?></td>
                                                                <td style=" width: 10%;"><b>Added Date :</b></td>
                                                                <td style=" width: 10%;"><?php echo date("d/m/Y H:i:s", strtotime($userList[0]['user_details']['db_add_date']));?></td>		
                                                            </tr>				    
                                                        </table>  
                                                       
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="selCountry" class="col-md-7 control-label"><h4><b>Property List</b></h4></label>
                                                        
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <?php
                                                            if(isset($userList[0]['fav_listing']) && is_array($userList[0]['fav_listing']) && count($userList[0]['fav_listing'])>0)
                                                            {
                                                        ?>
                                                        
                                                        <table class="table table-bordered table-advanced">
                                                        <thead>
                                                        <tr>
                                                                       
                                                                        <td><b>Property Name</b></td>
                                                                        <td><b>Optional Title</b></td>
                                                                        <td><b>Property Type</b></td>
                                                                        <td><b>Status</b></td>
                                                                        
                                                        </tr>
                                                        </thead>
                                                        
                                                        <tbody >
                                                        <?php 
                                                            if($userList[0]['fav_listing']){
                                                            for($i=0; $i<count($userList[0]['fav_listing']); $i++){                                
                                                               // echo '<pre>';
                                                                   // print_r($userList[0]['fav_listing']);
                                                                   
                                                                   // echo '</pre>';
                                                                   
                                                                    //$class = 'class="even"';
                                                                   //if($i%2==0)
                                                                    //        $class = 'class="even"';
                                                                    //else
                                                                    //        $class = 'class="odd"';
                                                        ?>
                                                        <tr>
                                                            <td><?php echo stripslashes($userList[0]['fav_listing'][$i]['property_name']);?></td>
                                                            <td><?php echo stripslashes($userList[0]['fav_listing'][$i]['optional_title']);?></td>
                                                            <td><?php echo stripslashes($userList[0]['fav_listing'][$i]['record_type']);?></td>
                                                            <td><?php echo ucfirst($userList[0]['fav_listing'][$i]['status']); ?></td>
                                                        </tr>
                                                        </tbody >
                                                        <?php } } else { ?>
                                                        <tr><td colspan="4" align="center">..::..No records found..::..</td></tr> 
                                                        <?php } ?>
                                                    </table>
                                                         <?php
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                         <label for="selCountry" class="col-md-6 control-label"><h4>N/A</h4></label>
                                                            
                                                        <?php
                                                            }
                                                        ?>	
                                                        </div>
                                                        </div>
                                                    </div>
                                                      
                                                    </div>
                                                    <div class="form-actions text-right pal">
                                                        <!--<button type="submit" class="btn btn-primary">Submit</button>
                                                        &nbsp;-->
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