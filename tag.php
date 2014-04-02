<?php
/**
 * Page d’archive d’un mot-clé
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
$paged = get_query_var( 'paged' );
$tags = array();
get_header(); ?>

<?php if ( have_posts() ) { ?>

  <h2>
    <?php _e( 'Tag :', 'ffeeeedd' ); ?>
    <?php echo single_tag_title( '', false ); ?>
    <?php if ( is_paged() ) {
      echo ' / Page ' . $paged;
    } ?>
  </h2>
  <?php if ( ! is_paged() ) {
    echo tag_description();
  } ?>

  <ol>
    <?php while ( have_posts() ) {
      the_post();
      // On récupère les mots-clés de l’article
      $ffeeeedd__tags = get_the_tags( $post->ID );
      if ( $ffeeeedd__tags ) {
        foreach ( $ffeeeedd__tags as $ffeeeedd__tag ) {
          // Et on les ajoute un par un au tableau $tags
          $tags[$posttag->term_id] = $ffeeeedd__tag->name;
        }
      } ?>
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
            <strong itemprop="author" class="vcard author">
              <a class="fn" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php the_author_meta( 'display_name' ); ?></a>
            </strong>.
            <?php $cats = get_the_category_list( ( ', ' ) );
            // Si l’article est catégorisé, on affiche le lien vers chaque catégorie.
            if ( $cats ) { ?>
              <?php _e( 'in', 'ffeeeedd' ); ?> <span itemprop="keywords"><?php echo $cats; ?></span>
            <?php } ?>.
            <?php _e( 'Last modified on', 'ffeeeedd' ); ?> <time class="updated" datetime="<?php the_modified_date( 'Y-m-d' ); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.
          </p>
        </footer>
      </article>
    </li>
    <?php }
      // On soustrait le mot-clé actuel au tableaux des mots-clés récupérés :
      $tag__actuel = array( single_tag_title( '', false ) );
      $tags = array_diff( $tags, $tag__actuel ); ?>
  </ol>

  <?php ffeeeedd__pagination(); ?>

  <?php if ( $tags ) { ?>
    <h3><?php _e( 'Related tags:', 'ffeeeedd' ); ?></h3>
    <ul>
      <?php foreach ( $tags as $slug ) {
        // Pour chaque mot-clé, on affiche le lien correspondant dans la liste.
        $tag = get_term_by( 'name', $slug, 'post_tag' );
        $lien = get_permalink( $tag->term_id ); ?>
        <li>
          <a href="<?php echo $lien; ?>"><?php echo $slug; ?></a>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>

  <?php } else { ?>
    <h2><?php _e( 'No post found tagged', 'ffeeeedd' ); ?> <?php echo single_tag_title( '', false ); ?>.</h2>
  <?php } ?>

<?php get_footer(); ?>
