<?php
/*
Template Name: Recent Project Image Grid
*/
/**
 * The template for displaying the Thumbnails of the 10 most recent Project Pages in a Grid.
 *
 *
 * @package WordPress
 * @subpackage Margeaux
 * @since Margeaux 1.0
 */

get_header(); ?>

		<div id="container" class="single-attachment">
			<div id="content" role="main">
				
	
		<div id="image_grid">
			<ul>		
<?php 
	$recent_args = array(
		'posts_per_page' => 10,
		'post_type' => 'page',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'post_parent' => 14,
		'meta_key' => '_dw_display_front_page',
		'meta_value' => 'on',
		'orderby' => 'menu_order',
		'order' => 'ASC'
		);
	query_posts($recent_args);
	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php $external_link = get_post_meta($post->ID, '_dw_external_page', true); ?> 
		   <?php if ( $external_link ): ?>
		   	    	<li><a href="<?php echo $external_link; ?>" target="_blank"><?php the_post_thumbnail('thumbnail'); ?><br />
				<?php the_title(); ?></a></li>
				<?php else: ?>
					 <li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?><br />
				<?php the_title(); ?></a></li>
		  <?php endif ?>
<?php endwhile; ?>
</ul>
</div> <!-- #image_grid -->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
