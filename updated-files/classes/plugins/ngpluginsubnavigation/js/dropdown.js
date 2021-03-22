(function($) {
	$.fn.ngSubNavDrop = function() {
		$(this).change(function() {
			window.location.href=this.value;
		});
		return this;
	};
})(jQuery);


$(document).ready(function() {
	$('.ngsubnavdropdown select').ngSubNavDrop();
});
