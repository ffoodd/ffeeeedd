<?php
/**
 * Commentaires
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */

// On vérifie d'abord si la page est protégée : si c'est le cas, on n'affiche rien.
if ( post_password_required() ) {
  return;
} ?>

<div class="comments-area print-hidden" id="comments">
  <?php if ( have_comments() ) { ?>
    <h2 class="comments-title" itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">
    <?php
      printf( _n( __( 'First thought on &ldquo;%2$s&rdquo;', 'ffeeeedd' ), __( '%1$s thoughts on &ldquo;%2$s&rdquo;', 'ffeeeedd' ), get_comments_number(), '' ),
      number_format_i18n( get_comments_number() ), '<span itemprop="discusses">' . get_the_title() . '</span>' );
    ?>
    </h2>

    <ol class="commentlist" itemprop="comment">
      <?php wp_list_comments( array( 'callback' => 'ffeeeedd_comment', 'style' => 'ol' ) ); ?>
    </ol>

    <?php // Si les commentaires ont été fermés :
    if ( ! comments_open() && get_comments_number() ) { ?>
      <p class="nocomments"><?php _e( 'Comments are closed.', 'ffeeeedd' ); ?>.</p>
    <?php }
  } ?>

  <?php comment_form(); ?>
</div>
