			  <div class="page-content">
				  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				  <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								  <h4 class="modal-title">Modal title</h4>
							  </div>
							  <div class="modal-body">
								   Widget settings form goes here
							  </div>
							  <div class="modal-footer">
								  <button type="button" class="btn blue">Save changes</button>
								  <button type="button" class="btn default" data-dismiss="modal">Close</button>
							  </div>
						  </div>
						  <!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
				  </div>
				  <!-- /.modal -->
				  <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				  <!-- BEGIN STYLE CUSTOMIZER -->
	  <!-- END STYLE CUSTOMIZER -->
	  
			  <!-- BEGIN PAGE HEADER-->
			  <h3 class="page-title"> Salons List</h3>
			  <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>
			  
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
					  <div class="portlet box">
					      <div class="portlet-body">
						  <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo ADMIN_URL;?>salons/index/">
						      <div class="row">
							  <div class="col-sm-4">
							    <div class="input-group">
								<label for="table_search">Search:</label>
								<input type="text" id="search_keyword" name="search_keyword" class="form-control" value="<?php echo $search_keyword; ?>">
							      </div>
							  </div>                        
							  <div class="col-sm-3">
							      <div class="input-group">
							      <label for="table_search">&nbsp;</label><br/>
							      <input class="btn btn-default" type="submit" name="btn_submit" id="btn_submit" value="Search" />
							      <button class="btn btn-default" name="btn_show_all" id="btn_show_all">Show All</button> 
							      </div>
							  </div>
							  <div class="col-sm-4 ">
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

								
				    
				    <div class="clearfix"></div>
				    <div class="row">
				      <div class="col-sm-12">
					  <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">Salon Listing</div>
						</div>						
					      <div class="portlet-body">
						      <table id="resp_table" class="table table-striped table-hover table-bordered">
						      <thead>
							    <tr>
							      <th data-sort-ignore="true">#</th>
							      <th data-toggle="true">Salon Name</th>
							      <th data-hide="phone,tablet">Team</th>
							      <th data-hide="phone,tablet">Current Plan</th>
							      <th data-hide="phone,tablet">Created</th>
							      <th data-hide="phone,tablet">Salon Status</th>						      
							      <th>Actions</th>
							      
							    </tr>
							  </thead>
								      <tfoot>
							<tr>
							  <td colspan="6">                      
							<?php
							$show_to_record 	= $startRecord + $per_page;
							$to_record		= $show_to_record;
							if($show_to_record > $totalRecord) {
							      $to_record = $totalRecord;
							}
							?>
							  <div class="footerPagination"> <span class="showRecCount">Showing <?php echo $to_record != 0? $startRecord+1:0; ?> to <?php echo $to_record; ?> of <?php echo $totalRecord; ?> entries</span> <?php echo $this->pagination->create_links();?> </div>
							    </td>
							</tr>
						      </tfoot>
						      <tbody>
							  <?php
							  if($records){
										    
							  for($i=0; $i<count($records); $i++){
							        $viewDetailsLink = str_replace("{{ID}}",$records[$i]['salon_id'],$view_details_link);
								$editLink = str_replace("{{ID}}",$records[$i]['salon_id'],$edit_link);
								$viewContactLink = str_replace("{{ID}}",$records[$i]['salon_id'],$view_contact_link);
								$viewAppointmentsLink = str_replace("{{ID}}",$records[$i]['salon_id'],$view_appointments_link);
								
								$inventoryLink   = str_replace("{{ID}}",$records[$i]['salon_id'],$view_inventory_link);
								$deleteLink = str_replace("{{ID}}",$records[$i]['salon_id'],$delete_link);
								$productInventory = str_replace("{{ID}}",$records[$i]['salon_id'],$product_inventory);
								$fixedInventory = str_replace("{{ID}}",$records[$i]['salon_id'],$fixed_inventory);
								$orderManager = str_replace("{{ID}}",$records[$i]['salon_id'],$order_manager);
								$productUsage = str_replace("{{ID}}",$records[$i]['salon_id'],$product_usage);
								$productSales = str_replace("{{ID}}",$records[$i]['salon_id'],$product_sales);
								$class = 'class="even"';
								if($i%2==0)
									$class = 'class="even"';
								else
									$class = 'class="odd"';
							  ?>
						      <tr <?php echo $class; ?>>
							      <td><?php echo $i+1+$startRecord; ?></td>
							  <td><?php echo stripslashes($records[$i]['salon_name']);?></td>
							  <td><?php echo stripslashes($records[$i]['is_team']);?></td>
							  <td>
							  <?php if(count($records[$i]['ORDERS'])){?>
							         Plan: <?php echo $records[$i]['ORDERS']['plan_name']?>
							  <?php }else{?>
							         Plan: Free User
							  <?php }?>
							   <br/>
							   Activated on: <?php echo date('jS M, Y', strtotime($records[$i]['activated_at']))?><br/>
							   Expire On: <?php echo date('jS M, Y', strtotime($records[$i]['expiry_date']))?>   
							  </td>
							  <td><?php echo date('jS M, Y', strtotime($records[$i]['created_at']));?></td>
							  <td>
								<?php
								if($records[$i]['salon_status']=='pending'){
									$statusClass = 'btn-warning';
								}elseif($records[$i]['salon_status']=='approved'){
									$statusClass = 'btn-success';
								}elseif($records[$i]['salon_status']=='disapproved'){
									$statusClass = 'btn-primary';
								}elseif($records[$i]['salon_status']=='expired'){
									$statusClass = 'btn-danger';
								}
								?>
								<div class="btn-group">
									<button type="button" class="btn btn-sm <?php echo $statusClass?> dropdown-toggle" data-toggle="dropdown"><?php echo ucwords($records[$i]['salon_status']);?> <i class="fa fa-angle-down"></i></button>
									<ul class="dropdown-menu" role="menu">
								<?php
								if($records[$i]['salon_status']!='pending'){ ?>
										<li>
											<a href="#" class="status_change_demo_class" salon_id="<?php echo $records[$i]['salon_id']?>" status="pending">
											Pending </a>
										</li>
								<?php } if($records[$i]['salon_status']!='approved'){ ?>
										<li>
											<a href="#" class="status_change_demo_class" salon_id="<?php echo $records[$i]['salon_id']?>" status="approved">
											Approved </a>
										</li>
								<?php } if($records[$i]['salon_status']!='disapproved'){ ?>
										<li>
											<a href="#" class="status_change_demo_class" salon_id="<?php echo $records[$i]['salon_id']?>" status="disapproved">
											Disapproved </a>
										</li>
								<?php } if($records[$i]['salon_status']!='expired'){ ?>
										<li>
											<a href="#" class="status_change_demo_class" salon_id="<?php echo $records[$i]['salon_id']?>" status="expired">
											Expired </a>
										</li>
								<?php }
								?>
								



										
									</ul>
								</div>

							  
							  </td>
							  <td>
								<div class="btn-group">
									<button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
									Select Action <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="<?php echo $viewDetailsLink;?>">
											View Details </a>
										</li>										
										<li>
											<a href="<?php echo $viewContactLink; ?>">
											View Contact</a>
										</li>
										<li>
											<a href="<?php echo $viewAppointmentsLink; ?>">
											Appointments</a>
										</li>										
										<li>
											<a href="<?php echo $inventoryLink; ?>">
											Inventory</a>
										</li>
										<li>
											<a href="<?php echo $editLink;?>">
											Edit </a>
										</li>										
										<li>
											<a class="delete_action_demo_class" target_page_delete="<?php echo $deleteLink;?>">
											Delete </a>
										</li>
										
									</ul>
								</div>
								<!--<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
								
                                                                |  

								<i class="glyphicon glyphicon-trash font-blue delete_action_demo_class" target_page_delete="<?php echo $deleteLink;?>" title="Delete"></i>-->

							        
							  
								<div class="btn-group">
									<button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
									Select Report <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="<?php echo $productInventory;?>">Product Inventory</a>
										</li>										     <li>
											<a href="<?php echo $fixedInventory;?>">Fixed asset inventory</a>
										</li>
										<li>
											<a href="<?php echo $orderManager;?>">Order Manager</a>
										</li>
										<li>
											<a href="<?php echo $productUsage;?>">Products Usage Report</a>
										</li>
										<li>
											<a href="<?php echo $productSales;?>">Products Sales Report</a>
										</li>
										
									</ul>
								</div>
								
							  </td>
						      </tr>
						      <?php } }  else {  ?>
							  <tr><td colspan="6" align="center">..::..No records found..::..</td></tr>
							           
						      <?php } ?>
						    </tbody>
			      
						      
						      
						      </table>
						      
			  			      <form method="post" id="status_update_form">
							<input type="hidden" name="salon_id" id="salon_id" value="">
							<input type="hidden" name="salon_status" id="salon_status" value="">
						        <input type="hidden" name="action" value="statusChange">
						      </form>
					      </div>
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
    $('.status_change_demo_class').click(function(){
	
	if (confirm("Do you want to change the status?")==false) {
		return false;
	}
	$("#salon_id").val($(this).attr('salon_id'));
	$("#salon_status").val($(this).attr('status'));
	$("#status_update_form").submit()
	
    });
    
    $('.delete_action_demo_class').click(function(){
	tagetpage = $(this).attr('target_page_delete');
	if (confirm("Do you want to delete this salon?")==false) {
		return false;
	}
	window.location.href=tagetpage;
    })
     

  });
  </script>