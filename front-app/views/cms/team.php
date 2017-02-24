<div class="detailsPanTop">
  <div class="titleSec globalClr"> <span class="titleName globalClr"><?php echo stripslashes($cms_details['cms_title']); ?></span> </div>
</div>
<div class="teamTopSec globalClr">
<div class="cmsBlock globalClr"> 
  <!--<h5 class="blockTitle globalClr">Description </h5>-->
  <p><?php echo stripslashes($cms_details['cms_content']);?></p>
</div>
</div>
<div class="cmsBlock globalClr">
  <div class="teamPanel globalClr">
    <?php
    $i=1;
    if(is_array($team_details) && count($team_details) > 0)
    {
      foreach($team_details as $team)
      {
        $mem = '';
        if($i%2 == 0)
        {
          $mem = 'rightImg';
        }
        else
        {
          $mem = 'leftImg';
        }
      ?>
       
      <div class="teamPeopleDiv globalClr clearfix member1">
      <div class="teamImg <?php echo $mem ;?>">
        <?php
        if($team['image']!='')
        {
        ?>
          <img src="<?php echo isFileExist(CDN_TEAM_THUMB_IMG.$team['image']);?>" width="400" hight="400">
        <?php
        }
        ?>
        
        <div class="socialMedia globalClr">
          <?php
          if($team['facebook_link'])
          {
          ?>
          <a class="facebook iconbutton" href="<?php echo stripslashes($team['facebook_link']);?>" target="_blank"><i class="fa fa-facebook"></i><span class="iconfacebook"></span></a>
          <?php
          }
          if($team['twitter_link'])
          {
          ?>
          <a class="twitter iconbutton" href="<?php echo stripslashes($team['twitter_link']);?>" target="_blank"><i class="fa fa-twitter"></i><span class="icontwitter"></span></a>
          <?php
          }
          if($team['linkedin_link'])
          {
          ?>
          <a class="linkedin iconbutton" href="<?php echo stripslashes($team['linkedin_link'])?>" target="_blank"><i class="fa fa-linkedin"></i><span class="iconlinkedin"></span></a>
          <?php
          }
          if($team['googleplus_link'])
          {
          ?>
          <a class="googleplus iconbutton" href="<?php echo stripslashes($team['googleplus_link'])?>" target="_blank"><i class="fa fa-google-plus"></i><span class="icongoogleplus"></span></a>
          <?php
          }
          ?>
         
        </div>
      </div>
      <h3><?php echo stripslashes($team['name']);?></h3>
      <h4><?php echo stripslashes($team['designation']);?></h4>
      <p><?php echo stripslashes($team['description']); ?></p>
    </div>
       
       
      <?php
      $i++;
      }
    }
    ?>
    <!--<div class="teamPeopleDiv globalClr clearfix member1">
      <div class="teamImg leftImg"><img alt="img" src="<?php echo FRONT_IMAGE_PATH;?>user-icon-n.jpg">
        <div class="socialMedia globalClr"><a class="facebook iconbutton" href="#" target="_blank"><i class="fa fa-facebook"></i><span class="iconfacebook"></span></a> <a class="twitter iconbutton" href="#" target="_blank"><i class="fa fa-twitter"></i><span class="icontwitter"></span></a> <a class="linkedin iconbutton" href="#" target="_blank"><i class="fa fa-linkedin"></i><span class="iconlinkedin"></span></a> <a class="googleplus iconbutton" href="#" target="_blank"><i class="fa fa-google-plus"></i><span class="icongoogleplus"></span></a></div>
      </div>
      <h3>Steve Piper</h3>
      <h4>Managing Director</h4>
      <p> Steve started the business back in 2001 from his home in Essex before moving down to sunny Southsea in 2007. By day, he’s here in the Si studio, focusing his time on developing and growing the agency, by night he’s a cooking addict, doting husband and father of two. Steve’s a fully fledged triathlete, with several under his belt now. </p>
    </div>-->
<!--    <div class="teamPeopleDiv globalClr clearfix member2">
      <div class="teamImg rightImg"><img alt="img" src="<?php //echo FRONT_IMAGE_PATH;?>user-icon-n.jpg">
        <div class="socialMedia globalClr"><a class="facebook iconbutton" href="#" target="_blank"><i class="fa fa-facebook"></i><span class="iconfacebook"></span></a> <a class="twitter iconbutton" href="#" target="_blank"><i class="fa fa-twitter"></i><span class="icontwitter"></span></a> <a class="linkedin iconbutton" href="#" target="_blank"><i class="fa fa-linkedin"></i><span class="iconlinkedin"></span></a> <a class="googleplus iconbutton" href="#" target="_blank"><i class="fa fa-google-plus"></i><span class="icongoogleplus"></span></a></div>
      </div>
      <h3>Steve Piper</h3>
      <h4>Managing Director</h4>
      <p> Steve started the business back in 2001 from his home in Essex before moving down to sunny Southsea in 2007. By day, he’s here in the Si studio, focusing his time on developing and growing the agency, by night he’s a cooking addict, doting husband and father of two. Steve’s a fully fledged triathlete, with several under his belt now. </p>
    </div>-->
  </div>
</div>
