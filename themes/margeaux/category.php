<?php
/**
 * The template for displaying Category Archive pages.
 *
*
* @package WordPress
* @subpackage Margeaux
* @since Margeaux 1.0
*/

get_header(); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 10, 'paged' => $paged );
query_posts($args);?>
<?php get_sidebar(); ?>
<div id="container"  class="news_width">
	<div id="content" role="main">
		<h2 class="entry-title">News</h2>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
					<hr>
				<div class="date_panel"><p><?php the_date('m.d.y') ?></p></div>
				<div class="news">
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

									<!-- <div class="entry-meta">
														<?php // twentyten_posted_on(); ?>
													</div> --><!-- .entry-meta -->

									<div class="entry-content">
										<?php the_content(); ?>
										
									</div><!-- .entry-content -->

				

									<div class="entry-utility">
									&nbsp;
									</div><!-- .entry-utility -->
								</div><!-- #post-## -->

	</div> <!-- news -->
				<?php endwhile; // end of the loop. ?>
			
			<?php  // numeric_pagination();  ?>
			<div id="nav-below" class="navigation archive_pagination">
				 <?php the_posts_pagination( array(
				    'mid_size' => 2,
				    'prev_text' => __( '&larr; Previous', 'twentyten' ),
				    'next_text' => __( 'Next &rarr;', 'twentyten' ),
				) ); ?> </div>
			</div><!-- #nav-below -->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
