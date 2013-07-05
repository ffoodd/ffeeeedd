<?php
/**
 * Article
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 * @see           http://www.crea-fr.com/blog/15-liens-de-partage-pour-les-reseaux-sociaux/
 * @note          Pour permettre le partage sur d'autres réseaux
 * @see           http://schema.org/Article
 * @see           http://php.net/manual/fr/function.date.php
 */
get_header(); ?>

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
  <article role="article" itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
    <h2 itemprop="name"><?php the_title(); ?></h2>

    <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate itemprop="datePublished"><?php the_time( __( 'j F Y', 'ffeeeedd' ) ); ?></time>
    <div itemprop="articleBody"><?php the_content(); ?></div>

    <footer>
      <?php ffeeeedd__meta(); ?>
      <p class="print-hidden">
        <a href="http://twitter.com/home?status=<?php esc_url( the_permalink() ) ?>" target="_blank" rel="nofollow"><?php echo __( 'Partager sur Twitter', 'ffeeeedd' ); ?></a>
        <a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ) ?>&t=<?php the_title_attribute() ?>" target="_blank" rel="nofollow"><?php echo __( 'Partager sur Facebook', 'ffeeeedd' ); ?></a>
        <a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ) ?>" target="_blank" rel="nofollow"><?php echo __( 'Partager sur Google+', 'ffeeeedd' ); ?></a>
        <a href="mailto:?subject=<?php the_title_attribute() ?>?body=<?php esc_url( the_permalink() ) ?>" target="_blank" rel="nofollow"><?php echo __( 'Envoyer par email', 'ffeeeedd' ); ?></a>
        <!-- Mise en place d'une mécanique simple pour l'impression, en fonction de l'activation du js -->
        <a class="js-visible" href="javascript:window.print()" target="_blank" rel="nofollow" title="<?php echo esc_attr__( 'Imprimez cet article', 'ffeeeedd' ); ?>"><?php echo __( 'Imprimer', 'ffeeeedd' ); ?></a>
        <strong class="js-hidden"><?php echo __( 'Pour imprimer cette page, utilisez le raccourci <kbd>Ctrl + P</kbd>', 'ffeeeedd' ); ?></strong>
      </p>
    </footer>
  </article>

  <?php comments_template( '', true ); ?>

<?php }
  } ?>

<?php get_footer(); ?>