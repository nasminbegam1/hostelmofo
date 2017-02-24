 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Property</div>
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

  <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                                <div class="row">
                                    <div class="col-lg-12"><h4 ><?php echo $property_name;?></h4>

                                        <div class="table-container">
														<p>Address: <?php echo $details['address'];?></p>
														<p>Contact: <?php echo $details['property_phone_no'];?></p>
														<p>Licensee Name: <?php echo $details['licensee_name'];?></p>
														<p>Agent Name: <?php echo $details['firstname'].' '.$details['lastname']; ?></p>
														<p>Agent Email: <?php echo $details['email']; ?></p>
														<p>Contact Name: <?php echo $details['contact_name']; ?></p>
														<p>Direction : <?php echo $details['direction']; ?></p>
														<p>Location : <?php echo $details['location']; ?></p>
														<p>Cancellation Policy : <?php echo $details['cancellation_policy']; ?></p>
														<?php if(is_array($details['images']) && count($details['images']) >0) { ?>
														<a href="javascript:void(0);" class="btn btn-green" data-toggle="modal" data-target="#modal-image" class="showAllImage " >See Images</a>
														<?php } ?>
														<a href="<?php echo BACKEND_URL.currentClass().'/index/'.$page;?>" class="btn btn-green" title="Return">Return</a>
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
                                <h4 id="modal-wide-width-label" class="modal-title">Images of <?php echo $property_name;?></h4></div>
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
				  	<div class="imagePropertyBox">
					 <?php if(is_array($details['images']) && count($details['images']) >0){
						  $i=0;foreach ($details['images'] as $image){?>
						  <div class="">
								<div class="subImage <?php echo $i==0 ? 'active' : 'inactive';?>">
									 <img src="http://accomodation.totalwealthconce.netdna-cdn.com/upload/property/big/<?php echo $image['image_name'];?>" alt="<?php echo $image['image_title'];?>">
								</div>
						  </div>
						  <?php $i++;} } ?>
					</div>
					
					
				</div>
                           
                        </div>
                    </div>
                </div>