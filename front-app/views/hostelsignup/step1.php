<script type="text/javascript" src="<?php echo FRONT_JS_PATH; ?>jquery.validate.min.js"></script>
<div id="hostelRegisterForm">
<form name="step1" id="step1" class="commonForm" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="Process" />
    <div id="firstStepDiv">
        <h1>First Step For the Hostel Booking</h1>
        <h3>Step 1 of 5</h3>
        <h2>Property Details</h2>
        <div style="width: 100%; float: left;">
            <div style="width: 48%; float: left;">
                <p><label>Property Name*</label><input type="text" name="property_name" id="property_name" value="" required /></p>
                <p><label>Property Type*</label>
                    <select name="property_type_id" id="property_type_id" required> 
                        <option value="">Please choose:</option>
                        <?php
                        if($propertyType){
                            foreach($propertyType as $type){
                                echo '<option value="'.$type['property_type_id'].'">'.stripslashes($type['property_type_name']).'</option>';
                            }
                        } ?> 
                    </select>
                </p>
                <p><label>Total number of bedrooms*</label><input type="number" name="bedrooms" id="bedrooms" value="" required /></p>
                <p><label>Number of beds (total ocupancy)*</label><input type="number" name="beds" id="beds" value="" required /></p>
            </div>
            <div style="width: 3%; float: left;">&nbsp;</div>
            <div style="width: 48%; float: left;">
                <p><label>Address 1*</label><input type="text" name="address" id="address" value="" required /></p>
                <p><label>Address 2</label><input type="text" name="address2" id="address2" value="" /></p>
                <p><label>State/Province</label> 
                    <select name="province_id" id="province_id" required>
                        <option value="">--Select Any--</option>
                         <?php
                        if($provinceMaster){
                            foreach($provinceMaster as $state){
                                echo '<option value="'.$state['province_id'].'">'.stripslashes($state['province_name']).'</option>';
                            }
                        } ?> 
                    </select>
                </p>
                <p><label>City*</label>
                    <select name="city_id" id="city_id">
                        <option value="">--Select--</option>
                    </select>
                </p>            
                <p><label>Postcode/Zip code</label><input type="text" name="zip_code" id="zip_code" value="" /></p> 
            </div>
        </div>
        <br />
        <h2>Contact Details</h2>
        <div style="width: 100%; float: left;">
            <div style="width: 48%; float: left;">
                <p><label>Contact Name*</label><input type="text" name="contact_name" id="contact_name" value="" required /></p>
                <p><label>Manager Email Address</label><input type="email" name="main_manager_email" id="main_manager_email" value="" /></p>
                <p><label>Email Address for Bookings*</label><input type="email" name="email_address_booking" id="email_address_booking" required value="" /></p>
                <p><label>Website Address</label><input type="url" name="website_address" id="website_address" value="" /></p>
            </div>
            <div style="width: 3%; float: left;">&nbsp;</div>
            <div style="width: 48%; float: left;"> 
                <p><label>How did you hear about us</label>
                    <select name="hear_about_id" id="hear_about_id">
                        <option value="">--Select Any--</option>
                        <?php
                        if($hearAboutUs){
                            foreach($hearAboutUs as $hear){
                                echo '<option value="'.$hear['hear_about_id'].'">'.stripslashes($hear['hear_about_name']).'</option>';
                            }
                        } ?> 
                    </select>
                </p>
                <p><label>Mobile Number*</label><input type="text" name="mobile_address" required id="mobile_address" value="" /><br />Please include your country code (i.e. 0035314980700).</p>
                <p><label>Phone Number*</label><input type="text" name="phone_no" required id="phone_no" value="" /><br />Please include your country code (i.e. 0035314980700).</p>
                <p><label>Fax Number</label><input type="text" name="fax_no" id="fax_no" value="" /><br />Please include your country code (i.e. 0035314980700).</p>  
            </div>
        </div>
        <div style=" float: right; width: auto;margin-right: 14%;"><input type="button" id="stepOneContinue" name="stepOneContinue" value="Continue" /></div>

    </div>
    
    <div id="secondStep" style="display: none;"> 
        <h3>Step 2 of 5</h3>
        <h2>Property Information</h2>
        <div style="width: 100%; float: left;"> 
            <div style="width: 100%; float: left;"> 
                <div style="float: left; width: 48%;"><label>Brief Introduction*<br /><textarea name="brief_introduction" id="brief_introduction" cols="70" rows="10" required></textarea></label></div>
                <div style="width: 3%; float: left;">&nbsp;</div>
                <div style="float: right; width: 48%;"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div>
            </div>
            <br /><br />
            <div style="width: 100%; float: left;"> 
                <div style="float: left; width: 48%;"><label>Description*<br /><textarea name="description" id="description" cols="70" rows="10" required></textarea></label></div>
                <div style="width: 3%; float: left;">&nbsp;</div>
                <div style="float: right; width: 48%;"><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div>
            </div>
            <br /><br />
            <div style="width: 100%; float: left;"> 
                <div style="float: left; width: 48%;"><label>Location/Area*<br /><textarea name="location" id="location" cols="70" rows="10" required></textarea></label></div>
                <div style="width: 3%; float: left;">&nbsp;</div>
                <div style="float: right; width: 48%;"><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</p></div>
            </div>
            <br /><br />
            <div style="width: 100%; float: left;"> 
                <div style="float: left; width: 48%;"><label>Direction*<br /><textarea name="direction" id="direction" cols="70" rows="10" required></textarea></label></div>
                <div style="width: 3%; float: left;">&nbsp;</div>
                <div style="float: right; width: 48%;"><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p></div>
            </div>
            <br /><br />
            <div style="width: 100%; float: left;"> 
                <div style="float: left; width: 48%;"><label>Things to Note & Policies*<br /><textarea name="things_to_note" id="things_to_note" cols="70" rows="10" required></textarea></label></div>
                <div style="float: right; width: 48%;"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div>
            </div>
        </div>
        <div style=" float: right; width: auto;margin-right: 14%;">
            <input type="button" id="backTostepOne" name="backTostepOne" value="Previous" />
            <input type="button" id="stepTwoContinue" name="stepTwoContinue" value="Continue" />
        </div>
    </div>
    
    <div id="thirdStep" style="display: none;">
        <h3>Step 3 of 5</h3>
        <h2>Property Facilities</h2>
        <div style="width: 100%; float: left;">
            <?php if($facilities){ ?>
            <ul>
                <?php foreach($facilities as $fac){ ?>
                    <li style=" width: 24%; float: left; list-style-type: none;"><input name="property_facilities[]" type="checkbox" value="<?php echo stripslashes($fac['amenities_id']); ?>"><?php echo stripslashes($fac['amenities_name']); ?></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <div style="width: 100%; float: left;">
            <h2>Property Policies</h2>
            <?php if($policyMaster){ ?>
            <ul>
                <?php foreach($policyMaster as $policy){ ?>
                    <li style=" width: 24%; float: left; list-style-type: none;"><input name="property_policy[]" type="checkbox" value="<?php echo stripslashes($policy['policies_master_id']); ?>"><?php echo stripslashes($policy['policies_name']); ?></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        
        <div style="width: 100%; float: left;">
            <h2>Property Policies</h2>
            <?php if($policyMaster){ ?>
            <ul>
                <?php foreach($policyMaster as $policy){ ?>
                    <li style=" width: 24%; float: left; list-style-type: none;"><input name="property_policy[]" type="checkbox" value="<?php echo stripslashes($policy['policies_master_id']); ?>"><?php echo stripslashes($policy['policies_name']); ?></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        
        <div style=" float: right; width: auto;margin-right: 14%;">
            <input type="button" id="backTostepTwo" name="backTostepTwo" value="Previous" />
            <input type="button" id="stepThreeContinue" name="stepThreeContinue" value="Continue" />
        </div>
    </div>
    
    <div id="fourthStep" style="display: none;">        
        <div style="width: 100%; float: left;">
            <h2>Photos</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <div style="width: 100%; float: left;">
                <button id="browseButton">+ add New Image</button>
                <p><input type="file" name="propertyfiles[]" multiple="multiple" class="propertyfiles" onchange="javascript:attachImages(this)" style="display: none;"/></p>
                <table role="presentation" class="table table-striped">
                <tbody class="files preiviewPropertyImages"></tbody>
            </table>
            </div>
        </div>
        <div style="width: 100%; float: left;">
            <h2>Videos</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <div style="width: 100%; float: left;">
                <p><label>Video Location</label><input type="text" name="property_video_link" id="property_video_link" value="" /></p>
            </div>
        </div>        
        <div style=" float: right; width: auto;margin-right: 14%;">
            <input type="button" id="backTostepThree" name="backTostepThree" value="Previous" />
            <input type="submit" id="stepFourContinue" name="stepFourContinue" value="Save and Submit" />
        </div>
    </div>
    
    <!--<div id="fifthStep" style="display: none;">
        fifth step
        <div style=" float: right; width: auto;margin-right: 14%;">
            <input type="button" id="backTostepFour" name="backTostepFour" value="Previous" />
            <input type="submit" id="stepFiveContinue" name="stepFiveContinue" value="Save and Submit" />
        </div>
    </div>-->
    
</form>
        
</div>