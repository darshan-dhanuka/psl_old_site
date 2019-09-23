<?php

	/*

		Template Name: Video Gallery

	*/

get_header(); ?>

	
	<section class="page-gallery">
		<div class="container">
		    <div class="centerGalleryCon">
            <h1> <?php the_title(); ?> </h1>
			<?php
			    while ( have_posts() ) : the_post();
					the_content(); 
				endwhile;
			?>
			</div>
			<div id="advantage_section_mid" class="no-gutter clearfix community_con">
				<?php putUniteGallery("Video_Gallery") ?>
			</div>

		</div>
	</section>
	

		<div class="postRecent">
			<section class="container recent-posts">
				<div class="row">
				<div class="col-sm-12">
					<div class="row-col-inner">
					<h5 class="title">Recent Posts</h5>
					<div class="row no-gutter">   

					<?php
					$args = array(
						'numberposts' => 4,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_status' => 'publish',
						'suppress_filters' => true
					);
					$recent_posts = wp_get_recent_posts($args);
					//print_r($recent_posts);
					foreach( $recent_posts as $recent ){
					 ?>
					 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]), 'large' ); 
					 //echo $image;
					 ?>
					 <div class="col-sm-3 no-gutter">
                                        <article class=" post-block post_block_1 " style="background-image:url(<?php echo $image[0]; ?>)">
                    <a href="<?php echo get_permalink($recent["ID"]) ?>">
                                                <div class="post-block__details ">
                          <div class="post-block__details_table">
                            <div class="post-block__details_cell">
                              <h2 class="post_title"><?php echo $recent['post_title']; ?></h2>
                              <p class="post-author">
                                <span class="author-name blue-text"><?php echo get_author_name($recent["post_author"]);?> </span> 
                                <span class="post-date">
                                		<?php echo date('F j, Y', strtotime($recent["post_date"])); ?>
                                </span>
                              </p>
                             
                          </div>
                          </div>
                        </div>
                        </a>
                        </article>
                        </div>
                   

					
					<?php
					}
					wp_reset_query();
					
					?> 


					
			 




	                  	
						
						
	                  
            </div>
            </div>
            </div>
            </div>
            </section>
    </div>
            
<?php get_footer(); ?>