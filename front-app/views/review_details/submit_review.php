<div class="main">
    <div class="MainCon">
<form action="" method="post" name="frm" id="profileFrm">
    <div class="listingContent globalClr">
        <div class="targetDiv Cststylng">
            <h3>Give Review</h3>
     
    <div class="formFiled globalClr clearfix">
        <?php if(isset($errmsg) && !empty($errmsg)) { echo "<p class='error'>".$errmsg."</p>";} ?>
        <?php if(isset($sucmsg) && !empty($sucmsg)){ echo "<p class='success'>".$sucmsg."</p>";} ?>
       
	    <div class="intFiledDiv hlfsz">
            <label>Staff</label>
       <select name="staff" id="stuff">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Facilities</label>
       <select name="facilities" id="facilities">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Cleanliness</label>
       <select name="cleanliness" id="cleanliness">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Location</label>
       <select name="location" id="location">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Security</label>
       <select name="security">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Atmosphere</label>
       <select name="atmosphere" id="atmosphere">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>
		
		<div class="intFiledDiv hlfsz">
            <label>Value for Money</label>
       <select name="value_for_money" id="value_for_money">
			<?php foreach($ratting_array as $k => $ratting){?>
			<option value="<?php echo $k;?>"><?php echo $ratting;?></option>
			<?php }?>
		</select>
        </div>

		<div class="intFiledDiv hlfsz">
            <label>Email</label>
       <input type="text" name="email" id="email" required="required">
        </div>

        <div class="intFiledDiv fulsz">
             <label>Comment</label>
            <textarea name="comments" required></textarea>
        </div>
        
         <div class="intFiledDiv hlfsz">
        <input type="hidden" name="action" value="Process">
        <input type="submit" name="submit_review" value="Submit">
         </div>
    </div>
    </div>
    </div>
</form>
    </div>
</div>

