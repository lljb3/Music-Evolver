<?php
	global $evolver_theme_option;
    $tracklist = $evolver_theme_option['title_field'];
    $title = $evolver_theme_option['title_field'];
    $artist = $evolver_theme_option['artist_field'];
    $mp3 = $evolver_theme_option['mp3_field'];
?>

<div class="col-md-12 jplayer" id="jplayer-container">
    <div class="jplayer-inner jp-jplayer" id="jPlayer"></div>
    <div id="jPlayerContainer" class="jp-audio" role="application" aria-label="media player">
        <div class="jp-type-playlist">
            <div class="jp-gui jp-interface">
                <div class="jp-controls-holder">
                    <ul class="list-inline pull-right text-right jp-controls" id="playerControls">
                        <li class="glyphicon glyphicon-play jp-play" id="jplayer_play"></li>
                        <li class="glyphicon glyphicon-pause jp-pause" id="jplayer_pause"></li>
                        <li class="glyphicon glyphicon-fast-backward jp-previous" id="jplayer_prev"></li>
                        <li class="glyphicon glyphicon-fast-forward jp-next" id="jplayer_next"></li>
                    <!-- end #playerControls --></ul>
                <!-- end .jp-controls-holder --></div>
                <div class="jp-details">
                    <div class="jp-current-time pull-right" id="timecode"></div>
                    <div class="pull-right text-right jp-title" aria-label="title" id="playerSongInfo">Song Name</div>
                <!-- end .jp-details --></div>
            <!-- end .jp-gui --></div>
        <!-- end .jp-type-playlist --></div>
    <!-- end #jPlayerContainer --></div>
<!-- end #jplayer-container --></div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // jPlayer Vars
        myPlaylist = new jPlayerPlaylist({
            jPlayer: "#jPlayer",
            cssSelectorAncestor: "#jPlayerContainer"
        }, [
            <?php
                $i = 0; $j = 0; $k = 0;
                foreach( $tracklist as $songlink ) {
                    echo '{title:"'.$title[$i++].'",';
                    echo 'artist:"'.$artist[$j++].'",';
                    echo 'mp3:"'.$mp3[$k++]['url'].'",},';
                }
            ?>
        ], {
            playlistOptions: {
                enableRemoveControls: false,
                loopOnPrevious: true,
                shuffleOnLoop: true,
            },
            loop: true,
            swfPath: "/js",
            supplied: "oga, mp3",
            wmode: "window",
            useStateClassSkin: false,
            autoBlur: true,
            smoothPlayBar: true,
            keyEnabled: false,
            autoPlay: true,
        });
        // Control Functions
        $("#jplayer_pause").click(function() {
            myPlaylist.pause();
        });
        myPlaylist.play(0);
    });
</script>