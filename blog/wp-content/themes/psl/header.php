<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" />
 <link rel="icon" type="image/png" sizes="32x32" href="https://d3rrji2dvvcisw.cloudfront.net/images/favicon-32x32.png">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	

	<header class="header">
<nav>
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-3 logo" >
        <a href="/"><img src="https://d3rrji2dvvcisw.cloudfront.net/images/logo.png" alt=""></a>
      </div>
            <div class="col-xs-6 col-sm-9">
        <div class="loginSec">
        <ul class="social">
            <li><a target="_blank" href="https://www.facebook.com/PokerSportsLeague" class="fbIcn"></a></li>
            <li><a target="_blank" href="https://plus.google.com/112677926005716550074" class="gplusIcn"></a></li>
            <li><a target="_blank" href="https://twitter.com/PSL_Ind" class="twitIcn"></a></li>
          </ul>
          <ul class="logs">
                      <li><a href="/login">Login</a></li>
            <li><a href="/register">register</a></li>
                      </ul>
          
        </div>
              <div class="navSec">
        <div class="mobilemenu"></div>
          <ul>
          <li><a href="https://www.pokersportsleague.com/">Home</a></li>
            <li><a href="javascript:;">About PSL</a><span class="dropListOpn"></span>
            <ul class="submenu">
              <li><a href="https://www.pokersportsleague.com/about-psl">The Concept</a></li>
              <li><a href="https://www.pokersportsleague.com/team-structure">Team Structure</a></li>
            </ul>
            </li>
            <li><a href="https://www.pokersportsleague.com/#mentor" class="mentorLnk">Mentors</a></li>
            <li><a href="https://www.pokersportsleague.com/player-application">Player Application</a></li>
            <li><a href="https://www.pokersportsleague.com/teams">Teams</a></li>
            <li><a href="javascript:;">Leaderboard</a><span class="dropListOpn"></span>
            <ul class="submenu">
                      <li><a href="https://www.pokersportsleague.com/leaderboard/live">Live</a></li>
                      <li><a href="https://www.pokersportsleague.com/leaderboard/online">Online</a></li>
                  </ul>
            </li>
              <li><a href="javascript:;">Schedule</a><span class="dropListOpn"></span>
                  <ul class="submenu">
                      <li><a href="https://www.pokersportsleague.com/schedule/live-qualifier">Live Qualifier</a></li>
                      <li><a href="https://www.pokersportsleague.com/schedule/online-qualifier">Online Qualifier</a></li>
                  </ul>
              </li>
            <li><a href="/blog">Blog</a></li>
          </ul>
        </div>

    </div>
  </div>
</nav>
</header>
<!-- #masthead -->
<section id="blog-navbar">
  <div class="container">
  <ul class="nav navbar-nav">
    <li><a href="/blog">Blog Home</a></li>
    <li>
    <a href="javascript:void(0);">Category</a>
    <ul>
      <?php 
      $categories = get_categories(); 
      foreach ( $categories as $category ) {
          printf( '<li><a href="%1$s">%2$s</a></li>',
              esc_attr( '/blog/category/' . $category->category_nicename ),
              esc_html( $category->cat_name ),
              esc_html( $category->category_count )
          );
      }
      ?>
    </ul>
    </li>
    <li><a href="/blog/gallery">Gallery</a></li>
  </ul>
  <div class="search-form hidden-xs">
    <form role="search" method="get" id="searchform"
      class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <div>
          <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
          <input type="text" class="search-field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="s" />
          <input type="submit" id="searchsubmit"
              value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
      </div>
    </form>
  </div>
  </div>
</section>
	

	<div class="site-content-contain">
		<div id="content" class="site-content">
