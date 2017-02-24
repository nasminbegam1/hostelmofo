
<div class="detailsPanTop">
  <div class="listingContent globalClr"> <span class="lsitingTitle globalClr">
    <?php echo stripslashes($details['master_details']['property_name']); ?> in 
    <?php echo stripslashes($details['master_details']['city_name']); ?>,
    <?php echo stripslashes($details['master_details']['province_name']); ?>,
    Australia</span>
  </div>
</div>



<!-- Bottom panel-->

<div class="detailsPanBtm globalClr clearfix">
  <div class="reviewDetailsSec">
    <?php if(is_array($review_list))
    {
	    foreach($review_list as $list)
	    {
    ?>
    <div class="reviewListDiv globalClr clearfix"> <span class="reviewPerText ltCls"><em><?php echo $list['totalFeedback'];?>%</em></span>
      <div class="reviewContent rtCls">
	<div class="reviewText globalClr"><?php echo stripslashes($list['comments']);?></div>
	<div class="reviewDesc globalClr clearfix">
	  <div class="dateSec ltCls">
	      <span class="datevalue globalInline"><?php echo date('dS F Y',strtotime($list['review_datetime'])); ?></span>
	      <span class="globalInline"><?php echo stripslashes($list['first_name']); ?></span>
	      <span class="globalInline"><?php echo stripslashes($list['countryName']); ?>,
	      <?php echo stripslashes($list['gender']); ?></span>
	      </div>
	</div>
      </div>
    </div>

<?php }} ?>
   
  </div>
</div>
