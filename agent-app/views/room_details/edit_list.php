<div class="page-content">
	
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Edit Room Type</h3>
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
			      <div class="caption">Edit Room Type</div>
		      </div>						
		    <div class="portlet-body">
			
			<?=$tabs?>
			    <form action="<?php echo AGENT_URL."room_details/update/";?>" class="form-horizontal" method="post" enctype="multipart/form-data">
						
						</div>
					       <div class="formPreLoader" style="">
						   <div class="imgLoaderDiv">
							<img class="loader"   id="" src="<?php echo BACKEND_URL
							."vendors/pageloader/images/loader7.GIF" ?>" />
						   </div>
					       </div>
                                    <div class="tab-content">
					
					<input type="hidden" name="action" value="update"/>
					<input type="hidden" name="room_id" value="<?php echo $room_details[0]['id'];?>">
					<input type="hidden" name="property_id" value="<?php echo $room_details[0]['property_id'];?>">
					

                                        <div id="tab1-wizard-custom-circle" class=""><!--<h3 class="mbxl">Set up basic details</h3>-->
					    <h3>Edit Room Type</h3>
					    <div class="propertyContent">
					     <h5><strong>Room  Information</strong></h5>
					      
					     <div class="form-group"><label for="province_id" class="col-sm-3 control-label">Basic Type<span class='require'>*</span> </label>
						  <div class="col-sm-9">
						      <div class="input-group">
							  <span class="input-group-addon">
							      
							  </span>

							 
				  <select name="id" class="form-control requiredInput"  >
							      <option value=""><?php echo "Select"; ?></option>
							  <?php
								   if(is_array($room_type) and count($room_type)>0){ ?>
								  <?php foreach($room_type as $data){ ?>
								  <option <?php if($room_details[0]['room_type_master_id']== $data['roomtype_id']){?>selected="selected"<?php } ?> value="<?php echo $data['roomtype_id'];?>">
								  	<?php echo $data['roomtype_name']; ?></option>
								  <?php } ?>
								  <?php } ?>
							  </select>
							  <i class="alert alert-hide">Oops, province is required</i>
						      </div>
						  </div>
					      </div>
					     <div class="form-group"><label for="address" class="col-sm-3 control-label">Size<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       
							   </span>
							   <input type="text" placeholder="" value="<?php echo $room_details[0]['size'];?>" class="form-control requiredInput" name="size" id="address"/><i class="alert alert-hide">Oops, address is required</i>
						       </div>
							   
						   </div>
					       </div>
					     <div class="form-group"><label for="address" class="col-sm-3 control-label">Number of rooms<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       
							   </span>
							   <input type="text" placeholder="" value="<?php echo $room_details[0]['no_of_rooms'];?>" class="form-control requiredInput" name="no_of_rooms" id="no_of_rooms"/><i class="alert alert-hide">Oops, address is required</i>
						       </div>
							   
						   </div>
					       </div>
					     
					       <div class="form-group"><label for="address" class="col-sm-3 control-label">Room Label<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							      
							   </span>
							   <input type="text" placeholder="" value="<?php echo $room_details[0]['room_lable'];?>" class="form-control requiredInput" name="room_lable" id="address"/><i class="alert alert-hide">Oops, address is required</i>
						       </div>
							   
						   </div>
					       </div>
					       <div class="form-group">
							  <label for="address" class="col-sm-3 control-label">Room Type Name<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       
							   </span>
							   <input type="text" placeholder="" value="<?php echo $room_details[0]['type_name'];?>" class="form-control requiredInput" name="type_name" /><i class="alert alert-hide">Oops, address is required</i>
						       </div>
							   
						   </div>
					       </div>
							 
							 					       <div class="form-group">
							  <label for="address" class="col-sm-3 control-label">Basic Price<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							       
							   </span>
							   <input type="text" placeholder="" value="<?php echo $room_details[0]['base_price'];?>" class="form-control requiredInput" name="basic_price" /><i class="alert alert-hide">Oops, Basic Price is required</i>
						       </div>
							   
						   </div>
					       </div>

							 
							 
					       <div class="form-group">
							  <label for="address" class="col-sm-3 control-label">Ensuite<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							    
							   </span>

							 <!--  <option value="January"<?=$row['month'] == 'January' ? ' selected="selected"' : '';?>>January</option>  -->

							  
							   <select name="ensuite" class="form-control requiredInput">
							   <option value="Y"<?php echo $room_details[0]['ensuite']=='Y' ? 'selected="selected"' : ''; ?>>Yes</option>
							   <option value="N"<?php echo $room_details[0]['ensuite']=='N' ? 'selected="selected"' : ''; ?>>No</option>
							   

							   </select>
							  
							   
						   </div>
					       </div>
					       </div>
							 
							 <?php /*					       <div class="form-group">
							  <label for="address" class="col-sm-3 control-label">Ensuite<span class='require'>*</span> </label>
						   <div class="col-sm-9">
						       <div class="input-group">
							   <span class="input-group-addon">
							    
							   </span>

							 <!--  <option value="January"<?=$row['month'] == 'January' ? ' selected="selected"' : '';?>>January</option>  -->

							  
							   <select name="charge_type" class="form-control requiredInput">
							   <option value="price per person" <?php echo $room_details[0]['priceChargeType']=='price per person' ? 'selected="selected"' : ''; ?>>Price per Person</option>
							   <option value="price per night" <?php echo $room_details[0]['priceChargeType']=='price per night' ? 'selected="selected"' : ''; ?>>Price per Night</option>
							   

							   </select>
							  
							   
						   </div>
					       </div>
					       </div>
*/ ?>	 
							 
							 
					     <div class="form-group"><label for="address2" class="col-sm-3 control-label">Room Description<span class='require'>*</span></label>
						    <div class="col-sm-9">
							<div class="input-group">
							    <span class="input-group-addon">
								
							    </span>
							   <!--  <input type="text" placeholder="" value="" class="form-control" name="room_description" id="address2"/> -->
							   <textarea id="roomDescription" requiredInput name="room_description" class="form-control requiredInput"><?php echo stripcslashes($room_details[0]['room_description']);?></textarea>
							    <span id="countexact"><?php if(isset($room_details[0]['room_description'])) 
						    {
						       echo  mb_strlen( trim( stripslashes($room_details[0]['room_description']))) ;
						    }
						    else
						    {
							echo '0';
						    }
						    ?></span><span>/255 character remaining	</span>
							</div>
						    </div>
						</div>
					      
					   
						
					 <div class="propertyContent">
			
				      <div class="action text-right">
				      	<button type="submit" name="submit" value="submit" class="btn btn-primary">Edit</button>
                         <!-- <input type="submit" name="submit" value="submit" class="btn btn-primary"> -->
					   
                      </div>
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
  

   $(document).ready(function(){
	    $('#roomDescription').keyup(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    if(len>254){
		$(this).val(value.substring(0,255));
		 var len = 255; 
	    }
	    $('#countexact').text(len);
	});
	     }); 
  </script>