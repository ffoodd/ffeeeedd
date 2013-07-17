<?php
/**
 * Page d'archive d'un mot-clé
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

<?php if ( have_posts() ) { ?>

  <h2><?php _e( 'Tags', 'ffeeeedd' ); ?> : <?php echo single_tag_title( '', false ); ?></h2>

  <ol>
    <?php while ( have_posts() ) { the_post(); ?>
    <li <?php post_class( 'mb2' ); ?>>
      <article itemscope itemtype="http://schema.org/Article">
        <h3 itemprop="name">
          <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>
        </h3>
        <p class="print-hidden" itemprop="UserComments"><?php comments_number( '0', '1', '% ' ); ?></p>
        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image', 'alt' => __( 'Permalink to the post', 'ffeeeedd' ) ) ); ?>
        </a>
        <?php } ?>
        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate itemprop="datePublished"><?php the_time( __( 'j F Y', 'ffeeeedd' ) ); ?></time>
        <?php $excerpt = get_the_excerpt() ?>
        <p itemprop="description"><?php echo $excerpt ?></p>
        <footer><?php ffeeeedd__meta(); ?></footer>
      </article>
    </li>
    <?php } ?>
  </ol>

  <?php ffeeeedd__pagination(); ?>

  <?php } else { ?>
    <h2><?php _e( 'No post found tagged', 'ffeeeedd' ); ?> <?php echo single_tag_title( '', false ); ?>.</h2>
  <?php } ?>

<?php get_footer(); ?>