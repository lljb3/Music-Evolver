<?php
	global $evolver_theme_option;
	if ( !empty( $evolver_theme_option['logo-menu'] ) ) {
		$logo = $evolver_theme_option['logo-menu']['url'];
    }
    if ( !empty( $evolver_theme_option['trans-header-logo'] ) ) {
		$trans_logo = $evolver_theme_option['trans-header-logo']['url'];
	}
    $chat = $evolver_theme_option['site-header-chat'];
    $phone = $evolver_theme_option['site-header-phone'];
?>

<!-- Header Information -->
<header id="header-container" data-scroll-header>
    <div class="container-fluid large" id="trans-menu">
    	<div class="row">
            <div class="col-lg-10 offset-lg-1" id="header-menu-table">
                <!-- Large Menu -->
                <div class="menu mx-auto d-md-none d-lg-block" id="header-menu-table-row">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="navbar-brand float-left" id="header-menu-table-cell">
                        <?php if( empty( $logo ) ) { ?>
                            <span><?php bloginfo('name'); ?></span>
                        <?php } else { ?>
                            <img src="<?php echo $trans_logo; ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid trans-logo active" id="header-menu-table-cell">
                            <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid regular-logo hidden" id="header-menu-table-cell">
                        <?php } ?>
                    <!-- end .navbar-brand --></a>
                    <div class="navbar-collapse collapse float-right" id="header-menu-table-cell">
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
								'walker'          => new WP_Bootstrap_Navwalker()
                            )
                        ); ?>
                        <ul class="navbar-light nav">
                            <?php if( !empty( $chat ) ) { 
                                echo '<script type="text/javascript">' . $chat . '</script>';
                                echo '<li class="menu-chat menu-item"><i class="fa fa-comments-o" aria-hidden="true"></i></li>'; 
                            } ?>
                            <?php if( !empty( $phone ) ) { 
                                echo '<li class="menu-phone menu-item"><a title="Call" href="tel:' . $phone . '"><i class="fa fa-mobile" aria-hidden="true" ></i></a></li>'; 
                            } ?>
                        <!-- end .navbar-light --></ul>
                    <!-- end .collapse --></div>
                <!-- end .menu --></div>
                <!-- Small Menu -->
                <div class="menu mx-auto d-none d-md-block d-lg-none">
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="navbar-brand float-left">
                        <?php if( empty( $logo ) ) { ?>
                            <span><?php bloginfo('name'); ?></span>
                        <?php } else { ?>
                            <img src="<?php echo $trans_logo; ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid trans-logo active">
                            <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid regular-logo hidden">
                        <?php } ?>
                    <!-- end .navbar-brand --></a>
                    <button type="button" class="navbar-toggler float-right collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar top-bar float-left"></span>
                        <span class="icon-bar middle-bar float-left"></span>
                        <span class="icon-bar bottom-bar float-left"></span>
                    <!-- .navbar-toggler --></button>
                    <div class="navbar-collapse collapse text-center" id="navbar-collapse">
                        <?php wp_nav_menu( 
                            array(
                                'theme_location'  => 'primary',
                                'container'       => 'div',
                                'container_id'    => 'bs-example-navbar-collapse-1',
                                'menu_class'      => 'navbar-nav nav mr-auto',
                                'echo'            => true,
                                'link_before'     => '<span>',
                                'link_after'      => '</span>',
                                'items_wrap'      => '<ul class="navbar-nav nav mr-auto">%3$s</ul>',
                                'depth'           => 2,
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
								'walker'          => new WP_Bootstrap_Navwalker()
                            )
                        ); ?>
                        <ul class="navbar-nav nav mr-auto">
                            <?php if( !empty( $chat ) ) { 
                                echo '<script type="text/javascript">' . $chat . '</script>';
                                echo '<li class="menu-chat menu-item"><i class="fa fa-comments-o" aria-hidden="true"></i></li>'; 
                            } ?>
                            <?php if( !empty( $phone ) ) { 
                                echo '<li class="menu-phone menu-item"><a title="Call" href="tel:' . $phone . '"><i class="fa fa-mobile" aria-hidden="true" ></i></a></li>'; 
                            } ?>
                        <!-- end .navbar-light --></ul>
                    <!-- end .collapse --></div>
                <!-- end .visible-xs --></div>
        	<!-- end .col-lg-12 --></div>
        <!-- end .row --></div>
    <!-- end .container-fluid --></div>
<!-- end #header-container --></header>