<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sitemap of Pokersportsleague.com, PSL Sitemap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Go through Sitemap of Pokersportsleague.com, know the complete structure of PSL website">
  <meta name="keywords" content="PSL sitemap, Sitemap of PSL website">
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
          <h2>Sitemap</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="sitemap">
  <div class="container">
    <div class="row text-center">
   <div class="col-xs-5 col-sm-4 nofloatblock text-left">
   <ul>
      <li><a href="/" class="globlegreen">Poker Sports League</a>
        <ul>
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Register</a></li>
        </ul>
      </li>
       <li><a href="/about-psl" class="globlegreen">About PSL</a>
        <ul>
          <li><a href="/about-psl">The Concept</a></li>
          <li><a href="/team-structure">Team Structure</a></li>
        </ul>
      </li>
      <li><a href="/drafts" class="globlegreen">Drafts</a>
        <ul>
          <li><a href="/drafts/pro-player">Pro Player</a></li>
          <li><a href="/drafts/live-qualifier">Live Qualifier</a></li>
          <li><a href="/drafts/online-qualifier">Online Qualifier</a></li>
        </ul>
      </li>
      <li><a href="/player-application" class="globlegreen">Player Application</a>
        <ul>
          <li><a href="/pro-player-registration">Pro Player Application</a></li>
          <li><a href="/schedule/live-qualifier">Live Schedule</a></li>
          <li><a href="/schedule/online-qualifier">Online Schedule</a></li>
        </ul>
      </li>
      <li><a href="/#mentor" class="globlegreen">Mentors</a>
      </li>
      <li><a href="/teams" class="globlegreen">Teams</a>
        <ul>
          <li><a href="/teams/bengaluru-jokers">Bengaluru Jokers</a></li>
          <li><a href="/teams/chennai-bulls">Chennai Bulls</a></li>
          <li><a href="/teams/delhi-panthers">Delhi Panthers</a></li>
          <li><a href="/teams/goan-nuts">Goan Nuts</a></li>
          <li><a href="/teams/gujarat-acers">Gujarat Acers</a></li>
          <li><a href="/teams/haryana-hunters">Haryana Hunters</a></li>
          <li><a href="/teams/kings-hyderabad">Kings Hyderabad</a></li>
          <li><a href="/teams/kolkata-royals">Kolkata Royals</a></li>
          <li><a href="/teams/mumbai-anchors">Mumbai Anchors</a></li>
          <li><a href="/teams/pune-sharks">Pune Sharks</a></li>
          <li><a href="/teams/punjab-bluffers">Punjab Bluffers</a></li>
          <li><a href="/teams/rajasthan-tilters">Rajasthan Tilters</a></li>
        </ul>
      </li>
      <li><a href="/about-us" class="globlegreen">About Us</a></li>
      </ul>
      </div>
        <div class="col-xs-5 col-sm-4 nofloatblock text-left">
        <ul>
        <li><a href="javascript::" class="globlegreen">Leaderboard</a>
        <ul>
          <li><a href="/leaderboard/live">Live Leaderboard</a></li>
          <li><a href="/leaderboard/online">Online Leaderboard</a></li>
          </ul>
          </li>
        <li>
        <a href="javascript:;" class="globlegreen">Schedule</a>
        <ul>
          <li><a href="/schedule/live-qualifier">Live Schedule</a></li>
          <li><a href="/schedule/online-qualifier">Online Schedule</a></li>
        </ul>
      </li>
      <li><a href="/rules" class="globlegreen">Rules</a>
        <ul>
          <li><a href="/rules">Team Owner</a></li>
          <li><a href="/rules">Team Mentor</a></li>
          <li><a href="/rules">Pro Player</a></li>
          <li><a href="/rules">Pro Player Application</a></li>
          <li><a href="/rules">Live Qualifiers</a></li>
          <li><a href="/rules">Online Qualifiers</a></li>
          <li><a href="/rules">Wild Card</a></li>
        </ul>
      </li>
      <li><a href="/faqs" class="globlegreen">FAQs</a>
        <ul>
          <li><a href="/faqs">Getting Started</a></li>
          <li><a href="/faqs">Team Selection</a></li>
          <li><a href="/faqs">Pro Selection</a></li>
          <li><a href="/faqs">Live and Online Qualifiers</a></li>
          <li><a href="/faqs">Finale</a></li>
        </ul>
      </li>
      <li><a href="/blog" class="globlegreen">Blog</a></li>
      <li><a href="/tandc" class="globlegreen">T&C</a></li>
      <li><a href="/privacy-policy" class="globlegreen">Privacy Policy</a></li>
      <li><a href="/code-of-conduct" class="globlegreen">Code of Conduct</a></li>
      <li><a href="/contact-us" class="globlegreen">Contact Us</a></li>
    </ul>
    </div>
   </div>
   </div>
</section>



<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script>
  $(function(){
$(".selectopt select").val($(".selectopt select option:first").val());
    $('.selectopt select').change(function(){
      var gtId=$(this).children('option:selected').attr('id');
      $('.listRow').hide();
      $('.'+gtId).show();
    })
  })
</script>
</body>
</html>

