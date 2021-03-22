(function($) {
	$.fn.nglazyload = function() {

		var $w = $(window), hd = window.devicePixelRatio > 1, attrib = hd ? "data-src-hd" : "data-src", images = this, loaded;

		this.one("lazyload", function() {
			var source = this.getAttribute(attrib);
			source = source || this.getAttribute("data-src");
			if (source) {
				$(this).attr({'src':source});

				$(this).load(function() {
					this.style.opacity = 1;
				});

			}
		});

		function lazyload() {
			var inview = images.filter(function() {
				var $e = $(this);
				if ($e.is(":hidden")) return;

				var wt = $w.scrollTop(),
				wb = wt + $w.height(),
				et = $e.offset().top,
				eb = et + $e.height();

				return eb >= wt && et <= wb;
			});

			loaded = inview.trigger("lazyload");
			images = images.not(loaded);
		}

		$w.on("scroll.lazyload resize.lazyload lookup.lazyload", lazyload);

		lazyload();

		return this;

	};

})(jQuery);

$(document).ready(function() {
	$('img.nglazyload').nglazyload();
})