<script src="<?php echo BACKEND_URL;?>js/jquery-birthday-picker.min.js"></script>

<div class="page-content">
	
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Market</h3>
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
			      <div class="caption">Market</div>
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
<div class="topContent">
 <span class="topHeading">Hostelmofo.com Elevate Programme: Bosting your Ranking</span>
 <div class="topDescription">
   <p>
    By opting to vary your service fee percentage, you can affect the ranking of your property on the hostelmofo.com website on the relevant search pages.You can check what your new ranking should be after you have enterd the new service fee below. When you have found the service fee you want , you should save it and it will become effective shortly afterwards. To revert to your former service fee, you must update the service fee againthrough this channel. You can update your service fee as frequently as you wish.
   </p>
   <span>
    Please note that
    <ul>
     <li>Preview of search results shown on this page represent the position you would hold the precise moment of the preview request. Search result rankings are continously changing on real time basis.</li>
     <li>Service fee percentage is not only factor that influence your ranking. It is subject to the hostelmofo.com proprietary search result system. Which can be updated at our discretion.</li>
    </ul>
   </span>
   <span>
    user video guide is available <a href="#" class="link">here</a>
    <br>
     if you have quistions , please <a href="#" class="link">contact us</a> for more information
   </span>
 </div>
</div>
<div class="middleDIv">
 <div class="leftDiv">
   <div class="leftTopDiv">
<?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>

<?php ?>
	<?php $sf = $serviceFee['sitesettingsValue']['sitesettings_value'];
	$service_fees = $serviceFee['serviceFee']['service_fees']; ?>
	<h3>Vary Your service free</h3>
	<h4>Your current service fee is <?php echo $serviceFee['serviceFee']['service_fees']; ?>%</h4>
	<p>Change your % here and preview your new <br>Hostelmofo Position</p>
       <select name="serviceDrop" class="form-control serviceDrop">
	  <?php
	  for($i=$sf;$i<=$sf+15;$i++)
	  { 
	   $pm_id= $this->uri->segment(3);
	  ?>
	  <option value="<?php echo $i; ?>" data-service="<?php echo $pm_id.'--'.$i; ?>" <?php if($serviceFee['serviceFee']['service_fees'] == $i){echo 'selected'; }?>><?php echo $i; ?>%</option>
	  <?php }?>
       </select>
       <p>Only a manager user can confirm a service fee % change</p>
    </div>
    <div class="leftBotDiv">
     <p><i class="fa fa-clock-o"></i> History<em style="cursor: pointer;" class="view_complete">(view complete)</em></p>
     <table>
       <tr>
	<td></td>
	<td></td>
	<td>Old</td>
	<td>New</td>
       </tr>
       <?php
       if(is_array($rankLog) && COUNT($rankLog)>0)
       {
	 foreach($rankLog as $k=>$v){
       ?>
       <tr <?php if($k>0)echo "style='display:none' class='hidden_log'";?>>
	<td><?php echo gmdate('d/m/Y',strtotime($rankLog[$k]['added_date'])).' @'.gmdate('H:i:s',strtotime($rankLog[$k]['added_date']))."(GMT)";?></td> 
	<td>hostelmofo</td>
	<td><?php if(isset($rankLog[$k+1]['service_fees']))echo $rankLog[$k+1]['service_fees'].'%';else echo "N/A";?></td>
	<td><?php if(isset($rankLog[$k]['service_fees']))echo $rankLog[$k]['service_fees'].'%';else echo "N/A";?></td>
       </tr>
       <?php }}?>
     </table>
    </div>
 </div>
 <div class="rightDiv">
  <span class="subHeading">Properties in surface paradise in hostelmofo right now<em>(<?php echo COUNT($propertyId);?> total)</em> </span>
  <ul>
   <?php  
  foreach($propertyId as $propertyName)
  {  
    $name	= $propertyName['property_name'];
    $fee	= $propertyName['service_fees']; 
    $fee	=  floatval($fee);
    
    ?>
   <li <?php if(isset($propertyName['service_fees']) && $propertyName['service_fees'] != 0)echo 'class="special"';?>><span><?php if(isset($propertyName['service_fees']) && $propertyName['service_fees'] != 0)echo round($propertyName['service_fees']).'%';?></span> &nbsp;&nbsp;<?php echo stripslashes($name); ?></li>
  <?php } ?>
  </ul>
 </div>
</div>

<div class="faqTabContInn">
 <div class="faqHeading"><i style="cursor: pointer;" class="fa fa-info-circle"></i>FAQ</div>
 <?php if(is_array($faqList) && COUNT($faqList)>0){?>
 <div class="faqTabContBox">
  <ul>
   <?php foreach($faqList as $v){?>
   <li>
    <a title="<?php echo stripslashes($v['faq_title']);?>" onclick="showFaq(<?php echo $v['faq_id']?>,this);" class="acc_open" href="javascript:void(0);"><span><?php echo stripslashes($v['faq_title']);?></span></a>
    <div id="rentFaqRow1_<?php echo $v['faq_id']?>" class="faqDescFrmEditor" style="display: none;">
     <?php echo stripslashes($v['faq_desc']);?>
    </div>
   </li>
   <?php }?>
  </ul>
 </div>
 <?php }?>
</div>

<script>
 function showFaq(id, element) {
    jQuery('div[id^="rentFaqRow1_"]').not('#rentFaqRow1_' + id).slideUp();	
    jQuery('.acc_open').not(jQuery(element)).parent().removeClass('active');
    if (!jQuery(element).parent().hasClass('active')) {
	    jQuery(element).parent().addClass('active');
    } else {
	    jQuery(element).parent().removeClass('active');
    }
    jQuery('#rentFaqRow1_' + id).slideToggle();
  }
  $('.view_complete').click(function(){
   if ($(this).html() == '(view complete)')
    $(this).html('(view less)');
   else
    $(this).html('(view complete)');
    
   $('.hidden_log').toggle('slow');
  });
  $('.serviceDrop').change(function(){
    var service_fee = $('.serviceDrop').val();
    var property_id = <?php echo $this->uri->segment(3);?>;
    window.location.href = base_url+'market/updateService/'+property_id+'/'+service_fee;
  });
</script>