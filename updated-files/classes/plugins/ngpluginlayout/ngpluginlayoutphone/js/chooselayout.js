(function($) {
	$.fn.ngChooseLayout = function() {
		this.each(function() {
			var choosePanel = $('#choose');
			var chooseButtonDesktop = $('#choosedesktop');
			var chooseButtonQuiet = $('#choosequiet');

			if ($.cookie('nglayout')===undefined)
			{
				choosePanel.show();
				chooseButtonDesktop.click(showDesktop);
				chooseButtonQuiet.click(hidePanel);
			}
			
			function setLayoutCookie(layout)
			{
				$.cookie('nglayout', layout, { path: '/'} );
			}
			
			function showDesktop()
			{
				setLayoutCookie('desktop');
				window.location.reload();
			}
			
			function hidePanel()
			{
				choosePanel.slideUp();
				setLayoutCookie('mobile');
			}
		});
	};
})(jQuery);

$(document).ready(function() {
	$('#choose').ngChooseLayout();
});
