<header class="header">
<nav>
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-2 col-lg-3 logo" >
        <?php if(isset($logo)){?>
        <a href="/"><img src="<?php echo IMAGES_PATH?>/<?php echo $logo;?>" alt=""></a>
        <?php }?>
      </div>
      <?php $this->load->view('login_header');?>
      <?php $this->load->view('top_menu');?>
    </div>
  </div>
</nav>
</header>