<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Margeaux Walter
 * @since Margeaux Walter 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_enqueue_script("jquery"); 
	wp_head();
?>
<script type="text/javascript" src="<?php bloginfo("stylesheet_directory"); ?>/js/yourScript.js"></script>


<?php if (is_date()) : ?>
	<script type="text/javascript">
jQuery.noConflict();
// when the DOM is ready
jQuery(document).ready(function($)  {
	$('#menu-item-23').addClass('current-menu-item'); //highlights News when a date is clicked
});
</script>
<?php endif; ?>

	<script type="text/javascript">
jQuery.noConflict();
// when the DOM is ready
jQuery(document).ready(function($)  {
	$('#anim_and_stills').find('.these_images').hide(); 
	$('#anim_and_stills').find('.these_images:eq(0)').fadeIn();
	$("#pinkies a").click(function (event) {
		event.preventDefault();
		var image_id = this.id;
		// console.log(image_id);
		var image_id_with_hash = "#" + image_id;
		$('#anim_and_stills').find('.these_images').hide();
		// console.log(image_id_with_hash);
		$('#anim_and_stills').find(image_id_with_hash).fadeIn(); 
		
	});
	
});
</script>

<script type="text/javascript">

jQuery.noConflict();
// when the DOM is ready
jQuery(document).ready(function($)  {
	$('#loader').removeClass('loading'); //so the loading animation does not appear when the page first appears.
$("#projects a").click(function (event) {
// 	$(this).hide();
$("#main_image img").hide();
var the_large_image = this.href;
// var height = the_large_image.height();
$('#loader').addClass('loading');
 var img = new Image();
  
  // wrap our new image in jQuery, then:
  $(img)
    // once the image has loaded, execute this code
    .load(function () {
      $(this).hide();
      $('#loader').removeClass('loading').append(this);
      $(this).fadeIn();
    })
    .error(function () {
    })
    .attr('src', the_large_image);
	var sometitle = $(this).find('img').attr('title');
	// alert(sometitle);
	$("#image_title").html(sometitle);
	event.preventDefault();
	// console.log($(img));
	// 	console.log(the_large_image);
	// console.log(height);
});
	
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a>
				
				</<?php echo $heading_tag; ?>>
				

			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?><div id="site-description"><div id="fb-root"></div>
				<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo get_permalink(); ?>" show_faces="false" layout="button_count" width="450"></fb:like></div>
			</div><!-- #access --> 
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">