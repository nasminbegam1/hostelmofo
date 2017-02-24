 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Enquiry Listing</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Enquiry</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-question"></i>&nbsp;&nbsp;Listing</a></li>
       
       
            
            <!--<i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
        
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
                                    <div class="col-lg-12"><h4 class="box-heading">Enquiry Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>enquiry/index/">
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                    
                                                    <input type="text" id="search_keyword" name="search_keyword" placeholder="Enter here..." class="form-control" value="<?php echo $search_keyword; ?>" />
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-success" onclick=" return searchValidation();">Search</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                   
                                                    <button class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    View
                                                        &nbsp;<select name="per_page" id="per_page" class="form-control input-xsmall input-sm input-inline">
                                                            
                                                            <option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
                                                            <option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
                                                            <option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
                                                            <option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
                                                            <option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
                                                            <option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
                                                            <option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
                                                            <option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option>
                                                            
                                                            
                                                            
                                                        </select>&nbsp;
                                                        records 
                                                
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            <?php
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                           // error_reporting(0);
                                            ?>
                                           
                                            <div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."enquiry/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 3%;"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                    <th style="width: 10%;">Enquired by</th>
                                                    <th style="width: 8%;">Email</th>
                                                    <th style="width: 20%;">Message</th>
                                                    <!--<th>Phone</th>
                                                    <th>Guest</th>-->
                                                    <th style="width: 15%;">Property Name</th>
                                                    <th style="width: 5%;">Type</th>
                                                    <th style="width: 12%;">Receive From</th>
                                                    <th style="width: 7%;">Added on</th>
                                                    <th style="width: 8%;">Actions</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                <input type="hidden" id="latest_enquiry" name="latest_enquiry" value="<?php echo $latestEnquiry[0]['enquiry_id'];?>">
                                                <?php
                                                if(is_array($enquiryList))
                                                {
                                                for($i=0; $i<count($enquiryList); $i++){
                                                    
                                                    if($enquiryList[$i]['email_address']=='') {
                                                      $email ='';
                                                    } else {
                                                      $email = stripslashes($enquiryList[$i]['email_address']);
                                                    }
                                                    
                                                    $viewLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$view_link);
                                                    $leadLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$lead_link);
                                                    $deleteLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$delete_link);
                                                    
                                                    //$class = 'class="even"';
                                                    //if($i%2==0)
                                                    //        $class = 'class="even"';
                                                    //else
                                                    //        $class = 'class="odd"';
                                                            
                                                    if(stripslashes(trim($enquiryList[$i]['notes'])) != '') {
                                                      $notes = sub_word($enquiryList[$i]['notes'], 50);
                                                    } else {
                                                      $notes = 'N.A.';
                                                    }
                                                    
                                                    $pos = stripos($notes, "wdc");
                                                        ?>  
                            <tr <?php if($enquiryList[$i]['enquiry_read']=='Unread'){?> style=" background-color: #fce9e9;"<?php }else{?>style=" background-color: #f4fcec;" <?php }?>>
                                <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $enquiryList[$i]['enquiry_id'];?>" /></td>
                                
                                <td><?php echo stripslashes($enquiryList[$i]['contact_name']);?></td>
                                <td><?php echo $email;?></td>
                                <td><?php echo $notes;?></td>
                                <!--<td><?php //echo ($enquiryList[$i]['phone'] != '') ? $enquiryList[$i]['phone'] : 'N.A.';?></td>
                                <td><?php //echo $enquiryList[$i]['guest'];?></td>-->
                                <td>
                                  <?php if(trim($enquiryList[$i]['property_name']) != '') { ?>
                                  <a href="<?php if($enquiryList[$i]['sales_rentals']=="Rental") { echo FRONTEND_URL.'property-rentals/'.$enquiryList[$i]['property_slug'].'/'; } else if ($enquiryList[$i]['sales_rentals']=="Sales") { echo FRONTEND_URL.'property-sales/'.$enquiryList[$i]['property_slug'].'/'; } ?>" target="_blank">
                                    <?php echo stripslashes($enquiryList[$i]['property_name'])?>
                                  </a>
                                  <?php } else { echo 'N.A.'; }?>
                                </td>
                                
                                <td><?php echo $enquiryList[$i]['sales_rentals'];?></td>
			    
                                <td><?php if($enquiryList[$i]['is_mobile']=="Yes"){ echo "Mobile";} else if($enquiryList[$i]['is_mobile']=="No"){ echo "Desktop";} ?></td>
                                <td>
                                <?php echo @date("d/m/Y H:i:s", strtotime($enquiryList[$i]['added_on']));?>
                                </td>
                                <td>
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $viewLink;?>" title="Details">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details 
                                    </button>
                                    </a>
                                    &nbsp;<br>
                                    <?php
                                     if($this->nsession->userdata('role') == 'agent')
                                    {
                                        if($new_enquiry[0]['assigned_user'] == 1)
                                        {
                                    ?>		      
                                            <!--<a class="tablectrl_small bDefault tipS" href="<?php echo $leadLink;?>" title="Lead">
                                              <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>&nbsp;
                                                            Lead 
                                              </button>
                                            </a>-->
                                   <?php
                                        }
                                   
                                   }
                                   else if($this->nsession->userdata('role') == 'admin')
                                   {
                                    
                                ?>			     
                                    <!--<a class="tablectrl_small bDefault tipS" href="<?php echo $leadLink;?>" title="Lead">
                                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>&nbsp;
                                                            Lead 
                                    </button>
                                    </a>-->
                                  
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $deleteLink;?>" title="Delete" onclick="return confirm('Are you sure?');">
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                      </button>
                                    </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                &nbsp;
                                <?php
                                }
                                ?>
                            
                            </td> 
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan="8">..::..No records found..::..</td></tr>
                            <tr><td colspan="8">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                                
                                            <div class="row mbl">
                                                
                                                <div class="col-lg-6">
                                                    <div class="tb-group-actions"><span>Apply Action:</span>
                                                    <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
                                                        <option value="">Select...</option>
                                                        <option value="Delete">Delete</option>
                                                    </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                       <!-- Page
                                                        &nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-left"></i></a>&nbsp;<input type="text" maxlenght="5" value="<?php echo $startRecord+1; ?>" class="pagination-panel-input form-control input-mini input-inline input-sm text-center"/>&nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-right"></i></a>&nbsp;
                                                        of <?php //echo $to_record; ?> | -->
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
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
<script>
  
  function searchValidation()
  {
    if ( $("#search_keyword").val() == '')
    {
       alert("Search Field Must Contain Name Or Value");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
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
    
    
    $(function(){
    function refreshDiv(){
      
        var latest_enquiry = $('#latest_enquiry').val();
	var backend_url	= '<?php echo BACKEND_URL;?>';
	//alert(latest_enquiry);
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url+"enquiry/get_new_enquiry",
		data: { latest_enquiry: latest_enquiry},
		success:function(data) { 
			$("#latest_enquiry").remove();
			
		  	$("#listing").prepend(data);
		}		
	});
    window.setTimeout(refreshDiv, 5000);
    }
    window.setTimeout(refreshDiv, 5000);
}); 
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->