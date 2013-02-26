<?php
/**
 * Commentaires
 * @author Gaël Poupard
 * @link www.ffoodd.fr
 *
 * La zone de la page qui contient les commentaires et le formulaire pour commenter.
 *
 * @package 	WordPress
 * @subpackage 	ffeeeedd
 * @since 		ffeeeedd 1.0
 */

// On vérifier d'abord si la page est protégée : si c'est le cas, on n'affiche rien.
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title" itemprop="interactionCount">
			<?php
				printf( _n( 'Une réponse sur &ldquo;%2$s&rdquo;', '%1$s réponses surs &ldquo;%2$s&rdquo;', get_comments_number(), '' ),
					number_format_i18n( get_comments_number() ), '<span itemprop="discusses">' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist" itemprop="comment">
			<?php wp_list_comments( array( 'callback' => 'ffeeeedd_comment', 'style' => 'ol' ) ); ?>
		</ol>

		<?php // Si les commentaires ont été fermés :
            if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="nocomments">Les commentaires sont clos.</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</div>