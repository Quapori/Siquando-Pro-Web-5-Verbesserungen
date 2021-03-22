(function($) {
  'use strict';
  $.fn.sqrNav = function() {
    $(this).each(function() {

      var nav = $(this);
      var showNav = nav.find('.sqrnavshow');
      var hideNav = nav.find('.sqrnavhide');
      var allItems = nav.find('li:has(ul)');
      var lastitem;
      var doubleClickTimeout;
      var doubleclick = false;

      function handleClick(e) {

        if (lastitem === this && doubleclick) return;

        if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);

        doubleclick = true;

        doubleClickTimeout = window.setTimeout(function() {
          doubleclick = false;
        }, 1000);

        if ($(this).parent().hasClass('sqrnavopen')) {
          $(this).parent('li').removeClass('sqrnavopen');
        } else {
          lastitem = this;
          allItems.removeClass('sqrnavopen');
          $(this).parents('li').addClass('sqrnavopen');
          $(this).parent('li').find('input').focus();
        }

        e.preventDefault();
        e.stopPropagation();
      }

      function isMobile() {
        return nav.children('ul').children('li').css('float') === 'none';
      }

      function handleClose(e) {
        if (!isMobile()) {
          if ($(e.target).parents('.sqrnav').length === 0) {
            allItems.removeClass('sqrnavopen');
            nav.removeClass('sqrnavopen');
            lastitem = undefined;
            doubleclick = false;
            if (doubleClickTimeout !== undefined) window.clearTimeout(doubleClickTimeout);
          }
        }
      }

      function handleShowNav(e) {
        nav.addClass('sqrnavopen');
        e.preventDefault();
      }

      function handleHideNav(e) {
        nav.removeClass('sqrnavopen');
        e.preventDefault();
      }
            
      nav.find('li.active').parents('li').addClass('active');

      allItems.addClass('sqrnavmore').children('a').on('click', handleClick);
      showNav.on('click', handleShowNav);
      hideNav.on('click', handleHideNav);
      $(document).on('click touchstart', handleClose);

    });
  };
  
  $.fn.sqrEyecatcher = function() {
      $(this).each(function() {
          var container = $(this).find('.sqreyecatcherstage'),
              imgpri = container.children('img'),
              fadeEffect = container.attr('data-fadeeffect'),
              nav = $(this).find('.sqreyecatchernav'),
              links = nav.find('a'),
              offset = 0,
              autoProgress = parseInt(container.attr('data-autoprogress'), 10),
              autoProgessTimer = null;

          function performAutoProgress() {
              offset++;

              if (offset > links.length - 1) {
                  offset = 0;
              }

              setOffset();
          }

          function start() {
              if (autoProgress > 0) {
                  if (autoProgessTimer !== null) {
                      stop();
                  }
                  autoProgessTimer = window.setTimeout(performAutoProgress, autoProgress * 1000);
              }
          }

          function stop() {
              if (autoProgessTimer !== null) {
                  window.clearTimeout(autoProgessTimer);
                  autoProgessTimer = null;
              }
          }

          function setOffset() {
              if (links.eq(offset).hasClass('sqreyecatchernavselected')) return;

              var img = new Image(),
                  url = links.eq(offset).attr('href'),
                  prifrom,
                  secfrom,
                  prito,
                  secto;

              links.removeClass('sqreyecatchernavselected').eq(offset).addClass('sqreyecatchernavselected');

              switch (fadeEffect) {
                  case 'right':
                      prifrom = 'translateX(0)';
                      secfrom = 'translateX(-30px)';
                      secto = 'translateX(0)';
                      prito = 'translateX(30px)';
                      break;
                  case 'left':
                      prifrom = 'translateX(0)';
                      secfrom = 'translateX(30px)';
                      secto = 'translateX(0)';
                      prito = 'translateX(-30px)';
                      break;
                  case 'down':
                      prifrom = 'translateY(0)';
                      secfrom = 'translateY(-30px)';
                      secto = 'translateY(0)';
                      prito = 'translateY(30px)';
                      break;
                  case 'shrink':
                      prifrom = 'scale(1.0)';
                      secfrom = 'scale(1.1)';
                      secto = 'scale(1.0)';
                      prito = 'scale(0.9)';
                      break;
                  case 'grow':
                      prifrom = 'scale(1.0)';
                      secfrom = 'scale(0.9)';
                      secto = 'scale(1.0)';
                      prito = 'scale(1.1)';
                      break;
                  case 'fade':
                      prifrom = 'none';
                      secfrom = 'none';
                      secto = 'none';
                      prito = 'none';
                      break;
                  default:
                      prifrom = 'translateY(0)';
                      secfrom = 'translateY(30px)';
                      secto = 'translateY(0)';
                      prito = 'translateY(-30px)';
                      break;
              }

              $(img).on('load', function() {
                  imgpri.css({
                      'z-index': '0',
                      'opacity': '1',
                      'transition': 'none',
                      'transform': prifrom
                  });
                  imgsec.css({
                      'z-index': '1',
                      'opacity': '0',
                      'transition': 'none',
                      'transform': secfrom
                  });
                  imgsec.attr('src', url);
                  imgpri.height();
                  imgsec.height();
                  imgsec.css({
                      'transition': 'opacity 0.5s, transform 0.5s',
                      'opacity': '1',
                      'transform': secto
                  });
                  imgpri.css({
                      'transition': 'opacity 0.5s, transform 0.5s',
                      'opacity': '0',
                      'transform': prito
                  });

                  var swap = imgpri;
                  imgpri = imgsec;
                  imgsec = swap;
                  start();
              });

              img.src = url;
          }

          function handleClick(e) {
              e.preventDefault();
              offset = $(this).index();
              setOffset();
          }

          if (links.length > 1) {
              links.eq(offset).addClass('sqreyecatchernavselected');

              var imgsec = $('<img>').css({
                  'opacity': '0',
                  'z-index': '0'
              });

              container.append(imgsec);
              links.on('click', handleClick);
              start();
          }
      });
  };  
})(jQuery);

$(document).ready(function() {
  $('.sqrnav').sqrNav();
  $('.sqreyecatcher').sqrEyecatcher();
});