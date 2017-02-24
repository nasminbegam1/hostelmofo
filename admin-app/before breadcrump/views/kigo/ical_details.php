 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<style type="text/css">
 p.ical_details label{
    display: inline-block;width: 180px;
}
p.ical_details span{
    padding-left:10px ;
    
}
 </style>          
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">iCal Property Details</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       <li><i class="fa fa-check-circle"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Availability</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
       <li>&nbsp;&nbsp;<a href="<?php echo BACKEND_URL."icalavailability/" ?>">Ical Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
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
                                                    <div class="col-lg-12 text-right">
                                                      <button class="btn btn-blue" type="button" onclick="window.location.href='<?php echo BACKEND_URL."icalavailability/" ?>'">Property List</button>
                                                    </div>
                                                  
                                                    <div class="col-lg-12 text-left">
                                                        <p class="ical_details">
                                                            <label>Property # <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo $enquiryList[0]['property_id'];?></span>
                                                        <p/>
                                                        <p class="ical_details">
                                                            <label>Property Name <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['property_name']);?></span>
                                                        <p/>
                                                        <p class="ical_details">
                                                            <label>Page Title <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['page_title']);?></span>
                                                        <p/>
                                                        <p class="ical_details">
                                                            <label>Optional Title <i>[Livephuket]</i> </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['optional_title']);?></span>
                                                        <p/>
                                                        <p class="ical_details">
                                                            <label>iCal Used </label>
                                                            :
                                                            <span><?php
                                                                $manage_by = '';
                                                                $url_explode = explode('/',$enquiryList[0]['ical_url']);
                                                                if(isset($url_explode[2])){
                                                                $domain_explode = explode('.',$url_explode[2]);
                                                                        if(isset($domain_explode[1])){
                                                                                $domain_explode = array_reverse($domain_explode);
                                                                                $manage_by = ucwords( $domain_explode[1]);
                                                                        }
                                                                }
                                                                
                                                                echo $manage_by;
                                                                
                                                                
                                                                ?></span>
                                                        </p>
                                                        <p class="ical_details">
                                                            <label>iCal URL </label>
                                                            :
                                                            <span><?php echo stripslashes($enquiryList[0]['ical_url']);?></span>
                                                        <p/>
                                                     
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
                                                    <th>#</th>
                                                    <th>Check-In<br />[<?php echo $manage_by; ?>]</th>
                                                    <th>Check-Out<br />[<?php echo $manage_by; ?>]</th>
                                                    <th>Reservation Summary<br />[<?php echo $manage_by; ?>]</th>
                                                    <th>Reservation Description<br />[<?php echo $manage_by; ?>]</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if($enquiryList){
                                                for($i=0; $i<count($enquiryList); $i++){
                                                  
                                                    $class = 'class="even"';
                                                    if($i%2==0)
                                                            $class = 'class="even"';
                                                    else
                                                            $class = 'class="odd"';				
                                            ?>
                                            <tr <?php echo $class; ?>>
                                                <td><?php echo $i+1; ?></td>
                                               
                                                
                                                <td><?php echo date('d M,Y',strtotime($enquiryList[$i]['ical_dtstart']));?></td>
                                                <td><?php echo date('d M,Y',strtotime($enquiryList[$i]['ical_dtend']));?></td>
                                                <td><?php echo ($enquiryList[$i]['ical_summary']) ;?></td>
                                                <td><?php echo ($enquiryList[$i]['ical_description']) ;?></td>
                                            </tr>
                                            <?php } ?>
                                             <?php } else {  ?>
                                                <tr><td colspan="6">..::..No records found..::..</td></tr>
                                                <tr><td colspan="6">&nbsp;</td></tr>                
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