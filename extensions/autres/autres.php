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

  // Utiliser la dernière version de jQuery sur le CDN Google, si besoin !
  if( !is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, null, false);
    wp_enqueue_script('jquery');
  }

  // js activé : 'no-js' devient 'js'
  function add_js_test () {
    echo '<script>document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,"js");</script>';
  }
  add_action('wp_head', 'add_js_test');

?>
