<?php
/**
 * ffeeeedd : Facebook
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */
// À copier dans functions.php

  // Récupération de la première image d'un article
  function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if(empty($first_img)){
      // correspond au logo
      $first_img = get_template_directory_uri . '/img/ffeeeedd.png';
    }
    return $first_img;
  }

  // Ajout des meta og pour Facebook
  function insert_opengraph_in_head() {
    global $post;
    if ( !is_singular()) // On vérifie si nous somme dans un article ou une page
    return;
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:description" content="' . strip_tags(get_the_excerpt()) . '" />';
    echo '<meta property="og:url" content="' . get_permalink() . '"/>';
    echo '<meta property="og:site_name" content="Agence 1-ter-net"/>';
    // On utilise la précédente fonction pour définir la première image de l'article
    echo '<meta property="og:image" content="' . catch_that_image() . '"/>';
    echo '<link rel="image_src" href="' . catch_that_image() . '" />';
  }
  add_action( 'wp_head', 'insert_opengraph_in_head', 5 );

?>
