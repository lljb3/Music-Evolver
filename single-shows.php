<?php
    /**
     * The Template for displaying all single show posts
     *
     * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
     *
     * @package 	WordPress
     * @subpackage 	Starkers
     * @since 		Starkers 4.0
     */
    global $prodhmd_theme_option;
    $slug_id = get_id_by_slug('shows');
    $slug_attachment_id = get_post_thumbnail_id($slug_id);
    $attachment_id = get_post_thumbnail_id();
    $bg_url = wp_get_attachment_image_src($slug_attachment_id, 'full', false);
    $img_url = wp_get_attachment_image_src($attachment_id, 'full', false);
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' ) ); ?>

<!-- Main Information -->
<main <?php body_class(); ?> id="main">

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/header' ) ); ?>

<!-- Content Information -->
<section class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="has-title event-title"><?php the_title(); ?></h1>
            <div class="has-text">
                <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
                    <?php 
                        $post_id = get_the_id();
                        $date_time = get_post_meta($post_id,'event_info_date-time',true);
                        
                        echo date('F j, Y, g:i a',strtotime($date_time)); echo '<br />';
                    ?>
                </time>
                <div class="event-content">
                    <?php
                        $post_id = get_the_id();
                        $tickets = get_post_meta($post_id,'event_info_ticket-url',true);
                        $location = get_post_meta($post_id,'event_info_city-state',true);
                        
                        echo $location; echo '<br />';
                        if ( !empty( $tickets ) ) {
                            echo '<a href="' . $tickets . '" target="_blank">Get Tickets</a>';
                        }
                    ?>
                    <div class="go-back"><a href="/shows">Go Back</a></div>
                <!-- end .event-content --></div>
            <!-- end .has-text --></div>
            <div class="event-thumbnail"><?php the_post_thumbnail( 'medium', array('class'=>"img-responsive attachment-post-thumbnail")); ?></div>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></section>

<!-- Background Information -->
<div class="<?php global $post; echo get_post($post)->post_name; ?>-container" id="content-bg">
    <img src="<?php echo $bg_url[0]; ?>" class="background img-responsive center-block" />
<!-- end #content-bg --></div>

<!-- end .home --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>