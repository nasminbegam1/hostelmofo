<script src="<?php echo BACKEND_JS_PATH; ?>jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/jquery.fancybox-1.3.4.css">
<script type="text/javascript">
$(document).ready(function() {
        

        $(".various3").fancybox({
                'width'		: '90%',
                'height'	: '90%',
                'autoScale'	: false,
                'transitionIn'  : 'none',
                'transitionOut'	: 'none',
                'type'		: 'iframe'
        });
});
</script>
<div id="main_content"> 
  <!-- Start : main content loads from here -->
  <?php if(isset($succmsg) && $succmsg != ""){ ?>
  <div align="center">
    <div class="nNote nSuccess">
      <p><?php echo stripslashes($succmsg);?></p>
    </div>
  </div>
  <?php } ?>
  <?php if(isset($errmsg) && $errmsg != ""){ ?>
  <div align="center">
    <div class="nNote nFailure">
      <p><?php echo stripslashes($errmsg);?></p>
    </div>
  </div>
  <?php }  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Property Search Panel</h4>
        </div>
        <div class="panel_controls">
          <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>property/sales/">
            <div class="row">
              <div class="col-sm-4">
                <label for="table_search">Search:</label>
                <input type="text" id="search_keyword" name="search_keyword" class="form-control" value="<?php echo $search_keyword; ?>">
              </div>
              <div class="col-sm-3 col-xs-6">
                <label>&nbsp;</label>
                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" />
                <button class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all">Show All</button>
              </div>
              <div class="col-sm-3 col-xs-6">
                <label for="un_member">Enties Per Page:</label>
                <select name="per_page" id="per_page" class="form-control">
                  <option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
                  <option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
                  <option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
                  <option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
                  <option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
                  <option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
                  <option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
                  <option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Sales Property Listing
	    <a href="<?php echo $add_url;?>">
            <div class="addSign label label-info" data-toggle="tooltip" data-placement="top auto" title="Add New Property">
	      <span>Add New Property</span>
	    </div>
            </a> </h4>
        </div>
        <form name="frmPages" id="frmPages" action="<?php echo $batch_action_link;?>" method="post">
          <input type="hidden" name="group_mode" id="group_mode" value="" />
          <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
          <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
          <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
          <table id="resp_table" class="table toggle-square">
            <thead>
              <tr>
                <th data-sort-ignore="true"><input type="checkbox" id="checkallbox" name="checkallbox" /></th>
                <th data-toggle="true">Property Name</th>
		<th data-toggle="true">Property Title</th>
                <!--<th data-hide="phone,tablet">Property Type</th>	-->	 
                <th>Optional Title</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="8"><div class="itemActions">
                    <label>Apply action:</label>
                    <select class="styled" name="apply_action" id="apply_action" >
                      <option value="">Select action...</option>
                      <!--<option value="Delete">Delete</option>-->
                      <option value="Activate">Live</option>
                      <option value="Inactivate">Not Live</option>
                    </select>
                  </div>
                  <?php
                          $show_to_record 	= $startRecord + $per_page;
                          $to_record		= $show_to_record;
                          if($show_to_record > $totalRecord) {
                                $to_record = $totalRecord;
                          }
                          ?>
                  <div class="footerPagination"> <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?> of <?php echo $totalRecord; ?> entries</span> <?php echo $this->pagination->create_links();?> </div></td>
              </tr>
            </tfoot>
            <tbody>
              <?php 
                if($propertyMasterList){			      
					for($i=0; $i<count($propertyMasterList); $i++){     
						                      
						$editLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$edit_link);
						$imageLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$image_link);
						$deleteLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$delete_link);
						$statusLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$status_link);  
                                                $statusLink	= str_replace("{{STATUS_LINK}}",'edit_sales_property_status',$statusLink);  
						
						$db_user_image  = stripslashes($propertyMasterList[$i]['property_id']);
						$class 		= 'class="even"';
						
						if($i%2==0)
						  $class = 'class="even"';
						else
						  $class = 'class="odd"';
						  
						if($propertyMasterList[$i]['status'] == 'active')
						{
							$status = 'Live';
						}
						else
						{
							$status = 'Not Live';
						}
				?>
					  <tr <?php echo $class; ?>>
						<td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $propertyMasterList[$i]['property_id'];?>" /></td>
						<td><?php echo stripslashes($propertyMasterList[$i]['property_name']);?></td>
						<td><?php echo stripslashes($propertyMasterList[$i]['page_title']);?></td>
						<!--<td><?php //echo stripslashes($propertyMasterList[$i]['property_type_name']);?></td>-->
						<td><?php echo stripslashes($propertyMasterList[$i]['optional_title']);?><!--<a href="<?php //echo BACKEND_URL;?>owner/details/<?php //echo $propertyMasterList[$i]['owner_id']?>/" target="_blank"><?php //echo stripslashes($propertyMasterList[$i]['owner_name']);?></a>--></td>
						<td><?php echo ucfirst($status);?></td>
						<td>
                              <a href="<?php echo $statusLink;?>" title="Change Status"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit Property">
                                <img src="<?php echo FRONTEND_URL;?>images/status-changes.png" alt="Change Status" />
                              </a>
                              <a class="various3" href="<?php echo FRONTEND_URL;?>property/property_preview/<?php echo $propertyMasterList[$i]['property_id'];?>/">
                                <span class="icon-search"></span>
                              </a>
                         
                        <a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Deleting property will delete enqueries, bookings, availability and other information related to this property. Do you still want to delete the property?');"> <span class="glyphicon glyphicon-remove-sign"></span> </a></td>
					  </tr>
				  <?php } } 
				else {  ?>
              <tr>
                <td colspan="7" align="center">..::..No records found..::..</td>
              </tr>
              <tr>
                <td colspan="7">&nbsp;</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  
  <!--End : Main content--> 
</div>
