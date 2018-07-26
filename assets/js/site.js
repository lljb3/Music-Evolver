(function ($, window, document) {
	
	// Require.JS
	requirejs.config({
		paths: {
			'angular': '/wp-content/themes/music-master/assets/js/lib/angular.min',
			'plugins': '/wp-content/themes/music-master/assets/js/lib/plugins.min',
			'jplayer': '/wp-content/themes/music-master/assets/js/lib/music.min',
			'isotope': '/wp-content/themes/music-master/assets/js/lib/isotope.min',
		},
		shim: {
			'rellax': {
				deps: ['jquery'],
			}
		},
	});
	if (typeof jQuery === 'function') {
		define('jquery', function () { return jQuery; });
	}
	requirejs(['angular','plugins','isotope'], function() {
		
		// Global Vars
		var windowHeight = $(window).innerHeight();
		var menu = $('#header-container');
		var origOffsetY = menu.offset().top;
		
		// Sticky Header
		function scroll() {
			if ($(window).scrollTop() <= origOffsetY) {
				$("#header-container").removeClass('sticky');
				$('.jumbotron').removeClass('menu-padding');
			} else {
				$("#header-container").addClass('sticky');
				$('.jumbotron').addClass('menu-padding');
			}
		}
		document.onscroll = scroll;
		
		// Navbar Dropdown
		function is_touch_device() {
			return 'ontouchstart' in window // Works on most browsers 
			|| navigator.maxTouchPoints; // Works on IE10/11 and Surface
		};
		if(!is_touch_device() && $('.navbar-toggle:hidden')){
			$('.dropdown-menu', this).css('margin-top',0);
			$('.dropdown').hover(function(){ 
				$('.dropdown-toggle#dropdown-main', this).trigger('click');
				// Uncomment below to make the parent item clickable.
				$('.dropdown-toggle#dropdown-main', this).toggleClass("disabled"); 
			});			
		}
		if(is_touch_device()) {
			$('<a href="#" data-toggle="dropdown" id="dropdown-arrow" aria-haspopup="true" class="dropdown-toggle visible-xs"><i class="glyphicon glyphicon-chevron-down"></i></a>').insertAfter('.dropdown-toggle#dropdown-main');
			$('.dropdown-toggle#dropdown-main', this).toggleClass("disabled");
		}

		// Flowtype
		$('body').flowtype({
			minimum   : 300,
			maximum   : 3000,
			minFont   : 16,
			maxFont   : 48,
			fontRatio : 81
		});
			
		// Height to Viewport
		$(this).ready(function(e) {
			function setHeight() {
				windowHeight = $(window).innerHeight();
				$('.jumbotron').css('min-height', windowHeight);
				$('.jumbotron .slider').css('min-height', windowHeight);
			};
			setHeight();
			// Window Resize			
			$(window).resize(function() {
				setHeight();
			});
		});
			
		// To Top Button
		var offset = 220;
		var duration = 600;
		$(window).scroll(function() {
			if ($(this).scrollTop() > offset) {
				$('.totop').addClass('fadeIn').removeClass('fadeOut');
			} else {
				$('.totop').addClass('fadeOut').removeClass('fadeIn');
			}
		});
		
		// Isotope Call
		function musictope() {
			// Isotope
			function resizeBoxes() {
				var h = 0;
				$('div.view').each(function(){
					var b = $(this);
					if (h < b.height()) h = b.height();
				});     
				$('div.view').height(h);
			}   
			function initIsotope() {
				$('.isotope').isotope({
					// Options
					itemSelector: '.isotope-item',
					layoutMode: 'masonry',
				});
			}
			$(window).resize(function() {
				resizeBoxes();  
				initIsotope();
			});
			$(window).load(function() {
				resizeBoxes();
				initIsotope();
				$('#listing').animate({opacity: 1.0}, 200);
			});
			// Filter Items on Button Click
			jQuery('.button-group').on( 'click', 'button', function() {
				var filterValue = $(this).attr('data-filter');
				jQuery('.isotope').isotope({ filter: filterValue });
			});
		}
	
		// Handling Link Hash
		function windowhash() {
			var $hash = $(window.location.hash);
			if ($hash.length !== 0) {
				var offsetTop = $hash.offset().top;
				$('body, html').animate( {
						scrollTop: (offsetTop - 60),
					}, {
						duration: 280
				} );
			}
		}

		// Adding Backlist Classes
		function addBlacklistClass() {
			$('a').each(function() {
				if (window.location.href.indexOf('/wp-admin') !== -1 ||
				window.location.href.indexOf('/wp-login.php') !== -1 ||
				window.location.href.indexOf('/shop') !== -1) {
					$(this).addClass('nosmoothstate');
				}
			});
		}
		addBlacklistClass();

		// Adding Comments Section Hash
		function addBlacklistHash() {
			var $hash = $( window.location.hash );
			if ($hash.length !== 0) {
				var offsetTop = $hash.offset().top;
				$('body, html').animate({
						scrollTop: ( offsetTop - 60 ),
					},{
						duration: 280
				});
			}
		}

		if (window.location.href.indexOf('/shop') !== -1) {
			// Do Nothing
			$('#loader').delay(1750).fadeOut('slow');
			$('.navbar-brand').click(function(){
				window.close();
			});
			console.log('This is the shop page.');
			console.log('Logo click closes window.');
		} else {
			// Loading Bar
			var width = 100, // width of a progress bar in percentage
				perfData = window.performance.timing, // The PerformanceTiming interface
				EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart), // Calculated Estimated Time of Page Load which returns negative value.
				time = parseInt((EstimatedTime/1000)%60)*100; //Converting EstimatedTime from miliseconds to seconds.
			// Loadbar Animation
			$(".loadbar").animate({
				width: width + "%"
			}, time);
			// Percentage Increment Animation
			var PercentageID = $("#percent"),
				start = 0,
				end = 100,
				duration = time;
				animateValue(PercentageID, start, end, duration);
			// Animate Value Function
			function animateValue(id, start, end, duration) {
				var range = end - start,
					current = start,
					increment = end > start? 1 : -1,
					stepTime = Math.abs(Math.floor(duration / range)),
					obj = $(id);
				var timer = setInterval(function() {
					current += increment;
					$(obj).text(current + "%");
					//obj.innerHTML = current;
					if (current == end) {
						clearInterval(timer);
					}
				}, stepTime);
			}
			// Loading Page
			setTimeout(function(){
				$(this).scrollTop();
				$('#loader').delay(1750).fadeOut('slow');
				$('body').delay(1750).css({'overflow':'visible'});
			}, time);
		}

		// Loader Vars
		var loadin = function loadin() {
			$('body').addClass('loadin');
			$('#loader').fadeIn();	
		}
		var loading = function loading() {
			$(".loadbar").animate({
				width: width + "%"
			}, time);
			animateValue(PercentageID, start, end, duration);			
		}
		var loaded = function loaded() {
			$('body').delay(750).removeClass('loadin');
		}
		var loadout = function loadout() {
			setTimeout(function(){
				$(this).scrollTop();
				$('#loader').delay(750).fadeOut('slow');
				$('body').delay(750).css({'overflow':'visible'});
			}, time);
			$(".loading").css({ display: 'none' });
		}
		
		// Smooth State AJAX
		$('main').smoothState({
			blacklist: '.nosmoothstate, .fancybox',
			onBefore: function($anchor, $container) {
				loadout();
			},
			onStart: {
				duration: 350,
				render: function ($container) {
					loadin();
				}
			},
			onProgress: {
				duration: 350,
				render: function ($container) {
					loading();
				}
			},
			onReady: {
				duration: 350,
				render: function ($container, $newContent) {
					$container.html($newContent);
					loaded();
				}
			},
			onAfter: function($container, $newContent) {
				loadout();
				musictope();				
				windowhash();
				addBlacklistClass();
				addBlacklistHash();
			}
		});

		// Facebook API
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		// Twitter API
		!function(d,s,id){
			var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){
				js=d.createElement(s); js.id=id;
				js.src=p+"://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
			}
		}(document,"script","twitter-wjs");
		
		// Detect External Links
		var externallinkage = $('a').click(function() {
			var href = $(this).attr('href');
			if ((href.match(/^https?\:/i)) && (!href.match(document.domain))) {
				var extLink = href.replace(/^https?\:\/\//i, '');
			}
		});
		externallinkage.init();

		// AnivewJS Options
		var options = {
			animateThreshold: 100,
			scrollPollInterval: 20
		}
		$('.aniview').AniView(options);

		// FancyBox 2
		$('.fancybox').fancybox();

		if ($('main').hasClass('.intro')) {
			// Video Intro
			window.onload = function() {
				// Global Vars
				var video = document.getElementById('video');
				var playButton = document.getElementById('video-play');
				var muteButton = document.getElementById('video-mute');
				var fullScreenButton = $('#video-fscreen');
				// Button Functions
				playButton.addEventListener('click',function() {
					if (video.paused == true) {
						// Play the video
						video.play();
						// Update the button text to 'Pause'
						playButton.innerHTML = '<span class="glyphicon glyphicon-pause"></span>';
					} else {
						// Pause the video
						video.pause();
						// Update the button text to 'Play'
						playButton.innerHTML = '<span class="glyphicon glyphicon-play"></span>';
					}
				});
				muteButton.addEventListener('click',function() {
					if (video.muted == false) {
						// Mute the video
						video.muted = true;
						// Update the button text
						muteButton.innerHTML = '<span class="glyphicon glyphicon-volume-off"></span>';
					} else {
						// Unmute the video
						video.muted = false;
						// Update the button text
						muteButton.innerHTML = '<span class="glyphicon glyphicon-volume-up"></span>';
					}
				});
				fullScreenButton.click(function() {
					if (video.requestFullscreen) {
						video.requestFullscreen();
					} else if (video.mozRequestFullScreen) {
						video.mozRequestFullScreen(); // Firefox
					} else if (video.webkitRequestFullscreen) {
						video.webkitRequestFullscreen(); // Chrome and Safari
					}
				});
				// Replay Video
				$('#replay').click(function() {
					// Play the video
					video.play();
					// Hide Replay Button
					$(this).removeClass('fade-in');
				});
			}
			// When Video Ends
			$('video').on('ended',function(){
				console.log('Video has ended!');
				$(this).addClass('has-ended');
				$('#replay').addClass('fade-in');
			});
		}
		
	});
					
})(jQuery, window, document);