(function($) {
	$.fn.ngRollDown = function() {
		$(this).each(function() {
			var target=$(this).attr('data-ngtarget');

			$(this).click(function() {
				var offset=$('#'+target).offset().top;
				$('html, body').animate({scrollTop: offset}, 1000);
			});

		});
		return this;
	};
})(jQuery);

(function($) {
	$.fn.ngParallax = function() {
		var stage = $(this).eq(0);
		var eyecatcher = $(this).children('img').eq(0);
		var eyecatcherWidth = parseInt(eyecatcher.css('width').replace('px',''));
		var eyecatcherHeight = parseInt(eyecatcher.css('height').replace('px',''));
		var stageHeight = parseInt(stage.css('height').replace('px',''));
		var stageBottom = stage.offset().top+stageHeight;
		
		var eyecatcherRatio = eyecatcherWidth / eyecatcherHeight;

		function positionEyecatcher() {
			var newWidth = $(document).width();
			var newHeight = Math.floor( newWidth / eyecatcherRatio);

			if (newHeight<stageHeight+120)
			{
				newHeight=stageHeight+120;
				newWidth = Math.floor(newHeight*eyecatcherRatio);
			}

			var newLeft= Math.floor( ($(document).width()-newWidth)/2);
			
			var scrollTop = $(window).scrollTop() / stageBottom;
			
			if (scrollTop>1) scrollTop=1;
			
			scrollTop=-120+Math.floor( scrollTop*120);
									
			eyecatcher.css({
				'top':scrollTop+'px',
				'left':newLeft+'px',
				'width':newWidth+'px',
				'height':newHeight+'px'
			});
		};
		
		function setTop()
		{
			var scrollTop = $(window).scrollTop() / stageBottom;			
			if (scrollTop>1) scrollTop=1;
			scrollTop=-120+Math.floor( scrollTop*120);
			
			eyecatcher.css({
				'top':scrollTop+'px'
			});
		}

		positionEyecatcher();

		$(window).bind('resize', positionEyecatcher);
		$(window).bind('scroll',setTop);
		$(document).bind('mousewheel',setTop);


		return this;
	};
})(jQuery);


$(document).ready(function() {
	$('.ngrolldown').ngRollDown();
	$('#eyecatcher').ngParallax();
});