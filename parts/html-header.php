<?php
	global $kake_theme_option;
	if ( !empty( $kake_theme_option['favicon'] ) ) {
		$favicon = $kake_theme_option['favicon']['url'];
	}
	else {
		$favicon = '';
	}
?>

<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html class="no-js" lang="en" <?php language_attributes(); ?>><!--<![endif]-->
<head>

<!-- Site Information -->
<title><?php wp_title( '|' ); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="pI3JwgC5J8zHg4_a4Sn-JeSibsxcm1ZBnsdJPfihJvQ" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- Favicon Information -->
<?php if( $favicon ) { ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<?php } ?>

<!-- Header Information -->
<?php wp_head(); ?>
</head>

<!-- Start Site -->
<body class="<?php if ( is_admin() || is_user_logged_in() ) { echo 'logged-in customize-support'; } ?>">

<!-- Facebook Root -->
<div id="fb-root"></div>

<!-- Top of Page -->
<div class="hidden" id="totop"></div>

<!-- Loader -->
<?php if( is_page_template('template-intro.php') ) { ?>
    <!-- Loader Not On Intro -->
<?php } else { ?>
	<?php require_once( 'loader.php' ); ?>
<?php } ?>
