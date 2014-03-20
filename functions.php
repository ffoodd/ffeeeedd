<?php
/**
 * ffeeeedd : fonctions du thème - communes à l’administration et au front-end.
 * @author      Gaël Poupard
 * @link        www.ffoodd.fr
 *
 * @package     WordPress
 * @subpackage  ffeeeedd
 * @since       ffeeeedd 1.0
 */

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Options du thème
  == Traduction
  == Colonnes latérales
  == Personnaliser le logo
  == Fonctions conditionnelles
    -- Fonctions de l’administration
    -- Fonctions du front-end
*/

  /* == @section Options du thème ==================== */
  /**
   * @see Twentytwelve - Thème WordPress par défaut.
   * @see http://wordpress.org/extend/themes/twentytwelve
  */
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
  register_nav_menus( array( 'primary' => __( 'Main navigation', 'ffeeeedd' ), 'lost' => __( 'Lost menu', 'ffeeeedd' ) ) );
  if ( ! isset( $content_width ) ) { $content_width = 900; }


  /* == @section Traduction ==================== */
  /**
   * @author Luc Poupard
   * @see https://twitter.com/klohFR
   * @note I18n : déclare le domaine et l’emplacement des fichiers de traduction
   * @see Twentytwelve - Thème WordPress par défaut.
   * @link http://wordpress.org/extend/themes/twentytwelve
  */
  add_action( 'after_setup_theme', 'ffeeeedd__setup' );
  function ffeeeedd__setup() {
    load_theme_textdomain( 'ffeeeedd', get_template_directory() . '/lang' );
  }


  /* == @section Colonnes latérales ==================== */
  /**
    @author Gaël Poupard
    @see https://twitter.com/ffoodd_fr
  */
  function ffeeeedd_widgets_init() {
    // Une colonne latérale spécifique pour la page d’accueil
    register_sidebar( array(
      'name' => __( 'Home', 'ffeeeedd' ),
      'id' => 'accueil',
      'before_widget' => '<div id="%1$s" class="widget mb3 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget--title">',
      'after_title' => '</h3>',
    ) );
    // La colonne latérale pour les pages
    register_sidebar( array(
      'name' => __( 'Pages', 'ffeeeedd' ),
      'id' => 'pages',
      'before_widget' => '<div id="%1$s" class="widget mb3 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget--title">',
      'after_title' => '</h3>',
    ) );
  }
  add_action( 'widgets_init', 'ffeeeedd_widgets_init' );


  /* == @section Personnaliser le logo ==================== */
  /**
   * @note Ajoute le support de la personnalisation de l’entête,
   * @note On le détourne pour personnaliser le logo.
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   */

  if ( ! function_exists( 'ffeeeedd__logo' ) ) {
    function ffeeeedd__logo() {
      $header_args = array(
        'default-image'       => get_template_directory_uri() . '/img/logo.png',
        'width'               => 180,
        'height'              => 180,
        'flex-width'          => true,
        'flex-height'         => true,
        'random-default'      => false,
        'header-text'         => false,
        'default-text-color'  => '',
        'uploads'             => true,
      );
      add_theme_support( 'custom-header', $header_args );
    }
  }
  add_action( 'after_setup_theme', 'ffeeeedd__logo' );


  /* == @section Fonctions conditionnelles ==================== */
  /**
    @author Grégory Viguier
    @see https://twitter.com/ScreenFeedFr
    @see http://www.screenfeed.fr/blog/accelerer-wordpress-en-divisant-le-fichier-functions-php-0548/
    @note Version simple librement adaptée pour ffeeeedd
    @author Gaël Poupard
    @see https://twitter.com/ffoodd_fr
  */

  /* -- @subsection Fonctions de l’administration -------------------- */
  if ( is_admin() ) {
    get_template_part ( 'ffeeeedd__functions', '-admin' );
  }

  /* -- @subsection Fonctions du front-end -------------------- */
  if ( !is_admin() ) {
    get_template_part ( 'ffeeeedd__functions', '-front' );
  }
