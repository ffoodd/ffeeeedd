<?php
/**
 * Page d’archive d’un auteur
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

<?php if ( have_posts() ) { the_post(); ?>

  <h2><?php _e( 'Author', 'ffeeeedd' ); ?> : <?php echo get_the_author_meta( 'display_name' ); ?></h2>

  <article itemscope itemtype="http://schema.org/Person">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
    <h3 itemprop="name"><?php echo get_the_author_meta( 'display_name' ); ?></h3>
    <?php if ( get_the_author_meta( 'description' ) ) { ?>
      <p itemprop="description"><?php the_author_meta( 'description' ); ?></p>
    <?php } ?>
    <?php if ( get_the_author_meta( 'user_url' ) ) { ?>
      <a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>" itemprop="url"><?php _e( 'Website', 'ffeeeedd' ); ?></a>
    <?php } ?>
  </article>

  <ol>
    <?php while ( have_posts() ) { the_post(); ?>
    <li <?php post_class( 'mb2' ); ?>>
      <article itemscope itemtype="http://schema.org/Article">
        <h3 itemprop="name">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url" tabindex="-1"><?php the_title(); ?></a>
        </h3>
        <p class="print-hidden" itemprop="UserComments"><?php comments_number( '0', '1', '% ' ); ?></p>
        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" tabindex="-1" aria-hidden="true">
          <?php the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image', 'alt' => __( 'Permalink to the post', 'ffeeeedd' ) ) ); ?>
        </a>
        <?php } ?>
        <time datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( __( 'j F Y', 'ffeeeedd' ) ); ?></time>
        <?php $excerpt = get_the_excerpt() ?>
        <p itemprop="description"><?php echo $excerpt ?></p>
        <footer>
          <p>
            <?php _e( 'Last modified on', 'ffeeeedd' ); ?> <time class="updated" datetime="<?php the_modified_date( 'Y-m-d' ); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.
            <?php $cats = get_the_category_list( ( ', ' ) );
            // Si l’article est catégorisé, on affiche le lien vers chaque catégorie.
            if ( $cats ) { ?>
              <br /><?php _e( 'Categories:', 'ffeeeedd' ); ?> <span itemprop="keywords"><?php echo $cats; ?></span>
            <?php } ?>.
            <?php $tags = get_the_tag_list( '', ( ', ' ) );
            // Si l’article est associé à des mots-clés, on affiche le lien vers chaque mot-clé.
            if ( $tags ) { ?>
            <br /><?php _e( 'Tags:', 'ffeeeedd' ); ?> <span itemprop="keywords"><?php echo get_the_tag_list( '', ( ', ' ) ); ?></span>.
            <?php } ?>
          </p>
        </footer>
      </article>
    </li>
    <?php } ?>
  </ol>

  <?php ffeeeedd__pagination(); ?>

  <?php } else { ?>
    <h2><?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'didn\'t write anything for now.', 'ffeeeedd' ); ?>.</h2>
  <?php } ?>

<?php get_footer(); ?>
