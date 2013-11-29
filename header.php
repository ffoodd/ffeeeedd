<?php
/**
 * Thème ffeeeedd
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 *
 */ ?><!DOCTYPE HTML>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="ie8 no-js"><![endif]-->
<!--[if gte IE 9]><!--><html <?php language_attributes(); ?> class="no-js" prefix="og: http://ogp.me/ns#"><!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <base href="<?php echo esc_url( home_url() ); ?>">
    <!-- La meta viewport la plus adaptée actuellement // @see : http://blog.goetter.fr/post/64389260648/windows-phone-8-0-orientation-et-initial-scale -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />
    <!-- Métas Facebook simples -->
      <meta property="og:title" content="<?php esc_attr( wp_title( '-', true, 'right' ) ); ?>" />
      <meta property="og:site_name" content="<?php esc_attr( bloginfo( 'name' ) ); ?>" />
      <meta property="og:type" content="article" />
      <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>" />
    <!-- /Fin des métas Facebook simples -->
    <!-- Métas Twitter simples -->
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:url" content="<?php echo esc_url( get_permalink() ); ?>">
      <meta name="twitter:title" content="<?php esc_attr( wp_title( '-', true, 'right' ) );?>" />
      <?php if ( get_the_author_meta( 'twitter', 1 ) ) { ?>
      <meta name="twitter:creator" content="<?php esc_attr( the_author_meta( 'twitter', 1 ) ); ?>" />
      <?php } ?>
    <!-- /Fin des métas Twitter simples -->
    <!-- Métas DublinCore simples -->
      <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
      <meta name="dcterms.title" lang="<?php esc_attr( bloginfo( 'language' ) ); ?>" content="<?php esc_attr( wp_title( '-', true, 'right' ) ); ?>" />
      <meta name="dcterms.identifier" content="<?php echo esc_url( get_permalink() ); ?>" />
      <meta name="dcterms.type" content="text" />
      <meta name="dcterms.subject" lang="<?php esc_attr( bloginfo( 'language' ) ); ?>" content="HTML, document, Dublin Core" />
      <meta name="dcterms.language" content="<?php esc_attr( bloginfo( 'language' ) ); ?>" />
    <!-- /Fin des métas DublinCore simples -->
    <?php if ( get_the_author_meta( 'google', 1 ) ) { ?>
    <!-- Authentification de l'auteur sur Google+ -->
    <link rel="author" href="<?php esc_url( the_author_meta('google', 1 ) ); ?>">
    <!-- / Fin de l'authentification de l'auteur sur Google+ -->
    <?php } ?>
    <link rel="alternate" type="application/rss+xml" title="<?php esc_attr( bloginfo( 'name' ) ); ?> | <?php _e( 'RSS feed', 'ffeeeedd' ); ?>" href="<?php esc_url( bloginfo( 'rss2_url' ) ); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> role="document" itemscope itemtype="http://schema.org/WebPage">

    <ul class="mw--site center pl1 pr1 mt0 pt0 print-hidden" id="top">
      <li class="inbl smaller m-reset">
        <a class="skip" href="<?php echo get_permalink(); ?>#nav"><?php _e( 'Skip to navigation', 'ffeeeedd' ); ?></a></li>
      <li class="inbl smaller m-reset">
        <a class="skip" href="<?php echo get_permalink(); ?>#content"><?php _e( 'Skip to content', 'ffeeeedd' ); ?></a></li>
    </ul>

    <header class="w--site center" role="banner">
      <?php if ( get_header_image() ) { ?>
      <a href="<?php echo esc_url( home_url() ); ?>" title="<?php esc_attr( bloginfo( 'name' ) ); ?>" itemprop="url">
        <img src="<?php esc_url( header_image() ); ?>" class="left" id="logo" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" itemprop="image"/>
      </a>
      <?php } ?>
      <h1 itemprop="name"><?php bloginfo( 'name' ); ?></h1>
      <h2 itemprop="description"><?php bloginfo( 'description' ); ?></h2>
    </header><!-- / banner -->

    <nav class="mw--site center clear print-hidden" id="nav" role="navigation">
      <?php if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'items_wrap' => '<ul class="%2$s aside p-reset m-reset ul-reset" role="menubar">%3$s</ul>',
          'container' => false)
        );
      } else {
        wp_dropdown_pages( array( 'depth' => 1 ) );
      } ?>
    </nav><!-- / #nav -->

    <main class="mw--site center" id="content" role="main" itemprop="mainContentOfPage">
      <?php if ( function_exists('ffeeeedd__ariane') && !is_front_page() ) { ffeeeedd__ariane(); } ?>
