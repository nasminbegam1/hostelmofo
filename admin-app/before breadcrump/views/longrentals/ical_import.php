<? if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="main_content_outer" class="clearfix">
<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACKEND_JS_PATH;?>lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<script src="<?php echo BACKEND_JS_PATH; ?>lib/iCheck/jquery.icheck.min.js"></script>
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH;?>todc-bootstrap.min.css">




<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
	<?php } ?>
	<?php if(validation_errors() != FALSE || $errmsg){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
		   <p><?php echo stripslashes($errmsg);?></p>
                </div>
            </div>
	<?php }
	//pr($arr_property_rent);
	?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Property</h4>
                    </div>
                    <div class="panel-body">
            <div class="row">
            	<div class="col-sm-12">
		    
		     <?php  echo $tabs; ?>
		    
                    <?php
		    $page = $this->uri->segment(4,0);
		    $property_id  = $this->uri->segment(3,0);
		    ?>
                  
			
		    </ul>
                    <div class="clear"></div>
			    
                    		<div id="property_information_fieldset" class="property_tag_class">
				
				<div style="display:none;" class="loader fk-loader ical-loader "><img src="<?php echo BACKEND_IMAGE_PATH.'ajax_loader_gray_64.gif'; ?>" alt=""></div>
				
				
				<fieldset>
                                <div class="row basic_info">
                                    <div class="col-sm-12">
					<div class="section-one panel panel-default panelOne" >
					     <div class="panel-heading">
						 <h2 class="panel-title"><strong>Property Manage	</strong> </h2>
					    </div>
					      <br class="spacer" />
					      
					<form name="frmPropertyInformation" id="frm1" class="parsley_reg" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>rentals/ical_import/<?php echo $property_id.'/'. $page;?>/" >
					     <div class="col-sm-9 checkBox">
						    <label for="property_name" >Property manage by
							<span class="label label-info  hint--right hint--info" data-hint="Select where from manage your property"><strong>?</strong></span>
						    </label>
						    
						    <div class="serial-radio manage-radio-div">
							<label class="radio-label">
							    <input type="radio" name="syn" value="KA" id="KA" <?php if($manage_by=='KA'){echo 'checked';} ?> class="form-control manage_by radion_frm_class" />
							    <span  class="radio_lebel">KIGO API</span>
							</label>
							
							<label class="radio-label">
							    <input type="radio" name="syn" id="K" value="K" <?php if(in_array($manage_by,array('K','FK','AR'))){echo 'checked';} ?> class="form-control manage_by radion_frm_class" />
							    <span  class="radio_lebel">iCal	</span>
							</label>
							
							
							<label class="radio-label">
							    <input type="radio" name="syn" id="M" value="M"  <?php if($manage_by=='M' ){echo 'checked';} ?>  class="form-control manage_by radion_frm_class" />
							    <span  class="radio_lebel">Manual</span>
							</label>
							
							<label class="radio-label">
							    <input type="radio" name="syn" id="NA" value="NA"  <?php if($manage_by=='NA' || !$manage_by){echo 'checked';} ?>  class="form-control manage_by radion_frm_class" />
							    <span  class="radio_lebel">NOT</span>
							</label>
							
							
							
							
						    </div>
						    
					    </div>
					     <br class="spacer" />
					     <br class="spacer" />
					     
					    <?php
					    $ka_id_elmnt_style = $url_elmnt_style = '';$m_id_elmnt_style='';
					    if($manage_by == 'KA' && $manage_by != 'NA'&& $manage_by != 'M'){
						$url_elmnt_style = 'display:none';
					    }elseif($manage_by != 'KA' && $manage_by != 'NA' && $manage_by != 'M'){
						
						$ka_id_elmnt_style = 'display:none';
					    }else{
						$url_elmnt_style = 'display:none';
						$ka_id_elmnt_style = 'display:none';
						$m_id_elmnt_style = 'display:none';
					    }
					    switch($manage_by){
						case "KA":
						    $ka_id_elmnt_style="display:block";
						    $url_elmnt_style="display:none";
						    $m_id_elmnt_style="display:none";
						break;
						case "K":
						case "FK":
						case "AR":
						    $url_elmnt_style="display:block";
						    $ka_id_elmnt_style="display:none";
						    $m_id_elmnt_style="display:none";
						break;
						case "M":
						    $m_id_elmnt_style="display:block";
						    $ka_id_elmnt_style="display:none";
						    $url_elmnt_style="display:none";
						break;
						case "NA":
						    $m_id_elmnt_style="display:none";
						    $ka_id_elmnt_style="display:none";
						    $url_elmnt_style="display:none";
						break;
					    }
					    
					    
					    ?>
					     <div class="col-sm-9 ka-id-elmnt " style="<?php echo $ka_id_elmnt_style; ?>">
						<label for="property_name" >KIGO ID 
						    <span class="label label-info  hint--right hint--info" data-hint="Enter your KIGO ID of property"><strong>?</strong></span>
						</label>
						<input type="text"  name="kigo_id" value="<?php if($kigo_id){echo $kigo_id;} ?>"  class="ka-id form-control ">
					    </div>
					    
					      <div class="col-sm-9 m-id-elmnt " style="<?php echo $m_id_elmnt_style; ?>">
						<label for="property_name" >Calander
						    <span class="label label-info  hint--right hint--info" data-hint="Add Manual Dates"><strong>?</strong></span>
						    <p>Range select</p>
						    <div id="manual_calander" data-item="range"></div>
						    
						    <p>Single date Select</p>
						    <div id="manual_calander1" data-item="multiple date"></div>
						</label>
						
					    </div>
					   
					    
					     <div class="col-sm-9 url-elmnt " style="<?php echo $url_elmnt_style; ?>">
						    <label for="property_name" >Paste iCal URL 
							<span class="label label-info  hint--right hint--info" data-hint="Paste your ical url"><strong>?</strong></span>
						    </label>
						    <input type="url"  name="icalurl" value="<?=$ical_url; ?>"  class="flip-syn  icalurl form-control ">
					    </div>
					    
					    
					     <div class="save_div_class in_panel">
						<input type="hidden" name="action" value="Process"/>
						<button class="btn btn-default frm_step_next" type="submit" id="btn_property_image_fieldset"  value="import" name="flipkey_import">Save & Synchronize</button>
					     </div>
					      <br class="spacer" />
					      <br class="spacer" />
					      
					     
					     <div class="save_div_class">
						<input type="hidden" autocomplete='off' name="frontend_url" id="frontend_url" value="<?php echo FRONTEND_URL; ?>" />
						 <a class="btn btn-default frm_step_next no-cache-redirect" href="<?php echo BACKEND_URL.'rentals/payment/'.$property_id.'/'.$page;  ?>/" > Skip & Continue</a>
						 <a class="btn btn-default frm_step_next no-cache-redirect" href="<?php echo BACKEND_URL."rentals/contact/".$property_id."/".$page;?>" > < Back</a>
					    </div>
					     
					</form>
				       </div>
				    </div>
			      <!--		End property manage by section			-->
		    
			    </div>
                            
                            
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input  type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
			</div>
                        </div>	
            		</div>
		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
