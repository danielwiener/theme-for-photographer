<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
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
			
				<div id="nav-below" class="navigation">
					<?php // using a plugin https://github.com/keesiemeijer/date-archives-pagination ?>
					<div class="nav-previous"> <?php dap_previous_posts_link('&larr; Previous');  ?></div><div class="nav-next"><?php dap_next_posts_link('Next &rarr;'); ?> </div>
				</div><!-- #nav-below -->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
