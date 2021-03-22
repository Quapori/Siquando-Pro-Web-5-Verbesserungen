(function ($) {
    'use strict';
    $.fn.ngParaChat = function () {
        $(this).each(function () {

            var that = $(this),
                resturl = that.attr('data-rest'),
                showpostdate = that.attr('data-postdate') === 'true',
                uid = that.attr('data-uid'),
                outputul = that.children('.ngparachatoutput'),
                form = that.children('form'),
                nickinput = form.children('.ngparachatnick'),
                nicklabel = nickinput.prev('label'),
                lineinput = form.children('.ngparachatline'),
                linelabel = lineinput.prev('label'),
                emojibuttons = that.find('.ngparachatemojis').children('a'),
                spanconsent = that.find('.ngparachatconsent'),
                checkboxconsent = spanconsent.children('input'),
                lasttimestamp = '00000000000000',
                emojis = {
                    ';-)': 'wink',
                    ':-(': 'sad',
                    'x-(': 'dead',
                    ':-)': 'happy',
                    ':lol:': 'lol',
                    ':-o': 'surprise',
                    ':love:': 'love',
                    ':angry:': 'angry'
                },
                nick,
                timestamps = [],
                line,
                scheduler;


            function onSend() {
                nick = nickinput.prop('value').trim();
                line = lineinput.prop('value').trim();

                var consent = true;

                if (spanconsent.length > 0) {
                    if (!checkboxconsent.prop('checked')) {
                        consent = false;
                        spanconsent.addClass('ngparachaterror');
                    } else {
                        spanconsent.removeClass('ngparachaterror');
                    }
                }

                if (line === '') {
                    linelabel.addClass('ngparachaterror');
                    lineinput.focus();
                } else {
                    linelabel.removeClass('ngparachaterror');
                }

                if (nick === '') {
                    nicklabel.addClass('ngparachaterror');
                    nickinput.focus();
                } else {
                    nicklabel.removeClass('ngparachaterror');
                }

                if (nick === '' || line === '' || !consent) return;

                lineinput.prop('value', '');
                nickinput.attr('readonly', 'readonly');
                lineinput.eq(0).focus();

                $.ajax({
                    url: resturl,
                    method: 'POST',
                    data: {
                        'nick': nick,
                        'line': line,
                        'lasttimestamp': lasttimestamp,
                        'uid': uid
                    },
                    dataType: 'json',
                    success: handleSendSuccess,
                    error: handleError
                });
            }

            function onUpdate() {
                scheduler = undefined;
                $.ajax({
                    url: resturl,
                    method: 'POST',
                    data: {
                        'lasttimestamp': lasttimestamp,
                        'uid': uid
                    },
                    dataType: 'json',
                    success: handleSendSuccess,
                    error: handleError
                });
            }

            function isTimestampVisible(timestamp) {
                for (var i = 0; i < timestamps.length; i++) {
                    if (timestamps[i] === timestamp) return true;
                }
                return false;
            }

            function padDigit(digit) {
                return ('00' + digit).substr(-2);
            }

            function getPostTime(timestamp) {
                var postTime = new Date(Math.floor(parseInt(timestamp) * 1000)),
                    result = padDigit(postTime.getHours()) + ':' + padDigit(postTime.getMinutes()),
                    now = new Date();

                if (postTime.getDate() !== now.getDate() || postTime.getMonth() !== now.getMonth() || postTime.getFullYear() !== now.getFullYear()) {
                    result = postTime.getDate() + '.' + (postTime.getMonth()+1) + '.' + postTime.getFullYear() + ' - ' + result;
                }

                return result;
            }

            function escapeHTML(text) {
                var replacements = {"<": "&lt;", ">": "&gt;", "&": "&amp;", "\"": "&quot;"};
                return text.replace(/[<>&"]/g, function (character) {
                    return replacements[character];
                });
            }

            function createEmojis(line) {
                line = escapeHTML(line);

                if (emojibuttons.length > 0) {
                    for (var emoji in emojis) {
                        if (line === emoji) {
                            line = '<div class="ngparachatbigemoji ngparachat' + emojis[emoji] + '"></div>';
                        } else {
                            line = line.replace(emoji, '<span class="ngparachatemoji ngparachat' + emojis[emoji] + '"></span>');
                        }
                    }
                }

                return line;
            }

            function handleSendSuccess(data, status, xhr) {
                var itemadded = false;

                for (var i = 0; i < data.items.length; i++) {

                    if (!isTimestampVisible(data.items[i].timestamp)) {
                        var li = $('<li>'),
                            div = $('<div>'),
                            strong = $('<strong>'),
                            span = $('<span>');

                        timestamps.push(data.items[i].timestamp);

                        strong.text(data.items[i].nick);
                        span.html(createEmojis(data.items[i].line));


                        if (data.items[i].nick === nick) li.addClass('ngparachatmy');

                        if (data.items[i].timestamp > lasttimestamp) lasttimestamp = data.items[i].timestamp;

                        if (showpostdate) {
                            var small = $('<small>');
                            small.text(getPostTime(parseInt(data.items[i].timestamp.substr(0, 10))));
                            div.append(small);
                        }
                        div.append(strong);
                        div.append(span);

                        li.append(div);
                        li.css({
                            'opacity': 0,
                            'transform': (data.items[i].nick === nick) ? 'translate3d(20px,0,0)' : 'translate3d(-20px,0,0)'
                        });
                        outputul.append(li);
                        li.height();
                        li.css({
                            'opacity': 1,
                            'transform': 'translate3d(0,0,0)'
                        });

                        itemadded = true;
                    }
                }

                if (itemadded) outputul.scrollTop(outputul.prop('scrollHeight'));

                form.css('display', data.writable === 'true' ? 'block' : 'none');


                scheduleUpdate();
            }

            function handleError() {
                scheduleUpdate();
            }

            function scheduleUpdate() {
                if (scheduler === undefined) scheduler = window.setTimeout(onUpdate, 3000);
            }

            function onInsertEmoji(e) {
                e.preventDefault();

                var span = $(this).children('span'),
                    emoji = span.text();

                lineinput.focus();
                lineinput.val(lineinput.val() + emoji);
            }

            onUpdate();

            form.on('submit', function (e) {
                e.preventDefault();
                onSend();
            });

            emojibuttons.on('click', onInsertEmoji);

        });
    }
})(jQuery);

$(document).ready(function () {
    $('.ngparachat').ngParaChat();
});
