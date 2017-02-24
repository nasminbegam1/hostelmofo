 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Property Share Listing</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Property Share</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Listing</a></li>
       
       
            
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
                                    <div class="col-lg-12"><h4 class="box-heading">Property Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>property_share/listing/">
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."property_share/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 3%;"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                    <th style="width: 10%;">Sender Name</th>
                                                    <th style="width: 8%;">Sender Email</th>
                                                    <th style="width: 20%;">Message</th>
                                                    <th style="width: 15%;">Property Name</th>
                                                    <th style="width: 5%;">Receiver Email</th>
                                                    <th style="width: 12%;">Receive From</th>
                                                    <th style="width: 7%;">Added on</th>
                                                    <th style="width: 8%;">Actions</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                <input type="hidden" id="latest_enquiry" name="latest_enquiry" value="<?php echo $latestEnquiry[0]['sf_id'];?>">
                                                <?php
                                                if(is_array($propertyShareList))
                                                {
                                                for($i=0; $i<count($propertyShareList); $i++){
                                                    
                                                    if($propertyShareList[$i]['sf_sender_email']=='') {
                                                      $email ='';
                                                    } else {
                                                      $email = stripslashes($propertyShareList[$i]['sf_sender_email']);
                                                    }
                                                    
                                                    $viewLink = str_replace("{{ID}}",$propertyShareList[$i]['sf_id'],$view_link);
                                                    $leadLink = str_replace("{{ID}}",$propertyShareList[$i]['sf_id'],$lead_link);
                                                    $deleteLink = str_replace("{{ID}}",$propertyShareList[$i]['sf_id'],$delete_link);
                                                    
                                                   $class = 'class="even"';
                                                    if($i%2==0)
                                                            $class = 'class="even"';
                                                    else
                                                            $class = 'class="odd"';
                                                            
                                                    if(stripslashes(trim($propertyShareList[$i]['sf_message'])) != '') {
                                                      $notes = sub_word($propertyShareList[$i]['sf_message'], 50);
                                                    } else {
                                                      $notes = 'N.A.';
                                                    }
                                                        ?>  
                            <tr>
                                <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $propertyShareList[$i]['sf_id'];?>" /></td>
                                
                                <td><?php echo stripslashes($propertyShareList[$i]['sf_sender_name']);?></td>
                                <td><?php echo wordwrap($email, 20, "<br />", true);?></td>
                                <td><?php echo $notes;?></td>
                                <td>
			      <?php if(trim($propertyShareList[$i]['sf_property_name']) != '') { ?>
			      <a href="<?php if($propertyShareList[$i]['sales_rentals'] == "Sales") { echo FRONTEND_URL.'property-sales/'.$propertyShareList[$i]['property_slug'].'/'; } else if($propertyShareList[$i]['sales_rentals'] == "Rental") { echo FRONTEND_URL.'property-rentals/'.$propertyShareList[$i]['property_slug'].'/'; } ?>" target="_blank">
				<?php echo stripslashes($propertyShareList[$i]['sf_property_name']);?>
			      </a>
			      <?php } else { echo 'N.A.'; }?>
			    </td>
                            <td><?php
			    $reciv_mail=explode(",",$propertyShareList[$i]['sf_receiver_email']);
			    echo implode(", ",$reciv_mail);
			    ?></td>
                            <td><?php echo stripslashes($propertyShareList[$i]['sales_rentals']);?></td>
			    <td><?php echo @date("d/m/Y", strtotime($propertyShareList[$i]['sf_date']));?></td>
                                <td>
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $viewLink;?>" title="Details">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details 
                                    </button>
                                    </a>
                                    &nbsp;<br>
                                  
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $deleteLink;?>" title="Delete" onclick="return confirm('Are you sure?');">
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                      </button>
                                    </a>
                               
                            
                            </td> 
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan="10">..::..No records found..::..</td></tr>
                            <tr><td colspan="10">&nbsp;</td></tr>                
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

</script>
<script>
  $(function(){
    function refreshDiv(){
      
        var latest_enquiry = $('#latest_enquiry').val();
	var backend_url	= '<?php echo BACKEND_URL;?>';
	//alert(latest_enquiry);
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url+"property_share/get_new_enquiry",
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