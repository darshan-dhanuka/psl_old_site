<?php

	/*

		Template Name: Gallery

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
			 <div class="row">
			 <?php
			 	 global $wpdb;
			 	/*$sql = "SELECT count(id) as cnt FROM wp_unitegallery_galleries";
					$galleryCount = $wpdb->get_row($sql) or die(mysql_error());

					if ($galleryCount->cnt) {

						$sql = "SELECT id, title, alias, params FROM wp_unitegallery_galleries ORDER BY ordering ASC";
						$galleries = $wpdb->get_results($sql) or die(mysql_error());

				      	// get category id of each gallery
				      	$categoryIds = array_map(function ($gallery) {
				      		$params = json_decode($gallery->params, true);
				      		return $params['categories'];
				      	}, $galleries);

				      	$categoryIds = array_filter($categoryIds, function ($id) {
				      		if (!empty($id)) return $id;
				      	});

				      	// get each album cover images
				      	$sql = "SELECT url_image, catid FROM wp_unitegallery_items WHERE catid IN (" . join(',', $categoryIds) . ") AND type = 'image' GROUP BY catid";
				      	$coverImages = $wpdb->get_results($sql) or die(mysql_error());

				      	$coverImageList = [];
				      	foreach ($coverImages as $coverImage) {
				      		$coverImageList[$coverImage->catid] = $coverImage->url_image;
				      	}

						foreach( $galleries as $gallery ) {
				      		$params = json_decode($gallery->params, true);
				      		$coverImg = isset($coverImageList[$params['categories']]) ? "background:url('".$coverImageList[$params['categories']]."') no-repeat;" : '';


				      	*/
			  		include_once "pagination.php";

			  		$curPage = basename($_SERVER['PHP_SELF']);
				    $page = is_numeric($curPage) ? $curPage : 1;
						
					$setLimit = 12;
					$pageLimit = ($page * $setLimit) - $setLimit;

					$sql = "SELECT id, title, alias, params FROM wp_unitegallery_galleries ORDER BY ordering ASC LIMIT ".$pageLimit." , ".$setLimit;
					$galleries = $wpdb->get_results($sql);

					if (count($galleries)) {
						// get category id of each gallery
				      	$categoryIds = array_map(function ($gallery) {
				      		$params = json_decode($gallery->params, true);
				      		return $params['categories'];
				      	}, $galleries);

				      	$categoryIds = array_filter($categoryIds, function ($id) {
				      		if (!empty($id)) return $id;
				      	});

				      	// get each album cover images
				      	$sql = "SELECT url_image, catid FROM wp_unitegallery_items WHERE catid IN (" . join(',', $categoryIds) . ") AND type = 'image' GROUP BY catid";
				      	$coverImages = $wpdb->get_results($sql);

				      	$coverImageList = [];
				      	foreach ($coverImages as $coverImage) {
				      		$coverImageList[$coverImage->catid] = $coverImage->url_image;
				      	}


				      	foreach( $galleries as $gallery ) {
				      		$params = json_decode($gallery->params, true);
				      		$coverImg = isset($coverImageList[$params['categories']]) ? "background:url('".$coverImageList[$params['categories']]."') no-repeat;" : '';
				    ?>
						<div class="col-sm-4 col-xs-6">
				            <div class="galleryBox">
				              <a href="/gallery/details?id=<?php echo $gallery->alias; ?>" class="gallboxinside" style="<?php echo $coverImg; ?>">
				                <div class="gallCon"> <h4> <?php echo $gallery->title; ?></h4> </div>
				              </a>
							</div>
		            	</div>
					
			            
			     	<?php 
			     		} 
			     	} else {
			     		?>
			     		<div class="no-record">Currently there is no album found!"<br /><a href="/gallery/">Gallery</a></div>

			     		<?php
			     	}
			     	?>
			</div>
			<div class="row">

				
					<?php 
					$table = 'wp_unitegallery_galleries';
						echo displayPaginationBelow($table, '/gallery/', $setLimit, $page);
					?>
			</div>
           



            


		</div>
	</section>
	
<?php include_once('recent_posts.php'); ?>
		
            
<?php get_footer(); ?>