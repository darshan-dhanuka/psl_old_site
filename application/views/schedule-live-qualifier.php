<!DOCTYPE html>
<html lang="en">
<head>
    <title>Live Qualifier Schedule on Pokersportsleague.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Know the complete details of Live Qualifier Schedule on Pokersportsleague.com">
    <meta name="keywords" content="PSL Live Qualifier Schedule, PSL Live Qualifier Schedule 2017, latest update on PSL Schedule">
    <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
</head>
<style type="text/css">
  .loader {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%; background:rgba(0,0,0,0.8);
    }
    .loader img{position: absolute;left: 0; right: 0; bottom: 0; width: 32px; height: 32px; top: 0; margin: auto;}


</style>
<body>
<?php $this->load->view('header');?>
<section class="subPagebanner">
<div class="">
<div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2><span>SCHEDULE FOR</span><br>
          LIVE QUALIFIER</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="sch-livQua">
  <div class="container">
    <div class="row text-center">
   <div class="col-xs-12">
 <h3 class="globlegreen">Here is the schedule for the Live Qualifier which will take place in select cities.</h3>
  <p class="fntbold">Here are a few things to remember</p>
  <p>Please make sure that you Pre-Register for the qualifier you can play, as there is a penalty for players who pre-register but do not make it to the event. In extreme cases, a player can also be barred from PSL for life.</p>
  <p>A player will only receive leaderboard points to the first 6 qualifiers he plays.</p>
  <p>Each qualifier has a set limit which is mentioned in the table below. You need to be logged in the site before you pre-register</p>
  <p>Please note each qualifier will close 3 hours before the start time. You can only pre-register or un-register three hours before.</p>
  <p>You will receive an email from PSL which will act as a ticket. Please reach the venue an hour before the tournament starts and show the ticket at the registration desk. Don’t forget to carry your photo id card (Driving License, Voter ID, Aadhar Card or Passport).</p>

  <!-- <p class="fntbold">SPECIAL NOTE for NCR/WEST/SOUTH Live Qualifiers:-</p>
  <p>Live Qualifiers for North region, WEST region and SOUTH region will take place online on Adda52.com<br>
To claim your ticket, please ensure that you email you PSL username and Adda52 username to info@pokersportsleague.com<br>
Players from the following regions are eligible to play this tournament. <br>
<strong>North/NCR -</strong> Chandigarh, NCR, Haryana, Himachal Pradesh, Jammu and Kashmir, Punjab, Rajasthan, Uttar Pradesh and Uttarakhand <br>
<strong>WEST -</strong> Chhattisgarh, Dadra and Nagar Haveli, Daman and Diu, Goa, Gujarat, Madhya Pradesh and Maharashtra<br>
<strong>SOUTH –</strong> Andhra Pradesh, Karnataka, Kerala, Lakshadweep, Puducherry, Tamil Nadu, Telangana<br>
PSL reserves the right to not award points to players who are not of the region. Leaderboard points will be reflected in Live Leaderboard.<br>
Please note that tickets will be awarded 1-2 hours before the event.</p> -->
   </div>
   <div class="clr"></div>
   <div class="col-xs-12 mrtp-30 nofloat">
    <table class="table">
    <thead>
      <tr>
        <th class="text-center">
        <div class="selectopt"><select>
          <option value="" selected id="listRow">&nbsp; &nbsp; &nbsp;City&nbsp; &nbsp;&nbsp;</option>
          <option value="2" id="NCR">NCR</option>
          <option value="3" id="Goa">Goa</option>
          <option value="7" id="Bengaluru">Bengaluru</option>
          <option value="8" id="Kolkata">Kolkata</option>
          <option value="9" id="West">WEST</option>
          <option value="10" id="Ahmedabad">Ahmedabad</option>
          <option value="11" id="Mumbai">Mumbai</option>
          <option value="12" id="South">South</option>
        </select></div></th>
        <th class="text-center"><span>Venue</span></th>
        <th class="text-center"><span>Tournament Name</span></th>
        <th class="text-center"><span>Date</span></th>
        <th class="text-center"><span>Time</span></th>
        <th class="text-center"><span>Taken/Ttl Seats</span></th>
        <th class="text-center"><span>Winnings</span></th>
      </tr>
    </thead>
    <tbody>
    <?php if(!$result){echo 'no data found';}
    else{
       
    foreach($result as $row){?>
      <tr class="<?php echo $row['city']; ?> listRow">
        <td><span><?php echo $row['city']; ?></span></td>
        <td><span><?php echo $row['venue']; ?></span></td>
        <td><span><?php echo $row['tourney_name']; ?></span></td>
        <?php $date=date_create($row['date']);?>
        <td><span><?php echo date_format($date,"dS M"); ?></span></td>
        <td><span><?php echo date_format($date,"g:ia"); ?></span></td>
        <td><span><span id="seat_fill_<?php echo $row['id']; ?>" style="display: inline;"><?php echo $row['ids']?$row['ids']:0; ?></span> <?php echo "/".$row['entry']; ?></span></td>
        <td><span><?php echo $row['winnings']; ?></span></td>
        <td class="tableBtn"><a class="btn customBtn" id="regBtn-<?php echo $row['id']; ?>" data-reg-val="<?php if($row['is_reg']==1){ echo 'unregister';}else{ echo 'register';} ?>" onclick="preRegister('<?php echo $row['id']; ?>')"><?php if($row['is_reg']==1){ echo "Unregister";}else{ echo "Pre - Register";} ?></a>
        </td>
      </tr>
    <?php }}?>
    </tbody>
  </table>

   </div>
   </div>
   </div>
