<?php
/*
Template Name: Project, Animation with Still
*/
/**
 * The template for displaying the Project Pages.
 * To be paired images must be named imagename.gif and imagename_still.jpg or THIS WILL NOT WORK. Very hard to pair up the images in an array. based on the name    	
 * of the image. 
 * @package WordPress
 * @subpackage Margeaux
 * @since Margeaux 1.0
 */

get_header(); ?>
<?php get_sidebar('project');
?>
		<div id="container" class="news_width">
			<div id="content" role="main">
				
					<?php
					global $post;

					$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
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
						$pinkies = '';
						$large_images = '';
						$count = 1;
						foreach ($images as $image) :
						$img_title = $image->post_title;   // title.
						$img_description = $image->post_content; // description.
						$img_caption = $image->post_excerpt; // caption.
						$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
						$preview_array = image_downsize( $image->ID, 'pinky' );
			 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview
						$pattern = '/_still/';
						$jpg = '/jpg/';
						$upload_directory = wp_upload_dir();
						$upload_url = $upload_directory['baseurl']; //gets uploads without month and year
						$image_metadata =	wp_get_attachment_metadata( $image->ID ); //get an array of info about attachment
						$image_path = ($image_metadata['file']); //get image path e.g. 2009/11/name_of_image.jpg
						$image_extension = stripExtension($image_path); //see functions.php 
						$get_image_name = '/(20[0-9][0-9])\/([0-9][0-9])\/(.*)\.\w{3}$/'; // regex to get the year and month and name of image from path
						
						if(preg_match($get_image_name, $image_path, $image_matches)) {
							$image_year = $image_matches[1];
							$image_month = $image_matches[2];
							$image_name = $image_matches[3];
						}
							?>
			<?php // if (!preg_match($pattern, $image_name)): ?>
			<?php if (preg_match($jpg, $image_extension)): ?>
				
			<?php 	$pinkies .= '<a href="' .  $img_url . '" id="image_' . $count . '"><img src="' . $img_preview . '" width="40" height="40"></a>';
			$pinkies .= "\n";
			 ?>
			<?php endif; ?>
				<?php 
				if (!preg_match($pattern, $image_path) && $image_extension == 'gif') {
						$large_count = $count+1;
						$large_images .= '<div class="these_images" id=image_' . $large_count . '>';
						$large_images .= '<ul>';
						$large_images .= '<li><img src="' . $img_url . '"></li>';
					 	$large_images .= '<li class="center_image"><img src="' . $upload_url .'/'. $image_year . '/' . $image_month . '/' . $image_name . '_still.jpg"></li>';
						$large_images .= '</ul>';
						$large_images .= '<div  class="anim_title">' . $img_title . '</div>';
			 			$large_images .= '</div>';
						$large_images .= "\n" ;
				} elseif (!preg_match($pattern, $image_path) && $image_extension == 'jpg') {
						$large_images .= '<div class="these_images" id=image_' . $count . '>';
						$large_images .= '<ul>';
						$large_images .= '<li><img src="' . $img_url .'"></li>';
						$large_images .= '</ul>';
						$large_images .= '<div class="anim_title">' . $img_title . '</div>';
				 		$large_images .= '</div>';
						$large_images .= "\n" ;
				}
				$count++;
				?>
				<?php endforeach; 
				echo "\n" ?>
				<div id="pinkies">	
				<?php echo $pinkies . "\n"; ?>
				</div>
				<div id="anim_and_stills">
				<?php echo $large_images . "\n"; ?></div>
				<?php the_content();?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
