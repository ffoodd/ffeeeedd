<?php
/**
 * ffeeeedd : fonctions du thème
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
  == Classes sur la navigation
    -- Retire les classes générées
    -- Ajoute une classe aux parents
  == Liens générés
  == Gestion des extraits
    -- Ajoute un lien "Lire la suite"
    -- Remplace le "[...]" par une ellipse et le lien "Lire la suite"
    -- Ajoute le lien "Lire la suite" si l'extrait n'est pas généré mais renseigné
  == Ajout d'Open Graph pour le Doctype
  == <footer> pour les articles
  == Injection des scripts et styles
    -- Ajouter les scripts et styles via wp_head()
    -- Utiliser la dernière version de jQuery sur le CDN Google
    -- Créer les éléments html5 pour IE8 et -
    -- Tester l'activation du js
    -- Réponse aux commentaires
  == Minification du HTML
  == Fil d'Ariane
    -- Récupère les catégories parentes et y ajoute les microdonnées
    -- On génère le fil d'Ariane
  == Pagination
  == Commentaires
    -- Gère l'affichage des commentaires
    --  Ajout des types de champs HTML5 url et email sur les commentaires, et de l'attribut HTML5 required sur le nom et l'email
    -- Ajout de l'attribut HTML5 required sur le textarea
  == Colonnes latérales
  == Référencement Social / SEO
    -- Création des blocs dans l'administration
    -- Ajout des champs utiles dans ces blocs
    -- Sauvegarder la valeur de ces champs
    -- Ajoute les métas 'Description' dans le <head>
    -- Modifie la valeur des métas 'Title' dans le <head>
  == Profil utilisateur
  == Personnaliser le logo
  == Ajout des métas Image dans le <head>
*/

  /* == @section Options du thème ==================== */
  /**
   * @see Twentytwelve - Thème WordPress par défaut.
   * @see http://wordpress.org/extend/themes/twentytwelve
  */

  add_theme_support( 'post-thumbnails' );
  register_nav_menus( array( 'primary' => 'Menu principal' ) );


  /* == @section Traduction ==================== */
  /**
   * @author Luc Poupard
   * @see https://twitter.com/klohFR
   * @note I18n : déclare le domaine et l'emplacement des fichiers de traduction
   * @see Twentytwelve - Thème WordPress par défaut.
   * @link http://wordpress.org/extend/themes/twentytwelve
  */
  add_action( 'after_setup_theme', 'ffeeeedd__setup' );
  function ffeeeedd__setup() {
    load_theme_textdomain( 'ffeeeedd', get_template_directory() . '/lang' );
  }


  /* == @section Classes sur la navigation ==================== */
 /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Retire la mutltitude de classes générées par WordPress et inutiles; ajoute les classes permettant d'identifier les parents directs ou indirects, et autorise l'ajout de la classe "inbl" de Knacss depuis l'administration.
  */

  /* -- @subsection Retire les classes générées - sauf les 'current_page' - par Wordpress sur le menu principal -------------------- */
  add_filter( 'nav_menu_css_class', 'ffeeeedd__css_attributes_filter', 100, 1 );
  add_filter( 'nav_menu_item_id', 'ffeeeedd__css_attributes_filter', 100, 1 );
  add_filter( 'page_css_class', 'ffeeeedd__css_attributes_filter', 100, 1 );
  function ffeeeedd__css_attributes_filter( $var ) {
    return is_array( $var ) ? array_intersect( $var, array( 'current_page_item', 'current-page-ancestor', 'inbl' ) ) : '';
  }

  /* -- @subsection Ajoute une classe aux parents dans la navigation -------------------- */
  add_filter( 'wp_nav_menu_objects', 'ffeeeedd__parents__classe' );
  function ffeeeedd__parents__classe( $items ) {
    $parents = array();
    foreach ( $items as $item ) {
      if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
        $parents[] = $item->menu_item_parent;
      }
    }
    foreach ( $items as $item ) {
      if ( in_array( $item->ID, $parents ) ) {
        $item->classes[] = 'parent';
      }
    }
    return $items;
  }


  /* == @section Liens générés ==================== */
  /* @note Désactive les liens et scripts inutiles générés par Wordpress */
  automatic_feed_links( false );
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
  remove_action( 'wp_head', 'wp_dlmp_l10n_style' );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );


  /* == @section Gestion des extraits ==================== */
  /**
   * @note Tiré de Twentyeleven - Ancien thème WordPress par défaut
   * @see http://theme.wordpress.com/themes/twentyeleven/
   */

  /* -- @subsection Ajoute un lien "Lire la suite" après l'extrait -------------------- */
  function ffeeeedd__extrait__lien() {
    return ' <a href="' . esc_url( get_permalink() ) . '">' . __( 'Lire l\'article «&nbsp;' ) . get_the_title() . ( '&nbsp;» <span class="meta-nav">&rarr;</span>' ) . '</a>';
  }

  /* -- @subsection Remplace le "[...]" ajouté automatiquement aux extraits par une ellipse et le lien "Lire la suite" -------------------- */
  function ffeeeedd__extrait_auto( $more ) {
    return ' &hellip;' . ffeeeedd__extrait__lien();
  }
  add_filter( 'excerpt_more', 'ffeeeedd__extrait_auto' );

  /* -- @subsection Ajoute le lien "Lire la suite" si l'extrait n'est pas généré mais renseigné -------------------- */
  function ffeeeedd__extrait_custom( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
      $output .= ffeeeedd__extrait__lien();
    }
    return $output;
  }
  add_filter( 'get_the_excerpt', 'ffeeeedd__extrait_custom' );


  /* == @section Ajout d'Open Graph pour le Doctype ==================== */
  /**
   * @author Jonathan Buttigieg
   * @see https://twitter.com/GeekPressFR
   * @see http://www.geekpress.fr/wordpress/tutoriel/ajouter-meta-open-graph-facebook-theme-wordpress-593/
   */
  function ffeeeedd__opengraph( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
  }
  add_filter( 'language_attributes', 'ffeeeedd__opengraph' );


  /* == @section <footer> pour les articles ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note inspiré de la fonction "twentytwelve_entry_meta" du thème Twentytwelve, enrichie par mes soins de microdonnées, de la date de dernière modification et avec un format de date Français.
   * @see http://wordpress.org/extend/themes/twentytwelve
   */
  if ( ! function_exists( 'ffeeeedd__meta' ) ) :
    function ffeeeedd__meta() {
      // Liste des catégories & tags avec un séparateur.
      $categories_list = get_the_category_list( ( ', ' ) );
      $tag_list = get_the_tag_list( '', ( ', ' ) );
      // On génère le contenu en fonction des informations disponibles ( mots-clés, catégories, auteur ).
      if ( '' != $tag_list ) {
        echo '<p>' . __( 'Article rédigé par', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">' . get_the_author() . '</a> ' . __( 'et publié dans', 'ffeeeedd' ) . ' <span itemprop="keywords">' . $categories_list . '.</span><br />' . __( 'Mots-clés', 'ffeeeedd' ) .' : <span itemprop="keywords">' . $tag_list . '.</span></p>';
      } elseif ( '' != $categories_list ) {
        echo '<p>' . __( 'Article rédigé par', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">' . get_the_author() . '</a> ' . __( 'et publié dans', 'ffeeeedd' ) . ' <span itemprop="keywords">' . $categories_list . '.</span></p>';
      } else {
        echo '<p>' . __( 'Article rédigé par', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">' . get_the_author() . '</a>.</p>';
      }
      // On génère la date de dernière modification
      echo '<p class="print-hidden">' . __( 'Édité le', 'ffeeeedd' ) . ' <time class="updated" datetime="' . the_modified_date( 'Y-m-d' ) . '" itemprop="dateModified">' . the_modified_date() . '</time>.</p>';
  }
  endif;


  /* == @section Injection des scripts et styles ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note inspiré du thème Twentytwelve.
   * @see http://wordpress.org/extend/themes/twentytwelve
   */

  /* -- @subsection Ajouter les scripts et styles via wp_head() -------------------- */
  add_action( 'wp_enqueue_scripts', 'ffeeeedd__script' );
  function ffeeeedd__script() {
    // À employer en dev, script.js est indenté, lisible et les fonctions/variables ont des intitulés compréhensibles.
    //wp_register_script( 'site', get_template_directory_uri().'/script.js', false, null, false );
    // À utiliser en prod, fichier minifié et obscurci. Ajouter la date ou la version pour la mise en cache.
    //wp_register_script( 'site', get_template_directory_uri().'/script.20130103.min.js', false, null, false );
    //wp_enqueue_script( 'site' );

    // À employer en dev, style.css utilise @import pour améliorer la compréhension de l'architecture css.
    wp_register_style( 'all', get_stylesheet_directory_uri().'/style.css', '', null, 'all' );
    // À utiliser en prod, fichier minifié. Ajouter la date ou la version pour la mise en cache.
    //wp_register_style( 'all', get_stylesheet_directory_uri().'/style.20130103.min.css', '', null, 'all' );
    wp_enqueue_style( 'all' );
  }

  /* -- @subsection Utiliser la dernière version de jQuery sur le CDN Google, si besoin ! -------------------- */
  /*if( !is_admin() ) {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, null, false );
    wp_enqueue_script( 'jquery' );
  }*/

  /* -- @subsection Créer les éléments html5 pour IE8 et - -------------------- */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Inspiré par deux astuces croisées sur le web :
   * @see http://tweetpress.fr/codewp/detection-navigateur-wordpress/
   * @author Julien Maury
   * @see https://twitter.com/TweetPressFr
   * @see https://github.com/mlbli/HTML5forIE
   * @author Matthias Le Brun
   * @see https://twitter.com/_mlb
   */
  function ffeeeedd__ie_html5 () {
    // On commence par tester s'il s'agit bien d'IE à l'aide d'une variable globale proposée par WordPress
    global $is_winIE;
    if( $is_winIE ) {
      // Puis on ajoute, dans un commentaire conditionnel, le script magique
      echo '<!--[if lt IE 9]>';
      echo '<script>a="header0footer0section0aside0nav0article0figure0figcaption0hgroup0time0mark".split(0);for(i=a.length;i--;)document.createElement(a[i]);</script>';
      echo '<![endif]-->';
    }
  }
  add_action( 'wp_head', 'ffeeeedd__ie_html5' );

  /* -- @subsection Tester l'activation du js -------------------- */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Inspiré par Modernizr
   * @author http://modernizr.com/
   * @see http://modernizr.github.io/Modernizr/annotatedsource.html#section-103
  */
  function ffeeeedd__test_js () {
    echo "<!-- Test de l'activation du javascript -->";
    echo "<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/g,'')+'js';</script>";
    echo "<!-- Fin du test de l'activation du javascript -->";
  }
  add_action( 'wp_head', 'ffeeeedd__test_js' );

  /* -- @subsection Réponse aux commentaires -------------------- */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
  wp_enqueue_script( 'comment-reply' );


  /* == @section Minification du HTML ==================== */
  /**
   * @author Jonathan Buttigieg
   * @see https://twitter.com/GeekPressFR
   * @see http://www.geekpress.fr/wordpress/astuce/minifier-html-sans-plugin-1566/
   */

  /*add_action('get_header', 'ffeeeedd__minif');
  function ffeeeedd__minif() {
    ob_start( 'end_minif' );
  }
  function end_minif( $html ) {
    // Suppression des commentaires HTML, sauf les commentaires conditionnels pour IE
    // À n'utiliser qu'en prod
    $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);
    // Suppression des espaces vides
    $html = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $html );
    while ( stristr( $html, '  ' ) )
    $html = str_replace( '  ', ' ', $html );
    return $html;
  }*/


  /* == @section Fil d'Ariane ==================== */
  /**
   * @author Daniel Roch
   * @see https://twitter.com/rochdaniel
   * @see http://www.seomix.fr/fil-dariane-chemin-navigation/
   * @see http://support.google.com/webmasters/bin/answer.py?hl=fr&answer=185417
   * @note Modifications :
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Prise en compte des formats d'articles, corrections des intitulés pour les taxonomies, et mise en place des microdonnées au lieu des microformats.
  */

  /* -- @subsection Récupère les catégories parentes et y ajoute les microdonnées -------------------- */
  function ffeeeedd__categories( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
    $final = '';
    $parent = &get_category( $id );
    if (is_wp_error( $parent ) )
      return $parent;
    if ( $nicename )
      $name = $parent->name;
    else
      $name = $parent->cat_name;
    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
      $visited[] = $parent->parent;
      $final .= ffeeeedd__categories( $parent->parent, $link, $separator, $nicename, $visited );
    }
    if ( $link )
      $final .= '<a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de ' . $parent->cat_name . '" itemprop="url"><span itemprop="title">' . $name . '</span></a>' . $separator;
    else
      $final .= $name . $separator;
    return $final;
  }

  /* -- @subsection On génère le fil d'Ariane -------------------- */
  function ffeeeedd__ariane() {

    // Variables globales
    global $wp_query;
    $paged = get_query_var( 'paged' );
    $sep = ' &rarr; ';
    $final = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="print-hidden">';
    $startdefault = '<a title="' . get_bloginfo( 'name' ) . '" href="' . home_url() . '" itemprop="url"><span itemprop="title">' . get_bloginfo( 'name' ) . '</span></a>';
    $starthome = get_bloginfo( 'name' );

    // Début du fil d'Ariane
    if ( is_front_page() && is_home() ) {
      // Accueil par défaut
      if ( $paged >= 1 )
        $final .= $startdefault;
      else
        $final .= $starthome;
    } elseif ( is_front_page() ) {
      // Accueil statique ( page statique définie )
      $final .= $starthome;
    } elseif ( is_home() ) {
      // Page de blog ( liste des articles )
      if ( $paged >= 1 ) {
        $url = get_page_link( get_option( 'page_for_posts' ) );
        $final .= $startdefault . $sep . '<a href="' . $url . '" itemprop="url" title="Les articles"><span itemprop="title">Les articles</span></a>';
      } else $final .= $startdefault . $sep . 'Les articles';
    } else {
      // Pour tout le reste
      $final .= $startdefault . $sep;
    }

    // Empêche d'autre(s) code(s) d'interférer avec l'accueil statique ou blog
    if ( is_front_page() && is_home() ) { } elseif ( is_front_page() ) { } elseif ( is_home() ) { }

    //  Fichiers attachés
    elseif ( is_attachment() ) {
      global $post;
      $parent = get_post( $post->post_parent );
      $id = $parent->ID;
      $category = get_the_category( $id );
      $category_id = get_cat_ID( $category[0]->cat_name );
      $permalink = get_permalink( $id );
      $title = $parent->post_title;
      $final .= ffeeeedd__categories( $category_id, true, $sep ) . "<a href='$permalink' itemprop'url' title='$title'><span itemprop='title'>$title</span></a>" . $sep . the_title('', '', false );
    }

    // Type(s) d'articles
    elseif ( is_single() && !is_singular( 'post' ) ) {
      global $post;
      $nom = get_post_type( $post );
      $archive = get_post_type_archive_link( $nom );
      $mypost = $post->post_title;
      $label = get_post_type_object( $nom )->labels->name;
      $final .= '<a href="' . $archive . '" itemprop="url" title="' . $label . '"><span itemprop="title">' . $label . '</span></a>' . $sep . $mypost;
    }

    // Articles avec un format
    elseif ( is_single() && has_term('', 'post_format') ) {
      global $post;
      $format = get_post_format( $post->ID );
      $pretty_format = get_post_format_string( $format );
      $format_link = get_post_format_link( $format );
      $mypost = $post->post_title;
      $final .= '<a href="' . $format_link . '" itemprop="url" title="' . $pretty_format . '"><span itemprop="title">' . $pretty_format . '</span></a>' . $sep . $mypost;
    }

    // Articles sans format
    elseif ( is_single() && !has_term('', 'post_format') ) {
      // Catégories d'articles
      $category = get_the_category();
      $category_id = get_cat_ID( $category[0]->cat_name );
      if ( $category_id != 0 )
        $final .= ffeeeedd__categories( $category_id, true, $sep );
      elseif ($category_id == 0) {
        $post_type = get_post_type();
        $tata = get_post_type_object( $post_type );
        $titrearchive = $tata->labels->menu_name;
        $urlarchive = get_post_type_archive_link( $post_type );
        $final .= '<a href="' . $urlarchive . '" title="' . $titrearchive . '" itemprop="url"><span itemprop="title">' . $titrearchive . '</span></a>';
      }
      // Avec des pages de commentaires
      $cpage = get_query_var( 'cpage' );
      if ( is_single() && $cpage > 0 ) {
        global $post;
        $permalink = get_permalink( $post->ID );
        $title = $post->post_title;
        $final .= '<a href="' . $permalink . '" itemprop="url" title="' . $title . '"><span itemprop="title">' . $title . '</span></a>';
        $final .= $sep . 'Commentaires page ' . $cpage;
      }
      // Sans pages de commentaires
      else
        $final .= the_title( '', '', false );
    }

    // Catégories
    elseif ( is_category() ) {
      // Variables
      $categoryid = $GLOBALS['cat'];
      $category = get_category( $categoryid );
      $categoryparent = get_category( $category->parent );
      // Résulat
      if ( $category->parent != 0 )
        $final .= ffeeeedd__categories( $categoryparent, true, $sep, true );
      if ( $paged <= 1 )
        $final .= single_cat_title( '', false );
      else
        $final .= '<a href="' . get_category_link( $category ) . '" title="Voir tous les articles de ' . single_cat_title( '', false ) . '" itemprop="url"><span itemprop="title">' . single_cat_title( '', false ) . '</span></a>';
    }

    // Pages
    elseif ( is_page() && !is_home() ) {
      $post = $wp_query->get_queried_object();
      // Page simple
      if ( $post->post_parent == 0 )
        $final .= the_title( '', '', false );
      // Page avec ancêtre(s)
      elseif ( $post->post_parent != 0 ) {
        $title = the_title( '', '', false );
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        array_push( $ancestors, $post->ID );
        $count = count ( $ancestors ); $i=0;
        foreach ( $ancestors as $ancestor ) {
          if( $ancestor != end( $ancestors ) ) {
            $name = strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) );
            $final .= '<a title="' . $name . '" href="' . get_permalink( $ancestor ) . '" itemprop="url"><span itemprop="title">' . $name . '</span></a>';
            $i++;
            if ( $i < $ancestors )
              $final .= $sep;
          }
          else
            $final .= strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) );
        }
      }
    }

    // Auteurs
    elseif ( is_author() ) {
      if( get_query_var( 'author_name' ) )
        $curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
      else
        $curauth = get_userdata( get_query_var( 'author' ) );
      $final .= 'Articles de l\'auteur ' . $curauth->nickname;
    }

    // Tags
    elseif ( is_tag() ) {
      $final .= 'Articles sur le th&egrave;me ' . single_tag_title( '', false );
    }

    // Formats
    elseif ( is_tax( 'post_format' ) ) {
      $format = get_post_format( $post->ID );
      $pretty_format = get_post_format_string( $format );
      $final .= $pretty_format;
    }

    // Recherche
    elseif ( is_search() ) {
      $final .= 'R&eacute;sultats de votre recherche sur "' . get_search_query() . '"';
    }

    // Dates
    elseif ( is_date() ) {
      if ( is_day() ) {
        $year = get_year_link( '' );
        $final .= '<a title="' . get_query_var( 'year' ) . '" href="' . $year . '" itemprop="url"><span itemprop="title">' . get_query_var( 'year' ) . '</span></a>';
        $month = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
        $final .= $sep . '<a title="' . single_month_title( ' ', false ) . '" href="' . $month . '" itemprop="url"><span itemprop="title">' . single_month_title( ' ', false ) . '</span></a>';
        $final .= $sep . 'Archives pour ' . get_the_date();
      }
      elseif ( is_month() ) {
        $year = get_year_link( '' );
        $final .= '<a title="' . get_query_var( 'year' ) . '" href="' . $year . '" itemprop="url"><span itemprop="title">' . get_query_var( 'year' ) . '</span></a>';
        $final .= $sep . 'Archives pour ' . single_month_title( ' ', false );
      }
      elseif ( is_year() )
        $final .= 'Archives pour ' . get_query_var( 'year' );
    }

    // Page 404
    elseif ( is_404() )
      $final .= '404 - Page non trouv&eacute;e';

    // Archives - autres
    elseif ( is_archive() ) {
      $posttype = get_post_type();
      $posttypeobject = get_post_type_object( $posttype );
      $taxonomie = get_taxonomy( get_query_var( 'taxonomy' ) );
      $titrearchive = $posttypeobject->labels->menu_name;
      if ( !empty( $taxonomie ) )
        $final .= $taxonomie->labels->name;
      else
        $final .= $titrearchive;
    }

    // Pagination
    if ( $paged >= 1 )
      $final .= $sep . 'Page ' . $paged;

    // The End
    $final .= '</div>';
    echo $final;
  }


  /* == @section Pagination ==================== */
  /**
   * @author Jonathan Buttigieg
   * @see https://twitter.com/GeekPressFR
   * @see http://www.geekpress.fr/wordpress/astuce/pagination-wordpress-sans-plugin-52/
  */

  if( !function_exists( 'ffeeeedd__pagination' ) ) {
    function ffeeeedd__pagination() {
      global $wp_query, $wp_rewrite;
      $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
      $pagination = array(
        'base'      => @add_query_arg( 'page', '%#%' ),
        'format'    => '',
        'total'     => $wp_query->max_num_pages,
        'current'   => $current,
        'show_all'  => false,
        'end_size'  => 1,
        'mid_size'  => 2,
        'type'      => 'list',
        'next_text' => '&rarr;',
        'prev_text' => '&larr;'
      );
      if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
      if( !empty( $wp_query->query_vars['s'] ) )
        $pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );
      echo str_replace( 'page/1/', '', paginate_links( $pagination ) );
    }
  }


  /* == @section Commentaires ==================== */
  /**
   * @author Luc Poupard
   * @see https://twitter.com/klohFR
   * @note Personnalise l'affichage des commentaires, ajout des microdonnées, et amélioration de l'accessibilité du formulaire avec les attributs et rôles ARIA.
  */

  /* -- @subsection Gère l'affichage des commentaires -------------------- */
  if ( !function_exists( 'ffeeeedd_comment' ) ) :
    // Template pour les commentaires & pingbacks.
    function ffeeeedd_comment( $comment, $args, $depth ) {
      $GLOBALS['comment'] = $comment;
      switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // On affiche différemment les trackbacks. ?>
          <li <?php comment_class(); ?>>
            <p><?php _e( 'Pingback :', '' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Modifier)', '' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php break;
      default :
      // On passe aux commentaires standards.
      global $post; ?>
      <li itemscope itemtype="http://schema.org/UserComments">
        <article role="article">
          <header>
            <?php echo get_avatar( $comment, 44 );
            printf( '<cite itemprop="creator">%1$s %2$s</cite>',
              get_comment_author_link(),
              ( $comment->user_id === $post->post_author ) ? '<small> (' .  __( 'Rédacteur', 'ffeeeedd' ) . ' ) </small>' : ''
            );
            printf( '<time datetime="%2$s" itemprop="commentTime">%3$s</time>',
              esc_url( get_comment_link( $comment->comment_ID ) ),
              get_comment_time( 'c' ),
              sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
            ); ?>
          </header>

          <?php if ( '0' == $comment->comment_approved ) : ?>
          <p><?php echo __( 'Votre commentaire est en attente de modération', 'ffeeeedd' ); ?>.</p>
          <?php endif; ?>

          <section itemprop="commentText">
            <?php comment_text(); ?>
            <?php edit_comment_link( __( 'Modifier', '' ), '<p>', '</p>' ); ?>
          </section>

          <div class="reply" itemprop="replyToUrl">
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Répondre', '' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div>
        </article>
      <?php break;
      endswitch;
    }
  endif;

  /* -- @subsection Ajout des types de champs HTML5 url et email sur les commentaires, et de l'attribut HTML5 required sur le nom et l'email -------------------- */
  add_filter( 'comment_form_defaults', 'fields_html5' );
  if ( !function_exists( 'fields_html5' )) {
    function fields_html5( $fields ) {
      // Type author
      $fields['fields']['author'] = '
      <p class="comment-form-author">
        <label for="author">' . __( 'Name' ) . ' <span class="required">*</span></label>
        <input id="author" name="author" value="" aria-required="true" required="required" size="30" type="text" />
      </p>';
      // Type email
      $fields['fields']['email'] = '
      <p class="comment-form-email">
        <label for="email">' . __( 'Email' ) . ' <span class="required">*</span></label>
        <input id="email" name="email" value="" aria-required="true" required="required" size="30" type="email" />
      </p>';
      // Type url et placeholder http://
      $fields['fields']['url'] = '
      <p class="comment-form-url">
        <label for="url">' . __( 'Website' ) . '</label>
        <input id="url" name="url" value="" placeholder="http://" size="30" type="url" />
      </p>';
      return $fields;
    }
  }

  /* -- @subsection Ajout de l'attribut HTML5 required sur le textarea -------------------- */
  add_filter( 'comment_form_defaults', 'changing_comment_form_defaults' );
  function changing_comment_form_defaults( $defaults ) {
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';
    return $defaults;
  }


  /* == @section Colonnes latérales ==================== */
  /**
    @author Gaël Poupard
    @see https://twitter.com/ffoodd_fr
  */

  function ffeeeedd_widgets_init() {
    // Une colonne latérale spécifique pour la page d'accueil
    register_sidebar( array(
      'name' => 'Accueil',
      'id' => 'accueil',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    ) );
    // La colonne latérale pour les pages
    register_sidebar( array(
      'name' => 'Pages',
      'id' => 'pages',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    ) );
  }
  add_action( 'widgets_init', 'ffeeeedd_widgets_init' );


  /* == @section Référencement Social / SEO ==================== */
  /**
   * @note Inspiré par le thème Noviseo2012, permet d'ajouter un champ "Titre" et "Description" à la zone d'édition
   * @author Sylvain Fouillaud
   * @see https://twitter.com/noviseo
   * @see http://noviseo.fr/2012/11/theme-wordpress-referencement/
   * @note Modifications :
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Homogénéisation du code, meilleure intégration dans l'administration, ajout des métas DublinCore et réorganisation des métas par contenu.
   */

  /* -- @subsection Création des blocs dans l'administration -------------------- */
  function ffeeeedd__metabox() {
    add_meta_box( 'ffeeeedd__metabox__seo', __( 'Référencement' ), 'ffeeeedd__metabox__contenu', 'post', 'side', 'high' );
    add_meta_box( 'ffeeeedd__metabox__seo', __( 'Référencement' ), 'ffeeeedd__metabox__contenu', 'page', 'side', 'high' );
  }
  add_action( 'add_meta_boxes', 'ffeeeedd__metabox' );

  /* -- @subsection Ajout des champs utiles dans ces blocs -------------------- */
  function ffeeeedd__metabox__contenu( $post ) {
    $val_title = get_post_meta( $post->ID, '_ffeeeedd__metabox__titre', true );
    $val_description = get_post_meta( $post->ID, '_ffeeeedd__metabox__description', true ); ?>
    <p><?php echo __( 'Ces champs sont utilisés dans les balises \'meta\' utiles au référencement naturel et au partage social.', 'ffeeeedd' ); ?>.</p>
    <p><strong><?php echo __( 'Titre', 'ffeeeedd' ); ?></strong></p>
    <p>
      <label class="screen-reader-text" for="ffeeeedd__metabox__titre"><?php echo __( 'Titre', 'ffeeeedd' ); ?></label>
      <input id="ffeeeedd__metabox__titre" name="ffeeeedd__metabox__titre" type="text" style="width:100%;" value="<?php echo $val_title; ?>" />
    </p>
    <p><strong><?php echo __( 'Description', 'ffeeeedd' ); ?></strong></p>
    <p>
      <label class="screen-reader-text" for="ffeeeedd__metabox__description"><?php echo __( 'Description', 'ffeeeedd' ); ?></label>
      <textarea id="ffeeeedd__metabox__description" name="ffeeeedd__metabox__description" style="width:100%; resize:none;"><?php echo $val_description; ?></textarea>
    </p>
  <?php }

  /* -- @subsection Sauvegarder la valeur de ces champs -------------------- */
  function ffeeeedd__metabox__save( $post_ID ) {
    if( isset( $_POST['ffeeeedd__metabox__titre'] ) ) {
      update_post_meta( $post_ID, '_ffeeeedd__metabox__titre', esc_html( $_POST['ffeeeedd__metabox__titre'] ) );
    }
    if( isset( $_POST['ffeeeedd__metabox__description'] ) ) {
      update_post_meta( $post_ID,'_ffeeeedd__metabox__description', esc_html( $_POST['ffeeeedd__metabox__description'] ) );
    }
  }
  add_action( 'save_post', 'ffeeeedd__metabox__save' );

  /* -- @subsection Ajoute les métas 'Description' dans le <head> -------------------- */
  function ffeeeedd__injection__description() {
    global $wp_query;
    // Si le champ est rempli, on affiche sa valeur
    if ( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true ) ) {
      echo '<!-- Métas Description dynamiques -->';
      echo '<meta name="description" content="';
      echo get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true );
      echo '" />';
      echo '<meta property="og:description" content="';
      echo get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true );
      echo '" />';
      echo '<meta name="twitter:description" content="';
      echo get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true );
      echo '" />';
      echo '<meta name="DC.description" lang="' . get_bloginfo( 'language' ) . '" content="';
      echo get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true );
      echo '" />';
      echo '<!-- Fin des métas Description dynamiques -->';
    }
    // Sinon, dans le cas d'un article on affiche l'extrait
    elseif ( is_single() ) {
      echo '<!-- Métas Description dynamiques -->';
      echo '<meta name="description" content="' . strip_tags( get_the_excerpt() ) . '" />';
      echo '<meta property="og:description" content="' . strip_tags( get_the_excerpt() ) . '" />';
      echo '<meta name="twitter:description" content="' . strip_tags( get_the_excerpt() ) . '" />';
      echo '<meta name="DC.description" lang="' . get_bloginfo( 'language' ) . '" content="' . strip_tags( get_the_excerpt() ) . '" />';
      echo '<!-- Fin des métas Description dynamiques -->';
    }
    // Sinon, on affiche la description générale du site
    else {
      echo '<!-- Métas Description dynamiques -->';
      echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
      echo '<meta property="og:description" content="' . get_bloginfo( 'description' ) . '" />';
      echo '<meta name="twitter:description" content="' . get_bloginfo( 'description' ) . '" />';
      echo '<meta name="DC.description" lang="' . get_bloginfo( 'language' ) . '" content="' . get_bloginfo( 'description' ) . '" />';
      echo '<!-- Fin des métas Description dynamiques -->';
    }
  }
  add_action( 'wp_head', 'ffeeeedd__injection__description' );

  /* -- @subsection Modifie la valeur des métas 'Title' dans le <head> -------------------- */
  function ffeeeedd__injection__titre( $title ) {
    global $wp_query;
    if ( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__titre', true ) ) {
      return get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__titre', true );
    } else {
      return $title;
    }
  }
  add_filter( 'wp_title', 'ffeeeedd__injection__titre' );


  /* == @section Profil utilisateur ==================== */
  /**
   * @note Ajoute un champ 'Twitter' dans les profils utilisateur
   * @note Supprime les champs inutiles
   * @author Valentin Brandt
   * @see https://twitter.com/geekeriesfr
   * @see http://www.geekeries.fr/snippet/gerer-champs-contact-profil-utilisateur-wordpress/
   */
  function ffeeeedd__user() {
    /* Supprimer des champs */
    unset( $contact['aim'] );
    unset( $contact['yim'] );
    unset( $contact['jabber'] );
    /* Ajouter un champ Twitter */
    $contact['twitter'] = 'Twitter';
    return $contact;
  }
  add_filter( 'user_contactmethods', 'ffeeeedd__user', 75, 1 );


  /* == @section Personnaliser le logo ==================== */
  /**
   * @note Ajoute le support de la personnlisation de l'entête,
   * @note On le détourne pour personnaliser le logo.
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   */
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
  add_action( 'after_setup_theme', 'ffeeeedd__logo' );

  /* == @section Ajout des métas Image dans le <head> ==================== */
  /**
   * @note Inspiré par le thème Noviseo2012, avec une gestion des images améliorée
   * @author Sylvain Fouillaud
   * @see https://twitter.com/noviseo
   * @see http://noviseo.fr/2012/11/theme-wordpress-referencement/
   * @note : La fonction est modifiée pour prendre en compte le logo personnalisé.
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   */
  function ffeeeedd__injection__image() {
    global $post;
    if ( is_single() ) {
      $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
      echo '<!-- Métas Image dynamiques -->';
      echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
      echo '<link rel="image_src" href="'. esc_attr( $thumbnail_src[0] ) . '" />';
      echo '<meta property="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
      echo '<!-- Fin des métas Image dynamiques -->';
    } else {
      echo '<!-- Métas Image dynamiques -->';
      echo '<meta property="og:image" content="' . get_header_image() . '"/>';
      echo '<link rel="image_src" href="'. get_header_image() . '" />';
      echo '<meta property="twitter:image" content="' . get_header_image() . '"/>';
      echo '<!-- Fin des métas Image dynamiques -->';
    }
  }
  add_action( 'wp_head', 'ffeeeedd__injection__image' );