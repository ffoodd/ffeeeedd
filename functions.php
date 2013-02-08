<?php
	/**
	 * ffeeeedd : fonctions du thème
     * @author Gaël Poupard
     * @link www.ffoodd.fr
     *
     * @package 	WordPress
     * @subpackage 	ffeeeedd
     * @since 		ffeeeedd 1.0
     */


	/* ========================================================================================================================
	
	Paramètres spécifiques du thème
	
	======================================================================================================================== */

    add_theme_support('post-thumbnails');

	register_nav_menus(array('primary' => 'Menu principal'));

	/* ========================================================================================================================
	
	Actions et Filtres
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'base_script_enqueuer' );

    // Retire les classes générées - sauf la current - par Wordpress sur le menu principal
    add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
    add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
    add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
    function my_css_attributes_filter($var) {
      return is_array($var) ? array_intersect($var, array('current_page_item', 'current-page-ancestor', 'inbl')) : '';
    }
    
    // Désactive les liens et scripts inutiles générés par Wordpress
    automatic_feed_links(false);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
    remove_action('wp_head', 'wp_dlmp_l10n_style' );
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Ajoute une classe aux parents dans la navigations
    add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
    function add_menu_parent_class( $items ) {        
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

    // Ajoute un lien "Lire la suite" après l'extrait
    function continue_reading() {
        return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Lire l\'article «&nbsp;' ). get_the_title() .( '&nbsp;» <span class="meta-nav">&rarr;</span>' ) . '</a>';
    }
    
    // Remplace le "[...]" ajouté automatiquement aux extraits par une ellipse et le lien "Lire la suite"
    function auto_excerpt( $more ) {
        return ' &hellip;' . continue_reading();
    }
    add_filter( 'excerpt_more', 'auto_excerpt' );
    
    // Ajoute le lien "Lire la suite" si l'extrait n'est pas généré mais renseigné
    function custom_excerpt( $output ) {
        if ( has_excerpt() && ! is_attachment() ) {
            $output .= continue_reading();
        }
        return $output;
    }
    add_filter( 'get_the_excerpt', 'custom_excerpt' );


	/* ========================================================================================================================
	
	Scripts & Styles
	
	======================================================================================================================== */

	/**
	 * Ajouter les scripts et styles via wp_head()
	 *
	 * @return void
	 */

	function base_script_enqueuer() {
        // À employer en dev, script.js est indenté, lisible et les fonctions/variables ont des intitulés compréhensibles.
		wp_register_script( 'site', get_template_directory_uri().'/script.js', false, null, false );
        // À utiliser en prod, fichier minifié et obscurci. Ajouter la date ou la version pour la mise en cache.
		//wp_register_script( 'site', get_template_directory_uri().'/script.20130103.min.js', false, null, false );
		wp_enqueue_script( 'site' );

		// À employer en dev, style.css utilise @import pour améliorer la compréhension de l'architecture css.
        wp_register_style( 'all', get_stylesheet_directory_uri().'/style.css', '', 'null', 'all' );
        // À utiliser en prod, fichier minifié. Ajouter la date ou la version pour la mise en cache.
		//wp_register_style( 'all', get_stylesheet_directory_uri().'/style.20130103.min.css', '', 'null', 'all' );
        wp_enqueue_style( 'all' );
	}

    // Utiliser la dernière version de jQuery sur le CDN Google, si besoin !
    if( !is_admin()){
      wp_deregister_script('jquery');
      wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, null, false);
      wp_enqueue_script('jquery');
    }

    // Créer les éléments html5 pour IE8 et -
    function add_ie_html5 () {
         echo '<!--[if lt IE 9]>';
         echo '<script>a="header0footer0section0aside0nav0article0figure0figcaption0hgroup0time0mark".split(0);for(i=a.length;i--;)document.createElement(a[i]);</script>';
         echo '<![endif]-->';
    }
    add_action('wp_head', 'add_ie_html5');

    // Minification du html
    add_action('get_header', 'go_minif');
    function go_minif() {
        ob_start( 'end_minif' );
    }
    function end_minif( $html ) {    
        // Suppression des commentaires HTML, sauf les commentaires conditionnels pour IE
        // À n'utiliser qu'en prod
        $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);
        // Suppression des espaces vides
        $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
        while ( stristr($html, '  ')) 
            $html = str_replace('  ', ' ', $html);    
        return $html;
    }

    // Réponse aux commentaires
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

    /* ========================================================================================================================
	
	Fil d'Ariane
	
	======================================================================================================================== */

    function myget_category_parents($id, $link = false,$separator = '/',$nicename = false,$visited = array()) {
         $chain = '';$parent = &get_category($id);
         if (is_wp_error($parent))return $parent;
         if ($nicename)$name = $parent->name;
         else $name = $parent->cat_name;
         if ($parent->parent && ($parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
            $visited[] = $parent->parent;$chain .= myget_category_parents( $parent->parent, $link, $separator, $nicename, $visited );}
         if ($link) $chain .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de '.$parent->cat_name.'" itemprop="url">'.$name.'</a></li>' . $separator;
         else $chain .= $name.$separator;
         return $chain;
    }
        function ariane() {
         global $wp_query;$ped=get_query_var('paged');$rendu = '<ol>'; 
         if ( is_home() ) {$rendu .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a title="'. get_bloginfo('name') .'" href="'.home_url().'" itemprop="url">'. get_bloginfo('name') .'</a></li> &rarr; <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl">Actualité</li>';}
         if ( !is_home() ) {$rendu .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a title="'. get_bloginfo('name') .'" href="'.home_url().'" itemprop="url">'. get_bloginfo('name') .'</a></li>';}
         if ( is_category() ) {
            $cat_obj = $wp_query->get_queried_object();$thisCat = $cat_obj->term_id;$thisCat = get_category($thisCat);$parentCat = get_category($thisCat->parent);
         if ($thisCat->parent != 0) $rendu .= " &rarr; ".myget_category_parents($parentCat, true, " &rarr; ", true);
         if ($thisCat->parent == 0) {$rendu .= " &rarr; ";}
         if ( $ped <= 1 ) {$rendu .= single_cat_title("", false);}
         elseif ( $ped > 1 ) {
             $rendu .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a href="' . get_category_link( $thisCat ) . '" title="Voir tous les articles de '.single_cat_title("", false).'" itemprop="url">'.single_cat_title("", false).'</a></li>';}}
         elseif ( is_author()){
         global $author;$user_info = get_userdata($author);$rendu .= " &rarr; Articles de l'auteur ".$user_info->display_name."</li>";} 
         elseif ( is_tag()){
            $tag=single_tag_title("",FALSE);$rendu .= " &rarr; Articles sur le th&egrave;me <span>".$tag."</span>";}
         elseif ( is_date() ) { 
         if ( is_day() ) {
         global $wp_locale;
             $rendu .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a href="'.get_month_link( get_query_var('year'), get_query_var('monthnum') ).'" itemprop="url">'.$wp_locale->get_month( get_query_var('monthnum') ).' '.get_query_var('year').'</a></li> ';
             $rendu .= " &rarr; Archives pour ".get_the_date();} 
         else if ( is_month() ) {
             $rendu .= " &rarr; Archives pour ".single_month_title(' ',false);}
         else if ( is_year() ) {
             $rendu .= " &rarr; Archives pour ".get_query_var('year');}}
         elseif ( is_archive() && !is_category()){
             $posttype = get_post_type();
             $tata = get_post_type_object( $posttype );
             $var = '';
             $the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
             $titrearchive = $tata->labels->menu_name;
         if (!empty($the_tax)){$var = $the_tax->labels->name.' ';}
         if (empty($the_tax)){$var = $titrearchive;}
            $rendu .= ' &rarr; '.$var.'';}
         elseif ( is_search()) {
            $rendu .= " &rarr; R&eacute;sultats de votre recherche <span>&rarr; ".get_search_query()."</span>";}
         elseif ( is_404()){
            $rendu .= " &rarr; 404 : Page non trouv&eacute;e";}
         elseif ( is_single()){
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
         if ($category_id != 0) {
            $rendu .= " &rarr; ".myget_category_parents($category_id,TRUE,' &rarr; ')."<span>".the_title('','',FALSE)."</span>";}
         elseif ($category_id == 0) {
            $post_type = get_post_type();
            $tata = get_post_type_object( $post_type );
            $titrearchive = $tata->labels->menu_name;
            $urlarchive = get_post_type_archive_link( $post_type );
            $rendu .= ' &rarr; <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a href="'.$urlarchive.'" title="'.$titrearchive.'" itemprop="url">'.$titrearchive.'</a></span> &rarr; <span>'.the_title('','',FALSE).'</li>';}}
         elseif ( is_page()) {
            $post = $wp_query->get_queried_object();
         if ( $post->post_parent == 0 ){$rendu .= " &rarr; ".the_title('','',FALSE)."";}
         elseif ( $post->post_parent != 0 ) {
            $title = the_title('','',FALSE);$ancestors = array_reverse(get_post_ancestors($post->ID));array_push($ancestors, $post->ID);
         foreach ( $ancestors as $ancestor ){
         if( $ancestor != end($ancestors) ){$rendu .= ' &rarr; <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inbl"><a href="'. get_permalink($ancestor) .'" itemprop="url">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';}
         else {$rendu .= ' &rarr; '.strip_tags(apply_filters('single_post_title',get_the_title($ancestor))).'';}}}}
         if ( $ped >= 1 ) {$rendu .= ' (Page '.$ped.')';}
            $rendu .= '</ol>';
         echo $rendu;
    }

    /* ========================================================================================================================
	
	Extensions
	
	======================================================================================================================== */

    // Commentaires
    if ( ! function_exists( 'ffeeeedd_comment' ) ) :
    /**
     * Template pour les commentaires & pingbacks.
     */
    function ffeeeedd_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // On affiche différemment les trackbacks.
        ?>
        <li <?php comment_class(); ?>>
            <p><?php _e( 'Pingback :', '' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Modifier)', '' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
            default :
            // On passe aux commentaires standards.
            global $post;
        ?>
        <li itemscope itemtype="http://schema.org/UserComments">
            <article role="article">
                <header>
                    <?php
                        echo get_avatar( $comment, 44 );
                        printf( '<cite itemprop="creator">%1$s %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<small> ( Rédacteur ) </small>' : ''
					);
                        printf( '<time datetime="%2$s">%3$s</time>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
                        );
                    ?>
                </header>
    
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p>Votre commentaire est en attente de modération.</p>
                <?php endif; ?>
    
                <section itemprop="commentText">
                    <?php comment_text(); ?>
                    <?php edit_comment_link('Modifier', '<p>', '</p>' ); ?>
                </section>
    
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Répondre', 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </article>
        <?php
            break;
        endswitch;
    }
    endif;
    
	// Ajout des types de champs HTML5 url et email sur les commentaires
	add_filter('comment_form_defaults', 'fields_html5');
	
	if ( !function_exists('fields_html5')) {
		function fields_html5( $fields ) {
			// Type email
			$fields['fields']['email'] = '
				<p class="comment-form-email">
					<label for="email">'. __( 'Email' ) .' <span class="required">*</span></label>
					<input id="email" name="email" value="" aria-required="true" size="30" type="email" />
				</p>
			';
			// Type url et placeholder http://
			$fields['fields']['url'] = '
				<p class="comment-form-url"> 
					<label for="url">'. __( 'Website' ) .'</label>
					<input id="url" name="url" value="" placeholder="http://" size="30" type="url" />
				</p>
			';
		return $fields;
		}
	} 

    // Recherche améliorée
    function recherche($query) {
        // On vérifie s'il s'agit dune page de recherche ou un d'un flux rss 
        if ($query->is_search or $query->is_feed) {
            // La recherche parcoure otus les contenus
            $query->set('post_type', 'any');
            // On définit à 10 le nombre de résultats, comme sur les autres pages de boucles
            $query->set('posts_per_page', 10);
            // On définit l'ordre d'affichage
            $query->set('orderby', 'date');
        }
        return $query;
    }
    // Ce filtre va intercepter la boucle et ré-ordonner les résultats avant qu'ils ne soient renvoyés et affichés
    add_filter('pre_get_posts','recherche');

    // Colonnes latérales
    function ffeeeedd_widgets_init() {    
        // Une colonne latérale spécifique pour la page d'accueil
        register_sidebar( array(
            'name' => 'Accueil',
            'id' => 'accueil',
            'before_widget' => '<div>',
            'after_widget' => "</div>",
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ) );
        // La colonne latérale pour les pages
        register_sidebar( array(
            'name' => 'Pages',
            'id' => 'pages',
            'before_widget' => '<div>',
            'after_widget' => "</div>",
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'ffeeeedd_widgets_init' );
