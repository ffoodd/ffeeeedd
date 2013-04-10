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

<?php if ( have_posts() ): ?>

  <h2>Mot-clé : <?php echo single_tag_title( '', false ); ?></h2>

  <ol>
    <?php while ( have_posts() ) : the_post(); ?>
    <li class="mb2">
      <article itemscope itemtype="http://schema.org/Article">
        <h3 itemprop="name"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h3>

        <p itemprop="UserComments"><?php comments_number( '0', '1', '% ' ); ?></p>
        <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" itemprop="image"><?php the_post_thumbnail(); ?></a>
        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate itemprop="datePublished"><?php the_time( 'j F Y' ); ?></time>
        <?php $excerpt = get_the_excerpt() ?>
        <p itemprop="description"><?php echo $excerpt ?></p>

        <footer>
          <?php // Liste des catégories & tags avec un séparateur.
          $categories_list = get_the_category_list( __( ', ' ) );
          $tag_list = get_the_tag_list( '', __( ', ' ) );
          if ( '' != $tag_list ) {
            echo '<p>Article rédigé par <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a> et publié dans ' . $categories_list . '.<br />Mots-clés : ' . $tag_list . '.</p>';
          } elseif ( '' != $categories_list ) {
            echo '<p>Article rédigé par <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a> et publié dans ' . $categories_list . '.</p>';
          } else {
            echo '<p>Article rédigé par <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a>.</p>';
          } ?>
          <p>Édité le <time class="updated" datetime="<?php the_modified_date( 'Y-m-d'); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.</p>
        </footer>
      </article>
    </li>
    <?php endwhile; ?>
  </ol>

  <?php theme_pagination(); ?>

  <?php else: ?>
  <h2>Il n'y a aucun article étiquetté avec le mot-clé <?php echo single_tag_title( '', false ); ?></h2>
  <?php endif; ?>

<?php get_footer(); ?>
