'use strict';

(function($) {
	$.fn.ngFullscreenSlides = function() {
		this.each(function() {

			var container = $(this).find('.ngfullscreenslidesstage');
			var items=container.find('.ngfullscreenslidesnavbutton');
			var picture=container.children('img').first();
			var pictureWidth=1;
			var pictureHeight=1;
			var buttonFullscreen=container.find('.ngfullscreenslidesfullscreen');
			var buttonStart=$(this).find('.ngfullscreenslidesstart');
			var buttonNext=container.find('.ngfullscreenslidesnext');
			var buttonPrev=container.find('.ngfullscreenslidesprev');
			var buttonAudio=container.find('.ngfullscreenslidesaudio');
			var buttonPlay=container.find('.ngfullscreenslidesplay');
			var buttonClose=container.find('.ngfullscreenslidesclose');
			var hideNavigation=parseInt($(this).attr('data-hidenavigation'));
			var showCaptions=$(this).attr('data-captions')=='true';
			var headline=container.find('h1');
			var currentSource='';
			var autoplay=parseInt($(this).attr('data-autoplay'));
			var timeout=null;
			var hidetimeout=null;
			var mp3=$(this).find('audio')[0];
			var playing=true;
			var trans=picture.attr('src');
			var lastX=-1;
			var lastY=-1;
			var autoHideControls=container.find('.ngfullscreenslideshide');
			var isOver=false;
			var poster=$(this).find('.ngfullscreenslidesposter');
			var fullscreen=$(this).attr('data-fullscreen')==='true';

			$(this).find('.ngfullscreenslidesstage').detach().appendTo('body');
			
			if (!fullscreenIsSupported()) buttonFullscreen.css('display','none');


			function loadPicture(source, caption)
			{
				if (currentSource!=source) {
					currentSource=source;

					stopAutoplay();

					var image=new Image();

					$(image).load(function() {
						picture.hide();
						headline.hide();
						picture.attr('src',image.src);
						headline.html(caption);
						pictureWidth= image.width;
						pictureHeight= image.height;
						resize();
						picture.fadeIn(300);
						headline.fadeIn(1000);
					});

					items.each(function(){
						if ($(this).attr('data-href') == source)
						{
							$(this).addClass('ngfullscreenslidesnavbuttonactive');
						} else 
						{
							$(this).removeClass('ngfullscreenslidesnavbuttonactive');						
						}
					});

					image.src=source;

					if (autoplay>0) startAutoplay();
				}
			}

			function itemClicked(e) {
				var sender = $(this);
				loadPicture(sender.attr('data-href'), sender.attr('data-caption'));	
			}

			function startAutoplay()
			{
				timeout=setTimeout(nextPicture, autoplay*1000);
			}

			function stopAutoplay()
			{
				if (timeout!==null)
				{
					clearTimeout(timeout);
					timeout=null;
				}
			}

			function resize()
			{
				var pictureRatio = pictureWidth/pictureHeight;
				var containerWidth = container[0].scrollWidth;
				var containerHeight = container[0].scrollHeight;

				var width;
				var height;
				var top;
				var left;

				width=containerWidth;
				height=parseInt(width/pictureRatio);

				if (height<containerHeight)
				{
					height=containerHeight;
					width=height*pictureRatio;
				}

				left=parseInt((containerWidth-width)/2);
				top=parseInt((containerHeight-height)/2);

				if (left<-pictureWidth/6 || top<-pictureHeight/6)
				{
					if (height>containerHeight)
					{
						height=containerHeight;
						width=parseInt( height*pictureRatio);
					}
				}

				left=parseInt((containerWidth-width)/2);
				top=parseInt((containerHeight-height)/2);


				picture.css( {'width':width+'px', 'height':height+'px', 'left':left+'px', 'top':top+'px'});
			}

			function handleKeyboard(e)
			{
				if (e.keyCode==27) stop();
				if (e.keyCode==39) nextPicture();
				if (e.keyCode==37) prevPicture();
			}

			function start()
			{
				$('body').css('overflow','hidden');
				if (fullscreen) enterFullScreen();
				container.addClass('ngfullscreenslidesstagerunning');
				loadPicture(items.first().attr('data-href'),items.first().attr('data-caption'));
				startAudio();
				showControls();
				$(window).on('keydown', handleKeyboard);
				$(window).on('resize', resize);

			}

			function stop()
			{
				$(window).off('keydown', handleKeyboard);
				$(window).off('resize', resize);
				stopAudio();
				stopAutoplay();
				container.removeClass('ngfullscreenslidesstagerunning');
				picture.attr({'src':trans});
				currentSource='';
				hideControls();
				isOver=false;
				exitFullScreen();
				$('body').css('overflow','auto');
			}

			function startAudio()
			{
				try {
					if (typeof(mp3)!=='undefined' && typeof (mp3.play)=='function') mp3.play();
				}
				catch (e)
				{}
				buttonAudio.removeClass('ngfullscreenslidesmute');
			}

			function stopAudio()
			{
				try {
					if (typeof(mp3)!=='undefined' && typeof (mp3.pause)=='function') mp3.pause();
					if (typeof(mp3)!=='undefined' && typeof (mp3.currentTime)=='number') mp3.currentTime=0;
				}
				catch (e)
				{}

				buttonAudio.addClass('ngfullscreenslidesmute');
			}


			function toggleFullscreen() {
				if (!document.fullscreenElement && !document.mozFullScreenElement && !document.msFullscreenElement && !document.webkitFullscreenElement )  {
					enterFullScreen();
				} else {
					exitFullScreen();
				}
			}

			function enterFullScreen() {
				if (container[0].requestFullscreen) {
					container[0].requestFullscreen();
				} else if (container[0].mozRequestFullScreen) {
					container[0].mozRequestFullScreen();
				} else if (container[0].webkitRequestFullscreen) {
					container[0].webkitRequestFullscreen();
				} else if (container[0].msRequestFullscreen) {
					container[0].msRequestFullscreen();
				}
			}
			
			function fullscreenIsSupported() {
				if (typeof container[0].requestFullscreen !== 'undefined') return true;
				if (typeof container[0].mozRequestFullScreen !== 'undefined') return true;
				if (typeof container[0].webkitRequestFullscreen !== 'undefined') return true;
				if (typeof container[0].msRequestFullscreen !== 'undefined') return true;
				return false;
			}
			
			function exitFullScreen()
			{
				if (document.exitFullscreen) {
					document.exitFullscreen();
				} else if (document.msExitFullscreen) {
					document.msExitFullscreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitExitFullscreen) {
					document.webkitExitFullscreen();
				}
			}

			function currentIndex(source)
			{
				for(var i=0;i<items.length;i++)
				{
					if (items.eq(i).attr('data-href')==source) return i;
				}

				return 0;
			}

			function nextPicture()
			{
				var index=currentIndex(currentSource);
				index++;
				if (index>=items.length) index=0;
				loadPicture(items.eq(index).attr('data-href'),items.eq(index).attr('data-caption'));
			}

			function prevPicture()
			{
				var index=currentIndex(currentSource);
				index--;
				if (index<0) index=items.length-1;
				loadPicture(items.eq(index).attr('data-href'),items.eq(index).attr('data-caption'));				
			}

			function toggleAudio()
			{
				playing=!playing;
				if (playing)
				{
					startAudio();
				} else
				{
					stopAudio();
				}
			}

			function toggleAutoplay()
			{
				if (buttonPlay.hasClass('ngfullscreenslidespause'))
				{	
					startAutoplay();
					buttonPlay.removeClass('ngfullscreenslidespause');
				} else 
				{
					stopAutoplay();
					buttonPlay.addClass('ngfullscreenslidespause');
				}
			}

			function revealControls(e)
			{
				if (lastX==-1)
				{
					lastX=e.screenX;
					lastY=e.screenY;
				} else 
				{
					if ((Math.abs(e.screenX-lastX)>30 || Math.abs(e.screenY-lastY>30)) && !isOver) {
						showControls();
					}
				}
			}

			function showControls()
			{
				if (hideNavigation>0) {
					stopHideControlsTimeout();
					hidetimeout=setTimeout(hideControls,hideNavigation*1000);
				}
				autoHideControls.removeClass('ngfullscreenslideshide');
			}

			function stopHideControlsTimeout()
			{
				if (hideNavigation>0) {
					if (hidetimeout!==null) {
						clearTimeout(hidetimeout)
						hidetimeout=null;
					}
				}
			}

			function hideControls()
			{
				if (hideNavigation>0) {
					autoHideControls.addClass('ngfullscreenslideshide');

					lastX=-1;
					lastY=-1;

					hidetimeout=null;		
				}
			}

			buttonFullscreen.click(toggleFullscreen);
			buttonStart.click(start);
			poster.click(start);
			buttonNext.click(nextPicture);
			buttonPrev.click(prevPicture);
			buttonAudio.click(toggleAudio);
			buttonPlay.click(toggleAutoplay);
			buttonClose.click(stop);
			container.mousemove(revealControls);
			items.click(itemClicked);

			if (hideNavigation>0) {

				autoHideControls.mouseenter(function() {
					isOver=true;
					stopHideControlsTimeout();
				});
				autoHideControls.mouseleave(function() {
					isOver=false;
					showControls();
				});

			}

			picture.click(showControls);

			return this;
		});
	};
})(jQuery);

$(document).ready(function() {
	$('.ngfullscreenslides').ngFullscreenSlides();
});
