 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">City Master</div>
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
                                    <div class="col-lg-12"><h4 >City Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>city/index/">
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
                                                    <div class="actions"><a href="<?php echo $add_link;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add New City</a>&nbsp;
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."provines/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                   
                                                    <th width="10%">City Name</th>
                                                    <th width="10%">Province Name</th>
                                                    <th width="6%" style="text-align: center;">Actions</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                 
                                                 
                                                if(is_array($cityList))
                                                {
                                                foreach($cityList as $index=>$city)
                                                {
                                                    
                                                $editLink	= str_replace("{{ID}}",$city['city_master_id'],$edit_link);
                                                $deleteLink	= str_replace("{{ID}}",$city['city_master_id'],$delete_link);
						$viewlink	= FRONTEND_URL.$city['province_slug'].'/'.$city['city_seo_slug'].'/';
                                                ?>  
                                                <tr>
                                                    
                                                    <td><?php echo stripslashes($city['city_name']);?></td>
                                                     <td><?php echo stripslashes($city['province_name']);?></td>
                                                    
                                                    <td style="text-align: center;">
						    <?php
							if($city['status']=='Active')
							{
							?>
							<label onclick="javascript:statusModifier('city',this)" data-team='<?php echo $city['city_master_id']; ?>' class="btn btn-success"  title="<?php echo $city['status']; ?>">
							<i class="fa fa-check-square-o"></i>
							</label>
							
							<?php
							}
							else if($city['status']=='Inactive')
							{
							?>
							<label onclick="javascript:statusModifier('city',this)" data-team='<?php echo $city['city_master_id']; ?>' class="btn btn-primary" title="<?php echo $city['status']; ?>" >
							<i class="glyphicon glyphicon-remove-sign"></i>
							</label>
							
							<?php
							}
						    ?>
                                                    <a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
                                                        <button type="button" class="btn btn-blue"><i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
						    <a target="_blank" class="btn btn-pink" href="<?php echo $viewlink; ?>"><i class="fa fa-search"></i></a>
                                                    <!--<a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Delete" onclick="return confirm('Are you sure?');">
                                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </a>-->
                                                    <img class="statusLoader loader" id="loader_<?php echo $city['city_master_id']; ?>" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" /> 
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="6">..::..No records found..::..</td></tr>
                            <tr><td colspan="6">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </thead></table>
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
       alert("Search Field Must Contain Name");
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