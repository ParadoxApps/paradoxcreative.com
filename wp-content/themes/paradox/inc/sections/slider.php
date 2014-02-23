<div class="row">

	<?php if(get_sub_field('images', get_the_ID())):
	
		$images = get_sub_field('images', get_the_ID()); ?>
		
		<div class="col-xs-12">
			<div id="swiper-container-<?php echo get_the_ID();?>" class="swiper-container">
				<div class="swiper-wrapper">
					<?php if( $images ): ?>
				        <?php foreach( $images as $image ): ?>
				            <div class="swiper-slide"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
				        <?php endforeach; ?>
				    <?php endif; ?>
				</div>
			</div>
		</div>
		
		<script>
			var swiper = {};
			swiper[<?php echo get_the_ID();?>] = new Swiper('#swiper-container-<?php echo get_the_ID();?>',{
				loop:true,
				grabCursor: true
			})
			/* On Load swiper height should adjust to img size */
			jQuery('#swiper-container-<?php echo get_the_ID();?> .swiper-slide img').load(function() {
				jQuery('#swiper-container-<?php echo get_the_ID();?>').height(jQuery('#swiper-container-<?php echo get_the_ID();?> .swiper-slide img').height());
			});
		</script>
						         
	<?php else: ?>
	
		<!-- warning -->
		<div>
			<h2><?php _e( 'You have selected Slider Options but your slider seems to be empty!<br>Edit this and add some images to the slider.', 'cotton' ); ?></h2>
		</div>
		<!-- /warning -->
	
	<?php endif; ?>
	
</div>

