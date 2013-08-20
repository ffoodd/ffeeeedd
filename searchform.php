<?php
/**
 * Formulaire de recherche
 * @author Gaël Poupard
 * @link www.ffoodd.fr
 *
 * @package   WordPress
 * @subpackage  ffeeeedd
 * @since     ffeeeedd 1.0
 */
?>

  <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" aria-hidden="true"><?php _e( 'Search', 'ffeeeedd' ); ?></label>
    <input id="s" type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'ffeeeedd' ); ?>" />
    <input type="submit" name="submit" value="<?php esc_attr_e( 'Search', 'ffeeeedd' ); ?>" />
  </form>
