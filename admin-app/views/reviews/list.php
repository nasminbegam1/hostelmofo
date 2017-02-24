 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Reviews</div>
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
                                    <div class="col-lg-12"><h4 >Review Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL.currentClass();?>/index/">
                                           
                                                <div class="col-lg-12">
                                                   
                                                   <div class="col-lg-5"> 
                                                    <input type="text" id="property_name" name="property_name" placeholder="property name..." class="form-control" value="<?php echo $property_name; ?>" />
                                                   </div>
                                                   <div class="col-lg-7"> 
                                                    <button type="submit" class="btn btn-success" onclick=" return searchValidation();">Search</button>
                                                     <button value="show_all" class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>
                                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                               
                                              
                                                <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo $add_link;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add New</a>&nbsp;
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
					     <div id="no-more-tables">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th width="15%">User</th>
                                                    <th width="15%">Property name</th>
						    <th>Review Text</th>
                                                    <th>Added time</th>
                                                    <th width="5%" style="text-align: center;">Actions</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                 
                                                 
                                                if(is_array($reviewsList))
                                                {
                                                foreach($reviewsList as $index=>$review)
                                                {
                                                    
                                                ?>  
                                                <tr>
                                                    
                                                    <td data-title="User"><?php echo stripslashes($review['name']);?></td>
                                                    <td data-title="Property name"><?php echo ($review['property_name']!='')?stripslashes($review['property_name']):'NA';?></td>
						    <td data-title="Review Text">
                                                        <?php echo substr(stripslashes($review['review_text']),0,200); echo (strlen($review['review_text']))? '...<br/><p align="right"><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-review'.$review['review_id'].'">read more</a></p>':''; ?>
                                                    <div id="modal-review<?php echo $review['review_id'];  ?>" tabindex="-1" role="dialog" aria-labelledby="modal-default-label" aria-hidden="true" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                    <h4 id="modal-default-label" class="modal-title">Review for <?php echo stripslashes($review['property_name']);  ?> by <?php echo stripslashes($review['name']);?></h4>
								</div>
                                            
                                           <!-- <div class="modal-body">-->
                                                                        
                                                <div class="form-body">
                                                    
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Value For Money:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['value_for_money']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Staff:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['staff']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Facilities:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['facilities']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Security:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['security']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Atmosphere:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['atmosphere']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Location:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['location']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Cleanliness:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['cleanliness']);  ?>%</p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Name:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['name']);  ?></p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Country:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['country']);  ?></p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">City:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['city']);  ?></p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Gender:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['gender']);  ?></p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Age Group:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['age_group']);  ?></p></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="col-md-3 control-label" for="inputFirstName">Comment:</label>
                                                    <div class="col-md-9"><p class="form-control-static"><?php echo stripslashes($review['review_text']);  ?></p></div>
                                                </div>
                                            </div>
                
                                                </div>
                                                                  <div class="modal-footer modal-footer-right"> 
                                                                    <?php echo ($review['review_datetime']!='0000-00-00 00:00:00')? date('d M, Y h:i A',strtotime($review['review_datetime'])):'NA';?>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </td>
						    <td data-title="Added time"><?php echo ($review['review_datetime']!='0000-00-00 00:00:00')? date('m/d/Y h:i A',strtotime($review['review_datetime'])):'NA';?></td> 
                                                    <td data-title="Action" width='10%' style="text-align: center;">
							<div style="width:125px;margin: 0 auto;">
						    <?php
							if($review['review_status']=='Active')
							{
							?>
							<a href="javascript:void(0);" onclick="javascript:statusModifier('review',this)" data-team='<?php echo $review['review_id']; ?>' class="btn btn-success"  title="<?php echo $review['review_status']; ?>">
							<i class="fa fa-check-square-o"></i>
							</a>
							
							<?php
							}
							else if($review['review_status']=='Inactive')
							{
							?>
							<a href="javascript:void(0);" onclick="javascript:statusModifier('review',this)" data-team='<?php echo $review['review_id']; ?>' class="btn btn-primary" title="<?php echo $review['review_status']; ?>" >
							<i class="glyphicon glyphicon-remove-sign"></i>
							</a>
							
							<?php
							}
						    ?>
                                                   
						    </div>
							<div style="width:125px;margin: 0 auto;">
							    <img class="statusLoader loader" id="loader_<?php echo $review['review_id']; ?>" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" />
						    </div>
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="6">..::..No records found..::..</td></tr>
                            <tr><td colspan="6">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </thead></table>
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
	    
<!--	MODAL IMAGE    -->
<div id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modal-wide-width-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-wide-width-label" class="modal-title">Images of <span id="modalPropertyName"></span></h4></div>
				<div class="modal-body">
			
				    <div class="col-lg-12">
					<div class="col-lg-6  text-right">
					    <a class="propImgPre" href="javascript:void(0);" data-element="0"  title="Previous">
						<i class="fa fa-angle-double-left" style="color:#000;font-size: 30px;"></i>
					    </a>
					</div>
					<div class="col-lg-6 text-left">
					    <a class="propImgNext" href="javascript:void(0);" data-element="1" title="Next">
						
						<i class="fa fa-angle-double-right"  style="color:#000;font-size: 30px;"></i>
					    </a>
					</div>
				    </div>
				  	<div class="imagePropertyBox"></div>
					
					
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