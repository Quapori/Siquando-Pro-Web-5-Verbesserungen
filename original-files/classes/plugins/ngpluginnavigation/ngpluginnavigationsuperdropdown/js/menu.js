(function($) {
	$.fn.ngSuperDropDownMenu = function() {
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
				$(this).find('li').hover(function() {
					if ($(this).hasClass('ar')) {
						$(this).children('div').css({'left':-405}).animate({
							left:-400
						}, {
							duration: 50
						});						
					} else {
						$(this).children('div').css({'left':5}).animate({
							left:0
						}, {
							duration: 50
						});
					}

				}, function() {
					$(this).children('div').css({'left':-9999});					
				});
			}				
		});
		return this;

	};
})(jQuery);


$(document).ready(function() {
	$('ul.ngpluginnavigationsuperdropdown').ngSuperDropDownMenu();
});
