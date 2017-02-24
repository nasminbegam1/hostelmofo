<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">
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
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
			<h4 class="panel-title">Add New HomeContent</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
				    <div class="form_sep">
                                <label for="reg_input_name" class="">BANNER MAIN CONTENT</label>
                                <textarea id="wysiwg_editor" name="banner_line"></textarea>
                            </div>
				    <div class="form_sep">
                                <label for="reg_input_name" class="">BANNER SUB CONTENT</label>
                                <textarea id="wysiwg_editor" name="banner_sub_line"></textarea>
                            </div>
				    <div class="form_sep">
                                <label for="reg_input_name" class="">HEADING</label>
                                <textarea id="wysiwg_editor" name="heading_line"></textarea>
                            </div>
				    <div class="form_sep">
                                <label for="reg_input_name" class="">MIDDLE CONTENT</label>
                                <textarea id="wysiwg_editor" name="middle_line"></textarea>
                            </div>
				    <div class="form_sep">
                                <button class="btn btn-default" type="submit">Add</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>