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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article itemscope itemtype="http://schema.org/Article" role="article">
    <h2 itemprop="name"><?php the_title(); ?></h2>

    <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate itemprop="datePublished"><?php the_time( __('j F Y', 'ffeeeedd') ); ?></time>
    <div itemprop="articleBody"><?php the_content(); ?></div>

    <footer>
      <?php // Liste des catégories & tags avec un séparateur.
      $categories_list = get_the_category_list( ( ', ' ) );
      $tag_list = get_the_tag_list( '', ( ', ' ) );
      if ( '' != $tag_list ) {
        echo '<p>'. __('Article rédigé par', 'ffeeeedd') .' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a> '. __('et publié dans', 'ffeeeedd') .' <span itemprop="keywords">' . $categories_list . '.</span><br />'. __('Mots-clés', 'ffeeeedd') .' : <span itemprop="keywords">' . $tag_list . '.</span></p>';
      } elseif ( '' != $categories_list ) {
        echo '<p>'. __('Article rédigé par', 'ffeeeedd') .' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a> '. __('et publié dans', 'ffeeeedd') .' <span itemprop="keywords">' . $categories_list . '.</span></p>';
      } else {
        echo '<p>'. __('Article rédigé par', 'ffeeeedd') .' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="author">'. get_the_author() . '</a>.</p>';
      } ?>
      <p class="print-hidden"><?php echo __('Édité le', 'ffeeeedd'); ?> <time class="updated" datetime="<?php the_modified_date( 'Y-m-d' ); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.</p>
      <p class="print-hidden">
        <a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank" rel="nofollow" title="<?php echo __('Partagez cet article sur Twitter', 'ffeeeedd'); ?>"><?php echo __('Partager sur Twitter', 'ffeeeedd'); ?></a>
        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&t=<?php the_title_attribute() ?>" target="_blank" rel="nofollow" title="<?php echo __('Partagez cet article sur Facebook', 'ffeeeedd'); ?>"><?php echo __('Partager sur Facebook', 'ffeeeedd'); ?></a>
        <a href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" rel="nofollow" title="<?php echo __('Partagez cet article sur Google+', 'ffeeeedd'); ?>"><?php echo __('Partager sur Google+', 'ffeeeedd'); ?></a>
        <a href="mailto:?subject=<?php the_title_attribute() ?>?body=<?php the_permalink() ?>" target="_blank" rel="nofollow" title="<?php echo __('Envoyez cet article par Email', 'ffeeeedd'); ?>"><?php echo __('Envoyer par email', 'ffeeeedd'); ?></a>
        <!-- Mise en place d'une mécanique simple pour l'impression, en fonction de l'activation du js -->
        <a href="javascript:window.print()" target="_blank" rel="nofollow" title="<?php echo __('Imprimez cet article', 'ffeeeedd'); ?>" class="js-visible"><?php echo __('Imprimer', 'ffeeeedd'); ?></a>
        <strong class="js-hidden"><?php echo __('Pour imprimer cette page, utilisez le raccourci <kbd>Ctrl + P</kbd>', 'ffeeeedd'); ?></strong>
      </p>
    </footer>
  </article>

  <?php comments_template( '', true ); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
