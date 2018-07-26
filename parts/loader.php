<?php
	global $kake_theme_option;
	$videourl = $kake_theme_option['loader-video'];
	$videoparts = pathinfo($videourl);
	$imageurl = $kake_theme_option['loader-image']['url'];
	$imageparts = pathinfo($imageurl);
	$mobileimgurl = $kake_theme_option['loader-mobile-image']['url'];
	$mobileparts = pathinfo($mobileimgurl);

	echo '<style type="text/css">';
		echo '#loader .overlay { background-image: none; }';
		echo '@media screen and (max-width:768px) {';
			echo '#loader .overlay { background-image: url('.$mobileparts['dirname'].'/'.$mobileparts['basename'].'); }';
		echo '}';
	echo '</style>';

	echo '<div id="loader">';
		echo '<div class="overlay">';
			echo '<img src="'.$imageparts['dirname'].'/'.$imageparts['basename'].'" class="logo img-responsive center-block" />';
		echo '</div>';
		echo '<div class="video">';
			echo '<video autoplay loop muted nocontrols class="cutaway">';
				echo '<source src="'.$videoparts['dirname'].'/'.$videoparts['filename'].'.mp4" type="video/mp4">';
				echo '<source src="'.$videoparts['dirname'].'/'.$videoparts['filename'].'.webm" type="video/webm" />';
				echo '<source src="'.$videoparts['dirname'].'/'.$videoparts['filename'].'.ogg" type="video/ogv" />';
			echo '</video>';
		echo '</div>';
	echo '</div>';