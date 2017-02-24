<div class="page-content"> 
  
  <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
  <!-- BEGIN STYLE CUSTOMIZER --> 
  <!-- END STYLE CUSTOMIZER --> 
  
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Edit Deals</h3>
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
            <div class="caption">Edit Deals</div>
          </div>
          <div class="portlet-body">
          <?=$tabs?>
          <form action="<?php echo AGENT_URL.'property/update/'.$property_id.'/'.$deals_details[0]['deal_id'];?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" placeholder="" value="<?php echo $deals_details[0]['deal_id']?>" class="form-control requiredInput" name="deal_id" />
            </div>
            <div class="formPreLoader" style="">
              <div class="imgLoaderDiv"> <img class="loader"   id="" src="<?php echo BACKEND_URL
							."vendors/pageloader/images/loader7.GIF" ?>" /> </div>
            </div>
            <div class="tab-content">
            <input type="hidden" name="action" value="basic_info"/>
            <!--<input type="hidden" name="property_id" value="">-->
            <div id="tab1-wizard-custom-circle" class="tab-pane active"><!--<h3 class="mbxl">Set up basic details</h3>-->
              <h3>EditDeals</h3>
              <div class="propertyContent">
                <h5><strong>Deals Information</strong></h5>
                <div class="form-group clearfix row">
                  <label for="address" class="col-sm-3 control-label">Deal Name<span class='require'>*</span> </label>
                  <div class="col-sm-9">
                    <div class="input-group"> <span class="input-group-addon"> </span>
                      <input type="text" placeholder="" value="<?php echo $deals_details[0]['deal_name']?>" class="form-control requiredInput" name="deal_name" />
                      <i class="alert alert-hide">Oops, address is required</i> </div>
                  </div>
                </div>
                <div class="form-group clearfix row">
                  <label for="address2" class="col-sm-3 control-label">Deals Description</label>
                  <div class="col-sm-9">
                    <div class="input-group"> <span class="input-group-addon"> </span> 
                      <!--  <input type="text" placeholder="" value="" class="form-control" name="room_description" id="address2"/> -->
                      <textarea id="roomDescription" name="deal_desc" class="form-control requiredInput"><?php echo $deals_details[0]['deal_desc'];?></textarea>
                    </div>
                  </div>
                </div>
                <h5><strong>Room Information</strong></h5>
                <div class="form-group clearfix row">
                  <label for="" class="col-sm-3 control-label">Room Type<span class='require'>*</span> </label>
                  <div class="col-sm-9">
                      <?php
							   $room_type_id = explode(',',$deals_details[0]['room_type_id']);
							   $room_type_value = explode(',',$deals_details[0]['room_type_value']);
							   for($i=0;$i<count($room_type_id);$i++){
							    $room_value[$room_type_id[$i]] =  $room_type_value[$i];
							   }
								   if(is_array($room_type) and count($room_type)>0){
								    foreach($room_type as $data){
								   ?>
                      <div class="form-group clearfix row">
                        <label class="col-sm-3 control-label"><?php  echo stripslashes($data['type_name']); ?></label>
                        <input type="hidden" name="room_type_id[]" value="<?php echo $data['id']; ?>">
                        <div class="col-sm-9">
                        <select name="room_type_value[]" class="form-control">
                          <?php for($i=0;$i<=10;$i++){ ?>
                          <option value="<?php echo $i; ?>"<?php if(in_array($data['id'],$room_type_id) && $room_value[$data['id']] == $i){echo 'selected'; }?>><?php echo $i; ?></option>
                          <?php }?>
                        </select>
                        </div>
                      </div>
                      <?php } ?>
                      <?php } ?>
                      <i class="alert alert-hide">Oops, address is required</i> </div>
                </div>
                <div class="form-group clearfix row">
                  <label for="" class="col-sm-3 control-label">Date From<span class='require'>*</span> </label>
                  <div class="col-sm-9">
                    <div class="input-group"> <span class="input-group-addon"> </span>
                      <input type="date" placeholder="" value="<?php echo $deals_details[0]['from_date']?>" class="form-control requiredInput datepicker" name="from_date" id=""/>
                      <i class="alert alert-hide">Oops, address is required</i> </div>
                  </div>
                </div>
                <div class="form-group clearfix row">
                  <label for="" class="col-sm-3 control-label">Date To<span class='require'>*</span> </label>
                  <div class="col-sm-9">
                    <div class="input-group"> <span class="input-group-addon"> </span>
                      <input type="date" placeholder="" value="<?php echo $deals_details[0]['to_date']?>" class="form-control requiredInput datepicker" name="to_date" id=""/>
                      <i class="alert alert-hide">Oops, address is required</i> </div>
                  </div>
                </div>
                <div class="form-group clearfix row">
                  <label for="" class="col-sm-3 control-label">Price<span class='require'>*</span> </label>
                  <div class="col-sm-9">
                    <div class="input-group"> <span class="input-group-addon"> </span>
                      <input type="text" placeholder="" value="<?php echo $deals_details[0]['price']?>" class="form-control requiredInput" name="price" id=""/>
                      <i class="alert alert-hide">Oops, address is required</i> </div>
                  </div>
                </div>
              </div>
              <div class="propertyContent row">
                <div class="action text-right col-sm-12">
                  <input type="submit" name="submit" value="submit" class="btn btn-primary">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- BEGIN DASHBOARD STATS --> 
  <!-- END DASHBOARD STATS --> 
  
</div>
</div>
<script>

  $(function()                        

  {    var nowDate 	= new Date();
	$(".datepicker").datepicker({autoclose: true,startDate:nowDate,format: 'yyyy-mm-dd'});


    
             
    });
  </script>