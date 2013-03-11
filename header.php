<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="ie8" lang="fr-FR" class="no-js"><![endif]--> 
<!--[if gte IE 9]><!--><html lang="fr-FR" class="no-js"><!--<![endif]-->
	<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8"/>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>	  	
		<meta name="viewport" content="width=device-width" />
        <meta name="description" content="<?php wp_title(''); ?> | <?php bloginfo( 'description' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon"/>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> role="document" itemscope itemtype="http://schema.org/WebPage">
        
        <ul class="w960p center p-reset print-hidden">
            <li class="inbl smaller m-reset"><a href="#nav" class="skip">Aller au menu</a></li>
            <li class="inbl smaller m-reset"><a href="#content" class="skip">Aller au contenu</a></li>
        </ul>
        
        <div role="search" class="w960p center txtright print-hidden">
            <?php get_search_form(); ?>
        </div>
        
        <header role="banner" class="w960p center row">
            <h2 class="col w25 p-reset" itemprop="name"><a href="<?php bloginfo( 'url' ); ?>" class="ir inbl" itemprop="url" id="logo"><?php bloginfo('name'); ?></a></h2>
            <h1 class="col p-reset" itemprop="description"><?php bloginfo( 'description' ); ?></h1>            
        </header>
        
        <nav role="navigation" id="nav" class="mw960p center print-hidden">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="%2$s p-reset">%3$s</ul>', 'container' => false ) ); ?>
		</nav>
        
        <div role="main" id="content" class="mw960p center" itemprop="mainContentOfPage">
            <?php if (function_exists('ariane') && !is_front_page()) { ariane(); } ?>