</section>
<div class="profilePopup">
<div class="overlay"></div>
<div class="popupContent">
  <div class="closeBtn">x</div>
  <div class="InnerCant afterPreRegister text-center">
    <h3 class="globlegreen">Thank You for Pre-Registering</h3>
    <p>Please check your email for your entry ticket</p>
    <p>Make sure you reach the venue an hour before the qualifier starts</p>
  </div>
  <div class="InnerCant beforeLogin text-center">
    <p>Please Login before you Pre-register</p>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="window.location = '/login?redirect=schedule/live-qualifier'">OK</a>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="$('.profilePopup').hide();">Cancel</a>
  </div>
  <div class="InnerCant fullSeat text-center">
    <p>All seats for this tournament is filled<p>
    <p>Please pre-register in another event</p>
  </div>
  <div class="InnerCant allreadyPreRegister text-center">
    <p>You have already registered for this qualifier</p>
    <p>Please check your mail for your entry ticket</p>
    <p>Incase you have not received the ticket, please write a mail to info@pokersportsleague.com</p>
  </div>
  <div class="InnerCant timeOver text-center">
    <p>Registration time has ended for this tournament.</p>
  </div>
  <div class="InnerCant alreadyUnreg text-center">
    <p>You are already unregsitered for this tournament.</p>
  </div>
  <div class="InnerCant timeOverForUnReg text-center">
    <p>Unregistration time has ended for this tournament.</p>
  </div>
  <div class="InnerCant unRegSucc text-center">
    <h3 class="globlegreen">You have Un-registered </h3>
    <p>Please check your email. You would have recieved an un-registering email.</p>
   
  </div>
  <div class="InnerCant somethingWrong text-center">
    <p>Something Went Wrong. Please Try After Sometime.</p>
  </div>
</div>
</div>

<div class="loader" style="display: none;"><img src="<?php echo IMAGES_PATH?>/ajax-loader.gif" alt="loading.."></div>
<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script>
  function preRegister(id)
  {
    $('.loader').show();
	  var type = $('#regBtn-'+id).data('reg-val');
    $.post("/user/preRegister",
    {
      tid : id,
      type:type
    },
    function(data,status){
      var resp = $.trim(data);
      $('.profilePopup').show();
      $('.InnerCant').hide();
      $('.loader').hide();
      if(resp== 0)
        $('.beforeLogin').show();
      else if(resp==1)
      {
        $('.afterPreRegister').show();
        $('#seat_fill_'+id).text(parseInt($('#seat_fill_'+id).text()) +1);
        unregSetting(id);
      }
      else if(resp==2)
      {
        $('.allreadyPreRegister').show();
        unregSetting(id);
      }
      else if(resp==3)
      {
        $('.fullSeat').show();
        preRegSetting(id);
      }
      else if(resp == 5)
      {
         $('.timeOver').show();
         preRegSetting(id);
      }
      else if(resp == 6)
      {
         $('.alreadyUnreg').show();
         preRegSetting(id)
      }
      else if(resp == 7)
      {
         $('.timeOverForUnReg').show();
         unregSetting(id);
      }
      else if(resp == 8)
      {
        $('.unRegSucc').show();
        $('#seat_fill_'+id).text(parseInt($('#seat_fill_'+id).text()) -1);
        preRegSetting(id);
      }
      else
        $('.somethingWrong').show();
    });
  } 

  function unregSetting(id)
  {
    $('#regBtn-'+id).text('Un-Register');
    $('#regBtn-'+id).data('reg-val','unregister');
  }

  function preRegSetting(id)
  {
    $('#regBtn-'+id).text('Pre - Register');
    $('#regBtn-'+id).data('reg-val','register');  
  }

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

