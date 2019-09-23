<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?php echo $homeContent['seo_title']?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo $homeContent['seo_meta']?>
  <?php if($homeContent['favicon'] <> ''){?>
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/<?php echo $homeContent['favicon']?>">
  <?php }?>

  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
   <?php if(isset($banner)){?>
  <style>
    <?php $i=1;$j=1;
    foreach ($banner as $banner2) {
      ?>#imgSlider<?php echo $i++;
      ?> {
        background: url(<?php echo BANNER_DATA_PATH.$banner2['banner_website'];?>) no-repeat center top / auto 100%;
      }
      @media only screen and (max-width: 640px) {
        #imgSlider<?php echo $j++;
        ?> {
          background: url(<?php echo BANNER_DATA_PATH.$banner2['banner_mobile'];?>) no-repeat center top / 100% auto;
        }
      }
      <?php
    }

    ?>
    
  </style>
  <?php }?>
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
  <?php echo $contents;?>
<?php $this->load->view('footer', $homeContent);?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

<script>
// index 0->mentor,1->pro,2->live qualifier,3->online,4-wildcard
//var team_data = [[],[],[],[],[]];
<?php if(isset($mentor_data)){
  ?>
  var mentor_data = [<?php echo $mentor_data ?>];
  var pro_data = [<?php echo $pro_data ?>];
  var lq_data = [<?php echo $lq_data ?>];
  var oq_data = [<?php echo $oq_data ?>];
  var wildcard_data = [<?php echo $wildcard_data ?>]; 
 var old_player = mentor_data.concat(pro_data,lq_data,oq_data,wildcard_data);
 var new_player = [];
  var fantasy_page = 'preview_page';
  <?php
}
else
{
  ?>
  var mentor_data = [];
var pro_data = [];
var lq_data = [];
var oq_data = [];
var wildcard_data = [];
var fantasy_page = '';
<?php
}
?>

  $(document).ready(function() {
    if(fantasy_page=='preview_page')
    {
      $('#submitTeam').addClass('dontSubmit');
      $('#selectedTeam').bind("DOMSubtreeModified",function(){
        new_player = [];
        new_player = mentor_data.concat(pro_data,lq_data,oq_data,wildcard_data);
       //alert(old_player.length)
       // alert(new_player.length)
        if(old_player.length==new_player.length && old_player.sort().toString()!=new_player.sort().toString())
        {
          $('#submitTeam').removeClass('dontSubmit');
        }
      });
    }
$('.clTab').click(function(){
      $(this).parent().siblings('li').children('.clTab').removeClass('active')
      $(this).addClass('active');
      var gtIds = $(this).attr('id');
      $('.fantasyPlayers').removeClass('active');
      $('.' + gtIds).addClass('active');

    })

    $('.mentorList .selectVal').click(function(){
      var that = $(this);
      player_id = $(this).attr('player_id');
      mentor_data.pop();
      if(mentor_data.length < 1 && mentor_data.indexOf(player_id) == -1)
      {
        mentor_data.push(player_id);
      }
      var proPName = $(this).parent().siblings('td:first-child').text();
      $(this).parent().parent().siblings().removeClass('active');
      $(this).parent().parent().addClass('active');
       $('.mentorHere .namesAdd').html('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      $('#mentorList .addNum').text('1');
    })
  

    $('.mentorList .removeVal').click(function(){
      player_id = $(this).attr('player_id');
      $(this).parent().parent().removeClass('active');

      player_index = mentor_data.indexOf(player_id);

      mentor_data.splice(player_index,1);

      $('#mentorList .addNum').text('0');
      $('.mentorHere .namesAdd').html('1 MENTOR');
    })

    /** js pro player starts here **/

    $('.proList .selectVal').click(function(){
      if(pro_data.length < 2){
      var proPName = $(this).parent().siblings('td:first-child').text();
      $(this).parent().parent().addClass('active');
        player_id = $(this).attr('player_id');
        pro_data.push(player_id);
      if(pro_data.length < 2){
        $('.proHere .namesAdd').html('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }else{
        $('.proHere .namesAdd').append('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }
      $('#proList .addNum').text(pro_data.length);
      }

    });

    $('.proList .removeVal').click(function(){
      $(this).parent().parent().removeClass('active');
      
      player_id = $(this).attr('player_id');

      player_index = pro_data.indexOf(player_id);

      pro_data.splice(player_index,1);

      $('.proHere .namesAdd .proPName_'+player_id).html('');

      if(pro_data.length == 0){
        $('.proHere .namesAdd').html('2 PRO PLAYERS');
      }
      $('#proList .addNum').text(pro_data.length);
       
    });


    /** js pro player ends here **/


    /** js live qualifier starts here **/

    $('.liveList .selectVal').click(function(){
      if(lq_data.length < 2){
      var proPName = $(this).parent().siblings('td:first-child').text();
      $(this).parent().parent().addClass('active');
        player_id = $(this).attr('player_id');
        lq_data.push(player_id);
      if(lq_data.length < 2){
        $('.liveHere .namesAdd').html('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }else{
        $('.liveHere .namesAdd').append('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }

      if(lq_data.length == 0){
        $('.liveHere .namesAdd').html('2 LIVE QUALIFIERS');
      }

      $('#liveList .addNum').text(lq_data.length);
      }

    });

    $('.liveList .removeVal').click(function(){
      $(this).parent().parent().removeClass('active');
      
      player_id = $(this).attr('player_id');

      player_index = lq_data.indexOf(player_id);

      lq_data.splice(player_index,1);

      $('.liveHere .namesAdd .proPName_'+player_id).html('');

      if(lq_data.length == 0){
        $('.liveHere .namesAdd').html('2 LIVE QUALIFIERS');
      }
      $('#liveList .addNum').text(lq_data.length);
       
    });


    /** js live qualifiers ends here **/


    /** js Online qualifier starts here **/

    $('.onlineList .selectVal').click(function(){
      if(oq_data.length < 3){
      var proPName = $(this).parent().siblings('td:first-child').text();
      $(this).parent().parent().addClass('active');
        player_id = $(this).attr('player_id');
        oq_data.push(player_id);
      if(oq_data.length < 2){
        $('.onlineHere .namesAdd').html('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }else{
        $('.onlineHere .namesAdd').append('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }

      if(oq_data.length == 0){
        $('.onlineHere .namesAdd').html('3 ONILNE QUALIFIERS');
      }

      $('#onlineList .addNum').text(oq_data.length);
      }

      
     
     
    });

    $('.onlineList .removeVal').click(function(){
      $(this).parent().parent().removeClass('active');
      
      player_id = $(this).attr('player_id');

      player_index = oq_data.indexOf(player_id);

      oq_data.splice(player_index,1);

      $('.onlineHere .namesAdd .proPName_'+player_id).html('');

      if(oq_data.length == 0){
        $('.onlineHere .namesAdd').html('3 ONILNE QUALIFIERS');
      }
      $('#onlineList .addNum').text(oq_data.length);
       
    });
    /** js Online qualifiers ends here **/ 




   /** js wildcard starts here **/

    $('.wildList .selectVal').click(function(){
      if(wildcard_data.length < 2){
      var proPName = $(this).parent().siblings('td:first-child').text();
      $(this).parent().parent().addClass('active');
        player_id = $(this).attr('player_id');
        wildcard_data.push(player_id);
      if(wildcard_data.length < 2){
        $('.wildHere .namesAdd').html('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }else{
        $('.wildHere .namesAdd').append('<span class="proPName_'+player_id+'">' + proPName +'<span class="closeParent" player_id="' + $(this).attr('player_id') + '">x</span><span>');
      }

      if(wildcard_data.length == 0){
        $('.wildHere .namesAdd').html('2 WILD CARDS');
      }

      $('#wildList .addNum').text(wildcard_data.length);
      }

      
     
     
    });

    $('.wildList .removeVal').click(function(){
      $(this).parent().parent().removeClass('active');
      
      player_id = $(this).attr('player_id');

      player_index = wildcard_data.indexOf(player_id);

      wildcard_data.splice(player_index,1);

      $('.wildHere .namesAdd .proPName_'+player_id).html('');

      if(wildcard_data.length == 0){
        $('.wildHere .namesAdd').html('2 WILD CARDS');
      }
      $('#wildList .addNum').text(wildcard_data.length);
       
    });
    /** js wildcard ends here **/ 

    $('#submitTeam').click(function(){
      if($(this).hasClass('dontSubmit'))
      {
        return false;
      }
      if($('#fantasy_team_name').val().trim()=='')
      {
        alert('Please Enter a Team Name');
        return false;
      }

      if(mentor_data.length < 1)
      {
        alert('Kindly select 1 Mentor');
        return false;
      }
      if(pro_data.length < 2)
      {
        alert('Kindly select  2 Pro Player');
        return false;
      }
      if(lq_data.length < 2)
      {
        alert('Kindly select 2 Live Qualifiers');
        return false;
      }
      if(oq_data.length < 3)
      {
        alert('Kindly select 3 Online Qualifiers');
        return false;
      }
      if(wildcard_data.length < 2)
      {
        alert('Kindly select 2 Wild Cards');
        return false;
      }

      if(fantasy_page=='preview_page')
      {
        if(old_player.sort().toString()==new_player.sort().toString())
        {
          return false;
        }
        var url = '/fantasy/saveFantasyTeam/update';
      }
      else
      {
        var url = '/fantasy/saveFantasyTeam'; 
      }

      team_name = $('#fantasy_team_name').val();
      $.ajax({
          url:url,
          data:{mentor:mentor_data,pro:pro_data,live_qualifier:lq_data,online_qualifier:oq_data,wildcard:wildcard_data,team_name:team_name},
          type:'post',
          success: function(response) {
              var response = JSON.parse(response);
              if(response.status==true)
              {
                if(fantasy_page=='preview_page')
                {
                  alert('Team updated successfully');
                }
                else
                {
                  alert('Team created successfully');
                }
                window.location.href = "/fantasy";  
              }
              else
              {
                alert(response.msg);
                false;
              }
            }
        });
    })

    
  });



$(document).on('click','.mentorHere  .closeParent',function(){
      $(this).parent('span').html('1 MENTOR');
      player_id = $(this).attr('player_id');
      $('.player_name_'+player_id).removeClass('active');
       $('#mentorList .addNum').text('0');
       mentor_data.pop();
       $(this).parent().parent().removeClass('active');
      });

 
$(document).on('click','.proHere .closeParent',function(){
        player_id = $(this).attr('player_id');
        player_index = pro_data.indexOf(player_id);
        pro_data.splice(player_index,1);
        
        $('#proList .addNum').text(pro_data.length);
        $('.player_name_'+player_id).removeClass('active');
        if(pro_data.length == 0){
          $(this).parent().parent().html('2 PRO Player ');
        }

        $(this).parent().html('');
        var classStr = $(this).attr('class'),
        lastClass = classStr.substr( classStr.lastIndexOf(' ') + 1);
        $('#'+lastClass).parent().parent().removeClass('active');

      });

$(document).on('click','.liveHere .closeParent',function(){
        player_id = $(this).attr('player_id');
        player_index = lq_data.indexOf(player_id);
        lq_data.splice(player_index,1);
        $('#liveList .addNum').text(lq_data.length);

        $('.player_name_'+player_id).removeClass('active');
        if(lq_data.length == 0){
          $(this).parent().parent().html('2 LIVE QUALIFIERS');
        }

        $(this).parent().html('');
        var classStr = $(this).attr('class'),
        lastClass = classStr.substr( classStr.lastIndexOf(' ') + 1);
        $('#'+lastClass).parent().parent().removeClass('active');

      });



$(document).on('click','.onlineHere .closeParent',function(){
        player_id = $(this).attr('player_id');
        player_index = oq_data.indexOf(player_id);
        oq_data.splice(player_index,1);
        $('#onlineList .addNum').text(oq_data.length);
        $('.player_name_'+player_id).removeClass('active');
        if(oq_data.length == 0){
          $(this).parent().parent().html('3 ONLINE QUALIFIERS');
        }

        $(this).parent().html('');
        var classStr = $(this).attr('class'),
        lastClass = classStr.substr( classStr.lastIndexOf(' ') + 1);
        $('#'+lastClass).parent().parent().removeClass('active');

  });

$(document).on('click','.wildHere .closeParent',function(){
        player_id = $(this).attr('player_id');
        player_index = wildcard_data.indexOf(player_id);
        wildcard_data.splice(player_index,1);
        $('#wildList .addNum').text(wildcard_data.length);

        $('.player_name_'+player_id).removeClass('active');
        if(wildcard_data.length == 0){
          $(this).parent().parent().html('2 WILD CARDS');
        }

        $(this).parent().html('');
        var classStr = $(this).attr('class'),
        lastClass = classStr.substr( classStr.lastIndexOf(' ') + 1);
        $('#'+lastClass).parent().parent().removeClass('active');

  });


  var maxHeight = Math.max.apply(null, $(".clTab").map(function ()
{
    return $(this).outerHeight();
}).get());
$(".clTab").outerHeight(maxHeight)

if($(window).width() < 768){
$('.viewTeam').click(function(){
  $('#createTeam .teamtable, .btnteamSec').hide();
  $('.selectedTeam, .teamListprev').show();
  $(this).hide();
})
$('.teamListprev').click(function(){
  $('#createTeam .teamtable, .btnteamSec, .viewTeam').show();
  $('.selectedTeam').hide();
  $(this).hide();
})
}
  </script>
</body>
</html>

