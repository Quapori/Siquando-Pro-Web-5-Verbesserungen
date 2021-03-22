(function($) {
	$.fn.ngSlideShow = function() {
		this.each(function() {
			var slideshow = $(this);
			var navigationStyle = slideshow.attr('data-ngnavigationstyle');
			var changeEffect = slideshow.attr('data-changeeffect');
			var autoChangeDelay = parseInt(slideshow.attr('data-ngautochangedelay'));
			var cropMain=parseFloat(slideshow.attr('data-cropmain'));
			var cropThumbs=parseFloat(slideshow.attr('data-cropthumbs'));
			var timer=null;
			var stage = slideshow.find('.ngslideshowstage');
			var container = slideshow.find('.ngslideshowcontainer');
			var captions = slideshow.find('.ngslideshowcaptions');
			var allIds = new Array();
			var navContainer;
			var heightThumbNails;
			var widthThumbNails;
			var widthPicture;
			var heightPicture;
			var widthAll;
			var heightAll;

			stage.find('a').each(function() {
				allIds.push($(this).attr('id'));

				var img=$(this).find('img');
				var src=img.attr('data-src');
				var srchd=img.attr('data-src-hd');

				if (window.devicePixelRatio > 1) {
					if (srchd!='undefined') img.attr('src',srchd);
				} else {
					if (src!='undefined') img.attr('src',src);
				}
			});

			placeElements();


			var currentId=allIds[0];

			switch (navigationStyle) {
			case 'Caption':
				navContainer = slideshow.find('.ngslideshowcaption a');
				attachNav();
				break;
			case 'Thumbnail':
				navContainer = slideshow.find('.ngslideshowthumbnail a');
				attachNav();
				break;
			case 'Bullet':
				navContainer = slideshow.find('.ngslideshowbullet a');
				attachNav();
				break;
			case 'PrevNext':
				attachPrevNext();
				break;
			}

			setCaption(currentId);

			if (autoChangeDelay!==0)
			{
				$(window).load(function() {
					timer=window.setInterval(moveNext, autoChangeDelay*1000);
					slideshow.mouseover(function() {
						if (timer!==null) {
							window.clearInterval(timer);
							timer=null;
						}
					});
					slideshow.mouseout(function() {
						if (timer===null) {
							timer=window.setInterval(moveNext, autoChangeDelay*1000);
						}
					});
				});
			}

			$(window).on('resize', function() {
				placeElements();
				placeElements();
			});

			function placeElements()
			{
				var i;

				widthAll=Math.floor(slideshow.width());

				switch (navigationStyle) {
				case 'Bullet' :
				case 'None' :
				case 'PrevNext' :
					heightThumbNails = 0;
					widthThumbNails = 0;
					widthPicture = widthAll - 2;
					heightPicture = Math.floor ( widthPicture / cropMain );
					break;
				case 'Caption' :
				case 'Thumbnail' :
					heightThumbNails = Math.floor ( (- allIds.length * cropMain + widthAll - 3) / (allIds.length * cropMain + cropThumbs) );
					widthThumbNails = Math.floor ( heightThumbNails * cropThumbs );
					heightPicture = Math.floor ( allIds.length * heightThumbNails + allIds.length - 1 );
					widthPicture = widthAll - widthThumbNails - 3;
					break;

				}

				heightAll = heightPicture+2;

				slideshow.css({
					'height': heightAll+'px'
				});

				stage.css({
					'width': widthPicture+'px',
					'height': heightPicture+'px'
				});

				stage.find('img').css({
					'width': widthPicture+'px',
					'height': heightPicture+'px'
				});

				stage.find('a').css({
					'width': widthPicture+'px',
					'height': heightPicture+'px'
				});
				stage.find('a em').css({
					'width': (widthPicture-20)+'px'
				});

				if (navigationStyle=='Thumbnail') {
					slideshow.find('.ngslideshowthumbnail').css({
						'width': (widthThumbNails+2)+'px',
						'height' : heightAll+'px'
					});
					slideshow.find('.ngslideshowthumbnail img').css({
						'width': widthThumbNails+'px',
						'height' : heightThumbNails+'px'
					});
					slideshow.find('.ngslideshowthumbnail a').css({
						'width': widthThumbNails+'px',
						'height' : heightThumbNails+'px'
					});
					var allThumbs = slideshow.find('.ngslideshowthumbnail a');
					for(i=0;i<allThumbs.length;i++)
					{
						allThumbs.eq(i).css({
							'top': (i*(heightThumbNails+1)+1)+'px'
						});
					}
				}
				if (navigationStyle=='Caption') {
					slideshow.find('.ngslideshowcaption').css({
						'width': (widthThumbNails+2)+'px',
						'height' : heightAll+'px'
					});
					slideshow.find('.ngslideshowcaption a').css({
						'width': widthThumbNails+'px',
						'height' : heightThumbNails+'px'
					});
					var allCaptions = slideshow.find('.ngslideshowcaption a');
					for(i=0;i<allCaptions.length;i++)
					{
						allCaptions.eq(i).css({
							'top': (i*(heightThumbNails+1)+1)+'px'
						});
					}
				}

				if (changeEffect=='Slide')
				{
					container.css({
						'width':(allIds.length*widthPicture)+'px',
						'height':(heightPicture)
					});
				} else {
					container.css({
						'width':(widthPicture)+'px',
						'height':(heightPicture)
					});
				}

			}

			// Attach click handlers to previous and next
			function attachPrevNext()
			{
				slideshow.find('.ngslideshownext').click(function() {moveNext();return false;});
				slideshow.find('.ngslideshowprev').click(function() {movePrev();return false;});
			}

			// Attach click handlers to nav elements
			function attachNav()
			{
				navContainer.click(function() {
					moveTo($(this).attr("href").substr(1));
					return false;
				});
			}

			// Find current index
			function currentIndex()
			{
				for(var i=0;i<allIds.length;i++)
				{
					if (allIds[i]==currentId) return i;
				}
				return -1;
			}

			// move to next
			function moveNext()
			{
				var pos = currentIndex();
				pos++;
				if (pos>=allIds.length) pos=0;
				moveTo(allIds[pos]);
			}

			// move to previous
			function movePrev(e)
			{
				var pos = currentIndex();
				pos--;
				if (pos<0) pos=allIds.length-1;
				moveTo(allIds[pos]);
			}

			// move to position
			function moveTo(id)
			{
				switch (changeEffect) {
				case 'Slide':
					slideTo(id);
					break;
				case 'Fade':
					fadeTo(id);
					break;
				case 'None':
					switchTo(id);
					break;
				}
				setCaption(id);
				setNav(id);
			}

			// set selected nav
			function setNav(id)
			{
				if (navContainer!==undefined) {
					navContainer.removeClass('ngslideshowselected');
					navContainer.filter('[href="#'+id+'"]').addClass('ngslideshowselected');
				}
			}

			// set the caption
			function setCaption(id)
			{
				if (captions.length==1)
				{
					var caption=container.find('a[id="'+id+'"]').attr('title');
					captions.html(caption);
					captions.css('display',(caption===''?'none':'block'));
				}
			}

			// Slide to id
			function slideTo(id)
			{
				var left=container.find('a[id="'+id+'"]').css('left').replace('px','');
				container.animate({'left':-left},{duration:300});
				currentId=id;
			}

			// fade to id
			function fadeTo(id)
			{
				container.find('a').css({'z-index':0,'display':'none'});
				container.find('a[id="'+currentId+'"]').css({'display':'block'});
				container.find('a[id="'+id+'"]').css({'z-index':1}).fadeIn(300);
				currentId=id;
			}

			// switch to id
			function switchTo(id)
			{
				container.find('a').css({'display':'none'});
				container.find('a[id="'+id+'"]').css({'display':'block'});
				currentId=id;
			}
		});

		return this;
	};
})(jQuery);

$(document).ready(function() {
	$('.ngslideshow').ngSlideShow();
});
