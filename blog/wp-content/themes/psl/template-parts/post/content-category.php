<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
     <div class="col-sm-4"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     	<article class=" post-block post_block_2 ">
     	<?php //the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
     	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post->ID ), 'large' ); ?>
         <figure style="background-image:url(<?php echo $image[0]; ?>)">
           <div class="masking"></div>
         </figure>
         <div class="post-block__details ">
                  
                  <h2 class="post_title"><?php 
                  		the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
                  ?></h2>
                  <p class="post-author">
                    
                    <span class="author-name blue-text pull-left"><?php the_author() ?> </span> 
                    <span class="post-date pull-right"><?php echo get_the_date(); ?></span>
                  </p>
          </div>
          </article>
     </div>   


		

	
