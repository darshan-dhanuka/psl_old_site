
<footer>
<div class="footerNav">
  <div class="container">
    <div class="row text-center">
   <ul>
     <li><a href="/about-us">About Us</a></li>
     <li><a href="/rules">Rules</a></li>
     <li><a href="/faqs">FAQs</a></li>
     <li><a href="/tandc">T&C</a></li>
     <li><a href="/privacy-policy">Privacy Policy</a></li>
     <li><a href="/code-of-conduct">Code of Conduct</a></li>
     <li><a href="/contact-us">Contact Us</a></li>
     <li><a href="/sitemap">Site Map</a></li>
   </ul>
    </div>
    </div>
</div>
 <div class="allrights">
 <div class="container">
    <div class="row">
      <?php if(isset($copyright_text)){?>
   <div class="col-xs-12"><?php echo $copyright_text;?></div>
   <?php }?>
 </div> 
 </footer>
 <?php if(isset($footer_script)){?>
<?php echo $footer_script;?>
<?php }?>
<?php $page=$this->uri->segment(1); 
if($page!="thankyou"){?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '555586341482250');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=555586341482250&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<?php }else {
?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '555586341482250');
  fbq('track', 'PageView');
fbq('track', 'Lead');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=555586341482250&ev=PageView&noscript=1"/></noscript>
<!-- End Facebook Pixel Code -->
<?php }?>
