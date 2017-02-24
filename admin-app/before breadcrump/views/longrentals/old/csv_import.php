<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	 <?php
	     if(isset($succmsg) && $succmsg != "")
             {
                ?>
                    <div align="center">
                    <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                    </div>
                    </div>
		<?php
             }
            ?>
            <?php
	    if(isset($errmsg) && $errmsg != "")
            {
                ?>
                    <div align="center">
                    <div class="nNote nFailure" style="width: 600px;">
                    <p><?php echo stripslashes($errmsg);?></p>
                    </div>
                    </div>
            <?php
            
            } ?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Upload CSV</h4>
                    </div>
                    <div class="panel-body">
			
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Upload</label>
                                <input type="file" name="csvfile" value="upload">
                            </div>
			    
                            <div class="form_sep">
                            <input type="submit" id="submit_btn" value="Click to import" class="btn btn-default">
				
                            </div>
                        </form>
			
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>