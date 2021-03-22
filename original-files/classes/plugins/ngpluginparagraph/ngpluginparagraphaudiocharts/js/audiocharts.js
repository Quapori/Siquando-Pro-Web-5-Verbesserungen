'use strict';

(function($) {
	$.fn.ngAudioCharts = function() {
		this.each(function() {

			var audio = $(this).find('audio');
			var tracks = $(this).find('a');
			var current = null;
			var bowa=null;
			var bowb=null;

			function playTrack(track)
			{	
				$('.ngpluginaudiocharts').trigger('stop');
				if (track!==null) {
					try {
						while (audio[0].firstChild) {
							audio[0].removeChild(audio[0].firstChild);
						}

						var mp3=$(track).attr('href');
						var ogg=$(track).attr('data-ogg');

						var source=document.createElement('source');
						source.type='audio/mpeg';
						source.src=mp3;
						audio[0].appendChild(source);

						if (typeof ogg !== 'undefined') {
							source=document.createElement('source');
							source.type= 'audio/ogg';
							source.src= ogg;
							audio[0].appendChild(source);
						}

						audio[0].load();
						audio[0].play();
					}
					catch (e)
					{
					}
					bowa=$(track).find('.ngpluginaudiochartsbowa');
					bowb=$(track).find('.ngpluginaudiochartsbowb');
					bowa.css('-webkit-transform','none');
					bowa.css('transform','none');
					bowb.css('-webkit-transform','rotate(180deg)');
					bowb.css('transform','rotate(180deg)');
				} else 
				{
					try {
						audio[0].pause();
					}
					catch (e)
					{
					}
					bowa=null;
					bowb=null;
				}
				current=track;
				tracks.removeClass('ngpluginaudiocurrent');
				if (track!=null) {
					$(track).addClass('ngpluginaudiocurrent');
				}
			}

			function stop()
			{
				tracks.removeClass('ngpluginaudiocurrent');
				audio[0].pause();
				current=null;
			}

			tracks.click(function(e) {
				e.preventDefault();

				if (this!==current) {
					playTrack(this)
				} else {
					playTrack(null);
				}
			});

			function nextTrack() {
				var index=tracks.index(current);

				index++;

				if (index>tracks.length-1) index=0;

				playTrack( tracks[index]);
			};

			function updateTime() {
				try {
					var time = audio[0].currentTime;
					var len = audio[0].duration;

					if (!isNaN(time) && !isNaN(len) && bowa!==null && bowb!==null)
					{
						var angle= parseInt(time/len*360);
						if (angle<0) angle=0;
						if (angle>360) angle=360;
						var anglea=Math.min(angle,180);
						var angleb=Math.max(angle,180);
						bowa.css('-webkit-transform','rotate('+anglea+'deg)');
						bowa.css('transform','rotate('+anglea+'deg)');
						bowb.css('-webkit-transform','rotate('+angleb+'deg)');
						bowb.css('transform','rotate('+angleb+'deg)');
					}
				}
				catch (e)
				{
				}

			}

			tracks.each(function() {
				$(this).prepend('<div class="ngpluginaudiochartsbutton ngpluginaudiochartssprite"></div><div class="ngpluginaudiochartstimea"><div class="ngpluginaudiochartsbowa ngpluginaudiochartssprite"></div></div><div class="ngpluginaudiochartstimeb"><div class="ngpluginaudiochartsbowb ngpluginaudiochartssprite"></div></div><div class="ngpluginaudiochartsspinner ngpluginaudiochartssprite"></div>');
			})

			$(audio).on('ended', nextTrack);		
			$(audio).on('timeupdate', updateTime)
			$(window).on('stop.audiocharts', stop);

			return this;
		});
	};
})(jQuery);

$(document).ready(function() {
	$('.ngpluginaudiocharts').ngAudioCharts();
});
