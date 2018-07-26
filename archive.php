<?php
    /**
     * The template for displaying Archive pages.
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
    $attachment_id = get_post_thumbnail_id(); 
    $bg_url = wp_get_attachment_image_src($attachment_id, 'full', false);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Container Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <h2 class="has-title text-center">The Archives</h2>	
        <div class="col-md-6 col-md-offset-1" id="posts-section">
			<?php if ( have_posts() ): ?>
            
            <?php if ( is_day() ) : ?>
            <h2>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h2>							
            <?php elseif ( is_month() ) : ?>
            <h2>Archive: <?php echo  get_the_date( 'M Y' ); ?></h2>	
            <?php elseif ( is_year() ) : ?>
            <h2>Archive: <?php echo  get_the_date( 'Y' ); ?></h2>								
            <?php else : ?>
            <h2>Archive</h2>	
            <?php endif; ?>
            
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
            <!-- end .list-unstyled --></ol>
            <?php else: ?>
            <h2>No posts to display</h2>	
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

<!-- end .archive --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>