<script src="<?php echo FRONT_JS_PATH; ?>jquery-ui.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" href="<?php echo FRONT_JS_PATH; ?>jquery-ui.css">
<script>
    
    // new with kigo id and url
    
    //$(function(){
    //
    //});
 //selectedDay
// selectedMonth
// selectedYear
    
     var date="";
        <?php
	$start="01-".date("m")."-".date("Y");
	$endOfCycle = strtotime(date("Y-m-d", strtotime("+363 days", strtotime($start))));
	
	 $d=strtotime(date("Y-m-d"));
	 $no_date=($endOfCycle-$d)/86400;
	 $min_date='';
	 if($start==$d){$min_date=0; }
	 else{$min_date="-".(date("d")-1);}
	 
	?>
	var removeDate=new Array();
	var date_arr=new Array();
	//var date_arr=new Array('1/10/2014','2/10/2014','3/10/2014','6/10/2014','7/10/2014'); // for edit
	var start_date="", end_date="";var selectCount=0;
    $(function(){
	
	$("#manual_calander1").multiDatesPicker({
	    numberOfMonths:[4,3],
	    minDate:<?php echo $min_date ?>,
            maxDate:<?php echo $no_date ?>
	});
	$("#manual_calander").multiDatesPicker({
	    numberOfMonths:[4,3],
	    minDate:<?php echo $min_date ?>,
            maxDate:<?php echo $no_date ?>,
	    
	    onSelect:function(datetext,obj)
	    {
		setCustomDate(datetext,obj);
			    
	    },
	    beforeShowDay:function(date){
		
		for(var i=0; i<date_arr.length; i++) {
		    var d=$.datepicker.parseDate($.datepicker._defaults.dateFormat, date_arr[i]);
		    if (date.getDate()==d.getDate() && date.getMonth()==d.getMonth() && date.getFullYear()==d.getFullYear()) {
			return [true, 'ui-state-highlight'];
		    }
		
		}
		  return [true, ''];
	    },	
	  
	});
	
	  
    });
    
    function setCustomDate(date,obj){
	var start=$("td.ui-state-highlight").first();
			var end=$("td.ui-state-highlight").last();
			var count=0;
			   //for(var x in obj){
			   // alert(x+":"+obj[x]);
			   //}
			   //selectedDay
			   //selectedMonth
			   //selectedYear
			     $("#manual_calander .ui-state-default").each(function(index,element){
				  if ($(element).text()==start.text() &&
				      $(element).parent().attr("data-year")==start.attr("data-year") &&
				      $(element).parent().attr("data-month")==start.attr("data-month")
				      ) {
				     count=1;
				  }
				  if (count==1) {
				
				     var month=Number($(element).parent().attr("data-month"))+1;
				     var d=$(element).text()+"/"+month+"/"+ $(element).parent().attr("data-year") ;
				     
				     if (date_arr.indexOf(d)==-1 && removeDate.indexOf(d)==-1) {
					    date_arr.push(d); 
						
				     }else{
						if ($(element).text()==obj['selectedDay'] &&
						    $(element).parent().attr("data-year")==obj['selectedYear'] &&
						    $(element).parent().attr("data-month")==obj['selectedMonth']
						  ) {
						   
						    if (date_arr.indexOf(d) !=-1) {
							date_arr.splice( date_arr.indexOf(d),1 );
							removeDate.push(d);
						    }else{
							date_arr.push(d); 
						    }
						    
						}
				     }
				  }
				    if ($(element).text()==end.text() &&
				        $(element).parent().attr("data-year")==end.attr("data-year") &&
				        $(element).parent().attr("data-month")==end.attr("data-month")
				      ){ return false;}
				});
			
				if (date_arr.length>0) {
				  $("#manual_calander").multiDatesPicker("addDates", date_arr);
				  
				  alert(date_arr+"\n----------------------------------\n"+removeDate);
				}
    }
    
    
    var manage_by = '<?php echo $manage_by; ?>';
    var old_ical_url = '<?php echo $ical_url; ?>';
    var old_kigo_id = <?php echo $kigo_id; ?>;

    $('.manage_by').click(function(){
	var value = $(this).val();
	manage_form_element(value);
	
    });
    
    function manage_form_element(syn){
	if (syn=='KA') {
	   $('.url-elmnt').hide();
	   $('.m-id-elmnt').hide();
	   $('.ka-id-elmnt').show();
	   
	}
	else if (syn=='M') {
	   $('.url-elmnt').hide();
	   $('.ka-id-elmnt').hide();
	   $('.m-id-elmnt').show();
	   
	}
	else{
	   $('.m-id-elmnt').hide();
	     $('.ka-id-elmnt').hide();
	     //alert(manage_by + ' '+ syn);
	    $(".icalurl").val(old_ical_url);
	    $('.url-elmnt').show();
	}
	if(syn=='NA'){
	    $('.ka-id-elmnt').hide();
	    $('.url-elmnt').hide();
	}
    }
   
     
    $(".parsley_reg").submit(function(){
	
	if ( $("#NA").is(":checked") && (old_ical_url != '' || old_kigo_id != '')) {
	     if( confirm("Do you want to delete all avaibality calender dates for this property? ")==false){
		 return false;				
	     }
	 }
	 $(".loader").show();
    });

    ///////////////////////////////////////////////////////////////////
    
    
