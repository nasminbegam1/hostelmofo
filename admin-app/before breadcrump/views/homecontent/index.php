 <!--BEGIN TITLE & BREADCRUMB PAGE-->
      
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Home Content List</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       <li><i class="fa fa-home"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Home Content</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active">&nbsp;&nbsp;<a href="<?php echo $show_all;?>" >Home Content Listing</a></li>
        
           
    </ol>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
<?php
				      $show_to_record 	= $startRecord + $per_page;
				      $to_record		= $show_to_record;
				      if($show_to_record > $totalRecord) {
					    $to_record = $totalRecord;
				      }
				      ?>
            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                                <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>homecontent/index/">
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
                                                            <!--<option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="500">>500</option>-->

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

                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
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

				    <table id="resp_table" class="table table-bordered table-advanced tablesorter tb-sticky-header">
				    <thead>
					  <tr>
					    <th data-toggle="true">Title</th>
					    <th>Content</th>
					    <th data-sort-ignore="true">Actions</th>
					  </tr>
					</thead>
				      <tfoot>
				      <tr>
					<!--<td colspan="8">
				      
				      
					  </td>-->
				      </tr>
				    </tfoot>
				    <tbody>
					<?php 
					if($homecontentList){
					for($i=0; $i<count($homecontentList); $i++){                                
					    $editLink= str_replace("{{ID}}",$homecontentList[$i]['id'],$edit_link);
					    
					    $class = 'class="even"';
					    if($i%2==0)
					      $class = 'class="even"';
					    else
					      $class = 'class="odd"';
				    ?>
				    <tr <?php echo $class; ?>>
				      <td><?php echo stripslashes($homecontentList[$i]['title']);?></td>
				      <td><?php echo stripslashes($homecontentList[$i]['content']);?></td>
				      <td>
					<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
					  <button class="btn btn-info"><i class="fa fa-edit"></i>
					    Edit
					  </button>
					  
					</a>
				      </td>
				    </tr>
				    <?php } } else {  ?>
					<tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>                
				    <?php } ?>
				  </tbody>
				    
				    
				    </table>
				    
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
	  
<script>
       /**** session succ/err msg display *****/
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