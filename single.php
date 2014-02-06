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
    <h2 itemprop="name" class="entry-title"><?php the_title(); ?></h2>

    <time datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( __( 'j F Y', 'ffeeeedd' ) ); ?></time>
    <div itemprop="articleBody"><?php the_content(); ?></div>

    <footer>
      <?php ffeeeedd__meta(); ?>
    </footer>
  </article>

  <?php comments_template( '', true ); ?>

<?php }
  } ?>

<?php get_footer(); ?>
