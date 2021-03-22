(function($) {
	$.fn.ngToggleNav = function() {
		this.each(function() {
			var nav=$(this).children('ul').eq(1);
			var showNav = $('#shownav');
			var hideNav = $('#hidenav');
			
			nav.hide();
			
			showNav.children('a').click(function () {
				showNav.hide();
				hideNav.show();
				nav.slideDown(250);
				return false;
			});

			hideNav.children('a').click(function () {
				nav.slideUp(250, function() {
					showNav.show();
					hideNav.hide();
				});
				return false;
			});
			
		});
	};
})(jQuery);

$(document).ready(function() {
	$('#nav').ngToggleNav();
});
