    <div class="page-content">                
    <!-- Start : main content loads from here -->    
    <h3 class="page-title">Booking Dateils</h3>
    <?php if(isset($breadcrumbs) && count($breadcrumbs)){ $this->load->view('layout/breadcrumbs',array('breadcrumbs'=>$breadcrumbs)) ;} ?>	
    <div class="portlet light">
    	<div class="row">
	    <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            
				<div class="col-sm-12">
				   <label for="property_name" class="col-sm-3 control-label"><b>Booked by</b></label>
				
				   <div class="col-sm-9">
					    <?php echo isset($booking[0])? stripslashes($booking[0]['first_name'].' ' .$booking[0]['last_name']) : ''; ?>					    
				   </div>
				</div>
				<br/><br/>
				<div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Booked on</b></label>
				 <div class="col-md-9"><?php echo  @date('d/m/Y H:i', strtotime($booking[0]['added_date']));?>				
				 </div>
                            </div>
				<br/><br/>
                           <div class="col-sm-12">
                              
				<label  class="col-md-3 control-label" ><b>Email</b></label>
				
                                <div class="col-md-9"><?php echo isset($booking[0])? stripslashes($booking[0]['email']) : ''; ?>	</div>
                            </div>
			    <br/><br/>
                              <div class="col-sm-12">
                                <label class="col-md-3 control-label"  ><b>Phone</b></label>
                                <div class="col-md-9"><?php echo isset($booking[0]) ? stripslashes($booking[0]['prefix_phone'])." - ".stripslashes($booking[0]['suffix_phone']) : ''; ?></div>
			     </div>
			     <br/><br/>
			     
			     <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Check In</b></label>
				 <div class="col-md-9"><?php echo  @date('d/m/Y', strtotime($booking[0]['check_in']));?>				
				 </div>
                            </div>
			      <br/><br/>
			      <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Check Out</b></label>
				 <div class="col-md-9"><?php echo  @date('d/m/Y', strtotime($booking[0]['check_out']));?>				
				 </div>
                            </div>
			    <br/><br/>
			    
			    
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Booking Type</b></label>
				 <div class="col-md-9"><?php echo ucfirst($booking[0]['booking_type']) ;?>				
				 </div>
                            </div>
			    <br/><br/>
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Total Amount</b></label>
				 <div class="col-md-9">
				  AUD $<?php echo round($booking[0]['usd_balance']);?>
				 
				 </div>
                            </div>
			    <br/><br/>			    
			    
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Paid Amount</b></label>
				 <div class="col-md-9">AUD $<?php echo round($booking[0]['payble_amount']);?>

				 </div>
                            </div>
			    <br/><br/>
			    
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Due Amount</b></label>
				 <div class="col-md-9">AUD $<?php echo round($booking[0]['usd_balance']-$booking[0]['payble_amount']);?>
				 
				 </div>
                            </div>
			    <br/><br/>
			    
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Discount Amount</b></label>
				 <div class="col-md-9">AUD $<?php echo round($booking[0]['discount_amount']);?>
				 
				 </div>
                            </div>
			    <br/><br/>
			    
			    <div class="col-sm-12">
                                <label class="col-md-3 control-label" ><b>Payment Status</b></label>
				 <div class="col-md-9"><?php echo  $booking[0]['payment_status'];?>				
				</div>
                            </div>
			    <br/><br/>
			    
			    
			     <div class="col-sm-12">
				<div class="col-sm-8">
				<table class="roomTypeTable table" cellspadding="10">
				    <thead>
					<tr>
					    <th>Room Type</th>
					    <th align="right">No. Rooms</th>
					    <th align="right">No. Guest</th>
					    <!--<th align="right">Total Price</th>-->
					</tr>
				    </thead>
				    <tbody>
				    <?php if(is_array($booking) && count($booking)){
					$grandTotal = 0;
					foreach($booking as $k=>$room){
					    $grandTotal += $room['total_price'];
					?>
					    <tr>
						<td><?php echo stripcslashes(ucwords($room['type_name'])); ?></td>
						<td><?php echo $room['no_of_room']; ?></td>
						<td><?php echo $room['no_of_person']; ?></td>
						<?php /*<td>AUD $<?php echo round($room['total_price']/$booking[0]['currency_rate']); */?>
					
						</td>
					    </tr>
					<?php
					}
				    }	
				    ?>
				    </tbody>
				    <tfoot>
					<tr>
					    <td colspan="3" align="right"><strong>Grand Total Amount</strong></td>
					    <td><strong>AUD $<?php echo round($booking[0]['usd_balance']); ?>
			    
					    </strong></td>
					</tr>
				    </tfoot>
				</table>
				</div>
			     </div>
			    
			    <div class="col-md-12">
				<div class="col-ofset-9">
				    <a class="btn btn-blue" href="<?php echo base_url('booking/index/') ?>">Back</a>				
				    <!--<a class="btn btn-default" href="" onclick="javascript:return confirm('Are you sure?')" >Delete</a>-->
				</div>
			    </div>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
</div>