<!DOCTYPE html>
<html lang="en">
<head>
  <title>PSL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <h3 class="currentpageName"></h3>
          <h2>Coming Soon</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="contentHereSpace"></section>
<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
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

