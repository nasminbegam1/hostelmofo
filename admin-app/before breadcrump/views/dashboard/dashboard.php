<!--BEGIN TITLE & BREADCRUMB PAGE-->

<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
  <div class="page-header pull-left">
    <div class="page-title">Dashboard</div>
  </div>
  <ol class="breadcrumb page-breadcrumb pull-right">
    <!--<li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0)">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
    <li class="hidden"><a href="<?php echo BACKEND_URL.'dashboard/'; ?>">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
    <li class="active"><a href="<?php echo BACKEND_URL.'dashboard/'; ?>">Dashboard</a></li>
  </ol>
  <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE--> 
<!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
  <div id="sum_box" class="row mbl">
    <div class="col-lg-12">
      <div class="panel panel-blue portlet box portlet-blue">
        <div class="portlet-header">
          <div class="caption">Analytics </div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
        </div>
        <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
          <div class="form-body pal">
            <h4 class="box-heading">Analytics Search Panel</h4>
            <form name="perPageFrm" class="form-horizontal" id="perPageFrm" method="get" action="<?php echo BACKEND_URL;?>dashboard/index">
              <input type="hidden" name="action" value="Process" />
              <div class="form-body pal">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="property_name" class="col-md-4 control-label"><b> Start Date </b></label>
                        <div class="col-md-8 input-daterange">
                          <input type="text" name="startdate" id="startdate" class="form-control" value="<?php echo $start ?>" readonly/>
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="page_title" class="col-md-4 control-label"><b>End Date</b></label>
                        <div class="col-md-8 input-daterange">
                          <input type="text" name="enddate" id="enddate" class="form-control" value="<?php echo $end ?>" readonly/>
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          
          <div class="panelResult">
            
                <div class="col-sm-6 col-md-3">
                  <div class="panel income db mbm">
                    <div class="panel-body">
                          <p class="icon"> <i class="icon fa fa-group" style="color: #6AF7A9;"></i>
                          </p>
                          <p class="description">
                          <h4><?php echo $record['total_users'] ?></h4>
                          <h5> Users </h5>
                          </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="panel visit db mbm">
                    <div class="panel-body">
                      <p class="icon"> <i class="icon fa fa-file-text-o" style="color: #F4AE75;"></i> </p>
                      <p class="description">
                      <h4><?php echo $record['total_page_views_per_session'] ?></h4>
                      <h5> Pages / Session </h5>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="panel visit db mbm">
                    <div class="panel-body">
                      <p class="icon"> <i class="icon fa fa-clock-o" style="color: #8E8CF2;"></i> </p>
                      <p class="description">
                      <h4>
                        <?php
                                  $seconds = $record['total_avg_session_duration'];
                                  $hours = floor($seconds / 3600);
                                  $mins = floor(($seconds - ($hours * 3600)) / 60);
                                  $secs = floor($seconds % 60);
                                  echo sprintf("%02s",$hours)." : ".sprintf("%02s",$mins)." : ".sprintf("%02s",$secs);
                        ?>
                      </h4>
                      <h5> Avg. Session Duration </h5>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3" >
                  <div class="panel visit db mbm">
                    <div class="panel-body">
                      <p class="icon"> <i class="fa fa-star-o" style="color: #F4C75D;"></i> </p>
                      <p class="description">
                      <h4><?php echo $record['total_bounce_rate']." %" ?></h4>
                      <h5> Bounce Rate </h5>
                      </p>
                    </div>
                  </div>
                </div>
      
          </div>
        </div>
      </div>
    </div>

     <div class="col-lg-12"> 
            <div class="panel panel-blue portlet box portlet-blue">
                    <div class="portlet-header">
                      <div class="caption">Currency Converted Rate (THB) </div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    
                    <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
                        <div class="col-lg-12">
                            <br class="spacer" />
                            <?php
                            if(is_array($currency_record) ){
                                    foreach($currency_record as $index=>$c) { ?>
                                         <div class="col-sm-6 col-md-3">
                                            <div class="panel income db mbm">
                                              <div class="panel-body">
                                                <?php
                                                $icon="";
                                                switch($c['currency_code']){
                                                    case "AUD": ?>
                                                <p class="icon">
                                                    <i class="fa fa-font" style="color: #0A819C;"></i>
                                                    <i class="fa fa-usd" style="color: #0A819C;"></i>
                                                </p>
                                                <?php    break;
                                                     default:
                                                ?>
                                                <p class="icon">
                                                    <i class="fa fa-<?php echo strtolower($c['currency_code']); ?>" style="color: #0A819C;"></i>
                                                </p>
                                                <?php
                                                        break;
                                                }
                                              
                                                ?>
                                                
                                                <p class="description">
                                                <h4> <?php echo $c['currency_rate']; ?></h4>
                                                <br />
                                                <?php echo $c['currency_code']; ?>
                                                </p>
                                              </div>
                                            </div>
                                          </div>
                            <?php        }
                            }?>
                            <div style="clear: both"></div>
                            <br class="spacer" />
                        </div>
                    </div>
            </div>
     </div>

     <div class="col-lg-12"> 
