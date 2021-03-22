(function($) {
	$.fn.ngFadeMenu = function() {

		$(this).each(function() {

			var fadeColor = $(this).attr('data-fadecolor');

			$(this).find('a').each(function() {
				$(this).data('fadenormal', $(this).css('backgroundColor'));
			});

			$(this).find('a').hover(function() {
				$(this).stop().animate({'backgroundColor':fadeColor}, 200);
			}, function () {
				$(this).stop().animate({'backgroundColor':$(this).data('fadenormal')}, 200);
			});
		});

		return this;

	};
})(jQuery);


$(document).ready(function() {
	$('ul.ngfademenu').ngFadeMenu();
});
