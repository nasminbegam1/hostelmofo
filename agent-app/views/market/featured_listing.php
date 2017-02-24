<script src="<?php echo BACKEND_URL;?>js/jquery-birthday-picker.min.js"></script>

<div class="page-content">
<h3 class="page-title">Featured Listing</h3>
<?=$property_header?>
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
<div class="portlet-body">
<?=$tabs?>
<style>
    .progress{
	background-color: #E3F5E3 !important;
    }
 </style>
<div class="page-content room-details">
<div class="featureTop"> <span class="topHeading">Featured Listings on: <em>HostelWorld <em class="sml">.com</em></em></span>
  <div class="featureTopIn">
    <div class="featureTopLt">
      <p>Hostelworld.com is pleased to announce the launch of Featured Listings.</p>
      <p>Featured Listings give your property:</p>
      <ul>
        <li>Twice as much exposure.</li>
        <li>An enhancedlisting in addtion to your normal city listing.</li>
        <li>Premium visibility</li>
        <li> Up to 25% more bookings</li>
      </ul>
    </div>
    <div class="featureTopRt">
      <div class="orng">
        <h6>Hostelworld Example</h6>
        <img alt="red-cover" src="http://192.168.2.5/hostelworld/agent/img/orng.png"> </div>
      <h4>Featured Properties</h4>
      <ul>
        <?php
	if(is_array($featured_property) && COUNT($featured_property)>0)
	{
	 foreach($featured_property as $v)
	 {
       ?>
        <li>
          <div class="HtlInfo">
            <div class="pic"> <img src="<?php echo $v['image_name'];?>" alt="<?php echo $v['image_alt'];?>" title="<?php echo $v['image_title'];?>" height="100" width="150"/> </div>
            <h5><?php echo stripslashes($v['property_name']);?></h5>
            <p><?php echo substr(stripslashes($v['brief_introduction']),0,100);?>..</p>
            <a href="<?php echo FRONTEND_URL.'property/'.$v['property_type_slug'].'/'.$v['province_slug'].'/'.$v['city_slug'].'/'.$v['property_slug'].'/';?>" class="MrInfo" target="_blank"> More Info </a> </div>
          <div class="dollar">
            <div class="frm">From $<?php echo floor($v['daily_price']);?></div>
            <div class="thumb"><img src="http://192.168.2.5/hostelworld/agent/img/thumb.png" /></div>
          </div>
          <div class="review"> <span> <?php echo stripslashes($v['avg_rating']);?>% </span> <?php echo stripslashes($v['no_of_review']);?> Total Reviews </div>
        </li>
        <?php }}?>
      </ul>
    </div>
  </div>
