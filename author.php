<?php
/**
 * Page d'archive d'un auteur
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

<?php if ( have_posts() ): the_post(); ?>

  <h2><?php echo __('Auteur', 'ffeeeedd'); ?> : <?php echo get_the_author() ; ?></h2>

  <?php if ( get_the_author_meta( 'description' ) ) : ?>
  <article itemscope itemtype="http://schema.org/Person">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
    <h3 itemprop="name"><?php echo get_the_author() ; ?></h3>

    <p itemprop="description"><?php the_author_meta( 'description' ); ?></p>
    <?php if ( get_the_author_meta( 'user_url' ) ) : ?>
    <a href="<?php echo get_the_author_meta( 'user_url' ); ?>" itemprop="url"><?php echo __('Consulter son site', 'ffeeeedd'); ?></a>
    <?php endif; ?>
  </article>
  <?php endif; ?>

  <ol>
    <?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
    <li class="mb2">
      <article itemscope itemtype="http://schema.org/Article">
        <h3 itemprop="name"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h3>

        <p itemprop="UserComments"><?php comments_number( '0', '1', '% ' ); ?></p>
        <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" itemprop="image"><?php the_post_thumbnail(); ?></a>
        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate itemprop="datePublished"><?php the_time( __('j F Y', 'ffeeeedd') ); ?></time>
        <?php $excerpt = get_the_excerpt() ?>
        <p itemprop="description"><?php echo $excerpt ?></p>

        <footer><?php ffeeeedd__meta(); ?></footer>
      </article>
    </li>
    <?php endwhile; ?>
  </ol>

  <?php ffeeeedd__pagination(); ?>

  <?php else: ?>
  <h2><?php echo get_the_author() ; ?> <?php echo __('n\'a rédigé aucun article pour le moment', 'ffeeeedd'); ?>.</h2>
  <?php endif; ?>

<?php get_footer(); ?>
