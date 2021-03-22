(function($) {
    'use strict';
    $.fn.ngSliderXxl = function() {
        $(this).each(function() {
            var container = $(this),
                imgpri = container.children('img'),
                heightPercent = parseFloat(container.attr('data-stageheight')) / 100,
                fadeEffect = container.attr('data-fadeeffect'),
                ul = container.find('ul'),
                links = ul.find('a');

            links.eq(0).addClass('ngparagraphtouchsliderxxlactive');

            var imgsec = $('<img>').css({
                'opacity': '0',
                'z-index': '0'
            }).attr({
                'data-width': '1',
                'data-height': '1',
            });
            imgpri.attr({
                'data-width': imgpri.attr('width'),
                'data-height': imgpri.attr('height')
            });


            container.append(imgsec);

            function size() {
                container.css('height', Math.round(window.innerHeight * heightPercent) + 'px');

                var stageWidth = container.innerWidth();
                var stageHeight = container.innerHeight();

                container.find('img').each(function() {
                    var imgWidth = parseFloat($(this).attr('data-width'));
                    var imgHeight = parseFloat($(this).attr('data-height'));
                    var ratio = imgWidth / imgHeight;

                    var width = stageWidth;
                    var height = width / ratio;

                    if (height < stageHeight) {
                        height = stageHeight;
                        width = height * ratio;
                    }

                    var top = (stageHeight - height) / 3;
                    var left = (stageWidth - width) / 2;

                    $(this).css({
                        'width': Math.floor(width) + 'px',
                        'height': Math.floor(height) + 'px',
                        'left': Math.floor(left) + 'px',
                        'top': Math.floor(top) + 'px'
                    });
                });
            }


            function handleClick(e) {
                e.preventDefault();

                if ($(this).hasClass('ngparagraphtouchsliderxxlactive')) return;

                var img = new Image(),
                    url = $(this).attr('href'),
                    prifrom,
                    secfrom,
                    prito,
                    secto;

                links.removeClass('ngparagraphtouchsliderxxlactive').eq($(this).parent('li').index()).addClass('ngparagraphtouchsliderxxlactive');

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
                    default:
                        prifrom = 'translateY(0)';
                        secfrom = 'translateY(30px)';
                        secto = 'translateY(0)';
                        prito = 'translateY(-30px)';
                        break;
                }

                $(img).on('load', function() {
                    imgsec.attr({
                        'data-width': img.width,
                        'data-height': img.height,
                    });
                    size();
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
                });

                img.src = url;
            }
            size();
            $(window).on('resize', size);
            links.on('click', handleClick);
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngparagraphtouchsliderxxl').ngSliderXxl();
});
