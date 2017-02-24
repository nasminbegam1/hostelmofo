<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
<div class="main">
    <div class="MainCon">
<form action="" method="post" name="frm" id="addcardFrm">
    <div class="listingContent globalClr">
        <div class="targetDiv Cststylng">
            <h3>Add payment Type</h3>
     
    <div class="formFiled globalClr clearfix">
        <?php if(isset($errmsg) && !empty($errmsg)) { echo "<p class='error'>".$errmsg."</p>";} ?>
        <?php if(isset($sucmsg) && !empty($sucmsg)){ echo "<p class='success'>".$sucmsg."</p>";} ?>
        <div class="intFiledDiv hlfsz">
            <label>Card Holder Name</label>
        <input type="text" name="card_name" id="card_name" required>
        </div>
        <div class="intFiledDiv hlfsz mrgof">
             <label>card Number</label>
        <input type="text" name="card_number" id="card_number" required>
        </div>
       
       <div class="intFiledDiv hlfsz mrgof">
            <label>Expiry date</label>
            <select name="exp_month" id="exp_month" style="width: 40%;" required>
                <option value="">Expiry Month*</option>
                <?php for($i=1;$i<=12;$i++){?>
                <option value="<?php echo $i;?>"><?php echo sprintf("%'.02d\n", $i);?></option>
                <?php }?>
            </select>
            <select name="exp_year" id="exp_year" style="width: 40%;" required>
                <option value="">Expiry Year*</option>
                <?php for($i=date('Y');$i<=(date('Y')+12);$i++){?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>

        
         <div class="intFiledDiv hlfsz">
        <input type="hidden" name="action" value="process">
        <input type="submit" name="add_card" value="Add">
         </div>
    </div>
    </div>
    </div>
</form>
    </div>
</div>