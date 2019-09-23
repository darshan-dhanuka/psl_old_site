<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?php echo $pageinfo['seo_title'];?>
  </title>
  <?php echo $pageinfo['seo_meta'];?>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
</head>
<style>
  #imgSlider{
        background: url('<?php echo IMAGES_PATH.'/'.$pageinfo['page_desktop_banner'];?>') no-repeat center top / auto 100%;
      }
    .loader{position: fixed;left: 0;top: 0;width: 100%;height: 100%; background: rgba(0,0,0,0.7);    z-index: 1000;}
    .loader img{transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); left: 50% !important; top: 50%; position: absolute;}
    .bannerMidSec .customBtn{max-width: 170px;}
      @media only screen and (max-width: 640px) {
        #imgSlider{background: url('<?php echo IMAGES_PATH.'/'.$pageinfo['page_mobile_banner'];?>') no-repeat center top / 100% auto;   }
        .bannerMidSec .customBtn{max-width: 170px;}
            }

  
  </style>

<body>
  <?php $this->load->view('header', $homeContent);?>
  <section class="subPagebanner">
    <div class="">
      <div class="item">
        <div id="imgSlider" class="imgSlider">
          <div class="container spclftAlgn">
            <div class="bannerMidSec">
              <h2><?php echo $pageinfo['page_heading'];?></h2>
              <?php if($pageinfo['page_name'] =='schedule-live-qualifier' || $pageinfo['page_name'] =='schedule-online-qualifier'){ ?>
              <a class="btn customBtn" href="https://www.pokersportsleague.com/register">Register</a>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php echo $pageinfo['page_description'];?>
  <?php if($live_qualifier){?>
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
        <p>All seats for this tournament is filled
          <p>
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
  <div class="sch-livQua">
    <div class="container">
    <div class="row text-center">
  <div class="col-xs-12 mrtp-30 nofloat">
              <?php $statelist = array();$livetable = '<tbody>';if(!$live_qualifier){echo '<tr><td colspan="7">no data found<td></tr>';}else{foreach($live_qualifier as $row){if(!in_array($row['city'], $statelist, true)){array_push($statelist,$row['city']);}?>
              <?php $livetable .= '<tr class="'.str_replace(' ','_',$row['city']) .' listRow">
                <td><span>'.$row['city'].'</span></td>
                <td><span>'.$row['venue'].'</span></td>
                <td><span>'.$row['tourney_name'].'</span></td>
                <td><span>'.date_format(date_create($row['date']),"dS M").'</span></td>
                <td><span>'.date_format(date_create($row['date']),"g:ia").'</span></td>
                <td><span id="seat_fill_'.$row['id'].'" >'.(($row['ids'])?$row['ids']:0).'/'.$row['entry'].'</span></td>
                <td><span>'.$row['winnings'].'</span></td>
                <td class="tableBtn">
                  <a class="btn customBtn" id="regBtn-'.$row['id'].'" data-reg-val="'.(($row['is_reg']==1)?'unregister':'register').'"
                    onclick="preRegister(\''.$row['id'].'\')">
                    '.(($row['is_reg']==1)?'Unregister':'Pre - Register').'
                  </a>
                </td>
              </tr>';?>
              <?php }}?>
            <?php $livetable .= '</tbody></table>';?>
            <table class="table">
            <thead>
              <tr>
                <th class="text-center">
                  <div class="selectopt">
                    <select>
                      <option value="" selected id="listRow">&nbsp; &nbsp; &nbsp;City&nbsp; &nbsp;&nbsp;</option>
                      <?php foreach( $statelist as $key=>$city){?>
                      <option value="<?php echo $key;?>" id="<?php echo str_replace(' ','_',$city);?>"><?php echo $city;?></option>
                      <?php }?>
                  </select>
                </div>
                </th>
                <th class="text-center"><span>Venue</span></th>
                <th class="text-center"><span>Tournament Name</span></th>
                <th class="text-center"><span>Date</span></th>
                <th class="text-center"><span>Time</span></th>
                <th class="text-center"><span>Taken/Ttl Seats</span></th>
                <th class="text-center"><span>Winnings</span></th>
              </tr>
            </thead>
            <?php echo $livetable;?>
            </table>
        </div>
        </div>
        </div>
        </div>
  <?php }?>
  <?php if($online_qualifier){?>
    <div class="container">
    <div class="row text-center">
  <div class="col-xs-12 col-md-10 mrtp-30 nofloat">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center"><span>Tournament Name</span></th>
                <th class="text-center"><span>Date</span></th>
                <th class="text-center"><span>Time</span></th>
                <th class="text-center"><span>Entry Criteria</span></th>
                <th class="text-center"><span>Winnings</span></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!$online_qualifier){echo '<tr><td colspan="5">no data found</td></tr>';}else{foreach($online_qualifier as $row){?>
              <tr>
                <td><span><?php echo $row['tourney_name'];?></span></td>
                <td><span><?php echo $row['date'];?></span></td>
                <td><span><?php echo $row['time'];?></span></td>
                <td><span><?php echo $row['entry_criteria'];?></span></td>
                <td><span><?php echo $row['winnings'];?></span></td>
              </tr>
              <?php }}?>
            </tbody>
          </table>
        </div>
        </div>
        </div>
        <?php if ($this->session->checkLogin() == FALSE) { ?>
        <div class="row text-center"><strong>Please Login Before You Play Qualifier</strong></div>
        <?php }else{ ?>
        <a class="btn customBtn" href="https://www.adda52.com/PokerSportsLeague" target="_blank">PLAY QUALIFIER</a>
        <?php } ?>
  <?php }?>
  <?php $this->load->view('footer', $homeContent);?>
  <script src="<?php echo JS_PATH?>/jquery.min.js"></script>
  <script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
  <script src="<?php echo JS_PATH?>/main.js"></script>
  <script src="<?php echo JS_PATH?>/jquery-ui.min.js"></script>  
  <?php if($live_qualifier){?>  
  <script>
    function preRegister(id) {
      $('.loader').show();
      var type = $('#regBtn-' + id).data('reg-val');
      $.post("/user/preRegister", {
          tid: id,
          type: type
        },
        function (data, status) {
          var resp = $.trim(data);
          $('.profilePopup').show();
          $('.InnerCant').hide();
          $('.loader').hide();
          if (resp == 0)
            $('.beforeLogin').show();
          else if (resp == 1) {
            $('.afterPreRegister').show();
            $('#seat_fill_' + id).text(parseInt($('#seat_fill_' + id).text()) + 1);
            unregSetting(id);
          } else if (resp == 2) {
            $('.allreadyPreRegister').show();
            unregSetting(id);
          } else if (resp == 3) {
            $('.fullSeat').show();
            preRegSetting(id);
          } else if (resp == 5) {
            $('.timeOver').show();
            preRegSetting(id);
          } else if (resp == 6) {
            $('.alreadyUnreg').show();
            preRegSetting(id)
          } else if (resp == 7) {
            $('.timeOverForUnReg').show();
            unregSetting(id);
          } else if (resp == 8) {
            $('.unRegSucc').show();
            $('#seat_fill_' + id).text(parseInt($('#seat_fill_' + id).text()) - 1);
            preRegSetting(id);
          } else
            $('.somethingWrong').show();
        });
    }

    function unregSetting(id) {
      $('#regBtn-' + id).text('Un-Register');
      $('#regBtn-' + id).data('reg-val', 'unregister');
    }

    function preRegSetting(id) {
      $('#regBtn-' + id).text('Pre - Register');
      $('#regBtn-' + id).data('reg-val', 'register');
    }

    $(function () {
      $(".selectopt select").val($(".selectopt select option:first").val());
      $('.selectopt select').change(function () {
        var gtId = $(this).children('option:selected').attr('id');
        $('.listRow').hide();
        $('.' + gtId).show();
      })
    })
  </script>
  <?php }?>
    <script type="text/javascript">
if($(window).width()<992){
  var gttdval1=$('.table thead tr th').length;
  for(var i=1; i<= gttdval1; i++){
    $('.table tbody tr td:nth-child('+i+')').prepend('<span class="dptadded">'+ $(".table thead tr th:nth-child("+i+")").text() +'</span>');
    $('.sch-livQua .table tbody tr td:first-child span:first-child').text('City');
  }
}
</script>
</body>

</html>
