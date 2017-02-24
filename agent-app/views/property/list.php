<?php
$rss = new DOMDocument();
//$rss->load('http://wordpress.org/news/feed/');
$rss->load(RSS_XML);
$feed = array();

//echo "<pre>";print_r($rss);exit();
foreach ($rss->getElementsByTagName('item') as $node) {
	$item = array ( 
		'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
		'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		);
	array_push($feed, $item);
}
$limit = 5;
?>
 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div class="page-content">
<h3 class="page-title"> Property List</h3>

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
				       <!--<h4 >Property Search Panel</h4>-->
                                        <div class="table-container">
						<?php if($total_property==0){?>
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo $add_link;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add New</a>&nbsp;
                                                    </div>
                                                    </div>
						    <?php } else { ?>                                           
<div class="row mbm listingBox">
   <div class="col-lg-12">
	   <div class="row">
	       <div class="col-lg-4">
		  <div class="listBox">
			  <h5>Rates and Availability</h5>
			  <div class="listBoxContent">
				  <div class="calDiv"><img src="<?php echo AGENT_IMAGE_PATH.'print2.jpg';?>" alt="img" height="130" width="250"/></div>
				  <p>Your last available date online is: 23rd January 2016</p>
				  <p class="btmLink"><a href="<?php echo AGENT_URL.'property/availability/'.$propertyList[0]['property_master_id'].'/'.date('Y').'/';?>">Update your availibility</a></p>
			  </div>
		  </div>
	       </div>
	       <div class="col-lg-4">
		       <div class="listBox">
			       <h5>Elevate NOW!</h5>
			       <div class="listBoxContent">
				       <div class="imgDiv"><img src="<?php echo AGENT_IMAGE_PATH.'imgn1.jpg';?>" alt="img" /></div>
				       <div class="elevatelist">
					       <ul>
						       <li>20%+ more bookings when participating!</li>
						       <li>90% of first time user continue to elevate!</li>
						       <li>Excellent position on mobile with no upfront cost!</li>
					       </ul>
				       </div>
				       <p class="btmLink"><a href="<?php echo AGENT_URL.'market/index/'.$propertyList[0]['property_master_id'];?>">Start</a></p>
			       </div>
		       </div>
	       </div>
	       <div class="col-lg-4">
		       <div class="listBox latestNews">
			       <h5>Latest News</h5>
			       <div class="rssDiv">
				 <a href="http://www.hostelmofo.com/blog/feed/"><img src="<?php echo AGENT_IMAGE_PATH.'icon-rss.gif';?>" /></a>
			       </div>
			       <div class="listBoxContent">
	       <div class="newsList">
	       <ul><?php
	       for($x=0;$x<$limit;$x++)
	       {
		  if(isset($feed[$x]['link']))
		  {
		     $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		     $link = $feed[$x]['link'];
		     $description = substr($feed[$x]['desc'],0,100);
		     $date = @date('l F d, Y', strtotime($feed[$x]['date']));
		     echo '<li><p><span><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></span>';
		     echo '<small><em>Posted on '.$date.'</em></small></p>';
		     echo '<p>'.$description.'...</p><p class="readMore"><a class="readMoreButton" href="'.$link.'">read more</a></p></li>';
		  }
	       }
	       ?></ul>
	       </div>
			       </div>
		       </div>
	       </div>
	 </div>
	 <div class="row">
		 <div class="col-lg-4">
			 <div class="listBox">
				 <h5>City Updates</h5>
				 <div class="listBoxContent">
					 <div class="cityUpdateList">
						 <ul>
							 <li class="greenUp">City bookings <em>+<?php echo $city_update['city_booking_on_last_month'];?>%</em> on last month</li>
							 <li class="redUp">Your bookings <em>+<?php echo $city_update['agent_booking_on_last_month'];?>%</em> on last month</li>
							 <li class="redUp">City bookings <em>+<?php echo $city_update['booking_on_last_year'];?>%</em> on <?php echo date('M Y',strtotime($date .' -11 Month'))?></li>
							 <li class="redUp">Your bookings <em>+<?php echo $city_update['our_booking_on_last_year'];?>%</em> on <?php echo date('M Y',strtotime($date .' -11 Month'))?></li>
						 </ul>
					 </div>
					 
				 </div>
			 </div>
		 </div>
		 <div class="col-lg-4">
			 <div class="listBox chartDiv">
				 <h5>Monthly Booking</h5>
				 <div class="listBoxContent">
					 <div class="imgDiv"><img src="<?php echo AGENT_IMAGE_PATH.'chart-img.jpg';?>" alt="img" /></div>
				 </div>
				 <p class="btmLink"><a href="<?php echo AGENT_URL.'reports/elevate_reporting/'.$propertyList[0]['property_master_id'];?>">Click here to full chart</a></p>
			 </div>
		 </div>
		 
	 </div>
					  </div>
				  </div>
<?php } 
?>
				  
			    </div>
			</div>
		    </div>
		</div>
	   </div>
	</div>
    </div>
</div>
	    
<!--	MODAL IMAGE    -->
<div id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modal-wide-width-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-wide-width-label" class="modal-title">Images of <span id="modalPropertyName"></span></h4></div>
				<div class="modal-body">
			
				    <div class="col-lg-12">
					<div class="col-lg-6  text-right">
					    <a class="propImgPre" href="javascript:void(0);" data-element="0"  title="Previous">
						<i class="fa fa-angle-double-left" style="color:#000;font-size: 30px;"></i>
					    </a>
					</div>
					<div class="col-lg-6 text-left">
					    <a class="propImgNext" href="javascript:void(0);" data-element="1" title="Next">
						
						<i class="fa fa-angle-double-right"  style="color:#000;font-size: 30px;"></i>
					    </a>
					</div>
				    </div>
				  	<div class="imagePropertyBox"></div>
					
					
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
	
equalheight = function(container){
var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {
   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;
   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}
$(window).load(function() {
  equalheight('.listingBox .listBox');
});
$(window).resize(function(){
  equalheight('.listingBox .listBox');
});
$(document).ajaxSuccess(function(){
  equalheight('.listingBox .listBox');
});
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->