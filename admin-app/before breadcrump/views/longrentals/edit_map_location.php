<?php
$location_name_options	=	'<select class="form-control required" name="map_location_id[]" id="map_location_id" data-required="true"><option value="">Select Location</option>';

$location_type		=	'';
foreach($default_map_location as $v)
{
    $flag	=	0;
    foreach($final_map_location as $x){
	if($v['location_name'] == $x['location_name']){
	    $flag	=	1;
	}
    }

    if($v['location_type'] == 'shopping')
	$location_type	=	'Shopping';
    elseif($v['location_type'] == 'attraction')
	$location_type	=	'Attraction';
    elseif($v['location_type'] == 'important_serveices')
	$location_type	=	'Important Services';
    elseif($v['location_type'] == 'beach')
	$location_type	=	'Beach';	
	
	
    if($flag	==	0){
	$location_name_options	=	$location_name_options.'<option value="'.$v['id'].'">'.$v["location_name"].' ('.$location_type.')'.'</option>'; 
    }
       
}

$location_name_options	=	$location_name_options."</select>";
$count			=	1;
?>



            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Longterm Rental Property</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="glyphicon glyphicon-home"></i>&nbsp;<a href="javascript:void(0);">Longterm Property</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit &nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
		    <li class="active">Map Location</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box portlet-green">
                            <div class="portlet-header">
                                <div class="caption">Rental Property Location</div>
                                <div class="tools">
                                   
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="rootwizard-custom-circle">
                                     <!--        TAB SECTION                    -->
                                    <?=$tabs?>
                                     <?php $page = $this->uri->segment(4,0); ?>
                                    <div class="tab-content">
                                        <form action="<?php echo BACKEND_URL.'longrentals/edit_map_location/'.$property_id.'/'.$page;?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                                            <input type="hidden" name="action" value="Process">
                                            
                                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                                           <!------general section start-->
                                          
					  <?php
                                           $val_msg='';
                                           if(isset($succmsg) && $succmsg != ""){
                                            
                                            $val_msg=$succmsg;
					    
                                           }
                                            
                                           if(isset($errmsg) && $errmsg != ""){
                                                
                                                $val_msg=$errmsg;
                                                
                                            }?>
					  
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-pink portlet box portlet-pink">
                                
                                                <div class="portlet-header">
                                                    <div class="caption">Property Map Location</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                                </div>
                                                   
                                                    <div class="portlet-body panel-body pan">
                                                        
                                                            <div class="form-body pal">
							    <div class="col-md-12 text-right">
								<span class="btn btn-blue" onclick="addMoreLocation();">
								    <i class="fa fa-plus-circle"></i> &nbsp;Override Another Location
								</span>
							    </div>
							
                                        <table width="100%" id="tableSeasons">
					<?php
					if(!empty($final_map_location))
					 {   
					if(count($final_map_location) > 0){
					    foreach($final_map_location as $v) { ?>
					    <tr><td>&nbsp;</td></tr>
					    <tr id="location_<?php echo $count; ?>">
					    <td>
						
						<?php
						if($v['location_type'] == 'shopping')
						    $location_type	=	'Shopping';
						elseif($v['location_type'] == 'attraction')
						    $location_type	=	'Attraction';
						elseif($v['location_type'] == 'important_serveices')
						    $location_type	=	'Important Services';
						elseif($v['location_type'] == 'beach')
						    $location_type	=	'Beach';
						?>
                                               <!-- <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group">    -->
                                                    
                                                    
						<div class="col-md-3">
						  <label for="reg_input_name" class="req">Location Name</label>					    
						    <input value="<?php echo $v['location_name'].' ('.$location_type.')';?>" name="" type="text" class="form-control required"  readonly >
						</div>
						<div class="col-md-3">
						  <label for="reg_input_name" class="req">Latitude</label>
						  <input value="<?php echo $v['latitude'];?>" name="latitude[]" type="text" class="form-control number required" data-required="true" data-type="number">
						</div>
						<div class="col-md-3">
						  <label for="reg_input_name" class="req">longitude</label>
						  <input value="<?php echo $v['longitude'];?>" name="longitude[]" type="text" class="form-control number required" data-required="true" data-type="number">
						</div>
						<input value="<?php echo $v['id'];?>" name="map_location_id[]" type="hidden" >
						<div class="col-md-3">
						    <br>
						    <div class="col-md-3">
							<span class="btn btn-red" onclick="removeLocation(<?php echo $count; ?>);" >
							    <i class="fa fa-minus-circle"></i> &nbsp; Remove Location
							</span>
						    </div>
						</div>
                                                
                                                
                                               <!-- </div>
                                                </div>
                                                </div>-->
					    </td>
					   
					</tr>
					<?php $count++;}
					} }?>
					<input value="<?php echo $property_id;?>" name="prop_id" type="hidden" >
				    </table>

                                                            </div>
                                                   </div>
                                               </div>
                                            </div>
                                            </div>


                                        
                                        <!------general section end-->
                                        
                                        
                                        </div>
                                        
                                        <div class="action text-right">
                                            <button type="button" name="previous" onclick="javascript:go_to('<?php echo base_url().'longrentals/contact/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/' ?>');" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button>
                                            <button type="submit" name="next" value="Finished" class="btn btn-info">Finish<i class="fa fa-arrow-circle-o-right mlx"></i></button>
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
var location_name_options	=	'<?php echo $location_name_options; ?>';
var count			=	 <?php echo $count; ?>;
var BACKEND_URL		=	'<?php echo BACKEND_URL;?>';

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




function addMoreLocation(){
    count++;
    $( "#tableSeasons" ).append( $( '<tr><td>&nbsp;</td></tr><tr id="location_'+count+'"><td><div class="col-md-3" ><label for="reg_input_name" class="req">Location Name</label>'+location_name_options+'</div><div class="col-md-3"><label for="reg_input_name" class="req">Latitude</label><input value="" name="latitude[]" type="text" class="form-control number required" data-required="true" data-type="number"></div><div class="col-md-3"><label for="reg_input_name" class="req">longitude</label><input value="" name="longitude[]" type="text" class="form-control number required" data-required="true" data-type="number"></div><div class="col-md-3"><br><div class="col-md-3"><span class="btn btn-red" onclick="removeLocation('+count+');" ><i class="fa fa-minus-circle"></i> &nbsp; Remove Location</span></div></div></td></tr>' ) );
   
}

function removeLocation(id){
	$('#location_' + id).slideUp('slow',function(){
	    $('#location_' + id).remove();
	    })
	
    }

//$(".skip").click(function() {
//window.location.href = BACKEND_URL+"rentals/";
//});

</script>
