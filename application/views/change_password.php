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
<?php $this->load->view('header');?>
<section class="subPagebanner">
<div class="">
  <div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2>Change password</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<form action="" method="POST">
<section class="userLog">
  <div class="container" id="change_password">
    <div class="row">
    <div class="col-xs-12 col-sm-6 nofloat">
      <div class="txtfield">
        <?php echo isset($_GET['msg'])?$_GET['msg']:'';?>
        <input type="password" name="current_password" placeholder="Current Password" required>
        <?php echo form_error('current_password'); ?>
      </div>
      <div class="txtfield">
        <input type="password" name="new_password" placeholder="New Password" required>
        <?php echo form_error('new_password'); ?>
      </div>
      <div class="txtfield">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <?php echo form_error('confirm_password'); ?>
      </div>
 <button type="submit" class="btn customBtn" href="javascript:;" onclick="checkPassword()">Change Password </button>
 <div class="row relatedPass">
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
<script type="text/javascript">
  // function checkPassword(){
  //   if($( "input[name='new_password']" ).val() == $( "input[name='new_password']" ).val()){

  //   }
  // }
</script>