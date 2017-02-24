 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Order Listing</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-check-square"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Order Listing</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-check-square"></i>&nbsp;&nbsp;Listing</a></li>
       
       
            
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
                                    <div class="col-lg-12"><h4 class="box-heading">Order Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL."order_listing/listing/".$page."/0";?>">
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
                                                <!--<div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php //echo $add_url;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add New Location</a>&nbsp;
                                                    </div>
                                                    </div>-->
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."order_listing/listing/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
						 <th style="width: 10%;" data-toggle="true">Property Name</th>
                                                <th style="width: 5%;" data-toggle="true">Check in</th>
                                                <th style="width: 5%;" data-toggle="true">Check out</th>                             
                                                <th style="width: 10%;" data-toggle="true">Name</th>
                                                <th style="width: 10%;" data-toggle="true">Email</th>				
                                                <th style="width: 5%;" data-toggle="true">Paid<br />Amount</th>
                                                <th style="width: 5%;" data-toggle="true">Authorized<br />Date</th>
                                                <th style="width: 9%;" data-toggle="true">Authorized<br />Status</th>
                                                <th style="width: 5%;" data-toggle="true">Capture<br />Status</th>
                                                <th style="width: 5%;" data-sort-ignore="true">Actions</th> 
						</tr>
                                                </thead>
                                                <tbody id="listing">
			  <?php
			  //pr($enquiryList);
                            if($orderList){
                            for($i=0; $i<count($orderList); $i++){
			      
			        if($orderList[$i]['email']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($orderList[$i]['email']);
			       }	 
				$viewLink = str_replace("{{ID}}",$orderList[$i]['order_id'],$view_link);
								
				
				$class = 'class="even"';
				if($i%2==0)
					$class = 'class="even"';
				else
					$class = 'class="odd"';

                        ?>
			
                        <tr>
                            <td><?php echo stripslashes($orderList[$i]['optional_title']);?></td>
			    <td><?php echo @date("d/m/Y ", strtotime($orderList[$i]['check_in']));?></td>
			    <td><?php echo @date("d/m/Y ", strtotime($orderList[$i]['check_out']));?></td>
			    <td><?php echo $orderList[$i]['first_name']." ".$orderList[$i]['last_name'];?></td>
                            <td><?php echo $email;?></td>    
			    <td><?php echo $orderList[$i]['currency_symbol'].' '.number_format($orderList[$i]['payment_amount']);?></td>
			     <td><?php echo @date("d/m/Y ", strtotime($orderList[$i]['auth_date']));?></td>
			    <td><?php echo $orderList[$i]['auth_status'];?></td>
			    
			    <td><?php echo $orderList[$i]['capture_status'];?></td>
			   
			    <td>
			    
			      <a class="various3 previewLinkBtn changeStatus" href="<?php echo $viewLink;?>">
                                <!--<span class="btn btn-orange property_list property_list_preview">Details</span>-->
                                <button type="button" class="btn btn-info btn-orange btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details
                                </button>
                              </a>&nbsp;<br/>
                              
			        <a class="various3 previewLinkBtn changeStatus" href="<?php echo BACKEND_URL."order_listing/edit/".$orderList[$i]['order_id'];?>">
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-info btn-blue btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                                            Edit 
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
  
  
  $(function(){
    function refreshDiv(){
      
        var latest_booking = $('#latest_booking').val();
	var backend_url	= '<?php echo BACKEND_URL;?>';
	//alert(latest_booking);
	if (latest_booking) {
	$.ajax({
		type: "POST",
		dataType: "HTML",
		url: backend_url+"custom_booking/get_new_enquiry",
		data: { latest_booking: latest_booking},
		success:function(data) { 
			//$("#latest_booking").remove();
			
		  	$("#listing").prepend(data);
		}		
	});
	}
    window.setTimeout(refreshDiv, 5000);
    }
    window.setTimeout(refreshDiv, 5000);
});  
</script>
