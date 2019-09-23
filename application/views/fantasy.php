<!DOCTYPE html>
<html lang="en">
<head>
  <title>Fantasy Poker at Pokersportsleague-Create your Fantasy Team and Win Money Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Play fantasy poker at Pokersportsleague-Create your Fantasy poker team based on your intelligence and win big amount of real money.">
  <meta name="keywords" content="Fantasy poker in India, poker fantasy online, fantasy poker for cash, PSL Fantasy poker"> 
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" /> 
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
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
          <h2>Fantasy</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>

<section class="fantasyPage">
  <div class="container">
  <div class="row">
  <div class="col-xs-12 text-center fantasyPageContent">
  <h3 class="globlegreen globleHeading">HOW TO CREATE YOUR FANTASY TEAM</h3>
  <p class="subTitle">CREATE TEAMS WITH 10 PLAYERS EACH TO CREATE YOUR DREAM TEAM FOR POKER FANTASY LEAGUE AND EARN BIG AMOUNT.</p>
   <p class="paraHeghText">A PARTICIPANT WILL FROM A TEAM OF 10 IN THE FOLLOWING FORMAT:</p>
  <p class="paramidText">EACH TEAM CONSISTS OF 1 MENTOR, 2 PRO PLAYERS, 2 LIVE QUALIFIERS, 3 ONLINE QUALIFIERS &
2 WILD CARDS TO FORM STRONG TEAM TO CREATE YOUR OUSTANDING POKER FANTASY TEAM TO
PARTICIPATE IN POKER FANTASY LEAGUE.</p>
  </div>

  <div class="col-xs-12 text-center">
    <div class="row selectedTeam">
    <div class="col-xs-12 mentorHere">
      <img src="../images/fantasy1.png" alt="">
      <div class="namesAdd"><span>1 MENTOR</span></div>
    </div>
    <div class="col-xs-6 col-sm-3 proHere"><img src="../images/fantasy2.png" alt="">
      <div class="namesAdd">
      <span>2 PRO PLAYERS</span>
    </div>
    </div>
    <div class="col-xs-6 col-sm-3 liveHere"><img src="../images/fantasy3.png" alt="">
      <div class="namesAdd">
      <span>2 LIVE QUALIFIERS</span>
    </div>

    </div>
    <div class="col-xs-6 col-sm-3 onlineHere"><img src="../images/fantasy4.png" alt="">
      <div class="namesAdd">
      <span>3 ONLINE QUALIFIERS</span>
    </div>
    </div>
    <div class="col-xs-6 col-sm-3 wildHere"><img src="../images/fantasy5.png" alt="">
      <div class="namesAdd">
      <span>2 WILD CARDS</span>
    </div>
    </div>
  </div>
<div class="viewBtns">
  <div class="m30 createBtnSec">
  <?php if(isset($owns_team)){
    ?>
    <a class="btn customBtn bgBtn" href="fantasy-poker/preview-team">PREVIEW YOUR TEAM</a>
  <?php }else{
    if($deadline_status){?>
    <a class="btn customBtn bgBtn" <?php if(isset($_SESSION['user_id']) ){?>href="/fantasy-poker/create-your-team" <?php } else { ?> href="/login?create_team=true"<?php }?>>CREATE YOUR TEAM</a>
  <?php
    } else{?>

    <a class="btn customBtn bgBtn deactiveBtn" href="javascript:void(0)">CREATE YOUR TEAM</a>

    <?php }
    } ?>
  </div>
  <div class="leaderboardBtns">
    <a class="btn customBtn midBtn daywise" href="fantasy-poker/day-wise-leaderboard">DAY-WISE LEADERBOARD</a>
  <a class="btn customBtn midBtn cumulative" href="fantasy-poker/cumulative-leaderboard">CUMULATIVE LEADERBOARD</a>
</div>
</div>
  </div>
  </div>
    </div>
</section>
<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

<script>
  
  </script>
</body>
</html>

