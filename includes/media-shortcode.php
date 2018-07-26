<?php
	/* Media Shortcode Modify */
	add_filter('the_content', 'addlightboxrel_replace');
	function addlightboxrel_replace ($content) {
		global $post;
		$postid = get_post_gallery( get_the_ID(), false );
		$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto[%LIGHTID%]"$6>';
		$content = preg_replace($pattern, $replacement, $content);
		$content = str_replace("%LIGHTID%", $postid, $content);
		return $content;
	}
	function add_class_attachment_link($html){
		$postid = get_post_gallery( get_the_ID(), false );
		$html = str_replace('<a', '<a rel="prettyPhoto"', $html);
		return $html;
	}
	add_filter('wp_get_attachment_link','addlightboxrel_replace',10,1);
	// Custom filter function to modify default gallery shortcode output
	function my_post_gallery( $output, $attr ) {
		// Initialize
		global $post, $wp_locale;
		// Gallery instance counter
		static $instance = 0;
		$instance++;
		// Validate the author's orderby attribute
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
		}
		// Get attributes from shortcode
		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 6,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr ) );
		// Initialize
		$id = intval( $id );
		$attachments = array();
		if ( $order == 'RAND' ) $orderby = 'none';
		if ( ! empty( $include ) ) {
			// Include attribute is present
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			// Setup attachments array
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		} else if ( ! empty( $exclude ) ) {
			// Exclude attribute is present 
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			// Setup attachments array
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		} else {
			// Setup attachments array
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}
		if ( empty( $attachments ) ) return '';
		// Filter gallery differently for feeds
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			return $output;
		}
		// Filter tags and attributes
		$itemtag = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$columns = intval( $columns );
		$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
		$float = is_rtl() ? 'right' : 'left';
		$selector = "gallery-{$instance}";
		// Filter gallery CSS
		$output = apply_filters( 'gallery_style', "
			<div id='$selector' class='gallery galleryid-{$id} row'>"
		);
		// Iterate through the attachments in this gallery instance
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			// Attachment link
			$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false ); 	 
			// Start itemtag
			$output .= "<{$itemtag} class='gallery-item col-md-2 col-xs-6'>";	 
			// icontag
			$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";	 
			if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				// captiontag
				$output .= "
				<{$captiontag} class='gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
			}
			// End itemtag
			$output .= "</{$itemtag}>";
			// Line breaks by columns set
			if($columns > 0 && ++$i % $columns == 0) $output .= '<br style="clear: both">';
		}
		// End gallery output
		$output .= "
			<br style='clear: both;'>
		</div>\n";
		return $output;
	}
	// Apply filter to default gallery shortcode
	add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );