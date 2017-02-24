<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
    <?php } ?>
    	<?php //pr($_POST,0); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add New Property Type</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="main" enctype="multipart/form-data">
			    <input type="hidden" name="action" value="Process">			    			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Property Owner</label>
				<?php if(is_array($ownerInfo)) { ?>
				<select name="owner_id" id="owner_id" class="required form-control" data-required="true" >
				  <option value="">--Select Owner--</option>
				  <option value="-1" <?php if($add_owner_id == -1) { echo 'selected="selected"'; } ?>> Add New Owner </option>
				  <?php foreach($ownerInfo as $key){?>
				  <option value="<?php echo $key['owner_id'];?>"> <?php echo $key['first_name'].' '.$key['last_name'];?> </option>
				  <?php } ?>
				</select>
				<?php } ?>
			    </div>			    
			    <div class="form_sep">
                                <button class="btn btn-default" type="submit">Next</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Back</button>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
	
	    	<div class="row" id="ownerAdd" <?php if($owner_add == 0){ ?>style="display: none;" <?php } ?> >
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add owner</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" id="parsley_reg">
				<input type="hidden" name="action" value="AddOwner">				
				<div class="col-sm-4">
				    <div class=inputGapStyle>
					<label for="reg_input_name" >Salutation</label>
					<select class="form-control" name ="mr_mrs" id="mr_mrs">    
					    <option value="Mr." >Mr.</option>
					    <option value="Mrs." >Mrs.</option>	
					</select>                            
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name" class="req">First name</label>
				    <input type="text" class="form-control required" data-required="true" name="first_name" id="first_name" value="">
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name" class="req">Last name</label>
				    <input type="text" class="form-control required" data-required="true" name="last_name" id="last_name" value="">
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name" >Email</label>
				    <input type="text" class="form-control required" name="email" id="email" value="">
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name" class="req" >Phone number(cell)</label>
				    <input type="text" class="form-control required" name="phone_number_cell" id="phone_number_cell" value="" data-required="true" data-type="number">
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name"  >Phone number(home)</label>
				    <input type="text" class="form-control " name="phone_number_home" id="phone_number_home" value="">
				    </div>
				    <div class=inputGapStyle> 
				    <label for="reg_input_name"  >Phone number(business)</label>
				    <input type="text" class="form-control" name="phone_number_business" id="phone_number_business" value="">
				    </div>
				    <div class=inputGapStyle>
				    <label for="reg_input_name" >Fax number</label>
				    <input type="text" class="form-control" name="fax_number" id="fax_number" value="">
				    </div>
				</div>				
                            <div class="col-sm-4">
				<div class=inputGapStyle>
				<label for="reg_input_name" >Street number</label>
                                <input type="text" class="form-control " name="street_no" id="street_no" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name"  >Address1 </label>
				<input type="text" class="form-control " name="address1" id="address1" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name" >Address2</label>
                                <input type="text" class="form-control" name="address2" id="address2" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name" >Address3</label>
                                <input type="text" class="form-control" name="address3" id="address3" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name" >Postcode</label>
                                <input type="text" class="form-control " name="postcode" id="postcode" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name" >City</label>
                                <input type="text" class="form-control" name="city" id="city" value="">
				</div>
				    <div class=inputGapStyle>
				<label for="reg_input_name" >Country</label>
                                <input type="text" class="form-control" name="country" id="country" value="">
				</div>
				<div class=inputGapStyle>
				<label for="reg_input_name" >Language select</label>
				<select class="form-control" name ="lang_id[]" id="lang_id[]" multiple="true" >
					<?php if($arr_language_name) {
					foreach($arr_language_name as $arr_language_names) { ?>
					   <option value="<?php  echo $arr_language_names['lang_id'] ?>"><?php  echo $arr_language_names['lang_name'] ?></option>
					 <?php } } ?>	
				</select>			
				</div>
			    </div>
			     <div class="col-sm-4">
				<div class=inputGapStyle>
				<label for="reg_input_name">Additional contact info</label>
                                <textarea name="addi_contact_info" id="addi_contact_info" cols="30" rows="5"></textarea>
				</div>
				<div class=inputGapStyle>
				<label for="reg_input_name">Owner's website url</label>
                                <input type="text"  name="owner_website_url" id="owner_website_url" value="" class="form-control">
				</div>
				<div class=inputGapStyle>
				<label for="reg_input_name" >Currency</label>
                                <input type="text" class="form-control" name="currency" id="currency" value="">
				</div>
                            </div>
			     
			     <br class="spacer">
			      
			     <div class="col-sm-12 form_sepRight">
				<div class="form_sep">
				    <button class="btn btn-default" type="submit">Add</button>
				    <button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
				</div>
			    </div>
			    <?php /*
			    <input type="hidden" name="action" value="AddOwner">
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">First name</label>
                                <input type="text" class="form-control required" name="first_name" id="first_name" value="">
                            </div>			    						    
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Last name</label>
                                <input type="text" class="form-control required" name="last_name" id="last_name" value="">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Email</label>
                                <input type="text" class="form-control required" name="email" id="email" value="">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req" >Contact number</label>
				<input type="text" class="form-control required" name="contact_number" id="contact_number" value="">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req" >Contact number2</label>
				<input type="text" class="form-control required" name="contact_number2" id="contact_number2" value="">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name"  class="req">Address1 </label>
				<input type="text" class="form-control required" name="address1" id="address1" value="">                               
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" >Address2</label>
                                <input type="text" class="form-control" name="address2" id="address2" value="">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Postcode</label>
                                <input type="text"  name="postcode" id="postcode" value="" class="form-control required">
                            </div>
			     <div class="form_sep">
                                <label for="reg_input_name" class="req">Language select</label>
				<select class="form-control required" name ="lang_id" id="lang_id" >					
					<?php
					foreach($arr_language_name as $arr_language_names)
					{ ?>
					   <option value="<?php  echo $arr_language_names['lang_id'] ?>"><?php  echo $arr_language_names['lang_name'] ?></option>
					 <?php    
					} ?>					
				</select>                                
                            </div>			    
                            <div class="form_sep">
                                <button class="btn btn-default" type="submit">Add</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
                            </div>
                            */ ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	
    <!--End : Main content-->    
</div>