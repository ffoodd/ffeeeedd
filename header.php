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
        <!-- Métas Facebook simples -->
            <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('', true); ?>" />
            <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
            <meta property="og:type" content="article" />
            <meta property="og:url" content="<?php echo get_permalink(); ?>" />
        <!-- Fin des métas Facebook simples -->
        <!-- Métas Twitter simples -->
            <meta name="twitter:card" content="summary">
            <meta name="twitter:url" content="<?php echo get_permalink(); ?>">
            <meta name="twitter:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('', true); ?>">
            <?php if ( get_the_author_meta('twitter', 1) ) : ?>
                <meta name="twitter:creator" content="<?php the_author_meta('twitter', 1); ?>">
            <?php endif; ?>
        <!-- Fin des métas Twitter simples -->
        <!-- Métas DublinCore simples -->
            <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
            <meta name="DC.title" lang="fr" content="<?php is_front_page() ? bloginfo('name') : wp_title('', true); ?>" />
            <meta name="DC.identifier" content="<?php echo get_permalink(); ?>" />
            <meta name="DC.type" content="text" />
            <meta name="DC.subject" lang="fr" content="HTML, document, Dublin Core" />
            <meta name="DC.language" scheme="DCTERMS.RFC4646" content="fr-FR" />
        <!-- Fin des métas DublinCore simples -->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> role="document" itemscope itemtype="http://schema.org/WebPage">
        
        <ul class="w960p center p-reset print-hidden">
            <li class="inbl smaller m-reset"><a href="#nav" class="skip">Aller au menu</a></li>
            <li class="inbl smaller m-reset"><a href="#content" class="skip">Aller au contenu</a></li>
        </ul>
        
        <header role="banner" class="w960p center">
            <a href="<?php bloginfo( 'url' ); ?>" itemprop="url" title="<?php bloginfo( 'name' ); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" id="logo" class="left" itemprop="image"/></a>
            <h1 itemprop="name"><?php bloginfo('name'); ?></h1>
            <h2 itemprop="description"><?php bloginfo( 'description' ); ?></h2>            
        </header>
        
        <nav role="navigation" id="nav" class="mw960p center clear print-hidden">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="%2$s p-reset">%3$s</ul>', 'container' => false ) ); ?>
		</nav>
        
        <div role="main" id="content" class="mw960p center" itemprop="mainContentOfPage">
            <?php if (function_exists('ariane') && !is_front_page()) { ariane(); } ?>
