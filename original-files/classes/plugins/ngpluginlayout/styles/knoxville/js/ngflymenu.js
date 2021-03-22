(function($) {
	$.fn.ngFlyMenu = function() {
		$(this).find('li').mouseenter(function() {
			$(this).children('ul').hide().fadeIn(150);
		});
		return this;
	};
})(jQuery);


$(document).ready(function() {
	$('ul.ngflymenu').ngFlyMenu();
});
