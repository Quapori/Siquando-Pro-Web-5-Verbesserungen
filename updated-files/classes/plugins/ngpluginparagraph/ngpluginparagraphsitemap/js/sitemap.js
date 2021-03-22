(function($) {
	$.fn.ngSitemap = function() {
		this.each(function() {

			var animate=$(this).attr('data-animate')=='on';

			$(this).find('li:has(ul)')
			.click( function(event) {		    	
				if (this == event.target) {
					$(this).toggleClass('expanded');
					if (animate) {
						$(this).children('ul').toggle(250);
					} else {
						$(this).children('ul').toggle();
					}
					return false;
				}
			})
			.addClass('collapsed')
			.children('ul').hide();
			return this;
		});
	};
})(jQuery);

$(document).ready(function() {
	$('ul.ngsitemapdynamic').ngSitemap();
});
