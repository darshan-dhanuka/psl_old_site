<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

		</div><!-- #content -->
		


		 <footer class="footer">
        <div class="footer-top">
            <div class="footer-middle">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12  col-sm-6">
                    <div class="footer-about">
                     
                      <?php if ( is_active_sidebar( 'about-psl' ) ) : ?>
						
							<?php dynamic_sidebar( 'about-psl' ); ?>
						
					<?php endif; ?>
					 <?php if ( is_active_sidebar( 'social-links' ) ) : ?>
						
							<?php dynamic_sidebar( 'social-links' ); ?>
					 <?php endif; ?>
                    </div>
                  </div>
                    <div class="col-xs-12 col-sm-3 ">
                    <div class="footer-category-listing">
                     
                      <?php if ( is_active_sidebar( 'category-listing' ) ) : ?>
						
							<?php dynamic_sidebar( 'category-listing' ); ?>
						
					<?php endif; ?>
					
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="newsletter">
                      <h3></h3>
                      <p>Sign up to get latest updates</p>
                      <?php
                      	if(function_exists('emailing_form')) { emailing_form();}
                      ?>
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      
    </footer>

		<footer>
		<div class="footerNav">
		  <div class="container">
		    <div class="row text-center">
		   <ul>
		     <li><a href="https://www.pokersportsleague.com/about-us">About Us</a></li>
		     <li><a href="https://www.pokersportsleague.com/rules">Rules</a></li>
		     <li><a href="https://www.pokersportsleague.com/faqs">FAQs</a></li>
		     <li><a href="https://www.pokersportsleague.com/tandc">T&C</a></li>
		     <li><a href="https://www.pokersportsleague.com/privacy-policy">Privacy Policy</a></li>
		     <li><a href="https://www.pokersportsleague.com/code-of-conduct">Code of Conduct</a></li>
		     <li><a href="https://www.pokersportsleague.com/contact-us">Contact Us</a></li>
		     <li><a href="https://www.pokersportsleague.com/sitemap">Site Map</a></li>
		   </ul>
		    </div>
		    </div>
		</div>
		 <div class="allrights">
		 <div class="container">
		    <div class="row">
		   <div class="col-xs-12">©Poker Sports League. All Rights Reserved.</div>
		   <!-- <div class="col-xs-6 text-right">Designed by <img src="images/olive.png" alt=""></div> -->
		 </div> 
		 </footer>
	</div><!-- .site-content-contain -->

<?php wp_footer(); ?>

</body>
</html>
