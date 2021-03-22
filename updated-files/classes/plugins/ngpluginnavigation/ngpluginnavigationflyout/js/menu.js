(function($) {
	$.fn.ngFlyOutMenu = function() {
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
		});
		return this;

	};
})(jQuery);


$(document).ready(function() {
	$('ul.ngpluginnavigationflyout').ngFlyOutMenu();
});
