<?php
	/*
	Plugin Name: The Videos Plugin
	Plugin URI: http://kakemultimedia.com/
	Description: Declares a plugin that will create a custom post type displaying videos.
	Version: 2.0.0
	Author: James Burrell
	Author URI: http://web.prodhmd.com/
	License: GPLv2
	*/
	
	/* Shows Installer */
	require_once('inc/videos-cpt.php');

	/* Shows Metabox Info */
	require_once('inc/videos-metabox.php');

	/* Shows Template Loader */
	require_once('inc/videos-template-loader.php');