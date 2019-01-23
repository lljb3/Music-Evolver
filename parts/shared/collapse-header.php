<?php
	global $evolver_theme_option;
	if ( !empty( $evolver_theme_option['logo-menu'] ) ) {
		$logo = $evolver_theme_option['logo-menu']['url'];
	}
    $chat = $evolver_theme_option['site-header-chat'];
    $chat_click = $evolver_theme_option['site-header-chat-click'];
    $phone = $evolver_theme_option['site-header-phone'];
    $copyright = $evolver_theme_option['copyright'];
    $dev_name = $evolver_theme_option['developer-text'];
	$dev_link = $evolver_theme_option['developer-link'];
	$facebook = $evolver_theme_option['social-facebook'];
	$twitter = $evolver_theme_option['social-twitter'];
    $google = $evolver_theme_option['social-google'];
	$youtube = $evolver_theme_option['social-youtube'];
    $instagram = $evolver_theme_option['social-instagram'];
	$soundcloud = $evolver_theme_option['social-soundcloud'];
    $bandcamp = $evolver_theme_option['social-bandcamp'];
	$apple = $evolver_theme_option['social-apple'];
?>

<!-- Header Information -->
<header id="header-container" class="container-fluid" data-scroll-header>
    <div class="menu mx-auto d-block row" id="collapse-menu">
        <a href="<?php echo esc_url( home_url('/home') ); ?>" class="navbar-brand">
            <?php if( empty( $logo ) ) { ?>
                <span><?php bloginfo('name'); ?></span>
            <?php } else { ?>
                <img src="<?php echo $logo; ?>" alt="" class="img-responsive mx-auto d-block">
            <?php } ?>
        <!-- end .navbar-brand --></a>
        <button type="button" class="navbar-toggler float-right collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar top-bar float-left"></span>
            <span class="icon-bar middle-bar float-left"></span>
            <span class="icon-bar bottom-bar float-left"></span>
        <!-- .navbar-toggler --></button>
        <div class="panel-collapse collapse" id="navbar-collapse">
            <div class="header-table">
                <div class="header-table-cell">
                    <div class="container-fluid" id="header-menu">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <?php if( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) { ?>
                                    <?php wp_nav_menu( 
                                        array(
                                            'theme_location'  => 'shop',
                                            'container'       => 'div',
                                            'container_id'    => 'bs-example-navbar-collapse-1',
                                            'menu_class'      => 'navbar-light nav',
                                            'echo'            => true,
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>',
                                            'items_wrap'      => '<ul class="navbar-light nav">%3$s</ul>',
                                            'depth'           => 2,
                                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'		  => new WP_Bootstrap_Navwalker()
                                        )
                                    ); ?>
                                <?php } else { ?>
                                    <?php wp_nav_menu( 
                                        array(
                                            'theme_location'  => 'primary',
                                            'container'       => 'div',
                                            'container_id'    => 'bs-example-navbar-collapse-1',
                                            'menu_class'      => 'navbar-light nav',
                                            'echo'            => true,
                                            'link_before'     => '<span>',
                                            'link_after'      => '</span>',
                                            'items_wrap'      => '<ul class="navbar-light nav">%3$s</ul>',
                                            'depth'           => 2,
                                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'		  => new WP_Bootstrap_Navwalker()
                                        )
                                    ); ?>
                                <?php } ?>
                            <!-- end .col-md-8 --></div>
                        <!-- end .text-center --></div>
                    <!-- end .container-fluid --></div>
                    <div class="container-fluid" id="header-info">
                        <div class="row" id="site-social">
                            <div class="col-lg-10 offset-lg-1">
                                <?php if ( $facebook ) { ?><a href="<?php echo $facebook; ?>"><i aria-hidden="true" class="fab fa-facebook-f facebook"></i></a><?php } ?>
                                <?php if ( $twitter ) { ?><a href="<?php echo $twitter; ?>"><i aria-hidden="true" class="fab fa-twitter twitter"></i></a><?php } ?>
                                <?php if ( $google ) { ?><a href="<?php echo $google; ?>"><i aria-hidden="true" class="fab fa-google-plus-g google"></i></a><?php } ?>
                                <?php if ( $linkedin ) { ?><a href="<?php echo $linkedin; ?>"><i aria-hidden="true" class="fab fa-linkedin-in linkedin"></i></a><?php } ?>
                                <?php if ( $youtube ) { ?><a href="<?php echo $youtube; ?>"><i aria-hidden="true" class="fab fa-youtube youtube"></i></a><?php } ?>
                                <?php if ( $pinterest ) { ?><a href="<?php echo $pinterest; ?>"><i aria-hidden="true" class="fab fa-pinterest-p pinterest"></i></a><?php } ?>
                                <?php if ( $instagram ) { ?><a href="<?php echo $instagram; ?>"><i aria-hidden="true" class="fab fa-instagram instagram"></i></a><?php } ?>
                                <?php if ( $skype ) { ?><a href="<?php echo $skype; ?>"><i aria-hidden="true" class="fab fa-skype skype"></i></a><?php } ?>
                                <?php if ( $yelp ) { ?><a href="<?php echo $yelp; ?>"><i aria-hidden="true" class="fab fa-yelp yelp"></i></a><?php } ?>
                            <!-- end .col-md-6 --></div>
                        <!-- end #site-links --></div>
                    <!-- end .container-fluid --></div>
                    <div class="container-fluid" id="credits-info">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <p><?php echo $copyright; ?> | <a href="/terms-of-use/"><strong>Terms</strong></a> | <a href="/privacy-policy/"><strong>Privacy</strong></a> | Developed by <a href="<?php echo $dev_link; ?>" target="blank"><strong><?php echo $dev_name; ?></strong></a></p>
                            <!-- end .col-md-12 --></div>
                        <!-- end .row --></div>
                    <!-- end .container-fluid --></div>
                <!-- end .header-table-cell --></div>
            <!-- end .header-table --></div>
        <!-- end .collapse --></div>
    <!-- end .menu --></div>                
<!-- end #header-container --></header>