<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <h2>Forgot password</h2>
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
        <?php echo isset($msg)?$msg:'';?>
        <input type="text" name="email" placeholder="Email" required>
      </div>
 <button type="submit"1 class="btn customBtn" href="javascript:;">Forgot Password </button>
 <div class="row relatedPass">
 <div class="col-xs-6"><a class="" href="/login">Login?</a></div>
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