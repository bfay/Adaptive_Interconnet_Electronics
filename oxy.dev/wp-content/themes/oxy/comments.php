<?php

/**
 * @package oxy
 * 
 */

?>

<?php
	if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'oxy' ); ?></p>
<?php

	return;
	endif; 
?>    

<div id="articleComments">
<?php if ( have_comments() ) : ?>
<?php if ( post_password_required() ) : ?>

	<h4 class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'oxy' ); ?></h4>

	</div><!--#articleComments -->

<?php		
		return;
	endif;
	global $post;
?>

    <h4>

	<?php printf( _n( 'One thought on &ldquo; %2$s &rdquo;', '%1$s thoughts on &ldquo; %2$s &rdquo;', get_comments_number(), 'oxy' ),

					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
	?>

	</h4>

    <div id="comments">

    	<ul class="commentList">
        	<?php
                    $GLOBALS['ncc'] = 1;
                    $args = array( 'type'=>'comment', 'style'=>'', 'callback' => 'oxy_comment' );
                    wp_list_comments($args);
                ?>
        </ul><!--.commentList -->

    </div><!--#comments -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

		<nav id="comment-nav-above">

			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'oxy' ); ?></h1>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'oxy' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'oxy' ) ); ?></div>

		</nav>

	<?php endif; // check for comment navigation ?>

<?php endif;?>
<?php
$user = wp_get_current_user();
$user_identity = $user->display_name;

$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$formargs = array(
	
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply','oxy' ),
  'title_reply_to'    => __( 'Leave a Reply to %s','oxy' ),
  'cancel_reply_link' => __( 'Cancel Reply','oxy' ),
  'label_submit'      => __( 'SUBMIT','oxy' ),

  'comment_field' =>  '<div class="large-2 medium-3 small-12 columns"><label for="comment"><strong>' . ( $req ? '<span class="required">*</span> ' : '' ) . _x( 'Comment:', 'noun', 'oxy' ) .
    '</strong></label></div><div class="large-10 medium-9 small-12 columns"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea></div>',

  'must_log_in' => '<div class="large-12 columns">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.','oxy' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</div><br /><br />',

  'logged_in_as' => '<div class="large-12 columns">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','oxy' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</div><br /><br />',

  'comment_notes_before' => '<div class="large-12 columns">' .
    __( 'Your email address will not be published.','oxy' ) . ( $req ? '<span class="required">*</span>' : '' ) .
    '</div><br /><br />',
	'comment_notes_after' => '',
  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="large-2 medium-3 small-12 columns">' .
      '<label for="author"><strong>' .( $req ? '<span class="required">*</span> ' : '' ) . __( 'Name:', 'oxy' ) . '</strong></label></div> '  .
      '<div class="large-10 medium-9 small-12 columns"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'email' =>
      '<div class="large-2 medium-3 small-12 columns"><label for="email"><strong>' .
      ( $req ? '<span class="required">*</span> ' : '' ) . __( 'Email:', 'oxy' ) . '</strong><span class="note">('.__('Not Published','oxy').')</span></label></div> ' .
      '<div class="large-10 medium-9 small-12 columns"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'url' =>
      '<div class="large-2 medium-3 small-12 columns"><label for="url"><strong>' .
      __( 'Website:', 'oxy' ) . '</strong><span class="note">('.__('Site url with http://','oxy').')</span></label></div>' .
      '<div class="large-10 medium-9 small-12 columns"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div>'
    )
  ),
);
echo "<div class='row'>";
comment_form($formargs); 
echo "</div>";
?>
</div><!--#articleComments -->
