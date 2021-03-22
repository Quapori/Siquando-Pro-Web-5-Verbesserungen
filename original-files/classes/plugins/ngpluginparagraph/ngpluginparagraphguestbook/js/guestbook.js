"use strict";

(function ($) {
    $.fn.ngGuestbook = function () {
        this.each(function () {
            var that = $(this);
            var form = $(this).find('form');
            var labels = form.find('label');
            var recaptcha = $(this).find('.ngparaguestbookcaptcha');
            var action = $(this).attr('data-rest');
            var formError = $(this).find('.ngparaguestbookformerror');
            var posts = $(this).find('.ngparaguestbookposts');
            var uid = $(this).attr('data-uid');
            var postsperpage = parseInt($(this).attr('data-postsperpage'), 10);
            var pagination = $(this).find('.ngparaguestbookpagination');
            var currentpage = 0;
            var starButtons = $(this).find('.ngparaguestbookstars').children('a');
            var starInput = $(this).find('input[name=stars]');
            var starSrc = $(this).attr('data-star');
            var starTable = $(this).find('.ngparaguestbookstars');
            var starCaptions = [$(this).attr('data-star1'), $(this).attr('data-star2'), $(this).attr('data-star3'), $(this).attr('data-star4'), $(this).attr('data-star5')];
            var starAverage = $(this).attr('data-average');
            var starsFilter = 0;
            var headingPost = $(this).find('h3');
            var showDetails = $(this).attr('data-details') == 'on';
            var showResult = $(this).attr('data-result') == 'on';
            var locationFrom = $(this).attr('data-location');

            function handlePostSuccess(data) {

                formError.empty();

                if (data.state == 'error') {
                    formError.text(data.message);
                    formError.css('display', 'block');
                    that.removeClass('ngbusy');
                    labels.removeClass('ngparaguestbookerror');

                    for (var i = 0; i < data.missing.length; i++) {
                        labels.filter("[data-id='" + data.missing[i] + "']").addClass('ngparaguestbookerror');
                    }
                } else if (data.state == 'ok') {
                    starsFilter = 0;
                    updatePosts(0);
                    form.after($('<p>', {
                        'text': data.message,
                        'class': 'ngguestbookthanks'
                    }));
                    form.remove();
                    headingPost.remove();
                } else {
                    that.removeClass('ngbusy');
                    formError.text(data);
                }
            }

            function handleStarsClick(e) {
                starsFilter = 5 - $(this).parent('td').parent('tr').index();
                updatePosts(0);
                e.preventDefault();
            }

            function handleAjaxPostError(x, s, e) {
                that.removeClass('ngbusy');
                form.text(e + ' ' + x.responseText);
            }

            function handleAjaxGetError(x, s, e) {
                that.removeClass('ngbusy');
                posts.text(e + ' ' + x.responseText);
            }


            function handleGetSuccess(data) {

                posts.empty();

                if (data.state === 'ok') {

                    var sum = 0;
                    var total = 0;
                    var max = 0;


                    for (var i = 0; i < data.stars.length; i++) {
                        sum += data.stars[i] * (i + 1);
                        total += data.stars[i];
                        if (data.stars[i] > max) max = data.stars[i];
                    }

                    if (total > 0) {

                        if (showResult) {

                            var average = Math.round(sum / total * 2) / 2;

                            posts.append($('<div>', {
                                'class': 'ngguestbooktotal'
                            }).append($('<div>', {
                                'style': 'width:' + average * 20 + '%'
                            })));

                            posts.append($('<p>', {
                                'text': starAverage.replace('[s]', average)
                            }));

                        }

                        if (showDetails) {

                            var table = $('<table>');

                            for (var i = 4; i >= 0; i--) {
                                var percent = data.stars[i] / max * 100;
                                var tr = $('<tr>');

                                if (data.stars[i] > 0) {
                                    tr.append($('<td>').append($('<a>', {
                                        'text': starCaptions[i],
                                        'style': 'width:20%',
                                        'click': handleStarsClick,
                                        'href': '#',
                                        'class': 'nglink'
                                    })));
                                } else {
                                    tr.append($('<td>', {
                                        'text': starCaptions[i],
                                        'style': 'width:20%'
                                    }));
                                }
                                tr.append($('<td>', {
                                    'style': 'width:70%'
                                }).append($('<div>').append($('<div>', {
                                    'style': 'width:' + percent + '%'
                                }))));
                                tr.append($('<td>', {
                                    'text': '(' + data.stars[i] + ')',
                                    'style': 'width:10%'
                                }));

                                table.append(tr);
                            }
                            posts.append(table);
                        }

                    }
                    for (var i = 0; i < data.items.length; i++) {
                        var container = $('<div>', {
                            'class': 'ngparaguestbookpost'
                        });

                        var visitor = data.items[i].date + ' ' + data.items[i].name;

                        if (typeof data.items[i].location !== 'undefined' && data.items[i].location !== '') visitor += ' ' + locationFrom + ' ' + data.items[i].location;

                        container.append($('<h4>', {
                            'text': visitor
                        }));

                        var caption = $('<h3>', {
                            'text': data.items[i].caption
                        });

                        if (typeof data.items[i].stars !== 'undefined') {
                            for (var j = 0; j < data.items[i].stars; j++) {
                                caption.append($('<img>', {
                                    'src': starSrc
                                }));
                            }
                        }

                        container.append(caption);

                        var lines = data.items[i].message.split('\n');

                        for (var j = 0; j < lines.length; j++) {
                            if (lines[j] != '') {
                                container.append($('<p>', {
                                    'text': lines[j]
                                }));
                            }
                        }

                        if (data.items[i].reply !== '') {
                            var reply = $('<div>', {
                                'class': 'ngparaguestbookreply'
                            });

                            var lines = data.items[i].reply.split('\n');

                            for (var j = 0; j < lines.length; j++) {
                                if (lines[j] != '') {
                                    reply.append($('<p>', {
                                        'text': lines[j]
                                    }));
                                }
                            }
                            container.append(reply);
                        }
                        posts.append(container);
                    }

                    if (data.total > postsperpage) {
                        pagination.empty();

                        var page = 1;

                        for (var offset = 0; offset < data.total; offset += postsperpage) {
                            var pagelink = $('<a>', {
                                'text': page,
                                'href': '#',
                                'click': handlePageClick
                            });

                            if (page - 1 == currentpage) pagelink.addClass('ngparaguestbookcurrent');

                            pagination.append(pagelink);
                            page++;
                        }

                        pagination.css('display', 'block');
                    } else {
                        pagination.css('display', 'none');
                    }
                }
                that.removeClass('ngbusy');
            }

            function handlePageClick(e) {
                var page = parseInt($(this).text(), 10) - 1;
                updatePosts(page);
                e.preventDefault();
            }

            function submitForm(e) {
                var data = {
                    'action': 'post',
                    'uid': uid
                };

                form.find('input[type=text],input[type=hidden],input[type=email],input[type=checkbox]:checked,textarea').each(function () {
                    data[$(this).attr('name')] = $(this).val();
                });

                that.addClass('ngbusy');

                $.ajax({
                    url: action,
                    datatype: 'json',
                    data: data,
                    type: 'POST',
                    success: handlePostSuccess,
                    error: handleAjaxPostError
                });

                e.preventDefault();
            }

            function handleStarClick(e) {
                var index = $(this).index();

                for (var i = 0; i < starButtons.length; i++) {
                    if (i <= index) {
                        starButtons.eq(i).addClass('selected');
                    } else {
                        starButtons.eq(i).removeClass('selected');
                    }
                }

                starInput.val(index + 1);

                e.preventDefault();
            }

            function handleStarOver(e) {
                var index = $(this).index();

                starButtons.each(function (i) {
                    if (i <= index) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });
            }

            function handleStarOut(e) {
                starButtons.removeClass('hover');
            }


            function updatePosts(page) {
                var data = {
                    'action': 'get',
                    'uid': uid,
                    'page': page,
                    'stars': starsFilter
                };

                currentpage = page;

                that.addClass('ngbusy');

                $.ajax({
                    url: action,
                    datatype: 'json',
                    data: data,
                    type: 'POST',
                    success: handleGetSuccess,
                    error: handleAjaxGetError
                });

            }

            form.on('submit', submitForm);
            starButtons.on('click', handleStarClick);
            starButtons.on('mouseover', handleStarOver);
            starButtons.on('mouseout', handleStarOut);

            updatePosts(0);

            return this;
        });
    };
})(jQuery);

$(document).ready(function () {
    $('.ngparaguestbook').ngGuestbook();
});