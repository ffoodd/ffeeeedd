<?php
/**
 * ffeeeedd : Extensions : typographie améliorée
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */
// À copier dans functions.php

  // Permet d'utiliser la meilleure esperluette disponible dans les titres
  function esperluette__titre($title) {
    $amp = '&amp;';
    $amp2 = '<span class="amp">&amp;</span>';
    $title = str_replace($amp, $amp2, $title);
    return $title;
  }
  add_filter('the_title', 'esperluette__titre');

  // Permet d'utiliser la meilleure esperluette disponible dans le contenu
  function esperluette__contenu($content){
    $amp = '&amp;';
    $amp2 = '<span class="amp">&amp;</span>';
    $content = str_replace($amp, $amp2, $content);
    return $content;
  }
  add_filter('the_content', 'esperluette__contenu');

?>
