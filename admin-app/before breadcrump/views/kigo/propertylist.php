 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<style type="text/css">
.live{
    background: rgba(115, 227, 25, 0.08);
}

.not-live{
    background: rgba(234, 47, 47, 0.1);
}

 </style>          
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">KIGO Property Listing</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
                                    
                                    
       <li><i class="fa fa-check-circle"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Availability</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
       <li>&nbsp;&nbsp;<a href="javascript:void(0)">Kigo Property</a>&nbsp;&nbsp;</li>
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                         
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            
                                            <?php
                                            $show_to_record 	= $start_from + $config['per_page'];
                                            $to_record		= $show_to_record;
                                            $totalRecord=$config['total_rows'];
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                            ?>
                                           
                                           <div class="row mbm ">
                                               <!---->
                                               <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                       
                                                        <span class="showRecCount">
                                                            Showing <?php echo $start_from+1; ?>
                                                            to <?php echo $to_record; ?></span>
                                                            | Found total <?php echo $totalRecord; ?> records
                                                        <br/>
                                                          <div class="pagination-panel">
                                                        
                                                            <?php echo $this->pagination->create_links();?>
                                                        
                                                          </div>
                                                 </div>
                                                    
                                                </div>
                                             
                                                 <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <button class="btn btn-blue" type="button" onclick="window.location.href='<?php echo BACKEND_URL."kigo/update_availability" ?>'">Update Kigo Availability</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php //echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php //echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php //echo $page; ?>">
                                            <!--<table class="table table-bordered table-advanced tablesorter ">-->
                                            <!--<table id="table_id" class="< tablesorter ">-->
                                            <!--<table class="table  table-bordered table-advanced tablesorter   tb-sticky-header">-->
                                              <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead >
                                                <tr >
                                                    <th width="3%"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                   
                                                    <th width="5%" >#</th>
                                                    
                                                    <th width="10%">Property # [Livephuket]</th>
                                                    <th width="10%">Property Name [Livephuket]</th>
                                                    <th width="10%">Page Title [Livephuket]</th>
                                                    <th width="7%">Optional Title [Livephuket]</th>
                                                    <th width="5%">Property # [KIGO]</th>
                                                    <th width="7%">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                
                                                if($kigopropertyList){			      
                                                for($i=0; $i<count($kigopropertyList); $i++){  ?>
                                                       
                                                <tr class=""  id="tr<?php echo $kigopropertyList[$i]['property_id'];?>">
                                                    <td><input type="checkbox" name="page[]" value="<?php echo $kigopropertyList[$i]['property_id'];?>"/></td>
                                                    <td><?php echo $x=$i+1; ?></td>
                                                    <td ><?php echo stripslashes($kigopropertyList[$i]['property_id']);?></td>
                                                    <td><?php echo stripslashes($kigopropertyList[$i]['property_name']);?></td>
                                                    <td><?php echo stripslashes($kigopropertyList[$i]['page_title']);?></td>
                                                    <td><?php echo stripslashes($kigopropertyList[$i]['optional_title']);?></td>
						    <td><?php echo stripslashes($kigopropertyList[$i]['PROP_ID']);?></td>
                                                    <td>
                                                       <a href="<?php echo BACKEND_URL.'kigo/details/'.$kigopropertyList[$i]['PROP_ID']; ?>" class="label label-info">
                                                        <i class="fa fa-list-alt"></i>
                                                        View Bookings
                                                       </a>
                                                    </td>
                                                    
                                                  
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="8" style="text-align: center;">..::..No records found..::..</td></tr>
                            <tr><td colspan="8" style="text-align: center;">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                                
                                            
                                               <div class="row mbm">
                                                <!-- <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                      
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                    </div>
                                                </div>-->
                                                <div class="col-lg-12 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php //echo $this->pagination->create_links();?>
                                                        
                                                    </div>
                                                </div>
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
<script>
     var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
</script>