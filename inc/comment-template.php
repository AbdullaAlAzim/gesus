<?php

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since 1.0.0
 * @version 1.0.0
 * @author CodexCoder
 */

function theone_comment_template( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php esc_html__( 'Pingback:', 'gesus' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'gesus' ), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" >
		
			   <div class="comment-author wow fadeInUp "  data-wow-delay="0.3s">
				  <div class="author-thumb">
					<?php echo get_avatar( $comment, 80); ?>

				</div><!-- .comments-image -->

                   <div class="description">
                         	
					     <div class="author-title">
							 <small><?php echo sprintf( esc_html__( '%1$s, %2$s', 'gesus' ), get_comment_date('M j'), get_comment_time('g.i a')) ; ?></small>
                            <a class="author-name" href="<?php echo get_comment_author_link(); ?>"><?php echo get_comment_author(); ?></a>
					
						</div>
						<div class="comment">
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'gesus' ); ?></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
					   </div>

					     <div class="gesus-reply">
							
							  <?php
								comment_reply_link( array_merge($args, array(
									'reply_text'		=> 'REPLY',
									'depth'				=> $depth,
									'max_depth'			=> $args['max_depth'],
								))); 
							  ?>
							
						</div>
					   </div>
		            </div>

			<?php
            break;
    endswitch; // end comment_type check

}