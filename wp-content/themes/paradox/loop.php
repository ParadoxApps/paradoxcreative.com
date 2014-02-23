<?php 

	global $data;

	$wp_query->set('posts_per_page', $data['number_results']);
	$wp_query->query($wp_query->query_vars);

?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="row">

		<div class="col-xs-12">
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php if( get_post_format() == false ): ?>

				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
	
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						
							<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
							
						</a>
	
				<?php endif; ?>
				<!-- /post thumbnail -->	

				<?php endif; ?>
			
				<?php if( has_post_format('image')): ?>
				
					<div class="featured-post-image">
					
						<a href="<?php echo get_permalink(); ?>" class="load"><img src="<?php echo get_field('header_image',$post->ID); ?>" alt="Blog post with image"></a>
						
					</div>
					
				<?php endif; ?>
			
				<?php if( has_post_format('audio')): ?>

					<?php get_template_part('content-audio'); ?>

				<?php endif; ?>
				
				<?php if( has_post_format('video')): ?>

					<?php get_template_part('content-video'); ?>

				<?php endif; ?>
				
				<?php if( has_post_format('gallery')): ?>

					<div class="gallery-header">
						<?php get_template_part('content-gallery'); ?>
					</div>

				<?php endif; ?>
				
				<?php if( has_post_format('link')): ?>

					<?php get_template_part('content-link'); ?>

				<?php endif; ?>
				
				<div class="post-data">
			
					<!-- post title -->
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<!-- /post title -->
					
					<?php cottonwp_excerpt('cottonwp_index'); // Build your custom callback length in functions.php ?>

					<hr>
					
					<!-- post details -->
					<span class="author"><?php _e( 'written by', 'cotton' ); ?> <?php the_author(); ?></span>
					<span class="date">on <?php the_time('F j, Y'); ?></span>
					<span class="comments">/ <?php comments_popup_link( __( 'Leave your comment', 'cotton' ), __( '1 Comment', 'cotton' ), __( '% Comments', 'cotton' )); ?></span>
					<!-- /post details -->

					<?php edit_post_link('<i class="icon-edit icon-large"></i>'); ?>
			
				</div>

			</article>
			<!-- /article -->
			
		</div>
		
	</div>
	
<?php endwhile; ?>

<?php get_template_part('pagination'); ?>

<?php else: ?>

	<!-- article -->
	<article class="nothing">
		<h2><?php _e( 'Sorry, nothing to display.', 'cotton' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>