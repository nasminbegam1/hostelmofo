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
<h3 class="page-title"> Contact us form</h3>
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
			<form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo AGENT_URL.currentClass();?>/contact_us/">
			    <div class="row">
				<div class="col-sm-4">
				  <div class="input-group">
				      <label for="table_search">Contact us form Search Panel:</label>
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
			      <div class="caption">Contact form Listing</div>
		      </div>						
		    <div class="portlet-body">
			    <table id="resp_table" class="table table-striped table-hover table-bordered">
			    <thead>
				  <tr>
				    <th data-toggle="true">Enquired by</th>
				    <th data-hide="phone,tablet">Email</th>
				    <th data-hide="phone,tablet">Message</th>
				    <th data-hide="phone,tablet">Phone</th>
				    <th data-hide="phone,tablet">Added on</th>
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
                            if($contactList){
                            for($i=0; $i<count($contactList); $i++){
			      
			        if($contactList[$i]['contact_email']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($contactList[$i]['contact_email']);
			       }
				
				$class = 'class="even"';
				if($i%2==0)
					$class = 'class="even"';
				else
					$class = 'class="odd"';
					
				if(stripslashes(trim($contactList[$i]['contact_message'])) != '') {
				  $notes = sub_word($contactList[$i]['contact_message'], 50);
				} else {
				  $notes = 'N.A.';
				}
				
			  //$pos = stripos($notes, "wdc");
			 
                        ?>
			    <tr <?php echo $class;?>>
				<td><?php echo stripslashes($contactList[$i]['contact_name']);?></td>
				<td><?php echo $email;?></td>
				<td><?php echo $notes;?></td>
				<td><?php echo ($contactList[$i]['contact_phone'] != '') ? $contactList[$i]['contact_phone'] : 'N.A.';?></td>
				<td><?php echo @date("d/m/Y H:i:s", strtotime($contactList[$i]['added_datetime']));?></td>
				<td><a href="javascript:void(0);" class="various3 previewLinkBtn changeStatus btn btn-green" data-toggle="modal" data-target="#modal-contact<?php echo $contactList[$i]['contact_us_id'];?>">
							<i class="glyphicon glyphicon-eye-open"></i>
			    </a>
                            
                    <div class="modal fade in" aria-hidden="false" aria-labelledby="modal-default-label" role="dialog" tabindex="-1"  id="modal-contact<?php echo $contactList[$i]['contact_us_id'];  ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                               <!-- <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>-->
                                <h4 class="modal-title" id="modal-default-label">Contact Message</h4></div>
                            <div class="modal-body"><?php echo stripslashes(trim($contactList[$i]['contact_message'])); ?></div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                <!--<button class="btn btn-primary" type="button">Save changes</button>-->
                            </div>
                        </div>
                    </div>
                </div>
				</td>
			    </tr>
			    <?php }
			    }  else {  ?>
				<tr><td colspan="6" align="center">..::..No records found..::..</td></tr>
					 
			    <?php } ?>
			  </tbody>
    
			    
			    
			    </table>
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