 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Property</div>
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
                                    <div class="col-lg-12"><h4 >Property Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL.currentClass();?>/index/">
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
                                                    
                                                   
                                                    <button value="show_all" class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
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
                                                    Add New Property</a>&nbsp;
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
					     <div id="no-more-tables">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th width="10%">Name</th>
                                                    <th>Province</th>													
													<th>Type</th>
													<th width="10%">Agent</th>
													<th>Complete(%)</th>
                                                    <th width="20%" style="text-align: center;">Actions</th>
                                                </tr>
												</thead>
                                                <tbody>
                                                <?php
                                          
                                                 
                if(is_array($propertyList)){
                    foreach($propertyList as $index=>$property){
						  
                $previewlink 	=  FRONTEND_URL.'preview-property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug']; 
                $editLink	= str_replace("{{ID}}",$property['property_master_id'],$edit_link);
                $deleteLink	= str_replace("{{ID}}",$property['property_master_id'],$delete_link);
					 $availabilitylink = str_replace("{{ID}}",$property['property_master_id'],$availability_link);
					 $bookinglink 	= str_replace("{{ID}}",$property['property_master_id'],$booking_link);
					 $querylink 	= str_replace("{{ID}}",$property['property_master_id'],$query_link);
					 $viewlink 	= str_replace("{{ID}}",$property['property_master_id'],$view_link);
					 ?>  
                <tr>
                    <td data-title="Image"  align="center">
							<?php if(is_array($property['images']) and count($property['images'])>0){ ?>
							<?php $img = $property['images'][0]; ?>
							    <?php  ?>
								<img src="<?php echo FILE_UPLOAD_URL.'property/small/'.$img['image_name'] ?>" width="100"/>
								
							<?php }else{ ?>
							<span class="fa fa-picture-o" style="font-size:100px;"></span>
							
							<?php  } ?>
						  </td>
						    
						  <td data-title="Name">
							<?php echo ucwords(stripslashes($property['property_name']));?>
							<br/>
							
							<?php //echo '<a href="'.$link.'" target="_blank">'.$link.'</a>'; ?>
						  </td>
                    <td data-title="Province"><?php echo ($property['province_name']!='')?stripslashes($property['province_name']):'NA';?></td>
						  <td data-title="Type"><?php echo stripslashes($property['property_type_name']);?></td>
						  <td data-title="Agent"><?php echo stripslashes($property['firstname'])." ".stripslashes($property['lastname'])."<br>".stripslashes($property['email']);?></td>
						  <td data-title="Manager">
							<?php
							$percent ='100';$complete_text='Ready to Live';
							$required_arr=array();
							if($property['required_fields']!=''){
							    $len_required 		= count($required_fileds) ;
							    
							    $required_arr 		= explode(',',$property['required_fields']);
							    $len_property_required	= count($required_arr);
							    $percent 			= 100 - ceil(($len_property_required*100)/$len_required);
							    $complete_text		= "Need to fill up: &#013;&#013;";
							    for($i=0;$i<$len_required; $i++){
									$complete_text .=$required_fileds[$i].' &#013; ';
							    }
							}
							?>
							<div class="progress">
							    <div title="<?php echo $complete_text; ?>" class="progress-bar <?php if($percent<50){ echo "progress-bar-danger"; }elseif($percent>50 and $percent<=70){ echo "progress-bar-warning"; }else{ echo "progress-bar-success"; } ?>" aria-valuetransitiongoal="<?php echo $percent ?>" role="progressbar" style="width: <?php echo $percent ?>%;" aria-valuenow="<?php echo $percent ?>"><?php echo $percent ?>%</div>
							</div> 
						  </td>
                                                    
							  <td data-title="Action" width='10%' style="text-align: center;">
							<div >
						    <?php
							//if($property['agent_id'] == '0'){
							if($property['status']=='Active'){
							?>
							<a href="javascript:void(0);" onclick="javascript:statusModifier('property',this)" data-team='<?php echo $property['property_master_id']; ?>' class="btn btn-success"  title="<?php echo $property['status']; ?>">
							<i class="fa fa-check-square-o"></i>
							</a>
							
							<?php
							}
							else{
							?>
							<a href="javascript:void(0);" onclick="javascript:statusModifier('property',this)" data-team='<?php echo $property['property_master_id']; ?>' class="btn btn-primary" title="<?php echo $property['status']; ?>" >
							<i class="glyphicon glyphicon-remove-sign"></i>
							</a>
							
							<?php
							}
						  ?>
							 <?php
							if($property['is_featured']=='Yes')
							{
							?>
							<a href="javascript:void(0);" onclick="javascript:featureModifier('property',this)" data-feature='<?php echo $property['property_master_id']; ?>' class="btn btn-success"  title="Feature <?php echo $property['is_featured']; ?>">
							<i class="glyphicon glyphicon-star"></i>
							</a>
							
							<?php
							}
							else if($property['is_featured']=='No')
							{
							?>
							<a href="javascript:void(0);" onclick="javascript:featureModifier('property',this)" data-feature='<?php echo $property['property_master_id']; ?>' class="btn btn-primary" title="Feature <?php echo $property['is_featured']; ?>" >
							<i class="glyphicon glyphicon-star-empty"></i>
							</a>
							
							<?php
							}
							
						        ?>
							
						    <a href="<?php echo $availabilitylink;?>" class="tablectrl_small bDefault tipS" title="Availability">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-calendar"></i>
                                                        </button>
                                                    </a>
						      
						     <a href="<?php echo $bookinglink;?>" class="tablectrl_small bDefault tipS" title="Booking Listng">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-list"></i>
                                                        </button>
                                                    </a> 
                                                    <a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Delete" onclick="return confirm('Are you sure?');">
                                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </a>
						    <?php //} ?>
						    <a href="<?php echo $querylink;?>" class="tablectrl_small bDefault tipS" title="View query">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-comment"></i>
                                                        </button>
                                                    </a>
																	 <a href="<?php echo $viewlink;?>" class="tablectrl_small bDefault tipS" title="View">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-eye"></i>
                                                        </button>
                                                    </a>
						    <?php if($property['agent_id'] == '0'){ ?>
						    <a href="<?php echo $previewlink ;?>" class="tablectrl_small bDefault tipS previewLink" title="Preview" target="_blank">
                                                        <button type="button" class="btn btn-orange"><i class="glyphicon glyphicon-zoom-in"></i>
                                                        </button>
                                                    </a>
						    <?php } ?>
						    </div>
						    <div class="previewBox well well-sm" style="display: none;margin-top:5px;">
							<strong>Preview URL: </strong><?php echo $previewlink ?>
						    </div>	
							<div style="width:125px;margin: 0 auto;">
							    <img class="statusLoader loader" id="loader_<?php echo $property['property_master_id']; ?>" src="<?php echo BACKEND_URL."vendors/pageloader/images/loader7.GIF" ?>" />
							</div>
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="6">..::..No records found..::..</td></tr>
                            <tr><td colspan="6">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
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