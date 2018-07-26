<?php
    /**
     * The Template for displaying all single posts
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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Container Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-1" id="posts-section">
            <article class="post">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
                <div class="has-post-thumbnail"><?php the_post_thumbnail('large',['class'=>'img-responsive center-block']); ?></div>
                <div class="has-text">
                    <?php the_content(); ?>			
                
                    <?php if ( get_the_author_meta( 'description' ) ) : ?>
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
                    <h3 class="post-title">About <?php echo get_the_author() ; ?></h3>
                    <?php the_author_meta( 'description' ); ?>
                    <?php endif; ?>
                
                    <?php comments_template( '', true ); ?>
                <!-- end .has-text --></div>
            <!-- end .post --></article>
        <!-- end .col-md-6 --></div>
        <div class="col-md-4" id="posts-sidebar">
        	<?php dynamic_sidebar('posts-sidebar'); ?>
        <!-- end .col-md-4 --></div>
    <!-- end .row --></div>
<!-- end #content --></div>

<?php endwhile; endif; ?>

<!-- end .single --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>