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
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Container Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <h2 class="has-title text-center"><?php the_title(); ?></h2>
            <div class="has-text"><?php the_content(); ?></div>
            <div class="hidden"><?php comments_template( '', true ); ?></div>
            <?php endwhile; ?>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></div>

<!-- end .page --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>