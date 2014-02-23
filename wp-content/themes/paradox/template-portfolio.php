<?php /* Template Name: Portfolio Page */ get_header(); ?>
	
	<!-- section -->
	<section class="page-section" role="main">

		<!-- header -->
		<header id="blog-header">
			<div class="align-horizontal">
				<div class="align-vertical">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3">
								<h1><?php the_title(); ?></h1>
								<h3 class="meta"><?php echo get_field('portfolio_caption', get_the_ID()); ?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- /header -->	
		
		<!-- page content -->
		<div id="page-content">
			<div class="container">
				<div class="row">
					
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
						<?php
							if ( post_password_required($post) ) {
								echo '<div class="col-xs-12 col-sm-8 col-sm-offset-2">';
								echo get_the_password_form();
								echo '</div>';
							} else {
								echo '<div class="col-xs-12">';
									get_template_part('loop-portfolio');
								echo '</div>';
							}
						?>
					<?php endwhile; endif; ?>
						
				</div>				
			</div>
		</div>
		<!-- /page content -->

	</section>
	<!-- /section -->

<?php get_footer(); ?>