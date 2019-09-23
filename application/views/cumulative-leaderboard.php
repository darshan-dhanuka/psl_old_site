<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cumulative Leaderboard of Poker Fantasy Teams at Pokersportsleague.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Know the comulative leaderboard points of poker fantasy teams at Pokersportsleague.com.">
  <meta name="keywords" content="Comulative Leaderboard points in fantasy poker, fantasy poker to win, PSL fantasy poker"> 
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
  <div class="col-xs-12 col-sm-10 col-md-9 mrtp-30 nofloat" id="cumulativeLeaderboard">
  <div class="teamtable text-center">
    <h3 class="">CUMULATIVE LEADERBOARD</h3>
    <div class="tableSec">
    <table class="table">
    <thead>
      <tr>
        <th><span>Rank</span></th>
        <th><span>User</span></th>
        <th><span>Team Name</span></th>
        <th><span>Points</span></th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $i=1;
    if(sizeof($leader_data)>0){
    foreach($leader_data as $row){
    	?>
      <tr>
        <td><span><?php echo $i; $i++;?></span></td>
        <td><span><?php echo $row['user_name'];?></span></td>
        <td><span><?php echo $row['team_name'];?></span></td>
        <td><span><?php echo $row['score'];?></span></td>
      </tr>
      <?php 
    }
   	}?>
    </tbody>
  </table>
</div>
  </div>
</div>
  </div>
    </div>
    <?php if($this->session->userdata('username'))
{
  if (sizeof ( $leader_data ) > 0)
  {
    $k=0;
    foreach ( $leader_data as $user )
    {
      $k++;
      if ($this->session->userdata ( 'username' ) && $this->session->userdata ( 'username' ) == $user['user_name'])
      {
        ?>
    <div class="userTable container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-md-9 nofloat">
            <div class="setspan"><span>Rank:</span><span><?php echo $k;?></span></div>
            <div class="setspan"><span>User:</span><span><?php echo $user['user_name'];?></span></div>
            <div class="setspan"><span>Team Name:</span><span><?php echo $user['team_name']?></span></div>
            <div class="setspan"><span>Points:</span><span><?php echo $user['score'];?></span></div>
          </div>
        </div>
      </div>
    </div>
      <?php
        break;
      }
    }
  }
}
  ?>

</section>

<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

<script>
if($(window).width()<992){
  var gttdval1=$('#cumulativeLeaderboard .table thead tr th').length;
  for(var i=1; i<= gttdval1; i++){
    $('#cumulativeLeaderboard .table tbody tr td:nth-child('+i+')').prepend('<span class="dptadded">'+ $(".table thead tr th:nth-child("+i+")").text() +'</span>');

  }
}

$(window).scroll(function(){
var tbl = $( ".teamtable:last" );
var offset = tbl.offset();
var foot = $( ".footerNav:last" );
var offset2 = foot.offset();

  if($(window).scrollTop() >= offset.top - $(window).height() + 50 && $(window).scrollTop() <= offset2.top  - $(window).height()){
    $('.userTable').css({'position':'fixed'})
  }else{ $('.userTable').css({'position':'absolute'})}
})
  </script>
</body>
</html>

