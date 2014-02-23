<?php 

$xsmall = get_sub_field('xsmall_device_columns', get_the_ID());
$small = get_sub_field('small_device_columns', get_the_ID());
$medium_large = get_sub_field('medium_device_columns', get_the_ID());
$portfolio_link = get_sub_field('portfolio_page', get_the_ID());
$id = get_the_ID();

$query_portfolio = new WP_Query(array('posts_per_page' => -1, 'post_type' => 'portfolio'));

if ( $query_portfolio->have_posts() ) : ?>

<div class="container">

	<!--<div id="portfolio" class="row">
			<div class="col-xs-12">
				<div class="work-filter center-list">
				    <ul class="list-inline hidden-xs">
				        <li class="filter active" data-filter="all">All</li>
				        <?php show_post_type_terms("category", "portfolio"); ?>
				    </ul>
				</div>
			</div>
	</div>-->
	<div id="work-container" class="row work-container">

		<?php while ( $query_portfolio->have_posts() ) : $query_portfolio->the_post(); ?>
		
			<?php 	
			
				$terms = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
				$categories;
				if ($terms) {
					foreach($terms as $term) {
						$categories = $categories .  ""  . $term->slug . ' '; 
					}
				}
			?>
			
			<div class="col-xs-<?php echo $xsmall ?> col-sm-<?php echo  $small ?> col-md-<?php echo $medium_large ?> mix all <?php echo $categories ?>">
				<a href="<?php the_permalink(); ?>" class="load" title="<?php the_title(); ?>">
					<div class="work">
						<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
								<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
						<?php endif; ?>
						<div class="work-info">
							<h3><?php the_title(); ?></h3>
						</div>
					</div>
				</a>
			</div>	
			
			<?php $categories=""; ?>
		<?php endwhile; ?>
		
		<?php if ( $portfolio_link ) : ?> 
			</div>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-lg view-posts"><a href="<?php echo $portfolio_link ?>" class="load">All Projects</a></button>
				</div>
		<?php endif; ?>
		
	</div>
</div>
	
	<script>
		jQuery('#work-container').mixitup({
			targetDisplayGrid: 'block' // required to fix bug in Chrome with images height
		});
	</script>


<?php else: ?>

	<!-- warning -->
	<div>
		<h2><?php _e( 'You have selected Portfolio Section but there are no projects added yet!<br>Go to Portfolio tab in the admin panel and add some projects.', 'cotton' ); ?></h2>
	</div>
	<!-- /warning -->

<?php endif; ?>