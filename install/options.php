<?php
	include_once( 'reduxcore/loader.php' );
	require_once( 'reduxcore/framework.php' );
	require_once( 'options/kake-config.php' );
	
	/* ========================
		Login Functions
	======================== */
	function tt_custom_login() {
		// Login Page Logo
		$output  = '<style type="text/css">';
		global $kake_theme_option;
		$login_logo = $kake_theme_option['logo-login']['url'];
		$background_login = $kake_theme_option['background-login'];
		if ( !empty( $login_logo ) ) {
			$output .= '.login h1 a { background: url(' . $login_logo . ') 50% 50% no-repeat !important; width: auto; }';
		}
		if ( $background_login ) {
			$output .= '.login { background-color: ' . $background_login . '; }';
		}
		else {
			$output .= '.login { background-color: #f8f8f8; }';
		}
		$output .= '.login form input[type="submit"] { border-radius: 0; border: none; -webkit-box-shadow: none; box-shadow: none; }';
		$output .= '.login form .input, .login .form input:focus { padding: 5px 10px; color: #666; -webkit-box-shadow: none; box-shadow: none; }';
		$output .= 'input[type=checkbox]:focus, input[type=email]:focus, input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=url]:focus, select:focus, textarea:focus { -webkit-box-shadow: none; box-shadow: none; }';
		$output .= '</style>';
		
		echo $output;
		
		// Remove Login Shake
		remove_action('login_head', 'wp_shake_js', 12);
	}
	add_action('login_head', 'tt_custom_login');
	
	// Login Logo Link
	function tt_wp_login_url() {
		return home_url();
	}
	add_filter('login_headerurl', 'tt_wp_login_url');
	
	// Add Lost Password Link
	function tt_add_lost_password_link() {
		return '<a href="' . wp_lostpassword_url(false) . '">Lost Password?</a>';
	}
	add_action( 'login_form_bottom', 'tt_add_lost_password_link' );
	
	// Login Failed
	function tt_login_failed( $user ) {
		$referrer = $_SERVER['HTTP_REFERER'];
		
		// Check that were not on the default login page
		if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) && $user != null ) {
		// Make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed' ) ) {
			// Redirect to login page and append a querystring of login failed
			wp_redirect( $referrer . '?login=failed');
		} else {
			wp_redirect( $referrer );
		}
			exit;
		}
	}
	add_action( 'wp_login_failed', 'tt_login_failed' );
	function tt_login_blank( $user ) {
		$referrer = $_SERVER['HTTP_REFERER'];
		$error = false;
		// Check Login
		if( isset($_POST['log']) && $_POST['log'] == '' || isset($_POST['pwd']) && $_POST['pwd'] == '') {
			$error = true;
		}
		// Check that were not on the default login page
		if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer, 'wp-admin' ) && $error ) {
		// Make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed') ) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer . '?login=failed' );
		} else {
			wp_redirect( $referrer );
		}
			exit;
		}
	}
	add_action( 'authenticate', 'tt_login_blank');

	// Disable WP Admin for Non Users
	function tt_remove_admin_bar() {
		if ( !current_user_can('administrator') && !is_admin() ) {
		  show_admin_bar(false);
		}
	}
	add_action('after_setup_theme', 'tt_remove_admin_bar'); 
	function tt_disable_wp_admin_for_non_admins() {
		if ( !current_user_can('manage_options') &&  $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php' && !tt_ajax_add_remove_favorites() && !tt_ajax_update_user_profile_function() ) {
			wp_redirect( home_url() ); 
			exit;
		}
	}
	//add_action('admin_init', 'tt_disable_wp_admin_for_non_admins');

	// Login with Email or Username
	function tt_allow_email_login( $user, $username, $password ) {
		if ( is_email( $username ) ) {
			$user = get_user_by_email( $username );
			if ( $user ) {
				$username = $user->user_login;
			}
		}
		return wp_authenticate_username_password(null, $username, $password );
	}
	add_filter('authenticate', 'tt_allow_email_login', 20, 3);
	
	
	/* ========================
		Custom Styles
	======================== */
	function tt_custom_styles() {
		global $kake_theme_option;
		$style_type = 'type="text/css"';
		$color_accent = $kake_theme_option['color-accent'];
		$color_header_link = $kake_theme_option['color-header-link'];
		$color_header_link_hover = $kake_theme_option['color-header-link-hover'];
		$color_footer_link = $kake_theme_option['color-footer-link'];
		$color_footer_link_hover = $kake_theme_option['color-footer-link-hover'];
		$color_content_link = $kake_theme_option['color-content-link'];
		$color_content_link_hover = $kake_theme_option['color-content-link-hover'];
		$color_jumbotron = $kake_theme_option['color-jumbotron'];
		$color_jumbotron_link = $kake_theme_option['color-jumbotron-link'];
		$color_jumbotron_link_hover = $kake_theme_option['color-jumbotron-link-hover'];
		
		echo "\n<style $style_type>\n";
			echo "a:hover,a:active,a:visited,.navbar-nav a:hover,.large a:hover,#footer-container a:hover,#footer-sitemap a:hover{color:$color_accent;}\n";
			echo ".btn:hover,.btn-success:hover,.button:hover{background:$color_accent;}\n";
			echo "#header-container a,#header-container a:active,#header-container .navbar-brand,#header-container .social a{color:$color_header_link;}\n";
			echo "#header-container a:hover,#header-container a:visited{color:$color_header_link_hover;}\n";
			echo "#footer-container a{color:$color_footer_link;}\n";
			echo "#footer-container a:hover,#footer-container a:active,#footer-container a:visited{color:$color_footer_link_hover;}\n";
			echo "#content a{color:$color_content_link;}#content a:hover,#content a:active,#content a:visited{color:$color_content_link_hover;}\n";
			echo ".jumbotron .slider-title,.jumbotron p{color:$color_jumbotron;}.jumbotron .btn{color:$color_jumbotron_link_hover;}\n";
			echo "\n";
		// Theme Options: Custom Styles
		echo $kake_theme_option['custom-styles']."\n";
		echo "</style>\n";
	}
	add_action( 'wp_head', 'tt_custom_styles', 151 ); // Fire after Redux
