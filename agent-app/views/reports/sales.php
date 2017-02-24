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
<?php echo $from;  echo $to;?>
            <div class="portlet light">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        <?php echo set_value('from_dt'); ?>
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                              <!-- Start : main content loads from here -->   
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            <div class="row mbl cusTab">
                                                <div class="col-lg-12">
                                                    <div class="input-group input-group-sm mbs">
						     <div class="fromTo fromToNew">
						     <h3>Get Report for:</h3>
						     <div><form name="perPageFrm" id="perPageFrm" method="post" action="">
						     <input type="hidden" name="action" value="yearReport">
						     <div>
						     <select name="year_select">
						      <option value="">Year</option>
						      <?php
						      $year = date('Y');
						      for($i=$year;$i>$year-15;$i--){?>
						      <option value="<?php echo $i; ?>" <?php echo ($year_select==$i)?" selected=' selected'":""?>><?php echo $i; ?></option>
						      <?php } ?>
						     </select>
						     <input type="submit" value="Go!" name="search">
						     </div>
						     </form></div>
                             </div>
						     <div class="orText">OR</div>
                             
						     <form name="perPageFrm" id="perPageFrm" method="post" action="">
                             <div class="fromTo fromToNew">
						      <input type="hidden" name="action" value="fromToReport">
						    <!-- <div class="container">-->
						   <h3>From</h3>  <div id="default-settings"></div>
						   <h3>To</h3>  <div id="default-settings1"></div>
						     <input type="hidden" name="from_dt" id="from_dt" value="">
						     <input type="hidden" name="to_dt" id="to_dt" value="">
						     <!--</div>-->
                                                   <input type="submit" value="Go!" id="search" name="dateReport">
                            </div>
						    </form>
                            
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row mbl">
                                            <div class="col-lg-12">
       <div id="no-more-tables">
          <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
              <thead>
              <tr>
                  <th>Own Bookings</th>
		  <th>Total</th>
              </tr>
	      </thead>
              <tbody>
              <tr>
                <td>Website Booking</td>
		<td><?php echo (is_array($customer_analysis_report) && $customer_analysis_report['website_booking'] != '')?$customer_analysis_report['website_booking']:0; ?></td>
              </tr>
	      <tr>
		<td>App Booking</td>
		<td><?php echo (is_array($customer_analysis_report) && $customer_analysis_report['app_booking'] != '')?$customer_analysis_report['app_booking']:0; ?></td>
	      </tr>
             </tbody>
                                                </table>
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