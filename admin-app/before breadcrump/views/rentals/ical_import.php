<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>
            
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="<?php echo BACKEND_URL."property_rental/"?>">Rentals Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Availability</div>
                                <div class="tools">
                                    <i class="fa fa-chevron-up"></i>
                                    <!--<i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i>-->
                                    <!--<i class="fa fa-refresh"></i>-->
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                   
                                    <?php
                                    $page = $this->uri->segment(4,0);
                                    $property_id  = $this->uri->segment(3,0);
                                    ?>
                                   
                                    <div class="tab-content">
                                         <form class="ical-form" enctype="multipart/form-data" method="post" action="<?php echo BACKEND_URL;?>property_rental/ical/<?php echo $property_id.'/'. $page;?>/" >
                                         <input type="hidden" value="Process" name="action" />
                                        <div id="tab1-wizard-custom-circle" class="tab-pane"><!--<h3 class="mbxl">Set up your account</h3>-->
                                           
                                          
                                       
                                            <div class="row">
                                                
                                                <!------------- ical section -------------------->
                                                 
                                                    <div class="panel panel-blue portlet box portlet-blue">
                                                        <!--<div class="panel-heading">Availability </div>-->
                                                    <div class="portlet-header">
                                                    <div class="caption">Availability</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                   </div>
                                                        <div class="portlet-body ">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="manage_by" class="col-sm-3 control-label">Property manage by  </label>
                                                                            <div class="col-md-2">
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="radio-inline">
                                                                                    <input type="radio" name="syn" value="KA" id="KA" <?php if($manage_by=='KA'){echo 'checked';} ?> class="form-control manage_by radion_frm_class" />
                                                                                    &nbsp;KIGO API
                                                                                </label>
                                                                                
                                                                                <label class="radio-inline">
                                                                                    <input type="radio" name="syn" id="K" value="K" <?php if(in_array($manage_by,array('K','FK','AR'))){echo 'checked';} ?> class="form-control manage_by radion_frm_class" />
                                                                                     &nbsp; iCal	
                                                                                </label>
                                                                                
                                                                                <label class="radio-inline">
                                                                                    <input type="radio" name="syn" id="NA" value="NA"  <?php if($manage_by=='NA' || !$manage_by){echo 'checked';} ?>  class="form-control manage_by radion_frm_class" />
                                                                                      &nbsp; NA      
                                                                                </label>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                
                                                                </div>
                                                                
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
                                                                   
                                                                    ?>
                                                                  
                                                             <br>
                                                            <div class="row ka-id-elmnt " style="<?php echo $ka_id_elmnt_style; ?>">
                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                          <label for="similar_property_tag" class="col-md-3 control-label" >KIGO ID </label>
                                                                      <div class="col-md-8 input-icon"><i class="mts" >#</i>
                                                                              <input type="text"  name="kigo_id" value="<?php if($kigo_id){echo $kigo_id;} ?>"  class="ka-id form-control ">
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                            </div>
                                                           
                                                            <div class="row url-elmnt " style="<?php echo $url_elmnt_style; ?>">
                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                          <label for="similar_property_tag" class="col-md-3 control-label" >Paste iCal URL</label>
                                                                      <div class="col-md-8 input-icon"><i class="fa fa-chain"></i>
                                                                             <input type="url"  name="icalurl" value="<?=$ical_url; ?>"  class="flip-syn  icalurl form-control ">
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                            </div>
                                                              
                                                        </div>
                                                    </div>
                                                    
                                                    
                                               
                                                
                                                <!------------- ical section -------------------->
                                                
    
                                            </div> <!--row-->


                                        
                                        <!------general section end-->
                                        
                                           
                                        </div>
                                        
                                         
                                        <div class="action text-right">
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'property_rental/images/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="submit" name="next" value="Next" class="btn btn-info button-next mlm">Next<i class="fa fa-arrow-circle-o-right mlx"></i></button>
                                        </div>
                                        
                                        </form>   
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
                
            </div>
            <!--END CONTENT-->
    
    <script>
    
    /**** session succ/err msg display *****/
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
    
        
        
    var manage_by = '<?php echo $manage_by; ?>';
    var old_ical_url = '<?php echo $ical_url; ?>';
    var old_kigo_id = <?php echo $kigo_id; ?>;
    
  

   // $('.manage_by').click(function(){
    $(document.body).on('ifChecked','input',function(){
	var value = $(this).val();
	manage_form_element(value);
	
    });
    
    function manage_form_element(syn){
	if (syn=='KA') {
	   $('.url-elmnt').hide();
	   $('.m-id-elmnt').hide();
	   $('.ka-id-elmnt').show();
	   
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
   
     
    $(".ical-form").submit(function(){
	
	if ( $("#NA").is(":checked") && (old_ical_url != '' || old_kigo_id != '')) {
	     if( confirm("Do you want to delete all avaibality calender dates for this property? ")==false){
		 return false;				
	     }
	 }
	 $(".loader").show();
    });
    </script>