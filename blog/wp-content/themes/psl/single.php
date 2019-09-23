<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
	// If a regular post or page, and not the front page, show the featured image.
	if (  is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) :
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );
		echo '<div class="single-featured-image-header" style="background-image:url('.$image[0].')">';
    	echo '<div class="header-info"><div>';


	    echo postFirstTag($post->ID);
    	
    	echo '<h1 class="single-page-title">' .get_the_title() .'</h1>';
    	echo '</div></div></div>';
    
	endif;
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="single-post site-main" role="main">
			
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );
			?>
			<section class="container">

				<div class="row">
				<div class="col-xs-12">
				<div class="row-col-inner">
				<?php
					$tags = get_the_tags( $post->ID );
					$separator = ' ';
					$output = '';
					if($tags){
					echo '<div class="entry-tags">';
						echo "<p>" . __('Tags', 'tracks') . "</p>";
					    echo "<p>";
					        foreach($tags as $tag) {
					            // dpm($tag) here by uncomment you can check tag slug which you want to exclude
					            if($tag->slug != "featured"){ // replace yourtag with you required tag name
					            	$str = $tag->description;
									$re = '/#[0-9a-f]{6}/i';
									preg_match($re, $str, $matches);

					               $output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts tagged %s", 'tracks' ), $tag->name ) ) . '" class="' .$tag->slug. '" style="color:'. $matches[0] .'; border-color:'. $matches[0] .'">'.$tag->name.'</a>'.$separator;
					            }
					          }
					            echo trim($output, $separator);
					        echo "</p>";
					    echo "</div>";
					}

					
				?>
				</div>
			</div>
			</div>
			</section>
			<section class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="row-col-inner">
							<div class="footer-author">
						<?php
								//author details
								twentyseventeen_posted_on();
						?>
						    </div>
						</div>
					</div>
				</div>
			</section>
			 <?php

			$next_post = get_adjacent_post( false,'',false );

			if( isset($next_post->ID) ):
			    $next_id = $next_post->ID;
			else:
			    $next_post = new WP_Query( 'posts_per_page=1&post_type=photo&order=ASC' );
			    $next_id = $next_post->post->ID;
			endif;
			if (!empty( $next_post )): 
			?>
				    
			<section class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="row-col-inner ">
						  <div class="next-post-block">
							
							<?php 
							$post_thumbnail = get_the_post_thumbnail( $next_id, 'thumbnail' );
							?>

							


						    <div class="row">
						    	<?php 
						    	if(!empty($post_thumbnail))		{
						    	?>
								<div class="col-sm-2 col-xs-4">
									<figure><?php echo $post_thumbnail; ?></figure>
								</div>
								<?php } ?>
								<div class="<?php if(!empty($post_thumbnail)){ echo 'col-sm-8 col-xs-12'; } else { echo 'col-sm-12 col-xs-12';}  ?>">
									<p><a href="<?php echo get_permalink( $next_id ); ?>" class="next-read">Read Next</a></p>
									<h5 class="next-post-title"><?php echo $next_post->post_title ?></h5>
									<p ><?php ; ?></p>
									<p class="post-author">
					                      <span class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?></span> 
					                      <span class="author-name blue-text"><?php 
					                      		$next_user = get_user_by( 'id', $next_post->post_author );
					                      		echo $next_user->display_name
					                      ?>  
					                       </span> 
					                      <span class="post-date"><?php echo date('F j, Y', strtotime($next_post->post_date)); ?></span>
					                </p>
								</div>
								<div class="<?php if(!empty($post_thumbnail)){ echo 'col-sm-2 hidden-xs'; } else { echo 'col-sm-2 hidden-xs';} ?>">
									<a href="<?php echo get_permalink( $next_id ); ?>" class="next-btn"></a>
								</div>
						    </div>


						    

						</div>



						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<?php
					//for use in the loop, list 5 post titles related to first tag on current post
					$tags = wp_get_post_tags($post->ID);
					if ($tags) {
						$first_tag = $tags[0]->term_id;
						$args=array(
						'tag__in' => array($first_tag),
						'post__not_in' => array($post->ID),
						'posts_per_page'=>3,
						'caller_get_posts'=>1
					);
			?>
			<?php 
			if(!$my_query) {
			?>
			<section class="container other-posts">
				<div class="row">
				<div class="col-sm-12">
					<div class="row-col-inner">
					<h5 class="title">Must Read</h5>
					<div class="row">   

					<?php
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');?>
                   

					<div class="col-sm-4">	
						<article class=" post-block post_block_2 ">
                            <figure style="background-image:url(<?php echo $image[0]; ?>)">
                            	<div class="masking"></div>
                            </figure>
                     		<div class="post-block__details ">
                              <h2 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title();?></a></h2>
                              <p class="post-author">                                
                                <span class="author-name blue-text pull-left"><?php the_author(); ?> </span> 
                                <span class="post-date pull-right"><?php echo get_the_date(); ?></span>
                              </p>
                     		</div>
                        </article>
					</div>	
					<?php
					endwhile;
					}
					wp_reset_query();
					}
					?>            
	                  	
						
						
	                  
            </div>
            </div>
            </div>
            </div>
            </section>
            <?php }?>

			<div class="comments-container">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="row-col-inner">
						<?php		
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
						?>
						</div>
					</div>
				</div>
			</div>
			</div>
			
			<?php		
				endwhile; // End of the loop.
			?>
		
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
