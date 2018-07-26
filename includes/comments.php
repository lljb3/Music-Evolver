<?php
    /**
	 * Custom callback for outputting comments 
	 *
	 * @return void
     * @author James Burrell
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment img-responsive'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li class="col-md-12" id="comment-post">
			<article id="comment-<?php comment_ID(); ?>">
				<div class="gravatar pull-left" id="main-icon">
					<?php echo get_avatar( $comment, 54 ); ?>
                <!-- end #main-icon --></div>
                <div class="comment-info pull-left" id="comment-info">
                    <h4 class="has-title"><?php comment_author_link() ?></h4>
                    <time class="comment-time">
                        <a href="#comment-<?php comment_ID() ?>" pubdate class="date-time">
                            <?php comment_date() ?> at <?php comment_time() ?>
                        <!-- end .date-time --></a>
                    <!-- end .comment-time --></time>
                    <?php comment_text() ?>
                <!-- end #comment-info --></div>
			<!-- end #comment-nth --></article>
		<!-- #comment-post --></li>
        <?php endif;
	}