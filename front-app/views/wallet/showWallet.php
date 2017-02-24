<?php
    $currencySymbol = $this->nsession->userdata('currencySymbol');
    $currencyRate 	= $this->nsession->userdata('currencyRate');
?>
<div class="popupLoader" id="listLoading"><img src="<?php echo FRONT_IMAGE_PATH;  ?>bx_loader.gif" /></div>
<div class="main">
    <div class="MainCon">
        <div class="abtPan clearfix">
<div class="detailsPanTop">
    <div class="listingContent globalClr"> <span class="lsitingTitle globalClr">Wallet Balance: 
        <?php if($currencySymbol!=''){echo $currencySymbol; }else{ echo '$'; } ?> <?php echo $wallet_balance; ?></span> 
    </div>
</div>
</div>
    </div>
</div>