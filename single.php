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
 * @see           http://schema.org/Article
 * @see           http://php.net/manual/fr/function.date.php
 */
get_header(); ?>


<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
  <article role="article" itemscope itemtype="http://schema.org/Article" <?php post_class( 'col w-75' ); ?>>
    <h2 itemprop="name" class="entry-title"><?php the_title(); ?></h2>

    <time datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( __( 'j F Y', 'ffeeeedd' ) ); ?></time>
    <div itemprop="articleBody"><?php the_content(); ?></div>

    <footer>
      <?php if( function_exists( 'ffeeeedd__notes' ) ) {
        ffeeeedd__notes();
      } ?>

      <?php ffeeeedd__meta(); ?>

      <?php if( function_exists( 'ffeeeedd__partage' ) ) {
        ffeeeedd__partage();
      } ?>
    </footer>

    <?php comments_template( '', true ); ?>

  </article>

<?php get_sidebar();
  }
} ?>

<?php get_footer(); ?>
