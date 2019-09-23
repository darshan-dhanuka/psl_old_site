<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Leaderboard of Pokersportsleague.com, All about PSL Online Leaderboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Know all about Online leaderboard of PokerSportsleague.com, know your ranking on Online leaderboard.">
  <meta name="keywords" content="online leaderboard on PSL, PSL online leaderboard, what my rank on online PSL leaderboard, Poker leage online leaderboard">
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
          <h2>Online Leaderboard</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="online-board">
  <div class="container">
    <div class="row text-center">
   <div class="col-xs-12">
 <h3 class="globlegreen">Keep track of the leaderboard to make sure you keep up with the competition. The username listed below is Adda52 username.</h3></div>
   <div class="clr"></div>
   <div class="col-xs-12 col-sm-8 col-md-6 mrtp-30 nofloat">
    <table class="table">
    <thead>
      <tr>
        <th class="text-center"><span>Rank</span></th>
        <th class="text-center"><span>Adda52 Username</span></th>
        <th class="text-center"><span>Leaderboard Points</span></th>
      </tr>
    </thead>
   <tbody id='content_target'>
           
    </tbody>
  </table>

   </div>
   <div class="col-xs-12">
   <button class="customBtn btn inactive" id="prev" onclick="updatePrev()">Prev</button>
   <div class="paginationBtn">
     <ul id="target_pag_num">
       <li onclick="update()">1</li>
       <li onclick="update()">2</li>
       <li onclick="update()">3</li>
     </ul>
   </div>
   <button class="customBtn btn active" id="next" onclick="updateNext()">Next</button>
   </div>
   </div>
   </div>
</section>



<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script type="text/javascript">
var count=10; //number of list to be shown
var start =0; // starting point of list
var result = []; // all data in json
var limit = 0; // total number of data
var current_num = 1; //current page number
var page_number= 0; // number of page button
var pagination_limit = 10; //number of page button limit
var target_pag_num = $('#target_pag_num'); //target where to keep page numbers
var content_target = $('#content_target'); //target where to keep list
var prev_btn = $('#prev'); //target previous button
var next_btn = $('#next'); //target next button

function updateBtnColor(){
  //updates the button color for next and previous
  var checkinglimit = start + count;
  if((start - count) >= 0){
    prev_btn.removeClass('inactive').addClass('active');
  }else{
    prev_btn.removeClass('active').addClass('inactive');
  } 

  if(checkinglimit >= limit){
    next_btn.removeClass('active').addClass('inactive');
  }else{
    next_btn.removeClass('inactive').addClass('active');
  }
}

function updateNext(){
  //when user click on next button
  var checkinglimit = start + count;
  if(checkinglimit > limit){
    return;
  }

  if(!(checkinglimit >= limit))
    start += count;

  if(current_num < page_number)
    current_num++;
  updateBtnColor();
  updateList();
}

function updatePrev(){
  //when user click on previous button
  if( (start - count) < 0){
    return;
  }
  start -= parseInt(count);
  
  if(current_num > 1)
    current_num--;
  updateBtnColor();
  updateList();
}

function update(number){
  //when user click on page number button
  start = (number * count) - count;
  current_num = number;
  updateBtnColor();
  updateList();
}

function updateList(){
  //update lists 
  var str , page_number_str ='';
   for(i = start ; i < count + start; i++ ){

      if(typeof result[i] != 'undefined')
      str += "<tr><td><span>" + result[i].rank + "</span></td><td><span>" + result[i].user_name + "</span></td><td><span>" + result[i].points + "</span></td></tr>" ;
    }
    content_target.html(str);
     if($(window).width()<992){
      var gttdval1=$('.table thead tr th').length;
      for(var i=1; i<= gttdval1; i++){
        $('.table tbody tr td:nth-child('+i+')').prepend('<span class="dptadded">'+ $(".table thead tr th:nth-child("+i+")").text() +'</span>');
      }
    }
    if(limit%count){
      page_number = limit/count;
      ++page_number;
      page_number = Math.floor(page_number);
    }else{
      page_number = limit/count;
    }
    //update page numbers
    if( (current_num + 5 ) > page_number && (page_number > 11)){

      for(var i = page_number - 10, j = 0 ; i <= page_number; i++ , j++){
        page_number_str += '<li onclick="update(' + i + ')" ';
        if(current_num == i)
          page_number_str += 'class="active"'
        page_number_str += '>' + i + '</li>';
      }

    }else if(current_num > 5 && (page_number > 11)){
      for(var i = current_num - 5, j = 0 ; j < 11; i++ , j++){
        page_number_str += '<li onclick="update(' + i + ')" ';
        if(current_num == i)
          page_number_str += 'class="active"'
        page_number_str += '>' + i + '</li>';
      }

    }else{
      //for(var i = 1; i <= page_number; i++){
      var loop = (page_number > 11) ? 11 : page_number;
      for(var i = 1, j = 0 ; j < loop; i++ , j++){
        page_number_str += '<li onclick="update(' + i + ')" ';
        if(current_num == i)
          page_number_str += 'class="active"'
        page_number_str += '>' + i + '</li>';
      }
    }

    target_pag_num.html(page_number_str);
}

(function(){
  var d = new Date();
  var y = 2018;
  $.post('https://m.adda52.com:3333/getLeaderBoardJson/' , {user_id : 13767 , tourney : "tourney:PSL_" + y , limit : 800} )
//  var y = d.getFullYear();
  //$.post('https://m.adda52.com:3333/getLeaderBoardJson/' , {user_id : 13767 , tourney : "PSL_" + y , limit : 800} )
  .done(function(res){
    result = res.topTen;
    limit = res.topTen.length;
    updateList();
  })
  .fail(function(res){
    console.log('failed', res);
  })
})();

</script>
</body>
</html>

