<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
 
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php $this->load->view('header', $homeContent);?>
<section class="subPagebanner">
<div class="">
<div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h3 class="currentpageName"></h3>
          <h2>otp</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="contentHereSpace"></section>
<form action="" method="POST">
    <section class="userLog">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 nofloat">
                    <?php echo $msg;?>
                    <div class="txtfield">
                        <input type="number" name="otp" placeholder="Enter the OTP sent on your mobile" required>
                    </div>
                    <button type="submit"1 class="btn customBtn" href="javascript:;">Submit </button>
                    <div class="row relatedPass">
                        <div class="col-xs-6"><a class="" href="/resend-otp">Resend Otp</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php $this->load->view('footer', $homeContent);?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script>
  $(document).ready(function() {

var currurl = window.location.pathname;
var index = currurl.lastIndexOf("/") + 1;
var filename = currurl.substr(index);
$('.currentpageName').text(filename.replace(/\-/g, " "));

var gtHeight=$(window).height();
var gtBannerHeight=$('.subPagebanner').height();
var gtFooterHeight=$('footer').height();
$('.contentHereSpace').css({'height':gtHeight - gtBannerHeight - gtFooterHeight +'px', 'padding': '0'})
  })

  </script>
</body>
</html>

