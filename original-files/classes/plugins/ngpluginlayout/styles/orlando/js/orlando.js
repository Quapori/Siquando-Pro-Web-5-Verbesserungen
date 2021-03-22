(function($) {
	$.fn.sizeEyecatcher = function() {
		var eyecatchercontainer = $(this);
		var eyecatcher = $(this).children('img').eq(0);

		var width = parseInt(eyecatcher.css('width').replace('px',''));
		var height = parseInt(eyecatcher.css('height').replace('px',''));
		var ratio = width / height;

		var nav=$('#nav');
		var navfixed=$('#navfixed');
		var navheight = nav.height();

		function resize()
		{
			var availwidth = $(window).width();
			var availheight = $(window).height()-navheight;

			var newwidth = availwidth;
			var newheight = Math.floor( newwidth / ratio);

			if (newheight<availheight) {
				newheight=availheight;
				newwidth=Math.floor( newheight * ratio);
			}

			var newleft = newwidth-availwidth;


			eyecatcher.css({
				'width': newwidth,
				'height': newheight,
				'left': -newleft
			});

			eyecatchercontainer.css({
				'height': availheight
			});

			setTop();
		}

		function setTop()
		{
			var scrolltop=$(window).scrollTop();
			var availheight = parseInt(eyecatchercontainer.css('height').replace('px',''));
			var newheight = parseInt(eyecatcher.css('height').replace('px',''));
			var newtop = newheight-availheight;

			eyecatcher.css({
				'top': -newtop+Math.floor(scrolltop/2)
			});

			var navigationOffset=nav.offset().top;

			if(scrolltop > navigationOffset) {
				navfixed.show();
			} else {
				navfixed.hide();
			}
		}

		$(window).bind('resize', resize);
		$(window).bind('scroll',setTop);
		resize();

		return this;
	};
})(jQuery);

$(document).ready(function() {
	$('#eyecatcher').sizeEyecatcher();

	$(window).load(function() {
		$('#eyecatcher>img').css('opacity',1);
		$('#eyecatcher>h1').addClass('loaded');
		$('#eyecatcher>div').addClass('loaded');

		$('#eyecatcher>div').click(function() {
			var offset=$('#nav').offset().top;
			$('html, body').animate({scrollTop: offset}, 1000);
		});

	});
});

