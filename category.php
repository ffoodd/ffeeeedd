<?php
/**
 * Page d’archive d’une catégorie
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 *
 * @note          Si la balise <p> de la description vous gêne, ajoutez ce code dans votre functions.php :
 * @note          remove_filter( 'term_description', 'wpautop' );
 * @see           http://wpchannel.com/supprimer-balise-p-category_description-wordpress/
 * @author        Aurélien denis
 *
 * @note          La description et la liste des sous-catégories sont utiles au référencement.
 * @note          Elles ajoutent un caractère unique à la page afin d’éviter les contenus dupliqués.
 * @see           « Optimiser son référencement WordPress »
 * @see           https://twitter.com/seomixfr
 * @author        Daniel Roch
 */
$parent = array(
  'parent' => get_queried_object_id(),
  'title_li' => __( 'Subcategories may interest you:', 'ffeeeedd' ),
  'show_count' => 1
);
$paged  = get_query_var( 'paged' );
get_header(); ?>

<?php if ( have_posts() ) { ?>

  <h2>
    <?php _e( 'Category:', 'ffeeeedd' ); ?>
    <?php echo single_cat_title( '', false ); ?>
    <?php if ( is_paged() ) {
      echo ' / Page ' . $paged;
    } ?>
  </h2>

  <?php if ( ! is_paged() ) {
    echo category_description();
  } ?>

  <?php if ( count( get_categories( $parent ) ) ) { ?>
    <ul>
      <?php wp_list_categories( $parent ); ?>
    </ul>
  <?php } ?>


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
          <p><?php _e( 'Entry written by', 'ffeeeedd' ); ?>
            <<strong itemprop="author" class="vcard author">
              <a class="fn" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php the_author_meta( 'display_name' ); ?></a>
            </strong>.
            <?php _e( 'Last modified on', 'ffeeeedd' ); ?> <time class="updated" datetime="<?php the_modified_date( 'Y-m-d' ); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.
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
    <h2><?php _e( 'Nothing found in ', 'ffeeeedd' ); ?> <?php echo single_cat_title( '', false ); ?>.</h2>
  <?php } ?>

<?php get_footer(); ?>
