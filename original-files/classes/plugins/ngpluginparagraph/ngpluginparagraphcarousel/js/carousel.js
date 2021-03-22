(function($) {
	$.fn.ngCarousel = function() {
		this.each(function() {
			var angle = 0;
			var sourceangle = 0;
			var destangle = 0;
			var offset = 0;
			var speed = 0;
			var controller = null;
			var current = 0;
			var rolling = false;
			var zoom = false;

			var	scalex = 0.65;
			var scaley = 0.4;
			var	hoverzoom = 1.3;
			var	autospin = parseInt($(this).attr('data-delay'));
			var stage=$(this);

			var elements=$(this).find('img');
			var links=$(this).find('a');
			var reflection=$(this).attr('data-reflection')=='on';

			links.data('nolightbox',true).click(handleclick);

			links.data('nolightbox',true).eq(0).data('nolightbox',false);

			var i=0;

			elements.each(function(){
				$(this).data('width',parseInt($(this).css('width').replace('px','')));
				$(this).data('height',parseInt($(this).css('height').replace('px','')));
				$(this).data('index',i++);

				if (reflection) {
					var reflectioncanvas = document.createElement('canvas');
					reflectioncanvas.style.position = 'absolute';
					reflectioncanvas.width = $(this).data('width');
					reflectioncanvas.height = 30;
					$(this).after(reflectioncanvas);
				}
			});

			placeimages();
			go();

			$(this).mouseleave(go);
			elements.hover(handlemouseover, handlemouseout);

			if (reflection) {
				$(window).load(function() {
					elements.each(drawreflection);
				});
			}

			$(window).on('resize', placeimages);

			function drawreflection(){
				try {
					var cntx = $(this).next('canvas')[0].getContext("2d");
					cntx.save();
					cntx.translate(0, $(this).data('height') - 1);
					cntx.scale(1, -1);
					cntx.drawImage($(this)[0], 0, 0, $(this).data('width'), $(this).data('height'));
					cntx.restore();
					cntx.globalCompositeOperation = "destination-out";

					var gradient = cntx.createLinearGradient(0, 0, 0, 30);
					gradient.addColorStop(0, "rgba(255, 255, 255, 0.6)");
					gradient.addColorStop(1, "rgba(255, 255, 255, 1.0)");

					cntx.fillStyle = gradient;
					cntx.fillRect(0, 0, $(this).data('width'), 30);
				}
				catch (ex)
				{
				}
			}


			function placeimages () {
				var segmentangel = 360 / elements.length;
				var stagecenterx = $(stage).width() / 2;
				var stagecentery = ($(stage).height() / 2) - 30;
				var radiusx = stagecenterx * scalex;
				var radiusy = stagecentery * scaley;

				var factor = $(stage).width()/1000;

				for (var i = 0; i < elements.length; i++) {
					var arc = (angle + i * segmentangel) / 180 * Math.PI;

					var x = stagecenterx + radiusx * Math.sin(arc);
					var y = stagecentery + radiusy * Math.cos(arc);

					var scale = 0.60 + (1 + Math.cos(arc)) / 2 * 0.40;
					var zindex = (1 + Math.cos(arc)) * 499;

					var h = $(elements[i]).data('height') * scale * factor;
					var w = $(elements[i]).data('width') * scale * factor;

					var cssleft = Math.round(x - w / 2) + 'px';
					var csstop = Math.round(y - h / 2) + 'px';
					var cssheight = Math.round(h) + 'px';
					var csswidth = Math.round(w) + 'px';
					var csszindex = Math.round(zindex);

					$(elements[i]).css({
						left: cssleft,
						top: csstop,
						height: cssheight,
						width: csswidth,
						zIndex: csszindex
					});

					csstop = Math.round(y - h / 2) + Math.round(h)- 1 + 'px';

					$(elements[i]).next('canvas').css({
						left: cssleft,
						top: csstop,
						width: csswidth,
						zIndex: csszindex - 1
					});


					csstop = Math.round(y - h / 2) + Math.round(h)- 1 + 'px';
				}
			}

			function anglediff(anglea, angleb){
				var difference = angleb - anglea;
				while (difference < -180)
					difference += 360;
				while (difference > 180)
					difference -= 360;
				return difference;
			}

			function rotate() {
				var destoffset = anglediff(sourceangle, destangle);

				offset += 0.1;

				if (offset >= 2) {
					angle = destangle;
				} else {
					angle = Math.round(sourceangle + ((offset <= 1) ? Math.pow(offset, 2) : (2 - Math.pow((2 - offset), 2))) * destoffset / 2);
				}

				placeimages();

				if (offset <= 2) {
					setTimeout(rotate, 30);
				} else {
					rolling = false;
				}
			}

			function handlemouseover() {
				stop();
				if (!rolling) {
					if (current == $(this).data('index')) {
						zoom = true;
						resizeelement($(this).data('index'), hoverzoom);
						$(this).next('canvas').fadeOut(200);
					}
				}
			}

			function handlemouseout(){
				stop();
				if (!rolling) {
					if (current == $(this).data('index')) {
						if (zoom) {
							resizeelement($(this).data('index'), 1);
							$(this).next('canvas').fadeIn(200);
							zoom = false;
						}
					}
				}
			}

			function handleclick() {
				stop();

				if (current == $(this).children('img').data('index')) {
					return true;
				}
				else {
					rotateto($(this).children('img').data('index'));
					return false;
				}
			}

			function resizeelement(index, factor) {
				segmentangel = 360 / elements.length;

				stagecenterx = $(stage).width() / 2;
				stagecentery = ($(stage).height() / 2) - 30;
				radiusx = stagecenterx * scalex;
				radiusy = stagecentery * scaley;

				var scale = $(stage).width()/1000;

				var arc = (angle + index * segmentangel) / 180 * Math.PI;

				var x = stagecenterx + radiusx * Math.sin(arc);
				var y = stagecentery + radiusy * Math.cos(arc);

				var h = $(elements[index]).data('height') * factor * scale;
				var w = $(elements[index]).data('width') * factor * scale;

				var cssleft = Math.round(x - w / 2) + 'px';
				var csstop = Math.round(y - h / 2) + 'px';
				var cssheight = Math.round(h) + 'px';
				var csswidth = Math.round(w) + 'px';

				$(elements[index]).stop().animate({
					left: cssleft,
					top: csstop,
					height: cssheight,
					width: csswidth
				}, 200);
			}

			function rotateto(index){
				if (!rolling) {
					if (current != index) {
						rolling = true;
						current = index;
						destangle = 360 - index / elements.length * 360;
						sourceangle = angle;
						speed = 0;
						offset = 0;
						rotate();
						links.data('nolightbox',true).eq(current).data('nolightbox',false);
					}
				}
			}

			function stop() {
				if (controller!==null) {
					clearInterval(controller);
					controller = null;
				}
			}

			function next()
			{
				var nextindex=current+1;
				if (nextindex > elements.length-1) nextindex=0;
				rotateto(nextindex);
			}

			function go() {
				if (autospin !== 0) {
					if (controller===null) {
						controller = setInterval(next, autospin*1000);
					}
				}
			}
		});

	};
})(jQuery);

$(document).ready(function() {
	$('div.ngcarousel').ngCarousel();
});
