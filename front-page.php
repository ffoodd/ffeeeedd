<?php
/**
 * Template Name: Accueil
 * Page d'accueil
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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <article itemscope itemtype="http://schema.org/Article" role="article" class="col">
    <h2 itemprop="name"><?php the_title(); ?></h2>

    <div itemprop="articleBody"><?php the_content(); ?></div>
  </article>
<?php endwhile; ?>

<?php get_sidebar( 'home' ); ?>

<?php get_footer(); ?>
