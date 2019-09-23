<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register at PokerSportsleague and Participate in Wonderful Poker League India 2017</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Register yourself at PokerSportsleague and participate in wonderful Poker League India 2017 and get a chance to win big amount of Money.">
  <meta name="keywords" content="Register at Pokersportsleague, how to register for PSL 2017, PSL Poker 2017, Register for PSL Game, Register for PSL Tournament, PSL registration 2017, How I become PSL player"> 
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" /> 
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
  <style>#registrationBanner{background: url(/images/Banner-Registration.jpg) no-repeat center top / 100% 100%;}
@media only screen and (max-width: 640px){
#registrationBanner{ background: url(/images/Banner-Registration-mobile.jpg) no-repeat center top / 100% 100%;}
}
  </style>
 </head>
<body>
<?php $this->load->view('header', $homeContent);?>
<section class="subPagebanner">
<div class="">
  <div class="item">
    <div id="registrationBanner" class="imgSlider">
    <div class="container spclftAlgn">
<!--     <div class="bannerMidSec">
          <h2>Registration</h2>
    </div>-->
    </div>
    </div>
  </div>
</div>
  </section>
<form action="" method="POST">
<section class="registrationSec">
  <div class="container">
    <div class="row">
      <div class="txtfield col-xs-12">
        <input type="text" name="username" placeholder="Username *" value="<?php echo set_value('username');?>">
        <?php echo form_error('username')?form_error('username'):''; ?>
      </div>
      <div class="txtfield col-xs-12">
        <input type="password" name="password" placeholder="Password *" value="<?php echo set_value('password');?>">
        <?php echo form_error('password')?form_error('password'):''; ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
        <input type="text" name="first_name" placeholder="First name *" value="<?php echo set_value('first_name');?>">
        <?php echo form_error('first_name'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
        <input type="text" name="last_name" placeholder="Last name *" value="<?php echo set_value('last_name');?>">
        <?php echo form_error('last_name'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
         <select name="gender">
          <option value="">Gender *</option>
          <option value="male" <?php if($this->input->post('gender') == 'male'){echo 'selected';}?>>Male</option>
          <option value="female" <?php if($this->input->post('gender') == 'female'){echo 'selected';}?>>Female</option>

        </select>
        <?php echo form_error('gender'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
        <input type="text" id="datepicker" name="dob" placeholder="Date of Birth *" readonly="" value="<?php echo set_value('dob');?>">
        <?php echo form_error('dob'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
        <input type="text" name="email" placeholder="Email *" value="<?php echo set_value('email');?>">
        <?php echo form_error('email'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
        <input type="text" name="mobile" placeholder="Mobile * (to be verified)" value="<?php echo set_value('mobile');?>">
        <?php echo form_error('mobile'); ?>
      </div>
      <div class="txtfield col-xs-12">
        <input type="text" name="address1" placeholder="Address line 1 *" value="<?php echo set_value('address1');?>">
        <?php echo form_error('address1'); ?>
      </div>
      <div class="txtfield col-xs-12">
        <input type="text" name="address2" placeholder="Address line 2 (optional)" value="<?php echo set_value('address2');?>">
        <?php echo form_error('address2'); ?>
      </div>

      <div class="txtfield col-xs-12 col-sm-6">
      <select id="listBox" name="state" onchange='selct_district(this.value)'></select>
        <?php echo form_error('state'); ?>
        </div>

      <div class="txtfield col-xs-12 col-sm-6">
      <select id='secondlist' name="city"><option value="">Select city *</option></select>
        <?php echo form_error('city'); ?>
      </div>
      <input type="hidden" name="verify" value = '1'>
      <div class="txtfield col-xs-12 col-sm-6 trmcndmiddle">
        <input type="checkbox" name="terms">
        <span>I agree to the Terms of Use &amp; I am above 21 years </span>
        <?php echo form_error('terms'); ?>
      </div>
      <div class="txtfield col-xs-12 col-sm-6">
       <button type="submit" class="btn customBtn">Register</button>
      </div>
    </div>
    </div>
</section>
</form>
<?php $this->load->view('footer', $homeContent);?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/jquery-ui.min.js"></script>
<script src="<?php echo JS_PATH?>/state.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

<script>
  $(document).ready(function() {

  var offset = $( '#datepicker' ).offset();
  var gtwidth=$( '#ui-datepicker-div' ).width()
    $("#datepicker").datepicker({
      maxDate: new Date(),
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd M yy",
      yearRange:"c-100:c",
      beforeShow: function(input, inst)
    {
        var gtwidth=$( '#ui-datepicker-div' ).width()

        setTimeout(function () {
          if($(window).width() > 1199){
            inst.dpDiv.css({
                left: offset.left + 220
            });
          }
            if($(window).width() < 1200){
              inst.dpDiv.css({
                left: offset.left + 120
            });
            }
            if($(window).width() < 993){
              inst.dpDiv.css({
                left: offset.left
            });
            }
        }, 0);
    }
    });

 });
  </script>

</body>
</html>
