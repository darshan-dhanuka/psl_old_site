<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSL Teams 2017, PokerSportsleague Team in India-All About PSL Teams</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Know more about PSL team in India. PSL teams are made of all kinds of poker players amature to professional poker players and they play against each other.">
  <meta name="keywords" content="PSL team, PSL team Delhi, PSL team India, PSL Bangalore, PSL Mumbai, PSL poker players">
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
</head>
<body>
<?php $this->load->view('header', $homeContent);?>
<section class="subPagebanner">
<div class="">
<div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
        <h2>teams</h2>
    </div>
  </div>
</div>
  </section>
<section class="teamSec">
  <div class="container">
    <div class="row">
      <?php if($team_details) { foreach ($team_details as $team){
//        echo "<pre>";var_dump($team);die;
        ?>
       <div class="col-xs-12 gloglebggray">
        <div class="col-xs-12 col-sm-4">
        <div class="onImgtitle"><img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $team['team_logo'];?>" alt=""></div>
          </div>
        <div class="col-xs-12 col-sm-8 col-md-7">
          
          <h3 class="globleHeading globlegreen"><?php echo $team['team_name'];?></h3>
          <div class="teamDetails row">
          <?php $team_owner=$team['team_owner']; ?>
          <div class="col-xs-4 col-md-2 addDash"><strong>Owner/s</strong></div><div></div>
            <div class="col-xs-8 col-md-10">
              <?php if($team_owner){foreach ($team_owner as $owner_name){?>
              <?php echo $owner_name['name'];
              if($owner_name['company_name']!=""){
                echo " of ".$owner_name['company_name'];
              }
              
              echo"<br>";?>
              <?php }}else {echo "NA";}?>
            </div>
          <div class="col-xs-4 col-md-2 addDash"><strong>Region</strong></div><div class="col-xs-8 col-md-10"><?php echo $team['region_name'];?></div>
          <div class="col-xs-4 col-md-2 addDash"><strong>Mentor</strong></div><div class="col-xs-8 col-md-10"><?php if($team['mentor_name']!="") echo $team['mentor_name']; else echo "NA";?></div>
          </div>
          <?php if($team['meet_the_team']=="1"){?>
         <a class="btn customBtn pull-right" href="<?php echo base_url()."teams/".$team['page_url'];?>">MEET THE TEAM</a>
         <?php }?>
        </div>
      </div>
      <?php }
      }?>
    </div>
  </div>

</section>



<?php $this->load->view('footer', $homeContent);?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

</body>
</html>

