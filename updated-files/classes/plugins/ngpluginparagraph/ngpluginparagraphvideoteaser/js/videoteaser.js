(function($) {
    $.fn.sqpVideoTeaser = function() {
      $(this).each(function() {
        var container = $(this),
            video = container.find('video'),
            muteButton = container.find('.sqpvideoteasermute'),
            restartButton = container.find('.sqpvideoteaserrestart'),
            closeButton=container.find('.sqpvideoteaserclose'),
            tracker = container.find('.sqpvideoteasertrackinner'),
            trackerOuter = container.find('.sqpvideoteasertrackouter'),
            img = container.find('img'),
            updateHandle = null,
            playing = false;


        function checkVideoPos() {
            if (!playing) {
                if (container.offset().top + container.width() / 16 * 9 < $(window).scrollTop() + $(window).height()) {
                    video[0].play();
                    playing = true;
                }
            }
        }

        function revealVideo() {
            container.addClass('sqpvideoteaseractive');
            startTracker();
            img.hide();
            video.show();
            trackerOuter.show();
            muteButton.show();
        }

        function startTracker() {
            if (updateHandle === null) {
                updateHandle = window.setInterval(updateTracker, 10);
            }
        }

        function stopTracker() {
            if (updateHandle !== null) {
                window.clearInterval(updateHandle);
                updateHandle = null;
            }
        }

        function hideVideo() {
            stopTracker();

            if (img.length > 0) {
                img.show();
                video.hide();
                trackerOuter.hide();
                muteButton.hide();
            } else {
                container.removeClass('sqpvideoteaseractive');
            }
        }

        function closeVideo(e) {
          video[0].pause();
          container.removeClass('sqpvideoteaseractive');
          e.preventDefault();
        }

        function restartVideo(e) {
            video[0].currentTime = 0;
            video[0].play();
            e.preventDefault();
        }

        function updateTracker() {
            var current = parseFloat(video[0].currentTime);
            var total = parseFloat(video[0].duration);

            tracker.css('width', current / total * 100 + '%');
        }

        function toggleMute(e) {
            if (!muteButton.hasClass('sqpvideoteaserunmute')) {
                video.prop('muted', false);
                muteButton.addClass('sqpvideoteaserunmute');
            } else {
                video.prop('muted', true);
                muteButton.removeClass('sqpvideoteaserunmute');
            }
            e.preventDefault();
        }

        $(window).on('scroll', checkVideoPos);
        video.on('playing', revealVideo);
        video.on('ended', hideVideo);
        muteButton.on('click', toggleMute);
        restartButton.on('click', restartVideo);
        closeButton.on('click',closeVideo);

        window.setTimeout(checkVideoPos, 1000);
    });
  };
})(jQuery);

$(document).ready(function() {
    $('.sqpvideoteaser').sqpVideoTeaser();
});
