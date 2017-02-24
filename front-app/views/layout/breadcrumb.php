<div class="breadCamp globalClr">
    <ul>
      <li><a href="">Home<em class="fa fa-angle-double-right"></em></a></li>
      <!--<li><a href="">Australia Accommodation<em class="fa fa-angle-double-right"></em></a></li> -->
      <?php 
        if(is_array($breadcrumb) and count($breadcrumb)>0 ){
            foreach($breadcrumb as $index=>$brd){ ?>
                  <li>
                    <?php if($brd['link']!=''){ ?>
                        <a href="<?php echo $brd['link'] ?>">
                    <?php } ?>
                    <?php echo $brd['text']; ?> Accommodation
                  <?php if($index!= end(array_keys($breadcrumb))){ ?>
                  <em class="fa fa-angle-double-right"></em>
                  <?php } ?>
                  <?php if($brd['link']!=''){ ?>
                    </a>
                  <?php } ?>
                  </li>
        <?php    }
        } 
      ?>
      
     
   <!--   <li>Sydney Accommodation</li>-->
    </ul>
</div>