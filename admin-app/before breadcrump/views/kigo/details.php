 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<style type="text/css">
.property-details p label{
    display: inline-block;width: 180px;
    
}
.property-details p span{
    display: inline-block;padding-left:10px ;
}
 </style>          
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">KIGO Property Details</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       <li><i class="fa fa-check-circle"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Availability</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
       <li>&nbsp;&nbsp;<a href="<?php echo BACKEND_URL."kigo/" ?>">Kigo Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
       <li>&nbsp;&nbsp;<a href="javascript:void(0)">Property Details</a>&nbsp;&nbsp;</li>    
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
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                                <div class="note note-info property-details">
                                                    <div class="col-lg-8 text-left">
                                                        <p>
                                                            <label>Property # <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo $enquiryList[0]['property_id'];?></span>
                                                        <p/>
                                                        <p>
                                                            <label>Property Name <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['property_name']);?></span>
                                                        <p/>
                                                        <p>
                                                            <label>Page Title <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['page_title']);?></span>
                                                        <p/>
                                                        <p>
                                                            <label>Optional Title <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['optional_title']);?></span>
                                                        <p/>
                                                        <p>
                                                            <label>Property # <i>[KIGO]</i> </label>
                                                            :
                                                            <span><?php echo $enquiryList[0]['PROP_ID'];?></span>
                                                        </p>
                                                    </div>
                                                     <div class="col-lg-4 text-right">
                                                      <button class="btn btn-blue" type="button" onclick="window.location.href='<?php echo BACKEND_URL."kigo/" ?>'">Property List</button>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </div>
                                                <div class="row mbm">
                                                     <?php
                                                        $show_to_record 	= $start_from + $config['per_page'];
                                                        $to_record		= $show_to_record;
                                                        $totalRecord=$config['total_rows'];
                                                        if($show_to_record > $totalRecord) {
                                                              $to_record = $totalRecord;
                                                        }
                                                        ?>
                                                    <!---->
                                                    <div class="col-lg-4">
                                                       <div class="pagination-panel">
                                                         
                                                           <span class="showRecCount">Showing <?php echo $start_from+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-8 text-right">
                                                       <div class="pagination-panel">
                                                           
                                                               <?php echo $this->pagination->create_links();?>
                                                           
                                                       </div>
                                                   </div>
                                                </div>
                                                <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead >
                                                <tr >
                                                     <th width="5%" >#</th>
                                                    <th width="10%">Reservation #<br/>[KIGO]</th>
                                                    <th width="10%">Reservation Status<br/>[KIGO]</th>
                                                    <th width="10%">Check-In<br/>[KIGO]</th>
                                                    <th width="7%">Check-Out<br/>[KIGO]</th>
                                                    <th width="5%">LivePhuket Reservation<br/>[KIGO]</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                
                                                if($enquiryList){			      
                                                for($i=0; $i<count($enquiryList); $i++){  ?>
                                                       
                                                <tr>
                                                    <td><?php echo $x=$i+1; ?></td>
                                                    <td ><?php echo stripslashes($enquiryList[$i]['RES_ID']);?></td>
                                                    <td><?php echo stripslashes($enquiryList[$i]['RES_STATUS']);?></td>
                                                    <td><?php echo stripslashes($enquiryList[$i]['RES_CHECK_IN']);?></td>
                                                    <td><?php echo stripslashes($enquiryList[$i]['RES_CHECK_OUT']);?></td>
						    <td><?php echo ($enquiryList[$i]['RES_IS_FOR'] != 0) ? 'LivePhuket' : 'Other Agency';?></td>
                                                   
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="7">..::..No records found..::..</td></tr>
                            <tr><td colspan="7">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                                
                                            
                                               <div class="row mbm">
                                                  <div class="col-lg-6">
                                                       <div class="pagination-panel">
                                                         
                                                           <span class="showRecCount">Showing <?php echo $start_from+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                       </div>
                                                   </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $this->pagination->create_links();?>
                                                        
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