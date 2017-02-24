<!--<script src="<?php echo BACKEND_JS_PATH; ?>jquery.fancybox-1.3.4.pack.js"></script>
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
	
</script>-->
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
        <div class="page-title">Long Term Rental List</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
       
       <li><i class="fa  fa-building-o"></i>&nbsp;&nbsp;<a href="javascript:void(0)">Long Term Rental</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active"><i class="fa fa-building-o"></i>&nbsp;&nbsp;<a href="<?php echo $show_all;?>" >List</a></li>
        
           
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
                                    <div class="col-lg-12"><h4 class="box-heading">Long Term Rental Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>longrentals/index/">
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
                                            
                                        
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo $batch_action_link;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                  <tr>
							<th data-sort-ignore="true"><input type="checkbox" id="checkallbox" name="checkallbox" /></th>
                <th data-toggle="true">Property Image</th>
		<th data-toggle="true">Property Name</th>
                <th data-toggle="true">Display Title(Property Title)</th>
		<th data-toggle="true">Optional Title</th>
		<th data-toggle="true">Location</th>
                <th data-hide="phone,tablet">Status</th>
                <th>Actions</th>
						  </tr>
                                                </thead>
					    <tbody>
						 <?php 
							if($propertyMasterList){			      
								for($i=0; $i<count($propertyMasterList); $i++){ //pr($propertyMasterList); 
											      
									$editLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$edit_link);
									$imageLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$image_link);
									$editPrices	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$edit_prices);
									$deleteLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$delete_link);
									$statusLink	= str_replace("{{ID}}",$propertyMasterList[$i]['property_id'],$status_link);  
									$statusLink	= str_replace("{{STATUS_LINK}}",'edit_property_status',$statusLink);  
									
									$db_user_image  = stripslashes($propertyMasterList[$i]['property_id']);
									$class 		= 'class="even"';
									
									
									  
									if($propertyMasterList[$i]['status'] == 'active')
									{
										$status = 'Live';
										$class=" live";
										$status_class="green";
									}
									else
									{
										$status = 'Not Live';
										$class =" not-live";
										$status_class="red";
									}
									?>
										  <tr class="<?php echo $class; ?>" id="tr<?php echo $propertyMasterList[$i]['property_id'];?>">
											<td  ><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $propertyMasterList[$i]['property_id'];?>" /></td>
											<td>
												<?php 
													if( $propertyMasterList[$i]['image_file_name'] != '' AND  file_exists( FILE_UPLOAD_ABSOLUTE_PATH."property/".$propertyMasterList[$i]['image_file_name'] )){
												?>
													<img height="150" width="200" src="<?php echo FRONTEND_URL;?>upload/property/<?php echo $propertyMasterList[$i]['image_file_name'];?>">
													<?php }else{ ?>
													<img height="150" width="200" src="<?php echo BACKEND_IMAGE_PATH;?>no_img_180@2x.png">
												<?php  } ?>
											</td>
											<td valign="baseline" width="15%"><?php echo stripslashes($propertyMasterList[$i]['property_name']);?></td>
											<td><?php echo stripslashes($propertyMasterList[$i]['page_title']);?></td>
											<td><?php echo stripslashes($propertyMasterList[$i]['optional_title']);?></td>
											<td><?php echo stripslashes($propertyMasterList[$i]['location_name']);?></td>
											
											
											<td class="statusLabel<?php echo $propertyMasterList[$i]['property_id'];?>">
                                                    
                                                    <?php if($status=="Live")
                                                    {
                                                    ?>
                                                        <span class="label label-sm label-success"><b>Live</b></span>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <span class="label label-sm label-danger"><b>Not Live</b></span>
                                                    <?php
                                                    }
                                                    ?>
                                                   
                                                        <!--<label class="<?php if($status=="Live"){echo "greenText";}else{echo "redText";} ?>"><b><?php echo ucfirst($status);?></b></label>-->
                                                    </td>
											<td>
                                                   <?php if($status=="Live")
                                                   {
                                                   ?>
                                                        
                                                        <a href="<?php echo $statusLink;?>"  id="<?php echo $propertyMasterList[$i]['property_id'];?>"  title="Change Status" class="changeStatus changeStatusbtn">
                                                        
                                                        <button type="button" class="btn property_list_change_status btn-success btn-xs statusbtn<?php echo $propertyMasterList[$i]['property_id'];?>" ><i class="fa fa-check-square-o"></i>&nbsp;
                                                            Change Status
                                                        </button>
                                                        
                                                        </a> &nbsp; <br>      
                                                        
                                                  <?php
                                                   }
                                                   elseif($status=="Not Live")
                                                   {
                                                   ?>
                                                    
                                                         <a href="<?php echo $statusLink;?>"  id="<?php echo $propertyMasterList[$i]['property_id'];?>"  title="Change Status" class="changeStatus changeStatusbtn">
                                                        
                                                        <button type="button" class="btn property_list_change_status btn-danger btn-xs statusbtn<?php echo $propertyMasterList[$i]['property_id'];?>"><i class="fa fa-times-circle-o"></i>&nbsp;
                                                            Change Status
                                                        </button>
                                                        
                                                        </a>  &nbsp; <br>
                                                    
                                                   <?php 
                                                   }
                                                   
                                                   ?>
								 
							<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS changeStatus" title="Edit Property"><button type="button" class="btn  btn-info btn-xs property_list property_list_edit"><i class="fa fa-edit"></i>&nbsp;
                                                            Edit 
                                                        </button></a>
								     <!-- <br>			      
								      <a class="various3 previewLinkBtn changeStatus" href="<?php //echo FRONTEND_URL;?>property/property_preview/<?php //echo $propertyMasterList[$i]['property_id'];?>/"><span class=" property_list property_list_preview">Preview</span></a>-->
								      &nbsp; <br><br>
								      <a class="previewLinkBtn changeStatus" href="<?php echo $editPrices;?>"><button type="button" class="btn btn-pink btn-xs property_list property_list_preview"><i class="fa fa-money"></i>&nbsp;
                                                        Price
                                                    </button></a>
								      <br>
									<!--<a class="previewLinkBtn changeStatus no-cache-redirect" href="<?php //echo BACKEND_URL.'booking/custombooking/'.$propertyMasterList[$i]['property_id'].'/'; ?>"><span class=" property_list property_list_preview">Custom Booking</span></a>-->
								      <br>
								      <a href="<?php echo $deleteLink;?>" class="red changeStatus" title="Remove" onclick="return confirm('Deleting property will delete enqueries, bookings, availability and other information related to this property. Do you still want to delete the property?');"><button type="button" class="btn btn-danger btn-xs property_list property_list_delete"><i class="fa fa-trash-o"></i>&nbsp;
                                                        Delete
                                                    </button> </a></td>
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
    
