<script src="<?php echo BACKEND_URL;?>js/jquery-birthday-picker.min.js"></script>

<div class="page-content">
	
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Reports</h3>
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
			      <div class="caption"> Reports</div>
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
<h3 class="page-title">Reports</h3>
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
                                    <div class="col-lg-12">

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="">
                                            <div class="row mbl cusTab">
                                                <div class="col-lg-12">
                                                    <div class="input-group input-group-sm mbs">
                                                      <h2>Your Property Rating is-<?php echo $rating['totalFeedback'];?><span>%</span></h2>
						    <!-- <div class="container">-->
                            <div class="fromTo fromToNew">
						   <h3 style="float:left;font-weight: bold;">Search</h3>
						   <h3>From</h3>  <div id="default-settings"></div>
						   <h3>To</h3>  <div id="default-settings1"></div>
                           <input type="button" value="Go!" id="search" name="search">
                           </div>
						     <input type="hidden" name="from_dt" id="from_dt" value="">
						     <input type="hidden" name="to_dt" id="to_dt" value="">
						     <!--</div>-->
                                                   
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            </form>
                                          
       <div id="no-more-tables" class="refTable">
	 <div class="tableTitle"><?php echo $rating['customer_review'];?> Customer reviews for your hostel for this Dates</div>
          <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
              <thead>
              <tr>
                  <th>Reference</th>
                  <th>Nationality</th>
		  <th>Date</th>
		  <th>Ch</th>
		  <th>Se</th>
		  <th>L</th>
		  <th>St</th>
		  <th>A</th>
		  <th>CL</th>
		  <th>V</th>
		  <th>F</th>
		  <th>All</th>
		  <th>Comment</th>
		  <th>Source</th>
		  <th>Reply</th>
		  <th>Query</th>	
              </tr>
              <tbody>
              <?php
              //pr($report_details);
               
              if(is_array($report_details) & !empty($report_details))
              {
              foreach($report_details as $property)
              {
              ?>  
              <tr>
                <td><?php echo stripslashes($property['reference_id']);?></td>
		 <td><?php echo stripslashes($property['countryName']);?></td>
		 <td><?php echo date('Y-m-d',strtotime($property['added_on']));?></td>
		 <td>-</td>
		 <td><?php echo stripslashes($property['security']);?></td>
		 <td><?php echo stripslashes($property['location']);?></td>
		 <td><?php echo stripslashes($property['staff']);?></td>
		 <td><?php echo stripslashes($property['atmosphere']);?></td>
		 <td><?php echo stripslashes($property['cleanliness']);?></td>
		 <td><?php echo stripslashes($property['value_for_money']);?></td>
		 <td><?php echo stripslashes($property['facilities']);?></td>
		 <td><?php echo stripslashes($property['totalFeedback']).'%';?></td>
		 <td><?php echo ($property['comments'] != '')?stripslashes($property['comments']):'None';?></td>
		 <td>Hostelmofo</td>
		 <td><?php echo ($property['comments'] != '')?'<a href="'.AGENT_URL.'reports/reply/'.$property['feedback_id'].'" title="'.stripslashes($property['comments']).'">Reply</a>':'N/A'; ?></td>
		 <td><?php if($property['comments'] != ''){?>
		 <a onclick="return confirm('Are you sure?');" href="<?php echo AGENT_URL.'reports/query/'.$property['feedback_id']; ?>" title="<?php echo stripslashes($property['comments']);?>" >Query</a>
		 <?php } ?>
		 </td>
		 
	     </tr>
            <?php } } else {  ?>
                            <tr><td colspan="17">..::..No records found..::..</td></tr>
                            <tr><td colspan="17">&nbsp;</td></tr>                
                            <?php } ?>
                                                </tbody>
                                                </thead></table>
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
$("#default-settings").birthdayPicker();
$("#default-settings1").birthdayPicker();
</script>
  <script>
  jQuery(document).ready(function() {
    <?php
   $from1 = explode('-',$from);
   $to1 = explode('-',$to);
   if(is_array($from1) && $from != ''){
   ?>
   $('#default-settings .birthMonth option:eq(<?php echo $from1[1]; ?>)').attr('selected', 'selected');
   $('#default-settings .birthDate option:eq(<?php echo $from1[2]; ?>)').attr('selected', 'selected');
   $('#default-settings .birthYear').find('option[value="' + <?php echo $from1[0]; ?> + '"]').attr("selected", "selected");
   <?php }
    if(is_array($to1) && $to != ''){?>
   $('#default-settings1 .birthMonth option:eq(<?php echo $to1[1]; ?>)').attr('selected', 'selected');
   $('#default-settings1 .birthDate option:eq(<?php echo $to1[2]; ?>)').attr('selected', 'selected');
   $('#default-settings1 .birthYear').find('option[value="' + <?php echo $to1[0]; ?> + '"]').attr("selected", "selected");
   <?php } ?>
   
    $(document).on('click', '#search', function(){
    var from_dt = ($('#default-settings').find(".birthDay").val());
    var to_dt = ($('#default-settings1').find(".birthDay").val());
    $('#from_dt').val(from_dt);
    $('#to_dt').val(to_dt);
    $( "#perPageFrm" ).submit();
    });
    $("#per_page").change(function(){
      $(this).parents('form').submit();
      });
    $('#btn_show_all').click(function(){
	$('#search_keyword').val('');
	$(this).parents('form').submit();
     })
  });
  </script>