<div class="panel panel-blue portlet box portlet-blue">
        <div class="portlet-header">
          <div class="caption">General </div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
        </div>
    <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
        <div class="col-lg-12">
            <br class="spacer" />
      <!-----------------------rental-sales-enquery-------------------------->
      <div id="sum_box" class="row mbl">
        <div class="col-sm-6 col-md-3">
          <div class="panel profit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-building-o" style="color: #6F9EF7;"></i> </p>
              <a href="<?php echo BACKEND_URL.'property_rental/add_reatalproperty/'?>">
              <p class="description">
              <h5> Add Rental Property </h5>
              </p>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="glyphicon glyphicon-home" style="color: #F785D7;"></i> </p>
              <a href="<?php echo BACKEND_URL.'property_sales/add_property/'?>">
              <p class="description">
              <h5> Add Sales Property </h5>
              </p>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel task db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="glyphicon glyphicon-envelope" style="color: #F45D73;"></i> </p>
              <a href="#">
              <p class="description">
              <h5>Enquiry</h5>
              </p>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel visit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-file-text" style="color: #67CAD3;"></i> </p>
              <a href="#">
              <p class="description">
              <h5> Report </h5>
              </p>
              </a> </div>
          </div>
        </div>
      </div>
      
      <!-----------------------rental-sales--------------------------->
      <div id="sum_box" class="row mbl">
        <div class="col-sm-6 col-md-3">
          <div class="panel profit db mbm">
            <div class="panel-body">
              <p class="icon"><i class="fa fa-check-circle" style="color: #3B8E42;"></i> </p>
              <p class="description">
              <h4> <?php echo $liveDetails['rental_property_live'];?></h4>
              <br />
              Rental Property Live
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-times-circle" style="color: #F45D73;"></i> </p>
              <p class="description">
              <h4> <?php echo $liveDetails['rental_property_notlive'];?></h4>
              <br />
              Rental Property Not Live
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel task db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-check-circle-o" style="color: #3B8E42;"></i> </p>
              <p class="description">
              <h4> <?php echo $liveDetails['sales_property_live'];?></h4>
              <br />
              Sales Property Live
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel visit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-times-circle-o" style="color: #F45D73;"></i> </p>
              <p class="description">
              <h4> <?php echo $liveDetails['sales_property_notlive'];?></h4>
              <br />
              Sales Property Not Live
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-----------------------rental-sales-general all query-------------------------->
      
      <div id="sum_box" class="row mbl">
       
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #999E0E;"></i> </p>
              <p class="description">
              <h4><?php echo $rental['7days'];?></h4>
              <br />
              Rental Enquiry<br/>(7 Days)
              </p>
            </div>
          </div>
        </div>
      
       <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #5C7DAA;"></i> </p>
              <p class="description">
              <h4><?php echo $sales['7days'];?> </h4>
              <br />
              Sales Enquiry<br/>(7 Days)
              </p>
            </div>
          </div>
        </div>
      
       <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope-o" style="color: #F4AE75;"></i> </p>
              <p class="description">
              <h4><?php echo $genaral['7days'];?> </h4>
              <br />
              General Enquiry <br/>(7 Days)
              </p>
            </div>
          </div>
        </div>
       
       <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #67CAD3;"></i> </p>
              <p class="description">
              <h4><?php echo $all_enquiry['1month'];?> </h4>
              <br />
              All Enquiry<br/>(1 Month)
              </p>
            </div>
       
          </div>
       
       
        </div>
       <div style="clear: both"></div>
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
                
              <p class="icon"><i class="fa fa-check-circle" style="color: #3B8E42;"></i></p>
              <p class="description">
              
              <h4>
                <?php echo $genaral['avaliability_property']['percent']." %";?>
               
              </h4>
              <br />
              Live Properties <br/>(Avaliability)
              </p>
               <strong style="font-size:12px;line-height: 1px !important">
                    <?php echo $genaral['avaliability_property']['avaliability_property']
                             ." out of "
                             .$genaral['avaliability_property']['total_live']." Live Properties";?>
                </strong>
            </div>
       
          </div>
       </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
               
              <p class="icon"><i class="fa fa-check-circle" style="color: #3B8E42;"></i></p>
              <p class="description">
              <h4>
                <?php echo $genaral['booking_property']['percent']." %";?>
              
              </h4>
              <br />
              Live Properties <br/>(Online Booking)
              </p>
                 <strong style="font-size:12px">
                    <?php echo $genaral['booking_property']['booking_property']
                             ." out of "
                             .$genaral['booking_property']['total_live']." Properties";?>
                </strong>
            </div>
       
          </div>
        
       </div>
        
         <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"><i class="fa fa-check-circle" style="color: #3B8E42;"></i></p>
              <p class="description">
              <h4><?php if(isset($deal_percent)) { echo number_format($deal_percent,2)." %"; } ?> </h4>
              <br />
              Live Properties <br/>(Last Minute Deals)
              </p>
              <strong style="font-size:12px">
                    <?php echo $genaral['last_min_property']
                             ." out of "
                             .$genaral['booking_property']['total_live']." Properties";?>
                </strong>
            </div>
       
          </div>
        
       </div>
         
        <div style="clear: both"></div> 
      </div>
      </div>
      </div>
    </div>
      <!-----------------------rental--------------------------->
