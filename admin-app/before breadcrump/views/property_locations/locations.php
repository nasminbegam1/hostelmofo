 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Location Master</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       
        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Location Master</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><a href="<?php echo $show_all;?>" ><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Listing</a></li>
       
       
            
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
                                    <div class="col-lg-12"><h4 class="box-heading">Location Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>property_locations/index/0/0/location/">
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
                                                    Add New Location</a>&nbsp;
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo $batch_action_link;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
						 <th style="width:4%;"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
						<th style="width:8%;">Location</th>
                                                <th style="width:8%;">Region</th>
                                                <th style="width:8%;">Location image</th>
                                                <th style="width:8%;">Homepage Order</th>
                                                <th style="width:8%;">Popular Location Order</th>
                                                <th style="width:8%;">Left bar Order</th>
                                                <th style="width:8%;">Status</th>
                                                <th style="width:8%;text-align: center;">Actions</th>
						</tr>
                                                </thead>
                                                <tbody>
			   <?php 
                            if($propertyLocations){
                            for($i=0; $i<count($propertyLocations); $i++){                                
                                $editLink	= str_replace("{{ID}}",$propertyLocations[$i]['location_id'],$edit_link);
				$deleteLink	= str_replace("{{ID}}",$propertyLocations[$i]['location_id'],$delete_link);
                                $db_user_image  = stripslashes($propertyLocations[$i]['location_id']);
                                $class = 'class="even"';
 				if($i%2==0)
				  $class = 'class="even"';
				else
				  $class = 'class="odd"';
				
				if($propertyLocations[$i]['POLID'] > 0)
				  $polid_link = BACKEND_URL."property_locations/edit_outside_location/".$propertyLocations[$i]['POLID']."/0/location/";
				else
				  $polid_link = BACKEND_URL."property_locations/add_outside_location/".$propertyLocations[$i]['location_id']."/0/location/";
				  
                        ?>
                        <tr <?php echo $class; ?>>
                          <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $propertyLocations[$i]['location_id'];?>" /></td>
                          <td><?php echo stripslashes($propertyLocations[$i]['location_name']);?></td>
			  <td><?php echo stripslashes($propertyLocations[$i]['region_name']);?></td>
			  <td><img src="<?php echo file_upload_base_url();?>location/thumb/<?php echo $propertyLocations[$i]['location_image'];?>" border="0" width="100" height="100"></td>
			  <td>
			    <select name="homepage_order" id="<?php echo $propertyLocations[$i]['location_id']; ?>" class="homepage_order_change">
			      <?php    for($j=0 ; $j<=12 ; $j++){  ?>
			       <option value="<?php echo $j; ?>" <?php if($j==$propertyLocations[$i]['location_featured']) {echo 'selected';} ?>><?php echo $j; ?>  </option>
			       <?php  }
			       ?>
			      </select>
			   </td>
			  <td>
			    <select name="popular_order" id="<?php echo $propertyLocations[$i]['location_id']; ?>" class="popular_location">
			      <?php    for($j=0 ; $j<=20 ; $j++){  ?>
			       <option value="<?php echo $j; ?>" <?php if($j==$propertyLocations[$i]['popular_order']) {echo 'selected';} ?>><?php echo $j; ?>  </option>
			       <?php  }
			       ?>
			      </select>
			   </td>
			  <td>
			    <select  name="apply_action" id="<?php echo $propertyLocations[$i]['location_id']; ?>"  class="setval_change" >
			    <?php
			    for($j=0;$j<=$sitesettings_value;$j++)
			    {
			     ?>
			     <option value="<?php echo $j;?>"<?php if ($propertyLocations[$i]['left_bar_order'] == $j) { ?> selected="selected" <?php } ?>><?php echo $j;?></option>
			     <?php
			    }
			    ?>
				  
			      </select>
			  </td>
			  <td><?php echo stripslashes($propertyLocations[$i]['location_status']);?></td>
                          <td style="text-align: center;">
			    <!--<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
			      <span class="glyphicon glyphicon-edit btn btn-blue"></span>
			    </a>
			    <a href="<?php echo $polid_link;?>" class="tablectrl_small bDefault tipS" title="Things to See and Do">
			      <span class="glyphicon glyphicon-info-sign btn btn-pink"></span>
			    </a>-->
                            
                            <a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
                                <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                    Edit 
                                </button>
                            </a>&nbsp;<br/><br/>
                            <a href="<?php echo $polid_link;?>" class="tablectrl_small bDefault tipS" title="Things To See And Do">
                                <button type="button" class="btn btn-pink btn-xs"><i class="fa fa-info"></i>&nbsp;
                                    Things To See And Do
                                </button>
                            </a>
                            
                            
                            <!--<a href="<?php //echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Are you sure?');">
			      <span class="glyphicon glyphicon-remove-sign"></span>
			    </a>-->
                          </td>
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan=8" align="center">..::..No records found..::..</td></tr>
                            <tr><td colspan="8">&nbsp;</td></tr>                
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