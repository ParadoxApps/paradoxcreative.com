<?php global $data; ?>

			<!-- footer -->
			<footer id="footer" role="contentinfo">
			
				<div class="container">
				
					<div class="row">
					
						<div class="col-xs-12 col-sm-6 col-sm-offset-3">

							<div id="social-profiles">
								<ul class="centerUl">
									<?php
									$layout = $data['social-organize']['visible'];
									
									if ($layout):
									
									foreach ($layout as $key=>$value) {
									
									    switch($key) {
									
										    case 'facebook-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['facebook'];?>" target="_blank"><i class="icon-facebook icon-2x"></i></a></li>
										
										    <?php
										    break;
										    case 'twitter-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['twitter'];?>" target="_blank"><i class="icon-twitter icon-2x"></i></a></li>
										
										    <?php
										    break;
										    case 'linkedin-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['linkedin'];?>" target="_blank"><i class="icon-linkedin icon-2x"></i></a></li>
										
										    <?php
										    break;
										    case 'google-plus-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['google-plus'];?>" target="_blank"><i class="icon-google-plus icon-2x"></i></a></li>
										
										    <?php
										    break;
										    case 'instagram-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['instagram'];?>" target="_blank"><i class="icon-instagram icon-2x"></i></a></li>
										
										    <?php
										    break;
										    case 'flickr-block':
										    ?>
										    
										    	<li><a href="<?php echo $data['flickr'];?>" target="_blank"><i class="icon-flickr icon-2x"></i></a></li>
										
										    <?php
										    break;
									    									
									    }
									
									}
									
									endif;
									?>

								</ul>
							</div>
														
							<!-- copyright -->
							<p class="copyright">
								<?php echo $data['copyright_text'] ?>
							</p>
							<!-- /copyright -->
							
						</div>
						
					</div>
					
				</div>
				
			</footer>
			<!-- /footer -->
		
		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>
		
		<!-- analytics -->
		<?php echo $data['google_analytics']; ?>
		
		<!-- LiveChat -->
		<script type="text/javascript">
		var __lc = {};
		__lc.license = 3639611;
		
		(function() {
			var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
			lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
		})();
		</script>		
	
	</body>
</html>