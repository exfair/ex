<?php
/**
 * Comments template
 *
 * @package Fasto
 * @author fribba
 *
 * If no password is supplied for the protected post exit early
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			if ( 1 === get_comments_number() ) {
				printf(
					esc_html__( '1 Comment', 'fasto' )
				);
			} else {
				printf(
					/* translators: number of comments */
					 esc_html( _n( '%1$s Comment ', '%1$s Comments ', get_comments_number(), 'fasto' ) ),
					 esc_html( number_format_i18n( get_comments_number() ) )
				);
			}
			?>
		</h2>

		<ul class="commentlist">
			<?php
			wp_list_comments(
				array(
					'callback' => 'fasto_comment',
					'style'    => 'ol',
				)
			);
			?>
		</ul><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h2 class="comment=navigation"><?php esc_html_e( 'Comment navigation', 'fasto' ); ?></h2>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'fasto' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'fasto' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		if ( ! comments_open() && get_comments_number() ) :
			?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'fasto' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->