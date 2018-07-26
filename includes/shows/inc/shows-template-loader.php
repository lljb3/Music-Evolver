<?php
	// Template Files
	function include_shows_template( $template_path ) {
		if( get_post_type() == 'shows' ) {
			if( is_single() ) {
				// checks if the file exists in the theme first,
				// otherwise serve the file from the plugin
				if ( $theme_file = locate_template( array ( 'single-shows.php' ) ) ) {
					$template_path = $theme_file;
				}
			}
			elseif( is_archive() ) {
				if( $theme_file = locate_template( array ( 'archive-shows.php' ) ) ) {
					$template_path = $theme_file;
				}
			}
		}
		return $template_path;
	}
	add_filter( 'template_include', 'include_shows_template', 1 );