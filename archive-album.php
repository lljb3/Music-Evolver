<?php
    /**
     * The template for displaying Archive album pages.
     *
     * Used to display archive-type pages if nothing more specific matches a query.
     * For example, puts together date-based pages if no date.php file exists.
     *
     * Learn more: http://codex.wordpress.org/Template_Hierarchy
     *
     * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts() 
     *
     * @package 	WordPress
     * @subpackage 	Starkers
     * @since 		Starkers 4.0
     */
    global $prodhmd_theme_option;
    $slug_id = get_id_by_slug('music');
    $slug_attachment_id = get_post_thumbnail_id($slug_id);
    $attachment_id = get_post_thumbnail_id();
    $bg_url = wp_get_attachment_image_src($slug_attachment_id, 'full', false);
    $img_url = wp_get_attachment_image_src($attachment_id, 'full', false);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Section Information -->
<section class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php if ( have_posts() ): ?>
                <div class="row" id="album-title">
                    <div class="col-md-12">
                        <h1 class="has-title archive-title pull-left">Music</h1>
                        <div id="album-types" class="button-group">
                            <?php $music_terms = get_terms( 'albumtype' ); ?>
                            <button class="btn btn-link" data-filter="*">All</button>
                            <?php
                                if ( ! empty( $music_terms ) && ! is_wp_error( $music_terms ) ){
                                    foreach ( $music_terms as $term ) {
                                        echo '<button class="btn btn-link" data-filter=".' . $term->slug . '">' . $term->name .'</button>';
                                    }
                                }
                            ?>
                        <!-- end .button-group --></div>
                    <!-- col-md-12 --></div>
                <!-- end #album-title --></div>
                <ol class="row isotope" id="album-list">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php $terms = get_the_terms($post->ID ,'albumtype'); ?>
                        <li class="isotope-item transition <?php foreach ( $terms as $term ) { echo $term->slug; } ?> col-md-3 col-xs-6" id="album-post" data-category="transition">
                            <article class="album-item">
                                <h4 class="has-title hidden">
                                    <a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    <span class="has-title"><?php foreach ( $terms as $term ) { echo $term->name; } ?></span>
                                <!-- end .has-text --></h4>
                                <div class="album-thumbnail" style="float:left;">
                                    <a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail( 'medium', array('class'=>"img-responsive attachment-post-thumbnail center-block")); ?></a>
                                <!-- end .thumbnail --></div>
                            <!-- end .post --></article>
                        <!-- end #album-post --></li>
                    <?php endwhile; ?>
                <!-- end .row --></ol>
            <?php else: ?>
                <h4 class="has-title">No posts to display</h4>
            <?php endif; ?>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></section>

<!-- Background Information -->
<div class="<?php global $post; echo get_post($post)->post_name; ?>-container" id="content-bg">
    <img src="<?php echo $bg_url[0]; ?>" class="background img-responsive center-block" />
<!-- end #content-bg --></div>

<!-- end .home --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>