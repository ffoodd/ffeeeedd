<?php
/**
 * Page 404
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */
get_header(); ?>

  <article role="article" itemscope itemtype="http://schema.org/Article">
    <header>
      <h1 itemprop="name"><?php echo __( 'Erreur 404', 'ffeeeedd' ); ?></h1>
      <h2 itemprop="description"><?php echo __( 'Page non trouvée', 'ffeeeedd' ); ?></h2>
    </header>
    <p itemprop="articleBody"><?php echo __( 'Elle a peut-être été déplacée ou supprimée ! Ne paniquez pas, on peut vous aider :', 'ffeeeedd' ); ?></p>
    <p class="h4-like"><?php echo __( 'Vous êtes ici :', 'ffeeeedd' ); ?> <span>&#10799;</span></p>
    <p><?php echo __( 'Si vous êtes perdu, voilà ce que nous vous proposons :', 'ffeeeedd' ); ?></p>
    <ul>
      <?php wp_nav_menu( array( 'theme_location' => '404', 'items_wrap' => '%3$s', 'container' => false ) ); ?>
      <li>
        <a href="mailto:<?php echo antispambot( bloginfo( 'admin_email' ) ); ?>"><?php echo __( 'Contacter l\'administrateur du site', 'ffeeeedd' ); ?></a>
      </li>
    </ul>
  </article>

<?php get_footer(); ?>