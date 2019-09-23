<!DOCTYPE html>
<html lang="en">
<head>
  <title>Poker Pro Player Application to enter the draft of pro players</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Know more about pro players  Application on PokerSportsleague.com">
  <meta name="keywords" content="what is pro player application, Poker sport league 2017, benefits of Pro Player application, PSL 2017">
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" /> 
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
<nav>
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-4 col-md-3 logo">
        <img src="<?php echo IMAGES_PATH?>/logo.png" alt="">
      </div>
      <?php $this->load->view('login_header');?>
      <?php $this->load->view('top_menu');?>
    </div>
  </div>
</nav>
</header>
<section class="subPagebanner">
<div class="">
  <div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2>Pro player application</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>

<section class="registrationSec pro-player-rgstr">
  <div class="container">
    <div class="row">
    <div class="col-xs-12 proAppli text-center">
      <h3 class="globlegreen">Welcome to the Pro Application page</h3>
      <?php if($form_status == 1){?>
        <p>Thank you for filling the application for Pro Player draft.</p>
        <p>We wil let you know if you have been selected. Please stay tuned for further updates.</p>
      <?php }?>
      <?php if($form_status == '' ||  $form_status == 0){?>
      <p>We are excited to have you become a part of Poker Sports League. Please fill in your top three accomplishments in the poker industry since Jan 2015. You can share a maximum of 10 of your best live and online poker tournament achievements in the last 3 years from date of application. </p>
      <p>The applications are open from 10th January till 11th February. Please note no special requests will be entertained after the last date of application</p>
      <p>Here are some rules to remember while filling this form:</p>
      <ul>
        <li>- Freeroll Tournaments will not be considered</li>
        <li>- Tournaments need to have a minimum buy-in of Rs.1000 and a minimum field size of 100. Please note that any amount filled will be assumed to be in INR.</li>
        <li>- The more fields you fill, the higher your chances of entering the draft.</li>
        <li>- Do ensure to include proofs of said achievement in the form of photos, screen shots of winning email etc. They will play a huge part in validating your candidacy. </li>
        <li>- Please note only one upload is allowed. In case you have multiple images, you can combine them in a word document, pdf format, images etc. and collect all documents in a folder and share the zipped format. You can also send them later to <a href="mailto:info@pokersportsleague.com">info@pokersportsleague.com</a> with your user id and name.</li>
        <li>- Players should also note that all the information they provide should be within the legal framework of the country and all laws have been complied to.</li>
      </ul>
    </div>
    <!-- <div class="globlegreen text-center">The Application will close at Midnight on 25th Jan!</div> -->
    <div class="clr"></div>
    
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="liveRegistration active">
    <div style="color:red"><b><?php echo $msg;?></b></div>
    <div style="color:red"><b><?php if($_GET['msg'] == 'saved'){echo 'Your application has been saved to your account';}?></b></div>
      <div class="liveRegistrationEntry">

      <?php for($i=1;$i<=10;$i++){ ?>
        <div class="entrySec">
            
            <div class="col-xs-12 entryCount">Entry <?php echo $i;?></div>
            
            <div class="txtfield col-xs-12">
              <input type="text" name="tourney_name_<?php echo $i;?>" value="<?php echo $pro_user_info['tourney_name_'.$i]?>" placeholder="Tournament Name & Date ">
            </div>
            <div class="txtfield col-xs-12 col-sm-6">
              <input type="text" name="site_<?php echo $i;?>" value="<?php echo $pro_user_info['site_'.$i]?>" placeholder="Location/Poker site">
            </div>
            <div class="txtfield col-xs-12 col-sm-6">
              <select name="live_online_<?php echo $i;?>">
                  <option value="live" <?php if($pro_user_info['live_online_'.$i] == 'live'){echo 'selected';}?>>Live</option>
                  <option value="online" <?php if($pro_user_info['live_online_'.$i] == 'live'){echo 'selected';}?>>Online</option>
              </select>

            </div>
            <div class="txtfield col-xs-12 col-sm-6">
              <input type="number" min="0" name="buy_in_<?php echo $i;?>" value="<?php echo $pro_user_info['buy_in_'.$i]?>" placeholder="Buy-In (Min Rs 1000)">
            </div>

            <div class="txtfield col-xs-12 col-sm-6">
              <input type="number" min="0" name="entries_<?php echo $i;?>" value="<?php echo $pro_user_info['entries_'.$i]?>" placeholder="Approx No. of Entries (Min 100) ">
            </div>
            <div class="txtfield col-xs-12 col-sm-6">
              <input type="number" min="0" name="position_<?php echo $i;?>" value="<?php echo $pro_user_info['position_'.$i]?>" placeholder="Position Finished">
            </div>
            <div class="txtfield col-xs-12 col-sm-6">
              <input type="number" min="0" name="amount_<?php echo $i;?>" value="<?php echo $pro_user_info['amount_'.$i]?>" placeholder="Amount Cashed (In Rs)">
            </div>

        </div>
        <?php }?>
        <div class="txtfield col-xs-12 fileload">
          <input id="uploadFile" disabled="disabled" placeholder="Only 1 Upload Allowed. Must be a ZIP file. Max 20MB" type="text" value="<?php echo $pro_file;?>">
           <input class="upload" id="uploadBtn" type="file" name="userfile">
           <a class="btn customBtn">Browse</a>
        </div>

        <div class="txtfield col-xs-12">
         <textarea name="comments" placeholder="Please share with us a little bit about your poker journey. (Optional)"><?php echo $comments;?></textarea>
        </div>

        <div class="txtfield col-xs-12 col-sm-6 trmcndmiddle">
          <input name="term" type="checkbox" <?php if( $pro_user_info['term'] == 'on'){echo 'checked';}?>  >
          <span>I certify that the achievements listed below are accurate. If you submit false information, you will receive an irrevocable life ban from Poker Sports League.</span>
        </div>

        <div class="txtfield col-xs-6 col-sm-3">
         <button class="btn customBtn" type="Submit" name="save" value="save">Save</button>
        </div>
        <div class="txtfield col-xs-6 col-sm-3">
          <?php if(time() <= strtotime('2017-03-07 00:00:00')){ ?>
          <button class="btn customBtn globleGray" type="Submit" name="submit" value="submit" disabled >Submit</button>
        <?php }else{ ?>
          <button class="btn customBtn" type="Submit" name="submit" value="submit" >Submit</button>
          <?php } ?>
        </div>
    </div>
     

    </div>
      </form>
      <div class="col-xs-12">
<p>Incase you want to resubmit the Pro Form, please send a mail to info@pokersportsleague.com with the subject line ‘Resubmission of Pro Application’.</p>
      <i>By giving the application, the player confirms that if he is selected, he is contractually bound to play the final event if selected by a team.</i>
      </div>
      <?php }?>
    </div>
    </div>
</section>
<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script src="<?php echo JS_PATH?>/jquery-ui.min.js"></script>
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
  </script>
</body>
</html>
