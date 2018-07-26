
<?php 
	global $kake_theme_option;
	$totop = $kake_theme_option['footer-show-up-button'];
	
	$facebook = $kake_theme_option['social-facebook'];
	$twitter = $kake_theme_option['social-twitter'];
	$google = $kake_theme_option['social-google'];
	$linkedin = $kake_theme_option['social-linkedin'];
	$pinterest = $kake_theme_option['social-pinterest'];
	$instagram = $kake_theme_option['social-instagram'];
	$youtube = $kake_theme_option['social-youtube'];
	$skype = $kake_theme_option['social-skype'];
	$tumblr = $kake_theme_option['social-tumblr'];
?>
	
<!-- Back to Top -->
<?php if ($totop) { ?>
<a data-scroll href="#totop" class="totop noFadeOut"><span class="glyphicon glyphicon-chevron-up"></span></a>
<?php } ?>

<!-- Footer Information -->	
<footer id="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-4 text-left" id="footer-social">
				<?php if ( $facebook ) { ?><a href="<?php echo $facebook; ?>" target="_blank"><span class="socicon facebook">b</span></a><?php } ?>
				<?php if ( $twitter ) { ?><a href="<?php echo $twitter; ?>" target="_blank"><span class="socicon twitter">a</span></a><?php } ?>
                <?php if ( $google ) { ?><a href="<?php echo $google; ?>" target="_blank"><span class="socicon google">c</span></a><?php } ?>
                <?php if ( $linkedin ) { ?><a href="<?php echo $linkedin; ?>" target="_blank"><span class="socicon linkedin">j</span></a><?php } ?>
                <?php if ( $youtube ) { ?><a href="<?php echo $youtube; ?>" target="_blank"><span class="socicon youtube">r</span></a><?php } ?>
                <?php if ( $pinterest ) { ?><a href="<?php echo $pinterest; ?>" target="_blank"><span class="socicon pinterest">d</span></a><?php } ?>
                <?php if ( $instagram ) { ?><a href="<?php echo $instagram; ?>" target="_blank"><span class="socicon instagram">x</span></a><?php } ?>
                <?php if ( $skype ) { ?><a href="<?php echo $skype; ?>" target="_blank"><span class="socicon skype">g</span></a><?php } ?>
				<?php if ( $tumblr ) { ?><a href="<?php echo $tumblr; ?>" target="_blank"><span class="socicon tumblr">z</span></a><?php } ?>
            <!-- end #footer-player --></div>
            <?php if ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) : ?>
            	<!-- No player fired -->
            <?php else : ?>            
                <?php require_once('player.php'); ?>
            <?php endif; ?>
        <!-- end .row --></div>
    <!-- end .hidden-xs --></div>
<!-- end #footer-container --></footer>
