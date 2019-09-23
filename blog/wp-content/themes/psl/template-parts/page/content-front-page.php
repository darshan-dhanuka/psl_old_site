
<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="featured_post_home">
<div class="container">
<div class="row"> 
<?php
$args = array(
    'post_status' =>   'publish',
    'tag'         =>   'featured',
    "posts_per_page" => 3
);
$query = new WP_Query( $args );
$posts = $query->posts;
$featured = 0;
//print_r($posts);
foreach($posts as $post) {
  $featured++;
?>
  <div class="<?php if ($featured == 1 ){ echo 'col-sm-12 hp_featured_main';}else{ echo 'col-sm-6 hp_featured_other';} ?>">
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
  <article class="post-block" style="background-image:url(<?php echo $image[0]; ?>)">
              <a href="<?php the_permalink(); ?>">
              <div class="post-block__details cf_blue_overlay">
                <div class="post-block__details_table">
                  <div class="post-block__details_cell">
                    <div class="post-data">
                      <?php echo postFirstTag($post->ID); ?>
                      <span class="post-data-col"><span class="sprite view"></span><?php if(function_exists('the_views')) { the_views(); } ?></span>
                      <!--<span class="data-view"><span class="sprite fav"></span>86</span>-->
                      <span class="post-data-col"><span class="sprite comments"></span>
                          <?php
                            $comments_count = wp_count_comments( $post->ID );
                          ?>

                          <?php echo $comments_count->total_comments ?>
                        </span>
                     
                    </div>
                    <h2 class="post_title"><?php echo $post->post_title ?></h2>
                    <?php 
                      if ( $featured == 1 ){
                    ?>
                    <p class="description"><?php echo wp_trim_words( $post->post_content, 30, '...' ); ?> <span  class="golden-text">read more</span></p>
                    <?php } ?>
                    <p class="post-author">
                      <span class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?></span> 
                      <span class="author-name blue-text"><?php echo get_author_name($current_post->post_author); ?> </span> 
                      <span class="post-date"><?php echo get_the_date(); ?></span>
                    </p>
                </div>
                </div>
              </div>
        </a>
    </article>
    </div>
<?php    
}

?>
</div>
</div>
</div>
<?php 
    $args = array(
      'orderby' => 'id',
      'hide_empty'=> 0,
      'child_of' => 5, //Child From Boxes Category 
  );
  $categories = get_categories();
  $i = 1;
  $class = 'test';

  foreach ($categories as $cat) {

      // Get the ID of a given category
      $category_id = get_cat_ID($cat->name );

      // Get the URL of this category
      $category_link = get_category_link( $category_id );

  		  echo '<section class="container_'.$i.'">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-sm-12"><div class="category-title">'.$cat->name.'<a href="'.esc_url( $category_link ).'" class="btn-radius btn_blk btn-right">View All</a></div>';

        $num = ($i & 1)?3:4;
        $class = ($i & 1)?'post_block_2':'post_block_1';
        $args2= array('tag__not_in' => 5, "category" => $cat->cat_ID, "posts_per_page"=>$num, 'orderby' => 'post_date', 'order' => 'DESC', 'post_type' => 'post', 'post_status' => 'publish'); // Get Post from each Sub-Category
        $gutter = ($i & 2)?'gutter':'no-gutter';
        $posts_in_category = get_posts($args2);
         echo '<div class="row '. $gutter.'">';
        foreach($posts_in_category as $current_post) {
            ?>
              <?php

                if($class === 'post_block_2'){
                 ?> 
                  <div class="col-sm-4">
                  
          
                  <article class=" post-block <?php echo $class ?> ">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post->ID ), 'large' ); ?>
                    <a href="<?php echo the_permalink($current_post->ID); ?>"><figure style="background-image:url(<?php echo $image[0]; ?>)">
                    <?php echo postFirstTag($current_post->ID); ?>
                    <div class="masking"> </div>
                    </figure></a>
                     <div class="post-block__details ">
                              
                              <h2 class="post_title"><?=$current_post->post_title;?></h2>
                              <p class="post-author">
                                
                                <span class="author-name blue-text pull-left"><?php echo get_author_name($current_post->post_author); ?> </span> 
                                <span class="post-date pull-right"><?php echo get_the_date(); ?></span>
                              </p>
                      </div>
                        </article></div>

                <?php } else  {?>
                    <div class="col-sm-3 no-gutter">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post->ID ), 'large' ); ?>
                    <article class=" post-block <?php echo $class ?> " style="background-image:url(<?php echo $image[0]; ?>)">
                    <a href="<?php echo the_permalink($current_post->ID); ?>">
                        <?php echo postFirstTag($current_post->ID); ?>
                        <div class="post-block__details ">
                          <div class="post-block__details_table">
                            <div class="post-block__details_cell">
                              
                              <h2 class="post_title"><?=$current_post->post_title;?></h2>
                              <p class="post-author">
                                <span class="author-name blue-text"><?php  echo get_author_name($current_post->post_author); ?> </span> 
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                              </p>
                             
                          </div>
                          </div>
                        </div>
                        </a>
                        </article>
                        </div>

                <?php } ?>	
              
		          
            		
            	
            <?php
           

        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        $i++;
    }
?>
<div class="hp-gallery">
  <div class="container">
    <div class="row">
     
       <div class="col-xs-12 col-sm-12">
        <h5 class="section-title">Gallery <a href="/gallery" class="btn-radius btn_blk btn-right">View All</a></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
      <div class="masonry">
      <?php

      $sql = "SELECT * FROM wp_unitegallery_items WHERE type = 'image' LIMIT 8 ";
      $result = $wpdb->get_results($sql) or die(mysql_error());

          foreach( $result as $results ) {

              echo "<div class='item'>
                      <img src='".$results->url_image."' />
                        <div class='GalleryDis'> <div class='GalleryDisinside'>
                          <h6>".$results->title."</h6>
                          <p>".$results->content."</p>
                        </div> </div>
                      </div>";
          }
      //print_r($result);
      //putUniteGallery("default_gallery", "", "homepage") 
      ?>
      </div>
    </div>
  </div>
 
</div>
</div>