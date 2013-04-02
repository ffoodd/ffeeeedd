<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="ie8" <?php language_attributes(); ?> class="no-js"><![endif]--> 
<!--[if gte IE 9]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head profile="http://dublincore.org/documents/2008/08/04/dc-html/">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8"/>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>	  	
		<meta name="viewport" content="width=device-width" />
        <meta name="description" content="<?php wp_title(''); ?> | <?php bloginfo( 'description' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon"/>
        <!-- Métas Facebook -->
            <meta property="og:title" content="<?php wp_title(); ?>" />
            <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
            <meta property="og:type" content="article" />
            <meta property="og:url" content="<?php echo get_permalink(); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
        <!-- Fin des métas Facebook -->
        <!-- Métas Twitter -->
            <meta name="twitter:card" content="summary">
            <meta name="twitter:url" content="<?php echo get_permalink(); ?>">
            <meta name="twitter:title" content="<?php wp_title(); ?>">
            <meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
            <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/img/logo.png">
            <meta name="twitter:creator" content="@ffoodd_fr">
        <!-- Fin des métas Twitter -->
        <!-- Métas DublinCore -->
            <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
            <meta name="DC.title" content="<?php wp_title(); ?>" />
            <meta name="DC.description" content="<?php bloginfo( 'description' ); ?>" />
            <meta name="DC.identifier" content="<?php echo get_permalink(); ?>" />
            <meta name="DC.type" content="text" />
        <!-- Fin des métas DublinCore -->
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
            <a href="<?php bloginfo( 'url' ); ?>" itemprop="url"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" id="logo" class="left" itemprop="image"/></a>
            <h1 class="col w25 p-reset" itemprop="name"><?php bloginfo('name'); ?></h1>
            <h2 class="col p-reset" itemprop="description"><?php bloginfo( 'description' ); ?></h2>            
        </header>
        
        <nav role="navigation" id="nav" class="mw960p center print-hidden">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="%2$s p-reset">%3$s</ul>', 'container' => false ) ); ?>
		</nav>
        
        <div role="main" id="content" class="mw960p center" itemprop="mainContentOfPage">
            <?php if (function_exists('ariane') && !is_front_page()) { ariane(); } ?>
