<?php
	/*
	Template Name: Template - Home
	*/
?>

<?php
	/**
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
    global $prodhmd_theme_option;
    $attachment_id = get_post_thumbnail_id(); 
    $bg_url = wp_get_attachment_image_src($attachment_id, 'full', false);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Jumbotron Information -->
<div class="jumbotron" id="home">
    <div class="slider-text container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php 
                    $slidertitle = get_post_meta($post->ID, "slidermeta-text", true); 
                    $sliderimage = get_post_meta($post->ID, "slidermeta-image", true); 
                    if( !empty( $slidertitle ) && empty( $sliderimage ) ) { 
                ?>
                    <h1 class="slider-title"><?php echo $slidertitle; ?></h1>
                <?php } elseif( empty( $slidertitle ) && !empty( $sliderimage ) ) { ?>
                    <h1 class="slider-title">
                        <img src="<?php echo $sliderimage; ?>" alt="" class="img-responsive center-block" />
                    <!-- end .slider-title --></h1>
                <?php } elseif( !empty( $slidertitle ) && !empty( $sliderimage ) ) { ?>
                    <h1 class="slider-title">
                        <img src="<?php echo $sliderimage; ?>" alt="" class="img-responsive center-block" />
                        <?php echo $slidertitle; ?>
                    <!-- end .slider-title --></h1>
                <?php } ?>
                <?php 
                    $slidertext = get_post_meta($post->ID, "slidermeta-textarea", true);
                    if( $slidertext ) { 
                ?>
                    <p><?php echo $slidertext; ?></p>
                <?php } ?>
                <?php 
                    $sliderbutton = get_post_meta($post->ID, "slidermeta-button", true); 
                    $sliderlink = get_post_meta($post->ID, "slidermeta-link", true); 
                    if( $sliderbutton ) {
                ?>
                    <a href="<?php echo $sliderlink; ?>" class="btn btn-lg button-success"><?php echo $sliderbutton; ?></a>
                <?php } ?>
                <div class="down-arrow">
                    <?php $scrdwnimg = $prodhmd_theme_option['scroll-down-icon-image']['url']; $scrdwnicon = $prodhmd_theme_option['scroll-down-icon-html']; $scrdwntxt = $prodhmd_theme_option['scroll-down-text']; $scrdwnline = $prodhmd_theme_option['scroll-down-line']; ?>
                    <?php if( !empty( $scrdwnimg ) && empty( $scrdwnicon ) ) { ?>
                        <a href="#content" data-scroll><img src="<?php echo $scrdwnimg ?>" alt="" /></a><br />
                    <?php } elseif( !empty( $scrdwnicon ) ) { ?>
                        <a href="#content" data-scroll><i class="<?php echo $scrdwnicon ?>"></i></a>
                    <?php } if( !empty( $scrdwntxt ) ) { ?>
                        <a href="#content" class="scroll-text" data-scroll><span><?php echo $scrdwntxt; ?></span></a><br />
                    <?php } if( ( $scrdwnline ) ) { ?>
                        <span class="line"></span>
                    <?php } ?>
                <!-- end .down-arrow --></div>
            <!-- end .col-md-10 --></div>
        <!-- end .row --></div>
    <!-- end .slider-text --></div>
    <?php $jumboimg = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
    <div class="slider">
        <?php $slidername = get_post_meta($post->ID, "slidermeta-name", true); ?>
        <?php if( !empty( $slidername ) ) { layerslider($slidername); } else { echo '<div class="jumbotron-img" style="background-image:url(' . $jumboimg . ');"></div>'; } ?>
    <!-- end .slider --></div>
    <div class="slider-wash"></div>
<!-- end .jumbotron --></div>

<!-- end .home --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>