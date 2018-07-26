<?php
    /*
    Template Name: Template - No Jumbotron Page
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

<!-- Content Information -->
<section class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <h2 class="has-title text-center hidden"><?php the_title(); ?></h2>
                <div class="has-text"><?php the_content(); ?></div>
            <?php endwhile; ?>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></section>

<!-- Background Information -->
<div class="<?php global $post; echo get_post($post)->post_name; ?>-container" id="content-bg">
    <img src="<?php echo $bg_url[0]; ?>" class="background img-responsive center-block" />
<!-- end #content-bg --></div>

<!-- end .home --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>