//    function changeStatus(element){
//	var team_id=$(element).attr('data-team');
//	$("#loader_"+team_id).css("visibility","visible");
//	$.ajax({
//		
//		url:"<?php echo base_url() ?>team/edit_status",
//		type:"POST",
//		data:{"team_id":team_id},
//		success:function(msg){
//			//alert($(this).prop('data-status'));
//			
//			if ($(element).hasClass("btn-success")==true) {
//				$(element).addClass("btn-primary");
//				$(element).removeClass("btn-success");
//				//$("#status-label"+team_id).text("Inactive");
//			}
//			else if ($(element).hasClass("btn-primary")==true) {
//				$(element).addClass("btn-success");
//				$(element).removeClass("btn-primary");
//				//$("#status-label"+team_id).text("Active");
//			}
//			$(element).text(msg);
//			$("#loader_"+team_id).css("visibility","hidden");
//		}
//	});
//    }
</script>
<script type="text/javascript">
	
	
	$(".changeStatusbtn").click(function(){
		var property_id =  $(this).attr('id');
		var href =  $(this).attr('href');
		var newclass='';
		var removeClass = "";
		var label = '';
		//alert(href);
		$.ajax({
		type: "POST",
		dataType: "HTML",
		url: "<?php echo BACKEND_URL; ?>" + "longrentals/edit_property_status/",
		data: { property_id: property_id},
		success:function(data) {
				if (data=="active") {
					newclass = "live";
					removeClass = "not-live";
					removeButtonClass="btn-danger";
                                        newButtonClass=" btn-success";
					span='<span class="label label-sm label-success"><b>Live</b></span>';
                                        button = '<i class="fa fa-check-square-o"></i>&nbsp;Change Status';
				}else{
					newclass = "not-live";
					removeClass = "live";
					removeButtonClass="btn-success";
                                        newButtonClass="btn-danger";
                                        span='<span class="label label-sm label-danger"><b>Not Live</b></span>';
                                        button = '<i class="fa fa-times-circle-o"></i>&nbsp;Change Status';
				}
				$('#tr'+property_id).removeClass(removeClass);
				$('#tr'+property_id).addClass(newclass);
				$("#"+ property_id + "  .property_list_change_status").removeClass(removeButtonClass);
				$("#"+ property_id + " .property_list_change_status").addClass(newButtonClass);
				//$(".statusLabel"+property_id).html(label);
                                 $(".statusbtn"+property_id).html(button);
                                $(".statusLabel"+property_id).html(span);

			}
		});
		
		return false;
	});

</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->