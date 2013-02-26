<?php
/**
 * Page d'archive d'un auteur
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

<?php if ( have_posts() ): the_post(); ?>

    <h2>Auteur : <?php echo get_the_author() ; ?></h2>    
    
    <?php if ( get_the_author_meta( 'description' ) ) : ?>
        <article itemscope itemtype="http://schema.org/Person">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
            <h3 itemprop="name"><?php echo get_the_author() ; ?></h3>
            <p itemprop="description"><?php the_author_meta( 'description' ); ?></p>
            <?php if ( get_the_author_meta( 'user_url' ) ) : ?>
                <a href="<?php echo get_the_author_meta( 'user_url' ); ?>" itemprop="url">Consulter son site</a>
            <?php endif; ?>  
        </article>
    <?php endif; ?>
    
    <ol>
        <?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
            <li class="mb2">
                <article itemscope itemtype="http://schema.org/Article">
                    <h3 itemprop="name"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h3>
                    <time datetime="<?php the_time( 'j-F-Y' ); ?>" pubdate itemprop="datePublished"><?php the_date(); ?></time>
                    <?php $excerpt = get_the_excerpt() ?>
                    <p itemprop="description"><?php echo $excerpt ?></p>
                </article>
            </li>
        <?php endwhile; ?>
    </ol>

    <?php
        global $wp_query;        
        $big = 999999999;        
        echo paginate_links( array(
            'base'         => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format'       => '?paged=%#%',
            'current'      => max( 1, get_query_var('paged') ),
            'total'        => $wp_query->max_num_pages,
            'prev_text'    => __('&larr; Précédent'),
            'next_text'    => __('Suivant &rarr;'),
            'type'         => 'list'
        ) );
    ?>

<?php else: ?>
    <h2><?php echo get_the_author() ; ?> n'a rédigé aucun article pour le moment.</h2>
<?php endif; ?>

<?php get_footer(); ?>