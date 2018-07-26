
<?php
	global $kake_theme_option;
	if ( !empty( $kake_theme_option['logo-menu'] ) ) {
		$logo = $kake_theme_option['logo-menu']['url'];
	}
	$facebook = $kake_theme_option['social-facebook'];
	$twitter = $kake_theme_option['social-twitter'];
	$google = $kake_theme_option['social-google'];
	$linkedin = $kake_theme_option['social-linkedin'];
	$pinterest = $kake_theme_option['social-pinterest'];
	$instagram = $kake_theme_option['social-instagram'];
	$youtube = $kake_theme_option['social-youtube'];
	$skype = $kake_theme_option['social-skype'];
	$tumblr = $kake_theme_option['social-tumblr'];
	
	$copyright = $kake_theme_option['copyright'];
?>

<!-- Header Information -->
<header id="header-container" class="row sticky">
    <div class="menu center-block">
        <?php if (is_page_template('template-frontpage.php')) { ?>
        	<!-- Hide Logo -->
        <?php } else { ?>
            <a href="<?php echo esc_url( home_url('/home') ); ?>" class="navbar-brand center-block">
                <?php if( empty( $logo ) ) { ?>
                    <span><?php bloginfo('name'); ?></span>
                <?php } else { ?>
                    <img src="<?php echo $logo; ?>" alt="" class="img-responsive center-block">
                <?php } ?>
            <!-- end .navbar-brand --></a>
        <?php } ?>
        <button type="button" class="navbar-toggle pull-right collapsed" data-toggle="collapse" data-target="#header-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        <!-- end .navbar-toggle --></button>
        <div class="panel-collapse collapse" id="header-collapse">
            <div class="header-table">
                <div class="container-fluid" id="header-menu">
                    <div class="row text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <a href="<?php echo esc_url( home_url('/home') ); ?>" class="navbar-brand center-block">
                                <?php if( empty( $logo ) ) { ?>
                                    <span><?php bloginfo('name'); ?></span>
                                <?php } else { ?>
                                    <img src="<?php echo $logo; ?>" alt="" class="img-responsive center-block">
                                <?php } ?>
                            <!-- end .navbar-brand --></a>
                            <?php if( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) { ?>
                                <?php wp_nav_menu( 
                                    array(
                                        'theme_location' => 'shop',
                                        'container'      => 'ul',
                                        'menu_class'     => 'navbar-nav nav',
                                        'echo'           => true,
                                        'link_before'    => '<span>',
                                        'link_after'     => '</span>',
                                        'items_wrap'     => '<ul class="navbar-nav nav">%3$s</ul>',
                                        'depth'          => 0,
                                        'walker'		 => new wp_bootstrap_navwalker()
                                    )
                                ); ?>
                            <?php } else { ?>
                                <?php wp_nav_menu( 
                                    array(
                                        'theme_location' => 'primary',
                                        'container'      => 'ul',
                                        'menu_class'     => 'navbar-nav nav',
                                        'echo'           => true,
                                        'link_before'    => '<span>',
                                        'link_after'     => '</span>',
                                        'items_wrap'     => '<ul class="navbar-nav nav">%3$s</ul>',
                                        'depth'          => 0,
                                        'walker'		 => new wp_bootstrap_navwalker()
                                    )
                                ); ?>
                            <?php } ?>
                        <!-- end .col-md-8 --></div>
                    <!-- end .text-center --></div>
                <!-- end .container-fluid --></div>
                <div class="container-fluid" id="header-info">
                    <div class="row text-center" id="site-social">
                        <div class="col-md-8 col-md-offset-2">
                            <?php if ( $facebook ) { ?><a href="<?php echo $facebook; ?>"><span class="socicon facebook">b</span></a><?php } ?>
                            <?php if ( $twitter ) { ?><a href="<?php echo $twitter; ?>"><span class="socicon twitter">a</span></a><?php } ?>
                            <?php if ( $google ) { ?><a href="<?php echo $google; ?>"><span class="socicon google">c</span></a><?php } ?>
                            <?php if ( $linkedin ) { ?><a href="<?php echo $linkedin; ?>"><span class="socicon linkedin">j</span></a><?php } ?>
                            <?php if ( $youtube ) { ?><a href="<?php echo $youtube; ?>"><span class="socicon youtube">r</span></a><?php } ?>
                            <?php if ( $pinterest ) { ?><a href="<?php echo $pinterest; ?>"><span class="socicon pinterest">d</span></a><?php } ?>
                            <?php if ( $instagram ) { ?><a href="<?php echo $instagram; ?>"><span class="socicon instagram">x</span></a><?php } ?>
                            <?php if ( $skype ) { ?><a href="<?php echo $skype; ?>"><span class="socicon skype">g</span></a><?php } ?>
                            <?php if ( $tumblr ) { ?><a href="<?php echo $tumblr; ?>"><span class="socicon tumblr">z</span></a><?php } ?>
                        <!-- end .col-md-6 --></div>
                    <!-- end #site-links --></div>
                <!-- end .container-fluid --></div>
                <div class="container-fluid" id="credits-info">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <p><?php echo $copyright; ?></p>
                            <p><a href="/terms-of-use/">Terms</a> | <a href="/privacy-policy/">Privacy</a> | Site by <a href="http://lljb3.com/" target="blank">His Master's Dance</a></p>
                        <!-- end .col-md-12 --></div>
                    <!-- end .row --></div>
                <!-- end .container-fluid --></div>
            <!-- end .header-table --></div>
        <!-- end .collapse --></div>
    <!-- end .menu --></div>                
<!-- end #header-container --></header>
