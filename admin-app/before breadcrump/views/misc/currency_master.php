 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Currency Master Listing</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-money"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Currency Master</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-money"></i> &nbsp;Listing</a></li>

        
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
                                    <div class="col-lg-12"><h4 class="box-heading">Currency Master Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>misc/currency_master/">
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
                                                <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo $add_url;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Currency</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            <?php
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo $batch_action_link;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                 <tr>
                                                    <th ><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                    <th data-toggle="true">Country Name</th>
                                                    <th data-toggle="true">Currency Code</th>
                                                    <th data-toggle="true">Currency Name</th>
                                                    <th data-toggle="true">Symbol</th>
                                                    <th data-toggle="true">THB Rate</th>
                                                    <th data-toggle="true">USD Rate</th>
                                                    <th data-hide="phone,tablet">Status</th>
                                                    <th>Actions</th> 
                                                 </tr>
                                                </thead>
                                                <tbody>
                                               <?php 
                            if($countryMasterList){
                            for($i=0; $i<count($countryMasterList); $i++){                                
								$editLink = str_replace("{{ID}}",$countryMasterList[$i]['country_currency_id'],$edit_link); 
								$deleteLink = str_replace("{{ID}}",$countryMasterList[$i]['country_currency_id'],$delete_link);
								$viewLink = str_replace("{{ID}}",$countryMasterList[$i]['country_currency_id'],$view_link);
								$class = 'class="even"';
 								if($i%2==0)
									$class = 'class="even"';
								else
									$class = 'class="odd"';
                        ?>
                        <tr <?php echo $class; ?>>
                          	<td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $countryMasterList[$i]['country_currency_id'];?>" /></td>
                            <td><?php echo stripslashes($countryMasterList[$i]['country_name']);?> </td>
                            <td><?php echo stripslashes($countryMasterList[$i]['currency_code']);?> </td>
			    <td><?php echo stripslashes($countryMasterList[$i]['currency_name']);?> </td>
                            <td><?php echo ucfirst(stripslashes($countryMasterList[$i]['country_currency_symbol']));?></td>
			    <td><?php echo ucfirst(stripslashes($countryMasterList[$i]['currency_rate']));?></td>
			    <td><?php echo ucfirst(stripslashes($countryMasterList[$i]['currency_rate_usd']));?></td>
			    <td><?php echo ucfirst(stripslashes($countryMasterList[$i]['country_currency_status']));?></td>
			    
			    
                            <td>
			       <!--<a href="<?php echo $viewLink;?>" class="tablectrl_small bDefault tipS" title="View">
                               <span class="glyphicon glyphicon-list btn btn-orange"></span>
                               </a>-->
                               
                               <a class="various3 previewLinkBtn changeStatus" href="<?php echo $viewLink;?>" title="View">
                                
                                <button type="button" class="btn btn-info btn-green btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                           View
                                </button>
                              </a>
                              &nbsp;<br/><br/>
                              
                              <a class="various3 previewLinkBtn changeStatus" href="<?php echo $editLink;?>" title="Edit">
                                <button type="button" class="btn btn-info btn-blue btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                                            Edit 
                                </button>
                              </a>&nbsp;<br/><br/>
			      
			      <a class="various3 previewLinkBtn changeStatus" href="<?php echo $deleteLink;?>" title="Remove" onclick="return confirm('Are you sure?');">
                                <button type="button" class="btn btn-info btn-red btn-xs" ><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                </button>
                              </a>
                               
                               
			      <!--<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
                              <span class="glyphicon glyphicon-edit btn btn-blue"></span>
                              </a>
                              
                            <a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Are you sure?');">
                            <span class="glyphicon glyphicon-remove-sign btn btn-red"></span>
                            </a>-->
                            
                            </td>
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan="4">..::..No records found..::..</td></tr>
                            <tr><td colspan="4">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                                             <div class="row mbl">
                                                
                                                <div class="col-lg-6">
                                                    <div class="tb-group-actions"><span>Apply Action:</span>
                                                    <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
                                                        <option value="">Select action...</option>
							<option value="Delete">Delete</option>
							<option value="Activate">Activate</option>
							<option value="Inactivate">Inactivate</option>
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->