</div>
<div class="featureBtm"> <span class="subHeading">Featured Listings Available on Hostelworld.com</span>
  <p>To purchase a Featured Listing on Hostelworld.com, select the checkbox under the require month(s) and press Continue to go to the payment screen.</p>
  <table width="100%" id="no-more-tables">
    <?php
   if(is_array($month_list) && COUNT($month_list)>0)
   {
    foreach($month_list as $k=>$v)
    {
   ?>
    <thead>
      <tr>
        <th></th>
        <th>Jan</th>
        <th>Feb</th>
        <th>Mar</th>
        <th>Apr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Aug</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dec</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="yr"><div class="tdDiv"><?php echo $k;?></div></td>
        <?php
      for($i=1;$i<=12;$i++)
      {
       if(isset($v[$i]))
       {
     ?>
        <td><div class="tdDiv"><div class="<?php if($v[$i]['more_than_one_remaining'] == 1)echo 'ltGrnslt';else echo 'lt';?>"> US $175.00</div>
          <div class="rt">
	   <?php if($v[$i]['is_sold_out'] == 1){?>
	     <span class="cross"></span>
            <?php }elseif($v[$i]['is_subscribe'] == 0){?>
	     <input type="checkbox" name="subscribe[]" id="subscribe" class="subscribe" value="<?php echo $i.'-'.$k;?>" />	    
            <?php }else{?>
	     <span class="tick"></span>
            <?php }?>
          </div></div></td>
        <?php }else{?>
        <td><div class="tdDiv"></div></td>
        <?php }}?>
      </tr>
    </tbody>
    <?php }}?>
  </table>
  <div class="featureBtmIn">
    <div class="featureBtmInLt">
      <ul>
        <li class="tick"> Already purchased</li>
        <li  class="grnslt"> > 1 slot remaining</li>
        <li  class="orngslt"> Only 1 slot remaining</li>
        <li class="cross"> Sold Out </li>
      </ul>
    </div>
    <div class="featureBtmInRt">
      <div class="featureBtmInRtIn"><span>Featured Listing Total Price: Us $<em class="total_price">0.00</em></span> <a href="javascript:void(0)" class="con"> Continue </a></div>
      <span><a href="#">Full terms and Conditions</a></span> </div>
  </div>
  <div class="bookFormPn globalClr popupInSec" style="display: none;">
   <div class="paymentOption">
    <span>Please select a payment method</span>
    <ul>
     <li>Voucher 	<input type="radio" name="paymentOption" value="voucher"/></li>
     <li>Credit Card	<input type="radio" name="paymentOption" value="credit"/></li>     
    </ul>
   </div>
   
   <div class="paymentDetails">
    <div class="voucherPayment" style="display: none;">
    <span class="closeBtn"><i class="fa fa-remove"></i></span>
    <span class="payoverlay"></span>
    <div class="paymentIn">
     <h3>Voucher Details </h3>
     <p class="succVoucherMsg" style="display: none;"><img src="<?php echo AGENT_IMAGE_PATH.'loader.gif'?>" style="padding-left: 150px;"></p>
     <?php for($i=0;$i<10;$i++){?>
      <p><span>Voucher No <?php echo $i+1;?>  </span><input type="text" name="voucherCode[]" id="voucherCode" class="voucherCode" required></p>
     <?php }?>
     <input type="button" value="Confirm Voucher" id="conf_voucher">
     </div>
    </div>
    
    <div class="cardPayment" style="display: none;">
    <span class="closeBtn"><i class="fa fa-remove"></i></span>
    <span class="payoverlay"></span>
    <div class="paymentIn">
      <h3>Payment Details </h3>
      <p class="succEnqMsg" style="display: none;"><img src="<?php echo AGENT_IMAGE_PATH.'loader.gif'?>" style="padding-left: 150px;"></p>
      <div class="formFiled globalClr">
	<p>
	  <input type="text" class="requiredTextEnq" id="cc_holder_name" name="cc_holder_name" placeholder="Creditcard Holder name*" required>
	</p>
	<p>
	  <input type="text" class="requiredTextEnq" id="cc_number" name="cc_number" placeholder="Creditcard Number*" required>
	</p>
	<p>
	  <select id="card_type" name="card_type" required>
	    <option value="">Select Card Type</option>
	    <option value="MasterCard">MasterCard</option>
	    <option value="Visa" selected="selected">Visa</option>
	    <option value="Discover">Discover</option>
	    <option value="Amex">Amex</option>
	    <option value="Maestro">Maestro</option>
	  </select>
	</p>
	<p>
	  <input type="text" class="requiredTextEnq" id="exp_date" name="exp_date" value="" placeholder="Expiration Date (MM/YY)*" required>
	</p>
	<p>
	  <input type="text" class="requiredTextEnq" id="cvv" name="cvv" placeholder="CVV No*" required>
	</p>
	<p></p>
	<input type="button" value="Confirm Payment" id="conf_submit" name="frm_submit">
      </div>
      <input type="hidden" name="selected_date" id="selected_date" value=""/>
      <input type="hidden" name="final_price" id="final_price" value=""/>
     </div>
     </div>
    </div>
  </div>
