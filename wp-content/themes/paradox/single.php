<?php get_header(); ?>

	<!-- header image -->
	<?php if( has_post_format('image')): ?>
		<header id="post-header">
			<img src="<?php echo get_field('header_image',$post->ID); ?>" />
		</header>
	<?php endif; ?>
	<!-- /header image -->
	
	<?php if( has_post_format('audio')): ?>
		<?php get_template_part('content-audio'); ?>
	<?php endif; ?>
	
	<?php if( has_post_format('video')): ?>
		<div id="video-header">
			<div class="video-container">
				<?php get_template_part('content-video'); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php if( has_post_format('gallery')): ?>
		<div id="gallery-header">
			<?php get_template_part('content-gallery'); ?>
		</div>
	<?php endif; ?>
	
	<?php if( has_post_format('link')): ?>
		<?php get_template_part('content-link'); ?>
	<?php endif; ?>
	
	<!-- section -->
	<section class="post-section" role="main">
		
		<?php if ( have_posts() ): while (have_posts()) : the_post(); ?>
				
			<div class="container">
			
				<div class="row">
			
					<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
					
						<?php
							$next_post = get_next_post();
							$previous_post = get_previous_post();
						?>
					
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
							
							<div id="post-details">
							
								<?php echo edit_post_link('<i class="icon-edit icon-3x"></i>'); ?>
								
								<!-- post title -->
								<h1 class="post-title">
									<?php the_title(); ?>
								</h1>
								<!-- /post title -->
								
								<hr>
								
								<!-- post details -->
								<span class="author"><?php _e( 'written by', 'cotton' ); ?> <?php the_author(); ?></span>
								<span class="date">on <?php the_time('F j, Y'); ?></span>
								<!-- <span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'cotton' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span> -->
								<!-- /post details -->
							
							</div>
							
							<?php the_content(); // Dynamic Content ?>
							
							<?php if ($previous_post != '') { ?>
								<div id="previous-post">
									<a href="<?php echo get_permalink( $previous_post->ID ); ?>" class="load">
										<i class="icon-angle-left icon-3x"></i>
										<!-- <div><h6 id="project-title"><?php echo $previous_post->post_title; ?></h6></div> -->
									</a>
								</div>
							<?php } ?>
							
							<?php if ($next_post != '') { ?>
								<div id="next-post">
									<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="load" >
										<i class="icon-angle-right icon-3x"></i>
										<!-- <div><h6 id="project-title" style="float: right;"><?php echo $next_post->post_title; ?></h6></div> -->
									</a>
								</div>
							<?php } ?>
							
							<div id="show-comments">
								<a href="#make-comment" class="scroll">
									<i class="icon-comments icon-2x"></i>
								</a>
							</div>						
							
	<!--
							<?php the_tags( __( 'Tags: ', 'cotton' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
							
							<span><?php _e( 'Categorised in: ', 'cotton' ); the_category(', '); // Separated by commas ?></span>
	-->
							
						</article>
						<!-- /article -->
						
						<div id="make-comment">
							
							<hr>
							
							<?php comment_form(array('title_reply' => 'Leave a comment', 'comment_notes_after' => ' ', 'comment_notes_before' => ' ')); ?>
						
						</div>
						
					</div>
				</div>
			</div>
		
			<?php comments_template(); ?>
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h1><?php _e( 'Sorry, nothing to display.', 'cotton' ); ?></h1>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
		
	</section>
	<!-- /section -->

<?php get_footer(); ?>