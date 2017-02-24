 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Property Approval Listing</div>
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
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            
                                            <?php
                                           
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                            ?>
                                           
                                            <div class="row mbm">
                                                <div class="col-lg-4">
                                                    <form action="" method="post" id="approvalFrm">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-home"></i>
                                                            </span>
                                                            <select name="approveStatus" id="approveSelect" class="form-control" onchange="document.getElementById('approvalFrm').submit();">
                                                                <option value="">Select any Status</option>
                                                                <option value="all" <?php echo ($search_keyword=='All')? 'selected="selected"':''; ?>>All Property</option>
                                                                <option value="Approved" <?php echo ($search_keyword=='Approved')? 'selected="selected"':''; ?>>Approved Property</option>
                                                                <option value="Decline" <?php echo ($search_keyword=='Decline')? 'selected="selected"':''; ?>>Decline Property</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-4 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."provines/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php //echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php //echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php //echo $page; ?>">
					     <div id="no-more-tables">
                                            <table class="table  table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    
                                                    <th width="10%">Property Name</th>
                                                    <th width="10%">Approve By (Name)</th>
						    <th width="8%">Approve By (Email)</th>
                                                    <th width="8%">Approve Status</th>
						    <th width="18%">Reason</th>
                                                    <th width="5%">Added Date</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                    <?php
                                                    if(is_array($propertyList) and count($propertyList)>0){ ?>
                                                      <?php foreach($propertyList as $index=>$property){ ?>
                                                      <?php $class= ($property['approval_status']=="Approved")?'note note-info':'note note-danger'; ?>
                                                         <tr class="<?php echo $class; ?>">
                                                            <?php
                                                            $property_link = '';
                                                            if($property['approval_status']=="Approved"){
                                                                $property_link = FRONTEND_URL.'property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'];
                                                            }else{
                                                                $property_link = FRONTEND_URL.'preview-property/'.$property['property_type_slug'].'/'.$property['province_slug'].'/'.$property['city_seo_slug'].'/'.$property['property_slug'];
                                                            }
                                                            ?>
                                                            <td><a href="<?php echo $property_link ?>"><?php echo $property['property_name']; ?></a></td>
                                                            <td><?php echo $property['agent_name']; ?></td>
                                                            <td><?php echo $property['agent_email']; ?></td>
                                                            <td><?php echo $property['approval_status']; ?></td>
                                                            <td><?php echo $property['agent_message']; ?></td>
                                                            <td><?php echo date("d/m/Y h:i A",strtotime($property['added_on'])); ?></td>
                                                         </tr>
                                                      <?php } ?>  
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td colspan="6">No Record Found</td>
                                                    </tr>
                                                    <?php }
                                                    ?>    
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