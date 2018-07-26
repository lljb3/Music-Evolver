<?php
	/**
	 * Starkers functions and definitions
	 * Rewritten for Kake HMD Corporate Full Theme
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package WordPress
 	 * @subpackage Starkers
 	 * @since Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	/* Starkers Utilities */
	require_once( 'external/starkers-utilities.php' );

	/* Redux Framework */
	require_once( 'install/installer.php' );
	require_once( 'install/options.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	function register_my_menu() {
		register_nav_menu( 'primary', 'Home Menu' );
		register_nav_menu( 'secondary', 'Other Menu' );
		register_nav_menu( 'shop', 'Shop Menu' );
	}
	add_action( 'after_setup_theme', 'register_my_menu' );
	
	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer', 99999999 );
	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types, included plugins, and taxonomies here
	
	======================================================================================================================== */

	require_once( 'includes/discography/discography-plugin.php' );
	require_once( 'includes/shows/shows-plugin.php' );
	require_once( 'includes/videos/videos-plugin.php' );
	require_once( 'includes/add-media-url/add-media-url.php' );

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	require_once('includes/scripts.php');

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	require_once('includes/comments.php');
	
	/* ========================================================================================================================
	
	Extra Functions
	
	======================================================================================================================== */
	
	/* Slider Post Custom Meta */
	require_once('includes/slidermeta.php');
		
	/* Widget Areas */
	require_once('includes/widget-areas.php');
	
	/* Media Shortcode Modify */
	require_once('includes/media-shortcode.php');
			
	/* Register Custom Navigation Walker */
	require_once('includes/bootstrap-navwalker.php');

	/* WooCommerce Functions */
	require_once('includes/woocommerce.php');
	
	/* Other Theme Functions */
	require_once('includes/others.php');