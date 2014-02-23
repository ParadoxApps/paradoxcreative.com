<?php 

global $data; 
$rgb = hex2rgb($data['main_color']);

?>

/* Header */

<?php if ($data['background_image'] != '') : ?>
	#header{background-image: url(<?php echo $data['background_image'] ?>);}
<?php endif; ?>

/* Colors */

h1,h2,h3,h4,h5,h6,a:hover, time, .touch #explore a i:hover,.no-touch #explore a i:hover, #top-navigation li.active a, #top-navigation li:hover a, #menu-mobile:hover i,#menu-mobile.active i, .service:hover h5, .service.active h5, .work-filter li.active, .work-filter li:hover, .button-feed.active i, .button-feed:hover i, #tweet_loader, .tweet_link, #loading, #link-header a:hover, #show-comments.active a, .page .post h2:hover a, .search .post h2:hover a, .category .post h2:hover a, .archive .post h2:hover a, .tag .post h2:hover a, .page .portfolio h2:hover a, .search .portfolio h2:hover a, .category .portfolio h2:hover a, .archive .portfolio h2:hover a, .tag .portfolio h2:hover a, .contact:hover .icon a i, .show-offcanvas i.icon-remove, #offcanvas-navigation a, .show-offcanvas i{color:<?php echo $data['main_color']; ?>}

#logo h1{font-family: 'Helvetica'; font-size: 72px; letter-spacing: normal;margin-top:0;color:white;}
#logo-lettering.text{font-family: 'Helvetica';font-size: 30px;font-weight: bold;color:white;}

.view-posts a{color:white;}

select, .expand, .view-posts:hover, #submit:hover, .page-numbers.current, .page-numbers:hover, #contacts .btn, .jp-interface, .jp-play:hover, .jp-pause:hover, .jp-mute:hover, .jp-unmute:hover, .jp-play-bar, .jp-volume-bar-value{background-color:<?php echo $data['main_color']; ?>}

::selection{background: <?php echo $data['main_color']; ?>}
::-webkit-selection{background: <?php echo $data['main_color']; ?>}
::-moz-selection{background: <?php echo $data['main_color']; ?>}

.member-hover{background-color: rgba(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>,0);}
.member-photo:hover .member-hover{background-color: rgba(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>,0.5);}
.th:hover, .th:focus {-webkit-box-shadow: 0 0 6px 1px rgba(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>,0.5);box-shadow: 0 0 6px 1px rgba(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>,0.5);}

#next-project-name, #previous-project-name{background-color: rgb(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>); background-color: rgba(<?php print_r($rgb[0]); ?>,<?php print_r($rgb[1]); ?>,<?php print_r($rgb[2]); ?>,1);}

/* Fonts */

h1,h2,h3,h4,h5,h6,.single-post .post h1.post-title{font-family: '<?php echo $data['h_font'];?>';}

body, #submit, .contact-label, #offcanvas-navigation .sidebar-widget h3, #offcanvas-navigation form.search input{font-family: '<?php echo $data['b_font'];?>';}

.single-post .post h1, .single-post .post h2, .single-post .post h3, .single-post .post h4, .single-post .post h5, .single-post .post h6, .single-post .post p{font-family: '<?php echo $data['blog_font'];?>';}

/* Custom CSS */

<?php echo $data['custom_css']; ?>