<!--      <div id="sum_box" class="row mbl">
        
        <div class="col-sm-6 col-md-3">
          <div class="panel profit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #999E0E;"></i> </p>
              <p class="description">
              <h4> <?php echo $rental['24hrs'];?></h4>
              <br />
              Rental Enquiry(24 Hrs)
              </p>
            </div>
          </div>
        </div>
      
       <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #999E0E;"></i> </p>
              <p class="description">
              <h4><?php echo $rental['7days'];?></h4>
              <br />
              Rental Enquiry(7 Days)
              </p>
            </div>
          </div>
        </div>
      
        <div class="col-sm-6 col-md-3">
          <div class="panel task db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #999E0E;"></i> </p>
              <p class="description">
              <h4><?php echo $rental['1month'];?></h4>
              <br />
              Rental Enquiry(1 Month)
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-3">
          <div class="panel visit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #999E0E;"></i> </p>
              <p class="description">
              <h4><?php echo $rental['3month'];?></h4>
              <br />
              Rental Enquiry(3 Month)
              </p>
            </div>
          </div>
        </div>
        
      </div>-->
      <!-----------------------sales--------------------------->
<!--      <div id="sum_box" class="row mbl">
        
        <div class="col-sm-6 col-md-3">
          <div class="panel profit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #5C7DAA;"></i> </p>
              <p class="description">
              <h4> <?php echo $sales['24hrs'];?></h4>
              <br />
              Sales Enquiry(24 Hrs)
              </p>
            </div>
          </div>
        </div>
      
        <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #5C7DAA;"></i> </p>
              <p class="description">
              <h4><?php echo $sales['7days'];?> </h4>
              <br />
              Sales Enquiry(7 Days)
              </p>
            </div>
          </div>
        </div>
      
          
      
        <div class="col-sm-6 col-md-3">
          <div class="panel task db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #5C7DAA;"></i> </p>
              <p class="description">
              <h4><?php echo $sales['1month'];?></h4>
              <br />
              Sales Enquiry(1 Month)
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-3">
          <div class="panel visit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope" style="color: #5C7DAA;"></i> </p>
              <p class="description">
              <h4><?php echo $sales['3month'];?> </h4>
              <br />
              Sales Enquiry(3 Month)
              </p>
            </div>
          </div>
        </div>
        
      </div>-->
      
      <!-----------------------general--------------------------->
      
