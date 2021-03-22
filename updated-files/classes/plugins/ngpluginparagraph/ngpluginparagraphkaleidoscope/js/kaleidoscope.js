"use strict";

(function($) {
	$.fn.ngKaleidoscope = function() {
		$(this).each(function() {
			var wrapper = $(this);
			var stage = $(this).find('ul');
			var containers = stage.find('li');
			var images = stage.find('img');
			var center;
			var offset = Math.floor(containers.length / 2);
			var bullets, nav;
			var reflectionHeight;
			var delay = $(this).attr('data-delay');
			var showreflection = $(this).attr('data-reflection') == 'on';
						
			var shownav = $(this).attr('data-nav') == 'on';
			var timer = null;
			var links = stage.find('a');
			var header = $(this).find('h3');
			var canvasCreated=false;

			function stop() {
				if (timer !== null) {
					clearInterval(timer);
					timer = null;
				}
			}

			function start() {
				if (timer === null) {
					timer = setInterval(next, delay * 1000);
				}

			}

			function next() {
				offset++;
				if (offset >= containers.length) offset = 0;
				setTransition();
				placeImages();
			}

			function positionElements() {
				
				center = Math.floor(stage.width() / 2);

				stage.css('height', Math.floor( stage.width()/3)+'px');
				reflectionHeight = Math.floor(stage.height() / 5);

				images.each(function() {

					var originalWidth =parseInt($(this).attr('width'));
					var originalHeight = parseInt($(this).attr('height')); 

					var height = stage.height()*0.8;
					var width = height*originalWidth/originalHeight;

					$(this).css({
						'height': height+'px',
						'width': width+'px'
					});

					$(this).parents('li').css('height', ($(this).height() + reflectionHeight) + 'px');
					$(this).parents('li').css('width', $(this).width() + 'px');
					if (showreflection) {
						if (!canvasCreated) {
							var reflectioncanvas = document.createElement('canvas');
							reflectioncanvas.width = width;
							reflectioncanvas.height = reflectionHeight;
							$(this).after(reflectioncanvas);
						}
					}
				});

				if (showreflection) {
					if (!canvasCreated) {
						$(window).load(function() {
							images.each(drawreflection);
						});
						canvasCreated=true;
					}
				}
				
				$(nav).css({
					'left': (stage.width() - containers.length * 20) / 2 + 'px'
				});

			}

			function createNav() {
				nav = document.createElement('div');

				var navwidth = containers.length * 20;

				if (navwidth<stage.width()) {

					$(nav).css({
						'width': navwidth  + 'px',
					});

					wrapper.append(nav);

					for (var i = 0; i < containers.length; i++) {
						var bullet = document.createElement('div');
						bullet.style.left = i * 20 + 'px';
						$(nav).append(bullet);
					}

					bullets = $(nav).children('div');
					bullets.on('click', handleNavClick);
				}
			}

			function drawreflection() {
				try {
					var cntx = $(this).next('canvas')[0].getContext("2d");
					cntx.save();
					cntx.translate(0, $(this).height() - 1);
					cntx.scale(1, -1);
					cntx.drawImage($(this)[0], 0, 0, $(this).width(), $(this).height());
					cntx.restore();
					cntx.globalCompositeOperation = "destination-out";
					var gradient = cntx.createLinearGradient(0, 0, 0, reflectionHeight);
					gradient.addColorStop(0, "rgba(255, 255, 255, 0.75)");
					gradient.addColorStop(1, "rgba(255, 255, 255, 1.0)");
					cntx.fillStyle = gradient;
					cntx.fillRect(0, 0, $(this).width(), reflectionHeight);
				} catch (ex) {}
			}

			function placeImages() {



				for (var i = 0; i < containers.length; i++) {
					var opacity = 1;
					var shift = i - offset;
					if (shift <= -3) {
						shift = -3;
						opacity = 0;
					}
					if (shift >= 3) {
						shift = 3;
						opacity = 0;
					}

					var pos = Math.floor(center + shift * center / 3);
					var zoom = 1 - Math.abs(shift / 8);

					containers.eq(i).css('transform', 'translateX(' + (pos - Math.floor(containers.eq(i).width() / 2)) + 'px) scaleX(' + zoom + ') scaleY(' + zoom + ')');
					containers.eq(i).css('-webkit-transform', 'translateX(' + (pos - Math.floor(containers.eq(i).width() / 2)) + 'px) scaleX(' + zoom + ') scaleY(' + zoom + ')');
					containers.eq(i).css('-ms-transform', 'translateX(' + (pos - Math.floor(containers.eq(i).width() / 2)) + 'px) scaleX(' + zoom + ') scaleY(' + zoom + ')');
					containers.eq(i).css('z-index', 100 - Math.abs(i - offset));
					containers.eq(i).css('opacity', opacity);
				}

				links.data('nolightbox', true).eq(offset).data('nolightbox', false);

				var title = links.eq(offset).attr('title');

				header.html(title == '' ? '&nbsp;' : title);

				if (bullets !== undefined) {
					bullets.removeClass('ngparakaleidoscopeselected').eq(offset).addClass('ngparakaleidoscopeselected');
				}
			}

			function handleLinkClick(e) {
				setTransition();

				var index = $(this).parent('li').index();
				if (offset != index) e.preventDefault();
				offset = index;
				placeImages();
			}

			function handleNavClick(e) {
				setTransition();

				offset = $(this).index();
				placeImages();
			}

			function setTransition() {
				containers.css('transition',
				'transform 0.4s, opacity 0.4s');
				containers.css('-webkit-transition',
				'-webkit-transform 0.4s, opacity 0.4s');
			}

			links.data('nolightbox', true);
			
			links.on('click', handleLinkClick);

			if (shownav)
				createNav();


			positionElements();


			placeImages();

			if (delay > 0) {
				$(this).on('mouseover', stop);
				$(this).on('mouseout', start);
				start();
			}

			$(window).on('resize', function() {
				positionElements();
				placeImages();
			})

		});
	};
})(jQuery);

$(document).ready(function() {
	$('.ngparakaleidoscope').ngKaleidoscope();
});