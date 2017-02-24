 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">DashBoard</div>
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
                <div id="table-action" class="row">
		  <div class="col-lg-12 ">
		    <div class="panel panel-blue portlet box portlet-red">
			  <div class="portlet-header">
			    <div class="caption">Analytics </div>
			    <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
			  </div>
		      <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
			  <div class="col-lg-12">
			              
                <h5 class="box-heading">Analytics Search Panel</h5>                             
                <form name="perPageFrm" class="form-horizontal" id="perPageFrm" method="get" action="<?php echo BACKEND_URL;?>dashboard/index">
                <input type="hidden" name="action" value="Process" />
                <div class="form-body pal">
                    <div class="form-group">
                                <label class="col-md-1 control-label">Range</label>
                                <div class="col-md-8">
                                    <div class="input-group input-daterange">
                                       
                                        <input type="text" name="startdate" id="startdate" class="form-control" value="<?php echo $start ?>" readonly="readonly"/>
                                        <span class="input-group-addon">To</span>
                                        <input type="text" name="enddate" id="enddate" class="form-control" value="<?php echo $end ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            
                    </div>
                    </div>
                
                </form>
           
	         <div class="col-sm-6 col-md-3">
                <div class="panel income db mbm ">
                    <div class="panel-body">
		      <div class="col-sm-6">
                        <p class="icon">
                            <i class="icon fa fa-group"></i>
                        </p>
                        </div>
		      <div class="col-sm-6">
                        <p class="description">
                            <h4><span style="font-size:35px;"><?php echo $record['total_users'] ?></span></h4>
                            <h5> Users </h5>
                        </p>
                      </div>  
                    </div>
                </div>
            </div>
			  <div class="col-sm-6 col-md-3">
                <div class="panel income db mbm">
                <div class="panel-body">
		  <div class="col-sm-3">
                        <p class="icon">
                            <i class="icon fa fa-file-text-o"></i>
                        </p>
		  </div>
                      <div class="col-sm-9">
                        <p class="description">
                            <h4><span style="font-size:35px;"><?php echo $record['total_page_views_per_session'] ?></span></h4>
                            <h5> Pages / Session </h5>
                        </p>
		      </div>
                    </div>
                </div>
            </div>
		      
		       <div class="col-sm-6 col-md-3">
                <div class="panel income db mbm">
                <div class="panel-body">
		  <div class="col-sm-3">
                        <p class="icon">
                            <i class="icon fa fa-clock-o"></i>
                        </p>
		  </div>
		  <div class="col-sm-9">
                        <p class="description">
                            <h4><span style="font-size:21px;"><?php
                            $seconds = $record['total_avg_session_duration'];
                            $hours = floor($seconds / 3600);
                            $mins = floor(($seconds - ($hours * 3600)) / 60);
                            $secs = floor($seconds % 60);
                            echo sprintf("%02s",$hours)." : ".sprintf("%02s",$mins)." : ".sprintf("%02s",$secs); ?></span></h4>
                            <h5> Avg. Session Duration </h5>
                        </p>
		  </div>
                    </div>
                </div>
            </div>
		    
		    <div class="col-sm-6 col-md-3">
                <div class="panel income db mbm">
                 <div class="panel-body">
		  <div class="col-sm-3">
                        <p class="icon">
                            <i class="icon fa fa-file-text-o"></i>
                        </p>
		  </div>
		  <div class="col-sm-9">
                        <p class="description">
                            <h4><span style="font-size:30px;"><?php echo $record['total_bounce_rate']." %" ?></span></h4>
                            <h5> Bounce Rate </h5>
                        </p>
		 </div>
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
                      <div class="caption">Currency Converted Rate (<?php echo DEFAULT_CURRENCY; ?>) </div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    
                    <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
                        <div class="col-lg-12">
			  <br class="spacer" />
			  <?php
			  
                            if(is_array($currency_record) ){
                                    foreach($currency_record as $index=>$c) { ?>
                                         <div class="col-md-4">
                                            <div class="panel income db mbm">
                                              <div class="panel-body">
						<div class="col-md-6">
                                                <h4><?php echo $c['currency_rate']; ?>
                                                <?php echo $c['currency_code']; ?></h4>
                                                
						</div>
						<div class="col-md-6">
                                                <p class="icon">
                                                    <i class="fa fa-<?php echo strtolower($c['currency_code']); ?>" style="color: #0A819C;"></i>
                                                </p>
						</div>
						
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
<div class="panel panel-blue portlet box portlet-yellow">
        <div class="portlet-header">
          <div class="caption">General </div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
        </div>
    <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
        <div class="col-lg-12">
            <br class="spacer" />
      
      <!-- rental-sales-enquery -->
      <div  class="row mbl">
        <div class="col-md-4">
          <div class="panel profit db mbm">
            <div class="panel-body">
	      <div class="col-sm-3">
              <p class="icon"> <i class="fa fa-building-o" style="color: #6F9EF7;"></i> </p>
	      </div>
              <div class="col-sm-9">
              <h4>  <a href="<?php echo BACKEND_URL.'property/add/'; ?>">Add Hostel </a> </h4>
	      </div>
              </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel task db mbm">
            <div class="panel-body">
	      <div class="col-sm-3">
              <p class="icon"> <i class="glyphicon glyphicon-envelope" style="color: #F45D73;"></i> </p>
	      </div>
            <div class="col-sm-9">
              <h4><a href="<?php echo BACKEND_URL.'enquiry/'; ?>">Enquiry</a></h4>
	    </div>
               </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel visit db mbm">
            <div class="panel-body">
	      <div class="col-sm-3">
              <p class="icon"> <i class="fa fa-file-text" style="color: #67CAD3;"></i> </p>
	      </div>
              <div class="col-sm-9">
              <h4>  <a href="#">Report </a> </h4>
	      </div>
              </div>
          </div>
        </div>
      </div>

        <div style="clear: both"></div> 
      </div>
      </div>
      </div>

      
                </div>
            
		   <div class="col-lg-12">
		    <div class="panel panel-blue portlet box portlet-green">
        <div class="portlet-header">
          <div class="caption">Enquiry </div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
        </div>
    <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
        <div class="col-lg-12">
            <br class="spacer" />
      
      <!-- rental-sales-enquery -->
      <div  class="row mbl">
         <div class="col-md-4">
	  <div class="panel profit db mbm">
	    <div class="panel-body">
	      <div class="col-sm-3">
              <p class="icon"> <i style="color: #5C7DAA;" class="fa fa-envelope"></i> </p>
	      </div>
              <div class="col-sm-9">
		    <div class="description">
		  <h4><span style="font-size:45px;"><?php echo $enquiry['seven_days'];?></span><br/> Enquiry (7 Days)</h4>
		  
		   
		  </div>
	      </div>
              </div>
	  </div>
	 </div>
	 
	          <div class="col-md-4">
	  <div class="panel profit db mbm">
	    	    <div class="panel-body">
		      <div class="col-sm-3">
			  <p class="icon"> <i style="color: #5C7DAA;" class="fa fa-envelope"></i> </p>
		      </div>
              <div class="col-sm-9">
		      <div class="description">
		    <h4><span style="font-size:45px;"><?php echo $enquiry['one_month'];?></span><br/> Enquiry (1 Month)</h4>
		   
		    
		    </div>
	      </div>
              </div>

	  </div>
	 </div>

         <div class="col-md-4">
	  <div class="panel profit db mbm">
	    	    <div class="panel-body">
		       <div class="col-sm-3">
			    <p class="icon"> <i style="color: #5C7DAA;" class="fa fa-envelope"></i> </p>
		       </div>
               <div class="col-sm-9">
		    <div class="description">
		  <h4><span style="font-size:45px;"><?php echo $enquiry['all'];?></span><br/>Enquiry (All)</h4>
		 
		  
		  </div>
	       </div>
              </div>

	  </div>
	 </div>

      </div>

        <div style="clear: both"></div> 
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