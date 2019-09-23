
<?php //echo "<pre>";var_dump($banner);die();?><!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?php echo $homeContent['seo_title']?>
  </title>
  <?php echo $homeContent['seo_meta']?>
  <?php if($homeContent['favicon'] <> ''){?>
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/<?php echo $homeContent['favicon']?>">
  <?php }?>
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
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
  <?php if(isset($banner)){?>
  <section class="banner">
    <div class="owl-carousel topSlider">
      <?php $i=1;foreach ($banner as $banner1){?>
      <div class="item">
        <div id="imgSlider<?php echo $i++;?>" class="imgSlider">
          <div class="container spclftAlgn">
            <div class="bannerMidSec">
              <h2 class="twoLine">
                <?php echo $banner1['banner_text'];?>
              </h2>
              <a class="btn customBtn" href="<?php echo base_url().$banner1['button_url'];?>">
                <?php echo $banner1['button_text'];?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </section>
  <?php }?>
  <?php if($homeContent['home_content'] <> ''){?>
  <?php echo $homeContent['home_content'];?>
  <?php }?>
  <?php if($team_logo){?>
  <section class="teams">
    <div class="container">
      <div class="row">
        <h3 class="globleHeading globlegreen">
          <?php echo $homeContent['home_team_heading'];?>
        </h3>
        <div class="col-xs-12">
          <div class="teamsSlider allteams row">

            <?php foreach ($team_logo as $teamlogo){
					if ($teamlogo ['homepageLogo'] == 1)
					{	
						if ($teamlogo ['meet_the_team'] == 1)
						{
						?>
						<div class="col-xs-4 col-sm-3 col-md-2 mrtp-30">
							<a href="/teams/<?php echo $teamlogo['page_url']; ?>">
							<img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $teamlogo['team_logo']?>" alt="">
							</a>
						</div>
						<?php
						}
						else
						{
						?>
						<div class="col-xs-4 col-sm-3 col-md-2 mrtp-30">
							<img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $teamlogo['team_logo']?>" alt="">
						</div>
						<?php
						}
				 }
    			}?>

          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }?>
  <?php if($homeContent['home_about_psl'] <> ''){?>
  <?php echo $homeContent['home_about_psl'];?>
  <?php }?>
  <?php if($homeContent['home_draft_content'] <> ''){?>
  <section class="rgstSec">
    <div class="container">
      <div class="row">
        <h3 class="globleHeading globlegreen">
          <?php echo $homeContent['home_draft_heading'];?>
        </h3>
        <?php echo $homeContent['home_draft_content'];?>
      </div>
    </div>
  </section>
  <?php }?>
  <?php  if($mentor_detail){?>
  <section class="meet-cpt" id="mentor">
    <div class="container">
      <div class="row">
        <h3 class="globleHeading globlegreen">
          <?php echo $homeContent['home_mentor_heading'];?>
        </h3>
        <div class="col-xs-12">
          <div class="meetSlider owl-carousel owl-theme">
            <?php foreach($mentor_detail as $mentor){?>
            <div class="item">
              <a <?php if($mentor->mentor_popup==1) {?> class="itmValue open_popup" style="cursor:pointer;"<?php } else {?> class="itmValue"style="cursor:default;"<?php }?> href="javascript:;" data-name="<?php echo $mentor->mentor_name;?>" data-smtxt="<?php echo $mentor->mentor_condition_text;?>"
                data-age="<?php echo $mentor->mentor_age;?>" data-teamtitle="Team" data-region="<?php echo $mentor->team_name;?>"
                data-gpi="<?php echo $mentor->mentor_gpi;?>" data-atm="<?php echo $mentor->mentor_itm;?>" data-content="<?php echo $mentor->mentor_description;?>"><img src="<?php echo IMAGES_PATH?>/mentor/<?php echo $mentor->mentor_slider_pic;?>" alt="<?php echo $mentor->mentor_name;?>"></a>
              <div class="imgName">
                <?php echo $mentor->mentor_name;?>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }?>
  <?php if($homeContent['home_partner_content'] <> ''){?>
  <section class="sponsors">
    <div class="container">
      <div class="row">
        <h3 class="globleHeading globlegreen">
          <?php echo $homeContent['home_partner_heading'];?>
        </h3>
        <div class="col-xs-12">
          <div class="teamsSlider row">
            <?php echo $homeContent['home_partner_content'];?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }?>
  <div class="profilePopup">
    <div class="overlay"></div>
    <div class="contentArea">
      <div class="closeBtn">x</div>
      <div class="contAreaScr">
      <div class="col-sm-5 col-xs-12 brdrGreen cantMid">
        <div class="imgProfile">
          <div class="imgSec text-center"><img src="<?php echo IMAGES_PATH?>/mentor/akash_malik.jpg" alt=""></div>
          <div class="NameTitle">Name</div>
        </div>
        <div class="profDetails">
          <ul>
            <li class="">
              <div class="pull-left">Age</div>
              <div class="gtAge pull-right">-</div>
            </li>
            <li class="">
              <div class="pull-left team_title">Region</div>
              <div class="gtRegion pull-right">-</div>
            </li>
            <li class="">
              <div class="pull-left">GPI</div>
              <div class="gtGpi pull-right">-</div>
            </li>
            <li class="">
              <div class="pull-left">ITM</div>
              <div class="gtAtm pull-right">-</div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-7 col-xs-12 txtAreapopup cantMid">
        <h3>Poker Sports League</h3>
        <div class="clntCont">-</div>
      </div>
      <p class="smallTxt">*As reported on Global Poker Index on 31st Dec, 2015</p>
      </div>
    </div>

  </div>
  <?php $this->load->view('footer', $homeContent);?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" defer></script>
  <script src="<?php echo JS_PATH?>/owl.carousel.js" defer></script>
  <script src="<?php echo JS_PATH?>/main.js" defer></script>
</body>

</html>