</div>
<script>
$('.subscribe').click(function(){
 var total_price   = 0.00;
 var selected_date = '';
  $('.subscribe').each(function(){
	   if ($(this).is(":checked")){
		   total_price   =  total_price+ 175;
		   selected_date =  selected_date+'@'+$(this).val();
	   }
  });
  $('.total_price').html(total_price);
  $('#selected_date').val(selected_date);
  $('#final_price').val(total_price);
});
 
$('.con').click(function(){
  var total_price   = 0;
  $('.subscribe').each(function(){
	   if ($(this).is(":checked")){
		   total_price   =  total_price+ 175;
	   }
  });
  if (total_price > 0)
  {
   $('.bookFormPn').css('display','block');
   $('.con').css('display','none');
  }
  else
  {
    alert('Please select a month to pay');
  }
});

$('#conf_submit').click(function(){
 var cc_holder_name = $('#cc_holder_name').val();
 var cc_number 	= $('#cc_number').val();
 var card_type = $('#card_type').val();
 var exp_date = $('#exp_date').val();
 var cvv = $('#cvv').val();
 
 if (cc_holder_name == '' || cc_number== '' || exp_date== '' || cvv== '')
 {
  if (cc_holder_name== '')
   $('#cc_holder_name').css('background','#FEF1EC').css('border','1px solid #CD0A0A');
 
  if (cc_number== '')
   $('#cc_number').css('background','#FEF1EC').css('border','1px solid #CD0A0A');
 
  if (exp_date== '')
   $('#exp_date').css('background','#FEF1EC').css('border','1px solid #CD0A0A');
   
  if (cvv== '')
   $('#cvv').css('background','#FEF1EC').css('border','1px solid #CD0A0A');
   
  return false;
 }
 var selected_date = $('#selected_date').val();
 var property_id = '<?php echo $this->uri->segment(3);?>';
 var final_price = $('#final_price').val();
     $.ajax({
      type: "POST",
      url:  "<?php echo FRONTEND_URL;?>agent/market/payment/",
      beforeSend: function() {
       $('.succEnqMsg').css('display','block');
    },
      data: {property_id:property_id,cc_holder_name:cc_holder_name,cc_number:cc_number,card_type:card_type,exp_date:exp_date,cvv:cvv,selected_date:selected_date,final_price:final_price,payment_type:'credit' },
      success:function(data) {
       if (data == 1)
       {
	 location.reload();
       }
       else
       {
	alert(data);
	location.reload();
       }
      }
    }); 
});

$('#conf_voucher').click(function(){
 var selected_date 	= $('#selected_date').val();
 var property_id 	= '<?php echo $this->uri->segment(3);?>';
 var voucher_code 	= '';
 var is_proceed		= 1;
 var final_price = $('#final_price').val();
 $('.voucherCode').each(function(index, element){
   if (this.value == '')
   {
     $(this).css('background','#FEF1EC').css('border','1px solid #CD0A0A');
     is_proceed = 0;
   }
 });
 if (is_proceed == 1)
 {
    $('.voucherCode').each(function(index, element){
       voucher_code   =  voucher_code+this.value+'@';
    });
    $.ajax({
      type: "POST",
      url:  "<?php echo FRONTEND_URL;?>agent/market/payment/",
      data: {property_id:property_id,voucher_code:voucher_code,selected_date:selected_date,final_price:final_price,payment_type:'voucher' },
      beforeSend: function() {
       $('.succVoucherMsg').css('display','block');
    },
      success:function(data) {
       if (data == 1)
       {
	 location.reload();
       }
      }
    }); 
 }
});

$("input[name = 'paymentOption']").click(function(){
 if ($(this).val() == 'voucher')
 {
   $('.voucherPayment').css('display','block');
   $('.cardPayment').css('display','none');
 }
 else
 {
   $('.cardPayment').css('display','block');
   $('.voucherPayment').css('display','none');
 } 
});

$('.closeBtn').click(function(){
 $("input:radio[name='paymentOption']").each(function(i) {
       this.checked = false;
});
 $('.voucherPayment,.cardPayment').css('display','none'); 
});
</script>