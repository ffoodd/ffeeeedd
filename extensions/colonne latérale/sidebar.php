<?php
/**
 * La colonne latérale des pages
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */

// On vérifie si la colonne latérale est active; si elle en l'est pas, on ne l'affiche pas.
if ( ! is_active_sidebar( 'pages' ))
  return;
?>

<aside class="col w25 print-hidden" role="complementary">
  <?php if ( is_active_sidebar( 'pages' )) { dynamic_sidebar( 'pages' ); } ?>
</aside>
