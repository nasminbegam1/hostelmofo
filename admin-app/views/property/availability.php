 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">  Property  Availability </div>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption"> Availability Calendar </div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
  
                                                            <div class="col-md-12">
                                                              <div class="year_choose clearfix">
								<span class="check_year left"><a href="<?php echo $prev_url;?>"><?php echo "&lt;&lt;&nbsp;Previous Year";?></a></span>
								<span class="current_year"><?php echo $year;?></span>
								<span class="check_year right"><a href="<?php echo $next_url;?>"><?php echo "Next Year&nbsp;&gt;&gt;";?></a></span>
							      </div>
				 <div style="width:300px;margin: 0 auto 10px;">
				    <table width="300" cellspacing="0" cellpadding="0" border="0" class="availability_calender">	  
				       <tr class="day_view">
					  <td style="width:25px !important;"><span class="chkin unavailable">In</span></td>
					  <td ><span class=" unavailable" >Booked/Unavailable</span></td>
					  <td style="width:25px !important;"><span class="chkout">Out</span></td>
				       </tr>
				    </table>
				    </div> 			      
							      
							      <?php
							      
							      
							      for($i=1;$i<=12;$i++)
							      {
								$unavailable = $this->model_property->availableDate($year,$i,$property_id);?>
								<div class="col-md-6">
								    <div class="calTable">
								<?php echo $this->calendar->generate($year,$i,$unavailable);?>
</div></div>
							    <?php }
							      ?>
							      
                                        
					                                                      
			
					
					                       
                                                            </div>
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