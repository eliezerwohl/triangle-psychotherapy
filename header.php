<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon">
	<title><?php wp_title('&raquo;','true','right'); ?><?php bloginfo('name'); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/styles/new.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-12877947-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-12877947-12');
</script>


	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php if(is_front_page()){ ?>
	<header role="banner" class="hidden-xs">
		<div id="logo">
	  	<img src="<?php bloginfo('template_url'); ?>/images/triangle.png" alt="Site logo"/>  
		</div>
		<div id="title_wrapper">
				<!-- Site Title -->
				<h1 id="site_title">
					<?php the_field("site_title", "option"); ?>
				</h1>
				<!-- Site Slogan -->
				<h2 id="site_slogan">
					<?php the_field("site_slogan", "option"); ?>
				</h2>
				
		</div>
	</header>
		<nav id="navbar" class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand  visible-xs" href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/triangle-mobile.png" alt="Site logo"/> Triangle Psychotherapies</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                // 'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'mobile-fix nav nav-justified',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?> 
	    
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<?php } else { ?>
	<div id="pageHeader" class="header">
	
	<div class="hidden-xs"> 	
	<h2><a href="<?php echo home_url(); ?>"> <img id="pageTriangle" src="<?php bloginfo('template_url'); ?>/images/triangle.png" alt="Site logo"/><?php the_field("site_title", "option"); ?></a></h2>
	</div>
	<nav id="navbar" class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand  visible-xs" href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/triangle-mobile.png" alt="Site logo"/> Triangle Psychotherapies</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                // 'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'mobile-fix nav nav-justified',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?> 
	    
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>		

	
	<?php } ?>		
	<div id="main">
	<div id="scroll_up_button" style="display: none;">
		<i class="fa fa-angle-up"></i>
	</div>