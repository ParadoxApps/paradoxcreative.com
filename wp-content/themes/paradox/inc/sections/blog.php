<div class="container">

	<div id="featured-posts-container" class="row">
	
	<?php 
	
	$xsmall = get_sub_field('xsmall_device_columns', get_the_ID());
	$small = get_sub_field('small_device_columns', get_the_ID());
	$medium_large = get_sub_field('medium_device_columns', get_the_ID());
	$blog_link = get_sub_field('blog_page', get_the_ID());

	echo get_field('posts_to_display', get_the_ID());
	
	$query_posts = new WP_Query(array('posts_per_page' => get_sub_field('posts_to_display', get_the_ID()), 'post_type' => 'post'));
	
	if ( $query_posts->have_posts() ) : ?> 
	
			<?php while ( $query_posts->have_posts() ) : $query_posts->the_post(); ?>
					
				<div class=" featured-post col-xs-<?php echo $xsmall ?> col-sm-<?php echo  $small ?> col-md-<?php echo $medium_large ?>">
				
					<?php if( has_post_format('image')): ?>
						<div class="featured-post-image">
							<a href="<?php echo get_permalink(); ?>" class="load"><img src="<?php echo get_field('header_image',$post->ID); ?>" alt="Blog post with image"></a>
						</div>
					<?php endif; ?>
					
					<?php if( has_post_format('audio')): ?>
						<div class="featured-post-audio">
							<?php get_template_part('content-audio'); ?>
						</div>
					<?php endif; ?>	
					
					<?php if( has_post_format('video')): ?>
						<div class="featured-post-video">
							<?php get_template_part('content-video'); ?>
						</div>
					<?php endif; ?>		
					
					<?php if( has_post_format('gallery')): ?>
						<div class="featured-post-gallery">
							<?php get_template_part('content-gallery'); ?>
						</div>
					<?php endif; ?>		
					
					<?php if( has_post_format('link')): ?>
						<div class="featured-post-link">
							<?php get_template_part('content-link'); ?>
						</div>
					<?php endif; ?>			
						
					<div class="featured-post-info">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<hr>
						<p>written by <span class="author"><?php the_author(); ?></span></p>
						<p><span class="date">on <?php the_time('F j, Y'); ?> <!-- <?php the_time('g:i a'); ?> --></span></p>
						<span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'cotton' ), __( '<i class="icon-comments"></i> 1 Comment', 'cotton' ), __( '% Comments', 'cotton' )); ?></span>
					</div>
				</div>				
					
			<?php endwhile; ?>
			
			<?php wp_reset_postdata(); ?>
			
			<?php if ( $blog_link ) : ?> 
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button class="btn btn-lg view-posts"><a href="<?php echo $blog_link ?>" class="load">All Posts</a></button>
					</div>
			<?php endif; ?>
		
	<?php else: ?>
	
		<!-- warning -->
		<div>
			<h2><?php _e( 'You have selected Blog Options but there are no posts added yet!<br>Add some blog posts.', 'cotton' ); ?></h2>
		</div>
		<!-- /warning -->
	
	<?php endif; ?>
	
	</div>

</div>