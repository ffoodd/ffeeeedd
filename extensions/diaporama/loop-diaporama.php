<?php
/**
 * Le diaporama
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */

// À mettre tel quel dans le thème;
// Ajouter l'appel à ce fichier dans le template qui doit l'accueillir : get_template_part( 'loop', 'diaporama' );

  // Les articles mis en avant vont dans le diaporama
  $sticky = get_option( 'sticky_posts' );
  // On exécute que s'il y a un article mis en avant
  if ( ! empty( $sticky ) ) :
    $featured_args = array(
      'post__in' => $sticky,
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 5,
      'no_found_rows' => true,
    );

    // La requête spécifique
    $featured = new WP_Query( $featured_args );
    // On exécute que s'il y a un article
    if ( $featured->have_posts() ) :
      // On va devoir compter le nombre d'articles pour créer la navigation
      $counter_slider = 0;
    ?>

    <section class="mw960p featured-posts mod print-hidden">
      <div class="item">
        <?php
        // Et c'est parti !
        while ( $featured->have_posts() ) : $featured->the_post();
        // On incrémente le compteur
        $counter_slider++; ?>
        <article class="w100 featured-post" id="featured-post-<?php echo $counter_slider; ?>"  itemscope itemtype="http://schema.org/Article" role="article">
          <aside itemprop="image">
            <?php the_post_thumbnail( 'large-feature' ); ?>
          </aside>

          <header>
            <h1 itemprop="name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h1>
          </header>

          <p itemprop="description">
            <?php the_excerpt(); ?>
          </p>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <?php // Afficher la navigation si on a plus d'un article
      if ( $featured->post_count > 1 ) : ?>
      <nav class="feature-slider item">
        <ul class="m-reset p-reset">
          <?php
          // On remet le compteur à zéro afin d'avoir le même nombre d'articles
          $counter_slider = 0;
          // On reprend à zéro
          rewind_posts();
          // Et c'est re-parti !
          while ( $featured->have_posts() ) : $featured->the_post();
          $counter_slider++;
          if ( 1 == $counter_slider )
            $class = 'class="active inbl"';
          else
            $class = 'class="inbl"';
          ?>
          <li class="inbl"><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php the_title_attribute(); ?>" <?php echo $class; ?>></a></li>
          <?php endwhile; ?>
        </ul>
      </nav>
      <?php endif; // Fin de la condition pour afficher la navigation. ?>
    </section><!-- .featured-posts -->

    <?php endif; // Fin de la condition pour afficher le diaporama. ?>

  <?php endif; wp_reset_query(); // Fin de la recherche d'article(s) mis en avant. ?>
