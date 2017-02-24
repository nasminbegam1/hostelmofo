<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	
        <div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add New Property Type</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="main" enctype="multipart/form-data" id="parsley_reg">
			    <input type="hidden" name="action" value="Process">
			    
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Select Property Record Type</label>
				<input type="radio" name="record_type" id="" value="rental" class="required">Rental&nbsp;
				<input type="radio" name="record_type" id="" value="sales" class="required">Sales
                            </div>
                            <div class="form_sep">
                                <button class="btn btn-default" type="submit">Next</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
                            </div>
                            

						</form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>