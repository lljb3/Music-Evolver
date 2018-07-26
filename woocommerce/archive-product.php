<?php
    /**
    * The Template for displaying product archives, including the main shop page which is a post type archive
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
    *
    * HOWEVER, on occasion WooCommerce will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @see 	    https://docs.woocommerce.com/document/template-structure/
    * @author 		WooThemes
    * @package 	WooCommerce/Templates
    * @version     2.0.0
    */
    global $prodhmd_theme_option;
    $slug_id = get_id_by_slug('shop');
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
            <div class="row">
                <div class="col-md-8" id="shop-main">
                    <?php
                        /**
                            * woocommerce_before_main_content hook.
                            *
                            * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                            * @hooked woocommerce_breadcrumb - 0
                            * @hooked WC_Structured_Data::generate_website_data() - 30
                            */
                        do_action( 'woocommerce_before_main_content' );
                    ?>
                    <header class="woocommerce-products-header">
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                        <?php
                            /**
                                * woocommerce_archive_description hook.
                                *
                                * @hooked woocommerce_taxonomy_archive_description - 10
                                * @hooked woocommerce_product_archive_description - 10
                                */
                            do_action( 'woocommerce_archive_description' );
                        ?>
                    </header>
                    <?php if ( have_posts() ) : ?>
                        <?php
                            /**
                                * woocommerce_before_shop_loop hook.
                                *
                                * @hooked woocommerce_result_count - 20
                                * @hooked woocommerce_catalog_ordering - 30
                                */
                            do_action( 'woocommerce_before_shop_loop' );
                        ?>
                        <?php woocommerce_product_loop_start(); ?>
                            <?php woocommerce_product_subcategories(); ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
                                    /**
                                        * woocommerce_shop_loop hook.
                                        *
                                        * @hooked WC_Structured_Data::generate_product_data() - 10
                                        */
                                    do_action( 'woocommerce_shop_loop' );
                                ?>
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            <?php endwhile; // end of the loop. ?>
                        <?php woocommerce_product_loop_end(); ?>
                        <?php
                            /**
                                * woocommerce_after_shop_loop hook.
                                *
                                * @hooked woocommerce_pagination - 10
                                */
                            do_action( 'woocommerce_after_shop_loop' );
                        ?>
                    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                        <?php
                            /**
                                * woocommerce_no_products_found hook.
                                *
                                * @hooked wc_no_products_found - 10
                                */
                            do_action( 'woocommerce_no_products_found' );
                        ?>
                    <?php endif; ?>
                    <?php
                        /**
                            * woocommerce_after_main_content hook.
                            *
                            * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                            */
                        do_action( 'woocommerce_after_main_content' );
                    ?>
                <!-- end .col-md-4 --></div>
                <div class="col-md-4" id="shop-sidebar">
                    <?php dynamic_sidebar('woo-sidebar'); ?>
                <!-- end .col-md-4 --></div>
            <!-- end .row --></div>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></section>

<!-- Background Information -->
<div class="<?php global $post; echo get_post($post)->post_name; ?>-container" id="content-bg">
    <img src="<?php echo $bg_url[0]; ?>" class="background img-responsive center-block" />
<!-- end #content-bg --></div>

<!-- end .home --></main>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>