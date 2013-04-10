<?php
/**
 * ffeeeedd : echerche améliorée
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 *
 * @param         type $query : la requête effectuée
 * @return        type : la requête personnalisée par nos soins
 */
// À copier dans functions.php

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

?>
