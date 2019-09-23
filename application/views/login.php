<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login at PokerSportsLeague and Participate in Exciting Poker League India</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Login at PokerSportLeague to participate in PSL 2017 to win good amount of real money.">
  <meta name="keywords" content="Login at Pokersportsleage, Login for PSL 2017, Poker league in India, PSL login , how to login at PSL, how to become PSL player"> 
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" /> 
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
   <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
</head>
<body>
<?php $this->load->view('header', $homeContent);?>
<section class="subPagebanner">
<div class="">
  <div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2>user login</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<form action="" method="POST">
<section class="userLog">
  <div class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-6 nofloat">
      <div class="txtfield">
        <input type="text" name="username" placeholder="Username / Email" required>

      </div>
      <div class="txtfield">
        <input type="password" name="password" placeholder="Password" required>
        <?php echo $error;?>
      </div>
 <button type="submit"1 class="btn customBtn" href="javascript:;">Login </button>
 <div class="row relatedPass">
 <div class="col-xs-6"><a class="" href="/forgot-password">Forgot Password?</a></div>
 <div class="col-xs-6"><a class="" href="/register">not a member yet?</a></div>
 </div>
    </div>
    </div>
    </div>
</section>
</form>
<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
</body>
</html>

