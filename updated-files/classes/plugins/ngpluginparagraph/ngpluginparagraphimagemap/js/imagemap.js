(function($) {
    $.fn.ngImageMap = function() {
        this.each(function() {
            var stage = $(this);
            var image = stage.children('img');
            var items = $(this).find('.ngimagemapi');
            var popups = $(this).find('.ngimagemapp');
            var sounds = $(this).find('.ngimagemaps');

            function stopSounds() {
                sounds.each(function() {
                    try {
                        if (!!(this.canPlayType)) {
                            this.currentTime = 0;
                            this.pause();
                        }
                    } catch (err) {}

                });

            }

            $(this).click(function(event) {
                popups.removeClass('ngimagemapv');
                stopSounds();
            });

            function placeItems() {
                var i, item;
                var stageWidth = image.width();
                var stageHeight = parseFloat(image.attr('height')) / parseFloat(image.attr('width')) * stageWidth;


                for (i = 0; i < items.length; i++) {
                    item = items.eq(i);
                    var width = parseFloat(item.attr('data-width'));
                    var height = parseFloat(item.attr('data-height'));
                    var left = parseFloat(item.attr('data-left'));
                    var top = parseFloat(item.attr('data-top'));
                    var itemtype = item.attr('data-type');
                    var offsetx = parseInt(item.attr('data-offsetx'));
                    var offsety = parseInt(item.attr('data-offsety'));

                    if (itemtype == 'pin') {
                        item.css({
                            'left': Math.floor(stageWidth * left - offsetx) + 'px',
                            'top': Math.floor(stageHeight * top - offsety) + 'px',
                            'width': width + 'px',
                            'height': height + 'px'
                        });
                    }
                    if (itemtype == 'area') {
                        item.css({
                            'left': Math.floor(stageWidth * left) + 'px',
                            'top': Math.floor(stageHeight * top) + 'px',
                            'width': Math.floor(stageWidth * width) + 'px',
                            'height': Math.floor(stageHeight * height) + 'px'
                        });
                    }
                }

                for (i = 0; i < popups.length; i++) {
                    var popup = popups.eq(i);
                    var id = popup.attr('id');
                    item = $('#' + id.replace('ngimagemapp', 'ngimagemapi'));

                    var popupWidth = popup.width();
                    var popupHeight = popup.height();
                    var itemLeft = parseInt($(item).css('left'));
                    var itemTop = parseInt($(item).css('top'));
                    var itemHeight = parseInt($(item).css('height'));
                    var itemWidth = parseInt($(item).css('width'));

                    var arrow = popup.children('.ngimagemapa');
                    var position = item.attr('data-popupposition');
                    var mode = item.attr('data-popupmode');

                    var offset = 15;

                    var popupLeft = 0;
                    var popupTop = 0;

                    if (position == 'Top' || position == 'Bottom') popupLeft = Math.floor(itemLeft + (itemWidth / 2) - popupWidth / 2);
                    if (position == 'Left' || position == 'Right') popupTop = Math.floor(itemTop + (itemHeight / 2) - popupHeight / 2);
                    if (position == 'Top') popupTop = itemTop - popupHeight - offset;
                    if (position == 'Bottom') popupTop = itemTop + itemHeight + offset;
                    if (position == 'Left') popupLeft = itemLeft - popupWidth - offset;
                    if (position == 'Right') popupLeft = itemLeft + itemWidth + offset;

                    popup.css({
                        'left': popupLeft + 'px',
                        'top': popupTop + 'px'
                    });

                    if (arrow.length > 0) {
                        var arrowLeft = 0;
                        var arrowTop = 0;
                        var arrowSize = 15;

                        if (position == 'Top' || position == 'Bottom') arrowLeft = Math.floor((popupWidth / 2) - arrowSize / 2);
                        if (position == 'Left' || position == 'Right') arrowTop = Math.floor((popupHeight / 2) - arrowSize / 2);
                        if (position == 'Bottom') arrowTop = -arrowSize;
                        if (position == 'Top') arrowTop = popupHeight;
                        if (position == 'Right') arrowLeft = -arrowSize;
                        if (position == 'Left') arrowLeft = popupWidth;

                        arrow.css({
                            'left': arrowLeft + 'px',
                            'top': arrowTop + 'px'
                        });
                    }

                }
            }

            function setupPopups() {
                popups.each(function() {
                    var popup = $(this);
                    var id = popup.attr('id');
                    var item = $('#' + id.replace('ngimagemapp', 'ngimagemapi'));
                    var soundid = id.replace('ngimagemapp', 'ngimagemaps');
                    var mode = item.attr('data-popupmode');

                    function playSound() {
                        sounds.each(function() {
                            if ($(this).attr('id') === soundid) {
                                try {
                                    if (!!(this.canPlayType)) {
                                        this.play();
                                    }
                                } catch (err) {}
                            } else {
                                try {
                                    if (!!(this.canPlayType)) {
                                        this.currentTime = 0;
                                        this.pause();
                                    }
                                } catch (err) {}

                            }
                        });
                    }

                    if (mode === 'MouseOver') {
                        item.hover(function() {
                            popup.addClass('ngimagemapv');
                            playSound();
                        }, function() {
                            popup.removeClass('ngimagemapv');
                            stopSounds();
                        });
                    }

                    if (mode === 'Click') {
                        item.click(function(event) {
                            popups.each(function() {
                                if ($(this).attr('id') === popup.attr('id')) {
                                    $(this).toggleClass('ngimagemapv');
                                } else {
                                    $(this).removeClass('ngimagemapv');
                                }
                            });

                            if (popup.hasClass('ngimagemapv')) {
                                playSound();
                            } else {
                                stopSounds();
                            }

                            event.stopPropagation();
                        });
                    }
                });
            }

            setupPopups();
            placeItems();

            $(window).on('resize', function() {
                placeItems();
                placeItems();
            });


            return this;
        });
    };
})(jQuery);

$(document).ready(function() {
    $('.ngimagemap').ngImageMap();
});
