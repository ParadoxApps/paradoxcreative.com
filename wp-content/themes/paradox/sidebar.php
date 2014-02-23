<!-- sidebar -->

<?php get_template_part('searchform'); ?>

<?php cotton_sidebar_nav(); ?>

<div class="sidebar-widget">
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
</div>
		
<!-- /sidebar -->