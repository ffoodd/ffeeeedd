<?php
/**
 * Page recherche
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

    <?php if ( have_posts() ) : ?>

		<h2><?php echo 'Recherche : ' . get_search_query() . '' ; ?></h2>
        
        <ol>
			<?php while ( have_posts() ) : the_post(); 
                $keys = implode('|', explode(' ', get_search_query()));
                $title = preg_replace('/('.$keys .')/iu', '<mark class="search-term inbl">\0</mark>', get_the_title());
                $excerpt = preg_replace('/('.$keys .')/iu', '<mark class="search-term inbl">\0</mark>', get_the_excerpt());
            ?>
				<li class="mb2">
                    <article itemscope itemtype="http://schema.org/Article">
                        <h3 itemprop="name"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark" itemprop="url"><?php echo $title ?></a></h3>
                        <time datetime="<?php the_time( 'j-F-Y' ); ?>" pubdate itemprop="datePublished"><?php the_date(); ?></time>
                        <p itemprop="description"><?php echo $excerpt; ?></p>
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

    <?php else : ?>
        <h2>Aucun article ne répond à votre critère de recherche.</h2>
        <p>Vous pouvez relancer une recherche :</p>
        <?php get_search_form(); ?>
    <?php endif; ?>

<?php get_footer(); ?>