<!--      <div id="sum_box" class="row mbl">
        
       <div class="col-sm-6 col-md-3">
          <div class="panel profit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope-o" style="color: #F4AE75;"></i> </p>
              <p class="description">
              <h4> <?php echo $genaral['24hrs'];?></h4>
              <br />
              General Enquiry (24 Hrs)
              </p>
            </div>
          </div>
        </div>
      
       <div class="col-sm-6 col-md-3">
          <div class="panel income db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope-o" style="color: #F4AE75;"></i> </p>
              <p class="description">
              <h4><?php echo $genaral['7days'];?> </h4>
              <br />
              General Enquiry(7 Days)
              </p>
            </div>
          </div>
        </div>
      
      <div class="col-sm-6 col-md-3">
          <div class="panel task db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope-o" style="color: #F4AE75;"></i> </p>
              <p class="description">
              <h4><?php echo $genaral['1month'];?></h4>
              <br />
              General Enquiry(1 Month)
              </p>
            </div>
          </div>
        </div>
        
       <div class="col-sm-6 col-md-3">
          <div class="panel visit db mbm">
            <div class="panel-body">
              <p class="icon"> <i class="fa fa-envelope-o" style="color: #F4AE75;"></i> </p>
              <p class="description">
              <h4><?php echo $genaral['3month'];?> </h4>
              <br />
              General Enquiry(3 Month)
              </p>
            </div>
          </div>
        </div>
        
      </div>-->
      <!--------------------------------->
      <div class="row mbl">
        <div class="col-lg-4">
          <div class="panel">
            <div class="panel-body">
              <div class="profile">
                <div style="margin-bottom: 15px" class="row">
                  <div class="col-xs-12 col-sm-8">
                    <h2><?php echo stripslashes($fname).' '.stripslashes($lname); ?></h2>
                    <p><strong>Email:</strong> <?php echo $email ;?></p>
                  </div>
                  <div class="col-xs-12 col-sm-4 text-center">
                    <figure><img src="<?php echo FILE_UPLOAD_URL."admin/".$image; ?>" alt="" style="display: inline-block" class="img-responsive img-circle"/> 
                      <!--figcaption class="ratings"><p><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star"></span></a><a href="#"><span class="fa fa-star-o"></span></a></p></figcaption>--> 
                    </figure>
                  </div>
                </div>
                <div class="row text-center divider">
                  <div class="col-xs-12 col-sm-4 emphasis"> </div>
                  <div class="col-xs-12 col-sm-4 emphasis"><!--<h2><strong>245</strong></h2>--> 
                    <a href="<?php echo BACKEND_URL.'profile/index/'; ?>">
                    <button class="btn btn-blue btn-block">Profile</button>
                    </a> </div>
                  <div class="col-xs-12 col-sm-4 emphasis"> </div>
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
    $(function(){
       $(".input-daterange #startdate").datepicker();
       $(".input-daterange #enddate").datepicker({
          defaultDate:$(".input-daterange #startdate").val()
        });
    });
</script>