<div class="page-content">
	
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Room Details</h3>
<?=$property_header?>
    <!-- END PAGE HEADER-->
     <?php if(isset($succmsg) && $succmsg != ""){ ?>
      <div align="center">
	<div class="alert alert-success">
	  <p><?php echo stripslashes($succmsg);?></p>
	</div>
      </div>
      <?php } ?>
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
      <div align="center">
	<div class="alert alert-danger">
	  <p><?php echo stripslashes($errmsg);?></p>
	</div>
      </div>
      <?php } ?>
      
	<div class="portlet light">
	  <div class="row">
	    <div class="col-sm-12">
		<div class="portlet box blue">
		      <div class="portlet-title">
			      <div class="caption"> Booking</div>
		      </div>						
		    <div class="portlet-body">
			
			<?=$tabs?>
			    <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div class="page-content room-details">
<h3 class="page-title"> Room List</h3>
<?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="portlet light">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                                <div class="row">
                                    <div class="col-lg-12"><h4 >Room search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="">
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
                                                    <label for="un_member">View</label>
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo AGENT_URL."provines/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
					     			                   <div id="no-more-tables">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th width="3%">Type Name</th>
                                                    <th width="10%">Size</th>
                                                    <th width="10%">Room Label</th>
																	 <th width="10%">Base price</th>
						   						             <th width="10%">Price Charge Type</th>
						    							
                                                    <th width="12%" style="text-align: center;">Actions</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                 //pr($room_details);
                                                 
                                                if(is_array($room_details))
                                                {
                                                foreach($room_details as $property)
                                                {
						  
                                               // $previewlink 	=  FRONTEND_URL.'preview-property/'.$property[''].'/'.$property[''].'/'.$property[''].'/'.$property['']; 
                                                //$editLink	= str_replace("{{ID}}",$property[''],$edit_link);
                                               //$deleteLink	= str_replace("{{ID}}",$property[''],$delete_link);
						//$availabilitylink = str_replace("{{ID}}",$property[''],$availability_link);
						//$bookinglink = str_replace("{{ID}}",$property[''],$booking_link);
                                                ?>  
                                                <tr>
						    
                                                    <td data-title="Name">
							<?php echo stripslashes($property['type_name']);?>
							<br/>
							
							<?php //echo '<a href="'.$link.'" target="_blank">'.$link.'</a>'; ?>
						    </td>
                            <td data-title="Province"><?php echo ($property['size']!='')?stripslashes($property['size']):'NA';?></td>
						    <td data-title="Type"><?php echo stripslashes($property['room_lable']);?></td>
						   <td><?php echo stripslashes($property['base_price']);?></td>
							<td>
							<?php if($property['price_charge_type'] == "per_person") echo "Per Person";
									else echo "Per Night" ;?>
							</td>
                             <td data-title="Action" width='10%' style="text-align: center;">
							<div >
						   					<?php 


						   			$id	=  $property['id'];?>
							
						    <a href="<?php echo AGENT_URL."room_details/edit/$id";?>" class="tablectrl_small bDefault tipS previewLink" title="Edit">
                                                        <button type="button" class="btn btn-orange"><i class="fa fa-edit"></i>
                                                        </button>
                            </a>
						    
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
  
    var  succ_msg = '<?php echo isset($succmsg)?$succmsg:''; ?>';
    var  err_msg = '<?php echo isset($errmsg)? $errmsg : ''; ?>';
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

<!--END CONTENT QUICK SIDEBAR-->		    </div>
		</div>
	    </div>

	
	</div>
	<!-- BEGIN DASHBOARD STATS -->
	<!-- END DASHBOARD STATS -->
       
</div>
</div>

  <script>
  jQuery(document).ready(function() {    
   
 
    $("#per_page").change(function(){
      $(this).parents('form').submit();
      });
    $('#btn_show_all').click(function(){
	$('#search_keyword').val('');
	$(this).parents('form').submit();
     })
  });
  </script>