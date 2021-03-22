(function($) {
	$.fn.ngSharePopup = function() {
		
		function openInPopup(e)
		{
			e.preventDefault();
			window.open($(this).attr('href'), '_blank', 'width=600,height=500');
		}
		
		$(this).on('click', openInPopup);
	};
})(jQuery);

$(document).ready(function() {
	$('.ngparashare>a').ngSharePopup();
});
