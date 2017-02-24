<?php //pr($currencyInfo,0); ?>
<div class="suggestedCurrency allCurrencyList">
  <h5>Suggested Currencies</h5>
  <ul>
    <?php
    $index='';
    if($this->nsession->userdata('currencyCode') != ''){
	  $index = $this->nsession->userdata('currencyCode');
	  $currency_name = $this->nsession->userdata('currency_name');
    }else{
	  $index = 'AUD';
	  $currency_name = 'Australian Dollar';
    }
    ?>
    <li class="active"><a onclick="country_name_change('<?php echo $index; ?>');"><span><?php echo $index; ?></span><?php echo $currency_name; ?></a></li>
  </ul>
  </div>
</div>
<div class="allCurrency allCurrencyList">
  <h5>All Currencies</h5>
  <div class="allCurrencyInn">
    <ul>
	  <?php if(is_array($currency) and count($currency)>0){ ?>
	  <?php foreach($currency as $c){ ?>
	  <li><a onclick="country_name_change('<?php echo $c['country_code']; ?>');"><span><?php echo $c['currency_code']; ?></span><?php echo stripslashes($c['currency_name']); ?> </a></li>
	  <?php } ?>
	  <?php } ?>     
    </ul>
  </div>
</div>