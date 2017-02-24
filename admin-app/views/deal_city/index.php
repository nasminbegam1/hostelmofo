 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<style type="text/css">
.live{
    background: rgba(115, 227, 25, 0.08);
}

.not-live{
    background: rgba(234, 47, 47, 0.1);
}
.loader{visibility: hidden;}
 </style>          
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Team List</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  
  <!--For breadcrump end-->
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
                                    <div class="col-lg-12"><h4 class="box-heading">Deal Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>deal/">
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
                                                    Add New Deal</a>&nbsp;
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
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
							<th data-toggle="true">Title</th>
							<th data-toggle="true">Description</th>
							<th data-toggle="true">Location</th>
							
							<th>Actions</th>
                                                </tr>
                                                </thead>
					    <tbody>
						 <?php
						 
						 //pr($dealList);
						 if($dealList){			      
							for($i=0; $i<count($dealList); $i++){ //pr($propertyMasterList); 
										      
								$editLink	= str_replace("{{ID}}",$dealList[$i]['id'],$edit_link);
								$imageLink	= str_replace("{{ID}}",$dealList[$i]['id'],$image_link);
								$deleteLink	= str_replace("{{ID}}",$dealList[$i]['id'],$delete_link);
								
								
								$class 		= 'class="even"';
								
								if($i%2==0)
								  $class = 'class="even"';
								else
								  $class = 'class="odd"';
								  
								if($dealList[$i]['status'] == 'Active')
								{
									$status = 'Active';
								}
								else
								{
									$status = 'Inactive';
								}
								?>
									  <tr <?php echo $class; ?> id="tr<?php echo $dealList[$i]['id']; ?>">
										<td width="220"><?php echo stripslashes($dealList[$i]['title']);?></td>
										<td width="220"><?php echo ucfirst(stripslashes($dealList[$i]['description']));?></td>
										<td width="220"><?php echo ucfirst(stripslashes($dealList[$i]['city_name']));?></td>
										
										
										<td align="center">
											
											<?php
											
											if($status=='Active')
											{
											?>
											<label onclick="javascript:statusModifier('deal_city',this)" data-team='<?php echo $dealList[$i]['id']; ?>' class="btn btn-success" title="Active"  >
											<i class="fa fa-check-square-o"></i>
											</label>
											
											<?php
											}
											else if($status=='Inactive')
											{
											?>
											<label onclick="javascript:statusModifier('deal_city',this)" data-team='<?php echo $dealList[$i]['id']; ?>' class="btn btn-primary" title="Inactive" >
											<i class="glyphicon glyphicon-remove-sign"></i>
											</label>
											
											<?php
											}
											?>
											
											<a href="<?php echo $editLink;?>"   class="tablectrl_small bDefault tipS" title="Edit Team Member">
											 <button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button>
											</a>
										       
											  <a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm(' Do you want to delete the team member? ');">
												<button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
											  </a>
											 <img class="loader" id="loader_<?php echo $dealList[$i]['id']; ?>" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" style="width:25px;" /> 
										</td>
									  </tr>
								  <?php } } 
								else {  ?>
								<tr>
								  <td colspan="8" align="center">..::..No records found..::..</td>
								</tr>
								<tr>
								  <td colspan="8">&nbsp;</td>
								</tr>
								<?php } ?>
					    </tbody>
					    </table>
                                
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
    
    
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->