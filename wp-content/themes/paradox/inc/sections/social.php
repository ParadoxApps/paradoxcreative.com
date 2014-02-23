<?php if(get_sub_field('flickrid', get_the_ID()) || get_sub_field('instagramUser', get_the_ID()) || get_sub_field('twitterUser', get_the_ID())): ?>

	<div class="container">

		<div class="row">
			
			<script type="text/javascript">
				var flickrID = "<?= get_sub_field('flickrid', get_the_ID()); ?>", instagramUser = "<?= get_sub_field('instagramUser', get_the_ID()); ?>", twitterUser = "<?= get_sub_field('twitterUser', get_the_ID()); ?>";
			</script>
			
			<div class="col-xs-12">
		
			    <ul class="social-feed centerUl">
			    	<?php if(get_sub_field('flickrid', get_the_ID())): ?>
			    		<li id="flickr-feed" class="button-feed"><i class="icon-flickr icon-4x"></i></li>
			    	<?php endif; ?>
			    	<?php if(get_sub_field('instagramUser', get_the_ID())): ?>
			        	<li id="instagram-feed" class="button-feed"><i class="icon-instagram icon-4x"></i></li>
			    	<?php endif; ?>
			    	<?php if(get_sub_field('twitterUser', get_the_ID())): ?>
			        	<li id="twitter-feed" class="button-feed"><i class="icon-twitter icon-4x"></i></li>
			    	<?php endif; ?>
			    </ul>
			    
			</div>
			
		</div>
	
	</div>
			
	<!-- START FLICKR FEED -->
	<div id="flickr" class="row feed">
	<!-- END TWITTER FEED -->		
	</div>
	
	<!-- START INSTAGRAM FEED -->
	<div id="instagram" class="row feed">
	<!-- END INSTAGRAM FEED -->
	</div>
	
	<!-- START TWITTER FEED -->
	<div id="twitter" class="row feed">
	<!-- END TWITTER FEED -->
	</div>
								         
<?php else: ?>

	<!-- warning -->
	<div>
		<h2><?php _e( 'You have selected Social Options but you added no social media!<br>Edit this and add your one or more from the available.', 'cotton' ); ?></h2>
	</div>
	<!-- /warning -->

<?php endif; ?>