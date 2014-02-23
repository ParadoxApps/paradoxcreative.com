<?php query_posts(array('posts_per_page' => -1, 'post_type' => 'sections'));

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<!-- section -->
	<section id="<?php echo str_replace(" ","-",strtolower($post->post_name)); ?>" <?php post_class(); ?> style="background-color:<?php echo get_field('background-color', get_the_ID()); ?>">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 intro">
					<?php echo edit_post_link('<i class="icon-edit icon-3x"></i>'); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		
		<?php while(has_sub_field("additional_options")): ?>
		
			<div class="row-layout">
		 
				<?php if(get_row_layout() == "team"): // layout: team ?>
			 
					<?php get_template_part('inc/sections/team'); ?>
				
				<?php elseif(get_row_layout() == "slider"): // layout: slider ?>
			 
					<?php get_template_part('inc/sections/slider'); ?>
					
				<?php elseif(get_row_layout() == "services"): // layout: services ?>
			 
					<?php get_template_part('inc/sections/services'); ?>
					
				<?php elseif(get_row_layout() == "portfolio"): // layout: portfolio ?>
			 
					<?php get_template_part('inc/sections/portfolio'); ?>
					
				<?php elseif(get_row_layout() == "social"): // layout: social ?>
					<?php get_template_part('inc/sections/social'); ?>
					
				<?php elseif(get_row_layout() == "blog"): // layout: social ?>
				
					<?php get_template_part('inc/sections/blog'); ?>
				
				<?php elseif(get_row_layout() == "contact"): // layout: social ?>
				
					<?php get_template_part('inc/sections/contact'); ?>
					
				<?php endif; ?>
				
			</div>
			 
			<?php endwhile; ?>
		
	</section>
	<!-- /section -->
	
<?php endwhile; ?>

<?php else: ?>

	<!-- section -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="nothing"><?php _e( 'Sorry, no sections to display.', 'cotton' ); ?></h2>
				</div>
			</div>
		</div>
	</section>
	<!-- /section -->

<?php endif; ?>