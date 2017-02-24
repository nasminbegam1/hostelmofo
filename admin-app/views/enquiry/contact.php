 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Contact us form</div>
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
                                    <div class="col-lg-12"><h4 >Contact form Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>enquiry/contact_us/">
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Contact form Listing 
                    	<!--<a href="<?php //echo $add_url;?>">
                            <div class="addSign label label-info" data-toggle="tooltip" data-placement="top auto" title="Add Enquiry">
                                <span class="glyphicon glyphicon-plus"></span>
                            </div>
                        </a> -->
                    </h4>
                </div>
                <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."enquiry/batch_action/0/".$page;?>" method="post">
                    <input type="hidden" name="group_mode" id="group_mode" value="" />  
                    <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                    <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                    <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">      
                	<table id="resp_table" class="table toggle-square">
                        <thead>
                              <tr>
                               <th style="width: 12%;" data-toggle="true">Enquired by</th>
                                <th style="width: 12%;" data-toggle="true">Email</th>
				<th style="width: 12%;" data-toggle="true">Message</th>
				<th style="width: 10%;" data-toggle="true">Phone</th>
				<th style="width: 8%;" data-sort-ignore="true">Added on</th>
				<th style="width: 7%;">Actions</th> 
                              </tr>
                            </thead>
        			
                        <tbody id="listing">
			  
			  <input type="hidden" id="contact_us_id" name="contact_us_id" value="<?php echo $contactList[0]['contact_us_id'];?>">
			  
			  <?php
			  //pr($enquiryList);
                            if($contactList){
                            for($i=0; $i<count($contactList); $i++){
			      
			        if($contactList[$i]['contact_email']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($contactList[$i]['contact_email']);
			       }	 
				//$viewLink = str_replace("{{ID}}",$contactList[$i]['contact_us_id'],$view_link);
				//$leadLink = str_replace("{{ID}}",$contactList[$i]['contact_us_id'],$lead_link);
				//$deleteLink = str_replace("{{ID}}",$contactList[$i]['contact_us_id'],$delete_link);
				
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
			
                        <tr>
                            <td><?php echo stripslashes($contactList[$i]['contact_name']);?></td>
                            <td><?php echo $email;?></td>
			    <td><?php echo $notes;?></td>
			    <td><?php echo ($contactList[$i]['contact_phone'] != '') ? $contactList[$i]['contact_phone'] : 'N.A.';?></td>

			    
			    <td><?php echo @date("d/m/Y H:i:s", strtotime($contactList[$i]['added_datetime']));?>
			    
			    </td>
                            <td>
                            
                            <a href="javascript:void(0);" class="various3 previewLinkBtn changeStatus btn btn-green" data-toggle="modal" data-target="#modal-contact<?php echo $contactList[$i]['contact_us_id'];?>">
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
                        <?php  } } else {  ?>
                            <tr><td colspan="10">..::..No records found..::..</td></tr>
                            <tr><td colspan="10">&nbsp;</td></tr>                
                        <?php } ?>
                      </tbody>
                        
                        
                	</table>
                </form>
            </div>
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