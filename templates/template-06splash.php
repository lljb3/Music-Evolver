<?php
	/**
     * Template Name: 06 - Splash
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

<!-- Content Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <div class="col-lg-12">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <h2 class="has-title text-center hidden"><?php the_title(); ?></h2>
                <div class="has-text"><?php the_content(); ?></div>
            <?php endwhile; ?>
        <!-- end .col-lg-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></div>

<!-- end main --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-footer' ) ); ?>