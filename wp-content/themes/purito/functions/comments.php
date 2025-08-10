<?php
/* PUT COMMENT TEXTAREA AFTER NAME AND EMAIL */
function jt_move_comment_field_to_bottom( $fields ) {
	
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	
	return $fields;
}
add_filter( 'comment_form_fields', 'jt_move_comment_field_to_bottom' );



/*
function comments_callback($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

        <div class="comment-inner">
            <figure class="comment-avatar">
                <?php echo get_avatar( $comment, 48 ) ?>
            </figure>

            <div class="comment-content">
                <div class="comment-head">
                    <b class="author-name"><?php printf(__('%s'), get_comment_author_link()) ?></b>
                    <span class="comment-date"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></span>
                </div>
                <div class="comment-body">
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>

        <!--
        <?php if ($comment->comment_approved == '0') : ?>
            <em><php _e('Your comment is awaiting moderation.') ?></em><br />
        <?php endif; ?>
        -->

        <!--
        <div class="reply">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        -->

<?php
}
*/
?>
