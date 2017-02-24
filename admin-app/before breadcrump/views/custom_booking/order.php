 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Custom Booking Order</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Custom Booking Order</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Listing</a></li>
       
       
            
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
                                    <div class="col-lg-12"><h4 class="box-heading">Custom Booking Order Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>custom_booking/order/">
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."custom_booking/order_batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 3%;" data-sort-ignore="true"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox" /></th>
                                                    <th style="width: 10%;" data-toggle="true">Property Name</th>
                                                    <th style="width: 9%;" data-toggle="true">Optional<br />Title</th>
                                                    <th style="width: 10%;" data-toggle="true">Customer Email</th>
                                                    <th style="width: 10%;" data-toggle="true">Check in</th>
                                                    <th style="width: 10%;" data-toggle="true">Check out</th>
                                                    <th style="width: 9%;" data-toggle="true">Discount<br />Price</th>
                                                    <th style="width: 9%;" data-toggle="true">Payment Status</th>
                                                    <th style="width: 9%;" data-toggle="true">Is Paid</th>
                                                    <th style="width: 10%;" data-sort-ignore="true">Pay Date</th>
                                                    <th style="width: 10%;">Actions</th> 
						</tr>
                                                </thead>
                                                <tbody id="listing">
			  
			  <!--<input type="hidden" id="latest_booking" name="latest_booking" value="<?php echo $latestBooking[0]['cb_id'];?>">-->
			  
			  <?php
			  //pr($enquiryList);
                            if($orderList){
                            for($i=0; $i<count($orderList); $i++){
			      
			        if($orderList[$i]['customer_email']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($orderList[$i]['customer_email']);
			       }	 
				$viewLink = str_replace("{{ID}}",$orderList[$i]['cp_id'],$view_link);
				//$leadLink = str_replace("{{ID}}",$orderList[$i]['cp_id'],$lead_link);
				$deleteLink = str_replace("{{ID}}",$orderList[$i]['cp_id'],$delete_link);				
				
				$class = 'class="even"';
				if($i%2==0)
					$class = 'class="even"';
				else
					$class = 'class="odd"';

                        ?>
			
                        <tr>
                            <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $orderList[$i]['cp_id'];?>" /></td>
                            <td><?php if($orderList[$i]['property_name'] == '')echo "N/A";else echo stripslashes($orderList[$i]['property_name']);?></td>
			     <td><?php echo stripslashes($orderList[$i]['optional_title']);?></td>
                            <td><?php echo $email;?></td>
			    <td><?php echo $orderList[$i]['checkin'];?></td>
			    <td><?php echo $orderList[$i]['checkout'];?></td>
			    <td><?php echo 'THB '.$orderList[$i]['discountprice'];?></td>			   
			    <td><?php echo ucwords($orderList[$i]['payment_status']);?></td>
			    <td><?php echo ucwords($orderList[$i]['is_paid']);?></td>
			    <td><?php echo @date("d/m/Y H:i:s", strtotime($orderList[$i]['paydate']));?></td>
			     <td>
			     
                              
			       <a class="various3 previewLinkBtn changeStatus" href="<?php echo $viewLink;?>">
                                <!--<span class=" property_list property_list_preview btn btn-green">Details</span>-->
                                
                                <button type="button" class="btn btn-info btn-green btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details
                                </button>
                              </a>
                              &nbsp;<br/><br/>
                              
			      
			      <a class="various3 previewLinkBtn changeStatus" href="<?php echo $deleteLink;?>" onclick="return confirm('Are you sure?');">
                                <!--<span class=" property_list property_list_preview  btn btn-red">Delete</span>-->
                                <button type="button" class="btn btn-info btn-red btn-xs" ><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                </button>
                              </a>
                            </td> 
                        </tr>
                        <?php  } } else {  ?>
                            <tr><td colspan="10">..::..No records found..::..</td></tr>
                            <tr><td colspan="10">&nbsp;</td></tr>                
                        <?php } ?>
                      </tbody>
                      
                                                </table>
                                
                                            <div class="row mbl">
                                                
                                                <div class="col-lg-6">
                                                    <div class="tb-group-actions"><span>Apply Action:</span>
                                                    <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
                                                        <option value="">Select action...</option>
							<option value="Delete">Delete</option>
							<!--<option value="Activate">Activate</option>
							<option value="Inactivate">Inactivate</option>-->
                                                    </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                     
                                                        
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
       alert("Search Field Must Contain Name Or Email");
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
  $( document ).ready(function() {
    $( ".setval_change" ).change(function() {
    var loc_id=($(this).attr('id'));
    var left_order=($(this).val());
    $.post(
	  '<?php echo site_url('property_locations/update_left_order'); ?>', {loc_id:loc_id, left_order:left_order},
	   function(data){
	   // alert(data);
	      alert('Order has been updated successfully');
	      var res = data.split("-");
	      $('#' + res[1] + ".setval_change").val(res[0]);
	   }
    );
  });
    
  $( ".homepage_order_change" ).change(function() {
    var loc_id=($(this).attr('id'));
    var homepage_order=($(this).val());
    $.post(
	  '<?php echo site_url('property_locations/update_homepage_order'); ?>', {loc_id:loc_id, homepage_order:homepage_order},
	   function(data){
	   // alert(data);
	      alert('Order has been updated successfully');
	      var res = data.split("-");
	      $('#' + res[1]).val(res[0]);
	   }
    );
  });
  
  $( ".popular_location" ).change(function() {
    var loc_id=($(this).attr('id'));
    var popular_order=($(this).val());
    res = 0;
    $.post(
	  '<?php echo site_url('property_locations/update_popular_order'); ?>', {loc_id:loc_id, popular_order:popular_order},
	   function(data){
	   // alert(data);
	      alert('Order has been updated successfully');
	      var res = data.split("-");
	      $('#' + res[1] + ".popular_location").val(res[0]);
	   }
    );
  });
  
});
</script>