<?php 
/**
 * The template for displaying gallery post format
 */ 
 ?>
 
<?php $images = get_field('gallery_images', get_the_ID()); ?>
<div id="swiper-container-<?php echo get_the_ID();?>" class="swiper-container">
	<div class="swiper-wrapper">
		<?php if( $images ): ?>
	        <?php foreach( $images as $image ): ?>
	            <div class="swiper-slide"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
	        <?php endforeach; ?>
	    <?php endif; ?>
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