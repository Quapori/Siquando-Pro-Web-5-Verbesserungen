(function($) {
	$.fn.ngDropDownMenu = function() {
		this.each(function() {
			var sound=$(this).attr('data-sound');
			if (sound)
			{
				$(this).children('li').each(function() {
					var soundtag=$("<audio preload='auto'><source src='"+sound+".ogg' type='audio/ogg' /><source src='"+sound+".mp3' type='audio/mpeg' /></audio>");
					$('body').append(soundtag);

					$(this).mouseenter(function() {
						try {
							if (!!(soundtag[0].canPlayType)) {
								soundtag[0].pause();
								soundtag[0].currentTime = 0;
								soundtag[0].play();
							}
						}
						catch (err)
						{

						}
					});
				});
			}
			if ($(this).attr('data-animate')!=undefined)
			{
				var top = ($(this).find('a').last().css('paddingTop'));
				var bottom = ($(this).find('a').last().css('paddingBottom'));

				$(this).find('li').mouseenter(function() {
					$(this).children('ul').children('li').children('a').css({'paddingTop':0,'paddingBottom':0}).animate({
						paddingTop:top, paddingBottom:bottom
					}, {
						duration: 100
					});

				});
			}				
		});
		return this;

	};
})(jQuery);


$(document).ready(function() {
	$('ul.ngpluginnavigationdropdown').ngDropDownMenu();
});
