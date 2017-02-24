 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Analytics</div>
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
        <!-----------------------rental-sales-enquery-------------------------->
        <div id="sum_box" class="row mbl">        
            <div class="col-lg-12">
                <h5 class="box-heading">Analytics Search Panel</h5>                             
                <form name="perPageFrm" class="form-horizontal" id="perPageFrm" method="get" action="<?php echo BACKEND_URL;?>analytics/index">
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
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="panel income db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-group"></i>
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
                        <p class="icon">
                            <i class="icon fa fa-file-text-o"></i>
                        </p>
                      
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
                        <p class="icon">
                            <i class="icon fa fa-clock-o"></i>
                        </p>
                      
                        <p class="description">
                            <h4><?php
                            $seconds = $record['total_avg_session_duration'];
                            $hours = floor($seconds / 3600);
                            $mins = floor(($seconds - ($hours * 3600)) / 60);
                            $secs = floor($seconds % 60);
                            echo sprintf("%02s",$hours)." : ".sprintf("%02s",$mins)." : ".sprintf("%02s",$secs); ?></h4>
                            <h5> Avg. Session Duration </h5>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-md-3">
                <div class="panel visit db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-file-text-o"></i>
                        </p>
                      
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



<!---->
<script>
    $(function(){
       $(".input-daterange #startdate").datepicker();
       $(".input-daterange #enddate").datepicker({
          defaultDate:$(".input-daterange #startdate").val()
        });
    });
</script>