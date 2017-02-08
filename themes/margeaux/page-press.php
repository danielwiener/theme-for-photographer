<?php
/*
Template Name: Press Page
*/
/**
 * The template for displaying the children pages of About Margeaux.
 *
 *
 * @package WordPress
 * @subpackage Margeaux
 * @since Margeaux 1.0
 */

get_header(); ?>
<?php // get_sidebar('about');
?>
		<div id="container"  class="single-attachment">
			<div id="content" role="main">
				
			<?php
				global $post;

				$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'date') );
				// var_dump($images);
				?>
				
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						
						<?php 
						$press_images = '';
						$large_images = '';
						$count = 1;
						foreach ($images as $image) :
						$img_title = $image->post_title;   // title.
						$img_description = $image->post_content; // description.
						$img_caption = $image->post_excerpt; // caption.
						$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
						$preview_array = image_downsize( $image->ID, 'tn-200' );
			 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview
						$pattern = '/_still/';
						$jpg = '/jpg/';
						$upload_directory = wp_upload_dir();
						$upload_url = $upload_directory['baseurl']; //gets uploads without month and year
						$image_metadata =	wp_get_attachment_metadata( $image->ID ); //get an array of info about attachment
						$image_path = ($image_metadata['file']); //get image path e.g. 2009/11/name_of_image.jpg
						$image_extension = stripExtension($image_path); //see functions.php 
						$get_image_name = '/(20[0-9][0-9])\/([0-9][0-9])\/(.*)\.\w{3}$/'; // regex to get the year and month and name of image from path
						?>
						<?php 	$press_images .= '<dl class="press-item"><dt class=""><a href="' .  $img_description . '" id="image_' . $count . '" target="_blank"><img src="' . $img_preview . '"></a></dt>';
						$press_images .= '<dd class="wp-caption-text gallery-caption"><a href="' .  $img_description . '">' . $img_caption . '</a></dd></dl>';
						$press_images .= "\n";
						 ?>
				<?php endforeach; ?>
				<div id='gallery-1' class='gallery'>
						<?php 
						echo $press_images;?>
						</div>
						<?php 
						// the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
