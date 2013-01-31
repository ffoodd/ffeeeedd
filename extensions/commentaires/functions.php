<?php 
// À copier dans functions.php dans la partie "Scripts & Styles"
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

// À copier dans functions.php, dans la partie "Extentions"
// Commentaires
    if ( ! function_exists( 'ffeeeedd_comment' ) ) :
    /**
     * Template pour les commentaires & pingbacks.
     */
    function ffeeeedd_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // On affiche différemment les trackbacks.
        ?>
        <li <?php comment_class(); ?>>
            <p><?php _e( 'Pingback :', '' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Modifier)', '' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
            default :
            // On passe aux commentaires standards.
            global $post;
        ?>
        <li itemscope itemtype="http://schema.org/UserComments">
            <article role="article">
                <header>
                    <?php
                        echo get_avatar( $comment, 44 );
                        printf( '<cite itemprop="creator">%1$s %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<small> ( Rédacteur ) </small>' : ''
					);
                        printf( '<time datetime="%2$s">%3$s</time>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
                        );
                    ?>
                </header>
    
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p>Votre commentaire est en attente de modération.</p>
                <?php endif; ?>
    
                <section itemprop="commentText">
                    <?php comment_text(); ?>
                    <?php edit_comment_link('Modifier', '<p>', '</p>' ); ?>
                </section>
    
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Répondre', 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </article>
        <?php
            break;
        endswitch;
    }
    endif; ?>