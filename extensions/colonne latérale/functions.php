<?php
/**
 * ffeeeedd : Colonnes latérales
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */
// À copier dans functions.php selon les besoins

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

?>
