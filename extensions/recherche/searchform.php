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

  <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" aria-hidden="true"><?php _e( 'Rechercher' ); ?></label>
    <input type="search" name="s" id="s" placeholder="<?php esc_attr_e( 'Rechercher' ); ?>" />
    <input type="submit" name="submit" value="<?php esc_attr_e( 'Rechercher' ); ?>" />
  </form>
