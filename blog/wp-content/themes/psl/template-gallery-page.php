<?php

	/*

		Template Name: Gallery View

	*/

get_header(); ?>

	
	<section class="page-gallery">
		<div class="container">
		    <div class="centerGalleryCon">
		     <?php
		$alias =  $_GET['id'];
        $gallery = $wpdb->get_row("SELECT title FROM wp_unitegallery_galleries WHERE (alias = '$alias')");
		echo '<h1>'. $gallery->title .'</h1>';

      ?>

             
			
			</div>
			<div id="advantage_section_mid" class="no-gutter clearfix community_con">
				<?php
					
				 putUniteGallery( $_GET['id'] ); 
				 ?>
			</div>

		</div>
	</section>
	

		<?php include_once('recent_posts.php'); ?>
            
<?php get_footer(); ?>