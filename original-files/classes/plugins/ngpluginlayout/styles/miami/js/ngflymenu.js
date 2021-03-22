(function($) {
	$.fn.ngFlyMenu = function() {
		$(this).find('li').mouseenter(function() {
			$(this).find('ul>li>a').css({'paddingTop':0, 'paddingBottom':0}).animate({'paddingTop':10,'paddingBottom':10}, 150);
			$(this).children('ul').hide().fadeIn(150);
		});
		return this;
	};
})(jQuery);


$(document).ready(function() {
	$('ul#menu').ngFlyMenu();
});