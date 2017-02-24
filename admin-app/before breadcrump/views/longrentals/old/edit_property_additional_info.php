<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="<?php echo BACKEND_CSS_PATH;?>uploadfile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BACKEND_JS_PATH; ?>jquery.uploadfile.js"></script>

<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
		<?php } ?>
		<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
		<?php }
		
		//pr($arr_property_addi_info);
		
		?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit property additional information</h4>
                    </div>
                    <div class="panel-body">
		<div class="row">
		    <div class="col-sm-12">
                	
                    <ul class="property_tab">
                        <li><a id="property_information_div" class="property_menu" href="<?php echo BACKEND_URL;?>property/edit_property_information/<?php echo $arr_property_addi_info[0]['property_id'];?>/<?php echo $page;?>">Property Information</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_image/<?php echo $arr_property_addi_info[0]['property_id'];?>/<?php echo $page;?>">Property Image</a></li>
                        <li><a href="<?php echo BACKEND_URL;?>property/edit_property_rentals/<?php echo $arr_property_addi_info[0]['property_id'];?>/<?php echo $page;?>">Property Rentals</a></li>
                        <li ><a href="<?php echo BACKEND_URL;?>property/edit_property_sales/<?php echo $arr_property_addi_info[0]['property_id'];?>/<?php echo $page;?>">Property Sales</a></li>
			<li class="active"><a>Property Additional Information</a></li>
		   </ul>
                    <div class="clear"></div>
			    
                    	           
                            <div id="property_additional_information_fieldset" class="property_tag_class" >
                            <form name="frmPropertyAdditionalInfo" id="frm5" enctype="multipart/form-data" action="<?php echo BACKEND_URL.'property/edit_property_additional_info/'.$arr_property_addi_info[0]['property_id'].'/'.$page;?>" method="post"class="parsley_reg">
			    <input type="hidden" name="action" value="Process">
			    <div class="col-sm-12">
				<div class="step_info">
				    <h4>Additional Information</h4>
				    <p>This is additional information of the property</p>
				</div>
			    </div>
			    
				<input type="hidden" name="action" value="Process">
				<input type="hidden" name="property_new_id_additional" id="property_new_id_additional" value="" />
				    <fieldset>
					<div class="col-sm-12">
					    <div class="row basic_info">
						<!--<h4 class="proHeadingText">Property Name</h4>-->
						<div class="col-sm-12">
						    <label style="diplay:block; clear: both;" class="req" for="property_name">List of Documents</label>
						    <?php
						    if(is_array($document_list))
						    {
							$doc_id_string = $arr_property_addi_info[0]['documents_id'];
							$doc_id_array = explode(',',$doc_id_string);
							for($d=0;$d<count($document_list);$d++)
							{
							    if(in_array($document_list[$d]['document_type_id'],$doc_id_array))
							    {
							    ?>
							    <input style="diplay:block; width: auto; float: left; margin: 0 10px 0 0;" type="checkbox" name="documents[]" value="<?php echo $document_list[$d]['document_type_id'];?>" class="form-controlthree"  checked="checked" ><span  style="diplay:block; width: auto; float: left; padding: 0 10px 0 0;"><?php echo $document_list[$d]['document_type_name'];?></span>
							    <?php
							    }
							    else
							    {
								?>
							    <input style="diplay:block; width: auto; float: left; margin: 0 10px 0 0;" type="checkbox" name="documents[]" value="<?php echo $document_list[$d]['document_type_id'];?>" class="form-controlthree" ><span  style="diplay:block; width: auto; float: left; padding: 0 10px 0 0;"><?php echo $document_list[$d]['document_type_name'];?></span>
							    <?php
							    }
							 }
						    } ?>
						</div>
						
						<br class="spacer" />
						<div class="col-sm-12">
						    <label class="req">Web Portal</label>
						    <input type="text" name="web_portal" id="web_portal" class="form-controlthree " value="<?php  echo $arr_property_addi_info[0]['web_portal']; ?>" data-required="true">
						    
						</div>
						<h4 class="proHeadingText">Note Section</h4>
						    <div class="col-sm-12">
						    <label for="reg_input_name">Add Notes</label>
						    <textarea name="add_notes_general" id="add_notes_general" class="form-controltwo" style="width:100%;height:150px"></textarea>
						  </div>
						
						<br class="spacer" />
						<table width="98%" cellpadding="2" cellspacing="3" border="1" class="imageListBox">
						    <tr>
							<th style="width:80%">Note Description</th>
							<th style="width:20%">Added On</th>
						    </tr>
						    <?php
						    //echo "<><><><>".sizeof($note_list);
						    if(is_array($note_list))
						    {
							for($n=0;$n<sizeof($note_list);$n++)
							{
						    ?>
						    <tr>
							<td><?php echo stripslashes(trim($note_list[$n]['note_description']));?></td>
							<td><?php echo date("d M,Y H:i:s", strtotime($note_list[$n]['added_on']));?></td>
						    </tr>
						    <?php
							}
						    } else {
						    ?>
						    <tr>
							<td colspan="2">No record found</td>
						    </tr>
						    <?php } ?>
						</table>
				
						<br class="spacer" />
						<div class="">
						    <button class="btn btn-default frm_step_next" type="submit">Save</button>
						</div>
					    </div>
					    
					    
                                	</div>
					
				    </fieldset>				    
			       
			    
			    </form>
			    </div>
			    
			    
                            <input type="hidden" name="frm_cnt" id="frm_cnt" value="1" />
			    <input type="hidden" id="backend_url" value="<?php echo BACKEND_URL;?>"  />
			    <input type="hidden" id="frontend_url" value="<?php echo FRONTEND_URL;?>"  />
			    
				<div style="float:right;margin-top:-150px;display:none;" id="div_loader">
				    <img src="<?php echo BACKEND_IMAGE_PATH;?>loaderText.gif" alt="Loading...Please wait" width="400px">
				</div>
				
                            </div>
                        </div>	
            		</div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
