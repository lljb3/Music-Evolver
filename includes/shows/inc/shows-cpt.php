<?php
	// Start Plugin
	function create_shows_posttype() {
		register_post_type( 'shows',
		// CPT Options
			array(
				'description' => __( 'Upcoming Events' ),
				'labels' => array(
					'name' => ( 'Shows' ),
					'slug' => 'shows',
					'singular_name' => __( 'Show' ),
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Show',
					'edit' => 'Edit',
					'edit_item' => 'Edit Show',
					'new_item' => 'New Show',
					'view' => 'View',
					'view_item' => 'View Show',
					'search_items' => 'Search Shows',
					'not_found' => 'No Shows found',
					'not_found_in_trash' => 'No Shows found in Trash',
					'parent' => 'Parent Show'
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'shows'),
				'supports' => array('title','editor','thumbnail','revisions','custom-fields'),
				'taxonomies' => array( 'venue' ),
				'menu_position' => 6,
				'menu_icon' => 'dashicons-calendar-alt',
				//'register_meta_box_cb' => 'add_events_metaboxes'
			)
		);
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_shows_posttype' );

	// Order by Alphabet
	function shows_order_classes( $query ) {
		if ( $query->is_post_type_archive('shows') && $query->is_main_query() ) {
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
			$query->set( 'post_status', 'any' );
		}
	}
	add_action( 'pre_get_posts', 'shows_order_classes' );