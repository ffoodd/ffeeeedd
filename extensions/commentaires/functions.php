<?php
/**
 * ffeeeedd : Colonnes latérales
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */

// À copier dans functions.php dans la partie "Scripts & Styles"

  // Réponse aux commentaires
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
                ( $comment->user_id === $post->post_author ) ? '<small> ('. __('Rédacteur', 'ffeeeedd') .') </small>' : ''
              );
              printf( '<time datetime="%2$s" itemprop="commentTime">%3$s</time>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
              );
            ?>
          </header>

          <?php if ( '0' == $comment->comment_approved ) : ?>
          <p><?php echo __('Votre commentaire est en attente de modération', 'ffeeeedd'); ?>.</p>
          <?php endif; ?>

          <section itemprop="commentText">
            <?php comment_text(); ?>
            <?php edit_comment_link( __( 'Modifier', ''), '<p>', '</p>' ); ?>
          </section>

          <div class="reply" itemprop="replyToUrl">
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Répondre', ''), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div>
        </article>
      <?php
        break;
        endswitch;
  }
  endif;

  // Ajout des types de champs HTML5 url et email sur les commentaires
  // Ajout de l'attribut HTML5 required sur le nom et l'email
  add_filter('comment_form_defaults', 'fields_html5');

  if ( !function_exists('fields_html5')) {
    function fields_html5( $fields ) {
      // Type author
      $fields['fields']['author'] = '
      <p class="comment-form-author">
        <label for="author">'. __( 'Name' ) .' <span class="required">*</span></label>
        <input id="author" name="author" value="" aria-required="true" required="required" size="30" type="text" />
      </p>
      ';
      // Type email
      $fields['fields']['email'] = '
      <p class="comment-form-email">
        <label for="email">'. __( 'Email' ) .' <span class="required">*</span></label>
        <input id="email" name="email" value="" aria-required="true" required="required" size="30" type="email" />
      </p>
      ';
      // Type url et placeholder http://
      $fields['fields']['url'] = '
      <p class="comment-form-url">
        <label for="url">'. __( 'Website' ) .'</label>
        <input id="url" name="url" value="" placeholder="http://" size="30" type="url" />
      </p>
      ';
      return $fields;
    }
  }

  // Ajout de l'attribut HTML5 required sur le textarea
  add_filter('comment_form_defaults','changing_comment_form_defaults');
  function changing_comment_form_defaults($defaults){
    $defaults['comment_field']='<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';
    return $defaults;
  }

?>
