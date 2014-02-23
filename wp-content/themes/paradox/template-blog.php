<?php /* Template Name: Blog Page */ get_header(); ?>
	
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
								<h3 class="meta"><?php echo get_field('blog_caption', get_the_ID()); ?></h3>
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
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						<?php get_template_part('loop-post'); ?>	
					</div>					
				</div>				
			</div>
		</div>
		<!-- /page content -->

	</section>
	<!-- /section -->

<?php get_footer(); ?>