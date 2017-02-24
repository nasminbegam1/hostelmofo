<?php //pr($availability);?>
<script>
  function editRecord(id){
		 
		 //alert(id);
    
    var myKeyVals = { property_id:$('.propertyID').val(),
		     price:$('.price').val(),
		     startDate:$('.start_date').val(),
		     room_type_id:$('.roomTypeID').val()
                    }
    $.ajax({
          type: 'POST',
          url : BACKEND_URL+'property/price_edit/',
          data: myKeyVals,
	    
    beforeSend: function() {
            $('#row'+id).css('background','#FDA7A7');
           
          },
    success: function(response)
     {
          if (response>0)
               {
            
                 $("#success_msg").html('Record update successfully');
                 $('#success_msg').css('fontSize','14px');
                 $('#success_msg').css('color','white');
            setTimeout(function(){ 
           
            //$('#success_msg').html('List of active users...');
            window.location.href=BACKEND_URL+'property/availability';
           }, 3000);
             
         
            } else{
                  alert('Record update successfully');
               }

      }
    });     
    
    
   }
</script>>


<?php $breadcrumbs = $brdLink?>1
    
	 <div class="page-content">
	 <h3>Availability Property</h3>
	 <?=$property_header?>
	 <?php if(isset($errmsg) && $errmsg != ""){ ?>
      <div align="center">
	<div class="alert alert-danger">
	  <p><?php echo stripslashes($errmsg);?></p>
	</div>
      </div>
      <?php } ?>
	 <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?> 
		<div id="form-layouts" class="row">
        <div class="col-lg-12">
			 <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
            <div id="tab-form-seperated" class="tab-pane">
              <div class="row">
	      <div class="col-lg-12">
					  
                <?php if(validation_errors() != FALSE){?>
		
                  <div align="center">
                    <div class="nNote nFailure" style="width: 600px;color:red;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                    </div>
                  </div>
                <?php } ?>
                        <div id="alert-msg" class="alert alert-success" style="display: none;"></div>                
                  <div class="panel panel-yellow portlet box portlet-violet">
                    <div class="portlet-header">
				  
                      <div class="caption">Availability Calendar</div>
								<div class="tools">
									 <i class="fa fa-chevron-up"></i>
								</div>
                      </div>
						  
		<div class="portlet-body panel-body pan">
		 
		 <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
		 <input type="hidden" name="action" value="Process">
		  <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
			 <div class="form-body">
			  <div class="col-md-4">
			   <div class="form-group">
				 
				 
				 
				  <div class='input-group date' id='datetimepicker1'>
					 
				  <input id="avail_start_date" name="start" value="<?php echo date('m/d/Y', $start_date);?>" placeholder="TO" class="form-control" readonly="readonly"/>
					 <span class="input-group-addon">
					   <span class="glyphicon glyphicon-calendar"></span>
					 </span>
				  </div>
			   </div>
			  </div>
			  <div class="col-md-4">
			   <div class="form-group">
				  <div class='input-group date' id='datetimepicker2'>
					 
					 <input name="end" value="<?php echo date('m/d/Y', $end_date);?>" placeholder="FROM" class="form-control" id="avail_end_date" readonly="readonly"/>
					 <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
					 </span>
				  </div>
			   </div>
			  </div>
			  <div class="col-md-4">
			   <div class="form-group">
				<div class="frm-btn"><button type="submit" class="btn btn-success">Go</button></div>
			   </div>
			  </div>
			 </div>
			 
		 </form>
      </div>
		 
		 <?php if($room_count > 0) {?>
		 
		 <div class="content">
    <div class="rates clear">
        <div class="rating">&nbsp;</div>
        <div class="rating">allocation per day</div>
        <div class="rating">&nbsp;</div>
        <div class="rating">your last available date</div>
    </div>
    <table id="avl-dtls">
        <thead>
		<tr>
		<th class="pg">&nbsp;</th>
		 <?php for ($i=$start_date ; $i<=$end_date; $i+=86400) { ?>
				  
				  <?php echo '<th class="numeric">'.date('D', $i).'<br />'.date('d',$i).'</th>';?>
		
		 <?php  } ?>
		 </tr>
        </thead>
        
        <tbody>
		 <?php
		 if(is_array($availability) && count($availability)>0){ //pr($availability);?>
		 
		 <?php for($j=0;$j<count($availability['record']);$j++) {?>
		 <tr id="<?php echo 'avail'.$property_id;?>">
		 <td  class="pg" data-title=""><?php echo $availability['record'][$j]['type_name']?></td>
		 <?php
		 //$start_date = date( 'Y-m-d', $start_date );
		 //$end_date   = date( 'Y-m-d', $end_date );
		 $diff	=	$end_date-$start_date ;
		 $days 	= 	floor($diff / (60*60*24) );?>
		
		<?php for ($i=0 ; $i<=$days; $i++) { ?> 
		              <td class="numeric" data-title="<?php echo $availability['record'][$j]['type_name']?>" >
				  <div class="<?php echo ($availability['record'][$j]['price_charge_type'] == 'per_night')?'perNightIcon':'';?>" id="price_<?php echo remove_whitespace($availability['record'][$j]['type_name']);?>_<?php echo $i;?>">
				    <input type="text" value="<?php echo $availability['price'][$i][$j]['price'];?>" class="price" name="available_price"/>
				    
				    <input type="text" value="<?php echo $availability['price'][$i][$j]['booked_count'];?>" class="size" name="available_beds"/>
				    <input type="hidden" value="<?php echo $i;?>" name="diff"/>
				    <input type="hidden" value="<?php echo $start_date;?>" name="start_date"/>
				    <input type="hidden" value="<?php echo $property_id;?>" name="propertyID"/>
				    <input type="hidden" value="<?php echo $availability['record'][$j]['id']?>" name="roomTypeID"/>
				  </div>
		              </td>
				 
			      		   
		 <?php } ?>
		         
                 
                 

		 </tr>
		 <?php } ?>
		 
		 <?php } ?>
		 <!--<td colspan="2">
                  <div class="btn-group">           
                  <input type="button" class="btn btn-success" value="Update"  onclick="editRecord('<?=$property_id;?>');">
                  
                  </div>
                </td>-->
                  
		 
       </tbody>
        
    </table>
    
    
    
</div>
		<?php } else{ echo "<div class='content'><b>You haven't added any room yet. Please add room to view availability.</b></div>"; } ?>
							 
							 
							  </div>
							 
							 
							 
                   </div>
                </div>
             </div>
			  </div>
			</div>
        </div>
      </div>
        

<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->