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
			  <h3 class="page-title"> Salons Appointment List</h3>
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
						  <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo ADMIN_URL;?>salons/view_appointments/<?php echo $salon_id;?>/<?php echo $page; ?>">
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
							<div class="caption">Salon Appointment Listing - <?php echo $getSingle[0]['salon_name'];?></div>
						</div>
					      <div class="portlet-body">
						      <table id="resp_table" class="table table-striped table-hover table-bordered">
						      <thead>
							    <tr>
							      <th data-sort-ignore="true">#</th>
							      <th data-toggle="true">App. no.</th>
							      <th data-hide="phone,tablet">App. Date</th>
							      <th data-hide="phone,tablet">Service</th>
							      <th data-hide="phone,tablet">Client</th>
							      <th data-hide="phone,tablet">Staff</th>
							      <th data-hide="phone,tablet">Action</th>
							    </tr>
							  </thead>
								      <tfoot>
							<tr>
							  <td colspan="7">                      
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
							        $details = str_replace("{{ID}}",$records[$i]['app_id'],$view_details_link);
								$details = str_replace("{{SALON_ID}}",$records[$i]['salon_id'],$details);
								
								$class = 'class="even"';
								if($i%2==0)
									$class = 'class="even"';
								else
									$class = 'class="odd"';
							  ?>
						      <tr <?php echo $class; ?>>
							  <td><?php echo $i+1+$startRecord; ?></td>
							  <td><?php echo stripslashes($records[$i]['app_no']);?></td>
							  <td><?php echo date('jS M, Y', strtotime($records[$i]['app_date']));?></td>
							  <td><?php
							        $names = array();
							        foreach($records[$i]['services'] as $service){
								$names[] = $service['service_name'];
							        }
								echo implode(', ',$names);
							       ?>
							  </td>
							  <td><?php echo stripslashes($records[$i]['customer']);?></td>							  
							  <td><?php
							        $names = array();
							        foreach($records[$i]['services'] as $service){
								$names[] = $service['staff'];
							        }
								echo implode(', ',$names);
							       ?>
							  </td>							  
							  
							  <!--<td><a href="<?php echo $contactDetails;?>" class="tablectrl_small bDefault tipS" title="Edit"><span class="glyphicon glyphicon-edit"></span></a></td>-->
							  <td><button type="button" class="btn dark" onclick="javascript:window.location.href='<?php echo $details;?>'" title="View">View</button></td>	
						      </tr>
						      <?php } }  else {  ?>
							  <tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
							           
						      <?php } ?>
						    </tbody>
			      
						      
						      
						      </table>
						      
			  			      <!--<form method="post" id="status_update_form">
							<input type="hidden" name="salon_id" id="salon_id" value="">
							<input type="hidden" name="salon_status" id="salon_status" value="">
						        <input type="hidden" name="action" value="statusChange">
						      </form>-->
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

  });
  </script>