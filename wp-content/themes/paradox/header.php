<?php global $data; ?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		
		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no,maximum-scale=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php if ($data['b_font'] != 'None') : ?>
			<link rel='stylesheet' href="http://fonts.googleapis.com/css?family=<?php echo $data['b_font'];?>:400,100,300,100italic,300italic,400italic,500,500italic,700,700italic,900,900italic">
		<?php endif; ?>
		
		<?php if ($data['h_font'] != 'None') : ?>
			<link rel='stylesheet' href="http://fonts.googleapis.com/css?family=<?php echo $data['h_font'];?>:400,100,300,100italic,300italic,400italic,500,500italic,700,700italic,900,900italic">
		<?php endif; ?>
		
		<?php if ($data['blog_font'] != 'None') : ?>
			<link rel='stylesheet' href="http://fonts.googleapis.com/css?family=<?php echo $data['blog_font'];?>:400,100,300,100italic,300italic,400italic,500,500italic,700,700italic,900,900italic">
		<?php endif; ?>
		
		<!-- icons -->
		<?php if ($data['favicon'] != '') : ?>
			<link href="<?php echo $data['favicon'] ?>" rel="shortcut icon">		
		<?php else: ?>
			<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<?php endif; ?>
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
				
		<script>
			var templateUrl = '<?= get_bloginfo("template_url"); ?>';
			!function(){
				// configure legacy, retina, touch requirements @ conditionizr.com
				conditionizr()
			}()
		</script>

	</head>
	<body <?php body_class(); ?>>
	
		<!-- wrapper -->
		<div id="page">
			
			<!-- START HEADER -->
			<header id="header" class="header clear" role="banner">		
				<div class="align-horizontal">
					<div class="align-vertical">
						<div id="intro" class="text-container">
							<!-- logo -->
							<div id="logo" class="logo">
								<a href="<?php echo home_url(); ?>">
								<?php if ($data['plain_text_logo'] == false):?>
									<img src="<?php echo $data['logo']; ?>" alt="Logo" class="logo-img">
								<?php else: ?>
									<h1><?php echo $data['text_logo']; ?></h1>
								<?php endif; ?>
								</a>
							</div>
							<!-- /logo -->
							<h1 id="caption"><?php echo $data['caption']; ?></h1>
							<a class="btn btn-lg view-posts scroll trans" id="sub-caption"><?php echo $data['sub_caption']; ?></a>
							<div id="explore"><a class="scroll"><i class="icon-angle-down icon-4x"></i></a></div>
						</div>
					</div>
				</div>
			<!-- END HEADER -->
			</header>
			
			<!-- START TOP-BAR -->
			<div id="top-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							
								<?php if ($data['plain_text_logo'] == false):?>
									<div id="logo-lettering">
										<a class="scroll header" href="#header"><img src="<?php echo $data['logo_lettering']; ?>" alt="Logo Lettering"/></a>
									</div>
								<?php else: ?>
									<div id="logo-lettering" class="text">
										<a class="scroll header" href="#header"><?php echo $data['text_logo']; ; ?></a>
									</div>
								<?php endif; ?>
							
							<div id="menu-mobile" class="hidden-md hidden-lg">
								<i class="icon-reorder icon-2x"></i>
							</div>
						</div>
						<div class="col-md-8">
							<nav id="top-navigation" role="navigation">
								<?php cotton_header_nav(); ?>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- END TOP-BAR -->	
			
			<!-- OFFCANVAS NAVIGATION -->
			<div id="offcanvas">
			
				<div class="show-offcanvas">
					<i class="icon-reorder icon-2x"></i>
					<i class="icon-remove icon-2x"></i>
				</div>
			
				<nav id="offcanvas-navigation">
				
					<?php get_template_part('sidebar'); ?>
					
				</nav>