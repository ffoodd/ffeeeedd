<?php
/**
 * ffeeeedd : fonctions du thème - partie front-end
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
  == Classes sur la navigation
    -- Retire les classes générées
    -- Ajoute une classe aux parents
  == Liens générés
    -- Désactive les liens et scripts inutiles générés par WordPress
    -- Retire les attributs title inutiles sur les liens générés par WordPress
  == Gestion des extraits
    -- Ajoute un lien «Lire la suite»
    -- Remplace le «[...]» par une ellipse et le lien «Lire la suite»
    -- Ajoute le lien «Lire la suite» si l’extrait n'est pas généré mais renseigné
  == <footer> pour les articles
  == Injection des scripts et styles
    -- Ajouter les scripts et styles via wp_head()
    -- Créer les éléments html5 pour IE8 et -
    -- Réponse aux commentaires
  == Fil d’Ariane
    -- Récupère les catégories parentes et y ajoute les microdonnées
    -- On génère le fil d’Ariane
  == Pagination
  == Gestion des commentaires
    -- Gère l’affichage des commentaires
    -- Ajout des types de champs HTML5 url et email sur les commentaires, et de l’attribut HTML5 required sur le nom et l’email
    -- Ajout de l’attribut HTML5 required sur le textarea
    -- Suppression de l’attribut rel="nofollow" sur les commentaires
  == Référencement Social / SEO
    -- Ajoute les métas 'Description' dans le <head>
    -- Génère le titre utilisé dans les métas 'Title'
    -- Ajoute un <link rel="canonical" /> si le champ est rempli
  == Ajout des métas Image dans le <head>
  == Amélioration de la recherche
*/


  /* == @section Classes sur la navigation ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Retire la multitude de classes générées par WordPress et inutiles; ajoute les classes permettant d’identifier les parents directs ou indirects, et autorise l’ajout de la classe «inbl» de Knacss depuis l’administration.
  */

  /* -- @subsection Retire les classes générées - sauf les 'current_page' - par Wordpress sur le menu principal -------------------- */
  add_filter( 'nav_menu_css_class', 'ffeeeedd__css__attributs', 100, 1 );
  add_filter( 'nav_menu_item_id', 'ffeeeedd__css__attributs', 100, 1 );
  add_filter( 'page_css_class', 'ffeeeedd__css__attributs', 100, 1 );
  if ( ! function_exists( 'ffeeeedd__css__attributs' ) ) {
    function ffeeeedd__css__attributs( $var ) {
      return is_array( $var ) ? array_intersect( $var, array( 'current_page_item', 'current-page-ancestor', 'current_page_parent', 'current-menu-parent', 'current-menu-item', 'inbl' ) ) : '';
    }
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
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note La deuxième sous-section provient d’un bout de code trouvé dans un dossier « wordcamp-code » dont je ne suis pas parvenu à retrouver l’origine.
  */

  /* -- @subsection Désactive les liens et scripts inutiles générés par WordPress */
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
  remove_action( 'wp_head', 'wp_dlmp_l10n_style' );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'parent_post_rel_link' );
  remove_action( 'wp_head', 'start_post_rel_link' );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
  remove_action( 'wp_head', 'feed_links', 2);
  remove_action( 'wp_head', 'feed_links_extra', 3 );

  /*-- @subsection Retire les attributs title inutiles sur les liens générés par WordPress */
  add_filter( 'wp_nav_menu', 'ffeeeedd__attributs__title' );
  add_filter( 'wp_list_pages', 'ffeeeedd__attributs__title' );
  add_filter( 'wp_list_categories', 'ffeeeedd__attributs__title' );
  add_filter( 'get_archives_link', 'ffeeeedd__attributs__title' );
  add_filter( 'wp_tag_cloud', 'ffeeeedd__attributs__title' );
  add_filter( 'the_category', 'ffeeeedd__attributs__title' );
  add_filter( 'edit_post_link', 'ffeeeedd__attributs__title' );
  add_filter( 'edit_comment_link', 'ffeeeedd__attributs__title' );

  function ffeeeedd__attributs__title( $output ) {
    $output = preg_replace( '/\s*title\s*=\s*(["\']).*?\1/', '', $output );
    return $output;
  }


  /* == @section Gestion des extraits ==================== */
  /**
   * @note Tiré de Twentyeleven - Ancien thème WordPress par défaut
   * @see http://theme.wordpress.com/themes/twentyeleven/
   */

  /* -- @subsection Ajoute un lien « Lire la suite » après l’extrait -------------------- */
  if ( ! function_exists( 'ffeeeedd__extrait__lien' ) ) {
    function ffeeeedd__extrait__lien() {
      return ' <a href="' . esc_url( get_permalink() ) . '" aria-hidden="true">' . __( 'Continue reading', 'ffeeeedd' ) . ' «&nbsp;' . esc_attr( get_the_title() ) . '&nbsp;» <span class="meta-nav">&rarr;</span></a>';
    }
  }

  /* -- @subsection Remplace le « [...] » ajouté automatiquement aux extraits par une ellipse et le lien « Lire la suite » -------------------- */
  if ( ! function_exists( 'ffeeeedd__extrait__auto' ) ) {
    function ffeeeedd__extrait_auto( $more ) {
      return ' [&hellip;]' . ffeeeedd__extrait__lien();
    }
  }
  add_filter( 'excerpt_more', 'ffeeeedd__extrait_auto' );

  /* -- @subsection Ajoute le lien « Lire la suite » si l’extrait n’est pas généré mais renseigné -------------------- */
  function ffeeeedd__extrait_custom( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
      $output .= ffeeeedd__extrait__lien();
    }
    return $output;
  }
  add_filter( 'get_the_excerpt', 'ffeeeedd__extrait_custom' );


  /* == @section <footer> pour les articles ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Inspiré de la fonction «twentytwelve_entry_meta» du thème Twentytwelve, enrichie par mes soins de microdonnées, de la date de dernière modification et avec un format de date Français.
   * @see http://wordpress.org/extend/themes/twentytwelve
   */

  if ( ! function_exists( 'ffeeeedd__meta' ) ) {
    function ffeeeedd__meta() {
      // Liste des catégories & tags avec un séparateur.
      $categories_list = get_the_category_list( ( ', ' ) );
      $tag_list = get_the_tag_list( '', ( ', ' ) );
      // On génère le contenu en fonction des informations disponibles ( mots-clés, catégories, auteur ).
      if ( '' != $tag_list ) {
        echo '<p>' . __( 'Entry written by', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author" class="vcard author"><span class="fn">' . get_the_author_meta( 'display_name' ) . '</span></a> ' . __( 'in', 'ffeeeedd' ) . ' <span itemprop="keywords">' . $categories_list . '.</span><br />' . __( 'Tags:', 'ffeeeedd' ) .' <span itemprop="keywords">' . $tag_list . '.</span></p>';
      } elseif ( '' != $categories_list ) {
        echo '<p>' . __( 'Entry written by', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author" class="vcard author"><span class="fn">' . get_the_author_meta( 'display_name' ) . '</span></a> ' . __( 'in', 'ffeeeedd' ) . ' <span itemprop="keywords">' . $categories_list . '.</span></p>';
      } else {
        echo '<p>' . __( 'Entry written by', 'ffeeeedd' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author" class="vcard author"><span class="fn">' . get_the_author_meta( 'display_name' ) . '</span></a>.</p>';
      }
      // On génère la date de dernière modification
      echo '<p class="print-hidden">' . __( 'Last modified on', 'ffeeeedd' ) . ' <time class="updated" datetime="' . get_the_modified_date( 'Y-m-d' ) . '" itemprop="dateModified">' . get_the_modified_date() . '</time>.</p>';
    }
  }

  /* == @section Injection des scripts et styles ==================== */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Inspiré du thème Twentytwelve.
   * @see http://wordpress.org/extend/themes/twentytwelve
   */

  /* -- @subsection Ajouter les scripts et styles via wp_head() -------------------- */
  add_action( 'wp_enqueue_scripts', 'ffeeeedd__script' );
  if ( ! function_exists( 'ffeeeedd__script' ) ) {
    function ffeeeedd__script() {
      wp_register_style(
        'all',
        get_stylesheet_directory_uri().'/style.css',
        false,
        null,
        'all'
      );

      wp_register_script(
        'test-js',
        get_stylesheet_directory_uri() . '/script.js',
        false,
        null,
        true
      );

      // On ajoute les fichiers à la queue
      wp_enqueue_style( 'all' );
      wp_enqueue_script( 'test-js' );
    }
  }

  /* -- @subsection Créer les éléments html5 pour IE8 et - -------------------- */
  /**
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Inspiré par deux astuces croisées sur le web :
   ** @see http://tweetpress.fr/codewp/detection-navigateur-wordpress/
   ** @author Julien Maury
   ** @see https://twitter.com/TweetPressFr
   ** @see https://github.com/mlbli/HTML5forIE
   ** @author Matthias Le Brun
   ** @see https://twitter.com/_mlb
   */
  function ffeeeedd__ie_html5 () {
    // On commence par tester s’il s'agit bien d’IE à l’aide d’une variable globale proposée par WordPress
    global $is_IE;
    if ( $is_IE ) {
      // Puis on ajoute, dans un commentaire conditionnel, le script magique
      echo '<!--[if lt IE 9]>';
      echo '<script>a="header0footer0section0aside0nav0article0figure0figcaption0main0time0mark".split(0);for(i=a.length;i--;)document.createElement(a[i]);</script>';
      echo '<![endif]-->';
    }
  }
  add_action( 'wp_head', 'ffeeeedd__ie_html5' );

  /* -- @subsection Réponse aux commentaires -------------------- */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }


  /* == @section Fil d’Ariane ==================== */
  /**
   * @author Daniel Roch
   * @see https://twitter.com/rochdaniel
   * @see http://www.seomix.fr/fil-dariane-chemin-navigation/
   * @see http://support.google.com/webmasters/bin/answer.py?hl=fr&answer=185417
   * @note Modifications :
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Prise en compte des formats d’articles, corrections des intitulés pour les taxonomies, du nombre de résultats et de la requête de la recherche, et mise en place des microdonnées au lieu des microformats.
   * @note Bonus : le séparateur est masqué pour les technologies d’assistance.
   * @see https://gist.github.com/jonathantneal/4037764
   * @note Bonus 2 : on se réfère au modèle proposé par la WAI :
   * @see http://www.w3.org/WAI/tutorials/menus/multiple-ways/#breadcrumbs
  */

  /* -- @subsection Récupère les catégories parentes et y ajoute les microdonnées -------------------- */
  function ffeeeedd__categories( $id, $link = false, $separator = '<span aria-hidden="true"> &rarr;&nbsp;</span>', $nicename = false, $visited = array() ) {
    $final = '';
    $parent = get_category( $id );
    if ( is_wp_error( $parent ) ) {
      return $parent;
    }
    if ( $nicename ) {
      $name = $parent->name;
    } else {
      $name = $parent->cat_name;
    }
    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
      $visited[] = $parent->parent;
      $final .= ffeeeedd__categories( $parent->parent, $link, $separator, $nicename, $visited );
    }
    if ( $link ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( get_category_link( $parent->term_id ) ) . '" title="' . esc_attr( __( 'All entries in ', 'ffeeeedd' ) ) . esc_attr( $parent->cat_name ) . '" itemprop="url"><span itemprop="title">' . $name . '</span></a>' . $separator . '</div>';
    } else {
      $final .= $name . $separator;
    }
    return $final;
  }

  /* -- @subsection On génère le fil d’Ariane -------------------- */
  function ffeeeedd__ariane() {

    // Variables globales
    global $wp_query;
    $paged = get_query_var( 'paged' );
    $sep = '<span aria-hidden="true"> &rarr;&nbsp;</span>';
    $final = '<nav role="navigation" aria-label="' . esc_attr( __( 'You are here: ', 'ffeeeedd' ) ) . '" class="print-hidden small">';
    $startdefault = '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( home_url() ) . '" itemprop="url"><span itemprop="title">' . get_bloginfo( 'name' ) . '</span></a>' . $sep . '</div>';
    $starthome = get_bloginfo( 'name' );

    // Début du fil d’Ariane
    if ( is_front_page() && is_home() ) {
      // Accueil par défaut
      if ( $paged >= 1 ) {
        $final .= $startdefault;
      } else {
        $final .= $starthome;
      }
    } elseif ( is_front_page() ) {
      // Accueil statique ( page statique définie )
      $final .= $starthome;
    } elseif ( is_home() ) {
      // Page de blog ( liste des articles )
      if ( $paged >= 1 ) {
        $url = get_page_link( get_option( 'page_for_posts' ) );
        $final .= $startdefault . '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $url  ) . '" itemprop="url" title="' . esc_attr_e( 'Entries', 'ffeeeedd' ) . '"><span itemprop="title">' . __( 'Entries', 'ffeeeedd' ) . '</span></a></div>';
      } else {
        $final .= $startdefault . '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Entries', 'ffeeeedd' ) . '</span></div>';
      }
    } else {
      // Pour tout le reste
      $final .= $startdefault;
    }

    // Empêche d'autre(s) code(s) d’interférer avec l’accueil statique ou blog
    if ( is_front_page() && is_home() ) {
    } elseif ( is_front_page() ) {
    } elseif ( is_home() ) {
    }

    //  Fichiers attachés
    elseif ( is_attachment() ) {
      global $post;
      $parent = get_post( $post->post_parent );
      $id = $parent->ID;
      $category = get_the_category( $id );
      $category_id = get_cat_ID( $category[0]->cat_name );
      $permalink = get_permalink( $id );
      $title = $parent->post_title;
      $final .= ffeeeedd__categories( $category_id, true, $sep ) . '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $permalink ) . '" itemprop="url" title="' . esc_attr( $title ) . '"><span itemprop="title">' . $title . '</span></a>' . $sep . '</div><div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . the_title('', '', false ) . '</span></div>';
    }

    // Type(s) d’articles
    elseif ( is_single() && !is_singular( 'post' ) ) {
      global $post;
      $nom = get_post_type( $post );
      $archive = get_post_type_archive_link( $nom );
      $mypost = $post->post_title;
      $label = get_post_type_object( $nom )->labels->name;
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $archive ) . '" itemprop="url" title="' . esc_attr( $label ) . '"><span itemprop="title">' . $label . '</span></a>' . $sep . '</div><div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $mypost . '</span></div>';
    }

    // Articles avec un format
    elseif ( is_single() && has_term('', 'post_format') ) {
      global $post;
      $format = get_post_format( $post->ID );
      $pretty_format = get_post_format_string( $format );
      $format_link = get_post_format_link( $format );
      $mypost = $post->post_title;
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $format_link ) . '" itemprop="url" title="' . esc_attr( $pretty_format ) . '"><span itemprop="title">' . $pretty_format . '</span></a>' . $sep . '</div><div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $mypost . '</span></div>';
    }

    // Articles sans format
    elseif ( is_single() && !has_term('', 'post_format') ) {
      // Catégories d’articles
      $category = get_the_category();
      $category_id = get_cat_ID( $category[0]->cat_name );
      if ( $category_id != 0 ) {
        $final .= ffeeeedd__categories( $category_id, true, $sep );
      } elseif ($category_id == 0) {
        $post_type = get_post_type();
        $tata = get_post_type_object( $post_type );
        $titrearchive = $tata->labels->menu_name;
        $urlarchive = get_post_type_archive_link( $post_type );
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $urlarchive ) . '" title="' . esc_attr( $titrearchive ) . '" itemprop="url"><span itemprop="title">' . $titrearchive . '</span></a></div>';
      }
      // Avec des pages de commentaires
      $cpage = get_query_var( 'cpage' );
      if ( is_single() && $cpage > 0 ) {
        global $post;
        $permalink = get_permalink( $post->ID );
        $title = $post->post_title;
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $permalink ) . '" itemprop="url" title="' . esc_attr( $title ) . '"><span itemprop="title">' . $title . '</span></a>' . $sep . '</div><div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Comments page ', 'ffeeeedd' ) . $cpage . '</span></div>';
      }
      // Sans pages de commentaires
      else {
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . the_title( '', '', false ) . '</span></div>';
      }
    }

    // Catégories
    elseif ( is_category() ) {
      // Variables
      $categoryid = $GLOBALS['cat'];
      $category = get_category( $categoryid );
      $categoryparent = get_category( $category->parent );
      // Résultat
      if ( $category->parent != 0 ) {
        $final .=  '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . ffeeeedd__categories( $categoryparent, true, $sep, true ) . '</span></div>';
      }
      if ( $paged <= 1 ) {
        $final .=  '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . single_cat_title( '', false ) . '</span></div>';
      } else {
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( __( 'All entries in ', 'ffeeeedd' ) ) . esc_attr( single_cat_title( '', false ) ) . '" itemprop="url"><span itemprop="title">' . single_cat_title( '', false ) . '</span></a></div>';
      }
    }

    // Pages
    elseif ( is_page() && !is_home() ) {
      $post = $wp_query->get_queried_object();
      // Page simple
      if ( $post->post_parent == 0 ) {
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . the_title( '', '', false ) . '</span></div>';
      }
      // Page avec ancêtre(s)
      elseif ( $post->post_parent != 0 ) {
        $title = the_title( '', '', false );
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        array_push( $ancestors, $post->ID );
        foreach ( $ancestors as $ancestor ) {
          if ( $ancestor != end( $ancestors ) ) {
            $name = strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) );
            $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="' . esc_attr( $name ) . '" href="' . esc_url( get_permalink( $ancestor ) ) . '" itemprop="url"><span itemprop="title">' . $name . '</span></a>' . $sep . '</div>';
          }
          else {
            $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) . '</span></div>';
          }
        }
      }
    }

    // Auteurs
    elseif ( is_author() ) {
      if ( get_query_var( 'author_name' ) ) {
        $curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
      } else {
        $curauth = get_userdata( get_query_var( 'author' ) );
      }
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Entries written by ', 'ffeeeedd' ) . $curauth->nickname . '</span></div>';
    }

    // Tags
    elseif ( is_tag() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Entries about ', 'ffeeeedd' ) . single_tag_title( '', false ) . '</span></div>';
    }

    // Formats
    elseif ( is_tax( 'post_format' ) ) {
      $format = get_post_format( $post->ID );
      $pretty_format = get_post_format_string( $format );
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Entries about ', 'ffeeeedd' ) . $pretty_format . '</span></div>';
    }

    // Taxonomies
    elseif ( is_tax( ) ) {
      $taxonomie = get_taxonomy( get_query_var( 'taxonomy' ) );
      $term = get_queried_object();
      $types = $taxonomie->object_type;
      $post_type = get_post_type_object( $types[0] );
      $parents = get_ancestors( $term->term_id, $taxonomie->name );

      // S’il y a une taxonomie parente, on la récupère aussi
      if ( is_taxonomy_hierarchical( $taxonomie->name ) && $term->parent != 0 ) {
        // On affiche le type d’articles
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="' . esc_attr( $post_type->labels->name ) . '" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="url"><span itemprop="title">' . $post_type->labels->name  . '</span></a>' . $sep . '</div>';
        // Puis la taxonomie de premier niveau
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="' . esc_attr( $taxonomie->labels->name ) . '" href="' . esc_url( get_term_link( $term->parent, $term->taxonomy ) ) . '" itemprop="url"><span itemprop="title">' . $taxonomie->labels->name  . '</span></a>' . $sep . '</div>';
        // Ensuite les taxonomies parentes intermédiaires
        foreach ( $parents as $parent_id ) {
          $parent = get_term_by( 'id', $parent_id, $taxonomie->name);
          if ( $parent->parent != 0 ) {
            $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="' . esc_attr( $parent->name ) . '" href="' . esc_url( get_term_link( $parent->term_id, $parent->taxonomy ) ) . '" itemprop="url"><span itemprop="title">' . $parent->name  . '</span></a>' . $sep . '</div>';
          }
        }
        // Et finalement le nom du terme affiché
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $term->name  . '</span></div>';
      } // Sinon, on affiche suelement le type et la taxonomie courante
      else {
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="' . esc_attr( $post_type->labels->name ) . '" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="url"><span itemprop="title">' . $post_type->labels->name  . '</span></a>' . $sep . '</div>';
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $term->name  . '</span></div>';
      }
    }

    // Recherche
    elseif ( is_search() ) {
      global $wp_query;
      $count = $wp_query->found_posts;
      if ( $count > 1 ) {
        $final .=  '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . sprintf( __('%1$s search results for %2$s', 'ffeeeedd' ), $count, get_search_query() ) . '</span></div>';
      } elseif ( $count == 1 ) {
        $final .=  '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . sprintf( __('A single search result for "%1$s"', 'ffeeeedd' ), get_search_query() ) . '</span></div>';
      }
    }

    // Page 404
    elseif ( is_404() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( '404 - Page not found ', 'ffeeeedd' ) . '</span></div>';
    }

    // Types d’articles
    elseif ( is_post_type_archive() ) {
      $posttype = get_query_var('post_type');
      $posttypeobject = get_post_type_object( $posttype );
      $titrearchive = $posttypeobject->labels->menu_name;
      if ( isset( $titrearchive ) ) {
        $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $titrearchive . '</span></div>';
      }
    }

    // Archives - autres
    elseif ( is_day() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . sprintf( __( 'Archive : %s', 'ffeeeedd' ), get_the_date() ). '</span></div>';
    }
    elseif ( is_month() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . sprintf( __( 'Archive : %s', 'ffeeeedd' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ffeeeedd' ) ) ). '</span></div>';
    }
    elseif ( is_year() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . sprintf( __( 'Archive : %s', 'ffeeeedd' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ffeeeedd' ) ) ). '</span></div>';
    }
    elseif ( is_archive() ) {
      $final .= '<div class="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . __( 'Archive', 'ffeeeedd' ) . '</span></div>';
    }

    // Pagination
    if ( $paged >= 1 ) {
      $final .= '<divclass="inbl" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">&nbsp;/&nbsp;<span itemprop="title">Page ' . $paged . '</span></div>';
    }
    // The End
    $final .= '</nav>';
    echo $final;
  }


  /* == @section Pagination ==================== */
  /**
   * @author Jonathan Buttigieg
   * @see https://twitter.com/GeekPressFR
   * @see http://www.geekpress.fr/wordpress/astuce/pagination-wordpress-sans-plugin-52/
  */

  if ( ! function_exists( 'ffeeeedd__pagination' ) ) {
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
        'next_text' => __( 'Next page &rarr;', 'ffeeeedd' ),
        'prev_text' => __( '&larr; Previous page', 'ffeeeedd' )
      );
      if ( $wp_rewrite->using_permalinks() ) {
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
      }
      if ( !empty( $wp_query->query_vars['s'] ) ) {
        $pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );
      }
      echo str_replace( 'page/1/', '', paginate_links( $pagination ) );
    }
  }


  /* == @section Gestion des commentaires ==================== */
  /**
   * @author Luc Poupard
   * @see https://twitter.com/klohFR
   * @note Personnalise l’affichage des commentaires, ajout des microdonnées, et amélioration de l’accessibilité du formulaire avec les attributs et rôles ARIA.
  */

  /* -- @subsection Gère l’affichage des commentaires -------------------- */
  if ( ! function_exists( 'ffeeeedd_comment' ) ) {
    // Template pour les commentaires & pingbacks.
    function ffeeeedd_comment( $comment, $args, $depth ) {
      $GLOBALS['comment'] = $comment;
      switch ( $comment->comment_type ) {
        case 'pingback' :
        case 'trackback' :
        // On affiche différemment les trackbacks. ?>
          <li <?php comment_class(); ?>>
            <p><?php _e( 'Pingback :', 'ffeeeedd' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'ffeeeedd' ), '<span class="edit-link">', '</span>' ); ?></p>
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
                ( $comment->user_id === $post->post_author ) ? '<small> (' .  __( 'Post author', 'ffeeeedd' ) . ' ) </small>' : ''
              );
              printf( '<time datetime="%2$s" itemprop="commentTime">%3$s</time>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
              ); ?>
            </header>

            <?php if ( '0' == $comment->comment_approved ) { ?>
              <p><?php _e( 'Your comment is awaiting moderation.', 'ffeeeedd' ); ?>.</p>
            <?php } ?>

            <div itemprop="commentText">
              <?php comment_text(); ?>
              <?php edit_comment_link( __( 'Edit', 'ffeeeedd' ), '<p>', '</p>' ); ?>
            </div>

            <div class="reply" itemprop="replyToUrl">
              <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ffeeeedd' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
          </article>
        <?php break;
      }
    }
  }

  /* -- @subsection Ajout des types de champs HTML5 url et email sur les commentaires, et de l’attribut HTML5 required sur le nom et l’email -------------------- */
  add_filter( 'comment_form_defaults', 'ffeeeedd__champs__html5' );
  if ( ! function_exists( 'ffeeeedd__champs__html5' ) ) {
    function ffeeeedd__champs__html5( $fields ) {
      // Type author
      $fields['fields']['author'] = '
      <p class="comment-form-author">
        <label for="author">' . __( 'Name', 'ffeeeedd' ) . ' <span class="required">*</span></label>
        <input id="author" name="author" value="" aria-required="true" required="required" size="30" type="text" />
      </p>';
      // Type email
      $fields['fields']['email'] = '
      <p class="comment-form-email">
        <label for="email">' . __( 'Email', 'ffeeeedd' ) . ' <span class="required">*</span></label>
        <input id="email" name="email" value="" aria-required="true" required="required" size="30" type="email" />
      </p>';
      // Type url et placeholder http://
      $fields['fields']['url'] = '
      <p class="comment-form-url">
        <label for="url">' . __( 'Website', 'ffeeeedd' ) . '</label>
        <input id="url" name="url" value="" placeholder="http://" size="30" type="url" />
      </p>';
      return $fields;
    }
  }

  /* -- @subsection Ajout de l’attribut HTML5 required sur le textarea -------------------- */
  add_filter( 'comment_form_defaults', 'ffeeeedd__textarea__html5' );
  if ( ! function_exists( 'ffeeeedd__textarea__html5' ) ) {
    function ffeeeedd__textarea__html5( $defaults ) {
      $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'ffeeeedd' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';
      return $defaults;
    }
  }

  /* -- @subsection Suppression de l’attribut rel="nofollow" sur les commentaires --------
  ------------ */
  /**
    @author Jonathan Buttigieg
    @see https://twitter.com/GeekPressFR
    @see http://www.geekpress.fr/wordpress/astuce/supprimer-nofollow-commentaires-1500/
  */
  add_filter( 'get_comment_author_link', 'ffeeeedd__dofollow' );
  add_filter( 'comment_text', 'ffeeeedd__dofollow' );
  function ffeeeedd__dofollow( $text ) {
    $text = str_replace( 'rel="external nofollow"', 'rel="external"', $text );
    $text = str_replace( 'rel="nofollow"', '', $text);
    return $text;
  }


  /* == @section Référencement Social / SEO ==================== */
  /**
   * @note Inspiré par le thème Noviseo2012, permet d’ajouter un champ «Titre» et «Description» à la zone d’édition
   * @author Sylvain Fouillaud
   * @see https://twitter.com/noviseo
   * @see http://noviseo.fr/2012/11/theme-wordpress-referencement/
   * @note Modifications :
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @note Homogénéisation du code, meilleure intégration dans l’administration, ajout des métas DublinCore et réorganisation des métas par contenu.
   */

  // On teste d’abord si la fonction est surchargée ou si un plugin dédié existe
  if (
    ! function_exists( 'ffeeeedd__metabox' ) &&
    ! class_exists( 'WPSEO_Frontend' ) &&
    ! class_exists( 'All_in_One_SEO_Pack' )
  ) {

    /* -- @subsection Ajoute les métas 'Description' dans le <head> -------------------- */
    if ( ! function_exists( 'ffeeeedd__injection__description' ) ) {
      function ffeeeedd__injection__description() {
        global $wp_query;
        // Si le champ est rempli, on affiche sa valeur
        if ( isset( $wp_query->post->ID ) && get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true ) ) {
          echo '<!-- Métas Description dynamiques -->';
          echo '<meta name="description" content="';
          echo esc_attr( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true ) );
          echo '" />';
          echo '<meta property="og:description" content="';
          echo esc_attr( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true ) );
          echo '" />';
          echo '<meta name="twitter:description" content="';
          echo esc_attr( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__description', true ) );
          echo '" />';
          echo '<!-- Fin des métas Description dynamiques -->';
        }
        // Sinon, dans le cas d’un article on affiche l’extrait
        elseif ( is_single() && has_excerpt() ) {
          echo '<!-- Métas Description dynamiques -->';
          echo '<meta name="description" content="' . strip_tags( get_the_excerpt() ) . '" />';
          echo '<meta property="og:description" content="' . strip_tags( get_the_excerpt() ) . '" />';
          echo '<meta name="twitter:description" content="' . strip_tags( get_the_excerpt() ) . '" />';
          echo '<!-- Fin des métas Description dynamiques -->';
        }
        // Sinon, on affiche la description générale du site
        else {
          echo '<!-- Métas Description dynamiques -->';
          echo '<meta name="description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';
          echo '<meta property="og:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';
          echo '<meta name="twitter:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';
          echo '<!-- Fin des métas Description dynamiques -->';
        }
      }
    }
    add_action( 'wp_head', 'ffeeeedd__injection__description' );

    /* -- @subsection Génère le titre utilisé dans les métas 'Title' -------------------- */
    if ( ! function_exists( 'ffeeeedd__injection__titre' ) ) {
      function ffeeeedd__injection__titre( $title, $sep, $seplocation ) {
        global $wp_query, $page, $paged;
        // Ne change rien pour les flux RSS
        if ( is_feed() ) {
          return $title;
        }
        // Dans la page recherche, on indique le terme recherché
        if ( is_search() ) {
          global $wp_query;
          $count = $wp_query->found_posts;
          if ( $count > 1 ) {
            $title = sprintf( __('%1$s search results for %2$s', 'ffeeeedd' ), $count, get_search_query() );
          } elseif ( $count == 1 ) {
            $title = sprintf( __('A single search result for %1$s', 'ffeeeedd' ), get_search_query() ) . ' ' . $sep . ' ';
          }
        }
        // Modifie le titre si le champ de l’administration est rempli
        if ( isset( $wp_query->post->ID ) && get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__titre', true ) ) {
          $title = esc_attr( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__titre', true ) ) . ' ' . $sep . ' ';
        }
        // Ajoute le nom du site
        if ( 'right' == $seplocation ) {
          $title .= get_bloginfo( 'name' );
        } else {
          $title = get_bloginfo( 'name' ) . $title;
        }
        // Ajoute la description (pour la page d'accueil et de blog)
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
          $title .= ' ' . $sep . ' ' . $site_description;
        }
        // Ajoute le numéro de la page dans le cas d’une pagination
        if ( $paged >= 2 || $page >= 2 ) {
          $title .= ' ' . $sep . ' ' . sprintf( __( 'Page %s', 'ffeeeedd' ), max( $paged, $page ) );
        }
        return $title;
      }
    }
    add_filter( 'wp_title', 'ffeeeedd__injection__titre', 10, 3 );

    /* -- @subsection Ajoute un <link rel="canonical" /> si le champ est rempli -------------------- */
    if ( ! function_exists( 'ffeeeedd__injection__canonical' ) ) {
      function ffeeeedd__injection__canonical() {
        global $wp_query;
        if ( isset( $wp_query->post->ID ) && get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__canonical', true ) ) {
            echo '<link rel="canonical" href="' . esc_url( get_post_meta( $wp_query->post->ID, '_ffeeeedd__metabox__titre', true ) ) . '" />';
        }
      }
    }
    add_filter( 'wp_head', 'ffeeeedd__injection__canonical' );
  }

  /* == @section Ajout des métas Image dans le <head> ==================== */
  /**
   * @note Inspiré par le thème Noviseo2012, avec une gestion des images améliorée
   * @author Sylvain Fouillaud
   * @see https://twitter.com/noviseo
   * @see http://noviseo.fr/2012/11/theme-wordpress-referencement/
   * @note La fonction est modifiée pour prendre en compte le logo personnalisé.
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   */

  if ( ! function_exists( 'ffeeeedd__injection__image' ) ) {
    function ffeeeedd__injection__image() {
      global $post;
      if ( is_single() && has_post_thumbnail() ) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
        echo '<!-- Métas Image dynamiques -->';
        echo '<meta property="og:image" content="' . esc_url( $thumbnail_src[0] ) . '"/>';
        echo '<link rel="image_src" href="'. esc_url( $thumbnail_src[0] ) . '" />';
        echo '<meta property="twitter:image" content="' . esc_url( $thumbnail_src[0] ) . '"/>';
        echo '<!-- Fin des métas Image dynamiques -->';
      } elseif ( get_header_image() ) {
        echo '<!-- Métas Image dynamiques -->';
        echo '<meta property="og:image" content="' . esc_url( get_header_image() ) . '"/>';
        echo '<link rel="image_src" href="'. esc_url( get_header_image() ) . '" />';
        echo '<meta property="twitter:image" content="' . esc_url( get_header_image() ) . '"/>';
        echo '<!-- Fin des métas Image dynamiques -->';
      }
    }
    add_action( 'wp_head', 'ffeeeedd__injection__image' );
  }


  /* == @section Amélioration de la recherche ==================== */
  /**
   * @note La requête est modifiée pour chercher dans tous les types de contenus, et trier les résultats par date, avec une pagination de 10 en 10.
   * @author Gaël Poupard
   * @see https://twitter.com/ffoodd_fr
   * @param type $query : la requête effectuée
   * @return type : la requête personnalisée par nos soins
   */

  if ( ! function_exists( 'ffeeeedd__recherche' ) ) {
    function ffeeeedd__recherche( $query ) {
      // On vérifie s’il s'agit d’une page de recherche ou d’un flux RSS
      if ( $query->is_search or $query->is_feed ) {
        // La recherche parcours tous les contenus
        $query->set( 'post_type', 'any' );
        // On définit à 10 le nombre de résultats, comme sur les autres pages de boucles
        $query->set( 'posts_per_page', 10 );
        // On définit l’ordre d’affichage chronologique
        $query->set( 'orderby', 'date' );
      }
      return $query;
    }
  }
  // Ce filtre va intercepter la boucle et ré-ordonner les résultats avant qu’ils ne soient renvoyés et affichés
  add_filter( 'pre_get_posts','ffeeeedd__recherche' );
