(function($) {
  'use strict';
  $.fn.ngTouchSlider = function() {
    $(this).each(function() {
      var container = $(this),
      ul = container.find('ul'),
      lis = container.find('li'),
      bullets,
      imgs = container.find('img'),
      shownav = container.attr('data-nav')==='true',
      ratio = parseInt(imgs.attr('width'), 10) / parseInt(imgs.attr('height'), 10),
      drag = false,
      lastx = 0,
      newx = 0,
      offset = 0,
      width,
      height,
      blockscroll = false,
      flicktimer,
      flick = false,
      index = 0;

      function size() {
        width = container.width();
        height = Math.floor(width / ratio);

        container.css('height', height);
        lis.css({
          'width': width + 'px',
          'height': height + 'px'
        });
        imgs.css({
          'width': width + 'px',
          'height': height + 'px'
        });
        ul.css({
          'width': (width * lis.length) + 'px',
          'height': height + 'px'
        });

        setIndex(false);
      }

      function releaseFlick() {
        flick = false;
      }


      function handleStart(x) {
        drag = true;
        lastx = x;
        newx = lastx;
        blockscroll = false;
        flick = true;

        if (flicktimer !== undefined) clearTimeout(releaseFlick);

        setTimeout(releaseFlick, 250);
      }

      function handleEnd() {
        drag = false;

        if (flick && Math.abs(newx - lastx) > 50) {
          if (newx > lastx) {
            index--;
          } else {
            index++;
          }
        } else {
          index = Math.round((offset + lastx - newx) / width);
        }

        if (index < 0) index = 0;
        if (index > lis.length - 1) index = lis.length - 1;

        setIndex(true);
      }

      function setIndex(animate) {
        offset = index * width;

        ul.css({
          'transition': (animate) ? 'transform 0.3s ease' : 'none',
          'transform': 'translateX(' + (-offset) + 'px)'
        });

        if (shownav) bullets.removeClass('ngparagraphtouchsliderbulletsactive').eq(index).addClass('ngparagraphtouchsliderbulletsactive');
      }

      function handleMove(x) {
        if (drag) {

          newx = x;

          var translate = offset + lastx - newx;
          if (translate < 0) translate = 0;
          if (translate > width * (lis.length - 1)) translate = width * (lis.length - 1);

          ul.css({
            'transition': 'none',
            'transform': 'translateX(' + (-translate) + 'px)'
          });

          if (Math.abs(newx - lastx) > 50) blockscroll = true;
        }
      }

      function handleTouchEnd(e) {
        handleEnd();
      }

      function handleTouchMove(e) {
        if (e.originalEvent.touches.length == 1) {
          handleMove(e.originalEvent.touches[0].pageX);
          if (blockscroll && e.cancelable) e.preventDefault();
        }
      }

      function handleTouchStart(e) {
        if (e.originalEvent.touches.length == 1) {
          handleStart(e.originalEvent.touches[0].pageX);
          if (navigator.userAgent.indexOf('Android 4') !== -1) e.preventDefault();
        }
      }

      function handleMouseDown(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        handleStart(e.pageX);
      }

      function handleMouseMove(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        handleMove(e.pageX);
      }

      function handleMouseUp(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        handleEnd();
      }

      function createBullets() {
        var bulletsUl = $('<ul>', {
          'class': 'ngparagraphtouchsliderbullets'
        });
        for (var i = 0; i < lis.length; i++) {
          bulletsUl.append($('<li>'));
        }
        bulletsUl.css('width', lis.length * 25 + 'px');
        bulletsUl.insertAfter(container);
        bullets = bulletsUl.children('li');
      }

      function handleClick() {
        index = $(this).index();
        setIndex(true);
      }

      if (shownav) {
        createBullets();
        bullets.on('click', handleClick);
      }
      size();

      imgs.on('mousedown', handleMouseDown);
      imgs.on('mouseup', handleMouseUp);
      imgs.on('mousemove', handleMouseMove);
      imgs.on('touchstart', handleTouchStart);
      imgs.on('touchend', handleTouchEnd);
      imgs.on('touchmove', handleTouchMove);

      $(window).on('resize', size);
    });
  };
})(jQuery);

$(document).ready(function() {
  $('.ngparagraphtouchslider').ngTouchSlider();
});
