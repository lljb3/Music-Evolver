<?php
	/**
     * Template Name: 00 - Intro
     * 
	 * The template for displaying all pages.
	 *
	 * This is the template that displays all pages by default.
	 * Please note that this is the WordPress construct of pages
	 * and that other 'pages' on your WordPress site will use a
	 * different template.
	 *
	 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
	 *
	 * @package 	WordPress
	 * @subpackage 	Starkers
	 * @since 		Starkers 4.0
	 */
    global $evolver_theme_option; 
    $trans_opt = $evolver_theme_option['transitional-header-button'];
	$trans_page_opt = get_post_meta($post->ID,'page_options_trans-header',true);
	$collapse_opt = $evolver_theme_option['collapsable-header-button'];
    $slider_opt = get_post_meta($post->ID,'slidermeta-activate',true);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?>>

<!-- Video Information -->
<div class="container-fluid" id="video-container">
    <div class="row">
		<div class="col-md-12">
			<div class="video-intro">
				<video autoplay class="video" id="video">
					<?php $siteurl = get_stylesheet_directory_uri(); ?>
					<source src="<?php echo $videoparts['dirname'].'/'.$videoparts['filename'].'.mp4'; ?>" type="video/mp4" />
					<source src="<?php echo $videoparts['dirname'].'/'.$videoparts['filename'].'.webm'; ?>" type="video/webm" />
					<source src="<?php echo $videoparts['dirname'].'/'.$videoparts['filename'].'.ogg'; ?>" type="video/ogv" />					
				<!-- end .video --></video>
				<div id="replay" class="center-block">
					<span>Replay Video</span>
				<!-- end #replay --></div>
			<!-- end .video-intro --></div>
			<div class="video-text">
				<div class="continue pull-left">
					<span class="continue-text"><span class="hidden-xs"><?php echo $introtext; ?> | </span>
					<a href="/home">Continue to <?php echo bloginfo(); ?></a></span>
				<!-- end .continue --></div>
				<div class="controls">
					<ul class="list-unstyled">
						<li><button id="video-play"><span class="glyphicon glyphicon-pause"></span></button></li>
						<li><button id="video-mute"><span class="glyphicon glyphicon-volume-up"></span></button></li>
						<li><button id="video-fscreen"><span class="glyphicon glyphicon-fullscreen"></span></button></li>
					<!-- end .list-unstyled --></ul>
				<!-- end .controls --></div>
			<!-- end .video-text --></div>
        <!-- end .col-md-12 --></div>
    <!-- end .body-class --></div>
<!-- end #video-container --></div>

<!-- end main --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-footer' ) ); ?>