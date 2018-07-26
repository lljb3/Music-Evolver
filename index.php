<?php
    /**
     * The main template file
     * This is the most generic template file in a WordPress theme
     * and one of the two required files for a theme (the other being style.css).
     * It is used to display a page when nothing more specific matches a query.
     * E.g., it puts together the home page when no home.php file 
     *
     * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
     *
     * @package 	WordPress
     * @subpackage 	Starkers
     * @since 		Starkers 4.0
     */
    global $prodhmd_theme_option;
    $slug_id = get_id_by_slug('news');
    $slug_attachment_id = get_post_thumbnail_id($slug_id);
    $attachment_id = get_post_thumbnail_id();
    $bg_url = wp_get_attachment_image_src($slug_attachment_id, 'full', false);
    $img_url = wp_get_attachment_image_src($attachment_id, 'full', false);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Container Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <h1 class="has-title text-center">Latest Posts</h1>	
        <div class="col-md-6 col-md-offset-1" id="posts-section">
			<?php if ( have_posts() ): ?>
                <ol class="row list-unstyled">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li class="col-md-12">
                            <article class="post row">
                                <div class="thumbnail col-md-3 col-xs-3"><?php the_post_thumbnail('large',['class'=>'img-responsive center-block']); ?></div>
                                <div class="post-inner col-md-9 col-xs-9">
                                    <h2 class="post-title"><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
                                    <?php the_content('Continue Reading'); ?>
                                </div>
                            <!-- end .post --></article>
                        <!-- end .col-md-12 --></li>
                    <?php endwhile; ?>
                <!-- end .row --></ol>
            <?php else: ?>
                <h4 class="has-title">No posts to display</h4>
            <?php endif; ?>
            <div class="row" id="pagination">
            	<div class="col-md-12">
                	<?php starkers_numeric_posts_nav(); ?>
                <!-- end .col-md-12 --></div>
            <!-- end #pagination --></div>
        <!-- end .col-md-6 --></div>
        <div class="col-md-4" id="posts-sidebar">
        	<?php dynamic_sidebar('posts-sidebar'); ?>
        <!-- end .col-md-4 --></div>
    <!-- end .row --></div>
<!-- end #content --></div>

<!-- Background Information -->
<div class="<?php global $post; echo get_post($post)->post_name; ?>-container" id="content-bg">
    <img src="<?php echo $bg_url[0]; ?>" class="background img-responsive center-block" />
<!-- end #content-bg --></div>

<!-- end .blog --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>