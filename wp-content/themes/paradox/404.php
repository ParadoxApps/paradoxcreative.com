<?php get_header(); ?>

	
	<div class="container content">

		<div class="align-horizontal">

			<div class="align-vertical">

				<div class="row">

					<div class="col-xs-12">
			
						<!-- section -->
						<section role="main">
						
							<!-- article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
								<h1><?php _e( 'Wow, you got lost on a single page!<br>How is that even possible?', 'cotton' ); ?></h1>
								<h2>
									<a href="<?php echo home_url(); ?>"><?php _e( 'Go home!', 'html5blank' ); ?></a>
								</h2>
								
							</article>
							<!-- /article -->
							
						</section>
						<!-- /section -->

					</div>

				</div>

			</div>

		</div>

	</div>