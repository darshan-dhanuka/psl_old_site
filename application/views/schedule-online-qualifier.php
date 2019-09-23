<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Qualifier Schedule on Pokersportsleague.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Know the complete details of Online Qualifier Schedule on Pokersportsleague.com">
    <meta name="keywords" content="PSL Online Qualifier Schedule, PSL Qualifier Schedule 2017,  latest update on PSL Schedule">
    <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
</head>
<body>
<?php $this->load->view('header');?>
<section class="subPagebanner">
<div class="">
<div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2><span>SCHEDULE FOR</span><br>
          ONLINE QUALIFIER</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="sch-onQua">
  <div class="container">
    <div class="row text-center">
   <div class="col-xs-12">
 <h3 class="globlegreen">Here is the online schedule for the Online Qualifier which will take place on Adda52.com.</h3>
  <p class="fntbold">Here are a few things to remember when playing these satellites</p>
  <p>Please make sure that you login to the site and click the ‘Play Qualifier’ button at the bottom which will take you to Adda52 website </p>
  <p>In case you don’t have an account on Adda52.com, please make one. </p>
  <p>You can login to the page via your previous Adda52 account as well and select the ‘Claim Ticket’ button.</p>
  <p>Once you register/login, you will be given 24 tickets to play from any of the 72 qualifiers which will be running till 25th March.</p>
  <p>It is not necessary that your Adda52 username and your PSL username be the same. </p>
  <p>Please note that your mobile number needs to be verified before you can play online satellites</p>
   </div>
   <div class="clr"></div>
   <div class="col-xs-12 col-md-10 mrtp-30 nofloat">
    <table class="table">
    <thead>
      <tr>
        <th class="text-center"><span>Tournament Name</span></th>
        <th class="text-center"><span>Date</span></th>
        <th class="text-center"><span>Time</span></th>
        <th class="text-center"><span>Entry Criteria</span></th>
        <th class="text-center"><span>Winnings</span></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$result){echo 'no data found';}
      else{
          foreach($result as $row){?>
      <tr>
        <td><span><?php echo $row['tourney_name'];?></span></td>
        <td><span><?php echo $row['date'];?></span></td>
        <td><span><?php echo $row['time'];?></span></td>
        <td><span><?php echo $row['entry_criteria'];?></span></td>
        <td><span><?php echo $row['winnings'];?></span></td>
      </tr>
      <?php }}?>
    </tbody>
  </table>

   </div>
   <?php if ($this->session->checkLogin() == FALSE) { ?>
   <div><strong>Please Login Before You Play Qualifier</strong></div>
   <?php }else{ ?>
   <a class="btn customBtn" href="https://www.adda52.com/PokerSportsLeague" target="_blank">PLAY QUALIFIER</a>
   <?php } ?>
   </div>
   </div>
</section>

<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
</body>
</html>
