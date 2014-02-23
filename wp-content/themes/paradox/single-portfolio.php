<?php get_header(); ?>
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php
			$next_post = get_next_post();
			$previous_post = get_previous_post();
		?>
	
		<!-- START PROJECT-TOP-BAR -->
		<div id="project-top-bar">
			<div class="col-xs-2">
				<?php if ($previous_post != '') { ?>
					<a href="<?php echo get_permalink( $previous_post->ID ); ?>" class="load"><div id="previous-project"><i class="icon-chevron-left icon-2x"></i></div></a>
					<div id="previous-project-name" style="left: 8em; opacity: 0;"><h2 id="project-title"><?php echo $previous_post->post_title; ?></h2></div>
				<?php } ?>
			</div>
			<div class="col-xs-8">			
				<div class="show-offcanvas">
					<i class="icon-reorder icon-2x"></i>
					<i class="icon-remove icon-2x"></i>
				</div>			
			</div>
			<div class="col-xs-2">
				<?php if ($next_post != '') { ?>
					<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="load"><div id="next-project"><i class="icon-chevron-right icon-2x"></i></div></a>
					<div id="next-project-name"><h2 id="project-title"><?php echo $next_post->post_title; ?></h2></div>
				<?php } ?>
			</div>
		<!-- END PROJECT-TOP-BAR -->
		</div>	

		<?php if (get_field('header_image', $post->ID) || get_field('header_video', $post->ID) ) { ?>

			<div id="project-header">
				<?php if (get_field('header_type',$post->ID) == 'Image'): ?>
					<img src="<?php the_field('header_image', $post->ID) ?>" alt="<?php the_title();?> Header"/>
				<?php elseif(get_field('header_type',$post->ID) == 'Video'): ?>
					<div class="video-container">
						<?php echo $GLOBALS['wp_embed']->autoembed( get_field('header_video',$post->ID) );?>
					</div>
				<? endif; ?>

			</div>
		<?php } ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" >
		
			<div id="project-details" <?php post_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-sm-offset-1">
							<h2 id="project-title"><?php the_title();?></h2>
							<p id="project-client"><?php the_field('client', $post->ID);?></p>
							<p id="project-categories"><?php _e( 'Categories: ', 'cotton' ); the_category(', ');?></p>
							<p id="project-tags"><?php the_tags( __( 'Tags: ', 'cotton' ), ', ', '<br>'); ?></p>
							<?php echo edit_post_link('<i class="icon-edit icon-2x"></i>'); ?>
						</div>
						<div class="col-xs-12 col-sm-7 end">
							<?php the_content();?>
						</div>
					</div>
				</div>
			</div>
		
						
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h1><?php _e( 'Sorry, nothing to display.', 'cotton' ); ?></h1>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>

<?php get_footer(); ?>