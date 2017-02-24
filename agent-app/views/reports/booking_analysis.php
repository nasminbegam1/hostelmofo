<script src="<?php echo AGENT_JS_PATH; ?>highcharts.js" type="text/javascript"></script>
<div class="page-content">
<h3 class="page-title">Reports</h3>
<?=$property_header?>
      
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
	 <div class="portlet-body">
            <div id="container"></div>
	    <?php //pr($lastTwoMonthResult);?>
	    <table width="100%" class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
	     <tr>
	      <td>Hostel Booking</td>
	      <td><?php echo date('M', strtotime('-2 month'));?></td>
	      <td><?php echo date('M', strtotime('-1 month'))?></td>
	      <td>% diff</td>
	     </tr>
	     <tr>
	      <td>Total booking for <?php echo $property_name;?></td>
	      <td><?php echo (isset($lastTwoMonthResult['lasttwomonth']))?$lastTwoMonthResult['lasttwomonth']:0; ?></td>
	      <td><?php echo (isset($lastTwoMonthResult['lastmonth']))?$lastTwoMonthResult['lastmonth']:0; ?></td>
	      <td><?php if(isset($lastTwoMonthResult['lastmonth']) && isset($lastTwoMonthResult['lasttwomonth']) && $lastTwoMonthResult['lasttwomonth'] != '0'){ (($lastTwoMonthResult['lastmonth']-$lastTwoMonthResult['lasttwomonth'])/$lastTwoMonthResult['lastmonth'])*100; }else{ echo '0'; } ?></td>
	     </tr>
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
</div>
<?php
$month 	= '';
$res 	= '';
$max = 0;
if(is_array($booking_analysis_report)){
foreach($booking_analysis_report as $bReport){
 $month .=  "'".$bReport['months']."',";
 $res 	.=  $bReport['res'].',';
  if ($bReport['res'] > $max) {
        $max = $bReport['res'];
    }
} }
?>
<style>
 .highcharts-container svg .highcharts-yaxis-labels {
    display: none;
</style>
<script>
 $(function () {
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
         text: 'Monthly Booking -Last 12 Months'
        },
	credits: {
    enabled: false
  },
        xAxis: {
	  type: 'category',
	  categories: [<?php echo $month; ?>]
        },
        yAxis: {
	 min: 0,
	 title: {text: null},
	 gridLineWidth: 0,
	 minorGridLineWidth: 0,
	 max: <?php if(strlen($max) == 1 || strlen($max) == 2){echo '100';}elseif(strlen($max)> 2){echo '1000';} ?>,
        },
	tooltip: {
                   formatter: function(){
                   return '<b>'+ Highcharts.numberFormat(Math.abs(this.point.y), 0) +'</b>';
		 }
        },
        legend: {
            enabled: false
        },
        series: [{
	colorByPoint: false,
        data: [<?php echo $res; ?>],
	color: '#291EFF'
	}]
	});
});
</script>