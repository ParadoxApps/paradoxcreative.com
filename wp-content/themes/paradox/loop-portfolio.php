<?php 

$xsmall = get_field('xsmall_device_columns', get_the_ID());
$small = get_field('small_device_columns', get_the_ID());
$medium_large = get_field('medium_device_columns', get_the_ID());

?>

<?php $query = new WP_Query( array( 'posts_per_page' => get_field('portfolio_posts_per_page', get_the_ID()) , 'post_type' => 'portfolio' , 'post_status' => 'published' , 'paged' => get_query_var('paged')) ); ?>

<?php if ($query->have_posts()): ?>

	<div id="portfolio" class="row">
			<div class="col-xs-12">
				<div class="work-filter center-list">
				    <ul class="list-inline hidden-xs">
			        				        
				        <!-- Original Content -->			        
				        <li class="filter" data-filter="all">All</li>
				        <?php show_post_type_terms("category", "portfolio"); ?>
				    </ul>
				</div>
			</div>
	</div>
	<div id="work-container" class="row work-container">

		<?php while ($query->have_posts()) : $query->the_post(); ?>

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

	</div>
	
	<script>
		jQuery('#work-container').mixitup({
			targetDisplayGrid: 'block'
		});
	</script>

	<?php get_template_part('pagination'); ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2 class="nothing"><?php _e( 'Sorry, nothing to display.', 'cotton' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>