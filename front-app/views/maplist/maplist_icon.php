<div class="proListTop">
   <a class="proimg" href="<?php echo $property_url ;?>">
      <img id="msimg-<?php echo $property_id; ?>" src="<?php echo $img_name; ?>" alt="pro-img" />
   </a>
   <div class="imgSliderCont">
      <span id="msloader-<?php echo $property_id; ?>" class="imgSlideLoader"></span>
      <a class="prev" href="javascript:void(0);" data-item="0" rel="<?php echo $property_id; ?>"></a>
      <a class="next" href="javascript:void(0);" data-item="0" rel="<?php echo $property_id; ?>"></a>
   </div>
   <div class="proPrice">
      <?php echo $currencySymbol; ?> <?php echo ceil($property_price); ?>
   </div>
</div>
<div class="proDtls">
   <h6><a href="<?php echo $property_url ;?>"><?php echo $property_name ;?></a></h6>
   <p><?php echo $description ; ?></p>
</div>