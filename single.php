<?php
/**
 * Article
 * @author Gaël Poupard
 * @link www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 	WordPress
 * @subpackage 	ffeeeedd
 * @since 		ffeeeedd 1.0
 */
get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article itemscope itemtype="http://schema.org/Article" role="article">
            <h2 itemprop="name"><?php the_title(); ?></h2>
            <time datetime="<?php the_time( 'j-F-Y' ); ?>" pubdate itemprop="datePublished"><?php the_date(); ?></time>
            <div itemprop="articleBody"><?php the_content(); ?></div>
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
                <p class="print-hidden">Édité le <time class="updated" datetime="<?php the_modified_date( 'Y-m-d'); ?>" itemprop="dateModified"><?php the_modified_date(); ?></time>.</p>
                <p class="print-hidden">
                    <a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank" rel="nofollow" title="Partagez cet article sur Twitter">Partager sur Twitter</a>
                    <a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="_blank" rel="nofollow" title="Partagez cet article sur Facebook">Partager sur facebook</a>
                </p>
            </footer>
        </article>
    
        <?php comments_template( '', true ); ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>