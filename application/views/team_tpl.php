<?php  
///echo "<pre>";var_dump($team_live_qualifier);die;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($team_details)){?>
  <title><?php echo  $team_details['data'][0]['seo_title'];?></title>
  <?php if($team_details['data'][0]['seo_meta']!=""){?>
  <?php echo $team_details['data'][0]['seo_meta']; } }?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
    <style>
	  #imgSlider{
        background: url(<?php echo TEAM_IMAGES_PATH.'/'.$team_details['data'][0]['team_website_banner'];?>) no-repeat center top / auto 100%;
      }
       @media only screen and (max-width: 640px) {
        #imgSlider{
                  background: url(<?php echo TEAM_IMAGES_PATH.'/'.$team_details['data'][0]['team_mobile_banner'];?>) no-repeat center top / 100% auto;
      }
      }
      </style>
</head>
<body>
<?php $this->load->view('header', $homeContent);?>
<section class="subPagebanner">
<div class="">
<div class="item">
    <div id="imgSlider" class="imgSlider teambanner">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
    <!--  <img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $team_details['data'][0]['team_website_banner'];?>" alt="">-->
    </div>
    </div>
    </div>
  </div>
</div>
  </section>
<section class="teamSec">
  <div class="container">
    <div class="row">
    <?php if($team_owner){?>
      <div class="col-xs-12 gloglebggray text-center">

      <h3 class="globleHeading globlegreen text-center">TEAM OWNERS</h3>
      <?php  if($team_owner){foreach ($team_owner as $owner){?>
        <div class="col-xs-12 col-sm-3 nofloatblock">
	        <div class="innerTab">
	        <?php  $url=OWNER_IMAGE_UPLOAD_PATH.$owner['owner_image'];
	       
	        if(!file_exists ($url)){
	        	$url=OWNER_IMAGE_PATH.'default.jpg';
	        }else{
	        	
	        	$url=OWNER_IMAGE_PATH.$owner['owner_image'];
	        }
	        ?>
	        <div class=""><img src="<?php echo $url;?>" alt=""></div>
	        <div class="txtname globlegreen"><?php echo $owner['name'];?></div>
	          <div class=""><?php echo $owner['company_name'];?></div>
	        <div class="txtdeg"></div>
        </div>
		</div>
      <?php } 
		}?>
     </div>
     <?php }?>
     <?php if($team_mentor){?>
      <div class="col-xs-12 gloglebggray">
       <h3 class="globleHeading globlegreen col-xs-12 col-sm-8 setPosabs">Mentor</h3>
       <div class="col-xs-12">
       
        <?php  $mentor_image_url=MENTOR_IMAGES_PATH.$team_mentor[0]['mentor_pic'];
       // echo $mentor_image_url;
        if(!file_exists ($mentor_image_url) && $team_mentor[0]['mentor_pic']==""){
	        	$mentor_image_url=MENTOR_IMAGES_PATH.'default.jpg';
	        }else{
	        	
	        	$mentor_image_url=MENTOR_IMAGES_PATH.$team_mentor[0]['mentor_pic'];
	        }
	        ?>
         <div class="inlineBlck col-xs-12 col-sm-4 text-center"><img src="<?php echo $mentor_image_url;?>" alt=""></div>
         
          <div class="inlineBlck col-xs-12 col-sm-7"><?php if($team_mentor[0]['mentor_description']!="")echo $team_mentor[0]['mentor_description']; else echo "NA";?></div>
       </div>

      </div>
      <?php }?>
      <?php if($team_pro){?>
				<div class="innerWrapper">
					<h3 class="globleHeading globlegreen text-center">PROS</h3>
					<div class="col-xs-12 gloglebggray text-center">
						<div class="row">
						  
							<?php foreach($team_pro as $pro){?>
							<?php  $pro_image_url=MENTOR_IMAGES_PATH.$pro['mentor_pic'];
							if(!file_exists ($pro_image_url) && $pro['mentor_pic']==""){
								  	$pro_image_url=MENTOR_IMAGES_PATH.'default.jpg';
	   							  }else{
	   							  	$pro_image_url=MENTOR_IMAGES_PATH.$pro['mentor_pic'];
	        						}
	        				?>
								<div class="col-xs-6 col-sm-3">
								<div class="innerTab pos-relative">
									<img src="<?php echo $pro_image_url;?>"alt=""> <span class="setonBtm"><?php echo $pro['mentor_name'];?></span>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
	<?php }?>

<?php if($team_live_qualifier){?>
				<div class="innerWrapper">
					<h3 class="globleHeading globlegreen text-center">Live Qualifiers</h3>
					<div class="col-xs-12 gloglebggray text-center">
						<div class="row">
							<?php foreach($team_live_qualifier as $live_qualifier){?>
							<?php  $live_qualifier_image_url=QUALIFIER_IMAGES_SHOW_PATH.$live_qualifier['qualifier_image'];
							if(!file_exists ($live_qualifier_image_url) && $live_qualifier['qualifier_image']==""){
								$live_qualifier_image_url=QUALIFIER_IMAGES_SHOW_PATH.'default.jpg';
	   							  }else{
	   							  	$live_qualifier_image_url=QUALIFIER_IMAGES_SHOW_PATH.$live_qualifier['qualifier_image'];
	        						}
	        				?>
								<div class="col-xs-6 col-sm-3">
								<div class="innerTab pos-relative">
									<img src="<?php echo $live_qualifier_image_url;?>"alt=""> <a class="btn customBtn setonBtm"><?php echo $live_qualifier['first_name'].' '.$live_qualifier['last_name'];?></a>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
<?php }?>
<?php if($team_wildcard){?>

<div class="innerWrapper">
     <h3 class="globleHeading globlegreen text-center">Wild Cards</h3>
					<div class="col-xs-12 gloglebggray text-center">
						<div class="row">
							<?php foreach($team_wildcard as $wildcard){?>
							<?php  $wildcard_image_url=MENTOR_IMAGES_PATH.$wildcard['mentor_pic'];
							if(!file_exists ($wildcard_image_url) && $wildcard['mentor_pic']==""){
								$wildcard_image_url=MENTOR_IMAGES_PATH.'default.jpg';
	   							  }else{
	   							  	$wildcard_image_urll=MENTOR_IMAGES_PATH.$pro['mentor_pic'];
	        						}
	        				?>
								<div class="col-xs-6 col-sm-3">
								<div class="innerTab pos-relative">
									<img src="<?php echo $wildcard_image_url;?>"alt=""> <a class="btn customBtn setonBtm"><?php echo $wildcard['mentor_name'];?></a>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
</div>
 <?php }?>
<?php if($team_online_qualifier){?>
				<div class="innerWrapper">

					<h3 class="globleHeading globlegreen text-center">Online Qualifiers</h3>
					<div class="col-xs-12 gloglebggray text-center">
						<div class="row">
							<?php foreach($team_online_qualifier as $online_qualifier){?>
							<?php  $team_online_image_url=QUALIFIER_IMAGES_SHOW_PATH.$online_qualifier['qualifier_image'];
							if(!file_exists ($team_online_image_url) && $online_qualifier['qualifier_image']==""){
								$team_online_image_url=QUALIFIER_IMAGES_SHOW_PATH.'default.jpg';
	   							  }else{
	   							  	$team_online_image_url=QUALIFIER_IMAGES_SHOW_PATH.$online_qualifier['qualifier_image'];
	        						}
	        				?>
								<div class="col-xs-6 col-sm-3">
								<div class="innerTab pos-relative">
									<img src="<?php echo $team_online_image_url;?>"alt=""> <a class="btn customBtn setonBtm"><?php echo $online_qualifier['first_name'].' '.$online_qualifier['last_name'];?></a>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
<?php }?>
<?php if($team_region){?>
<?php  $region_image_url=REGION_IMAGES_PATH."/".$team_region[0]['image_name'];
		$file_headers = @get_headers($region_image_url);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'){
			$region_image_url=REGION_SHOW_PATH.'/default.jpg';
	   	}else{
	   		$region_image_url=REGION_SHOW_PATH."/".$team_region[0]['image_name'];
	    }
	        				?>
	<div class="col-xs-12 gloglebggray">
       <h3 class="globleHeading globlegreen col-xs-12 col-sm-8 setPosabs">REGION - <?php if($team_region[0]['region_name']!="")echo $team_region[0]['region_name'];else{echo "NA";} ?></h3>
     
       <div class="col-xs-12">
         <div class="inlineBlck col-xs-12 col-sm-4 text-center"><img src="<?php echo $region_image_url;?>" alt=""></div>
          <div class="inlineBlck col-xs-12 col-sm-7">
          <?php $state_name=explode(",", $team_region[0]['state_names']); 
          if(sizeof($state_name)>0) {?>
          <ul>
          <?php foreach ($state_name as $state){?>
             <li>- <?php echo $state;?></li>
          <?php }?>
          </ul>
          <?php }?>
          </div>
       </div>
       </div>
       <?php }?>
    </div>
  </div>

</section>



<?php $this->load->view('footer', $homeContent);?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>
<script type="text/javascript">
  $(function(){
    $('.innerWrapper .gloglebggray .row').each(function(){
      var getval=$(this).children('.col-xs-6').length;
      if($(this).children('.col-xs-6').length == 2){
$(this).children('.col-xs-6:last-child').addClass('pull-right');
  }
if($(this).children('.col-xs-6').length == 3){
  $(this).children('.col-xs-6:last-child').addClass('pull-right');
  $(this).children('.col-xs-6:nth-child(2)').addClass('nofloatblock');
}
    
    })
    
  })
</script>

</body>
</html>