//    var old_fk_iacal_url = "<?php //$fk_ical_url; ?>";
//    var old_ar_iacal_url = "<?php //$ar_ical_url; ?>";
//    var old_k_iacal_url = "<?php //$k_ical_url; ?>";
// 
//    $(function(){
//     if ($("#flip-disable").is(":checked")) {
//	$(".flip-syn").prop("value","");
//	$(".flip-syn").prop("disabled","disabled");
//     }  
//      if ($("#airbnb-disable").is(":checked")) {
//	$(".airbnb-syn").prop("value","");
//	$(".airbnb-syn").prop("disabled","disabled");
//     }
//     if ($("#kigo-disable").is(":checked")) {
//	$(".kigo-syn").prop("value","");
//	$(".kigo-syn").prop("disabled","disabled");
//     }
//     
//    });
//    
//    $("#flip-disable").on('click',function(){
//	$(".flip-syn").prop("value","")
//	$(".flip-syn").prop("disabled","disabled");
//    });
//     $("#flip-enable").on('click',function(){
//	$(".fk-icalurl").val(old_fk_iacal_url);
//	$(".flip-syn").prop("disabled",false);
//	
//    });
//    
//    // airbnb 
//    $("#airbnb-disable").on('click',function(){
//	$(".airbnb-syn").prop("value","")
//	$(".airbnb-syn").prop("disabled","disabled");
//    });
//     $("#airbnb-enable").on('click',function(){
//	$(".ar-icalurl").val(old_ar_iacal_url);
//	$(".airbnb-syn").prop("disabled",false);
//	
//    });
//    
//    // airbnb 
//    $("#kigo-disable").on('click',function(){
//	$(".kigo-syn").prop("value","")
//	$(".kigo-syn").prop("disabled","disabled");
//    });
//     $("#kigo-enable").on('click',function(){ 
//	$(".k-icalurl").val(old_k_iacal_url);
//	$(".kigo-syn").prop("disabled",false);
//	
//    });
//    
//    var fk_record_exist = "<?php //echo $fk_record_exist; ?>";
//    var ar_record_exist = "<?php //echo $ar_record_exist; ?>";
//    var k_record_exist = "<?php //echo $k_record_exist; ?>";
//     

//    $(".parsley_reg").submit(function(){
//    	 if ($("#flip-disable").is(":checked") && fk_record_exist != '' ) {
//	   if(confirm("You have select FlipKey Synchronize disable option \nDo you want to delete Flipkey Calender? ")==false){
//	     return false;
//	   }
//	  
//	 }
//		
//	 if ( $("#airbnb-disable").is(":checked") && ar_record_exist != '') {
//	     if( confirm("You have select  Airbnb Synchronize disable option \nDo you want to delete Airbnb Calender? ")==false){
//		 return false; 
//		
//	     }
//	 }
//	if ( $("#kigo-disable").is(":checked") && k_record_exist != '') {
//	     if( confirm("You have select KIGO Synchronize disable option \nDo you want to delete KIGO Calender? ")==false){
//		 return false;				
//	     }
//	 }
//	  $(".loader").show();
//    
//    });
//    
//    //loader
//    $(".loader").hide();
  
</script>